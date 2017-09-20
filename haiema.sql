-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-09-20 16:11:49
-- 服务器版本： 5.5.47
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haiema`
--

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

CREATE TABLE `goods` (
  `goods_id` int(11) NOT NULL,
  `goods_name` varchar(45) CHARACTER SET utf8 NOT NULL,
  `goods_img` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `SID` int(50) NOT NULL,
  `goods_price` int(10) NOT NULL,
  `goods_note` text CHARACTER SET utf8 NOT NULL COMMENT '商品描述',
  `goods_class` varchar(50) CHARACTER SET utf8 NOT NULL,
  `sell_num` int(10) NOT NULL COMMENT '销量'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `goods`
--

INSERT INTO `goods` (`goods_id`, `goods_name`, `goods_img`, `SID`, `goods_price`, `goods_note`, `goods_class`, `sell_num`) VALUES
(24, '可乐（小�\�', 'img/goods/.png', 1, 7, '可乐（小�\�', '饮料', 0),
(44, '牛肉汉堡', 'img/goods/.png', 1, 15, '牛肉汉堡', '主食', 2),
(42, '鸡肉汉堡', 'img/goods/.png', 1, 12, '鸡肉汉堡', '主食', 0),
(43, '新奥尔良鸡腿�\�', 'img/goods/.png', 1, 15, '新奥尔良鸡腿�\�', '主食', 0),
(37, '啊啊�\�', 'img/goods/.png', 2, 56, '131', '主菜', 0),
(40, '订单', 'img/goods/2/订单.png', 2, 232, '313123', '主菜', 0),
(41, '香辣鸡腿�\�', 'img/goods/.png', 1, 12, '香辣鸡腿�\�', '主食', 0),
(45, '老北京鸡肉卷', 'img/goods/.png', 1, 13, '老北京鸡肉卷', '主食', 0),
(46, '可乐（中�\�', 'img/goods/.png', 1, 9, '可乐（中�\�', '饮料', 0),
(47, '可乐（大�\�', 'img/goods/.png', 1, 12, '可乐（大�\�', '饮料', 0),
(48, '香辣鸡腿', 'img/goods/.png', 1, 6, '香辣鸡腿', '小吃', 0),
(49, '蛋挞', 'img/goods/.png', 1, 6, '蛋挞', '小吃', 0),
(50, '薯条', 'img/goods/.png', 1, 10, '薯条', '小吃', 0);

-- --------------------------------------------------------

--
-- 表的结构 `od`
--

CREATE TABLE `od` (
  `O_id` int(11) NOT NULL,
  `O_list` text CHARACTER SET utf8 NOT NULL,
  `UID` int(11) NOT NULL,
  `O_time` datetime DEFAULT NULL COMMENT '下单时间',
  `O_ADD` varchar(500) CHARACTER SET utf8 NOT NULL,
  `O_t_sellersub` datetime DEFAULT NULL COMMENT '商家接受时间',
  `O_overtime` datetime DEFAULT NULL COMMENT '顾客收到时间',
  `SID` int(10) NOT NULL,
  `O_sum` int(10) NOT NULL,
  `O_words` tinytext CHARACTER SET utf8 NOT NULL,
  `comment_star` int(2) NOT NULL COMMENT '评价',
  `comment_text` tinytext NOT NULL COMMENT '评语',
  `comment_time` datetime NOT NULL COMMENT '评价时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `od`
--

INSERT INTO `od` (`O_id`, `O_list`, `UID`, `O_time`, `O_ADD`, `O_t_sellersub`, `O_overtime`, `SID`, `O_sum`, `O_words`, `comment_star`, `comment_text`, `comment_time`) VALUES
(51, '[{\"SID\":\"1\",\"shopfee\":\"30\",\"goods_id\":\"31\",\"goods_name\":\"ddd\",\"goods_num\":\"4\",\"goods_price\":231}]', 1, '2017-09-09 00:26:59', '{\"name\":\"hahaa\",\"sex\":\"先生\",\"position\":\"小区\",\"phone\":\"6666-6666\"}', '2017-09-09 00:31:40', '2017-09-19 23:25:52', 1, 924, '�\�', 1, '一点都不好�\�', '2017-09-19 22:26:19'),
(50, '[{\"SID\":\"1\",\"shopfee\":\"30\",\"goods_id\":\"25\",\"goods_name\":\"汉堡\",\"goods_num\":\"3\",\"goods_price\":12}]', 1, '2017-09-08 11:08:58', '{\"name\":\"12312\",\"sex\":\"先生\",\"position\":\"啊实打实�\�\",\"phone\":\"asdad312\"}', '2017-09-08 11:17:26', '2017-09-19 23:25:46', 1, 36, '�\�', 0, '', '0000-00-00 00:00:00'),
(49, '[{\"SID\":\"1\",\"shopfee\":\"30\",\"goods_id\":\"25\",\"goods_name\":\"汉堡\",\"goods_num\":\"6\",\"goods_price\":12}]', 1, '2017-09-08 10:39:49', '{\"name\":\"12312\",\"sex\":\"先生\",\"position\":\"啊实打实�\�\",\"phone\":\"asdad312\"}', '2017-09-08 11:17:28', NULL, 1, 72, '�\�', 0, '', '0000-00-00 00:00:00'),
(48, '[{\"SID\":\"1\",\"shopfee\":\"30\",\"goods_id\":\"25\",\"goods_name\":\"汉堡\",\"goods_num\":\"4\",\"goods_price\":12}]', 1, '2017-09-08 10:38:49', '{\"name\":\"12312\",\"sex\":\"先生\",\"position\":\"啊实打实�\�\",\"phone\":\"asdad312\"}', '2017-09-08 11:17:30', '2017-09-11 17:41:51', 1, 48, '�\�', 0, '', '0000-00-00 00:00:00'),
(47, '[{\"SID\":\"1\",\"shopfee\":\"30\",\"goods_id\":\"1\",\"goods_name\":\"�\�\",\"goods_num\":\"7\",\"goods_price\":20}]', 1, '2017-09-07 21:24:00', '{\"name\":\"3223423\",\"sex\":\"先生\",\"position\":\"11111\",\"phone\":\"3213121231\"}', '2017-09-07 21:32:06', NULL, 1, 140, 'affgfd', 0, '', '0000-00-00 00:00:00'),
(46, '[{\"SID\":\"1\",\"shopfee\":\"30\",\"goods_id\":\"1\",\"goods_name\":\"�\�\",\"goods_num\":\"4\",\"goods_price\":20}]', 1, '2017-09-05 21:15:02', '{\"name\":\"12312\",\"sex\":\"先生\",\"position\":\"啊实打实�\�\",\"phone\":\"asdad312\"}', '2017-09-05 21:15:32', NULL, 1, 80, '多加�\�', 0, '', '0000-00-00 00:00:00'),
(45, '[{\"SID\":\"1\",\"shopfee\":\"30\",\"goods_id\":\"1\",\"goods_name\":\"�\�\",\"goods_num\":\"5\",\"goods_price\":20},{\"SID\":\"1\",\"shopfee\":\"30\",\"goods_id\":\"3\",\"goods_name\":\"可乐\",\"goods_num\":\"5\",\"goods_price\":20}]', 1, '2017-09-05 20:19:49', '{\"name\":\"12312\",\"sex\":\"先生\",\"position\":\"啊实打实�\�\",\"phone\":\"asdad312\"}', '2017-09-05 20:20:14', '2017-09-04 00:00:00', 1, 200, '�\�', 0, '', '0000-00-00 00:00:00'),
(52, '[{\"SID\":\"2\",\"shopfee\":\"20\",\"goods_id\":\"37\",\"goods_name\":\"啊啊�\�\",\"goods_num\":\"6\",\"goods_price\":56}]', 1, '2017-09-09 15:04:54', '{\"name\":\"hahaa\",\"sex\":\"先生\",\"position\":\"小区\",\"phone\":\"6666-6666\"}', '2017-09-09 15:11:41', '2017-09-19 23:25:57', 2, 336, '�\�', 5, '未评�\�', '2017-09-19 22:52:03'),
(53, '[{\"SID\":\"1\",\"shopfee\":\"10\",\"goods_id\":\"35\",\"goods_name\":\"ddddaweaw\",\"goods_num\":\"7\",\"goods_price\":34},{\"SID\":\"1\",\"shopfee\":\"10\",\"goods_id\":\"36\",\"goods_name\":\"尺寸v\",\"goods_num\":\"1\",\"goods_price\":12},{\"SID\":\"1\",\"shopfee\":\"10\",\"goods_id\":\"34\",\"goods_name\":\"dadad\",\"goods_num\":\"3\",\"goods_price\":88},{\"SID\":\"1\",\"shopfee\":\"10\",\"goods_id\":\"35\",\"goods_name\":\"ddddaweaw\",\"goods_num\":\"7\",\"goods_price\":34}]', 1, '2017-09-09 17:11:19', '{\"name\":\"12312\",\"sex\":\"先生\",\"position\":\"啊实打实�\�\",\"phone\":\"asdad312\"}', '2017-09-09 17:11:59', '2017-09-19 23:41:25', 1, 752, '�\�', 5, '未评�\�', '2017-09-19 22:51:31'),
(54, '[{\"SID\":\"1\",\"shopfee\":\"10\",\"goods_id\":\"44\",\"goods_name\":\"牛肉汉堡\",\"goods_num\":\"7\",\"goods_price\":15}]', 1, '2017-09-11 15:03:18', '{\"name\":\"ddffff\",\"sex\":\"先生\",\"position\":\"de\",\"phone\":\"323\"}', '2017-09-11 15:03:43', '2017-09-11 15:38:18', 1, 105, '�\�', 3, 'sdsdsd', '2017-09-18 23:09:28'),
(55, '[{\"SID\":\"1\",\"shopfee\":\"10\",\"goods_id\":\"44\",\"goods_name\":\"牛肉汉堡\",\"goods_num\":\"1\",\"goods_price\":15}]', 1, '2017-09-14 08:48:57', '{\"name\":\"ddffff\",\"sex\":\"先生\",\"position\":\"de\",\"phone\":\"323\"}', '2017-09-14 08:50:21', '2017-09-19 23:22:51', 1, 15, '�\�', 5, '未评�\�', '2017-09-18 22:06:20'),
(56, '[{\"SID\":\"1\",\"shopfee\":\"10\",\"goods_id\":\"44\",\"goods_name\":\"牛肉汉堡\",\"goods_num\":\"8\",\"goods_price\":15}]', 1, '2017-09-19 22:53:47', '{\"name\":\"ddffff\",\"sex\":\"先生\",\"position\":\"dehhh\",\"phone\":\"323\"}', '2017-09-19 22:54:03', '2017-09-19 22:56:08', 1, 120, '加辣', 0, '', '0000-00-00 00:00:00'),
(57, '[{\"SID\":\"1\",\"shopfee\":\"10\",\"goods_id\":\"44\",\"goods_name\":\"牛肉汉堡\",\"goods_num\":\"2\",\"goods_price\":15}]', 1, '2017-09-19 23:46:17', '{\"name\":\"ddffff\",\"sex\":\"先生\",\"position\":\"dehhh\",\"phone\":\"323\"}', '2017-09-19 23:46:30', '2017-09-19 23:46:40', 1, 30, '�\�', 5, '好吃', '2017-09-19 23:48:29');

-- --------------------------------------------------------

--
-- 表的结构 `seller`
--

CREATE TABLE `seller` (
  `seller_id` int(10) NOT NULL,
  `seller_name` char(20) NOT NULL,
  `seller_email` char(20) NOT NULL,
  `seller_password` char(20) NOT NULL,
  `SID` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `seller`
--

INSERT INTO `seller` (`seller_id`, `seller_name`, `seller_email`, `seller_password`, `SID`) VALUES
(1, '', '123@qq.com', '123456', 1),
(2, '', '333@qq.com', '123456', 2);

-- --------------------------------------------------------

--
-- 表的结构 `shop`
--

CREATE TABLE `shop` (
  `SID` int(10) NOT NULL,
  `shopName` varchar(15) CHARACTER SET utf8 NOT NULL,
  `shopImg` text CHARACTER SET utf8 NOT NULL,
  `sellerID` int(10) NOT NULL,
  `ADD` varchar(100) CHARACTER SET utf8 NOT NULL,
  `shopFee` tinyint(4) NOT NULL COMMENT '配送费',
  `license` text CHARACTER SET utf8 NOT NULL,
  `open` tinyint(1) NOT NULL DEFAULT '0' COMMENT '有无开店，1开店 0关店',
  `shopphone` int(11) NOT NULL,
  `shop_class` varchar(450) NOT NULL,
  `min_price` int(10) NOT NULL COMMENT '起送价'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `shop`
--

INSERT INTO `shop` (`SID`, `shopName`, `shopImg`, `sellerID`, `ADD`, `shopFee`, `license`, `open`, `shopphone`, `shop_class`, `min_price`) VALUES
(1, '肯德基宅急�\�', 'img/shop/0/0.png', 1, 'xxxx5dsdsds', 10, '', 1, 123112314, '[\"主食\",\"饮料\",\"小吃\"]', 10),
(2, '我的�\�', '', 2, 'ddxxdxdxd', 3, '', 1, 15611, '[\"主菜\"]', 10),
(3, '老娘舅（湖州师范学院店）', '', 0, '', 5, '', 1, 0, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `UID` int(10) NOT NULL,
  `userName` varchar(10) CHARACTER SET utf8 NOT NULL,
  `Email` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 NOT NULL,
  `ADD` text CHARACTER SET utf8 NOT NULL,
  `img` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`UID`, `userName`, `Email`, `password`, `ADD`, `img`) VALUES
(1, 'ww�\�', '123@qq.com', '123456', '[{\"name\":\"ddffff\",\"sex\":\"先生\",\"position\":\"dehhh\",\"phone\":\"323\"}]', 'img/user/1.png'),
(2, '22222', '333@qq.com', '111111', '', NULL),
(3, 'eee', '321@qq.com', '111111', '', NULL),
(14, '', '', 'root', '', NULL),
(15, '', '', 'root', '', NULL),
(16, '', '3333@qq.com', '123456', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`goods_id`);

--
-- Indexes for table `od`
--
ALTER TABLE `od`
  ADD PRIMARY KEY (`O_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`SID`),
  ADD UNIQUE KEY `shopName` (`shopName`),
  ADD UNIQUE KEY `sellerID` (`sellerID`),
  ADD UNIQUE KEY `ADD` (`ADD`),
  ADD UNIQUE KEY `ADD_2` (`ADD`),
  ADD UNIQUE KEY `shopFee` (`shopFee`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UID`),
  ADD KEY `userName` (`userName`),
  ADD KEY `userName_2` (`userName`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `goods`
--
ALTER TABLE `goods`
  MODIFY `goods_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- 使用表AUTO_INCREMENT `od`
--
ALTER TABLE `od`
  MODIFY `O_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- 使用表AUTO_INCREMENT `seller`
--
ALTER TABLE `seller`
  MODIFY `seller_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `shop`
--
ALTER TABLE `shop`
  MODIFY `SID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `UID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
