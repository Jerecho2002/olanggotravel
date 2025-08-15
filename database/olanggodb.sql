-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2025 at 10:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activity_id` int(11) NOT NULL,
  `activity_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activity_id`, `activity_name`, `created_at`, `updated_at`) VALUES
(1, 'Water Activities', '2025-08-07 14:28:46', '2025-08-07 14:28:46'),
(2, 'Nature & Wildlife', '2025-08-07 14:28:46', '2025-08-07 14:28:46'),
(3, 'Adventure & Sports', '2025-08-07 14:28:46', '2025-08-07 14:28:46'),
(4, 'Relaxation', '2025-08-07 14:28:46', '2025-08-07 14:28:46'),
(5, 'Culturual & History', '2025-08-07 14:28:46', '2025-08-07 14:28:46'),
(6, 'Scenic View', '2025-08-07 14:28:46', '2025-08-07 14:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Accommodations', '2025-08-07 14:22:15', '2025-08-07 14:22:15'),
(2, 'Food & Beverage', '2025-08-07 14:22:15', '2025-08-07 14:22:15'),
(3, 'Transport Services', '2025-08-07 14:22:15', '2025-08-07 14:22:15'),
(4, 'Activity Providers', '2025-08-07 14:22:15', '2025-08-07 14:22:15'),
(5, 'Essential Services', '2025-08-07 14:22:15', '2025-08-07 14:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `itineraries`
--

CREATE TABLE `itineraries` (
  `itinerary_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `created_at`, `updated_at`) VALUES
(1, 'Wildlife Sancuary', '2025-08-11 10:56:02', '2025-08-11 10:56:02'),
(2, 'Shalala Beach', '2025-08-11 10:56:02', '2025-08-11 10:56:02'),
(3, 'Kabatoy', '2025-08-11 10:56:02', '2025-08-11 10:56:02');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `place_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `place_name` varchar(255) NOT NULL,
  `nearest_index` int(11) NOT NULL,
  `price_label` varchar(50) NOT NULL,
  `price` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `duration` varchar(50) NOT NULL,
  `location_id` int(11) NOT NULL,
  `place_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`place_id`, `staff_id`, `place_name`, `nearest_index`, `price_label`, `price`, `description`, `duration`, `location_id`, `place_img`, `created_at`, `updated_at`) VALUES
