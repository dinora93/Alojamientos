-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-09-2025 a las 06:43:07
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbappalojamientos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alojamientos`
--

CREATE TABLE `alojamientos` (
  `idalojamientos` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alojamientos`
--

INSERT INTO `alojamientos` (`idalojamientos`, `titulo`, `descripcion`, `img`, `departamento`, `direccion`, `precio`, `idusuario`) VALUES
(1, 'Alquiler de casa de campo', 'Alojamiento de rancho en la montaña mas alta del municipio de cabañas', 'campo.jpg', 'Cabañas', 'Cabañas', 300.00, NULL),
(2, 'Casa fuera de la ciudad', 'Casa de campo, confortable, ideal para desconectarse con la vida', 'images.jpg', 'San Salvador', 'San Salvador', 250.00, NULL),
(3, 'Casa privada en el centro', 'Casa en el centro, disponible para habitar', 'images (1).jpg', 'San Miguel', 'San Miguel centro', 200.00, NULL),
(4, 'Casa en residencial villa', 'Casa en alquiler para viaje', 'images (2).jpg', 'San Miguel', 'San Miguel centro', 500.00, NULL),
(5, 'Casa en residencial', 'Casa privada para fiestas.', 'images (3).jpg', 'San Miguel', 'San Miguel', 1000.00, NULL),
(6, 'Casa de campo', 'Casa de campo en las montañas ', 'images (4).jpg', 'San Salvador', 'San Salvador', 300.00, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentaalojamiento`
--

CREATE TABLE `cuentaalojamiento` (
  `idregistro` int(11) NOT NULL,
  `idalojamiento` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuentaalojamiento`
--

INSERT INTO `cuentaalojamiento` (`idregistro`, `idalojamiento`, `idusuario`, `fecha_registro`) VALUES
(1, 1, 7, '2025-09-27'),
(2, 2, 7, '2025-09-27'),
(5, 2, 6, '2025-09-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'SuperAdministrador'),
(2, 'comun');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `pwd` varchar(200) DEFAULT NULL,
  `idrol` int(11) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `correo`, `pwd`, `idrol`, `fecha_registro`) VALUES
(1, 'Dinora Elizabeth Sanchez', 'dinora@gmail.com', '$2y$10$2VoWxDKej1MmpluWU6CNpeKw5PK4T8o.zci66km53uQJBs5eN3nri', 1, '2025-09-26'),
(6, 'Irene Longoria', 'irene@gmail.com', '$2y$10$G1V6359n/rHB1.5xmtsoRuPc4NcDy4fXcvt8cbszUCv0zRQaXFZ06', 2, '2025-09-27'),
(7, 'dinora', 'dinora93.sanchez@gmail.com', '$2y$10$KsrVv2L1gB6IP/xGiQPw8uG8qONKqt2ywHZ4bxdjT7YjYiyRJjV0S', 2, '2025-09-27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alojamientos`
--
ALTER TABLE `alojamientos`
  ADD PRIMARY KEY (`idalojamientos`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `cuentaalojamiento`
--
ALTER TABLE `cuentaalojamiento`
  ADD PRIMARY KEY (`idregistro`),
  ADD KEY `idalojamiento` (`idalojamiento`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `idrol` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alojamientos`
--
ALTER TABLE `alojamientos`
  MODIFY `idalojamientos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cuentaalojamiento`
--
ALTER TABLE `cuentaalojamiento`
  MODIFY `idregistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alojamientos`
--
ALTER TABLE `alojamientos`
  ADD CONSTRAINT `alojamientos_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `cuentaalojamiento`
--
ALTER TABLE `cuentaalojamiento`
  ADD CONSTRAINT `cuentaalojamiento_ibfk_1` FOREIGN KEY (`idalojamiento`) REFERENCES `alojamientos` (`idalojamientos`),
  ADD CONSTRAINT `cuentaalojamiento_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
