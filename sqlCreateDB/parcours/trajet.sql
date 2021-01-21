-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 16, 2020 at 11:32 AM
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
  `parcours` int(11) NOT NULL COMMENT 'table parcours id',
  `direction` enum('aller','retour') NOT NULL,
  `sequenceNo` int(11) NOT NULL,
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
  `correspondance` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=517 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trajet`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
