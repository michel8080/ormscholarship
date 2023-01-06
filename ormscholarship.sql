-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 01, 2023 at 12:36 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ormscholarship`
--

-- --------------------------------------------------------

--
-- Table structure for table `bankinfo`
--

DROP TABLE IF EXISTS `bankinfo`;
CREATE TABLE IF NOT EXISTS `bankinfo` (
  `bank_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(255) NOT NULL,
  `account_no` int(10) NOT NULL,
  `userid` int(6) UNSIGNED NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `docinfo`
--

DROP TABLE IF EXISTS `docinfo`;
CREATE TABLE IF NOT EXISTS `docinfo` (
  `doc_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `WAECdocname` varchar(300) NOT NULL,
  `WAECdocfilepath` varchar(300) NOT NULL,
  `AdmLetterdocname` varchar(300) NOT NULL,
  `Admdocfilepath` varchar(300) NOT NULL,
  `StudentIDdocname` varchar(300) NOT NULL,
  `StudentIDfilepath` text NOT NULL,
  `Transcriptdocname` varchar(300) NOT NULL,
  `Transcriptfilepath` varchar(300) NOT NULL,
  `Passportdocname` varchar(300) NOT NULL,
  `Passportfilepath` varchar(300) NOT NULL,
  `userid` int(6) UNSIGNED NOT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `educationalinfo`
--

DROP TABLE IF EXISTS `educationalinfo`;
CREATE TABLE IF NOT EXISTS `educationalinfo` (
  `edu_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `School` text NOT NULL,
  `MatricNo` varchar(100) NOT NULL,
  `Faculty` varchar(300) NOT NULL,
  `Course` varchar(300) NOT NULL,
  `AdmissionYr` varchar(20) NOT NULL,
  `GraduationYr` varchar(20) NOT NULL,
  `ProjectTitle` text NOT NULL,
  `Supervisor` varchar(300) NOT NULL,
  `SupervisorPhone` varchar(11) NOT NULL,
  `SupervisorEmail` varchar(300) NOT NULL,
  `userid` int(6) UNSIGNED NOT NULL,
  PRIMARY KEY (`edu_id`),
  UNIQUE KEY `Username` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `personalinfo`
--

DROP TABLE IF EXISTS `personalinfo`;
CREATE TABLE IF NOT EXISTS `personalinfo` (
  `pid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Firstname` varchar(100) NOT NULL,
  `Middlename` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `Gender` char(5) NOT NULL,
  `Phone` varchar(11) NOT NULL,
  `DOB` date NOT NULL,
  `Community` varchar(300) NOT NULL,
  `ContactAddress` text NOT NULL,
  `HomeAddress` text NOT NULL,
  `FatherLGACommunity` varchar(100) NOT NULL,
  `MotherLGACommunity` varchar(300) NOT NULL,
  `NOK` varchar(300) NOT NULL,
  `NOKPhone` int(11) NOT NULL,
  `Email` varchar(300) NOT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
