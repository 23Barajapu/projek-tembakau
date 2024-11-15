-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Nov 2024 pada 03.45
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projektembakau`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota_tanis`
--

CREATE TABLE `anggota_tanis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelompok_tani_id` bigint(20) UNSIGNED NOT NULL,
  `nama_anggota` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kk` varchar(255) NOT NULL,
  `buku_nikah` varchar(255) NOT NULL,
  `ktp_path` varchar(255) DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_panen`
--

CREATE TABLE `barang_panen` (
  `id_brg` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` enum('Kg','Ton') NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar_brg` varchar(255) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang_panen`
--

INSERT INTO `barang_panen` (`id_brg`, `nama`, `harga`, `stok`, `satuan`, `deskripsi`, `gambar_brg`, `kategori_id`, `created_at`, `updated_at`) VALUES
('BRG001', 'Tembakau', 200000, 50, 'Kg', 'Tembakau Grade A yang berkualitas baik', 'tembakau4.jpg', 1, NULL, NULL),
('BRG002', 'Tembakau Rare', 120000, 100, 'Kg', 'Tembakau Grade B yang berkualitas baik', 'tembakau5.jpeg', 2, NULL, NULL),
('BRG003', 'Tembakau', 100000, 30, 'Kg', 'Tembakau Grade C yang berkualitas baik', 'tembakau3.jpeg', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_panens`
--

CREATE TABLE `barang_panens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar_tahaps`
--

CREATE TABLE `gambar_tahaps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tahapan_id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Segera','Sedang berlangsung','Selesai') NOT NULL DEFAULT 'Segera',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_pmsan`
--

CREATE TABLE `item_pmsan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `keranjang_id` bigint(20) UNSIGNED NOT NULL,
  `pemesanan_id` varchar(20) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lahan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_tanam` date NOT NULL,
  `pupuk` varchar(255) NOT NULL,
  `bibit` varchar(255) NOT NULL,
  `status` enum('Belum','Selesai') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Grade A', NULL, NULL),
(2, 'Grade B', NULL, NULL),
(3, 'Grade C', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelompok_tani`
--

CREATE TABLE `kelompok_tani` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelompok` varchar(255) NOT NULL,
  `jenis_kelompok` varchar(255) NOT NULL,
  `jumlah_anggota` int(11) NOT NULL,
  `ketua_kelompok` varchar(255) NOT NULL,
  `desa` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `penyuluh` varchar(255) NOT NULL,
  `nip_penyuluh` varchar(255) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjangs`
--

CREATE TABLE `keranjangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` varchar(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pembayaran` enum('tidak','iya') NOT NULL DEFAULT 'tidak',
  `jumlah` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `keranjangs`
--

INSERT INTO `keranjangs` (`id`, `barang_id`, `user_id`, `pembayaran`, `jumlah`, `sub_total`, `created_at`, `updated_at`) VALUES
(1, 'BRG001', 25, 'tidak', 4, 800000, '2024-11-10 15:59:05', '2024-11-10 15:59:13'),
(2, 'BRG001', 50, 'tidak', 4, 800000, '2024-11-10 16:09:05', '2024-11-10 16:09:17'),
(3, 'BRG002', 50, 'tidak', 1, 120000, '2024-11-10 16:09:07', '2024-11-10 16:09:07'),
(4, 'BRG003', 50, 'tidak', 1, 100000, '2024-11-10 16:09:08', '2024-11-10 16:09:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lahan`
--

CREATE TABLE `lahan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengurus_lahan` bigint(20) UNSIGNED NOT NULL,
  `nama_lahan` varchar(255) NOT NULL,
  `luas_lahan` int(11) NOT NULL,
  `alamat_lahan` varchar(255) NOT NULL,
  `status` enum('Milik Sendiri','Pinjam','Sewa') NOT NULL,
  `pbb` varchar(255) NOT NULL,
  `sertifikat_lahan` varchar(255) NOT NULL,
  `foto_lahan` varchar(255) DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '0001_01_01_000002_create_sessions_table', 1),
(5, '2024_09_15_010519_create_kategori_table', 1),
(6, '2024_09_15_031121_create_barang_panen_table', 1),
(7, '2024_09_15_142014_create_kategoris_table', 1),
(8, '2024_09_15_142109_create_barang_panens_table', 1),
(9, '2024_09_16_150253_create_pemesanan_table', 1),
(10, '2024_09_21_131936_create_keranjangs_table', 1),
(11, '2024_09_22_150322_create_item_pmsan_table', 1),
(12, '2024_10_01_015720_create_review_ratings_table', 1),
(13, '2024_11_04_035245_password_resets_tokens', 1),
(14, '2024_10_20_035225_kelompok_tani', 2),
(15, '2024_10_20_063701_anggota_tanis', 2),
(16, '2024_10_20_100846_create_lahan_tabel', 2),
(17, '2024_10_20_152440_create_jadwal_table', 2),
(18, '2024_10_20_152822_tahapan', 2),
(19, '2024_10_20_152935_gambar_tahaps', 2),
(20, '2024_10_31_160523_validations', 2),
(21, '2024_11_08_171102_add_web_token_to_users', 2),
(22, '2024_11_10_015957_panen', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `panen`
--

CREATE TABLE `panen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggalPenanaman` date NOT NULL,
  `tanggalPanen` date NOT NULL,
  `jumlahPanen` int(11) NOT NULL,
  `hargaGradeA` int(11) NOT NULL,
  `hargaGradeB` int(11) NOT NULL,
  `hargaGradeC` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_jadwal` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pmsan` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `nama_pengiriman` varchar(255) NOT NULL,
  `nama_layanan` varchar(255) NOT NULL,
  `total_berat` int(11) NOT NULL,
  `harga_layanan` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `nomor_resi` varchar(255) NOT NULL,
  `gambar_resi` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tgl_pmsan` date NOT NULL,
  `status` enum('Belum','Sudah','Gagal') NOT NULL DEFAULT 'Belum',
  `status_brg` enum('Menunggu konfirmasi','Sedang pengemasan','Pengiriman','Sudah sampai') NOT NULL DEFAULT 'Menunggu konfirmasi',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `review_ratings`
--

CREATE TABLE `review_ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comments` longtext DEFAULT NULL,
  `star_rating` int(11) NOT NULL,
  `status` enum('active','deactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('DjpY9N7L3CAGIUe0eulyeQe2zpbc1QiCLsQSYRvU', 50, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiVmFOZEtYSENvZXlyOTl5bXBIWTA3ZXNXRVJzUElkaEhKakVxRFBndSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MTp7aTowO3M6NToiZXJyb3IiO31zOjM6Im5ldyI7YTowOnt9fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZm9ybS1wZW1iZWxpYW4iO31zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjQyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZm9ybS1wZW1iZWxpYW4/aWRzPTEiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1MDtzOjU6ImVycm9yIjtzOjMwOiJUaWRhayBhZGEgYmFyYW5nIHlhbmcgZGlwaWxpaCEiO30=', 1731280954),
('gq8CpX275PoAuDKGijwQ6zjJIuADZEDF8gcNDndd', 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaGh5V0R0Y05DYjVlb3lmV09wanZZUmhFQWFMM21yYWQ3MGNBdHNHMCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Zvcm0tcGVtYmVsaWFuIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTE7fQ==', 1731279806),
('Y9h0VWKiLEt3r4RrZZvELMUTuwE6tLrCAV7B7F82', 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZUIyTWZBYnFnOFRJRTc4T1dPNGJWMXRzbFlLWk5tcm54TmdQbG9ldCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjUxO30=', 1731292446);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahapan`
--

CREATE TABLE `tahapan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahap` int(11) NOT NULL,
  `nama_tahap` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `mulai` int(11) NOT NULL,
  `selesai` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `kota` text NOT NULL,
  `role` enum('pengunjung','admin') NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fcm_token` varchar(255) DEFAULT NULL,
  `web_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `alamat`, `kota`, `role`, `telepon`, `remember_token`, `created_at`, `updated_at`, `fcm_token`, `web_token`) VALUES
(1, 'Rina Padmasari', 'laryani@example.org', NULL, '$2y$12$isawAu0Hg1.rIoFbAedzme4k00Fers/bL52gSqIdcoTcTWbjd7jri', 'Jr. Ronggowarsito No. 976, Pekanbaru 73405, NTB', 'Dumai', 'pengunjung', '0379 9362 326', NULL, '2024-11-10 14:35:01', '2024-11-10 14:35:01', NULL, NULL),
(2, 'Lanang Saptono S.E.I', 'nlatupono@example.net', NULL, '$2y$12$1i878ay7pXeZkTv3Q215AesEWD3lqZRhJM.OB0nrSZE/8yiwkANLO', 'Gg. Bak Air No. 192, Prabumulih 28234, Sulut', 'Tanjung Pinang', 'pengunjung', '(+62) 983 0493 219', NULL, '2024-11-10 14:35:02', '2024-11-10 14:35:02', NULL, NULL),
(3, 'Ani Hasanah', 'nramadan@example.com', NULL, '$2y$12$BBQe68C/3IhkcedhvwivseCpLVboYZsSErBNWyy8Lw/d2aSixGx.6', 'Kpg. Arifin No. 284, Dumai 46909, Riau', 'Cirebon', 'pengunjung', '0856 864 705', NULL, '2024-11-10 14:35:02', '2024-11-10 14:35:02', NULL, NULL),
(4, 'Tirta Napitupulu S.Pd', 'mustofa.gabriella@example.com', NULL, '$2y$12$EJCuqdoINyEDwq6gSv5gLesrWY./rjixBeYRkIJmRolzdWXf9mDOq', 'Jln. Wora Wari No. 396, Sungai Penuh 53004, Sumsel', 'Sabang', 'pengunjung', '0840 8528 3675', NULL, '2024-11-10 14:35:03', '2024-11-10 14:35:03', NULL, NULL),
(5, 'Hasna Uchita Sudiati', 'devi.nuraini@example.org', NULL, '$2y$12$UWQSOeV2LDHSKAxkHjsN3u9m9w6osoxs2jCcxTUbQ4NTHYXokUCpG', 'Dk. Pintu Besar Selatan No. 701, Gorontalo 54952, Pabar', 'Gunungsitoli', 'pengunjung', '(+62) 641 4523 1955', NULL, '2024-11-10 14:35:04', '2024-11-10 14:35:04', NULL, NULL),
(6, 'Lurhur Zulkarnain', 'jayeng73@example.com', NULL, '$2y$12$K9QI1NfY0fpiYRWr4fiNPuNdgSUv2VbK9wwoIXk7tUOil3MDKURN.', 'Ki. Bappenas No. 255, Bitung 71648, Kalbar', 'Palu', 'pengunjung', '0906 1356 5114', NULL, '2024-11-10 14:35:04', '2024-11-10 14:35:04', NULL, NULL),
(7, 'Balapati Anggriawan S.Psi', 'hassanah.zaenab@example.org', NULL, '$2y$12$cwNRyXIeDYGe66OtSU7Y7O8H2x8y/RygMgF1Ha8sxPmro7egYfgmy', 'Jr. Nakula No. 817, Bukittinggi 49608, Kalbar', 'Kediri', 'pengunjung', '(+62) 909 1446 730', NULL, '2024-11-10 14:35:05', '2024-11-10 14:35:05', NULL, NULL),
(8, 'Cornelia Purnawati S.Ked', 'sramadan@example.net', NULL, '$2y$12$F8b0TZsrGurFpkM1h7zWuOhcnYXyzrZnFZ8QOgyuzZWxHS3yGeNOq', 'Jr. Halim No. 329, Dumai 89969, Gorontalo', 'Serang', 'pengunjung', '0445 7462 874', NULL, '2024-11-10 14:35:06', '2024-11-10 14:35:06', NULL, NULL),
(9, 'Salman Dadap Irawan S.E.', 'abyasa.melani@example.org', NULL, '$2y$12$5nI1eIjEmtPHDc8CwLjoBeLu1gp8jHJqNOG0N9yVj70Fyd9F/WXBi', 'Ds. Supono No. 719, Bandung 17546, Sumsel', 'Bukittinggi', 'pengunjung', '(+62) 620 8425 8793', NULL, '2024-11-10 14:35:07', '2024-11-10 14:35:07', NULL, NULL),
(10, 'Ajeng Hassanah', 'dhartati@example.com', NULL, '$2y$12$.VumIK8nq45J/59tnGR4fOU5CkGXOCcXIurX2gTAe2ykVU0UzjiV.', 'Psr. Salam No. 157, Tebing Tinggi 81247, Kaltara', 'Parepare', 'pengunjung', '0695 4175 1376', NULL, '2024-11-10 14:35:07', '2024-11-10 14:35:07', NULL, NULL),
(11, 'Koko Latupono', 'hutapea.ratna@example.org', NULL, '$2y$12$KPiB4VXImYDDxkyvRfWs7uzoX5BJvpE3vVUx11Lgg5ukL/y8YhsPm', 'Jr. Batako No. 716, Administrasi Jakarta Pusat 35939, Jabar', 'Administrasi Jakarta Selatan', 'pengunjung', '(+62) 627 1816 0411', NULL, '2024-11-10 14:35:08', '2024-11-10 14:35:08', NULL, NULL),
(12, 'Salwa Hesti Hastuti', 'pranawa.utami@example.com', NULL, '$2y$12$yJlUG7VPpxU1c3mJ/xiAtOSVOo4jA6XTSlZrcYc2MaEbMhqtkPvHG', 'Kpg. Sutan Syahrir No. 72, Probolinggo 53418, Sumbar', 'Sungai Penuh', 'pengunjung', '(+62) 376 0349 3041', NULL, '2024-11-10 14:35:09', '2024-11-10 14:35:09', NULL, NULL),
(13, 'Ratna Maryati', 'janet.waluyo@example.org', NULL, '$2y$12$Mi2ni/GJDAq4M/HfekFhDupx4rFQ3uGOxSvIREhIEn0/AqtElv7dS', 'Gg. Sutoyo No. 857, Manado 43084, Pabar', 'Jayapura', 'pengunjung', '(+62) 848 0818 037', NULL, '2024-11-10 14:35:09', '2024-11-10 14:35:09', NULL, NULL),
(14, 'Jane Hani Halimah S.Sos', 'mandasari.michelle@example.org', NULL, '$2y$12$MkQP7PORhKlrKVgqkzPA5.0hKu/vSBUVIGCUelRPPSVGx.l4N41Q.', 'Jr. Bakau No. 788, Ambon 59135, Gorontalo', 'Banjarmasin', 'pengunjung', '(+62) 774 5105 358', NULL, '2024-11-10 14:35:10', '2024-11-10 14:35:10', NULL, NULL),
(15, 'Ika Rahayu', 'pudjiastuti.nyoman@example.net', NULL, '$2y$12$dMpK8x8CzxfN6ItFcj7zceBUU9ilbtoqFzwEdcvqmDTzFV6wxQ/Qe', 'Dk. Moch. Toha No. 276, Administrasi Jakarta Pusat 69937, Kaltim', 'Pariaman', 'pengunjung', '(+62) 29 3965 5392', NULL, '2024-11-10 14:35:11', '2024-11-10 14:35:11', NULL, NULL),
(16, 'Salman Danang Gunawan', 'setiawan.febi@example.com', NULL, '$2y$12$z2kWXLeJnIr0Uh7SyYEt1.kbPZqRCGVBn8U5fk6LfS36.OhaOMpTi', 'Jln. Jambu No. 229, Administrasi Jakarta Utara 70657, Sultra', 'Singkawang', 'pengunjung', '(+62) 295 8294 457', NULL, '2024-11-10 14:35:12', '2024-11-10 14:35:12', NULL, NULL),
(17, 'Jaga Sihombing', 'eagustina@example.com', NULL, '$2y$12$fkvzqEY4PG/Zpty67KtoKOpz8d3aTa3kmmvODpk7Kc0LCm0KZn12G', 'Kpg. Dipenogoro No. 484, Palu 54654, Aceh', 'Bandar Lampung', 'pengunjung', '(+62) 676 3076 296', NULL, '2024-11-10 14:35:12', '2024-11-10 14:35:12', NULL, NULL),
(18, 'Laras Lailasari', 'nilam29@example.com', NULL, '$2y$12$.tdTUI6h3mWd4FT9ZII4rOxlaQEXGisssyC40pOE3ruG6VvTDp5x6', 'Jr. Gegerkalong Hilir No. 186, Bekasi 51545, DKI', 'Lhokseumawe', 'pengunjung', '0291 2935 129', NULL, '2024-11-10 14:35:13', '2024-11-10 14:35:13', NULL, NULL),
(19, 'Wani Nuraini S.E.I', 'prabowo.puti@example.net', NULL, '$2y$12$yNN.eyc.VWmj6DRx1xX1KeLruWKZcdyRpyYOm0LsLBDoNrDYfJ9jq', 'Jr. Salam No. 983, Mojokerto 98071, Maluku', 'Tangerang', 'pengunjung', '(+62) 891 783 214', NULL, '2024-11-10 14:35:14', '2024-11-10 14:35:14', NULL, NULL),
(20, 'Capa Lamar Mansur', 'lwinarno@example.net', NULL, '$2y$12$xQK1IDWTQFymU2GMeiCtbOUQMUczO7AtjgnMbHuzmy7sTzRjp3qlS', 'Psr. Salatiga No. 368, Sungai Penuh 26167, Kalbar', 'Cimahi', 'pengunjung', '(+62) 264 0027 1937', NULL, '2024-11-10 14:35:14', '2024-11-10 14:35:14', NULL, NULL),
(21, 'Wasis Saptono', 'fsalahudin@example.com', NULL, '$2y$12$0QXvGOGdPbfvQFfV8EPrFuGsGuC4xOaiQo0IBOaFJSJ9qRxZnUB1q', 'Gg. Gajah Mada No. 842, Salatiga 44604, Aceh', 'Depok', 'pengunjung', '(+62) 821 886 369', NULL, '2024-11-10 14:35:15', '2024-11-10 14:35:15', NULL, NULL),
(22, 'Adiarja Iswahyudi', 'mardhiyah.surya@example.net', NULL, '$2y$12$9us1LailVCBFP6TVIdWf5ul2n0FErCswwmER4ZBg7vGwndTHsMm6K', 'Ki. Moch. Yamin No. 163, Cimahi 46680, Malut', 'Magelang', 'pengunjung', '0730 5953 3695', NULL, '2024-11-10 14:35:16', '2024-11-10 14:35:16', NULL, NULL),
(23, 'Laila Carla Pertiwi', 'setiawan.patricia@example.org', NULL, '$2y$12$EyrGEYs4FByILQ/opN62VusfCLnQg.Deh2gMueW3rcwamd6K8uljO', 'Ki. Bata Putih No. 377, Administrasi Jakarta Utara 46206, Riau', 'Tanjung Pinang', 'pengunjung', '0490 0675 8863', NULL, '2024-11-10 14:35:17', '2024-11-10 14:35:17', NULL, NULL),
(24, 'Karja Pradana', 'budi37@example.com', NULL, '$2y$12$B7j8OIN.o/Ur9PZnX26L..tDdCl6BRcUJonUdZ8zaCPM11Hp9jWIm', 'Kpg. Zamrud No. 83, Madiun 97265, Banten', 'Samarinda', 'pengunjung', '(+62) 561 9904 390', NULL, '2024-11-10 14:35:18', '2024-11-10 14:35:18', NULL, NULL),
(25, 'Galang Januar', 'teddy40@example.org', NULL, '$2y$12$f1RKwYJDp4ZEV/vst2imf.0YDAPnFSrnM1VSQywVrHCHYeuBB4v6u', 'Ds. Juanda No. 188, Ambon 87707, Bali', 'Palopo', 'pengunjung', '(+62) 736 3791 8649', NULL, '2024-11-10 14:35:18', '2024-11-10 14:35:18', NULL, NULL),
(26, 'Bagas Latupono', 'ian03@example.net', NULL, '$2y$12$FdfwRaR7Vltv5bp8ANO/keoFyRuqvlAqHqBxl42rHNJrq7QMZzSaa', 'Jln. Otista No. 210, Tanjung Pinang 31849, Sulteng', 'Bau-Bau', 'pengunjung', '0357 4429 2182', NULL, '2024-11-10 14:35:19', '2024-11-10 14:35:19', NULL, NULL),
(27, 'Kariman Reksa Marpaung M.M.', 'kzulkarnain@example.net', NULL, '$2y$12$o.bVKQz5IYn5/gcHIqIDgu4RQypvKGIhSEaUfBuHU836zF5eBy3Vq', 'Psr. Jaksa No. 918, Medan 27291, Sulteng', 'Surabaya', 'pengunjung', '021 2961 805', NULL, '2024-11-10 14:35:20', '2024-11-10 14:35:20', NULL, NULL),
(28, 'Hendri Maheswara', 'suartini.catur@example.org', NULL, '$2y$12$bDBj/gZAHuWCWVsO9eFby.rhj/bciZM5zv0xMXUbaZCslu71y1fN2', 'Psr. Nangka No. 311, Magelang 81295, Kaltara', 'Kendari', 'pengunjung', '0524 8765 259', NULL, '2024-11-10 14:35:21', '2024-11-10 14:35:21', NULL, NULL),
(29, 'Zaenab Anggraini M.M.', 'latupono.vera@example.com', NULL, '$2y$12$WeEpy4YBt6PF2j4.nxWGy.2/AHziBjSrafg0aA6bXBtpZMDoZNR1e', 'Psr. Banda No. 400, Bogor 26640, Sumut', 'Batam', 'pengunjung', '(+62) 424 1165 379', NULL, '2024-11-10 14:35:22', '2024-11-10 14:35:22', NULL, NULL),
(30, 'Caturangga Gunarto', 'lailasari.dadap@example.net', NULL, '$2y$12$GVBW4Rnisa6hOk4aaIAnXOY7f1Inra.Jn/EIu9xh5bHHc9R0UxYNW', 'Ds. Ciumbuleuit No. 54, Kupang 48010, Sulbar', 'Payakumbuh', 'pengunjung', '0768 4252 7432', NULL, '2024-11-10 14:35:22', '2024-11-10 14:35:22', NULL, NULL),
(31, 'Kambali Sitompul M.M.', 'hartati.ikin@example.net', NULL, '$2y$12$/Re0.kdiJKOTIda4ue/An.N6IKqVgEtiISn5OkvyX5Kv4WLsKA4Gm', 'Psr. Bata Putih No. 722, Binjai 62014, Kalbar', 'Surakarta', 'pengunjung', '0682 2649 6638', NULL, '2024-11-10 14:35:23', '2024-11-10 14:35:23', NULL, NULL),
(32, 'Paiman Tampubolon S.Sos', 'oni.suryono@example.com', NULL, '$2y$12$Tc4xAIG5q3XgPClWVpg8WOgH1sZIQQPpxykbLTLVjq8iWzaRfVXQy', 'Dk. Wahidin No. 972, Probolinggo 78382, Aceh', 'Bitung', 'pengunjung', '0612 9797 4446', NULL, '2024-11-10 14:35:24', '2024-11-10 14:35:24', NULL, NULL),
(33, 'Yani Qori Laksmiwati S.E.I', 'nurdiyanti.praba@example.com', NULL, '$2y$12$GbEIesXlsXbo0bZ59cFDdeu0eEWd8Awdzyi4wvi3ajtQPd6gOAyoS', 'Ds. B.Agam 1 No. 577, Batam 61123, DKI', 'Makassar', 'pengunjung', '(+62) 250 7160 990', NULL, '2024-11-10 14:35:24', '2024-11-10 14:35:24', NULL, NULL),
(34, 'Diana Raina Suryatmi', 'najmudin.ayu@example.net', NULL, '$2y$12$8/JlaoFIMopne.nkpUMTkO21n2MqeEbDRQYApWe.mxoIm27i500dO', 'Jr. PHH. Mustofa No. 636, Prabumulih 88062, Kalbar', 'Tarakan', 'pengunjung', '(+62) 417 2789 070', NULL, '2024-11-10 14:35:25', '2024-11-10 14:35:25', NULL, NULL),
(35, 'Padma Winarsih S.T.', 'yani69@example.net', NULL, '$2y$12$ak/JMkRPIjPcdn4YTmFn1uwG8rP5DXyXa4gdPOLACaoPefLk9Qqpa', 'Jln. Suharso No. 962, Tomohon 92750, Kepri', 'Bitung', 'pengunjung', '0720 9693 3866', NULL, '2024-11-10 14:35:26', '2024-11-10 14:35:26', NULL, NULL),
(36, 'Jelita Ana Permata S.E.', 'rahimah.mariadi@example.com', NULL, '$2y$12$tzclevCVmbFDBvVgw9tGS.RsDBKrZH6laQnZ.By5zMliG4iUWWIjK', 'Ds. Salatiga No. 509, Ambon 60640, Sumut', 'Sawahlunto', 'pengunjung', '(+62) 567 6695 4828', NULL, '2024-11-10 14:35:27', '2024-11-10 14:35:27', NULL, NULL),
(37, 'Gangsar Nyana Sitompul', 'vera.suryatmi@example.org', NULL, '$2y$12$oS5vGSExTlbvIv8eTl6DBuwY5STezrW0eDioFZnzOQhmyqjYlQjo.', 'Jr. Bambon No. 482, Lubuklinggau 12531, Sumbar', 'Ternate', 'pengunjung', '0332 4277 2692', NULL, '2024-11-10 14:35:28', '2024-11-10 14:35:28', NULL, NULL),
(38, 'Naradi Emil Lazuardi', 'irawan.anastasia@example.com', NULL, '$2y$12$It8XFMGk0d3Z5.YW6WyAfedpDi/YEsdFgjORWnwU.2oToiXL9Ly6S', 'Kpg. Bagas Pati No. 380, Solok 42010, Aceh', 'Banjar', 'pengunjung', '0515 2859 264', NULL, '2024-11-10 14:35:29', '2024-11-10 14:35:29', NULL, NULL),
(39, 'Luwes Dabukke', 'irawan.karen@example.org', NULL, '$2y$12$Muoxl2NAsGlkTPNqQLWotOzZDhCJUgD/cNhSj/7xBX7ixg.WKK.2i', 'Dk. Hasanuddin No. 518, Manado 41617, Sulteng', 'Cirebon', 'pengunjung', '0452 3889 6675', NULL, '2024-11-10 14:35:29', '2024-11-10 14:35:29', NULL, NULL),
(40, 'Jabal Suryono', 'anita34@example.com', NULL, '$2y$12$M90TBnkB1koWb402BhuqMOpAtyzEhRF82F5LB0nu/8wHCf/ez49TW', 'Psr. Sutarto No. 220, Tegal 97975, Sumut', 'Kupang', 'pengunjung', '0743 7687 7754', NULL, '2024-11-10 14:35:30', '2024-11-10 14:35:30', NULL, NULL),
(41, 'Kusuma Permadi', 'mpalastri@example.org', NULL, '$2y$12$HtColsCS6a5yuvBRFEsqvunAYpz/VNcDHsHCjSrtr9dupBNN2SVDe', 'Gg. Suharso No. 705, Ambon 29627, Riau', 'Tebing Tinggi', 'pengunjung', '0725 7392 356', NULL, '2024-11-10 14:35:31', '2024-11-10 14:35:31', NULL, NULL),
(42, 'Tami Yuliarti S.Kom', 'sirait.vivi@example.org', NULL, '$2y$12$HhOIskFdwCtF7IbI8DBYH.S3DkWLd4DLkpg3xvO3Fu5YnKls3Fm5m', 'Ki. Jend. Sudirman No. 464, Prabumulih 91587, Sumbar', 'Pekanbaru', 'pengunjung', '0885 4540 549', NULL, '2024-11-10 14:35:32', '2024-11-10 14:35:32', NULL, NULL),
(43, 'Daryani Nababan', 'narpati.dasa@example.net', NULL, '$2y$12$CiZWlA4ksQTnr.UdpKp7bOPmFtyjo6V2kBKqgG.cPhYqU7WpuFD72', 'Psr. Sugiyopranoto No. 550, Malang 43137, Aceh', 'Administrasi Jakarta Pusat', 'pengunjung', '(+62) 869 535 026', NULL, '2024-11-10 14:35:32', '2024-11-10 14:35:32', NULL, NULL),
(44, 'Ayu Uchita Astuti', 'yuni65@example.com', NULL, '$2y$12$7CKwXvojHGbzzhtv0JZT4O23V7QDSo8b/OwOx2hBCB2vUIML1OswO', 'Dk. Siliwangi No. 509, Malang 70967, Aceh', 'Palangka Raya', 'pengunjung', '(+62) 760 2487 301', NULL, '2024-11-10 14:35:33', '2024-11-10 14:35:33', NULL, NULL),
(45, 'Rahmi Aryani', 'gunawan.siti@example.net', NULL, '$2y$12$EJmLr4zQly0ZT8JkQCW1Ou1cgz8Brl5tlxqwKaHLSjahoxClQVHKq', 'Psr. Bayam No. 62, Banda Aceh 99164, Papua', 'Mataram', 'pengunjung', '0630 8785 6365', NULL, '2024-11-10 14:35:34', '2024-11-10 14:35:34', NULL, NULL),
(46, 'Dalimin Saragih', 'rlestari@example.com', NULL, '$2y$12$uRsignxjnBUnMOLMKcVRV.NkYflNs2O.i2rRfpCfLRDeDcIqE4aGK', 'Jln. Muwardi No. 274, Medan 95686, Bali', 'Depok', 'pengunjung', '028 3904 581', NULL, '2024-11-10 14:35:35', '2024-11-10 14:35:35', NULL, NULL),
(47, 'Rika Uchita Hasanah M.Kom.', 'mulyono10@example.org', NULL, '$2y$12$MZkrXQIOITI6oCN4dF1OM.SuLEUK9tHAtLZ6Qdg3go2z2qLXFEOXy', 'Jr. Bambon No. 313, Kupang 99182, Sulteng', 'Bau-Bau', 'pengunjung', '0819 5593 6381', NULL, '2024-11-10 14:35:35', '2024-11-10 14:35:35', NULL, NULL),
(48, 'Alambana Maheswara', 'bakda.hutagalung@example.net', NULL, '$2y$12$MqawJSmSSwaK2zdc2AwkJe0bK9g8CG3UUSeQ48KTNGyxjvjk2Bhmy', 'Ki. Pasirkoja No. 12, Cirebon 58798, Kepri', 'Pematangsiantar', 'pengunjung', '0250 1815 363', NULL, '2024-11-10 14:35:36', '2024-11-10 14:35:36', NULL, NULL),
(49, 'Kamaria Maimunah Lailasari', 'lala.nuraini@example.net', NULL, '$2y$12$UYeJMucfmvqBSnd.a/OdpullSrhreyNgxenxMcb.1mfY5a7vRrTd6', 'Kpg. Ters. Pasir Koja No. 510, Pasuruan 23506, Banten', 'Makassar', 'pengunjung', '(+62) 25 5585 303', NULL, '2024-11-10 14:35:37', '2024-11-10 14:35:37', NULL, NULL),
(50, 'Ibrahim Saka Pradipta S.Sos', 'arta84@example.org', NULL, '$2y$12$l6prKdDML1tf8bEwuP4XR.3pQGylJWqCs1v/MlGkT/omlvYcMbyGK', 'Gg. Balikpapan No. 371, Cirebon 18944, Jatim', 'Bitung', 'pengunjung', '(+62) 506 8122 5341', NULL, '2024-11-10 14:35:38', '2024-11-10 14:35:38', NULL, NULL),
(51, 'admin', 'admin12@gmail.com', NULL, '$2y$12$QX20WLDOsoVApeaELnYbYu4IoynEv2LSENGXtFtoF/ErYCqOYZ0rK', 'Jl batu kota 12', 'Subang', 'admin', '01212121212', NULL, '2024-11-10 16:02:38', '2024-11-10 16:02:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `validations`
--

CREATE TABLE `validations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_terakhir_unggah` date NOT NULL,
  `hari` varchar(255) NOT NULL,
  `tahapan_id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota_tanis`
--
ALTER TABLE `anggota_tanis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `anggota_tanis_telepon_unique` (`telepon`),
  ADD KEY `anggota_tanis_id_user_foreign` (`id_user`),
  ADD KEY `anggota_tanis_kelompok_tani_id_foreign` (`kelompok_tani_id`);

--
-- Indeks untuk tabel `barang_panen`
--
ALTER TABLE `barang_panen`
  ADD PRIMARY KEY (`id_brg`),
  ADD KEY `barang_panen_kategori_id_foreign` (`kategori_id`);

--
-- Indeks untuk tabel `barang_panens`
--
ALTER TABLE `barang_panens`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `gambar_tahaps`
--
ALTER TABLE `gambar_tahaps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gambar_tahaps_tahapan_id_foreign` (`tahapan_id`),
  ADD KEY `gambar_tahaps_jadwal_id_foreign` (`jadwal_id`);

--
-- Indeks untuk tabel `item_pmsan`
--
ALTER TABLE `item_pmsan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_pmsan_pemesanan_id_foreign` (`pemesanan_id`),
  ADD KEY `item_pmsan_keranjang_id_foreign` (`keranjang_id`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_id_user_foreign` (`id_user`),
  ADD KEY `jadwal_lahan_id_foreign` (`lahan_id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelompok_tani`
--
ALTER TABLE `kelompok_tani`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelompok_tani_id_user_foreign` (`id_user`);

--
-- Indeks untuk tabel `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keranjangs_barang_id_foreign` (`barang_id`),
  ADD KEY `keranjangs_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `lahan`
--
ALTER TABLE `lahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lahan_id_user_foreign` (`id_user`),
  ADD KEY `lahan_pengurus_lahan_foreign` (`pengurus_lahan`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `panen`
--
ALTER TABLE `panen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `panen_id_jadwal_foreign` (`id_jadwal`),
  ADD KEY `panen_id_user_foreign` (`id_user`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_reset_tokens_email_index` (`email`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pmsan`),
  ADD KEY `pemesanan_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `review_ratings`
--
ALTER TABLE `review_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_ratings_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `tahapan`
--
ALTER TABLE `tahapan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tahapan_tahap_unique` (`tahap`),
  ADD KEY `tahapan_id_user_foreign` (`id_user`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `validations`
--
ALTER TABLE `validations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `validations_tahapan_id_foreign` (`tahapan_id`),
  ADD KEY `validations_jadwal_id_foreign` (`jadwal_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota_tanis`
--
ALTER TABLE `anggota_tanis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `barang_panens`
--
ALTER TABLE `barang_panens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gambar_tahaps`
--
ALTER TABLE `gambar_tahaps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `item_pmsan`
--
ALTER TABLE `item_pmsan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelompok_tani`
--
ALTER TABLE `kelompok_tani`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `keranjangs`
--
ALTER TABLE `keranjangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `lahan`
--
ALTER TABLE `lahan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `panen`
--
ALTER TABLE `panen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `review_ratings`
--
ALTER TABLE `review_ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tahapan`
--
ALTER TABLE `tahapan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `validations`
--
ALTER TABLE `validations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `anggota_tanis`
--
ALTER TABLE `anggota_tanis`
  ADD CONSTRAINT `anggota_tanis_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `anggota_tanis_kelompok_tani_id_foreign` FOREIGN KEY (`kelompok_tani_id`) REFERENCES `kelompok_tani` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_panen`
--
ALTER TABLE `barang_panen`
  ADD CONSTRAINT `barang_panen_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `gambar_tahaps`
--
ALTER TABLE `gambar_tahaps`
  ADD CONSTRAINT `gambar_tahaps_jadwal_id_foreign` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gambar_tahaps_tahapan_id_foreign` FOREIGN KEY (`tahapan_id`) REFERENCES `tahapan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `item_pmsan`
--
ALTER TABLE `item_pmsan`
  ADD CONSTRAINT `item_pmsan_keranjang_id_foreign` FOREIGN KEY (`keranjang_id`) REFERENCES `keranjangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_pmsan_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`id_pmsan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_lahan_id_foreign` FOREIGN KEY (`lahan_id`) REFERENCES `lahan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelompok_tani`
--
ALTER TABLE `kelompok_tani`
  ADD CONSTRAINT `kelompok_tani_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD CONSTRAINT `keranjangs_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang_panen` (`id_brg`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keranjangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `lahan`
--
ALTER TABLE `lahan`
  ADD CONSTRAINT `lahan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lahan_pengurus_lahan_foreign` FOREIGN KEY (`pengurus_lahan`) REFERENCES `anggota_tanis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `panen`
--
ALTER TABLE `panen`
  ADD CONSTRAINT `panen_id_jadwal_foreign` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `panen_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `review_ratings`
--
ALTER TABLE `review_ratings`
  ADD CONSTRAINT `review_ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tahapan`
--
ALTER TABLE `tahapan`
  ADD CONSTRAINT `tahapan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `validations`
--
ALTER TABLE `validations`
  ADD CONSTRAINT `validations_jadwal_id_foreign` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `validations_tahapan_id_foreign` FOREIGN KEY (`tahapan_id`) REFERENCES `tahapan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
