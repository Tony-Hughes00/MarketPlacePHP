-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 18, 2020 at 10:34 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

-- SET GLOBAL event_scheduler = ON;   

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

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `misRelationModif`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `misRelationModif` ()  NO SQL
BEGIN
	DELETE FROM tdbrelation WHERE 1;
	INSERT INTO tdbrelation (parcoursid, updated_at, status)
SELECT p.id, p.updated_at, t.status as status
    FROM parcours p
    JOIN trajet t ON t.parcours = p.id
    WHERE 
    t.updated_at > NOW() - INTERVAL 1 WEEK 
    AND t.status = 1
    GROUP BY p.id, t.status;
END$$

DROP PROCEDURE IF EXISTS `nouveaux_membres`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `nouveaux_membres` ()  BEGIN
	DELETE FROM tdbmembres WHERE 1;
	INSERT INTO tdbmembres (user_id, created_at)
    SELECT membres.users_id, membres.created_at
    FROM membres WHERE created_at > NOW() - INTERVAL 1 WEEK;
END$$

DROP PROCEDURE IF EXISTS `nouveaux_trajets`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `nouveaux_trajets` ()  NO SQL
BEGIN
	DELETE FROM tdbparcours WHERE 1;
	INSERT INTO tdbparcours (parcoursId, created_at)
    SELECT parcours.id, parcours.created_at
    FROM parcours WHERE created_at > NOW() - INTERVAL 1 WEEK;
END$$

DELIMITER ;


--
-- Table structure for table `tdbmembres`
--

DROP TABLE IF EXISTS `tdbmembres`;
CREATE TABLE IF NOT EXISTS `tdbmembres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1108 DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `tdbparcours`
--

DROP TABLE IF EXISTS `tdbparcours`;
CREATE TABLE IF NOT EXISTS `tdbparcours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parcoursId` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4;


--
-- Table structure for table `tdbrelation`
--

DROP TABLE IF EXISTS `tdbrelation`;
CREATE TABLE IF NOT EXISTS `tdbrelation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parcoursId` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;


--
-- Events
--
DROP EVENT `validateDates`$$
CREATE DEFINER=`root`@`localhost` EVENT `validateDates` ON SCHEDULE EVERY 1 MINUTE STARTS '2020-10-17 20:24:32' ON COMPLETION NOT PRESERVE ENABLE DO call nouveaux_membres$$

DROP EVENT `updatedRelations`$$
CREATE DEFINER=`root`@`localhost` EVENT `updatedRelations` ON SCHEDULE EVERY 1 MINUTE STARTS '2020-10-18 12:20:59' ON COMPLETION NOT PRESERVE ENABLE DO call misRelationModif()$$

DROP EVENT `validateTrajets`$$
CREATE DEFINER=`root`@`localhost` EVENT `validateTrajets` ON SCHEDULE EVERY 1 MINUTE STARTS '2020-10-18 11:30:15' ON COMPLETION NOT PRESERVE ENABLE DO call nouveaux_trajets()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
