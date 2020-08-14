-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  ven. 14 août 2020 à 12:18
-- Version du serveur :  5.7.28
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `a08-mair`
--

-- --------------------------------------------------------

--
-- Structure de la table `actors`
--

DROP TABLE IF EXISTS `actors`;
CREATE TABLE IF NOT EXISTS `actors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(80) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `dob` date NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `last_name` (`last_name`,`first_name`,`dob`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `actors_movies`
--

DROP TABLE IF EXISTS `actors_movies`;
CREATE TABLE IF NOT EXISTS `actors_movies` (
  `id_actors` int(11) NOT NULL,
  `id_movies` int(11) NOT NULL,
  `role` varchar(80) NOT NULL,
  UNIQUE KEY `id_actors` (`id_actors`,`id_movies`),
  KEY `id_movies` (`id_movies`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `release_date` date NOT NULL,
  `duration` time DEFAULT NULL,
  `director` varchar(80) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `id_phase` tinyint(3) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`release_date`),
  KEY `movies_id_phases` (`id_phase`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id`, `name`, `release_date`, `duration`, `director`, `image`, `id_phase`, `created_at`, `modified_at`) VALUES
(1, 'IronMan', '2008-04-30', '02:06:00', 'Jon Favreau', 'ironman.jpg', 1, '2020-07-31 17:39:06', '2020-08-06 09:36:39'),
(2, 'Les Gardiens de la Galaxie', '2014-08-07', '02:01:00', 'James Gunn', 'gardiens.jpg', 2, '2020-07-31 17:40:32', '2020-08-06 09:47:35'),
(3, 'L\'incroyable Hulk', '2008-07-23', '01:52:00', 'Louis Leterri', 'incroyable-hulk.jpg', 1, '2020-07-31 17:50:16', '2020-08-06 18:21:15'),
(4, 'Iron Man 2', '2010-04-28', '02:04:00', 'Jon Favreau', 'Ironman-2.jpg', 1, '2020-08-06 09:38:48', NULL),
(5, 'Thor', '2011-04-27', '01:55:00', 'Kenneth Branagh', 'thor.jpg', 1, '2020-08-06 09:44:23', NULL),
(6, 'Iron Man 3', '2013-04-19', '02:11:00', 'Shane Black', 'Ironman-3.jpg', 2, '2020-08-06 09:45:26', NULL),
(7, 'Thor : Le Monde des ténèbres', '2013-10-30', '01:52:00', 'Alan Taylor', 'thor_le_monde_des_tenebres.jpg', 2, '2020-08-06 09:46:10', NULL),
(8, 'Captain America : Le Soldat de l\'hiver', '2014-03-21', '02:16:00', 'Anthony Russo, Joe Russo', 'Captain-America.jpg', 2, '2020-08-06 09:46:57', NULL),
(9, 'Captain America: Civil War', '2016-04-27', '02:28:00', 'Anthony Russo, Joe Russo', 'captain.jpg', 3, '2020-08-06 09:48:26', NULL),
(10, 'Doctor Strange', '2016-10-26', '01:55:00', 'Scott Derrickson', 'Doctor-Strange.jpg', 3, '2020-08-06 09:48:58', NULL),
(11, 'Les Gardiens de la Galaxie Vol. 2', '2017-04-19', '02:16:00', 'James Gunn', 'gardiens-2.jpg', 3, '2020-08-06 09:49:26', NULL),
(12, 'Spider-Man: Homecoming', '2017-06-12', '02:14:00', 'Jon Watts', 'Spiderman Home Coming.jpg', 3, '2020-08-06 09:50:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `phases`
--

DROP TABLE IF EXISTS `phases`;
CREATE TABLE IF NOT EXISTS `phases` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `phase` char(3) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `phases`
--

INSERT INTO `phases` (`id`, `phase`) VALUES
(1, 'I'),
(2, 'II'),
(3, 'III');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `actors_movies`
--
ALTER TABLE `actors_movies`
  ADD CONSTRAINT `id_actor` FOREIGN KEY (`id_actors`) REFERENCES `actors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_movies` FOREIGN KEY (`id_movies`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_id_phases` FOREIGN KEY (`id_phase`) REFERENCES `phases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
