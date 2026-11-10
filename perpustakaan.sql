-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 07, 2026 at 11:44 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `title` varchar(200) NOT NULL,
  `author` varchar(150) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `year` year DEFAULT NULL,
  `stock` int DEFAULT '1',
  `cover` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `category`, `year`, `stock`, `cover`, `created_at`) VALUES
(1, 'Laskar Pelangi', 'Andrea Hirata', 'Novel', '2005', 3, NULL, '2026-09-05 20:18:06'),
(2, 'Bumi Manusia', 'Pramoedya Ananta', 'Novel', '1980', 2, NULL, '2026-09-05 20:18:06'),
(3, 'Atomic Habits', 'James Clear', 'Non-fiksi', '2018', 4, NULL, '2026-09-05 20:18:06'),
(4, 'Clean Code', 'Robert C. Martin', 'Teknologi', '2008', 2, NULL, '2026-09-05 20:18:06'),
(5, 'Sapiens', 'Yuval Noah Harari', 'Non-fiksi', '2011', 3, NULL, '2026-09-05 20:18:06'),
(6, 'Negeri 5 Menara', 'A. Fuadi', 'Novel', '2009', 5, NULL, '2026-09-05 20:18:06'),
(7, 'Ronggeng Dukuh Paruk', 'Ahmad Tohari', 'Novel', '1982', 3, NULL, '2026-09-05 20:18:06'),
(8, 'Pulang', 'Leila S. Chudori', 'Novel', '2012', 4, NULL, '2026-09-05 20:18:06'),
(9, 'Cantik itu Luka', 'Eka Kurniawan', 'Novel', '2002', 2, NULL, '2026-09-05 20:18:06'),
(10, 'Filosofi Teras', 'Henry Manampiring', 'Filsafat', '2018', 8, NULL, '2026-09-05 20:18:06'),
(11, 'Sebuah Seni untuk Bersikap Bodo Amat', 'Mark Manson', 'Non-fiksi', '2016', 6, NULL, '2026-09-05 20:18:06'),
(12, 'Guns, Germs, and Steel', 'Jared Diamond', 'Sejarah', '1997', 3, NULL, '2026-09-05 20:18:06'),
(13, 'Bicara Itu Ada Seninya', 'Oh Su Hyang', 'Non-fiksi', '2018', 10, NULL, '2026-09-05 20:18:06'),
(14, 'Dunia Sophie', 'Jostein Gaarder', 'Filsafat', '1991', 4, NULL, '2026-09-05 20:18:06'),
(15, 'Zero to One', 'Peter Thiel', 'Bisnis', '2014', 5, NULL, '2026-09-05 20:18:06'),
(16, 'The Lean Startup', 'Eric Ries', 'Bisnis', '2011', 4, NULL, '2026-09-05 20:18:06'),
(17, 'Good to Great', 'Jim Collins', 'Bisnis', '2001', 3, NULL, '2026-09-05 20:18:06'),
(18, 'Rich Dad Poor Dad', 'Robert T. Kiyosaki', 'Bisnis', '1997', 7, NULL, '2026-09-05 20:18:06'),
(19, 'The Intelligent Investor', 'Benjamin Graham', 'Bisnis', '1949', 2, NULL, '2026-09-05 20:18:06'),
(20, 'Introduction to Algorithms', 'Thomas H. Cormen', 'Teknologi', '2009', 3, NULL, '2026-09-05 20:18:06'),
(21, 'Design Patterns', 'Erich Gamma', 'Teknologi', '1994', 2, NULL, '2026-09-05 20:18:06'),
(22, 'Clean Agile', 'Robert C. Martin', 'Teknologi', '2019', 4, NULL, '2026-09-05 20:18:06'),
(23, 'You Don\'t Know JS', 'Kyle Simpson', 'Teknologi', '2014', 6, NULL, '2026-09-05 20:18:06'),
(24, 'Refactoring', 'Martin Fowler', 'Teknologi', '1999', 3, NULL, '2026-09-05 20:18:06'),
(25, 'Brief Answers to the Big Questions', 'Stephen Hawking', 'Sains', '2018', 5, NULL, '2026-09-05 20:18:06'),
(26, 'The Selfish Gene', 'Richard Dawkins', 'Sains', '1976', 4, NULL, '2026-09-05 20:18:06'),
(27, 'Cosmos', 'Carl Sagan', 'Sains', '1980', 3, NULL, '2026-09-05 20:18:06'),
(28, 'Astrophysics for People in a Hurry', 'Neil deGrasse Tyson', 'Sains', '2017', 6, NULL, '2026-09-05 20:18:06'),
(29, 'A Brief History of Time', 'Stephen Hawking', 'Sains', '1988', 5, NULL, '2026-09-05 20:18:06'),
(30, 'Madilog', 'Tan Malaka', 'Filsafat', '1943', 3, NULL, '2026-09-05 20:18:06'),
(31, 'Bumi yang Terluka', 'Emil Salim', 'Non-fiksi', '1986', 2, NULL, '2026-09-05 20:18:06'),
(32, 'Sejarah Dunia yang Disembunyikan', 'Jonathan Black', 'Sejarah', '2007', 5, NULL, '2026-09-05 20:18:06'),
(33, 'Revolusi Prancis', 'Jean-Paul Sartre', 'Sejarah', '1960', 1, NULL, '2026-09-05 20:18:06'),
(34, 'Max Havelaar', 'Multatuli', 'Novel', '1960', 4, NULL, '2026-09-05 20:18:06'),
(35, 'Gadis Pantai', 'Pramoedya Ananta Toer', 'Novel', '1987', 3, NULL, '2026-09-05 20:18:06'),
(36, 'Hujan', 'Tere Liye', 'Novel', '2016', 9, NULL, '2026-09-05 20:18:06'),
(37, 'Pulang-Pergi', 'Tere Liye', 'Novel', '2021', 6, NULL, '2026-09-05 20:18:06'),
(38, 'Dilan 1990', 'Pidi Baiq', 'Novel', '2014', 8, NULL, '2026-09-05 20:18:06'),
(39, 'The Hobbit', 'J.R.R. Tolkien', 'Novel', '1937', 4, NULL, '2026-09-05 20:18:06'),
(40, '1984', 'George Orwell', 'Novel', '1949', 7, NULL, '2026-09-05 20:18:06'),
(41, 'Laskar Pelangi', 'Elbas', 'Novel', '2026', 5, 'coversbook_1788820375.jpg', '2026-09-07 22:35:58');

-- --------------------------------------------------------

--
-- Table structure for table `borrowings`
--

CREATE TABLE `borrowings` (
  `id` int NOT NULL,
  `book_id` int DEFAULT NULL,
  `borrower_name` varchar(150) NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan') DEFAULT 'dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'Elbas', '$2y$10$euJNvfwlRI7JLu5n9uINGuKfaEXtfzI.ZjpJ6hd36IZ4Pn7iUBo/G');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD CONSTRAINT `borrowings_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
