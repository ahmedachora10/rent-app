-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 11, 2022 at 04:27 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rent`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_name` varchar(100) NOT NULL,
  `device_company` varchar(100) NOT NULL,
  `device_desc` varchar(300) NOT NULL,
  `device_type` varchar(100) NOT NULL,
  `PricePerHour` varchar(100) NOT NULL,
  `PricePerDay` varchar(100) NOT NULL,
  `PricePerWeek` varchar(100) NOT NULL,
  `PricePerMonth` varchar(100) NOT NULL,
  `dimage` varchar(100) NOT NULL,
  `front_image` varchar(50) NOT NULL,
  `behind_image` varchar(50) NOT NULL,
  `device_owner` varchar(100) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `block_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `device_name`, `device_company`, `device_desc`, `device_type`, `PricePerHour`, `PricePerDay`, `PricePerWeek`, `PricePerMonth`, `dimage`, `front_image`, `behind_image`, `device_owner`, `owner_id`, `block_status`) VALUES
(1, 'playstation 5', 'سوني', 'جهاز مصمم خصيصا لالعاب الفيديو', 'games', '15', '150', '500', '1000', 'ps5.png', 'ps5.png', 'ps5.png', 'ammar', 0, 1),
(2, 'كاميرا كانون', 'كانون', 'كاميرا لالتقاط الصور وتسجيل الفيديوهات بجودة عالية', 'electronics', '40', '200', '600', '1200', 'camera.png', 'camera.png', 'camera.png', 'ammar', 0, 1),
(3, 'msi prestige 15', 'ام اس آي', 'حاسوب محمول بمواصفات خارقة', 'computer', '30', '200', '700', '1400', 'msi.png', 'msi.png', 'msi.png', 'nabeel', 0, 1),
(4, 'ثلاجة سامسومج الذكية', 'سامسومج', 'ثلاجة سامسومج الذكية تعمل باللمس متصلة بالانترنت', 'tools', '50', '250', '800', '1600', 'fridge.jpg', 'fridge.jpg', 'fridge.jpg', 'sami', 0, 0),
(6, 'آيفون 14 برو ماكس', 'ابل', 'هاتف ذكي', 'computer', '10', '100', '250', '500', 'i 14.jpg', 'i 14.jpg', 'i 14.jpg', 'ammar', 0, 0),
(8, 'جالكسي اس 22 الترا', 'سامسونج', 'samsung', 'computer', '20', '100', '20', '100', 's22.jpg', 's22b.jpg', 's22a.jpg', 'nabeel', 0, 1),
(11, 'xbox 360', 'xbox', 'العاب فيديو', 'games', '30', '100', '30', '100', 'Xbox360.png', 'xbox1.jpg', 'xbox2.jpg', 'sami', 0, 1),
(13, 'شاشة  سامسونج الذكية', 'سامسونج', 'شاشة عرض من شركة سامسونج تعمل بنظام الاندرويد', 'electronics', '50', '200', '50', '200', 'screen2.jpg', 'screen1.jpg', 'screen1.jpg', 'nabeel', 0, 1),
(17, 'كاميرا درون', 'سوني', 'كاميرا تصوير طائرة', 'electronics', '100', '400', '100', '400', 'camera2.jpg', 'camera3.jpg', 'camera5.jpg', 'aisha', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

DROP TABLE IF EXISTS `review_table`;
CREATE TABLE IF NOT EXISTS `review_table` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_rating` int(11) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` int(11) NOT NULL,
  PRIMARY KEY (`review_id`),
  KEY `device_id` (`device_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review_table`
--

INSERT INTO `review_table` (`review_id`, `device_id`, `user_name`, `user_id`, `user_rating`, `user_review`, `datetime`) VALUES
(1, 3, 'hoda@gmail.com', 0, 2, 'جيد نوعا ما', 1666781582),
(2, 3, 'hoda@gmail.com', 0, 4, 'رائع', 1666781632),
(3, 4, 'hoda@gmail.com', 0, 3, 'good', 1666793894),
(4, 1, 'hoda@gmail.com', 0, 5, 'احببت هذا الجهاز', 1666798520),
(5, 1, 'azhar@gmail.com', 0, 3, 'لا باس بالتجربة', 1666798605),
(6, 13, 'azhar@gmail.com', 21, 3, 'جيد', 1668180992),
(7, 13, 'azhar@gmail.com', 21, 3, 'جيد', 1668181142);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

DROP TABLE IF EXISTS `tbladmin`;
CREATE TABLE IF NOT EXISTS `tbladmin` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `AdminName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `UserName` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `FirstName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `LastName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `Status` int(11) NOT NULL,
  `Photo` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'avatar15.jpg',
  `Password` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `FirstName`, `LastName`, `MobileNumber`, `Email`, `Status`, `Photo`, `Password`, `AdminRegdate`) VALUES
