<?php
require "config.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$project_id = $_GET["id"];
$user_id = $_SESSION["user_id"];

$stmt = $connection->prepare("SELECT * FROM projects WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $project_id, $user_id);
$stmt->execute();
$project = $stmt->get_result()->fetch_assoc();

if (!$project) {
    die("Project not found!");
}

$stmt = $connection->prepare("SELECT * FROM tasks WHERE project_id = ?");
$stmt->bind_param("i", $project_id);
$stmt->execute();
$tasks = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project view</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Project: <?= htmlspecialchars($project['name']) ?></h2>
        <a href="dashboard.php">Back</a>

        <ul>
            <?php while($task = $tasks->fetch_assoc()): ?>

            <li>

            <?php if($task['status'] == 'completed'): ?>
                <s><?= htmlspecialchars($task['title']) ?></s>
            <?php else: ?>
                <?= htmlspecialchars($task['title']) ?>
            <?php endif; ?>

            (<?= $task['status'] ?>)

            <a href="toggle_task.php?task_id=<?= $task['id'] ?>&project_id=<?= $project_id ?>">
            Mark as completed
            </a>
                 - 
            <a href="delete_task.php?task_id=<?= $task['id'] ?>&project_id=<?= $project_id ?>"
            onclick="return confirm('Delete this task?')">
            Delete
            </a>

        </li>

        <?php endwhile; ?>
        </ul>

        <h3>Add Task</h3>
        <form action="add_task.php" method="POST">
            <input type="hidden" name="project_id" value="<?= $project_id ?>">
            <input type="text" name="task_title" required>
            <button type="submit">Add</button>
        </form>
    </div>
    
</body>
</html>