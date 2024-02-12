-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 25 août 2023 à 13:51
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
-- Base de données : `guinot`
--

-- --------------------------------------------------------

--
-- Structure de la table `auto_moto`
--

CREATE TABLE `auto_moto` (
  `id` int(11) NOT NULL,
  `type_article` varchar(10) DEFAULT NULL,
  `caractéristique` varchar(10) DEFAULT NULL,
  `carburant` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `auto_moto`
--

INSERT INTO `auto_moto` (`id`, `type_article`, `caractéristique`, `carburant`) VALUES
(1, 'auto', 'occasion', 'essence'),
(2, 'moto', 'neuf', 'électrique'),
(3, 'auto', 'neuf', 'diesel'),
(4, 'moto', 'occasion', 'essence'),
(5, 'auto', 'occasion', 'hybride'),
(6, 'moto', 'neuf', 'essence'),
(7, 'auto', 'neuf', 'électrique'),
(8, 'moto', 'occasion', 'diesel'),
(9, 'auto', 'occasion', 'essence'),
(10, 'moto', 'neuf', 'hybride');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(500) NOT NULL,
  `mdp` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `mdp`) VALUES
(3, 'pingouin', '$2y$10$y6wW5e34ps/fZL9cq9MWPekZX/hur/A0sUp5X9El5xAinOxlE73Q.'),
(4, 'pingouin2', '$2y$10$fPFhvFzSBtu9YoKNLud4e.prV9qHz9FU5FPUHNl.tlqsW3Hj6imna');

-- --------------------------------------------------------

--
-- Structure de la table `stagiaires`
--

CREATE TABLE `stagiaires` (
  `prenom` varchar(1000) NOT NULL,
  `nom` varchar(1000) NOT NULL,
  `ddn` date NOT NULL,
  `sexe` tinyint(1) NOT NULL,
  `promotion` varchar(1000) NOT NULL,
  `newsletter` tinyint(1) NOT NULL,
  `infos` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stagiaires`
--

INSERT INTO `stagiaires` (`prenom`, `nom`, `ddn`, `sexe`, `promotion`, `newsletter`, `infos`) VALUES
('ced', 'ecec', '2023-02-10', 1, 'CRCD', 0, ''),
('QUI', 'NE', '1995-05-31', 1, 'Kiné', 0, ''),
('Madame', 'Kiné', '2010-01-10', 1, 'Kiné', 0, ''),
('sdf', 'sdf', '1000-10-10', 0, 'CRCD', 0, ''),
('a', 'a', '2020-10-20', 1, 'DA1', 0, 'INFO,CRCD'),
('ze', 'zef', '2000-01-01', 1, 'DA1', 1, 'CRCD');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
