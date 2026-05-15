<?php

    session_start();
    if($_SESSION['login']!==true){
        echo "<script>
        alert('You are not logged in go back to login');
        window.location.href='../login.php';
        </script>";
        exit();
    }

    if($_SESSION['role']!=="Admin"){
        echo "<script>
        alert('You do not       have access to this page go back to login');
        window.location.href='../login.php';
        </script>";
        exit();
    }

  
    if($_SERVER['REQUEST_METHOD']===''){
        session_destroy();
        echo "<script>
        alert('You have been logged out');
        window.location.href='../login.php';
        </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f3f5f7;
            min-height: 100vh;
        }
        .page-wrap {
            min-height: calc(100vh - 72px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 12px;
        }
        .profile-card {
            width: 100%;
            max-width: 520px;
            border: 0;
            border-radius: 12px;
        }
        .profile-avatar {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.12);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm">
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
    <div class="page-wrap">

        <div class="card shadow profile-card">

            <div class="card-body text-center">

                <img 
                    src="<?php echo $_SESSION['image_url']; ?>" 
                    class="rounded-circle mb-3 profile-avatar"
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

                    <button class="btn btn-danger mt-2 px-4" name="submit_btn">
                         Log Out
                    </button>

                </form>

            </div>

        </div>

    </div>
    </div>

</body>
</html>
