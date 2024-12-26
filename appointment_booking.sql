-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 26, 2024 at 01:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appointment_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientlink`
--

CREATE TABLE `clientlink` (
  `id` int(11) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientlink`
--

INSERT INTO `clientlink` (`id`, `facebook`, `twitter`, `instagram`, `linkedin`, `youtube`) VALUES
(2, 'https://facbok.com', 'https://facbok.com', 'https://facbok.com', 'https://facbok.com', 'https://facbok.com'),
(3, 'https://facbok.com', 'https://facbok.com', 'https://facbok.com', 'https://facbok.com', 'https://facbok.com');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `long_description` text NOT NULL,
  `phone` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `toll_free` varchar(15) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `time_zone` varchar(50) NOT NULL,
  `map` varchar(255) DEFAULT NULL,
  `booking_link` varchar(255) NOT NULL,
  `business_category` text DEFAULT NULL,
  `services_offered` text DEFAULT NULL,
  `brands_carried` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `business_name`, `website`, `short_description`, `long_description`, `phone`, `mobile`, `fax`, `toll_free`, `country`, `address`, `city`, `state`, `zip`, `time_zone`, `map`, `booking_link`, `business_category`, `services_offered`, `brands_carried`) VALUES
(1, 'dfa', 'https://Gym.com', 'daf', 'dfaddfdgdg', '09327113080,3322112211', '5522332211', '+91 44 123 4567', '044 123 4567', 'India', 'no', 'no', 'Gujarat', '365560', 'inda', 'https://googlle.map.com', 'https://ok.com', 'no', '', ''),
(14, 'Gym', 'https://Gym.com', 'dda', 'dfaf', '1122112233', '2233112233', '+91 44 123 4567', '4234', 'america', 'new zercy ,state 01 part2', 'new zercy', 'america', '223322', 'asdf', 'https://googlle.map.com', 'https://ok.com', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientlink`
--
ALTER TABLE `clientlink`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientlink`
--
ALTER TABLE `clientlink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
