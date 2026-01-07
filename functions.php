<?php
// functions.php
session_start();

// Flash messages
function setFlash($key, $message) {
    $_SESSION[$key] = $message;
}

function getFlash($key) {
    if (isset($_SESSION[$key])) {
        $msg = $_SESSION[$key];
        unset($_SESSION[$key]);
        return htmlentities($msg);
    }
    return '';
}

// Check if user is logged in
function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        die("Not logged in");
    }
}

// Check if the current user owns the profile
function checkOwnership($pdo, $profile_id) {
    $stmt = $pdo->prepare("SELECT user_id FROM Profile WHERE profile_id = :pid");
    $stmt->execute([':pid' => $profile_id]);
    $row = $stmt->fetch();
    if (!$row) {
        die("Profile not found");
    }
    if ($row['user_id'] != $_SESSION['user_id']) {
        die("Not your profile");
    }
    return true;
}
?>
