-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2021 at 03:34 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guest`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `idevent` int(11) NOT NULL,
  `kodeevent` varchar(6) NOT NULL,
  `jenisevent` varchar(20) NOT NULL,
  `namaevent` varchar(30) NOT NULL,
  `lokasi` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` enum('soon','done','','') DEFAULT NULL,
  `nama_file` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`idevent`, `kodeevent`, `jenisevent`, `namaevent`, `lokasi`, `tanggal`, `keterangan`, `nama_file`) VALUES
(1, 'RN2909', 'WEDDING', 'RICKY & NOVI', 'UNGARAN', '2021-09-29', 'done', '98-wed.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `idtamu` int(11) NOT NULL,
  `kodetamu` varchar(6) NOT NULL,
  `namatamu1` varchar(30) NOT NULL,
  `namatamu2` text DEFAULT NULL,
  `jmlorang` int(2) NOT NULL,
  `namameja` varchar(50) NOT NULL,
  `nomorkursi` varchar(50) NOT NULL,
  `tglscan` date DEFAULT NULL,
  `waktu` time DEFAULT NULL,
  `status` enum('Sukses','Gagal','','') DEFAULT NULL,
  `idevent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tamu`
--

INSERT INTO `tamu` (`idtamu`, `kodetamu`, `namatamu1`, `namatamu2`, `jmlorang`, `namameja`, `nomorkursi`, `tglscan`, `waktu`, `status`, `idevent`) VALUES
(5, 'RN0001', 'Albertus', 'Valentine', 2, 'KAPEL SEDES', 'HAMPERS(1)', '2021-10-05', '23:42:00', 'Sukses', 1),
(9, 'RN0002', 'Lilia', '', 1, 'KAPEL SEDES', 'HAMPERS(1)', '2021-10-05', '23:42:00', 'Sukses', 1),
(10, 'RN0003', 'Ahjit ', 'Arnold ', 2, 'KAPEL SEDES', 'HAMPERS(1)', '2021-10-05', '12:03:00', 'Sukses', 1),
(27, 'RN0004', 'Roy Valentine', 'Airi\r\nSokha\r\nIljimae\r\nAiru\r\nAimer', 6, 'KAPEL SEDES', 'HAMPERS(1)', '2021-10-06', '08:33:00', 'Sukses', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'YWRtaW4=');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`idevent`);

--
-- Indexes for table `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`idtamu`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `idevent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tamu`
--
ALTER TABLE `tamu`
  MODIFY `idtamu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
