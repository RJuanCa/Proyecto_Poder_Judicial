-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2022 a las 16:22:33
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_arquitectura`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id_articulo` int(11) NOT NULL,
  `nombre_articulo` varchar(50) DEFAULT NULL,
  `id_subrubro` int(11) NOT NULL,
  `id_rubro` int(11) NOT NULL,
  `marca` varchar(70) DEFAULT NULL,
  `modelo` varchar(70) DEFAULT NULL,
  `estado` varchar(70) DEFAULT NULL,
  `cantidad_art` int(11) DEFAULT 0,
  `cantidad_env` int(11) DEFAULT 0,
  `cantidad_existencia` int(11) DEFAULT 0,
  `comprobantes` varchar(2) CHARACTER SET utf8 DEFAULT 'no',
  `alta_articulo` datetime DEFAULT NULL,
  `baja_articulo` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id_articulo`, `nombre_articulo`, `id_subrubro`, `id_rubro`, `marca`, `modelo`, `estado`, `cantidad_art`, `cantidad_env`, `cantidad_existencia`, `comprobantes`, `alta_articulo`, `baja_articulo`, `id_usuario`) VALUES
(3518, 'ACONDICIONADOR DE AIRE SPLIT 2100/3000 FGS.', 441, 21, '', '', 'Nuevo', 0, 0, 0, 'no', '2022-11-04 15:37:46', '0000-00-00 00:00:00', 0),
(3572, 'ACONDICIONADOR DE AIRE PORTATIL FGS.', 441, 21, '', '', 'Nuevo', 0, 0, 0, 'no', '2022-11-04 15:38:00', '0000-00-00 00:00:00', 0),
(3879, 'ACONDICIONADOR DE AIRE SPLIT 4300/4500 FGS.', 441, 21, '', '', 'Nuevo', 0, 0, 0, 'no', '2022-11-04 15:38:22', '0000-00-00 00:00:00', 0),
(3880, 'ACONDICIONADOR DE AIRE SPLIT 5500/6000 FGS.', 441, 21, '', '', 'Nuevo', 0, 0, 0, 'no', '2022-11-04 15:38:34', '0000-00-00 00:00:00', 0),
(3881, 'ACONDICIONADOR DE AIRE SPLIT 8000/9000 FGS.', 441, 21, '', '', 'Nuevo', 0, 0, 0, 'no', '2022-11-04 15:38:45', '0000-00-00 00:00:00', 0),
(3882, 'ACONDICIONADOR DE AIRE SPLIT DE 9001 HASTA 18000 F', 441, 21, '', '', 'NUEVO', 0, 0, 0, 'no', '2022-11-04 15:50:21', '0000-00-00 00:00:00', 0),
(3883, 'ACONDICIONADOR DE AIRE VENTANA 2100/3000 FGS.', 441, 21, '', '', 'Nuevo', 0, 0, 0, 'no', '2022-11-04 15:38:56', '0000-00-00 00:00:00', 0),
(3884, 'ACONDICIONADOR DE AIRE VENTANA 4300/4500 FGS.', 441, 21, '', '', 'Nuevo', 0, 0, 0, 'no', '2022-11-04 15:39:06', '0000-00-00 00:00:00', 0),
(3885, 'ACONDICIONADOR DE AIRE VENTANA 5500/6000 FGS.', 441, 21, '', '', 'Nuevo', 0, 0, 0, 'no', '2022-11-04 15:39:17', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos_entregados`
--

