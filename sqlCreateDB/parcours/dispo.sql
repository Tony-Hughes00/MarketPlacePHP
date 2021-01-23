-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 06, 2020 at 02:16 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plamsitexkdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `dispo`
--

DROP TABLE IF EXISTS `dispo`;
CREATE TABLE IF NOT EXISTS `dispo` (
  `id_dispo` int(11) NOT NULL AUTO_INCREMENT,
  `id_pnm` int(5) DEFAULT NULL,
  `id_trajet` int(5) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `jour_dispo` varchar(8) DEFAULT NULL,
  `h_dbt` time DEFAULT NULL,
  `h_fin` time DEFAULT NULL,
  PRIMARY KEY (`id_dispo`)
) ENGINE=MyISAM AUTO_INCREMENT=202 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dispo`
--

INSERT INTO `dispo` (`id_dispo`, `id_pnm`, `id_trajet`, `id_user`, `jour_dispo`, `h_dbt`, `h_fin`) VALUES
(67, 41, NULL, 0, '3', '14:00:00', '15:00:00'),
(66, 41, NULL, 0, '3', '09:00:00', '12:30:00'),
(65, 41, NULL, 0, '2', '15:30:00', '16:30:00'),
(64, 41, NULL, 0, '2', '10:30:00', '12:30:00'),
(63, 43, NULL, 0, '4', '11:30:00', '15:30:00'),
(62, 43, NULL, 0, '4', '10:30:00', '15:30:00'),
(61, 43, NULL, 0, '2', '09:30:00', '12:30:00'),
(60, 43, NULL, 0, '2', '13:30:00', '17:00:00'),
(59, 43, NULL, 0, '3', '11:30:00', '15:30:00'),
(68, 46, NULL, 0, '2', '10:04:00', '12:04:00'),
(69, 46, NULL, 0, '4', '14:04:00', '16:04:00'),
(91, 0, 622, 0, '4', '16:00:00', '20:00:00'),
(90, 0, 621, 0, '4', '10:00:00', '12:00:00'),
(89, 0, 620, 0, '4', '16:00:00', '20:00:00'),
(88, 0, 619, 0, '4', '10:00:00', '12:00:00'),
(87, 0, 618, 0, '3', '16:00:00', '20:00:00'),
(86, 0, 617, 0, '3', '10:00:00', '14:00:00'),
(85, 0, 616, 0, '3', '16:00:00', '20:00:00'),
(84, 0, 615, 0, '3', '10:00:00', '14:00:00'),
(83, 0, 614, 0, '5', '22:50:00', '23:50:00'),
(92, 0, 623, 0, '4', '10:00:00', '12:00:00'),
(93, 0, 624, 0, '4', '16:00:00', '20:00:00'),
(94, 0, 625, 0, '2', '10:00:00', '14:00:00'),
(95, 0, 626, 0, '2', '16:00:00', '20:00:00'),
(96, 0, 633, 0, '1', '10:00:00', '14:00:00'),
(97, 0, 634, 0, '2', '16:00:00', '20:00:00'),
(98, 0, 633, 0, '3', '10:00:00', '14:00:00'),
(99, 0, 634, 0, '4', '16:00:00', '20:00:00'),
(100, 0, 633, 0, '5', '10:00:00', '14:00:00'),
(101, 0, 634, 0, '0', '16:00:00', '20:00:00'),
(102, 0, 633, 0, '6', '10:00:00', '14:00:00'),
(103, 0, 634, 0, '6', '16:00:00', '20:00:00'),
(104, 0, 635, 0, '1', '11:30:00', '12:30:00'),
(105, 0, 636, 0, '1', '16:30:00', '17:30:00'),
(106, 0, 635, 0, '3', '11:30:00', '12:30:00'),
(107, 0, 636, 0, '3', '16:30:00', '17:30:00'),
(108, 0, 635, 0, '5', '10:30:00', '12:30:00'),
(109, 0, 636, 0, '5', '14:30:00', '17:30:00'),
(110, 0, 648, 0, '2', '11:30:00', '13:30:00'),
(111, 0, 649, 0, '2', '15:30:00', '17:30:00'),
(112, 0, 648, 0, '4', '11:30:00', '13:30:00'),
(113, 0, 649, 0, '4', '15:30:00', '17:30:00'),
(114, 0, 1049, 0, '2', '10:58:00', '13:00:00'),
(115, 0, 1050, 0, '2', '15:00:00', '22:00:00'),
(116, 0, 1049, 0, '4', '10:00:00', '13:00:00'),
(117, 0, 1050, 0, '4', '15:00:00', '00:00:00'),
(118, 0, 1049, 0, '5', '10:00:00', '13:00:00'),
(119, 0, 1050, 0, '5', '15:00:00', '22:00:00'),
(120, 0, 1052, 0, '3', '10:45:00', '14:45:00'),
(121, 0, 1053, 0, '3', '21:45:00', '23:45:00'),
(122, 0, 1052, 0, '6', '18:45:00', '22:45:00'),
(123, 0, 1053, 0, '6', '22:45:00', '23:45:00'),
(124, 0, 1104, 0, '2', '11:45:00', '16:45:00'),
(125, 0, 1105, 0, '2', '20:45:00', '22:45:00'),
(126, 0, 1104, 0, '3', '11:00:00', '13:45:00'),
(127, 0, 1105, 0, '3', '19:00:00', '22:00:00'),
(128, 0, 1104, 0, '6', '10:45:00', '14:45:00'),
(129, 0, 1105, 0, '6', '19:45:00', '22:45:00'),
(130, 0, 1106, 0, '2', '11:45:00', '16:45:00'),
(131, 0, 1107, 0, '2', '20:45:00', '22:45:00'),
(132, 0, 1106, 0, '3', '11:00:00', '13:45:00'),
(133, 0, 1107, 0, '3', '19:00:00', '22:00:00'),
(134, 0, 1106, 0, '6', '10:45:00', '14:45:00'),
(135, 0, 1107, 0, '6', '19:45:00', '22:45:00'),
(136, 0, 1124, 0, '3', '10:30:00', '14:30:00'),
(137, 0, 1125, 0, '3', '18:00:00', '23:00:00'),
(138, 0, 1124, 0, '6', '10:00:00', '14:00:00'),
(139, 0, 1125, 0, '6', '16:30:00', '23:30:00'),
(192, 0, 1229, 0, '6', '09:00:00', '10:00:00'),
(195, 0, 1230, 0, '6', '19:00:00', '22:00:00'),
(191, 0, 1229, 0, '2', '11:30:00', '14:30:00'),
(194, 0, 1230, 0, '2', '17:30:00', '21:21:00'),
(190, 0, 1229, 0, '1', '10:45:00', '12:00:00'),
(193, 0, 1230, 0, '1', '15:45:00', '22:00:00'),
(148, 0, 1240, 0, '0', '10:00:00', '10:15:00'),
(149, 0, 1241, 0, '0', '14:00:00', '15:00:00'),
(196, NULL, NULL, 12, '2', '10:04:00', '12:04:00'),
(197, 0, NULL, 12, '4', '16:00:00', '20:00:00'),
(198, NULL, NULL, 18, '3', '10:00:00', '14:00:00'),
(199, NULL, NULL, 26, '3', '10:04:00', '12:04:00'),
(200, 0, NULL, 18, '4', '16:00:00', '20:00:00'),
(201, NULL, NULL, 24, '4', '10:00:00', '14:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;