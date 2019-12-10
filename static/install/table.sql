-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2019-07-23 18:29:28
-- 服务器版本： 5.5.57-log
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xxx`
--

-- --------------------------------------------------------

--
-- 表的结构 `app`
--

CREATE TABLE `app` (
  `id` int(11) NOT NULL,
  `aid` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `bid` varchar(255) DEFAULT NULL,
  `team` varchar(255) DEFAULT NULL,
  `tname` varchar(255) DEFAULT '',
  `ctime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isuse` varchar(10) DEFAULT NULL,
  `msg` varchar(255) DEFAULT 'APP签名已到期，续费请联系QQ或微信：8173816',
  `expdate` datetime DEFAULT NULL,
  `state` varchar(10) DEFAULT '2',
  `d_num` bigint(255) DEFAULT '0',
  `o_num` bigint(255) DEFAULT '0',
  `mark` varchar(255) DEFAULT '新用户',
  `j_url` varchar(255) DEFAULT 'http://app.x77.cx'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `app_device`
--

CREATE TABLE `app_device` (
  `id` int(11) NOT NULL,
  `device` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_admin`
--

CREATE TABLE `prefix_admin` (
  `in_adminid` int(11) NOT NULL,
  `in_adminname` varchar(255) NOT NULL,
  `in_adminpassword` varchar(255) NOT NULL,
  `in_loginip` varchar(255) DEFAULT NULL,
  `in_loginnum` int(11) NOT NULL,
  `in_logintime` datetime DEFAULT NULL,
  `in_islock` int(11) NOT NULL,
  `in_permission` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `prefix_admin`
--

INSERT INTO `prefix_admin` (`in_adminid`, `in_adminname`, `in_adminpassword`, `in_loginip`, `in_loginnum`, `in_logintime`, `in_islock`, `in_permission`) VALUES
(1, 'admin@qq.com', 'e10adc3949ba59abbe56e057f20f883e', '223.152.213.249', 376, '2019-07-23 18:25:21', 0, '1,2,3,4,5,6,7');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_app`
--

CREATE TABLE `prefix_app` (
  `in_id` int(11) NOT NULL,
  `in_uid` int(11) NOT NULL,
  `in_uname` varchar(255) NOT NULL,
  `in_name` varchar(255) NOT NULL,
  `in_bid` varchar(255) DEFAULT NULL,
  `in_mnvs` varchar(255) DEFAULT NULL,
  `in_bsvs` varchar(255) DEFAULT NULL,
  `in_bvs` varchar(255) DEFAULT NULL,
  `in_type` int(11) NOT NULL,
  `in_nick` varchar(255) DEFAULT NULL,
  `in_team` varchar(255) DEFAULT NULL,
  `in_form` varchar(255) DEFAULT NULL,
  `in_icon` varchar(255) DEFAULT NULL,
  `in_app` varchar(255) NOT NULL,
  `in_hits` int(11) NOT NULL,
  `in_yololib` varchar(100) NOT NULL,
  `in_size` bigint(20) NOT NULL,
  `in_kid` int(11) NOT NULL,
  `in_sign` int(11) NOT NULL,
  `in_resign` int(11) NOT NULL,
  `in_link` varchar(255) DEFAULT NULL,
  `in_removead` int(11) NOT NULL,
  `in_highspeed` int(11) NOT NULL,
  `in_addtime` datetime DEFAULT NULL,
  `in_antime` datetime NOT NULL,
  `mails` int(10) NOT NULL DEFAULT '0',
  `shan` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_buylog`
--

CREATE TABLE `prefix_buylog` (
  `in_id` int(11) NOT NULL,
  `in_uid` int(11) NOT NULL,
  `in_uname` varchar(255) NOT NULL,
  `in_title` varchar(255) NOT NULL,
  `in_tid` int(11) NOT NULL,
  `in_money` int(11) NOT NULL,
  `in_lock` int(11) NOT NULL,
  `in_addtime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_cert`
--

CREATE TABLE `prefix_cert` (
  `in_id` int(11) NOT NULL,
  `in_uid` int(10) NOT NULL,
  `in_iden` varchar(255) NOT NULL,
  `in_name` varchar(255) NOT NULL,
  `in_nick` varchar(255) NOT NULL,
  `in_dir` varchar(255) NOT NULL,
  `mima` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `endt` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_key`
--

CREATE TABLE `prefix_key` (
  `in_id` int(11) NOT NULL,
  `in_tid` int(11) NOT NULL,
  `in_code` varchar(255) NOT NULL,
  `in_state` int(11) NOT NULL,
  `in_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_mail`
--

CREATE TABLE `prefix_mail` (
  `in_id` int(11) NOT NULL,
  `in_uid` int(11) NOT NULL,
  `in_ucode` varchar(255) NOT NULL,
  `in_addtime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_paylog`
--

CREATE TABLE `prefix_paylog` (
  `in_id` int(11) NOT NULL,
  `in_uid` int(11) NOT NULL,
  `in_uname` varchar(255) NOT NULL,
  `in_title` varchar(255) NOT NULL,
  `in_points` int(11) NOT NULL,
  `in_money` int(11) NOT NULL,
  `in_lock` int(11) NOT NULL,
  `in_addtime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_plugin`
--

CREATE TABLE `prefix_plugin` (
  `in_id` int(11) NOT NULL,
  `in_name` varchar(255) NOT NULL,
  `in_dir` varchar(255) NOT NULL,
  `in_file` varchar(255) NOT NULL,
  `in_type` int(11) NOT NULL,
  `in_author` varchar(255) DEFAULT NULL,
  `in_address` varchar(255) DEFAULT NULL,
  `in_addtime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_salt`
--

CREATE TABLE `prefix_salt` (
  `in_id` int(11) NOT NULL,
  `in_aid` int(11) NOT NULL,
  `in_salt` varchar(255) NOT NULL,
  `in_time` int(11) NOT NULL,
  `ua` varchar(10000) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `dizhi` varchar(10000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_secret`
--

CREATE TABLE `prefix_secret` (
  `in_id` int(11) NOT NULL,
  `in_site` varchar(255) NOT NULL,
  `in_md5` varchar(255) NOT NULL,
  `in_endtime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_sign`
--

CREATE TABLE `prefix_sign` (
  `in_id` int(11) NOT NULL,
  `in_uid` int(11) DEFAULT NULL,
  `in_aid` int(11) NOT NULL,
  `in_aname` varchar(255) DEFAULT NULL,
  `in_newaname` varchar(100) NOT NULL,
  `in_replace` varchar(255) DEFAULT NULL,
  `in_suo` varchar(255) DEFAULT NULL,
  `in_ssl` varchar(255) NOT NULL,
  `in_site` varchar(255) NOT NULL,
  `in_path` varchar(255) NOT NULL,
  `in_ipa` varchar(255) NOT NULL,
  `in_yololib` varchar(100) NOT NULL,
  `in_status` int(11) NOT NULL,
  `in_cert` varchar(255) NOT NULL,
  `in_time` int(11) NOT NULL,
  `in_qianci` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_signlog`
--

CREATE TABLE `prefix_signlog` (
  `in_id` int(11) NOT NULL,
  `in_aid` int(11) NOT NULL,
  `in_aname` varchar(255) NOT NULL,
  `in_uid` int(11) NOT NULL,
  `in_uname` varchar(255) NOT NULL,
  `in_status` int(11) NOT NULL,
  `in_step` varchar(255) NOT NULL,
  `in_percent` int(11) NOT NULL,
  `in_cert` varchar(255) NOT NULL,
  `in_nick` varchar(100) NOT NULL,
  `in_addtime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_user`
--

CREATE TABLE `prefix_user` (
  `in_userid` int(11) NOT NULL,
  `in_username` varchar(255) NOT NULL,
  `in_userpassword` varchar(255) NOT NULL,
  `in_nick` varchar(255) DEFAULT NULL,
  `in_card` varchar(255) DEFAULT NULL,
  `in_mobile` varchar(255) DEFAULT NULL,
  `in_qq` varchar(255) DEFAULT NULL,
  `in_firm` varchar(255) DEFAULT NULL,
  `in_job` varchar(255) DEFAULT NULL,
  `in_regdate` datetime DEFAULT NULL,
  `in_loginip` varchar(255) DEFAULT NULL,
  `in_logintime` datetime DEFAULT NULL,
  `in_verify` int(11) NOT NULL,
  `in_islock` int(11) NOT NULL,
  `in_points` int(11) NOT NULL,
  `in_spaceuse` bigint(20) NOT NULL,
  `in_spacetotal` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `prefix_user`
--

INSERT INTO `prefix_user` (`in_userid`, `in_username`, `in_userpassword`, `in_nick`, `in_card`, `in_mobile`, `in_qq`, `in_firm`, `in_job`, `in_regdate`, `in_loginip`, `in_logintime`, `in_verify`, `in_islock`, `in_points`, `in_spaceuse`, `in_spacetotal`) VALUES
(1, 'admin@qq.com', '49ba59abbe56e057', '', NULL, NULL, NULL, NULL, NULL, '2019-07-23 18:10:23', '218.5.128.161', '2019-07-23 18:24:28', 0, 0, 10000000, 111113444684, 999999999999999);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app`
--
ALTER TABLE `app`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_device`
--
ALTER TABLE `app_device`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prefix_admin`
--
ALTER TABLE `prefix_admin`
  ADD PRIMARY KEY (`in_adminid`);

--
-- Indexes for table `prefix_app`
--
ALTER TABLE `prefix_app`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_buylog`
--
ALTER TABLE `prefix_buylog`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_cert`
--
ALTER TABLE `prefix_cert`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_key`
--
ALTER TABLE `prefix_key`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_mail`
--
ALTER TABLE `prefix_mail`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_paylog`
--
ALTER TABLE `prefix_paylog`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_plugin`
--
ALTER TABLE `prefix_plugin`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_salt`
--
ALTER TABLE `prefix_salt`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_secret`
--
ALTER TABLE `prefix_secret`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_sign`
--
ALTER TABLE `prefix_sign`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_signlog`
--
ALTER TABLE `prefix_signlog`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_user`
--
ALTER TABLE `prefix_user`
  ADD PRIMARY KEY (`in_userid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `app`
--
ALTER TABLE `app`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `app_device`
--
ALTER TABLE `app_device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `prefix_admin`
--
ALTER TABLE `prefix_admin`
  MODIFY `in_adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `prefix_app`
--
ALTER TABLE `prefix_app`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `prefix_buylog`
--
ALTER TABLE `prefix_buylog`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `prefix_cert`
--
ALTER TABLE `prefix_cert`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `prefix_key`
--
ALTER TABLE `prefix_key`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `prefix_mail`
--
ALTER TABLE `prefix_mail`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- 使用表AUTO_INCREMENT `prefix_paylog`
--
ALTER TABLE `prefix_paylog`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- 使用表AUTO_INCREMENT `prefix_plugin`
--
ALTER TABLE `prefix_plugin`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `prefix_salt`
--
ALTER TABLE `prefix_salt`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `prefix_secret`
--
ALTER TABLE `prefix_secret`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `prefix_sign`
--
ALTER TABLE `prefix_sign`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `prefix_signlog`
--
ALTER TABLE `prefix_signlog`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `prefix_user`
--
ALTER TABLE `prefix_user`
  MODIFY `in_userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
