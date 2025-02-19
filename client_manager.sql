-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2025 at 09:42 AM
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
-- Database: `client_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_name` varchar(255) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `Id` int(11) NOT NULL,
  `short_description` text DEFAULT NULL,
  `long_description` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `toll_free` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `time_zone` varchar(50) DEFAULT NULL,
  `map` text DEFAULT NULL,
  `booking_link` text DEFAULT NULL,
  `business_category` varchar(255) DEFAULT NULL,
  `services_offered` text DEFAULT NULL,
  `brands_carried` text DEFAULT NULL,
  `monday_active` tinyint(1) DEFAULT 0,
  `monday_start` time DEFAULT '09:00:00',
  `monday_end` time DEFAULT '18:00:00',
  `tuesday_active` tinyint(1) DEFAULT 0,
  `tuesday_start` time DEFAULT '09:00:00',
  `tuesday_end` time DEFAULT '18:00:00',
  `wednesday_active` tinyint(1) DEFAULT 0,
  `wednesday_start` time DEFAULT '09:00:00',
  `wednesday_end` time DEFAULT '18:00:00',
  `thursday_active` tinyint(1) DEFAULT 0,
  `thursday_start` time DEFAULT '09:00:00',
  `thursday_end` time DEFAULT '18:00:00',
  `friday_active` tinyint(1) DEFAULT 0,
  `friday_start` time DEFAULT '09:00:00',
  `friday_end` time DEFAULT '18:00:00',
  `saturday_active` tinyint(1) DEFAULT 0,
  `saturday_start` time DEFAULT '09:00:00',
  `saturday_end` time DEFAULT '18:00:00',
  `sunday_active` tinyint(1) DEFAULT 0,
  `sunday_start` time DEFAULT '09:00:00',
  `sunday_end` time DEFAULT '18:00:00',
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `custom_name` varchar(255) DEFAULT NULL,
  `custom_link` varchar(255) DEFAULT NULL,
  `hosting_provider` varchar(255) DEFAULT NULL,
  `hosting_plan` varchar(255) DEFAULT NULL,
  `hosting_start_date` date DEFAULT NULL,
  `hosting_renewal_date` date DEFAULT NULL,
  `hosting_cost` decimal(10,2) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `domain_name` varchar(255) DEFAULT NULL,
  `domain_registration_date` date DEFAULT NULL,
  `domain_expiry_date` date DEFAULT NULL,
  `domain_cost` decimal(10,2) DEFAULT NULL,
  `ssl_provider` varchar(255) DEFAULT NULL,
  `ssl_expiry_date` date DEFAULT NULL,
  `ssl_installation_date` date DEFAULT NULL,
  `billing_frequency` varchar(255) DEFAULT NULL,
  `last_payment_date` date DEFAULT NULL,
  `next_billing_date` date DEFAULT NULL,
  `total_amount_due` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `subscription_plan` varchar(255) DEFAULT NULL,
  `subscription_status` varchar(50) DEFAULT NULL,
  `subscription_start_date` date DEFAULT NULL,
  `subscription_end_date` date DEFAULT NULL,
  `subscription_price` decimal(10,2) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `primary_image` varchar(255) DEFAULT NULL,
  `gallery` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_name`, `business_name`, `website`, `Id`, `short_description`, `long_description`, `phone`, `mobile`, `fax`, `toll_free`, `country`, `address`, `city`, `state`, `zip`, `time_zone`, `map`, `booking_link`, `business_category`, `services_offered`, `brands_carried`, `monday_active`, `monday_start`, `monday_end`, `tuesday_active`, `tuesday_start`, `tuesday_end`, `wednesday_active`, `wednesday_start`, `wednesday_end`, `thursday_active`, `thursday_start`, `thursday_end`, `friday_active`, `friday_start`, `friday_end`, `saturday_active`, `saturday_start`, `saturday_end`, `sunday_active`, `sunday_start`, `sunday_end`, `facebook`, `twitter`, `instagram`, `linkedin`, `youtube`, `custom_name`, `custom_link`, `hosting_provider`, `hosting_plan`, `hosting_start_date`, `hosting_renewal_date`, `hosting_cost`, `ip_address`, `domain_name`, `domain_registration_date`, `domain_expiry_date`, `domain_cost`, `ssl_provider`, `ssl_expiry_date`, `ssl_installation_date`, `billing_frequency`, `last_payment_date`, `next_billing_date`, `total_amount_due`, `payment_method`, `subscription_plan`, `subscription_status`, `subscription_start_date`, `subscription_end_date`, `subscription_price`, `logo`, `favicon`, `primary_image`, `gallery`) VALUES
('', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '00:00:00', '00:00:00', 1, '00:00:00', '00:00:00', 1, '00:00:00', '00:00:00', 1, '00:00:00', '00:00:00', 1, '00:00:00', '00:00:00', 1, '00:00:00', '00:00:00', 1, '00:00:00', '00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('', '', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '00:00:00', '00:00:00', 1, '00:00:00', '00:00:00', 1, '00:00:00', '00:00:00', 1, '00:00:00', '00:00:00', 1, '00:00:00', '00:00:00', 1, '00:00:00', '00:00:00', 1, '00:00:00', '00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('first', 'JK Steel', 'https://www.google.com', 126, 'This is the short desc of comp', 'This is the short desc of comp', '7800908900', '8748563728', '783476264', '672663526', 'India', '204 Avenu complex', 'Surat', 'Gujarat', '783564', 'Kolkata', 'https://www.google.com', 'https://www.google.com', '', '', '', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 'http://www.google.com', 'http://www.google.com', 'http://www.google.com', 'http://www.google.com', 'http://www.google.com', 'http://www.google.com', 'http://www.google.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mene', 'Active', '1111-11-11', '1111-11-11', 5000.00, NULL, NULL, NULL, NULL),
('men', 'manish', 'https://cms.celaenotechnology.com/AddClient.php?tab=PrimaryInfo', 129, 'manish', 'manish', 'manish', '1123478945', 'manish', 'manish', 'manish', 'manish', 'manish', 'manish', 'v', 'v', 'https://cms.celaenotechnology.com/AddClient.php?tab=PrimaryInfo', 'https://cms.celaenotechnology.com/AddClient.php?tab=PrimaryInfo', 'manisha', 'manish', 'manish', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'demo', 'Active', '2025-02-05', '2025-02-19', 1000.00, NULL, NULL, NULL, NULL),
('add', 'msakmask', 'https://cms.celaenotechnology.com/AddClient.php?tab=PrimaryInfo', 132, 'add', 'add', 'add', '1111111111', 'add', 'vadd', 'add', 'add', 'v', 'add', 'add', 'add', 'https://cms.celaenotechnology.com/AddClient.php?tab=PrimaryInfo', 'https://cms.celaenotechnology.com/AddClient.php?tab=PrimaryInfo', 'add', 'add', 'add', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_domain_hosting`
--

