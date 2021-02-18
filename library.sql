-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2019 at 03:37 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE IF NOT EXISTS `buku` (
  `kode_buku` varchar(7) NOT NULL,
  `kode_kategori` varchar(7) NOT NULL,
  `kode_penerbit` varchar(7) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `jumlah_buku` int(11) NOT NULL,
  `diskripsi` text NOT NULL,
  `pengarang` varchar(30) NOT NULL,
  `tahun_terbit` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`kode_buku`, `kode_kategori`, `kode_penerbit`, `judul_buku`, `jumlah_buku`, `diskripsi`, `pengarang`, `tahun_terbit`) VALUES
('BK0001', 'K0001', 'PN0001', 'The Godfather  - Buku Kedua', 7, 'Prestasi yang menggemparkan .... Suatu novel mengenai kekerabatan yang menakutkan...', 'Mario Puzo', 1969),
('BK0002', 'K0001', 'PN0001', 'Orang Orang Sisilia', 13, 'Sukar bagi kita untuk berhenti membacanya,sungguh suatu karya yang luar biasa.', 'Mario Puzo', 1967),
('BK0003', 'K0002', 'PN0002', 'mBah Djabbar Leluhur & Dzurriahnya', 3, 'Allah telah memberi kesempatan kepada setiap manusia untuk mengambil pelajaran dari kehidupan orang-orang yang menjadi kekasih-Nya, maka rugilah orang-orang yang tidak mengambilnya.', 'Abdurrahman Izzudin', 2009),
('BK0004', 'K0003', 'PN0003', 'Babad Tanah Jawi', 30, 'Inilah Babad Para Raja di Tanah Jawa', 'W.L. Olthof', 1941),
('BK0005', 'K0001', 'PN0004', 'Max Havelaar', 20, 'Kisah Yang Membunuh Kolonialisme', 'Multatuli', 1868),
('BK0006', 'K0008', 'PN0006', 'Wartawan Boke Keliling Dunia', 0, 'When In Rome, Do like the Romans Do', 'Tony Ryanto', 2008),
('BK0007', 'K0003', 'PN0007', 'Majapahit', 15, 'Sandyakala Rajasawangsa', 'Langit Kresna Hariadi', 2012),
('BK0008', 'K0003', 'PN0008', 'Pararaton', 5, 'Inilah kisah hidup seseorang yang pada mulanya dijadikan anusia, seseorang yang kemudian oleh ayahnya, Dewa Brahma, dinamai Ken Arok', 'Wid Kusuma', 2011),
('BK0009', 'K0003', 'PN0002', 'Brawijaya Moksa', 4, 'Menarik', 'Wawan Susetya', 2010),
('BK0010', 'K0003', 'PN0009', 'Siapa Pengkhianat DIPONEGORO?', 6, 'Novel Pertama dari Trilogi Pangeran Diponegoro', 'E.R. Asura', 2013),
('BK0011', 'K0001', 'PN0008', 'PANJI Asmarabangun', 4, 'Hatimulah yang Membawaku Kembali', 'R. Toto Sugiharto', 2013);

-- --------------------------------------------------------

--
-- Table structure for table `kartu`
--

CREATE TABLE IF NOT EXISTS `kartu` (
  `kode_kartu` varchar(16) NOT NULL,
  `kode_peminjam` varchar(7) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `tgl_pembuatan` varchar(10) NOT NULL,
  `tgl_akhir` varchar(10) NOT NULL,
  `status` varchar(11) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kartu`
--

INSERT INTO `kartu` (`kode_kartu`, `kode_peminjam`, `nama`, `tgl_pembuatan`, `tgl_akhir`, `status`, `password`) VALUES
('A1709270001', 'PJ0003', 'adje', '2017-09-27', '2018-03-27', 'Aktif', ''),
('A1709270002', 'PJ0004', 'gembul gembul', '2017-09-27', '2018-03-27', 'Aktif', ''),
('A1906150003', 'PJ0002', 'Galih ADitya', '2019-06-15', '2019-12-15', 'Aktif', '123');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `kode_kategori` varchar(7) NOT NULL,
  `nama_kategori` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kode_kategori`, `nama_kategori`) VALUES
('K0008', 'Humor'),
('K0001', 'Novel'),
('K0002', 'Religi'),
('K0003', 'Sejarah'),
('K0004', 'Cerita Bergambar'),
('K0005', 'Dongeng'),
('K0006', 'Komik'),
('K0007', 'Cerita Anak'),
('K0009', 'Misteri'),
('K0010', 'Pendidikan'),
('K0011', 'Pelajaran'),
('K0012', 'Horror');

-- --------------------------------------------------------

--
-- Table structure for table `peminjam`
--

