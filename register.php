<?php
// Database config
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'lab_7');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$showUsersLink = false;
$error = '';

// Process form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = $conn->real_escape_string($_POST['matric']);
    $name = $conn->real_escape_string($_POST['name']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $conn->real_escape_string($_POST['role']);

    $sql = "INSERT INTO users (matric, name, password, role) VALUES ('$matric', '$name', '$password', '$role')";
    
    if ($conn->query($sql)) {
        $message = "Registration successful!";
        $showUsersLink = true; // Set flag to show the link
    } else {
        $error = "Error: " . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            max-width: 500px; 
            margin: 0 auto; 
            padding: 20px; 
        }
        .form-group { 
            margin-bottom: 15px; 
        }
        label { 
            display: block; 
            margin-bottom: 5px; 
        }
        input, select { 
            width: 100%; 
            padding: 8px; 
            box-sizing: border-box; 
        }
        button { 
            background: #4CAF50; 
            color: white; 
            padding: 10px; 
            border: none; 
            cursor: pointer; 
            width: 100%;
        }
        .message { 
            color: green; 
            margin: 15px 0;
            text-align: center;
        }
        .error { 
            color: red; 
            text-align: center;
        }
        .users-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #2196F3;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">User Registration</h2>
    
    <?php if (isset($message)): ?>
        <p class="message"><?php echo $message; ?></p>
        <?php if ($showUsersLink): ?>
            <a href="users.php" class="users-link">View All Registered Users →</a>
        <?php endif; ?>
    <?php endif; ?>
    
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    
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
    
    <p style="text-align: center; margin-top: 20px;">
        <a href="users.php">View Existing Users</a>
    </p>
</body>
</html>