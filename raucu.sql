-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2022 at 07:34 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `raucu`
--

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `id` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `thanh_tien` double NOT NULL,
  `id_mat_hang` int(11) NOT NULL,
  `id_don_hang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chi_tiet_don_hang`
--

INSERT INTO `chi_tiet_don_hang` (`id`, `so_luong`, `thanh_tien`, `id_mat_hang`, `id_don_hang`) VALUES
(8, 1, 13000, 2, 8),
(9, 1, 13000, 2, 9),
(10, 1, 13000, 4, 10),
(11, 1, 13000, 2, 11),
(12, 1, 13000, 4, 11),
(13, 2, 13500, 1, 12),
(14, 1, 13500, 1, 13),
(15, 1, 13500, 1, 14),
(16, 1, 13000, 2, 15),
(17, 1, 13000, 3, 15),
(18, 1, 13500, 1, 16),
(19, 9, 13500, 1, 17),
(20, 4, 13500, 1, 18),
(21, 1, 13500, 1, 19),
(22, 1, 13000, 2, 19),
(23, 1, 13000, 3, 19),
(24, 1, 13500, 1, 20),
(25, 1, 13500, 1, 21),
(26, 1, 13500, 1, 22),
(27, 1, 13000, 2, 23),
(28, 1, 13500, 1, 24),
(36, 1, 13500, 1, 30),
(37, 1, 13500, 1, 31),
(38, 1, 12000, 5, 32),
(39, 2, 13500, 1, 33),
(40, 1, 13500, 1, 34),
(41, 1, 13000, 2, 35),
(42, 1, 13500, 1, 36),
(43, 1, 13500, 1, 37),
(44, 1, 13000, 2, 37),
(45, 1, 3000, 11, 38),
(46, 1, 13500, 1, 39),
(47, 1, 13000, 2, 39),
(48, 1, 13000, 3, 39),
(49, 1, 13500, 1, 40),
(50, 1, 13000, 2, 40),
(51, 1, 13000, 3, 40),
(52, 1, 13500, 1, 41),
(53, 1, 13000, 2, 41),
(54, 1, 13000, 3, 41),
(55, 1, 13500, 1, 42),
(56, 1, 13000, 2, 42),
(57, 1, 13000, 4, 42);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_hoa_don`
--

CREATE TABLE `chi_tiet_hoa_don` (
  `id` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `thanh_tien` double NOT NULL,
  `id_hoa_don` int(11) NOT NULL,
  `id_mat_hang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_phieu_nhap`
--

CREATE TABLE `chi_tiet_phieu_nhap` (
  `id` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `thanh_tien` double NOT NULL,
  `id_mat_hang` int(11) NOT NULL,
  `id_phieu_nhap_hang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `danh_muc_mat_hang`
--

