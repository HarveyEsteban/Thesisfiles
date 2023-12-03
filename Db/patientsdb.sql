-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2023 at 07:59 AM
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
  `status` varchar(255) NOT NULL,
  `FamMemberName` varchar(255) NOT NULL DEFAULT 'N/A',
  `confirmationHash` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookinglog`
--

INSERT INTO `bookinglog` (`resID`, `userID`, `serviceName`, `date`, `timeslot`, `remarks`, `status`, `FamMemberName`, `confirmationHash`, `timestamp`) VALUES
(1, 1, 'Root canal theraphy', '2023-11-24', '09:00AM-09:30AM', '', 'Cancel', 'Melvin', 'jkahsdiujhasidhauis223123124123', '2023-12-02 19:55:39'),
(2, 1, 'Root canal theraphy', '2023-11-24', '09:30AM-10:00AM', '', 'Cancel', '', 'jkahsdiujhasidhauis223123124123', '2023-12-02 19:55:39'),
(3, 1, 'Cleaning', '2023-11-29', '09:00AM-09:30AM', 'Test', 'Cancel', '', '', '2023-12-02 19:55:39'),
(4, 1, 'Cleaning', '2023-11-24', '10:00AM-10:30AM', '', 'Done', '', 'jkahsdiujhasidhauis223123124123', '2023-12-02 19:55:39'),
(5, 1, 'Root canal theraphy', '2023-11-24', '10:30AM-11:00AM', 'mabaho bibig Shet', 'Done', '', 'jkahsdiujhasidhauis223123124123', '2023-12-02 19:55:39'),
(6, 1, 'Root canal theraphy', '2023-11-24', '11:00AM-11:30AM', '', 'Done', 'asdasdasdasd', 'jkahsdiujhasidhauis223123124123', '2023-12-02 19:55:39'),
(7, 1, 'Root canal theraphy', '2023-11-24', '11:30AM-12:00PM', '', 'Cancel', 'aaaaa', 'jkahsdiujhasidhauis223123124123', '2023-12-02 19:55:39'),
(8, 1, 'Root canal theraphy', '2023-11-24', '12:00PM-12:30PM', '', 'Cancel', 'sssssss', 'jkahsdiujhasidhauis223123124123', '2023-12-02 19:55:39'),
(9, 1, 'Root canal theraphy', '2023-11-24', '12:30PM-13:00PM', '', 'Cancel', 'aaaaaaa', 'jkahsdiujhasidhauis223123124123', '2023-12-02 19:55:39'),
(10, 1, 'Root canal theraphy', '2023-11-24', '13:00PM-13:30PM', 'Fucking shit amoy tae bibig', 'Done', 'asdasdasdasdasd', 'jkahsdiujhasidhauis223123124123', '2023-12-02 19:55:39'),
(11, 1, 'Cleaning', '2023-11-24', '13:30PM-14:00PM', '', 'Done', '', 'jkahsdiujhasidhauis223123124123', '2023-12-02 19:55:39'),
(12, 1, 'Cleaning', '2023-11-24', '14:00PM-14:30PM', '', 'Pending', '', 'jkahsdiujhasidhauis223123124123', '2023-12-02 19:55:39'),
(13, 1, 'Root canal theraphy', '2023-11-24', '14:30PM-15:00PM', '', 'Pending', 'asdasdasdasd', 'jkahsdiujhasidhauis223123124123', '2023-12-02 19:55:39'),
(14, 1, 'Braces', '2023-11-27', '01:00 PM - 01:30 PM', '', 'Canceled', '', '', '2023-12-02 19:55:39'),
(15, 2, 'Cleaning', '2023-11-27', '08:30 AM - 09:00 AM', 'Baho ng bibig', 'Done', '', '', '2023-12-02 19:55:39'),
(18, 2, 'Root canal theraphy', '2023-11-27', '09:30 AM - 10:00 AM', '', 'Pending', '', '', '2023-12-02 19:55:39'),
(19, 1, 'Braces', '2023-11-30', '09:00 AM - 09:30 AM', '', 'Pending', 'Francis', '', '2023-12-02 19:55:39'),
(25, 11, 'Braces', '2023-12-06', '08:00 AM - 08:30 AM', '', 'Pending', '', '', '2023-12-02 19:55:39'),
(26, 11, 'Braces', '2023-12-05', '08:30 AM - 09:00 AM', '', 'Pending', '', '', '2023-12-02 19:55:39'),
(27, 2, 'Braces', '2023-12-05', '09:00 AM - 09:30 AM', '', 'Pending', '', '', '2023-12-02 20:01:29'),
(28, 11, 'Braces', '2023-12-06', '11:00 AM - 11:30 AM', '', 'Pending', 'Bogart', '', '2023-12-02 20:55:47');

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
(0, 3, 2, 'putang ina', '2023-11-30 17:58:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `confirmation_data`
--

CREATE TABLE `confirmation_data` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hash_code` varchar(64) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `expiration_timestamp` timestamp NULL DEFAULT NULL,
  `confirmed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients_user`
