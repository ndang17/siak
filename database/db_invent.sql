/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 10.1.25-MariaDB : Database - invent
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`invent` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `invent`;

/*Table structure for table `af_form` */

DROP TABLE IF EXISTS `af_form`;

CREATE TABLE `af_form` (
  `id_af_form` int(11) NOT NULL AUTO_INCREMENT,
  `no_af` varchar(45) DEFAULT NULL,
  `project` varchar(45) DEFAULT NULL,
  `id_department` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `id_post_budget` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `ppn` decimal(10,2) DEFAULT NULL,
  `amount_after_tax` decimal(10,2) DEFAULT NULL,
  `note` text,
  `create_by` varchar(45) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_af_form`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `af_form` */

/*Table structure for table `af_item` */

DROP TABLE IF EXISTS `af_item`;

CREATE TABLE `af_item` (
  `id_af_item` int(11) NOT NULL AUTO_INCREMENT,
  `id_af_form` int(11) NOT NULL,
  `item` varchar(45) DEFAULT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `unit_rate` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_af_item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `af_item` */

/*Table structure for table `af_ttd` */

DROP TABLE IF EXISTS `af_ttd`;

CREATE TABLE `af_ttd` (
  `id_af_ttd` int(11) NOT NULL AUTO_INCREMENT,
  `id_af_form` int(11) NOT NULL,
  `as` varchar(45) DEFAULT NULL,
  `nik` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_af_ttd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `af_ttd` */

/*Table structure for table `data_invet` */

DROP TABLE IF EXISTS `data_invet`;

CREATE TABLE `data_invet` (
  `id_data_invet` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_invent` varchar(200) NOT NULL,
  `no_invent` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_data_invet`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `data_invet` */

insert  into `data_invet`(`id_data_invet`,`id_user_invent`,`no_invent`) values 
(1,'1','12/12/321/2017'),
(2,'1','we');

/*Table structure for table `department` */

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `id_department` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_department`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `department` */

insert  into `department`(`id_department`,`name`,`alias`,`description`) values 
(1,'Information Tegnology','IT','Information Tegnology');

/*Table structure for table `detail_budget` */

DROP TABLE IF EXISTS `detail_budget`;

CREATE TABLE `detail_budget` (
  `id_budget` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(45) DEFAULT NULL,
  `quantity` varchar(20) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  `total_amount` varchar(45) DEFAULT NULL,
  `department` varchar(45) DEFAULT NULL,
  `keperluan` varchar(100) DEFAULT NULL,
  `post_budget` varchar(45) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_budget`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

/*Data for the table `detail_budget` */

insert  into `detail_budget`(`id_budget`,`item`,`quantity`,`amount`,`date`,`total_amount`,`department`,`keperluan`,`post_budget`,`status`,`keterangan`) values 
(1,'Personal Computer ','40','8000','September 2017','320,000','MPP HRD','Terlampir','Peralatan IT','0',''),
(2,'Flash Disk 8G','1','100','September 2017','100','Keu','Backup Data / Lapor Pajak','Peralatan IT','0',''),
(3,'Komputer spesifikasi grafis','8','16000','September 2017','128,000','PDP,ARC,MKT','Terlampir','Peralatan IT','0',''),
(4,'Miximaxi 3D Mini','1','30000','September 2017','30,000','PDP','untuk ruang eksibisi Despro ','Peralatan IT','0',''),
(5,'Photoshop ','15','5000','','75,000','','','Komputer Supplies & Internet','0',''),
(6,'SPSS','5','20000','September 2017','100,000','Acc, PWK, Entreu','paket standard','Komputer Supplies & Internet','0',''),
(7,'E views','1','120000','Oktober 2017','120,000','Acc, Entreu','untuk unlimited computer license pack (4420US$)','Komputer Supplies & Internet','0',''),
(8,'Rhinocerous ','3','7000','September 2017','21,000','PDP,ARC','full bundle single user (495US$)','Komputer Supplies & Internet','2','Pembelian di budget 2016-2017'),
(9,'ArcGIS Desktop','1','300000','Oktober 2017','300,000','PWK','lab package, 30 license','Komputer Supplies & Internet','0',''),
(10,'Mesin 3D Printer','1','60000','Januari 2018','0','ARC','untuk mata kuliah desain interior dan pembuatan maket ?& untuk pengaturan jadwal beda jadi over','Peralatan IT','-1','BATAL (sdh dibeli budget 2016/2017)'),
(11,'Software Sketch Up Pro','4','11000','September 2017','0','ARC','Untuk mata kuliah Digital Arsitektur','Komputer Supplies & Internet','-1','BATAL (sdh dibeli budget 2016/2017)'),
(12,'Grasshopper','2','24000','September 2017','48,000','ARC','Untuk mata kuliah Digital Arsitektur','Komputer Supplies & Internet','2',''),
(13,'Lumion','2','11000','September 2017','22,000','ARC','Untuk mata kuliah Digital Arsitektur','Komputer Supplies & Internet','2',''),
(14,'Adobe CC for team','2','5000','September 2017','0','ARC','Untuk mata kuliah Digital Arsitektur & untuk versi lengkap yang existing','Komputer Supplies & Internet','-1','BATAL (sdh dibeli budget 2016/2017)'),
(15,'Software Fisika Bangunan','2','15000','September 2017','30,000','ARC','Untuk mata kuliah green building dan fisika bangunan','Komputer Supplies & Internet','0',''),
(16,'Software Termal','1','15000','September 2017','15,000','ARC','Untuk mata kuliah green building dan fisika bangunan','Komputer Supplies & Internet','0',''),
(17,'Printer Khusus Sertifikat','1','4000','September 2017','4,000','ARC','Untuk print kertas sertifikat untuk training dan seminar dan workshop & dan akan dipakai semua prodi','Peralatan IT','0',''),
(18,'V-ray','2','14000','September 2017','28,000','ARC','Untuk mata kuliah Digital Arsitektur','Komputer Supplies & Internet','2','Pembelian di budget 2016-2017'),
(19,'Nvivo','5','10000','September 2017','50,000','ENT','Software penelitian Kualitatif dan sentimen pasar untuk keperluan dosen','Komputer Supplies & Internet','2','Pembelian di budget 2016-2017'),
(20,'Set Arduino','2','10000','September 2017','20,000','ENT','Untuk kepentingan kegiatan Laboratorium Entrepreneurship','Peralatan IT','0',''),
(21,'PC AIO','8','10000','September 2017','80,000','ENT','Untuk melengkapi Lab Entrepreneurship (co-working space). Pengajuan dana sudah disetujui oleh bendah','Peralatan IT','1','Sudah di approval '),
(22,'Proyektor ','4','14000','September 2017','56,000','ENT, ADUM','','Peralatan IT','1','Sudah di approval '),
(23,'Printer Infuse','1','2000','September 2017','2,000','ENT','','Peralatan IT','1','Sudah di approval '),
(24,'Software Coreldraw','1','11000','September 2017','11,000','MKT','Untuk mendukung pekerjaan desain','Komputer Supplies & Internet','2','Pembelian di budget 2016-2017'),
(25,'Komputer spesifikasi standar','3','8000','September 2017','24,000','MKT','Untuk Perlengkapan Staf Promosi yang baru','Peralatan IT','1','Sudah di approval '),
(26,'Sofware jadwal perkuliahan','1','6000','Okt 2017','6,000','ADAK','Untuk jadwal kuliah','Komputer Supplies & Internet','0',''),
(27,'Barcode scanner','1','1500','Okt 2017','1,500','ADAK','sistemnya untuk folder dosen','Peralatan IT','0',''),
(28,'Accurate (software)','17','5000','November 2017','85,000','ACC','Software Program Akuntansi','Komputer Supplies & Internet','0',''),
(29,'Monsoon SIM (software)','1','30000','September 2017','30,000','ACC','ERP System','Komputer Supplies & Internet','0',''),
(30,'Printer 7612','1','4000','Januari 2018','4,000','ACC','Perluasan LAB ACC','Peralatan IT','0',''),
(31,'Opera/Oracle   ','150','70','September 2017','10,500','HBP','Penambahan 150 room (Opera Room) untuk practical','Komputer Supplies & Internet','0',''),
(32,'Configuration','0','4000','September 2017','0','HBP','Penambahan 150 room (Opera Room) untuk practical','Komputer Supplies & Internet','0',''),
(33,'','0','3.1','September 2017','0','HBP','Penambahan 150 room (Opera Room) untuk practical','Komputer Supplies & Internet','0',''),
(34,'','0','0.86','September 2017','0','HBP','Penambahan 150 room (Opera Room) untuk practical','Komputer Supplies & Internet','0',''),
(35,'Hardware','2','40000','Januari 2018','80,000','HBP','Penambahan 1 set untuk Area Kitchen & Restaurant/Bar','Komputer Supplies & Internet','0',''),
(36,'Software','1','55000','Januari 2018','55,000','HBP','Penambahan 1 set untuk Area Kitchen & Restaurant/Bar','Komputer Supplies & Internet','0',''),
(37,'Services','1','50000','Januari 2018','50,000','HBP','Penambahan 1 set untuk Area Kitchen & Restaurant/Bar','Komputer Supplies & Internet','0',''),
(38,'PC','1','8000','Januari 2018','8,000','HBP','Penambahan 1 set untuk Area Kitchen & Restaurant/Bar','Peralatan IT','0',''),
(39,'PC','1','8000','Januari 2018','8,000','HBP','Internship Office','Peralatan IT','0',''),
(40,'Printer+Scanner','1','4000','Januari 2018','4,000','HBP','Internship Office','Peralatan IT','0',''),
(41,'software Mathcad','1','9000','September 2017','9,000','TKB','','Komputer Supplies & Internet','2','Pembelian di budget 2016-2017'),
(42,'MINITAB untuk 50 seats','5','1000','September 2017','5,000','TL','','Komputer Supplies & Internet','2','Pembelian di budget 2016-2017'),
(43,'ETABS 2016 Plus (16.1.0)','15','1300','September 2017','19,500','MRK','Mata Kuliah Computer Application in Construction','Komputer Supplies & Internet','2','Pembelian di budget 2016-2017'),
(44,'STAAD Pro v8 i','15','4000','Januari 2018','60,000','MRK','Mata Kuliah Structural Calculation','Komputer Supplies & Internet','0','');

/*Table structure for table `post_budget` */

DROP TABLE IF EXISTS `post_budget`;

CREATE TABLE `post_budget` (
  `id_post_budget` int(11) NOT NULL AUTO_INCREMENT,
  `id_department` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_post_budget`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `post_budget` */

insert  into `post_budget`(`id_post_budget`,`id_department`,`name`,`amount`,`status`) values 
(1,1,'Komputer Supplies & Internet',2628000000.00,1),
(2,1,'Peralatan IT',1608600000.00,1);

/*Table structure for table `pr_form` */

DROP TABLE IF EXISTS `pr_form`;

CREATE TABLE `pr_form` (
  `id_pr_form` int(11) NOT NULL AUTO_INCREMENT,
  `no_pr` varchar(45) NOT NULL,
  `event` varchar(45) DEFAULT NULL,
  `id_department` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `ppn` decimal(10,2) DEFAULT NULL,
  `amount_after_tax` decimal(10,2) DEFAULT NULL,
  `create_by` varchar(45) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pr_form`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `pr_form` */

insert  into `pr_form`(`id_pr_form`,`no_pr`,`event`,`id_department`,`amount`,`ppn`,`amount_after_tax`,`create_by`,`create_at`,`update_at`,`status`) values 
(1,'12/PR-IT/IX/2017','Peralatan IT',1,500000.00,50000.00,550000.00,'Nandang','2017-09-27 09:47:23',NULL,0);

/*Table structure for table `pr_item` */

DROP TABLE IF EXISTS `pr_item`;

CREATE TABLE `pr_item` (
  `id_pr_item` int(11) NOT NULL AUTO_INCREMENT,
  `id_pr_form` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `specification` varchar(200) DEFAULT NULL,
  `exp_code` varchar(45) DEFAULT NULL,
  `date_needed` date DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price_estimated` decimal(10,2) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_pr_item`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `pr_item` */

insert  into `pr_item`(`id_pr_item`,`id_pr_form`,`description`,`specification`,`exp_code`,`date_needed`,`quantity`,`price_estimated`,`total_amount`) values 
(3,1,'USB','USB - USB','22','2011-11-11',1,100000.00,100000.00),
(4,1,'RJ 45','Rj 45','100','2022-02-22',100,400000.00,400000.00),
(5,1,'Mobo','ok','2','2017-10-10',1,1000000.00,1000000.00);

/*Table structure for table `pr_ttd` */

DROP TABLE IF EXISTS `pr_ttd`;

CREATE TABLE `pr_ttd` (
  `id_pr_ttd` int(11) NOT NULL AUTO_INCREMENT,
  `id_form_pr` int(11) NOT NULL,
  `as` varchar(45) DEFAULT NULL,
  `nik` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_pr_ttd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pr_ttd` */

/*Table structure for table `user_invent` */

DROP TABLE IF EXISTS `user_invent`;

CREATE TABLE `user_invent` (
  `id_user_invent` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `input_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user_invent`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `user_invent` */

insert  into `user_invent`(`id_user_invent`,`id`,`status`,`input_at`) values 
(1,'1114013 - Ardiansyah',1,'2017-10-05 05:18:36');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
