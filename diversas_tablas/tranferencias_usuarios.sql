-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 02, 2012 at 04:32 PM
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
-- Table structure for table `tranferencias_usuarios`
--

CREATE TABLE IF NOT EXISTS `tranferencias_usuarios` (
  `idTransferenciaUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuarioTransferenciaUsuario` int(11) NOT NULL,
  `transferenciaNombreCompleto` varchar(200) COLLATE utf8_bin NOT NULL,
  `transferenciaApellidoPaterno` varchar(200) COLLATE utf8_bin NOT NULL,
  `transferenciaApellidoMaterno` varchar(200) COLLATE utf8_bin NOT NULL,
  `llaveUsuarioTransferencia` varchar(200) COLLATE utf8_bin NOT NULL,
  `idBancoTransferenciaUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idTransferenciaUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tranferencias_usuarios`
--

