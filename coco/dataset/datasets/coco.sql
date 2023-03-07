-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 07 mars 2023 à 18:44
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `coco`
--

-- --------------------------------------------------------

--
-- Structure de la table `espace`
--

CREATE TABLE `espace` (
  `esp_id` int(11) NOT NULL,
  `esp_nom` varchar(200) DEFAULT NULL,
  `esp_description` varchar(5000) DEFAULT NULL,
  `esp_adresse` varchar(300) DEFAULT NULL,
  `esp_nbposte` int(11) DEFAULT NULL,
  `esp_prix` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `espace`
--

INSERT INTO `espace` (`esp_id`, `esp_nom`, `esp_description`, `esp_adresse`, `esp_nbposte`, `esp_prix`) VALUES
(1, 'Espace Pasquier !', 'Ce gratte-ciel Art déco respire l\'élégance, avec son intérieur chic et moderne ainsi que sa cour vitrée.  Prenez une pause entre coéquipiers dans les vastes espaces communs, qui offrent de nombreuses possibilités de sessions de groupe lors de réunions informelles. Mettez vos moments de loisir à profit pour flâner au Printemps Haussman tout proche, où vous attendent de nombreux magasins de renom.', '18 Rue Pasquier, 75008 Paris', 30, 29.5);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `res_id` int(11) NOT NULL,
  `res_date_creation` date DEFAULT NULL,
  `res_date_debut` date DEFAULT NULL,
  `res_date_fin` date DEFAULT NULL,
  `res_nbposte` int(11) DEFAULT NULL,
  `res_utilisateur` int(11) NOT NULL,
  `res_espace` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`res_id`, `res_date_creation`, `res_date_debut`, `res_date_fin`, `res_nbposte`, `res_utilisateur`, `res_espace`) VALUES
(1, '2023-03-06', '2023-03-10', '2023-03-15', 3, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `uti_id` int(11) NOT NULL,
  `uti_nom` varchar(200) DEFAULT NULL,
  `uti_prenom` varchar(200) DEFAULT NULL,
  `uti_email` varchar(200) DEFAULT NULL,
  `uti_mdp` varchar(500) DEFAULT NULL,
  `uti_profil` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`uti_id`, `uti_nom`, `uti_prenom`, `uti_email`, `uti_mdp`, `uti_profil`) VALUES
(1, 'Gilles', 'Gilles', 'gilles@free.fr', '$2y$10$v20YzbUpHKmzNyxLIEhWHuLne.wvnMVPgRKKgbCumeOP6b5ifbtM2', 'user'),
(2, 'Superman', 'Superman', 'superman@free.fr', '$2y$10$3stN7Om6ac.A/O.f42Mqt.HpoUEofgSSK211B/8EiiS3VEDg5N4zK', 'admin'),
(3, 'user', 'paul', 'paupaul@paul.fr', '$2y$10$wSxIsZBVXsNM8Ezo.0MCNO.0OOkp2AOClO.La9ZUP60IKhL1zQHi2', 'admin'),
(4, 'Ced', 'Wick', 'jeanjean@jean.fr', '$2y$10$21sx8/t6C1ldyzuP3ouHVOqj76su.F3XIwEwYIiotWcv6odkk.4.O', 'client');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `espace`
--
ALTER TABLE `espace`
  ADD PRIMARY KEY (`esp_id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`res_id`),
  ADD KEY `cs1` (`res_utilisateur`),
  ADD KEY `cs2` (`res_espace`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`uti_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `espace`
--
ALTER TABLE `espace`
  MODIFY `esp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `uti_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `cs1` FOREIGN KEY (`res_utilisateur`) REFERENCES `utilisateur` (`uti_id`),
  ADD CONSTRAINT `cs2` FOREIGN KEY (`res_espace`) REFERENCES `espace` (`esp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
