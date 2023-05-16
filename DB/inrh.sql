-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2023 a las 21:54:14
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inrh`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratacion`
--

CREATE TABLE IF NOT EXISTS `contratacion` (
  `idContratacion` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `salario` float NOT NULL,
  `puesto` varchar(45) NOT NULL,
  `horaEntrada` varchar(5) NOT NULL,
  `horaSalida` varchar(5) NOT NULL,
  `Puestos_idPuestos` int(11) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  PRIMARY KEY (`idContratacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE IF NOT EXISTS `departamentos` (
  `idDepartamentos` int(11) NOT NULL AUTO_INCREMENT,
  `nameDepto` varchar(45) NOT NULL,
  `Empleados_idEmpleados` int(11) DEFAULT NULL,
  `Empresas_idEmpresas` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idDepartamentos`),
  KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE IF NOT EXISTS `documento` (
  `idDocumento` int(11) NOT NULL AUTO_INCREMENT,
  `nameDoc` varchar(30) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idDocumento`),
  KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_postulante`
--

CREATE TABLE IF NOT EXISTS `documento_postulante` (
  `idDocPost` int(11) NOT NULL AUTO_INCREMENT,
  `nameDocPost` varchar(20) NOT NULL,
  `Postulantes_idPostulantes` int(11) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idDocPost`),
  KEY `Postulantes_idPostulantes` (`Postulantes_idPostulantes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emergencia`
--

CREATE TABLE IF NOT EXISTS `emergencia` (
  `idEmergencia` int(11) NOT NULL AUTO_INCREMENT,
  `nameEmer` varchar(50) NOT NULL,
  `parentesco` varchar(45) NOT NULL,
  `phoneEmer` varchar(15) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  PRIMARY KEY (`idEmergencia`),
  KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE IF NOT EXISTS `empleados` (
  `idEmpleados` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `genero` varchar(1) NOT NULL,
  `fNac` date NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` text NOT NULL,
  `identificacion` varchar(45) NOT NULL,
  `CURP` varchar(20) NOT NULL,
  `NSS` varchar(15) NOT NULL,
  `RFC` varchar(15) NOT NULL,
  `street` varchar(45) NOT NULL,
  `numE` varchar(5) NOT NULL,
  `numI` varchar(5) DEFAULT NULL,
  `colonia` varchar(45) NOT NULL,
  `CP` varchar(8) NOT NULL,
  `municipio` varchar(30) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `fecha_contratado` timestamp NOT NULL DEFAULT current_timestamp(),
  `cambio_password` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idEmpleados`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_mes`
--

CREATE TABLE IF NOT EXISTS `empleado_mes` (
  `idEmpleado_mes` int(11) NOT NULL AUTO_INCREMENT,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `Publicado_idEmpleados` int(11) NOT NULL,
  `fecha_publicacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idEmpleado_mes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `idEmpresas` int(11) NOT NULL AUTO_INCREMENT,
  `registro_patronal` varchar(15) NOT NULL,
  `rfc` varchar(13) NOT NULL,
  `nombre_razon_social` text NOT NULL,
  `actividad_economica` text NOT NULL,
  `calle` text NOT NULL,
  `numero` varchar(5) NOT NULL,
  `numero_interior` varchar(5) DEFAULT NULL,
  `colonia` text NOT NULL,
  `cp` varchar(5) NOT NULL,
  `entidad` varchar(3) NOT NULL,
  `poblacion_municipio` varchar(40) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `convenio_reembolso` int(1) NOT NULL DEFAULT 0,
  `delegacion_imss` varchar(3) NOT NULL,
  `subdelegacion` varchar(40) NOT NULL,
  `clave_subdelegacion` varchar(20) NOT NULL,
  `mes_inicio_afiliacion` varchar(10) NOT NULL,
  `anio_inicio_afiliacion` int(4) NOT NULL,
  `fecha_registro_empresa` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idEmpresas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE IF NOT EXISTS `evaluaciones` (
  `idEvaluaciones` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEvaluacion` varchar(45) NOT NULL,
  PRIMARY KEY (`idEvaluaciones`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones_has_empleados`
--

CREATE TABLE IF NOT EXISTS `evaluaciones_has_empleados` (
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Evaluaciones_idEvaluaciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formacion`
--

CREATE TABLE IF NOT EXISTS `formacion` (
  `idFormacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCarrera` varchar(60) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFin` date DEFAULT NULL,
  `escuela` varchar(60) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  PRIMARY KEY (`idFormacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto_empleado`
--

CREATE TABLE IF NOT EXISTS `foto_empleado` (
  `idfoto_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `namePhoto` varchar(45) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idfoto_empleado`),
  KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_laboral`
--

CREATE TABLE IF NOT EXISTS `historial_laboral` (
  `idHistorial_laboral` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` text NOT NULL,
  `puesto` text NOT NULL,
  `noResponder` int(11) NOT NULL DEFAULT 0,
  `salario` float DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `trabajo_actual` int(11) NOT NULL DEFAULT 0,
  `fecha_fin` date DEFAULT NULL,
  `motivos` varchar(255) DEFAULT NULL,
  `logros` text DEFAULT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  PRIMARY KEY (`idHistorial_laboral`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `idNoticias` int(11) NOT NULL AUTO_INCREMENT,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_fin` date NOT NULL,
  `foto_noticia` int(11) NOT NULL,
  `name_foto` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idNoticias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organigrama`
--

CREATE TABLE IF NOT EXISTS `organigrama` (
  `idOrganigrama` int(11) NOT NULL AUTO_INCREMENT,
  `jefe` int(11) NOT NULL,
  `empleado` int(11) NOT NULL,
  PRIMARY KEY (`idOrganigrama`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulantes`
--

CREATE TABLE IF NOT EXISTS `postulantes` (
  `idPostulantes` int(11) NOT NULL AUTO_INCREMENT,
  `namePostulante` varchar(30) NOT NULL,
  `lastnamePostulante` varchar(30) NOT NULL,
  `phonePostulante` varchar(15) NOT NULL,
  `emailPostulante` varchar(30) NOT NULL,
  `colorPostulante` varchar(1) DEFAULT NULL,
  `Vacantes_idVacantes` int(11) NOT NULL,
  `statusPostulante` int(11) NOT NULL DEFAULT 1,
  `fRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idPostulantes`),
  KEY `Vacantes_idVacantes` (`Vacantes_idVacantes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntasevaluacion`
--

CREATE TABLE IF NOT EXISTS `preguntasevaluacion` (
  `idPreguntasEvaluacion` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(255) NOT NULL,
  `Evaluaciones_idEvaluaciones` int(11) NOT NULL,
  PRIMARY KEY (`idPreguntasEvaluacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE IF NOT EXISTS `puesto` (
  `idPuesto` int(11) NOT NULL AUTO_INCREMENT,
  `namePuesto` varchar(45) NOT NULL,
  `salario` float NOT NULL,
  `salario_integrado` float NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Departamentos_idDepartamentos` int(11) NOT NULL,
  `horario_entrada` time NOT NULL DEFAULT '09:00:00',
  `horario_salida` time NOT NULL DEFAULT '18:00:00',
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idPuesto`),
  KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`),
  KEY `Departamentos_idDepartamentos` (`Departamentos_idDepartamentos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reuniones`
--

CREATE TABLE IF NOT EXISTS `reuniones` (
  `idReuniones` int(11) NOT NULL AUTO_INCREMENT,
  `fechaReunion` datetime NOT NULL,
  `pregunta1` int(1) DEFAULT NULL,
  `pregunta2` int(1) DEFAULT NULL,
  `pregunta3` int(1) DEFAULT NULL,
  `pregunta4` int(1) DEFAULT NULL,
  `comentariosReunion` text DEFAULT NULL,
  `Postulantes_idPostulantes` int(11) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idReuniones`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacantes`
--

CREATE TABLE IF NOT EXISTS `vacantes` (
  `idVacantes` int(11) NOT NULL AUTO_INCREMENT,
  `nameVacante` varchar(45) NOT NULL,
  `salarioVacante` float NOT NULL,
  `requisitos` varchar(255) NOT NULL,
  `Empleados_idEmpleados` int(11) DEFAULT NULL,
  `Departamentos_idDepartamentos` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `color` varchar(7) NOT NULL,
  PRIMARY KEY (`idVacantes`),
  KEY `Departamentos_idDepartamentos` (`Departamentos_idDepartamentos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `departamentos_ibfk_1` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`);

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`);

--
-- Filtros para la tabla `documento_postulante`
--
ALTER TABLE `documento_postulante`
  ADD CONSTRAINT `documento_postulante_ibfk_1` FOREIGN KEY (`Postulantes_idPostulantes`) REFERENCES `postulantes` (`idPostulantes`);

--
-- Filtros para la tabla `emergencia`
--
ALTER TABLE `emergencia`
  ADD CONSTRAINT `emergencia_ibfk_1` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`);

--
-- Filtros para la tabla `foto_empleado`
--
ALTER TABLE `foto_empleado`
  ADD CONSTRAINT `foto_empleado_ibfk_1` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`);

--
-- Filtros para la tabla `postulantes`
--
ALTER TABLE `postulantes`
  ADD CONSTRAINT `postulantes_ibfk_1` FOREIGN KEY (`Vacantes_idVacantes`) REFERENCES `vacantes` (`idVacantes`);

--
-- Filtros para la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD CONSTRAINT `puesto_ibfk_1` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`),
  ADD CONSTRAINT `puesto_ibfk_2` FOREIGN KEY (`Departamentos_idDepartamentos`) REFERENCES `departamentos` (`idDepartamentos`);

--
-- Filtros para la tabla `vacantes`
--
ALTER TABLE `vacantes`
  ADD CONSTRAINT `vacantes_ibfk_1` FOREIGN KEY (`Departamentos_idDepartamentos`) REFERENCES `departamentos` (`idDepartamentos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
