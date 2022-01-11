-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29 ديسمبر 2021 الساعة 20:30
-- إصدار الخادم: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book1`
--

-- --------------------------------------------------------

--
-- بنية الجدول `customer`
--

CREATE TABLE `customer` (
  `UserID` int(11) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `customer`
--

INSERT INTO `customer` (`UserID`, `FullName`, `Email`, `Password`, `Phone`) VALUES
(1, 'Fiteer alqiadi', 'fiteer@gmail.com', '2778cb15047b69e5e1e166cbb0d8c4323c9595c6', '738843852');

-- --------------------------------------------------------

--
-- بنية الجدول `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `ordered` date NOT NULL,
  `dateofevent` date NOT NULL,
  `Location` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `costumer_id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `pakage_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `order`
--

INSERT INTO `order` (`OrderID`, `Name`, `ordered`, `dateofevent`, `Location`, `total`, `costumer_id`, `phone`, `Email`, `pakage_id`) VALUES
(1, 'rhgfdhfdbfdghdf', '2021-12-28', '2021-12-30', 'اليمن', '10000', 1, '738843852', 'fiteer@gmail.com', 1),
(2, 'rhgfdhfdbfdghdf', '2021-12-29', '2021-12-30', 'اليمن', '10000', 1, '738843852', 'fiteer@gmail.com', 1),
(3, 'home', '2021-12-29', '2021-12-31', 'اليمن', '1200', 1, '738843852', 'fiteer@gmail.com', 2);

-- --------------------------------------------------------

--
-- بنية الجدول `package`
--

CREATE TABLE `package` (
  `ID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `Describe` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `package`
--

INSERT INTO `package` (`ID`, `Title`, `package_name`, `Describe`, `price`) VALUES
(1, 'rhgfdhfdbfdghdf', 'sgghgfdhfdhfds', 'shrshfdbdfndfghfdhf', '10000'),
(2, 'home', 'lihkjhl;ihilhloih', 'kihjlkhlikhlokih', '1200');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `ord1` (`pakage_id`),
  ADD KEY `ord2` (`costumer_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `ord1` FOREIGN KEY (`pakage_id`) REFERENCES `package` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ord2` FOREIGN KEY (`costumer_id`) REFERENCES `customer` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
