-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 21, 2020 at 03:13 PM
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
-- Table structure for table `carteantenne`
--

DROP TABLE IF EXISTS `carteantenne`;
CREATE TABLE IF NOT EXISTS `carteantenne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commune` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `transform` varchar(100) NOT NULL,
  `href` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `commune` (`commune`)
) ENGINE=MyISAM AUTO_INCREMENT=10003 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carteantenne`
--

INSERT INTO `carteantenne` (`id`, `commune`, `width`, `height`, `transform`, `href`) VALUES
(6, 48, 100, 100, 'translate(502.37 200.01), scale(0.7)', 'images/Antenne.png'),
(7, 61, 100, 100, 'translate(185.37 90.01), scale(0.7)', 'images/Antenne.png'),
(8, 15, 100, 100, 'translate(390.37 360.01), scale(0.7)', 'images/Antenne.png'),
(9, 78, 100, 100, 'translate(370.37 140.01), scale(0.7)', 'images/Antenne.png'),
(10000, 10000, 100, 20, 'translate(75.0 -16.00), scale(2.4)', 'images/angouleme.png'),
(10001, 10001, 100, 20, 'translate(30.00 520.00), scale(2.4)', 'images/bordeaux.png'),
(10002, 10002, 100, 20, 'translate(750.00 300.00), scale(2.4)', 'images/perigueux.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
