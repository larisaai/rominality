-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2019 at 04:00 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `searchBar` (IN `search_term` CHAR(255))  BEGIN
SELECT * FROM songs WHERE song_title LIKE CONCAT( search_term, '%') ORDER BY song_title DESC;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_body` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `song_id`, `user_id`, `comment_body`, `updated_at`, `created_at`) VALUES
(14, 53, 33, 'Hey! I really like this song!!!', '2019-12-15 12:27:57', '2019-12-15 12:27:57'),
(15, 52, 35, 'I really like your song', '2019-12-15 14:51:02', '2019-12-15 14:51:02'),
(16, 51, 33, 'You really do a good job', '2019-12-15 14:52:04', '2019-12-15 14:52:04'),
(17, 41, 33, 'Thank you all for the support!', '2019-12-15 14:54:23', '2019-12-15 14:54:23');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `currency name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency name`) VALUES
(1, 'Euro');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `items` smallint(11) NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `currency` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `buyer_id`, `items`, `total`, `currency`, `created_at`, `update_at`) VALUES
(28, 35, 3, 23, 1, '2019-12-15 14:35:34', '2019-12-15 14:35:34'),
(29, 33, 4, 36, 1, '2019-12-15 14:55:05', '2019-12-15 14:55:05');

-- --------------------------------------------------------

--
-- Table structure for table `invoices_relationship`
--

CREATE TABLE `invoices_relationship` (
  `invoice_id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoices_relationship`
--

INSERT INTO `invoices_relationship` (`invoice_id`, `song_id`) VALUES
(28, 52),
(28, 51),
(28, 45),
(29, 47),
(29, 48),
(29, 52),
(29, 53);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `song_title` varchar(255) NOT NULL,
  `artist_name` varchar(255) NOT NULL,
  `price` smallint(11) NOT NULL,
  `currency` int(11) NOT NULL,
  `path_id` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `user_id`, `song_title`, `artist_name`, `price`, `currency`, `path_id`, `is_deleted`, `updated_at`, `created_at`) VALUES
(41, 33, 'Monkey man', 'Eat static', 12, 1, '5df56583497ce', 0, '2019-12-14 22:43:15', '2019-12-14 22:43:15'),
(42, 33, 'Visual spectrum', 'Jay Tripwire', 6, 1, '5df565cfcf667', 0, '2019-12-14 22:44:31', '2019-12-14 22:44:31'),
(43, 33, 'Wanna go bang', 'Geeeman', 8, 1, '5df56679a254b', 0, '2019-12-14 22:47:21', '2019-12-14 22:47:21'),
(44, 34, 'Las Ramblas part. 2', 'Soul Capsule Productions', 11, 1, '5df566e701ba2', 0, '2019-12-14 22:49:11', '2019-12-14 22:49:11'),
(45, 34, 'Yweru', 'Alex Celler', 9, 1, '5df5673be9ec1', 0, '2019-12-14 22:50:35', '2019-12-14 22:50:35'),
(46, 34, 'Believe in yourself', 'D Base', 7, 1, '5df56794b7486', 0, '2019-12-14 22:52:04', '2019-12-14 22:52:04'),
(47, 35, 'Subtle universe', 'Le Loup', 8, 1, '5df567e802d0d', 0, '2019-12-14 22:54:02', '2019-12-14 22:53:28'),
(48, 35, 'Radio Morocco', 'Pulse 8', 12, 1, '5df56864d349c', 0, '2019-12-14 22:55:32', '2019-12-14 22:55:32'),
(49, 35, 'Bicycle Thieves', 'Slap', 10, 1, '5df568b8ea2b6', 0, '2019-12-14 22:56:56', '2019-12-14 22:56:56'),
(50, 36, 'Ninatron', 'Cedric Dekowski', 9, 1, '5df5693e1ee84', 0, '2019-12-14 22:59:10', '2019-12-14 22:59:10'),
(51, 36, 'Klaus Grony', 'Franky greiner', 6, 1, '5df5699cdb9a8', 0, '2019-12-14 23:00:44', '2019-12-14 23:00:44'),
(52, 37, 'Junq', 'Closer', 8, 1, '5df56a6dba286', 0, '2019-12-14 23:04:13', '2019-12-14 23:04:13'),
(53, 37, 'Love Craft', 'Zzonked', 8, 1, '5df56ac3ded24', 0, '2019-12-14 23:05:39', '2019-12-14 23:05:39');

-- --------------------------------------------------------

--
-- Table structure for table `song_attributes`
--

CREATE TABLE `song_attributes` (
  `id` tinyint(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `song_attributes`
--

INSERT INTO `song_attributes` (`id`, `attribute_name`) VALUES
(1, 'groovy'),
(2, 'tech-house'),
(3, 'detroit'),
(4, 'minimal'),
(5, 'techno'),
(6, 'deep'),
(7, 'dub'),
(8, 'acid'),
(9, 'dark'),
(10, 'electro'),
(11, 'jazzy'),
(12, 'chicago');

-- --------------------------------------------------------

--
-- Table structure for table `song_attributes_relationship`
--

CREATE TABLE `song_attributes_relationship` (
  `song_id` int(11) NOT NULL,
  `attribute_id` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `song_attributes_relationship`
--

INSERT INTO `song_attributes_relationship` (`song_id`, `attribute_id`) VALUES
(41, 5),
(41, 2),
(41, 1),
(42, 4),
(42, 7),
(42, 6),
(43, 5),
(43, 2),
(43, 4),
(43, 10),
(43, 7),
(43, 6),
(43, 12),
(44, 5),
(44, 2),
(44, 11),
(44, 1),
(44, 10),
(44, 7),
(44, 9),
(44, 8),
(45, 4),
(45, 11),
(45, 1),
(45, 10),
(45, 7),
(46, 4),
(46, 11),
(46, 1),
(46, 10),
(47, 2),
(47, 4),
(47, 3),
(48, 5),
(48, 2),
(48, 1),
(48, 12),
(49, 11),
(49, 1),
(49, 3),
(49, 6),
(50, 11),
(50, 10),
(50, 3),
(50, 6),
(51, 2),
(51, 4),
(51, 11),
(52, 7),
(52, 6),
(52, 9),
(53, 10),
(53, 7),
(53, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) CHARACTER SET armscii8 NOT NULL,
  `lastname` varchar(255) CHARACTER SET armscii8 NOT NULL,
  `user_type` tinyint(11) NOT NULL,
  `email` varchar(255) CHARACTER SET armscii8 NOT NULL,
  `password` varchar(255) CHARACTER SET armscii8 NOT NULL,
  `profile_picture` varchar(255) CHARACTER SET armscii8 DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `user_type`, `email`, `password`, `profile_picture`, `is_active`, `create_at`, `updated_at`) VALUES
(27, 'Cassandra', 'Tiltack', 1, 'cassandra@me.com', 'password', '/images/default.png', 1, '2019-12-12 14:23:15', '2019-12-15 13:47:44'),
(28, 'Razvan', 'Bertea', 1, 'bertea74@gmail.com', 'password', '/images/default.png', 1, '2019-12-12 14:23:38', '2019-12-15 13:47:53'),
(29, 'Andrei', 'Atudorei', 1, 'stefandrei123@gmail.com', 'password', '/images/default.png', 1, '2019-12-12 14:24:07', '2019-12-15 13:48:00'),
(30, 'Larisa', 'Ailisoaie', 1, 'larisa@gmail.com', 'password', '/images/default.png', 1, '2019-12-12 14:24:59', '2019-12-15 13:48:06'),
(32, 'Teacher', 'Kea', 1, 'teacher@kea.com', 'password', '/images/default.png', 1, '2019-12-12 14:26:19', '2019-12-15 13:48:20'),
(33, 'Alin', 'Chiosa', 2, 'alin@gmail.com', 'password', '/images/5df63708031aa.jpg', 1, '2019-12-12 14:26:46', '2019-12-15 13:37:12'),
(34, 'Petru', 'Birzu', 2, 'petru@gmail.com', 'password', '/images/5df63b17a0f78.jpg', 1, '2019-12-12 14:27:06', '2019-12-15 13:54:31'),
(35, 'Tavi', 'Ciorobatca', 2, 'tavi@gmail.com', 'password', '/images/5df63b5e0ce31.jpg', 1, '2019-12-12 14:28:18', '2019-12-15 13:55:42'),
(36, 'Alexandru', 'Dediu', 2, 'alex@gmail.com', 'password', '/images/5df63aca0637d.jpg', 1, '2019-12-12 14:29:04', '2019-12-15 13:53:14'),
(37, 'Alexandru', 'Lentza', 2, 'lentza@gmail.com', 'password', '/images/5df63a8bcc3ab.jpg', 1, '2019-12-12 14:30:03', '2019-12-15 13:52:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` tinyint(11) NOT NULL,
  `user_types` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `user_types`) VALUES
