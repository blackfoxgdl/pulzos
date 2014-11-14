-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 12-07-2011 a las 23:37:34
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
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(140) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `username` varchar(140) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(60) COLLATE utf8_bin NOT NULL,
  `sexo` tinyint(1) DEFAULT '2',
  `edad` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `pais` int(11) DEFAULT NULL,
  `ciudad` int(11) DEFAULT NULL,
  `creacion` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `codigoActivacion` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `codigoRecuperacion` varchar(140) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `statusRecuperacion` tinyint(1) DEFAULT '1',
  `statusEU` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=19 ;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `username`, `email`, `password`, `sexo`, `edad`, `pais`, `ciudad`, `creacion`, `codigoActivacion`, `codigoRecuperacion`, `statusRecuperacion`, `statusEU`) VALUES
(1, 'Ruben', 'Cortes Mendoza', NULL, 'ruben@zavordigital.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 1, '1986-03-19 00:00:00', 1, 1, '0000-00-00 00:00:00', NULL, '0', 1, 0),
(2, 'Pamela Noemi', 'Hernandez', NULL, 'pamela@gmail.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 0, '1989-06-12 00:00:00', 1, 1, '0000-00-00 00:00:00', NULL, '0', 1, 0),
(9, 'La Chata de Guadalajara', NULL, NULL, 'lachata@gmail.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 2, '0000-00-00 00:00:00', NULL, NULL, '2011-05-24 18:17:24', 'f440147182488d791cb41bebe8857c85a9207bf1', '0', 1, 1),
(10, 'Benitos Pizza & Pasta', NULL, NULL, 'benitos@gmail.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 2, '0000-00-00 00:00:00', NULL, NULL, '2011-05-24 18:27:38', 'e62f471bf9cd905c61c780d2305d32640f6782f0', '0', 1, 1),
(11, 'Restaurant El Pargo', NULL, NULL, 'pargo@gmail.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 2, '0000-00-00 00:00:00', NULL, NULL, '2011-05-24 18:34:24', 'ec46a2845ae7c8c7095f9fbf0bead3b48b116985', '0', 1, 1),
(12, 'il Diavolo', NULL, NULL, 'diavolo@gmail.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 2, '0000-00-00 00:00:00', NULL, NULL, '2011-05-24 18:39:45', 'bb36151e8c82a9cc5653a517bece41b063315b4e', '0', 1, 1),
(13, 'CANTA Y NO LLORES', NULL, NULL, 'cantaynollores@gmail.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 2, '0000-00-00 00:00:00', NULL, NULL, '2011-05-24 18:45:07', '2c6a5c31b1e137e6e7422d168ad7fe6284c98a87', '0', 1, 1),
(14, 'Mariela Isabel', 'Lopez Moya', NULL, 'mariela@hotmail.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 0, '1987-12-12 00:00:00', 1, 1, '0000-00-00 00:00:00', NULL, '0', 1, 0),
(15, 'Juanita', 'Lechon', NULL, 'juanita@gmail.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 2, '1979-11-17 00:00:00', 1, 1, '0000-00-00 00:00:00', NULL, '0', 1, 0),
(17, 'Mariscos Alex', NULL, NULL, 'mariscos@gmail.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 2, '0000-00-00 00:00:00', NULL, NULL, '2011-06-01 15:01:09', '0cff4509f67a74065c389d41a35d5c96baa79eaf', '0', 1, 1),
(18, 'Jorge', 'Leon', NULL, 'j@hotmail.com', 'efa34abe4fea0c97d5fce5c65f60bef575b2044c', 1, '1995-01-15 00:00:00', 1, 1, '0000-00-00 00:00:00', NULL, '0', 1, 0);
