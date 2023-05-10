-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 05:00 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

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
  `status` int(1) NOT NULL COMMENT '0=Assistant, 1=Commander',
  `is_active` int(1) NOT NULL COMMENT '0=tidak aktif, 1=aktif',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `role`, `status`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'superadmin', '$2y$10$2NIkltZ3m198MgXyafkSguquu2XV3rf6YmUscxeBllyl6Pl7wo/2G', 0, 1, 1, '2023-05-10 04:23:41', '2023-05-10 04:23:41');

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
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
