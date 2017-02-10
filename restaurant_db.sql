-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 10 Φεβ 2017 στις 18:08:16
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
  `BOOKING_STATUS` varchar(30) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `booking`
--

INSERT INTO `booking` (`BOOKING_ID`, `BOOKING_DATE`, `BOOKING_TIME`, `BOOKING_TIMESTAMP`, `BOOKING_SIZE`, `USERS_USER_ID`, `SMOKING_BOOL`, `BOOKING_STATUS`) VALUES
(1, '2017-02-10', '11:07:00', '2017-02-10 17:47:09', 4, 3, 0, 'Pending'),
(2, '2017-02-10', '00:07:00', '2017-02-10 17:52:33', 4, 3, 0, 'Pending'),
(3, '2017-02-10', '02:05:00', '2017-02-10 17:53:17', 1, 3, 1, 'Pending'),
(4, '2017-02-10', '15:24:00', '2017-02-10 17:54:19', 4, 3, 1, 'Pending');

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
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `booking`
--
ALTER TABLE `booking`
  MODIFY `BOOKING_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_Booking_Users1` FOREIGN KEY (`USERS_USER_ID`) REFERENCES `users` (`USER_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
