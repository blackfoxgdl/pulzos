-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 31, 2011 at 12:49 PM
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
-- Table structure for table `scribbles_comments`
--

CREATE TABLE IF NOT EXISTS `scribbles_comments` (
  `scribbleId` int(11) NOT NULL AUTO_INCREMENT,
  `scribbleUsuarioId` int(11) NOT NULL,
  `scribbleTexto` varchar(150) COLLATE utf8_bin NOT NULL,
  `scribbleLat` varchar(20) COLLATE utf8_bin NOT NULL,
  `scribbleLng` varchar(20) COLLATE utf8_bin NOT NULL,
  `scribbleNombreUsuario` varchar(400) COLLATE utf8_bin NOT NULL,
  `scribbleImagenUsuario` varchar(400) COLLATE utf8_bin NOT NULL,
  `scribbleFatherId` int(11) DEFAULT '0',
  `totalComentarios` int(11) DEFAULT '0',
  `heading` float NOT NULL,
  `altura` float NOT NULL,
  `atributo` int(11) DEFAULT '0',
  PRIMARY KEY (`scribbleId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Dumping data for table `scribbles_comments`
--

INSERT INTO `scribbles_comments` (`scribbleId`, `scribbleUsuarioId`, `scribbleTexto`, `scribbleLat`, `scribbleLng`, `scribbleNombreUsuario`, `scribbleImagenUsuario`, `scribbleFatherId`, `totalComentarios`, `heading`, `altura`, `atributo`) VALUES
(1, 1, 'prueba nueva', '12.02545458', '12.21545689', 'hola', 'http:%5C%5Csdfsdfsdfsd.com%5Casdfsd%5Csdfdfsf', 0, 2, 12, 12, 35),
(2, 1, 'cual nueva', '0', '0', 'Ruben Alonso Cortes Mendoza', 'http:--www.pulzos.com-statics-img_usuarios-1-3-dfbb4d49fbc97c6381ee73ac4209786b.jpg', 1, 0, 0, 0, 0),
(3, 1, 'pues la nueva', '0', '0', 'Ruben Alonso Cortes Mendoza', 'http:--www.pulzos.com-statics-img_usuarios-1-3-dfbb4d49fbc97c6381ee73ac4209786b.jpg', 1, 0, 0, 0, 0),
(4, 4, 'prueba1', '12.02545458', '12.21545689', 'ruben', 'http', 0, 0, 12, 12, NULL),
(5, 4, 'prueba1', '12.02545458', '12.21545689', 'ruben', 'http', 0, 0, 12, 12, NULL),
(6, 1, 'prueba nuevas', '12.02545458', '12.21545689', 'hola', 'http:%5C%5Csdfsdfsdfsd.com%5Casdfsd%5Csdfdfsf', 0, 0, 12, 12, NULL),
(7, 1, 'pruebas', '12.02545458', '12.21545689', 'hola', 'http:%5C%5Csdfsdfsdfsd.com%5Casdfsd%5Csdfdfsf', 0, 0, 12, 12, NULL);
