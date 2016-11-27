-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 27, 2016 at 10:48 PM
-- Server version: 5.6.33-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `bo_mon`
--

CREATE TABLE IF NOT EXISTS `bo_mon` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `ten_mon` varchar(255) NOT NULL,
  `mota` text,
  `khoa_id` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `phone` varchar(64) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `phone`, `email`, `address`) VALUES
(5, 'Toan', '0914390567', 'toanktv.it@gmail.com', 'abc ddddfdfdf'),
(12, 'sang', '01674659025', 'sangtk4@gmail.com', 'ngox 122 yen hoa'),
(13, 'nam', '01675689023', 'hi@gmail.com', 'ngo 122');

-- --------------------------------------------------------

--
-- Table structure for table `giang_vien`
--

CREATE TABLE IF NOT EXISTS `giang_vien` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `ma_giang_vien` varchar(255) NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `khoa_id` int(6) DEFAULT NULL,
  `bo_mon_id` int(6) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `giang_vien`
--

INSERT INTO `giang_vien` (`id`, `ma_giang_vien`, `ho_ten`, `khoa_id`, `bo_mon_id`, `user_id`) VALUES
(9, '1234', 'toan', 1, 1, 23),
(10, '4433', 'huy', 2, 2, 24),
(11, '4342222', 'giang', 3, 3, 25),
(12, '1234', 'toan', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE IF NOT EXISTS `khoa` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `ten_khoa` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `khoa`
--

INSERT INTO `khoa` (`id`, `ten_khoa`) VALUES
(2, 'Công nghệ Thông tin'),
(3, 'Tin học'),
(4, 'Toán học'),
(5, '1212'),
(6, 'z vf'),
(7, 'dsd sdsd'),
(9, 'er dfdf');

-- --------------------------------------------------------

--
-- Table structure for table `nguoi_dung`
--

CREATE TABLE IF NOT EXISTS `nguoi_dung` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `thong_tin_khac` text,
  `status` int(1) NOT NULL,
  `user_type` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`id`, `email`, `password`, `thong_tin_khac`, `status`, `user_type`) VALUES
(2, 'root@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'asa', 1, 3),
(23, 'toankt@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 0, 2),
(24, 'judf@gmial.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 0, 2),
(25, 'hgn@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_verified`
--

CREATE TABLE IF NOT EXISTS `user_verified` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `active` int(1) NOT NULL,
  `hash` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_verified`
--

INSERT INTO `user_verified` (`id`, `email`, `active`, `hash`, `created_at`) VALUES
(1, 'rootddd@gmail.com', 0, 'afd7c8d1231e5cf3d1e289210ef6b7b8', '2016-11-27 11:11:52'),
(2, 'adcskt@gmail.com', 0, 'bf06621483820745faf396526eb3bb09', '2016-11-27 11:19:37'),
(3, 'toankt@gmail.com', 0, '1418cffa589dcb5b4ec92929071939da', '2016-11-27 17:53:44');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
