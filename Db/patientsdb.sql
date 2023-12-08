-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2023 at 08:06 PM
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
  `walk_in_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `FamMemberName` varchar(255) NOT NULL DEFAULT 'N/A',
  `confirmationHash` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookinglog`
--

INSERT INTO `bookinglog` (`resID`, `userID`, `serviceName`, `date`, `timeslot`, `remarks`, `admin_remarks`, `walk_in_name`, `status`, `FamMemberName`, `confirmationHash`, `timestamp`) VALUES
(137, 3, 'Braces', '2023-12-09', '09:00 AM - 09:30 AM', '', 'None', '', 'Pending', 'None', '', '2023-12-08 10:43:31'),
(140, 1, 'Cleaning', '2023-12-09', '09:30 AM - 10:00 AM', '', 'None', '', 'Pending', 'N/A', '', '2023-12-08 16:59:42'),
(141, 4, 'Gum Depigmentation', '2023-12-09', '10:00 AM - 10:30 AM', 'xczxcwsx', 'Maitim Gilagid ni gago', '', 'Done', 'N/A', '', '2023-12-08 18:44:58'),
(142, 4, 'asd', '2023-12-09', '08:30 AM - 09:00 AM', 'Putang ina', 'Sheeeshable', '', 'Done', 'N/A', '', '2023-12-08 18:47:02'),
(143, 7, 'Cleaning', '2023-12-09', '10:30 AM - 11:00 AM', '', 'None', '', 'Pending', 'N/A', '', '2023-12-08 17:15:12'),
(146, 12, 'Root canal theraphy', '2023-12-09', '08:00 AM - 08:30 AM', 'Paid', 'None', 'Harvey Bien Bucod', 'Done', 'N/A', '', '2023-12-08 18:50:04'),
(147, 1, 'Gum Depigmentation', '2023-12-12', '09:00 AM - 09:30 AM', 'Pepets', 'None', '', 'Done', 'None', '', '2023-12-08 18:20:12'),
(148, 1, 'Root canal theraphy', '2023-12-12', '09:30 AM - 10:00 AM', 'asdasdasd', 'None', '', 'Canceled', 'None', '', '2023-12-08 18:20:00'),
(149, 1, 'Braces', '2023-12-12', '10:00 AM - 10:30 AM', 'asdsd', 'None', '', 'Done', 'None', '', '2023-12-08 18:19:56'),
(150, 1, 'Gum Depigmentation', '2023-12-11', '10:00 AM - 10:30 AM', '', 'None', '', 'Pending', 'None', '', '2023-12-08 18:58:02'),
(151, 12, 'Cleaning', '2023-12-11', '09:30 AM - 10:00 AM', '', 'None', 'barney the purple dinasour', 'Pending', 'N/A', '', '2023-12-08 19:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `bookings_record`
--

CREATE TABLE `bookings_record` (
  `ID` int(11) NOT NULL,
  `FIRSTNAME` varchar(255) NOT NULL,
  `MIDDLENAME` varchar(255) NOT NULL,
  `LASTNAME` varchar(255) NOT NULL,
  `PHONE` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `DATE` date NOT NULL,
  `AUTONUM` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bookings_record`
--

INSERT INTO `bookings_record` (`ID`, `FIRSTNAME`, `MIDDLENAME`, `LASTNAME`, `PHONE`, `EMAIL`, `DATE`, `AUTONUM`) VALUES
(1, 'ANDRES', 'PAUSAL', 'JARIO', '09306247025', 'andresjario26@gmail.com', '2023-03-30', 'TRAC155965404521');

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
(0, 1, 3, 'Yow Stupid', '2023-12-05 10:02:02', 0);

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
(36, 'Sample@gmail.com', 'cf32a2041ab13db9f4e03297a10a649de812413c98ebded62b8f22bcd62ec3fa', '2023-12-06 18:13:42', '2023-12-07 18:13:42', 0);

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
  `activation_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients_user`
--

INSERT INTO `patients_user` (`userID`, `Email`, `Name`, `Address`, `PhoneNumber`, `Password`, `Hash`, `Access`, `Active`, `profilePic`, `last_activity`, `activation_timestamp`) VALUES
(1, 'Sample@gmail.com', 'Lee Harvey Esteban Bucod', 'Abar 1st esteban blk San jose City Nueva Ecija', '1241231254123', 'leeharvey21', 'sdfghjksdgeokbnkw1231512lkasd', 'User', 1, 'upload/65689a9a3d7072.24885433.jpg', '2023-12-07 17:27:18', '2023-12-07 15:19:04'),
(2, 'mobs.dominiquemartinez@gmail.com', 'Crizsabel Castillo', 'Abar 1st esteban blk San jose City Nueva Ecija', '09959866117', 'pass1234', 'asdqwrgqwrhsdas123', 'User', 1, 'upload/6564c53f0ee517.53334648.jpg', '2023-12-08 17:17:43', '2023-12-07 15:19:04'),
(3, 'admin@admin', 'Admin', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', 'admin123', '', 'Administrator', 1, '', '2023-11-30 17:29:34', '2023-12-07 15:19:04'),
(4, 'Jologs@gmail.com', 'Mark Reggie Francis Lauriano', 'Planet Pluto', '223333232323', 'pass123', 'asfhwewdgwsf', 'User', 1, '', '2023-11-30 15:36:48', '2023-12-07 15:19:04'),
(5, 'SS@gmail.com', 'Lee Harvey Esteban', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', '123', 'asdasdasd', 'User', 1, '', '2023-11-30 15:36:48', '2023-12-07 15:19:04'),
(6, 'ewan@gmail.com', 'Lee Harvey Esteban', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', 'Eggy123', 'asdwefs1231tsf', 'User', 1, '', '2023-11-30 15:36:48', '2023-12-07 15:19:04'),
(7, 'asdasd@gmail.com', 'Lee Harvey Esteban', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', '1401', '06eb61b839a0cefee4967c67ccb099dc', 'User', 0, '', '2023-11-30 15:36:48', '2023-12-07 15:19:04'),
(8, '12315123@gmail.com', 'Lee Harvey Esteban', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', '3063', 'c7e1249ffc03eb9ded908c236bd1996d', 'User', 0, '', '2023-11-30 15:36:48', '2023-12-07 15:19:04'),
(12, 'Recept@gmail.com', 'Lee Harvey Esteban', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', 'Receptionist123', '', 'Receptionist', 1, '', '2023-11-30 15:36:48', '2023-12-07 15:19:04'),
(20, 'harveybucod21@gmail.com', 'Harvey Bucod', 'Abar 1st esteban blk', '09154571800', '4256', 'e5841df2166dd424a57127423d276bbe', 'User', 1, '', '2023-12-07 16:06:23', '2023-12-07 16:06:05'),
(21, 'robartos@gmail.com', 'Harvey Bucod', 'Abar 1st esteban blk', '09154571800', '1219', '8d317bdcf4aafcfc22149d77babee96d', 'User', 0, '', '2023-12-07 16:14:40', '2023-12-07 16:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservationID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `serviceName` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `confirmationHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservationID`, `userID`, `serviceName`, `start_date`, `end_date`, `remarks`, `status`, `confirmationHash`) VALUES
(53, 1, 'Root canal theraphy', '2023-11-10 09:30:00', '2023-11-10 10:00:00', 'ssasddssdd', 'Done', ''),
(54, 1, 'Cleaning', '2023-11-09 11:00:00', '2023-11-09 11:30:00', 'ssasddssdd', 'Done', ''),
(55, 1, 'Cleaning', '2023-11-07 01:30:00', '2023-11-07 02:00:00', 'ssasddssdd', 'Pending', ''),
(56, 1, 'Root canal theraphy', '2023-11-07 09:00:00', '2023-11-07 09:30:00', 'ssasddssdd', 'Pending', ''),
(57, 1, 'Cleaning', '2023-11-07 08:30:00', '2023-11-07 09:00:00', 'ssasddssdd', 'Pending', ''),
(58, 1, 'Root canal theraphy', '2023-11-07 10:30:00', '2023-11-07 11:00:00', 'ssasddssdd', 'Pending', ''),
(59, 1, 'Root canal theraphy', '2023-11-06 11:00:00', '2023-11-06 11:30:00', 'ssasddssdd', 'Cancel', ''),
(64, 1, 'Root canal theraphy', '2023-11-18 11:30:00', '2023-11-18 12:00:00', '', 'Cancel', ''),
(65, 1, 'Cleaning', '2023-11-15 08:30:00', '2023-11-15 09:00:00', 'sssss', 'Cancel', ''),
(66, 1, 'Cleaning', '2023-11-15 11:00:00', '2023-11-15 11:30:00', '', 'Cancel', '');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `serviceID` int(11) NOT NULL,
  `serviceName` varchar(255) NOT NULL,
  `Price` int(11) NOT NULL,
  `estTime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`serviceID`, `serviceName`, `Price`, `estTime`) VALUES
(1, 'Cleaning', 700, '30-minutes'),
(2, 'Root canal therapy', 1000, '60 minutes');

-- --------------------------------------------------------

--
-- Table structure for table `servicetbl`
--

CREATE TABLE `servicetbl` (
  `serviceName` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `servicetbl`
--

INSERT INTO `servicetbl` (`serviceName`, `price`, `filename`, `description`) VALUES
('asd', 123332, 'upload/6572f3fdf2ffb9.59752021.jpg', 'sdasdad'),
('Braces', 25000, 'upload/6562352146f467.76015121.jpg', 'These help your teeth to straight'),
('Cleaning', 700, '', '30-Minutes'),
('Gum Depigmentation', 800, 'upload/656601709ada52.14428633.jpg', 'Para sa maitim na gilagid'),
('Root canal theraphy', 1000, '', '30-minutes');

-- --------------------------------------------------------

--
-- Table structure for table `teeth`
--

CREATE TABLE `teeth` (
  `tooth_id` int(11) NOT NULL,
  `tooth_type` varchar(50) NOT NULL,
  `tooth_number` int(11) NOT NULL,
  `status` enum('Present','Pulled') DEFAULT 'Present',
  `position` enum('Upper','Lower') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teeth`
--

INSERT INTO `teeth` (`tooth_id`, `tooth_type`, `tooth_number`, `status`, `position`) VALUES
(1, 'Incisor', 1, 'Present', 'Upper'),
(2, 'Canine', 2, 'Pulled', 'Upper'),
(3, 'Incisor', 3, 'Present', 'Upper'),
(4, 'Canine', 4, 'Present', 'Upper'),
(5, 'Premolar', 5, 'Present', 'Upper'),
(6, 'Molar', 6, 'Pulled', 'Upper'),
(7, 'Incisor', 7, 'Present', 'Upper'),
(8, 'Canine', 8, 'Present', 'Upper'),
(9, 'Premolar', 9, 'Present', 'Upper'),
(10, 'Molar', 10, 'Present', 'Upper'),
(11, 'Incisor', 11, 'Present', 'Upper'),
(12, 'Canine', 12, 'Present', 'Upper'),
(13, 'Premolar', 13, 'Present', 'Upper'),
(14, 'Molar', 14, 'Present', 'Upper'),
(15, 'Incisor', 15, 'Present', 'Upper'),
(16, 'Canine', 16, 'Present', 'Upper'),
(17, 'Incisor', 1, 'Present', 'Lower'),
(18, 'Canine', 2, 'Present', 'Lower'),
(19, 'Incisor', 3, 'Present', 'Lower'),
(20, 'Canine', 4, 'Present', 'Lower'),
(21, 'Premolar', 5, 'Present', 'Lower'),
(22, 'Molar', 6, 'Present', 'Lower'),
(23, 'Incisor', 7, 'Present', 'Lower'),
(24, 'Canine', 8, 'Present', 'Lower'),
(25, 'Premolar', 9, 'Present', 'Lower'),
(26, 'Molar', 10, 'Present', 'Lower'),
(27, 'Incisor', 11, 'Present', 'Lower'),
(28, 'Canine', 12, 'Present', 'Lower'),
(29, 'Premolar', 13, 'Present', 'Lower'),
(30, 'Molar', 14, 'Present', 'Lower'),
(31, 'Incisor', 15, 'Present', 'Lower'),
(32, 'Canine', 16, 'Pulled', 'Lower');

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot` (
  `timeslotID` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `date` date NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`timeslotID`, `start_time`, `end_time`, `date`, `is_available`) VALUES
(7, '08:00:00', '08:30:00', '2023-10-11', 1),
(8, '08:30:00', '09:00:00', '2023-10-11', 1),
(9, '09:00:00', '09:30:00', '2023-10-11', 1),
(10, '09:30:00', '10:00:00', '2023-10-11', 1),
(11, '10:00:00', '10:30:00', '2023-10-11', 1),
(12, '10:30:00', '11:00:00', '2023-10-11', 1),
(13, '11:00:00', '11:30:00', '2023-10-11', 1),
(14, '11:30:00', '12:00:00', '2023-10-11', 1),
(15, '01:00:00', '01:30:00', '2023-10-11', 1),
(16, '01:30:00', '02:00:00', '2023-10-11', 1),
(17, '02:00:00', '02:30:00', '2023-10-11', 1),
(18, '02:30:00', '03:00:00', '2023-10-11', 1),
(19, '03:00:00', '03:30:00', '2023-10-11', 1),
(20, '03:30:00', '04:00:00', '2023-10-11', 1),
(21, '04:00:00', '04:30:00', '2023-10-11', 1),
(22, '04:30:00', '05:00:00', '2023-10-11', 1);

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
-- Indexes for table `bookings_record`
--
ALTER TABLE `bookings_record`
  ADD PRIMARY KEY (`ID`);

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
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservationID`),
  ADD KEY `User` (`userID`),
  ADD KEY `Services` (`serviceName`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`serviceID`);

--
-- Indexes for table `servicetbl`
--
ALTER TABLE `servicetbl`
  ADD PRIMARY KEY (`serviceName`);

--
-- Indexes for table `teeth`
--
ALTER TABLE `teeth`
  ADD PRIMARY KEY (`tooth_id`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD PRIMARY KEY (`timeslotID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookinglog`
--
ALTER TABLE `bookinglog`
  MODIFY `resID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `bookings_record`
--
ALTER TABLE `bookings_record`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `confirmation_data`
--
ALTER TABLE `confirmation_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `patients_user`
--
ALTER TABLE `patients_user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `serviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teeth`
--
ALTER TABLE `teeth`
  MODIFY `tooth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `timeslot`
--
ALTER TABLE `timeslot`
  MODIFY `timeslotID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookinglog`
--
ALTER TABLE `bookinglog`
  ADD CONSTRAINT `Service` FOREIGN KEY (`serviceName`) REFERENCES `servicetbl` (`serviceName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Userss` FOREIGN KEY (`userID`) REFERENCES `patients_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `Services` FOREIGN KEY (`serviceName`) REFERENCES `servicetbl` (`serviceName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User` FOREIGN KEY (`userID`) REFERENCES `patients_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
