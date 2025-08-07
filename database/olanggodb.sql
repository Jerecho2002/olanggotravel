-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2025 at 02:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olanggodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `priority_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `priority_id`, `category_name`) VALUES
(1, 5, 'Accommodations'),
(2, 2, 'Food & Beverage'),
(3, 4, 'Transport Services'),
(4, 3, 'Activity Providers'),
(5, 1, 'Essential Services');

-- --------------------------------------------------------

--
-- Table structure for table `itineraries`
--

CREATE TABLE `itineraries` (
  `itinerary_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itineraries`
--

INSERT INTO `itineraries` (`itinerary_id`, `user_id`, `place_id`, `created_at`) VALUES
(1, 3, 9, '2025-08-05 17:04:04'),
(4, 3, 8, '2025-08-05 17:16:02'),
(8, 3, 12, '2025-08-05 18:30:57'),
(9, 3, 10, '2025-08-05 18:31:02'),
(11, 2, 8, '2025-08-05 18:35:19'),
(12, 2, 10, '2025-08-05 18:35:29'),
(13, 2, 9, '2025-08-05 18:35:38'),
(15, 3, 13, '2025-08-07 02:41:03'),
(16, 8, 11, '2025-08-07 05:15:04'),
(17, 8, 8, '2025-08-07 05:15:10'),
(23, 7, 13, '2025-08-07 05:26:07'),
(24, 7, 12, '2025-08-07 05:26:13'),
(25, 7, 11, '2025-08-07 05:26:17'),
(26, 7, 8, '2025-08-07 05:26:21'),
(27, 3, 11, '2025-08-07 06:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `place_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `place_name` varchar(255) NOT NULL,
  `nearest_index` int(11) NOT NULL,
  `price_label` varchar(50) NOT NULL,
  `price` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `duration` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `place_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`place_id`, `user_id`, `place_name`, `nearest_index`, `price_label`, `price`, `description`, `duration`, `location`, `place_img`, `created_at`) VALUES
(8, 1, 'White Sand Beach', 1, '', '', 'Pristine white sand and crystal clear waters perfect for swimming and sunbathing.', '3-6 hours', 'Wildlife Sancuary', '1_upscaled.jpg', '2025-08-01 16:57:01'),
(9, 1, 'Coral Reef Adventure', 1, '', '', 'Explore vibrant coral reefs teeming with marine life in our guided snorkeling tours.', '2-4 hours', 'Wildlife Sanctuary', '2_upscaled.jpg', '2025-08-01 16:57:01'),
(10, 2, 'Sunset Cruise', 2, '', '', 'Enjoy breathtaking sunsets while cruising around the islands with cocktails.', '3-7 hours', 'Shalala Beach', '3_upscaled.jpg', '2025-08-01 17:02:49'),
(11, 2, 'Kayaking Expedition', 2, '', '', 'Paddle through hidden lagoons and discover secret beaches on our kayak tours.', '4-7 hours', 'Shalala beach', '4_upscaled.jpg', '2025-08-01 17:02:49'),
(12, 3, 'Island Hopping', 3, '', '', 'Visit multiple islands in one day and experience their unique beauty and charm.', '1-4 hours', 'Kabatoy', 'upscalemedia-transformed(5).jpeg', '2025-08-01 17:04:42'),
(13, 3, 'Beach Camping', 3, '', '', 'Spend a night under the stars with our fully-equipped beach camping packages.', '4-8 hours', 'Kabatoy', 'upscalemedia-transformed (6).jpeg', '2025-08-01 17:04:42');

-- --------------------------------------------------------

--
-- Table structure for table `place_activities`
--

CREATE TABLE `place_activities` (
  `activitiy_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `place_activities`
--

