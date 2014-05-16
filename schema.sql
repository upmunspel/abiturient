-- MySQL dump 10.13  Distrib 5.6.12, for Win32 (x86)
--
-- Host: localhost    Database: abiturient
-- ------------------------------------------------------
-- Server version	5.6.12-log

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
-- Table structure for table `academicyears`
--

DROP TABLE IF EXISTS `academicyears`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `academicyears` (
  `idAcademicYear` int(11) NOT NULL AUTO_INCREMENT,
  `AcademicYearName` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idAcademicYear`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Навчальні роки (для договорів)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `all_bachelors`
--

DROP TABLE IF EXISTS `all_bachelors`;
/*!50001 DROP VIEW IF EXISTS `all_bachelors`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `all_bachelors` (
  `Specialnost` tinyint NOT NULL,
  `edboID` tinyint NOT NULL,
  `BalDetail` tinyint NOT NULL,
  `sumBall` tinyint NOT NULL,
  `LastName` tinyint NOT NULL,
  `FirstName` tinyint NOT NULL,
  `MiddleName` tinyint NOT NULL,
  `PozaKonkursom` tinyint NOT NULL,
  `isPZK` tinyint NOT NULL,
  `Pozacherg` tinyint NOT NULL,
  `isPV` tinyint NOT NULL,
  `Orig` tinyint NOT NULL,
  `Nomer_lichnogo_dela` tinyint NOT NULL,
  `isElectro` tinyint NOT NULL,
  `Status` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `all_counts`
--

DROP TABLE IF EXISTS `all_counts`;
/*!50001 DROP VIEW IF EXISTS `all_counts`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `all_counts` (
  `ID` tinyint NOT NULL,
  `Fakultet` tinyint NOT NULL,
  `Specialnost` tinyint NOT NULL,
  `dnevn` tinyint NOT NULL,
  `dnevn_budget` tinyint NOT NULL,
  `dnevn_contract` tinyint NOT NULL,
  `dnevn_pv` tinyint NOT NULL,
  `dnevn_pzk` tinyint NOT NULL,
  `dnevn_originals` tinyint NOT NULL,
  `dnevn_electro` tinyint NOT NULL,
  `cnt_dnevn_budgetcount_view` tinyint NOT NULL,
  `cnt_dnevn_contractcount_view` tinyint NOT NULL,
  `zaoch` tinyint NOT NULL,
  `zaoch_budget` tinyint NOT NULL,
  `zaoch_contract` tinyint NOT NULL,
  `zaoch_pv` tinyint NOT NULL,
  `zaoch_pzk` tinyint NOT NULL,
  `zaoch_originals` tinyint NOT NULL,
  `zaoch_electro` tinyint NOT NULL,
  `cnt_zaoch_budgetcount_view` tinyint NOT NULL,
  `cnt_zaoch_contractcount_view` tinyint NOT NULL,
  `medals` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `all_counts_per_dates`
--

DROP TABLE IF EXISTS `all_counts_per_dates`;
/*!50001 DROP VIEW IF EXISTS `all_counts_per_dates`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `all_counts_per_dates` (
  `Fakultet` tinyint NOT NULL,
  `Specialnost` tinyint NOT NULL,
  `dnevn` tinyint NOT NULL,
  `zaoch` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `all_dates`
--

DROP TABLE IF EXISTS `all_dates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `all_dates` (
  `cdate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cdate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `all_specialities`
--

DROP TABLE IF EXISTS `all_specialities`;
/*!50001 DROP VIEW IF EXISTS `all_specialities`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `all_specialities` (
  `F` tinyint NOT NULL,
  `S` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `atestatvalue`
--

DROP TABLE IF EXISTS `atestatvalue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atestatvalue` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `AtestatValue` float NOT NULL,
  `ZnoValue` float NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `benefit`
--

DROP TABLE IF EXISTS `benefit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `benefit` (
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

DROP TABLE IF EXISTS `benefitinfo`;
/*!50001 DROP VIEW IF EXISTS `benefitinfo`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `benefitinfo` (
  `idBenefit` tinyint NOT NULL,
  `BenefitName` tinyint NOT NULL,
  `BenefitKey` tinyint NOT NULL,
  `BenefitsGroupsName` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `benefitsgroups`
--

DROP TABLE IF EXISTS `benefitsgroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `benefitsgroups` (
  `idBenefitsGroups` int(11) NOT NULL,
  `BenefitsGroupsName` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idBenefitsGroups`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `causality`
--

DROP TABLE IF EXISTS `causality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `causality` (
  `idCausality` int(11) NOT NULL,
  `CausalityName` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CausalityDescription` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idCausality`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ExaminationCauses в ЄДЕБО';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cnt_bachelor_graduated_2013`
--

DROP TABLE IF EXISTS `cnt_bachelor_graduated_2013`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cnt_bachelor_graduated_2013` (
  `FacultetID` int(11) NOT NULL DEFAULT '0',
  `cnt` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`FacultetID`),
  CONSTRAINT `fk_bachelor_graduated_2013` FOREIGN KEY (`FacultetID`) REFERENCES `facultets` (`idFacultet`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Количество выпускников бакалавров 2013 г.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `cnt_dnevn_budget_view`
--

DROP TABLE IF EXISTS `cnt_dnevn_budget_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_budget_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_dnevn_budget_view` (
  `SpecialityClasifierCode` tinyint NOT NULL,
  `_Specialnost` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL,
  `cnt_dnevn_budget` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_dnevn_budgetcount_view`
--

DROP TABLE IF EXISTS `cnt_dnevn_budgetcount_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_budgetcount_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_dnevn_budgetcount_view` (
  `_Specialnost` tinyint NOT NULL,
  `cnt_dnevn_budgetcount` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_dnevn_contract_view`
--

DROP TABLE IF EXISTS `cnt_dnevn_contract_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_contract_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_dnevn_contract_view` (
  `SpecialityClasifierCode` tinyint NOT NULL,
  `_Specialnost` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL,
  `cnt_dnevn_contract` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_dnevn_contractcount_view`
--

DROP TABLE IF EXISTS `cnt_dnevn_contractcount_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_contractcount_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_dnevn_contractcount_view` (
  `_Specialnost` tinyint NOT NULL,
  `cnt_dnevn_contractcount` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_dnevn_electro_view`
--

DROP TABLE IF EXISTS `cnt_dnevn_electro_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_electro_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_dnevn_electro_view` (
  `SpecialityClasifierCode` tinyint NOT NULL,
  `_Specialnost` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL,
  `cnt_dnevn_electro` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_dnevn_originals_view`
--

DROP TABLE IF EXISTS `cnt_dnevn_originals_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_originals_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_dnevn_originals_view` (
  `SpecialityClasifierCode` tinyint NOT NULL,
  `_Specialnost` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL,
  `cnt_dnevn_originals` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_dnevn_per_dates_view`
--

DROP TABLE IF EXISTS `cnt_dnevn_per_dates_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_per_dates_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_dnevn_per_dates_view` (
  `_Specialnost` tinyint NOT NULL,
  `cnt_dnevn` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_dnevn_pv_view`
--

DROP TABLE IF EXISTS `cnt_dnevn_pv_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_pv_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_dnevn_pv_view` (
  `SpecialityClasifierCode` tinyint NOT NULL,
  `_Specialnost` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL,
  `cnt_dnevn_pv` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_dnevn_pzk_view`
--

DROP TABLE IF EXISTS `cnt_dnevn_pzk_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_pzk_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_dnevn_pzk_view` (
  `SpecialityClasifierCode` tinyint NOT NULL,
  `_Specialnost` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL,
  `cnt_dnevn_pzk` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_dnevn_view`
--

DROP TABLE IF EXISTS `cnt_dnevn_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_dnevn_view` (
  `SpecialityClasifierCode` tinyint NOT NULL,
  `_Specialnost` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL,
  `cnt_dnevn` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_left_per_dates_view`
--

DROP TABLE IF EXISTS `cnt_left_per_dates_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_left_per_dates_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_left_per_dates_view` (
  `Specialnost` tinyint NOT NULL,
  `Fakultet` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_medals_view`
--

DROP TABLE IF EXISTS `cnt_medals_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_medals_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_medals_view` (
  `SpecialityClasifierCode` tinyint NOT NULL,
  `_Specialnost` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL,
  `cnt_medals` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_zaoch_budget_view`
--

DROP TABLE IF EXISTS `cnt_zaoch_budget_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_budget_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_zaoch_budget_view` (
  `SpecialityClasifierCode` tinyint NOT NULL,
  `_Specialnost` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL,
  `cnt_zaoch_budget` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_zaoch_budgetcount_view`
--

DROP TABLE IF EXISTS `cnt_zaoch_budgetcount_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_budgetcount_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_zaoch_budgetcount_view` (
  `_Specialnost` tinyint NOT NULL,
  `cnt_zaoch_budgetcount` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_zaoch_contract_view`
--

DROP TABLE IF EXISTS `cnt_zaoch_contract_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_contract_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_zaoch_contract_view` (
  `SpecialityClasifierCode` tinyint NOT NULL,
  `_Specialnost` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL,
  `cnt_zaoch_contract` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_zaoch_contractcount_view`
--

DROP TABLE IF EXISTS `cnt_zaoch_contractcount_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_contractcount_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_zaoch_contractcount_view` (
  `_Specialnost` tinyint NOT NULL,
  `cnt_zaoch_contractcount` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_zaoch_electro_view`
--

DROP TABLE IF EXISTS `cnt_zaoch_electro_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_electro_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_zaoch_electro_view` (
  `SpecialityClasifierCode` tinyint NOT NULL,
  `_Specialnost` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL,
  `cnt_zaoch_electro` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_zaoch_originals_view`
--

DROP TABLE IF EXISTS `cnt_zaoch_originals_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_originals_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_zaoch_originals_view` (
  `SpecialityClasifierCode` tinyint NOT NULL,
  `_Specialnost` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL,
  `cnt_zaoch_originals` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_zaoch_per_dates_view`
--

DROP TABLE IF EXISTS `cnt_zaoch_per_dates_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_per_dates_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_zaoch_per_dates_view` (
  `_Specialnost` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL,
  `cnt_zaoch` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_zaoch_pv_view`
--

DROP TABLE IF EXISTS `cnt_zaoch_pv_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_pv_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_zaoch_pv_view` (
  `SpecialityClasifierCode` tinyint NOT NULL,
  `_Specialnost` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL,
  `cnt_zaoch_pv` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_zaoch_pzk_view`
--

DROP TABLE IF EXISTS `cnt_zaoch_pzk_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_pzk_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_zaoch_pzk_view` (
  `SpecialityClasifierCode` tinyint NOT NULL,
  `_Specialnost` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL,
  `cnt_zaoch_pzk` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cnt_zaoch_view`
--

DROP TABLE IF EXISTS `cnt_zaoch_view`;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cnt_zaoch_view` (
  `SpecialityClasifierCode` tinyint NOT NULL,
  `_Specialnost` tinyint NOT NULL,
  `SepcialityID` tinyint NOT NULL,
  `cnt_zaoch` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contracts` (
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contracts_type`
--

DROP TABLE IF EXISTS `contracts_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contracts_type` (
  `idcontracts_type` int(100) NOT NULL AUTO_INCREMENT,
  `ContractsTypeName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idcontracts_type`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='i am cancer';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `country` (
  `idCountry` int(11) NOT NULL AUTO_INCREMENT,
  `CountryName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iso` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Visible` int(11) NOT NULL,
  PRIMARY KEY (`idCountry`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `coursedp`
--

DROP TABLE IF EXISTS `coursedp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coursedp` (
  `idCourseDP` int(11) NOT NULL,
  `CourseDPName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `guid` char(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'GUID курсов в ЕДБО',
  PRIMARY KEY (`idCourseDP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `idCourse` int(11) NOT NULL,
  `CourseName` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idCourse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `directories`
--

DROP TABLE IF EXISTS `directories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `directories` (
  `idDirecrtory` int(11) NOT NULL AUTO_INCREMENT,
  `DirectoryName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DirectoryInfo` text COLLATE utf8_unicode_ci NOT NULL,
  `DirectoryLink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Visible` tinyint(4) NOT NULL,
  `Access` int(11) NOT NULL,
  PRIMARY KEY (`idDirecrtory`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `document_subjects_view`
--

DROP TABLE IF EXISTS `document_subjects_view`;
/*!50001 DROP VIEW IF EXISTS `document_subjects_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `document_subjects_view` (
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

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `documentsubject`
--

DROP TABLE IF EXISTS `documentsubject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentsubject` (
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `edbo_data`
--

DROP TABLE IF EXISTS `edbo_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `edbo_data` (
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

DROP TABLE IF EXISTS `educationclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `educationclass` (
  `idEducationClass` int(11) NOT NULL,
  `EducationClassName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idEducationClass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `educationtype`
--

DROP TABLE IF EXISTS `educationtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `educationtype` (
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

DROP TABLE IF EXISTS `educationtypeclass`;
/*!50001 DROP VIEW IF EXISTS `educationtypeclass`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `educationtypeclass` (
  `idEducationType` tinyint NOT NULL,
  `EducationTypeFullName` tinyint NOT NULL,
  `EducationTypeShortName` tinyint NOT NULL,
  `EducationClassName` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `examinations_without_zno`
--

DROP TABLE IF EXISTS `examinations_without_zno`;
/*!50001 DROP VIEW IF EXISTS `examinations_without_zno`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `examinations_without_zno` (
  `idPersonMySql` tinyint NOT NULL,
  `idPersonEdbo` tinyint NOT NULL,
  `FIO` tinyint NOT NULL,
  `Speciality` tinyint NOT NULL,
  `Examination1` tinyint NOT NULL,
  `Examination2` tinyint NOT NULL,
  `Examination3` tinyint NOT NULL,
  `educationFormName` tinyint NOT NULL,
  `idEducationForm` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `facultets`
--

DROP TABLE IF EXISTS `facultets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facultets` (
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

DROP TABLE IF EXISTS `graduated_school`;
/*!50001 DROP VIEW IF EXISTS `graduated_school`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `graduated_school` (
  `ID_person` tinyint NOT NULL,
  `PIB` tinyint NOT NULL,
  `doc_type` tinyint NOT NULL,
  `Issued` tinyint NOT NULL,
  `IssuedYear` tinyint NOT NULL,
  `edu_type` tinyint NOT NULL,
  `spec` tinyint NOT NULL,
  `edu_form` tinyint NOT NULL,
  `status` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `koatuulevel1`
--

DROP TABLE IF EXISTS `koatuulevel1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `koatuulevel1` (
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

DROP TABLE IF EXISTS `koatuulevel2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `koatuulevel2` (
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

DROP TABLE IF EXISTS `koatuulevel3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `koatuulevel3` (
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

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `idLanguages` int(11) NOT NULL,
  `LanguagesCode` char(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LanguagesName` char(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idLanguages`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `mag_languages`
--

DROP TABLE IF EXISTS `mag_languages`;
/*!50001 DROP VIEW IF EXISTS `mag_languages`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `mag_languages` (
  `idFuc` tinyint NOT NULL,
  `SCode` tinyint NOT NULL,
  `spec` tinyint NOT NULL,
  `person_id` tinyint NOT NULL,
  `surname` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `farthername` tinyint NOT NULL,
  `langName` tinyint NOT NULL,
  `eduform` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `mag_languages_foreign_filology`
--

DROP TABLE IF EXISTS `mag_languages_foreign_filology`;
/*!50001 DROP VIEW IF EXISTS `mag_languages_foreign_filology`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `mag_languages_foreign_filology` (
  `FacultetFullName` tinyint NOT NULL,
  `spec` tinyint NOT NULL,
  `ForeignLang` tinyint NOT NULL,
  `surname` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `farthername` tinyint NOT NULL,
  `fah` tinyint NOT NULL,
  `eduform` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `olympiadsawards`
--

DROP TABLE IF EXISTS `olympiadsawards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `olympiadsawards` (
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

DROP TABLE IF EXISTS `parametersquery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parametersquery` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(135) COLLATE utf8_unicode_ci NOT NULL,
  `coment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `person_contacts_view`
--

DROP TABLE IF EXISTS `person_contacts_view`;
/*!50001 DROP VIEW IF EXISTS `person_contacts_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `person_contacts_view` (
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

DROP TABLE IF EXISTS `person_contract_speciality_view`;
/*!50001 DROP VIEW IF EXISTS `person_contract_speciality_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `person_contract_speciality_view` (
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

DROP TABLE IF EXISTS `person_list`;
/*!50001 DROP VIEW IF EXISTS `person_list`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `person_list` (
  `sumBall` tinyint NOT NULL,
  `OlympiadAwardBonus` tinyint NOT NULL,
  `isCopy` tinyint NOT NULL,
  `surname` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `fartherName` tinyint NOT NULL,
  `facultet` tinyint NOT NULL,
  `eb` tinyint NOT NULL,
  `idFacultet` tinyint NOT NULL,
  `spec` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `region` tinyint NOT NULL,
  `city` tinyint NOT NULL,
  `cityVillage` tinyint NOT NULL,
  `edu` tinyint NOT NULL,
  `homephone` tinyint NOT NULL,
  `mobile` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `person_speciality_view`
--

DROP TABLE IF EXISTS `person_speciality_view`;
/*!50001 DROP VIEW IF EXISTS `person_speciality_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `person_speciality_view` (
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

DROP TABLE IF EXISTS `person_with1or2_spec`;
/*!50001 DROP VIEW IF EXISTS `person_with1or2_spec`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `person_with1or2_spec` (
  `ПІБ` tinyint NOT NULL,
  `КІЛЬКІСТЬ ПОДАНИХ ЗАЯВОК` tinyint NOT NULL,
  `ЗАЯВКИ` tinyint NOT NULL,
  `КОНТАКТИ` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `personbasespeciality`
--

DROP TABLE IF EXISTS `personbasespeciality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personbasespeciality` (
  `idPersonBaseSpeciality` int(11) NOT NULL AUTO_INCREMENT,
  `PersonBaseSpecialityName` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Название',
  `PersonBaseSpecialityClasifierCode` char(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'код по классификации МОН',
  PRIMARY KEY (`idPersonBaseSpeciality`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Справочник с перечнем специальностей в дипломах баклавров и ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personbenefitdocument`
--

DROP TABLE IF EXISTS `personbenefitdocument`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personbenefitdocument` (
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

--
-- Table structure for table `personbenefits`
--

DROP TABLE IF EXISTS `personbenefits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personbenefits` (
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personcontacts`
--

DROP TABLE IF EXISTS `personcontacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personcontacts` (
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personcontacttypes`
--

DROP TABLE IF EXISTS `personcontacttypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personcontacttypes` (
  `idPersonContactType` int(11) NOT NULL,
  `PersonContactTypeName` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idPersonContactType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personcoursesdp`
--

DROP TABLE IF EXISTS `personcoursesdp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personcoursesdp` (
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Подготовительные курсы персоны';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `persondocumentsawardstypes`
--

DROP TABLE IF EXISTS `persondocumentsawardstypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persondocumentsawardstypes` (
  `idPersonDocumentsAwardsTypes` int(3) NOT NULL,
  `PersonDocumentsAwardsTypesName` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `persondocumenttypes`
--

DROP TABLE IF EXISTS `persondocumenttypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persondocumenttypes` (
  `idPersonDocumentTypes` int(11) NOT NULL,
  `PersonDocumentTypesName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IsEntrantDocument` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPersonDocumentTypes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personeducationforms`
--

DROP TABLE IF EXISTS `personeducationforms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personeducationforms` (
  `idPersonEducationForm` int(11) NOT NULL COMMENT 'Идентификатор формы обучения персоны',
  `PersonEducationFormName` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Название формы обучения персоны',
  `isVisible` tinyint(4) DEFAULT NULL COMMENT 'Флаг видимости формы обучения для оператора системы',
  PRIMARY KEY (`idPersonEducationForm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Таблица хранит формы обучения персоны';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personeducationpaymenttypes`
--

DROP TABLE IF EXISTS `personeducationpaymenttypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personeducationpaymenttypes` (
  `idEducationPaymentTypes` int(11) NOT NULL,
  `EducationPaymentTypesName` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idEducationPaymentTypes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personeducationtypes`
--

DROP TABLE IF EXISTS `personeducationtypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personeducationtypes` (
  `idPersonEducationTypes` int(11) NOT NULL,
  `PersonEducationTypesName` char(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idPersonEducationTypes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personenterancetypes`
--

DROP TABLE IF EXISTS `personenterancetypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personenterancetypes` (
  `idPersonEnteranceType` int(11) NOT NULL,
  `PersonEnteranceTypeName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idPersonEnteranceType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personolympiad`
--

DROP TABLE IF EXISTS `personolympiad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personolympiad` (
  `idPersonOlympiad` int(11) NOT NULL AUTO_INCREMENT,
  `PersonID` int(11) DEFAULT NULL,
  `OlympiadAwarID` int(11) DEFAULT NULL,
  `edboID` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPersonOlympiad`),
  KEY `fk_PersonOlympiad_1` (`OlympiadAwarID`),
  KEY `fk_PersonOlympiad_2` (`PersonID`),
  CONSTRAINT `fk_PersonOlympiad_1` FOREIGN KEY (`OlympiadAwarID`) REFERENCES `olympiadsawards` (`OlympiadAwardID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PersonOlympiad_2` FOREIGN KEY (`PersonID`) REFERENCES `person` (`idPerson`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Список олимпиад персоны';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personrequeststatustypes`
--

DROP TABLE IF EXISTS `personrequeststatustypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personrequeststatustypes` (
  `idPersonRequestStatusType` int(11) NOT NULL COMMENT 'Id_PersonRequestStatusType Идентификатор заявки',
  `PersonRequestStatusCode` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Текстовый код статуса',
  `PersonRequestStatusTypeName` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Название статуса заявки',
  `PersonRequestStatusTypeDescription` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Описание статуса заявки',
  PRIMARY KEY (`idPersonRequestStatusType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='PersonRequestStatusTypesGet (string SessionGUID, string ActualDate, int Id_Langu';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personsextypes`
--

DROP TABLE IF EXISTS `personsextypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personsextypes` (
  `idPersonSexTypes` int(11) NOT NULL,
  `PersonSexTypesName` char(12) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idPersonSexTypes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `personspec_all`
--

DROP TABLE IF EXISTS `personspec_all`;
/*!50001 DROP VIEW IF EXISTS `personspec_all`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `personspec_all` (
  `idPersonSpeciality` tinyint NOT NULL,
  `FIO` tinyint NOT NULL,
  `FacultetFullName` tinyint NOT NULL,
  `QualificationName` tinyint NOT NULL,
  `Specialnost` tinyint NOT NULL,
  `Forma` tinyint NOT NULL,
  `isContract` tinyint NOT NULL,
  `isBudget` tinyint NOT NULL,
  `isCopyEntrantDoc` tinyint NOT NULL,
  `RequestFromEB` tinyint NOT NULL,
  `Pilga` tinyint NOT NULL,
  `PozaKonkursom` tinyint NOT NULL,
  `Pozacherg` tinyint NOT NULL,
  `VillageQuota` tinyint NOT NULL,
  `TargetQuota` tinyint NOT NULL,
  `Date` tinyint NOT NULL,
  `edboID` tinyint NOT NULL,
  `Nomer_lichnogo_dela` tinyint NOT NULL,
  `N_dela` tinyint NOT NULL,
  `StatusID` tinyint NOT NULL,
  `Status` tinyint NOT NULL,
  `exams` tinyint NOT NULL,
  `ispity` tinyint NOT NULL,
  `olymp` tinyint NOT NULL,
  `courses` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `personspec_all_part1`
--

DROP TABLE IF EXISTS `personspec_all_part1`;
/*!50001 DROP VIEW IF EXISTS `personspec_all_part1`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `personspec_all_part1` (
  `idPersonSpeciality` tinyint NOT NULL,
  `FIO` tinyint NOT NULL,
  `FacultetFullName` tinyint NOT NULL,
  `QualificationName` tinyint NOT NULL,
  `Specialnost` tinyint NOT NULL,
  `Forma` tinyint NOT NULL,
  `isContract` tinyint NOT NULL,
  `isBudget` tinyint NOT NULL,
  `isCopyEntrantDoc` tinyint NOT NULL,
  `RequestFromEB` tinyint NOT NULL,
  `Pilga` tinyint NOT NULL,
  `PozaKonkursom` tinyint NOT NULL,
  `Pozacherg` tinyint NOT NULL,
  `VillageQuota` tinyint NOT NULL,
  `TargetQuota` tinyint NOT NULL,
  `Date` tinyint NOT NULL,
  `edboID` tinyint NOT NULL,
  `Nomer_lichnogo_dela` tinyint NOT NULL,
  `N_dela` tinyint NOT NULL,
  `StatusID` tinyint NOT NULL,
  `Status` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `personspec_all_part2`
--

DROP TABLE IF EXISTS `personspec_all_part2`;
/*!50001 DROP VIEW IF EXISTS `personspec_all_part2`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `personspec_all_part2` (
  `ID` tinyint NOT NULL,
  `FIO_` tinyint NOT NULL,
  `exams` tinyint NOT NULL,
  `ispity` tinyint NOT NULL,
  `olymp` tinyint NOT NULL,
  `courses` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `personspec_counts`
--

DROP TABLE IF EXISTS `personspec_counts`;
/*!50001 DROP VIEW IF EXISTS `personspec_counts`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `personspec_counts` (
  `_date_` tinyint NOT NULL,
  `_count_` tinyint NOT NULL,
  `idPersonSpeciality` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `personspec_mag`
--

DROP TABLE IF EXISTS `personspec_mag`;
/*!50001 DROP VIEW IF EXISTS `personspec_mag`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `personspec_mag` (
  `idPersonSpeciality` tinyint NOT NULL,
  `FIO` tinyint NOT NULL,
  `FacultetFullName` tinyint NOT NULL,
  `Specialnost` tinyint NOT NULL,
  `Kontrakt` tinyint NOT NULL,
  `Budget` tinyint NOT NULL,
  `PersonDocumentTypesName` tinyint NOT NULL,
  `evaluation` tinyint NOT NULL,
  `Status` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `personspec_specialists`
--

DROP TABLE IF EXISTS `personspec_specialists`;
/*!50001 DROP VIEW IF EXISTS `personspec_specialists`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `personspec_specialists` (
  `idPersonSpeciality` tinyint NOT NULL,
  `FIO` tinyint NOT NULL,
  `FacultetFullName` tinyint NOT NULL,
  `Specialnost` tinyint NOT NULL,
  `Kontrakt` tinyint NOT NULL,
  `Budget` tinyint NOT NULL,
  `PersonDocumentTypesName` tinyint NOT NULL,
  `evaluation` tinyint NOT NULL,
  `Status` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `personspeciality`
--

DROP TABLE IF EXISTS `personspeciality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personspeciality` (
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
  `CustomerPaymentDetails` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `personspeciality_counts`
--

DROP TABLE IF EXISTS `personspeciality_counts`;
/*!50001 DROP VIEW IF EXISTS `personspeciality_counts`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `personspeciality_counts` (
  `FacultetFullName` tinyint NOT NULL,
  `spec_nm` tinyint NOT NULL,
  `idSpeciality` tinyint NOT NULL,
  `ids_cnt_dnevn` tinyint NOT NULL,
  `ids_cnt_zaoch` tinyint NOT NULL,
  `QualificationID` tinyint NOT NULL,
  `PersonEducationFormID` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `posvidka`
--

DROP TABLE IF EXISTS `posvidka`;
/*!50001 DROP VIEW IF EXISTS `posvidka`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `posvidka` (
  `idPerson` tinyint NOT NULL,
  `FirstName` tinyint NOT NULL,
  `MiddleName` tinyint NOT NULL,
  `LastName` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prices` (
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

DROP TABLE IF EXISTS `qualifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qualifications` (
  `idQualification` int(11) NOT NULL,
  `QualificationName` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idQualification`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `requeststatus`
--

DROP TABLE IF EXISTS `requeststatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requeststatus` (
  `idRequestStatus` int(11) NOT NULL,
  `RequestStatusName` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Название',
  `RequestStatusDesription` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Описание',
  `RequestStatusCode` char(10) CHARACTER SET big5 DEFAULT NULL,
  PRIMARY KEY (`idRequestStatus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Статус заявки';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `resident_list`
--

DROP TABLE IF EXISTS `resident_list`;
/*!50001 DROP VIEW IF EXISTS `resident_list`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `resident_list` (
  `surname` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `fartherName` tinyint NOT NULL,
  `edbo` tinyint NOT NULL,
  `country` tinyint NOT NULL,
  `edu` tinyint NOT NULL,
  `statusname` tinyint NOT NULL,
  `spec` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schools` (
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

DROP TABLE IF EXISTS `specialities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specialities` (
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

--
-- Table structure for table `specialitiesplaces`
--

DROP TABLE IF EXISTS `specialitiesplaces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specialitiesplaces` (
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

DROP TABLE IF EXISTS `specialitysubjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specialitysubjects` (
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `stat_graduated`
--

DROP TABLE IF EXISTS `stat_graduated`;
/*!50001 DROP VIEW IF EXISTS `stat_graduated`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `stat_graduated` (
  `F` tinyint NOT NULL,
  `S` tinyint NOT NULL,
  `zajavi_ot_nas` tinyint NOT NULL,
  `ludi_ot_nas` tinyint NOT NULL,
  `zajavi_ne_ot_nas` tinyint NOT NULL,
  `ludi_ne_ot_nas` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `stat_graduated_by_f`
--

DROP TABLE IF EXISTS `stat_graduated_by_f`;
/*!50001 DROP VIEW IF EXISTS `stat_graduated_by_f`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `stat_graduated_by_f` (
  `cnt` tinyint NOT NULL,
  `Fakultet` tinyint NOT NULL,
  `cnt_our` tinyint NOT NULL,
  `cnt_ano` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `streettypes`
--

DROP TABLE IF EXISTS `streettypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `streettypes` (
  `idStreetTypes` int(11) NOT NULL,
  `StreetTypesFullName` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `StreetTypesShortName` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idStreetTypes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `studyperiods`
--

DROP TABLE IF EXISTS `studyperiods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studyperiods` (
  `idStudyPeriod` int(11) NOT NULL AUTO_INCREMENT,
  `StudyPeriodName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idStudyPeriod`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects` (
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

DROP TABLE IF EXISTS `sys_departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_departments` (
  `idDepartment` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idDepartment`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sys_pk`
--

DROP TABLE IF EXISTS `sys_pk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_pk` (
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sys_roleassignments`
--

DROP TABLE IF EXISTS `sys_roleassignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_roleassignments` (
  `itemname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `userid` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bizrule` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `sys_roleassignments_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `sys_roles` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sys_rolechildren`
--

DROP TABLE IF EXISTS `sys_rolechildren`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_rolechildren` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `sys_rolechildren_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `sys_roles` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sys_rolechildren_ibfk_2` FOREIGN KEY (`child`) REFERENCES `sys_roles` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sys_roles`
--

DROP TABLE IF EXISTS `sys_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_roles` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
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

DROP TABLE IF EXISTS `sys_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `SysPkID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `table_personspec_all`
--

DROP TABLE IF EXISTS `table_personspec_all`;
/*!50001 DROP VIEW IF EXISTS `table_personspec_all`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `table_personspec_all` (
  `SpecialityClasifierCode` tinyint NOT NULL,
  `Snm` tinyint NOT NULL,
  `idPersonSpeciality` tinyint NOT NULL,
  `CourseName` tinyint NOT NULL,
  `PersonEducationFormName` tinyint NOT NULL,
  `QualificationName` tinyint NOT NULL,
  `PIB` tinyint NOT NULL,
  `edboID` tinyint NOT NULL,
  `Req` tinyint NOT NULL,
  `RequestStatusName` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `table_personspec_today`
--

DROP TABLE IF EXISTS `table_personspec_today`;
/*!50001 DROP VIEW IF EXISTS `table_personspec_today`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `table_personspec_today` (
  `SpecialityClasifierCode` tinyint NOT NULL,
  `Snm` tinyint NOT NULL,
  `idPersonSpeciality` tinyint NOT NULL,
  `CourseName` tinyint NOT NULL,
  `PersonEducationFormName` tinyint NOT NULL,
  `QualificationName` tinyint NOT NULL,
  `PIB` tinyint NOT NULL,
  `edboID` tinyint NOT NULL,
  `Req` tinyint NOT NULL,
  `RequestStatusName` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `temp`
--

DROP TABLE IF EXISTS `temp`;
/*!50001 DROP VIEW IF EXISTS `temp`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `temp` (
  `Specialnost` tinyint NOT NULL,
  `FIO` tinyint NOT NULL,
  `NOMER` tinyint NOT NULL,
  `CreateDate` tinyint NOT NULL,
  `Modified` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `tvorchij_konkurs`
--

DROP TABLE IF EXISTS `tvorchij_konkurs`;
/*!50001 DROP VIEW IF EXISTS `tvorchij_konkurs`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `tvorchij_konkurs` (
  `NOMER_OSOBOVOJI_SPPRAVY` tinyint NOT NULL,
  `PIB` tinyint NOT NULL,
  `FAKULTET` tinyint NOT NULL,
  `SPECIALNIST` tinyint NOT NULL,
  `FORMA_NAVCHANNJA` tinyint NOT NULL,
  `edboID` tinyint NOT NULL,
  `STATUS_ZAJAVKY` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `universities`
--

DROP TABLE IF EXISTS `universities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `universities` (
  `idUniversity` int(11) NOT NULL AUTO_INCREMENT,
  `UniversityKode` varchar(36) COLLATE utf8_unicode_ci NOT NULL COMMENT 'GUID НЗ',
  `UniversityName` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Повна назва НЗ',
  PRIMARY KEY (`idUniversity`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Перелік НЗ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `village_list`
--

DROP TABLE IF EXISTS `village_list`;
/*!50001 DROP VIEW IF EXISTS `village_list`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `village_list` (
  `surname` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `fartherName` tinyint NOT NULL,
  `edbo` tinyint NOT NULL,
  `place` tinyint NOT NULL,
  `OKR` tinyint NOT NULL,
  `region` tinyint NOT NULL,
  `city` tinyint NOT NULL,
  `cityVillage` tinyint NOT NULL,
  `spec` tinyint NOT NULL,
  `edu_form` tinyint NOT NULL,
  `status` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vypuskniki_ano_by_f`
--

DROP TABLE IF EXISTS `vypuskniki_ano_by_f`;
/*!50001 DROP VIEW IF EXISTS `vypuskniki_ano_by_f`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vypuskniki_ano_by_f` (
  `Fakultet` tinyint NOT NULL,
  `cnt_ano` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vypuskniki_ne_ot_nas_stat`
--

DROP TABLE IF EXISTS `vypuskniki_ne_ot_nas_stat`;
/*!50001 DROP VIEW IF EXISTS `vypuskniki_ne_ot_nas_stat`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vypuskniki_ne_ot_nas_stat` (
  `Specialnost` tinyint NOT NULL,
  `kol_zajav` tinyint NOT NULL,
  `kol_person` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vypuskniki_stat`
--

DROP TABLE IF EXISTS `vypuskniki_stat`;
/*!50001 DROP VIEW IF EXISTS `vypuskniki_stat`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vypuskniki_stat` (
  `Specialnost` tinyint NOT NULL,
  `kol_zajav` tinyint NOT NULL,
  `kol_person` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vypuskniki_statx`
--

DROP TABLE IF EXISTS `vypuskniki_statx`;
/*!50001 DROP VIEW IF EXISTS `vypuskniki_statx`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vypuskniki_statx` (
  `Fakultet` tinyint NOT NULL,
  `Specialnost` tinyint NOT NULL,
  `vypusknik` tinyint NOT NULL,
  `kem_vydan_diplom` tinyint NOT NULL,
  `FacultyGraduated` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `znolevels`
--

DROP TABLE IF EXISTS `znolevels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `znolevels` (
  `idLevel` int(11) NOT NULL AUTO_INCREMENT,
  `LevelName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idLevel`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Final view structure for view `all_bachelors`
--

/*!50001 DROP TABLE IF EXISTS `all_bachelors`*/;
/*!50001 DROP VIEW IF EXISTS `all_bachelors`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `all_bachelors` AS select concat_ws(' ',(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `Specialnost`,`personspeciality`.`edboID` AS `edboID`,concat_ws('+',if(isnull((select if(isnull(`documentsubject`.`SubjectValue`),0.0,`documentsubject`.`SubjectValue`) from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject1`) limit 1)),0.0,(select if(isnull(`documentsubject`.`SubjectValue`),0.0,`documentsubject`.`SubjectValue`) from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject1`) limit 1)),if(isnull((select if(isnull(`documentsubject`.`SubjectValue`),0.0,`documentsubject`.`SubjectValue`) from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject2`) limit 1)),0.0,(select if(isnull(`documentsubject`.`SubjectValue`),0.0,`documentsubject`.`SubjectValue`) from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject2`) limit 1)),if(isnull((select if(isnull(`documentsubject`.`SubjectValue`),0.0,`documentsubject`.`SubjectValue`) from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject3`) limit 1)),0.0,(select if(isnull(`documentsubject`.`SubjectValue`),0.0,`documentsubject`.`SubjectValue`) from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject3`) limit 1)),if(isnull(`personspeciality`.`AdditionalBall`),0.0,`personspeciality`.`AdditionalBall`),if(isnull(`personspeciality`.`CoursedpBall`),0.0,`personspeciality`.`CoursedpBall`),if(isnull(`olympiadsawards`.`OlympiadAwardBonus`),0.0,`olympiadsawards`.`OlympiadAwardBonus`),if(isnull(`documents`.`AtestatValue`),0.0,if(isnull(`atestatvalue`.`ZnoValue`),0.0,round(`atestatvalue`.`ZnoValue`,2))),if(isnull(`personspeciality`.`Exam1Ball`),0.0,`personspeciality`.`Exam1Ball`),if(isnull(`personspeciality`.`Exam2Ball`),0.0,`personspeciality`.`Exam2Ball`),if(isnull(`personspeciality`.`Exam3Ball`),0.0,`personspeciality`.`Exam3Ball`)) AS `BalDetail`,((((((if(isnull((select if(isnull(`documentsubject`.`SubjectValue`),0.0,`documentsubject`.`SubjectValue`) from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject1`) limit 1)),0.0,(select if(isnull(`documentsubject`.`SubjectValue`),0.0,`documentsubject`.`SubjectValue`) from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject1`) limit 1)) + if(isnull((select if(isnull(`documentsubject`.`SubjectValue`),0.0,`documentsubject`.`SubjectValue`) from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject2`) limit 1)),0.0,(select if(isnull(`documentsubject`.`SubjectValue`),0.0,`documentsubject`.`SubjectValue`) from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject2`) limit 1))) + if(isnull((select if(isnull(`documentsubject`.`SubjectValue`),0.0,`documentsubject`.`SubjectValue`) from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject3`) limit 1)),0.0,(select if(isnull(`documentsubject`.`SubjectValue`),0.0,`documentsubject`.`SubjectValue`) from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject3`) limit 1))) + if(isnull(`personspeciality`.`AdditionalBall`),0.0,`personspeciality`.`AdditionalBall`)) + if(isnull(`personspeciality`.`CoursedpBall`),0.0,`personspeciality`.`CoursedpBall`)) + if(isnull(`olympiadsawards`.`OlympiadAwardBonus`),0.0,`olympiadsawards`.`OlympiadAwardBonus`)) + if(isnull(`documents`.`AtestatValue`),0.0,(((if(isnull(`atestatvalue`.`ZnoValue`),0.0,round(`atestatvalue`.`ZnoValue`,2)) + if(isnull(`personspeciality`.`Exam1Ball`),0.0,`personspeciality`.`Exam1Ball`)) + if(isnull(`personspeciality`.`Exam2Ball`),0.0,`personspeciality`.`Exam2Ball`)) + if(isnull(`personspeciality`.`Exam3Ball`),0.0,`personspeciality`.`Exam3Ball`)))) AS `sumBall`,`person`.`LastName` AS `LastName`,`person`.`FirstName` AS `FirstName`,`person`.`MiddleName` AS `MiddleName`,(case when (isnull(`benefit`.`isPZK`) or (sum(`benefit`.`isPZK`) = 0)) then '-' else '+' end) AS `PozaKonkursom`,sum(`benefit`.`isPZK`) AS `isPZK`,(case when (isnull(`benefit`.`isPV`) or (sum(`benefit`.`isPV`) = 0)) then '-' else '+' end) AS `Pozacherg`,sum(`benefit`.`isPV`) AS `isPV`,(case when (`personspeciality`.`isCopyEntrantDoc` = 0) then '+' else '-' end) AS `Orig`,concat((case when (`personspeciality`.`QualificationID` = 1) then 'Б' when (`personspeciality`.`QualificationID` = 2) then 'СМ' when (`personspeciality`.`QualificationID` = 3) then 'СМ' when (`personspeciality`.`QualificationID` = 4) then 'МС' end),`personspeciality`.`CourseID`,'-',(case when (`personspeciality`.`PersonRequestNumber` >= 10000) then `personspeciality`.`PersonRequestNumber` when ((`personspeciality`.`PersonRequestNumber` >= 1000) and (`personspeciality`.`PersonRequestNumber` < 10000)) then concat('0',`personspeciality`.`PersonRequestNumber`) when ((`personspeciality`.`PersonRequestNumber` >= 100) and (`personspeciality`.`PersonRequestNumber` < 1000)) then concat('00',`personspeciality`.`PersonRequestNumber`) when ((`personspeciality`.`PersonRequestNumber` >= 10) and (`personspeciality`.`PersonRequestNumber` < 100)) then concat('000',`personspeciality`.`PersonRequestNumber`) when ((`personspeciality`.`PersonRequestNumber` >= 0) and (`personspeciality`.`PersonRequestNumber` < 10)) then concat('0000',`personspeciality`.`PersonRequestNumber`) end)) AS `Nomer_lichnogo_dela`,`personspeciality`.`RequestFromEB` AS `isElectro`,`personspeciality`.`StatusID` AS `Status` from (((((((`personspeciality` left join `person` on((`person`.`idPerson` = `personspeciality`.`PersonID`))) left join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) left join `documents` on((`documents`.`PersonID` = `personspeciality`.`PersonID`))) left join `olympiadsawards` on((`olympiadsawards`.`OlympiadAwardID` = `personspeciality`.`OlympiadID`))) left join `atestatvalue` on((`atestatvalue`.`AtestatValue` = `documents`.`AtestatValue`))) left join `personbenefits` on((`personspeciality`.`PersonID` = `personbenefits`.`PersonID`))) left join `benefit` on((`personbenefits`.`BenefitID` = `benefit`.`idBenefit`))) where ((`personspeciality`.`QualificationID` = 1) and (`personspeciality`.`EducationFormID` in (1,2)) and (`documents`.`TypeID` = 2) and (`personspeciality`.`StatusID` not in (2,3,10))) group by `personspeciality`.`edboID` order by concat_ws(' ',(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)),((((((if(isnull((select if(isnull(`documentsubject`.`SubjectValue`),0.0,`documentsubject`.`SubjectValue`) from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject1`) limit 1)),0.0,(select if(isnull(`documentsubject`.`SubjectValue`),0.0,`documentsubject`.`SubjectValue`) from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject1`) limit 1)) + if(isnull((select if(isnull(`documentsubject`.`SubjectValue`),0.0,`documentsubject`.`SubjectValue`) from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject2`) limit 1)),0.0,(select if(isnull(`documentsubject`.`SubjectValue`),0.0,`documentsubject`.`SubjectValue`) from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject2`) limit 1))) + if(isnull((select if(isnull(`documentsubject`.`SubjectValue`),0.0,`documentsubject`.`SubjectValue`) from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject3`) limit 1)),0.0,(select if(isnull(`documentsubject`.`SubjectValue`),0.0,`documentsubject`.`SubjectValue`) from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject3`) limit 1))) + if(isnull(`personspeciality`.`AdditionalBall`),0.0,`personspeciality`.`AdditionalBall`)) + if(isnull(`personspeciality`.`CoursedpBall`),0.0,`personspeciality`.`CoursedpBall`)) + if(isnull(`olympiadsawards`.`OlympiadAwardBonus`),0.0,`olympiadsawards`.`OlympiadAwardBonus`)) + if(isnull(`documents`.`AtestatValue`),0.0,(((if(isnull(`atestatvalue`.`ZnoValue`),0.0,round(`atestatvalue`.`ZnoValue`,2)) + if(isnull(`personspeciality`.`Exam1Ball`),0.0,`personspeciality`.`Exam1Ball`)) + if(isnull(`personspeciality`.`Exam2Ball`),0.0,`personspeciality`.`Exam2Ball`)) + if(isnull(`personspeciality`.`Exam3Ball`),0.0,`personspeciality`.`Exam3Ball`)))) desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `all_counts`
--

/*!50001 DROP TABLE IF EXISTS `all_counts`*/;
/*!50001 DROP VIEW IF EXISTS `all_counts`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `all_counts` AS select distinct group_concat(concat_ws('_',`specialities`.`idSpeciality`,`specialities`.`PersonEducationFormID`) separator ',') AS `ID`,`facultets`.`FacultetFullName` AS `Fakultet`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `Specialnost`,(case when (`cnt_dnevn_view`.`cnt_dnevn` is not null) then `cnt_dnevn_view`.`cnt_dnevn` else '0' end) AS `dnevn`,(case when (`cnt_dnevn_budget_view`.`cnt_dnevn_budget` is not null) then `cnt_dnevn_budget_view`.`cnt_dnevn_budget` else '0' end) AS `dnevn_budget`,(case when (`cnt_dnevn_contract_view`.`cnt_dnevn_contract` is not null) then `cnt_dnevn_contract_view`.`cnt_dnevn_contract` else '0' end) AS `dnevn_contract`,(case when (`cnt_dnevn_pv_view`.`cnt_dnevn_pv` is not null) then `cnt_dnevn_pv_view`.`cnt_dnevn_pv` else '0' end) AS `dnevn_pv`,(case when (`cnt_dnevn_pzk_view`.`cnt_dnevn_pzk` is not null) then `cnt_dnevn_pzk_view`.`cnt_dnevn_pzk` else '0' end) AS `dnevn_pzk`,(case when (`cnt_dnevn_originals_view`.`cnt_dnevn_originals` is not null) then `cnt_dnevn_originals_view`.`cnt_dnevn_originals` else '0' end) AS `dnevn_originals`,(case when (`cnt_dnevn_electro_view`.`cnt_dnevn_electro` is not null) then `cnt_dnevn_electro_view`.`cnt_dnevn_electro` else '0' end) AS `dnevn_electro`,(case when (`cnt_dnevn_budgetcount_view`.`cnt_dnevn_budgetcount` is not null) then `cnt_dnevn_budgetcount_view`.`cnt_dnevn_budgetcount` else '0' end) AS `cnt_dnevn_budgetcount_view`,(case when (`cnt_dnevn_contractcount_view`.`cnt_dnevn_contractcount` is not null) then `cnt_dnevn_contractcount_view`.`cnt_dnevn_contractcount` else '0' end) AS `cnt_dnevn_contractcount_view`,(case when (`cnt_zaoch_view`.`cnt_zaoch` is not null) then `cnt_zaoch_view`.`cnt_zaoch` else '0' end) AS `zaoch`,(case when (`cnt_zaoch_budget_view`.`cnt_zaoch_budget` is not null) then `cnt_zaoch_budget_view`.`cnt_zaoch_budget` else '0' end) AS `zaoch_budget`,(case when (`cnt_zaoch_contract_view`.`cnt_zaoch_contract` is not null) then `cnt_zaoch_contract_view`.`cnt_zaoch_contract` else '0' end) AS `zaoch_contract`,(case when (`cnt_zaoch_pv_view`.`cnt_zaoch_pv` is not null) then `cnt_zaoch_pv_view`.`cnt_zaoch_pv` else '0' end) AS `zaoch_pv`,(case when (`cnt_zaoch_pzk_view`.`cnt_zaoch_pzk` is not null) then `cnt_zaoch_pzk_view`.`cnt_zaoch_pzk` else '0' end) AS `zaoch_pzk`,(case when (`cnt_zaoch_originals_view`.`cnt_zaoch_originals` is not null) then `cnt_zaoch_originals_view`.`cnt_zaoch_originals` else '0' end) AS `zaoch_originals`,(case when (`cnt_zaoch_electro_view`.`cnt_zaoch_electro` is not null) then `cnt_zaoch_electro_view`.`cnt_zaoch_electro` else '0' end) AS `zaoch_electro`,(case when (`cnt_zaoch_budgetcount_view`.`cnt_zaoch_budgetcount` is not null) then `cnt_zaoch_budgetcount_view`.`cnt_zaoch_budgetcount` else '0' end) AS `cnt_zaoch_budgetcount_view`,(case when (`cnt_zaoch_contractcount_view`.`cnt_zaoch_contractcount` is not null) then `cnt_zaoch_contractcount_view`.`cnt_zaoch_contractcount` else '0' end) AS `cnt_zaoch_contractcount_view`,(case when (`cnt_medals_view`.`cnt_medals` is not null) then `cnt_medals_view`.`cnt_medals` else '0' end) AS `medals` from ((((((((((((((((((((`facultets` join `specialities` on((`facultets`.`idFacultet` = `specialities`.`FacultetID`))) left join `cnt_dnevn_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_dnevn_view`.`_Specialnost`))) left join `cnt_dnevn_budget_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_dnevn_budget_view`.`_Specialnost`))) left join `cnt_dnevn_contract_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_dnevn_contract_view`.`_Specialnost`))) left join `cnt_dnevn_pv_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_dnevn_pv_view`.`_Specialnost`))) left join `cnt_dnevn_pzk_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_dnevn_pzk_view`.`_Specialnost`))) left join `cnt_dnevn_originals_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_dnevn_originals_view`.`_Specialnost`))) left join `cnt_dnevn_electro_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_dnevn_electro_view`.`_Specialnost`))) left join `cnt_zaoch_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_zaoch_view`.`_Specialnost`))) left join `cnt_zaoch_budget_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_zaoch_budget_view`.`_Specialnost`))) left join `cnt_zaoch_contract_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_zaoch_contract_view`.`_Specialnost`))) left join `cnt_zaoch_pv_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_zaoch_pv_view`.`_Specialnost`))) left join `cnt_zaoch_pzk_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_zaoch_pzk_view`.`_Specialnost`))) left join `cnt_zaoch_originals_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_zaoch_originals_view`.`_Specialnost`))) left join `cnt_zaoch_electro_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_zaoch_electro_view`.`_Specialnost`))) left join `cnt_medals_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_medals_view`.`_Specialnost`))) left join `cnt_dnevn_budgetcount_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_dnevn_budgetcount_view`.`_Specialnost`))) left join `cnt_zaoch_budgetcount_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_zaoch_budgetcount_view`.`_Specialnost`))) left join `cnt_dnevn_contractcount_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_dnevn_contractcount_view`.`_Specialnost`))) left join `cnt_zaoch_contractcount_view` on((concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) = `cnt_zaoch_contractcount_view`.`_Specialnost`))) group by concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) order by `facultets`.`FacultetFullName`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `all_counts_per_dates`
--

/*!50001 DROP TABLE IF EXISTS `all_counts_per_dates`*/;
/*!50001 DROP VIEW IF EXISTS `all_counts_per_dates`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `all_counts_per_dates` AS select `cnt_left_per_dates_view`.`Fakultet` AS `Fakultet`,`cnt_left_per_dates_view`.`Specialnost` AS `Specialnost`,(case when isnull(`cnt_dnevn_per_dates_view`.`cnt_dnevn`) then '0' else `cnt_dnevn_per_dates_view`.`cnt_dnevn` end) AS `dnevn`,(case when isnull(`cnt_zaoch_per_dates_view`.`cnt_zaoch`) then '0' else `cnt_zaoch_per_dates_view`.`cnt_zaoch` end) AS `zaoch` from ((`cnt_left_per_dates_view` left join `cnt_dnevn_per_dates_view` on((`cnt_left_per_dates_view`.`Specialnost` = `cnt_dnevn_per_dates_view`.`_Specialnost`))) left join `cnt_zaoch_per_dates_view` on((`cnt_left_per_dates_view`.`Specialnost` = `cnt_zaoch_per_dates_view`.`_Specialnost`))) order by `cnt_left_per_dates_view`.`Fakultet`,`cnt_left_per_dates_view`.`Specialnost` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `all_specialities`
--

/*!50001 DROP TABLE IF EXISTS `all_specialities`*/;
/*!50001 DROP VIEW IF EXISTS `all_specialities`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `all_specialities` AS select distinct `facultets`.`FacultetFullName` AS `F`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `S` from (`specialities` left join `facultets` on((`facultets`.`idFacultet` = `specialities`.`FacultetID`))) order by `facultets`.`FacultetFullName` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

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
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `benefitinfo` AS select `benefit`.`idBenefit` AS `idBenefit`,`benefit`.`BenefitName` AS `BenefitName`,`benefit`.`BenefitKey` AS `BenefitKey`,`benefitsgroups`.`BenefitsGroupsName` AS `BenefitsGroupsName` from (`benefit` join `benefitsgroups` on((`benefit`.`BenefitGroupID` = `benefitsgroups`.`idBenefitsGroups`))) order by `benefit`.`BenefitName` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_dnevn_budget_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_dnevn_budget_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_budget_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_dnevn_budget_view` AS select `specialities`.`SpecialityClasifierCode` AS `SpecialityClasifierCode`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`personspeciality`.`SepcialityID` AS `SepcialityID`,count(distinct `personspeciality`.`idPersonSpeciality`) AS `cnt_dnevn_budget` from (`personspeciality` join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) where ((`personspeciality`.`StatusID` <> 10) and (`personspeciality`.`EducationFormID` = 1) and (`personspeciality`.`isBudget` = 1)) group by `personspeciality`.`SepcialityID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_dnevn_budgetcount_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_dnevn_budgetcount_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_budgetcount_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_dnevn_budgetcount_view` AS select concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`specialities`.`SpecialityBudgetCount` AS `cnt_dnevn_budgetcount` from `specialities` where (1 and (`specialities`.`PersonEducationFormID` = 1)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_dnevn_contract_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_dnevn_contract_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_contract_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_dnevn_contract_view` AS select `specialities`.`SpecialityClasifierCode` AS `SpecialityClasifierCode`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`personspeciality`.`SepcialityID` AS `SepcialityID`,count(distinct `personspeciality`.`idPersonSpeciality`) AS `cnt_dnevn_contract` from (`personspeciality` join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) where ((`personspeciality`.`StatusID` <> 10) and (`personspeciality`.`EducationFormID` = 1) and (`personspeciality`.`isContract` = 1)) group by `personspeciality`.`SepcialityID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_dnevn_contractcount_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_dnevn_contractcount_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_contractcount_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_dnevn_contractcount_view` AS select concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`specialities`.`SpecialityContractCount` AS `cnt_dnevn_contractcount` from `specialities` where (1 and (`specialities`.`PersonEducationFormID` = 1)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_dnevn_electro_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_dnevn_electro_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_electro_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_dnevn_electro_view` AS select `specialities`.`SpecialityClasifierCode` AS `SpecialityClasifierCode`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`personspeciality`.`SepcialityID` AS `SepcialityID`,count(distinct `personspeciality`.`idPersonSpeciality`) AS `cnt_dnevn_electro` from (`personspeciality` join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) where ((`personspeciality`.`StatusID` <> 10) and (`personspeciality`.`EducationFormID` = 1) and (`personspeciality`.`RequestFromEB` = 1)) group by `personspeciality`.`SepcialityID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_dnevn_originals_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_dnevn_originals_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_originals_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_dnevn_originals_view` AS select `specialities`.`SpecialityClasifierCode` AS `SpecialityClasifierCode`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`personspeciality`.`SepcialityID` AS `SepcialityID`,count(distinct `personspeciality`.`idPersonSpeciality`) AS `cnt_dnevn_originals` from (`personspeciality` join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) where ((`personspeciality`.`StatusID` <> 10) and (`personspeciality`.`EducationFormID` = 1) and (`personspeciality`.`isCopyEntrantDoc` = 0)) group by `personspeciality`.`SepcialityID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_dnevn_per_dates_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_dnevn_per_dates_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_per_dates_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_dnevn_per_dates_view` AS select concat_ws('_',concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)),substr(`personspeciality`.`CreateDate`,1,10)) AS `_Specialnost`,count(distinct `personspeciality`.`idPersonSpeciality`) AS `cnt_dnevn` from (`personspeciality` join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) where ((`personspeciality`.`StatusID` <> 10) and (`personspeciality`.`EducationFormID` = 1)) group by substr(`personspeciality`.`CreateDate`,1,10),`personspeciality`.`SepcialityID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_dnevn_pv_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_dnevn_pv_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_pv_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_dnevn_pv_view` AS select `specialities`.`SpecialityClasifierCode` AS `SpecialityClasifierCode`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`personspeciality`.`SepcialityID` AS `SepcialityID`,count(distinct `personspeciality`.`idPersonSpeciality`) AS `cnt_dnevn_pv` from (((`personspeciality` join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) left join `personbenefits` on((`personspeciality`.`PersonID` = `personbenefits`.`PersonID`))) left join `benefit` on((`benefit`.`idBenefit` = `personbenefits`.`BenefitID`))) where ((`personspeciality`.`StatusID` <> 10) and (`personspeciality`.`EducationFormID` = 1) and (`benefit`.`isPV` = 1) and (`benefit`.`isPZK` = 0)) group by `personspeciality`.`SepcialityID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_dnevn_pzk_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_dnevn_pzk_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_pzk_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_dnevn_pzk_view` AS select `specialities`.`SpecialityClasifierCode` AS `SpecialityClasifierCode`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`personspeciality`.`SepcialityID` AS `SepcialityID`,count(distinct `personspeciality`.`idPersonSpeciality`) AS `cnt_dnevn_pzk` from (((`personspeciality` join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) left join `personbenefits` on((`personspeciality`.`PersonID` = `personbenefits`.`PersonID`))) left join `benefit` on((`benefit`.`idBenefit` = `personbenefits`.`BenefitID`))) where ((`personspeciality`.`StatusID` <> 10) and (`personspeciality`.`EducationFormID` = 1) and (`benefit`.`isPV` = 0) and (`benefit`.`isPZK` = 1)) group by `personspeciality`.`SepcialityID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_dnevn_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_dnevn_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_dnevn_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_dnevn_view` AS select `specialities`.`SpecialityClasifierCode` AS `SpecialityClasifierCode`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`personspeciality`.`SepcialityID` AS `SepcialityID`,count(distinct `personspeciality`.`idPersonSpeciality`) AS `cnt_dnevn` from (`personspeciality` join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) where ((`personspeciality`.`StatusID` <> 10) and (`personspeciality`.`EducationFormID` = 1)) group by `personspeciality`.`SepcialityID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_left_per_dates_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_left_per_dates_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_left_per_dates_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_left_per_dates_view` AS select distinct concat_ws('_',concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)),`all_dates`.`cdate`) AS `Specialnost`,`facultets`.`FacultetFullName` AS `Fakultet` from ((`specialities` join `facultets` on((`specialities`.`FacultetID` = `facultets`.`idFacultet`))) join `all_dates` on(1)) where 1 group by concat_ws('_',concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)),`all_dates`.`cdate`) order by `facultets`.`FacultetFullName` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_medals_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_medals_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_medals_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_medals_view` AS select `specialities`.`SpecialityClasifierCode` AS `SpecialityClasifierCode`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`personspeciality`.`SepcialityID` AS `SepcialityID`,count(distinct `personspeciality`.`idPersonSpeciality`) AS `cnt_medals` from ((`personspeciality` join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) left join `personbenefits` on((`personspeciality`.`PersonID` = `personbenefits`.`PersonID`))) where ((`personspeciality`.`StatusID` <> 10) and (`personbenefits`.`BenefitID` = 39)) group by concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_zaoch_budget_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_zaoch_budget_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_budget_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_zaoch_budget_view` AS select `specialities`.`SpecialityClasifierCode` AS `SpecialityClasifierCode`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`personspeciality`.`SepcialityID` AS `SepcialityID`,count(distinct `personspeciality`.`idPersonSpeciality`) AS `cnt_zaoch_budget` from (`personspeciality` join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) where ((`personspeciality`.`StatusID` <> 10) and (`personspeciality`.`EducationFormID` = 2) and (`personspeciality`.`isBudget` = 1)) group by `personspeciality`.`SepcialityID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_zaoch_budgetcount_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_zaoch_budgetcount_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_budgetcount_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_zaoch_budgetcount_view` AS select concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`specialities`.`SpecialityBudgetCount` AS `cnt_zaoch_budgetcount` from `specialities` where (1 and (`specialities`.`PersonEducationFormID` = 2)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_zaoch_contract_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_zaoch_contract_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_contract_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_zaoch_contract_view` AS select `specialities`.`SpecialityClasifierCode` AS `SpecialityClasifierCode`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`personspeciality`.`SepcialityID` AS `SepcialityID`,count(distinct `personspeciality`.`idPersonSpeciality`) AS `cnt_zaoch_contract` from (`personspeciality` join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) where ((`personspeciality`.`StatusID` <> 10) and (`personspeciality`.`EducationFormID` = 2) and (`personspeciality`.`isContract` = 1)) group by `personspeciality`.`SepcialityID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_zaoch_contractcount_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_zaoch_contractcount_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_contractcount_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_zaoch_contractcount_view` AS select concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`specialities`.`SpecialityContractCount` AS `cnt_zaoch_contractcount` from `specialities` where (1 and (`specialities`.`PersonEducationFormID` = 2)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_zaoch_electro_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_zaoch_electro_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_electro_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_zaoch_electro_view` AS select `specialities`.`SpecialityClasifierCode` AS `SpecialityClasifierCode`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`personspeciality`.`SepcialityID` AS `SepcialityID`,count(distinct `personspeciality`.`idPersonSpeciality`) AS `cnt_zaoch_electro` from (`personspeciality` join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) where ((`personspeciality`.`StatusID` <> 10) and (`personspeciality`.`EducationFormID` = 2) and (`personspeciality`.`RequestFromEB` = 1)) group by `personspeciality`.`SepcialityID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_zaoch_originals_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_zaoch_originals_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_originals_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_zaoch_originals_view` AS select `specialities`.`SpecialityClasifierCode` AS `SpecialityClasifierCode`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`personspeciality`.`SepcialityID` AS `SepcialityID`,count(distinct `personspeciality`.`idPersonSpeciality`) AS `cnt_zaoch_originals` from (`personspeciality` join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) where ((`personspeciality`.`StatusID` <> 10) and (`personspeciality`.`EducationFormID` = 2) and (`personspeciality`.`isCopyEntrantDoc` = 0)) group by `personspeciality`.`SepcialityID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_zaoch_per_dates_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_zaoch_per_dates_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_per_dates_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_zaoch_per_dates_view` AS select concat_ws('_',concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)),substr(`personspeciality`.`CreateDate`,1,10)) AS `_Specialnost`,`personspeciality`.`SepcialityID` AS `SepcialityID`,count(distinct `personspeciality`.`idPersonSpeciality`) AS `cnt_zaoch` from (`personspeciality` join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) where ((`personspeciality`.`StatusID` <> 10) and (`personspeciality`.`EducationFormID` = 2)) group by substr(`personspeciality`.`CreateDate`,1,10),`personspeciality`.`SepcialityID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_zaoch_pv_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_zaoch_pv_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_pv_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_zaoch_pv_view` AS select `specialities`.`SpecialityClasifierCode` AS `SpecialityClasifierCode`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`personspeciality`.`SepcialityID` AS `SepcialityID`,count(distinct `personspeciality`.`idPersonSpeciality`) AS `cnt_zaoch_pv` from (((`personspeciality` join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) left join `personbenefits` on((`personspeciality`.`PersonID` = `personbenefits`.`PersonID`))) left join `benefit` on((`benefit`.`idBenefit` = `personbenefits`.`BenefitID`))) where ((`personspeciality`.`StatusID` <> 10) and (`personspeciality`.`EducationFormID` = 2) and (`benefit`.`isPV` = 1) and (`benefit`.`isPZK` = 0)) group by `personspeciality`.`SepcialityID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_zaoch_pzk_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_zaoch_pzk_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_pzk_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_zaoch_pzk_view` AS select `specialities`.`SpecialityClasifierCode` AS `SpecialityClasifierCode`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`personspeciality`.`SepcialityID` AS `SepcialityID`,count(distinct `personspeciality`.`idPersonSpeciality`) AS `cnt_zaoch_pzk` from (((`personspeciality` join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) left join `personbenefits` on((`personspeciality`.`PersonID` = `personbenefits`.`PersonID`))) left join `benefit` on((`benefit`.`idBenefit` = `personbenefits`.`BenefitID`))) where ((`personspeciality`.`StatusID` <> 10) and (`personspeciality`.`EducationFormID` = 2) and (`benefit`.`isPV` = 0) and (`benefit`.`isPZK` = 1)) group by `personspeciality`.`SepcialityID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cnt_zaoch_view`
--

/*!50001 DROP TABLE IF EXISTS `cnt_zaoch_view`*/;
/*!50001 DROP VIEW IF EXISTS `cnt_zaoch_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cnt_zaoch_view` AS select `specialities`.`SpecialityClasifierCode` AS `SpecialityClasifierCode`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `_Specialnost`,`personspeciality`.`SepcialityID` AS `SepcialityID`,count(distinct `personspeciality`.`idPersonSpeciality`) AS `cnt_zaoch` from (`personspeciality` join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) where ((`personspeciality`.`StatusID` <> 10) and (`personspeciality`.`EducationFormID` = 2)) group by `personspeciality`.`SepcialityID` */;
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
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
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
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `educationtypeclass` AS select `educationtype`.`idEducationType` AS `idEducationType`,`educationtype`.`EducationTypeFullName` AS `EducationTypeFullName`,`educationtype`.`EducationTypeShortName` AS `EducationTypeShortName`,`educationclass`.`EducationClassName` AS `EducationClassName` from (`educationtype` join `educationclass` on((`educationtype`.`EducationTypeClassID` = `educationclass`.`idEducationClass`))) order by `educationtype`.`EducationTypeFullName` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `examinations_without_zno`
--

/*!50001 DROP TABLE IF EXISTS `examinations_without_zno`*/;
/*!50001 DROP VIEW IF EXISTS `examinations_without_zno`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `examinations_without_zno` AS select `person`.`idPerson` AS `idPersonMySql`,`person`.`edboID` AS `idPersonEdbo`,concat(`person`.`LastName`,' ',`person`.`FirstName`,' ',`person`.`MiddleName`) AS `FIO`,concat(`specialities`.`SpecialityClasifierCode`,': ',`specialities`.`SpecialityName`,' ',`specialities`.`SpecialityDirectionName`,' ',`specialities`.`SpecialitySpecializationName`) AS `Speciality`,(select `subjects`.`SubjectName` from `subjects` where (`subjects`.`idSubjects` = `personspeciality`.`Exam1ID`)) AS `Examination1`,(select `subjects`.`SubjectName` from `subjects` where (`subjects`.`idSubjects` = `personspeciality`.`Exam2ID`)) AS `Examination2`,(select `subjects`.`SubjectName` from `subjects` where (`subjects`.`idSubjects` = `personspeciality`.`Exam3ID`)) AS `Examination3`,`personeducationforms`.`PersonEducationFormName` AS `educationFormName`,`personspeciality`.`EducationFormID` AS `idEducationForm` from (((`person` join `personspeciality` on((`person`.`idPerson` = `personspeciality`.`PersonID`))) join `specialities` on((`personspeciality`.`SepcialityID` = `specialities`.`idSpeciality`))) join `personeducationforms` on((`personspeciality`.`EducationFormID` = `personeducationforms`.`idPersonEducationForm`))) where ((`personspeciality`.`QualificationID` = 1) and ((`personspeciality`.`Exam1ID` is not null) or (`personspeciality`.`Exam2ID` is not null) or (`personspeciality`.`Exam3ID` is not null)) and ((`personspeciality`.`Exam1ID` is not null) or (`personspeciality`.`Exam2ID` is not null) or (`personspeciality`.`Exam3ID` <> 34))) order by concat(`specialities`.`SpecialityClasifierCode`,': ',`specialities`.`SpecialityName`,' ',`specialities`.`SpecialityDirectionName`,' ',`specialities`.`SpecialitySpecializationName`),concat(`person`.`LastName`,' ',`person`.`FirstName`,' ',`person`.`MiddleName`) */;
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
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `graduated_school` AS select distinct `person`.`idPerson` AS `ID_person`,concat_ws(' ',`person`.`LastName`,`person`.`FirstName`,`person`.`MiddleName`) AS `PIB`,`persondocumenttypes`.`PersonDocumentTypesName` AS `doc_type`,`documents`.`Issued` AS `Issued`,substr(`documents`.`DateGet`,1,4) AS `IssuedYear`,if((`documents`.`Issued` like '%вечірн%'),'вечірня школа',if((`documents`.`Issued` like '%коледж%'),'коледж',if((`documents`.`Issued` like '%училище%'),'училище',if(((`documents`.`Issued` like '%ліцей%') or (`documents`.`Issued` like '%ліцеєм%')),'ліцей',if((`documents`.`Issued` like '%гімназ%'),'гімназія',if(((`documents`.`Issued` like '%комплекс%') or (`documents`.`Issued` like '%НВК%')),'навчально-виховний комплекс',if((`documents`.`Issued` like '%колегіум%'),'колегіум',if(((`documents`.`Issued` like '%спеціалізован%') or (`documents`.`Issued` like '%спецшкол%') or (`documents`.`Issued` like '%спец. школа%')),'спеціалізована школа',if((`documents`.`Issued` like '%технікум%'),'технікум',if(((`documents`.`Issued` like '%загальноосвіт%') or (`documents`.`Issued` like '%ЗОШ%') or (`documents`.`Issued` like '%ЗШ%') or (`documents`.`Issued` like '%середн%') or (`documents`.`Issued` like '%Денн%') or (`documents`.`Issued` like '%ЗОСШ%') or (`documents`.`Issued` like '%СШ%')),'загальноосвітня середня школа (денна)',NULL)))))))))) AS `edu_type`,concat_ws(' ',(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end),`specialities`.`SpecialityClasifierCode`) AS `spec`,`personeducationforms`.`PersonEducationFormName` AS `edu_form`,`requeststatus`.`RequestStatusName` AS `status` from ((((((`person` left join `documents` on((`documents`.`PersonID` = `person`.`idPerson`))) join `persondocumenttypes` on((`documents`.`TypeID` = `persondocumenttypes`.`idPersonDocumentTypes`))) left join `personspeciality` on((`personspeciality`.`PersonID` = `person`.`idPerson`))) left join `specialities` on((`personspeciality`.`SepcialityID` = `specialities`.`idSpeciality`))) left join `personeducationforms` on((`specialities`.`PersonEducationFormID` = `personeducationforms`.`idPersonEducationForm`))) left join `requeststatus` on((`personspeciality`.`StatusID` = `requeststatus`.`idRequestStatus`))) where ((`documents`.`TypeID` in (2,10)) and (`personspeciality`.`StatusID` not in (2,3,10)) and (`personspeciality`.`QualificationID` = 1)) order by if((`documents`.`Issued` like '%вечірн%'),'вечірня школа',if((`documents`.`Issued` like '%коледж%'),'коледж',if((`documents`.`Issued` like '%училище%'),'училище',if(((`documents`.`Issued` like '%ліцей%') or (`documents`.`Issued` like '%ліцеєм%')),'ліцей',if((`documents`.`Issued` like '%гімназ%'),'гімназія',if(((`documents`.`Issued` like '%комплекс%') or (`documents`.`Issued` like '%НВК%')),'навчально-виховний комплекс',if((`documents`.`Issued` like '%колегіум%'),'колегіум',if(((`documents`.`Issued` like '%спеціалізован%') or (`documents`.`Issued` like '%спецшкол%') or (`documents`.`Issued` like '%спец. школа%')),'спеціалізована школа',if((`documents`.`Issued` like '%технікум%'),'технікум',if(((`documents`.`Issued` like '%загальноосвіт%') or (`documents`.`Issued` like '%ЗОШ%') or (`documents`.`Issued` like '%ЗШ%') or (`documents`.`Issued` like '%середн%') or (`documents`.`Issued` like '%Денн%') or (`documents`.`Issued` like '%ЗОСШ%') or (`documents`.`Issued` like '%СШ%')),'загальноосвітня середня школа (денна)',NULL)))))))))),concat_ws(' ',`person`.`LastName`,`person`.`FirstName`,`person`.`MiddleName`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `mag_languages`
--

/*!50001 DROP TABLE IF EXISTS `mag_languages`*/;
/*!50001 DROP VIEW IF EXISTS `mag_languages`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `mag_languages` AS select distinct `facultets`.`idFacultet` AS `idFuc`,`specialities`.`SpecialityClasifierCode` AS `SCode`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,if(isnull(`specialities`.`SpecialityDirectionName`),'',`specialities`.`SpecialityDirectionName`),`specialities`.`SpecialitySpecializationName`,`specialities`.`SpecialityName`) AS `spec`,`person`.`idPerson` AS `person_id`,`person`.`LastName` AS `surname`,`person`.`FirstName` AS `name`,`person`.`MiddleName` AS `farthername`,`languages`.`LanguagesName` AS `langName`,(case `specialities`.`PersonEducationFormID` when 1 then 'денна' when 2 then 'заочна' end) AS `eduform` from ((((`personspeciality` left join `person` on((`person`.`idPerson` = `personspeciality`.`PersonID`))) left join `languages` on((`languages`.`idLanguages` = `person`.`LanguageID`))) left join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) left join `facultets` on((`facultets`.`idFacultet` = `specialities`.`FacultetID`))) where ((`personspeciality`.`QualificationID` = 2) and (`personspeciality`.`StatusID` not in (2,3,10)) and 1) order by concat_ws(' ',`specialities`.`SpecialityClasifierCode`,if(isnull(`specialities`.`SpecialityDirectionName`),'',`specialities`.`SpecialityDirectionName`),`specialities`.`SpecialitySpecializationName`,`specialities`.`SpecialityName`),`person`.`LastName`,(case `specialities`.`PersonEducationFormID` when 1 then 'денна' when 2 then 'заочна' end) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `mag_languages_foreign_filology`
--

/*!50001 DROP TABLE IF EXISTS `mag_languages_foreign_filology`*/;
/*!50001 DROP VIEW IF EXISTS `mag_languages_foreign_filology`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `mag_languages_foreign_filology` AS select distinct `facultets`.`FacultetFullName` AS `FacultetFullName`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,if(isnull(`specialities`.`SpecialityDirectionName`),'',`specialities`.`SpecialityDirectionName`),`specialities`.`SpecialitySpecializationName`,`specialities`.`SpecialityName`) AS `spec`,if((`personspeciality`.`Exam1ID` = 40),(select `subjects`.`SubjectName` from `subjects` where (`subjects`.`idSubjects` = `personspeciality`.`Exam2ID`)),(select `subjects`.`SubjectName` from `subjects` where (`subjects`.`idSubjects` = `personspeciality`.`Exam1ID`))) AS `ForeignLang`,`person`.`LastName` AS `surname`,`person`.`FirstName` AS `name`,`person`.`MiddleName` AS `farthername`,`languages`.`LanguagesName` AS `fah`,(case `specialities`.`PersonEducationFormID` when 1 then 'денна' when 2 then 'заочна' end) AS `eduform` from ((((`personspeciality` left join `person` on((`person`.`idPerson` = `personspeciality`.`PersonID`))) left join `languages` on((`languages`.`idLanguages` = `person`.`LanguageID`))) left join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) left join `facultets` on((`facultets`.`idFacultet` = `specialities`.`FacultetID`))) where ((`personspeciality`.`QualificationID` = 2) and (`personspeciality`.`StatusID` not in (2,3,10)) and (`specialities`.`FacultetID` = 1638)) order by concat_ws(' ',`specialities`.`SpecialityClasifierCode`,if(isnull(`specialities`.`SpecialityDirectionName`),'',`specialities`.`SpecialityDirectionName`),`specialities`.`SpecialitySpecializationName`,`specialities`.`SpecialityName`),`person`.`LastName`,(case `specialities`.`PersonEducationFormID` when 1 then 'денна' when 2 then 'заочна' end) */;
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
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
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
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `person_contract_speciality_view` AS select `personspeciality`.`idPersonSpeciality` AS `idPersonSpeciality`,`person`.`idPerson` AS `idPerson`,concat(`person`.`LastName`,' ',`person`.`FirstName`,' ',`person`.`MiddleName`) AS `FIO`,concat(`specialities`.`SpecialityClasifierCode`,': ',`specialities`.`SpecialityName`,' ',`specialities`.`SpecialityDirectionName`,' ',`specialities`.`SpecialitySpecializationName`) AS `SpecCodeName`,`personspeciality`.`EducationFormID` AS `EducationFormID`,`personspeciality`.`SepcialityID` AS `SepcialityID` from ((`personspeciality` join `person` on((`person`.`idPerson` = `personspeciality`.`PersonID`))) join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `person_list`
--

/*!50001 DROP TABLE IF EXISTS `person_list`*/;
/*!50001 DROP VIEW IF EXISTS `person_list`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `person_list` AS select (((((((((if((isnull(`documentsubject1`.`SubjectValue`) or (`documentsubject1`.`SubjectValue` = 0)),'0',`documentsubject1`.`SubjectValue`) + if((isnull(`documentsubject2`.`SubjectValue`) or (`documentsubject2`.`SubjectValue` = 0)),'0',`documentsubject2`.`SubjectValue`)) + if((isnull(`documentsubject3`.`SubjectValue`) or (`documentsubject1`.`SubjectValue` = 0)),'0',`documentsubject3`.`SubjectValue`)) + if((isnull(`personspeciality`.`AdditionalBall`) or (`personspeciality`.`AdditionalBall` = 0)),'0',`personspeciality`.`AdditionalBall`)) + if((isnull(`personspeciality`.`CoursedpBall`) or (`personspeciality`.`CoursedpBall` = 0)),'0',`personspeciality`.`CoursedpBall`)) + if((`personspeciality`.`QualificationID` = 1),if((isnull(`documents`.`AtestatValue`) or (`documents`.`AtestatValue` = 0)),'0',if(isnull(`atestatvalue`.`ZnoValue`),'0',`atestatvalue`.`ZnoValue`)),(`documents`.`AtestatValue` * 10))) + if((isnull(`olympiadsawards`.`OlympiadAwardBonus`) or (`olympiadsawards`.`OlympiadAwardBonus` = 0)),0,`olympiadsawards`.`OlympiadAwardBonus`)) + if((isnull(`personspeciality`.`Exam1Ball`) or (`personspeciality`.`Exam1Ball` = 0)),'0',`personspeciality`.`Exam1Ball`)) + if((isnull(`personspeciality`.`Exam2Ball`) or (`personspeciality`.`Exam2Ball` = 0)),'0',`personspeciality`.`Exam2Ball`)) + if((isnull(`personspeciality`.`Exam3Ball`) or (`personspeciality`.`Exam3Ball` = 0)),'0',`personspeciality`.`Exam3Ball`)) AS `sumBall`,`olympiadsawards`.`OlympiadAwardBonus` AS `OlympiadAwardBonus`,if((`personspeciality`.`isCopyEntrantDoc` = 1),'+','-') AS `isCopy`,`person`.`LastName` AS `surname`,`person`.`FirstName` AS `name`,`person`.`MiddleName` AS `fartherName`,`facultets`.`FacultetFullName` AS `facultet`,if((`personspeciality`.`RequestFromEB` = 0),'-','+') AS `eb`,`facultets`.`idFacultet` AS `idFacultet`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,if(isnull(`specialities`.`SpecialityDirectionName`),'',`specialities`.`SpecialityDirectionName`),`specialities`.`SpecialitySpecializationName`,`specialities`.`SpecialityName`) AS `spec`,`personspeciality`.`StatusID` AS `status`,if(isnull(`koatuulevel2`.`idKOATUULevel2`),'',if((`koatuulevel1`.`idKOATUULevel1` = 135607),'',`koatuulevel1`.`KOATUULevel1FullName`)) AS `region`,if(isnull(`koatuulevel2`.`idKOATUULevel2`),`koatuulevel1`.`KOATUULevel1FullName`,if(isnull(`person`.`KOATUUCodeL3ID`),`koatuulevel2`.`KOATUULevel2Name`,if((`koatuulevel3`.`KOATUULevel3Type` = (select `parametersquery`.`value` from `parametersquery` where (`parametersquery`.`code` = 1))),`koatuulevel2`.`KOATUULevel2Name`,`koatuulevel3`.`KOATUULevel3Name`))) AS `city`,if(isnull(`person`.`KOATUUCodeL3ID`),'',if((`koatuulevel3`.`KOATUULevel3Type` = (select `parametersquery`.`value` from `parametersquery` where (`parametersquery`.`code` = 1))),'',`koatuulevel2`.`KOATUULevel2Name`)) AS `cityVillage`,`personeducationforms`.`PersonEducationFormName` AS `edu`,`homephone`.`Value` AS `homephone`,`mobilephone`.`Value` AS `mobile` from (((((((((((((((`personspeciality` left join `person` on((`person`.`idPerson` = `personspeciality`.`PersonID`))) left join `personeducationforms` on((`personeducationforms`.`idPersonEducationForm` = `personspeciality`.`EducationFormID`))) left join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) left join `facultets` on((`facultets`.`idFacultet` = `specialities`.`FacultetID`))) left join `personcontacts` `homephone` on(((`homephone`.`PersonID` = `person`.`idPerson`) and (`homephone`.`PersonContactTypeID` = 1)))) left join `personcontacts` `mobilephone` on(((`mobilephone`.`PersonID` = `person`.`idPerson`) and (`mobilephone`.`PersonContactTypeID` = 2)))) left join `koatuulevel1` on((`koatuulevel1`.`idKOATUULevel1` = `person`.`KOATUUCodeL1ID`))) left join `koatuulevel2` on((`koatuulevel2`.`idKOATUULevel2` = `person`.`KOATUUCodeL2ID`))) left join `koatuulevel3` on((`koatuulevel3`.`idKOATUULevel3` = `person`.`KOATUUCodeL3ID`))) left join `olympiadsawards` on((`olympiadsawards`.`OlympiadAwardID` = `personspeciality`.`OlympiadID`))) left join `documentsubject` `documentsubject1` on((`documentsubject1`.`idDocumentSubject` = `personspeciality`.`DocumentSubject1`))) left join `documentsubject` `documentsubject2` on((`documentsubject2`.`idDocumentSubject` = `personspeciality`.`DocumentSubject2`))) left join `documentsubject` `documentsubject3` on((`documentsubject3`.`idDocumentSubject` = `personspeciality`.`DocumentSubject3`))) left join `documents` on(((`documents`.`PersonID` = `personspeciality`.`PersonID`) and (`documents`.`TypeID` = 2)))) left join `atestatvalue` on((`atestatvalue`.`AtestatValue` = `documents`.`AtestatValue`))) order by `specialities`.`SpecialityClasifierCode`,(((((((((if(isnull(`documentsubject1`.`SubjectValue`),'0',`documentsubject1`.`SubjectValue`) + if(isnull(`documentsubject2`.`SubjectValue`),'0',`documentsubject2`.`SubjectValue`)) + if(isnull(`documentsubject3`.`SubjectValue`),'0',`documentsubject3`.`SubjectValue`)) + if(isnull(`personspeciality`.`AdditionalBall`),'0',`personspeciality`.`AdditionalBall`)) + if(isnull(`personspeciality`.`CoursedpBall`),'0',`personspeciality`.`CoursedpBall`)) + if(isnull(`documents`.`AtestatValue`),'0',if(isnull(`atestatvalue`.`ZnoValue`),'0',`atestatvalue`.`ZnoValue`))) + if(isnull(`olympiadsawards`.`OlympiadAwardBonus`),0,`olympiadsawards`.`OlympiadAwardBonus`)) + if(isnull(`personspeciality`.`Exam1Ball`),'0',`personspeciality`.`Exam1Ball`)) + if(isnull(`personspeciality`.`Exam2Ball`),'0',`personspeciality`.`Exam1Ball`)) + if(isnull(`personspeciality`.`Exam3Ball`),'0',`personspeciality`.`Exam1Ball`)) desc */;
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
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `person_speciality_view` AS select `personspeciality`.`idPersonSpeciality` AS `idPersonSpeciality`,`personspeciality`.`CreateDate` AS `CreateDate`,`person`.`idPerson` AS `idPerson`,`person`.`Birthday` AS `Birthday`,concat(`person`.`LastName`,' ',`person`.`FirstName`,' ',`person`.`MiddleName`) AS `FIO`,`personspeciality`.`isContract` AS `isContract`,`personspeciality`.`isBudget` AS `isBudget`,concat(`specialities`.`SpecialityClasifierCode`,': ',`specialities`.`SpecialityName`,' ',`specialities`.`SpecialityDirectionName`,' ',`specialities`.`SpecialitySpecializationName`) AS `SpecCodeName`,`personspeciality`.`QualificationID` AS `QualificationID`,`personspeciality`.`CourseID` AS `CourseID`,`personspeciality`.`RequestNumber` AS `RequestNumber`,`personspeciality`.`PersonRequestNumber` AS `PersonRequestNumber`,`person`.`edboID` AS `PersonEdboID`,`personspeciality`.`edboID` AS `SpecEdboID`,`person`.`CreateDate` AS `PersonCreateDate`,`personspeciality`.`DocumentSubject1` AS `DocumentSubject1`,(select `documentsubject`.`SubjectValue` from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject1`)) AS `DocumentSubject1Value`,`personspeciality`.`DocumentSubject2` AS `DocumentSubject2`,(select `documentsubject`.`SubjectValue` from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject2`)) AS `DocumentSubject2Value`,`personspeciality`.`DocumentSubject2` AS `DocumentSubject3`,(select `documentsubject`.`SubjectValue` from `documentsubject` where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject3`)) AS `DocumentSubject3Value`,`documents`.`PersonDocumentsAwardsTypesID` AS `PersonDocumentsAwardsTypesID`,`personspeciality`.`isCopyEntrantDoc` AS `isCopyEntrantDoc`,`documents`.`AtestatValue` AS `AtestatValue`,`documents`.`TypeID` AS `DocumentTypeID`,`personspeciality`.`CoursedpID` AS `CoursedpID`,`personspeciality`.`OlympiadID` AS `OlympiadID`,`personspeciality`.`StatusID` AS `StatusID`,`personspeciality`.`RequestFromEB` AS `RequestFromEB`,`personspeciality`.`EducationFormID` AS `EducationFormID`,`personspeciality`.`SepcialityID` AS `SepcialityID` from (((`personspeciality` join `person` on((`person`.`idPerson` = `personspeciality`.`PersonID`))) join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) join `documents` on((`personspeciality`.`EntrantDocumentID` = `documents`.`idDocuments`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `person_with1or2_spec`
--

/*!50001 DROP TABLE IF EXISTS `person_with1or2_spec`*/;
/*!50001 DROP VIEW IF EXISTS `person_with1or2_spec`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `person_with1or2_spec` AS select concat_ws(' ',`person`.`LastName`,`person`.`FirstName`,`person`.`MiddleName`) AS `ПІБ`,count(distinct `personspeciality`.`idPersonSpeciality`) AS `КІЛЬКІСТЬ ПОДАНИХ ЗАЯВОК`,group_concat(concat_ws(' ','факультет:',`facultets`.`FacultetFullName`,', спеціальність: ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end),', форма: ',`personeducationforms`.`PersonEducationFormName`) separator ' | ') AS `ЗАЯВКИ`,concat_ws(' ','тел:',`personcontacts`.`Value`) AS `КОНТАКТИ` from (((((`personspeciality` join `person` on((`personspeciality`.`PersonID` = `person`.`idPerson`))) join `specialities` on((`personspeciality`.`SepcialityID` = `specialities`.`idSpeciality`))) join `facultets` on((`facultets`.`idFacultet` = `specialities`.`FacultetID`))) join `personeducationforms` on((`personspeciality`.`EducationFormID` = `personeducationforms`.`idPersonEducationForm`))) left join `personcontacts` on((`personspeciality`.`PersonID` = `personcontacts`.`PersonID`))) where ((`personspeciality`.`StatusID` not in (2,3,10)) and (`personcontacts`.`PersonContactTypeID` = 2) and (`personspeciality`.`SepcialityID` not in (70694,70692,70691,70690,70696)) and (`personspeciality`.`QualificationID` <> 1)) group by `personcontacts`.`PersonID` having (count(distinct `personspeciality`.`idPersonSpeciality`) in (1,2)) order by concat_ws(' ',`person`.`LastName`,`person`.`FirstName`,`person`.`MiddleName`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `personspec_all`
--

/*!50001 DROP TABLE IF EXISTS `personspec_all`*/;
/*!50001 DROP VIEW IF EXISTS `personspec_all`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `personspec_all` AS select `personspec_all_part1`.`idPersonSpeciality` AS `idPersonSpeciality`,`personspec_all_part1`.`FIO` AS `FIO`,`personspec_all_part1`.`FacultetFullName` AS `FacultetFullName`,`personspec_all_part1`.`QualificationName` AS `QualificationName`,`personspec_all_part1`.`Specialnost` AS `Specialnost`,`personspec_all_part1`.`Forma` AS `Forma`,`personspec_all_part1`.`isContract` AS `isContract`,`personspec_all_part1`.`isBudget` AS `isBudget`,`personspec_all_part1`.`isCopyEntrantDoc` AS `isCopyEntrantDoc`,`personspec_all_part1`.`RequestFromEB` AS `RequestFromEB`,`personspec_all_part1`.`Pilga` AS `Pilga`,`personspec_all_part1`.`PozaKonkursom` AS `PozaKonkursom`,`personspec_all_part1`.`Pozacherg` AS `Pozacherg`,`personspec_all_part1`.`VillageQuota` AS `VillageQuota`,`personspec_all_part1`.`TargetQuota` AS `TargetQuota`,`personspec_all_part1`.`Date` AS `Date`,`personspec_all_part1`.`edboID` AS `edboID`,`personspec_all_part1`.`Nomer_lichnogo_dela` AS `Nomer_lichnogo_dela`,`personspec_all_part1`.`N_dela` AS `N_dela`,`personspec_all_part1`.`StatusID` AS `StatusID`,`personspec_all_part1`.`Status` AS `Status`,`personspec_all_part2`.`exams` AS `exams`,`personspec_all_part2`.`ispity` AS `ispity`,`personspec_all_part2`.`olymp` AS `olymp`,`personspec_all_part2`.`courses` AS `courses` from (`personspec_all_part1` join `personspec_all_part2` on((`personspec_all_part1`.`idPersonSpeciality` = `personspec_all_part2`.`ID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `personspec_all_part1`
--

/*!50001 DROP TABLE IF EXISTS `personspec_all_part1`*/;
/*!50001 DROP VIEW IF EXISTS `personspec_all_part1`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `personspec_all_part1` AS select `personspeciality`.`idPersonSpeciality` AS `idPersonSpeciality`,concat_ws(' ',`person`.`LastName`,`person`.`FirstName`,`person`.`MiddleName`) AS `FIO`,`facultets`.`FacultetFullName` AS `FacultetFullName`,`qualifications`.`QualificationName` AS `QualificationName`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `Specialnost`,`personeducationforms`.`PersonEducationFormName` AS `Forma`,`personspeciality`.`isContract` AS `isContract`,`personspeciality`.`isBudget` AS `isBudget`,`personspeciality`.`isCopyEntrantDoc` AS `isCopyEntrantDoc`,`personspeciality`.`RequestFromEB` AS `RequestFromEB`,group_concat(`benefit`.`BenefitName` separator '; ') AS `Pilga`,(case when isnull(`benefit`.`isPZK`) then 0 else `benefit`.`isPZK` end) AS `PozaKonkursom`,(case when isnull(`benefit`.`isPV`) then 0 else `benefit`.`isPV` end) AS `Pozacherg`,`personspeciality`.`Quota1` AS `VillageQuota`,`personspeciality`.`Quota2` AS `TargetQuota`,substr(`personspeciality`.`CreateDate`,1,10) AS `Date`,`personspeciality`.`edboID` AS `edboID`,concat((case when (`personspeciality`.`QualificationID` = 1) then 'Б' when (`personspeciality`.`QualificationID` = 2) then 'СМ' when (`personspeciality`.`QualificationID` = 3) then 'СМ' when (`personspeciality`.`QualificationID` = 4) then 'МС' end),`personspeciality`.`CourseID`,'-',(case when (`personspeciality`.`PersonRequestNumber` >= 10000) then `personspeciality`.`PersonRequestNumber` when ((`personspeciality`.`PersonRequestNumber` >= 1000) and (`personspeciality`.`PersonRequestNumber` < 10000)) then concat('0',`personspeciality`.`PersonRequestNumber`) when ((`personspeciality`.`PersonRequestNumber` >= 100) and (`personspeciality`.`PersonRequestNumber` < 1000)) then concat('00',`personspeciality`.`PersonRequestNumber`) when ((`personspeciality`.`PersonRequestNumber` >= 10) and (`personspeciality`.`PersonRequestNumber` < 100)) then concat('000',`personspeciality`.`PersonRequestNumber`) when ((`personspeciality`.`PersonRequestNumber` >= 0) and (`personspeciality`.`PersonRequestNumber` < 10)) then concat('0000',`personspeciality`.`PersonRequestNumber`) end)) AS `Nomer_lichnogo_dela`,`personspeciality`.`RequestNumber` AS `N_dela`,`personspeciality`.`StatusID` AS `StatusID`,`requeststatus`.`RequestStatusName` AS `Status` from ((((((((`personspeciality` join `person` on((`personspeciality`.`PersonID` = `person`.`idPerson`))) join `specialities` on((`personspeciality`.`SepcialityID` = `specialities`.`idSpeciality`))) join `facultets` on((`facultets`.`idFacultet` = `specialities`.`FacultetID`))) join `personeducationforms` on((`personspeciality`.`EducationFormID` = `personeducationforms`.`idPersonEducationForm`))) join `qualifications` on((`personspeciality`.`QualificationID` = `qualifications`.`idQualification`))) left join `personbenefits` on((`personspeciality`.`PersonID` = `personbenefits`.`PersonID`))) left join `benefit` on((`personbenefits`.`BenefitID` = `benefit`.`idBenefit`))) join `requeststatus` on((`requeststatus`.`idRequestStatus` = `personspeciality`.`StatusID`))) where 1 group by `personspeciality`.`idPersonSpeciality` order by concat_ws(' ',`person`.`LastName`,`person`.`FirstName`,`person`.`MiddleName`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `personspec_all_part2`
--

/*!50001 DROP TABLE IF EXISTS `personspec_all_part2`*/;
/*!50001 DROP VIEW IF EXISTS `personspec_all_part2`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `personspec_all_part2` AS select `personspeciality`.`idPersonSpeciality` AS `ID`,concat_ws(' ',`person`.`LastName`,`person`.`FirstName`,`person`.`MiddleName`) AS `FIO_`,concat_ws('\n',(select concat_ws(':',`subjects`.`SubjectName`,`documentsubject`.`SubjectValue`) from (`documentsubject` join `subjects` on((`subjects`.`idSubjects` = `documentsubject`.`SubjectID`))) where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject1`)),(select concat_ws(':',`subjects`.`SubjectName`,`documentsubject`.`SubjectValue`) from (`documentsubject` join `subjects` on((`subjects`.`idSubjects` = `documentsubject`.`SubjectID`))) where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject2`)),(select concat_ws(':',`subjects`.`SubjectName`,`documentsubject`.`SubjectValue`) from (`documentsubject` join `subjects` on((`subjects`.`idSubjects` = `documentsubject`.`SubjectID`))) where (`documentsubject`.`idDocumentSubject` = `personspeciality`.`DocumentSubject3`)),concat_ws(' ',(case `personspeciality`.`QualificationID` when 1 then 'атестат:' else 'диплом:' end),`documents`.`AtestatValue`)) AS `exams`,concat_ws('\n',concat((select `subjects`.`SubjectName` from `subjects` where (`subjects`.`idSubjects` = `personspeciality`.`Exam1ID`)),':',`personspeciality`.`Exam1Ball`),concat((select `subjects`.`SubjectName` from `subjects` where (`subjects`.`idSubjects` = `personspeciality`.`Exam2ID`)),':',`personspeciality`.`Exam2Ball`),concat((select `subjects`.`SubjectName` from `subjects` where (`subjects`.`idSubjects` = `personspeciality`.`Exam3ID`)),':',`personspeciality`.`Exam3Ball`)) AS `ispity`,`olympiadsawards`.`OlympiadAwardName` AS `olymp`,`coursedp`.`CourseDPName` AS `courses` from (((((((`personspeciality` join `person` on((`person`.`idPerson` = `personspeciality`.`PersonID`))) join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) left join `documents` on((`personspeciality`.`EntrantDocumentID` = `documents`.`idDocuments`))) left join `personolympiad` on((`personspeciality`.`PersonID` = `personolympiad`.`PersonID`))) left join `olympiadsawards` on((`personolympiad`.`OlympiadAwarID` = `olympiadsawards`.`OlympiadAwardID`))) left join `personcoursesdp` on((`personcoursesdp`.`PersonID` = `personspeciality`.`PersonID`))) left join `coursedp` on((`coursedp`.`idCourseDP` = `personcoursesdp`.`CourseDPID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `personspec_counts`
--

/*!50001 DROP TABLE IF EXISTS `personspec_counts`*/;
/*!50001 DROP VIEW IF EXISTS `personspec_counts`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `personspec_counts` AS select substr(`personspeciality`.`CreateDate`,1,10) AS `_date_`,count(`personspeciality`.`idPersonSpeciality`) AS `_count_`,`personspeciality`.`idPersonSpeciality` AS `idPersonSpeciality` from `personspeciality` group by substr(`personspeciality`.`CreateDate`,1,10) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `personspec_mag`
--

/*!50001 DROP TABLE IF EXISTS `personspec_mag`*/;
/*!50001 DROP VIEW IF EXISTS `personspec_mag`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `personspec_mag` AS select `personspeciality`.`idPersonSpeciality` AS `idPersonSpeciality`,concat_ws(' ',`person`.`LastName`,`person`.`FirstName`,`person`.`MiddleName`) AS `FIO`,`facultets`.`FacultetFullName` AS `FacultetFullName`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end),concat('(',`personeducationforms`.`PersonEducationFormName`,')')) AS `Specialnost`,(case `personspeciality`.`isContract` when 0 then 'заявка не на контракт' when 1 then 'заявка на контракт' end) AS `Kontrakt`,(case `personspeciality`.`isBudget` when 0 then 'заявка не на бюджет' when 1 then 'заявка на бюджет' end) AS `Budget`,`persondocumenttypes`.`PersonDocumentTypesName` AS `PersonDocumentTypesName`,`documents`.`AtestatValue` AS `evaluation`,`requeststatus`.`RequestStatusName` AS `Status` from (((((((`personspeciality` join `person` on((`personspeciality`.`PersonID` = `person`.`idPerson`))) join `specialities` on((`personspeciality`.`SepcialityID` = `specialities`.`idSpeciality`))) join `facultets` on((`facultets`.`idFacultet` = `specialities`.`FacultetID`))) join `personeducationforms` on((`personspeciality`.`EducationFormID` = `personeducationforms`.`idPersonEducationForm`))) join `requeststatus` on((`requeststatus`.`idRequestStatus` = `personspeciality`.`StatusID`))) left join `documents` on((`documents`.`PersonID` = `personspeciality`.`PersonID`))) left join `persondocumenttypes` on((`documents`.`TypeID` = `persondocumenttypes`.`idPersonDocumentTypes`))) where ((`personspeciality`.`QualificationID` = 2) and (`documents`.`TypeID` in (11,12)) and (`personspeciality`.`StatusID` <> 10)) order by `facultets`.`FacultetFullName`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end),concat('(',`personeducationforms`.`PersonEducationFormName`,')')),`documents`.`AtestatValue` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `personspec_specialists`
--

/*!50001 DROP TABLE IF EXISTS `personspec_specialists`*/;
/*!50001 DROP VIEW IF EXISTS `personspec_specialists`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `personspec_specialists` AS select `personspeciality`.`idPersonSpeciality` AS `idPersonSpeciality`,concat_ws(' ',`person`.`LastName`,`person`.`FirstName`,`person`.`MiddleName`) AS `FIO`,`facultets`.`FacultetFullName` AS `FacultetFullName`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end),concat('(',`personeducationforms`.`PersonEducationFormName`,')')) AS `Specialnost`,(case `personspeciality`.`isContract` when 0 then 'заявка не на контракт' when 1 then 'заявка на контракт' end) AS `Kontrakt`,(case `personspeciality`.`isBudget` when 0 then 'заявка не на бюджет' when 1 then 'заявка на бюджет' end) AS `Budget`,`persondocumenttypes`.`PersonDocumentTypesName` AS `PersonDocumentTypesName`,`documents`.`AtestatValue` AS `evaluation`,`requeststatus`.`RequestStatusName` AS `Status` from (((((((`personspeciality` join `person` on((`personspeciality`.`PersonID` = `person`.`idPerson`))) join `specialities` on((`personspeciality`.`SepcialityID` = `specialities`.`idSpeciality`))) join `facultets` on((`facultets`.`idFacultet` = `specialities`.`FacultetID`))) join `personeducationforms` on((`personspeciality`.`EducationFormID` = `personeducationforms`.`idPersonEducationForm`))) join `requeststatus` on((`requeststatus`.`idRequestStatus` = `personspeciality`.`StatusID`))) left join `documents` on((`documents`.`PersonID` = `personspeciality`.`PersonID`))) left join `persondocumenttypes` on((`documents`.`TypeID` = `persondocumenttypes`.`idPersonDocumentTypes`))) where ((`personspeciality`.`QualificationID` = 3) and (`documents`.`TypeID` in (11,12,13)) and (`personspeciality`.`StatusID` <> 10)) order by `facultets`.`FacultetFullName`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end),concat('(',`personeducationforms`.`PersonEducationFormName`,')')),`documents`.`AtestatValue` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `personspeciality_counts`
--

/*!50001 DROP TABLE IF EXISTS `personspeciality_counts`*/;
/*!50001 DROP VIEW IF EXISTS `personspeciality_counts`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `personspeciality_counts` AS select `facultets`.`FacultetFullName` AS `FacultetFullName`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `spec_nm`,`specialities`.`idSpeciality` AS `idSpeciality`,count((`specialities`.`PersonEducationFormID` = 1)) AS `ids_cnt_dnevn`,count((`specialities`.`PersonEducationFormID` = 2)) AS `ids_cnt_zaoch`,`personspeciality`.`QualificationID` AS `QualificationID`,`specialities`.`PersonEducationFormID` AS `PersonEducationFormID` from ((`facultets` join `specialities` on((`facultets`.`idFacultet` = `specialities`.`FacultetID`))) join `personspeciality` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) group by `specialities`.`idSpeciality` order by `facultets`.`FacultetFullName` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `posvidka`
--

/*!50001 DROP TABLE IF EXISTS `posvidka`*/;
/*!50001 DROP VIEW IF EXISTS `posvidka`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `posvidka` AS select `person`.`idPerson` AS `idPerson`,`person`.`FirstName` AS `FirstName`,`person`.`MiddleName` AS `MiddleName`,`person`.`LastName` AS `LastName` from (`documents` join `person`) where ((`documents`.`TypeID` = 17) and (`documents`.`PersonID` = `person`.`idPerson`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `resident_list`
--

/*!50001 DROP TABLE IF EXISTS `resident_list`*/;
/*!50001 DROP VIEW IF EXISTS `resident_list`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `resident_list` AS select `person`.`LastName` AS `surname`,`person`.`FirstName` AS `name`,`person`.`MiddleName` AS `fartherName`,`person`.`idPerson` AS `edbo`,`country`.`CountryName` AS `country`,`personeducationforms`.`PersonEducationFormName` AS `edu`,`requeststatus`.`RequestStatusName` AS `statusname`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,if(isnull(`specialities`.`SpecialityDirectionName`),'',`specialities`.`SpecialityDirectionName`),`specialities`.`SpecialitySpecializationName`,`specialities`.`SpecialityName`) AS `spec` from (((((`person` left join `country` on((`country`.`idCountry` = `person`.`CountryID`))) left join `personspeciality` on(((`personspeciality`.`PersonID` = `person`.`idPerson`) and (`personspeciality`.`StatusID` <> 3)))) left join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) left join `requeststatus` on((`requeststatus`.`idRequestStatus` = `personspeciality`.`StatusID`))) left join `personeducationforms` on((`personeducationforms`.`idPersonEducationForm` = `personspeciality`.`EducationFormID`))) where (`person`.`CountryID` <> 804) order by `person`.`LastName` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `stat_graduated`
--

/*!50001 DROP TABLE IF EXISTS `stat_graduated`*/;
/*!50001 DROP VIEW IF EXISTS `stat_graduated`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `stat_graduated` AS select `all_specialities`.`F` AS `F`,`all_specialities`.`S` AS `S`,`vypuskniki_stat`.`kol_zajav` AS `zajavi_ot_nas`,`vypuskniki_stat`.`kol_person` AS `ludi_ot_nas`,(case when isnull(`vypuskniki_ne_ot_nas_stat`.`kol_zajav`) then 0 else `vypuskniki_ne_ot_nas_stat`.`kol_zajav` end) AS `zajavi_ne_ot_nas`,(case when isnull(`vypuskniki_ne_ot_nas_stat`.`kol_person`) then 0 else `vypuskniki_ne_ot_nas_stat`.`kol_person` end) AS `ludi_ne_ot_nas` from ((`all_specialities` left join `vypuskniki_ne_ot_nas_stat` on((`vypuskniki_ne_ot_nas_stat`.`Specialnost` = `all_specialities`.`S`))) join `vypuskniki_stat` on((`vypuskniki_stat`.`Specialnost` = `all_specialities`.`S`))) where (substr(`all_specialities`.`S`,1,1) in ('7','8')) order by `all_specialities`.`F`,`all_specialities`.`S` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `stat_graduated_by_f`
--

/*!50001 DROP TABLE IF EXISTS `stat_graduated_by_f`*/;
/*!50001 DROP VIEW IF EXISTS `stat_graduated_by_f`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `stat_graduated_by_f` AS select `cnt_bachelor_graduated_2013`.`cnt` AS `cnt`,`vypuskniki_statx`.`Fakultet` AS `Fakultet`,count(distinct `vypuskniki_statx`.`vypusknik`) AS `cnt_our`,`vypuskniki_ano_by_f`.`cnt_ano` AS `cnt_ano` from (((`vypuskniki_statx` left join `vypuskniki_ano_by_f` on((`vypuskniki_ano_by_f`.`Fakultet` = `vypuskniki_statx`.`Fakultet`))) join `facultets` on((`facultets`.`FacultetFullName` = `vypuskniki_statx`.`Fakultet`))) join `cnt_bachelor_graduated_2013` on((`cnt_bachelor_graduated_2013`.`FacultetID` = `facultets`.`idFacultet`))) where ((`vypuskniki_statx`.`kem_vydan_diplom` like '%Запорізький національний університет%') and (`vypuskniki_statx`.`Fakultet` = `vypuskniki_statx`.`FacultyGraduated`)) group by `vypuskniki_statx`.`Fakultet` order by `vypuskniki_statx`.`Fakultet` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `table_personspec_all`
--

/*!50001 DROP TABLE IF EXISTS `table_personspec_all`*/;
/*!50001 DROP VIEW IF EXISTS `table_personspec_all`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `table_personspec_all` AS select `specialities`.`SpecialityClasifierCode` AS `SpecialityClasifierCode`,(case when (`specialities`.`SpecialityDirectionName` = '') then `specialities`.`SpecialityName` else `specialities`.`SpecialityDirectionName` end) AS `Snm`,`personspeciality`.`idPersonSpeciality` AS `idPersonSpeciality`,`courses`.`CourseName` AS `CourseName`,`personeducationforms`.`PersonEducationFormName` AS `PersonEducationFormName`,`qualifications`.`QualificationName` AS `QualificationName`,concat_ws(' ',`person`.`LastName`,`person`.`FirstName`,`person`.`MiddleName`) AS `PIB`,`personspeciality`.`edboID` AS `edboID`,concat((case when (`personspeciality`.`QualificationID` = 1) then 'Б' when (`personspeciality`.`QualificationID` = 2) then 'СМ' when (`personspeciality`.`QualificationID` = 3) then 'СМ' when (`personspeciality`.`QualificationID` = 4) then 'МС' end),`personspeciality`.`CourseID`,'-',(case when (`personspeciality`.`PersonRequestNumber` >= 10000) then `personspeciality`.`PersonRequestNumber` when ((`personspeciality`.`PersonRequestNumber` >= 1000) and (`personspeciality`.`PersonRequestNumber` < 10000)) then concat('0',`personspeciality`.`PersonRequestNumber`) when ((`personspeciality`.`PersonRequestNumber` >= 100) and (`personspeciality`.`PersonRequestNumber` < 1000)) then concat('00',`personspeciality`.`PersonRequestNumber`) when ((`personspeciality`.`PersonRequestNumber` >= 10) and (`personspeciality`.`PersonRequestNumber` < 100)) then concat('000',`personspeciality`.`PersonRequestNumber`) when ((`personspeciality`.`PersonRequestNumber` >= 0) and (`personspeciality`.`PersonRequestNumber` < 10)) then concat('0000',`personspeciality`.`PersonRequestNumber`) end)) AS `Req`,`requeststatus`.`RequestStatusName` AS `RequestStatusName` from ((((((`personspeciality` join `person` on((`personspeciality`.`PersonID` = `person`.`idPerson`))) join `specialities` on((`personspeciality`.`SepcialityID` = `specialities`.`idSpeciality`))) join `personeducationforms` on((`personspeciality`.`EducationFormID` = `personeducationforms`.`idPersonEducationForm`))) join `qualifications` on((`personspeciality`.`QualificationID` = `qualifications`.`idQualification`))) join `courses` on((`personspeciality`.`CourseID` = `courses`.`idCourse`))) join `requeststatus` on((`requeststatus`.`idRequestStatus` = `personspeciality`.`StatusID`))) order by `personspeciality`.`edboID`,concat_ws(' ',`person`.`LastName`,`person`.`FirstName`,`person`.`MiddleName`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `table_personspec_today`
--

/*!50001 DROP TABLE IF EXISTS `table_personspec_today`*/;
/*!50001 DROP VIEW IF EXISTS `table_personspec_today`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `table_personspec_today` AS select `specialities`.`SpecialityClasifierCode` AS `SpecialityClasifierCode`,(case when (`specialities`.`SpecialityDirectionName` = '') then `specialities`.`SpecialityName` else `specialities`.`SpecialityDirectionName` end) AS `Snm`,`personspeciality`.`idPersonSpeciality` AS `idPersonSpeciality`,`courses`.`CourseName` AS `CourseName`,`personeducationforms`.`PersonEducationFormName` AS `PersonEducationFormName`,`qualifications`.`QualificationName` AS `QualificationName`,concat_ws(' ',`person`.`LastName`,`person`.`FirstName`,`person`.`MiddleName`) AS `PIB`,`personspeciality`.`edboID` AS `edboID`,concat((case when (`personspeciality`.`QualificationID` = 1) then 'Б' when (`personspeciality`.`QualificationID` = 2) then 'СМ' when (`personspeciality`.`QualificationID` = 3) then 'СМ' when (`personspeciality`.`QualificationID` = 4) then 'МС' end),`personspeciality`.`CourseID`,'-',(case when (`personspeciality`.`PersonRequestNumber` >= 10000) then `personspeciality`.`PersonRequestNumber` when ((`personspeciality`.`PersonRequestNumber` >= 1000) and (`personspeciality`.`PersonRequestNumber` < 10000)) then concat('0',`personspeciality`.`PersonRequestNumber`) when ((`personspeciality`.`PersonRequestNumber` >= 100) and (`personspeciality`.`PersonRequestNumber` < 1000)) then concat('00',`personspeciality`.`PersonRequestNumber`) when ((`personspeciality`.`PersonRequestNumber` >= 10) and (`personspeciality`.`PersonRequestNumber` < 100)) then concat('000',`personspeciality`.`PersonRequestNumber`) when ((`personspeciality`.`PersonRequestNumber` >= 0) and (`personspeciality`.`PersonRequestNumber` < 10)) then concat('0000',`personspeciality`.`PersonRequestNumber`) end)) AS `Req`,`requeststatus`.`RequestStatusName` AS `RequestStatusName` from ((((((`personspeciality` join `person` on((`personspeciality`.`PersonID` = `person`.`idPerson`))) join `specialities` on((`personspeciality`.`SepcialityID` = `specialities`.`idSpeciality`))) join `personeducationforms` on((`personspeciality`.`EducationFormID` = `personeducationforms`.`idPersonEducationForm`))) join `qualifications` on((`personspeciality`.`QualificationID` = `qualifications`.`idQualification`))) join `courses` on((`personspeciality`.`CourseID` = `courses`.`idCourse`))) join `requeststatus` on((`requeststatus`.`idRequestStatus` = `personspeciality`.`StatusID`))) where (substr(`personspeciality`.`CreateDate`,1,10) = curdate()) order by `personspeciality`.`edboID`,concat_ws(' ',`person`.`LastName`,`person`.`FirstName`,`person`.`MiddleName`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `temp`
--

/*!50001 DROP TABLE IF EXISTS `temp`*/;
/*!50001 DROP VIEW IF EXISTS `temp`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `temp` AS select concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end),concat('(',`personeducationforms`.`PersonEducationFormName`,')')) AS `Specialnost`,concat_ws(' ',`person`.`LastName`,`person`.`FirstName`,`person`.`MiddleName`) AS `FIO`,`personspeciality`.`RequestNumber` AS `NOMER`,`personspeciality`.`CreateDate` AS `CreateDate`,`personspeciality`.`Modified` AS `Modified` from (((`personspeciality` join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) join `person` on((`personspeciality`.`PersonID` = `person`.`idPerson`))) join `personeducationforms` on((`specialities`.`PersonEducationFormID` = `personeducationforms`.`idPersonEducationForm`))) where ((`specialities`.`SpecialityDirectionName` like '%видавнича справа%') or (`specialities`.`SpecialityDirectionName` like '%реклама і%')) order by concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end),concat('(',`personeducationforms`.`PersonEducationFormName`,')')),`personspeciality`.`RequestNumber` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `tvorchij_konkurs`
--

/*!50001 DROP TABLE IF EXISTS `tvorchij_konkurs`*/;
/*!50001 DROP VIEW IF EXISTS `tvorchij_konkurs`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `tvorchij_konkurs` AS select concat((case when (`personspeciality`.`RequestNumber` >= 10000) then `personspeciality`.`RequestNumber` when ((`personspeciality`.`RequestNumber` >= 1000) and (`personspeciality`.`RequestNumber` < 10000)) then concat('0',`personspeciality`.`RequestNumber`) when ((`personspeciality`.`RequestNumber` >= 100) and (`personspeciality`.`RequestNumber` < 1000)) then concat('00',`personspeciality`.`RequestNumber`) when ((`personspeciality`.`RequestNumber` >= 10) and (`personspeciality`.`RequestNumber` < 100)) then concat('000',`personspeciality`.`RequestNumber`) when ((`personspeciality`.`RequestNumber` >= 0) and (`personspeciality`.`RequestNumber` < 10)) then concat('0000',`personspeciality`.`RequestNumber`) end)) AS `NOMER_OSOBOVOJI_SPPRAVY`,concat_ws(' ',`person`.`LastName`,`person`.`FirstName`,`person`.`MiddleName`) AS `PIB`,`facultets`.`FacultetFullName` AS `FAKULTET`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case when (`specialities`.`SpecialityDirectionName` = '') then `specialities`.`SpecialityName` else `specialities`.`SpecialityDirectionName` end)) AS `SPECIALNIST`,`personeducationforms`.`PersonEducationFormName` AS `FORMA_NAVCHANNJA`,`personspeciality`.`edboID` AS `edboID`,`requeststatus`.`RequestStatusName` AS `STATUS_ZAJAVKY` from (((((((`personspeciality` join `person` on((`personspeciality`.`PersonID` = `person`.`idPerson`))) join `specialities` on((`personspeciality`.`SepcialityID` = `specialities`.`idSpeciality`))) join `personeducationforms` on((`personspeciality`.`EducationFormID` = `personeducationforms`.`idPersonEducationForm`))) join `qualifications` on((`personspeciality`.`QualificationID` = `qualifications`.`idQualification`))) join `courses` on((`personspeciality`.`CourseID` = `courses`.`idCourse`))) join `requeststatus` on((`requeststatus`.`idRequestStatus` = `personspeciality`.`StatusID`))) join `facultets` on((`facultets`.`idFacultet` = `specialities`.`FacultetID`))) where ((`personspeciality`.`Exam1ID` = 34) or (`personspeciality`.`Exam2ID` = 34) or (`personspeciality`.`Exam3ID` = 34)) order by concat_ws(' ',`person`.`LastName`,`person`.`FirstName`,`person`.`MiddleName`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `village_list`
--

/*!50001 DROP TABLE IF EXISTS `village_list`*/;
/*!50001 DROP VIEW IF EXISTS `village_list`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `village_list` AS select distinct `person`.`LastName` AS `surname`,`person`.`FirstName` AS `name`,`person`.`MiddleName` AS `fartherName`,`person`.`edboID` AS `edbo`,`koatuulevel3`.`KOATUULevel3Type` AS `place`,`personspeciality`.`QualificationID` AS `OKR`,if(isnull(`koatuulevel2`.`idKOATUULevel2`),'',if((`koatuulevel1`.`idKOATUULevel1` = 135607),'',`koatuulevel1`.`KOATUULevel1FullName`)) AS `region`,if(isnull(`koatuulevel2`.`idKOATUULevel2`),`koatuulevel1`.`KOATUULevel1FullName`,if(isnull(`person`.`KOATUUCodeL3ID`),`koatuulevel2`.`KOATUULevel2Name`,if((`koatuulevel3`.`KOATUULevel3Type` = (select `parametersquery`.`value` from `parametersquery` where (`parametersquery`.`code` = 1))),`koatuulevel2`.`KOATUULevel2Name`,`koatuulevel3`.`KOATUULevel3Name`))) AS `city`,if(isnull(`person`.`KOATUUCodeL3ID`),'',if((`koatuulevel3`.`KOATUULevel3Type` = (select `parametersquery`.`value` from `parametersquery` where (`parametersquery`.`code` = 1))),'',`koatuulevel2`.`KOATUULevel2Name`)) AS `cityVillage`,concat_ws(' ',(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end),`specialities`.`SpecialityClasifierCode`) AS `spec`,`personeducationforms`.`PersonEducationFormName` AS `edu_form`,`requeststatus`.`RequestStatusName` AS `status` from ((((((((`person` left join `parametersquery` on((`parametersquery`.`code` = 3))) left join `koatuulevel1` on((`koatuulevel1`.`idKOATUULevel1` = `person`.`KOATUUCodeL1ID`))) left join `koatuulevel2` on((`koatuulevel2`.`idKOATUULevel2` = `person`.`KOATUUCodeL2ID`))) left join `koatuulevel3` on((`koatuulevel3`.`idKOATUULevel3` = `person`.`KOATUUCodeL3ID`))) join `personspeciality` on((`personspeciality`.`PersonID` = `person`.`idPerson`))) left join `specialities` on((`personspeciality`.`SepcialityID` = `specialities`.`idSpeciality`))) left join `personeducationforms` on((`specialities`.`PersonEducationFormID` = `personeducationforms`.`idPersonEducationForm`))) left join `requeststatus` on((`personspeciality`.`StatusID` = `requeststatus`.`idRequestStatus`))) where ((`koatuulevel3`.`idKOATUULevel3` = `person`.`KOATUUCodeL3ID`) and (`koatuulevel3`.`KOATUULevel3Type` = `parametersquery`.`value`)) order by if(isnull(`koatuulevel2`.`idKOATUULevel2`),'',if((`koatuulevel1`.`idKOATUULevel1` = 135607),'',`koatuulevel1`.`KOATUULevel1FullName`)),if(isnull(`person`.`KOATUUCodeL3ID`),'',if((`koatuulevel3`.`KOATUULevel3Type` = (select `parametersquery`.`value` from `parametersquery` where (`parametersquery`.`code` = 1))),'',`koatuulevel2`.`KOATUULevel2Name`)),if(isnull(`koatuulevel2`.`idKOATUULevel2`),`koatuulevel1`.`KOATUULevel1FullName`,if(isnull(`person`.`KOATUUCodeL3ID`),`koatuulevel2`.`KOATUULevel2Name`,if((`koatuulevel3`.`KOATUULevel3Type` = (select `parametersquery`.`value` from `parametersquery` where (`parametersquery`.`code` = 1))),`koatuulevel2`.`KOATUULevel2Name`,`koatuulevel3`.`KOATUULevel3Name`))),`person`.`LastName` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vypuskniki_ano_by_f`
--

/*!50001 DROP TABLE IF EXISTS `vypuskniki_ano_by_f`*/;
/*!50001 DROP VIEW IF EXISTS `vypuskniki_ano_by_f`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vypuskniki_ano_by_f` AS select `vypuskniki_statx`.`Fakultet` AS `Fakultet`,count(distinct `vypuskniki_statx`.`vypusknik`) AS `cnt_ano` from `vypuskniki_statx` where (not((`vypuskniki_statx`.`kem_vydan_diplom` like '%Запорізький національний університет%'))) group by `vypuskniki_statx`.`Fakultet` order by `vypuskniki_statx`.`Fakultet` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vypuskniki_ne_ot_nas_stat`
--

/*!50001 DROP TABLE IF EXISTS `vypuskniki_ne_ot_nas_stat`*/;
/*!50001 DROP VIEW IF EXISTS `vypuskniki_ne_ot_nas_stat`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vypuskniki_ne_ot_nas_stat` AS select `vypuskniki_statx`.`Specialnost` AS `Specialnost`,count(`vypuskniki_statx`.`vypusknik`) AS `kol_zajav`,count(distinct `vypuskniki_statx`.`vypusknik`) AS `kol_person` from `vypuskniki_statx` where (not((`vypuskniki_statx`.`kem_vydan_diplom` like '%Запорізький національний університет%'))) group by `vypuskniki_statx`.`Specialnost` order by `vypuskniki_statx`.`Specialnost` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vypuskniki_stat`
--

/*!50001 DROP TABLE IF EXISTS `vypuskniki_stat`*/;
/*!50001 DROP VIEW IF EXISTS `vypuskniki_stat`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vypuskniki_stat` AS select `vypuskniki_statx`.`Specialnost` AS `Specialnost`,count(`vypuskniki_statx`.`vypusknik`) AS `kol_zajav`,count(distinct `vypuskniki_statx`.`vypusknik`) AS `kol_person` from `vypuskniki_statx` where (`vypuskniki_statx`.`kem_vydan_diplom` like '%Запорізький національний університет%') group by `vypuskniki_statx`.`Specialnost` order by `vypuskniki_statx`.`Specialnost` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vypuskniki_statx`
--

/*!50001 DROP TABLE IF EXISTS `vypuskniki_statx`*/;
/*!50001 DROP VIEW IF EXISTS `vypuskniki_statx`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`edbo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vypuskniki_statx` AS select `facultets`.`FacultetFullName` AS `Fakultet`,concat_ws(' ',`specialities`.`SpecialityClasifierCode`,(case substr(`specialities`.`SpecialityClasifierCode`,1,1) when '6' then `specialities`.`SpecialityDirectionName` else `specialities`.`SpecialityName` end),(case `specialities`.`SpecialitySpecializationName` when '' then '' else concat('(',`specialities`.`SpecialitySpecializationName`,')') end)) AS `Specialnost`,concat_ws(' ',`person`.`FirstName`,`person`.`MiddleName`,`person`.`LastName`) AS `vypusknik`,`documents`.`Issued` AS `kem_vydan_diplom`,(select `facultets`.`FacultetFullName` from (`specialities` join `facultets` on((`specialities`.`FacultetID` = `facultets`.`idFacultet`))) where (`specialities`.`idSpeciality` = `documents`.`PersonBaseSpecealityID`) limit 1) AS `FacultyGraduated` from ((((`personspeciality` left join `documents` on((`personspeciality`.`PersonID` = `documents`.`PersonID`))) left join `specialities` on((`specialities`.`idSpeciality` = `personspeciality`.`SepcialityID`))) left join `facultets` on((`facultets`.`idFacultet` = `specialities`.`FacultetID`))) left join `person` on((`person`.`idPerson` = `personspeciality`.`PersonID`))) where ((`documents`.`TypeID` in (11,12)) and (`personspeciality`.`StatusID` not in (3,10))) order by `facultets`.`FacultetFullName` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-29 14:59:50
