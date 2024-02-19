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
    <title>О нас</title>
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
                        <li class="username"><?= $_SESSION['user']['Name'] ?></li>
                        <li><img class="avatar_small" src="img/avatar/<?=$_SESSION['user']['Avatar']?>" alt=""></li>
                    </ul>
                </a>
            </div>
        </nav>
    </header>
    <section>
        <div class="container">
            <div class="about_position">
                <div class="about_position_min">
                    <img class="logo_big" src="img/logo.png" alt="">
                    <p>Аудиосервис ONBEAT — это миллионы треков, HiFi-качество музыки, подкасты, эксклюзивы и персонализированные Волны.</p>
                </div>
                <img class="about_img" src="img/headphones.png" alt="">
            </div>
        </div>
    </section>
    <section class="about_cards">
        <div class="container">
            <div  class="about_items">
                <h2>Более 70 млн треков</h2>
                <p>Миллионы треков, тысячи плейлистов, новинки, хиты и топ-чарты.</p>
            </div>
            <div class="about_items about_items_middle">
                <h2>HiFi-качество звука</h2>
                <p>Включайте HiFi-качество и наслаждайтесь звуком с повышенной детализацией.</p>
            </div>
            <div class="about_items">
                <h2>Личный профиль</h2>
                <p>Удобный способ делиться любимой музыкой и следить за обновлениями интересных пользователей и артистов.</p>
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
                    <li class="footer_logo" ><img src="img/vk.png" alt=""></li>
                    <li class="footer_logo" ><img src="img/youtube.png" alt=""></li>
                    <li class="footer_logo" ><img src="img/twitter.png" alt=""></li>
                </ul>
            </div>
        </nav>
    </footer>
</body>
</html>