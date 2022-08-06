-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jun 2022 pada 09.06
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulan_pembayaran`
--

CREATE TABLE `bulan_pembayaran` (
  `id_bulan_pembayaran` int(11) NOT NULL,
  `nama_bulan` enum('januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember') NOT NULL,
  `tahun` int(4) NOT NULL,
  `pembayaran_perminggu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bulan_pembayaran`
--

INSERT INTO `bulan_pembayaran` (`id_bulan_pembayaran`, `nama_bulan`, `tahun`, `pembayaran_perminggu`) VALUES
(8, 'april', 2022, 2500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'administrator'),
(2, 'bendahara'),
(3, 'Sekretaris');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `jenis_kelamin` enum('pria','wanita') NOT NULL,
  `no_telepon` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `jenis_kelamin`, `no_telepon`, `email`) VALUES
(1, 'Ach. Aden Ferdiansyah', 'pria', '087865672008', 'aden@gmail.com'),
(2, 'Fiqih Ardiansyah', 'pria', '085963090921', 'ardiansyahfiqih47@gmail.com'),
(3, 'Nila Karmila Sari Safitri', 'wanita', '081949187318', 'mila@gmail.com'),
(4, 'Moh. Fikriansyah', 'pria', '082334907811', 'fikri@gmail.com'),
(6, 'Warizatul Hasanah', 'wanita', '087850268995', 'Riza@gmail.com'),
(7, 'Ivony Desta Safitri Taufiq', 'wanita', '085259417039', 'Ivony@gmail.com'),
(8, 'Khairil Anwar', 'pria', '085936624640', 'Khairil@gmail.com'),
(9, 'Muhammad Ali Akbar', 'pria', '08', 'Ali@gmail.com'),
(10, 'Difa Rullynda fajrin', 'wanita', '087878417890', 'Difa@gmail.com'),
(11, 'Dini Andari', 'wanita', '087750831522', 'Dini@gmail.com'),
(12, 'Khotibul Umam', 'pria', '082337007258', 'Umam@gmail.com'),
(13, 'Dea Nurika Ramadhani', 'wanita', '082143343043', 'Dea@gmail.com'),
(14, 'Moh. Syaiful Ajiz', 'pria', '08785007177', 'Ajiz@gmail.com'),
(15, 'Ainul Hafiz', 'pria', '08133109723', 'Hafiz@gmail.com'),
(16, 'Akhmad khodaifi', 'pria', '082228930357', 'khodaifi@gmail.com'),
(17, 'Moh Dhafith Saleh', 'pria', '085936708437', 'Dhafith@gmail.com'),
(18, 'Rojil Ghuroni', 'pria', '087804061481', 'Rojil@gmail.com'),
(19, 'Hasan Basri', 'pria', '085231676696', 'Hasan@gmail.com'),
(20, 'Dita Amalia Khotijah', 'wanita', '081230354077', 'Dita@gmail.com'),
(21, 'Septian Aji Saputra', 'pria', '085745875979', 'Aji@gmail.com'),
(22, 'Shofil Fuadi', 'pria', '082337984452', 'Shofil@gmail.com'),
(23, 'Ayyub', 'pria', '081234499433', 'ayyub@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `jumlah_pengeluaran` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_pengeluaran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_uang_kas` int(11) NOT NULL,
  `aksi` text NOT NULL,
  `tanggal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `riwayat`
--

INSERT INTO `riwayat` (`id_riwayat`, `id_user`, `id_uang_kas`, `aksi`, `tanggal`) VALUES
(28, 2, 53, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 2,500', 1654235622),
(29, 1, 67, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 2,500', 1654237924),
(30, 1, 67, 'telah mengubah pembayaran minggu ke-2 dari Rp. 0 menjadi Rp. 2,500', 1654237935),
(31, 1, 67, 'telah mengubah pembayaran minggu ke-3 dari Rp. 0 menjadi Rp. 2,500', 1654237943),
(32, 1, 67, 'telah mengubah pembayaran minggu ke-4 dari Rp. 0 menjadi Rp. 2,500', 1654237953),
(33, 1, 67, 'telah mengubah pembayaran minggu ke-4 dari Rp. 0 menjadi Rp. 2,500', 1654237953),
(34, 1, 88, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 2,500', 1654237968),
(35, 1, 88, 'telah mengubah pembayaran minggu ke-2 dari Rp. 0 menjadi Rp. 2,500', 1654237976),
(36, 1, 78, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 2,500', 1654238366),
(37, 1, 78, 'telah mengubah pembayaran minggu ke-2 dari Rp. 0 menjadi Rp. 2,500', 1654238374),
(38, 1, 67, 'telah mengubah pembayaran minggu ke-2 dari Rp. 2,500 menjadi Rp. ', 1654238622),
(39, 1, 67, 'telah mengubah pembayaran minggu ke-2 dari Rp. 0 menjadi Rp. 2,500', 1654238632),
(40, 1, 80, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 2,500', 1654238641),
(41, 1, 67, 'telah mengubah pembayaran minggu ke-3 dari Rp.  menjadi Rp. 2,500', 1654238795),
(42, 1, 67, 'telah mengubah pembayaran minggu ke-4 dari Rp.  menjadi Rp. 2,500', 1654238808),
(43, 1, 80, 'telah mengubah pembayaran minggu ke-1 dari Rp. 2,500 menjadi Rp. 2,500', 1654238819),
(44, 1, 80, 'telah mengubah pembayaran minggu ke-1 dari Rp. 2,500 menjadi Rp. ', 1654238828),
(45, 1, 78, 'telah mengubah pembayaran minggu ke-3 dari Rp.  menjadi Rp. ', 1654238861),
(46, 1, 78, 'telah mengubah pembayaran minggu ke-2 dari Rp. 2,500 menjadi Rp. ', 1654238872),
(47, 1, 88, 'telah mengubah pembayaran minggu ke-3 dari Rp.  menjadi Rp. ', 1654238879),
(48, 1, 78, 'telah mengubah pembayaran minggu ke-1 dari Rp. 2,500 menjadi Rp. 2,500', 1654238892),
(49, 1, 78, 'telah mengubah pembayaran minggu ke-1 dari Rp. 2,500 menjadi Rp. ', 1654238900),
(50, 1, 68, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 2,500', 1654238916);

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_pengeluaran`
--

