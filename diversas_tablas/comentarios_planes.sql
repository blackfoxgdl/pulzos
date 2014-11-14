-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 19, 2011 at 05:25 PM
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
-- Table structure for table `comentarios_planes`
--

CREATE TABLE IF NOT EXISTS `comentarios_planes` (
  `comentarioSimpleId` int(11) NOT NULL AUTO_INCREMENT,
  `comentarioSimpleUsuarioId` int(11) NOT NULL,
  `comentarioSimplePlanId` int(11) NOT NULL,
  `comentarioSimpleSubId` tinyint(4) NOT NULL,
  `subcomentarioComentarioId` int(11) DEFAULT '0',
  `comentarioSimple` varchar(400) COLLATE utf8_bin NOT NULL,
  `comentarioSimpleGusta` int(11) DEFAULT '0',
  `comentarioFechaCreacion` int(11) NOT NULL,
  PRIMARY KEY (`comentarioSimpleId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `comentarios_planes`
--

INSERT INTO `comentarios_planes` (`comentarioSimpleId`, `comentarioSimpleUsuarioId`, `comentarioSimplePlanId`, `comentarioSimpleSubId`, `subcomentarioComentarioId`, `comentarioSimple`, `comentarioSimpleGusta`, `comentarioFechaCreacion`) VALUES
(1, 1, 82, 1, 0, 'hola amigos', 0, 1311093255),
(2, 1, 20, 1, 0, 'prueba nueva', 0, 1311093314),
(3, 1, 82, 1, 0, 'hola a todos', 0, 1311112242),
(4, 1, 20, 1, 0, 'hola a todos', 0, 1311112847);
