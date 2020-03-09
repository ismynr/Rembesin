-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2019 at 04:14 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rembesin`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_admin` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `id_user`, `nama_admin`, `email`, `created_at`, `updated_at`) VALUES
(2, 27, 'Admin Rembesin', 'admin@gmail.com', '2019-08-02 00:00:00', '2019-08-26 07:50:21');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_bank`
--

CREATE TABLE `tb_jenis_bank` (
  `id_bank` int(11) NOT NULL,
  `jenis_bank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_jenis_bank`
--

INSERT INTO `tb_jenis_bank` (`id_bank`, `jenis_bank`) VALUES
(1, 'BRI'),
(2, 'BCA'),
(6, 'BNI'),
(7, 'Bukopin'),
(10, 'Mandiri');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_identitas`
--

CREATE TABLE `tb_jenis_identitas` (
  `id_identitas` int(11) NOT NULL,
  `jenis_identitas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_jenis_identitas`
--

INSERT INTO `tb_jenis_identitas` (`id_identitas`, `jenis_identitas`) VALUES
(1, 'KTP'),
(2, 'SIM'),
(6, 'NIK');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_nota`
--

CREATE TABLE `tb_jenis_nota` (
  `id_nota` int(11) NOT NULL,
  `jenis_nota` varchar(50) NOT NULL,
  `gambar_nota` varchar(100) NOT NULL DEFAULT 'default.png',
  `deskripsi_nota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_jenis_nota`
--

INSERT INTO `tb_jenis_nota` (`id_nota`, `jenis_nota`, `gambar_nota`, `deskripsi_nota`) VALUES
(1, 'Hotel', 'ea5540b7adc94d6542e708fa15d74707.jpg', 'Sebagai tempat penginapan saat dinas'),
(2, 'Makan', '76d8a0233523cd2b04e631dbe8b14bf9.jpg', 'pembiyayaan makan karyawan'),
(3, 'Transportasi', 'cfa5ab68c49c09cb026ebe2f6e3399ed.jpg', 'Menggunakan kendaraan umum'),
(4, 'Bahan Bakar', '6d25ca5e100b8f2dc258d00a7f348eb8.png', 'Bahan transportasi kendaraan seperti bensin, solar, listris, akissssss'),
(5, 'Inventaris', '0a2b2a25d68641a614550e2449262068.jpg', 'Keperluan kantor'),
(7, 'Tagihan', 'c4dd1974c239bd0edc6e96cbc01755ba.jpg', 'Pengelolaan tagihan seperti listrik, air, pom dll'),
(13, 'Tiket', '1c10230f0898eb1fa9812589fa8d5cbe.jpg', 'Seperti tiket travel , kereta, bus dll untuk transportasi umum');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `kode_karyawan` char(8) NOT NULL,
  `nama_karyawan` varchar(30) NOT NULL,
  `jk_karyawan` char(1) NOT NULL,
  `email_karyawan` varchar(35) NOT NULL,
  `alamat_karyawan` varchar(20) NOT NULL,
  `jabatan_karyawan` varchar(20) NOT NULL,
  `identitas_karyawan` varchar(50) NOT NULL,
  `no_identitas_karyawan` varchar(30) NOT NULL,
  `trash` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id_karyawan`, `id_user`, `id_perusahaan`, `kode_karyawan`, `nama_karyawan`, `jk_karyawan`, `email_karyawan`, `alamat_karyawan`, `jabatan_karyawan`, `identitas_karyawan`, `no_identitas_karyawan`, `trash`, `created_at`, `updated_at`) VALUES
