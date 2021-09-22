
-- THIS IS THE VERSION 0 --

CREATE TABLE `users`(
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` int(1) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL,
  UNIQUE (`email`),
  PRIMARY KEY(`id`)
);

CREATE TABLE `categories`
(
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL,
  PRIMARY KEY(`id`)
);

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text,
  `price` decimal(15,2) UNSIGNED NOT NULL,
  `image` text,
  `quantity` int(11) UNSIGNED NOT NULL,
  `max_order` int(11) DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL,
  PRIMARY KEY(`id`),
  FOREIGN KEY(`category_id`) REFERENCES `categories`(`id`)
);

CREATE TABLE `carts` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY(`id`),
  CONSTRAINT fk_carts_users FOREIGN KEY(`user_id`) 
    REFERENCES `users`(`id`),
  CONSTRAINT fk_carts_products FOREIGN KEY(`product_id`) 
    REFERENCES `products`(`id`)
);

CREATE TABLE `favorites` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY(`id`),
  CONSTRAINT fk_favorites_users FOREIGN KEY(`user_id`)
    REFERENCES `users`(`id`),
  CONSTRAINT fk_favories_products FOREIGN KEY(`product_id`)
    REFERENCES `products`(`id`)
);

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `status` int(1) UNSIGNED NOT NULL,
  `recipient_firstname` varchar(50) NOT NULL,
  `recipient_lastname` varchar(50) NOT NULL,
  `region` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `municipality` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `street` varchar(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `shipping_fee` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY(`id`),
  FOREIGN KEY(`user_id`) REFERENCES `users`(`id`)
);

CREATE TABLE `order_items` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) UNSIGNED NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY(`id`),
  CONSTRAINT fk_order_items_orders FOREIGN KEY(`order_id`)
    REFERENCES `orders`(`id`),
  CONSTRAINT fk_order_items_products FOREIGN KEY(`product_id`)
    REFERENCES `products`(`id`)
);

CREATE TABLE `user_info` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `region` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `province` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `municipality` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `barangay` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `street` varchar(90) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `unit` varchar(90) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY(`id`),
  FOREIGN KEY(`user_id`) REFERENCES `users`(`id`)
);

-- SEEDS --

INSERT INTO `categories` (`id`, `name`, `modified_at`) VALUES
(1, 'TV & Video', NULL),
(2, 'Audio & Home Theater', NULL),
(3, 'Computer', NULL),
(4, 'Laptop', NULL),
(5, 'Wearable Technology', NULL),
(6, 'Car Electronics & GPS', NULL),
(7, 'Portable Audio', NULL),
(8, 'Cell Phone', NULL),
(9, 'Office Electronics', NULL),
(10, 'Camera & Photo', NULL);

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `image`, `quantity`, `max_order`, `modified_at`) VALUES
(13, 4, 'Apple MacBook Pro 15\" Touch Bar MPTU2LL/A 256GB (Silver)', NULL, '25999.50', 'storage/uploads/product/product1.jpg', 4, 1, NULL);

INSERT INTO `users` (`id`, `role`, `email`, `password`, `firstname`, `lastname`, `modified_at`) VALUES
(9, 1, 'lenard.mangayayam@gmail.com', '$2y$10$/UfxIDMyPqz8srM9lUdJ8Oe7.U4ceUJZQXK3RPDB2fzyqP7ILg83G', 'John-Lenard', 'Mangay-ayam', '2021-09-14 06:01:51');

INSERT INTO `user_info` (`id`, `user_id`, `region`, `province`, `municipality`, `barangay`, `street`, `unit`, `phone`, `modified_at`) VALUES
(1, 9, 'NCR', 'NATIONAL CAPITAL REGION - THIRD DISTRICT', 'CALOOCAN CITY', 'BARANGAY 188', 'MRH NHA SITE 4', 'BLdg.2a 2nd Floor Unit 10', '09384379875', '2021-09-14 05:01:50');
