<?php
// Get the phone number and message from the form
$phone = $_POST['phone'];
$message = $_POST['message'];

// Create a connection to the MySQL database
$host = "localhost";
$username = "send_messages";
$password = "12345";
$database = "child_immune_db";
$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Insert the phone number and message into the database
$sql = "INSERT INTO sms_messages (phone, message) VALUES ('$phone', '$message')";
if (mysqli_query($conn, $sql)) {
    echo "SMS message sent!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
