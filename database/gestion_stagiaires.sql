-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 21, 2026 at 11:18 AM
-- Server version: 8.4.7
-- PHP Version: 8.5.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_stagiaires`
--

-- --------------------------------------------------------

--
-- Table structure for table `durus`
--

DROP TABLE IF EXISTS `durus`;
CREATE TABLE IF NOT EXISTS `durus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `formation_id` int NOT NULL,
  `nom_dars` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_dars` date DEFAULT NULL,
  `heure` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `formation_id` (`formation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employes`
--

DROP TABLE IF EXISTS `employes`;
CREATE TABLE IF NOT EXISTS `employes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_complet` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cin` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialite` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `formations_base`
--

DROP TABLE IF EXISTS `formations_base`;
CREATE TABLE IF NOT EXISTS `formations_base` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employe_id` int NOT NULL,
  `service_id` int DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `rapport` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `employe_id` (`employe_id`),
  KEY `service_id` (`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `formations_continues`
--

DROP TABLE IF EXISTS `formations_continues`;
CREATE TABLE IF NOT EXISTS `formations_continues` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sujet` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fusul`
--

DROP TABLE IF EXISTS `fusul`;
CREATE TABLE IF NOT EXISTS `fusul` (
  `id` int NOT NULL AUTO_INCREMENT,
  `talib_id` int NOT NULL,
  `numero_fasl` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `talib_id` (`talib_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `masters`
--

DROP TABLE IF EXISTS `masters`;
CREATE TABLE IF NOT EXISTS `masters` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_master` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `universite` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialite` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nadwat`
--

DROP TABLE IF EXISTS `nadwat`;
CREATE TABLE IF NOT EXISTS `nadwat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sujet` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_nadwa` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_nadwa` date DEFAULT NULL,
  `lieu` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nadwat_participants`
--

DROP TABLE IF EXISTS `nadwat_participants`;
CREATE TABLE IF NOT EXISTS `nadwat_participants` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nadwa_id` int NOT NULL,
  `nom` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nadwa_id` (`nadwa_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_ar` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_fr` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `nom_ar`, `nom_fr`, `created_at`) VALUES
(1, 'المديرية الإقليمية للعدل بمكناس', 'Direction Régionale de la Justice de Meknès', '2026-05-21 11:17:32'),
(2, 'كتابة الضبط بالمحكمة الابتدائية بأزرو', 'Greffe du Tribunal de Première Instance d\'Azrou', '2026-05-21 11:17:32'),
(3, 'كتابة الضبط بالمحكمة الابتدائية بالحاجب', 'Greffe du Tribunal de Première Instance d\'El Hajeb', '2026-05-21 11:17:32'),
(4, 'كتابة الضبط بالمحكمة الابتدائية بمكناس', 'Greffe du Tribunal de Première Instance de Meknès', '2026-05-21 11:17:32'),
(5, 'كتابة الضبط بمحكمة الاستئناف بمكناس', 'Greffe de la Cour d\'Appel de Meknès', '2026-05-21 11:17:32'),
(6, 'كتابة النيابة العامة بالمحكمة الابتدائية بأزرو', 'Parquet du Tribunal de Première Instance d\'Azrou', '2026-05-21 11:17:32'),
(7, 'كتابة النيابة العامة بالمحكمة الابتدائية بالحاجب', 'Parquet du Tribunal de Première Instance d\'El Hajeb', '2026-05-21 11:17:32'),
(8, 'كتابة النيابة العامة بالمحكمة الابتدائية بمكناس', 'Parquet du Tribunal de Première Instance de Meknès', '2026-05-21 11:17:32'),
(9, 'كتابة النيابة العامة بمحكمة الاستئناف بمكناس', 'Parquet de la Cour d\'Appel de Meknès', '2026-05-21 11:17:32');

-- --------------------------------------------------------

--
-- Table structure for table `stagiaires`
--

DROP TABLE IF EXISTS `stagiaires`;
CREATE TABLE IF NOT EXISTS `stagiaires` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` int DEFAULT NULL,
  `specialite` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `statut` enum('actif','termine') COLLATE utf8mb4_unicode_ci DEFAULT 'actif',
  `doc_demande` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_assurance` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_base` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_rapport` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `talib_muwazzaf`
--

DROP TABLE IF EXISTS `talib_muwazzaf`;
CREATE TABLE IF NOT EXISTS `talib_muwazzaf` (
  `id` int NOT NULL AUTO_INCREMENT,
  `master_id` int NOT NULL,
  `nom_complet` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_matricule` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `master_id` (`master_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wahedat`
--

DROP TABLE IF EXISTS `wahedat`;
CREATE TABLE IF NOT EXISTS `wahedat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fasl_id` int NOT NULL,
  `nom_wahda` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nuqta` decimal(4,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fasl_id` (`fasl_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
