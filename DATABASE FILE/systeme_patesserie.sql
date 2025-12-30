-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2021 at 07:57 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- Base de données : `systeme_patesserie`

-- --------------------------------------------------------
-- Table : `categories` (les catégories des produits)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Pastry'),
(2, 'Cake'),
(3, 'Bread'),
(4, 'Cookie'),
(5, 'Muffin');

-- --------------------------------------------------------
-- Table : `media` (les photos des produits)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- Table : `user_groups` (les groupes utilisateurs)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_level` (`group_level`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(2, 'Employee', 2, 1);

-- --------------------------------------------------------
-- Table : `users` (les utilisateurs)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_level` (`user_level`),
  CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(1, 'Rahma Jerbi', 'Admin', 'f865b53623b121fd34ee5426c792e5c33af8c227', 1, 'user1.jpeg', 1, '2025-05-21 05:06:56'),
(2, 'Mohamed Ayoubi', 'employee', 'f816f658a9ce1ab46f772575d9d6a44216588dee', 2, 'user2.jpeg', 1, '2025-05-21 05:01:15');

-- --------------------------------------------------------
-- Table : `products` (les produits)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `buy_price` decimal(10,2) DEFAULT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `categorie_id` int(11) unsigned NOT NULL,
  `media_id` int(11) DEFAULT '0',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `categorie_id` (`categorie_id`),
  KEY `media_id` (`media_id`),
  CONSTRAINT `FK_products` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO `products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`) VALUES
(1, 'Chocolate Éclair', '100', 2.50, 5.00, 1, 1, '2025-01-10 08:15:00'),
(2, 'Almond Croissant', '200', 1.50, 3.00, 1, 2, '2025-03-05 09:30:00'),
(3, 'Red Velvet Cake', '30', 4.00, 8.00, 2, 3, '2025-01-25 11:00:00'),
(4, 'Baguette', '120', 0.80, 1.50, 3, 4, '2025-03-10 15:45:00'),
(5, 'Chocolate Cookie', '300', 0.50, 1.00, 4, 5, '2025-02-12 13:10:00'),
(6, 'Blueberry Muffin', '100', 1.20, 2.50, 5, 6, '2025-03-15 10:30:00');

-- --------------------------------------------------------
-- Table : `sales` (les ventes)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `SK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `sales` (`id`, `product_id`, `qty`, `price`, `date`) VALUES
(1, 1, 20, 5.00, '2025-01-11'),
(2, 2, 35, 3.00, '2025-03-06'),
(3, 3, 10, 8.00, '2025-01-26'),
(4, 4, 50, 1.50, '2025-03-11'),
(5, 5, 100, 1.00, '2025-02-13'),
(6, 6, 40, 2.50, '2025-03-16');

-- --------------------------------------------------------
-- Table : `suppliers` (les fournisseurs)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `company` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Remplir la table `suppliers`

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `address`, `company`) VALUES
(1, 'Pierre Dupont', 'pierre.dupont@deligourmet.fr', '+33 6 12 34 56', '12 Rue des Érables, Paris, France', 'Deli Gourmet'),
(2, 'Amira Ben Salem', 'amira@sucreoriental.tn', '+216 98 123 456', 'Avenue Habib Bourguiba, Sousse, Tunisia', 'Sucre Oriental'),
(3, 'Luca Bianchi', 'luca.bianchi@dolcevita.it', '+39 331 456 789', 'Via Roma 45, Milan, Italy', 'Dolce Vita Ingredients');

-- --------------------------------------------------------


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
