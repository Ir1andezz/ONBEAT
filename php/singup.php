<?php

session_start();
require_once 'connect.php';

// Проверка наличия всех необходимых данных
if(isset($_POST['name'], $_POST['phonenumber'], $_POST['email'], $_POST['password'], $_POST['password_confirm'])) {
    
    // Получение данных из формы
    $name = $_POST['name'];
    $phone = $_POST['phonenumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Проверка совпадения паролей
    if($password !== $password_confirm) {
        echo "Пароли не совпадают";
        exit;
    }

    // Хеширование пароля
    $hashed_password = md5($password, PASSWORD_DEFAULT);

    // Подготовка запроса на добавление пользователя в базу данных
    $query = "INSERT INTO users (name, PhoneNumber, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $connect->prepare($query);
    // Выполнение запроса
    if ($stmt->execute([$name, $phone, $email, $hashed_password])) {
        // Перенаправление на страницу авторизации
        header('Location: ../login.php');
        exit;
    } else {
        echo "Ошибка при регистрации пользователя";
    }

} else {
    echo "Не все данные были переданы";
}
?>