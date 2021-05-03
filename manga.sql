-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 03 2021 г., 15:26
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `manga`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id_bookmarks` int(11) NOT NULL,
  `id_manga` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `chapter` int(11) DEFAULT NULL,
  `page` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bookmarks`
--

INSERT INTO `bookmarks` (`id_bookmarks`, `id_manga`, `id_user`, `type`, `volume`, `chapter`, `page`, `created_at`, `updated_at`) VALUES
(4, 8, 4, 'WATCHING', 2, 7, 0, '2021-01-05 12:26:50', '2021-01-08 12:24:01'),
(5, 8, 2, 'PLANED', NULL, NULL, NULL, '2021-01-05 13:19:50', '2021-01-05 16:19:50'),
(6, 8, 1, 'WATCHING', 2, 8, 0, '2021-01-06 08:27:40', '2021-02-20 11:24:23'),
(16, 8, 3, 'WATCHING', 2, 13, 28, '2021-01-08 05:35:26', '2021-01-10 14:04:53'),
(22, 8, 6, 'WATCHING', 1, 1, 0, '2021-01-10 06:57:37', '2021-01-10 09:57:40'),
(23, 10, 1, 'WATCHING', 1, 1, 0, '2021-02-02 11:34:58', '2021-02-02 15:48:29');

-- --------------------------------------------------------

--
-- Структура таблицы `chapter`
--

