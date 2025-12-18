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

// 1. Check if ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // 2. Fetch the student's current data
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    // If no student found (e.g., bad ID), stop.
    if (!$row) { die("Student not found!"); }
} else {
    die("No ID provided!");
}
?>

<!DOCTYPE html>
<html>
<body style="font-family: sans-serif; padding: 20px;">

<h2>Edit Student Details</h2>

<form action="update_processor.php" method="post">
  
  <label>Student ID (Cannot change):</label><br>
  <input type="text" name="sid" value="<?php echo $row['id']; ?>" readonly 
         style="background-color: #ccc;"><br><br>

  <label>Full Name:</label><br>
  <input type="text" name="fname" value="<?php echo htmlspecialchars($row['fullname']); ?>" required><br><br>

  <label>Age:</label><br>
  <input type="number" name="age" value="<?php echo $row['age']; ?>" min="16" max="99"><br><br>

  <label>Email:</label><br>
  <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required><br><br>

  <input type="submit" value="Update Student">
  <br><br>
  <a href="view_students.php">Cancel</a>

</form>

</body>
</html>