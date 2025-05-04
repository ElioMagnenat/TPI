-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : Dim 04 mai 2025 à 18:31
-- Version du serveur :  5.7.11
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_bibliosolidaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `id_book` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `edition` varchar(255) DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `fk_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `loan`
--

CREATE TABLE `loan` (
  `id_loan` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `expected_return_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `fk_student` int(11) DEFAULT NULL,
  `fk_book` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE `student` (
  `id_student` int(11) NOT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `validity_date` date DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `comment` text,
  `address` text,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id_book`),
  ADD KEY `fk_category` (`fk_category`),
  ADD KEY `fk_category_2` (`fk_category`),
  ADD KEY `fk_category_3` (`fk_category`),
  ADD KEY `fk_category_4` (`fk_category`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Index pour la table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id_loan`),
  ADD KEY `fk_student` (`fk_student`),
  ADD KEY `fk_book` (`fk_book`);

--
-- Index pour la table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_student`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `loan`
--
ALTER TABLE `loan`
  MODIFY `id_loan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `student`
--
ALTER TABLE `student`
  MODIFY `id_student` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`fk_category`) REFERENCES `category` (`id_category`);
  ON UPDATE CASCADE;
--
-- Contraintes pour la table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `fk_book` FOREIGN KEY (`fk_book`) REFERENCES `book` (`id_book`),
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`fk_student`) REFERENCES `student` (`id_student`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
