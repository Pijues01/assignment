-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2025 at 08:34 PM
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
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'User',
  `profileimg` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `password`, `role`, `profileimg`, `created_at`, `updated_at`) VALUES
(89, 'Ram smithh', 'ram@gmail.com', '9974512365', '$2y$12$PGcbNCgMn950AQtm8WOCHeZm8D3jtyDRiUyg9zmlXg76zoo1j6rtO', 'User', 'profile_images/ejAjBVhMUsq4wp95d8I4aJa6qTXuSmLXWoy1vxJU.jpg', '2025-03-03 13:05:45', '2025-03-03 15:35:39'),
(112, 'Admin', 'admin@gmail.com', '9848414984', '$2y$12$FwOjByYr8nwHhkn4ufTe6./U8WiN.1oMKigwe4D6beO5bi.qm/GZ2', 'Admin', 'profile_images/o00Jr1qEFtz6Bdlt7wbIJl8x5rlKq0gccWt3Klwg.jpg', '2025-03-03 15:30:28', '2025-03-03 15:30:28'),
(114, 'Bikash Senqq', 'senBikashww@gmail.com', '9988556644', '$2y$12$bbcR99hVcMNnDzDrYfzGuOXUoOSiUPpiIMDYOXOBUuTtkqiGCYyVi', 'User', 'profile_images/fTaHMAuNVvf9bbZetHzsholr8QKRM10oypWpQuQY.jpg', '2025-03-03 15:33:57', '2025-03-03 15:35:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
