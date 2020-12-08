-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2019 at 01:21 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_erp_rtl`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user_id`, `username`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 10, 'admin', 'user_logout', 'logout', '2019-08-19 06:59:11', '2019-08-19 06:59:11'),
(2, 10, 'admin', 'user_login', 'login', '2019-08-19 06:59:22', '2019-08-19 06:59:22'),
(3, 10, 'admin', 'create_office', '36', '2019-08-19 06:59:56', '2019-08-19 06:59:56'),
(4, 10, 'admin', 'office_status_update', '{\"office_id\":36,\"status\":\"2\"}', '2019-08-19 07:00:01', '2019-08-19 07:00:01'),
(5, 10, 'admin', 'office_status_update', '{\"office_id\":36,\"status\":\"1\"}', '2019-08-19 07:00:03', '2019-08-19 07:00:03'),
(9, 10, 'admin', 'update_office', 'O:11:\"App\\Offices\":27:{s:8:\"\0*\0table\";s:7:\"offices\";s:10:\"timestamps\";b:1;s:10:\"\0*\0guarded\";a:0:{}s:8:\"\0*\0dates\";a:2:{i:0;s:10:\"deleted_at\";i:1;s:10:\"deleted_at\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:36;s:4:\"name\";s:9:\"testing-1\";s:4:\"city\";s:6:\"rajkot\";s:5:\"phone\";s:10:\"9874563210\";s:5:\"email\";s:17:\"testing@gmail.com\";s:11:\"office_type\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:10:\"deleted_at\";N;s:10:\"created_at\";s:19:\"2019-08-19 12:29:56\";s:10:\"updated_at\";s:19:\"2019-08-19 12:44:21\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:36;s:4:\"name\";s:9:\"testing-1\";s:4:\"city\";s:6:\"rajkot\";s:5:\"phone\";s:10:\"9874563210\";s:5:\"email\";s:17:\"testing@gmail.com\";s:11:\"office_type\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:10:\"deleted_at\";N;s:10:\"created_at\";s:19:\"2019-08-19 12:29:56\";s:10:\"updated_at\";s:19:\"2019-08-19 12:44:21\";}s:10:\"\0*\0changes\";a:2:{s:4:\"name\";s:9:\"testing-1\";s:10:\"updated_at\";s:19:\"2019-08-19 12:44:21\";}s:8:\"\0*\0casts\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:16:\"\0*\0forceDeleting\";b:0;}', '2019-08-19 07:14:21', '2019-08-19 07:14:21'),
(7, 10, 'admin', 'create_office', '37', '2019-08-19 07:06:44', '2019-08-19 07:06:44'),
(8, 10, 'admin', 'delete_office', '37', '2019-08-19 07:06:56', '2019-08-19 07:06:56'),
(10, 10, 'admin', 'update_office', 'a:6:{s:4:\"name\";s:9:\"testing-1\";s:4:\"city\";s:6:\"rajkot\";s:5:\"phone\";s:10:\"9874563210\";s:5:\"email\";s:17:\"testing@gmail.com\";s:11:\"office_type\";s:1:\"1\";s:6:\"status\";s:1:\"1\";}', '2019-08-19 07:17:19', '2019-08-19 07:17:19'),
(11, 10, 'admin', 'update_office', 'a:7:{s:4:\"name\";s:9:\"testing-1\";s:4:\"city\";s:6:\"rajkot\";s:5:\"phone\";s:10:\"9874563210\";s:5:\"email\";s:17:\"testing@gmail.com\";s:11:\"office_type\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:36;}', '2019-08-19 07:18:23', '2019-08-19 07:18:23'),
(12, 10, 'admin', 'user_status_update', '{\"user_id\":13,\"status\":\"1\"}', '2019-08-19 07:45:00', '2019-08-19 07:45:00'),
(13, 10, 'admin', 'update_user', 'a:2:{s:4:\"user\";a:5:{s:4:\"name\";s:7:\"testing\";s:8:\"username\";s:8:\"hellonew\";s:5:\"email\";s:20:\"testingnew@gmail.com\";s:7:\"role_id\";s:1:\"1\";s:2:\"id\";i:13;}s:9:\"user_data\";a:8:{s:6:\"gender\";s:4:\"male\";s:11:\"nationality\";s:7:\"testing\";s:13:\"qualification\";s:3:\"phd\";s:8:\"position\";s:7:\"testing\";s:16:\"passport_expired\";s:10:\"2019-08-24\";s:16:\"end_of_residence\";s:10:\"2019-08-17\";s:16:\"end_of_insurance\";s:10:\"2019-08-17\";s:6:\"salary\";s:3:\"250\";}}', '2019-08-19 07:47:29', '2019-08-19 07:47:29'),
(14, 10, 'admin', 'create_user', '15', '2019-08-19 07:48:44', '2019-08-19 07:48:44'),
(15, 10, 'admin', 'delete_user', '15', '2019-08-19 07:48:58', '2019-08-19 07:48:58'),
(16, 10, 'admin', 'create_status', '13', '2019-08-19 07:49:17', '2019-08-19 07:49:17'),
(17, 10, 'admin', 'update_status', 'a:2:{s:4:\"name\";s:13:\"helllldffsflo\";s:2:\"id\";i:13;}', '2019-08-19 07:49:34', '2019-08-19 07:49:34'),
(18, 10, 'admin', 'delete_status', '13', '2019-08-19 07:49:54', '2019-08-19 07:49:54'),
(19, 10, 'admin', 'create_country', '12', '2019-08-19 07:50:12', '2019-08-19 07:50:12'),
(20, 10, 'admin', 'update_country', 'a:2:{s:4:\"name\";s:13:\"testigdfgng-1\";s:2:\"id\";i:12;}', '2019-08-19 07:50:47', '2019-08-19 07:50:47'),
(21, 10, 'admin', 'user_login', 'login', '2019-08-19 08:06:47', '2019-08-19 08:06:47'),
(22, 10, 'admin', 'delete_user', '13', '2019-08-19 08:07:10', '2019-08-19 08:07:10'),
(23, 10, 'admin', 'user_login', 'login', '2019-08-19 08:54:01', '2019-08-19 08:54:01'),
(24, 10, 'admin', 'user_login', 'login', '2019-08-19 09:32:13', '2019-08-19 09:32:13'),
(25, 10, 'admin', 'office_status_update', '{\"office_id\":36,\"status\":\"1\"}', '2019-08-19 12:04:50', '2019-08-19 12:04:50'),
(26, 10, 'admin', 'office_status_update', '{\"office_id\":36,\"status\":\"1\"}', '2019-08-19 12:04:51', '2019-08-19 12:04:51'),
(27, 10, 'admin', 'office_status_update', '{\"office_id\":32,\"status\":\"1\"}', '2019-08-19 12:04:52', '2019-08-19 12:04:52'),
(28, 10, 'admin', 'office_status_update', '{\"office_id\":32,\"status\":\"1\"}', '2019-08-19 12:04:52', '2019-08-19 12:04:52'),
(29, 10, 'admin', 'create_cv', '1', '2019-08-19 12:42:42', '2019-08-19 12:42:42'),
(30, 10, 'admin', 'create_cv', '2', '2019-08-19 12:46:36', '2019-08-19 12:46:36'),
(31, 10, 'admin', 'cv_status_update', '{\"cv_id\":2,\"status\":\"2\"}', '2019-08-19 13:04:44', '2019-08-19 13:04:44'),
(32, 10, 'admin', 'cv_status_update', '{\"cv_id\":2,\"status\":\"1\"}', '2019-08-19 13:04:47', '2019-08-19 13:04:47'),
(33, 10, 'admin', 'cv_status_update', '{\"cv_id\":2,\"status\":\"2\"}', '2019-08-19 13:04:49', '2019-08-19 13:04:49'),
(34, 10, 'admin', 'delete_cv', '2', '2019-08-19 13:06:37', '2019-08-19 13:06:37'),
(35, 10, 'admin', 'delete_cv', '1', '2019-08-19 13:07:28', '2019-08-19 13:07:28'),
(36, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:9:\"987456321\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:1;}', '2019-08-19 13:27:05', '2019-08-19 13:27:05'),
(37, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:9:\"987456321\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:1;}', '2019-08-19 13:29:53', '2019-08-19 13:29:53'),
(38, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:9:\"987456321\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:1;}', '2019-08-19 13:30:49', '2019-08-19 13:30:49'),
(39, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:9:\"987456321\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:1;}', '2019-08-19 13:31:40', '2019-08-19 13:31:40'),
(40, 10, 'admin', 'create_cv', '3', '2019-08-19 13:33:20', '2019-08-19 13:33:20'),
(41, 10, 'admin', 'create_cv', '4', '2019-08-19 13:33:39', '2019-08-19 13:33:39'),
(42, 10, 'admin', 'create_cv', '5', '2019-08-19 13:34:41', '2019-08-19 13:34:41'),
(43, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9874563210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:5;}', '2019-08-19 13:38:16', '2019-08-19 13:38:16'),
(44, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9874563210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:5;}', '2019-08-19 13:38:24', '2019-08-19 13:38:24'),
(45, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9874563210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:5;}', '2019-08-19 13:39:26', '2019-08-19 13:39:26'),
(46, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9874563210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:5;}', '2019-08-19 13:40:05', '2019-08-19 13:40:05'),
(47, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9785463210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:4;}', '2019-08-19 13:40:27', '2019-08-19 13:40:27'),
(48, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9785463210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:4;}', '2019-08-19 13:40:48', '2019-08-19 13:40:48'),
(49, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9785463210\";s:11:\"reservation\";s:1:\"2\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:4;}', '2019-08-19 13:40:59', '2019-08-19 13:40:59'),
(50, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"35\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9874563210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:5;}', '2019-08-19 14:00:25', '2019-08-19 14:00:25'),
(51, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"35\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9874563210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:5;}', '2019-08-19 14:00:32', '2019-08-19 14:00:32'),
(52, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"35\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9874563210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:5;}', '2019-08-19 14:00:56', '2019-08-19 14:00:56'),
(53, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"35\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9874563210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:5;}', '2019-08-19 14:06:46', '2019-08-19 14:06:46'),
(54, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"35\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9874563210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:5;}', '2019-08-19 14:07:12', '2019-08-19 14:07:12'),
(55, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"35\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9874563210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:5;}', '2019-08-19 14:08:17', '2019-08-19 14:08:17'),
(56, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"35\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9874563210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:5;}', '2019-08-19 14:10:36', '2019-08-19 14:10:36'),
(57, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"35\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9874563210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:5;}', '2019-08-19 14:11:41', '2019-08-19 14:11:41'),
(58, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:11:\"nationality\";s:1:\"6\";s:8:\"religion\";s:7:\"testing\";s:3:\"age\";s:2:\"35\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9874563210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:5;}', '2019-08-19 14:11:49', '2019-08-19 14:11:49'),
(59, 10, 'admin', 'delete_cv', '5', '2019-08-19 14:15:45', '2019-08-19 14:15:45'),
(60, 10, 'admin', 'user_login', 'login', '2019-08-20 05:16:51', '2019-08-20 05:16:51'),
(61, 10, 'admin', 'create_customer', '1', '2019-08-20 06:33:22', '2019-08-20 06:33:22'),
(62, 10, 'admin', 'create_customer', '2', '2019-08-20 06:34:32', '2019-08-20 06:34:32'),
(63, 10, 'admin', 'create_customer', '3', '2019-08-20 06:35:38', '2019-08-20 06:35:38'),
(64, 10, 'admin', 'create_customer', '4', '2019-08-20 06:36:21', '2019-08-20 06:36:21'),
(65, 10, 'admin', 'delete_customer', '4', '2019-08-20 06:49:16', '2019-08-20 06:49:16'),
(66, 10, 'admin', 'customer_status_update', '{\"customer_id\":3,\"status\":\"2\"}', '2019-08-20 06:50:38', '2019-08-20 06:50:38'),
(67, 10, 'admin', 'update_customer', 'a:10:{s:4:\"name\";s:7:\"testing\";s:9:\"id_number\";s:10:\"7896541230\";s:14:\"place_of_issue\";s:7:\"testing\";s:11:\"nationality\";s:7:\"testing\";s:13:\"mobile_number\";s:9:\"879546123\";s:11:\"home_number\";s:6:\"879542\";s:5:\"title\";s:5:\"title\";s:13:\"date_of_birth\";s:10:\"2019-08-20\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:3;}', '2019-08-20 07:09:02', '2019-08-20 07:09:02'),
(68, 10, 'admin', 'update_customer', 'a:10:{s:4:\"name\";s:13:\"tesdadsadting\";s:9:\"id_number\";s:19:\"7896541sadsadsad230\";s:14:\"place_of_issue\";s:17:\"dsadasdsadtesting\";s:11:\"nationality\";s:15:\"testindsadasdag\";s:13:\"mobile_number\";s:16:\"8795461sadsada23\";s:11:\"home_number\";s:13:\"87dsadsad9542\";s:5:\"title\";s:13:\"tisdsadsadtle\";s:13:\"date_of_birth\";s:10:\"2019-08-15\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:3;}', '2019-08-20 07:14:16', '2019-08-20 07:14:16'),
(69, 10, 'admin', 'delete_customer', '3', '2019-08-20 07:14:23', '2019-08-20 07:14:23'),
(70, 10, 'admin', 'create_customer', '5', '2019-08-20 07:14:52', '2019-08-20 07:14:52'),
(71, 10, 'admin', 'delete_customer', '5', '2019-08-20 07:17:38', '2019-08-20 07:17:38'),
(72, 10, 'admin', 'update_customer', 'a:7:{s:6:\"\'name\'\";s:4:\"name\";s:11:\"\'id_number\'\";s:10:\"7894561230\";s:13:\"\'nationality\'\";s:3:\"ind\";s:15:\"\'mobile_number\'\";s:10:\"9874563210\";s:13:\"\'home_number\'\";s:9:\"974563210\";s:8:\"\'status\'\";s:1:\"1\";s:2:\"id\";i:2;}', '2019-08-20 11:24:06', '2019-08-20 11:24:06'),
(73, 10, 'admin', 'update_customer', 'a:7:{s:6:\"\'name\'\";s:4:\"name\";s:11:\"\'id_number\'\";s:10:\"7894561230\";s:13:\"\'nationality\'\";s:3:\"ind\";s:15:\"\'mobile_number\'\";s:10:\"9874563210\";s:13:\"\'home_number\'\";s:9:\"974563210\";s:8:\"\'status\'\";s:1:\"1\";s:2:\"id\";i:2;}', '2019-08-20 11:25:27', '2019-08-20 11:25:27'),
(74, 10, 'admin', 'update_customer', 'a:6:{s:9:\"id_number\";s:10:\"7894561230\";s:11:\"nationality\";s:3:\"ind\";s:13:\"mobile_number\";s:10:\"9874563210\";s:11:\"home_number\";s:9:\"974563210\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:2;}', '2019-08-20 11:34:18', '2019-08-20 11:34:18'),
(75, 10, 'admin', 'update_customer', 'a:6:{s:9:\"id_number\";s:10:\"7894561230\";s:11:\"nationality\";s:3:\"ind\";s:13:\"mobile_number\";s:10:\"9874563210\";s:11:\"home_number\";s:9:\"974563210\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:2;}', '2019-08-20 11:35:18', '2019-08-20 11:35:18'),
(76, 10, 'admin', 'update_customer', 'a:6:{s:9:\"id_number\";s:10:\"7894561230\";s:11:\"nationality\";s:3:\"ind\";s:13:\"mobile_number\";s:10:\"9874563210\";s:11:\"home_number\";s:9:\"974563210\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:2;}', '2019-08-20 11:35:57', '2019-08-20 11:35:57'),
(77, 10, 'admin', 'update_customer', 'a:6:{s:9:\"id_number\";s:10:\"7894561230\";s:11:\"nationality\";s:3:\"ind\";s:13:\"mobile_number\";s:10:\"9874563210\";s:11:\"home_number\";s:9:\"974563210\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:2;}', '2019-08-20 11:36:29', '2019-08-20 11:36:29'),
(78, 10, 'admin', 'update_customer', 'a:7:{s:4:\"name\";s:4:\"name\";s:9:\"id_number\";s:10:\"7894561230\";s:11:\"nationality\";s:3:\"ind\";s:13:\"mobile_number\";s:10:\"9874563210\";s:11:\"home_number\";s:9:\"974563210\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:2;}', '2019-08-20 12:01:14', '2019-08-20 12:01:14'),
(79, 10, 'admin', 'update_customer', 'a:7:{s:4:\"name\";s:4:\"name\";s:9:\"id_number\";s:10:\"7894561230\";s:11:\"nationality\";s:3:\"ind\";s:13:\"mobile_number\";s:10:\"9874563210\";s:11:\"home_number\";s:9:\"974563210\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:2;}', '2019-08-20 12:10:43', '2019-08-20 12:10:43'),
(80, 10, 'admin', 'update_customer', 'a:7:{s:4:\"name\";s:4:\"name\";s:9:\"id_number\";s:10:\"7894561230\";s:11:\"nationality\";s:3:\"ind\";s:13:\"mobile_number\";s:10:\"9874563210\";s:11:\"home_number\";s:9:\"974563210\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:2;}', '2019-08-20 12:11:21', '2019-08-20 12:11:21'),
(81, 10, 'admin', 'update_customer', 'a:7:{s:4:\"name\";s:4:\"name\";s:9:\"id_number\";s:10:\"7894561230\";s:11:\"nationality\";s:3:\"ind\";s:13:\"mobile_number\";s:10:\"9874563210\";s:11:\"home_number\";s:9:\"974563210\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:2;}', '2019-08-20 12:11:32', '2019-08-20 12:11:32'),
(82, 10, 'admin', 'update_customer', 'a:7:{s:4:\"name\";s:4:\"name\";s:9:\"id_number\";s:10:\"7894561230\";s:11:\"nationality\";s:3:\"ind\";s:13:\"mobile_number\";s:10:\"9874563210\";s:11:\"home_number\";s:9:\"974563210\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:2;}', '2019-08-20 12:11:40', '2019-08-20 12:11:40'),
(83, 10, 'admin', 'update_customer_details', 'a:2:{s:8:\"customer\";a:7:{s:4:\"name\";s:4:\"name\";s:9:\"id_number\";s:10:\"7894561230\";s:11:\"nationality\";s:3:\"ind\";s:13:\"mobile_number\";s:10:\"9874563210\";s:11:\"home_number\";s:9:\"974563210\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:2;}s:16:\"customer_details\";a:35:{s:14:\"address_arabic\";s:7:\"testing\";s:16:\"street_is_arabic\";s:7:\"testing\";s:15:\"building_number\";s:10:\"4652478964\";s:4:\"pour\";s:7:\"testing\";s:11:\"area_arabic\";s:7:\"testing\";s:14:\"city_is_arabic\";s:7:\"testing\";s:12:\"other_phones\";s:10:\"878654.321\";s:20:\"social_status_arabic\";s:7:\"testing\";s:7:\"mailbox\";s:7:\"testing\";s:13:\"title_english\";s:7:\"testing\";s:15:\"area_is_english\";s:7:\"testing\";s:6:\"reason\";s:7:\"testing\";s:15:\"name_is_English\";s:7:\"testing\";s:10:\"issuing_id\";s:7:\"testing\";s:15:\"city_is_english\";s:7:\"testing\";s:12:\"customer_age\";s:2:\"20\";s:17:\"street_is_english\";s:7:\"testing\";s:21:\"social_status_english\";s:7:\"testing\";s:14:\"place_of_issue\";s:7:\"testing\";s:8:\"children\";s:1:\"3\";s:24:\"number_of_family_members\";s:1:\"4\";s:18:\"accommodation_type\";s:7:\"testing\";s:5:\"email\";s:17:\"testing@gmail.com\";s:19:\"card_version_number\";s:3:\"120\";s:14:\"place_of_birth\";s:7:\"testing\";s:19:\"number_of_irritants\";s:7:\"testing\";s:12:\"conservation\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:13:\"identity_type\";s:7:\"testing\";s:11:\"age_of_wife\";s:1:\"1\";s:11:\"age_of_boys\";s:1:\"1\";s:7:\"seniors\";s:1:\"2\";s:8:\"patients\";s:1:\"2\";s:11:\"expiry_date\";s:10:\"2019-08-14\";s:12:\"release_date\";s:10:\"2019-08-14\";}}', '2019-08-20 12:24:13', '2019-08-20 12:24:13'),
(84, 10, 'admin', 'update_customer_details', 'a:2:{s:8:\"customer\";a:7:{s:4:\"name\";s:4:\"name\";s:9:\"id_number\";s:10:\"7894561230\";s:11:\"nationality\";s:3:\"ind\";s:13:\"mobile_number\";s:10:\"9874563210\";s:11:\"home_number\";s:9:\"974563210\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:2;}s:16:\"customer_details\";a:35:{s:14:\"address_arabic\";s:7:\"testing\";s:16:\"street_is_arabic\";s:7:\"testing\";s:15:\"building_number\";s:10:\"4652478964\";s:4:\"pour\";s:7:\"testing\";s:11:\"area_arabic\";s:7:\"testing\";s:14:\"city_is_arabic\";s:7:\"testing\";s:12:\"other_phones\";s:10:\"878654.321\";s:20:\"social_status_arabic\";s:7:\"testing\";s:7:\"mailbox\";s:7:\"testing\";s:13:\"title_english\";s:7:\"testing\";s:15:\"area_is_english\";s:7:\"testing\";s:6:\"reason\";s:7:\"testing\";s:15:\"name_is_English\";s:7:\"testing\";s:10:\"issuing_id\";s:7:\"testing\";s:15:\"city_is_english\";s:7:\"testing\";s:12:\"customer_age\";s:2:\"20\";s:17:\"street_is_english\";s:7:\"testing\";s:21:\"social_status_english\";s:7:\"testing\";s:14:\"place_of_issue\";s:7:\"testing\";s:8:\"children\";s:1:\"3\";s:24:\"number_of_family_members\";s:1:\"4\";s:18:\"accommodation_type\";s:7:\"testing\";s:5:\"email\";s:17:\"testing@gmail.com\";s:19:\"card_version_number\";s:3:\"120\";s:14:\"place_of_birth\";s:7:\"testing\";s:19:\"number_of_irritants\";s:7:\"testing\";s:12:\"conservation\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:13:\"identity_type\";s:7:\"testing\";s:11:\"age_of_wife\";s:1:\"1\";s:11:\"age_of_boys\";s:1:\"1\";s:7:\"seniors\";s:1:\"2\";s:8:\"patients\";s:1:\"2\";s:11:\"expiry_date\";s:10:\"2019-08-14\";s:12:\"release_date\";s:10:\"2019-08-14\";}}', '2019-08-20 12:28:11', '2019-08-20 12:28:11'),
(85, 10, 'admin', 'update_customer_details', 'a:2:{s:8:\"customer\";a:7:{s:4:\"name\";s:4:\"name\";s:9:\"id_number\";s:10:\"7894561230\";s:11:\"nationality\";s:3:\"ind\";s:13:\"mobile_number\";s:10:\"9874563210\";s:11:\"home_number\";s:9:\"974563210\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:2;}s:16:\"customer_details\";a:35:{s:14:\"address_arabic\";s:7:\"testing\";s:16:\"street_is_arabic\";s:7:\"testing\";s:15:\"building_number\";s:10:\"4652478964\";s:4:\"pour\";s:7:\"testing\";s:11:\"area_arabic\";s:7:\"testing\";s:14:\"city_is_arabic\";s:7:\"testing\";s:12:\"other_phones\";s:10:\"878654.321\";s:20:\"social_status_arabic\";s:7:\"testing\";s:7:\"mailbox\";s:7:\"testing\";s:13:\"title_english\";s:7:\"testing\";s:15:\"area_is_english\";s:7:\"testing\";s:6:\"reason\";s:7:\"testing\";s:15:\"name_is_English\";s:7:\"testing\";s:10:\"issuing_id\";s:7:\"testing\";s:15:\"city_is_english\";s:7:\"testing\";s:12:\"customer_age\";s:2:\"20\";s:17:\"street_is_english\";s:7:\"testing\";s:21:\"social_status_english\";s:7:\"testing\";s:14:\"place_of_issue\";s:7:\"testing\";s:8:\"children\";s:1:\"3\";s:24:\"number_of_family_members\";s:1:\"4\";s:18:\"accommodation_type\";s:7:\"testing\";s:5:\"email\";s:17:\"testing@gmail.com\";s:19:\"card_version_number\";s:3:\"120\";s:14:\"place_of_birth\";s:7:\"testing\";s:19:\"number_of_irritants\";s:7:\"testing\";s:12:\"conservation\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:13:\"identity_type\";s:7:\"testing\";s:11:\"age_of_wife\";s:1:\"1\";s:11:\"age_of_boys\";s:1:\"1\";s:7:\"seniors\";s:1:\"2\";s:8:\"patients\";s:1:\"2\";s:11:\"expiry_date\";s:10:\"2019-08-14\";s:12:\"release_date\";s:10:\"2019-08-14\";}}', '2019-08-20 12:29:29', '2019-08-20 12:29:29'),
(86, 10, 'admin', 'update_customer_details', 'a:2:{s:8:\"customer\";a:7:{s:4:\"name\";s:4:\"name\";s:9:\"id_number\";s:10:\"7894561230\";s:11:\"nationality\";s:3:\"ind\";s:13:\"mobile_number\";s:10:\"9874563210\";s:11:\"home_number\";s:9:\"974563210\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:2;}s:16:\"customer_details\";a:35:{s:14:\"address_arabic\";s:7:\"testing\";s:16:\"street_is_arabic\";s:7:\"testing\";s:15:\"building_number\";s:10:\"4652478964\";s:4:\"pour\";s:7:\"testing\";s:11:\"area_arabic\";s:7:\"testing\";s:14:\"city_is_arabic\";s:7:\"testing\";s:12:\"other_phones\";s:10:\"878654.321\";s:20:\"social_status_arabic\";s:7:\"testing\";s:7:\"mailbox\";s:7:\"testing\";s:13:\"title_english\";s:7:\"testing\";s:15:\"area_is_english\";s:7:\"testing\";s:6:\"reason\";s:7:\"testing\";s:15:\"name_is_English\";s:7:\"testing\";s:10:\"issuing_id\";s:7:\"testing\";s:15:\"city_is_english\";s:7:\"testing\";s:12:\"customer_age\";s:2:\"20\";s:17:\"street_is_english\";s:7:\"testing\";s:21:\"social_status_english\";s:7:\"testing\";s:14:\"place_of_issue\";s:7:\"testing\";s:8:\"children\";s:1:\"3\";s:24:\"number_of_family_members\";s:1:\"4\";s:18:\"accommodation_type\";s:7:\"testing\";s:5:\"email\";s:17:\"testing@gmail.com\";s:19:\"card_version_number\";s:3:\"120\";s:14:\"place_of_birth\";s:7:\"testing\";s:19:\"number_of_irritants\";s:7:\"testing\";s:12:\"conservation\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:13:\"identity_type\";s:7:\"testing\";s:11:\"age_of_wife\";s:1:\"1\";s:11:\"age_of_boys\";s:1:\"1\";s:7:\"seniors\";s:1:\"2\";s:8:\"patients\";s:1:\"2\";s:11:\"expiry_date\";s:10:\"2019-08-14\";s:12:\"release_date\";s:10:\"2019-08-14\";}}', '2019-08-20 12:30:07', '2019-08-20 12:30:07'),
(87, 10, 'admin', 'update_customer_details', 'a:2:{s:8:\"customer\";a:7:{s:4:\"name\";s:4:\"name\";s:9:\"id_number\";s:10:\"7894561230\";s:11:\"nationality\";s:3:\"ind\";s:13:\"mobile_number\";s:10:\"9874563210\";s:11:\"home_number\";s:9:\"974563210\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:2;}s:16:\"customer_details\";a:35:{s:14:\"address_arabic\";s:7:\"testing\";s:16:\"street_is_arabic\";s:7:\"testing\";s:15:\"building_number\";s:10:\"4652478964\";s:4:\"pour\";s:7:\"testing\";s:11:\"area_arabic\";s:7:\"testing\";s:14:\"city_is_arabic\";s:7:\"testing\";s:12:\"other_phones\";s:10:\"878654.321\";s:20:\"social_status_arabic\";s:7:\"testing\";s:7:\"mailbox\";s:7:\"testing\";s:13:\"title_english\";s:7:\"testing\";s:15:\"area_is_english\";s:7:\"testing\";s:6:\"reason\";s:7:\"testing\";s:15:\"name_is_English\";s:7:\"testing\";s:10:\"issuing_id\";s:7:\"testing\";s:15:\"city_is_english\";s:7:\"testing\";s:12:\"customer_age\";s:2:\"20\";s:17:\"street_is_english\";s:7:\"testing\";s:21:\"social_status_english\";s:7:\"testing\";s:14:\"place_of_issue\";s:7:\"testing\";s:8:\"children\";s:1:\"3\";s:24:\"number_of_family_members\";s:1:\"4\";s:18:\"accommodation_type\";s:7:\"testing\";s:5:\"email\";s:17:\"testing@gmail.com\";s:19:\"card_version_number\";s:3:\"120\";s:14:\"place_of_birth\";s:7:\"testing\";s:19:\"number_of_irritants\";s:7:\"testing\";s:12:\"conservation\";s:7:\"testing\";s:10:\"occupation\";s:7:\"testing\";s:13:\"identity_type\";s:7:\"testing\";s:11:\"age_of_wife\";s:1:\"1\";s:11:\"age_of_boys\";s:1:\"1\";s:7:\"seniors\";s:1:\"2\";s:8:\"patients\";s:1:\"2\";s:11:\"expiry_date\";s:10:\"2019-08-14\";s:12:\"release_date\";s:10:\"2019-08-14\";}}', '2019-08-20 12:31:40', '2019-08-20 12:31:40'),
(88, 10, 'admin', 'create_customer', '6', '2019-08-20 12:41:08', '2019-08-20 12:41:08'),
(89, 10, 'admin', 'create_customer', '7', '2019-08-20 12:42:22', '2019-08-20 12:42:22'),
(90, 10, 'admin', 'create_customer', '8', '2019-08-20 12:43:15', '2019-08-20 12:43:15'),
(91, 10, 'admin', 'update_customer_details', 'a:2:{s:8:\"customer\";a:7:{s:4:\"name\";s:7:\"testing\";s:9:\"id_number\";s:9:\"798564132\";s:11:\"nationality\";s:7:\"testing\";s:13:\"mobile_number\";s:9:\"798564132\";s:11:\"home_number\";s:9:\"798546321\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:8;}s:16:\"customer_details\";a:35:{s:14:\"address_arabic\";N;s:16:\"street_is_arabic\";N;s:15:\"building_number\";N;s:4:\"pour\";N;s:11:\"area_arabic\";N;s:14:\"city_is_arabic\";N;s:12:\"other_phones\";N;s:20:\"social_status_arabic\";N;s:7:\"mailbox\";N;s:13:\"title_english\";N;s:15:\"area_is_english\";N;s:6:\"reason\";N;s:15:\"name_is_English\";N;s:10:\"issuing_id\";N;s:15:\"city_is_english\";N;s:12:\"customer_age\";N;s:17:\"street_is_english\";N;s:21:\"social_status_english\";N;s:14:\"place_of_issue\";N;s:8:\"children\";N;s:24:\"number_of_family_members\";N;s:18:\"accommodation_type\";N;s:5:\"email\";N;s:19:\"card_version_number\";N;s:14:\"place_of_birth\";N;s:19:\"number_of_irritants\";N;s:12:\"conservation\";N;s:10:\"occupation\";N;s:13:\"identity_type\";N;s:11:\"age_of_wife\";N;s:11:\"age_of_boys\";N;s:7:\"seniors\";s:1:\"1\";s:8:\"patients\";s:1:\"1\";s:11:\"expiry_date\";s:10:\"2019-08-20\";s:12:\"release_date\";s:10:\"2019-08-20\";}}', '2019-08-20 12:43:24', '2019-08-20 12:43:24'),
(92, 10, 'admin', 'update_customer', 'a:10:{s:4:\"name\";s:7:\"testing\";s:9:\"id_number\";s:9:\"798564132\";s:14:\"place_of_issue\";s:7:\"testing\";s:11:\"nationality\";s:7:\"testing\";s:13:\"mobile_number\";s:9:\"798564132\";s:11:\"home_number\";s:9:\"798546321\";s:5:\"title\";s:7:\"testing\";s:13:\"date_of_birth\";s:10:\"2019-08-20\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:8;}', '2019-08-20 12:43:53', '2019-08-20 12:43:53'),
(93, 10, 'admin', 'update_customer_details', 'a:2:{s:8:\"customer\";a:7:{s:4:\"name\";s:7:\"testing\";s:9:\"id_number\";s:9:\"798564132\";s:11:\"nationality\";s:7:\"testing\";s:13:\"mobile_number\";s:9:\"798564132\";s:11:\"home_number\";s:9:\"798546321\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:8;}s:16:\"customer_details\";a:35:{s:14:\"address_arabic\";N;s:16:\"street_is_arabic\";N;s:15:\"building_number\";N;s:4:\"pour\";N;s:11:\"area_arabic\";N;s:14:\"city_is_arabic\";N;s:12:\"other_phones\";N;s:20:\"social_status_arabic\";N;s:7:\"mailbox\";N;s:13:\"title_english\";N;s:15:\"area_is_english\";N;s:6:\"reason\";N;s:15:\"name_is_English\";N;s:10:\"issuing_id\";N;s:15:\"city_is_english\";N;s:12:\"customer_age\";N;s:17:\"street_is_english\";N;s:21:\"social_status_english\";N;s:14:\"place_of_issue\";N;s:8:\"children\";N;s:24:\"number_of_family_members\";N;s:18:\"accommodation_type\";N;s:5:\"email\";N;s:19:\"card_version_number\";N;s:14:\"place_of_birth\";N;s:19:\"number_of_irritants\";N;s:12:\"conservation\";N;s:10:\"occupation\";N;s:13:\"identity_type\";N;s:11:\"age_of_wife\";N;s:11:\"age_of_boys\";N;s:7:\"seniors\";N;s:8:\"patients\";N;s:11:\"expiry_date\";s:10:\"2019-08-20\";s:12:\"release_date\";s:10:\"2019-08-20\";}}', '2019-08-20 12:51:23', '2019-08-20 12:51:23'),
(94, 10, 'admin', 'update_customer_details', 'a:2:{s:8:\"customer\";a:7:{s:4:\"name\";s:7:\"testing\";s:9:\"id_number\";s:9:\"798564132\";s:11:\"nationality\";s:7:\"testing\";s:13:\"mobile_number\";s:9:\"798564132\";s:11:\"home_number\";s:9:\"798546321\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:8;}s:16:\"customer_details\";a:35:{s:14:\"address_arabic\";N;s:16:\"street_is_arabic\";N;s:15:\"building_number\";N;s:4:\"pour\";N;s:11:\"area_arabic\";N;s:14:\"city_is_arabic\";N;s:12:\"other_phones\";N;s:20:\"social_status_arabic\";N;s:7:\"mailbox\";N;s:13:\"title_english\";N;s:15:\"area_is_english\";N;s:6:\"reason\";N;s:15:\"name_is_English\";N;s:10:\"issuing_id\";N;s:15:\"city_is_english\";N;s:12:\"customer_age\";N;s:17:\"street_is_english\";N;s:21:\"social_status_english\";N;s:14:\"place_of_issue\";N;s:8:\"children\";N;s:24:\"number_of_family_members\";N;s:18:\"accommodation_type\";N;s:5:\"email\";N;s:19:\"card_version_number\";N;s:14:\"place_of_birth\";N;s:19:\"number_of_irritants\";N;s:12:\"conservation\";N;s:10:\"occupation\";N;s:13:\"identity_type\";N;s:11:\"age_of_wife\";N;s:11:\"age_of_boys\";N;s:7:\"seniors\";N;s:8:\"patients\";N;s:11:\"expiry_date\";s:10:\"2019-08-20\";s:12:\"release_date\";s:10:\"2019-08-20\";}}', '2019-08-20 13:02:09', '2019-08-20 13:02:09'),
(95, 10, 'admin', 'update_customer_details', 'a:2:{s:8:\"customer\";a:7:{s:4:\"name\";s:7:\"testing\";s:9:\"id_number\";s:9:\"798564132\";s:11:\"nationality\";s:7:\"testing\";s:13:\"mobile_number\";s:9:\"798564132\";s:11:\"home_number\";s:9:\"798546321\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:8;}s:16:\"customer_details\";a:33:{s:14:\"address_arabic\";N;s:16:\"street_is_arabic\";N;s:15:\"building_number\";N;s:4:\"pour\";N;s:11:\"area_arabic\";N;s:14:\"city_is_arabic\";N;s:12:\"other_phones\";N;s:20:\"social_status_arabic\";N;s:7:\"mailbox\";N;s:13:\"title_english\";N;s:15:\"area_is_english\";N;s:6:\"reason\";N;s:15:\"name_is_English\";N;s:10:\"issuing_id\";N;s:15:\"city_is_english\";N;s:12:\"customer_age\";N;s:17:\"street_is_english\";N;s:21:\"social_status_english\";N;s:14:\"place_of_issue\";N;s:8:\"children\";N;s:24:\"number_of_family_members\";N;s:18:\"accommodation_type\";N;s:5:\"email\";N;s:19:\"card_version_number\";N;s:14:\"place_of_birth\";N;s:19:\"number_of_irritants\";N;s:12:\"conservation\";N;s:10:\"occupation\";N;s:13:\"identity_type\";N;s:11:\"age_of_wife\";N;s:11:\"age_of_boys\";N;s:7:\"seniors\";N;s:8:\"patients\";N;}}', '2019-08-20 13:04:28', '2019-08-20 13:04:28'),
(96, 10, 'admin', 'update_customer_details', 'a:2:{s:8:\"customer\";a:7:{s:4:\"name\";s:7:\"testing\";s:9:\"id_number\";s:9:\"798564132\";s:11:\"nationality\";s:7:\"testing\";s:13:\"mobile_number\";s:9:\"798564132\";s:11:\"home_number\";s:9:\"798546321\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:8;}s:16:\"customer_details\";a:33:{s:14:\"address_arabic\";N;s:16:\"street_is_arabic\";N;s:15:\"building_number\";N;s:4:\"pour\";N;s:11:\"area_arabic\";N;s:14:\"city_is_arabic\";N;s:12:\"other_phones\";N;s:20:\"social_status_arabic\";N;s:7:\"mailbox\";N;s:13:\"title_english\";N;s:15:\"area_is_english\";N;s:6:\"reason\";N;s:15:\"name_is_English\";N;s:10:\"issuing_id\";N;s:15:\"city_is_english\";N;s:12:\"customer_age\";N;s:17:\"street_is_english\";N;s:21:\"social_status_english\";N;s:14:\"place_of_issue\";N;s:8:\"children\";N;s:24:\"number_of_family_members\";N;s:18:\"accommodation_type\";N;s:5:\"email\";N;s:19:\"card_version_number\";N;s:14:\"place_of_birth\";N;s:19:\"number_of_irritants\";N;s:12:\"conservation\";N;s:10:\"occupation\";N;s:13:\"identity_type\";N;s:11:\"age_of_wife\";N;s:11:\"age_of_boys\";N;s:7:\"seniors\";N;s:8:\"patients\";N;}}', '2019-08-20 13:04:49', '2019-08-20 13:04:49'),
(97, 10, 'admin', 'user_login', 'login', '2019-08-20 13:27:47', '2019-08-20 13:27:47'),
(98, 10, 'admin', 'delete_status', '3', '2019-08-20 13:43:15', '2019-08-20 13:43:15'),
(99, 10, 'admin', 'create_status', '14', '2019-08-20 13:43:39', '2019-08-20 13:43:39'),
(100, 10, 'admin', 'create_status', '15', '2019-08-20 13:45:48', '2019-08-20 13:45:48'),
(101, 10, 'admin', 'create_status', '16', '2019-08-20 13:46:00', '2019-08-20 13:46:00'),
(102, 10, 'admin', 'create_status', '17', '2019-08-20 13:47:41', '2019-08-20 13:47:41'),
(103, 10, 'admin', 'create_status', '18', '2019-08-20 13:47:57', '2019-08-20 13:47:57'),
(104, 10, 'admin', 'create_status', '19', '2019-08-20 13:48:25', '2019-08-20 13:48:25'),
(105, 10, 'admin', 'create_status', '20', '2019-08-20 13:52:50', '2019-08-20 13:52:50'),
(106, 10, 'admin', 'create_status', '21', '2019-08-20 13:53:00', '2019-08-20 13:53:00'),
(107, 10, 'admin', 'create_status', '22', '2019-08-20 13:53:07', '2019-08-20 13:53:07'),
(108, 10, 'admin', 'update_status', 'a:2:{s:4:\"name\";s:7:\"1230000\";s:2:\"id\";i:9;}', '2019-08-20 13:57:16', '2019-08-20 13:57:16'),
(109, 10, 'admin', 'user_login', 'login', '2019-08-20 14:00:38', '2019-08-20 14:00:38'),
(110, 10, 'admin', 'update_customer_details', 'a:2:{s:8:\"customer\";a:7:{s:4:\"name\";s:7:\"testing\";s:9:\"id_number\";s:9:\"798564132\";s:11:\"nationality\";s:7:\"testing\";s:13:\"mobile_number\";s:9:\"798564132\";s:11:\"home_number\";s:9:\"798546321\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:8;}s:16:\"customer_details\";a:33:{s:14:\"address_arabic\";N;s:16:\"street_is_arabic\";N;s:15:\"building_number\";N;s:4:\"pour\";N;s:11:\"area_arabic\";N;s:14:\"city_is_arabic\";N;s:12:\"other_phones\";N;s:20:\"social_status_arabic\";N;s:7:\"mailbox\";N;s:13:\"title_english\";N;s:15:\"area_is_english\";N;s:6:\"reason\";N;s:15:\"name_is_English\";N;s:10:\"issuing_id\";N;s:15:\"city_is_english\";N;s:12:\"customer_age\";N;s:17:\"street_is_english\";N;s:21:\"social_status_english\";N;s:14:\"place_of_issue\";N;s:8:\"children\";N;s:24:\"number_of_family_members\";N;s:18:\"accommodation_type\";N;s:5:\"email\";N;s:19:\"card_version_number\";N;s:14:\"place_of_birth\";N;s:19:\"number_of_irritants\";N;s:12:\"conservation\";N;s:10:\"occupation\";N;s:13:\"identity_type\";N;s:11:\"age_of_wife\";N;s:11:\"age_of_boys\";N;s:7:\"seniors\";N;s:8:\"patients\";N;}}', '2019-08-20 14:12:29', '2019-08-20 14:12:29'),
(111, 10, 'admin', 'user_login', 'login', '2019-08-21 04:59:50', '2019-08-21 04:59:50'),
(112, 10, 'admin', 'user_login', 'login', '2019-08-21 05:28:09', '2019-08-21 05:28:09'),
(113, 10, 'admin', 'delete_status', '4', '2019-08-21 05:36:31', '2019-08-21 05:36:31'),
(114, 10, 'admin', 'update_status', 'a:2:{s:4:\"name\";s:9:\"147852963\";s:2:\"id\";i:19;}', '2019-08-21 05:38:40', '2019-08-21 05:38:40'),
(115, 10, 'admin', 'update_status', 'a:2:{s:4:\"name\";s:12:\"14785296hhh3\";s:2:\"id\";i:19;}', '2019-08-21 05:39:58', '2019-08-21 05:39:58'),
(116, 10, 'admin', 'update_status', 'a:2:{s:4:\"name\";s:6:\"jaydip\";s:2:\"id\";i:1;}', '2019-08-21 05:40:09', '2019-08-21 05:40:09'),
(117, 10, 'admin', 'update_status', 'a:2:{s:4:\"name\";s:3:\"123\";s:2:\"id\";i:18;}', '2019-08-21 05:43:07', '2019-08-21 05:43:07'),
(118, 10, 'admin', 'update_status', 'a:2:{s:4:\"name\";s:6:\"147852\";s:2:\"id\";i:22;}', '2019-08-21 05:43:30', '2019-08-21 05:43:30'),
(119, 10, 'admin', 'update_status', 'a:2:{s:4:\"name\";s:11:\"14dsfsf7852\";s:2:\"id\";i:22;}', '2019-08-21 05:43:47', '2019-08-21 05:43:47'),
(120, 10, 'admin', 'create_status', '2', '2019-08-21 10:15:03', '2019-08-21 10:15:03'),
(121, 10, 'admin', 'create_status', '3', '2019-08-21 10:15:40', '2019-08-21 10:15:40'),
(122, 10, 'admin', 'create_status', '4', '2019-08-21 10:15:52', '2019-08-21 10:15:52'),
(123, 10, 'admin', 'update_status', 'a:5:{s:11:\"nationality\";s:8:\"dfdsfdsf\";s:19:\"nationality_english\";s:7:\"dsfdsfs\";s:5:\"state\";s:4:\"dfsf\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:1;}', '2019-08-21 10:44:29', '2019-08-21 10:44:29'),
(124, 10, 'admin', 'update_status', 'a:5:{s:11:\"nationality\";s:9:\"123456789\";s:19:\"nationality_english\";s:9:\"123456789\";s:5:\"state\";s:9:\"123456789\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:1;}', '2019-08-21 10:44:52', '2019-08-21 10:44:52'),
(125, 10, 'admin', 'update_status', 'a:5:{s:11:\"nationality\";s:11:\"tadsadatttt\";s:19:\"nationality_english\";s:6:\"tttttt\";s:5:\"state\";s:5:\"ttttt\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:4;}', '2019-08-21 10:45:46', '2019-08-21 10:45:46'),
(126, 10, 'admin', 'update_status', 'a:5:{s:11:\"nationality\";s:9:\"123456789\";s:19:\"nationality_english\";s:9:\"123456789\";s:5:\"state\";s:9:\"123456789\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:1;}', '2019-08-21 10:49:52', '2019-08-21 10:49:52'),
(127, 10, 'admin', 'update_status', 'a:5:{s:11:\"nationality\";s:4:\"dsfs\";s:19:\"nationality_english\";s:10:\"dfsdfdfdsf\";s:5:\"state\";s:8:\"sdfsdfsf\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:3;}', '2019-08-21 10:50:02', '2019-08-21 10:50:02'),
(128, 10, 'admin', 'create_religion', '2', '2019-08-21 11:28:54', '2019-08-21 11:28:54'),
(129, 10, 'admin', 'create_religion', '3', '2019-08-21 11:29:09', '2019-08-21 11:29:09'),
(130, 10, 'admin', 'create_religion', '4', '2019-08-21 11:29:21', '2019-08-21 11:29:21'),
(131, 10, 'admin', 'update_religion', 'a:3:{s:8:\"religion\";s:5:\"sadas\";s:16:\"religion_english\";s:6:\"sadada\";s:2:\"id\";i:4;}', '2019-08-21 11:31:41', '2019-08-21 11:31:41'),
(132, 10, 'admin', 'update_religion', 'a:3:{s:8:\"religion\";s:4:\"sada\";s:16:\"religion_english\";s:10:\"saddsad123\";s:2:\"id\";i:4;}', '2019-08-21 11:32:17', '2019-08-21 11:32:17'),
(133, 10, 'admin', 'create_religion', '5', '2019-08-21 11:46:31', '2019-08-21 11:46:31'),
(134, 10, 'admin', 'update_religion', 'a:3:{s:8:\"religion\";s:7:\"dfgdgdf\";s:16:\"religion_english\";s:6:\"gdfgdf\";s:2:\"id\";i:5;}', '2019-08-21 13:10:12', '2019-08-21 13:10:12'),
(135, 10, 'admin', 'create_religion', '6', '2019-08-21 13:10:30', '2019-08-21 13:10:30'),
(136, 10, 'admin', 'create_religion', '7', '2019-08-21 13:11:12', '2019-08-21 13:11:12'),
(137, 10, 'admin', 'delete_religion', '7', '2019-08-21 13:11:16', '2019-08-21 13:11:16'),
(138, 10, 'admin', 'create_profession', '2', '2019-08-21 13:14:54', '2019-08-21 13:14:54'),
(139, 10, 'admin', 'update_profession', 'a:3:{s:10:\"occupation\";s:10:\"saasdaddda\";s:11:\"job_english\";s:15:\"dsadsasdsadadad\";s:2:\"id\";i:1;}', '2019-08-21 13:19:42', '2019-08-21 13:19:42'),
(140, 10, 'admin', 'update_profession', 'a:3:{s:10:\"occupation\";s:7:\"testing\";s:11:\"job_english\";s:7:\"testing\";s:2:\"id\";i:1;}', '2019-08-21 13:19:54', '2019-08-21 13:19:54'),
(141, 10, 'admin', 'create_profession', '3', '2019-08-21 13:20:09', '2019-08-21 13:20:09'),
(142, 10, 'admin', 'create_profession', '4', '2019-08-21 13:20:18', '2019-08-21 13:20:18'),
(143, 10, 'admin', 'create_profession', '5', '2019-08-21 13:20:24', '2019-08-21 13:20:24'),
(144, 10, 'admin', 'create_profession', '6', '2019-08-21 13:20:28', '2019-08-21 13:20:28'),
(145, 10, 'admin', 'create_profession', '7', '2019-08-21 13:20:33', '2019-08-21 13:20:33'),
(146, 10, 'admin', 'create_profession', '8', '2019-08-21 13:20:38', '2019-08-21 13:20:38'),
(147, 10, 'admin', 'create_profession', '9', '2019-08-21 13:20:42', '2019-08-21 13:20:42'),
(148, 10, 'admin', 'create_profession', '10', '2019-08-21 13:20:49', '2019-08-21 13:20:49'),
(149, 10, 'admin', 'create_profession', '11', '2019-08-21 13:20:54', '2019-08-21 13:20:54'),
(150, 10, 'admin', 'update_profession', 'a:3:{s:10:\"occupation\";s:8:\"t1esting\";s:11:\"job_english\";s:8:\"testin1g\";s:2:\"id\";i:1;}', '2019-08-21 13:21:03', '2019-08-21 13:21:03'),
(151, 10, 'admin', 'create_profession', '12', '2019-08-21 13:23:12', '2019-08-21 13:23:12'),
(152, 10, 'admin', 'create_profession', '13', '2019-08-21 13:23:16', '2019-08-21 13:23:16'),
(153, 10, 'admin', 'create_profession', '14', '2019-08-21 13:23:21', '2019-08-21 13:23:21'),
(154, 10, 'admin', 'create_profession', '15', '2019-08-21 13:23:26', '2019-08-21 13:23:26'),
(155, 10, 'admin', 'delete_profession', '3', '2019-08-21 13:23:30', '2019-08-21 13:23:30'),
(156, 10, 'admin', 'delete_profession', '4', '2019-08-21 13:23:33', '2019-08-21 13:23:33'),
(157, 10, 'admin', 'delete_profession', '5', '2019-08-21 13:23:36', '2019-08-21 13:23:36'),
(158, 10, 'admin', 'update_status', 'a:2:{s:4:\"name\";s:7:\"hihello\";s:2:\"id\";i:21;}', '2019-08-21 14:07:31', '2019-08-21 14:07:31'),
(159, 10, 'admin', 'delete_status', '22', '2019-08-21 14:08:30', '2019-08-21 14:08:30'),
(160, 10, 'admin', 'delete_status', '11', '2019-08-21 14:08:34', '2019-08-21 14:08:34'),
(161, 10, 'admin', 'delete_status', '21', '2019-08-21 14:08:39', '2019-08-21 14:08:39'),
(162, 10, 'admin', 'delete_status', '20', '2019-08-21 14:08:44', '2019-08-21 14:08:44'),
(163, 10, 'admin', 'delete_status', '19', '2019-08-21 14:08:47', '2019-08-21 14:08:47'),
(164, 10, 'admin', 'delete_status', '18', '2019-08-21 14:08:53', '2019-08-21 14:08:53'),
(165, 10, 'admin', 'delete_status', '17', '2019-08-21 14:08:56', '2019-08-21 14:08:56'),
(166, 10, 'admin', 'delete_status', '16', '2019-08-21 14:08:58', '2019-08-21 14:08:58'),
(167, 10, 'admin', 'create_status', '23', '2019-08-21 14:09:04', '2019-08-21 14:09:04'),
(168, 10, 'admin', 'delete_status', '5', '2019-08-21 14:16:44', '2019-08-21 14:16:44'),
(169, 10, 'admin', 'update_country', 'a:2:{s:4:\"name\";s:6:\"sada-1\";s:2:\"id\";i:12;}', '2019-08-21 14:18:00', '2019-08-21 14:18:00'),
(170, 10, 'admin', 'delete_country', '12', '2019-08-21 14:18:03', '2019-08-21 14:18:03'),
(171, 10, 'admin', 'create_country', '13', '2019-08-21 14:18:08', '2019-08-21 14:18:08'),
(172, 10, 'admin', 'user_login', 'login', '2019-08-22 04:34:53', '2019-08-22 04:34:53'),
(173, 10, 'admin', 'user_login', 'login', '2019-08-22 04:57:47', '2019-08-22 04:57:47'),
(174, 10, 'admin', 'create_conreact_source', '2', '2019-08-22 05:57:02', '2019-08-22 05:57:02'),
(175, 10, 'admin', 'create_conreact_source', '3', '2019-08-22 06:02:11', '2019-08-22 06:02:11'),
(176, 10, 'admin', 'update_conreact_source', 'a:2:{s:6:\"source\";s:3:\"123\";s:2:\"id\";i:3;}', '2019-08-22 06:02:48', '2019-08-22 06:02:48'),
(177, 10, 'admin', 'delete_conreact_source', '3', '2019-08-22 06:07:16', '2019-08-22 06:07:16'),
(178, 10, 'admin', 'delete_country', '13', '2019-08-22 06:09:09', '2019-08-22 06:09:09'),
(179, 10, 'admin', 'create_status', '5', '2019-08-22 06:13:14', '2019-08-22 06:13:14'),
(180, 10, 'admin', 'update_status', 'a:5:{s:11:\"nationality\";s:3:\"120\";s:19:\"nationality_english\";s:10:\"dsfdsfdsff\";s:5:\"state\";s:7:\"dfdsfsf\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:5;}', '2019-08-22 06:14:40', '2019-08-22 06:14:40'),
(181, 10, 'admin', 'delete_profession', '15', '2019-08-22 06:16:29', '2019-08-22 06:16:29'),
(182, 10, 'admin', 'create_religion', '8', '2019-08-22 06:17:56', '2019-08-22 06:17:56'),
(183, 10, 'admin', 'delete_religion', '8', '2019-08-22 06:18:01', '2019-08-22 06:18:01'),
(184, 10, 'admin', 'update_status', 'a:2:{s:4:\"name\";s:17:\"dfsfssadsadfdsffs\";s:2:\"id\";i:23;}', '2019-08-22 06:20:36', '2019-08-22 06:20:36'),
(185, 10, 'admin', 'delete_status', '23', '2019-08-22 06:20:40', '2019-08-22 06:20:40'),
(186, 10, 'admin', 'create_airport', '1', '2019-08-22 07:01:14', '2019-08-22 07:01:14'),
(187, 10, 'admin', 'update_airport', 'a:3:{s:7:\"airport\";s:3:\"123\";s:15:\"airport_english\";s:3:\"123\";s:2:\"id\";i:1;}', '2019-08-22 07:05:19', '2019-08-22 07:05:19'),
(188, 10, 'admin', 'create_airport', '2', '2019-08-22 07:05:51', '2019-08-22 07:05:51'),
(189, 10, 'admin', 'delete_airport', '2', '2019-08-22 07:06:36', '2019-08-22 07:06:36'),
(190, 10, 'admin', 'update_airport', 'a:3:{s:7:\"airport\";s:5:\"12312\";s:15:\"airport_english\";s:3:\"123\";s:2:\"id\";i:1;}', '2019-08-22 07:12:55', '2019-08-22 07:12:55'),
(191, 10, 'admin', 'create_airport', '3', '2019-08-22 07:13:13', '2019-08-22 07:13:13'),
(192, 10, 'admin', 'delete_airport', '3', '2019-08-22 07:13:19', '2019-08-22 07:13:19'),
(193, 10, 'admin', 'create_marketer', '1', '2019-08-22 07:39:30', '2019-08-22 07:39:30'),
(194, 10, 'admin', 'create_marketer', '2', '2019-08-22 07:40:09', '2019-08-22 07:40:09'),
(195, 10, 'admin', 'update_marketer', 'a:3:{s:8:\"marketer\";s:10:\"adadsdadad\";s:8:\"phone_no\";s:7:\"sadsada\";s:2:\"id\";i:2;}', '2019-08-22 07:43:21', '2019-08-22 07:43:21'),
(196, 10, 'admin', 'update_marketer', 'a:3:{s:8:\"marketer\";s:3:\"123\";s:8:\"phone_no\";s:3:\"123\";s:2:\"id\";i:2;}', '2019-08-22 07:43:34', '2019-08-22 07:43:34'),
(197, 10, 'admin', 'delete_marketer', '2', '2019-08-22 07:43:59', '2019-08-22 07:43:59'),
(198, 10, 'admin', 'create_terms_and_advantages', '1', '2019-08-22 08:56:38', '2019-08-22 08:56:38'),
(199, 10, 'admin', 'create_terms_and_advantages', '2', '2019-08-22 09:00:10', '2019-08-22 09:00:10'),
(200, 10, 'admin', 'create_terms_and_advantages', '3', '2019-08-22 09:01:15', '2019-08-22 09:01:15'),
(201, 10, 'admin', 'update_terms_and_advantages', 'a:2:{s:19:\"terms_and_advantage\";s:3:\"123\";s:2:\"id\";i:3;}', '2019-08-22 09:01:21', '2019-08-22 09:01:21'),
(202, 10, 'admin', 'delete_terms_and_advantage', '3', '2019-08-22 09:05:01', '2019-08-22 09:05:01'),
(203, 10, 'admin', 'create_qualifications_and_experience', '1', '2019-08-22 09:37:29', '2019-08-22 09:37:29'),
(204, 10, 'admin', 'update_qualifications_and_experience', 'a:2:{s:29:\"qualifications_and_experience\";s:5:\"ds123\";s:2:\"id\";i:1;}', '2019-08-22 09:42:23', '2019-08-22 09:42:23'),
(205, 10, 'admin', 'create_qualifications_and_experience', '2', '2019-08-22 09:43:28', '2019-08-22 09:43:28'),
(206, 10, 'admin', 'delete_qualifications_and_experience', '2', '2019-08-22 09:52:16', '2019-08-22 09:52:16'),
(207, 10, 'admin', 'create_cost_center', '1', '2019-08-22 10:46:59', '2019-08-22 10:46:59'),
(208, 10, 'admin', 'create_cost_center', '2', '2019-08-22 10:47:12', '2019-08-22 10:47:12'),
(209, 10, 'admin', 'create_cost_center', '3', '2019-08-22 10:47:33', '2019-08-22 10:47:33'),
(210, 10, 'admin', 'update_cost_center', 'a:4:{s:11:\"center_name\";s:3:\"123\";s:19:\"center_name_english\";s:3:\"123\";s:5:\"notes\";s:3:\"123\";s:2:\"id\";i:3;}', '2019-08-22 10:50:09', '2019-08-22 10:50:09'),
(211, 10, 'admin', 'delete_cost_center', '3', '2019-08-22 10:50:33', '2019-08-22 10:50:33'),
(212, 10, 'admin', 'delete_cost_center', '1', '2019-08-22 10:50:36', '2019-08-22 10:50:36'),
(213, 10, 'admin', 'delete_cost_center', '2', '2019-08-22 10:50:39', '2019-08-22 10:50:39'),
(214, 10, 'admin', 'create_currency', '1', '2019-08-22 11:30:18', '2019-08-22 11:30:18');
INSERT INTO `activity_log` (`id`, `user_id`, `username`, `key`, `value`, `created_at`, `updated_at`) VALUES
(215, 10, 'admin', 'update_currency', 'a:4:{s:13:\"currency_name\";s:3:\"123\";s:21:\"currency_name_english\";s:3:\"123\";s:12:\"abbreviation\";s:3:\"123\";s:2:\"id\";i:1;}', '2019-08-22 11:34:05', '2019-08-22 11:34:05'),
(216, 10, 'admin', 'delete_cost_center', '1', '2019-08-22 11:35:25', '2019-08-22 11:35:25'),
(217, 10, 'admin', 'create_cost_center', '4', '2019-08-22 12:58:34', '2019-08-22 12:58:34'),
(218, 10, 'admin', 'create_currency', '2', '2019-08-22 12:59:40', '2019-08-22 12:59:40'),
(219, 10, 'admin', 'user_login', 'login', '2019-08-26 05:09:33', '2019-08-26 05:09:33'),
(220, 10, 'admin', 'create_office', '38', '2019-08-26 05:29:17', '2019-08-26 05:29:17'),
(221, 10, 'admin', 'update_office', 'a:7:{s:4:\"name\";s:5:\"cvcxv\";s:4:\"city\";s:6:\"xvxvxv\";s:5:\"phone\";s:8:\"78978997\";s:5:\"email\";s:14:\"test@gmail.com\";s:11:\"office_type\";s:1:\"2\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:38;}', '2019-08-26 05:30:09', '2019-08-26 05:30:09'),
(222, 10, 'admin', 'update_user', 'a:2:{s:4:\"user\";a:6:{s:6:\"status\";s:1:\"2\";s:4:\"name\";s:12:\"12000testing\";s:8:\"username\";s:6:\"helloo\";s:5:\"email\";s:15:\"hello@gmail.com\";s:7:\"role_id\";s:1:\"1\";s:2:\"id\";i:12;}s:9:\"user_data\";a:8:{s:6:\"gender\";s:4:\"male\";s:11:\"nationality\";s:5:\"India\";s:13:\"qualification\";s:3:\"phd\";s:8:\"position\";s:7:\"testing\";s:16:\"passport_expired\";s:10:\"2019-08-16\";s:16:\"end_of_residence\";s:10:\"2019-08-16\";s:16:\"end_of_insurance\";s:10:\"2019-08-16\";s:6:\"salary\";s:4:\"8000\";}}', '2019-08-26 05:58:19', '2019-08-26 05:58:19'),
(223, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:13:\"profession_id\";s:1:\"1\";s:14:\"nationality_id\";s:1:\"3\";s:11:\"religion_id\";s:1:\"1\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9785463210\";s:11:\"reservation\";s:1:\"2\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:4;}', '2019-08-26 07:35:05', '2019-08-26 07:35:05'),
(224, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:13:\"profession_id\";s:1:\"1\";s:14:\"nationality_id\";s:1:\"3\";s:11:\"religion_id\";s:1:\"1\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9785463210\";s:11:\"reservation\";s:1:\"2\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:4;}', '2019-08-26 07:36:04', '2019-08-26 07:36:04'),
(225, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:13:\"profession_id\";s:1:\"1\";s:14:\"nationality_id\";s:1:\"3\";s:11:\"religion_id\";s:1:\"1\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9785463210\";s:11:\"reservation\";s:1:\"2\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:4;}', '2019-08-26 07:36:41', '2019-08-26 07:36:41'),
(226, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:13:\"profession_id\";s:1:\"1\";s:14:\"nationality_id\";s:1:\"3\";s:11:\"religion_id\";s:1:\"1\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9785463210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:4;}', '2019-08-26 07:37:36', '2019-08-26 07:37:36'),
(227, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:7:\"testing\";s:13:\"profession_id\";s:1:\"1\";s:14:\"nationality_id\";s:1:\"3\";s:11:\"religion_id\";s:1:\"1\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9785463210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:4;}', '2019-08-26 07:38:17', '2019-08-26 07:38:17'),
(228, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:8:\"fdsfdsfd\";s:13:\"profession_id\";s:1:\"1\";s:14:\"nationality_id\";s:1:\"3\";s:11:\"religion_id\";s:1:\"1\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9785463210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:4;}', '2019-08-26 07:38:43', '2019-08-26 07:38:43'),
(229, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:3:\"123\";s:13:\"profession_id\";s:1:\"1\";s:14:\"nationality_id\";s:1:\"3\";s:11:\"religion_id\";s:1:\"1\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"1\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9785463210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:4;}', '2019-08-26 07:39:44', '2019-08-26 07:39:44'),
(230, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:3:\"123\";s:13:\"profession_id\";s:1:\"1\";s:14:\"nationality_id\";s:1:\"3\";s:11:\"religion_id\";s:1:\"1\";s:3:\"age\";s:2:\"20\";s:19:\"previous_experience\";s:1:\"2\";s:9:\"office_id\";s:2:\"32\";s:15:\"passport_number\";s:10:\"9785463210\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:4;}', '2019-08-26 07:40:00', '2019-08-26 07:40:00'),
(231, 10, 'admin', 'delete_cv', '1', '2019-08-26 07:40:45', '2019-08-26 07:40:45'),
(232, 10, 'admin', 'delete_cv', '3', '2019-08-26 07:40:55', '2019-08-26 07:40:55'),
(233, 10, 'admin', 'cv_status_update', '{\"cv_id\":4,\"status\":\"2\"}', '2019-08-26 07:57:49', '2019-08-26 07:57:49'),
(234, 10, 'admin', 'cv_status_update', '{\"cv_id\":4,\"status\":\"1\"}', '2019-08-26 07:57:52', '2019-08-26 07:57:52'),
(235, 10, 'admin', 'customer_status_update', '{\"customer_id\":8,\"status\":\"2\"}', '2019-08-26 07:58:24', '2019-08-26 07:58:24'),
(236, 10, 'admin', 'update_customer', 'a:10:{s:4:\"name\";s:7:\"testing\";s:9:\"id_number\";s:9:\"798564132\";s:14:\"place_of_issue\";s:7:\"testing\";s:11:\"nationality\";s:7:\"testing\";s:13:\"mobile_number\";s:9:\"798564132\";s:11:\"home_number\";s:9:\"798546321\";s:5:\"title\";s:7:\"testing\";s:13:\"date_of_birth\";s:10:\"2019-08-20\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:8;}', '2019-08-26 07:59:02', '2019-08-26 07:59:02'),
(237, 10, 'admin', 'update_customer', 'a:10:{s:4:\"name\";s:7:\"testing\";s:9:\"id_number\";s:9:\"798564132\";s:14:\"place_of_issue\";s:7:\"testing\";s:11:\"nationality\";s:7:\"testing\";s:13:\"mobile_number\";s:9:\"798564132\";s:11:\"home_number\";s:9:\"798546321\";s:5:\"title\";s:7:\"testing\";s:13:\"date_of_birth\";s:10:\"2019-08-20\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:8;}', '2019-08-26 07:59:42', '2019-08-26 07:59:42'),
(238, 10, 'admin', 'customer_status_update', '{\"customer_id\":8,\"status\":\"1\"}', '2019-08-26 07:59:47', '2019-08-26 07:59:47'),
(239, 10, 'admin', 'update_customer_details', 'a:2:{s:8:\"customer\";a:7:{s:4:\"name\";s:10:\"123testing\";s:9:\"id_number\";s:9:\"798564132\";s:11:\"nationality\";s:7:\"testing\";s:13:\"mobile_number\";s:9:\"798564132\";s:11:\"home_number\";s:9:\"798546321\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:8;}s:16:\"customer_details\";a:33:{s:14:\"address_arabic\";N;s:16:\"street_is_arabic\";N;s:15:\"building_number\";N;s:4:\"pour\";N;s:11:\"area_arabic\";N;s:14:\"city_is_arabic\";N;s:12:\"other_phones\";N;s:20:\"social_status_arabic\";N;s:7:\"mailbox\";N;s:13:\"title_english\";N;s:15:\"area_is_english\";N;s:6:\"reason\";N;s:15:\"name_is_English\";N;s:10:\"issuing_id\";N;s:15:\"city_is_english\";N;s:12:\"customer_age\";N;s:17:\"street_is_english\";N;s:21:\"social_status_english\";N;s:14:\"place_of_issue\";N;s:8:\"children\";N;s:24:\"number_of_family_members\";N;s:18:\"accommodation_type\";N;s:5:\"email\";N;s:19:\"card_version_number\";N;s:14:\"place_of_birth\";N;s:19:\"number_of_irritants\";N;s:12:\"conservation\";N;s:10:\"occupation\";N;s:13:\"identity_type\";N;s:11:\"age_of_wife\";N;s:11:\"age_of_boys\";N;s:7:\"seniors\";N;s:8:\"patients\";N;}}', '2019-08-26 08:01:48', '2019-08-26 08:01:48'),
(240, 10, 'admin', 'update_customer_details', 'a:2:{s:8:\"customer\";a:7:{s:4:\"name\";s:10:\"123testing\";s:9:\"id_number\";s:9:\"798564132\";s:11:\"nationality\";s:7:\"testing\";s:13:\"mobile_number\";s:9:\"798564132\";s:11:\"home_number\";s:9:\"798546321\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:8;}s:16:\"customer_details\";a:33:{s:14:\"address_arabic\";s:6:\"bvcbvc\";s:16:\"street_is_arabic\";s:7:\"bvcvbvc\";s:15:\"building_number\";N;s:4:\"pour\";N;s:11:\"area_arabic\";N;s:14:\"city_is_arabic\";N;s:12:\"other_phones\";N;s:20:\"social_status_arabic\";N;s:7:\"mailbox\";N;s:13:\"title_english\";N;s:15:\"area_is_english\";N;s:6:\"reason\";N;s:15:\"name_is_English\";N;s:10:\"issuing_id\";N;s:15:\"city_is_english\";N;s:12:\"customer_age\";N;s:17:\"street_is_english\";N;s:21:\"social_status_english\";N;s:14:\"place_of_issue\";N;s:8:\"children\";N;s:24:\"number_of_family_members\";N;s:18:\"accommodation_type\";N;s:5:\"email\";N;s:19:\"card_version_number\";N;s:14:\"place_of_birth\";N;s:19:\"number_of_irritants\";N;s:12:\"conservation\";N;s:10:\"occupation\";N;s:13:\"identity_type\";N;s:11:\"age_of_wife\";N;s:11:\"age_of_boys\";N;s:7:\"seniors\";N;s:8:\"patients\";N;}}', '2019-08-26 08:01:58', '2019-08-26 08:01:58'),
(241, 10, 'admin', 'update_customer_details', 'a:2:{s:8:\"customer\";a:7:{s:4:\"name\";s:9:\"123456789\";s:9:\"id_number\";s:9:\"798564132\";s:11:\"nationality\";s:7:\"testing\";s:13:\"mobile_number\";s:9:\"798564132\";s:11:\"home_number\";s:9:\"798546321\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:8;}s:16:\"customer_details\";a:33:{s:14:\"address_arabic\";s:6:\"bvcbvc\";s:16:\"street_is_arabic\";s:7:\"bvcvbvc\";s:15:\"building_number\";N;s:4:\"pour\";N;s:11:\"area_arabic\";N;s:14:\"city_is_arabic\";N;s:12:\"other_phones\";N;s:20:\"social_status_arabic\";N;s:7:\"mailbox\";N;s:13:\"title_english\";N;s:15:\"area_is_english\";N;s:6:\"reason\";N;s:15:\"name_is_English\";N;s:10:\"issuing_id\";N;s:15:\"city_is_english\";N;s:12:\"customer_age\";N;s:17:\"street_is_english\";N;s:21:\"social_status_english\";N;s:14:\"place_of_issue\";N;s:8:\"children\";N;s:24:\"number_of_family_members\";N;s:18:\"accommodation_type\";N;s:5:\"email\";N;s:19:\"card_version_number\";N;s:14:\"place_of_birth\";N;s:19:\"number_of_irritants\";N;s:12:\"conservation\";N;s:10:\"occupation\";N;s:13:\"identity_type\";N;s:11:\"age_of_wife\";N;s:11:\"age_of_boys\";N;s:7:\"seniors\";N;s:8:\"patients\";N;}}', '2019-08-26 08:02:43', '2019-08-26 08:02:43'),
(242, 10, 'admin', 'user_login', 'login', '2019-08-26 15:54:56', '2019-08-26 15:54:56'),
(243, 10, 'admin', 'user_login', 'login', '2019-08-26 15:56:03', '2019-08-26 15:56:03'),
(244, 10, 'admin', 'user_logout', 'logout', '2019-08-26 15:56:13', '2019-08-26 15:56:13'),
(245, 10, 'admin', 'user_login', 'login', '2019-08-26 15:56:18', '2019-08-26 15:56:18'),
(246, 10, 'admin', 'user_logout', 'logout', '2019-08-26 15:56:27', '2019-08-26 15:56:27'),
(247, 10, 'admin', 'user_logout', 'logout', '2019-08-26 15:56:39', '2019-08-26 15:56:39'),
(248, 10, 'admin', 'user_login', 'login', '2019-08-26 15:56:41', '2019-08-26 15:56:41'),
(249, 10, 'admin', 'user_login', 'login', '2019-08-26 15:56:58', '2019-08-26 15:56:58'),
(250, 10, 'admin', 'update_user', 'a:2:{s:4:\"user\";a:5:{s:4:\"name\";s:12:\"Admin Master\";s:8:\"username\";s:5:\"admin\";s:5:\"email\";s:17:\"testing@gmail.com\";s:7:\"role_id\";s:1:\"1\";s:2:\"id\";i:10;}s:9:\"user_data\";a:8:{s:6:\"gender\";s:4:\"male\";s:11:\"nationality\";s:7:\"testing\";s:13:\"qualification\";s:3:\"phd\";s:8:\"position\";s:7:\"testing\";s:16:\"passport_expired\";s:10:\"2019-08-16\";s:16:\"end_of_residence\";s:10:\"2019-08-16\";s:16:\"end_of_insurance\";s:10:\"2019-08-16\";s:6:\"salary\";s:6:\"520.00\";}}', '2019-08-26 16:10:22', '2019-08-26 16:10:22'),
(251, 10, 'admin', 'create_status', '1', '2019-08-26 16:12:15', '2019-08-26 16:12:15'),
(252, 10, 'admin', 'update_status', 'a:5:{s:11:\"nationality\";s:12:\"xPhilippines\";s:19:\"nationality_english\";s:12:\"xPhilippines\";s:5:\"state\";s:12:\"xPhilippines\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:1;}', '2019-08-26 16:12:24', '2019-08-26 16:12:24'),
(253, 10, 'admin', 'update_status', 'a:5:{s:11:\"nationality\";s:11:\"Philippines\";s:19:\"nationality_english\";s:11:\"Philippines\";s:5:\"state\";s:11:\"Philippines\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:1;}', '2019-08-26 16:12:36', '2019-08-26 16:12:36'),
(254, 10, 'admin', 'create_nationality', '2', '2019-08-26 16:14:17', '2019-08-26 16:14:17'),
(255, 10, 'admin', 'create_nationality', '3', '2019-08-26 16:14:40', '2019-08-26 16:14:40'),
(256, 10, 'admin', 'create_airport', '4', '2019-08-26 16:15:25', '2019-08-26 16:15:25'),
(257, 10, 'admin', 'create_airport', '5', '2019-08-26 16:15:52', '2019-08-26 16:15:52'),
(258, 10, 'admin', 'delete_airport', '1', '2019-08-26 16:15:56', '2019-08-26 16:15:56'),
(259, 10, 'admin', 'delete_office', '38', '2019-08-26 16:16:32', '2019-08-26 16:16:32'),
(260, 10, 'admin', 'delete_office', '36', '2019-08-26 16:16:36', '2019-08-26 16:16:36'),
(261, 10, 'admin', 'delete_office', '34', '2019-08-26 16:16:40', '2019-08-26 16:16:40'),
(262, 10, 'admin', 'delete_office', '32', '2019-08-26 16:16:44', '2019-08-26 16:16:44'),
(263, 10, 'admin', 'create_office', '39', '2019-08-26 16:17:37', '2019-08-26 16:17:37'),
(264, 10, 'admin', 'create_office', '40', '2019-08-26 16:18:12', '2019-08-26 16:18:12'),
(265, 10, 'admin', 'delete_conreact_source', '2', '2019-08-26 16:18:58', '2019-08-26 16:18:58'),
(266, 10, 'admin', 'delete_conreact_source', '1', '2019-08-26 16:19:01', '2019-08-26 16:19:01'),
(267, 10, 'admin', 'create_conreact_source', '4', '2019-08-26 16:19:11', '2019-08-26 16:19:11'),
(268, 10, 'admin', 'create_conreact_source', '5', '2019-08-26 16:19:19', '2019-08-26 16:19:19'),
(269, 10, 'admin', 'create_conreact_source', '6', '2019-08-26 16:19:27', '2019-08-26 16:19:27'),
(270, 10, 'admin', 'delete_profession', '14', '2019-08-26 16:19:44', '2019-08-26 16:19:44'),
(271, 10, 'admin', 'delete_profession', '13', '2019-08-26 16:19:46', '2019-08-26 16:19:46'),
(272, 10, 'admin', 'delete_profession', '12', '2019-08-26 16:19:50', '2019-08-26 16:19:50'),
(273, 10, 'admin', 'delete_profession', '11', '2019-08-26 16:19:52', '2019-08-26 16:19:52'),
(274, 10, 'admin', 'delete_profession', '10', '2019-08-26 16:19:55', '2019-08-26 16:19:55'),
(275, 10, 'admin', 'delete_profession', '9', '2019-08-26 16:19:57', '2019-08-26 16:19:57'),
(276, 10, 'admin', 'delete_profession', '8', '2019-08-26 16:20:00', '2019-08-26 16:20:00'),
(277, 10, 'admin', 'delete_profession', '7', '2019-08-26 16:20:02', '2019-08-26 16:20:02'),
(278, 10, 'admin', 'delete_profession', '6', '2019-08-26 16:20:05', '2019-08-26 16:20:05'),
(279, 10, 'admin', 'delete_profession', '1', '2019-08-26 16:20:08', '2019-08-26 16:20:08'),
(280, 10, 'admin', 'create_profession', '16', '2019-08-26 16:24:02', '2019-08-26 16:24:02'),
(281, 10, 'admin', 'create_profession', '17', '2019-08-26 16:24:13', '2019-08-26 16:24:13'),
(282, 10, 'admin', 'create_profession', '18', '2019-08-26 16:24:31', '2019-08-26 16:24:31'),
(283, 10, 'admin', 'delete_user', '12', '2019-08-26 16:24:46', '2019-08-26 16:24:46'),
(284, 10, 'admin', 'delete_status', '15', '2019-08-26 16:25:21', '2019-08-26 16:25:21'),
(285, 10, 'admin', 'delete_status', '14', '2019-08-26 16:25:23', '2019-08-26 16:25:23'),
(286, 10, 'admin', 'delete_status', '12', '2019-08-26 16:25:26', '2019-08-26 16:25:26'),
(287, 10, 'admin', 'delete_status', '10', '2019-08-26 16:25:29', '2019-08-26 16:25:29'),
(288, 10, 'admin', 'delete_status', '9', '2019-08-26 16:25:31', '2019-08-26 16:25:31'),
(289, 10, 'admin', 'delete_status', '8', '2019-08-26 16:25:34', '2019-08-26 16:25:34'),
(290, 10, 'admin', 'delete_status', '7', '2019-08-26 16:25:37', '2019-08-26 16:25:37'),
(291, 10, 'admin', 'delete_status', '6', '2019-08-26 16:25:41', '2019-08-26 16:25:41'),
(292, 10, 'admin', 'delete_status', '1', '2019-08-26 16:25:43', '2019-08-26 16:25:43'),
(293, 10, 'admin', 'delete_cv', '4', '2019-08-26 16:27:59', '2019-08-26 16:27:59'),
(294, 10, 'admin', 'delete_religion', '6', '2019-08-26 16:28:25', '2019-08-26 16:28:25'),
(295, 10, 'admin', 'delete_religion', '1', '2019-08-26 16:28:28', '2019-08-26 16:28:28'),
(296, 10, 'admin', 'create_religion', '9', '2019-08-26 16:28:34', '2019-08-26 16:28:34'),
(297, 10, 'admin', 'create_religion', '10', '2019-08-26 16:28:43', '2019-08-26 16:28:43'),
(298, 10, 'admin', 'create_religion', '11', '2019-08-26 16:28:51', '2019-08-26 16:28:51'),
(299, 10, 'admin', 'update_terms_and_advantage', 'a:2:{s:19:\"terms_and_advantage\";s:25:\"Already Work - Experience\";s:2:\"id\";i:2;}', '2019-08-26 16:38:24', '2019-08-26 16:38:24'),
(300, 10, 'admin', 'delete_terms_and_advantage', '1', '2019-08-26 16:38:29', '2019-08-26 16:38:29'),
(301, 10, 'admin', 'create_terms_and_advantage', '4', '2019-08-26 16:38:40', '2019-08-26 16:38:40'),
(302, 10, 'admin', 'update_qualifications_and_experience', 'a:2:{s:29:\"qualifications_and_experience\";s:10:\"House work\";s:2:\"id\";i:1;}', '2019-08-26 16:39:04', '2019-08-26 16:39:04'),
(303, 10, 'admin', 'create_qualifications_and_experience', '3', '2019-08-26 16:39:13', '2019-08-26 16:39:13'),
(304, 10, 'admin', 'create_marketer', '3', '2019-08-26 16:40:07', '2019-08-26 16:40:07'),
(305, 10, 'admin', 'delete_marketer', '1', '2019-08-26 16:40:11', '2019-08-26 16:40:11'),
(306, 10, 'admin', 'create_marketer', '4', '2019-08-26 16:40:26', '2019-08-26 16:40:26'),
(307, 10, 'admin', 'delete_customer', '8', '2019-08-26 16:41:01', '2019-08-26 16:41:01'),
(308, 10, 'admin', 'delete_customer', '7', '2019-08-26 16:41:04', '2019-08-26 16:41:04'),
(309, 10, 'admin', 'delete_customer', '6', '2019-08-26 16:41:07', '2019-08-26 16:41:07'),
(310, 10, 'admin', 'delete_customer', '2', '2019-08-26 16:41:11', '2019-08-26 16:41:11'),
(311, 10, 'admin', 'delete_customer', '1', '2019-08-26 16:41:14', '2019-08-26 16:41:14'),
(312, 10, 'admin', 'create_cv', '6', '2019-08-26 16:43:53', '2019-08-26 16:43:53'),
(313, 10, 'admin', 'update_customer_details', 'a:2:{s:8:\"customer\";a:7:{s:4:\"name\";s:4:\"name\";s:9:\"id_number\";s:10:\"7894561230\";s:14:\"nationality_id\";s:1:\"2\";s:13:\"mobile_number\";s:10:\"9874563210\";s:11:\"home_number\";s:9:\"974563210\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:1;}s:16:\"customer_details\";a:33:{s:14:\"address_arabic\";N;s:16:\"street_is_arabic\";N;s:15:\"building_number\";N;s:4:\"pour\";N;s:11:\"area_arabic\";N;s:14:\"city_is_arabic\";N;s:12:\"other_phones\";N;s:20:\"social_status_arabic\";N;s:7:\"mailbox\";N;s:13:\"title_english\";N;s:15:\"area_is_english\";N;s:6:\"reason\";N;s:15:\"name_is_English\";N;s:10:\"issuing_id\";N;s:15:\"city_is_english\";N;s:12:\"customer_age\";N;s:17:\"street_is_english\";N;s:21:\"social_status_english\";N;s:14:\"place_of_issue\";N;s:8:\"children\";N;s:24:\"number_of_family_members\";N;s:18:\"accommodation_type\";N;s:5:\"email\";N;s:19:\"card_version_number\";N;s:14:\"place_of_birth\";N;s:19:\"number_of_irritants\";N;s:12:\"conservation\";N;s:10:\"occupation\";N;s:13:\"identity_type\";N;s:11:\"age_of_wife\";N;s:11:\"age_of_boys\";N;s:7:\"seniors\";N;s:8:\"patients\";N;}}', '2019-08-26 17:24:36', '2019-08-26 17:24:36'),
(314, 10, 'admin', 'create_customer', '9', '2019-08-26 17:26:30', '2019-08-26 17:26:30'),
(315, 10, 'admin', 'user_login', 'login', '2019-08-27 14:59:24', '2019-08-27 14:59:24'),
(316, 10, 'admin', 'user_login', 'login', '2019-08-28 13:51:49', '2019-08-28 13:51:49'),
(317, 10, 'admin', 'employment_contract', 'a:32:{s:15:\"contract_number\";s:10:\"s65464r45r\";s:12:\"second_party\";s:6:\"Ahemad\";s:24:\"duration_of_the_contract\";s:1:\"4\";s:14:\"contract_value\";s:4:\"5000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";s:2:\"20\";s:9:\"visa_fees\";s:2:\"70\";s:11:\"visa_number\";s:11:\"4sa2a1sd31a\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"3\";s:14:\"destination_id\";s:1:\"1\";s:14:\"monthly_salary\";s:5:\"50000\";s:18:\"contract_source_id\";s:1:\"5\";s:10:\"airport_id\";s:1:\"5\";s:12:\"holiday_days\";s:2:\"12\";s:13:\"delay_per_day\";s:1:\"1\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"35\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:6:\"client\";s:4:\"Friz\";s:5:\"to_me\";s:3:\"add\";s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"currency_id\";s:1:\"2\";s:11:\"marketer_id\";s:1:\"4\";s:13:\"marketer_fare\";s:3:\"700\";s:15:\"mission_history\";s:5:\"sadad\";s:16:\"date_of_contract\";s:10:\"2019-08-28\";s:9:\"visa_date\";s:10:\"2019-09-20\";s:19:\"corresponding_to_ad\";s:10:\"2019-08-29\";s:9:\"extradata\";s:123:\"{\"have_been_reached\":\"1\",\"motivation\":\"1\",\"cases\":\"1\",\"authorized\":\"1\",\"rests\":\"1\",\"is_over\":\"1\",\"discarded\":\"1\",\"vip\":\"1\"}\";}', '2019-08-28 14:44:16', '2019-08-28 14:44:16'),
(318, 10, 'admin', 'user_login', 'login', '2019-08-29 10:51:26', '2019-08-29 10:51:26'),
(319, 10, 'admin', 'user_login', 'login', '2019-08-29 18:42:15', '2019-08-29 18:42:15'),
(320, 10, 'admin', 'create_ticket', '1', '2019-08-29 18:44:33', '2019-08-29 18:44:33'),
(321, 10, 'admin', 'user_login', 'login', '2019-08-29 19:36:22', '2019-08-29 19:36:22'),
(322, 10, 'admin', 'add_ticket_comment', '{\"ticket_id\":1}', '2019-08-29 19:37:14', '2019-08-29 19:37:14'),
(323, 10, 'admin', 'user_login', 'login', '2019-08-30 10:30:40', '2019-08-30 10:30:40'),
(324, 10, 'admin', 'user_login', 'login', '2019-08-31 19:04:02', '2019-08-31 19:04:02'),
(325, 10, 'admin', 'user_login', 'login', '2019-09-02 15:15:53', '2019-09-02 15:15:53'),
(326, 10, 'admin', 'create_status', '1', '2019-09-02 16:05:07', '2019-09-02 16:05:07'),
(327, 10, 'admin', 'user_login', 'login', '2019-09-02 16:08:49', '2019-09-02 16:08:49'),
(328, 10, 'admin', 'update_cost_center', 'a:4:{s:11:\"center_name\";s:13:\"Cost Center 1\";s:19:\"center_name_english\";s:7:\"testing\";s:5:\"notes\";s:8:\"tesyting\";s:2:\"id\";i:4;}', '2019-09-02 16:14:07', '2019-09-02 16:14:07'),
(329, 10, 'admin', 'user_login', 'login', '2019-09-03 10:31:35', '2019-09-03 10:31:35'),
(330, 10, 'admin', 'delete_country', '10', '2019-09-03 10:35:34', '2019-09-03 10:35:34'),
(331, 10, 'admin', 'delete_country', '9', '2019-09-03 10:35:38', '2019-09-03 10:35:38'),
(332, 10, 'admin', 'delete_country', '6', '2019-09-03 10:35:42', '2019-09-03 10:35:42'),
(333, 10, 'admin', 'user_login', 'login', '2019-09-03 19:35:42', '2019-09-03 19:35:42'),
(334, 10, 'admin', 'user_login', 'login', '2019-09-03 19:52:48', '2019-09-03 19:52:48'),
(335, 10, 'admin', 'employment_contract', 'a:32:{s:15:\"contract_number\";s:10:\"s65464r45r\";s:12:\"second_party\";s:6:\"Ahemad\";s:24:\"duration_of_the_contract\";s:1:\"4\";s:14:\"contract_value\";s:4:\"5000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";s:2:\"20\";s:9:\"visa_fees\";s:2:\"70\";s:11:\"visa_number\";s:11:\"4sa2a1sd31a\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"3\";s:14:\"destination_id\";s:1:\"1\";s:14:\"monthly_salary\";s:5:\"50000\";s:18:\"contract_source_id\";s:1:\"5\";s:10:\"airport_id\";s:1:\"5\";s:12:\"holiday_days\";s:2:\"12\";s:13:\"delay_per_day\";s:1:\"1\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"35\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:6:\"client\";s:4:\"Friz\";s:5:\"to_me\";s:3:\"add\";s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"currency_id\";s:1:\"2\";s:11:\"marketer_id\";s:1:\"4\";s:13:\"marketer_fare\";s:3:\"700\";s:15:\"mission_history\";s:5:\"sadad\";s:16:\"date_of_contract\";s:10:\"2019-08-28\";s:9:\"visa_date\";s:10:\"2019-09-20\";s:19:\"corresponding_to_ad\";s:10:\"2019-08-29\";s:9:\"extradata\";s:168:\"{\"have_been_reached\":\"1\",\"motivation\":\"1\",\"cases\":\"1\",\"authorized\":\"1\",\"rests\":\"1\",\"is_over\":\"1\",\"discarded\":\"1\",\"vip\":\"1\",\"agent\":\"1\",\"certain\":\"1\",\"local_office\":\"1\"}\";}', '2019-09-03 19:53:11', '2019-09-03 19:53:11'),
(336, 10, 'admin', 'user_login', 'login', '2019-09-03 20:01:10', '2019-09-03 20:01:10'),
(337, 10, 'admin', 'user_login', 'login', '2019-09-03 20:26:38', '2019-09-03 20:26:38'),
(338, 10, 'admin', 'create_status', '2', '2019-09-03 20:33:08', '2019-09-03 20:33:08'),
(339, 10, 'admin', 'user_login', 'login', '2019-09-03 23:05:41', '2019-09-03 23:05:41'),
(340, 10, 'admin', 'user_login', 'login', '2019-09-04 11:21:12', '2019-09-04 11:21:12'),
(341, 10, 'admin', 'update_status', 'a:4:{s:4:\"name\";s:19:\"تم التفويض\";s:11:\"office_type\";s:1:\"1\";s:14:\"nationality_id\";s:1:\"1\";s:2:\"id\";i:2;}', '2019-09-04 14:03:42', '2019-09-04 14:03:42'),
(342, 10, 'admin', 'update_status', 'a:4:{s:4:\"name\";s:7:\"NEW-NEW\";s:11:\"office_type\";s:1:\"1\";s:14:\"nationality_id\";s:1:\"1\";s:2:\"id\";i:1;}', '2019-09-04 14:03:55', '2019-09-04 14:03:55'),
(343, 10, 'admin', 'employment_contract', 'a:32:{s:15:\"contract_number\";s:10:\"s65464r45r\";s:12:\"second_party\";s:6:\"Ahemad\";s:24:\"duration_of_the_contract\";s:1:\"4\";s:14:\"contract_value\";s:4:\"5000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";s:2:\"20\";s:9:\"visa_fees\";s:2:\"70\";s:11:\"visa_number\";s:11:\"4sa2a1sd31a\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"1\";s:14:\"monthly_salary\";s:5:\"50000\";s:18:\"contract_source_id\";s:1:\"5\";s:10:\"airport_id\";s:1:\"5\";s:12:\"holiday_days\";s:2:\"12\";s:13:\"delay_per_day\";s:1:\"1\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"35\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:6:\"client\";s:4:\"Friz\";s:5:\"to_me\";s:3:\"add\";s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"currency_id\";s:1:\"2\";s:11:\"marketer_id\";s:1:\"4\";s:13:\"marketer_fare\";s:3:\"700\";s:15:\"mission_history\";s:5:\"sadad\";s:16:\"date_of_contract\";s:10:\"2019-08-28\";s:9:\"visa_date\";s:10:\"2019-09-20\";s:19:\"corresponding_to_ad\";s:10:\"2019-08-29\";s:9:\"extradata\";s:17:\"{\"1\":\"1\",\"2\":\"2\"}\";}', '2019-09-04 14:07:35', '2019-09-04 14:07:35'),
(344, 10, 'admin', 'employment_contract', 'a:32:{s:15:\"contract_number\";s:10:\"s65464r45r\";s:12:\"second_party\";s:6:\"Ahemad\";s:24:\"duration_of_the_contract\";s:1:\"4\";s:14:\"contract_value\";s:4:\"5000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";s:2:\"20\";s:9:\"visa_fees\";s:2:\"70\";s:11:\"visa_number\";s:11:\"4sa2a1sd31a\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"1\";s:14:\"monthly_salary\";s:5:\"50000\";s:18:\"contract_source_id\";s:1:\"5\";s:10:\"airport_id\";s:1:\"5\";s:12:\"holiday_days\";s:2:\"12\";s:13:\"delay_per_day\";s:1:\"1\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"35\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:6:\"client\";s:4:\"Friz\";s:5:\"to_me\";s:3:\"add\";s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"currency_id\";s:1:\"2\";s:11:\"marketer_id\";s:1:\"4\";s:13:\"marketer_fare\";s:3:\"700\";s:15:\"mission_history\";s:5:\"sadad\";s:16:\"date_of_contract\";s:10:\"2019-08-28\";s:9:\"visa_date\";s:10:\"2019-09-20\";s:19:\"corresponding_to_ad\";s:10:\"2019-08-29\";s:9:\"extradata\";s:9:\"{\"1\":\"1\"}\";}', '2019-09-04 14:08:13', '2019-09-04 14:08:13'),
(345, 10, 'admin', 'employment_contract', 'a:32:{s:15:\"contract_number\";s:10:\"s65464r45r\";s:12:\"second_party\";s:6:\"Ahemad\";s:24:\"duration_of_the_contract\";s:1:\"4\";s:14:\"contract_value\";s:4:\"5000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";s:2:\"20\";s:9:\"visa_fees\";s:2:\"70\";s:11:\"visa_number\";s:11:\"4sa2a1sd31a\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"1\";s:14:\"monthly_salary\";s:5:\"50000\";s:18:\"contract_source_id\";s:1:\"5\";s:10:\"airport_id\";s:1:\"5\";s:12:\"holiday_days\";s:2:\"12\";s:13:\"delay_per_day\";s:1:\"1\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"35\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:6:\"client\";s:4:\"Friz\";s:5:\"to_me\";s:3:\"add\";s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"currency_id\";s:1:\"2\";s:11:\"marketer_id\";s:1:\"4\";s:13:\"marketer_fare\";s:3:\"700\";s:15:\"mission_history\";s:5:\"sadad\";s:16:\"date_of_contract\";s:10:\"2019-08-28\";s:9:\"visa_date\";s:10:\"2019-09-20\";s:19:\"corresponding_to_ad\";s:10:\"2019-08-29\";s:9:\"extradata\";s:17:\"{\"1\":\"1\",\"2\":\"2\"}\";}', '2019-09-04 14:08:27', '2019-09-04 14:08:27'),
(346, 10, 'admin', 'user_login', 'login', '2019-09-04 14:50:44', '2019-09-04 14:50:44'),
(347, 10, 'admin', 'delete_status', '1', '2019-09-04 14:52:14', '2019-09-04 14:52:14'),
(348, 10, 'admin', 'delete_status', '2', '2019-09-04 14:52:17', '2019-09-04 14:52:17'),
(349, 10, 'admin', 'create_status', '3', '2019-09-04 14:53:26', '2019-09-04 14:53:26'),
(350, 10, 'admin', 'create_status', '4', '2019-09-04 14:53:42', '2019-09-04 14:53:42'),
(351, 10, 'admin', 'create_status', '5', '2019-09-04 14:53:59', '2019-09-04 14:53:59'),
(352, 10, 'admin', 'create_status', '6', '2019-09-04 14:54:15', '2019-09-04 14:54:15'),
(353, 10, 'admin', 'update_status', 'a:4:{s:4:\"name\";s:5:\"Cases\";s:11:\"office_type\";s:1:\"2\";s:14:\"nationality_id\";s:1:\"1\";s:2:\"id\";i:3;}', '2019-09-04 14:54:23', '2019-09-04 14:54:23'),
(354, 10, 'admin', 'update_status', 'a:4:{s:4:\"name\";s:5:\"Agent\";s:11:\"office_type\";s:1:\"2\";s:14:\"nationality_id\";s:1:\"2\";s:2:\"id\";i:5;}', '2019-09-04 14:54:33', '2019-09-04 14:54:33'),
(355, 10, 'admin', 'create_status', '7', '2019-09-04 14:54:45', '2019-09-04 14:54:45'),
(356, 10, 'admin', 'create_status', '8', '2019-09-04 14:55:43', '2019-09-04 14:55:43'),
(357, 10, 'admin', 'update_status', 'a:4:{s:4:\"name\";s:6:\"jaydip\";s:11:\"office_type\";s:1:\"2\";s:14:\"nationality_id\";s:1:\"1\";s:2:\"id\";i:8;}', '2019-09-04 15:00:27', '2019-09-04 15:00:27'),
(358, 10, 'admin', 'update_status', 'a:4:{s:4:\"name\";s:6:\"jaydip\";s:11:\"office_type\";s:1:\"1\";s:14:\"nationality_id\";s:1:\"1\";s:2:\"id\";i:8;}', '2019-09-04 15:01:02', '2019-09-04 15:01:02'),
(359, 10, 'admin', 'create_status', '9', '2019-09-04 15:02:01', '2019-09-04 15:02:01'),
(360, 10, 'admin', 'delete_status', '9', '2019-09-04 15:02:17', '2019-09-04 15:02:17'),
(361, 10, 'admin', 'delete_status', '8', '2019-09-04 15:02:22', '2019-09-04 15:02:22'),
(362, 10, 'admin', 'update_status', 'a:4:{s:4:\"name\";s:4:\"test\";s:11:\"office_type\";s:1:\"2\";s:14:\"nationality_id\";s:1:\"3\";s:2:\"id\";i:7;}', '2019-09-04 15:02:29', '2019-09-04 15:02:29'),
(363, 10, 'admin', 'update_status', 'a:4:{s:4:\"name\";s:4:\"test\";s:11:\"office_type\";s:1:\"1\";s:14:\"nationality_id\";s:1:\"3\";s:2:\"id\";i:7;}', '2019-09-04 15:02:37', '2019-09-04 15:02:37'),
(364, 10, 'admin', 'update_status', 'a:4:{s:4:\"name\";s:7:\"111test\";s:11:\"office_type\";s:1:\"1\";s:14:\"nationality_id\";s:1:\"3\";s:2:\"id\";i:7;}', '2019-09-04 15:02:46', '2019-09-04 15:02:46'),
(365, 10, 'admin', 'delete_status', '7', '2019-09-04 15:02:50', '2019-09-04 15:02:50'),
(366, 10, 'admin', 'create_status', '10', '2019-09-04 15:03:09', '2019-09-04 15:03:09'),
(367, 10, 'admin', 'create_status', '11', '2019-09-04 15:03:27', '2019-09-04 15:03:27'),
(368, 10, 'admin', 'employment_contract', 'a:32:{s:15:\"contract_number\";s:10:\"s65464r45r\";s:12:\"second_party\";s:6:\"Ahemad\";s:24:\"duration_of_the_contract\";s:1:\"4\";s:14:\"contract_value\";s:4:\"5000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";s:2:\"20\";s:9:\"visa_fees\";s:2:\"70\";s:11:\"visa_number\";s:11:\"4sa2a1sd31a\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"2\";s:14:\"destination_id\";s:1:\"1\";s:14:\"monthly_salary\";s:5:\"50000\";s:18:\"contract_source_id\";s:1:\"5\";s:10:\"airport_id\";s:1:\"5\";s:12:\"holiday_days\";s:2:\"12\";s:13:\"delay_per_day\";s:1:\"1\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"35\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:6:\"client\";s:4:\"Friz\";s:5:\"to_me\";s:3:\"add\";s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"currency_id\";s:1:\"2\";s:11:\"marketer_id\";s:1:\"4\";s:13:\"marketer_fare\";s:3:\"700\";s:15:\"mission_history\";s:5:\"sadad\";s:16:\"date_of_contract\";s:10:\"2019-08-28\";s:9:\"visa_date\";s:10:\"2019-09-20\";s:19:\"corresponding_to_ad\";s:10:\"2019-08-29\";s:9:\"extradata\";s:17:\"{\"6\":\"6\",\"5\":\"5\"}\";}', '2019-09-04 15:12:43', '2019-09-04 15:12:43'),
(369, 10, 'admin', 'employment_contract', 'a:32:{s:15:\"contract_number\";s:10:\"s65464r45r\";s:12:\"second_party\";s:6:\"Ahemad\";s:24:\"duration_of_the_contract\";s:1:\"4\";s:14:\"contract_value\";s:4:\"5000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";s:2:\"20\";s:9:\"visa_fees\";s:2:\"70\";s:11:\"visa_number\";s:11:\"4sa2a1sd31a\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"1\";s:14:\"monthly_salary\";s:5:\"50000\";s:18:\"contract_source_id\";s:1:\"5\";s:10:\"airport_id\";s:1:\"5\";s:12:\"holiday_days\";s:2:\"12\";s:13:\"delay_per_day\";s:1:\"1\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"35\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:6:\"client\";s:4:\"Friz\";s:5:\"to_me\";s:3:\"add\";s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"currency_id\";s:1:\"2\";s:11:\"marketer_id\";s:1:\"4\";s:13:\"marketer_fare\";s:3:\"700\";s:15:\"mission_history\";s:5:\"sadad\";s:16:\"date_of_contract\";s:10:\"2019-08-28\";s:9:\"visa_date\";s:10:\"2019-09-20\";s:19:\"corresponding_to_ad\";s:10:\"2019-08-29\";s:9:\"extradata\";s:17:\"{\"4\":\"4\",\"3\":\"3\"}\";}', '2019-09-04 15:12:56', '2019-09-04 15:12:56'),
(370, 10, 'admin', 'employment_contract', 'a:32:{s:15:\"contract_number\";s:10:\"s65464r45r\";s:12:\"second_party\";s:6:\"Ahemad\";s:24:\"duration_of_the_contract\";s:1:\"4\";s:14:\"contract_value\";s:4:\"5000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";s:2:\"20\";s:9:\"visa_fees\";s:2:\"70\";s:11:\"visa_number\";s:11:\"4sa2a1sd31a\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"2\";s:14:\"destination_id\";s:1:\"1\";s:14:\"monthly_salary\";s:5:\"50000\";s:18:\"contract_source_id\";s:1:\"5\";s:10:\"airport_id\";s:1:\"5\";s:12:\"holiday_days\";s:2:\"12\";s:13:\"delay_per_day\";s:1:\"1\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"35\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:6:\"client\";s:4:\"Friz\";s:5:\"to_me\";s:3:\"add\";s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"currency_id\";s:1:\"2\";s:11:\"marketer_id\";s:1:\"4\";s:13:\"marketer_fare\";s:3:\"700\";s:15:\"mission_history\";s:5:\"sadad\";s:16:\"date_of_contract\";s:10:\"2019-08-28\";s:9:\"visa_date\";s:10:\"2019-09-20\";s:19:\"corresponding_to_ad\";s:10:\"2019-08-29\";s:9:\"extradata\";s:17:\"{\"6\":\"6\",\"5\":\"5\"}\";}', '2019-09-04 15:13:09', '2019-09-04 15:13:09'),
(371, 10, 'admin', 'employment_contract', 'a:32:{s:15:\"contract_number\";s:10:\"s65464r45r\";s:12:\"second_party\";s:6:\"Ahemad\";s:24:\"duration_of_the_contract\";s:1:\"4\";s:14:\"contract_value\";s:4:\"5000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";s:2:\"20\";s:9:\"visa_fees\";s:2:\"70\";s:11:\"visa_number\";s:11:\"4sa2a1sd31a\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"3\";s:14:\"destination_id\";s:1:\"1\";s:14:\"monthly_salary\";s:5:\"50000\";s:18:\"contract_source_id\";s:1:\"5\";s:10:\"airport_id\";s:1:\"5\";s:12:\"holiday_days\";s:2:\"12\";s:13:\"delay_per_day\";s:1:\"1\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"35\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:6:\"client\";s:4:\"Friz\";s:5:\"to_me\";s:3:\"add\";s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"currency_id\";s:1:\"2\";s:11:\"marketer_id\";s:1:\"4\";s:13:\"marketer_fare\";s:3:\"700\";s:15:\"mission_history\";s:5:\"sadad\";s:16:\"date_of_contract\";s:10:\"2019-08-28\";s:9:\"visa_date\";s:10:\"2019-09-20\";s:19:\"corresponding_to_ad\";s:10:\"2019-08-29\";s:9:\"extradata\";s:21:\"{\"10\":\"10\",\"11\":\"11\"}\";}', '2019-09-04 15:13:22', '2019-09-04 15:13:22'),
(372, 10, 'admin', 'user_login', 'login', '2019-09-05 14:39:46', '2019-09-05 14:39:46'),
(373, 10, 'admin', 'create_invoice', '1', '2019-09-05 15:36:04', '2019-09-05 15:36:04'),
(374, 10, 'admin', 'add_invoice_payment', 'i:1;', '2019-09-05 15:39:01', '2019-09-05 15:39:01'),
(375, 10, 'admin', 'add_invoice_payment', 'i:2;', '2019-09-05 15:42:06', '2019-09-05 15:42:06'),
(376, 10, 'admin', 'delete_invoice_payment', '2', '2019-09-05 15:43:17', '2019-09-05 15:43:17'),
(377, 10, 'admin', 'update_invoice', 'a:9:{s:4:\"date\";s:16:\"2019-09-05 03:09\";s:11:\"customer_id\";s:1:\"9\";s:8:\"due_date\";s:10:\"2019-09-06\";s:10:\"shipped_to\";s:7:\"testing\";s:8:\"discount\";s:5:\"20.00\";s:5:\"notes\";s:7:\"testing\";s:3:\"tax\";s:6:\"100.00\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:1;}', '2019-09-05 15:44:10', '2019-09-05 15:44:10'),
(378, 10, 'admin', 'add_invoice_payment', 'i:3;', '2019-09-05 15:44:31', '2019-09-05 15:44:31'),
(379, 10, 'admin', 'delete_invoice', '1', '2019-09-05 15:50:43', '2019-09-05 15:50:43'),
(380, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"9\",\"status\":\"1\"}', '2019-09-05 16:01:30', '2019-09-05 16:01:30'),
(381, 10, 'admin', 'create_invoice', '2', '2019-09-05 16:09:20', '2019-09-05 16:09:20'),
(382, 10, 'admin', 'update_invoice', 'a:9:{s:4:\"date\";s:16:\"2019-09-05 04:09\";s:11:\"customer_id\";s:1:\"9\";s:8:\"due_date\";s:10:\"2019-09-05\";s:10:\"shipped_to\";s:7:\"testing\";s:8:\"discount\";s:5:\"20.00\";s:5:\"notes\";s:7:\"testing\";s:3:\"tax\";s:5:\"10.00\";s:6:\"status\";s:1:\"4\";s:2:\"id\";i:2;}', '2019-09-05 16:09:31', '2019-09-05 16:09:31'),
(383, 10, 'admin', 'add_invoice_payment', 'i:4;', '2019-09-05 16:09:47', '2019-09-05 16:09:47'),
(384, 10, 'admin', 'update_invoice', 'a:9:{s:4:\"date\";s:16:\"2019-09-05 04:09\";s:11:\"customer_id\";s:1:\"9\";s:8:\"due_date\";s:10:\"2019-09-05\";s:10:\"shipped_to\";s:7:\"testing\";s:8:\"discount\";s:3:\"500\";s:5:\"notes\";s:7:\"testing\";s:3:\"tax\";s:5:\"10.00\";s:6:\"status\";s:1:\"4\";s:2:\"id\";i:2;}', '2019-09-05 17:26:34', '2019-09-05 17:26:34'),
(385, 10, 'admin', 'update_invoice', 'a:9:{s:4:\"date\";s:16:\"2019-09-05 04:09\";s:11:\"customer_id\";s:1:\"9\";s:8:\"due_date\";s:10:\"2019-09-05\";s:10:\"shipped_to\";s:7:\"testing\";s:8:\"discount\";s:2:\"10\";s:5:\"notes\";s:7:\"testing\";s:3:\"tax\";s:5:\"10.00\";s:6:\"status\";s:1:\"4\";s:2:\"id\";i:2;}', '2019-09-05 17:27:08', '2019-09-05 17:27:08'),
(386, 10, 'admin', 'update_invoice', 'a:9:{s:4:\"date\";s:16:\"2019-09-05 04:09\";s:11:\"customer_id\";s:1:\"9\";s:8:\"due_date\";s:10:\"2019-09-05\";s:10:\"shipped_to\";s:7:\"testing\";s:8:\"discount\";s:5:\"10.00\";s:5:\"notes\";s:7:\"testing\";s:3:\"tax\";s:5:\"10.00\";s:6:\"status\";s:1:\"4\";s:2:\"id\";i:2;}', '2019-09-05 17:27:21', '2019-09-05 17:27:21'),
(387, 10, 'admin', 'update_invoice_payment', 'a:4:{s:4:\"date\";s:10:\"2019-09-06\";s:11:\"amount_paid\";s:2:\"10\";s:4:\"note\";s:7:\"testing\";s:2:\"id\";i:4;}', '2019-09-05 17:27:54', '2019-09-05 17:27:54'),
(388, 10, 'admin', 'create_invoice', '3', '2019-09-05 17:29:51', '2019-09-05 17:29:51'),
(389, 10, 'admin', 'update_invoice', 'a:9:{s:4:\"date\";s:16:\"2019-09-01 05:09\";s:11:\"customer_id\";s:1:\"9\";s:8:\"due_date\";s:10:\"2019-09-05\";s:10:\"shipped_to\";s:7:\"testing\";s:8:\"discount\";s:5:\"10.00\";s:5:\"notes\";s:7:\"testing\";s:3:\"tax\";s:5:\"10.00\";s:6:\"status\";s:1:\"3\";s:2:\"id\";i:3;}', '2019-09-05 17:30:00', '2019-09-05 17:30:00'),
(390, 10, 'admin', 'update_invoice', 'a:9:{s:4:\"date\";s:16:\"2019-09-01 05:09\";s:11:\"customer_id\";s:1:\"9\";s:8:\"due_date\";s:10:\"2019-09-05\";s:10:\"shipped_to\";s:7:\"testing\";s:8:\"discount\";s:5:\"10.00\";s:5:\"notes\";s:7:\"testing\";s:3:\"tax\";s:5:\"10.00\";s:6:\"status\";s:1:\"4\";s:2:\"id\";i:3;}', '2019-09-05 17:30:07', '2019-09-05 17:30:07'),
(391, 10, 'admin', 'add_invoice_payment', 'i:5;', '2019-09-05 17:32:41', '2019-09-05 17:32:41'),
(392, 10, 'admin', 'add_invoice_payment', 'i:6;', '2019-09-05 17:33:01', '2019-09-05 17:33:01'),
(393, 10, 'admin', 'update_invoice', 'a:9:{s:4:\"date\";s:16:\"2019-09-01 05:09\";s:11:\"customer_id\";s:1:\"9\";s:8:\"due_date\";s:10:\"2019-09-05\";s:10:\"shipped_to\";s:7:\"testing\";s:8:\"discount\";s:5:\"10.00\";s:5:\"notes\";s:7:\"testing\";s:3:\"tax\";s:5:\"10.00\";s:6:\"status\";s:1:\"4\";s:2:\"id\";i:3;}', '2019-09-05 17:33:51', '2019-09-05 17:33:51'),
(394, 10, 'admin', 'update_invoice', 'a:9:{s:4:\"date\";s:16:\"2019-09-01 05:09\";s:11:\"customer_id\";s:1:\"9\";s:8:\"due_date\";s:10:\"2019-09-05\";s:10:\"shipped_to\";s:7:\"testing\";s:8:\"discount\";s:5:\"10.00\";s:5:\"notes\";s:7:\"testing\";s:3:\"tax\";s:5:\"10.00\";s:6:\"status\";s:1:\"4\";s:2:\"id\";i:3;}', '2019-09-05 17:34:10', '2019-09-05 17:34:10'),
(395, 10, 'admin', 'delete_invoice_payment', '6', '2019-09-05 18:07:43', '2019-09-05 18:07:43'),
(396, 10, 'admin', 'delete_invoice_payment', '4', '2019-09-05 18:07:50', '2019-09-05 18:07:50'),
(397, 10, 'admin', 'update_invoice', 'a:9:{s:4:\"date\";s:16:\"2019-09-01 05:09\";s:11:\"customer_id\";s:1:\"9\";s:8:\"due_date\";s:10:\"2019-09-05\";s:10:\"shipped_to\";s:7:\"testing\";s:8:\"discount\";s:5:\"10.00\";s:5:\"notes\";s:7:\"testing\";s:3:\"tax\";s:5:\"10.00\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:3;}', '2019-09-05 18:08:05', '2019-09-05 18:08:05'),
(398, 10, 'admin', 'update_invoice', 'a:9:{s:4:\"date\";s:16:\"2019-09-01 05:09\";s:11:\"customer_id\";s:1:\"9\";s:8:\"due_date\";s:10:\"2019-09-05\";s:10:\"shipped_to\";s:7:\"testing\";s:8:\"discount\";s:5:\"10.00\";s:5:\"notes\";s:7:\"testing\";s:3:\"tax\";s:5:\"10.00\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:3;}', '2019-09-05 18:08:13', '2019-09-05 18:08:13'),
(399, 10, 'admin', 'add_invoice_payment', 'i:7;', '2019-09-05 18:08:23', '2019-09-05 18:08:23'),
(400, 10, 'admin', 'update_invoice_payment', 'a:4:{s:4:\"date\";s:10:\"2019-09-05\";s:11:\"amount_paid\";s:1:\"1\";s:4:\"note\";N;s:2:\"id\";i:7;}', '2019-09-05 18:08:42', '2019-09-05 18:08:42'),
(401, 10, 'admin', 'update_invoice_payment', 'a:4:{s:4:\"date\";s:10:\"2019-09-12\";s:11:\"amount_paid\";s:2:\"10\";s:4:\"note\";s:7:\"testing\";s:2:\"id\";i:5;}', '2019-09-05 18:17:06', '2019-09-05 18:17:06'),
(402, 10, 'admin', 'update_invoice_payment', 'a:4:{s:4:\"date\";s:10:\"2019-09-05\";s:11:\"amount_paid\";s:4:\"1.00\";s:4:\"note\";N;s:2:\"id\";i:7;}', '2019-09-05 18:20:01', '2019-09-05 18:20:01'),
(403, 10, 'admin', 'update_invoice_payment', 'a:4:{s:4:\"date\";s:10:\"2019-09-05\";s:11:\"amount_paid\";s:2:\"10\";s:4:\"note\";N;s:2:\"id\";i:7;}', '2019-09-05 18:20:58', '2019-09-05 18:20:58'),
(404, 10, 'admin', 'update_invoice_payment', 'a:4:{s:4:\"date\";s:10:\"2019-09-05\";s:11:\"amount_paid\";s:2:\"89\";s:4:\"note\";N;s:2:\"id\";i:7;}', '2019-09-05 18:21:25', '2019-09-05 18:21:25'),
(405, 10, 'admin', 'add_invoice_payment', 'i:8;', '2019-09-05 18:21:38', '2019-09-05 18:21:38'),
(406, 10, 'admin', 'delete_invoice_payment', '7', '2019-09-05 18:23:33', '2019-09-05 18:23:33'),
(407, 10, 'admin', 'update_invoice_payment', 'a:4:{s:4:\"date\";s:10:\"2019-09-12\";s:11:\"amount_paid\";s:2:\"99\";s:4:\"note\";s:7:\"testing\";s:2:\"id\";i:5;}', '2019-09-05 18:23:49', '2019-09-05 18:23:49'),
(408, 10, 'admin', 'update_invoice_payment', 'a:4:{s:4:\"date\";s:10:\"2019-09-12\";s:11:\"amount_paid\";s:2:\"98\";s:4:\"note\";s:7:\"testing\";s:2:\"id\";i:5;}', '2019-09-05 18:24:12', '2019-09-05 18:24:12'),
(409, 10, 'admin', 'update_invoice_payment', 'a:4:{s:4:\"date\";s:10:\"2019-09-12\";s:11:\"amount_paid\";s:2:\"97\";s:4:\"note\";s:7:\"testing\";s:2:\"id\";i:5;}', '2019-09-05 18:24:33', '2019-09-05 18:24:33'),
(410, 10, 'admin', 'add_invoice_payment', 'i:9;', '2019-09-05 18:24:56', '2019-09-05 18:24:56'),
(411, 10, 'admin', 'update_invoice', 'a:9:{s:4:\"date\";s:16:\"2019-09-01 05:09\";s:11:\"customer_id\";s:1:\"9\";s:8:\"due_date\";s:10:\"2019-09-05\";s:10:\"shipped_to\";s:7:\"testing\";s:8:\"discount\";s:5:\"10.00\";s:5:\"notes\";s:7:\"testing\";s:3:\"tax\";s:5:\"10.00\";s:6:\"status\";s:1:\"2\";s:2:\"id\";i:3;}', '2019-09-05 18:25:38', '2019-09-05 18:25:38'),
(412, 10, 'admin', 'delete_invoice_payment', '9', '2019-09-05 18:25:47', '2019-09-05 18:25:47'),
(413, 10, 'admin', 'user_logout', 'logout', '2019-09-05 19:05:36', '2019-09-05 19:05:36'),
(414, 10, 'admin', 'user_logout', 'logout', '2019-09-06 19:08:40', '2019-09-06 19:08:40'),
(415, 10, 'admin', 'user_logout', 'logout', '2019-09-06 19:18:05', '2019-09-06 19:18:05'),
(416, 10, 'admin', 'user_logout', 'logout', '2019-09-06 19:26:16', '2019-09-06 19:26:16'),
(417, 10, 'admin', 'user_login', 'login', '2019-09-07 01:28:23', '2019-09-07 01:28:23'),
(418, 10, 'admin', 'employment_contract', 'a:31:{s:15:\"contract_number\";s:10:\"s65464r45r\";s:12:\"second_party\";s:6:\"Ahemad\";s:24:\"duration_of_the_contract\";s:1:\"4\";s:14:\"contract_value\";s:4:\"5000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";s:2:\"20\";s:9:\"visa_fees\";s:2:\"70\";s:11:\"visa_number\";s:11:\"4sa2a1sd31a\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"1\";s:14:\"monthly_salary\";s:5:\"50000\";s:18:\"contract_source_id\";s:1:\"5\";s:10:\"airport_id\";s:1:\"5\";s:12:\"holiday_days\";s:2:\"12\";s:13:\"delay_per_day\";s:1:\"1\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"35\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:6:\"client\";s:4:\"Friz\";s:5:\"to_me\";s:3:\"add\";s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"currency_id\";s:1:\"2\";s:11:\"marketer_id\";s:1:\"4\";s:13:\"marketer_fare\";s:3:\"700\";s:15:\"mission_history\";s:5:\"sadad\";s:16:\"date_of_contract\";s:10:\"2019-08-28\";s:9:\"visa_date\";s:10:\"2019-09-20\";s:19:\"corresponding_to_ad\";s:10:\"2019-08-29\";}', '2019-09-07 01:31:39', '2019-09-07 01:31:39'),
(419, 10, 'admin', 'user_login', 'login', '2019-09-07 10:20:06', '2019-09-07 10:20:06'),
(420, 10, 'admin', 'user_login', 'login', '2019-09-07 11:53:16', '2019-09-07 11:53:16'),
(421, 10, 'admin', 'update_user', 'a:2:{s:4:\"user\";a:6:{s:11:\"profile_pic\";s:43:\"storage/profile_pic/2145040940_download.png\";s:4:\"name\";s:12:\"Admin Master\";s:8:\"username\";s:5:\"admin\";s:5:\"email\";s:25:\"connectusdemo12@gmail.com\";s:7:\"role_id\";s:1:\"1\";s:2:\"id\";i:10;}s:9:\"user_data\";a:8:{s:6:\"gender\";s:4:\"male\";s:11:\"nationality\";s:7:\"testing\";s:13:\"qualification\";s:3:\"phd\";s:8:\"position\";s:7:\"testing\";s:16:\"passport_expired\";s:10:\"2019-08-16\";s:16:\"end_of_residence\";s:10:\"2019-08-16\";s:16:\"end_of_insurance\";s:10:\"2019-08-16\";s:6:\"salary\";s:6:\"520.00\";}}', '2019-09-07 11:53:40', '2019-09-07 11:53:40'),
(422, 10, 'admin', 'update_user', 'a:2:{s:4:\"user\";a:6:{s:11:\"profile_pic\";s:35:\"storage/profile_pic/365514529_1.jpg\";s:4:\"name\";s:12:\"Admin Master\";s:8:\"username\";s:5:\"admin\";s:5:\"email\";s:25:\"connectusdemo12@gmail.com\";s:7:\"role_id\";s:1:\"1\";s:2:\"id\";i:10;}s:9:\"user_data\";a:8:{s:6:\"gender\";s:4:\"male\";s:11:\"nationality\";s:7:\"testing\";s:13:\"qualification\";s:3:\"phd\";s:8:\"position\";s:7:\"testing\";s:16:\"passport_expired\";s:10:\"2019-08-16\";s:16:\"end_of_residence\";s:10:\"2019-08-16\";s:16:\"end_of_insurance\";s:10:\"2019-08-16\";s:6:\"salary\";s:6:\"520.00\";}}', '2019-09-07 11:54:16', '2019-09-07 11:54:16'),
(423, 10, 'admin', 'update_user', 'a:2:{s:4:\"user\";a:6:{s:11:\"profile_pic\";s:43:\"storage/profile_pic/1932357048_download.png\";s:4:\"name\";s:12:\"Admin Master\";s:8:\"username\";s:5:\"admin\";s:5:\"email\";s:25:\"connectusdemo12@gmail.com\";s:7:\"role_id\";s:1:\"1\";s:2:\"id\";i:10;}s:9:\"user_data\";a:8:{s:6:\"gender\";s:4:\"male\";s:11:\"nationality\";s:7:\"testing\";s:13:\"qualification\";s:3:\"phd\";s:8:\"position\";s:7:\"testing\";s:16:\"passport_expired\";s:10:\"2019-08-16\";s:16:\"end_of_residence\";s:10:\"2019-08-16\";s:16:\"end_of_insurance\";s:10:\"2019-08-16\";s:6:\"salary\";s:6:\"520.00\";}}', '2019-09-07 11:54:27', '2019-09-07 11:54:27'),
(424, 10, 'admin', 'user_logout', 'logout', '2019-09-07 11:54:35', '2019-09-07 11:54:35'),
(425, 10, 'admin', 'user_login', 'login', '2019-09-07 11:55:36', '2019-09-07 11:55:36'),
(426, 10, 'admin', 'user_login', 'login', '2019-09-09 10:34:07', '2019-09-09 10:34:07'),
(427, 10, 'admin', 'user_login', 'login', '2019-09-09 10:42:04', '2019-09-09 10:42:04'),
(428, 10, 'admin', 'user_login', 'login', '2019-09-10 11:37:21', '2019-09-10 11:37:21'),
(429, 10, 'admin', 'user_login', 'login', '2019-09-11 16:36:19', '2019-09-11 16:36:19'),
(430, 10, 'admin', 'create_status', '4', '2019-09-11 16:38:03', '2019-09-11 16:38:03'),
(431, 10, 'admin', 'create_status', '12', '2019-09-11 16:38:27', '2019-09-11 16:38:27'),
(432, 10, 'admin', 'create_status', '13', '2019-09-11 16:38:39', '2019-09-11 16:38:39'),
(433, 10, 'admin', 'create_status', '14', '2019-09-11 16:39:13', '2019-09-11 16:39:13'),
(434, 10, 'admin', 'create_status', '15', '2019-09-11 16:39:45', '2019-09-11 16:39:45'),
(435, 10, 'admin', 'user_logout', 'logout', '2019-09-11 16:48:05', '2019-09-11 16:48:05'),
(436, 10, 'admin', 'user_login', 'login', '2019-09-11 17:02:48', '2019-09-11 17:02:48'),
(437, 10, 'admin', 'user_login', 'login', '2019-09-11 17:06:47', '2019-09-11 17:06:47'),
(438, 10, 'admin', 'create_status', '16', '2019-09-11 17:10:11', '2019-09-11 17:10:11'),
(439, 10, 'admin', 'user_login', 'login', '2019-09-11 17:10:18', '2019-09-11 17:10:18'),
(440, 10, 'admin', 'create_status', '17', '2019-09-11 17:10:42', '2019-09-11 17:10:42'),
(441, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"9\",\"status\":\"2\"}', '2019-09-11 18:19:24', '2019-09-11 18:19:24'),
(442, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"9\",\"status\":\"1\"}', '2019-09-11 18:19:32', '2019-09-11 18:19:32'),
(443, 10, 'admin', 'user_login', 'login', '2019-09-12 11:40:55', '2019-09-12 11:40:55');
INSERT INTO `activity_log` (`id`, `user_id`, `username`, `key`, `value`, `created_at`, `updated_at`) VALUES
(444, 10, 'admin', 'employment_contract', 'a:32:{s:15:\"contract_number\";s:10:\"s65464r45r\";s:12:\"second_party\";s:6:\"Ahemad\";s:24:\"duration_of_the_contract\";s:1:\"4\";s:14:\"contract_value\";s:4:\"5000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";s:2:\"20\";s:9:\"visa_fees\";s:2:\"70\";s:11:\"visa_number\";s:11:\"4sa2a1sd31a\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"1\";s:14:\"monthly_salary\";s:5:\"50000\";s:18:\"contract_source_id\";s:1:\"5\";s:10:\"airport_id\";s:1:\"5\";s:12:\"holiday_days\";s:2:\"12\";s:13:\"delay_per_day\";s:1:\"1\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"35\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:6:\"client\";s:4:\"Friz\";s:5:\"to_me\";s:3:\"add\";s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"currency_id\";s:1:\"2\";s:11:\"marketer_id\";s:1:\"4\";s:13:\"marketer_fare\";s:3:\"700\";s:15:\"mission_history\";s:5:\"sadad\";s:16:\"date_of_contract\";s:10:\"2019-08-28\";s:9:\"visa_date\";s:10:\"2019-09-20\";s:19:\"corresponding_to_ad\";s:10:\"2019-08-29\";s:9:\"extradata\";s:21:\"{\"17\":\"17\",\"15\":\"15\"}\";}', '2019-09-12 11:43:19', '2019-09-12 11:43:19'),
(445, 10, 'admin', 'user_login', 'login', '2019-09-12 12:19:42', '2019-09-12 12:19:42'),
(446, 10, 'admin', 'create_customer', '10', '2019-09-12 12:21:13', '2019-09-12 12:21:13'),
(447, 10, 'admin', 'user_login', 'login', '2019-09-12 18:30:37', '2019-09-12 18:30:37'),
(448, 10, 'admin', 'user_login', 'login', '2019-09-14 12:53:39', '2019-09-14 12:53:39'),
(449, 10, 'admin', 'user_login', 'login', '2019-09-15 11:55:13', '2019-09-15 11:55:13'),
(450, 10, 'admin', 'create_customer', '11', '2019-09-15 11:58:14', '2019-09-15 11:58:14'),
(451, 10, 'admin', 'employment_contract', 'a:30:{s:15:\"contract_number\";s:2:\"11\";s:12:\"second_party\";N;s:24:\"duration_of_the_contract\";s:2:\"90\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1901681167\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1200\";s:18:\"contract_source_id\";s:1:\"6\";s:10:\"airport_id\";s:1:\"4\";s:12:\"holiday_days\";N;s:13:\"delay_per_day\";N;s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:5:\"35-40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:6:\"client\";N;s:5:\"to_me\";N;s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"currency_id\";s:1:\"2\";s:11:\"marketer_id\";s:1:\"3\";s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-09-15\";s:9:\"visa_date\";s:10:\"2019-09-09\";}', '2019-09-15 12:14:35', '2019-09-15 12:14:35'),
(452, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"11\",\"status\":\"1\"}', '2019-09-15 12:15:13', '2019-09-15 12:15:13'),
(453, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"11\",\"status\":\"2\"}', '2019-09-15 12:15:17', '2019-09-15 12:15:17'),
(454, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"11\",\"status\":\"1\"}', '2019-09-15 12:15:19', '2019-09-15 12:15:19'),
(455, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"11\",\"status\":\"2\"}', '2019-09-15 12:15:41', '2019-09-15 12:15:41'),
(456, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"11\",\"status\":\"1\"}', '2019-09-15 12:16:49', '2019-09-15 12:16:49'),
(457, 10, 'admin', 'employment_contract', 'a:30:{s:15:\"contract_number\";s:2:\"11\";s:12:\"second_party\";N;s:24:\"duration_of_the_contract\";s:2:\"90\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1901681167\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1200\";s:18:\"contract_source_id\";s:1:\"6\";s:10:\"airport_id\";s:1:\"4\";s:12:\"holiday_days\";N;s:13:\"delay_per_day\";N;s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:5:\"35-40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:6:\"client\";N;s:5:\"to_me\";N;s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"currency_id\";s:1:\"2\";s:11:\"marketer_id\";s:1:\"3\";s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-09-15\";s:9:\"visa_date\";s:10:\"2019-09-09\";}', '2019-09-15 12:17:44', '2019-09-15 12:17:44'),
(458, 10, 'admin', 'create_customer', '12', '2019-09-15 12:47:23', '2019-09-15 12:47:23'),
(459, 10, 'admin', 'employment_contract', 'a:32:{s:15:\"contract_number\";s:2:\"22\";s:12:\"second_party\";s:6:\"ههه\";s:24:\"duration_of_the_contract\";s:2:\"24\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";N;s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1900150011\";s:13:\"profession_id\";N;s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1600\";s:18:\"contract_source_id\";s:1:\"4\";s:10:\"airport_id\";s:1:\"5\";s:12:\"holiday_days\";s:2:\"30\";s:13:\"delay_per_day\";N;s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:6:\"client\";N;s:5:\"to_me\";N;s:32:\"qualifications_and_experience_id\";N;s:14:\"cost_center_id\";s:1:\"4\";s:11:\"currency_id\";N;s:11:\"marketer_id\";N;s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-09-15\";s:9:\"visa_date\";s:10:\"2019-09-09\";s:19:\"corresponding_to_ad\";s:10:\"2019-08-29\";s:9:\"extradata\";s:11:\"{\"17\":\"17\"}\";}', '2019-09-15 12:56:08', '2019-09-15 12:56:08'),
(460, 10, 'admin', 'update_currency', 'a:4:{s:13:\"currency_name\";s:19:\"ريال سعودي\";s:21:\"currency_name_english\";s:2:\"SR\";s:12:\"abbreviation\";s:2:\"SR\";s:2:\"id\";i:2;}', '2019-09-15 13:22:49', '2019-09-15 13:22:49'),
(461, 10, 'admin', 'update_cv', 'a:11:{s:4:\"name\";s:10:\"Loren Wood\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:11:\"religion_id\";s:2:\"10\";s:3:\"age\";s:2:\"32\";s:19:\"previous_experience\";s:1:\"2\";s:9:\"office_id\";s:2:\"39\";s:15:\"passport_number\";s:12:\"14545ASDD545\";s:11:\"reservation\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"id\";i:6;}', '2019-09-15 13:47:32', '2019-09-15 13:47:32'),
(462, 10, 'admin', 'add_ticket_comment', '{\"ticket_id\":1}', '2019-09-15 13:50:30', '2019-09-15 13:50:30'),
(463, 10, 'admin', 'ticket_status_update', '{\"ticket_id\":1,\"status\":2}', '2019-09-15 13:50:42', '2019-09-15 13:50:42'),
(464, 10, 'admin', 'user_login', 'login', '2019-09-16 13:06:20', '2019-09-16 13:06:20'),
(465, 10, 'admin', 'user_login', 'login', '2019-09-16 15:16:32', '2019-09-16 15:16:32'),
(466, 10, 'admin', 'employment_contract', 'a:33:{s:15:\"contract_number\";s:2:\"22\";s:12:\"second_party\";s:6:\"ههه\";s:24:\"duration_of_the_contract\";s:2:\"24\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";N;s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1900150011\";s:13:\"profession_id\";N;s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1600\";s:18:\"contract_source_id\";s:1:\"4\";s:10:\"airport_id\";s:1:\"5\";s:12:\"holiday_days\";s:2:\"30\";s:13:\"delay_per_day\";N;s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:6:\"client\";N;s:5:\"to_me\";N;s:32:\"qualifications_and_experience_id\";N;s:14:\"cost_center_id\";s:1:\"4\";s:11:\"currency_id\";N;s:11:\"marketer_id\";N;s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-09-15\";s:9:\"visa_date\";s:10:\"2019-09-09\";s:19:\"corresponding_to_ad\";s:10:\"2019-08-29\";s:12:\"arrival_date\";s:10:\"2019-09-07\";s:9:\"extradata\";s:11:\"{\"17\":\"17\"}\";}', '2019-09-16 16:25:39', '2019-09-16 16:25:39'),
(467, 10, 'admin', 'employment_contract', 'a:33:{s:15:\"contract_number\";s:10:\"s65464r45r\";s:12:\"second_party\";s:6:\"Ahemad\";s:24:\"duration_of_the_contract\";s:1:\"4\";s:14:\"contract_value\";s:4:\"5000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";s:2:\"20\";s:9:\"visa_fees\";s:2:\"70\";s:11:\"visa_number\";s:11:\"4sa2a1sd31a\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"1\";s:14:\"monthly_salary\";s:5:\"50000\";s:18:\"contract_source_id\";s:1:\"5\";s:10:\"airport_id\";s:1:\"5\";s:12:\"holiday_days\";s:2:\"12\";s:13:\"delay_per_day\";s:1:\"1\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"35\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:6:\"client\";s:4:\"Friz\";s:5:\"to_me\";s:3:\"add\";s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"currency_id\";s:1:\"2\";s:11:\"marketer_id\";s:1:\"4\";s:13:\"marketer_fare\";s:3:\"700\";s:15:\"mission_history\";s:5:\"sadad\";s:16:\"date_of_contract\";s:10:\"2019-08-28\";s:9:\"visa_date\";s:10:\"2019-09-20\";s:19:\"corresponding_to_ad\";s:10:\"2019-08-29\";s:12:\"arrival_date\";s:10:\"2018-07-05\";s:9:\"extradata\";s:21:\"{\"17\":\"17\",\"15\":\"15\"}\";}', '2019-09-16 16:27:59', '2019-09-16 16:27:59'),
(468, 10, 'admin', 'employment_contract', 'a:27:{s:15:\"contract_number\";s:10:\"s65464r45r\";s:24:\"duration_of_the_contract\";s:1:\"4\";s:14:\"contract_value\";s:4:\"5000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";s:2:\"20\";s:9:\"visa_fees\";s:2:\"70\";s:11:\"visa_number\";s:11:\"4sa2a1sd31a\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"1\";s:14:\"monthly_salary\";s:5:\"50000\";s:18:\"contract_source_id\";s:1:\"5\";s:10:\"airport_id\";s:1:\"5\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"35\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";s:2:\"39\";s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";s:1:\"4\";s:13:\"marketer_fare\";s:3:\"700\";s:15:\"mission_history\";s:5:\"sadad\";s:16:\"date_of_contract\";s:10:\"2019-08-28\";s:9:\"visa_date\";s:10:\"2019-09-20\";s:12:\"arrival_date\";s:10:\"2018-07-05\";s:9:\"extradata\";s:21:\"{\"17\":\"17\",\"15\":\"15\"}\";}', '2019-09-16 19:08:56', '2019-09-16 19:08:56'),
(469, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"11\",\"status\":\"2\"}', '2019-09-16 19:35:51', '2019-09-16 19:35:51'),
(470, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"12\",\"status\":\"1\"}', '2019-09-16 19:43:49', '2019-09-16 19:43:49'),
(471, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"11\",\"status\":\"1\"}', '2019-09-16 19:44:18', '2019-09-16 19:44:18'),
(472, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"12\",\"status\":\"2\"}', '2019-09-16 19:44:31', '2019-09-16 19:44:31'),
(473, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"12\",\"status\":\"1\"}', '2019-09-16 19:45:00', '2019-09-16 19:45:00'),
(474, 10, 'admin', 'user_login', 'login', '2019-09-17 11:20:35', '2019-09-17 11:20:35'),
(475, 10, 'admin', 'employment_contract', 'a:28:{s:15:\"contract_number\";s:2:\"22\";s:5:\"cv_id\";s:1:\"6\";s:24:\"duration_of_the_contract\";s:2:\"24\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";N;s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1900150011\";s:13:\"profession_id\";N;s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1600\";s:18:\"contract_source_id\";s:1:\"4\";s:10:\"airport_id\";s:1:\"5\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";N;s:32:\"qualifications_and_experience_id\";N;s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";N;s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-09-15\";s:9:\"visa_date\";s:10:\"2019-09-09\";s:12:\"arrival_date\";s:10:\"2019-09-07\";s:9:\"extradata\";s:11:\"{\"17\":\"17\"}\";}', '2019-09-17 11:20:57', '2019-09-17 11:20:57'),
(476, 10, 'admin', 'employment_contract', 'a:28:{s:15:\"contract_number\";s:6:\"000012\";s:5:\"cv_id\";s:1:\"6\";s:24:\"duration_of_the_contract\";s:2:\"24\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";N;s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1900150011\";s:13:\"profession_id\";N;s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1600\";s:18:\"contract_source_id\";s:1:\"4\";s:10:\"airport_id\";s:1:\"5\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";N;s:32:\"qualifications_and_experience_id\";N;s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";N;s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-09-15\";s:9:\"visa_date\";s:10:\"2019-09-09\";s:12:\"arrival_date\";s:10:\"2019-09-07\";s:9:\"extradata\";s:11:\"{\"17\":\"17\"}\";}', '2019-09-17 11:41:54', '2019-09-17 11:41:54'),
(477, 10, 'admin', 'employment_contract', 'a:28:{s:15:\"contract_number\";s:6:\"000012\";s:5:\"cv_id\";s:1:\"6\";s:24:\"duration_of_the_contract\";s:2:\"24\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";N;s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1900150011\";s:13:\"profession_id\";N;s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1600\";s:18:\"contract_source_id\";s:1:\"4\";s:10:\"airport_id\";s:1:\"5\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";N;s:32:\"qualifications_and_experience_id\";N;s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";N;s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-09-15\";s:9:\"visa_date\";s:10:\"2019-09-09\";s:12:\"arrival_date\";s:10:\"2019-09-07\";s:9:\"extradata\";s:11:\"{\"17\":\"17\"}\";}', '2019-09-17 11:42:13', '2019-09-17 11:42:13'),
(478, 10, 'admin', 'employment_contract', 'a:28:{s:15:\"contract_number\";s:6:\"000009\";s:5:\"cv_id\";N;s:24:\"duration_of_the_contract\";s:1:\"4\";s:14:\"contract_value\";s:4:\"5000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";s:2:\"20\";s:9:\"visa_fees\";s:2:\"70\";s:11:\"visa_number\";s:11:\"4sa2a1sd31a\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"1\";s:14:\"monthly_salary\";s:5:\"50000\";s:18:\"contract_source_id\";s:1:\"5\";s:10:\"airport_id\";s:1:\"5\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"35\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";s:2:\"39\";s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";s:1:\"4\";s:13:\"marketer_fare\";s:3:\"700\";s:15:\"mission_history\";s:5:\"sadad\";s:16:\"date_of_contract\";s:10:\"2019-08-28\";s:9:\"visa_date\";s:10:\"2019-09-20\";s:12:\"arrival_date\";s:10:\"2018-07-05\";s:9:\"extradata\";s:21:\"{\"17\":\"17\",\"15\":\"15\"}\";}', '2019-09-17 11:42:28', '2019-09-17 11:42:28'),
(479, 10, 'admin', 'employment_contract', 'a:28:{s:15:\"contract_number\";s:6:\"000012\";s:5:\"cv_id\";s:1:\"6\";s:24:\"duration_of_the_contract\";s:2:\"24\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";N;s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1900150011\";s:13:\"profession_id\";N;s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1600\";s:18:\"contract_source_id\";s:1:\"4\";s:10:\"airport_id\";s:1:\"5\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";N;s:32:\"qualifications_and_experience_id\";N;s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";N;s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-09-15\";s:9:\"visa_date\";s:10:\"2019-09-09\";s:12:\"arrival_date\";s:10:\"2019-09-07\";s:9:\"extradata\";s:11:\"{\"17\":\"17\"}\";}', '2019-09-17 11:44:04', '2019-09-17 11:44:04'),
(480, 10, 'admin', 'employment_contract', 'a:26:{s:15:\"contract_number\";s:6:\"000011\";s:5:\"cv_id\";N;s:24:\"duration_of_the_contract\";s:2:\"90\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1901681167\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1200\";s:18:\"contract_source_id\";s:1:\"6\";s:10:\"airport_id\";s:1:\"4\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:5:\"35-40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";N;s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";s:1:\"3\";s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-09-15\";s:9:\"visa_date\";s:10:\"2019-09-09\";}', '2019-09-17 11:44:10', '2019-09-17 11:44:10'),
(481, 10, 'admin', 'employment_contract', 'a:28:{s:15:\"contract_number\";s:6:\"000009\";s:5:\"cv_id\";N;s:24:\"duration_of_the_contract\";s:1:\"4\";s:14:\"contract_value\";s:4:\"5000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";s:2:\"20\";s:9:\"visa_fees\";s:2:\"70\";s:11:\"visa_number\";s:11:\"4sa2a1sd31a\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"1\";s:14:\"monthly_salary\";s:5:\"50000\";s:18:\"contract_source_id\";s:1:\"5\";s:10:\"airport_id\";s:1:\"5\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"35\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";s:2:\"39\";s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";s:1:\"4\";s:13:\"marketer_fare\";s:3:\"700\";s:15:\"mission_history\";s:5:\"sadad\";s:16:\"date_of_contract\";s:10:\"2019-08-28\";s:9:\"visa_date\";s:10:\"2019-09-20\";s:12:\"arrival_date\";s:10:\"2018-07-05\";s:9:\"extradata\";s:21:\"{\"17\":\"17\",\"15\":\"15\"}\";}', '2019-09-17 11:44:22', '2019-09-17 11:44:22'),
(482, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"12\",\"status\":\"2\"}', '2019-09-17 11:47:09', '2019-09-17 11:47:09'),
(483, 10, 'admin', 'employment_contract', 'a:30:{s:15:\"contract_number\";s:6:\"000012\";s:5:\"cv_id\";s:1:\"6\";s:24:\"duration_of_the_contract\";s:2:\"24\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";N;s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1900150011\";s:13:\"profession_id\";N;s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1600\";s:18:\"contract_source_id\";s:1:\"4\";s:10:\"airport_id\";s:1:\"5\";s:12:\"arrival_time\";s:5:\"04:10\";s:6:\"ticket\";s:12:\"#78977987654\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";N;s:32:\"qualifications_and_experience_id\";N;s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";N;s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-09-15\";s:9:\"visa_date\";s:10:\"2019-09-09\";s:12:\"arrival_date\";s:10:\"2019-09-11\";s:9:\"extradata\";s:11:\"{\"17\":\"17\"}\";}', '2019-09-17 12:10:45', '2019-09-17 12:10:45'),
(484, 10, 'admin', 'employment_contract', 'a:30:{s:15:\"contract_number\";s:6:\"000012\";s:5:\"cv_id\";s:1:\"6\";s:24:\"duration_of_the_contract\";s:2:\"24\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";N;s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1900150011\";s:13:\"profession_id\";N;s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1600\";s:18:\"contract_source_id\";s:1:\"4\";s:10:\"airport_id\";s:1:\"5\";s:12:\"arrival_time\";s:5:\"23:59\";s:6:\"ticket\";s:12:\"#78977987654\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";N;s:32:\"qualifications_and_experience_id\";N;s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";N;s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-09-15\";s:9:\"visa_date\";s:10:\"2019-09-09\";s:12:\"arrival_date\";s:10:\"2019-09-11\";s:9:\"extradata\";s:11:\"{\"17\":\"17\"}\";}', '2019-09-17 12:13:49', '2019-09-17 12:13:49'),
(485, 10, 'admin', 'employment_contract', 'a:30:{s:15:\"contract_number\";s:6:\"000012\";s:5:\"cv_id\";s:1:\"6\";s:24:\"duration_of_the_contract\";s:2:\"24\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";N;s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1900150011\";s:13:\"profession_id\";N;s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1600\";s:18:\"contract_source_id\";s:1:\"4\";s:10:\"airport_id\";s:1:\"5\";s:12:\"arrival_time\";s:5:\"23:09\";s:6:\"ticket\";s:12:\"#78977987654\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";N;s:32:\"qualifications_and_experience_id\";N;s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";N;s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-09-15\";s:9:\"visa_date\";s:10:\"2019-09-09\";s:12:\"arrival_date\";s:10:\"2019-09-17\";s:9:\"extradata\";s:11:\"{\"17\":\"17\"}\";}', '2019-09-17 12:26:10', '2019-09-17 12:26:10'),
(486, 10, 'admin', 'employment_contract', 'a:30:{s:15:\"contract_number\";s:6:\"000012\";s:5:\"cv_id\";s:1:\"6\";s:24:\"duration_of_the_contract\";s:2:\"24\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";N;s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1900150011\";s:13:\"profession_id\";N;s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1600\";s:18:\"contract_source_id\";s:1:\"4\";s:10:\"airport_id\";s:1:\"5\";s:12:\"arrival_time\";s:5:\"23:09\";s:6:\"ticket\";s:12:\"#78977987654\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";N;s:32:\"qualifications_and_experience_id\";N;s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";N;s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-09-15\";s:9:\"visa_date\";s:10:\"2019-09-09\";s:12:\"arrival_date\";s:10:\"2019-09-17\";s:9:\"extradata\";s:31:\"{\"17\":\"17\",\"15\":\"15\",\"14\":\"14\"}\";}', '2019-09-17 15:16:30', '2019-09-17 15:16:30'),
(487, 10, 'admin', 'employment_contract_displayed_sataus', '{\"customer_id\":\"12\",\"displayed\":\"2\"}', '2019-09-17 15:16:36', '2019-09-17 15:16:36'),
(488, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"12\",\"status\":\"1\"}', '2019-09-17 15:28:53', '2019-09-17 15:28:53'),
(489, 10, 'admin', 'employment_contract_displayed_sataus', '{\"customer_id\":\"12\",\"displayed\":\"1\"}', '2019-09-17 15:32:45', '2019-09-17 15:32:45'),
(490, 10, 'admin', 'employment_contract', 'a:30:{s:15:\"contract_number\";s:6:\"000012\";s:5:\"cv_id\";s:1:\"6\";s:24:\"duration_of_the_contract\";s:2:\"24\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";N;s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1900150011\";s:13:\"profession_id\";N;s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1600\";s:18:\"contract_source_id\";s:1:\"4\";s:10:\"airport_id\";s:1:\"5\";s:12:\"arrival_time\";s:5:\"23:09\";s:6:\"ticket\";s:12:\"#78977987654\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";N;s:32:\"qualifications_and_experience_id\";N;s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";N;s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-01-01\";s:9:\"visa_date\";s:10:\"2019-09-09\";s:12:\"arrival_date\";s:10:\"2019-09-17\";s:9:\"extradata\";s:31:\"{\"17\":\"17\",\"15\":\"15\",\"14\":\"14\"}\";}', '2019-09-17 16:02:27', '2019-09-17 16:02:27'),
(491, 10, 'admin', 'employment_contract', 'a:30:{s:15:\"contract_number\";s:6:\"000012\";s:5:\"cv_id\";s:1:\"6\";s:24:\"duration_of_the_contract\";s:2:\"24\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";N;s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1900150011\";s:13:\"profession_id\";N;s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1600\";s:18:\"contract_source_id\";s:1:\"4\";s:10:\"airport_id\";s:1:\"5\";s:12:\"arrival_time\";s:5:\"23:09\";s:6:\"ticket\";s:12:\"#78977987654\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";N;s:32:\"qualifications_and_experience_id\";N;s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";N;s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-01-01\";s:9:\"visa_date\";s:10:\"2019-09-09\";s:12:\"arrival_date\";s:10:\"2019-02-01\";s:9:\"extradata\";s:31:\"{\"17\":\"17\",\"15\":\"15\",\"14\":\"14\"}\";}', '2019-09-17 16:10:21', '2019-09-17 16:10:21'),
(492, 10, 'admin', 'employment_contract', 'a:29:{s:15:\"contract_number\";s:6:\"000011\";s:5:\"cv_id\";N;s:24:\"duration_of_the_contract\";s:2:\"90\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1901681167\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1200\";s:18:\"contract_source_id\";s:1:\"6\";s:10:\"airport_id\";s:1:\"4\";s:12:\"arrival_time\";N;s:6:\"ticket\";N;s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:5:\"35-40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";N;s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";s:1:\"3\";s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-09-15\";s:9:\"visa_date\";s:10:\"2019-09-09\";s:12:\"arrival_date\";s:10:\"2019-09-17\";}', '2019-09-17 16:10:44', '2019-09-17 16:10:44'),
(493, 10, 'admin', 'user_login', 'login', '2019-09-17 16:13:30', '2019-09-17 16:13:30'),
(494, 10, 'admin', 'employment_contract', 'a:30:{s:15:\"contract_number\";s:6:\"000012\";s:5:\"cv_id\";s:1:\"6\";s:24:\"duration_of_the_contract\";s:2:\"24\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";N;s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1900150011\";s:13:\"profession_id\";N;s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1600\";s:18:\"contract_source_id\";s:1:\"4\";s:10:\"airport_id\";s:1:\"5\";s:12:\"arrival_time\";s:5:\"13:20\";s:6:\"ticket\";s:12:\"#78977987654\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";N;s:32:\"qualifications_and_experience_id\";N;s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";N;s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-01-01\";s:9:\"visa_date\";s:10:\"2019-09-09\";s:12:\"arrival_date\";s:10:\"2019-02-01\";s:9:\"extradata\";s:31:\"{\"17\":\"17\",\"15\":\"15\",\"14\":\"14\"}\";}', '2019-09-17 16:15:10', '2019-09-17 16:15:10'),
(495, 10, 'admin', 'employment_contract', 'a:30:{s:15:\"contract_number\";s:6:\"000012\";s:5:\"cv_id\";s:1:\"6\";s:24:\"duration_of_the_contract\";s:2:\"24\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";N;s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1900150011\";s:13:\"profession_id\";N;s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1600\";s:18:\"contract_source_id\";s:1:\"4\";s:10:\"airport_id\";s:1:\"5\";s:12:\"arrival_time\";s:5:\"22:59\";s:6:\"ticket\";s:12:\"#78977987654\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";N;s:32:\"qualifications_and_experience_id\";N;s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";N;s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-01-01\";s:9:\"visa_date\";s:10:\"2019-09-09\";s:12:\"arrival_date\";s:10:\"2019-02-01\";s:9:\"extradata\";s:31:\"{\"17\":\"17\",\"15\":\"15\",\"14\":\"14\"}\";}', '2019-09-17 16:15:31', '2019-09-17 16:15:31'),
(496, 10, 'admin', 'user_login', 'login', '2019-09-17 17:02:07', '2019-09-17 17:02:07'),
(497, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"11\",\"status\":\"2\"}', '2019-09-17 17:07:41', '2019-09-17 17:07:41'),
(498, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"9\",\"status\":\"2\"}', '2019-09-17 17:07:43', '2019-09-17 17:07:43'),
(499, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"11\",\"status\":\"1\"}', '2019-09-17 17:36:25', '2019-09-17 17:36:25'),
(500, 10, 'admin', 'employment_contract', 'a:29:{s:15:\"contract_number\";s:6:\"000011\";s:5:\"cv_id\";N;s:24:\"duration_of_the_contract\";s:2:\"90\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1901681167\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1200\";s:18:\"contract_source_id\";s:1:\"6\";s:10:\"airport_id\";s:1:\"4\";s:12:\"arrival_time\";N;s:6:\"ticket\";N;s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:5:\"35-40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";N;s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";s:1:\"3\";s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-09-15\";s:9:\"visa_date\";s:10:\"2019-09-09\";s:12:\"arrival_date\";s:10:\"2019-09-18\";}', '2019-09-17 17:46:03', '2019-09-17 17:46:03'),
(501, 10, 'admin', 'employment_contract', 'a:29:{s:15:\"contract_number\";s:6:\"000011\";s:5:\"cv_id\";N;s:24:\"duration_of_the_contract\";s:2:\"90\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1901681167\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1200\";s:18:\"contract_source_id\";s:1:\"6\";s:10:\"airport_id\";s:1:\"4\";s:12:\"arrival_time\";N;s:6:\"ticket\";N;s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:5:\"35-40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";N;s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";s:1:\"3\";s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-09-15\";s:9:\"visa_date\";s:10:\"2019-09-09\";s:12:\"arrival_date\";s:10:\"2019-09-17\";}', '2019-09-17 17:48:40', '2019-09-17 17:48:40'),
(502, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"11\",\"status\":\"2\"}', '2019-09-17 17:49:03', '2019-09-17 17:49:03'),
(503, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"12\",\"status\":\"2\"}', '2019-09-17 17:49:05', '2019-09-17 17:49:05'),
(504, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"12\",\"status\":\"1\"}', '2019-09-17 17:49:14', '2019-09-17 17:49:14'),
(505, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"12\",\"status\":\"2\"}', '2019-09-17 17:49:15', '2019-09-17 17:49:15'),
(506, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"12\",\"status\":\"1\"}', '2019-09-17 17:49:16', '2019-09-17 17:49:16'),
(507, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"11\",\"status\":\"1\"}', '2019-09-17 17:49:16', '2019-09-17 17:49:16'),
(508, 10, 'admin', 'employment_contract', 'a:30:{s:15:\"contract_number\";s:6:\"000009\";s:5:\"cv_id\";N;s:24:\"duration_of_the_contract\";s:1:\"4\";s:14:\"contract_value\";s:4:\"5000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";s:2:\"20\";s:9:\"visa_fees\";s:2:\"70\";s:11:\"visa_number\";s:11:\"4sa2a1sd31a\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"1\";s:14:\"monthly_salary\";s:5:\"50000\";s:18:\"contract_source_id\";s:1:\"5\";s:10:\"airport_id\";s:1:\"5\";s:12:\"arrival_time\";N;s:6:\"ticket\";N;s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"35\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";s:2:\"39\";s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";s:1:\"4\";s:13:\"marketer_fare\";s:3:\"700\";s:15:\"mission_history\";s:5:\"sadad\";s:16:\"date_of_contract\";s:10:\"2019-03-01\";s:9:\"visa_date\";s:10:\"2019-09-20\";s:12:\"arrival_date\";s:10:\"2019-09-01\";s:9:\"extradata\";s:21:\"{\"17\":\"17\",\"15\":\"15\"}\";}', '2019-09-17 18:02:36', '2019-09-17 18:02:36'),
(509, 10, 'admin', 'employment_contract', 'a:30:{s:15:\"contract_number\";s:6:\"000009\";s:5:\"cv_id\";N;s:24:\"duration_of_the_contract\";s:1:\"4\";s:14:\"contract_value\";s:4:\"5000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";s:2:\"20\";s:9:\"visa_fees\";s:2:\"70\";s:11:\"visa_number\";s:11:\"4sa2a1sd31a\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"1\";s:14:\"monthly_salary\";s:5:\"50000\";s:18:\"contract_source_id\";s:1:\"5\";s:10:\"airport_id\";s:1:\"5\";s:12:\"arrival_time\";N;s:6:\"ticket\";N;s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"35\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";s:2:\"39\";s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";s:1:\"4\";s:13:\"marketer_fare\";s:3:\"700\";s:15:\"mission_history\";s:5:\"sadad\";s:16:\"date_of_contract\";s:10:\"2019-03-03\";s:9:\"visa_date\";s:10:\"2019-09-20\";s:12:\"arrival_date\";s:10:\"2019-09-11\";s:9:\"extradata\";s:21:\"{\"17\":\"17\",\"15\":\"15\"}\";}', '2019-09-17 18:03:39', '2019-09-17 18:03:39'),
(510, 10, 'admin', 'employment_contract', 'a:30:{s:15:\"contract_number\";s:6:\"000009\";s:5:\"cv_id\";N;s:24:\"duration_of_the_contract\";s:1:\"4\";s:14:\"contract_value\";s:4:\"5000\";s:14:\"taxes_included\";s:1:\"1\";s:8:\"discount\";s:2:\"20\";s:9:\"visa_fees\";s:2:\"70\";s:11:\"visa_number\";s:11:\"4sa2a1sd31a\";s:13:\"profession_id\";s:2:\"17\";s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"1\";s:14:\"monthly_salary\";s:5:\"50000\";s:18:\"contract_source_id\";s:1:\"5\";s:10:\"airport_id\";s:1:\"5\";s:12:\"arrival_time\";N;s:6:\"ticket\";N;s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"35\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";s:2:\"39\";s:32:\"qualifications_and_experience_id\";s:1:\"1\";s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";s:1:\"4\";s:13:\"marketer_fare\";s:3:\"700\";s:15:\"mission_history\";s:5:\"sadad\";s:16:\"date_of_contract\";s:10:\"2019-03-04\";s:9:\"visa_date\";s:10:\"2019-09-20\";s:12:\"arrival_date\";s:10:\"2019-09-11\";s:9:\"extradata\";s:21:\"{\"17\":\"17\",\"15\":\"15\"}\";}', '2019-09-17 18:05:38', '2019-09-17 18:05:38'),
(511, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"9\",\"status\":\"1\"}', '2019-09-17 18:08:36', '2019-09-17 18:08:36'),
(512, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"9\",\"status\":\"2\"}', '2019-09-17 18:09:06', '2019-09-17 18:09:06'),
(513, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"12\",\"status\":\"2\"}', '2019-09-17 18:09:10', '2019-09-17 18:09:10'),
(514, 10, 'admin', 'user_login', 'login', '2019-09-21 00:33:52', '2019-09-21 00:33:52'),
(515, 10, 'admin', 'user_login', 'login', '2019-09-24 15:25:59', '2019-09-24 15:25:59'),
(516, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"12\",\"status\":\"1\"}', '2019-09-24 15:27:37', '2019-09-24 15:27:37'),
(517, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"12\",\"status\":\"2\"}', '2019-09-24 15:27:46', '2019-09-24 15:27:46'),
(518, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"12\",\"status\":\"1\"}', '2019-09-24 15:27:55', '2019-09-24 15:27:55'),
(519, 10, 'admin', 'employment_contract_sataus', '{\"customer_id\":\"9\",\"status\":\"1\"}', '2019-09-24 15:28:05', '2019-09-24 15:28:05'),
(520, 10, 'admin', 'employment_contract', 'a:30:{s:15:\"contract_number\";s:6:\"000012\";s:5:\"cv_id\";s:1:\"6\";s:24:\"duration_of_the_contract\";s:2:\"24\";s:14:\"contract_value\";s:5:\"17000\";s:14:\"taxes_included\";N;s:8:\"discount\";N;s:9:\"visa_fees\";N;s:11:\"visa_number\";s:10:\"1900150011\";s:13:\"profession_id\";N;s:14:\"nationality_id\";s:1:\"1\";s:14:\"destination_id\";s:1:\"2\";s:14:\"monthly_salary\";s:4:\"1600\";s:18:\"contract_source_id\";s:1:\"4\";s:10:\"airport_id\";s:1:\"5\";s:12:\"arrival_time\";s:5:\"22:09\";s:6:\"ticket\";s:12:\"#78977987654\";s:20:\"number_of_applicants\";s:1:\"1\";s:11:\"religion_id\";s:1:\"9\";s:3:\"age\";s:2:\"40\";s:23:\"terms_and_advantages_id\";s:1:\"2\";s:9:\"office_id\";N;s:32:\"qualifications_and_experience_id\";N;s:14:\"cost_center_id\";s:1:\"4\";s:11:\"marketer_id\";N;s:13:\"marketer_fare\";N;s:15:\"mission_history\";N;s:16:\"date_of_contract\";s:10:\"2019-01-01\";s:9:\"visa_date\";s:10:\"2019-09-09\";s:12:\"arrival_date\";s:10:\"2019-02-01\";s:9:\"extradata\";s:31:\"{\"17\":\"17\",\"15\":\"15\",\"14\":\"14\"}\";}', '2019-09-24 15:28:13', '2019-09-24 15:28:13'),
(521, 10, 'admin', 'user_login', 'login', '2019-09-26 14:34:11', '2019-09-26 14:34:11'),
(522, 10, 'admin', 'user_login', 'login', '2019-09-26 14:47:07', '2019-09-26 14:47:07'),
(523, 10, 'admin', 'user_login', 'login', '2019-09-27 18:54:45', '2019-09-27 18:54:45'),
(524, 10, 'admin', 'user_login', 'login', '2019-09-29 15:02:09', '2019-09-29 15:02:09'),
(525, 10, 'admin', 'user_login', 'login', '2019-09-30 16:20:32', '2019-09-30 16:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

CREATE TABLE `airports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `airport` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `airport_english` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`id`, `airport`, `airport_english`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '12312', '123', '2019-08-26 16:15:56', '2019-08-22 07:01:14', '2019-08-26 16:15:56'),
(2, 'dfsf', 'sdfsf', '2019-08-22 07:06:36', '2019-08-22 07:05:51', '2019-08-22 07:06:36'),
(3, '123112', '123', '2019-08-22 07:13:19', '2019-08-22 07:13:13', '2019-08-22 07:13:19'),
(4, 'Riyadh', 'Riyadh', NULL, '2019-08-26 16:15:25', '2019-08-26 16:15:25'),
(5, 'Tabuk', 'Tabuk', NULL, '2019-08-26 16:15:52', '2019-08-26 16:15:52');

-- --------------------------------------------------------

--
-- Table structure for table `contract_sources`
--

CREATE TABLE `contract_sources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contract_sources`
--

INSERT INTO `contract_sources` (`id`, `source`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'sfdsdsfs', '2019-08-26 16:19:01', '2019-08-19 18:30:00', '2019-08-26 16:19:01'),
(2, 'dsfsfdsf', '2019-08-26 16:18:58', '2019-08-22 05:57:02', '2019-08-26 16:18:58'),
(3, '123', '2019-08-22 06:07:16', '2019-08-22 06:02:11', '2019-08-22 06:07:16'),
(4, 'Collaborator in Muhayil', NULL, '2019-08-26 16:19:11', '2019-08-26 16:19:11'),
(5, 'The dealers in Najran', NULL, '2019-08-26 16:19:19', '2019-08-26 16:19:19'),
(6, 'Head office', NULL, '2019-08-26 16:19:27', '2019-08-26 16:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `cost_centers`
--

CREATE TABLE `cost_centers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `center_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `center_name_english` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cost_centers`
--

INSERT INTO `cost_centers` (`id`, `center_name`, `center_name_english`, `notes`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'dfgfdg', 'dfgdfgd', NULL, '2019-08-22 10:50:36', '2019-08-22 10:46:59', '2019-08-22 10:50:36'),
(2, 'adsad', 'sadad', NULL, '2019-08-22 10:50:39', '2019-08-22 10:47:12', '2019-08-22 10:50:39'),
(3, '123', '123', '123', '2019-08-22 10:50:33', '2019-08-22 10:47:33', '2019-08-22 10:50:33'),
(4, 'Cost Center 1', 'testing', 'tesyting', NULL, '2019-08-22 12:58:34', '2019-09-02 16:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `countrys`
--

CREATE TABLE `countrys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countrys`
--

INSERT INTO `countrys` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(6, 'testingsss', '2019-09-03 10:35:42', '2019-08-15 23:40:40', '2019-09-03 10:35:42'),
(9, 'hello', '2019-09-03 10:35:38', '2019-08-16 01:25:09', '2019-09-03 10:35:38'),
(10, 'hiiii', '2019-09-03 10:35:34', '2019-08-16 01:48:46', '2019-09-03 10:35:34'),
(11, 'how', '2019-08-17 07:37:33', '2019-08-16 01:49:33', '2019-08-17 07:37:33'),
(12, 'sada-1', '2019-08-21 14:18:03', '2019-08-19 07:50:12', '2019-08-21 14:18:03'),
(13, 'asddad', '2019-08-22 06:09:09', '2019-08-21 14:18:08', '2019-08-22 06:09:09');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_name_english` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency_name`, `currency_name_english`, `abbreviation`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '123', '123', '123', '2019-08-22 11:35:25', '2019-08-22 11:30:18', '2019-08-22 11:35:25'),
(2, 'ريال سعودي', 'SR', 'SR', NULL, '2019-08-22 12:59:40', '2019-09-15 13:22:49');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place_of_issue` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality_id` int(11) DEFAULT NULL,
  `mobile_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1=Active,2=Deactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `id_number`, `place_of_issue`, `nationality_id`, `mobile_number`, `home_number`, `title`, `date_of_birth`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'name', '7894561230', 'testing', 2, '9874563210', '974563210', 'title', '2019-08-20', 1, '2019-08-26 16:41:11', '2019-08-20 06:33:22', '2019-08-26 17:24:36'),
(2, 'name', '7894561230', 'testing', 1, '9874563210', '974563210', 'title', '2019-08-20', 1, '2019-08-26 16:41:11', '2019-08-20 06:34:32', '2019-08-26 16:41:11'),
(3, 'tesdadsadting', '7896541sadsadsad230', 'dsadasdsadtesting', 1, '8795461sadsada23', '87dsadsad9542', 'tisdsadsadtle', '2019-08-15', 2, '2019-08-20 07:14:23', '2019-08-20 06:35:38', '2019-08-20 07:14:23'),
(4, 'dsfdsf', 'dsfdsfsf', 'dsfdsf', 1, 'dsfsf', 'dsfsdf', 'fsdff', '2019-08-07', 1, '2019-08-20 06:49:16', '2019-08-20 06:36:21', '2019-08-20 06:49:16'),
(5, 'testing', '879456', '8799787', 1, '879645132', '873122', 'testing', '2019-08-15', 1, '2019-08-20 07:17:38', '2019-08-20 07:14:52', '2019-08-20 07:17:38'),
(6, 'testing', '9874563210', 'testing', 1, '987456321', '9874563210', 'testing', '2019-08-20', 1, '2019-08-26 16:41:07', '2019-08-20 12:41:08', '2019-08-26 16:41:07'),
(7, 'testing', '879985564', 'testing', 1, '978564132', '879456132', 'testing', '2019-08-20', 1, '2019-08-26 16:41:04', '2019-08-20 12:42:22', '2019-08-26 16:41:04'),
(8, '123456789', '798564132', 'testing', 1, '798564132', '798546321', 'testing', '2019-08-20', 1, '2019-08-26 16:41:01', '2019-08-20 12:43:15', '2019-08-26 16:41:01'),
(9, 'Soaib Malik', 'AS23232SRT', 'Paris', 1, '564564821', '545875458', 'Mr', '1988-07-27', 1, NULL, '2019-08-26 17:26:30', '2019-08-26 17:26:30'),
(10, 'sasdasd', 'sada', 'asdasd', 3, '6546465464', '4654', 'asd', '1991-03-06', 1, NULL, '2019-09-12 12:21:13', '2019-09-12 12:21:13'),
(11, 'عبدالله', '10112121111', 'الاحساء', 3, '0522222222222', NULL, 'السيد', '1980-03-03', 1, NULL, '2019-09-15 11:58:14', '2019-09-15 11:58:14'),
(12, 'فالح', '1065888998', 'الاحساء', 3, '4540541115', NULL, 'السيد', '1983-03-02', 1, NULL, '2019-09-15 12:47:23', '2019-09-15 12:47:23');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `address_arabic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_is_arabic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_arabic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pour` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_is_arabic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_phones` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_status_arabic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mailbox` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_english` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_is_english` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_is_English` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuing_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_is_english` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_is_english` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_age` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place_of_issue` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `children` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_status_english` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_family_members` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accommodation_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_version_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `place_of_birth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_irritants` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conservation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `occupation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identity_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age_of_wife` int(11) DEFAULT NULL,
  `age_of_boys` int(11) DEFAULT NULL,
  `seniors` int(11) DEFAULT NULL COMMENT '1=yes,2=no',
  `patients` int(11) DEFAULT NULL COMMENT '1=yes,2=no',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`id`, `customer_id`, `address_arabic`, `street_is_arabic`, `building_number`, `area_arabic`, `pour`, `city_is_arabic`, `other_phones`, `social_status_arabic`, `mailbox`, `title_english`, `area_is_english`, `reason`, `name_is_English`, `issuing_id`, `city_is_english`, `street_is_english`, `customer_age`, `place_of_issue`, `children`, `social_status_english`, `number_of_family_members`, `accommodation_type`, `email`, `card_version_number`, `expiry_date`, `place_of_birth`, `number_of_irritants`, `conservation`, `release_date`, `occupation`, `identity_type`, `age_of_wife`, `age_of_boys`, `seniors`, `patients`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'testing', 'testing', '4652478964', 'testing', 'testing', 'testing', '878654.321', 'testing', 'testing', 'testing', 'testing', 'testing', 'testing', 'testing', 'testing', 'testing', '20', 'testing', '3', 'testing', '4', 'testing', 'testing@gmail.com', '120', '2019-08-14', 'testing', 'testing', 'testing', '2019-08-14', 'testing', 'testing', 1, 1, 2, 2, NULL, '2019-08-20 11:36:29', '2019-08-20 12:11:40'),
(2, 8, 'bvcbvc', 'bvcvbvc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-20 12:43:24', '2019-08-26 08:01:58'),
(3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-26 17:24:36', '2019-08-26 17:24:36');

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession_id` int(11) DEFAULT NULL,
  `nationality_id` int(11) DEFAULT NULL,
  `religion_id` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `previous_experience` int(11) DEFAULT NULL COMMENT '1=Experience,2=Not Experience',
  `office_id` int(11) DEFAULT NULL,
  `passport_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reservation` int(11) DEFAULT NULL COMMENT '1=reservation,2=Not reservation',
  `status` int(11) DEFAULT NULL COMMENT '1=Active,2=Deactive',
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv`
--

INSERT INTO `cv` (`id`, `name`, `profession_id`, `nationality_id`, `religion_id`, `age`, `previous_experience`, `office_id`, `passport_number`, `reservation`, `status`, `profile_pic`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'testing', 1, 3, 1, 20, 1, 32, '987456321', 1, 1, NULL, '2019-08-26 07:40:45', '2019-08-19 12:42:42', '2019-08-26 07:40:45'),
(3, 'testing', 1, 3, 1, 20, 1, 32, '9785463210', 1, 1, NULL, '2019-08-26 07:40:55', '2019-08-19 13:33:20', '2019-08-26 07:40:55'),
(4, '123', 1, 3, 1, 20, 2, 32, '9785463210', 1, 1, NULL, '2019-08-26 16:27:59', '2019-08-19 13:33:39', '2019-08-26 16:27:59'),
(5, 'testing', 1, 3, 1, 35, 1, 32, '9874563210', 1, 2, NULL, '2019-08-19 14:15:45', '2019-08-19 13:34:41', '2019-08-19 14:15:45'),
(6, 'Loren Wood', 17, 1, 10, 32, 2, 39, '14545ASDD545', 1, 1, NULL, NULL, '2019-08-26 16:43:53', '2019-08-26 16:43:53');

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE `destination` (
  `id` int(11) NOT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id`, `destination`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Abuja', NULL, '2019-08-07 08:09:21', '2019-06-07 08:09:21'),
(2, 'Abu Dhabi', NULL, '2019-08-07 08:09:21', '2019-08-07 08:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `employment_contracts`
--

CREATE TABLE `employment_contracts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `contract_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv_id` int(11) DEFAULT NULL,
  `date_of_contract` date DEFAULT NULL,
  `duration_of_the_contract` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxes_included` int(11) DEFAULT NULL COMMENT '1=yes,2=no',
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visa_fees` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visa_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visa_date` date DEFAULT NULL,
  `profession_id` int(11) DEFAULT NULL,
  `nationality_id` int(11) DEFAULT NULL,
  `destination_id` int(11) DEFAULT NULL,
  `monthly_salary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_source_id` int(11) DEFAULT NULL,
  `airport_id` int(11) DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `ticket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_applicants` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion_id` int(11) DEFAULT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms_and_advantages_id` int(11) DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL,
  `qualifications_and_experience_id` int(11) DEFAULT NULL,
  `cost_center_id` int(11) DEFAULT NULL,
  `marketer_id` int(11) DEFAULT NULL,
  `marketer_fare` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mission_history` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extradata` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '	1=Active,2=Deactive',
  `displayed` int(11) DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employment_contracts`
--

INSERT INTO `employment_contracts` (`id`, `customer_id`, `contract_number`, `cv_id`, `date_of_contract`, `duration_of_the_contract`, `contract_value`, `taxes_included`, `discount`, `visa_fees`, `visa_number`, `visa_date`, `profession_id`, `nationality_id`, `destination_id`, `monthly_salary`, `contract_source_id`, `airport_id`, `arrival_date`, `arrival_time`, `ticket`, `number_of_applicants`, `religion_id`, `age`, `terms_and_advantages_id`, `office_id`, `qualifications_and_experience_id`, `cost_center_id`, `marketer_id`, `marketer_fare`, `mission_history`, `extradata`, `status`, `displayed`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 9, '000009', NULL, '2019-03-04', '4', '5000', 1, '20', '70', '4sa2a1sd31a', '2019-09-20', 17, 1, 1, '50000', 5, 5, '2019-09-11', NULL, NULL, '1', 9, '35', 2, 39, 1, 4, 4, '700', 'sadad', '{\"17\":\"17\",\"15\":\"15\"}', 1, 1, NULL, '2019-08-28 14:44:16', '2019-09-24 15:28:05'),
(3, 12, '000012', 6, '2019-01-01', '24', '17000', NULL, NULL, NULL, '1900150011', '2019-09-09', NULL, 1, 2, '1600', 4, 5, '2019-02-01', '22:09:00', '#78977987654', '1', 9, '40', 2, NULL, NULL, 4, NULL, NULL, NULL, '{\"17\":\"17\",\"15\":\"15\",\"14\":\"14\"}', 1, 1, NULL, '2019-09-15 12:56:08', '2019-09-24 15:28:13'),
(2, 11, '000011', NULL, '2019-09-15', '90', '17000', 1, NULL, NULL, '1901681167', '2019-09-09', 17, 1, 2, '1200', 6, 4, '2019-09-17', NULL, NULL, '1', 9, '35-40', 2, NULL, 1, 4, 3, NULL, NULL, NULL, 1, 1, NULL, '2019-09-15 12:14:35', '2019-09-17 17:49:16');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` datetime DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `shipped_to` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `tax` double(8,2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` double(8,2) DEFAULT NULL,
  `grand_total` double(8,2) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `date`, `customer_id`, `due_date`, `shipped_to`, `discount`, `tax`, `status`, `notes`, `total`, `grand_total`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '2019-09-05 03:09:00', 9, '2019-09-06', 'testing', 20.00, 100.00, 1, 'testing', 180.00, 360.00, '2019-09-05 15:50:43', '2019-09-05 15:36:04', '2019-09-05 15:50:43'),
(2, '2019-09-05 04:09:00', 9, '2019-09-05', 'testing', 10.00, 10.00, 2, 'testing', 190.00, 209.00, NULL, '2019-09-05 16:09:20', '2019-09-05 18:07:50'),
(3, '2019-09-01 05:09:00', 9, '2019-09-05', 'testing', 10.00, 10.00, 5, 'testing', 90.00, 99.00, NULL, '2019-09-05 17:29:51', '2019-09-05 18:25:47');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `item_descriptions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` double(8,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `item_descriptions`, `unit_price`, `quantity`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'product-1', 10.00, 10, '2019-09-05 15:44:10', '2019-09-05 15:36:04', '2019-09-05 15:44:10'),
(2, 1, 'product-2', 10.00, 10, '2019-09-05 15:44:10', '2019-09-05 15:36:04', '2019-09-05 15:44:10'),
(3, 1, 'product-1', 10.00, 10, '2019-09-05 15:50:43', '2019-09-05 15:44:10', '2019-09-05 15:50:43'),
(4, 1, 'product-2', 10.00, 10, '2019-09-05 15:50:43', '2019-09-05 15:44:10', '2019-09-05 15:50:43'),
(5, 2, 'product-1', 10.00, 100, '2019-09-05 16:09:31', '2019-09-05 16:09:20', '2019-09-05 16:09:31'),
(6, 2, 'product-2', 100.00, 100, '2019-09-05 16:09:31', '2019-09-05 16:09:20', '2019-09-05 16:09:31'),
(7, 2, 'product-1', 10.00, 100, '2019-09-05 17:26:34', '2019-09-05 16:09:31', '2019-09-05 17:26:34'),
(8, 2, 'product-2', 100.00, NULL, '2019-09-05 17:26:34', '2019-09-05 16:09:31', '2019-09-05 17:26:34'),
(9, 2, 'product-1', 10.00, 10, '2019-09-05 17:27:08', '2019-09-05 17:26:34', '2019-09-05 17:27:08'),
(10, 2, 'product-2', 10.00, 10, '2019-09-05 17:27:08', '2019-09-05 17:26:34', '2019-09-05 17:27:08'),
(11, 2, 'product-1', 10.00, 10, '2019-09-05 17:27:21', '2019-09-05 17:27:08', '2019-09-05 17:27:21'),
(12, 2, 'product-2', 10.00, 10, '2019-09-05 17:27:21', '2019-09-05 17:27:08', '2019-09-05 17:27:21'),
(13, 2, 'product-1', 10.00, 10, NULL, '2019-09-05 17:27:21', '2019-09-05 17:27:21'),
(14, 2, 'product-2', 10.00, 10, NULL, '2019-09-05 17:27:21', '2019-09-05 17:27:21'),
(15, 3, 'product-1', 10.00, 10, '2019-09-05 17:30:00', '2019-09-05 17:29:51', '2019-09-05 17:30:00'),
(16, 3, 'product-1', 10.00, 10, '2019-09-05 17:30:07', '2019-09-05 17:30:00', '2019-09-05 17:30:07'),
(17, 3, 'product-1', 10.00, 10, '2019-09-05 17:33:51', '2019-09-05 17:30:07', '2019-09-05 17:33:51'),
(18, 3, 'product-1', 10.00, 10, '2019-09-05 17:34:10', '2019-09-05 17:33:51', '2019-09-05 17:34:10'),
(19, 3, 'product-1', 10.00, 10, '2019-09-05 17:34:10', '2019-09-05 17:33:51', '2019-09-05 17:34:10'),
(20, 3, 'product-1', 10.00, 10, '2019-09-05 18:08:05', '2019-09-05 17:34:10', '2019-09-05 18:08:05'),
(21, 3, 'product-1', 10.00, 10, '2019-09-05 18:08:13', '2019-09-05 18:08:05', '2019-09-05 18:08:13'),
(22, 3, 'product-1', 10.00, 10, '2019-09-05 18:25:38', '2019-09-05 18:08:13', '2019-09-05 18:25:38'),
(23, 3, 'product-1', 10.00, 10, NULL, '2019-09-05 18:25:38', '2019-09-05 18:25:38');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payments`
--

CREATE TABLE `invoice_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount_paid` double(8,2) DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_payments`
--

INSERT INTO `invoice_payments` (`id`, `invoice_id`, `date`, `amount_paid`, `note`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-09-06', 100.00, 'testing', NULL, '2019-09-05 15:39:01', '2019-09-05 15:39:01'),
(2, 1, '2019-09-06', 98.00, 'testing', '2019-09-05 15:43:17', '2019-09-05 15:42:06', '2019-09-05 15:43:17'),
(3, 1, '2019-09-05', 260.00, 'testing', NULL, '2019-09-05 15:44:31', '2019-09-05 15:44:31'),
(4, 2, '2019-09-06', 10.00, 'testing', '2019-09-05 18:07:50', '2019-09-05 16:09:47', '2019-09-05 18:07:50'),
(5, 3, '2019-09-12', 97.00, 'testing', NULL, '2019-09-05 17:32:41', '2019-09-05 18:24:33'),
(6, 3, '2019-09-05', 1.00, NULL, '2019-09-05 18:07:43', '2019-09-05 17:33:01', '2019-09-05 18:07:43'),
(7, 3, '2019-09-05', 89.00, NULL, '2019-09-05 18:23:33', '2019-09-05 18:08:23', '2019-09-05 18:23:33'),
(8, 2, '2019-09-05', 10.00, NULL, NULL, '2019-09-05 18:21:38', '2019-09-05 18:21:38'),
(9, 3, '2019-09-06', 2.00, NULL, '2019-09-05 18:25:47', '2019-09-05 18:24:56', '2019-09-05 18:25:47');

-- --------------------------------------------------------

--
-- Table structure for table `marketers`
--

CREATE TABLE `marketers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `marketer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `marketers`
--

INSERT INTO `marketers` (`id`, `marketer`, `phone_no`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'sadddd', 'sadsadsad', '2019-08-26 16:40:11', '2019-08-22 07:39:30', '2019-08-26 16:40:11'),
(2, '123', '123', '2019-08-22 07:43:59', '2019-08-22 07:40:09', '2019-08-22 07:43:59'),
(3, 'AKRAM', '123456789', NULL, '2019-08-26 16:40:07', '2019-08-26 16:40:07'),
(4, 'Adel', '789456123', NULL, '2019-08-26 16:40:26', '2019-08-26 16:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_12_081256_create_roles_table', 1),
(4, '2019_08_12_113030_create_offices_table', 2),
(5, '2019_08_13_104729_create_user_datas_table', 3),
(6, '2019_08_14_072836_create_status_table', 4),
(7, '2019_08_14_095615_create_countrys_table', 5),
(11, '2019_08_19_161509_create_cv_table', 7),
(10, '2019_08_17_063855_create_activity_log_table', 6),
(13, '2019_08_20_105505_create_costomers_table', 8),
(14, '2019_08_20_132118_create_customer_details_table', 9),
(15, '2019_08_21_112037_create_employment_contracts_table', 10),
(16, '2019_08_21_141000_create_nationalities_table', 11),
(17, '2019_08_21_162255_create_religions_table', 12),
(18, '2019_08_21_175004_create_professions_table', 13),
(19, '2019_08_21_191330_create_contract_sources_table', 14),
(20, '2019_08_22_101503_create_airports_table', 14),
(21, '2019_08_22_102150_create_terms_and_advantages_table', 14),
(22, '2019_08_22_102847_create_qualifications_and_experiences_table', 14),
(23, '2019_08_22_103545_create_marketers_table', 14),
(24, '2019_08_22_103756_create_cost_centers_table', 14),
(25, '2019_08_22_104005_create_currencies_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `nationalities`
--

CREATE TABLE `nationalities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality_english` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0=Active,1=Deactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nationalities`
--

INSERT INTO `nationalities` (`id`, `state`, `nationality_english`, `nationality`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Philippines', 'Philippines', 'Philippines', 1, NULL, '2019-08-26 16:12:15', '2019-08-26 16:12:36'),
(2, 'THUBIAA', 'ATHUBIAN', 'Ethiopia', 1, NULL, '2019-08-26 16:14:17', '2019-08-26 16:14:17'),
(3, 'Tunisia', 'Tunisia', 'Tunisia', 1, NULL, '2019-08-26 16:14:40', '2019-08-26 16:14:40'),
(4, 'india', 'Ethiopia', 'india', 1, NULL, '2019-09-11 16:38:03', '2019-09-11 16:38:03');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_type` int(11) DEFAULT NULL COMMENT '0=External,1=Internal',
  `status` int(11) DEFAULT NULL COMMENT '1=Active,0=Deactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `name`, `city`, `phone`, `email`, `office_type`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(11, 'office-3', 'rajkot', '7485269310', 'testing@gmail.com', 1, 1, '2019-08-17 08:12:04', '2019-08-13 03:52:51', '2019-08-17 08:12:04'),
(31, 'Tejas Patel', 'dfdsfdsdsfds', '9537222772', 'tejashshingala@gmail.com', 1, 1, '2019-08-17 07:49:58', '2019-08-17 06:40:54', '2019-08-17 07:49:58'),
(32, 'testing', 'rajkot', '9874563210', 'testing@gmail.com', 2, 1, '2019-08-26 16:16:44', '2019-08-17 08:08:30', '2019-08-26 16:16:44'),
(33, 'testing', 'rajkot', '987456321', 'testing@gmail.com', 1, 2, '2019-08-17 08:15:48', '2019-08-17 08:13:14', '2019-08-17 08:15:48'),
(34, 'testing', 'rajkot', '9874563210', 'testing@gmail.com', 2, 1, '2019-08-26 16:16:40', '2019-08-17 08:16:36', '2019-08-26 16:16:40'),
(35, 'testing-1', 'rajkot', '7896541230', 'testing@gmail.com', 1, 1, '2019-08-19 01:14:13', '2019-08-19 01:13:57', '2019-08-19 01:14:13'),
(36, 'testing-1', 'rajkot', '9874563210', 'testing@gmail.com', 1, 1, '2019-08-26 16:16:36', '2019-08-19 06:59:56', '2019-08-26 16:16:36'),
(37, 'هي', 'هي', '987456321', 'testing@gmail.com', 1, 1, '2019-08-19 07:06:56', '2019-08-19 07:06:44', '2019-08-19 07:06:56'),
(38, 'cvcxv', 'xvxvxv', '78978997', 'test@gmail.com', 2, 1, '2019-08-26 16:16:32', '2019-08-26 05:29:17', '2019-08-26 16:16:32'),
(39, 'AL JMI EXPORTS', 'Mumbai', '123456789', 'jmi@test.com', 1, 1, NULL, '2019-08-26 16:17:37', '2019-08-26 16:17:37'),
(40, 'MANPOWR', 'Manila', '789456123', 'manila@test.com', 2, 1, NULL, '2019-08-26 16:18:12', '2019-08-26 16:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professions`
--

CREATE TABLE `professions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_english` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professions`
--

INSERT INTO `professions` (`id`, `occupation`, `job_english`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 't1esting', 'testin1g', '2019-08-26 16:20:08', '2019-08-07 08:09:21', '2019-08-26 16:20:08'),
(2, 'sdfsdfsf', 'dsfdsfddsf', '2019-08-21 13:22:31', '2019-08-21 13:14:54', '2019-08-21 13:22:31'),
(3, '1', '1', '2019-08-21 13:23:30', '2019-08-21 13:20:09', '2019-08-21 13:23:30'),
(4, '2', '2', '2019-08-21 13:23:33', '2019-08-21 13:20:18', '2019-08-21 13:23:33'),
(5, '3', '3', '2019-08-21 13:23:36', '2019-08-21 13:20:24', '2019-08-21 13:23:36'),
(6, '4', '4', '2019-08-26 16:20:05', '2019-08-21 13:20:28', '2019-08-26 16:20:05'),
(7, '5', '5', '2019-08-26 16:20:02', '2019-08-21 13:20:33', '2019-08-26 16:20:02'),
(8, '6', '6', '2019-08-26 16:20:00', '2019-08-21 13:20:38', '2019-08-26 16:20:00'),
(9, '7', '7', '2019-08-26 16:19:57', '2019-08-21 13:20:42', '2019-08-26 16:19:57'),
(10, '8', '8', '2019-08-26 16:19:55', '2019-08-21 13:20:49', '2019-08-26 16:19:55'),
(11, '9', '9', '2019-08-26 16:19:52', '2019-08-21 13:20:54', '2019-08-26 16:19:52'),
(12, '10', '10', '2019-08-26 16:19:50', '2019-08-21 13:23:12', '2019-08-26 16:19:50'),
(13, '11', '111', '2019-08-26 16:19:46', '2019-08-21 13:23:16', '2019-08-26 16:19:46'),
(14, '12', '12', '2019-08-26 16:19:44', '2019-08-21 13:23:21', '2019-08-26 16:19:44'),
(15, '13', '13', '2019-08-22 06:16:29', '2019-08-21 13:23:26', '2019-08-22 06:16:29'),
(16, 'Coach', 'Coach', NULL, '2019-08-26 16:24:02', '2019-08-26 16:24:02'),
(17, 'Electrician', 'Electrician', NULL, '2019-08-26 16:24:13', '2019-08-26 16:24:13'),
(18, 'Sales Representative', 'Sales Representative', NULL, '2019-08-26 16:24:31', '2019-08-26 16:24:31');

-- --------------------------------------------------------

--
-- Table structure for table `qualifications_and_experiences`
--

CREATE TABLE `qualifications_and_experiences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qualifications_and_experience` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qualifications_and_experiences`
--

INSERT INTO `qualifications_and_experiences` (`id`, `qualifications_and_experience`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'House work', NULL, '2019-08-22 09:37:29', '2019-08-26 16:39:04'),
(2, 'dsfsdfsf', '2019-08-22 09:52:16', '2019-08-22 09:43:28', '2019-08-22 09:52:16'),
(3, 'Specific - Private', NULL, '2019-08-26 16:39:13', '2019-08-26 16:39:13');

-- --------------------------------------------------------

--
-- Table structure for table `religions`
--

CREATE TABLE `religions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion_english` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `religions`
--

INSERT INTO `religions` (`id`, `religion`, `religion_english`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'dfsfs', 'dsfsfsf', '2019-08-26 16:28:28', '2019-08-21 11:46:25', '2019-08-26 16:28:28'),
(2, 'fdgg', 'dfgfdgdg', '2019-08-21 11:46:22', '2019-08-21 11:28:54', '2019-08-21 11:46:22'),
(3, '123456789', '123456789', '2019-08-21 11:46:19', '2019-08-21 11:29:09', '2019-08-21 11:46:19'),
(4, 'sada', 'saddsad123', '2019-08-21 11:44:47', '2019-08-21 11:29:21', '2019-08-21 11:44:47'),
(5, 'dfgdgdf', 'gdfgdf', '2019-08-21 13:10:34', '2019-08-21 11:46:31', '2019-08-21 13:10:34'),
(6, 'sda', 'sadd', '2019-08-26 16:28:25', '2019-08-21 13:10:30', '2019-08-26 16:28:25'),
(7, 'sdfsf', 'dfsfs', '2019-08-21 13:11:16', '2019-08-21 13:11:12', '2019-08-21 13:11:16'),
(8, 'sadsad', 'sdsadds', '2019-08-22 06:18:01', '2019-08-22 06:17:56', '2019-08-22 06:18:01'),
(9, 'Muslim', 'Muslim', NULL, '2019-08-26 16:28:34', '2019-08-26 16:28:34'),
(10, 'Christian', 'Christian', NULL, '2019-08-26 16:28:43', '2019-08-26 16:28:43'),
(11, 'Buddhist', 'Buddhist', NULL, '2019-08-26 16:28:51', '2019-08-26 16:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, '2019-08-07 08:09:21', '2019-08-11 18:30:00'),
(2, 'staff', NULL, '2019-08-07 08:09:21', '2019-06-07 08:09:21'),
(3, 'agency staff', NULL, '2019-08-07 08:09:21', '2019-08-07 08:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_type` int(11) DEFAULT NULL,
  `nationality_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`, `office_type`, `nationality_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'NEW-NEW', 1, 1, '2019-09-04 14:52:14', '2019-09-02 16:05:07', '2019-09-04 14:52:14'),
(2, 'تم التفويض', 1, 1, '2019-09-04 14:52:17', '2019-09-03 20:33:08', '2019-09-04 14:52:17'),
(3, 'Cases', 2, 1, NULL, '2019-09-04 14:53:26', '2019-09-04 14:54:23'),
(4, 'Motivation', 1, 1, NULL, '2019-09-04 14:53:41', '2019-09-04 14:53:41'),
(5, 'Agent', 2, 2, NULL, '2019-09-04 14:53:59', '2019-09-04 14:54:33'),
(6, 'Certain', 1, 2, NULL, '2019-09-04 14:54:15', '2019-09-04 14:54:15'),
(7, '111test', 1, 3, '2019-09-04 15:02:50', '2019-09-04 14:54:45', '2019-09-04 15:02:50'),
(8, 'jaydip', 1, 1, '2019-09-04 15:02:22', '2019-09-04 14:55:43', '2019-09-04 15:02:22'),
(9, 'testing', 2, 1, '2019-09-04 15:02:17', '2019-09-04 15:02:01', '2019-09-04 15:02:17'),
(10, 'Rests', 1, 3, NULL, '2019-09-04 15:03:09', '2019-09-04 15:03:09'),
(11, 'Is over', 2, 3, NULL, '2019-09-04 15:03:27', '2019-09-04 15:03:27'),
(12, 'PPT', 1, 4, NULL, '2019-09-11 16:38:27', '2019-09-11 16:38:27'),
(13, 'PPS', 1, 4, NULL, '2019-09-11 16:38:39', '2019-09-11 16:38:39'),
(14, 'TPPT', 1, 1, NULL, '2019-09-11 16:39:13', '2019-09-11 16:39:13'),
(15, 'LPO', 1, 1, NULL, '2019-09-11 16:39:45', '2019-09-11 16:39:45'),
(16, 'PPT', 1, 3, NULL, '2019-09-11 17:10:11', '2019-09-11 17:10:11'),
(17, 'PPT', 1, 1, NULL, '2019-09-11 17:10:42', '2019-09-11 17:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_advantages`
--

CREATE TABLE `terms_and_advantages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `terms_and_advantage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms_and_advantages`
--

INSERT INTO `terms_and_advantages` (`id`, `terms_and_advantage`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'fdgfdgdfgdf', '2019-08-26 16:38:29', '2019-08-22 08:56:38', '2019-08-26 16:38:29'),
(2, 'Already Work - Experience', NULL, '2019-08-22 09:00:10', '2019-08-26 16:38:24'),
(3, '123', '2019-08-22 09:05:01', '2019-08-22 09:01:15', '2019-08-22 09:05:01'),
(4, 'Elderly Care - Take care of Elderly', NULL, '2019-08-26 16:38:40', '2019-08-26 16:38:40');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `close_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `ticket_number`, `user_id`, `status`, `close_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'TN-1908290001', 10, 2, 10, NULL, '2019-08-29 18:44:33', '2019-09-15 13:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_attachment`
--

CREATE TABLE `ticket_attachment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thread_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_attachment`
--

INSERT INTO `ticket_attachment` (`id`, `name`, `thread_id`, `type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'storage/attachment/Aug2019/279549162_sample.txt', 1, 'text/plain', NULL, '2019-08-29 18:44:33', '2019-08-29 18:44:33'),
(2, 'storage/attachment/Aug2019/1643466458_file-sample_100kB.doc', 1, 'application/msword', NULL, '2019-08-29 18:44:33', '2019-08-29 18:44:33'),
(3, 'storage/attachment/Aug2019/1233890506_sample.pdf', 1, 'application/pdf', NULL, '2019-08-29 18:44:33', '2019-08-29 18:44:33'),
(4, 'storage/attachment/Aug2019/50114130_1.jpg', 1, 'image/jpeg', NULL, '2019-08-29 18:44:33', '2019-08-29 18:44:33'),
(5, 'storage/attachment/Aug2019/1080577393_5.pdf', 2, 'application/pdf', NULL, '2019-08-29 19:37:14', '2019-08-29 19:37:14');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_thread`
--

CREATE TABLE `ticket_thread` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_thread`
--

INSERT INTO `ticket_thread` (`id`, `ticket_id`, `user_id`, `title`, `message`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 'testingTicket', 'testing', NULL, '2019-08-29 18:44:33', '2019-08-29 18:44:33'),
(2, 1, 10, NULL, 'sdfdsfd', NULL, '2019-08-29 19:37:14', '2019-08-29 19:37:14'),
(3, 1, 10, NULL, 'house made is refuse to work', NULL, '2019-09-15 13:50:30', '2019-09-15 13:50:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(10) UNSIGNED DEFAULT 1,
  `status` int(11) DEFAULT 1 COMMENT '2=disabled,1=enabled',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `profile_pic`, `role_id`, `status`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(12, '12000testing', 'hello@gmail.com', 'helloo', '$2y$10$YkWa0JHdHS0LFYX4wNqfAuD1lj.aUDZdxcjADJj9X1JwKzxyaJNF.', NULL, 1, 2, NULL, '2019-08-26 16:24:46', '2019-08-16 04:41:32', '2019-08-26 16:24:46'),
(13, 'testing', 'testingnew@gmail.com', 'hellonew', '$2y$10$nt7BYTmrTcUstK2ZHadLlus5BlaJHEQ1EAkjDU2oj7x1xY0N7rWBm', NULL, 1, 1, NULL, '2019-08-19 08:07:10', '2019-08-17 03:27:00', '2019-08-19 08:07:10'),
(10, 'Admin Master', 'connectusdemo12@gmail.com', 'admin', '$2y$10$nZbScfsjgyptXG4ThVFwE.A/TcvPkIo.p6FdznGqMTDt/bYU25r2K', 'storage/profile_pic/1932357048_download.png', 1, 1, 'YXnnMNgGoKjnaues14VIqVs5xlD7yALQ6oFgyBS16mcnh50to7eu8P7sfNEt', NULL, '2019-08-16 01:54:41', '2019-09-07 11:54:27'),
(14, 'dfg', 'test@test.test', 'dfg', '$2y$10$nprfZXePulnlYkVlEosYK.SZdAWT8vxKLI9iMhLV/wYFy/xdIh57.', NULL, 1, 1, NULL, '2019-08-17 07:48:14', '2019-08-17 06:09:06', '2019-08-17 07:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_datas`
--

CREATE TABLE `user_datas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualification` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_expired` date DEFAULT NULL,
  `end_of_residence` date DEFAULT NULL,
  `end_of_insurance` date DEFAULT NULL,
  `salary` double(8,2) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_datas`
--

INSERT INTO `user_datas` (`id`, `user_id`, `gender`, `nationality`, `qualification`, `position`, `passport_expired`, `end_of_residence`, `end_of_insurance`, `salary`, `deleted_at`, `created_at`, `updated_at`) VALUES
(10, 11, 'male', 'India', 'phd', 'testing', '2019-08-16', '2019-08-16', '2019-08-16', 520.00, NULL, '2019-08-16 04:39:56', '2019-08-16 04:39:56'),
(11, 12, 'male', 'India', 'phd', 'testing', '2019-08-16', '2019-08-16', '2019-08-16', 8000.00, '2019-08-26 16:24:46', '2019-08-16 04:41:32', '2019-08-26 16:24:46'),
(9, 10, 'male', 'testing', 'phd', 'testing', '2019-08-16', '2019-08-16', '2019-08-16', 520.00, NULL, '2019-08-16 01:54:41', '2019-08-16 01:54:41'),
(12, 13, 'male', 'testing', 'phd', 'testing', '2019-08-24', '2019-08-17', '2019-08-17', 250.00, '2019-08-19 08:07:10', '2019-08-17 03:27:00', '2019-08-19 08:07:10'),
(13, 14, 'male', 'dfgdfg', 'phd', NULL, '2019-08-13', '2019-08-14', '2019-08-09', 345543.00, '2019-08-17 07:48:14', '2019-08-17 06:09:06', '2019-08-17 07:48:14'),
(14, 15, 'male', 'testing', 'phd', 'testing', '2019-08-19', '2019-08-19', '2019-08-19', 25.50, '2019-08-19 07:48:58', '2019-08-19 07:48:44', '2019-08-19 07:48:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract_sources`
--
ALTER TABLE `contract_sources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cost_centers`
--
ALTER TABLE `cost_centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countrys`
--
ALTER TABLE `countrys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employment_contracts`
--
ALTER TABLE `employment_contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_payments`
--
ALTER TABLE `invoice_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marketers`
--
ALTER TABLE `marketers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nationalities`
--
ALTER TABLE `nationalities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qualifications_and_experiences`
--
ALTER TABLE `qualifications_and_experiences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `religions`
--
ALTER TABLE `religions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_and_advantages`
--
ALTER TABLE `terms_and_advantages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_attachment`
--
ALTER TABLE `ticket_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_thread`
--
ALTER TABLE `ticket_thread`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `user_datas`
--
ALTER TABLE `user_datas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=526;

--
-- AUTO_INCREMENT for table `airports`
--
ALTER TABLE `airports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contract_sources`
--
ALTER TABLE `contract_sources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cost_centers`
--
ALTER TABLE `cost_centers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countrys`
--
ALTER TABLE `countrys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employment_contracts`
--
ALTER TABLE `employment_contracts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `invoice_payments`
--
ALTER TABLE `invoice_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `marketers`
--
ALTER TABLE `marketers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `professions`
--
ALTER TABLE `professions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `qualifications_and_experiences`
--
ALTER TABLE `qualifications_and_experiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `religions`
--
ALTER TABLE `religions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `terms_and_advantages`
--
ALTER TABLE `terms_and_advantages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ticket_attachment`
--
ALTER TABLE `ticket_attachment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ticket_thread`
--
ALTER TABLE `ticket_thread`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_datas`
--
ALTER TABLE `user_datas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
