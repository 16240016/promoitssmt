-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2020 a las 15:41:43
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `promo_itssmt`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertIdinfonegocio` ()  BEGIN
DECLARE id_P INT;
SET id_P = (SELECT idinfo_negocio FROM info_negocio ORDER BY idinfo_negocio DESC LIMIT 1);
INSERT INTO direccion(idinfo_negocio) VALUES(id_P);
INSERT INTO redes_sociales(idinfo_negocio) VALUES(id_P);
INSERT INTO dias_horario(idinfo_negocio) VALUES(id_P);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertIdpersonal` ()  BEGIN
DECLARE id_P INT;
SET id_P = (SELECT idpersonal FROM datos_personales ORDER BY idpersonal DESC LIMIT 1);
INSERT INTO info_negocio(idpersonal) VALUES(id_P);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertIdusuario` ()  BEGIN
DECLARE id_U INT;
SET id_U = (SELECT idusuario FROM usuarios ORDER BY idusuario DESC LIMIT 1);
INSERT INTO datos_personales(idusuario) VALUES(id_U);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_personales`
--

CREATE TABLE `datos_personales` (
  `idpersonal` int(11) NOT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `nombres` varchar(20) DEFAULT NULL,
  `a_paterno` varchar(20) DEFAULT NULL,
  `a_materno` varchar(20) DEFAULT NULL,
  `rfc_usuario` varchar(13) DEFAULT NULL,
  `n_telefono` varchar(15) DEFAULT NULL,
  `correo_usu` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Disparadores `datos_personales`
--
DELIMITER $$
CREATE TRIGGER `insertIdpersonalTrigger` AFTER INSERT ON `datos_personales` FOR EACH ROW CALL insertIdpersonal()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias_horario`
--

CREATE TABLE `dias_horario` (
  `iddias_horario` int(11) NOT NULL,
  `idinfo_negocio` int(11) DEFAULT NULL,
  `he_lun` varchar(15) DEFAULT NULL,
  `hc_lun` varchar(15) DEFAULT NULL,
  `hs_lun` varchar(15) DEFAULT NULL,
  `he_mar` varchar(15) DEFAULT NULL,
  `hc_mar` varchar(15) DEFAULT NULL,
  `hs_mar` varchar(15) DEFAULT NULL,
  `he_mie` varchar(15) DEFAULT NULL,
  `hc_mie` varchar(15) DEFAULT NULL,
  `hs_mie` varchar(15) DEFAULT NULL,
  `he_jue` varchar(15) DEFAULT NULL,
  `hc_jue` varchar(15) DEFAULT NULL,
  `hs_jue` varchar(15) DEFAULT NULL,
  `he_vie` varchar(15) DEFAULT NULL,
  `hc_vie` varchar(15) DEFAULT NULL,
  `hs_vie` varchar(15) DEFAULT NULL,
  `he_sab` varchar(15) DEFAULT NULL,
  `hc_sab` varchar(15) DEFAULT NULL,
  `hs_sab` varchar(15) DEFAULT NULL,
  `he_dom` varchar(15) DEFAULT NULL,
  `hc_dom` varchar(15) DEFAULT NULL,
  `hs_dom` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `iddireccion` int(11) NOT NULL,
  `idinfo_negocio` int(11) DEFAULT NULL,
  `idlocalidad` int(11) DEFAULT NULL,
  `calle` varchar(45) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `estado` varchar(25) DEFAULT NULL,
  `municipio` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `giro`
--

CREATE TABLE `giro` (
  `idgiro` int(11) NOT NULL,
  `n_giro` varchar(200) DEFAULT NULL,
  `d_giro` varchar(250) DEFAULT NULL,
  `c_giro` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_negocio`
--

CREATE TABLE `info_negocio` (
  `idinfo_negocio` int(11) NOT NULL,
  `idpersonal` int(11) DEFAULT NULL,
  `idgiro` int(11) DEFAULT NULL,
  `n_negocio` varchar(45) DEFAULT NULL,
  `ref_negocio` varchar(45) DEFAULT NULL,
  `rfc_negocio` varchar(13) DEFAULT NULL,
  `url_imagen1` varchar(100) DEFAULT NULL,
  `url_imagen2` varchar(100) DEFAULT NULL,
  `tipo_negocio` varchar(15) DEFAULT NULL,
  `tipo_servicio` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Disparadores `info_negocio`
--
DELIMITER $$
CREATE TRIGGER `insertIdinfonegocioTrigger` AFTER INSERT ON `info_negocio` FOR EACH ROW CALL insertIdinfonegocio()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `idlocalidad` int(11) NOT NULL,
  `codigo_p` varchar(5) DEFAULT NULL,
  `n_localidad` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocio_pago`
--

CREATE TABLE `negocio_pago` (
  `idnegocio_pago` int(11) NOT NULL,
  `idpago` int(11) DEFAULT NULL,
  `idinfo_negocio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproductos` int(11) NOT NULL,
  `idinfo_negocio` int(11) DEFAULT NULL,
  `n_producto` varchar(45) DEFAULT NULL,
  `m_producto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redes_sociales`
--

CREATE TABLE `redes_sociales` (
  `idredes_sociales` int(11) NOT NULL,
  `idinfo_negocio` int(11) DEFAULT NULL,
  `correo_n` varchar(45) DEFAULT NULL,
  `num_local` varchar(10) DEFAULT NULL,
  `num_whats` varchar(10) DEFAULT NULL,
  `dir_face` varchar(100) DEFAULT NULL,
  `dir_twiter` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `idservicio` int(11) NOT NULL,
  `idinfo_negocio` int(11) DEFAULT NULL,
  `n_servicio` varchar(45) DEFAULT NULL,
  `d_servicio` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_pago`
--

CREATE TABLE `t_pago` (
  `idpago` int(11) NOT NULL,
  `tipo_pago` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `n_usuario` varchar(15) DEFAULT NULL,
  `c_usuario` varchar(15) DEFAULT NULL,
  `estado` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `n_usuario`, `c_usuario`, `estado`) VALUES
(1, 'admin', 'admin', 'activo');

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `insertIdusuarioTrigger` AFTER INSERT ON `usuarios` FOR EACH ROW CALL insertIdusuario()
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD PRIMARY KEY (`idpersonal`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `dias_horario`
--
ALTER TABLE `dias_horario`
  ADD PRIMARY KEY (`iddias_horario`),
  ADD KEY `idinfo_negocio` (`idinfo_negocio`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`iddireccion`),
  ADD KEY `idinfo_negocio` (`idinfo_negocio`),
  ADD KEY `idlocalidad` (`idlocalidad`);

--
-- Indices de la tabla `giro`
--
ALTER TABLE `giro`
  ADD PRIMARY KEY (`idgiro`);

--
-- Indices de la tabla `info_negocio`
--
ALTER TABLE `info_negocio`
  ADD PRIMARY KEY (`idinfo_negocio`),
  ADD KEY `idpersonal` (`idpersonal`),
  ADD KEY `idgiro` (`idgiro`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`idlocalidad`);

--
-- Indices de la tabla `negocio_pago`
--
ALTER TABLE `negocio_pago`
  ADD PRIMARY KEY (`idnegocio_pago`),
  ADD KEY `idpago` (`idpago`),
  ADD KEY `idinfo_negocio` (`idinfo_negocio`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproductos`),
  ADD KEY `idinfo_negocio` (`idinfo_negocio`);

--
-- Indices de la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
  ADD PRIMARY KEY (`idredes_sociales`),
  ADD KEY `idinfo_negocio` (`idinfo_negocio`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`idservicio`),
  ADD KEY `idinfo_negocio` (`idinfo_negocio`);

--
-- Indices de la tabla `t_pago`
--
ALTER TABLE `t_pago`
  ADD PRIMARY KEY (`idpago`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `n_usuario` (`n_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  MODIFY `idpersonal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dias_horario`
--
ALTER TABLE `dias_horario`
  MODIFY `iddias_horario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `iddireccion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `giro`
--
ALTER TABLE `giro`
  MODIFY `idgiro` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `info_negocio`
--
ALTER TABLE `info_negocio`
  MODIFY `idinfo_negocio` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `idlocalidad` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `negocio_pago`
--
ALTER TABLE `negocio_pago`
  MODIFY `idnegocio_pago` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproductos` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
  MODIFY `idredes_sociales` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `idservicio` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_pago`
--
ALTER TABLE `t_pago`
  MODIFY `idpago` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD CONSTRAINT `datos_personales_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dias_horario`
--
ALTER TABLE `dias_horario`
  ADD CONSTRAINT `dias_horario_ibfk_1` FOREIGN KEY (`idinfo_negocio`) REFERENCES `info_negocio` (`idinfo_negocio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `direccion_ibfk_1` FOREIGN KEY (`idinfo_negocio`) REFERENCES `info_negocio` (`idinfo_negocio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `direccion_ibfk_2` FOREIGN KEY (`idlocalidad`) REFERENCES `localidad` (`idlocalidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `info_negocio`
--
ALTER TABLE `info_negocio`
  ADD CONSTRAINT `info_negocio_ibfk_1` FOREIGN KEY (`idpersonal`) REFERENCES `datos_personales` (`idpersonal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `info_negocio_ibfk_2` FOREIGN KEY (`idgiro`) REFERENCES `giro` (`idgiro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `negocio_pago`
--
ALTER TABLE `negocio_pago`
  ADD CONSTRAINT `negocio_pago_ibfk_1` FOREIGN KEY (`idpago`) REFERENCES `t_pago` (`idpago`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `negocio_pago_ibfk_2` FOREIGN KEY (`idinfo_negocio`) REFERENCES `info_negocio` (`idinfo_negocio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idinfo_negocio`) REFERENCES `info_negocio` (`idinfo_negocio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
  ADD CONSTRAINT `redes_sociales_ibfk_1` FOREIGN KEY (`idinfo_negocio`) REFERENCES `info_negocio` (`idinfo_negocio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`idinfo_negocio`) REFERENCES `info_negocio` (`idinfo_negocio`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
