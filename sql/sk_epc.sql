-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 11, 2023 at 07:19 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sk_epc`
--

-- --------------------------------------------------------

--
-- Table structure for table `latihan_paket`
--

DROP TABLE IF EXISTS `latihan_paket`;
CREATE TABLE IF NOT EXISTS `latihan_paket` (
  `id_latihan_paket` bigint NOT NULL AUTO_INCREMENT,
  `judul` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `waktu_menit` int NOT NULL DEFAULT '30',
  `timestamp_paket` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_latihan_paket`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `latihan_paket`
--

INSERT INTO `latihan_paket` (`id_latihan_paket`, `judul`, `waktu_menit`, `timestamp_paket`) VALUES
(1, 'English Test 1', 30, '2023-03-30 04:53:34'),
(2, 'English Test 2', 60, '2023-05-24 14:15:46');

-- --------------------------------------------------------

--
-- Table structure for table `latihan_siswa`
--

DROP TABLE IF EXISTS `latihan_siswa`;
CREATE TABLE IF NOT EXISTS `latihan_siswa` (
  `id_latihan_siswa` bigint NOT NULL AUTO_INCREMENT,
  `latihan` bigint NOT NULL,
  `siswa` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp_siswa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `skor` double DEFAULT NULL,
  `selesai` tinyint NOT NULL DEFAULT '0',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `timestamp_deleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_latihan_siswa`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `latihan_siswa`
--

INSERT INTO `latihan_siswa` (`id_latihan_siswa`, `latihan`, `siswa`, `timestamp_siswa`, `skor`, `selesai`, `deleted`, `timestamp_deleted`) VALUES
(1, 1, 'admin', '2023-12-11 06:46:23', 75, 1, 0, NULL),
(2, 2, 'admin', '2023-12-11 06:46:56', 75, 1, 0, NULL),
(3, 1, 'user', '2023-12-11 07:07:40', 100, 1, 0, NULL),
(4, 2, 'user', '2023-12-11 07:07:58', 100, 1, 0, NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `latihan_siswa_rinci`
--

INSERT INTO `latihan_siswa_rinci` (`id_latihan_siswa_rinci`, `latihan_siswa`, `latihan_soal`, `user_choice`) VALUES
(1, 1, 1, 2),
(2, 1, 6, 2),
(3, 1, 7, 1),
(4, 1, 8, 5),
(5, 2, 2, 1),
(6, 2, 3, 3),
(7, 2, 4, 5),
(8, 2, 5, 5),
(9, 3, 1, 2),
(10, 3, 6, 3),
(11, 3, 7, 1),
(12, 3, 8, 5),
(13, 4, 2, 1),
(14, 4, 3, 3),
(15, 4, 4, 3),
(16, 4, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `latihan_soal`
--

DROP TABLE IF EXISTS `latihan_soal`;
CREATE TABLE IF NOT EXISTS `latihan_soal` (
  `id_latihan_soal` bigint NOT NULL AUTO_INCREMENT,
  `induk_latihan` bigint NOT NULL,
  `soal` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `choice_a` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `choice_b` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `choice_c` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `choice_d` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `choice_e` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `correct_choice` int NOT NULL,
  `pembahasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp_soal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `owner` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_latihan_soal`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `latihan_soal`
--

INSERT INTO `latihan_soal` (`id_latihan_soal`, `induk_latihan`, `soal`, `choice_a`, `choice_b`, `choice_c`, `choice_d`, `choice_e`, `correct_choice`, `pembahasan`, `timestamp_soal`, `owner`) VALUES
(1, 1, '<p>I\'m very happy _____ in India. I really miss being there.</p>', '<p>to live</p>', '<p>to have lived</p>', '<p>to be living</p>', '<p>to be lived</p>', '<p>to have been living</p>', 2, '<p>Sudah selesai. Jadi pakai to have lived. Hehehe..</p>', '2023-03-30 04:58:20', 'admin'),
(2, 2, '<p>They didn\'t reach an agreement ______ their differences.</p>', '<p>on account of</p>', '<p>due</p>', '<p>because</p>', '<p>owing</p>', '<p>only</p>', 1, '<p>.</p>', '2023-12-11 05:33:46', 'admin'),
(3, 2, '<p>I wish I _____ those words. But now it\'s too late.</p>', '<p>not having said</p>', '<p>have never said</p>', '<p>never said</p>', '<p>had never said</p>', '<p>never ever say</p>', 3, '<p>.</p>', '2023-12-11 05:36:23', 'admin'),
(4, 2, '<p>The woman, who has been missing for 10 days, is believed _____.</p>', '<p>to be abducted</p>', '<p>to be abducting</p>', '<p>to have been abducted</p>', '<p>to have been abducting</p>', '<p>to have abducted</p>', 3, '<p>.I got this question and the answer from test-english.com</p>', '2023-12-11 05:37:34', 'admin'),
(5, 2, '<p>She was working on her computer with her baby next to _____.</p>', '<p>herself</p>', '<p>she</p>', '<p>her own</p>', '<p>hers</p>', '<p>her</p>', 5, '<p>I got this question and the answer from test-english.com</p>', '2023-12-11 05:38:18', 'admin'),
(6, 1, '<p>_____ to offend anyone, she said both cakes were equally good.</p>', '<p>wanting</p>', '<p>not want</p>', '<p>not wanting</p>', '<p>as not wanting</p>', '<p>wants</p>', 3, '<p>.</p>', '2023-12-11 05:40:15', 'admin'),
(7, 1, '<p>_____ in trying to solve this problem. It\'s clearly unsolvable.</p>', '<p>there\'s no point</p>', '<p>it\'s no point</p>', '<p>there is point</p>', '<p>it\'s no need</p>', '<p>not important</p>', 1, '<p>.</p>', '2023-12-11 05:41:20', 'admin'),
(8, 1, '<p>Last year, when I last met her, she told me she _____ a letter every day for the last two months.</p>', '<p>wrote</p>', '<p>has written</p>', '<p>had been writing</p>', '<p>was writing</p>', '<p>had written</p>', 5, '<p>.</p>', '2023-12-11 05:42:50', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

DROP TABLE IF EXISTS `materi`;
CREATE TABLE IF NOT EXISTS `materi` (
  `id_materi` bigint NOT NULL AUTO_INCREMENT,
  `jenis` tinyint NOT NULL DEFAULT '0',
  `judul` text NOT NULL,
  `filename_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `owner` varchar(30) NOT NULL,
  `deleted` tinyint NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `timestamp_lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_materi`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `jenis`, `judul`, `filename_link`, `owner`, `deleted`, `timestamp`, `timestamp_lastupdate`) VALUES
(1, 0, 'Easily Understanding English', NULL, 'admin', 0, '2023-12-11 05:48:09', '2023-12-11 05:48:09'),
(2, 0, 'Web Programming - Repository Universitas BSI', NULL, 'admin', 0, '2023-12-11 06:02:14', '2023-12-11 06:02:14'),
(3, 1, 'How to Respond to Thank You', 'https://www.youtube.com/watch?v=F99JNqsfxlQ', 'admin', 0, '2023-12-11 06:16:40', '2023-12-11 06:31:50');

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
('admin', '2aefc34200a294a3cc7db81b43a81873', 'Admin', 'admin@gmail.com', 85610000000, 0, '2022-10-06 09:03:17', '2022-10-12 04:16:12', 0, NULL, 'ZenQ4qDE3mCq1qXQvYIz1nxnj9Eg1VjF', '2023-05-24 05:13:25'),
('other', '2aefc34200a294a3cc7db81b43a81873', 'Other', 'user@gmail.com', 85610000001, 2, '2022-10-06 09:03:17', '2023-03-20 05:30:31', 0, NULL, NULL, '2023-05-24 05:08:19'),
('user', '2aefc34200a294a3cc7db81b43a81873', 'User\'s Name', 'other@gmail.com', 85610000002, 1, '2023-03-21 03:41:31', '2023-05-24 05:15:10', 0, NULL, NULL, '0000-00-00 00:00:00');

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
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ranking`  AS SELECT `ls`.`id_latihan_siswa` AS `id_latihan_siswa`, `ls`.`latihan` AS `latihan`, `ls`.`siswa` AS `siswa`, `ls`.`timestamp_siswa` AS `timestamp_siswa`, `ls`.`skor` AS `skor`, `ls`.`selesai` AS `selesai`, `ls`.`deleted` AS `deleted`, `ls`.`timestamp_deleted` AS `timestamp_deleted` FROM (`latihan_siswa` `ls` join (select `latihan_siswa`.`siswa` AS `siswa`,min(`latihan_siswa`.`timestamp_siswa`) AS `timestamp_siswa` from `latihan_siswa` where (`latihan_siswa`.`deleted` = 0) group by `latihan_siswa`.`latihan`,`latihan_siswa`.`siswa`) `t` on(((`ls`.`siswa` = `t`.`siswa`) and (`ls`.`timestamp_siswa` = `t`.`timestamp_siswa`))))  ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
