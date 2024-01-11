-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2023 at 02:22 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `websitest3`
--

-- --------------------------------------------------------

--
-- Table structure for table `tin_tuc`
--

CREATE TABLE `tin_tuc` (
  `id` int(11) NOT NULL,
  `tieu_de` varchar(255) NOT NULL,
  `noi_dung` text NOT NULL,
  `ngay_dang` date NOT NULL,
  `hang_san_xuat` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `mo_ta` text DEFAULT NULL,
  `gia` decimal(10,2) DEFAULT NULL,
  `ngay_ra_mat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tin_tuc`
--

INSERT INTO `tin_tuc` (`id`, `tieu_de`, `noi_dung`, `ngay_dang`, `hang_san_xuat`, `model`, `mo_ta`, `gia`, `ngay_ra_mat`) VALUES
(0, 'Hiệu năng mạnh mẽ của OPPO Reno11 lộ diện qua điểm Geekbench trước thềm ra mắt', 'OPPO đang chuẩn bị cho ra mắt dòng điện thoại OPPO Reno11 và tablet Pad Air 2 vào tuần tới. Trước sự kiện ra mắt, Reno11 đã xuất hiện trên nền tảng đánh giá Geekbench. Thiết bị này cũng gần đây được phát hiện trên trang web chứng nhận Bluetooth SIG, tiết lộ nhiều thông tin quan trọng về cấu hình.\r\nTheo đó, OPPO Reno11 có mã model PJH110. Sản phẩm có bo mạch được đặt tên mã k6895v1_64 bao gồm bốn nhân 2 GHz, ba nhân 3 GHz và một nhân chính chạy ở tốc độ 3.10 GHz. Thiết lập này tương ứng với vi xử lý MediaTek Dimensity 8200 đã được xác nhận trước đó. Nguồn tin cũng tiết lộ 12 GB RAM và hệ điều hành Android 14 được cài sẵn.', '2023-11-18', 'OPPO', 'OPPO Reno11', 'Hiệu năng mạnh mẽ của OPPO Reno11 lộ diện qua điểm Geekbench trước thềm ra mắt', 123.00, '2023-12-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tin_tuc`
--
ALTER TABLE `tin_tuc`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
