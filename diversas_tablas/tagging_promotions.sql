-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2011 at 05:47 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.6

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
-- Table structure for table `tagging_promotions`
--

CREATE TABLE IF NOT EXISTS `tagging_promotions` (
  `taggingId` int(11) NOT NULL AUTO_INCREMENT,
  `taggingPromotionId` int(11) NOT NULL,
  `taggingFinishPromotion` int(11) NOT NULL,
  PRIMARY KEY (`taggingId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabla para guardar las promociones limitadas del negocio' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tagging_promotions`
--

