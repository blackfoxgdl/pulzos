-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 13, 2012 at 05:17 PM
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
-- Table structure for table `bitacora_dos`
--

CREATE TABLE IF NOT EXISTS `bitacora_dos` (
  `bitacoraDosId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id de la bitacora dos',
  `bitacoraDosUsuarioAcepta` int(11) NOT NULL COMMENT 'id del usuario que acepta que publiquen el mensaje',
  `bitacoraDosUsuarioPublica` int(11) NOT NULL COMMENT 'Id del usuario que publica su msj',
  `bitacoraDosMsjFb` varchar(300) COLLATE utf8_bin DEFAULT NULL COMMENT 'Mensaje a publicar en fb para bitacora',
  `bitacoraDosMsjTw` varchar(300) COLLATE utf8_bin DEFAULT NULL COMMENT 'Mensaje de TW para bitacora',
  `bitacoraDosOfertaId` int(11) NOT NULL COMMENT 'id de la oferta aceptada para bitacora',
  `bitacoraDosMoneyUsuario` int(11) NOT NULL COMMENT 'id del meny back del usuario para bitacora',
  `bitacoraDosBitacoraUno` int(11) NOT NULL COMMENT 'id de bitacora uno',
  `bitacoraDosFechaPublicacion` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Fecha de la publicacion del comentario',
  `bitacoraDosComisionRecibidaUsuario` int(11) NOT NULL COMMENT 'Comision recibida de negocio a usuario para bitacora',
  PRIMARY KEY (`bitacoraDosId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bitacora para conocer los datos de los usuarios cuando acept' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bitacora_dos`
--

