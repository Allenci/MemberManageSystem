-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2017-08-20 17:12:55
-- 伺服器版本: 10.1.21-MariaDB
-- PHP 版本： 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;


--
-- 資料庫： `pet_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- 資料表的匯出資料 `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(13, 'C++'),
(14, 'PHP'),
(16, 'JavaScriptTT'),
(17, 'Python'),
(18, 'C#'),
(19, 'CSS'),
(20, 'é£Ÿ'),
(21, 'è¡£'),
(22, 'ä½'),
(23, 'è¡Œ'),
(25, 'è»Šå­');

-- --------------------------------------------------------

--
-- 資料表結構 `comment`
--

CREATE TABLE `comment` (
  `comment` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `comment`
--

INSERT INTO `comment` (`comment`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(0, 10, 'Allen', 'This kljfal; k', 'asdfasdfa sd', 'asdfadf', '2017-07-17');

-- --------------------------------------------------------

--
-- 資料表結構 `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `user_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `historytime` datetime NOT NULL,
  `action` varchar(255) CHARACTER SET utf8 NOT NULL,
  `errorpassword` varchar(20) CHARACTER SET utf8 NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `history`
--

INSERT INTO `history` (`id`, `userid`, `user_name`, `historytime`, `action`, `errorpassword`, `ip`) VALUES
(69, 11, 'admin', '2017-08-08 14:29:31', '登入成功', '', '36.233.15.130'),
(68, 0, 'admin', '2017-08-08 14:29:25', '帳號密碼錯誤', '', '36.233.15.130'),
(67, 11, 'admin', '2017-08-02 10:42:03', '登入成功', '', '36.232.142.153'),
(66, 26, 'test11', '2017-08-02 10:41:45', '登入成功', '', '36.232.142.153'),
(65, 26, 'test11', '2017-08-02 10:39:40', '登入成功', '', '36.232.142.153'),
(64, 26, 'test11', '2017-08-02 10:39:23', '登入成功', '', '36.232.142.153'),
(63, 26, 'test11', '2017-08-02 10:31:49', '登入成功', '', '36.232.142.153'),
(62, 26, 'test11', '2017-08-02 10:31:48', '登入成功', '', '36.232.142.153'),
(61, 26, 'test11', '2017-08-02 10:31:47', '登入成功', '', '36.232.142.153'),
(60, 26, 'test11', '2017-08-02 10:21:33', '登入成功', '', '36.232.142.153'),
(59, 26, 'test11', '2017-08-02 10:21:12', '登入成功', '', '36.232.142.153'),
(58, 26, 'test11', '2017-08-02 10:21:07', '登入成功', '', '36.232.142.153'),
(57, 11, 'admin', '2017-08-02 10:20:53', '登入成功', '', '36.232.142.153'),
(56, 11, 'admin', '2017-08-02 10:20:14', '登入成功', '', '36.232.142.153'),
(55, 11, 'admin', '2017-08-02 10:20:07', '登入成功', '', '36.232.142.153'),
(54, 0, 'test11', '2017-08-02 10:10:07', '註冊', '', '36.232.142.153'),
(53, 0, 'test10', '2017-08-02 10:08:59', '註冊', '', '');

-- --------------------------------------------------------

--
-- 資料表結構 `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(16, 16, 'TITLE HEWE HELLEN', 'Allen', '2017-08-20', 'Koala.jpg', 'sdfjkhajkfhieriowueoriuweor	fgfgfgf																	', 'LLLL', 4, 'OK', 0),
(17, 14, 'æ–‡ç« æ¨™é¡Œ', 'Allen', '2017-08-20', 'Penguins.jpg', '			å¥½å¯æ„›çš„ä¼éµ		', 'å‹•ç‰©', 4, 'OK', 0),
(18, 14, 'æ–°èžç¨¿1', 'Allen', '2017-08-20', 'Desert.jpg', 'å¥½ç†±   éžå¸¸ç†±', 'æ²™æ¼ ', 4, 'OK', 0),
(19, 16, 'æ–°èžç¨¿2', 'ä½œè€…', '2017-08-20', 'Hydrangeas.jpg', 'èŠ±  ç¾Žéº—  æ¼‚äº® ', 'flower', 4, 'OK', 0),
(20, 16, 'ä»Šå¤©æ˜ŸæœŸä¸€ä¸æƒ³ä¸Šèª² :((', 'Allen', '2017-08-20', '313.jpg', 'æ‹šé‡‘eurpiouwqporupqowrupoqwuiropqwiuer', 'ä¸Šèª², è·è¨“', 4, 'OK', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `user_level` varchar(11) CHARACTER SET utf8 NOT NULL,
  `user_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `user_password` varchar(70) CHARACTER SET utf8 NOT NULL,
  `user_email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_realname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_phone` varchar(20) CHARACTER SET utf8 NOT NULL,
  `sign_up_date` datetime NOT NULL,
  `user_login_count` int(11) NOT NULL,
  `state` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`id`, `user_level`, `user_name`, `user_password`, `user_email`, `user_address`, `user_realname`, `user_phone`, `sign_up_date`, `user_login_count`, `state`) VALUES
(59, 'admin', 'admin', '25d55ad283aa400af464c76d713c07ad', 'kk@gmail.com', '', 'Allen', '0912345678', '2017-08-19 19:46:22', 10, ''),
(22, 'user', 'Alice', '25d55ad283aa400af464c76d713c07ad', 'kk@gmail.com', '', 'Allen12', '0912345678', '2017-08-24 00:00:00', 1, ''),
(8, 'host', 'host777', '12345678', '123@gmail.com', '', '店家二號', '0911222222', '2017-08-01 10:15:26', 0, ''),
(10, 'user', 'user01', '12345678', '123@gmail.com', '', 'user', '0911111111', '2017-08-01 10:20:41', 0, ''),
(17, 'user', 'test02', '12345678', '123@gmail.com', '', 'test', '0911111111', '2017-08-02 09:03:12', 0, '');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- 資料表索引 `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- 使用資料表 AUTO_INCREMENT `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- 使用資料表 AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- 使用資料表 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
