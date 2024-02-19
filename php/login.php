<?php
session_start();

require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // Проверка введенных данных
    if (empty($email) || empty($password)) {
        $_SESSION['message'] = 'Введите адрес электронной почты и пароль';
        header('Location: ../login.php');
        exit();
    }

    // Поиск пользователя в базе данных
    $check_user = mysqli_query($connect, "SELECT * FROM Users WHERE email = '$email'");
    if (mysqli_num_rows($check_user) > 0) {
        $user = mysqli_fetch_assoc($check_user);
        // Проверка пароля
        if (password_hash($password, $user['password'])) {
            // Пользователь найден, сохраняем информацию о нем в сессии
            $_SESSION['user'] = [
                'UserID' => $user['UserID'],
                'Name' => $user['Name'],
                'PhoneNumber' => $user['PhoneNumber'],
                'Email' => $user['Email'],
                'Password' => $user['Password'],
                'Avatar' => $user['Avatar']
            ];
            header("location: ../index.php");
            exit();
        } else {
            $_SESSION['message'] = 'Неверный логин или пароль';
            header('Location: ../login.php');
            exit();
        }
    } else {
        $_SESSION['message'] = 'Пользователь с таким email не найден';
        header('Location: ../login.php');
        exit();
    }
}

?>