-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 28, 2025 at 03:53 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erisdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblapplicants`
--

CREATE TABLE `tblapplicants` (
  `APPLICANTID` int NOT NULL,
  `FNAME` varchar(90) NOT NULL,
  `LNAME` varchar(90) NOT NULL,
  `MNAME` varchar(90) NOT NULL,
  `ADDRESS` varchar(255) NOT NULL,
  `SEX` varchar(11) NOT NULL,
  `CIVILSTATUS` varchar(30) NOT NULL,
  `BIRTHDATE` date NOT NULL,
  `BIRTHPLACE` varchar(255) NOT NULL,
  `AGE` int NOT NULL,
  `USERNAME` varchar(90) NOT NULL,
  `PASS` varchar(90) NOT NULL,
  `EMAILADDRESS` varchar(90) NOT NULL,
  `CONTACTNO` varchar(90) NOT NULL,
  `DEGREE` text NOT NULL,
  `APPLICANTPHOTO` varchar(255) NOT NULL,
  `NATIONALID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblapplicants`
--

INSERT INTO `tblapplicants` (`APPLICANTID`, `FNAME`, `LNAME`, `MNAME`, `ADDRESS`, `SEX`, `CIVILSTATUS`, `BIRTHDATE`, `BIRTHPLACE`, `AGE`, `USERNAME`, `PASS`, `EMAILADDRESS`, `CONTACTNO`, `DEGREE`, `APPLICANTPHOTO`, `NATIONALID`) VALUES
(2018014, 'Jake', 'Zyrus', 'Ilmba', 'Kab City', 'Female', 'none', '1993-01-16', 'Kab City', 25, 'jake', 'c8d99c2f7cd5f432c163abcd422672b9f77550bb', 'jake@y.com', '14655623123123', 'BSIT', '', ''),
(2018015, 'Janry', 'Tan', 'Lim', 'brgy 1 Kab City', 'Female', 'Single', '1992-01-30', 'Kab City', 26, 'janry', '1dd4efc811372cd1efe855981a8863d10ddde1ca', 'jan@gmail.com', '0234234', 'BSIT', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblattachmentfile`
--

