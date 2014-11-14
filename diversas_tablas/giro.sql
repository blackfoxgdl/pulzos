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
-- Table structure for table `giro`
--

CREATE TABLE IF NOT EXISTS `giro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(140) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=25 ;

--
-- Dumping data for table `giro`
--

INSERT INTO `giro` (`id`, `nombre`) VALUES
(1, 'Ayuda a tu comunidad'),
(2, 'Cafés'),
(3, 'Casinos'),
(4, 'Conciertos y Eventos'),
(5, 'Cursos y Talleres'),
(6, 'De compras'),
(7, 'Esotérico'),
(8, 'Eventos Religiosos'),
(9, 'Expos y ferias'),
(10, 'Fiesta Local'),
(11, 'Fuera de lo Comun'),
(12, 'Otros'),
(13, 'Puntos Turísticos'),
(14, 'Restaurantes'),
(15, 'Salud y Belleza'),
(16, 'Servicios'),
(17, 'Solo Cultura'),
(18, 'Teatro y Cine'),
(19, 'Viajes y Tours'),
(20, 'Vida Activa'),
(21, 'Vida Familiar'),
(22, 'Vida Nocturna'),
(23, 'Vida Política'),
(24, 'Selecciona un giro');
