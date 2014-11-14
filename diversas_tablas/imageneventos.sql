-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-08-2011 a las 21:31:22
-- Versión del servidor: 5.5.8
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pulzos_bueno`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imageneventos`
--

CREATE TABLE IF NOT EXISTS `imageneventos` (
  `imagenId` int(11) NOT NULL AUTO_INCREMENT,
  `planesusuariosId` int(11) NOT NULL,
  `imagenRuta` varchar(300) NOT NULL,
  `imagenFechaCreacion` int(11) NOT NULL,
  `imagenFechaModificacion` int(11) NOT NULL,
  PRIMARY KEY (`imagenId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `imageneventos`
--

