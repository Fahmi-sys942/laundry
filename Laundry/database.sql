-- Database: pengelolaan_Laundry
-- --------------------------------------------------------
CREATE DATABASE IF NOT EXISTS pengelolaan_Laundry;
USE pengelolaan_Laundry;
-- --------------------------------------------------------
-- Tabel struktur untuk tabel `outlet`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `outlet` (
  `id_outlet` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `tlp` varchar(15) COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id_outlet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Tabel struktur untuk tabel `user`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  `id_outlet` int(11) NULL,
  `role` enum('admin','kasir','owner') COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_user`),
  FOREIGN KEY (`id_outlet`) REFERENCES `outlet` (`id_outlet`) ON DELETE SET NULL,
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Tabel struktur untuk tabel `member`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `member` (
  `id_member` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_general_ci NOT NULL,
  `tlp` varchar(15) COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id_member`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Data sampel untuk tabel `outlet`
-- --------------------------------------------------------

INSERT INTO `outlet` (`id_outlet`, `nama`, `alamat`, `tlp`) VALUES
(1, 'Outlet Pusat', 'Jalan Merdeka No. 1', '021-12345678'),
(2, 'Outlet Cabang 1', 'Jalan Sudirman No. 5', '021-87654321'),
(3, 'Outlet Cabang 2', 'Jalan Gatot Subroto No. 10', '021-55555555');

-- --------------------------------------------------------
-- Data sampel untuk tabel `user`
-- --------------------------------------------------------

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `id_outlet`, `role`) VALUES
(1, 'Administrator', 'admin', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36p4/tvO', 1, 'admin'),
(2, 'Kasir 1', 'kasir1', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36p4/tvO', 1, 'kasir'),
(3, 'Pemilik Laundry', 'owner', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36p4/tvO', 1, 'owner');

-- --------------------------------------------------------
-- Data sampel untuk tabel `member`
-- --------------------------------------------------------

INSERT INTO `member` (`id_member`, `nama`, `alamat`, `jenis_kelamin`, `tlp`) VALUES
(1, 'Budi Santoso', 'Jalan Mawar No. 5, Jakarta', 'L', '0812-3456-7890'),
(2, 'Siti Nurhaliza', 'Jalan Melati No. 10, Bandung', 'P', '0813-2345-6789'),
(3, 'Ahmad Hidayat', 'Jalan Anggrek No. 15, Tangerang', 'L', '0814-5678-9012');
