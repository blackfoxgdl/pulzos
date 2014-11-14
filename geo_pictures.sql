-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 06, 2012 at 12:48 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.10

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
-- Table structure for table `geo_pictures`
--

CREATE TABLE IF NOT EXISTS `geo_pictures` (
  `geoPictureId` int(11) NOT NULL AUTO_INCREMENT,
  `geoPictureIdTag` int(11) NOT NULL COMMENT 'id del scribble que se esta generando',
  `geoPictureImgNormal` varchar(400) COLLATE utf8_bin NOT NULL,
  `geoPictureImgThumb` varchar(400) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`geoPictureId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabla para guardar las imagenes o videos que se pondran en g' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `geo_pictures`
--

