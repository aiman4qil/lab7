<?php
// Database configuration
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
$message = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = $conn->real_escape_string($_POST['matric']);
    $name = $conn->real_escape_string($_POST['name']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $conn->real_escape_string($_POST['role']);

    // Check if matric already exists
    $check_sql = "SELECT id FROM users WHERE matric = '$matric'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $error = "Error: Matric number '$matric' is already registered!";
    } else {
        // Insert new user
        $insert_sql = "INSERT INTO users (matric, name, password, role) 
                      VALUES ('$matric', '$name', '$password', '$role')";
        
        if ($conn->query($insert_sql)) {
            $message = "Registration successful!";
            $showUsersLink = true;
        } else {
            $error = "Error: " . $conn->error;
        }
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
            background-color: #f5f5f5;
        }
        .registration-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background: #4CAF50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background: #45a049;
        }
        .message {
            color: green;
            margin: 15px 0;
            text-align: center;
            font-weight: bold;
        }
        .error {
            color: red;
            margin: 15px 0;
            text-align: center;
            font-weight: bold;
        }
        .users-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #2196F3;
            font-weight: bold;
            text-decoration: none;
        }
        .users-link:hover {
            text-decoration: underline;
        }
        .existing-users {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="registration-box">
        <h2>User Registration</h2>
        
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
            <?php if ($showUsersLink): ?>
                <a href="users.php" class="users-link">View All Registered Users →</a>
            <?php endif; ?>
        <?php endif; ?>
        
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
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
        
        <div class="existing-users">
            <a href="users.php">View Existing Users</a>
        </div>
    </div>
</body>
</html>