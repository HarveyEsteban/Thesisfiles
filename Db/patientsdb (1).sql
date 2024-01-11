-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 04:58 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
  `totalServicePay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookinglog`
--

INSERT INTO `bookinglog` (`resID`, `userID`, `serviceName`, `date`, `timeslot`, `remarks`, `admin_remarks`, `walk_in_name`, `status`, `FamMemberName`, `confirmationHash`, `timestamp`, `totalServicePay`) VALUES
(176, 1, 'Dental Braces', '2024-01-11', '09:00 AM - 09:30 AM', '', 'None', 'None', 'Pending', 'None', '', '2024-01-11 13:21:31', 0),
(177, 2, 'Tooth Extraction', '2024-01-11', '02:00 PM - 02:30 PM', '', 'None', 'None', 'Done', 'None', '', '2024-01-11 13:29:30', 800),
(178, 6, 'Dentures (Pustiso)', '2024-01-16', '02:30 PM - 03:00 PM', 'Doc not avail', 'None', 'None', 'Cancel', 'None', '', '2024-01-11 14:22:42', 0),
(179, 32, 'Dental Braces', '2024-01-14', '09:00 AM - 09:30 AM', '', 'None', 'None', 'Pending', 'None', '', '2024-01-11 13:56:53', 0),
(180, 12, 'Dental Braces ', '2024-01-11', '01:00 PM - 02:00 PM', '', 'None', 'Juan Dela Cruz', 'Pending', 'Juan Dela Cruz', '', '2024-01-11 15:52:28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
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

INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `timestamp`, `status`) VALUES
(0, 1, 0, 'aaa', '2023-11-30 17:05:49', 1),
(0, 1, 0, 'aaaa', '2023-11-30 17:06:21', 1),
(0, 1, 0, 'aaaa', '2023-11-30 17:14:19', 1),
(0, 2, 0, 'hello\n', '2023-11-30 17:14:35', 1),
(0, 1, 0, 'Hello', '2023-11-30 17:18:02', 1),
(0, 2, 0, 'sss', '2023-11-30 17:18:14', 1),
(0, 1, 2, 'aaaa', '2023-11-30 17:21:19', 1),
(0, 2, 1, 'Yow', '2023-11-30 17:21:58', 1),
(0, 3, 2, 'Hello Its me', '2023-11-30 17:37:35', 0),
(0, 2, 3, 'Omg what a fucking stupid shit', '2023-11-30 17:37:53', 0),
(0, 3, 2, 'Yeah', '2023-11-30 17:45:52', 0),
(0, 2, 3, 'Hey there fucking shit', '2023-11-30 17:49:47', 0),
(0, 2, 3, 'Yow', '2023-11-30 17:50:28', 0),
(0, 3, 2, 'putang ina', '2023-11-30 17:58:31', 0),
(0, 3, 1, 'Hello', '2023-12-04 17:27:49', 0),
(0, 3, 1, 'Hey', '2023-12-04 17:47:35', 0),
(0, 3, 1, 'yow', '2023-12-04 17:49:12', 0),
(0, 3, 1, 'hey', '2023-12-04 17:49:15', 0),
(0, 3, 1, 'hey', '2023-12-04 17:49:16', 0),
(0, 3, 1, 'Hello', '2023-12-04 17:58:13', 0),
(0, 1, 3, 'Hello', '2023-12-05 09:56:47', 0),
(0, 3, 1, 'asd', '2023-12-05 09:57:03', 0),
(0, 1, 3, 'asd', '2023-12-05 09:57:12', 0),
(0, 3, 1, 'Hello motherfucker', '2023-12-05 10:00:52', 0),
(0, 1, 3, 'Yow Stupid', '2023-12-05 10:02:02', 0),
(0, 3, 1, 'Hello admin', '2023-12-10 12:12:30', 0),
(0, 3, 1, 'ssss', '2023-12-10 12:14:29', 0),
(0, 3, 1, 'hey there\n', '2023-12-10 12:43:10', 0),
(0, 1, 3, 'Hey What can i do for you?', '2023-12-10 12:43:25', 0),
(0, 1, 3, 'hotdog', '2023-12-10 12:43:34', 0),
(0, 3, 1, 'zxcxcz', '2023-12-10 12:47:43', 0),
(0, 3, 1, 'asdasd', '2023-12-10 12:49:11', 0),
(0, 3, 1, 'ssss', '2023-12-10 12:49:22', 0),
(0, 3, 1, 'dasdasdasd', '2023-12-10 12:49:28', 0),
(0, 1, 3, 'asdasdasdasd', '2023-12-10 12:50:43', 0),
(0, 1, 3, 'Hey there', '2023-12-10 12:51:24', 0),
(0, 3, 1, 'Hello', '2023-12-10 12:51:42', 0),
(0, 3, 1, 'ssss', '2023-12-10 12:51:59', 0),
(0, 3, 1, 'asdasdasdas', '2023-12-10 12:52:11', 0),
(0, 1, 3, 'ssss\n', '2023-12-10 12:53:10', 0),
(0, 1, 3, 'ssssss', '2023-12-10 12:53:16', 0),
(0, 3, 1, 'asdasddd', '2023-12-10 12:53:28', 0),
(0, 3, 1, 'ssss', '2023-12-10 12:55:05', 0),
(0, 3, 1, 'leee harvey', '2023-12-10 12:58:38', 0),
(0, 3, 1, 'ssss', '2023-12-10 13:02:38', 0),
(0, 1, 3, 'sssss', '2023-12-10 13:03:07', 0),
(0, 3, 1, 'asdasdads', '2023-12-10 13:04:05', 0),
(0, 1, 3, 'asdasdasdasdasd', '2023-12-10 13:04:25', 0),
(0, 1, 3, 'sssdasd', '2023-12-10 13:04:42', 0),
(0, 1, 3, 'asdasdd', '2023-12-10 13:04:51', 0),
(0, 1, 3, 'sdasd', '2023-12-10 13:09:43', 0),
(0, 3, 1, 'hey', '2023-12-10 13:14:01', 0),
(0, 3, 1, 'dddsad', '2023-12-10 13:14:32', 0),
(0, 1, 3, 'sasddd', '2023-12-10 13:14:38', 0),
(0, 1, 3, 'aasdasd', '2023-12-10 13:14:50', 0),
(0, 1, 3, 'asddaasd', '2023-12-10 13:15:01', 0),
(0, 3, 1, 'Hey ', '2023-12-10 13:15:14', 0),
(0, 3, 1, 'wrqwrqwr', '2023-12-10 13:15:58', 0),
(0, 1, 3, 'sdaasdasasd', '2023-12-10 13:16:07', 0),
(0, 1, 3, 'ssad', '2023-12-10 13:16:32', 0),
(0, 3, 1, 'sdasd', '2023-12-10 13:17:06', 0),
(0, 1, 3, 'afafasdf', '2023-12-10 13:17:33', 0),
(0, 1, 3, 'asdsadsa', '2023-12-10 13:18:12', 0),
(0, 3, 1, 'asdadsasd', '2023-12-10 13:18:58', 0),
(0, 1, 3, 'asdasdas', '2023-12-10 13:24:52', 0),
(0, 3, 1, 'asdasdasdd', '2023-12-10 13:31:06', 0),
(0, 1, 3, 'asdadssda', '2023-12-10 13:33:22', 0),
(0, 3, 1, 'dasdasd', '2023-12-10 13:34:56', 0),
(0, 1, 3, 'asddd', '2023-12-10 13:36:17', 0),
(0, 1, 3, 'asdasddd', '2023-12-10 13:36:29', 0),
(0, 1, 3, 'asddd', '2023-12-10 13:37:11', 0),
(0, 3, 1, 'sadwwds', '2023-12-10 13:37:38', 0),
(0, 3, 1, 'eeesd', '2023-12-10 13:37:51', 0),
(0, 3, 1, 'asddd', '2023-12-10 13:39:35', 0),
(0, 1, 3, 'asdddasd', '2023-12-10 13:47:28', 0),
(0, 1, 3, 'ddddd', '2023-12-10 13:47:38', 0),
(0, 1, 3, 'assss', '2023-12-10 13:50:24', 0),
(0, 1, 3, 'sasdddd', '2023-12-10 13:50:49', 0),
(0, 1, 3, 'asdddd', '2023-12-10 13:51:03', 0),
(0, 1, 3, 'ddd', '2023-12-10 13:51:24', 0),
(0, 1, 3, 'asddd', '2023-12-10 13:51:36', 0),
(0, 3, 1, 'assdwwww', '2023-12-10 13:51:50', 0),
(0, 3, 1, 'asddsw', '2023-12-10 13:53:00', 0),
(0, 3, 1, 'sssss', '2023-12-10 17:39:58', 0),
(0, 1, 3, 'gago', '2024-01-11 13:17:52', 0),
(0, 1, 3, 'Utut mo', '2024-01-11 13:18:34', 0),
(0, 3, 32, 'Hello there, I would like to ask a mother fucking question', '2024-01-11 14:16:18', 0),
(0, 32, 3, 'Hello what can i do for you', '2024-01-11 14:17:03', 0);

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
  `confirmed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `confirmation_data`
--

INSERT INTO `confirmation_data` (`id`, `email`, `hash_code`, `timestamp`, `expiration_timestamp`, `confirmed`) VALUES
(21, 'harveybucod21@gmail.com', '3e2f49b14394926b9d5b33c5e672bf2457f8126cf310c9fa1fd3ce044a613806', '2023-12-03 17:09:51', '2023-12-04 17:09:51', 0),
(22, 'Sample@gmail.com', '8551509ad75f752df6b1ba8d652a2aa875a6a30cb7b86542c07b2fdb1698ff4c', '2023-12-03 17:09:53', '2023-12-04 17:09:53', 0),
(23, 'harveybucod21@gmail.com', 'aecd1d39c461eaf1e15ce2d8461705f9152939992a884df6bf6a41c6cab263e4', '2023-12-03 17:10:47', '2023-12-04 17:10:47', 1),
(24, 'Sample@gmail.com', 'd7ae1c8da4c3228ac4671a160bdd204c563303401bfafcd7e4160b7b6c3ca142', '2023-12-03 17:10:50', '2023-12-04 17:10:50', 0),
(25, 'harveybucod21@gmail.com', 'fe69107d28b7c5260da40500c7fe55c8b2fe89192c710c0260ddf6fefb380bbf', '2023-12-03 17:22:08', '2023-12-04 17:22:08', 1),
(26, 'Sample@gmail.com', '1d4446081c3d89b3ed8c3a4dad6461b753999b8e96637f1bf05602d25e9198f7', '2023-12-03 17:22:10', '2023-12-04 17:22:10', 0),
(27, 'harveybucod21@gmail.com', 'a36bccc904957d78b33640852af67ea452fc58ded2a1600154fea84b9cf620c8', '2023-12-03 17:38:59', '2023-12-04 17:38:59', 0),
(28, 'Sample@gmail.com', '2811c83f184849c0e3561c0c49830ef58814faee960dea4f282ce45cbd734273', '2023-12-03 17:39:01', '2023-12-04 17:39:01', 0),
(29, 'harveybucod21@gmail.com', 'f18088b473369c92a2330de86188708644eaec1f649597f7ebdd068013403a04', '2023-12-03 17:48:45', '2023-12-04 17:48:45', 0),
(30, 'harveybucod21@gmail.com', '9fa82ea6847e972108640588ae0f4fb5cf33d328456eca50e163bcf354a50ccc', '2023-12-04 16:00:01', '2023-12-05 16:00:01', 1),
(31, 'harveybucod21@gmail.com', 'df3df203f658f54ccff96ea7a8ad5296dca15434fa8dc6f14d35367525571966', '2023-12-04 21:00:02', '2023-12-05 21:00:02', 0),
(32, 'harveybucod21@gmail.com', '6643578f156a9a9c78901f9c7c71ae5b6f5e1de0bf5db8dbb13c3b674757d704', '2023-12-05 16:00:02', '2023-12-06 16:00:02', 0),
(33, 'harveybucod21@gmail.com', '313a8fe328a76c4d3c6c3a3151655c98e9ec5820be026435f6e098b47aff9ff5', '2023-12-05 17:51:29', '2023-12-06 17:51:29', 0),
(34, 'harveybucod21@gmail.com', '21903f0e57eba10b9414639c247f413e9834b103a837804f59b67c3f26b56b03', '2023-12-05 18:57:41', '2023-12-06 18:57:41', 0),
(35, 'Sample@gmail.com', 'f633660e3b8f7ffe73716d1f21c04e499331f84b95d5f5754a2bc78e342883a9', '2023-12-05 19:39:10', '2023-12-06 19:39:10', 0),
(36, 'Sample@gmail.com', 'cf32a2041ab13db9f4e03297a10a649de812413c98ebded62b8f22bcd62ec3fa', '2023-12-06 18:13:42', '2023-12-07 18:13:42', 0),
(37, 'Sample@gmail.com', 'b1fc2bd488f2dc9ea28ed993de65c0ac5a762a476c03e428b8c4825d16cf1081', '2023-12-09 16:00:01', '2023-12-10 16:00:01', 0),
(38, 'Sample@gmail.com', '92a742ad8eab617040b1929213d09f22e2b6563c226912768ead94ab72ccef30', '2023-12-09 17:36:40', '2023-12-09 17:37:40', 0),
(40, 'Sample@gmail.com', 'f4b96267e5ce5fbb96ada0b424aae176206fa98e80a6d848705e0873d8def86a', '2023-12-09 17:43:19', '2023-12-09 17:44:19', 0),
(42, 'mobs.dominiquemartinez@gmail.com', '026d3302c20697fdba3e9c3af298a7ff95caf01ea28de9d5d290a399a09a09dd', '2023-12-09 17:50:05', '2023-12-09 17:51:05', 0),
(43, 'mobs.dominiquemartinez@gmail.com', 'ebd6859439916b3a0e10494f2cb1369844f19bed6e7c54acc3c079b2cf3a05e4', '2023-12-09 18:05:22', '2023-12-09 18:06:22', 0),
(45, 'mobs.dominiquemartinez@gmail.com', '5523eeb6a642cfd6239696d92d581c3dea7a21b3367b6b73ea64f7da947bec78', '2023-12-09 18:07:25', '2023-12-09 18:08:25', 0),
(46, 'harveybucod21@gmail.com', 'ac228da0c6b2deeda177a7cc6933d9c96824007c8dc89966793538e09f870b54', '2023-12-09 18:07:28', '2023-12-09 18:08:28', 0),
(47, 'mobs.dominiquemartinez@gmail.com', '7efabe2d8957bd79e2a82f8991880b2ff593f9c4883fe98fca078b8805523194', '2023-12-10 02:32:57', '2023-12-10 02:33:57', 0),
(48, 'harveybucod21@gmail.com', '59a64f4c121fd4e5f3917d232086b65146fe1e5466bc5eac98761a0192c2f967', '2023-12-10 02:33:00', '2023-12-10 02:34:00', 0),
(49, 'harveybucod21@gmail.com', '2e7ffb8513532f4c8dc82748eec4fda0b2b2deeb57e2001a9f0a6e1ceb02df61', '2023-12-10 07:12:33', '2023-12-10 07:13:33', 1);

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
(1, 'Sample@gmail.com', 'Lee Harvey Esteban Bucod', 'Abar 1st esteban blk San jose City Nueva Ecija', '09785233123', 'leeharvey21', 'sdfghjksdgeokbnkw1231512lkasd', 'User', 1, 'upload/65689a9a3d7072.24885433.jpg', '2024-01-11 14:06:01', '2023-12-07 15:19:04', '1321987590', NULL),
(2, 'mobs.dominiquemartinez@gmail.com', 'Crizsabel Castillo', 'Abar 1st esteban blk San jose City Nueva Ecija', '09959866117', 'pass1234', 'asdqwrgqwrhsdas123', 'User', 1, 'upload/6564c53f0ee517.53334648.jpg', '2023-12-08 17:17:43', '2023-12-07 15:19:04', '', NULL),
(3, 'admin@admin', 'Admin', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', 'admin123', '', 'Administrator', 1, '', '2023-11-30 17:29:34', '2023-12-07 15:19:04', '', NULL),
(4, 'Jologs@gmail.com', 'Mark Reggie Francis Lauriano', 'Planet Pluto', '223333232323', 'pass123', 'asfhwewdgwsf', 'User', 1, '', '2023-11-30 15:36:48', '2023-12-07 15:19:04', '', NULL),
(5, 'SS@gmail.com', 'Aeron Ruivivar', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', '123', 'asdasdasd', 'User', 1, '', '2024-01-11 14:08:00', '2023-12-07 15:19:04', '', NULL),
(6, 'ewan@gmail.com', 'Lee Harvey Esteban', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', 'Eggy123', 'asdwefs1231tsf', 'User', 1, '', '2023-11-30 15:36:48', '2023-12-07 15:19:04', '', NULL),
(7, 'asdasd@gmail.com', 'Lee Harvey Esteban', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', '1401', '06eb61b839a0cefee4967c67ccb099dc', 'User', 0, '', '2023-11-30 15:36:48', '2023-12-07 15:19:04', '', NULL),
(8, '12315123@gmail.com', 'Lee Harvey Esteban', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', '3063', 'c7e1249ffc03eb9ded908c236bd1996d', 'User', 0, '', '2023-11-30 15:36:48', '2023-12-07 15:19:04', '', NULL),
(12, 'Recept@gmail.com', 'Harvey', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', 'Helloworld123', '', 'Receptionist', 1, '', '2023-12-10 09:45:48', '2023-12-07 15:19:04', '', NULL),
(21, 'robartos@gmail.com', 'Harvey Bucod', 'Abar 1st esteban blk', '09154571800', '1219', '8d317bdcf4aafcfc22149d77babee96d', 'User', 0, '', '2023-12-07 16:14:40', '2023-12-07 16:14:40', '', NULL),
(22, 'Pople@gmail.com', 'New', '', '', 'NewPanda123', '', 'Receptionist', 1, '', '2023-12-10 09:22:59', '2023-12-10 09:22:59', '', NULL),
(23, 'Pople@gmail.com', 'New', '', '', 'NewPanda123', '', 'Receptionist', 1, '', '2023-12-10 09:23:41', '2023-12-10 09:23:41', '', NULL),
(24, 'harveybucod2s1@gmail.com', 'Harvey Bucod', 'Abar 1st esteban blk', '09154571800', '4643', 'ad13a2a07ca4b7642959dc0c4c740ab6', 'User', 0, '', '2023-12-10 18:47:23', '2023-12-10 18:47:23', '', NULL),
(26, 'dellleebucod@gmail.com', 'Harvey Bien Bucod', '', '', '', '', 'User', 0, '', '2024-01-11 14:24:05', '2023-12-10 20:19:07', '', NULL),
(27, 'dellleebucod@gmail.com', 'Lee Bucod', '', '', '', '', 'User', 0, '', '2023-12-10 20:20:41', '2023-12-10 20:20:41', '', NULL),
(28, 'dellleebucod@gmail.com', 'Lee Bucod', '', '', '', '', 'User', 0, '', '2023-12-10 20:21:38', '2023-12-10 20:21:38', '', NULL),
(29, 'dellleebucod@gmail.com', 'Lee Bucod', '', '', '', '', 'User', 0, '', '2023-12-10 20:23:18', '2023-12-10 20:23:18', '', NULL),
(30, 'dellleebucod@gmail.com', 'Lee Bucod', '', '', '', '', 'User', 0, '', '2023-12-10 20:39:43', '2023-12-10 20:39:43', '', NULL),
(31, 'harveybucod22221@gmail.com', 'Harvey Bucod', 'Abar 1st esteban blk', '09154571800', '2562', '7d04bbbe5494ae9d2f5a76aa1c00fa2f', 'User', 0, '', '2024-01-11 11:45:14', '2024-01-11 11:45:14', '', NULL),
(32, 'harveybucod21@gmail.com', 'Maximus Harvey bucod', 'Abar 1st esteban blk, Sanjose City, Nueva Ecija', '09154571800', '4378', '0336dcbab05b9d5ad24f4333c7658a0e', 'User', 1, '', '2024-01-11 13:53:52', '2024-01-11 13:52:37', '', NULL);

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
('Dental Braces', 5000, 'upload/659fddb2d00e30.02864361.png', 'Help correct problems with your teeth, like crowding, crooked teeth, or teeth that are out of alignment, 5000 down payment', 'Un-Archive', 0),
('Dentures (Pustiso)', 3000, 'upload/659fdd2ea58614.55243010.png', 'A timeless solution for replacing missing teeth, Price vary based on case and material of your choice', 'Un-Archive', 0),
('Oral Prophylaxis', 600, 'upload/659fdbc858cbc6.87548151.png', 'Thorough examination of your oral health combined with a scale and clean 30-min', 'Un-Archive', 0),
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
  MODIFY `resID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `confirmation_data`
--
ALTER TABLE `confirmation_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `patients_user`
--
ALTER TABLE `patients_user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
