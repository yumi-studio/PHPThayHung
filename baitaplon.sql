-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 01, 2019 lúc 11:13 AM
-- Phiên bản máy phục vụ: 10.1.31-MariaDB
-- Phiên bản PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `baitaplon`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `userName` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `position` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `userName`, `password`, `name`, `address`, `email`, `phone`, `branch_id`, `position`, `status`) VALUES
(13, 'admin', '123', 'admin xinh gai', '', 'admin@gmail.com', '', 1, 'Quản trị viên', 0),
(31, 'phuong', '123', 'Phương GĐ', '', '', '', 3, 'Giám đốc', 1),
(32, 'dung', '123', 'Dũng', '', '', '', 2, 'Giám đốc', 1),
(33, 'duy', '123', 'Nguyễn Thành Duy', 'Hà Nội', 'thanhduy.ptit.cntt@gmail.com', '0338867763', 1, 'Giám đốc', 1),
(35, 'hungVape', 'weed', 'Vũ Hùng', 'HN', '', '', 3, 'Nhân viên', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `branch`
--

INSERT INTO `branch` (`id`, `name`, `address`) VALUES
(1, 'Miền Bắc', ''),
(2, 'Miền Trung', ''),
(3, 'Miền Nam', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `finsh` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `project`
--

INSERT INTO `project` (`id`, `name`, `location`, `description`, `start`, `finsh`) VALUES
(91, 'Dự án 4', 'Hà nội', 'No description', '0003-02-01 00:00:00', '0006-05-04 00:00:00'),
(92, 'Dự án 5', 'Hà nội', 'No description', '0003-02-01 00:00:00', '0006-05-04 00:00:00'),
(93, 'Dự án 6', 'Hà nội', 'No description', '0003-02-01 00:00:00', '0006-05-04 00:00:00'),
(94, 'Dự án 7', 'Hà nội', 'No description', '0003-02-01 00:00:00', '0006-05-04 00:00:00'),
(95, 'Dự án 8', 'Hà nội', 'No description', '0003-02-01 00:00:00', '0006-05-04 00:00:00'),
(96, 'Dự án 9', 'Hà nội', 'No description', '0003-02-01 00:00:00', '0006-05-04 00:00:00'),
(98, 'duan1', 'àdgg', 'zzzzzzzzzzz', '2018-11-30 00:00:00', '2018-11-30 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `accountId` int(11) NOT NULL,
  `projectId` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `register`
--

INSERT INTO `register` (`id`, `accountId`, `projectId`, `time`) VALUES
(23, 13, 92, '2019-03-01 09:28:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `salary`
--

CREATE TABLE `salary` (
  `id` int(11) NOT NULL,
  `accountId` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fixed_salary` int(11) NOT NULL,
  `bonus` int(11) DEFAULT '0',
  `fines` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `salary`
--

INSERT INTO `salary` (`id`, `accountId`, `time`, `fixed_salary`, `bonus`, `fines`) VALUES
(7, 13, '2018-11-30 19:16:17', 10000, 0, 0),
(26, 31, '2019-03-01 01:14:44', 5000, 0, 0),
(27, 32, '2019-03-01 09:33:24', 10000, 0, 0),
(28, 33, '2019-03-01 02:01:04', 10000, 0, 0),
(30, 35, '2019-03-01 08:32:14', 2000, 0, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_account_branch` (`branch_id`);

--
-- Chỉ mục cho bảng `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_register_1_idx` (`accountId`),
  ADD KEY `fk_register_2_idx` (`projectId`);

--
-- Chỉ mục cho bảng `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_salary_1_idx` (`accountId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT cho bảng `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `fk_account_branch` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `fk_register_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_register_2` FOREIGN KEY (`projectId`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `fk_salary_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
