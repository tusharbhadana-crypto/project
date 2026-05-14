<?php
    session_start();
    require '../../db/db.php';
    if($_SESSION['login']!==true){
        die("login required");
    }
    if(!empty($_GET['id'])){
        $sql="delete from jobs where id=".$_GET['id'];
        if($conn->query($sql)===true){
            header("location:../dashboard.php");
        }
    }
?>
