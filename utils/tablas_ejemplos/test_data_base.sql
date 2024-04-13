-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql
-- Tiempo de generación: 09-04-2024 a las 17:20:55
-- Versión del servidor: 11.3.2-MariaDB-1:11.3.2+maria~ubu2204
-- Versión de PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `test_data_base`
--
CREATE DATABASE IF NOT EXISTS `test_data_base` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `test_data_base`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `address_empresa`
--

DROP TABLE IF EXISTS `address_empresa`;
CREATE TABLE IF NOT EXISTS `address_empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_datos_fiscales` int(11) DEFAULT NULL,
  `tipo_via` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `piso` varchar(50) NOT NULL,
  `puerta` varchar(50) NOT NULL,
  `cp` varchar(50) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `es_principal` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`roles`)),
  `active` int(11) NOT NULL COMMENT '0:no activo 1 : activo',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_profile`
--

DROP TABLE IF EXISTS `admin_profile`;
CREATE TABLE IF NOT EXISTS `admin_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `direccion_id` int(11) DEFAULT NULL,
  `tel_principal` varchar(100) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adress`
--

DROP TABLE IF EXISTS `adress`;
CREATE TABLE IF NOT EXISTS `adress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_via` varchar(50) NOT NULL,
  `nombre_via` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `piso` varchar(50) NOT NULL,
  `puerta` varchar(50) NOT NULL,
  `cp` varchar(50) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url_escritorio` varchar(255) NOT NULL,
  `url_movil` varchar(255) DEFAULT NULL,
  `texto` varchar(255) DEFAULT NULL,
  `ref_elemento_id` varchar(255) DEFAULT NULL,
  `fecha_ini` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_fin` datetime NOT NULL DEFAULT current_timestamp(),
  `link` varchar(255) DEFAULT NULL,
  `tipo` varchar(50) NOT NULL,
  `orden` int(11) NOT NULL,
  `mostrar_temporizador` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `url_escritorio` (`url_escritorio`),
  KEY `url_movil` (`url_movil`),
  KEY `ref_elemento_id` (`ref_elemento_id`),
  KEY `fecha_ini` (`fecha_ini`),
  KEY `fecha_fin` (`fecha_fin`),
  KEY `tipo` (`tipo`),
  KEY `orden` (`orden`),
  KEY `activo` (`activo`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

DROP TABLE IF EXISTS `carrito`;
CREATE TABLE IF NOT EXISTS `carrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cantidad_productos` int(11) NOT NULL,
  `subtotal_carrito` decimal(10,0) NOT NULL,
  `cantidad_impuesto` decimal(10,0) NOT NULL,
  `total_iva_incluido` decimal(10,0) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_productos`
--

DROP TABLE IF EXISTS `carrito_productos`;
CREATE TABLE IF NOT EXISTS `carrito_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrito_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `producto_sin_iva` decimal(10,0) NOT NULL,
  `cantidad_iva` decimal(10,0) NOT NULL,
  `producto_con_iva` decimal(10,0) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_categoria` varchar(255) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `url_imagen_principal` varchar(255) NOT NULL,
  `categoria_descatalogada` int(11) NOT NULL,
  `categoria_estado` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_media`
--

DROP TABLE IF EXISTS `categoria_media`;
CREATE TABLE IF NOT EXISTS `categoria_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `url_media` varchar(255) NOT NULL,
  `tipo_media` varchar(100) DEFAULT NULL,
  `es_principal` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `complementos`
--

DROP TABLE IF EXISTS `complementos`;
CREATE TABLE IF NOT EXISTS `complementos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_complemento` varchar(255) NOT NULL,
  `tipo_complemento` varchar(255) DEFAULT NULL,
  `titulo_complemento` varchar(255) DEFAULT NULL,
  `descripcion_complemento` text DEFAULT NULL,
  `descripcion_dos` text DEFAULT NULL,
  `descripcion_tres` text DEFAULT NULL,
  `active` int(11) NOT NULL,
  `fecha_ini` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `tiene_fecha_caducidad` int(11) NOT NULL,
  `precio_complemento` decimal(10,2) DEFAULT NULL,
  `porcentaje_complemento` decimal(10,2) DEFAULT NULL,
  `cantidad_a_adelantar` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `complemento_media`