(8, 1, 'White Sand Beach', 1, '', '', 'Pristine white sand and crystal clear waters perfect for swimming and sunbathing.', '3-6 hours', 1, '1_upscaled.jpg', '2025-08-01 23:57:01', '2025-08-15 07:50:45'),
(9, 1, 'Coral Reef Adventure', 1, '', '', 'Explore vibrant coral reefs teeming with marine life in our guided snorkeling tours.', '2-4 hours', 1, '2_upscaled.jpg', '2025-08-01 23:57:01', '2025-08-15 07:50:45'),
(10, 2, 'Sunset Cruise', 2, '', '', 'Enjoy breathtaking sunsets while cruising around the islands with cocktails.', '3-7 hours', 2, '3_upscaled.jpg', '2025-08-02 00:02:49', '2025-08-15 07:50:45'),
(11, 2, 'Kayaking Expedition', 2, '', '', 'Paddle through hidden lagoons and discover secret beaches on our kayak tours.', '4-7 hours', 2, '4_upscaled.jpg', '2025-08-02 00:02:49', '2025-08-15 07:50:45'),
(12, 3, 'Island Hopping', 3, '', '', 'Visit multiple islands in one day and experience their unique beauty and charm.', '1-4 hours', 3, 'upscalemedia-transformed(5).jpeg', '2025-08-02 00:04:42', '2025-08-15 07:50:45'),
(13, 3, 'Beach Camping', 3, '', '', 'Spend a night under the stars with our fully-equipped beach camping packages.', '4-8 hours', 3, 'upscalemedia-transformed (6).jpeg', '2025-08-02 00:04:42', '2025-08-15 07:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `place_activities`
--

CREATE TABLE `place_activities` (
  `place_activities_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `place_activities`
--

INSERT INTO `place_activities` (`place_activities_id`, `place_id`, `staff_id`, `activity_id`, `created_at`, `updated_at`) VALUES
(39, 10, 1, 1, '2025-08-15 07:48:18', '2025-08-15 07:51:40'),
(40, 10, 1, 2, '2025-08-15 07:59:42', '2025-08-15 07:59:42'),
(41, 10, 1, 3, '2025-08-15 07:59:46', '2025-08-15 07:59:46'),
(42, 11, 1, 4, '2025-08-15 07:59:51', '2025-08-15 07:59:51'),
(43, 11, 1, 5, '2025-08-15 07:59:54', '2025-08-15 07:59:54'),
(44, 11, 1, 6, '2025-08-15 07:59:56', '2025-08-15 07:59:56'),
(45, 8, 2, 1, '2025-08-15 08:00:28', '2025-08-15 08:00:28'),
(46, 8, 2, 2, '2025-08-15 08:00:31', '2025-08-15 08:00:31'),
(47, 8, 2, 3, '2025-08-15 08:00:34', '2025-08-15 08:00:34'),
(48, 9, 2, 4, '2025-08-15 08:00:37', '2025-08-15 08:00:37'),
(49, 9, 2, 5, '2025-08-15 08:00:40', '2025-08-15 08:00:40'),
(50, 9, 2, 6, '2025-08-15 08:00:42', '2025-08-15 08:00:42'),
(51, 12, 3, 1, '2025-08-15 08:01:13', '2025-08-15 08:01:13'),
(52, 12, 3, 2, '2025-08-15 08:01:17', '2025-08-15 08:01:17'),
(55, 12, 3, 3, '2025-08-15 08:01:57', '2025-08-15 08:01:57'),
(56, 13, 3, 4, '2025-08-15 08:02:00', '2025-08-15 08:02:00'),
(57, 13, 3, 5, '2025-08-15 08:02:03', '2025-08-15 08:02:03'),
(58, 13, 3, 6, '2025-08-15 08:02:06', '2025-08-15 08:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `place_categories`
--

CREATE TABLE `place_categories` (
  `place_categories_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `place_categories`
--

INSERT INTO `place_categories` (`place_categories_id`, `staff_id`, `place_id`, `category_id`, `created_at`, `updated_at`) VALUES
(48, 1, 10, 1, '2025-08-15 08:00:02', '2025-08-15 08:00:02'),
(49, 1, 10, 2, '2025-08-15 08:00:05', '2025-08-15 08:00:05'),
(50, 1, 10, 3, '2025-08-15 08:00:08', '2025-08-15 08:00:08'),
(51, 1, 11, 4, '2025-08-15 08:00:10', '2025-08-15 08:00:10'),
(52, 1, 11, 5, '2025-08-15 08:00:13', '2025-08-15 08:00:13'),
(53, 2, 8, 1, '2025-08-15 08:00:47', '2025-08-15 08:00:47'),
(54, 2, 8, 2, '2025-08-15 08:00:51', '2025-08-15 08:00:51'),
(55, 2, 8, 3, '2025-08-15 08:00:54', '2025-08-15 08:00:54'),
(56, 2, 9, 4, '2025-08-15 08:00:57', '2025-08-15 08:00:57'),
(57, 2, 9, 5, '2025-08-15 08:00:59', '2025-08-15 08:00:59'),
(58, 3, 12, 1, '2025-08-15 08:02:19', '2025-08-15 08:02:19'),
(59, 3, 12, 2, '2025-08-15 08:02:21', '2025-08-15 08:02:21'),
(60, 3, 12, 3, '2025-08-15 08:02:23', '2025-08-15 08:02:23'),
(61, 3, 13, 4, '2025-08-15 08:02:26', '2025-08-15 08:02:26'),
(62, 3, 13, 5, '2025-08-15 08:02:29', '2025-08-15 08:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `location_id` int(11) NOT NULL,
  `staff_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `username`, `email`, `password`, `location_id`, `staff_img`, `created_at`, `updated_at`) VALUES
(1, 'staff', 'staff@gmail.com', '$2y$10$MGMalRYDB6Qy6WFOsUOIIe5KqRnv8iNi9pdI/.1/lDILE7c4RCzVe', 2, 'istockphoto-1499707292-1024x1024.jpg', '2025-08-11 11:26:11', '2025-08-12 21:16:38'),
(2, 'staff1', 'staff1@gmail.com', '$2y$10$09ztDQ.rD5f1U.3ShMNlRutM4qrhSJXgZoP.K4iDDLCR5yZ37oFYW', 1, 'istockphoto-1499707292-1024x1024.jpg', '2025-08-14 04:56:41', '2025-08-14 04:56:41'),
(3, 'staff2', 'staff2@gmail.com', '$2y$10$5sW2GlYLwcG7oSKcFcEdbOPGJkwi6fTCFlz00emtXSdVcyy3rDdaO', 3, '', '2025-08-14 04:56:48', '2025-08-14 04:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_img` varchar(255) NOT NULL,
  `roles` enum('user','admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `user_img`, `roles`, `created_at`) VALUES
(22, 'echo', 'echo@gmail.com', '$2y$10$yt8SywGKZf.5PSGESUGQ8u9oK9Pg2l6FftTFRC80wpbR0IQr1JgTe', 'user-default-img.png', 'user', '2025-08-15 07:53:08'),
(23, 'echo1', 'echo1@gmail.com', '$2y$10$gE577X8zRXJcpzO./5VA3uD2ED/2MPivsmrgU2amkmrFgHfkZUYr2', 'user-default-img.png', 'user', '2025-08-15 07:56:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`);

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
  ADD KEY `place_id` (`place_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`place_id`),
  ADD KEY `user_id` (`staff_id`);

--
-- Indexes for table `place_activities`
--
ALTER TABLE `place_activities`
  ADD PRIMARY KEY (`place_activities_id`),
  ADD KEY `activities_ibfk_1` (`place_id`),
  ADD KEY `user_id` (`staff_id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `place_categories`
--
ALTER TABLE `place_categories`
  ADD PRIMARY KEY (`place_categories_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `place_id` (`place_id`),
  ADD KEY `user_id` (`staff_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `itineraries`
--
ALTER TABLE `itineraries`
  MODIFY `itinerary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `place_activities`
--
ALTER TABLE `place_activities`
  MODIFY `place_activities_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `place_categories`
--
ALTER TABLE `place_categories`
  MODIFY `place_categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `itineraries`
--
ALTER TABLE `itineraries`
  ADD CONSTRAINT `itineraries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itineraries_ibfk_2` FOREIGN KEY (`place_id`) REFERENCES `places` (`place_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itineraries_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`);

--
-- Constraints for table `places`
--
ALTER TABLE `places`
  ADD CONSTRAINT `places_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `place_activities`
--
ALTER TABLE `place_activities`
  ADD CONSTRAINT `place_activities_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `places` (`place_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `place_activities_ibfk_3` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`activity_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `place_activities_ibfk_4` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `place_categories`
--
ALTER TABLE `place_categories`
  ADD CONSTRAINT `place_categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `place_categories_ibfk_2` FOREIGN KEY (`place_id`) REFERENCES `places` (`place_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `place_categories_ibfk_3` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
