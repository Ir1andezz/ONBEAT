<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

session_start();

if ($_SESSION['user']) {
    header('Location: index.php');
    exit();
}

$error = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="scss/style.css">
    <title>Авторизация</title>
</head>
<body>
    <section class="login">
        <div class="login_position">
            <h1>Авторизация</h1>
            <form action="php/login.php" method="post">
                <input class="auth_input" name="email" id="emailField" placeholder="Почта" required>
                <div id="emailError" class="error"></div>

                <input class="auth_input"  name="password" id="passwordField" type="password" placeholder="Пароль" required>
                <div id="passwordError" class="error"></div>
                <?php if ($error): ?>
                    <div class="error"><?= $error ?></div>
                <?php endif; ?>
                
                <button type="submit" class="accept_button">Войти</button>
            </form>
            <a class="auth_bottom_link" href="singup.php">Еще нет аккаунта?</a>
        </div>
    </section>
</body>
</html>