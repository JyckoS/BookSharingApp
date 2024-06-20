-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 20, 2024 at 06:36 PM
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
-- Database: `testimport1`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `BookID` int(30) NOT NULL,
  `LoanID` int(30) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Author` varchar(255) NOT NULL,
  `Publisher` varchar(60) NOT NULL,
  `YearPublished` int(11) NOT NULL,
  `Genre` varchar(255) NOT NULL,
  `BookCondition` enum('EXCELLENT','BAD','MINOR_DAMAGES','MISSING_PAGES') NOT NULL,
  `Description` text NOT NULL,
  `Status` enum('PENDING','APPROVED','REJECTED','RESERVED','BORROWED','AVAILABLE','TAKEN_BACK') NOT NULL,
  `StudentID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`BookID`, `LoanID`, `Title`, `Author`, `Publisher`, `YearPublished`, `Genre`, `BookCondition`, `Description`, `Status`, `StudentID`) VALUES
(1829, 1256, 'How to cook a lasagna underwater', 'Gordon Ramsay', 'Penguin Random House', 2016, 'Cooking', 'EXCELLENT', 'Learn how to cook a lasagna underwater with the guide of the world famous chef gordon ramsay', 'AVAILABLE', '1191202266');

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `BorrowID` int(30) NOT NULL,
  `BookID` int(30) NOT NULL,
  `StudentID` varchar(30) NOT NULL,
  `BorrowDate` date NOT NULL,
  `ReturnDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`BorrowID`, `BookID`, `StudentID`, `BorrowDate`, `ReturnDate`) VALUES
(1100, 1829, '1191202266', '2024-01-12', '2024-01-12');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `QuestionID` int(11) NOT NULL,
  `StudentID` varchar(30) NOT NULL,
  `Content` text NOT NULL,
  `Answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`QuestionID`, `StudentID`, `Content`, `Answer`) VALUES
(5128, '1191202266', 'How do I share my books?', 'Click on the button on the right and click share.');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL,
  `StudentID` varchar(30) NOT NULL,
  `Content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FeedbackID`, `StudentID`, `Content`) VALUES
(5678, '1191202266', 'Book smells of potato, it is not good.');

-- --------------------------------------------------------

--
-- Table structure for table `forum_post`
--

CREATE TABLE `forum_post` (
  `PostID` int(11) NOT NULL,
  `StudentID` varchar(30) NOT NULL,
  `DateSent` date NOT NULL,
  `Content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_post`
--

INSERT INTO `forum_post` (`PostID`, `StudentID`, `DateSent`, `Content`) VALUES
(1234, '1191202266', '2024-06-05', 'I have that book and I don\'t use it anymore. I will share it!');

-- --------------------------------------------------------

--
-- Table structure for table `forum_request`
--

CREATE TABLE `forum_request` (
  `RequestID` int(11) NOT NULL,
  `StudentID` varchar(30) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Author` varchar(255) DEFAULT NULL,
  `RequestDate` timestamp NULL DEFAULT current_timestamp(),
  `Status` enum('CLOSED','OPEN') DEFAULT NULL,
  `ForumPosts` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ForumPosts`)),
  `image_base64` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_request`
--

INSERT INTO `forum_request` (`RequestID`, `StudentID`, `Title`, `Author`, `RequestDate`, `Status`, `ForumPosts`, `image_base64`) VALUES
(1232, '1191202266', 'Requesting Book of Math 101: Calculus for Beginners', 'IGCSCE Book', '2024-05-24 16:00:00', 'CLOSED', '[1234]', '');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `LoanID` int(30) NOT NULL,
  `StudentID` varchar(30) NOT NULL,
  `LoanDate` date NOT NULL,
  `ExpiryDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`LoanID`, `StudentID`, `LoanDate`, `ExpiryDate`) VALUES
(1256, '1191202266', '2024-06-05', '2025-06-05');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `ManagerID` varchar(30) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `UserType` enum('STUDENT','MANAGER') NOT NULL,
  `Name` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`ManagerID`, `Email`, `Password`, `UserType`, `Name`) VALUES
('MU121000', 'MU121000@mmu.edu.my', 'Jason123', 'MANAGER', 'Jason Statham');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `ReviewID` int(20) NOT NULL,
  `StudentID` varchar(30) NOT NULL,
  `BookID` varchar(30) NOT NULL,
  `CommentReview` text NOT NULL,
  `ReviewDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`ReviewID`, `StudentID`, `BookID`, `CommentReview`, `ReviewDate`) VALUES
(1001, '1191202266', 'BK1829', 'The recipes in this book are easy follow!', '2024-03-13');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` varchar(30) NOT NULL,
  `Name` varchar(60) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `UserType` enum('STUDENT','MANAGER') NOT NULL DEFAULT 'STUDENT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `Name`, `Email`, `Password`, `UserType`) VALUES
('1191202266', 'Sarah Butchman', '1191202266@student.mmu.edu.my', 'Sarah123', 'STUDENT'),
('1191202277', 'Michael Jackson', '1191202277@student.mmu.edu.my', 'Michael123', 'STUDENT'),
('1291202288', 'Johnny Depp', '1191202288@student.mmu.edu.my', 'Johnny123', 'STUDENT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`BookID`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`BorrowID`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`QuestionID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackID`);

--
-- Indexes for table `forum_post`
--
ALTER TABLE `forum_post`
  ADD PRIMARY KEY (`PostID`);

--
-- Indexes for table `forum_request`
--
ALTER TABLE `forum_request`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`LoanID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`ReviewID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `BookID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1830;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `BorrowID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1101;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `QuestionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5129;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5679;

--
-- AUTO_INCREMENT for table `forum_post`
--
ALTER TABLE `forum_post`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1235;

--
-- AUTO_INCREMENT for table `forum_request`
--
ALTER TABLE `forum_request`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1233;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `LoanID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1257;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `ReviewID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
