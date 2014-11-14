-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 02, 2011 at 07:00 PM
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
-- Table structure for table `servicios`
--

CREATE TABLE IF NOT EXISTS `servicios` (
  `serviciosId` int(11) NOT NULL AUTO_INCREMENT,
  `serviciosNegocioId` int(11) NOT NULL,
  `serviciosTarjeta` tinyint(1) DEFAULT '2',
  `serviciosReservacion` tinyint(1) DEFAULT '2',
  `serviciosEstacionamiento` tinyint(1) DEFAULT '2',
  `serviciosWifi` tinyint(1) DEFAULT '2',
  `serviciosDomicilio` tinyint(1) DEFAULT '2',
  `serviciosDiscapacidad` tinyint(1) DEFAULT '2',
  PRIMARY KEY (`serviciosId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='saber con que servicios cuenta el negocio' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `servicios`
--

INSERT INTO `servicios` (`serviciosId`, `serviciosNegocioId`, `serviciosTarjeta`, `serviciosReservacion`, `serviciosEstacionamiento`, `serviciosWifi`, `serviciosDomicilio`, `serviciosDiscapacidad`) VALUES
(1, 7, 1, 1, 0, 1, 0, 1);
