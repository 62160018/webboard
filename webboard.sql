-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 08, 2022 at 03:38 PM
-- Server version: 5.7.33
-- PHP Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `board_main`
--

CREATE TABLE `board_main` (
  `bm_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `bm_title` varchar(200) NOT NULL,
  `bm_detail` longtext NOT NULL,
  `cg_id` int(11) DEFAULT NULL,
  `bm_img` varchar(200) DEFAULT NULL,
  `bm_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `board_sub`
--

CREATE TABLE `board_sub` (
  `bs_id` int(11) NOT NULL,
  `bm_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `bs_detail` varchar(200) NOT NULL,
  `bs_img` varchar(200) DEFAULT NULL,
  `bs_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cg_id` int(11) NOT NULL,
  `cg_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `email` varchar(20) NOT NULL UNIQUE,
  `fullname` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `img` varchar(200) DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT '0' COMMENT '0 = member\r\n1 = admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`u_id`, `email`, `fullname`, `password`, `img`, `type`) VALUES
(1, 'admin@admin.com', 'Admin Srisamorn', '$2y$10$8qn2phEuDuXoPq257QxG9Og046KhIsQf/SZSX.hL4OXBTro.C8vu.', '35554b61ac86daf3ba8e0470d8033742.jpg', 1);
--
-- Indexes for dumped tables
--

--
-- Indexes for table `board_main`
--
ALTER TABLE `board_main`
  ADD PRIMARY KEY (`bm_id`);

--
-- Indexes for table `board_sub`
--
ALTER TABLE `board_sub`
  ADD PRIMARY KEY (`bs_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `board_main`
--
ALTER TABLE `board_main`
  MODIFY `bm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `board_sub`
--
ALTER TABLE `board_sub`
  MODIFY `bs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
