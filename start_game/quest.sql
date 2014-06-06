-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2014 at 01:32 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `quest`
--
CREATE DATABASE IF NOT EXISTS `quest` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `quest`;

-- --------------------------------------------------------

--
-- Table structure for table `market`
--

CREATE TABLE IF NOT EXISTS `market` (
  `ItemID` tinyint(3) unsigned NOT NULL COMMENT 'The item ID.',
  `Price` decimal(30,2) unsigned NOT NULL DEFAULT '0.00' COMMENT 'The cost, in gold coins.',
  `BuySellHistory` int(11) NOT NULL DEFAULT '0' COMMENT 'The buy/sell history. Positive for things bought, negative for things sold.',
  PRIMARY KEY (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `playerdata`
--

CREATE TABLE IF NOT EXISTS `playerdata` (
  `UserID` int(10) unsigned NOT NULL,
  `Inventory1` text NOT NULL,
  `Inventory2` text NOT NULL,
  `Inventory3` text NOT NULL,
  `Inventory4` text NOT NULL,
  `Building` char(100) NOT NULL DEFAULT '1111111111100000000110000000011000000001100000000110000000011000000001100000000110000000011111111111',
  UNIQUE KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This stores stuffz about the player.';

--
-- Dumping data for table `playerdata`
--

INSERT INTO `playerdata` (`UserID`, `Inventory1`, `Inventory2`, `Inventory3`, `Inventory4`, `Building`) VALUES
(5, '0;0;0;0;0;0;0;0;0;0;0;0;10;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;', '0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;', '0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;', '0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;', '1111111111100000000110000000011000000001100000000110000000011000000001100000000110000000011111111111'),
(6, '0;0;0;0;0;0;0;0;0;0;0;0;10;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;', '0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;', '0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;', '0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;', '0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
