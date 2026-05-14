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
    

    $limit = 5;
    $page = (int)($_GET['page'] ?? 1);
    if($page < 1) $page = 1;
    $total_jobs = (int)$conn->query("select count(*) as total from jobs")->fetch_assoc()['total'];
    $total_pages = (int)ceil($total_jobs / $limit);
    $offset = ($page - 1) * $limit;
    $sql_jobs = "select * from jobs order by id desc limit $limit offset $offset";

    $app_limit = 5;
    $app_page = (int)($_GET['app_page'] ?? 1);
    if($app_page < 1) $app_page = 1;
    $total_applications = (int)$conn->query("select count(*) as total from applications where applicant_id=".$_SESSION['user_id'])->fetch_assoc()['total'];
    $total_app_pages = (int)ceil($total_applications / $app_limit);
    $app_offset = ($app_page - 1) * $app_limit;
    $sql_applications = "select * from applications where applicant_id=".$_SESSION['user_id']." order by id desc limit $app_limit offset $app_offset";
    $result_jobs=$conn->query($sql_jobs);
    $result_applications=$conn->query($sql_applications);

    
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
        .apply-btn {
            min-width: 86px;
        }
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 18px;
            text-align: center;
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
          <a class="nav-link " href="update_profile.php?id=1">Update Profile</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <div class="dashboard-wrap">
    <div class="container">
        <h1 class="page-title">Available Jobs</h1>
        <div class="card shadow-sm jobs-card mb-4">
        <div class="table-responsive">
        <table class="table table-bordered table-hover mb-0">
            <thead>
            <tr>
                <th>S no.</th>
                <th>Job Title</th>
                <th>Job Status</th>
                <th>Job Post Date</th>
                <th>Job Close Date</th>
                <th>Job Description</th>
                <th>Apply</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $i=$offset + 1;
                while($row_jobs=$result_jobs->fetch_assoc()){
            ?>
                    <?php   echo "<tr>";?>
                    <?php   echo "<td>".$i++." </td>";?>
                    <?php   echo"<td>".$row_jobs['job_title']."   </td>";?>
                    <?php   echo "<td>".$row_jobs['status']."   </td>";?>
                    <?php   echo "<td>".$row_jobs['post_date']."   </td>";?>
                    <?php   echo "<td>".$row_jobs['close_date']."   </td>";?>
                    <?php   echo "<td>".$row_jobs['job_description']."   </td>";?>
                    <!-- <?php   echo "<td>".$row_jobs['id']."   </td>";?> -->
                    <?php   echo "<td>";?>
                        <form   action="<?php  
                        $idd=$row_jobs['id']; 
                        echo "apply.php?id=$idd"?>" method="get">
                            <input type="hidden" value="<?php echo $row_jobs['id'] ?>" name="job_id"> 
                            <button class="btn btn-primary btn-sm apply-btn">Apply</button>
                        </form>
                    <?php   echo "</td>";?>
                    <?php echo "</tr>";?>
                    
                <?php }
            ?>
            </tbody>
        </table>
        </div>
        </div>
        <nav class="mt-3">
            <ul class="pagination justify-content-center mb-0">
                <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>&app_page=<?php echo $app_page; ?>">Previous</a>
                </li>
                <li class="page-item disabled">
                    <span class="page-link"><?php echo $page; ?> / <?php echo $total_pages; ?></span>
                </li>
                <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>&app_page=<?php echo $app_page; ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>

    <h1 class="page-title">My Applications</h1>
    <div class="container">
        <div class="card shadow-sm jobs-card">
        <div class="table-responsive">
        <table class="table table-bordered table-hover mb-0">
            <thead>
            <tr>
                <th>Job Id</th>
                <th>Submitted CV</th>
                <th>CV</th>
                <th>Application Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
                while($row=$result_applications->fetch_assoc()){
                    echo "<tr>";
                        echo "<td>".$row['job_id']." </td>";
                        echo "<td>".$row['applicant_id']."   </td>";
                        echo "<td><a href='".$row['cv']."'>".$row['cv']."</a></td>";
                        echo "<td>".$row['status']."   </td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
        </div>
        </div>
        <nav class="mt-3">
            <ul class="pagination justify-content-center mb-0">
                <li class="page-item <?php echo ($app_page <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page; ?>&app_page=<?php echo $app_page - 1; ?>">Previous</a>
                </li>
                <li class="page-item disabled">
                    <span class="page-link"><?php echo $app_page; ?> / <?php echo $total_app_pages; ?></span>
                </li>
                <li class="page-item <?php echo ($app_page >= $total_app_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page; ?>&app_page=<?php echo $app_page + 1; ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
    </div>



</body>
</html>
