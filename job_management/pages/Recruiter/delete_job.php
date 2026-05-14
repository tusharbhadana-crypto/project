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
    if(!empty($_GET['id'])){
        $sql="delete from jobs where id=".$_GET['id'];
        if($conn->query($sql)===true){
            echo "<script>
            alert('Job deleted successfully');
            window.location.href='../dashboard.php';
            </script>";
        }
    }
?>
