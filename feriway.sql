-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 04, 2023 at 06:35 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feriway`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_kapal`
--

CREATE TABLE `data_kapal` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nama_bank` varchar(255) NOT NULL,
  `nomor_rekening` varchar(255) NOT NULL,
  `pemegang_rekening` varchar(255) NOT NULL,
  `kode_bank` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kapal`
--

INSERT INTO `data_kapal` (`id`, `nama`, `nama_bank`, `nomor_rekening`, `pemegang_rekening`, `kode_bank`) VALUES
(2, 'Ferry Samandar', 'BANK BRI', '0001-01-01822-53-4', 'PT SAMANDAR', '002'),
(3, 'KAPAL 1', 'BANK BCA', '98798326193462746', 'PT KAPAL 1', '004');

-- --------------------------------------------------------

--
-- Table structure for table `data_tiket`
--

CREATE TABLE `data_tiket` (
  `id` int(11) NOT NULL,
  `kapal_id` int(11) DEFAULT NULL,
  `tanggal_keberangkatan` date DEFAULT NULL,
  `waktu_keberangkatan` time DEFAULT NULL,
  `asal` varchar(255) DEFAULT NULL,
  `tujuan` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_tiket`
--

INSERT INTO `data_tiket` (`id`, `kapal_id`, `tanggal_keberangkatan`, `waktu_keberangkatan`, `asal`, `tujuan`, `status`) VALUES
(3, 2, '2023-08-05', '12:00:00', 'Waai', 'Haruku', 1),
(4, 3, '2023-08-05', '18:00:00', 'Haruku', 'Waai', 1);

-- --------------------------------------------------------

--
-- Table structure for table `harga_tiket`
--

CREATE TABLE `harga_tiket` (
  `id` int(11) NOT NULL,
  `tiket_id` int(11) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `pakai_kendaraan` int(11) DEFAULT '0',
  `warna` varchar(255) DEFAULT '#ffffff'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `harga_tiket`
--

INSERT INTO `harga_tiket` (`id`, `tiket_id`, `harga`, `keterangan`, `pakai_kendaraan`, `warna`) VALUES
(3, 3, '15000', 'Regular 1', 0, '#00fffb'),
(4, 3, '30000', 'Penumpang + Kendaraan Roda 2', 1, '#ff0000'),
(5, 4, '30000', 'Kendaraan Roda 2', 1, '#004cff');

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pesan` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `pengguna_id` int(11) NOT NULL,
  `kapal_id` int(11) NOT NULL,
  `tiket_id` int(11) NOT NULL,
  `harga_tiket_id` int(11) NOT NULL,
  `nama_bank` varchar(255) NOT NULL,
  `nomor_rekening` varchar(255) NOT NULL,
  `pemegang_rekening` varchar(255) NOT NULL,
  `kode_referensi` varchar(255) NOT NULL,
  `slip_pembayaran` varchar(255) NOT NULL,
  `merek_kendaraan` varchar(255) DEFAULT NULL,
  `tipe_kendaraan` varchar(255) DEFAULT NULL,
  `nomor_polisi` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `tanggal` date DEFAULT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `pengguna_id`, `kapal_id`, `tiket_id`, `harga_tiket_id`, `nama_bank`, `nomor_rekening`, `pemegang_rekening`, `kode_referensi`, `slip_pembayaran`, `merek_kendaraan`, `tipe_kendaraan`, `nomor_polisi`, `status`, `tanggal`, `waktu`) VALUES
