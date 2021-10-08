-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2021 at 06:41 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `office_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `payroll_number` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `payroll_number`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'Testov1', 'TT1', 'tt1@yahoo.com', '2021-10-06 08:31:59', '2021-10-06 08:31:59'),
(2, 'Test', 'Testov2', 'TT2', 'tt2@yahoo.com', '2021-10-06 08:32:31', '2021-10-06 08:32:32'),
(3, 'Test', 'Testov3', 'TT3', 'tt3@yahoo.com', '2021-10-06 08:32:58', '2021-10-06 08:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `id` int(11) NOT NULL,
  `office_name` varchar(80) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `office_name`, `created_at`, `updated_at`) VALUES
(1, 'Sun Office', '2021-10-06 08:44:14', '2021-10-06 08:44:14'),
(2, 'Blue Office', '2021-10-06 08:44:33', '2021-10-06 08:44:33'),
(3, 'Garden Office', '2021-10-06 08:45:18', '2021-10-06 08:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` bigint(20) NOT NULL,
  `office_id` int(11) NOT NULL,
  `office_seat_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `office_id`, `office_seat_id`, `created_at`, `updated_at`) VALUES
(9, 1, 1, '2021-10-08 12:25:46', '2021-10-08 12:25:46'),
(10, 3, 1, '2021-10-08 12:28:08', '2021-10-08 12:28:08'),
(11, 1, 2, '2021-10-08 12:28:17', '2021-10-08 12:35:09');

-- --------------------------------------------------------

--
-- Table structure for table `seats_book`
--

CREATE TABLE `seats_book` (
  `id` int(11) NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `booking_date` date NOT NULL,
  `seat_id` bigint(20) NOT NULL,
  `seat_book_time_slot_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seats_book`
--

INSERT INTO `seats_book` (`id`, `employee_id`, `booking_date`, `seat_id`, `seat_book_time_slot_id`, `created_at`, `updated_at`) VALUES
(5, 1, '2021-10-08', 9, 1, '2021-10-08 14:20:16', '2021-10-08 14:20:16'),
(6, 2, '2021-10-08', 9, 3, '2021-10-08 14:20:58', '2021-10-08 14:20:58'),
(7, 3, '2021-10-08', 11, 10, '2021-10-08 14:32:26', '2021-10-08 14:32:26'),
(8, 1, '2021-10-08', 9, 5, '2021-10-08 14:38:46', '2021-10-08 14:38:46'),
(9, 3, '2021-10-13', 9, 2, '2021-10-08 18:14:48', '2021-10-08 18:14:48'),
(10, 2, '2021-10-08', 9, 2, '2021-10-08 18:39:54', '2021-10-08 18:39:55'),
(11, 2, '2021-10-09', 9, 2, '2021-10-08 18:40:10', '2021-10-08 18:40:10'),
(12, 2, '2021-10-09', 11, 2, '2021-10-08 18:40:27', '2021-10-08 18:40:28'),
(13, 1, '2021-10-09', 11, 1, '2021-10-08 18:40:46', '2021-10-08 18:40:46');

-- --------------------------------------------------------

--
-- Table structure for table `seats_book_time_slots`
--

CREATE TABLE `seats_book_time_slots` (
  `id` int(11) NOT NULL,
  `time_slot_db_key` varchar(60) NOT NULL,
  `label` varchar(60) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seats_book_time_slots`
--

INSERT INTO `seats_book_time_slots` (`id`, `time_slot_db_key`, `label`, `start_time`, `end_time`) VALUES
(1, '08:00-08:59', '08:00-08:59', '08:00:00', '08:59:59'),
(2, '09:00-09:59', '09:00-09:59', '09:00:00', '09:59:59'),
(3, '10:00-10:59', '10:00-10:59', '10:00:00', '10:59:59'),
(4, '11:00-11:59', '11:00-11:59', '11:00:00', '11:59:59'),
(5, '12:00-12:59', '12:00-12:59', '12:00:00', '12:59:59'),
(6, '13:00-13:59', '13:00-13:59', '13:00:00', '13:59:59'),
(7, '14:00-14:59', '14:00-14:59', '14:00:00', '14:59:59'),
(8, '15:00-15:59', '15:00-15:59', '15:00:00', '15:59:59'),
(9, '16:00-16:59', '16:00-16:59', '16:00:00', '16:59:59'),
(10, 'whole_working_day', 'Whole working day', '08:00:00', '16:59:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `office_id_2` (`office_id`,`office_seat_id`) USING BTREE,
  ADD KEY `office_id` (`office_id`);

--
-- Indexes for table `seats_book`
--
ALTER TABLE `seats_book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seat_id_2` (`booking_date`,`seat_id`,`seat_book_time_slot_id`) USING BTREE,
  ADD KEY `seat_id` (`seat_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `seats_book_time_slots_id` (`seat_book_time_slot_id`);

--
-- Indexes for table `seats_book_time_slots`
--
ALTER TABLE `seats_book_time_slots`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `seats_book`
--
ALTER TABLE `seats_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `seats_book_time_slots`
--
ALTER TABLE `seats_book_time_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `seats_book`
--
ALTER TABLE `seats_book`
  ADD CONSTRAINT `seats_book_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `seats_book_ibfk_2` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `seats_book_ibfk_3` FOREIGN KEY (`seat_book_time_slot_id`) REFERENCES `seats_book_time_slots` (`id`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
