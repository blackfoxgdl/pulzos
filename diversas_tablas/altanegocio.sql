-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 16, 2011 at 06:57 PM
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
-- Table structure for table `altanegocio`
--

CREATE TABLE IF NOT EXISTS `altanegocio` (
  `altaNegocioId` int(11) NOT NULL AUTO_INCREMENT,
  `altaNegocioNegocioId` int(11) NOT NULL,
  `altaNegocioNombre` varchar(250) COLLATE utf8_bin NOT NULL,
  `altaNegocioDireccion` varchar(400) COLLATE utf8_bin NOT NULL,
  `altaNegocioColonia` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `altaNegocioGiro` int(11) NOT NULL,
  `altaNegocioSubgiro` int(11) DEFAULT NULL,
  `altaNegocioPais` int(11) NOT NULL,
  `altaNegocioEstado` int(11) NOT NULL,
  `altaNegocioCiudad` int(11) NOT NULL,
  `altaNegocioFechaCreacion` int(11) NOT NULL,
  PRIMARY KEY (`altaNegocioId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=27 ;

--
-- Dumping data for table `altanegocio`
--

INSERT INTO `altanegocio` (`altaNegocioId`, `altaNegocioNegocioId`, `altaNegocioNombre`, `altaNegocioDireccion`, `altaNegocioColonia`, `altaNegocioGiro`, `altaNegocioSubgiro`, `altaNegocioPais`, `altaNegocioEstado`, `altaNegocioCiudad`, `altaNegocioFechaCreacion`) VALUES
(1, 15, 'ffff', 'fffff', NULL, 1, NULL, 1, 1, 1, 1313442180),
(2, 16, 'sdfsdfsdfsdf', 'sdfsdfsdfsdf', NULL, 1, NULL, 1, 1, 1, 1313442224),
(3, 17, 'sdfsdfsdfsdf', 'sdfsdfsdfsdf', NULL, 1, NULL, 1, 1, 1, 1313442229),
(4, 18, 'ra', 'ra', NULL, 1, NULL, 1, 3, 1, 1313442415),
(5, 19, 'wwww', 'wwwwww', NULL, 1, NULL, 1, 1, 1, 1313442474),
(6, 20, 'asdasd', 'asdasdasd', NULL, 1, NULL, 1, 1, 1, 1313442731),
(7, 21, 'asd', 'asd', NULL, 1, NULL, 1, 1, 1, 1313442779),
(8, 22, 'sdf', 'sdf', NULL, 1, NULL, 1, 1, 1, 1313442823),
(9, 23, 'asdasd', 'asdasdasd', NULL, 1, NULL, 1, 1, 1, 1313442859),
(10, 24, 'ssss', 'ssssss', NULL, 1, NULL, 1, 1, 1, 1313442981),
(11, 25, 'sdf', 'sdf', NULL, 1, NULL, 1, 1, 1, 1313443134),
(12, 26, 'aaaaaaa', 'aaaaaaaaa', NULL, 1, NULL, 1, 1, 1, 1313443160),
(13, 27, 'vvvvvv', 'vvvvvv', NULL, 1, NULL, 1, 1, 1, 1313443219),
(14, 28, 'qw', 'qw', NULL, 1, NULL, 1, 1, 1, 1313443255),
(15, 29, 'uiiii', 'iiiii', NULL, 1, NULL, 1, 1, 1, 1313443300),
(16, 30, 'yyy', 'yyyy', NULL, 2, NULL, 1, 3, 1, 1313443457),
(17, 31, 'aasd', 'asdasd', NULL, 1, NULL, 1, 1, 1, 1313443551),
(18, 32, 'asd', 'a', NULL, 1, NULL, 1, 1, 1, 1313443661),
(19, 33, 'q', 'q', NULL, 1, NULL, 1, 1, 1, 1313443711),
(20, 34, 'w', 'w', NULL, 1, NULL, 1, 1, 1, 1313443739),
(21, 35, 'q', 'q', NULL, 1, NULL, 1, 1, 1, 1313443908),
(22, 36, 'w', 'w', NULL, 1, NULL, 1, 1, 1, 1313443938),
(23, 37, 'e', 'e', NULL, 7, NULL, 1, 1, 1, 1313444033),
(24, 38, 'ach', 'ach', NULL, 22, NULL, 1, 2, 3, 1313451048),
(25, 39, 'aaaaa', 'asdasd', 'dfdg', 1, NULL, 1, 1, 1, 1313521474),
(26, 40, 'wwww', 'wwww', 'wwwww', 22, 129, 1, 3, 1, 1313536964);
