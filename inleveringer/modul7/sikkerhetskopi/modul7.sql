-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06. Nov, 2025 18:08 PM
-- Tjener-versjon: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `modul7`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `created_at`) VALUES
(1, 'Emma Hansen', 'emma.hansen@example.com', 'hash123emma', '2025-11-06 16:03:33'),
(2, 'Jonas Berg', 'jonas.berg@example.com', 'hash456jonas', '2025-11-06 16:03:33'),
(3, 'Lina Olsen', 'lina.olsen@example.com', 'hash789lina', '2025-11-06 16:03:33'),
(4, 'Marius Solheim', 'marius.solheim@example.com', 'hash321marius', '2025-11-06 16:03:33'),
(5, 'Sara Nilsen', 'sara.nilsen@example.com', 'hash654sara', '2025-11-06 16:03:33');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `users2`
--

CREATE TABLE `users2` (
  `fnavn` varchar(100) NOT NULL,
  `enavn` varchar(100) NOT NULL,
  `epost` varchar(255) NOT NULL,
  `tlf` varchar(20) NOT NULL,
  `fdato` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `users2`
--

INSERT INTO `users2` (`fnavn`, `enavn`, `epost`, `tlf`, `fdato`) VALUES
('oda', 'opheim', 'ola@nordmann.no', '47523578', '2003-01-01'),
('od1', 'opheim', 'olas@nordmann.no', '47523579', '2003-01-17'),
('simen', 'holmen', 'sim@uia.no', '47523576', '2003-01-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users2`
--
ALTER TABLE `users2`
  ADD UNIQUE KEY `epost` (`epost`),
  ADD UNIQUE KEY `tlf` (`tlf`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
