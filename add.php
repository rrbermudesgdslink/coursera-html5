<?php
require 'db.php';
require 'functions.php';
checkLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $email      = trim($_POST['email']);
    $headline   = trim($_POST['headline']);
    $summary    = trim($_POST['summary']);

    // Validation
    if (empty($first_name) || empty($last_name) || empty($email) || empty($headline) || empty($summary)) {
        setFlash('error', 'All fields are required');
        header('Location: add.php');
        exit();
    }

    if (strpos($email, '@') === false) {
        setFlash('error', 'Email address must contain @');
        header('Location: add.php');
        exit();
    }

    // Insert into Profile table
    $stmt = $pdo->prepare('INSERT INTO Profile
        (user_id, first_name, last_name, email, headline, summary)
        VALUES (:uid, :fn, :ln, :em, :he, :su)');
    $stmt->execute([
        ':uid' => $_SESSION['user_id'],
        ':fn'  => $first_name,
        ':ln'  => $last_name,
        ':em'  => $email,
        ':he'  => $headline,
        ':su'  => $summary
    ]);

    setFlash('success', 'Profile added successfully!');
    header('Location: index.php');
    exit();
}
?>
