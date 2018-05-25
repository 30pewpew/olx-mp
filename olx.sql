-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2018 at 04:57 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

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
  `description` varchar(60) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`userId`, `productId`, `category`, `minPrice`, `uploadedTime`, `description`, `title`) VALUES
(14, 46, 'Sleeping', 100, '2018-05-08 08:39:16', 'Sleeping in Physics 71', ''),
(15, 47, 'Sleeping', 150, '2018-05-08 08:41:25', 'Math 74', ''),
(15, 48, 'Sleeping', 135, '2018-05-08 08:41:41', 'Library', ''),
(15, 49, 'Photoshoot', 299, '2018-05-08 08:58:01', 'CYA', ''),
(15, 50, 'Solo', 499, '2018-05-08 08:59:54', 'Bahay ni carlos', ''),
(15, 51, 'Pair', 499, '2018-05-08 09:02:02', 'Mister Miss CAMP', ''),
(15, 52, 'Selfies', 499, '2018-05-09 07:54:14', 'Bianca Abella', ''),
(13, 53, 'Solo', 699, '2018-05-12 00:44:50', 'Inom sa bahay ni Carlos', ''),
(13, 54, 'Selfies', 799, '2018-05-12 00:46:08', 'Rob Manila', ''),
(18, 55, 'Solo', 230, '2018-05-24 14:53:23', 'not Esy', ''),
(18, 71, 'Photoshoot', 50, '2018-05-25 13:09:58', 'tunay palaban ', 'Krystel Salazar'),
(18, 72, 'Photoshoot', 50, '2018-05-25 13:11:29', 'tunay palaban ', 'Krystel Salazar');

-- --------------------------------------------------------

--
-- Table structure for table `productssale`
--

CREATE TABLE `productssale` (
  `productID` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `userID` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchasehistory`
--

CREATE TABLE `purchasehistory` (
  `price` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `seller` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(33, 13, 46, 100, '2018-05-09 08:07:36', '2018-05-09 08:07:36', 'h'),
(34, 13, 51, 499, '2018-05-12 00:49:47', '2018-05-12 00:49:47', 'h'),
(35, 17, 52, 499, '2018-05-12 00:54:44', '2018-05-12 00:54:44', 'h'),
(36, 17, 54, 899, '2018-05-12 00:54:51', '2018-05-12 00:54:51', 'h'),
(37, 16, 54, 799, '2018-05-12 00:56:02', '2018-05-12 00:56:02', 'h');

-- --------------------------------------------------------

--
-- Table structure for table `saleshistory`
--

CREATE TABLE `saleshistory` (
  `price` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `buyer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `phoneno` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `lastLogout`, `joinDate`, `gender`, `favoriteItems`, `emailAddress`, `otherInterests`, `phoneno`, `address`) VALUES
(13, 'ethan', '*A16523BB4AC43F4136918211EB918D4B8B483A97', 'ETHAN MATTHEW CHENG SY', '2018-05-12 00:54:31', '2018-05-08 08:29:39', NULL, NULL, 'ethan@gmail.com', NULL, '9951968141', ''),
(14, 'seller1', '*47586D303F33E9D4D748F66BDC3DAF9293CAD005', 'SELLER ONE', '2018-05-12 00:52:07', '2018-05-08 08:37:45', NULL, NULL, 'seller1@gmail.com', NULL, '9978672354', ''),
(15, 'seller2', '*5C349A5FD48D0538F4835385304739DDD528C0B1', 'SELLER TWO', '2018-05-12 00:55:13', '2018-05-08 08:38:12', NULL, NULL, 'seller2@gmail.com', NULL, '9982769809', ''),
(16, 'seller3', '*94DB8B50ACFD2D949B0671D56E1726360BFAFE98', 'SELLER THREE', '2018-05-12 00:57:11', '2018-05-08 08:38:34', NULL, NULL, 'seller3@gmail.com', NULL, '9981732716', ''),
(18, 'mashedPAOtato', '*2D9CA1001478C64A4921C0B2595F2DF9D25CEB39', 'PAOLO', '2018-05-25 14:15:13', '2018-05-24 14:51:26', NULL, NULL, 'paoloandal@gmail.com', NULL, '0922407496', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `productssale`
--
ALTER TABLE `productssale`
  ADD PRIMARY KEY (`productID`);

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
  MODIFY `productId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `productssale`
--
ALTER TABLE `productssale`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `serialNo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
