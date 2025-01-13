-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql300.epizy.com
-- Waktu pembuatan: 28 Apr 2022 pada 07.38
-- Versi server: 10.3.27-MariaDB
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_30975912_tjaa_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(2) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', 'admin12343', 'Luky Ramadhan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir`
--

CREATE TABLE `ongkir` (
  `id_kota` int(2) NOT NULL,
  `nama_kota` varchar(25) NOT NULL,
  `tarif` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ongkir`
--

INSERT INTO `ongkir` (`id_kota`, `nama_kota`, `tarif`) VALUES
(1, 'Jakarta', 10000),
(2, 'Bogor', 15000),
(5, 'Depok', 12000),
(6, 'Tangerang', 9000),
(7, 'Bekasi', 13000),
(8, 'Kota Lainnya', 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(4) NOT NULL,
  `email_pelanggan` varchar(50) NOT NULL,
  `password_pelanggan` varchar(100) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `telepon_pelanggan` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`) VALUES
(1, 'lukyrmd1234@gmail.com', 'luky', 'Luky Ramadhan', '081319628447'),
(9, 'test@test', '$2y$10$6urJ5sEuOIQEfEAMs.Ljn.Q2nRygCq7.Q8EaZk0x5Ux0wOYTqhBVy', 'test', '1234566789101'),
(11, 'ahmad_hidayat@staff.gunadarma.ac.id', '$2y$10$iWRbB.ErTcAzb.p056.NtOYEBaMKWx3c3m0rTN9vJt/Xls2P0XgdO', 'ahmad', '08222222');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(5) NOT NULL,
  `id_pembelian` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `bank` varchar(30) NOT NULL,
  `jumlah` int(7) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(2, 14, 'test bayar 2', 'bank', 1065000, '2021-10-13', '20211013104753bind2.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(5) NOT NULL,
  `id_pelanggan` int(4) NOT NULL,
  `id_kota` int(2) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `total_pembelian` int(10) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `nama_kota` varchar(25) NOT NULL,
  `tarif` int(5) NOT NULL,
  `status_pembelian` varchar(30) NOT NULL DEFAULT 'pending',
  `resi_pengiriman` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_kota`, `tgl_pembelian`, `total_pembelian`, `alamat`, `nama_kota`, `tarif`, `status_pembelian`, `resi_pengiriman`) VALUES
(1, 1, 1, '2021-10-06', 1500000, 'abc', '', 0, 'pending', ''),
(2, 1, 1, '2021-10-13', 500000, 'bca', '', 0, 'pending', ''),
(14, 9, 1, '2021-10-10', 1065000, 'test invoice allamat 3', 'Jakarta', 15000, 'barang dikirim', 'test-resi001'),
(15, 9, 2, '2021-10-12', 22000, 'test no.3', 'Bogor', 20000, 'pending', ''),
(21, 9, 1, '2022-01-31', 15000, 'test checkout', 'Jakarta', 15000, 'pending', ''),
(22, 9, 1, '2022-01-31', 15000, 'sas', 'Jakarta', 15000, 'pending', ''),
(23, 9, 1, '2022-01-31', 15000, 'sas', 'Jakarta', 15000, 'pending', ''),
(24, 9, 1, '2022-01-31', 15000, 'ewewe', 'Jakarta', 15000, 'pending', ''),
(25, 9, 1, '2022-01-31', 25000, 'test alamat checkout', 'Jakarta', 15000, 'pending', ''),
(26, 9, 2, '2022-03-12', 35000, 'tesst bug', 'Bogor', 15000, 'pending', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pproduk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `subberat` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pproduk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `berat`, `subberat`, `subharga`) VALUES
(1, 1, 1, 1, '', 0, 0, 0, 0),
(2, 1, 2, 1, '', 0, 0, 0, 0),
(8, 14, 1, 1, 'test produk', 1000000, 1000, 1000, 1000000),
(9, 14, 15, 1, 'tambah produk', 50000, 232, 232, 50000),
(10, 15, 2, 2, 'produk 2', 1000, 10, 20, 2000),
(17, 21, 2, 1, 'Vitamin C 1000 Lemon 6s', 10000, 24, 24, 10000),
(18, 22, 2, 2, 'Vitamin C 1000 Lemon 6s', 10000, 24, 48, 20000),
(19, 24, 1, 1, 'Tolak Angin Cair Dus 12s', 45000, 450, 450, 45000),
(20, 25, 2, 1, 'Vitamin C 1000 Lemon 6s', 10000, 24, 24, 10000),
(21, 0, 15, 1, 'Wantong Jamu Dus 3Os', 90000, 150, 150, 90000),
(22, 0, 18, 1, 'Jamu Cobra Dus 12s', 50000, 105, 105, 50000),
(23, 0, 2, 1, 'Vitamin C 1000 Lemon 6s', 10000, 4, 4, 10000),
(24, 0, 2, 1, 'Vitamin C 1000 Lemon 6s', 10000, 4, 4, 10000),
(25, 26, 2, 2, 'Vitamin C 1000 Lemon 6s', 10000, 4, 8, 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `berat`, `foto_produk`, `deskripsi_produk`, `stok_produk`) VALUES
(1, 'Tolak Angin Cair Dus 12s', 40000, 15, 'Screenshot_3.png', 'Tolak Angin merupakan Obat Herbal Terstandar (OHT) yang diproduksi di pabrik yang terstandar GMP (Good Manufacturing Product), ISO (International Organization of Standardization), dan HACCP (Hazard Analysis Critical Control Point). Tolak Angin telah melalui uji toksisitas subkronik dan uji khasiat yang terbukti memelihara/menjaga daya tahan tubuh dengan mengkonsumsi 2 sachet setiap hari selama 7 hari atau lebih.\r\nManfaat: Untuk masuk angin dengan gejala kembung, mual, sakit perut, pusing, meriang, dan tenggorokan kering. Baik diminum saat perjalan jauh, kecapaian dan kurang tidur. Untuk memelihara/menjaga daya tahan tubuh.', 9),
(2, 'Vitamin C 1000 Lemon 6s', 10000, 4, 'produk_vitc.png', 'Vitamin C 1000 merupakan suplemen Vitamin C yang bermanfaat untuk membantu menjaga kesehatan tubuh setiap hari.', 7),
(15, 'Wantong Jamu Dus 3Os', 90000, 150, 'Screenshot_4-removebg-preview.png', 'Wantong Jamu  Bermanfaaat Untuk Mengobati Asam Urat, Rheumatik, Pegel Linu, Sakit Pinggang, Pundak dan Leher Terasa Kaku dan Sakit, Kaki & Tangan Kesemutan. ', 9),
(18, 'Jamu Cobra Dus 12s', 50000, 105, 'produk-kobra-removebg-preview.png', 'Cobra Jamu bermanfaat untuk mengobati gatal-gatal, alergi, kurap, eksim, dan sakit gigi.', 9),
(19, 'Jamu Anik 10s', 20000, 70, 'produk_jamuanik-removebg-preview.png', 'Sangat baik bagi perokok aktif dan melegakan tenggorokan', 5),
(20, 'Jamu Batuk 10s', 15000, 70, 'produk_jamubatuk.jfif', 'Membantu meredakan batuk berdahak', 5),
(21, 'Jamu Sakit Pinggang 10s', 15000, 70, 'produk_jamuasakitpinggang.jfif', 'Membantu meredakan sakit pinggang dan melancarkan buang air kecil', 5),
(22, 'Jamu Tujuh Angin 10s', 15000, 70, 'produk_jamu7angin.jfif', 'Membantu meredakan masuk angin dan gejalanya', 5);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pproduk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_kota` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
