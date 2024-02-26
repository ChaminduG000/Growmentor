-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2023 at 05:47 PM
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
-- Database: `growmentor_khub`
--

-- --------------------------------------------------------

--
-- Table structure for table `friendship`
--

CREATE TABLE `friendship` (
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  `friendship_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friendship`
--

INSERT INTO `friendship` (`user1_id`, `user2_id`, `friendship_status`) VALUES
(2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_caption` text NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `post_public` char(1) NOT NULL,
  `post_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_caption`, `post_time`, `post_public`, `post_by`) VALUES
(1, 'Treatment:\r\n\r\nYou might have to check the roots themselves to confirm that your plant is suffering from root rot.\r\n\r\nIn this case, gently pull the plant out of its pot and look for black, mushy roots.\r\nTrim those back and wash the remaining root-knot with fresh, running water as best you can, without being too rough with the plant. Keep trimming back any mushy feeling roots.\r\nThrow away the soil in the pot and thoroughly wash the pot with baking soda and hot water. If you want, dip the remaining roots in some fungicide, according to instructions.\r\nReplant in clean potting mix. It might be a good idea to trim some of the plant as well, removing up to 1/3 of leaves and branches, if you cut back a lot of the roots.', '2023-09-26 05:56:06', 'N', 1),
(2, 'Treatment:\r\n\r\nYou might have to check the roots themselves to confirm that your plant is suffering from root rot.\r\n\r\nIn this case, gently pull the plant out of its pot and look for black, mushy roots.\r\nTrim those back and wash the remaining root-knot with fresh, running water as best you can, without being too rough with the plant. Keep trimming back any mushy feeling roots.\r\nThrow away the soil in the pot and thoroughly wash the pot with baking soda and hot water. If you want, dip the remaining roots in some fungicide, according to instructions.\r\nReplant in clean potting mix. It might be a good idea to trim some of the plant as well, removing up to 1/3 of leaves and branches, if you cut back a lot of the roots.', '2023-09-26 05:56:30', 'Y', 1),
(3, 'Treating black rot on apple trees starts with sanitation. Since fungal spores overwinter on fallen leaves, mummified fruits, dead bark, and cankers, it’s important to keep all the fallen debris and dead fruit cleaned up and away from the tree. During the winter, check for red cankers and remove them by cutting them out or pruning away the affected limbs at least 6 inches (15 cm.) beyond the wound. Destroy all infected tissue immediately and keep a watchful eye out for new signs of infection. Once black rot disease is under control in your tree and you’re again harvesting healthy fruits, make sure to remove any injured or insect-invaded fruits to avoid re-infection. Although general-purpose fungicides, like copper-based sprays and lime sulfur, can be used to control black rot, nothing will improve apple black rot like removing all sources of spores.\r\n\r\nRead more at Gardening Know How: What Is Black Rot: Treating Black Rot On Apple Trees https://www.gardeningknowhow.com/edible/fruits/apples/black-rot-on-apple-trees.htm', '2023-09-26 16:49:14', 'N', 2),
(4, 'Treating black rot on apple trees starts with sanitation. Since fungal spores overwinter on fallen leaves, mummified fruits, dead bark, and cankers, it’s important to keep all the fallen debris and dead fruit cleaned up and away from the tree. During the winter, check for red cankers and remove them by cutting them out or pruning away the affected limbs at least 6 inches (15 cm.) beyond the wound. Destroy all infected tissue immediately and keep a watchful eye out for new signs of infection. Once black rot disease is under control in your tree and you’re again harvesting healthy fruits, make sure to remove any injured or insect-invaded fruits to avoid re-infection. Although general-purpose fungicides, like copper-based sprays and lime sulfur, can be used to control black rot, nothing will improve apple black rot like removing all sources of spores.\r\n\r\nRead more at Gardening Know How: What Is Black Rot: Treating Black Rot On Apple Trees https://www.gardeningknowhow.com/edible/fruits/apples/black-rot-on-apple-trees.htm', '2023-09-26 16:49:34', 'Y', 2),
(5, 'ccsacs', '2023-09-27 07:30:23', 'N', 1),
(6, 'csc sasada ddsa da', '2023-09-29 06:25:14', 'N', 1),
(7, 'ssa dadasdad sadasdas', '2023-10-06 04:09:13', 'Y', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(20) NOT NULL,
  `user_lastname` varchar(20) NOT NULL,
  `user_nickname` varchar(20) DEFAULT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_gender` char(1) NOT NULL,
  `user_birthdate` date NOT NULL,
  `user_status` char(1) DEFAULT NULL,
  `user_about` text DEFAULT NULL,
  `user_hometown` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `user_nickname`, `user_password`, `user_email`, `user_gender`, `user_birthdate`, `user_status`, `user_about`, `user_hometown`) VALUES
(1, 'chamindu', 'Gimhana', 'chamindu', '827ccb0eea8a706c4c34a16891f84e7b', 'chamindugimhana2000@gmail.com', 'M', '1996-01-01', 'S', 'i am farmer', 'Rathnapura'),
(2, 'kaushika', 'shehan', 'kaushika', '827ccb0eea8a706c4c34a16891f84e7b', 'kaushika@gmail.com', 'M', '1996-01-01', 'S', 'i am new for agriculture feild.', 'gampaha');

-- --------------------------------------------------------

--
-- Table structure for table `user_phone`
--

CREATE TABLE `user_phone` (
  `user_id` int(11) DEFAULT NULL,
  `user_phone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_phone`
--

INSERT INTO `user_phone` (`user_id`, `user_phone`) VALUES
(1, 713226775);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friendship`
--
ALTER TABLE `friendship`
  ADD KEY `user1_id` (`user1_id`),
  ADD KEY `user2_id` (`user2_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_by` (`post_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_phone`
--
ALTER TABLE `user_phone`
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friendship`
--
ALTER TABLE `friendship`
  ADD CONSTRAINT `friendship_ibfk_1` FOREIGN KEY (`user1_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `friendship_ibfk_2` FOREIGN KEY (`user2_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_phone`
--
ALTER TABLE `user_phone`
  ADD CONSTRAINT `user_phone_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
