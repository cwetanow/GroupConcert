-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time:  2 юли 2018 в 19:09
-- Версия на сървъра: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group-concert-db`
--

-- --------------------------------------------------------

--
-- Структура на таблица `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `concert_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `comments`
--

INSERT INTO `comments` (`id`, `concert_id`, `user_id`, `comment_text`) VALUES
(1, 1, 1, 'hello'),
(2, 1, 2, 'hello');

-- --------------------------------------------------------

--
-- Структура на таблица `concerts`
--

CREATE TABLE `concerts` (
  `id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `host_id` int(11) NOT NULL,
  `address` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spots` int(11) DEFAULT NULL,
  `joined_spots` int(11) DEFAULT '0',
  `performer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `concerts`
--

INSERT INTO `concerts` (`id`, `start_date`, `host_id`, `address`, `title`, `city`, `spots`, `joined_spots`, `performer_id`) VALUES
(1, '2018-08-15', 1, 'FMI', 'My classy concert', 'Sofia', 100, 1, NULL),
(2, '2015-03-22', 1, 'FMI', 'Old classy concert', 'Sofia', 33, 0, NULL),
(3, '2019-12-12', 1, 'FMI', 'Future classy concert', 'Sofia', 200, 0, NULL);

-- --------------------------------------------------------

--
-- Структура на таблица `concert_participants`
--

CREATE TABLE `concert_participants` (
  `user_id` int(11) NOT NULL,
  `concert_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `concert_participants`
--

INSERT INTO `concert_participants` (`user_id`, `concert_id`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Структура на таблица `concert_perform_requests`
--

CREATE TABLE `concert_perform_requests` (
  `user_id` int(11) NOT NULL,
  `concert_id` int(11) NOT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `full_name`, `password`) VALUES
(1, 'host', 'host@concert.com', 'host', '$2y$10$PGJCR5SgJGJKJjx5uabg1ezPMHOSctKPx86kQcx9tn0oFSUVPjece'),
(2, 'test1', 'test1@concert.com', 'test1', '$2y$10$z0vWrBhp.au89pRWF.BINeTXdGPVio8Y9SWYUFeHwJ8dMvT4KGXtC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `concert_id` (`concert_id`);

--
-- Indexes for table `concerts`
--
ALTER TABLE `concerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `host_id` (`host_id`);

--
-- Indexes for table `concert_participants`
--
ALTER TABLE `concert_participants`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `concert_id` (`concert_id`);

--
-- Indexes for table `concert_perform_requests`
--
ALTER TABLE `concert_perform_requests`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `concert_id` (`concert_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `concerts`
--
ALTER TABLE `concerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`concert_id`) REFERENCES `concerts` (`id`) ON DELETE CASCADE;

--
-- Ограничения за таблица `concerts`
--
ALTER TABLE `concerts`
  ADD CONSTRAINT `concerts_ibfk_1` FOREIGN KEY (`host_id`) REFERENCES `users` (`id`);

--
-- Ограничения за таблица `concert_participants`
--
ALTER TABLE `concert_participants`
  ADD CONSTRAINT `concert_participants_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `concert_participants_ibfk_2` FOREIGN KEY (`concert_id`) REFERENCES `concerts` (`id`) ON DELETE CASCADE;

--
-- Ограничения за таблица `concert_perform_requests`
--
ALTER TABLE `concert_perform_requests`
  ADD CONSTRAINT `concert_perform_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `concert_perform_requests_ibfk_2` FOREIGN KEY (`concert_id`) REFERENCES `concerts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
