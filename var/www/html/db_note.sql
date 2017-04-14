-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2015 at 07:35 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_note`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`admin_id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` enum('default','admin','owner') NOT NULL DEFAULT 'default',
  `datetime` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `user_id` int(11) NOT NULL,
`category_id` int(11) NOT NULL,
  `category_name` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `date_add` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`user_id`, `category_id`, `category_name`, `description`, `date_add`, `date_modified`) VALUES
(38, 19, 'T&ecirc;n 2', 'Name 2', '2015-04-08 08:14:14', '2015-04-09 11:04:18'),
(0, 20, 'T&ecirc;n 3', '', '2015-04-08 08:36:34', '2015-04-08 08:36:34'),
(0, 22, 'T&ecirc;n 4', '', '2015-04-08 10:32:58', '2015-04-08 10:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `user_id` int(11) NOT NULL,
`post_id` int(11) NOT NULL,
  `post_title` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `post_content` text COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `date_add` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`user_id`, `post_id`, `post_title`, `post_content`, `category_id`, `tag_id`, `date_add`, `date_modified`, `status`) VALUES
(38, 1, 'title 3', '&amp;lt;ol&amp;gt;&amp;lt;li&amp;gt;&amp;lt;h2&amp;gt;&amp;lt;strong&amp;gt;&amp;lt;em&amp;gt;&amp;lt;span style=&amp;quot;color: #61BD6D;&amp;quot;&amp;gt;Title&amp;lt;/span&amp;gt;&amp;lt;/em&amp;gt;&amp;lt;/strong&amp;gt;&amp;lt;/h2&amp;gt;&amp;lt;/li&amp;gt;&amp;lt;li&amp;gt;&amp;lt;h2&amp;gt;&amp;lt;strong&amp;gt;&amp;lt;em&amp;gt;&amp;lt;span style=&amp;quot;color: #61BD6D;&amp;quot;&amp;gt;Post&amp;lt;/span&amp;gt;&amp;lt;/em&amp;gt;&amp;lt;/strong&amp;gt;&amp;lt;/h2&amp;gt;&amp;lt;/li&amp;gt;&amp;lt;/ol&amp;gt;', 19, 1, '2015-04-29 04:14:52', '2015-04-29 04:14:52', 1),
(0, 2, 'title 2', '&amp;lt;p&amp;gt;content&amp;lt;/p&amp;gt;', 0, 1, '2015-04-10 10:34:01', '2015-04-10 10:34:01', 1),
(0, 5, 'title 1', '&amp;lt;ol&amp;gt;&amp;lt;li&amp;gt;&amp;lt;h2&amp;gt;&amp;lt;strong&amp;gt;&amp;lt;em&amp;gt;&amp;lt;span style=&amp;quot;color: #61BD6D;&amp;quot;&amp;gt;Title&amp;lt;/span&amp;gt;&amp;lt;/em&amp;gt;&amp;lt;/strong&amp;gt;&amp;lt;/h2&amp;gt;&amp;lt;/li&amp;gt;&amp;lt;li&amp;gt;&amp;lt;h2&amp;gt;&amp;lt;strong&amp;gt;&amp;lt;em&amp;gt;&amp;lt;span style=&amp;quot;color: #61BD6D;&amp;quot;&amp;gt;Content&amp;lt;/span&amp;gt;&amp;lt;/em&amp;gt;&amp;lt;/strong&amp;gt;&amp;lt;/h2&amp;gt;&amp;lt;/li&amp;gt;&amp;lt;/ol&amp;gt;', 19, 1, '2015-04-11 09:52:22', '2015-04-11 09:52:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `user_id` int(11) NOT NULL,
`tag_id` int(11) NOT NULL,
  `tag_name` tinytext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`user_id`, `tag_id`, `tag_name`) VALUES
(38, 1, 'post'),
(0, 2, 'cat'),
(0, 4, 'tag');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `username` varchar(25) NOT NULL,
  `fullname` varchar(256) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
 ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
 ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
