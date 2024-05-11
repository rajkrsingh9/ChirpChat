-- MySQL dump 10.13  Distrib 8.0.34, for Linux (x86_64)
--
-- Host: localhost    Database: ChirpChat
-- ------------------------------------------------------
-- Server version	8.0.34-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comments_details_id` int NOT NULL,
  `login_comments_id` int NOT NULL,
  `comments` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5F9E962AFE86A061` (`comments_details_id`),
  KEY `IDX_5F9E962AD1472936` (`login_comments_id`),
  CONSTRAINT `FK_5F9E962AD1472936` FOREIGN KEY (`login_comments_id`) REFERENCES `login` (`id`),
  CONSTRAINT `FK_5F9E962AFE86A061` FOREIGN KEY (`comments_details_id`) REFERENCES `posts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,3,1,'nice post ihi'),(2,3,3,'nice'),(4,5,3,'hii');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20230309070600','2023-03-09 12:39:43',48),('DoctrineMigrations\\Version20230309124623','2023-03-09 18:16:46',74),('DoctrineMigrations\\Version20230310112838','2023-03-10 16:59:01',35),('DoctrineMigrations\\Version20230310125743','2023-03-10 18:27:48',31),('DoctrineMigrations\\Version20230310133215','2023-03-10 19:02:20',36),('DoctrineMigrations\\Version20230311075328','2023-03-11 13:23:33',36),('DoctrineMigrations\\Version20230311075614','2023-03-11 13:26:21',173),('DoctrineMigrations\\Version20230311142019','2023-03-11 19:50:25',200),('DoctrineMigrations\\Version20230313122520','2023-03-13 17:55:29',77),('DoctrineMigrations\\Version20230313182447','2023-03-13 23:54:52',41),('DoctrineMigrations\\Version20230314053236','2023-03-14 11:02:41',31),('DoctrineMigrations\\Version20230314181105','2023-03-14 23:41:13',167),('DoctrineMigrations\\Version20230314195835','2023-03-15 01:28:47',40),('DoctrineMigrations\\Version20230314204052','2023-03-15 02:11:01',35),('DoctrineMigrations\\Version20230315065614','2023-03-15 12:26:25',166),('DoctrineMigrations\\Version20230315071946','2023-03-15 12:49:56',223),('DoctrineMigrations\\Version20230323065256','2023-03-23 12:23:04',254),('DoctrineMigrations\\Version20230327073349','2023-03-27 13:03:59',276),('DoctrineMigrations\\Version20230403110152','2023-04-03 16:32:14',417),('DoctrineMigrations\\Version20230406115409','2023-04-06 17:24:28',1183),('DoctrineMigrations\\Version20230406115757','2023-04-06 17:28:02',37);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friend_list`
--

DROP TABLE IF EXISTS `friend_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `friend_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `friends_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DEB224F8A76ED395` (`user_id`),
  KEY `IDX_DEB224F849CA8337` (`friends_id`),
  CONSTRAINT `FK_DEB224F849CA8337` FOREIGN KEY (`friends_id`) REFERENCES `login` (`id`),
  CONSTRAINT `FK_DEB224F8A76ED395` FOREIGN KEY (`user_id`) REFERENCES `login` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friend_list`
--

LOCK TABLES `friend_list` WRITE;
/*!40000 ALTER TABLE `friend_list` DISABLE KEYS */;
INSERT INTO `friend_list` VALUES (1,2,1);
/*!40000 ALTER TABLE `friend_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friend_request`
--

DROP TABLE IF EXISTS `friend_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `friend_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `from_request_id` int NOT NULL,
  `to_request_id` int NOT NULL,
  `request_status` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F284D9469DA7EA2` (`from_request_id`),
  KEY `IDX_F284D94654D5AD8` (`to_request_id`),
  CONSTRAINT `FK_F284D94654D5AD8` FOREIGN KEY (`to_request_id`) REFERENCES `login` (`id`),
  CONSTRAINT `FK_F284D9469DA7EA2` FOREIGN KEY (`from_request_id`) REFERENCES `login` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friend_request`
--

LOCK TABLES `friend_request` WRITE;
/*!40000 ALTER TABLE `friend_request` DISABLE KEYS */;
INSERT INTO `friend_request` VALUES (4,1,2,1);
/*!40000 ALTER TABLE `friend_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `like_dislike`
--

DROP TABLE IF EXISTS `like_dislike`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `like_dislike` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_del_id` int NOT NULL,
  `like_dislike_id` int NOT NULL,
  `th_up` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `th_down` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ADB6A689ABA7A42E` (`post_del_id`),
  KEY `IDX_ADB6A68952FAE844` (`like_dislike_id`),
  CONSTRAINT `FK_ADB6A68952FAE844` FOREIGN KEY (`like_dislike_id`) REFERENCES `login` (`id`),
  CONSTRAINT `FK_ADB6A689ABA7A42E` FOREIGN KEY (`post_del_id`) REFERENCES `posts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `like_dislike`
--

LOCK TABLES `like_dislike` WRITE;
/*!40000 ALTER TABLE `like_dislike` DISABLE KEYS */;
INSERT INTO `like_dislike` VALUES (1,2,1,'black','black'),(3,5,3,'black','black'),(4,3,3,'blue','black'),(5,2,3,'black','black'),(6,1,3,'blue','black');
/*!40000 ALTER TABLE `like_dislike` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `img` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `about` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'ppdd5423@gmail.com','MTIzNDU2Nzg=','Deepak','Pandey',1,'userImage/boyAvatar.png','Hii its me Deepak','Male'),(2,'ajay.mallah@innoraft.com','MTIzNDU2Nzg=','Ajay','Mallah',1,'userImage/boyAvatar.png','Hi its me AJ','Male'),(3,'deepakpandey5423@gmail.com','MTIzNDU2Nzg=','Deepak','Pandey',1,'userImage/deepakpandey5423@gmail.com','My name is Deepak Pandey','Male');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `otp`
--

DROP TABLE IF EXISTS `otp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `otp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `otp` int NOT NULL,
  `validity` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otp`
--

LOCK TABLES `otp` WRITE;
/*!40000 ALTER TABLE `otp` DISABLE KEYS */;
INSERT INTO `otp` VALUES (1,'ppdd5423@gmail.com',771692,0),(2,'ajay.mallah@innoraft.com',409637,0),(3,'deepakpandey5423@gmail.com',595624,0);
/*!40000 ALTER TABLE `otp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `details_id` int NOT NULL,
  `post_details` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `thums_up` int DEFAULT NULL,
  `thums_down` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_885DBAFABB1A0722` (`details_id`),
  CONSTRAINT `FK_885DBAFABB1A0722` FOREIGN KEY (`details_id`) REFERENCES `login` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,2,'jay',1,0),(2,2,'qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq',1,0),(3,1,'hii its me deepak hello',1,0),(5,3,'My name is deepak',0,0),(19,1,'hi',0,0),(21,1,'1',0,0),(22,1,'1234',0,0),(23,1,'1234',0,0),(24,1,'1234',0,0),(25,1,'1234',0,0),(26,1,'123',0,0);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hii` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `hello` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-08 23:37:18
