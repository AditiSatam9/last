-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2024 at 07:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmsc`
--

-- --------------------------------------------------------

--
-- Table structure for table `sirb`
--

CREATE TABLE `sirb` (
  `sirb_id` int(4) NOT NULL,
  `URL` varchar(14) DEFAULT NULL,
  `issue` int(2) DEFAULT NULL,
  `mmyy` varchar(16) DEFAULT NULL,
  `volno` int(3) DEFAULT NULL,
  `mm1` varchar(3) DEFAULT NULL,
  `mm2` varchar(3) DEFAULT NULL,
  `yy` int(4) DEFAULT NULL,
  `upd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sirb`
--

INSERT INTO `sirb` (`sirb_id`, `URL`, `issue`, `mmyy`, `volno`, `mm1`, `mm2`, `yy`, `upd`) VALUES
(1, 'sirb01.pdf', 1, 'Jan-2014', 4, 'Jan', 'Jan', 2014, '2024-07-03 08:18:48'),
(2, 'sirb02.pdf', 2, 'Feb-2014', 4, 'Feb', 'Feb', 2014, '2016-03-29 23:08:51'),
(3, 'sirb03.pdf', 3, 'Mar-2014', 4, 'Mar', 'Mar', 2014, '2016-03-29 23:08:51'),
(4, 'sirb04.pdf', 4, 'Apr-2014', 4, 'Apr', 'Apr', 2014, '2016-03-29 23:08:51'),
(5, 'sirb05.pdf', 5, 'May-2014', 4, 'May', 'May', 2014, '2016-03-29 23:08:51'),
(6, 'sirb06.pdf', 6, 'Jun-2014', 4, 'Jun', 'Jun', 2014, '2016-03-29 23:08:51'),
(7, 'sirb07.pdf', 7, 'Jul-2014', 4, 'Jul', 'Jul', 2014, '2016-03-29 23:08:51'),
(8, 'sirb08.pdf', 8, 'Aug-2014', 4, 'Aug', 'Aug', 2014, '2016-03-29 23:08:51'),
(9, 'sirb09.pdf', 9, 'Sep-2014', 4, 'Sep', 'Sep', 2014, '2016-03-29 23:08:51'),
(10, 'sirb10.pdf', 10, 'Oct-2014', 4, 'Oct', 'Oct', 2014, '2016-03-29 23:08:51'),
(11, 'sirb11.pdf', 11, 'Nov-2014', 4, 'Nov', 'Nov', 2014, '2016-03-29 23:08:51'),
(12, 'sirb12.pdf', 12, 'Dec-2014', 4, 'Dec', 'Dec', 2014, '2016-03-29 23:08:51'),
(13, 'sirb01.pdf', 1, 'Jan-2015', 5, 'Jan', 'Jan', 2015, '2016-03-29 23:08:51'),
(14, 'sirb02.pdf', 2, 'Feb-2015', 5, 'Feb', 'Feb', 2015, '2016-03-29 23:08:51'),
(15, 'sirb03.pdf', 3, 'Mar-2015', 5, 'Mar', 'Mar', 2015, '2016-03-29 23:08:51'),
(16, 'sirb04.pdf', 4, 'April-2015', 5, 'Apr', 'Apr', 2015, '2016-03-29 23:08:51'),
(17, 'sirb05.pdf', 5, 'May-2015', 5, 'May', 'May', 2015, '2016-03-29 23:08:51'),
(18, 'sirb06.pdf', 6, 'June-2015', 5, 'Jun', 'Jun', 2015, '2016-03-29 23:08:51'),
(19, 'sirb07.pdf', 7, 'July-2015', 5, 'Jul', 'Jul', 2015, '2016-03-29 23:08:51'),
(20, 'sirb08.pdf', 8, 'Aug-2015', 5, 'Aug', 'Aug', 2015, '2016-03-29 23:08:51'),
(21, 'sirb09.pdf', 9, 'Sep-2015', 5, 'Sep', 'Sep', 2015, '2016-03-29 23:08:51'),
(22, 'sirb10.pdf', 10, 'Oct-2015', 5, 'Oct', 'Oct', 2015, '2016-03-29 23:08:51'),
(25, 'sirb01.pdf', 1, 'Jan-2016', 6, 'Jan', 'Jan', 2016, '2016-03-29 23:08:51'),
(23, 'sirb11.pdf', 11, 'Nov-2015', 5, 'Nov', 'Nov', 2015, '2016-03-29 23:08:51'),
(29, 'sirb05.pdf', 5, 'May-2016', 6, 'May', 'May', 2016, '2016-05-10 04:26:38'),
(30, 'sirb06.pdf', 6, 'June-2016', 6, 'Jun', 'Jun', 2016, '2016-05-10 04:26:38'),
(31, 'sirb07.pdf', 7, 'July-2016', 6, 'Jul', 'Jul', 2016, '2016-09-21 00:40:15'),
(32, 'sirb08.pdf', 8, 'August-2016', 6, 'Aug', 'Aug', 2016, '2016-09-20 13:00:00'),
(33, 'sirb09.pdf', 9, 'September-2016', 6, 'Sep', 'Sep', 2016, '2016-10-25 13:00:00'),
(34, 'sirb10.pdf', 10, 'October-2016', 6, 'Oct', 'Oct', 2016, '2016-11-10 13:00:00'),
(35, 'sirb11.pdf', 11, 'November-2016', 6, 'Nov', 'Nov', 2016, '2016-12-18 13:00:00'),
(36, 'sirb12.pdf', 12, 'December-2016', 6, 'Dec', 'Dec', 2016, '2017-01-23 13:00:00'),
(37, 'sirb01.pdf', 1, 'January-2017', 7, 'Jan', 'Jan', 2017, '2017-02-13 13:00:00'),
(38, 'sirb02.pdf', 2, 'February-2017', 7, 'Feb', 'Feb', 2017, '2017-03-15 13:00:00'),
(39, 'sirb03.pdf', 3, 'March-2017', 7, 'Mar', 'Mar', 2017, '2017-04-27 00:59:07'),
(40, 'sirb04.pdf', 4, 'April-2017', 7, 'Apr', 'Apr', 2017, '2017-05-15 13:00:00'),
(41, 'sirb05.pdf', 5, 'May-2017', 7, 'May', 'May', 2017, '2017-06-28 13:00:00'),
(42, 'sirb06.pdf', 6, 'June-2017', 7, 'Jun', 'Jun', 2017, '2017-09-17 23:58:49'),
(43, 'sirb07.pdf', 7, 'July-2017', 7, 'Jul', 'Jul', 2017, '2017-09-17 23:58:49'),
(44, 'sirb08.pdf', 8, 'August-2017', 7, 'Aug', 'Aug', 2017, '2017-09-17 13:00:00'),
(45, 'sirb09.pdf', 9, 'September-2017', 7, 'Sep', 'Sep', 2017, '2017-10-09 13:00:00'),
(46, 'sirb10.pdf', 10, 'October-2017', 7, 'Oct', 'Oct', 2017, '2017-11-15 13:00:00'),
(47, 'sirb11.pdf', 11, 'November-2017', 7, 'Nov', 'Nov', 2017, '2017-12-11 13:00:00'),
(48, 'sirb12.pdf', 12, 'December-2017', 7, 'Dec', 'Dec', 2017, '2018-01-11 03:26:28'),
(49, 'sirb01.pdf', 1, 'January-2018', 8, 'Jan', 'Jan', 2018, '2018-02-15 13:00:00'),
(50, 'sirb02.pdf', 2, 'February-2018', 8, 'Feb', 'Feb', 2018, '2018-03-27 03:59:12'),
(51, 'sirb03.pdf', 3, 'March-2018', 8, 'Mar', 'Mar', 2018, '2018-05-01 13:00:00'),
(52, 'sirb04.pdf', 4, 'April-2018', 8, 'Apr', 'Apr', 2018, '2018-05-23 13:00:00'),
(53, 'sirb05.pdf', 5, 'May-2018', 8, 'May', 'May', 2018, '2018-06-21 13:00:00'),
(54, 'sirb06.pdf', 6, 'June-2018', 8, 'Jun', 'Jun', 2018, '2018-07-24 13:00:00'),
(55, 'sirb07.pdf', 7, 'July-2018', 8, 'Jul', 'Jul', 2018, '2018-08-23 13:00:00'),
(56, 'sirb08.pdf', 8, 'August-2018', 8, 'Aug', 'Aug', 2018, '2018-10-09 13:00:00'),
(57, 'sirb09.pdf', 9, 'September-2018', 8, 'Sep', 'Sep', 2018, '2018-11-15 13:00:00'),
(58, 'sirb10.pdf', 10, 'October-2018', 8, 'Oct', 'Oct', 2018, '2018-11-15 13:00:00'),
(59, 'sirb11.pdf', 11, 'November-2018', 8, 'Nov', 'Nov', 2018, '2019-02-11 13:00:00'),
(60, 'sirb12.pdf', 12, 'December-2018', 8, 'Dec', 'Dec', 2018, '2019-02-11 13:00:00'),
(61, 'sirb01.pdf', 1, 'January-2019', 9, 'Jan', 'Jan', 2019, '2019-02-13 13:00:00'),
(62, 'sirb02.pdf', 2, 'February-2019', 9, 'Feb', 'Feb', 2019, '2019-04-09 13:00:00'),
(63, 'sirb03.pdf', 3, 'March-2019', 9, 'Mar', 'Mar', 2019, '2019-05-02 13:00:00'),
(64, 'sirb04.pdf', 4, 'April-2019', 9, 'Apr', 'Apr', 2019, '2019-05-19 13:00:00'),
(65, 'sirb05.pdf', 5, 'May-2019', 9, 'May', 'May', 2019, '2019-06-23 13:00:00'),
(66, 'sirb06.pdf', 6, 'June-2019', 9, 'Jun', 'Jun', 2019, '2020-02-16 13:00:00'),
(67, 'sirb07.pdf', 7, 'July-2019', 9, 'Jul', 'Jul', 2019, '2020-02-16 13:00:00'),
(68, 'sirb08.pdf', 8, 'August-2019', 9, 'Aug', 'Aug', 2019, '2020-02-16 13:00:00'),
(69, 'sirb09.pdf', 8, 'September-2019', 9, 'Sep', 'Sep', 2019, '2020-02-16 13:00:00'),
(70, 'sirb10.pdf', 10, 'October-2019', 9, 'Oct', 'Oct', 2019, '2020-02-16 13:00:00'),
(71, 'sirb11.pdf', 11, 'November-2019', 9, 'Nov', 'Nov', 2019, '2020-02-16 13:00:00'),
(72, 'sirb12.pdf', 12, 'December-2019', 9, 'Dec', 'Dec', 2019, '2020-02-16 13:00:00'),
(73, 'sirb01.pdf', 1, 'January-2020', 10, 'Jan', 'Jan', 2020, '2020-02-16 13:00:00'),
(74, 'sirb02.pdf', 2, 'February-2020', 10, 'Feb', 'Feb', 2020, '2020-03-15 13:00:00'),
(75, 'sirb09.pdf', 3, 'September-2020', 10, 'Sep', 'Sep', 2020, '2020-03-15 13:00:00'),
(76, 'sirb10.pdf', 4, 'October-2020', 10, 'Oct', 'Oct', 2020, '2020-03-15 13:00:00'),
(77, 'sirb11.pdf', 5, 'November-2020', 10, 'Nov', 'Nov', 2020, '2020-03-15 13:00:00'),
(78, 'sirb12.pdf', 6, 'December-2020', 10, 'Dec', 'Dec', 2020, '2021-01-13 04:53:40'),
(79, 'sirb01.pdf', 1, 'January-2021', 11, 'Jan', 'Jan', 2021, '2020-02-16 13:00:00'),
(80, 'sirb02.pdf', 2, 'February-2021', 11, 'Feb', 'Feb', 2021, '2020-02-16 13:00:00'),
(81, 'sirb06.pdf', 3, 'June-2021', 11, 'Jun', 'Jun', 2021, '2021-09-14 18:30:00'),
(82, 'sirb07.pdf', 4, 'July-2021', 11, 'Jul', 'Jul', 2021, '2021-09-14 18:30:00'),
(83, 'sirb08.pdf', 5, 'August-2021', 11, 'Aug', 'Aug', 2021, '2021-09-15 18:30:00'),
(84, 'sirb09.pdf', 6, 'September-2021', 11, 'Sep', 'Sep', 2021, '2021-11-02 18:30:00'),
(85, 'sirb10.pdf', 7, 'October-2021', 11, 'Oct', 'Oct', 2021, '2021-12-05 18:30:00'),
(86, 'sirb11.pdf', 8, 'November-2021', 11, 'Nov', 'Nov', 2021, '2021-12-20 18:30:00'),
(87, 'sirb12.pdf', 9, 'December-2021', 11, 'Dec', 'Dec', 2021, '2022-01-13 18:30:00'),
(88, 'sirb01.pdf', 1, 'January-2022', 12, 'Jan', 'Jan', 2022, '2022-01-13 18:30:00'),
(89, 'sirb02.pdf', 2, 'February-2022', 12, 'Feb', 'Feb', 2022, '2022-03-20 18:30:00'),
(90, 'sirb03.pdf', 3, 'March-2022', 12, 'Mar', 'Mar', 2022, '2022-04-10 18:30:00'),
(91, 'sirb04.pdf', 4, 'April-2022', 12, 'Apr', 'Apr', 2022, '2022-05-19 05:06:00'),
(92, 'sirb05.pdf', 5, 'May-2022', 12, 'May', 'May', 2022, '2022-06-16 08:58:00'),
(93, 'sirb06.pdf', 6, 'June-2022', 12, 'Jun', 'Jun', 2022, '2022-07-04 11:20:00'),
(94, 'sirb07.pdf', 7, 'July-2022', 12, 'Jul', 'Jul', 2022, '2022-07-10 11:20:00'),
(95, 'sirb08.pdf', 8, 'August-2022', 12, 'Aug', 'Aug', 2022, '2022-09-08 06:20:00'),
(96, 'sirb09.pdf', 9, 'September-2022', 12, 'Sep', 'Sep', 2022, '2022-10-07 12:20:00'),
(97, 'sirb10.pdf', 10, 'October-2022', 12, 'Oct', 'Oct', 2022, '2022-11-15 05:00:00'),
(98, 'sirb11.pdf', 11, 'November-2022', 12, 'Nov', 'Nov', 2022, '2022-12-12 05:00:00'),
(99, 'sirb12.pdf', 12, 'December-2022', 12, 'Dec', 'Dec', 2022, '2023-01-11 11:50:00'),
(100, 'sirb01.pdf', 1, 'January-2023', 13, 'Jan', 'Jan', 2023, '2022-02-20 18:30:00'),
(101, 'sirb02.pdf', 2, 'February-2023', 13, 'Feb', 'Feb', 2023, '2022-03-14 18:30:00'),
(102, 'sirb03.pdf', 3, 'March-2023', 13, 'Mar', 'Mar', 2023, '2022-04-17 09:06:00'),
(104, 'sirb04.pdf', 4, 'April-2023', 13, 'Apr', 'Apr', 2023, '2022-05-08 11:06:00'),
(105, 'sirb05.pdf', 5, 'May-2023', 13, 'May', 'May', 2023, '2024-07-03 08:45:05'),
(106, 'sirb06.pdf', 6, 'June-2023', 13, 'Jun', 'Jun', 2023, '2023-08-01 09:27:00'),
(107, 'sirb07.pdf', 7, 'July-2023', 13, 'Jul', 'Jul', 2023, '2023-08-11 04:36:00'),
(108, 'sirb08.pdf', 8, 'August-2023', 13, 'Aug', 'Aug', 2023, '2023-09-12 10:31:00'),
(109, 'sirb09.pdf', 9, 'Septembert-2023', 13, 'Sep', 'Sep', 2023, '2023-10-10 10:08:00'),
(110, 'sirb10.pdf', 10, 'October-2023', 13, 'Oct', 'Oct', 2023, '2023-11-09 10:08:00'),
(111, 'sirb11.pdf', 11, 'Nov-2023', 13, 'Nov', 'Nov', 2023, '2024-07-03 10:35:01'),
(112, 'sirb12.pdf', 12, 'December-2023', 13, 'Dec', 'Dec', 2023, '2024-01-16 06:08:00'),
(161, 'sirb02.pdf', 2, 'Feb-2010', 1, 'Feb', 'Feb', 2010, '2024-07-04 17:08:28'),
(114, 'sirb02.pdf', 2, 'February-2024', 14, 'Feb', 'Feb', 2024, '2024-04-17 18:30:00'),
(115, 'sirb03.pdf', 3, 'March-2024', 14, 'Mar', 'Mar', 2024, '2024-05-01 04:42:17'),
(116, 'sirb04.pdf', 4, 'April-2024', 14, 'Apr', 'Apr', 2024, '2024-05-17 11:00:17'),
(113, 'sirb01.pdf', 1, 'Jan-2024', 14, 'Jan', 'Jan', 2024, '2024-07-03 12:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_log`
--

