-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql-server
-- Temps de generació: 23-11-2022 a les 08:50:25
-- Versió del servidor: 10.4.24-MariaDB-1:10.4.24+maria~focal
-- Versió de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `truiter`
--
CREATE DATABASE IF NOT EXISTS `truiter` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `truiter`;

-- --------------------------------------------------------

--
-- Estructura de la taula `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `tweet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de la taula `tweet`
--

CREATE TABLE `tweet` (
  `id` int(11) NOT NULL,
  `text` varchar(280) NOT NULL,
  `created_at` datetime NOT NULL,
  `like_count` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Bolcament de dades per a la taula `tweet`
--

INSERT INTO `tweet` (`id`, `text`, `created_at`, `like_count`, `user_id`) VALUES
(14, 'Hello', '2022-11-15 00:00:00', 0, 5),
(15, 'HEllo', '2022-11-15 12:42:28', 0, 6);

-- --------------------------------------------------------

--
-- Estructura de la taula `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `verified` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Bolcament de dades per a la taula `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `created_at`, `verified`) VALUES
(1, 'user', 'user', '$2a$12$Z.8VSs8seqV/togcGrzDJeQ56L4KUuQNANZPC.Jhd02XftkWokp7W', '2022-11-14 12:33:18', 1),
(5, 'manolo', 'manolo2', '$2y$10$AMAKnZeckNeMd2hGAqC.Z.6frGwMAb23ncFYm.4tKLjMZkhRLp4r6', '2022-11-15 00:00:00', 0),
(6, 'Manolo', 'manolo3', '$2y$10$OhDc5Tv6T..4qYWNJq3t5urS.Dntu8M0YTnzlwyDhDRdyAvit3X1u', '2022-11-15 12:42:13', 0);

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tweet` (`tweet_id`);

--
-- Índexs per a la taula `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`user_id`);

--
-- Índexs per a la taula `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la taula `tweet`
--
ALTER TABLE `tweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la taula `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`) ON UPDATE CASCADE;

--
-- Restriccions per a la taula `tweet`
--
ALTER TABLE `tweet`
  ADD CONSTRAINT `tweet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
