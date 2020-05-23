-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2020 at 05:50 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faq`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_stats`
--

CREATE TABLE `access_stats` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_stats`
--

INSERT INTO `access_stats` (`id`, `user_id`, `updated_at`) VALUES
(1, 1, '2020-04-27 03:50:49'),
(2, 1, '2020-04-28 03:51:33'),
(3, 2, '2020-04-16 03:51:42'),
(4, 2, '2020-04-15 03:51:42'),
(5, 7, '2020-04-02 03:52:02'),
(6, 7, '2020-04-08 03:52:02'),
(7, 3, '2020-03-27 03:52:20'),
(8, 3, '2020-03-19 03:52:20');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer`, `created_at`, `updated_at`) VALUES
(20, 15, '5000000000$', NULL, NULL),
(22, 17, '50000000000$', NULL, NULL),
(23, 18, '500000000000$', NULL, NULL),
(24, 19, 'On 20 September 2019', NULL, NULL),
(25, 20, 'On 14 July 2019', NULL, NULL),
(26, 21, 'Android 10 10 09/03/19', NULL, NULL),
(27, 20, 'A new update will arrive on 2021', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `created_at`, `updated_at`) VALUES
(7, 'Apple', '2020-04-19 18:18:27', '2020-04-19 18:18:27'),
(9, 'Android', '2020-04-19 18:19:22', '2020-04-19 18:19:22'),
(10, 'Windows', '2020-04-19 18:19:34', '2020-04-27 20:38:42');

-- --------------------------------------------------------

--
-- Table structure for table `liveanswers`
--

