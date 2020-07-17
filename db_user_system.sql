-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2020 at 09:30 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_user_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `feedback` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `replied` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `uid`, `subject`, `feedback`, `created_at`, `replied`) VALUES
(1, 7, 'About this project', 'User Management System With Admin Panel.', '2020-06-25 10:06:06', 0),
(2, 4, 'About this project', 'User Management System with Admin Panel.', '2020-06-25 10:11:07', 0),
(3, 4, 'Test Feedback', 'I am writing test feedback', '2020-06-25 11:06:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `uid`, `title`, `note`, `created_at`, `updated_at`) VALUES
(2, 4, 'Graphic designers', 'Graphic designers create visual concepts, using computer software or by hand, to communicate ideas that inspire, inform, and captivate consumers. They develop the overall layout and production design for applications such as advertisements, brochures, magazines, and reports.', '2020-06-17 12:40:27', '2020-06-17 12:40:27'),
(6, 4, 'PHP 7.5.0.1.2', 'PHP is a popular general-purpose scripting language that is especially suited to web development. It was originally created by Danish-Canadian programmer Rasmus Lerdorf in 1994; the PHP reference implementation is now produced by The PHP Group.', '2020-06-18 07:29:46', '2020-06-18 12:51:07'),
(9, 4, 'Web Developer Front End', 'Front-end web developers are responsible for how a website looks. They create the site\'s layout and integrate graphics, applications (such as a retail checkout tool), and other content. They also write webdesign programs in a variety of computer languages, such as HTML or JavaScript', '2020-06-25 11:03:28', '2020-06-25 11:05:03'),
(10, 7, 'Web Developer', 'Front-end web developers are responsible for how a website looks. They create the site\'s layout and integrate graphics, applications (such as a retail checkout tool), and other content. They also write webdesign programs in a variety of computer languages, such as HTML or JavaScript', '2020-06-25 11:09:26', '2020-06-25 11:09:26'),
(11, 7, 'Data Science', 'Data science is an inter-disciplinary field that uses scientific methods, processes, algorithms and systems to extract knowledge and insights from many structural and unstructured data. Data science is related to data mining, deep learning and big data.', '2020-06-25 11:20:32', '2020-06-25 11:20:32'),
(12, 7, 'PHP 7', 'PHP 7 is one of the biggest source of code \r\nin which you can access open source frame work.', '2020-07-07 09:19:20', '2020-07-07 09:19:20');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `uid`, `type`, `message`, `created_at`) VALUES
(1, 4, 'admin', 'Note added', '2020-06-25 11:03:28'),
(2, 4, 'admin', 'Note updated', '2020-06-25 11:05:03'),
(3, 4, 'admin', 'Profile updated', '2020-06-25 11:05:52'),
(4, 4, 'admin', 'Feedback written', '2020-06-25 11:06:37'),
(5, 7, 'admin', 'Note added', '2020-06-25 11:09:26'),
(6, 7, 'admin', 'Note added', '2020-06-25 11:20:32'),
(13, 7, 'user', 'Notification Message From Admin', '2020-06-27 05:32:18'),
(14, 7, 'user', 'Some notification send from Admin\r\n', '2020-06-27 11:02:49'),
(15, 7, 'admin', 'Note added', '2020-07-07 09:19:20'),
(16, 7, 'admin', 'Profile updated', '2020-07-10 06:12:18'),
(17, 4, 'admin', 'Profile updated', '2020-07-10 06:14:23'),
(18, 4, 'admin', 'Profile updated', '2020-07-10 06:14:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dob` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `token_expire` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `gender`, `dob`, `photo`, `token`, `token_expire`, `created_at`, `verified`, `deleted`) VALUES
(1, 'test', 'test@gmail.com', '$2y$10$6v5XQUhHwpvl3tyo6tVsfu7lvClzSTQ.kgDUNV2G0lq.i/rA9Xk.G', '', 'Male', '', '', '', '2020-07-10 09:41:04', '2020-06-10 06:41:02', 0, 0),
(2, 'test', 'test2@gmail.com', '$2y$10$4XfQFhO4IcBs1r9NIzaPxu2DT3slo2LoeulZdImga0ywhy9hukdOa', '', 'Male', '', '', '', '2020-07-10 09:44:07', '2020-06-10 06:48:48', 0, 0),
(3, 'iqrar', 'b.iqrar15@gmail.com', '$2y$10$NQ8uT23r80RNTpcMY87CkO6NfkE/amRjL7ZRDS7cbp5mjLmbc2OoO', '', 'Male', '', '', '', '2020-07-10 09:40:37', '2020-06-12 10:33:30', 0, 0),
(4, 'Abra Doctor', 'b_iqrar@yahoo.com', '$2y$10$swr9yF8aTc0OfeQzEW.kJe19UjILIWI8w/Qp1ZmxZZZEYsLU4dIhG', '0303554205254', 'Female', '2019-01-20', 'uploads/nursing-quotes-instagram.jpg', 'bf53024e5b4ef', '2020-07-10 12:29:25', '2020-06-12 11:29:17', 1, 1),
(5, 'Aitizaz', 'aitiali.hassan@gmail.com', '$2y$10$/E/jk4maxIjgZgNrUzGR4.OMqrNewIINe9Jk99NIU8UoNeNk6BXDe', '', '', '', '', 'c8b32ee44bb54', '2020-07-10 09:41:35', '2020-06-12 11:50:05', 0, 0),
(7, 'Naina', 'iqrarnaina121@gmail.com', '$2y$10$lwqLAt1v6tZAtmXXyClGbOm0cptxzpV2yc8e.Q3oyvKE.6waxwkIu', '25245845856454', 'Female', '1992-05-04', 'uploads/nurse-7.jpg', '', '2020-07-10 06:12:18', '2020-06-25 05:47:29', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(2) NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `hits`) VALUES
(0, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
