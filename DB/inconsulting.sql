-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 31-05-2023 a las 09:08:43
-- Versión del servidor: 5.6.51-cll-lve
-- Versión de PHP: 7.4.30

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
(50, 'JEFE DE LOGISTICA', 27, 6, 43, 1),
(51, 'JEFE DE INOCUIDAD Y CALIDAD', 36, 6, 43, 1),
(52, 'JEFE DE CÁMARAS FRÍAS', 34, 6, 43, 1),
(53, 'JEFE OPERADOR DE MAQUINA', 27, 6, 43, 1),
(54, 'AUXILIAR RH', NULL, 6, 44, 1),
(55, 'JEFE DE COCINA', NULL, 6, 44, 1),
(56, 'RECEPCION', NULL, 6, 44, 1),
(57, 'VIGILANCIA', NULL, 6, 44, 1),
(58, 'MENSAJERÍA Y MANTENIMIENTO', NULL, 6, 44, 1),
(59, 'CONTABILIDAD', NULL, 6, 45, 1),
(60, 'FINANZAS', NULL, 6, 45, 1),
(61, 'TESORERÍA', NULL, 6, 45, 1);

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
(1, 1, 1, '09:00:00', '18:00:00', 9),
(2, 1, 2, '09:00:00', '18:00:00', 9),
(3, 1, 3, '09:00:00', '18:00:00', 9),
(4, 1, 4, '09:00:00', '18:00:00', 9),
(5, 1, 5, '09:00:00', '18:00:00', 9),
(6, 2, 1, '08:00:00', '17:00:00', 9),
(7, 2, 2, '08:00:00', '17:00:00', 9),
(8, 2, 3, '08:00:00', '17:00:00', 9),
(9, 2, 4, '08:00:00', '17:00:00', 9),
(10, 2, 5, '08:00:00', '17:00:00', 9),
(11, 2, 6, '08:00:00', '17:00:00', 9);

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
(16, 'curriculum', 10, '2023-05-08 20:04:49');

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

--
-- Volcado de datos para la tabla `documento_postulante`
--

