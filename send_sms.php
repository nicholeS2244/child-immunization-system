<?php
// MySQL database connection parameters
$host = "localhost";
$username = "root";
$password = "password";
$dbname = "child_immune_db";

// Connect to MySQL database
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the child_immune_db database
$conn->select_db($dbname);

// Create table for send_messages
$sql = "CREATE TABLE IF NOT EXISTS sms_reminders (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    child_name VARCHAR(30) NOT NULL,
    vaccine_name VARCHAR(30) NOT NULL,
    due_date DATE NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    sent BOOLEAN NOT NULL DEFAULT FALSE,
    sent_date DATETIME DEFAULT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close MySQL connection
$conn->close();
?>
