<?php
// Подключение к базе данных
include("connect.php");

session_start(); // Если сессии еще не были запущены

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["uploadedFile"]) && $_FILES["uploadedFile"]["error"] == UPLOAD_ERR_OK) {
        // Получение информации о файле

        
        $fileName = $_FILES["uploadedFile"]["name"];
        $filePath = "../img/avatar/" . $fileName;
        $file_db_name = $fileName;
        // Перемещение файла на сервер
        if (move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], $filePath)) {
            // Получение имени пользователя из сессии
            $username = $_SESSION['user']['Email']; // Если имя пользователя не найдено, используем 'Гость'

            // Обновление записи в базе данных
            $sql = "UPDATE Users SET Avatar = '../avatar/$file_db_name' WHERE Email = '$username'";
            $result = $connect->query($sql);

            if ($result) {
                echo "Фотография профиля успешно загружена.";
                header("location: ../account.php");
            exit();
            } else {
                echo "Ошибка при обновлении записи в базе данных: " . $connect->error;
            }
        } else {
            echo "Ошибка при перемещении файла на сервер.";
        }
    } else {
        echo "Ошибка при загрузке файла.";
    }
}

// Закрытие соединения с базой данных
$connect->close();
?>