INSERT INTO `documento_postulante` (`idDocPost`, `nameDocPost`, `Postulantes_idPostulantes`, `fechaCreacion`) VALUES
(3, 'curriculum', 13, '2023-05-03 17:51:56'),
(4, 'curriculum', 14, '2023-05-04 17:54:45'),
(5, 'curriculum', 15, '2023-05-05 22:05:21');

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
(33, 'MIRYANA LOPEZ', 'hermano', '4521654147', 36);

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
  `fecha_contratado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_baja` date DEFAULT NULL,
  `cambio_password` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idEmpleados`, `name`, `lastname`, `genero`, `fNac`, `phone`, `email`, `password`, `identificacion`, `CURP`, `NSS`, `RFC`, `street`, `numE`, `numI`, `colonia`, `CP`, `municipio`, `estado`, `status`, `fecha_contratado`, `fecha_baja`, `cambio_password`) VALUES
(3, 'Oscar', 'Contreras', '1', '1991-12-19', '4435398291', 'oscarcontrerasf91@gmail.com', '$2a$07$asxx54ahjppf45sd87a5aubbQpcQrXYn9ZKDUEfe01oXXasks7XAG', '554025566656', 'COFO911219HMNNLS06', '654321965432', 'COFO911219925', 'Palomas', '149', '', 'La hacienda', '58330', 'morelia', 'Michoacán', 1, '2015-12-14 06:00:00', NULL, 1),
(5, 'Rafael', 'Flota Sanchez', '1', '1995-05-30', '3213216565', 'rafa@gmail.com', '', '3ASD354', 'CASD321533654DASD22', '64641323156', '65465sdasd65', 'alsjkh', '654', '1', '32132', '32132', 'sasd', 'asdad', 1, '2023-04-17 06:00:00', NULL, 0),
(6, 'ERICK', 'NATIVIDAD', '1', '1993-05-16', '4433900175', 'ericknatividad93@hotmail.com', '$2a$07$asxx54ahjppf45sd87a5au3jMxNjqSyn3ov6ZS7NtPJvp5DE/f/.C', '8', 'CASD321533654DASD22', '53029875477', 'NABE9304168D3', 'FACULTAD DE PSICOLOGIA', '45', '', 'REAL UNIVERSIDAD', '58088', 'MORELIA', 'MICHOACAN', 1, '2023-04-25 06:00:00', NULL, 1),
(10, 'Prueba', 'Prueba', '0', '2023-05-17', '4425362514', 'prueba@gmail.com', '', '44555855685', 'PRUE25252MNNLS54', '1234567899875', 'PRUE25252', 'PRUEBA', '5', '1', 'ASD', '321654', 'Morelia', 'Michoacán', 0, '2023-05-08 20:04:49', NULL, 0),
(19, 'Mayel', 'Ortega Cambron', '0', '1998-07-23', '5526553212', 'mayel_ortega@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFoxjRU8oL9T7K8WJPF8iklsi8G3kHCe', '456789789456', 'ORCM321654987654', '3216541651', 'ORCM32165331', 'Rey Moctezuma', '64', '', 'Mil cumbres', '58290', 'Morelia', 'Michoacán', 1, '2023-05-15 21:27:52', NULL, 0),
(20, 'Yoan Adan', 'Leon', '1', '1960-01-01', '4430000001', 'presidente@presi.com', '$2a$07$asxx54ahjppf45sd87a5au09Xobz.kcMYEWZUX7DpLSM2UYd4GUHq', '100000001', 'gepr600101hmnnlq50', '1000000002', 'gepr600101252', 'Loma dorada', '01', '', 'Las lomas', '53001', 'Morelia', 'Michoacán', 1, '2023-05-17 17:49:50', NULL, 0),
(21, 'ARMANDO', 'ARCHUNDIA GONZALEZ', '1', '1991-05-11', '4433900175', 'armando.archundia@asdasd.com', '$2a$07$asxx54ahjppf45sd87a5aurddAI2BXhiv9mPV1Ckqwr5MLxhkjq9y', '7253762', 'GOAA910511HMNTCR07', '93725481921', 'GOAA910511HMNTC', 'OLIMPIADA', '34', '', 'UNIVERSIDAD', '89990', 'MORELIA', 'MICHOACAN', 1, '2023-05-17 18:49:48', NULL, 0),
(22, 'Gustavo', 'Arreola', '1', '1984-05-25', '4465986587', 'gus@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auuULuOA7.yjgcURqGzZXUeaY.w1/n3.i', '321654321654', 'ARGU840525hmnfd05', '32132165498', 'argu840525', 'asd', '321', '', '32', '58260', 'Morelia', 'Michoacán', 1, '2023-05-18 22:00:16', NULL, 0),
(23, 'Juan', 'Pérez', '1', '1985-05-15', '5551234567', 'juan.perez@example.com', '$2a$07$asxx54ahjppf45sd87a5auzIU8S1tuTaikH9DUOSX2LY0tkhc7RK2', '1234567890', 'PERJ850512HDFXXX01', '9876543210', 'PERJ850512XXX', 'Calle Principal', '123', '1A', 'Centro', '12345', 'Ciudad de México', 'CDMX', 1, '2023-05-19 18:18:59', NULL, 0),
(24, 'María', 'López', '0', '1990-09-28', '5559876543', 'maria.lopez@example.com', '$2a$07$asxx54ahjppf45sd87a5autRLTQuEDFjtDghTEl2HCO.NFslgg7Tu', '0987654321', 'LOPM900928MDFXXX02', '1234567890', 'LOPM900928XXX', 'Avenida Juárez', '456', '2B', 'Reforma', '54321', 'Ciudad de México', 'CDMX', 1, '2023-05-19 18:21:59', '2023-05-24', 0),
(25, 'Roberto', 'García', '1', '1982-11-02', '5555555555', 'roberto.garcia@example.com', '$2a$07$asxx54ahjppf45sd87a5aujd4UPYbNfEZcue0P6yyIPgFYafH1fea', '1357924680', 'GARR821102MDFXXX03', '9876543210', 'GARR821102XXX', 'GARR821102XXX', '789', '3C', 'Del Valle', '67890', 'Ciudad de México', 'CDMX', 1, '2023-05-19 18:55:58', NULL, 0),
(26, 'Laura', 'Rodríguez', '0', '1995-03-15', '5552223333', 'laura.rodriguez@example.com', '$2a$07$asxx54ahjppf45sd87a5aunPLtscj8Bj2VjY3Dod1v5EHrVjGV2vG', '8642097531', 'RODL950315MDFXXX04', '1234567890', 'RODL950315XXX', 'Avenida Reforma', '321', '4D', 'Polanco', '45678', 'Ciudad de México', 'CDMX', 0, '2023-05-19 18:57:04', '2023-05-18', 0),
(27, 'Andrés', 'Hernández', '1', '1988-08-20', '5553332222', 'andres.hernandez@example.com', '$2a$07$asxx54ahjppf45sd87a5auRti6saKEkyuQmdvUYFTh6h0huW4haHu', '9753108642', 'HERA880720MDFXXX05', '9876543210', 'HERA880720XXX', 'Calle de la Luna', '654', '5E', 'Condes', '59789', 'Ciudad de méxico', 'CDMX', 1, '2023-05-19 18:59:08', NULL, 0),
(28, 'Ana', 'Martínez', '0', '1992-12-10', '5558889999', 'ana.martinez@example.com', '$2a$07$asxx54ahjppf45sd87a5auX9vEJcqQWeK8sk/j9eWWzclmoCXBfM6', '8642097531', 'MART921210MDFXXX06', '1234567890', 'MART921210XXX', 'Avenida Insurgentes', '987', '6F', 'Roma', '45678', 'Ciudad de méxico', 'CDMX', 1, '2023-05-19 19:00:16', NULL, 0),
(29, 'Ricardo', 'Vargas', '1', '1980-08-05', '5556667777', 'ricardo.vargas@example.com', '$2a$07$asxx54ahjppf45sd87a5auMUDk16Ed3i64oCHjw4GAZHe/3sB2Ww.', '9876543210', 'VARR800805MDFXXX07', '9876543210', 'VARR800805XXX', ' Calle de los Pinos', '321', '7G', 'Del bosque', '56789', 'Ciudad de móxico', 'CDMX', 1, '2023-05-19 19:01:23', NULL, 0),
(30, 'Carolina', 'Sánchez', '0', '1993-09-25', '5557778888', 'carolina.sanchez@example.com', '$2a$07$asxx54ahjppf45sd87a5au/wc8C7a69DzqmuOV5qViEl83KeRyWTW', '9753108642', 'SANC930925MDFXXX08', '1234567890', 'SANC930925XXX', 'Avenida Morelos', '654', '8H', 'Tlalpan', '45678', 'Ciudad de México', 'CDMX', 1, '2023-05-19 19:08:25', NULL, 0),
(31, 'Gabriela', 'Ramírez', '0', '1991-04-02', '4569028625', 'gabriela.ramirez@example.com', '$2a$07$asxx54ahjppf45sd87a5auL3BOJdw5UlTjafqj16lFITe.7zA0hUa', '8642097531', 'RAMG910402MDFXXX10', '1234567890', 'RAMG910402XXX', 'Avenida Hidalgo', '321', '10J', 'Cuauhtémoc', '45678', 'Ciudad de México', 'CDMX', 1, '2023-05-19 19:38:47', NULL, 0),
(32, 'LUIS ', 'PEREZ CORONADO', '1', '1980-03-21', '4521654147', 'LUISPALEO@hotmail.com', '$2a$07$asxx54ahjppf45sd87a5auRMnmjBx9AnWTWsMCgZjzMGf05185z9y', '183639494', 'PAZL900321HMNTCR07', '725439009761', 'PAZL900321JCA', 'DOMICILIO CONOCIDO', '1222', '12', 'JUANA PAVON', '60490', 'MORELIA', 'Michoacan', 1, '2023-05-24 21:43:38', NULL, 0),
(33, 'JOSE', 'CARRILLO', '1', '1987-09-18', '4521679799', 'JOSECARRILLO@GMAIL.COM', '$2a$07$asxx54ahjppf45sd87a5auMejtr5RryVTdsj9ADRi8siKCbPtSbkG', '173532618251', 'CALP730912HMNTCR07', '72653736272', 'CALP730908LC0', 'EDUCACION ESQUINA MATAMOROS', 'SN', '12', 'REAL UNIVERSIDAD', '60490', 'MORELIA', 'Michoacan', 1, '2023-05-24 21:47:10', NULL, 0),
(34, 'RAUL', 'MOLINA', '1', '1993-09-07', '4521654147', 'gumor@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auuw4GnAVLVXyEv.uAxdYPcOz79VHrdGG', 'W727373U', 'VEME790916MMNNRR07', '22222233', 'MPR14091822A', 'HERMANOS FLORES MAGON', '1584', '', 'JUANA PAVON', '60180', 'MORELIA', 'Michoacan', 1, '2023-05-24 22:30:26', NULL, 0),
(35, 'DAVID', 'BECERRA ALCAZAR', '1', '1995-03-06', '4400998866', 'contabilidadgdl@inconsultingmexico.com', '$2a$07$asxx54ahjppf45sd87a5auAE9lF7pz/rTfj4HYna.BEJ2O86mBkdq', '10', 'BEAD950306HMNTCR07', '8763519036', 'BEAD950306765', 'PASEO LAZARO CARDENAS', '45', '', 'LA SOLEDAD', '60180', 'MORELIA', 'MICHOACAN', 1, '2023-05-30 21:18:25', NULL, 0),
(36, 'JORGE', 'MEDINA', '1', '1989-07-25', '4521654147', 'jorgemedina@example.com', '$2a$07$asxx54ahjppf45sd87a5auHzjdMXdXdTVcWPVWk5D7KG.Fa/4l22.', '92726267', 'MEAJ890725HMNTVR07', '729374516199', 'MEAJ890725TU8', 'DOMICILIO CONOCIDO', 'SN', '12', 'FUENTES DE MORELIA', '60490', 'MORELIA', 'MICHOACAN', 1, '2023-05-30 21:25:48', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_has_horarios`
--

