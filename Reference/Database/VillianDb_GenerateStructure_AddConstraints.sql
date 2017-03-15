-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2017 at 06:14 PM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 7.0.15-1+deb.sury.org~trusty+1


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Henchperson`
--
ALTER TABLE `Henchperson`
  ADD CONSTRAINT `FK_HenchpersonSpeciality` FOREIGN KEY (`SpecialityId`) REFERENCES `Speciality` (`SpecialityId`),
  ADD CONSTRAINT `FK_HenchpersonHenchpersonStatus` FOREIGN KEY (`HenchpersonStatusId`) REFERENCES `HenchpersonStatus` (`HenchpersonStatusId`);

--
-- Constraints for table `Order`
--
ALTER TABLE `Order`
  ADD CONSTRAINT `FK_OrderOrderStatus` FOREIGN KEY (`OrderStatusId`) REFERENCES `OrderStatus` (`OrderStatusId`),
  ADD CONSTRAINT `FK_OrderVillian` FOREIGN KEY (`VillianId`) REFERENCES `Villian` (`VillianId`);

--
-- Constraints for table `OrderLine`
--
ALTER TABLE `OrderLine`
  ADD CONSTRAINT `FK_OrderHenchperson` FOREIGN KEY (`HenchpersonId`) REFERENCES `Henchperson` (`HenchpersonId`),
  ADD CONSTRAINT `FK_OrderLineOrder` FOREIGN KEY (`OrderId`) REFERENCES `Order` (`OrderId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;