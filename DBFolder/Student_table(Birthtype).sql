-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bts
-- ------------------------------------------------------
-- Server version	8.0.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student` (
  `idStudent` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EmailAddress` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Password` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Lastname` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Firstname` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Middlename` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Suffix` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Birthdate` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Civilstatus` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Sex` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Contactnumber` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ZipCode` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Profile_picture` longblob,
  `Citizenship` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `City` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Enroll_Status` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Role` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DateOfEnrolled` date DEFAULT NULL,
  `BirthCert` longblob,
  `BirthCertType` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Contact_person` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Contact_person_number` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Relationship` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Student_permit_number` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LTO_Client_ID` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Student_permit_img` longblob,
  `Expiration_student_permit` date DEFAULT NULL,
  `Mode_of_Payment` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` float DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `studentcol` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PDC-MOTOR` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PDC-CAR` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TDC` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TDC_Cert_approve` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PDC_Cert_approve` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idStudent`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'BOBI','qwe@gmail.com','Admin123','Bibo','Tender','Qwe','','2005-07-03','Single','Male','09999991231','Qwe','',_binary './uploads/306318233_1115824469055142_7251158913846536283_n.jpg','','Qwe','pending','Student',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'',''),(80,'Admin888','qweqwe123@gmail.com','123','Qwe','Qwe','Qwe','Qwe',NULL,NULL,NULL,NULL,NULL,NULL,_binary './uploads/JRU Virtual Background 23_24.jpg',NULL,NULL,'enrolled','Student','2023-09-04',NULL,NULL,NULL,NULL,NULL,'qweqweqwe','0',NULL,'2023-09-04','',0,0,NULL,NULL,NULL,NULL,'',''),(98,'Admin555','johnmark.guillero@my.jru.edu','Admin123','Qwe','Qwe','Qwe','Qwe','2005-06-15','Single',NULL,'09999991231','Johpet St.','1231',_binary './uploads/user_icon.png','Qwe','Pasig City','pending','Student','2023-09-02',_binary './uploads/pdf_Student/PT1 - AWS login Page.pdf',NULL,'Mark',NULL,'Mark',NULL,'0',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'',''),(99,'Mark555','crossmode75@gmail.com','Admin123','Perez','Glen William','','jr','2005-06-08','Single','MALE','09999991231','Johpet St.','1231',NULL,'Qwe','Pasig City','enrolled','Student','2023-09-22',_binary './uploads/pdf_Student/PT1 - AWS login Page.pdf',NULL,'Mark','09995612112','parent','10244878888','0',_binary './uploads/pdf_Student/PT1 - AWS login Page.pdf','2023-09-05','',7500,4000,NULL,'Motorcycle_Manual','Car_Manual','Enrolling','',''),(100,'Jophet12','hernandezjophet@gmail.com','Username_1','Qwe','Qwe','Qwe','','2005-06-19','Single','MALE','09999991231','Johpet St.','1231',_binary './uploads/emoil.png','Qwe','Pasig City','pending','Student','2023-09-30',NULL,NULL,'Mark','09995612112','spouse','qweqweqwe123','123123123123123132122222222222',_binary './uploads/pdf_Student/Goal-na-need-ma-fix-after-this-testing-and-mag-HOHOSTING-na-tayo.pdf','2023-09-26','',13000,13000,NULL,'Motorcycle_Manual','Car_Manual',NULL,'',''),(101,'Mark888','crossmode85@gmail.com','Admin123','Bonsol','Justine ','','','2005-06-08','Single','MALE','09999991231','Calzada-Tipas','4584',NULL,'Filipino','Taguig City','enrolled','Student','2023-09-26',NULL,NULL,'Micka','09995612112','parent','10244878888','0',NULL,'2023-09-05','',7500,5000,NULL,'Motorcycle_Automatic','Car_Manual','Enrolling','',''),(102,'Tine123','Tine2x@gmail.com','Admin123','Jonson','Bustine','Williams','','2005-06-08','Single','FEMALE','09999991231','Calzada-Tipas','4584',NULL,'Filipino','Taguig City','enrolled','Student','2023-09-26',NULL,NULL,'Micka','09995612112','parent','10244878888','0',NULL,'2023-09-05','',7500,2000,NULL,'Motorcycle_Automatic','Car_Automatic',NULL,'',''),(103,'pat@123','Pat123@gmail.com','Admin123','Qwe','Qwe','','','2005-06-08','Married','FEMALE','09999991231','Johpet St.','1231',NULL,'Qwe','Pasig City',NULL,'Student','2023-10-05',_binary './uploads/pdf_Student/Goal-na-need-ma-fix-after-this-testing-and-mag-HOHOSTING-na-tayo.pdf','Birth Certificate','Mark','09123213111','spouse','10244878888','0',NULL,'2023-09-05','',9500,4500,NULL,NULL,NULL,'Enrolling','','');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'bts'
--

--
-- Dumping routines for database 'bts'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-05 21:35:59
