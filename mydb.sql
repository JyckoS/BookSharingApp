-- SQL tables made by jycko

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 10, 2024 at 12:24 PM
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
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `BookID` varchar(30) NOT NULL,
  `LoanID` varchar(30) NOT NULL,
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
('BK1829', 'LN1256', 'How to cook a lasagna underwater', 'Gordon Ramsay', 'Penguin Random House', 2016, 'Cooking', 'EXCELLENT', 'Learn how to cook a lasagna underwater with the guide of the world famous chef gordon ramsay', 'AVAILABLE', '1191202266');

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `BorrowID` varchar(30) NOT NULL,
  `BookID` varchar(30) NOT NULL,
  `StudentID` varchar(30) NOT NULL,
  `BorrowDate` date NOT NULL,
  `ReturnDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`BorrowID`, `BookID`, `StudentID`, `BorrowDate`, `ReturnDate`) VALUES
('BR1100', 'BK1829', '1191202266', '2024-01-12', '2024-01-12');

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
  `FeedbackID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` varchar(30) NOT NULL,
  `Content` text NOT NULL,
  PRIMARY KEY (`FeedbackID`)
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
  `RequestDate` date DEFAULT NULL,
  `Status` enum('CLOSED','OPEN') DEFAULT NULL,
  `ForumPosts` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ForumPosts`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_request`
--

INSERT INTO `forum_request` (`RequestID`, `StudentID`, `Title`, `Author`, `RequestDate`, `Status`, `ForumPosts`) VALUES
(1232, '1191202266', 'Requesting Book of Math 101: Calculus for Beginners', 'IGCSCE Book', '2024-05-25', 'CLOSED', '[1234]');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `LoanID` varchar(30) NOT NULL,
  `StudentID` varchar(30) NOT NULL,
  `LoanDate` date NOT NULL,
  `ExpiryDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`LoanID`, `StudentID`, `LoanDate`, `ExpiryDate`) VALUES
('LN1256', '1191202266', '2024-06-05', '2025-06-05');

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
  `ReviewID` varchar(20) NOT NULL,
  `StudentID` varchar(30) NOT NULL,
  `BookID` varchar(30) NOT NULL,
  `CommentReview` text NOT NULL,
  `ReviewDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`ReviewID`, `StudentID`, `BookID`, `CommentReview`, `ReviewDate`) VALUES
('RV1001', '1191202266', 'BK1829', 'The recipes in this book are easy follow!', '2024-03-13');

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
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`ManagerID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`ReviewID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`);

--
-- Constraints for table `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `fk_book` FOREIGN KEY (`BookID`) REFERENCES `books` (`BookID`),
  ADD CONSTRAINT `fk_student2` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`);

--
-- Constraints for table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `fk_student6` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_student5` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`);

--
-- Constraints for table `forum_post`
--
ALTER TABLE `forum_post`
  ADD CONSTRAINT `fk_student7` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`);

--
-- Constraints for table `forum_request`
--
ALTER TABLE `forum_request`
  ADD CONSTRAINT `fk_forumrequest_studentid` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`);

--
-- Constraints for table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `fk_student3` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_books` FOREIGN KEY (`BookID`) REFERENCES `books` (`BookID`),
  ADD CONSTRAINT `fk_student4` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
