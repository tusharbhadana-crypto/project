job tables
CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_title VARCHAR(255) NOT NULL,
    job_description TEXT NOT NULL,
    recruiter_id INT NOT NULL,
    post_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    close_date DATE,
    status ENUM('active', 'closed') DEFAULT 'active',
    FOREIGN KEY (recruiter_id) REFERENCES users(id)
);