-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 17, 2011 at 11:34 PM
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
-- Table structure for table `anexos`
--

CREATE TABLE IF NOT EXISTS `anexos` (
  `anexosId` int(11) NOT NULL AUTO_INCREMENT,
  `anexosPlanId` int(11) NOT NULL,
  `enlace` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `foto` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`anexosId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='datos de los anexos como son el link y las fotos' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `anexos`
--

INSERT INTO `anexos` (`anexosId`, `anexosPlanId`, `enlace`, `foto`) VALUES
(1, 59, 'www.zavordigital.com', NULL);