CREATE TABLE `chapter` (
  `id_chapter` int(11) NOT NULL,
  `id_manga` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `volume` varchar(255) DEFAULT NULL,
  `chapter_title` varchar(255) DEFAULT NULL,
  `chapter` varchar(255) DEFAULT NULL,
  `images` longtext DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chapter`
--

INSERT INTO `chapter` (`id_chapter`, `id_manga`, `id_user`, `volume`, `chapter_title`, `chapter`, `images`, `active`, `created_at`, `updated_at`) VALUES
(16, 8, 1, '2', 'Дух. Плоть. Кости', '9', 'https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p001.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p002.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p003.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p004.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p005.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p006.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p007.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p008.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p009.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p010.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p011.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p012.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p013.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p014.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p015.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p016.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p017.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p018.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p019.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p020.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p021.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p022.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch009/houseki_no_kuni_vol2_ch009_p023.jpg', 0, '2021-01-10 07:34:03', '2021-01-10 10:34:03'),
(15, 8, 1, '2', 'Море', '8', 'https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p001.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p002.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p003.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p004.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p005.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p006.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p007.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p008.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p009.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p010.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p011.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p012.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p013.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p014.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p015.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p016.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p017.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p018.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p019.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p020.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p021.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p022.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p023.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch008/houseki_no_kuni_vol2_ch008_p024.jpg', 0, '2021-01-10 07:30:56', '2021-01-10 10:30:56'),
(7, 8, 3, '1', 'Фосфофиллит', '1', 'https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p001.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p002.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p003.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p004.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p005.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p006.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p007.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p008.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p009.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p010.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p011.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p012.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p013.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p014.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p015.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p016.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p017.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p018.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p019.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p020.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p021.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p022.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p023.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p024.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p025.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p026.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p027.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p028.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p029.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p030.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p031.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p032.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p033.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p034.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p035.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p036.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p037.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p038.jpg', 0, '2021-01-05 12:04:18', '2021-01-05 15:04:18'),
(8, 8, 3, '1', 'Киноварь', '2', 'https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p001.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p002.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p003.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p004.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p005.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p006.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p007.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p008.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p009.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p010.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p011.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p012.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p013.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p014.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p015.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p016.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p017.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p018.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p019.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p020.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p021.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p022.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p023.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p024.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p025.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p026.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p027.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p028.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p029.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p030.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p031.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p032.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p033.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p034.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p035.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p036.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p037.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch002/houseki_no_kuni_vol1_ch002_p038.jpg', 0, '2021-01-05 12:36:23', '2021-01-05 15:36:23'),
(9, 8, 3, '1', 'Алмаз', '3', 'https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p001.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p002.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p003.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p004.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p005.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p006.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p007.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p008.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p009.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p010.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p011.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p012.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p013.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p014.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p015.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p016.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p017.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p018.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p019.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p020.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p021.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p022.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p023.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p024.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p025.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p026.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p027.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p028.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p029.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p030.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p031.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p032.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p033.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p034.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p035.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p036.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p037.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch003/houseki_no_kuni_vol1_ch003_p038.jpg', 0, '2021-01-06 12:56:13', '2021-01-06 15:56:13'),
(10, 8, 1, '1', 'Кохлеа', '4', 'https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p001.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p002.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p003.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p004.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p005.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p006.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p007.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p008.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p009.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p010.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p011.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p012.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p013.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p014.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p015.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p016.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p017.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p018.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p019.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p020.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p021.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p022.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p023.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch004/houseki_no_kuni_vol1_ch004_p024.jpg', 0, '2021-01-07 14:02:30', '2021-01-07 17:02:30'),
(11, 8, 3, '1', 'Метаморфоза', '5', 'https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p001.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p002.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p003.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p004.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p005.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p006.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p007.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p008.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p009.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p010.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p011.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p012.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p013.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p014.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p015.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p016.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p017.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p018.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p019.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p020.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p021.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p022.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p023.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch005/houseki_no_kuni_vol1_ch005_p024.jpg', 0, '2021-01-08 05:37:25', '2021-01-08 08:37:25'),
(12, 8, 3, '1', 'Извлечение', '6', 'https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p001.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p002.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p003.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p004.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p005.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p006.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p007.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p008.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p009.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p010.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p011.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p012.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p013.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p014.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p015.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p016.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p017.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p018.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p019.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p020.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p021.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p022.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p023.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p024.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p025.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p026.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch006/houseki_no_kuni_vol1_ch006_p027.jpg', 0, '2021-01-08 05:40:32', '2021-01-08 08:40:32'),
(13, 8, 3, '2', 'Вентрикосус', '7', 'https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p001.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p002.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p003.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p004.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p005.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p006.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p007.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p008.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p009.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p010.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p011.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p012.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p013.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p014.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p015.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p016.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p017.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p018.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p019.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p020.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p021.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p022.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p023.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p024.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p025.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p026.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p027.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p028.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch007/houseki_no_kuni_vol2_ch007_p029.jpg', 0, '2021-01-08 05:43:54', '2021-01-08 08:43:54'),
(17, 8, 1, '2', 'Возвращение', '10', 'https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p001.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p002.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p003.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p004.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p005.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p006.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p007.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p008.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p009.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p010.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p011.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p012.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p013.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p014.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p015.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p016.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p017.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p018.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p019.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p020.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p021.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p022.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p023.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p024.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p025.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p026.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p027.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch010/houseki_no_kuni_vol2_ch010_p028.jpg', 0, '2021-01-10 07:38:48', '2021-01-10 10:38:48'),
(18, 8, 1, '2', 'Новые ноги', '11', 'https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p001.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p002.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p003.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p004.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p005.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p006.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p007.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p008.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p009.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p010.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p011.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p012.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p013.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p014.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p015.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p016.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p017.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p018.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p019.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p020.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p021.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p022.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p023.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p024.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p025.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p026.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p027.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p028.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p029.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch011/houseki_no_kuni_vol2_ch011_p030.jpg', 0, '2021-01-10 07:44:06', '2021-01-10 10:44:06'),
(19, 8, 3, '2', 'Жёлталмаз', '12', 'https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p001.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p002.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p003.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p004.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p005.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p006.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p007.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p008.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p009.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p010.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p011.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p012.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p013.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p014.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p015.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p016.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p017.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p018.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p019.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p020.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p021.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p022.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p023.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p024.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p025.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p026.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p027.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch012/houseki_no_kuni_vol2_ch012_p028.jpg', 0, '2021-01-10 07:57:55', '2021-01-10 10:57:55'),
(20, 8, 3, '2', 'Двойники', '13', 'https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p001.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p002.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p003.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p004.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p005.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p006.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p007.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p008.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p009.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p010.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p011.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p012.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p013.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p014.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p015.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p016.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p017.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p018.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p019.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p020.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p021.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p022.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p023.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p024.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p025.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p026.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p029.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p030.jpg,https://img4.desu.me/manga/rus/houseki_no_kuni/vol02_ch013/houseki_no_kuni_vol2_ch013_p031.jpg', 0, '2021-01-10 08:00:43', '2021-01-10 11:00:43'),
(21, 10, 1, '1', 'Трагедия', '1', 'https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/001.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/002.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/003.webp,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/004.jpg,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/005.jpg,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/006.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/007.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/008.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/009.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/010.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/011.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/012.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/013.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/014.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/015.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/016.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/017.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/018.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/019.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/020.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/021.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/022.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/023.webp,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/024.webp,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/025.webp,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/026.webp,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/027.webp,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/028.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/029.webp,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/030.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/031.webp,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/032.webp,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/033.webp,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/034.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/035.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/036.png,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/037.webp,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/038.jpg,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/039.webp,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/040.webp,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/041.webp,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/042.webp,https://mangabook.org/uploads/manga/tokyo-ghoul/chapters/Vol.1-Ch.1/043.webp', 0, '2021-01-11 04:56:47', '2021-01-11 07:56:47');

-- --------------------------------------------------------

--
-- Структура таблицы `collection`
--

CREATE TABLE `collection` (
  `id_collection` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `collection_title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `manga_collection` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `id_manga` int(11) DEFAULT NULL,
  `id_post` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `comment` longtext DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `reply` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id_comment`, `id_manga`, `id_post`, `id_user`, `comment`, `type`, `reply`, `created_at`, `updated_at`) VALUES
(51, 10, NULL, 1, 'Комментарий', 'manga', 0, '2021-02-02 11:36:15', '2021-02-02 14:36:15'),
(52, 10, NULL, 1, 'sdasd', 'manga', 0, '2021-02-02 12:47:46', '2021-02-02 15:47:46'),
(37, 8, NULL, 1, 'Комментарий ради комментария', 'manga', 0, '2021-01-07 03:40:16', '2021-01-09 12:25:09'),
(50, NULL, 7, 1, 'Комментарий', 'post', 0, '2021-02-02 11:35:55', '2021-02-02 14:35:55'),
(53, 10, NULL, 1, 'Комментарий', 'manga', 0, '2021-02-06 11:03:18', '2021-02-06 14:03:18');

-- --------------------------------------------------------

--
-- Структура таблицы `dialog`
--

CREATE TABLE `dialog` (
  `id_dialog` int(11) NOT NULL,
  `id_first` int(11) NOT NULL,
  `id_second` int(11) NOT NULL,
  `last_message_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `first_delete` int(1) NOT NULL,
  `second_delete` int(1) NOT NULL,
  `unread` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `dialog`
--

INSERT INTO `dialog` (`id_dialog`, `id_first`, `id_second`, `last_message_id`, `sender`, `first_delete`, `second_delete`, `unread`) VALUES
(50, 3, 1, 15, 0, 0, 0, 0),
(52, 1, 4, 16, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `directory_genres`
--

CREATE TABLE `directory_genres` (
  `id_genre` int(11) NOT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `directory_genres`
--

INSERT INTO `directory_genres` (`id_genre`, `genre`) VALUES
(10, 'арт'),
(11, 'бара'),
(12, 'боевик'),
(13, 'боевые искусства'),
(14, 'вампиры'),
(15, 'гарем'),
(16, 'гендерная интрига'),
(17, 'героическое фентези'),
(18, 'детектив'),
(19, 'дзёсэй'),
(20, 'додзинси'),
(21, 'драма'),
(22, 'игра'),
(23, 'история'),
(24, 'киберпанк'),
(25, 'комедия'),
(26, 'меха'),
(27, 'научная фантастика'),
(28, 'омегаверс'),
(29, 'повседневность'),
(30, 'постапокалиптика'),
(31, 'приключения'),
(32, 'психология'),
(33, 'романтика'),
(34, 'самурайский боевик'),
(35, 'сверхъестественное'),
(36, 'сёдзё'),
(37, 'сёдзё-ай'),
(38, 'сёнэн'),
(39, 'сёнэн-ай'),
(40, 'спорт'),
(41, 'сэйнэн'),
(42, 'трагедия'),
(43, 'триллер'),
(44, 'ужасы'),
(45, 'фентези'),
(46, 'школа'),
(47, 'эротика'),
(48, 'этти'),
(49, 'юри');

-- --------------------------------------------------------

--
-- Структура таблицы `directory_tags`
--

CREATE TABLE `directory_tags` (
  `id_tag` int(11) NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `directory_tags`
--

INSERT INTO `directory_tags` (`id_tag`, `tag`) VALUES
(3, 'аниме'),
(4, 'манга'),
(5, 'арт'),
(6, 'блог'),
(7, 'бред'),
(8, 'весна'),
(9, 'вопрос'),
(10, 'воспоминания'),
(11, 'восток'),
(12, 'грусть'),
(13, 'гурман'),
(14, 'день рождения'),
(15, 'дорама'),
(16, 'досуг'),
(17, 'дружба'),
(18, 'друзья'),
(19, 'еда'),
(20, 'жизнь'),
(21, 'зима'),
(22, 'знакомство'),
(23, 'игра'),
(24, 'история'),
(25, 'китай'),
(26, 'китайская кухня'),
(27, 'китайский язык'),
(28, 'книга'),
(29, 'комикс'),
(30, 'конкурс'),
(32, 'корея'),
(33, 'кот'),
(34, 'лето'),
(35, 'любовь'),
(36, 'люди'),
(37, 'мир'),
(38, 'мнение'),
(39, 'моё'),
(40, 'мое творческое'),
(41, 'мои рассказы'),
(42, 'мои рисунки'),
(43, 'музыка'),
(44, 'мысли'),
(45, 'мысли вслух'),
(46, 'наруто'),
(47, 'новости'),
(48, 'новый год'),
(49, 'ночь'),
(50, 'общение'),
(51, 'одиночество'),
(52, 'опрос'),
(53, 'осень'),
(54, 'панда'),
(55, 'первый пост'),
(56, 'перевод'),
(57, 'писанина'),
(58, 'повседневность'),
(59, 'помогите'),
(60, 'помощь'),
(61, 'пост'),
(62, 'поэзия'),
(63, 'праздник'),
(64, 'психология'),
(65, 'развлечение'),
(66, 'размышления'),
(67, 'рассказ'),
(68, 'рисование'),
(69, 'рисунки'),
(70, 'рисунки карандашом'),
(71, 'рисунок'),
(72, 'романтика'),
(73, 'смерть'),
(74, 'сон'),
(75, 'стихи'),
(76, 'стихотворение'),
(77, 'счастье'),
(78, 'творчество'),
(79, 'участие'),
(80, 'участник'),
(81, 'фантастика'),
(82, 'фанфик'),
(83, 'фанфики'),
(84, 'фикбук'),
(85, 'философия'),
(86, 'фильм'),
(87, 'флешмоб'),
(88, 'фото'),
(89, 'цитаты'),
(90, 'чувства'),
(91, 'школа'),
(92, 'юмор'),
(93, 'я'),
(94, 'япония'),
(95, 'прочее');

-- --------------------------------------------------------

--
-- Структура таблицы `friend`
--

CREATE TABLE `friend` (
  `id_friend` int(11) NOT NULL,
  `id_first` int(11) NOT NULL,
  `id_second` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `friend`
--

INSERT INTO `friend` (`id_friend`, `id_first`, `id_second`, `created_at`, `updated_at`) VALUES
(13, 1, 4, '2021-01-08 07:36:50', '2021-01-08 10:36:50'),
(14, 1, 3, '2021-01-08 07:36:53', '2021-01-08 10:36:53'),
(20, 4, 4, '2021-01-09 07:23:11', '2021-01-09 10:23:11'),
(21, 4, 1, '2021-01-09 07:23:24', '2021-01-09 10:23:24'),
(23, 1, 2, '2021-01-10 05:25:35', '2021-01-10 08:25:35');

-- --------------------------------------------------------

--
-- Структура таблицы `manga`
--

CREATE TABLE `manga` (
  `id_manga` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `russian_name` varchar(255) DEFAULT NULL,
  `english_name` varchar(255) DEFAULT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `images` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `release` varchar(255) DEFAULT NULL,
  `volume` varchar(255) DEFAULT NULL,
  `translation` varchar(255) DEFAULT NULL,
  `genres` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `year_of_issue` varchar(255) DEFAULT NULL,
  `translators` varchar(255) DEFAULT NULL,
  `background` longtext DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `manga`
--

INSERT INTO `manga` (`id_manga`, `id_user`, `russian_name`, `english_name`, `original_name`, `images`, `description`, `category`, `release`, `volume`, `translation`, `genres`, `author`, `year_of_issue`, `translators`, `background`, `active`, `created_at`, `updated_at`) VALUES
(10, 1, 'Токийский гуль', NULL, NULL, 'https://i.pinimg.com/736x/3e/a4/ee/3ea4eec6b99a7319c591410fa4ca7b21.jpg', 'Раса гулей существует с незапамятных времен. Ее представители вовсе не против людей, они их даже любят — преимущественно в сыром виде. Любители человечины внешне неотличимы от нас, сильны, быстры и живучи — но их мало, потому гули выработали строгие правила охоты и маскировки, а нарушителей наказывают сами или по-тихому сдают борцам с нечистью. В век науки люди знают про гулей, но как говорится, привыкли. Власти не считают людоедов угрозой, более того, рассматривают их как идеальную основу для создания суперсолдат. Эксперименты идут уже давно…\r\n\r\nНичего этого не ведал Канэки Кэн, робкий и невзрачный токийский первокурсник, безнадежно влюбленный в красавицу-интеллектуалку Ридзэ, частую гостью в кафе «Место встречи», где парень подрабатывает официантом. Не думал Кэн, что скоро самому придется стать гулем, и многие знакомые предстанут в неожиданном свете. Главному герою предстоит мучительный поиск нового пути, ибо он понял, что люди и гули похожи: просто одни друг друга жрут в прямом смысле, другие — в переносном. Правда жизни жестока, переделать ее нельзя, и силен тот, кто не отворачивается. А дальше уж как-нибудь!', 'Манга', 'Выпуск завершён', '14', 'Завершён', 'психология, боевик, ужасы, романтика, сверхъестественное, трагедия, драма, сэйнэн', 'Исида Суи', '2011', 'Naruto-Grand.Ru, Mukade Team, 104th squad, Flaming Rose', NULL, 0, '2021-01-11 04:48:37', '2021-02-02 15:55:35'),
(8, 1, 'Страна самоцветов', NULL, NULL, 'https://pbs.twimg.com/media/ELRdxIjWoAMjOYm.jpg,https://pbs.twimg.com/media/ELReAPbXkAEZ0vp.jpg,https://r1.ninemanga.com/comics/pic2/49/22513/239118/1430384300382.jpg,https://static.mangapoisk.ru/pages/bcgRuyCenOr31TakeOa4HKzMmT5eqYxEDvmI7Sja.jpg,https://pbs.twimg.com/media/ELReAQoWwAAlOas.jpg', 'Далёкое будущее. После серии катаклизмов Земля окружена шестью лунами и почти полностью покрыта океаном. На крохотном островке суши обитают 28 представителей новой расы - самоцветов. Но и они вынуждены непрерывно бороться за существование с обитателями лун. Это история сильных, хрупких и красивых созданий.', 'Манга', 'Выпуск продолжается', '12', 'Продолжается', 'психология, сэйнэн, научная фантастика, фэнтези, драма', 'Итикава Харуко', '2012', 'Probably', 'https://img4.desu.me/manga/rus/houseki_no_kuni/vol01_ch001/houseki_no_kuni_vol1_ch001_p001.jpg', 0, '2021-01-05 11:29:56', '2021-01-07 17:00:09');

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `id_dialog` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `id_addressee` int(11) NOT NULL,
  `readed` int(1) NOT NULL,
  `sender_delete` int(1) NOT NULL,
  `addressee_delete` int(1) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id_message`, `id_dialog`, `id_sender`, `id_addressee`, `readed`, `sender_delete`, `addressee_delete`, `message`) VALUES
(13, 50, 1, 3, 0, 0, 0, '1'),
(14, 50, 1, 3, 0, 0, 0, 'Привет'),
(15, 50, 3, 1, 0, 0, 0, 'Привет привет'),
(16, 52, 1, 4, 0, 0, 0, 'Соси хер');

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `image_preview` longtext DEFAULT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `post_announce` varchar(255) DEFAULT NULL,
  `post_content` longtext DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `type` varchar(30) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id_post`, `id_user`, `image_preview`, `post_title`, `post_announce`, `post_content`, `tags`, `type`, `active`, `created_at`, `updated_at`) VALUES
(7, 2, NULL, 'Начало работ', 'Данная статья является тестовой в разделе пост. Так как необходимый минимум на добавлении статьи является 255 символов содержания, то данны?...', 'Данная статья является тестовой в разделе пост. Так как необходимый минимум на добавлении статьи является 255 символов содержания, то данный текст и служит для подобных вещей. Ещё добавлю немного текста, потом ещё ещё ещё и ещё. Всё равно не хватает, так что добавлю ещё.', 'Отсутствуют', 'post', 0, '2021-01-09 05:38:01', '2021-01-09 08:55:34'),
(9, 2, NULL, 'Фикс', 'Я уменьшил количество необходимого текста для добавления поста, потому что каждый раз выдумывать по 255 символов это уже слишком. Нынешний п...', 'Я уменьшил количество необходимого текста для добавления поста, потому что каждый раз выдумывать по 255 символов это уже слишком. Нынешний порог - 50 символов.', 'Отсутствуют', 'news', 0, '2021-01-09 05:40:06', '2021-01-09 08:40:06');

-- --------------------------------------------------------

--
-- Структура таблицы `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL,
  `id_manga` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rating`
--

INSERT INTO `rating` (`id_rating`, `id_manga`, `id_user`, `rating`, `type`, `created_at`, `updated_at`) VALUES
(19, 10, 1, 10, 'manga', '2021-02-23 11:09:54', '2021-02-23 14:09:54'),
(18, 8, 1, 10, 'manga', '2021-01-10 07:19:40', '2021-01-10 10:19:40');

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE `review` (
  `id_review` int(11) NOT NULL,
  `id_manga` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `review_title` varchar(255) DEFAULT NULL,
  `review_content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `access` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `avatar` longtext DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `about` longtext DEFAULT NULL,
  `background` longtext DEFAULT NULL,
  `online` int(1) DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `access`, `username`, `email`, `remember_token`, `avatar`, `status`, `about`, `background`, `online`, `active`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$M7W.mjNoiWhPwT1M26Nf7O0mx3UsJ2.rh2nMc6LIu2nXDw8PCy3wC', '1', 'Администратор', '1@1', 'x5uZGhw6F4LCC6k4x9ZzLpfDmLj5Mcjp0yCwuVTUlv3gSW1eV91QFKD49vps', 'http://komotoz.ru/photo/zhivotnye/images/ryabchik/ryabchik_01.jpg', 'Администратор', 'Администратор данного ресурса', NULL, 1, 1, '2021-01-05 09:35:20', '2021-03-13 15:44:33'),
(2, 'moderator', '$2y$10$jCfvdG8WHTk.WB8kybyQNucNMKVUtJRJhEX0mNwk/.r2GT4ZSfmAy', '2', 'Модератор', '2@2', 'VJXdnsPIfR7K2gBRcAY0Ev6NPT89Qf3x1LKiY4ORdPCkX147HrcU1LYrqGzc', NULL, NULL, NULL, NULL, 0, 1, '2021-01-05 10:08:11', '2021-01-10 20:04:18'),
(3, 'editor', '$2y$10$zoGsC1xJsLZtdCuuXp5r7.h8aJ89PmfsV2UK/GLBpBXVDKX62oi5W', '3', 'Редактор', '3@3', 'NpX5m65hlp95ozvbxt4vwS9YTx0DwzD2PGmRLjyGNooQnFBv5p6WH50uQXoI', NULL, 'Орёл молодой', NULL, NULL, 0, 1, '2021-01-05 10:08:56', '2021-02-20 14:21:50'),
(4, 'user', '$2y$10$Zrt4ssyD/wsvsaeKHGDUEOwPswcMoVcUNbFNeR2rCSFQ1C.RhlvJu', '4', 'Пользователь', '4@4', '7eNvVPdg9fey51K1m6RZ6f2Uq1lKNokw0BP7XZFR3RDtlBHY2xAzf1HFZ681', NULL, NULL, NULL, NULL, 0, 1, '2021-01-05 10:09:20', '2021-02-25 19:07:47');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id_bookmarks`);

--
-- Индексы таблицы `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`id_chapter`);

--
-- Индексы таблицы `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id_collection`);

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`);

--
-- Индексы таблицы `dialog`
--
ALTER TABLE `dialog`
  ADD PRIMARY KEY (`id_dialog`);

--
-- Индексы таблицы `directory_genres`
--
ALTER TABLE `directory_genres`
  ADD PRIMARY KEY (`id_genre`);

--
-- Индексы таблицы `directory_tags`
--
ALTER TABLE `directory_tags`
  ADD PRIMARY KEY (`id_tag`);

--
-- Индексы таблицы `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`id_friend`);

--
-- Индексы таблицы `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`id_manga`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`);

--
-- Индексы таблицы `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`);

--
-- Индексы таблицы `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id_review`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id_bookmarks` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `chapter`
--
ALTER TABLE `chapter`
  MODIFY `id_chapter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `collection`
--
ALTER TABLE `collection`
  MODIFY `id_collection` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `dialog`
--
ALTER TABLE `dialog`
  MODIFY `id_dialog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT для таблицы `directory_genres`
--
ALTER TABLE `directory_genres`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT для таблицы `directory_tags`
--
ALTER TABLE `directory_tags`
  MODIFY `id_tag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT для таблицы `friend`
--
ALTER TABLE `friend`
  MODIFY `id_friend` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `manga`
--
ALTER TABLE `manga`
  MODIFY `id_manga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
