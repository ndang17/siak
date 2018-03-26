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

/*Table structure for table `schedule_team_teaching` */

DROP TABLE IF EXISTS `schedule_team_teaching`;

CREATE TABLE `schedule_team_teaching` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ScheduleID` int(11) NOT NULL,
  `NIP` varchar(45) NOT NULL,
  `Status` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `schedule_team_teaching` */

insert  into `schedule_team_teaching`(`ID`,`ScheduleID`,`NIP`,`Status`) values 
(1,1,'3114016','0'),
(2,1,'1114053','0'),
(3,3,'3114016','0'),
(4,3,'2214036','0'),
(5,4,'3115061','0'),
(6,4,'3114039','0'),
(7,4,'2516028','0'),
(13,0,'3114014','0'),
(14,0,'3114038','0'),
(15,0,'1114058','0'),
(18,10,'1114005','0'),
(19,10,'3114014','0'),
(22,19,'3114016','0'),
(23,19,'2114040','0'),
(24,19,'2215055','0'),
(25,12,'1214044','0'),
(26,12,'2117058','0');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
