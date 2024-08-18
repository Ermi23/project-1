-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2024 at 10:00 AM
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
-- Database: `quit_co`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_payment_sheet`
--

CREATE TABLE `bank_payment_sheet` (
  `ID` int(11) NOT NULL,
  `Employee_ID` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Bank_Name` varchar(255) DEFAULT NULL,
  `Account_Number` varchar(255) DEFAULT NULL,
  `Net_Pay` decimal(10,2) DEFAULT NULL,
  `Datee` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_payment_sheet`
--

INSERT INTO `bank_payment_sheet` (`ID`, `Employee_ID`, `Name`, `Bank_Name`, `Account_Number`, `Net_Pay`, `Datee`) VALUES
(11, 'EF001', 'Employee1', 'United Bank', '1234567890', 21649.00, 'Jan - 2024'),
(12, 'EF002', 'Employee2', 'United Bank', '2345678901', 25810.00, 'Jan - 2024'),
(13, 'EF003', 'Employee3', 'United Bank', '0987654321', 44125.00, 'Jan - 2024'),
(14, 'EF005', 'Employee5', 'United Bank', '9078654211', 19890.00, 'Jan - 2024'),
(15, 'EF006', 'Employee6', 'United Bank', '5432167890', 27465.00, 'Jan - 2024'),
(16, 'EF004', 'Employee4', 'United Bank', '8907654321', 8342.50, 'Jan - 2024'),
(17, 'EF007', 'Employee7', 'United Bank', '0897564231', 22085.50, 'Jan - 2024'),
(18, 'EF008', 'Employee8', 'United Bank', '1230984576', 31199.50, 'Jan - 2024'),
(19, 'EF009', 'Employee9', 'United Bank', '1357908642', 21460.35, 'Jan - 2024'),
(20, 'EF010', 'Employee10', 'United Bank', '1357906824', 9337.95, 'Jan - 2024'),
(21, 'EF011', 'Employee11', 'United Bank', '0088664422', 30415.00, 'Jan - 2024'),
(22, 'EF012', 'Employee1', 'United Bank', '9977553311', 20611.06, 'Jan - 2024');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeID`, `Email`, `password`) VALUES
('EF010', 'Employee10@gmail.com', 'emp@10'),
('EF011', 'Employee11@gmail.com', 'emp@11'),
('EF012', 'Employee12@gmail.com', 'emp@12'),
('EF001', 'Employee1@gmail.com', 'emp@1'),
('EF002', 'Employee2@gmail.com', 'emp@2'),
('EF003', 'Employee3@gmail.com', 'emp@3'),
('EF004', 'Employee4@gmail.com', 'emp@4'),
('EF005', 'Employee5@gmail.com', 'emp@5'),
('EF006', 'Employee6@gmail.com', 'emp@6'),
('EF007', 'Employee7@gmail.com', 'emp@7'),
('EF008', 'Employee8@gmail.com', 'emp@8'),
('EF009', 'Employee9@gmail.com', 'emp@9');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_rate`
--

CREATE TABLE `exchange_rate` (
  `ID` int(11) NOT NULL,
  `USD` decimal(10,2) NOT NULL,
  `ETB` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exchange_rate`
--

INSERT INTO `exchange_rate` (`ID`, `USD`, `ETB`) VALUES
(1, 1.00, 56.32);

-- --------------------------------------------------------

--
-- Table structure for table `incometax`
--

