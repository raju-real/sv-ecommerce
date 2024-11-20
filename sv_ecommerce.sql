-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 08:57 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sv_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_plain` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=>Active,2=>In active',
  `last_login_at` datetime DEFAULT NULL,
  `last_logout_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `mobile`, `password_plain`, `password`, `remember_token`, `image`, `status`, `last_login_at`, `last_logout_at`, `created_at`, `updated_at`, `created_by`, `deleted_at`) VALUES
(1, 'Mr. Admin', 'admin@admin.com', '12345679810', '123456', '$2y$10$bxs3vjQn24MXLvjN.SFX/e1l7GCcMS2.4oZ55XAeTWXoO4nkaO62K', 'vzxM2ONkxxTJZTOLkAxek47Ni9Ci39QtMJVYzQIEPMnO7Uk0HrvuTURymScd', NULL, 1, '2024-11-20 17:15:05', NULL, '2024-05-06 08:59:44', '2024-11-20 11:15:05', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'active,in-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `logo`, `status`, `created_at`, `updated_at`, `created_by`, `deleted_at`) VALUES
(1, 'LEMFO', 'lemfo', 'assets/files/images/brand/1732131628-brand-3.png', 'active', '2024-11-20 13:40:28', '2024-11-20 13:40:28', 1, NULL),
(2, 'ROMOSS', 'romoss', 'assets/files/images/brand/1732131886-brand-2.png', 'active', '2024-11-20 13:44:46', '2024-11-20 13:44:46', 1, NULL),
(3, 'AMERICAN EXPRESS', 'american-express', 'assets/files/images/brand/1732131907-a-express.png', 'active', '2024-11-20 13:45:07', '2024-11-20 13:45:07', 1, NULL),
(4, 'COLORFUL', 'colorful', 'assets/files/images/brand/1732131930-brand-1.png', 'active', '2024-11-20 13:45:30', '2024-11-20 13:47:27', 1, NULL),
(5, 'ELEAF', 'eleaf', 'assets/files/images/brand/1732131955-brand-6.png', 'active', '2024-11-20 13:45:56', '2024-11-20 13:45:56', 1, NULL),
(6, 'SKILL STAR', 'skill-star', 'assets/files/images/brand/1732131975-brand1.png', 'active', '2024-11-20 13:46:15', '2024-11-20 13:46:15', 1, NULL),
(7, 'VENNOIS', 'vennois', 'assets/files/images/brand/1732131995-brand-7.png', 'active', '2024-11-20 13:46:35', '2024-11-20 13:46:35', 1, NULL),
(8, 'SIMWOOD', 'simwood', 'assets/files/images/brand/1732132014-brand-11.png', 'active', '2024-11-20 13:46:54', '2024-11-20 13:46:54', 1, NULL),
(9, 'ENMEX', 'enmex', 'assets/files/images/brand/1732132034-brand-14.png', 'active', '2024-11-20 13:47:14', '2024-11-20 13:47:14', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'active,in-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `status`, `created_at`, `updated_at`, `created_by`, `deleted_at`) VALUES
(7, 'Shoes', 'shoes', 'assets/files/images/category/1732123382-running-shoe.png', 'active', '2024-11-20 11:23:03', '2024-11-20 11:23:03', 1, NULL),
(8, 'Men', 'men', 'assets/files/images/category/1732123551-men.png', 'active', '2024-11-20 11:25:51', '2024-11-20 11:25:51', 1, NULL),
(9, 'Women', 'women', 'assets/files/images/category/1732123696-women.png', 'active', '2024-11-20 11:28:16', '2024-11-20 11:28:16', 1, NULL),
(10, 'Electronics', 'electronics', 'assets/files/images/category/1732123801-electronics.png', 'active', '2024-11-20 11:29:49', '2024-11-20 11:30:01', 1, NULL),
(11, 'Headphones', 'headphones', 'assets/files/images/category/1732123857-headphone.png', 'active', '2024-11-20 11:30:57', '2024-11-20 11:31:07', 1, NULL),
(12, 'Watches', 'watches', 'assets/files/images/category/1732123910-smartwatch.png', 'active', '2024-11-20 11:31:50', '2024-11-20 11:31:50', 1, NULL),
(13, 'Computer', 'computer', 'assets/files/images/category/1732123946-desktop.png', 'active', '2024-11-20 11:32:27', '2024-11-20 11:32:27', 1, NULL),
(14, 'Mobile', 'mobile', 'assets/files/images/category/1732123996-smartphone.png', 'active', '2024-11-20 11:33:16', '2024-11-20 12:43:21', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `slug`, `created_at`, `updated_at`, `created_by`, `deleted_at`) VALUES
(1, 'RED', 'red', '2024-05-06 12:07:08', '2024-05-06 12:07:08', 1, NULL),
(2, 'GREEN', 'green', '2024-05-06 12:07:20', '2024-05-06 12:07:20', 1, NULL),
(3, 'ORANGE', 'orange', '2024-05-06 12:07:48', '2024-05-06 12:07:48', 1, NULL),
(4, 'GREENS', 'greens', '2024-05-09 09:31:46', '2024-05-09 09:31:46', 1, NULL),
(5, 'REDs', 'reds', '2024-05-09 10:16:57', '2024-05-09 10:16:57', 1, NULL),
(6, 'White', 'white', '2024-05-14 10:52:03', '2024-05-14 10:52:03', 1, NULL),
(7, 'Grey', 'grey', '2024-05-14 10:52:09', '2024-05-14 10:52:09', 1, NULL),
(8, 'Silver', 'silver', '2024-05-14 10:52:15', '2024-05-14 10:52:15', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_03_161830_create_admins_table', 1),
(6, '2024_05_03_173255_create_categories_table', 1),
(7, '2024_05_06_162033_create_sub_categories_table', 2),
(8, '2024_05_06_174341_create_sizes_table', 3),
(9, '2024_05_06_174456_create_colors_table', 3),
(10, '2024_05_06_174503_create_units_table', 3),
(11, '2024_05_06_175226_create_sub_subcategories_table', 3),
(12, '2024_05_07_134442_create_brands_table', 4),
(14, '2024_05_08_144644_create_product_images_table', 5),
(17, '2024_05_10_061326_create_tags_table', 7),
(20, '2024_05_08_140756_create_products_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `sub_subcategory_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` double(8,2) DEFAULT NULL,
  `discount_price` double(8,2) NOT NULL DEFAULT 0.00,
  `sku` int(11) NOT NULL DEFAULT 0,
  `alert_quantity` int(11) NOT NULL DEFAULT 0,
  `video_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `thumbnail_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_sizes` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_colors` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_tags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_exchangeable` tinyint(1) NOT NULL DEFAULT 0,
  `is_refundable` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'active,in-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `sub_subcategory_id`, `brand_id`, `product_code`, `name`, `slug`, `product_details`, `short_description`, `special_note`, `warranty`, `unit_price`, `discount_price`, `sku`, `alert_quantity`, `video_link`, `view_count`, `thumbnail_path`, `product_unit`, `product_sizes`, `product_colors`, `product_tags`, `is_exchangeable`, `is_refundable`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(1, 6, 4, 1, 10, 'ES-718X', 'Sharp Full Auto Washing Machine ES-718X | 7.0 KG White Colour', 'es-718x-sharp-full-auto-washing-machine-es-718x-70-kg-white-colour', '<p><strong>SHARP</strong>&nbsp;Full Auto Washing Machine ES718X is available at&nbsp;Esquire Electronics Ltd.&nbsp;&ndash; the Authorized Distributor of all the&nbsp;<strong>SHARP</strong>&nbsp;appliances in Bangladesh. Get the original&nbsp;<strong>SHARP</strong>&nbsp;washing machines&nbsp;at the most affordable price at&nbsp;Esquire Electronics&nbsp;and enjoy authentic Japanese quality with the promise of the best customer service in Bangladesh.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>SHARP ES-X858 FULL AUTO WASHING MACHINE COMES WITH THE FOLLOWING FEATURES -</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Soak Wash</p>\r\n	</li>\r\n	<li>\r\n	<p>Fuzzy Control</p>\r\n	</li>\r\n	<li>\r\n	<p>Quick Wash</p>\r\n	</li>\r\n	<li>\r\n	<p>Auto Start After Blackout</p>\r\n	</li>\r\n	<li>\r\n	<p>Washboard Texture Stainless Steel Tub</p>\r\n	</li>\r\n	<li>\r\n	<p>Water Efficiency&nbsp;Rating 3 Ticks</p>\r\n	</li>\r\n	<li>\r\n	<p>Shop now from our website and receive delivery free of cost across Bangladesh. Enjoy the most affordable price with industry-leading customer service.&nbsp;</p>\r\n	</li>\r\n</ul>', 'Capacity: 7.0 KG\r\nFuzzy Control\r\nAuto Start After Blackout\r\nWashboard Texture Stainless Steel Tub\r\nWater Efficiency Rating 3 Ticks', 'Free Delivery in district Shadar (T&C Apply)', 'Electrical Spare Parts: 1 Year\r\n\r\nMain Motor: 10 Years\r\n\r\nFree Service: 1 Year', 35000.00, 28000.00, 100, 10, 'https://esquireelectronicsltd.com/sharp/washing-machine/sharp-full-auto-washing-machine-es-718x-7-0-kg-white-colour', 0, 'assets/files/images/products/1715706005-asfafafsfsf-(1)4523-6749.png', '3', '7KG', 'White,Grey,Silver', 'Full Auto Washing Machine,Washing Machine,Top loaded washing machine,sharp washing machine price in bangladesh', 0, 0, 'active', '2024-05-14 11:00:05', '2024-05-14 11:00:05', 1, 1, NULL),
(2, 6, 4, 1, 7, 'ES-718Xa', 'Men\'s Fashion', 'es-718xa-mens-fashion', '<p>Product Details</p>', 'Short Description', 'Special Note', 'Warranty', 35000.00, 28000.00, 50, 20, NULL, 0, 'assets/files/images/products/1715872651-sharp-7kg-718x-74018-4261.jpg', '1', '7KG,MD,SM', 'GREEN,Grey', 'bag,Full Auto Washing Machine', 0, 0, 'active', '2024-05-16 09:17:31', '2024-05-16 09:17:31', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'assets/files/images/products/1715698848-full shave shirt.png', '2024-05-14 09:00:48', '2024-05-14 09:00:48'),
(2, 1, 'assets/files/images/products/1715698848-shirt.png', '2024-05-14 09:00:48', '2024-05-14 09:00:48'),
(3, 1, 'assets/files/images/products/1715706005-sharp-7kg-718x-44071-4260.jpg', '2024-05-14 11:00:05', '2024-05-14 11:00:05'),
(4, 1, 'assets/files/images/products/1715706005-sharp-7kg-718x-54405-4261.jpg', '2024-05-14 11:00:06', '2024-05-14 11:00:06'),
(5, 1, 'assets/files/images/products/1715706006-sharp-7kg-718x-74018-4261.jpg', '2024-05-14 11:00:06', '2024-05-14 11:00:06'),
(6, 2, 'assets/files/images/products/1715872651-sharp-7kg-718x-54405-4261.jpg', '2024-05-16 09:17:31', '2024-05-16 09:17:31'),
(7, 2, 'assets/files/images/products/1715872651-asfafafsfsf-(1)4523-6749.png', '2024-05-16 09:17:32', '2024-05-16 09:17:32');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `slug`, `created_at`, `updated_at`, `created_by`, `deleted_at`) VALUES
(1, 'SM', 'sm', '2024-05-06 11:59:31', '2024-05-06 11:59:31', 1, NULL),
(2, 'MD', 'md', '2024-05-06 11:59:44', '2024-05-06 11:59:44', 1, NULL),
(3, 'LG', 'lg', '2024-05-06 12:00:00', '2024-05-06 12:00:00', 1, NULL),
(13, '7KG', '7kg', '2024-05-14 10:51:53', '2024-05-14 10:51:53', 1, NULL),
(14, '5', '5', '2024-08-31 08:22:10', '2024-08-31 08:22:10', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'active,in-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `slug`, `icon`, `status`, `created_at`, `updated_at`, `created_by`, `deleted_at`) VALUES
(5, 8, 'Outerwear & Jackets', 'outerwear-jackets', 'assets/files/images/sub_category/1732127586-protective-clothing.png', 'active', '2024-11-20 12:33:06', '2024-11-20 12:33:06', 1, NULL),
(6, 8, 'Accessories', 'accessories', 'assets/files/images/sub_category/1732127801-accessories.png', 'active', '2024-11-20 12:36:41', '2024-11-20 12:36:41', 1, NULL),
(7, 13, 'Macbook', 'macbook', 'assets/files/images/sub_category/1732127900-laptop.png', 'active', '2024-11-20 12:38:20', '2024-11-20 12:38:20', 1, NULL),
(8, 13, 'Dasktop', 'dasktop', 'assets/files/images/sub_category/1732127966-pc.png', 'active', '2024-11-20 12:39:26', '2024-11-20 12:39:26', 1, NULL),
(9, 14, 'Smart Phone', 'smart-phone', 'assets/files/images/sub_category/1732128068-iphone.png', 'active', '2024-11-20 12:41:08', '2024-11-20 12:41:08', 1, NULL),
(10, 14, 'Button Phone', 'button-phone', 'assets/files/images/sub_category/1732128086-old-phone.png', 'active', '2024-11-20 12:41:26', '2024-11-20 12:41:26', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_subcategories`
--

CREATE TABLE `sub_subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'active,in-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_subcategories`
--

INSERT INTO `sub_subcategories` (`id`, `category_id`, `subcategory_id`, `name`, `slug`, `icon`, `status`, `created_at`, `updated_at`, `created_by`, `deleted_at`) VALUES
(1, 8, 5, 'Jacket', 'jacket', 'assets/files/images/sub_category/1732129060-fashion.png', 'active', '2024-11-20 12:57:40', '2024-11-20 13:33:06', 1, NULL),
(2, 8, 5, 'Sweaters', 'sweaters', 'assets/files/images/sub_category/1732129124-fashion (1).png', 'active', '2024-11-20 12:58:44', '2024-11-20 12:58:44', 1, NULL),
(3, 8, 5, 'Jeans', 'jeans', 'assets/files/images/sub_category/1732129183-jeans.png', 'active', '2024-11-20 12:59:43', '2024-11-20 12:59:43', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`, `created_by`, `deleted_at`) VALUES
(1, 'Mobile', 'mobile', '2024-05-10 00:17:23', '2024-05-10 00:17:23', 1, NULL),
(2, 'headphone', 'headphone', '2024-05-10 00:17:44', '2024-05-10 00:17:44', 1, NULL),
(3, 'bag', 'bag', '2024-05-10 00:22:06', '2024-05-10 00:22:06', 1, NULL),
(4, 'Full Auto Washing Machine', 'full-auto-washing-machine', '2024-05-14 10:52:37', '2024-05-14 10:52:37', 1, NULL),
(5, 'Washing Machine', 'washing-machine', '2024-05-14 10:53:51', '2024-05-14 10:53:51', 1, NULL),
(6, 'Top loaded washing machine', 'top-loaded-washing-machine', '2024-05-14 10:54:01', '2024-05-14 10:54:01', 1, NULL),
(7, 'sharp washing machine price in bangladesh', 'sharp-washing-machine-price-in-bangladesh', '2024-05-14 10:57:38', '2024-05-14 10:57:38', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `slug`, `created_at`, `updated_at`, `created_by`, `deleted_at`) VALUES
(1, 'KG', 'kg', '2024-05-06 12:11:09', '2024-05-06 12:11:09', 1, NULL),
(2, 'PACKET', 'packet', '2024-05-06 12:11:18', '2024-05-06 12:11:18', 1, NULL),
(3, 'PIECE', 'piece', '2024-05-06 12:11:27', '2024-05-06 12:11:27', 1, NULL),
(4, 'd', 'd', '2024-05-09 10:12:25', '2024-05-09 10:12:25', 1, NULL),
(5, 's', 's', '2024-05-09 10:16:42', '2024-05-09 10:16:42', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=>Active,2=>In active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_mobile_unique` (`mobile`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_product_code_unique` (`product_code`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_subcategories`
--
ALTER TABLE `sub_subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sub_subcategories`
--
ALTER TABLE `sub_subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
