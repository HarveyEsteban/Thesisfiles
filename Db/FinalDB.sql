-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2024 at 06:26 PM
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
-- Database: `patientsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookinglog`
--

CREATE TABLE `bookinglog` (
  `resID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `serviceName` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `timeslot` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `admin_remarks` varchar(255) NOT NULL DEFAULT 'None',
  `walk_in_name` varchar(255) NOT NULL DEFAULT 'None',
  `status` varchar(255) NOT NULL,
  `FamMemberName` varchar(255) NOT NULL DEFAULT 'N/A',
  `confirmationHash` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `totalServicePay` int(11) NOT NULL,
  `isScanned` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookinglog`
--

INSERT INTO `bookinglog` (`resID`, `userID`, `serviceName`, `date`, `timeslot`, `remarks`, `admin_remarks`, `walk_in_name`, `status`, `FamMemberName`, `confirmationHash`, `timestamp`, `totalServicePay`, `isScanned`) VALUES
(194, 4, 'Dental Braces ', '2024-01-22', '01:00 PM - 02:00 PM', '', 'None', 'None', 'Cancel', 'None', '', '2024-01-22 15:40:24', 0, 1),
(195, 4, 'Dental Braces ', '2024-01-22', '09:00 AM - 10:00 AM', '', 'None', 'None', 'Cancel', 'None', '', '2024-01-22 15:40:24', 0, 1),
(196, 4, 'Dental Braces ', '2024-01-23', '11:00 AM - 12:00 PM', '', 'None', 'None', 'Cancel', 'None', '', '2024-01-22 16:32:57', 0, 1),
(197, 4, 'Dental Braces ', '2024-01-22', '03:00 PM - 04:00 PM', '', 'None', 'None', 'Cancel', 'None', '', '2024-01-22 15:40:24', 0, 0),
(198, 4, 'Dental Braces ', '2024-01-22', '04:00 PM - 05:00 PM', '', 'None', 'None', 'Cancel', 'None', '', '2024-01-22 15:40:24', 0, 0),
(199, 4, 'Dentures (Pustiso) ', '2024-01-22', '02:00 PM - 03:00 PM', '', 'None', 'None', 'Done', 'None', '', '2024-01-22 15:53:55', 3000, 1),
(200, 4, 'Dentures (Pustiso) ', '2024-01-22', '10:00 AM - 11:00 AM', '', 'None', 'None', 'Cancel', 'None', '', '2024-01-22 15:40:24', 0, 1),
(202, 1, 'retainer ', '2024-01-17', '11:00 AM - 12:00 PM', '', 'None', 'None', 'Pending', 'None', '', '2024-01-16 17:22:25', 0, 0),
(203, 39, 'retainer ', '2024-01-17', '02:00 PM - 03:00 PM', '', 'None', 'None', 'Pending', 'None', '', '2024-01-16 17:22:31', 0, 0),
(204, 2, 'retainer ', '2024-01-17', '04:00 PM - 05:00 PM', 'No material available', 'None', 'None', 'Cancel', 'None', '', '2024-01-17 02:03:20', 0, 0),
(205, 33, 'Dental Braces ', '2024-01-12', '01:00 PM - 02:00 PM', 'Done Reservation', 'None', 'Juan Dela Cruz', 'Done', 'None', '', '2024-01-17 02:04:14', 5000, 0),
(206, 4, 'Root Canal Treatment ', '2024-01-13', '09:00 AM - 10:00 AM', 'Done Reservation', 'None', 'None', 'Done', 'None', '', '2024-01-17 02:04:26', 6500, 0),
(207, 4, 'Teeth Whitening ', '2024-01-13', '03:00 PM - 04:00 PM', 'Did not show', 'None', 'None', 'Cancel', 'None', '', '2024-01-17 02:05:18', 0, 0),
(208, 4, 'Teeth Whitening ', '2024-01-15', '04:00 PM - 05:00 PM', 'Doc not available', 'None', 'None', 'Cancel', 'None', '', '2024-01-17 02:05:31', 0, 0),
(209, 33, 'Dentures (Pustiso) ', '2024-01-15', '11:00 AM - 12:00 PM', 'Done Reservation', 'None', 'Carlos Nunez', 'Done', 'None', '', '2024-01-17 02:04:36', 3000, 0),
(210, 4, 'Tooth Restoration (Pasta) ', '2024-01-16', '10:00 AM - 11:00 AM', 'Cant proceed due to sore gums', 'None', 'None', 'Cancel', 'None', '', '2024-01-17 02:05:42', 0, 0),
(211, 33, 'Tooth Restoration (Pasta) ', '1900-01-14', '02:00 PM - 03:00 PM', 'Done Reservation', 'None', 'Ian Piolo Pascual', 'Done', 'None', '', '2024-01-17 02:04:40', 1200, 0),
(212, 1, 'Teeth Whitening', '2024-01-25', '10:00 AM - 11:00 AM', '', 'None', 'None', 'Cancel', 'None', '', '2024-01-22 14:51:31', 0, 0),
(213, 1, 'Oral Prophylaxis', '2024-01-23', '09:00 AM - 10:00 AM', '', 'None', 'None', 'Pending', 'None', '', '2024-01-17 06:06:19', 0, 0),
(214, 1, 'Oral Prophylaxis', '2024-01-20', '09:00 AM - 10:00 AM', '', 'None', 'None', 'Done', 'Father', '', '2024-01-20 06:49:35', 1300, 0),
(215, 1, 'Oral Prophylaxis ', '2024-01-20', '10:00 AM - 11:00 AM', '', 'None', 'None', 'Pending', 'None', '', '2024-01-17 06:14:07', 0, 0),
(216, 1, 'Oral Prophylaxis ', '2024-01-19', '11:00 AM - 12:00 PM', '', 'None', 'None', 'Pending', 'None', '', '2024-01-19 12:44:07', 0, 1),
(217, 39, 'Dentures (Pustiso) ', '2024-01-19', '09:00 AM - 10:00 AM', '', 'None', 'None', 'Pending', 'None', '', '2024-01-19 12:40:23', 0, 0),
(218, 1, 'retainer ', '2024-01-26', '10:00 AM - 11:00 AM', '', 'None', 'None', 'Pending', 'None', '', '2024-01-22 10:08:41', 0, 0),
(219, 1, 'Dentures (Pustiso) ', '2024-01-25', '04:00 PM - 05:00 PM', '', 'None', 'None', 'Pending', 'None', '', '2024-01-22 14:59:24', 0, 0),
(220, 1, 'Dental Braces ', '2024-01-28', '10:00 AM - 11:00 AM', '', 'None', 'None', 'Pending', 'None', '', '2024-01-24 10:14:58', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `Chatidpk` int(11) NOT NULL,
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`Chatidpk`, `chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `timestamp`, `status`) VALUES
(89, 0, 1, 3, 'Hello', '2024-01-11 16:09:48', 0),
(90, 0, 3, 1, 'Hello', '2024-01-11 16:10:21', 0),
(91, 0, 3, 3, 'hello\n', '2024-01-12 03:23:57', 0),
(92, 0, 1, 3, 'Good eve', '2024-01-16 14:23:58', 0),
(93, 0, 3, 39, 'Hello', '2024-01-16 14:25:00', 0),
(94, 0, 3, 39, 'May i ask if i could, select multiple services', '2024-01-16 14:25:26', 0),
(95, 0, 39, 3, 'Of course you could, what services would you like to aquire so that i can reserve it for you', '2024-01-16 14:25:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `confirmation_data`
--

CREATE TABLE `confirmation_data` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hash_code` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `expiration_timestamp` timestamp NULL DEFAULT NULL,
  `confirmed` tinyint(1) DEFAULT 0,
  `resID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `confirmation_data`
--

INSERT INTO `confirmation_data` (`id`, `email`, `hash_code`, `timestamp`, `expiration_timestamp`, `confirmed`, `resID`) VALUES
(21, 'harveybucod21@gmail.com', '3e2f49b14394926b9d5b33c5e672bf2457f8126cf310c9fa1fd3ce044a613806', '2023-12-03 17:09:51', '2023-12-04 17:09:51', 0, 0),
(22, 'Sample@gmail.com', '8551509ad75f752df6b1ba8d652a2aa875a6a30cb7b86542c07b2fdb1698ff4c', '2023-12-03 17:09:53', '2023-12-04 17:09:53', 0, 0),
(23, 'harveybucod21@gmail.com', 'aecd1d39c461eaf1e15ce2d8461705f9152939992a884df6bf6a41c6cab263e4', '2023-12-03 17:10:47', '2023-12-04 17:10:47', 1, 0),
(24, 'Sample@gmail.com', 'd7ae1c8da4c3228ac4671a160bdd204c563303401bfafcd7e4160b7b6c3ca142', '2023-12-03 17:10:50', '2023-12-04 17:10:50', 0, 0),
(25, 'harveybucod21@gmail.com', 'fe69107d28b7c5260da40500c7fe55c8b2fe89192c710c0260ddf6fefb380bbf', '2023-12-03 17:22:08', '2023-12-04 17:22:08', 1, 0),
(26, 'Sample@gmail.com', '1d4446081c3d89b3ed8c3a4dad6461b753999b8e96637f1bf05602d25e9198f7', '2023-12-03 17:22:10', '2023-12-04 17:22:10', 0, 0),
(27, 'harveybucod21@gmail.com', 'a36bccc904957d78b33640852af67ea452fc58ded2a1600154fea84b9cf620c8', '2023-12-03 17:38:59', '2023-12-04 17:38:59', 0, 0),
(28, 'Sample@gmail.com', '2811c83f184849c0e3561c0c49830ef58814faee960dea4f282ce45cbd734273', '2023-12-03 17:39:01', '2023-12-04 17:39:01', 0, 0),
(29, 'harveybucod21@gmail.com', 'f18088b473369c92a2330de86188708644eaec1f649597f7ebdd068013403a04', '2023-12-03 17:48:45', '2023-12-04 17:48:45', 0, 0),
(30, 'harveybucod21@gmail.com', '9fa82ea6847e972108640588ae0f4fb5cf33d328456eca50e163bcf354a50ccc', '2023-12-04 16:00:01', '2023-12-05 16:00:01', 1, 0),
(31, 'harveybucod21@gmail.com', 'df3df203f658f54ccff96ea7a8ad5296dca15434fa8dc6f14d35367525571966', '2023-12-04 21:00:02', '2023-12-05 21:00:02', 0, 0),
(32, 'harveybucod21@gmail.com', '6643578f156a9a9c78901f9c7c71ae5b6f5e1de0bf5db8dbb13c3b674757d704', '2023-12-05 16:00:02', '2023-12-06 16:00:02', 0, 0),
(33, 'harveybucod21@gmail.com', '313a8fe328a76c4d3c6c3a3151655c98e9ec5820be026435f6e098b47aff9ff5', '2023-12-05 17:51:29', '2023-12-06 17:51:29', 0, 0),
(34, 'harveybucod21@gmail.com', '21903f0e57eba10b9414639c247f413e9834b103a837804f59b67c3f26b56b03', '2023-12-05 18:57:41', '2023-12-06 18:57:41', 0, 0),
(35, 'Sample@gmail.com', 'f633660e3b8f7ffe73716d1f21c04e499331f84b95d5f5754a2bc78e342883a9', '2023-12-05 19:39:10', '2023-12-06 19:39:10', 0, 0),
(36, 'Sample@gmail.com', 'cf32a2041ab13db9f4e03297a10a649de812413c98ebded62b8f22bcd62ec3fa', '2023-12-06 18:13:42', '2023-12-07 18:13:42', 0, 0),
(37, 'Sample@gmail.com', 'b1fc2bd488f2dc9ea28ed993de65c0ac5a762a476c03e428b8c4825d16cf1081', '2023-12-09 16:00:01', '2023-12-10 16:00:01', 0, 0),
(38, 'Sample@gmail.com', '92a742ad8eab617040b1929213d09f22e2b6563c226912768ead94ab72ccef30', '2023-12-09 17:36:40', '2023-12-09 17:37:40', 0, 0),
(40, 'Sample@gmail.com', 'f4b96267e5ce5fbb96ada0b424aae176206fa98e80a6d848705e0873d8def86a', '2023-12-09 17:43:19', '2023-12-09 17:44:19', 0, 0),
(42, 'mobs.dominiquemartinez@gmail.com', '026d3302c20697fdba3e9c3af298a7ff95caf01ea28de9d5d290a399a09a09dd', '2023-12-09 17:50:05', '2023-12-09 17:51:05', 0, 0),
(43, 'mobs.dominiquemartinez@gmail.com', 'ebd6859439916b3a0e10494f2cb1369844f19bed6e7c54acc3c079b2cf3a05e4', '2023-12-09 18:05:22', '2023-12-09 18:06:22', 0, 0),
(45, 'mobs.dominiquemartinez@gmail.com', '5523eeb6a642cfd6239696d92d581c3dea7a21b3367b6b73ea64f7da947bec78', '2023-12-09 18:07:25', '2023-12-09 18:08:25', 0, 0),
(46, 'harveybucod21@gmail.com', 'ac228da0c6b2deeda177a7cc6933d9c96824007c8dc89966793538e09f870b54', '2023-12-09 18:07:28', '2023-12-09 18:08:28', 0, 0),
(47, 'mobs.dominiquemartinez@gmail.com', '7efabe2d8957bd79e2a82f8991880b2ff593f9c4883fe98fca078b8805523194', '2023-12-10 02:32:57', '2023-12-10 02:33:57', 0, 0),
(48, 'harveybucod21@gmail.com', '59a64f4c121fd4e5f3917d232086b65146fe1e5466bc5eac98761a0192c2f967', '2023-12-10 02:33:00', '2023-12-10 02:34:00', 0, 0),
(49, 'harveybucod21@gmail.com', '2e7ffb8513532f4c8dc82748eec4fda0b2b2deeb57e2001a9f0a6e1ceb02df61', '2023-12-10 07:12:33', '2023-12-10 07:13:33', 1, 0),
(50, 'shakrambrook19@gmail.com', '8049a9fbd81e751e4519683a59abfeec9e1bdad1d5c775125b2f619a8a020c78', '2024-01-28 07:04:50', '2024-01-28 07:05:50', 0, 0),
(51, 'harveybucod21@gmail.com', '0748e56b925e761e2a858cee9ea28424eee4090609b3ff0a3df66e687d0f6357', '2024-01-25 10:22:47', '2024-01-25 10:23:47', 0, 0),
(52, 'harveybucod21@gmail.com', '73be133adafe6ef89aca0521424725848adbc85a90073491b13f362d0e2a2088', '2024-01-25 10:27:46', '2024-01-25 10:28:46', 0, 0),
(53, 'harveybucod21@gmail.com', '9bc6768c8b038c7c60b3c7590882a0ffdc5a635ac58c5d972468b373daf748f0', '2024-01-25 10:28:00', '2024-01-25 10:29:00', 0, 0),
(55, 'harveybucod21@gmail.com', '92d7239ce4c69332322aadaf69568e6f510e4ce485a497f2eb2845044040be47', '2024-01-22 14:35:54', '2024-01-21 14:35:54', 0, 212),
(56, 'harveybucod21@gmail.com', '419a276700c0926747d7befafbcd29991be26f0b0665214b0291e87d3629ef08', '2024-01-22 15:02:09', '2024-01-23 15:02:09', 0, 212),
(57, 'harveybucod21@gmail.com', '9e706ad6c330cafa321801857438b88b0236dbd7115dd2f15df6f8a2d955cf51', '2024-01-22 15:02:12', '2024-01-23 15:02:12', 0, 219),
(58, 'harveybucod21@gmail.com', '8bc50ddb48b1978a71882ba715c78dbf16d86627971ec65fb552302582d80c58', '2024-01-22 15:03:33', '2024-01-23 15:03:33', 0, 212),
(59, 'harveybucod21@gmail.com', 'b38b92f72e2a9adfb76880dc5da00fa473edea8e99d53574be260b13ae01d6dc', '2024-01-22 15:03:36', '2024-01-23 15:03:36', 0, 219);

-- --------------------------------------------------------

--
-- Table structure for table `patients_user`
--

CREATE TABLE `patients_user` (
  `userID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `PhoneNumber` varchar(255) NOT NULL,
  `Password` varchar(55) NOT NULL,
  `Hash` varchar(255) NOT NULL,
  `Access` varchar(25) NOT NULL,
  `Active` int(11) NOT NULL DEFAULT 0,
  `profilePic` varchar(255) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `activation_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `ForgotPass` varchar(255) NOT NULL,
  `forgot_expiration` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients_user`
--

INSERT INTO `patients_user` (`userID`, `Email`, `Name`, `Address`, `PhoneNumber`, `Password`, `Hash`, `Access`, `Active`, `profilePic`, `last_activity`, `activation_timestamp`, `ForgotPass`, `forgot_expiration`) VALUES
(1, 'harveybucod21@gmail.com', 'Lee Harvey Esteban Bucod', 'Abar 1st esteban blk San jose City Nueva Ecija', '09630643245', 'leeharvey21', 'sdfghjksdgeokbnkw1231512lkasd', 'User', 1, 'upload/65689a9a3d7072.24885433.jpg', '2024-01-22 10:08:17', '2023-12-07 15:19:04', '1321987590', NULL),
(2, 'mobs.dominiquemartinez@gmail.com', 'Crizsabel Castillo', 'Abar 1st esteban blk San jose City Nueva Ecija', '09959866117', 'pass1234', 'asdqwrgqwrhsdas123', 'User', 1, 'upload/6564c53f0ee517.53334648.jpg', '2023-12-08 17:17:43', '2023-12-07 15:19:04', '', NULL),
(3, 'admin@admin', 'Admin', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', 'admin123', '', 'Administrator', 1, '', '2023-11-30 17:29:34', '2023-12-07 15:19:04', '', NULL),
(4, 'Jologs@gmail.com', 'Maximus Harvey', 'Malasin, San Jose, City, Nueva Ecija', '09152342234', 'pass123', 'asfhwewdgwsf', 'User', 1, '', '2024-01-16 17:37:32', '2023-12-07 15:19:04', '', NULL),
(21, 'Steve@gmail.com', 'Steve Bucod', 'Abar 1st esteban blk', '09154571800', 'steve123', '8d317bdcf4aafcfc22149d77babee96d', 'User', 1, '', '2024-01-16 17:17:07', '2023-12-07 16:14:40', '', NULL),
(33, 'Recept@gmail.com', 'Koala', '', '', 'Koala123', '', 'Receptionist', 1, '', '2024-01-16 17:13:28', '2024-01-11 16:03:27', '', NULL),
(34, 'ianpiolopascual29@gmail.com', 'ian piolo', '', '', 'pascual123', '', 'Receptionist', 1, '', '2024-01-12 00:26:53', '2024-01-12 00:26:29', '', NULL),
(39, 'shakrambrook19@gmail.com', 'Aeron Ruivivar', 'Abar 1st Est blk', '09151235232', 'Pass123', 'd395771085aab05244a4fb8fd91bf4ee', 'User', 1, 'upload/65a74bd2a78496.27830270.jpg', '2024-01-22 11:09:12', '2024-01-12 03:15:19', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `servicetbl`
--

CREATE TABLE `servicetbl` (
  `serviceName` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Un-Archive',
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `servicetbl`
--

INSERT INTO `servicetbl` (`serviceName`, `price`, `filename`, `description`, `status`, `duration`) VALUES
('Dental Braces', 5000, 'upload/65a0b0798d2da7.90569396.png', 'Help correct problems with your teeth, like crowding, crooked teeth, or teeth that are out of alignment, 5000 down payment', 'Un-Archive', 0),
('Dentures (Pustiso)', 3000, 'upload/659fdd2ea58614.55243010.png', 'A timeless solution for replacing missing teeth, Price vary based on case and material of your choice', 'Un-Archive', 0),
('Oral Prophylaxis', 600, 'upload/659fdbc858cbc6.87548151.png', 'Thorough examination of your oral health combined with a scale and clean 30-min', 'Un-Archive', 0),
('retainer', 5000, 'upload/65a0b05984b1e0.86459858.png', 'upper ower', 'Un-Archive', 0),
('Root Canal Treatment', 6500, 'upload/659fde7693f5b0.51682227.jpg', 'For a cracked tooth from injury or genetics, a deep cavity, or issues from a previous filling.', 'Un-Archive', 0),
('Teeth Whitening', 12000, 'upload/659fde1c96d798.13556970.png', 'Makes your teeth lighter so you can have a confident smile', 'Un-Archive', 0),
('Tooth Extraction', 450, 'upload/659fdccb497425.31493558.png', 'Removal of teeth', 'Un-Archive', 0),
('Tooth Restoration (Pasta)', 600, 'upload/659fdc524dce27.21430468.png', 'Fill cavities in teeth that are caused by decay. Price may vary base on numbers of tooth, price is per tooth', 'Un-Archive', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookinglog`
--
ALTER TABLE `bookinglog`
  ADD PRIMARY KEY (`resID`),
  ADD KEY `Service` (`serviceName`),
  ADD KEY `Userss` (`userID`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`Chatidpk`);

--
-- Indexes for table `confirmation_data`
--
ALTER TABLE `confirmation_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients_user`
--
ALTER TABLE `patients_user`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `servicetbl`
--
ALTER TABLE `servicetbl`
  ADD PRIMARY KEY (`serviceName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookinglog`
--
ALTER TABLE `bookinglog`
  MODIFY `resID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `Chatidpk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `confirmation_data`
--
ALTER TABLE `confirmation_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `patients_user`
--
ALTER TABLE `patients_user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookinglog`
--
ALTER TABLE `bookinglog`
  ADD CONSTRAINT `Service` FOREIGN KEY (`serviceName`) REFERENCES `servicetbl` (`serviceName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Userss` FOREIGN KEY (`userID`) REFERENCES `patients_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
