<?php
// Database config (UPDATE THESE VALUES)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');       // Default XAMPP username
define('DB_PASS', '');           // Default XAMPP password (blank)
define('DB_NAME', 'lab_7');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = $conn->real_escape_string($_POST['matric']);
    $name = $conn->real_escape_string($_POST['name']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $conn->real_escape_string($_POST['role']);

    $sql = "INSERT INTO users (matric, name, password, role) VALUES ('$matric', '$name', '$password', '$role')";
    
    if ($conn->query($sql)) {
        header("location: users.php");
        $message = "Registration successful!";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; }
        button { background: #4CAF50; color: white; padding: 10px; border: none; cursor: pointer; }
        .message { color: green; margin-top: 10px; }
        .error { color: red; }
    </style>
</head>
<body>
    <h2>User Registration</h2>
    <?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    
    <form method="POST">
        <div class="form-group">
            <label>Matric Number:</label>
            <input type="text" name="matric" required>
        </div>
        <div class="form-group">
            <label>Full Name:</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            <label>Role:</label>
            <select name="role" required>
                <option value="">Select Role</option>
                <option value="student">Student</option>
                <option value="lecturer">Lecturer</option>
            </select>
        </div>
        <button type="submit">Register</button>
    </form>
    <p>Already registered? <a href="users.php">View Users</a></p>
</body>
</html>