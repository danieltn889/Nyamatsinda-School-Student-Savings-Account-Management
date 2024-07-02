

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `added_money_tbl` (
  `Sid` int(11) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `added_amount` decimal(10,2) DEFAULT NULL,
  `tdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `Sid` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `class` varchar(10) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `savings` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`Sid`, `fname`, `lname`, `gender`, `class`, `department`, `savings`) VALUES
(1, 'Turikumwenimana ', 'Daniel', 'M', 'IT A', 'SOD', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `took_money_tbl`
--

CREATE TABLE `took_money_tbl` (
  `Sid` int(11) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `amount_taken` decimal(10,2) DEFAULT NULL,
  `tdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `added_money_tbl`
--
ALTER TABLE `added_money_tbl`
  ADD KEY `Sid` (`Sid`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`Sid`);

--
-- Indexes for table `took_money_tbl`
--
ALTER TABLE `took_money_tbl`
  ADD KEY `Sid` (`Sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `Sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `added_money_tbl`
--
ALTER TABLE `added_money_tbl`
  ADD CONSTRAINT `added_money_tbl_ibfk_1` FOREIGN KEY (`Sid`) REFERENCES `student_tbl` (`Sid`);

--
-- Constraints for table `took_money_tbl`
--
ALTER TABLE `took_money_tbl`
  ADD CONSTRAINT `took_money_tbl_ibfk_1` FOREIGN KEY (`Sid`) REFERENCES `student_tbl` (`Sid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
