-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2018 at 11:40 AM
-- Server version: 10.1.18-MariaDB
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `djadi`
--

-- --------------------------------------------------------

--
-- Table structure for table `Answer`
--

CREATE TABLE `Answer` (
  `idAnswer` int(10) UNSIGNED NOT NULL,
  `user` varchar(25) NOT NULL,
  `idProposition` int(10) UNSIGNED NOT NULL,
  `idScheduler` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Participant`
--

CREATE TABLE `Participant` (
  `idParticipant` int(10) UNSIGNED NOT NULL,
  `idPoll` varchar(64) NOT NULL,
  `idUser` varchar(25) NOT NULL,
  `participate` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ParticipantAvailability`
--

CREATE TABLE `ParticipantAvailability` (
  `idParticipantAvailability` int(10) UNSIGNED NOT NULL,
  `idPoll` varchar(64) NOT NULL,
  `idParticipant` int(10) UNSIGNED NOT NULL,
  `idScheduler` int(11) UNSIGNED NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Poll`
--

CREATE TABLE `Poll` (
  `idPoll` varchar(64) NOT NULL,
  `creator` varchar(25) NOT NULL,
  `title` varchar(25) NOT NULL,
  `place` varchar(25) NOT NULL,
  `description` varchar(500) NOT NULL,
  `start` tinyint(1) NOT NULL DEFAULT '0',
  `over` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Proposition`
--

CREATE TABLE `Proposition` (
  `idProposition` int(10) UNSIGNED NOT NULL,
  `idPoll` varchar(64) NOT NULL,
  `proposition` varchar(255) NOT NULL,
  `value` smallint(5) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Scheduler`
--

CREATE TABLE `Scheduler` (
  `idScheduler` int(11) UNSIGNED NOT NULL,
  `idPoll` varchar(64) NOT NULL,
  `year` smallint(5) UNSIGNED NOT NULL DEFAULT '2018',
  `month` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `day` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `hourstart` tinyint(23) UNSIGNED NOT NULL DEFAULT '0',
  `minutestart` tinyint(59) UNSIGNED NOT NULL DEFAULT '0',
  `hourend` tinyint(23) UNSIGNED NOT NULL DEFAULT '0',
  `minuteend` tinyint(59) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `login` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Answer`
--
ALTER TABLE `Answer`
  ADD PRIMARY KEY (`idAnswer`),
  ADD UNIQUE KEY `user` (`user`,`idProposition`,`idScheduler`),
  ADD KEY `AnswerProposition` (`idProposition`),
  ADD KEY `AnswerScheduler` (`idScheduler`);

--
-- Indexes for table `Participant`
--
ALTER TABLE `Participant`
  ADD PRIMARY KEY (`idParticipant`),
  ADD UNIQUE KEY `idPoll` (`idPoll`,`idUser`),
  ADD KEY `ParticipantUser` (`idUser`);

--
-- Indexes for table `ParticipantAvailability`
--
ALTER TABLE `ParticipantAvailability`
  ADD PRIMARY KEY (`idParticipantAvailability`),
  ADD UNIQUE KEY `idParticipant` (`idParticipant`,`idScheduler`),
  ADD UNIQUE KEY `idParticipant_2` (`idParticipant`,`idScheduler`,`idPoll`),
  ADD KEY `PAScheduler` (`idScheduler`);

--
-- Indexes for table `Poll`
--
ALTER TABLE `Poll`
  ADD PRIMARY KEY (`idPoll`),
  ADD KEY `PollUser` (`creator`);

--
-- Indexes for table `Proposition`
--
ALTER TABLE `Proposition`
  ADD PRIMARY KEY (`idProposition`),
  ADD UNIQUE KEY `idPoll` (`idPoll`,`proposition`);

--
-- Indexes for table `Scheduler`
--
ALTER TABLE `Scheduler`
  ADD PRIMARY KEY (`idScheduler`),
  ADD UNIQUE KEY `idPoll` (`idPoll`,`hourstart`,`minutestart`,`hourend`,`minuteend`,`day`,`month`,`year`) USING BTREE;

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Participant`
--
ALTER TABLE `Participant`
  MODIFY `idParticipant` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `Proposition`
--
ALTER TABLE `Proposition`
  MODIFY `idProposition` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `Scheduler`
--
ALTER TABLE `Scheduler`
  MODIFY `idScheduler` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Answer`
--
ALTER TABLE `Answer`
  ADD CONSTRAINT `AnswerProposition` FOREIGN KEY (`idProposition`) REFERENCES `Proposition` (`idProposition`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AnswerScheduler` FOREIGN KEY (`idScheduler`) REFERENCES `Scheduler` (`idScheduler`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AnswerUser` FOREIGN KEY (`user`) REFERENCES `User` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Participant`
--
ALTER TABLE `Participant`
  ADD CONSTRAINT `ParticipantPoll` FOREIGN KEY (`idPoll`) REFERENCES `Poll` (`idPoll`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ParticipantUser` FOREIGN KEY (`idUser`) REFERENCES `User` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ParticipantAvailability`
--
ALTER TABLE `ParticipantAvailability`
  ADD CONSTRAINT `PAP` FOREIGN KEY (`idParticipant`) REFERENCES `Participant` (`idParticipant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PAScheduler` FOREIGN KEY (`idScheduler`) REFERENCES `Scheduler` (`idScheduler`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Poll`
--
ALTER TABLE `Poll`
  ADD CONSTRAINT `PollUser` FOREIGN KEY (`creator`) REFERENCES `User` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Proposition`
--
ALTER TABLE `Proposition`
  ADD CONSTRAINT `PropositionPoll` FOREIGN KEY (`idPoll`) REFERENCES `Poll` (`idPoll`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Scheduler`
--
ALTER TABLE `Scheduler`
  ADD CONSTRAINT `SchedulerPoll` FOREIGN KEY (`idPoll`) REFERENCES `Poll` (`idPoll`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
