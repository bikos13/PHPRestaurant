-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 18 Ιαν 2017 στις 13:21:29
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
  `BOOKING_TIMESTAMP` timestamp NULL DEFAULT NULL,
  `BOOKING_SIZE` int(11) DEFAULT NULL,
  `USERS_USER_ID` int(11) NOT NULL,
  `SMOKING_BOOL` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `tables`
--

CREATE TABLE `tables` (
  `TABLE_CODE` varchar(45) NOT NULL,
  `TABLE_SIZE` int(11) NOT NULL DEFAULT '4',
  `SMOKING` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(10, 'Administrator', 'This is Administrator above all user', 10);

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
(3, 'Constantine', 'Stathis', 'bikos13', '25d55ad283aa400af464c76d713c07ad', 'constantinos-@hotmail.com', '6948621978', '', 1, '2017-01-18 11:44:58'),
(4, 'Aimilia', 'Fakoy', 'mama13', 'b4e22cf9b4620df31df84584b2992e61', 'emi-111@hotmail.com', '69448406977', '', 1, '2017-01-18 11:46:38');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BOOKING_ID`,`USERS_USER_ID`),
  ADD KEY `fk_Booking_Users1_idx` (`USERS_USER_ID`);

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
  MODIFY `BOOKING_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `booking`
--
ALTER TABLE `booking`
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