--

INSERT INTO `patients_user` (`userID`, `Email`, `Name`, `Address`, `PhoneNumber`, `Password`, `Hash`, `Access`, `Active`, `profilePic`, `last_activity`) VALUES
(1, 'Sample@gmail.com', 'Lee Harvey Esteban Bucod', 'Abar 1st esteban blk San jose City Nueva Ecija', '1241231254123', 'lee', 'sdfghjksdgeokbnkw1231512lkasd', 'User', 1, 'upload/65689a9a3d7072.24885433.jpg', '2023-11-29 16:01:00'),
(2, 'mobs.dominiquemartinez@gmail.com', 'Bogart People', 'Abar 1st esteban blk San jose City Nueva Ecija', '161235612', 'pass1234', 'asdqwrgqwrhsdas123', 'User', 1, 'upload/6564c53f0ee517.53334648.jpg', '2023-12-02 20:00:02'),
(3, 'admin@admin', 'Admin', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', 'admin123', '', 'Administrator', 1, '', '2023-11-30 17:29:34'),
(4, 'Jologs@gmail.com', 'Mark Reggie Francis Lauriano', 'Planet Pluto', '223333232323', 'pass123', 'asfhwewdgwsf', 'User', 1, '', '2023-11-30 15:36:48'),
(5, 'SS@gmail.com', 'Lee Harvey Esteban', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', '123', 'asdasdasd', 'User', 1, '', '2023-11-30 15:36:48'),
(6, 'ewan@gmail.com', 'Lee Harvey Esteban', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', 'Eggy123', 'asdwefs1231tsf', 'User', 1, '', '2023-11-30 15:36:48'),
(7, 'asdasd@gmail.com', 'Lee Harvey Esteban', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', '1401', '06eb61b839a0cefee4967c67ccb099dc', 'User', 0, '', '2023-11-30 15:36:48'),
(8, '12315123@gmail.com', 'Lee Harvey Esteban', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', '3063', 'c7e1249ffc03eb9ded908c236bd1996d', 'User', 0, '', '2023-11-30 15:36:48'),
(11, 'harveybucod21@gmail.com', 'Lee Harvey Esteban', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', '3772', '48ab2f9b45957ab574cf005eb8a76760', 'User', 1, '', '2023-11-30 15:36:48'),
(12, 'Recept@gmail.com', 'Lee Harvey Esteban', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', 'Receptionist123', '', 'Receptionist', 1, '', '2023-11-30 15:36:48'),
(13, 'Kkksl@gmail.com', 'Lee Harvey Esteban', 'Abar 1st esteban blk San jose City Nueva Ecija', '09154571800', 'Panda123', '', 'Receptionist', 1, '', '2023-11-30 15:36:48');

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
('Braces', 25000, 'upload/6562352146f467.76015121.jpg', 'These help your teeth to straight'),
('Cleaning', 700, '', '30-Minutes'),
('Gum Depigmentation', 800, 'upload/656601709ada52.14428633.jpg', 'Para sa maitim na gilagid'),
('Root canal theraphy', 1000, '', '30-minutes');

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
  MODIFY `resID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `bookings_record`
--
ALTER TABLE `bookings_record`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `confirmation_data`
--
ALTER TABLE `confirmation_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patients_user`
--
ALTER TABLE `patients_user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
