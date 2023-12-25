-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 25, 2023 at 02:27 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tamweeny`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

DROP TABLE IF EXISTS `cards`;
CREATE TABLE IF NOT EXISTS `cards` (
  `id` int NOT NULL AUTO_INCREMENT,
  `CardName` varchar(150) NOT NULL,
  `CardNumber` int NOT NULL,
  `CardNationalId` bigint NOT NULL,
  `CardPassword` varchar(191) NOT NULL,
  `Individuals Number` int NOT NULL,
  `BreadPoints` int NOT NULL,
  `TamweenPoints` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `CardName`, `CardNumber`, `CardNationalId`, `CardPassword`, `Individuals Number`, `BreadPoints`, `TamweenPoints`, `created_at`, `updated_at`) VALUES
(4, 'card1', 1234, 12345, '$2y$12$b2lFTd6dGgmWzmZ.pBG88ubYPWQLWIaLdFrzI8OjLG/R2oEt8UJpi', 1, 1, 1, '2023-12-24 12:33:20', '2023-12-24 12:33:20'),
(5, 'card1', 1234556, 1234544, '$2y$12$.BE1bQZzvhYO/VzC/Q0/GufqliIuJ.1SPRZMYDwWB/kc2SROX3aCS', 1, 1, 1, '2023-12-25 04:17:20', '2023-12-25 04:17:20'),
(6, 'card1', 12345565, 12345447, '$2y$12$vzxGVVn29pfs.IUcN8HDyeSXjS00D/yf64U0k34rfCHHAafww0vXm', 1, 1, 1, '2023-12-25 04:55:26', '2023-12-25 04:55:26'),
(7, 'fawzi', 789, 213156486498, '$2y$12$Kuoi9yAqIr29eBmeEzVtXuEayM9r4n9aVbwIJZ9QxDruBvc31PnMm', 1, 1, 1, '2023-12-25 04:59:00', '2023-12-25 04:59:00'),
(8, 'fawziss', 7894, 2131564864984, '$2y$12$nbXDxwF.r30tCEDCV15QvOA0na0Jx782hrzDVmTdpDK4ygOQjOtRS', 1, 1, 1, '2023-12-25 05:02:30', '2023-12-25 05:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `CatID` int NOT NULL AUTO_INCREMENT,
  `CatName` varchar(100) NOT NULL,
  PRIMARY KEY (`CatID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CatID`, `CatName`) VALUES
(0, 'nan'),
(1, 'جبن'),
(2, 'زيوت'),
(3, 'بقوليات'),
(5, 'معلبات');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerID` int NOT NULL AUTO_INCREMENT,
  `National_Id` bigint NOT NULL,
  `TamweencardId` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`CustomerID`),
  KEY `TamweencardId` (`TamweencardId`),
  KEY `National_Id` (`National_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `National_Id`, `TamweencardId`, `created_at`, `updated_at`) VALUES
(4, 12345672544, 4, '2023-12-24 12:33:20', '2023-12-24 12:33:20'),
(5, 12345672544567, 5, '2023-12-25 04:17:20', '2023-12-25 04:17:20'),
(6, 1234567254456, 6, '2023-12-25 04:55:26', '2023-12-25 04:55:26'),
(7, 1234456778, 7, '2023-12-25 04:59:00', '2023-12-25 04:59:00'),
(8, 123445677877, 8, '2023-12-25 05:02:30', '2023-12-25 05:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
CREATE TABLE IF NOT EXISTS `delivery` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `National_Id` bigint NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `licensePlate` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `National_Id` (`National_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`ID`, `National_Id`, `vehicle_type`, `licensePlate`) VALUES
(1, 30011124786131, 'Motorcycle', 'ABC123'),
(2, 30011124786132, 'Car', 'XYZ456'),
(3, 30011124786133, 'Motorcycle', 'ASD321'),
(4, 30011124786134, 'Car', 'BVD321'),
(5, 30011124786135, 'Motorcycle', 'TRW143');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int NOT NULL AUTO_INCREMENT,
  `files` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `files`) VALUES
