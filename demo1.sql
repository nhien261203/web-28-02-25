-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 26, 2025 at 04:00 AM
-- Server version: 8.2.0
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-shop3`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image`, `title`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'https://phela.vn/wp-content/uploads/2025/01/LICH-HOAT-DONG-TET-2025_Cover-FB-scaled.jpg', 'lịch hoạt động tết', 'home-1', 1, NULL, NULL),
(2, 'https://phela.vn/wp-content/uploads/2023/05/COVER-FACEBOOK-scaled.jpg', 'lụa đào', 'home-2', 1, NULL, NULL),
(3, 'https://phela.vn/wp-content/uploads/2021/10/COVER-SI-MO-scaled.jpg', 'si mơ', 'home-3', 1, NULL, NULL),
(4, 'https://phela.vn/wp-content/uploads/2021/07/banner-web-.jpg', 'nốt hương đặc sản', 'home-4', 1, NULL, NULL),
(5, 'https://phela.vn/wp-content/uploads/2025/02/COVER-1-scaled.jpg', 'no content', 'home-5', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'coffe', 1, '2024-12-26 03:42:15', '2024-12-26 03:42:15'),
(2, 'Trà', 1, '2024-12-26 03:42:42', '2025-02-17 23:41:00'),
(10, 'Khác', 1, '2025-02-18 00:01:36', '2025-02-18 00:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 'nhien', 'dovannhien12345@gmail.com', 'content', '2025-02-25 00:59:20', '2025-02-25 00:59:20'),
(2, 'user1', 'dovannhien12345@gmail.com', 'good', '2025-02-25 01:08:02', '2025-02-25 01:08:02'),
(3, 'nhien', 'dovannhien12345@gmail.com', 'thing so', '2025-02-25 20:47:50', '2025-02-25 20:47:50');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint NOT NULL DEFAULT '0',
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(12, 11, 1, '2025-02-21 01:19:06', '2025-02-21 01:19:06'),
(13, 9, 1, '2025-02-24 19:34:35', '2025-02-24 19:34:35'),
(14, 9, 4, '2025-02-25 02:32:24', '2025-02-25 02:32:24'),
(15, 3, 16, '2025-02-25 20:51:19', '2025-02-25 20:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2024_12_25_080811_create_categories_table', 1),
(11, '2014_10_12_000000_create_users_table', 2),
(12, '2014_10_12_100000_create_password_reset_tokens_table', 2),
(13, '2019_08_19_000000_create_failed_jobs_table', 2),
(14, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(15, '2024_12_25_085152_create_categories_table', 2),
(16, '2024_12_25_085229_create_products_table', 2),
(17, '2024_12_25_085321_create_comments_table', 2),
(18, '2024_12_30_025707_create_orders_table', 3),
(19, '2024_12_30_034943_add_name_and_image_to_order_product_table', 4),
(20, '2024_12_30_040353_add_category_name_to_order_product_table', 5),
(21, '2025_01_02_082516_create_favorites_table', 6),
(22, '2025_02_17_021810_create_banners_table', 7),
(23, '2025_02_18_025204_create_customers_table', 8),
(24, '2025_02_25_075132_create_contacts_table', 9),
(25, '2025_02_25_082345_add_role_to_users_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `total_amount`, `created_at`, `updated_at`) VALUES
(88, 1, 'pending', '68.00', '2025-02-20 23:44:11', '2025-02-20 23:44:11'),
(89, 1, 'confirmed', '50.00', '2025-02-20 23:44:19', '2025-02-20 23:44:19'),
(90, 1, 'confirmed', '100.00', '2025-02-20 23:47:11', '2025-02-20 23:47:11'),
(91, 1, 'confirmed', '68.00', '2025-02-21 00:19:28', '2025-02-21 00:19:28'),
(92, 1, 'confirmed', '118.00', '2025-02-21 00:57:44', '2025-02-21 00:57:44'),
(95, 1, 'confirmed', '50.00', '2025-02-21 01:05:53', '2025-02-21 01:05:53'),
(96, 1, 'confirmed', '80.00', '2025-02-21 01:07:30', '2025-02-21 01:07:30'),
(101, 4, 'confirmed', '50.00', '2025-02-25 01:56:56', '2025-02-25 01:56:56'),
(102, 16, 'pending', '50.00', '2025-02-25 20:31:04', '2025-02-25 20:31:04'),
(106, 16, 'pending', '40.00', '2025-02-25 20:39:32', '2025-02-25 20:39:32'),
(107, 16, 'pending', '50.00', '2025-02-25 20:41:07', '2025-02-25 20:41:07'),
(108, 16, 'pending', '68.00', '2025-02-25 20:41:31', '2025-02-25 20:41:31');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`, `name`, `image`, `category_id`, `category_name`) VALUES
(48, 88, 10, 1, '68.00', '2025-02-20 23:44:11', '2025-02-20 23:44:11', 'Trà vỏ cà phê', 'images/products/SVL08bWW4cWyEZXD6my7sUSzXI7Pq39LSFcIePXo.jpg', NULL, NULL),
(49, 89, 11, 1, '50.00', '2025-02-20 23:44:19', '2025-02-20 23:44:19', 'Matcha coco', NULL, NULL, NULL),
(50, 90, 11, 1, '50.00', '2025-02-20 23:47:11', '2025-02-20 23:47:11', 'Matcha coco', NULL, NULL, NULL),
(51, 90, 3, 1, '50.00', '2025-02-20 23:47:11', '2025-02-20 23:47:11', 'Ô long nhài sữa', NULL, NULL, NULL),
(52, 91, 10, 1, '68.00', '2025-02-21 00:19:28', '2025-02-21 00:19:28', 'Trà vỏ cà phê', NULL, NULL, NULL),
(53, 92, 10, 1, '68.00', '2025-02-21 00:57:44', '2025-02-21 00:57:44', 'Trà vỏ cà phê', NULL, NULL, NULL),
(54, 92, 11, 1, '50.00', '2025-02-21 00:57:44', '2025-02-21 00:57:44', 'Matcha coco', NULL, NULL, NULL),
(55, 95, 3, 1, '50.00', '2025-02-21 01:05:53', '2025-02-21 01:05:53', 'Ô long nhài sữa', NULL, NULL, NULL),
(56, 96, 9, 1, '80.00', '2025-02-21 01:07:30', '2025-02-21 01:07:30', 'Trà lụa đào', NULL, NULL, NULL),
(61, 101, 1, 1, '50.00', '2025-02-25 01:56:56', '2025-02-25 01:56:56', 'Cà phê nâu', NULL, NULL, NULL),
(62, 102, 1, 1, '50.00', '2025-02-25 20:31:04', '2025-02-25 20:31:04', 'Cà phê nâu', 'images/products/DU6icK7k2fCj1qk7j5pfOJb7opHJgZ4bcldjrry0.jpg', NULL, NULL),
(63, 106, 2, 1, '40.00', '2025-02-25 20:39:32', '2025-02-25 20:39:32', 'Cà phê đen', 'images/products/HOxhqKlJJvvAdTdO370lZnifJNzCTzFehxbZwxog.jpg', NULL, NULL),
(64, 107, 3, 1, '50.00', '2025-02-25 20:41:07', '2025-02-25 20:41:07', 'Ô long nhài sữa', 'images/products/RQKkVQo1drL6glPV80Zgc8LtT7SZ5kDLkS9kBplf.jpg', NULL, NULL),
(65, 108, 10, 1, '68.00', '2025-02-25 20:41:31', '2025-02-25 20:41:31', 'Trà vỏ cà phê', 'images/products/SVL08bWW4cWyEZXD6my7sUSzXI7Pq39LSFcIePXo.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(10,2) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `content`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cà phê nâu', 'images/products/DU6icK7k2fCj1qk7j5pfOJb7opHJgZ4bcldjrry0.jpg', 50.00, 'Phê Nâu có vị chua nhẹ tự nhiên của hạt Arabica Cầu Đất kết hợp cùng Robusta Gia Lai được tuyển chọn kỹ lưỡng, hoà quyện cùng sữa đặc đem đến hương vị đậm mượt và gần gũi.', 1, 0, '2024-12-26 07:28:41', '2025-02-17 23:52:49'),
(2, 'Cà phê đen', 'images/products/HOxhqKlJJvvAdTdO370lZnifJNzCTzFehxbZwxog.jpg', 40.00, 'Cà Phê Đặc Sản với nốt hương: Peach - Orange - Juicy Body - Sweet Aftertaste With Chocolate. Sản phẩm có thể dùng nóng/đá.', 1, 0, '2024-12-26 08:24:39', '2025-02-17 23:50:02'),
(3, 'Ô long nhài sữa', 'images/products/RQKkVQo1drL6glPV80Zgc8LtT7SZ5kDLkS9kBplf.jpg', 50.00, 'Ô Long Nhài Sữa là sự kết hợp hoàn hảo giừa Trà Ô Long Đặc Sản đậm đà cùng hương nhài thơm tinh tế, thêm chút thơm ngậy từ sữa.', 2, 0, '2024-12-26 01:53:37', '2025-02-17 23:48:52'),
(9, 'Trà lụa đào', 'images/products/en26415ek9pgoxO44TGNmIYKiTvGxv1adGZAWT8r.jpg', 80.00, 'Trà Ô Long Lụa Đào thơm hoa ngọt ngào, kết hợp cùng Sữa Tươi Thanh Trùng Phê La & Đào Hồng dầm, thêm Thạch Trà Lụa Đào mềm dai mang đến trải nghiệm tươi mát & nhẹ nhàng.', 2, 1, '2025-02-17 23:56:46', '2025-02-17 23:56:46'),
(10, 'Trà vỏ cà phê', 'images/products/SVL08bWW4cWyEZXD6my7sUSzXI7Pq39LSFcIePXo.jpg', 68.00, 'Trà Vỏ Cà Phê - thức uống độc đáo được làm từ vỏ quả cà phê, hương trà thơm nhẹ hòa quyện cùng vị chua dịu của chanh vàng', 2, 1, '2025-02-17 23:58:52', '2025-02-17 23:58:52'),
(11, 'Matcha coco', 'images/products/0ukfTqZw2wTM7YVQ64o6WgaI5CbKRtOfjpBg4gCW.jpg', 50.00, 'Matcha Coco Latte với Lớp kem Ô Long Matcha bồng bềnh sánh mịn hoà quyện cùng sữa dừa Bến Tre hữu cơ ngọt thơm.', 10, 1, '2025-02-18 00:02:14', '2025-02-18 00:02:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` int DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `google_id`, `role`) VALUES
(1, 'nhien', 'nhien@gmail.com', NULL, '$2y$12$FWRfyG6B0BCwEPkCZgtiZu6FUETSRho1hieTSits8F7HENBfgUjNa', NULL, '2024-12-25 19:34:25', '2024-12-25 19:34:25', NULL, 'admin'),
(2, 'nhien1', 'nhien1@gmail.com', NULL, '$2y$12$d4uN1oMjZ0H0kV1WYUZlvecZ8gRG2zeL5H9TavwFglVTeZ6PIUwca', NULL, '2024-12-31 01:11:00', '2024-12-31 01:11:00', NULL, 'admin'),
(4, 'user2', 'user2@gmail.com', NULL, '$2y$12$xeGQZbY.kPn1PVC9TEOumeVwim1qcwP21HE9Jrul8BAzDSd/NmK7C', NULL, '2025-02-25 01:15:51', '2025-02-25 01:15:51', NULL, 'user'),
(5, 'admin1', 'admin1@gmail.com', NULL, '$2y$12$ax8nDXdN9kEmph/YyE4IaOJUE5LSW5P/jNEOlusM.OO7Ml9eCact6', NULL, '2025-02-25 01:43:08', '2025-02-25 01:43:08', NULL, 'admin'),
(6, 'tesst', 'test@gmail.com', NULL, '$2y$12$.oDceo/mx4rTHKjzl1rf6eiGe6nsqlNFL7506PEoj1CwRhVjw4obS', NULL, '2025-02-25 01:49:30', '2025-02-25 01:49:30', NULL, 'user'),
(7, 'tesst1', 'test1@gmail.com', NULL, '$2y$12$PUkc/17.lkNxF3D2oTSCWOSuQ0ymFG6sSVX9LX6KQZS15ndZUKQFa', NULL, '2025-02-25 01:53:42', '2025-02-25 01:53:42', NULL, 'admin'),
(14, 'nhien', '21012082@st.phenikaa-uni.edu.vn', '2025-02-25 20:16:36', '$2y$12$XT4s5IGgWMyx12bXRm/4EuXocBjMEZtmNSEx4PwRjuzG3m0ufv0DO', NULL, '2025-02-25 20:16:19', '2025-02-25 20:16:36', NULL, 'user'),
(16, 'nhien', 'dovannhien12345@gmail.com', '2025-02-25 20:22:51', '$2y$12$rFkPAkHwwizuLMmpc.GTJeFEcTtq7F2ocJbhCnz59R4.zwryq5JM2', NULL, '2025-02-25 20:22:26', '2025-02-25 20:49:51', NULL, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_product_id_foreign` (`product_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD UNIQUE KEY `customers_phone_unique` (`phone`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `favorites_product_id_user_id_unique` (`product_id`,`user_id`),
  ADD KEY `favorites_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_product_order_id_foreign` (`order_id`),
  ADD KEY `order_product_product_id_foreign` (`product_id`),
  ADD KEY `order_product_category_id_foreign` (`category_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`),
  ADD KEY `products_category_id_foreign` (`category_id`);

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
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_product_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
