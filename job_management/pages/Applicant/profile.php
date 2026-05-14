<?php
    session_start();
    if($_SESSION['login']!==true){
        header("location:../login.php");
    }
    if($_SESSION['role']!=="Applicant"){
        header("location:../login.php");
    }
    if($_SERVER['REQUEST_METHOD']==='POST'){
        session_destroy();
        header("location:../login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">Job Managment</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link " aria-current="page" href="dashboard.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link  active" href="profile.php">Profile</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="update_profile.php?id=1">Update Profile</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    <div class="container mt-5">

        <div class="card shadow mx-auto" style="max-width: 500px;">

            <div class="card-body text-center">

                <img 
                    src="<?php echo $_SESSION['image_url']; ?>" 
                    class="rounded-circle mb-3"
                    width="150"
                    height="150"
                    alt="Profile Image"
                >

                <h3>
                    <?php echo $_SESSION['name']; ?>
                </h3>

                <p class="text-muted">
                    @<?php echo $_SESSION['username']; ?>
                </p>

                <hr>

                <div class="text-start">

                    <p>
                        <strong>Role:</strong>
                        <?php echo $_SESSION['role']; ?>
                    </p>

                    <p>
                        <strong>Email:</strong>
                        <?php echo $_SESSION['email']; ?>
                    </p>

                    <p>
                        <strong>Username:</strong>
                        <?php echo $_SESSION['username']; ?>
                    </p>

                    <p>
                        <strong>Name:</strong>
                        <?php echo $_SESSION['name']; ?>
                    </p>

                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">

                    <button  name="submit_btn">
                         Log Out
                    </button>

                </form>

            </div>

        </div>

    </div>

</body>
</html>
</body>
</html>