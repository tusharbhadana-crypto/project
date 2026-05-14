<?php
    session_start();
    require '../../db/db.php';


    if($_SESSION['login']!==true){
        echo "<script>
        alert('You are not logged in go back to login');
        window.location.href='../login.php';
        </script>";
        exit();
    }
    if($_SESSION['role']!=="Recruiter"){
        echo "<script>
        alert('You do not have access to this page go back to login');
        window.location.href='../login.php';
        </script>";
        exit();
    }
    if(isset($_GET) && (!empty($_GET['id']))){
        $sql="select * from jobs where id=".$_GET['id'];
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
        $id=$_GET['id'];
        
    }
    if($_SERVER['REQUEST_METHOD']=="POST"){

        $job_title=$_POST['job_title'];
        $job_description=$_POST['job_description'];
        $close_date=$_POST['close_date'];
        $status=$_POST['status'];
        $user_id=$_SESSION['user_id']; 

        $id=$_POST['id'];


        $sql="update jobs set
            job_title='$job_title',
            job_description='$job_description',
            close_date='$close_date',
            status='$status'
            where id=".$id;

        if($conn->query($sql)===TRUE){
            echo "<script>
            alert('Job updated successfully');
            window.location.href='dashboard.php';
            </script>";
        }else{
            die("error is ".$conn->error);
        }

    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f3f5f7;
            min-height: 100vh;
        }
        .page-wrap {
            min-height: calc(100vh - 72px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 12px;
        }
        .edit-card {
            width: 100%;
            max-width: 440px;
            border: 0;
            border-radius: 12px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Job Managment</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link" href="../dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="../profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="../add_jobs.php">Post New Job</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="update_profile.php?id=1">Update Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-wrap">
    <div class="card shadow edit-card p-4">

        <div class="card-body">

            <h3 class="text-center mb-4">Edit Job</h3>

            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">



                <div class="mb-3">
                    <label class="form-label">job Title</label>
                    <input 
                        type="text" 
                        name="job_title" 
                        class="form-control"
                        placeholder="Enter Job title"
                        required
                        value="<?php echo $row['job_title'] ?>"
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Job Description</label>
                    <input 
                        type="text" 
                        name="job_description" 
                        class="form-control"
                        placeholder="Enter name"
                        required
                        value="<?php echo $row['job_description'] ?>"
                    >
                </div>


                <div class="mb-3">
                    <label class="form-label">Close Date</label>
                    <input 
                        type="date" 
                        name="close_date" 
                        class="form-control"
                        placeholder="Enter Close Date"
                        required
                        value="<?php  echo $row['close_date']?>"
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" id="" class="form-select" required  value="">
                        <option value="" selected disabled>Select Role</option>
                        <option <?php  if($row['status']=="active") echo"selected"; ?> value="active">Active</option>
                        <option <?php  if($row['status']=="closed") echo"selected"; ?> value="closed">Closed</option>
                    </select>
                </div>
                <input type="hidden" name="id" value= <?php echo $id?> >
                <button type="submit" class="btn btn-primary w-100">
                    Save
                </button>

            </form>

        </div>

    </div>
    </div>

</body>
</html>
