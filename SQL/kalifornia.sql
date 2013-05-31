-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 31-05-2013 a las 21:14:12
-- Versión del servidor: 5.5.25a
-- Versión de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `kalifornia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `img`
--

CREATE TABLE IF NOT EXISTS `img` (
  `id` int(11) NOT NULL,
  `id_kaliforniazo` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mail` (`mail`),
  KEY `id_kaliforniazo` (`id_kaliforniazo`),
  KEY `mail_2` (`mail`),
  KEY `id_kaliforniazo_2` (`id_kaliforniazo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `img`
--

INSERT INTO `img` (`id`, `id_kaliforniazo`, `mail`, `fecha`, `titulo`, `descripcion`) VALUES
(1, 1, 'felixuke7@gmail.com', '29/10/2012', 'Kalifornia', 'Descripci&oacute;n de la foto de kalifornia'),
(2, 1, 'marikilla@gmail.com', '29/10/2012', 'Kalifornia', 'Descripci&oacute;n de la foto de kalifornia'),
(3, 1, 'felixuke7@gmail.com', '29/10/2012', 'Kalifornia', 'Descripci&oacute;n de la foto de kalifornia'),
(4, 1, 'felixuke7@gmail.com', '29/10/2012', 'Kalifornia', 'Descripci&oacute;n de la foto de kalifornia'),
(5, 1, 'felixuke7@gmail.com', '29/10/2012', 'Kalifornia', 'Descripci&oacute;n de la foto de kalifornia'),
(6, 1, 'felixuke7@gmail.com', '29/10/2012', 'Kalifornia', 'Descripci&oacute;n de la foto de kalifornia'),
(7, 1, 'felixuke7@gmail.com', '29/10/2012', 'Kalifornia', 'Descripci&oacute;n de la foto de kalifornia'),
(8, 1, 'felixuke7@gmail.com', '29/10/2012', 'Kalifornia', 'Descripci&oacute;n de la foto de kalifornia'),
(9, 1, 'felixuke7@gmail.com', '29/10/2012', 'Kalifornia', 'Descripci&oacute;n de la foto de kalifornia'),
(10, 1, 'felixuke7@gmail.com', '29/10/2012', 'Kalifornia', 'Descripci&oacute;n de la foto de kalifornia'),
(11, 1, 'felixuke7@gmail.com', '29/10/2012', 'Kalifornia', 'Descripci&oacute;n de la foto de kalifornia'),
(12, 1, 'felixuke7@gmail.com', '29/10/2012', 'Kalifornia', 'Descripci&oacute;n de la foto de kalifornia'),
(13, 1, 'felixuke7@gmail.com', '29/10/2012', 'Kalifornia', 'Descripci&oacute;n de la foto de kalifornia'),
(14, 1, 'felixuke7@gmail.com', '29/10/2012', 'Kalifornia', 'Descripci&oacute;n de la foto de kalifornia'),
(15, 1, 'felixuke7@gmail.com', '29/10/2012', 'Kalifornia', 'Descripci&oacute;n de la foto de kalifornia'),
(16, 1, 'marikilla@gmail.com', '29/10/2012', 'Kalifornia', 'Descripci&oacute;n de la foto de kalifornia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kaliforniazo`
--

CREATE TABLE IF NOT EXISTS `kaliforniazo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proximo` tinyint(1) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `longitud` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `latitud` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mail` (`mail`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `kaliforniazo`
--

INSERT INTO `kaliforniazo` (`id`, `proximo`, `mail`, `nombre`, `fecha`, `descripcion`, `longitud`, `latitud`) VALUES
(1, 0, 'felixuke7@gmail.com', 'Punta Paloma', '03/08/2012', 'El Kaliforniazo por excelencia. Que no desaparezca nunca de cada una de nuestras retinas.', '-5.7354748249053955', '36.06736397651583'),
(2, 1, 'felixuke7@gmail.com', 'La Graciosa', 'Por confirmar', 'Una preciosa isla en mitad de las Canarias. PrepÃ¡rate BIG que la que vamos a liar es muy gorda', '', ''),
(9, 1, 'marikilla@gmail.com', 'FantasÃ­a ', '17/07/2013', 'Una autentica fantasÃ­a', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `mail` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`mail`, `pass`, `nombre`) VALUES
('adssad@ajsd.cm', '*E05DCB20DA50924EBCEEC6DF0F2E49CBB7B0C457', 'Killo'),
('felixuke7@gmail.com', '*46C0D37F546C5E6DC54C181D606D7398F9EC4F0E', 'Felixuke 7'),
('marikilla@gmail.com', '*E05DCB20DA50924EBCEEC6DF0F2E49CBB7B0C457', 'Marikilla');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `img`
--
ALTER TABLE `img`
  ADD CONSTRAINT `img_ibfk_1` FOREIGN KEY (`mail`) REFERENCES `usuario` (`mail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `img_ibfk_2` FOREIGN KEY (`id_kaliforniazo`) REFERENCES `kaliforniazo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `kaliforniazo`
--
ALTER TABLE `kaliforniazo`
  ADD CONSTRAINT `kaliforniazo_ibfk_1` FOREIGN KEY (`mail`) REFERENCES `usuario` (`mail`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
