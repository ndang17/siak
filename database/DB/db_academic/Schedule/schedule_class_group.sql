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

/*Table structure for table `schedule_class_group` */

DROP TABLE IF EXISTS `schedule_class_group`;

CREATE TABLE `schedule_class_group` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ScheduleID` int(11) NOT NULL,
  `ProgramsCampusID` int(11) NOT NULL,
  `SemesterID` int(11) NOT NULL,
  `ProdiCode` varchar(10) DEFAULT NULL,
  `Group` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `schedule_class_group` */

insert  into `schedule_class_group`(`ID`,`ScheduleID`,`ProgramsCampusID`,`SemesterID`,`ProdiCode`,`Group`) values 
(1,1,1,11,'ZO','ZO-1'),
(2,2,1,11,'ARC','ARC-1'),
(3,3,1,11,'ARC','ARC-2'),
(4,4,1,11,'ARC','ARC-3'),
(7,7,1,13,'ARC','ARC-1'),
(10,10,1,13,'CEM','CEM-1'),
(12,12,1,13,'ARC','ARC-3'),
(13,13,1,13,'ARC','ARC-4'),
(15,15,1,13,'ARC','ARC-5'),
(16,16,1,13,'ZO','ZO-1'),
(17,17,1,13,'CEM','CEM-2'),
(18,18,1,13,'ARC','ARC-5'),
(19,19,1,13,'ARC','ARC-6');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
