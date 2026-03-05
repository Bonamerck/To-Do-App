<?php
require "config.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$project_id = (int)$_GET["project_id"];

/* Secure delete: ensure project belongs to user */

$stmt = $connection->prepare("
    DELETE FROM projects
    WHERE id = ? AND user_id = ?
");

$stmt->bind_param("ii", $project_id, $user_id);
$stmt->execute();

header("Location: dashboard.php");
exit;
?>