CREATE TABLE `transaction_log` (
  `id` int(11) NOT NULL,
  `action` varchar(50) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_log`
--

INSERT INTO `transaction_log` (`id`, `action`, `user`, `timestamp`, `description`) VALUES
(1, 'Add', 'Aditi', '2024-07-04 16:55:14', 'Added file with issue: 02, volume: 1, year: 2010'),
(2, 'Delete', 'Aditi', '2024-07-04 16:59:59', 'Deleted file with ID: 163, year: 2010, URL: sirb02.pdf'),
(3, 'Update', 'Aditi', '2024-07-04 17:08:28', 'Updated file with ID: 161, new month: Feb, new year: 2010, new volume: 1, new issue: 02, new file name: sirb02.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `added` datetime NOT NULL DEFAULT current_timestamp(),
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `active`, `added`, `role`) VALUES
(9, 'Aditi', 'aditi@gmail.com', '436242e0c0af36e461a395c937165372864a99f9', 1, '2024-06-20 10:59:24', 'admin'),
(10, 'stockholm', 'sh@gmail.com', 'd8f4590320e1343a915b6394170650a8f35d6926', 1, '2024-06-25 11:34:00', 'user'),
(11, 'prathamesh', 'pav2024@gmail.com', 'd818ad4c5a578563a610697cfcf914fb185824b4', 1, '2024-07-01 15:26:47', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sirb`
--
ALTER TABLE `sirb`
  ADD PRIMARY KEY (`sirb_id`);

--
-- Indexes for table `transaction_log`
--
ALTER TABLE `transaction_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sirb`
--
ALTER TABLE `sirb`
  MODIFY `sirb_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `transaction_log`
--
ALTER TABLE `transaction_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
