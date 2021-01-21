-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 16, 2020 at 09:48 AM
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
-- Table structure for table `trajet`
--

DROP TABLE IF EXISTS `trajet`;
CREATE TABLE IF NOT EXISTS `trajet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_debut` datetime DEFAULT NULL,
  `date_fin` datetime DEFAULT NULL,
  `conducteur` int(11) NOT NULL,
  `beneficiaire` int(11) NOT NULL,
  `depart` int(11) NOT NULL,
  `arrivee` int(11) NOT NULL,
  `aller_retour` int(11) NOT NULL,
  `distance` int(11) NOT NULL,
  `motif` varchar(255) NOT NULL,
  `tra_type` varchar(20) NOT NULL,
  `gare` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `valide` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trajet`
--

INSERT INTO `trajet` (`id`, `date_debut`, `date_fin`, `conducteur`, `beneficiaire`, `depart`, `arrivee`, `aller_retour`, `distance`, `motif`, `type`, `gare`, `active`, `valide`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, NULL, NULL, 0, 0, 0, 0, 0, 0, 'dsfqsd', '', 0, 0, 0, '2020-08-16 09:47:27', 0, NULL, 0),
(2, NULL, NULL, 0, 0, 0, 0, 0, 0, 'fdsqf', '', 0, 0, 0, '2020-08-16 09:47:27', 0, NULL, 0),
(3, NULL, NULL, 0, 0, 0, 0, 0, 0, 'fdsfq', '', 0, 0, 0, '2020-08-16 09:47:27', 0, NULL, 0),
(4, NULL, NULL, 0, 0, 0, 0, 0, 0, 'cwv', '', 0, 0, 0, '2020-08-16 09:47:27', 0, NULL, 0),
(5, NULL, NULL, 0, 0, 0, 0, 0, 0, 'dfsf', '', 0, 0, 0, '2020-08-16 09:47:27', 0, NULL, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
