-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-04-2024 a las 19:05:03
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
-- Base de datos: `di23`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id_Menu` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `controlador` text DEFAULT NULL,
  `model` text DEFAULT NULL,
  `id_Padre` int(11) UNSIGNED NOT NULL,
  `orden` int(11) UNSIGNED NOT NULL,
  `privado` char(1) NOT NULL DEFAULT 'N',
  `posicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id_Menu`, `nombre`, `controlador`, `model`, `id_Padre`, `orden`, `privado`, `posicion`) VALUES
(1, 'Home', NULL, NULL, 0, 1, 'S', 1),
(4, 'CRUDs', NULL, NULL, 0, 1, 'S', 2),
(5, 'Usuarios', 'Usuarios', 'getVistaUsuarios', 4, 1, 'S', 3),
(6, 'Inserciones', 'Usuarios', 'getVistaInserciones', 4, 2, 'S', 4),
(7, 'Menu Seguridad', '', 'getMenuSeguridad', 0, 1, 'S', 5),
(8, 'Mantenimiento Menu y Permisos', 'Seguridad', 'getVistaSeguridad', 7, 2, 'S', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus_permisos`
--

CREATE TABLE `menus_permisos` (
  `id_Menu` int(11) UNSIGNED NOT NULL,
  `permiso` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `Id` enum('1','2','3','4','5') NOT NULL,
  `permiso` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`Id`, `permiso`) VALUES
