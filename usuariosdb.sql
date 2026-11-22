-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 21-11-2026 a las 19:37:15
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
  `ciudad` varchar(100) NOT NULL,
  `favorito` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `id_usuario`, `nombre`, `telefono`, `correo`, `ciudad`, `favorito`, `fecha_creacion`) VALUES
(1, 5, 'Juan', '0958608082', 'jjuan@gmail.com', 'Loja', 1, '2026-11-21 17:24:23'),
(2, 5, 'Yury', '0958605082', 'lopezy@gmail.com', 'Machala', 0, '2026-11-21 17:24:23'),
(3, 10, 'Pablo', '0957645298', 'pibarra@gmail.com', 'Ibarra', 0, '2026-11-21 17:24:23'),
(4, 5, 'Pablo', '0947536472', 'pablo@hotmail.com', 'Quito', 0, '2026-11-21 17:24:23'),
(5, 11, 'Maribel', '09746352467', 'maribel1997@gmail.com', 'Manta', 0, '2026-11-21 17:24:23'),
(10, 18, 'Josselyn', '09847562536', 'jos1999@gmail.com', 'Loja', 0, '2026-11-21 17:24:23'),
(11, 18, 'Mrio', 'Torres', 'marioloja@httt.com', 'Quito', 0, '2026-11-21 17:24:23');

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
(11, 'Jefferson', 'Ortega', 'ojefferson@gmail.com', '$2y$10$pcDLgpcWEelbh7A0VwQEcO9OKXV2n1WZVciWwGrnan3MQCRhaxPGq', '2026-11-14 21:59:15'),
(12, 'Josefina', 'Aguilar', 'aguilar@gmail.com', '$2y$10$mQjOy1ABhfYuxd/inylih.z/pHez.O1UqQOWWS9nIPnwXxsGAoSgm', '2026-11-14 23:24:49'),
(13, 'Josefina', 'Torres', 'torres@gmail.com', '$2y$10$3KT8voPlEfGP0Py7UxxhM.Md0x9jvEEivGxRD32hDxAmIeikW4c6u', '2026-11-14 23:30:39'),
(14, 'Leandra', 'Jaramillo', 'leandra@gmail.com', '$2y$10$4dzfBIAouE4OQuhJZgWaiOTy4tAIW4dULUtA7zQcsqN/hkg72rB0O', '2026-11-14 23:50:22'),
(15, 'Maria Jose', 'Jaramillo', 'josem@hotmail.com', '$2y$10$RHdsBtd7RN/zLQTMkiBYSeSteiYkO5QleyX5cU/kT1v0f/oo55s.u', '2026-11-14 23:57:23'),
(16, 'Pedro Pablo', 'Piedra', 'ppedro@gmail.com', '$2y$10$h8uksT621tIA1eVkUrbw2efomTNOFqXJ9hBD9BE2tHvznDsCJ/qsW', '2026-11-15 00:34:09'),
(17, 'Diego', 'Salinas', 'diego@hotmail.com', '$2y$10$BAFMDX/ZA1VL2E3tkuQ/MOWdYtVUp1rSKjZg9QgypM93ge71wIMBe', '2026-11-15 00:42:25'),
(18, 'Dario', 'Gomez', 'dgomez@hotmail.com', '$2y$10$qEkT3Az8iFJO2eDbLX9c7uABGs2H317L30qclVguEXy5jKHVk5OgW', '2026-11-21 15:55:22'),
(19, 'Paty', 'Jaramillo', 'paty1998@kkaja.von', '$2y$10$O0CEjZqv9cadG7FetUeDROF/hZxhOFGgIGDahTacXumsiZiRAIL6W', '2026-11-21 16:38:19');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
