-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2021 at 10:54 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pathsala`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$kSrb48RfpSvq5aRMhaHP3uWGngDRPMmq8mKzqrBhYT5lgz0dx4pge', 'BuyAg6usc3D9sOMEILzhYiQlgGXwLuV2XvBm3eJKyAENEhGufD7mMJwDTi3S', '2021-05-06 13:44:29', '2021-05-06 13:44:29', NULL),
(2, 'ITAdmin', 'it@admin.com', '$2y$10$QznToYUY/phjPPSM9Fsn0.PzIrEwbPKj0RbbmG3.HiIu55npcbNJS', NULL, '2021-05-06 13:48:57', '2021-05-06 13:48:57', NULL),
(3, 'Ram Thapa', 'ram@admin.com', '$2y$10$fRNP/G0G7oKy8nnps6Q64e.x5D1RwEQqOEcKVgEzzqyFjLgbay8k.', 'wilfO6bZO1uGo4gZv1gPNJMi2rbnkf8iBwjySUrAMKWi0ZmcS5vLxuBOQMlX', '2021-05-06 13:54:59', '2021-05-06 13:57:21', NULL),
(4, 'Sam Karki', 'sam@admin.com', '$2y$10$/5g0vAzGHCxI9SzQ0WA16enEof1V1pMROa5mQ0mU/5XJnbh.Wi9sS', NULL, '2021-05-06 15:04:23', '2021-05-06 15:08:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins_groups`
--

CREATE TABLE `admins_groups` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins_permissions`
--

CREATE TABLE `admins_permissions` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins_roles`
--

