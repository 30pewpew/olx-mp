-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2018 at 02:29 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olx`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `userId` int(10) UNSIGNED NOT NULL,
  `productId` int(10) UNSIGNED NOT NULL,
  `category` varchar(20) DEFAULT NULL,
  `minPrice` int(10) UNSIGNED DEFAULT NULL,
  `uploadedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`userId`, `productId`, `category`, `minPrice`, `uploadedTime`, `description`) VALUES
(14, 46, 'Sleeping', 100, '2018-05-08 08:39:16', 'Sleeping in Physics 71'),
(15, 47, 'Sleeping', 150, '2018-05-08 08:41:25', 'Math 74'),
(15, 48, 'Sleeping', 135, '2018-05-08 08:41:41', 'Library'),
(15, 49, 'Photoshoot', 299, '2018-05-08 08:58:01', 'CYA'),
(15, 50, 'Solo', 499, '2018-05-08 08:59:54', 'Bahay ni carlos'),
(15, 51, 'Pair', 499, '2018-05-08 09:02:02', 'Mister Miss CAMP'),
(15, 52, 'Selfies', 499, '2018-05-09 07:54:14', 'Bianca Abella');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `serialNo` int(10) UNSIGNED NOT NULL,
  `buyerId` int(10) UNSIGNED NOT NULL,
  `productId` int(10) UNSIGNED NOT NULL,
  `bidPrice` int(10) UNSIGNED DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `statusTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `accepted` enum('y','n','h') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`serialNo`, `buyerId`, `productId`, `bidPrice`, `time`, `statusTime`, `accepted`) VALUES
(32, 13, 52, 499, '2018-05-09 07:54:59', '2018-05-09 07:55:25', 'y'),
(33, 13, 46, 100, '2018-05-09 08:07:36', '2018-05-09 08:07:36', 'h');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(30) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `password` char(41) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `lastLogout` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `joinDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `gender` enum('m','f') DEFAULT NULL,
  `favoriteItems` varchar(20) DEFAULT NULL,
  `emailAddress` varchar(50) DEFAULT NULL,
  `otherInterests` text,
  `phoneno` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `lastLogout`, `joinDate`, `gender`, `favoriteItems`, `emailAddress`, `otherInterests`, `phoneno`) VALUES
(13, 'ethan', '*A16523BB4AC43F4136918211EB918D4B8B483A97', 'ETHAN MATTHEW CHENG SY', '2018-05-09 08:02:24', '2018-05-08 08:29:39', NULL, NULL, 'ethan@gmail.com', NULL, '9951968141'),
(14, 'seller1', '*47586D303F33E9D4D748F66BDC3DAF9293CAD005', 'SELLER ONE', '2018-05-08 08:40:28', '2018-05-08 08:37:45', NULL, NULL, 'seller1@gmail.com', NULL, '9978672354'),
(15, 'seller2', '*5C349A5FD48D0538F4835385304739DDD528C0B1', 'SELLER TWO', '2018-05-09 08:07:09', '2018-05-08 08:38:12', NULL, NULL, 'seller2@gmail.com', NULL, '9982769809'),
(16, 'seller3', '*94DB8B50ACFD2D949B0671D56E1726360BFAFE98', 'SELLER THREE', '2018-05-08 08:38:34', '2018-05-08 08:38:34', NULL, NULL, 'seller3@gmail.com', NULL, '9981732716');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`serialNo`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `emailAddress` (`emailAddress`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `serialNo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
