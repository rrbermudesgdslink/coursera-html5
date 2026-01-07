<?php
require 'db.php';

// User info
$name = 'Raymund Ryan Bermudes';
$email = 'raymund@example.com';
$password = 'secret123';

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert into database
$stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
$stmt->execute([
    ':name' => $name,
    ':email' => $email,
    ':password' => $hashed_password
]);

echo "User added successfully!";
?>
