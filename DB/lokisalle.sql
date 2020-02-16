-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 16 fév. 2020 à 22:19
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lokisalle`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `commentaire` text NOT NULL,
  `note` int(2) NOT NULL,
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `id_membre`, `id_salle`, `commentaire`, `note`, `date_enregistrement`) VALUES
(1, 18, 2, 'Cette salle c\'est de la balle !', 9, '2020-02-10 20:20:39'),
(2, 21, 4, 'La salle était conforme aux attente ! Maiis léger manque de lumière..', 8, '2020-02-10 20:51:56');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_produit` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_membre`, `id_produit`, `date_enregistrement`) VALUES
(1, 22, 4, '2020-02-16 18:53:20'),
(2, 21, 3, '2020-02-16 18:53:20'),
(8, 20, 8, '2020-02-16 21:52:01');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('m','f') NOT NULL,
  `statut` enum('Admin','Membre') NOT NULL DEFAULT 'Membre',
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `statut`, `date_enregistrement`) VALUES
(18, 'Bidule06', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'RUSSO', 'Alex', 'bubu06@live.fr', 'm', 'Membre', '2020-02-11 23:09:26'),
(19, 'Biduuuu', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'RUSSO', 'Aurélie', 'qsd@live.fr', 'f', 'Membre', '2020-02-11 23:12:12'),
(20, 'lbpdu78', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'Borges', 'Clara', 'clacla@cla.fr', 'f', 'Admin', '2020-02-11 23:16:56'),
(21, 'bubu06', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'Russo', 'Alex', 'yolo@live.fr', 'm', 'Membre', '2020-02-16 17:47:51'),
(22, 'Yop', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'yoplait', 'lait', 'lait@bla.fr', 'f', 'Membre', '2020-02-16 17:58:02');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `date_arrivee` datetime NOT NULL,
  `date_depart` datetime NOT NULL,
  `prix` int(3) NOT NULL,
  `etat` enum('libre','reservation') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `id_salle`, `date_arrivee`, `date_depart`, `prix`, `etat`) VALUES
(3, 2, '2020-02-15 11:00:00', '2020-02-20 00:00:00', 870, 'reservation'),
(4, 1, '2020-02-16 00:00:00', '2020-02-11 00:00:00', 980, 'reservation'),
(5, 3, '2020-02-20 11:11:00', '2020-02-23 22:22:00', 530, 'libre'),
(6, 1, '2020-03-08 08:00:00', '2020-03-20 22:00:00', 5500, 'libre'),
(7, 4, '2020-02-28 14:00:00', '2020-03-06 20:50:54', 2500, 'reservation'),
(8, 1, '2020-03-22 08:00:00', '2020-03-27 20:00:00', 2000, 'reservation');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id_salle` int(3) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(200) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` int(5) NOT NULL,
  `capacite` int(3) NOT NULL,
  `categorie` enum('réunion','bureau','formation') NOT NULL DEFAULT 'réunion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id_salle`, `titre`, `description`, `photo`, `pays`, `ville`, `adresse`, `cp`, `capacite`, `categorie`) VALUES
(1, 'Reunion Pro', 'Salle claire et spacieuse idéal pour les réunion exeptionnel.', 'Office-interior-design-reunion.jpg', 'France', 'paris', '5 rue de Parkison', 75695, 13, 'réunion'),
(2, 'FormatRoom', 'Un espace agréable de travail idéal pour des formation courte d\'une journée à 1 semaine', 'office-formation-1.jpg', 'france', 'paris', '5 avenue des lys', 75560, 9, 'formation'),
(3, 'Loft-Office', 'Le bureau bien situé, dans un loft spacieux avec des zones de travail dédier au co-working et des emplacement calme pour un travail concentrer ', 'lokisalle-modern-office-interior-design-loft-concept-3d-rendering.jpg', 'france', 'paris', '5 avenue du loft', 92700, 14, 'bureau'),
(4, 'Monet', 'Bureau dans une tour dédié aux entreprise. Un espace salle de réunion est aussi disponible. Fourniture du matériel informatique et service de nettoyage compris.', 'lokisalle-bureau-gratte-ciel-1024x1024.jpg', 'france', 'paris', '45 avenue monet jean pierre', 69050, 30, 'réunion');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`),
  ADD KEY `id_membre` (`id_membre`),
  ADD KEY `id_salle` (`id_salle`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `id_membre` (`id_membre`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `id_salle` (`id_salle`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id_salle`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id_salle` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`),
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`id_salle`) REFERENCES `salle` (`id_salle`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_salle`) REFERENCES `salle` (`id_salle`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