CREATE TABLE `riwayat_pengeluaran` (
  `id_riwayat_pengeluaran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `aksi` text NOT NULL,
  `tanggal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `riwayat_pengeluaran`
--

INSERT INTO `riwayat_pengeluaran` (`id_riwayat_pengeluaran`, `id_user`, `aksi`, `tanggal`) VALUES
(4, 2, 'telah menambahkan pengeluaran lakban dengan biaya Rp. 2,000', 1654235708);

-- --------------------------------------------------------

--
-- Struktur dari tabel `uang_kas`
--

CREATE TABLE `uang_kas` (
  `id_uang_kas` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_bulan_pembayaran` int(11) NOT NULL,
  `minggu_ke_1` int(11) DEFAULT NULL,
  `minggu_ke_2` int(11) DEFAULT NULL,
  `minggu_ke_3` int(11) DEFAULT NULL,
  `minggu_ke_4` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `uang_kas`
--

INSERT INTO `uang_kas` (`id_uang_kas`, `id_mahasiswa`, `id_bulan_pembayaran`, `minggu_ke_1`, `minggu_ke_2`, `minggu_ke_3`, `minggu_ke_4`) VALUES
(45, 16, 7, 0, 0, NULL, NULL),
(46, 17, 7, 0, 0, NULL, NULL),
(47, 18, 7, 0, 0, NULL, NULL),
(48, 19, 7, 0, 0, NULL, NULL),
(49, 20, 7, 0, 0, NULL, NULL),
(50, 21, 7, 0, 0, NULL, NULL),
(51, 22, 7, 0, 0, NULL, NULL),
(52, 7, 7, 0, 0, NULL, NULL),
(53, 1, 7, 2500, 0, NULL, NULL),
(54, 15, 7, 0, 0, NULL, NULL),
(55, 5, 7, 0, 0, NULL, NULL),
(56, 13, 7, 0, 0, NULL, NULL),
(57, 10, 7, 0, 0, NULL, NULL),
(58, 11, 7, 0, 0, NULL, NULL),
(59, 2, 7, 0, 0, NULL, NULL),
(60, 8, 7, 0, 0, NULL, NULL),
(61, 12, 7, 0, 0, NULL, NULL),
(62, 4, 7, 0, 0, NULL, NULL),
(63, 14, 7, 0, 0, NULL, NULL),
(64, 9, 7, 0, 0, NULL, NULL),
(65, 3, 7, 0, 0, NULL, NULL),
(66, 6, 7, 0, 0, NULL, NULL),
(67, 1, 8, 2500, 2500, 2500, 2500),
(68, 2, 8, 2500, 0, NULL, NULL),
(69, 3, 8, 0, 0, NULL, NULL),
(70, 4, 8, 0, 0, NULL, NULL),
(71, 6, 8, 0, 0, NULL, NULL),
(72, 7, 8, 0, 0, NULL, NULL),
(73, 8, 8, 0, 0, NULL, NULL),
(74, 9, 8, 0, 0, NULL, NULL),
(75, 10, 8, 0, 0, NULL, NULL),
(76, 11, 8, 0, 0, NULL, NULL),
(77, 12, 8, 0, 0, NULL, NULL),
(78, 13, 8, 0, 0, 0, NULL),
(79, 14, 8, 0, 0, NULL, NULL),
(80, 15, 8, 0, 0, NULL, NULL),
(81, 16, 8, 0, 0, NULL, NULL),
(82, 17, 8, 0, 0, NULL, NULL),
(83, 18, 8, 0, 0, NULL, NULL),
(84, 19, 8, 0, 0, NULL, NULL),
(85, 20, 8, 0, 0, NULL, NULL),
(86, 21, 8, 0, 0, NULL, NULL),
(87, 22, 8, 0, 0, NULL, NULL),
(88, 23, 8, 2500, 2500, 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `username`, `password`, `id_jabatan`) VALUES
(1, 'Fiqih Ardiansyah', 'Fiqih123', '$2y$10$RtlG8gY2cp/2BYEeMBJ2C.tMli1qvWGCoT/jkKIZVNrRJ/4cGbbTm', 1),
(2, 'Nila Karmila Sari Safitri', 'Mila123', '$2y$10$fdeYDCtDbXiGEQGLtbiAgOjZe240BbZJfVZK.61cItcJ/VZqO.f4.', 2),
(4, 'Warizatul Hasnanh', 'riza123', '$2y$10$XOU1sK3bX/b1NIvqoGme0u5mVwZqd.Gb7KQYWnwG17bN21Hv18B56', 3),
(6, 'moh. fikriansyah', 'fikri123', '$2y$10$gIe2thujw9.rRJVS6LTvPeeg3UwpSjqzSKVg61ZKKzRFAQVaMyU9i', 3),
(7, 'Ivony Desta Safitri Taufiq', 'Ivony123', '$2y$10$obek3UajYOiz.UeEEs2u5uXmQW/EK9qtiR90SOQuzte0TRBvNHOaG', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bulan_pembayaran`
--
ALTER TABLE `bulan_pembayaran`
  ADD PRIMARY KEY (`id_bulan_pembayaran`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_uang_kas` (`id_uang_kas`);

--
-- Indeks untuk tabel `riwayat_pengeluaran`
--
ALTER TABLE `riwayat_pengeluaran`
  ADD PRIMARY KEY (`id_riwayat_pengeluaran`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `uang_kas`
--
ALTER TABLE `uang_kas`
  ADD PRIMARY KEY (`id_uang_kas`),
  ADD KEY `id_siswa` (`id_mahasiswa`),
  ADD KEY `id_bulan_pembayaran` (`id_bulan_pembayaran`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bulan_pembayaran`
--
ALTER TABLE `bulan_pembayaran`
  MODIFY `id_bulan_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `riwayat_pengeluaran`
--
ALTER TABLE `riwayat_pengeluaran`
  MODIFY `id_riwayat_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `uang_kas`
--
ALTER TABLE `uang_kas`
  MODIFY `id_uang_kas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