CREATE TABLE `liveanswers` (
  `id` int(10) UNSIGNED NOT NULL,
  `livequestion_id` int(11) UNSIGNED NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `livequestions`
--

CREATE TABLE `livequestions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `livequestions`
--

INSERT INTO `livequestions` (`id`, `user_id`, `question`, `status`, `created_at`, `updated_at`) VALUES
(15, 3, 'Hey, man I need help?', 0, '2020-04-19 19:06:56', '2020-04-19 19:06:56'),
(16, 3, 'I need help plz come fast.', 0, '2020-04-19 19:07:19', '2020-04-19 19:07:19');

-- --------------------------------------------------------

--
-- Table structure for table `main_questions`
--

CREATE TABLE `main_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_questions`
--

INSERT INTO `main_questions` (`id`, `category_id`, `question`, `created_at`, `updated_at`) VALUES
(15, 7, 'What is the total brand value of Apple?', NULL, '2020-04-19 18:37:08'),
(17, 9, 'What is the total brand value of Android?', NULL, '2020-04-19 18:37:05'),
(18, 10, 'What is the total brand value of Windows?', NULL, NULL),
(19, 7, 'When was iPhone 11 release?', NULL, NULL),
(20, 10, 'When will new windows OS come?', NULL, '2020-04-19 18:36:50'),
(21, 9, 'What is the latest android system OS called?', NULL, '2020-04-19 18:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_04_01_073135_create_notice_table', 2),
(7, '2020_04_05_080728_create_categories_table', 3),
(8, '2020_04_05_080906_create_main_questions_table', 4),
(9, '2020_04_05_081003_create_answers_table', 5),
(10, '2020_04_07_014552_create_roles_table', 6),
(11, '2020_04_07_015134_create_role_user_table', 6),
(12, '2020_04_11_070739_create_livequestions_table', 7),
(13, '2020_04_11_072221_create_liveanswers_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(10) UNSIGNED NOT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `topic`, `content`, `created_at`, `updated_at`) VALUES
(1, 'news', 'We will give you list of laravel 5 tutorial and laravel 6 tutorial like laravel crud, laravel authentication, laravel rest api, laravel basic, laravel advance, laravel relationship ect. it will helps you to how to start work with new project in laravel and how to you can use laravel concept on your project.', NULL, NULL),
(2, 'event', 'Insert Update Delete module is primary requirement for each project, so in this tutorial i will give you step by step instruction for creating crud (Create Read Update Delete) Application in laravel 6. you will understand how to use resource route, controller, blade files, model and migration for crud operation in laravel 6.', NULL, NULL),
(3, 'notice', 'Laravel 6 is just released by tomorrow, Laravel 6 gives several new features and LTS support. So if you are new to laravel then this tutorial will help you create insert update delete application in laravel 6.\r\n\r\nYou just need to follow few step and you will get basic crud stuff using controller, model, route, bootstrap 4 and blade..\r\n\r\nIn this tutorial, you will learn very basic crud operation with laravel new version 6. I am going to show you step by step from scratch so, i will better to understand if you are new in laravel.', NULL, NULL),
(4, 'news', 'Do more with buttons. Control button states or create groups of buttons for more components like toolbars.', NULL, NULL),
(5, 'event', 'Examples are better than 1000 words. Examples are often easier to understand than text explanations.\r\n\r\nThis tutorial supplements all explanations with clarifying \"Try it Yourself\" examples.', NULL, NULL),
(6, 'notice', 'You can center any element (text, images, div, buttons) horizontally by using center utilities or flexbox. See the examples below to find out how.\r\n\r\n', NULL, NULL),
(7, 'news', 'As with Bootstrap 3, DataTables can also be integrated seamlessly with Bootstrap 4. This integration is done simply by including the DataTables Bootstrap 4 files (CSS and JS) which sets the defaults needed for DataTables to be initialised as normal, as shown in this example.', NULL, NULL),
(8, 'news', 'As with Bootstrap 3, DataTables can also be integrated seamlessly with Bootstrap 4. This integration is done simply by including the DataTables Bootstrap 4 files (CSS and JS) which sets the defaults needed for DataTables to be initialised as normal, as shown in this example.', NULL, NULL),
(9, 'news', 'As with Bootstrap 3, DataTables can also be integrated seamlessly with Bootstrap 4. This integration is done simply by including the DataTables Bootstrap 4 files (CSS and JS) which sets the defaults needed for DataTables to be initialised as normal, as shown in this example.', NULL, NULL),
(11, 'news', 'As with Bootstrap 3, DataTables can also be integrated seamlessly with Bootstrap 4. This integration is done simply by including the DataTables Bootstrap 4 files (CSS and JS) which sets the defaults needed for DataTables to be initialised as normal, as shown in this example.', NULL, NULL),
(12, 'news', 'As with Bootstrap 3, DataTables can also be integrated seamlessly with Bootstrap 4. This integration is done simply by including the DataTables Bootstrap 4 files (CSS and JS) which sets the defaults needed for DataTables to be initialised as normal, as shown in this example.', NULL, NULL),
(13, 'news', 'As with Bootstrap 3, DataTables can also be integrated seamlessly with Bootstrap 4. This integration is done simply by including the DataTables Bootstrap 4 files (CSS and JS) which sets the defaults needed for DataTables to be initialised as normal, as shown in this example.', NULL, NULL),
(14, 'news', 'As with Bootstrap 3, DataTables can also be integrated seamlessly with Bootstrap 4. This integration is done simply by including the DataTables Bootstrap 4 files (CSS and JS) which sets the defaults needed for DataTables to be initialised as normal, as shown in this example.', NULL, NULL),
(16, 'news', 'Cillum ad ut irure tempor velit nostrud occaecat ullamco aliqua anim Lorem sint. Veniam sint duis incididunt do esse magna mollit excepteur laborum qui. Id id reprehenderit sit est eu aliqua occaecat quis et velit excepteur laborum mollit dolore eiusmod. Ipsum dolor in occaecat commodo et voluptate minim reprehenderit mollit pariatur. Deserunt non laborum enim et cillum eu deserunt excepteur ea incididunt minim occaecat.', NULL, NULL),
(17, 'news', 'Cillum ad ut irure tempor velit nostrud occaecat ullamco aliqua anim Lorem sint. Veniam sint duis incididunt do esse magna mollit excepteur laborum qui. Id id reprehenderit sit est eu aliqua occaecat quis et velit excepteur laborum mollit dolore eiusmod. Ipsum dolor in occaecat commodo et voluptate minim reprehenderit mollit pariatur. Deserunt non laborum enim et cillum eu deserunt excepteur ea incididunt minim occaecat.', NULL, NULL),
(22, 'notice', 'It is an important notice please listen carefully.', '2020-04-04 12:05:46', '2020-04-04 12:05:46'),
(24, 'event', 'A big event is coming, stay tuned.', '2020-04-04 12:30:58', '2020-04-19 18:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('newfolder331@gmail.com', '$2y$10$wIPatuI14ITWZ1./AINjkuEubnXoFC7.EhgBKU37YohRTOuhwZt36', '2020-04-15 15:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `ques_hit_count_stats`
--

CREATE TABLE `ques_hit_count_stats` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(11) UNSIGNED NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ques_hit_count_stats`
--

INSERT INTO `ques_hit_count_stats` (`id`, `question_id`, `updated_at`) VALUES
(31, 21, '2020-04-19 18:36:44'),
(32, 20, '2020-04-19 18:36:45'),
(33, 20, '2020-04-19 18:36:48'),
(34, 20, '2020-04-19 18:36:50'),
(35, 17, '2020-04-19 18:37:05'),
(36, 15, '2020-04-19 18:37:07'),
(37, 15, '2020-04-19 18:37:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2020-04-08 23:38:01', '2020-04-08 23:38:01'),
(2, 'manager', '2020-04-08 23:38:01', '2020-04-08 23:38:01'),
(3, 'generic', '2020-04-08 23:38:01', '2020-04-08 23:38:01');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 2, 2, NULL, NULL),
(9, 3, 3, NULL, NULL),
(11, 1, 1, NULL, NULL),
(12, 3, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'sami@nelsite.net', '$2y$10$bsVbDPmERhaaNnkNIOcTSuVcyueUBxOadvXI7f/P1fXzWigiKBZaq', 'icVxJ0XXZJDv0se45j9kWZ4baqzREQEvCrSQz230elacxJ74MAhqDfdAJhP6', '2020-04-08 23:38:01', '2020-04-08 23:38:01'),
(2, 'manager', 'ayon@nelsite.net', '$2y$10$cyrbBBD7NsgZqB2kRBFSuOCReE3r931ibXSURqZyhwFAP5tPZUpJq', 'HXzBZo43jgQXgPOS3b2qrjmltl5X1txStRE3o5IwR6nLGCfRnFpokbKCKMcO', '2020-04-08 23:38:01', '2020-04-20 02:43:18'),
(3, 'user', 'fahim@nelsite.net', '$2y$10$ts/3fijdXdCKQ3eWh4foL.Q2HUIqld6VRDIj2bd7oL0xOE5Hihqf.', 'Ov7Dn6UTQjTyGlsQnrk9kncpZsCTubQX6pWyT0RhQHGjDYhDNpAIREp681U4', '2020-04-08 23:38:01', '2020-04-27 18:58:52'),
(7, 'Samiur Rahman', 'samiur27@yahoo.com', '$2y$10$1/grlOWLqgxMvKOmw6UBF.S47nyLAz/vHLG8UMo8OGDieNgaRaxie', 'LCQDNT2FJzb9TCA7v5LXKEIPY6gwXvCXOwKgt7WSk5Mhs3B2v8zPBu6Ygz2q', '2020-04-09 19:17:08', '2020-04-09 19:17:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_stats`
--
ALTER TABLE `access_stats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access_stats_user_id_foreign` (`user_id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_question_id_foreign` (`question_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liveanswers`
--
ALTER TABLE `liveanswers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `liveanswers_livequestion_id_foreign` (`livequestion_id`);

--
-- Indexes for table `livequestions`
--
ALTER TABLE `livequestions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livequestions_user_id_foreign` (`user_id`);

--
-- Indexes for table `main_questions`
--
ALTER TABLE `main_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `main_questions_category_id_foreign` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(250));

--
-- Indexes for table `ques_hit_count_stats`
--
ALTER TABLE `ques_hit_count_stats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ques_id` (`question_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id_foreign` (`role_id`),
  ADD KEY `user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_stats`
--
ALTER TABLE `access_stats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `liveanswers`
--
ALTER TABLE `liveanswers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `livequestions`
--
ALTER TABLE `livequestions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `main_questions`
--
ALTER TABLE `main_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `ques_hit_count_stats`
--
ALTER TABLE `ques_hit_count_stats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_stats`
--
ALTER TABLE `access_stats`
  ADD CONSTRAINT `access_stats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `main_questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `liveanswers`
--
ALTER TABLE `liveanswers`
  ADD CONSTRAINT `liveanswers_livequestion_id_foreign` FOREIGN KEY (`livequestion_id`) REFERENCES `livequestions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `livequestions`
--
ALTER TABLE `livequestions`
  ADD CONSTRAINT `livequestions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `main_questions`
--
ALTER TABLE `main_questions`
  ADD CONSTRAINT `main_questions_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ques_hit_count_stats`
--
ALTER TABLE `ques_hit_count_stats`
  ADD CONSTRAINT `ques_id` FOREIGN KEY (`question_id`) REFERENCES `main_questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
