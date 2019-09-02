-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02 سبتمبر 2019 الساعة 14:54
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- بنية الجدول `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- إرجاع أو استيراد بيانات الجدول `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'chipse'),
(3, 'chocolate'),
(4, 'drinks');

-- --------------------------------------------------------

--
-- بنية الجدول `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `description` text,
  `image` text,
  `price` varchar(50) DEFAULT NULL,
  `number` int(7) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_category` (`id_category`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- إرجاع أو استيراد بيانات الجدول `item`
--

INSERT INTO `item` (`id`, `title`, `description`, `image`, `price`, `number`, `id_category`, `id_user`) VALUES
(1, 'walkers', '                                                                                                                                                                                    is a natural potato                                                                                                                                                                ', 'Walkerslogo.png1517232222', '5', 200, 1, 3),
(3, 'moon chips', 'is a natural potato ', '1516305089Moon-Chips-Tomato-Flavor.png', '5', 40, 1, 3),
(4, 'kit kat', 'is a natural chocolate', '1516305160article-0-077DCEF8000005DC-528_468x286.jpg', '5', 119, 3, 3),
(5, 'doritos', 'is a natural chips', '1516305218doritos.jpg', '5', 90, 1, 3),
(6, 'cabri dairy milk', 'is a natural chocolate', '15163052813.cadbury.jpg', '6', 127, 3, 3),
(7, 'change', 'is a natural chocolate', '151630534091efeffbf2ada6e946cb2a118da7ca4a--respect-women-chocolate-companies.jpg', '7', 137, 3, 3),
(8, 'break', 'is a natural chocolate', '151630665579c901292980fd269f206a1c5af25b2f.jpg', '4', 71, 3, 3),
(9, 'clover', 'is a natural chips', '1516306737af8a0471a6ac80b9dc445333d7fc7804--slogan-chips.jpg', '5', 121, 1, 3),
(10, 'cheetos', 'is a natural chips', '1516306818Cheetos-Crunchy-Flamin-Hot-34G.jpg', '3', 48, 1, 3),
(11, 'pepsi', '                                    is a drink                                ', 'soft-drinks.jpg1516634479', '6', 258, 4, 3),
(12, 'carbonated', 'is a natural drink from orange', '1517141130Carbonated Natural Orange Flavor Drink_cab73df5a924b86037bbebf1ea4ab482.jpg', '10', 285, 4, 3),
(13, 'minute made pulpy', 'is an orange juice natural drink', '1517141658601d4d627b7a57b1071c929489416972.jpg', '5', 160, 4, 3),
(14, 'texas bet ', 'is chipse from a natural potatos', '1517248068Texas-Pete-Hot-Sauce-Chips.jpg', '5.5', 248, 1, 3);

-- --------------------------------------------------------

--
-- بنية الجدول `online_user`
--

CREATE TABLE IF NOT EXISTS `online_user` (
  `id_user` int(11) NOT NULL DEFAULT '0',
  `status` varchar(5) DEFAULT NULL,
  `login_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- إرجاع أو استيراد بيانات الجدول `online_user`
--

INSERT INTO `online_user` (`id_user`, `status`, `login_date`) VALUES
(4, '1', '2019-06-13 16:59:01'),
(7, '1', '2019-06-13 16:51:49');

-- --------------------------------------------------------

--
-- بنية الجدول `sales_date`
--

CREATE TABLE IF NOT EXISTS `sales_date` (
  `id_item` int(11) DEFAULT NULL,
  `id_employee` int(11) DEFAULT NULL,
  `quantity` int(7) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `sale_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sale_date`),
  KEY `id_item` (`id_item`),
  KEY `id_employee` (`id_employee`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- إرجاع أو استيراد بيانات الجدول `sales_date`
--

INSERT INTO `sales_date` (`id_item`, `id_employee`, `quantity`, `price`, `sale_date`) VALUES
(4, 7, 2, '10', '2018-01-21 09:45:54'),
(4, 7, 2, '10', '2018-01-21 09:46:15'),
(4, 7, 3, '15', '2018-01-21 09:46:47'),
(7, 7, 3, '21', '2018-01-21 09:48:49'),
(7, 7, 5, '35', '2018-01-21 09:49:16'),
(8, 7, 2, '8', '2018-01-21 09:50:08'),
(4, 4, 3, '15', '2018-01-21 09:51:20'),
(11, 4, 2, '12', '2018-01-22 16:59:12'),
(11, 4, 20, '120', '2018-01-22 16:59:47'),
(11, 4, 10, '60', '2018-01-22 17:14:30'),
(4, 4, 5, '25', '2018-01-22 17:16:52'),
(12, 4, 5, '50', '2018-01-28 12:14:57'),
(12, 4, 10, '100', '2018-01-28 12:15:12'),
(13, 4, 10, '50', '2018-01-28 12:15:24'),
(13, 4, 30, '150', '2018-01-28 12:15:33'),
(11, 4, 10, '60', '2018-01-28 12:15:46'),
(7, 4, 5, '35', '2018-01-28 12:16:55'),
(5, 4, 10, '50', '2018-01-28 12:17:07'),
(9, 4, 3, '15', '2018-01-28 12:24:10'),
(8, 4, 3, '12', '2018-01-28 12:24:22'),
(6, 4, 3, '18', '2018-01-28 12:24:34'),
(10, 4, 2, '6', '2018-01-28 12:25:31'),
(1, 4, 1, '5', '2018-01-28 12:26:15'),
(4, 4, 3, '15', '2018-01-29 13:27:59'),
(14, 4, 2, '11', '2018-01-29 18:09:36'),
(4, 4, 3, '15', '2019-06-14 01:57:41');

-- --------------------------------------------------------

--
-- بنية الجدول `sales_list`
--

CREATE TABLE IF NOT EXISTS `sales_list` (
  `id_item` int(11) NOT NULL DEFAULT '0',
  `id_employee` int(11) NOT NULL DEFAULT '0',
  `number` int(7) DEFAULT NULL,
  `total_price` int(7) DEFAULT NULL,
  PRIMARY KEY (`id_item`,`id_employee`),
  KEY `id_employee` (`id_employee`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- إرجاع أو استيراد بيانات الجدول `sales_list`
--

INSERT INTO `sales_list` (`id_item`, `id_employee`, `number`, `total_price`) VALUES
(1, 4, 1, 5),
(4, 4, 14, 70),
(4, 7, 7, 35),
(5, 4, 10, 50),
(6, 4, 3, 18),
(7, 4, 5, 35),
(7, 7, 8, 56),
(8, 4, 3, 12),
(8, 7, 2, 8),
(9, 4, 3, 15),
(10, 4, 2, 6),
(11, 4, 42, 252),
(12, 4, 15, 150),
(13, 4, 40, 200),
(14, 4, 2, 11);

-- --------------------------------------------------------

--
-- بنية الجدول `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `job_type` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- إرجاع أو استيراد بيانات الجدول `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `job_type`) VALUES
(3, 'adel ahmed', 'adelahmed@store.com', 'password', 1),
(4, 'ahmed ali', 'ahmedali@store.com', 'password', 2),
(7, 'mahmoud mohamed', 'mahmoudmohamed@store.com', 'password', 2);

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- القيود للجدول `online_user`
--
ALTER TABLE `online_user`
  ADD CONSTRAINT `online_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- القيود للجدول `sales_date`
--
ALTER TABLE `sales_date`
  ADD CONSTRAINT `sales_date_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`),
  ADD CONSTRAINT `sales_date_ibfk_2` FOREIGN KEY (`id_employee`) REFERENCES `user` (`id`);

--
-- القيود للجدول `sales_list`
--
ALTER TABLE `sales_list`
  ADD CONSTRAINT `sales_list_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`),
  ADD CONSTRAINT `sales_list_ibfk_2` FOREIGN KEY (`id_employee`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
