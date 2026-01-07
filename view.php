<?php
require 'db.php';
require 'functions.php';

if (!isset($_GET['profile_id'])) {
    die("Profile ID is missing");
}

$profile_id = $_GET['profile_id'];

// Fetch profile from database
$stmt = $pdo->prepare("SELECT * FROM Profile WHERE profile_id = :pid");
$stmt->execute([':pid' => $profile_id]);
$profile = $stmt->fetch();

if (!$profile) {
    die("Profile not found");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Raymund Ryan Bermudes - View Profile</title>
</head>
<body>
<h1>Profile Details</h1>
<p><strong>First Name:</strong> <?= htmlentities($profile['first_name']) ?></p>
<p><strong>Last Name:</strong> <?= htmlentities($profile['last_name']) ?></p>
<p><strong>Email:</strong> <?= htmlentities($profile['email']) ?></p>
<p><strong>Headline:</strong> <?= htmlentities($profile['headline']) ?></p>
<p><strong>Summary:</strong><br><?= nl2br(htmlentities($profile['summary'])) ?></p>

<a href="index.php">Back to Profiles</a>
</body>
</html>
