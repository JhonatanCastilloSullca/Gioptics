-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-06-2022 a las 11:11:26
-- Versión del servidor: 5.6.51-cll-lve
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gopticas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adicionals`
--

CREATE TABLE `adicionals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adicional_categoria`
--

CREATE TABLE `adicional_categoria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `adicional_id` bigint(20) UNSIGNED NOT NULL,
  `categoria_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

CREATE TABLE `cajas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date DEFAULT NULL,
  `monto` decimal(5,2) DEFAULT NULL,
  `documento` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idUsuario` bigint(20) UNSIGNED NOT NULL,
  `idMedios` bigint(20) UNSIGNED NOT NULL,
  `idSucursal` bigint(20) UNSIGNED NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicas`
--

CREATE TABLE `caracteristicas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adicional_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristica_producto`
--

CREATE TABLE `caracteristica_producto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `caracteristica_id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `tipo`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'montura', NULL, 'CON STOCK', '1', '2022-06-06 23:43:05', '2022-06-09 00:43:19'),
(2, 'LUNA', NULL, 'SIN STOCK', '1', '2022-06-07 02:01:12', '2022-06-07 02:01:12'),
(3, 'LÍQUIDO LIMPIADOR', 'LÍQUIDO LIMPIADOR PARA LENTES', 'CON STOCK', '1', '2022-06-09 22:36:07', '2022-06-09 22:36:07'),
(4, 'Estuche', 'Estuche para lentes', 'CON STOCK', '1', '2022-06-09 22:36:56', '2022-06-09 22:36:56'),
(6, 'Paño limpiador', 'Paño limpiador', 'CON STOCK', '1', '2022-06-09 22:39:40', '2022-06-09 22:39:40'),
(7, 'Lentes de contacto', 'Lentes de contacto', 'CON STOCK', '1', '2022-06-09 22:40:14', '2022-06-09 22:40:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_compra`
--

CREATE TABLE `categoria_compra` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categoria_id` bigint(20) UNSIGNED NOT NULL,
  `compra_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_documento` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_documento` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` int(11) NOT NULL,
  `fecha_nac` date DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `tipo_documento`, `num_documento`, `tipo`, `celular`, `fecha_nac`, `email`, `direccion`, `created_at`, `updated_at`) VALUES
(14, 'Giovanny Becerra Alegría', 'DNI', '46016717', NULL, 949393936, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idMedios` bigint(20) UNSIGNED NOT NULL,
  `idUsuario` bigint(20) UNSIGNED NOT NULL,
  `idSucursal` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `comprobante` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acuenta` decimal(15,2) NOT NULL,
  `saldo` decimal(15,2) NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `idMedios`, `idUsuario`, `idSucursal`, `fecha`, `comprobante`, `numero`, `acuenta`, `saldo`, `total`, `observacion`, `estado`, `created_at`, `updated_at`) VALUES
(61, 1, 2, 1, '2022-06-18', 'Factura', '0', '0.00', '0.00', '0.00', NULL, 'Pendiente', '2022-06-18 19:25:30', '2022-06-18 19:25:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compras`
--

CREATE TABLE `detalle_compras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idCompra` bigint(20) UNSIGNED NOT NULL,
  `idProducto` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(15,2) NOT NULL,
  `especificacion` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idVenta` bigint(20) UNSIGNED NOT NULL,
  `idProducto` bigint(20) UNSIGNED NOT NULL,
  `idMedidas` bigint(20) UNSIGNED NOT NULL,
  `especificacion` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inicios`
--

CREATE TABLE `inicios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idUsuario` bigint(20) UNSIGNED NOT NULL,
  `idSucursal` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas`
--

CREATE TABLE `medidas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `odvle` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `odvlc` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `odvleje` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `odvce` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `odvcc` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `odvceje` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oivle` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oivlc` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oivleje` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oivce` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oivcc` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oivceje` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dip` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `indicaciones` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date NOT NULL,
  `idUsuario` bigint(20) UNSIGNED NOT NULL,
  `idVendedor` bigint(20) UNSIGNED NOT NULL,
  `idPaciente` bigint(20) UNSIGNED NOT NULL,
  `idSucursal` bigint(20) UNSIGNED NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `medidas`
--

INSERT INTO `medidas` (`id`, `odvle`, `odvlc`, `odvleje`, `odvce`, `odvcc`, `odvceje`, `oivle`, `oivlc`, `oivleje`, `oivce`, `oivcc`, `oivceje`, `dip`, `add`, `indicaciones`, `fecha`, `idUsuario`, `idVendedor`, `idPaciente`, `idSucursal`, `estado`, `created_at`, `updated_at`) VALUES
(1, '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '', '', '', '2022-04-19', 1, 1, 1, 1, 'Registrado', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medios`
--

CREATE TABLE `medios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banco` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `moneda` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `medios`
--

INSERT INTO `medios` (`id`, `nombre`, `banco`, `numero`, `moneda`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'tienda', 'efectivo', NULL, 'Soles', 'dinero en efectivo', '1', '2022-06-07 00:22:09', '2022-06-07 00:22:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(147, '2014_10_12_100000_create_password_resets_table', 1),
(148, '2019_08_19_000000_create_failed_jobs_table', 1),
(149, '2020_03_11_185656_create_sucursals_table', 1),
(150, '2020_05_11_000000_create_users_table', 1),
(151, '2022_03_26_114441_create_unidads_table', 1),
(152, '2022_04_10_035405_create_categorias_table', 1),
(153, '2022_04_10_085212_create_proveedors_table', 1),
(154, '2022_04_10_115935_create_clientes_table', 1),
(155, '2022_04_10_135005_create_pacientes_table', 1),
(156, '2022_04_10_172958_create_productos_table', 1),
(157, '2022_04_10_180606_create_medios_table', 1),
(158, '2022_04_10_184607_create_inicios_table', 1),
(159, '2022_04_10_185021_create_cajas_table', 1),
(160, '2022_04_10_201019_create_medidas_table', 1),
(161, '2022_04_10_202021_create_ventas_table', 1),
(162, '2022_04_10_202041_create_detalle_ventas_table', 1),
(163, '2022_04_11_153627_create_compras_table', 1),
(164, '2022_04_11_175928_create_detalle_compras_table', 1),
(165, '2022_04_19_183737_create_saldos_table', 1),
(166, '2022_04_20_111534_create_saldocs_table', 1),
(167, '2022_05_26_113254_create_adicionals_table', 1),
(168, '2022_05_26_113332_create_caracteristicas_table', 1),
(169, '2022_05_26_133421_create_adicional_categoria_table', 1),
(170, '2022_06_01_083134_create_caracteristica_producto_table', 1),
(171, '2022_06_01_130902_create_categoria_compra_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_documento` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_documento` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `ocupacion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `nombre`, `tipo_documento`, `num_documento`, `edad`, `tipo`, `celular`, `email`, `fecha_nac`, `ocupacion`, `created_at`, `updated_at`) VALUES
(1, 'Sin Medida', 'Sin Medida', 'Sin Medida', NULL, NULL, '999999999', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `precio` decimal(5,2) DEFAULT NULL,
  `precio_compra` decimal(5,2) DEFAULT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proveedor_id` bigint(20) UNSIGNED NOT NULL,
  `categoria_id` bigint(20) UNSIGNED NOT NULL,
  `sucursal_id` bigint(20) UNSIGNED NOT NULL,
  `unidad_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedors`
--

CREATE TABLE `proveedors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_documento` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_documento` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_cuenta` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saldocs`
--

CREATE TABLE `saldocs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idUsuario` bigint(20) UNSIGNED NOT NULL,
  `idMedios` bigint(20) UNSIGNED NOT NULL,
  `idCompra` bigint(20) UNSIGNED NOT NULL,
  `idSucursal` bigint(20) UNSIGNED NOT NULL,
  `fecha` datetime NOT NULL,
  `monto` decimal(11,2) NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saldos`
--

CREATE TABLE `saldos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idUsuario` bigint(20) UNSIGNED NOT NULL,
  `idMedios` bigint(20) UNSIGNED NOT NULL,
  `idVenta` bigint(20) UNSIGNED NOT NULL,
  `idSucursal` bigint(20) UNSIGNED NOT NULL,
  `fecha` datetime NOT NULL,
  `monto` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursals`
--

CREATE TABLE `sucursals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sucursals`
--

INSERT INTO `sucursals` (`id`, `nombre`, `direccion`, `telefono`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'G-OPTICS', 'CALLE MATARÁ 242 - CUSCO', '953278563', '1', NULL, NULL),
(2, 'almacén', 'CALLE MATARÁ 242 - CUSCO', '+51 953 278 563', '1', '2022-06-07 00:30:14', '2022-06-07 00:30:14'),
(3, 'optical shop', 'CALLE MATARÁ 261', NULL, '1', '2022-06-07 00:58:30', '2022-06-07 00:58:30'),
(4, 'CUSCOPTICAS', 'CALLE MATARÁ 245-A - CUSCO', NULL, '1', '2022-06-14 18:16:04', '2022-06-14 18:16:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidads`
--

CREATE TABLE `unidads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `unidads`
--

INSERT INTO `unidads` (`id`, `nombre`, `estado`) VALUES
(1, 'docena', '0'),
(2, 'pieza', '1'),
(3, 'frasco', '1'),
(4, 'caja', '0'),
(5, 'Botella', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_documento` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_documento` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rol` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usuario` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idSucursal` bigint(20) UNSIGNED NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellido`, `tipo_documento`, `num_documento`, `celular`, `email`, `rol`, `usuario`, `password`, `idSucursal`, `estado`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'David', 'Miranda Tarco', 'DNI', '48507551', '982733597', 'dmirandatarco@gmail.com', 'Especialista', 'david', '$2y$10$Qs.6TuN8TDwX44PSLdro7ukFbWzEzVFm13v6aA7SxwVDr0WiMV6OG', 1, '1', NULL, '2020-07-06 11:58:12', '2022-04-12 19:54:26'),
(2, 'Giovanny', 'Becerra Alegría', 'DNI', '46016717', '986280305', 'giobecerralegria@gmail.co', 'Gerencia', 'Gio', '$2y$10$0iPdWF31g8v/8gNPb81iieZVfUWtP1eJxlvUT1k1VjHCQPShu7Uby', 1, '1', NULL, '2022-04-24 07:51:19', '2022-04-24 07:51:19'),
(3, 'Patricia', 'Becerra Alegria', 'DNI', '44610307', '953278564', 'pathyshei@gmail.com', 'Gerencia', 'pathy', '$2y$10$xTKOcsCiiiwa0pSC5SfUpuAPbbcw8CucTVrbf0CvyZptjSZVPQ/Vy', 1, '0', NULL, '2022-04-24 07:52:34', '2022-06-14 18:01:21'),
(4, 'libertad wendy', 'ortiz huamani', 'DNI', '74759543', '940715290', NULL, 'Asesor de Venta', 'libertad', '$2y$10$JLTTbtbJSovZIBK0rNu/EeBS0dh5oJQFWEAB6ybC8TjXlhobD1bRW', 1, '0', NULL, '2022-04-24 07:52:55', '2022-06-14 18:01:18'),
(5, 'Karen lizbet', 'Gutiérrez Merma', 'DNI', '73883866', '919049293', NULL, 'Asesor de Venta', 'karen', '$2y$10$Pw3QBvTWvJXn8x8yEVGfpekHDtAC2/ygV9sRwob2v6X3eVmxnR80O', 1, '0', NULL, '2022-04-24 07:55:18', '2022-06-14 18:01:15'),
(6, 'Yesenia', 'Huillca Zapana', 'DNI', '72566114', '926496676', 'yhuillcaz@uglobal.edu.pe', 'Asesor de Venta', 'Yesenia', '$2y$10$TqCJ.4H1p0UHgjGaXsMtw.UY0EJVwXdZgtvb7ygmCfNL3BmmxDvd2', 1, '0', NULL, '2022-04-24 07:56:16', '2022-06-14 18:01:12'),
(7, 'Roshmery', 'Meza Pillco', 'DNI', '44859405', '951258699', NULL, 'Asesor de Venta', 'Roshmery', '$2y$10$GhHI3u.4O56SpFCWYCtlSuAEfbt2Lcnmsp1VjLwFMch.9fG7gKLa2', 3, '0', NULL, '2022-04-24 07:56:47', '2022-06-14 18:01:10'),
(8, 'Luis', 'Becerra Alegria', 'DNI', '44607343', '984134470', 'pianissimo.luis@gmail.com', 'Especialista', 'Doc', '$2y$10$GGpuFXPCgI8nal/RA98aOOZYlIyWwE5DH6vOx3keyOENIDCLgXrW.', 1, '0', NULL, '2022-04-24 07:58:48', '2022-06-14 18:01:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idCliente` bigint(20) UNSIGNED NOT NULL,
  `idUsuario` bigint(20) UNSIGNED NOT NULL,
  `idMedios` bigint(20) UNSIGNED NOT NULL,
  `idSucursal` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `descuento` decimal(15,2) NOT NULL,
  `acuenta` decimal(15,2) NOT NULL,
  `saldo` decimal(15,2) NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `observacion` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adicionals`
--
ALTER TABLE `adicionals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `adicional_categoria`
--
ALTER TABLE `adicional_categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adicional_categoria_adicional_id_foreign` (`adicional_id`),
  ADD KEY `adicional_categoria_categoria_id_foreign` (`categoria_id`);

--
-- Indices de la tabla `cajas`
--
ALTER TABLE `cajas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cajas_idusuario_foreign` (`idUsuario`),
  ADD KEY `cajas_idmedios_foreign` (`idMedios`),
  ADD KEY `cajas_idsucursal_foreign` (`idSucursal`);

--
-- Indices de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caracteristicas_adicional_id_foreign` (`adicional_id`);

--
-- Indices de la tabla `caracteristica_producto`
--
ALTER TABLE `caracteristica_producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caracteristica_producto_caracteristica_id_foreign` (`caracteristica_id`),
  ADD KEY `caracteristica_producto_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_compra`
--
ALTER TABLE `categoria_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_compra_categoria_id_foreign` (`categoria_id`),
  ADD KEY `categoria_compra_compra_id_foreign` (`compra_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compras_idmedios_foreign` (`idMedios`),
  ADD KEY `compras_idusuario_foreign` (`idUsuario`),
  ADD KEY `compras_idsucursal_foreign` (`idSucursal`);

--
-- Indices de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_compras_idcompra_foreign` (`idCompra`),
  ADD KEY `detalle_compras_idproducto_foreign` (`idProducto`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_ventas_idventa_foreign` (`idVenta`),
  ADD KEY `detalle_ventas_idproducto_foreign` (`idProducto`),
  ADD KEY `detalle_ventas_idmedidas_foreign` (`idMedidas`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`id`);

--
-- Indices de la tabla `inicios`
--
ALTER TABLE `inicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inicios_idusuario_foreign` (`idUsuario`),
  ADD KEY `inicios_idsucursal_foreign` (`idSucursal`);

--
-- Indices de la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medidas_idusuario_foreign` (`idUsuario`),
  ADD KEY `medidas_idvendedor_foreign` (`idVendedor`),
  ADD KEY `medidas_idpaciente_foreign` (`idPaciente`),
  ADD KEY `medidas_idsucursal_foreign` (`idSucursal`);

--
-- Indices de la tabla `medios`
--
ALTER TABLE `medios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_proveedor_id_foreign` (`proveedor_id`),
  ADD KEY `productos_categoria_id_foreign` (`categoria_id`),
  ADD KEY `productos_sucursal_id_foreign` (`sucursal_id`),
  ADD KEY `productos_unidad_id_foreign` (`unidad_id`);

--
-- Indices de la tabla `proveedors`
--
ALTER TABLE `proveedors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `saldocs`
--
ALTER TABLE `saldocs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saldocs_idusuario_foreign` (`idUsuario`),
  ADD KEY `saldocs_idmedios_foreign` (`idMedios`),
  ADD KEY `saldocs_idcompra_foreign` (`idCompra`),
  ADD KEY `saldocs_idsucursal_foreign` (`idSucursal`);

--
-- Indices de la tabla `saldos`
--
ALTER TABLE `saldos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saldos_idusuario_foreign` (`idUsuario`),
  ADD KEY `saldos_idmedios_foreign` (`idMedios`),
  ADD KEY `saldos_idventa_foreign` (`idVenta`),
  ADD KEY `saldos_idsucursal_foreign` (`idSucursal`);

--
-- Indices de la tabla `sucursals`
--
ALTER TABLE `sucursals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidads`
--
ALTER TABLE `unidads`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`),
  ADD KEY `users_idsucursal_foreign` (`idSucursal`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventas_idcliente_foreign` (`idCliente`),
  ADD KEY `ventas_idusuario_foreign` (`idUsuario`),
  ADD KEY `ventas_idmedios_foreign` (`idMedios`),
  ADD KEY `ventas_idsucursal_foreign` (`idSucursal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adicionals`
--
ALTER TABLE `adicionals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `adicional_categoria`
--
ALTER TABLE `adicional_categoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `cajas`
--
ALTER TABLE `cajas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `caracteristica_producto`
--
ALTER TABLE `caracteristica_producto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `categoria_compra`
--
ALTER TABLE `categoria_compra`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inicios`
--
ALTER TABLE `inicios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `medios`
--
ALTER TABLE `medios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `proveedors`
--
ALTER TABLE `proveedors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `saldocs`
--
ALTER TABLE `saldocs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `saldos`
--
ALTER TABLE `saldos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sucursals`
--
ALTER TABLE `sucursals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `unidads`
--
ALTER TABLE `unidads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adicional_categoria`
--
ALTER TABLE `adicional_categoria`
  ADD CONSTRAINT `adicional_categoria_adicional_id_foreign` FOREIGN KEY (`adicional_id`) REFERENCES `adicionals` (`id`),
  ADD CONSTRAINT `adicional_categoria_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `cajas`
--
ALTER TABLE `cajas`
  ADD CONSTRAINT `cajas_idmedios_foreign` FOREIGN KEY (`idMedios`) REFERENCES `medios` (`id`),
  ADD CONSTRAINT `cajas_idsucursal_foreign` FOREIGN KEY (`idSucursal`) REFERENCES `sucursals` (`id`),
  ADD CONSTRAINT `cajas_idusuario_foreign` FOREIGN KEY (`idUsuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD CONSTRAINT `caracteristicas_adicional_id_foreign` FOREIGN KEY (`adicional_id`) REFERENCES `adicionals` (`id`);

--
-- Filtros para la tabla `caracteristica_producto`
--
ALTER TABLE `caracteristica_producto`
  ADD CONSTRAINT `caracteristica_producto_caracteristica_id_foreign` FOREIGN KEY (`caracteristica_id`) REFERENCES `caracteristicas` (`id`),
  ADD CONSTRAINT `caracteristica_producto_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `categoria_compra`
--
ALTER TABLE `categoria_compra`
  ADD CONSTRAINT `categoria_compra_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `categoria_compra_compra_id_foreign` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`id`);

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_idmedios_foreign` FOREIGN KEY (`idMedios`) REFERENCES `medios` (`id`),
  ADD CONSTRAINT `compras_idsucursal_foreign` FOREIGN KEY (`idSucursal`) REFERENCES `sucursals` (`id`),
  ADD CONSTRAINT `compras_idusuario_foreign` FOREIGN KEY (`idUsuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD CONSTRAINT `detalle_compras_idcompra_foreign` FOREIGN KEY (`idCompra`) REFERENCES `compras` (`id`),
  ADD CONSTRAINT `detalle_compras_idproducto_foreign` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `detalle_ventas_idmedidas_foreign` FOREIGN KEY (`idMedidas`) REFERENCES `medidas` (`id`),
  ADD CONSTRAINT `detalle_ventas_idproducto_foreign` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `detalle_ventas_idventa_foreign` FOREIGN KEY (`idVenta`) REFERENCES `ventas` (`id`);

--
-- Filtros para la tabla `inicios`
--
ALTER TABLE `inicios`
  ADD CONSTRAINT `inicios_idsucursal_foreign` FOREIGN KEY (`idSucursal`) REFERENCES `sucursals` (`id`),
  ADD CONSTRAINT `inicios_idusuario_foreign` FOREIGN KEY (`idUsuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD CONSTRAINT `medidas_idpaciente_foreign` FOREIGN KEY (`idPaciente`) REFERENCES `pacientes` (`id`),
  ADD CONSTRAINT `medidas_idsucursal_foreign` FOREIGN KEY (`idSucursal`) REFERENCES `sucursals` (`id`),
  ADD CONSTRAINT `medidas_idusuario_foreign` FOREIGN KEY (`idUsuario`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `medidas_idvendedor_foreign` FOREIGN KEY (`idVendedor`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `productos_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedors` (`id`),
  ADD CONSTRAINT `productos_sucursal_id_foreign` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursals` (`id`),
  ADD CONSTRAINT `productos_unidad_id_foreign` FOREIGN KEY (`unidad_id`) REFERENCES `unidads` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