(2, 'apiDocs/DYsPHAJw7F1pZRFq9DtwscMdJ5895z81aZQ859gM.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `governoradmin`
--

DROP TABLE IF EXISTS `governoradmin`;
CREATE TABLE IF NOT EXISTS `governoradmin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `National_Id` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `National_Id` (`National_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `governoradmin`
--

INSERT INTO `governoradmin` (`id`, `National_Id`) VALUES
(1, 30011124786136),
(2, 30011124786137),
(3, 30011124786138),
(4, 30011124786139),
(5, 30011124786140);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(27, '2019_12_14_000001_create_personal_access_tokens_table', 14),
(4, '2023_12_23_065441_create_categories_table', 1),
(5, '2023_12_23_065632_create_customers_table', 1),
(6, '2023_12_23_065709_create_deliveries_table', 1),
(7, '2023_12_23_065723_create_orders_table', 1),
(8, '2023_12_23_065729_create_orders_mades_table', 1),
(9, '2023_12_23_065738_create_products_table', 1),
(10, '2023_12_23_065745_create_stores_table', 1),
(11, '2023_12_23_065753_create_storeowners_table', 1),
(12, '2023_12_23_142843_add_timestamps_to_user_table', 1),
(13, '2023_12_23_144602_add_timestamps_to_customer_table', 2),
(14, '2023_12_23_161804_add_timestamps_to_tamwencard_table', 3),
(15, '2023_12_23_161833_add_timestamps_to_tamwencard_table', 4),
(16, '2023_12_23_161909_add_timestamps_to_tamwencards_table', 5),
(17, '2023_12_23_161911_add_timestamps_to_tamwencards_table', 5),
(18, '2023_12_23_161934_add_timestamps_to_tamwencards_table', 6),
(19, '2023_12_23_191441_create_tamween_cards_table', 7),
(20, '2023_12_23_193640_create_customers_table', 8),
(21, '2023_12_23_161934_add_timestamps_to_tamweencards_table', 9),
(22, '2023_12_23_161934_add_timestamps_to_cards_table', 10),
(23, '2023_12_23_212508_create_personal_access_tokens_table', 11),
(24, '2023_12_23_212846_personal_access_tokens', 12),
(25, '2023_12_23_213614_create_personal_access_tokens_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `OrderID` int NOT NULL AUTO_INCREMENT,
  `OrderDate` date NOT NULL,
  `OrderPrice` decimal(10,2) NOT NULL,
  `DiscountCode` int NOT NULL,
  `DeliveryStatus` varchar(50) NOT NULL,
  `Payment_Number` int NOT NULL,
  `customer_id` int NOT NULL,
  `deliveryId` int NOT NULL,
  PRIMARY KEY (`OrderID`),
  KEY `Payment_Number` (`Payment_Number`),
  KEY `deliveryId` (`deliveryId`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_made`
--

DROP TABLE IF EXISTS `orders_made`;
CREATE TABLE IF NOT EXISTS `orders_made` (
  `OrderID` int NOT NULL,
  `Product_ID` int NOT NULL,
  KEY `OrderID` (`OrderID`),
  KEY `Product_ID` (`Product_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `Payment_Number` int NOT NULL,
  `Payment_Date` date NOT NULL,
  `Payment_Amount` decimal(10,2) NOT NULL,
  `Payment_Method` varchar(50) NOT NULL,
  `payment_status` int NOT NULL,
  `custId` int NOT NULL,
  PRIMARY KEY (`Payment_Number`),
  UNIQUE KEY `custId` (`custId`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_Number`, `Payment_Date`, `Payment_Amount`, `Payment_Method`, `payment_status`, `custId`) VALUES
(0, '0000-00-00', '0.00', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 12345672544, 'your_device_name_here3', 'ab48ffab19646021e005bbf6c178a0ff2659c36f59a3358c61edcbd74dcd67e2', '[\"*\"]', NULL, NULL, '2023-12-24 18:17:49', '2023-12-24 18:17:49'),
(2, 'App\\Models\\User', 12345672544, 'your_device_name_here3', '0ed7f872f4347eb809a70505fdd5b5bc2055a99e4644ef31bbaf06cb94abf060', '[\"*\"]', NULL, NULL, '2023-12-24 18:18:28', '2023-12-24 18:18:28'),
(3, 'App\\Models\\User', 12345672544, 'your_device_name_here3', '80521ea038402f9252d3676ed0048c9223f51ef8eac2f8b8bdb19228febb7a1a', '[\"*\"]', '2023-12-24 18:20:05', NULL, '2023-12-24 18:20:05', '2023-12-24 18:20:05'),
(4, 'App\\Models\\User', 12345672544, 'your_device_name_here3', 'c39257774397b87e95d063d1af9a4c496f4430d445ac58a219c328092bcde3c3', '[\"*\"]', '2023-12-24 18:22:48', NULL, '2023-12-24 18:22:47', '2023-12-24 18:22:48'),
(5, 'App\\Models\\User', 12345672544, 'your_device_name_here3', '97f147dc49613a61717f27fc802aac2ef4d7c1fb7af0a64285953355ac3c15f9', '[\"*\"]', '2023-12-24 18:25:11', NULL, '2023-12-24 18:25:11', '2023-12-24 18:25:11'),
(6, 'App\\Models\\User', 12345672544, 'android', '06d4ca17b6a2d7f3a889b55d3ad13450faf6e030cd03215d717ffe8b4eda812f', '[\"*\"]', NULL, NULL, '2023-12-25 01:19:38', '2023-12-25 01:19:38'),
(7, 'App\\Models\\User', 12345672544, 'andorid', 'a797f1018942871ba828d53780f0de0b77c47e7c60ae381a2ce5959bb0388878', '[\"*\"]', NULL, NULL, '2023-12-25 02:51:26', '2023-12-25 02:51:26'),
(8, 'App\\Models\\User', 12345672544, 'andorid', '0bd47c9a6b6fd9dd879d1d2331880cc577549eee74a6f652d759df2627f0e5db', '[\"*\"]', NULL, NULL, '2023-12-25 03:00:04', '2023-12-25 03:00:04'),
(9, 'App\\Models\\User', 12345672544, 'andorid', '3cf6e952beb56f245b313feac12753d7c7552e1bba044a8e3fb04bf5dd3a30e9', '[\"*\"]', NULL, NULL, '2023-12-25 03:02:14', '2023-12-25 03:02:14'),
(10, 'App\\Models\\User', 12345672544, 'andorid', '6019f45636b8eb320eca61e997107fba9ae1e54902d620caa6cac069015a04bb', '[\"*\"]', NULL, NULL, '2023-12-25 03:03:20', '2023-12-25 03:03:20'),
(11, 'App\\Models\\User', 12345672544, 'andorid', 'c5271ff7b1e41087bb410dac7290c51227a852cfb51ca791cc8e30f30e84f310', '[\"*\"]', NULL, NULL, '2023-12-25 03:04:01', '2023-12-25 03:04:01'),
(12, 'App\\Models\\User', 12345672544, 'andorid', 'be5d3b20ad40d911e9e9d4e254fe9ed0c7051a9490bf18e332252aef9db0ebbc', '[\"*\"]', NULL, NULL, '2023-12-25 03:05:21', '2023-12-25 03:05:21'),
(13, 'App\\Models\\User', 12345672544, 'android', 'd3a9b4efee2a8ec99974be3c3a7dd104ab4f4698d6cdf8c75219b7c85ca8687e', '[\"*\"]', NULL, NULL, '2023-12-25 03:07:53', '2023-12-25 03:07:53'),
(14, 'App\\Models\\User', 12345672544, 'android', 'd984b4fd70f6e0c9c985e738791581e6c86227ddadba0f171ff069f6c2cb2652', '[\"*\"]', NULL, NULL, '2023-12-25 03:08:17', '2023-12-25 03:08:17'),
(15, 'App\\Models\\User', 12345672544, 'android', '88bd1ca09544e9b18fbb30304b83b876eae3a239e7327b4c3c27dcee941e3cf0', '[\"*\"]', NULL, NULL, '2023-12-25 03:09:01', '2023-12-25 03:09:01'),
(16, 'App\\Models\\User', 12345672544, 'android', 'de21539f88b58e94a9626afd7010f5687a757ac80b26db951e7832f19213a910', '[\"*\"]', NULL, NULL, '2023-12-25 03:10:13', '2023-12-25 03:10:13'),
(17, 'App\\Models\\User', 12345672544, 'android', '45e093ae9139d280ea83d19421406e4a0e325ed9b5d7f358f9f6a2d91a39e1e9', '[\"*\"]', NULL, NULL, '2023-12-25 03:15:11', '2023-12-25 03:15:11'),
(18, 'App\\Models\\User', 12345672544, 'android', '86ee0f41a7906a5b8984962a315968635df9b581fcefe4dd86c2a62ca96cc791', '[\"*\"]', NULL, NULL, '2023-12-25 03:16:06', '2023-12-25 03:16:06'),
(19, 'App\\Models\\User', 12345672544, 'android', 'b5a7eed26b4fb6af373338f12e1f21adfd112a1bbd24d6aafba7a47155769f32', '[\"*\"]', '2023-12-25 03:25:38', NULL, '2023-12-25 03:16:52', '2023-12-25 03:25:38'),
(20, 'App\\Models\\User', 12345672544, 'android', 'fd84417898eaee4a80fb36749166a08024ac2c180d0d4dc99b983902cccaf9dc', '[\"*\"]', NULL, NULL, '2023-12-25 03:20:52', '2023-12-25 03:20:52'),
(21, 'App\\Models\\User', 12345672544, 'android', '5b65534b011c728c145271a17b0017a5acb66c9d2096b2e919b7b8999edebab5', '[\"*\"]', NULL, NULL, '2023-12-25 03:21:53', '2023-12-25 03:21:53'),
(22, 'App\\Models\\User', 12345672544, 'android', '0726dc7950a7cc5ff48df573ec31b06a5bf121004e2f8514ede79f2320cadf76', '[\"*\"]', NULL, NULL, '2023-12-25 03:22:15', '2023-12-25 03:22:15'),
(23, 'App\\Models\\User', 12345672544, 'android', '55c629372a317f4348d33e6e49c98ed381c278cd1cf0f9768213dd4dc53971b4', '[\"*\"]', NULL, NULL, '2023-12-25 03:23:17', '2023-12-25 03:23:17'),
(24, 'App\\Models\\User', 12345672544, 'android', '80b2458e5b7fe1f5f9b2bb796c5fbeec2c276470eb08c5f8f9ba2c4e7c8a1712', '[\"*\"]', NULL, NULL, '2023-12-25 03:23:44', '2023-12-25 03:23:44'),
(25, 'App\\Models\\User', 12345672544, 'android', '5885d0a0314e0825c0b313d215490e6ba62200f21c098c1b67ba7768b5f34445', '[\"*\"]', NULL, NULL, '2023-12-25 03:23:58', '2023-12-25 03:23:58'),
(26, 'App\\Models\\User', 12345672544, 'android', '9afc52744afd8dc1551fd67946dff8b72a76eb97a29a426f0f1bff4cf43a0080', '[\"*\"]', NULL, NULL, '2023-12-25 03:25:07', '2023-12-25 03:25:07'),
(27, 'App\\Models\\User', 12345672544, 'android', '39e603f303e3ef1a6f4827cae26a5541913251d51357e380110ac98837768ba9', '[\"*\"]', '2023-12-25 03:25:52', NULL, '2023-12-25 03:25:38', '2023-12-25 03:25:52'),
(28, 'App\\Models\\User', 12345672544, 'android', '712ab7d73da3fcb21ed0afee65ba52e8e946c3f3e3dcd86d1042d4302c108f12', '[\"*\"]', '2023-12-25 03:26:14', NULL, '2023-12-25 03:25:52', '2023-12-25 03:26:14'),
(31, 'App\\Models\\User', 12345672544, 'android', 'e1a5da42f4ba8a5a0647d1a1dabbab0fcba7f70dafd2680dc6fd39319f9a1617', '[\"*\"]', NULL, NULL, '2023-12-25 03:42:04', '2023-12-25 03:42:04'),
(32, 'App\\Models\\User', 12345672544, 'android', 'b31e35824ab5b946403b69adeb35bdf28118aa1d0f71ac4153c5552081c191f0', '[\"*\"]', NULL, NULL, '2023-12-25 03:43:57', '2023-12-25 03:43:57'),
(37, 'App\\Models\\User', 26, 'registration-token', '6963ef15c2f9688ce703355812648005acadab32d7d327c8fbd9836587369b3b', '[\"*\"]', NULL, NULL, '2023-12-25 04:55:26', '2023-12-25 04:55:26'),
(38, 'App\\Models\\User', 27, 'registration-token', 'cbdf7184d2231cc559d853148367a84372e45ceca03f968073623eb142a31957', '[\"*\"]', NULL, NULL, '2023-12-25 04:59:00', '2023-12-25 04:59:00'),
(39, 'App\\Models\\User', 28, 'registration-token', 'd41c19cd7b4f0d13dca76c63398d00fd09c2f32e4e7de616a425ac1c884bb607', '[\"*\"]', NULL, NULL, '2023-12-25 05:02:30', '2023-12-25 05:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `ProductID` int NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ProductType` int NOT NULL,
  `Original_Price` decimal(10,2) NOT NULL,
  `Product_Image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Decription` text COLLATE utf8mb4_general_ci NOT NULL,
  `Stock_quantity` int NOT NULL,
  `PointsPrice` decimal(10,2) NOT NULL,
  `store_id` int NOT NULL,
  `CatID` int NOT NULL,
  PRIMARY KEY (`ProductID`),
  KEY `store_id` (`store_id`),
  KEY `CatID` (`CatID`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `ProductType`, `Original_Price`, `Product_Image`, `Decription`, `Stock_quantity`, `PointsPrice`, `store_id`, `CatID`) VALUES
(1, 'سكر', 0, '12.60', '', ' سكر معبأ 1 كجم', 50, '0.00', 1, 0),
(2, 'عدس', 0, '21.00', '', 'عدس مجروش 500 جم', 50, '0.00', 1, 0),
(3, 'زيت عباد', 0, '20.00', '', 'زيت 1 لتر', 100, '0.00', 1, 0),
(4, 'زيت خليط', 0, '30.00', '', 'زيت خليط 1 لتر', 30, '0.00', 1, 0),
(5, 'شاي ', 0, '5.00', '', ' شاي ناعم 40 جم', 100, '0.00', 1, 0),
(6, 'جبنه تتراباك', 0, '7.00', '', 'جبنة تتراباك 125 جم', 50, '0.00', 1, 0),
(7, 'صابون غسيل', 0, '3.00', '', 'صابون غسيل 125 جم', 100, '0.00', 1, 0),
(8, 'صابون حمام', 0, '7.50', '', 'صابون تواليت 125جم', 50, '0.00', 1, 0),
(9, 'مكرونه', 0, '13.00', '', 'مكرونة 800 جم', 100, '0.00', 1, 0),
(10, 'ارز', 0, '12.60', '', ' أرز معبأ 1 كجم', 50, '0.00', 1, 0),
(11, 'فول', 0, '9.00', '', 'فول معبأ 500 جم', 100, '0.00', 1, 0),
(12, 'مكرونة ', 0, '6.50', '', 'مكرونة 400 جم', 50, '0.00', 1, 0),
(13, 'دقيق ', 0, '18.00', '', 'دقيق معبأ ورقي أو بلاستيك 1 كجم', 50, '0.00', 1, 0),
(14, 'مسلي', 0, '30.00', '', 'مسلى صناعي 800 جم', 50, '0.00', 1, 0),
(18, 'صلصه', 0, '8.00', '', ' صلصة 300 جم', 5, '0.00', 1, 0),
(19, 'تونه', 0, '18.00', '', 'تونة مفتتة وزن 140 جراما', 50, '0.00', 1, 0),
(20, 'مربى', 0, '16.00', '', 'مربى أنواع 350 جراما', 50, '0.00', 1, 0),
(21, 'جبنه تتراباك', 0, '14.00', '', 'جبنة تتراباك 250 جم', 50, '0.00', 1, 0),
(22, 'مسحوق اتوماتيك', 0, '25.00', '', 'مسحوق أتوماتيك 800 كجم', 50, '0.00', 1, 0),
(23, 'مسحوق عادي', 0, '16.00', '', 'مسحوق عادي يدوي 800 جم', 50, '0.00', 1, 0),
(24, 'لبن جاف', 0, '25.50', '', 'لبن جاف 125 جم', 50, '0.00', 1, 0),
(25, 'خل', 0, '6.00', '', 'خل 5% 900 ملي', 50, '0.00', 1, 0),
(26, 'ملح', 0, '1.50', '', 'کیس ملح طعام 300 جم', 50, '0.00', 1, 0),
(27, 'حلاوه طحينيه', 0, '3.00', '', 'بار حلاوة طحينية سادة 40 جم', 50, '0.00', 1, 0),
(28, 'سائل غسيل', 0, '3.00', '', 'کیس سائل غسيل أواني 80 جم', 50, '0.00', 1, 0),
(29, 'بسكويت', 0, '1.50', '', 'بسكويت يويوز سادة', 50, '0.00', 1, 0),
(30, 'بسكويت', 0, '2.75', '', 'بسكويت يويوز ويفر أنواع', 50, '0.00', 1, 0),
(31, 'بسكويت', 0, '4.00', '', 'بسكويت تومورو أنواع', 50, '0.00', 1, 0),
(32, 'بسكويت', 0, '4.00', '', 'بسكويت بوو أنواع', 50, '0.00', 1, 0),
(33, 'طحينه', 0, '2.50', '', 'طحينة بيضاء ظرف 140 جراما', 50, '0.00', 1, 0),
(34, 'قهوه', 0, '4.00', '', 'قهوة سريعة الذوبان 18 جم', 50, '0.00', 1, 0),
(35, 'مرقة الدجاج', 0, '6.00', '', 'علبة مرقة دجاج عدد 8 مكعبات', 50, '0.00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

DROP TABLE IF EXISTS `store`;
CREATE TABLE IF NOT EXISTS `store` (
  `StoreId` int NOT NULL AUTO_INCREMENT,
  `Owner_id` int NOT NULL,
  `StoreName` varchar(100) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Valid` int NOT NULL,
  `Latitude` decimal(10,8) NOT NULL,
  `Longitude` decimal(11,8) NOT NULL,
  PRIMARY KEY (`StoreId`),
  KEY `Owner_id` (`Owner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`StoreId`, `Owner_id`, `StoreName`, `Address`, `Type`, `Valid`, `Latitude`, `Longitude`) VALUES
(1, 1, 'Store 1', '123 Main St', 'Grocery1', 1, '30.09463900', '31.20323100'),
(2, 1, 'Store 2', '123 Main St', 'Grocery2', 0, '30.09464000', '31.20323200'),
(3, 1, 'Store 3', '123 Main St', 'Grocery3', 1, '30.09464100', '31.20323300'),
(4, 2, 'Store 4', '456 Oak St', 'Grocery4', 0, '30.08525400', '31.23456800'),
(5, 2, 'Store 5', '456 Oak St', 'Grocery5', 0, '30.08524300', '31.23456900'),
(6, 3, 'Store 6', '789 Pine St', 'Grocery6', 1, '30.07682900', '31.34567800'),
(7, 4, 'Store 7', '321 Maple St', 'Grocery7', 0, '30.06842400', '31.45678900'),
(8, 5, 'Store 8', '654 Birch St', 'Grocery8', 1, '30.06001900', '31.56789000');

-- --------------------------------------------------------

--
-- Table structure for table `storeonwer`
--

DROP TABLE IF EXISTS `storeonwer`;
CREATE TABLE IF NOT EXISTS `storeonwer` (
  `OwnerId` int NOT NULL AUTO_INCREMENT,
  `Tax_registration_number` int NOT NULL,
  `National_Id` bigint NOT NULL,
  `TaxCard` varchar(50) NOT NULL,
  `iii` int NOT NULL,
  PRIMARY KEY (`OwnerId`),
  UNIQUE KEY `Tax_registration_number` (`Tax_registration_number`),
  KEY `National_Id` (`National_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `storeonwer`
--

INSERT INTO `storeonwer` (`OwnerId`, `Tax_registration_number`, `National_Id`, `TaxCard`, `iii`) VALUES
(1, 123456, 30011124786141, 'Tax 1', 0),
(2, 789112, 30011124786142, 'Tax 2', 0),
(3, 112264, 30011124786143, 'Tax 3', 0),
(4, 127846, 30011124786144, 'Tax 4', 0),
(5, 111245, 30011124786145, 'Tax 5', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `NationalId` bigint NOT NULL,
  `Name` varchar(100) NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Phone_number` varchar(15) NOT NULL,
  `City` varchar(100) NOT NULL,
  `State` varchar(100) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `BirthDate` date NOT NULL,
  `UserType` int NOT NULL,
  `Latitude` decimal(10,8) NOT NULL,
  `Longitude` decimal(11,8) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`NationalId`),
  UNIQUE KEY `id` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `NationalId`, `Name`, `email`, `password`, `Phone_number`, `City`, `State`, `Street`, `BirthDate`, `UserType`, `Latitude`, `Longitude`, `created_at`, `updated_at`) VALUES
(27, 1234456778, 'Abdalal', 'afas2000sda@gmail.com', '$2y$12$QMDaOX9eUM1DnE2Z7YzrJelo9pnuDyf.g70RPlrE5XxkRUIyPaNo6', '0230131', 'giza', 'embaba', 'qawma', '2023-12-11', 1, '10.20000000', '10.20000000', '2023-12-25 04:59:00', '2023-12-25 04:59:00'),
(24, 12345672544, 'Johnn', 'user2@user2.com', '$2y$12$xMHvKr.2AF0X5EEZbBQEFuW4KpyftnPCjTrh0bfBPD5UUImg1Idvq', '1234567891425', 'Embaba', 'Giza', 'Qawmia', '2000-11-21', 1, '10.20000000', '10.20000000', '2023-12-24 12:33:19', '2023-12-24 12:33:19'),
(28, 123445677877, 'Abdalala', 'afas200sda@gmail.com', '$2y$12$0yO67tonHCu2Pb7SlqNST.Mk5SIlC2T0hNXhdkIgDWaIZyT4LiUyG', '0230131', 'giza', 'embaba', 'qawma', '2023-12-11', 1, '10.20000000', '10.20000000', '2023-12-25 05:02:30', '2023-12-25 05:02:30'),
(26, 1234567254456, 'Johnn', 'user10@user20.com', '$2y$12$n4lPEfPnr7rj7H0KDWFRl.nvf7or3WAFXsdZS7PfuskEcjeX0O4LW', '1234567891425', 'Embaba', 'Giza', 'Qawmia', '2000-11-21', 1, '10.20000000', '10.20000000', '2023-12-25 04:55:26', '2023-12-25 04:55:26'),
(25, 12345672544567, 'Johnn', 'user10@user10.com', '$2y$12$bbjNNYD9eUr1GNAeauYhU.Tdt0QXse8Pwd4orVOyp7rSd4ykgRasa', '1234567891425', 'Embaba', 'Giza', 'Qawmia', '2000-11-21', 1, '10.20000000', '10.20000000', '2023-12-25 04:17:20', '2023-12-25 04:17:20'),
(1, 30011124786124, 'Abdallah Fawzi', 'user@user.com', '$2y$12$GVEVvcn2uJYz9hrwFPZ5veIijn9H4y4Zy1.cz6DsKDD1Bg0sUD6rm', '01060543660', 'Imababa', 'Giza', 'Abd Al Mongi Ibrahim, Warraq Al Arab', '2000-11-21', 1, '30.09463900', '31.20323100', NULL, NULL),
(2, 30011124786125, 'Ahmed Mohamed', 'user@user2.com', '$2a$12$9HiwjslOzHDNK5a/FEOBWu.Y7L8l7C7yuik7MeRuuiW', '01234567890', 'Dokki', 'Giza', 'El Mesaha St', '1995-08-15', 1, '30.03300000', '31.23150000', NULL, NULL),
(3, 30011124786126, 'Sarah Ali', 'user@user3.com', '', '01123456789', 'Nasr City', 'Cairo', 'Tahrir St', '1980-03-10', 1, '30.06260000', '31.24970000', NULL, NULL),
(6, 30011124786131, 'Aisha Ahmed', 'Tez rady@7amra.com', '', '01033333333', 'Zamalek', 'Cairo', '26th July St', '1997-12-01', 2, '30.06740000', '31.21830000', NULL, NULL),
(7, 30011124786132, 'Khaled Salem', '', '', '01144444444', 'Mohandessin', 'Giza', 'Giza Square', '1985-09-22', 2, '30.03300000', '31.20950000', NULL, NULL),
(8, 30011124786133, 'Nadia Mohamed', '', '', '01255555555', 'Nasr City', 'Cairo', 'Makram Ebeid St', '1982-02-14', 2, '30.05020000', '31.33420000', NULL, NULL),
(9, 30011124786134, 'Ahmed Ibrahim', '', '', '01066666666', 'Downtown', 'Cairo', 'Talaat Harb St', '1975-06-30', 2, '30.04440000', '31.23570000', NULL, NULL),
(10, 30011124786135, 'Laila Mustafa', '', '', '01177777777', 'Giza', 'Giza', 'Pyramids St', '1994-03-12', 2, '29.97730000', '31.13250000', NULL, NULL),
(11, 30011124786136, 'Tarek Salah', '', '', '01288888888', '6th of October', 'Giza', 'SODIC Westown', '1989-10-08', 3, '29.98110000', '30.94300000', NULL, NULL),
(12, 30011124786137, 'Mona Ahmed', '', '', '01099999999', 'Maadi', 'Cairo', 'Sakanat El Maadi St', '1996-08-25', 3, '29.95950000', '31.26140000', NULL, NULL),
(13, 30011124786138, 'Youssef Mansour', '', '', '01100000000', 'Nasr City', 'Cairo', 'Ahmed Fakhry St', '1983-05-17', 3, '30.05960000', '31.33410000', NULL, NULL),
(14, 30011124786139, 'Sara Kamal', '', '', '01212345678', 'Heliopolis', 'Cairo', 'Abdel Hamid Badawy St', '1990-12-20', 3, '30.08470000', '31.34460000', NULL, NULL),
(15, 30011124786140, 'Khaled Ahmed', '', '', '01023456789', 'Dokki', 'Giza', 'Mohamed Mahmoud St', '1978-07-05', 3, '30.03450000', '31.20900000', NULL, NULL),
(16, 30011124786141, 'Nour Ezzat', '', '', '01134567890', 'Zamalek', 'Cairo', 'Ismail Mohamed St', '1987-02-28', 4, '30.06630000', '31.21560000', NULL, NULL),
(17, 30011124786142, 'Amr Hany', '', '', '01245678901', 'Mohandessin', 'Giza', 'Gameat El Dewal St', '1984-09-15', 4, '30.05670000', '31.20490000', NULL, NULL),
(18, 30011124786143, 'Hala Fathy', '', '', '01056789012', 'Maadi', 'Cairo', 'Nile Corniche St', '1993-04-02', 4, '29.95950000', '31.26140000', NULL, NULL),
(19, 30011124786144, 'Omar Kamal', '', '', '01167890123', 'Nasr City', 'Cairo', 'Makram Ebeid St', '1986-11-19', 4, '30.05020000', '31.33420000', NULL, NULL),
(20, 30011124786145, 'Lina Adel', '', '', '01278901234', 'Heliopolis', 'Cairo', 'Abbas El Akkad St', '1991-06-06', 4, '30.06920000', '31.34300000', NULL, NULL),
(23, 123456725444772, 'John', 'Fir7st@fitst421322.com', '$2y$12$GVEVvcn2uJYz9hrwFPZ5veIijn9H4y4Zy1.cz6DsKDD1Bg0sUD6rm', '1234567891425', 'Embaba', 'Giza', 'Qawmia', '2000-11-21', 1, '10.20000000', '10.20000000', '2023-12-23 20:40:46', '2023-12-23 20:40:46');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`TamweencardId`) REFERENCES `cards` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`National_Id`) REFERENCES `user` (`NationalId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`National_Id`) REFERENCES `user` (`NationalId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `governoradmin`
--
ALTER TABLE `governoradmin`
  ADD CONSTRAINT `governoradmin_ibfk_1` FOREIGN KEY (`National_Id`) REFERENCES `user` (`NationalId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`deliveryId`) REFERENCES `delivery` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `orders_made`
--
ALTER TABLE `orders_made`
  ADD CONSTRAINT `orders_made_ibfk_2` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`ProductID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `store` (`StoreId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`CatID`) REFERENCES `category` (`CatID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `store_ibfk_1` FOREIGN KEY (`Owner_id`) REFERENCES `storeonwer` (`OwnerId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `storeonwer`
--
ALTER TABLE `storeonwer`
  ADD CONSTRAINT `storeonwer_ibfk_1` FOREIGN KEY (`National_Id`) REFERENCES `user` (`NationalId`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
