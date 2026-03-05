<?php
require "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["project_name"];
    $user_id = $_SESSION["user_id"];

    $stmt = $connection->prepare("INSERT INTO projects (user_id, name) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $name);
    $stmt->execute();

    header("Location: dashboard.php");
}
?>