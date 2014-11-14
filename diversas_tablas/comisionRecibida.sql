-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2011 at 04:58 PM
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
-- Table structure for table `comisionRecibida`
--

CREATE TABLE IF NOT EXISTS `comisionRecibida` (
  `comisionRecibidaId` int(11) NOT NULL AUTO_INCREMENT,
  `comisionRecibidaEmpresaId` int(11) NOT NULL,
  `comisionRecibidaUsuarioId` int(11) NOT NULL,
  `comisionRecibidaFolioTransaccion` varchar(300) COLLATE utf8_bin NOT NULL,
  `comisionRecibidaUsuarioBonificacion` double NOT NULL,
  `comisionRecibidaBonificacionZavor` double NOT NULL,
  `comisionRecibidaNumeroReferencia` varchar(200) COLLATE utf8_bin NOT NULL,
  `comisionRecibidaFechaTransaccion` int(11) NOT NULL,
  `comisionRecibidaHistorialId` int(11) NOT NULL,
  PRIMARY KEY (`comisionRecibidaId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Comisiones que cobrara ZavorDigital a las transacciones reci' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comisionRecibida`
--

INSERT INTO `comisionRecibida` (`comisionRecibidaId`, `comisionRecibidaEmpresaId`, `comisionRecibidaUsuarioId`, `comisionRecibidaFolioTransaccion`, `comisionRecibidaUsuarioBonificacion`, `comisionRecibidaBonificacionZavor`, `comisionRecibidaNumeroReferencia`, `comisionRecibidaFechaTransaccion`, `comisionRecibidaHistorialId`) VALUES
(1, 7, 1, '2345', 151.632, 4.368, '4a3064fbd15e03fb2ee5e20fd3d23f643879413e', 1319778000, 0);
