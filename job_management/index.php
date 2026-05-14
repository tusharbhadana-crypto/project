
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body {
            background-color: #f3f5f7;
            min-height: 100vh;
        }
        .hero-wrap {
            padding: 56px 12px 40px;
        }
        .hero-card {
            width: 100%;
            max-width: 980px;
            border: 0;
            border-radius: 12px;
        }
        .brand-badge {
            display: inline-block;
            background: #0d6efd;
            color: #fff;
            font-size: 0.8rem;
            font-weight: 600;
            border-radius: 999px;
            padding: 6px 12px;
            margin-bottom: 12px;
        }
        .hero-title {
            font-size: 2.1rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 10px;
        }
        .hero-text {
            color: #4b5563;
            margin-bottom: 24px;
        }
        .feature-card {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 16px;
            height: 100%;
        }
        .feature-card h5 {
            margin-bottom: 8px;
            font-weight: 600;
        }
        .feature-card p {
            margin-bottom: 0;
            color: #6b7280;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>

    <div class="container hero-wrap">
    <div class="card shadow p-4 p-md-5 hero-card">
        <div class="row g-4 align-items-center">
            <div class="col-lg-7">
                <span class="brand-badge">Job Management</span>
                <h1 class="hero-title">Connect Recruiters And Applicants In One Place</h1>
                <p class="hero-text">
                    Post jobs, manage applications, and apply with confidence. 
                    A simple portal for recruiters to hire faster and applicants to find the right opportunity.
                </p>
                <div class="d-flex flex-column flex-sm-row gap-2">
                    <a href="/tushar/job_management/pages/sign_up.php" class="btn btn-primary px-4">Create Account</a>
                    <a href="/tushar/job_management/pages/login.php" class="btn btn-outline-primary px-4">Sign In</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="feature-card mb-3">
                    <h5>For Recruiters</h5>
                    <p>Post jobs, track applicants, and update job status from your dashboard.</p>
                </div>
                <div class="feature-card mb-3">
                    <h5>For Applicants</h5>
                    <p>Browse openings, upload CV, and monitor application status easily.</p>
                </div>
                <div class="feature-card">
                    <h5>Fast Workflow</h5>
                    <p>Everything from registration to hiring progress is available in one portal.</p>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>



</html>
