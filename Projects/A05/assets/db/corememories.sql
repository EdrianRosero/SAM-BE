-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2024 at 01:38 PM
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
-- Database: `corememories`
--

-- --------------------------------------------------------

--
-- Table structure for table `islandcontents`
--

CREATE TABLE `islandcontents` (
  `islandContentID` int(4) NOT NULL,
  `islandOfPersonalityID` int(4) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `content` varchar(300) NOT NULL,
  `color` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `islandcontents`
--

INSERT INTO `islandcontents` (`islandContentID`, `islandOfPersonalityID`, `image`, `content`, `color`) VALUES
(1, 1, 'assets/images/college1.jpg', 'Crafting designs that echo passion and purpose.', '#F5F5F5'),
(2, 1, 'assets/images/college2.jpg', 'Lost in lines of logic and endless possibilities.', '#F5F5F5'),
(3, 1, 'assets/images/college3.jpg', 'Shouting our hearts out, united as one team.', '#F5F5F5'),
(4, 2, 'assets/images/food1.jpg', 'Savoring sweetness, one scoop at a time.', '#E8FIFA'),
(5, 2, 'assets/images/food2.jpg', 'A slice of happiness, served sweet and fresh.', '#E8FIFA'),
(6, 2, 'assets/images/food3.jpg', 'Crispy, golden, and absolutely irresistible.', '#E8FIFA'),
(7, 3, 'assets/images/friend1.jpg', 'Good food, great friends, and even better memories.', '#F3FIFA'),
(8, 3, 'assets/images/friend2.jpg', 'An adventure on screen, shared with the best company.', '#F3FIFA'),
(9, 3, 'assets/images/friend3.jpg', 'Closing the year with laughter, and memories.', '#F3FIFA'),
(10, 4, 'assets/images/scenery1.jpeg', 'Watching the sky paint its final masterpiece of the day.', '#F9D7D2'),
(11, 4, 'assets/images/scenery2.jpeg', 'Basking in the warmth of the sun and the sound of the waves.', '#F9D7D2'),
(12, 4, 'assets/images/scenery3.jpeg', 'Lost in the breathtaking hues of a purple sky at dusk.', '#F9D7D2');

-- --------------------------------------------------------

--
-- Table structure for table `islandsofpersonality`
--

CREATE TABLE `islandsofpersonality` (
  `islandOfPersonalityID` int(4) NOT NULL,
  `name` varchar(40) NOT NULL,
  `shortDescription` varchar(300) DEFAULT NULL,
  `longDescription` varchar(900) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `islandsofpersonality`
--

INSERT INTO `islandsofpersonality` (`islandOfPersonalityID`, `name`, `shortDescription`, `longDescription`, `color`, `image`, `status`) VALUES
(1, 'College Island', 'A place of learning and growth.', 'This Island holds the memories of academic challenges, personal growth, and unforgettable moments that shape who I am.', '#FFD966', 'assets/images/CollegeIsland.jpg', 'active'),
(2, 'Foodie Island', 'A place filled with delicious memories', 'This Island is full of memories of shared meals, and the joy of savoring life’s flavors.', '#4A90E2', 'assets/images/FoodIsland.jpg', 'active'),
(3, 'Friendship  Island', 'A place where memories of connection live.', 'This Island is built on the memories of laughter, support, and moments spent with friends who leave a lasting impact.', '#A58CF5', 'assets/images/FriendshipIsland.jpg', 'active'),
(4, 'Scenery Island', 'A place where beautiful memories are captured.', 'This Island holds the memories of awe-inspiring landscapes and peaceful moments spent in natures embrace.', '#FF6F61', 'assets/images/SceneryIsland.jpg', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `islandcontents`
--
ALTER TABLE `islandcontents`
  ADD PRIMARY KEY (`islandContentID`);

--
-- Indexes for table `islandsofpersonality`
--
ALTER TABLE `islandsofpersonality`
  ADD PRIMARY KEY (`islandOfPersonalityID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `islandcontents`
--
ALTER TABLE `islandcontents`
  MODIFY `islandContentID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `islandsofpersonality`
--
ALTER TABLE `islandsofpersonality`
  MODIFY `islandOfPersonalityID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
