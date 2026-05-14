<?php
    $username="root";
    $pass="phpmyadmin";
    $server="localhost";
    $dbname="job_portal";

    $conn=new mysqli($server,$username,$pass,$dbname);
    if($conn->connect_error){
        die("the error occured id  :-- $conn->connect_error");
    }{
        echo "db connected successfully";
    }
?>