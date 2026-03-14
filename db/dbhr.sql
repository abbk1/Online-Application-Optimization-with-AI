-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2026 at 08:03 PM
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
-- Database: `dbhr`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `matched_skills` varchar(255) NOT NULL,
  `missing_skills` varchar(255) NOT NULL,
  `cv_file` varchar(255) DEFAULT NULL,
  `ai_score` int(11) DEFAULT NULL,
  `ai_decision` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `job_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `email`, `skills`, `matched_skills`, `missing_skills`, `cv_file`, `ai_score`, `ai_decision`, `created_at`, `job_id`) VALUES
(2, 'Abubakar Sajo', 'abbk4u@gmail.com', 'php, javascript, html, css, mysql, bootstrap', 'Array', 'Array', 'upload/1773484048_Abubakar_cv.pdf', 83, 'shortlisted', '2026-03-14 10:27:30', 2),
(3, 'Abubakar Sajo', 'abbk4u@gmail.com', 'php, javascript, html, css, mysql, bootstrap', 'php, javascript, html, css, bootstrap', 'mysql', 'upload/1773484164_Abubakar_cv.pdf', 83, 'shortlisted', '2026-03-14 10:29:26', 2),
(4, 'IDRIS UMAR YAZAH', 'IDRISYAZAH@GMAIL.COM', 'php, javascript, html, css, mysql, bootstrap', 'php, javascript, html, css, bootstrap', 'mysql', 'upload/1773484752_Abubakar_cv.pdf', 83, 'shortlisted', '2026-03-14 10:39:14', 2),
(5, 'IDRIS UMAR YAZAH', 'IDRISYAZAH@GMAIL.COM', 'php, javascript, html, css, mysql, bootstrap', 'php, javascript, html, css, bootstrap', 'mysql', 'upload/1773484782_Abubakar_cv.pdf', 83, 'shortlisted', '2026-03-14 10:39:44', 2),
(6, 'IDRIS UMAR YAZAH', 'IDRISYAZAH@GMAIL.COM', 'php, javascript, html, css, mysql, bootstrap', 'php, javascript, html, css, bootstrap', 'mysql', 'upload/1773484806_Abubakar_cv.pdf', 83, 'shortlisted', '2026-03-14 10:40:08', 2),
(7, 'Abubakar Sajo', 'abbk4u@gmail.com', 'python, sql, pandas, data analysis, excel, statistics', '', 'python, sql, pandas, data analysis, excel, statistics', 'upload/1773484830_application.pdf', 0, 'rejected', '2026-03-14 10:40:31', 1),
(8, 'ABUBAKAR SAJO', 'abbk4u@gmai.com', 'Python, Food, Mango, Banana', 'python', 'food, mango, banana', 'upload/1773485094_Abubakar_cv.pdf', 25, 'rejected', '2026-03-14 10:44:56', 4),
(9, 'ABUBAKAR SAJO', 'abbk4u@gmai.com', 'Python, Food, Mango, Banana', '', '', 'upload/1773485781_Abubakar_cv.pdf', 0, 'error', '2026-03-14 10:56:24', 4),
(10, 'Abubakar Sajo', 'abbk4u@gmail.com', 'php, javascript, html, css, mysql, bootstrap', '', '', 'upload/1773485878_Abubakar_cv.pdf', 0, 'error', '2026-03-14 10:58:01', 2),
(11, 'ABUBAKAR SAJO', 'abbk4u@gmai.com', 'Python, Food, Mango, Banana', 'python', 'food, mango, banana', 'upload/1773485935_Abubakar_cv.pdf', 25, 'rejected', '2026-03-14 10:58:56', 4),
(12, 'Shamsu Isa', 'abbk4u@gmail.com', 'Excel, Python, Ruby', 'python', 'excel, ruby', 'upload/1773486854_Abubakar_cv.pdf', 33, 'rejected', '2026-03-14 11:14:16', 5),
(13, 'Gami Musa', 'gami@gmail.com', 'Maths,Python', 'python', 'maths', 'upload/1773487617_Abubakar_cv.pdf', 50, 'shortlisted', '2026-03-14 11:26:59', 6);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `job_title` varchar(200) DEFAULT NULL,
  `required_skills` text DEFAULT NULL,
  `min_score` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_title`, `required_skills`, `min_score`, `created_at`) VALUES
(1, 'Data Analyst', 'python, sql, pandas, data analysis, excel, statistics', 50, '2026-03-14 08:00:34'),
(2, 'Full Stack Web Developer', 'php, javascript, html, css, mysql, bootstrap', 70, '2026-03-14 08:00:57'),
(3, 'Machine Learning Engineer', 'python, machine learning, scikit-learn, pandas, numpy, tensorflow', 75, '2026-03-14 08:01:17'),
(4, 'Accounting', 'Python, Food, Mango, Banana', 60, '2026-03-14 10:44:34'),
(5, 'Data Analytics', 'Excel, Python, Ruby', 50, '2026-03-14 11:13:31'),
(6, 'CEO', 'Maths,Python', 50, '2026-03-14 11:26:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
