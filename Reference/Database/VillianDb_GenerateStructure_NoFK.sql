-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2017 at 05:54 PM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 7.0.15-1+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `VillianDb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Henchperson`
--

CREATE TABLE IF NOT EXISTS `Henchperson` (
  `HenchpersonId` int(11) NOT NULL,
  `Name` varchar(128) NOT NULL,
  `Description` varchar(1024) NOT NULL,
  `RatePerHour` decimal(10,0) NOT NULL,
  `HenchpersonStatusId` int(11) NOT NULL,
  `SpecialityId` int(11) NOT NULL,
  PRIMARY KEY (`HenchpersonId`),
  KEY `HenchpersonStatusId` (`HenchpersonStatusId`),
  KEY `SpecialityId` (`SpecialityId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HenchpersonStatus`
--

CREATE TABLE IF NOT EXISTS `HenchpersonStatus` (
  `HenchpersonStatusId` int(11) NOT NULL,
  `Description` varchar(1024) NOT NULL,
  PRIMARY KEY (`SpecialityId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Order`
--

CREATE TABLE IF NOT EXISTS `Order` (
  `OrderId` int(11) NOT NULL,
  `VillianId` int(11) NOT NULL,
  `OrderStatusId` int(11) NOT NULL,
  PRIMARY KEY (`OrderId`),
  KEY `VillianId` (`VillianId`),
  KEY `OrderStatusId` (`OrderStatusId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `OrderLine`
--

CREATE TABLE IF NOT EXISTS `OrderLine` (
  `OrderLineId` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `HenchpersonId` int(11) NOT NULL,
  PRIMARY KEY (`OrderLineId`),
  KEY `OrderId` (`OrderId`),
  KEY `HenchpersonId` (`HenchpersonId`))
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `OrderStatus`
--

CREATE TABLE IF NOT EXISTS `OrderStatus` (
  `OrderStatusId` int(11) NOT NULL,
  `Description` varchar(1024) NOT NULL,
  PRIMARY KEY (`OrderStatusId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `Villian`
--

CREATE TABLE IF NOT EXISTS `Villian` (
  `VillianId` int(11) NOT NULL,
  `Name` varchar(128) NOT NULL,
  `Address` varchar(1024) NOT NULL,
  PRIMARY KEY (`VillianId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Speciality`
--

CREATE TABLE IF NOT EXISTS `Speciality` (
  `SpecialityId` int(11) NOT NULL,
  `Description` varchar(1024) NOT NULL,
  PRIMARY KEY (`SpecialityId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
