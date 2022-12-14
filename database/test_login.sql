-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2022 at 01:41 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `rememberme`
--

CREATE TABLE `rememberme` (
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rememberme`
--

INSERT INTO `rememberme` (`user_id`, `token`, `username`, `email`) VALUES
(1, '6b588254c7416a99a9c06557b8001815', 'test', 'aaa1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `username`, `email`, `phone`, `password`, `birthdate`, `gender`, `image`, `date_added`) VALUES
(1, 'ahmed', 'nasr', 'test', 'aaa1@gmail.com', '477777', '$2y$10$EjjzxmmQha4XFEMB0HjWB.ySyQjop.JOk/DXRfC8CSZngxxtqdxg2', '2000-05-02', 'male', 'img-639905795c13b.jpg', '2022-12-13 22:32:07'),
(2, 'ahmed', 'nasr', 'test1', 'aaa@gmail.com', '477777', '$2y$10$6OXYN/9NLMnpX4qUuFRmEuMq/ssiZ7MRJ1.N2mXlrZCiQAVgoHfru', '2000-02-01', 'male', 'img-6398e1d5bd118.jpg', '2022-12-13 22:34:29'),
(3, 'mohamed', 'nasr', 'andro', 'aaa2@gmail.com', '0158888', '$2y$10$kAjXmOVr.E4iQXb.gd1Il.vv1sDwURhs1WRMAQa4S/5TNKA0QSQ7S', '2000-03-03', 'male', 'img-63991b20d2f2c.jpg', '2022-12-14 02:38:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rememberme`
--
ALTER TABLE `rememberme`
  ADD KEY `username` (`username`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rememberme`
--
ALTER TABLE `rememberme`
  ADD CONSTRAINT `email` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `delete_user_token_63991b88bf120_test` ON SCHEDULE AT '2022-12-16 02:40:40' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM `rememberme` WHERE `token` = '6b588254c7416a99a9c06557b8001815'$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
