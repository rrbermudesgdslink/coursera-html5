<?php
// process.php
require 'db.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $errors = [];

    // Server-side validation
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

    if ($errors) {
        setFlash('error', implode('<br>', $errors));
        header('Location: index.php');
        exit();
    }

    // Insert into database using PDO
    $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
    $stmt->execute([
        ':name' => $name,
        ':email' => $email
    ]);

    setFlash('success', "User registered successfully!");
    header('Location: index.php');
    exit();
}
?>
