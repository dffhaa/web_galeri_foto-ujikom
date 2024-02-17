-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2024 at 04:35 PM
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
-- Database: `galery`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_album`
--

CREATE TABLE `tb_album` (
  `album_id` int(11) NOT NULL,
  `nama_album` varchar(255) NOT NULL,
  `deskripsi_album` text NOT NULL,
  `tanggal_dibuat` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_album`
--

INSERT INTO `tb_album` (`album_id`, `nama_album`, `deskripsi_album`, `tanggal_dibuat`, `user_id`) VALUES
(1, 'wibu12', 'foto wibu cosplayer event', '2024-01-27', 1),
(2, 'Komuk', 'Komuk random', '2024-02-16', 2),
(3, 'JKT48', 'Member jkt48', '2024-02-16', 1),
(4, 'Genshin', 'Archon Genshin', '2024-02-23', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_foto`
--

CREATE TABLE `tb_foto` (
  `foto_id` int(11) NOT NULL,
  `judul_foto` varchar(255) NOT NULL,
  `deskripsi_foto` text NOT NULL,
  `tanggal_unggah` date NOT NULL,
  `lokasi_file` varchar(255) NOT NULL,
  `album_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_foto`
--

INSERT INTO `tb_foto` (`foto_id`, `judul_foto`, `deskripsi_foto`, `tanggal_unggah`, `lokasi_file`, `album_id`, `user_id`) VALUES
(1, 'profil wibu', 'ferwdfefef', '2024-01-30', '2.jpg', 1, 1),
(2, 'monyet', 'monyet nya mirip bagas', '2024-01-31', '3.jpg', 1, 1),
(3, 'ancika', 'member gen 7', '2024-02-03', '11.jpg', 3, 1),
(4, 'michie', 'member gen 11', '2024-02-16', '12.jpg', 3, 1),
(6, 'christy', 'member gen 7', '2024-02-16', '14.jpg', 3, 2),
(7, 'Zhongli', 'Abah encok', '2024-02-16', '10.jpg', 4, 2),
(8, 'Raiden', 'mommy ei', '2024-02-16', '8.jpg', 4, 2),
(9, 'venti', 'G tau cowok atau cewek', '2024-02-16', '9.jpg', 4, 2),
(10, 'Nahida', 'loli dendro', '2024-02-16', '7.jpg', 4, 1),
(11, 'adel', 'member gen 8', '2024-02-16', '13.jpg', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_komentarfoto`
--

CREATE TABLE `tb_komentarfoto` (
  `komentar_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_komentarfoto`
--

INSERT INTO `tb_komentarfoto` (`komentar_id`, `foto_id`, `user_id`, `isi_komentar`, `tanggal_komentar`) VALUES
(24, 1, 2, 'hahahah', '2024-02-16'),
(25, 1, 1, 'hahahah', '2024-02-16'),
(26, 1, 1, 'fefe', '2024-02-16'),
(27, 2, 1, 'keren cok', '2024-02-16'),
(28, 3, 2, 'cantik', '2024-02-16'),
(29, 7, 1, 'parah si', '2024-02-16'),
(30, 4, 1, 'dede', '2024-02-16'),
(31, 4, 2, 'hahahah', '2024-02-16');

-- --------------------------------------------------------

--
-- Table structure for table `tb_likefoto`
--

CREATE TABLE `tb_likefoto` (
  `like_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_like` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_likefoto`
--

INSERT INTO `tb_likefoto` (`like_id`, `foto_id`, `user_id`, `tanggal_like`) VALUES
(1, 2, 1, '2024-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `username`, `password`, `email`, `nama_lengkap`, `alamat`) VALUES
(1, 'dafha', '12345', 'affaiyahkids8@gmail.com', 'Muhammad Dafha', 'Villa Indah Permai'),
(2, 'radit', '12345', 'radit@gmail.com', 'Raditia Hafiz', 'babelan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_album`
--
ALTER TABLE `tb_album`
  ADD PRIMARY KEY (`album_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_foto`
--
ALTER TABLE `tb_foto`
  ADD PRIMARY KEY (`foto_id`),
  ADD KEY `album_id` (`album_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_komentarfoto`
--
ALTER TABLE `tb_komentarfoto`
  ADD PRIMARY KEY (`komentar_id`),
  ADD KEY `foto_id` (`foto_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_likefoto`
--
ALTER TABLE `tb_likefoto`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `foto_id` (`foto_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_foto`
--
ALTER TABLE `tb_foto`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_komentarfoto`
--
ALTER TABLE `tb_komentarfoto`
  MODIFY `komentar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_likefoto`
--
ALTER TABLE `tb_likefoto`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_album`
--
ALTER TABLE `tb_album`
  ADD CONSTRAINT `tb_album_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`user_id`);

--
-- Constraints for table `tb_foto`
--
ALTER TABLE `tb_foto`
  ADD CONSTRAINT `tb_foto_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `tb_album` (`album_id`),
  ADD CONSTRAINT `tb_foto_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`user_id`);

--
-- Constraints for table `tb_komentarfoto`
--
ALTER TABLE `tb_komentarfoto`
  ADD CONSTRAINT `tb_komentarfoto_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`user_id`),
  ADD CONSTRAINT `tb_komentarfoto_ibfk_2` FOREIGN KEY (`foto_id`) REFERENCES `tb_foto` (`foto_id`);

--
-- Constraints for table `tb_likefoto`
--
ALTER TABLE `tb_likefoto`
  ADD CONSTRAINT `tb_likefoto_ibfk_1` FOREIGN KEY (`foto_id`) REFERENCES `tb_foto` (`foto_id`),
  ADD CONSTRAINT `tb_likefoto_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
