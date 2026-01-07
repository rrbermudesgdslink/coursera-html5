<?php
require 'db.php';
require 'functions.php';
checkLogin();

if (!isset($_GET['profile_id'])) {
    die("Profile ID is missing");
}

$profile_id = $_GET['profile_id'];
checkOwnership($pdo, $profile_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("DELETE FROM Profile WHERE profile_id=:pid");
    $stmt->execute([':pid' => $profile_id]);
    setFlash('success', 'Profile deleted successfully!');
    header('Location: index.php');
    exit();
}

// Fetch profile for confirmation
$stmt = $pdo->prepare("SELECT first_name, last_name FROM Profile WHERE profile_id = :pid");
$stmt->execute([':pid' => $profile_id]);
$profile = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Raymund Ryan Bermudes - Delete Profile</title>
</head>
<body>
<h1>Delete Profile</h1>
<p>Are you sure you want to delete the profile of <strong><?= htmlentities($profile['first_name'] . " " . $profile['last_name']) ?></strong>?</p>

<form method="POST">
    <button type="submit">Yes, Delete</button>
    <a href="index.php">Cancel</a>
</form>
</body>
</html>
