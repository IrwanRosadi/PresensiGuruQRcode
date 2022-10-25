-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jul 2022 pada 06.17
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_presensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_hasil_presensi`
--

CREATE TABLE `tb_hasil_presensi` (
  `id_hasil_presensi` varchar(225) NOT NULL,
  `id_jadwal` varchar(4) NOT NULL,
  `jam_presensi` varchar(225) NOT NULL,
  `keterangan` varchar(10) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `id_PTK` char(5) NOT NULL,
  `keterlambatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_hasil_presensi`
--

INSERT INTO `tb_hasil_presensi` (`id_hasil_presensi`, `id_jadwal`, `jam_presensi`, `keterangan`, `tanggal`, `bulan`, `id_PTK`, `keterlambatan`) VALUES
('110720220232amPTK07MP008K024', '1', '08:35:33am', 'Hadir', '11-07-2022', '07', 'PTK07', '0'),
('110720220247amPTK02MP015K010', '2', '08:31:48am', 'Hadir', '11-07-2022', '07', 'PTK02', '0'),
('110720220317amPTK07MP008K001', '4', '09:42:18am', 'Hadir', '11-07-2022', '07', 'PTK07', 'Terlambat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jadwal`
--

CREATE TABLE `tb_jadwal` (
  `id_jadwal` varchar(4) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `id_jam` char(3) NOT NULL,
  `kode_kelas` char(4) NOT NULL,
  `kode_mapel` char(5) NOT NULL,
  `id_PTK` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`id_jadwal`, `hari`, `id_jam`, `kode_kelas`, `kode_mapel`, `id_PTK`) VALUES
