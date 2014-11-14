-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 15, 2011 at 11:44 AM
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
-- Table structure for table `apadrinanegocio`
--

CREATE TABLE IF NOT EXISTS `apadrinanegocio` (
  `apadrinaNegocioId` int(11) NOT NULL AUTO_INCREMENT,
  `apadrinaNegocioUserId` int(11) NOT NULL COMMENT 'usuarios que apadrino negocio dado de alta',
  `apadrinaNegocioNegocioId` int(11) NOT NULL COMMENT 'id del negocio de la tabla dar de alta',
  `apadrinaNegocioFechaCreacion` int(11) NOT NULL,
  PRIMARY KEY (`apadrinaNegocioId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `apadrinanegocio`
--

