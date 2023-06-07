--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `idAsistencias` int(11) NOT NULL,
  `entrada` time NOT NULL,
  `salida` time NOT NULL,
  `fecha_asistencia` date NOT NULL,
  `entrada_descanso` time NOT NULL,
  `salida_descanso` time NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL
);
--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `dia_horario` (
  `idDia_Horario` int(11) NOT NULL,
  `Horarios_idHorarios` int(11) NOT NULL,
  `dia_Laborable` int(1) NOT NULL,
  `hora_Entrada` time NOT NULL,
  `hora_Salida` time DEFAULT NULL,
  `numero_Horas` float NOT NULL
);

--
-- Estructura de tabla para la tabla `documento`
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
  `fecha_contratado` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_baja` date DEFAULT NULL,
  `cambio_password` int(11) NOT NULL DEFAULT 0
);

--
-- Estructura de tabla para la tabla `empleados_has_horarios`
--

CREATE TABLE `empleados_has_horarios` (
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Horarios_idHorarios` int(11) NOT NULL
);

--
-- Estructura de tabla para la tabla `empleados_has_permisos`
--

CREATE TABLE `empleados_has_permisos` (
  `idEm_has_Per` int(11) NOT NULL,
  `fechaPermiso` date NOT NULL,
  `statusPermiso` tinyint(1) DEFAULT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Permisos_idPermisos` int(11) NOT NULL
);

--
-- Estructura de tabla para la tabla `empleado_mes`
--

CREATE TABLE `festivos` (
  `idFestivos` int(11) NOT NULL,
  `nameFestivo` varchar(30) NOT NULL,
  `fechaFestivo` date NOT NULL,
  `fechaFin` date DEFAULT NULL
);

--
-- Estructura de tabla para la tabla `formacion`
--

CREATE TABLE `horarios` (
  `idHorarios` int(11) NOT NULL,
  `nameHorario` varchar(30) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT 0
);

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `permisos` (
  `idPermisos` int(11) NOT NULL,
  `namePermisos` varchar(30) NOT NULL,
  `colorPermisos` varchar(10) NOT NULL
);