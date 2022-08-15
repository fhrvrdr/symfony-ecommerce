-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: database
-- Üretim Zamanı: 14 Ağu 2022, 17:27:47
-- Sunucu sürümü: 8.0.30
-- PHP Sürümü: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `symfony_docker`
--
CREATE DATABASE IF NOT EXISTS `symfony_docker` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `symfony_docker`;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cart_item`
--

CREATE TABLE `cart_item` (
  `id` int NOT NULL,
  `session_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `modified_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `parent_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `modified_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `category`
--

INSERT INTO `category` (`id`, `parent_id`, `name`, `created_at`, `modified_at`) VALUES
(32, NULL, 'Men', '2022-08-10 15:22:06', '2022-08-10 15:22:06'),
(33, 32, 'Shoes', '2022-08-10 15:22:12', '2022-08-10 15:22:12'),
(34, 32, 'Clothes', '2022-08-10 15:22:19', '2022-08-10 15:22:19'),
(35, NULL, 'Women', '2022-08-10 15:22:27', '2022-08-10 15:22:27'),
(36, 35, 'Shoes', '2022-08-10 15:22:33', '2022-08-10 15:22:33'),
(37, 35, 'Clothes', '2022-08-10 15:22:39', '2022-08-10 15:22:39'),
(38, 36, 'Sneakers', '2022-08-10 18:54:20', '2022-08-10 18:54:20');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `discount`
--

CREATE TABLE `discount` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `modified_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `category_id` int DEFAULT NULL,
  `percent` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `discount`
--

INSERT INTO `discount` (`id`, `name`, `description`, `active`, `created_at`, `modified_at`, `category_id`, `percent`) VALUES
(3, 'Fifty Percent', 'Fifty percent discount for second product.', 1, '2022-08-10 15:23:31', '2022-08-10 15:23:31', NULL, 50),
(4, '3 to 1', 'Buy 3 pay 2', 1, '2022-08-10 15:24:07', '2022-08-10 15:24:07', 33, 100);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Tablo döküm verisi `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220804092635', '2022-08-04 09:26:48', 143),
('DoctrineMigrations\\Version20220804113013', '2022-08-04 11:30:51', 193),
('DoctrineMigrations\\Version20220804201638', '2022-08-04 20:16:43', 219),
('DoctrineMigrations\\Version20220805190005', '2022-08-05 19:00:23', 788),
('DoctrineMigrations\\Version20220805191007', '2022-08-05 19:10:15', 194),
('DoctrineMigrations\\Version20220806110003', '2022-08-06 11:00:17', 689),
('DoctrineMigrations\\Version20220806110901', '2022-08-06 11:09:12', 101),
('DoctrineMigrations\\Version20220806140506', '2022-08-06 14:07:43', 482),
('DoctrineMigrations\\Version20220806205135', '2022-08-06 20:51:52', 331),
('DoctrineMigrations\\Version20220807214713', '2022-08-07 21:47:22', 327),
('DoctrineMigrations\\Version20220808140046', '2022-08-08 14:00:55', 203),
('DoctrineMigrations\\Version20220808142646', '2022-08-08 14:26:53', 105),
('DoctrineMigrations\\Version20220808142726', '2022-08-08 14:27:46', 84),
('DoctrineMigrations\\Version20220808193945', '2022-08-08 19:40:03', 272),
('DoctrineMigrations\\Version20220808220018', '2022-08-08 22:00:25', 113);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_details`
--

CREATE TABLE `order_details` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `modified_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `status` tinyint(1) NOT NULL,
  `total_price` double NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `order_details`
--

INSERT INTO `order_details` (`id`, `user_id`, `created_at`, `modified_at`, `status`, `total_price`, `payment_type`) VALUES
(32, 7, '2022-08-10 15:56:07', '2022-08-10 15:56:07', 1, 500, 'door'),
(33, 6, '2022-08-10 18:30:14', '2022-08-10 18:30:14', 1, 800, 'door'),
(34, 6, '2022-08-10 18:49:54', '2022-08-10 18:49:54', 1, 950, 'door'),
(37, 7, '2022-08-10 18:52:54', '2022-08-10 18:52:54', 1, 600, 'door');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_details_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `modified_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `order_items`
--

