<?php
    require '../db/db.php';

    if(isset($sonn))echo "error hai <br><br>";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        // $user_id=$_POST['user_id'];
        $role=$_POST['role'];
        $username=$_POST['username'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
        $phone_no=$_POST['phone_no'];
        $image_url=$_POST['image_url'];

        $sql="insert into users (role,username,name,email,password,phone_no,image_url) values ('$role','$username','$name','$email','$password','$phone_no','$image_url')";
        echo "<br>";
        // print_r ($_POST);
        echo "<br>";

        if($conn->query($sql) === true){
            // echo "data entered successfuly";
            header("location:/tushar/pages/login.php");
        }else{
              echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>