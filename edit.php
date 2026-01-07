<?php
require 'db.php';
require 'functions.php';
checkLogin();

if (!isset($_GET['profile_id'])) die("Profile ID missing");

$profile_id = $_GET['profile_id'];
checkOwnership($pdo, $profile_id);

// Fetch current profile
$stmt = $pdo->prepare("SELECT * FROM Profile WHERE profile_id = :pid");
$stmt->execute([':pid' => $profile_id]);
$profile = $stmt->fetch();
if (!$profile) die("Profile not found");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $email      = trim($_POST['email']);
    $headline   = trim($_POST['headline']);
    $summary    = trim($_POST['summary']);

    // Validation
    if (empty($first_name) || empty($last_name) || empty($email) || empty($headline) || empty($summary)) {
        setFlash('error', 'All fields are required');
        header("Location: edit.php?profile_id=" . $_POST['profile_id']);
        exit();
    }

    if (strpos($email, '@') === false) {
        setFlash('error', 'Email address must contain @');
        header("Location: edit.php?profile_id=" . $_POST['profile_id']);
        exit();
    }

    // Update profile
    $stmt = $pdo->prepare("UPDATE Profile
        SET first_name=:fn, last_name=:ln, email=:em, headline=:he, summary=:su
        WHERE profile_id=:pid");
    $stmt->execute([
        ':fn'  => $first_name,
        ':ln'  => $last_name,
        ':em'  => $email,
        ':he'  => $headline,
        ':su'  => $summary,
        ':pid' => $profile_id
    ]);

    setFlash('success', 'Profile updated successfully!');
    header('Location: index.php');
    exit();
}
?>
