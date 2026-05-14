
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal</title>
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
        .home-card {
            width: 100%;
            max-width: 380px;
            border: 0;
            border-radius: 12px;
        }
    </style>
</head>
<body>

    <div class="page-wrap">
    <div class="card shadow p-4 text-center home-card">

        <h3 class="mb-4">Welcome</h3>

        <a 
            href="/tushar/job_management/pages/sign_up.php" 
            class="btn btn-primary w-100 mb-3"
        >
            Sign Up
        </a>

        <p class="text-muted mb-2">
            Already have an account?
        </p>

        <a 
            href="/tushar/job_management/pages/login.php" 
            class="btn btn-outline-primary w-100"
        >
            Sign In
        </a>

    </div>
    </div>

</body>



</html>
