-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 13, 2011 at 11:08 AM
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
-- Table structure for table `money_back`
--

CREATE TABLE IF NOT EXISTS `money_back` (
  `moneyBackId` int(11) NOT NULL AUTO_INCREMENT,
  `moneyNegocioId` int(11) NOT NULL,
  `moneyUsuarioEmail` varchar(200) COLLATE utf8_bin NOT NULL,
  `moneyFolioFactura` varchar(500) COLLATE utf8_bin NOT NULL,
  `moneyMontoConsumo` double NOT NULL,
  `moneyBackOtorgado` double NOT NULL,
  `moneyCategoriaDescuento` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`moneyBackId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `money_back`
--

