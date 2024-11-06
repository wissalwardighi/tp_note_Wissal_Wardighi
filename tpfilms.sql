-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 06 nov. 2024 à 15:27
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
-- Base de données : `tpfilms`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteur`
--

CREATE TABLE `acteur` (
  `acteur_id` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `acteur`
--

INSERT INTO `acteur` (`acteur_id`, `nom`, `prenom`, `date_naissance`, `role`) VALUES
('A1', 'DiCaprio', 'Leonardo', '1974-11-11', 'principal'),
('A2', 'Crowe', 'Russell', '1964-04-07', 'principal'),
('A3', 'Neill', 'Sam', '1947-09-14', 'principal'),
('A4', 'McConaughey', 'Matthew', '1969-11-04', 'principal'),
('A5', 'Taylor', 'Robert', '1981-04-07', 'secondaire'),
('A6', 'Chalamet', 'Timothée', '1995-12-27', 'principal');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `utilisateur_id` varchar(50) NOT NULL,
  `film_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`utilisateur_id`, `film_id`) VALUES
('U1', 'F1'),
('U1', 'F3'),
('U2', 'F2'),
('U2', 'F5'),
('U3', 'F4');

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `film_id` varchar(50) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `duree` int(11) NOT NULL,
  `annee_sortie` int(11) NOT NULL,
  `realisateur_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`film_id`, `titre`, `duree`, `annee_sortie`, `realisateur_id`) VALUES
('F1', 'Inception', 150, 2011, 'R1'),
('F2', 'Jurassic Park', 127, 1993, 'R2'),
('F3', 'Gladiator', 155, 2000, 'R3'),
('F4', 'Interstellar', 169, 2014, 'R1'),
('F5', 'E.T.', 115, 1982, 'R2'),
('F6', 'Dune', 155, 2021, 'R3');

-- --------------------------------------------------------

--
-- Structure de la table `jouer`
--

CREATE TABLE `jouer` (
  `film_id` varchar(50) NOT NULL,
  `acteur_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jouer`
--

INSERT INTO `jouer` (`film_id`, `acteur_id`) VALUES
('F1', 'A1'),
('F2', 'A3'),
('F2', 'A5'),
('F3', 'A2'),
('F4', 'A4');

-- --------------------------------------------------------

--
-- Structure de la table `realisateur`
--

CREATE TABLE `realisateur` (
  `realisateur_id` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `realisateur`
--

INSERT INTO `realisateur` (`realisateur_id`, `nom`, `prenom`) VALUES
('R1', 'Nolan', 'Christopher'),
('R2', 'Spielberg', 'Steven'),
('R3', 'Scott', 'Ridley');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `utilisateur_id` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mot_de_passe` varchar(50) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`utilisateur_id`, `nom`, `prenom`, `email`, `mot_de_passe`, `role`) VALUES
('U1', 'Dupont', 'Alice', 'alice@example.com', 'pass123', 'user'),
('U2', 'Martin', 'Bob', 'bob@example.com', 'secure456', 'user'),
('U3', 'Lambert', 'Celine', 'celine@example.com', 'mypassword', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acteur`
--
ALTER TABLE `acteur`
  ADD PRIMARY KEY (`acteur_id`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`utilisateur_id`,`film_id`),
  ADD KEY `film_id` (`film_id`);

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`film_id`),
  ADD KEY `realisateur_id` (`realisateur_id`);

--
-- Index pour la table `jouer`
--
ALTER TABLE `jouer`
  ADD PRIMARY KEY (`film_id`,`acteur_id`),
  ADD KEY `acteur_id` (`acteur_id`);

--
-- Index pour la table `realisateur`
--
ALTER TABLE `realisateur`
  ADD PRIMARY KEY (`realisateur_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`utilisateur_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`),
  ADD CONSTRAINT `favoris_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `film` (`film_id`);

--
-- Contraintes pour la table `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`realisateur_id`) REFERENCES `realisateur` (`realisateur_id`);

--
-- Contraintes pour la table `jouer`
--
ALTER TABLE `jouer`
  ADD CONSTRAINT `jouer_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`film_id`),
  ADD CONSTRAINT `jouer_ibfk_2` FOREIGN KEY (`acteur_id`) REFERENCES `acteur` (`acteur_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

##Requetes sql du tp noté 
##1
SELECT titre, annee_sortie
FROM Film
ORDER BY annee_sortie DESC;
##2
SELECT Acteur.nom, Acteur.prenom
FROM Acteur
JOIN Jouer ON Acteur.acteur_id = Jouer.acteur_id
JOIN Film ON Film.film_id = Jouer.film_id
WHERE Film.titre = 'Inception' AND Acteur.role = 'principal';
##3
SELECT Film.titre
FROM Film
JOIN Jouer ON Film.film_id = Jouer.film_id
JOIN Acteur ON Acteur.acteur_id = Jouer.acteur_id
WHERE Acteur.nom = 'DiCaprio' AND Acteur.prenom = 'Leonardo';
##4
INSERT INTO Film (film_id, titre, duree, annee_sortie, realisateur_id)
VALUES ('F6', 'Dune', 155, 2021, 'R3');
##5
INSERT INTO Acteur (acteur_id, nom, prenom, date_naissance, role)
VALUES ('A6', 'Chalamet', 'Timothée', '1995-12-27', 'principal');
##6
UPDATE Film
SET duree = 150, annee_sortie = 2011
WHERE titre = 'Inception';
##7
DELETE FROM Acteur
WHERE nom = 'Taylor' AND prenom = 'Robert';
##8
SELECT nom, prenom, date_naissance
FROM Acteur
ORDER BY acteur_id DESC
LIMIT 3;
##9
SELECT titre, annee_sortie
FROM Film
ORDER BY annee_sortie ASC
LIMIT 1;
##10
SELECT nom, prenom, date_naissance
FROM Acteur
ORDER BY date_naissance DESC
LIMIT 1;
##11
SELECT COUNT(*)
FROM Film
WHERE annee_sortie = 1990;
##12
SELECT COUNT(DISTINCT acteur_id) AS nombre_acteurs
FROM Jouer;

