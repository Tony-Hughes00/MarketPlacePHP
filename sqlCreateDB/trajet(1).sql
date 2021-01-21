-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 01, 2020 at 04:30 PM
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
  `conducteur` int(11) DEFAULT NULL,
  `beneficiaire` int(11) DEFAULT NULL,
  `depart` int(11) DEFAULT NULL,
  `arrivee` int(11) DEFAULT NULL,
  `aller_retour` int(11) DEFAULT NULL,
  `distance` decimal(11,0) DEFAULT NULL,
  `motif` varchar(255) DEFAULT NULL,
  `tra_type` varchar(20) DEFAULT NULL,
  `gare` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT '0',
  `valide` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date_val` datetime DEFAULT NULL,
  `add_dep_val` int(11) DEFAULT NULL,
  `add_arr_val` int(11) DEFAULT NULL,
  `correspondance` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trajet`
--

INSERT INTO `trajet` (`id`, `date_debut`, `date_fin`, `conducteur`, `beneficiaire`, `depart`, `arrivee`, `aller_retour`, `distance`, `motif`, `tra_type`, `gare`, `active`, `valide`, `status`, `date_val`, `add_dep_val`, `add_arr_val`, `correspondance`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(133, '2020-09-06 14:30:00', '2020-09-06 16:30:00', 29, NULL, 55, 160, NULL, '0', '11', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-31 12:38:28', NULL, '2020-08-31 14:38:28', NULL),
(130, '2020-09-06 14:30:00', '2020-09-06 16:30:00', NULL, 28, 54, 157, NULL, '0', '11', 'passager', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-31 12:34:30', NULL, '2020-08-31 14:34:29', NULL),
(129, '2020-09-01 09:27:00', '2020-09-01 19:24:00', 27, NULL, 153, 154, NULL, '0', '11', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-29 16:24:40', NULL, '2020-08-29 18:24:40', NULL),
(128, '2020-09-01 09:21:00', '2020-09-01 19:21:00', 29, NULL, 55, 152, NULL, '0', '11', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-29 16:21:50', NULL, '2020-08-29 18:21:50', NULL),
(127, '2020-09-01 12:00:00', '2020-09-01 13:00:00', NULL, 28, 150, 151, NULL, '0', '11', 'passager', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-29 16:20:06', NULL, '2020-08-29 18:20:06', NULL),
(126, '2020-09-02 19:00:00', '2020-09-02 20:00:00', NULL, 5, 2, 149, NULL, '0', '11', 'passager', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-29 16:16:53', NULL, '2020-08-29 18:16:53', NULL),
(125, '2020-09-05 03:57:00', '2020-09-05 16:00:00', 27, NULL, 12, 148, NULL, '0', '11', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-29 15:57:40', NULL, '2020-08-29 17:57:40', NULL),
(124, '2020-09-05 09:52:00', '2020-09-05 14:52:00', 27, NULL, 12, 147, NULL, '0', '11', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-29 15:52:44', NULL, '2020-08-29 17:52:44', NULL),
(123, '2020-09-05 10:51:00', '2020-09-05 21:51:00', 24, NULL, 145, 146, NULL, '0', '11', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-29 15:51:43', NULL, '2020-08-29 17:51:43', NULL),
(104, '2020-09-05 15:48:00', '2020-09-05 17:48:00', NULL, 1, 6, 122, NULL, '26', 'testing', 'passager', NULL, 0, 1, 1, '2020-09-05 17:59:00', NULL, NULL, 125, '2020-08-29 15:51:43', NULL, '2020-08-26 16:41:22', NULL),
(118, '2020-09-01 18:00:00', '2020-09-01 19:00:00', 29, NULL, 55, 139, NULL, '25', '16', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-29 11:00:33', NULL, '2020-08-29 13:00:33', NULL),
(119, '2020-09-01 18:00:00', '2020-09-01 19:00:00', 29, NULL, 55, 140, NULL, '25', '16', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-29 11:04:17', NULL, '2020-08-29 13:04:17', NULL),
(121, '2020-09-05 17:30:56', '2020-09-05 15:29:00', 27, NULL, 12, 143, NULL, '0', '11', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-29 15:30:56', NULL, '2020-08-29 17:30:56', NULL),
(122, '2020-09-05 15:59:00', '2020-09-05 21:50:00', 27, NULL, 12, 144, NULL, '0', '11', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-29 15:50:23', NULL, '2020-08-29 17:50:23', NULL),
(108, '2020-09-03 18:13:00', '2020-09-03 19:13:00', 29, NULL, 55, 126, NULL, NULL, 'fdsq', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-27 12:13:53', NULL, '2020-08-27 14:13:52', NULL),
(117, '2020-08-31 15:24:00', '2020-08-31 16:24:00', 26, NULL, 137, 138, NULL, NULL, '11', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-29 10:24:44', NULL, '2020-08-29 12:24:44', NULL),
(116, '2020-08-31 16:21:00', '2020-08-31 17:21:00', 26, NULL, 135, 136, NULL, NULL, '13', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-29 10:22:25', NULL, '2020-08-29 12:22:25', NULL),
(115, '2020-09-03 01:00:00', '2020-09-03 02:54:00', 27, NULL, 12, 134, NULL, NULL, 'testing', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-28 17:54:22', NULL, '2020-08-28 19:54:21', NULL),
(114, '2020-08-28 21:08:08', '2020-08-28 21:08:08', 27, NULL, 132, 133, NULL, NULL, 'march&amp;eacute;', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-28 08:34:04', NULL, '2020-08-28 10:34:04', NULL),
(113, '2020-09-02 21:52:00', '2020-09-02 22:52:00', 27, NULL, 12, 131, NULL, NULL, 'testing', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-27 18:52:43', NULL, '2020-08-27 20:52:43', NULL),
(105, '2020-09-05 10:11:00', '2020-09-05 15:05:00', NULL, 18, 5, 123, NULL, NULL, 'testing', 'passager', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-27 08:05:57', NULL, '2020-08-27 10:05:56', NULL),
(106, '2020-09-05 15:08:00', '2020-09-05 16:08:00', NULL, 1, 6, 124, NULL, NULL, 'fdsq', 'passager', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-27 08:08:38', NULL, '2020-08-27 10:08:38', NULL),
(107, '2020-09-03 19:12:00', '2020-09-03 20:12:00', NULL, 5, 2, 125, NULL, NULL, 'testing', 'passager', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-27 12:12:19', NULL, '2020-08-27 14:12:18', NULL),
(85, '2020-09-05 00:00:00', '2020-09-05 00:00:00', NULL, 1, 6, 103, NULL, NULL, 'testing', 'passager', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-26 11:48:33', NULL, '2013-03-15 00:00:00', NULL),
(84, '2020-09-03 00:00:00', '2020-09-03 00:00:00', NULL, 28, 54, 102, NULL, NULL, 'm&eacute;decin', 'passager', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-22 12:55:53', NULL, '2013-03-15 00:00:00', NULL),
(82, '2020-09-03 00:00:00', '2020-09-03 00:00:00', NULL, 1, 99, 100, NULL, NULL, 'march&amp;eacute;', 'passager', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-21 18:12:24', NULL, '2013-03-15 00:00:00', NULL),
(83, '2020-09-01 00:00:00', '2020-09-01 00:00:00', NULL, 18, 5, 101, NULL, NULL, 'Supermarch&eacute;', 'passager', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-21 18:15:58', NULL, '2013-03-15 00:00:00', NULL),
(81, '2020-09-04 00:00:00', '2020-09-04 00:00:00', NULL, 28, 97, 98, NULL, NULL, 'opticien', 'passager', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-21 16:24:29', NULL, '2013-03-15 00:00:00', NULL),
(80, '2020-09-06 00:00:00', '2020-09-06 00:00:00', 34, NULL, 60, 96, NULL, NULL, 'supermarche', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-21 11:53:40', NULL, '2013-03-15 00:00:00', NULL),
(79, '2020-09-03 00:00:00', '2020-09-03 00:00:00', 29, NULL, 55, 95, NULL, NULL, 'hopital', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-21 11:47:44', NULL, '2013-03-15 00:00:00', NULL),
(76, '2020-08-31 00:00:00', '2020-08-31 00:00:00', 27, NULL, 12, 92, NULL, NULL, 'march&eacute;', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-21 11:05:51', NULL, '2013-03-15 00:00:00', NULL),
(73, '2020-08-29 00:00:00', '2020-08-29 00:00:00', 27, NULL, 12, 89, NULL, NULL, 'testing', 'chauffeur', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, '2020-08-21 09:48:18', NULL, '2013-03-15 00:00:00', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
