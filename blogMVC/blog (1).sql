-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-01-2024 a las 16:55:40
-- Versión del servidor: 8.0.34-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `blog`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int NOT NULL,
  `idMensaje` int NOT NULL,
  `idUsuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `id` int NOT NULL,
  `nombreArchivo` varchar(200) COLLATE utf8mb3_spanish_ci NOT NULL,
  `idMensaje` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int NOT NULL,
  `titulo` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `texto` text COLLATE utf8mb3_spanish_ci NOT NULL,
  `idUsuario` int NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `titulo`, `texto`, `idUsuario`, `fecha`) VALUES
(18, 'Mulan', 'disney', 22, '2023-11-03 16:50:53'),
(20, 'Pulp Fiction', 'Tarantino', 22, '2023-11-10 16:32:41'),
(21, 'Up', 'Pixar modificado', 68, '2023-11-10 16:39:58'),
(23, 'ESDLA', 'Peter Jackson', 69, '2023-11-10 16:50:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `email` varchar(200) COLLATE utf8mb3_spanish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL,
  `foto` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `sid` varchar(200) COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `foto`, `sid`) VALUES
(22, 'manolo@gmail.com', '1234', 'usuario.jpg', ''),
(61, 'nuevo@correo.com', '1234', NULL, ''),
(62, 'nuevo2@correo.com', '$2y$10$FvU6ci.pOe5iNLNlLdjvV..pJs/SqY1HBDwI0gvpcoyAzsN4m7JQ6', '0', ''),
(63, 'david@nu.com', '$2y$10$6f5q/tC7FlenFiLtLIgkQOm4Kdr3n.kdkQKpRiKhZe2EstToF47Mq', '', ''),
(65, 'patri@gm.com', '$2y$10$3k7qHvlEgLfeZyN0Xq7q8uSgrIjSWK.5B62fkS9TSzgLvvMbwBT3K', 'casa.jpg', ''),
(68, 'hoy@corre.com', '$2y$10$yvDxLr0tj4UencuZNKGXlO6LUvRUNdhp17I4xKJjUAk/ZrXfWYwwK', '1a983e213c931903f25767bc1a4f23d0.jpg', ''),
(69, 'san@correo.com', '$2y$10$oI/K4cDtHv432NwR0u3GR.G7mpeuKORw8KSDBwQVvB0IdzGIC/xqa', '', ''),
(70, 'fer@co.com', '$2y$10$SUz3Z/0VzQqUMNeZ1a38K.KMsdicv1GsfAdE.nP2GbA8Zl38eZwAK', '', 'a6395c330595c447807de45e753d636ec29d9af2'),
(71, 'martes@dic.com', '$2y$10$YL4gv2yLtFlgzQhmXAPGBe/ZM9XSdACIAy/cGPzvnRFYKU57vKJv.', '1ce9879e905ef2cbdf8fe71a5e26f6b5.jpg', '54ec2c4472c61b9c29f78b43835ac4ca15545314');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `favoritos_ibfk_1` (`idMensaje`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMensaje` (`idMensaje`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`idMensaje`) REFERENCES `mensajes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`idMensaje`) REFERENCES `mensajes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
