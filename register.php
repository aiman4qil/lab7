


<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: inline-block; width: 100px; }
        input, select { padding: 5px; width: 200px; }
        button { padding: 8px 15px; background: #4CAF50; color: white; border: none; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Faculty of Computer Science and Information Technology</h1>
    <h2>BIT21503 Web Development</h2>
    <h3>User Registration</h3>
    
    <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    
    <form method="post">
        <div class="form-group">
            <label for="matric">Matric:</label>
            <input type="text" id="matric" name="matric" required>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="">Please select</option>
                <option value="lecturer">Lecturer</option>
                <option value="student">Student</option>
            </select>
        </div>
        <button type="submit">Submit</button>
    </form>
</body>
</html>