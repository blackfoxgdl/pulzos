-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 29, 2012 at 04:23 PM
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
-- Table structure for table `bonificaciones_ie`
--

CREATE TABLE IF NOT EXISTS `bonificaciones_ie` (
  `bonificacionIe` int(11) NOT NULL AUTO_INCREMENT,
  `bonificacionIeUsuario` int(11) NOT NULL,
  `bonificacionIePlan` int(11) NOT NULL,
  `bonificacionIeFolioFactura` varchar(500) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`bonificacionIe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='bonificaciones para parchar la parte de internet explorer qu' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bonificaciones_ie`
--

