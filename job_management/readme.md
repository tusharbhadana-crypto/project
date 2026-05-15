CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    role ENUM('Admin', 'Recruiter', 'Applicant') NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone_no VARCHAR(20) DEFAULT NULL,
    image_url VARCHAR(255) DEFAULT NULL
);



job tables
CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_title VARCHAR(255) NOT NULL,
    job_description TEXT NOT NULL,
    recruiter_id INT NOT NULL,
    post_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    close_date DATE,
    status ENUM('active', 'closed') DEFAULT 'active',
    FOREIGN KEY (recruiter_id) REFERENCES users(user_id)
);



create table applications (
	id int AUTO_INCREMENT PRIMARY KEY,
    job_id int NOT null,
    applicant_id int not null,
    cv varchar(255),
    status enum('applied','shorlisted','rejected','interview_call')DEFAULT 'applied',
    FOREIGN KEY (applicant_id) REFERENCES users(user_id) ,
    FOREIGN KEY (job_id) REFERENCES jobs(id)
);












                    <?php   echo "<td>";?>
                        <form   action="<?php  
                            $idd=$new_row['user_id'];
                            echo "dashboard.php?id=$idd"?>" method="get">
                                <input type="hidden" value="<?php echo $new_row['user_id'] ?>" name="user_id"> 
                            <button class="btn btn-primary btn-sm apply-btn">Delete User</button>
                        </form>
                    <?php   echo "</td>";?>


















    <h1 class="page-title">All Jobs</h1>
    <div class="container">
        <div class="card shadow-sm jobs-card">
        <div class="table-responsive">
        <table class="table table-bordered table-hover mb-0">
            <thead>
            <tr>
                <th>Job Id</th>
                <th>Submitted CV</th>
                <th>CV</th>
                <th>Application Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
                while($row=$result_applications->fetch_assoc()){
                    echo "<tr>";
                        echo "<td>".$row['job_id']." </td>";
                        echo "<td>".$row['applicant_id']."   </td>";
                        echo "<td><a href='".$row['cv']."'>".$row['cv']."</a></td>";
                        echo "<td>".$row['status']."   </td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
        </div>
        </div>
        <nav class="mt-3">
            <ul class="pagination justify-content-center mb-0">
                <li class="page-item <?php echo ($app_page <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page; ?>&app_page=<?php echo $app_page - 1; ?>">Previous</a>
                </li>
                <li class="page-item disabled">
                    <span class="page-link"><?php echo $app_page; ?> / <?php echo $total_app_pages; ?></span>
                </li>
                <li class="page-item <?php echo ($app_page >= $total_app_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page; ?>&app_page=<?php echo $app_page + 1; ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>