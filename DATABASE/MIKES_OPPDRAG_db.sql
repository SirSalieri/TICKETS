-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: unity_pulse
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `category` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'Title','Title content!','','2024-03-16 14:23:41','2024-03-16 14:23:41','Tests','https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.wfla.com%2Fbloom-tampa-bay%2F10-surprising-benefits-of-having-a-cat-in-your-life%2F&psig=AOvVaw3-MSbvk4TnCGYsd9K5fXEl&ust=1710684213670000&source=images&cd=vfe&opi=89978449&ved=0CBMQjRxqFwoTCMid47j5-IQ'),(2,'Title','Title content!','','2024-03-16 17:37:09','2024-03-16 17:37:09','Tests','https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.wfla.com%2Fbloom-tampa-bay%2F10-surprising-benefits-of-having-a-cat-in-your-life%2F&psig=AOvVaw3-MSbvk4TnCGYsd9K5fXEl&ust=1710684213670000&source=images&cd=vfe&opi=89978449&ved=0CBMQjRxqFwoTCMid47j5-IQ'),(3,'Title 1MIL','TRYING SOME NEW CONTENT','THe AUTHOR','2024-03-16 22:36:57','2024-03-16 22:36:57','FAILS','');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) DEFAULT 'Åpen',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (2,'6612d99c04caa','Eden','email@example.com','Jeg har problem med PCen...','Åpen','2024-04-07 17:36:28','2024-04-07 17:36:28'),(3,'6612d9b232ac8','Eden','email@example.com','Jeg har problem med PCen...','Åpen','2024-04-07 17:36:50','2024-04-07 17:36:50'),(4,'6612da16a814c','Eden','email@example.com','Jeg har problem med PCen...','Åpen','2024-04-07 17:38:30','2024-04-07 17:38:30'),(5,'6612f1e18847f','Eden','eden@gmail.com','Prøver å sjekke om saksystemet virker.','Åpen','2024-04-07 19:20:01','2024-04-07 19:20:01'),(6,'6612f20e1ac21','Eden','eden@gmail.com','Prøver å sjekke om saksystemet virker.','Under behandling','2024-04-07 19:20:46','2024-04-07 19:21:42'),(7,'6612f7644ecd0','Eden','eden@gmail.com','Prøver å sjekke om saksystemet virker.','Åpen','2024-04-07 19:43:32','2024-04-07 19:43:32'),(8,'6613ed9001dfd','Eden','example@gmail.com','Testing dette systemet!','Åpen','2024-04-08 13:13:52','2024-04-08 13:13:52'),(9,'6614e697f15d5','Mike','example@gmail.com','Test','Åpen','2024-04-09 06:56:23','2024-04-09 06:56:23');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_activity`
--

DROP TABLE IF EXISTS `user_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_user_id_idx` (`user_id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_activity`
--

LOCK TABLES `user_activity` WRITE;
/*!40000 ALTER TABLE `user_activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'FirstAdmin','Tester','FirstAdmin','email@example.com','$2y$10$JBWoMU3UJlzwgfkmyeI5..VDR.B369JzXFe2H2IMnlsh/p7yaEqee','user'),(6,'Eden privicaKo','','','eden@gmail.com','$2y$10$DjEGmGVgPBxZTwMcyNFKK.61f5zzB2ZSOqverZn2Cf46W10tV3OVK','admin'),(7,'Main_administrator31','Admin','Main_administrator31','admin@icloud.com','$2y$10$RnIOnnmjBg9miw5MIwweOuY8p88jE8eaLZaj/1.xWhtVyBupuIL06','admin'),(9,'Anthony Boi','','','anthony@gmail.com','$2y$10$iRkLJ4YTB5es3SgHilmJHeLAxGdg2x1qLucibeeeQPoKnVs6dEF9m','user'),(10,'Test ','USER1','Brukernavn1','email11@gmail.com','$2y$10$7aRaoVGFRALmYG203dKBLOWixl0WOZG5Rp0zNUBcfJsW5ntmBwi9W','user'),(11,'Test','USER2','Brukernavn22','user22@gmail.com','$2y$10$2TMLp9IAvoF38yCZBD83.eEH3a9buukclbVgEaMAGa3NL..W232dy','user'),(12,'Test','USER3','Brukernavn33','user33@gmail.com','$2y$10$A8i37dUlovF6nLMJsoi.Kuvw9yi/bdfdONOg4ypafqj5mZWts.F8G','user'),(13,'Test','USER4','Brukernavn44','user4@gmail.com','$2y$10$YMid4keZKfwC4fnmv78Zx.zjkziLjLDxXzNKtTquo4OswNIUYn36m','user'),(14,'Test','USER5','Brukernavn55','user5@gmail.com','$2y$10$/wnri02bo/FycAhRbI9Ol.jl/8TCt4kffbfMUkGV806UlJFTnfr8G','user'),(16,'Admin','Bruker111','Administrator1111111111111','admin222@gmail.com','$2y$10$GwsMBBkfIIQHlPMCvwi.I.ZtKP5LSPkbzrc2yiTTS7SR1BN.wACHm','admin'),(17,'Admin','Bruker222','Administrator2222222222','admin333@gmail.com','$2y$10$sb5iR3A/uUNG4d7EkbtiUuu9an/.snHRwB5Xd.Hzw9itcn714ngQu','admin'),(18,'Admin','Bruker333','Administrator33333333','admin444@gmail.com','$2y$10$QSwpXM7DqiDyhWRc6chEhOfbOHFbdZTz3s60LDq0rsMXa2OYF/.IC','admin'),(19,'Jeg har Registrert','','','registrert.person@gmail.com','$2y$10$AGO0BNRwHsFvpffCMF/5tuoU2OQFdShyxJy4G6UhMFFywMyCox89m','user');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-11  0:36:42
