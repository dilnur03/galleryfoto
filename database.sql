-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2024 at 05:08 AM
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
(6, 'gunung', 'aaaaaaaaaaaaaaaaaa', 5, '2024-02-16 01:36:53'),
(18, 'random', 'random', 6, '2024-02-21 05:47:41'),
(19, 'panorama', 'panorama alam', 11, '2024-02-21 05:56:08'),
(21, 'gunung', 's', 4, '2024-02-26 05:14:17'),
(22, 'panorama', 'n', 9, '2024-02-28 12:50:10');

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
(91, 'test', 'gyy', '2024-03-01', 'bde28975c9daca8e611e5276f1412620.jpg', 0, 6, '2024-03-01 06:31:27'),
(92, 'halo', 'alam', '2024-03-01', '4f90c0bf652a6ec82eec8a6385a68a34.jpg', 0, 6, '2024-03-01 06:32:07'),
(93, 'test', 'yu', '2024-03-01', 'cd89b617dc03e76c3ce1b2d68ffbe896.jpg', 0, 6, '2024-03-01 06:32:52'),
(95, 'pemandangan', 'cantikkk', '2024-03-01', '01fa652f2779f406a787e9ad96ad9b2c.jpg', 0, 15, '2024-03-01 06:37:27'),
(96, 'Alam', 'Cantik sekaliii', '2024-03-01', '629ab79b2a852819233fb235435e0cbb.jpg', 0, 15, '2024-03-01 06:38:17'),
(97, 'laut6', 'laut pangandaran', '2024-03-01', 'fd05e968e961a926a7f8b914054552d0.jpg', 0, 15, '2024-03-01 06:39:31'),
(98, 'air', 'suci', '2024-03-01', 'bbe871aa81241edb7593227bc0e640f9.jpg', 0, 9, '2024-03-01 06:41:18'),
(99, 'senja', 'disore hari', '2024-03-01', 'f076c82a54f24ad6742a833ece90d99f.jpg', 0, 9, '2024-03-01 06:42:19'),
(100, 'foto', 'foto', '2024-03-01', 'fd05e968e961a926a7f8b914054552d0.jpg', 0, 6, '2024-03-01 07:31:49');

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
(14, 49, 11, 'bagus', '2024-02-19', '2024-02-19 02:31:23'),
(15, 66, 6, 'waduh', '2024-02-20', '2024-02-20 01:27:35'),
(16, 51, 6, 'stoberi yang segar', '2024-02-20', '2024-02-20 02:22:30'),
(17, 67, 4, 'pp', '2024-02-20', '2024-02-20 10:55:28'),
(19, 81, 4, 'u', '2024-02-24', '2024-02-24 09:04:11'),
(29, 85, 9, 'p', '2024-02-28', '2024-02-28 06:02:22'),
(30, 85, 9, 'i', '2024-02-28', '2024-02-28 06:02:30'),
(42, 81, 6, 'dfffgg', '2024-02-29', '2024-02-29 02:09:42'),
(45, 78, 9, '123', '2024-03-01', '2024-03-01 01:53:29'),
(46, 82, 9, 'p', '2024-03-01', '2024-03-01 06:23:46'),
(48, 98, 15, 'sangat tidak pantas', '2024-03-01', '2024-03-01 06:47:41'),
(49, 90, 15, 'jelek banget', '2024-03-01', '2024-03-01 07:33:29');

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
(194, 49, 11, '0000-00-00 00:00:00'),
(201, 49, 6, '0000-00-00 00:00:00'),
(202, 50, 6, '0000-00-00 00:00:00'),
(204, 66, 6, '0000-00-00 00:00:00'),
(213, 83, 6, '0000-00-00 00:00:00'),
(214, 83, 11, '0000-00-00 00:00:00'),
(215, 76, 11, '0000-00-00 00:00:00'),
(217, 72, 6, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `type` enum('foto','komentar','','') NOT NULL,
  `UserID` int(11) NOT NULL,
  `FotoID` int(11) NOT NULL,
  `reason` text NOT NULL,
  `reportedat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(4, 'admin', '$2y$10$ZP/iO5GWWVXF9RpMuQ0/x.5lduxjx7cY9d31/5ZTE4jANN4wCz2z.', 'll@gmail.com', 'test', 'Aula Fakultas Teknik Universitas Mayasari bakti kampus 2', 'admin', '2024-02-20 12:30:27'),
(6, 'dila1', '$2y$10$L5wmte26g6SUJvXJLr/8NuaMR2EH.eeM3YiEP5/nMRvSBFYp32q9i', 'dilanurhidayah209@gmail.com', 'dila Nurhidayah', 'Neglasari', 'user', '2024-02-08 03:02:07'),
(9, 'nur', '$2y$10$pzbcoXylH6vI1XiexYqeG.HsH8LgFq7nUW/BvUAeLyEM/y6idpeCi', 'dilanurhidayah209@gmail.com', 'nurhidayah', 'Banjar', 'user', '2024-02-14 04:54:29'),
(11, 'darsu', '$2y$10$mK.70EmXvTD4SlmvAdgYtuc7zv4yTXZ5wKosVnXtD8JLLEbNz4LZS', 'admin@admin.com', 'darsu', 'darsu', 'user', '2024-02-19 02:29:56'),
(12, 'ridwan', '$2y$10$MWBRIiN2n7l7SuygFa7iIOl5Y0zDEpyJcn9FsLFXWuVLbwgiFqLEG', 'kodarismaaris061@gmail.com', 'Ridwan', 'Banjar', 'user', '2024-02-19 02:42:10'),
(13, 'jirah', '$2y$10$sRbXqJMuoAYqc4nrE3k0nepT8B3mZcTCLb.RDNBBkNhvtIlzmoh02', 'jirah@gmail.com', 'nurssuik', 'Aula Fakultas Teknik Universitas Mayasari bakti kampus 2', 'user', '2024-02-20 01:13:19'),
(14, 'nu', '', 'di3l@gmail.com', 'nuni', 'Aula Fakultas Teknik Universitas Mayasari bakti kampus 2', 'user', '2024-02-20 01:45:04'),
(15, 'alfiyah', '$2y$10$2qE/oZ3gepK3QLzYRDjmA.ApUMucugJYVN6tXuLN.5gM5YJpDW4Aa', 'saifuddin@gmail.com', 'Azizah', 'Cikadu', 'user', '2024-03-01 06:34:56'),
(16, 'salsa', '$2y$10$6PAgsCxmIL.a79FUtSOiROYozgXGul488PVdiT1ZOCCyAkgsY8waO', 'salsa@gmail.com', 'Salsa Rizky', 'Neglasari', 'user', '2024-03-01 13:05:21');

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
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

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
  MODIFY `AlbumID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `FotoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  MODIFY `KomentarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `LikeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
