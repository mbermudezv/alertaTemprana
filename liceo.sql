-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 08-02-2021 a las 23:56:29
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `liceo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alerta`
--

CREATE TABLE `alerta` (
  `alerta_Id` int(11) NOT NULL,
  `situacion_Id` int(11) NOT NULL,
  `estudiante_Id` int(11) NOT NULL,
  `alerta_Comentario` text COLLATE utf8_spanish_ci,
  `alerta_Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alerta`
--

INSERT INTO `alerta` (`alerta_Id`, `situacion_Id`, `estudiante_Id`, `alerta_Comentario`, `alerta_Fecha`) VALUES
(37, 6, 1, 'Gh', '2019-11-09'),
(38, 1, 1, 'Jj', '2019-11-09'),
(39, 3, 1, 'Vv', '2019-11-09'),
(40, 1, 1, 'qa', '2019-11-11'),
(41, 3, 1, '', '2019-11-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `estudiante_Id` int(11) NOT NULL,
  `estudiante_Nombre` text NOT NULL,
  `estudiante_PrimerApellido` text NOT NULL,
  `estudiante_SegundoApellido` text NOT NULL,
  `seccion_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`estudiante_Id`, `estudiante_Nombre`, `estudiante_PrimerApellido`, `estudiante_SegundoApellido`, `seccion_Id`) VALUES
(1, 'Mauricio', 'Bermùdez', 'Vargas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `centroEducativo` text NOT NULL,
  `direccionRegional` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`centroEducativo`, `direccionRegional`) VALUES
('Liceo Las Esperanzas', 'Direcciòn Regional de Pérez Zeledón');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `profesor_Id` int(11) NOT NULL,
  `profesor_Nombre` text NOT NULL,
  `profesor_Apellido1` text NOT NULL,
  `profesor_Apellido2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='profesores guia';

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`profesor_Id`, `profesor_Nombre`, `profesor_Apellido1`, `profesor_Apellido2`) VALUES
(1, 'Mauricio', 'Bermúdez', 'Vargas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `seccion_Id` int(11) NOT NULL,
  `profesor_Id` int(11) NOT NULL,
  `seccion_Descripcion` text NOT NULL,
  `seccion_Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Secciones del Liceo';

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`seccion_Id`, `profesor_Id`, `seccion_Descripcion`, `seccion_Cantidad`) VALUES
(1, 1, '7 1', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `situacion`
--

CREATE TABLE `situacion` (
  `situacion_Id` int(11) NOT NULL,
  `situacion_Nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `situacion`
--

INSERT INTO `situacion` (`situacion_Id`, `situacion_Nombre`) VALUES
(1, 'Bajas calificaciones en las pruebas'),
(3, 'Ausentismo'),
(6, 'Falta de recursos económicos');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alerta`
--
ALTER TABLE `alerta`
  ADD PRIMARY KEY (`alerta_Id`),
  ADD KEY `situacion_estudiante` (`situacion_Id`,`estudiante_Id`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`estudiante_Id`),
  ADD KEY `nombreApellidos` (`estudiante_Nombre`(50),`estudiante_PrimerApellido`(50),`estudiante_SegundoApellido`(50));

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`profesor_Id`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`seccion_Id`),
  ADD UNIQUE KEY `seccion_profesor` (`seccion_Id`,`profesor_Id`);

--
-- Indices de la tabla `situacion`
--
ALTER TABLE `situacion`
  ADD PRIMARY KEY (`situacion_Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alerta`
--
ALTER TABLE `alerta`
  MODIFY `alerta_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `estudiante_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `profesor_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `seccion_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `situacion`
--
ALTER TABLE `situacion`
  MODIFY `situacion_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
