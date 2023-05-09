-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 09, 2023 at 07:05 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sagatave4`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorijas`
--

DROP TABLE IF EXISTS `kategorijas`;
CREATE TABLE IF NOT EXISTS `kategorijas` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nosaukums` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategorijas`
--

INSERT INTO `kategorijas` (`id`, `nosaukums`) VALUES
(1, 'Elektronika'),
(2, 'MÄ“beles'),
(3, 'Sporta inventÄrs');

-- --------------------------------------------------------

--
-- Table structure for table `lapas`
--

DROP TABLE IF EXISTS `lapas`;
CREATE TABLE IF NOT EXISTS `lapas` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nosaukums` varchar(100) NOT NULL,
  `taka` varchar(120) NOT NULL,
  `saturs` text,
  `laiks` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lapas`
--

INSERT INTO `lapas` (`id`, `nosaukums`, `taka`, `saturs`, `laiks`) VALUES
(1, 'Sākums', 'sakums', 'Esiet sveicināti!', '2022-07-22 09:14:53'),
(2, 'Kontakti9', 'kontakti', 't.20626252', '2022-07-29 08:09:52'),
(3, 'Kontakti', 'kontakti', 't.20626252', '2022-07-22 09:16:06'),
(11, 'Par mums2', 'par-mums2', 'Par mums saturs....', '2022-07-29 07:52:54'),
(14, 'Kontakti6', 'kontakt6', '6666', '2022-07-29 08:21:57'),
(23, 'ttt', 'ttt', 'tttdfdf', '2022-07-29 09:27:56'),
(24, 'ttt2', 'xvxcvxcv', 'xcvxcvxcv', '2022-07-29 09:31:33');

-- --------------------------------------------------------

--
-- Table structure for table `lietotaji`
--