INSERT INTO `order_items` (`id`, `order_details_id`, `product_id`, `quantity`, `created_at`, `modified_at`) VALUES
(34, 32, 12, 2, '2022-08-10 15:56:07', '2022-08-10 15:56:07'),
(35, 32, 13, 1, '2022-08-10 15:56:07', '2022-08-10 15:56:07'),
(36, 33, 12, 2, '2022-08-10 18:30:14', '2022-08-10 18:30:14'),
(37, 33, 13, 1, '2022-08-10 18:30:14', '2022-08-10 18:30:14'),
(38, 33, 14, 2, '2022-08-10 18:30:14', '2022-08-10 18:30:14'),
(39, 34, 12, 3, '2022-08-10 18:49:54', '2022-08-10 18:49:54'),
(40, 34, 13, 2, '2022-08-10 18:49:54', '2022-08-10 18:49:54'),
(41, 37, 12, 1, '2022-08-10 18:52:54', '2022-08-10 18:52:54'),
(42, 37, 13, 2, '2022-08-10 18:52:54', '2022-08-10 18:52:54'),
(43, 37, 14, 1, '2022-08-10 18:52:54', '2022-08-10 18:52:54');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL,
  `discount_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `modified_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `slug`, `stock`, `discount_id`, `created_at`, `modified_at`, `image_path`, `image_path_2`, `image_path_3`) VALUES
