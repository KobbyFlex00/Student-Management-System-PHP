<?php
session_start();
// If the user session variable is NOT set, kick them back to login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cyber200";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// 1. Capture the POST data
$id = $_POST['sid'];
$name = $_POST['fname'];
$age = $_POST['age'];
$email = $_POST['email'];

// 2. Prepare the UPDATE Statement
// "UPDATE table SET col=val, col=val WHERE id=target"
$stmt = $conn->prepare("UPDATE students SET fullname=?, age=?, email=? WHERE id=?");

// 3. Bind Parameters (Order matters!)
// name(s), age(i), email(s), id(s) -> "siss"
$stmt->bind_param("siss", $name, $age, $email, $id);

// 4. Execute
if ($stmt->execute()) {
    echo "<h1>✅ Updated Successfully!</h1>";
    echo "<p>Record for ID $id has been changed.</p>";
    echo "<a href='view_students.php'>Return to List</a>";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>