-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 20, 2022 at 04:38 AM
-- Server version: 5.7.23-23
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emporium_emporiumstores`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional`
--

CREATE TABLE `additional` (
  `id` int(11) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `option_id` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `additional`
--

INSERT INTO `additional` (`id`, `product_image`, `product_id`, `option_id`) VALUES
(1, '1649313032_menblacktshirt.jpg', 1, '1'),
(2, '1649313032_menblacktshirt1.jpg', 1, '1'),
(3, '1649313397_menbluejean.jpg', 2, '2'),
(4, '1649313397_menbluejean1.jpg', 2, '2'),
(5, '1649316334_31ntapWU4GL.._SX._UX._SY._UY_.jpg', 3, '3'),
(6, '1649316334_41qzclSZnDL._AC_UL320_.jpg', 3, '3'),
(7, '1649316334_41U7-+8MWkL.._SX._UX._SY._UY_.jpg', 3, '3'),
(8, '1649392057_31ntapWU4GL.._SX._UX._SY._UY_.jpg', 3, '4'),
(9, '1649392057_41qzclSZnDL._AC_UL320_.jpg', 3, '4'),
(10, '1649392057_41U7-+8MWkL.._SX._UX._SY._UY_.jpg', 3, '4'),
(11, '1649392096_menbluejean.jpg', 2, '5'),
(12, '1649392096_menbluejean1.jpg', 2, '5'),
(13, '1650324116_D97EDA27-3871-4805-9A55-B65F25F96564.jpeg', 3, '4'),
(14, '1650327855_1620300406_2_4_1.jpg', 5, '5'),
(15, '1650327855_1620300406_2_3_1.jpg', 5, '5'),
(16, '1650327855_1620300406_2_2_1.jpg', 5, '5'),
(17, '1650327855_1620300406_2_1_1.jpg', 5, '5'),
(18, '1650327855_1620300406_1_1_1.jpg', 5, '5'),
(19, '1650327855_1620300406_2_4_1.jpg', 5, '6'),
(20, '1650327855_1620300406_2_3_1.jpg', 5, '6'),
(21, '1650327855_1620300406_2_2_1.jpg', 5, '6'),
(22, '1650327855_1620300406_2_1_1.jpg', 5, '6'),
(23, '1650327855_1620300406_1_1_1.jpg', 5, '6'),
(24, '1650345375_menbluejean.jpg', 7, '7'),
(25, '1650345375_menbluejean1.jpg', 7, '8'),
(26, '1650347489_menblacktshirt.jpg', 1, '9'),
(27, '1650414218_472006E5-D571-4792-B1F6-B656EE6CA3E6.png', 8, '10'),
(28, '1650414218_6EF2A59F-B516-4FEE-88E5-4306A28F3C51.png', 8, '10'),
(29, '1657529811_white.jpg', 9, '11'),
(31, '1657529854_yellow.jpg', 9, '12'),
(32, '1657698543_air-max-pre-day-shoes-jMh2rB.jfif', 10, '13'),
(33, '1657698672_double-sided-stunt-racing-moka-4-wheel-drive-off-road-rock-original-imagah4bermcsswu.jpeg', 11, '14'),
(34, '1657699613_air-max-pre-day-shoes-jMh2rB.jfif', 12, '15'),
(35, '1657699723_air-max-pre-day-shoes-jMh2rB.jfif', 13, '16'),
(36, '1657699818_air-max-pre-day-shoes-jMh2rB.jfif', 14, '17'),
(37, '1657699818_air-max-pre-day-shoes-jMh2rB.jfif', 14, '18'),
(45, '1657924301_096D1174-3A18-4D87-8B64-5D4311FD2070.png', 18, '23'),
(46, 'seller.jpg', 19, '24'),
(47, ' product2.jpg', 19, '25'),
(48, 'selle3.jpg', 19, '25'),
(49, 'seller.jpg', 20, '26'),
(50, 'sell.jpg ', 20, '26'),
(51, ' product.jpg', 20, '27'),
(52, 'selle2.jpg', 20, '27'),
(53, 'seller.jpg', 21, '28'),
(54, ' product2.jpg', 21, '29'),
(55, 'selle3.jpg', 21, '29'),
(56, 'seller.jpg', 0, '30'),
(57, 'sell.jpg ', 0, '30'),
(58, ' product.jpg', 0, '31'),
(59, 'selle2.jpg', 0, '31'),
(60, 'seller.jpg', 0, '32'),
(61, ' product2.jpg', 0, '33'),
(62, 'selle3.jpg', 0, '33'),
(63, 'seller.jpg', 0, '34'),
(64, 'sell.jpg ', 0, '34'),
(65, ' product.jpg', 0, '35'),
(66, 'selle2.jpg', 0, '35'),
(67, 'https://avasamnew.s3.amazonaws.com/live/GB010001/JIL-102912_0.jpg\n', 0, '36'),
(68, 'https://avasamnew.s3.amazonaws.com/live/GB010001/JIL-102912_0.jpg\n', 0, '38'),
(69, '\n\n', 0, '40'),
(70, '\n\n', 0, '42'),
(71, '\n\n', 0, '44'),
(72, '\n\n', 0, '46'),
(73, '\n\n', 0, '48'),
(74, '\n\n', 0, '50'),
(75, '\n\n', 0, '52'),
(76, '\n\n', 0, '54'),
(77, '\n\n', 0, '56'),
(78, '\n\n', 0, '58'),
(79, '\n\n', 0, '60'),
(80, 'seller.jpg', 0, '62'),
(81, ' product2.jpg', 0, '63'),
(82, 'selle3.jpg', 0, '63'),
(83, 'seller.jpg', 0, '64'),
(84, 'sell.jpg ', 0, '64'),
(85, ' product.jpg', 0, '65'),
(86, 'selle2.jpg', 0, '65'),
(87, 'seller.jpg', 22, '66'),
(88, ' product2.jpg', 22, '67'),
(89, 'selle3.jpg', 22, '67'),
(90, 'seller.jpg', 23, '68'),
(91, 'sell.jpg ', 23, '68'),
(92, ' product.jpg', 23, '69'),
(93, 'selle2.jpg', 23, '69'),
(94, 'seller.jpg', 24, '70'),
(95, ' product2.jpg', 24, '71'),
(96, 'selle3.jpg', 24, '71'),
(97, 'seller.jpg', 25, '72'),
(98, 'sell.jpg ', 25, '72'),
(99, ' product.jpg', 25, '73'),
(100, 'selle2.jpg', 25, '73'),
(101, 'seller.jpg', 26, '74'),
(102, ' product2.jpg', 26, '75'),
(103, 'selle3.jpg', 26, '75'),
(104, 'seller.jpg', 27, '76'),
(105, 'sell.jpg ', 27, '76'),
(106, ' product.jpg', 27, '77'),
(107, 'selle2.jpg', 27, '77'),
(108, 'seller.jpg', 28, '78'),
(109, ' product2.jpg', 28, '79'),
(110, 'selle3.jpg', 28, '79'),
(111, 'seller.jpg', 29, '80'),
(112, 'sell.jpg ', 29, '80'),
(113, ' product.jpg', 29, '81'),
(114, 'selle2.jpg', 29, '81'),
(115, 'seller.jpg', 30, '82'),
(116, ' product2.jpg', 30, '83'),
(117, 'selle3.jpg', 30, '83'),
(118, 'seller.jpg', 31, '84'),
(119, 'sell.jpg ', 31, '84'),
(120, ' product.jpg', 31, '85'),
(121, 'selle2.jpg', 31, '85'),
(122, 'seller.jpg', 32, '86'),
(123, ' product2.jpg', 32, '87'),
(124, 'selle3.jpg', 32, '87'),
(125, 'seller.jpg', 33, '88'),
(126, 'sell.jpg ', 33, '88'),
(127, ' product.jpg', 33, '89'),
(128, 'selle2.jpg', 33, '89');

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` text COLLATE utf8_unicode_ci,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phoneno` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_main_address` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `address`, `city`, `state`, `pincode`, `address2`, `country`, `phoneno`, `is_main_address`, `created_at`, `updated_at`) VALUES
(1, 68, 'Torquay,', 'Torquay', 'London', 'TQ2', NULL, 'London', NULL, 1, NULL, NULL),
(2, 65, '50 Leeward Lane', 'Torquay', 'Devon', 'TQ2 7GB', NULL, NULL, NULL, 1, NULL, NULL),
(8, 73, 'Janak Puri', 'New Delhi', 'Delhi', 'KA', NULL, 'India', NULL, 1, NULL, NULL),
(9, 74, 'Janak Puri', 'New Delhi', 'Delhi', 'KA', NULL, 'India', NULL, 1, NULL, NULL),
(10, 67, 'Bay Area, London', 'London', 'London', 'Tq2', NULL, 'United Kingdom', NULL, 1, NULL, NULL),
(11, 83, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(12, 85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(13, 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(14, 87, 'Janak Puri', 'New Delhi', 'Delhi', 'KA', NULL, 'India', NULL, 1, NULL, NULL),
(15, 89, 'Janak Puri', 'New Delhi', 'Delhi', 'BH', NULL, 'India', NULL, 1, NULL, NULL),
(16, 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(17, 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(18, 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(19, 93, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(20, 94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(21, 95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(22, 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(23, 97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(24, 98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(25, 99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(26, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(27, 101, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(28, 102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(29, 103, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(30, 104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(31, 105, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(32, 106, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(33, 107, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(34, 108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(35, 109, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(36, 110, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(37, 111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(38, 112, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(39, 113, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(40, 114, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(41, 115, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(42, 116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(43, 117, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(44, 118, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(45, 119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(46, 120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(47, 121, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(48, 122, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(49, 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(50, 124, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(51, 128, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(52, 130, 'Uttam Nagar', 'New Delhi', 'Delhi', 'KA', NULL, 'India', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auctions`
--

CREATE TABLE `auctions` (
  `id` int(11) NOT NULL,
  `catid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subcat_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bidding_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auction_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `minimum_cost` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `auto_close_bid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `biddings`
--

CREATE TABLE `biddings` (
  `id` int(11) NOT NULL,
  `auction_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `bid` decimal(10,0) DEFAULT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1 = Bid Place, 2 = Bid Awarded(Due for payment), 3 = Bid Proceed, 4 = Bid Decline, 5 = Bid Expired, 6 = Bid Close ',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'buyer.png',
  `dob` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone` bigint(10) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `is_subscription` tinyint(2) NOT NULL DEFAULT '0',
  `subscription_amount` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`id`, `uid`, `image`, `dob`, `gender`, `phone`, `status`, `is_subscription`, `subscription_amount`, `created_at`, `updated_at`) VALUES
(1, 'BUYEResrF2T', '1648910313_IMG_0087.jpg', NULL, NULL, 7510059020, 1, 0, 0, '2022-04-02 13:56:42', NULL),
(2, 'BUYERgQXMcL', '1648910206_51931acc2e0fc67c55dddf8e16ecc3228f4bc0fb_original.jpeg', NULL, NULL, 1234567890, 1, 0, 0, '2022-04-02 14:32:40', NULL),
(7, 'BUYERls2rhw', '1649230679_1.gif', '2018-08-18', 'Male', 1234567890, 1, 0, 0, '2022-04-06 07:34:25', NULL),
(15, 'BUYERWEOZ9t', 'buyer.png', '1994-08-18', 'Male', 9999161150, 1, 0, 0, '2022-04-14 10:21:11', NULL),
(17, 'BUYERBj46TX', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-04-20 11:15:41', NULL),
(18, 'BUYERNLfaMW', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-04-20 11:18:31', NULL),
(19, 'BUYERPwliyE', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-04-20 11:21:54', NULL),
(20, 'BUYERpQVlMu', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-04-20 11:22:48', NULL),
(21, 'BUYERzFYROg', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-04-20 11:25:43', NULL),
(22, 'BUYER08oMcs', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-05-31 07:08:05', NULL),
(23, 'BUYERJom75d', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:31:38', NULL),
(257, 'CxxsyCUl', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:53:38', NULL),
(258, 'BUYERJom75d\' AND 2*3*8=6*8 AND \'V6K8\'=\'V6K8', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:53:38', NULL),
(259, 'BUYERJom75d\" AND 2*3*8=6*8 AND \"87ki\"=\"87ki', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:53:39', NULL),
(260, 'BUYERJom75d%\' AND 2*3*8=6*8 AND \'KXUS\'!=\'KXUS%', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:53:40', NULL),
(261, '-1 OR 2+360-360-1=0+0+0+1', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:53:40', NULL),
(262, '-1 OR 3+360-360-1=0+0+0+1', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:53:41', NULL),
(263, 'BUYERJom75d\'||\'', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:53:41', NULL),
(264, 'u3ZSHQUu', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:53:44', NULL),
(265, 'BUYERJom75d\' AND 2*3*8=6*8 AND \'hIiS\'=\'hIiS', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:53:44', NULL),
(266, 'BUYERJom75d\" AND 2*3*8=6*8 AND \"Ah2f\"=\"Ah2f', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:53:45', NULL),
(267, 'BUYERJom75d%\' AND 2*3*8=6*8 AND \'AP8u\'!=\'AP8u%', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:53:46', NULL),
(268, '-1 OR 2+387-387-1=0+0+0+1', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:53:46', NULL),
(269, '-1 OR 3+387-387-1=0+0+0+1', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:53:47', NULL),
(271, 'BUYERJom75d\'|||\'', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:53:48', NULL),
(272, 'BUYERJom75d\'||\'\'||\'', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:53:49', NULL),
(273, '1 PROCEDURE ANALYSE(EXTRACTVALUE(9859,CONCAT(0x5c,(BENCHMARK(110000000,MD5(0x7562756f))))),1)-- ', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:53:50', NULL),
(275, 'if(now()=sysdate(),sleep(15),0)', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:54:00', NULL),
(277, '0\'XOR(if(now()=sysdate(),sleep(15),0))XOR\'Z', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:54:09', NULL),
(279, '0\"XOR(if(now()=sysdate(),sleep(15),0))XOR\"Z', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:54:19', NULL),
(281, '(select(0)from(select(sleep(15)))v)/*\'+(select(0)from(select(sleep(15)))v)+\'\"+(select(0)from(select(sleep(15)))v)+\"*/', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:54:31', NULL),
(283, '1 waitfor delay \'0:0:15\' -- ', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:54:40', NULL),
(285, 'siOw77HI\'; waitfor delay \'0:0:15\' -- ', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:54:50', NULL),
(286, 'pmEVBcpZ\'; waitfor delay \'0:0:15\' -- ', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:54:58', NULL),
(287, 'h7E6AQOO\' OR 621=(SELECT 621 FROM PG_SLEEP(15))--', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:55:00', NULL),
(288, '6rpiUvGy\' OR 261=(SELECT 261 FROM PG_SLEEP(15))--', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:55:07', NULL),
(289, 'Jfd3kSqU\') OR 176=(SELECT 176 FROM PG_SLEEP(15))--', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:55:08', NULL),
(290, 'Gwte5uG5\') OR 346=(SELECT 346 FROM PG_SLEEP(15))--', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:55:15', NULL),
(291, '8EbaI1Wr\')) OR 837=(SELECT 837 FROM PG_SLEEP(15))--', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:55:15', NULL),
(292, 'SAXTmp5k\')) OR 978=(SELECT 978 FROM PG_SLEEP(15))--', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:55:23', NULL),
(293, 'BUYERJom75d\'||DBMS_PIPE.RECEIVE_MESSAGE(CHR(98)||CHR(98)||CHR(98),15)||\'', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:55:25', NULL),
(294, '1\'\"', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:55:25', NULL),
(295, '1\0', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:55:26', NULL),
(296, '@@10ur7', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:55:27', NULL),
(300, '@@rPRWv', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-06-29 10:55:36', NULL),
(301, 'BUYERTbreg2', 'buyer.png', NULL, NULL, NULL, 1, 0, 0, '2022-07-15 18:05:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `buyer_wallet_history`
--

CREATE TABLE `buyer_wallet_history` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=process,1=complete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `orderid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `spec_detail` longtext COLLATE utf8_unicode_ci,
  `_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(5) DEFAULT NULL,
  `sellprice` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cashback` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `cashback_paid` int(1) NOT NULL DEFAULT '0' COMMENT '0 = unpaid, 1= paid',
  `cashback_paid_on` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cashback_pay_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_charges` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `discount_code_id` int(11) DEFAULT NULL,
  `discount_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `discount_percent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `totalamount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `movetocheckout` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `orderid`, `user_id`, `product_id`, `variant_id`, `spec_detail`, `_token`, `quantity`, `sellprice`, `cashback`, `cashback_paid`, `cashback_paid_on`, `cashback_pay_id`, `delivery_charges`, `discount_code_id`, `discount_amount`, `discount_percent`, `totalamount`, `movetocheckout`, `status`, `created_at`) VALUES
(1, 1, 73, 2, 2, 'a:2:{i:0;s:4:\"Blue\";i:1;s:2:\"XL\";}', 'YxwkBvPsQpvI5exe4OShaCr3vKy6vrRWWtQcqkK0', 1, '110', '11', 0, NULL, NULL, '0', NULL, '0', NULL, '110', 1, 0, '2022-04-08 05:12:12'),
(2, 2, 73, 1, 1, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', 'YxwkBvPsQpvI5exe4OShaCr3vKy6vrRWWtQcqkK0', 1, '120', '12', 0, NULL, NULL, '0', NULL, '0', NULL, '120', 1, 0, '2022-04-08 05:14:30'),
(3, 2, 73, 3, 3, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', 'YxwkBvPsQpvI5exe4OShaCr3vKy6vrRWWtQcqkK0', 1, '530', '53', 0, NULL, NULL, '0', NULL, '0', NULL, '530', 1, 0, '2022-04-08 05:14:33'),
(4, 3, 68, 1, 1, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', 'E9iqqbJpurqBtgvFXseKz5sdW4U98cytJs9hLZ8W', 1, '120', '12', 1, '08-04-2022 12:53:15', '76673fddf', '0', NULL, '0', NULL, '120', 1, 0, '2022-04-08 05:22:01'),
(5, 4, 73, 2, 2, 'a:2:{i:0;s:4:\"Blue\";i:1;s:2:\"XL\";}', 'zdMHSjgL1UhTcdIWzFCvTKMfC4OgFxOSkQvIqhn8', 1, '110', '11', 0, NULL, NULL, '0', NULL, '0', NULL, '110', 1, 0, '2022-04-08 09:53:02'),
(6, 4, 73, 1, 1, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', 'zdMHSjgL1UhTcdIWzFCvTKMfC4OgFxOSkQvIqhn8', 1, '120', '12', 0, NULL, NULL, '0', NULL, '0', NULL, '120', 1, 0, '2022-04-08 09:53:13'),
(11, 6, 68, 3, 3, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', 'qsCqygGP4QPAd9fXOrn2YDuntNeUBVj6QS8H96hV', 1, '2', '0.2', 0, NULL, NULL, '0', NULL, '0', NULL, '2', 1, 0, '2022-04-08 18:47:52'),
(13, NULL, 66, 3, 3, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', 'G2JlVtm55hK4UY4ERVdnHgOuAYdrihmXj2SpihbO', 1, '2', '0.2', 0, NULL, NULL, '0', NULL, '0', NULL, '2', 0, 1, '2022-04-08 18:53:07'),
(14, 38, 73, 1, 1, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', 'cqPXdyWb8w1Lfoo0k45gD5E7mqAReI8HmlErwE21', 1, '120', '12', 0, NULL, NULL, '0', NULL, '0', NULL, '120', 1, 0, '2022-04-09 07:31:46'),
(16, 39, 73, 1, 1, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', 'b2myEKmZqUdpy01NvgZJDfOug21h09UTLJkHZEme', 1, '2', '0.2', 0, NULL, NULL, '0', NULL, '0', NULL, '2', 1, 0, '2022-04-11 04:30:38'),
(17, 40, 73, 3, 3, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', 'b2myEKmZqUdpy01NvgZJDfOug21h09UTLJkHZEme', 1, '2', '0.2', 0, NULL, NULL, '0', NULL, '0', NULL, '2', 1, 0, '2022-04-11 05:17:14'),
(18, 40, 73, 1, 1, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', 'b2myEKmZqUdpy01NvgZJDfOug21h09UTLJkHZEme', 1, '2', '0.2', 0, NULL, NULL, '0', NULL, '0', NULL, '2', 1, 0, '2022-04-11 05:17:21'),
(19, 41, 73, 2, 2, 'a:2:{i:0;s:4:\"Blue\";i:1;s:2:\"XL\";}', 'b2myEKmZqUdpy01NvgZJDfOug21h09UTLJkHZEme', 1, '110', '11', 0, NULL, NULL, '0', NULL, '0', NULL, '110', 1, 0, '2022-04-11 05:23:00'),
(20, 41, 73, 1, 1, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', 'b2myEKmZqUdpy01NvgZJDfOug21h09UTLJkHZEme', 1, '2', '0.2', 0, NULL, NULL, '0', NULL, '0', NULL, '2', 1, 0, '2022-04-11 05:23:05'),
(21, 42, 73, 2, 2, 'a:2:{i:0;s:4:\"Blue\";i:1;s:2:\"XL\";}', 'Do8Be8NhHn9KH0zgShT2nYJLyHa979vx5RTNvlIY', 1, '110', '11', 0, NULL, NULL, '0', NULL, '0', NULL, '110', 1, 0, '2022-04-11 07:04:10'),
(22, 43, 73, 2, 2, 'a:2:{i:0;s:4:\"Blue\";i:1;s:2:\"XL\";}', 'Tzbf7r6BuveW44Tu33BXKkv7GN6jQItmRZGyBlGI', 1, '110', '11', 0, NULL, NULL, '0', NULL, '0', NULL, '110', 1, 0, '2022-04-11 07:10:23'),
(23, 44, 73, 3, 3, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', 'f5nO87oYtRZbNYLo0jl7qgLFxH5nAt1PBU9YTaXe', 1, '2', '0.2', 0, NULL, NULL, '0', NULL, '0', NULL, '2', 1, 0, '2022-04-11 07:21:27'),
(24, 45, 67, 1, 1, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', '1gNLWZbQ9pFDpWpyBSW8Q7okaCwcNDEOMZ3lL8AB', 2, '2', '0.2', 0, NULL, NULL, '0', NULL, '0', NULL, '4', 1, 0, '2022-04-11 11:12:24'),
(25, NULL, 67, 8, 10, 'a:1:{i:0;s:5:\"Gravy\";}', 'I20piZfhcCvpm0VissV9khN3dV91jnSg54Iaht1D', 1, '4.5', '0', 0, NULL, NULL, '0', NULL, '0', NULL, '4.5', 0, 1, '2022-04-20 00:24:52'),
(26, NULL, 66, 8, 10, 'a:1:{i:0;s:5:\"Gravy\";}', 'DM4v6NYn42DRNpEq5lNuJjgLiZcofU551uZFCDDH', 5, '4.5', '0', 0, NULL, NULL, '0', NULL, '0', NULL, '22.5', 0, 1, '2022-04-20 13:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `cashbacks`
--

CREATE TABLE `cashbacks` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `catid` int(11) DEFAULT NULL,
  `subcat_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `cashback` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cashbacks`
--

INSERT INTO `cashbacks` (`id`, `user_id`, `catid`, `subcat_id`, `product_id`, `cashback`, `created_at`, `status`) VALUES
(1, '1,2', 25, '14', '2,1,3', '10', '2022-04-08 04:31:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `catname` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `categoryimg` varchar(255) DEFAULT NULL,
  `cat_slug` varchar(255) DEFAULT NULL,
  `show_in_menu` tinyint(2) NOT NULL DEFAULT '0',
  `created_date` timestamp NULL DEFAULT NULL,
  `modifiled_date` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `catname`, `slug`, `categoryimg`, `cat_slug`, `show_in_menu`, `created_date`, `modifiled_date`, `status`) VALUES
(8, 'Motors', 'motors', '1648912744_images.jfif', 'motors', 1, '2022-01-03 10:10:40', '2022-04-02 15:19:04', 1),
(9, 'Sports & Outdoors', 'sports-outdoors', '1648916535_sports-tools.jpg', 'sports-outdoors', 1, '2022-01-18 16:06:41', '2022-04-16 13:59:04', 1),
(11, 'Electronics', 'electronics', '1648912549_electronic-gadgets.jpeg', 'electronics', 0, '2022-01-19 11:21:37', '2022-04-02 15:15:49', 1),
(12, 'Health & Beauty', 'health-beauty', '1648912497_Health & Beauty.jpg', 'health-beauty', 0, '2022-01-25 23:34:34', '2022-04-02 15:14:57', 1),
(21, 'Toys', 'toys', '1647733258_61oJaDqIWfL._AC_UL604_SR604,400_.jpg', 'toys', 0, '2022-02-17 08:38:52', '2022-04-02 15:03:36', 1),
(22, 'Home & Garden', 'home-garden', '1647733546_61q73U+W3SL._SX425_.jpg', 'home-garden', 0, '2022-03-15 23:24:08', '2022-04-02 14:59:51', 1),
(23, 'Collectables', 'collectables', '1648912143_Collectables.webp', 'collectables', 0, '2022-04-02 15:09:03', NULL, 1),
(25, 'Men\'s Fashion', 'men-s-fashion', '1650116602_business-concept-smiling-thoughtful-handsome-man-standing-white-isolated-background-touching-his-chin-with-hand.jpg', 'mens-fashion', 0, '2022-04-04 08:47:41', '2022-04-16 13:43:22', 1),
(26, 'Women\'s Fashion', 'women-s-fashion', '1650116651_excited-white-girl-bright-stylish-glasses-posing-pink-dreamy-curly-woman-playing-with-her-ginger-hair-laughing.jpg', 'womens-fashion', 0, '2022-04-04 08:48:00', '2022-04-16 13:44:11', 1),
(27, 'Watches & Jewellery', 'watches-jewellery', '1650111694_4YXKGGHASNL6DJP67C2WMMSLLA.jpg', 'watches-jewellery', 0, '2022-04-16 12:21:34', NULL, 1),
(28, 'Boys Fashion', 'boys-fashion', '1650112984_screen-0.webp', 'boys-fashion', 0, '2022-04-16 12:43:04', NULL, 1),
(29, 'Girls Fashion', 'girls-fashion', '1650113626_tcfrhz1627639540354.webp', 'girls-fashion', 0, '2022-04-16 12:53:46', NULL, 1),
(30, 'Baby', 'baby', '1650114119_baby-milestone-cards-fern-desgn-gender-neutral-SizeRender_16_1_medium.webp', 'baby', 0, '2022-04-16 13:01:59', NULL, 1),
(31, 'Computers & Office', 'computers-office', '1650116266_slide-view-streaming-home-studio-equipped-with-professional-equipment-during-esport-competition.jpg', 'computers-office', 0, '2022-04-16 13:37:46', NULL, 1),
(32, 'Food & Grocery', 'food-grocery', '1650118658_grocery-basket.jpg', 'food-grocery', 0, '2022-04-16 14:17:38', NULL, 1),
(33, 'Pets', 'pets', '1650122002_Pets thumb.jpg', 'pets', 0, '2022-04-16 15:13:22', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `id` int(11) NOT NULL,
  `commission` varchar(255) DEFAULT NULL,
  `subscription_commission` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commissions`
--

INSERT INTO `commissions` (`id`, `commission`, `subscription_commission`, `created_at`, `updated_at`, `status`) VALUES
(1, '10', '3', '2022-04-07 12:34:01', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'AS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua And Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas The'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CD', 'Congo The Democratic Republic Of The'),
(51, 'CK', 'Cook Islands'),
(52, 'CR', 'Costa Rica'),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)'),
(54, 'HR', 'Croatia (Hrvatska)'),
(55, 'CU', 'Cuba'),
(56, 'CY', 'Cyprus'),
(57, 'CZ', 'Czech Republic'),
(58, 'DK', 'Denmark'),
(59, 'DJ', 'Djibouti'),
(60, 'DM', 'Dominica'),
(61, 'DO', 'Dominican Republic'),
(62, 'TP', 'East Timor'),
(63, 'EC', 'Ecuador'),
(64, 'EG', 'Egypt'),
(65, 'SV', 'El Salvador'),
(66, 'GQ', 'Equatorial Guinea'),
(67, 'ER', 'Eritrea'),
(68, 'EE', 'Estonia'),
(69, 'ET', 'Ethiopia'),
(70, 'XA', 'External Territories of Australia'),
(71, 'FK', 'Falkland Islands'),
(72, 'FO', 'Faroe Islands'),
(73, 'FJ', 'Fiji Islands'),
(74, 'FI', 'Finland'),
(75, 'FR', 'France'),
(76, 'GF', 'French Guiana'),
(77, 'PF', 'French Polynesia'),
(78, 'TF', 'French Southern Territories'),
(79, 'GA', 'Gabon'),
(80, 'GM', 'Gambia The'),
(81, 'GE', 'Georgia'),
(82, 'DE', 'Germany'),
(83, 'GH', 'Ghana'),
(84, 'GI', 'Gibraltar'),
(85, 'GR', 'Greece'),
(86, 'GL', 'Greenland'),
(87, 'GD', 'Grenada'),
(88, 'GP', 'Guadeloupe'),
(89, 'GU', 'Guam'),
(90, 'GT', 'Guatemala'),
(91, 'XU', 'Guernsey and Alderney'),
(92, 'GN', 'Guinea'),
(93, 'GW', 'Guinea-Bissau'),
(94, 'GY', 'Guyana'),
(95, 'HT', 'Haiti'),
(96, 'HM', 'Heard and McDonald Islands'),
(97, 'HN', 'Honduras'),
(98, 'HK', 'Hong Kong S.A.R.'),
(99, 'HU', 'Hungary'),
(100, 'IS', 'Iceland'),
(101, 'IN', 'India'),
(102, 'ID', 'Indonesia'),
(103, 'IR', 'Iran'),
(104, 'IQ', 'Iraq'),
(105, 'IE', 'Ireland'),
(106, 'IL', 'Israel'),
(107, 'IT', 'Italy'),
(108, 'JM', 'Jamaica'),
(109, 'JP', 'Japan'),
(110, 'XJ', 'Jersey'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea North'),
(116, 'KR', 'Korea South'),
(117, 'KW', 'Kuwait'),
(118, 'KG', 'Kyrgyzstan'),
(119, 'LA', 'Laos'),
(120, 'LV', 'Latvia'),
(121, 'LB', 'Lebanon'),
(122, 'LS', 'Lesotho'),
(123, 'LR', 'Liberia'),
(124, 'LY', 'Libya'),
(125, 'LI', 'Liechtenstein'),
(126, 'LT', 'Lithuania'),
(127, 'LU', 'Luxembourg'),
(128, 'MO', 'Macau S.A.R.'),
(129, 'MK', 'Macedonia'),
(130, 'MG', 'Madagascar'),
(131, 'MW', 'Malawi'),
(132, 'MY', 'Malaysia'),
(133, 'MV', 'Maldives'),
(134, 'ML', 'Mali'),
(135, 'MT', 'Malta'),
(136, 'XM', 'Man (Isle of)'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'YT', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia'),
(144, 'MD', 'Moldova'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'MS', 'Montserrat'),
(148, 'MA', 'Morocco'),
(149, 'MZ', 'Mozambique'),
(150, 'MM', 'Myanmar'),
(151, 'NA', 'Namibia'),
(152, 'NR', 'Nauru'),
(153, 'NP', 'Nepal'),
(154, 'AN', 'Netherlands Antilles'),
(155, 'NL', 'Netherlands The'),
(156, 'NC', 'New Caledonia'),
(157, 'NZ', 'New Zealand'),
(158, 'NI', 'Nicaragua'),
(159, 'NE', 'Niger'),
(160, 'NG', 'Nigeria'),
(161, 'NU', 'Niue'),
(162, 'NF', 'Norfolk Island'),
(163, 'MP', 'Northern Mariana Islands'),
(164, 'NO', 'Norway'),
(165, 'OM', 'Oman'),
(166, 'PK', 'Pakistan'),
(167, 'PW', 'Palau'),
(168, 'PS', 'Palestinian Territory Occupied'),
(169, 'PA', 'Panama'),
(170, 'PG', 'Papua new Guinea'),
(171, 'PY', 'Paraguay'),
(172, 'PE', 'Peru'),
(173, 'PH', 'Philippines'),
(174, 'PN', 'Pitcairn Island'),
(175, 'PL', 'Poland'),
(176, 'PT', 'Portugal'),
(177, 'PR', 'Puerto Rico'),
(178, 'QA', 'Qatar'),
(179, 'RE', 'Reunion'),
(180, 'RO', 'Romania'),
(181, 'RU', 'Russia'),
(182, 'RW', 'Rwanda'),
(183, 'SH', 'Saint Helena'),
(184, 'KN', 'Saint Kitts And Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'PM', 'Saint Pierre and Miquelon'),
(187, 'VC', 'Saint Vincent And The Grenadines'),
(188, 'WS', 'Samoa'),
(189, 'SM', 'San Marino'),
(190, 'ST', 'Sao Tome and Principe'),
(191, 'SA', 'Saudi Arabia'),
(192, 'SN', 'Senegal'),
(193, 'RS', 'Serbia'),
(194, 'SC', 'Seychelles'),
(195, 'SL', 'Sierra Leone'),
(196, 'SG', 'Singapore'),
(197, 'SK', 'Slovakia'),
(198, 'SI', 'Slovenia'),
(199, 'XG', 'Smaller Territories of the UK'),
(200, 'SB', 'Solomon Islands'),
(201, 'SO', 'Somalia'),
(202, 'ZA', 'South Africa'),
(203, 'GS', 'South Georgia'),
(204, 'SS', 'South Sudan'),
(205, 'ES', 'Spain'),
(206, 'LK', 'Sri Lanka'),
(207, 'SD', 'Sudan'),
(208, 'SR', 'Suriname'),
(209, 'SJ', 'Svalbard And Jan Mayen Islands'),
(210, 'SZ', 'Swaziland'),
(211, 'SE', 'Sweden'),
(212, 'CH', 'Switzerland'),
(213, 'SY', 'Syria'),
(214, 'TW', 'Taiwan'),
(215, 'TJ', 'Tajikistan'),
(216, 'TZ', 'Tanzania'),
(217, 'TH', 'Thailand'),
(218, 'TG', 'Togo'),
(219, 'TK', 'Tokelau'),
(220, 'TO', 'Tonga'),
(221, 'TT', 'Trinidad And Tobago'),
(222, 'TN', 'Tunisia'),
(223, 'TR', 'Turkey'),
(224, 'TM', 'Turkmenistan'),
(225, 'TC', 'Turks And Caicos Islands'),
(226, 'TV', 'Tuvalu'),
(227, 'UG', 'Uganda'),
(228, 'UA', 'Ukraine'),
(229, 'AE', 'United Arab Emirates'),
(230, 'GB', 'United Kingdom'),
(231, 'US', 'United States'),
(232, 'UM', 'United States Minor Outlying Islands'),
(233, 'UY', 'Uruguay'),
(234, 'UZ', 'Uzbekistan'),
(235, 'VU', 'Vanuatu'),
(236, 'VA', 'Vatican City State (Holy See)'),
(237, 'VE', 'Venezuela'),
(238, 'VN', 'Vietnam'),
(239, 'VG', 'Virgin Islands (British)'),
(240, 'VI', 'Virgin Islands (US)'),
(241, 'WF', 'Wallis And Futuna Islands'),
(242, 'EH', 'Western Sahara'),
(243, 'YE', 'Yemen'),
(244, 'YU', 'Yugoslavia'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `percent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `discount_percent` int(3) NOT NULL DEFAULT '0' COMMENT ' 0 -100%',
  `is_active` bigint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `question` text,
  `answer` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `featured_package`
--

CREATE TABLE `featured_package` (
  `id` int(11) NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `featured_package`
--

INSERT INTO `featured_package` (`id`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, '20', 1, '2022-04-20 07:10:07', '2022-04-20 07:10:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES
(1, '2014_10_12_000000_create_users_table', 1, NULL, NULL),
(2, '2014_10_12_100000_create_password_resets_table', 1, NULL, NULL),
(3, '2019_08_19_000000_create_failed_jobs_table', 1, NULL, NULL),
(4, '2020_08_04_160815_create_table_products', 2, NULL, NULL),
(5, '2020_08_04_161651_rename_table', 3, NULL, NULL),
(6, '2020_08_04_171504_create_userregister_table', 4, NULL, NULL),
(7, '2020_08_09_103916_create_order_history_table', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `most_viewed_product`
--

CREATE TABLE `most_viewed_product` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `counter` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `most_viewed_product`
--

INSERT INTO `most_viewed_product` (`id`, `product_id`, `user_id`, `counter`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 6, 1, '2022-04-07 06:30:46', '2022-07-19 08:59:35'),
(2, 2, 1, 4, 1, '2022-04-07 06:37:01', '2022-07-19 08:59:13'),
(3, 2, 73, 12, 1, '2022-04-07 06:50:46', '2022-04-11 07:10:18'),
(4, 1, 73, 12, 1, '2022-04-07 07:19:21', '2022-04-11 12:58:41'),
(5, 3, 73, 7, 1, '2022-04-07 07:26:01', '2022-04-11 12:58:17'),
(6, 1, 67, 6, 1, '2022-04-07 09:03:20', '2022-04-18 23:17:13'),
(7, 1, 68, 1, 1, '2022-04-08 05:21:57', '0000-00-00 00:00:00'),
(8, 2, 67, 4, 1, '2022-04-08 16:27:39', '2022-04-18 23:20:14'),
(9, 3, 67, 7, 1, '2022-04-08 18:30:56', '2022-04-19 00:27:29'),
(10, 3, 68, 13, 1, '2022-04-08 18:31:44', '2022-04-08 18:49:36'),
(11, 2, 68, 1, 1, '2022-04-08 18:32:59', '0000-00-00 00:00:00'),
(12, 3, 66, 4, 1, '2022-04-08 18:53:03', '2022-04-18 23:59:55'),
(13, 4, 67, 2, 1, '2022-04-18 23:45:52', '2022-04-19 00:27:37'),
(14, 4, 66, 1, 1, '2022-04-18 23:58:35', '0000-00-00 00:00:00'),
(15, 4, 1, 3, 1, '2022-04-19 00:09:25', '2022-04-19 00:10:45'),
(16, 5, 67, 2, 1, '2022-04-19 00:24:28', '2022-04-19 00:26:50'),
(17, 6, 87, 1, 1, '2022-04-19 05:22:59', '0000-00-00 00:00:00'),
(18, 7, 87, 3, 1, '2022-04-19 05:31:14', '2022-04-19 11:33:18'),
(19, 5, 87, 18, 1, '2022-04-19 05:31:46', '2022-04-19 08:16:04'),
(20, 1, 87, 25, 1, '2022-04-19 05:43:19', '2022-04-19 08:21:04'),
(21, 5, 1, 12, 1, '2022-04-19 11:38:55', '2022-07-19 08:59:29'),
(22, 7, 1, 2, 1, '2022-04-19 11:39:43', '2022-07-13 08:13:41'),
(23, 8, 67, 1, 1, '2022-04-20 00:24:15', '0000-00-00 00:00:00'),
(24, 8, 66, 11, 1, '2022-04-20 00:26:41', '2022-04-20 13:40:47'),
(25, 8, 87, 5, 1, '2022-04-20 03:45:04', '2022-04-20 09:28:09'),
(26, 8, 68, 22, 1, '2022-04-20 04:07:28', '2022-04-20 09:41:13'),
(27, 8, 89, 12, 1, '2022-04-20 04:15:05', '2022-04-20 04:24:16'),
(28, 8, 1, 2, 1, '2022-06-14 08:22:06', '2022-06-14 09:22:29'),
(29, 8, 73, 1, 1, '2022-06-14 09:28:48', '0000-00-00 00:00:00'),
(30, 9, 73, 2, 1, '2022-07-11 08:57:06', '2022-07-11 08:57:47'),
(31, 10, 73, 1, 1, '2022-07-13 07:51:49', '0000-00-00 00:00:00'),
(32, 18, 66, 12, 1, '2022-07-15 22:32:21', '2022-07-15 23:12:43'),
(33, 20, 66, 2, 1, '2022-07-15 23:09:49', '2022-07-15 23:13:12'),
(34, 19, 66, 1, 1, '2022-07-15 23:09:56', '0000-00-00 00:00:00'),
(35, 17, 66, 1, 1, '2022-07-15 23:10:01', '0000-00-00 00:00:00'),
(36, 21, 66, 2, 1, '2022-07-15 23:50:06', '2022-07-15 23:50:30'),
(37, 18, 1, 1, 1, '2022-07-19 08:58:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `specs_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`, `image`, `specs_id`, `created_at`, `updated_at`) VALUES
(1, 'Blue', '1649312385_1639734243_bright-blue-color-solid-background-1920x1080.png', 4, '2022-04-07 06:19:45', NULL),
(3, 'Black', '1649312645_1639734250_1536px-Black_colour.jpg', 4, '2022-04-07 06:20:13', '2022-04-07 06:24:05'),
(5, 'Gravy', '1650414016_DD8568A6-64DC-44AB-88BB-CE3B94ADF54A.png', 6, '2022-04-20 00:20:16', NULL),
(6, 'Up to 23\"', '1657145388_DDF82109-6B21-417E-A60A-C11B0E556308.png', 7, '2022-07-06 22:09:48', '2022-07-08 01:44:50'),
(7, '5.1 Channel', '1657145616_F979975E-A9B7-409C-8259-C163973FD9D8.png', 8, '2022-07-06 22:13:36', NULL),
(8, '23\" - 42’’', '1657145684_DCC2C8BB-6F28-4D02-AE8D-BC2DCEAB2207.png', 7, '2022-07-06 22:14:44', '2022-07-08 01:45:48'),
(9, '42’’ - 55’’', '1657145707_39685EB7-A59B-4B96-897C-0B193A1A4DD0.png', 7, '2022-07-06 22:15:07', '2022-07-08 01:42:51'),
(10, '55’’ - 65’’', '1657145726_B786A02A-00EA-4376-A643-7CEF7BD1824B.png', 7, '2022-07-06 22:15:26', '2022-07-08 01:41:52'),
(11, '65\" - 75’’', '1657145750_CAD85887-EC46-4919-A4DC-768ABF7A5190.png', 7, '2022-07-06 22:15:50', '2022-07-08 01:40:51'),
(12, '75\" & Above', '1657145819_497F62F0-2CB6-4C27-B3E6-E135A828A15B.png', 7, '2022-07-06 22:16:59', '2022-07-08 01:46:49'),
(13, '7.1 Channel', '1657146109_07DBCC0B-F3B4-4161-8A7B-C4C5AFF584AE.png', 8, '2022-07-06 22:21:49', NULL),
(14, '9.1 Channel', '1657146164_09E32311-FE6E-4202-81CD-9B0AAC931D00.png', 8, '2022-07-06 22:22:44', NULL),
(15, '2.1 Channel', '1657146231_BE6401DE-A317-4721-9FD2-DDDB3A018A2C.png', 8, '2022-07-06 22:23:51', NULL),
(16, 'Sound Bar', '1657146308_F46370E5-84EE-46CC-8178-ABEFDA70DE36.png', 8, '2022-07-06 22:25:08', NULL),
(17, '720p', '1657243916_DFD075BF-98FF-4D86-83CE-FFE5C4957FF5.png', 9, '2022-07-08 01:31:56', '2022-07-08 01:36:12'),
(18, '1080p', '1657243981_D4D7CCCC-A0DE-411A-9B47-ED36BB482E2D.png', 9, '2022-07-08 01:33:01', '2022-07-08 01:36:28'),
(19, '2K', '1657244016_0135A609-BBB2-4A3E-82E8-0111B990D93C.png', 9, '2022-07-08 01:33:36', NULL),
(20, '4k', NULL, 9, '2022-07-08 01:33:50', NULL),
(21, '8K', NULL, 9, '2022-07-08 01:35:18', NULL),
(22, '60 Hz', NULL, 10, '2022-07-08 01:49:45', NULL),
(23, '90 Hz', NULL, 10, '2022-07-08 01:49:55', NULL),
(24, '120 Hz & Above', NULL, 10, '2022-07-08 01:50:21', '2022-07-08 01:50:45'),
(25, 'LED', NULL, 11, '2022-07-08 01:52:43', NULL),
(26, 'QLED', NULL, 11, '2022-07-08 01:53:57', NULL),
(27, 'AMOLED', NULL, 11, '2022-07-08 01:54:31', NULL),
(28, 'LCD', NULL, 11, '2022-07-08 01:54:41', NULL),
(29, 'OLED', NULL, 11, '2022-07-08 01:55:02', NULL),
(30, 'NanoCell', NULL, 11, '2022-07-08 01:55:34', NULL),
(31, 'MicroLED', NULL, 11, '2022-07-08 01:56:01', NULL),
(32, 'Android TV', NULL, 12, '2022-07-08 01:58:25', NULL),
(33, 'FireOS', NULL, 12, '2022-07-08 01:59:52', NULL),
(34, 'Tizen', NULL, 12, '2022-07-08 02:00:19', NULL),
(35, 'Web Os', NULL, 12, '2022-07-08 02:00:40', NULL),
(36, 'Home Os', NULL, 12, '2022-07-08 02:01:26', NULL),
(37, '1', NULL, 13, '2022-07-08 02:03:03', NULL),
(38, '2', NULL, 13, '2022-07-08 02:03:12', NULL),
(39, '3', NULL, 13, '2022-07-08 02:03:18', NULL),
(40, '4', NULL, 13, '2022-07-08 02:03:24', NULL),
(41, '5', NULL, 13, '2022-07-08 02:03:29', NULL),
(42, '6', NULL, 13, '2022-07-08 02:03:37', NULL),
(43, 'Wall Mounted', NULL, 14, '2022-07-08 02:06:03', NULL),
(44, 'Table Mount', NULL, 14, '2022-07-08 02:06:24', NULL),
(45, '1 Port', NULL, 15, '2022-07-08 02:09:02', NULL),
(46, '2 Ports', NULL, 15, '2022-07-08 02:09:13', '2022-07-08 02:10:12'),
(47, '3 Ports', NULL, 15, '2022-07-08 02:09:35', NULL),
(48, '4 Ports', NULL, 15, '2022-07-08 02:09:45', NULL),
(49, 'Wifi', NULL, 16, '2022-07-08 02:11:34', NULL),
(50, 'Bluetooth', NULL, 16, '2022-07-08 02:11:45', NULL),
(51, 'Ethernet', NULL, 16, '2022-07-08 02:12:01', NULL),
(52, 'HDMI', NULL, 16, '2022-07-08 02:12:30', NULL),
(53, 'VGA', NULL, 16, '2022-07-08 02:12:48', NULL),
(54, 'USB', NULL, 16, '2022-07-08 02:13:03', NULL),
(55, 'Samsung', NULL, 17, '2022-07-08 02:16:32', NULL),
(56, 'Sony', NULL, 17, '2022-07-08 02:16:49', NULL),
(57, 'LG', NULL, 17, '2022-07-08 02:17:06', NULL),
(58, 'Oneplus', NULL, 17, '2022-07-08 02:17:22', NULL),
(59, 'VU', NULL, 17, '2022-07-08 02:17:44', NULL),
(60, 'TCL', NULL, 17, '2022-07-08 02:19:02', NULL),
(61, 'Toshiba', NULL, 17, '2022-07-08 02:19:31', NULL),
(62, 'Apple', NULL, 17, '2022-07-08 02:19:49', NULL),
(63, 'Hisense', NULL, 17, '2022-07-08 02:20:19', NULL),
(64, 'BBC iplayer', NULL, 18, '2022-07-08 02:23:37', NULL),
(65, 'Browser', NULL, 18, '2022-07-08 02:24:05', NULL),
(66, 'Google Tv', NULL, 18, '2022-07-08 02:24:31', NULL),
(67, 'Netflix', NULL, 18, '2022-07-08 02:24:39', NULL),
(68, 'YouTube', NULL, 18, '2022-07-08 02:24:52', NULL),
(69, 'Skype', NULL, 18, '2022-07-08 02:25:06', NULL),
(70, 'Free view / Free Sat', NULL, 18, '2022-07-08 02:25:41', NULL),
(71, 'Baby Clothing', NULL, 20, '2022-07-09 01:13:18', NULL),
(72, 'Baby Shoes', NULL, 20, '2022-07-09 01:13:36', NULL),
(73, 'Activity & Entertainment', NULL, 20, '2022-07-09 01:14:04', NULL),
(74, 'Baby & Toddler Toys', NULL, 20, '2022-07-09 01:14:27', NULL),
(75, 'Car Seats & Accessories', NULL, 20, '2022-07-09 01:15:01', NULL),
(76, 'Carriers', NULL, 2, '2022-07-09 01:15:16', NULL),
(77, 'Safety Equipment', NULL, 20, '2022-07-09 01:15:48', NULL),
(78, 'Health & Baby Care', NULL, 20, '2022-07-09 01:16:26', NULL),
(79, 'Soothers & Teethers', NULL, 20, '2022-07-09 01:16:50', NULL),
(80, 'Trailers', NULL, 20, '2022-07-09 01:17:02', NULL),
(81, 'Nursing & Feeding', NULL, 20, '2022-07-09 01:17:26', NULL),
(82, 'Nappy', NULL, 20, '2022-07-09 01:17:47', NULL),
(83, 'Potty Training & Step Stools', NULL, 20, '2022-07-09 01:18:25', NULL),
(84, 'Pushchairs, Prams', NULL, 20, '2022-07-09 01:18:55', NULL),
(85, 'HUGGIES', NULL, 21, '2022-07-09 01:20:51', NULL),
(86, 'Finish', NULL, 21, '2022-07-09 01:21:06', NULL),
(87, 'Comfort', NULL, 21, '2022-07-09 01:21:19', NULL),
(88, 'Mama Bear', NULL, 21, '2022-07-09 01:21:33', NULL),
(89, 'WaterWipes', NULL, 21, '2022-07-09 01:21:49', NULL),
(90, 'Mr Muscle', NULL, 21, '2022-07-09 01:22:05', NULL),
(91, 'New.', NULL, 22, '2022-07-09 01:23:53', '2022-07-12 00:40:33'),
(92, 'Used.', NULL, 22, '2022-07-09 01:24:04', '2022-07-12 00:40:54'),
(93, 'New TV', NULL, 23, '2022-07-09 01:29:25', NULL),
(94, 'Used TV', NULL, 23, '2022-07-09 01:29:35', NULL),
(95, 'Dresses', NULL, 24, '2022-07-09 01:40:41', NULL),
(96, 'Jeans', NULL, 24, '2022-07-09 01:41:04', NULL),
(97, 'Shorts', NULL, 24, '2022-07-09 01:41:22', NULL),
(98, 'Skirts & Skorts', NULL, 24, '2022-07-09 01:41:44', NULL),
(99, 'Sleepwear & Robes', NULL, 24, '2022-07-09 01:41:59', NULL),
(100, 'Tops, T-Shirts', NULL, 24, '2022-07-09 01:42:21', NULL),
(101, 'Socks, Tights & Leggings', NULL, 24, '2022-07-09 01:42:52', NULL),
(102, 'Trousers', NULL, 24, '2022-07-09 01:43:15', NULL),
(103, 'Underwear', NULL, 24, '2022-07-09 01:43:31', NULL),
(104, 'Swimwear', NULL, 24, '2022-07-09 01:43:56', NULL),
(105, 'Hoodies & Sweatshirts', NULL, 24, '2022-07-09 01:44:20', NULL),
(106, 'Blazers', NULL, 24, '2022-07-09 01:44:37', NULL),
(107, 'Coats, Jackets', NULL, 24, '2022-07-09 01:44:54', NULL),
(108, 'Snow & Rainwear', NULL, 24, '2022-07-09 01:45:09', NULL),
(109, 'Activewear', NULL, 24, '2022-07-09 01:45:33', NULL),
(110, 'Dungarees & Jumpsuits', NULL, 24, '2022-07-09 01:45:47', NULL),
(111, 'One Size', NULL, 25, '2022-07-09 20:50:34', NULL),
(112, '1 year', NULL, 25, '2022-07-09 20:50:54', NULL),
(113, '2 year', NULL, 25, '2022-07-09 20:51:03', NULL),
(114, '3 years', NULL, 25, '2022-07-09 20:51:18', NULL),
(115, '4 years', NULL, 25, '2022-07-09 20:51:38', NULL),
(116, '5 years', NULL, 25, '2022-07-09 20:51:47', NULL),
(117, '6 years', NULL, 25, '2022-07-09 20:52:11', NULL),
(118, '7 years', NULL, 25, '2022-07-09 20:52:24', NULL),
(119, '8 years', NULL, 25, '2022-07-09 20:52:52', NULL),
(120, '9 years', NULL, 25, '2022-07-09 20:53:01', NULL),
(121, '10 years', NULL, 25, '2022-07-09 20:53:10', NULL),
(122, '11 years', NULL, 25, '2022-07-09 20:53:34', NULL),
(123, '12 years', NULL, 25, '2022-07-09 20:53:58', NULL),
(124, '13 years', NULL, 25, '2022-07-09 20:54:21', NULL),
(125, '14 years', NULL, 25, '2022-07-09 20:54:45', NULL),
(126, '15 years', NULL, 25, '2022-07-09 20:55:11', NULL),
(127, '16 years', NULL, 25, '2022-07-09 20:55:31', NULL),
(128, '17 years', NULL, 25, '2022-07-09 20:55:41', NULL),
(129, 'Cotton', NULL, 26, '2022-07-09 21:00:18', NULL),
(130, 'Nylon', NULL, 26, '2022-07-09 21:00:47', NULL),
(131, 'Polyester', NULL, 26, '2022-07-09 21:01:03', NULL),
(132, 'Acrylic', NULL, 26, '2022-07-09 21:01:15', NULL),
(133, 'Viscose', NULL, 26, '2022-07-09 21:01:30', NULL),
(134, 'Floral', NULL, 27, '2022-07-09 21:03:13', NULL),
(135, 'Cartoon', NULL, 27, '2022-07-09 21:03:27', NULL),
(136, 'Argyle', NULL, 27, '2022-07-09 21:03:42', NULL),
(137, 'Camouflage', NULL, 27, '2022-07-09 21:04:21', NULL),
(138, 'Animal Print', NULL, 27, '2022-07-09 21:05:12', NULL),
(139, 'Fruits', NULL, 27, '2022-07-09 21:05:32', NULL),
(140, 'Geometric', NULL, 27, '2022-07-09 21:06:36', NULL),
(141, 'Hearts', NULL, 27, '2022-07-09 21:06:55', NULL),
(142, 'Letter Print', NULL, 27, '2022-07-09 21:07:13', NULL),
(143, 'Plaid', NULL, 27, '2022-07-09 21:07:29', NULL),
(144, 'Polka Dots', NULL, 27, '2022-07-09 21:07:44', NULL),
(145, 'Solid', NULL, 27, '2022-07-09 21:07:57', NULL),
(146, 'Stars', NULL, 27, '2022-07-09 21:08:12', NULL),
(147, 'Striped', NULL, 27, '2022-07-09 21:08:27', NULL),
(148, 'PUMA', NULL, 28, '2022-07-09 21:10:40', NULL),
(149, 'Beechfield', NULL, 28, '2022-07-09 21:10:54', NULL),
(150, 'Fruit of the Loom', NULL, 28, '2022-07-09 21:11:06', NULL),
(151, 'ZARA', NULL, 28, '2022-07-09 21:11:14', NULL),
(152, 'Yueshop', NULL, 28, '2022-07-09 21:11:28', NULL),
(153, 'accsa', NULL, 28, '2022-07-09 21:12:48', NULL),
(154, 'Boots', NULL, 29, '2022-07-09 21:19:28', NULL),
(155, 'Clogs & Mules', '1657406603_211112121636-underscored-crocs-travel.jpg', 29, '2022-07-09 22:43:23', NULL),
(156, 'Boat Shoes', NULL, 29, '2022-07-09 22:47:28', NULL),
(157, 'Court Shoes', NULL, 29, '2022-07-09 22:49:06', NULL),
(158, 'Fashion & Athletic', NULL, 29, '2022-07-09 22:49:20', NULL),
(159, 'Trainers', NULL, 29, '2022-07-09 22:49:35', NULL),
(160, 'Flip Flops & Thongs', NULL, 29, '2022-07-09 22:49:49', NULL),
(161, 'Lace-Up Flats', NULL, 29, '2022-07-09 22:49:59', NULL),
(162, 'Loafer Flats', NULL, 29, '2022-07-09 22:50:10', NULL),
(163, 'Mary Janes', NULL, 29, '2022-07-09 22:50:23', NULL),
(164, 'Sandals', NULL, 29, '2022-07-09 22:50:37', NULL),
(165, 'Slippers', NULL, 29, '2022-07-09 22:50:48', NULL),
(166, 'Ballet Flats', NULL, 29, '2022-07-09 22:51:12', NULL),
(167, '0', NULL, 30, '2022-07-09 22:58:49', NULL),
(168, '0.5', NULL, 30, '2022-07-09 22:59:03', NULL),
(169, '1.0', NULL, 30, '2022-07-09 23:00:25', NULL),
(170, '1.5', NULL, 30, '2022-07-09 23:00:39', NULL),
(171, '2.0', NULL, 30, '2022-07-09 23:00:48', NULL),
(172, '2.5', NULL, 30, '2022-07-09 23:01:41', NULL),
(173, '3.0', NULL, 30, '2022-07-09 23:01:52', NULL),
(174, '3.5', NULL, 30, '2022-07-09 23:02:02', NULL),
(175, '4.0', NULL, 30, '2022-07-09 23:02:22', NULL),
(176, '4.5', NULL, 30, '2022-07-09 23:02:32', NULL),
(177, '5.0', NULL, 30, '2022-07-09 23:02:41', NULL),
(178, '5.5', NULL, 30, '2022-07-09 23:03:03', NULL),
(179, '6.0', NULL, 30, '2022-07-09 23:03:14', NULL),
(180, '6.5', NULL, 30, '2022-07-09 23:03:37', NULL),
(181, '7.0', NULL, 30, '2022-07-09 23:03:49', NULL),
(182, '7.5', NULL, 30, '2022-07-09 23:04:13', NULL),
(183, '8.0', NULL, 30, '2022-07-09 23:04:57', NULL),
(184, '8.5', NULL, 30, '2022-07-09 23:05:16', NULL),
(185, '9.0', NULL, 30, '2022-07-09 23:05:25', NULL),
(186, '9.5', NULL, 30, '2022-07-09 23:07:19', NULL),
(187, '10.0', NULL, 30, '2022-07-09 23:07:30', NULL),
(188, '10.5', NULL, 30, '2022-07-09 23:07:47', NULL),
(189, '11.0', NULL, 30, '2022-07-09 23:07:55', NULL),
(190, '11.5', NULL, 30, '2022-07-09 23:08:18', NULL),
(192, '12.0', NULL, 30, '2022-07-09 23:09:28', NULL),
(193, '12.5', NULL, 30, '2022-07-09 23:09:43', NULL),
(194, '13.0', NULL, 30, '2022-07-09 23:10:09', NULL),
(195, 'B 1', NULL, 31, '2022-07-09 23:11:56', NULL),
(196, 'B 1.5', NULL, 31, '2022-07-09 23:12:21', NULL),
(197, 'B 2', NULL, 31, '2022-07-09 23:12:37', NULL),
(198, 'B 2.5', NULL, 31, '2022-07-09 23:13:05', NULL),
(199, 'B 3', NULL, 31, '2022-07-09 23:13:14', NULL),
(200, 'B 3.5', NULL, 31, '2022-07-09 23:13:37', NULL),
(201, 'B 4', NULL, 31, '2022-07-09 23:13:44', NULL),
(202, 'B 4.5', NULL, 31, '2022-07-09 23:14:07', NULL),
(203, 'B 5', NULL, 31, '2022-07-09 23:14:15', NULL),
(204, 'B 5.5', NULL, 31, '2022-07-09 23:14:29', NULL),
(205, 'B 6', NULL, 31, '2022-07-09 23:14:36', NULL),
(206, 'Buckle', '1657698494_air-max-pre-day-shoes-jMh2rB.jfif', 32, '2022-07-09 23:16:39', '2022-07-13 07:48:14'),
(207, 'Hook & Loop', '1657698492_air-max-pre-day-shoes-jMh2rB.jfif', 32, '2022-07-09 23:16:58', '2022-07-13 07:48:12'),
(208, 'Lace-Up', '1657698487_air-max-pre-day-shoes-jMh2rB.jfif', 32, '2022-07-09 23:20:11', '2022-07-13 07:48:07'),
(209, 'Slip On', '1657698484_air-max-pre-day-shoes-jMh2rB.jfif', 32, '2022-07-09 23:20:31', '2022-07-13 07:48:04'),
(210, 'Zip', '1657698476_air-max-pre-day-shoes-jMh2rB.jfif', 32, '2022-07-09 23:20:52', '2022-07-13 07:47:56'),
(211, 'Analog', NULL, 34, '2022-07-11 18:01:58', NULL),
(212, 'Digital', NULL, 34, '2022-07-11 18:02:09', NULL),
(213, 'Chronograph', NULL, 34, '2022-07-11 18:02:20', NULL),
(214, 'Analogue - Digital', NULL, 34, '2022-07-11 18:03:10', NULL),
(215, 'Bangle', NULL, 35, '2022-07-11 18:06:00', NULL),
(216, 'Bracelet', NULL, 35, '2022-07-11 18:06:09', NULL),
(217, 'Cuff', NULL, 35, '2022-07-11 18:06:23', NULL),
(218, 'Strap', NULL, 35, '2022-07-11 18:06:37', NULL),
(219, 'Buckle Backpack', NULL, 36, '2022-07-11 18:18:38', '2022-07-11 18:19:17'),
(220, 'Button Backpack', NULL, 36, '2022-07-11 18:19:58', NULL),
(221, 'Drawstring Backpack', NULL, 36, '2022-07-11 18:20:46', NULL),
(222, 'Flap Backpack', NULL, 36, '2022-07-11 18:21:21', NULL),
(223, 'Hook and Loop', NULL, 36, '2022-07-11 18:22:04', NULL),
(224, 'Snap Backpack', NULL, 36, '2022-07-11 18:22:39', NULL),
(225, 'Zipper Backpack', NULL, 36, '2022-07-11 18:32:36', NULL),
(226, 'Brand New', NULL, 37, '2022-07-11 18:36:52', NULL),
(227, 'Used Product', NULL, 37, '2022-07-11 18:37:07', NULL),
(228, 'Boys Activewear', NULL, 38, '2022-07-11 19:13:21', NULL),
(229, 'Boys Coat, Jackets & Gilets', NULL, 38, '2022-07-11 19:14:48', NULL),
(230, 'Boys Dungarees', NULL, 38, '2022-07-11 19:15:12', NULL),
(231, 'Boys Hoodies & Sweatshirt', NULL, 38, '2022-07-11 19:15:45', NULL),
(232, 'Boys Jeans', NULL, 38, '2022-07-11 19:16:03', NULL),
(233, 'Boys Knitwear', NULL, 38, '2022-07-11 19:16:53', NULL),
(234, 'Boys Outfits & Clothing Set', NULL, 38, '2022-07-11 19:17:36', NULL),
(235, 'Boys Shorts', NULL, 38, '2022-07-11 19:18:06', NULL),
(236, 'Boys Sleepwear & Robs', NULL, 38, '2022-07-11 19:18:39', NULL),
(237, 'Boys Snow and Rainwear', NULL, 38, '2022-07-11 19:19:54', NULL),
(238, 'Boys Socks and Hosiery', NULL, 38, '2022-07-11 19:20:49', NULL),
(239, 'Boys Suit and Blazers', NULL, 38, '2022-07-11 19:21:42', NULL),
(240, 'Boys Swimwear', NULL, 38, '2022-07-11 19:22:16', NULL),
(241, 'Boys Tops, Tshirts, and Shirts', NULL, 38, '2022-07-11 19:23:40', NULL),
(242, 'Boys Trousers', NULL, 38, '2022-07-11 19:24:19', NULL),
(243, 'Boys Underwear', NULL, 38, '2022-07-11 19:24:43', NULL),
(244, 'Free Size', NULL, 39, '2022-07-11 19:32:14', NULL),
(245, '2 years', NULL, 39, '2022-07-11 19:32:52', NULL),
(246, '3 year', NULL, 39, '2022-07-11 19:33:24', NULL),
(247, '4 year', NULL, 39, '2022-07-11 19:33:50', NULL),
(248, '5 year', NULL, 39, '2022-07-11 19:33:56', '2022-07-11 19:35:15'),
(249, '6 year', NULL, 39, '2022-07-11 19:34:05', NULL),
(250, '7 year', NULL, 39, '2022-07-11 19:34:14', NULL),
(251, '8 year', NULL, 39, '2022-07-11 19:34:23', NULL),
(252, '9 year', NULL, 39, '2022-07-11 19:34:32', NULL),
(253, '10 year', NULL, 39, '2022-07-11 19:35:42', NULL),
(254, '11 year', NULL, 39, '2022-07-11 20:36:48', NULL),
(255, '12 year', NULL, 39, '2022-07-11 20:36:56', NULL),
(256, '13 year', NULL, 39, '2022-07-11 20:37:04', NULL),
(257, '14 year', NULL, 39, '2022-07-11 20:37:12', NULL),
(258, '15 year', NULL, 39, '2022-07-11 20:37:19', NULL),
(259, 'Cotton Fabric', NULL, 40, '2022-07-11 21:06:56', '2022-07-11 21:12:09'),
(260, 'Flax fabric', NULL, 40, '2022-07-11 21:08:10', NULL),
(261, 'Lenin & Synthetic Fabric', NULL, 40, '2022-07-11 21:09:33', '2022-07-11 23:49:26'),
(262, 'Polyester Polymers', NULL, 40, '2022-07-11 21:10:21', NULL),
(263, 'Viscose Fabric', NULL, 40, '2022-07-11 21:11:53', NULL),
(264, 'Camouflage Pattern', NULL, 41, '2022-07-11 23:52:25', NULL),
(265, 'Checkered Shoes', NULL, 4, '2022-07-11 23:52:48', '2022-07-15 11:10:48'),
(266, 'Floral Pattern', NULL, 41, '2022-07-11 23:53:16', NULL),
(267, 'Geometric Pattern', NULL, 41, '2022-07-11 23:53:45', NULL),
(268, 'Plaid Pattern', NULL, 41, '2022-07-11 23:54:15', NULL),
(269, 'Solid Colors', NULL, 41, '2022-07-11 23:54:44', NULL),
(270, 'Striped & Lines', NULL, 41, '2022-07-11 23:57:36', NULL),
(271, 'Polka Dots and Stars', NULL, 41, '2022-07-11 23:58:03', NULL),
(272, 'Casual Shoes', NULL, 42, '2022-07-12 00:01:47', '2022-07-15 11:16:05'),
(273, 'Formal Shoes', NULL, 42, '2022-07-12 00:02:07', '2022-07-15 11:15:16'),
(274, 'Sports Shoes', NULL, 42, '2022-07-12 00:02:31', '2022-07-15 11:15:02'),
(275, 'Clogs', NULL, 42, '2022-07-12 00:02:56', '2022-07-15 11:14:40'),
(276, 'Boots and Hunters', NULL, 42, '2022-07-12 00:03:27', NULL),
(277, 'Sneakers and Flat Sole', NULL, 42, '2022-07-12 00:04:19', '2022-07-12 00:08:06'),
(278, 'Flipflops and Slippers', NULL, 42, '2022-07-12 00:04:45', NULL),
(279, 'Sandals and Espadrille', NULL, 42, '2022-07-12 00:06:00', NULL),
(280, 'Penny Loafer', NULL, 42, '2022-07-12 00:07:28', NULL),
(281, 'L 0', NULL, 43, '2022-07-12 00:09:45', NULL),
(282, 'L 0.5', NULL, 43, '2022-07-12 00:09:58', NULL),
(283, 'L 1', NULL, 43, '2022-07-12 00:10:09', NULL),
(284, 'L 1.5', NULL, 43, '2022-07-12 00:10:32', NULL),
(285, 'L 2', NULL, 43, '2022-07-12 00:11:09', NULL),
(286, 'L 2.5', NULL, 43, '2022-07-12 00:11:31', NULL),
(287, 'L 3', NULL, 43, '2022-07-12 00:11:39', NULL),
(288, 'L 3.5', NULL, 43, '2022-07-12 00:11:54', NULL),
(289, 'L 4', NULL, 43, '2022-07-12 00:12:02', NULL),
(290, 'L 4.5', NULL, 43, '2022-07-12 00:12:12', NULL),
(291, 'L 5', NULL, 43, '2022-07-12 00:12:21', NULL),
(292, 'L 5.5', NULL, 43, '2022-07-12 00:12:33', NULL),
(293, 'L 6', NULL, 43, '2022-07-12 00:12:43', NULL),
(294, 'L 6.5', NULL, 43, '2022-07-12 00:12:52', NULL),
(295, 'L 7', NULL, 43, '2022-07-12 00:13:06', NULL),
(296, 'L 7.5', NULL, 43, '2022-07-12 00:13:16', NULL),
(297, 'L 8', NULL, 43, '2022-07-12 00:13:25', NULL),
(298, 'L 8.5', NULL, 43, '2022-07-12 00:14:04', NULL),
(299, 'L 9', NULL, 43, '2022-07-12 00:14:11', NULL),
(300, 'L 9.5', NULL, 43, '2022-07-12 00:14:29', NULL),
(301, 'L 10', NULL, 43, '2022-07-12 00:14:40', NULL),
(302, 'L 10.5', NULL, 43, '2022-07-12 00:14:52', NULL),
(303, 'L 11', NULL, 43, '2022-07-12 00:15:00', NULL),
(304, 'L 11.5', NULL, 43, '2022-07-12 00:15:09', NULL),
(305, 'L 12', NULL, 43, '2022-07-12 00:15:22', NULL),
(306, 'Analogue Style', NULL, 44, '2022-07-12 00:20:35', '2022-07-12 00:22:57'),
(307, 'Digital Style', NULL, 44, '2022-07-12 00:21:54', '2022-07-12 00:23:06'),
(308, 'Analogue - Digital Style', NULL, 44, '2022-07-12 00:22:14', '2022-07-12 00:23:25'),
(309, 'Bracelet Style', NULL, 45, '2022-07-12 00:25:46', NULL),
(310, 'Strap Type', NULL, 45, '2022-07-12 00:26:01', NULL),
(313, 'New', NULL, 46, '2022-07-12 00:41:15', NULL),
(314, 'Used', NULL, 46, '2022-07-12 00:41:25', NULL),
(315, 'White', '1657587016_download (2).png', 4, '2022-07-12 00:50:16', NULL),
(316, 'Navy Blue', '1657587070_316HGjHjW4L._SY679_.jpg', 4, '2022-07-12 00:51:10', NULL),
(317, 'Grey', '1657587147_TH_24567080_24594080_24596080_24601080_24563080_24565080_24588080_001.jpg', 4, '2022-07-12 00:52:27', NULL),
(318, 'Red', '1657587242_Red_Color.jpg', 4, '2022-07-12 00:54:02', NULL),
(319, 'Pink', '1657587332_pink-color.webp', 4, '2022-07-12 00:55:32', NULL),
(320, 'Brown', '1657587374_1024px-Solid_brown.svg.png', 4, '2022-07-12 00:56:14', NULL),
(321, 'Green', '1657587422_Flag_of_Libya_(1977–2011,_3-2).svg.png', 4, '2022-07-12 00:57:02', NULL),
(323, 'Yellow', '1657587509_maxresdefault.jpg', 4, '2022-07-12 00:58:29', NULL),
(324, 'Orange', '1657587579_download (3).png', 4, '2022-07-12 00:59:39', NULL),
(325, 'Multicolor', '1657587646_multiple-tiles-accent-wall.jpg', 4, '2022-07-12 01:00:05', '2022-07-12 01:01:11'),
(326, 'Insect Food', NULL, 48, '2022-07-13 20:00:33', NULL),
(327, 'Health Supplies for Insects', NULL, 48, '2022-07-13 20:01:02', NULL),
(328, 'Insect Terrariums', NULL, 48, '2022-07-13 20:01:46', NULL),
(329, 'Horse Food', NULL, 49, '2022-07-13 20:03:47', NULL),
(330, 'Grooming Products for Horse', NULL, 49, '2022-07-13 20:04:06', NULL),
(331, 'Health Supplies for Horses', NULL, 49, '2022-07-13 20:04:19', NULL),
(332, 'Horsewear & Bandaging', NULL, 49, '2022-07-13 20:04:34', NULL),
(333, 'Livestock Stall Supplies', NULL, 49, '2022-07-13 20:04:46', NULL),
(334, 'Feeding & Watering Supplies for Horses', NULL, 49, '2022-07-13 20:04:59', NULL),
(335, 'Tack', NULL, 49, '2022-07-13 20:05:18', NULL),
(336, 'Horse Treats', NULL, 49, '2022-07-13 20:05:30', NULL),
(337, 'Collars, Harnesses & Leads for Small Animals', NULL, 50, '2022-07-13 20:07:37', NULL),
(338, 'Small Animal Exercise Wheels', NULL, 50, '2022-07-13 20:07:49', NULL),
(339, 'Carriers & Transport Accessories for Small Animals', NULL, 50, '2022-07-13 20:08:01', NULL),
(340, 'Small Animal Food', NULL, 50, '2022-07-13 20:08:13', NULL),
(341, 'Grooming Products for Small Animals', NULL, 50, '2022-07-13 20:08:27', NULL),
(342, 'Habitats & Bedding for Small Animals', NULL, 50, '2022-07-13 20:08:39', NULL),
(343, 'Small Pet\'s Hay & Grass', NULL, 50, '2022-07-13 20:08:51', NULL),
(344, 'Health Supplies for Small Animals', NULL, 50, '2022-07-13 20:09:06', NULL),
(345, 'Odour & Stain Removers for Small Animals', NULL, 50, '2022-07-13 20:09:16', NULL),
(346, 'Toys for Small Animals', NULL, 50, '2022-07-13 20:09:30', NULL),
(347, 'Small Animal Treats', NULL, 50, '2022-07-13 20:09:43', NULL),
(348, 'Feeding & Watering Supplies for Small Animals', NULL, 50, '2022-07-13 20:10:03', NULL),
(349, 'Bird Food', NULL, 51, '2022-07-13 20:12:08', NULL),
(350, 'Health Supplies for Birds', NULL, 51, '2022-07-13 20:12:20', NULL),
(351, 'Bird Treats', NULL, 51, '2022-07-13 20:12:31', NULL),
(352, 'Birdcages', NULL, 51, '2022-07-13 20:12:49', NULL),
(353, 'Birdcage Accessories', NULL, 51, '2022-07-13 20:13:01', NULL),
(354, 'Feeding & Watering Supplies for Birds', NULL, 51, '2022-07-13 20:13:14', NULL),
(355, 'Toys for Birds', NULL, 51, '2022-07-13 20:13:29', NULL),
(356, 'Bird Diapers', NULL, 51, '2022-07-13 20:13:44', NULL),
(357, 'Bird Carriers', NULL, 51, '2022-07-13 20:13:55', NULL),
(358, 'Fish Food', NULL, 52, '2022-07-13 20:15:51', NULL),
(359, 'Health Supplies for Fish & Aquatic Pets', NULL, 52, '2022-07-13 20:16:06', NULL),
(360, 'Aquariums & Accessories', NULL, 52, '2022-07-13 20:16:23', NULL),
(361, 'Pond Equipment', NULL, 52, '2022-07-13 20:16:35', NULL),
(362, 'Dry Cat Food', NULL, 53, '2022-07-13 20:18:28', NULL),
(363, 'Wet Cat Food', NULL, 53, '2022-07-13 20:18:38', NULL),
(364, 'Cat Treats', NULL, 53, '2022-07-13 20:19:03', NULL),
(365, 'Feeding & Watering Supplies for Cats', NULL, 53, '2022-07-13 20:19:20', NULL),
(366, 'Health Supplies for Cats', NULL, 53, '2022-07-13 20:19:34', NULL),
(367, 'Grooming Products for Cats', NULL, 53, '2022-07-13 20:19:46', NULL),
(368, 'Flea, Lice & Tick Control for Cats', NULL, 53, '2022-07-13 20:19:59', NULL),
(369, 'Cat Beds, Bedding & Furniture', NULL, 53, '2022-07-13 20:20:12', NULL),
(370, 'Cat Carriers & Travel Products', NULL, 53, '2022-07-13 20:20:22', NULL),
(371, 'Cat Doors & Enclosures', NULL, 53, '2022-07-13 20:20:35', NULL),
(372, 'Cat Clothing', NULL, 53, '2022-07-13 20:20:46', NULL),
(373, 'Cat Collars, Harnesses & Leads', NULL, 53, '2022-07-13 20:20:57', NULL),
(374, 'Educational Cat Repellents', NULL, 53, '2022-07-13 20:21:08', NULL),
(375, 'Litter & Housetraining for Cats', NULL, 53, '2022-07-13 20:21:25', NULL),
(376, 'Cat Memorials & Funerary', NULL, 53, '2022-07-13 20:21:38', NULL),
(377, 'Pet Cameras', NULL, 53, '2022-07-13 20:21:50', NULL),
(378, 'Cat Toys', NULL, 53, '2022-07-13 20:22:01', NULL),
(379, 'Dry Dog Food', NULL, 54, '2022-07-13 20:25:25', NULL),
(380, 'Wet Dog Food', NULL, 54, '2022-07-13 20:25:35', NULL),
(381, 'Dog Treats', NULL, 54, '2022-07-13 20:25:50', NULL),
(382, 'Training & Behaviour Aids for Dogs', NULL, 54, '2022-07-13 20:26:13', NULL),
(383, 'Dog Toys', NULL, 54, '2022-07-13 20:26:31', NULL),
(384, 'Beds, Bedding & Furniture for Dogs', NULL, 54, '2022-07-13 20:26:46', NULL),
(385, 'Carriers & Travel Products for Dogs', NULL, 54, '2022-07-13 20:26:56', NULL),
(386, 'Clothing & Accessories for Dogs', NULL, 54, '2022-07-13 20:27:07', NULL),
(387, 'Collars, Harnesses & Leads for Dogs', NULL, 54, '2022-07-13 20:27:20', NULL),
(388, 'Dog Crates, Houses & Pens', NULL, 54, '2022-07-13 20:27:32', NULL),
(389, 'Doors, Gates & Ramps for Dogs', NULL, 54, '2022-07-13 20:27:42', NULL),
(390, 'Feeding & Watering Supplies for Dogs', NULL, 54, '2022-07-13 20:28:03', NULL),
(391, 'Flea, Lice & Tick Control for Dogs', NULL, 54, '2022-07-13 20:28:13', NULL),
(392, 'Grooming Products for Dogs', NULL, 54, '2022-07-13 20:29:27', NULL),
(393, 'Health Supplies for Dogs', NULL, 54, '2022-07-13 20:29:37', NULL),
(394, 'Litter & Housetraining for Dogs', NULL, 54, '2022-07-13 20:29:52', NULL),
(395, 'Dog Memorials & Funerary', NULL, 54, '2022-07-13 20:30:04', NULL),
(396, 'Pocket & Fob Watches', NULL, 34, '2022-07-13 20:35:09', '2022-07-14 12:32:42'),
(397, 'Quartz', NULL, 57, '2022-07-14 12:35:21', NULL),
(398, 'Automatic', NULL, 57, '2022-07-14 12:35:33', NULL),
(399, 'Asymmetrical', NULL, 58, '2022-07-14 12:40:27', NULL),
(400, 'Oval', NULL, 58, '2022-07-14 12:40:42', NULL),
(401, 'Rectangular', NULL, 58, '2022-07-14 12:40:59', NULL),
(402, 'Round', NULL, 58, '2022-07-14 12:41:13', NULL),
(403, 'Square', NULL, 58, '2022-07-14 12:41:26', NULL),
(404, 'Tonneau', NULL, 58, '2022-07-14 12:41:41', NULL),
(405, 'Brass', NULL, 59, '2022-07-14 12:43:29', NULL),
(406, 'Plastic', NULL, 59, '2022-07-14 12:43:46', NULL),
(407, 'Resin', NULL, 59, '2022-07-14 12:43:57', NULL),
(408, 'Rubber', NULL, 59, '2022-07-14 12:44:07', NULL),
(409, 'Stainless Steal', NULL, 59, '2022-07-14 12:44:29', NULL),
(410, 'Up to 19 mm', NULL, 60, '2022-07-14 12:45:58', NULL),
(411, '20 mm to 29 mm', NULL, 60, '2022-07-14 12:47:34', NULL),
(412, '30 mm to 39 mm', NULL, 60, '2022-07-14 12:48:05', NULL),
(413, '40 mm to 49 mm', NULL, 60, '2022-07-14 12:48:31', NULL),
(414, '50 mm & Above', NULL, 60, '2022-07-14 12:48:50', NULL),
(415, 'Upto 4 mm', NULL, 61, '2022-07-14 12:51:24', NULL),
(416, '5 to 9 mm', NULL, 61, '2022-07-14 12:51:36', NULL),
(417, '10 to 14 mm', NULL, 61, '2022-07-14 12:51:47', NULL),
(418, '15 mm to 19 mm', NULL, 61, '2022-07-14 12:52:23', NULL),
(419, '20 mm & Above', NULL, 61, '2022-07-14 12:52:41', NULL),
(420, 'Acrylic Crystals', NULL, 62, '2022-07-14 12:58:48', NULL),
(421, 'Glass', NULL, 62, '2022-07-14 12:59:00', NULL),
(422, 'Hardlex', NULL, 62, '2022-07-14 12:59:16', NULL),
(423, 'Mineral', NULL, 62, '2022-07-14 12:59:28', NULL),
(424, 'Plastic Material', NULL, 62, '2022-07-14 13:00:31', NULL),
(425, 'Sapphire', NULL, 62, '2022-07-14 13:00:46', NULL),
(426, 'Diamond', NULL, 63, '2022-07-14 13:02:25', NULL),
(427, 'Gemstone', NULL, 63, '2022-07-14 13:02:38', NULL),
(428, 'Rhinestone', NULL, 63, '2022-07-14 13:02:51', NULL),
(429, 'Alarm', NULL, 64, '2022-07-14 21:56:09', NULL),
(430, 'Backlight', NULL, 64, '2022-07-14 21:56:28', NULL),
(431, 'Calendar', NULL, 64, '2022-07-14 21:56:41', NULL),
(432, 'Chronograph Movement', NULL, 64, '2022-07-14 21:57:21', NULL),
(433, 'Countdown', NULL, 64, '2022-07-14 21:57:36', NULL),
(434, 'Solar Powered', NULL, 64, '2022-07-14 21:57:51', NULL),
(435, 'Stop Watch', NULL, 64, '2022-07-14 21:58:04', NULL),
(436, 'Wireless Charging', NULL, 64, '2022-07-14 21:59:09', NULL),
(437, 'Calling', NULL, 64, '2022-07-14 21:59:20', NULL),
(438, 'Camera', NULL, 64, '2022-07-14 21:59:32', NULL),
(439, 'Memory Card', NULL, 64, '2022-07-14 22:00:16', NULL),
(440, 'Waterproof', NULL, 64, '2022-07-14 22:02:57', NULL),
(441, 'Anti-lost Feature', NULL, 64, '2022-07-14 22:03:29', NULL),
(442, 'SMS Message Reminder', NULL, 64, '2022-07-14 22:04:02', NULL),
(443, 'Smart Watch', NULL, 34, '2022-07-14 22:05:29', NULL),
(444, 'Up to 9 m', NULL, 65, '2022-07-14 22:08:18', NULL),
(445, '10 m to 29 m', NULL, 65, '2022-07-14 22:08:42', NULL),
(446, '30 m to 49 m', NULL, 65, '2022-07-14 22:09:12', NULL),
(447, '50 m to 99 m', NULL, 65, '2022-07-14 22:09:28', NULL),
(448, '100 m to 199 m', NULL, 65, '2022-07-14 22:10:01', NULL),
(449, '200 m & Above', NULL, 65, '2022-07-14 22:10:45', NULL),
(450, 'Fine Jewelry', NULL, 66, '2022-07-14 22:14:41', NULL),
(451, 'Necklace & Pendants', NULL, 66, '2022-07-14 22:15:07', NULL),
(452, 'Jewelry Set', NULL, 66, '2022-07-14 22:15:29', NULL),
(453, 'Bracelets', NULL, 66, '2022-07-14 22:15:42', NULL),
(454, 'Earrings', NULL, 66, '2022-07-14 22:15:58', NULL),
(455, 'Rings', NULL, 66, '2022-07-14 22:16:10', NULL),
(456, 'Anklets', NULL, 66, '2022-07-14 22:16:23', NULL),
(457, 'Masquerade & Cosplay', NULL, 66, '2022-07-14 22:17:13', NULL),
(458, 'Headware & Brooches', NULL, 66, '2022-07-14 22:17:35', NULL),
(459, 'Magnetic & healing jewelry', NULL, 66, '2022-07-14 22:18:03', NULL),
(460, 'Keychain & Ornaments', NULL, 66, '2022-07-14 22:18:30', NULL),
(461, 'Jewelry Supplies', NULL, 66, '2022-07-14 22:19:33', NULL),
(462, 'Bangle & Cuff', NULL, 66, '2022-07-14 22:19:53', NULL),
(463, 'Body Jewelry', NULL, 66, '2022-07-14 22:20:38', NULL),
(464, 'Couple Jewelry', NULL, 66, '2022-07-14 22:21:01', NULL),
(465, 'DIY Jewelry', NULL, 66, '2022-07-14 22:21:27', NULL),
(466, 'Tweezers', NULL, 67, '2022-07-14 22:24:41', NULL),
(467, 'Loupes Magnifier', NULL, 67, '2022-07-14 22:25:03', NULL),
(468, 'Watch Repair Tool set', NULL, 67, '2022-07-14 22:25:42', NULL),
(469, 'Watch strap Spring bars', NULL, 67, '2022-07-14 22:26:33', NULL),
(470, 'Other Watch tools', NULL, 67, '2022-07-14 22:27:08', NULL),
(471, 'Up to 2 years', NULL, 68, '2022-07-15 07:26:01', NULL),
(472, '3 to 5 years', NULL, 68, '2022-07-15 07:26:19', NULL),
(473, '5 to 7 years', NULL, 68, '2022-07-15 07:26:35', '2022-07-15 07:29:39'),
(474, '7 to 10 years', NULL, 68, '2022-07-15 07:27:26', NULL),
(475, '10 to 12 years', NULL, 68, '2022-07-15 07:27:41', NULL),
(476, '12 to 15 years', NULL, 68, '2022-07-15 07:28:00', '2022-07-15 07:28:37'),
(477, '15 years & Above', NULL, 68, '2022-07-15 07:28:15', NULL),
(478, 'Rc Drones', NULL, 69, '2022-07-15 07:47:33', NULL),
(479, 'Rc Helicopter', NULL, 69, '2022-07-15 07:47:57', NULL),
(480, 'Rc Quadcopter', NULL, 69, '2022-07-15 07:48:14', NULL),
(481, 'Rc Airplane', NULL, 69, '2022-07-15 07:48:29', NULL),
(482, 'FPV Racing Drones', NULL, 69, '2022-07-15 07:48:51', '2022-07-15 07:49:00'),
(483, 'Rc Car', NULL, 69, '2022-07-15 07:49:29', NULL),
(484, 'Rc Boat', NULL, 69, '2022-07-15 07:49:57', NULL),
(485, 'Rc Parts', NULL, 69, '2022-07-15 07:50:17', NULL),
(486, 'Multi Rotor Parts', NULL, 69, '2022-07-15 07:50:49', NULL),
(487, 'Radios & Recievers', NULL, 69, '2022-07-15 07:51:58', NULL),
(488, 'Battery & Chargers', NULL, 69, '2022-07-15 07:52:17', NULL),
(489, 'Musical Instruments', NULL, 69, '2022-07-15 07:52:35', NULL),
(490, 'Dolls & Stuffed Toys', NULL, 69, '2022-07-15 07:53:12', NULL),
(491, 'Learning & Education', NULL, 69, '2022-07-15 07:54:20', NULL),
(492, 'Puppets & Theatre Puppets', NULL, 69, '2022-07-15 07:55:15', NULL),
(493, 'Building & Construction Toys', NULL, 69, '2022-07-15 07:55:49', NULL),
(494, 'Dress up & Pretend Play', NULL, 69, '2022-07-15 07:56:40', NULL),
(495, 'Barbie', NULL, 70, '2022-07-15 07:59:47', NULL),
(496, 'Disney', NULL, 70, '2022-07-15 07:59:59', NULL),
(497, 'Harry Potter', NULL, 70, '2022-07-15 08:00:09', NULL),
(498, 'Paw Patrol', NULL, 70, '2022-07-15 08:00:31', NULL),
(499, 'Pokémon', NULL, 70, '2022-07-15 08:00:45', NULL),
(500, 'Spider Man', NULL, 70, '2022-07-15 08:01:00', NULL),
(501, 'Iron Man', NULL, 70, '2022-07-15 08:01:11', NULL),
(502, 'Thor', NULL, 70, '2022-07-15 08:01:25', NULL),
(503, 'Star Wars', NULL, 70, '2022-07-15 08:01:59', NULL),
(504, 'Hulk', NULL, 70, '2022-07-15 08:03:43', NULL),
(505, 'Vision', NULL, 70, '2022-07-15 08:03:52', NULL),
(506, 'Wanda', NULL, 70, '2022-07-15 08:04:00', NULL),
(507, 'Others', NULL, 70, '2022-07-15 08:04:27', NULL),
(508, 'Hotel Chocolat', '1657872628_FF2C5D07-500B-4006-9658-C8DD5C205BBD.png', 71, '2022-07-15 08:10:28', NULL),
(509, 'Prestat', '1657872694_936F2F54-7005-46F9-9873-BB3368FD8D9A.png', 71, '2022-07-15 08:11:34', NULL),
(510, 'Brindisa', '1657872753_669A1402-6E99-48EA-83D4-D4E9DC65D489.png', 71, '2022-07-15 08:12:33', NULL),
(511, 'Maxim\'s De Paris', '1657872935_BB75F5FF-1D60-4F32-AF63-A763E4FC389D.png', 71, '2022-07-15 08:13:50', '2022-07-15 08:15:35'),
(512, 'Godiva', '1657872990_9E5494B4-C916-4E59-A049-F7B5BCBDC83B.png', 71, '2022-07-15 08:16:30', NULL),
(513, 'T2', '1657873080_61E4E273-FCF2-4F40-A041-D618F5FC859B.png', 71, '2022-07-15 08:18:00', NULL),
(514, 'Joe Seph\'s', '1657873146_9E1DD673-6B0E-48BA-8B80-E78BC594EA9B.png', 71, '2022-07-15 08:19:06', NULL),
(515, 'Neuhaus', '1657873190_69130D28-E850-449A-960D-733A2198A128.gif', 71, '2022-07-15 08:19:50', NULL),
(516, 'Holdsworth', '1657873365_19AF4456-C5A1-4D21-ACF8-36F75F165BD4.png', 71, '2022-07-15 08:22:45', NULL),
(517, 'English Tea Shop', '1657873402_F3DFF562-D597-4BD5-8F71-B45E2ABAD839.jpeg', 71, '2022-07-15 08:23:22', NULL),
(518, 'Other', NULL, 71, '2022-07-15 08:23:56', NULL),
(519, 'Stella Artois', '1657873964_88A19313-6FFD-4B26-8736-2B49A56B0F79.png', 72, '2022-07-15 08:32:44', NULL),
(520, 'Smirnoff', '1657874010_73901B30-A62A-4359-97C1-126E43DEA1A0.png', 72, '2022-07-15 08:33:30', NULL),
(521, 'Gordon\'s', '1657874057_4152FF1B-BAF4-4420-82EC-0E1992EA9A2D.png', 72, '2022-07-15 08:34:17', NULL),
(522, 'Budweiser', '1657874110_80B8A75E-41FC-435C-8A42-BE8B9D851E9D.png', 72, '2022-07-15 08:35:10', NULL),
(523, 'Foster\'s', '1657874154_DFBDB943-5305-4C4C-A25A-7C3F253BBF23.png', 72, '2022-07-15 08:35:54', NULL),
(524, 'Carling', '1657874200_AE8315D7-D3A4-4F39-BF1F-45BF045742A7.png', 4, '2022-07-15 08:36:40', NULL),
(525, 'Strongbow', '1657874275_F76001F2-4612-4EEC-BC00-39898A61E362.png', 72, '2022-07-15 08:37:55', NULL),
(526, 'Cereals & Porridges', NULL, 73, '2022-07-15 08:43:45', '2022-07-15 08:43:59'),
(527, 'Drinks & Smoothies', NULL, 73, '2022-07-15 08:44:22', NULL),
(528, 'Finger Food, Snacks, Rusks', NULL, 73, '2022-07-15 08:44:49', '2022-07-15 08:46:23'),
(531, 'Prepared meal & Side Dishes', NULL, 73, '2022-07-15 08:45:37', NULL),
(532, 'Dairy Free', NULL, 74, '2022-07-15 09:02:54', NULL),
(533, 'Lactose free', NULL, 74, '2022-07-15 09:03:11', NULL),
(534, 'No Artificial Colours', NULL, 74, '2022-07-15 09:03:52', NULL),
(535, 'No Artificial Flavours', NULL, 74, '2022-07-15 09:04:22', NULL),
(536, 'No preservatives', NULL, 74, '2022-07-15 09:04:46', NULL),
(537, 'No Genetic Engineering', NULL, 74, '2022-07-15 09:05:08', '2022-07-15 09:06:25'),
(538, 'Nut free', NULL, 74, '2022-07-15 09:05:35', NULL),
(539, 'Wheat free', NULL, 74, '2022-07-15 09:05:55', NULL),
(540, 'Bagel', NULL, 75, '2022-07-15 09:08:26', NULL),
(541, 'Baguettes', NULL, 75, '2022-07-15 09:08:39', NULL),
(542, 'Brownies & Flapjacks', NULL, 75, '2022-07-15 09:09:21', NULL),
(543, 'Cakes & Cupcakes', NULL, 75, '2022-07-15 09:09:43', NULL),
(544, 'Cookies', NULL, 75, '2022-07-15 09:09:54', NULL),
(545, 'Croissants & Pastries', NULL, 75, '2022-07-15 09:10:26', NULL),
(546, 'Crumpets & English Muffins', NULL, 75, '2022-07-15 09:10:54', NULL),
(547, 'Packaged Breads', NULL, 75, '2022-07-15 09:11:09', NULL),
(548, 'Doughnuts & Sweet Muffins', NULL, 75, '2022-07-15 09:11:36', NULL),
(549, 'Rolls & Buns', NULL, 75, '2022-07-15 09:12:05', NULL),
(550, 'Fruit Loaves, Teacakes, & Scones', NULL, 75, '2022-07-15 09:13:05', NULL),
(551, 'Desserts', NULL, 75, '2022-07-15 09:13:18', NULL),
(552, 'Fresh Bakery', NULL, 75, '2022-07-15 09:13:34', NULL),
(553, 'Pitta & Naan', NULL, 75, '2022-07-15 09:13:56', NULL),
(554, 'Tarts & Pies', NULL, 75, '2022-07-15 09:14:10', NULL),
(555, 'Waffles & Pancakes', NULL, 75, '2022-07-15 09:14:29', NULL),
(556, 'Wraps & Thins', NULL, 75, '2022-07-15 09:14:52', NULL),
(557, 'Alcohol free', NULL, 74, '2022-07-15 09:16:26', NULL),
(558, 'Bitter Lemon', NULL, 76, '2022-07-15 09:19:24', NULL),
(559, 'Bubble Tea', NULL, 76, '2022-07-15 09:19:38', NULL),
(560, 'Chilled Drinks', NULL, 76, '2022-07-15 09:19:56', NULL),
(561, 'Cocktail Mixers', NULL, 76, '2022-07-15 09:20:26', NULL),
(562, 'Coffee', NULL, 76, '2022-07-15 09:20:37', NULL),
(563, 'Coffee Gifts', NULL, 76, '2022-07-15 09:20:50', NULL),
(564, 'Coffee Subtitutes', NULL, 76, '2022-07-15 09:21:17', NULL),
(565, 'Drink Mixes & Breverages', NULL, 76, '2022-07-15 09:21:40', NULL),
(566, 'Energy Drinks', NULL, 76, '2022-07-15 09:21:58', NULL),
(567, 'Sports & Health Drinks', NULL, 76, '2022-07-15 09:22:19', NULL),
(568, 'Frizzy Drinks', NULL, 76, '2022-07-15 09:22:36', NULL),
(569, 'Ginger Ale & beer', NULL, 76, '2022-07-15 09:23:19', '2022-07-15 09:23:42'),
(570, 'Hot chocolate & Malted Drinks', NULL, 76, '2022-07-15 09:24:53', NULL),
(571, 'Juice & Smoothies', NULL, 76, '2022-07-15 09:25:14', NULL),
(572, 'Plant Based Milk', NULL, 76, '2022-07-15 09:25:55', NULL),
(573, 'Non - Alcoholic Drink Gift', NULL, 76, '2022-07-15 09:26:37', NULL),
(574, 'Squash & Cordials', NULL, 76, '2022-07-15 09:27:11', NULL),
(575, 'Still Fruit Drinks', NULL, 76, '2022-07-15 09:27:40', NULL),
(576, 'Tea', NULL, 76, '2022-07-15 09:27:50', NULL),
(577, 'Tonic Water', NULL, 76, '2022-07-15 09:28:03', NULL),
(578, 'Water', NULL, 76, '2022-07-15 09:28:18', NULL),
(579, 'Apple Flavour', NULL, 77, '2022-07-15 09:31:32', NULL),
(580, 'Chocolate Flavour', NULL, 77, '2022-07-15 09:31:51', NULL),
(581, 'Coffee Flavour', NULL, 77, '2022-07-15 09:32:08', NULL),
(582, 'Green Tea', NULL, 77, '2022-07-15 09:32:24', NULL),
(583, 'Lemon Flavour', NULL, 77, '2022-07-15 09:32:39', NULL),
(584, 'Orange Flavour', NULL, 77, '2022-07-15 09:32:56', NULL),
(585, 'Vanilla Flavour', NULL, 77, '2022-07-15 09:33:12', NULL),
(586, 'Baby Food', NULL, 78, '2022-07-15 09:40:01', NULL),
(587, 'Breakfast Foods', NULL, 78, '2022-07-15 09:40:15', NULL),
(588, 'Chips & Potatoes', NULL, 78, '2022-07-15 09:40:30', NULL),
(589, 'Desserts & Cakes', NULL, 78, '2022-07-15 09:40:46', NULL),
(590, 'Fish & Seafood', NULL, 78, '2022-07-15 09:40:57', NULL),
(591, 'Fruit Pulp & Smoothie Mixes', NULL, 78, '2022-07-15 09:41:14', NULL),
(592, 'Herbs', NULL, 78, '2022-07-15 09:41:43', NULL),
(593, 'Frozen Fruits', NULL, 78, '2022-07-15 09:42:15', NULL),
(594, 'Ice', NULL, 78, '2022-07-15 09:42:31', NULL),
(595, 'Ice Cream & Ice Lollies', NULL, 78, '2022-07-15 09:42:50', NULL),
(596, 'Juice', NULL, 78, '2022-07-15 09:43:05', NULL),
(597, 'Meat, Poultry & Game', NULL, 78, '2022-07-15 09:43:17', NULL),
(598, 'Party Food & Snacks', NULL, 78, '2022-07-15 09:43:30', NULL),
(599, 'Pasta & Sauces', NULL, 78, '2022-07-15 09:43:41', NULL),
(600, 'Pizza', NULL, 78, '2022-07-15 09:43:54', NULL),
(601, 'Ready Meals', NULL, 78, '2022-07-15 09:44:05', NULL),
(602, 'Vegetables', NULL, 78, '2022-07-15 09:44:17', NULL),
(603, 'Vegetarian & Vegan', NULL, 78, '2022-07-15 09:44:34', NULL),
(604, 'Yorkshire Pudding, Pastry & Dough', NULL, 78, '2022-07-15 09:45:04', NULL),
(605, 'Assortments & Variety Gifts', NULL, 79, '2022-07-15 09:52:46', NULL),
(606, 'Beer, Wine & Spirits Gifts', NULL, 79, '2022-07-15 09:53:01', NULL),
(607, 'Canned, Jarred & Packaged Food Gifts', NULL, 79, '2022-07-15 09:53:17', NULL),
(608, 'Cereal Gifts', NULL, 79, '2022-07-15 09:53:30', NULL),
(609, 'Cheese Gifts', NULL, 79, '2022-07-15 09:53:42', NULL),
(610, 'Chocolate Gifts', NULL, 79, '2022-07-15 09:53:52', NULL),
(611, 'Condiment & Salad Dressing Gifts', NULL, 79, '2022-07-15 09:54:25', NULL),
(612, 'Cooking & Baking Gifts', NULL, 79, '2022-07-15 09:54:38', NULL),
(613, 'Dessert Gifts', NULL, 79, '2022-07-15 09:54:50', NULL),
(614, 'Fruit Gifts', NULL, 79, '2022-07-15 09:55:01', NULL),
(615, 'Jams & Preserves Gifts', NULL, 79, '2022-07-15 09:55:12', NULL),
(616, 'Meat Gifts & Hampers', NULL, 79, '2022-07-15 09:55:27', NULL),
(617, 'Non-Alcoholic Drinks Gifts', NULL, 79, '2022-07-15 09:55:38', NULL),
(618, 'Oil & Vinegar Gifts', NULL, 79, '2022-07-15 09:55:50', NULL),
(619, 'Olive, Pickle & Relish Gifts', NULL, 79, '2022-07-15 09:56:04', NULL),
(620, 'Pasta & Noodle Gifts', NULL, 79, '2022-07-15 09:56:18', NULL),
(621, 'Sauce Gifts', NULL, 79, '2022-07-15 09:56:29', NULL),
(622, 'Seafood Gifts', NULL, 79, '2022-07-15 09:56:41', NULL),
(623, 'Snacks Gifts', NULL, 79, '2022-07-15 09:56:51', NULL),
(624, 'Spices Gifts', NULL, 79, '2022-07-15 09:57:03', NULL),
(625, 'Sweets Gifts', NULL, 79, '2022-07-15 09:57:14', NULL),
(626, 'Tea Gifts', NULL, 79, '2022-07-15 09:57:24', NULL),
(627, 'Cooked Meats, Olives & Dips', NULL, 80, '2022-07-15 10:04:08', NULL),
(628, 'Dairy, Eggs & Plant-Based Alternatives', NULL, 80, '2022-07-15 10:04:19', NULL),
(629, 'Chilled Desserts', NULL, 80, '2022-07-15 10:04:39', NULL),
(630, 'Seafood and Fish', NULL, 80, '2022-07-15 10:05:26', NULL),
(631, 'Bouquets, Sprays & Wreaths', NULL, 80, '2022-07-15 10:06:22', NULL),
(632, 'Fresh Pasta', NULL, 80, '2022-07-15 10:06:35', NULL),
(633, 'Fresh Fruit & Vegetables', NULL, 80, '2022-07-15 10:06:46', NULL),
(634, 'Fresh Prepared Pies, Quiches & Sausage Rolls', NULL, 80, '2022-07-15 10:07:12', NULL),
(635, 'Fresh Prepared Pizzas, Focaccia & Garlic Bread', NULL, 80, '2022-07-15 10:07:22', NULL),
(636, 'Chilled Ready Meals & Soups', NULL, 80, '2022-07-15 10:07:33', NULL),
(637, 'Refrigerated Doughs', NULL, 80, '2022-07-15 10:07:43', NULL),
(638, 'Vegetarian Proteins', NULL, 80, '2022-07-15 10:07:55', NULL),
(639, 'Fresh Meat, Poultry & Game', NULL, 80, '2022-07-15 10:08:51', NULL),
(640, 'Beer', NULL, 81, '2022-07-15 10:12:49', NULL),
(641, 'Beer, Wine & Spirit', NULL, 81, '2022-07-15 10:13:03', NULL),
(642, 'Hampers', NULL, 81, '2022-07-15 10:13:25', NULL),
(643, 'Cider', NULL, 81, '2022-07-15 10:13:44', NULL),
(644, 'Fortified & Dessert Wines', NULL, 81, '2022-07-15 10:14:00', NULL),
(645, 'Fruit & Seasonal Wine', NULL, 81, '2022-07-15 10:14:19', NULL),
(646, 'Pre-mixed & Ready to Drink', NULL, 81, '2022-07-15 10:14:31', NULL),
(647, 'Sake', NULL, 81, '2022-07-15 10:14:43', NULL),
(648, 'Sparkling Wine & Champagne', NULL, 81, '2022-07-15 10:14:57', NULL),
(649, 'Spirits', NULL, 81, '2022-07-15 10:15:07', NULL),
(650, 'Wine', NULL, 81, '2022-07-15 10:15:22', NULL),
(651, 'Men\'s Accessories', NULL, 82, '2022-07-15 10:23:10', '2022-07-15 10:25:34'),
(652, 'Men\'s Activewear', NULL, 82, '2022-07-15 10:24:33', NULL),
(653, 'Men\'s Coats, Jackets & Gilets', NULL, 82, '2022-07-15 10:28:43', NULL),
(654, 'Men\'s Dungarees', NULL, 82, '2022-07-15 10:29:45', NULL),
(655, 'Men\'s Jumpers, Cardigans & Sweatshirts', NULL, 82, '2022-07-15 10:30:18', NULL),
(656, 'Men\'s Nightwear', NULL, 82, '2022-07-15 10:35:48', NULL),
(657, 'Men\'s Shorts', NULL, 82, '2022-07-15 10:36:26', NULL),
(658, 'Men\'s Snow & Rainwear', NULL, 82, '2022-07-15 10:36:44', NULL),
(659, 'Men\'s Socks & Hosiery', NULL, 82, '2022-07-15 10:36:58', NULL),
(660, 'Men\'s Suits & Blazers', NULL, 82, '2022-07-15 10:37:11', NULL),
(661, 'Men\'s Swimwear', NULL, 82, '2022-07-15 10:37:24', NULL),
(662, 'Men\'s Tops, T-Shirts & Shirts', NULL, 82, '2022-07-15 10:37:42', NULL),
(663, 'Men\'s Underwear', NULL, 82, '2022-07-15 10:38:11', NULL),
(664, 'Men\'s Trousers', NULL, 82, '2022-07-15 10:38:56', NULL),
(665, '5 XS', NULL, 5, '2022-07-15 10:41:58', NULL),
(666, '4 XS', NULL, 5, '2022-07-15 10:42:11', NULL),
(667, '3 XS', NULL, 5, '2022-07-15 10:42:22', NULL),
(668, '2 XS', NULL, 5, '2022-07-15 10:42:29', NULL),
(669, 'XS', NULL, 5, '2022-07-15 10:42:38', '2022-07-15 10:44:49'),
(670, 'S', NULL, 5, '2022-07-15 10:42:48', NULL),
(671, 'M', NULL, 5, '2022-07-15 10:42:58', NULL),
(672, 'L', NULL, 5, '2022-07-15 10:43:07', NULL),
(673, 'XL', NULL, 5, '2022-07-15 10:43:14', NULL),
(674, '2 XL', NULL, 5, '2022-07-15 10:43:29', NULL),
(675, '3 XL', NULL, 5, '2022-07-15 10:43:36', NULL),
(676, '4 XL', NULL, 5, '2022-07-15 10:43:43', NULL),
(677, '5 XL', NULL, 5, '2022-07-15 10:43:55', NULL),
(678, '6 XL', NULL, 5, '2022-07-15 10:44:11', NULL),
(679, 'Checkered', NULL, 27, '2022-07-15 11:11:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `oid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `totalamount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cashback_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_charges` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `walletamount` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `buyer_id` int(11) DEFAULT NULL,
  `uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1=Processing, 2=Order in Transit, 3=Order Delivered, 4=Cancelled',
  `cancel_reason` int(11) DEFAULT NULL COMMENT '1 = Getting a better price, 2 = Not interested anymore, 3 = Ordered wrong product, 4 = Got this product offline, 5 = Other (with a text box)	',
  `cancel_description` text COLLATE utf8_unicode_ci,
  `track_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `is_paid` int(11) DEFAULT '0',
  `created_at` date DEFAULT NULL,
  `order_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `oid`, `totalamount`, `discount_amount`, `cashback_amount`, `delivery_charges`, `walletamount`, `buyer_id`, `uid`, `transaction_id`, `payment_status`, `payment_method`, `status`, `cancel_reason`, `cancel_description`, `track_id`, `address_id`, `is_paid`, `created_at`, `order_created_at`) VALUES
(1, 'FIdiu', '110', '0', '11.00', '0.00', '0', 73, 'BUYERls2rhw', 'q3kiXIWrK6', 'Pending', 'Paypal', 1, NULL, NULL, NULL, 8, 1, '2022-04-10', '2022-04-08 05:12:29'),
(2, '8Vzhv', '650', '0', '65.00', '0.00', '0', 73, 'BUYERls2rhw', 'ox6FUqjz3B', 'Pending', 'Paypal', 1, NULL, NULL, NULL, 8, 1, '2022-04-08', '2022-04-08 05:14:56'),
(3, '6dXEL', '120', '0', '12.00', '0.00', '0', 68, 'BUYERgQXMcL', 'sI3unT26Py', 'Pending', 'Paypal', 1, NULL, NULL, NULL, 1, 1, '2022-04-08', '2022-04-08 05:22:16'),
(4, 'dxZJs', '230', '0', '23.00', '0.00', '0', 73, 'BUYERls2rhw', 'ZONF9Kqkj6', 'Pending', 'Paypal', 1, NULL, NULL, NULL, 8, 1, '2022-04-08', '2022-04-08 09:53:23'),
(5, 'Fim2s', '530', '0', '53.00', '0.00', '0', 68, 'BUYERgQXMcL', 'QdbDS0TpUw', 'Success', 'Paypal', 4, 2, NULL, NULL, 1, 1, '2022-04-08', '2022-04-08 18:35:31'),
(6, 'Enb14', '-10', '0', '0.20', '0.00', '12', 68, 'BUYERgQXMcL', 'trsSVyAHM6', 'Success', 'Paypal', 1, NULL, NULL, NULL, 1, 1, '2022-04-08', '2022-04-08 18:48:58'),
(39, 'HUnwK', '2', '0', '0.20', '0.00', '2', 73, 'BUYERls2rhw', 'hyGYLDmHIW', 'Success', 'Emporium Wallet', 1, NULL, NULL, NULL, 8, 1, '2022-04-11', '2022-04-11 04:31:14'),
(40, 'TIg4v', '4', '0', '0.40', '0.00', '4', 73, 'BUYERls2rhw', 'oXMF5HQpwq', 'Success', 'Emporium Wallet', 1, NULL, NULL, NULL, 8, 1, '2022-04-11', '2022-04-11 05:17:51'),
(41, 'MxT9N', '112', '0', '11.20', '0.00', '0', 73, 'BUYERls2rhw', 'IF7VCJfTsi', 'Pending', 'Paypal', 1, NULL, NULL, NULL, 8, 1, '2022-04-11', '2022-04-11 05:23:20'),
(43, 'QuHAj', '110', '0', '11.00', '0.00', '0', 73, 'BUYERls2rhw', '5sBSAULDen', 'Pending', 'Paypal', 1, NULL, NULL, 'hjsdbhjdsj', 8, 1, '2022-04-11', '2022-04-11 07:10:38'),
(44, 'C80tW', '2', '0', '0.20', '0.00', '2', 73, 'BUYERls2rhw', 'GXOZjMDH2t', 'Success', 'Emporium Wallet', 1, NULL, NULL, NULL, 8, 1, '2022-04-11', '2022-04-11 07:21:39');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `spec_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `product_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_charges` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `discount_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `quantity` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `is_rated` int(11) DEFAULT '0',
  `seller_subscription_id` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `variant_id`, `spec_detail`, `product_amount`, `delivery_charges`, `discount_amount`, `quantity`, `seller_id`, `is_rated`, `seller_subscription_id`, `created_at`) VALUES
(1, 1, 2, 2, 'a:2:{i:0;s:4:\"Blue\";i:1;s:2:\"XL\";}', '110', '0', '0', 1, 74, 0, 0, '2022-04-08'),
(2, 2, 1, 1, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', '120', '0', '0', 1, 74, 0, 0, '2022-04-08'),
(3, 2, 3, 3, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', '530', '0', '0', 1, 67, 0, 0, '2022-04-08'),
(4, 3, 1, 1, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', '120', '0', '0', 1, 74, 0, 0, '2022-04-08'),
(5, 4, 2, 2, 'a:2:{i:0;s:4:\"Blue\";i:1;s:2:\"XL\";}', '110', '0', '0', 1, 74, 0, 0, '2022-04-08'),
(6, 4, 1, 1, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', '120', '0', '0', 1, 74, 0, 0, '2022-04-08'),
(7, 5, 3, 3, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', '530', '0', '0', 1, 67, 0, 0, '2022-04-08'),
(8, 6, 3, 3, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', '2', '0', '0', 1, 67, 0, 0, '2022-04-08'),
(9, 7, 1, 1, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', '120', '0', '0', 1, 74, 0, NULL, '2022-04-09'),
(10, 8, 1, 1, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', '120', '0', '0', 1, 74, 0, NULL, '2022-04-09'),
(21, 39, 1, 1, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', '2', '0', '0', 1, 74, 0, NULL, '2022-04-11'),
(22, 40, 3, 3, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', '2', '0', '0', 1, 67, 0, NULL, '2022-04-11'),
(23, 40, 1, 1, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', '2', '0', '0', 1, 74, 0, NULL, '2022-04-11'),
(24, 41, 2, 2, 'a:2:{i:0;s:4:\"Blue\";i:1;s:2:\"XL\";}', '110', '0', '0', 1, 74, 0, 0, '2022-04-11'),
(25, 41, 1, 1, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', '2', '0', '0', 1, 74, 0, 0, '2022-04-11'),
(27, 43, 2, 2, 'a:2:{i:0;s:4:\"Blue\";i:1;s:2:\"XL\";}', '110', '0', '0', 1, 74, 0, 0, '2022-04-11'),
(28, 44, 3, 3, 'a:2:{i:0;s:5:\"Black\";i:1;s:1:\"M\";}', '2', '0', '0', 1, 67, 0, NULL, '2022-04-11');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `page_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `heading` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `short_desc` text COLLATE utf8_unicode_ci,
  `heading2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `heading2_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `heading3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content2` text COLLATE utf8_unicode_ci,
  `content4` text COLLATE utf8_unicode_ci,
  `content5` text COLLATE utf8_unicode_ci,
  `content6` text COLLATE utf8_unicode_ci,
  `heading4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content3` text COLLATE utf8_unicode_ci,
  `content7` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `page_url`, `banner_image`, `created_at`, `updated_at`, `heading`, `content`, `short_desc`, `heading2`, `heading2_image`, `heading3`, `content2`, `content4`, `content5`, `content6`, `heading4`, `content3`, `content7`) VALUES
(1, 'About us', 'edit_aboutus', '1639725369_Rectangle 95.png', NULL, '2022-03-29 08:57:26', 'About Emporium', '<p>We are an online marketplace with a difference. Emporium is a place where you can find everything you could possibly need for your home, office or any occasion, conveniently located in one place.</p>', '<p>We sell a wide selection of goods, from furniture to clothes and toys for the children and everything in between. It&rsquo;s our vision to make Emporium your go-to destination online. A place where everything you need is at your fingertips, and you can order any time of day or night with the click of a button.</p>', 'Our Mission and Vision', '1635509956_history.jpg', 'The Emporium Difference', '<p>So what&rsquo;s the difference between us and other online marketplaces? We set up Emporium for the everyday buyer and seller, not for large corporations selling low quality, high priced goods with high selling fees and commissions and where buyers have to pay unfair delivery costs.</p>', '<p>All the products you will find listed on the Emporium marketplace are high quality and reasonably priced. As a buyer, the delivery will either be free of charge or a minimal amount. This will depend on the item purchased. However, it&rsquo;s not just buyers who will benefit from shopping at Emporium. Sellers will find our selling fees consistently low, meaning your transactions remain profitable.</p>', '<p>As a user of the Emporium website, you can buy and sell goods online. This can be either new or used items. Like other online marketplaces, you can choose to auction items to sell to the highest bidder, or you can set a price so customers can buy your goods right away. With Emporium, you control what you sell and how you want to sell your stock.</p>', '<p>After years of using the mainstream platforms, we wanted to offer a better and fairer alternative to the average marketplace customer. Emporium was founded on this belief.</p>', 'Rewarding You for Shopping With Us', '<p>Our platform stands out from the competition because when you buy or sell on Emporium, you will qualify for our unique cashback rewards. The cashback you collect on qualifying purchases can be redeemed against future purchases on our website. We want to give something back to our customers and help you save money on the items on your shopping list. You can collect your cashback rewards and exchange them for the face value of the amount earned at any time.</p>', '<p>Whether you are a buyer or seller, Emporium is designed to make the online marketplace shopping experience better for you. With low fees and cashback incentives, we aim to offer an experience like no other.</p>'),
(2, 'Contact Us', 'edit_contactus', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page_content`
--

CREATE TABLE `page_content` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `heading` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `bottom_heading` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `heading_url` text COLLATE utf8_unicode_ci,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `page_content`
--

INSERT INTO `page_content` (`id`, `page_id`, `image`, `heading`, `description`, `bottom_heading`, `heading_url`, `updated_at`) VALUES
(1, 2, '1635768268_download.jpg', 'Chat with Us', '<p>24x7x365</p>', 'Chat Now', 'https://tawk.to/chat/61ea3fcab9e4e21181bb19ca/1fptgicdd', '2022-03-11 05:51:05'),
(2, 2, '1635768308_pexels-photo-674010.jpeg', 'Email Us', '<p>24x7x365</p>', 'support@emporiumstore.co.uk', 'mailto:support@emporiumstore.co.uk', '2022-03-02 08:51:08');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_response`
--

CREATE TABLE `payment_response` (
  `id` int(11) NOT NULL,
  `orderid` varchar(255) DEFAULT NULL,
  `PayerID` varchar(255) DEFAULT NULL,
  `payer_email` varchar(255) DEFAULT NULL,
  `payer_status` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address_name` text,
  `address_street` text,
  `address_city` varchar(255) DEFAULT NULL,
  `address_country_code` varchar(255) DEFAULT NULL,
  `address_zip` varchar(255) DEFAULT NULL,
  `residence_country` varchar(255) DEFAULT NULL,
  `txn_id` varchar(255) DEFAULT NULL,
  `mc_currency` varchar(255) DEFAULT NULL,
  `mc_gross` varchar(255) DEFAULT NULL,
  `protection_eligibility` varchar(255) DEFAULT NULL,
  `payment_gross` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `pending_reason` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `handling_amount` varchar(255) DEFAULT NULL,
  `shipping` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `txn_type` varchar(255) DEFAULT NULL,
  `payment_date` text,
  `notify_version` varchar(255) DEFAULT NULL,
  `custom` varchar(255) DEFAULT NULL,
  `verify_sign` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_response`
--

INSERT INTO `payment_response` (`id`, `orderid`, `PayerID`, `payer_email`, `payer_status`, `first_name`, `last_name`, `address_name`, `address_street`, `address_city`, `address_country_code`, `address_zip`, `residence_country`, `txn_id`, `mc_currency`, `mc_gross`, `protection_eligibility`, `payment_gross`, `payment_status`, `pending_reason`, `payment_type`, `handling_amount`, `shipping`, `quantity`, `txn_type`, `payment_date`, `notify_version`, `custom`, `verify_sign`, `user_id`) VALUES
(1, '1', 'YRPZRRQR8PAR6', 'ankush.gupta12@gmail.com', 'UNVERIFIED', 'John', 'Doe', 'John Doe', 'naveen shahdara', 'delhi', 'GB', NULL, 'GB', '40P19725VC948923W', 'GBP', '110.00', 'INELIGIBLE', '110.00', 'Pending', 'unilateral', 'instant', '0.00', '0.00', '1', 'web_accept', '2022-04-08T05:12:40Z', 'UNVERSIONED', 'q3kiXIWrK6', 'AKELgdY9lXgwgyw-TI-jj5SV-NgKAiWBNfztnz82ibX5Zevt9qLgN7Ds', 73),
(2, '2', 'YRPZRRQR8PAR6', 'ankush.gupta12@gmail.com', 'UNVERIFIED', 'John', 'Doe', 'John Doe', 'naveen shahdara', 'delhi', 'GB', NULL, 'GB', '32Y08894US729144X', 'GBP', '650.00', 'INELIGIBLE', '650.00', 'Pending', 'unilateral', 'instant', '0.00', '0.00', '1', 'web_accept', '2022-04-08T05:15:07Z', 'UNVERSIONED', 'ox6FUqjz3B', 'A.doWNm7TzJfJZsKRHwVIeWY7URsAiuAWlSX4X4x3CI6yM84MbudTxby', 73),
(3, '3', 'YRPZRRQR8PAR6', 'ankush.gupta12@gmail.com', 'UNVERIFIED', 'John', 'Doe', 'John Doe', 'naveen shahdara', 'delhi', 'GB', NULL, 'GB', '4YT98498A03058429', 'GBP', '120.00', 'INELIGIBLE', '120.00', 'Pending', 'unilateral', 'instant', '0.00', '0.00', '1', 'web_accept', '2022-04-08T05:22:26Z', 'UNVERSIONED', 'sI3unT26Py', 'AHEqA8nUXgaW37uaN8vIpV9grqRbAxj7kNckyJsuYsOE6eFEy6PQyLtP', 68),
(4, '4', 'YRPZRRQR8PAR6', 'ankush.gupta12@gmail.com', 'UNVERIFIED', 'John', 'Doe', 'John Doe', 'naveen shahdara', 'delhi', 'GB', NULL, 'GB', '1DS862606N6915607', 'GBP', '230.00', 'INELIGIBLE', '230.00', 'Pending', 'unilateral', 'instant', '0.00', '0.00', '1', 'web_accept', '2022-04-08T09:53:33Z', 'UNVERSIONED', 'ZONF9Kqkj6', 'ASuE3luga8DCKoN9FO4IpwkUlzp0AscSHCI7YTdfwLDC4IULmH3iniLh', 73),
(5, '41', 'YRPZRRQR8PAR6', 'ankush.gupta12@gmail.com', 'UNVERIFIED', 'John', 'Doe', 'John Doe', 'naveen shahdara', 'delhi', 'GB', NULL, 'GB', '2T623810HH427572L', 'GBP', '112.00', 'INELIGIBLE', '112.00', 'Pending', 'unilateral', 'instant', '0.00', '0.00', '1', 'web_accept', '2022-04-11T05:23:30Z', 'UNVERSIONED', 'IF7VCJfTsi', 'AQgFvt-2oLAOasu23SppiSrqRSKwALmLQJaVoL-OSB2fWm.md558ONxf', 73),
(6, '43', 'YRPZRRQR8PAR6', 'ankush.gupta12@gmail.com', 'UNVERIFIED', 'John', 'Doe', 'John Doe', 'naveen shahdara', 'delhi', 'GB', NULL, 'GB', '4MT15003HS936400M', 'GBP', '110.00', 'INELIGIBLE', '110.00', 'Pending', 'unilateral', 'instant', '0.00', '0.00', '1', 'web_accept', '2022-04-11T07:10:49Z', 'UNVERSIONED', '5sBSAULDen', 'AbwtF.JEcepLBHg7kuQNmF4uAS8iAWtvr0AnmGyJEDO.8pzyjVMCMUS5', 73);

-- --------------------------------------------------------

--
-- Table structure for table `postal_code`
--

CREATE TABLE `postal_code` (
  `id` int(11) NOT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `seller_id` int(11) NOT NULL,
  `cost` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `postal_code`
--

INSERT INTO `postal_code` (`id`, `zipcode`, `name`, `seller_id`, `cost`) VALUES
(2, 'AL', 'St Albans', 3, '25'),
(3, 'B', 'Birmingham', 3, '25'),
(4, 'BA', 'Bath', 3, '25'),
(5, 'BB', 'Blackburn', 3, '25'),
(6, 'BD', 'Bradford', 3, '25'),
(7, 'BH', 'Bournemouth', 3, '25'),
(8, 'BL', 'Bolton', 3, '25'),
(9, 'BN', 'Brighton', 3, '25'),
(10, 'BR', 'Bromley', 3, '25'),
(11, 'BS', 'Bristol', 3, '25'),
(12, 'BT', 'Belfast', 3, '25'),
(13, 'CA', 'Carlisle', 3, '25'),
(14, 'CB', 'Cambridge', 3, '25'),
(15, 'CF', 'Cardiff', 3, '25'),
(16, 'CH', 'Chester', 3, '25'),
(17, 'CM', 'Chelmsford', 3, '25'),
(18, 'CO', 'Colchester', 3, '25'),
(19, 'CR', 'Croydon', 3, '25'),
(20, 'CT', 'Canterbury', 3, '25'),
(21, 'CV', 'Coventry', 3, '25'),
(22, 'CW', 'Crewe', 3, '25'),
(23, 'DA', 'Dartford', 3, '25'),
(24, 'DD', 'Dundee', 3, '25'),
(25, 'DE', 'Derby', 3, '25'),
(26, 'DG', 'Dumfries', 3, '25'),
(27, 'DH', 'Durham', 3, '25'),
(28, 'DL', 'Darlington', 3, '25'),
(29, 'DN', 'Doncaster', 3, '25'),
(30, 'DT', 'Dorchester', 3, '25'),
(31, 'DY', 'Dudley', 3, '25'),
(32, 'E', 'East?London', 3, '25'),
(33, 'EC', 'East Central?London', 3, '25'),
(34, 'EH', 'Edinburgh', 3, '25'),
(35, 'EN', 'Enfield', 3, '25'),
(36, 'EX', 'Exeter', 3, '25'),
(37, 'FK', 'Falkirk', 3, '25'),
(38, 'FY', 'Blackpool', 3, '25'),
(39, 'G', 'Glasgow', 3, '25'),
(40, 'GL', 'Gloucester', 3, '25'),
(41, 'GU', 'Guildford', 3, '25'),
(42, 'HA', 'Harrow', 3, '25'),
(43, 'HD', 'Huddersfield', 3, '25'),
(44, 'HG', 'Harrogate', 3, '25'),
(45, 'HP', 'Hemel Hempstead', 3, '25'),
(46, 'HR', 'Hereford', 3, '25'),
(47, 'HS', 'Hebrides', 3, '25'),
(48, 'HU', 'Hull', 3, '25'),
(49, 'HX', 'Halifax', 3, '25'),
(50, 'IG', 'Ilford', 3, '25'),
(51, 'IP', 'Ipswich', 3, '25'),
(52, 'IV', 'Inverness', 3, '25'),
(53, 'KA', 'St Albans', 3, '25'),
(54, 'KT', 'Kingston upon Thames', 3, '25'),
(55, 'KW', 'Kirkwall', 3, '25'),
(56, 'KY', 'Kirkcaldy', 3, '25'),
(57, 'L', 'Liverpool', 3, '25'),
(58, 'LA', 'Lancaster', 3, '25'),
(59, 'LD', 'Llandrindod Wells', 3, '25'),
(60, 'LE', 'Leicester', 3, '25'),
(61, 'LL', 'Llandudno', 3, '25'),
(62, 'LN', 'Lincoln', 3, '25'),
(63, 'LS', 'Leeds', 3, '25'),
(64, 'LU', 'Luton', 3, '25'),
(65, 'M', 'Manchester', 3, '25'),
(66, 'ME', 'Medway', 3, '25'),
(67, 'MK', 'Milton Keynes', 3, '25'),
(68, 'ML', 'Motherwell', 3, '25'),
(69, 'N', 'North?London', 3, '25'),
(70, 'NE', 'Newcastle upon Tyne[4][5]', 3, '25'),
(71, 'NG', 'Nottingham', 3, '25'),
(72, 'NN', 'Northampton', 3, '25'),
(73, 'NP', 'Newport', 3, '25'),
(74, 'NR', 'Norwich', 3, '25'),
(75, 'NW', 'North West?London', 3, '25'),
(76, 'OL', 'Oldham', 3, '25'),
(77, 'OX', 'Oxford', 3, '25'),
(78, 'PA', 'Paisley', 3, '25'),
(79, 'PE', 'Peterborough', 3, '25'),
(80, 'PH', 'Perth', 3, '25'),
(81, 'PL', 'Plymouth', 3, '25'),
(82, 'PO', 'Portsmouth', 3, '25'),
(83, 'PR', 'Preston', 3, '25'),
(84, 'RG', 'Reading', 3, '25'),
(85, 'RH', 'Redhill', 3, '25'),
(86, 'RM', 'Romford', 3, '25'),
(87, 'S', 'Sheffield', 3, '25'),
(88, 'SA', 'Swansea', 3, '25'),
(89, 'SE', 'South East?London', 3, '25'),
(90, 'SG', 'Stevenage', 3, '25'),
(91, 'SK', 'Stockport', 3, '25'),
(92, 'SL', 'Slough', 3, '25'),
(93, 'SM', 'Sutton', 3, '25'),
(94, 'SN', 'Swindon', 3, '25'),
(95, 'SO', 'Southampton', 3, '25'),
(96, 'SP', 'Salisbury', 3, '25'),
(97, 'SR', 'Sunderland', 3, '25'),
(98, 'SS', 'Southend-on-Sea', 3, '25'),
(99, 'ST', 'Stoke-on-Trent', 3, '25'),
(100, 'SW', 'South West?London', 3, '25'),
(101, 'SY', 'Shrewsbury', 3, '25'),
(102, 'TA', 'Taunton', 3, '25'),
(103, 'TD', 'Tweeddale', 3, '25'),
(104, 'TF', 'Telford', 3, '25'),
(105, 'TN', 'Tunbridge Wells', 3, '25'),
(106, 'TQ', 'Torquay', 3, '25'),
(107, 'TR', 'Truro', 3, '25'),
(108, 'TS', 'Teesside', 3, '25'),
(109, 'TW', 'Twickenham', 3, '25'),
(110, 'UB', 'Southall', 3, '25'),
(111, 'W', 'West?London', 3, '25'),
(112, 'WA', 'Warrington', 3, '25'),
(113, 'WC', 'West Central?London', 3, '25'),
(114, 'WD', 'Watford', 3, '25'),
(115, 'WF', 'Wakefield', 3, '25'),
(116, 'WN', 'Wigan', 3, '25'),
(117, 'WR', 'Worcester', 3, '25'),
(118, 'WS', 'Walsall', 3, '25'),
(119, 'WV', 'Wolverhampton', 3, '25'),
(120, 'YO', 'York', 3, '25'),
(121, 'ZE', 'Lerwick', 3, '25'),
(122, 'AB', 'Aberdeen', 3, '25'),
(250, 'KA', 'St Albans', 74, '10'),
(251, 'BH', 'Bournemouth', 74, '12'),
(252, 'BH', 'Bournemouth', 67, '18'),
(253, 'KA', 'St Albans', 66, '11'),
(254, 'BH', 'Bournemouth', 66, '12'),
(255, 'Tq1', 'Torquay', 66, '5'),
(256, 'Tq1', 'Torquay', 66, '15'),
(257, 'TQ2', 'London', 66, '25'),
(258, 'TQ1', 'Torquay', 66, '20'),
(259, 'AB', 'Leeds', 66, '15'),
(260, 'BZ', 'Germany', 66, '250'),
(261, 'Track Pant', 'track-pant', 73, '16388'),
(262, 'Nokia', 'nokia', 73, '16388');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dummy.jpg',
  `catid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subcat_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_admin_featured` int(11) DEFAULT NULL COMMENT '1=>Yes,0=>No',
  `is_auction` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_subscribed` tinyint(1) NOT NULL DEFAULT '0',
  `discount` int(11) DEFAULT '0',
  `discount_code_id` int(11) DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `createdby` int(11) DEFAULT NULL,
  `cashback` int(11) DEFAULT '0',
  `todaydeal` int(11) DEFAULT '0',
  `weeklydeal` int(11) DEFAULT '0',
  `monthlydeal` int(11) DEFAULT '0',
  `season` int(11) DEFAULT '0',
  `trending` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '0=delete,1=available,2=sold'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_code`, `name`, `slug`, `image`, `catid`, `subcat_id`, `price`, `quantity`, `zipcode`, `short_desc`, `description`, `user_id`, `is_featured`, `is_admin_featured`, `is_auction`, `is_active`, `is_subscribed`, `discount`, `discount_code_id`, `meta_title`, `meta_keyword`, `meta_description`, `createdby`, `cashback`, `todaydeal`, `weeklydeal`, `monthlydeal`, `season`, `trending`, `created_at`, `updated_at`, `status`) VALUES
(1, 'XUl9Qw', 'Levi\'s Men\'s Regular fit Polo', 'levi-s-men-s-regular-fit-polo', '1649313032_menblacktshirt.jpg', '25', '22', '100', 99, '57,56,55,54,53', '<p>BNG MT JAC COLLAR POLO RE-CYCLE PIQUE SH</p>', '<ul>\r\n	<li>Product Dimensions &rlm; : &lrm;&nbsp;66.7 x 30.5 x 3.8 cm; 350 Grams</li>\r\n	<li>Date First Available &rlm; : &lrm;&nbsp;10 June 2021</li>\r\n	<li>Manufacturer &rlm; : &lrm;&nbsp;Sri Lakshmi Clothings</li>\r\n	<li>ASIN &rlm; : &lrm;&nbsp;B09714TXS1</li>\r\n	<li>Item model number &rlm; : &lrm;&nbsp;74700-0065S</li>\r\n	<li>Department &rlm; : &lrm;&nbsp;Men</li>\r\n	<li>Manufacturer &rlm; : &lrm;&nbsp;Sri Lakshmi Clothings, SRI LAKSHMI CLOTHINGS,330/1, SRI GOKULA KRISHNA NAGAR, TIRUPPUR TIRUPPUR 641605</li>\r\n	<li>Packer &rlm; : &lrm;&nbsp;SRI LAKSHMI CLOTHINGS,330/1, SRI GOKULA KRISHNA NAGAR, TIRUPPUR TIRUPPUR 641605</li>\r\n	<li>Importer &rlm; : &lrm;&nbsp;Levi Strauss India Pvt Ltd ITC Green Centre,5th Floor-North Tower No-18 Banasawadi Main Road Maruthiseva Nagara Bangalore-560005</li>\r\n	<li>Item Weight &rlm; : &lrm;&nbsp;350 g</li>\r\n	<li>Item Dimensions LxWxH &rlm; : &lrm;&nbsp;66.7 x 30.5 x 3.8 Centimeters</li>\r\n	<li>Generic Name &rlm; : &lrm;&nbsp;T-Shirt</li>\r\n</ul>', 74, 0, NULL, 0, 0, 0, NULL, NULL, 'Levi\'s Men\'s Regular fit Polo', 'Levi\'s Men\'s Regular fit Polo', 'Levi\'s Men\'s Regular fit Polo', NULL, 0, 0, 0, 0, 0, 0, '2022-04-07 06:30:32', '2022-04-19 05:51:29', 0),
(2, 'TpHMav', 'Ben Martin Men\'s Relaxed Jeans', 'ben-martin-men-s-relaxed-jeans', '1649313397_menbluejean.jpg', '25', '14', '99', 99, '58,57,56,55,54,53', '<p>Testing Product</p>', '<p>Testing Product</p>', 74, 0, NULL, 0, 0, 0, NULL, NULL, 'Ben Martin Men\'s Relaxed Jeans', 'Ben Martin Men\'s Relaxed Jeans', 'Ben Martin Men\'s Relaxed Jeans', NULL, 0, 0, 0, 0, 0, 0, '2022-04-07 06:36:37', '2022-04-08 04:28:16', 0),
(4, 'GcPmC7', 'Whiskas® Wet Meal Tuna in Jelly', 'whiskas-wet-meal-tuna-in-jelly', '1650325059_DE1AE609-50AE-4AB8-89E5-2726B7EAF46F.jpeg', '33', '98', '4', 1000, '122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,98,97,4', '<p><br />\r\nWhiskas&reg;&nbsp;Tuna in Jelly is a balanced wet kitten food recipe that provides moisture and nourishment for a healthy, active growing kitten that requires specific care and nutrition. A kitten&rsquo;s love for fish is blended with loads of calcium, phosphorus, proteins, antioxidants, vitamins &amp; minerals, to maintain its fur, heart-health, weight, skin, teeth, muscles, bones and overall immunity. Wet kitten food appeals to the palate of fussy eaters and gives them the delight of relishing a juicy, wholesome meal while strengthening them from the inside.</p>', '<p>As much as you adore your kitten&rsquo;s beautiful skin and coat, it is also one of the best indicators of their nutrition &amp; well-being. WHISKAS wet kitten food contains a unique patent-protected combination of zinc &amp; omega 6 fatty acids to improve your kitten&acute;s skin and coat.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', 67, 0, NULL, 0, 0, 0, NULL, NULL, 'Whiskas® Wet Meal Tuna in Jelly', 'Whiskas® Wet Meal Tuna in Jelly', 'Whiskas® Wet Meal Tuna in Jelly', NULL, 0, 0, 0, 0, 0, 0, '2022-04-18 23:37:39', NULL, 0),
(5, 'l1Vf6U', 'BASIC DENIM JACKET', 'basic-denim-jacket', '1650327855_1620300406_2_4_1.jpg', '25', '22', '299', 25, '5', '<p>Collared denim jacket featuring long sleeves with buttoned cuffs. Chest flap pockets and hip welt pockets. Faded effect. Button-up front.</p>', '<p>LIGHT BLUE&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', 67, 0, 0, 0, 0, 0, 2, NULL, 'BASIC DENIM JACKET', 'BASIC DENIM JACKET', 'BASIC DENIM JACKET', NULL, 0, 0, 0, 0, 0, 0, '2022-04-19 00:24:15', '2022-04-19 11:50:54', 0),
(6, 'dzpcVU', 'Tuna in Jelly- Whiskas wet Cat food', 'tuna-in-jelly--whiskas-wet-cat-food', '1650328292_913833321_adult_tunainjelly_400x510.png', '33', '98', '25', 250, '122', '<p>Whiskas&reg;&nbsp;Tuna in Jelly is a balanced wet kitten food recipe that provides moisture and nourishment for a healthy, active growing kitten that requires specific care and nutrition. A kitten&rsquo;s love for fish is blended with loads of calcium, phosphorus, proteins, antioxidants, vitamins &amp; minerals, to maintain its fur, heart-health, weight, skin, teeth, muscles, bones and overall immunity. Wet kitten food appeals to the palate of fussy eaters and gives them the delight of relishing a juicy, wholesome meal while strengthening them from the inside.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '<p>As much as you adore your kitten&rsquo;s beautiful skin and coat, it is also one of the best indicators of their nutrition &amp; well-being. WHISKAS wet kitten food contains a unique patent-protected combination of zinc &amp; omega 6 fatty acids to improve your kitten&acute;s skin and coat.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img src=\"https://www.whiskas.in/images/721912188_Tuna-in-jelly(Kitten)-.png\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Serve your kitten a meal that it needs and enjoys through WHISKAS Tuna in Jelly &ndash; a complete and balanced meal for a kitten&rsquo;s vital system. Your four-legged friend&rsquo;s health requires a lot more than just home cooked food.</p>', 67, 0, 0, 0, 0, 0, NULL, NULL, 'Serve your kitten a meal that it needs and enjoys through WHISKAS Tuna in Jelly – a complete and balanced meal for a kitten’s vital system. Your four-legged friend’s health requires a lot more than just home cooked food.', 'Serve your kitten a meal that it needs and enjoys through WHISKAS Tuna in Jelly – a complete and balanced meal for a kitten’s vital system. Your four-legged friend’s health requires a lot more than just home cooked food.', 'Serve your kitten a meal that it needs and enjoys through WHISKAS Tuna in Jelly – a complete and balanced meal for a kitten’s vital system. Your four-legged friend’s health requires a lot more than just home cooked food.', NULL, 0, 0, 0, 0, 0, 0, '2022-04-19 00:31:32', '2022-04-19 11:22:26', 0),
(7, 'DK54Td', 'Test', 'test', '1650345375_menbluejean.jpg', '25', '23', '100', 99, '122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,95,94,93,92,91,90,89,88,87,86,85,84,83,82,81,80,79,78,77,76,75,74,73,72,71,70,69,68,67,66,65,64,63,62,61,60,59,58,57,56,55,54,53,52,51,50,49,48,47,46,4', '<p>Test</p>', '<p>Test</p>', 88, 0, 0, 0, 0, 0, 110, NULL, 'Test', 'Test', 'Test', NULL, 0, 0, 0, 0, 0, 0, '2022-04-19 05:16:15', '2022-07-13 08:12:04', 0),
(8, 'TJ8bEx', 'Whiskas Chicken in Gravy', 'whiskas-chicken-in-gravy', '1650414218_189D012B-A44C-45BA-8270-3D64A3A8E608.png', '33', '98', '5', 400, '251,250,122', '<p>Whiskas&reg;&nbsp;Chicken in Gravy is a balanced wet kitten food recipe that provides moisture and nourishment for a healthy, active and growing kitten that requires specific care and nutrition. Whiskas kitten food in Chicken and Gravy comprises of flavorful chicken chunks in an appetising gravy packed with high-quality protein and essential nutrients. The gravy format is easy to digest for kittens and also promotes urinary tract health because of its high moisture content. This kitten food is also packed with a combination of Zinc and Omega 6 fatty acids that will support your kitten&rsquo;s coat, promoting its health and shine. Whiskas gravy texture and aroma appeals to the feline palate and attracts even fussy eaters!</p>', '<p>You may adore your kitten&rsquo;s beautiful skin and coat, but did you know that it is also one of the best indicators of their nutrition &amp; well-being? WHISKAS wet kitten food contains a unique patent-protected combination of Zinc and Omega 6 fatty acids to improve your kitten&#39;s skin and coat.</p>\r\n\r\n<p><img src=\"https://www.whiskas.in/images/415429577_salmon-with-gravy.png\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Serve your kitten a meal that it needs and enjoys with WHISKAS Chicken in Gravy &ndash; a complete and balanced meal for a kitten&rsquo;s vital system. Your four-legged friend&rsquo;s health requires a lot more than just home-cooked food.</p>', 67, 0, NULL, 0, 0, 0, NULL, NULL, 'Whiskas Chicken in Gravy', 'Whiskas Chicken in Gravy', 'Whiskas Chicken in Gravy', NULL, 0, 0, 0, 0, 0, 0, '2022-04-20 00:23:38', NULL, 0),
(17, 'S8jOU5', 'GB010001', 'JIL-102912', 'JIL-102912', '43', 'Jilong Rengtangular Inflatable Pool 305x183x50cm', '0', 0, NULL, '', '6926799215019', 66, 30, NULL, 0, 0, 0, 8, NULL, 'No', 'No', '20.00', NULL, 0, 0, 0, 0, 0, 0, '2022-07-15 23:15:12', NULL, 0),
(18, 'FNiHX3', 'Jilong Rengtangular Inflatable Pool 305x183x50cm', 'jilong-rengtangular-inflatable-pool-305x183x50cm', '1657924301_CE193CCA-D28E-44B4-8911-0CB86CCAC9FA.png', '22', '89', '37', 139, '255,254,253,252,251,250,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102', '<p>These rectangular inflatable pools are perfect for kids and family fun in the sun or enjoy a more chilled out night with the LED option. These outdoor garden pools can be easily inflated with two equal inflatable walls for a sturdy construction.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The pools have a massive water holding capacity of 459 Litters, this large family sized pool should take around 10-15minutes to fill using a standard garden hose. The pools have a massive water holding capacity of 459 Litters, this large family sized pool should take around 10-15minutes to fill using a standard garden hose.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The 2 different styles that are available are the regular and the LED Lit Inflatable, the LED lit pool allows you to enjoy the relaxing pool at night or under a gazebo.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>RECTANGULAR INFLATABLE POOLS&nbsp; These rectangular inflatable pools are perfect for kids and family fun in the sun or enjoy a more chilled out night with the LED option</p>\r\n\r\n<p>INFLATE &amp; DEFLATE WITH EASE&nbsp; These outdoor garden pools can be easily inflated with two equal inflatable walls for a sturdy construction</p>\r\n\r\n<p>LARGE CAPACITY&nbsp; The pools have a massive water holding capacity of 459 Litters, this large family sized pool should take around 10-15minutes to fill using a standard garden hose</p>\r\n\r\n<p>EASY TO USE DRAIN VALVE&nbsp; The pool water can be released easily with the simple drain valve that allows you to quickly release the water</p>\r\n\r\n<p>2 STYLES AVAILABLE&nbsp; The 2 different styles that are available are the regular and the LED Lit Inflatable, the LED lit pool allows you to enjoy the relaxing pool at night or under a gazebo</p>\r\n\r\n<p>Measurements</p>\r\n\r\n<p>Height: 50cm Width: 150cm Length: 200cm Weight: 4kg</p>\r\n\r\n<p>Piscina regolare (305x183x50cm)</p>\r\n\r\n<p>Package Content</p>\r\n\r\n<p>1 x Rectangular Inflatable Pool</p>', NULL, 66, 0, NULL, 0, 0, 0, NULL, NULL, 'Jilong Rengtangular Inflatable Pool', 'Inflatable Pool', 'Jilong Rengtangular Inflatable Pool 305x183x50cm', NULL, 0, 0, 0, 0, 0, 0, '2022-07-15 22:31:41', NULL, 1),
(21, 'O91zFX', 'Inflating Pool', 'Inflating pool', '', '11', '2', '36', 139, NULL, '<p>Pool.</p>', '<p>Inflating Pool.</p>', 66, 0, NULL, 0, 1, 0, 0, NULL, 'Inflating pool', 'Inflating pool', 'Inflating pool', NULL, 0, 0, 0, 0, 0, 0, '2022-07-15 23:49:39', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE `product_detail` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `spec_detail` longtext,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`id`, `product_id`, `spec_detail`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'a:4:{s:6:\"colour\";s:5:\"Black\";s:4:\"size\";s:1:\"M\";s:6:\"vprice\";s:1:\"2\";s:10:\"variant_id\";s:1:\"1\";}', 1, '2022-04-07 06:30:32', NULL),
(2, 2, 'a:3:{s:6:\"colour\";s:4:\"Blue\";s:4:\"size\";s:2:\"XL\";s:6:\"vprice\";s:3:\"110\";}', 1, '2022-04-07 06:36:37', NULL),
(3, 3, 'a:6:{s:6:\"colour\";s:5:\"Black\";s:4:\"size\";s:1:\"M\";s:17:\"shoe-closure-type\";s:7:\"Lace-Up\";s:21:\"backpack-closure-type\";s:15:\"Button Backpack\";s:17:\"product-condition\";s:4:\"Used\";s:6:\"vprice\";s:3:\"2\";}', 1, '2022-04-07 07:25:34', NULL),
(4, 3, 'a:6:{s:6:\"colour\";s:5:\"Black\";s:4:\"size\";s:1:\"M\";s:17:\"shoe-closure-type\";s:7:\"Lace-Up\";s:21:\"backpack-closure-type\";s:15:\"Button Backpack\";s:17:\"product-condition\";s:4:\"Used\";s:6:\"vprice\";s:3:\"2\";}', 1, '2022-04-18 23:21:56', NULL),
(5, 5, 'a:4:{s:6:\"colour\";s:4:\"Blue\";s:4:\"size\";s:1:\"M\";s:6:\"vprice\";s:3:\"299\";s:10:\"variant_id\";s:1:\"5\";}', 1, '2022-04-19 00:24:15', NULL),
(6, 5, 'a:4:{s:6:\"colour\";s:4:\"Blue\";s:4:\"size\";s:2:\"XL\";s:6:\"vprice\";s:3:\"299\";s:10:\"variant_id\";s:1:\"6\";}', 1, '2022-04-19 00:24:15', NULL),
(7, 7, 'a:7:{s:6:\"colour\";s:4:\"Blue\";s:4:\"size\";s:1:\"M\";s:17:\"shoe-closure-type\";s:0:\"\";s:21:\"backpack-closure-type\";s:0:\"\";s:17:\"product-condition\";s:0:\"\";s:6:\"vprice\";s:6:\"120.12\";s:10:\"variant_id\";s:1:\"7\";}', 1, '2022-04-19 05:16:15', NULL),
(8, 7, 'a:7:{s:6:\"colour\";s:5:\"Black\";s:4:\"size\";s:2:\"XL\";s:17:\"shoe-closure-type\";s:0:\"\";s:21:\"backpack-closure-type\";s:0:\"\";s:17:\"product-condition\";s:0:\"\";s:6:\"vprice\";s:6:\"126.87\";s:10:\"variant_id\";s:1:\"8\";}', 1, '2022-04-19 05:16:15', NULL),
(9, 1, 'a:3:{s:6:\"colour\";s:5:\"Black\";s:4:\"size\";s:1:\"M\";s:6:\"vprice\";s:1:\"2\";}', 1, '2022-04-19 05:51:29', NULL),
(10, 8, 'a:2:{s:4:\"type\";s:5:\"Gravy\";s:6:\"vprice\";s:3:\"4.5\";}', 1, '2022-04-20 00:23:38', NULL),
(11, 9, 'a:4:{s:6:\"colour\";s:4:\"Blue\";s:4:\"size\";s:2:\"XL\";s:6:\"vprice\";s:3:\"220\";s:10:\"variant_id\";s:2:\"11\";}', 1, '2022-07-11 08:56:51', NULL),
(12, 9, 'a:4:{s:6:\"colour\";s:5:\"Black\";s:4:\"size\";s:1:\"M\";s:6:\"vprice\";s:3:\"230\";s:10:\"variant_id\";s:2:\"12\";}', 1, '2022-07-11 08:56:51', NULL),
(13, 10, 'a:6:{s:6:\"colour\";s:5:\"Black\";s:4:\"size\";s:1:\"M\";s:17:\"shoe-closure-type\";s:7:\"Lace-Up\";s:21:\"backpack-closure-type\";s:15:\"Button Backpack\";s:17:\"product-condition\";s:4:\"Used\";s:6:\"vprice\";s:3:\"676\";}', 1, '2022-07-13 07:49:03', NULL),
(14, 11, 'a:6:{s:6:\"colour\";s:5:\"White\";s:4:\"size\";s:1:\"M\";s:17:\"shoe-closure-type\";s:3:\"Zip\";s:21:\"backpack-closure-type\";s:15:\"Button Backpack\";s:17:\"product-condition\";s:3:\"New\";s:6:\"vprice\";s:3:\"100\";}', 1, '2022-07-13 07:51:12', NULL),
(15, 12, 'a:6:{s:6:\"colour\";s:5:\"Black\";s:4:\"size\";s:1:\"M\";s:17:\"shoe-closure-type\";s:11:\"Hook & Loop\";s:21:\"backpack-closure-type\";s:15:\"Button Backpack\";s:17:\"product-condition\";s:4:\"Used\";s:6:\"vprice\";s:3:\"100\";}', 1, '2022-07-13 08:06:53', NULL),
(16, 13, 'a:6:{s:6:\"colour\";s:5:\"Green\";s:4:\"size\";s:1:\"M\";s:17:\"shoe-closure-type\";s:7:\"Slip On\";s:21:\"backpack-closure-type\";s:13:\"Flap Backpack\";s:17:\"product-condition\";s:4:\"Used\";s:6:\"vprice\";s:3:\"787\";}', 1, '2022-07-13 08:08:43', NULL),
(17, 14, 'a:6:{s:6:\"colour\";s:4:\"Blue\";s:4:\"size\";s:2:\"XL\";s:17:\"shoe-closure-type\";s:6:\"Buckle\";s:21:\"backpack-closure-type\";s:15:\"Buckle Backpack\";s:17:\"product-condition\";s:3:\"New\";s:6:\"vprice\";s:3:\"110\";}', 1, '2022-07-13 08:10:18', NULL),
(18, 14, 'a:6:{s:6:\"colour\";s:5:\"Black\";s:4:\"size\";s:1:\"M\";s:17:\"shoe-closure-type\";s:11:\"Hook & Loop\";s:21:\"backpack-closure-type\";s:15:\"Button Backpack\";s:17:\"product-condition\";s:4:\"Used\";s:6:\"vprice\";s:3:\"130\";}', 1, '2022-07-13 08:10:18', NULL),
(23, 18, 'a:2:{s:9:\"condition\";s:3:\"New\";s:6:\"vprice\";s:6:\"36.528\";}', 1, '2022-07-15 22:31:41', NULL),
(24, 19, 'a:3:{s:6:\"colors\";s:3:\"Red\";s:4:\"size\";s:1:\"L\";s:6:\"vprice\";s:5:\"1500 \";}', 1, '2022-07-15 23:09:12', NULL),
(25, 19, 'a:3:{s:7:\" colors\";s:4:\"Blue\";s:4:\"size\";s:1:\"L\";s:6:\"vprice\";s:4:\"1400\";}', 1, '2022-07-15 23:09:12', NULL),
(26, 20, 'a:4:{s:3:\"ram\";s:4:\"12GB\";s:16:\"internal-storage\";s:5:\"256GB\";s:6:\"colors\";s:3:\"Red\";s:6:\"vprice\";s:5:\"1500 \";}', 1, '2022-07-15 23:09:12', NULL),
(27, 20, 'a:4:{s:3:\"ram\";s:3:\"8GB\";s:16:\"internal-storage\";s:5:\"128GB\";s:6:\"colors\";s:4:\"Blue\";s:6:\"vprice\";s:4:\"1500\";}', 1, '2022-07-15 23:09:12', NULL),
(28, 21, 'a:3:{s:6:\"colors\";s:3:\"Red\";s:4:\"size\";s:1:\"L\";s:6:\"vprice\";s:5:\"1500 \";}', 1, '2022-07-15 23:19:31', NULL),
(29, 21, 'a:3:{s:7:\" colors\";s:4:\"Blue\";s:4:\"size\";s:1:\"L\";s:6:\"vprice\";s:4:\"1400\";}', 1, '2022-07-15 23:19:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(2) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `review` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `images` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `product_id`, `user_id`, `rating`, `title`, `review`, `images`, `created_at`) VALUES
(1, 1, 67, 4, NULL, NULL, NULL, '2022-04-18 23:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `review_like_dislike`
--

CREATE TABLE `review_like_dislike` (
  `id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `response` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Like, 2 = Dislike',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL,
  `business_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_business_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `off_business_mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_reg_num` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_address` text COLLATE utf8_unicode_ci,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt_mobile_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ind_agree` int(11) DEFAULT NULL,
  `business_agree` int(11) DEFAULT NULL,
  `u_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'seller.png',
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` bigint(10) DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `is_featured_seller` int(11) DEFAULT '0',
  `is_subscription` int(1) NOT NULL DEFAULT '0' COMMENT '1=>Active, 0=>Inactive	',
  `seller_subscription_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `storename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arrange_product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_product_list` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `business_type`, `reg_business_name`, `off_business_mobile`, `vat_number`, `business_reg_num`, `business_address`, `first_name`, `middle_name`, `last_name`, `mobile`, `alt_mobile_no`, `ind_agree`, `business_agree`, `u_id`, `user_id`, `image`, `email`, `phone`, `state`, `pincode`, `address`, `status`, `is_featured_seller`, `is_subscription`, `seller_subscription_id`, `created_at`, `updated_at`, `storename`, `product_category`, `arrange_product`, `no_product_list`) VALUES
(1, 'Business', 'Laraib', '7007707556', '321', 'AB 321', 'Torquay, London, united kingdom', 'Laraib', NULL, 'Kidwai', '7007707556', '123456789.', 1, 1, 'SELLERbhv48j', 67, '1648909736_nike-air-shoe-500x500.jpg', 'laraib.kidwai07@gmail.com', 123456789, 'Torquay', 'TQ2', 'Torquay, London, United Kidgdom', 1, 0, 0, '0', '2022-04-02 00:00:00', NULL, 'Laraib Store', 'Luggage', 'I make products by myself.,I Manufacture products.', '10-100'),
(2, 'Business', 'Saluja', '9999161150', 'IKAPA1909H', 'DL10CA4218', 'Janak Puri', 'Saluja', 'Kumar', 'Dheeraj', '7843834894', '0987654321', 1, 1, 'SELLERXupdJ4', 74, '1650279556_41lU0Q61viL._SL1000_.jpg', 'dheerajsaluja9@gmail.com', 1234567890, 'Delhi', 'AL', 'St Lousi Road', 1, 0, 0, '0', '2022-04-06 00:00:00', NULL, 'Saluja Store', 'Women\'s Fashion', 'I Import the products.', '10-100'),
(19, 'Individual', NULL, NULL, NULL, NULL, NULL, 'Dheeraj', 'Kumar', 'Saluja', '0987654321', '1234567890', 1, NULL, 'BUYERls2rhw', 73, 'seller.png', 'djsaluja18@gmail.com', NULL, 'Delhi', 'KA', 'Janak Puri', 0, 0, 0, '0', '2022-04-07 05:42:17', NULL, NULL, NULL, NULL, NULL),
(21, 'Individual', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'seller.png', 'r.majchrzak@icloud.com', NULL, NULL, NULL, NULL, 1, 0, 0, '0', '2022-04-16 16:17:33', NULL, NULL, NULL, NULL, NULL),
(22, 'Business', 'MKP Solution', '07510059020', '34213423421', 'MKP Solution', '50 Leeward Lane', 'Radoslaw', '', 'Majchrzak', NULL, NULL, NULL, 1, 'SELLER6MEAwc', 88, 'seller.png', 'rad@mkpsolution.co.uk', NULL, NULL, NULL, NULL, 1, 0, 0, '0', '2022-04-16 00:00:00', NULL, 'dupa blada', 'Pets', 'I make products by myself.', '1-10'),
(23, 'Business', 'Kidwai Store', '7007707556', '2etyyigff23', '25374ghx', 'Torquay', 'Laraib', NULL, 'Kidwai', NULL, NULL, NULL, 1, 'SELLERMVPlf4', 66, 'seller.png', 'kidwai.laraib987@gmail.com', NULL, NULL, NULL, NULL, 1, 0, 0, '0', '2022-04-18 23:24:57', NULL, NULL, NULL, NULL, NULL),
(24, 'Individual', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BUYEResrF2T', 65, 'seller.png', 'general.krewet@gmail.com', NULL, NULL, NULL, NULL, 0, 0, 0, '0', '2022-04-19 08:01:29', NULL, NULL, NULL, NULL, NULL),
(25, 'Business', 'MKP Solution', '07510059020', '398972708', '13553635', ' TQ2 7GB 50 Leeward Lane ', 'Radoslaw', '', 'Majchrzak', NULL, NULL, NULL, 1, 'SELLERac09iy', 125, 'seller.png', 'info@mkpsolution.co.uk', NULL, NULL, NULL, NULL, 1, 0, 0, '0', '2022-07-15 00:00:00', NULL, 'MKP', 'Home & Garden', 'I Import the products.', 'I Don’t Know'),
(26, 'Business', '12345', '7007707556', 'qwe123', '123456', 'TQ2, Torquay, London', 'Aqilo', '', 'Info', NULL, NULL, NULL, 1, 'SELLERhTsmH4', 126, 'seller.png', 'aqiloinfosolutions@gmail.com', NULL, NULL, NULL, NULL, 1, 0, 0, '0', '2022-07-15 00:00:00', NULL, 'Aqilo', 'Men\'s Fashion', 'I make products by myself.,I resell the products that I buy.,I Import the products.,I Manufacture products.', 'I Don’t Know'),
(27, 'Individual', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BUYERTbreg2', 127, 'seller.png', 'ledbltd@gmail.com', NULL, NULL, NULL, NULL, 1, 0, 0, '0', '2022-07-15 18:06:01', NULL, NULL, NULL, NULL, NULL),
(29, 'Individual', NULL, NULL, NULL, NULL, NULL, 'Dheeraj', 'Kumar', 'Saluja', '0987654321', '1235467890', 1, NULL, 'SELLEREit0pK', 130, 'seller.png', 'terakharchaa@gmail.com', 9999161150, 'Delhi', 'KA', 'India', 1, 0, 0, '0', '2022-07-18 00:00:00', NULL, 'DJ', 'Pets', 'I make products by myself.', '10-100');

-- --------------------------------------------------------

--
-- Table structure for table `seller_featured_subscription`
--

CREATE TABLE `seller_featured_subscription` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `featured_subscription_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'in days',
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seller_featured_subscription`
--

INSERT INTO `seller_featured_subscription` (`id`, `seller_id`, `featured_subscription_id`, `start_date`, `end_date`, `amount`, `duration`, `transaction_id`, `payment_status`, `created_at`) VALUES
(1, 67, 1, '2022-04-19', '2022-05-03', '20', '15', 'a8qlWgLOGv', 'Processing', '2022-04-19');

-- --------------------------------------------------------

--
-- Table structure for table `seller_subscriptions`
--

CREATE TABLE `seller_subscriptions` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `subscription_id` int(11) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `modifiled_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `url`, `status`, `created_date`, `modifiled_date`) VALUES
(1, '1657591575_3ECF5F56-A213-4234-89D7-1AC6F1F5A52D.png', '#', 1, '2022-02-04 11:32:00', '2022-07-12 02:06:15'),
(4, '1657591779_3DBC2BC8-AF15-4136-94AD-1BE0ECEA5096.png', '#', 1, '2022-02-15 11:06:57', '2022-07-12 02:09:39'),
(7, '1657591353_05B73D08-D393-47A2-B189-33904EE93EB2.png', '#', 1, '2022-02-17 11:22:28', '2022-07-12 02:02:33');

-- --------------------------------------------------------

--
-- Table structure for table `specifications`
--

CREATE TABLE `specifications` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cat_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `specifications`
--

INSERT INTO `specifications` (`id`, `name`, `cat_id`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(4, 'Colour', '8,21,23,25,26,27,28,29,30', 'colour', '1649312342_1643786574_red-color-solid-background-1920x1080.png', '2022-04-07 06:19:02', '2022-07-12 00:49:11'),
(5, 'Clothing Size', '25,26', 'clothing-size', '1649312366_1639734548_SIZECHART_cms.png', '2022-04-07 06:19:26', '2022-07-15 11:17:16'),
(7, 'Screen Size', '11', 'screen-size', '1657145271_B5FC70E9-3F84-4D0B-BDB8-5F9620B166DE.png', '2022-07-06 22:07:51', '2022-07-08 01:47:27'),
(8, 'Home Theatre', '11', 'home-theatre', '1657145535_669A5A64-EA6F-4D37-B97A-9C400E894148.png', '2022-07-06 22:12:15', NULL),
(9, 'Resolution', '11', 'resolution', '1657243862_44A33FDE-AFFF-469E-9128-2ACA8159A497.png', '2022-07-08 01:31:02', NULL),
(10, 'Refresh Rate', '11', 'refresh-rate', '1657244967_80152636-8BE6-41D9-9DE4-32ADB1D6331E.png', '2022-07-08 01:49:27', NULL),
(11, 'Display Type', '11', 'display-type', '1657245137_A03AC4A3-8848-4592-A4F8-109491E1BA89.png', '2022-07-08 01:52:17', '2022-07-08 01:53:17'),
(12, 'OS', '11', 'os', '1657245473_8F1D6C97-122D-41EF-A9C9-3A42E935FC44.png', '2022-07-08 01:57:53', NULL),
(13, 'USB Ports', '11', 'usb-ports', '1657245769_1551F019-520A-42FE-8F97-2BA087808978.png', '2022-07-08 02:02:49', NULL),
(14, 'Mount Type', '11', 'mount-type', '1657245936_2CBD5E05-258D-42FE-96FE-1400716CEC6A.png', '2022-07-08 02:05:36', NULL),
(15, 'HDMI Ports', '11', 'hdmi-ports', '1657246092_D4F63524-D5EB-470F-B4C3-8585BD3D5703.png', '2022-07-08 02:08:12', NULL),
(16, 'Connectivity', '11', 'connectivity', '1657246278_63866842-9CDE-49EE-AF3A-9C02905BD5E3.png', '2022-07-08 02:11:18', NULL),
(17, 'Brands', '11', 'brands', '1657246555_45825D39-04BC-48CB-99C6-171EF9D721D4.png', '2022-07-08 02:15:55', NULL),
(18, 'Supported Internet Service', '11', 'supported-internet-service', '1657246989_CEA5F8CC-98B2-4F92-AFB4-2636DB32C816.png', '2022-07-08 02:23:09', NULL),
(20, 'Baby Products', '30', 'baby-products', '1657329165_baby-products-during-amazons-memorial-day-sale-tout-2000-2aacf6b485344a38a19ddd9210ab020c.jpg', '2022-07-09 01:12:45', NULL),
(21, 'Featured Brands', '30', 'featured-brands', '1657329612_baby-products-during-amazons-memorial-day-sale-tout-2000-2aacf6b485344a38a19ddd9210ab020c.jpg', '2022-07-09 01:20:12', NULL),
(24, 'Girl\'s Clothing', '29', 'girl-s-clothing', '1657330783_CW-Girls-hyb3-090421.webp', '2022-07-09 01:39:43', NULL),
(25, 'Children Size', '28,29', 'children-size', '1657399815_girl in a floral kidpik dress.png', '2022-07-09 20:50:15', '2022-07-12 00:44:37'),
(26, 'Material', '25,26,28,29', 'material', '1657400390_A1ZfZkS3irL._SX466_.jpg', '2022-07-09 20:59:50', '2022-07-15 10:47:00'),
(27, 'Pattern', '25,26,28,29', 'pattern', '1657400568_cute-pattern-background-polka-dot-black-white-vector_53876-151294.webp', '2022-07-09 21:02:48', '2022-07-15 10:39:44'),
(28, 'Popular Brands', '29', 'popular-brands', '1657401015_1528711065.png', '2022-07-09 21:10:15', NULL),
(29, 'Girl\'s Shoes', '29', 'girl-s-shoes', NULL, '2022-07-09 21:18:59', NULL),
(30, 'Little Kid Shoe Size', '28,29', 'little-kid-shoe-size', NULL, '2022-07-09 22:58:25', '2022-07-12 01:37:10'),
(31, 'Bigger Kid Shoe Sizes', '28,29', 'bigger-kid-shoe-sizes', NULL, '2022-07-09 23:11:21', '2022-07-12 01:38:30'),
(32, 'Shoe Closure Type', '25,26,28,29', 'shoe-closure-type', NULL, '2022-07-09 23:16:02', '2022-07-12 01:45:47'),
(34, 'Watch Type', '27,28', 'watch-type', '1657562484_966B5C57-6E96-4DCF-A47E-6529ED8523FC.png', '2022-07-11 18:01:24', '2022-07-13 22:10:07'),
(35, 'Watchband Style', '27,28,29', 'watchband-style', '1657562728_4F259F4E-C6E1-4DC7-94B5-785F88BDDC99.png', '2022-07-11 18:05:28', '2022-07-14 12:54:08'),
(36, 'Backpack Closure Type', '25,26,28,29', 'backpack-closure-type', '1657563467_21946BAA-123B-47D9-A204-8411945B3333.png', '2022-07-11 18:17:47', '2022-07-12 01:18:54'),
(38, 'Boys Clothing', '28', 'boys-clothing', '1657564793_47167F2A-CE95-43BD-AD8A-BC8FAED35864.png', '2022-07-11 18:39:53', NULL),
(42, 'Shoes', '25,28', 'shoes', '1657584040_9e68e729-d4b1-4d50-b761-5b152934376b_large.webp', '2022-07-12 00:00:40', '2022-07-15 11:13:17'),
(45, 'Strap Type', '28', 'strap-type', '1657585500_38073AP01_1.webp', '2022-07-12 00:25:00', NULL),
(46, 'Condition', '8,9,11,12,21,22,23,25,26,27,28,29,30,31,32,33', 'condition', '1657585732_heritage-backpack-4dX7J5.jfif', '2022-07-12 00:28:52', '2022-07-13 20:23:36'),
(48, 'Insects', '33', 'insects', '1657742352_41mQu2AnUdL.jpg', '2022-07-13 19:59:12', NULL),
(49, 'Horse', '33', 'horse', '1657742579_71OV7rrx0vL._AC_UL320_.jpg', '2022-07-13 20:02:59', NULL),
(50, 'Small Animals', '33', 'small-animals', '1657742833_Western_Timothy_Hay_2048x.webp', '2022-07-13 20:07:13', NULL),
(51, 'Birds', '33', 'birds', '1657743108_450-bird-bf001-petnest-original-imaex3tfu3jnfgun.webp', '2022-07-13 20:11:48', NULL),
(52, 'Fish & Aquatic', '33', 'fish-aquatic', '1657743325_0-2-fish-taiyo2-taiyo-original-imafyffdjw9dwyyd.webp', '2022-07-13 20:15:25', NULL),
(53, 'Cats', '33', 'cats', '1657743472_40214916_1-whiskas-tasty-wet-cat-food-tuna-fish-kanikama-with-carrots-in-gravy-1-year.webp', '2022-07-13 20:17:52', NULL),
(54, 'Dogs', '33', 'dogs', '1657743907_pedigree-dog-foods-500x500.jpg', '2022-07-13 20:25:07', NULL),
(57, 'Movement', '27', 'movement', '1657802099_77417699-2AEE-48DE-99DE-E669708AF818.jpeg', '2022-07-14 12:34:59', NULL),
(58, 'Case Style', '27', 'case-style', '1657802360_6D4F954A-B7C4-499E-A6F9-DDF8B2399680.png', '2022-07-14 12:39:20', NULL),
(59, 'Case Material', '27', 'case-material', '1657802576_67455A12-BCC7-41F2-B459-347B1E0EB39F.png', '2022-07-14 12:42:56', NULL),
(60, 'Case Diameter', '27', 'case-diameter', '1657802727_869119CE-DD8C-4E84-88A8-3F5663D1429A.png', '2022-07-14 12:45:27', NULL),
(61, 'Case Thickness', '27', 'case-thickness', '1657803055_95A15537-B62C-438B-9E3E-0D861AD8B118.jpeg', '2022-07-14 12:50:55', NULL),
(62, 'Crystal Material', '27', 'crystal-material', '1657803473_1B7329F6-7736-432E-9064-D700C8159055.png', '2022-07-14 12:57:53', NULL),
(63, 'Stone Set', '27', 'stone-set', '1657803722_0DCE98BF-D998-4FD2-A544-4BF0A8BD1304.png', '2022-07-14 13:02:02', NULL),
(64, 'Watch Features', '27', 'watch-features', '1657835743_DAE132F0-4247-4B43-965E-81A340944AFA.jpeg', '2022-07-14 21:55:43', NULL),
(65, 'Water Resistance', '27', 'water-resistance', '1657836444_C441169A-92F3-4DDE-8B20-5006740D0366.jpeg', '2022-07-14 22:07:24', '2022-07-14 22:07:37'),
(66, 'Jewelry', '27', 'jewelry', '1657836854_E6DA5EBC-2FE3-4202-93D3-DB4B032E984A.jpeg', '2022-07-14 22:14:14', NULL),
(67, 'Watch Repair Tools & Kits', '27', 'watch-repair-tools-kits', '1657837459_EA48BE24-C417-45D6-BE71-D6057FE2F909.png', '2022-07-14 22:24:19', NULL),
(68, 'By Age', '21', 'by-age', '1657869939_3134CD0B-A7CC-4ECE-8573-00552E116264.png', '2022-07-15 07:25:39', NULL),
(69, 'Toy Department', '21', 'toy-department', '1657870311_0F4DED6A-027B-4DE4-B806-BD6D1B8798BB.png', '2022-07-15 07:31:51', NULL),
(70, 'Character', '21', 'character', '1657871972_917B7652-7418-44C3-90D5-C59B3C27DCCE.png', '2022-07-15 07:59:32', NULL),
(71, 'Luxury Food & Drink Brands', '32', 'luxury-food-drink-brands', '1657872557_50162678-76E0-4334-812B-9B6659988A8B.jpeg', '2022-07-15 08:09:17', NULL),
(72, 'Alchoholic Drinks Brands', '32', 'alchoholic-drinks-brands', '1657873730_690F326E-BD17-4B98-A6BF-8F4DF603F59B.png', '2022-07-15 08:28:50', '2022-07-15 08:30:27'),
(73, 'Baby Food', '32', 'baby-food', '1657874561_351DE38A-034A-45E8-ADA8-9349562D6FFD.png', '2022-07-15 08:42:41', NULL),
(74, 'Free From', '32', 'free-from', '1657875724_1D1D20B5-59D2-4958-9E24-28A7AB994BAD.png', '2022-07-15 09:02:04', NULL),
(75, 'Bakery', '32', 'bakery', '1657876086_B4727A2B-774B-429F-A80D-57D463B5F6D5.png', '2022-07-15 09:08:06', NULL),
(76, 'Drinks', '32', 'drinks', '1657876737_646BF4C7-442C-401F-9048-9BA30DA99D39.png', '2022-07-15 09:18:57', NULL),
(77, 'Flavour', '32', 'flavour', '1657877433_81B7328F-64C9-47AD-8AB7-0E2F3F60CB26.png', '2022-07-15 09:30:33', NULL),
(78, 'Frozen', '32', 'frozen', '1657877977_5ec51df832641.jpg', '2022-07-15 09:39:37', NULL),
(79, 'Hampers & Gourmet Gifts', '32', 'hampers-gourmet-gifts', '1657878714_p-gourmet-hamper-124764-m.jpg', '2022-07-15 09:51:54', NULL),
(80, 'Fresh & Chilled', '32', 'fresh-chilled', '1657879409_b7c9754a738ee92b8677ce5c6a65fe43.jpg', '2022-07-15 10:03:29', NULL),
(81, 'Beer, Wine & Spirits', '32', 'beer--wine-spirits', '1657879947_2022_0522_SummerEntertainingGuide_Banner.png', '2022-07-15 10:12:27', NULL),
(82, 'Men\'s Clothing', '25', 'men-s-clothing', '1657880543_basics.webp', '2022-07-15 10:22:23', '2022-07-15 10:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe_products`
--

CREATE TABLE `subscribe_products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `duration` int(5) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `duration` int(5) NOT NULL DEFAULT '0' COMMENT 'in months',
  `plan_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_limit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `duration`, `plan_name`, `price`, `product_limit`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 'Professional', '50', '35', '2021-12-14 23:36:12', NULL, 1),
(2, 1, 'Professional Plus', '100', '75', '2021-12-14 23:40:03', NULL, 1),
(3, 1, 'Professional Pro', '150', '250', '2021-12-14 23:42:04', '2022-01-29 12:32:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'subcategory.jpg',
  `cat_id` int(4) NOT NULL DEFAULT '0',
  `created_date` timestamp NULL DEFAULT NULL,
  `modifiled_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `slug`, `image`, `cat_id`, `created_date`, `modifiled_date`) VALUES
(15, 'Clothing', 'clothing', '1650111078_woman clothing.jpg', 26, '2022-04-16 12:11:18', NULL),
(16, 'Jeans', 'jeans', '1650111178_jeans.png', 26, '2022-04-16 12:12:58', NULL),
(17, 'Shoes', 'shoes', 'subcategory.jpg', 26, '2022-04-16 12:17:02', NULL),
(18, 'Trainers', 'trainers', '1650111575_trainers.jpg', 26, '2022-04-16 12:19:35', NULL),
(19, 'Women\'s Jewellery', 'women-s-jewellery', '1650111803_istockphoto-1180931397-170667a.jpg', 27, '2022-04-16 12:23:23', NULL),
(20, 'Women\'s Watches', 'women-s-watches', '1650111869_41Dn6Clr2aL._AC._SR240,240.jpg', 27, '2022-04-16 12:24:29', NULL),
(21, 'Luggage', 'luggage', '1650112077_41XVIrOI2DL._AC_SX466_.jpg', 26, '2022-04-16 12:27:57', '2022-04-16 12:28:24'),
(22, 'Men\'s Clothing', 'men-s-clothing', '1650112232_business-concept-smiling-thoughtful-handsome-man-standing-white-isolated-background-touching-his-chin-with-hand.jpg', 25, '2022-04-16 12:30:32', NULL),
(23, 'Men\'s Jeans', 'men-s-jeans', '1650112315_istockphoto-1154077427-170667a.jpg', 25, '2022-04-16 12:31:55', NULL),
(24, 'Men\'s Shoes', 'men-s-shoes', '1650112363_leather-shoes-wooden-background.jpg', 25, '2022-04-16 12:32:43', NULL),
(25, 'Men\'s Trainers', 'men-s-trainers', '1650112405_salewa-m-mountain-trainer-gtx-13a-slw-63026-black-acid-lemon-1.jpg', 25, '2022-04-16 12:33:25', NULL),
(26, 'Men\'s Accessories', 'men-s-accessories', '1650112511_istockphoto-638385938-170667a.jpg', 25, '2022-04-16 12:35:11', NULL),
(27, 'Men\'s Luggage', 'men-s-luggage', '1650112585_55-557297_images-aldo-mens-duffle-bag.png', 25, '2022-04-16 12:36:25', NULL),
(28, 'Men\'s Watches', 'men-s-watches', '1650112621_240_F_321571667_dx4FAYnw0iK8qnk65PPe7wEnjX6uoaHI.jpg', 27, '2022-04-16 12:37:01', NULL),
(29, 'Men\'s Jewellery', 'men-s-jewellery', '1650112776_2PCS-DJ-Phonograph-Big-Pendant-Necklace-For-Men-Jewelry-Hiphop-Chain-Gold-Silver-Color-Mens-Jewellery_34ef9aca-1185-4414-aa1e-d29f781af3e5_medium.webp', 27, '2022-04-16 12:39:36', NULL),
(30, 'Boys Clothing', 'boys-clothing', '1650113162_istockphoto-1296361252-170667a.jpg', 28, '2022-04-16 12:46:02', NULL),
(31, 'Boys Shirts', 'boys-shirts', '1650113221_istockphoto-465113506-170667a.jpg', 28, '2022-04-16 12:47:01', NULL),
(32, 'Boys Shoes', 'boys-shoes', '1650113278_66663534-7df6-46b0-8b03-b2fc3eade157.jpg.webp', 28, '2022-04-16 12:47:58', NULL),
(33, 'Boys Sleepwear', 'boys-sleepwear', '1650113378_0c8a480302090ec86e88af3ddad6a2cf.jpg', 28, '2022-04-16 12:49:38', NULL),
(34, 'Boys Watches', 'boys-watches', '1650113450_41zVYdl7RhL._AC._SR240,240.jpg', 28, '2022-04-16 12:50:50', NULL),
(35, 'Boys Backpacks', 'boys-backpacks', '1650113521_istockphoto-911249988-170667a.jpg', 28, '2022-04-16 12:52:01', NULL),
(36, 'Girls Clothing', 'girls-clothing', '1650113748_322FR-6_medium.webp', 29, '2022-04-16 12:55:48', NULL),
(37, 'Girls Dresses', 'girls-dresses', '1650113794_icon.webp', 29, '2022-04-16 12:56:34', NULL),
(38, 'Girls Shoes', 'girls-shoes', '1650113841_tyrzxd1617334649469.webp', 29, '2022-04-16 12:57:21', NULL),
(39, 'Girls Sleepwear', 'girls-sleepwear', '1650113915_image_bce26850-2e1e-428f-af21-477d15eeb5e5_5000x.jpg', 29, '2022-04-16 12:58:35', NULL),
(40, 'Girls Watches', 'girls-watches', '1650113988_4130mwPSGqL._AC_UL320_.jpg', 29, '2022-04-16 12:59:48', NULL),
(41, 'Girls Backpacks', 'girls-backpacks', '1650114061_se_50110831_unicorn_backpack_medium_model_3.jpg', 29, '2022-04-16 13:01:01', NULL),
(42, 'Boys', 'boys', '1650114168_infant-boy-desktop-wallpaper-child-png-favpng-a85qiw603863snk0BZVkp7ePh.jpg', 30, '2022-04-16 13:02:48', '2022-04-16 13:04:03'),
(43, 'Girls', 'girls', '1650114232_pexels-j-carter-713959.jpg', 30, '2022-04-16 13:03:52', NULL),
(44, 'Camera & Photo', 'camera-photo', '1650115003_pexels-photo-733853.jpeg', 11, '2022-04-16 13:16:43', NULL),
(45, 'Tv & Home Cinema', 'tv-home-cinema', '1650115055_download.jfif', 11, '2022-04-16 13:17:35', NULL),
(46, 'Audio & Hifi', 'audio-hifi', '1650115720_61445415.jpg', 11, '2022-04-16 13:28:40', NULL),
(47, 'Headphones', 'headphones', '1650115831_ae7f95a5-6999-494b-a282-3e2d4428b3bf.webp', 11, '2022-04-16 13:30:31', NULL),
(48, 'Phones', 'phones', '1650115906_51XkqbQ5DqS._AC._SR240,240.jpg', 11, '2022-04-16 13:31:46', NULL),
(49, 'Phones Accessories', 'phones-accessories', '1650116008_50572bf080dca4ca705ede94f8510f1b.png', 11, '2022-04-16 13:33:28', NULL),
(50, 'Electronics Accessories', 'electronics-accessories', '1650116147_serv19.jpg', 11, '2022-04-16 13:35:47', NULL),
(51, 'Pc & Video Games', 'pc-video-games', '1650116212_icon.webp', 11, '2022-04-16 13:36:52', NULL),
(52, 'Laptops', 'laptops', '1650116437_AMZ_FamilyStripe_MacBook_Air_Retina_M1._CB416916593_.png', 31, '2022-04-16 13:40:37', NULL),
(53, 'Desktop', 'desktop', '1650116511_close-up-rgb-system-desktop-pro-gamer-playing-first-person-shooter-video-game-during-online-competition-streaming-studio-is-equipped-with-professional-setup-with-powerful-pc-ready-online-game.jpg', 31, '2022-04-16 13:41:51', NULL),
(54, 'Monitors', 'monitors', '1650116758_91IHZveIhZL._AC._SR360,460.jpg', 31, '2022-04-16 13:45:58', '2022-04-16 13:48:16'),
(55, 'Tablets', 'tablets', '1650116829_neocore_e1_1800x1800.jpg', 31, '2022-04-16 13:47:09', '2022-04-16 13:48:04'),
(56, 'Accessories', 'accessories', '1650117024_425-4251417_computer-accessories.png', 31, '2022-04-16 13:50:24', NULL),
(57, 'Components', 'components', '1650117085_istockphoto-619052288-170667a.jpg', 31, '2022-04-16 13:51:25', NULL),
(58, 'Desk', 'desk', '1650117154_dogan-computer-desk.webp', 31, '2022-04-16 13:52:34', NULL),
(59, 'Chairs', 'chairs', '1650117198_1_94d72097-d7ae-4cd9-8733-664a6fc249fc_x900.webp', 31, '2022-04-16 13:53:18', NULL),
(60, 'Office Supplies', 'office-supplies', '1650117264_41WHJxZ-t6L._AC._SR240,240.jpg', 31, '2022-04-16 13:54:24', NULL),
(61, 'Toys & Games', 'toys-games', '1650117399_fb283.jpg', 21, '2022-04-16 13:56:39', NULL),
(62, 'Babys', 'babys', '1650117478_fa095.jpg', 21, '2022-04-16 13:57:58', NULL),
(63, 'Sport Clothing', 'sport-clothing', '1650117696_istockphoto-466367844-612x612.jpg', 9, '2022-04-16 14:01:36', NULL),
(64, 'Sport Shoes', 'sport-shoes', '1650117795_ASI10889_400_1.jpg', 9, '2022-04-16 14:03:15', NULL),
(65, 'Fitness', 'fitness', '1650117858_icon.webp', 9, '2022-04-16 14:04:18', NULL),
(66, 'Camping & Hiking', 'camping-hiking', '1650117943_71t7vLM8Z+L._AC_SL1500_.jpg', 9, '2022-04-16 14:05:43', NULL),
(67, 'Cycling', 'cycling', '1650118002_wp1867238.jpg', 9, '2022-04-16 14:06:42', NULL),
(68, 'Sports technology', 'sports-technology', '1650118067_istockphoto-496560735-170667a.jpg', 9, '2022-04-16 14:07:47', NULL),
(69, 'Water Sports', 'water-sports', '1650118122_pexels-photo-1604869.jpeg', 9, '2022-04-16 14:08:42', NULL),
(70, 'Winter Sports', 'winter-sports', '1650118176_istockphoto-1309988966-170667a.jpg', 9, '2022-04-16 14:09:36', NULL),
(71, 'Golf', 'golf', '1650118277_2UJT4CA4QZMITLFWG7CHEAZYSU.jpg', 9, '2022-04-16 14:11:17', NULL),
(72, 'Running', 'running', '1650118336_321.webp', 9, '2022-04-16 14:12:16', NULL),
(73, 'Sports Nutrition', 'sports-nutrition', '1650118450_istockphoto-1299421209-170667a.jpg', 9, '2022-04-16 14:14:10', NULL),
(74, 'FanShop', 'fanshop', '1650118581_images.jfif', 9, '2022-04-16 14:16:21', NULL),
(75, 'Grocery', 'grocery', '1650118724_0x0.jpg', 32, '2022-04-16 14:18:44', NULL),
(76, 'Alcoholic drinks', 'alcoholic-drinks', '1650118837_5aeb48481e00002c008e45f7.jpeg', 32, '2022-04-16 14:20:37', NULL),
(77, 'Luxury Food & Drinks', 'luxury-food-drinks', '1650118899_21988660_m.jpg', 32, '2022-04-16 14:21:39', NULL),
(78, 'Car Accessories & Parts', 'car-accessories-parts', '1650119536_1.jpg', 8, '2022-04-16 14:32:16', NULL),
(79, 'Tools & Equipment', 'tools-equipment', '1650119604_Automotive-Tools-And-Equipment.jpg', 8, '2022-04-16 14:33:24', NULL),
(80, 'Sat Nav', 'sat-nav', '1650119666_rf-lg_c8bb50e5-c340-4568-bfac-2da74639b2c3_700x.webp', 8, '2022-04-16 14:34:26', NULL),
(81, 'Car Electronics', 'car-electronics', '1650119746_shutterstock_658708672.webp', 8, '2022-04-16 14:35:46', NULL),
(82, 'Motorbike Accessories', 'motorbike-accessories', '1650119827_Motorcycle-Accessories.jpg', 8, '2022-04-16 14:37:07', NULL),
(83, 'Motorbike Parts', 'motorbike-parts', '1650119892_istockphoto-488965597-612x612.jpg', 8, '2022-04-16 14:38:12', NULL),
(84, 'Kitchen & Home Appliances', 'kitchen-home-appliances', '1650120906_0e90912ba6dd583a52687d488ac7af4a.jpg', 22, '2022-04-16 14:55:06', NULL),
(85, 'Large Appliances', 'large-appliances', '1650120986_file.jpg', 22, '2022-04-16 14:56:26', NULL),
(86, 'Cooking & Dining', 'cooking-dining', '1650121045_1815-cooking-dining-pots-pans.jpeg', 22, '2022-04-16 14:57:25', NULL),
(87, 'Furniture', 'furniture', '1650121111_posters-in-cozy-apartment-interior-royalty-free-image-943910360-1534189931.jpg', 22, '2022-04-16 14:58:31', NULL),
(88, 'Bedding & Linens', 'bedding-linens', '1650121171_linen-bedding-1623679778.jpeg', 22, '2022-04-16 14:59:31', NULL),
(89, 'Home Accessories', 'home-accessories', '1650121265_contemporary-living-room-style-inspiration-1588618235.jpg', 22, '2022-04-16 15:01:05', NULL),
(90, 'Arts, Crafts & Sewing', 'arts--crafts-sewing', '1650121430_Arts_Crafts_Sewing_2048x2048.jpg', 22, '2022-04-16 15:03:50', NULL),
(91, 'Garden & Outdoors', 'garden-outdoors', '1650121498_garden-design-ideas-the-rug-seller-scion-mr-fox-outdoor-rug-charcoal-grey-1623345989.jpg', 22, '2022-04-16 15:04:58', NULL),
(92, 'Kitchen Fixtures', 'kitchen-fixtures', '1650121591_Best-Touchless-Kitchen-Faucets.jpg', 22, '2022-04-16 15:06:31', NULL),
(93, 'Bathroom Fixtures', 'bathroom-fixtures', '1650121690_upload-5d5aa6cec35cd.jpeg', 22, '2022-04-16 15:08:10', NULL),
(94, 'Trade & Professional Tools', 'trade-professional-tools', '1650121804_hyde.jpg', 22, '2022-04-16 15:10:04', NULL),
(95, 'Smart Home', 'smart-home', '1650121864_smart_home_-_44.jpg', 22, '2022-04-16 15:11:04', NULL),
(96, 'Lighting', 'lighting', '1650121933_illuminated-pendant-lights-hanging-from-ceiling-royalty-free-image-1576719488.jpg', 22, '2022-04-16 15:12:13', NULL),
(97, 'Dogs', 'dogs', '1650122049_09sp-ai-pets-promo-mediumSquareAt3X.jpg', 33, '2022-04-16 15:14:09', NULL),
(98, 'Cats', 'cats', '1650122121_VIER PFOTEN_2016-07-08_011-4993x3455-1920x1329.jpg', 33, '2022-04-16 15:15:21', '2022-04-19 00:08:52'),
(99, 'Fish & Aquatic', 'fish-aquatic', '1650122229_close-up-of-fish-swimming-in-aquarium-at-home-742356665-5aa2bab2fa6bcc00377fd8b0.jpg', 33, '2022-04-16 15:17:09', NULL),
(100, 'Birds', 'birds', '1650122288_Lovebird.jpg', 33, '2022-04-16 15:18:08', NULL),
(101, 'Small Animals', 'small-animals', '1650122349_food-for-small-pets-animals.jpg', 33, '2022-04-16 15:19:09', NULL),
(102, 'Horses', 'horses', '1650122402_Nokota_Horses_cropped.jpg', 33, '2022-04-16 15:20:02', NULL),
(103, 'Insects', 'insects', '1650122479_p0b6kbdt.jpg', 33, '2022-04-16 15:21:19', NULL),
(104, 'Bath & Body', 'bath-body', '1650123872_Bath-and-Bodyworks-m.jpg', 12, '2022-04-16 15:44:32', NULL),
(105, 'Fragrances', 'fragrances', '1650124068_summer-fragrances-1616601226.png', 12, '2022-04-16 15:47:48', NULL),
(106, 'Hair Care & Styling', 'hair-care-styling', '1650124215_hair-styling-products-market-400x225.jpg', 12, '2022-04-16 15:50:15', NULL),
(107, 'Health Care', 'health-care', '1650124294_gleiss_lutz_rechtsanwaelte_news_healthcare_2_3.jpg', 12, '2022-04-16 15:51:34', NULL),
(108, 'Make-Up', 'make-up', '1650124349_makeup-header-2000.jpg', 12, '2022-04-16 15:52:29', NULL),
(109, 'Massage', 'massage', '1650124390_what-is-aromatherapy-1024x680.jpg', 12, '2022-04-16 15:53:10', NULL),
(110, 'Medical & Mobility', 'medical-mobility', '1650124444_Mobility-medical-equipment-solutions-to-your-mobility-issues2.jpg', 12, '2022-04-16 15:54:04', NULL),
(111, 'Nail & Manicure & Pedicure', 'nail-manicure-pedicure', '1650124510_pedicure-manicure.jpg', 12, '2022-04-16 15:55:10', NULL),
(112, 'Other', 'other', '1650124563_beaea384-aba1-442d-862c-aaa4cb6054ba.jpg', 12, '2022-04-16 15:56:03', NULL),
(113, 'Salon & Spa', 'salon-spa', '1650124618_27_20190507153534_6508022_large.jpg', 12, '2022-04-16 15:56:58', NULL),
(114, 'Shaving & Hair', 'shaving-hair', '1650124729_3ea69d27ea42604bd4e89d500df18cb234034316.jpg', 12, '2022-04-16 15:58:11', '2022-04-16 15:58:49'),
(115, 'Skin Care', 'skin-care', '1650124804_overdoing-skincare-today-main-190509.jpg', 12, '2022-04-16 16:00:04', NULL),
(116, 'Sun Care', 'sun-care', '1650124849_Sun-care-market-trends-beyond-SPF-and-UV-protection-towards-anti-aging-anti-pollution-and-green.jpg', 12, '2022-04-16 16:00:49', NULL),
(117, 'Vitamins', 'vitamins', '1650124895_images.jfif', 12, '2022-04-16 16:01:35', NULL),
(118, 'Antiques', 'antiques', '1650125061_antiques-market.jpg', 23, '2022-04-16 16:04:21', NULL),
(119, 'Art', 'art', '1650125162_7-Tips-to-Finding-Art-Inspiration-Header-1024x649.jpg', 23, '2022-04-16 16:06:02', NULL),
(120, 'Autograph', 'autograph', '1650125218_writer-signing-autograph-book-table-writer-signing-autograph-book-table-closeup-123157058.jpg', 23, '2022-04-16 16:06:58', NULL),
(121, 'Badges', 'badges', '1650125272_unique-button-badges_1.jpg', 23, '2022-04-16 16:07:52', NULL),
(122, 'Carpets & Rugs', 'carpets-rugs', '1650125381_persian-rugs-on-wood-floor-royalty-free-image-869466098-1554495919.jpg', 23, '2022-04-16 16:09:41', NULL),
(123, 'Coins', 'coins', '1650125399_closeup-old-russian-coin-wooden.jpg', 23, '2022-04-16 16:09:59', NULL),
(124, 'Comics', 'comics', '1650125453_rDb7AqhKxLZAKJp9fqqUSJ-1200-80.jpg', 23, '2022-04-16 16:10:53', NULL),
(125, 'Decorative', 'decorative', '1650125515_decorative-art-47.jpg', 23, '2022-04-16 16:11:55', NULL),
(126, 'Militaria', 'militaria', '1650125558_download.jfif', 23, '2022-04-16 16:12:38', NULL),
(127, 'PostCards', 'postcards', '1650125621_41Jds5MoNFL._AC_.jpg', 23, '2022-04-16 16:13:41', NULL),
(128, 'Stamps', 'stamps', '1650125677_6ec8a5c34d4fcfd5a7f0cbaa5cd6d05f.jpg', 23, '2022-04-16 16:14:37', NULL),
(129, 'Trading Cards', 'trading-cards', '1650125730_1_7KtvR6pUmGo706csfLCVLw.jpeg', 23, '2022-04-16 16:15:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `id` int(11) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `admin_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `seller_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `buyer_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0' COMMENT '1=order, 2=bid, 3=subscription, 4=featured_subscription, 5=addmoneytowallet',
  `transaction_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `seller_paid` int(1) NOT NULL DEFAULT '0' COMMENT '0 = unpaid, 1= paid',
  `seller_paid_on` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seller_pay_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `order_detail_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaction_history`
--

INSERT INTO `transaction_history` (`id`, `payment_method`, `amount`, `user_id`, `admin_amount`, `seller_amount`, `buyer_amount`, `status`, `type`, `transaction_id`, `created_at`, `seller_paid`, `seller_paid_on`, `seller_pay_id`, `product_id`, `order_detail_id`) VALUES
(1, 'Paypal', '110', 74, '14.3', '95.7', '0', 'Pending', 1, 'q3kiXIWrK6', '2022-04-08 05:12:54', 1, '08-04-2022 12:46:24', '9884HFB7', 2, 1),
(2, 'Paypal', '120', 74, '15.6', '104.4', '0', 'Pending', 1, 'ox6FUqjz3B', '2022-04-08 05:15:18', 1, '11-04-2022 03:49:04', '88YHA28H', 1, 2),
(3, 'Paypal', '530', 67, '68.9', '461.1', '0', 'Pending', 1, 'ox6FUqjz3B', '2022-04-08 05:15:18', 1, '08-04-2022 12:52:54', '873487438', 3, 3),
(4, 'Paypal', '120', 74, '15.6', '104.4', '0', 'Pending', 1, 'sI3unT26Py', '2022-04-08 05:22:40', 1, '08-04-2022 09:48:42', 'tesr12312', 1, 4),
(5, 'Paypal', '110', 74, '14.3', '95.7', '0', 'Pending', 1, 'ZONF9Kqkj6', '2022-04-08 09:53:51', 1, '08-04-2022 12:40:47', '8783j', 2, 5),
(6, 'Paypal', '120', 74, '15.6', '104.4', '0', 'Pending', 1, 'ZONF9Kqkj6', '2022-04-08 09:53:51', 1, '08-04-2022 12:40:47', '8783j', 1, 6),
(8, 'Emporium Wallet', '2', 74, '0.2', '1.8', '0', 'Success', 1, 'hyGYLDmHIW', '2022-04-11 04:31:14', 1, '11-04-2022 05:16:23', '88734JHGH', 1, 21),
(9, 'Emporium Wallet', '2', 67, '0.2', '1.8', '0', 'Success', 1, 'oXMF5HQpwq', '2022-04-11 05:17:51', 0, NULL, NULL, 3, 22),
(10, 'Emporium Wallet', '2', 74, '0.2', '1.8', '0', 'Success', 1, 'oXMF5HQpwq', '2022-04-11 05:17:51', 0, NULL, NULL, 1, 23),
(11, 'Paypal', '110', 74, '14.3', '95.7', '0', 'Pending', 1, 'IF7VCJfTsi', '2022-04-11 05:23:49', 1, '11-04-2022 06:26:15', '8989HTA989', 2, 24),
(12, 'Paypal', '2', 74, '0.26', '1.74', '0', 'Pending', 1, 'IF7VCJfTsi', '2022-04-11 05:23:49', 0, NULL, NULL, 1, 25),
(13, 'Paypal', '110', 74, '14.3', '95.7', '0', 'Pending', 1, '5sBSAULDen', '2022-04-11 07:11:01', 1, '11-04-2022 07:16:39', '77463AYZ', 2, 27),
(14, 'Emporium Wallet', '2', 67, '0.2', '1.8', '0', 'Success', 1, 'GXOZjMDH2t', '2022-04-11 07:21:39', 1, '11-04-2022 08:09:12', '87487EMP', 3, 28),
(15, 'Emporium Wallet', '4', 74, '0.4', '3.6', '0', 'Success', 1, 'lBVHUgGKOd', '2022-04-11 11:12:41', 0, NULL, NULL, 1, 29);

-- --------------------------------------------------------

--
-- Table structure for table `userregister`
--

CREATE TABLE `userregister` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpassword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '1=active.0=deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `u_id` varchar(250) CHARACTER SET utf8mb4 DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.png',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `showpassword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` int(2) NOT NULL DEFAULT '0' COMMENT '1 = admin, 2 = seller, 3=buyer ',
  `is_auction` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `wallet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '2' COMMENT '1=active.0=delete,2=pending	',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `u_id`, `name`, `image`, `email`, `email_verified_at`, `is_admin`, `password`, `showpassword`, `remember_token`, `user_type`, `is_auction`, `is_active`, `wallet`, `status`, `created_at`, `updated_at`, `google_id`) VALUES
(1, NULL, 'Admin', 'user.jpg', 'r.majchrzak@icloud.com', '0000-00-00 00:00:00', 1, '$2y$10$mDLYLZ6aTIyLUECKq8ydMOrXpbqdQKvW.KRm6KN9ruFYagsWtDyOe', 'laraib123', '', 1, 0, 0, '0', 2, '2020-08-03 23:35:35', '2020-08-03 23:35:35', NULL),
(65, 'BUYEResrF2T', 'Radoslaw Majchrzak', 'user.png', 'general.krewet@gmail.com', NULL, 2, '$2y$10$sOhoRqcZChEEjt0FdWYKneRHXeDg7tvDMIv7bfDmaVHLxYwLfJmPG', 'Loda123', NULL, 3, 0, 0, '0', 0, '2022-04-02 00:00:00', NULL, NULL),
(66, 'SELLERMVPlf4', 'Laraib', 'user.png', 'kidwai.laraib987@gmail.com', NULL, 3, '$2y$10$fuWH6M6RRrkfiOeYfbMbc.HymwbHZqPlGcm8QrjMjCowUVwI/FBcS', 'admin', NULL, 2, 0, 0, '0', 1, '2022-04-02 00:00:00', NULL, NULL),
(67, 'SELLERbhv48j', 'Laraib', 'user.png', 'laraib.kidwai07@gmail.com', NULL, 3, '$2y$10$ptO2W9.es/qq1r5c12.YZunqixWY3RiUFcxUdG4/46EwGWW4SOK6S', 'admin123', NULL, 2, 0, 0, '1.6', 1, '2022-04-02 00:00:00', NULL, NULL),
(68, 'BUYERgQXMcL', 'Laraib', 'user.png', 'bajajshiny10@gmail.com', NULL, 2, '$2y$10$9AZcM6hCE6oDtrZpc8Ef3eUw8a09vKMSgD4H1IgJejIkevYC4lLH6', 'admin', NULL, 3, 0, 0, '12', 1, '2022-04-02 00:00:00', NULL, NULL),
(73, 'BUYERls2rhw', 'Dheeraj Saluja', 'user.png', 'djsaluja18@gmail.com', NULL, 2, '$2y$10$lTZQJZZouGcpEpBVgcseZum80jWo0mjT8hawHPCwLZM67FLxgayTe', 'Admin@123', NULL, 3, 0, 0, '4.8', 1, '2022-04-06 00:00:00', NULL, NULL),
(74, 'SELLERXupdJ4', 'Saluja Dheeraj', 'user.png', 'dheerajsaluja9@gmail.com', NULL, 3, '$2y$10$9Cm2qjbpF654L4GatVLrn.liLIYVHSpLImq/T1bS/i9zgMTNpGBg2', 'Admin@123', NULL, 2, 0, 0, '12.54', 1, '2022-04-06 00:00:00', NULL, NULL),
(87, 'BUYERWEOZ9t', 'Dheeraj Saluja', 'user.png', 'dheerajsaluja1990@gmail.com', NULL, 2, '$2y$10$Pg5FnbZ.7MqsESDTzqqa.ux.wHrucYP8xsNgJYtH9pulBGT.D5KUa', '1qaz1qaz', NULL, 3, 0, 0, '0', 1, '2022-04-14 00:00:00', NULL, NULL),
(88, 'SELLER6MEAwc', 'Radoslaw Majchrzak', 'user.png', 'rad@mkpsolution.co.uk', NULL, 3, '$2y$10$P2P91UyyjRmbaO31ByWwW.3QF3FKnNldyuK/Zx3mGr4CnADvTvU7O', 'Loda123', NULL, 2, 0, 0, '0', 1, '2022-04-16 00:00:00', NULL, NULL),
(89, 'BUYER08oMcs', 'Kristin Kruek', 'user.png', 'geogatedproject254@gmail.com', NULL, 2, '', NULL, NULL, 3, 0, 0, '0', 1, '2022-05-31 07:08:05', '2022-05-31 07:08:05', '41902205047410'),
(90, 'BUYERJom75d', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(91, 'CxxsyCUl', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(92, 'BUYERJom75d\' AND 2*3*8=6*8 AND \'V6K8\'=\'V6K8', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(93, 'BUYERJom75d\" AND 2*3*8=6*8 AND \"87ki\"=\"87ki', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(94, 'BUYERJom75d%\' AND 2*3*8=6*8 AND \'KXUS\'!=\'KXUS%', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(95, '-1 OR 2+360-360-1=0+0+0+1', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(96, '-1 OR 3+360-360-1=0+0+0+1', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(97, 'BUYERJom75d\'||\'', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(98, 'u3ZSHQUu', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(99, 'BUYERJom75d\' AND 2*3*8=6*8 AND \'hIiS\'=\'hIiS', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(100, 'BUYERJom75d\" AND 2*3*8=6*8 AND \"Ah2f\"=\"Ah2f', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(101, 'BUYERJom75d%\' AND 2*3*8=6*8 AND \'AP8u\'!=\'AP8u%', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(102, '-1 OR 2+387-387-1=0+0+0+1', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(103, '-1 OR 3+387-387-1=0+0+0+1', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(104, 'BUYERJom75d\'|||\'', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(105, 'BUYERJom75d\'||\'\'||\'', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(106, '1 PROCEDURE ANALYSE(EXTRACTVALUE(9859,CONCAT(0x5c,(BENCHMARK(110000000,MD5(0x7562756f))))),1)-- ', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(107, 'if(now()=sysdate(),sleep(15),0)', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(108, '0\'XOR(if(now()=sysdate(),sleep(15),0))XOR\'Z', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(109, '0\"XOR(if(now()=sysdate(),sleep(15),0))XOR\"Z', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(110, '(select(0)from(select(sleep(15)))v)/*\'+(select(0)from(select(sleep(15)))v)+\'\"+(select(0)from(select(sleep(15)))v)+\"*/', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(111, '1 waitfor delay \'0:0:15\' -- ', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(112, 'siOw77HI\'; waitfor delay \'0:0:15\' -- ', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(113, 'pmEVBcpZ\'; waitfor delay \'0:0:15\' -- ', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(114, 'h7E6AQOO\' OR 621=(SELECT 621 FROM PG_SLEEP(15))--', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(115, '6rpiUvGy\' OR 261=(SELECT 261 FROM PG_SLEEP(15))--', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(116, 'Jfd3kSqU\') OR 176=(SELECT 176 FROM PG_SLEEP(15))--', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(117, 'Gwte5uG5\') OR 346=(SELECT 346 FROM PG_SLEEP(15))--', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(118, '8EbaI1Wr\')) OR 837=(SELECT 837 FROM PG_SLEEP(15))--', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(119, 'SAXTmp5k\')) OR 978=(SELECT 978 FROM PG_SLEEP(15))--', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(120, 'BUYERJom75d\'||DBMS_PIPE.RECEIVE_MESSAGE(CHR(98)||CHR(98)||CHR(98),15)||\'', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(121, '1\'\"', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(122, '1\0', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(123, '@@10ur7', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(124, '@@rPRWv', 'GoaCDtTd', 'user.png', 'sample@email.tst', NULL, 2, '$2y$10$zUhwO6v/O9.UPTJ979OCPesSOdwyNsDCkjar6RlLDByG6MwiPK2JW', 'g00dPa$$w0rD', NULL, 3, 0, 0, '0', 1, '2022-06-29 00:00:00', NULL, NULL),
(125, 'SELLERac09iy', 'Radoslaw Majchrzak', 'user.png', 'info@mkpsolution.co.uk', NULL, 3, 'ca5eda060d801f311ebd39a2c7ea981e', 'laraib123', NULL, 0, 0, 0, '0', 1, '2022-07-15 00:00:00', NULL, NULL),
(126, 'SELLERhTsmH4', 'Aqilo', 'user.png', 'aqiloinfosolutions@gmail.com', NULL, 3, '$2y$10$Nt5kVOB1ydwRyKxVukd2.eqPHzZku.BFXvlWm2/bxJTlFgld2/dPK', 'admin123', NULL, 0, 0, 0, '0', 1, '2022-07-15 00:00:00', NULL, NULL),
(127, 'BUYERTbreg2', 'Rad Majchrzak', 'user.png', 'ledbltd@gmail.com', NULL, 2, '', NULL, NULL, 3, 0, 0, '0', 1, '2022-07-15 18:05:59', '2022-07-15 18:05:59', '112511954443788259014'),
(130, 'SELLEREit0pK', 'Dheeraj', 'user.png', 'terakharchaa@gmail.com', NULL, 3, '$2y$10$aWNHBzbiFIlQN/VTIAEqhOHHJLrrfM6TBBH3YYxTp9QnwwD5hymvW', 'Admin@123', NULL, 2, 0, 0, '0', 1, '2022-07-18 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_retailer`
--

CREATE TABLE `vendor_retailer` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmpass` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `storename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `storeslug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL COMMENT '1=vendor, 0=retailer',
  `adharcarimg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pancardimg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '2' COMMENT '1=active.0=delete,2=pending',
  `created_date` date DEFAULT NULL,
  `storedetail` text COLLATE utf8mb4_unicode_ci,
  `profile_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=unpaid,1=paid(set zero),'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `addeddate` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `addeddate`, `status`) VALUES
(1, '66', '8', '2022-04-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `withdrawl_request`
--

CREATE TABLE `withdrawl_request` (
  `id` int(11) NOT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_detail_id` int(11) DEFAULT NULL,
  `request_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `last_wallet_balance` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `req_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `balance_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_gateway_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_status` int(11) NOT NULL DEFAULT '0' COMMENT '1=>Approved,0=>Pending',
  `withdraw_transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pay_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `withdrawl_request`
--

INSERT INTO `withdrawl_request` (`id`, `product_id`, `order_detail_id`, `request_number`, `user_id`, `name`, `email`, `country`, `state`, `city`, `pincode`, `address`, `last_wallet_balance`, `req_amount`, `balance_amount`, `payment_gateway_type`, `payment_status`, `withdraw_transaction_id`, `pay_date`, `created_date`) VALUES
(1, '2,1', 4, 'EMPQcUfOy', 74, 'Saluja Dheeraj', 'dheerajsaluja9@gmail.com', 'India', 'Delhi', 'New Delhi', 'AL', 'Janak Puri', '400.2', '304.50', '95.7', 'Paypal', 1, '8783j', '2022-04-08 18:11:12', '2022-04-08 12:28:19'),
(2, '2', 1, 'EMPLEZYq8', 74, 'Saluja Dheeraj', 'dheerajsaluja9@gmail.com', 'India', 'Delhi', 'New Delhi', 'AL', 'Janak Puri', '95.7', '95.70', '0', 'Paypal', 1, '9884HFB7', '08-04-2022 12:46:24', '2022-04-08 12:45:02'),
(3, '1', 2, 'EMPSBGf7R', 74, 'Saluja Dheeraj', 'dheerajsaluja9@gmail.com', 'India', 'Delhi', 'New Delhi', 'AL', 'Janak Puri', '400.1', '104.40', '295.7', 'Paypal', 1, '88YHA28H', '11-04-2022 03:49:04', '2022-04-11 03:47:29'),
(4, '1', 39, 'EMPSTqYzZ', 74, 'Saluja Dheeraj', 'dheerajsaluja9@gmail.com', 'India', 'Delhi', 'New Delhi', 'AL', 'Janak Puri', '299.3', '1.80', '297.5', 'Paypal', 1, '88734JHGH', '11-04-2022 05:16:23', '2022-04-11 05:11:18'),
(5, '2', 24, 'EMPA4BtVM', 74, 'Saluja Dheeraj', 'dheerajsaluja9@gmail.com', 'India', 'Delhi', 'New Delhi', 'AL', 'Janak Puri', '101.04', '95.70', '5.34', 'Paypal', 1, '8989HTA989', '11-04-2022 06:26:15', '2022-04-11 06:16:43'),
(6, '2', 27, 'EMP0zjIf9', 74, 'Saluja Dheeraj', 'dheerajsaluja9@gmail.com', 'India', 'Delhi', 'New Delhi', 'AL', 'Janak Puri', '101.04', '95.70', '5.34', 'Paypal', 1, '77463AYZ', '11-04-2022 07:16:39', '2022-04-11 07:14:58'),
(7, '3', 28, 'EMPSeYlA2', 67, 'Laraib', 'laraib.kidwai07@gmail.com', 'UK', 'Torquay', 'Machester', 'TQ2', 'Street 123', '7.2', '1.80', '5.4', 'Paypal', 1, '87487EMP', '11-04-2022 08:09:12', '2022-04-11 07:24:13'),
(8, '3', 22, 'EMPZkjroU', 67, 'Laraib', 'laraib.kidwai07@gmail.com', 'London', 'Torquay', 'London', 'TQ2', 'tq2', '3.4', '1.80', '1.6', 'Stripe', 0, NULL, NULL, '2022-04-11 11:15:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional`
--
ALTER TABLE `additional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auctions`
--
ALTER TABLE `auctions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `biddings`
--
ALTER TABLE `biddings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_id` (`uid`);

--
-- Indexes for table `buyer_wallet_history`
--
ALTER TABLE `buyer_wallet_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashbacks`
--
ALTER TABLE `cashbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `featured_package`
--
ALTER TABLE `featured_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `most_viewed_product`
--
ALTER TABLE `most_viewed_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_content`
--
ALTER TABLE `page_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `payment_response`
--
ALTER TABLE `payment_response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postal_code`
--
ALTER TABLE `postal_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_like_dislike`
--
ALTER TABLE `review_like_dislike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_featured_subscription`
--
ALTER TABLE `seller_featured_subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_subscriptions`
--
ALTER TABLE `seller_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specifications`
--
ALTER TABLE `specifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribe_products`
--
ALTER TABLE `subscribe_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userregister`
--
ALTER TABLE `userregister`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_retailer`
--
ALTER TABLE `vendor_retailer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawl_request`
--
ALTER TABLE `withdrawl_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional`
--
ALTER TABLE `additional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `auctions`
--
ALTER TABLE `auctions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `biddings`
--
ALTER TABLE `biddings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- AUTO_INCREMENT for table `buyer_wallet_history`
--
ALTER TABLE `buyer_wallet_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `cashbacks`
--
ALTER TABLE `cashbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `featured_package`
--
ALTER TABLE `featured_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `most_viewed_product`
--
ALTER TABLE `most_viewed_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=680;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `page_content`
--
ALTER TABLE `page_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_response`
--
ALTER TABLE `payment_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `postal_code`
--
ALTER TABLE `postal_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `review_like_dislike`
--
ALTER TABLE `review_like_dislike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `seller_featured_subscription`
--
ALTER TABLE `seller_featured_subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seller_subscriptions`
--
ALTER TABLE `seller_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `specifications`
--
ALTER TABLE `specifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `subscribe_products`
--
ALTER TABLE `subscribe_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `userregister`
--
ALTER TABLE `userregister`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `vendor_retailer`
--
ALTER TABLE `vendor_retailer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `withdrawl_request`
--
ALTER TABLE `withdrawl_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