(12, 'Erkek Bot', '<h1>Erkek Bot</h1><pre>Kaliteli Bot</pre>', 250, 'erkek-bot', 142, NULL, '2022-08-10 15:29:48', '2022-08-10 15:29:48', 'erkek-bot-1-bccafa77-87ea-4542-b182-3f4521529ebf.jpg', 'erkek-bot-2-5a62e045-77bc-44c9-b28c-817075466dce.jpg', 'erkek-bot-3-d1bc20ae-4260-4539-90b7-dd67800880dc.jpg'),
(13, 'Erkek Spor Ayakkabı', '<h1>Spor Ayakkabı</h1><div>Erkek spor ayakkabı</div>', 200, 'erkek-spor-ayakkabi', 144, NULL, '2022-08-10 15:30:59', '2022-08-10 15:30:59', 'erkek-spor-1-d41fe8d9-89fe-4fcb-bd24-2e5c78c4c885.jpg', 'erkek-spor-2-39b039b8-4dae-40cb-8112-e07424fcb8a8.jpg', 'erkek-spor-3-0bfd9c2e-fa99-49a9-8648-6e03628568ef.jpg'),
(14, '3 Adet Tişört', '<h1>3lü tişört paketi</h1><div>Açıklama</div>', 150, '3-adet-tisort', 197, NULL, '2022-08-10 15:31:48', '2022-08-10 15:31:48', 'erkek-t-shirt-1-eb5ef642-8aba-485a-b63f-78d66c00c57e.jpg', 'erkek-t-shirt-2-ff555c32-f731-4712-bf37-49df757e0326.jpg', 'erkek-t-shirt-3-c4f79648-16e4-471f-8ac1-7d59f152f2dc.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product_category`
--

CREATE TABLE `product_category` (
  `product_id` int NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `product_category`
--

INSERT INTO `product_category` (`product_id`, `category_id`) VALUES
(12, 32),
(12, 33),
(13, 32),
(13, 33),
(14, 32),
(14, 34);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `shopping_session`
--

CREATE TABLE `shopping_session` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `total` double NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `modified_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `shopping_session`
--

INSERT INTO `shopping_session` (`id`, `user_id`, `total`, `created_at`, `modified_at`) VALUES
(15, 6, 0, '2022-08-10 15:21:52', '2022-08-10 15:21:52'),
(16, 7, 0, '2022-08-10 15:32:45', '2022-08-10 15:32:45');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `modified_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `created_at`, `modified_at`, `name`, `surname`) VALUES
(6, 'admin@example.com', '[\"ROLE_ADMIN\"]', '$2y$13$5yP2dkyOcU2i0ZExp1WZpeRMMsRfzkp248HmnwRmj9o3dfkDoYMPu', '2022-08-10 15:21:40', '2022-08-10 15:21:40', 'Fahri', 'Vardar'),
(7, 'customer@example.com', '[]', '$2y$13$FZC/O3PdSPVcF.Mvzy4RSOJK6jLkMYiytARrX4RpiextZPSckNv52', '2022-08-10 15:21:41', '2022-08-10 15:21:41', 'Customer', 'Customer');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_adress`
--

CREATE TABLE `user_adress` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `adress` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `modified_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `user_adress`
--

INSERT INTO `user_adress` (`id`, `user_id`, `adress`, `title`, `city`, `country`, `telephone`, `created_at`, `modified_at`) VALUES
(5, 7, 'Arnavutköy', 'Home', 'İstanbul', 'Arnavutköy', '123123123', '2022-08-10 15:56:07', '2022-08-10 15:56:07'),
(6, 6, 'deneme', 'Home', 'İstanbul', 'Arnavutköy', '123123', '2022-08-10 18:30:14', '2022-08-10 18:30:14'),
(7, 6, 'deneme', 'Home', 'İstanbul', 'Arnavutköy', '123123123', '2022-08-10 18:51:16', '2022-08-10 18:51:16'),
(8, 7, 'qwe', 'Home', 'İstanbul', 'Arnavutköy', '123123123', '2022-08-10 18:52:54', '2022-08-10 18:52:54');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F0FE2527613FECDF` (`session_id`),
  ADD KEY `IDX_F0FE25274584665A` (`product_id`);

--
-- Tablo için indeksler `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_64C19C1727ACA70` (`parent_id`);

--
-- Tablo için indeksler `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E1E0B40E12469DE2` (`category_id`);

--
-- Tablo için indeksler `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Tablo için indeksler `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Tablo için indeksler `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_845CA2C1A76ED395` (`user_id`);

--
-- Tablo için indeksler `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_62809DB08C0FA77` (`order_details_id`),
  ADD KEY `IDX_62809DB04584665A` (`product_id`);

--
-- Tablo için indeksler `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD4C7C611F` (`discount_id`);

--
-- Tablo için indeksler `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `IDX_CDFC73564584665A` (`product_id`),
  ADD KEY `IDX_CDFC735612469DE2` (`category_id`);

--
-- Tablo için indeksler `shopping_session`
--
ALTER TABLE `shopping_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CECE98A6A76ED395` (`user_id`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Tablo için indeksler `user_adress`
--
ALTER TABLE `user_adress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_39BEDC83A76ED395` (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Tablo için AUTO_INCREMENT değeri `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Tablo için AUTO_INCREMENT değeri `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Tablo için AUTO_INCREMENT değeri `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Tablo için AUTO_INCREMENT değeri `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `shopping_session`
--
ALTER TABLE `shopping_session`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `user_adress`
--
ALTER TABLE `user_adress`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `FK_F0FE25274584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_F0FE2527613FECDF` FOREIGN KEY (`session_id`) REFERENCES `shopping_session` (`id`);

--
-- Tablo kısıtlamaları `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `FK_64C19C1727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`);

--
-- Tablo kısıtlamaları `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `FK_E1E0B40E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Tablo kısıtlamaları `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `FK_845CA2C1A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Tablo kısıtlamaları `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `FK_62809DB04584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_62809DB08C0FA77` FOREIGN KEY (`order_details_id`) REFERENCES `order_details` (`id`);

--
-- Tablo kısıtlamaları `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD4C7C611F` FOREIGN KEY (`discount_id`) REFERENCES `discount` (`id`);

--
-- Tablo kısıtlamaları `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `FK_CDFC735612469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CDFC73564584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `shopping_session`
--
ALTER TABLE `shopping_session`
  ADD CONSTRAINT `FK_CECE98A6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Tablo kısıtlamaları `user_adress`
--
ALTER TABLE `user_adress`
  ADD CONSTRAINT `FK_39BEDC83A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
