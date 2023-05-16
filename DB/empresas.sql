-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2023 a las 22:01:33
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
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `idEmpresas` int(11) NOT NULL,
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
  `fecha_registro_empresa` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`idEmpresas`, `registro_patronal`, `rfc`, `nombre_razon_social`, `actividad_economica`, `calle`, `numero`, `numero_interior`, `colonia`, `cp`, `entidad`, `poblacion_municipio`, `telefono`, `convenio_reembolso`, `delegacion_imss`, `subdelegacion`, `clave_subdelegacion`, `mes_inicio_afiliacion`, `anio_inicio_afiliacion`, `fecha_registro_empresa`) VALUES
(3, 'C86-18977-10-1', 'PRO191220DX5', 'Proteba S.A.P.I. de C.V.', 'servicios de protección y custodia', 'francisco i madero', '104', '4', 'centro', '58300', 'MCH', 'Morelia', '3524711282', 0, 'MCH', 'Zamora', '1713', 'Abril', 2020, '2023-05-16 19:32:03');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`idEmpresas`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `idEmpresas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
