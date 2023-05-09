-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2023 at 03:46 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coreteam+`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `is_active` int(1) NOT NULL COMMENT '0=tidak aktif, 1=aktif',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fic_assistant`
--

CREATE TABLE `fic_assistant` (
  `id_fic_assistant` int(11) NOT NULL,
  `id_inspeksi` int(11) NOT NULL,
  `fic_assistant` int(11) NOT NULL COMMENT 'id_user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inspeksi`
--

CREATE TABLE `inspeksi` (
  `id_inspeksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_inspeksi` datetime NOT NULL,
  `shift` int(1) NOT NULL COMMENT '0. pagi, 1. siang, 2. malam',
  `fire_incident_commander` int(11) NOT NULL COMMENT 'id_user',
  `fuel_level` int(3) NOT NULL COMMENT 'persentase',
  `kode_inspeksi` varchar(10) NOT NULL,
  `attachment` varchar(50) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inspeksi_detail`
--

CREATE TABLE `inspeksi_detail` (
  `id_inspeksi_detail` int(11) NOT NULL,
  `id_inspeksi` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `conditions` int(1) NOT NULL COMMENT '0. n/a, 1. damage, 2. good'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` int(11) NOT NULL,
  `id_subcategory` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `qty` varchar(50) NOT NULL,
  `is_active` int(1) NOT NULL COMMENT '0=tidak aktif, 1=aktif',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id_subcategory` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `subcategory` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_active` int(1) NOT NULL COMMENT '0=tidak aktif, 1=aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(1) NOT NULL COMMENT '0=SuperAdmin, 1=User, 2=Spectator',
  `status` int(1) NOT NULL COMMENT '0=Assistant, 1=Commander',
  `is_active` int(1) NOT NULL COMMENT '0=tidak aktif, 1=aktif',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `fic_assistant`
--
ALTER TABLE `fic_assistant`
  ADD PRIMARY KEY (`id_fic_assistant`);

--
-- Indexes for table `inspeksi`
--
ALTER TABLE `inspeksi`
  ADD PRIMARY KEY (`id_inspeksi`);

--
-- Indexes for table `inspeksi_detail`
--
ALTER TABLE `inspeksi_detail`
  ADD PRIMARY KEY (`id_inspeksi_detail`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id_subcategory`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fic_assistant`
--
ALTER TABLE `fic_assistant`
  MODIFY `id_fic_assistant` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inspeksi`
--
ALTER TABLE `inspeksi`
  MODIFY `id_inspeksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inspeksi_detail`
--
ALTER TABLE `inspeksi_detail`
  MODIFY `id_inspeksi_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id_subcategory` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
