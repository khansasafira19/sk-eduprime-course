-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 30, 2023 at 04:02 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigmacentric`
--

-- --------------------------------------------------------

--
-- Table structure for table `latihan_paket`
--

DROP TABLE IF EXISTS `latihan_paket`;
CREATE TABLE IF NOT EXISTS `latihan_paket` (
  `id_latihan_paket` bigint NOT NULL AUTO_INCREMENT,
  `judul` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `waktu_menit` int NOT NULL DEFAULT '30',
  `timestamp_paket` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_latihan_paket`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `latihan_paket`
--

INSERT INTO `latihan_paket` (`id_latihan_paket`, `judul`, `waktu_menit`, `timestamp_paket`) VALUES
(1, 'Seleksi STIS', 20, '2023-03-30 04:53:34'),
(2, 'Intelegensi Umum 01', 10, '2023-05-24 14:15:46');

-- --------------------------------------------------------

--
-- Table structure for table `latihan_siswa`
--

DROP TABLE IF EXISTS `latihan_siswa`;
CREATE TABLE IF NOT EXISTS `latihan_siswa` (
  `id_latihan_siswa` bigint NOT NULL AUTO_INCREMENT,
  `latihan` bigint NOT NULL,
  `siswa` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp_siswa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `skor` double DEFAULT NULL,
  `selesai` tinyint NOT NULL DEFAULT '0',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `timestamp_deleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_latihan_siswa`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `latihan_siswa`
--

INSERT INTO `latihan_siswa` (`id_latihan_siswa`, `latihan`, `siswa`, `timestamp_siswa`, `skor`, `selesai`, `deleted`, `timestamp_deleted`) VALUES
(1, 1, 'nofriani', '2023-03-30 04:58:37', 100, 1, 0, NULL),
(2, 1, 'nofriani', '2023-04-06 01:06:19', 100, 1, 0, NULL),
(3, 2, 'nelse.trivianita', '2023-05-24 14:52:45', 0, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `latihan_siswa_rinci`
--

DROP TABLE IF EXISTS `latihan_siswa_rinci`;
CREATE TABLE IF NOT EXISTS `latihan_siswa_rinci` (
  `id_latihan_siswa_rinci` bigint NOT NULL AUTO_INCREMENT,
  `latihan_siswa` bigint NOT NULL,
  `latihan_soal` bigint NOT NULL,
  `user_choice` int DEFAULT NULL,
  PRIMARY KEY (`id_latihan_siswa_rinci`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `latihan_siswa_rinci`
--

INSERT INTO `latihan_siswa_rinci` (`id_latihan_siswa_rinci`, `latihan_siswa`, `latihan_soal`, `user_choice`) VALUES
(1, 1, 1, 2),
(2, 2, 1, 2),
(3, 3, 2, NULL),
(4, 3, 3, NULL),
(5, 3, 4, NULL),
(6, 3, 5, NULL),
(7, 3, 6, NULL),
(8, 3, 7, NULL),
(9, 3, 8, NULL),
(10, 3, 9, NULL),
(11, 3, 10, NULL),
(12, 3, 11, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `latihan_soal`
--

DROP TABLE IF EXISTS `latihan_soal`;
CREATE TABLE IF NOT EXISTS `latihan_soal` (
  `id_latihan_soal` bigint NOT NULL AUTO_INCREMENT,
  `induk_latihan` bigint NOT NULL,
  `soal` text COLLATE utf8mb4_general_ci NOT NULL,
  `choice_a` text COLLATE utf8mb4_general_ci NOT NULL,
  `choice_b` text COLLATE utf8mb4_general_ci NOT NULL,
  `choice_c` text COLLATE utf8mb4_general_ci NOT NULL,
  `choice_d` text COLLATE utf8mb4_general_ci NOT NULL,
  `choice_e` text COLLATE utf8mb4_general_ci NOT NULL,
  `correct_choice` int NOT NULL,
  `pembahasan` text COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp_soal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `owner` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_latihan_soal`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `latihan_soal`
--

INSERT INTO `latihan_soal` (`id_latihan_soal`, `induk_latihan`, `soal`, `choice_a`, `choice_b`, `choice_c`, `choice_d`, `choice_e`, `correct_choice`, `pembahasan`, `timestamp_soal`, `owner`) VALUES
(1, 1, '<p>I\'m very happy _____ in India. I really miss being there.</p>', '<p>to live</p>', '<p>to have lived</p>', '<p>to be living</p>', '<p>to be lived</p>', '<p>to have been living</p>', 2, '<p>Sudah selesai. Jadi pakai to have lived. Hehehe..</p>', '2023-03-30 04:58:20', 'nofriani'),
(2, 2, '<p>3, 6, 12, 24, …</p>', '<p>28</p>', '<p>32</p>', '<p>36</p>', '<p>48</p>', '<p>64</p>', 4, '<p>.</p>', '2023-05-24 14:33:10', 'nelse.trivianita'),
(3, 2, '<p>11, 22, 32, 64, 74, 148, 158, …</p>', '<p>168</p>', '<p>268</p>', '<p>296</p>', '<p>316</p>', '<p>356</p>', 4, '<p>.</p>', '2023-05-24 14:32:59', 'nelse.trivianita'),
(4, 2, '<p>11, 14, 19, 26, 29, 34, 41, 44, …</p>', '<p>46</p>', '<p>47</p>', '<p>49</p>', '<p>51</p>', '<p>53</p>', 3, '<p>.</p>', '2023-05-24 14:34:35', 'nelse.trivianita'),
(5, 2, '<p>8, 64, 16, 32, 32, 16, 64, 8, …</p>', '<p>4</p>', '<p>16</p>', '<p>32</p>', '<p>64</p>', '<p>128</p>', 5, '<p>.</p>', '2023-05-24 14:36:37', 'nelse.trivianita'),
(6, 2, '<p>12, 3, 9, 13, 5, 12, 14, 7, 15, …, …</p>', '<p>9, 8</p>', '<p>10, 9</p>', '<p>15, 10</p>', '<p>15, 9</p>', '<p>10, 8</p>', 4, '<p>.</p>', '2023-05-24 14:37:33', 'nelse.trivianita'),
(7, 2, '<p>1, 3, 7, 13, 21, 31, 43, …, …</p>', '<p>48, 69</p>', '<p>53, 71</p>', '<p>57, 73</p>', '<p>60, 78</p>', '<p>62, 80</p>', 3, '<p>.</p>', '2023-05-24 14:38:45', 'nelse.trivianita'),
(8, 2, '<p>6, 12, 9, 18, 15, 30, 24, 48, …, …</p>', '<p>32, 62</p>', '<p>32, 72</p>', '<p>36, 62</p>', '<p>36, 72</p>', '<p>64, 72</p>', 4, '<p>.</p>', '2023-05-24 14:40:02', 'nelse.trivianita'),
(9, 2, '<p>4, 7, 11, 18, 29, …</p>', '<p>33</p>', '<p>39</p>', '<p>47</p>', '<p>57</p>', '<p>63</p>', 3, '<p>.</p>', '2023-05-24 14:40:46', 'nelse.trivianita'),
(10, 2, '<p>3, 5, 7, 11, 13, 17, 19, …</p>', '<p>20</p>', '<p>22</p>', '<p>23</p>', '<p>25</p>', '<p>27</p>', 3, '<p>.</p>', '2023-05-24 14:41:41', 'nelse.trivianita'),
(11, 2, '<p>4, 6, 8, 3, 10, 12, 14, 3, …</p>', '<p>5</p>', '<p>9</p>', '<p>13</p>', '<p>16</p>', '<p>18</p>', 4, '<p>.</p>', '2023-05-24 14:42:28', 'nelse.trivianita');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

DROP TABLE IF EXISTS `materi`;
CREATE TABLE IF NOT EXISTS `materi` (
  `id_materi` bigint NOT NULL AUTO_INCREMENT,
  `jenis` tinyint NOT NULL DEFAULT '0',
  `judul` text NOT NULL,
  `filename_link` text NOT NULL,
  `owner` varchar(30) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `timestamp_lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_materi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE IF NOT EXISTS `pengguna` (
  `username` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hape` bigint NOT NULL,
  `level` int NOT NULL DEFAULT '1',
  `tgl_daftar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `theme` tinyint NOT NULL DEFAULT '0',
  `email_confirm_token` text,
  `password_reset_token` text,
  `password_reset_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`username`, `password`, `nama`, `email`, `hape`, `level`, `tgl_daftar`, `tgl_update`, `theme`, `email_confirm_token`, `password_reset_token`, `password_reset_timestamp`) VALUES
('dianputra', '965689ddd7ee2eacb99145406498bd86', 'Dian Putra Nugraha', 'dianputra@bps.go.id', 8522251900, 2, '2023-03-21 03:41:31', '2023-05-24 05:15:10', 0, NULL, NULL, '0000-00-00 00:00:00'),
('nelse.trivianita', '6f037ab2912d57f2b5a2b3af4a6cdb09', 'Nelse Trivianita', 'nelse.trivianita@bps.go.id', 85267335256, 0, '2022-10-06 09:03:17', '2023-03-20 05:30:31', 0, NULL, NULL, '2023-05-24 05:08:19'),
('nofriani', 'f76ac3527148a002346d344e7b4f9597', 'Nofriani', 'khansa.safira19@gmail.com', 85664991937, 0, '2022-10-06 09:03:17', '2022-10-12 04:16:12', 0, NULL, 'ZenQ4qDE3mCq1qXQvYIz1nxnj9Eg1VjF', '2023-05-24 05:13:25');

-- --------------------------------------------------------

--
-- Stand-in structure for view `ranking`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `ranking`;
CREATE TABLE IF NOT EXISTS `ranking` (
`deleted` tinyint
,`id_latihan_siswa` bigint
,`latihan` bigint
,`selesai` tinyint
,`siswa` varchar(30)
,`skor` double
,`timestamp_deleted` timestamp
,`timestamp_siswa` timestamp
);

-- --------------------------------------------------------

--
-- Structure for view `ranking`
--
DROP TABLE IF EXISTS `ranking`;

DROP VIEW IF EXISTS `ranking`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ranking`  AS SELECT `ls`.`id_latihan_siswa` AS `id_latihan_siswa`, `ls`.`latihan` AS `latihan`, `ls`.`siswa` AS `siswa`, `ls`.`timestamp_siswa` AS `timestamp_siswa`, `ls`.`skor` AS `skor`, `ls`.`selesai` AS `selesai`, `ls`.`deleted` AS `deleted`, `ls`.`timestamp_deleted` AS `timestamp_deleted` FROM (`latihan_siswa` `ls` join (select `latihan_siswa`.`siswa` AS `siswa`,min(`latihan_siswa`.`timestamp_siswa`) AS `timestamp_siswa` from `latihan_siswa` where (`latihan_siswa`.`deleted` = 0) group by `latihan_siswa`.`latihan`,`latihan_siswa`.`siswa`) `t` on(((`ls`.`siswa` = `t`.`siswa`) and (`ls`.`timestamp_siswa` = `t`.`timestamp_siswa`)))) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
