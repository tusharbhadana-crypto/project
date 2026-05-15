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
    if($_SESSION['role']!=="Admin"){
        echo "<script>
        alert('You do not have access to this page go back to login');
        window.location.href='../login.php';
        </script>";
        exit();
    }
    require '../../db/db.php';
    $user_code=$_SESSION['user_code'];
   

    $sql = "select user_id , username, name,email, phone_no, image_url from users where user_id=".$_SESSION['user_id'];;
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();


    $_SESSION['user_id']=$row['user_id'];
    // $_SESSION['role']=$row['role'];
    $_SESSION['username']=$row['username'];
    $_SESSION['name']=$row['name'];
    $_SESSION['email']=$row['email'];
    $_SESSION['image_url']=$row['image_url'];

    



    $tabs=5;
    $page_count_sql="select count(*) as pagess from users where role in ('Applicant' , 'Recruiter') ";
    $ans=$conn->query($page_count_sql);
    $data_count=$ans->fetch_assoc()['pagess'];
    $no_of_pages=ceil($data_count/$tabs);
    $current_page= isset($_GET['current_page']) ? $_GET['current_page']:1;
    $current_page=max(1,min($current_page,$no_of_pages));
    // $app_page = isset($_GET['app_page']) ? (int)$_GET['app_page'] : 1;
    $start_limit=($current_page-1)*$tabs;
    $pagination_sql="select * from users where role in ('Applicant' , 'Recruiter')  limit ".$start_limit.",".$tabs;
    // echo("ye start page  =>".$start_limit);
        // echo $pagination_sql;

    $new_result=$conn->query($pagination_sql);

    
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
        <h1 class="page-title">Available Users</h1>
        <div class="card shadow-sm jobs-card mb-4">
        <div class="table-responsive">
        <table class="table table-bordered table-hover mb-0">
            <thead>
            <tr>
                <th>S no.</th>
                <th>username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Phone_no</th>
                <!-- <th>Delete</th> -->
            </tr>
            </thead>
            <tbody>
            <?php
                $i=$start_limit + 1;
                while($new_row=$new_result->fetch_assoc()){
            ?>
                    <?php   echo "<tr>";?>
                    <?php   echo "<td>".$i++." </td>";?>
                    <?php   echo"<td>".$new_row['username']."   </td>";?>
                    <?php   echo "<td>".$new_row['name']."   </td>";?>
                    <?php   echo "<td>".$new_row['email']."   </td>";?>
                    <?php   echo "<td>".$new_row['role']."   </td>";?>
                    <?php   echo "<td>".$new_row['phone_no']."   </td>";?>



                    <?php echo "</tr>";?>
                    
                <?php }
            ?>
            </tbody>
        </table>
        </div>
        </div>
        <nav class="mt-3">
            <ul class="pagination justify-content-center mb-0">
                <li class="page-item <?php echo ($current_page <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?current_page=<?php echo $current_page - 1; ?>&app_page=<?php echo $app_page; ?>">Previous</a>
                </li>
                <li class="page-item disabled">
                    <span class="page-link"><?php echo $current_page; ?> / <?php echo $no_of_pages; ?></span>
                </li>
                <li class="page-item <?php echo ($current_page >= $no_of_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?current_page=<?php echo $current_page + 1; ?>&app_page=<?php echo $app_page; ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>



    
    </div>



</body>
</html>
