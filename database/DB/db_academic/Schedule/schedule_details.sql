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

/*Table structure for table `schedule_details` */

DROP TABLE IF EXISTS `schedule_details`;

CREATE TABLE `schedule_details` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ScheduleID` int(11) NOT NULL,
  `ClassroomID` int(11) NOT NULL,
  `Credit` int(11) NOT NULL,
  `DayID` int(11) NOT NULL,
  `TimePerCredit` int(11) NOT NULL,
  `StartSessions` time NOT NULL,
  `EndSessions` time NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Data for the table `schedule_details` */

insert  into `schedule_details`(`ID`,`ScheduleID`,`ClassroomID`,`Credit`,`DayID`,`TimePerCredit`,`StartSessions`,`EndSessions`) values 
(1,1,1,2,1,50,'08:00:00','09:40:00'),
(2,2,1,3,1,50,'09:45:00','12:15:00'),
(3,3,1,3,3,50,'08:00:00','10:30:00'),
(4,4,4,2,1,50,'08:00:00','09:40:00'),
(5,4,4,2,2,50,'08:00:00','09:40:00'),
(6,4,4,2,5,50,'08:00:00','09:40:00'),
(9,7,3,2,1,50,'09:45:00','11:25:00'),
(24,12,2,3,3,50,'14:00:00','16:30:00'),
(26,12,1,2,4,50,'09:20:00','11:00:00'),
(27,10,1,2,1,50,'13:05:00','14:45:00'),
(28,12,1,3,5,50,'09:00:00','11:30:00'),
(29,10,1,2,3,50,'12:00:00','13:40:00'),
(30,13,2,2,2,50,'09:00:00','10:40:00'),
(33,15,1,2,1,50,'14:50:00','16:30:00'),
(34,15,1,2,3,50,'14:50:00','16:30:00'),
(35,16,1,2,5,50,'07:15:00','08:55:00'),
(36,17,1,4,2,50,'09:00:00','12:20:00'),
(37,18,2,6,1,50,'09:00:00','14:00:00'),
(38,19,1,3,4,50,'13:00:00','15:30:00'),
(39,19,1,3,5,50,'13:00:00','15:30:00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
