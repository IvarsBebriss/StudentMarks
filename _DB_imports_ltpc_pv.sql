-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 04, 2019 at 01:44 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ltpc_pv`
--

-- --------------------------------------------------------

--
-- Table structure for table `studenti`
--

CREATE TABLE IF NOT EXISTS `studenti` (
  `id_stud` int(11) NOT NULL AUTO_INCREMENT,
  `vards` varchar(40) COLLATE utf8mb4_bin NOT NULL,
  `uzvards` varchar(40) COLLATE utf8mb4_bin NOT NULL,
  `epasts` varchar(45) COLLATE utf8mb4_bin NOT NULL,
  `grupa` varchar(4) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id_stud`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `studenti`
--

INSERT INTO `studenti` (`id_stud`, `vards`, `uzvards`, `epasts`, `grupa`) VALUES
(22, 'Ivars', 'Bērziņš 1', 'janis@janis.com', '3'),
(23, 'Ivars', 'Bērziņš 5', 'ivars@ivars.com', '32'),
(27, 'Andris', 'Bērziņš 2', 'ivars@ivars.com', '322');

--
-- Table structure for table `atzimes`
--

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `atzimes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_stud` int(11) NOT NULL,
  `pd1` int(11) DEFAULT NULL,
  `pd2` int(11) DEFAULT NULL,
  `pd3` int(11) DEFAULT NULL,
  `iesk` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `atzimes_ibfk_1` FOREIGN KEY (`id_stud`) REFERENCES `studenti` (`id_stud`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `atzimes`
--

INSERT INTO `atzimes` (`id`, `id_stud`, `pd1`, `pd2`, `pd3`, `iesk`) VALUES
(9, 27, 3, 2, 6, 7);

-- --------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
