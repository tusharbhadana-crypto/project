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

