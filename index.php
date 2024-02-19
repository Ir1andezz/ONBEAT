<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /');
}
require_once 'php/connect.php';
$currentUserId = $_SESSION['user']['UserID'];

$queryTracks = "SELECT Tracks.TrackID as tracks_id, Tracks.Title as tracks_title, Tracks.Artist AS tracks_artist, Tracks.AlbumTitle AS tracks_albumtitle, Tracks.Duration AS tracks_duration, CoverImage as cover_img
FROM tracks";

if ($resultTracks = mysqli_query($connect, $queryTracks)) {
    $tracks = mysqli_fetch_all($resultTracks, MYSQLI_ASSOC);
} else {
    die(mysqli_error($connect));
}

$queryAlbums = "SELECT Albums.AlbumID as album_id, Albums.Title as album_title, Albums.Artist as album_artist, Albums.CoverImage as album_img
FROM Albums ;";


if ($resultAlbums = mysqli_query($connect, $queryAlbums)) {
    $albums = mysqli_fetch_all($resultAlbums, MYSQLI_ASSOC);
} else {
    die(mysqli_error($connect));
}

$queryPlaylists = "SELECT Playlists.AuthorID, Playlists.Title AS playlist_name, Playlists.CoverImage AS playlist_img, Playlists.PlaylistID as playlist_id 
                   FROM Playlists
                   Where Playlists.AuthorID = 1";


