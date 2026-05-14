<?php
    session_start();
    require '../../db/db.php';
    if($_SESSION['login']!==true){
        header("location:../login.php");
    }
    if($_SESSION['role']!=="Recruiter"){
        header("location:../login.php");
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
</head>
<body>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo "dashboard.php"?>"></a>
        </div>
        <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Page 1</a></li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li>
        </ul>
    </div>
    </nav>

    <a href="profile.php">Profile</a>
    <a href="add_jobs.php">Post New Job </a>
    <a href="update_profile.php?id=1">Update Profile</a>
    <div>
        <table class="table-bordered">
            <tr>
                <th>Job Id</th>
                <th>Job Title</th>
                <th>Job Status</th>
                <th>Job Post Date</th>
                <th>Job Close Date</th>
                <th>Job Description</th>
                <th>Edit Details</th>
            </tr>
            <?php
                while($row=$result->fetch_assoc()){
                    echo "<tr>";
                        echo "<td>".$row['id']." </td>";
                        echo "<td>".$row['job_title']."   </td>";
                        echo "<td>".$row['status']."   </td>";
                        echo "<td>".$row['post_date']."   </td>";
                        echo "<td>".$row['close_date']."   </td>";
                        echo "<td>".$row['job_description']."   </td>";
                        echo "<td>
                                    <a href=\"delete_job.php/?id=".$row['id']."\">Delete</a>
                                    <a href=\"edit_job.php/?id=".$row['id']."\">Edit</a>
                                </td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>