--

DROP TABLE IF EXISTS `complemento_media`;
CREATE TABLE IF NOT EXISTS `complemento_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complemento_id` int(11) NOT NULL,
  `tipo_media` varchar(255) DEFAULT NULL,
  `url_archivo` varchar(255) NOT NULL,
  `es_principal` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact_phone`
--

DROP TABLE IF EXISTS `contact_phone`;
CREATE TABLE IF NOT EXISTS `contact_phone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_fiscales`
--

DROP TABLE IF EXISTS `datos_fiscales`;
CREATE TABLE IF NOT EXISTS `datos_fiscales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(100) DEFAULT NULL,
  `document_id` varchar(255) DEFAULT NULL,
  `document_type` varchar(255) DEFAULT NULL,
  `adress_prim_id` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_prim_id` int(11) DEFAULT NULL,
  `fix_phone` varchar(150) DEFAULT NULL,
  `movil_phone` varchar(100) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `url_logo` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elementos_web`
--

DROP TABLE IF EXISTS `elementos_web`;
CREATE TABLE IF NOT EXISTS `elementos_web` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_elemento` varchar(255) DEFAULT NULL,
  `ref_elemento_id` varchar(255) DEFAULT NULL,
  `ref_elemento_clase` varchar(255) DEFAULT NULL,
  `activo` int(11) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `es_banner` int(11) NOT NULL DEFAULT 0 COMMENT '0=No 1=Si',
  `lugar_web` varchar(255) DEFAULT NULL,
  `contenido` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `ref_elemento_id` (`ref_elemento_id`),
  KEY `ref_elemento_clase` (`ref_elemento_clase`),
  KEY `activo` (`activo`),
  KEY `titulo_elemento` (`titulo_elemento`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `elementos_web`
--

INSERT INTO `elementos_web` (`id`, `titulo_elemento`, `ref_elemento_id`, `ref_elemento_clase`, `activo`, `tipo`, `es_banner`, `lugar_web`, `contenido`, `created_at`, `updated_at`) VALUES
(1, 'TEXTO_LOGO_WEB', 'h1_logo_escritorio_portada', 'h1_logo_portada', 1, 'texto', 0, 'portada', 'TM-ESCAPADE', '2024-01-18 16:06:51', '2024-02-02 14:55:49'),
(2, 'URL_LOGO_WEB', 'img_logo_escritorio_portada', 'img_logo_portada', 1, 'img', 0, 'portada', '../../assets/images/logo.png', '2024-01-18 16:08:58', '2024-01-19 09:08:25'),
(3, 'CAROUSEL_PORTADA_TITULO_1', 'texto_banner_taital_1', 'banner_taital', 1, 'texto', 0, 'portada', 'MARRAKECH', '2024-01-18 16:11:39', '2024-01-19 09:08:24'),
(4, 'CAROUSEL_PORTADA_TITULO_2', 'texto_banner_taital_2', 'banner_taital', 1, 'texto', 0, 'portada', 'MARRUECOS', '2024-01-18 16:12:42', '2024-01-19 09:08:23'),
(5, 'CAROUSEL_PORTADA_TITULO_3', 'texto_banner_taital_3', 'banner_taital', 1, 'texto', 0, 'portada', 'SAHARA', '2024-01-18 16:13:14', '2024-01-19 09:08:22'),
(6, 'CAROUSEL_PORTADA_DESCRIPCION_1', 'texto_banner_text_1', 'banner_text', 1, 'texto', 0, 'portada', 'Explora la magia de Marrakech: tu acceso a experiencias únicas e inolvidables.', '2024-01-18 16:14:31', '2024-02-02 11:21:23'),
(7, 'CAROUSEL_PORTADA_DESCRIPCION_2', 'texto_banner_text_2', 'banner_text', 1, 'texto', 0, 'portada', 'Explora Marruecos: Sumérgete en la Belleza, Cultura y Misterio de un Destino Excepcional', '2024-01-18 16:15:00', '2024-01-19 09:08:19'),
(8, 'CAROUSEL_PORTADA_DESCRIPCION_3', 'texto_banner_text_3', 'banner_text', 1, 'texto', 0, 'portada', 'Vive la Magia del Desierto: Descubre la Aventura Inolvidable del Sahara....', '2024-01-18 16:15:49', '2024-01-19 09:08:18'),
(9, 'TITULO_SERVICIOS_PORTADA', 'titulo_servicios_portada', 'services_taital', 1, 'texto', 0, 'portada', 'VIAJES DE LUJO', '2024-01-18 17:14:02', '2024-01-19 09:08:17'),
(10, 'DESCRIPCION_SERVICIO_1_PORTADA', 'descripcion_servicios_1_portada', 'services_text', 1, 'texto', 0, 'portada', 'Descubre una experiencia única con nuestros servicios de lujo en \"TM-ESCAPADAS\". Desde paquetes exclusivos hasta destinos elegantes, te ofrecemos aventuras curadas, rutas premium y escapadas sofisticadas. Nuestros tours exclusivos y travesías especiales te llevan a destinos distinguidos, brindándote experiencias elevadas y personalizadas. Con \"TM-ESCAPADAS\", cada viaje se convierte en una aventura atemporal, donde la distinción y la elegancia se fusionan para ofrecerte lo mejor en viajes de lujo. ¡Explora la diferencia con \"TM-ESCAPADAS\" y descubre la excelencia en cada servicio!', '2024-01-18 17:20:04', '2024-01-19 09:08:16'),
(11, 'TITULO_SERCICIO_1_PORTADA', 'titulo_primer_servicio_portada', 'titulo_primer_servicio_portada', 1, 'texto', 0, 'portada', 'Servicio 1', '2024-01-19 08:05:12', '2024-01-19 09:23:04'),
(12, 'TITULO_SERCICIO_2_PORTADA', 'titulo_segundo_servicio_portada', 'titulo_segundo_servicio_portada', 1, 'texto', 0, 'portada', 'Servicio 2', '2024-01-19 08:18:49', '2024-01-19 09:22:43'),
(13, 'TITULO_SERCICIO_3_PORTADA', 'titulo_tercer_servicio_portada', 'titulo_tercer_servicio_portada', 1, 'texto', 0, 'portada', 'Servicio 4', '2024-01-19 08:21:11', '2024-01-22 14:00:51'),
(15, 'IMAGEN_PRIMER_SERVICIO_PORTADA', 'img_portada_servicio_1', 'services_img', 0, 'img', 0, 'blog', '/admin/uploads/imgs/1705925538_65ae5ba214f01_m_7.jpg', '2024-01-22 13:12:18', '2024-01-22 14:01:02'),
(16, 'IMAGEN_SEGUNDO_SERVICIO_PORTADA', 'img_portada_servicio_2', 'services_img', 0, 'img', 0, 'portada', '/admin/uploads/imgs/1705925619_65ae5bf33ff13_m_9.jpg', '2024-01-22 13:13:39', '2024-01-22 13:13:39'),
(18, 'IMAGEN_TERCER_SERVICIO_PORTADA', 'img_portada_servicio_3', 'services_img', 0, 'img', 0, 'portada', '/admin/uploads/imgs/m_7.jpg_1705928298_65ae666ae820d', '2024-01-22 13:15:26', '2024-01-22 14:51:37'),
(19, 'TITILO_SECCION_EXPERIENCIAS_PORTADA_1', 'titulo_experiencias_1', 'titulo_experiencias_1', 0, 'texto', 0, 'portada', 'Experiencias de Viaje Exclusivas', '2024-01-22 14:58:33', '2024-01-22 14:58:33'),
(20, 'TEXTO_EXPERIENCIAS_PARRAFO_1_PORTADA', 'texto_experiencia_parrafo_1', 'about_text', 0, 'texto', 0, 'portada', 'Como un equipo apasionado especializado en la organización de experiencias de viaje y eventos exclusivos, nos dedicamos incansablemente a superar sus expectativas mediante la introducción de ideas innovadoras y conceptos originales.', '2024-01-22 15:00:37', '2024-01-22 15:00:37'),
(21, 'TEXTO_EXPERIENCIAS_PARRAFO_2_PORTADA', 'texto_experiencia_parrafo_2', 'about_text', 0, 'texto', 0, 'portada', 'En nuestra visión, el logro supremo de nuestra misión radica en la combinación perfecta entre <strong>satisfacción excepcional</strong> y <strong>asombro genuino</strong>. Abrazamos una filosofía basada en:', '2024-01-22 15:01:20', '2024-01-22 15:14:18'),
(22, 'TEXTO_EXPERIENCIAS_PARRAFO_3_PORTADA', 'texto_lista_experiencias_portada', 'texto_lista_experiencias_portada', 0, 'texto', 0, 'portada', '<li>\n<strong>\nPersonalización Excepcional:\n</strong> \nAdoptamos un enfoque holístico para entender y satisfacer de manera única las necesidades y deseos de cada cliente.\n</li>\n<li>\n<strong>\nExcelencia Operativa:\n</strong> \nNos mantenemos en constante sintonía con las tendencias y requerimientos cambiantes, asegurándonos de ejecutar cada detalle con precisión y perfección.\n</li>\n<li>\n<strong>\nCompromiso con la Innovación:\n</strong>\n Comprometidos con la mejora continua, exploramos a fondo las maravillas del turismo marroquí, garantizando experiencias de viaje enriquecedoras y memorables.\n</li>\n<li>\n<strong>\nCalidad Inigualable:\n</strong>\n En la creación de nuestros productos, cultivamos la creatividad, seguimos las tendencias más actuales y nos esforzamos por innovar constantemente, asegurando la entrega de servicios que reflejan la máxima calidad y distinción. Con nosotros, cada viaje se transforma en una experiencia única e inolvidable.\n</li>', '2024-01-22 15:04:47', '2024-01-22 15:13:53'),
(23, 'IMAGEN_EXPERIENCIAS_1_PORTADA', 'img_experiencias_portada_1', 'about_img', 1, 'img', 0, 'portada', '/admin/uploads/imgs/1706614642_65b8df72cd02c_sahara_1.jpg', '2024-01-22 15:16:42', '2024-01-30 12:37:22'),
(24, 'ELEMENTO_CAROUSEL_ROTATIVO_VISTA_ABOUT_1', 'sobre_nosotros_elemento_carousel_rotativo_1', 'sobre_nosotros_elemento_carousel_rotativo_1', 0, 'texto', 0, 'sobre_nosotros', '<div class=\"container-fluid\">\r\n        <hr>\r\n\r\n        <div class=\"carousel_container\">\r\n            <div class=\"carousel_1\">\r\n                <div class=\"carousel_image_1\"><span class=\"carousel_span\"></span></div>\r\n                <div class=\"carousel_image_1\"><span class=\"carousel_span\"></span></div>\r\n                <div class=\"carousel_image_1\"><span class=\"carousel_span\"></span></div>\r\n                <div class=\"carousel_image_1\"><span class=\"carousel_span\"></span></div>\r\n                <div class=\"carousel_image_1\"><span class=\"carousel_span\"></span></div>\r\n                <div class=\"carousel_image_1\"><span class=\"carousel_span\"></span></div>\r\n                <div class=\"carousel_image_1\"><span class=\"carousel_span\"></span></div>\r\n                <div class=\"carousel_image_1\"><span class=\"carousel_span\"></span></div>\r\n                <div class=\"carousel_image_1\"><span class=\"carousel_span\"></span></div>\r\n            </div>\r\n        </div>\r\n    </div>', '2024-01-26 09:30:09', '2024-01-29 07:43:55'),
(25, 'ELEMENTO_CAROUSEL_VISTA_SERVICIOS_1', 'servicios_elemento_carousel_1', 'servicios_elemento_carousel_1', 1, 'texto', 0, 'servicios', '00', '2024-01-26 09:47:18', '2024-01-29 14:54:32'),
(26, 'ELEMENTO_HEADER_IMAGEN_BACKGROUND_ESCRITORIO', 'header_section_escritorio', 'header_section_escritorio', 1, 'img', 1, 'portada', '/admin/uploads/imgs/1706614389_65b8de756c8a8_marrak_1.jpg', '2024-01-29 10:30:46', '2024-01-30 12:33:09'),
(27, 'FORMULARIO CONTACTO', 'contenedor_formulario_cantato', 'contenedor_formulario_cantato', 1, 'texto', 0, 'servicios', '<style>\r\n    #name::placeholder {\r\n        font-size: 12px;\r\n    }\r\n\r\n    #email::placeholder {\r\n        font-size: 12px;\r\n    }\r\n\r\n    #phone::placeholder {\r\n        font-size: 12px;\r\n    }\r\n\r\n    #subject::placeholder {\r\n        font-size: 12px;\r\n    }\r\n\r\n    #message::placeholder {\r\n        font-size: 12px;\r\n    }\r\n\r\n    #fecha_ini::placeholder {\r\n        font-size: 12px;\r\n    }\r\n\r\n    #fecha_fin::placeholder {\r\n        font-size: 12px;\r\n    }\r\n\r\n    #asunto::placeholder {\r\n        font-size: 12px;\r\n    }\r\n\r\n    input[type=\"date\"] {\r\n        font-size: 12px;\r\n    }\r\n</style>\r\n\r\n<div class=\"contact_section\">\r\n    <?php if ($mensaje_enviar_email != \'\') : ?>\r\n        <div class=\"container mt-5\">\r\n            <div class=\"row\">\r\n                <div class=\"col-12\">\r\n                    <div class=\"alert <?= $email_error ? \'alert-danger\' : \'alert-success\' ?>\"><?= $mensaje_enviar_email ?></div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    <?php endif ?>\r\n    <section class=\"py-3 py-md-5 py-xl-8\">\r\n        <div class=\"container\">\r\n            <div class=\"row gy-4 gy-md-5 gy-lg-0 align-items-md-center\">\r\n                <div class=\"col-12 col-lg-6\">\r\n                    <div class=\"border overflow-hidden\">\r\n\r\n                        <form method=\"post\">\r\n                            <div class=\"row gy-4 gy-xl-5 p-4 p-xl-5\">\r\n                                <div class=\"col-12\">\r\n                                    <label for=\"name\" class=\"form-label\">Nombre completo | razon social <span class=\"text-danger\">*</span></label>\r\n                                    <input type=\"text\" class=\"form-control\" id=\"name\" placeholder=\"Nombre\" name=\"name\" required value=\"<?= $_POST[\'name\'] ?? \'\' ?>\">\r\n                                </div>\r\n                                <div class=\"col-12 col-md-6 \">\r\n                                    <label for=\"email\" class=\"form-label mt-2\">Email <span class=\"text-danger\">*</span></label>\r\n                                    <div class=\"input-group\">\r\n                                        <span class=\"input-group-text\">\r\n                                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-envelope\" viewBox=\"0 0 16 16\">\r\n                                                <path d=\"M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z\" />\r\n                                            </svg>\r\n                                        </span>\r\n                                        <input type=\"email\" class=\"form-control\" id=\"email\" placeholder=\"Correo Electrónico\" name=\"email\" required value=\"<?= $_POST[\'email\'] ?? \'\' ?>\">\r\n                                    </div>\r\n                                </div>\r\n                                <div class=\"col-12 col-md-6\">\r\n                                    <label for=\"phone\" class=\"form-label mt-2\">Teléfono</label>\r\n                                    <div class=\"input-group\">\r\n                                        <span class=\"input-group-text\">\r\n                                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-telephone\" viewBox=\"0 0 16 16\">\r\n                                                <path d=\"M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z\" />\r\n                                            </svg>\r\n                                        </span>\r\n                                        <input type=\"tel\" class=\"form-control\" id=\"phone\" placeholder=\"Número de Teléfono\" name=\"phone\" required value=\"<?= $_POST[\'phone\'] ?? \'\' ?>\">\r\n                                    </div>\r\n                                </div>\r\n                                <div class=\"col-12\">\r\n                                    <label for=\"asunto\" class=\"form-label mt-2\">Asunto <span class=\"text-danger\">*</span></label>\r\n                                    <input type=\"text\" class=\"form-control\" id=\"asunto\" name=\"asunto\" placeholder=\"Asunto\" required value=\"<?= $_POST[\'asunto\'] ?? \'\' ?>\">\r\n                                </div>\r\n                                <div class=\"col-12\">\r\n                                    <label for=\"message\" class=\"form-label mt-2\">Mensaje <span class=\"text-danger\">*</span></label>\r\n                                    <textarea class=\"form-control\" id=\"message\" rows=\"3\" id=\"comment\" name=\"message\" placeholder=\"Mensaje\" required><?= $_POST[\'message\'] ?? \'\' ?></textarea>\r\n                                </div>\r\n\r\n                                <div class=\"col-12\">\r\n                                    <hr>\r\n                                    <label for=\"\" class=\"form-label mt-2\">Escoger fechas<span class=\"text-danger\">:</span></label>\r\n\r\n                                </div>\r\n                                <div class=\"col-xl-6 col-md-6 col-sm-12\">\r\n                                    <label for=\"fecha_desde\" class=\"form-label mt-2\">Desde<span class=\"text-danger\"></span></label>\r\n                                    <input type=\"date\" class=\"form-control\" placeholder=\"\" id=\"fecha_desde\" name=\"fecha_desde\" value=\"<?= $_POST[\'fecha_ini\'] ?? \'\' ?>\">\r\n                                </div>\r\n                                <div class=\"col-xl-6 col-md-6 col-sm-12\">\r\n                                    <label for=\"fecha_hasta\" class=\"form-label mt-2\">Hasta<span class=\"text-danger\"></span></label>\r\n                                    <input type=\"date\" class=\"form-control\" placeholder=\"\" id=\"fecha_hasta\" name=\"fecha_hasta\" value=\"<?= $_POST[\'fecha_fin\'] ?? \'\' ?>\">\r\n                                </div>\r\n                                <div class=\"col-12 mt-3\">\r\n                                    <hr>\r\n                                    <div class=\"d-grid\">\r\n                                        <button class=\"btn btn-success btn-sm\" style=\"width:150px;border-radius:unset !important\" type=\"submit\" name=\"enviar_email\">Enviar</button>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </form>\r\n\r\n                    </div>\r\n                </div>\r\n                <div class=\"col-12 col-lg-6\">\r\n                    <div class=\"row justify-content-xl-center\">\r\n                        <div class=\"col-12 col-xl-11\">\r\n                            <div class=\"row mb-sm-4 mb-md-5 mt-5\">\r\n                                <div class=\"col-12 col-sm-6\">\r\n                                    <div class=\"mb-4 mb-sm-0\">\r\n                                        <div class=\"mb-3 text-primary\">\r\n                                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"32\" height=\"32\" fill=\"currentColor\" class=\"bi bi-telephone-outbound\" viewBox=\"0 0 16 16\">\r\n                                                <path d=\"M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5z\" />\r\n                                            </svg>\r\n                                        </div>\r\n                                        <div>\r\n                                            <h4 class=\"mb-2\">Teléfono</h4>\r\n                                            <p class=\"mb-2\">Puede llamarnos directamente.</p>\r\n                                            <hr class=\"w-75 mb-3 border-dark-subtle\">\r\n                                            <p class=\"mb-0\">\r\n                                                <a class=\"link-secondary text-decoration-none\" href=\"tel:+34670645462\">(+34) 670645462</a>\r\n                                            </p>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                                <div class=\"col-12 col-sm-6\">\r\n                                    <div class=\"mb-4 mb-sm-0\">\r\n                                        <div class=\"mb-3 text-primary\">\r\n                                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"32\" height=\"32\" fill=\"currentColor\" class=\"bi bi-envelope-at\" viewBox=\"0 0 16 16\">\r\n                                                <path d=\"M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z\" />\r\n                                                <path d=\"M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z\" />\r\n                                            </svg>\r\n                                        </div>\r\n                                        <div>\r\n                                            <h4 class=\"mb-2\">Email</h4>\r\n                                            <p class=\"mb-2\">O si prefiere puede escribirnos.</p>\r\n                                            <hr class=\"w-75 mb-3 border-dark-subtle\">\r\n                                            <p class=\"mb-0\">\r\n                                                <a class=\"link-secondary text-decoration-none\" href=\"mailto:info@tmescapade.com\">info@tmescapade.com</a>\r\n                                            </p>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                            <div>\r\n                                <div class=\"mb-3 text-primary\">\r\n                                    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"32\" height=\"32\" fill=\"currentColor\" class=\"bi bi-alarm\" viewBox=\"0 0 16 16\">\r\n                                        <path d=\"M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5z\" />\r\n                                        <path d=\"M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z\" />\r\n                                    </svg>\r\n                                </div>\r\n                                <div>\r\n                                    <h4 class=\"mb-2\">Nuestro horario</h4>\r\n                                    <p class=\"mb-2\">Explore nuestras horas de atención comercial.</p>\r\n                                    <hr class=\"w-50 mb-3 border-dark-subtle\">\r\n                                    <div class=\"d-flex mb-1\">\r\n                                        <p class=\"text-secondary fw-bold mb-0 me-5\">Lun - Vie</p>\r\n                                        <p class=\"text-secondary mb-0\">9am - 5pm</p>\r\n                                    </div>\r\n                                    <div class=\"d-flex\">\r\n                                        <p class=\"text-secondary fw-bold mb-0 me-5\">Sab - Dom</p>\r\n                                        <p class=\"text-secondary mb-0\">9am - 2pm</p>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </section>\r\n</div>', '2024-02-14 12:16:53', '2024-02-14 12:21:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_suscripciones`
--

