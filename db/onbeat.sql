-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 19 2024 г., 22:34
-- Версия сервера: 5.7.39
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `onbeat`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Albums`
--

CREATE TABLE `Albums` (
  `AlbumID` int(11) NOT NULL,
  `Title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Artist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CoverImage` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Albums`
--

INSERT INTO `Albums` (`AlbumID`, `Title`, `Artist`, `CoverImage`) VALUES
(1, 'Геометрия тьмы\r\n', '\r\nPyrokinesis', '../album_cover/1.jpeg'),
(2, 'Mudblood\r\n', '\r\nCMH', '../album_cover/2.jpeg'),
(3, 'Hellboy\r\n', '\r\nLil Peep', '../album_cover/3.png'),
(4, 'Last One\r\n', '\r\nGREEN ORXNGE', '../album_cover/4.jpeg'),
(5, 'LATE NIGHT SHOW\r\n', '\r\ndlb', '../album_cover/5.jpeg'),
(6, 'VAWË', 'OG Buda', '../rec_cover/1.jpeg'),
(7, 'Разбалованная', 'Скриптонит', '../rec_cover/2.jpeg'),
(8, 'Рапсодия Конца Света', 'GONE.Fludd', '../rec_cover/3.jpeg'),
(9, 'VARSKVA', 'Big Baby Tape', '../rec_cover/4.jpeg'),
(10, 'V.O.L.G.A', 'f0lk', '../rec_cover/5.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `AlbumTracks`
--

CREATE TABLE `AlbumTracks` (
  `AlbumTrackID` int(11) NOT NULL,
  `AlbumID` int(11) DEFAULT NULL,
  `TrackID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `FavoriteAlbums`
--

CREATE TABLE `FavoriteAlbums` (
  `FavoriteAlbumID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `AlbumID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `FavoriteAlbums`
--

INSERT INTO `FavoriteAlbums` (`FavoriteAlbumID`, `UserID`, `AlbumID`) VALUES
(1, 4, 1),
(2, 4, 2),
(3, 4, 3),
(4, 4, 4),
(5, 4, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `FavoriteTracks`
--

CREATE TABLE `FavoriteTracks` (
  `FavoriteTrackID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `TrackID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `FavoriteTracks`
--

INSERT INTO `FavoriteTracks` (`FavoriteTrackID`, `UserID`, `TrackID`) VALUES
(1, 4, 1),
(2, 4, 9),
(3, 4, 10),
(4, 4, 8),
(5, 4, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `Playlists`
--

CREATE TABLE `Playlists` (
  `PlaylistID` int(11) NOT NULL,
  `Title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AuthorID` int(11) DEFAULT NULL,
  `CoverImage` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Playlists`
--

INSERT INTO `Playlists` (`PlaylistID`, `Title`, `AuthorID`, `CoverImage`) VALUES
(1, 'playlist_1', 4, '../playlist_cover/playlist.jpeg'),
(2, 'playlist_2', 4, '../playlist_cover/playlist2.jpeg'),
(3, 'playlist_3', 4, '../playlist_cover/playlist.png'),
(4, 'playlist_4', 4, '../playlist_cover/playlist2.png'),
(5, 'playlist_5', 4, '../playlist_cover/playlist1.png'),
(6, 'Осенняя', 1, '../collections/1.png'),
(7, 'В тренде', 1, '../collections/2.png'),
(8, 'Новинки', 1, '../collections/3.png'),
(9, 'Вечерняя', 1, '../collections/4.png'),
(10, 'Хиты', 1, '../collections/5.png');

-- --------------------------------------------------------

--
-- Структура таблицы `PlaylistTracks`
--

CREATE TABLE `PlaylistTracks` (
  `PlaylistTrackID` int(11) NOT NULL,
  `PlaylistID` int(11) DEFAULT NULL,
  `TrackID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Tracks`
--

CREATE TABLE `Tracks` (
  `TrackID` int(11) NOT NULL,
  `Title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Artist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AlbumTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Duration` time DEFAULT NULL,
  `CoverImage` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Tracks`
--

INSERT INTO `Tracks` (`TrackID`, `Title`, `Artist`, `AlbumTitle`, `Duration`, `CoverImage`) VALUES
(1, 'Дом ленинградского техно', 'CMH', 'MUDBLOOD', '02:29:00', '../song_cover/1.jpeg'),
(2, 'Священный рэйв', 'ATL', 'Лимб', '02:45:00', '../song_cover/3.jpeg'),
(3, 'Шаман', 'ATL', 'Лимб', '01:59:00', '../song_cover/3.jpeg'),
(4, 'В унисон', 'ATL', 'Лимб', '02:17:00', '../song_cover/3.jpeg'),
(5, 'Архитектор', 'ATL', 'Лимб', '02:28:00', '../song_cover/3.jpeg'),
(6, 'Block Baby', 'Kizaru', 'BORN TO TRAP', '03:28:00', '../song_cover/8.jpeg'),
(7, 'Изи арифметика', 'Kizaru', 'BORN TO TRAP', '02:30:00', '../song_cover/8.jpeg'),
(8, 'Ex Bitch', 'XXXTentacion', 'Bad Vibes Forever', '02:01:00', '../song_cover/8.jpeg'),
(9, 'Ugly', 'XXXTentacion', 'Bad Vibes Forever', '01:41:00', '../song_cover/10.jpeg'),
(10, 'Girls', 'Lil Peep', 'HELLBOY', '01:43:00', '../song_cover/9.png');

-- --------------------------------------------------------

--
-- Структура таблицы `UserPlaylists`
--

CREATE TABLE `UserPlaylists` (
  `UserPlaylistID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `PlaylistID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PhoneNumber` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Avatar` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`UserID`, `Name`, `PhoneNumber`, `Email`, `Password`, `Avatar`) VALUES
(1, '123', '799999999999', 'test@mail.ru', '123', '../img/avatar/Ресурс 3.png'),
(4, '123', '123', 'pankovama@list.ru', '$2y$10$GVV2910JYAccrLf9YBTe5efeAwx.mSzTEvkgXWdcFwrum1eD15oZu', '../avatar/изображение_2024-02-19_215758206.png');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Albums`
--
ALTER TABLE `Albums`
  ADD PRIMARY KEY (`AlbumID`);

--
-- Индексы таблицы `AlbumTracks`
--
ALTER TABLE `AlbumTracks`
  ADD PRIMARY KEY (`AlbumTrackID`),
  ADD KEY `AlbumID` (`AlbumID`),
  ADD KEY `TrackID` (`TrackID`);

--
-- Индексы таблицы `FavoriteAlbums`
--
ALTER TABLE `FavoriteAlbums`
  ADD PRIMARY KEY (`FavoriteAlbumID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `AlbumID` (`AlbumID`);

--
-- Индексы таблицы `FavoriteTracks`
--
ALTER TABLE `FavoriteTracks`
  ADD PRIMARY KEY (`FavoriteTrackID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `TrackID` (`TrackID`);

--
-- Индексы таблицы `Playlists`
--
ALTER TABLE `Playlists`
  ADD PRIMARY KEY (`PlaylistID`),
  ADD KEY `AuthorID` (`AuthorID`);

--
-- Индексы таблицы `PlaylistTracks`
--
ALTER TABLE `PlaylistTracks`
  ADD PRIMARY KEY (`PlaylistTrackID`),
  ADD KEY `PlaylistID` (`PlaylistID`),
  ADD KEY `TrackID` (`TrackID`);

--
-- Индексы таблицы `Tracks`
--
ALTER TABLE `Tracks`
  ADD PRIMARY KEY (`TrackID`);

--
-- Индексы таблицы `UserPlaylists`
--
ALTER TABLE `UserPlaylists`
  ADD PRIMARY KEY (`UserPlaylistID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `PlaylistID` (`PlaylistID`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Albums`
--
ALTER TABLE `Albums`
  MODIFY `AlbumID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `AlbumTracks`
--
ALTER TABLE `AlbumTracks`
  MODIFY `AlbumTrackID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `FavoriteAlbums`
--
ALTER TABLE `FavoriteAlbums`
  MODIFY `FavoriteAlbumID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `FavoriteTracks`
--
ALTER TABLE `FavoriteTracks`
  MODIFY `FavoriteTrackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Playlists`
--
ALTER TABLE `Playlists`
  MODIFY `PlaylistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `PlaylistTracks`
--
ALTER TABLE `PlaylistTracks`
  MODIFY `PlaylistTrackID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Tracks`
--
ALTER TABLE `Tracks`
  MODIFY `TrackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `UserPlaylists`
--
ALTER TABLE `UserPlaylists`
  MODIFY `UserPlaylistID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `AlbumTracks`
--
ALTER TABLE `AlbumTracks`
  ADD CONSTRAINT `albumtracks_ibfk_1` FOREIGN KEY (`AlbumID`) REFERENCES `Albums` (`AlbumID`),
  ADD CONSTRAINT `albumtracks_ibfk_2` FOREIGN KEY (`TrackID`) REFERENCES `Tracks` (`TrackID`);

--
-- Ограничения внешнего ключа таблицы `FavoriteAlbums`
--
ALTER TABLE `FavoriteAlbums`
  ADD CONSTRAINT `favoritealbums_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`),
  ADD CONSTRAINT `favoritealbums_ibfk_2` FOREIGN KEY (`AlbumID`) REFERENCES `Albums` (`AlbumID`);

--
-- Ограничения внешнего ключа таблицы `FavoriteTracks`
--
ALTER TABLE `FavoriteTracks`
  ADD CONSTRAINT `favoritetracks_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`),
  ADD CONSTRAINT `favoritetracks_ibfk_2` FOREIGN KEY (`TrackID`) REFERENCES `Tracks` (`TrackID`);

--
-- Ограничения внешнего ключа таблицы `Playlists`
--
ALTER TABLE `Playlists`
  ADD CONSTRAINT `playlists_ibfk_1` FOREIGN KEY (`AuthorID`) REFERENCES `Users` (`UserID`);

--
-- Ограничения внешнего ключа таблицы `PlaylistTracks`
--
ALTER TABLE `PlaylistTracks`
  ADD CONSTRAINT `playlisttracks_ibfk_1` FOREIGN KEY (`PlaylistID`) REFERENCES `Playlists` (`PlaylistID`),
  ADD CONSTRAINT `playlisttracks_ibfk_2` FOREIGN KEY (`TrackID`) REFERENCES `Tracks` (`TrackID`);

--
-- Ограничения внешнего ключа таблицы `UserPlaylists`
--
ALTER TABLE `UserPlaylists`
  ADD CONSTRAINT `userplaylists_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`),
  ADD CONSTRAINT `userplaylists_ibfk_2` FOREIGN KEY (`PlaylistID`) REFERENCES `Playlists` (`PlaylistID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
