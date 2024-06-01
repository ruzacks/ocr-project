/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.34 : Database - e_ktp_ocr
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`deme5438_e_ktp_ocr` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `deme5438_e_ktp_ocr`;

/*Table structure for table `ektps` */

DROP TABLE IF EXISTS `ektps`;

CREATE TABLE `ektps` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `phone` varchar(15) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `birth_place` varchar(100) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `address_rt` varchar(10) NOT NULL,
  `address_rw` varchar(10) NOT NULL,
  `address_kel_des` varchar(100) NOT NULL,
  `address_kec` varchar(100) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `married_status` varchar(50) NOT NULL,
  `job` varchar(100) NOT NULL,
  `national` varchar(50) NOT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'uploaded',
  `upload_by` varchar(10) DEFAULT NULL,
  `upload_date` datetime DEFAULT NULL,
  `reg_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_nik` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `ektps` */

insert  into `ektps`(`id`,`phone`,`nik`,`nama`,`birth_place`,`birth_date`,`gender`,`address`,`address_rt`,`address_rw`,`address_kel_des`,`address_kec`,`religion`,`married_status`,`job`,`national`,`status`,`upload_by`,`upload_date`,`reg_date`) values 
(10,'+6285717925893','3204462209920033','ANGGA DWI CAHYA','BANDUNG','1992-09-22','laki-laki','KMP GUNUNG PANCIR','001','006','JELEGONG','KUTAWARINGIN','ISLAM','BELUM KAWIN','BELUM / TIDAK BEKERJA','WNI','downloaded',NULL,'2024-06-01 05:55:35','2024-06-01 11:32:48'),
(14,'+6285717925893','3277020806760026','ERICK GUNARDI','BANDUNG','1986-06-08','laki-laki','JL BABAKAN BARU','001','016','SUKAPADA','CIDEUNYING KIDUL','ISLAM','KAWIN','KARYAWAN SWASTA','WNI','downloaded',NULL,'2024-06-01 05:55:35','2024-05-31 20:02:07'),
(28,'3333','3204100610780001','Jaka Septian','44','2024-05-29','laki-laki',' KOMP . BUMI ASRI JL ASRIV','007','014','MEKARRAHAYU','MARGAASIH','ISLAM','BELUM KAWIN','KARYAWAN SWASTA','WNI','downloaded',NULL,'2024-06-01 05:55:35','2024-05-31 00:35:04'),
(35,'+6285717925893','3204300610780001','JOKO WIYADI OKTORA S. M.','PALEMBANG','1978-10-06','laki-laki','KOMP . BUMI ASRI JL ASRIV BLOK , VA 24','007','014','MEKARRAHAYU','MARGAASIH','ISLAM','BELUM KAWIN','KARYAWAN SWASTA','WNI','uploaded',NULL,'2024-06-01 05:55:35','2024-05-29 22:09:02'),
(38,'+62857925893','3171234567890123','MIRA SETIAWAN','JAKARTA','1986-02-18','perempuan','JL . PASTI CEPAT A7 / 66','007','008','PEGADUNGAN','KALIDERES','ISLAM','KAWIN','PEGAWAI SWASTA','WNI','uploaded','admin','2024-06-01 16:25:30','2024-06-01 16:25:30'),
(39,'+62857925893','9217062630870005','ALDO NOVA','BANDUNG','1967-10-26','laki-laki','BUKIT PERMATA CIMA- G- NO.24','009','022','CILAME','NGAMPRAH','ISLAM','KAWIN','KARYAWAN SWASTA','WNI','uploaded','admin','2024-06-01 16:26:22','2024-06-01 16:26:22'),
(40,'5555555','3273200609860002','ALANT GARTINA','BANDUNG','1966-09-06','laki-laki','JL. PLERED 9 NO.36','005','011','ANTAPANI TENGAH','ANTAPAN','ISLAM','BELUM KAWIN','KARYAWAN SWASTA','WNI','uploaded','admin','2024-06-01 16:27:05','2024-06-01 16:27:05'),
(41,'+6285717925893','3273103011940002','CHAIDIR AZWIN','BANDUNG','1994-11-30','laki-laki','KOMP GBA I CLUSTER FLAMBOYAN BLOKI NO . 27 A','005','015','BOJONGSOANG','BOJONGSOANG','ISLAM','KAWIN','WIRASWASTA','WNI','uploaded','admin','2024-06-01 16:27:52','2024-06-01 16:27:52'),
(42,'+62857179255555','3204462209920002','ANGGA DWI CAHYA','BANDUNG','1992-09-22','laki-laki','KMP GUNUNG PANCIR','001','006','JELEGONG','KUTAWARINGIN','ISLAM','BELUM KAWIN','BELUM / TIDAK BEKERJA','WNI','uploaded','admin','2024-06-01 16:28:28','2024-06-01 16:28:28'),
(43,'+62857925893','3329091003780012','AMAT FAOZI','PEKALONGAN','1978-03-10','laki-laki','DUSUN KAUMAN','002','005',' KESESI',' KESESI','ISLAM','KAWIN','PEDAGANG','WNI','uploaded','admin','2024-06-01 16:30:01','2024-06-01 16:30:01'),
(44,'+62857925893','3273110102910009','RAJIV ILHAM ERLANGGA','Lahr  BANDUNG','1991-02-01','laki-laki','JL. ARUM SARI VIII NO.51','004','012','BABAKAN SARI','KIARACONDONG','ISLAM','KAWIN','KARYAWAN SWASTA','WNI','uploaded','admin','2024-06-01 16:30:31','2024-06-01 16:30:31');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'inactive',
  `role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`phone`,`address`,`status`,`role`) values 
(1,'admin','$2y$10$DYVIsJ9mWx4sC3ib/6DZzubTnfPj/.FgJ6VdBr277qEUfkFHLT4a.','082214342151','Bandung','active','adminstrator'),
(3,'jaka','$2y$10$sSz.Hvewiub40RZudOGpJuRkFbIvkh8669rGUKty1v5Ehto/9Gbvm','+62857925893','bandung','active','checker'),
(4,'jaka2','$2y$10$7dv/YKQrD8Y6m8itb7STdugNYKLIcOKbiZ1lLWr7XwGbCV3l937Ca','55555007','ssss','active','operator');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
