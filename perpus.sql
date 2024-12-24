-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2024 at 08:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `nik` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama`, `alamat`, `nik`) VALUES
(40, 'Ronaldo 9', 'madina', '2032390203'),
(44, 'Fani Nurul Salma', 'Italy', '20323902030'),
(45, 'usup', 'Italy', '234444');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `nama_buku` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `kategori_buku` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `nama_buku`, `pengarang`, `penerbit`, `tahun_terbit`, `kategori_buku`) VALUES
(56, 'PHP Studi Kasus', 'Bpk. Thoriq Nasution Al mandili', 'argentina', '2023', 'Informatika'),
(57, 'Belajar Wordpress', 'neymar', 'argentina', '2023', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `denda`
--

CREATE TABLE `denda` (
  `id_denda` int(11) NOT NULL,
  `id_peminjam` int(11) DEFAULT NULL,
  `denda` int(11) DEFAULT NULL,
  `waktu_pengembalian` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `denda`
--

INSERT INTO `denda` (`id_denda`, `id_peminjam`, `denda`, `waktu_pengembalian`) VALUES
(70, 83, 600000, '2024-08-26 00:00:00'),
(71, 84, 15000, '2024-12-21 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`id_kategori`, `nama_kategori`) VALUES
(35, 'Informatika'),
(36, 'Sains'),
(37, 'Biologi');

-- --------------------------------------------------------

--
-- Table structure for table `peminjam`
--

CREATE TABLE `peminjam` (
  `id_peminjam` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `status` enum('belum kembali','sudah kembali') NOT NULL DEFAULT 'belum kembali'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjam`
--

INSERT INTO `peminjam` (`id_peminjam`, `id_anggota`, `id_buku`, `status`) VALUES
(83, 44, 56, 'belum kembali'),
(84, 44, 57, 'belum kembali');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan_denda`
--

CREATE TABLE `pengaturan_denda` (
  `id_pengaturan_denda` int(11) NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaturan_denda`
--

