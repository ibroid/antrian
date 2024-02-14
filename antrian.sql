/*
SQLyog Ultimate v10.3 
MySQL - 5.7.40-log : Database - antrian
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`antrian` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `antrian`;

/*Table structure for table `antrian_persidangan` */

CREATE TABLE `antrian_persidangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_urutan` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '0',
  `nomor_ruang` int(11) DEFAULT NULL,
  `nama_ruang` varchar(191) DEFAULT NULL,
  `nomor_perkara` varchar(191) DEFAULT NULL,
  `pihak_satu` text,
  `pihak_dua` text,
  `tanggal_sidang` date DEFAULT NULL,
  `jadwal_sidang_id` int(11) DEFAULT NULL,
  `priority` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20851 DEFAULT CHARSET=latin1;

/*Table structure for table `dalam_persidangan` */

CREATE TABLE `dalam_persidangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_ruang` int(1) NOT NULL,
  `nomor_antrian_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20422 DEFAULT CHARSET=latin1;

/*Table structure for table `roles` */

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(64) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sipp_user_id` int(11) DEFAULT NULL,
  `identifier` varchar(16) NOT NULL,
  `salt` varchar(12) DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `avatar` varchar(24) DEFAULT NULL,
  `role_id` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
