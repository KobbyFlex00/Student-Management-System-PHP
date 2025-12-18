<?php
session_start(); // 1. Start the session

// 2. Security Check: If not logged in, go to login page
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

$sql = "SELECT id, fullname, age, email, reg_date FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <style>
        table { border-collapse: collapse; width: 100%; font-family: sans-serif; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        tr:hover { background-color: #f5f5f5; }
        .del-btn { color: red; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <h2>Registered Students</h2>
    <p>
        Logged in as: <strong><?php echo htmlspecialchars($_SESSION['admin_name']); ?></strong> | 
        <a href="logout.php">Logout</a>
    </p>
</div>

<table>
  <tr>
    <th>ID</th>
    <th>Full Name</th>
    <th>Age</th>
    <th>Email</th>
    <th>Date Registered</th>
    <th>Action</th>
  </tr>

<?php
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["fullname"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["age"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["reg_date"]) . "</td>";
    
    echo "<td>
            <a href='edit_student.php?id=" . $row["id"] . "'>Edit</a>
            | 
            <a href='delete_student.php?id=" . $row["id"] . "' 
            class='del-btn'
            onclick='return confirm(\"Are you sure?\");'>
            Delete
            </a>
          </td>";
    
    echo "</tr>";
  }
} else {
  echo "<tr><td colspan='6'>No students found</td></tr>";
}
$conn->close();
?>

</table>
<br>
<a href="form.html">Add New Student</a>

</body>
</html>