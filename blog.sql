-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 07-11-2023 a las 17:42:10
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
(6, 'Toy Story', 'pixar', 38, '2023-10-17 14:47:45'),
(7, 'Tarzan', 'disney', 40, '2023-10-17 14:51:37'),
(15, 'Up', 'pixar', 58, '2023-10-20 14:38:18'),
(16, 'Cinemania', 'blog de cine', 60, '2023-10-24 14:51:34'),
(18, 'Mulan', 'disney', 22, '2023-11-03 16:50:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `email` varchar(200) COLLATE utf8mb3_spanish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL,
  `foto` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `foto`) VALUES
(22, 'manolo@gmail.com', '1234', 'usuario.jpg'),
(24, 'manolo@gmail.com', '1234', 'usuario.jpg'),
(26, 'manolo@gmail.com', '1234', 'usuario.jpg'),
(28, 'manolo@gmail.com', '1234', 'usuario.jpg'),
(30, 'manolo@gmail.com', '1234', 'usuario.jpg'),
(32, 'manolo@gmail.com', '1234', 'usuario.jpg'),
(34, 'manolo@gmail.com', '1234', 'usuario.jpg'),
(36, 'manolo@gmail.com', '1234', 'usuario.jpg'),
(38, 'manolo@gmail.com', '1234', 'usuario.jpg'),
(40, 'manolo@gmail.com', '1234', 'usuario.jpg'),
(58, 'manolo@gmail.com', '1234', 'usuario.jpg'),
(60, 'manolo@gmail.com', '1234', 'usuario.jpg'),
(61, 'nuevo@correo.com', '1234', NULL),
(62, 'nuevo2@correo.com', '$2y$10$FvU6ci.pOe5iNLNlLdjvV..pJs/SqY1HBDwI0gvpcoyAzsN4m7JQ6', '0'),
(63, 'david@nu.com', '$2y$10$6f5q/tC7FlenFiLtLIgkQOm4Kdr3n.kdkQKpRiKhZe2EstToF47Mq', ''),
(65, 'patri@gm.com', '$2y$10$3k7qHvlEgLfeZyN0Xq7q8uSgrIjSWK.5B62fkS9TSzgLvvMbwBT3K', 'casa.jpg'),
(67, 'fer@co.com', '$2y$10$MdcZlxIyI9ZGZwbNWvPg0ubqnI6TD.sFTHmq/vu/QhUhXfqMpU9/.', '7e2e33b287aa6a3bd66cb05559154568.jpg');

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
