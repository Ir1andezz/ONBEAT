<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /');
}
require_once 'php/connect.php';
$currentUserId = $_SESSION['user']['UserID'];



$queryPlaylists = "SELECT Playlists.Title AS playlist_name, Playlists.CoverImage AS playlist_img, Playlists.PlaylistID as playlist_id 
                   FROM Playlists
                   WHERE Playlists.AuthorID = $currentUserId";


if ($resultPlaylists = mysqli_query($connect, $queryPlaylists)) {
    $playlists = mysqli_fetch_all($resultPlaylists, MYSQLI_ASSOC);
} else {
    die(mysqli_error($connect));
}

$queryAlbums = "SELECT Albums.AlbumID, Albums.Title as album_title, Albums.Artist as album_artist, Albums.CoverImage as album_img
FROM Albums
JOIN FavoriteAlbums ON Albums.AlbumID = FavoriteAlbums.AlbumID
WHERE FavoriteAlbums.UserID = $currentUserId;";


if ($resultAlbums = mysqli_query($connect, $queryAlbums)) {
    $albums = mysqli_fetch_all($resultAlbums, MYSQLI_ASSOC);
} else {
    die(mysqli_error($connect));
}

$queryTracks = "SELECT Tracks.TrackID as tracks_id, Tracks.Title as tracks_title, Tracks.Artist AS tracks_artist, Tracks.AlbumTitle AS tracks_albumtitle, Tracks.Duration AS tracks_duration, CoverImage as cover_img
FROM tracks
JOIN FavoriteTracks ON Tracks.TrackID = FavoriteTracks.TrackID
WHERE FavoriteTracks.UserID = $currentUserId;";

