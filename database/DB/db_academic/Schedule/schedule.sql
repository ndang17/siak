/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 10.1.25-MariaDB : Database - db_academic
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_academic` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_academic`;

/*Table structure for table `schedule` */

DROP TABLE IF EXISTS `schedule`;

CREATE TABLE `schedule` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SemesterID` int(11) NOT NULL,
  `ProgramsCampusID` int(11) NOT NULL,
  `ProdiID` int(11) DEFAULT NULL,
  `CombinedClasses` enum('0','1') NOT NULL,
  `MKID` int(11) NOT NULL,
  `MKCode` varchar(45) NOT NULL,
  `ClassGroup` varchar(100) NOT NULL,
  `Coordinator` varchar(45) NOT NULL,
  `TeamTeaching` enum('0','1') NOT NULL,
  `SubSesi` enum('0','1') DEFAULT NULL,
  `UpdateBy` varchar(100) NOT NULL,
  `UpdateAt` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `schedule` */

insert  into `schedule`(`ID`,`SemesterID`,`ProgramsCampusID`,`ProdiID`,`CombinedClasses`,`MKID`,`MKCode`,`ClassGroup`,`Coordinator`,`TeamTeaching`,`SubSesi`,`UpdateBy`,`UpdateAt`) values 
(1,11,1,0,'1',168,'UNC0101','ZO-1','2214036','1','0','2017090','2018-03-02 09:58:26'),
(2,11,1,1,'0',175,'ARC1131','ARC-1','2214036','0','0','2017090','2018-03-05 14:26:15'),
(3,11,1,1,'0',344,'ARC1222','ARC-2','2114002','1','0','2017090','2018-03-05 15:53:38'),
(4,11,1,1,'0',343,'ARC1212','ARC-3','1114053','1','1','2017090','2018-03-06 13:13:44'),
(7,13,1,1,'0',9,'ARC1021','ARC-1','3114016','0','0','2017090','2018-03-20 12:01:50'),
(10,13,1,2,'0',16,'CEM1041','CEM-1','1114013','1','1','2017090','2018-03-12 08:17:03'),
(12,13,1,1,'0',99,'ARC0003','ARC-3','1114013','1','1','2017090','2018-03-20 13:40:36'),
(13,13,1,1,'0',55,'SOC3003','ARC-4','2114002','0','0','2017090','2018-03-20 12:01:17'),
(15,13,1,1,'0',54,'SOC3002','ARC-5','1114005','0','1','2017090','2018-03-12 15:05:35'),
(16,13,1,0,'1',168,'UNC0101','ZO-1','3116015','0','0','2017090','2018-03-12 16:43:04'),
(17,13,1,2,'0',14,'CEM1013','CEM-2','2215008','0','0','2017090','2018-03-14 15:01:14'),
(18,13,1,1,'0',347,'ARC2214','ARC-5','2415078','0','0','2017090','2018-03-19 15:52:47'),
(19,13,1,1,'0',462,'ARC4162','ARC-6','2116012','1','1','2017090','2018-03-20 09:31:52');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
