<?php
include 'dbconnect.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Check if user exists
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    
    // Verify password
    if (password_verify($password, $row['password'])) {
        echo "success";
    } else {
        echo "Invalid password.";
    }
} else {
    echo "User not found.";
}

$stmt->close();
$conn->close();
?>
