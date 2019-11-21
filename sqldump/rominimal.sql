-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2019 at 09:31 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rominimal`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUserByEmail` (IN `email` VARCHAR(50))  NO SQL
BEGIN select * from users where email = email;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `confim_password` varchar(12) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `last_name`, `email`, `password`, `confim_password`, `active`) VALUES
(1, 'aa', 'a', 'a@a.com', '123456', '123456', 1),
(2, 'aaaa', 'bbbb', 'a2@a.com', '123456', '123456', 0),
(5, 'aaaa', 'bbbb', 'ailisoaielarisa@yahoo.com', '123456', '0', 0),
(7, 'aa', 'bb', 'aaa@a.com', '123456', '123456', 1),
(9, 'aa', 'bb', 'baaaa@a.com', '123456', '123456', 1),
(10, 'aa', 'bb', 'adaadda@a.com', '123456', '123456', 1),
(11, 'aa', 'bb', 'a@a.com', '123456', '123456', 1),
(12, 'aa', 'bb', 'a@a.com', '123456', '123456', 1),
(13, 'aa', 'bb', 'a@a.com', '123456', '123456', 1),
(15, 'aa', 'bb', 'razvab@a.com', '123456', '123456', 1),
(16, 'aa', 'bb', 'razvab@a.com', '123456', '123456', 1),
(17, 'aa', 'bb', 'razvab@a.com', '123456', '123456', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
