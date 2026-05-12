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

            <form action="/tushar/controllers/auth.php" method="post">

                <div  class="mb-3">
                    <label class="form-label">
                        Username / Email
                    </label>

                    <input 
                        type="text" 
                        name="username" 
                        class="form-control"
                        placeholder="Enter username or email"
                    >
                </div>
        <?php
            if(isset($_GET['username_error'])){
                echo "<div style=\"color: red;\">".$_GET['username_error']."</div>";
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
                    >
                </div>
        <?php
            if(isset($_GET['password_error'])){
                echo "<div style=\"color: red;\">".$_GET['password_error']."</div>";
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