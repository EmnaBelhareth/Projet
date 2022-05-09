-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 09 mai 2022 à 02:30
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_etudiant`
--

-- --------------------------------------------------------

--
-- Structure de la table `attendance`
--

CREATE TABLE `attendance` (
  `aid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `ispresent` tinyint(4) NOT NULL,
  `uid` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `attendance`
--

INSERT INTO `attendance` (`aid`, `sid`, `date`, `ispresent`, `uid`, `id`) VALUES
(1, 1, 1651960800, 1, 6, 5),
(2, 2, 1651960800, 1, 6, 5),
(3, 4, 1651960800, 1, 6, 5),
(4, 6, 1651960800, 1, 6, 5),
(5, 11, 1651960800, 0, 6, 5),
(6, 12, 1651960800, 0, 6, 5),
(7, 2, 1652047200, 1, 6, 3),
(8, 12, 1652047200, 1, 6, 3),
(9, 16, 1652047200, 1, 6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `codes`
--

CREATE TABLE `codes` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `code` varchar(5) NOT NULL,
  `expire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `codes`
--

INSERT INTO `codes` (`id`, `email`, `code`, `expire`) VALUES
(1, 'emna.belhareth19@gmail.com', '60018', 1650414092),
(2, 'emna.belhareth19@gmail.com', '26915', 1650414671),
(3, 'emna.belhareth19@gmail.com', '90085', 1650414732),
(4, 'emna.belhareth19@gmail.com', '50060', 1650415123),
(5, 'emna.belhareth19@gmail.com', '96141', 1650415200),
(6, 'emna.belhareth19@gmail.com', '23134', 1650415281),
(7, 'emna.belhareth19@gmail.com', '17888', 1650415452),
(8, 'emna.belhareth19@gmail.com', '15614', 1650415623),
(9, 'emna.belhareth19@gmail.com', '36520', 1650452276),
(10, 'emna.belhareth19@gmail.com', '11093', 1650452665),
(11, 'emna.belhareth19@gmail.com', '74291', 1650452785),
(12, 'emna.belhareth19@gmail.com', '46860', 1650454363),
(13, 'emna.belhareth19@gmail.com', '45147', 1650454486),
(14, 'emna.belhareth19@gmail.com', '79936', 1650455379),
(15, 'emna.belhareth19@gmail.com', '12051', 1650455573),
(16, 'emna.belhareth19@gmail.com', '17581', 1650455953),
(17, 'emna.belhareth19@gmail.com', '93424', 1650456050),
(18, 'emna.belhareth19@gmail.com', '87909', 1650456200),
(19, 'emna.belhareth19@gmail.com', '12842', 1650456384),
(20, 'emna.belhareth19@gmail.com', '76953', 1650733158),
(21, 'emna.belhareth19@gmail.com', '34913', 1650733887),
(22, 'emna.belhareth19@gmail.com', '16617', 1650734181),
(23, 'emna.belhareth19@gmail.com', '66783', 1650734421),
(24, 'emna.belhareth19@gmail.com', '38962', 1650734459),
(25, 'emna.belhareth19@gmail.com', '56595', 1650734473),
(26, 'emna.belhareth19@gmail.com', '73127', 1650734535),
(27, 'emna.belhareth19@gmail.com', '50301', 1650734693),
(28, 'emna.belhareth19@gmail.com', '44063', 1650734805),
(29, 'emna.belhareth19@gmail.com', '10860', 1650734885),
(30, 'emna.belhareth19@gmail.com', '99002', 1650735244),
(31, 'emna.belhareth19@gmail.com', '49617', 1650761203),
(32, 'emna.belhareth19@gmail.com', '46917', 1650761255),
(33, 'emna.belhareth19@gmail.com', '94860', 1650761397),
(34, 'emna.belhareth19@gmail.com', '98960', 1650761574),
(35, 'emna.belhareth19@gmail.com', '61158', 1650761625),
(36, 'emna.belhareth19@gmail.com', '95460', 1652042530),
(37, 'emna.belhareth19@gmail.com', '12687', 1652042630),
(38, 'emna.belhareth19@gmail.com', '79314', 1652051491),
(39, 'emna.belhareth19@gmail.com', '49334', 1652052356),
(40, 'emna.belhareth19@gmail.com', '74246', 1652052785),
(41, 'emna.belhareth19@gmail.com', '30491', 1652053685),
(42, 'emna.belhareth19@gmail.com', '78061', 1652054666);

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `uid` int(10) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `dateNaissance` date DEFAULT NULL,
  `sexe` varchar(40) DEFAULT NULL,
  `id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`uid`, `date`, `nom`, `prenom`, `email`, `password`, `dateNaissance`, `sexe`, `id`) VALUES
