<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: admin.php');
    exit();
}

$message = '';
$storedHashedPassword = REMOVED
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - File Explorer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h1 {
            font-size: 24px;
            margin: 0 0 20px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>File Explorer v2.12</h1>
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>

<?php
$html_block = ob_get_clean();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Location: error.php', true, 301);
    echo $html_block;
    flush();
    exit;
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $hashedInputPassword = hash('sha256', $password);

    if ($username === 'admin' && strtoupper($hashedInputPassword) === strtoupper($storedHashedPassword)) {
        $_SESSION['username'] = $username;
        header('Location: admin.php', true, 301);
        echo 'Authentication Successful!';
        flush();
    } else {
        header('Location: error.php', true, 301);
        echo 'Invalid username or password.';
        flush();
    }
    exit;
}
?>
