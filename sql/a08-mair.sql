-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  jeu. 27 août 2020 à 11:16
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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `actors`
--

INSERT INTO `actors` (`id`, `last_name`, `first_name`, `dob`, `image`, `created_at`, `modify_at`) VALUES
(1, 'Downey', 'Robert (Jr.)', '1965-04-04', 'RobertDowneyJr.jpg', '2020-08-19 13:42:44', '2020-08-27 11:13:39'),
(2, 'Alexander\r\n', 'Jaimie\r\n', '1984-03-14', 'JaimieAlexander.jpg', '2020-08-19 16:25:28', '2020-08-25 11:57:19'),
(43, 'Paul', 'Bettany', '1971-05-27', 'Paul Bettany.jpg', '2020-08-24 15:00:13', NULL),
(44, 'Clark', 'Greg', '1966-04-02', 'Clark Gregg.jpg', '2020-08-25 13:26:25', '2020-08-27 09:44:48'),
(45, 'Jackson', 'Samuel L.', '1948-12-21', 'Samuel L. Jackson.jpg', '2020-08-27 11:04:36', NULL),
(46, 'Paltrow', 'Gwyneth', '1972-09-27', 'Gwyneth Paltrow.jpg', '2020-08-27 11:07:45', NULL),
(47, 'Johansson', 'Scarlett', '1984-11-22', 'Scarlett Johansson.jpg', '2020-08-27 11:10:10', NULL),
(48, 'Favreau', 'Jon', '1966-10-19', 'Jon Favreau.jpg', '2020-08-27 11:12:22', NULL),
(49, 'Evans', 'Chris', '1981-06-13', 'Chris Evans.jpg', '2020-08-27 11:17:04', NULL),
(50, 'Bautista', 'David Michael', '1969-01-18', 'Dave Bautista.jpg', '2020-08-27 11:20:53', NULL),
(52, 'Dennings', 'Kat', '1986-06-13', 'Kat Dennings.jpg', '2020-08-27 11:36:28', NULL),
(57, 'Slattery', 'Jon', '1962-08-13', 'John Slattery.jpg', '2020-08-27 12:01:53', '2020-08-27 12:23:27');

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

--
-- Déchargement des données de la table `actors_movies`
--

INSERT INTO `actors_movies` (`id_actors`, `id_movies`, `role`) VALUES
(1, 1, 'Ironman'),
(1, 3, 'Ironman'),
(1, 4, 'Ironman'),
(1, 6, 'Ironman'),
(1, 9, 'Ironman'),
(1, 12, 'Ironman'),
(43, 1, 'Jarvis'),
(43, 4, 'Jarvis'),
(43, 6, 'Jarvis'),
(43, 11, 'Jarvis'),
(44, 1, 'Phil Coulson'),
(44, 4, 'Phil Coulson'),
(44, 5, 'Phil Coulson'),
(45, 1, 'Nick Fury'),
(45, 4, 'Nick Fury'),
(45, 5, 'Nick Fury'),
(45, 8, 'Nick Fury'),
(46, 1, 'Pepper Potts'),
(46, 4, 'Pepper Potts'),
(46, 6, 'Pepper Potts'),
(46, 12, 'Pepper Potts'),
(47, 4, 'Natasha Romanoff/Black Widow'),
(47, 8, 'Natasha Romanoff/Black Widow'),
(47, 9, 'Natasha Romanoff/Black Widow'),
(48, 1, 'Happy Hogan'),
(48, 4, 'Happy Hogan'),
(48, 6, 'Happy Hogan'),
(48, 12, 'Happy Hogan'),
(49, 7, 'Steve Rogers/Captain America Loki'),
(49, 8, 'Steve Rogers/Captain America Loki'),
(49, 9, 'Steve Rogers/Captain America Loki'),
(49, 12, 'Steve Rogers/Captain America Loki'),
(50, 2, 'Drax le Destructeur'),
(50, 11, 'Drax le Destructeur'),
(52, 5, 'Darcy Lewis'),
(52, 7, 'Darcy Lewis'),
(57, 4, 'Howard Stark'),
(57, 8, 'Howard Stark'),
(57, 9, 'Howard Stark'),
(57, 10, 'Howard Stark');

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id`, `name`, `release_date`, `duration`, `director`, `image`, `id_phase`, `created_at`, `modified_at`) VALUES
(1, 'IronMan', '2008-04-30', '02:06:00', 'Jon Favreau', 'ironman.jpg', 1, '2020-07-31 17:39:06', '2020-08-06 09:36:39'),
(2, 'Les Gardiens de la Galaxie', '2014-08-07', '02:01:00', 'James Gunn', 'gardiens.jpg', 2, '2020-07-31 17:40:32', '2020-08-06 09:47:35'),
(3, 'L\'incroyable Hulk', '2008-07-23', '01:52:00', 'Louis Leterri', 'incroyable-hulk.jpg', 1, '2020-07-31 17:50:16', '2020-08-27 11:34:48'),
(4, 'Iron Man 2', '2010-04-28', '02:04:00', 'Jon Favreau', 'Ironman-2.jpg', 1, '2020-08-06 09:38:48', NULL),
(5, 'Thor', '2011-04-27', '01:55:00', 'Kenneth Branagh', 'thor.jpg', 1, '2020-08-06 09:44:23', NULL),
(6, 'Iron Man 3', '2013-04-19', '02:11:00', 'Shane Black', 'Ironman-3.jpg', 2, '2020-08-06 09:45:26', NULL),
(7, 'Thor : Le Monde des ténèbres', '2013-10-30', '01:52:00', 'Alan Taylor', 'thor_le_monde_des_tenebres.jpg', 2, '2020-08-06 09:46:10', NULL),
(8, 'Captain America : Le Soldat de l\'hiver', '2014-03-21', '02:16:00', 'Anthony Russo, Joe Russo', 'Captain-America.jpg', 2, '2020-08-06 09:46:57', NULL),
(9, 'Captain America: Civil War', '2016-04-27', '02:28:00', 'Anthony Russo, Joe Russo', 'captain.jpg', 3, '2020-08-06 09:48:26', NULL),
(10, 'Doctor Strange', '2016-10-26', '01:55:00', 'Scott Derrickson', 'Doctor-Strange.jpg', 1, '2020-08-06 09:48:58', '2020-08-25 14:12:17'),
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
