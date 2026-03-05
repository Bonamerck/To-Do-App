<?php
require "config.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$task_id = $_GET["task_id"];
$project_id = $_GET["project_id"];

/* Verify ownership before deleting */
$stmt = $connection->prepare("
    DELETE tasks FROM tasks
    JOIN projects ON tasks.project_id = projects.id
    WHERE tasks.id = ? AND projects.user_id = ?
");

$stmt->bind_param("ii", $task_id, $user_id);
$stmt->execute();

header("Location: view_project.php?id=" . $project_id);
exit;