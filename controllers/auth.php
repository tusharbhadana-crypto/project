<?php
    
    require '../db/db.php';
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $username=$_POST['username'];
        
        $password=$_POST['password'];
    }
    
    $sql="select password from users where username='$username' OR email = '$username' ";
        // if(strpos($username,'@')!==false){
        //     $sql="select password from users where email='$username'";
        //     // echo "email";
        // }else{
        //     $sql="select password from users where username='$username'";
        //     // echo "username";
        // }
    $result=$conn->query($sql);
    if($result->num_rows>0){
        $row=$result->fetch_assoc();
        if(password_verify($password,$row['password'])){
            session_start();
            $_SESSION['user_code']=$username;
            header("location:/tushar/pages/dashboard.php");
        }else{
            header("location:/tushar/pages/login.php?password_error=wrong password");
        }
    }else{
        header("location:/tushar/pages/login.php?username_error=username does not exists");
    }

    
?>