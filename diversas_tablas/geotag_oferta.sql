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
-- Table structure for table `geotag_oferta`
--

CREATE TABLE IF NOT EXISTS `geotag_oferta` (
  `geotagofertaId` int(11) NOT NULL AUTO_INCREMENT,
  `geotagGId` int(11) NOT NULL,
  `ofertaOId` int(11) NOT NULL,
  PRIMARY KEY (`geotagofertaId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabla donde se guardaran los datos de los tagging relacionad' AUTO_INCREMENT=8 ;

--
-- Dumping data for table `geotag_oferta`
--

INSERT INTO `geotag_oferta` (`geotagofertaId`, `geotagGId`, `ofertaOId`) VALUES
(1, 158, 4),
(2, 159, 5),
(3, 160, 6),
(4, 161, 7),
(5, 162, 8),
(6, 163, 9),
(7, 164, 10);
