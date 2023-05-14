-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2023 at 04:15 AM
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
-- Database: `coreteam`
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

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `category`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Fire Truck', 1, '2023-05-10 04:25:51', '2023-05-10 04:25:51'),
(2, 'Rescue Car', 1, '2023-05-10 04:25:51', '2023-05-10 04:25:51'),
(3, 'Rescue Boat', 1, '2023-05-10 04:25:51', '2023-05-10 04:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `fic_assistant`
--

CREATE TABLE `fic_assistant` (
  `id_fic_assistant` int(11) NOT NULL,
  `id_inspeksi` int(11) NOT NULL,
  `fic_assistant` int(11) NOT NULL COMMENT 'id_user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fic_assistant`
--

INSERT INTO `fic_assistant` (`id_fic_assistant`, `id_inspeksi`, `fic_assistant`) VALUES
(3, 2, 5),
(16, 1, 5),
(17, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `inspeksi`
--

CREATE TABLE `inspeksi` (
  `id_inspeksi` int(11) NOT NULL,
  `inspected_by` int(11) NOT NULL,
  `tgl_inspeksi` datetime NOT NULL,
  `shift` int(1) NOT NULL COMMENT '0. pagi, 1. siang, 2. malam',
  `fire_incident_commander` int(11) NOT NULL COMMENT 'id_user',
  `fuel_level` int(3) NOT NULL COMMENT 'persentase',
  `kode_inspeksi` varchar(10) NOT NULL,
  `attachment` varchar(50) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspeksi`
--

INSERT INTO `inspeksi` (`id_inspeksi`, `inspected_by`, `tgl_inspeksi`, `shift`, `fire_incident_commander`, `fuel_level`, `kode_inspeksi`, `attachment`, `remark`, `created_at`, `updated_at`, `id_category`) VALUES
(1, 1, '2023-05-13 17:16:00', 1, 2, 90, 'FT-0000001', 'tentang.PNG', 'image napis', '2023-05-13 17:21:10', '2023-05-14 07:44:09', 1),
(2, 1, '2023-05-13 17:21:00', 1, 3, 12, 'FT-0000002', 'polije.png', 'test', '2023-05-13 17:22:37', '0000-00-00 00:00:00', 1);

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

--
-- Dumping data for table `inspeksi_detail`
--

INSERT INTO `inspeksi_detail` (`id_inspeksi_detail`, `id_inspeksi`, `id_item`, `conditions`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 1),
(3, 1, 3, 0),
(4, 1, 4, 2),
(5, 1, 5, 2),
(6, 1, 6, 2),
(7, 1, 7, 2),
(8, 1, 8, 2),
(9, 1, 9, 2),
(10, 1, 10, 2),
(11, 1, 11, 2),
(12, 1, 12, 2),
(13, 1, 13, 2),
(14, 1, 14, 2),
(15, 1, 15, 2),
(16, 1, 16, 2),
(17, 1, 17, 2),
(18, 1, 18, 2),
(19, 1, 19, 2),
(20, 1, 20, 2),
(21, 1, 21, 2),
(22, 1, 22, 2),
(23, 1, 23, 2),
(24, 1, 24, 2),
(25, 1, 25, 2),
(26, 1, 26, 2),
(27, 1, 27, 2),
(28, 1, 28, 2),
(29, 1, 29, 2),
(30, 1, 30, 2),
(31, 1, 31, 2),
(32, 1, 32, 2),
(33, 1, 33, 1),
(34, 1, 34, 1),
(35, 1, 35, 1),
(36, 1, 36, 0),
(37, 1, 37, 0),
(38, 1, 38, 0),
(39, 1, 39, 2),
(40, 1, 40, 2),
(41, 1, 41, 2),
(42, 1, 42, 2),
(43, 1, 43, 2),
(44, 1, 44, 2),
(45, 1, 45, 2),
(46, 1, 46, 2),
(47, 1, 47, 1),
(48, 1, 48, 1),
(49, 1, 49, 1),
(50, 1, 50, 1),
(51, 1, 51, 1),
(52, 1, 52, 1),
(53, 1, 53, 1),
(54, 1, 54, 1),
(55, 1, 55, 1),
(56, 1, 56, 1),
(57, 1, 57, 1),
(58, 1, 58, 1),
(59, 1, 59, 1),
(60, 1, 60, 1),
(61, 1, 61, 1),
(62, 1, 62, 1),
(63, 1, 63, 1),
(64, 1, 64, 1),
(65, 1, 65, 1),
(66, 1, 66, 1),
(67, 1, 67, 1),
(68, 1, 68, 1),
(69, 1, 69, 1),
(70, 1, 70, 1),
(71, 1, 71, 1),
(72, 1, 72, 1),
(73, 1, 73, 1),
(74, 1, 74, 1),
(75, 1, 75, 1),
(76, 1, 76, 1),
(77, 1, 77, 1),
(78, 1, 78, 1),
(79, 1, 79, 1),
(80, 1, 80, 1),
(81, 1, 81, 1),
(82, 1, 82, 1),
(83, 2, 1, 2),
(84, 2, 2, 2),
(85, 2, 3, 2),
(86, 2, 4, 2),
(87, 2, 5, 2),
(88, 2, 6, 2),
(89, 2, 7, 2),
(90, 2, 8, 2),
(91, 2, 9, 2),
(92, 2, 10, 2),
(93, 2, 11, 2),
(94, 2, 12, 1),
(95, 2, 13, 1),
(96, 2, 14, 1),
(97, 2, 15, 1),
(98, 2, 16, 1),
(99, 2, 17, 1),
(100, 2, 18, 1),
(101, 2, 19, 1),
(102, 2, 20, 1),
(103, 2, 21, 1),
(104, 2, 22, 1),
(105, 2, 23, 1),
(106, 2, 24, 1),
(107, 2, 25, 1),
(108, 2, 26, 1),
(109, 2, 27, 1),
(110, 2, 28, 1),
(111, 2, 29, 1),
(112, 2, 30, 1),
(113, 2, 31, 1),
(114, 2, 32, 1),
(115, 2, 33, 0),
(116, 2, 34, 0),
(117, 2, 35, 0),
(118, 2, 36, 2),
(119, 2, 37, 2),
(120, 2, 38, 2),
(121, 2, 39, 1),
(122, 2, 40, 1),
(123, 2, 41, 1),
(124, 2, 42, 1),
(125, 2, 43, 1),
(126, 2, 44, 1),
(127, 2, 45, 1),
(128, 2, 46, 1),
(129, 2, 47, 2),
(130, 2, 48, 2),
(131, 2, 49, 2),
(132, 2, 50, 2),
(133, 2, 51, 2),
(134, 2, 52, 2),
(135, 2, 53, 2),
(136, 2, 54, 2),
(137, 2, 55, 2),
(138, 2, 56, 2),
(139, 2, 57, 2),
(140, 2, 58, 2),
(141, 2, 59, 2),
(142, 2, 60, 2),
(143, 2, 61, 2),
(144, 2, 62, 2),
(145, 2, 63, 2),
(146, 2, 64, 2),
(147, 2, 65, 2),
(148, 2, 66, 2),
(149, 2, 67, 2),
(150, 2, 68, 2),
(151, 2, 69, 2),
(152, 2, 70, 2),
(153, 2, 71, 2),
(154, 2, 72, 2),
(155, 2, 73, 2),
(156, 2, 74, 2),
(157, 2, 75, 2),
(158, 2, 76, 2),
(159, 2, 77, 2),
(160, 2, 78, 2),
(161, 2, 79, 2),
(162, 2, 80, 2),
(163, 2, 81, 2),
(164, 2, 82, 2);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` int(11) NOT NULL,
  `id_subcategory` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `qty` varchar(50) DEFAULT NULL,
  `is_active` int(1) NOT NULL COMMENT '0=tidak aktif, 1=aktif',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `id_subcategory`, `item`, `qty`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'ENGINE OIL LEVEL', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(2, 1, 'COOLANT LEVEL', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(3, 1, 'BRAKE FLUID', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(4, 1, 'POWER STEERING FLUID', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(5, 1, 'BATTERY', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(6, 1, 'RADIATOR AND HOSE', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(7, 1, 'EXHAUST SYSTEM', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(8, 1, 'AIR SYSTEM', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(9, 1, 'LOW PRESSURE WARNING', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(10, 1, 'VEHICLE EXTERIOR', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(11, 1, 'TIRES', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(12, 2, 'HORN', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(13, 2, 'WIPERS', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(14, 2, 'MIRRORS', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(15, 2, 'HEADLIGHTS', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(16, 2, 'TAILLIGHTS', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(17, 2, 'TURN SIGNALS', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(18, 2, 'LICENSE LIGHTS', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(19, 2, 'BRAKE LIGHTS', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(20, 2, 'PARKING BRAKE', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(21, 2, 'LIGHT BAR', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(22, 2, 'EMERGENCY FLASHER', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(23, 2, 'WORK LIGHT', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(24, 2, 'GAUGES', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(25, 2, '2 - WAY RADIO', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(26, 2, 'AC', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(27, 2, 'WINDOW WASHER', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(28, 2, 'WINDOWS', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(29, 2, 'SEATBELTS', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(30, 2, 'START ENGINE & WARM UP 15 MENIT', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(31, 2, 'OPERATING CLUTCH', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(32, 2, 'OPERATING GEAR STICK', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(33, 3, 'CORRECT OPERATING BRAKE', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(34, 3, 'STEERING OPERATION', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(35, 3, 'RUNNING TEST 3 KM', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(36, 4, 'FLARES / REFLECTORS  ', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(37, 4, 'JACK', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(38, 4, 'WHEEL CHOCKS', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(39, 5, 'MAIN PUMP', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(40, 5, 'HIGH PRESSURE PUMP', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(41, 5, 'WATER TANK, Correct level (4.000 Ltrs)', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(42, 5, 'FOAM TANK, Correct level (500 Ltrs)', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(43, 5, 'ALCO FOAM / WATER MONITOR', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(44, 5, 'HOSE REEL, (2 X 30 Mtrs)', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(45, 5, 'DRY CHEMICAL  UNIT, 250 Kgs, Hose : 2 x 15 Mtrs', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(46, 5, 'CO2 Unit, 100 Kgs, Hose : 50 Mtrs', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(47, 6, 'METAL FIRE BROOM, Qty : 2 Sets', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(48, 6, 'FIRE HOOK, Qty : 1 Set', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(49, 6, 'FIRE CROW BAR, Qty : 1 Set', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(50, 6, 'BOLT CUTTER, Qty : 1 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(51, 6, 'FLAT SHOVEL, Qty : 2 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(52, 6, 'HYDRANT WRENCH, Qty : 2 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(53, 6, 'FIRE SUIT, Qty : 8 Sets', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(54, 6, 'FIRE HELMET, Qty : 8 Sets', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(55, 6, 'FIRE GLOVE, Qty : 8 Sets', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(56, 6, 'FIRE BOOT, Qty : 8 Sets', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(57, 6, 'SCBA,Qty :  6 Sets', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(58, 6, 'FIRST AID KIT,Qty : 1 Set', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(59, 6, 'FIRE HOSE 2,5\" MACHINO, Qty : 2 Rolls', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(60, 6, 'FIRE HOSE 2,5 \" THREAD, Qty : 6 Rolls', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(61, 6, 'FIRE HOSE 1,5\" THREAD, Qty : 8 Rolls', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(62, 6, 'SUCTION HOSE HARD TYPE, 5\" X 2.5 M, Qty : 4 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(63, 6, 'SUCTION STRAINER, Qty :1 Set', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(64, 6, 'SUCTION WRENCH, Qty : 2 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(65, 6, 'PORTABLE GROUND MONITOR, Qty : 1 Set', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(66, 6, 'RAPID ATTACK PISTOL COMPLETE, Qty : 1 Set', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(67, 6, 'EXTENSION LADDER ALUMUNIUM ( 2 section ), Qty : 1 Set', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(68, 6, 'PORTABLE VENTILATION, Qty : 1 Unit', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(69, 6, 'PORTABLE GENERATOR SET, Qty : 1 Unit', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(70, 6, 'ALUMUNIUM HOSE BRIDGE, Qty : 2 Sets', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(71, 6, 'COMBIE CUTTER SET, Qty : 1 Set', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(72, 6, 'NOZZLE 1,5\' AKRON, Qty : 4 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(73, 6, 'SAFETY CONE, Qty : 4 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(74, 6, 'BA BOARD, Qty : 1 Set', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(75, 6, 'PORTABLE SEARCH LIGHT, Qty : 2 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(76, 6, 'CABLE ROLLS, Qty : 1 Roll', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(77, 6, 'Y PIECY, Qty : 2 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(78, 6, 'DECONTAMINATION SET : 1 Set', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(79, 6, 'CHEMICAL SUITE : 10 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(80, 6, 'PLASTIC SHOVEL : 5 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(81, 6, 'TRIPOD SALLA, Qty :1 Set', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(82, 6, 'EMERGENCY LAMP, Qty : 2 Set', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(83, 7, 'OIL LEVEL', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(84, 7, 'COOLANT LEVEL', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(85, 7, 'BATTERY', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(86, 7, 'START ENGINE & WARM UP', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(87, 7, 'STARTING SYSTEM', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(88, 8, 'CHECK OIL LEAKAGE', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(89, 8, 'OPERATING CLUTCH', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(90, 8, 'OPERATING GEAR STICK', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(91, 8, 'OPERATING BRAKE', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(92, 8, 'PARKING BRAKE', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(93, 8, 'STEERING OPERATION', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(94, 9, 'SIGN LIGHTS', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(95, 9, 'HEAD LIGHTS', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(96, 9, 'ALL INDICATOR LIGHTS', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(97, 9, 'BRAKE LIGHTS', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(98, 9, 'SIREN & ROTARY LAMP', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(99, 9, 'WIPPER WASHER OPERATION', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(100, 9, 'RADIO GM 300 & ANTENA', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(101, 9, 'AC', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(102, 10, 'FULL BODY HARNESS, 8 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(103, 10, 'CARABINER, 25 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(104, 10, 'JUMAR, 2 Pairs', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(105, 10, 'WEBBING, 10 Rolls', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(106, 10, 'STATIC ROPE 50 m (11mm), 2 Rolls', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(107, 10, 'STATIC ROPE 100 m (11mm), 2 Rolls', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(108, 10, 'I\'D (decender/belay device), 3 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(109, 10, 'SINGLE PULLEY, 4 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(110, 10, 'DOUBLE PULLEY, 3 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(111, 10, 'CROLL CHEST, 2 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(112, 10, 'GRIGRI, 1 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(113, 10, 'ROLLER, 2 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(114, 10, 'CLIMBING HELMET, 8 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(115, 10, 'MOBILE FALL ARRESTER, 2 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(116, 10, 'PRO TRAXION, 1 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(117, 10, 'LINE YARD, 8 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(118, 10, 'SEWN SLING, 8 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(119, 10, 'MULTIPLE ANCHOR, 1 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(120, 10, 'LIFE JACKET, 8 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(121, 10, 'EMERGENCY LAMP, 1 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(122, 10, 'KED, 1 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(123, 10, 'NECK COLLAR, 2 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(124, 10, 'FIRST AID KIT BAG, 1 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(125, 11, 'MINI BOOM, 5 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(126, 11, 'ABSORBENT, 1 Box', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(127, 11, 'FACE SHIELD, 4 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(128, 11, 'SAFETY GOOGLES, 4 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(129, 11, 'FULL FACE MASK, 4 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(130, 11, 'CHEMICAL GLOVE, 8 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(131, 11, 'FULL CHEMICAL SUITE, 4 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(132, 11, 'CHEMICAL SHOES, 8 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(133, 11, 'RAIN COAT, 8 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(134, 11, 'PLASTIC SACK, 1 Pack', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(135, 11, 'WARNING TAPE, 2 Rolls', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(136, 11, 'MSDS SHEETS, 1 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(137, 12, 'FIRE EXTINGUISHER 4,5 Kg, 2 Cylinders', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(138, 12, 'NOZZLE 1,5\" AKRON, 2 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(139, 12, 'HYDRANT WRENCH, 1 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(140, 12, 'AXE, 1 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(141, 12, 'BAR, 1 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(142, 12, 'BOLT CUTTER, 1 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(143, 12, 'SNAKE HOLDER, 2 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(144, 12, 'HAMMER, 1 Ea', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(145, 13, 'Running engine 10 menit', '', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(146, 13, 'Anchor and 20 meters rope', '1 set', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(147, 13, 'Ropes 20 meters', '2 Rolls', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(148, 13, 'Life jacket', '6 ea', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(149, 13, 'Ring buoy', '2 ea', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(150, 13, 'Oar stick', '2 ea', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(151, 13, 'Drain water plug', '2 ea', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(152, 13, 'Propeller', '1 set', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(153, 13, 'Trailer', '1 unit', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00'),
(154, 13, 'Fire Extinguisher', '1 pc', 1, '2023-05-10 04:44:00', '0000-00-00 00:00:00');

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

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id_subcategory`, `id_category`, `subcategory`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 1, 'MAN CHASIS / ENGINE', '2023-05-10 04:32:42', '2023-05-10 04:32:42', 1),
(2, 1, 'MAN CABIN', '2023-05-10 04:32:42', '2023-05-10 04:32:42', 1),
(3, 1, 'RUNNING TEST', '2023-05-10 04:32:42', '2023-05-10 04:32:42', 1),
(4, 1, 'MAN TOOLS', '2023-05-10 04:32:42', '2023-05-10 04:32:42', 1),
(5, 1, 'ZIEGLER SUPERSTUCTURE ( PUMP COMPARTMENT )', '2023-05-10 04:32:42', '2023-05-10 04:32:42', 1),
(6, 1, 'FIREMAN TOOLS & EQUIPMENTS', '2023-05-10 04:32:42', '2023-05-10 04:32:42', 1),
(7, 2, 'ENGINE', '2023-05-10 04:35:16', '2023-05-10 04:35:16', 1),
(8, 2, 'TRANSMISSION & BRAKING SYSTEM', '2023-05-10 04:35:16', '2023-05-10 04:35:16', 1),
(9, 2, 'ELECTRICAL SYSTEM', '2023-05-10 04:35:16', '2023-05-10 04:35:16', 1),
(10, 2, 'RESCUE EQUIPMENTS', '2023-05-10 04:35:16', '2023-05-10 04:35:16', 1),
(11, 2, 'HAZMAT EQUIPMENTS', '2023-05-10 04:35:16', '2023-05-10 04:35:16', 1),
(12, 2, 'FIREMAN TOOLS', '2023-05-10 04:35:16', '2023-05-10 04:35:16', 1),
(13, 3, 'SUBCATEGORY RESCUE BOAT', '2023-05-10 05:14:18', '2023-05-10 05:14:18', 1);

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
  `status` int(1) DEFAULT NULL COMMENT '0=Assistant, 1=Commander',
  `is_active` int(1) NOT NULL COMMENT '0=tidak aktif, 1=aktif',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `role`, `status`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'superadmin', '$2y$10$tKKAV8Zdr8PpTUmoBfgSJup2TAwVxcWcl8tvp9ym8.eZFaCpzYvzi', 0, NULL, 1, '2023-05-10 04:23:41', '2023-05-10 04:23:41'),
(8, 'Aris Ariyanto', 'aris', '$2y$10$VldLDmDBv1p6/IYuAC.sSek6giVemJz9cVNTHYviTtUrPuG5YIq.i', 1, 1, 1, '2023-05-14 09:02:10', '2023-05-14 09:02:10'),
(9, 'Bo Dwi Purnomo', 'purnomo', '$2y$10$W0YDgkJsXCcaY6MfQGMNEOvRSXHZWHb38X6Km5xuF7d0WSegIMD3u', 1, 1, 1, '2023-05-14 09:04:15', '2023-05-14 09:04:15'),
(10, 'Heri Kusworo', 'heri', '$2y$10$jfKOL4eMXhsHWaD5zYqG2O2WShdSWATt5gPGrdQ33tLRDX0oAMlUC', 1, 1, 1, '2023-05-14 09:04:37', '2023-05-14 09:04:37'),
(11, 'Sahiruddin', 'sahiruddin', '$2y$10$kxIzODUhaCihRUo/LIjTteSerf5xQ6YljQhSa/ykzdHZ6tZbvfCAO', 1, 1, 1, '2023-05-14 09:04:56', '2023-05-14 09:04:56'),
(12, 'Setya Edy Pranata', 'setya', '$2y$10$sjjo0fWuj50PH61dxy8Au.no4sKyktQLdS6OTGf/vl/.UfW0RWHpe', 1, 1, 1, '2023-05-14 09:05:28', '2023-05-14 09:05:28'),
(13, 'spectator', 'spectator', '$2y$10$G3r775CPQN0G1QUiOFw2uOl4VONHA65XvtNKaviR4WtqyL4Cvx0CG', 2, NULL, 1, '2023-05-14 09:08:05', '2023-05-14 09:08:05');

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
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fic_assistant`
--
ALTER TABLE `fic_assistant`
  MODIFY `id_fic_assistant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `inspeksi`
--
ALTER TABLE `inspeksi`
  MODIFY `id_inspeksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inspeksi_detail`
--
ALTER TABLE `inspeksi_detail`
  MODIFY `id_inspeksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id_subcategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
