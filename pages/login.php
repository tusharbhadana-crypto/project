<?php
    
    require '../db/db.php';

    $username_error="";
    $pass_error=false;
    
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $username=$_POST['username'];
        
        $password=$_POST['password'];
    }
    if((preg_match("/^[a-zA-Z0-9_]+$/", $username)||filter_var($username, FILTER_VALIDATE_EMAIL))){
        $username_error="enter correct username/email";
    }
    $sql="select user_id,role,password from users where username='$username' OR email = '$username' ";
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
            $username_error="";
            $pass_error=false;
            session_start();
            $_SESSION['login']=true;
            $_SESSION['user_id']=$row['user_id'];
            $_SESSION['user_code']=$username;
            $_SESSION['role']=$row['role'];
            header("location:/tushar/pages/".$_SESSION['role']."/dashboard.php");
        }else{
            $pass_error=true;
        }
    }else{
        $username_error="username does not exist";
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 350px;">

        <div class="card-body">

            <h3 class="text-center mb-4">Login</h3>

            <form action="<?php echo $_SERVER['PHP_SHELF']?>" method="post">

                <div  class="mb-3">
                    <label class="form-label">
                        Username / Email
                    </label>

                    <input 
                        type="text" 
                        name="username" 
                        class="form-control"
                        placeholder="Enter username or email"
                        required
                    >
                </div>
        <?php
            if($username_error!==""){
                echo "<div style=\"color: red;\">.$username_error.</div>";
            }
        ?>

                <div class="mb-3">
                    <label class="form-label">
                        Password
                    </label>

                    <input 
                        type="password" 
                        name="password" 
                        class="form-control"
                        placeholder="Enter password"
                        required
                    >
                </div>
        <?php
            if($pass_error){
                echo "<div style=\"color: red;\">wrong password</div>";
            }
        ?>

                <button type="submit" class="btn btn-primary w-100">
                    Login
                </button>

            </form>

        </div>

    </div>

</body>
</html>