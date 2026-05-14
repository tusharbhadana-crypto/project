<?php
    session_start();
    require '../../db/db.php';
    if($_SESSION['login']!==true){
        header("location:../login.php");
    }
    if($_SESSION['role']!=="Applicant"){
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
    $sql="select * from applications where applicant_id=".$_SESSION['user_id'];
    $result=$conn->query($sql);
    $sql_jobs="select * from jobs";
    $result_jobs=$conn->query($sql_jobs);
    
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
    <a href="profile.php">Profile</a>
    <a href="add_jobs.php">Add a new </a>

    <div class="jobs table">
        <table class="table-bordered">
            <tr>
                <th>Job Id</th>
                <th>Job Title</th>
                <th>Job Status</th>
                <th>Job Post Date</th>
                <th>Job Close Date</th>
                <th>Job Description</th>
            </tr>
            <?php
                while($row_jobs=$result_jobs->fetch_assoc()){
                    echo "<tr>";
                        echo "<td>".$row_jobs['id']." </td>";
                        echo "<td>".$row_jobs['job_title']."   </td>";
                        echo "<td>".$row_jobs['status']."   </td>";
                        echo "<td>".$row_jobs['post_date']."   </td>";
                        echo "<td>".$row_jobs['close_date']."   </td>";
                        echo "<td>".$row_jobs['job_description']."   </td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>


    <div>
        <table class="table-bordered">
            <tr>
                <th>Job Id</th>
                <th>Applicant Id</th>
                <th>CV</th>
                <th>Application Status</th>
                <th> Edit Entries</th>
            </tr>
            <?php
                while($row=$result->fetch_assoc()){
                    echo "<tr>";
                        echo "<td>".$row['job_id']." </td>";
                        echo "<td>".$row['applicant_id']."   </td>";
                        echo "<td>".$row['CV']."   </td>";
                        echo "<td>".$row['status']."   </td>";
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
