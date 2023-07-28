-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2023 at 03:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spkbeasiswa2`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `nilai_ipk` varchar(75) NOT NULL,
  `absensi` varchar(75) NOT NULL,
  `keaktifan` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `id_mahasiswa`, `nilai_ipk`, `absensi`, `keaktifan`) VALUES
(148, 50, '3.66', '100', '5'),
(149, 51, '3.89', '96', '5'),
(150, 52, '3.82', '100', '5'),
(151, 53, '3.72', '100', '5'),
(152, 54, '3.12', '98', '5'),
(153, 55, '3.79', '96', '5'),
(154, 56, '3.5', '100', '5'),
(155, 57, '3.52', '94', '5'),
(156, 58, '3.74', '100', '5'),
(162, 62, '3.84', '96', '2'),
(163, 63, '3.31', '96', '0'),
(164, 64, '3.66', '98', '2'),
(165, 65, '4', '96', '2'),
(166, 66, '3.41', '98', '5'),
(167, 67, '3.06', '82', '2'),
(168, 68, '3.41', '94', '2'),
(169, 69, '3.31', '98', '2'),
(170, 70, '3.22', '98', '2'),
(171, 71, '3.47', '98', '2'),
(172, 72, '3', '98', '5'),
(173, 74, '3.5', '80', '2');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` char(5) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `type`) VALUES
(33, 'C1', 'NILAI IPK', 'Akademik'),
(34, 'C2', 'ABSENSI', 'Akademik'),
(35, 'C3', 'KEAKTIFAN', 'Sosial');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nim` varchar(75) NOT NULL,
  `nama_mahasiswa` varchar(75) NOT NULL,
  `prodi` char(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nim`, `nama_mahasiswa`, `prodi`, `created_at`, `updated_at`) VALUES
