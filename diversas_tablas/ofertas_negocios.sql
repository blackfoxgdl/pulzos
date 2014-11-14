-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 19, 2011 at 02:23 PM
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
-- Table structure for table `ofertas_negocios`
--

CREATE TABLE IF NOT EXISTS `ofertas_negocios` (
  `ofertaId` int(11) NOT NULL AUTO_INCREMENT,
  `consumoMinimo` double NOT NULL,
  `bonificaPorcentaje` int(11) NOT NULL,
  `tipoDescuento` tinyint(1) NOT NULL,
  `idNegocioOferta` int(11) NOT NULL,
  `idMensajeOferta` int(11) NOT NULL COMMENT 'Dato que se identifica con la tabla de social media',
  `ofertaActivacion` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ofertaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Ofertas que tendra el negocio, dependiendo esta tabla se har' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ofertas_negocios`
--

