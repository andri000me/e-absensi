-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17 Jul 2018 pada 06.40
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen_dosen`
--

CREATE TABLE `absen_dosen` (
  `IDDOSEN` varchar(20) NOT NULL,
  `THNSM` varchar(5) NOT NULL,
  `IDMAKUL` varchar(10) NOT NULL,
  `KELAS` varchar(4) NOT NULL,
  `SEMESTER` varchar(3) NOT NULL,
  `IDPRODI` varchar(10) NOT NULL,
  `PERTEMUAN` int(2) NOT NULL,
  `TGL` varchar(10) NOT NULL,
  `JM` time NOT NULL,
  `JK` time NOT NULL,
  `MATERI` tinytext NOT NULL,
  `METODE` tinytext NOT NULL,
  `TUGAS` tinytext NOT NULL,
  `JLHHADIR` int(3) NOT NULL,
  `JLHABSEN` int(3) NOT NULL,
  `CREATED` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen_mhs`
--

CREATE TABLE `absen_mhs` (
  `IDMAHASISWA` varchar(20) NOT NULL,
  `THNSM` varchar(5) NOT NULL,
  `IDMAKUL` varchar(10) NOT NULL,
  `IDPRODI` varchar(10) NOT NULL,
  `KELAS` varchar(4) NOT NULL,
  `SEMESTER` varchar(3) NOT NULL,
  `PERTEMUAN` int(2) NOT NULL,
  `ABSENSI` char(1) NOT NULL,
  `CREATED` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `atur_bahan_ajar`
--

CREATE TABLE `atur_bahan_ajar` (
  `IDSET` int(11) NOT NULL,
  `IDDOSEN` varchar(25) NOT NULL,
  `THSHM` varchar(5) NOT NULL,
  `IDPRODI` varchar(10) NOT NULL,
  `IDMAKUL` varchar(12) NOT NULL,
  `NAMAKLS` varchar(10) NOT NULL,
  `SEMESTER` varchar(2) NOT NULL,
  `PERTEMUAN` int(2) NOT NULL,
  `MATERI` int(11) NOT NULL,
  `CREATED` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_ajar`
--

CREATE TABLE `bahan_ajar` (
  `ID` int(11) NOT NULL,
  `JUDUL` tinytext NOT NULL,
  `IDDOSEN` varchar(25) NOT NULL,
  `KET_FILE` text NOT NULL,
  `NAMA_FILE` tinytext NOT NULL,
  `TIPEFILE` varchar(50) NOT NULL,
  `SIFAT` int(1) NOT NULL DEFAULT '1',
  `CREATED` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `makul_dosen`
--

CREATE TABLE `makul_dosen` (
  `IDDOSEN` varchar(25) NOT NULL,
  `THSHM` varchar(5) NOT NULL,
  `IDPRODI` varchar(10) NOT NULL,
  `KDPSTMSPST` varchar(10) NOT NULL,
  `NMPSTMSPST` varchar(150) NOT NULL,
  `IDMAKUL` varchar(12) NOT NULL,
  `NAMAKLS` varchar(10) NOT NULL,
  `LABELKLS` varchar(5) NOT NULL,
  `SEMESTER` varchar(2) NOT NULL,
  `TAHUN` year(4) NOT NULL,
  `NAMAMK` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mhs_course`
--

CREATE TABLE `mhs_course` (
  `IDMAHASISWA` varchar(25) NOT NULL,
  `NAMAMHS` varchar(150) NOT NULL,
  `IDMAKUL` varchar(15) NOT NULL,
  `KELAS` varchar(10) NOT NULL,
  `THNSM` char(5) NOT NULL,
  `SEMESTER` smallint(5) NOT NULL,
  `TAHUN` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil_dosen`
--

CREATE TABLE `profil_dosen` (
  `IDDOSEN` varchar(25) NOT NULL,
  `NAMADOS` varchar(150) NOT NULL,
  `PRODIDOS` varchar(15) NOT NULL,
  `NAMAPRODIDOS` varchar(100) NOT NULL,
  `PICTURE` varchar(150) NOT NULL,
  `KEAHLIAN` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen_dosen`
--
ALTER TABLE `absen_dosen`
  ADD PRIMARY KEY (`IDDOSEN`,`THNSM`,`IDMAKUL`,`KELAS`,`SEMESTER`,`IDPRODI`,`PERTEMUAN`);

--
-- Indexes for table `absen_mhs`
--
ALTER TABLE `absen_mhs`
  ADD PRIMARY KEY (`IDMAHASISWA`,`THNSM`,`IDMAKUL`,`IDPRODI`,`KELAS`,`SEMESTER`,`PERTEMUAN`);

--
-- Indexes for table `atur_bahan_ajar`
--
ALTER TABLE `atur_bahan_ajar`
  ADD PRIMARY KEY (`IDSET`);

--
-- Indexes for table `bahan_ajar`
--
ALTER TABLE `bahan_ajar`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `makul_dosen`
--
ALTER TABLE `makul_dosen`
  ADD PRIMARY KEY (`IDDOSEN`,`THSHM`,`IDPRODI`,`IDMAKUL`,`NAMAKLS`,`SEMESTER`);

--
-- Indexes for table `mhs_course`
--
ALTER TABLE `mhs_course`
  ADD PRIMARY KEY (`IDMAHASISWA`,`IDMAKUL`,`KELAS`,`THNSM`,`SEMESTER`);

--
-- Indexes for table `profil_dosen`
--
ALTER TABLE `profil_dosen`
  ADD PRIMARY KEY (`IDDOSEN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atur_bahan_ajar`
--
ALTER TABLE `atur_bahan_ajar`
  MODIFY `IDSET` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bahan_ajar`
--
ALTER TABLE `bahan_ajar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