CREATE TABLE `articulos_entregados` (
  `num_transferencia` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `id_rubro` int(11) NOT NULL,
  `id_subrubro` int(11) NOT NULL,
  `marca` varchar(70) DEFAULT NULL,
  `id_dep` int(11) NOT NULL,
  `responsable_dep` varchar(70) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_envio` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `climatizacion`
--

CREATE TABLE `climatizacion` (
  `id_climatizacion` int(11) NOT NULL,
  `id_rubro` int(11) NOT NULL,
  `id_subrubro` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `marca` varchar(70) DEFAULT NULL,
  `modelo` varchar(70) DEFAULT NULL,
  `estado` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `climatizacion`
--

INSERT INTO `climatizacion` (`id_climatizacion`, `id_rubro`, `id_subrubro`, `id_articulo`, `marca`, `modelo`, `estado`) VALUES
(1, 21, 441, 3518, '', '', '[NUEVO'),
(2, 21, 441, 3572, '', '', 'NUEVO'),
(3, 21, 441, 3879, '', '', 'NUEVO'),
(4, 21, 441, 3880, '', '', 'NUEVO'),
(5, 21, 441, 3881, '', '', 'NUEVO'),
(6, 21, 441, 3882, '', '', 'NUEVO'),
(7, 21, 441, 3883, '', '', 'NUEVO'),
(8, 21, 441, 3884, '', '', 'NUEVO'),
(9, 21, 441, 3885, '', '', 'NUEVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobantes`
--

CREATE TABLE `comprobantes` (
  `nro_transferencia` int(11) NOT NULL DEFAULT 0,
  `fecha_reg` date NOT NULL,
  `id_dep` int(11) NOT NULL,
  `cantidad_enviada` int(11) NOT NULL,
  `anulado` varchar(2) CHARACTER SET latin1 DEFAULT 'no',
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobantes_reng`
--

CREATE TABLE `comprobantes_reng` (
  `id_compte_reng` int(11) NOT NULL,
  `num_transferencia` int(11) NOT NULL,
  `nro_renglon` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `nom_depen` int(11) NOT NULL,
  `responsable_dep` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  `direccion` varchar(70) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencia`
--

CREATE TABLE `dependencia` (
  `id_dep` int(11) NOT NULL,
  `nom_depen` varchar(70) DEFAULT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `responsable_dep` varchar(70) DEFAULT NULL,
  `cargo` varchar(70) DEFAULT NULL,
  `movimiento` varchar(2) DEFAULT NULL,
  `fecha_reg` date DEFAULT NULL,
  `hora_reg` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fecha_pc`
--

CREATE TABLE `fecha_pc` (
  `Id_fecha_pc` int(11) NOT NULL,
  `fecha_pc` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fecha_pc`
--

INSERT INTO `fecha_pc` (`Id_fecha_pc`, `fecha_pc`) VALUES
(1, '2022-11-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubro`
--

CREATE TABLE `rubro` (
  `id_rubro` int(11) NOT NULL,
  `nombre_rubro` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rubro`
--

INSERT INTO `rubro` (`id_rubro`, `nombre_rubro`) VALUES
(21, 'Muebles, maquinas de oficia y equipos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subrubro`
--

CREATE TABLE `subrubro` (
  `id_rubro` int(11) NOT NULL,
  `id_subrubro` int(11) NOT NULL,
  `nombre_subrubro` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `subrubro`
--

INSERT INTO `subrubro` (`id_rubro`, `id_subrubro`, `nombre_subrubro`) VALUES
(21, 441, 'Climatizacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_correlativos`
--

CREATE TABLE `tab_correlativos` (
  `Id_correlativo` int(11) NOT NULL,
  `nro_comprobante` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(70) DEFAULT NULL,
  `contrasena` varchar(70) DEFAULT NULL,
  `nombre_apellido` varchar(70) DEFAULT NULL,
  `rol` varchar(50) DEFAULT NULL,
  `estado` varchar(9) CHARACTER SET utf8 DEFAULT 'activo',
  `movimiento` varchar(2) CHARACTER SET utf8 DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `contrasena`, `nombre_apellido`, `rol`, `estado`, `movimiento`) VALUES
(0, 'RomeroR', 'RomeroR', 'ROMERO R. Juan Carlos', 'admin', 'activo', 'no');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id_articulo`),
  ADD KEY `id_subrubro` (`id_subrubro`),
  ADD KEY `id_rubro` (`id_rubro`);

--
-- Indices de la tabla `articulos_entregados`
--
ALTER TABLE `articulos_entregados`
  ADD PRIMARY KEY (`num_transferencia`),
  ADD KEY `id_articulo` (`id_articulo`),
  ADD KEY `id_rubro` (`id_rubro`),
  ADD KEY `id_subrubro` (`id_subrubro`),
  ADD KEY `id_dep` (`id_dep`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `climatizacion`
--
ALTER TABLE `climatizacion`
  ADD PRIMARY KEY (`id_climatizacion`),
  ADD KEY `id_rubro` (`id_rubro`),
  ADD KEY `id_subrubro` (`id_subrubro`),
  ADD KEY `id_articulo` (`id_articulo`);

--
-- Indices de la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  ADD PRIMARY KEY (`nro_transferencia`);

--
-- Indices de la tabla `comprobantes_reng`
--
ALTER TABLE `comprobantes_reng`
  ADD PRIMARY KEY (`id_compte_reng`);

--
-- Indices de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  ADD PRIMARY KEY (`id_dep`);

--
-- Indices de la tabla `fecha_pc`
--
ALTER TABLE `fecha_pc`
  ADD PRIMARY KEY (`Id_fecha_pc`);

--
-- Indices de la tabla `rubro`
--
ALTER TABLE `rubro`
  ADD PRIMARY KEY (`id_rubro`);

--
-- Indices de la tabla `subrubro`
--
ALTER TABLE `subrubro`
  ADD PRIMARY KEY (`id_subrubro`),
  ADD KEY `id_rubro` (`id_rubro`);

--
-- Indices de la tabla `tab_correlativos`
--
ALTER TABLE `tab_correlativos`
  ADD PRIMARY KEY (`Id_correlativo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos_entregados`
--
ALTER TABLE `articulos_entregados`
  MODIFY `num_transferencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `climatizacion`
--
ALTER TABLE `climatizacion`
  MODIFY `id_climatizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `comprobantes_reng`
--
ALTER TABLE `comprobantes_reng`
  MODIFY `id_compte_reng` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fecha_pc`
--
ALTER TABLE `fecha_pc`
  MODIFY `Id_fecha_pc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tab_correlativos`
--
ALTER TABLE `tab_correlativos`
  MODIFY `Id_correlativo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`id_subrubro`) REFERENCES `subrubro` (`id_subrubro`),
  ADD CONSTRAINT `articulos_ibfk_2` FOREIGN KEY (`id_rubro`) REFERENCES `rubro` (`id_rubro`);

--
-- Filtros para la tabla `articulos_entregados`
--
ALTER TABLE `articulos_entregados`
  ADD CONSTRAINT `articulos_entregados_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id_articulo`),
  ADD CONSTRAINT `articulos_entregados_ibfk_2` FOREIGN KEY (`id_rubro`) REFERENCES `rubro` (`id_rubro`),
  ADD CONSTRAINT `articulos_entregados_ibfk_3` FOREIGN KEY (`id_subrubro`) REFERENCES `subrubro` (`id_subrubro`),
  ADD CONSTRAINT `articulos_entregados_ibfk_4` FOREIGN KEY (`id_dep`) REFERENCES `dependencia` (`id_dep`),
  ADD CONSTRAINT `articulos_entregados_ibfk_5` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `climatizacion`
--
ALTER TABLE `climatizacion`
  ADD CONSTRAINT `climatizacion_ibfk_1` FOREIGN KEY (`id_rubro`) REFERENCES `rubro` (`id_rubro`),
  ADD CONSTRAINT `climatizacion_ibfk_2` FOREIGN KEY (`id_subrubro`) REFERENCES `subrubro` (`id_subrubro`),
  ADD CONSTRAINT `climatizacion_ibfk_3` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id_articulo`);

--
-- Filtros para la tabla `subrubro`
--
ALTER TABLE `subrubro`
  ADD CONSTRAINT `subrubro_ibfk_1` FOREIGN KEY (`id_rubro`) REFERENCES `rubro` (`id_rubro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
