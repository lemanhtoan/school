-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 15, 2016 at 01:38 PM
-- Server version: 5.6.31-0ubuntu0.14.04.2
-- PHP Version: 5.6.23-1+deprecated+dontuse+deb.sury.org~trusty+1

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
(1, 'Bộ môn Toán Tin', 'Bộ môn 1 - Khoa công nghệ thông tin', 3),
(2, 'Bộ môn Tin học', 'Bộ môn Tin học', 4),
(3, 'Bộ môn Kế Toán', 'Bộ môn thuộc khoa Kế Toán', 2);

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
(1, 'Chương trình 1', '7', 'Chương trình học 1 - ghi chú thêm', 1),
(2, 'Chương trình 2', '6', 'Chương trình học 2 - ghi chú thêm', 2),
(5, 'Chương trình 3', '8', 'Chương trình học 3 - ghi chú thêm', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `de_tai`
--

INSERT INTO `de_tai` (`id`, `ten_dt`, `mota`, `khoahoc_id`, `khoa_id`, `sinhvien_id`, `giangvien_id`, `created_at`, `updated_at`, `status`) VALUES
(6, 'fdfd', 'ererer', 6, 3, NULL, 11, '2016-12-15', '2016-12-15', 1),
(7, 'sdfsdf', 'sdfsdf', 6, 3, 13, 12, '2016-12-15', '2016-12-15', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `giang_vien`
--

INSERT INTO `giang_vien` (`id`, `ma_giang_vien`, `ho_ten`, `khoa_id`, `bo_mon_id`, `email`) VALUES
(11, 'gv001', 'Blue e', 2, 1, 'blue@gmail.com'),
(12, 'gv002', 'han hh', 3, 3, 'dhf@gmail.com'),
(13, 'gv004', 'adsd', 5, 3, 'hoahoctro@gmail.com');

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
(3, 'Sư Phạm'),
(4, 'Toán học'),
(5, 'Kế Toán'),
(6, 'Kinh Tế'),
(7, 'Đại Cương'),
(9, 'Pháp Luật');

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
(7, 'KH003', 'Kế Toán', 3, 'Kế Toán', '2016-11-13', '2017-10-20'),
(8, 'KH001', 'Công nghệ Thông tin', 4, 'Công nghệ Thông tin', '2016-12-06', '2016-11-26');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`id`, `email`, `password`, `thong_tin_khac`, `status`, `user_type`) VALUES
(1, 'khoa@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'other', 1, 2),
(12, 'nhatruong@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'other', 1, 1),
(13, 'cao@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 1, 4),
(14, 'dhf@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 1, 3),
(15, 'hoahoctro@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'dfdfdf', 0, 3),
(16, 'root@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'dfdfdf', 0, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `sinh_vien`
--

INSERT INTO `sinh_vien` (`id`, `ma_sinh_vien`, `ho_ten`, `khoa_hoc_id`, `chuong_trinh_id`, `email`) VALUES
(12, 'sv001', 'Nguyễn Quốc Anh', 6, 1, 'quocanh@gmail.com'),
(13, 'sv002', 'Cao A', 7, 2, 'cao@gmail.com'),
(14, 'cv0012', '32323 dfdf', 7, 2, 'root@gmail.com');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user_verified`
--

INSERT INTO `user_verified` (`id`, `email`, `hash`, `active`, `created_at`) VALUES
(1, 'toanktv@gmail.com', '7685b2b4a8ca3e5dc4cf20480a306544', 0, '2016-11-29'),
(2, 'huysv@gmail.com', '83fb91b5be8d8e28e004e221da402a03', 0, '2016-11-29'),
(3, 'toanktvsv@gmail.com', '837ef5c7b26377d6d4ee21928965316a', 0, '2016-12-09'),
(4, 'vietktvsv@gmail.com', 'fae3cd6c5bfbce2de5adda4b66cf02c9', 0, '2016-12-09'),
(5, 'oanhktvsv@gmail.com', '7553a39abca5c79a2ee1d6780cf29940', 0, '2016-12-09'),
(6, 'tienktvsv@gmail.com', 'ae8c43d2f24e712c2a53f989704c501e', 0, '2016-12-09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
