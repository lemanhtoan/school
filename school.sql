-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2016 at 11:26 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bo_mon`
--

INSERT INTO `bo_mon` (`id`, `ten_mon`, `mota`, `khoa_id`) VALUES
(1, 'Bộ môn', 'Bộ môn 1 - Khoa công nghệ thông tin', 3),
(2, 'Bộ môn 1', 'at', 4),
(3, 'Bộ môn 2', 'tu', 2);

-- --------------------------------------------------------

--
-- Table structure for table `chuong_trinh_hoc`
--

CREATE TABLE IF NOT EXISTS `chuong_trinh_hoc` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `ten_chuong_trinh` varchar(255) NOT NULL,
  `khoa_hoc_id` varchar(255) NOT NULL,
  `ghi_chu` varchar(255) DEFAULT NULL,
  `total_time` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `chuong_trinh_hoc`
--

INSERT INTO `chuong_trinh_hoc` (`id`, `ten_chuong_trinh`, `khoa_hoc_id`, `ghi_chu`, `total_time`) VALUES
(1, 'Chương trình 1', '7', 'note content 1', 1),
(2, 'Chương trình 2', '6', 'Content content', 2),
(5, 'Chương trình 3', '8', 'Note', 1);

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
-- Table structure for table `de_tai`
--

CREATE TABLE IF NOT EXISTS `de_tai` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `ten_dt` varchar(255) NOT NULL,
  `mota` text,
  `khoahoc_id` int(6) DEFAULT NULL,
  `khoa_id` int(6) DEFAULT NULL,
  `sinhvien_id` int(6) DEFAULT NULL,
  `giangvien_id` int(6) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `de_tai`
--

INSERT INTO `de_tai` (`id`, `ten_dt`, `mota`, `khoahoc_id`, `khoa_id`, `sinhvien_id`, `giangvien_id`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Đề tài 1', 'mo tả đề tài 1 1', 6, 2, 5, 4, '2016-12-07', '2016-12-07', 1),
(2, 'Đề tài 2', 'anc', 7, 3, 6, 6, '2016-12-07', '2016-12-07', 1),
(3, 'Đề tài 3', 'nc', 8, 5, 5, 2, '2016-12-07', '2016-12-07', 1),
(4, 'Đề tài 4', 'bc', 7, 3, 7, 2, '2016-12-07', '2016-12-07', 1);

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
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `giang_vien`
--

INSERT INTO `giang_vien` (`id`, `ma_giang_vien`, `ho_ten`, `khoa_id`, `bo_mon_id`, `email`) VALUES
(1, '12344', 'toan le', 2, 3, 'toankt@gmail.com'),
(2, '4433', 'huy', 2, 2, 'judf@gmial.com'),
(3, '4342222', 'giang', 3, 3, 'hgn@gmail.com'),
(4, 'toan123', 'vuquang', 2, 3, 'lopa3k6vuquang@gmail.com'),
(5, 'wew', 'ds', 3, 23, 'ds@gmail.com'),
(6, '1234422', 'le manh toan', 3, 2, 'root123@gmail.com');

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
-- Table structure for table `khoa_hoc`
--

CREATE TABLE IF NOT EXISTS `khoa_hoc` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `ma_khoa_hoc` varchar(255) NOT NULL,
  `ten_khoa_hoc` varchar(255) NOT NULL,
  `khoa_id` int(6) DEFAULT NULL,
  `ghi_chu` varchar(255) DEFAULT NULL,
  `time_start` date DEFAULT NULL,
  `time_end` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `khoa_hoc`
--

INSERT INTO `khoa_hoc` (`id`, `ma_khoa_hoc`, `ten_khoa_hoc`, `khoa_id`, `ghi_chu`, `time_start`, `time_end`) VALUES
(6, 'KH002', 'Đạo tạo ngắn hạn kế toán', 3, 'Khóa ngắn hạn kế toán', '2012-12-06', '2013-12-30'),
(7, 'KH003', 'kế toán', 3, 'kế toán', '2016-11-13', '2017-10-20'),
(8, 'KH001', 'CNTT', 4, 'CNTT', '2016-12-06', '2016-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `nguoi_dung`
--

CREATE TABLE IF NOT EXISTS `nguoi_dung` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `thong_tin_khac` text,
  `status` int(1) DEFAULT NULL,
  `user_type` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`id`, `email`, `password`, `thong_tin_khac`, `status`, `user_type`) VALUES
(1, 'toankt@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 0, 2),
(2, 'judf@gmial.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 0, 2),
(3, 'hgn@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 0, 2),
(4, 'lopa3k6vuquang@gmail.com', '670b14728ad9902aecba32e22fa4f6bd', NULL, 1, 2),
(5, 'ds@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 0, 2),
(6, 'toankt12@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 0, 4),
(7, 'judf333@gmial.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 0, 4),
(8, 'hgn3434@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 0, 4),
(9, '2323lopa3k6vuquang@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 0, 4),
(10, '545ds@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sinh_vien`
--

CREATE TABLE IF NOT EXISTS `sinh_vien` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `ma_sinh_vien` varchar(255) NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `khoa_hoc_id` int(6) DEFAULT NULL,
  `chuong_trinh_id` int(6) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sinh_vien`
--

INSERT INTO `sinh_vien` (`id`, `ma_sinh_vien`, `ho_ten`, `khoa_hoc_id`, `chuong_trinh_id`, `email`) VALUES
(1, '12', 'bnbnbn', 2, 1, 'toankt12@gmail.com'),
(2, '3434', 'vbvbv', 4, 4, 'judf333@gmial.com'),
(3, '555', 'vvcv', 5, 3, 'hgn3434@gmail.com'),
(4, '545', 'fdfdf', 5, 2, '2323lopa3k6vuquang@gmail.com'),
(5, '76767', 'erer', 4, 5, '545ds@gmail.com'),
(6, 'sd222d', 'dd sdsdd sd', 7, 1, 'rootsss@gmail.com'),
(7, 'sd222er', 'rererr', 6, 1, 'erere@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_verified`
--

CREATE TABLE IF NOT EXISTS `user_verified` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `active` int(1) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user_verified`
--

INSERT INTO `user_verified` (`id`, `email`, `hash`, `active`, `created_at`) VALUES
(1, 'toankt@gmail.com', '7685b2b4a8ca3e5dc4cf20480a306544', 0, '2016-11-29'),
(2, 'judf@gmial.com', '83fb91b5be8d8e28e004e221da402a03', 0, '2016-11-29'),
(3, 'hgn@gmail.com', '4c8274b79c74c7227986b7062f426d89', 0, '2016-11-29'),
(4, 'lopa3k6vuquang@gmail.com', '357875b0281fdab7e5ddf0d8225741aa', 0, '2016-11-29'),
(5, 'ds@gmail.com', 'f65f40e22f3ec95343f69948f67ad7d0', 0, '2016-11-29'),
(6, 'toankt12@gmail.com', 'a10d3da04237cd581a9949cb3ff04f0b', 0, '2016-11-29'),
(7, 'judf333@gmial.com', 'fbd04c3181ada388e7a7c907dd43916a', 0, '2016-11-29'),
(8, 'hgn3434@gmail.com', '3e0f5acadb1bb832e910d8c4c13a2c85', 0, '2016-11-29'),
(9, '2323lopa3k6vuquang@gmail.com', 'dff6f8d76b047f0984657d9d9fd59c94', 0, '2016-11-29'),
(10, '545ds@gmail.com', 'ddcc0a3368914ec3536d5413b04d311f', 0, '2016-11-29');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
