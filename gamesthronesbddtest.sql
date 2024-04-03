-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 03 avr. 2024 à 13:55
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gamesthronesbddtest`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(14) COLLATE utf8mb4_general_ci NOT NULL,
  `adress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `firstname`, `mail`, `phone`, `adress`, `password`) VALUES
(1, 'a', 'a', 'a@a.a', '06 37 57 14 31', 'azer', '$2y$10$ZExF0y78nlYCcYppao1kfeLOCbUV9L3QwHJ0yaEiTu/v9BxbhfB3u'),
(2, 'a', 'a', 'a@a.a', '06 37 57 14 31', 'azer', '$2y$10$aNUDNDclK5zv./NY/tDjgO1qTBJk/5Vmad.J.0uuMqvfuF8uA5A6m'),
(3, 'a', 'a', 'b@b.b', '06 06 06 06 06', 'aa', '$2y$10$6b.KVpTHdu.F1tAQdkajrOZQ4e/AvqQlaa4g5u.dV8tWNHpmPPPRO'),
(4, 'z', 'z', 'z@z.z', '75 75 75 75 75', 'osdjfsdf', '$2y$10$JS6yoqFzy8jAC8SGzIgIp.eIX0eS9B87JhYNaFGI6OHYw9kX4/yz6');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
