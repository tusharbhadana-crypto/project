<?php
    session_start();
    require '../../db/db.php';
    if($_SESSION['login']!==true){
        header("location:../login.php");
    }
    if($_SESSION['role']!=="Recruiter"){
        header("location:../login.php");
    }
    if(!empty($_GET['id'])){
        $sql="delete from jobs where id=".$_GET['id'];
        if($conn->query($sql)===true){
            header("location:../dashboard.php");
        }
    }
?>
