-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2024 at 08:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invesis_db_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_06_14_170052_create_pages_table', 2),
(6, '2024_06_15_090508_create_payments_table', 3),
(7, '2024_06_17_145208_create_payment_transactions_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `product` varchar(255) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `image`, `description`, `type`, `product`, `price`, `currency`, `created_at`, `updated_at`) VALUES
(1, 'Dell Laptop 16 Gb Ram,255 Gb SSD', 'dell-laptop-sell.jpg', 'Dell Laptop 16 Gb Ram,255 Gb SSD', 'Payment Page', 'Dell Inspiron 3000', 4510.00, 'usd', '2024-06-15 06:43:18', '2024-06-15 23:35:54'),
(2, 'Success', 'yes.png', 'Payment successfully Completed', 'Normal Page', NULL, NULL, NULL, '2024-06-15 07:08:19', '2024-06-16 12:55:25'),
(3, NULL, 'sports_shoe.jpg', 'nike', 'Payment Page', 'Nike shoe', 50.00, 'usd', '2024-06-15 07:18:22', '2024-06-15 07:18:22'),
(4, 'Failure', 'cross.png', 'Payment not completed sucessfully', 'Normal Page', NULL, NULL, NULL, '2024-06-15 07:19:52', '2024-06-16 12:55:38'),
(5, NULL, 'Ceat_Hitman_English_Willow_Cricket_Bat.jpg', 'English Willow cricket bat', 'Payment Page', 'Cricket Bat', 100.00, 'usd', '2024-06-15 07:24:20', '2024-06-15 07:24:20'),
(6, NULL, 'base_ball_batimages.jpg', 'Highly strong and fully gripped base bal bat', 'Payment Page', 'BaseBal Bat', 75.00, 'usd', '2024-06-15 07:25:38', '2024-06-15 07:25:38'),
(7, NULL, 'cricket-bat.jpg', 'Cricket Bat for Adults', 'Payment Page', 'Bat', 200.00, 'usd', '2024-06-15 23:31:07', '2024-06-15 23:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stripe_charge_id` varchar(255) NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `stripe_charge_id`, `page_id`, `amount`, `currency`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ch_3PRwiC07KpQywGF20YKKefJP', 1, 4500.00, 'usd', 'Dell Laptop 16 Gb Ram,255 Gb SSD', 'succeeded', '2024-06-15 08:02:08', '2024-06-15 08:02:08'),
(2, 'ch_3PRzeh07KpQywGF21nPUh77l', 3, 50.00, 'usd', 'nike', 'succeeded', '2024-06-15 11:10:43', '2024-06-15 11:10:43'),
(3, 'ch_3PRzhn07KpQywGF20taT2IsQ', 5, 100.00, 'usd', 'English Willow cricket bat', 'succeeded', '2024-06-15 11:13:56', '2024-06-15 11:13:56'),
(4, 'ch_3PSN8i07KpQywGF20s209ji8', 1, 4510.00, 'usd', 'Dell Laptop 16 Gb Ram,255 Gb SSD', 'succeeded', '2024-06-16 12:15:21', '2024-06-16 12:15:21'),
(5, 'ch_3PSNmN07KpQywGF21wFFc2x7', 1, 4510.00, 'usd', 'Dell Laptop 16 Gb Ram,255 Gb SSD', 'succeeded', '2024-06-16 12:56:17', '2024-06-16 12:56:17'),
(6, 'ch_3PSj3F07KpQywGF20r00Ffbj', 1, 4510.00, 'usd', 'Dell Laptop 16 Gb Ram,255 Gb SSD', 'succeeded', '2024-06-17 11:39:07', '2024-06-17 11:39:07'),
(7, 'ch_3PSj3r07KpQywGF21Rm0SwcE', 3, 50.00, 'usd', 'nike', 'succeeded', '2024-06-17 11:39:44', '2024-06-17 11:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `payment_transactions`
--

CREATE TABLE `payment_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_intent_id` varchar(255) DEFAULT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_transactions`
--

INSERT INTO `payment_transactions` (`id`, `payment_intent_id`, `page_id`, `amount`, `currency`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'pi_3PSiDc07KpQywGF21ozbv2xs', 1, 4510, 'usd', 'Dell Laptop 16 Gb Ram,255 Gb SSD', 'succeeded', '2024-06-17 10:46:14', '2024-06-17 10:46:14'),
(2, 'pi_3PSiES07KpQywGF20UEeSuMS', 1, 4510, 'usd', 'Dell Laptop 16 Gb Ram,255 Gb SSD', 'succeeded', '2024-06-17 10:46:39', '2024-06-17 10:46:39'),
(3, 'pi_3PSjNQ07KpQywGF21wKatLwH', 1, 4510, 'usd', 'Dell Laptop 16 Gb Ram,255 Gb SSD', 'succeeded', '2024-06-17 11:59:59', '2024-06-17 11:59:59'),
(4, 'pi_3PSjXs07KpQywGF21wFiEBH3', 3, 50, 'usd', 'nike', 'succeeded', '2024-06-17 12:10:47', '2024-06-17 12:10:47'),
(5, 'pi_3PSjat07KpQywGF20DUKbomO', 5, 100, 'usd', 'English Willow cricket bat', 'succeeded', '2024-06-17 12:13:53', '2024-06-17 12:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$pWhTq27DMaj.20eOe0bvwOEjo7BGtQMq5dRQowCu2HL/v.DzE2YBe', NULL, '2024-06-14 11:21:07', '2024-06-14 11:21:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_transactions`
--
ALTER TABLE `payment_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_transactions_page_id_foreign` (`page_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment_transactions`
--
ALTER TABLE `payment_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment_transactions`
--
ALTER TABLE `payment_transactions`
  ADD CONSTRAINT `payment_transactions_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
