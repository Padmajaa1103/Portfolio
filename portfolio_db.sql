-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2026 at 02:28 PM
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
-- Database: `portfolio_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password_hash`, `created_at`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-04-07 16:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `id` int(11) NOT NULL,
  `course` varchar(150) NOT NULL,
  `issuer` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`id`, `course`, `issuer`, `image`, `created_at`) VALUES
(4, 'Software engineering ', 'Infosys springboard ', 'assets/uploads/certifications/cert-1776096840-66ceddcf.jpeg', '2026-04-13 16:14:00'),
(5, 'Database Management System ', 'Udemy', 'assets/uploads/certifications/cert-1776096893-97646b6e.jpg', '2026-04-13 16:14:53'),
(6, 'Web development', 'Infosys springboard ', 'assets/uploads/certifications/cert-1776096978-cf208fa6.jpeg', '2026-04-13 16:16:18'),
(7, 'HTML', 'Great learning', 'assets/uploads/certifications/cert-1776097028-e2279a71.jpg', '2026-04-13 16:17:08'),
(8, 'Google Ads', 'Coursera', 'assets/uploads/certifications/cert-1776097045-b4d31e41.jpg', '2026-04-13 16:17:25'),
(9, 'Java', 'VJTech Academy ', 'assets/uploads/certifications/cert-1776097125-821a794c.jpg', '2026-04-13 16:18:45');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(11) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `institution` varchar(100) NOT NULL,
  `year` varchar(20) NOT NULL,
  `score` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `degree`, `institution`, `year`, `score`, `created_at`) VALUES
(3, '10 th', 'New English School , Khanderajuri', '2021-22', '95.80%', '2026-04-15 02:52:39'),
(4, 'Diploma ', 'Government Polytechnic , Kolhapur ', '2022-25', '92.47', '2026-04-15 02:53:05'),
(5, 'BTech (current)', 'Rajarambapu Institute Of Technology , Rajaramnagr', '2026', '8.17 ', '2026-04-15 02:54:32');

-- --------------------------------------------------------

--
-- Table structure for table `internships`
--