(4, 2, 2, 3, 3, 'Bank BRI', '3021-05-83472-32-8', 'Abdul Kalib', '89668960834909443545', 'slip_64cbb4913249a.pdf', '', '', '', 2, '2023-08-03', '23:07:13'),
(5, 2, 3, 4, 5, 'Bank BNI', '032703487083893', 'Ahmad', '8763287836873273', 'slip_64cc990209cfc.pdf', 'Yamaha', 'Motor', 'DE736TE', 1, '2023-08-04', '15:21:54');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) DEFAULT '0',
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `level`, `nama_lengkap`, `email`, `nomor_telepon`, `status`) VALUES
(2, 'user', 'user', 0, 'user', 'user@gmail.com', '08189239634723', 1),
(3, 'admin', 'admin', 1, 'admin', 'admin@gmail.com', '081234567890', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` longtext NOT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `isi`, `tanggal`, `waktu`) VALUES
(1, 'Perhatian Penumpang! Revisi Jadwal Keberangkatan dan Kedatangan di Pelabuhan Ferry Mulai Tanggal tertentu', 'Kepada seluruh penumpang yang berencana menggunakan layanan pelabuhan ferry, kami dengan ini memberitahukan tentang adanya revisi jadwal keberangkatan dan kedatangan kapal ferry yang akan berlaku mulai tanggal [tanggal mulai perubahan].\r\n\r\nPerubahan jadwal ini diimplementasikan untuk meningkatkan kualitas pelayanan kami kepada penumpang, serta untuk memastikan kelancaran operasional dan keamanan dalam setiap perjalanan. Kami telah mempertimbangkan berbagai aspek, termasuk lalu lintas pelayaran, ketersediaan kapal, serta umpan balik dari penumpang dalam menyusun jadwal baru ini.\r\n\r\nBerikut adalah beberapa poin penting mengenai revisi jadwal keberangkatan dan kedatangan:\r\n\r\nTanggal Mulai Berlaku:\r\n[Tanggal mulai perubahan] adalah tanggal resmi di mana jadwal baru akan diberlakukan. Sebelum tanggal tersebut, jadwal yang berlaku saat ini masih berlaku.\r\n\r\nRute yang Terpengaruh:\r\nRevisi jadwal akan mencakup beberapa rute perjalanan kami. Silakan periksa dengan cermat untuk mengetahui apakah rute perjalanan Anda termasuk yang terpengaruh.\r\n\r\nJadwal Keberangkatan dan Kedatangan Baru:\r\nJadwal keberangkatan dan kedatangan baru telah disusun untuk melayani kebutuhan penumpang dengan lebih baik. Silakan kunjungi situs web resmi kami atau hubungi layanan pelanggan kami untuk memperoleh jadwal terbaru.\r\n\r\nPeringatan dan Penyesuaian Waktu:\r\nKami menyarankan kepada semua penumpang untuk datang ke pelabuhan setidaknya 1 jam sebelum keberangkatan untuk menghindari keterlambatan. Selain itu, pastikan untuk menyesuaikan waktu perjalanan Anda dengan jadwal baru agar tidak terkena dampak perubahan ini.\r\n\r\nKami memahami bahwa perubahan jadwal ini mungkin dapat menyebabkan ketidaknyamanan bagi sebagian penumpang, namun, kami berkomitmen untuk memberikan layanan yang lebih baik dan lebih andal. Pengumuman ini akan diperbarui secara berkala sesuai dengan perkembangan terkini di pelabuhan ferry kami.\r\n\r\nTerima kasih atas pengertian dan dukungan Anda dalam menjalani perubahan ini. Semoga perjalanan Anda menyenangkan dan aman. Jika Anda memiliki pertanyaan lebih lanjut atau memerlukan bantuan, jangan ragu untuk menghubungi layanan pelanggan kami di [nomor telepon layanan pelanggan] atau melalui email di [alamat email resmi].\r\n\r\nHormat kami,\r\n\r\n[Manajemen Pelabuhan Ferry]', '2023-08-03', '22:56:59'),
(2, 'Pengumuman Urgent: Penutupan Sementara Pelabuhan Ferry karena Perbaikan dan Pemeliharaan', 'Kepada seluruh pengguna layanan pelabuhan ferry, dengan sangat disayangkan kami harus mengumumkan tentang penutupan sementara pelabuhan ferry yang akan berlangsung mulai tanggal [tanggal penutupan] hingga [tanggal dibuka kembali].\r\n\r\nPenutupan ini diperlukan untuk melakukan perbaikan dan pemeliharaan yang mendalam pada fasilitas dan infrastruktur pelabuhan agar dapat memberikan pelayanan yang lebih baik dan aman bagi para penumpang. Keputusan ini diambil setelah pertimbangan matang demi keamanan dan kenyamanan para pengguna jasa ferry.\r\n\r\nBerikut adalah beberapa informasi terkait penutupan sementara pelabuhan ferry:\r\n\r\nTanggal Penutupan dan Dibuka Kembali:\r\nPelabuhan ferry akan ditutup mulai tanggal [tanggal penutupan] dan dijadwalkan akan dibuka kembali pada tanggal [tanggal dibuka kembali]. Selama periode penutupan ini, tidak akan ada layanan penyeberangan yang tersedia.\r\n\r\nAlasan Penutupan:\r\nPenutupan pelabuhan ini diperlukan untuk melaksanakan perbaikan dan pemeliharaan yang mendalam pada dermaga, kapal, peralatan, serta fasilitas umum lainnya guna meningkatkan kualitas dan keamanan pelayanan bagi seluruh penumpang.\r\n\r\nLayanan Pengganti:\r\nSelama masa penutupan, kami akan menyediakan alternatif layanan pengganti seperti bus penghubung atau perjalanan alternatif melalui pelabuhan terdekat. Informasi lebih lanjut tentang layanan pengganti akan kami sampaikan melalui situs web resmi dan media sosial kami.\r\n\r\nInformasi Lebih Lanjut:\r\nJika Anda memiliki rencana perjalanan selama periode penutupan pelabuhan, kami sarankan untuk membatalkan atau menunda perjalanan Anda. Untuk pertanyaan lebih lanjut tentang penutupan sementara ini, silakan hubungi layanan pelanggan kami di [nomor telepon layanan pelanggan] atau melalui email di [alamat email resmi].\r\n\r\nKami memohon maaf atas ketidaknyamanan yang ditimbulkan akibat penutupan sementara ini. Semua upaya akan dilakukan untuk menyelesaikan perbaikan dengan segera dan membuka pelabuhan ferry kembali sesuai jadwal yang ditentukan.\r\n\r\nTerima kasih atas pengertian dan dukungan Anda dalam menjalani penutupan sementara ini. Kami berharap perbaikan dan pemeliharaan ini akan meningkatkan pengalaman perjalanan Anda di masa mendatang.\r\n\r\nHormat kami,\r\n\r\n[Manajemen Pelabuhan Ferry]', '2023-08-03', '22:58:17'),
(3, 'Penting! Proses Boarding Penumpang di Pelabuhan Ferry Menggunakan QR Code Mulai Tanggal Tertentu', 'Kepada seluruh penumpang yang akan menggunakan layanan pelabuhan ferry, kami dengan senang hati ingin menginformasikan tentang perubahan baru dalam proses boarding yang akan diberlakukan mulai tanggal [tanggal mulai berlakunya perubahan].\r\n\r\nSebagai bagian dari upaya kami untuk meningkatkan efisiensi dan kenyamanan proses check-in, kami akan mengadopsi sistem baru menggunakan QR Code sebagai tiket boarding Anda. Dengan menggunakan QR Code, Anda akan lebih mudah, cepat, dan aman untuk melakukan proses boarding di pelabuhan ferry.\r\n\r\nBerikut adalah beberapa hal penting terkait perubahan ini:\r\n\r\nPenggunaan QR Code:\r\nMulai tanggal [tanggal mulai berlakunya perubahan], tiket fisik berbasis kertas tidak akan lagi digunakan sebagai tiket boarding. Sebagai gantinya, penumpang diharapkan untuk menunjukkan QR Code yang sudah di-generate pada ponsel cerdas (smartphone) mereka sebagai tiket masuk.\r\n\r\nPanduan Penggunaan QR Code:\r\nUntuk menggunakan QR Code sebagai tiket boarding, penumpang harus mengunduh aplikasi resmi kami dari toko aplikasi ponsel cerdas. Setelah berhasil terdaftar, Anda akan menerima QR Code melalui email atau dalam aplikasi tersebut. Pastikan untuk menyimpan QR Code tersebut dalam ponsel Anda dan siapkan sebelum menuju ke pelabuhan ferry.\r\n\r\nKeuntungan Penggunaan QR Code:\r\nProses boarding dengan menggunakan QR Code memungkinkan Anda untuk menghindari antrian panjang dan mengurangi interaksi fisik dengan petugas. Hal ini akan mempercepat proses check-in dan membantu menjaga keamanan dan kenyamanan bagi semua penumpang.\r\n\r\nPanduan Penggunaan dan Bantuan:\r\nTim kami akan memberikan bantuan dan panduan lengkap kepada penumpang terkait cara menggunakan QR Code di pelabuhan ferry. Petugas akan tersedia untuk membantu Anda jika Anda menghadapi masalah teknis atau pertanyaan terkait penggunaan aplikasi.\r\n\r\nKami meyakini bahwa penggunaan QR Code akan membawa banyak manfaat bagi semua penumpang dalam perjalanan mereka dengan kami. Kami mohon dukungan dan kerjasama dari seluruh penumpang untuk bersama-sama menerapkan perubahan ini dengan sukses.\r\n\r\nJika Anda memiliki pertanyaan lebih lanjut atau memerlukan bantuan, jangan ragu untuk menghubungi layanan pelanggan kami di [nomor telepon layanan pelanggan] atau melalui email di [alamat email resmi].\r\n\r\nTerima kasih atas perhatian dan dukungan Anda.\r\n\r\nHormat kami,\r\n\r\n[Manajemen Pelabuhan Ferry]', '2023-08-03', '22:59:06');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pemesanan`
-- (See below for the actual view)
--
CREATE TABLE `v_pemesanan` (
`id` int(11)
,`pengguna_id` int(11)
,`kapal_id` int(11)
,`tiket_id` int(11)
,`harga_tiket_id` int(11)
,`nama_bank` varchar(255)
,`nomor_rekening` varchar(255)
,`pemegang_rekening` varchar(255)
,`kode_referensi` varchar(255)
,`slip_pembayaran` varchar(255)
,`merek_kendaraan` varchar(255)
,`tipe_kendaraan` varchar(255)
,`nomor_polisi` varchar(255)
,`status` int(11)
,`tanggal` date
,`waktu` time
,`nama_kapal` varchar(255)
,`nama_bank2` varchar(255)
,`nomor_rekening2` varchar(255)
,`pemegang_rekening2` varchar(255)
,`kode_bank2` varchar(255)
,`tanggal_keberangkatan` date
,`waktu_keberangkatan` time
,`asal` varchar(255)
,`tujuan` varchar(255)
,`tiket_status` int(11)
,`harga` varchar(255)
,`keterangan` text
,`pakai_kendaraan` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `v_pemesanan`
--
DROP TABLE IF EXISTS `v_pemesanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pemesanan`  AS SELECT `pemesanan`.`id` AS `id`, `pemesanan`.`pengguna_id` AS `pengguna_id`, `pemesanan`.`kapal_id` AS `kapal_id`, `pemesanan`.`tiket_id` AS `tiket_id`, `pemesanan`.`harga_tiket_id` AS `harga_tiket_id`, `pemesanan`.`nama_bank` AS `nama_bank`, `pemesanan`.`nomor_rekening` AS `nomor_rekening`, `pemesanan`.`pemegang_rekening` AS `pemegang_rekening`, `pemesanan`.`kode_referensi` AS `kode_referensi`, `pemesanan`.`slip_pembayaran` AS `slip_pembayaran`, `pemesanan`.`merek_kendaraan` AS `merek_kendaraan`, `pemesanan`.`tipe_kendaraan` AS `tipe_kendaraan`, `pemesanan`.`nomor_polisi` AS `nomor_polisi`, `pemesanan`.`status` AS `status`, `pemesanan`.`tanggal` AS `tanggal`, `pemesanan`.`waktu` AS `waktu`, `data_kapal`.`nama` AS `nama_kapal`, `data_kapal`.`nama_bank` AS `nama_bank2`, `data_kapal`.`nomor_rekening` AS `nomor_rekening2`, `data_kapal`.`pemegang_rekening` AS `pemegang_rekening2`, `data_kapal`.`kode_bank` AS `kode_bank2`, `data_tiket`.`tanggal_keberangkatan` AS `tanggal_keberangkatan`, `data_tiket`.`waktu_keberangkatan` AS `waktu_keberangkatan`, `data_tiket`.`asal` AS `asal`, `data_tiket`.`tujuan` AS `tujuan`, `data_tiket`.`status` AS `tiket_status`, `harga_tiket`.`harga` AS `harga`, `harga_tiket`.`keterangan` AS `keterangan`, `harga_tiket`.`pakai_kendaraan` AS `pakai_kendaraan` FROM (((`pemesanan` join `data_kapal` on((`pemesanan`.`kapal_id` = `data_kapal`.`id`))) join `data_tiket` on((`pemesanan`.`tiket_id` = `data_tiket`.`id`))) join `harga_tiket` on((`pemesanan`.`harga_tiket_id` = `harga_tiket`.`id`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_kapal`
--
ALTER TABLE `data_kapal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_tiket`
--
ALTER TABLE `data_tiket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `harga_tiket`
--
ALTER TABLE `harga_tiket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_kapal`
--
ALTER TABLE `data_kapal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_tiket`
--
ALTER TABLE `data_tiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `harga_tiket`
--
ALTER TABLE `harga_tiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
