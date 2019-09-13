-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2019 at 10:46 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `pid` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8_czech_ci NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL,
  `deactivated` datetime DEFAULT NULL,
  `deactivated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `pid`, `comment`, `userId`, `deactivated`, `deactivated_by`) VALUES
(1, 4, 'comment 1', 12, NULL, NULL),
(2, 4, 'comment 2', 11, NULL, NULL),
(3, 3, 'comment 3', 12, NULL, NULL),
(4, 2, 'comment 4', 11, NULL, NULL),
(5, 4, 'comment 5', 12, NULL, NULL),
(6, 6, 'comment 6', 11, NULL, NULL),
(7, 9, 'comment 7', 12, NULL, NULL),
(8, 8, 'comment 8', 11, NULL, NULL),
(9, 6, 'comment 9', 2, NULL, NULL),
(10, 6, 'comment 10', 4, NULL, NULL),
(11, 7, 'comment 11', 11, NULL, NULL),
(12, 3, 'comment 12', 3, NULL, NULL),
(13, 4, 'comment 13', 7, NULL, NULL),
(14, 3, 'comment 14', 6, NULL, NULL),
(15, 8, 'comment 15', 4, NULL, NULL),
(16, 9, 'comment 16', 12, NULL, NULL),
(17, 7, 'd', 5, NULL, NULL),
(18, 7, 'hi\n', 5, NULL, NULL),
(19, 7, 'd', 5, NULL, NULL),
(20, 7, 'h', 5, NULL, NULL),
(21, 7, 'abcd', 5, NULL, NULL),
(22, 3, 'Hey', 5, NULL, NULL),
(23, 3, 'BAD BAD, WORDS.', 5, '2019-09-10 10:34:42', 12),
(24, 2, 'das', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `topicId` smallint(5) UNSIGNED NOT NULL,
  `title` text COLLATE utf8_czech_ci NOT NULL,
  `content` text COLLATE utf8_czech_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deactivated` datetime DEFAULT NULL,
  `deactivated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `uid`, `topicId`, `title`, `content`, `created`, `deactivated`, `deactivated_by`) VALUES
(2, 5, 1, 'WW2 is one of the worst wars EVER!', 'Hello, this is my heartfelt opinion after watching a documentary on BBC.', '2019-09-09 23:26:57', NULL, NULL),
(3, 4, 1, 'Lorem ipsum', 'Lorem ipsum lorem ipsum. Ipsum lorem. ', '2019-09-10 00:07:46', NULL, NULL),
(4, 5, 1, 'Pineapple', 'On a pizza is the biggest blasphemy ever. Just kidding, I love it.\n', '2019-09-09 17:44:45', NULL, NULL),
(5, 5, 1, 'Hey, who\'s the one who keeps eating my pizza?', 'I\'m currently searching for the person stealing my pizza. *stares the dog in the eyes* ', '2019-09-09 17:44:45', NULL, NULL),
(6, 12, 1, 'Fries or chips?', 'Nay, truly delicious potatoes.', '2019-09-09 23:27:38', NULL, NULL),
(7, 12, 1, 'Testing post', 'Oooh, it\'s working!', '2019-09-09 23:27:52', NULL, NULL),
(8, 12, 1, 'Article One of Puraybow', 'I have not seen such exciting sights in a long time. Is any of you a fan as well?', '2019-09-09 23:38:27', NULL, NULL),
(9, 12, 2, 'History Mags are dying out', 'Well, as the title says. I think the world is losing a treasure and I can\'t do anything against it. Help!', '2019-09-09 23:42:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` smallint(10) UNSIGNED NOT NULL,
  `role` varchar(25) COLLATE utf8_czech_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `active`) VALUES