CREATE TABLE `internships` (
  `id` int(11) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `role` varchar(100) NOT NULL,
  `learnings` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `internships`
--

INSERT INTO `internships` (`id`, `organization`, `duration`, `role`, `learnings`, `image`, `created_at`) VALUES
(2, 'iGAP Technologies Pvt. Ltd.', '1 Month', 'Intern Web Developer', '💻 Web development fundamentals 🔧 Task execution with responsibility 🧠 Improved problem-solving skills 🚀 Quick learner with professional discipline', 'assets/uploads/internships/intern-1776095340-0b47d3e0.jpg', '2026-04-13 15:49:00'),
(3, 'MultiSpark Technologies', '1 Month', 'Intern Android Application Developer', '📱 Learned and applied core Android application development concepts 🧩 Completed assigned tasks with diligence and responsibility 🚀 Improved technical, analytical, and problem-solving skills 🎯 Demonstrated quick learning ability, discipline, and a professional work approach', 'assets/uploads/internships/intern-1776095363-b22aa6da.jpg', '2026-04-13 15:49:23');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `technologies` varchar(255) DEFAULT NULL,
  `features` text DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL,
  `demo_url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `technologies`, `features`, `github_url`, `demo_url`, `image`, `created_at`) VALUES
(4, 'Personal Expense Tracker', 'A comprehensive Java-based desktop application for tracking and managing personal expenses with budget management, data visualization, and reporting capabilities.\r\n\r\n', 'Java', ' Expense Tracking: Add, view, and manage daily expenses with categories ; Budget Management: Set and monitor monthly budgets across different spending categories ; Data Visualization: Interactive pie charts and bar charts for expense analysis ; Advanced Search: Filter expenses by date range, amount, and search terms ; Report Generation: Generate and export monthly expense reports ; Database Storage: MySQL database for secure and reliable data persistence ; Modern GUI: Clean, intuitive Swing-based user interface', 'https://github.com/Padmajaa1103/PersonalExpenseTracker', NULL, NULL, '2026-04-15 02:40:03'),
(5, 'PillPilot : Smart AI Medicine Reminder', 'A comprehensive medication management system built with PHP and MySQL. PillPilot helps users track their medications, set reminders, receive refill alerts, and manage family member notifications.', 'PHP , HTML , JavaScript', 'Medicine Management: Add, edit, and track medications with dosage and schedule information ; Adherence Tracking: Log medicine intake and view adherence reports ; Refill Alerts: Get notified when medications are running low ; Family Notifications: Alert family members about missed medications ; SMS Reminders: Receive SMS notifications for medicine schedules (via Twilio) ; AI Health Chatbot: Get health and medication advice from an integrated AI assistant ; Dashboard Overview: Visual summary of today\'s medications and adherence statistics ; PDF Reports: Generate and download medication adherence reports', 'https://github.com/Padmajaa1103/PillPilot', NULL, NULL, '2026-04-15 02:51:29');

-- --------------------------------------------------------

--
-- Table structure for table `resumes`
--

CREATE TABLE `resumes` (
  `id` int(11) NOT NULL,
  `title` varchar(160) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `version` varchar(40) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resumes`
--

INSERT INTO `resumes` (`id`, `title`, `file_path`, `version`, `is_active`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Uploaded 2026-04-13 18:20', 'assets/uploads/resumes/resume-1776097225-cc69e4d0.pdf', NULL, 1, 'Uploaded via admin', '2026-04-13 16:20:25', '2026-04-13 16:20:25');

-- --------------------------------------------------------

--
-- Table structure for table `site_info`
--

CREATE TABLE `site_info` (
  `id` int(11) NOT NULL DEFAULT 1,
  `site_title` varchar(100) DEFAULT 'Student Portfolio',
  `name` varchar(100) NOT NULL DEFAULT 'Your Name',
  `title` varchar(100) DEFAULT 'Computer Science Student',
  `tagline` varchar(255) DEFAULT 'Building thoughtful web experiences, one project at a time.',
  `profile_photo` varchar(255) DEFAULT 'assets/img/profile.jpg',
  `resume_url` varchar(255) DEFAULT NULL,
  `hero_email` varchar(100) DEFAULT NULL,
  `about_intro` text DEFAULT NULL,
  `education_background` varchar(255) DEFAULT NULL,
  `career_goal` text DEFAULT NULL,
  `strengths` text DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT 'All rights reserved.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_info`
--

INSERT INTO `site_info` (`id`, `site_title`, `name`, `title`, `tagline`, `profile_photo`, `resume_url`, `hero_email`, `about_intro`, `education_background`, `career_goal`, `strengths`, `contact_email`, `phone`, `linkedin`, `github`, `location`, `footer_text`) VALUES
(1, 'Student Portfolio', 'Padmaja Ashok Chougule', 'Computer Science Student', 'Building thoughtful web experiences, one project at a time.', 'assets/uploads/profile/profile-1776094829-556bfa65.jpg', 'assets/uploads/resumes/resume-1776097225-cc69e4d0.pdf', 'padmajachougule64@gmail.com', 'Hello, I’m Padmaja Ashok Chougule, a final-year diploma student with a strong interest in web development and modern technologies. I enjoy creating responsive and visually appealing websites using HTML, CSS, JavaScript, and React. I am passionate about designing user-friendly interfaces with creative styling, animations, and unique layouts.', 'B.Tech in Computer Science, Rajarambapu Institute Of Technology , Rajaramnagar.', 'Start as a frontend or full-stack developer and grow into a product-focused engineer.', 'Detail-oriented, collaborative, quick learner, problem solver, clear communicator.', 'padmajachougule64@gmail.com', '+91 8010398040', 'https://www.linkedin.com/in/padmaja-chougule-b32719303/', 'https://github.com/Padmajaa1103', 'Sangli, India', 'Padmaja Chougule!!');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `category`, `name`, `created_at`) VALUES
(1, 'Programming Languages', 'JavaScript', '2026-04-07 16:19:42'),
(2, 'Programming Languages', 'Python', '2026-04-07 16:19:42'),
(3, 'Programming Languages', 'C++', '2026-04-07 16:19:42'),
(4, 'Web Technologies', 'HTML5', '2026-04-07 16:19:42'),
(5, 'Web Technologies', 'CSS3', '2026-04-07 16:19:42'),
(7, 'Web Technologies', 'React (Basics)', '2026-04-07 16:19:42'),
(8, 'Databases', 'MySQL', '2026-04-07 16:19:42'),
(9, 'Databases', 'MongoDB (Intro)', '2026-04-07 16:19:42'),
(10, 'Tools', 'Git/GitHub', '2026-04-07 16:19:42'),
(11, 'Tools', 'VS Code', '2026-04-07 16:19:42'),
(12, 'Tools', 'Figma', '2026-04-07 16:19:42'),
(13, 'Tools', 'Postman', '2026-04-07 16:19:42'),
(14, 'Soft Skills', 'Teamwork', '2026-04-07 16:19:42'),
(15, 'Soft Skills', 'Adaptability', '2026-04-07 16:19:42'),
(16, 'Soft Skills', 'Presentation', '2026-04-07 16:19:42'),
(17, 'Soft Skills', 'Time Management', '2026-04-07 16:19:42'),
(18, 'Programming Languages', 'C Languages', '2026-04-15 02:35:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_certifications_issuer` (`issuer`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_education_year` (`year`);

--
-- Indexes for table `internships`
--
ALTER TABLE `internships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_projects_created` (`created_at`);

--
-- Indexes for table `resumes`
--
ALTER TABLE `resumes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_info`
--
ALTER TABLE `site_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_skills_category` (`category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `internships`
--
ALTER TABLE `internships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `resumes`
--
ALTER TABLE `resumes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