DROP TABLE IF EXISTS `email_suscripciones`;
CREATE TABLE IF NOT EXISTS `email_suscripciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `activo` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

DROP TABLE IF EXISTS `favoritos`;
CREATE TABLE IF NOT EXISTS `favoritos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `es_favorito` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_servs_incluidos`
--

DROP TABLE IF EXISTS `info_servs_incluidos`;
CREATE TABLE IF NOT EXISTS `info_servs_incluidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `incluido_id` int(11) DEFAULT NULL,
  `servicio_id` int(11) DEFAULT NULL,
  `complemento_id` int(11) DEFAULT NULL,
  `es_incluido` int(11) DEFAULT NULL,
  `mostrar_en_web` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itinerarios`
--

DROP TABLE IF EXISTS `itinerarios`;
CREATE TABLE IF NOT EXISTS `itinerarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `info_dia` varchar(100) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `imagen` varchar(255) DEFAULT NULL,
  `icono` varchar(255) DEFAULT NULL,
  `incluido` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`incluido`)),
  `no_inlcuido` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`no_inlcuido`)),
  `observaciones` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `referencia_producto` varchar(255) NOT NULL,
  `id_producto_stripe` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `url_imagen_principal` varchar(255) NOT NULL,
  `descripcion_corta` text DEFAULT NULL,
  `descripcon_larga` text DEFAULT NULL,
  `descatalogado` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  `mostrar_en_web` int(11) NOT NULL,
  `marca` int(11) DEFAULT NULL,
  `ean` varchar(255) DEFAULT NULL,
  `stock_minimo` int(11) DEFAULT NULL,
  `precio_actual` decimal(10,2) NOT NULL,
  `precio_en_oferta` decimal(10,2) DEFAULT NULL,
  `precio_pvr` decimal(10,2) DEFAULT NULL,
  `precio_coste` decimal(10,2) NOT NULL,
  `en_oferta` int(11) NOT NULL,
  `ranking` int(11) DEFAULT NULL,
  `producto_destacado` int(11) NOT NULL,
  `ventas_7` int(11) DEFAULT NULL,
  `ventas_30` int(11) DEFAULT NULL,
  `ventas_365` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_categoria`
--

DROP TABLE IF EXISTS `productos_categoria`;
CREATE TABLE IF NOT EXISTS `productos_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_servicios`
--

DROP TABLE IF EXISTS `productos_servicios`;
CREATE TABLE IF NOT EXISTS `productos_servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_servicio` varchar(255) NOT NULL,
  `duracion` int(11) DEFAULT NULL,
  `fecha_ini` datetime DEFAULT current_timestamp(),
  `fecha_fin` datetime DEFAULT current_timestamp(),
  `servicio_tipo` varchar(100) NOT NULL,
  `url_img_landing` varchar(255) DEFAULT NULL,
  `particular_o_empresa` varchar(100) DEFAULT NULL,
  `servicio_titulo` varchar(100) NOT NULL,
  `servicio_titulo_largo` varchar(255) DEFAULT NULL,
  `servicio_descripcion` text NOT NULL,
  `descripcion_dos` text DEFAULT NULL,
  `descripcion_tres` text DEFAULT NULL,
  `itinerario_completo` text DEFAULT NULL,
  `precio_servicio` decimal(10,2) DEFAULT NULL,
  `porcentaje` decimal(10,2) DEFAULT NULL,
  `precio_a_adelantar` decimal(10,2) DEFAULT NULL,
  `estado` int(11) NOT NULL COMMENT '0:No-activo 1:Activo',
  `mostrar_en_web` int(11) NOT NULL,
  `mostrar_precio` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_media`
