<?php
// register_admin.php - Run this ONCE to create your account
$servername = "localhost"; $username = "root"; $password = ""; $dbname = "cyber200";

$conn = new mysqli($servername, $username, $password, $dbname);

// CHANGE THESE TO WHAT YOU WANT
$new_user = "admin";
$new_pass = "securepass123"; 

// 1. Hash the password (The most important line!)
// PASSWORD_DEFAULT uses the Bcrypt algorithm, standard for security.
$hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);

// 2. Insert into DB
$sql = "INSERT INTO admins (username, password) VALUES ('$new_user', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "<h1>Admin Created!</h1>";
    echo "<p>User: $new_user</p>";
    echo "<p>Password: $new_pass</p>";
    echo "<p>stored Hash: $hashed_password</p>";
    echo "<a href='login.php'>Go to Login</a>";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>