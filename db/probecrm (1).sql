-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2020 at 06:15 AM
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
-- Database: `probecrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` int(10) UNSIGNED NOT NULL,
  `editordata` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admission_payment`
--

CREATE TABLE `admission_payment` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(50) DEFAULT NULL,
  `payment_purpose` int(11) DEFAULT NULL,
  `admission_fee` decimal(15,2) DEFAULT 0.00,
  `advance_money` decimal(15,2) DEFAULT 0.00,
  `paying_amount` decimal(15,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admission_payment`
--

INSERT INTO `admission_payment` (`id`, `patient_id`, `payment_purpose`, `admission_fee`, `advance_money`, `paying_amount`, `created_at`, `updated_at`) VALUES
(1, 'P2019-1', 1, '1000.00', '6000.00', '0.00', '2019-06-25 03:18:08', '2019-06-25 04:11:52'),
(2, 'P2019-1', 2, '0.00', '0.00', '5000.00', '2019-06-26 09:46:43', '2019-06-26 09:46:43'),
(4, 'P2019-1', 2, '0.00', '0.00', '2000.00', '2019-06-26 06:52:09', '2019-06-26 06:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `affiliates`
--

CREATE TABLE `affiliates` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(155) DEFAULT NULL,
  `division_id` tinyint(11) DEFAULT NULL,
  `district_id` tinyint(11) DEFAULT NULL,
  `thana_id` tinyint(11) DEFAULT NULL,
  `status` tinyint(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `agent_commision`
--

CREATE TABLE `agent_commision` (
  `id` int(11) NOT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `agent_type` tinyint(3) DEFAULT NULL,
  `commision` double DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agent_commision`
--

INSERT INTO `agent_commision` (`id`, `agent_id`, `agent_type`, `commision`, `status`, `created_at`, `updated_at`) VALUES
(1, 10, 1, 12.25, 1, '2020-01-13 23:20:13', '2020-01-18 03:12:17');

-- --------------------------------------------------------

--
-- Table structure for table `agent_wallet`
--

CREATE TABLE `agent_wallet` (
  `id` int(11) NOT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `commission` double DEFAULT NULL,
  `wallet` decimal(15,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agent_wallet`
--

INSERT INTO `agent_wallet` (`id`, `agent_id`, `commission`, `wallet`, `created_at`, `updated_at`) VALUES
(1, 10, 12.25, '343.00', '2020-01-18 03:44:26', '2020-01-18 03:54:28');

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
(24, '2019-06-18', '15:30:00', 23, 2, NULL, 1, '2019-06-19 05:26:22', '2019-06-19 05:26:22'),
(25, '2019-11-30', '15:00:00', 24, 1, NULL, 1, '2019-12-05 06:05:34', '2019-12-05 06:05:34'),
(26, '2019-12-21', '15:00:00', 25, 1, NULL, 1, '2019-12-23 03:31:29', '2019-12-23 03:31:29');

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
(23, 'Atahar Khal Ali', '01756000000', '2019-06-19 05:26:22', '2019-06-19 05:26:22'),
(24, NULL, NULL, '2019-12-05 06:05:34', '2019-12-05 06:05:34'),
(25, 'Demo User', '345325', '2019-12-23 03:31:29', '2019-12-23 03:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `name` varchar(155) DEFAULT NULL,
  `status` tinyint(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Dhaka', 1, '2020-01-19 00:24:19', '2020-01-19 00:24:19'),
(3, 'Khuln', 1, '2020-01-19 03:25:32', '2020-01-19 03:25:50');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `blog_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vedio_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blood_group`
--

CREATE TABLE `blood_group` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `sale_rate` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blood_group`
--

INSERT INTO `blood_group` (`id`, `group_name`, `sale_rate`, `created_at`, `updated_at`) VALUES
(1, 'O+', '500.00', '2019-05-13 02:16:28', '2019-05-13 02:16:28'),
(2, 'A+', '450.00', '2019-05-13 02:16:42', '2019-05-13 02:22:30'),
(3, 'B+', '400.00', '2019-05-13 02:16:56', '2019-05-13 02:16:56'),
(4, 'AB+', '450.00', '2019-05-13 02:17:11', '2019-05-13 02:17:11'),
(5, 'O-', '450.00', '2019-05-13 02:17:23', '2019-05-13 02:17:23'),
(6, 'A-', '500.00', '2019-05-13 02:17:33', '2019-05-13 02:17:33'),
(7, 'B-', '500.00', '2019-05-13 02:17:45', '2019-05-13 02:17:45'),
(8, 'AB-', '400.00', '2019-05-13 02:17:59', '2019-05-13 02:17:59');

-- --------------------------------------------------------

--
-- Table structure for table `commission_rate`
--

CREATE TABLE `commission_rate` (
  `id` int(11) NOT NULL,
  `percentage` int(11) DEFAULT NULL,
  `amount_rate` decimal(15,2) DEFAULT NULL,
  `amount_rate_end` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `currency_space` tinyint(4) DEFAULT 1 COMMENT '1=yes,0=no',
  `currency_position` int(11) DEFAULT NULL,
  `digit_separator` varchar(50) DEFAULT NULL,
  `expire_day_limit` int(11) DEFAULT NULL,
  `is_scanned` tinyint(4) DEFAULT 1 COMMENT '1=scanned,2=not scanned',
  `customer_approve` tinyint(4) DEFAULT 0 COMMENT '1=yes,0=no',
  `default_country` int(11) DEFAULT NULL,
  `default_state` int(11) DEFAULT NULL,
  `store_phone` varchar(50) DEFAULT NULL,
  `report_delivery_time_limit` varchar(155) DEFAULT NULL,
  `store_email` varchar(100) DEFAULT NULL,
  `store_name` varchar(155) DEFAULT NULL,
  `store_title` varchar(155) DEFAULT NULL,
  `store_description` text DEFAULT NULL,
  `store_keyword` text DEFAULT NULL,
  `store_meta_title` varchar(250) DEFAULT NULL,
  `short_note` text DEFAULT NULL,
  `map_link` text DEFAULT NULL,
  `theme_color` text DEFAULT NULL,
  `button_hover_color` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `favicon` text DEFAULT NULL,
  `facebook_link` text DEFAULT NULL,
  `twitter_link` text DEFAULT NULL,
  `linkedin_link` text DEFAULT NULL,
  `youtube_link` text DEFAULT NULL,
  `google_plus_link` text DEFAULT NULL,
  `company_name` varchar(155) DEFAULT NULL,
  `company_email` varchar(155) DEFAULT NULL,
  `company_mobile` varchar(155) DEFAULT NULL,
  `company_details` text DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `footer_box_1` text DEFAULT NULL,
  `footer_box_2` text DEFAULT NULL,
  `footer_box_3` text DEFAULT NULL,
  `footer_box_4` text DEFAULT NULL,
  `bottom_footer` text DEFAULT NULL,
  `top_footer` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`id`, `currency_id`, `currency_space`, `currency_position`, `digit_separator`, `expire_day_limit`, `is_scanned`, `customer_approve`, `default_country`, `default_state`, `store_phone`, `report_delivery_time_limit`, `store_email`, `store_name`, `store_title`, `store_description`, `store_keyword`, `store_meta_title`, `short_note`, `map_link`, `theme_color`, `button_hover_color`, `logo`, `favicon`, `facebook_link`, `twitter_link`, `linkedin_link`, `youtube_link`, `google_plus_link`, `company_name`, `company_email`, `company_mobile`, `company_details`, `company_address`, `footer_box_1`, `footer_box_2`, `footer_box_3`, `footer_box_4`, `bottom_footer`, `top_footer`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 0, 'comma', 10, 1, 1, 18, 0, '1568942', 'Report collect with in 30 days', 'asad@gmail.com', 'Hardware Store', 'online hardware store', '<div class=\"col-md-7\">\r\n<h2 class=\"text-uppercase\">About Company</h2>\r\n\r\n<div class=\"dlab-separator-outer \">\r\n<div class=\"dlab-separator bg-secondry style-skew\">&nbsp;</div>\r\n</div>\r\n\r\n<div class=\"clear\">&nbsp;</div>\r\n\r\n<p><strong>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</strong></p>\r\n\r\n<p class=\"m-b50\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the with the release of Letraset sheets containing Lorem Ipsum [...]</p>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-md-6 col-sm-6\">\r\n<div class=\"icon-bx-wraper left m-b30\">\r\n<div class=\"icon-bx-sm bg-secondry \">&nbsp;</div>\r\n\r\n<div class=\"icon-content\">\r\n<h3 class=\"dlab-tilte text-uppercase\">WE&#39;RE EXPERTS</h3>\r\n\r\n<p>Lorem ipsum dolor sit adipiscing sed diam nonummy end [...]</p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-6 col-sm-6\">\r\n<div class=\"icon-bx-wraper left m-b30\">\r\n<div class=\"icon-bx-sm bg-secondry \">&nbsp;</div>\r\n\r\n<div class=\"icon-content\">\r\n<h3 class=\"dlab-tilte text-uppercase\">WE&#39;RE FRIENDLY</h3>\r\n\r\n<p>Lorem ipsum dolor sit adipiscing sed diam nonummy end [...]</p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-6 col-sm-6\">\r\n<div class=\"icon-bx-wraper left m-b30\">\r\n<div class=\"icon-bx-sm bg-secondry \">&nbsp;</div>\r\n\r\n<div class=\"icon-content\">\r\n<h3 class=\"dlab-tilte text-uppercase\">WE&#39;RE ACCURATE</h3>\r\n\r\n<p>Lorem ipsum dolor sit adipiscing sed diam nonummy end [...]</p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-6 col-sm-6\">\r\n<div class=\"icon-bx-wraper left m-b30\">\r\n<div class=\"icon-bx-sm bg-secondry \">&nbsp;</div>\r\n\r\n<div class=\"icon-content\">\r\n<h3 class=\"dlab-tilte text-uppercase\">WE&#39;RE TRUSTED</h3>\r\n\r\n<p>Lorem ipsum dolor sit adipiscing sed diam nonummy end [...]</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-5\">\r\n<div class=\"dlab-thu m\"><img alt=\"\" src=\"http://localhost/ppms/public/frontend/images/worker.png\" /></div>\r\n</div>', 'store,hardware,tools', 'store meta title', '<h3 class=\"dlab-tilte text-uppercase m-b10\">Meet &amp; Ask</h3>\r\n\r\n<p>Lorem Ipsum is simply dummy text the printing and industry dummy Ipsum Lorem</p>', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d684.4688561379095!2d90.36109610185504!3d23.77666561319452!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c0bb647384e9%3A0xe42b3fa312325e19!2s15+Golden+Street%2C+Dhaka!5e0!3m2!1sen!2sbd!4v1537678521540', 'FFFFFF', 'FFFFFF', '8230918075849.png', '492230918075849.png', 'https://www.facebook.com/', 'https://www.twitter.com/', NULL, 'https://www.youtube.com/', 'https://www.google.com/', 'Medistore', 'medistore@gmail.com', '+088 01900 000 000', NULL, '1234 Heaven Stress,Beverly Hill Old york- United State.', '<h2>Contact us</h2>\r\n<!--headin5_amrc-->\r\n\r\n<p><img src=\"http://localhost/pharmacySystem/public/frontend/images/place.png\" /> <span class=\"contact-text\">1234 Heaven Stress,Beverly Hill Old york- United State.</span></p>\r\n\r\n<p><img src=\"http://localhost/pharmacySystem/public/frontend/images/phone.png\" /> <span class=\"contact-text\">&nbsp;+088 01900 000 000</span></p>\r\n\r\n<p><img src=\"http://localhost/pharmacySystem/public/frontend/images/gmail.png\" /> <span class=\"contact-text\">&nbsp;medistore@gmail.com</span></p>', '<h2>Information</h2>\r\n<!--headin5_amrc-->\r\n\r\n<ul class=\"footer_ul_amrc\">\r\n	<li><a href=\"#\">About Us</a></li>\r\n	<li><a href=\"#\">Delivery Information</a></li>\r\n	<li><a href=\"#\">Privacy Policy</a></li>\r\n	<li><a href=\"#\">Terms &amp; Condition</a></li>\r\n	<li><a href=\"#\">Contact Us</a></li>\r\n	<li><a href=\"#\">Help</a></li>\r\n	<li><a href=\"#\">FAQ</a></li>\r\n</ul>', '<h2>My Account</h2>\r\n<!--headin5_amrc-->\r\n\r\n<ul class=\"footer_ul_amrc\">\r\n	<li><a href=\"#\">My Account</a></li>\r\n	<li><a href=\"#\">Order History</a></li>\r\n	<li><a href=\"#\">Returns</a></li>\r\n	<li><a href=\"#\">Wish List</a></li>\r\n	<li><a href=\"#\">News Letter</a></li>\r\n</ul>', '<h2>Categories</h2>\r\n<!--headin5_amrc-->\r\n\r\n<ul class=\"footer_ul_amrc\">\r\n	<li><a href=\"#\">Health</a></li>\r\n	<li><a href=\"#\">Beauty</a></li>\r\n	<li><a href=\"#\">Personal Care</a></li>\r\n	<li><a href=\"#\">Vitamins &amp; Supplements</a></li>\r\n	<li><a href=\"#\">Baby Needs</a></li>\r\n	<li><a href=\"#\">Fitness</a></li>\r\n	<li><a href=\"#\">Herbal</a></li>\r\n	<li><a href=\"#\">Eye &amp; Ear Care</a></li>\r\n</ul>', '<p>Copyright &copy; 2019 www.medistore.com. All Rights Reserved. Design By webitsoft.net</p>', '<div class=\"col-md-3\">\r\n<h2 style=\"font-family: Arial\">Payment Methods</h2>\r\n</div>\r\n\r\n<div class=\"col-sm-9\">\r\n<div class=\"all-payments\"><img src=\"http://localhost/pharmacySystem/public/frontend/images/payment.png\" /></div>\r\n<!--foote_bottom_ul_amrc ends here--></div>', '2018-07-26 05:15:50', '2019-02-23 03:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `id` int(11) NOT NULL,
  `courier_type` tinyint(3) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `branch_name` varchar(155) DEFAULT NULL,
  `phone` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `courier_commision` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `couriers`
--

INSERT INTO `couriers` (`id`, `courier_type`, `name`, `branch_name`, `phone`, `address`, `email`, `courier_commision`, `created_at`, `updated_at`) VALUES
(3, 1, 'Shymoli', 'kollanpur', '0170015000', 'Dhaka,Bangladesh', 'shymoli@gmail.com', 200, '2020-01-19 23:59:10', '2020-01-21 06:17:49'),
(4, 1, 'Hanif', 'mirpur', '01751534502', 'Mirpur,Dhaka', 'hanif@gmail.com', 200, '2020-01-21 03:08:06', '2020-01-21 09:11:20'),
(5, 2, 'Shundorbon', 'uttara', '01321456789', 'uttara,dhaka', 'shundorbon@gmail.com', 200, '2020-01-21 03:09:30', '2020-01-21 09:11:27');

-- --------------------------------------------------------

--
-- Table structure for table `courier_sample_collection`
--

CREATE TABLE `courier_sample_collection` (
  `id` int(11) NOT NULL,
  `courier_id` int(11) DEFAULT NULL,
  `collected_date` date NOT NULL,
  `box_qty` int(11) NOT NULL,
  `bus_number` varchar(150) NOT NULL,
  `supervisor_name` varchar(155) NOT NULL,
  `supervisor_contact_number` varchar(110) NOT NULL,
  `destination_place` int(10) DEFAULT NULL,
  `arriving_place` int(10) DEFAULT NULL,
  `arriving_time` time NOT NULL,
  `status` tinyint(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courier_sample_collection`
--

INSERT INTO `courier_sample_collection` (`id`, `courier_id`, `collected_date`, `box_qty`, `bus_number`, `supervisor_name`, `supervisor_contact_number`, `destination_place`, `arriving_place`, `arriving_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, '2020-01-15', 3, 'qwe123', 'tapos', '0142563987', 3, NULL, '13:01:00', 3, '2020-01-21 04:57:58', '2020-02-09 05:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1=enable,2=disable',
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `icon`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 'BDT', '৳', 1, 0, '2018-07-17 02:06:44', '2018-08-14 03:59:33'),
(3, 'Euro', '€', 2, 2, '2018-07-17 02:06:52', '2018-08-14 03:59:36'),
(4, 'USD', '$', 1, 1, '2018-07-17 05:24:13', '2018-09-29 03:13:47'),
(5, 'Pound', '£', 1, 1, '2018-07-17 05:24:34', '2018-08-14 01:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_man_assign`
--

CREATE TABLE `delivery_man_assign` (
  `id` int(11) NOT NULL,
  `delivery_man_id` int(11) DEFAULT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `franchise_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `delivery_man_assign`
--

INSERT INTO `delivery_man_assign` (`id`, `delivery_man_id`, `agent_id`, `franchise_id`, `created_at`, `updated_at`) VALUES
(1, 19, 10, '14,16', '2020-01-12 01:18:56', '2020-01-20 10:25:24'),
(2, 18, 10, '14,15,16', '2020-01-20 04:35:59', '2020-01-20 04:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `diagnostic_patient`
--

CREATE TABLE `diagnostic_patient` (
  `id` int(11) NOT NULL,
  `refd_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `patient_name` varchar(255) DEFAULT NULL,
  `patient_age` varchar(255) DEFAULT NULL,
  `patient_phone` varchar(100) DEFAULT NULL,
  `patient_gender` tinyint(4) DEFAULT 1 COMMENT '1=male,2=female',
  `date` timestamp NULL DEFAULT NULL,
  `patient_id` varchar(50) DEFAULT NULL,
  `total_amount` decimal(15,2) DEFAULT 0.00,
  `discount` int(11) DEFAULT NULL,
  `discount_amount` decimal(15,2) DEFAULT 0.00,
  `payable_amount` decimal(15,2) DEFAULT 0.00,
  `receive_amount` decimal(15,2) DEFAULT 0.00,
  `due_amount` decimal(15,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diagnostic_patient`
--

INSERT INTO `diagnostic_patient` (`id`, `refd_by`, `created_by`, `patient_name`, `patient_age`, `patient_phone`, `patient_gender`, `date`, `patient_id`, `total_amount`, `discount`, `discount_amount`, `payable_amount`, `receive_amount`, `due_amount`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'Prolay mukharjee', '24', '01657598349', NULL, '2019-12-02 03:59:47', 'D19000001', '900.00', NULL, '0.00', '900.00', '500.00', '400.00', '2019-12-02 03:59:47', '2019-12-08 05:45:00'),
(2, 1, 1, 'Srikanto', '30', '01375430537', NULL, '2019-12-02 04:36:51', 'D19000002', '6900.00', 10, '690.00', '6210.00', '6210.00', '0.00', '2019-12-02 04:36:51', '2019-12-03 01:11:32'),
(3, 1, 12, 'Demo User', '23', '01864848048', NULL, '2019-12-05 05:59:36', 'D19000003', '6900.00', 10, '690.00', '6210.00', '6210.00', '0.00', '2019-12-05 05:59:36', '2019-12-08 05:45:21'),
(4, NULL, 1, 'Nondini', '24', '01864848048', NULL, '2019-12-08 00:30:24', 'P19000004', '6900.00', 5, '345.00', '6555.00', '4000.00', '2555.00', '2019-12-08 00:30:24', '2019-12-08 00:30:24'),
(5, NULL, 11, 'Tanveer Hasan', '25', '01984535357', NULL, '2019-12-08 01:09:22', 'P19000005', '6900.00', 5, '345.00', '6555.00', '4000.00', '2555.00', '2019-12-08 01:09:22', '2019-12-08 01:09:22'),
(6, 1, 11, 'Demo User', '23', '018648480648', NULL, '2019-12-09 03:11:05', 'P19000006', '6000.00', NULL, '0.00', '6000.00', '3000.00', '3000.00', '2019-12-09 03:11:05', '2019-12-09 03:11:05'),
(7, NULL, 11, 'Demo User', '23', '01864848048', NULL, '2019-12-09 03:54:08', 'P19000007', '900.00', NULL, '0.00', '900.00', '900.00', '0.00', '2019-12-09 03:54:08', '2019-12-09 03:54:08'),
(8, NULL, 11, 'Sema bosh', '34', '0154735359', NULL, '2019-12-09 04:28:50', 'P19000008', '6000.00', 4, '240.00', '5760.00', '3000.00', '2760.00', '2019-12-09 04:28:50', '2019-12-09 04:28:50'),
(9, 1, 1, 'patient 1', '24', '01864848048', NULL, '2020-01-16 05:42:34', 'P20000009', '6900.00', NULL, '0.00', '6900.00', '5000.00', '1900.00', '2020-01-16 05:42:34', '2020-01-16 05:42:34'),
(10, NULL, 14, 'patient 1', '25', '01864848048', NULL, '2020-01-18 01:12:35', 'P20000010', '6900.00', NULL, '0.00', '6900.00', '5000.00', '1900.00', '2020-01-18 01:12:35', '2020-01-18 01:12:35'),
(11, NULL, 14, 'patient 2', '28', '01864848048', NULL, '2020-01-18 03:42:25', 'P20000011', '6900.00', NULL, '0.00', '6900.00', '3000.00', '3900.00', '2020-01-18 03:42:25', '2020-01-18 03:42:25'),
(12, NULL, 14, 'patient 2', '28', '01864848048', NULL, '2020-01-18 03:43:18', 'P20000012', '6900.00', NULL, '0.00', '6900.00', '3000.00', '3900.00', '2020-01-18 03:43:18', '2020-01-18 03:43:18'),
(13, NULL, 14, 'patient 2', '28', '01864848048', NULL, '2020-01-18 03:43:38', 'P20000013', '6900.00', NULL, '0.00', '6900.00', '3000.00', '3900.00', '2020-01-18 03:43:38', '2020-01-18 03:43:38'),
(14, NULL, 14, 'patient 2', '28', '01864848048', NULL, '2020-01-18 03:44:26', 'P20000014', '6900.00', NULL, '0.00', '6900.00', '3000.00', '3900.00', '2020-01-18 03:44:26', '2020-01-18 03:44:26'),
(15, NULL, 14, 'patient 3', '34', '01547353594', NULL, '2020-01-18 03:46:07', 'P20000015', '6900.00', NULL, '0.00', '6900.00', '5000.00', '1900.00', '2020-01-18 03:46:07', '2020-01-18 03:46:07'),
(16, NULL, 14, 'patient 4', '32', '0154735359213', 1, '2020-01-18 03:54:28', 'P20000016', '6900.00', NULL, '0.00', '6900.00', '6000.00', '900.00', '2020-01-18 03:54:28', '2020-01-18 03:54:28'),
(17, NULL, 16, 'patient 2', '45', '01864848048', 1, '2020-01-20 04:27:26', 'P20000017', '6900.00', NULL, '0.00', '6900.00', '3000.00', '3900.00', '2020-01-20 04:27:26', '2020-01-20 04:27:26'),
(18, NULL, 13, 'patient 5', '23', '01864848048', 2, '2020-01-20 04:57:47', 'P20000018', '6900.00', NULL, '0.00', '6900.00', '4500.00', '2400.00', '2020-01-20 04:57:47', '2020-01-20 04:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `diagnostic_patient_test`
--

CREATE TABLE `diagnostic_patient_test` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(50) DEFAULT NULL,
  `diagnostic_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `test_amount` decimal(15,2) DEFAULT 0.00,
  `test_delivery_date` date DEFAULT NULL,
  `test_delivery_time` varchar(50) DEFAULT NULL,
  `progress_status` tinyint(4) DEFAULT 1 COMMENT '1=pending,2=completed,3=delivered',
  `collection_status` tinyint(4) DEFAULT 1 COMMENT '1=yes,0=no',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diagnostic_patient_test`
--

INSERT INTO `diagnostic_patient_test` (`id`, `patient_id`, `diagnostic_id`, `test_id`, `quantity`, `test_amount`, `test_delivery_date`, `test_delivery_time`, `progress_status`, `collection_status`, `created_at`, `updated_at`) VALUES
(1, 'D19000001', 1, 1, 1, '900.00', '2019-12-03', '5:00PM', 1, 1, '2019-12-02 03:59:47', '2019-12-02 03:59:47'),
(2, 'D19000002', 2, 1, 1, '900.00', '2019-12-03', '5:00PM', 1, 1, '2019-12-02 04:36:51', '2019-12-02 04:36:51'),
(3, 'D19000002', 2, 2, 1, '6000.00', '2019-12-03', '5:00PM', 3, 1, '2019-12-02 04:36:51', '2019-12-02 04:38:20'),
(4, 'D19000003', 3, 1, 1, '900.00', '2019-12-06', '5:00PM', 3, 1, '2019-12-05 05:59:36', '2019-12-05 06:02:51'),
(5, 'D19000003', 3, 2, 1, '6000.00', '2019-12-06', '5:00PM', 1, 1, '2019-12-05 05:59:37', '2019-12-05 05:59:37'),
(6, 'P19000004', 4, 1, 1, '900.00', '2019-12-09', '5:00PM', 3, 1, '2019-12-08 00:30:24', '2019-12-11 00:30:42'),
(7, 'P19000004', 4, 2, 1, '6000.00', '2019-12-09', '5:00PM', 1, 1, '2019-12-08 00:30:24', '2019-12-08 00:30:24'),
(8, 'P19000005', 5, 1, 1, '900.00', '2019-12-09', '5:00PM', 1, 1, '2019-12-08 01:09:22', '2019-12-08 01:09:22'),
(9, 'P19000005', 5, 2, 1, '6000.00', '2019-12-09', '5:00PM', 1, 1, '2019-12-08 01:09:22', '2019-12-08 01:09:22'),
(10, 'P19000006', 6, 2, 1, '6000.00', '2019-12-10', '5:00PM', 1, 1, '2019-12-09 03:11:06', '2019-12-09 03:11:06'),
(11, 'P19000007', 7, 1, 1, '900.00', '2019-12-10', '5:00PM', 1, 1, '2019-12-09 03:54:08', '2019-12-09 03:54:08'),
(12, 'P19000008', 8, 2, 1, '6000.00', '2019-12-10', '5:00PM', 1, 1, '2019-12-09 04:28:50', '2019-12-09 04:28:50'),
(13, 'P20000012', 12, 1, 1, '900.00', '2020-01-19', '5:00PM', 1, 1, '2020-01-18 03:43:18', '2020-01-18 03:43:18'),
(14, 'P20000013', 13, 1, 1, '900.00', '2020-01-19', '5:00PM', 1, 1, '2020-01-18 03:43:38', '2020-01-18 03:43:38'),
(15, 'P20000013', 13, 2, 1, '6000.00', '2020-01-19', '5:00PM', 1, 1, '2020-01-18 03:43:38', '2020-01-18 03:43:38'),
(16, 'P20000014', 14, 1, 1, '900.00', '2020-01-19', '5:00PM', 1, 1, '2020-01-18 03:44:26', '2020-01-18 03:44:26'),
(17, 'P20000014', 14, 2, 1, '6000.00', '2020-01-19', '5:00PM', 1, 1, '2020-01-18 03:44:26', '2020-01-18 03:44:26'),
(18, 'P20000015', 15, 1, 1, '900.00', '2020-01-19', '5:00PM', 1, 1, '2020-01-18 03:46:07', '2020-01-18 03:46:07'),
(19, 'P20000015', 15, 2, 1, '6000.00', '2020-01-19', '5:00PM', 1, 1, '2020-01-18 03:46:07', '2020-01-18 03:46:07'),
(20, 'P20000016', 16, 1, 1, '900.00', '2020-01-19', '5:00PM', 1, 1, '2020-01-18 03:54:28', '2020-01-18 03:54:28'),
(21, 'P20000016', 16, 2, 1, '6000.00', '2020-01-19', '5:00PM', 1, 1, '2020-01-18 03:54:28', '2020-01-18 03:54:28'),
(22, 'P20000017', 17, 1, 1, '900.00', '2020-01-21', '5:00PM', 1, 1, '2020-01-20 04:27:27', '2020-01-20 04:27:27'),
(23, 'P20000017', 17, 2, 1, '6000.00', '2020-01-21', '5:00PM', 1, 1, '2020-01-20 04:27:27', '2020-01-20 04:27:27'),
(24, 'P20000018', 18, 1, 1, '900.00', '2020-01-21', '5:00PM', 1, 1, '2020-01-20 04:57:47', '2020-01-20 04:57:47'),
(25, 'P20000018', 18, 2, 1, '6000.00', '2020-01-21', '5:00PM', 1, 1, '2020-01-20 04:57:47', '2020-01-20 04:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `division_id`, `created_at`, `updated_at`) VALUES
(1, 'Gazipur', 1, '2019-11-12 03:40:55', '2019-11-12 03:40:55'),
(2, 'Narayongonj', 1, '2019-11-12 03:41:09', '2019-11-12 03:41:09');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', '2019-10-31 03:41:55', '2019-10-31 03:41:55'),
(2, 'Khulna', '2019-10-31 03:41:55', '2019-10-31 03:41:55'),
(3, 'Sylhet', '2019-10-31 03:41:55', '2019-11-12 22:58:06'),
(4, 'Barisal', '2019-10-31 03:41:55', '2019-10-31 03:41:55'),
(9, 'asdfa', '2020-02-20 12:58:21', '2020-02-20 12:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `department` int(3) DEFAULT NULL,
  `phone_no` varchar(30) DEFAULT NULL,
  `gender` int(3) DEFAULT NULL,
  `marital_status` int(3) DEFAULT NULL,
  `blood_group` int(3) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `work_experience` varchar(255) DEFAULT NULL,
  `present_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `specialist` text DEFAULT NULL,
  `educational_qualification` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `attachments` text DEFAULT NULL,
  `status` int(3) DEFAULT NULL COMMENT '1 = Active, 2=Inactive',
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `checkup_slot_period` varchar(255) DEFAULT NULL COMMENT 'minutes',
  `new_patient_visit` decimal(15,2) DEFAULT NULL,
  `old_patient_visit` decimal(15,2) DEFAULT NULL,
  `appointment_details` text DEFAULT NULL,
  `appointment_day_slot_schedule` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `first_name`, `last_name`, `department`, `phone_no`, `gender`, `marital_status`, `blood_group`, `dob`, `joining_date`, `work_experience`, `present_address`, `permanent_address`, `biography`, `specialist`, `educational_qualification`, `image`, `attachments`, `status`, `email`, `password`, `checkup_slot_period`, `new_patient_visit`, `old_patient_visit`, `appointment_details`, `appointment_day_slot_schedule`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Salimullah', 'Akhter', 1, '01756000001', 1, 1, 2, '1978-03-14', '2019-05-01', '4 Years', 'Uttara, Dhaka, Bangladesh', 'Naogaon, Rajshahi, Bangladesh', 'He has completed his residency in Internal Medicine at Franklin Square Hospital Center in Baltimore, affiliated with the University of Maryland. He completed a fellowship in Cardiovascular Medicine and received an Interventional Cardiology fellowship from Baystate Medical Center at Tufts University School of Medicine in Massachusetts. He received honors as an Outstanding Fellow while at Baystate Medical Center and the Darwish Award for Excellence in Clinical Medicine while at Franklin Square Hospital Center. Dr. Ranganath is board certified by the American Board of Internal Medicine, National Board of Echocardiography and the Certification Board of Nuclear Cardiology. He is a member of the American Board of Internal Medicine and the Royal College of Physicians in the United Kingdom.', 'Cardiology', 'MBBS, MD, MRCP', '718090519080238.jpg', NULL, 1, 'salimullah@gmail.com', '123456', '20', '500.00', '300.00', '[{\"day_id\":\"1\",\"start_time\":\"15:00\",\"end_time\":\"18:00\"},{\"day_id\":\"2\",\"start_time\":\"15:00\",\"end_time\":\"18:00\"},{\"day_id\":\"4\",\"start_time\":\"08:00\",\"end_time\":\"11:00\"},{\"day_id\":\"5\",\"start_time\":\"08:00\",\"end_time\":\"11:00\"}]', '{\"1\":\"{\\\"15:00\\\":null,\\\"15:20\\\":null,\\\"15:40\\\":null,\\\"16:00\\\":null,\\\"16:20\\\":null,\\\"16:40\\\":null,\\\"17:00\\\":null,\\\"17:20\\\":null,\\\"17:40\\\":null}\",\"2\":\"{\\\"15:00\\\":null,\\\"15:20\\\":null,\\\"15:40\\\":null,\\\"16:00\\\":null,\\\"16:20\\\":null,\\\"16:40\\\":null,\\\"17:00\\\":null,\\\"17:20\\\":null,\\\"17:40\\\":null}\",\"4\":\"{\\\"08:00\\\":null,\\\"08:20\\\":null,\\\"08:40\\\":null,\\\"09:00\\\":null,\\\"09:20\\\":null,\\\"09:40\\\":null,\\\"10:00\\\":null,\\\"10:20\\\":null,\\\"10:40\\\":null}\",\"5\":\"{\\\"08:00\\\":null,\\\"08:20\\\":null,\\\"08:40\\\":null,\\\"09:00\\\":null,\\\"09:20\\\":null,\\\"09:40\\\":null,\\\"10:00\\\":null,\\\"10:20\\\":null,\\\"10:40\\\":null}\"}', '2019-05-09 02:02:38', '2019-06-18 05:28:15'),
(2, 'Anisul', 'Haque', 1, '01756000012', 1, 1, 2, '1990-06-17', '2019-06-17', '5 Years', 'Dhaka, Bangladesh', 'Dhaka, Bangladesh', 'Initiative', 'Initiative', 'Initiative', NULL, NULL, 1, 'anisul@gmail.com', '123456', '30', '500.00', '400.00', '[{\"day_id\":\"2\",\"start_time\":\"15:00\",\"end_time\":\"18:00\"},{\"day_id\":\"4\",\"start_time\":\"15:00\",\"end_time\":\"18:00\"},{\"day_id\":\"6\",\"start_time\":\"15:00\",\"end_time\":\"18:00\"},{\"day_id\":\"7\",\"start_time\":\"15:00\",\"end_time\":\"18:00\"}]', '{\"2\":\"{\\\"15:00\\\":null,\\\"15:30\\\":null,\\\"16:00\\\":null,\\\"16:30\\\":null,\\\"17:00\\\":null,\\\"17:30\\\":null}\",\"4\":\"{\\\"15:00\\\":null,\\\"15:30\\\":null,\\\"16:00\\\":null,\\\"16:30\\\":null,\\\"17:00\\\":null,\\\"17:30\\\":null}\",\"6\":\"{\\\"15:00\\\":null,\\\"15:30\\\":null,\\\"16:00\\\":null,\\\"16:30\\\":null,\\\"17:00\\\":null,\\\"17:30\\\":null}\",\"7\":\"{\\\"15:00\\\":null,\\\"15:30\\\":null,\\\"16:00\\\":null,\\\"16:30\\\":null,\\\"17:00\\\":null,\\\"17:30\\\":null}\"}', '2019-06-17 00:26:51', '2019-06-19 05:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_appointments`
--

CREATE TABLE `doctor_appointments` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `patient_name` varchar(150) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `apt_date` date DEFAULT NULL,
  `apt_time` varchar(20) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor_appointments`
--

INSERT INTO `doctor_appointments` (`id`, `doctor_id`, `patient_name`, `phone`, `email`, `apt_date`, `apt_time`, `sex`, `created_at`, `updated_at`) VALUES
(3, 1, 'prolay', '0170000000', 'prolay@gmial.com', '2019-12-04', '03:30', NULL, '2019-12-04 05:14:11', '2019-12-04 05:14:11'),
(5, 1, 'prolay', '01751554502', 'prolay@gmial.com', '2019-12-04', '05:10', NULL, '2019-12-04 05:22:44', '2019-12-04 05:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `employee_id` varchar(50) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `thana_id` int(11) DEFAULT NULL,
  `gross_salary` decimal(15,2) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `image` varchar(155) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `phone_no` varchar(50) DEFAULT NULL,
  `present_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `monthly_salary` decimal(15,2) DEFAULT 0.00,
  `joining_date` date DEFAULT NULL,
  `resign_date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1=active,2=inactive',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `branch_id`, `employee_id`, `division_id`, `district_id`, `thana_id`, `gross_salary`, `name`, `email`, `image`, `designation_id`, `user_type`, `phone_no`, `present_address`, `permanent_address`, `monthly_salary`, `joining_date`, `resign_date`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, NULL, NULL, NULL, NULL, 'Tajik Mirza', 'tajik@example.com', '768130119051826.jpg', 2, 0, '01758642312', 'Dhaka, Bangladesh', 'Dhaka, Bangladesh', '22000.00', '2018-07-13', '2018-09-30', 2, '2018-07-18 02:32:28', '2019-01-12 23:18:26'),
(3, 1, NULL, NULL, NULL, NULL, NULL, 'Tahmid Tajik', 'tajik@gmail.com', '920130119051804.jpg', 1, 3, '014444544121', 'Mohammadpur, Dhaka, Bangladesh', NULL, '50000.00', '2018-09-01', NULL, 1, '2018-09-01 00:04:25', '2019-03-06 23:07:08'),
(4, 1, NULL, NULL, NULL, NULL, NULL, 'Abcd', 'abcd@gmail.com', '648130119051758.jpg', 1, 4, '01758642312', 'Dhaka, Bangladesh', NULL, '22000.00', '2018-09-30', NULL, 1, '2018-09-30 03:24:37', '2019-03-07 01:03:59'),
(5, 1, NULL, NULL, NULL, NULL, NULL, 'Abcd 2', 'final@gmail.com', '', 7, 0, '01758642312', 'Dhaka, Bangladesh', NULL, '22000.00', '2018-09-30', NULL, 1, '2018-09-30 03:27:01', '2018-09-30 03:53:03'),
(7, 1, NULL, NULL, NULL, NULL, NULL, 'Atahar Ali', 'atahar@gmail.com', '', 1, 3, '01756000000', 'Dhaka', 'Dhaka Bangladesh', '40000.00', '2019-03-01', NULL, 1, '2019-03-07 00:49:21', '2019-03-09 04:11:04'),
(8, NULL, NULL, NULL, NULL, NULL, NULL, 'Anisul Haque', 'anisul@gmail.com', NULL, 10, 5, '01756000012', 'Dhaka, Bangladesh', 'Dhaka, Bangladesh', '80000.00', '2019-06-17', NULL, 1, '2019-06-17 00:26:51', '2019-06-17 00:26:51'),
(9, 1, 'pd1234', 1, 2, 0, NULL, 'Delivery Man 1', 'delivery1@gmail.com', '', 11, 9, '+880156786950', 'gazipur', NULL, '12000.00', '2020-01-05', NULL, 1, '2020-01-04 23:42:40', '2020-01-04 23:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `employee_designation`
--

CREATE TABLE `employee_designation` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_designation`
--

INSERT INTO `employee_designation` (`id`, `name`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'Account Manager', 1, '2018-07-17 02:17:27', '2018-07-17 02:17:27'),
(2, 'Cash Manager', 1, '2018-07-17 02:18:04', '2018-07-17 02:18:04'),
(5, 'Chief Executive Officer', 1, '2018-07-17 02:19:05', '2018-07-17 02:19:05'),
(6, 'Director', 1, '2018-07-17 02:19:10', '2018-07-17 02:19:10'),
(7, 'Operator', 1, '2018-07-17 02:19:39', '2018-08-30 04:26:32'),
(8, 'Pion', 1, '2018-08-30 04:27:21', '2018-09-29 23:48:49'),
(9, 'Manager', 2, '2018-09-19 23:54:47', '2018-09-19 23:55:04'),
(10, 'Doctor', NULL, '2019-06-16 01:27:19', '2019-06-16 01:27:19'),
(11, 'Delivery Man', NULL, '2020-01-04 23:30:19', '2020-01-04 23:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary`
--

CREATE TABLE `employee_salary` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `month` tinyint(4) DEFAULT NULL,
  `salary` decimal(15,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_salary`
--

INSERT INTO `employee_salary` (`id`, `employee_id`, `year`, `month`, `salary`, `created_at`, `updated_at`) VALUES
(1, 2, 2019, 1, '22000.00', '2019-01-12 23:18:47', '2019-01-12 23:18:47'),
(2, 3, 2019, 2, '50000.00', '2019-03-24 03:48:38', '2019-03-24 03:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `empty_box_collection`
--

CREATE TABLE `empty_box_collection` (
  `id` int(11) NOT NULL,
  `dispatch_date` date NOT NULL,
  `empty_box_qty` int(3) NOT NULL,
  `submitted_by` int(3) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `empty_box_collection`
--

INSERT INTO `empty_box_collection` (`id`, `dispatch_date`, `empty_box_qty`, `submitted_by`, `status`, `created_at`, `updated_at`) VALUES
(1, '2020-01-01', 5, 1, 2, '2020-01-26 21:38:04', '2020-01-27 05:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `franchises`
--

CREATE TABLE `franchises` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `org_name` varchar(255) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `thana_id` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `business_card` varchar(155) DEFAULT NULL,
  `trade_license` varchar(155) DEFAULT NULL,
  `deed_paper_1` varchar(155) DEFAULT NULL,
  `deed_paper_2` varchar(155) DEFAULT NULL,
  `organization_type` tinyint(4) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1=proposed, 2=approved,3=cancelled',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `franchises`
--

INSERT INTO `franchises` (`id`, `name`, `org_name`, `mobile`, `dob`, `division_id`, `district_id`, `thana_id`, `email`, `address`, `business_card`, `trade_license`, `deed_paper_1`, `deed_paper_2`, `organization_type`, `sex`, `agent_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Alok', NULL, '01751554502', '2019-11-03', 1, 2, 7, 'alok@gmail.com', 'Dhaka,bangladesh', NULL, NULL, NULL, NULL, 1, 1, 1, 1, '2019-11-11 03:37:33', '2019-11-11 03:37:33'),
(4, 'bappi', NULL, '01852123654', '2019-11-14', 1, 2, 6, 'bappi@gmail.com', 'dhaka,bangladesh', NULL, NULL, NULL, NULL, 7, 1, NULL, 1, '2019-11-11 03:52:30', '2019-11-11 03:52:30'),
(5, 'arafath', NULL, '016258741369', '2019-11-28', 1, 2, 7, 'arafath@gmial.com', 'narail,dhaka', NULL, NULL, NULL, NULL, 2, 1, 1, 1, '2019-11-11 03:54:33', '2019-11-11 03:54:33'),
(6, 'Dr Biplob Dev', NULL, '01534235586', '1988-11-11', 1, 1, 1, 'biplob@gmail.com', 'Dhaka, Bangladesh', '', '', NULL, NULL, 1, 1, NULL, 1, '2019-11-11 04:25:54', '2019-11-11 04:25:54'),
(7, 'prolay', 'proloy pharmacy', '017000000', '1992-11-11', 1, 1, 2, 'biplod@gmail.com', 'dhaka, bangladeshq', '', '', NULL, NULL, 2, 1, NULL, 1, '2019-11-11 04:30:32', '2020-01-09 11:26:38'),
(8, 'Cardiology', 'proloy diagnostic center', '017000000', '1995-12-29', 1, 2, 9, 'sfdwerwfdsf@gmial.com', 'sdfasf', '524111119104034.jpg', '333111119104034.jpeg', NULL, NULL, 3, 1, NULL, 1, '2019-11-11 04:40:34', '2020-01-09 11:26:48'),
(9, 'Maruf', NULL, '01410258931', '2019-11-22', 2, 11, 48, 'marful@gmail.com', 'dhaka,bangalsesh', '137111119104227.jpeg', '206111119104227.jpg', NULL, NULL, 7, 1, 1, 1, '2019-11-11 04:42:27', '2019-11-11 04:42:27'),
(10, 'Rabbi', 'Rabbi diagnostic center', '0162134569', '2019-11-22', 1, 2, 7, 'rabbi@gmail.com', 'dhaka,bangladesh', '945111119105118.jpeg', '335111119105118.jpg', NULL, NULL, 1, 1, NULL, 2, '2019-11-11 04:51:18', '2020-01-09 11:28:05'),
(14, 'Cardiology', 'diagnostic center', '017000000', '2019-11-14', 2, 11, 49, 'adminadfaga@probebd.com', 'dhaka,bangladesh', '1111119111157.jpg', '59111119111157.jpeg', NULL, NULL, 1, 2, 1, 2, '2019-11-11 05:11:57', '2020-01-09 11:26:20'),
(15, 'nobab', 'Durbin multicare hospital', '016582123654', '2019-11-13', 1, 2, 6, 'noban@gmial.com', 'khulna,dhaka', '856111119111424.jpeg', '191111119111424.jpeg', NULL, NULL, 1, 2, NULL, 2, '2019-11-11 05:14:24', '2020-01-09 11:25:52'),
(16, 'janata health', 'Janata Health Care', '028802356', '1989-11-11', 1, 1, 2, 'janata@gmail.com', 'DHAKA, bangaldesh', '312111119120323.jpg', '243111119120323.jpeg', NULL, NULL, 2, 1, 10, 2, '2019-11-11 06:03:23', '2020-01-09 11:25:41'),
(17, 'SUMI KUNDU', NULL, '88796765534', '2019-12-10', 1, 2, 3, 'shakilwebit@gmail.com', 'sdfasf', '', '', NULL, NULL, 1, 1, NULL, 1, '2019-12-10 04:13:56', '2019-12-10 04:13:56'),
(18, 'SUMI KUNDU', NULL, '88796765534', '2019-12-10', 1, 2, 3, 'shakilwebit@gmail.com', 'sdfasf', '', '', NULL, NULL, 1, 1, NULL, 1, '2019-12-10 04:14:26', '2019-12-10 04:14:26');

-- --------------------------------------------------------

--
-- Table structure for table `franchise_org`
--

CREATE TABLE `franchise_org` (
  `id` int(11) NOT NULL,
  `franchise_id` int(11) DEFAULT NULL,
  `org_name` varchar(150) DEFAULT NULL,
  `org_address` varchar(255) DEFAULT NULL,
  `speciality` varchar(255) DEFAULT NULL,
  `bed` varchar(255) DEFAULT NULL,
  `daily_indoor_patient` int(11) DEFAULT NULL,
  `daily_outdoor_patient` int(11) DEFAULT NULL,
  `icu` tinyint(4) DEFAULT 0 COMMENT '1=yes,0=no',
  `nicu` tinyint(4) DEFAULT 0 COMMENT '1=yes,0=no',
  `ct_scan` tinyint(4) DEFAULT 0,
  `mri` tinyint(4) DEFAULT 0,
  `usg` tinyint(4) DEFAULT 0,
  `category` varchar(255) DEFAULT NULL,
  `employee` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `franchise_org`
--

INSERT INTO `franchise_org` (`id`, `franchise_id`, `org_name`, `org_address`, `speciality`, `bed`, `daily_indoor_patient`, `daily_outdoor_patient`, `icu`, `nicu`, `ct_scan`, `mri`, `usg`, `category`, `employee`, `status`, `created_at`, `updated_at`) VALUES
(3, 3, 'Alok medial care', 'Janata Housing society', 'nuro', '5', 15, 20, 1, 1, 1, 2, 2, NULL, NULL, NULL, '2019-11-11 03:37:33', '2019-11-11 03:37:33'),
(4, 4, 'bappi medial care', 'Shymoli', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Hospital', '20', NULL, '2019-11-11 03:52:30', '2019-11-11 03:52:30'),
(5, 5, 'arafath medial care', 'Janata Housing society, Mohammedpur', 'adfaga', '10', 50, 3, 1, 2, 1, 1, 1, NULL, NULL, NULL, '2019-11-11 03:54:33', '2019-11-11 03:54:33'),
(6, 6, 'ibn cena hospitals', 'dhaka, bangladesh', 'Cardiology, Surgery', '200', 1500, 200, 1, 1, 1, 2, 2, NULL, NULL, NULL, '2019-11-11 04:25:54', '2019-11-11 04:25:54'),
(7, 7, 'Alok medial care', 'Shymoli', 'nuro', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2019-11-11 04:30:33', '2019-11-11 04:30:33'),
(8, 10, 'rabbi medial care', 'Shymoli', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-11 04:51:18', '2019-11-11 04:51:18'),
(9, 14, 'adsfasf', 'Janata Housing society, Mohammedpur', NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, '2019-11-11 05:11:57', '2019-11-11 05:11:57'),
(10, 15, 'Alok medial care', 'khulna, bangladesh', 'Cardiology, Surgery', '1', 50, 100, 2, 2, 1, 1, 2, NULL, NULL, NULL, '2019-11-11 05:14:24', '2019-11-11 05:14:24'),
(11, 16, 'Janata health care ltd', 'dhaka, bangladesh', 'nurolozy, cardiology', '15', 55, 100, 2, 2, 1, 2, 1, NULL, NULL, NULL, '2019-11-11 06:03:23', '2019-11-11 06:03:23'),
(12, 17, 'Nova Hospitals', 'dhaka, bangladesh', 'Cardiolozy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-10 04:13:56', '2019-12-10 04:13:56'),
(13, 18, 'Nova Hospitals', 'dhaka, bangladesh', 'Cardiolozy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-10 04:14:26', '2019-12-10 04:14:26');

-- --------------------------------------------------------

--
-- Table structure for table `franchise_test`
--

CREATE TABLE `franchise_test` (
  `id` int(11) NOT NULL,
  `franchise_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `fr_price` decimal(15,2) DEFAULT 0.00,
  `pb_price` decimal(15,2) DEFAULT 0.00,
  `status` tinyint(4) DEFAULT 1 COMMENT '1=active,0=inactive',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `franchise_wallet`
--

CREATE TABLE `franchise_wallet` (
  `id` int(11) NOT NULL,
  `total_wallet` decimal(15,2) DEFAULT NULL,
  `franchise_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `franchise_wallet`
--

INSERT INTO `franchise_wallet` (`id`, `total_wallet`, `franchise_id`, `created_at`, `updated_at`) VALUES
(1, '11100.00', 11, '2019-12-08 01:09:22', '2019-12-09 04:28:50'),
(2, '1000.00', 1, '2019-12-10 23:12:14', '2019-12-10 23:12:14'),
(3, '-1400.00', 14, '2020-01-18 03:44:26', '2020-01-18 03:54:28'),
(4, '1400.00', 16, '2020-01-20 04:27:27', '2020-01-20 04:27:27'),
(5, '1400.00', 13, '2020-01-20 04:57:47', '2020-01-20 04:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `healthtips`
--

CREATE TABLE `healthtips` (
  `id` int(11) NOT NULL,
  `photo` varchar(155) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `healthtips`
--

INSERT INTO `healthtips` (`id`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(2, '274281119065902.jpg', 1, '2019-11-27 18:59:02', '2019-11-28 02:29:44'),
(3, '447281119085145.JPG', NULL, '2019-11-27 20:51:45', '2019-11-27 20:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `health_card_sell`
--

CREATE TABLE `health_card_sell` (
  `id` int(11) NOT NULL,
  `org_name` tinyint(3) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `member_name` varchar(120) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `email` varchar(15) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `sex` tinyint(3) DEFAULT NULL,
  `package_type` tinyint(3) DEFAULT NULL,
  `hospital_price` int(3) DEFAULT NULL,
  `yearly_price` varchar(10) DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `health_card_sell`
--

INSERT INTO `health_card_sell` (`id`, `org_name`, `create_by`, `member_name`, `phone`, `address`, `email`, `age`, `sex`, `package_type`, `hospital_price`, `yearly_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 10, 'Alok', '01312547874', 'Dhaka,Bangladesh', 'alok@gmail.com', 43, 1, 1, 2, '1200', 1, '2020-01-25 22:03:39', '2020-01-26 05:29:54'),
(2, 2, NULL, 'Alok', '0170000000', 'Dhaka,Bangladesh', 'admin@gmail.com', 23, 1, NULL, 2, '1200', 1, '2020-02-18 02:48:45', '2020-02-18 02:48:45');

-- --------------------------------------------------------

--
-- Table structure for table `health_package`
--

CREATE TABLE `health_package` (
  `id` int(11) NOT NULL,
  `package_type` int(5) DEFAULT NULL,
  `test_id` varchar(5) DEFAULT NULL,
  `life_insurance` text DEFAULT NULL,
  `health_insurance` text DEFAULT NULL,
  `hospital_price` decimal(15,2) DEFAULT 0.00,
  `yearly_price` decimal(15,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `health_package`
--

INSERT INTO `health_package` (`id`, `package_type`, `test_id`, `life_insurance`, `health_insurance`, `hospital_price`, `yearly_price`, `created_at`, `updated_at`) VALUES
(2, 1, '1,2', '<p><strong>Normal-death-50,000</strong></p>\r\n\r\n<p><strong>Accidental-death-100000</strong></p>\r\n\r\n<p><strong>Disablility-death-50,000</strong></p>', '<p><strong>For 18 crictial test one time 25,000</strong></p>', '10000.00', '1200.00', '2020-01-23 02:53:23', '2020-01-23 02:53:23'),
(3, 1, NULL, NULL, NULL, '2.00', '1200.00', '2020-01-25 22:02:03', '2020-01-25 22:02:03');

-- --------------------------------------------------------

--
-- Table structure for table `health_package_price`
--

CREATE TABLE `health_package_price` (
  `id` int(11) NOT NULL,
  `package_type` tinyint(3) DEFAULT NULL,
  `hospital_price` varchar(11) DEFAULT NULL,
  `yearly_price` varchar(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `health_package_price`
--

INSERT INTO `health_package_price` (`id`, `package_type`, `hospital_price`, `yearly_price`, `created_at`, `updated_at`) VALUES
(1, 2, '10000', '1500', '2020-01-19 03:20:08', '2020-01-22 22:56:05'),
(2, 1, '10000', '1200', '2020-01-21 23:57:09', '2020-01-21 23:57:09'),
(3, 1, '20000', '1450', '2020-01-21 23:57:32', '2020-01-21 23:57:32'),
(4, 3, '10000', '1950', '2020-01-22 00:07:39', '2020-01-22 00:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `health_package_test`
--

CREATE TABLE `health_package_test` (
  `id` int(11) NOT NULL,
  `package_type` tinyint(3) DEFAULT NULL,
  `test_name` varchar(150) DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `health_package_test`
--

INSERT INTO `health_package_test` (`id`, `package_type`, `test_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'ECG', 1, '2020-01-19 03:20:08', '2020-01-19 03:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `medical_department`
--

CREATE TABLE `medical_department` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medical_department`
--

INSERT INTO `medical_department` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Cardiology', '2019-05-08 21:00:15', '2019-05-08 21:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'prolay', 'prolay@gmial.com', 'Laravel', 'This is laravel E-commerce Web site', '2019-11-13 23:03:06', '2019-11-13 23:03:06'),
(3, 'Shakil', 'prolay@gmial.com', 'Laravel', 'UFkjhkjs', '2019-11-14 02:16:18', '2019-11-14 02:16:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `photo`, `description`, `created_at`, `updated_at`) VALUES
(5, 'public/news/MUggN.jpg', '<p><strong>Lorem Ipsum</strong>&nbsp;&nbsp;simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>', '2020-02-02 08:42:03', '2020-02-03 04:07:36'),
(6, 'public/news/Dk6H4.jpg', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>', '2020-02-02 08:44:56', '2020-02-03 04:07:59');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `patiant_id` varchar(11) DEFAULT NULL,
  `order_id` varchar(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `order_status` tinyint(3) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `pay_type` tinyint(3) DEFAULT NULL,
  `order_confirm_by` int(11) DEFAULT NULL,
  `is_home_collection` tinyint(4) DEFAULT NULL,
  `shipping_name` varchar(150) DEFAULT NULL,
  `shipping_phone` varchar(150) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `collection_fees` decimal(15,2) DEFAULT NULL,
  `apt_date` date DEFAULT NULL,
  `apt_from_time` time DEFAULT NULL,
  `apt_to_time` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `patiant_id`, `order_id`, `order_date`, `order_status`, `total`, `pay_type`, `order_confirm_by`, `is_home_collection`, `shipping_name`, `shipping_phone`, `shipping_address`, `collection_fees`, `apt_date`, `apt_from_time`, `apt_to_time`, `created_at`, `updated_at`) VALUES
(15, 'PBP19120013', 'PBO19120015', '2019-12-12', 2, '1350.00', 0, NULL, 0, 'patiant', '01741859623', NULL, '300.00', NULL, NULL, NULL, '2019-12-11 20:42:46', '2019-12-22 06:01:40'),
(16, 'PBP19120013', 'PBO19120016', '2019-12-22', 1, '2300.00', 0, NULL, 0, 'patiant', '01741859623', NULL, '300.00', NULL, NULL, NULL, '2019-12-21 17:19:21', '2019-12-21 17:19:21'),
(17, 'PBP19120013', 'PBO19120017', '2019-12-22', 1, '4600.00', 0, NULL, 0, 'patiant', '01741859623', NULL, '300.00', NULL, NULL, NULL, '2019-12-22 05:50:01', '2019-12-22 05:50:01'),
(19, NULL, 'PBO19120018', '2019-12-23', 1, '4300.00', 0, NULL, 0, 'Bappi', '1751554503', NULL, '300.00', NULL, NULL, NULL, '2019-12-22 17:30:44', '2019-12-22 17:30:44'),
(20, 'PBP19120014', 'PBO19120020', '2019-12-23', 1, '2300.00', 0, NULL, 0, 'demo', '01312123123', 'dhaka', '300.00', NULL, NULL, NULL, '2019-12-22 17:38:39', '2019-12-22 17:38:39'),
(21, 'PBP19120014', 'PBO19120021', '2019-12-23', 1, '1800.00', 0, NULL, 0, 'demo', '01312123123', 'dhaka', '300.00', NULL, NULL, NULL, '2019-12-22 18:12:24', '2019-12-22 18:12:24'),
(22, 'PBP19120001', 'PBO19120022', '2019-12-29', 1, '2350.00', 0, NULL, 0, 'subroto', '0165778980', 'dhaka, bangladesh', '300.00', NULL, NULL, NULL, '2019-12-29 00:07:58', '2019-12-29 00:07:58'),
(23, 'PBP19120001', 'PBO19120023', '2019-12-29', 1, '2350.00', 0, NULL, 0, 'subroto', '0165778980', 'dhaka, bangladesh', '300.00', NULL, NULL, NULL, '2019-12-29 00:07:58', '2019-12-29 00:07:58'),
(24, 'PBP19120001', 'PBO19120024', '2019-12-29', 1, '1350.00', 0, NULL, 0, 'subroto', '0165778980', 'dhaka, bangladesh', '300.00', NULL, NULL, NULL, '2019-12-29 00:11:13', '2019-12-29 00:11:13'),
(25, 'PBP19120001', 'PBO19120025', '2019-12-29', 1, '7200.00', 0, NULL, 0, 'subroto', '0165778980', 'dhaka, bangladesh', '300.00', NULL, NULL, NULL, '2019-12-29 00:11:58', '2019-12-29 00:11:58'),
(26, 'PBP19120001', 'PBO19120026', '2019-12-29', 1, '7200.00', 0, NULL, 0, 'subroto', '0165778980', 'dhaka, bangladesh', '300.00', NULL, NULL, NULL, '2019-12-29 00:11:58', '2019-12-29 00:11:58'),
(27, 'PBP19120001', 'PBO19120027', '2019-12-29', 1, '8050.00', 0, NULL, 0, 'subroto', '0165778980', 'dhaka, bangladesh', '300.00', NULL, NULL, NULL, '2019-12-29 01:14:48', '2019-12-29 01:14:48'),
(28, 'PBP19120003', 'PBO19120028', '2019-12-31', 1, '6000.00', 0, NULL, 0, 'King', '01712121213', 'dhaka, bangladesh', '0.00', NULL, NULL, NULL, '2019-12-31 04:59:48', '2019-12-31 04:59:48');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` varchar(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_type` varchar(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_cost` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `item_id`, `item_type`, `quantity`, `unit_cost`, `total`, `created_at`, `updated_at`) VALUES
(1, 'PBO19120011', 2, 'test', 2, '1150.00', '2300.00', '2019-12-06 19:54:24', '2019-12-12 03:27:52'),
(9, 'PBO19120014', 1, 'package', 1, '1150.00', '1150.00', '2019-12-11 18:11:25', '2019-12-12 03:12:54'),
(10, 'PBO19120015', 1, 'package', 1, '1050.00', '1050.00', '2019-12-11 20:42:46', '2019-12-22 23:46:48'),
(11, 'PBO19120016', 1, 'test', 1, '2000.00', '2000.00', '2019-12-21 17:19:21', '2019-12-21 23:24:29'),
(13, 'PBO19120018', NULL, 'test', 2, '2000.00', '4000.00', '2019-12-22 17:30:44', '2019-12-22 17:30:44'),
(14, 'PBO19120020', 2, 'test', 1, '2000.00', '2000.00', '2019-12-22 17:38:39', '2019-12-22 23:46:33'),
(15, 'PBO19120021', 2, 'test', 1, '1500.00', '1500.00', '2019-12-22 18:12:24', '2019-12-23 00:14:09'),
(16, 'PBO19120023', 1, 'test', 1, '900.00', '2050.00', '2019-12-29 00:07:58', '2019-12-29 00:07:58'),
(17, 'PBO19120023', 2, 'package', 1, '1150.00', '0.00', '2019-12-29 00:07:58', '2019-12-29 00:07:58'),
(18, 'PBO19120024', 1, 'package', 1, '1050.00', '1050.00', '2019-12-29 00:11:13', '2019-12-29 00:11:13'),
(19, 'PBO19120026', 2, 'test', 1, '6000.00', '6900.00', '2019-12-29 00:11:58', '2019-12-29 00:11:58'),
(20, 'PBO19120026', 1, 'test', 1, '900.00', '0.00', '2019-12-29 00:11:58', '2019-12-29 00:11:58'),
(21, 'PBO19120027', 1, 'package', 3, '1050.00', '7750.00', '2019-12-29 01:14:48', '2019-12-29 01:14:48'),
(22, 'PBO19120027', 2, 'package', 4, '1150.00', '0.00', '2019-12-29 01:14:48', '2019-12-29 01:14:48'),
(23, 'PBO19120028', 2, 'test', 1, '6000.00', '6000.00', '2019-12-31 04:59:48', '2019-12-31 04:59:48');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` int(11) NOT NULL,
  `name` varchar(155) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `contact` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `address`, `contact`, `created_at`, `updated_at`) VALUES
(2, 'Uddpion', 'Dhaka,Bangladesh', '01942559895', '2020-01-19 01:22:27', '2020-01-19 01:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `description`, `price`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'Cardiology', '4 basic test.100k taka life insurence coverage.50k accidental coverage.', '1050', 'public/package/6TXdb.png', NULL, NULL),
(2, 'Urology', '4 basic test.100k taka life insurence coverage.50k accidental coverage.', '1150', 'public/package/MHxVw.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `package_bookings`
--

CREATE TABLE `package_bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pathology_test`
--

CREATE TABLE `pathology_test` (
  `id` int(11) NOT NULL,
  `test_name` varchar(255) DEFAULT NULL,
  `short_name` varchar(100) DEFAULT NULL,
  `delivery_day` varchar(50) DEFAULT NULL,
  `specimen` varchar(255) DEFAULT NULL,
  `test_dept_id` int(11) DEFAULT NULL,
  `total_price` decimal(15,2) DEFAULT NULL,
  `fr_price` decimal(15,2) DEFAULT NULL,
  `pr_price` decimal(15,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1=enable,2=disable',
  `is_health_card` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pathology_test`
--

INSERT INTO `pathology_test` (`id`, `test_name`, `short_name`, `delivery_day`, `specimen`, `test_dept_id`, `total_price`, `fr_price`, `pr_price`, `status`, `is_health_card`, `created_at`, `updated_at`) VALUES
(1, 'Complete Blood Count', 'CBC', '1', 'sugar', 1, '900.00', '500.00', '400.00', 1, 1, '2019-12-01 00:31:00', '2020-01-27 07:05:35'),
(2, 'Fast Blood Count', 'FBC', '1', 'BLOOD SUGAR', 1, '6000.00', '5000.00', '1000.00', 1, 1, '2019-12-01 02:51:55', '2020-01-27 07:05:38');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(255) DEFAULT NULL,
  `patient_name` varchar(255) DEFAULT NULL,
  `guardian_name` varchar(255) DEFAULT NULL,
  `guardian_phn` varchar(255) DEFAULT NULL,
  `gender` int(3) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `blood_group` int(3) DEFAULT NULL,
  `register_date` date DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `status` int(3) DEFAULT NULL COMMENT '1 = Hospitalised, 2=Released ',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `patient_id`, `patient_name`, `guardian_name`, `guardian_phn`, `gender`, `phone_no`, `image`, `email`, `address`, `blood_group`, `register_date`, `nationality`, `status`, `created_at`, `updated_at`) VALUES
(2, 'PBP19120001', 'subroto', NULL, '0165778980', 1, '0165778980', NULL, 'subroto@gmail.com', 'dhaka, bangladesh', NULL, NULL, NULL, NULL, '2019-12-29 00:05:54', '2019-12-29 00:05:54'),
(3, 'PBP19120003', 'King', NULL, '01712121214', 1, '01712121213', NULL, 'king@gmail.com', 'dhaka, bangladesh', NULL, NULL, NULL, NULL, '2019-12-31 04:53:45', '2019-12-31 04:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `sample_delivery`
--

CREATE TABLE `sample_delivery` (
  `id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `franchise_id` int(11) NOT NULL,
  `sample_qty` int(11) NOT NULL,
  `sample_status` tinyint(4) NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sample_delivery`
--

INSERT INTO `sample_delivery` (`id`, `delivery_id`, `franchise_id`, `sample_qty`, `sample_status`, `delivery_date`, `created_at`, `updated_at`) VALUES
(1, 19, 10, 3, 2, '2020-01-21', '2020-01-11 01:00:50', '2020-01-21 04:54:47'),
(2, 19, 16, 4, 2, NULL, '2020-01-12 00:04:28', '2020-01-12 10:36:16'),
(19, 19, 16, 2, 1, NULL, '2020-01-12 02:19:48', '2020-01-13 03:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `sample_delivery_master`
--

CREATE TABLE `sample_delivery_master` (
  `id` int(11) NOT NULL,
  `delivery_id` int(11) DEFAULT NULL,
  `franchise_id` int(11) DEFAULT NULL,
  `sample_qty` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sample_delivery_master`
--

INSERT INTO `sample_delivery_master` (`id`, `delivery_id`, `franchise_id`, `sample_qty`, `created_at`, `updated_at`) VALUES
(1, 19, 16, 4, '2020-01-12 07:05:06', '2020-01-12 10:42:32'),
(2, 19, 15, 0, '2020-01-12 02:21:55', '2020-01-12 02:21:55');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'PATHOOGY', 'PROBE Services is a state of the Art Pathology Laboratory and one of the leading networks providing Quality Services:All Diagnostic facilities under one roof.Online reporting facility.24 Hours emergency services for patients', 'public/package/XCOjf.png', NULL, NULL),
(2, 'MICROBIOLOGY', 'PROBE Services is a state of the Art Pathology Laboratory and one of the leading networks providing Quality Services:All Diagnostic facilities under one roof.Online reporting facility.24 Hours emergency services for patients', 'public/package/11wDB.jpg', NULL, NULL),
(4, 'HOME COLLECTION', 'PROBE Services is a state of the Art Pathology Laboratory and one of the leading networks providing Quality Services:All Diagnostic facilities under one roof.Online reporting facility.24 Hours emergency services for patients', 'public/package/9vu94.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(155) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `currency_space` int(11) DEFAULT NULL,
  `currency_position` int(11) DEFAULT NULL,
  `digit_separator` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact` varchar(150) DEFAULT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `dis_agent_com` double NOT NULL,
  `central_agent_com` double NOT NULL,
  `division_agent_com` double NOT NULL,
  `report_delivery_time_limit` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `currency_id`, `currency_space`, `currency_position`, `digit_separator`, `address`, `contact`, `logo`, `dis_agent_com`, `central_agent_com`, `division_agent_com`, `report_delivery_time_limit`, `created_at`, `updated_at`) VALUES
(1, 'PROBE', 2, 1, 0, 'comma', 'Dhaka,Bangladesh', 'Probe-Bangladesh', '653130120104203.png', 5, 15, 10, 3, '2020-01-13 09:00:49', '2020-01-17 05:52:48');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_department`
--

CREATE TABLE `test_department` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1=enable,2=disable',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test_department`
--

INSERT INTO `test_department` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pathology', 1, '2019-11-27 04:19:52', '2019-11-27 04:19:52'),
(2, 'Hematology', 1, '2019-11-27 04:20:16', '2019-11-27 04:20:16'),
(3, 'Neurology', 1, '2019-11-27 04:20:27', '2019-11-27 04:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `thanas`
--

CREATE TABLE `thanas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thanas`
--

INSERT INTO `thanas` (`id`, `name`, `district_id`, `created_at`, `updated_at`) VALUES
(1, 'Abc', 3, '2019-11-12 02:34:00', '2019-11-12 02:34:00'),
(3, 'XYZ', 2, '2019-11-12 02:34:32', '2019-11-12 02:34:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `user_pluck` int(11) DEFAULT NULL,
  `phone_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `user_type`, `user_pluck`, `phone_number`, `present_address`, `permanent_address`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@gmail.com', '2018-12-01 10:44:09', '$2y$10$KD70zDgCtBlPSkhEu0OWCusQClbhu.sGbzvpC0bIqXleyG311zqd6', 'kNpe3Kh2jKhJ0k7He2KDE1s32NiZtaLs5xyZdkJZZA7goT31lVGBDbCAPtSx', NULL, NULL, '0175412563', 'golden street, ring road, shamoly, dhaka', 'golden street, ring road, shamoly, dhaka', '531021218063843.jpg', NULL, '2020-03-03 08:31:25'),
(2, 'Atahar Ali', 'atahar@gmail.com', NULL, '$2y$10$27ONRxFBx.5mmY6N1/kVAOFjH0nax/ZXvbfRTi7tn0CblQ.jHzjga', 'fxiEIOO6w7dcSqRJAx12l2LnXIklK1ZyZBmRopDlgtDIB8HBEFeB29wUsiLw', 3, NULL, '01756000000', 'Dhaka', 'Dhaka Bangladesh', '923070319065027.png', '2019-03-07 00:49:21', '2019-03-09 04:11:04'),
(3, 'Abcd', 'abcd@gmail.com', NULL, '1234567', NULL, 4, NULL, '01758642312', 'Dhaka, Bangladesh', NULL, NULL, '2019-03-07 01:03:59', '2020-01-20 08:57:58'),
(4, 'Dr. Salimullah Akhter', 'salimullah@gmail.com', NULL, '$2y$10$Lu1qNoICZmLoGEoXokLOY.KZmjO13C1LpADqyDHc3KIyp/ckjpQoi', 'pCJvxQAdpcIjJ4l4XHHpszxugU1N5uq3CROND6V7t3d47xLP6j4OlxHWIKHS', 5, NULL, '01756000000', 'Uttara, Dhaka, Bangladesh', NULL, NULL, '2019-05-09 02:02:53', '2019-05-09 02:02:53'),
(8, 'Atahar Sharif', 'p.atahar@gmail.com', NULL, '$2y$10$d50JmwW6m.NPCGerqSJwBuq5/2jIkW02rCMrP.3.vE3T7amHuctWi', NULL, 6, NULL, '01756000000', 'Dhaka', NULL, NULL, '2019-06-01 00:01:02', '2019-06-01 00:01:02'),
(9, 'Anisul Haque', 'anisul@gmail.com', NULL, '$2y$10$emLi02V2K1Q1w54Gz45DbeJT8utvhwiwZhkpah.F.XRyMFoeB/2V6', NULL, 5, NULL, '01756000012', 'Dhaka, Bangladesh', 'Dhaka, Bangladesh', NULL, '2019-06-17 00:26:51', '2019-06-17 00:26:51'),
(10, 'prolay', 'prolay@gmial.com', NULL, '$2y$10$6ej7nxsQLJmOj.J1Xn5ts.N8Sc.D2ut/tikN3CI0zGYbmRHZKVDbe', '9dH9geNlOojllPceqUeXPdTPdJFqDUNxF0RhCzUkk5LRz96wqFSwRXQmykbQ', 7, NULL, '0171000000', 'Dhaka', 'Dhaka', NULL, '2019-11-07 04:19:29', '2020-01-25 06:30:33'),
(11, 'janata health', 'janata@gmail.com', NULL, '$2y$12$H4irS24pG.DH.IlehVWdneCYgVRG/5dj5EXj84xlnk0eUgwMj.oDq', '7wsGeWQXBRtYAtv6m20GaoAwbHI6ME8u7KIcC1Tr5PG8hpcQwoAGJGzm54Yj', 8, 16, '028802356', 'DHAKA, bangaldesh', NULL, NULL, '2019-12-07 03:14:17', '2020-03-05 05:19:05'),
(12, 'janata health', 'janata@gmail.com', NULL, '$2y$10$Y1kQjMZ33Sa80z8nr9rWsO.2vK/jH8YdLBM4mQe3cKRwK1T6FIJzG', NULL, 8, NULL, '028802356', 'DHAKA, bangaldesh', NULL, NULL, '2019-12-07 03:14:45', '2019-12-07 03:14:45'),
(13, 'nobab', 'noban@gmial.com', NULL, '$2y$10$zhXBeWygdzPgfb.r4JdzPOoSPUwB8pJOG2BFPQnWW4NT.7bhTa2WK', NULL, 8, 15, '016582123654', 'khulna,dhaka', NULL, NULL, '2019-12-07 05:29:55', '2020-01-09 07:11:33'),
(14, 'janata health', 'janata@gmail.com', NULL, '$2y$12$H4irS24pG.DH.IlehVWdneCYgVRG/5dj5EXj84xlnk0eUgwMj.oDq', NULL, 8, NULL, '028802356', 'DHAKA, bangaldesh', NULL, NULL, '2019-12-09 03:04:24', '2020-03-05 05:18:39'),
(15, 'Cardiology', 'adminadfaga@probebd.com', NULL, '$2y$10$X8omwJrZHLUc7Ok77WB6beRE5a1/EMNgAruroptHrFv/Qz8XJH4Zu', NULL, 8, 8, '017000000', 'dhaka,bangladesh', NULL, NULL, '2019-12-09 03:08:48', '2020-01-09 07:10:16'),
(16, 'Rabbi', 'rabbi@gmail.com', NULL, '$2y$12$IWICcb4HJF8ZPlhOZdiKFutUIOufcBU2r.H3qQ5yg1f53qyTuFynu', 'LImOhJu1XLRGszLRhDxDyj239ziD2HfiYOoWRIP88uxZaEJWlJmOUgdxv576', 8, 10, '0162134569', 'dhaka,bangladesh', NULL, NULL, '2019-12-10 05:17:23', '2020-01-20 10:15:18'),
(17, 'subroto', 'subroto@gmail.com', NULL, '$2y$10$tfTyiIXfIH.LQRl3dp7XPOirw5Tbiy/qJzK3AX9IPrJEwqy57jeSa', NULL, 6, NULL, '0165778980', 'dhaka, bangladesh', NULL, NULL, '2019-12-29 00:05:55', '2019-12-29 00:05:55'),
(18, 'King', 'king@gmail.com', NULL, '$2y$10$IxbJ.86QmOqx8untEnmJ1uYWlR4xwPAOwjujtqFM83eNgjWIlDaca', 'fWBUq4BQTROYHWX7SVCxllM64qpw9L2uuFGt3HhHblfhWIsoImPwS42EPh5s', 6, NULL, '01712121213', 'dhaka, bangladesh', NULL, NULL, '2019-12-31 04:53:45', '2019-12-31 11:17:20'),
(19, 'Delivery Man 1', 'delivery1@gmail.com', NULL, '$2y$10$Rvxg3UEjpPtZ20f9KQOfpeQ6zz7fLjP.ZZdssiJCsHkzc5I88D34m', 'cWMvq63htam2AsgHtqB5s9Mpu6is1flYvyzGISgwpAeKdYewLLrdnl6jHxBS', 9, NULL, '+880156786950', 'gazipur', NULL, '', '2020-01-04 23:42:40', '2020-02-09 05:46:28'),
(20, 'prolay111', 'admin@gmailcom', NULL, '$2y$10$aMn9cPPzPK1SAzEiTwpWLu9IdpVXHt1mnPWkk1JWwFUzbuDNvo0LC', 'kQwU9DHcAUS7bx7gjfOfzWZUWQ1AuMmdhhg9bzjEKBMNgzEEkuVegkNWu4fo', 6, NULL, '0171001245', 'Dhaka,Bangladesh', NULL, NULL, '2020-01-17 00:29:06', '2020-01-17 06:31:27'),
(21, 'asfdasfa', 'admin@gmailcodsfsfm', NULL, '$2y$10$P.Tk4KGLqHjC1ckKLrN9ouByc9aekLGeZ07TNpeAVmqtdLwlE0rLS', '7uhKnrghby5LeOOCKtonSzbs8fjKKKQfKHffRTdhOmITUGvCAWy7uEpt1vu5', 6, NULL, '576546456456', 'asdfasfsaf', NULL, NULL, '2020-01-17 23:24:53', '2020-01-18 05:25:04'),
(22, 'Alu', 'alu@gmail.com', NULL, '$2y$10$G0oNmLpOSmXQY45Vz.WdM.GQqS2vo36r.G91zPvx71bGs4UgyeRcS', 'Mpk8k0CQwshVHsCOsDPyNECz2uIeqz4JorxEI08t3PZ2yHfGWnqMzIL2sWX1', 6, NULL, '01414414152', 'Dhaka,Bangladesh', NULL, NULL, '2020-01-18 03:35:34', '2020-01-18 09:42:56'),
(24, 'Shymoli', 'shymoli@gmail.com', NULL, '$2y$10$RHaukzpNQRhL8JHWXwIi2.WJKWd6DVzJAuqcvnU0dizx4o38SF7wy', '9ZrVGkGR5dw1077BiftxCD4mm3xBKtRI9leytzIxen4eA6BDvOUoNgNUdDYK', 10, 3, NULL, NULL, NULL, NULL, '2020-01-19 23:59:10', '2020-02-09 05:52:23'),
(25, 'demo1`', 'demo11@gmail.com', NULL, '$2y$10$pMHb.w6BLH930T7yZOxfq.goLJH.3s/JUpDxIU4ahy6aO8kYuhKRO', 'acK2vYTmVcrtX31ubXc3NnCwgzkiwdMySc4MoMZwshnRvj11gfNJSx23w3xN', 6, NULL, '0171011010', 'Dhaka,Bangladesh', NULL, NULL, '2020-01-20 22:03:15', '2020-01-21 04:03:22'),
(26, 'Hanif', 'hanif@gmail.com', NULL, '$2y$10$ct0LHw2Sk80NZqrjjLkIreSyAzHAD.xHM61VJ/9Xo.mqylj6JNOw2', NULL, 10, 4, NULL, NULL, NULL, NULL, '2020-01-21 03:08:07', '2020-01-21 03:08:07'),
(27, 'Shundorbon', 'shundorbon@gmail.com', NULL, '$2y$10$5qZm1WWi0.R0ZWfzrpEeDO6FhPolMzrIk9HE81fXoaCML8bEmKWBi', NULL, 10, 5, NULL, NULL, NULL, NULL, '2020-01-21 03:09:30', '2020-01-21 03:09:30');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `user_type`, `user_role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, '2018-11-13 01:59:56', '2018-11-13 01:59:56'),
(2, 'Manager', NULL, '2018-11-13 02:00:10', '2018-11-13 02:10:01'),
(3, 'Accountant', NULL, '2018-11-13 02:32:21', '2019-03-12 04:41:52'),
(4, 'Employee', NULL, '2018-11-13 02:32:30', '2018-11-13 02:32:30'),
(5, 'Pathology Doctor', NULL, '2019-05-08 03:20:20', '2020-01-26 01:28:34'),
(6, 'Patient', NULL, '2019-05-19 00:32:06', '2019-05-19 00:32:06'),
(7, 'Agents', '{\"EmployeeController\":{\"controller_name\":\"EmployeeController\",\"view\":\"1\",\"delete\":\"1\"},\"AgentFranchiseController\":{\"controller_name\":\"AgentFranchiseController\",\"view\":\"1\",\"add_edit\":\"1\",\"delete\":\"1\"}}', '2019-11-01 09:55:14', '2019-11-11 06:05:27'),
(8, 'Franchise', '{\"DiagnosticController\":{\"controller_name\":\"DiagnosticController\",\"view\":\"1\",\"add_edit\":\"1\",\"delete\":\"1\"},\"DiagnosticPatientDuePayController\":{\"controller_name\":\"DiagnosticPatientDuePayController\",\"view\":\"1\",\"add_edit\":\"1\",\"delete\":\"1\"},\"DiagnosticTestStatusCheckController\":{\"controller_name\":\"DiagnosticTestStatusCheckController\",\"view\":\"1\",\"add_edit\":\"1\",\"delete\":\"1\"},\"DoctorController\":{\"controller_name\":\"DoctorController\",\"view\":\"1\",\"add_edit\":\"1\"},\"EmployeeController\":{\"controller_name\":\"EmployeeController\",\"view\":\"1\"},\"FranchiseDepositController\":{\"controller_name\":\"FranchiseDepositController\",\"view\":\"1\",\"add_edit\":\"1\",\"delete\":\"1\"},\"AgentFranchiseController\":{\"controller_name\":\"AgentFranchiseController\",\"view\":\"1\"}}', '2019-12-07 01:20:58', '2019-12-09 04:15:26'),
(9, 'Delivery Man', '{\"CourierSampleCollectionController\":{\"controller_name\":\"CourierSampleCollectionController\",\"view\":\"1\",\"add_edit\":\"1\"},\"DiagnosticController\":{\"controller_name\":\"DiagnosticController\",\"view\":\"1\",\"add_edit\":\"1\"},\"LogisticController\":{\"controller_name\":\"LogisticController\",\"view\":\"1\",\"add_edit\":\"1\"},\"SampleCollectionController\":{\"controller_name\":\"SampleCollectionController\",\"view\":\"1\",\"add_edit\":\"1\"}}', '2019-12-30 03:45:03', '2020-01-26 01:51:13'),
(10, 'Counter or courier', '{\"AreaController\":{\"controller_name\":\"AreaController\",\"view\":\"1\",\"add_edit\":\"1\",\"delete\":\"1\"},\"CourierSampleCollectionController\":{\"controller_name\":\"CourierSampleCollectionController\",\"view\":\"1\",\"add_edit\":\"1\",\"delete\":\"1\"}}', '2020-01-26 01:11:29', '2020-01-26 01:11:29');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_history`
--

CREATE TABLE `wallet_history` (
  `id` int(11) NOT NULL,
  `franchise_id` int(11) DEFAULT NULL,
  `deposit_amount` decimal(15,2) DEFAULT NULL,
  `deposit_purpose` varchar(255) DEFAULT NULL,
  `deposit_type` tinyint(4) DEFAULT NULL COMMENT '1=cash,2=bank,3=card',
  `date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1=deposit,2=redemption',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wallet_history`
--

INSERT INTO `wallet_history` (`id`, `franchise_id`, `deposit_amount`, `deposit_purpose`, `deposit_type`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 11, '5500.00', 'Pathology Test', 4, '2019-12-08', NULL, '2019-12-08 01:09:23', '2019-12-08 01:09:23'),
(2, 11, '5000.00', 'Pathology Test', 4, '2019-12-09', NULL, '2019-12-09 03:11:06', '2019-12-09 03:11:06'),
(3, 11, '400.00', 'Complete Blood Count', 4, '2019-12-09', 2, '2019-12-09 03:54:08', '2019-12-09 03:54:08'),
(5, 11, '1000.00', 'General', 1, '2019-12-09', 1, '2019-12-09 04:23:39', '2019-12-09 04:23:39'),
(6, 11, '1000.00', 'Fast Blood Count', 4, '2019-12-09', 2, '2019-12-09 04:28:50', '2019-12-09 04:28:50'),
(7, 1, '1000.00', 'General', 1, '2019-12-11', 1, '2019-12-10 23:12:14', '2019-12-10 23:12:14'),
(8, 14, '400.00', 'Complete Blood Count', 4, '2020-01-18', 2, '2020-01-18 03:43:38', '2020-01-18 03:43:38'),
(9, 14, '1000.00', 'Fast Blood Count', 4, '2020-01-18', 2, '2020-01-18 03:43:38', '2020-01-18 03:43:38'),
(10, 14, '400.00', 'Complete Blood Count', 4, '2020-01-18', 2, '2020-01-18 03:44:26', '2020-01-18 03:44:26'),
(11, 14, '1000.00', 'Fast Blood Count', 4, '2020-01-18', 2, '2020-01-18 03:44:26', '2020-01-18 03:44:26'),
(12, 14, '400.00', 'Complete Blood Count', 4, '2020-01-18', 2, '2020-01-18 03:46:07', '2020-01-18 03:46:07'),
(13, 14, '1000.00', 'Fast Blood Count', 4, '2020-01-18', 2, '2020-01-18 03:46:07', '2020-01-18 03:46:07'),
(14, 14, '400.00', 'Complete Blood Count', 4, '2020-01-18', 2, '2020-01-18 03:54:28', '2020-01-18 03:54:28'),
(15, 14, '1000.00', 'Fast Blood Count', 4, '2020-01-18', 2, '2020-01-18 03:54:28', '2020-01-18 03:54:28'),
(16, 16, '400.00', 'Complete Blood Count', 4, '2020-01-20', 2, '2020-01-20 04:27:27', '2020-01-20 04:27:27'),
(17, 16, '1000.00', 'Fast Blood Count', 4, '2020-01-20', 2, '2020-01-20 04:27:27', '2020-01-20 04:27:27'),
(18, 13, '400.00', 'Complete Blood Count', 4, '2020-01-20', 2, '2020-01-20 04:57:47', '2020-01-20 04:57:47'),
(19, 13, '1000.00', 'Fast Blood Count', 4, '2020-01-20', 2, '2020-01-20 04:57:47', '2020-01-20 04:57:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_payment`
--
ALTER TABLE `admission_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `affiliates`
--
ALTER TABLE `affiliates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_commision`
--
ALTER TABLE `agent_commision`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_wallet`
--
ALTER TABLE `agent_wallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agent_id` (`agent_id`);

--
-- Indexes for table `appointment_booking`
--
ALTER TABLE `appointment_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment_booking_patient`
--
ALTER TABLE `appointment_booking_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_group`
--
ALTER TABLE `blood_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission_rate`
--
ALTER TABLE `commission_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courier_sample_collection`
--
ALTER TABLE `courier_sample_collection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courier_id` (`courier_id`),
  ADD KEY `destination_place` (`destination_place`),
  ADD KEY `arriving_place` (`arriving_place`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_man_assign`
--
ALTER TABLE `delivery_man_assign`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_man_id` (`delivery_man_id`),
  ADD KEY `agent_id` (`agent_id`),
  ADD KEY `franchise_id` (`franchise_id`);

--
-- Indexes for table `diagnostic_patient`
--
ALTER TABLE `diagnostic_patient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refd_by` (`refd_by`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `diagnostic_patient_test`
--
ALTER TABLE `diagnostic_patient_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `diagnostic_id` (`diagnostic_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_division_id_foreign` (`division_id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_appointments`
--
ALTER TABLE `doctor_appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_designation`
--
ALTER TABLE `employee_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_salary`
--
ALTER TABLE `employee_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empty_box_collection`
--
ALTER TABLE `empty_box_collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `franchises`
--
ALTER TABLE `franchises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `franchise_org`
--
ALTER TABLE `franchise_org`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `franchise_test`
--
ALTER TABLE `franchise_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `franchise_id` (`franchise_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `franchise_wallet`
--
ALTER TABLE `franchise_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_card_sell`
--
ALTER TABLE `health_card_sell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_package`
--
ALTER TABLE `health_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_package_price`
--
ALTER TABLE `health_package_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_package_test`
--
ALTER TABLE `health_package_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_department`
--
ALTER TABLE `medical_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD KEY `id` (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_bookings`
--
ALTER TABLE `package_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pathology_test`
--
ALTER TABLE `pathology_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sample_delivery`
--
ALTER TABLE `sample_delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sample_delivery_master`
--
ALTER TABLE `sample_delivery_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_department`
--
ALTER TABLE `test_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thanas`
--
ALTER TABLE `thanas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_history`
--
ALTER TABLE `wallet_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admission_payment`
--
ALTER TABLE `admission_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `affiliates`
--
ALTER TABLE `affiliates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agent_commision`
--
ALTER TABLE `agent_commision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agent_wallet`
--
ALTER TABLE `agent_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment_booking`
--
ALTER TABLE `appointment_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `appointment_booking_patient`
--
ALTER TABLE `appointment_booking_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_group`
--
ALTER TABLE `blood_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `commission_rate`
--
ALTER TABLE `commission_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courier_sample_collection`
--
ALTER TABLE `courier_sample_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `delivery_man_assign`
--
ALTER TABLE `delivery_man_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `diagnostic_patient`
--
ALTER TABLE `diagnostic_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `diagnostic_patient_test`
--
ALTER TABLE `diagnostic_patient_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor_appointments`
--
ALTER TABLE `doctor_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employee_designation`
--
ALTER TABLE `employee_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `employee_salary`
--
ALTER TABLE `employee_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `empty_box_collection`
--
ALTER TABLE `empty_box_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `franchises`
--
ALTER TABLE `franchises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `franchise_org`
--
ALTER TABLE `franchise_org`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `franchise_test`
--
ALTER TABLE `franchise_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `franchise_wallet`
--
ALTER TABLE `franchise_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `health_card_sell`
--
ALTER TABLE `health_card_sell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `health_package`
--
ALTER TABLE `health_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `health_package_price`
--
ALTER TABLE `health_package_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `health_package_test`
--
ALTER TABLE `health_package_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medical_department`
--
ALTER TABLE `medical_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `package_bookings`
--
ALTER TABLE `package_bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pathology_test`
--
ALTER TABLE `pathology_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sample_delivery`
--
ALTER TABLE `sample_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sample_delivery_master`
--
ALTER TABLE `sample_delivery_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_department`
--
ALTER TABLE `test_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `thanas`
--
ALTER TABLE `thanas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wallet_history`
--
ALTER TABLE `wallet_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
