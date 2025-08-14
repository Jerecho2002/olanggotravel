-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2025 at 09:54 PM
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itineraries`
--

INSERT INTO `itineraries` (`itinerary_id`, `user_id`, `place_id`, `location_id`, `created_at`) VALUES
(36, 3, 10, 2, '2025-08-12 21:12:07'),
(37, 18, 13, 3, '2025-08-13 18:48:25'),
(38, 4, 11, 2, '2025-08-14 05:55:21'),
(39, 4, 9, 1, '2025-08-14 19:34:03');

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
  `user_id` int(11) NOT NULL,
  `place_name` varchar(255) NOT NULL,
  `nearest_index` int(11) NOT NULL,
  `price_label` varchar(50) NOT NULL,
  `price` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `duration` varchar(50) NOT NULL,
  `location_id` int(11) NOT NULL,
  `place_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`place_id`, `user_id`, `place_name`, `nearest_index`, `price_label`, `price`, `description`, `duration`, `location_id`, `place_img`, `created_at`) VALUES
(8, 1, 'White Sand Beach', 1, '', '', 'Pristine white sand and crystal clear waters perfect for swimming and sunbathing.', '3-6 hours', 1, '1_upscaled.jpg', '2025-08-01 23:57:01'),
(9, 1, 'Coral Reef Adventure', 1, '', '', 'Explore vibrant coral reefs teeming with marine life in our guided snorkeling tours.', '2-4 hours', 1, '2_upscaled.jpg', '2025-08-01 23:57:01'),
(10, 2, 'Sunset Cruise', 2, '', '', 'Enjoy breathtaking sunsets while cruising around the islands with cocktails.', '3-7 hours', 2, '3_upscaled.jpg', '2025-08-02 00:02:49'),
(11, 2, 'Kayaking Expedition', 2, '', '', 'Paddle through hidden lagoons and discover secret beaches on our kayak tours.', '4-7 hours', 2, '4_upscaled.jpg', '2025-08-02 00:02:49'),
(12, 3, 'Island Hopping', 3, '', '', 'Visit multiple islands in one day and experience their unique beauty and charm.', '1-4 hours', 3, 'upscalemedia-transformed(5).jpeg', '2025-08-02 00:04:42'),
(13, 3, 'Beach Camping', 3, '', '', 'Spend a night under the stars with our fully-equipped beach camping packages.', '4-8 hours', 3, 'upscalemedia-transformed (6).jpeg', '2025-08-02 00:04:42');

-- --------------------------------------------------------

--
-- Table structure for table `place_activities`
--

