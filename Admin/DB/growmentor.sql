-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2023 at 07:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `growmentor`
--

-- --------------------------------------------------------

--
-- Table structure for table `plant_disease`
--

CREATE TABLE `plant_disease` (
  `ID` int(11) NOT NULL,
  `Plant_Disease` varchar(255) NOT NULL,
  `Treatment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plant_disease`
--

INSERT INTO `plant_disease` (`ID`, `Plant_Disease`, `Treatment`) VALUES
(1, 'Aloevera___healthy_leaf', 'Apply a mild fertilizer and keep the plant well-watered.'),
(2, 'Aloevera___rot', 'Remove affected leaves and reduce watering.'),
(3, 'Aloevera___rust', 'Apply a fungicide to control rust infection.'),
(4, 'Apple___Apple_scab', 'Use fungicides and prune affected branches.'),
(5, 'Apple___Black_rot', 'Prune and destroy affected plant parts.'),
(6, 'Apple___Cedar_apple_rust', 'Apply fungicides to control cedar apple rust.'),
(7, 'Apple___healthy', 'No treatment required for healthy apple trees.'),
(8, 'Background_without_leaves', 'No specific treatment, maintain cleanliness.'),
(9, 'Cherry___Powdery_mildew', 'Use fungicides and prune affected branches.'),
(10, 'Cherry___healthy', 'No treatment required for healthy cherry trees.'),
(11, 'Corn___Cercospora_leaf_spot Gray_leaf_spot', 'Apply fungicides and practice crop rotation.'),
(12, 'Corn___Common_rust', 'Use fungicides and practice crop rotation.'),
(13, 'Corn___healthy', 'Practice good agricultural practices.'),
(14, 'Corn___Northern_Leaf_Blight', 'Use fungicides and practice crop rotation.'),
(15, 'Grape___Black_rot', 'Prune affected vines and use fungicides.'),
(16, 'Grape___Esca_(Black_Measles)', 'Prune affected vines and use fungicides.'),
(17, 'Grape___healthy', 'Practice good vineyard management.'),
(18, 'Grape___Leaf_blight_(Isariopsis_Leaf_Spot)', 'Use fungicides and maintain vineyard hygiene.'),
(19, 'Peach___Bacterial_spot', 'Use copper-based sprays and prune affected branches.'),
(20, 'Peach___healthy', 'No treatment required for healthy peach trees.'),
(21, 'Pepper,_bell___Bacterial_spot', 'Use copper-based sprays and remove affected leaves.'),
(22, 'Pepper,_bell___healthy', 'Practice good agricultural practices.'),
(23, 'Potato___Early_blight', 'Use fungicides and practice crop rotation.'),
(24, 'Potato___Late_blight', 'Use fungicides and practice crop rotation.'),
(25, 'Potato___healthy', 'Practice good agricultural practices.'),
(26, 'Strawberry___Leaf_scorch', 'Remove affected leaves and maintain good strawberry bed hygiene.'),
(27, 'Strawberry___healthy', 'Practice good strawberry bed management.'),
(28, 'Tomato___Bacterial_spot', 'Use copper-based sprays and remove affected leaves.'),
(29, 'Tomato___Early_blight', 'Use fungicides and remove affected leaves.'),
(30, 'Tomato___healthy', 'Practice good agricultural practices.'),
(31, 'Tomato___Late_blight', 'Use fungicides and remove affected leaves.'),
(32, 'Tomato___Leaf_Mold', 'Use fungicides and maintain good ventilation.'),
(33, 'Tomato___Septoria_leaf_spot', 'Use fungicides and remove affected leaves.'),
(34, 'Tomato___Spider_mites Two-spotted_spider_mite', 'Use miticides and maintain good plant hygiene.'),
(35, 'Tomato___Target_Spot', 'Use fungicides and remove affected leaves.'),
(36, 'Tomato___Tomato_mosaic_virus', 'There is no cure for viral infections, remove and destroy infected plants.'),
(37, 'Tomato___Tomato_Yellow_Leaf_Curl_Virus', 'There is no cure for viral infections, use insecticides to control the vector.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `phone_number`, `password`) VALUES
(1, 'chamindu', 'gimhana', '0710631708', 'Chamindu2000@');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plant_disease`
--
ALTER TABLE `plant_disease`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plant_disease`
--
ALTER TABLE `plant_disease`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
