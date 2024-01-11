-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2023 at 10:10 PM
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
-- Database: `webthoitrang`
--

-- --------------------------------------------------------

--
-- Table structure for table `adproduct`
--

CREATE TABLE `adproduct` (
  `ma_loaisp` varchar(30) NOT NULL,
  `ma_sp` varchar(50) NOT NULL,
  `tensp` varchar(100) NOT NULL,
  `hinhanh` varchar(100) NOT NULL,
  `gianhap` int(20) NOT NULL,
  `giaxuat` int(20) NOT NULL,
  `khuyenmai` int(10) NOT NULL,
  `soluong` int(10) NOT NULL,
  `mota_sp` varchar(500) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adproduct`
--

INSERT INTO `adproduct` (`ma_loaisp`, `ma_sp`, `tensp`, `hinhanh`, `gianhap`, `giaxuat`, `khuyenmai`, `soluong`, `mota_sp`, `create_date`) VALUES
('	Quần bông', 'QB1', 'Quần bông cho bé trai & bé gái Từ 3kg đến 16kg', 'quần.jpg', 40000, 33000, 9000, 10, '     THÔNG TIN SẢN PHẨM- Tên sản phẩm: quần nỉ bông- Độ tuổi: từ 0 đến 4 tuổi (cân nặng từ 3-16Kg) . - Phù hợp: Cho bé trai, bé gái mặc ở nhà, đi chơi, sinh hoạt ngoài trời… - Chất liệu: Quần nỉ bông sản xuất từ vải 100% cotton mềm mại, co giãn 4 chiều, thấm hút mồ hôi tốt. Chất vải cotton cao cấp còn được ưa chuộng bởi độ bền dài lâu, không bị xù lông, an toàn và không gây ngứa ngáy cho bé.- Quần nỉ bông trẻ em có đường may tỉ mỉ, bền đẹp: Từng đường viền may được thực hiện tỉ mỉ và t', '2023-12-24'),
('	Quần bông', 'QB2', 'Quần bông siêu ấm siêu đẹp cho bé trai/gái', 'quần bông2.jpg', 50000, 80000, 70000, 10, '     Quần chục nỉ bông cho bé đã về hàng. Không khí lạnh tràn về, mẹ đã chuẩn bị đầy đủ cho bé chưa? Chất nỉ lông nhà em rất dày dặn và ấm áp, màu sắc siêu cute. Mẹ nào đã mua qua bộ nỉ bông nhà em thì đều biết rồi ạ_x000D_Số 1: 3-5kg dài 39 cm_x000D_Số 2: 5-7kg dài 40 cm_x000D_Số 3: 7-9kg dài 41 cm_x000D_số 4: 9-10kg dài 42 cm_x000D_ Số 5:10-12 kg dài 44 cm_x000D_Phom quần nhà em dài rộng nha các mom_x000D_Màu sắc giao ngẫu nhiên theo phân loại trai / gái ạ_x000D_Giá bán lẻ của ', '2023-12-23'),
('	Quần bông', 'QB3', 'Quần bông nhung tăm dáng jogger, quần dài cho bé gái diện tết đi học đi chơi thoải mái vận động 10-2', 'quan bông 3.jpg', 60000, 40000, 25000, 10, '   Quần nhung tăm dáng jogger cho bé gái 8 -25kgChất liệu: Nhung tăm mềm đẹp cho bé diện thu đông xinh dễ thương  Mẫu Họa tiếtTên tổ chức chịu trách nhiệm sản xuất Đang cập nhậtĐộ tuổi khuyến nghị LớnXuất xứ Việt NamĐịa chỉ tổ chức chịu trách nhiệm sản xuất Đang cập nhậtKiểu đóng gói ĐơnChất liệu nhung tămKho hàng 10Gửi từ Hà Nội', '2023-12-19'),
('Áo lông vũ', 'ALV1', 'Áo lông vũ khoác lông cừu, áo phao trẻ em, áo khoác lót lông cừu bên trong giữ ấm cho bé trai, bé gá', '1b0c9fa256d44aa1488fdfb88aa35adc.jpg', 70000, 90000, 80000, 10, '     Áo khoác siêu nhẹ dành cho bé trai / bé gái💯 CHUYÊN QUẦN ÁO TRẺ EM CHẤT LƯỢNG CAO🌟 CAM KẾT CHẤT LƯỢNG TỐT, SẢN PHẨM GIỐNG HÌNH 😍Hàng xuất khẩu đảm bảo yêu cầu chất lượng khắt khe❤️ Hình in sắc nét không dão không bong khi giặt🌺Mềm Mịn - Thoáng Mát - Thoải Mái👉 Cam kết chất lượng và mẫu mã sản phẩm giống với hình ảnh.👉 Hoàn tiền nếu sản phẩm không giống với mô tả.------------------------------------------------------------------👕Các Mom bấm vào bảng quy đổ', '2023-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `adproducttype`
--

CREATE TABLE `adproducttype` (
  `ma_loaisp` varchar(50) NOT NULL,
  `ten_loaisp` varchar(100) NOT NULL,
  `mota_loaisp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adproducttype`
--

INSERT INTO `adproducttype` (`ma_loaisp`, `ten_loaisp`, `mota_loaisp`) VALUES
('	Quần bông', '	Quần bông', '	Quần bông được may từ vải kate chất lượng với bề mặt vải mềm mịn, có độ co giãn		'),
('Áo lông vũ', 'Áo lông vũ', 'Mỗi khi đông về, áo lông vũ luôn là sản phẩm được nhiều người yêu thích. Áo được bày bán phổ biến tại Việt Nam');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ma_khachhang` varchar(20) NOT NULL,
  `tenkhachhang` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `diachi_lienhe` varchar(50) NOT NULL,
  `diachi_giaohang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ma_khachhang`, `tenkhachhang`, `email`, `phone`, `diachi_lienhe`, `diachi_giaohang`) VALUES
