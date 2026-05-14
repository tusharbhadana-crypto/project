<?php
    session_start();
    require '../../db/db.php';


    if($_SESSION['login']!==true){
        header("location:../login.php");
    }
    if($_SESSION['role']!=="Recruiter"){
        header("location:../login.php");
    }
    $error="";
    $email_error="";
    
    if(isset($_GET) && (!empty($_GET['id']))){
        $sql="select * from users where user_id=".$_SESSION['user_id'];
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
        
        if(empty($_POST['role']) ||  empty($_POST['username'])  ||  empty($_POST['name']) ||  empty($_POST['email']) ||  empty($_POST['password']) ||  empty($_POST['phone_no']) || empty($_POST['image_url'])){
            $error="all fields required";
        }
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $email_error="incorrect email";
        }

        $role=$_POST['role'];
        $username=$_POST['username'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
        $phone_no=$_POST['phone_no'];
        $image_url=$_POST['image_url'];

        // $sql_pass="update users set
        // password='$password'
        // where user_id=".$_SESSION['user_id'];


        $sql="update  users set 
        role  = '$role',
        username  ='$username',
        name ='$name',
        email  ='$email',
        password='$password',
        phone_no ='$phone_no',
        image_url='$image_url'
        where user_id=".$_SESSION['user_id'];
        echo "<br>";
        echo "<br>";

        if($conn->query($sql) === true){
            header("location:/tushar/job_management/pages/".$_SESSION['role']."/dashboard.php");
        }else{
              echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 400px;">

        <div class="card-body">

            <h3 class="text-center mb-4">Register</h3>

            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    
                    <select name="role" id="" class="form-select" required>
                        <option value="" selected disabled>Select Role</option>
                        <option value="Recruiter">Recruiter</option>
                        <option value="Applicant">Applicant</option>
                        
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input 
                        type="text" 
                        name="username" 
                        class="form-control"
                        placeholder="Enter username"
                        value="<?php echo $row['username']?>"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input 
                        type="text" 
                        name="name" 
                        class="form-control"
                        placeholder="Enter name"
                        value="<?php echo $row['name']?>"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control"
                        placeholder="Enter email"
                        value="<?php echo $row['email']?>"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Enter New Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control"
                        placeholder="Enter password"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input 
                        type="text" 
                        name="phone_no" 
                        class="form-control"
                        placeholder="Enter phone number"
                        value="<?php echo $row['phone_no']?>"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Image URL</label>
                    <input 
                        type="text" 
                        name="image_url" 
                        class="form-control"
                        placeholder="Enter image URL"
                        value="<?php echo $row['image_url']?>"
                        required
                    >
                </div>
//        <?php
//            if($error!==""){
//                echo "<div style=\"color: red;\">wrong password</div>";
//            }
//        ?>
                <button type="submit" class="btn btn-primary w-100">
                    Update Profile
                </button>

            </form>

        </div>

    </div>

</body>
</html>