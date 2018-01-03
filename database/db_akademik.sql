/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 10.1.25-MariaDB : Database - db_akademik
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_akademik` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_akademik`;

/*Table structure for table `curriculum` */

DROP TABLE IF EXISTS `curriculum`;

CREATE TABLE `curriculum` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Year` int(11) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `CreateAt` datetime DEFAULT NULL,
  `CreateBy` varchar(45) DEFAULT NULL,
  `UpdateAt` datetime DEFAULT NULL,
  `UpdateBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `curriculum` */

insert  into `curriculum`(`ID`,`Year`,`Name`,`CreateAt`,`CreateBy`,`UpdateAt`,`UpdateBy`) values 
(1,2014,'Kurikulum 2014',NULL,NULL,'2016-10-01 14:00:13','2017090'),
(2,2015,'Kurikulum 2015',NULL,NULL,'2017-12-20 14:00:40','2016065'),
(3,2016,'Kurikulum 2016',NULL,NULL,'2017-10-11 14:00:55','1014026'),
(4,2017,'Kurikulum 2017',NULL,NULL,'2017-12-14 14:00:59','1014026');

/*Table structure for table `education_level` */

DROP TABLE IF EXISTS `education_level`;

CREATE TABLE `education_level` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EducationLevelID` varchar(2) DEFAULT NULL,
  `Name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `education_level` */

insert  into `education_level`(`ID`,`EducationLevelID`,`Name`) values 
(1,'C','S1'),
(2,'B','S2'),
(3,'A','S3'),
(4,'E','D3'),
(5,'D','D4');

/*Table structure for table `faculty` */

DROP TABLE IF EXISTS `faculty`;

CREATE TABLE `faculty` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FacultyID` int(11) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `faculty` */

insert  into `faculty`(`ID`,`FacultyID`,`Name`) values 
(1,1,'Sosial'),
(2,2,'Eksakta'),
(3,3,'Hukum'),
(4,4,'Universitas');

/*Table structure for table `grade` */

DROP TABLE IF EXISTS `grade`;

CREATE TABLE `grade` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CurriculumID` int(11) DEFAULT NULL,
  `Grade` varchar(45) DEFAULT NULL,
  `StartRange` decimal(10,0) DEFAULT NULL,
  `EndRange` decimal(10,0) DEFAULT NULL,
  `UpdateAt` datetime DEFAULT NULL,
  `UpdateBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `grade` */

insert  into `grade`(`ID`,`CurriculumID`,`Grade`,`StartRange`,`EndRange`,`UpdateAt`,`UpdateBy`) values 
(1,1,'A',100,85,'2016-10-01 14:00:13','2017090'),
(2,1,'B',84,75,'2016-10-01 14:00:13','2017090'),
(3,1,'C',74,65,'2016-10-01 14:00:13','2017090'),
(4,1,'D',64,55,'2016-10-01 14:00:13','2017090'),
(5,1,'E',54,0,'2016-10-01 14:00:13','2017090'),
(6,2,'A',100,85,'2016-10-01 14:00:13','2017090'),
(7,2,'B',84,75,'2016-10-01 14:00:13','2017090'),
(8,2,'C',74,65,'2016-10-01 14:00:13','2017090'),
(9,2,'D',64,55,'2016-10-01 14:00:13','2017090'),
(10,2,'E',54,0,'2016-10-01 14:00:13','2017090'),
(11,3,'A',100,85,'2016-10-01 14:00:13','2017090'),
(12,3,'B',84,75,'2016-10-01 14:00:13','2017090'),
(13,3,'C',74,65,'2016-10-01 14:00:13','2017090'),
(14,3,'D',64,55,'2016-10-01 14:00:13','2017090'),
(15,3,'E',54,0,'2016-10-01 14:00:13','2017090'),
(16,4,'A',100,85,'2016-10-01 14:00:13','2017090'),
(17,4,'B',84,75,'2016-10-01 14:00:13','2017090'),
(18,4,'C',74,65,'2016-10-01 14:00:13','2017090'),
(19,4,'D',64,55,'2016-10-01 14:00:13','2017090'),
(20,4,'E',54,0,'2016-10-01 14:00:13','2017090');

/*Table structure for table `program_study` */

DROP TABLE IF EXISTS `program_study`;

CREATE TABLE `program_study` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EducationLevelID` int(11) DEFAULT NULL,
  `FacultyID` int(11) DEFAULT NULL,
  `KaprodiID` varchar(20) DEFAULT NULL,
  `DiktiID` varchar(20) DEFAULT NULL,
  `Code` varchar(45) DEFAULT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `NameEng` varchar(200) DEFAULT NULL,
  `Akreditasi` varchar(45) DEFAULT NULL,
  `AkreditasiDate` date DEFAULT NULL,
  `NoSK` varchar(45) DEFAULT NULL,
  `SKDate` date DEFAULT NULL,
  `TotalSKS` int(11) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `NoAkreditasiBANPT` varchar(20) DEFAULT NULL,
  `AkreditasiBANPTDate` date DEFAULT NULL,
  `NoSKBANPT` varchar(20) DEFAULT NULL,
  `SKBANPTDate` date DEFAULT NULL,
  `Visi` text,
  `VisiEng` text,
  `Misi` text,
  `MisiEng` text,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `program_study` */

