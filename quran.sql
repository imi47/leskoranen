-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2018 at 06:13 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

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
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL,
  `email` varchar(191) NOT NULL,
  `surah_id` int(11) NOT NULL,
  `from_verse` int(11) NOT NULL,
  `to_verse` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` varchar(191) DEFAULT NULL,
  `updated_at` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bugs`
--

CREATE TABLE `bugs` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `surah_id` int(11) NOT NULL,
  `from_verse` int(11) NOT NULL,
  `to_verse` int(11) NOT NULL,
  `script` varchar(255) NOT NULL,
  `recitor_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'requested',
  `summery` text NOT NULL,
  `details` text NOT NULL,
  `created_at` varchar(191) NOT NULL,
  `updated_at` varchar(191) DEFAULT NULL,
  `deleted_at` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `juzs`
--

CREATE TABLE `juzs` (
  `id` int(10) UNSIGNED NOT NULL,
  `juz_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `juz_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_surah_id` int(11) DEFAULT NULL,
  `start_verse_id` int(11) DEFAULT NULL,
  `end_surah_id` int(11) DEFAULT NULL,
  `end_verse_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2018_09_17_071321_create_surahs_table', 1),
(3, '2018_10_18_072442_create_juzs_table', 2);

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
(5, 'Islamic Cultural Centre Norway', 'translator', 'active', '2018-08-20 05:17:02', NULL, NULL),
(6, 'Saad al Ghamadi', 'recitor', 'active', '2018-08-20 05:17:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `surahs`
--

CREATE TABLE `surahs` (
  `id` int(10) UNSIGNED NOT NULL,
  `surah_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surah_name_arabic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL COMMENT '1 = Makki , 2 = Madani',
  `surah_number` int(11) NOT NULL DEFAULT '0',
  `juz_ending_id` int(11) NOT NULL DEFAULT '0',
  `juz_id` int(11) NOT NULL DEFAULT '0',
  `hizb` int(11) DEFAULT NULL,
  `raku` int(11) NOT NULL DEFAULT '0',
  `verses` int(11) NOT NULL DEFAULT '0',
  `introduction` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surahs`
--

INSERT INTO `surahs` (`id`, `surah_name`, `surah_name_arabic`, `type_id`, `surah_number`, `juz_ending_id`, `juz_id`, `hizb`, `raku`, `verses`, `introduction`, `description`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 'Al-Fatihah', 'test', 1, 1, 1, 1, NULL, 1, 7, '<p>this is test</p>', 'Surah al-Fatiha er den første sura av Koranen og er resitert i hver bønn som profeten, kan Allahs barmhjertighet og velsignelser være på ham, erklært, \"Det er ingen sala (gyldig) uten åpningskapitlet i boken. \"[1] Når man aksepterer islam, bør en person først huske Surah al-Fatiha for å kunne utføre de foreskrevne bønnene. Dens betydning bør læres og vurderes hver gang vi tilbyr salah.', 1, 1, NULL, '2018-08-20 00:23:08', '2018-10-15 04:29:19'),
(4, 'An-Nas', NULL, NULL, 114, 0, 0, NULL, 0, 6, NULL, 'this is test  this is test  this is test  this is test  this is test .this is test  this is test  this is test  this is test  this is test .this is test  this is test  this is test  this is test  this is test .this is test  this is test  this is test  this is test  this is test .this is test  this is test  this is test  this is test  this is test .', 1, 1, NULL, '2018-09-07 05:34:59', NULL),
(5, 'Al-Falaq', NULL, NULL, 114, 0, 0, NULL, 0, 5, NULL, NULL, 0, 1, NULL, '2018-09-10 08:00:27', NULL),
(6, 'An Nasr', NULL, NULL, 110, 0, 0, NULL, 0, 3, NULL, NULL, 0, 1, NULL, '2018-09-10 08:02:34', NULL),
(7, 'Al-Kafiroon', NULL, NULL, 109, 0, 0, NULL, 0, 6, NULL, 'In the name of Allah Most Gracious Most Merciful.', 0, 1, NULL, '2018-09-12 02:08:09', NULL),
(8, 'Al-Fil', 'الفِیل', 2, 105, 0, 30, NULL, 1, 7, 'Test', 'Test', 1, 1, NULL, '2018-09-17 03:13:51', '2018-09-24 07:08:54'),
(9, 'Al-Fil', 'الفِیل', 1, 105, 0, 30, NULL, 1, 7, 'Test', 'Test', 1, 1, NULL, '2018-09-24 07:06:53', '2018-09-24 07:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `surahs_juzs`
--

CREATE TABLE `surahs_juzs` (
  `id` int(11) NOT NULL,
  `surah_id` int(11) NOT NULL,
  `juz_id` int(11) NOT NULL,
  `verse_to` int(11) NOT NULL,
  `verse_from` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` varchar(191) DEFAULT NULL,
  `updated_at` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `role` int(11) NOT NULL DEFAULT '2' COMMENT '1= admins , 2=users',
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `is_blocked` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(191) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `phone`, `username`, `password`, `name`, `status`, `role`, `is_admin`, `is_blocked`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@gmail.com', NULL, 'usman22', '$2y$10$156Fvwc0tH89HFPzrbibc.xojmTFzA1ukBaMgEcPgMubbsgKQa2IW', 'Babar', 1, 3, 1, 0, 'Uynco2HeGhp2wNuXGA6iBHxwmkpYGma0nB8nbibjZchlxb86xdl6sLtTHebZ', '2018-05-22 07:51:58', '', '0000-00-00 00:00:00'),
(2, 'ali@gmail.com', '3223231323', 'aliraza', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'aLI', 1, 1, 0, 0, NULL, '2018-11-06 06:55:21', '', NULL),
(9, 'haider@gmail.com', '213223213', '4324', '$2y$10$EWwbYom6/9eda04dbeLcduXYtgrFGEg2Rfrnb.GFEhhqI2sSnjY2q', 'Haiderfghfg', 1, 1, 1, 0, NULL, '2018-11-06 12:10:51', '', NULL),
(10, 'haider@gmail.comssssssss', '213223213222', 'sssssssssss', '$2y$10$7EKzBp9Umlh.4mfC0Zw3VeN8Z6iuP1AsqAMUEN80yFMC2KF3FilXq', 'Haiderfghfg', 1, 1, 1, 0, NULL, '2018-11-06 12:13:41', '', NULL);

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
  `link_to_translation_audio` varchar(255) DEFAULT NULL,
  `recitor_id` int(11) NOT NULL,
  `hizb` int(11) DEFAULT NULL,
  `raku` int(11) NOT NULL,
  `verse` int(11) NOT NULL,
  `surah_id` int(11) NOT NULL,
  `juzz_number` int(11) NOT NULL,
  `description` text CHARACTER SET utf8,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(191) DEFAULT NULL,
  `deleted_at` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verses`
--

INSERT INTO `verses` (`id`, `arabic_immune`, `arabic_no_immune`, `translation`, `translator_id`, `link_to_audio`, `link_to_translation_audio`, `recitor_id`, `hizb`, `raku`, `verse`, `surah_id`, `juzz_number`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(22, 'الْحَمْدُ لِلَّهِ رَبِّ الْعَالَمِينَ', 'الحمد لله رب العالمين', 'All lovprising er for Allah, Herre over alle universene.', 5, '1534747198Al-Fatihah_ayah_2.mp3', NULL, 6, NULL, 1, 1, 3, 1, 'test', 0, 1, '2018-08-20 01:39:58', NULL, NULL),
(23, 'الرَّحْمَٰنِ الرَّحِيمِ', 'الرحمن الرحيم', 'Den Barmhjertige, den Nåderike.', 5, '1534747250Al-Fatihah_ayah_3.mp3', NULL, 6, NULL, 1, 2, 3, 1, NULL, 0, 0, '2018-08-20 01:40:50', NULL, NULL),
(24, 'مَالِكِ يَوْمِ الدِّينِ', 'مالك يوم الدين', 'Herre over dommens dag.', 5, '1534747297Al-Fatihah_ayah_4.mp3', NULL, 6, NULL, 1, 3, 3, 1, NULL, 0, 0, '2018-08-20 01:41:37', NULL, NULL),
(25, 'إِيَّاكَ نَعْبُدُ وَإِيَّاكَ نَسْتَعِينُ', 'إياك نعبد وإياك نستعين', 'Deg alene tilber vi, og Deg alene underkaster vi oss.', 5, '1534747600Al-Fatihah_ayah_5.mp3', NULL, 6, NULL, 1, 4, 3, 1, NULL, 0, 0, '2018-08-20 01:46:40', NULL, NULL),
(26, 'اهْدِنَا الصِّرَاطَ الْمُسْتَقِيمَ', 'اهدنا الصراط المستقيم', 'Vis oss Den rette vei,', 5, '1534748027Al-Fatihah_ayah_6.mp3', NULL, 6, NULL, 1, 5, 3, 1, NULL, 0, 0, '2018-08-20 01:53:47', NULL, NULL),
(27, 'صِرَاطَ الَّذِينَ أَنْعَمْتَ عَلَيْهِمْ غَيْرِ الْمَغْضُوبِ عَلَيْهِمْ وَلَا الضَّالِّينَ', 'صراط الذين أنعمت عليهم غير المغضوب عليهم ولا الضالين', 'Veien til de Du har velsignet, som ikke har påkalt seg  Din vrede og ikke er på villspor.', 5, '1534748071Al-Fatihah_ayah_7.mp3', NULL, 6, NULL, 1, 6, 3, 1, NULL, 0, 0, '2018-08-20 01:54:31', NULL, NULL),
(28, 'قُلۡ اَعُوۡذُ بِرَبِّ النَّاسِۙ‏', 'قُلۡ اَعُوۡذُ بِرَبِّ النَّاسِۙ‏', 'TESTTESTTESTTESTTESTTEST', 5, '1536319367surah_nas_1.mp3', NULL, 6, NULL, 45, 1, 4, 30, 'TESTTESTTESTTESTTESTTEST', 0, 0, '2018-09-07 06:22:47', NULL, NULL),
(29, 'مَلِكِ النَّاسِۙ‏', 'مَلِكِ النَّاسِۙ‏', 'test  test  test  test  test  test  test', 5, '1536319563surah_nas_2.mp3', NULL, 6, NULL, 45, 2, 4, 30, 'test  test  test  test  test  test  test  test  test  test  test  test  test  test  test  test  test  test  test', 0, 0, '2018-09-07 06:26:03', NULL, NULL),
(30, 'اِلٰهِ النَّاسِۙ‏', 'اِلٰهِ النَّاسِۙ‏', 'test test test test test test test test test test test', 5, '1536319689surah_nas_3.mp3', NULL, 6, NULL, 45, 3, 4, 30, 'test test test test test test test test test test test test test test test', 0, 0, '2018-09-07 06:28:09', NULL, NULL),
(31, 'مِنۡ شَرِّ الۡوَسۡوَاسِ  ۙ الۡخَـنَّاسِ ۙ‏', 'مِنۡ شَرِّ الۡوَسۡوَاسِ  ۙ الۡخَـنَّاسِ ۙ‏', 'testtesttesttesttest', 5, '1536319869surah_nas_4.mp3', NULL, 6, NULL, 45, 4, 4, 30, 'testtesttesttesttesttesttesttesttesttesttesttesttest', 0, 0, '2018-09-07 06:31:09', NULL, NULL),
(32, 'قُلۡ يٰۤاَيُّهَا الۡكٰفِرُوۡنَۙ‏', 'قُلۡ يٰۤاَيُّهَا الۡكٰفِرُوۡنَۙ‏', 'Say (O Muhammad (SAW) to these Mushrikûn and Kâfirûn): \"O Al-Kâfirûn (disbelievers in Allâh, in His Oneness, in His Angels, in His Books, in His Messengers, in the Day of Resurrection, and in Al-Qadar)!', 5, '1536736392New playlist.zpl', NULL, 6, NULL, 1, 1, 7, 30, 'Say (O Muhammad (SAW) to these Mushrikûn and Kâfirûn): \"O Al-Kâfirûn (disbelievers in Allâh, in His Oneness, in His Angels, in His Books, in His Messengers, in the Day of Resurrection, and in Al-Qadar)!', 0, 0, '2018-09-12 02:13:12', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bugs`
--
ALTER TABLE `bugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `juzs`
--
ALTER TABLE `juzs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `surahs_juzs`
--
ALTER TABLE `surahs_juzs`
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
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bugs`
--
ALTER TABLE `bugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `juzs`
--
ALTER TABLE `juzs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `surahs`
--
ALTER TABLE `surahs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `surahs_juzs`
--
ALTER TABLE `surahs_juzs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `verses`
--
ALTER TABLE `verses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