(17, 32, 9, 'KRY00002', 'puput', 'P', 'puput@gmail.com', 'pemalang', 'manajer', 'KTP', '4564', 0, '2019-08-02 11:35:51', '2019-08-26 16:02:28'),
(18, 33, 9, 'KRY00003', 'rio sakti sumarsono', 'L', 'rio@gmail.com', 'Jakarta', 'BOS muda', 'KTP', '456445775654865', 0, '2019-08-02 11:37:15', '2019-08-02 11:39:33'),
(19, 35, 10, 'KRY00004', 'risma sari', 'P', 'risma@gmail.com', 'tegal', 'manager', 'KTP', '23245545677858', 0, '2019-08-03 11:33:42', '2019-08-04 07:56:50'),
(20, 36, 10, 'KRY00005', 'diyas', 'P', 'diyas@gmail.com', 'tegal', 'manager', 'KTP', '443654557886865', 0, '2019-08-03 11:34:00', '2019-08-03 11:34:00'),
(21, 37, 10, 'KRY00006', 'indri', 'P', 'indri@gmail.com', 'tegal', 'manager', 'KTP', '456445788686775', 0, '2019-08-03 11:34:16', '2019-08-03 11:34:16'),
(22, 39, 10, 'KRY00007', 'nrnr', 'P', 'nrnr@gmail.com', '65gnbvm', 'direktur', 'KTP', '4564457886865', 0, '2019-08-04 02:20:50', '2019-08-04 02:20:50'),
(24, 42, 9, 'KRY00008', 'Ismi Nururrizqi', 'P', 'isminururrizqi.nr@gmail.com', 'Tegalwangi talang te', 'karyawan', 'KTP', '28734857289345', 0, '2019-08-05 02:09:26', '2019-08-25 08:08:40'),
(25, 43, 9, 'KRY00009', 'anisa pandu', 'P', 'anisa@gmail.com', 'cilacap', 'karyawan', 'KTP', '74792649872381234', 0, '2019-08-05 02:09:56', '2019-08-05 02:09:56'),
(27, 79, 26, 'KRY00010', 'abuabu', 'L', 'asdf@gmail.com', 'jkahsldjfh', 'aksjdf', 'SIM', '2749562734', 0, '2019-08-16 15:51:55', '2019-08-16 15:51:55'),
(28, 80, 26, 'KRY00011', 'zilong', 'L', 'zilong@gmail.com', 'moba', 'fighter ml', 'KTP', '2739274929', 0, '2019-08-16 15:53:14', '2019-08-16 15:53:14'),
(29, 82, 27, 'KRY00012', 'x5 zeus', 'L', 'x5zeus@gmail.com', 'x5 zeus', 'x5 zeus', 'SIM', '1212312312312334', 0, '2019-08-17 19:04:15', '2019-08-17 19:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_log`
--

CREATE TABLE `tb_log` (
  `log_id` int(11) NOT NULL,
  `log_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `log_user` varchar(50) DEFAULT NULL,
  `log_role` varchar(50) NOT NULL,
  `log_tipe` varchar(50) DEFAULT NULL,
  `log_aksi` varchar(50) DEFAULT NULL,
  `log_item` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_log`
--

INSERT INTO `tb_log` (`log_id`, `log_time`, `log_user`, `log_role`, `log_tipe`, `log_aksi`, `log_item`) VALUES
(3, '2019-08-06 08:27:23', 'admin', 'admin', 'perusahaan', 'approve', 'PT ardata'),
(4, '2019-08-06 08:29:43', 'admin', 'admin', 'perusahaan', 'move to trash', 'PT ardata'),
(6, '2019-08-06 08:33:07', 'admin', 'admin', 'perusahaan', 'disapprove', 'omah koding'),
(7, '2019-08-06 08:33:21', 'admin', 'admin', 'perusahaan', 'approve', 'omah koding'),
(8, '2019-08-06 08:34:26', 'admin', 'admin', 'perusahaan', 'move to trash', 'omah koding'),
(9, '2019-08-06 08:36:07', 'admin', 'admin', 'perusahaan', 'dikeluarkan dari trash', 'omah koding'),
(10, '2019-08-06 08:38:42', 'admin', 'admin', 'perusahaan', 'dihapus permanent', 'PT ardata'),
(11, '2019-08-06 08:40:22', 'admin', 'admin', 'admin', 'ubah profil', 'Admin RM'),
(12, '2019-08-06 08:41:50', 'admin', 'admin', 'admin', 'ubah password', '******'),
(13, '2019-08-06 08:46:19', 'admin', 'admin', 'jenis identitas', 'tambah data', 'KITAS'),
(14, '2019-08-06 08:46:37', 'admin', 'admin', 'jenis identitas', 'ubah data', 'PASSPORT'),
(15, '2019-08-06 08:46:47', 'admin', 'admin', 'jenis identitas', 'hapus data', 'PASSPORT'),
(16, '2019-08-06 08:50:11', 'admin', 'admin', 'jenis nota', 'tambah data', 'asas'),
(17, '2019-08-06 08:50:16', 'admin', 'admin', 'jenis nota', 'ubah data', 'asasasas'),
(18, '2019-08-06 08:50:19', 'admin', 'admin', 'jenis nota', 'hapus data', 'asasasas'),
(19, '2019-08-06 08:50:33', 'admin', 'admin', 'jenis bank', 'tambah data', 'zxzx'),
(20, '2019-08-06 08:50:33', 'admin', 'admin', 'jenis bank', 'add', 'zxzx'),
(21, '2019-08-06 08:50:44', 'admin', 'admin', 'jenis bank', 'hapus data', 'zxzx'),
(22, '2019-08-06 09:02:37', 'admin', 'admin', 'perusahaan', 'disapprove', 'omah koding'),
(23, '2019-08-06 09:02:53', 'admin', 'admin', 'perusahaan', 'approve', 'omah koding'),
(24, '2019-08-06 09:22:43', 'admin', 'admin', 'perusahaan', 'disapprove', 'omah koding'),
(25, '2019-08-06 09:22:56', 'admin', 'admin', 'perusahaan', 'approve', 'omah koding'),
(26, '2019-08-06 09:27:29', 'admin', 'admin', 'perusahaan', 'disapprove', 'PT Nocola'),
(27, '2019-08-06 09:31:06', 'admin', 'admin', 'perusahaan', 'approve', 'PT Nocola'),
(28, '2019-08-06 09:34:35', 'admin', 'admin', 'perusahaan', 'disapprove', 'omah koding'),
(29, '2019-08-06 09:40:08', 'admin', 'admin', 'perusahaan', 'disapprove', 'omah koding'),
(30, '2019-08-07 01:49:35', 'admin', 'admin', 'jenis bank', 'ubah data', 'Mandiri Syari\'ah'),
(31, '2019-08-07 01:50:09', 'admin', 'admin', 'jenis bank', 'ubah data', 'BCA'),
(32, '2019-08-10 14:27:21', 'admin', 'admin', 'jenis nota', 'ubah data', 'Transportasi'),
(33, '2019-08-10 14:28:33', 'admin', 'admin', 'jenis nota', 'ubah data', 'Transportasi'),
(34, '2019-08-11 01:34:04', 'admin', 'admin', 'jenis nota', 'ubah data', 'Bahan Bakar'),
(35, '2019-08-11 01:36:07', 'admin', 'admin', 'jenis nota', 'ubah data', 'Inventaris'),
(36, '2019-08-11 01:38:43', 'admin', 'admin', 'jenis nota', 'ubah data', 'Tagihan'),
(37, '2019-08-11 01:40:03', 'admin', 'admin', 'jenis nota', 'ubah data', 'Tagihan'),
(38, '2019-08-11 01:50:02', 'admin', 'admin', 'jenis nota', 'ubah data', 'Bahan Bakar'),
(39, '2019-08-11 01:51:03', 'admin', 'admin', 'jenis nota', 'ubah data', 'Inventaris'),
(40, '2019-08-11 01:51:48', 'admin', 'admin', 'jenis nota', 'ubah data', 'Tagihan'),
(41, '2019-08-11 01:52:07', 'admin', 'admin', 'jenis nota', 'ubah data', 'Transportasi'),
(42, '2019-08-11 01:52:43', 'admin', 'admin', 'jenis nota', 'ubah data', 'Makan'),
(43, '2019-08-11 01:53:15', 'admin', 'admin', 'jenis nota', 'ubah data', 'Hotel'),
(44, '2019-08-11 09:41:47', 'admin', 'admin', 'jenis nota', 'hapus data', 'Tagihan'),
(45, '2019-08-11 09:41:57', 'admin', 'admin', 'jenis nota', 'tambah data', 'Tagihan'),
(46, '2019-08-11 09:42:32', 'admin', 'admin', 'jenis nota', 'ubah data', 'Tagihan'),
(47, '2019-08-12 04:30:32', 'admin', 'admin', 'perusahaan', 'dipindahkan ke trash', 'ismynr.xyz'),
(48, '2019-08-12 04:33:33', 'admin', 'admin', 'perusahaan', 'dikeluarkan dari trash', 'ismynr.xyz'),
(49, '2019-08-12 06:16:27', 'admin', 'admin', 'jenis nota', 'tambah data', 'Tagihan'),
(50, '2019-08-12 06:16:35', 'admin', 'admin', 'jenis nota', 'hapus data', 'Tagihan'),
(51, '2019-08-12 06:30:19', 'admin', 'admin', 'jenis nota', 'tambah data', 'Liburan'),
(52, '2019-08-12 06:30:36', 'admin', 'admin', 'jenis nota', 'hapus data', 'Liburan'),
(53, '2019-08-12 06:30:49', 'admin', 'admin', 'jenis nota', 'tambah data', 'Liburan'),
(54, '2019-08-12 06:34:52', 'admin', 'admin', 'jenis nota', 'hapus data', 'Liburan'),
(55, '2019-08-12 06:35:07', 'admin', 'admin', 'jenis nota', 'tambah data', 'Liburan'),
(56, '2019-08-12 06:35:12', 'admin', 'admin', 'jenis nota', 'hapus data', 'Liburan'),
(57, '2019-08-12 06:35:32', 'admin', 'admin', 'jenis nota', 'tambah data', 'Liburan'),
(58, '2019-08-12 09:20:26', 'admin', 'admin', 'perusahaan', 'dipindahkan ke trash', 'dfghjkl'),
(59, '2019-08-12 09:20:33', 'admin', 'admin', 'perusahaan', 'dikeluarkan dari trash', 'dfghjkl'),
(60, '2019-08-12 09:38:29', 'admin', 'admin', 'jenis identitas', 'tambah data', 'PASSPORT'),
(61, '2019-08-12 09:41:06', 'admin', 'admin', 'jenis identitas', 'tambah data', 'PASSPORT'),
(62, '2019-08-12 09:41:18', 'admin', 'admin', 'jenis identitas', 'tambah data', 'PASSPORT'),
(63, '2019-08-12 09:41:39', 'admin', 'admin', 'jenis identitas', 'tambah data', 'asas'),
(64, '2019-08-12 09:41:53', 'admin', 'admin', 'jenis identitas', 'tambah data', 'KITAS'),
(65, '2019-08-12 09:43:33', 'admin', 'admin', 'jenis identitas', 'tambah data', 'asd'),
(66, '2019-08-12 09:44:09', 'admin', 'admin', 'jenis identitas', 'tambah data', 'akjksdhf'),
(67, '2019-08-12 09:44:23', 'admin', 'admin', 'jenis identitas', 'tambah data', 'akjksdhf'),
(68, '2019-08-12 09:44:39', 'admin', 'admin', 'jenis identitas', 'tambah data', 'akjksdhf'),
(69, '2019-08-12 09:44:49', 'admin', 'admin', 'jenis identitas', 'tambah data', 'akjksdhf'),
(70, '2019-08-12 09:45:28', 'admin', 'admin', 'jenis identitas', 'tambah data', 'akjksdhf'),
(71, '2019-08-12 09:48:08', 'admin', 'admin', 'jenis identitas', 'tambah data', 'akjksdhf'),
(72, '2019-08-12 09:48:13', 'admin', 'admin', 'jenis identitas', 'hapus data', 'akjksdhf'),
(73, '2019-08-13 00:47:58', 'admin', 'admin', 'perusahaan', 'disapprove', 'PT Nocola'),
(74, '2019-08-13 00:48:07', 'admin', 'admin', 'perusahaan', 'approve', 'PT Nocola'),
(75, '2019-08-13 01:54:46', 'admin', 'admin', 'perusahaan', 'disapprove', 'ismynr.xyz'),
(76, '2019-08-13 01:54:52', 'admin', 'admin', 'perusahaan', 'approve', 'ismynr.xyz'),
(77, '2019-08-13 01:56:55', 'admin', 'admin', 'perusahaan', 'dipindahkan ke trash', 'ismynr.xyz'),
(78, '2019-08-13 01:57:37', 'admin', 'admin', 'perusahaan', 'dipindahkan ke trash', 'dfghjkl'),
(79, '2019-08-13 01:57:43', 'admin', 'admin', 'perusahaan', 'dikeluarkan dari trash', 'ismynr.xyz'),
(80, '2019-08-13 01:58:27', 'admin', 'admin', 'jenis identitas', 'ubah data', 'NIK (No Induk Karyawan) xc'),
(81, '2019-08-13 01:58:41', 'admin', 'admin', 'jenis identitas', 'tambah data', 'PASSPORT'),
(82, '2019-08-13 01:58:47', 'admin', 'admin', 'jenis identitas', 'ubah data', 'PASSPORT sdsd'),
(83, '2019-08-13 02:16:22', 'admin', 'admin', 'jenis identitas', 'tambah data', 'sdsd'),
(84, '2019-08-13 02:16:29', 'admin', 'admin', 'jenis identitas', 'hapus data', 'sdsd'),
(85, '2019-08-13 09:16:43', 'admin', 'admin', 'jenis nota', 'tambah data', 'Tiket'),
(86, '2019-08-13 09:16:57', 'admin', 'admin', 'jenis nota', 'tambah data', 'kjhgf'),
(87, '2019-08-13 09:17:38', 'admin', 'admin', 'jenis nota', 'ubah data', 'akjkshdkgf'),
(88, '2019-08-13 09:17:56', 'admin', 'admin', 'jenis nota', 'hapus data', 'akjkshdkgf'),
(89, '2019-08-13 14:20:00', 'admin', 'admin', 'jenis nota', 'tambah data', 'amsnj'),
(90, '2019-08-13 15:21:42', 'admin', 'admin', 'jenis bank', 'tambah data', 'Bukopin'),
(91, '2019-08-13 15:21:46', 'admin', 'admin', 'jenis bank', 'tambah data', 'awagan'),
(92, '2019-08-13 15:21:52', 'admin', 'admin', 'jenis bank', 'ubah data', 'awaganc'),
(93, '2019-08-13 15:23:28', 'admin', 'admin', 'jenis bank', 'tambah data', 'zxzx'),
(94, '2019-08-13 15:23:32', 'admin', 'admin', 'jenis bank', 'hapus data', 'zxzx'),
(95, '2019-08-13 15:27:33', 'admin', 'admin', 'admin', 'ubah password', '******'),
(96, '2019-08-13 15:29:04', 'admin', 'admin', 'perusahaan', 'dikeluarkan dari trash', 'dfghjkl'),
(97, '2019-08-13 15:29:48', 'admin', 'admin', 'perusahaan', 'dipindahkan ke trash', 'dfghjkl'),
(98, '2019-08-13 15:35:35', 'admin', 'admin', 'jenis nota', 'hapus data', 'amsnj'),
(99, '2019-08-13 15:36:02', 'admin', 'admin', 'jenis bank', 'tambah data', 'Mandiri'),
(100, '2019-08-13 15:39:03', 'admin', 'admin', 'perusahaan', 'approve', 'omah koding'),
(101, '2019-08-13 16:56:07', 'nocola', 'perusahaan', 'karyawan', 'tambah data', 'galon'),
(102, '2019-08-13 17:41:54', 'nocola', 'perusahaan', 'Master Rembes', 'hapus rembes', 'rapat'),
(103, '2019-08-13 17:41:58', 'nocola', 'perusahaan', 'Master Rembes', 'klaim rembes', 'workshop'),
(104, '2019-08-13 18:03:08', 'nocola', 'perusahaan', 'karyawan', 'ubah data', 'galon'),
(105, '2019-08-13 18:13:06', 'nocola', 'perusahaan', 'karyawan', 'ubah data', 'galon yah'),
(106, '2019-08-13 18:16:02', 'nocola', 'perusahaan', 'karyawan', 'ubah data', 'galon yah get'),
(107, '2019-08-13 18:22:13', 'nocola', 'perusahaan', 'karyawan', 'ubah data', '5'),
(108, '2019-08-14 04:29:15', 'admin', 'admin', 'admin', 'ubah password', '******'),
(109, '2019-08-14 04:29:22', 'admin', 'admin', 'admin', 'ubah password', '******'),
(110, '2019-08-14 04:29:27', 'admin', 'admin', 'admin', 'ubah password', '******'),
(111, '2019-08-14 04:29:31', 'admin', 'admin', 'admin', 'ubah password', '******'),
(112, '2019-08-14 05:01:27', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(113, '2019-08-14 05:01:34', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(114, '2019-08-14 05:03:37', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(115, '2019-08-14 05:03:40', 'admin', 'admin', 'user', 'login', 'admin'),
(116, '2019-08-14 05:04:16', 'admin', 'admin', 'user', 'logout', 'admin'),
(117, '2019-08-14 05:04:20', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(118, '2019-08-14 06:33:41', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(119, '2019-08-14 06:33:45', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(120, '2019-08-14 06:35:47', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(121, '2019-08-14 06:35:51', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(122, '2019-08-14 06:36:27', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(123, '2019-08-14 06:36:37', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(124, '2019-08-14 06:42:47', 'nocola', 'perusahaan', 'karyawan', 'hapus data', 'galon'),
(125, '2019-08-14 07:45:54', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(126, '2019-08-14 08:20:59', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(127, '2019-08-14 08:21:02', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(128, '2019-08-14 08:21:23', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(129, '2019-08-14 08:21:30', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(130, '2019-08-14 08:36:30', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(131, '2019-08-14 08:36:33', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(132, '2019-08-14 08:36:52', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(133, '2019-08-14 08:36:57', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(134, '2019-08-14 08:37:10', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(135, '2019-08-14 08:37:13', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(136, '2019-08-14 08:37:49', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(137, '2019-08-14 08:37:57', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(138, '2019-08-14 08:49:47', 'nocola', 'perusahaan', 'Master Rembes', 'klaim rembes', 'workshop'),
(139, '2019-08-14 09:31:55', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(140, '2019-08-14 09:32:01', 'admin', 'admin', 'user', 'login', 'admin'),
(141, '2019-08-14 22:01:48', 'admin', 'admin', 'user', 'login', 'admin'),
(142, '2019-08-14 22:51:25', 'admin', 'admin', 'web config', 'ubah pengaturan general', ''),
(143, '2019-08-14 23:35:43', 'admin', 'admin', 'web config', 'ubah pengaturan general', ''),
(144, '2019-08-14 23:35:57', 'admin', 'admin', 'web config', 'ubah pengaturan general', ''),
(145, '2019-08-14 23:36:41', 'admin', 'admin', 'web config', 'ubah pengaturan general', ''),
(146, '2019-08-14 23:37:36', 'admin', 'admin', 'web config', 'ubah pengaturan general', ''),
(147, '2019-08-14 23:40:11', 'admin', 'admin', 'web config', 'ubah pengaturan general', ''),
(148, '2019-08-14 23:40:32', 'admin', 'admin', 'web config', 'ubah pengaturan general', ''),
(149, '2019-08-14 23:44:32', 'admin', 'admin', 'web config', 'ubah pengaturan general', ''),
(150, '2019-08-14 23:47:27', 'admin', 'admin', 'web config', 'ubah pengaturan general', ''),
(151, '2019-08-14 23:47:42', 'admin', 'admin', 'web config', 'ubah pengaturan general', ''),
(152, '2019-08-14 23:53:13', 'admin', 'admin', 'jenis identitas', 'ubah data', 'NIK'),
(153, '2019-08-14 23:56:51', 'admin', 'admin', 'jenis bank', 'ubah data', 'Mandiri'),
(154, '2019-08-15 00:12:11', 'admin', 'admin', 'user', 'logout', 'admin'),
(155, '2019-08-15 00:12:16', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(156, '2019-08-15 00:15:06', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(157, '2019-08-15 00:15:10', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(158, '2019-08-15 01:34:05', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(159, '2019-08-15 01:34:10', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(160, '2019-08-15 01:36:21', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(161, '2019-08-15 01:36:25', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(162, '2019-08-15 01:39:52', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(163, '2019-08-15 01:39:58', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(164, '2019-08-15 01:40:07', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(165, '2019-08-15 01:40:26', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(166, '2019-08-15 02:22:29', 'ismi', 'karyawan', 'master rembes', 'tambah data', 'Persiapan pergi ke luar negri (Amrik)'),
(167, '2019-08-15 02:33:57', 'ismi', 'karyawan', 'master rembes', 'tambah data', 'akjsfkh'),
(168, '2019-08-15 02:40:56', 'ismi', 'karyawan', 'master rembes', 'tambah data', 'ash'),
(169, '2019-08-15 02:41:04', 'ismi', 'karyawan', 'master rembes', 'ubah data', 'ashasas'),
(170, '2019-08-15 02:43:21', 'ismi', 'karyawan', 'master rembes', 'tambah data', 'ajkhsdfj'),
(171, '2019-08-15 02:43:26', 'ismi', 'karyawan', 'master rembes', 'ubah data', 'ajkhsdfj'),
(172, '2019-08-15 04:13:26', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(173, '2019-08-15 04:55:41', 'nocola', 'perusahaan', 'Master Rembes', 'klaim rembes', 'kunjungan kerja ke google indonesia'),
(174, '2019-08-15 06:14:16', 'ismi', 'karyawan', 'master rembes', 'cancel submit kegiatan', 'Persiapan pergi ke luar negri (Amerika)'),
(175, '2019-08-15 06:14:19', 'ismi', 'karyawan', 'master rembes', 'cancel submit kegiatan', 'Seminar besar di Cilacap'),
(176, '2019-08-15 06:15:22', 'ismi', 'karyawan', 'karyawan', 'ubah profile', 'ismi'),
(177, '2019-08-15 06:17:47', 'ismi', 'karyawan', 'master rembes', 'submit kegiatan', 'Persiapan pergi ke luar negri (Amerika)'),
(178, '2019-08-15 06:21:07', 'ismi', 'karyawan', 'nota rembes', 'tambah data', 'hotel sandra dewi bintang 5, cuma seper4 hari doan'),
(179, '2019-08-15 06:22:47', 'ismi', 'karyawan', 'master rembes', 'submit kegiatan', 'Seminar besar di Cilacap'),
(180, '2019-08-15 06:30:39', 'ismi', 'karyawan', 'master rembes', 'cancel submit kegiatan', 'Seminar besar di Cilacap'),
(181, '2019-08-15 06:30:53', 'ismi', 'karyawan', 'master rembes', 'cancel submit kegiatan', 'Persiapan pergi ke luar negri (Amerika)'),
(182, '2019-08-15 06:31:11', 'ismi', 'karyawan', 'master rembes', 'submit kegiatan', 'Persiapan pergi ke luar negri (Amerika)'),
(183, '2019-08-15 06:35:09', 'ismi', 'karyawan', 'master rembes', 'cancel submit kegiatan', 'Persiapan pergi ke luar negri (Amerika)'),
(184, '2019-08-15 06:35:40', 'ismi', 'karyawan', 'master rembes', 'ubah data', 'Persiapan pergi ke luar negri (Amerika) tidak lama'),
(185, '2019-08-15 06:42:08', 'ismi', 'karyawan', 'master rembes', 'submit kegiatan', 'Persiapan pergi ke luar negri (Amerika) tidak lama'),
(186, '2019-08-15 06:45:54', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(187, '2019-08-15 06:45:59', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(188, '2019-08-15 06:53:00', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(189, '2019-08-15 06:53:04', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(190, '2019-08-15 08:22:48', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(191, '2019-08-15 08:22:56', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(192, '2019-08-15 08:23:03', 'nocola', 'perusahaan', 'Master Rembes', 'klaim rembes', 'Persiapan pergi ke luar negri (Amerika) tidak lama'),
(193, '2019-08-15 08:23:12', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(194, '2019-08-15 08:23:20', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(195, '2019-08-15 08:50:37', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(196, '2019-08-15 08:50:54', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(197, '2019-08-15 08:51:08', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(198, '2019-08-15 08:51:11', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(199, '2019-08-15 08:52:56', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(200, '2019-08-15 08:53:01', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(201, '2019-08-15 08:54:57', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(202, '2019-08-15 08:55:03', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(203, '2019-08-15 14:05:42', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(204, '2019-08-16 01:35:25', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(205, '2019-08-16 01:36:29', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(206, '2019-08-16 01:36:44', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(207, '2019-08-16 01:37:00', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(208, '2019-08-16 01:37:03', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(209, '2019-08-16 01:39:18', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(210, '2019-08-16 01:39:25', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(211, '2019-08-16 02:48:59', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(212, '2019-08-16 02:49:07', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(213, '2019-08-16 03:20:58', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(214, '2019-08-16 03:21:05', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(215, '2019-08-16 04:38:51', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(216, '2019-08-16 04:38:56', 'admin', 'admin', 'user', 'login', 'admin'),
(217, '2019-08-16 05:58:44', 'admin', 'admin', 'user', 'logout', 'admin'),
(218, '2019-08-16 05:58:51', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(219, '2019-08-16 06:25:09', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(220, '2019-08-16 06:25:14', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(221, '2019-08-16 06:42:48', 'ismi', 'karyawan', 'nota rembes', 'tambah data', 'pulang'),
(222, '2019-08-16 06:43:20', 'ismi', 'karyawan', 'nota rembes', 'tambah data', 'oleh oleh'),
(223, '2019-08-16 06:46:18', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(224, '2019-08-16 07:02:29', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(225, '2019-08-16 08:14:20', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(226, '2019-08-16 08:14:24', 'admin', 'admin', 'user', 'login', 'admin'),
(227, '2019-08-16 08:14:45', 'admin', 'admin', 'user', 'logout', 'admin'),
(228, '2019-08-16 08:14:49', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(229, '2019-08-16 08:18:14', 'ismi', 'karyawan', 'master rembes', 'tambah data', 'dines di surabaya'),
(230, '2019-08-16 08:24:04', 'ismi', 'karyawan', 'nota rembes', 'tambah data', 'kaljsdf'),
(231, '2019-08-16 08:24:55', 'ismi', 'karyawan', 'master rembes', 'tambah data', 'akjsd'),
(232, '2019-08-16 08:25:41', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(233, '2019-08-16 08:25:46', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(234, '2019-08-16 08:26:17', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(235, '2019-08-16 08:27:35', 'admin', 'admin', 'user', 'login', 'admin'),
(236, '2019-08-16 08:28:19', 'admin', 'admin', 'web config', 'ubah email kontak', 'anisapandundis1@gmail.com'),
(237, '2019-08-16 08:28:27', 'admin', 'admin', 'user', 'logout', 'admin'),
(238, '2019-08-16 08:40:12', 'admin', 'admin', 'user', 'login', 'admin'),
(239, '2019-08-16 08:41:39', 'admin', 'admin', 'perusahaan', 'approve', 'PT Makmur Jaya'),
(240, '2019-08-16 08:41:51', 'admin', 'admin', 'user', 'logout', 'admin'),
(241, '2019-08-16 08:42:03', 'budi', 'perusahaan', 'user', 'login', 'budi'),
(242, '2019-08-16 08:42:25', 'budi', 'perusahaan', 'user', 'logout', 'budi'),
(243, '2019-08-16 08:43:13', 'budi', 'perusahaan', 'user', 'login', 'budi'),
(244, '2019-08-16 08:51:56', 'budi', 'perusahaan', 'karyawan', 'tambah data', 'abuabu'),
(245, '2019-08-16 08:53:14', 'budi', 'perusahaan', 'karyawan', 'tambah data', 'zilong'),
(246, '2019-08-16 08:54:12', 'budi', 'perusahaan', 'karyawan', 'ubah data', 'fighter'),
(247, '2019-08-16 08:55:09', 'budi', 'perusahaan', 'karyawan', 'ubah data', 'fighter'),
(248, '2019-08-16 08:56:11', 'budi', 'perusahaan', 'karyawan', 'ubah data', 'fighter ml'),
(249, '2019-08-16 08:56:30', 'budi', 'perusahaan', 'karyawan', 'reset password', '********'),
(250, '2019-08-16 08:56:57', 'budi', 'perusahaan', 'karyawan', 'reset password', '********'),
(251, '2019-08-16 08:57:22', 'budi', 'perusahaan', 'user', 'logout', 'budi'),
(252, '2019-08-16 08:57:32', 'zilong', 'karyawan', 'user', 'login', 'zilong'),
(253, '2019-08-16 08:57:46', 'zilong', 'karyawan', 'user', 'logout', 'zilong'),
(254, '2019-08-16 08:57:58', 'budi', 'perusahaan', 'user', 'login', 'budi'),
(255, '2019-08-16 09:00:17', 'budi', 'perusahaan', 'karyawan', 'reset password', '********'),
(256, '2019-08-16 09:03:42', 'budi', 'perusahaan', 'karyawan', 'reset password', '********'),
(257, '2019-08-16 09:04:00', 'budi', 'perusahaan', 'karyawan', 'reset password', '********'),
(258, '2019-08-16 09:04:45', 'budi', 'perusahaan', 'user', 'logout', 'budi'),
(259, '2019-08-16 09:05:02', 'budi', 'perusahaan', 'user', 'login', 'budi'),
(260, '2019-08-16 09:06:08', 'budi', 'perusahaan', 'user', 'logout', 'budi'),
(261, '2019-08-16 09:06:17', 'budi', 'perusahaan', 'user', 'login', 'budi'),
(262, '2019-08-16 09:06:41', 'budi', 'perusahaan', 'user', 'logout', 'budi'),
(263, '2019-08-16 09:07:34', 'budi', 'perusahaan', 'user', 'login', 'budi'),
(264, '2019-08-16 09:07:46', 'budi', 'perusahaan', 'karyawan', 'reset password', '********'),
(265, '2019-08-16 09:08:00', 'budi', 'perusahaan', 'user', 'logout', 'budi'),
(266, '2019-08-16 09:08:18', 'zilong', 'karyawan', 'user', 'login', 'zilong'),
(267, '2019-08-16 09:08:43', 'zilong', 'karyawan', 'user', 'ubah password', 'zilong'),
(268, '2019-08-16 09:09:30', 'zilong', 'karyawan', 'master rembes', 'tambah data', 'makan'),
(269, '2019-08-16 09:10:23', 'zilong', 'karyawan', 'master rembes', 'tambah data', 'seminar'),
(270, '2019-08-16 09:11:43', 'zilong', 'karyawan', 'nota rembes', 'tambah data', 'pesan ayam bakar dengan direktur'),
(271, '2019-08-16 09:13:01', 'zilong', 'karyawan', 'nota rembes', 'tambah data', 'tuku bensin pertamax Turbo'),
(272, '2019-08-16 09:14:14', 'zilong', 'karyawan', 'nota rembes', 'tambah data', 'sewa hotel 1 malam'),
(273, '2019-08-16 09:14:41', 'zilong', 'karyawan', 'nota rembes', 'update data', 'sewa hotel 1 malam'),
(274, '2019-08-16 09:15:25', 'zilong', 'karyawan', 'master rembes', 'submit kegiatan', 'seminar'),
(275, '2019-08-16 09:15:54', 'zilong', 'karyawan', 'user', 'logout', 'zilong'),
(276, '2019-08-16 09:16:17', 'budi', 'perusahaan', 'user', 'login', 'budi'),
(277, '2019-08-16 09:16:32', 'budi', 'perusahaan', 'Master Rembes', 'klaim rembes', 'seminar'),
(278, '2019-08-16 09:17:23', 'zilong', 'karyawan', 'user', 'login', 'zilong'),
(279, '2019-08-16 09:19:01', 'admin', 'admin', 'user', 'login', 'admin'),
(280, '2019-08-17 11:49:01', 'admin', 'admin', 'user', 'login', 'admin'),
(281, '2019-08-17 11:49:34', 'admin', 'admin', 'web config', 'ubah pengaturan general', ''),
(282, '2019-08-17 11:50:02', 'admin', 'admin', 'user', 'logout', 'admin'),
(283, '2019-08-17 11:51:03', 'admin', 'admin', 'user', 'login', 'admin'),
(284, '2019-08-17 11:51:10', 'admin', 'admin', 'perusahaan', 'approve', 'fantech'),
(285, '2019-08-17 11:51:14', 'admin', 'admin', 'user', 'logout', 'admin'),
(286, '2019-08-17 11:51:20', 'fantech', 'perusahaan', 'user', 'login', 'fantech'),
(287, '2019-08-17 12:04:15', 'fantech', 'perusahaan', 'karyawan', 'tambah data', 'x5 zeus'),
(288, '2019-08-17 12:14:53', 'fantech', 'perusahaan', 'user', 'logout', 'fantech'),
(289, '2019-08-17 12:15:03', 'x5zeus', 'karyawan', 'user', 'login', 'x5zeus'),
(290, '2019-08-17 12:15:14', 'x5zeus', 'karyawan', 'user', 'logout', 'x5zeus'),
(291, '2019-08-17 12:15:34', 'fantech', 'perusahaan', 'user', 'login', 'fantech'),
(292, '2019-08-17 12:46:10', 'fantech', 'perusahaan', 'user', 'logout', 'fantech'),
(293, '2019-08-17 12:46:15', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(294, '2019-08-17 12:47:49', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(295, '2019-08-17 12:47:58', 'fantech', 'perusahaan', 'user', 'login', 'fantech'),
(296, '2019-08-17 13:17:12', 'fantech', 'perusahaan', 'user', 'logout', 'fantech'),
(297, '2019-08-17 13:17:16', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(298, '2019-08-17 13:17:22', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(299, '2019-08-17 13:17:28', 'x5zeus', 'karyawan', 'user', 'login', 'x5zeus'),
(300, '2019-08-17 13:17:34', 'x5zeus', 'karyawan', 'user', 'logout', 'x5zeus'),
(301, '2019-08-17 13:17:49', 'fantech', 'perusahaan', 'user', 'login', 'fantech'),
(302, '2019-08-17 13:18:18', 'fantech', 'perusahaan', 'karyawan', 'tambah data', 'x9 Thor'),
(303, '2019-08-17 13:18:34', 'fantech', 'perusahaan', 'user', 'logout', 'fantech'),
(304, '2019-08-17 13:18:38', 'x9thor', 'karyawan', 'user', 'login', 'x9thor'),
(305, '2019-08-17 13:19:14', 'x9thor', 'karyawan', 'master rembes', 'tambah data', 'Pertemuan programmer indonesia'),
(306, '2019-08-17 13:19:30', 'x9thor', 'karyawan', 'nota rembes', 'tambah data', 'bensin'),
(307, '2019-08-17 13:19:51', 'x9thor', 'karyawan', 'nota rembes', 'tambah data', 'ayam geprek'),
(308, '2019-08-17 13:20:17', 'x9thor', 'karyawan', 'master rembes', 'ubah data', 'Pertemuan programmer seluruh indonesia'),
(309, '2019-08-17 13:20:29', 'x9thor', 'karyawan', 'user', 'logout', 'x9thor'),
(310, '2019-08-17 13:20:39', 'fantech', 'perusahaan', 'user', 'login', 'fantech'),
(311, '2019-08-17 13:22:28', 'fantech', 'perusahaan', 'user', 'logout', 'fantech'),
(312, '2019-08-17 13:22:35', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(313, '2019-08-20 10:38:52', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(314, '2019-08-20 10:39:25', 'ismi', 'karyawan', 'nota rembes', 'tambah data', 'as'),
(315, '2019-08-20 10:42:40', 'ismi', 'karyawan', 'nota rembes', 'tambah data', 'qw'),
(316, '2019-08-25 01:07:23', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(317, '2019-08-25 01:07:47', 'ismi', 'karyawan', 'karyawan', 'ubah profile', 'Ismi Nururrizqi'),
(318, '2019-08-25 01:08:27', 'ismi', 'karyawan', 'karyawan', 'ubah profile', 'Ismi Nururrizqi'),
(319, '2019-08-25 01:08:40', 'ismi', 'karyawan', 'karyawan', 'ubah profile', 'Ismi Nururrizqi'),
(320, '2019-08-25 01:09:35', 'ismi', 'karyawan', 'user', 'ubah password', 'ismi'),
(321, '2019-08-26 00:31:39', 'admin', 'admin', 'user', 'login', 'admin'),
(322, '2019-08-26 00:51:27', 'admin', 'admin', 'user', 'logout', 'admin'),
(323, '2019-08-26 00:53:08', 'admin', 'admin', 'user', 'login', 'admin'),
(324, '2019-08-26 00:57:00', 'admin', 'admin', 'user', 'logout', 'admin'),
(325, '2019-08-26 00:57:35', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(326, '2019-08-26 01:00:26', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(327, '2019-08-26 01:00:34', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(328, '2019-08-26 08:10:02', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(329, '2019-08-26 08:10:28', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(330, '2019-08-26 08:10:32', 'puput', 'karyawan', 'user', 'login', 'puput'),
(331, '2019-08-26 08:11:57', 'puput', 'karyawan', 'master rembes', 'tambah data', 'Rapat pertemuan partner perusahaan di jakarta'),
(332, '2019-08-26 08:14:28', 'puput', 'karyawan', 'master rembes', 'ubah data', 'Rapat pertemuan partner perusahaan di jakarta'),
(333, '2019-08-26 08:19:39', 'puput', 'karyawan', 'nota rembes', 'tambah data', 'kereta api'),
(334, '2019-08-26 08:26:05', 'puput', 'karyawan', 'nota rembes', 'update data', 'kereta api'),
(335, '2019-08-26 08:26:12', 'puput', 'karyawan', 'nota rembes', 'update data', 'kereta api'),
(336, '2019-08-26 08:26:17', 'puput', 'karyawan', 'nota rembes', 'update data', 'kereta api'),
(337, '2019-08-26 08:27:21', 'puput', 'karyawan', 'nota rembes', 'update data', 'kereta api'),
(338, '2019-08-26 08:27:32', 'puput', 'karyawan', 'nota rembes', 'update data', 'kereta api'),
(339, '2019-08-26 09:00:31', 'puput', 'karyawan', 'nota rembes', 'update data', 'kereta api'),
(340, '2019-08-26 09:02:29', 'puput', 'karyawan', 'karyawan', 'ubah profile', 'puput'),
(341, '2019-08-26 09:05:43', 'puput', 'karyawan', 'nota rembes', 'update data', 'kereta api'),
(342, '2019-08-26 09:07:51', 'puput', 'karyawan', 'nota rembes', 'update data', 'kereta api'),
(343, '2019-08-26 09:14:59', 'puput', 'karyawan', 'nota rembes', 'tambah data', 'kajd'),
(344, '2019-08-26 09:15:18', 'puput', 'karyawan', 'nota rembes', 'update data', 'kajd'),
(345, '2019-08-26 09:22:28', 'puput', 'karyawan', 'nota rembes', 'tambah data', 'alat tulis'),
(346, '2019-08-26 09:22:40', 'puput', 'karyawan', 'nota rembes', 'update data', 'alat tulis'),
(347, '2019-08-26 09:28:35', 'puput', 'karyawan', 'master rembes', 'tambah data', 'Seminar nasional'),
(348, '2019-08-26 09:29:05', 'puput', 'karyawan', 'nota rembes', 'tambah data', 'mobil'),
(349, '2019-08-26 09:29:26', 'puput', 'karyawan', 'nota rembes', 'tambah data', 'listrik'),
(350, '2019-08-26 09:30:23', 'puput', 'karyawan', 'master rembes', 'submit kegiatan', 'Seminar nasional'),
(351, '2019-08-26 09:30:34', 'puput', 'karyawan', 'master rembes', 'cancel submit kegiatan', 'Seminar nasional'),
(352, '2019-08-26 09:30:56', 'puput', 'karyawan', 'master rembes', 'ubah data', 'Seminar nasional akjshdlfhalsdjfhlahdfkjahsldfjhas'),
(353, '2019-08-26 09:31:07', 'puput', 'karyawan', 'master rembes', 'submit kegiatan', 'Seminar nasional akjshdlfhalsdjfhlahdfkjahsldfjhas'),
(354, '2019-08-26 09:32:04', 'puput', 'karyawan', 'master rembes', 'submit kegiatan', 'Rapat pertemuan partner perusahaan di jakarta'),
(355, '2019-08-26 09:32:17', 'puput', 'karyawan', 'master rembes', 'cancel submit kegiatan', 'Rapat pertemuan partner perusahaan di jakarta'),
(356, '2019-08-26 09:32:33', 'puput', 'karyawan', 'master rembes', 'cancel submit kegiatan', 'Seminar nasional akjshdlfhalsdjfhlahdfkjahsldfjhas'),
(357, '2019-08-26 09:32:46', 'puput', 'karyawan', 'master rembes', 'ubah data', 'Seminar nasional'),
(358, '2019-08-26 09:32:55', 'puput', 'karyawan', 'master rembes', 'submit kegiatan', 'Rapat pertemuan partner perusahaan di jakarta'),
(359, '2019-08-26 09:33:03', 'puput', 'karyawan', 'user', 'logout', 'puput'),
(360, '2019-08-26 09:33:07', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(361, '2019-08-26 10:06:59', 'nocola', 'perusahaan', 'karyawan', 'tambah data', 'coba'),
(362, '2019-08-26 10:08:03', 'nocola', 'perusahaan', 'karyawan', 'ubah data', 'coba'),
(363, '2019-08-26 10:13:23', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(364, '2019-08-26 10:13:27', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(365, '2019-08-27 01:48:41', 'admin', 'admin', 'user', 'login', 'admin'),
(366, '2019-08-27 01:49:48', 'admin', 'admin', 'user', 'logout', 'admin'),
(367, '2019-08-27 01:49:57', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(368, '2019-08-27 01:51:13', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(369, '2019-08-27 01:51:23', 'x5zeus', 'karyawan', 'user', 'login', 'x5zeus'),
(370, '2019-08-27 01:53:06', 'x5zeus', 'karyawan', 'master rembes', 'tambah data', ' awagan bae ws'),
(371, '2019-08-27 01:53:30', 'x5zeus', 'karyawan', 'nota rembes', 'tambah data', 'siiang'),
(372, '2019-08-27 01:54:03', 'x5zeus', 'karyawan', 'master rembes', 'submit kegiatan', ' awagan bae ws'),
(373, '2019-08-27 01:54:07', 'x5zeus', 'karyawan', 'user', 'logout', 'x5zeus'),
(374, '2019-08-27 01:54:13', 'fantech', 'perusahaan', 'user', 'login', 'fantech'),
(375, '2019-08-27 01:55:44', 'fantech', 'perusahaan', 'user', 'logout', 'fantech'),
(376, '2019-08-27 01:55:48', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(377, '2019-08-27 01:57:31', 'ismi', 'karyawan', 'master rembes', 'ubah data', 'meeting para karyawan'),
(378, '2019-08-27 02:01:54', 'ismi', 'karyawan', 'nota rembes', 'update data', 'qw'),
(379, '2019-08-27 02:02:13', 'ismi', 'karyawan', 'nota rembes', 'update data', 'qw'),
(380, '2019-08-27 02:04:29', 'ismi', 'karyawan', 'master rembes', 'ubah data', 'meeting para karyawan'),
(381, '2019-08-27 02:21:33', 'ismi', 'karyawan', 'master rembes', 'cancel submit kegiatan', 'kunjungan kerja ke google indonesia'),
(382, '2019-08-27 02:21:40', 'ismi', 'karyawan', 'master rembes', 'submit kegiatan', 'kunjungan kerja ke google indonesia'),
(383, '2019-08-27 02:23:39', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(384, '2019-08-27 02:25:26', 'admin', 'admin', 'user', 'login', 'admin'),
(385, '2019-08-27 02:32:05', 'admin', 'admin', 'web config', 'ubah pengaturan general', ''),
(386, '2019-08-27 02:33:48', 'admin', 'admin', 'user', 'logout', 'admin'),
(387, '2019-08-27 02:35:57', 'admin', 'admin', 'user', 'login', 'admin'),
(388, '2019-08-27 02:36:14', 'admin', 'admin', 'web config', 'ubah pengaturan general', ''),
(389, '2019-08-27 02:36:33', 'admin', 'admin', 'user', 'logout', 'admin'),
(390, '2019-08-27 03:02:44', 'admin', 'admin', 'user', 'login', 'admin'),
(391, '2019-08-27 03:02:50', 'admin', 'admin', 'jenis nota', 'hapus data', 'Liburan'),
(392, '2019-08-27 03:02:54', 'admin', 'admin', 'user', 'logout', 'admin'),
(393, '2019-08-27 03:21:16', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(394, '2019-08-27 03:24:15', 'ismi', 'karyawan', 'nota rembes', 'hapus data', 'qw'),
(395, '2019-08-27 03:24:30', 'ismi', 'karyawan', 'nota rembes', 'update data', 'oleh oleh'),
(396, '2019-08-27 03:24:37', 'ismi', 'karyawan', 'nota rembes', 'update data', 'oleh oleh'),
(397, '2019-08-27 03:24:54', 'ismi', 'karyawan', 'master rembes', 'ubah data', 'meeting para karyawan'),
(398, '2019-08-27 03:25:10', 'ismi', 'karyawan', 'master rembes', 'tambah data', 'cc'),
(399, '2019-08-27 03:25:30', 'ismi', 'karyawan', 'nota rembes', 'update data', 'oleh oleh'),
(400, '2019-08-27 03:28:08', 'ismi', 'karyawan', 'master rembes', 'tambah data', 'Penyerahan projek kerja di jember'),
(401, '2019-08-27 03:29:13', 'ismi', 'karyawan', 'nota rembes', 'tambah data', 'kereta api'),
(402, '2019-08-27 13:28:28', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(403, '2019-08-27 13:28:46', 'ismi', 'karyawan', 'master rembes', 'tambah data', 'ads'),
(404, '2019-08-27 13:28:50', 'ismi', 'karyawan', 'master rembes', 'hapus data', 'ads'),
(405, '2019-08-27 13:29:18', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(406, '2019-08-27 13:30:36', 'admin', 'admin', 'user', 'login', 'admin'),
(407, '2019-08-27 13:40:49', 'admin', 'admin', 'jenis identitas', 'tambah data', 'qw'),
(408, '2019-08-27 13:40:54', 'admin', 'admin', 'jenis identitas', 'hapus data', 'qw'),
(409, '2019-08-27 13:41:07', 'admin', 'admin', 'jenis bank', 'tambah data', 'qw'),
(410, '2019-08-27 13:41:11', 'admin', 'admin', 'jenis bank', 'hapus data', 'qw'),
(411, '2019-08-27 13:41:19', 'admin', 'admin', 'user', 'logout', 'admin'),
(412, '2019-08-28 00:39:14', 'admin', 'admin', 'user', 'login', 'admin'),
(413, '2019-08-28 00:53:28', 'admin', 'admin', 'user', 'logout', 'admin'),
(414, '2019-08-28 00:53:33', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(415, '2019-08-28 01:04:48', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(416, '2019-08-28 01:04:53', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(417, '2019-08-28 02:14:20', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(418, '2019-08-28 11:51:11', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(419, '2019-08-28 11:51:59', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(420, '2019-08-28 11:52:09', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(421, '2019-08-28 12:00:29', 'nocola', 'perusahaan', 'karyawan', 'hapus data', 'coba'),
(422, '2019-08-28 12:18:58', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(423, '2019-08-28 12:19:03', 'coba', 'karyawan', 'user', 'login', 'coba'),
(424, '2019-08-28 12:19:27', 'coba', 'karyawan', 'master rembes', 'tambah data', 'op'),
(425, '2019-08-28 12:20:03', 'coba', 'karyawan', 'nota rembes', 'tambah data', '.'),
(426, '2019-08-28 12:20:40', 'coba', 'karyawan', 'nota rembes', 'tambah data', 'bensin motor'),
(427, '2019-08-28 12:21:04', 'coba', 'karyawan', 'nota rembes', 'update data', 'alat tulis'),
(428, '2019-08-28 12:21:16', 'coba', 'karyawan', 'nota rembes', 'update data', 'alat tulis'),
(429, '2019-08-28 12:21:40', 'coba', 'karyawan', 'master rembes', 'tambah data', 'kl'),
(430, '2019-08-28 12:22:10', 'coba', 'karyawan', 'nota rembes', 'tambah data', 'bakso'),
(431, '2019-08-28 12:30:38', 'coba', 'karyawan', 'nota rembes', 'tambah data', 'k'),
(432, '2019-08-28 12:33:39', 'coba', 'karyawan', 'nota rembes', 'hapus data', 'k'),
(433, '2019-08-28 12:49:02', 'coba', 'karyawan', 'master rembes', 'tambah data', 'ashjdf'),
(434, '2019-08-28 12:49:12', 'coba', 'karyawan', 'nota rembes', 'tambah data', '234'),
(435, '2019-08-28 12:53:18', 'coba', 'karyawan', 'user', 'logout', 'coba'),
(436, '2019-08-28 12:53:24', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(437, '2019-08-28 12:53:44', 'nocola', 'perusahaan', 'karyawan', 'hapus data', 'coba'),
(438, '2019-08-28 12:53:49', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(439, '2019-08-28 12:53:57', 'coba', 'karyawan', 'user', 'login', 'coba'),
(440, '2019-08-28 13:12:22', 'coba', 'karyawan', 'user', 'logout', 'coba'),
(441, '2019-08-28 13:13:15', 'coba', 'karyawan', 'user', 'login', 'coba'),
(442, '2019-08-28 13:13:47', 'coba', 'karyawan', 'user', 'logout', 'coba'),
(443, '2019-08-28 13:13:54', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(444, '2019-08-28 13:26:02', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(445, '2019-08-28 13:26:05', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(446, '2019-08-28 13:26:31', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(447, '2019-08-28 13:30:00', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(448, '2019-08-28 13:31:00', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(449, '2019-08-28 13:31:04', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(450, '2019-08-28 13:43:16', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(451, '2019-08-28 13:43:21', 'coba', 'karyawan', 'user', 'login', 'coba'),
(452, '2019-08-28 13:44:05', 'coba', 'karyawan', 'master rembes', 'tambah data', 'mengadakan rapat di pt bersama jakarta'),
(453, '2019-08-28 13:44:37', 'coba', 'karyawan', 'nota rembes', 'tambah data', 'kembar-kembar bintang lima'),
(454, '2019-08-28 13:44:53', 'coba', 'karyawan', 'user', 'logout', 'coba'),
(455, '2019-08-28 13:45:01', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(456, '2019-08-28 13:46:04', 'nocola', 'perusahaan', 'karyawan', 'hapus data', 'coba'),
(457, '2019-08-28 13:47:45', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(458, '2019-08-28 13:47:49', 'admin', 'admin', 'user', 'login', 'admin'),
(459, '2019-08-28 13:48:07', 'admin', 'admin', 'user', 'logout', 'admin'),
(460, '2019-08-28 13:48:12', 'fantech', 'perusahaan', 'user', 'login', 'fantech'),
(461, '2019-08-28 13:48:37', 'fantech', 'perusahaan', 'user', 'logout', 'fantech'),
(462, '2019-08-28 13:48:43', 'x9thor', 'karyawan', 'user', 'login', 'x9thor'),
(463, '2019-08-28 13:48:58', 'x9thor', 'karyawan', 'user', 'logout', 'x9thor'),
(464, '2019-08-28 13:49:09', 'fantech', 'perusahaan', 'user', 'login', 'fantech'),
(465, '2019-08-28 13:49:25', 'fantech', 'perusahaan', 'karyawan', 'hapus data', 'x9 Thor'),
(466, '2019-08-28 13:49:38', 'fantech', 'perusahaan', 'user', 'logout', 'fantech'),
(467, '2019-08-28 13:49:43', 'admin', 'admin', 'user', 'login', 'admin'),
(468, '2019-08-28 13:50:04', 'admin', 'admin', 'user', 'logout', 'admin'),
(469, '2019-08-28 13:50:07', 'ismi', 'karyawan', 'user', 'login', 'ismi'),
(470, '2019-08-28 13:59:25', 'ismi', 'karyawan', 'nota rembes', 'tambah data', 'kereta api'),
(471, '2019-08-28 14:00:20', 'ismi', 'karyawan', 'master rembes', 'hapus data', 'Penyerahan projek kerja di jember'),
(472, '2019-08-28 14:00:52', 'ismi', 'karyawan', 'master rembes', 'hapus data', 'Penyerahan projek kerja di jember'),
(473, '2019-08-28 14:01:29', 'ismi', 'karyawan', 'master rembes', 'hapus data', 'workshop'),
(474, '2019-08-28 14:02:30', 'ismi', 'karyawan', 'nota rembes', 'tambah data', 'Babeh ayam geprek'),
(475, '2019-08-28 14:03:28', 'ismi', 'karyawan', 'nota rembes', 'tambah data', 'bensin motor '),
(476, '2019-08-28 14:04:22', 'ismi', 'karyawan', 'user', 'logout', 'ismi'),
(477, '2019-08-28 14:04:33', 'nocola', 'perusahaan', 'user', 'login', 'nocola'),
(478, '2019-08-28 14:05:23', 'nocola', 'perusahaan', 'user', 'logout', 'nocola'),
(479, '2019-08-28 14:05:30', 'puput', 'karyawan', 'user', 'login', 'puput'),
(480, '2019-08-28 14:06:05', 'puput', 'karyawan', 'nota rembes', 'tambah data', 'bensin mobil pertamax'),
(481, '2019-08-28 14:06:45', 'puput', 'karyawan', 'nota rembes', 'tambah data', 'yang enak enak'),
(482, '2019-08-28 14:07:39', 'puput', 'karyawan', 'nota rembes', 'tambah data', 'listrik ternyata belum bayar'),
(483, '2019-08-28 14:08:04', 'puput', 'karyawan', 'master rembes', 'submit kegiatan', 'Seminar nasional'),
(484, '2019-08-28 14:08:35', 'puput', 'karyawan', 'nota rembes', 'tambah data', 'bus'),
(485, '2019-08-28 14:08:42', 'puput', 'karyawan', 'user', 'logout', 'puput'),
(486, '2019-08-28 14:08:47', 'nocola', 'perusahaan', 'user', 'login', 'nocola');

-- --------------------------------------------------------

--
-- Table structure for table `tb_master_rembes`
--

CREATE TABLE `tb_master_rembes` (
  `id_master_rembes` int(11) NOT NULL,
  `nama_kegiatan` text NOT NULL,
  `uang_lumpsum` int(11) NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `jenis_bank` varchar(50) NOT NULL,
  `nama_rekening` varchar(40) NOT NULL,
  `no_rekening` varchar(40) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `submit` enum('0','1') NOT NULL,
  `tanggal_submit` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `tanggal_klaim` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_master_rembes`
--

INSERT INTO `tb_master_rembes` (`id_master_rembes`, `nama_kegiatan`, `uang_lumpsum`, `tanggal_kegiatan`, `id_karyawan`, `jenis_bank`, `nama_rekening`, `no_rekening`, `status`, `submit`, `tanggal_submit`, `tanggal_selesai`, `tanggal_klaim`) VALUES
(42, 'workshop keagamaan', 0, '2019-08-03', 18, '', '', '', '0', '0', '0000-00-00', '0000-00-00', '0000-00-00'),
(46, 'Hotel bintang lima', 500000, '2019-08-03', 19, '', '', '', '0', '0', '0000-00-00', '0000-00-00', '0000-00-00'),
(47, 'DInas pengunjungan perusahaan software host nocola', 300000, '2019-08-03', 19, '', '', '', '0', '0', '0000-00-00', '0000-00-00', '2019-08-03'),
(48, 'Workshop di serang', 100000, '2019-08-02', 19, '', '', '', '0', '0', '2019-08-05', '2019-08-05', '2019-08-05'),
(49, 'seminar di jakarta', 400000, '2019-08-03', 19, '', '', '', '0', '0', '2019-08-05', '2019-08-05', '0000-00-00'),
(50, 'ziaroh', 900000, '2019-08-04', 23, '', '', '', '0', '0', '0000-00-00', '0000-00-00', '0000-00-00'),
(51, 'Piket pagi', 30000, '2019-08-05', 19, '', '', '', '0', '0', '2019-08-05', '2019-08-05', '2019-08-05'),
(52, 'utang', 10000, '2019-08-06', 19, '', '', '', '0', '0', '0000-00-00', '0000-00-00', '0000-00-00'),
(53, 'Dinas ke serang banten', 700000, '2019-08-06', 24, '', '', '', '0', '0', '0000-00-00', '0000-00-00', '0000-00-00'),
(54, 'Seminar besar di Cilacap', 20000, '2019-08-04', 24, '', '', '', '0', '0', '0000-00-00', '0000-00-00', '0000-00-00'),
(55, 'kunjungan kerja ke google indonesia', 2000000, '2019-08-08', 24, '', '', '', '0', '0', '2019-08-27', '2019-08-27', '2019-08-15'),
(56, 'meeting para karyawan', 570000, '2019-08-08', 24, '', '', '', '0', '0', '0000-00-00', '0000-00-00', '2019-08-05'),
(59, 'Persiapan pergi ke luar negri (Amerika) tidak lama kemudian berangkat dan meninggalkan indonesia tanah air ', 8900, '2019-08-15', 24, '', '', '', '0', '0', '2019-08-15', '2019-08-15', '2019-08-15'),
(66, 'seminar', 170000, '2019-08-16', 28, '', '', '', '0', '0', '2019-08-16', '2019-08-20', '2019-08-16'),
(67, 'Pertemuan programmer seluruh indonesia', 890000, '2019-08-17', 30, '', '', '', '0', '0', '0000-00-00', '0000-00-00', '0000-00-00'),
(68, 'Rapat pertemuan partner perusahaan di jakarta', 4110000, '2019-08-26', 17, '', '', '', '0', '0', '2019-08-26', '2019-08-26', '0000-00-00'),
(69, 'Seminar nasional', 900000, '2019-08-26', 17, '', '', '', '0', '1', '2019-08-28', '2019-08-28', '0000-00-00'),
(70, ' awagan bae ws', 92000, '2019-08-27', 29, '', '', '', '0', '0', '2019-08-27', '2019-08-27', '0000-00-00'),
(72, 'Penyerahan projek kerja di jember', 1430000, '2019-08-21', 24, '', '', '', '0', '0', '0000-00-00', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_perusahaan`
--

CREATE TABLE `tb_perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_perusahaan` varchar(30) NOT NULL,
  `alamat_perusahaan` text NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `email_perusahaan` varchar(50) NOT NULL,
  `approvment` enum('0','1') NOT NULL,
  `trash` enum('0','1') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_perusahaan`
--

INSERT INTO `tb_perusahaan` (`id_perusahaan`, `id_user`, `nama_perusahaan`, `alamat_perusahaan`, `no_telepon`, `email_perusahaan`, `approvment`, `trash`, `created_at`, `updated_at`) VALUES
(9, 31, 'PT. Nocola IoT Solution', 'Jl. Ir. H. Juanda No.117, Rawagaru, Sidanegara, Kec. Cilacap Tengah, Kabupaten Cilacap, Jawa Tengah 53223', '098755678328239', 'nocola@gmail.com', '1', '0', '2019-08-02 10:51:22', '2019-08-26 17:11:58'),
(10, 34, 'omah koding', 'semarang', '08456747389', 'omah_coding@gmail.com', '1', '0', '2019-08-03 11:32:34', '2019-08-04 03:10:27'),
(12, 46, 'media', 'semarang', '0723645', 'media@gmail.com', '0', '0', '2019-08-10 10:27:26', '2019-08-10 10:27:26'),
(24, 71, 'dfghjkl', 'df', '678492', '3456789@gmail.com', '0', '1', '2019-08-10 12:05:26', '2019-08-10 12:05:26'),
(25, 72, 'ismynr.xyz', 'kjasjjdf', '0987653', 'ismynr.xyz@gmail.com', '1', '0', '2019-08-10 12:19:37', '2019-08-10 12:19:37'),
(26, 74, 'PT Makmur Jaya Abadi', 'jl. karangsari barat kec. pulosari, kab. pemalang, prov. jawa tengah, Indonesia, Asia Tenggara', '098765432123', 'budiutomo@gmail.com', '1', '0', '2019-08-16 15:39:00', '2019-08-16 16:05:26'),
(27, 81, 'fantech', 'fantech', '03489834589', 'fantech@gmail.com', '1', '0', '2019-08-17 18:50:46', '2019-08-17 18:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rembes`
--

CREATE TABLE `tb_rembes` (
  `id_rembes` int(11) NOT NULL,
  `id_master_rembes` int(11) NOT NULL,
  `nama_rembes` varchar(30) NOT NULL,
  `tanggal_rembes` date NOT NULL,
  `total_rembes` int(11) NOT NULL,
  `foto_nota` varchar(200) NOT NULL,
  `jenis_nota` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rembes`
--

INSERT INTO `tb_rembes` (`id_rembes`, `id_master_rembes`, `nama_rembes`, `tanggal_rembes`, `total_rembes`, `foto_nota`, `jenis_nota`) VALUES
(85, 72, 'kereta api', '2019-08-28', 400000, '5842bfe1e8395bb7c4088d39b7ed1aad.jpg', 'Transportasi'),
(86, 56, 'Babeh ayam geprek', '2019-08-28', 6100000, 'e6be83c992127ea5e3b3207546d081ea.jpg', 'Makan'),
(87, 56, 'bensin motor ', '2019-08-28', 20000, 'b4fa1dc804b44cacfbd0a3c940b8dd30.jpg', 'Transportasi'),
(88, 69, 'bensin mobil pertamax', '2019-08-28', 320000, '65577f8fe75f9fde4ff161620a2a9951.jpg', 'Bahan Bakar'),
(89, 69, 'yang enak enak', '2019-08-28', 50000, 'a2693941b7665f4732ef2557c504fc19.jpg', 'Makan'),
(90, 69, 'listrik ternyata belum bayar', '2019-08-28', 760000, '8b5ae662c1f58a37a3d810d021fb6aea.jpg', 'Tagihan'),
(91, 68, 'bus', '2019-08-28', 430000, '02399621d78b6b3bd667c99944a8903a.jpg', 'Tiket');

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`id_role`, `role`) VALUES
(1, 'admin'),
(2, 'perusahaan'),
(3, 'karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int(11) NOT NULL,
  `trash` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `logged_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `id_role`, `trash`, `created_at`, `updated_at`, `logged_at`) VALUES
(26, 'ardata', '$2y$10$Z8ClO/tyDb.66PWNcVvNDOpFyH4qKfD/u0EKGkNf0z.0gLVulbq8S', 2, 0, '2019-08-02 05:22:09', '2019-08-02 05:22:09', '0000-00-00 00:00:00'),
(27, 'admin', '$2y$10$BIpoiC2QIF49qsSUNTvrDeDuLnbi2UI1vYEB2juVIjzVBc1bAieuu', 1, 0, '2019-08-02 05:33:19', '2019-08-06 10:41:50', '2019-08-28 20:49:43'),
(31, 'nocola', '$2y$10$L4eZuxmxEnc.8qjroL0ffu.wC94WTsAUU4uDKt4.z4iMZMrYs6m7q', 2, 0, '2019-08-02 10:51:22', '2019-08-14 00:51:20', '2019-08-28 21:08:47'),
(32, 'puput', '$2y$10$YsxoEnM9P/BsMi79uOAOEu4Ra0/eKAg2qw7JcTlR.dbyMKGSw3Dpm', 3, 0, '2019-08-02 11:35:51', '2019-08-05 02:05:27', '2019-08-28 21:05:30'),
(33, 'rio', '$2y$10$b7us8ACvUXXfJLa/6BOyMu6Hl6FG41X13jFwqPMKb7VDQwnKaBq.G', 3, 0, '2019-08-02 11:37:15', '2019-08-02 11:37:15', '0000-00-00 00:00:00'),
(34, 'omah', '$2y$10$LnpvQVIv.eMpJ7oqjO2mhew1PkXu/5LukmHpe445xVwskpV7coOwy', 2, 0, '2019-08-03 11:32:34', '2019-08-03 11:32:34', '0000-00-00 00:00:00'),
(35, 'risma', '$2y$10$gmpeQEroBknd9vDWsKypa.VyQNK/dEfZJIC7d8vY8Jl2ZObG3uPbq', 3, 0, '2019-08-03 11:33:42', '2019-08-03 11:33:42', '0000-00-00 00:00:00'),
(36, 'diyas', '$2y$10$mGAfRdUDHS4STPQyQPOooeVXvt.eYxfesIcmid0Q/dn0eC4X/dBjm', 3, 0, '2019-08-03 11:34:00', '2019-08-03 11:34:00', '0000-00-00 00:00:00'),
(37, 'indri', '$2y$10$43gmke3eMGjH/E434l9Vz.5bsnXsaCylTul65RtkABQQsTevwKyG.', 3, 0, '2019-08-03 11:34:16', '2019-08-03 11:34:16', '0000-00-00 00:00:00'),
(39, 'nrnr', '$2y$10$hv0vNuQlRAkfBiXv3b11oOzH1YlgD.I3XKbGMFJvKQHJjqBTyaoMK', 3, 0, '2019-08-04 02:20:50', '2019-08-04 02:20:50', '0000-00-00 00:00:00'),
(41, 'msms', '$2y$10$.4s2yqWaOBniQYj2Jjjc6OB3sjPhJ8woFNQUjPfldTuKNPfQUa8qa', 2, 0, '2019-08-04 16:46:44', '2019-08-04 16:46:44', '0000-00-00 00:00:00'),
(42, 'ismi', '$2y$10$lneMtWqbO22gQ4OoyAnmo.hIIqkheGEeD5JDL/jcg3fhlC0DBQIFW', 3, 0, '2019-08-05 02:09:26', '2019-08-25 08:09:34', '2019-08-28 20:50:07'),
(43, 'anisa', '$2y$10$GXMQ8Ks/UPW/T6LPSjIecO6o1ab9jeESpsghKiXY5hsB5eHBqsmP.', 3, 0, '2019-08-05 02:09:56', '2019-08-05 02:09:56', '0000-00-00 00:00:00'),
(46, 'media', '$2y$10$jJJwggrpPurJJoCHHSTFgOmzhR1RuTr20YrhtPMR4qRvQ6uB7A6KO', 2, 0, '2019-08-10 10:27:26', '2019-08-10 10:27:26', '0000-00-00 00:00:00'),
(71, '82964', '$2y$10$fweIYHkMXJDDh5Vdk4n6kOL8sJJ6AZN.ebgHwgNjLPSagQZ64hMUW', 2, 0, '2019-08-10 12:05:26', '2019-08-10 12:05:26', '0000-00-00 00:00:00'),
(72, 'ismynr', '$2y$10$rTftBqDurolLLdEKJ93gpem/AITyz.r833OxXZp9kaPerxc5CU.oG', 2, 0, '2019-08-10 12:19:37', '2019-08-10 11:07:35', '0000-00-00 00:00:00'),
(74, 'budi', '$2y$10$iOqicJPx0sA9JFetJWgetOd5CcmdJjc2ZILHE0S2md38wgOlYWTbi', 2, 0, '2019-08-16 15:39:00', '2019-08-16 16:05:59', '2019-08-16 16:16:17'),
(79, 'abuabu', '$2y$10$vkyVvhwZoBucNnWrim3LjO4pabfaSWKSrZFZSFT0YbAmFPlfYB6la', 3, 0, '2019-08-16 15:51:55', '2019-08-16 15:51:55', '0000-00-00 00:00:00'),
(80, 'zilong', '$2y$10$Dww.EtmS2pWuCZw8L16lOebTG5Dql.FwFJ5XJ2DlFAxtmCgtRElSG', 3, 0, '2019-08-16 15:53:14', '2019-08-16 16:08:43', '2019-08-16 16:17:23'),
(81, 'fantech', '$2y$10$PMfyaKZqG2tYwt4q2TxQROReddKlHhAHOlVinLaTwEu7EB.A1Of1i', 2, 0, '2019-08-17 18:50:46', '2019-08-17 18:50:46', '2019-08-28 20:49:09'),
(82, 'x5zeus', '$2y$10$X1P4iFTROWu.3ikNTegkwu2hAVRemoXvBcgH8WNApbomcCvwYXwke', 3, 0, '2019-08-17 19:04:15', '2019-08-17 19:04:15', '2019-08-27 08:51:23');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_token`
--

CREATE TABLE `tb_user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user_token`
--

INSERT INTO `tb_user_token` (`id`, `email`, `token`, `created_at`) VALUES
(2, 'ismynr.xyz@gmail.com', 'a/qDhvnPCOshKtmoOt2kt9fTz/e3JCEiAcBEphRGoD8=', '2019-08-10 12:24:04'),
(3, 'ismynr.xyz@gmail.com', 'C1dpZf49N/7ufHdapjMq5NjZQbe118cB/YoN2EDBDAM=', '2019-08-10 16:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `web_config`
--

CREATE TABLE `web_config` (
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `web_config`
--

INSERT INTO `web_config` (`key`, `value`) VALUES
('DESKRIPSI', 'Sistem guna mengklaim dana yang digunakan oleh karyawan untuk keperluan atau kepentingan perusahaan'),
('EMAIL_KONTAK', 'anisapandundis1@gmail.com'),
('FAVICON', 'logo1.png'),
('LOGO', 'logo2.png'),
('SITE_NAME', 'Rembesin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_jenis_bank`
--
ALTER TABLE `tb_jenis_bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `tb_jenis_identitas`
--
ALTER TABLE `tb_jenis_identitas`
  ADD PRIMARY KEY (`id_identitas`);

--
-- Indexes for table `tb_jenis_nota`
--
ALTER TABLE `tb_jenis_nota`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `tb_master_rembes`
--
ALTER TABLE `tb_master_rembes`
  ADD PRIMARY KEY (`id_master_rembes`);

--
-- Indexes for table `tb_perusahaan`
--
ALTER TABLE `tb_perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `tb_rembes`
--
ALTER TABLE `tb_rembes`
  ADD PRIMARY KEY (`id_rembes`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_user_token`
--
ALTER TABLE `tb_user_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_config`
--
ALTER TABLE `web_config`
  ADD PRIMARY KEY (`key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_jenis_bank`
--
ALTER TABLE `tb_jenis_bank`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_jenis_identitas`
--
ALTER TABLE `tb_jenis_identitas`
  MODIFY `id_identitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_jenis_nota`
--
ALTER TABLE `tb_jenis_nota`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=487;

--
-- AUTO_INCREMENT for table `tb_master_rembes`
--
ALTER TABLE `tb_master_rembes`
  MODIFY `id_master_rembes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `tb_perusahaan`
--
ALTER TABLE `tb_perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_rembes`
--
ALTER TABLE `tb_rembes`
  MODIFY `id_rembes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tb_user_token`
--
ALTER TABLE `tb_user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
