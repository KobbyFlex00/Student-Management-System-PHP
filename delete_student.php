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

// 1. Check if an ID was passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 2. Prepare the DELETE Statement
    // We delete WHERE id matches the parameter.
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("s", $id);

    // 3. Execute
    if ($stmt->execute()) {
        // If successful, redirect back to the view page immediately
        header("Location: view_students.php");
        exit(); // Stop script execution
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $stmt->close();
} else {
    echo "No ID provided!";
}

$conn->close();
?>