-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 09, 2026 at 06:28 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `traker_polije`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_alumni`
--

CREATE TABLE `data_alumni` (
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_email` int NOT NULL DEFAULT '0' COMMENT 'Apakah email ditampilkan ke publik',
  `no_telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_telepon` int NOT NULL DEFAULT '0' COMMENT 'Apakah no HP ditampilkan ke publik',
  `lama_tunggu_kerja` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_lulus` int DEFAULT NULL,
  `jabatan_sekarang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_sampul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_alumni`
--

INSERT INTO `data_alumni` (`nim`, `prodi`, `nama`, `alamat`, `jenis_kelamin`, `email`, `show_email`, `no_telepon`, `show_telepon`, `lama_tunggu_kerja`, `tahun_lulus`, `jabatan_sekarang`, `foto_profile`, `foto_sampul`, `created_at`, `updated_at`) VALUES
('A0001', 'MID', 'Alumni 1', 'Surabaya', 'Laki-laki', 'alumni1@gmail.com', 0, '08123784038', 0, '6 bulan', 20210508, 'Software Engineer', 'default.jpg', 'cover.jpg', '2026-05-08 10:30:50', '2026-05-08 10:30:50'),
('A0002', 'TI', 'Alumni 2', 'Surabaya', 'Perempuan', 'alumni2@gmail.com', 0, '08123826527', 0, '2 bulan', 20220508, 'Software Engineer', 'default.jpg', 'cover.jpg', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
('A0003', 'TI', 'Alumni 3', 'Surabaya', 'Laki-laki', 'alumni3@gmail.com', 0, '08123390435', 0, '1 bulan', 20220508, 'Software Engineer', 'default.jpg', 'cover.jpg', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
('A0004', 'TI', 'Alumni 4', 'Surabaya', 'Perempuan', 'alumni4@gmail.com', 0, '08123334073', 0, '1 bulan', 20220508, 'Software Engineer', 'default.jpg', 'cover.jpg', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
('A0005', 'TI', 'Alumni 5', 'Surabaya', 'Laki-laki', 'alumni5@gmail.com', 0, '08123208312', 0, '3 bulan', 20220508, 'Software Engineer', 'default.jpg', 'cover.jpg', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
('A0006', 'TI', 'Alumni 6', 'Surabaya', 'Perempuan', 'alumni6@gmail.com', 0, '08123785240', 0, '5 bulan', 20210508, 'Software Engineer', 'default.jpg', 'cover.jpg', '2026-05-08 10:30:52', '2026-05-08 10:30:52'),
('A0007', 'TI', 'Alumni 7', 'Surabaya', 'Laki-laki', 'alumni7@gmail.com', 0, '08123206735', 0, '6 bulan', 20240508, 'Software Engineer', 'default.jpg', 'cover.jpg', '2026-05-08 10:30:52', '2026-05-08 10:30:52'),
('A0008', 'TI', 'Alumni 8', 'Surabaya', 'Perempuan', 'alumni8@gmail.com', 0, '08123183804', 0, '6 bulan', 20230508, 'Software Engineer', 'default.jpg', 'cover.jpg', '2026-05-08 10:30:52', '2026-05-08 10:30:52'),
('A0009', 'TI', 'Alumni 9', 'Surabaya', 'Laki-laki', 'alumni9@gmail.com', 0, '08123459018', 0, '6 bulan', 20230508, 'Software Engineer', 'default.jpg', 'cover.jpg', '2026-05-08 10:30:53', '2026-05-08 10:30:53'),
('A0010', 'TI', 'Alumni 10', 'Surabaya', 'Perempuan', 'alumni10@gmail.com', 0, '08123302101', 0, '4 bulan', 20220508, 'Software Engineer', 'default.jpg', 'cover.jpg', '2026-05-08 10:30:53', '2026-05-08 10:30:53'),
('E41211962', 'TI', 'Lya Nurul Ulla', 'Jember', '', 'E41211962@student.polije.ac.id', 0, '81554529226', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41211990', 'TI', 'Rangga Raditya Nugroho', 'Apart. Puncak CBD, Jl. Keramat I, Jajar Tunggal, Kec. Wiyung, Surabaya', '', 'E41211990@student.polije.ac.id', 0, '81217531945', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41211994', 'TI', 'Ach Fasihul Lisan', 'JL. KH. MOCH. KHOLIL IIIE/1', '', 'E41211994@student.polije.ac.id', 0, '85336076077', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212003', 'TI', 'Mohammad Dwiky Riza Ardana', 'Jl. Joyoboyo, RT.05/RW.03, Kalirang Selatan, Kalirong, Kec. Tarokan, Kabupaten Kediri, Jawa Timur 64152', '', 'E41212003@student.polije.ac.id', 0, '85172230915', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212006', 'TI', 'Mochammad Enrique Lazuardi Ramadany', 'Perumtas 2 Blok O6/47, RT 005 RW 007, Kec. Tanggulangin, Kab. Sidoarjo, Jawa Timur', '', 'E41212006@student.polije.ac.id', 0, '87754434901', 0, '', 2025, 'IT Internship', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212007', 'TI', 'Arfan Astaraja', 'Wonosari, RT.01 RW.06, Kel. Bujel, Kec. Mojoroto, Kota Kediri, Jawa Timur', '', 'E41212007@student.polije.ac.id', 0, '85174248344', 0, '', 2025, 'Fullstack Web Developer', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212012', 'TI', 'Haris Asy syauqi', 'Jl R. A Kartini RT/06 RW/02 Gedang-Porong Sidoarjo', '', 'E41212012@student.polije.ac.id', 0, '87735377011', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212013', 'TI', 'Abhinaya Fahar Laila', 'Dukushsari, Jabon, Sidoarjo', '', 'E41212013@student.polije.ac.id', 0, '89679960207', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212015', 'TI', 'Dinda Amalia Julyandri', 'Jl. Karang Tengah rt3 rw 4, Kec. Rengel, Tuban', '', 'E41212015@student.polije.ac.id', 0, '85811915818', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212026', 'TI', 'Bima Prayoga', 'Desa Candipari, Porong', '', 'E41212026@student.polije.ac.id', 0, '89699948423', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212027', 'TI', 'Leovander Aditama Syahputra', 'JL. Raya Kedungturi No.49 RT2 RW1, Taman, Sidoarjo, Jawa Timur', '', 'E41212027@student.polije.ac.id', 0, '8993545433', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212028', 'TI', 'M. Diaz Maulana Dhafin Rizqiandi', 'Jl merpati betro sidoarjo', '', 'E41212028@student.polije.ac.id', 0, '85724130495', 0, '', 2025, 'trainer ekstrakurikuler', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212037', 'TI', 'Bilal Shandyarta Syamsudin', 'Gempol Wonoayu RT 4 RW 6', '', 'E41212037@student.polije.ac.id', 0, '81230869273', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212044', 'TI', 'Daffa Agung Nugroho', 'JL. Mirah Delima 3, O.15 / 12 C, Kota Baru Driyorejo, Kec. Driyorejo, Gresik, Jawa Timur, 61177', '', 'E41212044@student.polije.ac.id', 0, '82139782160', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212055', 'TI', 'Johan Krisbima Abi', 'desa Mojosulur kecamatan Mojosari kabupaten Mojokerto Jawa Timur', '', 'E41212055@student.polije.ac.id', 0, '87851865091', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212057', 'TI', 'Fachry Rizky Prasetya', 'Graha Bumi Pertiwi A-14, Pepe, Sedati, Sidoarjo', '', 'E41212057@student.polije.ac.id', 0, '89523418523', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212058', 'TI', 'Moch Ghazy Al Ghifari Hafid', 'JL. KH. MOCH YASIN BLOK BA.10 LINGK. WONOSARI RT/RW 004/001 KEC. KALIWATES KAB. JEMBER', '', 'E41212058@student.polije.ac.id', 0, '85707286438', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212060', 'TI', 'Octavian Dava Putra Cahyono', 'Dsn Bangunsari RT.008 RW.004 Ds. Tambak kalisogo kec. Jabon kab. Sidoarjo', '', 'E41212060@student.polije.ac.id', 0, '85748437032', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212079', 'TI', 'Fadlil Liwaul Hamdi', 'jl banjar melati, pabean, sedati, sidoarjo, Jawa timur', '', 'E41212079@student.polije.ac.id', 0, '81807440352', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212081', 'TI', 'Cahaya Citra Azzahro', 'Bumi Sedati Indah E7, Pepe, Sedati, Sidoarjo', '', 'E41212081@student.polije.ac.id', 0, '85707146742', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212093', 'TI', 'Abdulloh Haidar Azzam Ash\'Shobir', 'Pandean RT 5 RW 1, Banjarkemantren, Buduran, SIdoarjo (61252)', '', 'E41212093@student.polije.ac.id', 0, '81336124535', 0, '', 2025, 'IT Support', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212104', 'TI', 'Niecola Jody Setiawan', 'Damar wulan Gg. 1 jl. Damar wulan Dsn. /Ds. /Kec. Trowulan Kab. Mojokerto', '', 'E41212104@student.polije.ac.id', 0, '81216773138', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212105', 'TI', 'Fatkhul Hidayah', 'Dsn. Jipangan Ds. Kutorejo Kec. Bagor Kab. Nganjuk', '', 'E41212105@student.polije.ac.id', 0, '87854119217', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212120', 'TI', 'Fatkhur Rozak', 'Jl. H. Mawardi, Jerukgamping, Sidoarjo (61262)', '', 'E41212120@student.polije.ac.id', 0, '85784464441', 0, '', 2025, 'Fullstack Developer', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212125', 'TI', 'Dina Dwi Arika', 'Tuban, Jawa Timur', '', 'E41212125@student.polije.ac.id', 0, '895365015175', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212126', 'TI', 'Marzuki Akmal', 'Jl. A Yani No.30 Sepanjang, Taman, Sidoarjo', '', 'E41212126@student.polije.ac.id', 0, '85895645840', 0, '', 2025, 'IT Developer', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212132', 'TI', 'Miftahur Rahman', 'Jl. Syamsul Arifin kec.karangdalem kab.Sampang', '', 'E41212132@student.polije.ac.id', 0, '71936273469', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212137', 'TI', 'Agil Gilang Chandra Saputra', 'Desa Nglundo Kec. Sukomoro Kab. Nganjuk Jawa Timur', '', 'E41212137@student.polije.ac.id', 0, '81515011039', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212139', 'TI', 'Jessica Desi Imelda', 'KP. Kendal', '', 'E41212139@student.polije.ac.id', 0, '82230179218', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212161', 'TI', 'Junia Vitasari', 'Tambakkemerakan RT 12 RW 01 Krian Sidoarjo', '', 'E41212161@student.polije.ac.id', 0, '8970946561', 0, '', 2025, 'Fullstack Developer', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212165', 'TI', 'Lukman', 'Jln. Hasanuddin RT/03 RW/04', '', 'E41212165@student.polije.ac.id', 0, '81330059485', 0, '', 2025, 'Staff IT', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212201', 'TI', 'Rachmadani Anggowo Rizky', 'Sidoarjo, Taman Pinang Asri Blok M1-16', '', 'E41212201@student.polije.ac.id', 0, '82237592642', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212204', 'TI', 'Muhammad Ferdiansyah Aulia Kusuma', 'Jl. Jati Selatan III Serujo Gg. Banteng, Babatan, Jati, Kec. Sidoarjo, Kabupaten Sidoarjo', '', 'E41212204@student.polije.ac.id', 0, '81905577807', 0, '', 2025, 'Internal Departement & Marketing', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212250', 'TI', 'Herlambang Satria Wijaya', 'Jl. Panglima Sudirman IX/7 kota pasuruan', '', 'E41212250@student.polije.ac.id', 0, '89699603965', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212260', 'TI', 'Rizqi Azizissani', 'Sidoarjo', '', 'E41212260@student.polije.ac.id', 0, '81217630216', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212270', 'TI', 'Moh. Ferdi Andriansyah', 'Banyuwangi', '', 'E41212270@student.polije.ac.id', 0, '81336262502', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212272', 'TI', 'Ahnaf', 'Puri Indah Blok Y-05, Sidoarjo, Jawa Timur', '', 'E41212272@student.polije.ac.id', 0, '8213756339', 0, '', 2025, 'Software Engineer', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212359', 'TI', 'Owen Pratama Endramawan', 'Trenggalek', '', 'E41212359@student.polije.ac.id', 0, '83845936950', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32'),
('E41212403', 'TI', 'Muhammad Shalahudin Ayubi Firmansyah', 'Jl Raya Bringin Wetan Rt 03/Rw 05 No.78 Bringin Bendo Taman Sidoarjo 61257', '', 'E41212403@student.polije.ac.id', 0, '83136844479', 0, '', 2025, '', '', '', '2026-05-08 11:01:32', '2026-05-08 11:01:32');

-- --------------------------------------------------------

--
-- Table structure for table `data_certificate`
--

CREATE TABLE `data_certificate` (
  `id` bigint UNSIGNED NOT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_terbit` date DEFAULT NULL,
  `diterbitkan_oleh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar_serti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kredensial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_certificate`
