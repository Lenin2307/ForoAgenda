-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 14-11-2026 a las 23:31:21
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
-- Base de datos: `usuariosdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `id_usuario`, `nombre`, `telefono`, `correo`, `ciudad`) VALUES
(1, 5, 'Juan', '0958608082', 'jjuan@gmail.com', 'Loja'),
(2, 5, 'Yury', '0958605082', 'lopezy@gmail.com', 'Machala'),
(3, 10, 'Pablo', '0957645298', 'pibarra@gmail.com', 'Ibarra'),
(4, 5, 'Pablo', '0947536472', 'pablo@hotmail.com', 'Quito'),
(5, 11, 'Maribel', '09746352467', 'maribel1997@gmail.com', 'Manta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `correo`, `clave`, `fecha_registro`) VALUES
(1, 'Diana', 'Figueroa', 'figued@gmail.com', '$2y$10$ZS15.aR.hgP3Mmfnd8pQPek30qK0YuK9o36jG7A/VQYj7TE1QWtMe', '2026-11-14 03:15:28'),
(4, 'Juan David', 'Aguirre', 'jd@gmail.com', '$2y$10$2Wssh2kgEijG1NAsP18OWuMvXam/zyO/CCR0eUdeFjUdBhU12LAQG', '2026-11-14 03:15:28'),
(5, 'Lenin', 'Vicente Jaramillo', 'lxjaramillo@gmail.com', '$2y$10$MHKAdokA/BVbKbZdNlDixuLsWbhVPWiG4Y.ozLkw9.jtXfkOzDFwK', '2026-11-14 03:27:30'),
(6, 'Juan', 'Villalta', 'jvillalta@hotmail.com', '$2y$10$LPFFChl/8FcT06AOvIWgZ.FoIFhOJP1HIIp/GMqlxdjsvj3YQccDK', '2026-11-14 03:51:41'),
(7, 'Maria', 'Villalba', 'mariav@gmail.com', '$2y$10$VBmQuNmLPo61XLjtRvyu2.ZvEdnLCjasbeqQ9jGpI2BZHpUMdlzYu', '2026-11-14 04:25:35'),
(8, 'Yury', 'Lopez', 'lopezy@gmail.com', '$2y$10$jMzX5eXE3TMKBudEzgZ7/OEeNWt75BR4eSCpbrWwZdL26kcCdkIEW', '2026-11-14 14:17:25'),
(9, 'Luis', 'Jaramillo', 'jluis@hotmail.com', '$2y$10$3HZaBl8Iju1YdXNhRAuW9esKWyTq4w/TtKCpAZyHekc2dmnBOQNPm', '2026-11-14 14:46:00'),
(10, 'Juan Carlos', 'Robles', 'jrobles@hotmail.com', '$2y$10$p09EGQUHiCxDMIjAMCAFC.dDPazP4rAIQoaxFDnm7lvaRmDTxY.Dy', '2026-11-14 15:40:24'),
(11, 'Jefferson', 'Ortega', 'ojefferson@gmail.com', '$2y$10$pcDLgpcWEelbh7A0VwQEcO9OKXV2n1WZVciWwGrnan3MQCRhaxPGq', '2026-11-14 21:59:15');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD CONSTRAINT `contactos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
