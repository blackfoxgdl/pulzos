-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2011 at 06:23 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pulzos_bueno`
--

-- --------------------------------------------------------

--
-- Table structure for table `notificacion`
--

CREATE TABLE IF NOT EXISTS `notificacion` (
  `notificaId` int(11) NOT NULL AUTO_INCREMENT,
  `notificaPlanId` int(11) NOT NULL,
  `notificaUsuarioId` int(11) NOT NULL,
  PRIMARY KEY (`notificaId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `notificacion`
--

INSERT INTO `notificacion` (`notificaId`, `notificaPlanId`, `notificaUsuarioId`) VALUES
(1, 119, 1),
(2, 119, 2);