--

INSERT INTO `data_certificate` (`id`, `nim`, `nama`, `tanggal_terbit`, `diterbitkan_oleh`, `gambar_serti`, `id_kredensial`, `created_at`, `updated_at`) VALUES
(1, 'A0001', 'Sertifikat Laravel 1', '2023-05-08', 'Dicoding', 'sertifikat.jpg', 'xcmAm5hxYY', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
(2, 'A0002', 'Sertifikat Laravel 2', '2024-05-08', 'Dicoding', 'sertifikat.jpg', 'r6mzQBNsjm', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
(3, 'A0003', 'Sertifikat Laravel 3', '2025-05-08', 'Dicoding', 'sertifikat.jpg', 'rOAUjMiuIp', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
(4, 'A0004', 'Sertifikat Laravel 4', '2023-05-08', 'Dicoding', 'sertifikat.jpg', 'QbgwbKaOQT', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
(5, 'A0005', 'Sertifikat Laravel 5', '2023-05-08', 'Dicoding', 'sertifikat.jpg', 'aaXcIOYmcA', '2026-05-08 10:30:52', '2026-05-08 10:30:52'),
(6, 'A0006', 'Sertifikat Laravel 6', '2024-05-08', 'Dicoding', 'sertifikat.jpg', 'LKVkaTvFG6', '2026-05-08 10:30:52', '2026-05-08 10:30:52'),
(7, 'A0007', 'Sertifikat Laravel 7', '2023-05-08', 'Dicoding', 'sertifikat.jpg', 'sibd8JBui6', '2026-05-08 10:30:52', '2026-05-08 10:30:52'),
(8, 'A0008', 'Sertifikat Laravel 8', '2024-05-08', 'Dicoding', 'sertifikat.jpg', 'kVbmQpiRnh', '2026-05-08 10:30:53', '2026-05-08 10:30:53'),
(9, 'A0009', 'Sertifikat Laravel 9', '2024-05-08', 'Dicoding', 'sertifikat.jpg', 'IxmiDLHn8q', '2026-05-08 10:30:53', '2026-05-08 10:30:53'),
(10, 'A0010', 'Sertifikat Laravel 10', '2025-05-08', 'Dicoding', 'sertifikat.jpg', 'QwvDGKbZwS', '2026-05-08 10:30:53', '2026-05-08 10:30:53');

-- --------------------------------------------------------

--
-- Table structure for table `data_pekerjaan`
--

CREATE TABLE `data_pekerjaan` (
  `id` bigint UNSIGNED NOT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobdesk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_masuk` date DEFAULT NULL,
  `tahun_selesai` date DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `logo_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_pekerjaan`
--

INSERT INTO `data_pekerjaan` (`id`, `nim`, `nama_perusahaan`, `status_pekerjaan`, `jobdesk`, `tahun_masuk`, `tahun_selesai`, `deskripsi`, `logo_perusahaan`, `created_at`, `updated_at`) VALUES
(1, 'A0001', 'PT Teknologi 1', 'Full Time', 'Backend Developer', '2025-05-08', NULL, 'Bekerja sebagai developer', 'logo.png', '2026-05-08 10:30:50', '2026-05-08 10:30:50'),
(2, 'A0002', 'PT Teknologi 2', 'Full Time', 'Backend Developer', '2025-05-08', NULL, 'Bekerja sebagai developer', 'logo.png', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
(3, 'A0003', 'PT Teknologi 3', 'Full Time', 'Backend Developer', '2024-05-08', NULL, 'Bekerja sebagai developer', 'logo.png', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
(4, 'A0004', 'PT Teknologi 4', 'Full Time', 'Backend Developer', '2025-05-08', NULL, 'Bekerja sebagai developer', 'logo.png', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
(5, 'A0005', 'PT Teknologi 5', 'Full Time', 'Backend Developer', '2023-05-08', NULL, 'Bekerja sebagai developer', 'logo.png', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
(6, 'A0006', 'PT Teknologi 6', 'Full Time', 'Backend Developer', '2024-05-08', NULL, 'Bekerja sebagai developer', 'logo.png', '2026-05-08 10:30:52', '2026-05-08 10:30:52'),
(7, 'A0007', 'PT Teknologi 7', 'Full Time', 'Backend Developer', '2023-05-08', NULL, 'Bekerja sebagai developer', 'logo.png', '2026-05-08 10:30:52', '2026-05-08 10:30:52'),
(8, 'A0008', 'PT Teknologi 8', 'Full Time', 'Backend Developer', '2024-05-08', NULL, 'Bekerja sebagai developer', 'logo.png', '2026-05-08 10:30:52', '2026-05-08 10:30:52'),
(9, 'A0009', 'PT Teknologi 9', 'Full Time', 'Backend Developer', '2024-05-08', NULL, 'Bekerja sebagai developer', 'logo.png', '2026-05-08 10:30:53', '2026-05-08 10:30:53'),
(10, 'A0010', 'PT Teknologi 10', 'Full Time', 'Backend Developer', '2023-05-08', NULL, 'Bekerja sebagai developer', 'logo.png', '2026-05-08 10:30:53', '2026-05-08 10:30:53');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_sosial`
--

CREATE TABLE `media_sosial` (
  `id` bigint UNSIGNED NOT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_platform` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_medsos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_sosial`
--

INSERT INTO `media_sosial` (`id`, `nim`, `nama_platform`, `link_medsos`, `created_at`, `updated_at`) VALUES
(1, 'A0001', 'LinkedIn', 'https://linkedin.com/in/alumni1', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
(2, 'A0002', 'LinkedIn', 'https://linkedin.com/in/alumni2', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
(3, 'A0003', 'LinkedIn', 'https://linkedin.com/in/alumni3', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
(4, 'A0004', 'LinkedIn', 'https://linkedin.com/in/alumni4', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
(5, 'A0005', 'LinkedIn', 'https://linkedin.com/in/alumni5', '2026-05-08 10:30:52', '2026-05-08 10:30:52'),
(6, 'A0006', 'LinkedIn', 'https://linkedin.com/in/alumni6', '2026-05-08 10:30:52', '2026-05-08 10:30:52'),
(7, 'A0007', 'LinkedIn', 'https://linkedin.com/in/alumni7', '2026-05-08 10:30:52', '2026-05-08 10:30:52'),
(8, 'A0008', 'LinkedIn', 'https://linkedin.com/in/alumni8', '2026-05-08 10:30:53', '2026-05-08 10:30:53'),
(9, 'A0009', 'LinkedIn', 'https://linkedin.com/in/alumni9', '2026-05-08 10:30:53', '2026-05-08 10:30:53'),
(10, 'A0010', 'LinkedIn', 'https://linkedin.com/in/alumni10', '2026-05-08 10:30:53', '2026-05-08 10:30:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_04_151521_create_data_alumni_table', 1),
(5, '2026_05_04_151522_create_data_pekerjaan_table', 1),
(6, '2026_05_04_151522_create_riwayat_pendidikan_table', 1),
(7, '2026_05_04_151523_create_data_certificate_table', 1),
(8, '2026_05_04_151523_create_media_sosial_table', 1),
(9, '2026_05_04_154451_make_email_nullable_in_data_alumni_table', 1),
(10, '2026_05_05_230549_add_prodi_to_data_alumni_table', 1),
(11, '2026_05_07_215108_add_visibility_to_data_alumni_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pendidikan`
--

CREATE TABLE `riwayat_pendidikan` (
  `id` bigint UNSIGNED NOT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_instansi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenjang_pendidikan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_masuk` date DEFAULT NULL,
  `tahun_keluar` date DEFAULT NULL,
  `nilai_akhir` double DEFAULT NULL,
  `judul_skripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riwayat_pendidikan`
--

INSERT INTO `riwayat_pendidikan` (`id`, `nim`, `nama_instansi`, `jenjang_pendidikan`, `jurusan`, `tahun_masuk`, `tahun_keluar`, `nilai_akhir`, `judul_skripsi`, `created_at`, `updated_at`) VALUES
(1, 'A0001', 'Universitas Contoh', 'S1', 'Informatika', '2020-05-08', '2024-05-08', 3.1, 'Sistem Informasi Alumni', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
(2, 'A0002', 'Universitas Contoh', 'S1', 'Informatika', '2020-05-08', '2024-05-08', 3.1, 'Sistem Informasi Alumni', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
(3, 'A0003', 'Universitas Contoh', 'S1', 'Informatika', '2020-05-08', '2024-05-08', 3.7, 'Sistem Informasi Alumni', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
(4, 'A0004', 'Universitas Contoh', 'S1', 'Informatika', '2020-05-08', '2024-05-08', 3.4, 'Sistem Informasi Alumni', '2026-05-08 10:30:51', '2026-05-08 10:30:51'),
(5, 'A0005', 'Universitas Contoh', 'S1', 'Informatika', '2020-05-08', '2024-05-08', 3, 'Sistem Informasi Alumni', '2026-05-08 10:30:52', '2026-05-08 10:30:52'),
(6, 'A0006', 'Universitas Contoh', 'S1', 'Informatika', '2020-05-08', '2024-05-08', 3, 'Sistem Informasi Alumni', '2026-05-08 10:30:52', '2026-05-08 10:30:52'),
(7, 'A0007', 'Universitas Contoh', 'S1', 'Informatika', '2020-05-08', '2024-05-08', 3.2, 'Sistem Informasi Alumni', '2026-05-08 10:30:52', '2026-05-08 10:30:52'),
(8, 'A0008', 'Universitas Contoh', 'S1', 'Informatika', '2020-05-08', '2024-05-08', 3.7, 'Sistem Informasi Alumni', '2026-05-08 10:30:53', '2026-05-08 10:30:53'),
(9, 'A0009', 'Universitas Contoh', 'S1', 'Informatika', '2020-05-08', '2024-05-08', 3.2, 'Sistem Informasi Alumni', '2026-05-08 10:30:53', '2026-05-08 10:30:53'),
(10, 'A0010', 'Universitas Contoh', 'S1', 'Informatika', '2020-05-08', '2024-05-08', 3, 'Sistem Informasi Alumni', '2026-05-08 10:30:53', '2026-05-08 10:30:53');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Alumni',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$CVhApqmbY9C9T34GsFAi1etl6En3FSh9UH9W6PwDpSmoK.Kzg/jnS', 'Admin', NULL, '2026-05-08 10:30:32', '2026-05-08 10:30:32'),
(2, 'E41212139', '$2y$12$cWuyrUcPNCOsZRH62kUh0.nFZA629pvv9CYYvoP6gbXQ1JKK7njze', 'Alumni', NULL, '2026-05-08 10:30:32', '2026-05-08 10:30:32'),
(3, 'E41212060', '$2y$12$V3BMksxhp0Zvzdj6YKcBEuud1IQ6I6klc67eI/86rqESDM.0yoxi.', 'Alumni', NULL, '2026-05-08 10:30:33', '2026-05-08 10:30:33'),
(4, 'E41212058', '$2y$12$EkOFNjmK7UZBE7ny0puDjesTucTpbAjeNF3MZJyPliYzPABjk5ovC', 'Alumni', NULL, '2026-05-08 10:30:33', '2026-05-08 10:30:33'),
(5, 'E41212403', '$2y$12$u7YUaLxUo.rA7TjvzP5iUeNNbb9WEXuQ.yWyZ6mFB56d3FIKDOGvK', 'Alumni', NULL, '2026-05-08 10:30:34', '2026-05-08 10:30:34'),
(6, 'E41212105', '$2y$12$8ysoM3smjUPZ3j3ohqdndehCiS3mLp4kt5AVzVfLJFyCukgZdU7HO', 'Alumni', NULL, '2026-05-08 10:30:34', '2026-05-08 10:30:34'),
(7, 'E41212037', '$2y$12$2RmoKQnJSaepEUqLZM5ktu1v5jKpWJb3Xe49dbyxtDsD1kHrcikEy', 'Alumni', NULL, '2026-05-08 10:30:35', '2026-05-08 10:30:35'),
(8, 'E41212125', '$2y$12$AKBJq1va6XeyDinwkgywwODMJMpPJHVoqpc7dO/7q0g.wdd.Jth/S', 'Alumni', NULL, '2026-05-08 10:30:35', '2026-05-08 10:30:35'),
(9, 'E41212270', '$2y$12$YAsnWCI5MX6rNyXe7kACLeV4HcDOZiwFWjcPryYuS5isy18xNoUIm', 'Alumni', NULL, '2026-05-08 10:30:36', '2026-05-08 10:30:36'),
(10, 'E41212359', '$2y$12$tAW5F0jwDQ6Ho8dAMSFck.w6Qsi/1DVD/0yd4Sgfb/llySlbuMRNO', 'Alumni', NULL, '2026-05-08 10:30:36', '2026-05-08 10:30:36'),
(11, 'E41212003', '$2y$12$CoLqJc9lXn0DKjqE9zPoXO.Yb.ju37ULzt9u/kLh2srEnJHKUHErO', 'Alumni', NULL, '2026-05-08 10:30:37', '2026-05-08 10:30:37'),
(12, 'E41212012', '$2y$12$WERzVbsBb2r1byVMvCXEfuyVF4i8sabRw9U955z9smu8r5eZljSXS', 'Alumni', NULL, '2026-05-08 10:30:37', '2026-05-08 10:30:37'),
(13, 'E41212081', '$2y$12$IMZ/oob3WdbBC.LllGTo2.LrOPkjY3T26JX3FaMxvcx8QRqHksKHy', 'Alumni', NULL, '2026-05-08 10:30:37', '2026-05-08 10:30:37'),
(14, 'E41212055', '$2y$12$0JpluzS8ixztt7SRAA..0.efyaCAhjbf4tK.W.JTjG7CjZ/j20r2u', 'Alumni', NULL, '2026-05-08 10:30:38', '2026-05-08 10:30:38'),
(15, 'E41211962', '$2y$12$Mnxl0K6fPQHUWuMRnC3r6OoFnqOywh46sqRqgp8AUwI.AurkKjqz2', 'Alumni', NULL, '2026-05-08 10:30:39', '2026-05-08 10:30:39'),
(16, 'E41212204', '$2y$12$4ENJ3sNqKYJJfzglCwOVA.QsSKWfin5gMc80BjrsZmz9JuLXr1GPO', 'Alumni', NULL, '2026-05-08 10:30:39', '2026-05-08 10:30:39'),
(17, 'E41212015', '$2y$12$EXTxkf/XqQZmX527nTZVMuOTdHXgMipsPDV0bT3GHwB.Jl88OqQnS', 'Alumni', NULL, '2026-05-08 10:30:40', '2026-05-08 10:30:40'),
(18, 'E41212007', '$2y$12$H88k6nj9yaknUvGf9ckmAO.HY9QsglCmPgOypLJBDKR1Po0R1W57O', 'Alumni', NULL, '2026-05-08 10:30:40', '2026-05-08 10:30:40'),
(19, 'E41212044', '$2y$12$n/JJhIkz4k0qiG3TlJBJHOwisK09ZSraBME548OJ2RZbcYFL7XWde', 'Alumni', NULL, '2026-05-08 10:30:41', '2026-05-08 10:30:41'),
(20, 'E41212250', '$2y$12$zM7gMq7AjgRXCOTPs3oCb.3oYUYqhMc1Ma5Uj8P51UGicOXJ9lpJa', 'Alumni', NULL, '2026-05-08 10:30:41', '2026-05-08 10:30:41'),
(21, 'E41212079', '$2y$12$Aiv4eXI4/h7ZVBX74ZIMoeU03T2CKy4jZJD7NqXcWY7qh/j/dnrwW', 'Alumni', NULL, '2026-05-08 10:30:41', '2026-05-08 10:30:41'),
(22, 'E41211994', '$2y$12$veIriqCyga11vBvdkwV5TuzMaZLIuw7XoQ4mG1zMQG1gDpc8g0WOi', 'Alumni', NULL, '2026-05-08 10:30:42', '2026-05-08 10:30:42'),
(23, 'E41212126', '$2y$12$lO/guXtVdvDWzQL8hH.ZmOPDD2spyNl123qDfi5KioEZGuhMo.FFm', 'Alumni', NULL, '2026-05-08 10:30:42', '2026-05-08 10:30:42'),
(24, 'E41212137', '$2y$12$hFElIwCsLjPNEOrLkQuFQu/mFvH4EOWzJ9Z.HDw6ctV0DHeiIWPrC', 'Alumni', NULL, '2026-05-08 10:30:43', '2026-05-08 10:30:43'),
(25, 'E41212165', '$2y$12$def8ZVzYADH1AUV1SgPEoO6a7ZrY1wcMUWsdZeGVgiutobEeckDaK', 'Alumni', NULL, '2026-05-08 10:30:43', '2026-05-08 10:30:43'),
(26, 'E41211990', '$2y$12$XmprllS59gciPbfU10LyO.i4YwB8B7z6xn0fdOYW7v3Iu8ffT3q1.', 'Alumni', NULL, '2026-05-08 10:30:44', '2026-05-08 10:30:44'),
(27, 'E41212132', '$2y$12$Y7ostsZQijndIfoVsOEJu.XWKNCg4RgL4W1ij0C2waxLffj6vL.9e', 'Alumni', NULL, '2026-05-08 10:30:44', '2026-05-08 10:30:44'),
(28, 'E41212057', '$2y$12$OkfTfDQO1mEKxFbge7sITO1cEx/1MuulfbdbOJ8Dsp9SU1u97jKjS', 'Alumni', NULL, '2026-05-08 10:30:45', '2026-05-08 10:30:45'),
(29, 'E41212027', '$2y$12$I69WKlVb5hdgAx3gnUpEH.XRTJndl7H6YoskP23F7s8.po9gohDCC', 'Alumni', NULL, '2026-05-08 10:30:45', '2026-05-08 10:30:45'),
(30, 'E41212272', '$2y$12$UmAQkWMmhyEZbD6eQXor2uhqKIlfBdXFVWIkth6EgS2MpUev77R.G', 'Alumni', NULL, '2026-05-08 10:30:46', '2026-05-08 10:30:46'),
(31, 'E41212028', '$2y$12$D9708A7g4G2oi5bIykzp7.T8otw/ye9ThOcLYIBXxukR76bzsGOxi', 'Alumni', NULL, '2026-05-08 10:30:46', '2026-05-08 10:30:46'),
(32, 'E41212120', '$2y$12$7M7H0Cj46o0c.dXh7B4wJOnfCEoKLqOo/WQ.icBiEYgT3VhWuCZxK', 'Alumni', NULL, '2026-05-08 10:30:47', '2026-05-08 10:30:47'),
(33, 'E41212161', '$2y$12$efkUFwQJYiMSKxra96d7B.kswvIRsfMMxSLSOxvNReIdynGuW7VHW', 'Alumni', NULL, '2026-05-08 10:30:47', '2026-05-08 10:30:47'),
(34, 'E41212006', '$2y$12$HiZoCFGxfvOENQVwjdzfWOZrwgoWpldhnORYqIUJrg/ng56X2p5Ny', 'Alumni', NULL, '2026-05-08 10:30:48', '2026-05-08 10:30:48'),
(35, 'E41212026', '$2y$12$XFUDFjaSoBig1SOCI1XtSe/KtHeC0twKchQ8pkl0oMFpgeQ.FEZSK', 'Alumni', NULL, '2026-05-08 10:30:48', '2026-05-08 10:30:48'),
(36, 'E41212013', '$2y$12$loQRGqauNomR164yk294kueDfk65hnzYLcfVSwUtHPHUpqO2ojeCq', 'Alumni', NULL, '2026-05-08 10:30:48', '2026-05-08 10:30:48'),
(37, 'E41212201', '$2y$12$DpcqnUozb2rYIzzfaWP9j.TBArjqAd1j0zyVITnKZawrh23/BBSf6', 'Alumni', NULL, '2026-05-08 10:30:49', '2026-05-08 10:30:49'),
(38, 'E41212260', '$2y$12$K41P8c7A2rcYpkPFWeLFFOM89J6yfJIIapZubB2DOmHBUjL8l.ZLK', 'Alumni', NULL, '2026-05-08 10:30:49', '2026-05-08 10:30:49'),
(39, 'E41212104', '$2y$12$9rxqn5bJh6vOFI7Zdo7iT.f1jJv05NAta2VF.Bqi/Bn2FUuEOIG7i', 'Alumni', NULL, '2026-05-08 10:30:50', '2026-05-08 10:30:50'),
(40, 'E41212093', '$2y$12$A3iE021TO5aoirut00RiBevVwE/R3fylgHXO3NxUFshqd1nnvxs3S', 'Alumni', NULL, '2026-05-08 10:30:50', '2026-05-08 10:30:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `data_alumni`
--
ALTER TABLE `data_alumni`
  ADD PRIMARY KEY (`nim`),
  ADD UNIQUE KEY `data_alumni_email_unique` (`email`);

--
-- Indexes for table `data_certificate`
--
ALTER TABLE `data_certificate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_certificate_nim_foreign` (`nim`);

--
-- Indexes for table `data_pekerjaan`
--
ALTER TABLE `data_pekerjaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_pekerjaan_nim_foreign` (`nim`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_sosial`
--
ALTER TABLE `media_sosial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_sosial_nim_foreign` (`nim`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `riwayat_pendidikan`
--
ALTER TABLE `riwayat_pendidikan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_pendidikan_nim_foreign` (`nim`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_certificate`
--
ALTER TABLE `data_certificate`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `data_pekerjaan`
--
ALTER TABLE `data_pekerjaan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media_sosial`
--
ALTER TABLE `media_sosial`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `riwayat_pendidikan`
--
ALTER TABLE `riwayat_pendidikan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_certificate`
--
ALTER TABLE `data_certificate`
  ADD CONSTRAINT `data_certificate_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `data_alumni` (`nim`) ON DELETE CASCADE;

--
-- Constraints for table `data_pekerjaan`
--
ALTER TABLE `data_pekerjaan`
  ADD CONSTRAINT `data_pekerjaan_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `data_alumni` (`nim`) ON DELETE CASCADE;

--
-- Constraints for table `media_sosial`
--
ALTER TABLE `media_sosial`
  ADD CONSTRAINT `media_sosial_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `data_alumni` (`nim`) ON DELETE CASCADE;

--
-- Constraints for table `riwayat_pendidikan`
--
ALTER TABLE `riwayat_pendidikan`
  ADD CONSTRAINT `riwayat_pendidikan_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `data_alumni` (`nim`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
