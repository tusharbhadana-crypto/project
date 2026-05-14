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
    require '../../db/db.php';
    $user_code=$_SESSION['user_code'];

    $sql = "select * from users where username='$user_code' or email='$user_code'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();


    $_SESSION['user_id']=$row['user_id'];
    $_SESSION['role']=$row['role'];
    $_SESSION['username']=$row['username'];
    $_SESSION['name']=$row['name'];
    $_SESSION['email']=$row['email'];
    $_SESSION['image_url']=$row['image_url'];
    
    // echo $_SESSION['user_id'];
    // echo"<br>";
    // echo $_SESSION['role'];
    // echo"<br>";
    // echo $_SESSION['username'];
    // echo"<br>";
    // echo $_SESSION['name'];
    // echo"<br>";
    // echo $_SESSION['email'];
    // echo"<br>";
    // echo $_SESSION['image_url'];
    // echo"<br>";
    $sql="select * from jobs where recruiter_id=".$_SESSION['user_id'];
    $result=$conn->query($sql);
    
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
        .dashboard-wrap {
            padding: 24px 12px 40px;
        }
        .jobs-card {
            border: 0;
            border-radius: 12px;
            overflow: hidden;
        }
        .table thead th {
            white-space: nowrap;
            background-color: #f8f9fa;
        }
        .table td {
            vertical-align: middle;
        }
        .action-links a {
            text-decoration: none;
            font-weight: 500;
            margin-right: 12px;
        }
        .action-links a:last-child {
            margin-right: 0;
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
                    <li class="nav-item  ">
                    <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link " href="add_jobs.php">Post New Job</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link " href="update_profile.php?id=1">Update Profile</a>
                    </li>
                </ul>
            </div>
        </div>
        </nav>

    <div class="dashboard-wrap">
    <div class="container">
        <div class="card shadow-sm jobs-card">
        <div class="table-responsive">
        <table class="table table-bordered table-hover mb-0">
            <thead>
            <tr>
                <th>Job Id</th>
                <th>Job Title</th>
                <th>Job Status</th>
                <th>Job Post Date</th>
                <th>Job Close Date</th>
                <th>Job Description</th>
                <th>Edit Details</th>
                <th>Applications</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i=1;
                while($row=$result->fetch_assoc()){
                    echo "<tr>";
//                        echo "<td>".$row['id']." </td>";
                        echo "<td>".$i++." </td>";
                        echo "<td>".$row['job_title']."   </td>";
                        echo "<td>".$row['status']."   </td>";
                        echo "<td>".$row['post_date']."   </td>";
                        echo "<td>".$row['close_date']."   </td>";
                        echo "<td>".$row['job_description']."   </td>";
                        echo "<td class=\"action-links\">
                                    <a href=\"delete_job.php/?id=".$row['id']."\">Delete</a>
                                    <a href=\"edit_job.php/?id=".$row['id']."\">Edit</a>
                                </td>";
                        echo "<td><a href=\"applications.php?job_id=".$row['id']."\">View Applications</a></td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
        </div>
        </div>
    </div>
    </div>
</body>
</html>
