<?php
require "config.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$stmt = $connection->prepare("SELECT * FROM projects WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION["user_id"]);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Your Projects</h1>
        <a href="logout.php">Log out</a>
        <ul>
            <?php while($project = $result->fetch_assoc()): ?>

            <li>

            <a href="view_project.php?id=<?= $project['id'] ?>">
            <?= htmlspecialchars($project['name']) ?>
            </a>

            <a href="delete_project.php?project_id=<?= $project['id'] ?>"
            onclick="return confirm('Delete this project and all tasks?')">
            Delete
            </a>

            </li>

            <?php endwhile; ?>
        </ul>
        <h3>Create Project</h3>
        <form action="create_project.php" method="POST">
            <input type="text" name="project_name" required>
            <button type="submit">Create</button>
        </form>
    </div>   
</body>
</html>