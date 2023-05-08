-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2023 a las 22:09:34
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

CREATE TABLE `contratacion` (
  `idContratacion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `salario` float NOT NULL,
  `puesto` varchar(45) NOT NULL,
  `horaEntrada` varchar(5) NOT NULL,
  `horaSalida` varchar(5) NOT NULL,
  `Puestos_idPuestos` int(11) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `idDepartamentos` int(11) NOT NULL,
  `nameDepto` varchar(45) NOT NULL,
  `Empleados_idEmpleados` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`idDepartamentos`, `nameDepto`, `Empleados_idEmpleados`, `status`) VALUES
(1, 'Sistemas', 5, 1),
(4, 'Finanzas', 3, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `emergencia`
--

INSERT INTO `emergencia` (`idEmergencia`, `nameEmer`, `parentesco`, `phoneEmer`, `Empleados_idEmpleados`) VALUES
(1, 'Miguel Angel Contreras Parra', 'padre', '44326253552', 3),
(2, 'kjaksdkj', 'amigo', '6543216549', 4),
(3, '32165', 'madre', '654654654', 5),
(4, 'LUIS NATIVIDAD', 'padre', '5516080808', 6),
(7, 'Emergencia', 'hermano', '7894567894', 10);

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
  `fecha_contratado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idEmpleados`, `name`, `lastname`, `genero`, `fNac`, `phone`, `email`, `identificacion`, `CURP`, `NSS`, `RFC`, `street`, `numE`, `numI`, `colonia`, `CP`, `municipio`, `estado`, `status`, `fecha_contratado`) VALUES
(3, 'Oscar', 'Contreras Flota', '1', '1991-12-19', '4435398291', 'oscarcontrerasf91@gmail.com', 'asdasd522', '', '5542625222515', 'Cofo911219925', 'Palomas', '149', '', 'La hacienda', '58330', 'morelia', 'Michoacán', 1, '2015-12-14 06:00:00'),
(4, 'Prueba', 'Prueba', '0', '1996-05-12', '4465985656', 'kjasd@asd.com', '654654987987', '', '645654654987', 'asjj1226626622', 'prueba', '25', 'sakjd', 'lkjsad', '51445', 'morelia', 'michoacán', 0, '2020-04-15 06:00:00'),
(5, 'Oscar', 'Contrerah', '1', '1995-04-06', '3213216565', '3213@asda.c', '3asd354', '', '64641323156', '65465sdasd65', 'alsjkh', '654', '1', '32132', '32132', 'sasd', 'asdad', 1, '2023-04-17 06:00:00'),
(6, 'ERICK', 'NATIVIDAD', '1', '1993-04-16', '4433900175', 'ericknatividad93@hotmail.com', '8', '', '53029875477', 'NABE9304168D3', 'FACULTAD DE PSICOLOGIA', '45', '', 'REAL UNIVERSIDAD', '58088', 'MORELIA', 'MICHOACAN', 1, '2023-04-25 06:00:00'),
(10, 'Prueba', 'Prueba', '0', '2023-05-17', '4425362514', 'prueba@gmail.com', '44555855685', 'PRUE25252MNNLS54', '1234567899875', 'PRUE25252', 'PRUEBA', '5', '1', 'ASD', '321654', 'Morelia', 'Michoacán', 1, '2023-05-08 20:04:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE `evaluaciones` (
  `idEvaluaciones` int(11) NOT NULL,
  `nombreEvaluacion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones_has_empleados`
--

CREATE TABLE `evaluaciones_has_empleados` (
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Evaluaciones_idEvaluaciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(2, 'Oscar Contreras Flota.jpg', 3, '2023-04-25 06:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_laboral`
--

CREATE TABLE `historial_laboral` (
  `idHistorial_laboral` int(11) NOT NULL,
  `empresa` text NOT NULL,
  `puesto` text NOT NULL,
  `noResponder` int(11) NOT NULL DEFAULT 0,
  `salario` float DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `trabajo_actual` int(11) NOT NULL DEFAULT 0,
  `fecha_fin` date DEFAULT NULL,
  `motivos` varchar(255) DEFAULT NULL,
  `logros` text DEFAULT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `historial_laboral`
--

INSERT INTO `historial_laboral` (`idHistorial_laboral`, `empresa`, `puesto`, `noResponder`, `salario`, `fecha_inicio`, `trabajo_actual`, `fecha_fin`, `motivos`, `logros`, `Empleados_idEmpleados`) VALUES
(1, 'CCM', 'Administrador de sistemas', 0, 8000, '2018-11-12', 1, NULL, NULL, NULL, 3),
(2, 'Instituto Gestalt Moreli', 'Administrador de plataforma', 1, NULL, '2021-01-04', 0, '2022-06-15', 'Termino de contrato', 'Aprendizaje', 3),
(3, 'prueba', 'laksjd', 0, NULL, '1994-05-15', 1, NULL, NULL, 'ninguno', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organigrama`
--

CREATE TABLE `organigrama` (
  `idOrganigrama` int(11) NOT NULL,
  `jefe` int(11) NOT NULL,
  `empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`idPuesto`, `namePuesto`, `salario`, `salario_integrado`, `Empleados_idEmpleados`, `Departamentos_idDepartamentos`, `horario_entrada`, `horario_salida`, `status`) VALUES
(1, 'Ingeniero en Sistemas', 10500, 1200, 3, 4, '05:00:00', '16:30:00', 1),
(2, 'Multimedia', 4445.22, 6985.22, 5, 4, '08:00:00', '18:00:00', 1),
(3, 'Sistemas', 10000, 1200, 6, 1, '08:00:00', '16:30:00', 1),
(7, 'Contador', 11500, 2000, 10, 1, '07:59:00', '17:59:00', 1);

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
(1, '2023-01-01 00:00:00', 1, 2, 3, 1, 'Prueba', 14, '2023-05-04 21:41:29', 1),
(2, '2023-01-01 00:00:00', 1, 1, 1, 1, '', 13, '2023-05-04 21:41:31', 1),
(3, '2023-01-01 00:00:00', NULL, NULL, NULL, NULL, NULL, 14, '2023-05-04 21:41:32', 0),
(4, '2023-01-01 00:00:00', NULL, NULL, NULL, NULL, NULL, 14, '2023-05-04 21:41:34', 0),
(5, '2023-01-01 00:00:00', 2, 2, 3, 2, 'puede ser', 13, '2023-05-04 21:41:49', 1),
(6, '2023-05-10 06:00:00', NULL, NULL, NULL, NULL, NULL, 13, '2023-05-05 21:18:39', 0),
(7, '2023-05-17 12:00:00', NULL, NULL, NULL, NULL, NULL, 15, '2023-05-05 22:05:38', 0);

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
  `status` int(11) NOT NULL DEFAULT 1,
  `color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `vacantes`
--

INSERT INTO `vacantes` (`idVacantes`, `nameVacante`, `salarioVacante`, `requisitos`, `Empleados_idEmpleados`, `Departamentos_idDepartamentos`, `status`, `color`) VALUES
(1, 'Contador', 10500, 'Contador Publico', 0, 1, 0, '#5969ff'),
(2, 'Diseñador Grafico', 9200, 'Diseñador grafico que sepa manejar, paqueteria de adobe', 0, 1, 1, '#c2c8ff'),
(3, 'Auxiliar Contable', 9200, 'Auxiliar contable con conocimientos en Compac', NULL, 1, 1, '#8fb7ba'),
(4, 'Licenciado en econimia', 15000, 'Licenciado egresado\r\nCon cedula\r\n2 años de experiencia en el área de analista de datos', NULL, 4, 1, '#f9227a');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contratacion`
--
ALTER TABLE `contratacion`
  ADD PRIMARY KEY (`idContratacion`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`idDepartamentos`),
  ADD KEY `Empleados_idEmpleados` (`Empleados_idEmpleados`);

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
-- Indices de la tabla `historial_laboral`
--
ALTER TABLE `historial_laboral`
  ADD PRIMARY KEY (`idHistorial_laboral`);

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
-- Indices de la tabla `vacantes`
--
ALTER TABLE `vacantes`
  ADD PRIMARY KEY (`idVacantes`),
  ADD KEY `Departamentos_idDepartamentos` (`Departamentos_idDepartamentos`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contratacion`
--
ALTER TABLE `contratacion`
  MODIFY `idContratacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `idDepartamentos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `idEmergencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idEmpleados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- AUTO_INCREMENT de la tabla `historial_laboral`
--
ALTER TABLE `historial_laboral`
  MODIFY `idHistorial_laboral` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `idPuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `reuniones`
--
ALTER TABLE `reuniones`
  MODIFY `idReuniones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `vacantes`
--
ALTER TABLE `vacantes`
  MODIFY `idVacantes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
