-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 03, 2012 at 04:43 PM
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
-- Table structure for table `money_total`
--

CREATE TABLE IF NOT EXISTS `money_total` (
  `moneyTotalUsuarioId` int(11) NOT NULL COMMENT 'id del usuario',
  `moneyTotalGanadoUsuario` double NOT NULL COMMENT 'dinero total obtenido por el usuario hasta el momento',
  PRIMARY KEY (`moneyTotalUsuarioId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabla para guardar el total, llave primaria el id del usuari';

--
-- Dumping data for table `money_total`
--

