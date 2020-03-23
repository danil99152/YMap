-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 23, 2020 at 07:09 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysql`
--

-- --------------------------------------------------------

--
-- Table structure for table `hydrant`
--

CREATE TABLE `hydrant` (
  `id` int(10) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `lastCheck` varchar(255) NOT NULL,
  `power` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `notation` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hydrant`
--

INSERT INTO `hydrant` (`id`, `longitude`, `latitude`, `address`, `type`, `lastCheck`, `power`, `status`, `photo`, `notation`) VALUES
(0, '56.871331', '53.190844', 'ул. Пушкина, д. Колотушкина', 'Надземный', '01.02.2013', '300 л/мин', 'фун-т', 'hydrant.png', 'qwerty'),
(1, '56.865983', '53.238309', 'ул. Такая-то, д. Такой-то', 'подземный', 'вчера', 'мощная', 'не функ-т', 'hydrant.png', 'Может взорваться');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hydrant`
--
ALTER TABLE `hydrant`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hydrant`
--
ALTER TABLE `hydrant`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
