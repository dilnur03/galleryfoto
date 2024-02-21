-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 03:40 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `AlbumID` int(11) NOT NULL,
  `NamaAlbum` varchar(255) NOT NULL,
  `Deskripsi` text NOT NULL,
  `UserID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`AlbumID`, `NamaAlbum`, `Deskripsi`, `UserID`, `created_at`) VALUES
(1, 'Makanan', 'Favorit', 6, '2024-02-01 02:48:47'),
(4, 'frdd', 'wwwwwwww', 6, '2024-02-11 09:28:20'),
(6, 'gunung', 'aaaaaaaaaaaaaaaaaa', 5, '2024-02-16 01:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `FotoID` int(11) NOT NULL,
  `JudulFoto` varchar(255) NOT NULL,
  `DeskripsiFoto` text NOT NULL,
  `TanggalUnggah` date NOT NULL,
  `LokasiFile` varchar(255) NOT NULL,
  `AlbumID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`FotoID`, `JudulFoto`, `DeskripsiFoto`, `TanggalUnggah`, `LokasiFile`, `AlbumID`, `UserID`, `created_at`) VALUES
(2, 'halo', 'halo', '2024-01-20', '01gvm9yfm4x00399venaphhpen.jpg', 23, 6, '2024-02-07 04:03:33'),
(36, 'test', 'ddddddddd', '2024-02-14', '381297979.jpg', 1, 6, '2024-02-14 21:58:17'),
(38, 'halo', '5', '2024-02-16', '1ad3c21e-88fe-4008-b7bf-675ec52c7cff.jpg', 4, 6, '2024-02-16 01:58:11'),
(42, 'a', 'aaaaa', '2024-02-18', 'ec53a8cd-25f9-4766-87f5-51f74a07738a.jpg', 1, 6, '2024-02-18 07:05:39'),
(43, 'dds', 'ssssss', '2024-02-18', 'colorful-transparent-of-speech-label-png.webp', 1, 6, '2024-02-18 07:09:42'),
(49, 'halo', 'j', '2024-02-19', '1feee791-4031-4760-80a7-8bf56d9aa4dc.jpg', 4, 6, '2024-02-19 01:14:12'),
(50, 'buah coklat', 'jjj', '2024-02-19', 'ac721d74-4bdb-4015-a238-b5130eef28ec.jpg', 1, 6, '2024-02-19 02:05:10'),
(51, 'test', 'qqqqq', '2024-02-19', 'IMG_20231001_152648.jpg', 1, 6, '2024-02-19 02:06:14');

-- --------------------------------------------------------

--
-- Table structure for table `komentarfoto`
--

