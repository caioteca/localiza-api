-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           10.4.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for localiza
DROP DATABASE IF EXISTS `localiza`;
CREATE DATABASE IF NOT EXISTS `localiza` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `localiza`;

-- Dumping structure for table localiza.atm_bombas
DROP TABLE IF EXISTS `atm_bombas`;
CREATE TABLE IF NOT EXISTS `atm_bombas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table localiza.atm_bombas: ~3 rows (approximately)
/*!40000 ALTER TABLE `atm_bombas` DISABLE KEYS */;
INSERT INTO `atm_bombas` (`id`, `location`, `latitude`, `longitude`, `type`, `status`, `created_at`, `updated_at`) VALUES
	(2, '1', '2', '3', 'atm', 1, '2022-12-09 18:23:51', '2022-11-30 19:09:51'),
	(3, 'Morro Bento', '2', '3', 'bomba', 1, '2022-11-30 21:47:30', '2022-11-30 19:29:06');
/*!40000 ALTER TABLE `atm_bombas` ENABLE KEYS */;

-- Dumping structure for table localiza.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table localiza.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table localiza.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table localiza.migrations: ~5 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(11, '2022_11_30_140416_create_atm_bomba_table', 8),
	(12, '2022_12_03_140958_create_sugestoes_table', 9);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table localiza.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table localiza.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table localiza.pontos_user
DROP TABLE IF EXISTS `pontos_user`;
CREATE TABLE IF NOT EXISTS `pontos_user` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `id_ponto` int(100) DEFAULT NULL,
  `id_user` int(100) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table localiza.pontos_user: ~0 rows (approximately)
/*!40000 ALTER TABLE `pontos_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `pontos_user` ENABLE KEYS */;

-- Dumping structure for table localiza.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nome_role` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table localiza.roles: 3 rows
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id_role`, `nome_role`) VALUES
	(1, 'Admin'),
	(2, 'Informer'),
	(3, 'User');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table localiza.sugestoes
DROP TABLE IF EXISTS `sugestoes`;
CREATE TABLE IF NOT EXISTS `sugestoes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sugestao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table localiza.sugestoes: ~3 rows (approximately)
/*!40000 ALTER TABLE `sugestoes` DISABLE KEYS */;
INSERT INTO `sugestoes` (`id`, `sugestao`, `type`, `id_user`, `created_at`, `updated_at`) VALUES
	(1, '123', 'sugestao', 1, '2022-12-03 14:32:48', '2022-12-03 14:32:48'),
	(2, '1010', 'reclamacao', 2, '2022-12-03 14:33:46', '2022-12-03 14:33:46'),
	(3, 'teste', 'teste', 3, '2022-12-03 14:35:22', '2022-12-03 14:35:22');
/*!40000 ALTER TABLE `sugestoes` ENABLE KEYS */;

-- Dumping structure for table localiza.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` int(11) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `endereco` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table localiza.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `telefone`, `email_verified_at`, `password`, `role`, `endereco`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
	(6, 'Usuario', 'teste@gmail.com', 930471528, NULL, '$2y$10$VGfb.nL7MiTjJw7X/PaUjOWlSbBG31aF/w3RE4fAoGVKi/ZzVTN7.', 3, NULL, 1, NULL, '2022-11-14 19:05:04', '2022-11-30 16:06:43'),
	(7, 'Admin', 'admin@gmail.com', 996630477, NULL, '$2y$10$VGfb.nL7MiTjJw7X/PaUjOWlSbBG31aF/w3RE4fAoGVKi/ZzVTN7.', 1, NULL, 1, NULL, '2022-12-02 14:50:27', '2022-12-02 14:50:25'),
	(8, 'Informer', 'info@gmail.com', 123456789, NULL, '$2y$10$VGfb.nL7MiTjJw7X/PaUjOWlSbBG31aF/w3RE4fAoGVKi/ZzVTN7.', 2, NULL, 1, NULL, '2022-12-02 14:51:27', '2022-12-02 14:51:29');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
