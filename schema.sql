-- Create the database for the Bloom & Brew job application system
CREATE DATABASE IF NOT EXISTS bloom_brew_db;

-- Select the database to use
USE bloom_brew_db;

-- Create the job applications table
CREATE TABLE IF NOT EXISTS job_applications (
    application_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    position_applied VARCHAR(100) NOT NULL,
    department VARCHAR(50) NOT NULL,
    years_experience INT NOT NULL DEFAULT 0,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
