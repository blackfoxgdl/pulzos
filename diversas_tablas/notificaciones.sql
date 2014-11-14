-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 11, 2011 at 06:00 PM
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
-- Table structure for table `notificaciones`
--

CREATE TABLE IF NOT EXISTS `notificaciones` (
  `notificacionId` int(11) NOT NULL AUTO_INCREMENT,
  `notificacionUsuarioId` int(11) NOT NULL,
  `notificacionPlanId` int(11) NOT NULL,
  `notificacionStatus` int(11) NOT NULL,
  `notificacionLeido` int(11) NOT NULL,
  `notificacionTipo` int(11) NOT NULL,
  `notificacionReciente` int(11) NOT NULL,
  `notificacionPrincipalComentario` int(11) NOT NULL,
  PRIMARY KEY (`notificacionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `notificaciones`
--

INSERT INTO `notificaciones` (`notificacionId`, `notificacionUsuarioId`, `notificacionPlanId`, `notificacionStatus`, `notificacionLeido`, `notificacionTipo`, `notificacionReciente`, `notificacionPrincipalComentario`) VALUES
(1, 1, 1, 1, 0, 0, 0, 0),
(2, 2, 1, 1, 0, 0, 0, 0),
(3, 2, 1, 1, 0, 0, 0, 0),
(4, 1, 1, 1, 0, 0, 0, 0),
(5, 1, 1, 1, 0, 0, 0, 0),
(6, 2, 1, 1, 1, 0, 1, 0);
