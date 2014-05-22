-- MySQL dump 10.13  Distrib 5.1.73, for debian-linux-gnu (i486)
--
-- Host: 10.1.103.26    Database: abiturient
-- ------------------------------------------------------
-- Server version	5.5.35-0ubuntu0.12.04.2

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
-- Temporary table structure for view `TVORCHIJ_KONKURS`
--

--
-- Table structure for table `academicyears`
--

-- DROP TABLE IF EXISTS `academicyears`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `academicyears` (
  `idAcademicYear` int(11) NOT NULL AUTO_INCREMENT,
  `AcademicYearName` varchar(40) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idAcademicYear`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Навчальні роки (для договорів)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `all_bachelors`
--

--
-- Temporary table structure for view `all_counts`
--

--
-- Table structure for table `all_dates`
--

-- DROP TABLE IF EXISTS `all_dates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `all_dates` (
  `cdate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cdate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `all_specialities`
--

--
-- Table structure for table `atestatvalue`
--

-- DROP TABLE IF EXISTS `atestatvalue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `atestatvalue` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `AtestatValue` float NOT NULL,
  `ZnoValue` float NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `benefit`
--

-- DROP TABLE IF EXISTS `benefit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `benefit` (
  `idBenefit` int(11) NOT NULL,
  `BenefitName` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BenefitKey` char(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BenefitGroupID` int(11) DEFAULT NULL,
  `isPZK` tinyint(4) NOT NULL,
  `isPV` tinyint(4) NOT NULL,
  `Visible` int(11) NOT NULL,
  PRIMARY KEY (`idBenefit`),
  KEY `fk_Benefit_1` (`BenefitGroupID`),
  CONSTRAINT `fk_Benefit_1` FOREIGN KEY (`BenefitGroupID`) REFERENCES `benefitsgroups` (`idBenefitsGroups`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `benefitinfo`
--

-- DROP TABLE IF EXISTS `benefitinfo`;
/*!50001 DROP VIEW IF EXISTS `benefitinfo`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE IF NOT EXISTS `benefitinfo` (
 `idBenefit` tinyint NOT NULL,
  `BenefitName` tinyint NOT NULL,
  `BenefitKey` tinyint NOT NULL,
  `BenefitsGroupsName` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `benefitsgroups`
--

-- DROP TABLE IF EXISTS `benefitsgroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `benefitsgroups` (
  `idBenefitsGroups` int(11) NOT NULL,
  `BenefitsGroupsName` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idBenefitsGroups`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `causality`
--

-- DROP TABLE IF EXISTS `causality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `causality` (
  `idCausality` int(11) NOT NULL,
  `CausalityName` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CausalityDescription` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idCausality`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ExaminationCauses в ЄДЕБО';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cnt_bachelor_graduated_2013`
--

-- DROP TABLE IF EXISTS `cnt_bachelor_graduated_2013`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `cnt_bachelor_graduated_2013` (
  `FacultetID` int(11) NOT NULL DEFAULT '0',
  `cnt` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`FacultetID`),
  CONSTRAINT `fk_bachelor_graduated_2013` FOREIGN KEY (`FacultetID`) REFERENCES `facultets` (`idFacultet`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Количество выпускников бакалавров 2013 г.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `cnt_dnevn_budget_view`
--

--
-- Temporary table structure for view `cnt_dnevn_budgetcount_view`
--

--
-- Temporary table structure for view `cnt_dnevn_contract_view`
--

--
-- Temporary table structure for view `cnt_dnevn_contractcount_view`
--

--
-- Temporary table structure for view `cnt_dnevn_electro_view`
--

--
-- Temporary table structure for view `cnt_dnevn_originals_view`
--

--
-- Temporary table structure for view `cnt_dnevn_per_dates_view`
--

--
-- Temporary table structure for view `cnt_dnevn_pv_view`
--

--
-- Temporary table structure for view `cnt_dnevn_pzk_view`
--

--
-- Temporary table structure for view `cnt_dnevn_view`
--

--
-- Temporary table structure for view `cnt_left_per_dates_view`
--

--
-- Temporary table structure for view `cnt_medals_view`
--

--
-- Temporary table structure for view `cnt_zaoch_budget_view`
--

--
-- Temporary table structure for view `cnt_zaoch_budgetcount_view`
--

--
-- Temporary table structure for view `cnt_zaoch_contract_view`
--

--
-- Temporary table structure for view `cnt_zaoch_contractcount_view`
--

--
-- Temporary table structure for view `cnt_zaoch_electro_view`
--

--
-- Temporary table structure for view `cnt_zaoch_originals_view`
--

--
-- Temporary table structure for view `cnt_zaoch_per_dates_view`
--

--
-- Temporary table structure for view `cnt_zaoch_pv_view`
--

--
-- Temporary table structure for view `cnt_zaoch_pzk_view`
--

--
-- Temporary table structure for view `cnt_zaoch_view`
--

--
-- Table structure for table `contracts`
--

-- DROP TABLE IF EXISTS `contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `contracts` (
  `idContract` int(11) NOT NULL AUTO_INCREMENT,
  `PersonSpecialityID` int(11) NOT NULL,
  `ContractNumber` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ContractDate` date DEFAULT NULL,
  `CustomerName` text COLLATE utf8_unicode_ci,
  `CustomerDoc` text COLLATE utf8_unicode_ci,
  `CustomerAddress` text COLLATE utf8_unicode_ci,
  `CustomerPaymentDetails` text COLLATE utf8_unicode_ci,
  `PaymentDate` date DEFAULT NULL,
  `Comment` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idContract`)
) ENGINE=InnoDB AUTO_INCREMENT=2533 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contracts_type`
--

-- DROP TABLE IF EXISTS `contracts_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `contracts_type` (
  `idcontracts_type` int(100) NOT NULL AUTO_INCREMENT,
  `ContractsTypeName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idcontracts_type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='i am cancer';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `country`
--

-- DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `country` (
  `idCountry` int(11) NOT NULL AUTO_INCREMENT,
  `CountryName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iso` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Visible` int(11) NOT NULL,
  PRIMARY KEY (`idCountry`)
) ENGINE=InnoDB AUTO_INCREMENT=861 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `coursedp`
--

-- DROP TABLE IF EXISTS `coursedp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `coursedp` (
  `idCourseDP` int(11) NOT NULL,
  `CourseDPName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `guid` char(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'GUID курсов в ЕДБО',
  PRIMARY KEY (`idCourseDP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `courses`
--

-- DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `courses` (
  `idCourse` int(11) NOT NULL,
  `CourseName` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idCourse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `directories`
--

-- DROP TABLE IF EXISTS `directories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `directories` (
  `idDirecrtory` int(11) NOT NULL AUTO_INCREMENT,
  `DirectoryName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DirectoryInfo` text COLLATE utf8_unicode_ci NOT NULL,
  `DirectoryLink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Visible` tinyint(4) NOT NULL,
  `Access` int(11) NOT NULL,
  PRIMARY KEY (`idDirecrtory`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `document_subjects_view`
--

-- DROP TABLE IF EXISTS `document_subjects_view`;
/*!50001 DROP VIEW IF EXISTS `document_subjects_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE IF NOT EXISTS `document_subjects_view` (
 `idDocumentSubject` tinyint NOT NULL,
  `DocumentID` tinyint NOT NULL,
  `SubjectValue` tinyint NOT NULL,
  `DateGet` tinyint NOT NULL,
  `edboID` tinyint NOT NULL,
  `SubjectName` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `documents`
--

-- DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `documents` (
  `idDocuments` int(11) NOT NULL AUTO_INCREMENT,
  `PersonID` int(11) DEFAULT NULL,
  `TypeID` int(11) DEFAULT NULL COMMENT 'Тип документа',
  `Series` char(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Серия',
  `Numbers` char(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Номер',
  `DateGet` date DEFAULT NULL,
  `ZNOPin` int(11) DEFAULT NULL,
  `AtestatValue` float DEFAULT NULL COMMENT 'Балл аттестата',
  `Issued` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Кем выданый',
  `isCopy` tinyint(4) DEFAULT NULL COMMENT 'Является ли копией?',
  `isForeinghEntrantDocument` tinyint(4) NOT NULL,
  `isNotCheckAttestat` tinyint(4) NOT NULL,
  `PersonDocumentsAwardsTypesID` int(11) NOT NULL,
  `PersonBaseSpecealityID` int(11) DEFAULT NULL COMMENT 'Идентификатор базового образования, которому соответствует документ',
  `Modified` datetime DEFAULT NULL COMMENT 'Дата последеней модификации',
  `SysUserID` int(11) DEFAULT NULL COMMENT 'ID пользователя, внесшего последнюю модификацию',
  `edboID` int(11) DEFAULT NULL COMMENT 'Идентификатор документа в ЕДБО',
  PRIMARY KEY (`idDocuments`),
  KEY `fk_Documents_1` (`TypeID`),
  KEY `fk_documents_2` (`PersonID`),
  CONSTRAINT `fk_Documents_1` FOREIGN KEY (`TypeID`) REFERENCES `persondocumenttypes` (`idPersonDocumentTypes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_documents_2` FOREIGN KEY (`PersonID`) REFERENCES `person` (`idPerson`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33746 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER insert_documents BEFORE INSERT ON documents
FOR EACH ROW BEGIN
    SET NEW.Modified = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER update_documents BEFORE UPDATE ON documents
FOR EACH ROW BEGIN
    SET NEW.Modified = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;

--
-- Table structure for table `documentsubject`
--

-- DROP TABLE IF EXISTS `documentsubject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `documentsubject` (
  `idDocumentSubject` int(11) NOT NULL AUTO_INCREMENT,
  `DocumentID` int(11) DEFAULT NULL,
  `SubjectID` int(11) DEFAULT NULL,
  `SubjectValue` double DEFAULT NULL,
  `DateGet` date DEFAULT NULL,
  `Modified` datetime DEFAULT NULL COMMENT 'Дата последней модификации',
  `SysUserID` int(11) DEFAULT NULL COMMENT 'ID пользователя, внесшего посленюю модификацию',
  `edboID` int(11) DEFAULT NULL COMMENT 'Идентификатор предмета в ЕДБО',
  PRIMARY KEY (`idDocumentSubject`),
  KEY `fk_DocumentSubject_1` (`DocumentID`),
  KEY `fk_DocumentSubject_2` (`SubjectID`),
  CONSTRAINT `fk_DocumentSubject_1` FOREIGN KEY (`DocumentID`) REFERENCES `documents` (`idDocuments`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_DocumentSubject_2` FOREIGN KEY (`SubjectID`) REFERENCES `subjects` (`idSubjects`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18528 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER insert_documentsubject BEFORE INSERT ON documentsubject
FOR EACH ROW BEGIN
    SET NEW.Modified = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER update_documentsubject BEFORE UPDATE ON documentsubject
FOR EACH ROW BEGIN
    SET NEW.Modified = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;

--
-- Table structure for table `edbo_data`
--

-- DROP TABLE IF EXISTS `edbo_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `edbo_data` (
  `ID` int(9) NOT NULL COMMENT 'Ідентифікатор ЄДЕБО',
  `PIB` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Прізвище, ім''я, по-батькові',
  `EZ` int(2) NOT NULL DEFAULT '0' COMMENT 'Електронна заявка',
  `Status` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Статус заявки',
  `Created` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Дата/час створення заявки',
  `PersonCase` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Номер особової справи',
  `Course` int(4) DEFAULT NULL COMMENT 'Курс',
  `EduForm` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Форма навчання',
  `EduQualification` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Освітньо-кваліфікаційний рівень',
  `B` int(4) DEFAULT NULL COMMENT 'Заявка на бюджет',
  `K` int(4) DEFAULT NULL COMMENT 'Заявка на контракт',
  `RatingPoints` float DEFAULT NULL COMMENT 'Рейтингові бали (загальна сума)',
  `SpecCode` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Код напряму',
  `Direction` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Напрям',
  `SpecialCode` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Код спеціальності',
  `Speciality` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Спеціальність',
  `Specialization` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Спеціалізація',
  `StructBranch` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Структурний підрозділ',
  `Changed` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Дата/час останнього редагування заявки',
  `DetailPoints` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Деталізація балів',
  `DocType` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Тип документа',
  `DocSeria` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Серія документа',
  `DocNumber` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Номер документа',
  `DocPoint` float DEFAULT NULL COMMENT 'Середній бал документа',
  `DocDate` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Дата видачі документа',
  `Honours` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Відзнака',
  `EntranceType` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Тип вступу',
  `EntranceReason` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Причина вступу',
  `Benefit` int(2) DEFAULT NULL COMMENT 'Вступ поза конкурсом ?',
  `PriorityEntry` int(2) DEFAULT NULL COMMENT 'Першочерговий вступ ?',
  `Quota` int(2) DEFAULT NULL COMMENT 'Цільовий вступ ?',
  `Language` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Мова',
  `OI` int(2) DEFAULT NULL COMMENT 'Іноземний резидент ?',
  `Category` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Категорія іноземців',
  `Gender` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Стать',
  `Citizen` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Чи є громадянином України',
  `Country` varchar(192) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Країна абітурієнта',
  `TH` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ТН',
  `Tel` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Домашній телефон',
  `MobTel` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Мобільний телефон',
  `OD` int(2) DEFAULT NULL COMMENT 'Оригінал документа ?',
  `NeedHostel` int(2) DEFAULT NULL COMMENT 'Потребує гуртожиток ?',
  `EntranceCodes` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Коди вступу',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Дані ЄДЕБО';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `educationclass`
--

-- DROP TABLE IF EXISTS `educationclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `educationclass` (
  `idEducationClass` int(11) NOT NULL,
  `EducationClassName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idEducationClass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `educationtype`
--

-- DROP TABLE IF EXISTS `educationtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `educationtype` (
  `idEducationType` int(11) NOT NULL,
  `EducationTypeFullName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EducationTypeShortName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EducationTypeClassID` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEducationType`),
  KEY `fk_EducationType_1_idx` (`EducationTypeClassID`),
  CONSTRAINT `fk_EducationType_1` FOREIGN KEY (`EducationTypeClassID`) REFERENCES `educationclass` (`idEducationClass`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `educationtypeclass`
--

-- DROP TABLE IF EXISTS `educationtypeclass`;
/*!50001 DROP VIEW IF EXISTS `educationtypeclass`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE IF NOT EXISTS `educationtypeclass` (
 `idEducationType` tinyint NOT NULL,
  `EducationTypeFullName` tinyint NOT NULL,
  `EducationTypeShortName` tinyint NOT NULL,
  `EducationClassName` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `examinations_without_zno`
--

--
-- Table structure for table `facultets`
--

-- DROP TABLE IF EXISTS `facultets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `facultets` (
  `idFacultet` int(11) NOT NULL,
  `FacultetFullName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FacultetShortName` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FacultetKode` char(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FacultetTypeName` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idFacultet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `graduated_school`
--

--
-- Table structure for table `koatuulevel1`
--

-- DROP TABLE IF EXISTS `koatuulevel1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `koatuulevel1` (
  `idKOATUULevel1` int(11) NOT NULL,
  `KOATUULevel1Code` char(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `KOATUULevel1FullName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `KOATUULevel1Name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idKOATUULevel1`),
  KEY `name_idx` (`KOATUULevel1FullName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `koatuulevel2`
--

-- DROP TABLE IF EXISTS `koatuulevel2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `koatuulevel2` (
  `idKOATUULevel2` int(11) NOT NULL,
  `KOATUULevel2Code` char(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `KOATUULevel2FullName` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `KOATUULevel2Name` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `KOATUULevel2Type` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `KOATUULevel1ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`idKOATUULevel2`),
  KEY `name_idx` (`KOATUULevel2Name`),
  KEY `fk_KOATUULevel2_1_idx` (`KOATUULevel1ID`),
  CONSTRAINT `fk_KOATUULevel2_1` FOREIGN KEY (`KOATUULevel1ID`) REFERENCES `koatuulevel1` (`idKOATUULevel1`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `koatuulevel3`
--

-- DROP TABLE IF EXISTS `koatuulevel3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `koatuulevel3` (
  `idKOATUULevel3` int(11) NOT NULL,
  `KOATUULevel3Code` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `KOATUULevel3FullName` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `KOATUULevel3Name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `KOATUULevel3Type` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `KOATUULevel2ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`idKOATUULevel3`),
  KEY `name_idx` (`KOATUULevel3Name`),
  KEY `fk_KOATUULevel3_1_idx` (`KOATUULevel2ID`),
  CONSTRAINT `fk_KOATUULevel3_1` FOREIGN KEY (`KOATUULevel2ID`) REFERENCES `koatuulevel2` (`idKOATUULevel2`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `languages`
--

-- DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `languages` (
  `idLanguages` int(11) NOT NULL,
  `LanguagesCode` char(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LanguagesName` char(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idLanguages`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `mag_languages`
--

--
-- Temporary table structure for view `mag_languages_foreign_filology`
--

--
-- Table structure for table `olympiadsawards`
--

-- DROP TABLE IF EXISTS `olympiadsawards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `olympiadsawards` (
  `idOlimpiad` int(11) NOT NULL COMMENT 'Идентификатор олимпиады',
  `OlimpiadName` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Название олимпиады',
  `OlympiadAwardID` int(11) NOT NULL COMMENT 'Идентификатор поощрения олимпиады',
  `OlympiadAwardName` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `OlympiadAwardBonus` float NOT NULL COMMENT 'Бонус поощрения (баллы)',
  PRIMARY KEY (`OlympiadAwardID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Список призовых мест и олимпиад';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `parametersquery`
--

-- DROP TABLE IF EXISTS `parametersquery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `parametersquery` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(135) COLLATE utf8_unicode_ci NOT NULL,
  `coment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `person`
--

-- DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `person` (
  `idPerson` int(11) NOT NULL AUTO_INCREMENT,
  `Birthday` date DEFAULT NULL,
  `BirthPlace` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PersonSexID` int(11) DEFAULT NULL,
  `FirstName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddleName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `KOATUUCodeL1ID` int(11) DEFAULT NULL,
  `KOATUUCodeL2ID` int(11) DEFAULT NULL,
  `KOATUUCodeL3ID` int(11) DEFAULT NULL,
  `IsResident` tinyint(4) DEFAULT NULL,
  `PersonEducationTypeID` int(11) DEFAULT NULL,
  `StreetTypeID` int(11) DEFAULT NULL,
  `Address` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HomeNumber` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PostIndex` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SchoolID` int(11) DEFAULT NULL,
  `FirstNameR` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddleNameR` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastNameR` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LanguageID` int(11) NOT NULL,
  `CountryID` int(11) NOT NULL,
  `PhotoName` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isCampus` tinyint(4) DEFAULT NULL COMMENT '0 - нет необходимости в общежитии,\n1 - есть необходимость в общежитии.',
  `Modified` datetime DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `SysUserID` int(11) DEFAULT NULL,
  `codeU` char(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Код персоны в базе данных ЕДБО',
  `edboID` int(11) DEFAULT NULL COMMENT 'Идентификатор персоны в базе данных ЕДБО',
  `isSamaSchoolAddr` tinyint(4) NOT NULL,
  PRIMARY KEY (`idPerson`),
  KEY `fk_person_5` (`SchoolID`),
  KEY `fk_Person_1` (`PersonSexID`),
  KEY `fk_person_3` (`PersonEducationTypeID`),
  KEY `fk_person_4` (`StreetTypeID`),
  KEY `fk_Person_2` (`KOATUUCodeL3ID`),
  KEY `fk_person_6` (`KOATUUCodeL2ID`),
  KEY `fk_person_7` (`KOATUUCodeL1ID`),
  KEY `fk_person_8` (`LanguageID`),
  KEY `fk_person_9` (`SysUserID`),
  CONSTRAINT `fk_Person_1` FOREIGN KEY (`PersonSexID`) REFERENCES `personsextypes` (`idPersonSexTypes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Person_2` FOREIGN KEY (`KOATUUCodeL3ID`) REFERENCES `koatuulevel3` (`idKOATUULevel3`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_3` FOREIGN KEY (`PersonEducationTypeID`) REFERENCES `personeducationtypes` (`idPersonEducationTypes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_4` FOREIGN KEY (`StreetTypeID`) REFERENCES `streettypes` (`idStreetTypes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_5` FOREIGN KEY (`SchoolID`) REFERENCES `schools` (`idSchool`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_6` FOREIGN KEY (`KOATUUCodeL2ID`) REFERENCES `koatuulevel2` (`idKOATUULevel2`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_7` FOREIGN KEY (`KOATUUCodeL1ID`) REFERENCES `koatuulevel1` (`idKOATUULevel1`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_8` FOREIGN KEY (`LanguageID`) REFERENCES `languages` (`idLanguages`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_9` FOREIGN KEY (`SysUserID`) REFERENCES `sys_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7124 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `insert_person` BEFORE INSERT ON `person`
FOR EACH ROW BEGIN
    SET NEW.`Modified` = NOW();
    SET NEW.`CreateDate` = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `update_person` before update ON `person`
FOR EACH ROW BEGIN
    SET NEW.Modified = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;

--
-- Temporary table structure for view `person_contacts_view`
--

-- DROP TABLE IF EXISTS `person_contacts_view`;
/*!50001 DROP VIEW IF EXISTS `person_contacts_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE IF NOT EXISTS `person_contacts_view` (
 `FIO` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL,
  `RequestFromEB` tinyint NOT NULL,
  `EducationFormID` tinyint NOT NULL,
  `RequestNumber` tinyint NOT NULL,
  `isBudget` tinyint NOT NULL,
  `isContract` tinyint NOT NULL,
  `SpecName` tinyint NOT NULL,
  `Contacts` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `person_contract_speciality_view`
--

-- DROP TABLE IF EXISTS `person_contract_speciality_view`;
/*!50001 DROP VIEW IF EXISTS `person_contract_speciality_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE IF NOT EXISTS `person_contract_speciality_view` (
 `idPersonSpeciality` tinyint NOT NULL,
  `idPerson` tinyint NOT NULL,
  `FIO` tinyint NOT NULL,
  `SpecCodeName` tinyint NOT NULL,
  `EducationFormID` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `person_list`
--

--
-- Temporary table structure for view `person_speciality_view`
--

-- DROP TABLE IF EXISTS `person_speciality_view`;
/*!50001 DROP VIEW IF EXISTS `person_speciality_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE IF NOT EXISTS `person_speciality_view` (
 `idPersonSpeciality` tinyint NOT NULL,
  `CreateDate` tinyint NOT NULL,
  `idPerson` tinyint NOT NULL,
  `Birthday` tinyint NOT NULL,
  `FIO` tinyint NOT NULL,
  `isContract` tinyint NOT NULL,
  `isBudget` tinyint NOT NULL,
  `SpecCodeName` tinyint NOT NULL,
  `QualificationID` tinyint NOT NULL,
  `CourseID` tinyint NOT NULL,
  `RequestNumber` tinyint NOT NULL,
  `PersonRequestNumber` tinyint NOT NULL,
  `PersonEdboID` tinyint NOT NULL,
  `SpecEdboID` tinyint NOT NULL,
  `PersonCreateDate` tinyint NOT NULL,
  `DocumentSubject1` tinyint NOT NULL,
  `DocumentSubject1Value` tinyint NOT NULL,
  `DocumentSubject2` tinyint NOT NULL,
  `DocumentSubject2Value` tinyint NOT NULL,
  `DocumentSubject3` tinyint NOT NULL,
  `DocumentSubject3Value` tinyint NOT NULL,
  `PersonDocumentsAwardsTypesID` tinyint NOT NULL,
  `isCopyEntrantDoc` tinyint NOT NULL,
  `AtestatValue` tinyint NOT NULL,
  `DocumentTypeID` tinyint NOT NULL,
  `CoursedpID` tinyint NOT NULL,
  `OlympiadID` tinyint NOT NULL,
  `StatusID` tinyint NOT NULL,
  `RequestFromEB` tinyint NOT NULL,
  `EducationFormID` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `person_with1or2_spec`
--

--
-- Table structure for table `personbasespeciality`
--

-- DROP TABLE IF EXISTS `personbasespeciality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `personbasespeciality` (
  `idPersonBaseSpeciality` int(11) NOT NULL AUTO_INCREMENT,
  `PersonBaseSpecialityName` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Название',
  `PersonBaseSpecialityClasifierCode` char(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'код по классификации МОН',
  PRIMARY KEY (`idPersonBaseSpeciality`)
) ENGINE=InnoDB AUTO_INCREMENT=73129 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Справочник с перечнем специальностей в дипломах баклавров и ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personbenefitdocument`
--

-- DROP TABLE IF EXISTS `personbenefitdocument`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `personbenefitdocument` (
  `idPersonBenefitDocument` int(11) NOT NULL AUTO_INCREMENT,
  `PersonBenefitID` int(11) DEFAULT NULL,
  `DocumentID` int(11) DEFAULT NULL,
  `Modified` datetime DEFAULT NULL COMMENT 'Время последней модификации',
  `SysUserID` int(11) DEFAULT NULL COMMENT 'Идентификатор пользователя, внесшего последгюю модификацию',
  PRIMARY KEY (`idPersonBenefitDocument`),
  KEY `fk_PersonBenefitDocument_1` (`PersonBenefitID`),
  KEY `fk_PersonBenefitDocument_2` (`DocumentID`),
  CONSTRAINT `fk_PersonBenefitDocument_1` FOREIGN KEY (`PersonBenefitID`) REFERENCES `personbenefits` (`idPersonBenefits`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_PersonBenefitDocument_2` FOREIGN KEY (`DocumentID`) REFERENCES `documents` (`idDocuments`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER inster_personbenefitdocument BEFORE INSERT ON personbenefitdocument
FOR EACH ROW BEGIN
    SET NEW.Modified = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER update_personbenefitdocument BEFORE UPDATE ON personbenefitdocument
FOR EACH ROW BEGIN
    SET NEW.Modified = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;

--
-- Table structure for table `personbenefits`
--

-- DROP TABLE IF EXISTS `personbenefits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `personbenefits` (
  `idPersonBenefits` int(11) NOT NULL AUTO_INCREMENT,
  `PersonID` int(11) DEFAULT NULL,
  `BenefitID` int(11) DEFAULT NULL,
  `Series` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Numbers` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Issued` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  `SysUserID` int(11) DEFAULT NULL,
  `edboID` int(11) DEFAULT NULL COMMENT 'Идентификатор записи о льготе в базе ЕДБО',
  PRIMARY KEY (`idPersonBenefits`),
  KEY `fk_PersonBenefits_1` (`PersonID`),
  KEY `fk_PersonBenefits_2` (`BenefitID`),
  CONSTRAINT `fk_PersonBenefits_1` FOREIGN KEY (`PersonID`) REFERENCES `person` (`idPerson`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_PersonBenefits_2` FOREIGN KEY (`BenefitID`) REFERENCES `benefit` (`idBenefit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1190 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER insert_personbenefits BEFORE INSERT ON personbenefits
FOR EACH ROW BEGIN
    SET NEW.Modified = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER update_personbenefits BEFORE UPDATE ON personbenefits
FOR EACH ROW BEGIN
    SET NEW.Modified = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;

--
-- Table structure for table `personcontacts`
--

-- DROP TABLE IF EXISTS `personcontacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `personcontacts` (
  `idPersonContacts` int(11) NOT NULL AUTO_INCREMENT,
  `PersonID` int(11) DEFAULT NULL,
  `PersonContactTypeID` int(11) DEFAULT NULL,
  `Value` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Modified` datetime DEFAULT NULL COMMENT 'Дата последней модификации',
  `SysUserID` int(11) DEFAULT NULL COMMENT 'Пользователь, внесший последнюю модификацию',
  PRIMARY KEY (`idPersonContacts`),
  KEY `fk_PersonContacts_1` (`PersonID`),
  KEY `fk_PersonContacts_2` (`PersonContactTypeID`),
  CONSTRAINT `fk_PersonContacts_1` FOREIGN KEY (`PersonID`) REFERENCES `person` (`idPerson`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_PersonContacts_2` FOREIGN KEY (`PersonContactTypeID`) REFERENCES `personcontacttypes` (`idPersonContactType`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14245 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER insert_personcontacts BEFORE INSERT ON personcontacts
FOR EACH ROW BEGIN
    SET NEW.Modified = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER update_personcontacts BEFORE UPDATE ON personcontacts
FOR EACH ROW BEGIN
    SET NEW.Modified = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;

--
-- Table structure for table `personcontacttypes`
--

-- DROP TABLE IF EXISTS `personcontacttypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `personcontacttypes` (
  `idPersonContactType` int(11) NOT NULL,
  `PersonContactTypeName` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idPersonContactType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personcoursesdp`
--

-- DROP TABLE IF EXISTS `personcoursesdp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `personcoursesdp` (
  `idPersonCourses` int(11) NOT NULL AUTO_INCREMENT,
  `PersonID` int(11) DEFAULT NULL,
  `CourseDPID` int(11) DEFAULT NULL,
  `edboID` int(11) DEFAULT NULL COMMENT 'Идентификатор записи в едбо',
  `guid` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idPersonCourses`),
  KEY `fk_personcourses_1` (`PersonID`),
  KEY `fk_personcourses_2` (`CourseDPID`),
  CONSTRAINT `fk_personcourses_1` FOREIGN KEY (`PersonID`) REFERENCES `person` (`idPerson`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_personcourses_2` FOREIGN KEY (`CourseDPID`) REFERENCES `coursedp` (`idCourseDP`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=274 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Подготовительные курсы персоны';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `persondocumentsawardstypes`
--

-- DROP TABLE IF EXISTS `persondocumentsawardstypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `persondocumentsawardstypes` (
  `idPersonDocumentsAwardsTypes` int(11) NOT NULL AUTO_INCREMENT,
  `PersonDocumentsAwardsTypesName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idPersonDocumentsAwardsTypes`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `persondocumenttypes`
--

-- DROP TABLE IF EXISTS `persondocumenttypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `persondocumenttypes` (
  `idPersonDocumentTypes` int(11) NOT NULL,
  `PersonDocumentTypesName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IsEntrantDocument` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPersonDocumentTypes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personeducationforms`
--

-- DROP TABLE IF EXISTS `personeducationforms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `personeducationforms` (
  `idPersonEducationForm` int(11) NOT NULL COMMENT 'Идентификатор формы обучения персоны',
  `PersonEducationFormName` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Название формы обучения персоны',
  `isVisible` tinyint(4) DEFAULT NULL COMMENT 'Флаг видимости формы обучения для оператора системы',
  PRIMARY KEY (`idPersonEducationForm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Таблица хранит формы обучения персоны';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personeducationpaymenttypes`
--

-- DROP TABLE IF EXISTS `personeducationpaymenttypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `personeducationpaymenttypes` (
  `idEducationPaymentTypes` int(11) NOT NULL,
  `EducationPaymentTypesName` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idEducationPaymentTypes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personeducationtypes`
--

-- DROP TABLE IF EXISTS `personeducationtypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `personeducationtypes` (
  `idPersonEducationTypes` int(11) NOT NULL,
  `PersonEducationTypesName` char(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idPersonEducationTypes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personenterancetypes`
--

-- DROP TABLE IF EXISTS `personenterancetypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `personenterancetypes` (
  `idPersonEnteranceType` int(11) NOT NULL,
  `PersonEnteranceTypeName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idPersonEnteranceType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personolympiad`
--

-- DROP TABLE IF EXISTS `personolympiad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `personolympiad` (
  `idPersonOlympiad` int(11) NOT NULL AUTO_INCREMENT,
  `PersonID` int(11) DEFAULT NULL,
  `OlympiadAwarID` int(11) DEFAULT NULL,
  `edboID` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPersonOlympiad`),
  KEY `fk_PersonOlympiad_1` (`OlympiadAwarID`),
  KEY `fk_PersonOlympiad_2` (`PersonID`),
  CONSTRAINT `fk_PersonOlympiad_1` FOREIGN KEY (`OlympiadAwarID`) REFERENCES `olympiadsawards` (`OlympiadAwardID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PersonOlympiad_2` FOREIGN KEY (`PersonID`) REFERENCES `person` (`idPerson`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='Список олимпиад персоны';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personrequeststatustypes`
--

-- DROP TABLE IF EXISTS `personrequeststatustypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `personrequeststatustypes` (
  `idPersonRequestStatusType` int(11) NOT NULL COMMENT 'Id_PersonRequestStatusType Идентификатор заявки',
  `PersonRequestStatusCode` varchar(20) NOT NULL COMMENT 'Текстовый код статуса',
  `PersonRequestStatusTypeName` varchar(50) NOT NULL COMMENT 'Название статуса заявки',
  `PersonRequestStatusTypeDescription` varchar(100) NOT NULL COMMENT 'Описание статуса заявки',
  PRIMARY KEY (`idPersonRequestStatusType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='PersonRequestStatusTypesGet (string SessionGUID, string ActualDate, int Id_Langu';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personsextypes`
--

-- DROP TABLE IF EXISTS `personsextypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `personsextypes` (
  `idPersonSexTypes` int(11) NOT NULL,
  `PersonSexTypesName` char(12) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idPersonSexTypes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `personspec_all`
--


--
-- Temporary table structure for view `personspec_all_part1`
--

--
-- Temporary table structure for view `personspec_all_part2`
--

--
-- Temporary table structure for view `personspec_counts`
--

--
-- Temporary table structure for view `personspec_mag`
--

--
-- Temporary table structure for view `personspec_specialists`
--

--
-- Table structure for table `personspeciality`
--

-- DROP TABLE IF EXISTS `personspeciality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `personspeciality` (
  `idPersonSpeciality` int(11) NOT NULL AUTO_INCREMENT,
  `RequestNumber` int(11) NOT NULL,
  `PersonRequestNumber` int(11) NOT NULL,
  `PersonID` int(11) DEFAULT NULL,
  `SepcialityID` int(11) DEFAULT NULL,
  `PaymentTypeID` int(11) DEFAULT NULL COMMENT 'Не используется',
  `EducationFormID` int(11) DEFAULT NULL,
  `QualificationID` int(11) DEFAULT NULL,
  `EntranceTypeID` int(11) DEFAULT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `CausalityID` int(11) DEFAULT NULL,
  `EntrantDocumentID` int(11) DEFAULT NULL,
  `CoursedpID` int(11) NOT NULL,
  `OlympiadID` int(11) NOT NULL,
  `GraduatedUniversitieID` int(11) NOT NULL,
  `GraduatedSpecialitieID` int(11) NOT NULL,
  `GraduatedSpeciality` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PersonDocumentsAwardsTypesID` int(11) NOT NULL,
  `isTarget` tinyint(4) DEFAULT NULL,
  `isContract` tinyint(4) DEFAULT NULL,
  `isBudget` tinyint(4) NOT NULL,
  `isNeedHostel` tinyint(4) NOT NULL,
  `isForeinghEntrantDocument` tinyint(4) NOT NULL,
  `isNotCheckAttestat` tinyint(4) NOT NULL,
  `AdditionalBall` float DEFAULT NULL,
  `CoursedpBall` float DEFAULT NULL,
  `AdditionalBallComment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isCopyEntrantDoc` tinyint(4) DEFAULT NULL,
  `DocumentSubject1` int(11) DEFAULT NULL,
  `DocumentSubject2` int(11) DEFAULT NULL,
  `DocumentSubject3` int(11) DEFAULT NULL,
  `Exam1ID` int(11) DEFAULT NULL,
  `Exam1Ball` int(11) DEFAULT NULL,
  `Exam2ID` int(11) DEFAULT NULL,
  `Exam2Ball` int(11) DEFAULT NULL,
  `Exam3ID` int(11) DEFAULT NULL,
  `Exam3Ball` int(11) DEFAULT NULL,
  `IdPersonRequestExamination1` int(11) DEFAULT NULL COMMENT 'Идентификатор первого экзамена в ЕДБО',
  `IdPersonRequestExamination2` int(11) DEFAULT NULL COMMENT 'Идентификатор второго экзамена в ЕДБО',
  `IdPersonRequestExamination3` int(11) DEFAULT NULL COMMENT 'Идентификатор третьего экзамена в ЕДБО',
  `RequestFromEB` tinyint(4) NOT NULL COMMENT 'Електрона заявка на вступ (0/1 - ні/так)',
  `isHigherEducation` tinyint(4) NOT NULL COMMENT 'Информация о высшем образовании персоны. Возможные значения -1 – не вказано 0 -не отримую, 1 – отримую, 2 – є, 3- немає',
  `SkipDocumentValue` tinyint(4) NOT NULL COMMENT 'Флаг, указывающий что бал документа не учитывается при подсчете конкурсного бала. 1- не учитывается, 0 –учитывается.',
  `Quota1` tinyint(4) DEFAULT NULL,
  `Quota2` tinyint(11) DEFAULT NULL,
  `StatusID` int(11) NOT NULL DEFAULT '1',
  `CreateDate` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL COMMENT 'Дата последней модификации',
  `SysUserID` int(11) DEFAULT NULL COMMENT 'Идентификатор пользователя, внесшего последнюю модификацию в таблицу',
  `edboID` int(11) DEFAULT NULL COMMENT 'идентификатор записи в базе ЕДБО',
  `CustomerName` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `DocCustomer` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `AcademicSemesterID` int(11) NOT NULL,
  `CustomerAddress` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `CustomerPaymentDetails` varchar(250) CHARACTER SET utf8 NOT NULL,
  `DateOfContract` date NOT NULL,
  `PaymentDate` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idPersonSpeciality`),
  KEY `fk_PersonSepciality_1` (`PersonID`),
  KEY `fk_PersonSepciality_2` (`SepcialityID`),
  KEY `fk_PersonSepciality_3` (`PaymentTypeID`),
  KEY `fk_PersonSepciality_4` (`EducationFormID`),
  KEY `fk_PersonSepciality_5` (`QualificationID`),
  KEY `fk_PersonSepciality_6` (`EntranceTypeID`),
  KEY `fk_personsepciality_7` (`CourseID`),
  KEY `fk_personsepciality_8` (`CausalityID`),
  KEY `fk_personsepciality_9` (`DocumentSubject1`),
  KEY `fk_personsepciality_10` (`DocumentSubject2`),
  KEY `fk_personsepciality_11` (`DocumentSubject3`),
  KEY `fk_personsepciality_12` (`Exam1ID`),
  KEY `fk_personsepciality_13` (`Exam2ID`),
  KEY `fk_personsepciality_14` (`Exam3ID`),
  KEY `fk_personspeciality_15` (`StatusID`),
  CONSTRAINT `fk_PersonSepciality_1` FOREIGN KEY (`PersonID`) REFERENCES `person` (`idPerson`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_personsepciality_10` FOREIGN KEY (`DocumentSubject2`) REFERENCES `documentsubject` (`idDocumentSubject`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_personsepciality_11` FOREIGN KEY (`DocumentSubject3`) REFERENCES `documentsubject` (`idDocumentSubject`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_personsepciality_12` FOREIGN KEY (`Exam1ID`) REFERENCES `subjects` (`idSubjects`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_personsepciality_13` FOREIGN KEY (`Exam2ID`) REFERENCES `subjects` (`idSubjects`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_personsepciality_14` FOREIGN KEY (`Exam3ID`) REFERENCES `subjects` (`idSubjects`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PersonSepciality_2` FOREIGN KEY (`SepcialityID`) REFERENCES `specialities` (`idSpeciality`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PersonSepciality_3` FOREIGN KEY (`PaymentTypeID`) REFERENCES `personeducationpaymenttypes` (`idEducationPaymentTypes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PersonSepciality_4` FOREIGN KEY (`EducationFormID`) REFERENCES `personeducationforms` (`idPersonEducationForm`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PersonSepciality_5` FOREIGN KEY (`QualificationID`) REFERENCES `qualifications` (`idQualification`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PersonSepciality_6` FOREIGN KEY (`EntranceTypeID`) REFERENCES `personenterancetypes` (`idPersonEnteranceType`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_personsepciality_7` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`idCourse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_personsepciality_8` FOREIGN KEY (`CausalityID`) REFERENCES `causality` (`idCausality`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_personsepciality_9` FOREIGN KEY (`DocumentSubject1`) REFERENCES `documentsubject` (`idDocumentSubject`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14226 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `insert_personspeciality` BEFORE INSERT ON `personspeciality`
FOR EACH ROW BEGIN
    SET NEW.`Modified` = NOW();
    SET NEW.`CreateDate` = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER update_personspeciality BEFORE UPDATE ON personspeciality
FOR EACH ROW BEGIN
    SET NEW.Modified = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;

--
-- Temporary table structure for view `personspeciality_counts`
--

--
-- Table structure for table `personspecialitybenefits`
--

-- DROP TABLE IF EXISTS `personspecialitybenefits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `personspecialitybenefits` (
  `PersonSpecialityID` int(11) NOT NULL,
  `PersonBenefitID` int(11) NOT NULL,
  PRIMARY KEY (`PersonSpecialityID`,`PersonBenefitID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `posvidka`
--

--
-- Table structure for table `prices`
--

-- DROP TABLE IF EXISTS `prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `prices` (
  `idPrice` int(11) NOT NULL,
  `FacultetID` int(11) NOT NULL,
  `SpecialityID` int(11) NOT NULL,
  `PriceYearInNumbers` int(11) NOT NULL,
  `PriceSemesterInNumbers` int(11) NOT NULL,
  `PriceYearInWords` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `EducationalServices` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2013/2014-2014/2015',
  PRIMARY KEY (`idPrice`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Ціни на навчання';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `qualifications`
--

-- DROP TABLE IF EXISTS `qualifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `qualifications` (
  `idQualification` int(11) NOT NULL,
  `QualificationName` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idQualification`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `requeststatus`
--

-- DROP TABLE IF EXISTS `requeststatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `requeststatus` (
  `idRequestStatus` int(11) NOT NULL,
  `RequestStatusName` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Название',
  `RequestStatusDesription` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Описание',
  `RequestStatusCode` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idRequestStatus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Статус заявки';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `resident_list`
--

--
-- Table structure for table `schools`
--

-- DROP TABLE IF EXISTS `schools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `schools` (
  `idSchool` int(11) NOT NULL,
  `EducationTypeID` int(11) DEFAULT NULL,
  `Kode_School` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SchoolName` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SchoolShortName` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `KOATUUCode` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `KOATUUFullName` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `StreetTypeID` int(11) DEFAULT NULL,
  `StreetName` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HouceNum` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SchoolBossLastName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SchoolBossFirstName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SchoolBossMiddleName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SchoolPhone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SchoolMobile` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SchoolEMail` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idSchool`),
  KEY `fk_Schools_1` (`EducationTypeID`),
  KEY `fk_Schools_3` (`StreetTypeID`),
  CONSTRAINT `fk_Schools_1` FOREIGN KEY (`EducationTypeID`) REFERENCES `educationtype` (`idEducationType`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Schools_3` FOREIGN KEY (`StreetTypeID`) REFERENCES `streettypes` (`idStreetTypes`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `specialities`
--

-- DROP TABLE IF EXISTS `specialities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `specialities` (
  `idSpeciality` int(11) NOT NULL,
  `SpecialityName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SpecialityDirectionName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SpecialitySpecializationName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SpecialityKode` char(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FacultetID` int(11) DEFAULT NULL,
  `SpecialityClasifierCode` char(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SpecialityBudgetCount` int(11) DEFAULT NULL COMMENT 'Количество бюджетных мест для специальности ВУЗа',
  `SpecialityContractCount` int(11) DEFAULT NULL COMMENT 'Количество контрактных мест для специальности ВУЗа',
  `isZaoch` tinyint(4) DEFAULT NULL COMMENT 'Идентификатор доступности для заочной формы обучения',
  `isPublishIn` tinyint(4) DEFAULT NULL COMMENT 'Идентификатор доступности для дистанционной подачи заявлений',
  `PersonEducationFormID` int(11) DEFAULT NULL,
  `Modified` datetime DEFAULT NULL COMMENT 'Дата последней модификации',
  `SysUserID` int(11) DEFAULT NULL COMMENT 'ID пользователя, который внес модификацию',
  `Quota1` int(11) DEFAULT NULL COMMENT 'Квота поступающих вне конкурса',
  `Quota2` int(11) DEFAULT NULL COMMENT 'Квота целевиков',
  `YearPrice` double DEFAULT NULL,
  `SemPrice` double DEFAULT NULL,
  `WordPrice` text COLLATE utf8_unicode_ci,
  `StudyPeriodID` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSpeciality`),
  KEY `fk_Specialities_1` (`FacultetID`),
  KEY `fk_specialities_2` (`PersonEducationFormID`),
  CONSTRAINT `fk_Specialities_1` FOREIGN KEY (`FacultetID`) REFERENCES `facultets` (`idFacultet`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_specialities_2` FOREIGN KEY (`PersonEducationFormID`) REFERENCES `personeducationforms` (`idPersonEducationForm`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER insert_specialities BEFORE INSERT ON specialities
FOR EACH ROW BEGIN
    SET NEW.Modified = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER update_specialities BEFORE UPDATE ON specialities
FOR EACH ROW BEGIN
    SET NEW.Modified = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;

--
-- Table structure for table `specialitiesplaces`
--

-- DROP TABLE IF EXISTS `specialitiesplaces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `specialitiesplaces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SpecialityID` int(11) NOT NULL,
  `Budget` int(5) NOT NULL,
  `Contract` int(5) NOT NULL,
  `Target` int(5) NOT NULL,
  `OutOfCompetition` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `specialitysubjects`
--

-- DROP TABLE IF EXISTS `specialitysubjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `specialitysubjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SpecialityID` int(11) DEFAULT NULL COMMENT 'Код специальности',
  `SubjectID` int(11) DEFAULT NULL COMMENT 'Код предмета',
  `LevelID` int(11) DEFAULT NULL,
  `Modified` datetime DEFAULT NULL COMMENT 'Дата последней модификации',
  `isProfile` tinyint(4) NOT NULL,
  `SysUserID` int(11) DEFAULT NULL COMMENT 'ID пользователя, внесшего последнюю модификацию',
  PRIMARY KEY (`id`),
  KEY `fk_SpecialitySubjects_1` (`SpecialityID`),
  KEY `fk_SpecialitySubjects_2` (`SubjectID`),
  KEY `LevelID` (`LevelID`),
  CONSTRAINT `fk_SpecialitySubjects_1` FOREIGN KEY (`SpecialityID`) REFERENCES `specialities` (`idSpeciality`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_SpecialitySubjects_2` FOREIGN KEY (`SubjectID`) REFERENCES `subjects` (`idSubjects`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `specialitysubjects_ibfk_1` FOREIGN KEY (`LevelID`) REFERENCES `znolevels` (`idLevel`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=408 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER insert_specialitysubjects BEFORE INSERT ON specialitysubjects
FOR EACH ROW BEGIN
    SET NEW.Modified = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER update_specialitysubjects BEFORE UPDATE ON specialitysubjects
FOR EACH ROW BEGIN
    SET NEW.Modified = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `abiturient` CHARACTER SET utf8 COLLATE utf8_unicode_ci ;

--
-- Temporary table structure for view `stat_graduated`
--

--
-- Temporary table structure for view `stat_graduated_by_f`
--

--
-- Table structure for table `streettypes`
--

-- DROP TABLE IF EXISTS `streettypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `streettypes` (
  `idStreetTypes` int(11) NOT NULL,
  `StreetTypesFullName` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `StreetTypesShortName` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idStreetTypes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `studyperiods`
--

-- DROP TABLE IF EXISTS `studyperiods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `studyperiods` (
  `idStudyPeriod` int(11) NOT NULL AUTO_INCREMENT,
  `StudyPeriodName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idStudyPeriod`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subjects`
--

-- DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `subjects` (
  `idSubjects` int(11) NOT NULL,
  `idZNOSubject` int(11) DEFAULT NULL,
  `SubjectName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ParentSubject` int(11) DEFAULT NULL,
  `SubjectKey` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idSubjects`),
  KEY `idx_ZNO` (`idZNOSubject`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sys_departments`
--

-- DROP TABLE IF EXISTS `sys_departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `sys_departments` (
  `idDepartment` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idDepartment`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sys_pk`
--

-- DROP TABLE IF EXISTS `sys_pk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `sys_pk` (
  `idPk` int(11) NOT NULL AUTO_INCREMENT,
  `PkName` text COLLATE utf8_unicode_ci NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `QualificationID` int(11) NOT NULL,
  `SpecMask` text COLLATE utf8_unicode_ci,
  `Info` text COLLATE utf8_unicode_ci NOT NULL,
  `isBudget` tinyint(4) NOT NULL,
  `isContract` tinyint(4) NOT NULL,
  `isShortForm` tinyint(4) DEFAULT NULL,
  `EducationFormID` int(11) NOT NULL,
  `printIP` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `searchIP` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idPk`),
  UNIQUE KEY `idPk` (`idPk`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sys_roleassignments`
--

-- DROP TABLE IF EXISTS `sys_roleassignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `sys_roleassignments` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `sys_roleassignments_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `sys_roles` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sys_rolechildren`
--

-- DROP TABLE IF EXISTS `sys_rolechildren`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `sys_rolechildren` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `sys_rolechildren_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `sys_roles` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sys_rolechildren_ibfk_2` FOREIGN KEY (`child`) REFERENCES `sys_roles` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sys_roles`
--

-- DROP TABLE IF EXISTS `sys_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `sys_roles` (
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `bizrule` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sys_users`
--

-- DROP TABLE IF EXISTS `sys_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `sys_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `SysPkID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `table_personspec_all`
--

--
-- Temporary table structure for view `table_personspec_today`
--

--
-- Temporary table structure for view `temp`
--

--
-- Table structure for table `universities`
--

-- DROP TABLE IF EXISTS `universities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `universities` (
  `idUniversity` int(11) NOT NULL AUTO_INCREMENT,
  `UniversityKode` varchar(36) COLLATE utf8_unicode_ci NOT NULL COMMENT 'GUID НЗ',
  `UniversityName` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Повна назва НЗ',
  PRIMARY KEY (`idUniversity`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Перелік НЗ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `village_list`
--

--
-- Temporary table structure for view `vypuskniki_ano_by_f`
--

--
-- Temporary table structure for view `vypuskniki_ne_ot_nas_stat`
--

--
-- Temporary table structure for view `vypuskniki_stat`
--

--
-- Temporary table structure for view `vypuskniki_statx`
--

--
-- Table structure for table `znolevels`
--

-- DROP TABLE IF EXISTS `znolevels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `znolevels` (
  `idLevel` int(11) NOT NULL AUTO_INCREMENT,
  `LevelName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idLevel`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Final view structure for view `benefitinfo`
--

/*!50001 DROP TABLE IF EXISTS `benefitinfo`*/;
/*!50001 DROP VIEW IF EXISTS `benefitinfo`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `benefitinfo` AS select `benefit`.`idBenefit` AS `idBenefit`,`benefit`.`BenefitName` AS `BenefitName`,`benefit`.`BenefitKey` AS `BenefitKey`,`benefitsgroups`.`BenefitsGroupsName` AS `BenefitsGroupsName` from (`benefit` join `benefitsgroups` on((`benefit`.`BenefitGroupID` = `benefitsgroups`.`idBenefitsGroups`))) order by `benefit`.`BenefitName` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;


--
-- Final view structure for view `document_subjects_view`
--

/*!50001 DROP TABLE IF EXISTS `document_subjects_view`*/;
/*!50001 DROP VIEW IF EXISTS `document_subjects_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `document_subjects_view` AS select `documentsubject`.`idDocumentSubject` AS `idDocumentSubject`,`documentsubject`.`DocumentID` AS `DocumentID`,`documentsubject`.`SubjectValue` AS `SubjectValue`,`documentsubject`.`DateGet` AS `DateGet`,`documentsubject`.`edboID` AS `edboID`,`subjects`.`SubjectName` AS `SubjectName` from (`documentsubject` join `subjects` on((`documentsubject`.`SubjectID` = `subjects`.`idSubjects`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `educationtypeclass`
--

/*!50001 DROP TABLE IF EXISTS `educationtypeclass`*/;
/*!50001 DROP VIEW IF EXISTS `educationtypeclass`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `educationtypeclass` AS select `educationtype`.`idEducationType` AS `idEducationType`,`educationtype`.`EducationTypeFullName` AS `EducationTypeFullName`,`educationtype`.`EducationTypeShortName` AS `EducationTypeShortName`,`educationclass`.`EducationClassName` AS `EducationClassName` from (`educationtype` join `educationclass` on((`educationtype`.`EducationTypeClassID` = `educationclass`.`idEducationClass`))) order by `educationtype`.`EducationTypeFullName` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;


--
-- Final view structure for view `graduated_school`
--

/*!50001 DROP TABLE IF EXISTS `graduated_school`*/;
/*!50001 DROP VIEW IF EXISTS `graduated_school`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `graduated_school` AS select distinct `person`.`idPerson` AS `ID_person`,concat_ws(' ',`person`.`LastName`,`person`.`FirstName`,`person`.`MiddleName`) AS `PIB`,`persondocumenttypes`.`PersonDocumentTypesName` AS `doc_type`,`documents`.`Issued` AS `Issued`,substr(`documents`.`DateGet`,1,4) AS `IssuedYear`,if((`documents`.`Issued` like '%вечірн%'),'вечірня школа',if((`documents`.`Issued` like '%коледж%'),'коледж',if((`documents`.`Issued` like '%училище%'),'училище',if(((`documents`.`Issued` like '%ліцей%') or (`documents`.`Issued` like '%ліцеєм%')),'ліцей',if((`documents`.`Issued` like '%гімназ%'),'гімназія',if(((`documents`.`Issued` like '%комплекс%') or (`documents`.`Issued` like '%НВК%')),'навчально-виховний комплекс',if((`documents`.`Issued` like '%колегіум%'),'колегіум',if(((`documents`.`Issued` like '%спеціалізован%') or (`documents`.`Issued` like '%спецшкол%') or (`documents`.`Issued` like '%спец. школа%')),'спеціалізована школа',if((`documents`.`Issued` like '%технікум%'),'технікум',if(((`documents`.`Issued` like '%загальноосвіт%') or (`documents`.`Issued` like '%ЗОШ%') or (`documents`.`Issued` like '%ЗШ%') or (`documents`.`Issued` like '%середн%') or (`documents`.`Issued` like '%Денн%') or (`documents`.`Issued` like '%ЗОСШ%') or (`documents`.`Issued` like '%СШ%')),'загальноосвітня середня школа (денна)',NULL)))))))))) AS `edu_type`,concat_ws(' ',(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end),`specialities`.`SpecialityClasifierCode`) AS `spec`,`personeducationforms`.`PersonEducationFormName` AS `edu_form`,`requeststatus`.`RequestStatusName` AS `status` from ((((((`person` left join `documents` on((`documents`.`PersonID` = `person`.`idPerson`))) join `persondocumenttypes` on((`documents`.`TypeID` = `persondocumenttypes`.`idPersonDocumentTypes`))) left join `personspeciality` on((`personspeciality`.`PersonID` = `person`.`idPerson`))) left join `specialities` on((`personspeciality`.`SepcialityID` = `specialities`.`idSpeciality`))) left join `personeducationforms` on((`specialities`.`PersonEducationFormID` = `personeducationforms`.`idPersonEducationForm`))) left join `requeststatus` on((`personspeciality`.`StatusID` = `requeststatus`.`idRequestStatus`))) where ((`documents`.`TypeID` in (2,10)) and (`personspeciality`.`StatusID` not in (2,3,10)) and (`personspeciality`.`QualificationID` = 1)) order by if((`documents`.`Issued` like '%вечірн%'),'вечірня школа',if((`documents`.`Issued` like '%коледж%'),'коледж',if((`documents`.`Issued` like '%училище%'),'училище',if(((`documents`.`Issued` like '%ліцей%') or (`documents`.`Issued` like '%ліцеєм%')),'ліцей',if((`documents`.`Issued` like '%гімназ%'),'гімназія',if(((`documents`.`Issued` like '%комплекс%') or (`documents`.`Issued` like '%НВК%')),'навчально-виховний комплекс',if((`documents`.`Issued` like '%колегіум%'),'колегіум',if(((`documents`.`Issued` like '%спеціалізован%') or (`documents`.`Issued` like '%спецшкол%') or (`documents`.`Issued` like '%спец. школа%')),'спеціалізована школа',if((`documents`.`Issued` like '%технікум%'),'технікум',if(((`documents`.`Issued` like '%загальноосвіт%') or (`documents`.`Issued` like '%ЗОШ%') or (`documents`.`Issued` like '%ЗШ%') or (`documents`.`Issued` like '%середн%') or (`documents`.`Issued` like '%Денн%') or (`documents`.`Issued` like '%ЗОСШ%') or (`documents`.`Issued` like '%СШ%')),'загальноосвітня середня школа (денна)',NULL)))))))))),concat_ws(' ',`person`.`LastName`,`person`.`FirstName`,`person`.`MiddleName`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `person_contacts_view`
--

/*!50001 DROP TABLE IF EXISTS `person_contacts_view`*/;
/*!50001 DROP VIEW IF EXISTS `person_contacts_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `person_contacts_view` AS select concat(`person`.`LastName`,' ',`person`.`FirstName`,' ',`person`.`MiddleName`) AS `FIO`,`personspeciality`.`SepcialityID` AS `SepcialityID`,`personspeciality`.`RequestFromEB` AS `RequestFromEB`,`personspeciality`.`EducationFormID` AS `EducationFormID`,`personspeciality`.`RequestNumber` AS `RequestNumber`,`personspeciality`.`isBudget` AS `isBudget`,`personspeciality`.`isContract` AS `isContract`,concat(`specialities`.`SpecialityClasifierCode`,' ',`specialities`.`SpecialityDirectionName`,' ',`specialities`.`SpecialityName`,' ',`specialities`.`SpecialitySpecializationName`) AS `SpecName`,(select group_concat(`personcontacts`.`Value` separator ', ') from `personcontacts` where (`personcontacts`.`PersonID` = `person`.`idPerson`) group by `personcontacts`.`PersonID`) AS `Contacts` from ((`personspeciality` join `person` on((`personspeciality`.`PersonID` = `person`.`idPerson`))) join `specialities` on((`personspeciality`.`SepcialityID` = `specialities`.`idSpeciality`))) order by concat(`specialities`.`SpecialityClasifierCode`,' ',`specialities`.`SpecialityDirectionName`,' ',`specialities`.`SpecialityName`,' ',`specialities`.`SpecialitySpecializationName`),concat(`person`.`LastName`,' ',`person`.`FirstName`,' ',`person`.`MiddleName`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `person_contract_speciality_view`
--

/*!50001 DROP TABLE IF EXISTS `person_contract_speciality_view`*/;
/*!50001 DROP VIEW IF EXISTS `person_contract_speciality_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `person_contract_speciality_view` AS select `personspeciality`.`idPersonSpeciality` AS `idPersonSpeciality`,`person`.`idPerson` AS `idPerson`,concat(`person`.`LastName`,' ',`person`.`FirstName`,' ',`person`.`MiddleName`) AS `FIO`,concat(`specialities`.`SpecialityClasifierCode`,': ',`specialities`.`SpecialityName`,' ',`specialities`.`SpecialityDirectionName`,' ',`specialities`.`SpecialitySpecializationName`) AS `SpecCodeName`,`personspeciality`.`EducationFormID` AS `EducationFormID`,`personspeciality`.`SepcialityID` AS `SepcialityID` from ((`personspeciality` join `person` on((`person`.`idPerson` = `personspeciality`.`PersonID`))) join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `person_speciality_view`
--

/*!50001 DROP TABLE IF EXISTS `person_speciality_view`*/;
/*!50001 DROP VIEW IF EXISTS `person_speciality_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `person_speciality_view` AS select `personspeciality`.`idPersonSpeciality` AS `idPersonSpeciality`,`personspeciality`.`CreateDate` AS `CreateDate`,`person`.`idPerson` AS `idPerson`,`person`.`Birthday` AS `Birthday`,concat(`person`.`LastName`,' ',`person`.`FirstName`,' ',`person`.`MiddleName`) AS `FIO`,`personspeciality`.`isContract` AS `isContract`,`personspeciality`.`isBudget` AS `isBudget`,concat(`specialities`.`SpecialityClasifierCode`,': ',`specialities`.`SpecialityName`,' ',`specialities`.`SpecialityDirectionName`,' ',`specialities`.`SpecialitySpecializationName`) AS `SpecCodeName`,`personspeciality`.`QualificationID` AS `QualificationID`,`personspeciality`.`CourseID` AS `CourseID`,`personspeciality`.`RequestNumber` AS `RequestNumber`,`personspeciality`.`PersonRequestNumber` AS `PersonRequestNumber`,`person`.`edboID` AS `PersonEdboID`,`personspeciality`.`edboID` AS `SpecEdboID`,`person`.`CreateDate` AS `PersonCreateDate`,`personspeciality`.`DocumentSubject1` AS `DocumentSubject1`,(select `documentsubject`.`SubjectValue` from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject1`)) AS `DocumentSubject1Value`,`personspeciality`.`DocumentSubject2` AS `DocumentSubject2`,(select `documentsubject`.`SubjectValue` from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject2`)) AS `DocumentSubject2Value`,`personspeciality`.`DocumentSubject2` AS `DocumentSubject3`,(select `documentsubject`.`SubjectValue` from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject3`)) AS `DocumentSubject3Value`,`documents`.`PersonDocumentsAwardsTypesID` AS `PersonDocumentsAwardsTypesID`,`personspeciality`.`isCopyEntrantDoc` AS `isCopyEntrantDoc`,`documents`.`AtestatValue` AS `AtestatValue`,`documents`.`TypeID` AS `DocumentTypeID`,`personspeciality`.`CoursedpID` AS `CoursedpID`,`personspeciality`.`OlympiadID` AS `OlympiadID`,`personspeciality`.`StatusID` AS `StatusID`,`personspeciality`.`RequestFromEB` AS `RequestFromEB`,`personspeciality`.`EducationFormID` AS `EducationFormID`,`personspeciality`.`SepcialityID` AS `SepcialityID` from (((`personspeciality` join `person` on((`person`.`idPerson` = `personspeciality`.`PersonID`))) join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) join `documents` on((`personspeciality`.`EntrantDocumentID` = `documents`.`idDocuments`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;


-- Dump completed on 2014-05-22 15:11:43
