<?php
    session_start();
    require '../../db/db.php';


    if($_SESSION['login']!==true){
        echo("login required");
        die("login required");
    }
    if($_SESSION['role']!=="Recruiter"){
        echo("not authorised");
        die("not authorised");
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
            die("job added");
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
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 400px;">

        <div class="card-body">

            <h3 class="text-center mb-4">Register</h3>

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

</body>
</html>