--

DROP TABLE IF EXISTS `producto_media`;
CREATE TABLE IF NOT EXISTS `producto_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `url_media` varchar(255) NOT NULL,
  `tipo_media` varchar(100) DEFAULT NULL,
  `es_principal` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_stock`
--

DROP TABLE IF EXISTS `producto_stock`;
CREATE TABLE IF NOT EXISTS `producto_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products_info`
--

DROP TABLE IF EXISTS `products_info`;
CREATE TABLE IF NOT EXISTS `products_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pr_servicio_id` int(11) NOT NULL,
  `pr_tipo` varchar(100) DEFAULT NULL,
  `pr_titulo` varchar(100) NOT NULL,
  `pr_descripcion` text NOT NULL,
  `pr_activo` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `adress_prim_id` int(11) DEFAULT NULL,
  `phone_prim_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE IF NOT EXISTS `proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor_nombre` varchar(150) DEFAULT NULL,
  `tipo_documento` varchar(100) DEFAULT NULL,
  `documento` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `tipo_via` varchar(100) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `numero` varchar(50) DEFAULT NULL,
  `piso` varchar(50) DEFAULT NULL,
  `puerta` varchar(50) DEFAULT NULL,
  `cp` varchar(50) DEFAULT NULL,
  `municipio` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_complemento`