CREATE TABLE `client_domain_hosting` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `hosting_provider` varchar(255) DEFAULT NULL,
  `hosting_plan` varchar(255) DEFAULT NULL,
  `hosting_start_date` date DEFAULT NULL,
  `hosting_renewal_date` date DEFAULT NULL,
  `hosting_cost` decimal(10,2) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `hosting_billing_frequency` varchar(255) DEFAULT NULL,
  `hosting_last_payment_date` date DEFAULT NULL,
  `hosting_next_billing_date` date DEFAULT NULL,
  `hosting_total_amount_due` decimal(10,2) DEFAULT NULL,
  `hosting_payment_method` varchar(255) DEFAULT NULL,
  `ssl_provider` varchar(255) DEFAULT NULL,
  `ssl_expiry_date` date DEFAULT NULL,
  `ssl_installation_date` date DEFAULT NULL,
  `ssl_billing_frequency` varchar(255) DEFAULT NULL,
  `ssl_last_payment_date` date DEFAULT NULL,
  `ssl_next_billing_date` date DEFAULT NULL,
  `ssl_total_amount_due` decimal(10,2) DEFAULT NULL,
  `ssl_payment_method` varchar(255) DEFAULT NULL,
  `domain_name` varchar(255) DEFAULT NULL,
  `domain_registration_date` date DEFAULT NULL,
  `domain_expiry_date` date DEFAULT NULL,
  `domain_cost` decimal(10,2) DEFAULT NULL,
  `domain_billing_frequency` varchar(255) DEFAULT NULL,
  `domain_last_payment_date` date DEFAULT NULL,
  `domain_next_billing_date` date DEFAULT NULL,
  `domain_total_amount_due` decimal(10,2) DEFAULT NULL,
  `domain_payment_method` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_domain_hosting`
--

INSERT INTO `client_domain_hosting` (`id`, `client_id`, `hosting_provider`, `hosting_plan`, `hosting_start_date`, `hosting_renewal_date`, `hosting_cost`, `ip_address`, `hosting_billing_frequency`, `hosting_last_payment_date`, `hosting_next_billing_date`, `hosting_total_amount_due`, `hosting_payment_method`, `ssl_provider`, `ssl_expiry_date`, `ssl_installation_date`, `ssl_billing_frequency`, `ssl_last_payment_date`, `ssl_next_billing_date`, `ssl_total_amount_due`, `ssl_payment_method`, `domain_name`, `domain_registration_date`, `domain_expiry_date`, `domain_cost`, `domain_billing_frequency`, `domain_last_payment_date`, `domain_next_billing_date`, `domain_total_amount_due`, `domain_payment_method`, `created_at`, `updated_at`) VALUES
(1, 1, 'Go Daddy', '', '2025-02-13', '2025-02-15', 1000.00, '192.0.0.1', '', '0000-00-00', '0000-00-00', 0.00, '', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', 400.00, 'CARD', 'mksolution.com', '2025-02-03', '2025-02-04', 200.00, '', '0000-00-00', '0000-00-00', 0.00, '', '2025-02-12 08:55:24', '2025-02-12 10:44:38'),
(2, 2, 'Hostinger', 'Standard', '0000-00-00', '0000-00-00', 200.00, '192.0.20.1', '', '0000-00-00', '0000-00-00', 0.00, '', '', '0000-00-00', '0000-00-00', 'Never', '0000-00-00', '0000-00-00', 0.00, '', '', '0000-00-00', '0000-00-00', 0.00, '', '0000-00-00', '0000-00-00', 0.00, '', '2025-02-12 13:19:16', '2025-02-12 15:28:17'),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-12 14:39:16', '2025-02-12 14:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `client_primaryinfo`
--

CREATE TABLE `client_primaryinfo` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `business_name` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `business_category` text DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `long_description` text DEFAULT NULL,
  `business_number` varchar(20) DEFAULT NULL,
  `other_business_number` varchar(55) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `toll_free` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `time_zone` varchar(50) DEFAULT NULL,
  `map_link` text DEFAULT NULL,
  `booking_link` varchar(255) DEFAULT NULL,
  `services_offered` text DEFAULT NULL,
  `brands_carried` text DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `custom_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_primaryinfo`
--

INSERT INTO `client_primaryinfo` (`client_id`, `client_name`, `created_at`, `business_name`, `website`, `business_category`, `short_description`, `long_description`, `business_number`, `other_business_number`, `mobile`, `fax`, `toll_free`, `country`, `address`, `city`, `state`, `zip_code`, `time_zone`, `map_link`, `booking_link`, `services_offered`, `brands_carried`, `facebook`, `twitter`, `instagram`, `linkedin`, `youtube`, `custom_link`) VALUES
(1, 'Mike Rose', '2025-02-11 17:47:20', 'MK Solution', 'https://www.mksolution.com', 'Steel,IT', 'This is the short desc', 'this is long', '9800789089', '7899098909', '', '', '', 'China', '203 Avanta complex', 'Surat', 'Gujarat', '890098', 'Channei', 'https://www.mkmap.com', 'https://www.mkbooking.com', 'Banking,Web', 'Zoho', 'https://www.mksolution.facebook.com', 'https://www.mksolution.twitter.com', 'https://www.mksolution.instagram.com', 'https://www.mksolution.linkedin.com', 'https://www.mksolution.youtube.com', ''),
(2, 'Jack Sully', '2025-02-12 13:19:16', 'Hedge Fund', 'https://jk.fund.org', 'Finance', '', '', '0999998880', '0987890654', '', '', '', 'USA', '', 'New York', '', '', '', '', '', '', '', 'https://jk.fund.facebook.com', '', '', '', '', ''),
(3, 'Client 3', '2025-02-12 14:39:16', 'Cl Cement', 'https://google.com', 'Steel Plant', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_uploads`
--

