-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 20 Μαρ 2017 στις 13:52:34
-- Έκδοση διακομιστή: 5.7.14
-- Έκδοση PHP: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `restaurant_db`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `booking`
--

CREATE TABLE `booking` (
  `BOOKING_ID` int(11) NOT NULL,
  `BOOKING_DATE` date DEFAULT NULL,
  `BOOKING_TIME` time DEFAULT NULL,
  `BOOKING_TIMESTAMP` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `BOOKING_SIZE` int(11) DEFAULT NULL,
  `USERS_USER_ID` int(11) NOT NULL,
  `SMOKING_BOOL` tinyint(1) NOT NULL DEFAULT '0',
  `booking_status_B_STATUS_ID` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `booking`
--

INSERT INTO `booking` (`BOOKING_ID`, `BOOKING_DATE`, `BOOKING_TIME`, `BOOKING_TIMESTAMP`, `BOOKING_SIZE`, `USERS_USER_ID`, `SMOKING_BOOL`, `booking_status_B_STATUS_ID`) VALUES
(26, '2017-03-20', '17:30:00', '2017-03-19 10:55:48', 3, 12, 0, 3),
(27, '2017-03-19', '21:00:00', '2017-03-19 10:56:47', 1, 11, 1, 5),
(28, '2017-03-21', '21:00:00', '2017-03-19 10:56:56', 2, 32, 0, 1),
(29, '2017-03-19', '18:00:00', '2017-03-19 10:57:33', 4, 23, 0, 4),
(30, '2017-03-20', '22:30:00', '2017-03-19 10:58:48', 7, 31, 1, 2),
(31, '2017-03-21', '21:30:00', '2017-03-19 10:59:09', 5, 20, 1, 3),
(32, '2017-03-22', '20:00:00', '2017-03-19 10:59:46', 4, 24, 0, 1),
(33, '2017-03-24', '21:30:00', '2017-03-19 11:01:05', 8, 29, 1, 2),
(34, '2017-03-23', '11:00:00', '2017-03-19 11:03:56', 5, 22, 0, 1),
(35, '2017-03-24', '22:00:00', '2017-03-19 11:05:31', 1, 16, 0, 3),
(36, '2017-03-24', '22:00:00', '2017-03-19 11:44:15', 5, 16, 0, 2),
(37, '2017-03-25', '15:30:00', '2017-03-19 13:49:54', 3, 30, 0, 2),
(38, '2017-03-22', '17:30:00', '2017-03-19 13:55:16', 7, 26, 1, 6),
(39, '2017-03-30', '23:00:00', '2017-03-19 13:57:49', 4, 23, 1, 2),
(40, '2017-03-20', '17:00:00', '2017-03-19 14:08:05', 5, 21, 0, 2),
(41, '2017-03-22', '21:00:00', '2017-03-19 16:23:12', 5, 3, 0, 2);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `booking_status`
--

CREATE TABLE `booking_status` (
  `B_STATUS_ID` int(2) NOT NULL,
  `B_STATUS_NAME` varchar(45) NOT NULL,
  `B_STATUS_DESC` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `booking_status`
--

INSERT INTO `booking_status` (`B_STATUS_ID`, `B_STATUS_NAME`, `B_STATUS_DESC`) VALUES
(1, 'Pending', 'This reservations has not been approved yet'),
(2, 'Approved', 'This reservation has been approved'),
(3, 'Cancelled', 'This reservation has been cancelled'),
(4, 'Unattended', 'The customers didn\'t attend on their reservation'),
(5, 'Attended', 'Client\'s Attended'),
(6, 'Deleted', 'Virtually Deleted Reservations');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `storehours`
--

CREATE TABLE `storehours` (
  `DAY_ID` tinyint(1) NOT NULL,
  `DAY_NAME` text NOT NULL,
  `OPENING_HOUR` text NOT NULL,
  `CLOSING_HOUR` text NOT NULL,
  `IS_CLOSED` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `storehours`
--

INSERT INTO `storehours` (`DAY_ID`, `DAY_NAME`, `OPENING_HOUR`, `CLOSING_HOUR`, `IS_CLOSED`) VALUES
(1, 'mon', '16:00', '00:00', 1),
(2, 'tue', '16:00', '00:00', 0),
(3, 'wed', '14:30', '22:00', 0),
(4, 'thu', '16:00', '00:00', 0),
(5, 'fri', '16:00', '00:00', 0),
(6, 'sat', '12:30', '00:00', 0),
(7, 'sun', '12:30', '00:00', 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `tables`
--

CREATE TABLE `tables` (
  `TABLE_CODE` varchar(45) NOT NULL,
  `TABLE_SIZE` int(11) NOT NULL DEFAULT '4',
  `SMOKING` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `tables`
--

INSERT INTO `tables` (`TABLE_CODE`, `TABLE_SIZE`, `SMOKING`) VALUES
('A1', 4, 0),
('A2', 4, 0),
('A3', 4, 0),
('A4', 4, 0),
('A5', 4, 0),
('A6', 4, 0),
('A7', 4, 0),
('A8', 4, 0),
('A9', 4, 0),
('B1', 4, 1),
('B2', 4, 1),
('B3', 4, 1),
('B4', 4, 1),
('B5', 4, 1),
('B6', 4, 1),
('B7', 4, 1),
('B8', 4, 1),
('C1', 6, 0),
('C2', 6, 0),
('C3', 6, 0),
('C4', 6, 0),
('C5', 2, 0),
('C6', 2, 0),
('C7', 2, 0),
('C8', 2, 0),
('D1', 2, 1),
('D2', 2, 1),
('D3', 2, 1),
('D4', 2, 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `tables_booked`
--

CREATE TABLE `tables_booked` (
  `Booking_BOOKING_ID` int(11) NOT NULL,
  `TABLES_TABLE_CODE` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `tables_booked`
--

INSERT INTO `tables_booked` (`Booking_BOOKING_ID`, `TABLES_TABLE_CODE`) VALUES
(30, 'B1'),
(30, 'B2'),
(33, 'B7'),
(33, 'B8'),
(36, 'A4'),
(37, 'A3'),
(39, 'B2'),
(39, 'B3'),
(40, 'C1'),
(41, 'C1');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `userlevels`
--

CREATE TABLE `userlevels` (
  `USERLEVEL_ID` int(2) NOT NULL,
  `LEVEL_NAME` varchar(45) NOT NULL,
  `LEVEL_DESC` varchar(45) DEFAULT NULL,
  `IS_ADMIN` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `userlevels`
--

INSERT INTO `userlevels` (`USERLEVEL_ID`, `LEVEL_NAME`, `LEVEL_DESC`, `IS_ADMIN`) VALUES
(1, 'Customer', 'This is a member user', 0),
(10, 'Administrator', 'This is Administrator above all user', 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `USER_ID` int(11) NOT NULL,
  `FIRSTNAME` varchar(50) NOT NULL,
  `LASTNAME` varchar(50) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `USERPASS` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `CONTACT_NUMBER_1` varchar(25) NOT NULL,
  `CONTACT_NUMBER_2` varchar(25) DEFAULT NULL,
  `UserLevels_USERLEVEL_ID` int(2) DEFAULT '1',
  `TIMESTAMP_REGISTERED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`USER_ID`, `FIRSTNAME`, `LASTNAME`, `USERNAME`, `USERPASS`, `EMAIL`, `CONTACT_NUMBER_1`, `CONTACT_NUMBER_2`, `UserLevels_USERLEVEL_ID`, `TIMESTAMP_REGISTERED`) VALUES
(3, 'Constantine', 'Stathis', 'bikos13', '25d55ad283aa400af464c76d713c07ad', 'constantinos-@hotmail.com', '6948621978', '', 10, '2017-01-18 11:44:58'),
(11, 'Pavlos', 'Kolovos', 'pkolovos', '25d55ad283aa400af464c76d713c07ad', 'pkolovos@gmail.com', '2109200001', '', 1, '2017-03-19 10:34:49'),
(12, 'Stratos', 'Tsakmaz', 'stsakmaz', '25d55ad283aa400af464c76d713c07ad', 'stsakmaz@gmail.com', '2109200002', '', 1, '2017-03-19 10:35:54'),
(13, 'Stavros', 'Dimitriadis', 'sdimitriadis', '25d55ad283aa400af464c76d713c07ad', 'sdimitriadis@gmail.com', '2109200003', '', 1, '2017-03-19 10:36:33'),
(14, 'mitsos', 'koulitos', 'mitsokoulitos', '25d55ad283aa400af464c76d713c07ad', 'mitsokoulitos@hotmail.com', '2110456789', '6987654321', 1, '2017-03-19 10:38:07'),
(15, 'Kiriaki', 'Tetradi', 'ktetradi', '25d55ad283aa400af464c76d713c07ad', 'ktetradi@gmail.com', '2109200004', '', 1, '2017-03-19 10:38:58'),
(16, 'Nikos', 'Psalidas', 'npsalidas', '25d55ad283aa400af464c76d713c07ad', 'npsalidas@gmail.com', '2109200005', '', 1, '2017-03-19 10:39:23'),
(17, 'George', 'Stathis', 'gstathis', '25d55ad283aa400af464c76d713c07ad', 'gstathis@hotmail.com', '2109200006', '', 1, '2017-03-19 10:40:11'),
(18, 'George', 'Palaios', 'gpalaios', '25d55ad283aa400af464c76d713c07ad', 'gpalaios@yahoo.gr', '2109200007', '', 1, '2017-03-19 10:40:44'),
(19, 'George', 'Christoulakis', 'gchristoulakis', '25d55ad283aa400af464c76d713c07ad', 'gchristoulakis@gmail.com', '2109200007', '', 1, '2017-03-19 10:41:31'),
(20, 'Anastasios', 'Eleftheriadis', 'aeleftheriadis', '25d55ad283aa400af464c76d713c07ad', 'aeleftheriadis@yahoo.gr', '2109200008', '', 1, '2017-03-19 10:42:30'),
(21, 'Andrea', 'Struzas', 'astruzas', '25d55ad283aa400af464c76d713c07ad', 'astruzas@outlook.com', '2109200009', '', 1, '2017-03-19 10:43:51'),
(22, 'giannis', 'fwtiadis', 'gfwtiadis', '25d55ad283aa400af464c76d713c07ad', 'gfwtiadis@hotmail.com', '2109000000', '', 1, '2017-03-19 10:43:55'),
(23, 'Dimitris', 'Fotiadis', 'dfotiadis', '25d55ad283aa400af464c76d713c07ad', 'dfotiadis@gmail.com', '2109200009', '', 1, '2017-03-19 10:44:20'),
(24, 'nefeli', 'demetzi', 'ndemertzi', '25d55ad283aa400af464c76d713c07ad', 'ndemertzi@hotmail.com', '2109000001', '', 1, '2017-03-19 10:45:21'),
(25, 'Filippos', 'Georgiou', 'fgeorgiou', '25d55ad283aa400af464c76d713c07ad', 'fgeorgiou@yahoo.com', '2109200010', '', 1, '2017-03-19 10:45:24'),
(26, 'Amaryllis', 'Nydrioti', 'anydrioti', '25d55ad283aa400af464c76d713c07ad', 'anydrioti@steam.com', '2109200011', '', 1, '2017-03-19 10:45:58'),
(27, 'maria', 'milw', 'mmilw', '25d55ad283aa400af464c76d713c07ad', 'mmilw@hotmail.com', '12345678', '', 1, '2017-03-19 10:46:09'),
(28, 'Dimitris', 'Evangelinos', 'devangelinos', '25d55ad283aa400af464c76d713c07ad', 'devangelinos@yahoo.com', '2109200012', '', 1, '2017-03-19 10:46:42'),
(29, 'nagia', 'dernika', 'ndernika', '25d55ad283aa400af464c76d713c07ad', 'ndernika@hotmail.com', '2109000002', '', 1, '2017-03-19 10:47:22'),
(30, 'Alexandros', 'Kales', 'akales', '25d55ad283aa400af464c76d713c07ad', 'leskal@gmail.com', '2109200013', '', 1, '2017-03-19 10:47:54'),
(31, 'sofia', 'tsirwna', 'stsirwna', '25d55ad283aa400af464c76d713c07ad', 'stsirwna@hotmail.com', '2109000003', '', 1, '2017-03-19 10:48:29'),
(32, 'Emily', 'Fakou', 'emily', '25d55ad283aa400af464c76d713c07ad', 'efakou@outlook.com', '2109200014', '', 10, '2017-03-19 10:51:57'),
(33, 'Petros', 'Lalos', 'plalos', '25d55ad283aa400af464c76d713c07ad', 'plalos@amc.edu.gr', '2109200015', '', 10, '2017-03-20 11:13:51');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BOOKING_ID`,`USERS_USER_ID`),
  ADD KEY `fk_Booking_Users1_idx` (`USERS_USER_ID`),
  ADD KEY `booking_status.B_STATUS_ID` (`booking_status_B_STATUS_ID`);

--
-- Ευρετήρια για πίνακα `booking_status`
--
ALTER TABLE `booking_status`
  ADD PRIMARY KEY (`B_STATUS_ID`),
  ADD UNIQUE KEY `idBOOKING_STATUS_ID_UNIQUE` (`B_STATUS_ID`);

--
-- Ευρετήρια για πίνακα `storehours`
--
ALTER TABLE `storehours`
  ADD PRIMARY KEY (`DAY_ID`),
  ADD UNIQUE KEY `DAY_ID` (`DAY_ID`);

--
-- Ευρετήρια για πίνακα `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`TABLE_CODE`),
  ADD UNIQUE KEY `TABLE_CODE_UNIQUE` (`TABLE_CODE`);

--
-- Ευρετήρια για πίνακα `tables_booked`
--
ALTER TABLE `tables_booked`
  ADD PRIMARY KEY (`Booking_BOOKING_ID`,`TABLES_TABLE_CODE`),
  ADD KEY `fk_TABLES_has_Booking_Booking1_idx` (`Booking_BOOKING_ID`),
  ADD KEY `fk_TABLES_BOOKED_TABLES1_idx` (`TABLES_TABLE_CODE`);

--
-- Ευρετήρια για πίνακα `userlevels`
--
ALTER TABLE `userlevels`
  ADD PRIMARY KEY (`USERLEVEL_ID`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`),
  ADD UNIQUE KEY `USER_ID_UNIQUE` (`USER_ID`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`),
  ADD KEY `UserLevels_USERLEVEL_ID` (`UserLevels_USERLEVEL_ID`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `booking`
--
ALTER TABLE `booking`
  MODIFY `BOOKING_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT για πίνακα `booking_status`
--
ALTER TABLE `booking_status`
  MODIFY `B_STATUS_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_Booking_Status1` FOREIGN KEY (`booking_status_B_STATUS_ID`) REFERENCES `booking_status` (`B_STATUS_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Booking_Users1` FOREIGN KEY (`USERS_USER_ID`) REFERENCES `users` (`USER_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Περιορισμοί για πίνακα `tables_booked`
--
ALTER TABLE `tables_booked`
  ADD CONSTRAINT `fk_TABLES_BOOKED_TABLES1` FOREIGN KEY (`TABLES_TABLE_CODE`) REFERENCES `tables` (`TABLE_CODE`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TABLES_has_Booking_Booking1` FOREIGN KEY (`Booking_BOOKING_ID`) REFERENCES `booking` (`BOOKING_ID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Περιορισμοί για πίνακα `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`UserLevels_USERLEVEL_ID`) REFERENCES `userlevels` (`USERLEVEL_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
