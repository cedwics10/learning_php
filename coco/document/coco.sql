-- Adminer 4.8.1 MySQL 10.4.24-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `coco`;
CREATE DATABASE `coco` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `coco`;

DROP TABLE IF EXISTS `espace`;
CREATE TABLE `espace` (
  `esp_id` int(11) NOT NULL AUTO_INCREMENT,
  `esp_nom` varchar(200) DEFAULT NULL,
  `esp_description` varchar(5000) DEFAULT NULL,
  `esp_adresse` varchar(300) DEFAULT NULL,
  `esp_nbposte` int(11) DEFAULT NULL,
  `esp_prix` float DEFAULT NULL,
  PRIMARY KEY (`esp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `espace` (`esp_id`, `esp_nom`, `esp_description`, `esp_adresse`, `esp_nbposte`, `esp_prix`) VALUES
(1,	'Espace Pasquier',	'Ce gratte-ciel Art déco respire l\'élégance, avec son intérieur chic et moderne ainsi que sa cour vitrée.  Prenez une pause entre coéquipiers dans les vastes espaces communs, qui offrent de nombreuses possibilités de sessions de groupe lors de réunions informelles. Mettez vos moments de loisir à profit pour flâner au Printemps Haussman tout proche, où vous attendent de nombreux magasins de renom.',	'18 Rue Pasquier, 75008 Paris',	30,	29.5);

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE `reservation` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `res_date_creation` date DEFAULT NULL,
  `res_date_debut` date DEFAULT NULL,
  `res_date_fin` date DEFAULT NULL,
  `res_nbposte` int(11) DEFAULT NULL,
  `res_utilisateur` int(11) NOT NULL,
  `res_espace` int(11) NOT NULL,
  PRIMARY KEY (`res_id`),
  KEY `cs1` (`res_utilisateur`),
  KEY `cs2` (`res_espace`),
  CONSTRAINT `cs1` FOREIGN KEY (`res_utilisateur`) REFERENCES `utilisateur` (`uti_id`),
  CONSTRAINT `cs2` FOREIGN KEY (`res_espace`) REFERENCES `espace` (`esp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `reservation` (`res_id`, `res_date_creation`, `res_date_debut`, `res_date_fin`, `res_nbposte`, `res_utilisateur`, `res_espace`) VALUES
(1,	'2023-03-06',	'2023-03-10',	'2023-03-15',	3,	1,	1);

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
  `uti_id` int(11) NOT NULL AUTO_INCREMENT,
  `uti_nom` varchar(200) DEFAULT NULL,
  `uti_prenom` varchar(200) DEFAULT NULL,
  `uti_email` varchar(200) DEFAULT NULL,
  `uti_mdp` varchar(500) DEFAULT NULL,
  `uti_profil` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`uti_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `utilisateur` (`uti_id`, `uti_nom`, `uti_prenom`, `uti_email`, `uti_mdp`, `uti_profil`) VALUES
(1,	'Gilles',	'Gilles',	'gilles@free.fr',	'$2y$10$v20YzbUpHKmzNyxLIEhWHuLne.wvnMVPgRKKgbCumeOP6b5ifbtM2',	'user'),
(2,	'Superman',	'Superman',	'superman@free.fr',	'$2y$10$3stN7Om6ac.A/O.f42Mqt.HpoUEofgSSK211B/8EiiS3VEDg5N4zK',	'admin');

-- 2023-03-06 11:10:25
