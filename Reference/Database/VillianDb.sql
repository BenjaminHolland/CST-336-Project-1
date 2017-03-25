-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2017 at 08:55 PM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 7.0.15-1+deb.sury.org~trusty+1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `VDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Contract`
--

DROP TABLE IF EXISTS `Contract`;
CREATE TABLE IF NOT EXISTS `Contract` (
  `Id` int(11) NOT NULL,
  `VillianId` int(11) NOT NULL,
  `HenchpersonId` int(11) NOT NULL,
  `WhenOpened` datetime NOT NULL,
  `ContractStatusId` int(11) NOT NULL,
  `Salary` decimal(11,2) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `VillianId` (`VillianId`,`HenchpersonId`),
  KEY `HenchpersonId` (`HenchpersonId`),
  KEY `ContractStatusId` (`ContractStatusId`),
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `Contract`
--

TRUNCATE TABLE `Contract`;
--
-- Dumping data for table `Contract`
--

INSERT INTO `Contract` (`Id`, `VillianId`, `HenchpersonId`, `WhenOpened`, `ContractStatusId`) VALUES
(0, 0, 1, '2017-03-25 20:44:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ContractStatus`
--

DROP TABLE IF EXISTS `ContractStatus`;
CREATE TABLE IF NOT EXISTS `ContractStatus` (
  `Id` int(11) NOT NULL,
  `Description` varchar(64) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `ContractStatus`
--

TRUNCATE TABLE `ContractStatus`;
--
-- Dumping data for table `ContractStatus`
--

INSERT INTO `ContractStatus` (`Id`, `Description`) VALUES
(0, 'Complete'),
(1, 'Incomplete');

-- --------------------------------------------------------

--
-- Table structure for table `Henchperson`
--

DROP TABLE IF EXISTS `Henchperson`;
CREATE TABLE IF NOT EXISTS `Henchperson` (
  `Id` int(11) NOT NULL,
  `Title` varchar(64) NOT NULL,
  `Description` varchar(1024) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `Henchperson`
--

TRUNCATE TABLE `Henchperson`;
--
-- Dumping data for table `Henchperson`
--

INSERT INTO `Henchperson` (`Id`, `Title`, `Description`) VALUES
(0, 'The Arachnid Brigade', 'A nasty swarm of tiny spiders to scare your enemies'),
(1, 'Dr. Boom', 'A disturbed chemist highly skilled in the art of making things go boom.');

-- --------------------------------------------------------

--
-- Table structure for table `HenchpersonSpeciality`
--

DROP TABLE IF EXISTS `HenchpersonSpeciality`;
CREATE TABLE IF NOT EXISTS `HenchpersonSpeciality` (
  `HenchpersonId` int(11) NOT NULL,
  `SpecialityId` int(11) NOT NULL,
  PRIMARY KEY (`HenchpersonId`,`SpecialityId`),
  KEY `SpecialityId` (`SpecialityId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `HenchpersonSpeciality`
--

TRUNCATE TABLE `HenchpersonSpeciality`;
--
-- Dumping data for table `HenchpersonSpeciality`
--

INSERT INTO `HenchpersonSpeciality` (`HenchpersonId`, `SpecialityId`) VALUES
(0, 0),
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Speciality`
--

DROP TABLE IF EXISTS `Speciality`;
CREATE TABLE IF NOT EXISTS `Speciality` (
  `Id` int(11) NOT NULL,
  `Description` varchar(64) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `Speciality`
--

TRUNCATE TABLE `Speciality`;
--
-- Dumping data for table `Speciality`
--

INSERT INTO `Speciality` (`Id`, `Description`) VALUES
(0, 'Fear'),
(1, 'Mayhem');

-- --------------------------------------------------------

--
-- Table structure for table `Villian`
--

DROP TABLE IF EXISTS `Villian`;
CREATE TABLE IF NOT EXISTS `Villian` (
  `Id` int(11) NOT NULL,
  `NamePrefix` varchar(16) DEFAULT NULL,
  `NameFirst` varchar(64) NOT NULL,
  `NameLast` varchar(64) DEFAULT NULL,
  `NameSuffix` varchar(16) DEFAULT NULL,
  `DropLat` double NOT NULL,
  `DropLon` double NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `Villian`
--

TRUNCATE TABLE `Villian`;
--
-- Dumping data for table `Villian`
--

INSERT INTO `Villian` (`Id`, `NamePrefix`, `NameFirst`, `NameLast`, `NameSuffix`, `DropLat`, `DropLon`) VALUES
(0, 'Dr.', 'Samantha', 'Bohemian', NULL, 0, 0),
(1, 'Mistress', 'Eve', 'Night', NULL, 0, 0),
(2, 'The', 'Crank', NULL, 'Jr.', 0, 0),
(3, 'Mr.', 'Master', 'Sir', 'Sr.', 0, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Contract`
--
ALTER TABLE `Contract`
  ADD CONSTRAINT `Contract_ibfk_3` FOREIGN KEY (`ContractStatusId`) REFERENCES `ContractStatus` (`Id`),
  ADD CONSTRAINT `Contract_ibfk_1` FOREIGN KEY (`VillianId`) REFERENCES `Villian` (`Id`),
  ADD CONSTRAINT `Contract_ibfk_2` FOREIGN KEY (`HenchpersonId`) REFERENCES `Henchperson` (`Id`);

--
-- Constraints for table `HenchpersonSpeciality`
--
ALTER TABLE `HenchpersonSpeciality`
  ADD CONSTRAINT `HenchpersonSpeciality_ibfk_2` FOREIGN KEY (`SpecialityId`) REFERENCES `Speciality` (`Id`),
  ADD CONSTRAINT `HenchpersonSpeciality_ibfk_1` FOREIGN KEY (`HenchpersonId`) REFERENCES `Henchperson` (`Id`);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
