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

<nav class="navbar navbar-expand-lg bg-body-tertiary">
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
          <a class="nav-link " href="update_profile.php?id=1">Update Profile</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


    <div class="jobs table">
        <table class="table-bordered">
            <tr>
                <th>S no.</th>
                <th>Job Title</th>
                <th>Job Status</th>
                <th>Job Post Date</th>
                <th>Job Close Date</th>
                <th>Job Description</th>
                <th>Apply</th>
            </tr>
            <?php
                $i=1;
                while($row_jobs=$result_jobs->fetch_assoc()){
            ?>
                    <?php   echo "<tr>";?>
                    <?php   echo "<td>".$i++." </td>";?>
                    <?php   echo"<td>".$row_jobs['job_title']."   </td>";?>
                    <?php   echo "<td>".$row_jobs['status']."   </td>";?>
                    <?php   echo "<td>".$row_jobs['post_date']."   </td>";?>
                    <?php   echo "<td>".$row_jobs['close_date']."   </td>";?>
                    <?php   echo "<td>".$row_jobs['job_description']."   </td>";?>
                    <?php   echo "<td>".$row_jobs['id']."   </td>";?>
                    <?php   echo "<td>";?>
                        <form   action="<?php  
                        $idd=$row_jobs['id']; 
                        echo "apply.php?id=$idd"?>" method="get">
                            <input type="hidden" value="<?php echo $row_jobs['id'] ?>" name="job_id"> 
                            <button>Apply</button>
                        </form>
                    <?php   echo "</td>";?>
                    <?php echo "</tr>";?>
                    
                <?php }?>
            ?>
        </table>
    </div>


    <div>
        <table class="table-bordered">
            <tr>
                <th>Job Id</th>
                <th>Submitted CV</th>
                <th>Application Status</th>
            </tr>
            <?php
                while($row=$result->fetch_assoc()){
                    echo "<tr>";
                        echo "<td>".$row['job_id']." </td>";
                        echo "<td>".$row['applicant_id']."   </td>";
                        echo "<td>".$row['CV']."   </td>";
                        echo "<td>".$row['status']."   </td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>



</body>
</html>
