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
-- Table structure for table `bitacora_uno`
--

CREATE TABLE IF NOT EXISTS `bitacora_uno` (
  `bitacoraId` int(11) NOT NULL AUTO_INCREMENT,
  `bitacoraIbxnId` int(11) NOT NULL COMMENT 'id del inbox pra la bitacora',
  `bitacoraUsuarioRecibeId` int(11) NOT NULL COMMENT 'id del usuario que recibe para la bitacora',
  `bitacoraUsuarioEnviaId` int(11) NOT NULL COMMENT 'id del usuario que envia para la bitacora',
  `bitacoraIbxMsj` varchar(5000) COLLATE utf8_bin NOT NULL COMMENT 'mensaje de bonificacion para la bitacora',
  `bitacoraIbxOferta` int(11) NOT NULL COMMENT 'id de oferta de la promocion para la bitacora',
  `bitacoraMoneyUsuario` int(11) NOT NULL COMMENT 'id del usuario para el money back en bitacora',
  `bitacoraIbxStatus` int(11) NOT NULL COMMENT 'status del inbox en la bitacora',
  PRIMARY KEY (`bitacoraId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bitacora para conocer los mensajes que postea el usuario en ' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bitacora_uno`
--

INSERT INTO `bitacora_uno` (`bitacoraId`, `bitacoraIbxnId`, `bitacoraUsuarioRecibeId`, `bitacoraUsuarioEnviaId`, `bitacoraIbxMsj`, `bitacoraIbxOferta`, `bitacoraMoneyUsuario`, `bitacoraIbxStatus`) VALUES
(1, 23, 1, 7, '<strong>Has solicitado una bonificación:</strong> <br> Lugar: <strong>Mariscos Alex </strong><br>\r\n                                     Folio: <strong> 89765 </strong><br>\r\n                                     Monto consumido de $ <strong>785 Pesos </strong><br>\r\n                                     Bonificacion:<strong> $7.85 Pesos</strong><br><br>\r\n                                     Se publicará el siguiente mensaje en tus redes sociales:<br><br>Facebook:  haberrrrr<br>Twitter:  haberrrrr', 10, 31, 2);
