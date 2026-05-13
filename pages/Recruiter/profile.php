<?php
    session_start();
    if($_SESSION['login']!==true){
        die("login required");
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
                <form method="POST">

                    <button 
                    //action="$_SERVER[PHP_SELF]"  name="submit_btn"
                    >
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