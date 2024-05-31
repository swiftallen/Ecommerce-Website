-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 30, 2024 at 11:02 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multishop`
--
CREATE DATABASE IF NOT EXISTS `multishop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `multishop`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin_email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `admin_password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `admin_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_email`, `admin_password`, `admin_name`) VALUES
(1, 'admin@admin.com', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bannerClass` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bannerImg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bannerText` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bannerDesc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `bannerClass`, `bannerImg`, `bannerText`, `bannerDesc`) VALUES
(1, 'carousel-item position-relative active', 'img/carousel-1.jpg', 'Flat 50% Off On Clothing', 'Enjoy Season End Sale on Top Brands'),
(2, 'carousel-item position-relative', 'img/carousel-2.jpg', '\"Step into Style: Where Every Shoe Tells a Story!\"', 'Up to 60% discount, all stocks must go!'),
(3, 'carousel-item position-relative', 'img/carousel-3.jpg', 'Enjoy Best Offers On Electrical Applicances', '15 days free return|genuine product guarantee|1 year warranty'),
(4, 'carousel-item position-relative', 'img/carousel-4.jpg', 'Buy Fresh Groceries', 'Buy Fresh Groceries On Best Price'),
(9, 'carousel-item position-relative ', 'img/6b322b83696b0815cb6010bff8220070.jpg', 'Discover Tranquility in the Majestic Splendor of Sweden\'s Lakes and Mountains', 'test add descriptions');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `catid` int NOT NULL AUTO_INCREMENT,
  `catimg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `catname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `catproducts` int NOT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catid`, `catimg`, `catname`, `catproducts`) VALUES
(1, 'img/category1.jpg', 'Clothing', 8),
(2, 'img/category2.jpg', 'Footwear', 6),
(3, 'img/category3.jpg', 'Electronic Appliances', 7),
(4, 'img/category4.jpg', 'Groceries', 9),
(5, 'img/smartphone.jpg', 'Smartphone', 8);

-- --------------------------------------------------------

--
-- Table structure for table `featuredproduct`
--

DROP TABLE IF EXISTS `featuredproduct`;
CREATE TABLE IF NOT EXISTS `featuredproduct` (
  `id` int NOT NULL AUTO_INCREMENT,
  `catid` int NOT NULL,
  `img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `newprice` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `oldprice` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `star_rating1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `star_rating2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `star_rating3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `star_rating4` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `star_rating5` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reviews` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `featuredproduct`
--

INSERT INTO `featuredproduct` (`id`, `catid`, `img`, `name`, `newprice`, `oldprice`, `star_rating1`, `star_rating2`, `star_rating3`, `star_rating4`, `star_rating5`, `reviews`) VALUES
(1, 3, 'img/product-1.jpg', 'DSLR Camera', 'RM63.00', 'RM100', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 56),
(2, 1, 'img/product-2.jpg', 'Blue Sweatshirt', 'RM45', 'RM50', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1', 66),
(3, 3, 'img/product-3.jpg', 'Study Lamp', 'RM100', 'RM120', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1', 'far fa-star text-primary mr-1', 34),
(4, 2, 'img/product-4.jpg', 'Men\'s Sneakers', 'RM100', 'RM120', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 100),
(5, 3, 'img/product-5.jpg', 'Drone', 'RM200', 'RM220', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 77),
(6, 3, 'img/product-6.jpg', 'Smart Watch', 'RM150', 'RM177', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 12),
(7, 1, 'img/product-7.jpg', 'Women\'s Top', 'RM15', 'RM45', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 29),
(8, 4, 'img/product-8.jpg', 'Men\'s Cream', 'RM10', 'RM12', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 10),
(14, 1, 'img/546623993b358f2e48925c871b78fa4301d25f1bb09e02256f9d1e7661b9c4fa.jpg', 'lighthouse model', '33', '6', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'far fa-star text-primary mr-2', 'far fa-star text-primary mr-2', 55),
(15, 3, 'img/a65c1a709509a745f7da414257423de49ddacf1ea232c7e58256ad31f94f7f19.jpg', 'Toothbrush', '100', '10000', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'far fa-star text-primary mr-2', 'far fa-star text-primary mr-2', 'far fa-star text-primary mr-2', 22);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `catid` int NOT NULL,
  `pimg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pnewprice` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `poldprice` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `star_rating1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `star_rating2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `star_rating3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `star_rating4` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `star_rating5` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reviews` int NOT NULL,
  `pdesc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `variation` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `catid`, `pimg`, `pname`, `pnewprice`, `poldprice`, `star_rating1`, `star_rating2`, `star_rating3`, `star_rating4`, `star_rating5`, `reviews`, `pdesc`, `variation`) VALUES
