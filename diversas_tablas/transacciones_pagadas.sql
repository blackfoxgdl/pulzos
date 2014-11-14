-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 11, 2012 at 06:32 PM
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
-- Table structure for table `transacciones_pagadas`
--

CREATE TABLE IF NOT EXISTS `transacciones_pagadas` (
  `transaccionCompletaId` int(11) NOT NULL AUTO_INCREMENT,
  `transaccionUsuarioId` int(11) NOT NULL,
  `transaccionNombreUsuario` varchar(400) COLLATE utf8_bin NOT NULL,
  `transaccionEmailUsuario` varchar(200) COLLATE utf8_bin NOT NULL,
  `transaccionNegocioId` int(11) NOT NULL,
  `transaccionNombreEmpresa` varchar(400) COLLATE utf8_bin NOT NULL,
  `transaccionTotalPagar` double NOT NULL,
  `transaccionCodigoVenta` varchar(200) COLLATE utf8_bin NOT NULL,
  `transaccionFechaHora` varchar(200) COLLATE utf8_bin NOT NULL,
  `transaccionToken` varchar(200) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`transaccionCompletaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabla para guardar todas las compras que se paguen con el di' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `transacciones_pagadas`
--