CREATE TABLE `tblattachmentfile` (
  `ID` int NOT NULL,
  `FILEID` varchar(30) DEFAULT NULL,
  `JOBID` int NOT NULL,
  `FILE_NAME` varchar(90) NOT NULL,
  `FILE_LOCATION` varchar(255) NOT NULL,
  `USERATTACHMENTID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblattachmentfile`
--

INSERT INTO `tblattachmentfile` (`ID`, `FILEID`, `JOBID`, `FILE_NAME`, `FILE_LOCATION`, `USERATTACHMENTID`) VALUES
(2, '2147483647', 2, 'Resume', 'photos/27052018124027PLATENO FE95483.docx', 2018013);

-- --------------------------------------------------------

--
-- Table structure for table `tblautonumbers`
--

CREATE TABLE `tblautonumbers` (
  `AUTOID` int NOT NULL,
  `AUTOSTART` varchar(30) NOT NULL,
  `AUTOEND` int NOT NULL,
  `AUTOINC` int NOT NULL,
  `AUTOKEY` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblautonumbers`
--

INSERT INTO `tblautonumbers` (`AUTOID`, `AUTOSTART`, `AUTOEND`, `AUTOINC`, `AUTOKEY`) VALUES
(1, '02983', 11, 1, 'userid'),
(2, '000', 79, 1, 'employeeid'),
(3, '0', 17, 1, 'APPLICANT'),
(4, '69125', 29, 1, 'FILEID');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `CATEGORYID` int NOT NULL,
  `CATEGORY` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`CATEGORYID`, `CATEGORY`) VALUES
(10, 'Technology'),
(11, 'Managerial'),
(12, 'Engineer'),
(13, 'IT'),
(14, 'Civil Engineer'),
(15, 'HR'),
(23, 'Sales'),
(24, 'Banking'),
(25, 'Finance'),
(26, 'BPO'),
(27, 'Degital Marketing'),
(28, 'Shipping');

-- --------------------------------------------------------

--
-- Table structure for table `tblcompany`
--

CREATE TABLE `tblcompany` (
  `COMPANYID` int NOT NULL,
  `COMPANYNAME` varchar(90) NOT NULL,
  `COMPANYADDRESS` varchar(90) NOT NULL,
  `COMPANYCONTACTNO` varchar(30) NOT NULL,
  `COMPANYSTATUS` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcompany`
--

INSERT INTO `tblcompany` (`COMPANYID`, `COMPANYNAME`, `COMPANYADDRESS`, `COMPANYCONTACTNO`, `COMPANYSTATUS`) VALUES
(8, 'SAMAEL PRODUCTION', 'MARWAN AMPATUAN', '09360634339', 'Active'),
(9, 'Rayyyaaan', 'Rordigzsdd', '+639123456789', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployees`
--

CREATE TABLE `tblemployees` (
  `INCID` int NOT NULL,
  `EMPLOYEEID` varchar(30) NOT NULL,
  `FNAME` varchar(50) NOT NULL,
  `LNAME` varchar(50) NOT NULL,
  `MNAME` varchar(50) NOT NULL,
  `ADDRESS` varchar(90) NOT NULL,
  `BIRTHDATE` date NOT NULL,
  `BIRTHPLACE` varchar(90) NOT NULL,
  `AGE` int NOT NULL,
  `SEX` varchar(30) NOT NULL,
  `CIVILSTATUS` varchar(30) NOT NULL,
  `TELNO` varchar(40) NOT NULL,
  `EMP_EMAILADDRESS` varchar(90) NOT NULL,
  `CELLNO` varchar(30) NOT NULL,
  `POSITION` varchar(50) NOT NULL,
  `WORKSTATS` varchar(90) NOT NULL,
  `EMPPHOTO` varchar(255) NOT NULL,
  `EMPUSERNAME` varchar(90) NOT NULL,
  `EMPPASSWORD` varchar(125) NOT NULL,
  `DATEHIRED` date NOT NULL,
  `COMPANYID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblemployees`
--

INSERT INTO `tblemployees` (`INCID`, `EMPLOYEEID`, `FNAME`, `LNAME`, `MNAME`, `ADDRESS`, `BIRTHDATE`, `BIRTHPLACE`, `AGE`, `SEX`, `CIVILSTATUS`, `TELNO`, `EMP_EMAILADDRESS`, `CELLNO`, `POSITION`, `WORKSTATS`, `EMPPHOTO`, `EMPUSERNAME`, `EMPPASSWORD`, `DATEHIRED`, `COMPANYID`) VALUES
(77, '00078', 'Fname', 'Lname', 'Mname', 'Add', '1995-07-20', 'POB', 29, 'Male', 'Single', '09360634339', 'Mars@gmail.com', '09360634339', 'ICT', 'Regular', 'default.jpg', '00078', '99cefa7318872ba11aefb658554598d6cb4f9c8e', '2025-05-27', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tblfeedback`
--

CREATE TABLE `tblfeedback` (
  `FEEDBACKID` int NOT NULL,
  `APPLICANTID` int NOT NULL,
  `REGISTRATIONID` int NOT NULL,
  `FEEDBACK` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbljob`
--

CREATE TABLE `tbljob` (
  `JOBID` int NOT NULL,
  `COMPANYID` int NOT NULL,
  `CATEGORY` varchar(250) NOT NULL,
  `OCCUPATIONTITLE` varchar(90) NOT NULL,
  `REQ_NO_EMPLOYEES` int NOT NULL,
  `SALARIES` double NOT NULL,
  `DURATION_EMPLOYEMENT` varchar(90) NOT NULL,
  `QUALIFICATION_WORKEXPERIENCE` text NOT NULL,
  `JOBDESCRIPTION` text NOT NULL,
  `PREFEREDSEX` varchar(30) NOT NULL,
  `SECTOR_VACANCY` text NOT NULL,
  `JOBSTATUS` varchar(90) NOT NULL,
  `DATEPOSTED` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbljob`
--

INSERT INTO `tbljob` (`JOBID`, `COMPANYID`, `CATEGORY`, `OCCUPATIONTITLE`, `REQ_NO_EMPLOYEES`, `SALARIES`, `DURATION_EMPLOYEMENT`, `QUALIFICATION_WORKEXPERIENCE`, `JOBDESCRIPTION`, `PREFEREDSEX`, `SECTOR_VACANCY`, `JOBSTATUS`, `DATEPOSTED`) VALUES
(3, 8, 'Technology', 'Business 1', 22, 25000, '6 months', 'qd', 'jd', 'Male', 'vaca', 'Active', '2025-05-27 06:05:00'),
(4, 9, 'HR', 'HRRRRRR', 1, 12000, '6 months', 'Graduated', 'taga luto', 'Female', 'VACCC', 'Active', '2025-05-28 03:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbljobregistration`
--

CREATE TABLE `tbljobregistration` (
  `REGISTRATIONID` int NOT NULL,
  `COMPANYID` int NOT NULL,
  `JOBID` int NOT NULL,
  `APPLICANTID` int NOT NULL,
  `APPLICANT` varchar(90) NOT NULL,
  `REGISTRATIONDATE` date NOT NULL,
  `REMARKS` varchar(255) NOT NULL DEFAULT 'Pending',
  `FILEID` varchar(30) DEFAULT NULL,
  `PENDINGAPPLICATION` tinyint(1) NOT NULL DEFAULT '1',
  `HVIEW` tinyint(1) NOT NULL DEFAULT '1',
  `DATETIMEAPPROVED` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbljobregistration`
--

INSERT INTO `tbljobregistration` (`REGISTRATIONID`, `COMPANYID`, `JOBID`, `APPLICANTID`, `APPLICANT`, `REGISTRATIONDATE`, `REMARKS`, `FILEID`, `PENDINGAPPLICATION`, `HVIEW`, `DATETIMEAPPROVED`) VALUES
(1, 2, 2, 2018013, 'Kim Domingo', '2018-05-27', 'Ive seen your work and its really interesting', '2147483647', 0, 1, '2018-05-26 16:13:01'),
(2, 2, 2, 2018015, 'Janry Tan', '2018-05-26', 'aasd', '2147483647', 0, 0, '2018-05-28 14:14:45');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `USERID` varchar(30) NOT NULL,
  `FULLNAME` varchar(40) NOT NULL,
  `USERNAME` varchar(90) NOT NULL,
  `PASS` varchar(90) NOT NULL,
  `ROLE` varchar(30) NOT NULL,
  `PICLOCATION` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`USERID`, `FULLNAME`, `USERNAME`, `PASS`, `ROLE`, `PICLOCATION`) VALUES
('029838', 'marwan', 'marwan', '9377f1a1e3f9c235e6628526d2ae67bbe192fae2', 'Administrator', 'photos/490116602_634780359362894_8366509105081922251_n.jpg'),
('029839', 'marwan2', 'marwan2', 'dbc04eb783dc5d182d747b2d741da573d40a9c6c', 'Staff', 'photos/490116602_634780359362894_8366509105081922251_n.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblapplicants`
--
ALTER TABLE `tblapplicants`
  ADD PRIMARY KEY (`APPLICANTID`);

--
-- Indexes for table `tblattachmentfile`
--
ALTER TABLE `tblattachmentfile`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblautonumbers`
--
ALTER TABLE `tblautonumbers`
  ADD PRIMARY KEY (`AUTOID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`CATEGORYID`);

--
-- Indexes for table `tblcompany`
--
ALTER TABLE `tblcompany`
  ADD PRIMARY KEY (`COMPANYID`);

--
-- Indexes for table `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`INCID`),
  ADD UNIQUE KEY `EMPLOYEEID` (`EMPLOYEEID`);

--
-- Indexes for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  ADD PRIMARY KEY (`FEEDBACKID`);

--
-- Indexes for table `tbljob`
--
ALTER TABLE `tbljob`
  ADD PRIMARY KEY (`JOBID`);

--
-- Indexes for table `tbljobregistration`
--
ALTER TABLE `tbljobregistration`
  ADD PRIMARY KEY (`REGISTRATIONID`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`USERID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblapplicants`
--
ALTER TABLE `tblapplicants`
  MODIFY `APPLICANTID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2018016;

--
-- AUTO_INCREMENT for table `tblattachmentfile`
--
ALTER TABLE `tblattachmentfile`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblautonumbers`
--
ALTER TABLE `tblautonumbers`
  MODIFY `AUTOID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `CATEGORYID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tblcompany`
--
ALTER TABLE `tblcompany`
  MODIFY `COMPANYID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `INCID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  MODIFY `FEEDBACKID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbljob`
--
ALTER TABLE `tbljob`
  MODIFY `JOBID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbljobregistration`
--
ALTER TABLE `tbljobregistration`
  MODIFY `REGISTRATIONID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
