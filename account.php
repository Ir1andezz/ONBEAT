<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /');
}
require_once 'php/connect.php';
$currentUserId = $_SESSION['user']['UserID'];

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="scss/style.css">
    <title>Личный кабинет</title>
</head>

<body>
    <header>
        <nav class="main_menu">
            <div class="menu menu_left">
                <img class="logo" src="img/logo.png" alt="">
                <img class="logo_hidden" src="img/logo_cut_black.png" alt="">
                <ul class="menu_items">
                    <li><a href="index.php">Главное</a></li>
                    <li><a href="collection.php">Коллекция</a></li>
                    <li><a href="about.php">О нас</a></li>
                    <li><input type="text" placeholder="Поиск"></li>
                </ul>
            </div>
            <div class="menu menu_right">
                <a href="account.php">
                    <ul>
                        <li class="username">
                            <?= $_SESSION['user']['Name'] ?>
                        </li>
                        <li><img class="avatar_small" src="img/avatar/<?= $_SESSION['user']['Avatar'] ?>" alt="выф"></li>
                    </ul>
                </a>
            </div>
        </nav>
    </header>
    <section class="user_account">
        <div class="container">
            <div class="account_position">
                <div class="account account_left">
                    <div class="title">
                        <h1>Личный кабинет</h1>
                    </div>
                    <div class="account_left_position">
                        <form id="uploadForm" action="php/avatar_upload.php" method="post" enctype="multipart/form-data">

                            <input type="file" id="photoUpload" name="uploadedFile" style="display: none;"
                                onchange="handleFileUpload(this)">
                                <img class="avatar_big" onclick="openFileUploader()" src="img/avatar/<?= $_SESSION['user']['Avatar'] ?>" alt="">
                            <!-- <img class="ava" onclick="openFileUploader()" src=""> -->

                        </form>
                        
                        <h1>
                            <?= $_SESSION['user']['Name'] ?>
                        </h1>
                        <a href="php/logout.php">Выйти</a>
                    </div>
                </div>
                <div class="account account_right">
                    <div class="title">
                        <h1>Персональные данные</h1>
                    </div>
                    <div class="account_right_position">
                        <ul>
                            <li>Номер телефона:
                                <?= $_SESSION['user']['PhoneNumber'] ?>
                            </li>
                            <li>Почта:
                                <?= $_SESSION['user']['Email'] ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <nav class="main_menu">
            <div class="menu footer_menu_left">
                <img class="logo" src="img/logo.png" alt="">
                <img class="logo_hidden" src="img/logo_cut_black.png" alt="">
                <ul class="menu_items">
                    <li><a href="index.html">Главное</a></li>
                    <li><a href="collection.html">Коллекция</a></li>
                    <li><a href="about.html">О нас</a></li>
                </ul>
            </div>
            <div class="menu footer_menu_right">
                <ul>
                    <li class="footer_logo"><img src="img/vk.png" alt=""></li>
                    <li class="footer_logo"><img src="img/youtube.png" alt=""></li>
                    <li class="footer_logo"><img src="img/twitter.png" alt=""></li>
                </ul>
            </div>
        </nav>
    </footer>
</body>
<script>function openFileUploader() {
    // Вызываем клик на скрытом элементе input при нажатии на текст "Загрузить"
    document.getElementById('photoUpload').click();
}

function handleFileUpload(input) {
    // Обработка загруженного файла
    var file = input.files[0];
    if (file) {
        // Здесь вы можете добавить логику обработки загруженного файла
        console.log('Файл загружен:', file.name);

        // Автоматическая отправка формы после выбора файла
        document.getElementById('uploadForm').submit();
    }
}</script>
</html>