CREATE TABLE `client_uploads` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `primary_image` varchar(255) DEFAULT NULL,
  `gallery` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_uploads`
--

INSERT INTO `client_uploads` (`id`, `client_id`, `logo`, `favicon`, `primary_image`, `gallery`, `created_at`) VALUES
(1, 1, '67ac9531af287.jpg', '67ac96c9c9343.png', NULL, '[\"67ac92eac96c2.jpg\",\"67ac92eac9821.jpg\"]', '2025-02-12 12:22:51'),
(2, 2, NULL, '67aca08f72709.jpg', NULL, '[]', '2025-02-12 13:19:16'),
(3, 3, NULL, '67b3325c2db2e.jpg', NULL, '[]', '2025-02-12 14:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `file_size` varchar(50) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `uploaded_by` varchar(100) DEFAULT NULL,
  `uploaded_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `document_name`, `file_size`, `file_path`, `project_id`, `uploaded_by`, `uploaded_on`) VALUES
(25, 'image.png', '151.38 KB', 'Uploads/image.png', 1, 'User', '2025-02-12 17:42:52'),
(0, '1738756484_modasaIcon.jpg', '101.41 KB', 'Uploads/1738756484_modasaIcon.jpg', 0, 'User', '2025-02-17 12:50:28'),
(0, '1738768256_hacker.jpg', '77.52 KB', 'Uploads/1738768256_hacker.jpg', 14, 'User', '2025-02-17 13:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `status` enum('Pending','In Progress','Completed','On Hold') NOT NULL DEFAULT 'Pending',
  `team_member` text DEFAULT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `sales_person` varchar(255) DEFAULT NULL,
  `manager` varchar(255) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `project_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `billable_type` enum('Hourly','Fixed') NOT NULL DEFAULT 'Hourly',
  `billable_rate` decimal(10,2) NOT NULL DEFAULT 0.00,
  `budget_type` enum('Billable','Non-Billable') NOT NULL DEFAULT 'Billable',
  `budget` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `project_name`, `client_name`, `tags`, `status`, `team_member`, `date_created`, `sales_person`, `manager`, `due_date`, `project_price`, `billable_type`, `billable_rate`, `budget_type`, `budget`) VALUES
(1, 'invoice', 'rushabh', 'fffk', 'Completed', '4', '2024-02-22', 'rushabh', 'rushabh', '2024-08-22', 0.00, 'Hourly', 0.00, 'Billable', 0.00),
(2, 'invoice1', 'rushabh', 'fffk', 'In Progress', '4', '2024-06-05', 'rushabh', 'ssfjha', '2025-08-05', 0.00, 'Hourly', 0.00, 'Billable', 0.00),
(11, 'invoice2', 'rushabh', 'fffk', 'Pending', '4', '0000-00-00', 'rushabh', 'ssfjha', '2222-02-22', 0.00, 'Hourly', 0.00, 'Billable', 0.00),
(12, 'invoice', 'rushabh', 'fffk', 'In Progress', '4', '2025-02-11', 'rushabh', 'rushabh', '2222-02-22', 0.00, 'Hourly', 0.00, 'Billable', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `project_tags`
--

CREATE TABLE `project_tags` (
  `project_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_tags`
--

INSERT INTO `project_tags` (`project_id`, `tag_id`) VALUES
(7, 9),
(7, 10),
(7, 11),
(8, 14),
(8, 15),
(9, 19),
(9, 20);

-- --------------------------------------------------------

--
-- Table structure for table `project_tasks`
--

CREATE TABLE `project_tasks` (
  `task_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `priority` varchar(50) NOT NULL,
  `start_date` date NOT NULL DEFAULT current_timestamp(),
  `due_date` date NOT NULL DEFAULT current_timestamp(),
  `assigned_to` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_tasks`
--

INSERT INTO `project_tasks` (`task_id`, `project_id`, `task_name`, `description`, `category`, `status`, `priority`, `start_date`, `due_date`, `assigned_to`, `notes`, `attachment`) VALUES
(47, 12, 'new task', 'Ths  is he njkc', 'Design', 'In Progress', 'High', '2025-02-05', '2025-02-20', 'Jack', 'this is the notes', 'Uploads/1738756484_modasaIcon.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `project_template`
--

CREATE TABLE `project_template` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `assignee` varchar(255) NOT NULL DEFAULT 'Unassigned',
  `due` int(11) DEFAULT NULL,
  `recurrence` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_template`
--

INSERT INTO `project_template` (`id`, `name`, `assignee`, `due`, `recurrence`, `details`, `created_at`) VALUES
(7, 'Invoice Management', 'Rohit Joshi', 9, 'Daily', '<p>This is the invoice management project</p>\r\n', '2025-02-03 05:11:14'),
(8, 'Booking Website', 'Kevin Thakur', 5, 'daily', 'This is the demo project for testing', '2025-02-05 12:00:04'),
(9, 'Zoho Booking', 'Ronak Jain', 5, 'weekly', 'This is the demo', '2025-02-05 14:39:48'),
(10, '', '', 0, 'none', '', '2025-02-10 07:32:40'),
(11, '', '', 0, 'none', '', '2025-02-10 07:32:42'),
(12, '', '', 0, 'none', '', '2025-02-10 07:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag_name`) VALUES
(9, 'Invoice'),
(10, 'Project'),
(11, 'Management'),
(12, 'API'),
(13, 'REST'),
(14, 'Web'),
(15, 'Industry'),
(16, 'HTML'),
(17, 'CSS'),
(18, 'PHP'),
(19, 'Booking'),
(20, 'Zoho'),
(21, 'Book');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `assignee` varchar(255) NOT NULL,
  `due` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `name`, `assignee`, `due`, `created_at`) VALUES
(6, 7, 'Create a API', 'Rutvik Jani', 2, '2025-02-03 05:11:15'),
(7, 8, 'Create home page', 'Rani joshi', 4, '2025-02-05 12:00:05'),
(8, 9, 'Book demo', 'Joshi kartik', 3, '2025-02-05 14:39:48'),
(9, 9, 'Api creation', 'kavi', 2, '2025-02-05 14:39:48'),
(10, 10, '', '', 0, '2025-02-10 07:32:40'),
(11, 11, '', '', 0, '2025-02-10 07:32:42'),
(12, 12, '', '', 0, '2025-02-10 07:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `task_tags`
--

CREATE TABLE `task_tags` (
  `task_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_tags`
--

INSERT INTO `task_tags` (`task_id`, `tag_id`) VALUES
(6, 12),
(6, 13),
(7, 16),
(7, 17),
(7, 18),
(8, 12),
(8, 21),
(9, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `requesterName` varchar(255) NOT NULL,
  `requesterEmail` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `requesterName`, `requesterEmail`, `subject`, `description`, `created_at`) VALUES
(1, 'Jack Ma', 'jack@gmail.com', 'For Punctual software', 'This is the serious issue in punctual', '2025-02-02 09:07:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Indexes for table `client_domain_hosting`
--
ALTER TABLE `client_domain_hosting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `client_primaryinfo`
--
ALTER TABLE `client_primaryinfo`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `client_uploads`
--
ALTER TABLE `client_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `project_tags`
--
ALTER TABLE `project_tags`
  ADD PRIMARY KEY (`project_id`,`tag_id`);

--
-- Indexes for table `project_tasks`
--
ALTER TABLE `project_tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `project_template`
--
ALTER TABLE `project_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_tags`
--
ALTER TABLE `task_tags`
  ADD PRIMARY KEY (`task_id`,`tag_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `client_domain_hosting`
--
ALTER TABLE `client_domain_hosting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client_primaryinfo`
--
ALTER TABLE `client_primaryinfo`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client_uploads`
--
ALTER TABLE `client_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project_tasks`
--
ALTER TABLE `project_tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `project_template`
--
ALTER TABLE `project_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_domain_hosting`
--
ALTER TABLE `client_domain_hosting`
  ADD CONSTRAINT `client_domain_hosting_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_primaryinfo` (`client_id`);

--
-- Constraints for table `client_uploads`
--
ALTER TABLE `client_uploads`
  ADD CONSTRAINT `client_uploads_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_primaryinfo` (`client_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
