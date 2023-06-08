-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 07 juin 2023 à 17:04
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_6`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentary`
--

DROP TABLE IF EXISTS `commentary`;
CREATE TABLE IF NOT EXISTS `commentary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `figure_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `actif` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1CAC12CAA76ED395` (`user_id`),
  KEY `IDX_1CAC12CA5C011B5` (`figure_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentary`
--

INSERT INTO `commentary` (`id`, `user_id`, `figure_id`, `title`, `message`, `actif`, `is_deleted`, `created_at`, `updated_at`) VALUES
(10, 2, 56, 'super vraiment', 'Quam ob rem id primum videamus, si placet, quatenus amor in amicitia progredi debeat. Numne, si Coriolanus habuit', 1, 0, '2023-06-07 16:59:53', '2023-06-07 16:59:53'),
(11, 2, 57, 'Merci', 'Quam ob rem id primum videamus, si placet, quatenus amor in amicitia progredi debeat. Numne, si Coriolanus habuit', 1, 0, '2023-06-07 17:00:20', '2023-06-07 17:00:20'),
(12, 2, 58, 'ah bon ?', 'Quam ob rem id primum videamus, si placet, quatenus amor in amicitia progredi debeat. Numne, si Coriolanus habuit', 1, 0, '2023-06-07 17:00:50', '2023-06-07 17:00:50'),
(13, NULL, 59, 'd\'accord', 'Quam ob rem id primum videamus, si placet, quatenus amor in amicitia progredi debeat. Numne, si Coriolanus habuit', 1, 0, '2023-06-07 17:01:51', '2023-06-07 17:01:51'),
(14, NULL, 59, 'pourquoi ?', 'Quam ob rem id primum videamus, si placet, quatenus amor in amicitia progredi debeat. Numne, si Coriolanus habuit', 1, 0, '2023-06-07 17:02:15', '2023-06-07 17:02:15'),
(15, NULL, 56, 'magnifique', 'Quam ob rem id primum videamus, si placet, quatenus amor in amicitia progredi debeat. Numne, si Coriolanus habuit', 1, 0, '2023-06-07 17:02:43', '2023-06-07 17:02:43');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230307114918', '2023-03-07 11:49:28', 1020),
('DoctrineMigrations\\Version20230307115446', '2023-03-07 11:54:53', 113),
('DoctrineMigrations\\Version20230320124123', '2023-03-20 12:41:42', 277),
('DoctrineMigrations\\Version20230419123436', '2023-04-19 12:34:49', 987),
('DoctrineMigrations\\Version20230419125815', '2023-04-19 12:58:21', 332),
('DoctrineMigrations\\Version20230602084115', '2023-06-02 08:42:21', 734);

-- --------------------------------------------------------

--
-- Structure de la table `figure`
--

DROP TABLE IF EXISTS `figure`;
CREATE TABLE IF NOT EXISTS `figure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `groupe_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `actif` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2F57B37A5E237E06` (`name`),
  KEY `IDX_2F57B37AA76ED395` (`user_id`),
  KEY `IDX_2F57B37A7A45358C` (`groupe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `figure`
--

INSERT INTO `figure` (`id`, `user_id`, `groupe_id`, `name`, `description`, `actif`, `is_deleted`, `created_at`, `updated_at`) VALUES
(56, 2, 1, 'free grabs', 'Quam ob rem id primum videamus, si placet, quatenus amor in amicitia progredi debeat. Numne, si Coriolanus habuit amicos, ferre contra patriam arma illi cum Coriolano debuerunt? num Vecellinum amici regnum adpetentem, num Maelium debuerunt iuvare?', 1, 0, '2023-06-07 16:44:36', NULL),
(57, 2, 2, '180° and co', 'Quam ob rem id primum videamus, si placet, quatenus amor in amicitia progredi debeat. Numne, si Coriolanus habuit amicos, ferre contra patriam arma illi cum Coriolano debuerunt? num Vecellinum amici regnum adpetentem, num Maelium debuerunt iuvare?', 1, 0, '2023-06-07 16:47:17', NULL),
(58, 2, 3, 'Back-flips', 'Quam ob rem id primum videamus, si placet, quatenus amor in amicitia progredi debeat. Numne, si Coriolanus habuit amicos, ferre contra patriam arma illi cum Coriolano debuerunt? num Vecellinum amici regnum adpetentem, num Maelium debuerunt iuvare?', 1, 0, '2023-06-07 16:49:33', NULL),
(59, 2, 5, 'slides pour débutant', 'Quam ob rem id primum videamus, si placet, quatenus amor in amicitia progredi debeat. Numne, si Coriolanus habuit amicos, ferre contra patriam arma illi cum Coriolano debuerunt? num Vecellinum amici regnum adpetentem, num Maelium debuerunt iuvare?', 1, 0, '2023-06-07 16:53:00', NULL),
(60, 2, 7, 'les sauts pour débutant', 'Quam ob rem id primum videamus, si placet, quatenus amor in amicitia progredi debeat. Numne, si Coriolanus habuit amicos, ferre contra patriam arma illi cum Coriolano debuerunt? num Vecellinum amici regnum adpetentem, num Maelium debuerunt iuvare?', 1, 0, '2023-06-07 16:56:26', NULL),
(61, 2, 8, 'une petite barre', 'Quam ob rem id primum videamus, si placet, quatenus amor in amicitia progredi debeat. Numne, si Coriolanus habuit amicos, ferre contra patriam arma illi cum Coriolano debuerunt? num Vecellinum amici regnum adpetentem, num Maelium debuerunt iuvare?', 1, 0, '2023-06-07 16:59:03', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `name`) VALUES
(1, 'Les grabs'),
(2, 'Les rotations'),
(3, 'Les flips'),
(4, 'Les rotations désaxées'),
(5, 'Les slides'),
(6, 'Old school'),
(7, 'Les Sauts'),
(8, 'Barre de slide');

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `figure_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6A2CA10C5C011B5` (`figure_id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `type`, `link`, `figure_id`) VALUES
(62, 'video', 'https://www.youtube.com/watch?v=L4bIunv8fHM', 56),
(63, 'video', 'https://www.youtube.com/watch?v=JGaZ_qctLvA', 56),
(64, 'picture', '6480b3f703a21.png', 56),
(65, 'picture', '6480b3f704b4c.jpg', 56),
(66, 'video', 'https://www.youtube.com/watch?v=nyOdEmddX9U', 57),
(67, 'video', 'https://www.youtube.com/watch?v=5YUNDp7bF_4', 57),
(68, 'picture', '6480b496368ba.jpg', 57),
(69, 'picture', '6480b4963778c.jpg', 57),
(70, 'video', 'https://www.youtube.com/watch?v=arzLq-47QFA', 58),
(71, 'video', 'https://www.youtube.com/watch?v=SlhGVnFPTDE', 58),
(72, 'picture', '6480b51e08916.jpg', 58),
(73, 'picture', '6480b51e09fdd.jpg', 58),
(74, 'video', 'https://www.youtube.com/watch?v=U9qJnX7-P-8', 59),
(75, 'video', 'https://www.youtube.com/watch?v=slWCAZijWTI', 59),
(76, 'picture', '6480b5edcf7de.jpg', 59),
(77, 'picture', '6480b5edd07b8.jpg', 59),
(78, 'video', 'https://www.youtube.com/watch?v=dSZ7_TXcEdM', 60),
(79, 'video', 'https://www.youtube.com/watch?v=AMH992l_nRg', 60),
(80, 'picture', '6480b6bbbb942.jpg', 60),
(81, 'picture', '6480b6bbbc501.jpg', 60),
(82, 'video', 'https://www.youtube.com/watch?v=12OHPNTeoRs', 61),
(83, 'video', 'https://www.youtube.com/watch?v=spZPdWCSkLk', 61),
(84, 'picture', '6480b758eae77.jpg', 61),
(85, 'picture', '6480b758ebe4a.jpg', 61);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actif` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `token` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D6495126AC48` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `mail`, `roles`, `password`, `name`, `first_name`, `actif`, `is_deleted`, `created_at`, `updated_at`, `token`) VALUES
(1, 'test2@test.fr', '[]', '$2y$13$ugk2z1KkFxC2sJg1pa84IOn9kSQNsf5kBel.HTRZP8jAVadM.B722', 'Pierre', 'laroche', 1, 0, NULL, NULL, NULL),
(2, 'test3@test.fr', '[]', '$2y$13$NYEtocE.11xYIRlWs/UbnexlcvyKNq3y4jK4I/r5lV1ttfpLQyFgu', 'alex', 'errecade', 1, 0, NULL, NULL, 'dGVzdDNAdGVzdC5mcg==');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentary`
--
ALTER TABLE `commentary`
  ADD CONSTRAINT `FK_1CAC12CA5C011B5` FOREIGN KEY (`figure_id`) REFERENCES `figure` (`id`),
  ADD CONSTRAINT `FK_1CAC12CAA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `figure`
--
ALTER TABLE `figure`
  ADD CONSTRAINT `FK_2F57B37A7A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`),
  ADD CONSTRAINT `FK_2F57B37AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `FK_6A2CA10C5C011B5` FOREIGN KEY (`figure_id`) REFERENCES `figure` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
