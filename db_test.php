<?php
// XAMPP default settings
$servername = "localhost";
$username = "root";       // Default XAMPP user
$password = "";           // Default XAMPP password is empty

// 1. Create connection
$conn = new mysqli($servername, $username, $password);

// 2. Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
} 
echo "<h1>✅ Success!</h1>";
echo "<p>PHP successfully connected to your MySQL database.</p>";
echo "<p>Host info: " . $conn->host_info . "</p>";

// 3. Close connection
$conn->close();
?>