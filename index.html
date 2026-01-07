<?php
require 'db.php';
require 'functions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Raymund Ryan Bermudes - Profiles</title>
</head>
<body>
<h1>Profiles</h1>

<?php if ($msg = getFlash('success')): ?>
    <div class="flash-success"><?= $msg ?></div>
<?php endif; ?>

<?php if ($msg = getFlash('error')): ?>
    <div class="flash-error"><?= $msg ?></div>
<?php endif; ?>

<?php
$stmt = $pdo->query("SELECT profile_id, first_name, last_name, headline FROM Profile");
$profiles = $stmt->fetchAll();
?>

<ul>
<?php foreach ($profiles as $p): ?>
    <li>
        <?= htmlentities($p['first_name'] . " " . $p['last_name']); ?>
        (<?= htmlentities($p['headline']); ?>)
        - <a href="view.php?profile_id=<?= $p['profile_id'] ?>">View</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            - <a href="edit.php?profile_id=<?= $p['profile_id'] ?>">Edit</a>
            - <a href="delete.php?profile_id=<?= $p['profile_id'] ?>">Delete</a>
        <?php else: ?>
            - <a href="login.php">Login to edit</a>
        <?php endif; ?>
    </li>
<?php endforeach; ?>
</ul>

<?php if (isset($_SESSION['user_id'])): ?>
    <a href="add.php">Add New Profile</a> |
    <a href="logout.php">Logout</a>
<?php else: ?>
    <a href="login.php">Login</a>
<?php endif; ?>
</body>
</html>
