-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-08-2023 a las 17:58:35
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`idAsistencias`, `entrada`, `salida`, `fecha_asistencia`, `entrada_descanso`, `salida_descanso`, `Empleados_idEmpleados`) VALUES
(50, '08:25:01', '18:00:00', '2023-06-06', '14:32:00', '15:00:00', 20),
(51, '08:25:02', '18:00:00', '2023-06-07', '14:32:00', '15:00:00', 20),
(52, '08:25:03', '18:00:00', '2023-06-08', '14:32:00', '15:00:00', 20),
(53, '09:25:04', '18:00:00', '2023-06-09', '14:32:00', '15:00:00', 20),
(54, '08:25:05', '18:00:00', '2023-06-10', '14:32:00', '15:00:00', 20),
(55, '08:25:06', '18:00:00', '2023-06-12', '14:32:00', '15:00:00', 20),
(56, '09:25:07', '18:00:00', '2023-06-13', '14:32:00', '15:00:00', 20),
(57, '08:25:08', '18:00:00', '2023-06-14', '14:32:00', '15:00:00', 20),
(58, '08:25:09', '18:00:00', '2023-06-15', '14:32:00', '15:00:00', 20),
(59, '00:00:00', '00:00:00', '2023-06-16', '00:00:00', '00:00:00', 20),
(60, '09:25:11', '18:00:00', '2023-06-17', '14:32:00', '15:00:00', 20),
(61, '08:25:00', '18:00:00', '2023-06-05', '14:32:00', '15:00:00', 44),
(62, '08:25:01', '18:00:00', '2023-06-06', '14:32:00', '15:00:00', 44),
(63, '08:25:02', '18:00:00', '2023-06-07', '14:32:00', '15:00:00', 44),
(64, '08:25:03', '18:00:00', '2023-06-08', '14:32:00', '15:00:00', 44),
(65, '09:25:04', '18:00:00', '2023-06-09', '14:32:00', '15:00:00', 44),
(66, '08:25:05', '18:00:00', '2023-06-10', '14:32:00', '15:00:00', 44),
(67, '08:25:06', '18:00:00', '2023-06-12', '14:32:00', '15:00:00', 44),
(68, '09:25:07', '18:00:00', '2023-06-13', '14:32:00', '15:00:00', 44),
(69, '08:25:08', '18:00:00', '2023-06-14', '14:32:00', '15:00:00', 44),
(70, '08:25:09', '18:00:00', '2023-06-15', '14:32:00', '15:00:00', 44),
(71, '00:00:00', '00:00:00', '2023-06-16', '00:00:00', '00:00:00', 44),
(72, '09:25:11', '18:00:00', '2023-06-17', '14:32:00', '15:00:00', 44),
(73, '07:59:00', '18:37:00', '2023-08-05', '14:32:00', '15:00:00', 3),
(100, '07:59:00', '18:37:00', '2023-08-06', '14:32:00', '15:00:00', 3),
(101, '07:59:00', '18:37:00', '2023-08-07', '14:32:00', '15:00:00', 3),
(102, '07:59:00', '18:37:00', '2023-08-08', '14:32:00', '15:00:00', 3),
(103, '07:59:00', '18:37:00', '2023-08-09', '14:32:00', '15:00:00', 3),
(104, '07:59:00', '18:37:00', '2023-08-10', '14:32:00', '15:00:00', 3),
(105, '07:59:00', '18:37:00', '2023-08-11', '14:32:00', '15:00:00', 3),
(106, '07:59:00', '18:37:00', '2023-08-12', '14:32:00', '15:00:00', 3),
(107, '07:59:00', '18:37:00', '2023-08-13', '14:32:00', '15:00:00', 3),
(108, '07:59:00', '18:37:00', '2023-08-14', '14:32:00', '15:00:00', 3),
(109, '07:59:00', '18:37:00', '2023-08-15', '14:32:00', '15:00:00', 3),
(110, '07:59:00', '18:37:00', '2023-08-16', '14:32:00', '15:00:00', 3),
(111, '07:59:00', '18:37:00', '2023-08-17', '14:32:00', '15:00:00', 3),
(112, '07:59:00', '18:37:00', '2023-08-18', '14:32:00', '15:00:00', 3),
(113, '07:59:00', '18:37:00', '2023-08-19', '14:32:00', '15:00:00', 3),
(114, '07:59:00', '18:37:00', '2023-08-20', '14:32:00', '15:00:00', 3),
(115, '07:59:00', '18:37:00', '2023-08-21', '14:32:00', '15:00:00', 3),
(116, '07:59:00', '18:37:00', '2023-08-22', '14:32:00', '15:00:00', 3),
(117, '07:59:00', '18:37:00', '2023-08-23', '14:32:00', '15:00:00', 3),
(118, '07:59:00', '18:37:00', '2023-08-24', '14:32:00', '15:00:00', 3),
(119, '07:59:00', '18:37:00', '2023-08-25', '14:32:00', '15:00:00', 3),
(120, '07:59:00', '18:37:00', '2023-08-26', '14:32:00', '15:00:00', 3),
(121, '07:59:00', '18:37:00', '2023-08-27', '14:32:00', '15:00:00', 3),
(122, '07:59:00', '18:37:00', '2023-08-28', '14:32:00', '15:00:00', 3),
(123, '07:59:00', '18:37:00', '2023-08-29', '14:32:00', '15:00:00', 3),
(124, '07:59:00', '18:37:00', '2023-08-30', '14:32:00', '15:00:00', 3),
(125, '07:59:00', '18:37:00', '2023-08-31', '14:32:00', '15:00:00', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_gastos`
--

CREATE TABLE `categorias_gastos` (
  `idCategoria` int(11) NOT NULL,
  `nameCategoria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias_gastos`
--

INSERT INTO `categorias_gastos` (`idCategoria`, `nameCategoria`) VALUES
(1, 'Transporte'),
(3, 'Alimentos y bebidas'),
(4, 'Hospedaje');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`idContrato`, `Empleados_idEmpleados`, `tipo_contrato`, `fecha_contrato`, `fin_contrato`) VALUES
(7, 46, 'Contrato por Tiempo Indeterminado', '2023-08-25', NULL),
(8, 22, 'Contrato en Practicas', '2023-08-18', '2024-06-28'),
(10, 5, 'Contrato por Tiempo Indeterminado', '2023-04-17', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `creditos`
--

INSERT INTO `creditos` (`idCreditos`, `Empleados_idEmpleados`, `tipo_credito`, `numero_credito`, `valor_descuento`, `inicio_credito`) VALUES
(4, 22, 'Porcentaje', '5162323', 16, '2023-07-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `idDepartamentos` int(11) NOT NULL,
  `nameDepto` varchar(45) NOT NULL,
  `Empleados_idEmpleados` int(11) DEFAULT NULL,
  `Empresas_idEmpresas` int(11) NOT NULL DEFAULT 0,
  `Pertenencia` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(47, 'JEFE DE CORTES', NULL, 6, 42, 1),
(48, 'JEFE DE ALMACÉN DE ISNUMOS', 31, 6, 42, 1),
(49, 'JEFE DE ALMACÉN DE CAJA DE CAMPO', 19, 6, 42, 1),
(50, 'JEFE DE LOGISTICA', 27, 6, 43, 1),
(51, 'JEFE DE INOCUIDAD Y CALIDAD', 36, 6, 43, 1),
(52, 'JEFE DE CÁMARAS FRÍAS', 34, 6, 43, 1),
(53, 'JEFE OPERADOR DE MAQUINA', 27, 6, 43, 1),
(54, 'AUXILIAR RH', NULL, 6, 44, 1),
(55, 'JEFE DE COCINA', 3, 6, 44, 1),
(56, 'RECEPCION', NULL, 6, 44, 1),
(57, 'VIGILANCIA', NULL, 6, 44, 1),
(58, 'MENSAJERÍA Y MANTENIMIENTO', NULL, 6, 44, 1),
(59, 'CONTABILIDAD', NULL, 6, 45, 1),
(60, 'FINANZAS', NULL, 6, 45, 1),
(61, 'TESORERÍA', 44, 6, 55, 1),
(62, 'Director general', NULL, 10, 0, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dia_horario`
--

INSERT INTO `dia_horario` (`idDia_Horario`, `Horarios_idHorarios`, `dia_Laborable`, `hora_Entrada`, `hora_Salida`, `numero_Horas`) VALUES
(12, 3, 1, '16:00:00', '19:00:00', 3),
(51, 1, 1, '09:00:00', '18:00:00', 9),
(52, 1, 2, '09:00:00', '18:00:00', 9),
(53, 1, 3, '09:00:00', '18:00:00', 9),
(54, 1, 4, '09:00:00', '18:00:00', 9),
(55, 1, 5, '09:00:00', '17:00:00', 8),
(56, 1, 6, '09:00:00', '17:00:00', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `divisas`
--

CREATE TABLE `divisas` (
  `idDivisa` int(11) NOT NULL,
  `nameDivisa` text NOT NULL,
  `divisa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `divisas`
--

INSERT INTO `divisas` (`idDivisa`, `nameDivisa`, `divisa`) VALUES
(2, 'Peso Méxicano', 'MXN'),
(3, 'Dólar Americano', 'USD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `idDocumento` int(11) NOT NULL,
  `nameDoc` varchar(30) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(16, 'curriculum', 10, '2023-05-08 20:04:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_gastos`
--

CREATE TABLE `documentos_gastos` (
  `idDocumento_Gasto` int(11) NOT NULL,
  `Gastos_idGastos` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `nameDocumento` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documentos_gastos`
--

INSERT INTO `documentos_gastos` (`idDocumento_Gasto`, `Gastos_idGastos`, `tipo`, `nameDocumento`) VALUES
(1, 6, 'pdf', 'curriculum.pdf'),
(14, 6, 'excel', 'IN Consulting México - Puestos.xlsx'),
(15, 9, 'excel', 'IN Consulting México - Puestos.xlsx'),
(16, 15, 'pdf', 'curriculum.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_tarea_entregas`
--

CREATE TABLE `documentos_tarea_entregas` (
  `idDocumentoTareaEntregas` int(11) NOT NULL,
  `nameDocumento` text NOT NULL,
  `tipo` varchar(6) NOT NULL,
  `Tareas_idTareas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documentos_tarea_entregas`
--

INSERT INTO `documentos_tarea_entregas` (`idDocumentoTareaEntregas`, `nameDocumento`, `tipo`, `Tareas_idTareas`) VALUES
(1, 'curriculum.pdf', 'pdf', 1),
(2, 'IN Consulting México - Puestos.xlsx', 'excel', 1),
(3, 'IN Consulting México - Vacantes-Postulantes (1).xlsx', 'excel', 1),
(4, 'IN Consulting México - Puestos(1).xlsx', 'excel', 1),
(5, 'IN Consulting México - Vacantes-Postulantes (1)(1).xlsx', 'excel', 1),
(6, 'curriculum(1).pdf', 'pdf', 1),
(7, 'IN Consulting México - Puestos(1).xlsx', 'excel', 1),
(8, 'IN Consulting México - Vacantes-Postulantes (1)(1).xlsx', 'excel', 1),
(9, 'IN Consulting México - Puestos(1).xlsx', 'excel', 1),
(10, 'curriculum(1).pdf', 'pdf', 1),
(11, 'IN Consulting México - Vacantes-Postulantes.xlsx', 'excel', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_postulante`
--

CREATE TABLE `documento_postulante` (
  `idDocPost` int(11) NOT NULL,
  `nameDocPost` varchar(20) NOT NULL,
  `Postulantes_idPostulantes` int(11) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documento_postulante`
--

INSERT INTO `documento_postulante` (`idDocPost`, `nameDocPost`, `Postulantes_idPostulantes`, `fechaCreacion`) VALUES
(3, 'curriculum', 13, '2023-05-03 17:51:56'),
(4, 'curriculum', 14, '2023-05-04 17:54:45'),
(5, 'curriculum', 15, '2023-05-05 22:05:21'),
(6, 'curriculum', 16, '2023-06-02 16:02:51'),
(7, 'curriculum', 17, '2023-07-31 21:25:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_tarea`
--

CREATE TABLE `documento_tarea` (
  `idDocumentoTarea` int(11) NOT NULL,
  `nameDocumento` text NOT NULL,
  `tipo` varchar(6) NOT NULL,
  `Tareas_idTareas` int(11) NOT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documento_tarea`
--

INSERT INTO `documento_tarea` (`idDocumentoTarea`, `nameDocumento`, `tipo`, `Tareas_idTareas`, `fecha_subida`) VALUES
(2, 'curriculum.pdf', 'pdf', 1, '2023-07-03 21:23:56'),
(3, 'IN Consulting México - Puestos.xlsx', 'excel', 1, '2023-07-03 21:23:56'),
(4, 'Peri_operative_management_of_neuromuscular.3.pdf', 'pdf', 1, '2023-07-04 19:34:38'),
(5, 'ORGANIGRAMA.pdf', 'pdf', 1, '2023-07-04 19:34:38'),
(6, 'PROYECTO RH.pdf', 'pdf', 1, '2023-07-04 19:34:39'),
(7, 'curriculum.pdf', 'pdf', 5, '2023-08-04 21:13:33');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `emergencia`
--

INSERT INTO `emergencia` (`idEmergencia`, `nameEmer`, `parentesco`, `phoneEmer`, `Empleados_idEmpleados`) VALUES
(1, 'Miguel Angel Contreras Parra', 'padre', '4435398291', 3),
(3, '32165', 'madre', '654654654', 5),
(4, 'LUIS NATIVIDAD', 'padre', '5516080808', 6),
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
(40, 'padre', 'padre', '6543216542', 43),
(41, 'padre', 'padre', '6543216542', 44),
(42, '321654', 'hermano', '3213213211', 45),
(43, '321654', 'hermano', '3213213211', 46),
(44, '321654', 'madre', '3219876541', 47),
(45, 'Cleofas Madrigal Rojas', 'padre', '443155425512', 48);

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
  `status` int(1) NOT NULL DEFAULT 1,
  `fecha_contratado` date NOT NULL,
  `fecha_baja` date DEFAULT NULL,
  `causaBaja` int(11) DEFAULT NULL,
  `detalles_baja` text DEFAULT NULL,
  `cambio_password` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idEmpleados`, `name`, `lastname`, `genero`, `fNac`, `phone`, `email`, `password`, `identificacion`, `CURP`, `NSS`, `RFC`, `street`, `numE`, `numI`, `colonia`, `CP`, `municipio`, `estado`, `status`, `fecha_contratado`, `fecha_baja`, `causaBaja`, `detalles_baja`, `cambio_password`) VALUES
(3, 'Oscar Rafael', 'Contreras Flota', '1', '1991-12-19', '4435398291', 'oscarcontrerasf91@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auH6qR0UbI.DmYxsNQr.W23BFuFN44K/6', '554025566656', 'COFO911219HMNNLS06', '654321965432', 'COFO911219925', 'Palomas 2', '149', '', 'La hacienda', '58330', 'Morelia', 'MCH', 1, '2018-11-18', NULL, NULL, NULL, 1),
(5, 'Rafael', 'Flota Sanchez', '1', '1995-05-30', '3213216565', 'rafa@gmail.com', '', '3ASD354', 'CASD321533654DASD22', '64641323156', '65465sdasd65', 'alsjkh', '654', '1', '32132', '32132', 'sasd', 'asdad', 1, '2023-04-17', NULL, NULL, NULL, 0),
(6, 'ERICK', 'NATIVIDAD', '1', '1993-05-16', '4433900175', 'ericknatividad93@hotmail.com', '$2a$07$asxx54ahjppf45sd87a5au3jMxNjqSyn3ov6ZS7NtPJvp5DE/f/.C', '8', 'CASD321533654DASD22', '53029875477', 'NABE9304168D3', 'FACULTAD DE PSICOLOGIA', '45', '', 'REAL UNIVERSIDAD', '58088', 'MORELIA', 'MICHOACAN', 1, '2023-04-25', NULL, NULL, NULL, 1),
(19, 'Mayel', 'Ortega Cambron', '0', '1998-07-23', '5526553212', 'mayel_ortega@gmail.com', '$2a$07$asxx54ahjppf45sd87a5aubbQpcQrXYn9ZKDUEfe01oXXasks7XAG', '456789789456', 'ORCM321654987654', '3216541651', 'ORCM32165331', 'Rey Moctezuma', '64', '', 'Mil cumbres', '58290', 'Morelia', 'Michoacán', 1, '2023-05-15', NULL, NULL, NULL, 1),
(20, 'Yoan Adan', 'Leon', '1', '1960-01-01', '4430000001', 'presidente@presi.com', '$2a$07$asxx54ahjppf45sd87a5auBA48O9ABbE9gVX8hQuNp.EE2XfSPpV2', '100000001', 'gepr600101hmnnlq50', '1000000002', 'gepr600101252', 'Loma dorada', '01', '', 'Las lomas', '53001', 'Morelia', 'Selecciona un estado', 1, '2023-05-17', NULL, NULL, NULL, 1),
(21, 'ARMANDO', 'ARCHUNDIA GONZALEZ', '1', '1991-05-11', '4433900175', 'armando.archundia@asdasd.com', '$2a$07$asxx54ahjppf45sd87a5aurddAI2BXhiv9mPV1Ckqwr5MLxhkjq9y', '7253762', 'GOAA910511HMNTCR07', '93725481921', 'GOAA910511HMNTC', 'OLIMPIADA', '34', '', 'UNIVERSIDAD', '89990', 'Alpoyeca', 'GRO', 0, '2023-05-01', '2023-07-15', 2, 'Separación voluntaria', 0),
(22, 'Gustavo', 'Arreola', '1', '1984-05-25', '4465986587', 'gus@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auuULuOA7.yjgcURqGzZXUeaY.w1/n3.i', '321654321654', 'ARGU840525hmnfd05', '32132165498', 'argu840525', 'asd', '321', '', '32', '58260', 'Morelia', 'Michoacán', 1, '2023-05-18', NULL, NULL, NULL, 0),
(23, 'Juan', 'Pérez', '1', '1985-05-15', '5551234567', 'juan.perez@example.com', '$2a$07$asxx54ahjppf45sd87a5auzIU8S1tuTaikH9DUOSX2LY0tkhc7RK2', '1234567890', 'PERJ850512HDFXXX01', '9876543210', 'PERJ850512XXX', 'Calle Principal', '123', '1A', 'Centro', '12345', 'Ciudad de México', 'CDMX', 1, '2023-05-19', NULL, NULL, NULL, 0),
(24, 'María', 'López', '0', '1990-09-28', '5559876543', 'maria.lopez@example.com', '$2a$07$asxx54ahjppf45sd87a5autRLTQuEDFjtDghTEl2HCO.NFslgg7Tu', '0987654321', 'LOPM900928MDFXXX02', '1234567890', 'LOPM900928XXX', 'Avenida Juárez', '456', '2B', 'Reforma', '54321', 'Ciudad de México', 'CDMX', 1, '2023-05-19', '2023-05-24', NULL, NULL, 0),
(25, 'Roberto', 'García', '1', '1982-11-02', '5555555555', 'roberto.garcia@example.com', '$2a$07$asxx54ahjppf45sd87a5aujd4UPYbNfEZcue0P6yyIPgFYafH1fea', '1357924680', 'GARR821102MDFXXX03', '9876543210', 'GARR821102XXX', 'GARR821102XXX', '789', '3C', 'Del Valle', '67890', 'Ciudad de México', 'CDMX', 1, '2023-05-19', NULL, NULL, NULL, 0),
(26, 'Laura', 'Rodríguez', '0', '1995-03-15', '5552223333', 'laura.rodriguez@example.com', '$2a$07$asxx54ahjppf45sd87a5aunPLtscj8Bj2VjY3Dod1v5EHrVjGV2vG', '8642097531', 'RODL950315MDFXXX04', '1234567890', 'RODL950315XXX', 'Avenida Reforma', '321', '4D', 'Polanco', '45678', 'Ciudad de México', 'CDMX', 0, '2023-05-19', '2023-05-18', 1, NULL, 0),
(27, 'Andrés', 'Hernández', '1', '1988-08-20', '5553332222', 'andres.hernandez@example.com', '$2a$07$asxx54ahjppf45sd87a5auRti6saKEkyuQmdvUYFTh6h0huW4haHu', '9753108642', 'HERA880720MDFXXX05', '9876543210', 'HERA880720XXX', 'Calle de la Luna', '654', '5E', 'Condes', '59789', 'Ciudad de méxico', 'CDMX', 1, '2023-05-19', NULL, NULL, NULL, 0),
(28, 'Ana', 'Martínez', '0', '1992-12-10', '5558889999', 'ana.martinez@example.com', '$2a$07$asxx54ahjppf45sd87a5auX9vEJcqQWeK8sk/j9eWWzclmoCXBfM6', '8642097531', 'MART921210MDFXXX06', '1234567890', 'MART921210XXX', 'Avenida Insurgentes', '987', '6F', 'Roma', '45678', 'Ciudad de méxico', 'CDMX', 1, '2023-05-19', NULL, NULL, NULL, 0),
(29, 'Ricardo', 'Vargas', '1', '1980-08-05', '5556667777', 'ricardo.vargas@example.com', '$2a$07$asxx54ahjppf45sd87a5auMUDk16Ed3i64oCHjw4GAZHe/3sB2Ww.', '9876543210', 'VARR800805MDFXXX07', '9876543210', 'VARR800805XXX', ' Calle de los Pinos', '321', '7G', 'Del bosque', '56789', 'Ciudad de móxico', 'CDMX', 1, '2023-05-19', NULL, NULL, NULL, 0),
(30, 'Carolina', 'Sánchez', '0', '1993-09-25', '5557778888', 'carolina.sanchez@example.com', '$2a$07$asxx54ahjppf45sd87a5au/wc8C7a69DzqmuOV5qViEl83KeRyWTW', '9753108642', 'SANC930925MDFXXX08', '1234567890', 'SANC930925XXX', 'Avenida Morelos', '654', '8H', 'Tlalpan', '45678', 'Ciudad de México', 'CDMX', 1, '2023-05-19', NULL, NULL, NULL, 0),
(31, 'Gabriela', 'Ramírez', '0', '1991-04-02', '4569028625', 'gabriela.ramirez@example.com', '$2a$07$asxx54ahjppf45sd87a5auL3BOJdw5UlTjafqj16lFITe.7zA0hUa', '8642097531', 'RAMG910402MDFXXX10', '1234567890', 'RAMG910402XXX', 'Avenida Hidalgo', '321', '10J', 'Cuauhtémoc', '45678', 'Ciudad de México', 'CDMX', 1, '2023-05-19', NULL, NULL, NULL, 0),
(32, 'LUIS ', 'PEREZ CORONADO', '1', '1980-03-21', '4521654147', 'LUISPALEO@hotmail.com', '$2a$07$asxx54ahjppf45sd87a5aubbQpcQrXYn9ZKDUEfe01oXXasks7XAG', '183639494', 'PAZL900321HMNTCR07', '725439009761', 'PAZL900321JCA', 'DOMICILIO CONOCIDO', '1222', '12', 'JUANA PAVON', '60490', 'MORELIA', 'Michoacan', 1, '2023-05-24', NULL, NULL, NULL, 1),
(33, 'JOSE', 'CARRILLO', '1', '1987-09-18', '4521679799', 'JOSECARRILLO@GMAIL.COM', '$2a$07$asxx54ahjppf45sd87a5auMejtr5RryVTdsj9ADRi8siKCbPtSbkG', '173532618251', 'CALP730912HMNTCR07', '72653736272', 'CALP730908LC0', 'EDUCACION ESQUINA MATAMOROS', 'SN', '12', 'REAL UNIVERSIDAD', '60490', 'MORELIA', 'Michoacan', 1, '2023-05-24', NULL, NULL, NULL, 0),
(34, 'RAUL', 'MOLINA', '1', '1993-09-07', '4521654147', 'gumor@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auuw4GnAVLVXyEv.uAxdYPcOz79VHrdGG', 'W727373U', 'VEME790916MMNNRR07', '22222233', 'MPR14091822A', 'HERMANOS FLORES MAGON', '1584', '', 'JUANA PAVON', '60180', 'MORELIA', 'Michoacan', 1, '2023-05-24', NULL, NULL, NULL, 0),
(35, 'DAVID', 'BECERRA ALCAZAR', '1', '1995-03-06', '4400998866', 'contabilidadgdl@inconsultingmexico.com', '$2a$07$asxx54ahjppf45sd87a5auAE9lF7pz/rTfj4HYna.BEJ2O86mBkdq', '10', 'BEAD950306HMNTCR07', '8763519036', 'BEAD950306765', 'PASEO LAZARO CARDENAS', '45', '', 'LA SOLEDAD', '60180', 'MORELIA', 'MICHOACAN', 1, '2023-05-30', NULL, NULL, NULL, 0),
(36, 'JORGE', 'MEDINA', '1', '1989-07-25', '4521654147', 'jorgemedina@example.com', '$2a$07$asxx54ahjppf45sd87a5auHzjdMXdXdTVcWPVWk5D7KG.Fa/4l22.', '92726267', 'MEAJ890725HMNTVR07', '729374516199', 'MEAJ890725TU8', 'DOMICILIO CONOCIDO', 'SN', '12', 'FUENTES DE MORELIA', '60490', 'MORELIA', 'MICHOACAN', 1, '2023-05-30', NULL, NULL, NULL, 0),
(43, 'Fernando', 'Tejeda', '1', '1997-01-12', '3216543211', 'asd@lk2j.com', '$2a$07$asxx54ahjppf45sd87a5auoiWZXmlarIDnF5WwiYkB8tKInDo.AVm', '32165432152', 'TEFE970112hmnnls15', '321454212656', 'TEFE970112563', 'lñkj', 'lkj', 'lkj', 'lkj', '0', 'lkj', 'lkj', 1, '2023-06-01', NULL, NULL, NULL, 0),
(44, 'Luis', 'Tejeda', '1', '1997-01-12', '3216543211', 'asd@lkj.com', '$2a$07$asxx54ahjppf45sd87a5auBA48O9ABbE9gVX8hQuNp.EE2XfSPpV2', '32165432152', 'TEFE970112hmnnls15', '321454212656', 'TEFE970112563', 'lñkj', 'lkj', 'lkj', 'lkj', '0', 'lkj', 'lkj', 1, '2023-06-01', NULL, NULL, NULL, 1),
(45, 'lkjasd', 'ljkh', '0', '1992-02-03', '6546546547', '321@ga.coa', '$2a$07$asxx54ahjppf45sd87a5au6IX4lqG.I2qQT8OxrvYiQSzI/4YsxXa', '321', '354', '654', '321', '654', '654', '654', '65', '46', '5465', '654', 0, '2023-06-01', '2023-06-05', NULL, NULL, 0),
(46, 'lkjasd', 'ljkh', '0', '1992-02-03', '6546546547', '321@ga.coa', '$2a$07$asxx54ahjppf45sd87a5auRboTE3v/FNaysivjQWh.Vjdzzq7fP/2', '321', '354', '654', '321', '654', '654', '654', '65', '46', '5465', '654', 1, '2023-06-01', NULL, NULL, NULL, 0),
(47, 'Pablo Antonio', 'Amezcua', '1', '1997-01-31', '3219876541', 'asd@alsdl.ca', '$2a$07$asxx54ahjppf45sd87a5auV5tEwYRWjOtsQ/XTaOIAbjYIi/DOf5y', '987654321', '654987', '654987', '324654', 'calle', '354', '321', 'LA LOMA 2', '32154', 'Allende', 'CHI', 0, '2023-06-13', '2023-07-15', 1, 'Conclusión de su contrato laboral', 0),
(48, 'Gloria', 'Madrigal Tapia ', '0', '1997-03-25', '4432659512', 'gloris.mata@gmail.com', '$2a$07$asxx54ahjppf45sd87a5aug5XBhSmYXIZL.RsgrO/k.cDVZL1Zsri', '8495623251', 'MATG970325MNNLS15', '6549874515', 'MATG970325146', '5 de febrero', '16', '', 'Centro', '58000', 'Morelia', 'MCH', 1, '2022-07-16', NULL, NULL, NULL, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados_has_examenes`
--

INSERT INTO `empleados_has_examenes` (`idEmpleados_has_Examenes`, `idExamen`, `idEmpleado`, `fecha_inicio`, `fecha_fin`, `tiempo_utilizado`) VALUES
(31, 6, 22, NULL, NULL, 0),
(32, 6, 35, NULL, NULL, 0),
(33, 6, 33, NULL, NULL, 0),
(34, 6, 3, '2023-07-19 15:18:07', '2023-07-19 15:19:39', 1),
(35, 6, 25, NULL, NULL, 0),
(36, 6, 24, NULL, NULL, 0),
(89, 4, 47, NULL, NULL, 0),
(90, 4, 21, NULL, NULL, 0),
(91, 4, 22, NULL, NULL, 0),
(92, 4, 35, NULL, NULL, 0),
(93, 4, 33, NULL, NULL, 0),
(94, 4, 3, '2023-08-14 10:32:24', '2023-08-14 10:43:08', 10),
(95, 4, 5, NULL, NULL, 0),
(96, 4, 25, NULL, NULL, 0),
(97, 4, 45, NULL, NULL, 0),
(98, 4, 24, NULL, NULL, 0),
(99, 4, 36, NULL, NULL, 0),
(100, 4, 30, NULL, NULL, 0),
(101, 4, 44, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_has_horarios`
--

CREATE TABLE `empleados_has_horarios` (
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Horarios_idHorarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados_has_horarios`
--

INSERT INTO `empleados_has_horarios` (`Empleados_idEmpleados`, `Horarios_idHorarios`) VALUES
(47, 1),
(21, 1),
(22, 1),
(35, 1),
(33, 1),
(3, 1),
(5, 1),
(25, 1),
(27, 1),
(20, 1),
(45, 1),
(46, 1),
(24, 1),
(48, 1),
(28, 1),
(36, 1),
(34, 1),
(6, 1),
(19, 1),
(23, 1),
(32, 1),
(31, 1),
(26, 1),
(30, 1),
(43, 1),
(44, 1),
(29, 1),
(49, 1),
(50, 3),
(51, 3),
(52, 3),
(53, 1),
(54, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_has_permisos`
--

CREATE TABLE `empleados_has_permisos` (
  `idEm_has_Per` int(11) NOT NULL,
  `fechaPermiso` date NOT NULL,
  `fechaFin` date NOT NULL,
  `descripcion` text DEFAULT NULL,
  `statusPermiso` tinyint(1) DEFAULT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Permisos_idPermisos` int(11) NOT NULL,
  `fechaSolicitud` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados_has_permisos`
--

INSERT INTO `empleados_has_permisos` (`idEm_has_Per`, `fechaPermiso`, `fechaFin`, `descripcion`, `statusPermiso`, `Empleados_idEmpleados`, `Permisos_idPermisos`, `fechaSolicitud`) VALUES
(2, '2023-07-05', '2023-07-10', 'Me mudo', 1, 20, 1, '2023-06-23 18:25:30'),
(6, '2023-06-27', '2023-06-28', 'Me duele el cuerpo', 2, 20, 2, '2023-06-26 17:36:36'),
(9, '2023-08-18', '2023-08-18', 'pls', NULL, 3, 1, '2023-08-17 18:52:18'),
(10, '2023-08-18', '2023-08-19', '31', NULL, 3, 1, '2023-08-17 18:52:43');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado_examen_respuesta`
--

INSERT INTO `empleado_examen_respuesta` (`idEmpleado_Examen_Respuesta`, `idEmpleado`, `idPregunta`, `idExamen`, `respuesta`) VALUES
(1, 3, 5, 6, '258'),
(2, 3, 9, 6, '1'),
(3, 3, 12, 6, 'r2'),
(4, 3, 14, 6, '5'),
(6, 3, 17, 6, '3'),
(7, 3, 18, 6, '2'),
(8, 3, 19, 6, 'Oscar Contreras Flota'),
(10, 3, 20, 6, '4'),
(11, 3, 21, 4, '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_mes`
--

CREATE TABLE `empleado_mes` (
  `idEmpleado_mes` int(11) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `Publicado_idEmpleados` int(11) NOT NULL,
  `fecha_publicacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado_mes`
--

INSERT INTO `empleado_mes` (`idEmpleado_mes`, `Empleados_idEmpleados`, `mensaje`, `Publicado_idEmpleados`, `fecha_publicacion`) VALUES
(1, 6, '<p>asd</p>', 3, '2023-05-11 19:12:00'),
(2, 34, '<p style=\"text-align: center;\">Excelente Trabajo</p>', 3, '2023-05-30 16:22:55'),
(3, 0, '<p>Felicidades</p>', 3, '2023-06-06 18:08:47'),
(4, 21, '<p>Felicidades</p>', 3, '2023-06-06 18:11:22'),
(5, 23, '<p style=\"text-align: center;\">Gran boss</p>', 3, '2023-06-13 18:01:57'),
(6, 6, '<p>Buen trabajo</p>', 3, '2023-06-28 16:32:24'),
(7, 3, '<p style=\"text-align: center;\">cool</p>', 3, '2023-06-28 16:35:11'),
(8, 3, '<p>asd</p>', 3, '2023-06-28 16:35:35'),
(9, 3, '<p>asd</p>', 3, '2023-06-28 16:38:40'),
(10, 24, '<p>asdasd</p>', 3, '2023-06-28 16:58:38'),
(11, 20, '<p>asdasdasd</p>', 3, '2023-06-28 16:59:27'),
(12, 19, '<p>Buen trabajo</p>', 3, '2023-07-07 15:40:30');

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
  `convenio_reembolso` int(1) NOT NULL DEFAULT 0,
  `delegacion_imss` varchar(3) NOT NULL,
  `subdelegacion` varchar(40) NOT NULL,
  `clave_subdelegacion` varchar(20) NOT NULL,
  `dia_inicio_afiliacion` int(2) NOT NULL,
  `mes_inicio_afiliacion` varchar(10) NOT NULL,
  `anio_inicio_afiliacion` int(4) NOT NULL,
  `fecha_registro_empresa` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `Descripcion` text DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `tiempo_limite` int(11) DEFAULT NULL,
  `intentos_maximos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `examenes`
--

INSERT INTO `examenes` (`idExamen`, `titulo`, `Descripcion`, `fecha_inicio`, `fecha_fin`, `tiempo_limite`, `intentos_maximos`) VALUES
(4, 'Evaluación de capacidades contables', '<p><strong>Instrucciones:</strong></p>\r\n<p>Este examen tiene como objetivo evaluar tus capacidades en el campo de la contabilidad. Aseg&uacute;rate de leer cuidadosamente cada pregunta y proporcionar respuestas precisas y completas.</p>\r\n<p><strong>Duraci&oacute;n: </strong>El examen consta de 20 preguntas y tendr&aacute;s un tiempo m&aacute;ximo de 90 minutos para completarlo.</p>\r\n<p><strong>Formato: </strong>El examen consta de dos secciones: preguntas de opci&oacute;n m&uacute;ltiple y preguntas de desarrollo.</p>\r\n<ul>\r\n<li>\r\n<p>Secci&oacute;n 1: Preguntas de opci&oacute;n m&uacute;ltiple (10 preguntas): Para cada pregunta, elige la opci&oacute;n correcta entre las opciones proporcionadas. Marca la respuesta seleccionada en la hoja de respuestas.</p>\r\n</li>\r\n<li>\r\n<p>Secci&oacute;n 2: Preguntas de desarrollo (10 preguntas): Para cada pregunta, desarrolla una respuesta completa y clara. Escribe tus respuestas en las l&iacute;neas provistas en el examen.</p>\r\n</li>\r\n</ul>\r\n<p><strong>Puntuaci&oacute;n: </strong>Cada pregunta de opci&oacute;n m&uacute;ltiple tiene un valor de 2 puntos, y cada pregunta de desarrollo tiene un valor de 5 puntos. La puntuaci&oacute;n total del examen es de 100 puntos.</p>\r\n<p><strong>Consejos:</strong></p>\r\n<ol>\r\n<li>Lee cada pregunta cuidadosamente antes de responder.</li>\r\n<li>Organiza tus respuestas de manera clara y estructurada.</li>\r\n<li>Presta atenci&oacute;n a la precisi&oacute;n y exactitud de tus c&aacute;lculos contables.</li>\r\n<li>Utiliza terminolog&iacute;a contable adecuada en tus respuestas.</li>\r\n<li>Administra tu tiempo sabiamente y aseg&uacute;rate de completar todas las preguntas dentro del l&iacute;mite de tiempo asignado.</li>\r\n</ol>\r\n<p><span style=\"color: rgb(53, 152, 219);\"><strong>Recuerda que este examen es una oportunidad para demostrar tus conocimientos y habilidades contables. &iexcl;Buena suerte!</strong></span></p>', '2023-07-17 09:00:00', NULL, NULL, NULL),
(6, 'Evaluación psicométrica', '<p><span style=\"font-family: arial, helvetica, sans-serif;\"><strong>Instrucciones:</strong></span></p>\r\n<p><span style=\"font-family: arial, helvetica, sans-serif;\">Este examen tiene como objetivo evaluar tus habilidades y caracter&iacute;sticas psicom&eacute;tricas. Aseg&uacute;rate de leer cuidadosamente cada pregunta y proporcionar respuestas honestas y reflexivas.</span></p>\r\n<p><span style=\"font-family: arial, helvetica, sans-serif;\"><strong>Duraci&oacute;n: </strong>El examen consta de 50 preguntas y tendr&aacute;s un tiempo m&aacute;ximo de 60 minutos para completarlo.</span></p>\r\n<p><span style=\"font-family: arial, helvetica, sans-serif;\"><strong>Formato:</strong> El examen consta de tres secciones: habilidades cognitivas, personalidad y habilidades emocionales.</span></p>\r\n<ul>\r\n<li style=\"font-family: arial, helvetica, sans-serif;\">\r\n<p><span style=\"font-family: arial, helvetica, sans-serif;\">Secci&oacute;n 1: Habilidades cognitivas (20 preguntas): Responde a cada pregunta seleccionando la opci&oacute;n que consideres correcta. Marca la respuesta seleccionada en la hoja de respuestas.</span></p>\r\n</li>\r\n<li style=\"font-family: arial, helvetica, sans-serif;\">\r\n<p><span style=\"font-family: arial, helvetica, sans-serif;\">Secci&oacute;n 2: Personalidad (20 preguntas): Para cada pregunta, elige la opci&oacute;n que mejor refleje tu comportamiento y preferencias. Marca la respuesta seleccionada en la hoja de respuestas.</span></p>\r\n</li>\r\n<li style=\"font-family: arial, helvetica, sans-serif;\">\r\n<p><span style=\"font-family: arial, helvetica, sans-serif;\">Secci&oacute;n 3: Habilidades emocionales (10 preguntas): Responde a cada pregunta proporcionando una breve descripci&oacute;n o reacci&oacute;n a una situaci&oacute;n emocional dada. Escribe tus respuestas en las l&iacute;neas provistas en el examen.</span></p>\r\n</li>\r\n</ul>\r\n<p><span style=\"font-family: arial, helvetica, sans-serif;\"><strong>Puntuaci&oacute;n: </strong>Cada pregunta de habilidades cognitivas y personalidad tiene un valor de 1 punto, y cada pregunta de habilidades emocionales tiene un valor de 2 puntos. La puntuaci&oacute;n total del examen es de 50 puntos.</span></p>\r\n<p><span style=\"font-family: arial, helvetica, sans-serif;\"><strong>Consejos:</strong></span></p>\r\n<ol>\r\n<li style=\"font-family: arial, helvetica, sans-serif;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Lee cada pregunta cuidadosamente antes de responder.</span></li>\r\n<li style=\"font-family: arial, helvetica, sans-serif;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Responde de manera honesta y sincera, no hay respuestas correctas o incorrectas.</span></li>\r\n<li style=\"font-family: arial, helvetica, sans-serif;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Trata de responder a todas las preguntas dentro del l&iacute;mite de tiempo asignado.</span></li>\r\n<li style=\"font-family: arial, helvetica, sans-serif;\"><span style=\"font-family: arial, helvetica, sans-serif;\">No te preocupes por las respuestas perfectas, simplemente s&eacute; t&uacute; mismo/a.</span></li>\r\n<li style=\"font-family: arial, helvetica, sans-serif;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Mant&eacute;n la concentraci&oacute;n y evita distracciones durante el examen.</span></li>\r\n</ol>\r\n<p><span style=\"font-family: arial, helvetica, sans-serif;\">Recuerda que este examen es una oportunidad para explorar tus habilidades y caracter&iacute;sticas psicom&eacute;tricas. &iexcl;Buena suerte y disfruta del proceso!</span></p>', '2023-07-20 09:00:00', '2023-07-28 23:59:00', 60, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `festivos`
--

CREATE TABLE `festivos` (
  `idFestivos` int(11) NOT NULL,
  `nameFestivo` varchar(30) NOT NULL,
  `fechaFestivo` date NOT NULL,
  `fechaFin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `festivos`
--

INSERT INTO `festivos` (`idFestivos`, `nameFestivo`, `fechaFestivo`, `fechaFin`) VALUES
(6, 'Navidad', '2023-12-24', '2023-12-26'),
(7, 'Día de las madres', '2023-05-10', NULL),
(8, 'Año nuevo', '2023-12-31', '2024-01-01'),
(9, '10 de Junio', '2023-06-10', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `folios_gastos`
--

CREATE TABLE `folios_gastos` (
  `idFolio_Gasto` int(11) NOT NULL,
  `nameFolio` text NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `folios_gastos`
--

INSERT INTO `folios_gastos` (`idFolio_Gasto`, `nameFolio`, `Empleados_idEmpleados`, `fecha_creacion`, `status`) VALUES
(1, 'ORC0001', 3, '2023-08-07 10:11:32', 0),
(2, 'EN0002', 44, '2023-08-07 11:08:09', 1),
(5, 'Viaje a Cancún ', 3, '2023-08-08 15:09:14', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto_empleado`
--

CREATE TABLE `foto_empleado` (
  `idfoto_empleado` int(11) NOT NULL,
  `namePhoto` varchar(45) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `foto_empleado`
--

INSERT INTO `foto_empleado` (`idfoto_empleado`, `namePhoto`, `Empleados_idEmpleados`, `fechaCreacion`) VALUES
(1, 'Oscar Contrerah.png', 5, '2023-04-25 06:00:00'),
(3, 'Carolina Sánchez.png', 30, '2023-06-12 18:21:54'),
(4, 'Oscar Contreras.jpg', 3, '2023-08-10 19:58:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `idGastos` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `nameVendedor` text NOT NULL,
  `divisa` int(11) NOT NULL,
  `importeTotal` float NOT NULL,
  `importeIVA` float NOT NULL,
  `fechaDocumento` date NOT NULL,
  `descripcionGasto` text NOT NULL,
  `referenciaInterna` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0: Pendiente\r\n1: Aprobado\r\n2: Rechazado\r\n3: Pagado',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `Empleados_idEmpleados` int(11) NOT NULL,
  `folio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`idGastos`, `categoria`, `nameVendedor`, `divisa`, `importeTotal`, `importeIVA`, `fechaDocumento`, `descripcionGasto`, `referenciaInterna`, `status`, `fecha_creacion`, `Empleados_idEmpleados`, `folio`) VALUES
(6, 1, 'Uber', 2, 1500, 240, '2023-06-17', 'Pago Uber', 'Aprobado por Erick', 1, '2023-07-31 21:40:02', 3, 1),
(9, 1, 'asd', 3, 123, 2, '2023-08-02', 'qwe', '', 2, '2023-08-03 17:23:27', 3, 1),
(10, 1, 'UBER', 2, 250, 22, '2023-08-04', 'PAGO DE UBER ', '', 3, '2023-08-07 17:08:09', 44, 2),
(15, 4, 'Holiday inn', 2, 5000, 600, '2023-08-01', 'Hospedaje en el hotel por congreso', '', 3, '2023-08-08 21:09:14', 3, 5),
(16, 1, '123', 2, 123, 123, '2023-08-03', '123', '', 0, '2023-08-08 21:30:52', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `idHorarios` int(11) NOT NULL,
  `nameHorario` varchar(30) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`idHorarios`, `nameHorario`, `default`) VALUES
(1, 'Predeterminado', 1),
(3, 'Plantilla 2', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `justificantes`
--

CREATE TABLE `justificantes` (
  `idJustificantes` int(11) NOT NULL,
  `Comentario` text NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Asistencias_idAsistencias` int(11) NOT NULL,
  `status_justificante` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `justificantes`
--

INSERT INTO `justificantes` (`idJustificantes`, `Comentario`, `Empleados_idEmpleados`, `Asistencias_idAsistencias`, `status_justificante`) VALUES
(1, 'estaba tomado el centro', 3, 45, 2),
(2, 'Demasiado trafico', 20, 56, 2),
(3, 'Se me poncho la llanta del carro', 44, 68, 1),
(10, 'prueba', 3, 47, 2),
(13, 'Prueba', 3, 43, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `idNoticias` int(11) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_fin` date NOT NULL,
  `foto_noticia` int(11) NOT NULL,
  `name_foto` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idNoticias`, `Empleados_idEmpleados`, `mensaje`, `fecha_inicio`, `fecha_fin`, `foto_noticia`, `name_foto`) VALUES
(25, 3, '<p style=\"text-align: center;\">&iexcl;<strong>Feliz d&iacute;a</strong> a todos los maestros que <strong><span style=\"color: rgb(224, 62, 45);\">educan y motivan</span></strong> a sus alumnos con <em><strong>pasi&oacute;n y dedicaci&oacute;n</strong></em>!<em> Gracias por su labor tan importante y valiosa.</em></p>\n<h2 style=\"text-align: center;\"><strong>&iexcl;Que tengan un gran d&iacute;a!</strong></h2>', '2023-05-12 17:28:12', '2023-05-15', 1, '25.jpg'),
(27, 3, '<p>Bienvenidos a IN Consulting</p>', '2023-05-30 15:36:48', '2023-05-30', 1, '27.png'),
(28, 3, '<p>lkjhlkj</p>', '2023-05-12 17:39:47', '2023-05-18', 0, NULL),
(29, 3, '<h1 style=\"text-align: center;\">againg<code>321312</code></h1>', '2023-05-12 17:58:31', '2023-05-13', 1, '29.jpg'),
(30, 3, '<p>datatables</p>', '2023-06-14 17:11:49', '2023-06-21', 1, '30.png'),
(31, 6, '<h2 style=\"text-align: center;\"><span style=\"color: rgb(0, 0, 0);\">Hola compa&ntilde;eros queremos felicitar a Lic. Juan&nbsp;</span></h2>\r\n<hr>\r\n<h4 style=\"text-align: center;\">FELIZ CUMPLEA&Ntilde;OS</h4>', '2023-06-22 19:53:43', '2023-06-23', 1, '31.png'),
(43, 3, '<p>prueba</p>', '2023-06-09 21:24:49', '2023-06-10', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idPermisos` int(11) NOT NULL,
  `namePermisos` varchar(30) NOT NULL,
  `colorPermisos` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idPermisos`, `namePermisos`, `colorPermisos`) VALUES
(1, 'Home Office', '#00e1ff'),
(2, 'Enfermedad', '#a5c567'),
(3, 'AUSENCIA', '#ff8800'),
(4, 'prueba', '#bfffa3');

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
  `statusPostulante` int(11) NOT NULL DEFAULT 1,
  `fRegistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `postulantes`
--

INSERT INTO `postulantes` (`idPostulantes`, `namePostulante`, `lastnamePostulante`, `phonePostulante`, `emailPostulante`, `colorPostulante`, `Vacantes_idVacantes`, `statusPostulante`, `fRegistro`) VALUES
(17, 'os', 'ssd', '4445556667', 'osj@hhd.c', NULL, 16, 1, '2023-07-31 21:25:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `idPregunta` int(11) NOT NULL,
  `idExamen` int(11) NOT NULL,
  `tipo_pregunta` enum('opcion_multiple','escala','abierta') NOT NULL,
  `pregunta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`idPregunta`, `idExamen`, `tipo_pregunta`, `pregunta`) VALUES
(5, 6, 'opcion_multiple', '<p>segunda pregunta</p>'),
(9, 6, 'escala', '<p>Nueva</p>'),
(12, 6, 'opcion_multiple', '<p>prueba</p>'),
(14, 6, 'escala', '<p>5+5=6</p>'),
(16, 6, 'escala', '<p>asdasd</p>'),
(17, 6, 'escala', '<p>prueba</p>'),
(18, 6, 'escala', '<p>prueba 2</p>'),
(19, 6, 'abierta', '<p>Coloca tu nombre completo</p>'),
(20, 6, 'escala', '<p>Respuesta</p>'),
(21, 4, 'escala', '<p>&iquest;Te gusta tu trabajo?</p>'),
(22, 6, 'escala', '<p>Nueva pregunta</p>');

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
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`idPuesto`, `namePuesto`, `salario`, `salario_integrado`, `Empleados_idEmpleados`, `Departamentos_idDepartamentos`, `status`) VALUES
(1, 'Auxiliar de Almacen de Caja de Campo', 10000, 1200, 3, 55, 1),
(2, 'Etiquetador', 4445.22, 6985.22, 5, 50, 1),
(3, 'Director Aministrativo', 10005, 1200, 6, 45, 1),
(8, 'Jefe de Almacén de Caja de Campo', 12000, 650, 19, 49, 1),
(9, 'Etiquetador', 10000, 502, 20, 55, 1),
(10, 'Jefe de Cortes', 7000, 207.44, 21, 47, 0),
(11, 'Jefe de Reciba', 13000, 1200, 22, 46, 1),
(12, 'Director General', 50000, 1666.67, 23, 41, 1),
(13, 'Auxiliar de Almacen', 80000, 2666.67, 24, 48, 1),
(14, 'Supervisor de Inocuidad', 60000, 2000, 25, 51, 1),
(15, 'Contadora', 55000, 183333, 26, 61, 0),
(16, 'Jefe de Operador de Maquinaria', 65000, 2166.67, 27, 53, 1),
(17, 'Director Comercial', 45005, 1500, 28, 42, 1),
(18, 'Supervisor de Calidad', 40000, 1333.33, 29, 51, 1),
(19, 'Director RH', 50000, 1666.67, 30, 44, 1),
(20, 'Jefe de Almacen de Insumos', 70000, 2333.33, 31, 48, 1),
(21, 'Director de Operaciones', 9000, 214.77, 32, 43, 1),
(22, 'Auxiliar de Reciba', 9000, 217.44, 33, 49, 1),
(23, 'JEFE DE CÁMARAS FRÍAS', 10000, 207.44, 34, 52, 1),
(24, 'Jefe de Logistica', 15000, 207.44, 35, 50, 1),
(25, 'Jefe de Inocuidad y Calidad', 150000, 207.44, 36, 51, 1),
(32, 'asistente', 12000, 250, 43, 61, 1),
(33, 'Tesorero', 12000, 250, 44, 61, 1),
(34, '321', 321321, 21, 45, 46, 0),
(35, '321', 321321, 21, 46, 46, 1),
(36, 'auxiliar cocinero', 1000, 150, 47, 55, 0),
(37, 'Supervisora de Programación', 16000, 350.5, 48, 45, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `idRespuesta` int(11) NOT NULL,
  `idPregunta` int(11) NOT NULL,
  `respuesta` text NOT NULL,
  `valor` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`idRespuesta`, `idPregunta`, `respuesta`, `valor`) VALUES
(3, 5, '321', 0),
(4, 5, '654', 1),
(5, 5, '258', 0),
(8, 9, 'escala', 0),
(13, 12, 'r1', 0),
(14, 12, 'r2', 1),
(15, 12, 'r3', 0),
(16, 12, 'r4', 0),
(17, 5, '159', 0),
(22, 14, 'binario', 5),
(23, 16, 'escala', 0),
(24, 17, 'escala', 1),
(25, 18, 'escala', 3),
(26, 19, 'abierta', 0),
(27, 20, 'binario', 4),
(28, 21, 'escala', 0),
(29, 22, 'escala', 0);

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
  `comentariosReunion` text DEFAULT NULL,
  `Postulantes_idPostulantes` int(11) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reuniones`
--

INSERT INTO `reuniones` (`idReuniones`, `fechaReunion`, `pregunta1`, `pregunta2`, `pregunta3`, `pregunta4`, `comentariosReunion`, `Postulantes_idPostulantes`, `fechaCreacion`, `status`) VALUES
(9, '2023-08-15 13:00:00', NULL, NULL, NULL, NULL, NULL, 17, '2023-08-14 17:00:46', 0),
(10, '2023-08-16 14:00:00', NULL, NULL, NULL, NULL, NULL, 17, '2023-08-14 17:17:32', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_cambio_password`
--

CREATE TABLE `solicitud_cambio_password` (
  `idSolicitudPassword` int(11) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `forgot` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `status_tarea` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_envio` datetime DEFAULT NULL,
  `opinion` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`idTareas`, `nameTarea`, `descripcion`, `Empleados_idEmpleados`, `Jefe_idEmpleados`, `Vencimiento`, `status_tarea`, `fecha_envio`, `opinion`, `fecha_creacion`) VALUES
(1, 'nominas marzo', 'Genera las nominas del mes de marzo 2023', 3, 3, '2023-07-13', 2, '2023-07-04 12:46:21', '<p>Se entrego correctamente el trabajo</p>', '2023-07-01 18:12:08'),
(5, 'nomina julio', 'nominas', 20, 3, '2023-07-29', 2, NULL, '<p>No lo entrego a tiempo</p>', '2023-07-26 16:16:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea_entregas`
--

CREATE TABLE `tarea_entregas` (
  `idTarea_Entrega` int(11) NOT NULL,
  `Tareas_idTareas` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tarea_entregas`
--

INSERT INTO `tarea_entregas` (`idTarea_Entrega`, `Tareas_idTareas`, `descripcion`) VALUES
(1, 1, 'asd');

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
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_respuesta` timestamp NULL DEFAULT NULL,
  `fecha_aprobacion` timestamp NULL DEFAULT NULL,
  `respuesta` tinyint(4) DEFAULT NULL,
  `status_vacaciones` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vacaciones`
--

INSERT INTO `vacaciones` (`idVacaciones`, `Empleados_idEmpleados`, `Jefe_idEmpleados`, `fecha_inicio_vacaciones`, `fecha_fin_vacaciones`, `fecha_solicitud`, `fecha_respuesta`, `fecha_aprobacion`, `respuesta`, `status_vacaciones`) VALUES
(1, 3, 3, '2023-12-25', '2023-12-29', '2023-06-26 18:03:41', NULL, NULL, 1, 2),
(4, 44, 6, '2023-07-10', '2023-07-13', '2023-06-27 19:22:55', '2023-08-14 15:55:49', NULL, 1, 1),
(5, 47, 3, '2023-06-27', '2023-07-03', '2023-06-27 19:23:16', '2023-06-28 11:59:50', NULL, 1, 2),
(9, 3, 3, '2023-06-29', '2023-07-07', '2023-06-28 20:46:05', NULL, NULL, 2, 1),
(10, 3, 3, '2023-06-19', '2023-06-23', '2023-06-28 21:23:50', '2023-06-29 16:08:43', NULL, 1, 1),
(11, 3, 3, '2023-06-06', '2023-06-09', '2023-06-29 16:04:27', '2023-06-29 16:08:47', NULL, 2, 1),
(12, 3, 3, '2023-08-21', '2023-08-25', '2023-08-17 18:53:30', '2023-08-17 18:53:58', '2023-08-17 18:53:53', 1, 1);

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
  `status` int(11) NOT NULL DEFAULT 1,
  `color` varchar(7) NOT NULL,
  `aprobado` tinyint(1) NOT NULL DEFAULT 0,
  `Jefe_idEmpleados` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `vacantes`
--

INSERT INTO `vacantes` (`idVacantes`, `nameVacante`, `salarioVacante`, `requisitos`, `Empleados_idEmpleados`, `Empresas_idEmpresas`, `Departamentos_idDepartamentos`, `status`, `color`, `aprobado`, `Jefe_idEmpleados`) VALUES
(14, 'Prueba', 15000, '<p style=\"text-align: left;\">Prueba de generaciones<br><br>cheking</p>', 6, 6, 45, 1, '#e61efa', 0, NULL),
(15, 'Cocinero', 6500, '<p style=\"text-align: center;\">Se solicita cocinero que sea rapido y efectivo</p>\r\n<blockquote>\r\n<p style=\"text-align: left; padding-left: 40px; line-height: 1;\"><span style=\"font-size: 10pt;\">20 a&ntilde;os de experiencia (Deseable)</span></p>\r\n<p style=', 3, 6, 55, 1, '#5bd0dc', 2, 3),
(16, 'nuevo', 100, '<p>aux</p>', 3, 6, 55, 1, '#467972', 1, 3);

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
  ADD PRIMARY KEY (`idDepartamentos`);

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
-- Indices de la tabla `solicitud_cambio_password`
--
ALTER TABLE `solicitud_cambio_password`
  ADD PRIMARY KEY (`idSolicitudPassword`);

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
  ADD KEY `Departamentos_idDepartamentos` (`Departamentos_idDepartamentos`),
  ADD KEY `Empresas_idEmpresas` (`Empresas_idEmpresas`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `idAsistencias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT de la tabla `categorias_gastos`
--
ALTER TABLE `categorias_gastos`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `idContrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `creditos`
--
ALTER TABLE `creditos`
  MODIFY `idCreditos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `idDepartamentos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `dia_horario`
--
ALTER TABLE `dia_horario`
  MODIFY `idDia_Horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `divisas`
--
ALTER TABLE `divisas`
  MODIFY `idDivisa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `idDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `documentos_gastos`
--
ALTER TABLE `documentos_gastos`
  MODIFY `idDocumento_Gasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `documentos_tarea_entregas`
--
ALTER TABLE `documentos_tarea_entregas`
  MODIFY `idDocumentoTareaEntregas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `documento_postulante`
--
ALTER TABLE `documento_postulante`
  MODIFY `idDocPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `documento_tarea`
--
ALTER TABLE `documento_tarea`
  MODIFY `idDocumentoTarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `emergencia`
--
ALTER TABLE `emergencia`
  MODIFY `idEmergencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idEmpleados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `empleados_has_examenes`
--
ALTER TABLE `empleados_has_examenes`
  MODIFY `idEmpleados_has_Examenes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT de la tabla `empleados_has_permisos`
--
ALTER TABLE `empleados_has_permisos`
  MODIFY `idEm_has_Per` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `empleado_examen_respuesta`
--
ALTER TABLE `empleado_examen_respuesta`
  MODIFY `idEmpleado_Examen_Respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `empleado_mes`
--
ALTER TABLE `empleado_mes`
  MODIFY `idEmpleado_mes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `idEmpresas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `examenes`
--
ALTER TABLE `examenes`
  MODIFY `idExamen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `festivos`
--
ALTER TABLE `festivos`
  MODIFY `idFestivos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `folios_gastos`
--
ALTER TABLE `folios_gastos`
  MODIFY `idFolio_Gasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `formacion`
--
ALTER TABLE `formacion`
  MODIFY `idFormacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foto_empleado`
--
ALTER TABLE `foto_empleado`
  MODIFY `idfoto_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `idGastos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `idHorarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `justificantes`
--
ALTER TABLE `justificantes`
  MODIFY `idJustificantes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idNoticias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idPermisos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `postulantes`
--
ALTER TABLE `postulantes`
  MODIFY `idPostulantes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `idPuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `idRespuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `reuniones`
--
ALTER TABLE `reuniones`
  MODIFY `idReuniones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `solicitud_cambio_password`
--
ALTER TABLE `solicitud_cambio_password`
  MODIFY `idSolicitudPassword` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `idTareas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tarea_entregas`
--
ALTER TABLE `tarea_entregas`
  MODIFY `idTarea_Entrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  MODIFY `idVacaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `vacantes`
--
ALTER TABLE `vacantes`
  MODIFY `idVacantes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  ADD CONSTRAINT `Puesto_idDepartamento` FOREIGN KEY (`Departamentos_idDepartamentos`) REFERENCES `departamentos` (`idDepartamentos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Puesto_idEmpleados` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`idPregunta`) REFERENCES `preguntas` (`idPregunta`) ON DELETE CASCADE;

--
-- Filtros para la tabla `vacantes`
--
ALTER TABLE `vacantes`
  ADD CONSTRAINT `Vacantes_idDepartamentos` FOREIGN KEY (`Departamentos_idDepartamentos`) REFERENCES `departamentos` (`idDepartamentos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Vacantes_idEmpresas` FOREIGN KEY (`Empresas_idEmpresas`) REFERENCES `empresas` (`idEmpresas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
