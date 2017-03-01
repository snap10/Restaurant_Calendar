-- phpMyAdmin SQL Dump
-- version 4.2.12
-- http://www.phpmyadmin.net
--
-- Host: rdbms
-- Erstellungszeit: 01. Mrz 2017 um 13:40
-- Server Version: 5.5.52-log
-- PHP-Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `DB2541957`
--
CREATE DATABASE IF NOT EXISTS `restaurant_calendar` DEFAULT CHARACTER SET latin1 COLLATE latin1_german1_ci;
USE `restaurant_calendar`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
`idBooking` int(11) NOT NULL,
  `Client_idClient` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `startDateTime` datetime DEFAULT NULL,
  `endDateTime` datetime DEFAULT NULL,
  `createTimeStamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedTimeStamp` timestamp NULL DEFAULT NULL,
  `approveDenyTimeStamp` timestamp NULL DEFAULT NULL,
  `bookingstate` int(11) NOT NULL,
  `uniqueCode` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `booking_has_feature`
--

DROP TABLE IF EXISTS `booking_has_feature`;
CREATE TABLE IF NOT EXISTS `booking_has_feature` (
  `Booking_idBooking` int(11) NOT NULL,
  `Feature_idFeature` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
`idClient` int(11) NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `surename` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `street` varchar(45) DEFAULT NULL,
  `numbr` varchar(45) DEFAULT NULL,
  `zipcode` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `division` varchar(40) NOT NULL DEFAULT 'Nicht angegeben'
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `features`
--

DROP TABLE IF EXISTS `features`;
CREATE TABLE IF NOT EXISTS `features` (
`idFeature` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `picturepath` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `enable` int(11) NOT NULL DEFAULT '1',
  `regDateTime` datetime NOT NULL,
  `salt` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `venues`
--

DROP TABLE IF EXISTS `venues`;
CREATE TABLE IF NOT EXISTS `venues` (
`idVenue` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `picturepath` varchar(2000) DEFAULT NULL,
  `featurelist` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `venues_has_booking`
--

DROP TABLE IF EXISTS `venues_has_booking`;
CREATE TABLE IF NOT EXISTS `venues_has_booking` (
  `Venue_idVenue` int(11) NOT NULL,
  `Booking_idBooking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `venue_has_feature`
--

DROP TABLE IF EXISTS `venue_has_feature`;
CREATE TABLE IF NOT EXISTS `venue_has_feature` (
  `Venue_idVenue` int(11) NOT NULL,
  `Feature_idFeature` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bookings`
--
ALTER TABLE `bookings`
 ADD PRIMARY KEY (`idBooking`), ADD UNIQUE KEY `idBooking_UNIQUE` (`idBooking`), ADD KEY `fk_Booking_Client1_idx` (`Client_idClient`);

--
-- Indizes für die Tabelle `booking_has_feature`
--
ALTER TABLE `booking_has_feature`
 ADD PRIMARY KEY (`Booking_idBooking`,`Feature_idFeature`), ADD KEY `fk_Booking_has_Feature_Feature1_idx` (`Feature_idFeature`), ADD KEY `fk_Booking_has_Feature_Booking1_idx` (`Booking_idBooking`);

--
-- Indizes für die Tabelle `clients`
--
ALTER TABLE `clients`
 ADD PRIMARY KEY (`idClient`), ADD UNIQUE KEY `idClient_UNIQUE` (`idClient`);

--
-- Indizes für die Tabelle `features`
--
ALTER TABLE `features`
 ADD PRIMARY KEY (`idFeature`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`,`userEmail`);

--
-- Indizes für die Tabelle `venues`
--
ALTER TABLE `venues`
 ADD PRIMARY KEY (`idVenue`), ADD UNIQUE KEY `idVenue_UNIQUE` (`idVenue`);

--
-- Indizes für die Tabelle `venues_has_booking`
--
ALTER TABLE `venues_has_booking`
 ADD PRIMARY KEY (`Venue_idVenue`,`Booking_idBooking`), ADD KEY `fk_Venue_has_Booking_Booking1_idx` (`Booking_idBooking`), ADD KEY `fk_Venue_has_Booking_Venue1_idx` (`Venue_idVenue`);

--
-- Indizes für die Tabelle `venue_has_feature`
--
ALTER TABLE `venue_has_feature`
 ADD PRIMARY KEY (`Venue_idVenue`,`Feature_idFeature`), ADD KEY `fk_Venue_has_Feature_Feature1_idx` (`Feature_idFeature`), ADD KEY `fk_Venue_has_Feature_Venue1_idx` (`Venue_idVenue`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bookings`
--
ALTER TABLE `bookings`
MODIFY `idBooking` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT für Tabelle `clients`
--
ALTER TABLE `clients`
MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=118;
--
-- AUTO_INCREMENT für Tabelle `features`
--
ALTER TABLE `features`
MODIFY `idFeature` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT für Tabelle `venues`
--
ALTER TABLE `venues`
MODIFY `idVenue` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bookings`
--
ALTER TABLE `bookings`
ADD CONSTRAINT `fk_Booking_Client1` FOREIGN KEY (`Client_idClient`) REFERENCES `clients` (`idClient`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `booking_has_feature`
--
ALTER TABLE `booking_has_feature`
ADD CONSTRAINT `fk_Booking_has_Feature_Booking1` FOREIGN KEY (`Booking_idBooking`) REFERENCES `bookings` (`idBooking`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Booking_has_Feature_Feature1` FOREIGN KEY (`Feature_idFeature`) REFERENCES `features` (`idFeature`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `venues_has_booking`
--
ALTER TABLE `venues_has_booking`
ADD CONSTRAINT `fk_Venue_has_Booking_Booking1` FOREIGN KEY (`Booking_idBooking`) REFERENCES `bookings` (`idBooking`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Venue_has_Booking_Venue1` FOREIGN KEY (`Venue_idVenue`) REFERENCES `venues` (`idVenue`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `venue_has_feature`
--
ALTER TABLE `venue_has_feature`
ADD CONSTRAINT `fk_Venue_has_Feature_Feature1` FOREIGN KEY (`Feature_idFeature`) REFERENCES `features` (`idFeature`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Venue_has_Feature_Venue1` FOREIGN KEY (`Venue_idVenue`) REFERENCES `venues` (`idVenue`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
