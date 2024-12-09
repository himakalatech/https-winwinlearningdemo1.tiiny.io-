-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 02, 2024 at 05:19 AM
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
-- Database: `course_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `Id` int(11) NOT NULL,
  `Name` varchar(500) DEFAULT NULL,
  `SubNm` varchar(500) DEFAULT NULL,
  `detail` varchar(500) DEFAULT NULL,
  `detail1` varchar(500) DEFAULT NULL,
  `detail2` varchar(500) DEFAULT NULL,
  `detail3` varchar(500) DEFAULT NULL,
  `CrDt` datetime DEFAULT NULL,
  `UpDt` datetime DEFAULT NULL,
  `SubNm1` varchar(500) DEFAULT NULL,
  `SubNm2` varchar(500) DEFAULT NULL,
  `SubNm3` varchar(500) DEFAULT NULL,
  `img1` varchar(200) DEFAULT NULL,
  `img2` varchar(200) DEFAULT NULL,
  `img3` varchar(200) DEFAULT NULL,
  `img4` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`Id`, `Name`, `SubNm`, `detail`, `detail1`, `detail2`, `detail3`, `CrDt`, `UpDt`, `SubNm1`, `SubNm2`, `SubNm3`, `img1`, `img2`, `img3`, `img4`) VALUES
(2, 'About Us', NULL, 'View All About', 'Customized Grammar Support', 'Accessible Resources for All', 'Empowering English Mastery', NULL, NULL, 'We specialize in providing comprehensive English Grammar guidance tailored to students across various grade levels, from Junior Kindergarten to 10th standard. Our services cater to the needs of both English and Gujarati medium students, ensuring inclusivity and accessibility for all learners. Through our user-friendly website, students can access a wealth of resources including grade-specific video lectures, interactive PowerPoint presentations with accompanying audio, meticulously crafted works', 'To get started, students simply need to register with their designated user ID corresponding to their specific grade level. Our membership package offers a full year of access to our extensive library of educational materials, all at an affordable cost of only Rs.1000/-. For those seeking additional support, we also offer personalized online classes, available either on a one-on-one basis or within a group setting.', 'At the core of our mission is the desire to make learning English Grammar an effortless and enjoyable experience for students. We believe in alleviating the academic pressures often associated with language learning, allowing students to embrace the subject with confidence and enthusiasm. Join us today and embark on a journey towards mastering English Grammar with ease. Best regards, Rajul Sheth.', 'winwingrammarsupport.jpg', 'accessable.jpg', 'empowering.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `Id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `CrDt` datetime DEFAULT NULL,
  `UpDt` datetime DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`Id`, `name`, `password`, `email`, `CrDt`, `UpDt`, `image`) VALUES
(1, 'admin', 'admin', 'admin@123', '2024-10-26 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `Id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `contactno` varchar(500) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `title1` varchar(500) DEFAULT NULL,
  `custcontno` varchar(500) DEFAULT NULL,
  `title2` varchar(500) DEFAULT NULL,
  `custemaiid` varchar(500) DEFAULT NULL,
  `CrDt` datetime DEFAULT NULL,
  `UpDt` datetime DEFAULT NULL,
  `subject` varchar(500) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `title3` varchar(500) DEFAULT NULL,
  `costadd` varchar(500) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `heading` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`Id`, `name`, `email`, `contactno`, `image`, `title1`, `custcontno`, `title2`, `custemaiid`, `CrDt`, `UpDt`, `subject`, `message`, `title3`, `costadd`, `title`, `heading`) VALUES
