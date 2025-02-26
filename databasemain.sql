-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2025 at 06:54 AM
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
-- Database: `fds1a1`
--

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `farmerID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`farmerID`, `username`, `password`) VALUES
(1, 'john_farmer', '$2y$10$Fw3TrXSDpf5Vxfj8AMhPA.Zmv2hHHpL3RAV2NzfrxtzLjCcZ.NIW.'),
(2, 'mary_farmer', '$2y$10$Fw3TrXSDpf5Vxfj8AMhPA.Zmv2hHHpL3RAV2NzfrxtzLjCcZ.NIW.');

-- --------------------------------------------------------

--
-- Table structure for table `fdetails`
--

CREATE TABLE `fdetails` (
  `farmerid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` enum('M','F','Other') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fdetails`
--

INSERT INTO `fdetails` (`farmerid`, `name`, `phone_no`, `age`, `sex`) VALUES
(1, 'John Doe', '555-1234', 45, 'M'),
(2, 'Mary Farmer', '555-5678', 38, 'F');

-- --------------------------------------------------------

--
-- Table structure for table `ldetails`
--

CREATE TABLE `ldetails` (
  `landID` int(11) NOT NULL,
  `farmerid` int(11) NOT NULL,
  `land_location` varchar(255) NOT NULL,
  `usages` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ldetails`
--

INSERT INTO `ldetails` (`landID`, `farmerid`, `land_location`, `usages`) VALUES
(1, 1, 'Farmville, State A', 'Wheat production'),
(2, 1, 'Rural Area, State A', 'Vegetable farming'),
(3, 2, 'Countryside, State B', 'Dairy farming');

-- --------------------------------------------------------

--
-- Table structure for table `reqdetails`
--

CREATE TABLE `reqdetails` (
  `requestID` int(11) NOT NULL,
  `farmerid` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `delivery` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reqdetails`
--

INSERT INTO `reqdetails` (`requestID`, `farmerid`, `status`, `delivery`) VALUES
(1, 1, 'Approved', 5),
(2, 2, 'Pending', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`farmerID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `fdetails`
--
ALTER TABLE `fdetails`
  ADD PRIMARY KEY (`farmerid`);

--
-- Indexes for table `ldetails`
--
ALTER TABLE `ldetails`
  ADD PRIMARY KEY (`landID`),
  ADD KEY `farmerid` (`farmerid`);

--
-- Indexes for table `reqdetails`
--
ALTER TABLE `reqdetails`
  ADD PRIMARY KEY (`requestID`),
  ADD KEY `farmerid` (`farmerid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `farmerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ldetails`
--
ALTER TABLE `ldetails`
  MODIFY `landID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reqdetails`
--
ALTER TABLE `reqdetails`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fdetails`
--
ALTER TABLE `fdetails`
  ADD CONSTRAINT `fdetails_ibfk_1` FOREIGN KEY (`farmerid`) REFERENCES `farmers` (`farmerID`);

--
-- Constraints for table `ldetails`
--
ALTER TABLE `ldetails`
  ADD CONSTRAINT `ldetails_ibfk_1` FOREIGN KEY (`farmerid`) REFERENCES `farmers` (`farmerID`);

--
-- Constraints for table `reqdetails`
--
ALTER TABLE `reqdetails`
  ADD CONSTRAINT `reqdetails_ibfk_1` FOREIGN KEY (`farmerid`) REFERENCES `farmers` (`farmerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Create `depid` table (Department Details)
CREATE TABLE depid (
    depID INT PRIMARY KEY AUTO_INCREMENT,
    depName VARCHAR(100) NOT NULL
);

-- Create `offlogin` table (Officer Login Details)
CREATE TABLE offlogin (
    username VARCHAR(50) PRIMARY KEY,
    passw VARCHAR(255) NOT NULL, -- Store hashed passwords
    offID INT UNIQUE NOT NULL
);

-- Create `offdetails` table (Officer Personal Details)
CREATE TABLE offdetails (
    offID INT PRIMARY KEY AUTO_INCREMENT,
    depID INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    age INT CHECK (age > 18),
    phno VARCHAR(15) UNIQUE NOT NULL,
    sex ENUM('Male', 'Female', 'Other') NOT NULL,
    FOREIGN KEY (depID) REFERENCES depid(depID) ON DELETE CASCADE
);



-- Insert sample departments
INSERT INTO depid (depName) VALUES 
('Agriculture'), 
('Irrigation'), 
('Livestock'), 
('Soil & Water Conservation'), 
('Research & Development');

-- Insert sample officers into `offdetails`
INSERT INTO offdetails (depID, name, age, phno, sex) VALUES 
(1, 'John Doe', 45, '9876543210', 'Male'),
(2, 'Jane Smith', 38, '8765432109', 'Female'),
(3, 'Michael Brown', 50, '7654321098', 'Male'),
(4, 'Lisa White', 42, '6543210987', 'Female'),
(5, 'Chris Green', 35, '5432109876', 'Other');

-- Insert sample login credentials (with hashed passwords)
INSERT INTO offlogin (username, passw, offID) VALUES 
('johndoe', '$2y$10$Fw3TrXSDpf5Vxfj8AMhPA.Zmv2hHHpL3RAV2NzfrxtzLjCcZ.NIW.', 1),
('janesmith', '$2y$10$Fw3TrXSDpf5Vxfj8AMhPA.Zmv2hHHpL3RAV2NzfrxtzLjCcZ.NIW.', 2),
('michaelb', '$2y$10$Fw3TrXSDpf5Vxfj8AMhPA.Zmv2hHHpL3RAV2NzfrxtzLjCcZ.NIW.', 3),
('lisawhite', '$2y$10$Fw3TrXSDpf5Vxfj8AMhPA.Zmv2hHHpL3RAV2NzfrxtzLjCcZ.NIW.', 4),
('chrisg', '$2y$10$Fw3TrXSDpf5Vxfj8AMhPA.Zmv2hHHpL3RAV2NzfrxtzLjCcZ.NIW.', 256), 5);

