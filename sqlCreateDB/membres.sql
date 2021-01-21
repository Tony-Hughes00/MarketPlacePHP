-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 21, 2021 at 11:54 AM
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
-- Table structure for table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `membre_type` varchar(20) NOT NULL COMMENT 'chauffeur ou passager',
  `valide` tinyint(1) NOT NULL DEFAULT '0',
  `actif` tinyint(1) GENERATED ALWAYS AS ((`actifSystem` and `actifAdmin`)) STORED NOT NULL,
  `actifSystem` int(11) NOT NULL DEFAULT '0',
  `actifAdmin` int(11) NOT NULL DEFAULT '1',
  `civilite` varchar(30) NOT NULL COMMENT 'madame ou monsieur',
  `date_naissance` date NOT NULL,
  `lieu_naissance` varchar(100) NOT NULL,
  `dep_naissance` int(11) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `evaluation` tinyint(1) NOT NULL DEFAULT '0',
  `caisse_retraite` varchar(255) NOT NULL DEFAULT '0',
  `conditions` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL COMMENT 'user id',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL COMMENT 'user id',
  `adresse` int(11) NOT NULL COMMENT 'adresse id',
  PRIMARY KEY (`id`),
  KEY `fk_membre_users_id` (`users_id`),
  KEY `fk_membre_created_by` (`created_by`),
  KEY `fk_membre_updated_by` (`updated_by`),
  KEY `fk_membre_adresse` (`adresse`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membres`
--

INSERT INTO `membres` (`id`, `users_id`, `membre_type`, `valide`, `actifSystem`, `actifAdmin`, `civilite`, `date_naissance`, `lieu_naissance`, `dep_naissance`, `tel`, `mobile`, `evaluation`, `caisse_retraite`, `conditions`, `created_at`, `created_by`, `updated_at`, `updated_by`, `adresse`) VALUES
(1, 4, 'chauffeur', 0, 1, 1, 'M.', '2020-08-01', 'Angoulême', 16, '0707070707', '0101010101', 0, '0', 1, '2020-11-11 21:00:00', 4, '2020-07-31 20:00:00', 4, 1),
(2, 5, 'passager', 0, 1, 1, 'M.', '2020-08-01', 'Montmoreau', 16, '0102030405', '0504030201', 0, 'Caisse', 1, '2020-11-13 21:00:00', 3, '2020-07-31 20:00:00', 1, 2),
(3, 18, 'passager', 0, 0, 1, 'Mme', '2020-07-29', 'fqdfqds', 0, '0500000000', '0600000000', 0, '0', 1, '2020-08-14 12:32:39', 1, '2020-08-14 12:32:39', 1, 5),
(4, 1, 'passager', 0, 0, 1, 'Mme', '2020-07-31', 'vcwcxv', 0, '0500000000', '0600000000', 0, '0', 1, '2020-11-09 23:00:00', 1, '2013-03-14 23:00:00', 1, 6),
(12, 24, 'chauffeur', 0, 0, 1, 'Mme', '2020-08-13', 'Paris', 0, '0533332222', '0633332222', 0, '0', 1, '2013-03-14 23:00:00', 1, '2013-03-14 23:00:00', 1, 45),
(13, 26, 'chauffeur', 0, 0, 1, 'Mme', '2020-07-30', 'Chalais', 0, '0544445555', '0644445555', 0, '0', 1, '2013-03-14 23:00:00', 1, '2013-03-14 23:00:00', 1, 11),
(14, 27, 'chauffeur', 0, 0, 1, 'Mme', '2020-08-05', 'Riberac', 0, '0522224444', '0622224444', 0, '0', 1, '2013-03-14 23:00:00', 1, '2013-03-14 23:00:00', 1, 12),
(15, 28, 'passager', 0, 0, 1, 'Mme', '2020-07-29', 'qsdfq', 0, '', '', 0, '0', 1, '2020-10-11 18:48:17', 1, '2013-03-14 23:00:00', 1, 54),
(16, 29, 'chauffeur', 0, 0, 1, 'M.', '2020-08-12', 'cxvc', 0, '', '', 0, '0', 1, '2020-10-15 18:48:30', 1, '2013-03-14 23:00:00', 1, 55),
(17, 34, 'chauffeur', 0, 0, 1, 'M.', '2020-08-04', 'Liverpool', 16, '', '745875948', 0, '0', 1, '2020-11-30 19:48:39', 1, '2013-03-14 23:00:00', 1, 60),
(18, 36, 'chauffeur', 0, 0, 1, 'M.', '2020-07-29', 'qsdfq', 99, '0544334433', '0744334433', 0, '0', 1, '2020-11-30 10:44:23', 36, '2020-08-30 09:44:23', 36, 155),
(19, 37, 'passager', 0, 0, 1, 'M.', '1997-06-30', 'Bonnes', 12, '0545852565', '0545852565', 0, '0', 1, '2020-12-01 09:56:42', 37, '2020-08-31 08:56:42', 37, 156),
(20, 38, 'passager', 0, 0, 1, 'M.', '1999-06-09', 'Chalais', 12, '0545852565', '0544444444', 0, '0', 1, '2020-09-15 14:26:46', 38, '2020-09-15 14:26:46', 38, 460),
(21, 12, 'chauffeur', 0, 0, 1, 'M.', '2020-08-04', 'Liverpool', 16, '', '745875948', 0, '0', 1, '2020-12-02 18:35:34', 1, '2013-03-14 23:00:00', 1, 60),
(22, 39, 'chauffeur', 0, 0, 1, 'M.', '2000-01-01', 'chalais', 16, '0545852565', '0544444444', 0, '0', 1, '2020-10-18 09:18:08', 39, '2020-10-18 09:18:08', 39, 703),
(23, 40, 'chauffeur', 0, 0, 1, 'M.', '1998-08-28', 'Pillac', 17, '1111111111', '2222222222', 0, '0', 1, '2020-10-31 09:45:52', 3, '2020-10-31 09:45:52', 3, 732),
(24, 41, 'chauffeur', 0, 0, 1, 'Mme', '1994-09-30', 'Nabillaud', 17, '8888888888', '9999999999', 0, '0', 1, '2020-10-31 09:49:34', 41, '2020-10-31 09:49:34', 41, 733),
(25, 43, 'passager', 0, 0, 1, 'M.', '1991-06-26', 'Chalais', 16, '0544444444', '0644444444', 0, '0', 1, '2020-12-12 08:44:58', 43, '2020-12-12 08:44:58', 43, 740),
(26, 44, 'chauffeur', 0, 0, 1, 'M.', '1990-03-19', 'aubeterre', 16, '0577777777', '0777777777', 0, '0', 1, '2020-12-12 09:01:30', 44, '2020-12-12 09:01:30', 44, 741),
(27, 46, 'chauffeur', 0, 0, 1, 'Mme', '1987-11-10', 'Chalais', 16, '0711111111', '9622222222', 0, '0', 1, '2021-01-12 09:26:39', 3, '2021-01-12 09:26:39', 3, 777);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `membres`
--
ALTER TABLE `membres`
  ADD CONSTRAINT `fk_membre_adresse` FOREIGN KEY (`adresse`) REFERENCES `adresses` (`id`),
  ADD CONSTRAINT `fk_membre_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_membre_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_membre_users_id` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
