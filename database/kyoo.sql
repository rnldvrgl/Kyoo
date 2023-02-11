-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2023 at 10:19 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kyoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `role_id`, `user_id`, `login_id`, `dept_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2023-02-07 12:38:13', '2023-02-07 12:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `account_details`
--

CREATE TABLE `account_details` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `about` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_details`
--

INSERT INTO `account_details` (`user_id`, `name`, `address`, `phone`, `about`, `created_at`, `updated_at`) VALUES
(1, 'Lewence Endrano', 'Sa may bako bakong daan', '09123456789', 'A full-stack web developer with a passion and drive to engage in the IT industry. Knowledgeable in developing websites, and eager to learn new abilities and improve my skills to contribute to a team and an organization.', '2023-02-07 12:21:26', '2023-02-11 07:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `account_login`
--

CREATE TABLE `account_login` (
  `login_id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_login`
--

INSERT INTO `account_login` (`login_id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'mainadmin@gmail.com', '$2y$10$VJ0xjFC0Y7CQrrEycCCIoOgNFeKh72GoKHAU7vkT8vent8kBBDjoq', '2023-02-07 12:22:17', '2023-02-11 08:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `account_role`
--

CREATE TABLE `account_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_role`
--

INSERT INTO `account_role` (`role_id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'Main Admin', '2023-02-07 12:29:01', '2023-02-07 12:29:03'),
(2, 'Admin', '2023-02-08 07:15:50', '2023-02-11 05:14:17'),
(3, 'Staff', '2023-02-08 07:16:17', '2023-02-08 07:16:17'),
(4, 'Librarian', '2023-02-08 07:16:29', '2023-02-08 07:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(30) NOT NULL,
  `dept_desc` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`, `dept_desc`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Office', 'This is the Office', 'Active', '2023-02-07 12:33:01', '2023-02-09 13:21:13'),
(2, 'Registrar', 'This is the Registrar', 'Active', '2023-02-07 12:34:11', '2023-02-09 13:21:20'),
(3, 'Cashier', 'This is the Cashier', 'Active', '2023-02-07 12:37:06', '2023-02-09 13:21:27'),
(4, 'Library', 'This is the Library', 'Active', '2023-02-07 12:37:18', '2023-02-09 13:21:32'),
(9, 'OSA', 'Osa osa osageeee', 'Active', '2023-02-11 03:23:01', '2023-02-11 03:23:01'),
(10, 'Computer Lab', 'Hello World', 'Inactive', '2023-02-11 03:24:48', '2023-02-11 03:24:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `account_details` (`user_id`),
  ADD KEY `account_login` (`login_id`),
  ADD KEY `account_role` (`role_id`),
  ADD KEY `departments` (`dept_id`);

--
-- Indexes for table `account_details`
--
ALTER TABLE `account_details`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `account_login`
--
ALTER TABLE `account_login`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `UNIQUE EMAIL` (`email`) USING BTREE;

--
-- Indexes for table `account_role`
--
ALTER TABLE `account_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `account_details`
--
ALTER TABLE `account_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `account_login`
--
ALTER TABLE `account_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `account_role`
--
ALTER TABLE `account_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `account_details` FOREIGN KEY (`user_id`) REFERENCES `account_details` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `account_login` FOREIGN KEY (`login_id`) REFERENCES `account_login` (`login_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `account_role` FOREIGN KEY (`role_id`) REFERENCES `account_role` (`role_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `departments` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`dept_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