(1, 'normal user'),
(2, 'producer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `song_id` (`song_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyer_id` (`buyer_id`);

--
-- Indexes for table `invoices_relationship`
--
ALTER TABLE `invoices_relationship`
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `currency` (`currency`);

--
-- Indexes for table `song_attributes`
--
ALTER TABLE `song_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `song_attributes_relationship`
--
ALTER TABLE `song_attributes_relationship`
  ADD KEY `attribute_id` (`attribute_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_type` (`user_type`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `song_attributes`
--
ALTER TABLE `song_attributes`
  MODIFY `id` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoices_relationship`
--
ALTER TABLE `invoices_relationship`
  ADD CONSTRAINT `invoices_relationship_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `invoices_relationship_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`);

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `songs_ibfk_2` FOREIGN KEY (`currency`) REFERENCES `currencies` (`id`);

--
-- Constraints for table `song_attributes_relationship`
--
ALTER TABLE `song_attributes_relationship`
  ADD CONSTRAINT `song_attributes_relationship_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `song_attributes_relationship_ibfk_3` FOREIGN KEY (`attribute_id`) REFERENCES `song_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



--
-- Users and privileges
--

# Privileges for `admin-rominimal`@`%`

GRANT ALL PRIVILEGES ON *.* TO 'admin'@'%' IDENTIFIED BY PASSWORD '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19' WITH GRANT OPTION;

GRANT ALL PRIVILEGES ON `rominimal`.* TO 'admin'@'%';


# Privileges for `read-only-rominimal`@`%`

GRANT SELECT ON *.* TO 'read-only'@'%' IDENTIFIED BY PASSWORD '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19';

GRANT SELECT ON `rominimal`.* TO 'read-only'@'%';

GRANT SELECT ON `rominimal`.* TO 'read-only'@'%';


# Privileges for `restricted-user-rominimal`@`%`

GRANT USAGE ON *.* TO 'restricted-user'@'%' IDENTIFIED BY PASSWORD '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19';

GRANT SELECT ON `rominimal`.`song_attributes` TO 'restricted-user'@'%';

GRANT SELECT ON `rominimal`.`comments` TO 'restricted-user'@'%';

GRANT SELECT ON `rominimal`.`invoices` TO 'restricted-user'@'%';

GRANT SELECT ON `rominimal`.`song_attributes_relationship` TO 'restricted-user'@'%';

GRANT SELECT ON `rominimal`.`user_types` TO 'restricted-user'@'%';

GRANT SELECT (updated_at, create_at, id, firstname, user_type, email, lastname, is_active, profile_picture) ON `rominimal`.`users` TO 'restricted-user'@'%';

GRANT SELECT ON `rominimal`.`invoices_relationship` TO 'restricted-user'@'%';



COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
