<?php
require "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = $_POST["project_id"];
    $title = $_POST["task_title"];

    $stmt = $connection->prepare("INSERT INTO tasks (project_id, title) VALUES (?, ?)");
    $stmt->bind_param("is", $project_id, $title);
    $stmt->execute();

    header("Location: view_project.php?id=" . $project_id);
}
?>