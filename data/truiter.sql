-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 15, 2022 at 12:52 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `truiter`
--
CREATE DATABASE IF NOT EXISTS `truiter` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `truiter`;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
                         `id` int(11) NOT NULL,
                         `alt_text` varchar(255) DEFAULT NULL,
                         `width` int(11) DEFAULT NULL,
                         `url` varchar(255) NOT NULL,
                         `tweet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tweet`
--

CREATE TABLE `tweet` (
                         `id` int(11) NOT NULL,
                         `text` varchar(280) NOT NULL,
                         `created_at` datetime NOT NULL,
                         `like_count` int(11) NOT NULL,
                         `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tweet`
--

INSERT INTO `tweet` (`id`, `text`, `created_at`, `like_count`, `user_id`) VALUES
                                                                              (14, 'Hello', '2022-11-15 00:00:00', 0, 5),
                                                                              (15, 'HEllo', '2022-11-15 12:42:28', 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `created_at`, `verified`) VALUES
                                                                                        (1, 'Edgar', 'edgar', '1111', '2022-11-14 12:33:18', 1),
                                                                                        (3, 'Edgar', 'edgar1', '1111', '2022-11-15 00:00:00', 0),
                                                                                        (4, 'manolo', 'manolo1', '$2y$10$dAVNC7xaJRUKP40DmBu3pehiPnPkVBEp2d1MSyBao5ASHSg8X4Gua', '2022-11-15 00:00:00', 0),
                                                                                        (5, 'manolo', 'manolo2', '$2y$10$AMAKnZeckNeMd2hGAqC.Z.6frGwMAb23ncFYm.4tKLjMZkhRLp4r6', '2022-11-15 00:00:00', 0),
                                                                                        (6, 'Manolo', 'manolo3', '$2y$10$OhDc5Tv6T..4qYWNJq3t5urS.Dntu8M0YTnzlwyDhDRdyAvit3X1u', '2022-11-15 12:42:13', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `media`
--
ALTER TABLE `media`
    ADD PRIMARY KEY (`id`),
  ADD KEY `id_tweet` (`tweet_id`);

--
-- Indexes for table `tweet`
--
ALTER TABLE `tweet`
    ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tweet`
--
ALTER TABLE `tweet`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `media`
--
ALTER TABLE `media`
    ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tweet`
--
ALTER TABLE `tweet`
    ADD CONSTRAINT `tweet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;