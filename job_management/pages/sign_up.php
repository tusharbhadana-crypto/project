<?php
    require '../db/db.php';
    $error="";
    $email_error="";
    if(isset($sonn))echo " db error hai <br><br>";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        // $user_id=$_POST['user_id'];
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 400px;">

        <div class="card-body">

            <h3 class="text-center mb-4">Register</h3>

            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <!-- <input 
                        type="text" 
                        name="role" 
                        class="form-control"
                        placeholder="Enter role"
                        
                    > -->
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
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
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
                        required
                    >
                </div>
        <?php
            if($error!==""){
                echo "<div style=\"color: red;\">wrong password</div>";
            }
        ?>
                <button type="submit" class="btn btn-primary w-100">
                    Register
                </button>

            </form>

        </div>

    </div>

</body>
</html>