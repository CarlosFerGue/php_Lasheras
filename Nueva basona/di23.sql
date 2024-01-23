-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2024 a las 12:00:19
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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
  `id_Padre` int(11) UNSIGNED NOT NULL,
  `orden` int(11) UNSIGNED NOT NULL,
  `privado` char(1) NOT NULL DEFAULT 'N',
  `URL` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id_Menu`, `nombre`, `id_Padre`, `orden`, `privado`, `URL`) VALUES
(1, 'Home', 0, 1, 'N', ''),
(2, 'Link', 0, 2, 'N', ''),
(3, 'Link1', 2, 1, 'N', ''),
(4, 'CRUDs', 0, 1, 'S', ''),
(5, 'Usuarios', 4, 1, 'S', 'getVistaMenuSeleccionado(\'Usuarios\', \'getVistaUsuarios\')'),
(6, 'Inserciones', 4, 2, 'S', 'getVistaMenuSeleccionado(\'Usuarios\', \'getVistaInserciones\')');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id_Menu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
