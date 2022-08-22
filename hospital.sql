-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2018 at 06:08 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(200) NOT NULL,
  `account` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `account`, `action`, `status`, `created`) VALUES
(154, 'mohamed.esam@yahoo.com', 'Add New Offer', 1, '2018-04-22 13:29:08'),
(155, 'admin@ua.com', 'Send order to vendor  ', 1, '2018-04-22 13:29:32'),
(156, 'mohamed.esam@yahoo.com', 'Add Order to stock', 1, '2018-04-22 13:29:47'),
(157, 'mohamed.esam@yahoo.com', 'Add New Offer', 1, '2018-04-22 13:32:49'),
(158, 'mohamed.esam@yahoo.com', 'Add New Offer', 1, '2018-04-22 13:38:04'),
(159, 'admin@ua.com', 'Send order to vendor  ', 1, '2018-04-22 13:38:56'),
(160, 'mohamed.esam@yahoo.com', 'Add Order to stock', 1, '2018-04-22 13:39:17'),
(161, 'ahmed@yahoo.com', 'buy new order', 1, '2018-04-22 13:40:00'),
(162, 'admin@ua.com', 'sell order', 1, '2018-04-22 13:40:32'),
(163, 'ahmed@yahoo.com', 'buy new order', 1, '2018-04-22 13:45:24'),
(164, 'admin@ua.com', 'sell order', 1, '2018-04-22 14:00:02'),
(165, 'ahmed@yahoo.com', 'buy new order', 1, '2018-04-22 14:01:02'),
(166, 'ahmed@yahoo.com', 'buy new order', 1, '2018-04-22 14:01:07'),
(167, 'ahmed@yahoo.com', 'buy new order', 1, '2018-04-22 14:01:20'),
(168, 'admin@ua.com', 'sell order', 1, '2018-04-22 14:01:44'),
(169, 'ahmed@yahoo.com', 'buy new order', 1, '2018-04-22 14:09:51'),
(170, 'admin@ua.com', 'sell order', 1, '2018-04-22 14:10:13'),
(171, 'ahmed@yahoo.com', 'buy new order', 1, '2018-04-22 14:11:29'),
(172, 'admin@ua.com', 'sell order', 1, '2018-04-22 14:11:46'),
(173, 'ahmed@yahoo.com', 'buy new order', 1, '2018-04-22 14:14:09'),
(174, 'admin@ua.com', 'sell order', 1, '2018-04-22 14:14:23'),
(175, 'ahmed@yahoo.com', 'buy new order', 1, '2018-04-22 14:16:32'),
(176, 'ahmed@yahoo.com', 'buy new order', 1, '2018-04-22 14:17:41'),
(177, 'ahmed@yahoo.com', 'buy new order', 1, '2018-04-22 14:24:39'),
(178, 'ahmed@yahoo.com', 'buy new order', 1, '2018-04-22 14:25:08'),
(179, 'ahmed@yahoo.com', 'buy new order', 1, '2018-04-22 14:25:31'),
(180, 'ahmed@yahoo.com', 'buy new order', 1, '2018-04-22 14:34:24'),
(181, 'ahmed@yahoo.com', 'buy new order', 1, '2018-04-22 14:35:55'),
(182, 'ahmed@yahoo.com', 'buy new order', 1, '2018-04-22 14:39:59'),
(183, 'mohamed.esam@yahoo.com', 'Add New Offer', 1, '2018-04-22 17:51:17'),
(184, 'admin@ua.com', 'Send order to vendor  ', 1, '2018-04-22 17:52:08'),
(185, 'mohamed.esam@yahoo.com', 'Add Order to stock', 1, '2018-04-22 17:52:43'),
(186, 'ahmed@yahoo.com', 'buy new order', 1, '2018-04-22 17:53:46'),
(187, 'ahmed@yahoo.com', 'buy new order', 1, '2018-04-22 17:54:16'),
(188, 'admin@ua.com', 'sell order', 1, '2018-04-22 17:54:58'),
(189, 'mohamed.esam@yahoo.com', 'Add New Offer', 1, '2018-04-22 17:57:46'),
(190, 'mohamed.esam@yahoo.com', 'Add New Offer', 1, '2018-04-22 17:57:57');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `totalp` int(200) NOT NULL,
  `buyprice` int(200) NOT NULL,
  `availability` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` enum('Pending','Ordered','Stocked') NOT NULL,
  `Quantity` int(11) NOT NULL,
  `buy` int(200) NOT NULL,
  `prostatus` enum('non','req','buy') NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `ordered` datetime NOT NULL,
  `stocked` datetime NOT NULL,
  `lastbuy` datetime NOT NULL,
  `ntf` int(1) NOT NULL DEFAULT '0',
  `ntf2` int(1) NOT NULL DEFAULT '1',
  `cstname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `email`, `product`, `speciality`, `price`, `totalp`, `buyprice`, `availability`, `img`, `status`, `Quantity`, `buy`, `prostatus`, `created`, `updated`, `ordered`, `stocked`, `lastbuy`, `ntf`, `ntf2`, `cstname`) VALUES
