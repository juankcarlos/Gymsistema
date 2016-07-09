-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-07-2016 a las 00:17:40
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_gym`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarestado`()
BEGIN
-- Variables donde almacenar lo que nos traemos desde el SELECT
  DECLARE idus int;
  DECLARE fechafin date;
  DECLARE estadoact int;
  DECLARE cont char;
 
-- Variable para controlar el fin del bucle
  DECLARE fin INTEGER DEFAULT 0;

-- El SELECT que vamos a ejecutar
  DECLARE estadous_cursor CURSOR FOR 
    SELECT id,fecha_fin,estado FROM usuario;

-- Condición de salida
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin=1;

  OPEN estadous_cursor;
  get_estadous: LOOP
  
    FETCH estadous_cursor INTO idus,fechafin,estadoact;
    SET cont=0;
    IF fin = 1 THEN
       LEAVE get_estadous;
    END IF;

    IF estadoact = 1 THEN
      SELECT count(*) into cont FROM usuario WHERE fecha_fin BETWEEN CURDATE() and fechafin;
      IF (cont = 0) THEN
        
        UPDATE usuario set estado=0 WHERE id=idus;
      end if;
    
    END IF;

  END LOOP get_estadous;

  CLOSE estadous_cursor;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_admin` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `rol` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id_admin`, `nombre`, `nombre_admin`, `pass`, `rol`) VALUES
(1, 'juan carlos', 'carlos', '123', 1),
(5, 'oscar alejandro', 'oscar', '123', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE IF NOT EXISTS `asistencia` (
  `id` int(11) NOT NULL,
  `fech_asist` date NOT NULL,
  `id_us` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `fech_asist`, `id_us`) VALUES
(4, '2016-07-06', 58),
(5, '2016-07-06', 62),
(6, '2016-07-06', 59);

--
-- Disparadores `asistencia`
--
DELIMITER $$
CREATE TRIGGER `trigactualizarestado` AFTER INSERT ON `asistencia`
 FOR EACH ROW BEGIN
CALL actualizarestado();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_us` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `clave` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `paquete` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tipomembrecia` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `nombre_us`, `fecha_inicio`, `fecha_fin`, `clave`, `estado`, `paquete`, `tipomembrecia`) VALUES
(58, 'Ivan Acosta Vargas', 'ivankike', '2016-07-06', '2016-07-07', '12', 1, 'estandar', 3),
(59, 'oscar alejandro', 'oscar', '2016-07-06', '2016-08-06', '345', 1, 'estudiante', 3),
(61, 'Luis Alberto Salazar Ordaz', 'Luis', '2016-07-14', '2016-07-07', '635', 1, 'estandar', 3),
(62, 'Juan luis Moreno Peña', 'juan', '2016-07-05', '2016-08-05', '625', 1, 'estandar', 3),
(63, 'Angelica Rivera Trejo', 'angie', '2016-07-07', '2016-08-07', '623', 1, 'estandar', 3),
(64, 'Rosa Maria Peña Hernandez', 'Rosi', '2016-07-09', '2016-08-09', '789', 1, 'estudiante', 1),
(65, 'Alejandra Rivera Ortiz', 'Ale', '2016-07-10', '2016-06-22', '773', 0, 'estandar', 3),
(66, 'Jose de Jesus Aguilar Muños', 'chucho', '2016-07-11', '2016-08-11', '233', 1, 'estandar', 3),
(67, 'Luis Ernesto Ordaz', 'luis', '2016-07-07', '2016-08-07', '728', 1, 'estandar', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_us` (`id_us`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`id_us`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
