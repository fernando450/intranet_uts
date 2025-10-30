-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2025 a las 05:01:41
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
-- Base de datos: `intranet_uts`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `additional_titles`
--

CREATE TABLE `additional_titles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(250) NOT NULL,
  `institution` varchar(250) NOT NULL,
  `graduation_year` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `additional_titles`
--

INSERT INTO `additional_titles` (`id`, `teacher_id`, `title`, `institution`, `graduation_year`, `created_at`, `updated_at`) VALUES
(22, 8, 'Tecnologo Sistemas', 'UTS', '2023-02-20', '2025-10-29 07:20:12', '2025-10-29 07:20:12'),
(23, 8, 'Ingeniero en sistemas', 'UTS', '2024-10-07', '2025-10-29 07:20:12', '2025-10-29 07:20:12'),
(24, 8, 'Tecnico Sistemas', 'SENA', '2019-10-28', '2025-10-29 07:20:12', '2025-10-29 07:20:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-falmeidar@utd.edu.co|192.168.1.29', 'i:1;', 1760363004),
('laravel-cache-falmeidar@utd.edu.co|192.168.1.29:timer', 'i:1760363004;', 1760363004),
('laravel-cache-falmeidar@uts.edu.co|192.168.1.29:timer', 'i:1760201764;', 1760201764),
('laravel-cache-falmeidar@uts.edu.com|192.168.1.29', 'i:1;', 1760202020),
('laravel-cache-falmeidar@uts.edu.com|192.168.1.29:timer', 'i:1760202020;', 1760202020),
('laravel-cache-fernandoalmeida@ghmail.com|192.168.1.29', 'i:1;', 1760202115),
('laravel-cache-fernandoalmeida@ghmail.com|192.168.1.29:timer', 'i:1760202115;', 1760202115);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `new_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files_new`
--

CREATE TABLE `files_new` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `new_id` bigint(20) UNSIGNED NOT NULL,
  `file_route` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `files_new`
--

INSERT INTO `files_new` (`id`, `new_id`, `file_route`, `created_at`, `updated_at`) VALUES
(17, 13, 'news/07-10-2025/images/imagen_0_1759869121.jpeg', '2025-10-08 01:32:01', '2025-10-08 01:32:01'),
(18, 13, 'news/07-10-2025/images/imagen_1_1759869121.jpeg', '2025-10-08 01:32:01', '2025-10-08 01:32:01'),
(19, 13, 'news/07-10-2025/images/imagen_2_1759869121.jpeg', '2025-10-08 01:32:01', '2025-10-08 01:32:01'),
(20, 13, 'news/07-10-2025/images/imagen_3_1759869121.jpeg', '2025-10-08 01:32:01', '2025-10-08 01:32:01'),
(25, 14, 'news/07-10-2025/images/imagen_0_1759872876.png', '2025-10-08 02:34:36', '2025-10-08 02:34:36'),
(26, 14, 'news/07-10-2025/images/imagen_1_1759872876.jpeg', '2025-10-08 02:34:36', '2025-10-08 02:34:36'),
(27, 14, 'news/07-10-2025/images/imagen_2_1759872876.jpeg', '2025-10-08 02:34:36', '2025-10-08 02:34:36'),
(28, 14, 'news/07-10-2025/images/imagen_3_1759872876.jpg', '2025-10-08 02:34:36', '2025-10-08 02:34:36'),
(29, 15, 'news/08-10-2025/images/imagen_0_1759929497.png', '2025-10-08 18:18:19', '2025-10-08 18:18:19'),
(30, 15, 'news/08-10-2025/images/imagen_1_1759929499.png', '2025-10-08 18:18:19', '2025-10-08 18:18:19'),
(31, 15, 'news/08-10-2025/images/imagen_2_1759929499.png', '2025-10-08 18:18:19', '2025-10-08 18:18:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(36, '0001_01_01_000000_create_users_table', 1),
(37, '0001_01_01_000001_create_cache_table', 1),
(38, '0001_01_01_000002_create_jobs_table', 1),
(39, '2025_08_23_150732_create_permission_tables', 1),
(40, '2025_09_29_213025_create_news_table', 1),
(41, '2025_09_29_213139_create_comments_table', 1),
(42, '2025_09_29_213458_create_files_new_table', 1),
(47, '2025_10_15_144052_create_teachers_table', 2),
(48, '2025_10_16_142007_create_additional_titles_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  `profile` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `news`
--

INSERT INTO `news` (`id`, `title`, `subtitle`, `description`, `expiration_date`, `state`, `profile`, `link`, `created_at`, `updated_at`) VALUES
(13, 'por La Silla Vacía', 'Se cayó medida cautelar que permitía la consulta del Pacto Histórico', 'El Tribunal Superior de Bogotá echó para atrás una medida cautelar que le daba vida jurídica a la consulta interna del Pacto Histórico que estaba prevista para el 26 de octubre. O sea, la elección del al aspirante presidencial entre Carolina Corcho, Iván Cepeda y Daniel Quintero vuelve a quedar en el limbo.\r\n\r\nLa decisión del Tribunal negó una tutela que presentaron Corcho y Gustavo Bolívar el 25 de septiembre contra la decisión del Consejo Nacional Electoral (CNE) de aceptar la fusión del Pacto dejando por fuera a la Colombia Humana, el partido del presidente Petro; a Progresistas, liderado por la senadora María José Pizarro; y a la Minga Social, la organización que agrupa al movimiento indígena.', '2025-10-23', 1, 'Docente', 'https://www.youtube.com/watch?v=h87tiHTuxc8&list=RDh87tiHTuxc8&start_radio=1', '2025-10-08 01:32:01', '2025-10-08 01:32:01'),
(14, 'La Silla Vacía', 'Margarita Guerra será la candidata de Caicedo en Magdalena', 'Tras la destitución de Rafael Martínez, el movimiento Fuerza Ciudadana de Carlos Caicedo ya tiene candidata para las elecciones atípicas. Se trata de Margarita Guerra, exdiputada de ese movimiento, quien hace unos días había renunciado a su curul en la Asamblea para lanzarse.\r\n\r\nSin embargo, Guerra se inscribirá por el Partido Ecologista y no por Fuerza Ciudadana, que perdió su personería jurídica. \r\n\r\nLa mala hora del movimiento de Caicedo. Carlos Caicedo fue alcalde de Santa Marta y gobernador de Magdalena. Con su movimiento Fuerza Ciudadana logró consolidar uno de los fortines políticos más fuertes de ese departamento. Sin embargo, a pesar de que su movimiento volvió a ganar la Alcaldía y la Gobernación, decisiones judiciales tumbaron a los ganadores.', '2025-10-24', 1, 'Egresado', 'https://www.lasillavacia.com/en-vivo/margarita-guerra-sera-la-candidata-de-caicedo-en-magdalena/', '2025-10-08 02:11:42', '2025-10-08 02:11:42'),
(15, 'Facturación empresarial simplificada', 'Software fácil de usar para facturación empresarial, con cumplimiento DIAN y soporte dedicado.', '4 Usuarios\r\nFacturación ilimitada\r\nManejo de caja y movimientos\r\nDashboard y estadísticas\r\nMódulo de ventas\r\nMódulo de productos\r\nMódulo de adicionales\r\nApartados y servicios\r\nClientes y reportes\r\nProveedores y compras\r\nCategorización de productos\r\nGestión de créditos\r\nMódulo de cuentas por cobrar\r\nSoporte 24/7', '2025-10-23', 1, 'Estudiante', 'https://puntofactura.com/inicio', '2025-10-08 18:18:17', '2025-10-08 18:18:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create-role', 'web', '2025-09-30 03:18:21', '2025-09-30 03:18:21'),
(2, 'create-user', 'web', '2025-09-30 03:18:34', '2025-09-30 03:18:34'),
(3, 'create-permission', 'web', '2025-09-30 03:19:04', '2025-09-30 03:19:04'),
(4, 'edit-permission', 'web', '2025-09-30 03:19:16', '2025-09-30 03:19:16'),
(5, 'edit-user', 'web', '2025-09-30 03:19:25', '2025-09-30 03:19:25'),
(6, 'edit-role', 'web', '2025-09-30 03:19:32', '2025-09-30 03:19:32'),
(7, 'delete-permission', 'web', '2025-09-30 03:19:48', '2025-09-30 03:19:48'),
(8, 'delete-user', 'web', '2025-09-30 03:19:58', '2025-09-30 03:19:58'),
(9, 'delete-role', 'web', '2025-09-30 03:20:08', '2025-09-30 03:20:08'),
(10, 'list-role', 'web', '2025-09-30 03:20:35', '2025-09-30 03:20:35'),
(11, 'list-user', 'web', '2025-09-30 03:20:44', '2025-09-30 03:20:44'),
(12, 'list-permission', 'web', '2025-09-30 03:21:04', '2025-09-30 03:21:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'web', '2025-09-30 03:16:01', '2025-09-30 03:16:01'),
(2, 'Estudiante', 'web', '2025-09-30 03:16:11', '2025-09-30 03:21:59'),
(3, 'Docente', 'web', '2025-09-30 03:16:34', '2025-09-30 03:16:34'),
(4, 'Egresado', 'web', '2025-09-30 03:16:49', '2025-09-30 03:16:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(11, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1gOpCFH8yFzHIF14HCBjuumaJ5I7ZQbw7ZQlLkHe', 3, '192.168.1.29', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoidm14WTFGb3Zvbjk5TERydXY1a2xBdURuUEIwMTY5bmdwYmFxVHhNUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xOTIuMTY4LjEuMjk6ODAwMC91c2VyLXByb2ZpbGUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1761704598);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `professional_title` varchar(255) DEFAULT NULL,
  `research_lines` text DEFAULT NULL,
  `linking_type` varchar(255) DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  `assigned_subjects` text DEFAULT NULL,
  `second_email` varchar(255) DEFAULT NULL,
  `second_phone` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `professional_title`, `research_lines`, `linking_type`, `state`, `assigned_subjects`, `second_email`, `second_phone`, `linkedin`, `created_at`, `updated_at`) VALUES
(8, 3, 'Ingeniero fernando', 'Azul, Rosa', '2', 1, 'Matematicas Discretas, Ingles I, Ingles II', 'juanfelipe@gmail.com', '3126457895', 'https://www.youtube.com/watch?v=vNR-vEvj7_0&list=RDKF3HP_MdUl0&index=10', '2025-10-19 19:45:24', '2025-10-29 07:23:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `document_number` varchar(255) NOT NULL,
  `contact_number` bigint(20) NOT NULL,
  `state` varchar(255) NOT NULL,
  `avatar_route` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type_profile` varchar(250) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `document_number`, `contact_number`, `state`, `avatar_route`, `email_verified_at`, `password`, `type_profile`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Fernando Almeida Rojas', 'falmeidar@uts.edu.co', '1192747483', 3133882618, 'Activo', NULL, NULL, '$2y$12$HztS7SQEuna8ENyII2D36uLD5Orp7aJ1lD2fvDcspSrkEDuy5Ta5K', '', NULL, '2025-09-30 03:15:35', '2025-09-30 03:15:35'),
