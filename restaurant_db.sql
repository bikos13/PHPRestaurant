-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 20 Φεβ 2017 στις 15:37:23
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
(1, '2017-02-10', '11:07:00', '2017-02-10 17:47:09', 4, 3, 0, 1),
(2, '2017-02-10', '00:07:00', '2017-02-10 17:52:33', 4, 3, 0, 1),
(3, '2017-02-10', '02:05:00', '2017-02-10 17:53:17', 1, 3, 1, 1),
(4, '2017-02-10', '15:24:00', '2017-02-10 17:54:19', 4, 3, 0, 1),
(6, '2017-02-10', '12:07:00', '2017-02-10 17:47:09', 4, 3, 0, 1),
(7, '2017-02-09', '11:07:00', '2017-02-10 17:47:09', 4, 3, 0, 1),
(8, '2017-02-08', '11:07:00', '2017-02-10 17:47:09', 4, 3, 0, 1),
(9, '2017-02-07', '11:07:00', '2017-02-10 17:47:09', 4, 3, 0, 1),
(10, '2017-02-06', '11:07:00', '2017-02-10 17:47:09', 4, 3, 0, 1),
(11, '2017-02-05', '11:07:00', '2017-02-10 17:47:09', 4, 3, 0, 1),
(12, '2017-02-04', '11:07:00', '2017-02-10 17:47:09', 4, 3, 0, 1),
(17, '2017-02-10', '11:02:00', '2017-02-10 17:47:09', 4, 3, 0, 1),
(18, '2017-01-10', '11:07:00', '2017-02-10 17:47:09', 4, 3, 0, 1),
(20, '2017-02-15', '17:00:00', '2017-02-14 21:25:34', 5, 5, 1, 1),
(21, '2017-02-16', '21:00:00', '2017-02-15 17:32:32', 1, 6, 0, 1),
(22, '2017-02-17', '20:00:00', '2017-02-17 17:32:13', 4, 7, 0, 1),
(23, '2017-02-17', '22:30:00', '2017-02-17 17:37:42', 8, 8, 1, 1);

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
(3, 'Cancelled', 'This reservation has been cancelled');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `storehours`
--

CREATE TABLE `storehours` (
  `DAY_ID` tinyint(1) NOT NULL,
  `DAY_NAME` text NOT NULL,
  `OPENING_HOUR` text NOT NULL,
  `CLOSING_HOUR` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `storehours`
--

INSERT INTO `storehours` (`DAY_ID`, `DAY_NAME`, `OPENING_HOUR`, `CLOSING_HOUR`) VALUES
(1, 'mon', '14:00', '22:00'),
(2, 'tue', '16:00', '00:00'),
(3, 'wed', '14:00', '22:00'),
(4, 'thu', '16:00', '00:00'),
(5, 'fri', '16:00', '00:00'),
(6, 'sat', '14:00', '00:00'),
(7, 'sun', '16:00', '00:00');

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
(0, 'Guest', 'This is a guest user', 0),
(1, 'Member', 'This is a member user', 0),
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
(5, 'Markos', 'Polos', 'marco25', '25d55ad283aa400af464c76d713c07ad', 'markopolo@mark.gr', '210', '6948511221', 1, '2017-02-14 21:07:58'),
(6, 'emily', 'fakou', 'emily', '6fb42da0e32e07b61c9f0251fe627a9c', 'emi-111@hotmail.com', '6972421217', 'prits!', 1, '2017-02-15 17:30:26'),
(7, 'Stratos', 'Tsakmaz', 'Stratos', 'baf84ec366b50ec64d5624fc9a6f7df6', 'tsakmazstratos@gmail.com', '6985034960', '', 1, '2017-02-17 17:30:27'),
(8, 'Pavlos', 'Kolovos', 'Pavlos', '7732257fd91a643262f795bc38bfc9b0', 'pavlos@hotmail.com', '2930293889', '', 1, '2017-02-17 17:36:48');

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
  MODIFY `BOOKING_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT για πίνακα `booking_status`
--
ALTER TABLE `booking_status`
  MODIFY `B_STATUS_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
  ADD CONSTRAINT `fk_TABLES_BOOKED_TABLES1` FOREIGN KEY (`TABLES_TABLE_CODE`) REFERENCES `tables` (`TABLE_CODE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TABLES_has_Booking_Booking1` FOREIGN KEY (`Booking_BOOKING_ID`) REFERENCES `booking` (`BOOKING_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Περιορισμοί για πίνακα `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`UserLevels_USERLEVEL_ID`) REFERENCES `userlevels` (`USERLEVEL_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
