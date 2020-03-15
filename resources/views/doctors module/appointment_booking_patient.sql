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
-- Table structure for table `appointment_booking_patient`
--

CREATE TABLE `appointment_booking_patient` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment_booking_patient`
--

INSERT INTO `appointment_booking_patient` (`id`, `name`, `contact_number`, `created_at`, `updated_at`) VALUES
(9, 'Atahar Sharif', '0175600000', '2019-06-19 01:17:36', '2019-06-19 01:17:36'),
(10, 'asdasd', '4536456', '2019-06-19 01:19:20', '2019-06-19 01:19:20'),
(12, 'aadsad', '456456', '2019-06-19 01:23:31', '2019-06-19 01:23:31'),
(13, 'asdasdasd', '4564564', '2019-06-19 01:42:06', '2019-06-19 01:42:06'),
(14, 'Asdfg', '01756000007', '2019-06-19 02:03:20', '2019-06-19 02:55:24'),
(15, 'asdad', '45456', '2019-06-19 02:08:33', '2019-06-19 02:08:33'),
(16, 'asdasd', '123123', '2019-06-19 02:15:28', '2019-06-19 02:15:28'),
(18, 'Mr. Khan', '0175600000', '2019-06-19 02:18:14', '2019-06-19 02:18:14'),
(20, 'Sumon Khan', '01756123564', '2019-06-19 04:03:30', '2019-06-19 04:03:30'),
(21, 'Atahar Sharif', '01756000000', '2019-06-19 05:04:21', '2019-06-19 05:04:21'),
(22, 'Shakil Khan', '01756000000', '2019-06-19 05:25:54', '2019-06-19 05:25:54'),
(23, 'Atahar Khal Ali', '01756000000', '2019-06-19 05:26:22', '2019-06-19 05:26:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_booking_patient`
--
ALTER TABLE `appointment_booking_patient`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_booking_patient`
--
ALTER TABLE `appointment_booking_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