(2, 'Yury Alejandra Arias Quiroga', 'yuryaarias@uts.edu.co', '100280002', 3182105456, 'Activo', NULL, NULL, '$2y$12$N5Pxd93R8I4BfVogQDAbJ.4t/m3Jn5Nv/QTag7mkw/NL1lPx2Q8lW', 'Estudiante', NULL, '2025-10-11 21:48:00', '2025-10-11 21:48:00'),
(3, 'Juan Felipe Quintana Roska', 'juanfe@uts.edu.co', '142536968', 3142513536, 'Activo', NULL, NULL, '$2y$12$ZZ8m0z5BeV/vOtAdF6yGZOJM52BLO5soNWJw4VaSe3x5X571UACee', 'Docente', NULL, '2025-10-16 00:51:03', '2025-10-16 03:16:43');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `additional_titles`
--
ALTER TABLE `additional_titles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `additional_titles_teacher_id_foreign` (`teacher_id`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_new_id_foreign` (`new_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `files_new`
--
ALTER TABLE `files_new`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_new_new_id_foreign` (`new_id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teachers_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `additional_titles`
--
ALTER TABLE `additional_titles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `files_new`
--
ALTER TABLE `files_new`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `additional_titles`
--
ALTER TABLE `additional_titles`
  ADD CONSTRAINT `additional_titles_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_new_id_foreign` FOREIGN KEY (`new_id`) REFERENCES `news` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `files_new`
--
ALTER TABLE `files_new`
  ADD CONSTRAINT `files_new_new_id_foreign` FOREIGN KEY (`new_id`) REFERENCES `news` (`id`);

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
