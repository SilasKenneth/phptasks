-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2016 at 06:06 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `andela`
--
CREATE DATABASE IF NOT EXISTS `andela` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `andela`;

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

DROP TABLE IF EXISTS `requirements`;
CREATE TABLE IF NOT EXISTS `requirements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `projectrole` text NOT NULL,
  `dependencies` varchar(300) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`id`, `name`, `projectrole`, `dependencies`, `status`) VALUES
(1, 'Angular material', 'This is a Library that would be required to manage my general UI design and Responsiveness of the website', 'Angular Javascript Library', 1),
(2, 'Angular Javascript Library', 'This will be used for the general routing and directives involved in making the coding of SPA very easy', 'Jquery Javascript Library', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `taskid` int(11) NOT NULL AUTO_INCREMENT,
  `tasktitle` varchar(50) NOT NULL,
  `tasknotes` text NOT NULL,
  `begindate` date NOT NULL,
  `endson` date NOT NULL,
  `endedon` varchar(10) DEFAULT '0000-00-00',
  `progress` int(11) NOT NULL,
  PRIMARY KEY (`taskid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`taskid`, `tasktitle`, `tasknotes`, `begindate`, `endson`, `endedon`, `progress`) VALUES
(1, 'Designing the User interface', 'Refix the user interface so that its mobile responsive,Adding the mobile navigation and refix text overfow,Combining all the dividers and making it look nicer,Avoid repeating yourself', '2016-10-01', '2016-10-20', '2016-10-05', 90),
(2, 'Review the Database', 'Reconnect to database using PDO,\r\nEscape all the strings', '2016-10-02', '2016-10-11', '2016-10-11', 78),
(3, 'Blender support', 'Add blender API to the webversion', '2016-10-26', '2016-10-27', '0000-00-00', 78);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
