-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2023 at 01:04 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_systemdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `gender` text NOT NULL,
  `age` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `gender`, `age`, `created_at`, `updated_at`) VALUES
(1, 'Stephen King', 'Male', '75', '2023-04-05 23:10:17', '2023-04-05 23:10:17'),
(2, 'Charles Dickens', 'Male', '58', '2023-04-05 23:11:00', '2023-04-05 23:11:00'),
(3, 'William Shakespeare', 'Male', '52', '2023-04-05 23:11:35', '2023-04-05 23:11:35'),
(4, 'Virginia Woolf', 'Female', '59', '2023-04-05 23:12:47', '2023-04-05 23:12:47'),
(5, 'Jane Austen', 'Female', '41', '2023-04-05 23:13:07', '2023-04-05 23:13:07'),
(6, 'Burley Harris', 'male', '27', '1988-06-25 21:10:47', '1987-09-10 07:59:22'),
(7, 'Miss Kailey Robel DDS', 'female', '54', '2020-09-22 18:11:28', '1987-01-23 06:28:48'),
(8, 'Dr. Kennedy Hayes', 'male', '25', '2002-03-17 14:48:28', '1971-10-15 02:14:43'),
(9, 'Mr. Dock Reilly', 'male', '48', '1973-09-10 14:54:55', '2012-03-08 22:53:53'),
(10, 'Waino Barton', 'male', '66', '1987-04-27 09:13:46', '1992-10-02 13:04:33'),
(11, 'Daren Carroll', 'female', '46', '1987-01-01 06:23:03', '1978-04-26 08:31:30'),
(12, 'Eliane Reichert', 'female', '50', '2008-01-09 02:06:40', '2009-08-02 23:20:24'),
(13, 'Weldon Schaefer V', 'male', '48', '2021-01-10 13:55:23', '1995-05-10 11:43:56'),
(14, 'Ernie Heaney', 'male', '46', '1988-05-30 16:35:23', '1989-08-22 23:51:56'),
(15, 'Dr. Leon Connelly V', 'male', '60', '1992-11-05 00:20:45', '2011-12-23 07:08:49'),
(16, 'zc', 'male', '20', '2023-05-01 19:42:35', '2023-05-01 19:42:35'),
(17, 'Mr. Juvenal Stanton I', 'male', '57', '1973-04-11 08:10:17', '1990-11-08 12:10:20'),
(18, 'Theodora Kovacek', 'male', '49', '1978-09-03 09:19:13', '1999-02-17 15:11:28'),
(19, 'Meda Prohaska', 'male', '61', '1993-08-18 15:59:46', '2004-04-28 01:34:25'),
(20, 'Kale Zemlak PhD', 'female', '34', '2022-05-20 13:08:37', '1991-01-13 21:26:32'),
(21, 'Carolina Murray', 'male', '61', '1976-09-09 17:46:49', '1993-12-04 21:39:10'),
(22, 'Adaline Bailey', 'male', '35', '1995-12-26 12:42:37', '2017-08-29 02:51:09'),
(23, 'Roscoe Gutkowski II', 'male', '31', '2004-06-18 09:25:26', '2010-12-30 22:18:53'),
(24, 'Niko Kessler', 'male', '29', '1989-01-15 08:17:27', '2020-09-24 10:09:01'),
(25, 'Johnson McDermott', 'female', '27', '1998-06-11 15:27:38', '1995-05-20 18:26:57'),
(26, 'Nia Dach', 'male', '43', '2003-12-06 05:19:10', '2008-04-16 12:16:17');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `imgpath` text NOT NULL,
  `date_released` text NOT NULL,
  `nums` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `genre_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `author_id`, `title`, `imgpath`, `date_released`, `nums`, `created_at`, `updated_at`, `genre_id`, `deleted_at`) VALUES
(1, 5, 'Pride and Prejudice', '/storage/images/1680765887_pride-and-prejudice-71.jpg', '1813-01-28', 21, '2023-04-05 23:24:47', '2023-06-25 01:00:40', 2, NULL),
(2, 4, 'Orlando: A Biography', '/storage/images/1680766227_61H2pXwQ7ZL.jpg', '1928-10-11', 19, '2023-04-05 23:30:27', '2023-06-25 00:59:16', 4, NULL),
(3, 3, 'Romeo and Juliet', '/storage/images/1680766472_711TxX8cdlL.jpg', '1597-01-15', 4, '2023-04-05 23:34:32', '2023-06-25 00:47:56', 31, NULL),
(4, 2, 'Great Expectations', '/storage/images/1680766638_great-expectations-30.jpg', '1861-08-20', 2, '2023-04-05 23:37:18', '2023-06-25 00:44:04', 29, NULL),
(5, 1, 'The Shining', '/storage/images/1680766781_the-shining-1.jpg', '1977-01-28', 0, '2023-04-05 23:39:41', '2023-04-29 09:22:24', 18, NULL),
(6, 5, 'asd', '/storage/images/1680858659_Screenshot (32).png', '2023-04-07', 1, '2023-04-07 01:11:00', '2023-06-24 03:11:55', 17, NULL),
(7, 3, 'adsdg12', '/storage/images/1680859149_Screenshot (75).png', '2023-04-07', 22, '2023-04-07 01:19:09', '2023-06-25 00:48:56', 17, NULL),
(8, 2, 'asd', '/storage/images/1680878086_329878066_559734946099707_116816813442466908_n.jpg', '2023-04-19', 0, '2023-04-07 06:34:46', '2023-05-01 15:11:21', 16, NULL),
(9, 2, 'dgdfg', '/storage/images/1680963952_338333534_775227964221383_8025519853747837780_n.jpg', '2023-04-08', 40, '2023-04-08 06:25:53', '2023-05-01 19:16:46', 17, NULL),
(10, 1, 'asdqwefdgdfg', '/storage/images/1680966250_329660472_1220113555564806_4311885915757277745_n.jpg', '2023-04-20', 0, '2023-04-08 07:04:10', '2023-05-01 15:11:22', 17, NULL),
(11, 2, 'Nisi illo voluptas assumenda.', 'https://via.placeholder.com/640x480.png/003366?text=ex', '1998-05-22', 20, '1991-12-15 12:09:31', '1981-03-12 05:53:18', 1, NULL),
(12, 5, 'Reprehenderit aperiam quaerat fugit.', 'https://via.placeholder.com/640x480.png/006688?text=eos', '1993-02-14', 90, '1998-07-21 22:39:45', '1977-07-17 10:43:39', 10, NULL),
(13, 5, 'Sapiente molestias ut autem asperiores aut similique.', 'https://via.placeholder.com/640x480.png/0077bb?text=aut', '1992-02-01', 57, '2002-01-28 02:15:37', '2010-04-27 08:38:13', 5, NULL),
(14, 2, 'Autem inventore a enim molestiae ab esse libero.', 'https://via.placeholder.com/640x480.png/00ffff?text=eius', '1970-01-08', 22, '2009-05-30 12:15:23', '2000-05-06 05:00:41', 3, NULL),
(15, 5, 'Aut quo totam non ad voluptates veritatis.', 'https://via.placeholder.com/640x480.png/000099?text=aut', '1978-01-02', 47, '1979-08-09 08:08:12', '1978-04-26 15:33:10', 3, NULL),
(16, 3, 'Quod unde et repudiandae quia voluptatem eum et nemo.', 'https://via.placeholder.com/640x480.png/00bbdd?text=id', '2010-01-02', 52, '2007-10-08 22:15:59', '1985-01-27 06:47:11', 3, NULL),
(17, 3, 'Eum maiores natus consectetur facere.', 'https://via.placeholder.com/640x480.png/00ddaa?text=illo', '1979-06-13', 76, '1997-12-22 22:36:14', '2019-02-16 13:49:41', 5, NULL),
(18, 2, 'Est qui sed qui et omnis.', 'https://via.placeholder.com/640x480.png/0000ff?text=dignissimos', '2020-02-25', 43, '2007-01-08 16:45:50', '1970-09-11 22:10:44', 8, NULL),
(19, 5, 'Veritatis temporibus dignissimos molestias quia.', 'https://via.placeholder.com/640x480.png/000033?text=non', '2013-01-09', 93, '1985-07-10 04:05:04', '2015-11-04 11:19:14', 2, NULL),
(20, 1, 'Repudiandae tempora quis voluptatibus sunt quia.', 'https://via.placeholder.com/640x480.png/006633?text=saepe', '1991-09-20', 99, '2013-05-06 17:12:55', '1990-02-15 05:08:32', 7, NULL),
(21, 1, 'Qui ut laborum dicta eos.', 'https://via.placeholder.com/640x480.png/00ddbb?text=voluptates', '1973-10-15', 19, '1999-12-15 16:09:12', '2011-08-08 19:57:03', 8, NULL),
(22, 5, 'Architecto enim minus modi non aspernatur qui optio quo.', 'https://via.placeholder.com/640x480.png/00aa44?text=ipsam', '2008-03-11', 18, '1970-06-05 12:59:24', '1998-05-15 15:38:32', 7, NULL),
(23, 5, 'Voluptas temporibus aperiam eveniet repellat ipsum.', 'https://via.placeholder.com/640x480.png/0077ff?text=ea', '2018-07-19', 96, '1975-01-24 23:38:07', '2015-12-30 08:09:11', 5, NULL),
(24, 2, 'Amet ut consequatur ab impedit dolores.', 'https://via.placeholder.com/640x480.png/00aa99?text=magnam', '2002-01-31', 68, '1970-06-02 16:25:19', '2013-05-07 13:50:25', 9, NULL),
(25, 1, 'Impedit voluptatem et aut tempore nisi iste.', 'https://via.placeholder.com/640x480.png/00ddbb?text=et', '1997-12-17', 10, '1972-07-06 10:12:32', '1984-11-14 10:37:36', 2, NULL),
(26, 4, 'Quo magni debitis et repellat qui.', 'https://via.placeholder.com/640x480.png/0044ee?text=nihil', '1990-05-11', 70, '1998-12-17 02:57:39', '1992-07-18 04:32:19', 7, NULL),
(27, 1, 'Consectetur nam est et blanditiis doloribus eligendi amet.', 'https://via.placeholder.com/640x480.png/001122?text=eligendi', '1979-03-19', 30, '1979-11-09 23:46:40', '1981-03-25 22:41:41', 4, NULL),
(28, 2, 'Sit odio repudiandae in aut ipsam tenetur.', 'https://via.placeholder.com/640x480.png/0011ee?text=ullam', '1972-07-28', 5, '1993-05-07 04:01:22', '2011-07-20 05:38:30', 5, NULL),
(29, 3, 'Omnis molestiae est deserunt natus.', 'https://via.placeholder.com/640x480.png/009922?text=ut', '1987-10-10', 32, '1975-07-01 08:23:28', '1998-03-13 09:08:32', 7, NULL),
(30, 1, 'Vel voluptatum voluptas doloremque quidem nam quo.', 'https://via.placeholder.com/640x480.png/00aa88?text=error', '2008-02-27', 22, '2012-07-19 13:06:28', '2023-06-25 21:59:38', 3, '2023-06-25 21:59:38');

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

CREATE TABLE `borrows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `due_date` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `penalty` text DEFAULT NULL,
  `quantity` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `borrows`
