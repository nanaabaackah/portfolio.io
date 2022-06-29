-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: mysql.immortalfyre.com
-- Generation Time: May 20, 2021 at 12:57 PM
-- Server version: 5.7.28-log
-- PHP Version: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scheduling_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `website_users`
--

DROP TABLE IF EXISTS `website_users`;
CREATE TABLE `website_users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `website_sheets`
--

DROP TABLE IF EXISTS `website_sheets`;
CREATE TABLE `website_sheets` (
  `sheet_id` int(11) NOT NULL,
  `sheet_name` varchar(64) NOT NULL,
  `num_of_slots` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `website_users` 
    ADD PRIMARY KEY (`user_id`),
    ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `website_sheets` 
    ADD PRIMARY KEY (`sheet_id`);

ALTER TABLE `website_users`
    MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `website_sheets`
    MODIFY `sheet_id` int(11) NOT NULL AUTO_INCREMENT;