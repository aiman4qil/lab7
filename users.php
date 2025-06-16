<?php
// Database connection
$conn = new mysqli('localhost', 'username', 'password', 'lab_7');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users
$result = $conn->query("SELECT matric, name, role FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>
    <h1>Faculty of Computer Science and Information Technology</h1>
    <h2>BIT21503 Web Development</h2>
    <h3>User List</h3>
    
    <table>
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Level</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['matric']); ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['role']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>