(2, '2022-05-09 00:04:13', 'belhareth', 'emna', 'emna.belhareth19@gmail.com', '858a525c7990e574b4533a7101574a05', '2000-05-26', 'Feminin', '3');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `sid` int(11) NOT NULL,
  `cin` int(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `cpassword` varchar(40) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `adresse` text NOT NULL,
  `idg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`sid`, `cin`, `email`, `password`, `cpassword`, `nom`, `prenom`, `adresse`, `idg`) VALUES
(2, 15, 'aymen1995@gmail.com', 'aymen', 'aymen', 'Triki', 'Aymen', 'Ariana', 4),
(16, 12347185, 'Msolli.roua19@gmail.com', '571a360c2db03aa6c7b3907cd7d95104', '571a360c2db03aa6c7b3907cd7d95104', 'Msolli', 'Roua', 'ariana', 1);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `idg` int(11) NOT NULL,
  `nomg` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`idg`, `nomg`) VALUES
(1, '1-INFOA'),
(2, '1-INFOB'),
(3, '1-INFOC'),
(4, '1-INFOD'),
(5, '1-INFOE'),
(6, '1-MECAA'),
(7, '1-MECAB'),
(8, '1-INDUSA'),
(9, '1-INDUSB');

-- --------------------------------------------------------

--
-- Structure de la table `student_subject`
--

CREATE TABLE `student_subject` (
  `sid` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `student_subject`
--

INSERT INTO `student_subject` (`sid`, `id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(7, 5),
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(8, 5),
(9, 1),
(9, 2),
(9, 3),
(9, 4),
(9, 5),
(10, 1),
(10, 2),
(10, 3),
(10, 4),
(10, 5),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(11, 5),
(12, 1),
(12, 2),
(12, 3),
(12, 4),
(12, 5),
(13, 1),
(13, 2),
(13, 3),
(13, 4),
(13, 5),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(14, 5),
(15, 1),
(15, 2),
(15, 3),
(15, 4),
(15, 5),
(16, 1),
(16, 2),
(16, 3),
(16, 4),
(16, 5),
(17, 1),
(17, 2),
(17, 3),
(17, 4),
(17, 5),
(18, 1),
(18, 2),
(18, 3),
(18, 4),
(18, 5),
(19, 1),
(19, 2),
(19, 3),
(19, 4),
(19, 5),
(34, 1),
(34, 2),
(34, 4),
(35, 1),
(35, 5),
(35, 2),
(36, 1),
(36, 4),
(36, 3),
(36, 2),
(37, 1),
(37, 2),
(37, 4),
(37, 5),
(14278645, 2);

-- --------------------------------------------------------

--
-- Structure de la table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `subject`
--

INSERT INTO `subject` (`id`, `name`) VALUES
(1, 'POO'),
(2, 'Mathematics'),
(3, 'English'),
(4, 'Web developement'),
(5, 'Architecture');

-- --------------------------------------------------------

--
-- Structure de la table `user_subject`
--

CREATE TABLE `user_subject` (
  `uid` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user_subject`
--

INSERT INTO `user_subject` (`uid`, `id`) VALUES
(1, 1),
(3, 2),
(4, 5),
(2, 4),
(5, 3),
(6, 2),
(6, 3),
(6, 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`aid`);

--
-- Index pour la table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `expire` (`expire`),
  ADD KEY `email` (`email`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`uid`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`sid`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`idg`);

--
-- Index pour la table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `idg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT pour la table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
