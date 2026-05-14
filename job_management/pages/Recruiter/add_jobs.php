<?php
    session_start();
    require '../../db/db.php';
    if($_SESSION['login']!==true){
        header("location:../login.php");
    }
    if($_SESSION['role']!=="Recruiter"){
        header("location:../login.php");
    }

    if($_SERVER['REQUEST_METHOD']=="POST"){

        $job_title=$_POST['job_title'];
        $job_description=$_POST['job_description'];
        $close_date=$_POST['close_date'];
        $status=$_POST['status'];
        $user_id=$_SESSION['user_id'];        
        $sql="insert into jobs (job_title,job_description,recruiter_id,close_date,status) values('$job_title','$job_description','$user_id','$close_date','$status')";

        if($conn->query($sql)===TRUE){
            die("job added");
        }else{
            die("error is ".$conn->connect_error);
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
                    >
                </div>
<!-- 
                <div class="mb-3">
                    <label class="form-label">Open Date</label>
                    <input 
                        type="date" 
                        name="email" 
                        class="form-control"
                        placeholder="Enter email"
                        required
                    >
                </div> -->

                <div class="mb-3">
                    <label class="form-label">Close Date</label>
                    <input 
                        type="date" 
                        name="close_date" 
                        class="form-control"
                        placeholder="Enter Close Date"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" id="" class="form-select" required>
                        <option value="" selected disabled>Select Role</option>
                        <option value="active">Active</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
        <?php
            // if($error!==""){
            //     echo "<div style=\"color: red;\">wrong password</div>";
            // }
        ?>
                <button type="submit" class="btn btn-primary w-100">
                    Save
                </button>

            </form>

        </div>

    </div>

</body>
</html>