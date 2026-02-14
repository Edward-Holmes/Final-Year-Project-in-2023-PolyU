-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2023-02-21 14:51:44
-- 服务器版本： 10.4.27-MariaDB
-- PHP 版本： 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `Parking_System`
--

-- --------------------------------------------------------

--
-- 表的结构 `ParkingRec`
--

CREATE TABLE `ParkingRec` (
  `id` int(32) NOT NULL DEFAULT 1 COMMENT '停车序号',
  `Uid` int(9) NOT NULL COMMENT '用户ID',
  `License` varchar(8) NOT NULL COMMENT '车牌号',
  `Pre_Start_Time` datetime NOT NULL COMMENT '预约起始时间',
  `Pre_End_Time` datetime NOT NULL COMMENT '预约结束时间',
  `Start_Time` datetime NOT NULL COMMENT '起始时间',
  `End_Time` datetime NOT NULL COMMENT '终止时间',
  `Parking_Lot` int(11) NOT NULL COMMENT '车位'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `ParkingRec`
--

INSERT INTO `ParkingRec` (`id`, `Uid`, `License`, `Pre_Start_Time`, `Pre_End_Time`, `Start_Time`, `End_Time`, `Parking_Lot`) VALUES
(1, 100000001, '川A12345', '2023-01-16 10:00:00', '2023-01-16 19:30:00', '2023-01-16 10:12:32', '2023-01-16 19:12:32', 1),
(2, 100000001, '川A12345', '2023-01-17 10:00:00', '2023-01-17 19:30:00', '2023-01-17 10:01:59', '2023-01-17 19:18:39', 1),
(3, 100000002, '粤A54321', '2023-01-17 23:30:00', '2023-01-18 09:30:00', '2023-01-17 23:30:12', '2023-01-18 09:27:11', 2);

-- --------------------------------------------------------

--
-- 表的结构 `UserInfo`
--

CREATE TABLE `UserInfo` (
  `Uid` int(9) NOT NULL DEFAULT 100000001 COMMENT '用户唯一ID',
  `User_Email` varchar(32) NOT NULL COMMENT '用户邮箱（不可重复）',
  `User_Name` text NOT NULL DEFAULT 'User' COMMENT '用户名',
  `Password` varchar(32) NOT NULL COMMENT '密码',
  `Profile_Image` varchar(32) NOT NULL DEFAULT 'user.jpg' COMMENT '用户头像',
  `Gender` text NOT NULL DEFAULT 'Secret' COMMENT '性别',
  `Pre_S_Time` datetime DEFAULT NULL COMMENT '预约开始时间',
  `Pre_E_Time` datetime DEFAULT NULL COMMENT '预约结束时间',
  `S_Time` datetime DEFAULT NULL COMMENT '开始时间',
  `P_Lot` int(11) DEFAULT NULL COMMENT '停车位',
  `This_License` varchar(8) DEFAULT NULL COMMENT '当前车号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `UserInfo`
--

INSERT INTO `UserInfo` (`Uid`, `User_Email`, `User_Name`, `Password`, `Profile_Image`, `Gender`, `Pre_S_Time`, `Pre_E_Time`, `S_Time`, `P_Lot`, `This_License`) VALUES
(100000000, 'elysia@connect.polyu.hk', 'Elysia', 'elysiarealme', '100000000.jpg', 'Female', NULL, NULL, NULL, NULL, NULL),
(100000001, '19000001d@connect.polyu.hk', 'Edward', '1234567890', '100000001.jpg', 'Male', NULL, NULL, NULL, NULL, NULL),
(100000002, '19000002d@connect.polyu.hk', 'Peter', 'qwertyuiop', '100000002.jpg', 'Male', NULL, NULL, NULL, NULL, NULL),
(100000003, 'bianca@126.com', 'Bianca', '123456', 'user.jpg', 'Female', '2023-02-02 17:06:47', '2023-02-03 17:06:47', NULL, NULL, '吉AA266G');

--
-- 转储表的索引
--

--
-- 表的索引 `ParkingRec`
--
ALTER TABLE `ParkingRec`
  ADD UNIQUE KEY `ID` (`id`);

--
-- 表的索引 `UserInfo`
--
ALTER TABLE `UserInfo`
  ADD PRIMARY KEY (`Uid`),
  ADD UNIQUE KEY `User_Email` (`User_Email`),
  ADD UNIQUE KEY `UID` (`Uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
