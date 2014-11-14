-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2011 at 04:57 PM
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
-- Table structure for table `historialDeposito`
--

CREATE TABLE IF NOT EXISTS `historialDeposito` (
  `idHistorial` int(11) NOT NULL AUTO_INCREMENT,
  `historialEmpresaId` int(11) NOT NULL,
  `historialTotalQuincenal` double NOT NULL,
  `historialStatusDeposito` tinyint(2) NOT NULL COMMENT '0.- No han depositado, 1.- Ya depositaron',
  `historialFechaInicio` int(11) NOT NULL,
  `historialFechaFin` int(11) NOT NULL,
  PRIMARY KEY (`idHistorial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `historialDeposito`
--