CREATE TABLE `place_activities` (
  `place_activities_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `place_activities`
--

INSERT INTO `place_activities` (`place_activities_id`, `place_id`, `user_id`, `activity_id`, `created_at`) VALUES
(20, 10, 1, 1, '2025-08-14 04:54:53'),
(21, 10, 1, 2, '2025-08-14 04:55:02'),
(22, 10, 1, 3, '2025-08-14 04:55:05'),
(23, 11, 1, 4, '2025-08-14 04:55:12'),
(24, 11, 1, 5, '2025-08-14 04:55:15'),
(25, 11, 1, 6, '2025-08-14 04:55:18'),
(26, 8, 2, 1, '2025-08-14 04:58:08'),
(27, 8, 2, 2, '2025-08-14 04:58:12'),
(28, 8, 2, 3, '2025-08-14 04:58:15'),
(29, 9, 2, 4, '2025-08-14 04:58:19'),
(30, 9, 2, 5, '2025-08-14 04:58:21'),
(31, 9, 2, 6, '2025-08-14 04:58:24'),
(32, 12, 3, 1, '2025-08-14 04:59:08'),
(33, 12, 3, 2, '2025-08-14 04:59:10'),
(34, 12, 3, 3, '2025-08-14 04:59:13'),
(35, 13, 3, 4, '2025-08-14 04:59:16'),
(36, 13, 3, 5, '2025-08-14 04:59:19'),
(37, 13, 3, 6, '2025-08-14 04:59:21');

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
(33, 1, 10, 1),
(34, 1, 10, 2),
(35, 1, 10, 3),
(36, 1, 11, 4),
(37, 1, 11, 5),
(38, 2, 8, 1),
(39, 2, 8, 2),
(40, 2, 8, 3),
(41, 2, 9, 4),
(42, 2, 9, 5),
(43, 3, 12, 1),
(44, 3, 12, 2),
(45, 3, 12, 3),
(46, 3, 13, 4),
(47, 3, 13, 5);

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
(1, 'echo', 'echolatosa@gmail.com', '$2y$10$O5j8hGTruhndkuICgW3I1./fuUOajxOJuPEIz7T40t/mGVvlFD3KO', '', 'user', '2025-08-05 16:44:26'),
(2, 'echo1', 'echolatosa1@gmail.com', '$2y$10$iHL4cPgWvDXj09MUYXMdGuEZWGA2I4xarqGFU7eLJSxiJkQGUPMgq', '', 'user', '2025-08-05 16:44:28'),
(3, 'sample', 'sample@gmail.com', '$2y$10$whHwHabh.saGV6mOkSfyoOM4Byh9FNgnGrPb5UGSMJ04XsixTJKgC', '', 'user', '2025-08-05 16:44:31'),
(4, 'staff', 'staff@gmail.com', '$2y$10$bOwVUIbaqeRBgPfv9J79NOkE0Mqa88QsYvQ0L9pVf2QcMLbpOd5wG', '', 'user', '2025-08-11 11:27:53'),
(5, 'echo', 'echo@gmail.com', '$2y$10$H7OWAaqSQIUkw9wvUUj89uViY7ePYcfa7d5Mfil1dyr9dAv.NBNx2', '', 'admin', '2025-07-29 17:05:38'),
(7, 'user', 'user@gmail.com', '$2y$10$WipQmEJeNWxdOvVrO1TRu./SGEBrBcwsa.KcEEUkNUCvaUSRw.A8C', '', 'user', '2025-08-07 05:13:51'),
(8, 'dummy', 'dummy@gmail.com', '$2y$10$pbAus2MDidASclgb0B3sYet6rurIKX3Ign6ZppZCli8NKInPMJYry', '', 'user', '2025-08-07 05:14:09'),
(11, 'echo1', 'echo1@gmail.com', '$2y$10$TS9BNm4TtANOyaQfUB4IFeDLt1Nghc607ArSxh5.bryqFy16suXo6', '', 'user', '2025-08-13 04:03:42'),
(12, 'echo2', 'echo2@gmail.com', '$2y$10$/YB.71zEKRgWBW.Ie1o5.u3Ii.Bpab16/0LYv2g5W0VIaDy2AzWZ2', '', 'user', '2025-08-13 04:06:50'),
(13, 'echo3', 'echo3@gmail.com', '$2y$10$6vwBggyEotV96UgYbx3cRuz0FqOqL7vUoNTt22f4fxWEa8EIqw2T2', '', 'user', '2025-08-13 04:08:32'),
(14, 'echo4', 'echo4@gmail.com', '$2y$10$k0gPHkiX3wDwjCtCBBjVN.rvIYjAxtSIzAL1h41WBMRYuzPigCEmO', '', 'user', '2025-08-13 04:13:23'),
(15, 'echo5', 'echo5@gmail.com', '$2y$10$mib/UkS4XSHuMEW5KYFjk.8xtfecTm.GmAF0JKIYdUUmhrS6UJEoe', '', 'user', '2025-08-13 04:18:30'),
(16, 'echo6', 'echo6@gmail.com', '$2y$10$esHyCOkMfQn2RZE9NDf64OyF/eWfFzBqLdYJRQVZylLeSVGnIh8sy', '', 'user', '2025-08-13 04:22:44'),
(17, 'echo7', 'echo7@gmail.com', '$2y$10$6drY7zaXV7PT91Is/1aFT.f/mQOa4BnG2WW.RZZb/WZyistefV0P.', '496510693_1038416405091238_4701535631828418993_n.jpg', 'user', '2025-08-13 04:46:30'),
(18, 'echo8', 'echo8@gmail.com', '$2y$10$UFE1VohKDOb1NYaE/nhi9.SdB0N.xyvxWc83gdCbYPV/7n2fmrD2i', 'clearImage.jpg', 'user', '2025-08-13 18:47:30'),
(19, 'echo9', 'echo9@gmail.com', '$2y$10$3mlMa.RtIOuo9awiyO3T9uDQznQvhCbVdrciRiUELPUTTQWYKbvrW', '', 'user', '2025-08-13 18:53:13'),
(20, 'echo10', 'echo10@gmail.com', '$2y$10$5nC4F5I2Klcz7GMPrG35LOr16KO.v9yiwnEr.Xt8IQx/4Ydw/TzKu', '../assets/images/user-default-img.png', 'user', '2025-08-13 19:14:14'),
(21, 'echo11', 'echo11@gmail.com', '$2y$10$7i2cHzHAjNYDsUojz8rwVuaCywLCxTiJc.foL3ClGxLrJh7oPMgvG', 'user-default-img.png', 'user', '2025-08-13 19:15:00');

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
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `place_activities`
--
ALTER TABLE `place_activities`
  ADD PRIMARY KEY (`place_activities_id`),
  ADD KEY `activities_ibfk_1` (`place_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `place_categories`
--
ALTER TABLE `place_categories`
  ADD PRIMARY KEY (`place_categories_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `place_id` (`place_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `itinerary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
  MODIFY `place_activities_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `place_categories`
--
ALTER TABLE `place_categories`
  MODIFY `place_categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  ADD CONSTRAINT `places_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `place_activities`
--
ALTER TABLE `place_activities`
  ADD CONSTRAINT `place_activities_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `places` (`place_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `place_activities_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `place_activities_ibfk_3` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`activity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