('KH738322', 'Hiệp', 'hiepnx03@gmail.com', 9888888, 'HN', 'TRung hòa'),
('KH864518', 'Hiệp', '1234124@gmail.com', 124, 'HN', '123'),
('KH419841', '123', '123', 123, '123', '123'),
('KH733274', '', '', 0, '', ''),
('KH718816', 'm', 'm', 0, 'm', 'm'),
('KH148667', '', '', 0, '', ''),
('KH862871', 'Hiệp', '1234124@gmail.com', 124124, 'HN', 'TRung hòa'),
('KH330443', 'Hiệp', '123@gmail.com', 124, 'HN', 'TRung hòa');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `noi_dung` text DEFAULT NULL,
  `nguoi_gui` varchar(50) DEFAULT NULL,
  `ngay_gui` date DEFAULT NULL,
  `feedback_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `noi_dung`, `nguoi_gui`, `ngay_gui`, `feedback_id`) VALUES
(0, '3123123', '12312', '2023-12-25', 5);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `thumbnail` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `href_param` varchar(250) DEFAULT NULL,
  `thumbnail` varchar(500) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `href_param`, `thumbnail`, `content`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '1', '1', '2023-12-22 20:57:26', '2023-12-23 20:57:26');

-- --------------------------------------------------------

--
-- Table structure for table `oderdetail`
--

CREATE TABLE `oderdetail` (
  `mahd` varchar(10) NOT NULL,
  `masp` varchar(20) NOT NULL,
  `tensp` varchar(50) NOT NULL,
  `soluong` int(11) NOT NULL,
  `giaxuat` int(11) NOT NULL,
  `khuyenmai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oderdetail`
--

INSERT INTO `oderdetail` (`mahd`, `masp`, `tensp`, `soluong`, `giaxuat`, `khuyenmai`) VALUES
('HD149198', 'QB1', 'Quần nỉ bông cho bé trai & bé gái Từ 3kg đến 16kg', 1, 33000, 9000),
('HD849229', 'QB1', 'Quần nỉ bông cho bé trai & bé gái Từ 3kg đến 16kg', 2, 33000, 9000),
('HD635829', 'QB2', 'Quần chục nỉ bông siêu ấm siêu đẹp cho bé trai/gái', 2, 80000, 70000),
('HD266820', 'QB2', 'Quần chục nỉ bông siêu ấm siêu đẹp cho bé trai/gái', 2, 80000, 70000),
('HD127680', 'QB1', 'Quần nỉ bông cho bé trai & bé gái Từ 3kg đến 16kg', 1, 33000, 9000),
('HD908971', 'QB3', 'Quần nỉ nhung tăm dáng jogger, quần dài cho bé gái', 2, 40000, 25000),
('HD926974', 'QB3', 'Quần nỉ nhung tăm dáng jogger, quần dài cho bé gái', 2, 40000, 25000),
('HD378735', 'QB2', 'Quần chục nỉ bông siêu ấm siêu đẹp cho bé trai/gái', 2, 80000, 70000),
('HD886255', 'QB3', 'Quần bông nhung tăm dáng jogger, quần dài cho bé g', 2, 40000, 25000),
('HD151542', 'ALV1', 'Áo lông vũ khoác lông cừu, áo phao trẻ em, áo khoá', 2, 90000, 80000);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `ma_hoadon` varchar(30) NOT NULL,
  `ma_khachhang` varchar(30) NOT NULL,
  `tenkhachhang` varchar(30) NOT NULL,
  `tongtien` int(11) NOT NULL,
  `createdate` date NOT NULL,
  `trangthai` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`ma_hoadon`, `ma_khachhang`, `tenkhachhang`, `tongtien`, `createdate`, `trangthai`) VALUES
('HD297199', 'KH864518', 'Hiệp', 20000, '2023-12-29', 1),
('HD215082', 'KH862871', 'Hiệp', 30000, '2023-12-28', 0),
('HD170714', 'KH330443', 'Hiệp', 20000, '2023-12-25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `total_money` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fullname`, `email`, `phone_number`, `address`, `note`, `order_date`, `status`, `total_money`) VALUES
(17, 1, 'Nguyễn Xuân Hiệp', 'hiepnx03@gmail.com', '0915411068', 'Trung Hòa Cầu Giấy Hà Nội', '', '2023-10-17 08:49:21', 1, 22746467),
(18, 1, 'Nguyễn Xuân Hiệp', 'hiepnx03@gmail.com', '0915411068', 'Trung Hòa Cầu Giấy Hà Nội', '', '2023-10-25 20:50:40', 1, 1924247),
(19, 1, 'Nguyễn Xuân Hiệp', 'hiepnx03@gmail.com', '0915411068', 'Trung Hòa Cầu Giấy Hà Nội', '', '2023-12-22 21:50:14', 1, 123);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `total_money` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `num`, `total_money`) VALUES
(32, 17, 3, 2222222, 1, 2222222),
(33, 17, 4, 2222222, 1, 2222222),
(34, 17, 2, 2222222, 1, 2222222),
(35, 17, 1, 2222222, 1, 2222222),
(36, 17, 7, 2222222, 10, 22222220),
(37, 18, 2, 124124, 9, 1117116),
(38, 18, 3, 124124, 1, 124124),
(39, 18, 4, 124124, 1, 124124),
(40, 19, 3, 123, 1, 123);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `thumbnail` varchar(500) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `title`, `price`, `discount`, `thumbnail`, `description`, `created_at`, `updated_at`, `deleted`) VALUES
(1, NULL, 'Quần Áo 1', 200000, NULL, '/ULSA/baitaplon/images/uploads/product1.jpg', 'trẻ em 2 tuổi ', NULL, NULL, NULL),
(2, NULL, 'Quần Áo 1', 200000, NULL, '/ULSA/baitaplon/images/uploads/product1.jpg', 'trẻ em 2 tuổi ', NULL, NULL, NULL),
(3, NULL, 'áo thun', 123, NULL, '/ULSA/baitaplon/images/uploads/product2.jpg', '123', NULL, NULL, NULL),
(4, NULL, '123', 124124, NULL, '/ULSA/baitaplon/images/uploads/product3.jpg', '123', NULL, NULL, NULL),
(5, NULL, '123124', 5125125, NULL, '/ULSA/baitaplon/images/uploads/product4.jpg', '12412', NULL, NULL, NULL),
(6, NULL, '123', 123, NULL, '/ULSA/baitaplon/images/uploads/product3.jpg', '123', NULL, NULL, NULL),
(7, NULL, '123324567890', 2222222, NULL, '/ULSA/baitaplon/images/uploads/IMG_1690264983788_1690281341387.jpg', '1234567890876543', NULL, NULL, NULL),
(8, NULL, 'áo thun', 124123123, NULL, '/ULSA/baitaplon/images/uploads/IMG_1690264983788_1690281341387.jpg', '123', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thongtinlienhe`
--

CREATE TABLE `thongtinlienhe` (
  `id` int(11) NOT NULL,
  `ten_nguoi_lien_he` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `so_dien_thoai` varchar(15) DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `noi_dung` text DEFAULT NULL,
  `ngay_gui` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thongtinlienhe`
--

INSERT INTO `thongtinlienhe` (`id`, `ten_nguoi_lien_he`, `email`, `so_dien_thoai`, `dia_chi`, `noi_dung`, `ngay_gui`) VALUES
(1, 'Nguyễn Xuân Hiệp', 'hiepnx03@gmail.com', '0123456789', 'Hà Nội', 'Trợ Giúp Hãy Liên Lạc Qua Tôi', '2023-12-24 20:15:45');

-- --------------------------------------------------------

--
-- Table structure for table `tin_tuc`
--

CREATE TABLE `tin_tuc` (
  `id` int(11) NOT NULL,
  `tieu_de` varchar(255) NOT NULL,
  `noi_dung` text NOT NULL,
  `ngay_dang` date DEFAULT NULL,
  `hang_san_xuat` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `mo_ta` text DEFAULT NULL,
  `gia` decimal(10,2) DEFAULT NULL,
  `ngay_ra_mat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tin_tuc`
--

INSERT INTO `tin_tuc` (`id`, `tieu_de`, `noi_dung`, `ngay_dang`, `hang_san_xuat`, `model`, `mo_ta`, `gia`, `ngay_ra_mat`) VALUES
(1, '12', '123', '2023-12-24', '123', '123', '123', 123.00, '2023-12-28'),
(2, 'z1', 'z1', '2023-12-24', 'z1', 'z1', 'z1', 0.00, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` enum('Nam','Nữ') DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `access_level` enum('Quantri','Nguoidung') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `username`, `password`, `phone`, `gender`, `nationality`, `address`, `access_level`, `created_at`, `avatar`) VALUES
(2, 'zz', '1@gm.c123', '1', '1', '1123', 'Nam', 'Mỹ', '1123123123', 'Nguoidung', '2023-12-22 09:03:31', ''),
(4, '3', '3@v.b', '3', '3', '3', 'Nữ', 'Hàn Quốc', '3', 'Nguoidung', '2023-12-22 09:04:44', 'FB_IMG_15641094436613972.jpg'),
(5, 'a', 'admin@gmail.com', 'a', '123456789Â!', 'a', 'Nữ', 'Hàn Quốc', 'a', 'Quantri', '2023-12-22 09:09:20', '1.jpg'),
(7, '1123123123', 'admin1@gmail.com', '2', '123456789Â!', '1', 'Nam', 'Mỹ', '1', 'Quantri', '2023-12-24 15:48:38', '2.jpg'),
(8, 'admin1123123', '1@gmail.com', '123123123', '123456789Â!', '123123123', 'Nữ', 'Việt Nam', '123123123', 'Nguoidung', '2023-12-24 18:23:00', 'quần.jpg'),
(9, 'admin1', 'hiepnx03@gmail.com', '123', '123456789Â!', '', 'Nữ', 'Việt Nam', '', 'Nguoidung', '2023-12-24 18:24:27', ''),
(10, '2', '2@gmail.com', '2', '2', '2', 'Nữ', 'Việt Nam', '2', 'Nguoidung', '2023-12-24 19:05:25', ''),
(11, '1', '1@gmail.com', '1', '1', '1', 'Nữ', 'Việt Nam', '', 'Quantri', '2023-12-24 19:06:43', ''),
(12, '2', '2@gmail.com', '2', '2', '2', 'Nữ', 'Việt Nam', '2', 'Nguoidung', '2023-12-24 21:03:12', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thongtinlienhe`
--
ALTER TABLE `thongtinlienhe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tin_tuc`
--
ALTER TABLE `tin_tuc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thongtinlienhe`
--
ALTER TABLE `thongtinlienhe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tin_tuc`
--
ALTER TABLE `tin_tuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
