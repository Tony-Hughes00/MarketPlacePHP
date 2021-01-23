-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 22, 2020 at 10:08 AM
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
-- Table structure for table `commune`
--

DROP TABLE IF EXISTS `commune`;
CREATE TABLE IF NOT EXISTS `commune` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `pnm` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commune`
--

INSERT INTO `commune` (`id`, `nom`, `pnm`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(6, 'Aubeterre', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(7, 'Bardenac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(8, 'Bazac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(9, 'Bellon', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(10, 'Bessac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(11, 'Blanzaguet-st-cybard', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(12, 'Bonnes', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(13, 'Bors-de-montmoreau', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(14, 'Chadurie', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(15, 'Chalais', 2, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(17, 'Chatignac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(18, 'Combiers', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(20, 'Courgeac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(21, 'Courlac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(22, 'Curac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(23, 'Deviat', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(25, 'Edon', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(26, 'Essards', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(27, 'Fouquebrune', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(28, 'Gardes-le-pontaroux', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(29, 'Gurat', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(30, 'Juignac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(31, 'Boisne-la-tude', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(32, 'Laprade', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(33, 'Magnac-lavalette-villars', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(34, 'Medillac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(35, 'Montboyer', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(36, 'Montignac-le-coq', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(37, 'Nabinaud', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(38, 'Nonac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(39, 'Orival', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(40, 'Palluaud', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(41, 'Pillac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(42, 'Poullignac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(43, 'Rioux-martin', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(44, 'Ronsenac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(45, 'Rouffiac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(46, 'Rougnac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(47, 'St-avit', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(48, 'Montmoreau', 3, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(49, 'St-laurent-des-combes', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(50, 'St-martial', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(51, 'St-quentin-de-chalais', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(52, 'St-romain', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(53, 'St-severin', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(54, 'Salles-lavalette', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(55, 'Vaux-lavalette', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(56, 'Villebois-lavalette', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(57, 'Yviers', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(58, 'Sauvignac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(59, 'Angeduc', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(60, 'Baignes-ste-radegonde', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(61, 'Barbezieux-st-hilaire', 0, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(62, 'Barret', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(63, 'Becheresse', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(64, 'Berneuil', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(65, 'Boisbreteau', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(66, 'Bors-de-baignes', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(67, 'Brie-sous-barbezieux', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(68, 'Brie-sous-chalais', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(69, 'Brossac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(70, 'Challignac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(71, 'Chantillac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(72, 'Champagne-vigny', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(73, 'Chillac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(74, 'Condeon', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(100, 'Guizengeard', 1, '2020-08-22 10:05:35', 3, '2020-08-22 12:05:35', 3),
(76, 'Etriac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(77, 'Guimps', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(78, 'Coteaux-du-blanzacais', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(79, 'Lachaise', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(80, 'Ladiville', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(81, 'Lagarde-sur-le-ne', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(82, 'Le-tatre', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(83, 'Montmerac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(84, 'Oriolles', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(85, 'Passirac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(86, 'Perignac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(87, 'Reignac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(88, 'Salle-de-barbezieux', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(89, 'St-aulais-la-chapelle', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(90, 'St-bonnet', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(91, 'St-felix', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(92, 'St-leger', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(93, 'St-medard-de-barbezieux', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(94, 'St-palais-du-ne', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(95, 'Ste-souline', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(96, 'St-vallier', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(97, 'Touverac', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(98, 'Val-des-vignes', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3),
(99, 'Vignolles', 1, '2020-08-20 19:44:59', 3, '2020-08-20 21:44:59', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;