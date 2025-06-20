<?php
// Start session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hardcoded username and password
    $username = "admin";
    $password = "12345";

    // Get form data
    $inputUser = $_POST['username'];
    $inputPass = $_POST['password'];

    // Validate credentials
    if ($inputUser === $username && $inputPass === $password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $inputUser;
        header("Location: welcome.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple PHP Login</title>
</head>
<body>
    <h2>Login Form</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST" action="login.php">
        <label for="username">Username:</label><br/>
        <input type="text" name="username" id="username" required><br/><br/>
        
        <label for="password">Password:</label><br/>
        <input type="password" name="password" id="password" required><br/><br/>
        
        <button type="submit">Login</button>
    </form>
</body>
</html>
