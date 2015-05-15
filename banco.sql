/*
SQLyog Enterprise v10.42 
MySQL - 5.6.17 : Database - tutorial
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tutorial` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `tutorial`;

/*Table structure for table `acesso` */

DROP TABLE IF EXISTS `acesso`;

CREATE TABLE `acesso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agente` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2FA8F705DB38439E` (`usuario_id`),
  CONSTRAINT `FK_2FA8F705DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `acesso` */

insert  into `acesso`(`id`,`usuario_id`,`ip`,`agente`,`created`,`updated`) values (1,1,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-25 01:09:15','2015-04-25 01:09:15'),(2,1,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-25 01:11:46','2015-04-25 01:11:46'),(3,1,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-25 01:12:19','2015-04-25 01:12:19'),(4,1,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-25 01:38:25','2015-04-25 01:38:25'),(5,1,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-25 01:49:41','2015-04-25 01:49:41'),(6,2,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-25 01:50:57','2015-04-25 01:50:57'),(7,1,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-25 01:51:25','2015-04-25 01:51:25'),(8,1,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-25 01:56:50','2015-04-25 01:56:50'),(9,1,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-25 02:01:59','2015-04-25 02:01:59'),(10,1,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-25 02:02:35','2015-04-25 02:02:35'),(11,1,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-25 02:06:08','2015-04-25 02:06:08'),(12,2,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-25 02:06:52','2015-04-25 02:06:52'),(13,2,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-25 03:08:58','2015-04-25 03:08:58'),(14,1,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-28 01:09:43','2015-04-28 01:09:43'),(15,2,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-28 01:20:32','2015-04-28 01:20:32'),(16,2,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-28 01:45:16','2015-04-28 01:45:16'),(17,2,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-28 01:45:52','2015-04-28 01:45:52'),(18,2,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-28 02:54:02','2015-04-28 02:54:02'),(19,1,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-29 22:36:15','2015-04-29 22:36:15'),(20,1,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36','2015-04-29 22:40:42','2015-04-29 22:40:42'),(21,2,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0','2015-04-29 22:48:30','2015-04-29 22:48:30');

/*Table structure for table `cliente` */

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `credito` decimal(9,2) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cliente` */

/*Table structure for table `hierarchicalrole_hierarchicalrole` */

DROP TABLE IF EXISTS `hierarchicalrole_hierarchicalrole`;

CREATE TABLE `hierarchicalrole_hierarchicalrole` (
  `hierarchicalrole_source` int(11) NOT NULL,
  `hierarchicalrole_target` int(11) NOT NULL,
  PRIMARY KEY (`hierarchicalrole_source`,`hierarchicalrole_target`),
  KEY `IDX_5707BC75CD934D59` (`hierarchicalrole_source`),
  KEY `IDX_5707BC75D4761DD6` (`hierarchicalrole_target`),
  CONSTRAINT `FK_5707BC75CD934D59` FOREIGN KEY (`hierarchicalrole_source`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_5707BC75D4761DD6` FOREIGN KEY (`hierarchicalrole_target`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `hierarchicalrole_hierarchicalrole` */

insert  into `hierarchicalrole_hierarchicalrole`(`hierarchicalrole_source`,`hierarchicalrole_target`) values (1,2),(2,3);

/*Table structure for table `hierarchicalrole_permission` */

DROP TABLE IF EXISTS `hierarchicalrole_permission`;

CREATE TABLE `hierarchicalrole_permission` (
  `hierarchicalrole_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`hierarchicalrole_id`,`permission_id`),
  KEY `IDX_8D28B77E83B93C19` (`hierarchicalrole_id`),
  KEY `IDX_8D28B77EFED90CCA` (`permission_id`),
  CONSTRAINT `FK_8D28B77E83B93C19` FOREIGN KEY (`hierarchicalrole_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_8D28B77EFED90CCA` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `hierarchicalrole_permission` */

insert  into `hierarchicalrole_permission`(`hierarchicalrole_id`,`permission_id`) values (1,1),(2,2),(4,3);

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2DEDCC6F5E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`) values (1,'admin'),(3,'listarcliente'),(2,'usuario');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B63E2EC75E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`) values (1,'admin'),(4,'teste'),(2,'usuario'),(3,'visitante');

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) DEFAULT NULL,
  `nome` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `permissao_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2265B05DDE734E51` (`cliente_id`),
  KEY `IDX_2265B05DE009E574` (`permissao_id`),
  CONSTRAINT `FK_2265B05DE009E574` FOREIGN KEY (`permissao_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_2265B05DDE734E51` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`cliente_id`,`nome`,`email`,`password`,`created`,`updated`,`permissao_id`) values (1,NULL,'weliton','weliton@weliton.com','$2y$14$kz4nB19l9VG9u4xxXKfmy.B8A.L49sU3r2HkAULxWIAHwM4asRMcu','2015-04-25 01:00:31','2015-04-25 01:00:31',1),(2,NULL,'teste','teste@teste.com','$2y$14$JwS75h5QD1/JLpbUxh8H5.LcewOENlZGpT5eNDN1LDCEMPkJc6ItW','2015-04-25 01:50:42','2015-04-29 23:32:30',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
