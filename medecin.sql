-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/


-- Ceci est ma base de donnée


-- Hôte : 127.0.0.1
-- Généré le :  lun. 14 mai 2018 à 11:22
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `medecin`
--

-- --------------------------------------------------------

--
-- Structure de la table `acte_medical`
--

CREATE TABLE `acte_medical` (
  `id_medical` int(11) NOT NULL,
  `desc_acte` varchar(250) NOT NULL,
  `honoraire` float NOT NULL,
  `id_consultation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acte_medical`
--

INSERT INTO `acte_medical` (`id_medical`, `desc_acte`, `honoraire`, `id_consultation`) VALUES
(1, 'test 1', 10, 1),
(5, 'vaccin', 1500, 1),
(7, 'test', 20, 3),
(8, 'dsqdsqdqs', 50, 4),
(9, 'dsfdfdsf', 60, 4),
(10, 'cercueil', 2500, 1),
(11, 'fdbfhd', 20, 6),
(12, 'fdfdfdsfsd', 80.5, 6),
(13, 'fdsfsdfds', 56, 3),
(14, 'fdfdsfdsfsd', 90, 8);

-- --------------------------------------------------------

--
-- Structure de la table `consultation`
--

CREATE TABLE `consultation` (
  `id_consultation` int(11) NOT NULL,
  `des_consultation` varchar(255) NOT NULL,
  `date_consultation` date NOT NULL,
  `id_patient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `consultation`
--

INSERT INTO `consultation` (`id_consultation`, `des_consultation`, `date_consultation`, `id_patient`) VALUES
(1, '1 er test', '2018-04-24', 1),
(2, 'fdshfbdshfhsdfbhsd\r\nfdsfdsbfds fbds nf sdb\r\nfdsfbdsf sdnfsd', '2018-04-24', 2),
(3, 'zzzzzzzjjudb dfdfdfhdhfhdfd 45157515', '2018-04-25', 1),
(4, 'Pas de chance', '2018-04-26', 2),
(5, 'pas de chance', '2018-04-24', 2),
(6, 'les test sont bien', '2018-05-02', 2),
(7, 'fdfdsfdsfsd', '2018-04-25', 1),
(8, 'ffdsfsdfs', '2018-04-30', 1);

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `id_user` int(11) NOT NULL,
  `user` varchar(15) NOT NULL,
  `mdp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`id_user`, `user`, `mdp`) VALUES
(1, 'Admin', '1234');

-- --------------------------------------------------------

--
-- Structure de la table `pathologie`
--

CREATE TABLE `pathologie` (
  `id_pathologie` int(11) NOT NULL,
  `nom_pathologie` varchar(150) NOT NULL,
  `symptome_pathologie` varchar(255) NOT NULL,
  `valide_patho` varchar(1) NOT NULL DEFAULT 'o'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pathologie`
--

INSERT INTO `pathologie` (`id_pathologie`, `nom_pathologie`, `symptome_pathologie`, `valide_patho`) VALUES
(1, 'Rhume', 'Nez qui coule', 'o'),
(2, 'Cancer', 'C est la mer noire\r\n', 'o'),
(3, 'SIDA', 'oui oui oui oui', 'o'),
(4, 'Grippe', 'Pas bien', 'o'),
(5, 'Mycose', 'pas trÃ¨s jolie', 'o'),
(6, 'fdhfvds', 'fdsfdsfsdfs', 'n');

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id_patient` int(11) NOT NULL,
  `nom_patient` varchar(40) NOT NULL,
  `prenom_patient` varchar(40) NOT NULL,
  `code_postal_patient` int(11) NOT NULL,
  `rue_patient` varchar(50) NOT NULL,
  `ville_patient` varchar(50) NOT NULL,
  `valide` varchar(1) NOT NULL DEFAULT 'o'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id_patient`, `nom_patient`, `prenom_patient`, `code_postal_patient`, `rue_patient`, `ville_patient`, `valide`) VALUES
(1, 'FRATANI', 'AndrÃ©a', 69000, '41 Rue de Chantal Goya', 'Jesaispo', 'o'),
(2, 'Pologne', 'Jean Marie', 12000, '78 Rue des margueritte', 'Champagne', 'o'),
(3, 'test', 'dsqds', 15415, 'gdsbfsdh', 'fdnfjsdfds', 'n'),
(4, 'John', 'Jean', 16000, '45 bis avenue edmond Michelet', 'ah', 'n'),
(5, 'John', 'Jean', 16000, '45 bis avenue edmond Michelet', 'ah', 'o'),
(6, 'fdfdsfdsfsd', 'ffdsfdsfdsf', 15451, 'fdsfsd', 'dsqfdfds', 'n');

-- --------------------------------------------------------

--
-- Structure de la table `trouver`
--

CREATE TABLE `trouver` (
  `id_consultation` int(11) NOT NULL,
  `id_pathologie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `trouver`
--

INSERT INTO `trouver` (`id_consultation`, `id_pathologie`) VALUES
(1, 1),
(1, 2),
(1, 5),
(2, 2),
(2, 3),
(3, 2),
(3, 3),
(4, 4),
(6, 1),
(8, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acte_medical`
--
ALTER TABLE `acte_medical`
  ADD PRIMARY KEY (`id_medical`),
  ADD KEY `FK_Acte_Medical_id_consultation` (`id_consultation`);

--
-- Index pour la table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`id_consultation`),
  ADD KEY `FK_Consultation_id_patient` (`id_patient`);

--
-- Index pour la table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `pathologie`
--
ALTER TABLE `pathologie`
  ADD PRIMARY KEY (`id_pathologie`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id_patient`);

--
-- Index pour la table `trouver`
--
ALTER TABLE `trouver`
  ADD PRIMARY KEY (`id_consultation`,`id_pathologie`),
  ADD KEY `FK_Trouver_id_pathologie` (`id_pathologie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acte_medical`
--
ALTER TABLE `acte_medical`
  MODIFY `id_medical` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `id_consultation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `login`
--
ALTER TABLE `login`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `pathologie`
--
ALTER TABLE `pathologie`
  MODIFY `id_pathologie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id_patient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `acte_medical`
--
ALTER TABLE `acte_medical`
  ADD CONSTRAINT `FK_Acte_Medical_id_consultation` FOREIGN KEY (`id_consultation`) REFERENCES `consultation` (`id_consultation`);

--
-- Contraintes pour la table `consultation`
--
ALTER TABLE `consultation`
  ADD CONSTRAINT `FK_Consultation_id_patient` FOREIGN KEY (`id_patient`) REFERENCES `patient` (`id_patient`);

--
-- Contraintes pour la table `trouver`
--
ALTER TABLE `trouver`
  ADD CONSTRAINT `FK_Trouver_id_consultation` FOREIGN KEY (`id_consultation`) REFERENCES `consultation` (`id_consultation`),
  ADD CONSTRAINT `FK_Trouver_id_pathologie` FOREIGN KEY (`id_pathologie`) REFERENCES `pathologie` (`id_pathologie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
