-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-09-2023 a las 15:03:28
-- Versión del servidor: 5.6.51-cll-lve
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inconsulting`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `idAsistencias` int(11) NOT NULL,
  `entrada` time DEFAULT NULL,
  `salida` time NOT NULL,
  `fecha_asistencia` date NOT NULL,
  `entrada_descanso` time NOT NULL,
  `salida_descanso` time NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`idAsistencias`, `entrada`, `salida`, `fecha_asistencia`, `entrada_descanso`, `salida_descanso`, `Empleados_idEmpleados`) VALUES
(1, '07:31:00', '16:37:00', '2023-06-05', '14:32:00', '15:00:00', 3),
(2, '08:25:00', '16:37:00', '2023-06-06', '14:32:00', '15:00:00', 3),
(3, '08:25:00', '16:37:00', '2023-06-07', '14:32:00', '15:00:00', 3),
(4, '08:25:00', '16:37:00', '2023-06-08', '14:32:00', '15:00:00', 3),
(5, '08:25:00', '18:00:00', '2023-06-05', '14:32:00', '15:00:00', 47),
(6, '08:25:01', '18:00:00', '2023-06-06', '14:32:00', '15:00:00', 47),
(7, '08:25:02', '18:00:00', '2023-06-07', '14:32:00', '15:00:00', 47),
(8, '08:25:03', '18:00:00', '2023-06-08', '14:32:00', '15:00:00', 47),
(9, '00:00:00', '00:00:00', '2023-05-23', '00:00:00', '00:00:00', 3),
(10, '08:25:00', '16:37:00', '2023-05-24', '14:32:00', '15:30:00', 3),
(11, '08:25:00', '16:37:00', '2023-05-25', '14:32:00', '15:40:00', 3),
(12, '08:25:00', '18:00:00', '2023-06-05', '14:32:00', '15:00:00', 6),
(13, '08:25:00', '18:00:00', '2023-06-06', '15:32:00', '15:00:00', 6),
(14, '08:25:00', '18:00:00', '2023-06-07', '16:32:00', '16:00:00', 6),
(15, '08:25:00', '18:00:00', '2023-06-08', '17:32:00', '17:00:00', 6),
(16, '09:25:00', '18:00:00', '2023-06-09', '18:32:00', '18:00:00', 6),
(17, '09:25:00', '18:00:00', '2023-06-10', '19:32:00', '19:00:00', 6),
(18, '10:25:00', '16:37:00', '2023-06-11', '14:32:00', '15:00:00', 6),
(19, '09:10:00', '18:00:00', '2023-06-12', '21:32:00', '21:00:00', 6),
(20, '09:11:00', '18:00:00', '2023-06-13', '22:32:00', '22:00:00', 6),
(21, '08:25:00', '18:00:00', '2023-06-14', '23:32:00', '23:00:00', 6),
(22, '09:25:00', '18:00:00', '2023-06-15', '00:32:00', '00:00:00', 6),
(23, '08:25:00', '18:00:00', '2023-06-16', '01:32:00', '01:00:00', 6),
(24, '08:25:00', '18:00:00', '2023-06-17', '02:32:00', '02:00:00', 6),
(25, '08:25:00', '16:37:00', '2023-06-18', '14:32:00', '15:00:00', 6),
(26, '08:25:00', '16:37:00', '2023-06-19', '14:32:00', '15:00:00', 6),
(27, '08:25:00', '16:37:00', '2023-06-20', '14:32:00', '15:00:00', 6),
(28, '08:25:00', '16:37:00', '2023-06-21', '14:32:00', '15:00:00', 6),
(29, '08:25:00', '16:37:00', '2023-06-22', '14:32:00', '15:00:00', 6),
(46, '00:00:00', '00:00:00', '2023-06-23', '00:00:00', '00:00:00', 6),
(47, '08:25:04', '18:00:00', '2023-06-09', '14:32:00', '15:00:00', 47),
(48, '08:25:05', '18:00:00', '2023-06-10', '14:32:00', '15:00:00', 47),
(49, '08:25:06', '18:00:00', '2023-06-12', '14:32:00', '15:00:00', 47),
(50, '08:25:07', '18:00:00', '2023-06-13', '14:32:00', '15:00:00', 47),
(51, '08:25:08', '18:00:00', '2023-06-14', '14:32:00', '15:00:00', 47),
(52, '08:25:09', '18:00:00', '2023-06-15', '14:32:00', '15:00:00', 47),
(53, '08:25:10', '18:00:00', '2023-06-16', '14:32:00', '15:00:00', 47),
(54, '08:25:11', '18:00:00', '2023-06-17', '14:32:00', '15:00:00', 47),
(55, '00:00:00', '00:00:00', '2023-06-23', '00:00:00', '00:00:00', 58),
(56, '07:59:00', '18:37:00', '2023-08-05', '14:32:00', '15:00:00', 3),
(57, '07:59:00', '18:37:00', '2023-08-06', '14:32:00', '15:00:00', 3),
(58, '07:59:00', '18:37:00', '2023-08-07', '14:32:00', '15:00:00', 3),
(59, '07:59:00', '18:37:00', '2023-08-08', '14:32:00', '15:00:00', 3),
(60, '07:59:00', '18:37:00', '2023-08-09', '14:32:00', '15:00:00', 3),
(61, '07:59:00', '18:37:00', '2023-08-10', '14:32:00', '15:00:00', 3),
(62, '07:59:00', '18:37:00', '2023-08-11', '14:32:00', '15:00:00', 3),
(63, '07:59:00', '18:37:00', '2023-08-12', '14:32:00', '15:00:00', 3),
(64, '07:59:00', '18:37:00', '2023-08-13', '14:32:00', '15:00:00', 3),
(65, '07:59:00', '18:37:00', '2023-08-14', '14:32:00', '15:00:00', 3),
(66, '07:59:00', '18:37:00', '2023-08-15', '14:32:00', '15:00:00', 3),
(67, '07:59:00', '18:37:00', '2023-08-16', '14:32:00', '15:00:00', 3),
(68, '07:59:00', '18:37:00', '2023-08-17', '14:32:00', '15:00:00', 3),
(69, '07:59:00', '18:37:00', '2023-08-18', '14:32:00', '15:00:00', 3),
(70, '07:59:00', '18:37:00', '2023-08-19', '14:32:00', '15:00:00', 3),
(71, '07:59:00', '18:37:00', '2023-08-20', '14:32:00', '15:00:00', 3),
(72, '07:59:00', '18:37:00', '2023-08-21', '14:32:00', '15:00:00', 3),
(73, '07:59:00', '18:37:00', '2023-08-22', '14:32:00', '15:00:00', 3),
(74, '07:59:00', '18:37:00', '2023-08-23', '14:32:00', '15:00:00', 3),
(75, '07:59:00', '18:37:00', '2023-08-24', '14:32:00', '15:00:00', 3),
(76, '07:59:00', '18:37:00', '2023-08-25', '14:32:00', '15:00:00', 3),
(77, '07:59:00', '18:37:00', '2023-08-26', '14:32:00', '15:00:00', 3),
(78, '07:59:00', '18:37:00', '2023-08-27', '14:32:00', '15:00:00', 3),
(79, '07:59:00', '18:37:00', '2023-08-28', '14:32:00', '15:00:00', 3),
(80, '07:59:00', '18:37:00', '2023-08-29', '14:32:00', '15:00:00', 3),
(81, '07:59:00', '18:37:00', '2023-08-30', '14:32:00', '15:00:00', 3),
(82, '07:59:00', '18:37:00', '2023-08-31', '14:32:00', '15:00:00', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_gastos`
--

