/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 10.1.25-MariaDB : Database - db_global
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_global` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_global`;

/*Table structure for table `statusmahasiswa` */

DROP TABLE IF EXISTS `statusmahasiswa`;

CREATE TABLE `statusmahasiswa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CodeStatus` int(11) DEFAULT NULL,
  `Description` varchar(45) DEFAULT NULL,
  `CodeDikti` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `statusmahasiswa` */

insert  into `statusmahasiswa`(`ID`,`CodeStatus`,`Description`,`CodeDikti`) values 
(1,1,'LULUS','L'),
(2,2,'CUTI','C'),
(3,3,'AKTIF','A'),
(4,4,'DO','D'),
(5,5,'NON-AKTIF','E'),
(6,6,'MENGUNDURKAN DIRI','M');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
