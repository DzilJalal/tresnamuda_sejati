-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.11 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for ybeauty
CREATE DATABASE IF NOT EXISTS `ybeauty` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ybeauty`;


-- Dumping structure for table ybeauty.auth_assignment
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ybeauty.auth_assignment: ~4 rows (approximately)
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
	('Administrator', '1', 1476849688),
	('Kasir', '21', 1479674328),
	('Manager', '20', 1479672416),
	('Owner', '19', 1479669592);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;


-- Dumping structure for table ybeauty.auth_item
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ybeauty.auth_item: ~164 rows (approximately)
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/*', 2, NULL, NULL, NULL, 1476849338, 1476849338),
	('/admin/*', 2, NULL, NULL, NULL, 1476849358, 1476849358),
	('/admin/default/*', 2, NULL, NULL, NULL, 1476849358, 1476849358),
	('/admin/default/index', 2, NULL, NULL, NULL, 1477369754, 1477369754),
	('/debug/*', 2, NULL, NULL, NULL, 1476849360, 1476849360),
	('/debug/default/*', 2, NULL, NULL, NULL, 1476849361, 1476849361),
	('/debug/default/db-explain', 2, NULL, NULL, NULL, 1477369749, 1477369749),
	('/debug/default/download-mail', 2, NULL, NULL, NULL, 1477369750, 1477369750),
	('/debug/default/index', 2, NULL, NULL, NULL, 1477369750, 1477369750),
	('/debug/default/toolbar', 2, NULL, NULL, NULL, 1477369751, 1477369751),
	('/debug/default/view', 2, NULL, NULL, NULL, 1477369753, 1477369753),
	('/gii/*', 2, NULL, NULL, NULL, 1476849365, 1476849365),
	('/gii/default/*', 2, NULL, NULL, NULL, 1476849366, 1476849366),
	('/gii/default/action', 2, NULL, NULL, NULL, 1477369755, 1477369755),
	('/gii/default/diff', 2, NULL, NULL, NULL, 1477369756, 1477369756),
	('/gii/default/index', 2, NULL, NULL, NULL, 1477369756, 1477369756),
	('/gii/default/preview', 2, NULL, NULL, NULL, 1477369759, 1477369759),
	('/gii/default/view', 2, NULL, NULL, NULL, 1477369758, 1477369758),
	('/gridview/*', 2, NULL, NULL, NULL, 1479673586, 1479673586),
	('/gridview/export/*', 2, NULL, NULL, NULL, 1479673587, 1479673587),
	('/gridview/export/download', 2, NULL, NULL, NULL, 1479673588, 1479673588),
	('/hrd/*', 2, NULL, NULL, NULL, 1476849372, 1476849372),
	('/hrd/branch/*', 2, NULL, NULL, NULL, 1477408403, 1477408403),
	('/hrd/branch/create', 2, NULL, NULL, NULL, 1477369761, 1477369761),
	('/hrd/branch/delete', 2, NULL, NULL, NULL, 1477309632, 1477309632),
	('/hrd/branch/index', 2, NULL, NULL, NULL, 1477369760, 1477369760),
	('/hrd/branch/update', 2, NULL, NULL, NULL, 1477369760, 1477369760),
	('/hrd/branch/view', 2, NULL, NULL, NULL, 1477369763, 1477369763),
	('/hrd/default/*', 2, NULL, NULL, NULL, 1477408402, 1477408402),
	('/hrd/default/index', 2, NULL, NULL, NULL, 1477369762, 1477369762),
	('/hrd/departement/*', 2, NULL, NULL, NULL, 1476849416, 1476849416),
	('/hrd/departement/create', 2, NULL, NULL, NULL, 1477408402, 1477408402),
	('/hrd/departement/delete', 2, NULL, NULL, NULL, 1477369766, 1477369766),
	('/hrd/departement/index', 2, NULL, NULL, NULL, 1477369765, 1477369765),
	('/hrd/departement/update', 2, NULL, NULL, NULL, 1477369764, 1477369764),
	('/hrd/departement/view', 2, NULL, NULL, NULL, 1477369764, 1477369764),
	('/hrd/karyawan/*', 2, NULL, NULL, NULL, 1477408401, 1477408401),
	('/hrd/karyawan/create', 2, NULL, NULL, NULL, 1477369766, 1477369766),
	('/hrd/karyawan/delete', 2, NULL, NULL, NULL, 1477369768, 1477369768),
	('/hrd/karyawan/index', 2, NULL, NULL, NULL, 1477369769, 1477369769),
	('/hrd/karyawan/update', 2, NULL, NULL, NULL, 1477369772, 1477369772),
	('/hrd/karyawan/view', 2, NULL, NULL, NULL, 1477369771, 1477369771),
	('/hrd/perusahaan/*', 2, NULL, NULL, NULL, 1477408401, 1477408401),
	('/hrd/perusahaan/create', 2, NULL, NULL, NULL, 1477369774, 1477369774),
	('/hrd/perusahaan/delete', 2, NULL, NULL, NULL, 1477369774, 1477369774),
	('/hrd/perusahaan/index', 2, NULL, NULL, NULL, 1477369776, 1477369776),
	('/hrd/perusahaan/update', 2, NULL, NULL, NULL, 1477369775, 1477369775),
	('/hrd/perusahaan/view', 2, NULL, NULL, NULL, 1477369777, 1477369777),
	('/it/*', 2, NULL, NULL, NULL, 1476848046, 1476848046),
	('/it/default/*', 2, NULL, NULL, NULL, 1476848030, 1476848030),
	('/it/default/index', 2, NULL, NULL, NULL, 1477369778, 1477369778),
	('/it/request/*', 2, NULL, NULL, NULL, 1476848037, 1476848037),
	('/it/request/create', 2, NULL, NULL, NULL, 1477309637, 1477309637),
	('/it/request/delete', 2, NULL, NULL, NULL, 1477309641, 1477309641),
	('/it/request/index', 2, NULL, NULL, NULL, 1477369781, 1477369781),
	('/it/request/update', 2, NULL, NULL, NULL, 1477369782, 1477369782),
	('/it/request/view', 2, NULL, NULL, NULL, 1477369782, 1477369782),
	('/it/tipe-search/*', 2, NULL, NULL, NULL, 1476848047, 1476848047),
	('/it/tipe-search/create', 2, NULL, NULL, NULL, 1477369787, 1477369787),
	('/it/tipe-search/delete', 2, NULL, NULL, NULL, 1477369786, 1477369786),
	('/it/tipe-search/index', 2, NULL, NULL, NULL, 1477369813, 1477369813),
	('/it/tipe-search/update', 2, NULL, NULL, NULL, 1477369784, 1477369784),
	('/it/tipe-search/view', 2, NULL, NULL, NULL, 1477369785, 1477369785),
	('/kasir/default/index', 2, NULL, NULL, NULL, 1477711570, 1477711570),
	('/kasir/transaction/create', 2, NULL, NULL, NULL, 1479674136, 1479674136),
	('/kasir/transaction/get-karyawan', 2, NULL, NULL, NULL, 1479674618, 1479674618),
	('/kasir/transaction/get-max-struk', 2, NULL, NULL, NULL, 1479674147, 1479674147),
	('/kasir/transaction/get-price-item', 2, NULL, NULL, NULL, 1479674150, 1479674150),
	('/kasir/transaction/index', 2, NULL, NULL, NULL, 1479674156, 1479674156),
	('/manager/*', 2, NULL, NULL, NULL, 1477554287, 1477554287),
	('/manager/deal-komisi/*', 2, NULL, NULL, NULL, 1479673693, 1479673693),
	('/manager/deal-komisi/bulk-delete', 2, NULL, NULL, NULL, 1479673694, 1479673694),
	('/manager/deal-komisi/create', 2, NULL, NULL, NULL, 1479673694, 1479673694),
	('/manager/deal-komisi/delete', 2, NULL, NULL, NULL, 1479673695, 1479673695),
	('/manager/deal-komisi/get-karyawan', 2, NULL, NULL, NULL, 1479673696, 1479673696),
	('/manager/deal-komisi/index', 2, NULL, NULL, NULL, 1479673696, 1479673696),
	('/manager/deal-komisi/update', 2, NULL, NULL, NULL, 1479673698, 1479673698),
	('/manager/deal-komisi/view', 2, NULL, NULL, NULL, 1479673701, 1479673701),
	('/manager/default/*', 2, NULL, NULL, NULL, 1477554286, 1477554286),
	('/manager/default/index', 2, NULL, NULL, NULL, 1477554288, 1477554288),
	('/manager/item-layanan/*', 2, NULL, NULL, NULL, 1477555596, 1477555596),
	('/manager/item-layanan/bulk-delete', 2, NULL, NULL, NULL, 1479673702, 1479673702),
	('/manager/item-layanan/create', 2, NULL, NULL, NULL, 1477555598, 1477555598),
	('/manager/item-layanan/delete', 2, NULL, NULL, NULL, 1477555599, 1477555599),
	('/manager/item-layanan/index', 2, NULL, NULL, NULL, 1477555600, 1477555600),
	('/manager/item-layanan/update', 2, NULL, NULL, NULL, 1477555601, 1477555601),
	('/manager/item-layanan/view', 2, NULL, NULL, NULL, 1477555601, 1477555601),
	('/manager/karyawan/*', 2, NULL, NULL, NULL, 1479673713, 1479673713),
	('/manager/karyawan/create', 2, NULL, NULL, NULL, 1479673715, 1479673715),
	('/manager/karyawan/delete', 2, NULL, NULL, NULL, 1479673716, 1479673716),
	('/manager/karyawan/index', 2, NULL, NULL, NULL, 1479673716, 1479673716),
	('/manager/karyawan/update', 2, NULL, NULL, NULL, 1479673717, 1479673717),
	('/manager/karyawan/view', 2, NULL, NULL, NULL, 1479673718, 1479673718),
	('/manager/komisi-karyawan/*', 2, NULL, NULL, NULL, 1479673720, 1479673720),
	('/manager/komisi-karyawan/export-report-to-excel', 2, NULL, NULL, NULL, 1479673720, 1479673720),
	('/manager/komisi-karyawan/hitung-komisi', 2, NULL, NULL, NULL, 1479673721, 1479673721),
	('/manager/komisi-karyawan/index', 2, NULL, NULL, NULL, 1479673721, 1479673721),
	('/manager/list-harga/*', 2, NULL, NULL, NULL, 1479673724, 1479673724),
	('/manager/list-harga/bulk-delete', 2, NULL, NULL, NULL, 1479673725, 1479673725),
	('/manager/list-harga/create', 2, NULL, NULL, NULL, 1479673726, 1479673726),
	('/manager/list-harga/delete', 2, NULL, NULL, NULL, 1479673726, 1479673726),
	('/manager/list-harga/index', 2, NULL, NULL, NULL, 1479673727, 1479673727),
	('/manager/list-harga/update', 2, NULL, NULL, NULL, 1479673728, 1479673728),
	('/manager/list-harga/view', 2, NULL, NULL, NULL, 1479673728, 1479673728),
	('/manager/omset-toko/*', 2, NULL, NULL, NULL, 1479673733, 1479673733),
	('/manager/omset-toko/export-to-pdf-detail', 2, NULL, NULL, NULL, 1479673733, 1479673733),
	('/manager/omset-toko/export-to-pdf-rekap', 2, NULL, NULL, NULL, 1479673733, 1479673733),
	('/manager/omset-toko/hitung-omset', 2, NULL, NULL, NULL, 1479673734, 1479673734),
	('/manager/omset-toko/hitung-omset-rekap', 2, NULL, NULL, NULL, 1479673735, 1479673735),
	('/manager/omset-toko/index', 2, NULL, NULL, NULL, 1479673735, 1479673735),
	('/manager/omset/*', 2, NULL, NULL, NULL, 1479818328, 1479818328),
	('/manager/omset/create', 2, NULL, NULL, NULL, 1479674689, 1479674689),
	('/manager/omset/index', 2, NULL, NULL, NULL, 1479673750, 1479673750),
	('/manager/omset/update', 2, NULL, NULL, NULL, 1479818334, 1479818334),
	('/manager/omset/view', 2, NULL, NULL, NULL, 1479673943, 1479673943),
	('/manager/tipe-karyawan/*', 2, NULL, NULL, NULL, 1479673946, 1479673946),
	('/manager/tipe-karyawan/create', 2, NULL, NULL, NULL, 1479673950, 1479673950),
	('/manager/tipe-karyawan/delete', 2, NULL, NULL, NULL, 1479673950, 1479673950),
	('/manager/tipe-karyawan/index', 2, NULL, NULL, NULL, 1479673961, 1479673961),
	('/manager/tipe-karyawan/update', 2, NULL, NULL, NULL, 1479673961, 1479673961),
	('/manager/tipe-karyawan/view', 2, NULL, NULL, NULL, 1479673962, 1479673962),
	('/manager/tipe-layanan/create', 2, NULL, NULL, NULL, 1477554288, 1477554288),
	('/manager/tipe-layanan/delete', 2, NULL, NULL, NULL, 1477554289, 1477554289),
	('/manager/tipe-layanan/index', 2, NULL, NULL, NULL, 1477554290, 1477554290),
	('/manager/tipe-layanan/update', 2, NULL, NULL, NULL, 1477554291, 1477554291),
	('/manager/tipe-layanan/view', 2, NULL, NULL, NULL, 1477554292, 1477554292),
	('/manager/transaction-detail/create', 2, NULL, NULL, NULL, 1479674004, 1479674004),
	('/manager/transaction-detail/delete', 2, NULL, NULL, NULL, 1479674005, 1479674005),
	('/manager/transaction-detail/index', 2, NULL, NULL, NULL, 1479674011, 1479674011),
	('/manager/transaction-detail/update', 2, NULL, NULL, NULL, 1479674012, 1479674012),
	('/manager/transaction-detail/view', 2, NULL, NULL, NULL, 1479674013, 1479674013),
	('/mimin/*', 2, NULL, NULL, NULL, 1476849424, 1476849424),
	('/mimin/role/*', 2, NULL, NULL, NULL, 1476849424, 1476849424),
	('/mimin/role/create', 2, NULL, NULL, NULL, 1477369789, 1477369789),
	('/mimin/role/delete', 2, NULL, NULL, NULL, 1477369790, 1477369790),
	('/mimin/role/index', 2, NULL, NULL, NULL, 1477369791, 1477369791),
	('/mimin/role/permission', 2, NULL, NULL, NULL, 1477369792, 1477369792),
	('/mimin/role/update', 2, NULL, NULL, NULL, 1477369793, 1477369793),
	('/mimin/role/view', 2, NULL, NULL, NULL, 1477369793, 1477369793),
	('/mimin/route/*', 2, NULL, NULL, NULL, 1476849423, 1476849423),
	('/mimin/route/create', 2, NULL, NULL, NULL, 1477369798, 1477369798),
	('/mimin/route/delete', 2, NULL, NULL, NULL, 1477369797, 1477369797),
	('/mimin/route/generate', 2, NULL, NULL, NULL, 1477369796, 1477369796),
	('/mimin/route/index', 2, NULL, NULL, NULL, 1477369796, 1477369796),
	('/mimin/route/update', 2, NULL, NULL, NULL, 1477369795, 1477369795),
	('/mimin/route/view', 2, NULL, NULL, NULL, 1477369794, 1477369794),
	('/mimin/user/*', 2, NULL, NULL, NULL, 1476849423, 1476849423),
	('/mimin/user/create', 2, NULL, NULL, NULL, 1477369798, 1477369798),
	('/mimin/user/delete', 2, NULL, NULL, NULL, 1477369799, 1477369799),
	('/mimin/user/index', 2, NULL, NULL, NULL, 1477369800, 1477369800),
	('/mimin/user/update', 2, NULL, NULL, NULL, 1477369807, 1477369807),
	('/mimin/user/view', 2, NULL, NULL, NULL, 1477369802, 1477369802),
	('/site/*', 2, NULL, NULL, NULL, 1476849448, 1476849448),
	('/site/about', 2, NULL, NULL, NULL, 1477369804, 1477369804),
	('/site/captcha', 2, NULL, NULL, NULL, 1477369805, 1477369805),
	('/site/contact', 2, NULL, NULL, NULL, 1477369806, 1477369806),
	('/site/error', 2, NULL, NULL, NULL, 1477369807, 1477369807),
	('/site/index', 2, NULL, NULL, NULL, 1477369808, 1477369808),
	('/site/login', 2, NULL, NULL, NULL, 1477369809, 1477369809),
	('/site/logout', 2, NULL, NULL, NULL, 1477369819, 1477369819),
	('Administrator', 1, NULL, NULL, NULL, 1476817610, 1476817610),
	('Kasir', 1, NULL, NULL, NULL, 1477550326, 1477550326),
	('Manager', 1, NULL, NULL, NULL, 1477550314, 1477550314),
	('Owner', 1, NULL, NULL, NULL, 1477550302, 1477550302);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;


-- Dumping structure for table ybeauty.auth_item_child
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ybeauty.auth_item_child: ~157 rows (approximately)
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('Administrator', '/*'),
	('Administrator', '/admin/*'),
	('Administrator', '/admin/default/*'),
	('Administrator', '/admin/default/index'),
	('Administrator', '/debug/*'),
	('Administrator', '/debug/default/*'),
	('Administrator', '/debug/default/db-explain'),
	('Administrator', '/debug/default/download-mail'),
	('Administrator', '/debug/default/index'),
	('Administrator', '/debug/default/toolbar'),
	('Administrator', '/debug/default/view'),
	('Administrator', '/gii/*'),
	('Administrator', '/gii/default/*'),
	('Administrator', '/gii/default/action'),
	('Administrator', '/gii/default/diff'),
	('Administrator', '/gii/default/index'),
	('Administrator', '/gii/default/preview'),
	('Administrator', '/gii/default/view'),
	('Administrator', '/gridview/*'),
	('Administrator', '/gridview/export/*'),
	('Administrator', '/gridview/export/download'),
	('Administrator', '/hrd/*'),
	('Administrator', '/hrd/branch/create'),
	('Administrator', '/hrd/branch/delete'),
	('Administrator', '/hrd/branch/index'),
	('Administrator', '/hrd/branch/update'),
	('Administrator', '/hrd/branch/view'),
	('Administrator', '/hrd/default/index'),
	('Administrator', '/hrd/departement/*'),
	('Administrator', '/hrd/departement/delete'),
	('Administrator', '/hrd/departement/index'),
	('Administrator', '/hrd/departement/update'),
	('Administrator', '/hrd/departement/view'),
	('Administrator', '/hrd/karyawan/create'),
	('Administrator', '/hrd/karyawan/delete'),
	('Administrator', '/hrd/karyawan/index'),
	('Administrator', '/hrd/karyawan/update'),
	('Administrator', '/hrd/karyawan/view'),
	('Administrator', '/hrd/perusahaan/create'),
	('Administrator', '/hrd/perusahaan/delete'),
	('Administrator', '/hrd/perusahaan/index'),
	('Administrator', '/hrd/perusahaan/update'),
	('Administrator', '/hrd/perusahaan/view'),
	('Administrator', '/it/*'),
	('Administrator', '/it/default/*'),
	('Administrator', '/it/default/index'),
	('Administrator', '/it/request/*'),
	('Administrator', '/it/request/create'),
	('Administrator', '/it/request/delete'),
	('Administrator', '/it/request/index'),
	('Administrator', '/it/request/update'),
	('Administrator', '/it/request/view'),
	('Administrator', '/it/tipe-search/*'),
	('Administrator', '/it/tipe-search/create'),
	('Administrator', '/it/tipe-search/delete'),
	('Administrator', '/it/tipe-search/index'),
	('Administrator', '/it/tipe-search/update'),
	('Administrator', '/it/tipe-search/view'),
	('Kasir', '/kasir/default/index'),
	('Kasir', '/kasir/transaction/create'),
	('Kasir', '/kasir/transaction/get-karyawan'),
	('Kasir', '/kasir/transaction/get-max-struk'),
	('Kasir', '/kasir/transaction/get-price-item'),
	('Kasir', '/kasir/transaction/index'),
	('Manager', '/manager/*'),
	('Manager', '/manager/deal-komisi/*'),
	('Manager', '/manager/deal-komisi/bulk-delete'),
	('Manager', '/manager/deal-komisi/create'),
	('Manager', '/manager/deal-komisi/delete'),
	('Manager', '/manager/deal-komisi/get-karyawan'),
	('Manager', '/manager/deal-komisi/index'),
	('Manager', '/manager/deal-komisi/update'),
	('Manager', '/manager/deal-komisi/view'),
	('Manager', '/manager/default/*'),
	('Manager', '/manager/default/index'),
	('Manager', '/manager/item-layanan/*'),
	('Manager', '/manager/item-layanan/bulk-delete'),
	('Manager', '/manager/item-layanan/create'),
	('Manager', '/manager/item-layanan/delete'),
	('Manager', '/manager/item-layanan/index'),
	('Manager', '/manager/item-layanan/update'),
	('Manager', '/manager/item-layanan/view'),
	('Manager', '/manager/karyawan/*'),
	('Manager', '/manager/karyawan/create'),
	('Manager', '/manager/karyawan/delete'),
	('Manager', '/manager/karyawan/index'),
	('Manager', '/manager/karyawan/update'),
	('Manager', '/manager/karyawan/view'),
	('Manager', '/manager/komisi-karyawan/*'),
	('Manager', '/manager/komisi-karyawan/export-report-to-excel'),
	('Manager', '/manager/komisi-karyawan/hitung-komisi'),
	('Manager', '/manager/komisi-karyawan/index'),
	('Manager', '/manager/list-harga/*'),
	('Manager', '/manager/list-harga/bulk-delete'),
	('Manager', '/manager/list-harga/create'),
	('Manager', '/manager/list-harga/delete'),
	('Manager', '/manager/list-harga/index'),
	('Manager', '/manager/list-harga/update'),
	('Manager', '/manager/list-harga/view'),
	('Manager', '/manager/omset-toko/*'),
	('Manager', '/manager/omset-toko/export-to-pdf-detail'),
	('Manager', '/manager/omset-toko/export-to-pdf-rekap'),
	('Manager', '/manager/omset-toko/hitung-omset'),
	('Manager', '/manager/omset-toko/hitung-omset-rekap'),
	('Manager', '/manager/omset-toko/index'),
	('Kasir', '/manager/omset/*'),
	('Kasir', '/manager/omset/create'),
	('Kasir', '/manager/omset/index'),
	('Manager', '/manager/omset/index'),
	('Kasir', '/manager/omset/update'),
	('Kasir', '/manager/omset/view'),
	('Manager', '/manager/omset/view'),
	('Manager', '/manager/tipe-karyawan/*'),
	('Manager', '/manager/tipe-karyawan/create'),
	('Manager', '/manager/tipe-karyawan/delete'),
	('Manager', '/manager/tipe-karyawan/index'),
	('Manager', '/manager/tipe-karyawan/update'),
	('Manager', '/manager/tipe-karyawan/view'),
	('Manager', '/manager/tipe-layanan/create'),
	('Manager', '/manager/tipe-layanan/delete'),
	('Manager', '/manager/tipe-layanan/index'),
	('Manager', '/manager/tipe-layanan/update'),
	('Manager', '/manager/tipe-layanan/view'),
	('Manager', '/manager/transaction-detail/create'),
	('Manager', '/manager/transaction-detail/delete'),
	('Manager', '/manager/transaction-detail/index'),
	('Manager', '/manager/transaction-detail/update'),
	('Manager', '/manager/transaction-detail/view'),
	('Administrator', '/mimin/*'),
	('Administrator', '/mimin/role/*'),
	('Administrator', '/mimin/role/create'),
	('Administrator', '/mimin/role/delete'),
	('Administrator', '/mimin/role/index'),
	('Administrator', '/mimin/role/permission'),
	('Administrator', '/mimin/role/update'),
	('Administrator', '/mimin/role/view'),
	('Administrator', '/mimin/route/*'),
	('Administrator', '/mimin/route/create'),
	('Administrator', '/mimin/route/delete'),
	('Administrator', '/mimin/route/generate'),
	('Administrator', '/mimin/route/index'),
	('Administrator', '/mimin/route/update'),
	('Administrator', '/mimin/route/view'),
	('Administrator', '/mimin/user/*'),
	('Administrator', '/mimin/user/create'),
	('Administrator', '/mimin/user/delete'),
	('Administrator', '/mimin/user/index'),
	('Administrator', '/mimin/user/update'),
	('Administrator', '/mimin/user/view'),
	('Administrator', '/site/*'),
	('Administrator', '/site/about'),
	('Administrator', '/site/captcha'),
	('Administrator', '/site/contact'),
	('Administrator', '/site/error'),
	('Administrator', '/site/index'),
	('Administrator', '/site/login'),
	('Administrator', '/site/logout');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;


-- Dumping structure for table ybeauty.auth_rule
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ybeauty.auth_rule: ~0 rows (approximately)
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;


-- Dumping structure for view ybeauty.dates
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `dates` (
	`date` DATE NULL
) ENGINE=MyISAM;


-- Dumping structure for table ybeauty.deal_komisi
CREATE TABLE IF NOT EXISTS `deal_komisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `karyawan_id` int(11) NOT NULL,
  `list_harga_id` int(11) NOT NULL,
  `komisi` int(3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_deal_komisi_karyawan` (`karyawan_id`),
  KEY `FK_deal_komisi_list_harga` (`list_harga_id`),
  CONSTRAINT `FK_deal_komisi_karyawan` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_deal_komisi_list_harga` FOREIGN KEY (`list_harga_id`) REFERENCES `list_harga` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- Dumping data for table ybeauty.deal_komisi: ~19 rows (approximately)
/*!40000 ALTER TABLE `deal_komisi` DISABLE KEYS */;
INSERT INTO `deal_komisi` (`id`, `karyawan_id`, `list_harga_id`, `komisi`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
	(24, 1, 4, 10, '2016-11-14 16:25:52', '2016-11-14 16:25:52', '1', '1'),
	(25, 1, 5, 15, '2016-11-14 16:27:05', '2016-11-14 16:27:05', '1', '1'),
	(26, 1, 6, 10, '2016-11-14 16:29:12', '2016-11-14 16:29:12', '1', '1'),
	(27, 1, 7, 10, '2016-11-14 16:29:38', '2016-11-14 16:29:38', '1', '1'),
	(28, 1, 8, 50, '2016-11-14 16:30:42', '2016-11-14 16:30:42', '1', '1'),
	(29, 1, 9, 20, '2016-11-14 16:31:59', '2016-11-14 16:31:59', '1', '1'),
	(30, 1, 12, 10, '2016-11-14 16:32:20', '2016-11-14 16:32:20', '1', '1'),
	(31, 1, 13, 40, '2016-11-14 16:33:00', '2016-11-14 16:33:00', '1', '1'),
	(32, 1, 14, 46, '2016-11-14 16:33:21', '2016-11-14 16:33:21', '1', '1'),
	(34, 1, 15, 15, '2016-11-14 16:34:51', '2016-11-14 16:34:51', '1', '1'),
	(35, 1, 16, 50, '2016-11-14 16:35:09', '2016-11-14 16:35:09', '1', '1'),
	(36, 1, 17, 16, '2016-11-14 16:35:27', '2016-11-14 16:35:27', '1', '1'),
	(38, 2, 19, 40, '2016-11-14 22:12:30', '2016-11-14 22:12:30', '1', '1'),
	(39, 2, 20, 50, '2016-11-14 22:32:32', '2016-11-14 22:32:32', '1', '1'),
	(40, 2, 21, 80, '2016-11-16 00:28:02', '2016-11-16 00:28:02', '1', '1'),
	(41, 2, 22, 32, '2016-11-20 13:00:55', '2016-11-20 13:00:55', '1', '1'),
	(42, 2, 23, 30, '2016-11-20 13:45:54', '2016-11-20 13:45:54', '1', '1'),
	(43, 2, 24, 40, '2016-11-20 13:46:10', '2016-11-20 13:46:10', '1', '1'),
	(44, 2, 45, 80, '2016-11-20 13:48:16', '2016-11-20 13:48:16', '1', '1');
/*!40000 ALTER TABLE `deal_komisi` ENABLE KEYS */;


-- Dumping structure for view ybeauty.digits
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `digits` (
	`digit` BIGINT(20) NOT NULL
) ENGINE=MyISAM;


-- Dumping structure for table ybeauty.item_layanan
CREATE TABLE IF NOT EXISTS `item_layanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_item` varchar(50) DEFAULT NULL,
  `tipe_id` int(11) NOT NULL DEFAULT '0',
  `kode_panggil` char(50) NOT NULL DEFAULT '0',
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_layanan_tipe_layanan` (`tipe_id`),
  CONSTRAINT `FK_item_layanan_tipe_layanan` FOREIGN KEY (`tipe_id`) REFERENCES `tipe_layanan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

-- Dumping data for table ybeauty.item_layanan: ~98 rows (approximately)
/*!40000 ALTER TABLE `item_layanan` DISABLE KEYS */;
INSERT INTO `item_layanan` (`id`, `nama_item`, `tipe_id`, `kode_panggil`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
	(1, 'Gunting Wanita', 1, 'G1', NULL, '2016-11-07 22:14:18', '2016-11-07 22:14:18', '1', '1'),
	(2, 'Gunting Pria', 1, 'G2', NULL, '2016-11-07 22:15:56', '2016-11-07 22:15:58', '1', '1'),
	(3, 'Gunting Pelajar Wanita', 1, 'G3', NULL, '2016-11-07 22:16:23', '2016-11-07 22:16:24', '1', '1'),
	(4, 'Gunting Pelajar Pria', 1, 'G4', NULL, '2016-11-07 22:16:53', '2016-11-07 22:16:53', '1', '1'),
	(5, 'Gunting For Kids', 1, 'G5', NULL, '2016-11-07 22:17:19', '2016-11-07 22:17:19', '1', '1'),
	(6, 'Gunting Poni', 1, 'G6', NULL, '2016-11-07 22:17:55', '2016-11-07 22:17:55', '1', '1'),
	(7, 'Blow Curly, Catok, Biasa', 2, 'BL', NULL, '2016-11-07 23:30:18', '2016-11-07 23:30:19', '1', '1'),
	(8, 'Blow Set', 2, 'BL', NULL, '2016-11-07 23:30:41', '2016-11-07 23:30:41', '1', '1'),
	(9, 'Styling Pria', 18, 'MUP1', NULL, '2016-11-07 23:32:26', '2016-11-07 23:32:26', '1', '1'),
	(10, 'Styling Sanggul', 18, 'MUP2', NULL, '2016-11-07 23:32:56', '2016-11-07 23:32:57', '1', '1'),
	(11, 'Make Up', 18, 'MUP3', NULL, '2016-11-07 23:33:31', '2016-11-07 23:33:32', '1', '1'),
	(12, 'Make Up Mata', 18, 'MUP4', NULL, '2016-11-07 23:34:01', '2016-11-07 23:34:01', '1', '1'),
	(14, 'Cat Highlight Short', 9, 'CAT1', NULL, '2016-11-07 23:48:38', '2016-11-07 23:48:38', '1', '1'),
	(15, 'Cat Highlight Medium', 9, 'CAT2', NULL, '2016-11-07 23:49:07', '2016-11-07 23:49:07', '1', '1'),
	(16, 'Cat Highlight Long', 9, 'CAT3', NULL, '2016-11-07 23:49:34', '2016-11-07 23:49:34', '1', '1'),
	(20, 'Cat Hightlight Extra Long', 9, 'CAT4', NULL, '2016-11-07 23:50:01', '2016-11-07 23:50:01', '1', '1'),
	(21, 'Dry', 22, 'DRY', NULL, '2016-11-07 23:50:55', '2016-11-07 23:50:55', '1', '1'),
	(22, 'Cabut Alis', 20, 'CA', NULL, '2016-11-07 23:51:21', '2016-11-07 23:51:21', '1', '1'),
	(23, 'Creambath', 3, 'C', NULL, '2016-11-07 23:53:00', '2016-11-07 23:53:01', '1', '1'),
	(24, 'Hair Spa', 5, 'SPA', NULL, '2016-11-07 23:53:56', '2016-11-07 23:53:56', '1', '1'),
	(25, 'Hair Masker', 4, 'HMK', NULL, '2016-11-07 23:54:22', '2016-11-07 23:54:23', '1', '1'),
	(26, 'Ozon Therapy', 6, 'OZ', NULL, '2016-11-07 23:54:53', '2016-11-07 23:54:53', '1', '1'),
	(27, 'Foot Reflext', 24, 'FR', NULL, '2016-11-07 23:55:56', '2016-11-07 23:55:57', '1', '1'),
	(28, 'Totok Wajah', 30, 'TTK', NULL, '2016-11-07 23:56:26', '2016-11-07 23:56:26', '1', '1'),
	(29, 'Back / Hand Massage', 27, 'BKM/HM', NULL, '2016-11-07 23:59:16', '2016-11-07 23:59:16', '1', '1'),
	(30, 'Manicure', 14, 'M', NULL, '2016-11-07 23:59:44', '2016-11-07 23:59:45', '1', '1'),
	(31, 'Pedicure', 15, 'P', NULL, '2016-11-08 00:00:16', '2016-11-08 00:00:16', '1', '1'),
	(32, 'Hand / Foot Polish', 24, 'FR', NULL, '2016-11-08 00:03:06', '2016-11-08 00:03:06', '1', '1'),
	(33, 'Jasa Kutex', 16, 'KTK1', NULL, '2016-11-08 00:03:52', '2016-11-08 00:03:52', '1', '1'),
	(34, 'Basic Cool Men', 9, 'CAT5', NULL, '2016-11-08 00:08:40', '2016-11-08 00:08:40', '1', '1'),
	(35, 'Basic Cool Short', 9, 'CAT6', NULL, '2016-11-08 00:10:14', '2016-11-08 00:10:14', '1', '1'),
	(36, 'Basic Cool Long', 9, 'CAT7', NULL, '2016-11-08 00:10:57', '2016-11-08 00:10:57', '1', '1'),
	(37, 'Cat Akar', 9, 'CAT8', NULL, '2016-11-08 00:11:27', '2016-11-08 00:11:27', '1', '1'),
	(38, 'Cat Akar Warna', 9, 'CAT9', NULL, '2016-11-08 00:12:27', '2016-11-08 00:12:27', '1', '1'),
	(39, 'Toning Short', 8, 'TNG1', NULL, '2016-11-08 00:13:09', '2016-11-08 00:13:09', '1', '1'),
	(40, 'Toning Medium', 8, 'TNG2', NULL, '2016-11-08 00:15:10', '2016-11-08 00:15:12', '1', '1'),
	(41, 'Fashion Coll Men', 25, 'HT1', NULL, '2016-11-08 00:16:56', '2016-11-08 00:17:09', '1', '1'),
	(42, 'Fashion Coll Short', 25, 'HT2', NULL, '2016-10-08 00:19:40', '2016-11-08 00:19:41', '1', '1'),
	(43, 'Fashion Coll Long', 25, 'HT3', NULL, '2016-11-08 00:19:42', '2016-11-08 00:19:43', '1', '1'),
	(44, 'Fashion Coll Extra Long', 25, 'HT4', NULL, '2016-11-08 00:19:44', '2016-11-08 00:19:45', '1', '1'),
	(45, 'Ombree', 10, 'OMBREE', NULL, '2016-11-08 00:21:04', '2016-11-08 00:21:04', '1', '1'),
	(46, 'Keriting Poni Loreal Dulcia', 11, 'K1', NULL, '2016-11-08 00:22:23', '2016-11-08 00:22:23', '1', '1'),
	(47, 'Keriting Short Loreal Dulcia', 11, 'K2', NULL, '2016-11-08 00:25:54', '2016-11-08 00:25:54', '1', '1'),
	(48, 'Keriting Medium Loreal Dulcia', 11, 'K3', NULL, '2016-11-08 00:27:36', '2016-11-08 00:27:36', '1', '1'),
	(49, 'Keriting Long Loreal Dulcia', 11, 'K4', NULL, '2016-11-08 00:28:08', '2016-11-08 00:28:08', '1', '1'),
	(50, 'Keriting Poni Loreal Curia', 11, 'K5', NULL, '2016-11-08 00:29:39', '2016-11-08 00:29:39', '1', '1'),
	(51, 'Keriting Short Loreal Curia', 11, 'K6', NULL, '2016-11-08 00:30:21', '2016-11-08 00:30:21', '1', '1'),
	(52, 'Keriting Medium Loreal Curia', 11, 'K7', NULL, '2016-11-08 00:38:20', '2016-11-08 00:38:21', '1', '1'),
	(53, 'Keriting Long Loreal Curia', 11, 'K8', NULL, '2016-11-08 00:38:29', '2016-11-08 00:38:46', '1', '1'),
	(54, 'Keriting Korea Short', 11, 'K9', NULL, '2016-11-08 00:38:31', '2016-11-08 00:38:47', '1', '1'),
	(55, 'Keriting Korea Medium', 11, 'K10', NULL, '2016-11-08 00:38:32', '2016-11-08 00:38:48', '1', '1'),
	(56, 'Keriting Korea Long', 11, 'K11', NULL, '2016-11-08 00:38:34', '2016-11-08 00:38:49', '1', '1'),
	(57, 'Smoothing Poni', 13, 'SMT1', NULL, '2016-11-08 00:38:35', '2016-11-08 00:38:51', '1', '1'),
	(58, 'Smoothing Short', 13, 'SMT2', NULL, '2016-11-08 00:38:36', '2016-11-08 00:38:50', '1', '1'),
	(59, 'Smoothing Medium', 13, 'SMT3', NULL, '2016-11-08 00:38:38', '2016-11-08 00:38:52', '1', '1'),
	(60, 'Smoothing Long', 13, 'SMT4', NULL, '2016-11-08 00:38:37', '2016-11-08 00:38:53', '1', '1'),
	(61, 'Smoothing I Poni', 13, 'SMT5', NULL, '2016-11-08 00:38:40', '2016-11-08 00:38:54', '1', '1'),
	(62, 'Smoothing I Short', 13, 'SMT6', NULL, '2016-11-08 00:38:41', '2016-11-08 00:38:55', '1', '1'),
	(63, 'Smoothing I Medium', 13, 'SMT7', NULL, '2016-11-08 00:38:43', '2016-11-08 00:38:58', '1', '1'),
	(64, 'Smoothing I Long', 13, 'SMT8', NULL, '2016-11-08 00:38:44', '2016-11-08 00:38:57', '1', '1'),
	(65, 'Rebonding Short', 12, 'RBD1', '', '2016-11-08 00:45:48', '2016-11-08 00:45:48', '1', '1'),
	(66, 'Rebonding Medium', 12, 'RBD2', '', '2016-11-08 00:46:43', '2016-11-08 00:46:43', '1', '1'),
	(67, 'Rebonding Long', 12, 'RBD3', '', '2016-11-08 00:47:08', '2016-11-08 00:47:08', '1', '1'),
	(68, 'Cleansing Sort 1 X', 7, 'BLC1', '', '2016-11-08 00:49:40', '2016-11-08 00:49:40', '1', '1'),
	(69, 'Cleansing Sort 2 X', 7, 'BLC2', '', '2016-11-08 00:50:19', '2016-11-08 00:50:19', '1', '1'),
	(70, 'Cleansing Sort 3 X', 7, 'BLC3', '', '2016-11-08 00:51:04', '2016-11-08 00:51:04', '1', '1'),
	(71, 'Cleansing Medium 1 X', 7, 'BLC4', NULL, '2016-11-08 00:49:40', '2016-11-08 00:49:40', '1', '1'),
	(72, 'Cleansing Medium 2 X', 7, 'BLC5', NULL, '2016-11-08 00:50:19', '2016-11-08 00:50:19', '1', '1'),
	(73, 'Cleansing Medium 3 X', 7, 'BLC6', NULL, '2016-11-08 00:51:04', '2016-11-08 00:51:04', '1', '1'),
	(74, 'Cleansing Long 1 X', 7, 'BLC7', NULL, '2016-11-08 00:51:04', '2016-11-08 00:51:04', '1', '1'),
	(75, 'Cleansing Long 2 X', 7, 'BLC8', NULL, '2016-11-08 00:51:04', '2016-11-08 00:51:04', '1', '1'),
	(76, 'Cleansing Long 3 X', 7, 'BLC9', NULL, '2016-11-08 00:51:04', '2016-11-08 00:51:04', '1', '1'),
	(77, 'Cleansing Extra Long 1 X', 7, 'BLC10', NULL, '2016-11-08 00:51:04', '2016-11-08 00:51:04', '1', '1'),
	(78, 'Cleansing Extra Long 2 X', 7, 'BLC11', NULL, '2016-11-08 00:51:04', '2016-11-08 00:51:04', '1', '1'),
	(79, 'Cleansing Extra Long 3 X', 7, 'BLC11', NULL, '2016-11-08 00:51:04', '2016-11-08 00:51:04', '1', '1'),
	(80, 'Highlight Short 1 X', 10, 'HGL1', NULL, NULL, NULL, NULL, NULL),
	(81, 'Highlight Short 2 X', 10, 'HGL2', NULL, NULL, NULL, NULL, NULL),
	(82, 'Highlight Short 3x', 10, 'HGL3', NULL, NULL, NULL, NULL, NULL),
	(83, 'Highlight Medium 1 X', 10, 'HGL4', NULL, NULL, NULL, NULL, NULL),
	(84, 'Highlight Medium 2 X', 10, 'HGL5', NULL, NULL, NULL, NULL, NULL),
	(85, 'Highlight Medium 3 X', 10, 'HGL6', NULL, NULL, NULL, NULL, NULL),
	(86, 'Highlight Long 1 X', 10, 'HGL7', NULL, NULL, NULL, NULL, NULL),
	(87, 'Highlight Long 2 X', 10, 'HGL8', NULL, NULL, NULL, NULL, NULL),
	(88, 'Highlight Long 3 X', 10, 'HGL9', NULL, NULL, NULL, NULL, NULL),
	(89, 'Highlight Extra Long 1 X', 10, 'HGL10', NULL, NULL, NULL, NULL, NULL),
	(90, 'Highlight Extra Long 2 X', 10, 'HGL11', NULL, NULL, NULL, NULL, NULL),
	(91, 'Highlight Extra Long 3 X', 10, 'HGL12', NULL, NULL, NULL, NULL, NULL),
	(92, 'Grazy Colour Short Man', 9, 'CAT10', NULL, NULL, NULL, NULL, NULL),
	(93, 'Grazy Colour Short Woman', 9, 'CAT11', NULL, NULL, NULL, NULL, NULL),
	(94, 'Grazy Colour Medium', 9, 'CAT12', NULL, NULL, NULL, NULL, NULL),
	(95, 'Grazy Colour Long 1', 9, 'CAT13', NULL, NULL, NULL, NULL, NULL),
	(96, 'Grazy Colour Long 2', 9, 'CAT14', '', NULL, '2016-11-08 16:44:23', NULL, '1'),
	(97, 'Basic Coll Medium', 9, 'CAT16', '', '2016-11-08 15:40:26', '2016-11-08 15:40:26', '1', '1'),
	(98, 'Fashion Coll Medium', 25, 'HT5', '', '2016-11-08 15:47:07', '2016-11-08 15:47:07', '1', '1'),
	(99, 'Hair Manicure Short', 4, 'HM1', NULL, '2016-11-08 15:57:51', '2016-11-08 15:57:52', '1', '1'),
	(100, 'Hair Manicure Medium', 4, 'HM2', NULL, NULL, NULL, NULL, NULL),
	(101, 'Hair Manicure Long', 4, 'HM3', NULL, '2016-11-08 16:00:46', '2016-11-08 16:00:47', '1', '1'),
	(102, 'Hair Manicure Men', 4, 'HM4', NULL, '2016-11-08 16:01:11', '2016-11-08 16:01:11', '1', '1');
/*!40000 ALTER TABLE `item_layanan` ENABLE KEYS */;


-- Dumping structure for table ybeauty.job_order
CREATE TABLE IF NOT EXISTS `job_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_jo` int(11) NOT NULL DEFAULT '0',
  `kepada` varchar(50) NOT NULL,
  `dari` varchar(50) NOT NULL,
  `job_order_kerja_id` int(11) NOT NULL,
  `jenis_pekerjaan` varchar(120) NOT NULL,
  `data_pendukung` text,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_job_order_job_order_kerja` (`job_order_kerja_id`),
  CONSTRAINT `FK_job_order_job_order_kerja` FOREIGN KEY (`job_order_kerja_id`) REFERENCES `job_order_kerja` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ybeauty.job_order: ~1 rows (approximately)
/*!40000 ALTER TABLE `job_order` DISABLE KEYS */;
INSERT INTO `job_order` (`id`, `nomor_jo`, `kepada`, `dari`, `job_order_kerja_id`, `jenis_pekerjaan`, `data_pendukung`, `keterangan`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
	(2, 1, 'Dzil', 'mochamad', 2, '1', NULL, NULL, '2016-11-17 17:15:25', '2016-11-17 17:15:25', NULL, NULL);
/*!40000 ALTER TABLE `job_order` ENABLE KEYS */;


-- Dumping structure for table ybeauty.job_order_jenis_biaya
CREATE TABLE IF NOT EXISTS `job_order_jenis_biaya` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_order_id` int(11) DEFAULT NULL,
  `job_order_jenis_biaya_item_id` int(11) DEFAULT NULL,
  `mata_uang` char(4) NOT NULL DEFAULT 'Rp.',
  `kasbon` decimal(12,2) DEFAULT NULL,
  `bayar` decimal(12,2) DEFAULT NULL,
  `selisih` decimal(12,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_jo_jenis_biaya_job_order` (`job_order_id`),
  KEY `FK_job_order_jenis_biaya_job_order_jenis_biaya_item` (`job_order_jenis_biaya_item_id`),
  CONSTRAINT `FK_jo_jenis_biaya_job_order` FOREIGN KEY (`job_order_id`) REFERENCES `job_order` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_job_order_jenis_biaya_job_order_jenis_biaya_item` FOREIGN KEY (`job_order_jenis_biaya_item_id`) REFERENCES `job_order_jenis_biaya_item` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table ybeauty.job_order_jenis_biaya: ~2 rows (approximately)
/*!40000 ALTER TABLE `job_order_jenis_biaya` DISABLE KEYS */;
INSERT INTO `job_order_jenis_biaya` (`id`, `job_order_id`, `job_order_jenis_biaya_item_id`, `mata_uang`, `kasbon`, `bayar`, `selisih`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
	(6, 2, 3, 'Rp.', 100000.00, 0.00, NULL, NULL, NULL, NULL, NULL),
	(7, 2, 4, 'Rp.', 20000.00, 0.00, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `job_order_jenis_biaya` ENABLE KEYS */;


-- Dumping structure for table ybeauty.job_order_jenis_biaya_item
CREATE TABLE IF NOT EXISTS `job_order_jenis_biaya_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_biaya` varchar(120) DEFAULT NULL,
  `kode` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table ybeauty.job_order_jenis_biaya_item: ~4 rows (approximately)
/*!40000 ALTER TABLE `job_order_jenis_biaya_item` DISABLE KEYS */;
INSERT INTO `job_order_jenis_biaya_item` (`id`, `nama_biaya`, `kode`) VALUES
	(1, 'Makan Malam', '00001'),
	(2, 'Makan Siang', '00002'),
	(3, 'Gunting Rambut', '00003'),
	(4, 'Minyak Rambut', NULL);
/*!40000 ALTER TABLE `job_order_jenis_biaya_item` ENABLE KEYS */;


-- Dumping structure for table ybeauty.job_order_kerja
CREATE TABLE IF NOT EXISTS `job_order_kerja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kerja` varchar(120) NOT NULL,
  `kode` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ybeauty.job_order_kerja: ~2 rows (approximately)
/*!40000 ALTER TABLE `job_order_kerja` DISABLE KEYS */;
INSERT INTO `job_order_kerja` (`id`, `nama_kerja`, `kode`) VALUES
	(1, 'Pembayaran Tagihan', '00001'),
	(2, 'Pembelian Kosmetik', '00002');
/*!40000 ALTER TABLE `job_order_kerja` ENABLE KEYS */;


-- Dumping structure for table ybeauty.job_order_kerja_jenis
CREATE TABLE IF NOT EXISTS `job_order_kerja_jenis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(5) DEFAULT NULL,
  `nama_jenis_kerja` varchar(120) DEFAULT NULL,
  `job_order_kerja_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__job_order_kerja` (`job_order_kerja_id`),
  CONSTRAINT `FK__job_order_kerja` FOREIGN KEY (`job_order_kerja_id`) REFERENCES `job_order_kerja` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ybeauty.job_order_kerja_jenis: ~2 rows (approximately)
/*!40000 ALTER TABLE `job_order_kerja_jenis` DISABLE KEYS */;
INSERT INTO `job_order_kerja_jenis` (`id`, `kode`, `nama_jenis_kerja`, `job_order_kerja_id`) VALUES
	(1, '00001', 'Bayar Listrik', 1),
	(2, '00002', 'Bayar Air', 1),
	(3, '00003', 'Minyak Rambut', 2);
/*!40000 ALTER TABLE `job_order_kerja_jenis` ENABLE KEYS */;


-- Dumping structure for table ybeauty.karyawan
CREATE TABLE IF NOT EXISTS `karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_karyawan` varchar(125) NOT NULL,
  `alamat` text NOT NULL,
  `phone` varchar(125) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_karyawan_tipe_karyawan` (`type_id`),
  CONSTRAINT `FK_karyawan_tipe_karyawan` FOREIGN KEY (`type_id`) REFERENCES `tipe_karyawan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table ybeauty.karyawan: ~2 rows (approximately)
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;
INSERT INTO `karyawan` (`id`, `nama_karyawan`, `alamat`, `phone`, `type_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
	(1, 'Ivan', 'No Address', '08979613057', 1, '2016-10-31 19:16:59', '2016-11-10 15:10:21', '1', '1'),
	(2, 'Rizal', 'Jati Bening', '08979613057', 2, '2016-11-14 21:38:00', '2016-11-14 21:38:00', '1', '1'),
	(21, 'Euis', 'Tebet Selatan', '08979613057', 4, '2016-11-16 15:02:22', '2016-11-16 15:02:22', '1', '1');
/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;


-- Dumping structure for table ybeauty.list_harga
CREATE TABLE IF NOT EXISTS `list_harga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `item_layanan_id` int(2) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tipe_karyawan_item_layanan` (`item_layanan_id`),
  KEY `FK_tipe_karyawan_parent_type_karyawan_layanan` (`parent_id`),
  CONSTRAINT `FK_tipe_karyawan_item_layanan` FOREIGN KEY (`item_layanan_id`) REFERENCES `item_layanan` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_tipe_karyawan_parent_type_karyawan_layanan` FOREIGN KEY (`parent_id`) REFERENCES `tipe_karyawan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;

-- Dumping data for table ybeauty.list_harga: ~108 rows (approximately)
/*!40000 ALTER TABLE `list_harga` DISABLE KEYS */;
INSERT INTO `list_harga` (`id`, `parent_id`, `item_layanan_id`, `harga`) VALUES
	(4, 1, 1, 100000.00),
	(5, 1, 2, 90000.00),
	(6, 1, 3, 80000.00),
	(7, 1, 4, 80000.00),
	(8, 1, 5, 65000.00),
	(9, 1, 6, 25000.00),
	(12, 1, 7, 80000.00),
	(13, 1, 8, 75000.00),
	(14, 1, 9, 20000.00),
	(15, 1, 10, 100000.00),
	(16, 1, 11, 400000.00),
	(17, 1, 12, 200000.00),
	(19, 2, 1, 75000.00),
	(20, 2, 2, 70000.00),
	(21, 2, 6, 20000.00),
	(22, 2, 7, 70000.00),
	(23, 2, 9, 20000.00),
	(24, 2, 10, 85000.00),
	(25, 3, 1, 50000.00),
	(26, 3, 10, 85000.00),
	(27, 3, 11, 200000.00),
	(28, 3, 12, 125000.00),
	(29, 4, 14, 200000.00),
	(30, 4, 15, 325000.00),
	(31, 4, 16, 350000.00),
	(32, 4, 20, 425000.00),
	(33, 4, 21, 20000.00),
	(34, 4, 22, 60000.00),
	(35, 4, 23, 60000.00),
	(36, 4, 24, 100000.00),
	(37, 4, 25, 90000.00),
	(38, 4, 26, 20000.00),
	(39, 4, 27, 50000.00),
	(40, 4, 28, 50000.00),
	(41, 4, 29, 45000.00),
	(42, 4, 30, 50000.00),
	(43, 4, 31, 75000.00),
	(44, 4, 32, 20000.00),
	(45, 4, 33, 20000.00),
	(46, 4, 34, 200000.00),
	(47, 4, 35, 220000.00),
	(48, 4, 97, 300000.00),
	(49, 4, 36, 375000.00),
	(50, 4, 37, 200000.00),
	(51, 4, 38, 225000.00),
	(52, 4, 39, 220000.00),
	(53, 4, 40, 300000.00),
	(54, 4, 41, 225000.00),
	(55, 4, 42, 275000.00),
	(56, 4, 98, 325000.00),
	(57, 4, 43, 425000.00),
	(58, 4, 44, 500000.00),
	(59, 4, 45, 325000.00),
	(60, 4, 99, 325000.00),
	(61, 4, 100, 425000.00),
	(62, 4, 101, 525000.00),
	(63, 4, 102, 275000.00),
	(64, 4, 46, 150000.00),
	(65, 4, 47, 200000.00),
	(66, 4, 48, 280000.00),
	(67, 4, 49, 370000.00),
	(68, 4, 50, 200000.00),
	(69, 4, 51, 250000.00),
	(70, 4, 52, 320000.00),
	(71, 4, 53, 370000.00),
	(72, 4, 54, 450000.00),
	(73, 4, 55, 550000.00),
	(74, 4, 56, 400000.00),
	(75, 4, 57, 175000.00),
	(76, 4, 58, 250000.00),
	(77, 4, 59, 650000.00),
	(78, 4, 60, 800000.00),
	(79, 4, 61, 175000.00),
	(80, 4, 62, 400000.00),
	(81, 4, 63, 500000.00),
	(82, 4, 64, 600000.00),
	(83, 4, 65, 350000.00),
	(84, 4, 66, 400000.00),
	(85, 4, 67, 500000.00),
	(86, 4, 68, 100000.00),
	(87, 4, 69, 150000.00),
	(88, 4, 70, 200000.00),
	(89, 4, 71, 125000.00),
	(90, 4, 72, 175000.00),
	(91, 4, 73, 225000.00),
	(92, 4, 74, 150000.00),
	(93, 4, 75, 250000.00),
	(94, 4, 76, 350000.00),
	(95, 4, 77, 250000.00),
	(96, 4, 78, 450000.00),
	(97, 4, 79, 850000.00),
	(98, 4, 80, 225000.00),
	(99, 4, 81, 250000.00),
	(100, 4, 82, 275000.00),
	(101, 4, 83, 275000.00),
	(102, 4, 84, 325000.00),
	(103, 4, 85, 375000.00),
	(104, 4, 86, 325000.00),
	(105, 4, 87, 375000.00),
	(106, 4, 88, 425000.00),
	(107, 4, 89, 350000.00),
	(108, 4, 90, 400000.00),
	(109, 4, 91, 450000.00),
	(110, 4, 92, 275000.00),
	(111, 4, 93, 300000.00),
	(112, 4, 94, 450000.00),
	(113, 4, 95, 550000.00),
	(114, 4, 96, 650000.00);
/*!40000 ALTER TABLE `list_harga` ENABLE KEYS */;


-- Dumping structure for table ybeauty.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ybeauty.migration: 4 rows
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1476354688),
	('m151024_072453_create_route_table', 1476516876),
	('m161013_103353_create_karyawan', 1476524607),
	('m140506_102106_rbac_init', 1476524720);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;


-- Dumping structure for view ybeauty.numbers
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `numbers` (
	`number` BIGINT(25) NOT NULL
) ENGINE=MyISAM;


-- Dumping structure for table ybeauty.omset
CREATE TABLE IF NOT EXISTS `omset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `modal` decimal(10,2) DEFAULT NULL,
  `omset_harian` decimal(10,2) DEFAULT NULL,
  `penjualan_produk` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table ybeauty.omset: ~2 rows (approximately)
/*!40000 ALTER TABLE `omset` DISABLE KEYS */;
INSERT INTO `omset` (`id`, `tanggal`, `modal`, `omset_harian`, `penjualan_produk`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
	(11, '2016-11-20', 500000.00, NULL, NULL, '2016-11-21 03:45:45', '21', '2016-11-21 03:45:45', '21'),
	(12, '2016-11-22', 500000.00, NULL, NULL, '2016-11-22 19:40:47', '21', '2016-11-22 19:40:47', '21');
/*!40000 ALTER TABLE `omset` ENABLE KEYS */;


-- Dumping structure for table ybeauty.route
CREATE TABLE IF NOT EXISTS `route` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ybeauty.route: ~153 rows (approximately)
/*!40000 ALTER TABLE `route` DISABLE KEYS */;
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/*', '*', '', 1),
	('/admin/*', '*', 'admin', 1),
	('/admin/default/*', '*', 'admin/default', 1),
	('/admin/default/index', 'index', 'admin/default', 1),
	('/debug/*', '*', 'debug', 1),
	('/debug/default/*', '*', 'debug/default', 1),
	('/debug/default/db-explain', 'db-explain', 'debug/default', 1),
	('/debug/default/download-mail', 'download-mail', 'debug/default', 1),
	('/debug/default/index', 'index', 'debug/default', 1),
	('/debug/default/toolbar', 'toolbar', 'debug/default', 1),
	('/debug/default/view', 'view', 'debug/default', 1),
	('/gii/*', '*', 'gii', 1),
	('/gii/default/*', '*', 'gii/default', 1),
	('/gii/default/action', 'action', 'gii/default', 1),
	('/gii/default/diff', 'diff', 'gii/default', 1),
	('/gii/default/index', 'index', 'gii/default', 1),
	('/gii/default/preview', 'preview', 'gii/default', 1),
	('/gii/default/view', 'view', 'gii/default', 1),
	('/gridview/*', '*', 'gridview', 1),
	('/gridview/export/*', '*', 'gridview/export', 1),
	('/gridview/export/download', 'download', 'gridview/export', 1),
	('/hrd/departement/*', '*', 'hrd/departement', 0),
	('/it/*', '*', 'it', 1),
	('/it/default/*', '*', 'it/default', 1),
	('/it/default/index', 'index', 'it/default', 1),
	('/it/request/*', '*', 'it/request', 1),
	('/it/request/create', 'create', 'it/request', 1),
	('/it/request/delete', 'delete', 'it/request', 1),
	('/it/request/index', 'index', 'it/request', 1),
	('/it/request/update', 'update', 'it/request', 1),
	('/it/request/view', 'view', 'it/request', 1),
	('/it/tipe-search/*', '*', 'it/tipe-search', 1),
	('/it/tipe-search/create', 'create', 'it/tipe-search', 1),
	('/it/tipe-search/delete', 'delete', 'it/tipe-search', 1),
	('/it/tipe-search/index', 'index', 'it/tipe-search', 1),
	('/it/tipe-search/update', 'update', 'it/tipe-search', 1),
	('/it/tipe-search/view', 'view', 'it/tipe-search', 1),
	('/kasir/*', '*', 'kasir', 1),
	('/kasir/default/*', '*', 'kasir/default', 1),
	('/kasir/default/index', 'index', 'kasir/default', 1),
	('/kasir/pos/*', '*', 'kasir/pos', 1),
	('/kasir/pos/create', 'create', 'kasir/pos', 1),
	('/kasir/pos/index', 'index', 'kasir/pos', 1),
	('/kasir/transaction/*', '*', 'kasir/transaction', 1),
	('/kasir/transaction/create', 'create', 'kasir/transaction', 1),
	('/kasir/transaction/delete', 'delete', 'kasir/transaction', 1),
	('/kasir/transaction/export-pdf', 'export-pdf', 'kasir/transaction', 1),
	('/kasir/transaction/get-karyawan', 'get-karyawan', 'kasir/transaction', 1),
	('/kasir/transaction/get-max-struk', 'get-max-struk', 'kasir/transaction', 1),
	('/kasir/transaction/get-price-item', 'get-price-item', 'kasir/transaction', 1),
	('/kasir/transaction/index', 'index', 'kasir/transaction', 1),
	('/kasir/transaction/report', 'report', 'kasir/transaction', 1),
	('/kasir/transaction/update', 'update', 'kasir/transaction', 1),
	('/kasir/transaction/view', 'view', 'kasir/transaction', 1),
	('/manager/*', '*', 'manager', 1),
	('/manager/deal-komisi/*', '*', 'manager/deal-komisi', 1),
	('/manager/deal-komisi/bulk-delete', 'bulk-delete', 'manager/deal-komisi', 1),
	('/manager/deal-komisi/create', 'create', 'manager/deal-komisi', 1),
	('/manager/deal-komisi/delete', 'delete', 'manager/deal-komisi', 1),
	('/manager/deal-komisi/get-karyawan', 'get-karyawan', 'manager/deal-komisi', 1),
	('/manager/deal-komisi/index', 'index', 'manager/deal-komisi', 1),
	('/manager/deal-komisi/update', 'update', 'manager/deal-komisi', 1),
	('/manager/deal-komisi/view', 'view', 'manager/deal-komisi', 1),
	('/manager/default/*', '*', 'manager/default', 1),
	('/manager/default/index', 'index', 'manager/default', 1),
	('/manager/item-layanan/*', '*', 'manager/item-layanan', 1),
	('/manager/item-layanan/bulk-delete', 'bulk-delete', 'manager/item-layanan', 1),
	('/manager/item-layanan/create', 'create', 'manager/item-layanan', 1),
	('/manager/item-layanan/delete', 'delete', 'manager/item-layanan', 1),
	('/manager/item-layanan/index', 'index', 'manager/item-layanan', 1),
	('/manager/item-layanan/update', 'update', 'manager/item-layanan', 1),
	('/manager/item-layanan/view', 'view', 'manager/item-layanan', 1),
	('/manager/karyawan/*', '*', 'manager/karyawan', 1),
	('/manager/karyawan/create', 'create', 'manager/karyawan', 1),
	('/manager/karyawan/delete', 'delete', 'manager/karyawan', 1),
	('/manager/karyawan/index', 'index', 'manager/karyawan', 1),
	('/manager/karyawan/update', 'update', 'manager/karyawan', 1),
	('/manager/karyawan/view', 'view', 'manager/karyawan', 1),
	('/manager/komisi-karyawan/*', '*', 'manager/komisi-karyawan', 1),
	('/manager/komisi-karyawan/export-report-to-excel', 'export-report-to-excel', 'manager/komisi-karyawan', 1),
	('/manager/komisi-karyawan/hitung-komisi', 'hitung-komisi', 'manager/komisi-karyawan', 1),
	('/manager/komisi-karyawan/index', 'index', 'manager/komisi-karyawan', 1),
	('/manager/list-harga/*', '*', 'manager/list-harga', 1),
	('/manager/list-harga/bulk-delete', 'bulk-delete', 'manager/list-harga', 1),
	('/manager/list-harga/create', 'create', 'manager/list-harga', 1),
	('/manager/list-harga/delete', 'delete', 'manager/list-harga', 1),
	('/manager/list-harga/index', 'index', 'manager/list-harga', 1),
	('/manager/list-harga/update', 'update', 'manager/list-harga', 1),
	('/manager/list-harga/view', 'view', 'manager/list-harga', 1),
	('/manager/omset-toko/*', '*', 'manager/omset-toko', 1),
	('/manager/omset-toko/export-to-pdf-detail', 'export-to-pdf-detail', 'manager/omset-toko', 1),
	('/manager/omset-toko/export-to-pdf-rekap', 'export-to-pdf-rekap', 'manager/omset-toko', 1),
	('/manager/omset-toko/hitung-omset', 'hitung-omset', 'manager/omset-toko', 1),
	('/manager/omset-toko/hitung-omset-rekap', 'hitung-omset-rekap', 'manager/omset-toko', 1),
	('/manager/omset-toko/index', 'index', 'manager/omset-toko', 1),
	('/manager/omset/*', '*', 'manager/omset', 1),
	('/manager/omset/bulk-delete', 'bulk-delete', 'manager/omset', 1),
	('/manager/omset/cek-modal-kasir', 'cek-modal-kasir', 'manager/omset', 1),
	('/manager/omset/create', 'create', 'manager/omset', 1),
	('/manager/omset/delete', 'delete', 'manager/omset', 1),
	('/manager/omset/index', 'index', 'manager/omset', 1),
	('/manager/omset/update', 'update', 'manager/omset', 1),
	('/manager/omset/view', 'view', 'manager/omset', 1),
	('/manager/tipe-karyawan/*', '*', 'manager/tipe-karyawan', 1),
	('/manager/tipe-karyawan/bulk-delete', 'bulk-delete', 'manager/tipe-karyawan', 1),
	('/manager/tipe-karyawan/create', 'create', 'manager/tipe-karyawan', 1),
	('/manager/tipe-karyawan/delete', 'delete', 'manager/tipe-karyawan', 1),
	('/manager/tipe-karyawan/index', 'index', 'manager/tipe-karyawan', 1),
	('/manager/tipe-karyawan/update', 'update', 'manager/tipe-karyawan', 1),
	('/manager/tipe-karyawan/view', 'view', 'manager/tipe-karyawan', 1),
	('/manager/tipe-layanan/*', '*', 'manager/tipe-layanan', 1),
	('/manager/tipe-layanan/bulk-delete', 'bulk-delete', 'manager/tipe-layanan', 1),
	('/manager/tipe-layanan/create', 'create', 'manager/tipe-layanan', 1),
	('/manager/tipe-layanan/delete', 'delete', 'manager/tipe-layanan', 1),
	('/manager/tipe-layanan/index', 'index', 'manager/tipe-layanan', 1),
	('/manager/tipe-layanan/update', 'update', 'manager/tipe-layanan', 1),
	('/manager/tipe-layanan/view', 'view', 'manager/tipe-layanan', 1),
	('/manager/transaction-detail/*', '*', 'manager/transaction-detail', 1),
	('/manager/transaction-detail/bulk-delete', 'bulk-delete', 'manager/transaction-detail', 1),
	('/manager/transaction-detail/create', 'create', 'manager/transaction-detail', 1),
	('/manager/transaction-detail/delete', 'delete', 'manager/transaction-detail', 1),
	('/manager/transaction-detail/index', 'index', 'manager/transaction-detail', 1),
	('/manager/transaction-detail/update', 'update', 'manager/transaction-detail', 1),
	('/manager/transaction-detail/view', 'view', 'manager/transaction-detail', 1),
	('/mimin/*', '*', 'mimin', 1),
	('/mimin/role/*', '*', 'mimin/role', 1),
	('/mimin/role/create', 'create', 'mimin/role', 1),
	('/mimin/role/delete', 'delete', 'mimin/role', 1),
	('/mimin/role/index', 'index', 'mimin/role', 1),
	('/mimin/role/permission', 'permission', 'mimin/role', 1),
	('/mimin/role/update', 'update', 'mimin/role', 1),
	('/mimin/role/view', 'view', 'mimin/role', 1),
	('/mimin/route/*', '*', 'mimin/route', 1),
	('/mimin/route/create', 'create', 'mimin/route', 1),
	('/mimin/route/delete', 'delete', 'mimin/route', 1),
	('/mimin/route/generate', 'generate', 'mimin/route', 1),
	('/mimin/route/index', 'index', 'mimin/route', 1),
	('/mimin/route/update', 'update', 'mimin/route', 1),
	('/mimin/route/view', 'view', 'mimin/route', 1),
	('/mimin/user/*', '*', 'mimin/user', 1),
	('/mimin/user/create', 'create', 'mimin/user', 1),
	('/mimin/user/delete', 'delete', 'mimin/user', 1),
	('/mimin/user/index', 'index', 'mimin/user', 1),
	('/mimin/user/update', 'update', 'mimin/user', 1),
	('/mimin/user/view', 'view', 'mimin/user', 1),
	('/site/*', '*', 'site', 1),
	('/site/about', 'about', 'site', 1),
	('/site/captcha', 'captcha', 'site', 1),
	('/site/contact', 'contact', 'site', 1),
	('/site/error', 'error', 'site', 1),
	('/site/index', 'index', 'site', 1),
	('/site/login', 'login', 'site', 1),
	('/site/logout', 'logout', 'site', 1);
/*!40000 ALTER TABLE `route` ENABLE KEYS */;


-- Dumping structure for table ybeauty.tipe_karyawan
CREATE TABLE IF NOT EXISTS `tipe_karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tipe` varchar(50) NOT NULL DEFAULT '0',
  `level` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table ybeauty.tipe_karyawan: ~4 rows (approximately)
/*!40000 ALTER TABLE `tipe_karyawan` DISABLE KEYS */;
INSERT INTO `tipe_karyawan` (`id`, `nama_tipe`, `level`) VALUES
	(1, 'Stylish', '1'),
	(2, 'Stylish', '2'),
	(3, 'Stylish', '3'),
	(4, 'Therapist', '0');
/*!40000 ALTER TABLE `tipe_karyawan` ENABLE KEYS */;


-- Dumping structure for table ybeauty.tipe_layanan
CREATE TABLE IF NOT EXISTS `tipe_layanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tipe` varchar(225) DEFAULT NULL,
  `alias` char(50) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tipe_layanan_parent_type_karyawan_layanan` (`parent_id`),
  CONSTRAINT `FK_tipe_layanan_parent_type_karyawan_layanan` FOREIGN KEY (`parent_id`) REFERENCES `tipe_karyawan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Dumping data for table ybeauty.tipe_layanan: ~31 rows (approximately)
/*!40000 ALTER TABLE `tipe_layanan` DISABLE KEYS */;
INSERT INTO `tipe_layanan` (`id`, `nama_tipe`, `alias`, `parent_id`) VALUES
	(1, 'Gunting', 'G', NULL),
	(2, 'Blow', 'BL', NULL),
	(3, 'Creambath', 'C', NULL),
	(4, 'Hair Masker', 'HMK', NULL),
	(5, 'Hair Spa', 'SPA', NULL),
	(6, 'Ozon Therapy', 'OZ', NULL),
	(7, 'Bleacing', 'BLC', NULL),
	(8, 'Toning', 'TNG', NULL),
	(9, 'Cat', 'CAT', NULL),
	(10, 'Highlight', 'HGL', NULL),
	(11, 'Keriting', 'K', NULL),
	(12, 'Rebonding', 'RBD', NULL),
	(13, 'Smoothing', 'SMT', NULL),
	(14, 'Manicure', 'M', NULL),
	(15, 'Pedicure', 'P', NULL),
	(16, 'Kutex', 'KTK', NULL),
	(17, 'Waxing', 'WAX', NULL),
	(18, 'M.UP', 'Make Up', NULL),
	(19, 'Gunting Poni', 'G.PONI', NULL),
	(20, 'Cabut Alis', 'CA', NULL),
	(21, 'Shampoo', 'SHP', NULL),
	(22, 'Dry', 'DRY', NULL),
	(23, 'Sanggul', 'SGL', NULL),
	(24, 'Foot Reflexy', 'FR', NULL),
	(25, 'Hair Tonic', 'HT', NULL),
	(26, 'Body Massage', 'BDM', NULL),
	(27, 'Back / Hand Massage', 'BKM/HM', NULL),
	(28, 'Lulur', 'LLR', NULL),
	(29, 'Facial', 'FCL', NULL),
	(30, 'Totok Wajah', 'TTK', NULL),
	(31, 'Stylist', 'Sty', NULL);
/*!40000 ALTER TABLE `tipe_layanan` ENABLE KEYS */;


-- Dumping structure for table ybeauty.transaction
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_customer` varchar(50) NOT NULL DEFAULT '0',
  `date_transaction` datetime DEFAULT NULL,
  `struk_no` int(11) unsigned zerofill DEFAULT '00000000000',
  `ditagihkan` decimal(10,0) NOT NULL DEFAULT '0',
  `dibayarkan` decimal(10,0) NOT NULL DEFAULT '0',
  `kembalian` decimal(10,0) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

-- Dumping data for table ybeauty.transaction: ~33 rows (approximately)
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` (`id`, `nama_customer`, `date_transaction`, `struk_no`, `ditagihkan`, `dibayarkan`, `kembalian`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
	(65, 'Customer Ivan', '2016-11-15 11:36:12', 00000000001, 100000, 100000, 0, '2016-11-14 11:36:12', '2016-11-13 11:36:12', '1', '1'),
	(66, 'Customer Ivan Lagi', '2016-11-15 11:36:42', 00000000002, 90000, 100000, 10000, '2016-11-15 11:36:42', '2016-11-15 11:36:42', '1', '1'),
	(67, 'Customer Rizal', '2016-11-15 11:38:14', 00000000003, 75000, 80000, 5000, '2016-11-15 11:38:14', '2016-11-15 11:38:14', '1', '1'),
	(68, 'Sia', '2016-11-15 14:08:20', 00000000004, 400000, 400000, 0, '2016-11-15 14:08:20', '2016-11-15 14:08:20', '1', '1'),
	(69, 'Chandellier', '2016-11-15 14:09:02', 00000000005, 100000, 100000, 0, '2016-11-15 14:09:02', '2016-11-15 14:09:02', '1', '1'),
	(70, 'Awan Keyen', '2016-11-15 17:34:00', 00000000006, 100000, 100000, 0, '2016-11-15 17:34:00', '2016-11-15 17:34:00', '1', '1'),
	(71, 'Mariah', '2016-11-16 00:20:16', 00000000007, 65000, 70000, 5000, '2016-11-16 00:20:16', '2016-11-16 00:20:16', '1', '1'),
	(72, 'Spice girls', '2016-11-16 00:25:31', 00000000008, 75000, 80000, 5000, '2016-11-16 00:25:31', '2016-11-16 00:25:31', '1', '1'),
	(73, 'Chris Brown', '2016-11-16 00:26:51', 00000000009, 20000, 20000, 0, '2016-11-16 00:26:51', '2016-11-16 00:26:51', '1', '1'),
	(74, 'Pam Budi', '2016-11-16 15:03:21', 00000000010, 400000, 400000, 0, '2016-11-16 15:03:21', '2016-11-16 15:03:21', '1', '1'),
	(75, 'David Lengkong', '2016-11-16 16:26:36', 00000000011, 40000, 50000, 10000, '2016-11-16 16:26:36', '2016-11-16 16:26:36', '1', '1'),
	(76, 'qiu', '2016-11-16 20:50:40', 00000000012, 200000, 200000, 0, '2016-11-16 20:50:40', '2016-11-16 20:50:40', '1', '1'),
	(77, 'Indra Dzil', '2016-11-18 20:04:09', 00000000013, 300000, 300000, 0, '2016-11-18 20:04:09', '2016-11-22 20:28:16', '1', '1'),
	(78, 'Sukardi', '2016-11-18 20:05:36', 00000000014, 60000, 100000, 40000, '2016-11-18 20:05:36', '2016-11-18 20:05:36', '1', '1'),
	(79, 'megumi', '2016-11-19 13:33:08', 00000000015, 100000, 100000, 0, '2016-11-19 13:33:08', '2016-11-19 13:33:08', '1', '1'),
	(80, 'Megumi Matsuo', '2016-11-20 11:25:31', 00000000016, 175000, 200000, 25000, '2016-11-20 11:25:31', '2016-11-20 11:25:31', '1', '1'),
	(81, 'Indra', '2016-11-20 13:49:17', 00000000017, 20000, 50000, 30000, '2016-11-20 13:49:17', '2016-11-20 13:49:17', '1', '1'),
	(82, 'Irfan', '2016-11-20 14:58:24', 00000000018, 200000, 200000, 0, '2016-11-20 14:58:24', '2016-11-20 14:58:24', '1', '1'),
	(83, 'Larmila', '2016-11-20 18:14:56', 00000000019, 365000, 400000, 35000, '2016-11-20 18:14:56', '2016-11-20 18:14:56', '1', '1'),
	(84, 'Rebecca', '2016-11-21 01:40:39', 00000000020, 250000, 300000, 50000, '2016-11-21 01:40:39', '2016-11-21 01:40:39', '1', '1'),
	(85, 'New Pokoknya', '2016-11-21 01:46:39', 00000000021, 300000, 500000, 200000, '2016-11-21 01:46:39', '2016-11-21 01:46:39', '1', '1'),
	(86, 'New Lagi', '2016-11-21 01:48:54', 00000000022, 900000, 1000000, 100000, '2016-11-21 01:48:54', '2016-11-21 01:48:54', '1', '1'),
	(87, 'Indra Lesmana', '2016-11-21 01:52:09', 00000000023, 75000, 80000, 5000, '2016-11-21 01:52:09', '2016-11-21 01:52:09', '1', '1'),
	(88, 'ika', '2016-11-21 01:53:27', 00000000024, 220000, 250000, 30000, '2016-11-21 01:53:27', '2016-11-21 01:53:27', '1', '1'),
	(89, 'Indra', '2016-11-21 01:55:03', 00000000025, 200000, 200000, 0, '2016-11-21 01:55:03', '2016-11-21 01:55:03', '1', '1'),
	(90, 'Go home', '2016-11-21 01:56:04', 00000000026, 75000, 80000, 5000, '2016-11-21 01:56:04', '2016-11-21 01:56:04', '1', '1'),
	(91, 'Masa iya ', '2016-11-21 01:57:42', 00000000027, 325000, 325000, 0, '2016-11-21 01:57:42', '2016-11-21 01:57:42', '1', '1'),
	(92, 'Arnold', '2016-11-21 02:00:15', 00000000028, 400000, 500000, 100000, '2016-11-21 02:00:15', '2016-11-21 02:00:15', '1', '1'),
	(93, 'Love Me', '2016-11-21 03:48:00', 00000000029, 100000, 100000, 0, '2016-11-21 03:48:00', '2016-11-21 03:48:00', '21', '21'),
	(94, 'Sukardi', '2016-11-22 19:35:29', 00000000030, 175000, 200000, 25000, '2016-11-22 19:35:29', '2016-11-22 19:35:29', '21', '21'),
	(95, 'Sukardi', '2016-11-22 19:36:15', 00000000031, 200000, 200000, 0, '2016-11-22 19:36:15', '2016-11-22 19:36:15', '21', '21'),
	(96, 'DZIL', '2016-11-22 19:42:33', 00000000032, 75000, 75000, 0, '2016-11-22 19:42:33', '2016-11-22 19:49:33', '21', '1'),
	(97, 'Awan', '2016-11-22 20:06:13', 00000000033, 200000, 200000, 0, '2016-11-22 20:06:13', '2016-11-22 20:28:51', '21', '1');
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;


-- Dumping structure for table ybeauty.transaction_detail
CREATE TABLE IF NOT EXISTS `transaction_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipe_karyawan_id` int(11) NOT NULL DEFAULT '0',
  `karyawan_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `harga_jual` decimal(10,0) DEFAULT NULL,
  `jumlah_jual` int(11) DEFAULT NULL,
  `subtotal` decimal(10,0) DEFAULT NULL,
  `transaction_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_transaction_detail_karyawan` (`karyawan_id`),
  KEY `FK_transaction_detail_transaction` (`transaction_id`),
  KEY `FK_transaction_detail_list_harga` (`item_id`),
  CONSTRAINT `FK_transaction_detail_karyawan` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_transaction_detail_list_harga` FOREIGN KEY (`item_id`) REFERENCES `list_harga` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_transaction_detail_transaction` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=300 DEFAULT CHARSET=latin1;

-- Dumping data for table ybeauty.transaction_detail: ~41 rows (approximately)
/*!40000 ALTER TABLE `transaction_detail` DISABLE KEYS */;
INSERT INTO `transaction_detail` (`id`, `tipe_karyawan_id`, `karyawan_id`, `item_id`, `harga_jual`, `jumlah_jual`, `subtotal`, `transaction_id`) VALUES
	(250, 1, 1, 4, 100000, 1, 100000, 65),
	(251, 1, 1, 5, 90000, 1, 90000, 66),
	(252, 2, 2, 19, 75000, 1, 75000, 67),
	(253, 1, 1, 16, 400000, 1, 400000, 68),
	(254, 1, 1, 4, 100000, 1, 100000, 69),
	(255, 1, 1, 4, 100000, 1, 100000, 70),
	(256, 1, 1, 8, 65000, 1, 65000, 71),
	(257, 2, 2, 19, 75000, 1, 75000, 72),
	(258, 2, 2, 21, 20000, 1, 20000, 73),
	(259, 1, 1, 4, 100000, 1, 100000, 74),
	(260, 4, 21, 53, 300000, 1, 300000, 74),
	(261, 1, 1, 14, 20000, 1, 20000, 75),
	(262, 4, 1, 33, 20000, 1, 20000, 75),
	(263, 4, 1, 29, 200000, 1, 200000, 76),
	(266, 4, 1, 34, 60000, 1, 60000, 78),
	(267, 1, 1, 4, 100000, 1, 100000, 79),
	(268, 1, 1, 4, 100000, 1, 100000, 80),
	(269, 2, 2, 19, 75000, 1, 75000, 80),
	(270, 4, 2, 45, 20000, 1, 20000, 81),
	(271, 4, 21, 29, 200000, 1, 200000, 82),
	(272, 1, 1, 4, 100000, 1, 100000, 83),
	(273, 1, 1, 8, 65000, 1, 65000, 83),
	(274, 4, 1, 29, 200000, 1, 200000, 83),
	(275, 4, 1, 69, 250000, 1, 250000, 84),
	(276, 4, 1, 111, 300000, 1, 300000, 85),
	(277, 4, 1, 83, 350000, 2, 700000, 86),
	(278, 1, 1, 4, 100000, 2, 200000, 86),
	(279, 2, 2, 19, 75000, 1, 75000, 87),
	(280, 4, 2, 47, 220000, 1, 220000, 88),
	(281, 4, 1, 29, 200000, 1, 200000, 89),
	(282, 2, 2, 19, 75000, 1, 75000, 90),
	(283, 4, 1, 56, 325000, 1, 325000, 91),
	(284, 1, 1, 16, 400000, 1, 400000, 92),
	(285, 1, 1, 4, 100000, 1, 100000, 93),
	(286, 1, 1, 4, 100000, 1, 100000, 94),
	(287, 2, 2, 19, 75000, 1, 75000, 94),
	(288, 4, 21, 29, 200000, 1, 200000, 95),
	(290, 2, 2, 19, 75000, 1, 75000, 96),
	(297, 4, 1, 29, 200000, 1, 200000, 77),
	(298, 1, 1, 4, 100000, 1, 100000, 77),
	(299, 4, 1, 29, 200000, 1, 200000, 97);
/*!40000 ALTER TABLE `transaction_detail` ENABLE KEYS */;


-- Dumping structure for table ybeauty.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `AUTH_KEY` (`auth_key`),
  UNIQUE KEY `PASSWORD_HASH` (`password_hash`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table ybeauty.user: ~4 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', '\r\nzsos4LbhibTjtUlwo2whFcIg7Erf19', '$2y$13$To6cLDHMYedwOufe5EdVl.Lh5qcirLUd1OARj57SivG0Lvr2XUPQK', NULL, 'dzil@tresnamuda.co.id', 10, 1476816334, 1476816334),
	(19, 'owner', NULL, '$2y$13$tcmn1oCf5SCodbAKEvTg/OGrE8BNAU8WVQuqlzVGVDNeciTOBrBYW', NULL, 'owner@hair.co.id', 10, 1479669580, 1479672186),
	(20, 'manager', NULL, '$2y$13$3zkrnqkWIxEyTDq.aFKY3uvVun3o.AJdzVVb84ORvPKXaVLsjP98q', NULL, 'manager@hairdeeper.co.id', 10, 1479672315, 1479672356),
	(21, 'kasir1', NULL, '$2y$13$sQEHmQtyesn9lOYb1tJkVeOsJqm5mnm.20kcZovXu0PBdgV9cmPgy', NULL, 'kasir@hairdeeper.com', 10, 1479674311, 1479674311);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for view ybeauty.dates
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `dates`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dates` AS select (curdate() - interval `numbers`.`number` day) AS `date` from `numbers` union all select (curdate() + interval (`numbers`.`number` + 1) day) AS `date` from `numbers`;


-- Dumping structure for view ybeauty.digits
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `digits`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `digits` AS select 0 AS `digit` union all select 1 AS `1` union all select 2 AS `2` union all select 3 AS `3` union all select 4 AS `4` union all select 5 AS `5` union all select 6 AS `6` union all select 7 AS `7` union all select 8 AS `8` union all select 9 AS `9`;


-- Dumping structure for view ybeauty.numbers
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `numbers`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `numbers` AS select (((`ones`.`digit` + (`tens`.`digit` * 10)) + (`hundreds`.`digit` * 100)) + (`thousands`.`digit` * 1000)) AS `number` from (((`digits` `ones` join `digits` `tens`) join `digits` `hundreds`) join `digits` `thousands`);
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
