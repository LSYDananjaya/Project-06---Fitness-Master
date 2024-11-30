-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2024 at 06:06 PM
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

-- Database: `fitness_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
  `coach_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `experience_years` int(11) NOT NULL,
  `bio` text DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `availability` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coaches`
--

INSERT INTO `coaches` (`coach_id`, `name`, `email`, `specialization`, `experience_years`, `bio`, `phone_number`, `availability`, `created_at`, `updated_at`) VALUES
(2, 'Jane Smith', 'jane.smith@example.com', 'Yoga & Flexibility', 9, 'Certified yoga instructor specializing in flexibility and mindfulness.', '0987654321', 'Tue-Thu 10am-6pm', '2024-09-27 15:34:19', '2024-09-28 04:19:58'),
(3, 'Matt Smith', 'smith@gmail.com', 'special1', 5, '0', '0745687891', NULL, '2024-09-28 03:46:36', '2024-09-28 03:46:36');

-- --------------------------------------------------------

--
-- Table structure for table `diet_plans`
--

CREATE TABLE `diet_plans` (
  `diet_id` int(11) NOT NULL,
  `meal_plan` text NOT NULL,
  `description` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diet_plans`
--

INSERT INTO `diet_plans` (`diet_id`, `meal_plan`, `description`, `notes`, `image`, `created_at`, `updated_at`) VALUES
(5, 'plan 01', 'dscription 1', 'note 4567', 'uploads/sunset-lake-mountain-sky-scenery-digital-art-4k-wallpaper-uhdpaper.com-908@0@i.jpg', '2024-09-29 06:54:03', '2024-09-29 07:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `system_rating` int(1) NOT NULL CHECK (`system_rating` >= 1 and `system_rating` <= 5),
  `comments` text DEFAULT NULL,
  `improvement_suggestions` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`feedback_id`, `user_id`, `coach_id`, `rating`, `system_rating`, `comments`, `improvement_suggestions`, `created_at`, `updated_at`) VALUES
(7, 1, 2, 4, 3, 'comment 01', 'suggest 01', '2024-10-01 02:44:10', '2024-10-01 02:44:10');

-- --------------------------------------------------------

--
-- Table structure for table `membership_packages`
--

CREATE TABLE `membership_packages` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` int(11) NOT NULL COMMENT 'Duration in days',
  `description` text DEFAULT NULL,
  `features` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership_packages`
--

INSERT INTO `membership_packages` (`package_id`, `package_name`, `price`, `duration`, `description`, `features`, `created_at`, `updated_at`) VALUES
(1, 'Basic Plan', 50.00, 60, 'A basic membership plan for beginners.', 'Access to gym facilities, 2 personal training sessions per month', '2024-09-27 15:34:19', '2024-09-28 11:18:04'),
(2, 'Premium Plan', 99.99, 90, 'A premium membership plan for dedicated individuals.', 'Access to all facilities, 6 personal training sessions per month, Free nutritional consultation', '2024-09-27 15:34:19', '2024-09-27 15:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `gender`, `password`, `phone_number`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Kamal', 'kamal@gmail.com', 'Male', '202cb962ac59075b964b07152d234b70', '776655432', 1, '2024-09-27 15:34:19', '2024-09-27 15:34:19'),
(2, 'Sara', 'sara@gmail.com', 'Female', '202cb962ac59075b964b07152d234b70', '987654321', 0, '2024-09-27 15:34:19', '2024-09-27 15:34:19'),
(3, 'akila', 'akila@gmail.com', 'Male', '$2y$10$PJylKL6UszsxZwNxKLmkI.cGteFqfseHV1RE7l4secBtp0ps2XLzi', '0702249246', 0, '2024-09-27 16:06:02', '2024-09-27 16:09:33'),
(4, 'admin', 'admin@gmail.com', 'Male', 'admin123', '0744567891', 1, '2024-09-29 06:24:23', '2024-09-29 06:24:23'),
(5, 'hashan P', 'hashan@gmail.com', 'Male', '$2y$10$QmZYquO4Wykh3jYmIQUjt.IFkEl0dEXv4m4yPrAWd9DGFJz0ekLgC', '07224789456', 0, '2024-10-01 02:41:35', '2024-10-01 02:42:35'),
(6, 'hashan perera', 'hashanp@gmail.com', 'Male', '$2y$10$cVPyD9JiRw66Q30Y8ZCOze.xBKshlkUI.uQaAZteveTEmYjjWnO/q', '07224789456', 0, '2024-10-01 02:52:48', '2024-10-01 02:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `workout_plans`
--

CREATE TABLE `workout_plans` (
  `plan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('Active','Completed','Cancelled') DEFAULT 'Active',
  `session_count` int(11) DEFAULT 0,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout_plans`
--

INSERT INTO `workout_plans` (`plan_id`, `user_id`, `package_id`, `coach_id`, `start_date`, `end_date`, `status`, `session_count`, `notes`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 2, '2024-06-01', '2024-08-29', 'Active', 9, 'Incorporate yoga and flexibility training.', '2024-09-27 15:34:19', '2024-09-29 18:29:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`coach_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `diet_plans`
--
ALTER TABLE `diet_plans`
  ADD PRIMARY KEY (`diet_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `coach_id` (`coach_id`);

--
-- Indexes for table `membership_packages`
--
ALTER TABLE `membership_packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workout_plans`
--
ALTER TABLE `workout_plans`
  ADD PRIMARY KEY (`plan_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `coach_id` (`coach_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coaches`
--
ALTER TABLE `coaches`
  MODIFY `coach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `diet_plans`
--
ALTER TABLE `diet_plans`
  MODIFY `diet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `membership_packages`
--
ALTER TABLE `membership_packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `workout_plans`
--
ALTER TABLE `workout_plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feedbacks_ibfk_2` FOREIGN KEY (`coach_id`) REFERENCES `coaches` (`coach_id`) ON DELETE CASCADE;

--
-- Constraints for table `workout_plans`
--
ALTER TABLE `workout_plans`
  ADD CONSTRAINT `workout_plans_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `workout_plans_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `membership_packages` (`package_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `workout_plans_ibfk_3` FOREIGN KEY (`coach_id`) REFERENCES `coaches` (`coach_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
