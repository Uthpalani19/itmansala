-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2023 at 04:59 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itmansala`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` varchar(25) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `name`, `password`) VALUES
('2', 'Dakshika', '123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `phoneNumber` int(10) NOT NULL,
  `courseId` varchar(25) NOT NULL,
  `price` int(100) DEFAULT NULL,
  `clearStatus` int(1) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseId` varchar(25) NOT NULL,
  `courseName` varchar(100) NOT NULL,
  `courseDescription` varchar(255) NOT NULL,
  `courseImage` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `teacherPhoneNumber` int(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseId`, `courseName`, `courseDescription`, `courseImage`, `price`, `teacherPhoneNumber`, `status`) VALUES
('1', 'දත්ත සහ තොරතුරු.', 'දත්ත යනු තනි පුද්ගල කරුණු ලෙස අර්ථ දක්වා ඇති අතර තොරතුරු යනු එම කරුණු සංවිධානය කිරීම සහ අර්ථ නිරූපණය කිරීමයි.\n\n', 'pexels-markus-spiske-330771 1.png', 1000, 763361822, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `subTopicId` varchar(25) NOT NULL,
  `lessonName` varchar(100) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `modelpaperquestion`
--

CREATE TABLE `modelpaperquestion` (
  `questionId` varchar(25) NOT NULL,
  `subTopicId` varchar(25) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `option1` varchar(100) NOT NULL,
  `option2` varchar(100) NOT NULL,
  `option3` varchar(100) NOT NULL,
  `option4` varchar(100) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modelpaperquestion`
--

INSERT INTO `modelpaperquestion` (`questionId`, `subTopicId`, `question`, `answer`, `option1`, `option2`, `option3`, `option4`, `status`) VALUES
('Q001', '1.1', 'දත්ත යනු කුමක්ද?', 'යමක් හෝ යමෙකු ගැන සපයන ලද හෝ ඉගෙන ගත් කරුණු.', 'යමක් හෝ යමෙකු ගැන සපයන ලද හෝ ඉගෙන ගත් කරුණු.', 'යොමු සහ විශ්ලේෂණය සඳහා භාවිතා කරන කරුණු, සංඛ්යාලේඛන', 'සාර්ථකව සන්නිවේදනය කිරීම සඳහා ගනු ලබන ක්‍රියා හෝ පියවර මාලාවක්', 'පුද්ගලයෙකු හෝ දෙයක් වෙනත් දෙයක් සමඟ සම්බන්ධ වී ඇති හෝ සම්බන්ධ වූ සම්බන්ධතාවයක්.', 1),
('Q002', '1.1', 'තොරතුරු සහ දත්ත අතර වෙනස?', 'තොරතුරු සකසන ලද දත්ත වේ.', 'තොරතුරු සකසන ලද දත්ත වේ.', 'සකස් නොකළ දත්ත', 'සන්නිවේදන නාලිකාව', 'තොරතුරු රැස් කිරීමේ ශිල්පීය ක්‍රම', 1),
('Q003', '1.1', 'පහත ඒවායින් දත්ත වර්ගයක් නොවන්නේ කුමක්ද?', 'Array', 'Boolean', 'Text', 'Integer', 'Array', 1),
('Q004', '1.1', 'DBMS යන්නෙන් අදහස් කරන්නේ කුමක්ද?', 'Database Management System', 'Data of Binary Management System', 'Database Management System', 'Database Management Service', 'Data Backup Management System', 1),
('Q005', '1.1', 'දත්ත සමුදාය තුළ ගබඩා කළ හැක්කේ කුමන ආකාරයේ දත්තද?', 'ඉහත සියල්ලම', 'රූප දත්ත', 'පෙළ, දත්ත අඩංගු ගොනු', 'ශ්‍රව්‍ය හෝ දෘශ්‍ය ආකාරයෙන් දත්ත', 'ඉහත සියල්ලම', 1),
('Q006', '1.1', 'DBMS හි ලක්ෂණයක් වන්නේ පහත ඒවායින් කුමක් ද?', 'තනි පරිශීලක ප්‍රවේශය පමණි', 'දත්තවල අවම අනුපිටපත් සහ අතිරික්තය', 'ඉහළ මට්ටමේ ආරක්ෂාව', 'තනි පරිශීලක ප්‍රවේශය පමණි', 'සහාය ACID දේපල', 1),
('Q007', '1.1', 'DBMS හි අංගයක් වන්නේ පහත සඳහන් මොනවාද?', 'ඉහත සියල්ලම', 'දත්ත', 'දත්ත භාෂා', 'දත්ත කළමනාකරු', 'ඉහත සියල්ලම', 1),
('Q008', '1.1', 'Am I Sleepy?', 'GO SLEEEP', 'Yesss', 'Nooo', 'Hell YEAH', 'GO SLEEEP', 0);

-- --------------------------------------------------------

--
-- Table structure for table `modelpaperquiz`
--

CREATE TABLE `modelpaperquiz` (
  `quizId` varchar(25) NOT NULL,
  `subtopicid` varchar(25) NOT NULL,
  `modelQuestionId` varchar(25) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pastpaperquestion`
--

CREATE TABLE `pastpaperquestion` (
  `questionId` varchar(25) NOT NULL,
  `courseId` varchar(25) NOT NULL,
  `year` int(4) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `option1` varchar(100) NOT NULL,
  `option2` varchar(100) NOT NULL,
  `option3` varchar(100) NOT NULL,
  `option4` varchar(100) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pastpaperquiz`
--

CREATE TABLE `pastpaperquiz` (
  `quizId` varchar(25) NOT NULL,
  `courseId` varchar(25) NOT NULL,
  `PastpaperQuestionId` varchar(25) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentId` int(10) NOT NULL,
  `phoneNumber` int(10) NOT NULL,
  `referenceNumber` varchar(255) NOT NULL,
  `paymentSlip` varchar(255) NOT NULL,
  `paymentType` varchar(4) NOT NULL,
  `paidDate` date NOT NULL,
  `total` int(100) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quizId` varchar(25) NOT NULL,
  `courseId` varchar(25) NOT NULL,
  `subtopicId` varchar(25) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `phoneNumber` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profilePicture` varchar(255) DEFAULT NULL,
  `firstAccessDate` timestamp NULL DEFAULT NULL,
  `lastAccessDate` timestamp NULL DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`phoneNumber`, `name`, `email`, `password`, `profilePicture`, `firstAccessDate`, `lastAccessDate`, `status`) VALUES
(763361245, 'Tharusha Atukorala', 'tharu99@gmail.com', 'THATHATHA123', NULL, NULL, NULL, 1),
(763361823, 'Vinodh Ramanayake', 'vinodhramanayake@gmail.com', 'Vinodh123', NULL, NULL, NULL, 1),
(776908516, 'Kavishma', 'kavishma@gmail.com', '64efefa9c344b31f35c7f539fcc7f9c7', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `phoneNumber` int(10) NOT NULL,
  `courseId` varchar(25) NOT NULL,
  `lastaccesstime` datetime NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_modelpaperquestion`
--

CREATE TABLE `student_modelpaperquestion` (
  `phoneNumber` int(10) NOT NULL,
  `questionId` varchar(25) NOT NULL,
  `answer` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_modelpaperquiz`
--

CREATE TABLE `student_modelpaperquiz` (
  `attemptId` varchar(25) NOT NULL,
  `phoneNumber` int(10) DEFAULT NULL,
  `quizId` varchar(25) DEFAULT NULL,
  `attempt` int(1) DEFAULT NULL,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `marks` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_pastpaperquestion`
--

CREATE TABLE `student_pastpaperquestion` (
  `phoneNumber` int(10) NOT NULL,
  `questionId` varchar(25) NOT NULL,
  `answer` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_pastpaperquiz`
--

CREATE TABLE `student_pastpaperquiz` (
  `attemptId` varchar(25) NOT NULL,
  `phoneNumber` int(10) DEFAULT NULL,
  `quizId` varchar(25) DEFAULT NULL,
  `attempt` int(1) DEFAULT NULL,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `marks` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_subtopic`
--

CREATE TABLE `student_subtopic` (
  `phoneNumber` int(10) NOT NULL,
  `subtopicId` varchar(25) NOT NULL,
  `lastaccesstime` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subtopic`
--

CREATE TABLE `subtopic` (
  `subTopicId` varchar(25) NOT NULL,
  `courseId` varchar(25) NOT NULL,
  `subTopicName` varchar(100) NOT NULL,
  `content` longblob DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subtopic`
--

INSERT INTO `subtopic` (`subTopicId`, `courseId`, `subTopicName`, `content`, `status`) VALUES
('1.1', '1', 'දත්ත සහ තොරතුරු වල මූලික තැනුම් ඒකක හා ඒවායේ ගති ලක්ෂණ', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `phoneNumber` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `teacherImage` varchar(255) NOT NULL,
  `fieldOfExpertise` varchar(25) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`phoneNumber`, `name`, `email`, `password`, `teacherImage`, `fieldOfExpertise`, `status`) VALUES
(714900086, 'Tharusha', 'tharushaatukorala@gmail.com', '33bc8e44d42f39c5ccc5f7e6fe1febf1', '', 'it', 1),
(763361822, 'Uthpalani Jayasinghe', 'uthpalanijayasinghe19@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '', 'Networking', 1),
(763361823, 'Sandani', 'sandaniamandi@gmail.com', 'ce3242eb206c36b298d2e020220017f8', '', 'Networking', 1),
(778760763, 'Kanishka', 'kanishkajayasinghe@gmail.com', 'd32934b31349d77e70957e057b1bcd28', '', 'Cyber Security', 1);

-- --------------------------------------------------------

--
-- Table structure for table `todolist`
--

CREATE TABLE `todolist` (
  `teacherPhoneNumber` int(10) DEFAULT NULL,
  `toDoWork` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `phoneNumber` int(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`phoneNumber`, `password`, `role`) VALUES
(763361822, '81dc9bdb52d04dc20036dbd8313ed055', 'Teacher'),
(776908516, '64efefa9c344b31f35c7f539fcc7f9c7', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`phoneNumber`,`courseId`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseId`),
  ADD KEY `teachersPhoneNumber` (`teacherPhoneNumber`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD KEY `subtopicId` (`subTopicId`);

--
-- Indexes for table `modelpaperquestion`
--
ALTER TABLE `modelpaperquestion`
  ADD PRIMARY KEY (`questionId`,`subTopicId`),
  ADD KEY `subTopicId` (`subTopicId`);

--
-- Indexes for table `modelpaperquiz`
--
ALTER TABLE `modelpaperquiz`
  ADD PRIMARY KEY (`quizId`,`subtopicid`,`modelQuestionId`),
  ADD KEY `subtopicid` (`subtopicid`),
  ADD KEY `modelQuestionId` (`modelQuestionId`);

--
-- Indexes for table `pastpaperquestion`
--
ALTER TABLE `pastpaperquestion`
  ADD PRIMARY KEY (`questionId`,`courseId`),
  ADD KEY `courseId` (`courseId`);

--
-- Indexes for table `pastpaperquiz`
--
ALTER TABLE `pastpaperquiz`
  ADD PRIMARY KEY (`quizId`,`courseId`,`PastpaperQuestionId`),
  ADD KEY `courseId` (`courseId`),
  ADD KEY `PastpaperQuestionId` (`PastpaperQuestionId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentId`),
  ADD KEY `phoneNumber` (`phoneNumber`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quizId`),
  ADD KEY `courseId` (`courseId`),
  ADD KEY `subtopicId` (`subtopicId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`phoneNumber`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`phoneNumber`,`courseId`),
  ADD KEY `courseId` (`courseId`);

--
-- Indexes for table `student_modelpaperquestion`
--
ALTER TABLE `student_modelpaperquestion`
  ADD PRIMARY KEY (`phoneNumber`,`questionId`),
  ADD KEY `questionId` (`questionId`);

--
-- Indexes for table `student_modelpaperquiz`
--
ALTER TABLE `student_modelpaperquiz`
  ADD PRIMARY KEY (`attemptId`),
  ADD KEY `phoneNumber` (`phoneNumber`),
  ADD KEY `quizId` (`quizId`);

--
-- Indexes for table `student_pastpaperquestion`
--
ALTER TABLE `student_pastpaperquestion`
  ADD PRIMARY KEY (`phoneNumber`,`questionId`),
  ADD KEY `questionId` (`questionId`);

--
-- Indexes for table `student_pastpaperquiz`
--
ALTER TABLE `student_pastpaperquiz`
  ADD PRIMARY KEY (`attemptId`),
  ADD KEY `phoneNumber` (`phoneNumber`),
  ADD KEY `quizId` (`quizId`);

--
-- Indexes for table `student_subtopic`
--
ALTER TABLE `student_subtopic`
  ADD PRIMARY KEY (`phoneNumber`,`subtopicId`),
  ADD KEY `subtopicId` (`subtopicId`);

--
-- Indexes for table `subtopic`
--
ALTER TABLE `subtopic`
  ADD PRIMARY KEY (`subTopicId`),
  ADD KEY `courseId` (`courseId`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`phoneNumber`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`phoneNumber`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`phoneNumber`) REFERENCES `student` (`phoneNumber`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `teachersPhoneNumber` FOREIGN KEY (`teacherPhoneNumber`) REFERENCES `teacher` (`phoneNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `subtopicId` FOREIGN KEY (`subTopicId`) REFERENCES `subtopic` (`subTopicId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `modelpaperquestion`
--
ALTER TABLE `modelpaperquestion`
  ADD CONSTRAINT `modelpaperquestion_ibfk_1` FOREIGN KEY (`subTopicId`) REFERENCES `subtopic` (`subTopicId`);

--
-- Constraints for table `modelpaperquiz`
--
ALTER TABLE `modelpaperquiz`
  ADD CONSTRAINT `modelpaperquiz_ibfk_1` FOREIGN KEY (`subtopicid`) REFERENCES `subtopic` (`subTopicId`),
  ADD CONSTRAINT `modelpaperquiz_ibfk_2` FOREIGN KEY (`modelQuestionId`) REFERENCES `modelpaperquestion` (`questionId`);

--
-- Constraints for table `pastpaperquestion`
--
ALTER TABLE `pastpaperquestion`
  ADD CONSTRAINT `pastpaperquestion_ibfk_1` FOREIGN KEY (`courseId`) REFERENCES `course` (`courseId`);

--
-- Constraints for table `pastpaperquiz`
--
ALTER TABLE `pastpaperquiz`
  ADD CONSTRAINT `pastpaperquiz_ibfk_1` FOREIGN KEY (`courseId`) REFERENCES `course` (`courseId`),
  ADD CONSTRAINT `pastpaperquiz_ibfk_2` FOREIGN KEY (`PastpaperQuestionId`) REFERENCES `pastpaperquestion` (`questionId`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`phoneNumber`) REFERENCES `cart` (`phoneNumber`);

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`courseId`) REFERENCES `course` (`courseId`),
  ADD CONSTRAINT `quiz_ibfk_2` FOREIGN KEY (`subtopicId`) REFERENCES `subtopic` (`subTopicId`);

--
-- Constraints for table `student_course`
--
ALTER TABLE `student_course`
  ADD CONSTRAINT `student_course_ibfk_1` FOREIGN KEY (`phoneNumber`) REFERENCES `student` (`phoneNumber`),
  ADD CONSTRAINT `student_course_ibfk_2` FOREIGN KEY (`courseId`) REFERENCES `course` (`courseId`);

--
-- Constraints for table `student_modelpaperquestion`
--
ALTER TABLE `student_modelpaperquestion`
  ADD CONSTRAINT `student_modelpaperquestion_ibfk_1` FOREIGN KEY (`phoneNumber`) REFERENCES `student` (`phoneNumber`),
  ADD CONSTRAINT `student_modelpaperquestion_ibfk_2` FOREIGN KEY (`questionId`) REFERENCES `pastpaperquestion` (`questionId`);

--
-- Constraints for table `student_modelpaperquiz`
--
ALTER TABLE `student_modelpaperquiz`
  ADD CONSTRAINT `student_modelpaperquiz_ibfk_1` FOREIGN KEY (`phoneNumber`) REFERENCES `student` (`phoneNumber`),
  ADD CONSTRAINT `student_modelpaperquiz_ibfk_2` FOREIGN KEY (`quizId`) REFERENCES `modelpaperquiz` (`quizId`);

--
-- Constraints for table `student_pastpaperquestion`
--
ALTER TABLE `student_pastpaperquestion`
  ADD CONSTRAINT `student_pastpaperquestion_ibfk_1` FOREIGN KEY (`phoneNumber`) REFERENCES `student` (`phoneNumber`),
  ADD CONSTRAINT `student_pastpaperquestion_ibfk_2` FOREIGN KEY (`questionId`) REFERENCES `modelpaperquestion` (`questionId`);

--
-- Constraints for table `student_pastpaperquiz`
--
ALTER TABLE `student_pastpaperquiz`
  ADD CONSTRAINT `student_pastpaperquiz_ibfk_1` FOREIGN KEY (`phoneNumber`) REFERENCES `student` (`phoneNumber`),
  ADD CONSTRAINT `student_pastpaperquiz_ibfk_2` FOREIGN KEY (`quizId`) REFERENCES `pastpaperquiz` (`quizId`);

--
-- Constraints for table `student_subtopic`
--
ALTER TABLE `student_subtopic`
  ADD CONSTRAINT `student_subtopic_ibfk_1` FOREIGN KEY (`phoneNumber`) REFERENCES `student` (`phoneNumber`),
  ADD CONSTRAINT `student_subtopic_ibfk_2` FOREIGN KEY (`subtopicId`) REFERENCES `subtopic` (`subTopicId`);

--
-- Constraints for table `subtopic`
--
ALTER TABLE `subtopic`
  ADD CONSTRAINT `courseId` FOREIGN KEY (`courseId`) REFERENCES `course` (`courseId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
