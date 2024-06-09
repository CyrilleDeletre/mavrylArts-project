-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : sam. 08 juin 2024 à 15:02
-- Version du serveur : 11.3.2-MariaDB-1:11.3.2+maria~ubu2204
-- Version de PHP : 8.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mavrylArts`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `admin_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `admin_email`, `admin_password`) VALUES
(1, 'mavryl.arts@gmail.com', '$2y$10$lIyqQHNBbJdOKkKvij15Du7Pc9hIj5AEcI26XMCTg15JZpnMQxvfO');

-- --------------------------------------------------------

--
-- Structure de la table `gallery`
--

CREATE TABLE `gallery` (
  `id_img` int(11) NOT NULL,
  `path_img` varchar(255) DEFAULT NULL,
  `title_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `gallery`
--

INSERT INTO `gallery` (`id_img`, `path_img`, `title_img`) VALUES
(1, 'eye-art.jpg', 'Scorched - Dessin au graphite sur papier - Prix : 25 euro'),
(2, 'bird-art1.jpg', 'Chardonneret élégant - Gouache sur papier épais - Prix : 35 euro'),
(3, 'bird-art2.jpg', 'Canari sauvage - Gouache sur papier épais - Prix : 35 euro'),
(4, 'cat-art1.jpg', 'Commission : Luna et Simba, pour Nora - Dessin au graphite sur papier'),
(5, 'artwork.jpg', 'Divided - Encre sur papier épais - Prix 35 euro'),
(6, 'portrait1.jpg', 'Simple - Dessin au graphite sur papier - Prix : 25 euro'),
(7, 'bear-art.jpg', 'Bear - Dessin au graphite sur papier - Prix : 25 euro'),
(8, 'cat-art2.jpg', 'Scotty - Dessin au graphite sur papier - Prix 25 euro'),
(9, 'portrait2.jpg', 'Shattered - Dessin aquarelle sur papier - Prix : 25 euro'),
(10, 'hen-art.jpg', 'Harm none - Dessin au graphite sur papier - Prix 25 euro'),
(11, 'flower-art.jpg', 'Peonies - Gouache sur papier - Prix 25 euro');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `message_category` int(11) DEFAULT NULL,
  `message_content` varchar(2000) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `message_category`, `message_content`, `user_id`) VALUES
(1, 1, 'Bonjour, m\'appelle Nora, j\'ai deux chats, Luna et Simba et j\'aimerais un dessin d\'eux au crayon afin de pouvoir les encadrer.\r\n\r\nSerais-ce possible ? Si oui, pour quel montant ?', 2),
(2, 2, 'Bonjour, j\'ai un projet de fête de la paysannerie locale et je serais intéressée d\'exposer des oeuvres sur le thème des animaux durant cette fête. Et j\'aime beaucoup le style de vos peintures d\'oiseaux. \r\n\r\nJe souhaiterais donc avoir un devis pour vous en commander quelques uns, ainsi que d\'autres animaux si possible.\r\n\r\nCordialement, Alissa Leroy', 3),
(3, 3, 'Bonjour, je souhaiterais acheter votre peinture à la gouache du Chardonneret élégant.\r\n\r\nCordialement, Mme Elsa Roussel', 4);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_first_name` varchar(255) DEFAULT NULL,
  `user_last_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_first_name`, `user_last_name`, `user_email`, `id_admin`) VALUES
(1, 'mavryl', 'arts', 'mavryl.arts@gmail.com', 1),
(2, 'Nora', 'Dubois', 'nora-dubois@gmail.com', NULL),
(3, 'Alissa', 'Leroy', 'alissa-leroy@gmail.com', NULL),
(4, 'Elsa', 'Roussel', 'elsa-roussel@gmail.com', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id_img`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `FK_message_user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `FK_users_id_admin` (`id_admin`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_message_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_id_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
