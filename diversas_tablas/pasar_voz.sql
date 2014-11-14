-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 13, 2012 at 05:18 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.7

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
-- Table structure for table `pasar_voz`
--

CREATE TABLE IF NOT EXISTS `pasar_voz` (
  `pasarVozId` int(11) NOT NULL AUTO_INCREMENT,
  `pasarVozScribbleId` int(11) NOT NULL,
  `pasarVozUsuarioId` int(11) NOT NULL,
  `pasarVozCode` int(11) NOT NULL,
  PRIMARY KEY (`pasarVozId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pasar_voz`
--

INSERT INTO `pasar_voz` (`pasarVozId`, `pasarVozScribbleId`, `pasarVozUsuarioId`, `pasarVozCode`) VALUES
(1, 134, 1, -100),
(2, 135, 1, -100),
(3, 136, 1, -100);
