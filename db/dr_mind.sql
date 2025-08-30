-- Adminer 4.8.4 MySQL 8.0.41-0ubuntu0.24.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint DEFAULT '1' COMMENT '1=active, 2=block',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'admin' COMMENT 'super,admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `admin`;
INSERT INTO `admin` (`id`, `name`, `email`, `password`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1,	'Admin',	'admin@gmail.com',	'$2y$12$SYpz2BvP.bOdC2mF/z60uegItTLIduUNUAb20tjDr0b.ItJ/7afOS',	1,	'admin',	'2025-05-13 03:23:10',	'2025-05-13 03:23:10');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=active,2=block',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `categories`;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `failed_jobs`;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_reset_tokens_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1),
(4,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(5,	'2025_04_02_121112_create_admin_table',	1),
(6,	'2025_04_09_181943_create_categories_table',	1),
(7,	'2025_04_21_192553_create_products_table',	2);

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `password_reset_tokens`;

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `personal_access_tokens`;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufacturar_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_identification_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `product_status` enum('draft','publish') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `publish_date` date DEFAULT NULL,
  `product_stock` int DEFAULT NULL,
  `level_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_two` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_three` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `earning_point` int DEFAULT NULL,
  `product_category` bigint unsigned DEFAULT NULL,
  `product_subcategory` bigint unsigned DEFAULT NULL,
  `tags` json DEFAULT NULL,
  `specification_terms` json DEFAULT NULL,
  `base_price` decimal(10,2) DEFAULT NULL,
  `price_currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'usd',
  `product_discount_type` enum('none','fixed','percentage') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `discount_value` decimal(10,2) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_shipping` enum('vendor','drmind') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vendor',
  `stock_status` enum('instock','unavailable','to_be_announced') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'instock',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_product_name_index` (`product_name`),
  KEY `products_slug_index` (`slug`),
  KEY `products_product_sku_index` (`product_sku`),
  KEY `products_product_category_index` (`product_category`),
  KEY `products_product_subcategory_index` (`product_subcategory`),
  KEY `products_manufacturar_name_index` (`manufacturar_name`),
  KEY `products_product_identification_no_index` (`product_identification_no`),
  KEY `products_product_price_index` (`product_price`),
  KEY `products_base_price_index` (`base_price`),
  KEY `products_product_discount_type_index` (`product_discount_type`),
  KEY `products_discount_value_index` (`discount_value`),
  FULLTEXT KEY `products_fulltext_index` (`product_name`,`manufacturar_name`,`description`,`short_description`),
  CONSTRAINT `products_product_category_foreign` FOREIGN KEY (`product_category`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_product_subcategory_foreign` FOREIGN KEY (`product_subcategory`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `products`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `earning_point` double(10,2) DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_referral_code_unique` (`referral_code`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `users`;
INSERT INTO `users` (`id`, `name`, `email`, `referral_code`, `email_verified_at`, `password`, `earning_point`, `phone`, `referral_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Mrs. Letha Willms PhD',	'stokes.megane@example.net',	'HSVS8PUO',	'2025-05-13 03:23:10',	'$2y$12$MKuWn8nAe8bw4HIq3HGHKuAr6zsciAQT8f3q5lb6C6hwyPiTR9wDi',	6023.00,	'+1.941.504.1980',	NULL,	'9dTotTvDA9',	'2025-05-13 03:23:10',	'2025-05-13 03:23:10'),
(2,	'Kristy Runte MD',	'kassulke.marjory@example.com',	'kCzqCUBI',	'2025-05-13 03:23:10',	'$2y$12$6vlaUfwHSye0QqdyfuDcIe7WsAt1lkC1MB1ge5yxnYA7YnzlO/eBO',	8558.00,	'1-248-229-1654',	NULL,	'YEIYE9g6eH',	'2025-05-13 03:23:11',	'2025-05-13 03:23:11'),
(3,	'Prof. Gilberto Turner II',	'shane@example.com',	'QSfbERVW',	'2025-05-13 03:23:11',	'$2y$12$afQNyc2qlxmUDfMz932wpelt581Xc3GIvXq5t95xRwQrQx2e3BM3q',	3289.00,	'(734) 633-7455',	NULL,	'sfkYW2mtnJ',	'2025-05-13 03:23:11',	'2025-05-13 03:23:11'),
(4,	'Evelyn Friesen',	'alexandro.walter@example.net',	'kBBYfhxQ',	'2025-05-13 03:23:11',	'$2y$12$MEZNNqV/84Mqp2c1XrMZM.TsPsJraAswa0nQcyvGN96sqFqhHkOo2',	6173.00,	'+16788339993',	NULL,	'413OQQDBV9',	'2025-05-13 03:23:11',	'2025-05-13 03:23:11'),
(5,	'Amiya Hahn',	'kuvalis.yessenia@example.org',	'5V3YHPpm',	'2025-05-13 03:23:11',	'$2y$12$Q1ZGLHaZ/I4DUj7tS9HHduUgQEmfauy.DGQnwU98w82ASK2HmFWnK',	2090.00,	'+1-757-545-0892',	NULL,	'Jr24FjnQqQ',	'2025-05-13 03:23:11',	'2025-05-13 03:23:11'),
(6,	'Lyla Roob',	'gino13@example.org',	'N3C3r72H',	'2025-05-13 03:23:11',	'$2y$12$79Z1FjQb2.DIxu1RM4OmMeZQNbhlBDzlNUMj6/zYIjVVO2AsVZ13W',	7490.00,	'+1 (716) 574-3537',	'5V3YHPpm',	'eetZBgMIMV',	'2025-05-13 03:23:12',	'2025-05-13 03:23:12'),
(7,	'Enrico Pollich',	'mayer.evelyn@example.org',	'6pmxQdxD',	'2025-05-13 03:23:12',	'$2y$12$8xk8UGBmMTTmBv4N3RaT7ef2epoey/m3pF26QzMuU1cZT5tUss1Ea',	7587.00,	'+13204456853',	'HSVS8PUO',	'I8ezWhAnoz',	'2025-05-13 03:23:12',	'2025-05-13 03:23:12'),
(8,	'Mr. Garett Nienow',	'ricky.boyer@example.com',	'M2arc2LT',	'2025-05-13 03:23:12',	'$2y$12$LZnc1xPmD6E76qNO1Yp0I.m/DeCa.oWyKVyx68iD/hXjJIJqwQ5cy',	9889.00,	'(520) 399-6367',	'N3C3r72H',	'ZUKKagGWaZ',	'2025-05-13 03:23:12',	'2025-05-13 03:23:12'),
(9,	'Eladio Schinner',	'quigley.willard@example.com',	'daLvzhXI',	'2025-05-13 03:23:12',	'$2y$12$Fm9w6lkQLjNN7BoGHF/4M.iDh3zqGrWIUuUfe3wQVc2TMlzvJbI82',	5622.00,	'(843) 423-5641',	'QSfbERVW',	'4fN7qUDnbh',	'2025-05-13 03:23:12',	'2025-05-13 03:23:12'),
(10,	'Mrs. Arielle Dach MD',	'bernice41@example.net',	'Wze6N6HM',	'2025-05-13 03:23:12',	'$2y$12$tMnoatTJqaisvEEpm4b.W.kFBJQRSnS1SAnNJqXK8ICUehlTqAf/W',	4286.00,	'479.461.8282',	'N3C3r72H',	'CKn6gxby6c',	'2025-05-13 03:23:12',	'2025-05-13 03:23:12'),
(11,	'Annabelle Bechtelar',	'meghan44@example.com',	'uh1wKg0v',	'2025-05-13 03:23:12',	'$2y$12$rLkiyIUYvKA/EZVLBtjrK.9TLr7BbBBgG2PeMdmDG05Etr5VjNJFC',	8343.00,	'+18179167753',	'N3C3r72H',	'28kuxDcPzs',	'2025-05-13 03:23:13',	'2025-05-13 03:23:13'),
(12,	'Mr. Shad Bogan DDS',	'emerald04@example.net',	'UfeQnAJX',	'2025-05-13 03:23:13',	'$2y$12$9YJjXVtfAOHQHOAvZCPJAuhL8mxazyZsSPpbMMXbzdZ2a3I4HqNl2',	2423.00,	'+1-215-452-5891',	'kBBYfhxQ',	'y3xIHlCyYZ',	'2025-05-13 03:23:13',	'2025-05-13 03:23:13'),
(13,	'Prof. Cale Johnson',	'hmarks@example.net',	'oXYVcvYx',	'2025-05-13 03:23:13',	'$2y$12$f2NtPLWDXGTZfbdBPEY1kOnOBFhyJ/oV6S.3EqBPAYsR1pdfZ44XS',	7805.00,	'(540) 289-5774',	'uh1wKg0v',	'Vt0qLwRoen',	'2025-05-13 03:23:13',	'2025-05-13 03:23:13'),
(14,	'Prof. Hazel Smitham Sr.',	'rafaela.jerde@example.com',	'40bLVlZa',	'2025-05-13 03:23:13',	'$2y$12$g2XNc8XqFbIUYq06GwyP9ekhWrKOEBOmoF44GFIOlnxFIO9BTMK56',	8223.00,	'1-315-782-8895',	'daLvzhXI',	'ZcV8M4eRxT',	'2025-05-13 03:23:13',	'2025-05-13 03:23:13'),
(15,	'Gloria Feest',	'ckunde@example.com',	'6KooK8D2',	'2025-05-13 03:23:13',	'$2y$12$R40Y9CxkKkqJ5F5fUQEYNOf49ER0YZuCqa8LX8Sk48wrDZhf0Je0K',	1791.00,	'386-381-4885',	'daLvzhXI',	'whUcfsqox5',	'2025-05-13 03:23:14',	'2025-05-13 03:23:14'),
(16,	'Aleen Brakus',	'marco.tromp@example.net',	'84tGT7fm',	'2025-05-13 03:23:14',	'$2y$12$jpsyFF9mUTzTdHLXHXoHAu90pbdbqAGnwon7x4G0TzVKLr.2ozvV6',	1062.00,	'(270) 754-0470',	'HSVS8PUO',	'U2i9wlVDfq',	'2025-05-13 03:23:14',	'2025-05-13 03:23:14'),
(17,	'Prof. Kamille Parker',	'myra.bergstrom@example.com',	'U05M8ACz',	'2025-05-13 03:23:14',	'$2y$12$7lzFpLWgKm2qjnAIyog0seCJnn6zBOKOx6NvUPqulh.9/UsqMFhsm',	2882.00,	'+1.740.755.0398',	'6KooK8D2',	'XKlzXytJUz',	'2025-05-13 03:23:14',	'2025-05-13 03:23:14'),
(18,	'Osvaldo Turner',	'wwunsch@example.org',	'gYjoSTrj',	'2025-05-13 03:23:14',	'$2y$12$akyQbhxbKDCs8VgEOGb1x.jSRGvj6gbtuyvyF8zLqLgnRGTnzGLbW',	3427.00,	'1-209-993-6048',	'oXYVcvYx',	'pjpSecAtKq',	'2025-05-13 03:23:14',	'2025-05-13 03:23:14'),
(19,	'Friedrich Kunze MD',	'lempi32@example.net',	'ooRultYN',	'2025-05-13 03:23:14',	'$2y$12$EOOHOibiaB360my0o/4ObO8rHoQF/G7Oe8CHKS1j1wFK..R62GVia',	8221.00,	'+1-848-800-7047',	'N3C3r72H',	'7qvgjKs4wf',	'2025-05-13 03:23:14',	'2025-05-13 03:23:14'),
(20,	'Destin Williamson',	'isipes@example.net',	'wJWBEegP',	'2025-05-13 03:23:14',	'$2y$12$QmVeeLXIwEIG1TyYtvgE/us3b96Q4k2/7r.pa0QQTBoZ35Gycqxfi',	2309.00,	'(540) 664-1760',	'kCzqCUBI',	'aNxRvUAPmO',	'2025-05-13 03:23:15',	'2025-05-13 03:23:15'),
(21,	'German Zieme',	'mazie.keebler@example.com',	'2gvb4tif',	'2025-05-13 03:23:15',	'$2y$12$0gl1HjVtHYqX0B1FfrMPuuJ4mN0lpvbw9s5z8Q.oLyJEsXqu62nG.',	5266.00,	'+1-838-884-4254',	'QSfbERVW',	'J3tZ7awsFz',	'2025-05-13 03:23:15',	'2025-05-13 03:23:15'),
(22,	'Verdie Wiza PhD',	'fay.natasha@example.net',	'cqMppWN1',	'2025-05-13 03:23:15',	'$2y$12$p.P4pDReVmS3F5jmbdK9leT5svRE4t7lJrEc3XUKHtmfBowb9Wfii',	5380.00,	'+1-802-268-4994',	'oXYVcvYx',	'AT21Lbc4gP',	'2025-05-13 03:23:15',	'2025-05-13 03:23:15'),
(23,	'Abel Ruecker',	'qpollich@example.net',	'8uvHIyCq',	'2025-05-13 03:23:15',	'$2y$12$tjRGDDZxZd2nHbjT2gnr.uTOF2QcbggvZUAztCQpUODaBYjnunEvO',	4990.00,	'520.367.0632',	'Wze6N6HM',	'wj9LFIMzum',	'2025-05-13 03:23:15',	'2025-05-13 03:23:15'),
(24,	'Helen Huel',	'lindgren.brycen@example.org',	'90VIId7O',	'2025-05-13 03:23:15',	'$2y$12$zVhWRQnyScOyz5ngyIpQLue.GaGtvdQzS0Gz0Rt9TIghS6wVBaa3a',	8136.00,	'+18637391991',	'Wze6N6HM',	'6SDRANYi3U',	'2025-05-13 03:23:15',	'2025-05-13 03:23:15'),
(25,	'Mr. Finn Yundt',	'pprohaska@example.com',	'0jfBo2iQ',	'2025-05-13 03:23:15',	'$2y$12$AXVsmxoPINHWnJQIil647.9Zdxnr9o.mhX92dJmxl2NaYQjh0GofK',	8909.00,	'803-669-2884',	'wJWBEegP',	'jrQROqVDRl',	'2025-05-13 03:23:16',	'2025-05-13 03:23:16'),
(26,	'Eva Gaylord',	'nico25@example.org',	'PnhiqXon',	'2025-05-13 03:23:16',	'$2y$12$AJ/zz8ZYVKPV7EfCw4Uz0eEFiKck49aMgAIBKyZATJUmbH9ZMMUs.',	8341.00,	'657-946-1785',	'ooRultYN',	'wV0eDmMkK8',	'2025-05-13 03:23:16',	'2025-05-13 03:23:16'),
(27,	'Juwan Morissette V',	'ydickinson@example.net',	'U1QNRBcg',	'2025-05-13 03:23:16',	'$2y$12$UjivdWmxMzqIVRyNxqnVqeA6XTxPC5rEbOAwArb6vYwaxucEJRrPG',	3075.00,	'(434) 583-0713',	'6KooK8D2',	'r2HkKTtq6g',	'2025-05-13 03:23:16',	'2025-05-13 03:23:16'),
(28,	'Prof. Lucius Bechtelar MD',	'white.london@example.org',	'8pbC01W5',	'2025-05-13 03:23:16',	'$2y$12$7cFyWrnb1UmooN/fBXuS6u7z78FNS4uYpEtk3jSiBhRJMZis1hhQ.',	2363.00,	'920.757.1993',	'U1QNRBcg',	'pYhGwvjwCO',	'2025-05-13 03:23:16',	'2025-05-13 03:23:16'),
(29,	'Dandre Hintz',	'prudence.keebler@example.org',	'aAOYy2zb',	'2025-05-13 03:23:16',	'$2y$12$IKa7YwSlw1Krfou9Q9H.Buvztfp2LEfmLV7jmC8jUt7EoBRK.FwzK',	2192.00,	'+1.864.890.4786',	'kBBYfhxQ',	'ooSUV7MdvA',	'2025-05-13 03:23:17',	'2025-05-13 03:23:17'),
(30,	'Leland Lubowitz I',	'mrogahn@example.com',	'Ch42Yo20',	'2025-05-13 03:23:17',	'$2y$12$OBkyN9B7VEVruZIipOBsy.31OcwNBJZNJRbhrd0KklyT3yM8g9l8G',	9051.00,	'1-949-448-4363',	'8pbC01W5',	'1OcIY7vWMc',	'2025-05-13 03:23:17',	'2025-05-13 03:23:17'),
(31,	'Eulalia Prosacco II',	'julie.hane@example.com',	'YyhBm52f',	'2025-05-13 03:23:17',	'$2y$12$9E4uOV/ZJbnTNzrHbkNu3e8PuR.3S1dMEBQJ474yGv/ST.j8E.WL6',	3683.00,	'223.601.4148',	'40bLVlZa',	'CpHakSsfS6',	'2025-05-13 03:23:17',	'2025-05-13 03:23:17'),
(32,	'Sylvan Volkman',	'sipes.clarabelle@example.net',	'2th0JCqG',	'2025-05-13 03:23:17',	'$2y$12$YV1Iz5O/W8S5HpW0cNGg2evr0aNQ3zXPgPnbZTXU3Qkuod3FSsGky',	3154.00,	'(223) 448-9248',	'8pbC01W5',	's90DNnc6wS',	'2025-05-13 03:23:17',	'2025-05-13 03:23:17'),
(33,	'Lavonne Graham IV',	'kertzmann.ahmad@example.org',	'rYzGa2Nb',	'2025-05-13 03:23:17',	'$2y$12$Rn.7Fya16EIfRnYcCA.ZFuiEVj3AQhyxE5OhynIli2HTrdZxYYBXa',	4464.00,	'872-505-4879',	'5V3YHPpm',	'r0enGBdbnJ',	'2025-05-13 03:23:17',	'2025-05-13 03:23:17'),
(34,	'Dusty Jacobson',	'rnikolaus@example.com',	'V5LV5Y4G',	'2025-05-13 03:23:17',	'$2y$12$RtFOLl6ZTXPHeAIsA2XZhe0ePlBTiMm8suFe9g63cHof.RZbmpYoy',	4769.00,	'310.673.7426',	'ooRultYN',	'cJ0Jlgeoeb',	'2025-05-13 03:23:18',	'2025-05-13 03:23:18'),
(35,	'Cody Senger',	'jacobi.sabryna@example.net',	'T7DtKTqv',	'2025-05-13 03:23:18',	'$2y$12$Fi/sypdSrzxEzomYxwZwheMdsEKRSXybO.ptMwEwYIsMjkBZvuaDG',	6259.00,	'279.432.0003',	'Wze6N6HM',	'8lUvrIF4vR',	'2025-05-13 03:23:18',	'2025-05-13 03:23:18'),
(36,	'Bennett Fritsch',	'jstiedemann@example.net',	'mLnmTI5o',	'2025-05-13 03:23:18',	'$2y$12$3szd0kbqtDmoysEQdtiyCe7GOEg.Zt7CMooRwz7hfXHsl9/AGTREu',	6829.00,	'+1-785-625-1416',	'HSVS8PUO',	'ULIkgpHTMf',	'2025-05-13 03:23:18',	'2025-05-13 03:23:18'),
(37,	'Jackie Prohaska',	'ivory.stanton@example.org',	'5SJki7om',	'2025-05-13 03:23:18',	'$2y$12$ZXw2T4FZaSLzrFQ01MsK0eiR31auwgjT1PQcHqKljrV0z0CXYnwfC',	8504.00,	'574.726.2023',	'HSVS8PUO',	'EFjmPWnxtg',	'2025-05-13 03:23:18',	'2025-05-13 03:23:18'),
(38,	'Henriette Walsh',	'taylor.ward@example.com',	'NScAYnDU',	'2025-05-13 03:23:18',	'$2y$12$QDGAToQtdcf9KJJvPPcyLeuZRSVpDuECT.s6G4EweHWmUHo67V1E2',	7471.00,	'+1-540-734-4052',	'HSVS8PUO',	'jl1YraRuuJ',	'2025-05-13 03:23:19',	'2025-05-13 03:23:19'),
(39,	'Mrs. Cassidy Green',	'kaela.schmidt@example.net',	'E8DyFWvY',	'2025-05-13 03:23:19',	'$2y$12$ihkJDY0y0pbLbnoDQ1PnxuwL5TXXl1CgnBIbio/vRD71CAGNNJhB.',	3801.00,	'+1.636.492.2016',	'HSVS8PUO',	'Pt7CaGThbe',	'2025-05-13 03:23:19',	'2025-05-13 03:23:19'),
(40,	'Annabel Trantow',	'leonora.koepp@example.net',	'cMgTrKUm',	'2025-05-13 03:23:19',	'$2y$12$0ixHuORf6Necclm7/dros.hc2mH1szgWsVOPlG5z1GP0C1m7niUI2',	3234.00,	'262-472-1065',	'QSfbERVW',	'VuBRjFzAJK',	'2025-05-13 03:23:19',	'2025-05-13 03:23:19'),
(41,	'Ambrose Larson',	'jayce.kunde@example.net',	'QI3XtLwf',	'2025-05-13 03:23:19',	'$2y$12$oSsI/oR7MVMmW.cAnKh1IOVfCzr7BbFVmEZPSJnR8lCPNw13UP8XC',	2543.00,	'628.956.6529',	'aAOYy2zb',	'KvhBGRB8mU',	'2025-05-13 03:23:19',	'2025-05-13 03:23:19'),
(42,	'Brisa Durgan',	'karianne26@example.net',	'BU6erkC2',	'2025-05-13 03:23:19',	'$2y$12$T/Pp9dikyd9oLBPxpvy0AOG8RBNFmUV3wMMP8HDNWsYyNy74mTCkG',	4839.00,	'609-901-2591',	'oXYVcvYx',	'fVtMy3lOTh',	'2025-05-13 03:23:19',	'2025-05-13 03:23:19'),
(43,	'Ms. Drew Padberg',	'kub.cayla@example.org',	'TnfATpj2',	'2025-05-13 03:23:19',	'$2y$12$QBFbkZ9nulElw43leqNI4OfChsz0KFfpvzzvXtYl/z0XplVCydPba',	9332.00,	'986.246.5500',	'0jfBo2iQ',	'a1M9AW1gkT',	'2025-05-13 03:23:20',	'2025-05-13 03:23:20'),
(44,	'Evert Williamson',	'jeffry53@example.com',	'2QBdBGlW',	'2025-05-13 03:23:20',	'$2y$12$LT6ACfu8yHx8TuWa3q8wjOlssgXA01dXahYmKn.nFxTvd/PBYlaZG',	4174.00,	'(458) 241-7929',	'QI3XtLwf',	'wTRoWgb4MO',	'2025-05-13 03:23:20',	'2025-05-13 03:23:20'),
(45,	'Nat McKenzie Jr.',	'rylan.schuster@example.net',	'nXdxpeNU',	'2025-05-13 03:23:20',	'$2y$12$Dt3jVkMlhyDgpfwODyawguVzkdkjRGBpXzWJ5ZfDQK3UNi0i3WFBe',	5334.00,	'469.251.3099',	'cMgTrKUm',	'jMc6QM23Uq',	'2025-05-13 03:23:20',	'2025-05-13 03:23:20'),
(46,	'Prof. Ellis Rohan',	'gabrielle.jast@example.net',	'OooumAUq',	'2025-05-13 03:23:20',	'$2y$12$kMzvPit5dsoWA/cVLNv4zOgZd9hMufU5wV0x8RwRy75RqD1uTNhjW',	7286.00,	'1-618-690-1166',	'YyhBm52f',	'VqGzy6f3Fa',	'2025-05-13 03:23:20',	'2025-05-13 03:23:20'),
(47,	'Prof. Columbus Johns Jr.',	'flo.oconner@example.com',	'yS3HaEHf',	'2025-05-13 03:23:20',	'$2y$12$ZT9Jd.23LFPiMcjZFFAbpOQDdINQClfDA1fHt1JoiCjzJeEusEUOi',	5212.00,	'+1-339-873-4126',	'cqMppWN1',	'jmEFWJxWQL',	'2025-05-13 03:23:20',	'2025-05-13 03:23:20'),
(48,	'Dr. Milan Kutch',	'zwilkinson@example.com',	'kDaqn9yU',	'2025-05-13 03:23:20',	'$2y$12$IHyHjxJckkMDsoRlx2/zXu3RDO85XHQax0BhHIGemZIpUyfW6/o6e',	9667.00,	'+1-806-348-7984',	'TnfATpj2',	'jWjqnvwMbJ',	'2025-05-13 03:23:21',	'2025-05-13 03:23:21'),
(49,	'Prof. Wilfredo Gulgowski',	'kaelyn91@example.com',	'RDdpvtQN',	'2025-05-13 03:23:21',	'$2y$12$nVFhepk5NsnBPv6zuB1vWumRNgs.8khC7EXZiLm1Z3Vy0JOK09Fn6',	4664.00,	'+1.562.446.2431',	'8uvHIyCq',	'2YKNI5Uf6s',	'2025-05-13 03:23:21',	'2025-05-13 03:23:21'),
(50,	'Dixie Kirlin',	'gideon03@example.com',	'nTZXGURU',	'2025-05-13 03:23:21',	'$2y$12$YBqI097OmAHG6eSgCKjbleNZ/0kadcaS9QcmNURBav3FoezwkXbEq',	8690.00,	'1-469-797-8136',	'2gvb4tif',	'Qp229CPSmn',	'2025-05-13 03:23:21',	'2025-05-13 03:23:21'),
(51,	'Dr. Breanne Prosacco PhD',	'haven36@example.net',	'Zg78gE82',	'2025-05-13 03:23:21',	'$2y$12$H1WUvbbxMJPrG0jwZdY/duJ3B8a2Xq1b/GNYTqe4GDk48UPCtBwG2',	7747.00,	'+1.740.900.6570',	'2th0JCqG',	'Nu7EdDk3ZE',	'2025-05-13 03:23:21',	'2025-05-13 03:23:21'),
(52,	'Mrs. Tanya Kerluke',	'cartwright.pasquale@example.com',	'eh8FCM5n',	'2025-05-13 03:23:21',	'$2y$12$HRRDT3EPF18dcNBjroR8uOP3JFXSW6797kslP7ZjPxWExd.kHxk/u',	8382.00,	'1-854-341-7915',	'T7DtKTqv',	'MBjOgJHDBO',	'2025-05-13 03:23:22',	'2025-05-13 03:23:22'),
(53,	'Miss Juliet Berge',	'karson.senger@example.net',	'Me5Aq6AF',	'2025-05-13 03:23:22',	'$2y$12$KbznciIN3En4mGAlNt2Yc.k3fLUBW.hhQq4fVr3fQ3LoCaHwAgV1.',	5339.00,	'520-743-3064',	'2QBdBGlW',	'd1OCEy1Xwz',	'2025-05-13 03:23:22',	'2025-05-13 03:23:22'),
(54,	'Dr. Brionna Hammes I',	'opal35@example.com',	'CWq5lTmn',	'2025-05-13 03:23:22',	'$2y$12$UUAjP0UlNRzqxvspDTFB..yNDHebR9kVhmeP64h.k.pyZtt2btK86',	5189.00,	'+1-640-244-0239',	'90VIId7O',	'YxXLGsu0Ax',	'2025-05-13 03:23:22',	'2025-05-13 03:23:22'),
(55,	'Triston Koepp',	'eric79@example.net',	'cshGba1a',	'2025-05-13 03:23:22',	'$2y$12$QaVUwWU40v7xCQGA2SNwJ.4qBmRY6xx9VCg8pIHmbqgwDTEfGt0aq',	2777.00,	'212-824-5314',	'QSfbERVW',	'6heGQVBGJG',	'2025-05-13 03:23:22',	'2025-05-13 03:23:22'),
(56,	'Filomena Ratke',	'xpurdy@example.net',	'S87ISTK2',	'2025-05-13 03:23:22',	'$2y$12$9FOZCfSbOcEiMW9Ony0onOlEvTqaRH6YWtxnwJ7vcXbIC4eeqyuTy',	8042.00,	'+19544757405',	'kDaqn9yU',	'6tmf7wimB7',	'2025-05-13 03:23:22',	'2025-05-13 03:23:22'),
(57,	'Opal Schowalter',	'marcos.hettinger@example.net',	'qkANJ2ip',	'2025-05-13 03:23:22',	'$2y$12$kv2LXgeYjUtU.6svyiN56Oo.gbRsKvGWkNT8V053Flj37AkIQUV6W',	5931.00,	'+1.623.324.4928',	'nTZXGURU',	'IXzVCSbiBh',	'2025-05-13 03:23:23',	'2025-05-13 03:23:23'),
(58,	'Mrs. Linnea Yundt',	'glittel@example.org',	'FK7RUzaz',	'2025-05-13 03:23:23',	'$2y$12$IygrGLBDj2DtUds//zvfLerEz8RiKZTQWoSzFoj1xXcHM/Vs21.0q',	5710.00,	'769-357-6408',	'CWq5lTmn',	'cwPklcXjCf',	'2025-05-13 03:23:23',	'2025-05-13 03:23:23'),
(59,	'Maia Ortiz',	'modesto01@example.com',	'Gb0dTFdP',	'2025-05-13 03:23:23',	'$2y$12$L9ooZcxOYRmlvDB1reFKxu3IuB7bH7i9VRwmlloHn4uGQC8G0hfKy',	6841.00,	'+1.276.982.6414',	'5V3YHPpm',	'ihIcdDpa2y',	'2025-05-13 03:23:23',	'2025-05-13 03:23:23'),
(60,	'Stan Ziemann',	'barrows.van@example.net',	'FZRKsUh1',	'2025-05-13 03:23:23',	'$2y$12$.otEEhEQJdpzgWIEh3V9m.kYvKCVexK2/dCp//8lU1EL90zZBH9Hu',	8819.00,	'(512) 629-6379',	'40bLVlZa',	'MaCIDKGzJX',	'2025-05-13 03:23:23',	'2025-05-13 03:23:23'),
(61,	'Mr. Eldon Hintz',	'jevon.howe@example.net',	'Y88KgaLF',	'2025-05-13 03:23:23',	'$2y$12$zfoWPN6juZS/qsAVh/xuCeoYyeLeqzx1OTCB.bk1QoA2W7qyazsM2',	3550.00,	'(706) 434-9311',	'FK7RUzaz',	'WsTsq4pmk1',	'2025-05-13 03:23:23',	'2025-05-13 03:23:23'),
(62,	'Dr. Samanta Trantow',	'smitham.sebastian@example.org',	'Ogv2DnQV',	'2025-05-13 03:23:23',	'$2y$12$EyUgeAV4CDKxwqgtZF8kP.gOZtrKr8VE.pLMIlftur7tn/H0esRNW',	1282.00,	'+1 (586) 267-6521',	'aAOYy2zb',	'YedFC9jwWQ',	'2025-05-13 03:23:24',	'2025-05-13 03:23:24'),
(63,	'Domenic Swift',	'kyundt@example.org',	'qzvabMD2',	'2025-05-13 03:23:24',	'$2y$12$QYkqj6vQc8q.9weUWK.1aOqzYtPJ3iB1DWvMok/UrB0osLVbvhHtq',	5985.00,	'1-641-427-5816',	'YyhBm52f',	'AFRvrNHCLv',	'2025-05-13 03:23:24',	'2025-05-13 03:23:24'),
(64,	'Alberto Waelchi',	'osinski.jarrell@example.org',	'5OnSAaMC',	'2025-05-13 03:23:24',	'$2y$12$XGbCPErn3Lzsrv4nwGVG5OjaZlS3Ci4R05usoThTWriD4kY6YXZKG',	8153.00,	'+1-331-235-1396',	'kDaqn9yU',	'3x46DHe0ra',	'2025-05-13 03:23:24',	'2025-05-13 03:23:24'),
(65,	'Trace Abshire',	'madilyn37@example.net',	'zEv7uwLp',	'2025-05-13 03:23:24',	'$2y$12$qDpdiTIe4Ed3QH1m.HCPY.spNtPBxvZXg1JXWh8kX8R/FHxBWp/62',	7304.00,	'+1 (564) 417-4144',	'qzvabMD2',	'OIB2dvBZRF',	'2025-05-13 03:23:24',	'2025-05-13 03:23:24'),
(66,	'Prof. Faye Kuphal',	'nienow.rolando@example.org',	'g0Cs7PnN',	'2025-05-13 03:23:24',	'$2y$12$F7F2uMvdaAuBAPvUCfgw/OPfsngbyu6w4nTLa5Zt3zi9kgaHKHO1K',	9293.00,	'747.880.2900',	'Ogv2DnQV',	'VOYGqsoDwo',	'2025-05-13 03:23:25',	'2025-05-13 03:23:25'),
(67,	'Roma O\'Connell',	'erdman.javonte@example.com',	'3LSvUgGp',	'2025-05-13 03:23:25',	'$2y$12$LFCeIJsDmvCva8oBtqAJKe1UB0.ZvkCeWe2Q1mc9n38/A59y0qdNe',	7936.00,	'+1-757-774-9113',	'eh8FCM5n',	'bHif5fqrvs',	'2025-05-13 03:23:25',	'2025-05-13 03:23:25'),
(68,	'Heber Will',	'bogisich.margarett@example.com',	'yNKbIiVN',	'2025-05-13 03:23:25',	'$2y$12$LjIBoIskQGTteCH8K46XaO1e1KzxiTAYp06L.jaUorzE.oqQdlHAK',	8401.00,	'1-689-954-0300',	'daLvzhXI',	's6H4VGVqP2',	'2025-05-13 03:23:25',	'2025-05-13 03:23:25'),
(69,	'Prof. Chelsey Keebler',	'tyrell62@example.org',	'Std4Zwve',	'2025-05-13 03:23:25',	'$2y$12$JWOTHK0WbFp3RRo3P3pbc.UNxulKWWRCe4CHbINQ.szEqedfSNIV2',	8300.00,	'+1-731-401-1266',	'Me5Aq6AF',	'AUpn0VXJFE',	'2025-05-13 03:23:25',	'2025-05-13 03:23:25'),
(70,	'Amos Mills',	'mcdermott.pink@example.com',	'6fuGhFaU',	'2025-05-13 03:23:25',	'$2y$12$aFOYS9PC77sM6v7zFtPluOkZ2hwDZuzLbcxa4iQ.6NsevGwrw6EEy',	3078.00,	'762-469-0100',	'CWq5lTmn',	'SEaTlafdc6',	'2025-05-13 03:23:25',	'2025-05-13 03:23:25'),
(71,	'Claudie Gerlach',	'oma.upton@example.org',	'pQfi1odA',	'2025-05-13 03:23:25',	'$2y$12$IF5mlovmJmiLEtxkTLCdIO3UXOok/xqUXwFRMgo.ZQmXhXUH9ytRy',	5767.00,	'+1.479.750.0043',	'QI3XtLwf',	'4ihzDu9MzS',	'2025-05-13 03:23:26',	'2025-05-13 03:23:26'),
(72,	'Kellie Morar',	'jokuneva@example.org',	'PU2O6iJD',	'2025-05-13 03:23:26',	'$2y$12$qLwoBQQbKFFDpJwek03V7OAvLxnS4Bj1M4KqILskpdKOuqb2Rvu/2',	9191.00,	'503.307.1899',	'U05M8ACz',	'mZ2WDOY4Ul',	'2025-05-13 03:23:26',	'2025-05-13 03:23:26'),
(73,	'Devonte Robel',	'cbarton@example.net',	'KBLSm1G0',	'2025-05-13 03:23:26',	'$2y$12$bcGoTm48n9UjmJfEIj/04ekX.yifYumWPEUaFzZu6ZSMxqUC/3qkO',	9370.00,	'(660) 982-0777',	'pQfi1odA',	'HKmTEx769t',	'2025-05-13 03:23:26',	'2025-05-13 03:23:26'),
(74,	'Scottie Runolfsdottir II',	'esanford@example.org',	'0yYhsnPg',	'2025-05-13 03:23:26',	'$2y$12$RS71rRA0ShGL1JVoAEr8OO2s1fUs/XiHXAZThj7IYkJZlQIL7dckG',	5515.00,	'802-932-9752',	'Wze6N6HM',	'KJNB8ZNLca',	'2025-05-13 03:23:26',	'2025-05-13 03:23:26'),
(75,	'Ruben Jast III',	'umuller@example.com',	'YWwIUYJv',	'2025-05-13 03:23:26',	'$2y$12$YZKRbl7Ug925IMzodxuWZO0Mk7/G1Jw5amv4aYIo6o3bjmo2qwZ.u',	9245.00,	'586-502-7603',	'Std4Zwve',	'JMtWdnHpe3',	'2025-05-13 03:23:27',	'2025-05-13 03:23:27'),
(76,	'Maynard Steuber',	'pweber@example.net',	'BIBd3z2x',	'2025-05-13 03:23:27',	'$2y$12$Ki7BfmERCVifIlo49xAN2O1.mK1kl0Wcuqn2EDdNLYUvmJ7xxu9RG',	8314.00,	'669-760-8613',	'N3C3r72H',	'CopfsQVaea',	'2025-05-13 03:23:27',	'2025-05-13 03:23:27'),
(77,	'Jarrett Lind',	'wdenesik@example.net',	'65WHrnO9',	'2025-05-13 03:23:27',	'$2y$12$RKGOGYXb4xuDOk00k4kh2e6pe6BWPTPASiR3zx.D4Eq/kX5yyhz4a',	6389.00,	'410-982-2394',	'N3C3r72H',	'sm2M9aSI1t',	'2025-05-13 03:23:27',	'2025-05-13 03:23:27'),
(78,	'Rosanna Schaefer',	'koelpin.ursula@example.com',	'E4V9k7pc',	'2025-05-13 03:23:27',	'$2y$12$4s7yqhh401xkLxBY3hl33u9CLRW3uHtk7xAHJPKqQTtB/16LCufdO',	6073.00,	'(225) 220-7865',	'5V3YHPpm',	'wQ583f7UP4',	'2025-05-13 03:23:27',	'2025-05-13 03:23:27'),
(79,	'Demario Turcotte',	'kaley.turner@example.org',	'vSToUgN4',	'2025-05-13 03:23:27',	'$2y$12$h7COLDC636ewv6GIK4fMTuyWawdeOk4GG6OeliVaXgfQRTrEoYoJa',	3089.00,	'+1 (719) 487-8489',	'cqMppWN1',	'adZKfIuAoV',	'2025-05-13 03:23:27',	'2025-05-13 03:23:27'),
(80,	'Nicholas Harvey',	'zemlak.jacklyn@example.net',	'guEdSmst',	'2025-05-13 03:23:27',	'$2y$12$lQBujABj.qUh.EGZc.G.buMUB0kNca9pmK62la8YfCo9nKh7HHlBu',	3452.00,	'+18206790671',	'Ch42Yo20',	'3hbX2nxZdq',	'2025-05-13 03:23:28',	'2025-05-13 03:23:28'),
(81,	'Alycia Nicolas III',	'mcdermott.albin@example.org',	'vJqkLw0g',	'2025-05-13 03:23:28',	'$2y$12$Omt8TI/HPD17S/gBHa5mCuiW7Vagh1nnlYeTjUYfI/0wjfKbus.0O',	9550.00,	'+1.847.864.1365',	'cshGba1a',	'E2cIn1NI2o',	'2025-05-13 03:23:28',	'2025-05-13 03:23:28'),
(82,	'Ima Dare',	'hills.hadley@example.com',	'ZY7vaNJG',	'2025-05-13 03:23:28',	'$2y$12$H.MWqnch4YaYm19Y3U5iCO1A3/eC19F0NXLz3NLcvV8vLr.QshcWS',	5308.00,	'+15203578694',	'FK7RUzaz',	'BPJrtsOLcd',	'2025-05-13 03:23:28',	'2025-05-13 03:23:28'),
(83,	'Emely Mills',	'cummings.ottilie@example.com',	'j6O0e1Ra',	'2025-05-13 03:23:28',	'$2y$12$WEYvorJzcSMIVpilE74DkeuxUP4PoWdsrA9tXKkLZLKTmKIrF9fhG',	6688.00,	'260-975-8602',	'vJqkLw0g',	'wzR49izjUx',	'2025-05-13 03:23:28',	'2025-05-13 03:23:28'),
(84,	'Louvenia Hickle',	'dylan06@example.org',	'4bo5YtjA',	'2025-05-13 03:23:28',	'$2y$12$/eLJzmdj3NtPdxfcC2fiGuP/l2Ke0/2rPTN0ktcnLKzM3R8kXviOi',	5385.00,	'+1 (734) 945-4896',	'yNKbIiVN',	'GMGjV3EXuZ',	'2025-05-13 03:23:28',	'2025-05-13 03:23:28'),
(85,	'Myrl Orn',	'vernie.carter@example.com',	'SZtt4gg7',	'2025-05-13 03:23:28',	'$2y$12$M/48fC8ZoJKnCpvBDgEHGuMBC1nk8jkEZLaxpyukrA2lsj2ztrkLi',	3798.00,	'539.935.0647',	'S87ISTK2',	'Mw3W0mJbZD',	'2025-05-13 03:23:29',	'2025-05-13 03:23:29'),
(86,	'Prof. Kolby Mertz Jr.',	'megane.marquardt@example.org',	'2GCaCf4i',	'2025-05-13 03:23:29',	'$2y$12$OEQFFrv.rFzaPYUKM5ocX.Br18k/GlcVW/qKM56ibnlIRJGa3FMVi',	2897.00,	'+1.320.241.7192',	'oXYVcvYx',	'xjKNUOlzxU',	'2025-05-13 03:23:29',	'2025-05-13 03:23:29'),
(87,	'Annabell Braun I',	'jody.gusikowski@example.com',	'StOW0lkS',	'2025-05-13 03:23:29',	'$2y$12$xhGIUbwzuW4dSAJphROFfeKyI3unSghnxQAKCG7juXqknrUx5eYuu',	7272.00,	'+1-610-207-6689',	'aAOYy2zb',	'soDy398RwP',	'2025-05-13 03:23:29',	'2025-05-13 03:23:29'),
(88,	'Elenora Donnelly',	'vanessa07@example.net',	'4ExYksqv',	'2025-05-13 03:23:29',	'$2y$12$XzmnKLn2ccwYcqr4Ruq19ex40XRNzWny4KVwUMIVxmcCQG3kg3Ku2',	6385.00,	'989-950-7943',	'rYzGa2Nb',	'NQB4Xy43Xm',	'2025-05-13 03:23:29',	'2025-05-13 03:23:29'),
(89,	'Harmon Hudson',	'beahan.camila@example.org',	'7kH0g5bf',	'2025-05-13 03:23:29',	'$2y$12$9Cgzsnfaa6dmY4b7pfdtIOJzsMXaA7jX5r7BuRbbPp0QHfDzDp/le',	1425.00,	'980-870-9462',	'U1QNRBcg',	'wCoUIA3myV',	'2025-05-13 03:23:30',	'2025-05-13 03:23:30'),
(90,	'Prof. Vickie Bradtke',	'will.colin@example.net',	'6BzcSWsF',	'2025-05-13 03:23:30',	'$2y$12$aEFlgxUuQYeEVrGQe4THu.2ui8b3QKr22yYiCb2xufC0fcvxb5Fdm',	9047.00,	'484.353.2547',	'N3C3r72H',	'kNlgEYnCTa',	'2025-05-13 03:23:30',	'2025-05-13 03:23:30'),
(91,	'Leila Metz',	'ihodkiewicz@example.org',	'IRWgsl4v',	'2025-05-13 03:23:30',	'$2y$12$blc8A.YnVSAgbEDYPyXptO9bhrDBAOpjuwQbKYXH5ijGno7AZJYEO',	9996.00,	'+1-339-691-0170',	'QI3XtLwf',	'R1RrIFaSLG',	'2025-05-13 03:23:30',	'2025-05-13 03:23:30'),
(92,	'Terry Sauer',	'windler.art@example.org',	'eN5dZpMO',	'2025-05-13 03:23:30',	'$2y$12$ZJFUdywGnFac6ND.jqYPeu2NW5jgewEwpZIYRd2gNg9EeuImnRatO',	2906.00,	'651.780.7011',	'E8DyFWvY',	'WOXp42LNnP',	'2025-05-13 03:23:30',	'2025-05-13 03:23:30'),
(93,	'Christian Dicki',	'stamm.stacy@example.net',	'mbxny6SF',	'2025-05-13 03:23:30',	'$2y$12$0QKTDxMEOAKKAJHkTzkmuORe6dPIWELRujNCWJ13sSPPEfYVuIyiq',	2494.00,	'573.422.9707',	'aAOYy2zb',	'3SPBSqwFT2',	'2025-05-13 03:23:30',	'2025-05-13 03:23:30'),
(94,	'Addison McClure',	'watsica.eleonore@example.org',	'yxnCOlLe',	'2025-05-13 03:23:30',	'$2y$12$.CpRfNILyzC4KqODFrzZqe74x7jEDzf/vouDjqAtkaBVG/g6DKgH6',	3435.00,	'1-737-536-6671',	'M2arc2LT',	'2dFM0QqZli',	'2025-05-13 03:23:31',	'2025-05-13 03:23:31'),
(95,	'Chelsea Beier',	'alvis.hackett@example.com',	'LSfiICdu',	'2025-05-13 03:23:31',	'$2y$12$6aZxjau8Xy1R.9NhQ4omMOkrp5ZCl9Ic/0gQn1v9sJKGizbLL53rS',	6350.00,	'+1-816-661-3018',	'mLnmTI5o',	'vivQYa5dSs',	'2025-05-13 03:23:31',	'2025-05-13 03:23:31'),
(96,	'Dr. Marquis Fay',	'maiya10@example.org',	'2BD3BlLl',	'2025-05-13 03:23:31',	'$2y$12$c0H17S4vQG0q6.tt.TUDWOPn78Zhi9F2aqvFLzfhyAwQEOYCJuNbq',	5037.00,	'+1-641-674-4900',	'2GCaCf4i',	'lgZVp7JqzO',	'2025-05-13 03:23:31',	'2025-05-13 03:23:31'),
(97,	'Dr. Khalid Bechtelar V',	'bette.walsh@example.com',	'P6zcPzWh',	'2025-05-13 03:23:31',	'$2y$12$GXR3iXDEJ.YIZ76faoPyBeAncwyJ/SCEkLnHBKhwpltI4Vgn90juC',	4108.00,	'(920) 949-0938',	'4ExYksqv',	'EqsX5iDQRC',	'2025-05-13 03:23:31',	'2025-05-13 03:23:31'),
(98,	'Mr. Laurel Reichel',	'astrid.barton@example.com',	'CxnRZ9aC',	'2025-05-13 03:23:31',	'$2y$12$QexontnO1h7HR4dXoxeRIu4he8iuura0itGodn3vrOtWABJPWIYoG',	1699.00,	'228-640-3446',	'g0Cs7PnN',	'EGZYKfW5LB',	'2025-05-13 03:23:31',	'2025-05-13 03:23:31'),
(99,	'Hilton Streich',	'oquigley@example.net',	'CANQGTVt',	'2025-05-13 03:23:31',	'$2y$12$wD5msbIzqO08fyjn.Nz40Ow11KvpH/RP4xytjq2qU6LluGArXX.pG',	1960.00,	'862.527.8006',	'BU6erkC2',	'89Gp6ObbXZ',	'2025-05-13 03:23:32',	'2025-05-13 03:23:32'),
(100,	'Keyshawn Romaguera I',	'myrtie48@example.com',	'5z6ReV2P',	'2025-05-13 03:23:32',	'$2y$12$7mcLH9HgHN07nwEfZ4YnM.vUMviO/s2y4KY4GHlMoMHyoyqUrtlKG',	6875.00,	'+15204409262',	'0yYhsnPg',	'hyuEHRbW2r',	'2025-05-13 03:23:32',	'2025-05-13 03:23:32');

-- 2025-05-13 08:55:34
