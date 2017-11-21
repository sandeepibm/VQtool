-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2012 at 05:58 PM
-- Server version: 5.0.22
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


--
-- 
Database: `inv`
--

-- --------------------------------------------------------

--
-- Table structure for table `changeownership`
--



CREATE TABLE IF NOT EXISTS `changeownership` (
  `hostname` varchar(50) NOT NULL,
  `oldproject` varchar(50) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `newowner` varchar(50) NOT NULL,
  `requestdate` datetime NOT NULL,
  `accepteddate` datetime NOT NULL,
  `accepted` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `closedrequests`
--



CREATE TABLE IF NOT EXISTS `closedrequests` (
  `id` int(10) NOT NULL,
  `hostname` varchar(100) NOT NULL,
  `ram` varchar(20) NOT NULL,
  `cpu` varchar(20) NOT NULL,
  `storagespace` varchar(20) NOT NULL,
  `os` varchar(100) NOT NULL,
  `ipaddress` varchar(30) NOT NULL,
  `closeddate` datetime NOT NULL,
  `assignedto` varchar(100) NOT NULL,
  `closedby` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `closedrequests`
--



-- --------------------------------------------------------

--
-- Table structure for table `releasesystem`
--



CREATE TABLE IF NOT EXISTS `releasesystem` (
  `id` int(11) NOT NULL auto_increment,
  `hostname` varchar(30) NOT NULL,
  `projectname` varchar(30) NOT NULL,
  `comments` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `releasedate` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
--------------------------------------------------------

--
-- Table structure for table `requestsystem`
--


CREATE TABLE IF NOT EXISTS `requestsystem` (
  `id` int(10) NOT NULL auto_increment,
  `projectname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `ram` varchar(20) NOT NULL,
  `cpu` varchar(20) NOT NULL,
  `os` varchar(50) NOT NULL,
  `storage` varchar(30) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `requestdate` datetime NOT NULL,
  `releasedate` date NOT NULL,
  `approval` int(5) NOT NULL,
  `approvedby` varchar(50) NOT NULL,
  `approvaltime` datetime NOT NULL,
  `admincomments` varchar(500) NOT NULL,
  `status` varchar(20) NOT NULL,
  `closingtime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `requestsystem`
--

-- 

--------------------------------------------------------

--
-- Table structure for table `resourcedata`
--


CREATE TABLE IF NOT EXISTS `resourcedata` (
  `cpu` int(10) NOT NULL,
  `ram` int(10) NOT NULL,
  `storagespace` int(10) NOT NULL,
  `additiondate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resourcedata`
--



INSERT INTO `resourcedata` (`cpu`, `ram`, `storagespace`, `additiondate`) VALUES
(32, 70, 0, '2012-03-06 13:12:11'),
(432, 808, 50000, '2012-01-12 16:32:45');

-- 
--------------------------------------------------------

--
-- Table structure for table `systemdetails`
--


CREATE TABLE IF NOT EXISTS `systemdetails` (
  `hostname` varchar(30) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `os` varchar(100) NOT NULL,
  `cpu` int(5) NOT NULL,
  `ram` int(5) NOT NULL,
  `storagespace` int(20) NOT NULL,
  `projectname` varchar(50) NOT NULL,
  `assignedto` varchar(50) NOT NULL,
  `assigneddate` date NOT NULL,
  `releasedate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 

--Dumping data for table `systemdetails`
--



-- 

--------------------------------------------------------

--
-- Table structure for table `user`
--
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Age` int(10) NOT NULL,
  `Hometown` varchar(50) NOT NULL,
  `Job` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 

--------------------------------------------------------

--
-- Table structure for table `userdata`
--


CREATE TABLE IF NOT EXISTS `userdata` (
  `userid` varchar(100) default NULL,
  `userpass` varchar(150) default NULL,
  `name` varchar(100) default NULL,
  `address` varchar(50) default NULL,
  `Cubical` varchar(50) default NULL,
  `Mobile` bigint(20) default NULL,
  `Extension` varchar(11) default NULL,
  `emailaddress` varchar(90) default NULL,
  `username` varchar(100) default NULL,
  `level` int(2) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 

--Dumping data for table `userdata`
--


INSERT INTO `userdata` (`userid`, `userpass`, `name`, `address`, `Cubical`, `Mobile`, `Extension`, `emailaddress`, `username`, `level`) VALUES
('21232f297a57a5a743894a0e4a801fc3', '0192023a7bbd73250516f069df18b500', 'administrator', '', '', 9916131534, '6715', 'siva.bommisetty@in.ibm.com', 'admin', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
