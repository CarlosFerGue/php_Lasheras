-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-03-2024 a las 17:55:30
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
  `privado` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id_Menu`, `nombre`, `controlador`, `model`, `id_Padre`, `orden`, `privado`) VALUES
(1, 'Home', NULL, NULL, 0, 1, 'S'),
(4, 'CRUDs', NULL, NULL, 0, 1, 'S'),
(5, 'Usuarios', 'Usuarios', 'getVistaUsuarios', 4, 1, 'S'),
(6, 'Inserciones', 'Usuarios', 'getVistaInserciones', 4, 2, 'S'),
(7, 'Menu Seguridad', '', 'getMenuSeguridad', 0, 1, 'S'),
(8, 'Mantenimiento Menu y Permisos', 'MSeguridad', 'getMenuMMenu', 7, 2, 'S');

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
('5', 'Eliminar'),
('1', 'Consultar'),
('2', 'Editar'),
('3', 'Crear'),
('4', 'Modificar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `Id` enum('1','2','3','4') NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`Id`, `Nombre`) VALUES
('1', 'Administrador'),
('2', 'Staff'),
('3', 'Cliente');

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
(1, 'javier', 'xxxx', 'xx', 'H', '2020-10-01', 'javier@2si2023.es', '976466599', 'javier', '81dc9bdb52d04dc20036dbd8313ed055', 'S', '1', '1'),
(2, 'admin', 'ad', 'ad', 'H', '2020-10-02', 'admin@2si2023.es', '976466590', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'S', '2', '2'),
(3, 'Maria', 'Fernandez', 'Castro', 'H', '0000-00-00', 'mfernandez@2si2023.es', '2342423', 'Carlos', '81dc9bdb52d04dc20036dbd8313ed055', 'S', '3', '3'),
(4, 'Felipe', 'Smit', 'Fernandez', 'H', '2020-11-23', 'fsmit@2si2023.com', '976466599', 'Felipe', '81dc9bdb52d04dc20036dbd8313ed055', 'S', '3', '1'),
(5, 'Carine ', 'Schmitt', '', 'M', '2020-02-15', 'Schmitt@2si2023.es', '64103103', 'Sas', '81dc9bdb52d04dc20036dbd8313ed055', 'S', '2', '3'),
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
(161, 'Juri', 'Hashimoto', '', 'H', '2020-02-15', 'Hashimoto@2si2023.es', '64161161', 'Hashimoto', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(166, 'Wendy', 'Victorino', '', 'M', '2020-02-15', 'Victorino@2si2023.es', '64166166', 'Victorino', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(167, 'Veysel', 'Oeztan', '', 'H', '2020-02-15', 'Oeztan@2si2023.es', '64167167', 'Oeztan', '202cb962ac59075b964b07152d234b70', 'N', '1', '1'),
(168, 'Keith', 'Franco', '', 'H', '2020-02-15', 'Franco@2si2023.es', '64168168', 'Franco', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(169, 'Isabel ', 'de Castro', '', 'M', '2020-02-15', 'de Castro@2si2023.es', '64169169', 'de Castro', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(171, 'Martine ', 'Ranc', '', 'H', '2020-02-15', 'Ranc@2si2023.es', '64171171', 'Ranc', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(172, 'Marie', 'Bertrand', '', 'M', '2020-02-15', 'Bertrand@2si2023.es', '64172172', 'Bertrand', '202cb962ac59075b964b07152d234b70', 'N', '1', '1'),
(173, 'Jerry', 'Tseng', '', 'H', '2020-02-15', 'Tseng@2si2023.es', '64173173', 'Tseng', '202cb962ac59075b964b07152d234b70', 'N', '1', '1'),
(175, 'Julie', 'King2', '', 'M', '2020-02-15', 'King2@2si2023.es', '64175175', 'King2', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(177, 'Mory', 'Kentary', '', 'H', '2020-02-15', 'Kentary@2si2023.es', '64177177', 'Kentary', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(181, 'Michael', 'Frick', '', 'H', '2020-02-15', 'Frick4@2si2023.es', '64181181', 'Frick4', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(186, 'Matti', 'Karttunen', '', 'H', '2020-02-15', 'Karttunen@2si2023.es', '64186186', 'Karttunen', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(187, 'Rachel', 'Ashworth', '', 'M', '2020-02-15', 'Ashworth@2si2023.es', '64187187', 'Ashworth', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(189, 'Dean', 'Cassidy', '', 'H', '2020-02-15', 'Cassidy@2si2023.es', '64189189', 'Cassidy', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(198, 'Leslie', 'Taylor', '', 'M', '2020-02-15', 'Taylor@2si2023.es', '64198198', 'Taylor', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(201, 'Elizabeth', 'Devon', '', 'H', '2020-02-15', 'Devon@2si2023.es', '64201201', 'Devon', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(202, 'Yoshi ', 'Tamuri', '', 'H', '2020-02-15', 'Tamuri@2si2023.es', '64202202', 'Tamuri', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(204, 'Miguel', 'Barajas', '', 'H', '2020-02-15', 'Barajas@2si2023.es', '64204204', 'Barajas', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(205, 'Julie', 'Young', '', 'M', '2020-02-15', 'Young2@2si2023.es', '64205205', 'Young2', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(206, 'Brydey', 'Walker', '', 'H', '2020-02-15', 'Walker@2si2023.es', '64206206', 'Walker', '202cb962ac59075b964b07152d234b70', 'N', '1', '1'),
(209, 'Fréderique ', 'Citeaux', '', 'H', '2020-02-15', 'Citeaux@2si2023.es', '64209209', 'Citeaux', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(211, 'Mike', 'Gao', '', 'H', '2020-02-15', 'Gao@2si2023.es', '64211211', 'Gao', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(216, 'Eduardo ', 'Saavedra', '', 'H', '2020-02-15', 'Saavedra@2si2023.es', '64216216', 'Saavedra', '202cb962ac59075b964b07152d234b70', 'N', '1', '1'),
(219, 'Mary', 'Young', 'y', 'M', '2020-02-15', 'Young3@2si2023.es', '64219219', 'Young3', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(223, 'Horst ', 'Kloss', '', 'H', '2020-02-15', 'Kloss@2si2023.es', '64223223', 'Kloss', '202cb962ac59075b964b07152d234b70', 'N', '1', '1'),
(227, 'Palle', 'Ibsen', '', 'H', '2020-02-15', 'Ibsen@2si2023.es', '64227227', 'Ibsen', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(233, 'Jean ', 'Fresni?re', '', 'H', '2020-02-15', 'Fresni?re@2si2023.es', '64233233', 'Fresni?re', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(237, 'Alejandra ', 'Camino', '', 'M', '2020-02-15', 'Camino@2si2023.es', '64237237', 'Camino', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(239, 'Valarie', 'Thompson', '', 'M', '2020-02-15', 'Thompson2@2si2023.es', '64239239', 'Thompson2', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(240, 'Helen ', 'Bennett', '', 'M', '2020-02-15', 'Bennett@2si2023.es', '64240240', 'Bennett', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(242, 'Annette ', 'Roulet', '', 'M', '2020-02-15', 'Roulet@2si2023.es', '64242242', 'Roulet', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(247, 'Renate ', 'Messner', '', 'H', '2020-02-15', 'Messner@2si2023.es', '64247247', 'Messner', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(249, 'Paolo', 'Accorti', '', 'H', '2020-02-15', 'Accorti@2si2023.es', '64249249', 'accorti', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(250, 'Daniel', 'Da Silva', '', 'H', '2020-02-15', 'Da Silva@2si2023.es', '64250250', 'Da Silva', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(256, 'Daniel ', 'Tonini', '', 'H', '2020-02-15', 'Tonini@2si2023.es', '64256256', 'Tonini', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(259, 'Henriette ', 'Pfalzheim', '', 'H', '2020-02-15', 'Pfalzheim@2si2023.es', '64259259', 'Pfalzheim', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(260, 'Elizabeth ', 'Lincoln', '', 'M', '2020-02-15', 'Lincoln@2si2023.es', '64260260', 'Lincoln', '202cb962ac59075b964b07152d234b70', 'S', '1', '1'),
(273, 'Peter ', 'Franken', '', 'H', '2020-02-15', 'Franken@2si2023.es', '64273273', 'Franken', '202cb962ac59075b964b07152d234b70', 'S', '1', '1');

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
  MODIFY `id_Usuario` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=498;

--
-- Restricciones para tablas volcadas
--

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
