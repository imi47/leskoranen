-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2018 at 02:24 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quran`
--

-- --------------------------------------------------------

--
-- Table structure for table `juz`
--

CREATE TABLE `juz` (
  `id` int(11) NOT NULL,
  `juz_name` text NOT NULL,
  `status` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(191) DEFAULT NULL,
  `deleted_at` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `role` varchar(191) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(191) DEFAULT NULL,
  `deleted_at` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `role`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Testing', 'recitor', 'block', '2018-05-31 08:29:13', NULL, NULL),
(2, 'frsadfsdfs', 'recitor', 'block', '2018-05-31 08:36:35', NULL, NULL),
(3, 'dgasdgfasdg', 'translator', 'active', '2018-05-31 08:39:02', NULL, NULL),
(4, 'test t', 'translator', 'active', '2018-05-31 08:39:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `surahs`
--

CREATE TABLE `surahs` (
  `id` int(11) NOT NULL,
  `surah_name` varchar(191) NOT NULL,
  `surah_number` int(11) NOT NULL,
  `hizb` int(11) NOT NULL,
  `raku` int(11) NOT NULL,
  `verses` int(11) NOT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(191) DEFAULT NULL,
  `deleted_at` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surahs`
--

INSERT INTO `surahs` (`id`, `surah_name`, `surah_number`, `hizb`, `raku`, `verses`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'sdgfsda', 4, 4, 4, 4, 'datrergasetgfadg d', '2018-05-29 11:02:24', NULL, NULL),
(2, 'Surah 2', 2, 1, 2, 213, 'sampleee', '2018-07-05 11:12:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `role` int(11) NOT NULL DEFAULT '2' COMMENT '1= admins , 2=users',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(191) NOT NULL,
  `deleted_at` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `status`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@gmail.com', '$2y$10$ONN66KqJ/FPaYYCrbB.RaesnGvselmCVWrzMGnDlCeqfExSEWvUg.', 'Babar', 1, 1, '2018-05-22 07:51:58', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `verses`
--

CREATE TABLE `verses` (
  `id` int(11) NOT NULL,
  `arabic_immune` text CHARACTER SET utf8 NOT NULL,
  `arabic_no_immune` text CHARACTER SET utf8 NOT NULL,
  `translation` text CHARACTER SET utf8 NOT NULL,
  `translator_id` int(11) NOT NULL,
  `link_to_audio` varchar(191) NOT NULL,
  `recitor_id` int(11) NOT NULL,
  `hizb` int(11) NOT NULL,
  `raku` int(11) NOT NULL,
  `verse` int(11) NOT NULL,
  `surah_id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(191) DEFAULT NULL,
  `deleted_at` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verses`
--

INSERT INTO `verses` (`id`, `arabic_immune`, `arabic_no_immune`, `translation`, `translator_id`, `link_to_audio`, `recitor_id`, `hizb`, `raku`, `verse`, `surah_id`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'اَلۡحَمۡدُ لِلّٰهِ رَبِّ الۡعٰلَمِيۡنَۙ‏', 'اَلۡحَمۡدُ لِلّٰهِ رَبِّ الۡعٰلَمِيۡنَۙ‏', 'I Guds, den Barmhjertiges, den Nåderikes navn', 3, '1_1.mp3', 2, 2, 2, 1, 1, 'this is test', '2018-05-31 11:28:07', NULL, NULL),
(7, 'الرَّحۡمٰنِ الرَّحِيۡمِۙ‏', 'الرَّحۡمٰنِ الرَّحِيۡمِۙ‏', 'Lovet være Gud, all verdens Herre,', 3, '1_1.mp3', 1, 1, 2, 2, 1, 'sfasdfaasd', '2018-06-11 11:01:20', NULL, NULL),
(8, 'مٰلِكِ يَوۡمِ الدِّيۡنِؕ‏', 'مٰلِكِ يَوۡمِ الدِّيۡنِؕ‏', 'Han, den Barmhjertige, den Nåderike,', 3, '1_1.mp3', 2, 1, 1, 3, 1, 'asdfasdffasf ssdgsdg', '2018-06-11 11:26:21', NULL, NULL),
(9, 'Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2', 'Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2', 'Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2', 4, 'Sample SuraH 2', 1, 1, 2, 14, 2, 'Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2', '2018-07-05 11:15:56', NULL, NULL),
(10, 'Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2', 'Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2', 'Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2', 4, 'Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2', 1, 1, 2, 2, 2, 'Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2Sample SuraH 2', '2018-07-05 11:16:49', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surahs`
--
ALTER TABLE `surahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verses`
--
ALTER TABLE `verses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surahs`
--
ALTER TABLE `surahs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `verses`
--
ALTER TABLE `verses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