INSERT INTO `place_activities` (`activitiy_id`, `place_id`, `user_id`, `activity_name`, `created_at`) VALUES
(1, 8, 4, 'Water Activities', '2025-08-07 05:56:50'),
(2, 8, 4, 'Nature & Wildlife', '2025-08-07 05:56:50'),
(3, 9, 4, 'Adventure & Sports', '2025-08-07 05:57:32'),
(4, 9, 4, 'Relaxation', '2025-08-07 05:57:32'),
(5, 10, 4, 'Culturual & History', '2025-08-07 05:58:15'),
(6, 10, 4, 'Scenic View', '2025-08-07 05:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `place_categories`
--

CREATE TABLE `place_categories` (
  `place_categories_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `place_categories`
--

INSERT INTO `place_categories` (`place_categories_id`, `user_id`, `place_id`, `category_id`) VALUES
(13, 4, 9, 1),
(14, 4, 9, 2),
(15, 4, 9, 3),
(16, 4, 8, 1),
(17, 4, 8, 3),
(18, 4, 8, 5),
(19, 4, 11, 4),
(20, 4, 11, 5),
(21, 4, 10, 1),
(22, 4, 10, 4),
(23, 4, 10, 5),
(24, 4, 13, 1),
(25, 4, 13, 5),
(26, 4, 12, 1),
(27, 4, 12, 3),
(28, 4, 9, 4),
(30, 4, 12, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` enum('user','staff','admin','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `roles`, `created_at`) VALUES
(1, 'echo', 'echolatosa@gmail.com', '$2y$10$O5j8hGTruhndkuICgW3I1./fuUOajxOJuPEIz7T40t/mGVvlFD3KO', 'user', '2025-08-05 16:44:26'),
(2, 'echo1', 'echolatosa1@gmail.com', '$2y$10$iHL4cPgWvDXj09MUYXMdGuEZWGA2I4xarqGFU7eLJSxiJkQGUPMgq', 'user', '2025-08-05 16:44:28'),
(3, 'sample', 'sample@gmail.com', '$2y$10$whHwHabh.saGV6mOkSfyoOM4Byh9FNgnGrPb5UGSMJ04XsixTJKgC', 'user', '2025-08-05 16:44:31'),
(4, 'staff', 'staff@gmail.com', '$2y$10$bOwVUIbaqeRBgPfv9J79NOkE0Mqa88QsYvQ0L9pVf2QcMLbpOd5wG', 'staff', '2025-08-05 16:44:33'),
(5, 'echo', 'echo@gmail.com', '$2y$10$H7OWAaqSQIUkw9wvUUj89uViY7ePYcfa7d5Mfil1dyr9dAv.NBNx2', 'admin', '2025-07-29 17:05:38'),
(7, 'user', 'user@gmail.com', '$2y$10$WipQmEJeNWxdOvVrO1TRu./SGEBrBcwsa.KcEEUkNUCvaUSRw.A8C', 'user', '2025-08-07 05:13:51'),
(8, 'dummy', 'dummy@gmail.com', '$2y$10$pbAus2MDidASclgb0B3sYet6rurIKX3Ign6ZppZCli8NKInPMJYry', 'user', '2025-08-07 05:14:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `itineraries`
--
ALTER TABLE `itineraries`
  ADD PRIMARY KEY (`itinerary_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `place_id` (`place_id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`place_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `place_activities`
--
ALTER TABLE `place_activities`
  ADD PRIMARY KEY (`activitiy_id`),
  ADD KEY `activities_ibfk_1` (`place_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `place_categories`
--
ALTER TABLE `place_categories`
  ADD PRIMARY KEY (`place_categories_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `place_id` (`place_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `itineraries`
--
ALTER TABLE `itineraries`
  MODIFY `itinerary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `place_activities`
--
ALTER TABLE `place_activities`
  MODIFY `activitiy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `place_categories`
--
ALTER TABLE `place_categories`
  MODIFY `place_categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `itineraries`
--
ALTER TABLE `itineraries`
  ADD CONSTRAINT `itineraries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itineraries_ibfk_2` FOREIGN KEY (`place_id`) REFERENCES `places` (`place_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `places`
--
ALTER TABLE `places`
  ADD CONSTRAINT `places_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `place_activities`
--
ALTER TABLE `place_activities`
  ADD CONSTRAINT `place_activities_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `places` (`place_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `place_activities_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `place_categories`
--
ALTER TABLE `place_categories`
  ADD CONSTRAINT `place_categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `place_categories_ibfk_2` FOREIGN KEY (`place_id`) REFERENCES `places` (`place_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `place_categories_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