(1, 1, 'img/cat-1.jpg', 'Women\'s White T-Shirt', '70', '75', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 24, '0', 0),
(2, 1, 'img/cat1_1.jpg', 'Denim Jeans', '49', '54', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-21', 'fa fa-star text-primary mr-1', 40, '0', 0),
(3, 1, 'img/cat1_2.jpg', 'Light Blue Jeans', '25', '30', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1', 'far fa-star text-primary mr-2', 37, '0', 0),
(4, 1, 'img/cat1_3.jpg', 'Grey T-Shirt', '23', '28', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1', 'far fa-star text-primary mr-1', 40, '0', 0),
(5, 1, 'img/cat1_4.jpg', 'Smiley T-Shirt', '44', '49', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'far fa-star text-primary mr-1', 40, '0', 0),
(6, 1, 'img/cat1_5.jpg', 'Maroon T-Shirt', '33', '38', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1', 23, '0', 0),
(7, 1, 'img/cat1_6.jpg', 'Women\'s Black Top', '61', '66', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1', 31, '0', 0),
(8, 1, 'img/cat1_7.jpg', 'Blue Sweatshirt', '28', '33', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1', 'far fa-star text-primary mr-1', 24, '0', 0),
(9, 2, 'img/cat2_1.png', 'Brown Leather Slippers', '38', '63', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 30, '0', 0),
(10, 2, 'img/cat2_2.jpg', 'Brown Shoes', '32', '59', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-21', 'fa fa-star text-primary mr-1', 27, '0', 0),
(11, 2, 'img/cat2_3.jpeg', 'Brown Heels', '50', '84', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1', 'far fa-star text-primary mr-2', 23, '0', 0),
(12, 2, 'img/cat2_4.jpg', 'Brown Leather Sandals', '58', '85', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1', 'far fa-star text-primary mr-1', 27, '0', 0),
(13, 2, 'img/cat2_5.jpeg', 'Sports Sandals', '52', '43', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'far fa-star text-primary mr-1', 27, '0', 0),
(14, 2, 'img/cat2_6.jpg', 'Sports Shoes', '41', '99', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1', 28, '0', 0),
(15, 3, 'img/cat3_1.jpg', 'DSLR Camera', '60', '99', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 37, '0', 0),
(16, 3, 'img/cat3_2.jpg', 'Lamp', '85', '45', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-21', 'fa fa-star text-primary mr-1', 36, '0', 0),
(17, 3, 'img/cat3_3.jpg', 'Smart Watch', '81', '52', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1', 'far fa-star text-primary mr-2', 34, '0', 0),
(18, 3, 'img/cat3_4.png', 'Laptop', '74', '82', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1', 'far fa-star text-primary mr-1', 40, '0', 0),
(19, 3, 'img/cat3_5.jpg', 'Mobile Phone', '93', '84', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'far fa-star text-primary mr-1', 33, '0', 0),
(20, 3, 'img/cat3_6.jpg', 'Hair Dryer', '73', '98', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1', 39, '0', 0),
(21, 4, 'img/cat4_1.jpg', 'White Bread', '62', '89', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 24, '0', 0),
(22, 4, 'img/cat4_2.jpg', 'Potato', '30', '78', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-21', 'fa fa-star text-primary mr-1', 36, '0', 0),
(23, 4, 'img/cat4_3.jpg', 'Egg', '26', '89', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1', 'far fa-star text-primary mr-2', 22, '0', 0),
(24, 4, 'img/cat4_4.jpg', 'Tomato', '72', '59', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1', 'far fa-star text-primary mr-1', 33, '0', 0),
(25, 4, 'img/cat4_5.jpg', 'Onion', '97', '73', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'far fa-star text-primary mr-1', 30, '0', 0),
(26, 4, 'img/cat4_6.jpg', 'Apple', '53', '77', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1', 35, '0', 0),
(27, 4, 'img/cat4_7.jpg', 'Mango', '94', '32', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1', 30, '0', 0),
(28, 4, 'img/cat4_8.jpg', 'Guava', '3', '9', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1 ', 33, '', 0),
(51, 4, 'img/cat4_9.jpg', 'Grape', '9', '10', 'fa fa-star-half-alt text-primary mr-1 ', 'fa fa-star-half-alt text-primary mr-1 ', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'far fa-star text-primary mr-1', 0, '', 0),
(52, 3, 'img/cat3_7.jpg', 'Drone', '200', '220', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 73, '', 0),
(55, 1, 'img/AlbertaBubbles_EN-US3535339115_1920x1080.jpg', 'beach trip', '33', 'RM35', 'fa fa-star text-primary mr-1', 'fa fa-star text-primary mr-1', 'fa fa-star-half-alt text-primary mr-1 ', 'far fa-star text-primary mr-2', 'far fa-star text-primary mr-2', 2322, '', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