CREATE TABLE `categorias_gastos` (
  `idCategoria` int(11) NOT NULL,
  `nameCategoria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias_gastos`
--

INSERT INTO `categorias_gastos` (`idCategoria`, `nameCategoria`) VALUES
(1, 'Transporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE `contratos` (
  `idContrato` int(11) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `tipo_contrato` varchar(45) NOT NULL,
  `fecha_contrato` date NOT NULL,
  `fin_contrato` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`idContrato`, `Empleados_idEmpleados`, `tipo_contrato`, `fecha_contrato`, `fin_contrato`) VALUES
(1, 106, 'Contrato por Tiempo Indeterminado', '2023-06-26', NULL),
(2, 38, 'Contrato por Tiempo Indeterminado', '2023-04-12', NULL),
(3, 132, 'Contrato por Tiempo Indeterminado', '2023-06-27', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditos`
--

CREATE TABLE `creditos` (
  `idCreditos` int(11) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `tipo_credito` varchar(20) NOT NULL,
  `numero_credito` varchar(50) NOT NULL,
  `valor_descuento` float NOT NULL,
  `inicio_credito` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `creditos`
--

INSERT INTO `creditos` (`idCreditos`, `Empleados_idEmpleados`, `tipo_credito`, `numero_credito`, `valor_descuento`, `inicio_credito`) VALUES
(2, 132, 'Cuota fija', '55542424', 1600, '2023-01-01'),
(3, 21, 'Porcentaje', '44569985525', 11, '2023-08-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `idDepartamentos` int(11) NOT NULL,
  `nameDepto` varchar(45) NOT NULL,
  `Empleados_idEmpleados` int(11) DEFAULT NULL,
  `Empresas_idEmpresas` int(11) NOT NULL DEFAULT '0',
  `Pertenencia` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`idDepartamentos`, `nameDepto`, `Empleados_idEmpleados`, `Empresas_idEmpresas`, `Pertenencia`, `status`) VALUES
(41, 'DIRECCIÓN GENERAL', 23, 6, 0, 1),
(42, 'DIRECCIÓN COMERCIAL', 28, 6, 41, 1),
(43, 'DIRECCIÓN DE OPERACIONES', 32, 6, 41, 1),
(44, 'DIRECCIÓN RH', 30, 6, 41, 1),
(45, 'DIRECCIÓN ADMINISTRATIVA', 6, 6, 41, 1),
(46, 'JEFE DE RECIBA', 22, 6, 42, 1),
(47, 'JEFE DE CORTES', 21, 6, 42, 1),
(48, 'JEFE DE ALMACÉN DE ISNUMOS', 31, 6, 42, 1),
(49, 'JEFE DE ALMACÉN DE CAJA DE CAMPO', 19, 6, 42, 1),
(50, 'JEFE DE LOGISTICA', 35, 6, 43, 1),
(51, 'JEFE DE INOCUIDAD Y CALIDAD', 36, 6, 43, 1),
(52, 'JEFE DE CÁMARAS FRÍAS', 34, 6, 43, 1),
(53, 'JEFE OPERADOR DE MAQUINA', 27, 6, 43, 1),
(54, 'AUXILIAR RH', 49, 6, 44, 1),
(55, 'JEFE DE COCINA', 50, 6, 44, 1),
(56, 'RECEPCION', 53, 6, 44, 1),
(57, 'VIGILANCIA', 54, 6, 44, 1),
(58, 'MENSAJERÍA Y MANTENIMIENTO', 55, 6, 44, 1),
(59, 'CONTABILIDAD', 56, 6, 45, 1),
(60, 'FINANZAS', 75, 6, 45, 1),
(61, 'TESORERÍA', 58, 6, 45, 1),
(62, 'AUXILIAR OPERADOR MAQUINA', 39, 6, 53, 1),
(63, 'COORDINACIÓN ESTIBADORES', 44, 6, 53, 1),
(64, 'DIRECCIÓN GENERAL', 59, 7, 0, 1),
(65, 'SUBDIRECCIÓN', 61, 7, 64, 1),
(66, 'MARKETING', 62, 7, 65, 1),
(67, 'DISEÑO', 63, 7, 65, 1),
(68, 'RECURSOS HUMANOS', 67, 7, 65, 1),
(69, 'CONTABILIDAD', 64, 7, 65, 1),
(70, 'FINANZAS', 65, 7, 65, 1),
(71, 'CONTROL INTERNO', 66, 7, 65, 1),
(72, 'AUXILIAR CONTABILIDAD', 71, 7, 69, 1),
(73, 'DIRECCIÓN GENERAL', 105, 8, 0, 1),
(74, 'AUDTORIA', NULL, 7, 65, 1),
(75, 'AUXILIAR AUDITORIA', NULL, 7, 74, 1),
(76, 'SEGUNDO AUXILIAR CONTABILIDAD', 74, 7, 69, 1),
(77, 'DIRECCIÓN GENERAL', 76, 3, 0, 1),
(78, 'SUBDIRECCIÓN', 77, 3, 77, 1),
(79, 'DIRECCIÓN DE SEGURIDAD', 79, 3, 78, 1),
(80, 'DIRECCIÓN ADMINISTRATIVA', 78, 3, 78, 1),
(81, 'DIRECCIÓN COMERCIAL', 80, 3, 78, 1),
(82, 'SUPERVISOR ZAMORA', 82, 3, 79, 1),
(83, 'SUPERVISOR SAN MIGUEL DE ALLENDE', 81, 3, 79, 1),
(84, 'SUPERVISOR GUANAJUATO', 84, 3, 79, 1),
(85, 'SUPERVISOR OCOTLAN', 85, 3, 79, 1),
(86, 'SUPERVISOR LA PIEDAD', 83, 3, 79, 1),
(87, 'SUPERVISOR COLIMA', 86, 3, 79, 1),
(88, 'RECURSOS HUMANOS', 87, 3, 80, 1),
(89, 'ADMINISTRACIÓN', 88, 3, 80, 1),
(90, 'TESORERÍA', 89, 3, 80, 1),
(91, 'VENTAS', 90, 3, 81, 1),
(92, 'JEFE DE COMPRAS', 91, 3, 81, 1),
(93, 'DIRECTOR GENERAL', 0, 8, 0, 0),
(94, 'DEPARTAMENTO RECURSOS HUMANOS', 106, 8, 73, 1),
(95, 'DEPARTAMENTO ADMINISTRATIVO', 107, 8, 73, 1),
(96, 'DEPARTAMENTO COMERCIAL', 108, 8, 73, 1),
(97, 'DEPARTAMENTO DE PRODUCCIÓN', 109, 8, 73, 1),
(98, 'CONTABILIDAD', 111, 8, 95, 1),
(99, 'ADMINITRACIÓN', 112, 8, 95, 1),
(100, 'FINANZAS', 115, 8, 95, 1),
(101, 'ENGORDA', NULL, 8, 97, 1),
(102, 'CONTROL DE CALIDAD', 121, 8, 97, 1),
(103, 'VETERINARIA', 122, 8, 97, 1),
(104, 'INVENTARIO', 117, 8, 96, 1),
(105, 'VENTAS', 118, 8, 96, 1),
(106, 'COMPRAS', NULL, 8, 96, 1),
(107, 'DIRECCION GENERAL', 123, 9, 0, 1),
(108, 'ADMINISTRACIÓN', 124, 9, 107, 1),
(109, 'PRODUCCIÓN', 125, 9, 107, 1),
(110, 'OPERACIONES', 126, 9, 107, 1),
(111, 'COMERCIAL', 127, 9, 107, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dia_horario`
--

CREATE TABLE `dia_horario` (
  `idDia_Horario` int(11) NOT NULL,
  `Horarios_idHorarios` int(11) NOT NULL,
  `dia_Laborable` int(1) NOT NULL,
  `hora_Entrada` time NOT NULL,
  `hora_Salida` time DEFAULT NULL,
  `numero_Horas` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dia_horario`
--

INSERT INTO `dia_horario` (`idDia_Horario`, `Horarios_idHorarios`, `dia_Laborable`, `hora_Entrada`, `hora_Salida`, `numero_Horas`) VALUES
(46, 1, 1, '09:00:00', '18:00:00', 9),
(47, 1, 2, '09:00:00', '18:00:00', 9),
(48, 1, 3, '09:00:00', '18:00:00', 9),
(49, 1, 4, '09:00:00', '18:00:00', 9),
(50, 1, 5, '09:00:00', '18:00:00', 9),
(51, 1, 6, '09:00:00', '18:00:00', 9),
(57, 2, 1, '08:00:00', '17:00:00', 9),
(58, 2, 2, '08:00:00', '17:00:00', 9),
(59, 2, 3, '08:00:00', '17:00:00', 9),
(60, 2, 4, '08:00:00', '17:00:00', 9),
(61, 2, 5, '08:00:00', '17:00:00', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `divisas`
--

CREATE TABLE `divisas` (
  `idDivisa` int(11) NOT NULL,
  `nameDivisa` text NOT NULL,
  `divisa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `divisas`
--

INSERT INTO `divisas` (`idDivisa`, `nameDivisa`, `divisa`) VALUES
(1, 'PESO MEXICANO', 'MXN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `idDocumento` int(11) NOT NULL,
  `nameDoc` varchar(30) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`idDocumento`, `nameDoc`, `Empleados_idEmpleados`, `fechaCreacion`) VALUES
(1, 'curriculum', 3, '2023-04-25 06:00:00'),
(2, 'acta_nacimiento', 3, '2023-04-25 06:00:00'),
(3, 'comprobante-domicilio', 3, '2023-04-25 06:00:00'),
(4, 'identificacion-anverso', 3, '2023-04-25 06:00:00'),
(5, 'identificacion-reverso', 3, '2023-04-25 06:00:00'),
(6, 'rfc', 3, '2023-04-25 06:00:00'),
(7, 'curp', 3, '2023-04-25 06:00:00'),
(8, 'nss', 3, '2023-04-25 06:00:00'),
(9, 'comprobante_estudios', 3, '2023-04-25 06:00:00'),
(10, 'recomendacion-laboral', 3, '2023-04-25 06:00:00'),
(11, 'recomendacion-personal', 3, '2023-04-25 06:00:00'),
(12, 'comprobante_domicilio', 3, '2023-05-03 21:06:28'),
(13, 'identificacion_anverso', 3, '2023-05-03 21:06:33'),
(14, 'estado_cuenta', 3, '2023-05-03 21:06:40'),
(16, 'curriculum', 10, '2023-05-08 20:04:49'),
(17, 'curriculum', 94, '2023-06-23 16:18:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_gastos`
--

CREATE TABLE `documentos_gastos` (
  `idDocumento_Gasto` int(11) NOT NULL,
  `Gastos_idGastos` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `nameDocumento` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `documentos_gastos`
--

INSERT INTO `documentos_gastos` (`idDocumento_Gasto`, `Gastos_idGastos`, `tipo`, `nameDocumento`) VALUES
(4, 2, 'pdf', 'FacturaA743.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_tarea_entregas`
--

CREATE TABLE `documentos_tarea_entregas` (
  `idDocumentoTareaEntregas` int(11) NOT NULL,
  `nameDocumento` text NOT NULL,
  `tipo` varchar(6) NOT NULL,
  `Tareas_idTareas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `documentos_tarea_entregas`
--

INSERT INTO `documentos_tarea_entregas` (`idDocumentoTareaEntregas`, `nameDocumento`, `tipo`, `Tareas_idTareas`) VALUES
(1, 'curriculum.pdf', 'pdf', 1),
(2, 'IN Consulting México - Empleados (3) (2).pdf', 'pdf', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_postulante`
--

CREATE TABLE `documento_postulante` (
  `idDocPost` int(11) NOT NULL,
  `nameDocPost` varchar(20) NOT NULL,
  `Postulantes_idPostulantes` int(11) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_tarea`
--

CREATE TABLE `documento_tarea` (
  `idDocumentoTarea` int(11) NOT NULL,
  `nameDocumento` text NOT NULL,
  `tipo` varchar(6) NOT NULL,
  `Tareas_idTareas` int(11) NOT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `documento_tarea`
--

INSERT INTO `documento_tarea` (`idDocumentoTarea`, `nameDocumento`, `tipo`, `Tareas_idTareas`, `fecha_subida`) VALUES
(1, 'curriculum.pdf', 'pdf', 1, '2023-07-03 21:36:10'),
(2, 'IN Consulting México - Empleados (3).pdf', 'pdf', 2, '2023-07-03 21:36:37'),
(3, 'IN Consulting México - Empleados (2).pdf', 'pdf', 2, '2023-07-03 21:36:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emergencia`
--

CREATE TABLE `emergencia` (
  `idEmergencia` int(11) NOT NULL,
  `nameEmer` varchar(50) NOT NULL,
  `parentesco` varchar(45) NOT NULL,
  `phoneEmer` varchar(15) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `emergencia`
--

INSERT INTO `emergencia` (`idEmergencia`, `nameEmer`, `parentesco`, `phoneEmer`, `Empleados_idEmpleados`) VALUES
(1, 'Miguel Angel Contreras Parra', 'padre', '4435398291', 3),
(3, '32165', 'madre', '654654654', 5),
(4, 'LUIS NATIVIDAD', 'padre', '5516080808', 6),
(7, 'Emergencia', 'hermano', '7894567894', 10),
(16, 'Oscar', 'pareja', '4435398291', 19),
(17, 'Esposa', 'pareja', '4433265323', 20),
(18, 'MIRYANA LOPEZ', 'madre', '6622556688', 21),
(19, 'padre', 'padre', '4454875421', 22),
(20, 'Ana Pérez', 'hermano', '5555551111', 23),
(21, 'Carlos López', 'pareja', '5555552222', 24),
(22, 'Laura García', 'madre', '555555333', 25),
(23, 'Manuel Rodríguez', 'padre', '5555554444', 26),
(24, 'Marta Hernández', 'madre', '55555555555', 27),
(25, 'Carlos Martínez', 'pareja', '5555556666', 28),
(26, 'Patricia Vargas', 'pareja', '5555557777', 29),
(27, 'Alejandro Sánchez', 'hermano', '5555558888', 30),
(28, 'Eduardo Ramírez', 'padre', '5555550000', 31),
(29, 'oscar contreras', 'padre', '4521654147', 32),
(30, 'MIRYANA LOPEZ', 'madre', '4521654147', 33),
(31, 'oscar contreras', 'amigo', '4521679799', 34),
(32, 'MIRYANA LOPEZ', 'madre', '33990088776', 35),
(33, 'MIRYANA LOPEZ', 'hermano', '4521654147', 36),
(34, 'oscar contreras', 'padre', '4521679799', 37),
(35, 'MIRYANA LOPEZ', 'madre', '4521654147', 38),
(36, 'oscar contreras', 'amigo', '4521679799', 39),
(37, 'odilia onofre', 'pareja', '4521654147', 40),
(38, 'MIRYANA LOPEZ', 'amigo', '4521654147', 41),
(39, 'ANDRES MORALES', 'padre', '7788993366', 42),
(40, 'LUIS PEREZ', 'padre', '9900776655', 43),
(41, 'ALFREDO SAMANO GALAN', 'amigo', '5544900175', 44),
(42, 'KAROL DIAZ', 'pareja', '3388065489', 45),
(43, 'ANDRES MORALES', 'amigo', '4521679799', 46),
(44, 'RAUL ALONSO JIMENEZ', 'hermano', '4521654147', 47),
(45, 'ALFREDO SAMANO GALAN', 'padre', '4521679799', 48),
(46, 'LUIS PEREZ', 'padre', '4521654147', 49),
(47, 'ANDRES MORALES', 'hermano', '4521679799', 50),
(48, 'JAVIER HERNANDEZ BALCAZAR', 'padre', '4521679799', 51),
(49, 'PATRICIO GOMEZ', 'padre', '4499887766', 52),
(50, 'PATRICIO GOMEZ', 'padre', '4499887766', 53),
(51, 'JULIAN QUIÑONES', 'amigo', '5529136312', 54),
(52, 'ALFREDO SAMANO GALAN', 'hermano', '4521679799', 55),
(53, 'ALICIA VILLEGAS', 'pareja', '4521679799', 56),
(54, 'LUIS PEREZ', 'padre', '6655882987', 57),
(55, 'ALFREDO SAMANO GALAN', 'amigo', '4521679799', 58),
(56, 'LUIS PEREZ', 'padre', '4521679799', 59),
(57, 'LUIS PEREZ', 'padre', '4521679799', 60),
(58, 'COPITZI RAMIREZ', 'madre', '5544990198', 61),
(59, 'RODOLFO REYES RENDOND', 'amigo', '4521679799', 62),
(60, 'MIRYANA LOPEZ', 'madre', '4521679799', 63),
(61, 'ANDRES MORALES', 'hermano', '4521679799', 64),
(62, 'odilia onofre', 'madre', '4521679799', 65),
(63, 'LUIS PEREZ', 'madre', '4521654147', 66),
(64, 'odilia onofre', 'madre', '4521679799', 67),
(65, 'odilia onofre', 'madre', '4521679799', 68),
(66, '4455900175', 'padre', '446688900192', 69),
(67, 'MIRYANA LOPEZ', 'hermano', '4521679799', 70),
(68, 'ANDRES MORALES', 'hermano', '4521654147', 71),
(69, 'ALFREDO SAMANO GALAN', 'madre', '4433900175', 72),
(70, 'MIRYANA LOPEZ', 'hermano', '4521679799', 73),
(71, 'ALFREDO SAMANO GALAN', 'hermano', '4521679799', 74),
(72, 'ANDRES MORALES', 'hermano', '4521679799', 75),
(73, 'MIRYANA LOPEZ', 'amigo', '4521654147', 76),
(74, 'ANDRES PEREZ', 'padre', '4455890215', 77),
(75, 'EMRIQUE VILLA', 'pareja', '4433071539', 78),
(76, 'RAMIRO CADENA', 'hermano', '5512396528', 79),
(77, 'SERGIO SOTO SANCHEZ', 'padre', '5589007654', 80),
(78, 'ALFREDO SAMANO GALAN', 'padre', '4521679799', 81),
(79, 'MIRYANA LOPEZ', 'madre', '4521679799', 82),
(80, 'ODILIA ONOFRE', 'madre', '4521679799', 83),
(81, 'LUIS PEREZ', 'padre', '4521679799', 84),
(82, 'MIRYANA LOPEZ', 'madre', '4521679799', 85),
(83, 'ANDRES MORALES', 'padre', '4521679799', 86),
(84, 'JOSE JULIAN PEREZ CONTRERAS', 'amigo', '5544670192', 87),
(85, 'RAUL ALONSO JIMENEZ', 'padre', '4490876524', 88),
(86, 'ALFREDO SAMANO GALAN', 'padre', '4432098654', 89),
(87, 'IVAN SANDOVAL', 'pareja', '4433900087', 90),
(88, 'ALFREDO SAMANO GALAN', 'padre', '4521679799', 91),
(89, 'ANDRES MORALES', 'hermano', '4521654147', 92),
(90, 'ALFREDO SAMANO GALAN', 'hermano', '4521679799', 93),
(91, 'MIRYANA LOPEZ', 'madre', '4521679799', 94),
(92, 'MIRYANA LOPEZ', 'madre', '4521679799', 95),
(93, 'ANDRES MORALES', 'hermano', '4521679799', 96),
(94, 'JOSE LUIS', 'hermano', '0', 97),
(95, 'LUIS PEREZ', 'padre', '5529136312', 98),
(96, 'ROSA TOSCANA', 'pareja', '7899378976', 99),
(97, 'JUAN CARLOS CACHO', 'hermano', '5528192367', 100),
(98, 'oscar contreras', 'amigo', '4521679799', 101),
(99, 'RAMIRO CADENA', 'pareja', '7567890990', 102),
(100, 'ALFREDO SAMANO GALAN', 'padre', '4521679799', 103),
(101, 'LAURA SANCHEZ VALENCIA', 'amigo', '4433900175', 104),
(102, 'ALFREDO SAMANO GALAN', 'amigo', '4521679799', 105),
(103, 'RAUL GERARDO MOLINA', 'amigo', '4761239456', 106),
(104, 'LUIS PEREZ', 'padre', '4521679799', 107),
(105, 'MIRYANA LOPEZ', 'madre', '4521679799', 108),
(106, 'ALFREDO SAMANO GALAN', 'padre', '443390176', 109),
(107, 'MIRYANA LOPEZ', 'padre', '4521679799', 110),
(108, 'GRISELDA CABALLERO PEREZ', 'madre', '5579123098', 111),
(109, 'ALFREDO SAMANO GALAN', 'hermano', '4521679799', 112),
(110, 'ANDRES MORALES', 'hermano', '4433900176', 113),
(111, 'MIRYANA LOPEZ', 'madre', '4521679799', 114),
(112, 'oscar contreras', 'amigo', '4521679799', 115),
(113, 'JULIO NAVA', 'hermano', '3332500902', 116),
(114, 'LUIS PEREZ', 'amigo', '4521679799', 117),
(115, 'MIRYANA LOPEZ', 'amigo', '4521679799', 118),
(116, 'MIRYANA LOPEZ', 'madre', '4521654147', 119),
(117, 'ANDRES MORALES', 'padre', '4521654147', 120),
(118, 'LUIS PEREZ', 'hermano', '4521654147', 121),
(119, 'oscar contreras', 'amigo', '4521654147', 122),
(120, 'LUIS PEREZ', 'padre', '4521679799', 123),
(121, 'MIRYANA LOPEZ', 'madre', '4521679799', 124),
(122, 'oscar contreras', 'amigo', '4521679799', 125),
(123, 'ALFREDO SAMANO GALAN', 'padre', '4521679799', 126),
(124, 'MIRYANA LOPEZ', 'pareja', '4521679799', 127),
(125, 'ANDRES MORALES', 'pareja', '4521679799', 128),
(126, 'odilia onofre', 'madre', '4521679799', 129),
(127, 'LUIS PEREZ', 'padre', '4521654147', 130),
(128, 'ALFREDO SAMANO GALAN', 'hermano', '4521679799', 131),
(129, 'ALFREDO SAMANO GALAN', 'amigo', '4521679799', 132),
(130, 'odilia onofre', 'madre', '4521679799', 133);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `idEmpleados` int(11) NOT NULL,
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
  `status` int(1) NOT NULL DEFAULT '1',
  `fecha_contratado` date NOT NULL,
  `fecha_baja` date DEFAULT NULL,
  `causaBaja` int(11) DEFAULT NULL,
  `detalles_baja` text,
  `cambio_password` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idEmpleados`, `name`, `lastname`, `genero`, `fNac`, `phone`, `email`, `password`, `identificacion`, `CURP`, `NSS`, `RFC`, `street`, `numE`, `numI`, `colonia`, `CP`, `municipio`, `estado`, `status`, `fecha_contratado`, `fecha_baja`, `causaBaja`, `detalles_baja`, `cambio_password`) VALUES
(3, 'Oscar Rafael', 'Contreras Flota', '1', '1991-12-19', '4435398291', 'oscarcontrerasf91@gmail.com', '$2a$07$asxx54ahjppf45sd87a5aubbQpcQrXYn9ZKDUEfe01oXXasks7XAG', '554025566656', 'COFO911219HMNNLS06', '654321965432', 'COFO911219925', 'Palomas', '149', '', 'La hacienda', '58330', 'Morelia', 'MCH', 1, '2021-06-28', NULL, NULL, NULL, 1),
(5, 'Rafael', 'Flota Sanchez', '1', '1995-05-30', '3213216565', 'rafa@gmail.com', '', '3ASD354', 'CASD321533654DASD22', '64641323156', '65465sdasd65', 'alsjkh', '654', '1', '32132', '32132', 'sasd', 'asdad', 1, '2023-04-16', NULL, NULL, NULL, 0),
(6, 'ERICK', 'NATIVIDAD', '1', '1993-04-16', '4433900175', 'ericknatividad93@hotmail.com', '$2a$07$asxx54ahjppf45sd87a5au5vpTJpUv2SrXnwi/fb36RZfJVoop9oS', '8', 'CASD321533654DASD22', '53029875477', 'NABE9304168D3', 'FACULTAD DE PSICOLOGIA', '45', '', 'REAL UNIVERSIDAD', '58088', 'Morelia', 'MCH', 1, '2019-06-28', NULL, NULL, NULL, 1),
(10, 'Prueba', 'Prueba', '0', '2023-05-17', '4425362514', 'prueba@gmail.com', '', '44555855685', 'PRUE25252MNNLS54', '1234567899875', 'PRUE25252', 'PRUEBA', '5', '1', 'ASD', '321654', 'Morelia', 'Michoacán', 0, '2023-05-08', NULL, NULL, NULL, 0),
(19, 'Mayel', 'Ortega Cambron', '0', '1998-07-23', '5526553212', 'mayel_ortega@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFoxjRU8oL9T7K8WJPF8iklsi8G3kHCe', '456789789456', 'ORCM321654987654', '3216541651', 'ORCM32165331', 'Rey Moctezuma', '64', '', 'Mil cumbres', '58290', 'Morelia', 'Michoacán', 1, '2023-05-15', NULL, NULL, NULL, 0),
(20, 'Yoan Adan', 'Leon', '1', '1960-01-01', '4430000001', 'presidente@presi.com', '$2a$07$asxx54ahjppf45sd87a5au09Xobz.kcMYEWZUX7DpLSM2UYd4GUHq', '100000001', 'gepr600101hmnnlq50', '1000000002', 'gepr600101252', 'Loma dorada', '01', '', 'Las lomas', '53001', 'Morelia', 'Selecciona un estado', 1, '2023-05-17', NULL, NULL, NULL, 0),
(21, 'ARMANDO', 'ARCHUNDIA GONZALEZ', '1', '1991-05-11', '4433900175', 'armando.archundia@asdasd.com', '$2a$07$asxx54ahjppf45sd87a5aurddAI2BXhiv9mPV1Ckqwr5MLxhkjq9y', '7253762', 'GOAA910511HMNTCR07', '93725481921', 'GOAA910511HMNTC', 'OLIMPIADA', '34', '', 'UNIVERSIDAD', '89990', 'MORELIA', 'MICHOACAN', 1, '2023-05-17', NULL, NULL, NULL, 0),
(22, 'Gustavo', 'Arreola', '1', '1984-05-25', '4465986587', 'gus@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auuULuOA7.yjgcURqGzZXUeaY.w1/n3.i', '321654321654', 'ARGU840525hmnfd05', '32132165498', 'argu840525', 'asd', '321', '', '32', '58260', 'Morelia', 'Michoacán', 1, '2023-05-18', NULL, NULL, NULL, 0),
(23, 'Juan', 'Pérez', '1', '1985-05-15', '5551234567', 'juan.perez@example.com', '$2a$07$asxx54ahjppf45sd87a5aubbQpcQrXYn9ZKDUEfe01oXXasks7XAG', '1234567890', 'PERJ850512HDFXXX01', '9876543210', 'PERJ850512XXX', 'Calle Principal', '123', '1A', 'Centro', '12345', 'Ciudad de México', 'CDMX', 1, '2023-05-19', NULL, NULL, NULL, 1),
(24, 'María', 'López', '0', '1990-09-28', '5559876543', 'maria.lopez@example.com', '$2a$07$asxx54ahjppf45sd87a5autRLTQuEDFjtDghTEl2HCO.NFslgg7Tu', '0987654321', 'LOPM900928MDFXXX02', '1234567890', 'LOPM900928XXX', 'Avenida Juárez', '456', '2B', 'Reforma', '54321', 'Ciudad de México', 'CDMX', 0, '2023-05-19', '2023-05-24', NULL, NULL, 0),
(25, 'Roberto', 'García', '1', '1982-11-02', '5555555555', 'roberto.garcia@example.com', '$2a$07$asxx54ahjppf45sd87a5aujd4UPYbNfEZcue0P6yyIPgFYafH1fea', '1357924680', 'GARR821102MDFXXX03', '9876543210', 'GARR821102XXX', 'GARR821102XXX', '789', '3C', 'Del Valle', '67890', 'Ciudad de México', 'CDMX', 1, '2023-05-19', NULL, NULL, NULL, 0),
(26, 'Laura', 'Rodríguez', '0', '1995-03-15', '5552223333', 'laura.rodriguez@example.com', '$2a$07$asxx54ahjppf45sd87a5aunPLtscj8Bj2VjY3Dod1v5EHrVjGV2vG', '8642097531', 'RODL950315MDFXXX04', '1234567890', 'RODL950315XXX', 'Avenida Reforma', '321', '4D', 'Polanco', '45678', 'Ciudad de México', 'CDMX', 0, '2023-05-19', '2023-05-18', NULL, NULL, 0),
(27, 'Andrés', 'Hernández', '1', '1988-08-20', '5553332222', 'andres.hernandez@example.com', '$2a$07$asxx54ahjppf45sd87a5auRti6saKEkyuQmdvUYFTh6h0huW4haHu', '9753108642', 'HERA880720MDFXXX05', '9876543210', 'HERA880720XXX', 'Calle de la Luna', '654', '5E', 'Condes', '59789', 'Ciudad de méxico', 'CDMX', 1, '2021-06-19', NULL, NULL, NULL, 0),
(28, 'Ana', 'Martínez', '0', '1992-12-10', '5558889999', 'ana.martinez@example.com', '$2a$07$asxx54ahjppf45sd87a5auX9vEJcqQWeK8sk/j9eWWzclmoCXBfM6', '8642097531', 'MART921210MDFXXX06', '1234567890', 'MART921210XXX', 'Avenida Insurgentes', '987', '6F', 'Roma', '45678', 'Ciudad de méxico', 'CDMX', 1, '2023-05-19', NULL, NULL, NULL, 0),
(29, 'Ricardo', 'Vargas', '1', '1980-08-05', '5556667777', 'ricardo.vargas@example.com', '$2a$07$asxx54ahjppf45sd87a5auMUDk16Ed3i64oCHjw4GAZHe/3sB2Ww.', '9876543210', 'VARR800805MDFXXX07', '9876543210', 'VARR800805XXX', ' Calle de los Pinos', '321', '7G', 'Del bosque', '56789', 'Ciudad de móxico', 'CDMX', 1, '2023-05-19', NULL, NULL, NULL, 0),
(30, 'Carolina', 'Sánchez', '0', '1993-09-25', '5557778888', 'carolina.sanchez@example.com', '$2a$07$asxx54ahjppf45sd87a5au/wc8C7a69DzqmuOV5qViEl83KeRyWTW', '9753108642', 'SANC930925MDFXXX08', '1234567890', 'SANC930925XXX', 'Avenida Morelos', '654', '8H', 'Tlalpan', '45678', 'Ciudad de México', 'CDMX', 1, '2022-06-19', NULL, NULL, NULL, 0),
(31, 'Gabriela', 'Ramírez', '0', '1991-04-02', '4569028625', 'gabriela.ramirez@example.com', '$2a$07$asxx54ahjppf45sd87a5auL3BOJdw5UlTjafqj16lFITe.7zA0hUa', '8642097531', 'RAMG910402MDFXXX10', '1234567890', 'RAMG910402XXX', 'Avenida Hidalgo', '321', '10J', 'Cuauhtémoc', '45678', 'Ciudad de México', 'CDMX', 1, '2023-05-19', NULL, NULL, NULL, 0),
(32, 'LUIS ', 'PEREZ CORONADO', '1', '1980-03-21', '4521654147', 'LUISPALEO@hotmail.com', '$2a$07$asxx54ahjppf45sd87a5auRMnmjBx9AnWTWsMCgZjzMGf05185z9y', '183639494', 'PAZL900321HMNTCR07', '725439009761', 'PAZL900321JCA', 'DOMICILIO CONOCIDO', '1222', '12', 'JUANA PAVON', '60490', 'MORELIA', 'Michoacan', 1, '2023-05-24', NULL, NULL, NULL, 0),
(33, 'JOSE', 'CARRILLO', '1', '1987-09-18', '4521679799', 'JOSECARRILLO@GMAIL.COM', '$2a$07$asxx54ahjppf45sd87a5auMejtr5RryVTdsj9ADRi8siKCbPtSbkG', '173532618251', 'CALP730912HMNTCR07', '72653736272', 'CALP730908LC0', 'EDUCACION ESQUINA MATAMOROS', 'SN', '12', 'REAL UNIVERSIDAD', '60490', 'MORELIA', 'Michoacan', 1, '2023-05-24', NULL, NULL, NULL, 0),
(34, 'RAUL', 'MOLINA', '1', '1993-09-07', '4521654147', 'gumor@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auuw4GnAVLVXyEv.uAxdYPcOz79VHrdGG', 'W727373U', 'VEME790916MMNNRR07', '22222233', 'MPR14091822A', 'HERMANOS FLORES MAGON', '1584', '', 'JUANA PAVON', '60180', 'MORELIA', 'Michoacan', 1, '2023-05-24', NULL, NULL, NULL, 0),
(35, 'DAVID', 'BECERRA ALCAZAR', '1', '1995-03-06', '4400998866', 'contabilidadgdl@inconsultingmexico.com', '$2a$07$asxx54ahjppf45sd87a5auAE9lF7pz/rTfj4HYna.BEJ2O86mBkdq', '10', 'BEAD950306HMNTCR07', '8763519036', 'BEAD950306765', 'PASEO LAZARO CARDENAS', '45', '', 'LA SOLEDAD', '60180', 'MORELIA', 'MICHOACAN', 1, '2023-05-30', NULL, NULL, NULL, 0),
(36, 'JORGE', 'MEDINA', '1', '1989-07-25', '4521654147', 'jorgemedina@example.com', '$2a$07$asxx54ahjppf45sd87a5auHzjdMXdXdTVcWPVWk5D7KG.Fa/4l22.', '92726267', 'MEAJ890725HMNTVR07', '729374516199', 'MEAJ890725TU8', 'DOMICILIO CONOCIDO', 'SN', '12', 'FUENTES DE MORELIA', '60490', 'MORELIA', 'Selecciona un estado', 1, '2023-05-30', NULL, NULL, NULL, 0),
(37, 'GILBERTO', 'LOPEZ PEREZ', '1', '1991-09-16', '4521679799', 'gilbertoperez@example.com', '$2a$07$asxx54ahjppf45sd87a5aubtIMcZD8YqhMkGMi2xMlulTc6dEucHC', '927DJHD82', 'LOPG910916HMNTRDS09', '90654195392', 'LOPG9109169O8', 'HERMANOS FLORES MAGON', '1584', '12', 'JUANA PAVON', '60180', 'MORELIA', 'Michoacan', 1, '2023-05-31', NULL, NULL, NULL, 0),
(38, 'FREDDY', 'PAZ ONOFRE', '1', '1999-02-17', '4466880022', 'freddypaz@example.com', '$2a$07$asxx54ahjppf45sd87a5au4pC/aOp8siU1b4rh/hpu9QG/CRMd/Eq', 'SKDHDJD7394', 'PAOF860515HMNTCR07', '84663399001', 'PAOF8605159O0', 'MANANTIALES', '64', '', 'CONSTITUYENTES', '58060', 'MORELIA', 'Selecciona un estado', 1, '2023-05-31', NULL, NULL, NULL, 0),
(39, 'GABRIEL ESTEBAN', 'PAREDES QUEZADA', '1', '1993-05-11', '4528990909', 'esteban@example.com', '$2a$07$asxx54ahjppf45sd87a5auGGJ0ptNmr/kDbID0OENBxvR9T3BXI5y', '9OIW54389I', 'PAQG930511HMNJKO07', '98482046291', 'PAQG930511JU9', 'HOLANDA', '62', '', 'REAL UNIVERSIDAD', '58088', 'MORELIA', 'MICHOACAN', 1, '2022-07-31', NULL, NULL, NULL, 0),
(40, 'OSVALDO', 'HUERTA CHAVEZ', '1', '1967-09-09', '4521654147', 'osvaldohuerta@example.com', '$2a$07$asxx54ahjppf45sd87a5aukBFxYPcXeBQjAMXQxzE2JyuMe5DYAiy', 'W727373I44', 'HUCO670909HMNYUO07', '98367482196', 'HUCO6709098D3', 'HERMANOS FLORES MAGON', '1584', '12', 'FUENTES DE MORELIA', '60180', 'MORELIA', 'Michoacan', 0, '2023-05-31', '2023-07-06', 2, 'SEPARACIÓN VOLUNTARIA', 0),
(41, 'RUTH', 'ESTRADA GARCIA', '0', '1995-09-05', '4521654147', 'ruthestrada@example.com', '$2a$07$asxx54ahjppf45sd87a5aujos.veKbGkKTS9uOllJqaidI2Ee50jK', '099875432', 'ESGR950905MMNDGE73', '98437401748', 'ESGR950905098', 'DOMICILIO CONOCIDO', 'SN', '', 'VERDE VALLE', '60490', 'MORELIA', 'Michoacan', 1, '2023-05-31', NULL, NULL, NULL, 0),
(42, 'ANA LILIA', 'NATIVIDAD MORALES', '0', '1989-05-08', '4499887766', 'analilia@example.com', '$2a$07$asxx54ahjppf45sd87a5auvOb8duE2QA7zm0uvIOBUHgPl1Cunq/e', '84KDGEUDBDYE', 'NAMA890508MMNYUO97', '9754872929', 'NAMA890508987', 'HERMANOS FLORES MAGON', '1584', '', 'VERDE VALLE', '60180', 'MORELIA', 'Michoacan', 1, '2023-05-31', NULL, NULL, NULL, 0),
(43, 'IVAN', 'OROZCO SOTO', '1', '1995-12-31', '3332500902', 'ivan.orozco@example.com', '$2a$07$asxx54ahjppf45sd87a5auUgLFp/b6Ee.8BiRCuH7jWYgqApJcL6i', '9873652HD8', 'ORSI951231HMNTCR09', '9836284619', 'ORSI9512319T6', 'OBSERVATORIO', '890', '', 'LA ROMA', '58088', 'MORELIA', 'MICHOACAN', 1, '2023-06-01', NULL, NULL, NULL, 0),
(44, 'ENRIQUE', 'VILLA RANGEL', '1', '1993-01-08', '4433071539', 'enriquevilla@example.com', '$2a$07$asxx54ahjppf45sd87a5auNUjH3inFFub/dmY2sf22xdF0RYBZp7y', '0987654321', 'VIRE930108HMNUJK87', '90362789511', 'VIRE930108JH6', 'ROBLE', '99', '', 'COLORADO', '58610', 'MORELIA', 'MICHOACAN', 1, '2023-06-01', NULL, NULL, NULL, 0),
(45, 'JORDI', 'ROSAS ZULUAGA', '1', '1999-08-09', '4499000076', 'jordi@example.com', '$2a$07$asxx54ahjppf45sd87a5aumD8TViLnS2Oash8.GUQL.sfWF7QztOW', '9IOD538SJ7', 'ZURJ990809HMNHJ809', '93626188905', 'ZURJ9908099IO', 'ENCINOS', '987', '', 'SOLEDAD', '58337', 'MORELIA', 'MICHOACAN', 1, '2023-06-01', NULL, NULL, NULL, 0),
(46, 'GERARDO', 'ROMERO GARCIA', '1', '1999-06-29', '6677889900', 'gerardo.garcia@example.com', '$2a$07$asxx54ahjppf45sd87a5auGxTbWFsfM6tK8MMOh6ZlreYGnrS9CkC', '98365TY86H', 'ROGG990629', '90765498712', 'ROGG990629JKL', 'PROLONGACION', '76', '', 'ZUMPIMITO', '58338', 'MORELIA', 'MICHOACAN', 1, '2023-06-01', NULL, NULL, NULL, 0),
(47, 'KEVIN', 'ALVAREZ CASTILLO', '1', '1980-09-08', '5556090234', 'kevin.alvarez@example.com', '$2a$07$asxx54ahjppf45sd87a5auICu7AWV0bR8hugNWOH.tkGwVjk6kj62', '0OI87UY65T', 'ALCK800908HMNTVI89', '98527132843', 'ALCK800908LO9', 'LIMONES', '78', '', 'ROMITA', '58445', 'MORELIA', 'Selecciona un estado', 1, '2022-03-16', NULL, NULL, NULL, 0),
(48, 'LUIS FRANCISCO', 'REYES RODRIGUEZ', '1', '1993-07-15', '4521679799', 'luis.francisco@example.com', '$2a$07$asxx54ahjppf45sd87a5aukNRkyQorxw8KWx2MVKmz6wdXSTdPIAW', '0937654201', 'RERF9300715HMNTCD89', '28936781561', 'RERF9300715JH7', 'MARTIN CARRERA', '90', '', 'PASEO DE LA REFORMA', '58900', 'MORELIA', 'Michoacan', 1, '2023-06-01', NULL, NULL, NULL, 0),
(49, 'SONIA', 'MARTINEZ PLIEGO', '0', '1998-05-16', '4455667788', 'sonia.martinez@example.com', '$2a$07$asxx54ahjppf45sd87a5au3Ma6fwWMKiz.G4ZOf940hYICbZ8By1m', '98726YE548', 'MAPS980516HMNTKI89', '98452781327', 'MAPS980516O98', 'HERMANOS FLORES MAGON', '9876', '', 'ROBLE', '58336', 'MORELIA', 'MICHOACANA', 1, '2023-06-01', NULL, NULL, NULL, 0),
(50, 'PABLO', 'GARCIA ESTRADA', '1', '1997-08-09', '4521654147', 'pablo@example.com', '$2a$07$asxx54ahjppf45sd87a5auYymGR6xUYaDAp1vv9LQnrhxz5mO6vay', 'I876TG5S5471', 'GAEP970809HDF98623', '17498276531', 'GAEP970809UT6', 'HERMANOS FLORES MAGON', '1584', '12', 'LA MAESTRANZA', '60180', 'MORELIA', 'Michoacan', 1, '2023-06-01', NULL, NULL, NULL, 0),
(51, 'SELENE', 'ORTEGA GONZALEZ', '1', '1998-09-08', '4521679799', 'selene.ortega@example.com', '$2a$07$asxx54ahjppf45sd87a5au5l98RAGGiFN9rDg8YrZSa/y6c0W/74G', 'I987UY65T6', 'ORGS980908HMNTVO90', '98376251462', 'ORGS9809088G6', 'FACULTAD DE INGENIERIA CIVIL', '35', '', 'LA SOLEDAD', '58767', 'MORELIA', 'MICHOACAN', 1, '2023-06-01', NULL, NULL, NULL, 0),
(52, 'ELIZABETH', 'GOMEZ ARREOLA', '0', '1998-05-07', '4455669900', 'elizabeth.gomez@example.com', '$2a$07$asxx54ahjppf45sd87a5au6wWTkaWwOMM8Q3K1oHnZr1.FfYzpkiu', 'OLK897654', 'GOAE980507HMNTCR07', '89362732111', 'GOAE980507987', 'NARANJO', '132', '', 'PEDREGAL', '58000', 'MORELIA', 'MICHOACAN', 0, '2023-06-01', '2023-07-15', 3, 'Dejo de presentarse por 5 días, se intento comunicar con ella, contesto su familiar diciendo que ya esta en otro empleo.', 0),
(53, 'ELIZABETH', 'GOMEZ ARREOLA', '0', '1998-05-07', '4455669900', 'elizabeth.gomez@example.com', '$2a$07$asxx54ahjppf45sd87a5aubWETtXtVJwayj7HJb0WTCiOtye7SMIa', 'OLK897654', 'GOAE980507HMNTCR07', '89362732111', 'GOAE980507987', 'NARANJO', '132', '', 'PEDREGAL', '58000', 'MORELIA', 'MICHOACAN', 1, '2023-06-01', NULL, NULL, NULL, 0),
(54, 'OMAR', 'PACHECO MERINO', '1', '1998-07-09', '4521679799', 'omar.merino@example.com', '$2a$07$asxx54ahjppf45sd87a5auM7KA0Z0E4pfeiONLuakqCusqU9fvhlO', '98JU765452', 'PAMO980709HMNYHU87', '98725123349', 'PAMO980709', 'TULIPAN', '888', '', 'JACARANDAS', '58000', 'MORELIA', 'Michoacan', 1, '2023-06-01', NULL, NULL, NULL, 0),
(55, 'HUGO', 'REYNEL LOPEZ', '1', '1998-07-07', '6677990033', 'hugoreynel@example.com', '$2a$07$asxx54ahjppf45sd87a5aumvCI8ZHaB7bDL.z71XlF1rFRxQe4HB.', 'IEY768S9I7', 'RELH980707HGTU89', '16289036512', 'RELH980707876', 'FRESNO', '67', '', 'MICHOACANA', '58000', 'MORELIA', 'MICHOACAN', 1, '2023-06-01', NULL, NULL, NULL, 0),
(56, 'OSCAR', 'RENDON VILLEGAS', '1', '1990-01-30', '4521679799', 'oscar@example.com', '$2a$07$asxx54ahjppf45sd87a5aui0B03QzE3AB1aFIxoNtjnoOMkf2bH0K', '98367IY5E4', 'REVO900130HMNYU8', '93761552188', 'REVO9001308U7', 'HERMANOS FLORES MAGON', '1584', '', 'JUANA PAVON', '50180', 'MORELIA', 'Michoacan', 1, '2023-06-01', NULL, NULL, NULL, 0),
(57, 'ADAM', 'ORTEGA CRISOSTOMO', '1', '1985-07-20', '4521679799', 'adamortega@exmple.com', '$2a$07$asxx54ahjppf45sd87a5auq8k5jj0xr7bTE82OZSQwzN6d7JtjtfS', 'DJ876S43UE', 'ORCA850720HMNTCR76', '17265333987', 'ORCA850720', 'EDUCACION ESQUINA MATAMOROS', '8', '', 'UNIVERSIDAD', '58088', 'MORELIA', 'Michoacan', 0, '2023-06-01', '2023-07-06', 1, 'TERMINO DE CONTRATO', 0),
(58, 'JAVIER', 'MORALES LEMUS', '1', '1993-03-27', '4521679799', 'javiermorales@example.com', '$2a$07$asxx54ahjppf45sd87a5auek3ICyszBapgtRg5cSm5RsalYcBmnNC', '8U7665E420', 'MOLJ930327HMNTCR98', '98221683625', 'MOLJ930327KI7', 'HERMANOS FLORES MAGON', '1584', '', 'VERDE VALLE', '60180', 'MORELIA', 'MICHOACAN', 1, '2023-06-01', NULL, NULL, NULL, 0),
(59, 'ESTEFANIA', 'CHAGOLLA RUIZ', '1', '1987-04-01', '4521679799', 'estefania.chagolla@example.com', '$2a$07$asxx54ahjppf45sd87a5au0b/uaLtRretmkI/WoZzG35RIF434D7C', '9876D73I89', 'CHRE870401HMNTGI87', '89098645321', 'CHRE870401987', 'EDUCACION ESQUINA MATAMOROS', 'SN', '', 'LA LOMA', '60490', 'MORELIA', 'MICHOACAN', 1, '2023-06-06', NULL, NULL, NULL, 0),
(60, 'ESTEFANIA', 'CHAGOLLA RUIZ', '1', '1987-04-01', '4521679799', 'estefania.chagolla@example.com', '$2a$07$asxx54ahjppf45sd87a5au/jLIzsPfYeVfRx1GnXfx2Vu1ukAP4uG', '9876D73I89', 'CHRE870401HMNTGI87', '89098645321', 'CHRE870401987', 'EDUCACION ESQUINA MATAMOROS', 'SN', '', 'LA LOMA', '60490', 'MORELIA', 'MICHOACAN', 0, '2023-06-06', '2023-06-05', NULL, NULL, 0),
(61, 'MARCELINO', 'PEREZ SANCHEZ', '1', '1993-09-07', '4433900175', 'marcelina.perez@example.com', '$2a$07$asxx54ahjppf45sd87a5auLnIjI/VIgYf5lri6Lmw4dS2QUdd9Nwi', '98037625D8', 'PESM930907HMNYU8', '90936544671', 'PESM930907ZQ9', 'MOZART', '245', '', 'LA LOMA', '58290', 'MORELIA', 'MICHOACAN', 1, '2023-06-08', NULL, NULL, NULL, 0),
(62, 'EDIBERTO', 'PONCE SANDOVAL', '1', '1998-07-09', '4521654147', 'ediberto@example.com', '$2a$07$asxx54ahjppf45sd87a5au54Jbm7/8aXhLC2.eFYo.MTPUBi4pZIu', '98IU76YT54', 'POSE9807HMNVFR56', '17390098763', 'POSE980987', 'MARIANO OTERO', '3431', 'A', 'VERDE VALLE', '58000', 'MORELIA', 'MICHOACAN', 1, '2023-06-08', NULL, NULL, NULL, 0),
(63, 'RODOLFO', 'REYES RENDON', '1', '1994-07-26', '4521654147', 'reyes@example.com', '$2a$07$asxx54ahjppf45sd87a5auXWJW3y3cDAYB0I4Nzw.1bTuU.GXme.S', '83987637818', 'RERR940726HHY789', '74893727192', 'RERR940726987', 'MORELOS', '31', '', 'LA MICHOACANA', '58990', 'MORELIA', 'MICHOACAN', 1, '2023-06-08', NULL, NULL, NULL, 0),
(64, 'PAULINA', 'VELAZQUEZ CORTES', '0', '1993-04-11', '4521679799', 'paulina@example.com', '$2a$07$asxx54ahjppf45sd87a5auSYYIkM6Jn1SY/1j4DbrmboIQmEugiwO', '98367D5438', 'VECP930411MMNTYU09', '11238946722', 'VECP930411ZJ4', 'HERMANOS FLORES MAGON', '1584', '', 'FUENTES DE MORELIA', '60180', 'MORELIA', 'Michoacan', 1, '2023-06-08', NULL, NULL, NULL, 0),
(65, 'GUADALUPE', 'FARIAS UGALDE', '0', '1992-07-21', '4521654147', 'guadalupe@example.com', '$2a$07$asxx54ahjppf45sd87a5auQqeq5MdR9/OzXIWmGGiGf6STiR2Rkk.', '8928S7Y655', 'FAUG920721MMNIUY67', '119834782081', 'FAUG920721GT7', 'DOMICILIO CONOCIDO', 'SN', '', 'MATAMOROS', '60490', 'MORELIA', 'Michoacan', 1, '2023-06-08', NULL, NULL, NULL, 0),
(66, 'NADIA', 'PAZ TREJO', '0', '1987-08-09', '4521654147', 'nadiapa@example.com', '$2a$07$asxx54ahjppf45sd87a5auhqrfWBlvqc1gBcvo6NY2i03N3RG9B5i', '9OD8776283', 'PATN870809MJUY78', '92873618383', 'PATN870809998', 'FAUNA', '2381', '', 'RINCONADA DEL BOSQUE', '58000', 'MORELIA', 'MICHAOCAN', 1, '2023-06-08', NULL, NULL, NULL, 0),
(67, 'MONSERRAT', 'OLIMPIA REYES', '0', '1993-04-16', '4521654147', 'olimpia@example.com', '$2a$07$asxx54ahjppf45sd87a5auNe.ipRgAR2xVbTMfCfKeQioMrtFq7Cu', 'IEK83765D6', 'OLRM930416MMNYUI89', '93872819283', 'OLRM9304167J4', 'PROLONGACION VERACRUZ', '90', '', 'REAL UNIVERSIDAD', '60490', 'MORELIA', 'Michoacan', 1, '2023-06-08', NULL, NULL, NULL, 0),
(68, 'RODRIGO', 'GONZALEZ ROMERO', '1', '1997-01-01', '4433900175', 'rodrigo@example.com', '$2a$07$asxx54ahjppf45sd87a5au4qL1S7JrXTe9y5AmcVNCSmCuaF23nl2', '983KD7644Y6', 'GORR970101HMNKJU89', '93938271203', 'GORR970101987', 'Tepeyac', '45', '', 'REAL UNIVERSIDAD', '58090', 'MORELIA', 'Michoacan', 1, '2023-06-08', NULL, NULL, NULL, 0),
(69, 'CARLOS', 'GUTIERREZ PEREZ', '1', '1997-01-01', '4433900165', 'carlos.gutierrez@example.com', '$2a$07$asxx54ahjppf45sd87a5auMFdn4TxVNBv2xQZJnXqXPFRFLCes9Qe', '98EGT73948H', 'GUPC970101HMNTVY89', '38761201110', 'GUPC970101987', 'MICAELA MONTES DE ALLENDE', '45', '', 'ROMA', '59000', 'MORELIA', 'MICHOACAN', 1, '2023-06-08', NULL, NULL, NULL, 0),
(70, 'OCTAVIO', 'SOTO AGUILAR', '1', '1993-12-26', '4433900175', 'octavio.soto@example.com', '$2a$07$asxx54ahjppf45sd87a5auKBYsMAImNv7kUSRMpMRzBHlmtIhxnHK', '8I7U6Y5T4R', 'SOAO931226HMNTCR08', '53719287989', 'SOAO931226567', 'ROMERO', '56', '', 'BERNARDO ABARCA', '58090', 'MORELIA', 'MICHOACAN', 1, '2023-06-08', NULL, NULL, NULL, 0),
(71, 'JOAQUIN', 'CONTRERAS GUZMAN', '1', '1998-08-01', '5556090826', 'joaquin@example.com', '$2a$07$asxx54ahjppf45sd87a5au2.HgmXNsNo.DsPIPqds7E8DcJM.KSgy', 'UDJ76YT5RR', 'COGJ980801HMNTCR06', '53040389976', 'COGJ98080JL9', 'BERNARDO ABARCA', '98', '', 'IBARRA', '58337', 'MORELIA', 'MICHOACAN', 1, '2023-06-08', NULL, NULL, NULL, 0),
(72, 'LARISA', 'MAGAÑA OLIVERA', '0', '1998-07-01', '4521679799', 'larisa@example.com', '$2a$07$asxx54ahjppf45sd87a5auqtOU256b43rtR7NMsV8pnjZ1FLIp3yS', 'UH678D934GD6', 'MAOL980701MMNUYI89', '92839283741', 'MAOL980701987', 'MICAELA MONTES DE ALLENDE', 'SN', '', 'REAL OVIEDO', '60490', 'MORELIA', 'MICHOACAN', 1, '2023-06-08', NULL, NULL, NULL, 0),
(73, 'ROBERTO', 'GARCIA ZEPEDA', '1', '1993-01-01', '4521679799', 'roberto@example.com', '$2a$07$asxx54ahjppf45sd87a5auxGpGrKsUrKyoUQvS1FNHmnaPa1A2az2', '98IKJMNV56', 'GAZR930101HMNTCR87', '28726152811', 'GAZR930101980', 'MICAELA MONTES DE ALLENDE', '45', '', 'LA LOMA', '58000', 'MORELIA', 'Michoacan', 1, '2023-06-08', NULL, NULL, NULL, 0),
(74, 'MANUEL', 'MOLINA BECERRA', '1', '1993-04-02', '4521679799', 'manuel@example.com', '$2a$07$asxx54ahjppf45sd87a5auJL5ihRaN9SoPAKbCcD8qXtK7V1tbPPS', '987UJ6587W8', 'MOBM930402HMNYVT76', '54543987672', 'MOBM930402574', 'EDUCACION ESQUINA MATAMOROS', 'SN', '', 'IBARRA', '60490', 'MORELIA', 'MICHOACAN', 1, '2023-06-08', NULL, NULL, NULL, 0),
(75, 'RAMON', 'VELEZ CHAVEZ', '1', '1988-07-17', '4521679799', 'ramon.velez@example.com', '$2a$07$asxx54ahjppf45sd87a5auXH3ZQC9OcAPA.jjlJIsrLvX9p3cHrGy', '8377483029', 'VECR880717HMNTCR09', '98761529371', 'VECR880717JLO', 'MOZART', '245', '', 'LA LOMA', '58290', 'MORELIA', 'MICHOACAN', 1, '2023-06-08', NULL, NULL, NULL, 0),
(76, 'ALEJANDRO', 'SANCHEZ PEREZ', '1', '1987-07-21', '4521654147', 'alejandro@example.com', '$2a$07$asxx54ahjppf45sd87a5au5RbnJ/LzlAPzK.rVH1jVnhPpE4oUdPe', '8I9O07654E', 'SAPA870721HMNYUO09', '55632919110', 'SAPA870721897', 'ROMERO', '98', '', 'LA SOLEDAD', '58000', 'MORELIA', 'MICHOACAN', 1, '2023-06-22', NULL, NULL, NULL, 0),
(77, 'VALENTIN', 'PEREZ SANCHEZ', '1', '1982-05-15', '4433071530', 'vperezsanchez@example.com', '$2a$07$asxx54ahjppf45sd87a5ausmCwiu4kDkMnc8vzk5Vpy1jDZ3SuQ72', '9OIUJSH653', 'PESV820515HMNHYU87', '55341890002', 'PESV820515908', 'ISAC ARRIAGA', '67', '', 'ZUMPUMITO', '58060', 'MORELIA', 'MICHOACAN', 1, '2023-06-22', NULL, NULL, NULL, 0),
(78, 'SANDRA', 'CASTILLEJO GOMEZ', '0', '1998-07-12', '4433900175', 'sandra.castillejo@example.com', '$2a$07$asxx54ahjppf45sd87a5au9ZuiVa8SbbVejVPjmXJJthFGlUIKIma', '8PO7O65542', 'CAGS981207MMNHUI09', '56545289911', 'CAGS981207JU8', 'MANANTIALES', '15', '', 'LINDAVISTA', '58337', 'MORELIA', 'MICHOACAN', 1, '2023-06-22', NULL, NULL, NULL, 0),
(79, 'SAUL', 'CONTRERAS CARAGLIO', '1', '1978-06-17', '4433900175', 'saulcc@example.com', '$2a$07$asxx54ahjppf45sd87a5auxiYekEM9lTVjV17ROEt3mJr9c/Aovam', '879OISG672', 'COCS780617HMNTC02', '5678923191', 'COCS7806178H6', 'MONTEVIDEO', '1987', '', 'TEPEYAC', '58090', 'MORELIA', 'MICHOACAN', 1, '2023-06-22', NULL, NULL, NULL, 0),
(80, 'OSCAR', 'NATIVIDAD ROSAS', '1', '1993-10-12', '5512071545', 'oscar.natividad@example.com', '$2a$07$asxx54ahjppf45sd87a5auTaOejD8TPqQfokgsPjwiXOxRZ.TAUVS', '9I76TY7654', 'NARO931012HMNTCR09', '56092187900', 'NARO931012JUO', 'TLATELOLCO', '67', '', 'SAN JUAN IXHUATEPEC', '58000', 'MORELIA', 'MICHOACAN', 1, '2023-06-22', NULL, NULL, NULL, 0),
(81, 'MIGUEL ANGEL', 'SUAREZ ACOSTA', '1', '1997-09-08', '4521679799', 'miguel.suarez@exmple.com', '$2a$07$asxx54ahjppf45sd87a5auAUOTb8i/EA/Lw6M6zKYZa7S25v.9jlq', '0O9I8U7Y6T5', 'SUAM970908HMNTCR09', '55094736101', 'SUAM970908YUT', 'HERMANOS FLORES MAGON', '1584', '', 'UNIVERSIDAD', '60180', 'Morelia', 'MCH', 1, '2023-06-22', NULL, NULL, NULL, 0),
(82, 'DANIEL', 'GONZALEZ GONZALEZ', '1', '1997-06-15', '4521654147', 'daniel.gonzalez@example.com', '$2a$07$asxx54ahjppf45sd87a5au5dUk17DKn1AjkkTL2PiiINb6U6ams/C', '87UJHY6TT54', 'GOGD970615HMNYHG67', '5080976541', 'GOGD970615UY6', 'DOMICILIO CONOCIDO', 'SN', '', 'VERDE VALLE', '60490', 'Morelia', 'MCH', 1, '2023-06-22', NULL, NULL, NULL, 0),
(83, 'RICARDO', 'NUÑEZ FLORES', '1', '1990-04-18', '4521679799', 'ricardo.nunez@example.com', '$2a$07$asxx54ahjppf45sd87a5audf5E1umeV1Kk6GfjxhingjbqW6Nw8l.', 'IUYH678903', 'NUFR900418HMNJKL09', '5678251011', 'NUFR900418897', 'EDUCACION ESQUINA MATAMOROS', 'SN', '', 'JUANA PAVON', '60490', 'Morelia', 'MCH', 1, '2023-06-22', NULL, NULL, NULL, 0),
(84, 'YANETH', 'YESCAS MOLINA', '0', '1992-11-15', '5566778899', 'yaneth@example.com', '$2a$07$asxx54ahjppf45sd87a5auUwxIREuTivx4lN8t7p7LuqjWX38fF6O', '8IUYTHGSM7', 'YEMY921115MMNYUI98', '5768920111', 'YEMY9211157Y6', 'ROMERO', '67', '', 'ISAC ARRIAGA', '59338', 'Morelia', 'MCH', 1, '2023-06-22', NULL, NULL, NULL, 0),
(85, 'NORA', 'DE LA MORA CATALAN', '1', '1999-09-14', '7538900765', 'nora@example.com', '$2a$07$asxx54ahjppf45sd87a5auSIHuUDAdU/xOh35GZtEDtDGMtz6n/xa', '9087653HDY6', 'MOCN990914MMH7U809', '56095428191', 'MOCN990914UJ8', 'FUENTES D MORELIA', '45', '67', 'MATAMOROS', '58337', 'Morelia', 'MCH', 1, '2023-06-22', NULL, NULL, NULL, 0),
(86, 'JULIO', 'MEZA ZAVALA', '1', '1998-07-20', '5556090826', 'julio.meza@example.com', '$2a$07$asxx54ahjppf45sd87a5au5kMLZEHJwyXhoxYo8o5RjGrYKVRINiW', '98IU766567', 'MEZJ980720HMNTCR07', '5679102981', 'MEZJ980720JAU', 'LIMONES', '56', '', 'TEPEYAC', '58456', 'Morelia', 'MCH', 1, '2023-06-22', NULL, NULL, NULL, 0),
(87, 'LUCERO', 'ALVAREZ ROCHA', '0', '1978-01-02', '4445890976', 'lucero@example.com', '$2a$07$asxx54ahjppf45sd87a5au/6rV297fRdIsfc5zjK7J9Fnt6NcQEvi', 'UJY67UY65T', 'ALRL780102MMNDRA56', '56092317891', 'ALRL7801028U7', 'TEPEYAC', '678', '', 'CHAPALITA', '58000', 'Morelia', 'MCH', 1, '2023-06-22', NULL, NULL, NULL, 0),
(88, 'FIDEL OCTAVIO ', 'VAZQUEZ PINEDA', '1', '1998-09-15', '5678093767', 'octavio.fidel@example.com', '$2a$07$asxx54ahjppf45sd87a5aubTH6vha7pMuxYxAQJDhDHjuw07j5gNW', 'IUJH6754FR', 'VAPF980915HMNYUI98', '56238192871', 'VAPF980915DAE', 'SOLEDAD', '78', '', 'HOLANDA', '58000', 'Morelia', 'MCH', 1, '2023-06-22', NULL, NULL, NULL, 0),
(89, 'SOFIA', 'MUJICA RIVERA', '0', '1999-12-29', '4433780925', 'sofia.reviera@exmaple.com', '$2a$07$asxx54ahjppf45sd87a5aujNaC/c/w7LCesxCITRX.SNuFlwNL3Ae', 'IKJU765TY9', 'MURS991229MMNVU809', '56092673849', 'MURS991229MY6', 'HOLANDA', '62', '', 'UNIVERSIDAD', '58060', 'Morelia', 'MCH', 1, '2023-06-22', NULL, NULL, NULL, 0),
(90, 'AIME', 'CARVAJAL BARRIGA', '1', '1998-09-15', '5529631215', 'aime.car@example.com', '$2a$07$asxx54ahjppf45sd87a5ausGjM0IvbJ6/Nr2jiYMukxdxMwxbOWyy', '98IKJ76542', 'CABA980915MMNHUL09', '5047898341', 'CABA980915546', 'PRICA PRESEA', '56', '', 'LA LOMA', '58337', 'Morelia', 'MCH', 1, '2023-06-22', NULL, NULL, NULL, 0),
(91, 'EVA', 'ROMERO GARCIA', '0', '1990-05-14', '4521654147', 'eva.rg@example.com', '$2a$07$asxx54ahjppf45sd87a5auPjX5m.qLgvksPoW5cNc01P4RBS5oeeq', 'IKJUDGTE78', 'ROGE900514MMNYHU09', '55780909090', 'ROGE9005148G5', 'JOSE STALIN', '76', '', 'TLALPEÑA', '58560', 'Morelia', 'MCH', 1, '2023-06-22', NULL, NULL, NULL, 0),
(92, 'ROSA MARIA', 'HERNANDEZ CHAVEZ', '1', '1998-07-15', '5544890998', 'rosa.maria@example.com', '$2a$07$asxx54ahjppf45sd87a5auPyeybUxiCj3UXqYfqGJXGGkobgGFInW', 'U876Y5T4R6', 'HECR980715MMNUHY78', '55096798561', 'HECR9807158JU', 'MICAELA MONTES DE ALLENDE', '98', '', 'POLICIA Y TRANSITO', '58780', 'Morelia', 'MCH', 1, '2023-06-22', NULL, NULL, NULL, 0),
(93, 'LUIS', 'FUENTES GALLEGOS', '1', '1998-07-09', '4521654147', 'luis.fuentes@example.com', '$2a$07$asxx54ahjppf45sd87a5auZ7YFvYOh7huxroOXKRmQcjMJdRn1yt.', 'KSJYE63U8W8', 'FUGL980709HMNJCA09', '56097623111', 'FUGL980709987', 'ROCAS DE LA LOMA', 'S/N', '', 'ZUMPIMITO', '58000', 'Morelia', 'MCH', 1, '2023-06-22', NULL, NULL, NULL, 0),
(94, 'YOSELINE', 'GOMEZ ARREOLA', '0', '1999-01-01', '4521679799', 'yoseline@example.com', '$2a$07$asxx54ahjppf45sd87a5audExtdKCiSS0qPXxpZ6EwG8pnBn.ag.W', 'KDKDKKDKDK', 'GOAY990101MMNTCR07', '5069897891', 'GOAY9901018D3', 'EDUCACION ESQUINA MATAMOROS', 'SN', '', 'LA LOMA', '60490', 'Morelia', 'MCH', 1, '2023-06-23', NULL, NULL, NULL, 0),
(95, 'SILVIA', 'RIOS FLORES', '0', '1998-01-15', '4433900175', 'silvia@example.com', '$2a$07$asxx54ahjppf45sd87a5aumU.PuonlKsGtpPPhsicKpX3rkdkaQ/q', 'KDJD6Y7U88', 'RIFS980115MMNULI09', '5558778901', 'RIFS980115JUL', 'MIRAMONTE', '78', '', 'VASCO DE QUIROGA', '587090', 'Morelia', 'MCH', 1, '2023-06-23', NULL, NULL, NULL, 0),
(96, 'ESMERALDA', 'GONZALEZ RODRIGUEZ', '0', '1992-09-01', '4521654147', 'esmeralda.gozalez@example.com', '$2a$07$asxx54ahjppf45sd87a5au57kPVJZ720CxNUBVE995xJJdCXuo81i', 'IJUY78S526', 'GORE920901MMNSDO09', '56010723781', 'GORE920901JCA', 'LAGO', '123', '', 'LAGO 1', '58088', 'Morelia', 'MCH', 1, '2023-06-23', NULL, NULL, NULL, 0),
(97, 'LAURA', 'PEREZ VAZQUEZ', '0', '1998-08-09', '4455669900', 'laura.perez@example.com', '$2a$07$asxx54ahjppf45sd87a5aun5.UUjoIeDtcnXXgrTEM0OsMfV0M7J6', 'JSHY7U9W65', 'PEVL980809MMNYUI98', '5578909091', 'PEVL9808097D6', 'REALITO', '78', '', 'RINCONADA DEL BOSQUE', '58000', 'Morelia', 'MCH', 1, '2023-06-23', NULL, NULL, NULL, 0),
(98, 'LORENA ', 'CASTILLO DOMINGUEZ', '0', '1998-01-01', '4433900876', 'lorena.castillo@example.com', '$2a$07$asxx54ahjppf45sd87a5aujGhfIV54wARLQHK0jQJHU.PwEcppzQa', 'IDJUE73655', 'CADL980101MMNUIO09', '56010908187', 'CADL980101JLA', 'CAMELINAS', '1574', '', 'LINDAVISTA', '58090', 'Morelia', 'MCH', 1, '2023-06-23', NULL, NULL, NULL, 0),
(99, 'HUMBERTO', 'URRUTIA VIÑEDOS', '1', '1999-08-01', '5529136312', 'humberto@example.com', '$2a$07$asxx54ahjppf45sd87a5auCbFVpxLv3QBsPKpLVtDOblVSkhp10La', 'KDJIE87UY6', 'UUVH990801HMNTCR07', '55010987671', 'UUVH990801JH7', 'VALLE DE BRAVO', '345', '', 'VASCO DE QUIROGA', '58127', 'Morelia', 'MCH', 1, '2023-06-23', NULL, NULL, NULL, 0),
(100, 'JOSE', 'VILLASEÑOR RIOS', '1', '1978-04-13', '4433900175', 'jose.villasenor@example.com', '$2a$07$asxx54ahjppf45sd87a5auZ9ZAMu3uFdaXO5DnB3aTzWYiPkA9l6K', '1234567891', 'VIRJ780413HMNGHY78', '15687230910', 'VIRJ780413JCA', 'COLIBRI', '14', '', 'REALITO', '58456', 'Morelia', 'MCH', 1, '2023-06-23', NULL, NULL, NULL, 0),
(101, 'PABLO', 'FARIAS ESPINOZA', '1', '1997-05-17', '4433900176', 'pablo@example.com', '$2a$07$asxx54ahjppf45sd87a5au/mopLx/3YcvTzh7a4NG1ktFOcaDIomC', 'KSJUE7352HD', 'FAEP970517HMNKJU87', '5679899161', 'FAEP970517HUL09', 'FAUNA', '3134', '', 'RINCONADA DEL BOSQUE', '58336', 'Morelia', 'MCH', 1, '2023-06-23', NULL, NULL, NULL, 0),
(102, 'REYNA', 'CABRERA DUARTE', '0', '1995-07-18', '7541178902', 'reyba.cab@example.com', '$2a$07$asxx54ahjppf45sd87a5auxDC3pHZL7B24zq6Hl8t1/F8onlTsHim', 'KDJUWYSG673', 'CADR950718MMNTCU90', '1567898291', 'CADR950718JCA', 'MOTAMOROS', '14', '', 'LA PAZ', '58765', 'Morelia', 'MCH', 1, '2023-06-05', NULL, NULL, NULL, 0),
(103, 'JUAN MANUEL', 'ROJAS MARTINEZ', '1', '1985-11-14', '4521145609', 'juan.manuel@example.com', '$2a$07$asxx54ahjppf45sd87a5auiwiIaatav.4jrvCpMnocFZ9ScDIawmG', 'HSUW726EJD7', 'ROMJ851114HMNYUO09', '56018756241', 'ROMJ851114BLO', 'ESPINACA', '3', '', 'FLORES MAGON', '58090', 'Morelia', 'MCH', 1, '2023-06-15', NULL, NULL, NULL, 0),
(104, 'CAROLINA', 'PANTOJA ASCENCIO', '0', '1986-09-09', '4433876525', 'carolina@example.com', '$2a$07$asxx54ahjppf45sd87a5auUvJrmHWIrNYNgfhFydcigAfeJWWpzbi', 'KD894DHY63', 'PAAC860909MMNASD12', '1782345091', 'PAAC860909BL9', 'RICARDO FLORES MAGON', '789', '', 'JOSE VASCONCELOS', '58779', 'Morelia', 'MCH', 1, '2023-06-23', NULL, NULL, NULL, 0),
(105, 'JOANA', 'NAVARRO BUSQUETS', '0', '1990-04-14', '4455668909', 'joana@example.com', '$2a$07$asxx54ahjppf45sd87a5auYBck4WjRJfXHqTWGFsoPk9UnCKnL..C', 'KDI876E57U', 'NABJ900414MMNHJU89', '56092587901', 'NABJ900414BH8', 'OYAMEL ', '67', '', 'LA PAZ', '58990', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(106, 'BLANCA', 'ALCANTAR CRUZ', '0', '1991-05-16', '4455679801', 'blanca.alcantar@example.com', '$2a$07$asxx54ahjppf45sd87a5aue56AqB8z8HhBgseIssqH6eBrr9DU9hW', 'I8SY6W5445', 'ALCB910516MMHJLO90', '561029825611', 'ALCB910516JKO', 'ROBLE', '175', '', 'ESPINACA', '58660', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(107, 'JUAN CARLOS', 'BARRERA ESPINO', '1', '1999-07-25', '4433900175', 'jc.barrera@example.com', '$2a$07$asxx54ahjppf45sd87a5autZ.OBs6zmT/RViJ9ylaOa3aVgGukRui', 'KSI837DY67', 'BAEJ990725HMNJLO90', '561029381711', 'BAEJ990725JLO', 'ESPINACA', '1789', '', 'EL ROBLE', '58336', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(108, 'ALBERTO', 'PORTILLO SANCHEZ', '1', '1989-01-01', '3344900186', 'alberto.portillo@example.com', '$2a$07$asxx54ahjppf45sd87a5auM7a98G7OiF6CUPfhS56Z3/G26m2CBYW', '89SKJEU729', 'POSA900101HMNTCR09', '783928361422', 'POSA900101HUK', 'PINO SUAREZ', '45', '', 'LOS PINOS', '58337', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(109, 'LUIS', 'REYES OÑATE', '1', '1987-06-17', '4433900175', 'luis.reyes@example.com', '$2a$07$asxx54ahjppf45sd87a5auvwfZPNpaaCH6GRM88HNzO.P5t.eBYZK', '8DI7E635Q41', 'REOL870617HMNJUI09', '56123182765', 'REOL870617890', 'TUPILANES', '900', '', 'JACARANDAS', '58337', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(110, 'MIGUEL', 'PAHUA CASTAÑEDA', '1', '1999-07-13', '4433900175', 'miguel.pahua@example.com', '$2a$07$asxx54ahjppf45sd87a5auNBgQQ3t8H2NsneGcrJmZ0UhEynw/.K6', 'SKJDJY8976', 'PACM990713HMNTCR07', '56102873562', 'PACM9907138D3', 'MICAELA MONTES DE ALLENDE', '45', '', 'JUANA PAVON', '58000', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(111, 'GRISELDA', 'CABALLERO DIAZ', '0', '1980-09-10', '4433127890', 'g.caballero@exmaple.com', '$2a$07$asxx54ahjppf45sd87a5auKZkx2imDO4dcwd7bS7jioy7yhKQmPU6', 'HJSU876E5W', 'CADG800910MMNDHO09', '10283648311', 'CADG800910KLO', 'MOZART', '245', '', 'LA LOMA', '58290', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(112, 'RAUL', 'ORNELAS CHAVEZ', '1', '1987-09-10', '5545098909', 'raul.ornelas@example.com', '$2a$07$asxx54ahjppf45sd87a5au4veylAJN4lHmgSCObD.f3t4IkM26Zje', '9IDKJWU7890O', 'ORCR870910HMN908', '56098976781', 'ORCR870910HJLO', 'CASA BLANCA', '1876', '', 'LA LOMA', '58000', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(113, 'JULIO', 'ARREOLA GARNICA', '1', '1999-09-10', '4433900187', 'julio.ar@example.com', '$2a$07$asxx54ahjppf45sd87a5auTr8dTDPR5lVC9T1N38DgbGe1NOW2YpC', 'LSKO908IU7', 'ARGJ990910HMNJLO90', '56098727651', 'ARGJ990910KJU', 'MORELOS', '45', '', 'REALITO', '58000', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(114, 'PAMELA', 'GERBACIO PEREZ', '0', '1989-09-09', '4433900197', 'pamela@example.com', '$2a$07$asxx54ahjppf45sd87a5auXzTxCnimM0MScp2cXf0wC4uRJ8Da9ia', 'KDK89EY367', 'GEPP890909MMNUIO76', '56290378181', 'GEPP890909KLO', 'MANANTIALES', '78', '', 'MANANTIALES', '58900', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(115, 'VANIA', 'MANRIQUEZ CALDERON', '0', '1989-09-01', '4433900197', 'vania@example.com', '$2a$07$asxx54ahjppf45sd87a5auE2TyD1FeWT9/Ah9tt3YS.Wx3no09LCu', 'SH78D9I87U', 'MACV890901HMNTCR09', '65091456781', 'MACV8909018G6', 'MOZART', '245', '', 'LA LOMA', '58337', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(116, 'TOMAS', 'PANIAGUA PEREZ', '1', '1990-09-01', '4521679799', 'tomas@example.com', '$2a$07$asxx54ahjppf45sd87a5auNmGNXsPsDvvSkSegWVCVEJVgD2GUmpq', 'KDJUSJBKCBL', 'PAPT900901MMNTCF89', '56392837261', 'PAPT900901890', 'MOZART', 'SN', '', 'UNIVERSIDAD', '60490', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(117, 'GEOVANNY', 'ROJAS GARCIA', '1', '1993-12-19', '6655667788', 'g.rojas@example.com', '$2a$07$asxx54ahjppf45sd87a5auIDmNYd1ie6bJCMFHRGxqRJyPAGlf5De', 'KS839DI487D', 'ROGG931219MMNJKI90', '56019283711', 'ROGG931219908', 'MONTE RUBIO', '1267', '', 'BELLAS ARTES', '58000', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(118, 'HUGO', 'GUTIERREZ SANCHEZ', '1', '1991-02-03', '4433900187', 'hugo.g@example.com', '$2a$07$asxx54ahjppf45sd87a5aumRJyJu.m4qM./JRZsuy545fvqRxlxgK', '0LDK98EU7', 'GUSH910203HMNKLO90', '56029374819', 'GUSH910203JNO', 'ROCAS DE LA LOMA', '34', '', 'CAMINO VIEJO', '58338', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(119, 'GUSTAVO', 'MONTAÑO FARIAS', '1', '1990-01-01', '4433890283', 'gustavo@example.com', '$2a$07$asxx54ahjppf45sd87a5aux.Giy6NTDhoKyDx/M.3NEluCAVUnhhS', 'KJBKJDS21', 'MOFG900101HMNYVT78', '560291827251', 'MOFG9001018H7', 'MONTERREY', '67', '', 'REP. MEXICANA', '58337', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(120, 'RAMIRO', 'ZUÑIGA AVELLANEDA', '1', '1990-08-17', '4433900187', 'ramiro@example.com', '$2a$07$asxx54ahjppf45sd87a5auuAXTcNxwx1V5UNMlaY1ZTq1U6xiRXF6', 'SYEHSYA7829', 'ZUAR900817HMNYUO23', '56087898121', 'ZUAR900817989', 'CADENA', '65', '', 'LAS TROJES', '58337', 'Morelia', 'MCH', 0, '2023-06-26', '2023-06-29', NULL, NULL, 0),
(121, 'RUBEN', 'PEDRAZA PEÑALOZA', '1', '1992-03-09', '4521654147', 'ruben@example.com', '$2a$07$asxx54ahjppf45sd87a5auB6wmrMwMDkBYi45fSYRPBRb0mt/mKUW', 'EJD873KDOW9', 'PEPR920309HMNYUI90', '56098912341', 'PEPR920309JCA', 'PEDREGAL', 'SN', '', 'CENTRAL DE ABASTOS', '58237', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(122, 'JOAQUIN', 'MONTESINOS MORALES', '1', '1998-09-09', '3339837371', 'joaq.mont@example.com', '$2a$07$asxx54ahjppf45sd87a5auWAgROM1gdqQBVmh00lRk78wXyAXFxmG', 'JD7EJD6SST', 'MOMJ980909HMNYUO90', '56092078911', 'MOMJ980909878', 'MONTERUBIO', '174', '', 'ANDARES', '58765', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(123, 'MAURICIO', 'MARTINEZ ROMERO', '1', '2000-11-15', '4341768990', 'mauricio@example.com', '$2a$07$asxx54ahjppf45sd87a5au.jF7.S43L855TwOD7OPHBWtuHcVugpa', 'LSKDIE83761', 'MARM001115HMNTCR09', '56099087241', 'MARM001115HFD5', 'TIERRA Y LIBERTAD', '67', '', 'REFORMA', '58337', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(124, 'SEBASTÍAN', 'AGUIRRE LOPEZ', '1', '1999-06-09', '4521654147', 'sebastian@exmaple.com', '$2a$07$asxx54ahjppf45sd87a5au0fTPWUXUCUViOX2xS8lQVmhrpNdeQm2', 'KDIEKDJ938', 'AGLS990609HMNYHI98', '56092654131', 'AGLS990609987', 'MALDONADO', '789', '', ' ROMERO RUBIO', '56890', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(125, 'ALEX', 'TORNER ACOSTA', '1', '1998-05-12', '3332890909', 'alex@example.com', '$2a$07$asxx54ahjppf45sd87a5aux4ykHDmxO5WnjG0ewLfJhUsc7HQBfJ2', 'KDJEUFJDLDG', 'TOAA980512HMNSDE56', '1237936451', 'TOAA980512876', 'PSICOLOGIA', '45', '', 'REAL UNIVERSIDAD', '58090', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(126, 'RICARDO DAVID', 'CASTRO NUÑEZ', '1', '1994-02-22', '4521654147', 'r.d.castro@example.com', '$2a$07$asxx54ahjppf45sd87a5au3S0H3ECoPKczEkIqmovdy4u8WTWcBfO', 'IEKD736DHE5', 'CANR940222HMNYJO09', '56093514221', 'CANR940222HMNYJ', 'rROBLE', '67', '', 'EL SAUZ', '58765', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(127, 'JUAN PABLO', 'BECERRIL GUERRERO', '1', '1990-11-30', '4433099876', 'jpbece@example.com', '$2a$07$asxx54ahjppf45sd87a5aurBDkcIFOEx8ZAxzQPx.N0DIrp.JPzVC', 'OWID729309Q', 'BEGJ901130HMNGDO72', '56937261549', 'BEGJ901131901', 'TULIPAN', '78', '', 'MANANTIALES', '58990', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(128, 'FLOR', 'LOPEZ ARREOLA', '0', '1989-07-09', '3322890874', 'flor@exmaple.com', '$2a$07$asxx54ahjppf45sd87a5au.anINKtyy7lQW0K9btq4nXJc3ob8R2a', 'MDJEIR847U', 'LOAF890709HMN89087', '56938472198', 'LOAF890709890', 'CALABZA', '88', '', 'RUBI', '58776', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(129, 'SALVADOR', 'ZAVALA ESPEJEL', '1', '1999-09-09', '4521654147', 'salvador@example.com', '$2a$07$asxx54ahjppf45sd87a5auV//RLtynkHYebkkCR0hoaNyb1eHpSRm', 'JDUIR89376', 'ZAES990909HMNTCU89', '56231839401', 'ZAES990909765', 'CAMELINAS', '1584', '', 'FUENTES DE MORELIA', '60180', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(130, 'JOAQUIN', 'FONSECA PALOMINOS', '1', '1980-01-18', '4433900187', 'jfpalominos@example.com', '$2a$07$asxx54ahjppf45sd87a5auqAnOYJtPVd6D7E6.UIHn8AV7Oc73M26', 'KDJDYE749WK', 'FOPJ800118HMNYUI90', '54389026182', 'FOPJ800118980', 'HERMANOS FLORES MAGON', '1584', '', 'FUENTES DE MORELIA', '60180', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(131, 'PEDRO', 'BARAJAS ORTEGA', '1', '1990-12-12', '4521679799', 'pbortega@example.com', '$2a$07$asxx54ahjppf45sd87a5auL49KXMkrZFY6JWGf4qzWUkWW8oBxgzC', 'KDJKEUKDUF', 'BAOP901212HMNUKO09', '56092763541', 'BAOP901212KLO09', 'ESPINACA', '78', '', 'REALITO', '58990', 'Morelia', 'MCH', 1, '2023-06-26', NULL, NULL, NULL, 0),
(132, 'RODOLFO', 'AGUILAR CHAVEZ', '1', '1994-08-09', '4455338909', 'rodolfo@example.com', '$2a$07$asxx54ahjppf45sd87a5auSQth3dCpgLZRGxjrT8DnypiBTGWqjY6', '89094736153', 'AGCR940809HMNUVO09', '56340989765', 'AGCR940809JLO', 'ROCAS DE LA LOMA', 'SN', '', 'LINDAVISTA', '58900', 'Morelia', 'MCH', 1, '2023-06-27', NULL, NULL, NULL, 0),
(133, 'CAROLINA', 'CHAVEZ PEREZ', '0', '1990-07-09', '4521654147', 'carolina@example.com', '$2a$07$asxx54ahjppf45sd87a5auwWUK1oxt9Rx5TRcHi6Vj2k2czea9MxW', 'JDUR7492ODO', 'CHPC900709MMNUIO09', '56092837162', 'CHPC900709PLO', 'CHIAPAS', '78', '', 'UNIVERSIDAD', '58760', 'Morelia', 'MCH', 1, '2023-06-27', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_has_examenes`
--

CREATE TABLE `empleados_has_examenes` (
  `idEmpleados_has_Examenes` int(11) NOT NULL,
  `idExamen` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `tiempo_utilizado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleados_has_examenes`
--

INSERT INTO `empleados_has_examenes` (`idEmpleados_has_Examenes`, `idExamen`, `idEmpleado`, `fecha_inicio`, `fecha_fin`, `tiempo_utilizado`) VALUES
(124, 1, 107, NULL, NULL, 0),
(125, 1, 127, NULL, NULL, 0),
(126, 1, 111, NULL, NULL, 0),
(127, 1, 102, NULL, NULL, 0),
(128, 1, 90, NULL, NULL, 0),
(129, 1, 98, NULL, NULL, 0),
(130, 1, 126, NULL, NULL, 0),
(131, 1, 3, NULL, NULL, 0),
(132, 1, 101, NULL, NULL, 0),
(133, 1, 5, NULL, NULL, 0),
(134, 1, 130, NULL, NULL, 0),
(135, 1, 93, NULL, NULL, 0),
(136, 1, 114, NULL, NULL, 0),
(137, 1, 94, NULL, NULL, 0),
(138, 1, 96, NULL, NULL, 0),
(139, 1, 118, NULL, NULL, 0),
(140, 1, 6, NULL, NULL, 0),
(144, 3, 132, NULL, NULL, 0),
(145, 3, 124, NULL, NULL, 0),
(146, 3, 106, NULL, NULL, 0),
(147, 3, 47, NULL, NULL, 0),
(148, 3, 87, NULL, NULL, 0),
(149, 3, 21, NULL, NULL, 0),
(150, 3, 22, NULL, NULL, 0),
(151, 3, 113, NULL, NULL, 0),
(152, 3, 131, NULL, NULL, 0),
(153, 3, 107, NULL, NULL, 0),
(154, 3, 35, NULL, NULL, 0),
(155, 3, 127, NULL, NULL, 0),
(156, 3, 111, NULL, NULL, 0),
(157, 3, 102, NULL, NULL, 0),
(158, 3, 33, NULL, NULL, 0),
(159, 3, 90, NULL, NULL, 0),
(160, 3, 78, NULL, NULL, 0),
(161, 3, 98, NULL, NULL, 0),
(162, 3, 126, NULL, NULL, 0),
(163, 3, 59, NULL, NULL, 0),
(164, 3, 60, NULL, NULL, 0),
(165, 3, 133, NULL, NULL, 0),
(166, 3, 79, NULL, NULL, 0),
(167, 3, 3, NULL, NULL, 0),
(168, 3, 71, NULL, NULL, 0),
(169, 3, 85, NULL, NULL, 0),
(170, 3, 41, NULL, NULL, 0),
(171, 3, 101, NULL, NULL, 0),
(172, 3, 65, NULL, NULL, 0),
(173, 3, 5, NULL, NULL, 0),
(174, 3, 130, NULL, NULL, 0),
(175, 3, 93, NULL, NULL, 0),
(176, 3, 25, NULL, NULL, 0),
(177, 3, 50, NULL, NULL, 0),
(178, 3, 73, NULL, NULL, 0),
(179, 3, 114, NULL, NULL, 0),
(180, 3, 52, NULL, NULL, 0),
(181, 3, 53, NULL, NULL, 0),
(182, 3, 94, NULL, NULL, 0),
(183, 3, 82, NULL, NULL, 0),
(184, 3, 96, NULL, NULL, 0),
(185, 3, 68, NULL, NULL, 0),
(186, 3, 69, NULL, NULL, 0),
(187, 3, 118, NULL, NULL, 0),
(188, 3, 27, NULL, NULL, 0),
(189, 3, 92, NULL, NULL, 0),
(190, 3, 40, NULL, NULL, 0),
(191, 3, 20, NULL, NULL, 0),
(192, 3, 24, NULL, NULL, 0),
(193, 3, 128, NULL, NULL, 0),
(194, 3, 37, NULL, NULL, 0),
(195, 3, 72, NULL, NULL, 0),
(196, 3, 115, NULL, NULL, 0),
(197, 3, 28, NULL, NULL, 0),
(198, 3, 49, NULL, NULL, 0),
(199, 3, 123, NULL, NULL, 0),
(200, 3, 36, NULL, NULL, 0),
(201, 3, 86, NULL, NULL, 0),
(202, 3, 34, NULL, NULL, 0),
(203, 3, 74, NULL, NULL, 0),
(204, 3, 119, NULL, NULL, 0),
(205, 3, 122, NULL, NULL, 0),
(206, 3, 58, NULL, NULL, 0),
(207, 3, 89, NULL, NULL, 0),
(208, 3, 6, NULL, NULL, 0),
(209, 3, 42, NULL, NULL, 0),
(210, 3, 80, NULL, NULL, 0),
(211, 3, 105, NULL, NULL, 0),
(212, 3, 83, NULL, NULL, 0),
(213, 3, 67, NULL, NULL, 0),
(214, 3, 112, NULL, NULL, 0),
(215, 3, 43, NULL, NULL, 0),
(216, 3, 19, NULL, NULL, 0),
(217, 3, 57, NULL, NULL, 0),
(218, 3, 51, NULL, NULL, 0),
(219, 3, 54, NULL, NULL, 0),
(220, 3, 110, NULL, NULL, 0),
(221, 3, 116, NULL, NULL, 0),
(222, 3, 104, NULL, NULL, 0),
(223, 3, 39, NULL, NULL, 0),
(224, 3, 38, NULL, NULL, 0),
(225, 3, 66, NULL, NULL, 0),
(226, 3, 121, NULL, NULL, 0),
(227, 3, 23, NULL, NULL, 0),
(228, 3, 32, NULL, NULL, 0),
(229, 3, 61, NULL, NULL, 0),
(230, 3, 77, NULL, NULL, 0),
(231, 3, 97, NULL, NULL, 0),
(232, 3, 62, NULL, NULL, 0),
(233, 3, 108, NULL, NULL, 0),
(234, 3, 10, NULL, NULL, 0),
(235, 3, 31, NULL, NULL, 0),
(236, 3, 56, NULL, NULL, 0),
(237, 3, 109, NULL, NULL, 0),
(238, 3, 63, NULL, NULL, 0),
(239, 3, 48, NULL, NULL, 0),
(240, 3, 55, NULL, NULL, 0),
(241, 3, 95, NULL, NULL, 0),
(242, 3, 26, NULL, NULL, 0),
(243, 3, 117, NULL, NULL, 0),
(244, 3, 103, NULL, NULL, 0),
(245, 3, 46, NULL, NULL, 0),
(246, 3, 91, NULL, NULL, 0),
(247, 3, 45, NULL, NULL, 0),
(248, 3, 30, NULL, NULL, 0),
(249, 3, 76, NULL, NULL, 0),
(250, 3, 70, NULL, NULL, 0),
(251, 3, 81, NULL, NULL, 0),
(252, 3, 125, NULL, NULL, 0),
(253, 3, 99, NULL, NULL, 0),
(254, 3, 29, NULL, NULL, 0),
(255, 3, 88, NULL, NULL, 0),
(256, 3, 64, NULL, NULL, 0),
(257, 3, 75, NULL, NULL, 0),
(258, 3, 44, NULL, NULL, 0),
(259, 3, 100, NULL, NULL, 0),
(260, 3, 84, NULL, NULL, 0),
(261, 3, 129, NULL, NULL, 0),
(262, 3, 120, NULL, NULL, 0),
(263, 2, 6, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_has_horarios`
--

CREATE TABLE `empleados_has_horarios` (
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Horarios_idHorarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleados_has_horarios`
--

INSERT INTO `empleados_has_horarios` (`Empleados_idEmpleados`, `Horarios_idHorarios`) VALUES
(5, 2),
(25, 2),
(50, 2),
(52, 2),
(53, 2),
(27, 2),
(40, 2),
(20, 2),
(24, 2),
(6, 2),
(59, 1),
(60, 1),
(71, 1),
(41, 1),
(65, 1),
(73, 1),
(68, 1),
(69, 1),
(72, 1),
(74, 1),
(58, 1),
(67, 1),
(57, 1),
(39, 1),
(38, 1),
(66, 1),
(61, 1),
(62, 1),
(56, 1),
(63, 1),
(70, 1),
(64, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_has_permisos`
--

CREATE TABLE `empleados_has_permisos` (
  `idEm_has_Per` int(11) NOT NULL,
  `fechaPermiso` date NOT NULL,
  `fechaFin` date NOT NULL,
  `descripcion` text,
  `statusPermiso` tinyint(1) DEFAULT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Permisos_idPermisos` int(11) NOT NULL,
  `fechaSolicitud` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleados_has_permisos`
--

INSERT INTO `empleados_has_permisos` (`idEm_has_Per`, `fechaPermiso`, `fechaFin`, `descripcion`, `statusPermiso`, `Empleados_idEmpleados`, `Permisos_idPermisos`, `fechaSolicitud`) VALUES
(3, '2023-06-26', '2023-06-29', 'Junta', 1, 6, 6, '2023-08-17 12:00:55'),
(4, '2023-06-28', '2023-06-28', 'asd', 1, 3, 5, '2023-08-17 12:00:55'),
(5, '2023-07-27', '2023-07-28', 'Permiso', 2, 6, 5, '2023-08-17 12:00:55'),
(6, '2023-08-29', '2023-08-31', '', 1, 3, 1, '2023-08-29 14:42:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_examen_respuesta`
--

CREATE TABLE `empleado_examen_respuesta` (
  `idEmpleado_Examen_Respuesta` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `idPregunta` int(11) NOT NULL,
  `idExamen` int(11) NOT NULL,
  `respuesta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleado_examen_respuesta`
--

INSERT INTO `empleado_examen_respuesta` (`idEmpleado_Examen_Respuesta`, `idEmpleado`, `idPregunta`, `idExamen`, `respuesta`) VALUES
(1, 3, 4, 1, 'POLLO'),
(2, 3, 9, 1, 'Morelia'),
(3, 6, 4, 1, 'AZUL'),
(4, 6, 9, 1, 'Uruapan'),
(5, 6, 15, 3, '4.0'),
(6, 6, 16, 3, '17 de cada mes'),
(7, 6, 17, 3, '3'),
(8, 6, 18, 3, '207.44'),
(9, 6, 19, 3, '31 de marzo'),
(10, 6, 20, 3, 'IA-DA=BASE'),
(11, 6, 21, 3, 'VENTA DE MEDICAMENTO'),
(12, 6, 6, 2, 'BUENO'),
(13, 6, 7, 2, '1'),
(14, 6, 8, 2, 'ROJO'),
(15, 6, 10, 2, 'AMARILLO'),
(16, 6, 12, 2, '4'),
(17, 6, 13, 2, '5'),
(18, 6, 14, 2, '1'),
(19, 6, 22, 2, 'REGULAR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_mes`
--

CREATE TABLE `empleado_mes` (
  `idEmpleado_mes` int(11) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `Publicado_idEmpleados` int(11) NOT NULL,
  `fecha_publicacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleado_mes`
--

INSERT INTO `empleado_mes` (`idEmpleado_mes`, `Empleados_idEmpleados`, `mensaje`, `Publicado_idEmpleados`, `fecha_publicacion`) VALUES
(1, 6, '<p>asd</p>', 3, '2023-05-11 19:12:00'),
(2, 34, '<p style=\"text-align: center;\">Excelente Trabajo</p>', 3, '2023-05-30 16:22:55'),
(3, 32, '<p>Muchas gracias Luis, por tu apoyo en el proyecto de Avocados Phawa. Apreciamos tu talento.</p>', 6, '2023-06-05 17:24:02'),
(4, 32, '<p>Un buen comienzo determina el resto de los d&iacute;as<br><strong>&iexcl;Excelente Inicio de semana!</strong></p>', 6, '2023-06-12 17:10:16'),
(5, 32, '<p>Hola buenas tardes</p>', 6, '2023-06-29 23:55:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `idEmpresas` int(11) NOT NULL,
  `registro_patronal` varchar(15) NOT NULL,
  `rfc` varchar(13) NOT NULL,
  `nombre_razon_social` text NOT NULL,
  `regimen` int(3) NOT NULL,
  `actividad_economica` text NOT NULL,
  `calle` text NOT NULL,
  `numero` varchar(5) NOT NULL,
  `numero_interior` varchar(5) DEFAULT NULL,
  `colonia` text NOT NULL,
  `cp` varchar(5) NOT NULL,
  `entidad` varchar(3) NOT NULL,
  `poblacion_municipio` varchar(40) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `convenio_reembolso` int(1) NOT NULL DEFAULT '0',
  `delegacion_imss` varchar(3) NOT NULL,
  `subdelegacion` varchar(40) NOT NULL,
  `clave_subdelegacion` varchar(20) NOT NULL,
  `dia_inicio_afiliacion` int(2) NOT NULL,
  `mes_inicio_afiliacion` varchar(10) NOT NULL,
  `anio_inicio_afiliacion` int(4) NOT NULL,
  `fecha_registro_empresa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`idEmpresas`, `registro_patronal`, `rfc`, `nombre_razon_social`, `regimen`, `actividad_economica`, `calle`, `numero`, `numero_interior`, `colonia`, `cp`, `entidad`, `poblacion_municipio`, `telefono`, `convenio_reembolso`, `delegacion_imss`, `subdelegacion`, `clave_subdelegacion`, `dia_inicio_afiliacion`, `mes_inicio_afiliacion`, `anio_inicio_afiliacion`, `fecha_registro_empresa`) VALUES
(3, 'C86-18977-10-1', 'PRO191220DX5', 'PROTEBA S.A.P.I. DE C.V.', 601, 'servicios de protección y custodia', 'francisco i madero', '104', '4', 'centro', '58300', 'MCH', 'Morelia', '3524711282', 0, 'MCH', 'Zamora', '1713', 20, 'Abril', 2020, '2023-05-16 19:32:03'),
(6, 'C89-10098-77-7', 'MPR14091822A', 'AVOCADOS PHAWA', 601, 'COMERCIO AL POR MAYOR DE FRUTAS Y VERDURAS', 'MOZART', '245', '', 'LA LOMA', '58290', 'MCH', 'Morelia', '3332500902', 0, 'MCH', 'Morelia', '113', 18, 'Septiembre', 2014, '2023-05-16 22:03:46'),
(7, 'Q16-98386-76-3', 'IFC080715TU5', 'IN CONSULTING MEXICO', 603, 'ASESORIA CONTABLES, FISCAL, JURIDICA, FINANCIERA', 'FACULTAD DE PSICOLOGIA', '45', '', 'REAL UNIVERSIDAD', '58060', 'MCH', 'Morelia', '3332500902', 0, 'MCH', 'Morelia', '113', 15, 'Julio', 2008, '2023-05-17 22:35:22'),
(8, 'E82-63046-76-8', 'ZGA200811IJ5', 'ZAYMO GANADERÍA', 622, 'VENTA DE GANADO', 'HERMANOS FLORES MAGON', '98', '', 'JUANA PAVON', '60490', 'MCH', 'La Piedad', '4521679799', 0, 'MCH', 'Morelia', '113', 11, 'Agosto', 2020, '2023-05-17 22:37:56'),
(9, 'Z68-36549-39-0', 'APR140409156', 'AGRYGA PRODUCTORES', 601, 'VENTA DE PRODUCTOS AGRICOLAS', 'EDUCACION ESQUINA MATAMOROS', '83', '', 'FUENTES DE MORELIA', '61600', 'MCH', 'Salvador Escalante', '4521654147', 0, 'MCH', 'Salvador Escalante', '113', 14, 'Abril', 2014, '2023-05-17 22:39:42'),
(10, 'U76-35373-73-8', 'PAQ1508247B3', 'PATRIMONIAL AUTOMOTRIZ QG SAPI DE CV', 601, 'RENTA DE BIENES INMUEBLES', 'MARIANO OTERO', '3431', 'A', 'VERDE VALLE', '24550', 'JAL', 'Guadalajara', '3332500902', 0, 'JAL', 'Guadalajara', '998', 24, 'Agosto', 2015, '2023-05-17 22:41:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes`
--

CREATE TABLE `examenes` (
  `idExamen` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `Descripcion` text,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `tiempo_limite` int(11) DEFAULT NULL,
  `intentos_maximos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `examenes`
--

INSERT INTO `examenes` (`idExamen`, `titulo`, `Descripcion`, `fecha_inicio`, `fecha_fin`, `tiempo_limite`, `intentos_maximos`) VALUES
(1, 'Evaluación psicométrica 2', '<p><strong>Instrucciones:</strong></p>\r\n<p>Este examen tiene como objetivo evaluar tus habilidades y caracter&iacute;sticas psicom&eacute;tricas. Aseg&uacute;rate de leer cuidadosamente cada pregunta y proporcionar respuestas honestas y reflexivas.</p>\r\n<p><strong>Duraci&oacute;n: </strong>El examen consta de 50 preguntas y tendr&aacute;s un tiempo m&aacute;ximo de 60 minutos para completarlo.</p>\r\n<p><strong>Formato:</strong> El examen consta de tres secciones: habilidades cognitivas, personalidad y habilidades emocionales.</p>\r\n<ul>\r\n<li>\r\n<p>Secci&oacute;n 1: Habilidades cognitivas (20 preguntas): Responde a cada pregunta seleccionando la opci&oacute;n que consideres correcta. Marca la respuesta seleccionada en la hoja de respuestas.</p>\r\n</li>\r\n<li>\r\n<p>Secci&oacute;n 2: Personalidad (20 preguntas): Para cada pregunta, elige la opci&oacute;n que mejor refleje tu comportamiento y preferencias. Marca la respuesta seleccionada en la hoja de respuestas.</p>\r\n</li>\r\n<li>\r\n<p>Secci&oacute;n 3: Habilidades emocionales (10 preguntas): Responde a cada pregunta proporcionando una breve descripci&oacute;n o reacci&oacute;n a una situaci&oacute;n emocional dada. Escribe tus respuestas en las l&iacute;neas provistas en el examen.</p>\r\n</li>\r\n</ul>\r\n<p><strong>Puntuaci&oacute;n:</strong> Cada pregunta de habilidades cognitivas y personalidad tiene un valor de 1 punto, y cada pregunta de habilidades emocionales tiene un valor de 2 puntos. La puntuaci&oacute;n total del examen es de 50 puntos.</p>\r\n<p><strong>Consejos:</strong></p>\r\n<ol>\r\n<li>Lee cada pregunta cuidadosamente antes de responder.</li>\r\n<li>Responde de manera honesta y sincera, no hay respuestas correctas o incorrectas.</li>\r\n<li>Trata de responder a todas las preguntas dentro del l&iacute;mite de tiempo asignado.</li>\r\n<li>No te preocupes por las respuestas perfectas, simplemente s&eacute; t&uacute; mismo/a.</li>\r\n<li>Mant&eacute;n la concentraci&oacute;n y evita distracciones durante el examen.</li>\r\n</ol>\r\n<p>Recuerda que este examen es una oportunidad para explorar tus habilidades y caracter&iacute;sticas psicom&eacute;tricas. &iexcl;Buena suerte y disfruta del proceso!</p>', '2023-07-10 09:00:00', '2023-07-31 23:59:00', 120, 1),
(2, 'EVALUACIÓN A JEFES', '<p>Evaluaci&oacute;n al desempe&ntilde;o de jefes de area</p>', '2023-07-10 10:00:00', '2023-07-10 16:00:00', 10, NULL),
(3, 'EVALUACIÓN CONOCIMIENTOS CONTABLES Y FISCALES', '<ul>\r\n<li>Periodo de tiempo 30 min.</li>\r\n<li>Selecciona la respuesta correcta</li>\r\n</ul>', '2023-07-18 16:00:00', NULL, 30, NULL),
(4, 'EVALUACIÓN DE DESEMPEÑO A DIRECTIVOS', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `festivos`
--

CREATE TABLE `festivos` (
  `idFestivos` int(11) NOT NULL,
  `nameFestivo` varchar(30) NOT NULL,
  `fechaFestivo` date NOT NULL,
  `fechaFin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `festivos`
--

INSERT INTO `festivos` (`idFestivos`, `nameFestivo`, `fechaFestivo`, `fechaFin`) VALUES
(1, 'OBLIGATORIO', '2023-06-12', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `folios_gastos`
--

CREATE TABLE `folios_gastos` (
  `idFolio_Gasto` int(11) NOT NULL,
  `nameFolio` text NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `folios_gastos`
--

INSERT INTO `folios_gastos` (`idFolio_Gasto`, `nameFolio`, `Empleados_idEmpleados`, `fecha_creacion`, `status`) VALUES
(1, 'OCF0001', 75, '2023-08-07 09:23:36', 1),
(2, 'EN0001', 6, '2023-08-07 09:23:54', 0),
(3, 'VIAJE GUDALAJARA', 6, '2023-08-08 14:21:45', 0),
(4, 'Prueba', 3, '2023-08-08 15:12:51', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formacion`
--

CREATE TABLE `formacion` (
  `idFormacion` int(11) NOT NULL,
  `nombreCarrera` varchar(60) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFin` date DEFAULT NULL,
  `escuela` varchar(60) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto_empleado`
--

CREATE TABLE `foto_empleado` (
  `idfoto_empleado` int(11) NOT NULL,
  `namePhoto` varchar(45) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `foto_empleado`
--

INSERT INTO `foto_empleado` (`idfoto_empleado`, `namePhoto`, `Empleados_idEmpleados`, `fechaCreacion`) VALUES
(1, 'Oscar Contrerah.png', 5, '2023-04-25 06:00:00'),
(2, 'Oscar Rafael Contreras Flota.jpg', 3, '2023-04-25 06:00:00'),
(3, 'Juan Pérez.jpg', 23, '2023-06-02 16:56:48'),
(4, 'Ana Martínez.jpg', 28, '2023-06-02 16:57:17'),
(5, 'ADAM ORTEGA CRISOSTOMO.jpg', 57, '2023-06-02 16:57:34'),
(6, 'ANA LILIA NATIVIDAD MORALES.jpg', 42, '2023-06-02 16:58:17'),
(7, 'Andrés Hernández.jpg', 27, '2023-06-02 17:02:21'),
(8, 'ARMANDO ARCHUNDIA GONZALEZ.jpg', 21, '2023-06-02 17:02:37'),
(9, 'Carolina Sánchez.jpg', 30, '2023-06-02 17:02:51'),
(10, 'DAVID BECERRA ALCAZAR.jpg', 35, '2023-06-02 17:03:05'),
(11, 'ELIZABETH GOMEZ ARREOLA.jpg', 53, '2023-06-02 17:03:42'),
(12, 'ENRIQUE VILLA RANGEL.jpg', 44, '2023-06-02 17:48:35'),
(13, 'GERARDO ROMERO GARCIA.jpg', 46, '2023-06-02 17:50:21'),
(14, 'ERICK NATIVIDAD.jpg', 6, '2023-06-02 17:52:22'),
(15, 'FREDDY PAZ ONOFRE.jpg', 38, '2023-06-02 17:54:23'),
(16, 'GABRIEL ESTEBAN PAREDES QUEZADA.jpg', 39, '2023-06-02 17:54:42'),
(17, 'Gabriela Ramírez.jpg', 31, '2023-06-02 17:56:14'),
(18, 'GILBERTO LOPEZ PEREZ.jpg', 37, '2023-06-02 17:56:46'),
(19, 'GILBERTO LOPEZ PEREZ.jpg', 37, '2023-06-02 17:56:50'),
(20, 'Gustavo Arreola.jpg', 22, '2023-06-02 18:07:28'),
(21, 'HUGO REYNEL LOPEZ.jpg', 55, '2023-06-02 18:08:03'),
(22, 'IVAN OROZCO SOTO.jpg', 43, '2023-06-02 18:08:29'),
(23, 'JAVIER MORALES LEMUS.jpg', 58, '2023-06-02 18:10:43'),
(24, 'JORDI ROSAS ZULUAGA.jpg', 45, '2023-06-02 18:13:59'),
(25, 'JORGE MEDINA.jpg', 36, '2023-06-02 18:14:32'),
(26, 'JOSE CARRILLO.jpg', 33, '2023-06-02 18:15:10'),
(27, 'KEVIN ALVAREZ CASTILLO.jpg', 47, '2023-06-02 18:15:52'),
(28, 'LUIS  PEREZ CORONADO.jpg', 32, '2023-06-02 18:16:12'),
(29, 'LUIS FRANCISCO REYES RODRIGUEZ.jpg', 48, '2023-06-02 18:27:38'),
(30, 'María López.jpg', 24, '2023-06-02 18:28:33'),
(31, 'RUTH ESTRADA GARCIA.jpg', 41, '2023-06-02 18:29:08'),
(32, 'SELENE ORTEGA GONZALEZ.jpg', 51, '2023-06-02 18:29:36'),
(33, 'SONIA MARTINEZ PLIEGO.jpg', 49, '2023-06-02 18:29:51'),
(34, 'Mayel Ortega Cambron.jpg', 19, '2023-06-02 18:30:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `idGastos` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `nameVendedor` text NOT NULL,
  `divisa` int(11) NOT NULL,
  `importeTotal` decimal(10,0) NOT NULL,
  `importeIVA` decimal(10,0) NOT NULL,
  `fechaDocumento` date NOT NULL,
  `descripcionGasto` text NOT NULL,
  `referenciaInterna` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0: Pendiente 1: Aprobado 2: Rechazado 3:Pagado',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `folio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`idGastos`, `categoria`, `nameVendedor`, `divisa`, `importeTotal`, `importeIVA`, `fechaDocumento`, `descripcionGasto`, `referenciaInterna`, `status`, `fecha_creacion`, `Empleados_idEmpleados`, `folio`) VALUES
(1, 1, 'UVeR', 1, '216', '34', '2023-07-24', 'Envió de documentos por uber a el contador Erick', '', 3, '2023-07-31 17:56:48', 75, 1),
(2, 1, 'UBER', 1, '120', '14', '2023-07-31', 'GASTOS DE TRANSPORTE FINANZAS', '', 1, '2023-07-31 22:02:01', 6, 2),
(3, 1, 'AIRB&B', 1, '600', '16', '2023-08-08', 'HOSPEDAJE PRIMER DÍA', '', 2, '2023-08-08 21:21:45', 6, 3),
(4, 1, 'CUARTO DE KILO', 1, '200', '10', '2023-08-08', 'COMIDA PRIMER DÍA', '', 1, '2023-08-08 21:31:53', 6, 3),
(5, 1, 'prueba', 1, '123', '12', '2023-08-07', 'prueba', '', 0, '2023-08-08 22:12:51', 3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `idHorarios` int(11) NOT NULL,
  `nameHorario` varchar(30) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`idHorarios`, `nameHorario`, `default`) VALUES
(1, 'L-S 9:00 a 18:00', 0),
(2, 'L-V 8:00 a 17:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incapacidades`
--

CREATE TABLE `incapacidades` (
  `idIncapacidades` int(11) NOT NULL,
  `ramo_seguro` int(11) NOT NULL,
  `tipo_riesgo` int(11) DEFAULT NULL,
  `secuela_consecuencia` varchar(40) DEFAULT NULL,
  `control_incapacidad` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_termino` date NOT NULL,
  `folio` varchar(50) DEFAULT NULL,
  `dias` int(11) DEFAULT NULL,
  `porcentaje` decimal(5,2) DEFAULT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `incapacidades`
--

INSERT INTO `incapacidades` (`idIncapacidades`, `ramo_seguro`, `tipo_riesgo`, `secuela_consecuencia`, `control_incapacidad`, `fecha_inicio`, `fecha_termino`, `folio`, `dias`, `porcentaje`, `Empleados_idEmpleados`, `status`) VALUES
(1, 1, 3, 'Recaida', 3, '2023-08-23', '2023-08-25', '321654987', 3, '22.20', 3, 1),
(2, 2, NULL, NULL, 2, '2023-08-28', '2023-09-01', 'UK897', 5, '0.00', 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `justificantes`
--

CREATE TABLE `justificantes` (
  `idJustificantes` int(11) NOT NULL,
  `Comentario` text NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Asistencias_idAsistencias` int(11) NOT NULL,
  `status_justificante` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `justificantes`
--

INSERT INTO `justificantes` (`idJustificantes`, `Comentario`, `Empleados_idEmpleados`, `Asistencias_idAsistencias`, `status_justificante`) VALUES
(1, 'Estaba una marcha', 3, 4, 1),
(2, 'Sali temprano para ver a mis hijos', 3, 3, 2),
(3, 'TRÁFICO', 6, 13, NULL),
(4, 'TRÁFICO', 6, 16, 1),
(9, 'Junta matutina', 58, 55, 1),
(10, 'TRÁFICO', 6, 17, NULL),
(11, 'ENFERMEDAD', 6, 46, NULL),
(12, 'TRÁFICO', 6, 29, NULL),
(13, 'Trafico', 3, 2, 1),
(14, 'ACCIDENTE EN AUTOPISTA', 6, 15, NULL),
(15, 'TRÁFICO', 6, 12, NULL),
(16, '', 6, 14, NULL),
(17, 'ACCIDENTE EN AUTOPISTA', 6, 19, NULL),
(18, 'ENFERMEDAD', 6, 22, NULL),
(19, 'ACCIDENTE EN AUTOPISTA', 6, 23, NULL),
(20, 'ENFERMEDAD', 6, 26, NULL),
(21, 'ACCIDENTE EN AUTOPISTA', 6, 27, NULL),
(22, 'ENFERMEDAD', 6, 28, NULL),
(23, 'TRÁFICO', 6, 14, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `idNoticias` int(11) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fecha_fin` date NOT NULL,
  `foto_noticia` int(11) NOT NULL,
  `name_foto` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idNoticias`, `Empleados_idEmpleados`, `mensaje`, `fecha_inicio`, `fecha_fin`, `foto_noticia`, `name_foto`) VALUES
(25, 3, '<p style=\"text-align: center;\">&iexcl;<strong>Feliz d&iacute;a</strong> a todos los maestros que <strong><span style=\"color: rgb(224, 62, 45);\">educan y motivan</span></strong> a sus alumnos con <em><strong>pasi&oacute;n y dedicaci&oacute;n</strong></em>!<em> Gracias por su labor tan importante y valiosa.</em></p>\n<h2 style=\"text-align: center;\"><strong>&iexcl;Que tengan un gran d&iacute;a!</strong></h2>', '2023-05-12 17:28:12', '2023-05-15', 1, '25.jpg'),
(27, 3, '<p>Bienvenidos a IN Consulting</p>', '2023-05-30 15:36:48', '2023-05-30', 1, '27.png'),
(28, 3, '<p>lkjhlkj</p>', '2023-05-12 17:39:47', '2023-05-18', 0, NULL),
(29, 3, '<h1 style=\"text-align: center;\">againg<code>321312</code></h1>', '2023-05-12 17:58:31', '2023-05-13', 1, '29.jpg'),
(30, 3, '<p>datatables</p>', '2023-05-12 22:00:49', '2023-05-13', 1, '30.png'),
(31, 6, '<p><span style=\"color: rgb(0, 0, 0);\">Hola compa&ntilde;eros queremos felicitar a Lic. Juan&nbsp;</span><br><br><strong>FELIZ CUMPLEA&Ntilde;OS</strong></p>', '2023-05-17 23:49:49', '2023-05-19', 1, '31.jpg'),
(37, 6, '<p>Atenci&oacute;n: &iexcl;Recuerden! Que el <strong>12 de junio es la fecha l&iacute;mite</strong> para registrar incidencias y autorizaciones pendientes. Es importante que se aseguren de que todos sus registros est&eacute;n completos y al d&iacute;a antes de la fecha l&iacute;mite.</p>', '2023-06-12 17:13:38', '2023-06-12', 1, '37.jpeg'),
(38, 6, '<p>Avisarles que la fecha<strong> l&iacute;mite es hasta el d&iacute;a 26 de may</strong>o, recuerda que de no hacerlo dentro de la fecha l&iacute;mite, no habr&aacute; m&aacute;s oportunidades para registrar tus incidencias y/o autorizaciones.</p>', '2023-06-13 21:55:10', '2023-06-16', 1, '38.jpeg'),
(39, 6, '<p>Recuerden! Que el <strong>12 de junio es la fecha l&iacute;mite</strong> para registrar incidencias y autorizaciones pendientes. Es importante que se aseguren de que todos sus registros est&eacute;n completos y al d&iacute;a antes de la fecha l&iacute;mite.</p>', '2023-06-22 17:55:35', '2023-06-26', 1, '39.jpeg'),
(40, 6, '<p>Avisarles que la <strong>fecha l&iacute;mite es hasta el d&iacute;a 26 de junio</strong>, recuerda que de no hacerlo dentro de la fecha l&iacute;mite, no habr&aacute; m&aacute;s oportunidades para registrar tus incidencias y/o autorizaciones.<br>Es importante que lo hagas antes posible y as&iacute; evitar cualquier inconveniente seg&uacute;n lo establecido en el reglamento.</p>', '2023-06-28 17:06:51', '2023-06-30', 1, '40.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idPermisos` int(11) NOT NULL,
  `namePermisos` varchar(30) NOT NULL,
  `colorPermisos` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idPermisos`, `namePermisos`, `colorPermisos`) VALUES
(1, 'ENFERMEDAD', '#10cb83'),
(5, 'HOME OFFICE', '#00e1ff');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulantes`
--

CREATE TABLE `postulantes` (
  `idPostulantes` int(11) NOT NULL,
  `namePostulante` varchar(30) NOT NULL,
  `lastnamePostulante` varchar(30) NOT NULL,
  `phonePostulante` varchar(15) NOT NULL,
  `emailPostulante` varchar(30) NOT NULL,
  `colorPostulante` varchar(1) DEFAULT NULL,
  `Vacantes_idVacantes` int(11) NOT NULL,
  `statusPostulante` int(11) NOT NULL DEFAULT '1',
  `fRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `idPregunta` int(11) NOT NULL,
  `idExamen` int(11) NOT NULL,
  `tipo_pregunta` enum('opcion_multiple','escala','abierta') NOT NULL,
  `pregunta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`idPregunta`, `idExamen`, `tipo_pregunta`, `pregunta`) VALUES
(4, 1, 'opcion_multiple', '<p>&iquest;Cu&aacute;l e stu comida favorita?</p>'),
(6, 2, 'abierta', '<p>&iquest;Como evaluas el desempe&ntilde;o de tu jefe directo?</p>'),
(7, 2, 'escala', '<p>&iquest;Que tan buena es la comunicacion con el jefe de departamento?</p>'),
(8, 2, 'opcion_multiple', '<p>&iquest;cu&aacute;l es tu comida favorita?</p>'),
(9, 1, 'abierta', '<p>&iquest;Donde vives?</p>'),
(10, 2, 'opcion_multiple', '<p>&iquest;DONDE NACISTE?</p>'),
(12, 2, 'escala', '<p>5+5 = 7</p>'),
(13, 2, 'escala', '<p>prueba</p>'),
(14, 2, 'escala', '<p>prueba 2</p>'),
(15, 3, 'opcion_multiple', '<p>&iquest;Cual es la versi&oacute;n de CFDI actual?</p>'),
(16, 3, 'opcion_multiple', '<p>Fecha L&iacute;mite de la presentaci&oacute;n de pagos provisionales</p>'),
(17, 3, 'opcion_multiple', '<p>D&iacute;as adicionales al RFC terminaci&oacute;n 06</p>'),
(18, 3, 'opcion_multiple', '<p>&iquest;Cual es el salario m&iacute;nimo?</p>'),
(19, 3, 'opcion_multiple', '<p>Fecha limite de presentaci&oacute;n de declaraci&oacute;n anual personas morales</p>'),
(20, 3, 'opcion_multiple', '<p>F&oacute;rmula determinaci&oacute;n ISR resico PM</p>'),
(21, 3, 'opcion_multiple', '<p>Selecciona la actividad exenta de IVA</p>'),
(22, 2, 'opcion_multiple', '<p>COMO CONSIDERAS EL DESEMPE&Ntilde;O DE TU JEFE DIRECTO?</p>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `idPuesto` int(11) NOT NULL,
  `namePuesto` varchar(45) NOT NULL,
  `salario` float NOT NULL,
  `salario_integrado` float NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Departamentos_idDepartamentos` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`idPuesto`, `namePuesto`, `salario`, `salario_integrado`, `Empleados_idEmpleados`, `Departamentos_idDepartamentos`, `status`) VALUES
(1, 'Auxiliar', 10000, 1200, 3, 45, 1),
(2, 'Etiquetador', 4445.22, 6985.22, 5, 50, 1),
(3, 'Director Aministrativo', 10005, 1200, 6, 45, 1),
(8, 'Jefe de Almacén de Caja de Campo', 12000, 650, 19, 49, 1),
(9, 'Etiquetador', 10000, 600, 20, 50, 1),
(10, 'Jefe de Cortes', 7000, 207.44, 21, 47, 1),
(11, 'Jefe de Reciba', 13000, 1200, 22, 46, 1),
(12, 'Director General', 50000, 1666.67, 23, 41, 1),
(13, 'Auxiliar de Almacen', 80000, 2666.67, 24, 48, 0),
(14, 'Supervisor de Inocuidad', 60000, 2000, 25, 51, 1),
(15, 'Contadora', 55000, 183333, 26, 98, 0),
(16, 'Jefe de Operador de Maquinaria', 65000, 2166.67, 27, 53, 1),
(17, 'Director Comercial', 45000, 1500, 28, 42, 1),
(18, 'Supervisor de Calidad', 40000, 1333.33, 29, 51, 1),
(19, 'Director RH', 50000, 1666.67, 30, 44, 1),
(20, 'Jefe de Almacen de Insumos', 70000, 2333.33, 31, 48, 1),
(21, 'Director de Operaciones', 9000, 214.77, 32, 43, 1),
(22, 'Auxiliar de Reciba', 9000, 217.44, 33, 46, 1),
(23, 'JEFE DE CÁMARAS FRÍAS', 10000, 207.44, 34, 52, 1),
(24, 'Jefe de Logistica', 15000, 207.44, 35, 50, 1),
(25, 'Jefe de Inocuidad y Calidad', 15000, 207.44, 36, 51, 1),
(26, 'Auxiliar Cámaras Frias', 8000, 212.33, 37, 52, 1),
(27, 'Flejador', 8000, 207.44, 38, 52, 1),
(28, 'Auxiliar Operador de Maquina', 8000, 207.44, 39, 62, 1),
(29, 'Empacador', 6000, 207.44, 40, 62, 0),
(30, 'Empacadora', 6000, 207.44, 41, 62, 1),
(31, 'Empacadora', 6000, 207.44, 42, 62, 1),
(32, 'Empacador', 6000, 207.44, 43, 62, 1),
(33, 'Coordinador de Estibadores', 10000, 207.44, 44, 63, 1),
(34, 'Estibador', 9000, 214.77, 45, 63, 1),
(35, 'Estibador', 9000, 207.44, 46, 63, 1),
(36, 'Alimentadores', 9000, 207.44, 47, 63, 1),
(37, 'Alimentadores', 9000, 207.44, 48, 63, 1),
(38, 'Auxiliar RH', 9000, 207.44, 49, 54, 1),
(39, 'JEFE DE COCINA', 7000, 207.44, 50, 55, 1),
(40, 'Auxiliar de Cocina', 6000, 212.09, 51, 55, 1),
(41, 'Recepcionista', 7000, 207.44, 52, 56, 0),
(42, 'Recepcionista', 7000, 207.44, 53, 56, 1),
(43, 'Vigilante', 6000, 207.44, 54, 57, 1),
(44, 'Mensajeria y Mantenimiento', 7000, 212.09, 55, 58, 1),
(45, 'CONTADOR', 12000, 207.44, 56, 59, 1),
(46, 'Auxiliar Contable', 8000, 207.44, 57, 59, 0),
(47, 'TESORERO', 18000, 207.44, 58, 61, 1),
(48, 'DIRECTOR GENERAL', 20000, 1201.98, 59, 64, 1),
(49, 'DIRECTOR GENERAL', 20000, 1201.98, 60, 64, 0),
(50, 'Subdirector', 15000, 1201.98, 61, 65, 1),
(51, 'Marketing', 12000, 207.44, 62, 66, 1),
(52, 'Diseño', 12000, 212.09, 63, 67, 1),
(53, 'Contadora', 12000, 212.09, 64, 69, 1),
(54, 'Finanzas', 12000, 212.09, 65, 70, 1),
(55, 'Control Interno', 12000, 207.44, 66, 71, 1),
(56, 'Recursos Humanos', 12000, 214.77, 67, 68, 1),
(57, 'Cocinero', 6500, 207.44, 68, 68, 1),
(58, 'Auxiliar RH', 8000, 207.44, 69, 68, 1),
(59, 'Velador', 207.44, 6500, 70, 68, 1),
(60, 'Auxiliar Contabilidad', 6500, 207.44, 71, 72, 1),
(61, 'Recepcionista', 6500, 207.44, 72, 68, 1),
(62, 'Practicas', 1400, 0, 73, 72, 1),
(63, 'Auxliar de Contabilidad', 6500, 214.77, 74, 76, 1),
(64, 'Jefe de Finanzas', 15000, 207.44, 75, 60, 1),
(66, 'Director General', 20000, 507.87, 76, 77, 1),
(67, 'Subdirector', 18000, 217.44, 77, 78, 1),
(68, 'Directora Administrativa', 15000, 509.98, 78, 80, 1),
(69, 'Director de Seguridad', 15000, 507.98, 79, 79, 1),
(70, 'Director Comercial', 15000, 609.9, 80, 81, 1),
(71, 'Supervisor San Miguel', 10000, 300, 81, 83, 1),
(72, 'Supervisor Zamora', 10000, 304.56, 82, 82, 1),
(73, 'Supervisor La Piedad', 10000, 206.67, 83, 86, 1),
(74, 'Supervisor Guanajuato', 10000, 304.67, 84, 84, 1),
(75, 'Supervisor Ocotlán', 10000, 205.67, 85, 85, 1),
(76, 'Supervisor Colima', 10000, 207.44, 86, 87, 1),
(77, 'RECURSOS HUMANOS', 10000, 207.44, 87, 88, 1),
(78, 'ADMINISTRACIÓN', 10000, 210.7, 88, 89, 1),
(79, 'TESORERÍA', 10000, 207.56, 89, 90, 1),
(80, 'Ventas', 10000, 508.98, 90, 91, 1),
(81, 'Jefe de Compras', 10000, 305.56, 91, 92, 1),
(82, 'Vigilante', 7000, 207.44, 92, 83, 1),
(83, 'Vigilante', 7000, 204.44, 93, 83, 1),
(84, 'Auxiliar RH', 7000, 217.44, 94, 88, 1),
(85, 'Vigilante', 7000, 207.44, 95, 82, 1),
(86, 'Vigilante', 7000, 207.44, 96, 82, 1),
(87, 'Vigilante', 7000, 207.44, 97, 84, 1),
(88, 'Vigilante', 7000, 207.44, 98, 84, 1),
(89, 'Vigilante', 7000, 207.44, 99, 85, 1),
(90, 'Vigilante', 7000, 207.44, 100, 85, 1),
(91, 'Vigilante', 7000, 207.44, 101, 86, 1),
(92, 'Vigilante', 7000, 207.44, 102, 86, 1),
(93, 'Vigilante', 6000, 207.44, 103, 87, 1),
(94, 'Vigilante', 6000, 207.44, 104, 87, 1),
(95, 'Dirección General', 25000, 1203.56, 105, 73, 1),
(96, 'Recursos Humanos', 20000, 1000, 106, 94, 1),
(97, 'ADMINISTRACIÓN', 20000, 1240.45, 107, 95, 1),
(98, 'COMERCIAL', 20000, 1204.56, 108, 96, 1),
(99, 'PRODUCCIÓN', 20000, 1234.56, 109, 97, 1),
(100, 'Auxiliar RH', 8000, 207.44, 110, 94, 1),
(101, 'CONTABILIDAD', 15000, 909.9, 111, 98, 1),
(102, 'ADMINISTRACIÓN', 15000, 607.89, 112, 99, 1),
(103, 'Auxiliar', 8000, 207.44, 113, 98, 1),
(104, 'Auxiliar', 8000, 207.44, 114, 99, 1),
(105, 'FINANZAS', 20000, 1209.45, 115, 100, 1),
(106, 'Auxiliar', 8000, 207.44, 116, 100, 1),
(107, 'INVENTARIOS', 15000, 204.56, 117, 104, 1),
(108, 'Ventas', 15000, 809.97, 118, 96, 1),
(109, 'Compras', 15000, 709.98, 119, 96, 1),
(110, 'ENGORDA', 9000, 309.9, 120, 101, 0),
(111, 'Control y Calidad', 15000, 208.99, 121, 102, 1),
(112, 'Veterinaria y Prevención de Enfermedades', 15000, 209.89, 122, 103, 1),
(113, 'DIRECCIÓN GENERAL', 25000, 208.9, 123, 107, 1),
(114, 'ADMINISTRACIÓN', 12000, 205.78, 124, 108, 1),
(115, 'PRODUCCIÓN', 15000, 209.9, 125, 109, 1),
(116, 'OPERACIONES', 15000, 267.89, 126, 110, 1),
(117, 'COMERCIAL', 15000, 2088.9, 127, 111, 1),
(118, 'Finanzas', 10000, 609.9, 128, 108, 1),
(119, 'Contabilidad', 10000, 909.9, 129, 108, 1),
(120, 'Control de Calidad', 10000, 209.9, 130, 109, 1),
(121, 'Bodega', 8000, 203.45, 131, 110, 1),
(122, 'Mantenimiento', 8000, 207.44, 132, 110, 1),
(123, 'Ventas', 15000, 609.9, 133, 111, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `idRespuesta` int(11) NOT NULL,
  `idPregunta` int(11) NOT NULL,
  `respuesta` text NOT NULL,
  `valor` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`idRespuesta`, `idPregunta`, `respuesta`, `valor`) VALUES
(1, 4, 'AZUL', 0),
(2, 4, 'ROJO', 0),
(3, 4, 'AMARILLO', 0),
(4, 4, 'POLLO', 1),
(5, 4, 'VERDE', 0),
(7, 6, 'abierta', 0),
(8, 7, 'escala', 0),
(9, 8, 'AZUL', 0),
(10, 8, 'ROJO', 0),
(11, 8, 'AMARILLO', 0),
(12, 8, 'POLLO', 1),
(13, 9, 'abierta', 0),
(15, 10, 'ROJO', 0),
(16, 10, 'AMARILLO', 0),
(17, 10, 'MORELIA', 1),
(18, 10, 'VERDE', 0),
(26, 12, 'binario', 5),
(27, 13, 'binario', 4),
(28, 14, 'escala', 1),
(29, 15, '2.5', 0),
(30, 15, '4.0', 1),
(31, 15, '3.0', 0),
(32, 15, '3.3', 0),
(33, 16, '17 de cada mes', 1),
(34, 16, '18 de cada mes', 0),
(35, 16, '25 de cada mes', 0),
(36, 16, '27 de cada mes', 0),
(37, 17, '9', 0),
(38, 17, '8', 0),
(39, 17, '3', 1),
(40, 17, '5', 0),
(41, 18, '290.09', 0),
(42, 18, '203.77', 0),
(43, 18, '207.34', 0),
(44, 18, '207.44', 1),
(45, 19, '31 de marzo', 1),
(46, 19, '30 de abril', 0),
(47, 19, '29 de febrero', 0),
(48, 19, '30 de marzo', 0),
(49, 20, 'IA-DA=BASE', 1),
(50, 20, 'IA*CU=BASE', 0),
(51, 20, 'I-D=BASE', 0),
(52, 20, 'I*CU=BASE', 0),
(53, 21, 'VENTA DE MEDICAMENTO', 1),
(54, 21, 'VENTA DE FERTILIZANTES', 0),
(55, 21, 'VENTA DE COMIDA PREPARADA', 0),
(56, 21, 'VENTA DE BEBIDAS ALCOHÓLICAS', 0),
(57, 22, 'BUENO', 0),
(58, 22, 'REGULAR', 1),
(59, 22, 'MALO', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reuniones`
--

CREATE TABLE `reuniones` (
  `idReuniones` int(11) NOT NULL,
  `fechaReunion` datetime NOT NULL,
  `pregunta1` int(1) DEFAULT NULL,
  `pregunta2` int(1) DEFAULT NULL,
  `pregunta3` int(1) DEFAULT NULL,
  `pregunta4` int(1) DEFAULT NULL,
  `comentariosReunion` text,
  `Postulantes_idPostulantes` int(11) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRoles` int(11) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Ver_Empleados` int(1) NOT NULL DEFAULT '0',
  `Editar_Empleados` int(1) NOT NULL DEFAULT '0',
  `Del_Empleados` int(1) NOT NULL DEFAULT '0',
  `Resumenes_Asistencias` int(1) NOT NULL DEFAULT '0',
  `Ajustes_Asistencias` int(1) NOT NULL DEFAULT '0',
  `Ver_Evaluaciones` int(1) NOT NULL DEFAULT '0',
  `Editar_Evaluaciones` int(1) NOT NULL DEFAULT '0',
  `Del_Evaluaciones` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRoles`, `Empleados_idEmpleados`, `Ver_Empleados`, `Editar_Empleados`, `Del_Empleados`, `Resumenes_Asistencias`, `Ajustes_Asistencias`, `Ver_Evaluaciones`, `Editar_Evaluaciones`, `Del_Evaluaciones`) VALUES
(1, 124, 1, 1, 1, 0, 0, 0, 0, 0),
(2, 3, 1, 0, 0, 0, 0, 1, 1, 1),
(3, 6, 1, 1, 1, 0, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_cambio_password`
--

CREATE TABLE `solicitud_cambio_password` (
  `idSolicitudPassword` int(11) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `forgot` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `fecha_solicitud` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `idTareas` int(11) NOT NULL,
  `nameTarea` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Jefe_idEmpleados` int(11) NOT NULL,
  `Vencimiento` date NOT NULL,
  `status_tarea` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_envio` datetime DEFAULT NULL,
  `opinion` text,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`idTareas`, `nameTarea`, `descripcion`, `Empleados_idEmpleados`, `Jefe_idEmpleados`, `Vencimiento`, `status_tarea`, `fecha_envio`, `opinion`, `fecha_creacion`) VALUES
(1, 'Generación de facturas', 'Genera las facturas del mes de Marzo de la empresa PHAWA ', 3, 6, '2023-07-06', 2, '2023-07-04 11:12:42', '', '2023-07-03 17:37:30'),
(2, 'DESARROLLO PROGRAMA RH', 'Realizar un sistema de registro, que sirva como apoyo para el área de recursos humanos.', 6, 3, '2023-07-07', 2, '2023-07-04 15:02:17', '', '2023-07-03 21:32:21'),
(3, 'DESARROLLO PROGRAMA RH', 'DESARROLLAR PROGRAMA DE APOYO A RH', 3, 6, '2023-09-28', 0, NULL, NULL, '2023-08-28 13:48:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea_entregas`
--

CREATE TABLE `tarea_entregas` (
  `idTarea_Entrega` int(11) NOT NULL,
  `Tareas_idTareas` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tarea_entregas`
--

INSERT INTO `tarea_entregas` (`idTarea_Entrega`, `Tareas_idTareas`, `descripcion`) VALUES
(1, 1, 'Facturas generadas'),
(2, 2, 'ENTREGADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacaciones`
--

CREATE TABLE `vacaciones` (
  `idVacaciones` int(11) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Jefe_idEmpleados` int(11) NOT NULL,
  `fecha_inicio_vacaciones` date NOT NULL,
  `fecha_fin_vacaciones` date NOT NULL,
  `fecha_solicitud` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_respuesta` timestamp NULL DEFAULT NULL,
  `fecha_aprobacion` timestamp NULL DEFAULT NULL,
  `respuesta` tinyint(4) DEFAULT NULL,
  `status_vacaciones` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vacaciones`
--

INSERT INTO `vacaciones` (`idVacaciones`, `Empleados_idEmpleados`, `Jefe_idEmpleados`, `fecha_inicio_vacaciones`, `fecha_fin_vacaciones`, `fecha_solicitud`, `fecha_respuesta`, `fecha_aprobacion`, `respuesta`, `status_vacaciones`) VALUES
(7, 6, 6, '2023-07-19', '2023-07-26', '2023-06-28 19:57:09', NULL, NULL, 1, 1),
(8, 3, 6, '2023-07-10', '2023-07-14', '2023-06-28 21:07:05', '2023-06-29 18:57:38', NULL, 2, 1),
(9, 6, 6, '2023-07-27', '2023-07-28', '2023-06-28 21:33:30', NULL, NULL, 2, 1),
(10, 6, 6, '2023-06-29', '2023-06-30', '2023-06-29 16:41:24', NULL, NULL, 1, 1),
(11, 6, 6, '2023-07-18', '2023-07-21', '2023-06-30 00:10:46', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacantes`
--

CREATE TABLE `vacantes` (
  `idVacantes` int(11) NOT NULL,
  `nameVacante` varchar(45) NOT NULL,
  `salarioVacante` float NOT NULL,
  `requisitos` varchar(255) NOT NULL,
  `Empleados_idEmpleados` int(11) DEFAULT NULL,
  `Empresas_idEmpresas` int(11) NOT NULL,
  `Departamentos_idDepartamentos` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `color` varchar(7) NOT NULL,
  `aprobado` tinyint(1) NOT NULL DEFAULT '0',
  `Jefe_idEmpleados` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vacantes`
--

INSERT INTO `vacantes` (`idVacantes`, `nameVacante`, `salarioVacante`, `requisitos`, `Empleados_idEmpleados`, `Empresas_idEmpresas`, `Departamentos_idDepartamentos`, `status`, `color`, `aprobado`, `Jefe_idEmpleados`) VALUES
(18, 'CONTADOR', 12000, '<p>Descripci&oacute;n del puesto: Estamos buscando un auxiliar contable para unirse a nuestro equipo. Nuestro candidato ideal debe tener un conocimiento s&oacute;lido de los principios contables y experiencia previa en funciones similares. Responsabilidad', 6, 6, 59, 1, '#9fb5a1', 1, 6),
(19, 'Prueba', 10000, '<p style=\"text-align: center;\">Prueba de datos</p>', 3, 6, 45, 1, '#a6576e', 2, 6),
(20, 'ADMINISTRADOR', 12000, '<p>PRUEBA</p>', 6, 7, 65, 1, '#e79c2b', 0, NULL),
(21, 'Empacador', 6000, 'Nueva Vacante', 6, 6, 62, 1, '#eae34f', 0, NULL),
(22, 'Auxiliar Contable', 8000, 'Nueva Vacante', 6, 6, 59, 1, '#22cfe8', 1, 6),
(23, 'CONTADOR', 12000, '<p>prueba</p>', 6, 3, 89, 1, '#df12c9', 0, NULL),
(24, 'CONTADOR', 15000, '<div>\r\n<div class=\"fastviewjob jobsearch-ViewJobLayout--embedded\">\r\n<div class=\"jobsearch-JobComponent icl-u-xs-mt--sm jobsearch-JobComponent--embedded css-axjo09 eu4oa1w0\">\r\n<div class=\"jobsearch-embeddedBody css-1omm75o eu4oa1w0\" tabindex=\"-1\">\r\n<div cl', 6, 3, 80, 1, '#2daa5e', 0, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`idAsistencias`);

--
-- Indices de la tabla `categorias_gastos`
--
ALTER TABLE `categorias_gastos`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`idContrato`),
  ADD KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`);

--
-- Indices de la tabla `creditos`
--
ALTER TABLE `creditos`
  ADD PRIMARY KEY (`idCreditos`),
  ADD KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`idDepartamentos`),
  ADD UNIQUE KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`),
  ADD KEY `Empresas_idEmpresas` (`Empresas_idEmpresas`);

--
-- Indices de la tabla `dia_horario`
--
ALTER TABLE `dia_horario`
  ADD PRIMARY KEY (`idDia_Horario`);

--
-- Indices de la tabla `divisas`
--
ALTER TABLE `divisas`
  ADD PRIMARY KEY (`idDivisa`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`idDocumento`),
  ADD KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`);

--
-- Indices de la tabla `documentos_gastos`
--
ALTER TABLE `documentos_gastos`
  ADD PRIMARY KEY (`idDocumento_Gasto`),
  ADD KEY `idGastos` (`Gastos_idGastos`);

--
-- Indices de la tabla `documentos_tarea_entregas`
--
ALTER TABLE `documentos_tarea_entregas`
  ADD PRIMARY KEY (`idDocumentoTareaEntregas`);

--
-- Indices de la tabla `documento_postulante`
--
ALTER TABLE `documento_postulante`
  ADD PRIMARY KEY (`idDocPost`),
  ADD KEY `Postulantes_idPostulantes` (`Postulantes_idPostulantes`);

--
-- Indices de la tabla `documento_tarea`
--
ALTER TABLE `documento_tarea`
  ADD PRIMARY KEY (`idDocumentoTarea`);

--
-- Indices de la tabla `emergencia`
--
ALTER TABLE `emergencia`
  ADD PRIMARY KEY (`idEmergencia`),
  ADD KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idEmpleados`);

--
-- Indices de la tabla `empleados_has_examenes`
--
ALTER TABLE `empleados_has_examenes`
  ADD PRIMARY KEY (`idEmpleados_has_Examenes`),
  ADD KEY `idExamen` (`idExamen`),
  ADD KEY `idEmpleado` (`idEmpleado`);

--
-- Indices de la tabla `empleados_has_permisos`
--
ALTER TABLE `empleados_has_permisos`
  ADD PRIMARY KEY (`idEm_has_Per`);

--
-- Indices de la tabla `empleado_examen_respuesta`
--
ALTER TABLE `empleado_examen_respuesta`
  ADD PRIMARY KEY (`idEmpleado_Examen_Respuesta`),
  ADD KEY `idPregunta` (`idPregunta`),
  ADD KEY `idEmpleado` (`idEmpleado`),
  ADD KEY `idExamen` (`idExamen`);

--
-- Indices de la tabla `empleado_mes`
--
ALTER TABLE `empleado_mes`
  ADD PRIMARY KEY (`idEmpleado_mes`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`idEmpresas`);

--
-- Indices de la tabla `examenes`
--
ALTER TABLE `examenes`
  ADD PRIMARY KEY (`idExamen`);

--
-- Indices de la tabla `festivos`
--
ALTER TABLE `festivos`
  ADD PRIMARY KEY (`idFestivos`);

--
-- Indices de la tabla `folios_gastos`
--
ALTER TABLE `folios_gastos`
  ADD PRIMARY KEY (`idFolio_Gasto`),
  ADD KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`);

--
-- Indices de la tabla `formacion`
--
ALTER TABLE `formacion`
  ADD PRIMARY KEY (`idFormacion`);

--
-- Indices de la tabla `foto_empleado`
--
ALTER TABLE `foto_empleado`
  ADD PRIMARY KEY (`idfoto_empleado`),
  ADD KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`idGastos`),
  ADD KEY `idCategoria` (`categoria`),
  ADD KEY `idDivisa` (`divisa`),
  ADD KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`),
  ADD KEY `folio` (`folio`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`idHorarios`);

--
-- Indices de la tabla `incapacidades`
--
ALTER TABLE `incapacidades`
  ADD PRIMARY KEY (`idIncapacidades`),
  ADD KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`);

--
-- Indices de la tabla `justificantes`
--
ALTER TABLE `justificantes`
  ADD PRIMARY KEY (`idJustificantes`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idNoticias`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idPermisos`);

--
-- Indices de la tabla `postulantes`
--
ALTER TABLE `postulantes`
  ADD PRIMARY KEY (`idPostulantes`),
  ADD KEY `Vacantes_idVacantes` (`Vacantes_idVacantes`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`idPregunta`),
  ADD KEY `idExamen` (`idExamen`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`idPuesto`),
  ADD KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`),
  ADD KEY `Departamentos_idDepartamentos` (`Departamentos_idDepartamentos`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`idRespuesta`),
  ADD KEY `idPregunta` (`idPregunta`);

--
-- Indices de la tabla `reuniones`
--
ALTER TABLE `reuniones`
  ADD PRIMARY KEY (`idReuniones`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRoles`),
  ADD KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`);

--
-- Indices de la tabla `solicitud_cambio_password`
--
ALTER TABLE `solicitud_cambio_password`
  ADD PRIMARY KEY (`idSolicitudPassword`),
  ADD KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`idTareas`);

--
-- Indices de la tabla `tarea_entregas`
--
ALTER TABLE `tarea_entregas`
  ADD PRIMARY KEY (`idTarea_Entrega`);

--
-- Indices de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD PRIMARY KEY (`idVacaciones`);

--
-- Indices de la tabla `vacantes`
--
ALTER TABLE `vacantes`
  ADD PRIMARY KEY (`idVacantes`),
  ADD KEY `Departamentos_idDepartamentos` (`Departamentos_idDepartamentos`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `idAsistencias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `categorias_gastos`
--
ALTER TABLE `categorias_gastos`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `idContrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `creditos`
--
ALTER TABLE `creditos`
  MODIFY `idCreditos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `idDepartamentos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de la tabla `dia_horario`
--
ALTER TABLE `dia_horario`
  MODIFY `idDia_Horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `divisas`
--
ALTER TABLE `divisas`
  MODIFY `idDivisa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `idDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `documentos_gastos`
--
ALTER TABLE `documentos_gastos`
  MODIFY `idDocumento_Gasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `documentos_tarea_entregas`
--
ALTER TABLE `documentos_tarea_entregas`
  MODIFY `idDocumentoTareaEntregas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `documento_postulante`
--
ALTER TABLE `documento_postulante`
  MODIFY `idDocPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `documento_tarea`
--
ALTER TABLE `documento_tarea`
  MODIFY `idDocumentoTarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `emergencia`
--
ALTER TABLE `emergencia`
  MODIFY `idEmergencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idEmpleados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT de la tabla `empleados_has_examenes`
--
ALTER TABLE `empleados_has_examenes`
  MODIFY `idEmpleados_has_Examenes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT de la tabla `empleados_has_permisos`
--
ALTER TABLE `empleados_has_permisos`
  MODIFY `idEm_has_Per` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `empleado_examen_respuesta`
--
ALTER TABLE `empleado_examen_respuesta`
  MODIFY `idEmpleado_Examen_Respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `empleado_mes`
--
ALTER TABLE `empleado_mes`
  MODIFY `idEmpleado_mes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `idEmpresas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `examenes`
--
ALTER TABLE `examenes`
  MODIFY `idExamen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `festivos`
--
ALTER TABLE `festivos`
  MODIFY `idFestivos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `folios_gastos`
--
ALTER TABLE `folios_gastos`
  MODIFY `idFolio_Gasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `formacion`
--
ALTER TABLE `formacion`
  MODIFY `idFormacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foto_empleado`
--
ALTER TABLE `foto_empleado`
  MODIFY `idfoto_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `idGastos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `idHorarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `incapacidades`
--
ALTER TABLE `incapacidades`
  MODIFY `idIncapacidades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `justificantes`
--
ALTER TABLE `justificantes`
  MODIFY `idJustificantes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idNoticias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idPermisos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `postulantes`
--
ALTER TABLE `postulantes`
  MODIFY `idPostulantes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `idPuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `idRespuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `reuniones`
--
ALTER TABLE `reuniones`
  MODIFY `idReuniones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRoles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitud_cambio_password`
--
ALTER TABLE `solicitud_cambio_password`
  MODIFY `idSolicitudPassword` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `idTareas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tarea_entregas`
--
ALTER TABLE `tarea_entregas`
  MODIFY `idTarea_Entrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  MODIFY `idVacaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `vacantes`
--
ALTER TABLE `vacantes`
  MODIFY `idVacantes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD CONSTRAINT `contrato_idEmpleados` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `creditos`
--
ALTER TABLE `creditos`
  ADD CONSTRAINT `Creditos_idEmpleados` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `Departamentos_idEmpresas` FOREIGN KEY (`Empresas_idEmpresas`) REFERENCES `empresas` (`idEmpresas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`);

--
-- Filtros para la tabla `documentos_gastos`
--
ALTER TABLE `documentos_gastos`
  ADD CONSTRAINT `Gastos_idGastos` FOREIGN KEY (`Gastos_idGastos`) REFERENCES `gastos` (`idGastos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `documento_postulante`
--
ALTER TABLE `documento_postulante`
  ADD CONSTRAINT `documento_postulante_ibfk_1` FOREIGN KEY (`Postulantes_idPostulantes`) REFERENCES `postulantes` (`idPostulantes`);

--
-- Filtros para la tabla `emergencia`
--
ALTER TABLE `emergencia`
  ADD CONSTRAINT `emergencia_ibfk_1` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleados_has_examenes`
--
ALTER TABLE `empleados_has_examenes`
  ADD CONSTRAINT `empleados_has_examenes_ibfk_1` FOREIGN KEY (`idExamen`) REFERENCES `examenes` (`idExamen`) ON DELETE CASCADE,
  ADD CONSTRAINT `empleados_has_examenes_ibfk_2` FOREIGN KEY (`idEmpleado`) REFERENCES `empleados` (`idEmpleados`) ON DELETE CASCADE;

--
-- Filtros para la tabla `empleado_examen_respuesta`
--
ALTER TABLE `empleado_examen_respuesta`
  ADD CONSTRAINT `empleado_examen_respuesta_ibfk_1` FOREIGN KEY (`idPregunta`) REFERENCES `preguntas` (`idPregunta`) ON DELETE CASCADE,
  ADD CONSTRAINT `empleado_examen_respuesta_ibfk_2` FOREIGN KEY (`idEmpleado`) REFERENCES `empleados` (`idEmpleados`) ON DELETE CASCADE,
  ADD CONSTRAINT `empleado_examen_respuesta_ibfk_3` FOREIGN KEY (`idExamen`) REFERENCES `examenes` (`idExamen`) ON DELETE CASCADE;

--
-- Filtros para la tabla `folios_gastos`
--
ALTER TABLE `folios_gastos`
  ADD CONSTRAINT `idEmpleados_Folios` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `foto_empleado`
--
ALTER TABLE `foto_empleado`
  ADD CONSTRAINT `foto_empleado_ibfk_1` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `Empleados_Gastos` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idCategoria` FOREIGN KEY (`categoria`) REFERENCES `categorias_gastos` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idDivisa` FOREIGN KEY (`divisa`) REFERENCES `divisas` (`idDivisa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idFolio_Gastos` FOREIGN KEY (`folio`) REFERENCES `folios_gastos` (`idFolio_Gasto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `incapacidades`
--
ALTER TABLE `incapacidades`
  ADD CONSTRAINT `Incapacidades_idEmpleados` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `postulantes`
--
ALTER TABLE `postulantes`
  ADD CONSTRAINT `postulantes_ibfk_1` FOREIGN KEY (`Vacantes_idVacantes`) REFERENCES `vacantes` (`idVacantes`);

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`idExamen`) REFERENCES `examenes` (`idExamen`) ON DELETE CASCADE;

--
-- Filtros para la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD CONSTRAINT `puesto_ibfk_1` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `puesto_ibfk_2` FOREIGN KEY (`Departamentos_idDepartamentos`) REFERENCES `departamentos` (`idDepartamentos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`idPregunta`) REFERENCES `preguntas` (`idPregunta`) ON DELETE CASCADE;

--
-- Filtros para la tabla `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `Roles_idEmpleados` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud_cambio_password`
--
ALTER TABLE `solicitud_cambio_password`
  ADD CONSTRAINT `Password_idEmpleados` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
