-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: adgainer_db_secures
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `repo_yss_accounts`
--

DROP TABLE IF EXISTS `repo_yss_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repo_yss_accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `accountid` bigint(20) unsigned DEFAULT NULL COMMENT 'アカウントID',
  `account_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ADgainerシステムのアカウントID',
  `accountName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'アカウント名',
  `accountType` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '料金の支払い方法 https://github.com/yahoojp-marketing/sponsored-search-api-documents/blob/master/docs/ja/api_reference/data/AccountType.md',
  `accountStatus` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'アカウントの契約状況 https://github.com/yahoojp-marketing/sponsored-search-api-documents/blob/master/docs/ja/api_reference/data/AccountStatus.md',
  `deliveryStatus` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '広告の配信状況 https://github.com/yahoojp-marketing/sponsored-search-api-documents/blob/master/docs/ja\n                        /api_reference/data/DeliveryStatus.md',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '作成日時',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  KEY `repo_yss_accounts_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repo_yss_accounts`
--

LOCK TABLES `repo_yss_accounts` WRITE;
/*!40000 ALTER TABLE `repo_yss_accounts` DISABLE KEYS */;
INSERT INTO `repo_yss_accounts` VALUES (1,650,'1','olbZQGLxK2','lK4OGGZgVu','enabled','enabled','2017-09-19 00:48:15','2017-09-19 00:48:15'),(2,27,'2','n4ZDkajrir','xzDOrYNlRY','enabled','enabled','2017-09-19 00:48:16','2017-09-19 00:48:16'),(3,83,'3','sTaagkkYwn','v6E5q7LLdy','enabled','enabled','2017-09-19 00:48:16','2017-09-19 00:48:16'),(4,794,'4','SAdqHlv98A','j2KwTrtqlL','enabled','enabled','2017-09-19 00:48:17','2017-09-19 00:48:17'),(5,383,'5','DgAVzE2lec','iL9pnY62n9','enabled','enabled','2017-09-19 00:48:17','2017-09-19 00:48:17');
/*!40000 ALTER TABLE `repo_yss_accounts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-19 15:22:48