if ($resultPlaylists = mysqli_query($connect, $queryPlaylists)) {
    $playlists = mysqli_fetch_all($resultPlaylists, MYSQLI_ASSOC);
} else {
    die(mysqli_error($connect));
}

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
    <title>Главное</title>
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
                        <li><img class="avatar_small" src="img/avatar/<?= $_SESSION['user']['Avatar'] ?>" alt=""></li>
                    </ul>
                </a>
            </div>
        </nav>
    </header>
    <section class="chart">
        <div class="container">
            <div class="title">
                <h1>Чарт</h1>
                <button>Показать все</button>
                <img src="img/play_button.png" alt="">
            </div>
            <div class="songs_block">
                <div class="songs_position">
                    <?php
                    foreach ($tracks as $track):
                        $trackNumber = $track['tracks_id'];
                        if ($trackNumber > 5) {
                            break;
                        }
                        ?>
                        <div class="song">
                            <div class="song_left">
                                <p>
                                    <?php echo $trackNumber; ?>
                                </p>
                                <img class="song_cover" src="img/song_cover/<?= $track['cover_img']; ?>" alt="">
                                <ul>
                                    <li class="song_name">
                                        <?= $track['tracks_title']; ?>
                                    </li>
                                    <li class="artist_name">
                                        <?= $track['tracks_artist']; ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="song_right">
                                <img class="plus" src="img/plus.png" alt="">
                                <img class="heart" src="img/heart.png" alt="">
                                <p>
                                    <?= substr($track['tracks_duration'], 0, -3); ?>
                                </p>
                            </div>
                        </div>
                        <?php
                        $trackNumber++;
                    endforeach;
                    ?>
                </div>
                <div class="songs_position songs_position_hidden">
                    <?php
                    foreach ($tracks as $track):
                        $trackNumber = $track['tracks_id'];
                        if ($trackNumber < 6 || $trackNumber > 10) {
                            continue;
                        }
                        ?>
                        <div class="song">
                            <div class="song_left">
                                <p>
                                    <?php echo $trackNumber; ?>
                                </p>
                                <img class="song_cover" src="img/song_cover/<?= $track['cover_img']; ?>" alt="">
                                <ul>
                                    <li class="song_name">
                                        <?= $track['tracks_title']; ?>
                                    </li>
                                    <li class="artist_name">
                                        <?= $track['tracks_artist']; ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="song_right">
                                <img class="plus" src="img/plus.png" alt="">
                                <img class="heart" src="img/heart.png" alt="">
                                <p>
                                    <?= substr($track['tracks_duration'], 0, -3); ?>
                                </p>
                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>

                </div>
            </div>
        </div>
        </div>
    </section>
    <section class="popular_playlist">
        <div class="container">
            <div class="title">
                <h1>Подборки</h1>
                <img src="img/play_button.png" alt="">
            </div>
            <div class="playlist_block">
                <swiper-container class="for_you" slides-per-view="auto" free-mode="true"
                    no-swiping-class="swiper_no_swiping">
                    <?php foreach ($playlists as $playlist): ?>
                        <div class="playlist for_you_card swiper-slide">
                            <img class="album_cover" src="img/collections/<?= $playlist['playlist_img']; ?>" alt="">
                            <div class="playlist_bottom">
                                <ul>
                                    <li class="song_name">
                                        <?= $playlist['playlist_name']; ?>
                                    </li>
                                    <!-- <li>
                                        
                                    </li> -->
                                </ul>
                                <img class="heart" src="img/heart.png" alt="">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </swiper-container>
                <!-- <div class="playlist">
                    <img class="album_cover" src="img/collections/2.png" alt="">
                    <div class="playlist_bottom">
                        <ul>
                            <li class="song_name">В тренде</li>
                        </ul>
                        <img class="heart" src="img/heart.png" alt="">
                    </div>
                </div>
                <div class="playlist">
                    <img class="album_cover" src="img/collections/3.png" alt="">
                    <div class="playlist_bottom">
                        <ul>
                            <li class="song_name">Новинки</li>
                        </ul>
                        <img class="heart" src="img/heart.png" alt="">
                    </div>
                </div>
                <div class="playlist">
                    <img class="album_cover" src="img/collections/4.png" alt="">
                    <div class="playlist_bottom">
                        <ul>
                            <li class="song_name">Вечерняя</li>
                        </ul>
                        <img class="heart" src="img/heart.png" alt="">
                    </div>
                </div>
                <div class="playlist playlist_hidden">
                    <img class="album_cover" src="img/collections/5.png" alt="">
                    <div class="playlist_bottom">
                        <ul>
                            <li class="song_name">Хиты</li>
                        </ul>
                        <img class="heart" src="img/heart.png" alt="">
                    </div>
                </div> -->
            </div>
        </div>
        <div class="bg-img">
            <img src="img/blob_3.png" alt="">
        </div>
    </section>
    <section class="popular_playlist">
        <div class="container">
            <div class="title">
                <h1>Новые релизы</h1>
                <img src="img/play_button.png" alt="">
            </div>
            <div class="playlist_block">
                <swiper-container class="for_you" slides-per-view="auto" free-mode="true"
                    no-swiping-class="swiper_no_swiping">
                    <?php foreach ($albums as $album):
                        $albumNumber = $album['album_id'];
                        if ($albumNumber > 5) {
                            break;
                        }
                        ?>
                        <div class="playlist for_you_card swiper-slide">
                            <img class="album_cover" src="img/playlist_cover/<?= $album['album_img']; ?>" alt="">
                            <div class="playlist_bottom">
                                <ul>
                                    <li class="song_name">
                                        <?= $album['album_title']; ?>
                                    </li>
                                    <li>
                                        <?= $album['album_artist']; ?>
                                    </li>
                                </ul>
                                <img class="heart" src="img/heart.png" alt="">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </swiper-container>
                <!-- <div class="playlist">
                    <img class="album_cover" src="img/album/mudblood.jpeg" alt="">
                    <div class="playlist_bottom">
                        <ul>
                            <li class="song_name">Mudblood</li>
                            <li>CMH</li>
                        </ul>
                        <img class="heart" src="img/heart.png" alt="">
                    </div>
                </div>
                <div class="playlist">
                    <img class="album_cover" src="img/album/geometria.jpeg" alt="">
                    <div class="playlist_bottom">
                        <ul>
                            <li class="song_name">Геометрия тьмы</li>
                            <li>Pyrokinesis</li>
                        </ul>
                        <img class="heart" src="img/heart.png" alt="">
                    </div>
                </div>
                <div class="playlist">
                    <img class="album_cover" src="img/album/hellboy.png" alt="">
                    <div class="playlist_bottom">
                        <ul>
                            <li class="song_name">Hellboy</li>
                            <li>Lil Peep</li>
                        </ul>
                        <img class="heart" src="img/heart.png" alt="">
                    </div>
                </div>
                <div class="playlist">
                    <img class="album_cover" src="img/album/lastone.jpeg" alt="">
                    <div class="playlist_bottom">
                        <ul>
                            <li class="song_name">Last One</li>
                            <li>GREEN ORXNGE</li>
                        </ul>
                        <img class="heart" src="img/heart.png" alt="">
                    </div>
                </div>
                <div class="playlist playlist_hidden">
                    <img class="album_cover" src="img/album/latenightsshow.jpeg" alt="">
                    <div class="playlist_bottom">
                        <ul>
                            <li class="song_name">LATE NIGHT SHOW</li>
                            <li>dlb</li>
                        </ul>
                        <img class="heart" src="img/heart.png" alt="">
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <section class="popular_playlist">
        <div class="container">
            <div class="title">
                <h1>Рекомендуем </h1>
                <img src="img/play_button.png" alt="">
            </div>
            <div class="playlist_block">
                <swiper-container class="for_you" slides-per-view="auto" free-mode="true"
                    no-swiping-class="swiper_no_swiping">
                    <?php foreach ($albums as $album):
                        $albumNumber = $album['album_id'];
                        if ($albumNumber < 6 || $albumNumber > 10) {
                            continue;
                        } ?>
                        <div class="playlist for_you_card swiper-slide">
                            <img class="album_cover" src="img/rec_cover/<?= $album['album_img']; ?>" alt="">
                            <div class="playlist_bottom">
                                <ul>
                                    <li class="song_name">
                                        <?= $album['album_title']; ?>
                                    </li>
                                    <li>
                                        <?= $album['album_artist']; ?>
                                    </li>
                                </ul>
                                <img class="heart" src="img/heart.png" alt="">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </swiper-container>
                <!-- <div class="playlist">
                    <img class="album_cover" src="img/recomendations/1.jpeg" alt="">
                    <div class="playlist_bottom">
                        <ul>
                            <li class="song_name">VAWË</li>
                            <li>OG Buda</li>
                        </ul>
                        <img class="heart" src="img/heart.png" alt="">
                    </div>
                </div>
                <div class="playlist">
                    <img class="album_cover" src="img/recomendations/2.jpeg" alt="">
                    <div class="playlist_bottom">
                        <ul>
                            <li class="song_name">Разбалованная</li>
                            <li>Скриптонит</li>
                        </ul>
                        <img class="heart" src="img/heart.png" alt="">
                    </div>
                </div>
                <div class="playlist">
                    <img class="album_cover" src="img/recomendations/3.jpeg" alt="">
                    <div class="playlist_bottom">
                        <ul>
                            <li class="song_name">Рапсодия Конца Света</li>
                            <li>GONE.Fludd</li>
                        </ul>
                        <img class="heart" src="img/heart.png" alt="">
                    </div>
                </div>
                <div class="playlist">
                    <img class="album_cover" src="img/recomendations/4.jpeg" alt="">
                    <div class="playlist_bottom">
                        <ul>
                            <li class="song_name">VARSKVA</li>
                            <li>Big Baby Tape</li>
                        </ul>
                        <img class="heart" src="img/heart.png" alt="">
                    </div>
                </div>
                <div class="playlist playlist_hidden">
                    <img class="album_cover" src="img/recomendations/5.jpeg" alt="">
                    <div class="playlist_bottom">
                        <ul>
                            <li class="song_name">V.O.L.G.A</li>
                            <li>f0lk</li>
                        </ul>
                        <img class="heart" src="img/heart.png" alt="">
                    </div>
                </div> -->
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>
</body>

</html>