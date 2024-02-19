<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

session_start();
if ($_SESSION['user']) {
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="scss/style.css">
    <title>Регистрация</title>
</head>
<body>
    <section class="singup">
        <div class="login_position">
            <h1>Регистрация</h1>
            <form action="php/singup.php" method="post" >
            <input class="auth_input" name="name" id="nameField" type="text" placeholder="Имя" required>
                        <div id="nameError" class="error"></div>

                        <input class="auth_input" name="email" id="emailField" type="text" placeholder="Почта" required>
                        <div id="emailError" class="error"></div>

                        <input class="auth_input" name="phonenumber" id="phoneField" type="text" placeholder="Номер телефона"
                            required>
                        <div id="phoneError" class="error"></div>

                        <input class="auth_input" name="password" id="passwordField" type="password"
                            placeholder="Пароль" required>
                        <div id="passwordError" class="error"></div>

                        <input class="auth_input" name="password_confirm" id="confirmPasswordField" type="password"
                            placeholder="Подтвердите пароль" required>
                        <div id="confirmPasswordError" class="error"></div>
                        
                        <button type="submit" class="accept_button">Продолжить</button>
            </form>
            <a class="auth_bottom_link" href="login.php">Уже есть аккаунт?</a>
        </div>
    </section>
</body>
</html>