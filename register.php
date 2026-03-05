<?php
require "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $connection->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <a href="index.php">Back</a>
        <form method="POST">
            <input type="text" name="username" required placeholder="Username"><br>
            <input type="email" name="email" required placeholder="Email"><br>
            <input type="password" name="password" required placeholder="Password"><br>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>