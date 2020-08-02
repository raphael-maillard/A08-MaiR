-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Aug 02, 2020 at 08:24 PM
-- Server version: 5.7.28
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a08-mair`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8 NOT NULL,
  `alt` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `alt`) VALUES
(1, 'incredible-hulk.jpg', 'Affiche du film de L\'incroyble Hulk'),
(2, 'gardiens.jpg', 'Affiche film gardiens de la galaxie'),
(3, 'ironman.jpg', 'Affiche film ironman'),
(4, 'thor_le_monde_des_tenebres', 'Affiche du Film Thor le monde des ténébres');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) CHARACTER SET utf8 NOT NULL,
  `release_date` date NOT NULL,
  `duration` time DEFAULT NULL,
  `director` varchar(80) CHARACTER SET utf8 DEFAULT NULL,
  `id_phase` tinyint(3) DEFAULT NULL,
  `id_image` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`release_date`),
  KEY `movies_id_images` (`id_image`),
  KEY `movies_id_phases` (`id_phase`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `name`, `release_date`, `duration`, `director`, `id_phase`, `id_image`, `created_at`, `modified_at`) VALUES
(1, 'IronMan', '2008-04-30', '02:06:00', 'Jon Favreau', 1, 3, '2020-07-31 17:39:06', NULL),
(2, 'Les Gardiens de la Galaxie', '2014-08-07', '02:01:00', 'James Gunn', 1, 2, '2020-07-31 17:40:32', NULL),
(3, 'L\'incroyable Hulk', '2008-07-23', '01:52:00', 'Louis Leterrier', 1, 1, '2020-07-31 17:50:16', NULL),
(4, 'Thor le Monde des ténébres', '2013-10-30', '01:52:00', 'Alan Taylor', 2, 4, '2020-08-01 12:06:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phases`
--

DROP TABLE IF EXISTS `phases`;
CREATE TABLE IF NOT EXISTS `phases` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `phase` char(3) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phases`
--

INSERT INTO `phases` (`id`, `phase`) VALUES
(1, 'I'),
(2, 'II'),
(3, 'III');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_id_images` FOREIGN KEY (`id_image`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movies_id_phases` FOREIGN KEY (`id_phase`) REFERENCES `phases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
