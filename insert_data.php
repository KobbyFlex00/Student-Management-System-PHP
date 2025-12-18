<?php
session_start(); // 1. Start the session

// 2. Security Check: Lock the door
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// 3. Database Configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cyber200";

// 4. Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// 5. Capture Data
$id = $_POST['sid'];
$name = $_POST['fname'];
$age = $_POST['age'];
$email = $_POST['email'];

// 6. Secure Insert
$stmt = $conn->prepare("INSERT INTO students (id, fullname, age, email) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssis", $id, $name, $age, $email);

if ($stmt->execute()) {
    echo "<h1>✅ Success!</h1>";
    echo "<p>Student <strong>$name</strong> (ID: $id) has been registered.</p>";
    echo "<br><a href='form.html'>Add Another Student</a> | <a href='view_students.php'>View List</a>";
} else {
    echo "<h1>❌ Error</h1>";
    echo "<p>Could not register student.</p>";
    echo "<p>MySQL Error: " . $stmt->error . "</p>";
}

$stmt->close();
$conn->close();
?>