DROP TABLE IF EXISTS `lietotaji`;
CREATE TABLE IF NOT EXISTS `lietotaji` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `e_pasts` varchar(150) NOT NULL,
  `parole` varchar(255) NOT NULL,
  `segvards` varchar(50) DEFAULT NULL,
  `loma` varchar(10) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `apraksts` text,
  `registracijas_laiks` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lietotaji`
--

INSERT INTO `lietotaji` (`id`, `e_pasts`, `parole`, `segvards`, `loma`, `foto`, `apraksts`, `registracijas_laiks`) VALUES
(1, 'admin@webkursi.lv', '$2y$10$5IrCkRjPgVatzgzbPFgDEOZhuvYIumU4k9LnWKpm9oINfcGBJYWK2', 'Ansis2', 'admin', '', '', '2022-08-05 08:53:10'),
(2, 'janis@gmail.com', '$2y$10$5IrCkRjPgVatzgzbPFgDEOZhuvYIumU4k9LnWKpm9oINfcGBJYWK2', 'JÄnis3', 'user', '...', '...', '2022-08-05 09:06:10'),
(4, 'ieva@gmail.com', '$2y$10$5IrCkRjPgVatzgzbPFgDEOZhuvYIumU4k9LnWKpm9oINfcGBJYWK2', 'Ieva2', 'user', 'images/ieva1.jpg', 'cccccccccccccccccc', '2022-08-12 07:12:32'),
(5, 't3', '$2y$10$5IrCkRjPgVatzgzbPFgDEOZhuvYIumU4k9LnWKpm9oINfcGBJYWK2', 't3', 'user', 't3', 't3', '2022-08-12 07:25:12'),
(6, 'arturs@gmail.com', '$2y$10$DAeG/EwKujzZ/lYziS9cveRr7Ttte5l7HyOc6kNN7.Gk373NEsKAK', 'ArtÅ«rs2', 'user', '', '....', '2022-08-19 06:34:18'),
(7, 'anna@gmail.com', '$2y$10$5IrCkRjPgVatzgzbPFgDEOZhuvYIumU4k9LnWKpm9oINfcGBJYWK2', 'Anna', 'user', '', '...', '2022-08-19 06:41:52'),
(8, 'dace@gmail.com', '$2y$10$6UzO9zRsADcmoyiXabn1rutLw6B33IELJLWh/mpPFK47QYsDuzaJK', 'Dace', 'user', '', 'gdfgdfgdf', '2022-08-19 07:12:44'),
(9, 't4', '$2y$10$drjMAcc7e8Cw8Qv4gFCiWOKjKVi0nnXqqYkkwKDSD4MmOkgCL5Ha.', 't4', 'user', '', '', '2022-08-19 09:15:33'),
(10, 't5', '$2y$10$Pi3ZwZc0wmWjgik0vJBGbOQFWxuWqjjdmaVrGogjm2jFwUwYdXxz2', '123', 'user', '', 'gfgf', '2022-08-19 09:22:43'),
(11, 't8', '$2y$10$Lf4Me8ssUE9nRshubwT9IuWm6nZ/ESmdn8tzgAjMIb4v8wqWDxC7G', 't8', 'user', '', 'gfgf', '2022-08-19 09:25:41');

-- --------------------------------------------------------

--
-- Table structure for table `pasutijuma_preces`
--

DROP TABLE IF EXISTS `pasutijuma_preces`;
CREATE TABLE IF NOT EXISTS `pasutijuma_preces` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pasutijuma_id` int(11) NOT NULL,
  `preces_id` int(11) NOT NULL,
  `daudzums` int(6) NOT NULL,
  `cena` decimal(6,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasutijuma_preces`
--

INSERT INTO `pasutijuma_preces` (`id`, `pasutijuma_id`, `preces_id`, `daudzums`, `cena`) VALUES
(1, 1, 1, 5, '0.00'),
(2, 1, 7, 2, '0.00'),
(3, 2, 1, 2, '0.00'),
(4, 2, 3, 1, '0.00'),
(5, 2, 6, 1, '0.00'),
(6, 3, 3, 1, '0.00'),
(7, 4, 1, 1, '0.00'),
(8, 5, 1, 2, '49.00'),
(9, 5, 6, 2, '600.00'),
(10, 5, 7, 2, '250.00'),
(11, 7, 3, 3, '300.00'),
(12, 7, 6, 1, '600.00'),
(13, 8, 8, 1, '350.00'),
(14, 9, 4, 1, '600.00'),
(15, 9, 6, 1, '600.00'),
(16, 9, 7, 1, '250.00'),
(17, 10, 1, 1, '49.00'),
(18, 10, 3, 3, '300.00');

-- --------------------------------------------------------

--
-- Table structure for table `pasutijumi`
--

DROP TABLE IF EXISTS `pasutijumi`;
CREATE TABLE IF NOT EXISTS `pasutijumi` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lietotaja_id` int(11) NOT NULL,
  `laiks` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statuss` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasutijumi`
--

INSERT INTO `pasutijumi` (`id`, `lietotaja_id`, `laiks`, `statuss`) VALUES
(1, 1, '2022-09-09 08:54:03', 'pasÅ«tÄ«jums saÅ†emts'),
(2, 0, '2022-09-09 08:57:39', 'pasÅ«tÄ«jums saÅ†emts'),
(3, 0, '2022-09-09 09:01:03', 'pasÅ«tÄ«jums saÅ†emts'),
(4, 2, '2022-09-09 09:14:29', 'pasÅ«tÄ«jums saÅ†emts'),
(5, 2, '2022-09-09 09:21:58', 'pasÅ«tÄ«jums saÅ†emts'),
(6, 1, '2022-09-09 09:24:35', 'pasÅ«tÄ«jums saÅ†emts'),
(7, 1, '2022-09-16 06:22:42', 'pasÅ«tÄ«jums saÅ†emts'),
(8, 1, '2022-12-28 07:24:36', 'pasÅ«tÄ«jums saÅ†emts'),
(9, 1, '2023-01-04 07:56:19', 'pasÅ«tÄ«jums saÅ†emts'),
(10, 1, '2023-01-04 16:58:51', 'pasÅ«tÄ«jums saÅ†emts');

-- --------------------------------------------------------

--
-- Table structure for table `preces`
--

DROP TABLE IF EXISTS `preces`;
CREATE TABLE IF NOT EXISTS `preces` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nosaukums` varchar(255) NOT NULL,
  `cena` decimal(6,2) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `apraksts` text,
  `kategorijas_id` int(11) DEFAULT NULL,
  `noliktava` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `preces`
--

INSERT INTO `preces` (`id`, `nosaukums`, `cena`, `foto`, `apraksts`, `kategorijas_id`, `noliktava`) VALUES
(1, 'Gludeklis Philips 7', '49.00', 'uploads/gludeklis.png', 'Apraksts par gludekli...', 1, 3),
(3, 'Telefons Samsung A33', '300.00', 'uploads/telefons-samsung-galaxy-a33-5g-128gb.png', '....', 1, 5),
(4, 'Ledusskapis LG ddgfg dfffd', '600.00', 'uploads/no-image.jpg', '...', 1, 2),
(6, 'Drons', '600.00', 'uploads/drons.jpg', '....', 1, 5),
(7, 'DÄ«vÄns Nr.1', '250.00', 'uploads/divans.jpg', '....', 2, 1),
(8, 'DÄ«vÄns Nr.2', '350.00', 'uploads/divans2.jpg', '...', 2, 1),
(9, 'Skapis', '200.00', 'uploads/skapis.jpg', '...', 2, 2),
(10, 'Gludeklis Philips 7', '49.00', 'uploads/gludeklis.png', 'Apraksts par gludekli...', 1, 3),
(11, 'Telefons Samsung A33', '300.00', 'uploads/telefons-samsung-galaxy-a33-5g-128gb.png', '....', 1, 5),
(12, 'Ledusskapis LG ddgfg dfffd', '600.00', 'uploads/no-image.jpg', '...', 1, 2),
(13, 'Drons', '600.00', 'uploads/drons.jpg', '....', 1, 5),
(14, 'DÄ«vÄns Nr.1', '250.00', 'uploads/divans.jpg', '....', 2, 1),
(15, 'DÄ«vÄns Nr.2', '350.00', 'uploads/divans2.jpg', '...', 2, 1),
(16, 'Skapis', '200.00', 'uploads/skapis.jpg', '...', 2, 2),
(17, 'Gludeklis Philips 7', '49.00', 'uploads/gludeklis.png', 'Apraksts par gludekli...', 1, 3),
(18, 'Telefons Samsung A33', '300.00', 'uploads/telefons-samsung-galaxy-a33-5g-128gb.png', '....', 1, 5),
(19, 'Ledusskapis LG ddgfg dfffd', '600.00', 'uploads/no-image.jpg', '...', 1, 2),
(20, 'Drons', '600.00', 'uploads/drons.jpg', '....', 1, 5),
(21, 'DÄ«vÄns Nr.1', '250.00', 'uploads/divans.jpg', '....', 2, 1),
(22, 'DÄ«vÄns Nr.2', '350.00', 'uploads/divans2.jpg', '...', 2, 1),
(23, 'Skapis', '200.00', 'uploads/skapis.jpg', '...', 2, 2),
(24, 'Gludeklis Philips 7', '49.00', 'uploads/gludeklis.png', 'Apraksts par gludekli...', 1, 3),
(25, 'Telefons Samsung A33', '300.00', 'uploads/telefons-samsung-galaxy-a33-5g-128gb.png', '....', 1, 5),
(26, 'Ledusskapis LG ddgfg dfffd', '600.00', 'uploads/no-image.jpg', '...', 1, 2),
(27, 'Drons', '600.00', 'uploads/drons.jpg', '....', 1, 5),
(28, 'DÄ«vÄns Nr.1', '250.00', 'uploads/divans.jpg', '....', 2, 1),
(29, 'DÄ«vÄns Nr.2', '350.00', 'uploads/divans2.jpg', '...', 2, 1),
(30, 'Skapis', '200.00', 'uploads/skapis.jpg', '...', 2, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