CREATE TABLE IF NOT EXISTS `peminjam` (
  `kode_peminjam` varchar(7) NOT NULL,
  `ktp` varchar(16) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telp` varchar(13) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjam`
--

INSERT INTO `peminjam` (`kode_peminjam`, `ktp`, `nama`, `gender`, `alamat`, `telp`) VALUES
('PJ0003', '213123123', 'adje', 'Laki - Laki', 's', '22'),
('PJ0002', '2139718263512316', 'Galih ADitya', 'Laki - Laki', 'Pasuruan', '2138261367326'),
('PJ0004', '123123321', 'gembul gembul', 'Laki - Laki', '123', '12331'),
('PJ0005', '123', 'asdasd', 'Perempuan', 'asd', '-8');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE IF NOT EXISTS `peminjaman` (
  `kode_peminjaman` varchar(10) NOT NULL,
  `kode_petugas` varchar(7) NOT NULL,
  `kode_peminjam` varchar(7) NOT NULL,
  `kode_kartu` varchar(16) NOT NULL,
  `kode_buku` varchar(7) NOT NULL,
  `tgl_pinjam` varchar(10) NOT NULL,
  `tgl_kembali` varchar(10) NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`kode_peminjaman`, `kode_petugas`, `kode_peminjam`, `kode_kartu`, `kode_buku`, `tgl_pinjam`, `tgl_kembali`, `status`) VALUES
('1906140001', 'PT0001', 'PJ0003', 'A1709270001', 'BK0002', '2019-06-14', '2019-06-17', 'Belum'),
('1906140002', 'PT0001', 'PJ0003', '', 'BK0003', '2019-06-14', '2019-06-17', 'Belum'),
('1906140003', 'PT0001', 'PJ0004', 'A1709270002', 'BK0001', '2019-06-14', '2019-06-17', 'Belum'),
('1906140004', 'PT0001', 'PJ0004', 'A1709270002', 'BK0002', '2019-06-14', '2019-06-17', 'Belum'),
('1906140005', 'PT0001', 'PJ0004', 'A1709270002', 'BK0003', '2019-06-14', '2019-06-17', 'Belum'),
('1906150006', 'PT0001', 'PJ0002', 'A1906150003', 'BK0001', '2019-06-15', '2019-06-18', 'Belum');

--
-- Triggers `peminjaman`
--
DELIMITER //
CREATE TRIGGER `kurangbuku` AFTER INSERT ON `peminjaman`
 FOR EACH ROW BEGIN
UPDATE buku SET jumlah_buku=jumlah_buku-1 WHERE kode_buku=NEW.kode_buku;
END
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `tambahbuku` AFTER UPDATE ON `peminjaman`
 FOR EACH ROW BEGIN
UPDATE buku SET jumlah_buku=jumlah_buku+1 WHERE kode_buku=NEW.kode_buku;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_online`
--

CREATE TABLE IF NOT EXISTS `peminjaman_online` (
`id_peminjaman_online` int(11) NOT NULL,
  `kode_kartu` varchar(16) NOT NULL,
  `kode_buku` varchar(7) NOT NULL,
  `tgl_entry` varchar(10) NOT NULL,
  `status` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE IF NOT EXISTS `penerbit` (
  `kode_penerbit` varchar(7) NOT NULL,
  `nama_penerbit` varchar(25) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telp` varchar(13) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`kode_penerbit`, `nama_penerbit`, `alamat`, `telp`) VALUES
('PN0001', 'Mitra Utama', 'Jl. MH Thamrin, Jakarta', '0234451511621'),
('PN0002', 'Ide Kreatif', 'Jl. Kedung Asem 87 Rungkut, Surabaya', '081332228311'),
('PN0003', 'Narasi', 'Jl. Cempaka Putih No. 8, Yogyakarta 55283', '0274555939'),
('PN0004', 'Qanita', 'Jl Veteran 21, Yogyakarta', '0341087633533'),
('PN0005', 'PT Mizan Pustaka', 'Yogyakarta', '0362163532535'),
('PN0006', 'Nexx Media Inc.', 'Malang', '0237321635231'),
('PN0007', 'Bentang Pustaka', 'Jakarta', '0237326325352'),
('PN0008', 'DIVA Press', 'Surabaya', '1234233443244'),
('PN0009', 'Imania', 'magelang', '0343562277272'),
('PN0010', 'Gramedia', 'Jakarta', '2131534334444'),
('PN0011', 'PT Elex Media Komputindo', 'Yogyakarta', '1237612653612'),
('PN0012', 'Shonen Jump', 'Jakarta', '082257934698');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE IF NOT EXISTS `petugas` (
  `kode_petugas` varchar(7) NOT NULL,
  `nama_petugas` varchar(25) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `no_telepon` varchar(13) NOT NULL,
  `userpic` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`kode_petugas`, `nama_petugas`, `gender`, `alamat`, `no_telepon`, `userpic`, `type`) VALUES
('PT0001', 'Galih Neville', 'Laki - Laki', 'Pasuruan Mojokerto', '082257934698', 'file_1504776374.jpg', 'image/jpeg'),
('PT0002', 'Vinna', 'Perempuan', 'Jl. Kusuma Bangsa no 8, Surabaya', '082257934698', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `kode_petugas` varchar(7) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kode_petugas`, `username`, `password`, `level`) VALUES
('PT0001', 'galih', '123', 'Admin'),
('PT0002', 'user', 'user', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
 ADD PRIMARY KEY (`kode_buku`);

--
-- Indexes for table `kartu`
--
ALTER TABLE `kartu`
 ADD PRIMARY KEY (`kode_kartu`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
 ADD PRIMARY KEY (`kode_kategori`);

--
-- Indexes for table `peminjam`
--
ALTER TABLE `peminjam`
 ADD PRIMARY KEY (`kode_peminjam`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
 ADD PRIMARY KEY (`kode_peminjaman`);

--
-- Indexes for table `peminjaman_online`
--
ALTER TABLE `peminjaman_online`
 ADD PRIMARY KEY (`id_peminjaman_online`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
 ADD PRIMARY KEY (`kode_penerbit`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
 ADD PRIMARY KEY (`kode_petugas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peminjaman_online`
--
ALTER TABLE `peminjaman_online`
MODIFY `id_peminjaman_online` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
