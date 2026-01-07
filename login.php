<?php
require 'db.php';
require 'functions.php';

// The salt value for password hashing
$salt = 'XyZzy12*_';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $pass  = trim($_POST['pass']);

    $check = hash('md5', $salt.$pass);

    $stmt = $pdo->prepare('SELECT user_id, name FROM users WHERE email = :em AND password = :pw');
    $stmt->execute([':em' => $email, ':pw' => $check]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row !== false) {
        $_SESSION['name'] = $row['name'];
        $_SESSION['user_id'] = $row['user_id'];
        header('Location: index.php');
        exit();
    } else {
        setFlash('error', 'Incorrect email or password');
        header('Location: login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Raymund Ryan Bermudes - Login</title>
    <script>
        function validateForm() {
            var email = document.forms["loginForm"]["email"].value.trim();
            var pass  = document.forms["loginForm"]["pass"].value.trim();

            if (email === "" || pass === "") {
                alert("Both email and password are required.");
                return false;
            }

            if (email.indexOf("@") === -1) {
                alert("Email must contain '@'.");
                return false;
            }

            return true; // allow form submission
        }
    </script>
</head>
<body>
<h1>Login</h1>

<?php if ($msg = getFlash('error')): ?>
    <div class="flash-error"><?= $msg ?></div>
<?php endif; ?>

<form name="loginForm" method="POST" onsubmit="return validateForm();">
    Email: <input type="text" name="email"><br><br>
    Password: <input type="password" name="pass"><br><br>
    <button type="submit">Login</button>
</form>
</body>
</html>
