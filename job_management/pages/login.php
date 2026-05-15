<?php
    session_start();
    if(isset($_SESSION['login'])){
        $role=$_SESSION['role'];
        echo "<script> alert('please logout first');
        window.location.href='$role/dashboard.php';
        </script>;
        ";
        exit();
    }

    require '../db/db.php';


    $username_error="";
    $pass_error=false;
    
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['username']) && isset($_POST['password'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        
        if((preg_match("/^[a-zA-Z0-9_]+$/", $username)||filter_var($username, FILTER_VALIDATE_EMAIL))){
            $username_error="enter correct username/email";
        }
        $sql="select user_id,role,password from users where username='$username' OR email = '$username' ";

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
                header("location:/tushar/job_management/pages/".$_SESSION['role']."/dashboard.php");
            }else{
                $pass_error=true;
            }
        }else{
            $username_error="username does not exist";
        }
    }


    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body {
            background-color: #f3f5f7;
            min-height: 100vh;
        }
        .page-wrap {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 12px;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            border: 0;
            border-radius: 12px;
        }
    </style>
</head>
<body>

    <div class="page-wrap">
    <div class="card shadow login-card p-4">

        <div class="card-body">

            <h3 class="text-center mb-4">Login</h3>

            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

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
                <p class="text-center mt-3 mb-0">
                    Don't have an account?
                    <a href="/tushar/job_management/pages/sign_up.php">Sign Up</a>
                </p>

            </form>

        </div>

    </div>
    </div>

</body>
</html>
