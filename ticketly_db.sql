-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 20, 2025 at 06:53 PM
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
-- Database: `ticketly_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `event_venue` varchar(100) NOT NULL,
  `ticket_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_date`, `event_venue`, `ticket_price`) VALUES
(1, 'Concert Night', '2025-12-01', 'City Arena', 25.00),
(2, 'Tech Expo', '2025-12-15', 'Convention Center', 15.00),
(3, 'Movie Premiere', '2025-12-20', 'Downtown Cinema', 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `nrc` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `physical_address` varchar(255) NOT NULL,
  `area` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `town` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `sex` enum('Male','Female','Other') NOT NULL,
  `client_type` enum('Student','Worker','Business Person') NOT NULL,
  `hobbies` text DEFAULT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_account_no` varchar(50) NOT NULL,
  `bank_branch` varchar(100) NOT NULL,
  `bank_address` varchar(255) NOT NULL,
  `bank_phone` varchar(15) NOT NULL,
  `bank_email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `nrc`, `dob`, `phone_number`, `email`, `physical_address`, `area`, `street`, `town`, `province`, `country`, `sex`, `client_type`, `hobbies`, `bank_name`, `bank_account_no`, `bank_branch`, `bank_address`, `bank_phone`, `bank_email`, `password`) VALUES
(1, 'Matthew', 'Kabalata', '350259/68/1', '2002-06-09', '0762229590', 'matthewkabalata@gmail.com', '71 KM Kamirenda Avenue', 'sekesha', '71 KM Kamirenda Avenue', 'Luanshya', 'Copperbelt', 'Zambia', 'Male', 'Student', 'swim', 'bf ', '32032494432', 'adddis', 'ggg', '0762229590', 'matthewkabalata@gmail.com', '$2y$10$7sbym.wA4IaQjw1O5PQej.cYKFs4BB9FwMO0ufddBEN2OwrIthxF6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