CREATE TABLE `empleados_has_horarios` (
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Horarios_idHorarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 34, '<p style=\"text-align: center;\">Excelente Trabajo</p>', 3, '2023-05-30 16:22:55');

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
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE `evaluaciones` (
  `idEvaluaciones` int(11) NOT NULL,
  `nombreEvaluacion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones_has_empleados`
--

CREATE TABLE `evaluaciones_has_empleados` (
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Evaluaciones_idEvaluaciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(2, 'Oscar Contreras Flota.jpg', 3, '2023-04-25 06:00:00');

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
(1, 'Predeterminado', 0),
(2, 'horario 1', 1);

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
(31, 6, '<p><span style=\"color: rgb(0, 0, 0);\">Hola compa&ntilde;eros queremos felicitar a Lic. Juan&nbsp;</span><br><br><strong>FELIZ CUMPLEA&Ntilde;OS</strong></p>', '2023-05-17 23:49:49', '2023-05-19', 1, '31.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organigrama`
--

CREATE TABLE `organigrama` (
  `idOrganigrama` int(11) NOT NULL,
  `jefe` int(11) NOT NULL,
  `empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

--
-- Volcado de datos para la tabla `postulantes`
--

INSERT INTO `postulantes` (`idPostulantes`, `namePostulante`, `lastnamePostulante`, `phonePostulante`, `emailPostulante`, `colorPostulante`, `Vacantes_idVacantes`, `statusPostulante`, `fRegistro`) VALUES
(13, 'Mayel', 'Ortega Cambrón', '4434655955', 'mayelortega07@gmail.com', '2', 1, 1, '2023-05-03 17:51:56'),
(14, 'Prueba', 'Prueba', '4425362514', 'prueba@gmail.com', '1', 1, 1, '2023-05-04 17:54:45'),
(15, 'Oscar', 'Contreras', '4435398291', 'ocontreras@gmail.com', NULL, 3, 1, '2023-05-05 22:05:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntasevaluacion`
--

CREATE TABLE `preguntasevaluacion` (
  `idPreguntasEvaluacion` int(11) NOT NULL,
  `pregunta` varchar(255) NOT NULL,
  `Evaluaciones_idEvaluaciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `horario_entrada` time NOT NULL DEFAULT '09:00:00',
  `horario_salida` time NOT NULL DEFAULT '18:00:00',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`idPuesto`, `namePuesto`, `salario`, `salario_integrado`, `Empleados_idEmpleados`, `Departamentos_idDepartamentos`, `horario_entrada`, `horario_salida`, `status`) VALUES
(1, 'Auxiliar de Almacen de Caja de Campo', 10000, 1200, 3, 49, '05:00:00', '16:30:00', 1),
(2, 'Etiquetador', 4445.22, 6985.22, 5, 50, '08:00:00', '18:00:00', 1),
(3, 'Director Aministrativo', 10005, 1200, 6, 45, '08:00:00', '16:30:00', 1),
(8, 'Jefe de Almacén de Caja de Campo', 12000, 650, 19, 49, '09:00:00', '18:00:00', 1),
(9, 'Etiquetador', 10000000, 50000, 20, 50, '13:00:00', '18:00:00', 1),
(10, 'Jefe de Cortes', 7000, 207.44, 21, 47, '09:00:00', '18:00:00', 1),
(11, 'Jefe de Reciba', 13000, 1200, 22, 46, '15:00:00', '21:00:00', 1),
(12, 'Director General', 50000, 1666.67, 23, 41, '09:00:00', '18:00:00', 1),
(13, 'Auxiliar de Almacen', 80000, 2666.67, 24, 48, '08:30:00', '17:30:00', 1),
(14, 'Supervisor de Inocuidad', 60000, 2000, 25, 51, '09:00:00', '18:00:00', 1),
(15, 'Contadora', 55000, 183333, 26, 28, '08:33:00', '17:30:00', 0),
(16, 'Jefe de Operador de Maquinaria', 65000, 2166.67, 27, 53, '09:00:00', '18:00:00', 1),
(17, 'Director Comercial', 45000, 1500, 28, 42, '08:30:00', '17:30:00', 1),
(18, 'Supervisor de Calidad', 40000, 1333.33, 29, 51, '09:00:00', '18:00:00', 1),
(19, 'Director RH', 50000, 1666.67, 30, 44, '08:30:00', '17:30:00', 1),
(20, 'Jefe de Almacen de Insumos', 70000, 2333.33, 31, 48, '08:30:00', '17:30:00', 1),
(21, 'Director de Operaciones', 9000, 214.77, 32, 43, '08:00:00', '18:00:00', 1),
(22, 'Auxiliar de Reciba', 9000, 217.44, 33, 46, '09:00:00', '06:00:00', 1),
(23, 'JEFE DE CÁMARAS FRÍAS', 10000, 207.44, 34, 52, '09:00:00', '06:00:00', 1),
(24, 'Jefe de Logistica', 15000, 207.44, 35, 50, '09:00:00', '18:00:00', 1),
(25, 'Jefe de Inocuidad y Calidad', 150000, 207.44, 36, 51, '09:00:00', '18:00:00', 1);

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

--
-- Volcado de datos para la tabla `reuniones`
--

INSERT INTO `reuniones` (`idReuniones`, `fechaReunion`, `pregunta1`, `pregunta2`, `pregunta3`, `pregunta4`, `comentariosReunion`, `Postulantes_idPostulantes`, `fechaCreacion`, `status`) VALUES
(1, '2023-01-01 00:00:00', 1, 2, 3, 1, 'Prueba', 14, '2023-05-04 21:41:29', 1),
(2, '2023-01-01 00:00:00', 1, 1, 1, 1, '', 13, '2023-05-04 21:41:31', 1),
(3, '2023-01-01 00:00:00', NULL, NULL, NULL, NULL, NULL, 14, '2023-05-04 21:41:32', 0),
(4, '2023-01-01 00:00:00', NULL, NULL, NULL, NULL, NULL, 14, '2023-05-04 21:41:34', 0),
(5, '2023-01-01 00:00:00', 2, 2, 3, 2, 'puede ser', 13, '2023-05-04 21:41:49', 1),
(6, '2023-05-10 06:00:00', NULL, NULL, NULL, NULL, NULL, 13, '2023-05-05 21:18:39', 0),
(7, '2023-05-17 12:00:00', NULL, NULL, NULL, NULL, NULL, 15, '2023-05-05 22:05:38', 0);

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
-- Estructura de tabla para la tabla `vacantes`
--

CREATE TABLE `vacantes` (
  `idVacantes` int(11) NOT NULL,
  `nameVacante` varchar(45) NOT NULL,
  `salarioVacante` float NOT NULL,
  `requisitos` varchar(255) NOT NULL,
  `Empleados_idEmpleados` int(11) DEFAULT NULL,
  `Departamentos_idDepartamentos` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vacantes`
--

INSERT INTO `vacantes` (`idVacantes`, `nameVacante`, `salarioVacante`, `requisitos`, `Empleados_idEmpleados`, `Departamentos_idDepartamentos`, `status`, `color`) VALUES
(1, 'Contador', 10500, 'Contador Publico', 0, 1, 0, '#5969ff'),
(2, 'Diseñador Grafico', 9200, 'Diseñador grafico que sepa manejar, paqueteria de adobe', 0, 1, 1, '#c2c8ff'),
(3, 'Auxiliar Contable', 9200, 'Auxiliar contable con conocimientos en Compac', NULL, 1, 1, '#8fb7ba'),
(4, 'Licenciado en econimia', 15000, 'Licenciado egresado\r\nCon cedula\r\n2 años de experiencia en el área de analista de datos', NULL, 4, 1, '#f9227a'),
(5, 'Contador', 11550, 'Se requiere de un Contadora Capacitado para el puesto', NULL, 1, 1, '#ad6265'),
(6, 'AUXILIAR CONTABLE', 10000, 'SER RESPONSABLES\r\n\r\n\r\n\r\n\r\n', NULL, 28, 1, '#d3503f'),
(10, 'oferta', 10000, 'asdasd', NULL, 42, 0, '#1ecf8b');

--
-- Índices para tablas volcadas
--

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
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`idDocumento`),
  ADD KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`);

--
-- Indices de la tabla `documento_postulante`
--
ALTER TABLE `documento_postulante`
  ADD PRIMARY KEY (`idDocPost`),
  ADD KEY `Postulantes_idPostulantes` (`Postulantes_idPostulantes`);

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
-- Indices de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD PRIMARY KEY (`idEvaluaciones`);

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
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`idHorarios`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idNoticias`);

--
-- Indices de la tabla `organigrama`
--
ALTER TABLE `organigrama`
  ADD PRIMARY KEY (`idOrganigrama`);

--
-- Indices de la tabla `postulantes`
--
ALTER TABLE `postulantes`
  ADD PRIMARY KEY (`idPostulantes`),
  ADD KEY `Vacantes_idVacantes` (`Vacantes_idVacantes`);

--
-- Indices de la tabla `preguntasevaluacion`
--
ALTER TABLE `preguntasevaluacion`
  ADD PRIMARY KEY (`idPreguntasEvaluacion`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`idPuesto`),
  ADD KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`),
  ADD KEY `Departamentos_idDepartamentos` (`Departamentos_idDepartamentos`);

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
-- Indices de la tabla `vacantes`
--
ALTER TABLE `vacantes`
  ADD PRIMARY KEY (`idVacantes`),
  ADD KEY `Departamentos_idDepartamentos` (`Departamentos_idDepartamentos`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `idDepartamentos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `dia_horario`
--
ALTER TABLE `dia_horario`
  MODIFY `idDia_Horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `idDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `documento_postulante`
--
ALTER TABLE `documento_postulante`
  MODIFY `idDocPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `emergencia`
--
ALTER TABLE `emergencia`
  MODIFY `idEmergencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idEmpleados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `empleado_mes`
--
ALTER TABLE `empleado_mes`
  MODIFY `idEmpleado_mes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `idEmpresas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  MODIFY `idEvaluaciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formacion`
--
ALTER TABLE `formacion`
  MODIFY `idFormacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foto_empleado`
--
ALTER TABLE `foto_empleado`
  MODIFY `idfoto_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `idHorarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idNoticias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `organigrama`
--
ALTER TABLE `organigrama`
  MODIFY `idOrganigrama` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `postulantes`
--
ALTER TABLE `postulantes`
  MODIFY `idPostulantes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `preguntasevaluacion`
--
ALTER TABLE `preguntasevaluacion`
  MODIFY `idPreguntasEvaluacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `idPuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `reuniones`
--
ALTER TABLE `reuniones`
  MODIFY `idReuniones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `solicitud_cambio_password`
--
ALTER TABLE `solicitud_cambio_password`
  MODIFY `idSolicitudPassword` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `vacantes`
--
ALTER TABLE `vacantes`
  MODIFY `idVacantes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