--

DROP TABLE IF EXISTS `servicio_complemento`;
CREATE TABLE IF NOT EXISTS `servicio_complemento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complemento_id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `es_oferta` int(11) NOT NULL,
  `mostrar_en_web` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_itinerario`
--

DROP TABLE IF EXISTS `servicio_itinerario`;
CREATE TABLE IF NOT EXISTS `servicio_itinerario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `servicio_id` int(11) NOT NULL,
  `itinerario_id` int(11) NOT NULL,
  `activo` int(11) DEFAULT NULL,
  `mostrar` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_media`
--

DROP TABLE IF EXISTS `servicio_media`;
CREATE TABLE IF NOT EXISTS `servicio_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `servicio_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `es_principal` int(11) NOT NULL COMMENT '0:No 1;Si',
  `estado` int(11) NOT NULL COMMENT '0:No-activo 1:Activo',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_historico`
--

DROP TABLE IF EXISTS `stock_historico`;
CREATE TABLE IF NOT EXISTS `stock_historico` (
  `id` int(11) DEFAULT NULL,
  `producto_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_incluidos`
--

DROP TABLE IF EXISTS `tabla_incluidos`;
CREATE TABLE IF NOT EXISTS `tabla_incluidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `url_icono` varchar(255) DEFAULT NULL,
  `mostrar_para_seleccionar` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimonios`
--

DROP TABLE IF EXISTS `testimonios`;
CREATE TABLE IF NOT EXISTS `testimonios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `activo` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `testimonios`
--

INSERT INTO `testimonios` (`id`, `nombre`, `tipo`, `texto`, `activo`, `created_at`) VALUES
(1, 'Jose luis', 'Cliente', 'Viajar con esta agencia fue un placer. Su atención personalizada y opciones flexibles hicieron que mi viaje fuera inolvidable. ¡Altamente recomendados!', 1, '2024-01-22 15:31:28'),
(2, 'Maria', 'Cliente', 'Experiencia inigualable con la agencia. Organización impecable, destinos fascinantes y un equipo comprometido. ¡La elección perfecta para tus aventuras', 1, '2024-01-22 15:31:28'),
(3, 'Josefina', 'Cliente', 'Servicio excepcional, destinos asombrosos y atención personalizada. ¡Recomiendo esta experiencia única', 1, '2024-01-22 15:32:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`roles`)),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