(1, 'admin', '2019-09-09 01:50:28', 1),
(2, 'user', '2019-09-09 02:57:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `topic` varchar(120) COLLATE utf8_czech_ci NOT NULL,
  `description` text COLLATE utf8_czech_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED NOT NULL,
  `deactivated` datetime DEFAULT NULL,
  `deactivated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `topic`, `description`, `created`, `created_by`, `deactivated`, `deactivated_by`) VALUES
(1, 'General', 'You can ask and say anything you\'d like to here. Almost no topics are off limits. Just make sure to stay friendly. Don\'t forget. We\'re all humans. Be considerate!', '2019-09-09 21:39:21', 2, NULL, NULL),
(2, 'Magazines', 'We talk about our favourite magazines here. Feel free to talk about the news as well. Remember, have fun everyone :)!', '2019-09-09 23:40:01', 2, NULL, NULL),
(3, 'Music', 'Almost everyone listens to some kind of music. Don\'t be shy and share your tastes with us :)!', '2019-09-09 23:40:01', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(25) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_czech_ci NOT NULL,
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` datetime DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_czech_ci DEFAULT NULL,
  `role` smallint(5) UNSIGNED NOT NULL,
  `deactivated` datetime DEFAULT NULL,
  `deactivated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `registered`, `active`, `email`, `role`, `deactivated`, `deactivated_by`) VALUES
(2, 'admin', '$2y$10$AoaHXgACY3d6fyuMumPLkeHX8Rd5apC2B.UeOghvJgUATiWqFOtaC', '2019-09-09 02:57:05', NULL, 'changnguyeasdn@seznaasdm.cz', 1, NULL, NULL),
(3, 'ollie', '$2y$10$yM3mrM8lPDPYLv0H78UWDeRaqIrh42Yr7IEnA1y.hFvjATNSJaLz6', '2019-09-09 02:57:08', NULL, 'changnguyen@seznam.cz', 2, NULL, NULL),
(4, 'FUNKY', '$2y$10$rb.BooRu/7oqEKOx3PyEset16BDtSDWWaNzEY3iI7Fy8hS.Mms1WS', '2019-09-09 02:57:10', NULL, 'fantaadminpanda@gmaisd.com', 2, NULL, NULL),
(5, 'funk', '$2y$10$boQn7K5NqKi2Fqwix8KaPu/URM4WjnrwHJvmsj3kennl.9kZjcWeG', '2019-09-09 02:57:12', NULL, 'dasdasdas@asd.add', 2, NULL, NULL),
(6, 'dango', '$2y$10$nizLbiu8rx8rEwyOH8FSXOw.TK69DufgGyhr6FSy/2iuQc7/DchzG', '2019-09-09 02:56:28', '2019-09-09 04:56:28', 'daevid.seehasdsanal@gemail.come', 2, NULL, NULL),
(7, 'guy', '$2y$10$f1wtHS2NiW66qSfhc4YrdOAHUqK0m1EZInsavN8mZ0Ps9qt37H6/6', '2019-09-09 02:58:06', '2019-09-09 04:58:06', 'gdsrass@gaasdo.com', 2, NULL, NULL),
(11, 'ole', '$2y$10$Na2Nkl9DX8mc8K2zZmEBK.TTepJgWHL/Zu8CgXv0GEKLeOZdB4ENK', '2019-09-09 18:40:18', '2019-09-09 08:40:18', 'ole@aosdaoke.ole', 2, NULL, NULL),
(12, 'superadmin', '$2y$10$pbvTSU6Xyw8USoAc9A/SN.FqF6vq9hEktx5e609pZAQ32L5EBdhpu', '2019-09-09 21:35:00', '2019-09-09 08:41:01', 'adko@kads.ds', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deactivated_by` (`deactivated_by`),
  ADD KEY `pid` (`pid`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `topicId` (`topicId`),
  ADD KEY `deactivated_by` (`deactivated_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topics_ibfk_2` (`created_by`),
  ADD KEY `topics_ibfk_3` (`deactivated_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `constraint1` (`role`),
  ADD KEY `deactivated_by` (`deactivated_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`deactivated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `posts` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`topicId`) REFERENCES `topics` (`id`),
  ADD CONSTRAINT `posts_ibfk_3` FOREIGN KEY (`deactivated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `topics_ibfk_3` FOREIGN KEY (`deactivated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `constraint1` FOREIGN KEY (`role`) REFERENCES `roles` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`deactivated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
