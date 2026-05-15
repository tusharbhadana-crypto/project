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
    if(isset($_GET) && (!empty($_GET['job_id']))){
        $sql="SELECT applications.*, users.username,users.name FROM applications JOIN users ON applications.applicant_id = users.user_id WHERE applications.job_id=".$_GET['job_id'];
        // $sql="select * from applications where job_id=".$_GET['job_id'];
        $result=$conn->query($sql);
        
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
            .cv-link,
            .edit-link {
                text-decoration: none;
                font-weight: 500;
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

                <th>Applicant username</th>
                <th>Applicant Name</th>
                <th>Submitted CV</th>

                <th>Application Status</th>
                <th>Edit Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
                if(isset($result) && $result->num_rows > 0){
                    while($row=$result->fetch_assoc()){
                        echo "<tr>";

                            echo "<td>".$row['username']."   </td>";
                            echo "<td>".$row['name']." </td>";
                            echo "<td><a class='cv-link' href='../Applicant/".$row['cv']."'>".$row['cv']."</a></td>";
                            echo "<td>".$row['status']."   </td>";
                            echo "<td><a class='edit-link' href='edit_status.php?application_id=".$row['id']."'>Edit</a></td>";   
                        echo "</tr>";
                    }
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
