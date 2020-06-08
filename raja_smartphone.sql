-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Feb 2020 pada 04.46
-- Versi server: 10.4.10-MariaDB
-- Versi PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `raja_smartphone`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `diskon`
--

CREATE TABLE `diskon` (
  `id` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `dc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `diskon`
--

INSERT INTO `diskon` (`id`, `tgl`, `dc`) VALUES
(1, '2018-06-05', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `idkat` varchar(20) NOT NULL,
  `nmkat` varchar(100) NOT NULL,
  `persen` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `kd_admin` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `level` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`kd_admin`, `nama_admin`, `level`, `username`, `password`) VALUES
(2, 'admin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(3, 'putra', 'user', 'user', 'ee11cbb19052e40b07aac0ca060c23ee'),
(9, 'aku', 'user', 'a', '47bce5c74f589f4867dbd57e9ca9f808');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_alamat`
--

CREATE TABLE `tbl_alamat` (
  `id_alamat` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `namaal` varchar(50) NOT NULL,
  `id_prov` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `kodepos` varchar(10) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_alamat`
--

INSERT INTO `tbl_alamat` (`id_alamat`, `id_customer`, `namaal`, `id_prov`, `id_kota`, `kodepos`, `alamat`) VALUES
(26, 18, 'Ahmad Fajri', 11, 20, '12121', 'Komp Nuansa Indah Blok F 15 Gadut'),
(32, 22, 'ramadani', 13, 68, '26368', 'Komplek PTP N VI OPhir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `id_bank` int(11) NOT NULL,
  `nm_bank` varchar(50) NOT NULL,
  `no_rek` varchar(50) NOT NULL,
  `atas_nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_bank`
--

INSERT INTO `tbl_bank` (`id_bank`, `nm_bank`, `no_rek`, `atas_nama`) VALUES
(1, 'MANDIRI', '111-002-333-444-0', 'Rafika Sary'),
(2, 'BNI', '0585-811955', 'Rafika Sary');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id_customer` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_customer`
--

INSERT INTO `tbl_customer` (`id_customer`, `email`, `password`, `nama_lengkap`, `nohp`, `tgl_daftar`) VALUES
(1, 'egova@gmail.com', '5732f6b23c7d2cb118c0bfcccb48ed05', 'Egova Riva Gustino', '0819629431', '2020-01-30'),
(2, 'egovaflavia@gmail.com', '5732f6b23c7d2cb118c0bfcccb48ed05', 'Egova Riva Gustino', '0819629431', '2020-02-08'),
(3, 'rehan@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Rehan', '082170216677', '2020-02-08'),
(4, 'maman@gmail.com', '7815696ecbf1c96e6894b779456d330e', 'asd', '082343234135', '2020-02-18'),
(5, 'aaa', '47bce5c74f589f4867dbd57e9ca9f808', 'aaa', 'aaa', '2020-02-19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_data`
--

CREATE TABLE `tbl_data` (
  `id_data` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_data`
--

INSERT INTO `tbl_data` (`id_data`, `kategori`, `isi`) VALUES
(1, 'Profil', '<h2><b></b>Sari Anggrek<b></b></h2><p></p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br></p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br></p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br></p><p></p>'),
(2, 'Cara Belanja', '<h2>Sari Anggrek</h2><p>1. Silahkan login terlebih dahulu, jika belum memilki akun silahkan registrasi terlebih dahulu.<br></p><p>2. Jika sudah berhasil masuk, cari produk pilih detail dan pesan.</p><p>3. Barang akan masuk ke keranjang Belanja.</p><p>4. Lanjutkan dengan memasukkan alamat pengiriman.</p><p>5. Cek lagi data transaksi anda dan lakukan checkout / pesan sekarang.</p><p>6. Checkout berhasil, dan anda akan menerima pemberitahuan untuk melakukan konfirmasi pembayaran.</p><p>7. Cek email anda untuk melihat no rekening transfer.</p><p>8. Lakukan konfirmasi pembayaran ke no rekening yang tertera pada email sebelum tanggal dan waktu yang sudah ditentukan.</p><p>9.&nbsp; Admin akan memproses data pembayaran anda, dan barang hanya akan dikirimkan jika data sudah cocok.</p><p>10. Terima Kasih :)</p>'),
(3, 'Kontak Email', 'sari.anggrek@yahoo.com'),
(4, 'Kontak No HP', '082386182766'),
(5, 'Kontak Telepon 1', '0751-22609'),
(6, 'Kontak Telepon 2', '0751-24552');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_faq`
--

CREATE TABLE `tbl_faq` (
  `id_faq` int(10) NOT NULL,
  `judul_faq` varchar(50) NOT NULL,
  `isi_faq` text NOT NULL,
  `judul_seo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_faq`
--

INSERT INTO `tbl_faq` (`id_faq`, `judul_faq`, `isi_faq`, `judul_seo`) VALUES
(1, 'Lorem ipsum dolor sit amet consectetur adipisicing', '<p></p><p></p><div><div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo magnam nemo id alias enim exercitationem. Eveniet nam aperiam, recusandae unde possimus, nulla ad provident cupiditate fugiat est soluta, pariatur eaque.</div><div>Sunt, nostrum odit est, quod ab corporis magnam illum recusandae alias accusantium error voluptatum? Alias, reprehenderit eius et dolorem magni sed at possimus totam vel architecto. Laudantium recusandae veniam voluptatibus?</div><div>Odio nulla illo temporibus accusantium natus. Quis, quam omnis. Odio possimus vel est commodi? Deserunt, quam. Ipsa, nihil, similique quis hic incidunt placeat ipsum accusantium, vitae reprehenderit nesciunt maiores porro.</div><div>Quae iste autem, maxime doloribus quia minima natus dignissimos quasi. Consectetur sequi quod molestias! Rem sint ad quod, quae modi debitis reprehenderit nihil corrupti magnam perferendis vel dignissimos exercitationem aperiam!</div><div>Perspiciatis, nihil voluptate voluptates aspernatur, nesciunt saepe sint necessitatibus perferendis cupiditate repellendus impedit, totam assumenda nemo error iste reiciendis nisi unde? Iste est magnam, iusto voluptatibus distinctio laborum non ut.</div></div><br><p></p>', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_garansi`
--

CREATE TABLE `tbl_garansi` (
  `id_garansi` int(10) NOT NULL,
  `judul_garansi` varchar(50) NOT NULL,
  `isi_tex` text NOT NULL,
  `seo_garansi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_garansi`
--

INSERT INTO `tbl_garansi` (`id_garansi`, `judul_garansi`, `isi_tex`, `seo_garansi`) VALUES
(1, 'Kebijakan Pengembalian Produk', '<p></p><p></p><div><div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo magnam nemo id alias enim exercitationem. Eveniet nam aperiam, recusandae unde possimus, nulla ad provident cupiditate fugiat est soluta, pariatur eaque.</div><div>Sunt, nostrum odit est, quod ab corporis magnam illum recusandae alias accusantium error voluptatum? Alias, reprehenderit eius et dolorem magni sed at possimus totam vel architecto. Laudantium recusandae veniam voluptatibus?</div><div>Odio nulla illo temporibus accusantium natus. Quis, quam omnis. Odio possimus vel est commodi? Deserunt, quam. Ipsa, nihil, similique quis hic incidunt placeat ipsum accusantium, vitae reprehenderit nesciunt maiores porro.</div><div>Quae iste autem, maxime doloribus quia minima natus dignissimos quasi. Consectetur sequi quod molestias! Rem sint ad quod, quae modi debitis reprehenderit nihil corrupti magnam perferendis vel dignissimos exercitationem aperiam!</div><div>Perspiciatis, nihil voluptate voluptates aspernatur, nesciunt saepe sint necessitatibus perferendis cupiditate repellendus impedit, totam assumenda nemo error iste reiciendis nisi unde? Iste est magnam, iusto voluptatibus distinctio laborum non ut.</div></div><br><p></p>', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `seo_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`, `seo_kategori`) VALUES
(8, 'Gaun', 'gaun');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_keranjang`
--

CREATE TABLE `tbl_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `jml` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_keranjang`
--

INSERT INTO `tbl_keranjang` (`id_keranjang`, `id_produk`, `id_customer`, `jml`) VALUES
(11, 10, 4, 1),
(12, 10, 4, 1),
(13, 4, 4, 1),
(17, 10, 5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_konfirmasi_bayar`
--

CREATE TABLE `tbl_konfirmasi_bayar` (
  `id_konfirmasi` int(11) NOT NULL,
  `id_order` varchar(20) NOT NULL,
  `total_bayars` int(11) NOT NULL,
  `bukti` text NOT NULL,
  `tgl_bayar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_konfirmasi_bayar`
--

INSERT INTO `tbl_konfirmasi_bayar` (`id_konfirmasi`, `id_order`, `total_bayars`, `bukti`, `tgl_bayar`) VALUES
(1, '1300208110348', 392157, '20200208110536bf86bc3a-cde6-4b2a-a221-db2e5257941f_169.jpeg', '2020-02-08 11:05:36'),
(2, '3310208232431', 290000, '20200208232521Screenshot_2020-01-26_15-20-27.png', '2020-02-08 23:25:21'),
(3, '1600210222404', 580000, '20200210222453Screenshot_2020-01-30_05-30-12.png', '2020-02-10 22:24:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kontak`
--

CREATE TABLE `tbl_kontak` (
  `id_kontak` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `subjek` varchar(50) NOT NULL,
  `pesan` text NOT NULL,
  `tgl_kontak` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kontak`
--

INSERT INTO `tbl_kontak` (`id_kontak`, `nama`, `subjek`, `pesan`, `tgl_kontak`) VALUES
(1, '', '', 'awdasd', '2018-05-31 10:51:35'),
(2, 'asdw', 'adas', 'asdawd', '2018-05-31 10:52:15'),
(3, 'deltri tumbin', 'adada', 'lokasi nya dimanaaa? saga ga', '2018-06-22 09:31:12'),
(4, 'GrantFoushIG', 'Mp3 Scene Music for DJs', 'Hello, \r\nDownload Mp3 Scene Music Private FTP \r\nDance/House/Techno/Trance/Electro \r\n \r\nhttps://0daymusic.org \r\n \r\nPrivate FTP MP3/FLAC 1990-2018: \r\n \r\nPlan A: 20â‚¬ â€“ 200GB â€“ 30 Days \r\nPlan B: 45â‚¬ â€“ 600GB â€“ 90 Days \r\nPlan C: 80â‚¬ â€“ 1500GB â€“ 180 Days \r\n \r\nUpdated: 2018-07-03 FTP list txt \r\n \r\nBest regards, \r\nMark', '2018-08-10 03:04:30'),
(5, 'Azarul akhlal', 'sumbar smartphone', 'bg orderan sy kpn krimnya? udh 4 hari ko blum ad infonya', '2018-09-10 20:57:11'),
(6, 'Irwansyah', 'Status Pesanan', 'Dimana saya bisa mengecek status pesanan saya.?', '2018-09-17 09:42:43'),
(7, 'Hadi', 'Xiaomi A2 6/128 GB', 'Apakah Xiaomi A2 6/128GB tersedia? Apabila ada, berapa harganya?', '2018-09-17 10:51:55'),
(8, 'brista yulia', 'order', 'barang sudah di keep di keranjang,pas mau bayar, semua data sudah diisi, cuma pilihan check outnya ga ada gan', '2018-09-26 03:25:30'),
(9, 'VANDELIA NANDA', 'Sumbarsmartphone', 'Cara nyicil bulanan gimana gan?saya udah coba berkali2,tp pesanan dibatalkan.', '2018-10-05 18:55:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kota`
--

CREATE TABLE `tbl_kota` (
  `id_kota` int(11) NOT NULL,
  `id_prov` int(11) NOT NULL,
  `nama_kota` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tbl_kota`
--

INSERT INTO `tbl_kota` (`id_kota`, `id_prov`, `nama_kota`) VALUES
(1, 21, 'Aceh Barat'),
(2, 21, 'Aceh Barat Daya'),
(3, 21, 'Aceh Besar'),
(4, 21, 'Aceh Jaya'),
(5, 21, 'Aceh Selatan'),
(6, 21, 'Aceh Singkil'),
(7, 21, 'Aceh Tamiang'),
(8, 21, 'Aceh Tengah'),
(9, 21, 'Aceh Tenggara'),
(10, 21, 'Aceh Timur'),
(11, 21, 'Aceh Utara'),
(12, 32, 'Agam'),
(13, 23, 'Alor'),
(14, 19, 'Ambon'),
(15, 34, 'Asahan'),
(16, 24, 'Asmat'),
(17, 1, 'Badung'),
(18, 13, 'Balangan'),
(19, 15, 'Balikpapan'),
(20, 21, 'Banda Aceh'),
(21, 18, 'Bandar Lampung'),
(22, 9, 'Bandung'),
(23, 9, 'Bandung'),
(24, 9, 'Bandung Barat'),
(25, 29, 'Banggai'),
(26, 29, 'Banggai Kepulauan'),
(27, 2, 'Bangka'),
(28, 2, 'Bangka Barat'),
(29, 2, 'Bangka Selatan'),
(30, 2, 'Bangka Tengah'),
(31, 11, 'Bangkalan'),
(32, 1, 'Bangli'),
(33, 13, 'Banjar'),
(34, 9, 'Banjar'),
(35, 13, 'Banjarbaru'),
(36, 13, 'Banjarmasin'),
(37, 10, 'Banjarnegara'),
(38, 28, 'Bantaeng'),
(39, 5, 'Bantul'),
(40, 33, 'Banyuasin'),
(41, 10, 'Banyumas'),
(42, 11, 'Banyuwangi'),
(43, 13, 'Barito Kuala'),
(44, 14, 'Barito Selatan'),
(45, 14, 'Barito Timur'),
(46, 14, 'Barito Utara'),
(47, 28, 'Barru'),
(48, 17, 'Batam'),
(49, 10, 'Batang'),
(50, 8, 'Batang Hari'),
(51, 11, 'Batu'),
(52, 34, 'Batu Bara'),
(53, 30, 'Bau-Bau'),
(54, 9, 'Bekasi'),
(55, 9, 'Bekasi'),
(56, 2, 'Belitung'),
(57, 2, 'Belitung Timur'),
(58, 23, 'Belu'),
(59, 21, 'Bener Meriah'),
(60, 26, 'Bengkalis'),
(61, 12, 'Bengkayang'),
(62, 4, 'Bengkulu'),
(63, 4, 'Bengkulu Selatan'),
(64, 4, 'Bengkulu Tengah'),
(65, 4, 'Bengkulu Utara'),
(66, 15, 'Berau'),
(67, 24, 'Biak Numfor'),
(68, 22, 'Bima'),
(69, 22, 'Bima'),
(70, 34, 'Binjai'),
(71, 17, 'Bintan'),
(72, 21, 'Bireuen'),
(73, 31, 'Bitung'),
(74, 11, 'Blitar'),
(75, 11, 'Blitar'),
(76, 10, 'Blora'),
(77, 7, 'Boalemo'),
(78, 9, 'Bogor'),
(79, 9, 'Bogor'),
(80, 11, 'Bojonegoro'),
(81, 31, 'Bolaang Mongondow (Bolmong)'),
(82, 31, 'Bolaang Mongondow Selatan'),
(83, 31, 'Bolaang Mongondow Timur'),
(84, 31, 'Bolaang Mongondow Utara'),
(85, 30, 'Bombana'),
(86, 11, 'Bondowoso'),
(87, 28, 'Bone'),
(88, 7, 'Bone Bolango'),
(89, 15, 'Bontang'),
(90, 24, 'Boven Digoel'),
(91, 10, 'Boyolali'),
(92, 10, 'Brebes'),
(93, 32, 'Bukittinggi'),
(94, 1, 'Buleleng'),
(95, 28, 'Bulukumba'),
(96, 16, 'Bulungan (Bulongan)'),
(97, 8, 'Bungo'),
(98, 29, 'Buol'),
(99, 19, 'Buru'),
(100, 19, 'Buru Selatan'),
(101, 30, 'Buton'),
(102, 30, 'Buton Utara'),
(103, 9, 'Ciamis'),
(104, 9, 'Cianjur'),
(105, 10, 'Cilacap'),
(106, 3, 'Cilegon'),
(107, 9, 'Cimahi'),
(108, 9, 'Cirebon'),
(109, 9, 'Cirebon'),
(110, 34, 'Dairi'),
(111, 24, 'Deiyai (Deliyai)'),
(112, 34, 'Deli Serdang'),
(113, 10, 'Demak'),
(114, 1, 'Denpasar'),
(115, 9, 'Depok'),
(116, 32, 'Dharmasraya'),
(117, 24, 'Dogiyai'),
(118, 22, 'Dompu'),
(119, 29, 'Donggala'),
(120, 26, 'Dumai'),
(121, 33, 'Empat Lawang'),
(122, 23, 'Ende'),
(123, 28, 'Enrekang'),
(124, 25, 'Fakfak'),
(125, 23, 'Flores Timur'),
(126, 9, 'Garut'),
(127, 21, 'Gayo Lues'),
(128, 1, 'Gianyar'),
(129, 7, 'Gorontalo'),
(130, 7, 'Gorontalo'),
(131, 7, 'Gorontalo Utara'),
(132, 28, 'Gowa'),
(133, 11, 'Gresik'),
(134, 10, 'Grobogan'),
(135, 5, 'Gunung Kidul'),
(136, 14, 'Gunung Mas'),
(137, 34, 'Gunungsitoli'),
(138, 20, 'Halmahera Barat'),
(139, 20, 'Halmahera Selatan'),
(140, 20, 'Halmahera Tengah'),
(141, 20, 'Halmahera Timur'),
(142, 20, 'Halmahera Utara'),
(143, 13, 'Hulu Sungai Selatan'),
(144, 13, 'Hulu Sungai Tengah'),
(145, 13, 'Hulu Sungai Utara'),
(146, 34, 'Humbang Hasundutan'),
(147, 26, 'Indragiri Hilir'),
(148, 26, 'Indragiri Hulu'),
(149, 9, 'Indramayu'),
(150, 24, 'Intan Jaya'),
(151, 6, 'Jakarta Barat'),
(152, 6, 'Jakarta Pusat'),
(153, 6, 'Jakarta Selatan'),
(154, 6, 'Jakarta Timur'),
(155, 6, 'Jakarta Utara'),
(156, 8, 'Jambi'),
(157, 24, 'Jayapura'),
(158, 24, 'Jayapura'),
(159, 24, 'Jayawijaya'),
(160, 11, 'Jember'),
(161, 1, 'Jembrana'),
(162, 28, 'Jeneponto'),
(163, 10, 'Jepara'),
(164, 11, 'Jombang'),
(165, 25, 'Kaimana'),
(166, 26, 'Kampar'),
(167, 14, 'Kapuas'),
(168, 12, 'Kapuas Hulu'),
(169, 10, 'Karanganyar'),
(170, 1, 'Karangasem'),
(171, 9, 'Karawang'),
(172, 17, 'Karimun'),
(173, 34, 'Karo'),
(174, 14, 'Katingan'),
(175, 4, 'Kaur'),
(176, 12, 'Kayong Utara'),
(177, 10, 'Kebumen'),
(178, 11, 'Kediri'),
(179, 11, 'Kediri'),
(180, 24, 'Keerom'),
(181, 10, 'Kendal'),
(182, 30, 'Kendari'),
(183, 4, 'Kepahiang'),
(184, 17, 'Kepulauan Anambas'),
(185, 19, 'Kepulauan Aru'),
(186, 32, 'Kepulauan Mentawai'),
(187, 26, 'Kepulauan Meranti'),
(188, 31, 'Kepulauan Sangihe'),
(189, 6, 'Kepulauan Seribu'),
(190, 31, 'Kepulauan Siau Tagulandang Biaro (Sitaro)'),
(191, 20, 'Kepulauan Sula'),
(192, 31, 'Kepulauan Talaud'),
(193, 24, 'Kepulauan Yapen (Yapen Waropen)'),
(194, 8, 'Kerinci'),
(195, 12, 'Ketapang'),
(196, 10, 'Klaten'),
(197, 1, 'Klungkung'),
(198, 30, 'Kolaka'),
(199, 30, 'Kolaka Utara'),
(200, 30, 'Konawe'),
(201, 30, 'Konawe Selatan'),
(202, 30, 'Konawe Utara'),
(203, 13, 'Kotabaru'),
(204, 31, 'Kotamobagu'),
(205, 14, 'Kotawaringin Barat'),
(206, 14, 'Kotawaringin Timur'),
(207, 26, 'Kuantan Singingi'),
(208, 12, 'Kubu Raya'),
(209, 10, 'Kudus'),
(210, 5, 'Kulon Progo'),
(211, 9, 'Kuningan'),
(212, 23, 'Kupang'),
(213, 23, 'Kupang'),
(214, 15, 'Kutai Barat'),
(215, 15, 'Kutai Kartanegara'),
(216, 15, 'Kutai Timur'),
(217, 34, 'Labuhan Batu'),
(218, 34, 'Labuhan Batu Selatan'),
(219, 34, 'Labuhan Batu Utara'),
(220, 33, 'Lahat'),
(221, 14, 'Lamandau'),
(222, 11, 'Lamongan'),
(223, 18, 'Lampung Barat'),
(224, 18, 'Lampung Selatan'),
(225, 18, 'Lampung Tengah'),
(226, 18, 'Lampung Timur'),
(227, 18, 'Lampung Utara'),
(228, 12, 'Landak'),
(229, 34, 'Langkat'),
(230, 21, 'Langsa'),
(231, 24, 'Lanny Jaya'),
(232, 3, 'Lebak'),
(233, 4, 'Lebong'),
(234, 23, 'Lembata'),
(235, 21, 'Lhokseumawe'),
(236, 32, 'Lima Puluh Koto/Kota'),
(237, 17, 'Lingga'),
(238, 22, 'Lombok Barat'),
(239, 22, 'Lombok Tengah'),
(240, 22, 'Lombok Timur'),
(241, 22, 'Lombok Utara'),
(242, 33, 'Lubuk Linggau'),
(243, 11, 'Lumajang'),
(244, 28, 'Luwu'),
(245, 28, 'Luwu Timur'),
(246, 28, 'Luwu Utara'),
(247, 11, 'Madiun'),
(248, 11, 'Madiun'),
(249, 10, 'Magelang'),
(250, 10, 'Magelang'),
(251, 11, 'Magetan'),
(252, 9, 'Majalengka'),
(253, 27, 'Majene'),
(254, 28, 'Makassar'),
(255, 11, 'Malang'),
(256, 11, 'Malang'),
(257, 16, 'Malinau'),
(258, 19, 'Maluku Barat Daya'),
(259, 19, 'Maluku Tengah'),
(260, 19, 'Maluku Tenggara'),
(261, 19, 'Maluku Tenggara Barat'),
(262, 27, 'Mamasa'),
(263, 24, 'Mamberamo Raya'),
(264, 24, 'Mamberamo Tengah'),
(265, 27, 'Mamuju'),
(266, 27, 'Mamuju Utara'),
(267, 31, 'Manado'),
(268, 34, 'Mandailing Natal'),
(269, 23, 'Manggarai'),
(270, 23, 'Manggarai Barat'),
(271, 23, 'Manggarai Timur'),
(272, 25, 'Manokwari'),
(273, 25, 'Manokwari Selatan'),
(274, 24, 'Mappi'),
(275, 28, 'Maros'),
(276, 22, 'Mataram'),
(277, 25, 'Maybrat'),
(278, 34, 'Medan'),
(279, 12, 'Melawi'),
(280, 8, 'Merangin'),
(281, 24, 'Merauke'),
(282, 18, 'Mesuji'),
(283, 18, 'Metro'),
(284, 24, 'Mimika'),
(285, 31, 'Minahasa'),
(286, 31, 'Minahasa Selatan'),
(287, 31, 'Minahasa Tenggara'),
(288, 31, 'Minahasa Utara'),
(289, 11, 'Mojokerto'),
(290, 11, 'Mojokerto'),
(291, 29, 'Morowali'),
(292, 33, 'Muara Enim'),
(293, 8, 'Muaro Jambi'),
(294, 4, 'Muko Muko'),
(295, 30, 'Muna'),
(296, 14, 'Murung Raya'),
(297, 33, 'Musi Banyuasin'),
(298, 33, 'Musi Rawas'),
(299, 24, 'Nabire'),
(300, 21, 'Nagan Raya'),
(301, 23, 'Nagekeo'),
(302, 17, 'Natuna'),
(303, 24, 'Nduga'),
(304, 23, 'Ngada'),
(305, 11, 'Nganjuk'),
(306, 11, 'Ngawi'),
(307, 34, 'Nias'),
(308, 34, 'Nias Barat'),
(309, 34, 'Nias Selatan'),
(310, 34, 'Nias Utara'),
(311, 16, 'Nunukan'),
(312, 33, 'Ogan Ilir'),
(313, 33, 'Ogan Komering Ilir'),
(314, 33, 'Ogan Komering Ulu'),
(315, 33, 'Ogan Komering Ulu Selatan'),
(316, 33, 'Ogan Komering Ulu Timur'),
(317, 11, 'Pacitan'),
(318, 32, 'Padang'),
(319, 34, 'Padang Lawas'),
(320, 34, 'Padang Lawas Utara'),
(321, 32, 'Padang Panjang'),
(322, 32, 'Padang Pariaman'),
(323, 34, 'Padang Sidempuan'),
(324, 33, 'Pagar Alam'),
(325, 34, 'Pakpak Bharat'),
(326, 14, 'Palangka Raya'),
(327, 33, 'Palembang'),
(328, 28, 'Palopo'),
(329, 29, 'Palu'),
(330, 11, 'Pamekasan'),
(331, 3, 'Pandeglang'),
(332, 9, 'Pangandaran'),
(333, 28, 'Pangkajene Kepulauan'),
(334, 2, 'Pangkal Pinang'),
(335, 24, 'Paniai'),
(336, 28, 'Parepare'),
(337, 32, 'Pariaman'),
(338, 29, 'Parigi Moutong'),
(339, 32, 'Pasaman'),
(340, 32, 'Pasaman Barat'),
(341, 15, 'Paser'),
(342, 11, 'Pasuruan'),
(343, 11, 'Pasuruan'),
(344, 10, 'Pati'),
(345, 32, 'Payakumbuh'),
(346, 25, 'Pegunungan Arfak'),
(347, 24, 'Pegunungan Bintang'),
(348, 10, 'Pekalongan'),
(349, 10, 'Pekalongan'),
(350, 26, 'Pekanbaru'),
(351, 26, 'Pelalawan'),
(352, 10, 'Pemalang'),
(353, 34, 'Pematang Siantar'),
(354, 15, 'Penajam Paser Utara'),
(355, 18, 'Pesawaran'),
(356, 18, 'Pesisir Barat'),
(357, 32, 'Pesisir Selatan'),
(358, 21, 'Pidie'),
(359, 21, 'Pidie Jaya'),
(360, 28, 'Pinrang'),
(361, 7, 'Pohuwato'),
(362, 27, 'Polewali Mandar'),
(363, 11, 'Ponorogo'),
(364, 12, 'Pontianak'),
(365, 12, 'Pontianak'),
(366, 29, 'Poso'),
(367, 33, 'Prabumulih'),
(368, 18, 'Pringsewu'),
(369, 11, 'Probolinggo'),
(370, 11, 'Probolinggo'),
(371, 14, 'Pulang Pisau'),
(372, 20, 'Pulau Morotai'),
(373, 24, 'Puncak'),
(374, 24, 'Puncak Jaya'),
(375, 10, 'Purbalingga'),
(376, 9, 'Purwakarta'),
(377, 10, 'Purworejo'),
(378, 25, 'Raja Ampat'),
(379, 4, 'Rejang Lebong'),
(380, 10, 'Rembang'),
(381, 26, 'Rokan Hilir'),
(382, 26, 'Rokan Hulu'),
(383, 23, 'Rote Ndao'),
(384, 21, 'Sabang'),
(385, 23, 'Sabu Raijua'),
(386, 10, 'Salatiga'),
(387, 15, 'Samarinda'),
(388, 12, 'Sambas'),
(389, 34, 'Samosir'),
(390, 11, 'Sampang'),
(391, 12, 'Sanggau'),
(392, 24, 'Sarmi'),
(393, 8, 'Sarolangun'),
(394, 32, 'Sawah Lunto'),
(395, 12, 'Sekadau'),
(396, 28, 'Selayar (Kepulauan Selayar)'),
(397, 4, 'Seluma'),
(398, 10, 'Semarang'),
(399, 10, 'Semarang'),
(400, 19, 'Seram Bagian Barat'),
(401, 19, 'Seram Bagian Timur'),
(402, 3, 'Serang'),
(403, 3, 'Serang'),
(404, 34, 'Serdang Bedagai'),
(405, 14, 'Seruyan'),
(406, 26, 'Siak'),
(407, 34, 'Sibolga'),
(408, 28, 'Sidenreng Rappang/Rapang'),
(409, 11, 'Sidoarjo'),
(410, 29, 'Sigi'),
(411, 32, 'Sijunjung (Sawah Lunto Sijunjung)'),
(412, 23, 'Sikka'),
(413, 34, 'Simalungun'),
(414, 21, 'Simeulue'),
(415, 12, 'Singkawang'),
(416, 28, 'Sinjai'),
(417, 12, 'Sintang'),
(418, 11, 'Situbondo'),
(419, 5, 'Sleman'),
(420, 32, 'Solok'),
(421, 32, 'Solok'),
(422, 32, 'Solok Selatan'),
(423, 28, 'Soppeng'),
(424, 25, 'Sorong'),
(425, 25, 'Sorong'),
(426, 25, 'Sorong Selatan'),
(427, 10, 'Sragen'),
(428, 9, 'Subang'),
(429, 21, 'Subulussalam'),
(430, 9, 'Sukabumi'),
(431, 9, 'Sukabumi'),
(432, 14, 'Sukamara'),
(433, 10, 'Sukoharjo'),
(434, 23, 'Sumba Barat'),
(435, 23, 'Sumba Barat Daya'),
(436, 23, 'Sumba Tengah'),
(437, 23, 'Sumba Timur'),
(438, 22, 'Sumbawa'),
(439, 22, 'Sumbawa Barat'),
(440, 9, 'Sumedang'),
(441, 11, 'Sumenep'),
(442, 8, 'Sungaipenuh'),
(443, 24, 'Supiori'),
(444, 11, 'Surabaya'),
(445, 10, 'Surakarta (Solo)'),
(446, 13, 'Tabalong'),
(447, 1, 'Tabanan'),
(448, 28, 'Takalar'),
(449, 25, 'Tambrauw'),
(450, 16, 'Tana Tidung'),
(451, 28, 'Tana Toraja'),
(452, 13, 'Tanah Bumbu'),
(453, 32, 'Tanah Datar'),
(454, 13, 'Tanah Laut'),
(455, 3, 'Tangerang'),
(456, 3, 'Tangerang'),
(457, 3, 'Tangerang Selatan'),
(458, 18, 'Tanggamus'),
(459, 34, 'Tanjung Balai'),
(460, 8, 'Tanjung Jabung Barat'),
(461, 8, 'Tanjung Jabung Timur'),
(462, 17, 'Tanjung Pinang'),
(463, 34, 'Tapanuli Selatan'),
(464, 34, 'Tapanuli Tengah'),
(465, 34, 'Tapanuli Utara'),
(466, 13, 'Tapin'),
(467, 16, 'Tarakan'),
(468, 9, 'Tasikmalaya'),
(469, 9, 'Tasikmalaya'),
(470, 34, 'Tebing Tinggi'),
(471, 8, 'Tebo'),
(472, 10, 'Tegal'),
(473, 10, 'Tegal'),
(474, 25, 'Teluk Bintuni'),
(475, 25, 'Teluk Wondama'),
(476, 10, 'Temanggung'),
(477, 20, 'Ternate'),
(478, 20, 'Tidore Kepulauan'),
(479, 23, 'Timor Tengah Selatan'),
(480, 23, 'Timor Tengah Utara'),
(481, 34, 'Toba Samosir'),
(482, 29, 'Tojo Una-Una'),
(483, 29, 'Toli-Toli'),
(484, 24, 'Tolikara'),
(485, 31, 'Tomohon'),
(486, 28, 'Toraja Utara'),
(487, 11, 'Trenggalek'),
(488, 19, 'Tual'),
(489, 11, 'Tuban'),
(490, 18, 'Tulang Bawang'),
(491, 18, 'Tulang Bawang Barat'),
(492, 11, 'Tulungagung'),
(493, 28, 'Wajo'),
(494, 30, 'Wakatobi'),
(495, 24, 'Waropen'),
(496, 18, 'Way Kanan'),
(497, 10, 'Wonogiri'),
(498, 10, 'Wonosobo'),
(499, 24, 'Yahukimo'),
(500, 24, 'Yalimo'),
(501, 5, 'Yogyakarta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_merek`
--

CREATE TABLE `tbl_merek` (
  `id_merek` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `nama_merek` varchar(50) NOT NULL,
  `seo_merek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_merek`
--

INSERT INTO `tbl_merek` (`id_merek`, `id_kategori`, `nama_merek`, `seo_merek`) VALUES
(50, 8, 'RS', 'rs');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `id_order` varchar(20) NOT NULL,
  `status_ord` varchar(50) NOT NULL,
  `tgl_order` date NOT NULL,
  `jam_order` time NOT NULL,
  `id_customer` int(11) NOT NULL,
  `kurir` varchar(50) NOT NULL,
  `service` varchar(50) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `expired` datetime NOT NULL,
  `id_prov` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `kodepos` varchar(20) NOT NULL,
  `alamat_o` text NOT NULL,
  `nmpenerima` varchar(50) NOT NULL,
  `jmlberat` varchar(50) NOT NULL,
  `no_res` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_orders`
--

INSERT INTO `tbl_orders` (`id_order`, `status_ord`, `tgl_order`, `jam_order`, `id_customer`, `kurir`, `service`, `ongkir`, `total`, `expired`, `id_prov`, `id_kota`, `kodepos`, `alamat_o`, `nmpenerima`, `jmlberat`, `no_res`) VALUES
('1030213162100', 'Barang Telah Diterima', '2020-02-13', '16:21:00', 1, 'tiki', 'REG', 24000, 314032, '2020-02-15 16:21:00', 32, 236, '12312', 'sdasdasd', 'sadasd', '500', '121212121'),
('1600210222404', 'Dibatalkan', '2020-02-10', '22:24:04', 1, 'Gojek', 'GJK', 9999, 580000, '2020-02-12 22:24:04', 999, 999, '9999', 'Jln. Parak Karakah No 21 C', 'Egova', '1000', '99923123'),
('2190219102130', 'Menunggu Pembayaran', '2020-02-19', '10:21:30', 2, 'jne', 'REG', 22000, 602023, '2020-02-21 10:21:30', 31, 73, 'Nisi quo sed ut quas', 'Irure aut cumque est', 'Ex consequuntur quam', '1000', ''),
('2330208215515', 'Barang Telah Diterima', '2020-03-08', '21:55:15', 2, 'Gojek', 'GJK', 0, 290000, '2020-02-10 21:55:15', 999, 999, '9999', 'Autem adipisci dolor', 'Minim laboris asperi', '500', ''),
('2430208215751', 'Menunggu Pembayaran', '2020-02-08', '21:57:51', 2, 'Gojek', 'GJK', 0, 290000, '2020-02-10 21:57:51', 999, 999, '9999', 'Odio deserunt velit ', 'Quis eos enim ut de', '500', ''),
('2440208220346', 'Menunggu Pembayaran', '2020-02-08', '22:03:46', 2, 'Gojek', 'GJK', 9999, 290000, '2020-02-10 22:03:46', 999, 999, '9999', 'Ad voluptate volupta', 'Quis eius ea dolor q', '500', ''),
('2450208215850', 'Menunggu Pembayaran', '2020-02-08', '21:58:50', 2, 'Gojek', 'GJK', 9999, 290000, '2020-02-10 21:58:50', 999, 999, '9999', 'Accusantium ut corpo', 'Ipsum nulla dicta i', '500', ''),
('2850208220011', 'Menunggu Pembayaran', '2020-02-08', '22:00:11', 2, 'Gojek', 'GJK', 9999, 290000, '2020-02-10 22:00:11', 999, 999, '9999', 'Qui et magna qui exc', 'Mollit consequuntur ', '500', ''),
('3310208232431', 'Barang Telah Diterima', '2020-02-08', '23:24:31', 3, 'Gojek', 'GJK', 9999, 290000, '2020-02-10 23:24:31', 999, 999, '9999', 'Padang', 'Ferri Achmad', '500', '151321089'),
('5320219103000', 'Menunggu Pembayaran', '2020-02-19', '10:30:00', 5, 'gojek', '', 0, 290006, '2020-02-21 10:30:00', 32, 318, '123', 'gunung pangilun', 'aaa', '500', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_orders_detail`
--

CREATE TABLE `tbl_orders_detail` (
  `id_order` varchar(20) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jml` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_orders_detail`
--

INSERT INTO `tbl_orders_detail` (`id_order`, `id_produk`, `jml`) VALUES
('1400206152535', 1, 1),
('1250206181305', 1, 1),
('1300208110348', 1, 1),
('1300208110348', 12, 1),
('2760208123459', 8, 1),
('2930208123745', 4, 1),
('2370208124218', 11, 1),
('2010208124344', 11, 1),
('2080208135230', 11, 1),
('2870208141547', 4, 1),
('2850208141803', 4, 1),
('3850208143448', 4, 1),
('2120208143554', 11, 1),
('2840208143615', 10, 1),
('2840208144349', 11, 1),
('2570208211554', 5, 1),
('2570208211554', 4, 1),
('2760208212001', 10, 1),
('2990208212242', 4, 1),
('2590208212704', 11, 1),
('2790208212845', 5, 1),
('2450208214028', 5, 1),
('2620208214202', 9, 1),
('2730208215130', 9, 1),
('2850208220011', 11, 1),
('2440208220346', 11, 1),
('3310208232431', 5, 1),
('1600210222404', 3, 1),
('1600210222404', 6, 1),
('1030213162100', 9, 1),
('2190219102130', 3, 1),
('2190219102130', 3, 1),
('5320219103000', 10, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(5) NOT NULL,
  `kd_produk` varchar(20) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `id_merek` int(5) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `berat` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga_lama` int(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` text NOT NULL,
  `foto1` text NOT NULL,
  `foto2` text NOT NULL,
  `foto3` text NOT NULL,
  `foto4` text NOT NULL,
  `status` enum('Y','T') NOT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `terjual` int(11) NOT NULL,
  `judul_seo` varchar(100) NOT NULL,
  `tglinput` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `kd_produk`, `id_kategori`, `id_merek`, `judul`, `berat`, `deskripsi`, `harga_lama`, `harga`, `foto`, `foto1`, `foto2`, `foto3`, `foto4`, `status`, `jenis`, `stok`, `terjual`, `judul_seo`, `tglinput`) VALUES
(3, 'DRS01', 8, 50, 'DRESS 01', '500', '<p></p><div><div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit odio repellat hic pariatur quisquam reiciendis, possimus tempore alias. Praesentium qui eaque illo laboriosam doloribus porro eveniet alias id totam esse?</div></div><p></p>', 300000, 290000, '20200208075307A1.png', '20200208075307A2.png', '20200208075307A3.png', '', '', 'Y', 'Baru', 8, 0, 'dress-01', '2020-02-08'),
(4, 'DRS02', 8, 50, 'DRESS 02', '500', '<p></p><div><div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit odio repellat hic pariatur quisquam reiciendis, possimus tempore alias. Praesentium qui eaque illo laboriosam doloribus porro eveniet alias id totam esse?</div></div><p></p>', 300000, 290000, '20200208075407B1.png', '20200208075407B2.png', '20200208075407B3.png', '', '', 'Y', 'Baru', 24, 0, 'dress-02', '2020-02-08'),
(5, 'DRS03', 8, 50, 'DRESS 03', '500', '<p></p><div><div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit odio repellat hic pariatur quisquam reiciendis, possimus tempore alias. Praesentium qui eaque illo laboriosam doloribus porro eveniet alias id totam esse?</div></div><p></p>', 300000, 290000, '20200208075448C1.png', '20200208075448C2.png', '20200208075448C3.png', '', '', 'Y', 'Baru', 0, 2, 'dress-03', '2020-02-08'),
(6, 'DRS04', 8, 50, 'DRESS 04', '500', '<p></p><div><div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit odio repellat hic pariatur quisquam reiciendis, possimus tempore alias. Praesentium qui eaque illo laboriosam doloribus porro eveniet alias id totam esse?</div></div><p></p>', 300000, 290000, '20200208075539D1.png', '20200208075539D2.png', '20200208075539D3.png', '', '', 'Y', 'Baru', 0, 0, 'dress-04', '2020-02-08'),
(7, 'DRS05', 8, 50, 'DRESS 05', '500', '<p></p><div><div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit odio repellat hic pariatur quisquam reiciendis, possimus tempore alias. Praesentium qui eaque illo laboriosam doloribus porro eveniet alias id totam esse?</div></div><p></p>', 300000, 290000, '20200208075623E1.png', '20200208075623E2.png', '20200208075623E3.png', '', '', 'Y', 'Baru', 20, 0, 'dress-05', '2020-02-08'),
(8, 'DRS06', 8, 50, 'DRESS 06', '500', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit odio repellat hic pariatur quisquam reiciendis, possimus tempore alias. Praesentium qui eaque illo laboriosam doloribus porro eveniet alias id totam esse?<br></p>', 300000, 290000, '20200208075715F1.png', '20200208075715F2.png', '20200208075715F3.png', '', '', 'Y', 'Baru', 19, 0, 'dress-06', '2020-02-08'),
(9, 'DRS07', 8, 50, 'DRESS 07', '500', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit odio repellat hic pariatur quisquam reiciendis, possimus tempore alias. Praesentium qui eaque illo laboriosam doloribus porro eveniet alias id totam esse?<br></p>', 300000, 290000, '20200208075801G1.png', '20200208075801G2.png', '20200208075801G3.png', '', '', 'Y', 'Baru', 27, 0, 'dress-07', '2020-02-08'),
(10, 'DRS08', 8, 50, 'DRESS 08', '500', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit odio repellat hic pariatur quisquam reiciendis, possimus tempore alias. Praesentium qui eaque illo laboriosam doloribus porro eveniet alias id totam esse?<br></p>', 300000, 290000, '20200208080042H1.png', '20200208080042H2.png', '', '20200208080042H3.png', '', 'Y', 'Baru', 17, 0, 'dress-08', '2020-02-08'),
(11, 'DRS09', 8, 50, 'DRESS 09', '500', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit odio repellat hic pariatur quisquam reiciendis, possimus tempore alias. Praesentium qui eaque illo laboriosam doloribus porro eveniet alias id totam esse?<br></p>', 300000, 290000, '20200208080131I1.png', '20200208080131I2.png', '20200208080131I3.png', '', '', 'Y', 'Baru', 12, 0, 'dress-09', '2020-02-08'),
(12, 'DRS10', 8, 50, 'DRESS 10', '500', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit odio repellat hic pariatur quisquam reiciendis, possimus tempore alias. Praesentium qui eaque illo laboriosam doloribus porro eveniet alias id totam esse?<br></p>', 300000, 290000, '20200208080216J1.png', '20200208080216J2.png', '20200208080216J3.png', '', '', 'Y', 'Baru', -1, 1, 'dress-10', '2020-02-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_provinsi`
--

CREATE TABLE `tbl_provinsi` (
  `id_prov` int(11) NOT NULL,
  `nama_prov` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_provinsi`
--

INSERT INTO `tbl_provinsi` (`id_prov`, `nama_prov`) VALUES
(1, 'Bali'),
(2, 'Bangka Belitung'),
(3, 'Banten'),
(4, 'Bengkulu'),
(5, 'DI Yogyakarta'),
(6, 'DKI Jakarta'),
(7, 'Gorontalo'),
(8, 'Jambi'),
(9, 'Jawa Barat'),
(10, 'Jawa Tengah'),
(11, 'Jawa Timur'),
(12, 'Kalimantan Barat'),
(13, 'Kalimantan Selatan'),
(14, 'Kalimantan Tengah'),
(15, 'Kalimantan Timur'),
(16, 'Kalimantan Utara'),
(17, 'Kepulauan Riau'),
(18, 'Lampung'),
(19, 'Maluku'),
(20, 'Maluku Utara'),
(21, 'Nanggroe Aceh Darussalam (NAD)'),
(22, 'Nusa Tenggara Barat (NTB)'),
(23, 'Nusa Tenggara Timur (NTT)'),
(24, 'Papua'),
(25, 'Papua Barat'),
(26, 'Riau'),
(27, 'Sulawesi Barat'),
(28, 'Sulawesi Selatan'),
(29, 'Sulawesi Tengah'),
(30, 'Sulawesi Tenggara'),
(31, 'Sulawesi Utara'),
(32, 'Sumatera Barat'),
(33, 'Sumatera Selatan'),
(34, 'Sumatera Utara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_slide`
--

CREATE TABLE `tbl_slide` (
  `id_slide` int(11) NOT NULL,
  `gambar_1` text NOT NULL,
  `gambar_2` text NOT NULL,
  `gambar_3` text NOT NULL,
  `logo_1` text NOT NULL,
  `logo_2` text NOT NULL,
  `logo_3` text NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(20) NOT NULL,
  `nama_1` varchar(50) NOT NULL,
  `nama_2` varchar(50) NOT NULL,
  `harga_1` int(20) NOT NULL,
  `harga_2` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_slide`
--

INSERT INTO `tbl_slide` (`id_slide`, `gambar_1`, `gambar_2`, `gambar_3`, `logo_1`, `logo_2`, `logo_3`, `nama`, `harga`, `nama_1`, `nama_2`, `harga_1`, `harga_2`) VALUES
(1, '20200210223201bf86bc3a-cde6-4b2a-a221-db2e5257941f_169.jpeg', '20200208082128banner.jpg', '20200208082128banner.jpg', '20181015151716giant-apple-logo-bw.png', '20180808142856samsung_logo.png', '20181015151658giant-apple-logo-bw.png', 'iPhone 7 128GB  Second ORIGINAL 100%', 6099000, 'Samsung Galaxy Note8 Second ORIGINAL 100%', 'iPhone 7 Plus 128GB Second ORIGINAL 100%', 8499000, 8499000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_status_orders`
--

CREATE TABLE `tbl_status_orders` (
  `id_status` int(11) NOT NULL,
  `id_order` varchar(20) NOT NULL,
  `status_order` varchar(50) NOT NULL,
  `tgl_status` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_status_orders`
--

INSERT INTO `tbl_status_orders` (`id_status`, `id_order`, `status_order`, `tgl_status`) VALUES
(80, '22220606120518', 'Pembayaran Diterima', '2018-06-06 12:12:43'),
(81, '22220606120518', 'Terkirim', '2018-06-06 12:13:13'),
(82, '22720606122002', 'Menunggu Pembayaran', '2018-06-06 12:20:02'),
(83, '23810606232854', 'Menunggu Pembayaran', '2018-06-06 23:28:54'),
(84, '23810606232854', 'Barang Tengah Disiapkan', '2018-06-06 23:30:29'),
(85, '21420606233107', 'Menunggu Pembayaran', '2018-06-06 23:31:07'),
(86, '420607000108', 'Menunggu Pembayaran', '2018-06-07 00:01:08'),
(87, '22670607100012', 'Menunggu Pembayaran', '2018-06-07 10:00:12'),
(88, '22270607101034', 'Menunggu Pembayaran', '2018-06-07 10:10:34'),
(89, '22720607101118', 'Menunggu Pembayaran', '2018-06-07 10:11:18'),
(90, '22960607122201', 'Menunggu Pembayaran', '2018-06-07 12:22:01'),
(91, '22340607131028', 'Menunggu Pembayaran', '2018-06-07 13:10:28'),
(92, '22420607135530', 'Menunggu Pembayaran', '2018-06-07 13:55:30'),
(93, '22300607214208', 'Menunggu Pembayaran', '2018-06-07 21:42:08'),
(94, '23520607233529', 'Menunggu Pembayaran', '2018-06-07 23:35:29'),
(95, '23520607233529', 'Barang Tengah Disiapkan', '2018-06-07 23:37:26'),
(96, '23520607233529', 'Terkirim', '2018-06-07 23:37:52'),
(97, '23280608121121', 'Menunggu Pembayaran', '2018-06-08 12:11:21'),
(98, '23940608121319', 'Menunggu Pembayaran', '2018-06-08 12:13:19'),
(99, '23280608121121', 'Terkirim', '2018-06-08 12:15:57'),
(100, '22300607214208', 'Terkirim', '2018-06-08 12:18:50'),
(101, '22550608141343', 'Menunggu Pembayaran', '2018-06-08 14:13:43'),
(102, '22360608141511', 'Menunggu Pembayaran', '2018-06-08 14:15:11'),
(103, '22260608141603', 'Menunggu Pembayaran', '2018-06-08 14:16:03'),
(104, '22400608141649', 'Menunggu Pembayaran', '2018-06-08 14:16:49'),
(105, '22380608141733', 'Menunggu Pembayaran', '2018-06-08 14:17:33'),
(106, '22330608142016', 'Menunggu Pembayaran', '2018-06-08 14:20:16'),
(107, '22860608142746', 'Menunggu Pembayaran', '2018-06-08 14:27:46'),
(108, '22360608143043', 'Menunggu Pembayaran', '2018-06-08 14:30:43'),
(109, '22250608143235', 'Menunggu Pembayaran', '2018-06-08 14:32:35'),
(110, '22030608144033', 'Menunggu Pembayaran', '2018-06-08 14:40:33'),
(111, '22780608144235', 'Menunggu Pembayaran', '2018-06-08 14:42:35'),
(112, '22930608144257', 'Menunggu Pembayaran', '2018-06-08 14:42:57'),
(113, '22300608144329', 'Menunggu Pembayaran', '2018-06-08 14:43:29'),
(114, '22940608144721', 'Menunggu Pembayaran', '2018-06-08 14:47:21'),
(115, '22930608145323', 'Menunggu Pembayaran', '2018-06-08 14:53:23'),
(116, '22550608145715', 'Menunggu Pembayaran', '2018-06-08 14:57:15'),
(117, '22340608150039', 'Menunggu Pembayaran', '2018-06-08 15:00:39'),
(118, '22810608150315', 'Menunggu Pembayaran', '2018-06-08 15:03:15'),
(119, '23750610045757', 'Menunggu Pembayaran', '2018-06-10 04:57:57'),
(120, '23750610045757', 'Barang Tengah Disiapkan', '2018-06-10 05:02:50'),
(121, '23750610045757', 'Pembayaran Diterima', '2018-06-10 05:04:30'),
(122, '23750610045757', 'Terkirim', '2018-06-10 05:05:06'),
(123, '23750610045757', 'Pembayaran Diterima', '2018-06-10 05:05:11'),
(124, '23750610045757', 'Terkirim', '2018-06-10 05:05:35'),
(125, '23620610050710', 'Menunggu Pembayaran', '2018-06-10 05:07:10'),
(126, '23620610050710', 'Barang Tengah Disiapkan', '2018-06-10 05:08:08'),
(127, '23620610050710', 'Terkirim', '2018-06-10 05:08:59'),
(128, '23620610050710', 'Terkirim', '2018-06-10 05:11:55'),
(129, '23620610050710', 'Terkirim', '2018-06-10 05:12:28'),
(130, '23620610050710', 'Terkirim', '2018-06-10 05:12:40'),
(131, '25700610134225', 'Menunggu Pembayaran', '2018-06-10 13:42:25'),
(132, '26480620102930', 'Menunggu Pembayaran', '2018-06-20 10:29:30'),
(133, '26480620102930', 'Pembayaran Diterima', '2018-06-20 10:32:52'),
(134, '26480620102930', 'Barang Tengah Disiapkan', '2018-06-20 10:32:58'),
(135, '26480620102930', 'Terkirim', '2018-06-20 10:33:07'),
(136, '26480620102930', 'Barang Telah Diterima', '2018-06-20 10:33:16'),
(137, '26480620102930', 'Dibatalkan', '2018-06-20 10:33:21'),
(138, '26480620102930', 'Terkirim', '2018-06-20 10:33:32'),
(139, '23960621210704', 'Menunggu Pembayaran', '2018-06-21 21:07:04'),
(140, '23960621210704', 'Barang Tengah Disiapkan', '2018-06-21 21:09:23'),
(141, '23960621210704', 'Terkirim', '2018-06-21 21:10:00'),
(142, '23620610050710', 'Barang Telah Diterima', '2018-06-21 21:10:25'),
(143, '23960621210704', 'Terkirim', '2018-06-21 21:11:01'),
(144, '23800621212733', 'Menunggu Pembayaran', '2018-06-21 21:27:33'),
(145, '24480621213547', 'Menunggu Pembayaran', '2018-06-21 21:35:47'),
(146, '24480621213547', 'Pembayaran Diterima', '2018-06-21 21:43:48'),
(147, '23960621210704', 'Barang Telah Diterima', '2018-06-21 21:44:03'),
(148, '24480621213547', 'Barang Tengah Disiapkan', '2018-06-21 21:44:21'),
(149, '23800621212733', 'Barang Tengah Disiapkan', '2018-06-21 21:44:40'),
(150, '24480621213547', 'Terkirim', '2018-06-21 21:44:57'),
(151, '24480621213547', 'Barang Telah Diterima', '2018-06-21 21:45:22'),
(152, '23620610050710', 'Barang Telah Diterima', '2018-06-22 08:48:42'),
(153, '23800621212733', 'Terkirim', '2018-06-22 08:49:55'),
(154, '24340703191104', 'Menunggu Pembayaran', '2018-07-03 19:11:04'),
(155, '27730703192319', 'Menunggu Pembayaran', '2018-07-03 19:23:19'),
(156, '27730703192319', 'Pembayaran Diterima', '2018-07-03 19:25:55'),
(157, '27730703192319', 'Barang Tengah Disiapkan', '2018-07-03 19:26:16'),
(158, '27730703192319', 'Terkirim', '2018-07-03 19:27:04'),
(159, '27730703192319', 'Terkirim', '2018-07-03 19:27:30'),
(160, '30370729101055', 'Menunggu Pembayaran', '2018-07-29 10:10:55'),
(161, '27030731154304', 'Menunggu Pembayaran', '2018-07-31 15:43:04'),
(162, '22530731161959', 'Menunggu Pembayaran', '2018-07-31 16:19:59'),
(163, '27340801104733', 'Menunggu Pembayaran', '2018-08-01 10:47:33'),
(164, '22390801111133', 'Menunggu Pembayaran', '2018-08-01 11:11:33'),
(165, '30920802184640', 'Menunggu Pembayaran', '2018-08-02 18:46:40'),
(166, '30920802184640', 'Barang Tengah Disiapkan', '2018-08-02 19:01:24'),
(167, '30920802184640', 'Barang Tengah Disiapkan', '2018-08-02 19:08:15'),
(168, '30920802184640', 'Barang Tengah Disiapkan', '2018-08-02 19:08:26'),
(169, '39790806205228', 'Menunggu Pembayaran', '2018-08-06 20:52:28'),
(170, '45570806215412', 'Menunggu Pembayaran', '2018-08-06 21:54:12'),
(171, '49000806231130', 'Menunggu Pembayaran', '2018-08-06 23:11:30'),
(172, '52390807005007', 'Menunggu Pembayaran', '2018-08-07 00:50:07'),
(173, '57430807070157', 'Menunggu Pembayaran', '2018-08-07 07:01:57'),
(174, '60770807084144', 'Menunggu Pembayaran', '2018-08-07 08:41:44'),
(175, '68250807141801', 'Menunggu Pembayaran', '2018-08-07 14:18:01'),
(176, '75670807222742', 'Menunggu Pembayaran', '2018-08-07 22:27:42'),
(177, '76810808002738', 'Menunggu Pembayaran', '2018-08-08 00:27:38'),
(178, '77030808064536', 'Menunggu Pembayaran', '2018-08-08 06:45:36'),
(179, '77440808065656', 'Menunggu Pembayaran', '2018-08-08 06:56:56'),
(180, '78340808104622', 'Menunggu Pembayaran', '2018-08-08 10:46:22'),
(181, '78340808104622', 'Pembayaran Diterima', '2018-08-08 16:59:07'),
(182, '73700809001203', 'Menunggu Pembayaran', '2018-08-09 00:12:03'),
(183, '93520809131942', 'Menunggu Pembayaran', '2018-08-09 13:19:42'),
(184, '94340809145735', 'Menunggu Pembayaran', '2018-08-09 14:57:35'),
(185, '78340808104622', 'Barang Tengah Disiapkan', '2018-08-09 18:14:51'),
(186, '100480809202930', 'Menunggu Pembayaran', '2018-08-09 20:29:30'),
(187, '109190809233209', 'Menunggu Pembayaran', '2018-08-09 23:32:09'),
(188, '109280809234354', 'Menunggu Pembayaran', '2018-08-09 23:43:54'),
(189, '76810808002738', 'Barang Tengah Disiapkan', '2018-08-10 00:05:13'),
(190, '121100810092803', 'Menunggu Pembayaran', '2018-08-10 09:28:03'),
(191, '126130810130742', 'Menunggu Pembayaran', '2018-08-10 13:07:42'),
(192, '78340808104622', 'Barang Tengah Disiapkan', '2018-08-10 17:32:44'),
(193, '78340808104622', 'Terkirim', '2018-08-10 17:37:51'),
(194, '134650811060145', 'Menunggu Pembayaran', '2018-08-11 06:01:45'),
(195, '109250811084422', 'Menunggu Pembayaran', '2018-08-11 08:44:22'),
(196, '31230811093657', 'Menunggu Pembayaran', '2018-08-11 09:36:57'),
(197, '31230811093657', 'Pembayaran Diterima', '2018-08-11 09:37:44'),
(198, '134650811060145', 'Barang Tengah Disiapkan', '2018-08-11 10:46:10'),
(199, '78340808104622', 'Terkirim', '2018-08-11 10:49:57'),
(200, '78340808104622', 'Terkirim', '2018-08-11 10:50:19'),
(201, '121280811110543', 'Menunggu Pembayaran', '2018-08-11 11:05:43'),
(202, '121280811110543', 'Barang Tengah Disiapkan', '2018-08-11 11:12:47'),
(203, '22920811111620', 'Menunggu Pembayaran', '2018-08-11 11:16:20'),
(204, '22920811111620', 'Pembayaran Diterima', '2018-08-11 11:19:04'),
(205, '22920811111620', 'Barang Tengah Disiapkan', '2018-08-11 12:38:54'),
(206, '22920811111620', 'Pembayaran Diterima', '2018-08-11 12:46:01'),
(207, '22920811111620', 'Pembayaran Diterima', '2018-08-11 12:47:02'),
(208, '22920811111620', 'Pembayaran Diterima', '2018-08-11 12:47:30'),
(209, '22920811111620', 'Barang Tengah Disiapkan', '2018-08-11 12:54:29'),
(210, '22920811111620', 'Barang Tengah Disiapkan', '2018-08-11 12:55:12'),
(211, '22920811111620', 'Pembayaran Diterima', '2018-08-11 12:55:19'),
(212, '22920811111620', 'Pembayaran Diterima', '2018-08-11 12:56:24'),
(213, '22920811111620', 'Pembayaran Diterima', '2018-08-11 12:58:01'),
(214, '22920811111620', 'Pembayaran Diterima', '2018-08-11 12:59:47'),
(215, '22920811111620', 'Pembayaran Diterima', '2018-08-11 13:00:09'),
(216, '22920811111620', 'Pembayaran Diterima', '2018-08-11 13:04:04'),
(217, '22920811111620', 'Pembayaran Diterima', '2018-08-11 13:04:14'),
(218, '22920811111620', 'Pembayaran Diterima', '2018-08-11 13:04:48'),
(219, '22920811111620', 'Pembayaran Diterima', '2018-08-11 13:04:57'),
(220, '22920811111620', 'Pembayaran Diterima', '2018-08-11 13:12:02'),
(221, '22920811111620', 'Pembayaran Diterima', '2018-08-11 13:12:52'),
(222, '22920811111620', 'Barang Tengah Disiapkan', '2018-08-11 13:13:06'),
(223, '22920811111620', 'Barang Tengah Disiapkan', '2018-08-11 13:13:23'),
(224, '22920811111620', 'Terkirim', '2018-08-11 13:13:30'),
(225, '22920811111620', 'Pembayaran Diterima', '2018-08-11 13:29:56'),
(226, '22920811111620', 'Pembayaran Diterima', '2018-08-11 13:33:00'),
(227, '22920811111620', 'Terkirim', '2018-08-11 13:33:09'),
(228, '22920811111620', 'Terkirim', '2018-08-11 13:34:00'),
(229, '22920811111620', 'Pembayaran Diterima', '2018-08-11 13:34:45'),
(230, '22920811111620', 'Pembayaran Diterima', '2018-08-11 13:34:52'),
(231, '22920811111620', 'Pembayaran Diterima', '2018-08-11 13:35:01'),
(232, '22920811111620', 'Barang Tengah Disiapkan', '2018-08-11 13:35:08'),
(233, '22920811111620', 'Terkirim', '2018-08-11 13:35:20'),
(234, '22920811111620', 'Pembayaran Diterima', '2018-08-11 14:14:14'),
(235, '22920811111620', 'Pembayaran Diterima', '2018-08-11 14:14:21'),
(236, '22920811111620', 'Barang Tengah Disiapkan', '2018-08-11 14:14:27'),
(237, '22920811111620', 'Terkirim', '2018-08-11 14:14:34'),
(238, '22920811111620', 'Pembayaran Diterima', '2018-08-11 14:14:54'),
(239, '22920811111620', 'Barang Tengah Disiapkan', '2018-08-11 14:15:04'),
(240, '22920811111620', 'Terkirim', '2018-08-11 14:15:25'),
(241, '22920811111620', 'Barang Telah Diterima', '2018-08-11 14:15:46'),
(242, '22920811111620', 'Barang Telah Diterima', '2018-08-11 14:15:56'),
(243, '22920811111620', 'Barang Tengah Disiapkan', '2018-08-11 14:16:43'),
(244, '22920811111620', 'Terkirim', '2018-08-11 14:17:07'),
(245, '22920811111620', 'Barang Telah Diterima', '2018-08-11 14:17:19'),
(246, '22920811111620', 'Barang Tengah Disiapkan', '2018-08-11 14:17:40'),
(247, '22920811111620', 'Terkirim', '2018-08-11 14:17:49'),
(248, '22920811111620', 'Barang Telah Diterima', '2018-08-11 14:17:57'),
(249, '22920811111620', 'Barang Tengah Disiapkan', '2018-08-11 14:19:00'),
(250, '22920811111620', 'Pembayaran Diterima', '2018-08-11 14:19:42'),
(251, '22920811111620', 'Terkirim', '2018-08-11 14:19:57'),
(252, '22920811111620', 'Terkirim', '2018-08-11 14:20:05'),
(253, '22920811111620', 'Terkirim', '2018-08-11 14:20:12'),
(254, '22920811111620', 'Terkirim', '2018-08-11 14:20:19'),
(255, '22920811111620', 'Terkirim', '2018-08-11 14:20:24'),
(256, '22920811111620', 'Terkirim', '2018-08-11 14:20:29'),
(257, '22920811111620', 'Terkirim', '2018-08-11 14:20:35'),
(258, '22920811111620', 'Terkirim', '2018-08-11 14:21:12'),
(259, '22920811111620', 'Terkirim', '2018-08-11 14:21:18'),
(260, '22920811111620', 'Terkirim', '2018-08-11 14:21:23'),
(261, '22920811111620', 'Terkirim', '2018-08-11 14:21:33'),
(262, '22920811111620', 'Terkirim', '2018-08-11 14:21:40'),
(263, '22920811111620', 'Pembayaran Diterima', '2018-08-11 14:38:58'),
(264, '22920811111620', 'Proses Pengiriman', '2018-08-11 14:39:03'),
(265, '63150811152927', 'Menunggu Pembayaran', '2018-08-11 15:29:27'),
(266, '63180811160718', 'Menunggu Pembayaran', '2018-08-11 16:07:18'),
(267, '141800811200412', 'Menunggu Pembayaran', '2018-08-11 20:04:12'),
(268, '140950811230243', 'Menunggu Pembayaran', '2018-08-11 23:02:43'),
(269, '45350812112856', 'Menunggu Pembayaran', '2018-08-12 11:28:56'),
(270, '134650811060145', 'Proses Pengiriman', '2018-08-12 14:36:30'),
(271, '63770812152237', 'Menunggu Pembayaran', '2018-08-12 15:22:37'),
(272, '76810808002738', 'Proses Pengiriman', '2018-08-12 16:36:05'),
(273, '121280811110543', 'Proses Pengiriman', '2018-08-12 16:37:17'),
(274, '78340808104622', 'Proses Pengiriman', '2018-08-12 16:40:41'),
(275, '76810808002738', 'Proses Pengiriman', '2018-08-12 17:05:40'),
(276, '63180811160718', 'Proses Pengiriman', '2018-08-12 17:06:31'),
(277, '121280811110543', 'Proses Pengiriman', '2018-08-12 17:06:57'),
(278, '140950811230243', 'Barang Tengah Disiapkan', '2018-08-12 17:15:17'),
(279, '140950811230243', 'Barang Tengah Disiapkan', '2018-08-12 23:18:03'),
(280, '140950811230243', 'Proses Pengiriman', '2018-08-12 23:18:13'),
(281, '63180811160718', 'Barang Telah Diterima', '2018-08-13 14:49:51'),
(282, '152150813181450', 'Menunggu Pembayaran', '2018-08-13 18:14:50'),
(283, '154860814020923', 'Menunggu Pembayaran', '2018-08-14 02:09:23'),
(284, '153250815104401', 'Menunggu Pembayaran', '2018-08-15 10:44:01'),
(285, '160630815183355', 'Menunggu Pembayaran', '2018-08-15 18:33:55'),
(286, '134650811060145', 'Barang Telah Diterima', '2018-08-15 19:42:35'),
(287, '78340808104622', 'Barang Telah Diterima', '2018-08-15 19:43:34'),
(288, '121280811110543', 'Barang Telah Diterima', '2018-08-15 19:52:01'),
(289, '160410816035932', 'Menunggu Pembayaran', '2018-08-16 03:59:32'),
(290, '167410817231944', 'Menunggu Pembayaran', '2018-08-17 23:19:44'),
(291, '140950811230243', 'Barang Telah Diterima', '2018-08-19 15:34:15'),
(292, '153250815104401', 'Dibatalkan', '2018-08-19 15:35:41'),
(293, '154860814020923', 'Dibatalkan', '2018-08-19 15:36:02'),
(294, '160410816035932', 'Dibatalkan', '2018-08-19 15:37:24'),
(295, '160630815183355', 'Dibatalkan', '2018-08-19 15:37:41'),
(296, '45350812112856', 'Dibatalkan', '2018-08-19 15:38:27'),
(297, '76810808002738', 'Barang Telah Diterima', '2018-08-19 15:38:41'),
(298, '185790820193324', 'Menunggu Pembayaran', '2018-08-20 19:33:24'),
(299, '160410816035932', 'Barang Tengah Disiapkan', '2018-08-20 19:35:05'),
(300, '30560820193738', 'Menunggu Pembayaran', '2018-08-20 19:37:38'),
(301, '187720821094206', 'Menunggu Pembayaran', '2018-08-21 09:42:06'),
(302, '190740821134823', 'Menunggu Pembayaran', '2018-08-21 13:48:23'),
(303, '185790820193324', 'Barang Tengah Disiapkan', '2018-08-21 18:05:24'),
(304, '185790820193324', 'Barang Tengah Disiapkan', '2018-08-22 10:48:23'),
(305, '185790820193324', 'Proses Pengiriman', '2018-08-22 10:48:32'),
(306, '190740821134823', 'Barang Tengah Disiapkan', '2018-08-23 19:03:32'),
(307, '190740821134823', 'Proses Pengiriman', '2018-08-24 17:46:28'),
(308, '211370824193316', 'Menunggu Pembayaran', '2018-08-24 19:33:16'),
(309, '211370824193316', 'Barang Tengah Disiapkan', '2018-08-25 15:49:50'),
(310, '211370824193316', 'Barang Tengah Disiapkan', '2018-08-25 15:53:34'),
(311, '27890825162902', 'Menunggu Pembayaran', '2018-08-25 16:29:02'),
(312, '27890825162902', 'Barang Tengah Disiapkan', '2018-08-25 16:30:16'),
(313, '27890825162902', 'Proses Pengiriman', '2018-08-25 16:30:35'),
(314, '27890825162902', 'Barang Telah Diterima', '2018-08-25 16:31:24'),
(315, '22210827102814', 'Menunggu Pembayaran', '2018-08-27 10:28:14'),
(316, '22460827105017', 'Menunggu Pembayaran', '2018-08-27 10:50:17'),
(317, '22100827105152', 'Menunggu Pembayaran', '2018-08-27 10:51:52'),
(318, '222350827163637', 'Menunggu Pembayaran', '2018-08-27 16:36:37'),
(319, '222350827163637', 'Barang Tengah Disiapkan', '2018-08-27 18:11:11'),
(320, '211370824193316', 'Proses Pengiriman', '2018-08-27 18:35:36'),
(321, '185790820193324', 'Barang Telah Diterima', '2018-08-28 10:17:01'),
(322, '190740821134823', 'Barang Telah Diterima', '2018-08-28 10:17:20'),
(323, '211370824193316', 'Barang Telah Diterima', '2018-08-28 10:17:42'),
(324, '222350827163637', 'Proses Pengiriman', '2018-08-28 17:34:14'),
(325, '229000829131355', 'Menunggu Pembayaran', '2018-08-29 13:13:55'),
(326, '222350827163637', 'Barang Telah Diterima', '2018-08-29 19:47:47'),
(327, '210710830123543', 'Menunggu Pembayaran', '2018-08-30 12:35:43'),
(328, '840830144352', 'Menunggu Pembayaran', '2018-08-30 14:43:52'),
(329, '420830144438', 'Menunggu Pembayaran', '2018-08-30 14:44:38'),
(330, '236120830145101', 'Menunggu Pembayaran', '2018-08-30 14:51:01'),
(331, '236120830145101', 'Barang Tengah Disiapkan', '2018-08-30 20:34:05'),
(332, '840830144352', 'Dibatalkan', '2018-08-30 21:17:38'),
(333, '420830144438', 'Dibatalkan', '2018-08-30 21:17:45'),
(334, '236120830145101', 'Proses Pengiriman', '2018-08-31 15:15:38'),
(335, '210710830123543', 'Proses Pengiriman', '2018-09-01 00:30:43'),
(336, '229000829131355', 'Dibatalkan', '2018-09-01 12:27:54'),
(337, '229000829131355', 'Barang Tengah Disiapkan', '2018-09-01 12:53:41'),
(338, '247530901163205', 'Menunggu Pembayaran', '2018-09-01 16:32:05'),
(339, '240320901193642', 'Menunggu Pembayaran', '2018-09-01 19:36:42'),
(340, '236120830145101', 'Barang Telah Diterima', '2018-09-02 13:41:24'),
(341, '240320901193642', 'Dibatalkan', '2018-09-03 15:46:02'),
(342, '247530901163205', 'Dibatalkan', '2018-09-03 15:46:06'),
(343, '229000829131355', 'Barang Telah Diterima', '2018-09-04 19:38:39'),
(344, '210710830123543', 'Barang Telah Diterima', '2018-09-06 15:16:46'),
(345, '234520906161856', 'Menunggu Pembayaran', '2018-09-06 16:18:56'),
(346, '259370906181953', 'Menunggu Pembayaran', '2018-09-06 18:19:53'),
(347, '259370906181953', 'Dibatalkan', '2018-09-07 01:43:37'),
(348, '234520906161856', 'Dibatalkan', '2018-09-07 01:43:45'),
(349, '234520906161856', 'Proses Pengiriman', '2018-09-07 13:40:34'),
(350, '259370906181953', 'Barang Tengah Disiapkan', '2018-09-07 14:48:00'),
(351, '25320907150539', 'Menunggu Pembayaran', '2018-09-07 15:05:39'),
(352, '31740908103206', 'Menunggu Pembayaran', '2018-09-08 10:32:06'),
(353, '25320907150539', 'Dibatalkan', '2018-09-08 14:13:28'),
(354, '25320907150539', 'Dibatalkan', '2018-09-08 14:13:37'),
(355, '31740908103206', 'Dibatalkan', '2018-09-08 14:14:21'),
(356, '63600910085953', 'Menunggu Pembayaran', '2018-09-10 08:59:53'),
(357, '271940911102048', 'Menunggu Pembayaran', '2018-09-11 10:20:48'),
(358, '234520906161856', 'Barang Telah Diterima', '2018-09-11 15:07:38'),
(359, '272980911190253', 'Menunggu Pembayaran', '2018-09-11 19:02:53'),
(360, '259370906181953', 'Dibatalkan', '2018-09-12 12:53:16'),
(361, '275440912182145', 'Menunggu Pembayaran', '2018-09-12 18:21:45'),
(362, '274190914152305', 'Menunggu Pembayaran', '2018-09-14 15:23:05'),
(363, '178380915105824', 'Menunggu Pembayaran', '2018-09-15 10:58:24'),
(364, '178380915105824', 'Barang Tengah Disiapkan', '2018-09-15 16:03:50'),
(365, '292280916142024', 'Menunggu Pembayaran', '2018-09-16 14:20:24'),
(366, '301380919103138', 'Menunggu Pembayaran', '2018-09-19 10:31:38'),
(367, '178380915105824', 'Barang Telah Diterima', '2018-09-19 17:05:27'),
(368, '303650919195744', 'Menunggu Pembayaran', '2018-09-19 19:57:44'),
(369, '75320921070508', 'Menunggu Pembayaran', '2018-09-21 07:05:08'),
(370, '310420921121109', 'Menunggu Pembayaran', '2018-09-21 12:11:09'),
(371, '312020922002754', 'Menunggu Pembayaran', '2018-09-22 00:27:54'),
(372, '315740923125135', 'Menunggu Pembayaran', '2018-09-23 12:51:35'),
(373, '320600925004707', 'Menunggu Pembayaran', '2018-09-25 00:47:07'),
(374, '337670930154123', 'Menunggu Pembayaran', '2018-09-30 15:41:23'),
(375, '338831001133701', 'Menunggu Pembayaran', '2018-10-01 13:37:01'),
(376, '338831001133701', 'Barang Tengah Disiapkan', '2018-10-02 16:25:13'),
(377, '347891004144630', 'Menunggu Pembayaran', '2018-10-04 14:46:30'),
(378, '355721009115927', 'Menunggu Pembayaran', '2018-10-09 11:59:27'),
(379, '372541011171115', 'Menunggu Pembayaran', '2018-10-11 17:11:15'),
(380, '1400206152535', 'Menunggu Pembayaran', '2020-02-06 15:25:35'),
(381, '1250206181305', 'Menunggu Pembayaran', '2020-02-06 18:13:05'),
(382, '1300208110348', 'Menunggu Pembayaran', '2020-02-08 11:03:48'),
(383, '1300208110348', 'Proses Pengiriman', '2020-02-08 11:06:18'),
(384, '2760208123459', 'Menunggu Pembayaran', '2020-02-08 12:34:59'),
(385, '2930208123745', 'Menunggu Pembayaran', '2020-02-08 12:37:45'),
(386, '2370208124218', 'Menunggu Pembayaran', '2020-02-08 12:42:18'),
(387, '2010208124344', 'Menunggu Pembayaran', '2020-02-08 12:43:44'),
(388, '2080208135230', 'Menunggu Pembayaran', '2020-02-08 13:52:30'),
(389, '2870208141547', 'Menunggu Pembayaran', '2020-02-08 14:15:47'),
(390, '2850208141803', 'Menunggu Pembayaran', '2020-02-08 14:18:03'),
(391, '3850208143448', 'Menunggu Pembayaran', '2020-02-08 14:34:48'),
(392, '2120208143554', 'Menunggu Pembayaran', '2020-02-08 14:35:54'),
(393, '2840208143615', 'Menunggu Pembayaran', '2020-02-08 14:36:15'),
(394, '2600208144152', 'Menunggu Pembayaran', '2020-02-08 14:41:52'),
(395, '2840208144349', 'Menunggu Pembayaran', '2020-02-08 14:43:49'),
(396, '2570208211554', 'Menunggu Pembayaran', '2020-02-08 21:15:54'),
(397, '2760208212001', 'Menunggu Pembayaran', '2020-02-08 21:20:01'),
(398, '2990208212242', 'Menunggu Pembayaran', '2020-02-08 21:22:42'),
(399, '2590208212704', 'Menunggu Pembayaran', '2020-02-08 21:27:04'),
(400, '2790208212845', 'Menunggu Pembayaran', '2020-02-08 21:28:45'),
(401, '2450208214028', 'Menunggu Pembayaran', '2020-02-08 21:40:28'),
(402, '2620208214202', 'Menunggu Pembayaran', '2020-02-08 21:42:02'),
(403, '2730208215130', 'Menunggu Pembayaran', '2020-02-08 21:51:30'),
(404, '2850208220011', 'Menunggu Pembayaran', '2020-02-08 22:00:11'),
(405, '2440208220346', 'Menunggu Pembayaran', '2020-02-08 22:03:46'),
(406, '3310208232431', 'Menunggu Pembayaran', '2020-02-08 23:24:31'),
(407, '3310208232431', 'Pembayaran Diterima', '2020-02-08 23:30:07'),
(408, '3310208232431', 'Barang Tengah Disiapkan', '2020-02-08 23:30:17'),
(409, '3310208232431', 'Proses Pengiriman', '2020-02-08 23:30:23'),
(410, '3310208232431', 'Proses Pengiriman', '2020-02-08 23:30:33'),
(411, '3310208232431', 'Barang Telah Diterima', '2020-02-08 23:30:43'),
(412, '1600210222404', 'Menunggu Pembayaran', '2020-02-10 22:24:04'),
(413, '1600210222404', 'Pembayaran Diterima', '2020-02-10 22:25:47'),
(414, '1600210222404', 'Proses Pengiriman', '2020-02-10 22:26:28'),
(415, '1600210222404', 'Dibatalkan', '2020-02-10 22:26:58'),
(416, '1030213162100', 'Menunggu Pembayaran', '2020-02-13 16:21:00'),
(417, '1030213162100', 'Pembayaran Diterima', '2020-02-14 10:03:59'),
(418, '1030213162100', 'Barang Telah Diterima', '2020-02-14 11:15:16'),
(419, '2330208215515', 'Barang Telah Diterima', '2020-02-14 11:16:48'),
(420, '2190219102130', 'Menunggu Pembayaran', '2020-02-19 10:21:30'),
(421, '5320219103000', 'Menunggu Pembayaran', '2020-02-19 10:30:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_testimonial`
--

CREATE TABLE `tbl_testimonial` (
  `id_testi` int(10) NOT NULL,
  `id_customer` int(10) NOT NULL,
  `isi_testi` text NOT NULL,
  `tgl_testi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_testimonial`
--

INSERT INTO `tbl_testimonial` (`id_testi`, `id_customer`, `isi_testi`, `tgl_testi`) VALUES
(4, 63, 'Sumbarsmartphone emang oke\r\nbelanjanya praktis n tidak berbelit2 dan byk bonusnya apalagi kalau udh langganan\r\n', '2018-08-11 17:01:34'),
(5, 27, 'Terimakasih Sumbar Smartphone Terbaik !! Jaya Selalu.  ', '2018-08-25 16:32:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `kode_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `stok_awal` varchar(15) NOT NULL,
  `stok_terjual` varchar(15) NOT NULL,
  `stok_sisa` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `idkat` varchar(20) NOT NULL,
  `idsup` int(11) NOT NULL,
  `hpp` int(11) NOT NULL,
  `id_merek` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_level`
--

CREATE TABLE `tb_level` (
  `id_level` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `dari` int(11) NOT NULL,
  `sampai` int(11) NOT NULL,
  `hrg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_member`
--

CREATE TABLE `tb_member` (
  `id_member` varchar(20) NOT NULL,
  `nm` varchar(35) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `notelp` varchar(14) NOT NULL,
  `almt` text NOT NULL,
  `tgl_daftar` date NOT NULL,
  `tgl_diperbarui` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_member`
--

INSERT INTO `tb_member` (`id_member`, `nm`, `jk`, `notelp`, `almt`, `tgl_daftar`, `tgl_diperbarui`) VALUES
('1806050001', 'nama', 'Laki-laki', 'almt', '08x', '2018-05-04', '2019-05-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `no_nota` varchar(20) NOT NULL,
  `tgl_jual` datetime NOT NULL,
  `jns` varchar(15) NOT NULL,
  `jto` date NOT NULL,
  `pelanggan` varchar(100) NOT NULL,
  `kasir` varchar(100) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `diskon_persen` int(11) NOT NULL,
  `diskon_total` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembali` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_sales` int(11) NOT NULL,
  `status_brg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`no_nota`, `tgl_jual`, `jns`, `jto`, `pelanggan`, `kasir`, `sub_total`, `diskon_persen`, `diskon_total`, `total_harga`, `bayar`, `kembali`, `id_user`, `id_sales`, `status_brg`) VALUES
('1808221001', '2018-08-23 00:21:56', 'Tunai', '0000-00-00', '', 'Admin', 1299000, 8, 100000, 1199000, 1200000, 1000, 1, 0, ''),
('1808231002', '2018-08-23 14:11:18', 'Tunai', '0000-00-00', 'MANSUR', 'Admin', 6198000, 0, 0, 6198000, 6198000, 0, 1, 0, ''),
('1808241003', '2018-08-24 16:10:26', '', '0000-00-00', '', 'Admin', 1199000, 0, 0, 1199000, 1200000, 1000, 1, 0, ''),
('1808241004', '2018-08-24 16:13:19', '', '0000-00-00', 'rama', 'Admin', 1199000, 0, 0, 1199000, 1200000, 1000, 1, 0, ''),
('1808241005', '2018-08-24 22:45:05', '', '0000-00-00', 'MANSUR', 'Admin', 3699000, 0, 0, 3699000, 3700000, 1000, 1, 0, ''),
('1808251006', '2018-08-25 13:49:12', '', '0000-00-00', 'rama', 'Admin', 2598000, 0, 0, 2598000, 2600000, 2000, 1, 0, ''),
('1808271007', '2018-08-27 14:02:02', 'Tunai', '0000-00-00', 'rama', 'Admin', 2398000, 0, 0, 2398000, 2400000, 2000, 1, 0, ''),
('1808308001', '2018-08-30 14:41:48', 'Tunai', '0000-00-00', 'dheny', 'Gusti', 3099000, 0, 0, 3099000, 3100000, 1000, 8, 0, ''),
('1808311008', '2018-08-31 14:23:19', 'Tunai', '0000-00-00', 'MANSUR', 'Admin', 1299000, 0, 0, 1299000, 1299000, 0, 1, 0, ''),
('1809041001', '2018-09-04 15:23:32', 'Kredit', '0000-00-00', 'MANSUR', 'Admin', 1199000, 0, 0, 1199000, 500000, -699000, 1, 0, ''),
('1809049001', '2018-09-04 09:38:09', 'Tunai', '0000-00-00', 'juli', 'Bos Sumbar Smartphone', 2699000, 0, 0, 2699000, 2699000, 0, 9, 0, ''),
('1809051002', '2018-09-05 11:27:43', 'Tunai', '0000-00-00', '1', 'Admin', 1199000, 0, 0, 1199000, 1199000, 0, 1, 0, ''),
('1809051003', '2018-09-05 11:50:27', 'Tunai', '0000-00-00', '1', 'Admin', 1199000, 0, 0, 1199000, 1199000, 0, 1, 0, ''),
('1809129002', '2018-09-13 00:43:13', 'Tunai', '0000-00-00', '6', 'Bos Sumbar Smartphone', 6099000, 0, 0, 6099000, 6099000, 0, 9, 0, ''),
('1809131004', '2018-09-13 17:21:47', 'Tunai', '0000-00-00', '', 'Admin', 1299000, 0, 0, 1299000, 1300000, 1000, 1, 0, ''),
('1809131005', '2018-09-13 17:22:56', 'Tunai', '0000-00-00', '1', 'Admin', 1199000, 0, 0, 1199000, 1200000, 1000, 1, 0, ''),
('1809141006', '2018-09-14 15:51:15', 'Kredit', '0000-00-00', '3', 'Admin', 2398000, 0, 0, 2398000, 1000000, -1398000, 1, 0, ''),
('1809141007', '2018-09-14 16:06:39', 'Tunai', '0000-00-00', '3', 'Admin', 2598000, 0, 0, 2598000, 2600000, 2000, 1, 0, ''),
('1809151008', '2018-09-15 09:55:50', 'Kredit', '0000-00-00', '3', 'Admin', 4397000, 0, 0, 4397000, 2000000, -2397000, 1, 0, ''),
('1809151009', '2018-09-15 15:11:20', 'Tunai', '0000-00-00', '', 'Admin', 3498000, 0, 0, 3498000, 5000000, 1502000, 1, 0, ''),
('1809159004', '2018-09-15 14:02:43', 'Tunai', '0000-00-00', '', 'Bos Sumbar Smartphone', 2599000, 0, 0, 2599000, 2599000, 0, 9, 0, ''),
('1809191010', '2018-09-19 16:43:33', 'Tunai', '0000-00-00', '', 'Admin', 1199000, 0, 0, 1199000, 2000000, 801000, 1, 0, ''),
('1809191011', '2018-09-19 16:45:16', 'Tunai', '0000-00-00', '1', 'Admin', 1399000, 0, 0, 1399000, 2000000, 601000, 1, 0, ''),
('1809191012', '2018-09-19 16:47:02', 'Tunai', '0000-00-00', '2', 'Admin', 2598000, 0, 0, 2598000, 2600000, 2000, 1, 0, ''),
('1809209005', '2018-09-20 17:32:10', 'Tunai', '0000-00-00', '', 'Bos Sumbar Smartphone', 8899000, 0, 0, 8899000, 8899000, 0, 9, 0, ''),
('1809209006', '2018-09-20 17:35:21', 'Tunai', '0000-00-00', '8', 'Bos Sumbar Smartphone', 8899000, 0, 0, 8899000, 8899000, 0, 9, 0, ''),
('1809211013', '2018-09-21 10:53:04', 'Kredit', '0000-00-00', '1', 'Admin', 1199000, 0, 0, 1199000, 500000, -699000, 1, 8, 'BR'),
('1809211014', '2018-09-21 11:25:55', 'Kredit', '0000-00-00', '2', 'Admin', 1199000, 0, 0, 1199000, 500000, -699000, 1, 12, 'TL'),
('1809211015', '2018-09-21 12:02:29', 'Tunai', '0000-00-00', '1', 'Admin', 1299000, 0, 0, 1299000, 1300000, 1000, 1, 12, 'BR'),
('1809258001', '2018-09-25 21:19:11', 'Tunai', '0000-00-00', '10', 'Gusti', 2599000, 0, 0, 2599000, 2599000, 0, 8, 8, 'TL'),
('1809259007', '2018-09-25 20:36:31', 'Tunai', '0000-00-00', '9', 'Bos Sumbar Smartphone', 2499000, 0, 0, 2499000, 2499000, 0, 9, 13, 'TL'),
('1809268002', '2018-09-26 11:58:35', 'Tunai', '0000-00-00', '11', 'Gusti', 5199000, 100, 5199000, 0, 0, 0, 8, 10, 'TL'),
('1809268003', '2018-09-26 18:49:41', 'Tunai', '0000-00-00', '15', 'Gusti', 6699000, 10, 700000, 5999000, 5999000, 0, 8, 10, 'BR'),
('1809269008', '2018-09-26 21:30:38', 'Tunai', '0000-00-00', '16', 'Bos Sumbar Smartphone', 3299000, 9, 299000, 3000000, 3000000, 0, 9, 8, 'TL'),
('1809269009', '2018-09-26 21:33:47', 'Tunai', '0000-00-00', '18', 'Bos Sumbar Smartphone', 8499000, 4, 300000, 8199000, 8199000, 0, 9, 2, 'BR'),
('1809269010', '2018-09-26 21:38:56', 'Tunai', '0000-00-00', '20', 'Bos Sumbar Smartphone', 1349000, 15, 200000, 1149000, 1149000, 0, 9, 10, 'TL'),
('1809271016', '2018-09-27 13:05:57', 'Tunai', '0000-00-00', '1', 'Admin', 2598000, 0, 0, 2598000, 3000000, 402000, 1, 2, 'TL'),
('1809271017', '2018-09-27 13:08:51', 'Tunai', '0000-00-00', '1', 'Admin', 3597000, 0, 0, 3597000, 5000000, 1403000, 1, 6, 'TL'),
('1809278004', '2018-09-27 12:36:09', 'Tunai', '0000-00-00', '23', 'Gusti', 1349000, 22, 299000, 1050000, 1050000, 0, 8, 7, 'TL'),
('1809278005', '2018-09-27 13:01:19', 'Kredit', '0000-00-00', '25', 'Gusti', 3799000, 5, 200000, 3599000, 3599000, 0, 8, 9, 'TL'),
('1809278006', '2018-09-27 14:38:47', 'Kredit', '0000-00-00', '27', 'Gusti', 4199000, 2, 100000, 4099000, 4099000, 0, 8, 10, 'TL'),
('1809278007', '2018-09-27 16:04:23', 'Kredit', '0000-00-00', '30', 'Gusti', 5199000, 7, 349000, 4850000, 4850000, 0, 8, 12, 'TL'),
('1809278008', '2018-09-27 16:26:30', 'Tunai', '0000-00-00', '31', 'Gusti', 3699000, 1, 50000, 3649000, 3649000, 0, 8, 10, 'BR'),
('1809278009', '2018-09-27 16:40:49', 'Tunai', '0000-00-00', '33', 'Gusti', 3299000, 9, 300000, 2999000, 2999000, 0, 8, 6, 'TL'),
('1809278010', '2018-09-27 17:10:34', 'Tunai', '0000-00-00', '35', 'Gusti', 949000, 16, 149000, 800000, 800000, 0, 8, 12, 'TL'),
('1809278011', '2018-09-27 17:24:47', 'Tunai', '0000-00-00', '36', 'Gusti', 2799000, 0, 0, 2799000, 2799000, 0, 8, 9, 'TL'),
('1809278012', '2018-09-27 17:51:32', 'Kredit', '0000-00-00', '37', 'Gusti', 5199000, 7, 349000, 4850000, 4850000, 0, 8, 11, 'BR'),
('1809278013', '2018-09-27 17:53:45', 'Kredit', '0000-00-00', '38', 'Gusti', 5199000, 7, 349000, 4850000, 4850000, 0, 8, 11, 'BR'),
('1809278014', '2018-09-27 17:55:27', 'Kredit', '0000-00-00', '39', 'Gusti', 5199000, 7, 349000, 4850000, 4850000, 0, 8, 11, 'BR'),
('1809278015', '2018-09-27 18:05:26', 'Tunai', '0000-00-00', '40', 'Gusti', 5899000, 15, 900000, 4999000, 4999000, 0, 8, 10, 'TL'),
('1809278016', '2018-09-27 18:13:08', 'Tunai', '0000-00-00', '41', 'Gusti', 1349000, 15, 200000, 1149000, 1149000, 0, 8, 12, 'TL'),
('1809278017', '2018-09-27 18:38:06', 'Tunai', '0000-00-00', '43', 'Gusti', 3099000, 3, 100000, 2999000, 2999000, 0, 8, 13, 'TL'),
('1809278018', '2018-09-27 18:42:32', 'Tunai', '0000-00-00', '44', 'Gusti', 1999000, 0, 0, 1999000, 1999000, 0, 8, 6, 'TL'),
('1809278019', '2018-09-27 19:54:59', 'Tunai', '0000-00-00', '46', 'Gusti', 1699000, 18, 299000, 1400000, 1400000, 0, 8, 11, 'TL'),
('1809279011', '2018-09-27 21:46:28', 'Tunai', '0000-00-00', '47', 'Bos Sumbar Smartphone', 1699000, 23, 399000, 1300000, 1300000, 0, 9, 9, 'TL'),
('18092811001', '2018-09-28 17:02:54', 'Tunai', '0000-00-00', '54', 'Raja Terakhir', 2799000, 0, 0, 2799000, 2800000, 1000, 11, 13, 'TL'),
('18092811002', '2018-09-28 18:47:20', 'Tunai', '0000-00-00', '57', 'Raja Terakhir', 5199000, 7, 349000, 4850000, 4850000, 0, 11, 10, 'TL'),
('18092811003', '2018-09-28 20:11:21', 'Tunai', '0000-00-00', '59', 'Raja Terakhir', 1699000, 15, 249000, 1450000, 1450000, 0, 11, 6, 'TL'),
('1809288020', '2018-09-28 13:38:16', 'Kredit', '0000-00-00', '48', 'Gusti', 6599000, 2, 99000, 6500000, 6500000, 0, 8, 6, 'TL'),
('1809288021', '2018-09-28 14:36:13', 'Tunai', '0000-00-00', '49', 'Gusti', 949000, 5, 49000, 900000, 900000, 0, 8, 9, 'TL'),
('1809288022', '2018-09-28 15:02:54', 'Kredit', '0000-00-00', '50', 'Gusti', 8899000, 3, 299000, 8600000, 8600000, 0, 8, 12, 'TL'),
('1809288023', '2018-09-28 19:57:30', 'Tunai', '0000-00-00', '58', 'Gusti', 6099000, 2, 99000, 6000000, 6000000, 0, 8, 13, 'TL'),
('1809298024', '2018-09-29 10:48:11', 'Tunai', '0000-00-00', '60', 'Gusti', 949000, 16, 149000, 800000, 800000, 0, 8, 11, 'TL'),
('1809298025', '2018-09-29 11:30:48', 'Kredit', '0000-00-00', '62', 'Gusti', 5199000, 7, 349000, 4850000, 4850000, 0, 8, 7, 'BR'),
('1809298026', '2018-09-29 13:21:53', 'Kredit', '0000-00-00', '64', 'Gusti', 2499000, 0, 0, 2499000, 2499000, 0, 8, 8, 'TL'),
('1809298027', '2018-09-29 13:39:40', 'Tunai', '0000-00-00', '65', 'Gusti', 5199000, 7, 349000, 4850000, 4850000, 0, 8, 6, 'TL'),
('1809298028', '2018-09-29 13:45:38', 'Tunai', '0000-00-00', '66', 'Gusti', 1699000, 15, 249000, 1450000, 1450000, 0, 8, 12, 'TL'),
('1809298029', '2018-09-29 14:11:26', 'Kredit', '0000-00-00', '67', 'Gusti', 14899000, 6, 899000, 14000000, 14000000, 0, 8, 11, 'BR'),
('1809298030', '2018-09-29 14:22:44', 'Kredit', '0000-00-00', '68', 'Gusti', 2499000, 0, 0, 2499000, 2499000, 0, 8, 8, 'TL'),
('1809298031', '2018-09-29 14:57:19', 'Kredit', '0000-00-00', '69', 'Gusti', 13099000, 5, 699000, 12400000, 12400000, 0, 8, 12, 'BR'),
('1809298032', '2018-09-29 15:00:40', 'Tunai', '0000-00-00', '70', 'Gusti', 6699000, 10, 699000, 6000000, 6000000, 0, 8, 13, 'TL'),
('1809298033', '2018-09-29 15:06:53', 'Tunai', '0000-00-00', '71', 'Gusti', 2499000, 0, 0, 2499000, 2499000, 0, 8, 6, 'TL'),
('1809298034', '2018-09-29 15:09:45', 'Tunai', '0000-00-00', '72', 'Gusti', 2499000, 100, 2499000, 0, 0, 0, 8, 11, 'TL'),
('18093011004', '2018-09-30 10:52:46', 'Tunai', '0000-00-00', '75', 'Raja Terakhir', 949000, 5, 49000, 900000, 900000, 0, 11, 10, 'TL'),
('18093011005', '2018-09-30 11:08:04', 'Kredit', '0000-00-00', '76', 'Raja Terakhir', 7499000, 4, 299000, 7200000, 7200000, 0, 11, 7, 'BR'),
('18093011006', '2018-09-30 11:54:13', 'Tunai', '0000-00-00', '78', 'Raja Terakhir', 2499000, 0, 0, 2499000, 2500000, 1000, 11, 10, 'TL'),
('18093011007', '2018-09-30 11:58:37', 'Tunai', '0000-00-00', '77', 'Raja Terakhir', 6099000, 2, 99000, 6000000, 6000000, 0, 11, 11, 'BR'),
('1809308035', '2018-09-30 13:35:56', 'Tunai', '0000-00-00', '80', 'Gusti', 2499000, 0, 0, 2499000, 2499000, 0, 8, 11, 'TL'),
('1809308036', '2018-09-30 13:49:59', 'Tunai', '0000-00-00', '81', 'Gusti', 8499000, 4, 299000, 8200000, 8200000, 0, 8, 10, 'TL'),
('1809308037', '2018-09-30 14:07:14', 'Kredit', '0000-00-00', '82', 'Gusti', 6599000, 2, 99000, 6500000, 6500000, 0, 8, 7, 'BR'),
('1809308038', '2018-09-30 16:00:58', 'Tunai', '0000-00-00', '83', 'Gusti', 5199000, 7, 349000, 4850000, 4850000, 0, 8, 10, 'TL'),
('1809308039', '2018-09-30 16:19:09', 'Tunai', '0000-00-00', '84', 'Gusti', 2799000, 0, 0, 2799000, 2799000, 0, 8, 9, 'TL'),
('1809308040', '2018-09-30 18:42:25', 'Kredit', '0000-00-00', '85', 'Gusti', 6699000, 10, 699000, 6000000, 6000000, 0, 8, 12, 'TL'),
('1809308041', '2018-09-30 19:23:44', 'Tunai', '0000-00-00', '86', 'Gusti', 2499000, 0, 0, 2499000, 2499000, 0, 8, 10, 'TL'),
('1809308042', '2018-09-30 20:53:41', 'Tunai', '0000-00-00', '87', 'Gusti', 2499000, 0, 0, 2499000, 2499000, 0, 8, 10, 'TL'),
('1809308043', '2018-09-30 21:17:12', 'Tunai', '0000-00-00', '88', 'Gusti', 4199000, 5, 199000, 4000000, 4000000, 0, 8, 6, 'TL'),
('18100111001', '2018-10-01 21:50:20', 'Tunai', '0000-00-00', '101', 'Raja Terakhir', 1699000, 18, 299000, 1400000, 1400000, 0, 11, 13, 'TL'),
('1810018001', '2018-10-01 10:48:16', 'Tunai', '0000-00-00', '89', 'Gusti', 1699000, 18, 299000, 1400000, 1400000, 0, 8, 7, 'BR'),
('1810018002', '2018-10-01 13:40:51', 'Tunai', '0000-00-00', '90', 'Gusti', 5199000, 7, 349000, 4850000, 4850000, 0, 8, 7, 'TL'),
('1810018003', '2018-10-01 15:29:42', 'Tunai', '0000-00-00', '91', 'Gusti', 1349000, 15, 199000, 1150000, 1150000, 0, 8, 8, 'TL'),
('1810018004', '2018-10-01 15:41:44', 'Tunai', '0000-00-00', '92', 'Gusti', 1349000, 22, 299000, 1050000, 1050000, 0, 8, 13, 'TL'),
('1810018005', '2018-10-01 16:38:55', 'Kredit', '0000-00-00', '93', 'Gusti', 2799000, 0, 0, 2799000, 2799000, 0, 8, 12, 'TL'),
('1810018006', '2018-10-01 17:44:04', 'Tunai', '0000-00-00', '95', 'Gusti', 1349000, 15, 199000, 1150000, 1150000, 0, 8, 6, 'TL'),
('1810018007', '2018-10-01 18:16:03', 'Tunai', '0000-00-00', '96', 'Gusti', 1349000, 15, 199000, 1150000, 1150000, 0, 8, 13, 'TL'),
('1810018008', '2018-10-01 18:32:06', 'Tunai', '0000-00-00', '97', 'Gusti', 1699000, 18, 299000, 1400000, 1400000, 0, 8, 12, 'TL'),
('1810018009', '2018-10-01 19:05:21', 'Tunai', '0000-00-00', '98', 'Gusti', 1699000, 23, 399000, 1300000, 1300000, 0, 8, 6, 'TL'),
('1810018010', '2018-10-01 19:30:49', 'Tunai', '0000-00-00', '100', 'Gusti', 1699000, 18, 299000, 1400000, 1400000, 0, 8, 6, 'TL'),
('1810018011', '2018-10-01 19:42:41', 'Kredit', '0000-00-00', '99', 'Gusti', 1699000, 15, 249000, 1450000, 1450000, 0, 8, 14, 'BR'),
('18100211002', '2018-10-02 16:28:45', 'Kredit', '0000-00-00', '104', 'Raja Terakhir', 6099000, 2, 100000, 5999000, 5999000, 0, 11, 14, 'TL'),
('18100211003', '2018-10-02 16:37:28', 'Tunai', '0000-00-00', '105', 'Raja Terakhir', 1699000, 23, 399000, 1300000, 1300000, 0, 11, 7, 'BR'),
('18100211004', '2018-10-02 17:07:49', 'Tunai', '0000-00-00', '106', 'Raja Terakhir', 1349000, 11, 149000, 1200000, 1200000, 0, 11, 9, 'TL'),
('18100211005', '2018-10-02 18:05:13', 'Tunai', '0000-00-00', '111', 'Raja Terakhir', 1699000, 18, 299000, 1400000, 1400000, 0, 11, 6, 'TL'),
('18100211006', '2018-10-02 19:08:29', 'Tunai', '0000-00-00', '112', 'Raja Terakhir', 1699000, 18, 299000, 1400000, 1400000, 0, 11, 10, 'TL'),
('18100211007', '2018-10-02 20:37:38', 'Tunai', '0000-00-00', '114', 'Raja Terakhir', 1349000, 11, 149000, 1200000, 1200000, 0, 11, 13, 'TL'),
('18100211008', '2018-10-02 20:41:42', 'Kredit', '0000-00-00', '115', 'Raja Terakhir', 1699000, 18, 299000, 1400000, 1400000, 0, 11, 14, 'BR'),
('18100211009', '2018-10-02 21:25:18', 'Kredit', '0000-00-00', '', 'Raja Terakhir', 13199000, 2, 200000, 12999000, 12999000, 0, 11, 14, 'BR'),
('1810028012', '2018-10-02 13:49:34', 'Tunai', '0000-00-00', '102', 'Gusti', 8899000, 3, 299000, 8600000, 8600000, 0, 8, 11, 'TL'),
('1810028013', '2018-10-02 13:53:27', 'Tunai', '0000-00-00', '103', 'Gusti', 1699000, 18, 299000, 1400000, 1400000, 0, 8, 6, 'TL'),
('1810028014', '2018-10-02 17:15:54', 'Kredit', '0000-00-00', '107', 'Gusti', 5199000, 7, 349000, 4850000, 4850000, 0, 8, 6, 'TL'),
('1810028015', '2018-10-02 19:57:39', 'Tunai', '0000-00-00', '113', 'Gusti', 2699000, 0, 0, 2699000, 2699000, 0, 8, 9, 'TL'),
('1810038016', '2018-10-03 11:06:05', 'Tunai', '0000-00-00', '117', 'Gusti', 2599000, 4, 99000, 2500000, 2500000, 0, 8, 10, 'TL'),
('1810038017', '2018-10-03 11:25:43', 'Tunai', '0000-00-00', '118', 'Gusti', 8499000, 96, 8199000, 300000, 300000, 0, 8, 12, 'BR'),
('1810038018', '2018-10-03 11:54:06', 'Tunai', '0000-00-00', '119', 'Gusti', 949000, 16, 149000, 800000, 800000, 0, 8, 12, 'TL'),
('1810038019', '2018-10-03 11:56:18', 'Tunai', '0000-00-00', '120', 'Gusti', 1349000, 18, 249000, 1100000, 1100000, 0, 8, 12, 'TL'),
('1810038020', '2018-10-03 11:58:24', 'Tunai', '0000-00-00', '121', 'Gusti', 5199000, 7, 349000, 4850000, 4850000, 0, 8, 10, 'TL'),
('1810038021', '2018-10-03 13:11:30', 'Tunai', '0000-00-00', '122', 'Gusti', 2599000, 0, 0, 2599000, 2599000, 0, 8, 11, 'BR'),
('1810038022', '2018-10-03 13:13:33', 'Tunai', '0000-00-00', '123', 'Gusti', 2599000, 0, 0, 2599000, 2599000, 0, 8, 11, 'TL'),
('1810038023', '2018-10-03 15:11:08', 'Tunai', '0000-00-00', '124', 'Gusti', 8899000, 2, 199000, 8700000, 8700000, 0, 8, 9, 'TL'),
('1810038024', '2018-10-03 15:11:52', 'Tunai', '0000-00-00', '124', 'Gusti', 8899000, 2, 199000, 8700000, 8700000, 0, 8, 9, 'TL'),
('1810038025', '2018-10-03 16:30:09', 'Tunai', '0000-00-00', '126', 'Gusti', 5199000, 7, 349000, 4850000, 4850000, 0, 8, 10, 'TL'),
('1810038026', '2018-10-03 18:29:13', 'Tunai', '0000-00-00', '127', 'Gusti', 2599000, 2, 49000, 2550000, 2550000, 0, 8, 10, 'TL'),
('1810038027', '2018-10-03 19:05:09', 'Tunai', '0000-00-00', '129', 'Gusti', 2599000, 4, 99000, 2500000, 2500000, 0, 8, 9, 'TL'),
('1810038028', '2018-10-03 19:08:07', 'Tunai', '0000-00-00', '130', 'Gusti', 2599000, 4, 99000, 2500000, 2500000, 0, 8, 10, 'BR'),
('1810038029', '2018-10-03 19:09:32', 'Tunai', '0000-00-00', '131', 'Gusti', 2599000, 4, 99000, 2500000, 2500000, 0, 8, 10, 'BR'),
('1810038030', '2018-10-03 19:32:15', 'Kredit', '0000-00-00', '132', 'Gusti', 2599000, 0, 0, 2599000, 2599000, 0, 8, 14, 'BR'),
('1810038031', '2018-10-03 19:52:27', 'Tunai', '0000-00-00', '133', 'Gusti', 949000, 5, 49000, 900000, 900000, 0, 8, 14, 'TL'),
('1810038032', '2018-10-03 20:18:00', 'Tunai', '0000-00-00', '135', 'Gusti', 1699000, 76, 1299000, 400000, 400000, 0, 8, 10, 'TL'),
('1810038033', '2018-10-03 20:42:40', 'Tunai', '0000-00-00', '136', 'Gusti', 5199000, 7, 349000, 4850000, 4850000, 0, 8, 8, 'TL'),
('1810038034', '2018-10-03 20:46:54', 'Kredit', '0000-00-00', '137', 'Gusti', 6099000, 2, 99000, 6000000, 6000000, 0, 8, 10, 'TL'),
('1810038035', '2018-10-03 21:37:02', 'Kredit', '0000-00-00', '138', 'Gusti', 1699000, 18, 299000, 1400000, 1400000, 0, 8, 14, 'TL'),
('1810038036', '2018-10-03 21:43:23', 'Tunai', '0000-00-00', '140', 'Gusti', 1349000, 11, 149000, 1200000, 1200000, 0, 8, 14, 'TL'),
('1810128037', '2018-10-12 11:08:07', 'Tunai', '0000-00-00', '141', 'Gusti', 1349000, 11, 149000, 1200000, 1200000, 0, 8, 10, 'TL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `kode_user` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` longtext NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `keterangan` longtext NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`kode_user`, `username`, `password`, `pass`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `no_telepon`, `keterangan`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Admin', 'Laki-laki', 'Jl. ABC', '080000000000', 'Keterangan', 'admin'),
(8, 'gusti', 'f60e63b604887c81bdfd5388f58c961b', 'gusti02', 'Gusti', 'Perempuan', 'Jl. Alanglaweh', '08082283120825', 'Kasir Sumbar Smartphone\n', 'kasir'),
(9, 'deltritumbin', '65dcdc8793912367561a2b6b801645da', 'virion091', 'Bos Sumbar Smartphone', 'Laki-laki', 'Jl. Cendana Mata Air Tahap 6 Blok EE 26 Padang Selatan', '085365889623', 'Owner\n', 'admin'),
(10, 'dede', '2b31e130b6015a529444aa2fc3139b08', 'sumbar2512', 'Manager Dede', 'Laki-laki', 'Kubu Tanjung', '08156465456', 'fadawda', 'admin'),
(11, 'omesyourbae', 'befe9f8a14346e3e52c762f333395796', 'qawsed', 'Raja Terakhir', 'Laki-laki', 'Negeri Para Bedebah', '081270907795', 'Level is just a number !', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkat`);

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`kd_admin`);

--
-- Indeks untuk tabel `tbl_alamat`
--
ALTER TABLE `tbl_alamat`
  ADD PRIMARY KEY (`id_alamat`);

--
-- Indeks untuk tabel `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indeks untuk tabel `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `tbl_data`
--
ALTER TABLE `tbl_data`
  ADD PRIMARY KEY (`id_data`);

--
-- Indeks untuk tabel `tbl_faq`
--
ALTER TABLE `tbl_faq`
  ADD PRIMARY KEY (`id_faq`);

--
-- Indeks untuk tabel `tbl_garansi`
--
ALTER TABLE `tbl_garansi`
  ADD PRIMARY KEY (`id_garansi`);

--
-- Indeks untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `tbl_konfirmasi_bayar`
--
ALTER TABLE `tbl_konfirmasi_bayar`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indeks untuk tabel `tbl_kontak`
--
ALTER TABLE `tbl_kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indeks untuk tabel `tbl_kota`
--
ALTER TABLE `tbl_kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indeks untuk tabel `tbl_merek`
--
ALTER TABLE `tbl_merek`
  ADD PRIMARY KEY (`id_merek`);

--
-- Indeks untuk tabel `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `tbl_provinsi`
--
ALTER TABLE `tbl_provinsi`
  ADD PRIMARY KEY (`id_prov`);

--
-- Indeks untuk tabel `tbl_slide`
--
ALTER TABLE `tbl_slide`
  ADD PRIMARY KEY (`id_slide`);

--
-- Indeks untuk tabel `tbl_status_orders`
--
ALTER TABLE `tbl_status_orders`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `tbl_testimonial`
--
ALTER TABLE `tbl_testimonial`
  ADD PRIMARY KEY (`id_testi`);

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indeks untuk tabel `tb_level`
--
ALTER TABLE `tb_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indeks untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`no_nota`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`kode_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `diskon`
--
ALTER TABLE `diskon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `kd_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_alamat`
--
ALTER TABLE `tbl_alamat`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_data`
--
ALTER TABLE `tbl_data`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_faq`
--
ALTER TABLE `tbl_faq`
  MODIFY `id_faq` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_garansi`
--
ALTER TABLE `tbl_garansi`
  MODIFY `id_garansi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tbl_konfirmasi_bayar`
--
ALTER TABLE `tbl_konfirmasi_bayar`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_kontak`
--
ALTER TABLE `tbl_kontak`
  MODIFY `id_kontak` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_kota`
--
ALTER TABLE `tbl_kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;

--
-- AUTO_INCREMENT untuk tabel `tbl_merek`
--
ALTER TABLE `tbl_merek`
  MODIFY `id_merek` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_provinsi`
--
ALTER TABLE `tbl_provinsi`
  MODIFY `id_prov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `tbl_slide`
--
ALTER TABLE `tbl_slide`
  MODIFY `id_slide` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_status_orders`
--
ALTER TABLE `tbl_status_orders`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=422;

--
-- AUTO_INCREMENT untuk tabel `tbl_testimonial`
--
ALTER TABLE `tbl_testimonial`
  MODIFY `id_testi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_level`
--
ALTER TABLE `tb_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `kode_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