CREATE TABLE `admins_roles` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins_roles`
--

INSERT INTO `admins_roles` (`admin_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 3),
(4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE `attempts` (
  `id` int(10) UNSIGNED NOT NULL,
  `quiz_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `total_marks` double(8,2) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `feedback` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attempts`
--

INSERT INTO `attempts` (`id`, `quiz_id`, `user_id`, `total_marks`, `status`, `feedback`, `created_at`, `updated_at`, `deleted_at`) VALUES
(25, 1, 5, 0.00, 'reseted', NULL, '2021-06-23 08:29:33', '2021-06-23 09:31:11', NULL),
(26, 1, 6, 0.00, 'submitted', NULL, '2021-06-23 10:07:02', '2021-06-23 10:10:08', NULL),
(27, 1, 24, NULL, 'pending', NULL, '2021-08-26 08:15:24', '2021-08-26 08:15:24', NULL),
(28, 3, 24, 0.00, 'submitted', NULL, '2021-08-26 08:15:54', '2021-08-26 08:16:54', NULL),
(29, 1, 24, NULL, 'pending', NULL, '2021-08-27 06:10:07', '2021-08-27 06:10:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attempt_answers`
--

CREATE TABLE `attempt_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `attempt_id` int(10) UNSIGNED DEFAULT NULL,
  `question_id` int(10) UNSIGNED DEFAULT NULL,
  `marks` double(8,2) NOT NULL,
  `feedback` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attempt_answers`
--

INSERT INTO `attempt_answers` (`id`, `attempt_id`, `question_id`, `marks`, `feedback`, `created_at`, `updated_at`, `deleted_at`) VALUES
(67, 25, 2, 0.00, NULL, '2021-06-23 08:30:13', '2021-06-23 08:30:13', NULL),
(68, 25, 4, 0.00, NULL, '2021-06-23 08:30:13', '2021-06-23 08:30:13', NULL),
(69, 25, 1, 0.00, NULL, '2021-06-23 08:30:13', '2021-06-23 08:30:13', NULL),
(70, 26, 4, 0.00, NULL, '2021-06-23 10:10:08', '2021-06-23 10:10:08', NULL),
(71, 26, 2, 0.00, NULL, '2021-06-23 10:10:08', '2021-06-23 10:10:08', NULL),
(72, 26, 1, 0.00, NULL, '2021-06-23 10:10:08', '2021-06-23 10:10:08', NULL),
(73, 28, 9, 0.00, NULL, '2021-08-26 08:16:54', '2021-08-26 08:16:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attempt_options`
--

CREATE TABLE `attempt_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `attempt_answer_id` int(10) UNSIGNED DEFAULT NULL,
  `option_id` int(10) UNSIGNED DEFAULT NULL,
  `answer_text` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attempt_options`
--

INSERT INTO `attempt_options` (`id`, `attempt_answer_id`, `option_id`, `answer_text`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(100, 67, 4, NULL, NULL, '2021-06-23 08:30:13', '2021-06-23 08:30:13', NULL),
(101, 67, 7, NULL, NULL, '2021-06-23 08:30:13', '2021-06-23 08:30:13', NULL),
(102, 68, NULL, '<p>sddff</p>', NULL, '2021-06-23 08:30:13', '2021-06-23 08:30:13', NULL),
(103, 69, 3, NULL, NULL, '2021-06-23 08:30:13', '2021-06-23 08:30:13', NULL),
(104, 70, NULL, '<p>lkfgf</p>', NULL, '2021-06-23 10:10:08', '2021-06-23 10:10:08', NULL),
(105, 71, 7, NULL, NULL, '2021-06-23 10:10:08', '2021-06-23 10:10:08', NULL),
(106, 71, 5, NULL, NULL, '2021-06-23 10:10:08', '2021-06-23 10:10:08', NULL),
(107, 71, 6, NULL, NULL, '2021-06-23 10:10:08', '2021-06-23 10:10:08', NULL),
(108, 71, 4, NULL, NULL, '2021-06-23 10:10:08', '2021-06-23 10:10:08', NULL),
(109, 72, 3, NULL, NULL, '2021-06-23 10:10:08', '2021-06-23 10:10:08', NULL),
(110, 73, 21, NULL, NULL, '2021-08-26 08:16:54', '2021-08-26 08:16:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Science', NULL, '2021-05-06 14:06:17', '2021-05-06 14:06:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `grade_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `category_id`, `grade_id`, `title`, `slug`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Fundamentals of Science', 'fundamentals-of-science', NULL, '2021-05-06 14:08:41', '2021-05-06 14:08:41', NULL),
(2, 1, 1, 'Fundamentals of Science', 'fundamentals-of-science', NULL, '2021-05-06 15:25:16', '2021-05-06 15:26:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_student`
--

CREATE TABLE `course_student` (
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `rating` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_user`
--

CREATE TABLE `course_user` (
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_user`
--

INSERT INTO `course_user` (`course_id`, `admin_id`) VALUES
(1, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ten', NULL, '2021-05-06 14:06:34', '2021-05-06 14:06:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `title`, `slug`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Science', 'science', NULL, '2021-06-20 12:28:20', '2021-06-20 12:28:20', NULL),
(2, 'Non-Science', 'non-science', NULL, '2021-06-20 12:28:33', '2021-06-20 12:28:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `title`, `slug`, `short_text`, `position`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Measurement', 'measurement', NULL, 1, '2021-05-06 14:09:18', '2021-05-06 14:09:18', NULL),
(2, 2, 'Force', 'force', NULL, 1, '2021-05-06 15:29:42', '2021-05-06 15:29:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lesson_student`
--

CREATE TABLE `lesson_student` (
  `lesson_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `manipulations` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_properties` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsive_images` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `size`, `manipulations`, `custom_properties`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'App\\Course', 1, 'thumbnail', '6093d1bb69c7b_logo_final-01-300x300', '6093d1bb69c7b_logo_final-01-300x300.png', 'image/png', 'public', 15421, '[]', '[]', '[]', 1, '2021-05-06 14:08:42', '2021-05-06 14:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_03_14_075105_create_admins_table', 1),
(4, '2020_03_15_091331_create_permissions_table', 1),
(5, '2020_03_15_091626_create_roles_table', 1),
(6, '2020_03_15_091858_create_admins_permissions_table', 1),
(7, '2020_03_15_092055_create_admins_roles_table', 1),
(8, '2020_03_15_092224_create_roles_permissions_table', 1),
(9, '2020_04_01_110918_create_group_table', 1),
(10, '2020_04_01_111646_create_admins_groups_table', 1),
(11, '2020_06_23_000004_create_categories_table', 1),
(12, '2020_06_23_000004_create_grades_table', 1),
(13, '2020_06_23_075903_create_courses_table', 1),
(14, '2020_06_23_080223_create_lessons_table', 1),
(15, '2020_06_23_094406_create_course_user_table', 1),
(16, '2020_06_23_094654_create_course_student_table', 1),
(17, '2020_06_23_094846_create_lesson_student_table', 1),
(18, '2020_06_28_065722_create_media_table', 1),
(19, '2020_07_05_091515_create_quiz_table', 1),
(20, '2020_07_06_083106_create_questions_table', 1),
(21, '2020_07_06_091959_create_question_quiz_table', 1),
(22, '2020_07_06_111436_create_options_table', 1),
(23, '2020_07_06_122631_create_quiz_user_table', 1),
(24, '2020_07_06_122712_create_quiz_student_table', 1),
(25, '2020_08_30_050807_add_columns_to_quiz_table', 1),
(26, '2020_10_05_213728_add_columns_to_users_table', 1),
(27, '2020_10_11_142357_create_attempts_table', 1),
(28, '2020_10_11_142513_create_attempt_answers_table', 1),
(29, '2020_10_11_142529_create_attempt_options_table', 1),
(30, '2020_12_14_182817_add_columns_to_quiz_tables', 1),
(31, '2021_03_02_164554_add_columns_to_quiz_tale', 1),
(32, '2021_05_05_201517_create_notifications_table', 1),
(33, '2021_06_07_180310_add_question_no_to_questions_table', 2),
(34, '2021_06_27_154823_add_status_to_users_table', 3),
(35, '2021_05_19_052903_create_settings_table', 4),
(36, '2021_08_26_153028_add_color_to_settings_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('02b811b9-9e45-45bc-be5e-1b0898731d23', 'App\\Notifications\\QuizNotification', 'App\\Admin', 2, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:22:54', '2021-05-10 16:22:54'),
('033fdf23-d25d-4a04-8b80-c5c266b8274a', 'App\\Notifications\\QuizNotification', 'App\\Admin', 3, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:22:54', '2021-05-10 16:22:54'),
('0a902f06-d0d4-4419-abd7-373c0c55917c', 'App\\Notifications\\QuizNotification', 'App\\Admin', 4, '{\"message\":\"Measurement Practice\\\\n was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:07:04', '2021-05-10 16:07:04'),
('1e425a46-7ab1-4eb7-b83e-191b7fdb721a', 'App\\Notifications\\QuizNotification', 'App\\Admin', 1, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:40:47', '2021-05-10 16:40:47'),
('29b381ee-62ca-443d-a191-aa708d84c6af', 'App\\Notifications\\QuizNotification', 'App\\Admin', 4, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:19:24', '2021-05-10 16:19:24'),
('33706b46-072c-4e5b-be13-6222a2ad99d4', 'App\\Notifications\\QuizNotification', 'App\\User', 2, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/test\"}', '2021-05-10 16:19:35', '2021-05-10 16:19:24', '2021-05-10 16:19:35'),
('3a73670e-d3fc-44c6-8293-52f92440fb39', 'App\\Notifications\\QuizNotification', 'App\\User', 3, '{\"message\":\"Best Picture was added.\",\"url\":\"http:\\/\\/localhost:8080\\/test\"}', '2021-05-11 08:35:44', '2021-05-11 08:25:26', '2021-05-11 08:35:44'),
('45bf0a33-a98a-4a50-8a88-caa2eee5d1d6', 'App\\Notifications\\QuizNotification', 'App\\User', 2, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/test\"}', NULL, '2021-05-10 16:40:47', '2021-05-10 16:40:47'),
('4b4c80fe-6f07-4730-983a-f862cb92a43f', 'App\\Notifications\\QuizNotification', 'App\\Admin', 2, '{\"message\":\"Best Picture was added.\",\"url\":\"http:\\/\\/localhost:8080\\/admin\\/quizzes\"}', NULL, '2021-05-11 08:25:26', '2021-05-11 08:25:26'),
('51b2585e-2cd6-4c44-9a88-0f299ab7166e', 'App\\Notifications\\QuizNotification', 'App\\User', 2, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/test\"}', NULL, '2021-05-10 16:22:54', '2021-05-10 16:22:54'),
('51ede86d-7c63-4658-a176-79b3d741f21a', 'App\\Notifications\\QuizNotification', 'App\\Admin', 3, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:09:25', '2021-05-10 16:09:25'),
('543f5fb1-cefe-4e4b-b742-3e7c7d17f81b', 'App\\Notifications\\QuizNotification', 'App\\Admin', 4, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:40:47', '2021-05-10 16:40:47'),
('549f270b-7d73-426e-852b-8620966bd682', 'App\\Notifications\\QuizNotification', 'App\\Admin', 2, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:40:47', '2021-05-10 16:40:47'),
('5be8f3dc-241b-4f5e-97ee-db4b0cdadb1f', 'App\\Notifications\\QuizNotification', 'App\\User', 1, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/test\"}', '2021-05-10 16:40:05', '2021-05-10 16:22:54', '2021-05-10 16:40:05'),
('5d251bd2-316f-47a8-ad02-485dc62f44a5', 'App\\Notifications\\QuizNotification', 'App\\Admin', 1, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:09:25', '2021-05-10 16:09:25'),
('717fbed4-52cc-4aba-b984-4dfd9a0d8547', 'App\\Notifications\\QuizNotification', 'App\\Admin', 2, '{\"message\":\"Measurement Practice\\\\n was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:07:04', '2021-05-10 16:07:04'),
('72362b6a-6d0a-4d28-ad63-ba3c8d29d7f9', 'App\\Notifications\\QuizNotification', 'App\\Admin', 4, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:22:54', '2021-05-10 16:22:54'),
('767d417b-9603-4336-bc01-9315dc9fea41', 'App\\Notifications\\QuizNotification', 'App\\User', 1, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/test\"}', NULL, '2021-05-10 16:40:47', '2021-05-10 16:40:47'),
('7c02ab4b-029a-4b3b-a4de-542298a15f57', 'App\\Notifications\\QuizNotification', 'App\\User', 1, '{\"message\":\"Measurement Practice\\\\n was added.\",\"url\":\"http:\\/\\/localhost:8000\\/test\"}', '2021-05-10 16:07:35', '2021-05-10 16:07:04', '2021-05-10 16:07:35'),
('83359461-f282-4a52-9c7e-84d55f3fdb44', 'App\\Notifications\\QuizNotification', 'App\\Admin', 1, '{\"message\":\"Best Picture was added.\",\"url\":\"http:\\/\\/localhost:8080\\/admin\\/quizzes\"}', NULL, '2021-05-11 08:25:26', '2021-05-11 08:25:26'),
('90563fec-7a33-4308-a257-0231cf248f5e', 'App\\Notifications\\QuizNotification', 'App\\Admin', 4, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:09:25', '2021-05-10 16:09:25'),
('94bf3c63-5a62-4db8-9c79-0dda2c1f6a67', 'App\\Notifications\\QuizNotification', 'App\\Admin', 2, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:19:24', '2021-05-10 16:19:24'),
('95d4e944-4ca2-453b-91ca-ec15cfbd473d', 'App\\Notifications\\QuizNotification', 'App\\Admin', 1, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:22:54', '2021-05-10 16:22:54'),
('997bd457-3f4c-4fd3-9d1c-25e2332e478a', 'App\\Notifications\\QuizNotification', 'App\\User', 1, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/test\"}', '2021-05-10 16:40:05', '2021-05-10 16:19:24', '2021-05-10 16:40:05'),
('9c4a48e1-7dee-4567-a275-bbf250849f05', 'App\\Notifications\\QuizNotification', 'App\\Admin', 2, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:09:25', '2021-05-10 16:09:25'),
('9d141a81-3b8d-4545-b305-cf56875b64a3', 'App\\Notifications\\QuizNotification', 'App\\Admin', 3, '{\"message\":\"Best Picture was added.\",\"url\":\"http:\\/\\/localhost:8080\\/admin\\/quizzes\"}', NULL, '2021-05-11 08:25:27', '2021-05-11 08:25:27'),
('a1a3f057-ab10-4c52-9efb-63715ef875a7', 'App\\Notifications\\QuizNotification', 'App\\Admin', 4, '{\"message\":\"Best Picture was added.\",\"url\":\"http:\\/\\/localhost:8080\\/admin\\/quizzes\"}', NULL, '2021-05-11 08:25:27', '2021-05-11 08:25:27'),
('ac76a755-b144-4800-9df9-a823361f4891', 'App\\Notifications\\QuizNotification', 'App\\User', 1, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/test\"}', '2021-05-10 16:17:45', '2021-05-10 16:09:25', '2021-05-10 16:17:45'),
('b82d3742-b06f-4b79-b602-fde90c2cc5cb', 'App\\Notifications\\QuizNotification', 'App\\Admin', 1, '{\"message\":\"Measurement Practice\\\\n was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:07:04', '2021-05-10 16:07:04'),
('bde2d1f9-ba55-43c2-bb33-fd87bc17e485', 'App\\Notifications\\QuizNotification', 'App\\User', 1, '{\"message\":\"Best Picture was added.\",\"url\":\"http:\\/\\/localhost:8080\\/test\"}', NULL, '2021-05-11 08:25:26', '2021-05-11 08:25:26'),
('c6d3b2d4-055a-445a-910c-806da5da0927', 'App\\Notifications\\QuizNotification', 'App\\Admin', 1, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:19:24', '2021-05-10 16:19:24'),
('e375be43-a5c0-4bea-ac29-4449d76ab416', 'App\\Notifications\\QuizNotification', 'App\\User', 2, '{\"message\":\"Best Picture was added.\",\"url\":\"http:\\/\\/localhost:8080\\/test\"}', NULL, '2021-05-11 08:25:26', '2021-05-11 08:25:26'),
('eca37264-0134-41a9-b58a-7e7673f323e6', 'App\\Notifications\\QuizNotification', 'App\\Admin', 3, '{\"message\":\"Measurement Practice\\\\n was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:07:04', '2021-05-10 16:07:04'),
('f7593ad5-723c-429d-b40f-25ac1a9a7ad6', 'App\\Notifications\\QuizNotification', 'App\\Admin', 3, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:19:24', '2021-05-10 16:19:24'),
('facfc7b2-8adb-4ac1-a814-a23393b45c14', 'App\\Notifications\\QuizNotification', 'App\\Admin', 3, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:40:47', '2021-05-10 16:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `option_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `points` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `question_id`, `option_text`, `points`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '<p>kg</p>', 1, '2021-05-06 14:16:01', '2021-05-06 14:16:01', NULL),
(2, 1, '<p>gram</p>', 0, '2021-05-06 14:16:01', '2021-05-06 14:16:01', NULL),
(3, 1, '<p>pound</p>', 0, '2021-05-06 14:16:01', '2021-05-06 14:16:01', NULL),
(4, 2, '<p>kg</p>', 1, '2021-05-06 14:43:43', '2021-05-06 14:43:43', NULL),
(5, 2, '<p>gram</p>', 0, '2021-05-06 14:43:43', '2021-05-06 14:43:43', NULL),
(6, 2, '<p>meter</p>', 1, '2021-05-06 14:43:43', '2021-05-06 14:43:43', NULL),
(7, 2, '<p>second</p>', 1, '2021-05-06 14:43:43', '2021-05-06 14:43:43', NULL),
(8, 3, 'True', 1, '2021-05-06 14:44:31', '2021-05-06 14:44:31', NULL),
(9, 3, 'False', 0, '2021-05-06 14:44:31', '2021-05-06 14:44:31', NULL),
(10, 4, '<p>Measurement is the process of comparing known quantity with unknown quantity.</p>', NULL, '2021-05-06 14:45:59', '2021-05-06 14:45:59', NULL),
(11, 6, '<p>Parasite</p>', 1, '2021-05-11 08:27:42', '2021-05-11 08:27:42', NULL),
(12, 6, '<p>1917</p>', 0, '2021-05-11 08:27:42', '2021-05-11 08:27:42', NULL),
(13, 6, '<p>Marriage Story</p>', 0, '2021-05-11 08:27:42', '2021-05-11 08:27:42', NULL),
(14, 7, '<p>Bong Joon Ho</p>', 1, '2021-05-11 08:29:34', '2021-05-11 08:29:34', NULL),
(15, 7, '<p>Sam Mendes</p>', 0, '2021-05-11 08:29:34', '2021-05-11 08:29:34', NULL),
(16, 7, '<p>Roger Deakins</p>', 1, '2021-05-11 08:29:34', '2021-05-11 08:29:34', NULL),
(17, 7, '<p>Hans Zimmer</p>', 0, '2021-05-11 08:29:34', '2021-05-11 08:29:34', NULL),
(18, 8, '<p>4</p>', 1, '2021-06-03 12:26:40', '2021-06-03 12:26:40', NULL),
(19, 8, '<p>3</p>', 0, '2021-06-03 12:26:40', '2021-06-03 12:26:40', NULL),
(20, 9, '<p>1</p>', 1, '2021-06-03 12:27:07', '2021-06-03 12:27:07', NULL),
(21, 9, '<p>2</p>', 0, '2021-06-03 12:27:08', '2021-06-03 12:27:08', NULL),
(22, 10, 'True', 1, '2021-06-07 12:58:49', '2021-06-07 12:58:49', NULL),
(23, 10, 'False', 0, '2021-06-07 12:58:49', '2021-06-07 12:58:49', NULL),
(24, 11, 'True', 1, '2021-06-07 12:59:31', '2021-06-07 12:59:31', NULL),
(25, 11, 'False', 0, '2021-06-07 12:59:31', '2021-06-07 12:59:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_management_access', 'user-management-access', NULL, NULL, NULL),
(2, 'permission_create', 'permission-create', NULL, NULL, NULL),
(3, 'permission_edit', 'permission-edit', NULL, NULL, NULL),
(4, 'permission_show', 'permission-show', NULL, NULL, NULL),
(5, 'permission_delete', 'permission-delete', NULL, NULL, NULL),
(6, 'permission_access', 'permission-access', NULL, NULL, NULL),
(7, 'role_create', 'role-create', NULL, NULL, NULL),
(8, 'role_edit', 'role-edit', NULL, NULL, NULL),
(9, 'role_show', 'role-show', NULL, NULL, NULL),
(10, 'role_delete', 'role-delete', NULL, NULL, NULL),
(11, 'role_access', 'role-access', NULL, NULL, NULL),
(12, 'user_create', 'user-create', NULL, NULL, NULL),
(13, 'user_edit', 'user-edit', NULL, NULL, NULL),
(14, 'user_show', 'user-show', NULL, NULL, NULL),
(15, 'user_delete', 'user-delete', NULL, NULL, NULL),
(16, 'user_access', 'user-access', NULL, NULL, NULL),
(17, 'group_create', 'group-create', NULL, NULL, NULL),
(18, 'group_edit', 'group-edit', NULL, NULL, NULL),
(19, 'group_show', 'group-show', NULL, NULL, NULL),
(20, 'group_delete', 'group-delete', NULL, NULL, NULL),
(21, 'group_access', 'group-access', NULL, NULL, NULL),
(22, 'course_create', 'course-create', NULL, NULL, NULL),
(23, 'course_edit', 'course-edit', NULL, NULL, NULL),
(24, 'course_show', 'course-show', NULL, NULL, NULL),
(25, 'course_delete', 'course-delete', NULL, NULL, NULL),
(26, 'course_access', 'course-access', NULL, NULL, NULL),
(27, 'lesson_create', 'lesson-create', NULL, NULL, NULL),
(28, 'lesson_edit', 'lesson-edit', NULL, NULL, NULL),
(29, 'lesson_show', 'lesson-show', NULL, NULL, NULL),
(30, 'lesson_delete', 'lesson-delete', NULL, NULL, NULL),
(31, 'lesson_access', 'lesson-access', NULL, NULL, NULL),
(32, 'category_create', 'category-create', NULL, NULL, NULL),
(33, 'category_edit', 'category-edit', NULL, NULL, NULL),
(34, 'category_show', 'category-show', NULL, NULL, NULL),
(35, 'category_delete', 'category-delete', NULL, NULL, NULL),
(36, 'category_access', 'category-access', NULL, NULL, NULL),
(37, 'quiz_create', 'quiz-create', NULL, NULL, NULL),
(38, 'quiz_edit', 'quiz-edit', NULL, NULL, NULL),
(39, 'quiz_show', 'quiz-show', NULL, NULL, NULL),
(40, 'quiz_delete', 'quiz-delete', NULL, NULL, NULL),
(41, 'quiz_access', 'quiz-access', NULL, NULL, NULL),
(42, 'question_create', 'question-create', NULL, NULL, NULL),
(43, 'question_edit', 'question-edit', NULL, NULL, NULL),
(44, 'question_show', 'question-show', NULL, NULL, NULL),
(45, 'question_delete', 'question-delete', NULL, NULL, NULL),
(46, 'question_access', 'question-access', NULL, NULL, NULL),
(47, 'grade_create', 'grade-create', NULL, NULL, NULL),
(48, 'grade_edit', 'grade-edit', NULL, NULL, NULL),
(49, 'grade_show', 'grade-show', NULL, NULL, NULL),
(50, 'grade_delete', 'grade-delete', NULL, NULL, NULL),
(51, 'grade_access', 'grade-access', NULL, NULL, NULL),
(52, 'student_create', 'student-create', NULL, NULL, NULL),
(53, 'student_edit', 'student-edit', NULL, NULL, NULL),
(54, 'student_show', 'student-show', NULL, NULL, NULL),
(55, 'student_delete', 'student-delete', NULL, NULL, NULL),
(56, 'student_access', 'student-access', NULL, NULL, NULL),
(57, 'response_access', 'response-access', '2021-06-03 08:53:52', '2021-06-03 08:53:52', NULL),
(58, 'setting_create', 'setting-create', '2021-08-25 07:51:45', '2021-08-25 07:51:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_hint` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer_explanation` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Multiple Choices',
  `marks` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `question_no` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `question_hint`, `image`, `answer_explanation`, `type`, `marks`, `time`, `time_type`, `created_at`, `updated_at`, `deleted_at`, `question_no`) VALUES
(1, '<p>What is SI unit of mass?</p>', '<p><strong>SI</strong> is the metric system that is used universally as a standard for measurements.</p>', NULL, '<p>SI unit of mass is kg.</p>', 'Multiple Choices', '10', NULL, NULL, '2021-05-06 14:16:01', '2021-06-07 12:27:28', NULL, 1),
(2, '<p>Which of them listed below are <strong>SI </strong>units?</p>', NULL, NULL, '<p>kg,gram and second are <strong>SI</strong> units.</p>', 'Multiple Answers', '10', '60', NULL, '2021-05-06 14:43:43', '2021-06-07 12:27:28', NULL, 2),
(3, '<p>Is second <strong>SI</strong> unit of time?</p>', NULL, NULL, '<p>Second is SI unit of time.</p>', 'True or False', '10', NULL, NULL, '2021-05-06 14:44:31', '2021-06-07 13:15:43', '2021-06-07 13:15:43', 3),
(4, '<p>What is measurement?</p>', NULL, NULL, '<p>Measurement is the process of comparing known quantity with unknown quantity.</p>', 'Short Answer', '10', NULL, NULL, '2021-05-06 14:45:59', '2021-06-07 13:15:43', NULL, 3),
(5, '<p>What is SI?</p>', NULL, NULL, NULL, 'Multiple Choices', '10', '60', NULL, '2021-05-10 13:50:59', '2021-06-06 12:55:27', '2021-06-06 12:55:27', NULL),
(6, '<p>Academy for Best Picture of 2019 ?</p>', NULL, NULL, NULL, 'Multiple Choices', '1', NULL, NULL, '2021-05-11 08:27:42', '2021-06-07 13:18:37', NULL, 1),
(7, '<p>Academy winners of 2020.</p>', NULL, NULL, NULL, 'Multiple Answers', '1', NULL, NULL, '2021-05-11 08:29:34', '2021-06-07 14:25:38', NULL, 2),
(8, '<p>2+2=?</p>', NULL, NULL, NULL, 'Multiple Choices', '1', NULL, NULL, '2021-06-03 12:26:40', '2021-06-07 14:25:38', NULL, 3),
(9, '<p>1+1=?</p>', NULL, NULL, NULL, 'Multiple Choices', '1', NULL, NULL, '2021-06-03 12:27:07', '2021-06-07 14:25:38', NULL, 4),
(10, '<p>hask</p>', NULL, NULL, NULL, 'True or False', '1', NULL, NULL, '2021-06-07 12:58:49', '2021-06-07 13:15:06', '2021-06-07 13:15:06', 1),
(11, '<p>kjajs</p>', NULL, NULL, NULL, 'True or False', '1', NULL, NULL, '2021-06-07 12:59:31', '2021-06-07 13:15:06', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_quiz`
--

CREATE TABLE `question_quiz` (
  `question_id` int(10) UNSIGNED DEFAULT NULL,
  `quiz_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_quiz`
--

INSERT INTO `question_quiz` (`question_id`, `quiz_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 2),
(11, 2);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `lesson_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published` tinyint(4) DEFAULT 0,
  `attempts_no` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `start_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `time_type` int(11) DEFAULT NULL,
  `pass_marks` double(8,2) DEFAULT NULL,
  `full_marks` double(8,2) DEFAULT NULL,
  `remaining_marks` double(8,2) DEFAULT NULL,
  `quiz_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_view` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer_publish` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `course_id`, `lesson_id`, `title`, `description`, `published`, `attempts_no`, `created_at`, `updated_at`, `deleted_at`, `start_at`, `end_at`, `time`, `time_type`, `pass_marks`, `full_marks`, `remaining_marks`, `quiz_type`, `answer_view`, `answer_publish`) VALUES
(1, 1, 1, 'Measurement Practice', NULL, 1, 0, '2021-05-06 14:10:14', '2021-06-07 13:15:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20.00, 'Practice Quiz', 'during_quiz', 1),
(2, 2, 2, 'Force Mock Test', NULL, 0, 1, '2021-05-06 15:50:34', '2021-06-07 14:01:40', '2021-06-07 14:01:40', NULL, NULL, NULL, NULL, 40.00, 100.00, 100.00, 'Mock Test', 'end_of_quiz', 1),
(3, 1, 1, 'Best Picture', NULL, 1, 0, '2021-05-11 08:25:24', '2021-06-07 14:25:33', NULL, NULL, NULL, 1, 1, NULL, NULL, 0.00, 'Normal Quiz', 'during_quiz', 0);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_student`
--

CREATE TABLE `quiz_student` (
  `quiz_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_user`
--

CREATE TABLE `quiz_user` (
  `quiz_id` int(10) UNSIGNED DEFAULT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_user`
--

INSERT INTO `quiz_user` (`quiz_id`, `admin_id`) VALUES
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin', NULL, NULL, NULL),
(2, 'User', 'user', NULL, NULL, NULL),
(3, 'Teacher', 'teacher', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32),
(2, 33),
(2, 34),
(2, 35),
(2, 36),
(2, 37),
(2, 38),
(2, 39),
(2, 40),
(2, 41),
(2, 42),
(2, 43),
(2, 44),
(2, 45),
(2, 46),
(2, 47),
(2, 48),
(2, 49),
(2, 50),
(2, 51),
(2, 52),
(2, 53),
(2, 54),
(2, 55),
(2, 56),
(3, 22),
(3, 23),
(3, 24),
(3, 25),
(3, 26),
(3, 27),
(3, 28),
(3, 29),
(3, 30),
(3, 31),
(3, 32),
(3, 33),
(3, 34),
(3, 35),
(3, 36),
(3, 37),
(3, 38),
(3, 39),
(3, 40),
(3, 41),
(3, 42),
(3, 43),
(3, 44),
(3, 45),
(3, 46),
(3, 47),
(3, 48),
(3, 49),
(3, 50),
(3, 51);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `theme_color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `course_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `address`, `contact`, `school`, `passed`, `status`, `course_id`) VALUES
(5, 'Bibek', 'bibekkhatri81@gmail.com', '$2y$10$h/6/hYXmXw1deQyx7f1Bt.ssaVlm1zB9DtOEF.TKT/ewTR7A3mxi6', NULL, '2021-06-08 03:17:18', '2021-06-08 03:17:18', NULL, NULL, NULL, NULL, NULL, 0, NULL),
(6, 'rajan', 'rebelprajapati88@gmail.com', '$2y$10$qxBBmqrd7f6sCwK.x/7NuesCg9Pd25E43RXPf5AKYuBK80Be3u5Hi', NULL, '2021-06-08 03:17:19', '2021-06-08 03:17:19', NULL, NULL, NULL, NULL, NULL, 0, NULL),
(7, 'urmila', 'u@u.com', '$2y$10$zwCGAlDn3irGWbFBie3kF.aXf2eLVPB9Z1kt8nfOiaNGhvhyJICl.', 'npTTbsjGsTiVky2Lh9DlfBIMEym5uoiTqMP39dbvW1AkhZwiGEqknHPhPo9G', '2021-06-27 11:27:57', '2021-06-28 04:39:41', NULL, NULL, '9818948604', 'innovative', NULL, 0, 1),
(8, 'Remika Shakya', 'remikashakya07@gmail.com', '$2y$10$gnUqRAWF/XSUhLtAUX67W.CYRyrXzn3r9tUnHI0V0Xik9Bb/C1LmW', 'YnKDVGy0JmPxgGtLcji5p481GTfbMaa2f1gnoMd3aY4SWIOItSLpPKxmADh7', '2021-06-27 15:51:03', '2021-06-27 17:39:15', NULL, NULL, '9803368757', 'innovative', NULL, 0, 1),
(9, 'Lila Waller', 'vytyxudypi@mailinator.com', '$2y$10$oU3slzhZw2J6pE5mlmmZP.OiviMGDE5sst89bJuHpd4.JFsXd5Wq.', 'tbFaE2oFO6e600FdTeiICw9xv9WxWPzeELXAgSm9YsD7QVF10YsdTYck2mUj', '2021-06-27 15:53:51', '2021-06-27 15:53:51', NULL, NULL, NULL, NULL, NULL, 0, NULL),
(10, 'Harrison Allen', 'cexep@mailinator.com', '$2y$10$SUmoZlsTH..xzgJp0hpLje45HHecVQaMHYZMk9zzijzDbS0XRDk5u', 'lWqeHtNOLj0PkD2qFFV36lQz9T7gUQCzBs9zPXPxJWxJq2YxMCV8qjIn0uab', '2021-06-27 15:55:46', '2021-06-27 15:55:46', NULL, NULL, 'Quia amet dolore as', 'Quisquam quis sunt s', NULL, 0, NULL),
(11, 'Allistair Kent', 'myheku@mailinator.com', '$2y$10$xiyn0NRQ7bFyhLnvhwT7fOXdYpBWWI4t.QMHAKXbKMPsEpFASacPK', 'vZCrOPJdWdDGvNkpUJhLicJIcQgVmlh1PN5zyxqaciSPLxgX9wcnLqt8OlzT', '2021-06-27 16:00:02', '2021-06-27 16:00:02', NULL, NULL, 'Quasi qui aspernatur', 'Cupiditate esse eiu', NULL, 0, NULL),
(12, 'Farrah Tucker', 'dyzob@mailinator.com', '$2y$10$eucOWaU14zGKBBcSiGWd9eI.APJX.NZpDHaToUSQnodq3VKfwkysW', 'MaRwCrJXbfkhrI4CTZzI5ONPGe9AVhnOQhTvEwvqpttm74CnuW1ETlbZGdH2', '2021-06-27 16:07:54', '2021-06-27 16:07:54', NULL, NULL, 'Quod consectetur ea', 'Obcaecati in tenetur', NULL, 0, NULL),
(13, 'Maxwell Luna', 'hepuv@mailinator.com', '$2y$10$ZVA1Xdk1ZQ33iKk/jHTs2unygtrq43qCh/IqLxrmxco1nn4LOCF.6', 'T9FHKOSTqeV7Vnc0M0Q5AzPin7dSqgSOeWjTiBLEpR8eeW9RBz6wJRxZtfgQ', '2021-06-27 16:46:34', '2021-06-27 16:46:34', NULL, NULL, 'Eos molestiae autem', 'Voluptate deserunt m', NULL, 0, NULL),
(14, 'Kennan Guerrero', 'cozulukux@mailinator.com', '$2y$10$9LFHzjxVZdhG6TVO8mpu4OWq9S6jQcg7yCPi.iaJmo1H9rLVgrh/K', '5KtjPHLuHhxLhJg8cgDKTnOqpUnqKTGWgVVbppQMxhwFPQ5se3EWDtGaJiOs', '2021-06-27 17:17:14', '2021-06-27 17:17:14', NULL, NULL, 'Autem fugiat velit', 'Facere magnam quidem', NULL, 0, NULL),
(15, 'Clare Henry', 'mosapim@mailinator.com', '$2y$10$BsmFbnnkF5VVPuZZN2ZyHurBUFM6LEcEdpsGzLb1g3ZJYlly.1kce', 'G4zkd9Y9PJSfSL8mwWfndL7Jgaj0aeZjicEbnDa71zahuOqN7PHGFXDwEfk1', '2021-06-27 17:19:08', '2021-06-27 17:19:08', NULL, NULL, 'Praesentium soluta q', 'Et hic repudiandae v', NULL, 0, NULL),
(16, 'Veda Warner', 'cowyhemu@mailinator.com', '$2y$10$wzmRDt.brW4NGV9HEGNBDeptCEz7Wdj4oXi1O5vhd8RyURvW.GR7a', NULL, '2021-06-27 17:20:01', '2021-06-27 17:20:01', NULL, NULL, 'Cillum ut anim susci', 'Tempore nihil ad re', NULL, 0, NULL),
(17, 'McKenzie Contreras', 'xibo@mailinator.com', '$2y$10$xHTqrGQegwqrYP8j7SyiweEMOBAlBYKjirjIzDyw2w8HGT/0Dwx82', 'Ejei6vBs4wnFexcr2FLV64RN6YjgdEYreUUh3L68qOJNlez1sVylkDxymj9F', '2021-06-27 17:22:26', '2021-06-27 17:22:26', NULL, NULL, 'Voluptatum enim exce', 'Fugiat dolore illum', NULL, 0, 2),
(18, 'uma', 'uma@uma.com', '$2y$10$egeIQ0FOEKXj7CGVSYheuub7n462vTWD0WOI/eTmXzUry7lHLcBhi', 'EEAXumEHSBipNNqKR1VEVKq2gaiuuCxoQ2lscVkPxFuPTSHCwdBV1aiF9AT9', '2021-06-27 17:40:52', '2021-06-27 17:43:25', NULL, NULL, '123456789', 'parijat', NULL, 0, NULL),
(19, 'bright', 'bright@bright.com', '$2y$10$PxMXVCLSppAVJ5XddojM7.ge.RVJYIvx1bzAhGovrRtyOOvWtNj1q', 'rchnr8d3O8zhk9oVQtV5ghuVgf1rT19GdIx8wFMVenns7T4ihqbD2QE1f4lk', '2021-06-28 04:28:19', '2021-06-28 04:31:02', NULL, NULL, '1234567891', 'bright', NULL, 1, 1),
(20, 'Nichole Justice', 'barapenari@mailinator.com', '$2y$10$sEojZ09U32rAvXhrR5gpk.igApyBqj2QW41k.dtsGBU4pDiZsZWDC', '1GDdo0zyyP3hh85qD468Nouet0IS8uTvzHayzCVWYWwb6evKx9l9493teHab', '2021-06-28 07:04:12', '2021-06-28 07:04:12', NULL, NULL, 'Eiusmod sint volupt', 'Atque corrupti est', NULL, 0, 1),
(21, 'Callum Boyd', 'qurajogap@mailinator.com', '$2y$10$rEnZG0T2HIFkeBLydJTrweE3gBy0PI9P8CkfVNkV80GHwfKN2KOBi', NULL, '2021-06-28 11:39:34', '2021-06-28 11:39:34', NULL, NULL, '+1 (136) 944-2598', 'Dolorem non officia', NULL, 0, 1),
(22, 'Holly Castro', 'lyqih@mailinator.com', '$2y$10$crPJwG6gFO5ToIbGE5vc9.0Gu3MxX5d8IkXefRi5QtnIZHJbn2AGC', NULL, '2021-06-28 11:41:54', '2021-06-28 11:41:54', NULL, NULL, '+1 (526) 664-5297', 'Enim sit temporibus', NULL, 0, 2),
(24, 'remika shakya', 'remikashakya@gmail.com', '$2y$10$O/bSeIQ5dnrO7d2mFmHKDeVfs89tCA7ZvV1YJl1SNX/oIEqEKU9Mq', 'uhMII4L6PC1hk0iyT1X7oR1PF18brkJft2vJeko6woqHPveR4GTkhsuyOCuM', '2021-08-26 08:01:10', '2021-08-26 08:15:01', NULL, NULL, '9803368758', 'innovative', NULL, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admins_groups`
--
ALTER TABLE `admins_groups`
  ADD PRIMARY KEY (`admin_id`,`group_id`),
  ADD KEY `admins_groups_group_id_foreign` (`group_id`);

--
-- Indexes for table `admins_permissions`
--
ALTER TABLE `admins_permissions`
  ADD PRIMARY KEY (`admin_id`,`permission_id`),
  ADD KEY `admins_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `admins_roles`
--
ALTER TABLE `admins_roles`
  ADD PRIMARY KEY (`admin_id`,`role_id`),
  ADD KEY `admins_roles_role_id_foreign` (`role_id`);

--
-- Indexes for table `attempts`
--
ALTER TABLE `attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attempts_quiz_id_foreign` (`quiz_id`),
  ADD KEY `attempts_user_id_foreign` (`user_id`),
  ADD KEY `attempts_deleted_at_index` (`deleted_at`);

--
-- Indexes for table `attempt_answers`
--
ALTER TABLE `attempt_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attempt_answers_attempt_id_foreign` (`attempt_id`),
  ADD KEY `attempt_answers_question_id_foreign` (`question_id`),
  ADD KEY `attempt_answers_deleted_at_index` (`deleted_at`);

--
-- Indexes for table `attempt_options`
--
ALTER TABLE `attempt_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attempt_options_attempt_answer_id_foreign` (`attempt_answer_id`),
  ADD KEY `attempt_options_option_id_foreign` (`option_id`),
  ADD KEY `attempt_options_deleted_at_index` (`deleted_at`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_category_id_foreign` (`category_id`),
  ADD KEY `courses_grade_id_foreign` (`grade_id`),
  ADD KEY `courses_deleted_at_index` (`deleted_at`);

--
-- Indexes for table `course_student`
--
ALTER TABLE `course_student`
  ADD KEY `course_student_course_id_foreign` (`course_id`),
  ADD KEY `course_student_user_id_foreign` (`user_id`);

--
-- Indexes for table `course_user`
--
ALTER TABLE `course_user`
  ADD KEY `course_user_course_id_foreign` (`course_id`),
  ADD KEY `course_user_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_course_id_foreign` (`course_id`),
  ADD KEY `lessons_deleted_at_index` (`deleted_at`);

--
-- Indexes for table `lesson_student`
--
ALTER TABLE `lesson_student`
  ADD KEY `lesson_student_lesson_id_foreign` (`lesson_id`),
  ADD KEY `lesson_student_user_id_foreign` (`user_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_question_id_foreign` (`question_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_deleted_at_index` (`deleted_at`);

--
-- Indexes for table `question_quiz`
--
ALTER TABLE `question_quiz`
  ADD KEY `question_quiz_question_id_foreign` (`question_id`),
  ADD KEY `question_quiz_quiz_id_foreign` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `54422_596eeef514d00` (`course_id`),
  ADD KEY `54422_596eeef53411a` (`lesson_id`),
  ADD KEY `quizzes_deleted_at_index` (`deleted_at`);

--
-- Indexes for table `quiz_student`
--
ALTER TABLE `quiz_student`
  ADD KEY `quiz_student_quiz_id_foreign` (`quiz_id`),
  ADD KEY `quiz_student_user_id_foreign` (`user_id`);

--
-- Indexes for table `quiz_user`
--
ALTER TABLE `quiz_user`
  ADD KEY `quiz_user_quiz_id_foreign` (`quiz_id`),
  ADD KEY `quiz_user_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `roles_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_contact_unique` (`contact`),
  ADD KEY `users_course_id_foreign` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attempts`
--
ALTER TABLE `attempts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `attempt_answers`
--
ALTER TABLE `attempt_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `attempt_options`
--
ALTER TABLE `attempt_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins_groups`
--
ALTER TABLE `admins_groups`
  ADD CONSTRAINT `admins_groups_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admins_groups_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `admins_permissions`
--
ALTER TABLE `admins_permissions`
  ADD CONSTRAINT `admins_permissions_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admins_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `admins_roles`
--
ALTER TABLE `admins_roles`
  ADD CONSTRAINT `admins_roles_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admins_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attempts`
--
ALTER TABLE `attempts`
  ADD CONSTRAINT `attempts_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attempts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attempt_answers`
--
ALTER TABLE `attempt_answers`
  ADD CONSTRAINT `attempt_answers_attempt_id_foreign` FOREIGN KEY (`attempt_id`) REFERENCES `attempts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attempt_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attempt_options`
--
ALTER TABLE `attempt_options`
  ADD CONSTRAINT `attempt_options_attempt_answer_id_foreign` FOREIGN KEY (`attempt_answer_id`) REFERENCES `attempt_answers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attempt_options_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `courses_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_student`
--
ALTER TABLE `course_student`
  ADD CONSTRAINT `course_student_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_student_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_user`
--
ALTER TABLE `course_user`
  ADD CONSTRAINT `course_user_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_user_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lesson_student`
--
ALTER TABLE `lesson_student`
  ADD CONSTRAINT `lesson_student_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lesson_student_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_quiz`
--
ALTER TABLE `question_quiz`
  ADD CONSTRAINT `question_quiz_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_quiz_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `54422_596eeef514d00` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `54422_596eeef53411a` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_student`
--
ALTER TABLE `quiz_student`
  ADD CONSTRAINT `quiz_student_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_student_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_user`
--
ALTER TABLE `quiz_user`
  ADD CONSTRAINT `quiz_user_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_user_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD CONSTRAINT `roles_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
