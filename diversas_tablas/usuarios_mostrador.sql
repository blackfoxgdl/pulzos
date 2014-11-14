-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-02-2012 a las 23:41:18
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pulzos_bueno`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_mostrador`
--

CREATE TABLE IF NOT EXISTS `usuarios_mostrador` (
  `idusuarios_mostrador` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `idNegocio` int(11) DEFAULT NULL COMMENT 'Id del negocio al que pertenece el usuario de mostrador',
  `idUsuarioPulzos` int(11) DEFAULT NULL COMMENT 'Id del usuario de mostrador que tiene q estar dado de alta en pulzos',
  `statusMostrador` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idusuarios_mostrador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
