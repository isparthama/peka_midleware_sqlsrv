/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.5-10.4.8-MariaDB : Database - monitoring_network
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `list_of_ip` */

CREATE TABLE `list_of_ip` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(100) DEFAULT NULL,
  `ip_location` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `list_of_ip` */

insert  into `list_of_ip`(`id`,`ip_address`,`ip_location`) values (1,'178.1.1.209','MB');
insert  into `list_of_ip`(`id`,`ip_address`,`ip_location`) values (2,'10.11.3.200','CDF');

/*Table structure for table `result_network` */

CREATE TABLE `result_network` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `waktu` varchar(10) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `result` text DEFAULT NULL,
  `entry_proccess` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `result_network` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