(1, 'test', 'test@gmail.com', '1232456789', NULL, NULL, NULL, NULL, NULL, '2024-11-05 10:21:53', '2024-11-05 10:31:25', 'test123', 'only test', NULL, NULL, NULL, NULL),
(2, 'Kiran 123', 'test@gmail.com', '7987946546', NULL, NULL, NULL, NULL, NULL, '2024-11-05 10:32:19', '2024-11-05 13:13:05', 'test1234', 'sdf', NULL, NULL, NULL, NULL),
(3, 'Ishan', 'ishan@gmail.com', '4563218781', NULL, NULL, NULL, NULL, NULL, '2024-11-05 11:53:53', '2024-11-05 12:24:10', 'issues solution', 'testing process', NULL, NULL, NULL, NULL),
(4, 'shethrajul', 'shethrajul@gmail.com', '6352208227', '', 'phone number', '6352208227', 'email address', 'shethrajul.1967@gmail.com', '2024-11-05 13:18:43', NULL, 'read only ', 'read only', 'office address', 'Vadodara Pin: 390022 Gujarat', 'Get in touch', 'Contact Us'),
(5, 'jigar', 'jigar@gmail.com', '6654989872', NULL, NULL, NULL, NULL, NULL, '2024-11-05 15:08:18', '2024-11-05 15:15:46', '445', 'dsa9', NULL, NULL, NULL, NULL),
(6, 'hr', 'hr@gmail.com', '7789864645', NULL, NULL, NULL, NULL, NULL, '2024-11-16 18:06:14', NULL, 'hr test', 'only test', NULL, NULL, NULL, NULL),
(7, 'test5456', 'hiyom11620@apdiv.com', '5879513123', NULL, NULL, NULL, NULL, NULL, '2024-11-21 17:09:31', NULL, '4523', 'jkgfcg', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `Id` int(11) NOT NULL,
  `Name` varchar(500) DEFAULT NULL,
  `SubNm` varchar(500) DEFAULT NULL,
  `detail` varchar(500) DEFAULT NULL,
  `detail1` varchar(500) DEFAULT NULL,
  `SubNm1` varchar(500) DEFAULT NULL,
  `img1` varchar(500) DEFAULT NULL,
  `detail2` varchar(500) DEFAULT NULL,
  `SubNm2` varchar(500) DEFAULT NULL,
  `img2` varchar(500) DEFAULT NULL,
  `detail3` varchar(500) DEFAULT NULL,
  `SubNm3` varchar(500) DEFAULT NULL,
  `img3` varchar(500) DEFAULT NULL,
  `detail4` varchar(500) DEFAULT NULL,
  `SubNm4` varchar(500) DEFAULT NULL,
  `img4` varchar(500) DEFAULT NULL,
  `detail5` varchar(500) DEFAULT NULL,
  `SubNm5` varchar(500) DEFAULT NULL,
  `img5` varchar(500) DEFAULT NULL,
  `detail6` varchar(500) DEFAULT NULL,
  `SubNm6` varchar(500) DEFAULT NULL,
  `img6` varchar(500) DEFAULT NULL,
  `detail7` varchar(500) DEFAULT NULL,
  `SubNm7` varchar(500) DEFAULT NULL,
  `img7` varchar(500) DEFAULT NULL,
  `CrDt` datetime DEFAULT NULL,
  `UpDt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`Id`, `Name`, `SubNm`, `detail`, `detail1`, `SubNm1`, `img1`, `detail2`, `SubNm2`, `img2`, `detail3`, `SubNm3`, `img3`, `detail4`, `SubNm4`, `img4`, `detail5`, `SubNm5`, `img5`, `detail6`, `SubNm6`, `img6`, `detail7`, `SubNm7`, `img7`, `CrDt`, `UpDt`) VALUES
(1, 'Home', NULL, 'View Home', 'Learning Classes', 'Become lifelong learners with best engaging video lessons and personalised learning journeys.', 'vecteezy_fly-through-formulas-white_1623381.mp4', 'Your Primary Source for the Social Studies', 'Discovery Education’s Social Studies Techbook offers a standards-aligned, inquiry-based learning experience.', '215471_small.mp4', 'High-Quality Online Social Studies Instructional', 'Teachers can save valuable time with model social studies lessons, interactive tools and activities, document-based investigations, and both formative and summative assessments.', 'vecteezy_school-girl-talking-to-distance-tutor-with-video-call-on_4512037.mp4', 'Art & Craft', 'Students across Painting, Drawing and Printmaking, Photography, Film, Graphic Design, Games, Illustration, Fashion, and More.', '35449-407130915_small.mp4', 'Bring History to Life for All Learners', 'Every student learns in their own way. Social Studies Techbook is specifically developed for diverse student audiences and curated by experts for ease of access.', '215475_small.mp4', 'Debate, discuss, and educate', 'Make any seminar a lively and intriguing discussion with our online seminar software.', '206779_small.mp4', 'Online teaching tools that boost learning outcomes', 'Test knowledge, start discussions, and give students the chance to ask the right questions at the right time.', '1058-142621439_small.mp4', '2024-11-22 00:00:00', '2024-11-22 10:30:24');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `contactno` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `coursename` varchar(255) DEFAULT NULL,
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `payment_status` enum('completed','failed') DEFAULT 'failed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `contactno`, `email`, `coursename`, `payment_amount`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, '7987946546', 'ishan@gmail.com', '1st', 1.00, 'completed', '2024-11-29 12:58:24', '2024-11-30 12:22:11'),
(2, '3324326534', 'jigar@gmail.com', '4th', 1.00, 'completed', '2024-11-30 07:57:24', '2024-11-30 08:16:34'),
(7, '7987946546', 'ishan@gmail.com', 'JrKg', 1.00, 'completed', '2024-11-30 10:57:21', '2024-11-30 10:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `qr_codes`
--

CREATE TABLE `qr_codes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `contactno` varchar(500) DEFAULT NULL,
  `bankname` varchar(500) DEFAULT NULL,
  `bankdetail` varchar(500) DEFAULT NULL,
  `ifsccode` varchar(500) DEFAULT NULL,
  `country` varchar(500) DEFAULT NULL,
  `state` varchar(500) DEFAULT NULL,
  `city` varchar(500) DEFAULT NULL,
  `pincode` varchar(500) DEFAULT NULL,
  `crdt` datetime DEFAULT NULL,
  `updt` datetime DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `payment_status` enum('pending','completed') DEFAULT 'pending',
  `coursename` varchar(500) DEFAULT NULL,
  `amount` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qr_codes`
--

INSERT INTO `qr_codes` (`id`, `name`, `image`, `email`, `contactno`, `bankname`, `bankdetail`, `ifsccode`, `country`, `state`, `city`, `pincode`, `crdt`, `updt`, `title`, `payment_status`, `coursename`, `amount`) VALUES
(1, 'Bhumi', 'QR_SCAN_ME.jpg', 'bhumi123@gmail.com', '8320165639', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-28 16:23:09', '2024-11-28 16:57:53', ' Scan QR to Pay Fees', 'pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `registerdata`
--

CREATE TABLE `registerdata` (
  `password` varchar(500) NOT NULL,
  `Id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `fname` varchar(500) DEFAULT NULL,
  `lname` varchar(500) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `course` varchar(500) DEFAULT NULL,
  `contactno` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `CrDt` datetime DEFAULT NULL,
  `UpDt` datetime DEFAULT NULL,
  `state` varchar(500) DEFAULT NULL,
  `country` varchar(500) DEFAULT NULL,
  `city` varchar(500) DEFAULT NULL,
  `pincode` varchar(50) DEFAULT NULL,
  `tmp_name` varchar(500) DEFAULT NULL,
  `sclname` varchar(500) DEFAULT NULL,
  `sclcity` varchar(500) DEFAULT NULL,
  `cpassword` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registerdata`
--

INSERT INTO `registerdata` (`password`, `Id`, `name`, `fname`, `lname`, `gender`, `course`, `contactno`, `email`, `address`, `image`, `CrDt`, `UpDt`, `state`, `country`, `city`, `pincode`, `tmp_name`, `sclname`, `sclcity`, `cpassword`) VALUES
('12345', 1, 'test', 'S', 'Lad', 'male', '5th', '1232456789', 'ex@gmail.com', 'VIP Road', '../uploaded_img/milkshake-with-bubble-gum-ceramic-plate_114579-24204.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sanskar High School', 'Vadodara', '12345'),
('123456789', 2, 'Kiran ', 'Pareshbhai', 'Tandel', 'male', 'gujaratisikho', '8899854545', 'kiran@gmail.com', 'Station Road ,Surat', '../uploaded_img/top-view-unused-pink-bath-bomb_23-2150559055.jpg', '2024-10-26 16:15:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Convent High Secondery School', 'Surat', '123456789'),
('123', 3, 'jigar', 'S', 'Desai', 'male', '1st', '3324326534', 'jigar@gmail.com', 'Station Road ,Surat', '../uploaded_img/1.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Convent High Secondery School', 'Vadodara', '123'),
('12345', 4, 'Ishan', 'S', 'Rawal', 'male', '10th GSEB', '7987946546', 'ishan@gmail.com', 'Bus Station Road', '../uploaded_img/img2.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Lalitabai High School', 'Navsari', NULL),
('789', 5, 'test123', 'test_fn', 'test-ln', 'no', '2nd', '1232456709', 'test123@gmail.com', 'VIP Road', '../uploaded_img/computer.jpeg', '2024-10-29 17:13:49', NULL, NULL, NULL, NULL, NULL, NULL, 'Sanskar High School', 'Vadodara', NULL),
('12345', 6, 'Kiran ', 'Pareshbhai', 'Tandel', 'male', 'phonics', '7987946546', 'kiran123@gmail.com', 'Bus Station Road', '../uploaded_img/6.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Convent High Secondery School', 'Vadodara', NULL),
('harsh', 7, 'Harsh', 'D', 'Tandel', 'male', '9th', '8845656122', 'harsh@gmail.com', 'Station Road ,Surat', '../uploaded_img/history.jpeg', '2024-11-12 15:20:39', NULL, NULL, NULL, NULL, NULL, NULL, 'Aahvaby School', 'Surat', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `Id` int(11) NOT NULL,
  `courses` int(11) DEFAULT NULL,
  `name` varchar(500) DEFAULT NULL,
  `coursename` varchar(500) DEFAULT NULL,
  `payment` bigint(11) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `contactno` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `sclname` varchar(500) DEFAULT NULL,
  `sclcity` varchar(500) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `CrDt` datetime DEFAULT NULL,
  `UpDt` datetime DEFAULT NULL,
  `state` varchar(500) DEFAULT NULL,
  `country` varchar(500) DEFAULT NULL,
  `city` varchar(500) DEFAULT NULL,
  `pincode` varchar(50) DEFAULT NULL,
  `course1` varchar(500) DEFAULT NULL,
  `course2` varchar(500) DEFAULT NULL,
  `course3` varchar(500) DEFAULT NULL,
  `course4` varchar(500) DEFAULT NULL,
  `course5` varchar(500) DEFAULT NULL,
  `course6` varchar(500) DEFAULT NULL,
  `course7` varchar(500) DEFAULT NULL,
  `course8` varchar(500) DEFAULT NULL,
  `course9` varchar(500) DEFAULT NULL,
  `course10` varchar(500) DEFAULT NULL,
  `course11` varchar(500) DEFAULT NULL,
  `course12` varchar(500) DEFAULT NULL,
  `course13` varchar(500) DEFAULT NULL,
  `userid` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`Id`, `courses`, `name`, `coursename`, `payment`, `gender`, `password`, `contactno`, `email`, `sclname`, `sclcity`, `address`, `image`, `CrDt`, `UpDt`, `state`, `country`, `city`, `pincode`, `course1`, `course2`, `course3`, `course4`, `course5`, `course6`, `course7`, `course8`, `course9`, `course10`, `course11`, `course12`, `course13`, `userid`) VALUES
(1, NULL, 'jigar', '4th', 1, 'male', '123', '3324326534', 'jigar@gmail.com', 'Convent High Secondery School', 'Vadodara', 'Station Road ,Surat', NULL, '2024-11-23 11:08:41', '2024-11-26 10:48:38', 'Gujarat', 'India', 'Surat', '396012', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 0, 'Kiran', '2nd', 5, 'male', '123', '1232456789', 'kiran@gmail.com', 'Convent High Secondery School', 'Vadodara', 'Station Road ,Surat', 'uploaded_img/4.jpeg', NULL, '2024-11-27 13:35:20', 'Gujarat', 'India', 'Surat', '396012', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, NULL, 'test123', 'phonics', 1, 'male', '1234567890', '1232456709', 'test123@gmail.com', 'Convent High Secondery School', 'Navsari', 'Station Road ,Navsari', '', '2024-11-25 05:42:25', '2024-11-27 13:17:29', 'Gujarat', 'India', 'Navsari', '396445', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, NULL, 'Ishan', 'JrKg', 8, 'male', '123', '7987946546', 'ishan@gmail.com', 'Sanskar High School', 'Navsari', 'Bus Station Road', 'uploaded_img/3.jpeg', '2024-11-26 08:31:39', '2024-11-29 07:48:32', NULL, NULL, 'Surat', '396012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qr_codes`
--
ALTER TABLE `qr_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registerdata`
--
ALTER TABLE `registerdata`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `qr_codes`
--
ALTER TABLE `qr_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registerdata`
--
ALTER TABLE `registerdata`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