CREATE TABLE `incometax` (
  `መለያ_ኮድ` varchar(255) DEFAULT NULL,
  `የሠራተኛው_ስም` varchar(255) DEFAULT NULL,
  `የተቀጠሩበት_ቀን` varchar(255) DEFAULT NULL,
  `ጠቅላላ_የትራንስፖርት_አበል` decimal(10,2) DEFAULT NULL,
  `የስራ_ንግድ_ግብር_የሚከፈልበት_የትራንስፖርት_አበል` decimal(10,2) DEFAULT NULL,
  `ትርፍ_ሰዓት_ክፍያ` decimal(10,2) DEFAULT NULL,
  `ሌሎች_ጥቅማ_ጥቀሞች` decimal(10,2) DEFAULT NULL,
  `ጠቅላላ_ግብር_የሚከፈልበት_ብር` decimal(10,2) DEFAULT NULL,
  `የስራ_ግብር` decimal(10,2) DEFAULT NULL,
  `የትምህርት_ወጪ_መጋራት` decimal(10,2) DEFAULT NULL,
  `የተጣራ_ክፍያ` decimal(10,2) DEFAULT NULL,
  `የሠራተኛ_ፊርማ` varchar(255) DEFAULT NULL,
  `Datee` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incometax`
--

INSERT INTO `incometax` (`መለያ_ኮድ`, `የሠራተኛው_ስም`, `የተቀጠሩበት_ቀን`, `ጠቅላላ_የትራንስፖርት_አበል`, `የስራ_ንግድ_ግብር_የሚከፈልበት_የትራንስፖርት_አበል`, `ትርፍ_ሰዓት_ክፍያ`, `ሌሎች_ጥቅማ_ጥቀሞች`, `ጠቅላላ_ግብር_የሚከፈልበት_ብር`, `የስራ_ግብር`, `የትምህርት_ወጪ_መጋራት`, `የተጣራ_ክፍያ`, `የሠራተኛ_ፊርማ`, `Datee`) VALUES
('EF001', 'Employee1', '01- Jan - 2024', 2600.00, 0.00, 0.00, 24500.00, 42900.00, 12605.00, 0.00, 21649.00, ' ', 'Jan - 2024'),
('EF002', 'Employee2', '01- Jan - 2024', 2600.00, 0.00, 0.00, 26500.00, 48600.00, 14600.00, 0.00, 25810.00, ' ', 'Jan - 2024'),
('EF003', 'Employee3', '01- Jan - 2024', 2600.00, 0.00, 0.00, 42800.00, 68900.00, 21705.00, 0.00, 44125.00, ' ', 'Jan - 2024'),
('EF005', 'Employee5', '01- Jan - 2024', 2000.00, 0.00, 5200.00, 16500.00, 33200.00, 9420.00, 0.00, 19890.00, ' ', 'Jan - 2024'),
('EF006', 'Employee6', '01- Jan - 2024', 2000.00, 0.00, 6300.00, 17500.00, 42300.00, 12605.00, 0.00, 27465.00, ' ', 'Jan - 2024'),
('EF004', 'Employee4', '01- Jan - 2024', 1600.00, 1125.00, 0.00, 5100.00, 11200.00, 2067.50, 0.00, 8342.50, ' ', 'Jan - 2024'),
('EF007', 'Employee7', '01- Jan - 2024', 2000.00, 1125.00, 2600.00, 16500.00, 33450.00, 9507.50, 0.00, 22085.50, ' ', 'Jan - 2024'),
('EF008', 'Employee8', '01- Jan - 2024', 2000.00, 1125.00, 0.00, 36500.00, 47150.00, 14302.50, 0.00, 31199.50, ' ', 'Jan - 2024'),
('EF009', 'Employee9', '01- Jan - 2024', 2000.00, 1405.00, 1300.00, 26500.00, 35420.00, 10405.25, 0.00, 21460.35, ' ', 'Jan - 2024'),
('EF010', 'Employee10', '01- Jan - 2024', 2000.00, 1972.50, 1350.00, 1600.00, 12840.00, 2305.25, 0.00, 9337.95, ' ', 'Jan - 2024'),
('EF011', 'Employee11', '01- Jan - 2024', 2000.00, 1972.50, 2500.00, 2600.00, 52100.00, 16035.00, 0.00, 30415.00, ' ', 'Jan - 2024'),
('EF012', 'Employee1', '01- Jan - 2024', 2000.00, 1972.50, 2600.00, 2500.00, 33602.00, 9560.70, 0.00, 20611.06, ' ', 'Jan - 2024');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_sheet`
--

CREATE TABLE `payroll_sheet` (
  `Employee_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Basic_Salary` decimal(10,2) DEFAULT NULL,
  `Housing_Allowance` decimal(10,2) DEFAULT NULL,
  `Overtime_Payment` decimal(10,2) DEFAULT NULL,
  `Annual_Bonus` decimal(10,2) DEFAULT NULL,
  `Car_Allowance` decimal(10,2) DEFAULT NULL,
  `Holiday_Pay` decimal(10,2) DEFAULT NULL,
  `Total_Income` decimal(10,2) DEFAULT NULL,
  `Taxable_Income` decimal(10,2) DEFAULT NULL,
  `Income_Tax` decimal(10,2) DEFAULT NULL,
  `Pension` decimal(10,2) DEFAULT NULL,
  `Red_Cross_Contribution` decimal(10,2) DEFAULT NULL,
  `Social_Welfare_Contribution` decimal(10,2) DEFAULT NULL,
  `Loan_Deduction` decimal(10,2) DEFAULT NULL,
  `Total_Deduction` decimal(10,2) DEFAULT NULL,
  `Net_Pay` decimal(10,2) DEFAULT NULL,
  `Datee` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll_sheet`
--

INSERT INTO `payroll_sheet` (`Employee_ID`, `Name`, `Basic_Salary`, `Housing_Allowance`, `Overtime_Payment`, `Annual_Bonus`, `Car_Allowance`, `Holiday_Pay`, `Total_Income`, `Taxable_Income`, `Income_Tax`, `Pension`, `Red_Cross_Contribution`, `Social_Welfare_Contribution`, `Loan_Deduction`, `Total_Deduction`, `Net_Pay`, `Datee`) VALUES
('EF001', 'Employee1', 15800.00, 1500.00, 0.00, 23000.00, 2600.00, 0.00, 42900.00, 40300.00, 12605.00, 1106.00, 790.00, 250.00, 6500.00, 21251.00, 21649.00, 'Jan - 2024'),
('EF002', 'Employee2', 19500.00, 1500.00, 0.00, 25000.00, 2600.00, 0.00, 48600.00, 46000.00, 14600.00, 1365.00, 975.00, 250.00, 5600.00, 22790.00, 25810.00, 'Jan - 2024'),
('EF003', 'Employee3', 23500.00, 2500.00, 0.00, 25300.00, 2600.00, 15000.00, 68900.00, 66300.00, 21705.00, 1645.00, 1175.00, 250.00, 0.00, 24775.00, 44125.00, 'Jan - 2024'),
('EF004', 'Employee4', 4500.00, 2500.00, 0.00, 0.00, 1600.00, 2600.00, 11200.00, 10075.00, 2067.50, 315.00, 225.00, 250.00, 0.00, 2857.50, 8342.50, 'Jan - 2024'),
('EF005', 'Employee5', 9500.00, 1500.00, 5200.00, 0.00, 2000.00, 15000.00, 33200.00, 31200.00, 9420.00, 665.00, 475.00, 250.00, 2500.00, 13310.00, 19890.00, 'Jan - 2024'),
('EF006', 'Employee6', 16500.00, 2500.00, 6300.00, 0.00, 2000.00, 15000.00, 42300.00, 40300.00, 12605.00, 1155.00, 825.00, 250.00, 0.00, 14835.00, 27465.00, 'Jan - 2024'),
('EF007', 'Employee7', 12350.00, 1500.00, 2600.00, 0.00, 2000.00, 15000.00, 33450.00, 31450.00, 9507.50, 864.50, 617.50, 250.00, 125.00, 11364.50, 22085.50, 'Jan - 2024'),
('EF008', 'Employee8', 8650.00, 1500.00, 0.00, 35000.00, 2000.00, 0.00, 47150.00, 45150.00, 14302.50, 605.50, 432.50, 250.00, 360.00, 15950.50, 31199.50, 'Jan - 2024'),
('EF009', 'Employee9', 5620.00, 1500.00, 1300.00, 25000.00, 2000.00, 0.00, 35420.00, 34015.00, 10405.25, 393.40, 281.00, 250.00, 2630.00, 13959.65, 21460.35, 'Jan - 2024'),
('EF010', 'Employee10', 7890.00, 1600.00, 1350.00, 0.00, 2000.00, 0.00, 12840.00, 10867.50, 2305.25, 552.30, 394.50, 250.00, 0.00, 3502.05, 9337.95, 'Jan - 2024'),
('EF011', 'Employee11', 45000.00, 2600.00, 2500.00, 0.00, 2000.00, 0.00, 52100.00, 50100.00, 16035.00, 3150.00, 2250.00, 250.00, 0.00, 21685.00, 30415.00, 'Jan - 2024'),
('EF012', 'Employee1', 26502.00, 2500.00, 2600.00, 0.00, 2000.00, 0.00, 33602.00, 31602.00, 9560.70, 1855.14, 1325.10, 250.00, 0.00, 12990.94, 20611.06, 'Jan - 2024');

-- --------------------------------------------------------

--
-- Table structure for table `report_tb`
--

CREATE TABLE `report_tb` (
  `report_id` int(15) NOT NULL,
  `pdf` varchar(400) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Payroll Type` varchar(255) NOT NULL,
  `desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `datee` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report_tb`
--

INSERT INTO `report_tb` (`report_id`, `pdf`, `Email`, `fname`, `Payroll Type`, `desc`, `datee`) VALUES
(1, 'PayrollSheet For Dec - 2023G.C.pdf', 'abc@gmail.com', 'abc', 'PRS', 'Payroll Report for Dec - 2023', '2023-12-20'),
(5, 'exported_data.xlsx', 'abc@gmail.com', 'abc', 'PR', 'excel file try to upload', '2023-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `requesterlogin_tb`
--

CREATE TABLE `requesterlogin_tb` (
  `r_login_id` int(11) NOT NULL,
  `r_name` varchar(60) NOT NULL,
  `r_email` varchar(60) NOT NULL,
  `r_password` varchar(60) NOT NULL,
  `position` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `requesterlogin_tb`
--

INSERT INTO `requesterlogin_tb` (`r_login_id`, `r_name`, `r_email`, `r_password`, `position`) VALUES
(32, 'abc', 'abc@gmail.com', 'abc123', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `ID` int(11) NOT NULL,
  `NameOfStaff` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `EmployeeID` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Department` varchar(255) NOT NULL,
  `PaymentCurrency` varchar(255) NOT NULL,
  `BasicSalary` decimal(10,2) NOT NULL,
  `HousingAllowance` decimal(10,2) NOT NULL,
  `OvertimePayment` decimal(10,2) NOT NULL,
  `AnualBonus` decimal(10,2) NOT NULL,
  `FCA` decimal(10,2) NOT NULL,
  `CarAllowance` decimal(10,2) NOT NULL,
  `HolydayPay` decimal(10,2) NOT NULL,
  `Loan` decimal(10,2) NOT NULL,
  `BankName` varchar(255) NOT NULL,
  `BankAcc` varchar(255) NOT NULL,
  `emptype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`ID`, `NameOfStaff`, `EmployeeID`, `Department`, `PaymentCurrency`, `BasicSalary`, `HousingAllowance`, `OvertimePayment`, `AnualBonus`, `FCA`, `CarAllowance`, `HolydayPay`, `Loan`, `BankName`, `BankAcc`, `emptype`) VALUES
(17, 'Employee1', 'EF001', 'Audit', 'ETB', 15800.00, 1500.00, 0.00, 23000.00, 0.00, 2600.00, 0.00, 6500.00, 'United Bank', '1234567890', 'Full Time'),
(20, 'Employee2', 'EF002', 'Audit', 'ETB', 19500.00, 1500.00, 0.00, 25000.00, 0.00, 2600.00, 0.00, 5600.00, 'United Bank', '2345678901', 'Full Time'),
(21, 'Employee3', 'EF003', 'Audit', 'ETB', 23500.00, 2500.00, 0.00, 25300.00, 0.00, 2600.00, 15000.00, 0.00, 'United Bank', '0987654321', 'Full Time'),
(22, 'Employee5', 'EF005', 'Marketing', 'ETB', 9500.00, 1500.00, 5200.00, 0.00, 0.00, 2000.00, 15000.00, 2500.00, 'United Bank', '9078654211', 'Full Time'),
(24, 'Employee6', 'EF006', 'Marketing', 'ETB', 16500.00, 2500.00, 6300.00, 0.00, 0.00, 2000.00, 15000.00, 0.00, 'United Bank', '5432167890', 'Full Time'),
(31, 'Employee4', 'EF004', 'Marketing', 'USD', 4500.00, 2500.00, 0.00, 0.00, 1230.00, 1600.00, 2600.00, 0.00, 'United Bank', '8907654321', 'Full Time'),
(34, 'Employee7', 'EF007', 'Procurement', 'ETB', 12350.00, 1500.00, 2600.00, 0.00, 0.00, 2000.00, 15000.00, 125.00, 'United Bank', '0897564231', 'Full Time'),
(35, 'Employee8', 'EF008', 'Procurement', 'ETB', 8650.00, 1500.00, 0.00, 35000.00, 0.00, 2000.00, 0.00, 360.00, 'United Bank', '1230984576', 'Full Time'),
(36, 'Employee9', 'EF009', 'Procurement', 'ETB', 5620.00, 1500.00, 1300.00, 25000.00, 0.00, 2000.00, 0.00, 2630.00, 'United Bank', '1357908642', 'Full Time'),
(39, 'Employee10', 'EF010', 'Production', 'ETB', 7890.00, 1600.00, 1350.00, 0.00, 0.00, 2000.00, 0.00, 0.00, 'United Bank', '1357906824', 'Full Time'),
(40, 'Employee11', 'EF011', 'Production', 'ETB', 45000.00, 2600.00, 2500.00, 0.00, 0.00, 2000.00, 0.00, 0.00, 'United Bank', '0088664422', 'Full Time'),
(41, 'Employee1', 'EF012', 'Production', 'ETB', 26502.00, 2500.00, 2600.00, 0.00, 0.00, 2000.00, 0.00, 0.00, 'United Bank', '9977553311', 'Full Time');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_payment_sheet`
--
ALTER TABLE `bank_payment_sheet`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Employee_ID` (`Employee_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `EmployeeID` (`EmployeeID`);

--
-- Indexes for table `exchange_rate`
--
ALTER TABLE `exchange_rate`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `payroll_sheet`
--
ALTER TABLE `payroll_sheet`
  ADD PRIMARY KEY (`Employee_ID`);

--
-- Indexes for table `report_tb`
--
ALTER TABLE `report_tb`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `requesterlogin_tb`
--
ALTER TABLE `requesterlogin_tb`
  ADD PRIMARY KEY (`r_login_id`),
  ADD UNIQUE KEY `r_email` (`r_email`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EmployeeID` (`EmployeeID`),
  ADD UNIQUE KEY `EmployeeID_2` (`EmployeeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_payment_sheet`
--
ALTER TABLE `bank_payment_sheet`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `exchange_rate`
--
ALTER TABLE `exchange_rate`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `report_tb`
--
ALTER TABLE `report_tb`
  MODIFY `report_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `requesterlogin_tb`
--
ALTER TABLE `requesterlogin_tb`
  MODIFY `r_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_payment_sheet`
--
ALTER TABLE `bank_payment_sheet`
  ADD CONSTRAINT `FK_Employee_ID` FOREIGN KEY (`Employee_ID`) REFERENCES `staff` (`EmployeeID`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `staff` (`EmployeeID`);

--
-- Constraints for table `payroll_sheet`
--
ALTER TABLE `payroll_sheet`
  ADD CONSTRAINT `Employee_ID` FOREIGN KEY (`Employee_ID`) REFERENCES `employee` (`EmployeeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
