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

            <form action="/tushar/controllers/register.php" method="post">

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <!-- <input 
                        type="text" 
                        name="role" 
                        class="form-control"
                        placeholder="Enter role"
                        
                    > -->
                    <select name="role" id="" class="form-select">
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
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input 
                        type="text" 
                        name="name" 
                        class="form-control"
                        placeholder="Enter name"
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control"
                        placeholder="Enter email"
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control"
                        placeholder="Enter password"
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input 
                        type="text" 
                        name="phone_no" 
                        class="form-control"
                        placeholder="Enter phone number"
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Image URL</label>
                    <input 
                        type="text" 
                        name="image_url" 
                        class="form-control"
                        placeholder="Enter image URL"
                    >
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Register
                </button>

            </form>

        </div>

    </div>

</body>
</html>