(2, 'Admin', 'admin', 'علي', 'الشمراني', 50546590, 'admin@gmail.com', 1, 'avatar15.jpg', '21232f297a57a5a743894a0e4a801fc3', '2021-06-21 10:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

DROP TABLE IF EXISTS `tblbooking`;
CREATE TABLE IF NOT EXISTS `tblbooking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_name` varchar(100) NOT NULL,
  `device_id` int(11) NOT NULL,
  `booking_date` varchar(30) NOT NULL,
  `booking_type` varchar(50) NOT NULL,
  `booking_duration` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `device_owner` varchar(50) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  KEY `user_id` (`user_id`),
  KEY `device_id` (`device_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`id`, `device_name`, `device_id`, `booking_date`, `booking_type`, `booking_duration`, `total`, `username`, `user_id`, `device_owner`, `owner_id`, `status`, `payment_status`) VALUES
(1, 'msi prestige 15', 0, '2022-09-28', 'hour', '2', '60', 'hoda@gmail.com', 0, 'nabeel', 0, 1, 0),
(2, 'آيفون 14 برو ماكس', 0, '2022-10-28', 'day', '2', '200', 'hoda@gmail.com', 0, 'ammar', 0, 1, 0),
(3, 'msi prestige 15', 0, '2022-09-28', 'hour', '1', '30', 'hoda@gmail.com', 0, 'nabeel', 0, 1, 0),
(4, 'msi prestige 15', 0, '2022-09-28', 'hour', '3', '90', 'hoda@gmail.com', 0, 'nabeel', 0, 1, 0),
(6, 'playstation 5', 0, '2022-09-30', 'day', '2', '300', 'hoda@gmail.com', 0, 'ammar', 0, 1, 0),
(37, 'آيفون 14 برو ماكس', 0, '2022-10-28', 'hour', '2', '20', 'azhar@gmail.com', 0, 'ammar', 0, 1, 1),
(28, 'xbox 360', 0, '2022-10-12', 'hour', '2', '60', 'mohammed@gmail.com', 0, 'sami', 0, 0, 0),
(10, 'playstation 5', 0, '2022-10-10', 'hour', '2', '30', 'hoda@gmail.com', 0, 'ammar', 0, 1, 0),
(31, 'كاميرا كانون', 0, '2022-10-17', 'hour', '2', '80', 'hoda@gmail.com', 0, 'ammar', 0, 1, 0),
(39, 'شاشة  سامسونج الذكية', 0, '2022-11-04', 'day', '1', '200', 'azhar@gmail.com', 0, 'nabeel', 0, 1, 1),
(38, 'xbox 360', 0, '2022-10-25', 'hour', '1', '30', 'azhar@gmail.com', 0, 'sami', 0, 0, 0),
(12, 'xbox 360', 0, '2022-10-11', 'day', '3', '300', 'hoda@gmail.com', 0, 'sami', 0, 1, 1),
(35, 'كاميرا درون', 0, '2022-10-26', 'hour', '3', '300', 'abdullah@gmail.com', 0, 'aisha', 0, 1, 0),
(34, 'كاميرا درون', 0, '2022-10-21', 'day', '4', '1600', 'naji@gmail.com', 0, 'aisha', 0, 1, 0),
(41, 'كاميرا درون', 0, '2022-11-03', 'hour', '6', '600', 'hoda@gmail.com', 0, 'aisha', 0, 1, 1),
(42, 'xbox 360', 11, '2022-12-03', 'hour', '1', '30', 'hoda@gmail.com', 5, 'sami', 9, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblmessage`
--

DROP TABLE IF EXISTS `tblmessage`;
CREATE TABLE IF NOT EXISTS `tblmessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblmessage`
--

INSERT INTO `tblmessage` (`id`, `username`, `email`, `subject`, `message`) VALUES
(1, 'سعيد الشهري', 'saeed77@gmail.com', 'عن الموقع', 'موقع رائع'),
(2, 'ش', 'azhar@gmail.com', 'q', 'q'),
(3, 'hoda', 'hoda@gmail.com', 'ض', 'ض');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

DROP TABLE IF EXISTS `tblpayment`;
CREATE TABLE IF NOT EXISTS `tblpayment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `card_number` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpayment`
--

INSERT INTO `tblpayment` (`id`, `booking_id`, `card_number`, `username`, `user_id`, `amount`) VALUES
(1, 5, '543231', 'hoda@gmail.com', 0, '60'),
(2, 6, '543231', 'hoda@gmail.com', 0, '300'),
(3, 8, '543231', 'hoda@gmail.com', 0, '500'),
(4, 9, '543231', 'hoda@gmail.com', 0, '1400'),
(5, 37, '676654', 'azhar@gmail.com', 0, '20'),
(6, 37, '000999', 'azhar@gmail.com', 0, '20'),
(7, 39, '4567', 'azhar@gmail.com', 0, '200'),
(8, 41, '111222', 'hoda@gmail.com', 0, '600'),
(9, 12, '456', 'hoda@gmail.com', 5, '300');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

DROP TABLE IF EXISTS `tblusers`;
CREATE TABLE IF NOT EXISTS `tblusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) CHARACTER SET utf8 NOT NULL,
  `FullName` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `EmailId` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Password` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `ContactNo` char(11) CHARACTER SET utf8 DEFAULT NULL,
  `Address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `City` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Country` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `EmailId` (`EmailId`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `type`, `FullName`, `EmailId`, `Password`, `ContactNo`, `Address`, `City`, `Country`, `RegDate`) VALUES
(5, 'User', 'hoda sami', 'hoda@gmail.com', '202cb962ac59075b964b07152d234b70', '66556655', 'alzahra', 'jeddah', 'KSA', '2022-09-14 20:37:12'),
(7, 'top_user', 'ammar', 'ammar@gmail.com', 'fed5de04cbba88aae4fa4b1d370dde5c', '50123456', 'alnozha ', 'jeddah', 'ksa', '2022-10-05 21:00:00'),
(8, 'top_user', 'nabeel', 'nabeel@gmail.com', '6127c94780277fa64acb99d9e97e0f87', '56565656', 'alnozha 11', 'jeddah', 'ksa', '2022-10-05 21:00:00'),
(9, 'top_user', 'sami', 'sami@gmail.com', '4f8de24d6093ac5d25c7cfafc474d49f', '787878', 'alnozha ', 'jeddah', 'ksa', '2022-10-06 21:00:00'),
(10, 'top_user', 'saeed', 'saeed@gmail.com', '849e060f05808577361b084ba1e3eca7', '11111111', 'alnozha ', 'jeddah', 'ksa', '2022-10-09 21:00:00'),
(11, 'user', 'ali ali', 'ali@gmail.com', '86318e52f5ed4801abe1d13d509443de', '56776543', 'alnozha ', 'jeddah', 'ksa', '2022-10-09 21:00:00'),
(12, 'User', 'hadi', 'hadi@gmail.com', '76671d4b83f6e6f953ea2dfb75ded921', '22222222', 'alnozha 1', 'jeddah', 'ksa', '2022-10-10 21:00:00'),
(16, 'User', 'mohammed', 'mohammed@gmail.com', 'b3cd915d758008bd19d0f2428fbb354a', '787878', 'altahlia', 'jeddah', 'ksa', '2022-10-10 21:00:00'),
(17, 'User', 'hoda ali', 'hoda20@gmail.com', '6efa240fc47e3f882ae16d163ca26f91', '78787800', 'حي النزهة ', 'جدة', 'المملكة العربية السعودية', '2022-10-10 21:00:00'),
(18, 'user', 'naji', 'naji@gmail.com', '9188e827334b45d272682bb7503a8cf6', '656565', 'النزهة', 'جدة', 'السعودية', '2022-10-10 21:00:00'),
(19, 'top_user', 'aisha', 'aisha@gmail.com', 'a381bedb5d4478053eb04be35f8798dd', '056567876', 'حي السلامة', 'جدة', 'المملكة العربية السعودية', '2022-10-11 21:00:00'),
(20, 'user', 'abdullah', 'abdullah@gmail.com', '202cb962ac59075b964b07152d234b70', '056456789', 'حي النزهة ', 'جدة', 'السعودية', '2022-10-12 21:00:00'),
(21, 'user', 'Azhar', 'azhar@gmail.com', '202cb962ac59075b964b07152d234b70', '055645543', 'حي السلامة', 'جدة', 'السعودية', '2022-10-15 21:00:00'),
(23, 'user', 'ahmed', 'ahmed@gmail.com', '099b3b060154898840f0ebdfb46ec78f', '056545565', 'النزهة', 'جدة', 'المملكة العربية السعودية', '2022-10-18 21:00:00'),
(25, 'user', 'moath', 'moath@gmail.com', '099b3b060154898840f0ebdfb46ec78f', '056543212', 'النزهة', 'جدة', 'المملكة العربية السعودية', '2022-10-18 21:00:00'),
(26, 'user', 'shatha', 'shatha@gmail.com', '099b3b060154898840f0ebdfb46ec78f', '056456543', 'النزهة', 'جدة', 'المملكة العربية السعودية', '2022-10-18 21:00:00'),
(27, 'user', 'rami', 'rami@gmail.com', 'af1d0e0e7f16db33ed433e19e23a2aa1', '056789009', 'النزهة', 'جدة', 'المملكة العربية السعودية', '2022-10-18 21:00:00'),
(28, 'user', 'arwa', 'arwa@gmail.com', 'da8507ef1229b987bb46a0ac47319f52', '055456654', 'حي النزهة ', 'جدة', 'السعودية', '2022-10-18 21:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