(50, '8803202101', 'Imam Muhyiddin', 'RKS 2021/2022', '2023-07-02 00:39:20', '2023-07-16 22:17:57'),
(51, '8803202102', 'At Tafani Fillah', 'RKS 2021/2022', '2023-07-02 00:39:43', '2023-07-16 22:18:02'),
(52, '8803202104', 'Firdaus Anesta Surya', 'RKS 2021/2022', '2023-07-02 00:40:06', '2023-07-16 22:18:06'),
(53, '8803202105', 'Aditya Eka Pratama', 'RKS 2021/2022', '2023-07-02 00:40:24', '2023-07-16 22:18:11'),
(54, '8803202106', 'Yudha Satria Abdi Susila', 'RKS 2021/2022', '2023-07-02 00:40:47', '2023-07-16 22:18:16'),
(55, '8803202107', 'Muhamad Eko Alfianto', 'RKS 2021/2022', '2023-07-02 00:41:07', '2023-07-16 22:18:20'),
(56, '8803202108', 'Clarissa Monique Maharani', 'RKS 2021/2022', '2023-07-02 00:41:32', '2023-07-16 22:18:26'),
(57, '8803202111', 'Faiz Nesa Aulia Noor', 'RKS 2021/2022', '2023-07-02 00:42:02', '2023-07-16 22:18:33'),
(58, '8803202112', 'Aji Nur Prasetyo', 'RKS 2021/2022', '2023-07-02 00:42:23', '2023-07-16 22:18:40'),
(62, '8803202201', 'Alfian Yuda Syahputra', 'RKS 2022/2023', '2023-07-24 23:02:00', '2023-07-24 23:02:00'),
(63, '8803202202', 'Asa Atina Zarra', 'RKS 2022/2023', '2023-07-24 23:05:26', '2023-07-24 23:05:26'),
(64, '8803202203', 'Arsyad Abdulghani Asrori', 'RKS 2022/2023', '2023-07-24 23:06:45', '2023-07-24 23:06:45'),
(65, '8803202204', 'Dionisius Lucky Noviantoro', 'RKS 2022/2023', '2023-07-24 23:08:16', '2023-07-24 23:08:16'),
(66, '8803202205', 'Jidar Titahjaya', 'RKS 2022/2023', '2023-07-24 23:09:12', '2023-07-24 23:09:12'),
(67, '8803202206', 'Kanca Dwi Sulistiyo', 'RKS 2022/2023', '2023-07-24 23:10:07', '2023-07-24 23:10:07'),
(68, '8803202207', 'Muhamad Angga Ferdyan', 'RKS 2022/2023', '2023-07-24 23:11:48', '2023-07-24 23:11:48'),
(69, '8803202208', 'Naufal Indra Permada', 'RKS 2022/2023', '2023-07-24 23:13:14', '2023-07-24 23:13:14'),
(70, '8803202209', 'Sarah Gracia Kapite', 'RKS 2022/2023', '2023-07-24 23:14:10', '2023-07-24 23:14:10'),
(71, '8803202210', 'Samuel Thomas Latekay', 'RKS 2022/2023', '2023-07-24 23:14:59', '2023-07-24 23:14:59'),
(72, '8803202211', 'Uun Saifudin', 'RKS 2022/2023', '2023-07-24 23:15:44', '2023-07-24 23:15:44'),
(74, '88', 'Eko', 'RKS 2021/2022', '2023-07-26 09:22:27', '2023-07-26 09:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_keanggotaan`
--

CREATE TABLE `nilai_keanggotaan` (
  `id_keanggotaan` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `batas_bawah` varchar(10) NOT NULL,
  `batas_tengah` varchar(10) NOT NULL,
  `batas_atas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_keanggotaan`
--

INSERT INTO `nilai_keanggotaan` (`id_keanggotaan`, `id_kriteria`, `batas_bawah`, `batas_tengah`, `batas_atas`) VALUES
(1, 33, '3.6', '3.8', '4'),
(2, 34, '50', '75', '100'),
(3, 35, '0', '2', '5');

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `sub_kriteria` varchar(50) NOT NULL,
  `nilai_sub` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `sub_kriteria`, `nilai_sub`) VALUES
(86, 35, 'Tidak Aktif', 0),
(87, 35, 'Organisasi', 2),
(88, 35, 'UKM', 2),
(89, 35, 'Organisasi + UKM', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_hasil`
--

CREATE TABLE `tabel_hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nilai_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_hasil`
--

INSERT INTO `tabel_hasil` (`id_hasil`, `id_alternatif`, `nilai_total`) VALUES
(2342, 0, 0),
(3135, 59, 3.38462),
(3942, 75, 4.5),
(3985, 74, 3.88462),
(3986, 72, 3.35211),
(3987, 71, 3.82211),
(3988, 70, 3.57211),
(3989, 69, 3.66211),
(3990, 68, 3.80683),
(3991, 67, 3.46984),
(3992, 66, 3.76211),
(3993, 65, 4.54348),
(3994, 64, 4.07667),
(3995, 63, 3.85348),
(3996, 62, 4.39556),
(3997, 58, 4.24),
(3998, 57, 3.91683),
(3999, 56, 3.83333),
(4000, 55, 4.3191),
(4001, 54, 3.47211),
(4002, 53, 4.22),
(4003, 52, 4.34632),
(4004, 51, 4.53516),
(4005, 50, 4.07667);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_nilai`
--

CREATE TABLE `tabel_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `nilai_ipk` float NOT NULL,
  `absensi` int(110) NOT NULL,
  `keaktifan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_nilai`
--

INSERT INTO `tabel_nilai` (`id_nilai`, `id_mahasiswa`, `nilai_ipk`, `absensi`, `keaktifan`) VALUES
(231, 50, 3.66, 100, '5'),
(232, 51, 3.89, 96, '5'),
(233, 52, 3.82, 100, '5'),
(234, 53, 3.72, 100, '5'),
(235, 54, 3.12, 98, '5'),
(236, 55, 3.79, 96, '5'),
(237, 56, 3.5, 100, '5'),
(238, 57, 3.52, 94, '5'),
(239, 58, 3.74, 100, '5'),
(245, 62, 3.84, 96, '2'),
(246, 63, 3.31, 96, '0'),
(247, 64, 3.66, 98, '2'),
(248, 65, 4, 96, '2'),
(249, 66, 3.41, 98, '5'),
(250, 67, 3.06, 82, '2'),
(251, 68, 3.41, 94, '2'),
(252, 69, 3.31, 98, '2'),
(253, 70, 3.22, 98, '2'),
(254, 71, 3.47, 98, '2'),
(255, 72, 3, 98, '5'),
(256, 74, 3.5, 80, '2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) DEFAULT 2,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `password` varchar(75) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin@gmail.com', '$2y$10$elfJrkANIpe5gtjkzR0huelex3meq/Sq9XZYZ/ykh5oCkLJsuIOA.', '2023-05-02 18:17:55', '2023-05-02 18:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `users_role`
--

CREATE TABLE `users_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_role`
--

INSERT INTO `users_role` (`id_role`, `role`) VALUES
(1, 'Admin'),
(2, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`),
  ADD KEY `id_warga` (`id_mahasiswa`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indexes for table `nilai_keanggotaan`
--
ALTER TABLE `nilai_keanggotaan`
  ADD PRIMARY KEY (`id_keanggotaan`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `tabel_hasil`
--
ALTER TABLE `tabel_hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD UNIQUE KEY `id_alternatif` (`id_alternatif`) USING BTREE;

--
-- Indexes for table `tabel_nilai`
--
ALTER TABLE `tabel_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_warga` (`id_mahasiswa`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `nilai_keanggotaan`
--
ALTER TABLE `nilai_keanggotaan`
  MODIFY `id_keanggotaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `tabel_hasil`
--
ALTER TABLE `tabel_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4007;

--
-- AUTO_INCREMENT for table `tabel_nilai`
--
ALTER TABLE `tabel_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD CONSTRAINT `alternatif_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai_keanggotaan`
--
ALTER TABLE `nilai_keanggotaan`
  ADD CONSTRAINT `fk_id_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tabel_nilai`
--
ALTER TABLE `tabel_nilai`
  ADD CONSTRAINT `tabel_nilai_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `users_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
