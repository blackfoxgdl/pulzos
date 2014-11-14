-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 13, 2011 at 10:27 AM
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
-- Table structure for table `subcategorias`
--

CREATE TABLE IF NOT EXISTS `subcategorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `idGiro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=150 ;

--
-- Dumping data for table `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `nombre`, `idGiro`) VALUES
(1, 'Voluntarios', 1),
(2, 'Eventos', 1),
(3, 'Actividades', 1),
(4, 'Banda y popular', 4),
(5, 'Cabaret', 4),
(6, 'Electrónica / Dance', 4),
(7, 'Festival', 4),
(8, 'Jazz y Blues', 4),
(9, 'Latino', 4),
(10, 'Mariachi y tradicional', 4),
(11, 'Música Clásica', 4),
(12, 'Música del Mundo', 4),
(13, 'New Age', 4),
(14, 'Pop', 4),
(15, 'Rap / Hip-hop', 4),
(16, 'Reggaetón', 4),
(17, 'Rock Alternativo', 4),
(18, 'Rock Clásico', 4),
(19, 'Rock Metalero', 4),
(20, 'Otros', 4),
(21, 'Capacitación Profesional', 5),
(22, 'Clases Particulares', 5),
(23, 'Cocina', 5),
(24, 'Conferencias', 5),
(25, 'Danza', 5),
(26, 'Espirituales', 5),
(27, 'Fuera de lo Comun', 5),
(28, 'Idiomas', 5),
(29, 'Infantiles', 5),
(30, 'Informática', 5),
(31, 'Música', 5),
(32, 'Salud', 5),
(33, 'Superación Personal', 5),
(34, 'Varios', 5),
(35, 'Accesorios', 6),
(36, 'Automotriz', 6),
(37, 'Centros Comerciales', 6),
(38, 'Comercio General', 6),
(39, 'Decoración', 6),
(40, 'Electrónica', 6),
(41, 'Gourmet', 6),
(42, 'Jardinería', 6),
(43, 'Joyería', 6),
(44, 'Librería', 6),
(45, 'Misceláneo', 6),
(46, 'Muebles', 6),
(47, 'Papelerías', 6),
(48, 'Perfumes', 6),
(49, 'Regalos y sorpresas', 6),
(50, 'Ropa', 6),
(51, 'Varios', 6),
(52, 'Zapatos', 6),
(53, 'Alemán', 14),
(54, 'Americana', 14),
(55, 'Antojitos', 14),
(56, 'Argentina', 14),
(57, 'Bistró', 14),
(58, 'Brasileña', 14),
(59, 'Bufete', 14),
(60, 'Campestre', 14),
(61, 'China', 14),
(62, 'Cocina de Autor', 14),
(63, 'Colombiana', 14),
(64, 'Comida Rapida', 14),
(65, 'Deli', 14),
(66, 'Desayunos', 14),
(67, 'Ensaladas', 14),
(68, 'Española', 14),
(69, 'Fondues', 14),
(70, 'Francesa', 14),
(71, 'Fusíon', 14),
(72, 'Hindú', 14),
(73, 'Hostería', 14),
(74, 'Italiana', 14),
(75, 'Latina', 14),
(76, 'Mariscos', 14),
(77, 'Mediterránea', 14),
(78, 'Mexicana', 14),
(79, 'Naturista', 14),
(80, 'Pastelería', 14),
(81, 'Pollería', 14),
(82, 'Sándwiches', 14),
(83, 'Sushi / Japonesa', 14),
(84, 'Tailandesa', 14),
(85, 'Taquerías', 14),
(86, 'Varios', 14),
(87, 'Vegetariana', 14),
(88, 'Estética', 15),
(89, 'Holístico', 15),
(90, 'Manicure', 15),
(91, 'Maquillaje', 15),
(92, 'Masajes', 15),
(93, 'Medicina', 15),
(94, 'Pedicura', 15),
(95, 'Spa', 15),
(96, 'Varios', 15),
(97, 'Para el Hogar', 16),
(98, 'Profesionales', 16),
(99, 'Varios', 16),
(100, 'Arte Urbano', 17),
(101, 'Centro Cultural', 17),
(102, 'Escultura', 17),
(103, 'Exposiciones Varias', 17),
(104, 'Fotografía', 17),
(105, 'Moderno', 17),
(106, 'Museos', 17),
(107, 'Pintura', 17),
(108, 'Varias', 17),
(109, 'Fin de semana', 19),
(110, 'Hoteles', 19),
(111, 'Ida y vuelta', 19),
(112, 'Vacaciones', 19),
(113, 'Clubes y Gimnasios', 20),
(114, 'Entrenador Particular', 20),
(115, 'Eventos deportivos', 20),
(116, 'Exhibiciones', 20),
(117, 'Torneos', 20),
(118, 'Varios', 20),
(119, 'Infantil', 21),
(120, 'Actividades', 21),
(121, 'Educativos', 21),
(122, 'Eventos', 21),
(123, 'Antros', 22),
(124, 'Bares', 22),
(125, 'Botaneros', 22),
(126, 'Discotecas', 22),
(127, 'Diversidad', 22),
(128, 'Litros', 22),
(129, 'Micheladas', 22),
(130, 'Solo autos', 22),
(131, 'Varios', 22),
(132, 'Reuniones', 23),
(133, 'Marchas', 23),
(134, 'Activistas', 23),
(135, 'Congregaciones', 23),
(136, 'Debates', 23),
(137, 'Denuncia', 23),
(138, 'Varios', 23),
(139, 'Cafes', 2),
(140, 'Casinos', 3),
(141, 'Esoterico', 7),
(142, 'Eventos Religiosos', 8),
(143, 'Expos y Ferias', 9),
(144, 'Fuera de lo Comun', 11),
(145, 'Otros', 12),
(146, 'Puntos Turisticos', 13),
(147, 'Teatro y Cine', 18),
(148, 'Selecciona una subcategoria', 0),
(149, 'Aves', 14);