insert  into `program_study`(`ID`,`EducationLevelID`,`FacultyID`,`KaprodiID`,`DiktiID`,`Code`,`Name`,`NameEng`,`Akreditasi`,`AkreditasiDate`,`NoSK`,`SKDate`,`TotalSKS`,`Email`,`NoAkreditasiBANPT`,`AkreditasiBANPTDate`,`NoSKBANPT`,`SKBANPTDate`,`Visi`,`VisiEng`,`Misi`,`MisiEng`,`Status`) values 
(1,1,2,'2114002','62201','ARC','Arsitektur','Architecture','','2013-09-01','271/E/O/2013','2013-07-17',149,'architecture@podomorouniv',NULL,'0000-00-00','N/A','0000-00-00','Visi \n\n\"Pada tahun 2020 Program Studi Arsitektur Universitas Agung Podomoro akan menjadi Program Studi Unggulan dalam menciptakan lingkungan binaan yang berkualitas melalui sistem pendidikan terintegrasi teori dan praktek profesi dan industri, berwawasan global dan menghasilkan lulusan berjiwa wirausaha\"',NULL,'Misi \n\n1. Menyelenggarakan pendidikan tinggi Arsitektur yang mengajarkan Arsitektur dan keterampilan merancang lingkungan binaan dan lintas disiplin secara terintegrasi dengan pengalaman praktek profesi dan industri.\n2. Menyelenggarakan kegiatan penelitian dan pengabdian masyarakat yang berwawasan Global sebagai wujud tanggung jawab sosial program studi.\n3. Membangun kebanggaan dan keunggulan program studi melalui kerjasama pengajaran, penelitian dan pengabdian masyarakat melalui jejaring internal maupun eksternal, berskala regional maupun internasional.\n4. Menyelenggarakan pengendalian mutu proses pembelajaran dan penyediaan sarana/prasarana yang lengkap dengan aksesyang mudah bagi setiap mhasiswanya.\n5. Menghasilkan lulusan yang memiliki kompetensi dalam ilmu arsitektur, keterampilan merancang, bertanggung jawab, serta berjiwa wirausaha dan berwawasan Global.',NULL,NULL),
(2,5,2,'2215017','22302','MRK','Manajemen Rekayasa dan Konstruksi','Construction Engineering and Management','','2014-09-01','271/E/0/2013','2013-07-17',150,'',NULL,'0000-00-00','','0000-00-00','Visi Program Studi D4 Manajemen dan Rekayasa Konstruksi adalah:\n\nMenjadi program studi yang menghasilkan pemimpin masa depan di bidang manajemen konstruksi yang diakui secara nasional dan internasional dengan mengusung nilai inovatif dan kewirausahaan.\n',NULL,'Misi yang dijalankan oleh Program Studi D4 Manajemen dan Rekayasa Konstruksi adalah:\n\n1.	Menyelenggarakan pendidikan Manajemen dan Rekayasa Konstruksi yang \n        menghasilkan lulusan dengan pengetahuan dan keterampilan teknik, manajerial dan \n        bisnis untuk menghadapi tantangan masa kini dan mendatang di tingkat nasional \n        maupun internasional.\n2.	Melakukan kegiatan pendidikan multi disiplin, penelitian kreatif dan pengabdian \n        masyarakat untuk meningkatkan nilai kehidupan secara berkelanjutan melalui \n        pemberdayaan dosen dan mahasiswa.\n3.	Menerapkan suasana belajar mengajar yang kondusif untuk mendorong terciptanya \n        sivitas akademika yang memiliki standar profesionalisme tinggi; komitmen pada \n        kualitas; perilaku etis serta keinginan belajar sepanjang hayat.\n ',NULL,NULL),
(3,1,1,'1116066','94201','ENT','Kewirausahaan','Entrepreneurship','','2014-09-01','271/E/0/2013','2013-07-17',144,'entrepreneurship@podomoro',NULL,'0000-00-00','','0000-00-00','Visi \n\nMenjadi Program Studi berbasis experiental learning yang mencetak lulusan berjiwa kewirausahaan, yang mampu menciptakan nilai (value creation) bagi masyarakat dan individu, berpikir analitis, serta mampu berkompetisi dan memimpin pada ajang nasional dan global.',NULL,'Misi \n\na. Mengembangkan pendidikan kewirausahaan berbasis experiental learning yang membangun pengetahuan, keterampilan dan karakter kewirausahaan.\nb. Berkontribusi dalam penelitian, pengembangan dan desimenasi ilmu kewirausahaan, serta mengembangkan inovasi yang bermanfaat bagi dunia kewirausahaan.\nc. Berkontribusi dalam menyelesaikan masalah sosial masyarakat indonesia melalui kegiatan yang berorientasi pada kewirausahaan.',NULL,NULL),
(4,1,1,'1217099','62201','ACC','Akuntansi','Accounting','','2014-09-01','271/E/0/2013','2013-07-17',0,'accounting@podomorouniver',NULL,'0000-00-00','','0000-00-00','Visi Program Studi Akuntansi\n\nMenghasilkan sarjana akuntansi yang handal, sanggup bersaing secara global dan memiliki jiwa kewirausahaan pada tahun 2018.',NULL,'Misi Program Studi Akuntansi\n\n1.	Meningkatkan pendidikan akuntansi berstandar internasional melalui pendekatan pendidikan lintas disiplin, komprehensif dan diperkuat fondasinya dengan pendidikan “LIBERAL ARTS”.\n2.	Mendidik para mahasiswa agar memiliki jiwa entrepreneur, mampu menerapkan keahliannya dalam berbagai bidang usaha dan organisasi dan berdaya saing global.\n3.	Menerapkan metode pendidikan yang interaktif.\n4.	Mendidik mahasiswa agar mampu berkomunikasi, berpikir kritis, beretika dan mampu mengambil keputusan.\n5.	Meningkatkan kualitas penelitian untuk pengembangan ilmu dan teknologi pada bidang akuntansi.\n6.	Mendorong kontribusi yang lebih baik bagi maasyarakat dan profesi sebagai pengabdian kepada masyarakat guna peningkatan kesejahteraan.\n',NULL,NULL),
(5,5,1,'3114016','93302','HBP','Bisnis Perhotelan','Hotel Business Program','','2014-02-04','271/E/0/','2014-02-04',0,'',NULL,'0000-00-00','','0000-00-00','Visi Program Studi Bisnis Perhotelan\n\nTerus bertumbuh menjadi Program Studi terpadu dalam mempersiapkan dan mendekatkan mahasiswa dengan pengetahuan, keterampilan, dan kemampuan mengelola bisnis perhotelan dan berkomitmen penuh untuk menghasilkan nilai optimal pada lulusan yang memiliki jiwa entrepreneurship, berbudaya Indonesia dan berkualitas Internasional.\n\nVision\nTo expand as Integrated Program which capable of develop and educate student on knowledge, skill and ability of managing hotel business and fully committed to generate optimal value on graduates who have the soul and spirit of entrepreneurship, Indonesian culture and International quality.\n',NULL,'Misi Program Studi Bisnis Perhotelan\n\nMisi Program Studi\n1. Menghasilkan Sarjana Terapan dalam bidang hospitaliti dengan orientasi pada kebutuhan dunia usaha, bisnis dan masyarakat,\n2. Mengoptimalkan kegiatan belajar mengajar untuk menghasilkan lulusan dengan jiwa entrepreneurship,\n3. Menjadi Program Studi yang mampu memberikan nilai lebih kepada mahasiswa, para dosen dan masyarakat.\n4. Berperan aktif untuk mendukung program pemerintah dalam pengembangan ilmu pengetahuan dan teknologi, serta ilmu terapan untuk kepentingan masyarakat dalam meningkatkan kualitas sumber daya manusia.\n\nMission\n1.       Develop the graduates of Applied Bachelor\'s degree (Professional Bachelor) in the field of the Hotel Business with the orientation on the needs of the industry, business and society.\n2.       Optimizing the teaching and learning activities to educate graduates with the soul of entrepreneurship. \n3.       Become a course which capable of delivering  added value to students, faculty and the community. \n4.       Play an active role to support the Government in developing science and technology as well as the application of science for the benefit of the community in improving the quality of human resources.\n',NULL,NULL),
(6,1,3,'3017098','94201','LAW','Hukum Bisnis','Business Law','','2015-04-01','','2015-04-01',144,'businesslaw@podomorounive',NULL,'0000-00-00','','0000-00-00','Visi \n\nMenjadi pusat studi hukum bisnis terbaik di Indonesia dan berkualitas internasional\n',NULL,'Misi\n1.	Menyelenggarakan pendidikan, penelitian, dan pengabdian masyarakat di bidang hukum bisnis dengan pendekatan teori dan praktik\n2.	Menghasilkan lulusan berjiwa lawyerpreneur yang berwawasan Indonesia secara khusus, serta ASEAN dan internasional secara umum yang menguasai hukum bisnis. \n3.	Membangun karakter sivitas  akademika yang profesional, kompeten, berintegritas,  berbudaya Indonesia, dan mampu bersaing menghadapi tantangan global di bidang hukum bisnis.\n4.	Memenuhi kebutuhan dan harapan Universitas dengan penerapan standar mutu pembelajaran yang mengacu pada standar internasional serta penguasaan ilmu pengetahuan dan teknologi (IPTEK).\n',NULL,NULL),
(7,1,4,'61','123',NULL,'Universitas','Universitas','','2015-07-01','','2015-07-01',144,'',NULL,'0000-00-00','','0000-00-00','',NULL,'',NULL,NULL),
(8,5,2,'2316017','123','TKB','Teknik Konstruksi Bangunan','Structural Engineering','','2015-11-02','','2015-11-02',144,'',NULL,'0000-00-00','','0000-00-00','Menjadi program studi Teknik Konstruksi Bangunan terkemuka di Indonesia \nyang juga diakui secara internasional dengan mengusung nilai inovatif dan\nkewirausahaan.',NULL,'1. Menyelenggarakan pendidikan Teknik Konstruksi Bangunan yang \nmenghasilkan lulusan dengan pengetahuan dan keterampilan teknik,\nmanajerial dan bisnis untuk menghadapi tantangan masa kini dan\nmendatang di tingkat nasional maupun internasional. \n2. Melakukan kegiatan pendidikan multi disiplin, penelitian kreatif dan\npengabdian Menyelenggarakan pendidikan Teknik Konstruksi Bangunan\nyang berkualitas untuk menghasilkan lulusan dengan pengetahuan dan\nketerampilan guna menghadapi tantangan global dan memiliki jiwa\nkewirausahaan. \n3. Menerapkan suasana belajar mengajar yang kondusif dan berkualitas\nguna mendorong terciptanya sivitas akademika yang tangguh, inovatif,\nhandal, dan profesional melalui proses pembelajaran sepanjang hayat \n4. Melaksanakan proses pendidikan, penelitian terapan, dan pengabdian\nmasyarakat yang berdaya guna bagi dunia konstruksi, bangsa dan\nsesama. \n5. Penyelenggaraan pendidikan sarjana terapan Teknik Konstruksi\nBangunan yang berfokus pada sistem konstruksi bangunan terkini\ndengan penerapan teknologi terdepan dan berkelanjutan. ',NULL,NULL),
(9,1,2,'2516037','25','PWK','Perencanaan Wilayah dan Kota','Urban Regional Planning','','2015-11-01','','2015-11-01',20,'',NULL,'0000-00-00','','0000-00-00','Menjadi program studi yang diakui secara nasional dan internasional  dengan mengusung  nilai-nilai inovatif dan kewirausahaan dalam perencanaan wilayah dan kota, khususnya di bidang real estate dan properti.\n',NULL,'1. Menyelenggarakan pendidikan sarjana perencanaan wilayah dan kota yang berbasis pada keunggulan ilmu pengetahuan dan teknologi di bidang perencanaan real estate dan properti\n2. Menyelenggarakan program pendidikan PWK yang bermutu untuk menghasilkan lulusan dengan penguasaan teori dan ilmu terapan yang tanggap terhadap tantangan lokal maupun global\n3. Menerapkan suasana belajar mengajar yang kondusif guna mendorong terciptanya sivitas akademika yang profesional, berdaya saing, bersikap etis, serta memiliki keinginan belajar sepanjang hayat\n4. Melakukan kegiatan pendidikan, penelitian, serta pengabdian kepada masyarakat yang implementatif dan bernilai guna\n',NULL,NULL),
(10,1,2,'2616007','24',NULL,'Teknik Lingkungan','Environmental Engineering','','2015-11-01','','2015-11-01',20,'',NULL,'0000-00-00','','0000-00-00','',NULL,'',NULL,NULL),
(11,1,2,'2416026','23',NULL,'Desain Produk','Desain Produk','','2015-11-01','','2015-11-01',20,'',NULL,'0000-00-00','','0000-00-00','',NULL,'',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
