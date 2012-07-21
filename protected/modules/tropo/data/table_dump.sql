-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 21, 2012 at 04:58 AM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sms_roulette`
--

-- --------------------------------------------------------

--
-- Table structure for table `cid_vcid_lookup`
--

CREATE TABLE IF NOT EXISTS `cid_vcid_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(2) NOT NULL,
  `vcid` int(2) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 = inactive, 1 = active',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `vcid` (`vcid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sms_messages`
--

CREATE TABLE IF NOT EXISTS `sms_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cvid` int(11) NOT NULL COMMENT 'connect4ed to cid_vcid_lookup table',
  `sms_msg` varchar(500) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `cvid` (`cvid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sms_pairs`
--

CREATE TABLE IF NOT EXISTS `sms_pairs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alice_cvid` int(11) NOT NULL,
  `bob_cvid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 = inactive, 1 = active',
  PRIMARY KEY (`id`),
  KEY `alice_cvid` (`alice_cvid`),
  KEY `bob_cvid` (`bob_cvid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sms_messages`
--
ALTER TABLE `sms_messages`
  ADD CONSTRAINT `sms_messages_ibfk_2` FOREIGN KEY (`cvid`) REFERENCES `cid_vcid_lookup` (`id`),
  ADD CONSTRAINT `sms_messages_ibfk_1` FOREIGN KEY (`cvid`) REFERENCES `cid_vcid_lookup` (`id`);

--
-- Constraints for table `sms_pairs`
--
ALTER TABLE `sms_pairs`
  ADD CONSTRAINT `sms_pairs_ibfk_3` FOREIGN KEY (`bob_cvid`) REFERENCES `cid_vcid_lookup` (`id`),
  ADD CONSTRAINT `sms_pairs_ibfk_1` FOREIGN KEY (`alice_cvid`) REFERENCES `cid_vcid_lookup` (`id`),
  ADD CONSTRAINT `sms_pairs_ibfk_2` FOREIGN KEY (`bob_cvid`) REFERENCES `cid_vcid_lookup` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;