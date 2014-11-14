-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-02-2012 a las 23:41:35
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
-- Estructura de tabla para la tabla `bonificacion_empleados`
--

CREATE TABLE IF NOT EXISTS `bonificacion_empleados` (
  `id_bonificacionEmpleado` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuarioMostrador` int(11) NOT NULL,
  `folio` varchar(45) DEFAULT NULL,
  `fecha_hora` varchar(20) DEFAULT NULL,
  `monto_consumido` double DEFAULT NULL,
  `monto_bonificacion` double DEFAULT NULL,
  PRIMARY KEY (`id_bonificacionEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
