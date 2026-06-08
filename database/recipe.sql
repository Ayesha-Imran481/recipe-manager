-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2026 at 12:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipe`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(8) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Cakes'),
(2, 'Pastries'),
(3, 'Cookies'),
(4, 'Donuts'),
(5, 'Breads');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(8) NOT NULL,
  `recipe_id` int(8) NOT NULL,
  `name` varchar(50) NOT NULL,
  `qty` varchar(60) NOT NULL,
  `unit` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `recipe_id`, `name`, `qty`, `unit`) VALUES
(3, 1, 'Flour', '500', 'Gram'),
(4, 1, 'Sugar', '350', 'Gram'),
(5, 1, 'Cocoa Powder', '100', 'Gram'),
(6, 1, 'Milk', '300', 'ML'),
(7, 1, 'Butter', '200', 'Gram'),
(8, 1, 'Eggs', '4', 'Piece'),
(9, 1, 'Baking Powder', '10', 'Gram'),
(10, 1, 'Vanilla Essence', '5', 'ML'),
(11, 2, 'Flour', '400', 'Gram'),
(12, 2, 'Sugar', '250', 'Gram'),
(13, 2, 'Milk', '250', 'ML'),
(14, 2, 'Butter', '150', 'Gram'),
(15, 2, 'Eggs', '4', 'Piece'),
(16, 2, 'Vanilla Essence', '10', 'ML'),
(17, 2, 'Baking Powder', '8', 'Gram'),
(18, 3, 'Flour', '250', 'Gram'),
(19, 3, 'Sugar', '120', 'Gram'),
(20, 3, 'Cocoa Powder', '50', 'Gram'),
(21, 3, 'Milk', '150', 'ML'),
(22, 3, 'Butter', '100', 'Gram'),
(23, 3, 'Eggs', '2', 'Piece'),
(24, 4, 'Flour', '250', 'Gram'),
(25, 4, 'Sugar', '120', 'Gram'),
(26, 4, 'Milk', '150', 'ML'),
(27, 4, 'Butter', '100', 'Gram'),
(28, 4, 'Eggs', '2', 'Piece'),
(29, 4, 'Strawberry Jam', '80', 'Gram'),
(30, 5, 'Flour', '300', 'Gram'),
(31, 5, 'Sugar', '180', 'Gram'),
(32, 5, 'Butter', '200', 'Gram'),
(33, 5, 'Chocolate Chips', '150', 'Gram'),
(34, 5, 'Eggs', '2', 'Piece'),
(35, 5, 'Vanilla Essence', '5', 'ML'),
(36, 6, 'Flour', '300', 'Gram'),
(37, 6, 'Butter', '250', 'Gram'),
(38, 6, 'Sugar', '150', 'Gram'),
(39, 6, 'Eggs', '2', 'Piece'),
(40, 6, 'Vanilla Essence', '5', 'ML'),
(41, 7, 'Flour', '500', 'Gram'),
(42, 7, 'Sugar', '80', 'Gram'),
(43, 7, 'Milk', '250', 'ML'),
(44, 7, 'Butter', '80', 'Gram'),
(45, 7, 'Yeast', '10', 'Gram'),
(46, 7, 'Eggs', '2', 'Piece'),
(47, 8, 'Flour', '500', 'Gram'),
(48, 8, 'Sugar', '100', 'Gram'),
(49, 8, 'Cocoa Powder', '60', 'Gram'),
(50, 8, 'Milk', '250', 'ML'),
(51, 8, 'Butter', '80', 'Gram'),
(52, 8, 'Yeast', '10', 'Gram'),
(53, 8, 'Eggs', '2', 'Piece'),
(54, 9, 'Flour', '1000', 'Gram'),
(55, 9, 'Water', '600', 'ML'),
(56, 9, 'Yeast', '15', 'Gram'),
(57, 9, 'Sugar', '20', 'Gram'),
(58, 9, 'Salt', '15', 'Gram'),
(59, 9, 'Butter', '50', 'Gram'),
(60, 10, 'Flour', '600', 'Gram'),
(61, 10, 'Water', '350', 'ML'),
(62, 10, 'Yeast', '10', 'Gram'),
(63, 10, 'Garlic', '40', 'Gram'),
(64, 10, 'Butter', '100', 'Gram'),
(65, 10, 'Salt', '10', 'Gram');

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `id` int(8) NOT NULL,
  `category_id` int(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `serve` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`id`, `category_id`, `name`, `serve`) VALUES
(5, 1, 'Chocolate Cake', 8),
(6, 1, 'Vanilla Sponge Cake', 6),
(7, 2, 'Chocolate Pastry', 4),
(8, 2, 'Strawberry Pastry', 4),
(9, 3, 'Chocolate Chip Cookies', 10),
(10, 3, 'Butter Cookies', 12),
(11, 4, 'Glazed Donuts', 8),
(12, 4, 'Chocolate Donuts', 8),
(13, 5, 'White Bread', 10),
(14, 5, 'Garlic Bread', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
