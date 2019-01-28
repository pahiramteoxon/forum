-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 28, 2019 at 01:13 AM
-- Server version: 10.1.34-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `comment_msg` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user`, `topic_id`, `comment_msg`, `date`) VALUES
(15, 11, 5, 'macau', '2019-01-28 08:34:00');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `date_chat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id`, `sender_id`, `receiver_id`, `date_chat`, `message`) VALUES
(47, 1, 11, '2019-01-28 07:36:59', 'jgh'),
(48, 7, 11, '2019-01-28 07:43:17', 'ingay mo'),
(49, 1, 11, '2019-01-28 07:44:04', '<h1> hello world </h1>'),
(50, 1, 3, '2019-01-28 07:54:17', 'hey'),
(51, 1, 1, '2019-01-28 07:55:04', 'heydsds'),
(52, 1, 1, '2019-01-28 07:55:37', 'jaja'),
(53, 1, 1, '2019-01-28 07:56:21', 'maui'),
(54, 1, 11, '2019-01-28 07:57:43', 'hello'),
(55, 1, 1, '2019-01-28 07:58:01', 'hi'),
(56, 6, 1, '2019-01-28 07:58:51', 'berns'),
(58, 1, 11, '2019-01-28 08:00:41', 'jane'),
(59, 6, 1, '2019-01-28 08:00:56', 'jane?'),
(60, 1, 11, '2019-01-28 08:01:06', 'jane'),
(61, 1, 1, '2019-01-28 08:01:17', 'berns'),
(62, 6, 1, '2019-01-28 08:01:54', 'berns'),
(63, 1, 11, '2019-01-28 08:02:02', 'jane'),
(64, 1, 1, '2019-01-28 08:02:18', 'berns'),
(65, 1, 1, '2019-01-28 08:02:43', 'berns'),
(66, 1, 1, '2019-01-28 08:04:02', 'berns'),
(67, 1, 9, '2019-01-28 08:04:09', 'verbs'),
(68, 1, 11, '2019-01-28 08:04:23', 'berns'),
(69, 3, 11, '2019-01-28 08:04:29', 'corn'),
(70, 5, 11, '2019-01-28 08:04:34', 'maui'),
(71, 1, 1, '2019-01-28 08:04:44', 'maui'),
(72, 11, 1, '2019-01-28 08:07:01', ''),
(73, 11, 3, '2019-01-28 08:07:08', ''),
(74, 11, 5, '2019-01-28 08:07:10', ''),
(75, 1, 1, '2019-01-28 08:07:16', ''),
(76, 1, 5, '2019-01-28 08:07:18', ''),
(77, 1, 6, '2019-01-28 08:07:20', ''),
(78, 1, 7, '2019-01-28 08:07:23', ''),
(79, 1, 1, '2019-01-28 08:07:27', ''),
(80, 1, 8, '2019-01-28 08:07:31', ''),
(81, 1, 1, '2019-01-28 08:07:34', ''),
(82, 1, 1, '2019-01-28 08:07:37', ''),
(83, 11, 6, '2019-01-28 08:07:54', ''),
(84, 1, 11, '2019-01-28 08:08:11', ''),
(85, 1, 1, '2019-01-28 08:08:19', ''),
(86, 1, 1, '2019-01-28 08:08:31', ''),
(87, 1, 1, '2019-01-28 08:08:35', ''),
(88, 1, 1, '2019-01-28 08:08:40', ''),
(89, 1, 1, '2019-01-28 08:08:43', ''),
(90, 1, 10, '2019-01-28 08:08:45', ''),
(91, 1, 1, '2019-01-28 08:08:48', ''),
(92, 1, 1, '2019-01-28 08:08:52', ''),
(93, 1, 1, '2019-01-28 08:08:55', ''),
(94, 11, 11, '2019-01-28 08:09:06', ''),
(95, 11, 11, '2019-01-28 08:09:08', ''),
(96, 11, 7, '2019-01-28 08:09:13', ''),
(97, 11, 11, '2019-01-28 08:09:20', ''),
(98, 11, 8, '2019-01-28 08:09:25', ''),
(99, 11, 9, '2019-01-28 08:09:29', ''),
(100, 11, 11, '2019-01-28 08:09:37', ''),
(101, 11, 11, '2019-01-28 08:09:40', ''),
(102, 11, 11, '2019-01-28 08:09:47', ''),
(103, 11, 11, '2019-01-28 08:10:04', ''),
(104, 11, 11, '2019-01-28 08:10:07', ''),
(105, 11, 1, '2019-01-28 08:12:40', ''),
(106, 11, 11, '2019-01-28 08:12:43', ''),
(107, 11, 11, '2019-01-28 08:12:46', ''),
(108, 11, 11, '2019-01-28 08:16:05', ''),
(109, 11, 11, '2019-01-28 08:16:08', ''),
(110, 11, 11, '2019-01-28 08:16:11', ''),
(111, 11, 11, '2019-01-28 08:16:13', ''),
(112, 11, 11, '2019-01-28 08:16:15', ''),
(113, 1, 1, '2019-01-28 08:16:22', ''),
(114, 1, 1, '2019-01-28 08:16:24', ''),
(115, 1, 1, '2019-01-28 08:16:30', ''),
(116, 1, 1, '2019-01-28 08:16:33', ''),
(117, 1, 1, '2019-01-28 08:17:26', ''),
(118, 1, 1, '2019-01-28 08:18:22', ''),
(119, 1, 1, '2019-01-28 08:18:24', ''),
(120, 1, 1, '2019-01-28 08:18:53', ''),
(121, 1, 1, '2019-01-28 08:18:56', ''),
(122, 1, 1, '2019-01-28 08:18:59', ''),
(123, 1, 1, '2019-01-28 08:19:38', ''),
(124, 1, 1, '2019-01-28 08:19:41', ''),
(125, 1, 1, '2019-01-28 08:20:37', ''),
(126, 1, 1, '2019-01-28 08:20:40', ''),
(127, 1, 3, '2019-01-28 08:21:32', ''),
(128, 1, 6, '2019-01-28 08:21:36', ''),
(129, 11, 1, '2019-01-28 08:21:57', 'janey'),
(130, 11, 3, '2019-01-28 08:22:07', 'maui'),
(131, 11, 3, '2019-01-28 08:22:17', 'maui'),
(132, 3, 11, '2019-01-28 08:22:39', 'berns');

-- --------------------------------------------------------

--
-- Table structure for table `sub_comment`
--

CREATE TABLE `sub_comment` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `sub_msg` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `topic` text NOT NULL,
  `topic_desc` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id`, `user`, `topic`, `topic_desc`, `date`) VALUES
(5, 11, 'FA CE BOO K', 'Where to go?', '2019-01-28 05:46:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `username`, `password`, `first_name`, `middle_name`, `last_name`) VALUES
(1, 'janey', 'janey', 'MaryJane', 'Lajara', 'Teoxon'),
(3, 'corn', 'corn', 'maui', 'mouse', 'corn'),
(5, 'lala', 'lala', 'maui', 'janey', 'maui'),
(6, 'berns', 'berns', 'berns', 'queen', 'pascual'),
(7, 'pong', 'pong', 'pong', 'pong', 'pongski'),
(8, 'bel', 'bel', 'bel', 'belbel', 'suarez'),
(9, 'ryan', 'ryan', 'ryan', 'jay', 'retutar'),
(10, 'janmar', 'janmar', 'mar', 'janmar', 'adolfo'),
(11, 'berna', 'berna', 'berns', 'pascy', 'pascual');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_comment`
--
ALTER TABLE `sub_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;
--
-- AUTO_INCREMENT for table `sub_comment`
--
ALTER TABLE `sub_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user_info` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`);

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user_info` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
