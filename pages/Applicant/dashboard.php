<?php
    session_start();

    if($_SESSION['login']!==true){
        die("login required ");
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="profile.php">Profile</a>
    <a href="tushar/pages">ghfgndfgh</a>
</body>
</html>
