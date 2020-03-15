-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2019 at 07:18 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

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
-- Table structure for table `appointment_booking`
--

CREATE TABLE `appointment_booking` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `booking_patient_id` int(155) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `visit_payment` decimal(15,2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0=Empty,1=Booked, 2=Complete, 3=Cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment_booking`
--

INSERT INTO `appointment_booking` (`id`, `date`, `time`, `booking_patient_id`, `doctor_id`, `visit_payment`, `status`, `created_at`, `updated_at`) VALUES
(10, '2019-06-15', '15:20:00', 9, 1, NULL, 2, '2019-06-19 01:17:36', '2019-06-19 02:59:22'),
(11, '2019-06-15', '16:00:00', 10, 1, NULL, 3, '2019-06-19 01:19:20', '2019-06-19 03:05:55'),
(13, '2019-06-15', '16:40:00', 12, 1, NULL, 3, '2019-06-19 01:23:31', '2019-06-19 03:07:12'),
(14, '2019-06-15', '17:00:00', 13, 1, NULL, 3, '2019-06-19 01:42:06', '2019-06-19 03:06:34'),
(15, '2019-06-16', '15:00:00', 14, 1, NULL, 2, '2019-06-19 02:03:20', '2019-06-19 02:55:24'),
(16, '2019-06-16', '15:20:00', 15, 1, NULL, 2, '2019-06-19 02:08:33', '2019-06-19 02:59:57'),
(17, '2019-06-16', '15:40:00', 16, 1, NULL, 2, '2019-06-19 02:15:28', '2019-06-19 03:01:26'),
(19, '2019-06-18', '08:00:00', 18, 1, NULL, 2, '2019-06-19 02:18:14', '2019-06-19 03:01:16'),
(21, '2019-06-16', '16:20:00', 20, 1, '500.00', 1, '2019-06-19 04:03:30', '2019-06-19 05:00:09'),
(22, '2019-06-15', '16:00:00', 21, 1, '500.00', 2, '2019-06-19 05:04:21', '2019-06-19 05:05:12'),
(23, '2019-06-18', '15:00:00', 22, 2, '500.00', 2, '2019-06-19 05:25:55', '2019-06-19 05:27:11'),
(24, '2019-06-18', '15:30:00', 23, 2, NULL, 1, '2019-06-19 05:26:22', '2019-06-19 05:26:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_booking`
--
ALTER TABLE `appointment_booking`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_booking`
--
ALTER TABLE `appointment_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
