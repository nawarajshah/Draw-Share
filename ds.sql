-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2019 at 10:40 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ds`
--
CREATE DATABASE IF NOT EXISTS `ds` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ds`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `fName` varchar(20) NOT NULL,
  `lName` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` varchar(33) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `DOB` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '1',
  `loginTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `fName`, `lName`, `email`, `password`, `country`, `phone`, `DOB`, `gender`, `online`, `loginTime`) VALUES
(11, 'bob', '', 'bob@gmail.com', '$2y$10$mpxUSxpkQJZZjQy/nCPHpepyrx5r6..9ioJCHkkoVsLLYrbky4d5S', '', 0, '0000-00-00', '', 0, '2019-01-10 08:56:51'),
(12, 'ram', '', 'ram@gmail.com', '$2y$10$ppzoG0KHlGr0SG3tUbsqGeUrD//Sxhsn798gHhUj44FqXNSpP4h2.', '', 0, '0000-00-00', '', 0, '2018-07-09 03:47:21'),
(13, 'hari', '', 'hari@gmail.com', '$2y$10$/QDkJilsxRSykcF87NliUOO1QyngsRIqGayhL5lqoegKmoupka1SC', '', 0, '0000-00-00', '', 0, '2018-06-30 17:53:02'),
(14, 'sita', '', 'sita@gmail.com', '$2y$10$iwsqZkW.pkHrJbTtHG4J0OVdjcRnZ953OrzfuC6xUKpvHqMLli0Fu', '', 0, '0000-00-00', '', 0, '2018-06-30 17:53:02'),
(15, 'nawaraj', '', 'nawaraj@gmail.com', '$2y$10$.KvSC.SVFTvT4g26rwWG.eZ6M965pRwID8/U5vCUVt5TQpO3pfhve', '', 0, '0000-00-00', '', 0, '2018-12-14 12:47:43'),
(16, 'chan', 'chand', 'chan@gmail.com', '$2y$10$wHhyoXrN0Q5D0ZTW2Pd8xu5GLvudE9cefCCkaZxN7ItLX93vy264i', 'Nepal', 9848056704, '2016-07-05', 'Male', 1, '2018-07-22 02:00:05'),
(17, 'robin', '', 'robin@gmail.com', '$2y$10$3Jsq8A3182C0h5tgw3yFde093ouMfy5J49tlNff0jpa1Cyk8urTFi', '', 0, '0000-00-00', '', 0, '2018-06-30 17:53:03'),
(18, 'gulab', '', 'gulab@gmail.com', '$2y$10$5xoIH/G49obEaxE114f/IO1..x5TqFHEmdMLUiunlLhH/GLB5ki.u', '', 0, '0000-00-00', '', 0, '2018-06-30 17:53:03'),
(19, 'amit', '', 'amit@gmail.com', '$2y$10$Xq/Crpio7DF4cZ1QW9yCj.ymfrxwp.Pv2/ud9wvjE7tRxgv8Ky.ge', '', 0, '0000-00-00', '', 0, '2018-06-30 17:53:03'),
(20, 'gg', '', 'gg@gmail.com', '$2y$10$uTCq2bF.Ug2GNisS0XwAHea1l4ec3/D5KgsufEK16IzeYK0awvXEu', '', 0, '0000-00-00', '', 0, '2018-06-30 17:53:03'),
(21, 'ashish', 'shah', 'ashish@gmail.com', '$2y$10$/jSm6Xn6vfJCM6IBCGyheOEohElorfDWE04Jxq4zQnL7pfhkWvg76', '', 0, '0000-00-00', '', 0, '2018-07-08 13:50:14'),
(23, 'Shruti', 'Rana', 'shruti@gmail.com', '$2y$10$7ODd8eploV7HTjumjNbYSOpd7Z9nol1eeAotGEOoe.co2M8nLh2CW', '', 0, '0000-00-00', '', 1, '2018-12-28 04:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `id` int(11) NOT NULL,
  `username_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `act` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`id`, `username_id`, `friend_id`, `act`) VALUES
(59, 16, 15, 'f'),
(68, 13, 12, 'r'),
(75, 12, 14, 'f'),
(125, 14, 18, 'r'),
(142, 14, 17, 'r'),
(163, 11, 16, 'f'),
(204, 11, 13, 'r'),
(216, 11, 21, 'f'),
(217, 16, 21, 'f'),
(219, 16, 18, 'r'),
(220, 16, 14, 'r'),
(221, 11, 18, 'r');

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `id` int(11) NOT NULL,
  `sender` varchar(20) NOT NULL,
  `receiver` varchar(20) NOT NULL,
  `image` blob NOT NULL,
  `atchMsg` varchar(500) NOT NULL,
  `timeMs` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `msgchat`
--

CREATE TABLE `msgchat` (
  `id` int(11) NOT NULL,
  `msgFrom` varchar(20) NOT NULL,
  `msgTo` varchar(20) NOT NULL,
  `msg` text NOT NULL,
  `msgDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msgchat`
--

INSERT INTO `msgchat` (`id`, `msgFrom`, `msgTo`, `msg`, `msgDate`) VALUES
(2, 'bob', 'Ram', 'Ram, Hell', '0000-00-00 00:00:00'),
(3, 'bob', 'Gita', 'Gita, Hi', '0000-00-00 00:00:00'),
(8, 'bob', 'Ram', 'Ram, Hi', '2018-01-23 21:34:23'),
(9, 'bob', 'Hari', 'Hari, Hello', '2018-01-23 21:37:18'),
(10, 'bob', 'Robin', 'Robin, Hey', '2018-01-26 21:26:59'),
(11, 'bob', 'Gita', 'Gita, gg', '2018-01-26 21:27:13'),
(12, 'bob', 'Hari', 'Hari, Hello', '2018-01-27 14:58:32'),
(13, 'bob', 'Hari', 'Hari, Hello', '2018-01-27 18:34:13'),
(14, 'bob', 'Hari', 'Hari, Hello', '2018-01-27 18:36:27'),
(15, 'bob', 'Chan', 'Chan, Hello', '2018-01-27 18:58:14'),
(16, 'bob', 'chan', 'Chan, hi', '2018-01-27 19:02:34'),
(17, 'bob', 'Robin', 'Robin, GM', '2018-01-28 12:43:52'),
(18, 'bob', 'Gulab', 'Gulab, hi', '2018-01-30 16:04:11'),
(19, 'bob', 'Gulab', 'Gulab, hello', '2018-01-30 16:09:34'),
(20, 'bob', 'Chan', 'Chan, Hi', '2018-02-08 09:45:35'),
(21, 'bob', 'Chan', 'Chan, Hello', '2018-03-17 19:57:46'),
(22, 'sita', 'Ram', 'Ram, Hi', '2018-03-18 08:27:21'),
(23, 'bob', 'Chan', 'Chan, Hi man', '2018-04-11 20:31:18'),
(24, 'bob', 'Chan', 'Chan, Hello', '2018-04-30 20:40:35'),
(25, 'chan', 'ashish', 'H', '2018-07-08 21:43:29'),
(26, 'chan', 'ashish', 'Hello Ashish', '2018-07-09 09:27:26'),
(27, 'chan', 'ashish', 'Hi ashish', '2018-07-22 07:47:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username_id` (`username_id`),
  ADD KEY `friend_id` (`friend_id`);

--
-- Indexes for table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msgchat`
--
ALTER TABLE `msgchat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `friend`
--
ALTER TABLE `friend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `msg`
--
ALTER TABLE `msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `msgchat`
--
ALTER TABLE `msgchat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `friend_ibfk_1` FOREIGN KEY (`username_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `friend_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `account` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