CREATE TABLE `danh_muc_mat_hang` (
  `id` int(11) NOT NULL,
  `ten_danh_muc` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `danh_muc_mat_hang`
--

INSERT INTO `danh_muc_mat_hang` (`id`, `ten_danh_muc`) VALUES
(1, 'Rau củ'),
(2, 'Gia Vị'),
(4, 'Trái Cây'),
(5, 'Hạt'),
(6, 'Rau Ăn Lá'),
(7, 'Loại Khác');

-- --------------------------------------------------------

--
-- Table structure for table `dia_chi`
--

CREATE TABLE `dia_chi` (
  `id_khach_hang` int(11) NOT NULL,
  `tinh` varchar(50) DEFAULT NULL,
  `quan` varchar(50) DEFAULT NULL,
  `phuong` varchar(50) DEFAULT NULL,
  `chi_tiet` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dia_chi`
--

INSERT INTO `dia_chi` (`id_khach_hang`, `tinh`, `quan`, `phuong`, `chi_tiet`) VALUES
(1, 'hcm', '10', '1', '70 hung vuong'),
(3, 'hcm', '5', '3', '273 An Dương Vương'),
(4, 'hcm', '10', '1', '70 hung vuong'),
(5, 'hcm', '5', '3', '273 An duong vuong'),
(7, 'hcm', '10', '1', '70 hùng vương'),
(8, 'hcm', '10', '1', '70 Hùng Vương');

-- --------------------------------------------------------

--
-- Table structure for table `don_hang`
--

CREATE TABLE `don_hang` (
  `id` int(11) NOT NULL,
  `ngay_mua` date NOT NULL,
  `phi_ship` double DEFAULT NULL,
  `tong_tien` double NOT NULL,
  `nguoi_giao` varchar(30) DEFAULT NULL,
  `trang_thai` varchar(20) DEFAULT '0',
  `id_tai_khoan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `don_hang`
--

INSERT INTO `don_hang` (`id`, `ngay_mua`, `phi_ship`, `tong_tien`, `nguoi_giao`, `trang_thai`, `id_tai_khoan`) VALUES
(8, '2021-12-01', 19000, 13000, 'Trường đẹp trai', '-2', 3),
(9, '2021-12-12', NULL, 13000, NULL, '-2', 1),
(10, '2021-12-06', NULL, 13000, NULL, '1', 1),
(11, '2021-12-13', 40000, 26000, 'VVVVV', '1', 1),
(12, '2022-04-29', NULL, 27000, NULL, '-2', 3),
(13, '2022-04-29', NULL, 13500, NULL, '-2', 3),
(14, '2022-04-30', NULL, 13500, NULL, '-2', 3),
(15, '2022-04-30', NULL, 26000, NULL, '-2', 3),
(16, '2022-04-30', NULL, 13500, NULL, '-2', 3),
(17, '2022-04-30', NULL, 121500, NULL, '-2', 3),
(18, '2022-04-30', NULL, 54000, NULL, '-2', 3),
(19, '2022-04-30', NULL, 39500, NULL, '1', 3),
(20, '2022-04-30', NULL, 13500, NULL, '1', 3),
(21, '2022-04-30', NULL, 13500, NULL, '1', 3),
(22, '2022-04-30', NULL, 13500, NULL, '1', 3),
(23, '2022-05-01', NULL, 13000, NULL, '1', 3),
(24, '2022-05-04', NULL, 13500, NULL, '1', 3),
(30, '2022-05-04', 25000, 13500, NULL, '1', 4),
(31, '2022-05-04', 25000, 13500, NULL, '1', 4),
(32, '2022-05-04', 25000, 12000, NULL, '1', 4),
(33, '2022-05-04', 25000, 27000, NULL, '1', 4),
(34, '2022-05-04', 20000, 13500, 'shopee', '1', 4),
(35, '2022-05-04', 25000, 13000, NULL, '1', 5),
(36, '2022-05-04', 25000, 13500, NULL, '1', 5),
(37, '2022-05-04', 25000, 26500, 'shopee', '1', 1),
(38, '2022-05-05', 25000, 3000, NULL, '1', 4),
(39, '2022-05-06', 25000, 39500, NULL, '1', 4),
(40, '2022-05-06', 25000, 39500, NULL, '1', 4),
(41, '2022-05-06', 25000, 39500, 'shoppe', '1', 7),
(42, '2022-05-06', 25000, 39500, 'shopee', '1', 8);

-- --------------------------------------------------------

--
-- Table structure for table `hoa_don`
--

CREATE TABLE `hoa_don` (
  `id` int(11) NOT NULL,
  `ngay_mua` date NOT NULL,
  `tong_tien` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mat_hang`
--

CREATE TABLE `mat_hang` (
  `id` int(11) NOT NULL,
  `ten_mat_hang` varchar(30) NOT NULL,
  `don_vi_tinh` varchar(10) NOT NULL,
  `khoi_luong` float NOT NULL,
  `so_luong_ton` int(11) NOT NULL,
  `gia_ban` double NOT NULL,
  `image` text NOT NULL,
  `id_danh_muc_mat_hang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mat_hang`
--

INSERT INTO `mat_hang` (`id`, `ten_mat_hang`, `don_vi_tinh`, `khoi_luong`, `so_luong_ton`, `gia_ban`, `image`, `id_danh_muc_mat_hang`) VALUES
(1, 'Bí đỏ', 'gram', 1, 40, 13500, 'bido.png', 1),
(2, 'Bưởi', '23000', 1, 50, 13000, 'buoi.png', 4),
(3, 'Cà chua', 'trái', 1, 50, 13000, 'cachua.jpg', 1),
(4, 'Cải 7 màu', 'Bó', 1, 1, 13000, 'cai7mau.png', 6),
(5, 'Cải Tím', 'Bó', 1, 40, 12000, 'caixanh.jpg', 6),
(6, 'Cam', 'Kg', 1, 20, 50000, 'cam.png', 4),
(7, 'Cà Rốt', 'trái', 1, 50, 7000, 'carot.png', 1),
(8, 'Cherry', 'Hộp', 1, 12, 100000, 'cherry.jpg', 4),
(9, 'Chuối', 'nải', 1, 20, 12000, 'chuoi.png', 4),
(10, 'Củ Dền', 'Củ', 2, 12, 13000, 'cuden.jpg', 1),
(11, 'Đậu Đỏ', 'gram', 100, 50, 3000, 'daudo.jpg', 5),
(12, 'Hành lá', 'gram', 100, 50, 5000, 'hanhtay.png', 7),
(13, 'Kiwi', 'trái', 1, 50, 40000, 'kiwi.jpg', 4),
(14, 'Mận', 'Kg', 1, 20, 20000, 'man.jpg', 4),
(15, 'Măng chua', 'Kg', 1, 30, 40000, 'mangchua.png', 7),
(16, 'Ớt', 'gram', 500, 40, 12000, 'ot.jpg', 2),
(17, 'Rau muống', 'Bó', 1, 12, 12000, 'raumuong.jpg', 6),
(18, 'Rau Thơm', 'Bó', 1, 20, 13000, 'rauthom.png', 6),
(19, 'Chanh Leo', 'Kg', 1, 10, 50000, 'chanhleo.png', 4),
(20, 'Súp Lơ Xanh', 'Kg', 1, 20, 12000, 'suplo.png', 1),
(21, 'Thanh Long', 'Kg', 1, 50, 7000, 'thanhlong.png', 4),
(22, 'Thơm', 'Trái', 1, 10000, 13000, 'thom.jpg', 4),
(23, 'Trái Khổ Qua', 'gram', 500, 40, 13000, 'traikhoqua.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nha_cung_ung`
--

CREATE TABLE `nha_cung_ung` (
  `id` int(11) NOT NULL,
  `ten_nha_cung_ung` varchar(30) NOT NULL,
  `dia_chi` text NOT NULL,
  `sdt` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `phieu_nhap_hang`
--

CREATE TABLE `phieu_nhap_hang` (
  `id` int(11) NOT NULL,
  `ngay_nhap` date NOT NULL,
  `so_luong` int(11) NOT NULL,
  `tong_tien` double NOT NULL,
  `id_nha_cung_ung` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `id` int(11) NOT NULL,
  `ten_tai_khoan` varchar(30) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mat_khau` varchar(50) NOT NULL,
  `ten_khach` varchar(50) DEFAULT NULL,
  `sdt` varchar(10) NOT NULL,
  `vai_tro` int(11) NOT NULL DEFAULT 0,
  `trang_thai` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tai_khoan`
--

INSERT INTO `tai_khoan` (`id`, `ten_tai_khoan`, `email`, `mat_khau`, `ten_khach`, `sdt`, `vai_tro`, `trang_thai`) VALUES
(1, 'admin', 'quangtruong@gmail.com', '123', 'Quang Truong', '0332588979', 1, 0),
(3, 'truong', 'truong@gmail.com', '1234', 'Trường 09', '090920610', 0, 0),
(4, 'taminhvu', 'taminhvu@gmail.com', '12345', 'Tạ Minh Vũ', '0396384462', 0, 0),
(5, 'taminhluan', 'minhluan@gmail.com', '1234', 'NULL', '0326628622', 0, 0),
(6, 'vu', 'minhvu@gmail.com', '123', 'NULL', '0396384462', 0, 0),
(7, 'tripham', 'tripham@gmail.com', '1234', 'Phạm Minh Trí', '0354870291', 0, 0),
(8, 'khactruong', 'khactruong@gmail.com', '1234', 'Trương khắc Trường', '0945893339', 0, 0),
(9, 'khang', 'khang@gmail.com', '123', 'khang', '0396384462', 0, 0),
(10, 'toan', 'toan@gmail.com', '123', 'NULL', '0396384462', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `thong_tin_gioi_thieu`
--

CREATE TABLE `thong_tin_gioi_thieu` (
  `id` int(11) NOT NULL,
  `thongtin` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mat_hang` (`id_mat_hang`),
  ADD KEY `id_don_hang` (`id_don_hang`);

--
-- Indexes for table `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mat_hang` (`id_mat_hang`),
  ADD KEY `id_hoa_don` (`id_hoa_don`);

--
-- Indexes for table `chi_tiet_phieu_nhap`
--
ALTER TABLE `chi_tiet_phieu_nhap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mat_hang` (`id_mat_hang`),
  ADD KEY `id_phieu_nhap_hang` (`id_phieu_nhap_hang`);

--
-- Indexes for table `danh_muc_mat_hang`
--
ALTER TABLE `danh_muc_mat_hang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dia_chi`
--
ALTER TABLE `dia_chi`
  ADD PRIMARY KEY (`id_khach_hang`);

--
-- Indexes for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tai_khoan` (`id_tai_khoan`);

--
-- Indexes for table `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mat_hang`
--
ALTER TABLE `mat_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_danh_muc_mat_hang` (`id_danh_muc_mat_hang`);

--
-- Indexes for table `nha_cung_ung`
--
ALTER TABLE `nha_cung_ung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phieu_nhap_hang`
--
ALTER TABLE `phieu_nhap_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nha_cung_ung` (`id_nha_cung_ung`);

--
-- Indexes for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_tai_khoan` (`ten_tai_khoan`);

--
-- Indexes for table `thong_tin_gioi_thieu`
--
ALTER TABLE `thong_tin_gioi_thieu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chi_tiet_phieu_nhap`
--
ALTER TABLE `chi_tiet_phieu_nhap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `danh_muc_mat_hang`
--
ALTER TABLE `danh_muc_mat_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `hoa_don`
--
ALTER TABLE `hoa_don`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mat_hang`
--
ALTER TABLE `mat_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `nha_cung_ung`
--
ALTER TABLE `nha_cung_ung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phieu_nhap_hang`
--
ALTER TABLE `phieu_nhap_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `thong_tin_gioi_thieu`
--
ALTER TABLE `thong_tin_gioi_thieu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_1` FOREIGN KEY (`id_mat_hang`) REFERENCES `mat_hang` (`id`),
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_2` FOREIGN KEY (`id_don_hang`) REFERENCES `don_hang` (`id`);

--
-- Constraints for table `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  ADD CONSTRAINT `chi_tiet_hoa_don_ibfk_1` FOREIGN KEY (`id_mat_hang`) REFERENCES `mat_hang` (`id`),
  ADD CONSTRAINT `chi_tiet_hoa_don_ibfk_2` FOREIGN KEY (`id_hoa_don`) REFERENCES `hoa_don` (`id`);

--
-- Constraints for table `chi_tiet_phieu_nhap`
--
ALTER TABLE `chi_tiet_phieu_nhap`
  ADD CONSTRAINT `chi_tiet_phieu_nhap_ibfk_1` FOREIGN KEY (`id_mat_hang`) REFERENCES `mat_hang` (`id`),
  ADD CONSTRAINT `chi_tiet_phieu_nhap_ibfk_2` FOREIGN KEY (`id_phieu_nhap_hang`) REFERENCES `phieu_nhap_hang` (`id`);

--
-- Constraints for table `dia_chi`
--
ALTER TABLE `dia_chi`
  ADD CONSTRAINT `fk_diachi` FOREIGN KEY (`id_khach_hang`) REFERENCES `tai_khoan` (`id`);

--
-- Constraints for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_ibfk_1` FOREIGN KEY (`id_tai_khoan`) REFERENCES `tai_khoan` (`id`);

--
-- Constraints for table `mat_hang`
--
ALTER TABLE `mat_hang`
  ADD CONSTRAINT `mat_hang_ibfk_1` FOREIGN KEY (`id_danh_muc_mat_hang`) REFERENCES `danh_muc_mat_hang` (`id`);

--
-- Constraints for table `phieu_nhap_hang`
--
ALTER TABLE `phieu_nhap_hang`
  ADD CONSTRAINT `phieu_nhap_hang_ibfk_1` FOREIGN KEY (`id_nha_cung_ung`) REFERENCES `nha_cung_ung` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
