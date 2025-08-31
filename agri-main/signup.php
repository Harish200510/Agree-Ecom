<?php
include 'dbconnect.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$phone = $_POST['phone'];

// Check if username or email already exists
$sql_check = "SELECT * FROM users WHERE username='$username' OR email='$email'";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    echo "Username or Email already taken!";
    exit;
}

// Insert user into database
$sql = "INSERT INTO users (username, email, password, phone)
        VALUES ('$username', '$email', '$password', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