if ($resultTracks = mysqli_query($connect, $queryTracks)) {
    $tracks = mysqli_fetch_all($resultTracks, MYSQLI_ASSOC);
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
    <title>Коллекция</title>
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
    <section class="popular_playlist">
        <div class="container">
            <div class="title">
                <h1>Плейлисты</h1>
                <img src="img/play_button.png" alt="">
            </div>
            <div class="playlist_block">
                <swiper-container class="for_you" slides-per-view="auto" free-mode="true">
                    <?php foreach ($playlists as $playlist): ?>
                        <div class="playlist for_you_card swiper-slide">
                            <img class="album_cover" src="img/playlist_cover/<?= $playlist['playlist_img']; ?>" alt="">
                            <div class="playlist_bottom">
                                <ul>
                                    <li class="song_name">
                                        <?= $playlist['playlist_name']; ?>
                                    </li>
                                    <li>
                                        <?= $_SESSION['user']['Name'] ?>
                                    </li>
                                </ul>
                                <img class="heart" src="img/heart_fill.png" alt="">
                            </div>
                        </div>
                        <!-- <div class="for_you_card swiper-slide">
                            <div class="for_you_img">
                                <img class="default_img" src="img/playlist/<?= $playlist['playlist_img']; ?>" alt="">
                                <div class="hover_block">
                                    <a href="playlist.php?playlist_id=<?= $playlist['playlist_id']; ?>"
                                        class="album-link"><img class="hover_img" src="img/play_hover.png" alt=""></a>
                                </div>
                            </div>
                            <div class="for_you_bottom">
                                <div class="for_you_autor">
                                </div>
                                <div class="for_you_name">
                                    <p>
                                        <?= $playlist['playlist_name']; ?>
                                    </p>
                                    <img src="img/heart.png" alt="">
                                </div>
                            </div>
                        </div> -->
                    <?php endforeach; ?>
                </swiper-container>
                <!-- <div class="playlist">
                    <img class="album_cover" src="img/playlist/playlist.jpeg" alt="">
                    <div class="playlist_bottom">
                        <ul>
                            <li class="song_name">Playlist_1</li>
                            <li>Ohae</li>
                        </ul>
                        <img class="heart" src="img/heart.png" alt="">
                    </div>
                </div> -->
            </div>
        </div>
        <div class="bg-img bg_img_playlist">
            <img src="img/blob_4.png" alt="">
        </div>
    </section>
    <section class="popular_playlist">
        <div class="container">
            <div class="title">
                <h1>Альбомы</h1>
                <img src="img/play_button.png" alt="">
            </div>
            <div class="playlist_block">
                <swiper-container class="for_you" slides-per-view="auto" free-mode="true">
                    <?php foreach ($albums as $album): ?>
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
                                <img class="heart" src="img/heart_fill.png" alt="">
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
        <!-- <div class="bg-img bg_img_author">
            <img src="img/blob_5.png" alt="">
        </div> -->
    </section>
    <section>
        <div class="container">
            <div class="title">
                <h1>Любимые треки</h1>
                <img src="img/play_button.png" alt="">
            </div>
            <div>
                <div class="songs_position ">
                    <div class="songs_title">
                        <p>#</p>
                        <p>Название</p>
                        <p>Исполнитель</p>
                        <p>Альбом</p>
                    </div>

                    <?php
                    $i = 1;
                    foreach ($tracks as $track):
                        $trackNumber = $i;
                        $i++; ?>
                        <div class="song liked_song">
                            <div class="song_left">
                                <p>
                                    <?php echo $trackNumber; ?>
                                </p>
                                <img class="song_cover" src="img/song_cover/<?= $track['cover_img']; ?>" alt="">
                                <ul>
                                    <li class="liked_song_name">
                                        <?= $track['tracks_title']; ?>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <p>
                                    <?= $track['tracks_artist']; ?>
                                </p>
                            </div>
                            <div>
                                <p class="album_name">
                                    <?= $track['tracks_albumtitle']; ?>
                                </p>
                            </div>
                            <div class="song_right">
                                <img class="plus" src="img/plus.png" alt="">
                                <img class="heart" src="img/heart_fill.png" alt="">
                                <p>
                                    <?= substr($track['tracks_duration'], 0, -3); ?>
                                </p>
                            </div>
                        </div>
                        <?php
                        $trackNumber++;
                    endforeach;
                    ?>
                    <!-- <div class="song liked_song">
                        <div class="song_left">
                            <p>2</p>
                            <img class="song_cover" src="img/album/mudblood.jpeg" alt="">
                            <ul>
                                <li class="liked_song_name">монтана</li>
                            </ul>
                        </div>
                        <div>
                            <p>СМН</p>
                        </div>
                        <div>
                            <p class="album_name">MUDBLOOD</p>
                        </div>
                        <div class="song_right">
                            <img class="plus" src="img/plus.png" alt="">
                            <img class="heart" src="img/heart.png" alt="">
                            <p>1:43</p>
                        </div>
                    </div>
                    <div class="song liked_song">
                        <div class="song_left">
                            <p>3</p>
                            <img class="song_cover" src="img/album/mudblood.jpeg" alt="">
                            <ul>
                                <li class="liked_song_name">slipknot</li>
                            </ul>
                        </div>
                        <div>
                            <p>СМН</p>
                        </div>
                        <div>
                            <p class="album_name">MUDBLOOD</p>
                        </div>
                        <div class="song_right">
                            <img class="plus" src="img/plus.png" alt="">
                            <img class="heart" src="img/heart.png" alt="">
                            <p>1:43</p>
                        </div>
                    </div>
                    <div class="song liked_song">
                        <div class="song_left">
                            <p>4</p>
                            <img class="song_cover" src="img/album/mudblood.jpeg" alt="">
                            <ul>
                                <li class="liked_song_name">jackass</li>
                            </ul>
                        </div>
                        <div>
                            <p>СМН</p>
                        </div>
                        <div>
                            <p class="album_name">MUDBLOOD</p>
                        </div>
                        <div class="song_right">
                            <img class="plus" src="img/plus.png" alt="">
                            <img class="heart" src="img/heart.png" alt="">
                            <p>1:43</p>
                        </div>
                    </div>
                    <div class="song liked_song">
                        <div class="song_left">
                            <p>5</p>
                            <img class="song_cover" src="img/album/mudblood.jpeg" alt="">
                            <ul>
                                <li class="liked_song_name">паранойя</li>
                            </ul>
                        </div>
                        <div>
                            <p>СМН</p>
                        </div>
                        <div>
                            <p class="album_name">MUDBLOOD</p>
                        </div>
                        <div class="song_right">
                            <img class="plus" src="img/plus.png" alt="">
                            <img class="heart" src="img/heart.png" alt="">
                            <p>1:43</p>
                        </div>
                    </div> -->
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>

</body>

</html>