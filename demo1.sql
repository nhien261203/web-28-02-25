-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 03, 2025 at 02:46 AM
-- Server version: 8.0.30
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
(1, 'https://phela.vn/wp-content/uploads/2023/12/1-Cover-Facebook-scaled.jpg', 'banner1', 'noi dung slide 1', 1, NULL, NULL),
(2, 'https://phela.vn/wp-content/uploads/2025/02/COVER-1-scaled.jpg', 'banner2', 'content banner 2', 1, NULL, NULL),
(3, 'https://phela.vn/wp-content/uploads/2021/10/COVER-SI-MO-scaled.jpg', 'banner 3', 'noi dung banner 3', 1, NULL, NULL),
(4, 'https://phela.vn/wp-content/uploads/2021/07/banner-web-.jpg', 'banner 4', 'noi dung banner 4', 1, NULL, NULL);

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
(1, 'Coffe', 1, '2025-01-01 18:52:30', '2025-03-02 19:31:50'),
(2, 'Tea', 1, '2025-01-01 18:52:38', '2025-03-02 19:31:40'),
(3, 'Khac', 0, '2025-03-02 19:31:57', '2025-03-02 19:31:57');

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

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'y', 1, 1, '2025-01-01 19:38:58', '2025-01-01 19:38:58'),
(2, 'noi dung binh luan cua toi', 1, 2, '2025-01-01 19:41:08', '2025-01-01 19:41:08'),
(3, 'coment 2', 1, 2, '2025-01-01 19:55:20', '2025-01-01 19:55:20'),
(4, 'thanks', 2, 2, '2025-01-01 20:27:42', '2025-01-01 20:27:42'),
(5, 'good', 2, 1, '2025-01-01 20:29:13', '2025-01-01 20:29:13'),
(6, 'comment ve san pham a nay', 1, 2, '2025-01-02 00:58:57', '2025-01-02 00:58:57'),
(7, 'comment new', 1, 2, '2025-01-02 01:06:45', '2025-01-02 01:06:45'),
(8, 'jj', 1, 2, '2025-01-02 02:20:32', '2025-01-02 02:20:32'),
(9, 'oke', 1, 2, '2025-01-03 02:13:59', '2025-01-03 02:13:59');

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
(15, 1, 1, '2025-01-02 23:47:08', '2025-01-02 23:47:08'),
(17, 1, 4, '2025-03-02 19:43:03', '2025-03-02 19:43:03'),
(18, 3, 3, '2025-03-02 19:43:26', '2025-03-02 19:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `points` int NOT NULL DEFAULT '0',
  `discount_rate` decimal(5,2) NOT NULL DEFAULT '0.00',
  `membership_level` enum('Basic','Silver','Gold') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Basic',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`id`, `user_id`, `points`, `discount_rate`, `membership_level`, `created_at`, `updated_at`) VALUES
(1, 4, 6, '0.00', 'Basic', '2025-03-02 19:42:28', '2025-03-02 19:42:28');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_12_25_085152_create_categories_table', 1),
(6, '2024_12_25_085229_create_products_table', 1),
(7, '2024_12_25_085321_create_comments_table', 1),
(8, '2024_12_30_025707_create_orders_table', 1),
(9, '2025_01_02_082516_create_favorites_table', 2),
(10, '2025_02_17_021810_create_banners_table', 3),
(11, '2025_02_18_025204_create_customers_table', 3),
(12, '2025_02_25_075132_create_contacts_table', 3),
(13, '2025_02_25_082345_add_role_to_users_table', 3),
(14, '2025_02_28_074057_create_memberships_table', 3);

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
(1, 1, 'da xac nhan', '100.00', '2025-01-01 18:54:21', '2025-01-01 18:54:21'),
(2, 2, 'pending', '22.00', '2025-01-01 21:08:52', '2025-01-01 21:08:52'),
(3, 1, 'pending', '40.00', '2025-01-03 02:05:59', '2025-01-03 02:05:59'),
(4, 1, 'da xac nhan', '40.00', '2025-01-03 02:06:18', '2025-01-03 02:06:18'),
(5, 4, 'Chờ xác nhận', '60.00', '2025-03-02 19:42:28', '2025-03-02 19:42:28');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `quantity`, `name`, `image`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4, 'ca phe den', 'images/products/lXWKOFdOBibcdlZZ4CPnhF91wbQJYoZ6YVFXoSVJ.jpg', '25.00', NULL, NULL),
(2, 2, 2, 1, 'tea1', 'images/products/KKz5zoLdpXrbIvGX6K28ZzujGSIy7W3fu7z4dBX2.png', '22.00', NULL, NULL),
(3, 3, 3, 1, 'bac xiu', 'images/products/BX3zLydRnDquNLD9YqKct6tgx9VLDz5dGx8GYTLJ.jpg', '40.00', NULL, NULL),
(4, 4, 3, 1, 'bac xiu', 'images/products/BX3zLydRnDquNLD9YqKct6tgx9VLDz5dGx8GYTLJ.jpg', '40.00', NULL, NULL),
(5, 5, 2, 1, 'Ô long p', 'images/products/S2uA1Sra323cgNNahoN5I7OHZSZYvfb5zvhrSkC3.jpg', '60.00', '2025-03-02 19:42:28', '2025-03-02 19:42:28');

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
(1, 'Bạc xỉu', 'images/products/8SH5GC4oWOJDUGfozNiFuQUEb6j1bJ6IaHKbz61F.jpg', 45.00, 'Phê Truffle được sáng tạo từ Cà Phê Đậm Mượt và Kem Nấm Truffle Đen thơm ngậy, hương vị bùng nổ đầy phóng khoáng.', 1, 1, '2025-01-01 18:53:07', '2025-03-02 19:37:33'),
(2, 'Ô long p', 'images/products/S2uA1Sra323cgNNahoN5I7OHZSZYvfb5zvhrSkC3.jpg', 60.00, '(Sản phẩm không đường) Chai 500ml. Plus - Cold Brew Trà Ô Long ủ lạnh, hậu vị ngọt và thanh mát.\r\nHSD 5 ngày từ NSX.\r\nBảo quản 2-5 độ C.\r\nLắc đều trước khi dùng.\r\nSử dụng trong vòng 24h sau khi mở nắp.', 2, 1, '2025-01-01 19:00:04', '2025-03-02 19:38:21'),
(3, 'Cà phê đen', 'images/products/gjDk5iX53IZGIEkfAunM3rNbLKr9M54ZpSNU6o5l.jpg', 40.00, 'Phê Truffle được sáng tạo từ Cà Phê Đậm Mượt và Kem Nấm Truffle Đen thơm ngậy, hương vị bùng nổ đầy phóng khoáng.', 1, 1, '2025-01-02 03:08:57', '2025-03-02 19:36:54'),
(4, 'Matcha coco', 'images/products/H7qstYjkVQZx3IEwVFoU7LIN7vbyGU0hj4gHToMR.jpg', 80.00, '(Sản phẩm không đường) Chai 500ml. Plus - Cold Brew Trà Ô Long ủ lạnh, hậu vị ngọt và thanh mát.\r\nHSD 5 ngày từ NSX.\r\nBảo quản 2-5 độ C.\r\nLắc đều trước khi dùng.\r\nSử dụng trong vòng 24h sau khi mở nắp.', 3, 1, '2025-03-02 19:38:44', '2025-03-02 19:38:44'),
(5, 'Cold brew', 'images/products/UqR6nH5q3yLYaZI39yUDgT7zvbgonrKdLR4MdUlf.jpg', 25.00, '(100% đường) Lon 500ml. Ô Long Nhài Sữa là sự kết hợp Trà Ô Long đậm đà cùng hương nhài thơm tinh tế, thêm chút thơm ngậy từ sữa.\r\nHSD 3 ngày từ NSX.\r\nBảo quản 2-5 độ C.\r\nLắc đều trước khi dùng.\r\nSử dụng trong vòng 24h sau khi mở nắp.', 1, 1, '2025-03-02 19:41:52', '2025-03-02 19:41:52');

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
(1, 'nhien', 'nhien@gmail.com', NULL, '$2y$12$orJyyRfuP5nrAPreTUkJuOFSM/MH7b89wb/0gIbK.HKJNjkcQ1mfC', NULL, '2025-01-01 18:52:06', '2025-01-01 18:52:06', NULL, 'user'),
(2, 'nhien2', 'nhien2@gmail.com', NULL, '$2y$12$0GZAYJQWnQPh7IPMiHEW..Ezkl4kI2kHflHPo3PpJVGbPxZr4k2aC', NULL, '2025-01-01 18:56:15', '2025-01-01 18:56:15', NULL, 'user'),
(3, 'user1', '21012082@st.phenikaa-uni.edu.vn', '2025-03-02 19:17:31', '$2y$12$WF5BWISXVLdaUJA1oEnWeuedyiW0tzZEosSL0htT3e.dNwOu78lFC', NULL, '2025-03-02 19:17:13', '2025-03-02 19:17:31', NULL, 'user'),
(4, 'admin1', 'dovannhien12345@gmail.com', '2025-03-02 19:18:42', '$2y$12$CTEbOsVCthqfIglzzhFWeun9H1pUAPdBA5J.vSoAtozW5WeSuTBRa', NULL, '2025-03-02 19:18:33', '2025-03-02 19:18:42', NULL, 'admin');

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
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberships_user_id_foreign` (`user_id`);

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
  ADD KEY `order_product_product_id_foreign` (`product_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Constraints for table `memberships`
--
ALTER TABLE `memberships`
  ADD CONSTRAINT `memberships_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
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
-- tk user 2101.. mk:user1
-- tk admin dovan.. mk:admin1
