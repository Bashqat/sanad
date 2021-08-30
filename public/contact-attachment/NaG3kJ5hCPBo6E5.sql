-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 27, 2021 at 07:47 AM
-- Server version: 5.7.22
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `78_ravinder`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_attachment`
--

CREATE TABLE `contact_attachment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `folder_name` varchar(255) NOT NULL,
  `contact_id` bigint(20) NOT NULL,
  `contact_detail_id` bigint(20) NOT NULL,
  `files` json DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_attachment`
--

INSERT INTO `contact_attachment` (`id`, `folder_name`, `contact_id`, `contact_detail_id`, `files`, `created_at`, `updated_at`) VALUES
(1, 'sdsad', 2, 1, NULL, '2021-08-26 12:52:03', '2021-08-26 12:52:03');

-- --------------------------------------------------------

--
-- Table structure for table `contact_attachment_files`
--

CREATE TABLE `contact_attachment_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `folder_id` bigint(20) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_attachment_files`
--

INSERT INTO `contact_attachment_files` (`id`, `folder_id`, `file_name`, `file_path`, `file_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'custom 3.css', '/work/sanad_new/public/contact-attachment/oqgq7U6ZyAdfFYp.css', 'css', '2021-08-27 05:16:59', '2021-08-27 05:16:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_attachment`
--
ALTER TABLE `contact_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_attachment_files`
--
ALTER TABLE `contact_attachment_files`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_attachment`
--
ALTER TABLE `contact_attachment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_attachment_files`
--
ALTER TABLE `contact_attachment_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
