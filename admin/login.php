<?php
session_start();
$config = require __DIR__ . '/../config.php';

if (!empty($_SESSION['admin'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';
    if ($user === $config['admin_user'] && $pass === $config['admin_password']) {
        $_SESSION['admin'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid credentials';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        body { background: #E2E8F0; }
        .login {
            max-width: 420px;
            margin: 80px auto;
        }
    </style>
    </head>
<body>
    <div class="login card">
        <h2>Admin Login</h2>
        <?php if ($error): ?>
            <p style="color:#DC2626;"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="post">
            <label>Username</label><br>
            <input type="text" name="username" required style="width:100%;padding:10px;margin:8px 0;border:1px solid #CBD5E1;border-radius:8px;"><br>
            <label>Password</label><br>
            <input type="password" name="password" required style="width:100%;padding:10px;margin:8px 0;border:1px solid #CBD5E1;border-radius:8px;"><br>
            <button class="btn" type="submit">Login</button>
        </form>
    </div>
</body>
</html>