('1', 'Monday', '2', 'K024', 'MP008', 'PTK07'),
('2', 'Monday', '2', 'K010', 'MP015', 'PTK02'),
('3', 'Friday', '3', 'K014', 'MP012', 'PTK05'),
('4', 'Monday', '3', 'K001', 'MP008', 'PTK07'),
('5', 'Tuesday', '2', 'K003', 'MP005', 'PTK04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jam`
--

CREATE TABLE `tb_jam` (
  `id_jam` char(3) NOT NULL,
  `jam_mulai` varchar(10) NOT NULL,
  `jam_berakhir` varchar(10) NOT NULL,
  `toleransi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jam`
--

INSERT INTO `tb_jam` (`id_jam`, `jam_mulai`, `jam_berakhir`, `toleransi`) VALUES
('1', '07:30:00', '08:30:00', '07:40:00'),
('2', '08:30:00', '09:30:00', '08:40:00'),
('3', '09:30:00', '10:30:00', '09:40:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jam_masuk`
--

CREATE TABLE `tb_jam_masuk` (
  `id_jam_masuk` char(3) NOT NULL,
  `jam_masuk` varchar(10) NOT NULL,
  `toleransi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jam_masuk`
--

INSERT INTO `tb_jam_masuk` (`id_jam_masuk`, `jam_masuk`, `toleransi`) VALUES
('1', '07:30:00', '07:40:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jam_pulang`
--

CREATE TABLE `tb_jam_pulang` (
  `id_jam_pulang` varchar(3) NOT NULL,
  `jam_pulang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jam_pulang`
--

INSERT INTO `tb_jam_pulang` (`id_jam_pulang`, `jam_pulang`) VALUES
('1', '12:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kehadiran`
--

CREATE TABLE `tb_kehadiran` (
  `id_kehadiran` varchar(50) NOT NULL,
  `jam_presensi` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `id_PTK` varchar(50) NOT NULL,
  `keterlambatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kehadiran`
--

INSERT INTO `tb_kehadiran` (`id_kehadiran`, `jam_presensi`, `keterangan`, `tanggal`, `bulan`, `id_PTK`, `keterlambatan`) VALUES
('11072022PTK02', '07:42:09am', 'Hadir', '11-07-2022', '07', 'PTK02', 'Terlambat'),
('11072022PTK07', '08:35:33am', 'Hadir', '11-07-2022', '07', 'PTK07', '0'),
('11072022PTK09', '07:42:34am', 'Hadir', '11-07-2022', '07', 'PTK09', 'Terlambat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `kode_kelas` char(4) NOT NULL,
  `nama_kelas` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`kode_kelas`, `nama_kelas`) VALUES
('K001', 'X IPA 1'),
('K002', 'X IPA 2'),
('K003', 'X IPA 3'),
('K004', 'X IPA 4'),
('K005', 'X IPA 5'),
('K006', 'X IPS 1'),
('K007', 'X IPS 2'),
('K008', 'X IPS 3'),
('K009', 'X IPS 4'),
('K010', 'X IPS 5'),
('K011', 'XI IPA 1'),
('K012', 'XI IPA 2'),
('K013', 'XI IPA 3'),
('K014', 'XI IPA 4'),
('K015', 'XI IPA 5'),
('K016', 'XI IPS 1'),
('K017', 'XI IPS 2'),
('K018', 'XI IPS 3'),
('K019', 'XI IPS 4'),
('K020', 'XI IPS 5'),
('K021', 'XII IPA 1'),
('K022', 'XII IPA 2'),
('K023', 'XII IPA 3'),
('K024', 'XII IPA 4'),
('K025', 'XII IPA 5'),
('K026', 'XII IPS 1'),
('K027', 'XII IPS 2'),
('K028', 'XII IPS 3'),
('K029', 'XII IPS 4'),
('K030', 'XII IPS 5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `kode_mapel` char(5) NOT NULL,
  `mapel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_mapel`
--

INSERT INTO `tb_mapel` (`kode_mapel`, `mapel`) VALUES
('MP001', 'Pendidikan Agama Islam dan Budi Pekerti'),
('MP002', 'Pendidikan Pancasila dan Kewarganegaraan'),
('MP003', 'Pendidikan Jasmani, Olahraga, dan Kewarganegaraan'),
('MP004', 'Bahasa Indonesia'),
('MP005', 'Bahasa Inggris'),
('MP006', 'Biologi'),
('MP007', 'Fisika'),
('MP008', 'Matematika Umum'),
('MP009', 'Matematika Peminatan'),
('MP010', 'Kimia'),
('MP011', 'Geografi'),
('MP012', 'Ekonomi'),
('MP013', 'Sejarah'),
('MP014', 'Sosiologi'),
('MP015', 'Seni Budaya'),
('MP016', 'Informatika'),
('MP017', 'Bahasa Arab'),
('MP018', 'Prakarya Dan Kewirausahawan'),
('MP019', 'Muatan Lokal Bahasa Daerah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_presensi_pulang`
--

CREATE TABLE `tb_presensi_pulang` (
  `id_presensi_pulang` varchar(50) NOT NULL,
  `jam_presensi` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `id_PTK` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_presensi_pulang`
--

INSERT INTO `tb_presensi_pulang` (`id_presensi_pulang`, `jam_presensi`, `tanggal`, `bulan`, `keterangan`, `id_PTK`) VALUES
('04072022PTK07', '06:45:21am', '04-07-2022', '07', 'Pulang', 'PTK07'),
('11072022PTK02', '12:06:20pm', '11-07-2022', '07', 'Pulang', 'PTK02'),
('11072022PTK09', '12:06:29pm', '11-07-2022', '07', 'Pulang', 'PTK09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ptk`
--

CREATE TABLE `tb_ptk` (
  `id_PTK` char(5) NOT NULL,
  `nama_PTK` varchar(45) NOT NULL,
  `jk_PTK` char(2) NOT NULL,
  `jabatan_PTK` varchar(50) NOT NULL,
  `jenis_PTK` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_ptk`
--

INSERT INTO `tb_ptk` (`id_PTK`, `nama_PTK`, `jk_PTK`, `jabatan_PTK`, `jenis_PTK`) VALUES
('PTK01', 'Hasanudin, S.Pd', 'L', 'Kepala Sekolah', 'Guru'),
('PTK02', 'Ambar Rodi, S.Pd', 'L', 'Waka. Kurikulum', 'Guru'),
('PTK03', 'Hurman, SH', 'L', 'Waka. Kesiswaan', 'Guru'),
('PTK04', 'Lalu Badri, S.Pd', 'L', 'Waka. Sarana', 'Guru'),
('PTK05', 'Suhardi, SE. MM', 'L', 'Waka. Humas', 'Guru'),
('PTK06', 'Nurul Inayah, S.AP', 'P', 'Bag. Kesiswaan', 'Pegawai'),
('PTK07', 'Eli Rahmawati, S.Pd', 'P', 'Guru Mata Pelajaran', 'Guru'),
('PTK08', 'Muharny Elwaty', 'P', 'Tenaga Administrasi Sekolah', 'Pegawai'),
('PTK09', 'Lalu Afandi Jaya', 'L', 'Tenaga Administrasi Sekolah', 'Pegawai'),
('PTK10', 'Muhammad Fatoni', 'L', 'Guru BK', 'Guru'),
('PTK11', 'Nizaruddin', 'L', 'Tenaga Administrasi Sekolah', 'Pegawai'),
('PTK12', 'Ridwan, S.Pd', 'L', 'Waka. Sarana', 'Guru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
(1, 'Sarjan', 'admin', 'admin', 'Admin'),
(2, 'Muhammad Fatoni', 'gurubp', 'gurubp', 'Guru BP'),
(6, 'Indah Permatasari', 'indah02', '123', 'Guru bp');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_hasil_presensi`
--
ALTER TABLE `tb_hasil_presensi`
  ADD PRIMARY KEY (`id_hasil_presensi`);

--
-- Indeks untuk tabel `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `tb_jam`
--
ALTER TABLE `tb_jam`
  ADD PRIMARY KEY (`id_jam`);

--
-- Indeks untuk tabel `tb_jam_masuk`
--
ALTER TABLE `tb_jam_masuk`
  ADD PRIMARY KEY (`id_jam_masuk`);

--
-- Indeks untuk tabel `tb_jam_pulang`
--
ALTER TABLE `tb_jam_pulang`
  ADD PRIMARY KEY (`id_jam_pulang`);

--
-- Indeks untuk tabel `tb_kehadiran`
--
ALTER TABLE `tb_kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`kode_kelas`);

--
-- Indeks untuk tabel `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`kode_mapel`);

--
-- Indeks untuk tabel `tb_presensi_pulang`
--
ALTER TABLE `tb_presensi_pulang`
  ADD PRIMARY KEY (`id_presensi_pulang`);

--
-- Indeks untuk tabel `tb_ptk`
--
ALTER TABLE `tb_ptk`
  ADD PRIMARY KEY (`id_PTK`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
