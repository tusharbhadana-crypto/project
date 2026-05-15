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
    if($_SESSION['role']!=="Applicant"){
        echo "<script>
        alert('You do not have access to this page go back to login');
        window.location.href='../login.php';
        </script>";
        exit();
    }

    if($_SERVER['REQUEST_METHOD']==='GET'){
        $job_id=$_GET['job_id'];
        $sql="select * from applications where job_id=".$job_id;
        $result=$conn->query($sql);
        if($result->num_rows>0){
            echo "<script>
            alert('You have already applied for this job');
            window.location.href='dashboard.php';
            </script>";
            exit();
        }
    } 

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $job_id = $_POST['job_id'];
    $applicant_id = $_SESSION['user_id'];

    $image_name = $_FILES['cv']['name'];
    $tmp_name = $_FILES['cv']['tmp_name'];
    $folder = "uploads/" . basename($image_name);
    echo $image_name."<br>";
    echo $folder;
        // echo";
    if (move_uploaded_file($tmp_name, $folder)) {
            
        $sql="insert into applications (
            job_id,
            applicant_id,
            cv) values (
            '$job_id',
            '$applicant_id',
            '$folder'
            )";
        echo"hiiiiiiiiiiiiiiiii";
        if($conn->query($sql)===true){
            echo "<script>
            alert('Application submitted successfully');
            window.location.href='dashboard.php';
            </script>";
        }else{
            echo"error is  ".$conn->error;
        }
        
    }else{
        echo"bahaaar";
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
        .apply-card {
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
              <a class="nav-link" href="dashboard.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile.php">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="update_profile.php?id=1">Update Profile</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="page-wrap">
    <div class="card shadow apply-card p-4">

        <div class="card-body">

            <h3 class="text-center mb-4">Apply for Job</h3>

            <form  action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Upload CV</label>
                    <input 
                        type="file" 
                        name="cv" 
                        class="form-control"
                        required
                    >
                </div>

                <input type="hidden" name="job_id" value="<?php echo $job_id ?>">
                <button class="btn btn-primary w-100">
                    Apply
                </button>

            </form>

        </div>

    </div>
    </div>

</body>
</html>