('', 'Eliminar'),
('1', 'Consultar'),
('2', 'Editar'),
('3', 'Crear'),
('4', 'Modificar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `Id` enum('1','2','3','4','5','6','7','8','9','10') NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`Id`, `Nombre`) VALUES
('', '--Elija un Rol'),
('1', 'Administrador'),
('2', 'Staff'),
('3', 'Cliente'),
('4', 'pepi'),
('8', 'sas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_permisos`
--

CREATE TABLE `roles_permisos` (
  `Id_Rol` enum('1','2','3','4') NOT NULL,
  `Id_Permiso` enum('1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles_permisos`
--

INSERT INTO `roles_permisos` (`Id_Rol`, `Id_Permiso`) VALUES
('1', '1'),
('1', '2'),
('1', '3'),
('1', '4'),
('2', '1'),
('2', '2'),
('2', '3'),
('2', '4'),
('3', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_Usuario` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `apellido_1` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `apellido_2` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `sexo` char(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `fecha_Alta` date DEFAULT NULL,
  `mail` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `movil` varchar(15) NOT NULL DEFAULT '',
  `login` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `pass` varchar(32) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `activo` char(1) NOT NULL DEFAULT 'N',
  `id_Permiso` enum('1','2','3','4') NOT NULL,
  `id_Rol` enum('1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_Usuario`, `nombre`, `apellido_1`, `apellido_2`, `sexo`, `fecha_Alta`, `mail`, `movil`, `login`, `pass`, `activo`, `id_Permiso`, `id_Rol`) VALUES
(0, '[value-2]', '[value-3]', '[value-4]', '[', '0000-00-00', '[value-7]', '[value-8]', '--Elija un usuario', '[value-10]', '[', '', ''),
(1, 'javier', 'xxxx', 'xx', 'H', '2020-10-01', 'javier@2si2023.es', '976466599', 'javier', '81dc9bdb52d04dc20036dbd8313ed055', 'S', '1', '1'),
(2, 'admin', 'ad', 'ad', 'H', '2020-10-02', 'admin@2si2023.es', '976466590', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'S', '2', '2'),
(3, 'Maria', 'Fernandez', 'Castro', 'H', '0000-00-00', 'mfernandez@2si2023.es', '2342423', 'Carlos', '81dc9bdb52d04dc20036dbd8313ed055', 'S', '3', '3'),
(4, 'Felipe', 'Smit', 'Fernandez', 'H', '2020-11-23', 'fsmit@2si2023.com', '976466599', 'Felipe', '81dc9bdb52d04dc20036dbd8313ed055', 'S', '3', '1'),
(5, 'Carine ', 'Schmitt', '', 'M', '2020-02-15', 'Schmitt@2si2023.es', '64103103', 'Sas', '81dc9bdb52d04dc20036dbd8313ed055', 'S', '2', '3'),
(6, 'Invitado', '', '', '', '0000-00-00', '', '', 'Invitado', '81dc9bdb52d04dc20036dbd8313ed055', 'S', '1', '1'),
(112, 'Jean', 'King', '', 'H', '2020-02-15', 'King@2si2023.es', '64112112', 'King', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(114, 'Peter', 'Ferguson', '', 'H', '2020-02-15', 'Ferguson@2si2023.es', '64114114', 'Ferguson', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(119, 'Janine ', 'Labrune', '', 'M', '2020-02-15', 'Labrune@2si2023.es', '64119119', 'Labrune', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(121, 'Jonas ', 'Bergulfsen', '', 'H', '2020-02-15', 'Bergulfsen@2si2023.es', '64121121', 'Bergulfsen', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(124, 'Susan', 'Nelson', '', 'H', '2020-02-15', 'Nelson@2si2023.es', '64124124', 'Nelson', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(125, 'Zbyszek ', 'Piestrzeniewicz', '', 'H', '2020-02-15', 'Piestrzeniewicz@2si2023.es', '64125125', 'Piestrzeniewicz', '202cb962ac59075b964b07152d234b70', 'N', '1', '1'),
(128, 'Roland', 'Keitel', '', 'H', '2020-02-15', 'Keitel@2si2023.es', '64128128', 'Keitel', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(129, 'Julie', 'Murphy', '', 'M', '2020-02-15', 'Murphy@2si2023.es', '64129129', 'Murphy', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(131, 'Kwai', 'Lee', '', 'H', '2020-02-15', 'Lee@2si2023.es', '64131131', 'Lee', '202cb962ac59075b964b07152d234b70', 'N', '1', '1'),
(141, 'Diego ', 'Freyre', '', 'H', '2020-02-15', 'Freyre@2si2023.es', '64141141', 'Freyre', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(144, 'Christina ', 'Berglund', '', 'M', '2020-02-15', 'Berglund@2si2023.es', '64144144', 'Berglund', '202cb962ac59075b964b07152d234b70', 'N', '1', '1'),
(145, 'Jytte ', 'Petersen', '', 'H', '2020-02-15', 'Petersen@2si2023.es', '64145145', 'Petersen', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(146, 'Mary ', 'Saveley', '', 'M', '2020-02-15', 'Saveley@2si2023.es', '64146146', 'Saveley', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(148, 'Eric', 'Natividad', '', 'H', '2020-02-15', 'Natividad@2si2023.es', '64148148', 'Natividad', '202cb962ac59075b964b07152d234b70', 'N', '1', '1'),
(151, 'Jeff', 'Young', '', 'H', '2020-02-15', 'Young@2si2023.es', '64151151', 'Young', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(157, 'Kelvin', 'Leong', '', 'H', '2020-02-15', 'Leong@2si2023.es', '64157157', 'Leong', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(161, 'Juri', 'Hashimoto', '', 'H', '2020-02-15', 'Hashimoto@2si2023.es', '64161161', 'Hashimoto', '202cb962ac59075b964b07152d234b70', 'S', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_permisos`
--

CREATE TABLE `usuarios_permisos` (
  `id_Usuario` int(11) UNSIGNED NOT NULL,
  `Id_permisos` enum('1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_permisos`
--

INSERT INTO `usuarios_permisos` (`id_Usuario`, `Id_permisos`) VALUES
(1, '1'),
(1, '2'),
(1, '3'),
(2, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_roles`
--

CREATE TABLE `usuarios_roles` (
  `id_Usuario` int(11) UNSIGNED NOT NULL,
  `Id_roles` enum('1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_roles`
--

INSERT INTO `usuarios_roles` (`id_Usuario`, `Id_roles`) VALUES
(1, '1'),
(1, '2'),
(2, '3'),
(3, '2'),
(4, '3'),
(5, '2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id_Menu`);

--
-- Indices de la tabla `menus_permisos`
--
ALTER TABLE `menus_permisos`
  ADD KEY `id_Menu` (`id_Menu`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD PRIMARY KEY (`Id_Rol`,`Id_Permiso`),
  ADD KEY `Id_Permiso` (`Id_Permiso`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_Usuario`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Indices de la tabla `usuarios_permisos`
--
ALTER TABLE `usuarios_permisos`
  ADD PRIMARY KEY (`id_Usuario`,`Id_permisos`),
  ADD KEY `Id` (`Id_permisos`);

--
-- Indices de la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD PRIMARY KEY (`id_Usuario`,`Id_roles`),
  ADD KEY `Id` (`Id_roles`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_Usuario` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=499;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `menus_permisos`
--
ALTER TABLE `menus_permisos`
  ADD CONSTRAINT `menus_permisos_ibfk_1` FOREIGN KEY (`id_Menu`) REFERENCES `menus` (`id_Menu`);

--
-- Filtros para la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD CONSTRAINT `roles_permisos_ibfk_1` FOREIGN KEY (`Id_Rol`) REFERENCES `roles` (`Id`),
  ADD CONSTRAINT `roles_permisos_ibfk_2` FOREIGN KEY (`Id_Permiso`) REFERENCES `permisos` (`Id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_Permiso`) REFERENCES `permisos` (`Id`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_Rol`) REFERENCES `roles` (`Id`);

--
-- Filtros para la tabla `usuarios_permisos`
--
ALTER TABLE `usuarios_permisos`
  ADD CONSTRAINT `usuarios_permisos_ibfk_1` FOREIGN KEY (`id_Usuario`) REFERENCES `usuarios` (`id_Usuario`),
  ADD CONSTRAINT `usuarios_permisos_ibfk_2` FOREIGN KEY (`Id_permisos`) REFERENCES `permisos` (`Id`);

--
-- Filtros para la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD CONSTRAINT `usuarios_roles_ibfk_1` FOREIGN KEY (`id_Usuario`) REFERENCES `usuarios` (`id_Usuario`),
  ADD CONSTRAINT `usuarios_roles_ibfk_2` FOREIGN KEY (`Id_roles`) REFERENCES `roles` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
