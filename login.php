<?php
session_start(); // Start the session engine

$servername = "localhost"; $username = "root"; $password = ""; $dbname = "cyber200";
$conn = new mysqli($servername, $username, $password, $dbname);

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // 1. Find the user
    $stmt = $conn->prepare("SELECT id, username, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // 2. Verify the password hash
        if (password_verify($pass, $row['password'])) {
            // ✅ Success! Create the "ID Card"
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_name'] = $row['username'];
            
            header("Location: view_students.php"); // Redirect inside
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body style="font-family: sans-serif; text-align: center; padding-top: 50px;">
    
    <h2>Restricted Access</h2>
    
    <form method="post" style="display: inline-block; text-align: left; border: 1px solid #ccc; padding: 20px;">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" value="Login">
        <p style="color: red;"><?php echo $error; ?></p>
    </form>

</body>
</html>