INSERT INTO `pengaturan_denda` (`id_pengaturan_denda`, `denda`) VALUES
(2, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id_request` int(11) NOT NULL,
  `request` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id_request`, `request`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `verification_code` varchar(50) NOT NULL,
  `is_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `username`, `verification_code`, `is_verified`) VALUES
(10, 'thoriq', '$2y$10$N5KUXaZEkKLI4/NqNDc8DOA0amcsyftQ3yorDuDD1GThOLXfOG/D.', 'thoriq', 'e076c040d7491580a58d22828562c80c', 1),
(11, 'admin', '$2y$10$wDZzc96zQtJKHG24.rpa1etq9bF1OndABqgGipm4Tnkf98D0zW43q', 'admin', 'c328657195744daa4d103a54dd962e0f', 1),
(12, 'pertama', '$2y$10$6POh8YYlnPiPIoUs6S3xp.YOluAJ0tmy3hsmdW1qMK2J6wTQmfSO.', 'pertama', 'd2451a28b07290870039ee3850020b48', 0),
(13, 'helo@yopmail.com', '$2y$10$KF5FJ7Cszrg2Adw2z.6kWOHiQcg0PkRMCRID5UQzAnrNwxI7rXKJW', '&id=1', '36ff1ddad4f992a56b03afacaacdac81', 0),
(14, 'Test', '$2y$10$PJxCR1oDvUQs1sUumtvWvu4WlRI0eASBJkWgTvw7FTSLOSARicSma', 'Test', '9a85d03c26622d8efad25b16963c8bab', 1),
(15, 'user', '$2y$10$Hms7SxnLPuRz9jjlJi9MBuMHqW39.OUlasiZ1iaiibzWHGQTyN5DW', 'user', 'd2129aa821d3147a6b5fc2e317ea6569', 1),
(16, 'tbm.almuhtaj@gmail.com', '$2y$10$alqVsFiJGG5wKJf/vDgT8O0DzfFsf62x.uZ60Z.wJk6.MdgB26izC', 'tbmalmuhtaj', 'c71550d6208b0e75a99c03a219cdd369', 1),
(17, 'tbm.almuhtaj@gmail.com', '$2y$10$.L/VD/Q2fF1a2kohGqrmWO9TbeisnzgD.3CAPQEUO3taldQkaUf8e', 'tbmalmuhtaj', 'cdfd2f70aaa875309bb48fe6a5fed455', 1),
(18, 'admin', '$2y$10$.1YjuJOIEbqJikOCx5dDdeazBBqzq1adeKZT9tM1GdRMT2aXbRhd.', 'tbmalmuhtaj', '7127512b814d4deae8b522bc868b9c10', 1),
(19, 'abdulganicintaalam@google.com', '$2y$10$j0mx7PMmpvOCQU8MsNB/4uKA8HtWFM76nLTa3oG.UhdSUwt/ieyT6', 'abdulgani ', '61ab0cda1101874e1351dfe338b34a85', 1),
(20, 'Sa', '$2y$10$PgvQo/Leg54syTnuZOhyG.pRib/nFPm16XWDxHt3IQA5/qNDxPnda', 'As', '2e7c13e0b3fe39df9545575702dc1ec9', 1),
(21, 'Jjdr', '$2y$10$tOF4nGUgo4Tr8bXywHmaz.mbJQ7TqoYNwY6nj4SzY.OSqTnuPUmh2', 'jidar', '0474121362e41dba3ffdce2784a00d69', 1),
(22, 'sandisafitri505@gmail.com', '$2y$10$xv01v9EgCtSrxqjhIRpDfeKlXqLSta29eBOHYf8K.Iz7UvvqWWoq2', 'sandy', '513e97319bd2154a6be5178d18c0f341', 0),
(23, 'sandisafitri505@gmail.com', '$2y$10$PkYCLA.XTNiB7eaF7Pjy4.JxeCMnL8plYJ12RKWGtO/oaY4ysOQJm', 'sandy', '7e97d747cc0955e87175ee6524061888', 0),
(24, 'sandisafitri505@gmail.com', '$2y$10$5jGUKhZP77f2moIFRUeTUe0GTYsSVibCLA/aEGTKGp2AwGW.5E556', 'sandy', '5c0d07dd315e2a13c09127403247d5f7', 0),
(25, 'sandisafitri505@gmail.com', '$2y$10$t/1lFcpqdzajUAlhiupgo.gO3h/.sDMr2ocqylJ4O70ki1OkJO8e2', 'Muhamad Sandy Safitri', 'f918722ed2d005dc052cad9732fb0482', 0),
(26, 'ha@gmail.com', '$2y$10$C/BMozNuYsS6CuajoP.MRuVzzgEP77O2BOEO91CK.i/JXhtrahOJO', 'ha', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_denda`),
  ADD KEY `id_peminjam` (`id_peminjam`);

--
-- Indexes for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `peminjam`
--
ALTER TABLE `peminjam`
  ADD PRIMARY KEY (`id_peminjam`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `pengaturan_denda`
--
ALTER TABLE `pengaturan_denda`
  ADD PRIMARY KEY (`id_pengaturan_denda`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id_request`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sessions_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `denda`
--
ALTER TABLE `denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `peminjam`
--
ALTER TABLE `peminjam`
  MODIFY `id_peminjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `pengaturan_denda`
--
ALTER TABLE `pengaturan_denda`
  MODIFY `id_pengaturan_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `denda`
--
ALTER TABLE `denda`
  ADD CONSTRAINT `denda_ibfk_1` FOREIGN KEY (`id_peminjam`) REFERENCES `peminjam` (`id_peminjam`);

--
-- Constraints for table `peminjam`
--
ALTER TABLE `peminjam`
  ADD CONSTRAINT `peminjam_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `peminjam_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