CREATE TABLE `komentarfoto` (
  `KomentarID` int(11) NOT NULL,
  `FotoID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `IsiKomentar` text NOT NULL,
  `TanggalKomentar` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentarfoto`
--

INSERT INTO `komentarfoto` (`KomentarID`, `FotoID`, `UserID`, `IsiKomentar`, `TanggalKomentar`, `created_at`) VALUES
(1, 23, 6, 'jokow turun tahta', '2024-02-12', '2024-02-12 06:34:45'),
(2, 23, 6, 'jirah', '2024-02-12', '2024-02-12 06:55:42'),
(3, 2, 9, 'p', '2024-02-14', '2024-02-14 12:36:53'),
(4, 2, 9, 'hhhh', '2024-02-14', '2024-02-14 12:39:34'),
(5, 2, 9, 'k', '2024-02-14', '2024-02-14 12:41:16'),
(6, 2, 9, 'k;', '2024-02-14', '2024-02-14 12:43:50'),
(7, 2, 9, 'dimana?', '2024-02-14', '2024-02-14 12:44:11'),
(8, 36, 4, '', '2024-02-15', '2024-02-15 01:28:00'),
(9, 36, 4, '', '2024-02-15', '2024-02-15 01:28:04'),
(10, 36, 4, 'kjgjkufa', '2024-02-15', '2024-02-15 01:28:45'),
(11, 36, 4, 'p', '2024-02-16', '2024-02-16 12:04:25'),
(12, 42, 6, 'p', '2024-02-19', '2024-02-19 01:10:51'),
(13, 49, 11, '', '2024-02-19', '2024-02-19 02:30:53'),
(14, 49, 11, 'bagus', '2024-02-19', '2024-02-19 02:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `likefoto`
--

CREATE TABLE `likefoto` (
  `LikeID` int(11) NOT NULL,
  `FotoID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likefoto`
--

INSERT INTO `likefoto` (`LikeID`, `FotoID`, `UserID`, `created_at`) VALUES
(38, 22, 6, '0000-00-00 00:00:00'),
(39, 22, 6, '0000-00-00 00:00:00'),
(40, 22, 6, '0000-00-00 00:00:00'),
(41, 22, 6, '0000-00-00 00:00:00'),
(42, 24, 6, '0000-00-00 00:00:00'),
(43, 24, 6, '0000-00-00 00:00:00'),
(44, 24, 6, '0000-00-00 00:00:00'),
(45, 24, 6, '0000-00-00 00:00:00'),
(46, 24, 6, '0000-00-00 00:00:00'),
(47, 24, 9, '0000-00-00 00:00:00'),
(48, 24, 9, '0000-00-00 00:00:00'),
(49, 24, 9, '0000-00-00 00:00:00'),
(50, 24, 9, '0000-00-00 00:00:00'),
(51, 24, 9, '0000-00-00 00:00:00'),
(77, 25, 9, '0000-00-00 00:00:00'),
(79, 23, 9, '0000-00-00 00:00:00'),
(80, 34, 6, '0000-00-00 00:00:00'),
(96, 34, 9, '0000-00-00 00:00:00'),
(97, 34, 9, '0000-00-00 00:00:00'),
(98, 34, 9, '0000-00-00 00:00:00'),
(104, 34, 9, '0000-00-00 00:00:00'),
(105, 34, 9, '0000-00-00 00:00:00'),
(106, 34, 9, '0000-00-00 00:00:00'),
(111, 34, 9, '0000-00-00 00:00:00'),
(112, 34, 9, '0000-00-00 00:00:00'),
(113, 34, 9, '0000-00-00 00:00:00'),
(114, 34, 9, '0000-00-00 00:00:00'),
(115, 34, 9, '0000-00-00 00:00:00'),
(116, 34, 9, '0000-00-00 00:00:00'),
(117, 34, 9, '0000-00-00 00:00:00'),
(118, 34, 9, '0000-00-00 00:00:00'),
(119, 34, 9, '0000-00-00 00:00:00'),
(120, 34, 9, '0000-00-00 00:00:00'),
(121, 34, 9, '0000-00-00 00:00:00'),
(124, 34, 9, '0000-00-00 00:00:00'),
(125, 34, 9, '0000-00-00 00:00:00'),
(126, 34, 9, '0000-00-00 00:00:00'),
(127, 34, 9, '0000-00-00 00:00:00'),
(128, 34, 9, '0000-00-00 00:00:00'),
(129, 34, 9, '0000-00-00 00:00:00'),
(130, 34, 9, '0000-00-00 00:00:00'),
(131, 34, 9, '0000-00-00 00:00:00'),
(132, 34, 9, '0000-00-00 00:00:00'),
(133, 34, 9, '0000-00-00 00:00:00'),
(134, 34, 9, '0000-00-00 00:00:00'),
(179, 2, 9, '0000-00-00 00:00:00'),
(181, 36, 9, '0000-00-00 00:00:00'),
(184, 2, 6, '0000-00-00 00:00:00'),
(187, 2, 4, '0000-00-00 00:00:00'),
(188, 37, 4, '0000-00-00 00:00:00'),
(190, 36, 4, '0000-00-00 00:00:00'),
(191, 36, 6, '0000-00-00 00:00:00'),
(194, 49, 11, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Nama_Lengkap` varchar(255) NOT NULL,
  `Alamat` text NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `username`, `password`, `Email`, `Nama_Lengkap`, `Alamat`, `role`, `created_at`) VALUES
(4, 'lol', '$2y$10$ZP/iO5GWWVXF9RpMuQ0/x.5lduxjx7cY9d31/5ZTE4jANN4wCz2z.', 'll@gmail.com', 'test', 'Aula Fakultas Teknik Universitas Mayasari bakti kampus 2', 'admin', '2024-01-30 07:56:49'),
(6, 'dila1', '$2y$10$L5wmte26g6SUJvXJLr/8NuaMR2EH.eeM3YiEP5/nMRvSBFYp32q9i', 'dilanurhidayah209@gmail.com', 'dila Nurhidayah', 'Neglasari', 'user', '2024-02-08 03:02:07'),
(9, 'nur', '$2y$10$pzbcoXylH6vI1XiexYqeG.HsH8LgFq7nUW/BvUAeLyEM/y6idpeCi', 'dilanurhidayah209@gmail.com', 'nurhidayah', 'Banjar', 'user', '2024-02-14 04:54:29'),
(10, 'test', '$2y$10$Yfrqv5P8FraFdqXKosmGx.FLp8nwBzeuIqY86rrobSeY.XsQTHhYi', 'admin@admin.com', 'qqqqs', 'sssss', 'user', '2024-02-19 02:15:52'),
(11, 'darsu', '$2y$10$mK.70EmXvTD4SlmvAdgYtuc7zv4yTXZ5wKosVnXtD8JLLEbNz4LZS', 'admin@admin.com', 'darsu', 'darsu', 'user', '2024-02-19 02:29:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`AlbumID`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`FotoID`);

--
-- Indexes for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD PRIMARY KEY (`KomentarID`);

--
-- Indexes for table `likefoto`
--
ALTER TABLE `likefoto`
  ADD PRIMARY KEY (`LikeID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `AlbumID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `FotoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  MODIFY `KomentarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `LikeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