(45, 'mohamed.esam@yahoo.com', 'rotahelex', 'Chest', 12, 12000, 15, 1000, '199354.jpg', 'Stocked', 600, 5, 'req', '2018-04-22 13:38:04', '0000-00-00 00:00:00', '2018-04-22 13:38:56', '2018-04-22 13:39:17', '2018-04-22 14:39:59', 3, 1, 'ahmed@yahoo.com'),
(46, 'mohamed.esam@yahoo.com', 'granitryl', 'Chest', 14, 28000, 20, 2000, '728311.jpg', 'Stocked', 1900, 100, 'buy', '2018-04-22 17:51:17', '0000-00-00 00:00:00', '2018-04-22 17:52:08', '2018-04-22 17:52:43', '2018-04-22 17:54:16', 3, 1, 'ahmed@yahoo.com'),
(47, 'mohamed.esam@yahoo.com', 'ddddd', 'Heart', 12, 0, 0, 100, '45358.jpg', 'Pending', 0, 0, 'non', '2018-04-22 17:57:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, ''),
(48, 'mohamed.esam@yahoo.com', 'fffff', 'Heart', 15, 0, 0, 100, '503397.jpg', 'Pending', 0, 0, 'non', '2018-04-22 17:57:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `id` int(11) NOT NULL,
  `cstname1` varchar(255) NOT NULL,
  `product1` varchar(255) NOT NULL,
  `amount` int(200) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`id`, `cstname1`, `product1`, `amount`, `created`) VALUES
(10, 'ahmed@yahoo.com', 'rotahelex', 1290, '2018-04-22 14:01:44'),
(11, 'ahmed@yahoo.com', 'rotahelex', 1500, '2018-04-22 14:10:13'),
(12, 'ahmed@yahoo.com', 'rotahelex', 1500, '2018-04-22 14:11:46'),
(13, 'ahmed@yahoo.com', 'rotahelex', 1500, '2018-04-22 14:14:23'),
(14, 'ahmed@yahoo.com', 'granitryl', 2000, '2018-04-22 17:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `ntf` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `phone`, `password`, `role`, `created`, `updated`, `ntf`) VALUES
(7, 'admin', '1', 'admin@ua.com', 'xxxxxxxxxxx', 'p@ssw0rd', 'Administrator', '2018-04-16 23:54:44', '0000-00-00 00:00:00', 1),
(8, 'mohamed', 'Esam', 'mohamed.esam@yahoo.com', '01000', 'p@ssw0rd', 'Vendor', '2018-04-17 00:54:23', '0000-00-00 00:00:00', 1),
(24, 'ahmed', 'hassan', 'ahmed@yahoo.com', '0100000000000', 'p@ssw0rd', 'Customer', '2018-04-19 00:30:32', '2018-04-19 13:04:09', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;
--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `sell`
--
ALTER TABLE `sell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