--

INSERT INTO `borrows` (`id`, `user_id`, `book_id`, `due_date`, `created_at`, `updated_at`, `deleted_at`, `penalty`, `quantity`) VALUES
(1, 1, 1, NULL, '2023-06-25 00:57:24', '2023-06-25 01:00:44', NULL, '0', '1'),
(2, 1, 1, NULL, '2023-06-25 00:57:33', '2023-06-25 01:00:44', NULL, '0', '1'),
(3, 1, 2, NULL, '2023-06-25 00:58:54', '2023-06-25 00:59:19', NULL, '0', '1'),
(4, 1, 1, NULL, '2023-06-25 00:59:03', '2023-06-25 01:00:44', NULL, '0', '1'),
(5, 1, 1, NULL, '2023-06-25 00:59:16', '2023-06-25 01:00:44', NULL, '0', '1'),
(6, 1, 2, NULL, '2023-06-25 00:59:16', '2023-06-25 00:59:19', NULL, '0', '1'),
(7, 1, 1, NULL, '2023-06-25 01:00:40', '2023-06-25 01:00:44', NULL, '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `genre_name` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `genre_name`, `created_at`, `updated_at`) VALUES
(1, 'Narrative', '2023-04-05 23:14:33', '2023-04-05 23:14:33'),
(2, 'Fiction', '2023-04-05 23:14:38', '2023-04-05 23:14:38'),
(3, 'Non-Fiction', '2023-04-05 23:14:52', '2023-04-05 23:14:52'),
(4, 'Novel', '2023-04-05 23:15:02', '2023-04-05 23:15:02'),
(5, 'Poetry', '2023-04-05 23:15:09', '2023-04-05 23:15:09'),
(6, 'Prose', '2023-04-05 23:15:16', '2023-04-05 23:15:16'),
(7, 'Genre Fiction', '2023-04-05 23:15:40', '2023-04-05 23:15:40'),
(8, 'Science Fiction', '2023-04-05 23:15:50', '2023-04-05 23:15:50'),
(9, 'Literary Fiction', '2023-04-05 23:16:02', '2023-04-05 23:16:02'),
(10, 'Mystery', '2023-04-05 23:16:14', '2023-04-05 23:16:14'),
(11, 'Historical Fiction', '2023-04-05 23:16:22', '2023-04-05 23:16:22'),
(12, 'Thriller', '2023-04-05 23:16:30', '2023-04-05 23:16:30'),
(13, 'Short Story', '2023-04-05 23:16:39', '2023-04-05 23:16:39'),
(14, 'Drama', '2023-04-05 23:16:44', '2023-04-05 23:16:44'),
(15, 'Fable', '2023-04-05 23:16:51', '2023-04-05 23:16:51'),
(16, 'Fantasy', '2023-04-05 23:16:55', '2023-04-05 23:16:55'),
(17, 'Horror Fiction', '2023-04-05 23:17:09', '2023-04-05 23:17:09'),
(18, 'Horror', '2023-04-05 23:17:14', '2023-04-05 23:17:14'),
(19, 'Magical Realism', '2023-04-05 23:17:26', '2023-04-05 23:17:26'),
(20, 'Essay', '2023-04-05 23:17:37', '2023-04-05 23:17:37'),
(21, 'Romance', '2023-04-05 23:17:42', '2023-04-05 23:17:42'),
(22, 'History', '2023-04-05 23:18:20', '2023-04-05 23:18:20'),
(23, 'Fairy Tail', '2023-04-05 23:18:25', '2023-04-05 23:18:25'),
(24, 'Children\'s Literature', '2023-04-05 23:18:40', '2023-04-05 23:18:40'),
(25, 'Fantasy Fiction', '2023-04-05 23:18:50', '2023-04-05 23:18:50'),
(26, 'Creative NonFiction', '2023-04-05 23:19:01', '2023-04-05 23:19:01'),
(27, 'Literary Realism', '2023-04-05 23:19:18', '2023-04-05 23:19:18'),
(28, 'Western Fiction', '2023-04-05 23:19:33', '2023-04-05 23:19:33'),
(29, 'Bildungsroman', '2023-04-05 23:19:39', '2023-04-05 23:19:39'),
(30, 'Biography', '2023-04-05 23:19:45', '2023-04-05 23:19:45'),
(31, 'Tragedy', '2023-04-05 23:19:58', '2023-04-05 23:19:58'),
(32, 'Mythology', '2023-04-05 23:20:04', '2023-04-05 23:20:04'),
(33, 'Legend', '2023-04-05 23:20:09', '2023-04-05 23:20:09'),
(34, 'Speculative fiction', '2023-04-05 23:20:17', '2023-04-05 23:20:17'),
(35, 'Young adult fiction', '2023-04-05 23:20:22', '2023-04-05 23:20:22'),
(36, 'Romance novel', '2023-04-05 23:20:27', '2023-04-05 23:20:27'),
(37, 'Epic poetry', '2023-04-05 23:20:35', '2023-04-05 23:20:35'),
(38, 'Autobiography', '2023-04-05 23:20:40', '2023-04-05 23:20:40'),
(39, 'Comedy', '2023-04-05 23:20:46', '2023-04-05 23:20:46'),
(40, 'Lyric poetry', '2023-04-05 23:21:00', '2023-04-05 23:21:00'),
(41, 'Literary criticism', '2023-04-05 23:21:05', '2023-04-05 23:21:05'),
(42, 'Personal development', '2023-04-05 23:21:14', '2023-04-05 23:21:14'),
(43, 'Humor', '2023-04-05 23:21:23', '2023-04-05 23:21:23'),
(44, 'Memoir', '2023-04-05 23:21:28', '2023-04-05 23:21:28'),
(45, 'Action fiction', '2023-04-05 23:21:32', '2023-04-05 23:21:32'),
(46, 'Self-help book', '2023-04-05 23:21:39', '2023-04-05 23:21:39'),
(47, 'Western', '2023-04-05 23:21:44', '2023-04-05 23:21:44'),
(48, 'Play', '2023-04-05 23:21:49', '2023-04-05 23:21:49'),
(49, 'Graphic novel', '2023-04-05 23:21:57', '2023-04-05 23:21:57'),
(50, 'Folklore', '2023-04-05 23:22:03', '2023-04-05 23:22:03'),
(51, 'Folklore', '2023-04-05 23:22:03', '2023-04-05 23:22:03'),
(52, 'Poem', '2023-04-05 23:22:07', '2023-04-05 23:22:07'),
(53, 'explicabo', '1977-04-02 17:35:11', '1977-11-18 12:28:33'),
(54, 'ut', '2010-04-01 17:51:47', '2006-03-23 23:32:58'),
(55, 'rem', '1973-02-13 02:04:23', '1993-03-30 05:07:13'),
(56, 'aut', '2002-01-22 05:32:42', '1982-10-15 11:17:55'),
(57, 'necessitatibus', '1990-01-27 17:18:20', '2014-09-16 21:54:52'),
(58, 'illum', '2015-08-06 11:34:13', '1978-11-17 21:17:56'),
(59, 'nisi', '2002-02-16 08:51:30', '2020-08-02 14:48:28'),
(60, 'minus', '2012-04-27 04:55:49', '1972-01-04 04:50:16'),
(61, 'nihil', '1974-12-12 07:59:54', '2019-06-04 05:01:00'),
(62, 'possimus', '1999-05-24 18:08:23', '2016-12-29 01:09:43'),
(63, 'Folklore', '2023-05-01 19:41:59', '2023-05-01 19:41:59'),
(64, 'ad', '2023-05-01 19:42:04', '2023-05-01 19:42:04'),
(65, 'molestiae', '2012-01-08 15:08:09', '1987-05-15 16:35:45'),
(66, 'doloribus', '1984-03-11 01:41:23', '2004-12-12 17:29:35'),
(67, 'tempore', '2015-04-05 15:13:21', '1997-02-09 07:32:44'),
(68, 'non', '2005-07-27 12:32:49', '1995-03-19 10:13:30'),
(69, 'pariatur', '2013-07-05 02:27:09', '2020-03-20 08:21:44'),
(70, 'quisquam', '2008-04-16 04:36:05', '2019-07-31 11:52:07'),
(71, 'est', '2020-08-16 21:34:13', '1980-07-13 09:34:48'),
(72, 'omnis', '1985-07-25 09:26:55', '1980-07-21 01:52:33'),
(73, 'rerum', '1980-09-28 01:51:17', '1974-11-12 21:35:56'),
(74, 'illo', '2007-12-19 10:07:46', '2016-03-06 14:57:16');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_03_28_154944_create_authors_table', 2),
(9, '2023_03_28_155807_create_books_table', 3),
(10, '2023_03_29_070023_create_genres_table', 3),
(11, '2023_04_02_072610_add_timestamps_at_author', 4),
(12, '2023_04_04_063631_add_timestaps_to_genres', 5),
(13, '2023_04_04_125747_add_name_to_books', 6),
(16, '2023_04_04_141829_add_timestaps_to_books', 7),
(17, '2023_04_05_030051_add_imgpath_to_books', 7),
(20, '2023_04_05_033034_book_genre_pivot_table', 8),
(21, '2023_04_05_072455_add_genre_id_to_books', 9),
(22, '2023_04_07_072210_create_borrows_table', 10),
(23, '2023_04_07_090628_add_deleted_at_to_borrows', 11),
(24, '2023_04_07_090628_add_deleted_at_to_books', 12),
(25, '2023_04_08_110814_add_deleted_at_to_borrows_table', 13),
(26, '2023_04_09_030413_add_penalty_to_borrows_table', 14),
(27, '2023_04_11_061152_create_stocks_table', 15),
(28, '2023_04_29_165222_add_num_to_books_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `stock` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `book_id`, `stock`, `created_at`, `updated_at`) VALUES
(1, 1, '100', '2023-06-25 00:55:19', '2023-07-09 21:34:16'),
(2, 3, '99', '2023-06-25 00:55:23', '2023-06-25 00:55:23'),
(3, 4, '99', '2023-06-25 00:55:27', '2023-06-25 00:55:27'),
(4, 5, '99', '2023-06-25 00:55:30', '2023-06-25 00:55:30'),
(5, 6, '12', '2023-06-25 00:55:42', '2023-06-25 00:55:42'),
(6, 7, '88', '2023-06-25 00:56:01', '2023-06-25 00:56:01'),
(7, 2, '97', NULL, '2023-06-25 00:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` text NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '1', NULL, '$2y$10$vghxcjLzcx4ob.CEtgYy0u4Ehiz9M9mPiguU/jIqafpAGl7xW7NUu', NULL, NULL, NULL),
(2, 'Jurome', 'user1@gmail.com', '0', NULL, '$2y$10$SB.z7Y91lJGKoXIrFNzY3uBOoA8xDXooWs68eZT9OuZMT08YbnaxK', NULL, NULL, NULL),
(3, 'Euman', 'user2@gmail.com', '0', NULL, '$2y$10$yWbe5p.9lnV7ZrqJefDY4.cWdKwI8IzS2Ry.idtgCNw9yA5TtKJtK', NULL, NULL, NULL),
(4, 'Dave', 'user3@gmail.com', '0', NULL, '$2y$10$y.3aXXvicjuPVL/sOF/Hu.0j8h5I75YUsDAACNKbd0fA6s4s1tmHG', NULL, NULL, NULL),
(5, 'Ampol', 'user4@gmail.com', '1', NULL, '$2y$10$Eo9HODOUn8L6Qb6sOiHHXuGLeHfop8BD0xRUBqM3wFMXYDDUZkPAC', NULL, NULL, NULL),
(6, 'example', 'sample@gmail.com', '1', NULL, '$2y$10$gX5ejNH1gsCreuaotUhgUeIbtOLw0DXkgjgvH3Dba6zZQKX7a0MdC', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_author_id_foreign` (`author_id`),
  ADD KEY `books_genre_id_foreign` (`genre_id`);

--
-- Indexes for table `borrows`
--
ALTER TABLE `borrows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrows_user_id_foreign` (`user_id`),
  ADD KEY `borrows_book_id_foreign` (`book_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_book_id_foreign` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `borrows`
--
ALTER TABLE `borrows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `books_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `borrows`
--
ALTER TABLE `borrows`
  ADD CONSTRAINT `borrows_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrows_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
