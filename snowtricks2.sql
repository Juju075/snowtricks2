-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 07 jan. 2022 à 05:31
-- Version du serveur :  8.0.22
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `snowtricks2`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `nom`, `slug`) VALUES
(23, 'Embase', 'embase');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `trick_id` int NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CA76ED395` (`user_id`),
  KEY `IDX_9474526CB281BE2E` (`trick_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `trick_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 202, 521, 'mskjfmskfmskfmksfmskfmskrfmsk', '2021-12-28 13:15:18', '2021-12-28 13:15:18'),
(2, 202, 521, 'mskjfmskfmskfmksfmskfmskrfmsk', '2021-12-28 13:15:55', '2021-12-28 13:15:55'),
(3, 202, 521, 'mskjfmskfmskfmksfmskfmskrfmsk', '2021-12-28 13:16:13', '2021-12-28 13:16:13');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20211206134324', '2021-12-24 20:57:05', 624),
('DoctrineMigrations\\Version20211207171948', '2021-12-24 20:57:06', 49),
('DoctrineMigrations\\Version20211219121626', '2021-12-24 20:57:06', 41),
('DoctrineMigrations\\Version20211229104142', '2021-12-29 10:42:46', 33);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trick_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `IDX_14B78418B281BE2E` (`trick_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1484 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id`, `trick_id`, `name`, `created_at`, `updated_at`) VALUES
(1364, 482, 'dcbb0da03b5840d6574abf507b58550a.jpg', '2021-12-27 21:20:57', '2021-12-27 21:20:57'),
(1365, 482, '99b47532cf17093c95e84c6e3ff7d2c3.jpg', '2021-12-27 21:20:57', '2021-12-27 21:20:57'),
(1366, 482, 'f20ad0211ab29ad8d29b899573604c22.jpg', '2021-12-27 21:20:57', '2021-12-27 21:20:57'),
(1367, 483, 'a7fe1d19ba3580ad8f6acc3272659e0d.jpg', '2021-12-27 21:20:57', '2021-12-27 21:20:57'),
(1368, 483, '4ccc18a0d10cd25d778ec2eba1ec9a82.jpg', '2021-12-27 21:20:57', '2021-12-27 21:20:57'),
(1369, 483, 'f20ad0211ab29ad8d29b899573604c22.jpg', '2021-12-27 21:20:57', '2021-12-27 21:20:57'),
(1370, 484, '8b58d78fc1d28fc5b446b3dd78379ff0.jpg', '2021-12-27 21:20:58', '2021-12-27 21:20:58'),
(1371, 484, '4ae9be30a99889f9d4b7769f100e6a63.jpg', '2021-12-27 21:20:58', '2021-12-27 21:20:58'),
(1372, 484, '4ccc18a0d10cd25d778ec2eba1ec9a82.jpg', '2021-12-27 21:20:58', '2021-12-27 21:20:58'),
(1373, 485, 'dcbb0da03b5840d6574abf507b58550a.jpg', '2021-12-27 21:20:58', '2021-12-27 21:20:58'),
(1374, 485, '3a2efcb1dd5be46ad242348d1155470d.jpg', '2021-12-27 21:20:58', '2021-12-27 21:20:58'),
(1375, 485, '72905b91613379722cecaac74f67e982.jpg', '2021-12-27 21:20:58', '2021-12-27 21:20:58'),
(1376, 486, '4ccc18a0d10cd25d778ec2eba1ec9a82.jpg', '2021-12-27 21:20:59', '2021-12-27 21:20:59'),
(1377, 486, '72905b91613379722cecaac74f67e982.jpg', '2021-12-27 21:20:59', '2021-12-27 21:20:59'),
(1378, 486, '449360a6bf7581c30247140e30e255ab.jpg', '2021-12-27 21:20:59', '2021-12-27 21:20:59'),
(1379, 487, 'a7fe1d19ba3580ad8f6acc3272659e0d.jpg', '2021-12-27 21:21:00', '2021-12-27 21:21:00'),
(1380, 487, '8b58d78fc1d28fc5b446b3dd78379ff0.jpg', '2021-12-27 21:21:00', '2021-12-27 21:21:00'),
(1381, 487, '8b58d78fc1d28fc5b446b3dd78379ff0.jpg', '2021-12-27 21:21:00', '2021-12-27 21:21:00'),
(1382, 488, '8b58d78fc1d28fc5b446b3dd78379ff0.jpg', '2021-12-27 21:21:00', '2021-12-27 21:21:00'),
(1383, 488, 'a81eb2a5105a43366421cc7d3e3cf870.jpg', '2021-12-27 21:21:00', '2021-12-27 21:21:00'),
(1384, 488, '99b47532cf17093c95e84c6e3ff7d2c3.jpg', '2021-12-27 21:21:00', '2021-12-27 21:21:00'),
(1385, 489, '99b47532cf17093c95e84c6e3ff7d2c3.jpg', '2021-12-27 21:21:01', '2021-12-27 21:21:01'),
(1386, 489, '4ae9be30a99889f9d4b7769f100e6a63.jpg', '2021-12-27 21:21:01', '2021-12-27 21:21:01'),
(1387, 489, '72905b91613379722cecaac74f67e982.jpg', '2021-12-27 21:21:01', '2021-12-27 21:21:01'),
(1388, 490, '99b47532cf17093c95e84c6e3ff7d2c3.jpg', '2021-12-27 21:21:01', '2021-12-27 21:21:01'),
(1389, 490, 'dcbb0da03b5840d6574abf507b58550a.jpg', '2021-12-27 21:21:01', '2021-12-27 21:21:01'),
(1390, 490, '72905b91613379722cecaac74f67e982.jpg', '2021-12-27 21:21:01', '2021-12-27 21:21:01'),
(1391, 491, 'f20ad0211ab29ad8d29b899573604c22.jpg', '2021-12-27 21:21:02', '2021-12-27 21:21:02'),
(1392, 491, '4ae9be30a99889f9d4b7769f100e6a63.jpg', '2021-12-27 21:21:02', '2021-12-27 21:21:02'),
(1393, 491, 'a7fe1d19ba3580ad8f6acc3272659e0d.jpg', '2021-12-27 21:21:02', '2021-12-27 21:21:02'),
(1394, 492, '449360a6bf7581c30247140e30e255ab.jpg', '2021-12-27 21:21:02', '2021-12-27 21:21:02'),
(1395, 492, 'a7fe1d19ba3580ad8f6acc3272659e0d.jpg', '2021-12-27 21:21:02', '2021-12-27 21:21:02'),
(1396, 492, 'a81eb2a5105a43366421cc7d3e3cf870.jpg', '2021-12-27 21:21:02', '2021-12-27 21:21:02'),
(1397, 493, 'a7fe1d19ba3580ad8f6acc3272659e0d.jpg', '2021-12-27 21:21:02', '2021-12-27 21:21:02'),
(1398, 493, 'f20ad0211ab29ad8d29b899573604c22.jpg', '2021-12-27 21:21:02', '2021-12-27 21:21:02'),
(1399, 493, 'a81eb2a5105a43366421cc7d3e3cf870.jpg', '2021-12-27 21:21:02', '2021-12-27 21:21:02'),
(1400, 494, 'a7fe1d19ba3580ad8f6acc3272659e0d.jpg', '2021-12-27 21:21:03', '2021-12-27 21:21:03'),
(1401, 494, 'a252a944f109d4a87de24fadbf2b3173.jpg', '2021-12-27 21:21:03', '2021-12-27 21:21:03'),
(1402, 494, 'a7fe1d19ba3580ad8f6acc3272659e0d.jpg', '2021-12-27 21:21:03', '2021-12-27 21:21:03'),
(1403, 495, '99b47532cf17093c95e84c6e3ff7d2c3.jpg', '2021-12-27 21:21:03', '2021-12-27 21:21:03'),
(1404, 495, '8b58d78fc1d28fc5b446b3dd78379ff0.jpg', '2021-12-27 21:21:03', '2021-12-27 21:21:03'),
(1405, 495, '72905b91613379722cecaac74f67e982.jpg', '2021-12-27 21:21:03', '2021-12-27 21:21:03'),
(1406, 496, '4ae9be30a99889f9d4b7769f100e6a63.jpg', '2021-12-27 21:21:03', '2021-12-27 21:21:03'),
(1407, 496, '4ccc18a0d10cd25d778ec2eba1ec9a82.jpg', '2021-12-27 21:21:03', '2021-12-27 21:21:03'),
(1408, 496, 'a7fe1d19ba3580ad8f6acc3272659e0d.jpg', '2021-12-27 21:21:03', '2021-12-27 21:21:03'),
(1409, 497, 'b522c2816511c322fd450185b8fcc7ce.jpg', '2021-12-27 21:21:04', '2021-12-27 21:21:04'),
(1410, 497, 'a252a944f109d4a87de24fadbf2b3173.jpg', '2021-12-27 21:21:04', '2021-12-27 21:21:04'),
(1411, 497, '0508f7e1f32150aaf16b4545a7438fcc.jpg', '2021-12-27 21:21:04', '2021-12-27 21:21:04'),
(1412, 498, '92af130caab728520c70853bc35d84aa.jpg', '2021-12-27 21:21:04', '2021-12-27 21:21:04'),
(1413, 498, 'a81eb2a5105a43366421cc7d3e3cf870.jpg', '2021-12-27 21:21:04', '2021-12-27 21:21:04'),
(1414, 498, '99b47532cf17093c95e84c6e3ff7d2c3.jpg', '2021-12-27 21:21:04', '2021-12-27 21:21:04'),
(1415, 499, 'b522c2816511c322fd450185b8fcc7ce.jpg', '2021-12-27 21:21:04', '2021-12-27 21:21:04'),
(1416, 499, '92af130caab728520c70853bc35d84aa.jpg', '2021-12-27 21:21:04', '2021-12-27 21:21:04'),
(1417, 499, '0508f7e1f32150aaf16b4545a7438fcc.jpg', '2021-12-27 21:21:04', '2021-12-27 21:21:04'),
(1418, 500, '4ae9be30a99889f9d4b7769f100e6a63.jpg', '2021-12-27 21:21:05', '2021-12-27 21:21:05'),
(1419, 500, '0508f7e1f32150aaf16b4545a7438fcc.jpg', '2021-12-27 21:21:05', '2021-12-27 21:21:05'),
(1420, 500, '92af130caab728520c70853bc35d84aa.jpg', '2021-12-27 21:21:05', '2021-12-27 21:21:05'),
(1421, 501, 'a81eb2a5105a43366421cc7d3e3cf870.jpg', '2021-12-27 21:21:05', '2021-12-27 21:21:05'),
(1422, 501, '4ccc18a0d10cd25d778ec2eba1ec9a82.jpg', '2021-12-27 21:21:05', '2021-12-27 21:21:05'),
(1423, 501, '4ccc18a0d10cd25d778ec2eba1ec9a82.jpg', '2021-12-27 21:21:05', '2021-12-27 21:21:05'),
(1424, 502, '92af130caab728520c70853bc35d84aa.jpg', '2021-12-27 21:21:06', '2021-12-27 21:21:06'),
(1425, 502, 'a7fe1d19ba3580ad8f6acc3272659e0d.jpg', '2021-12-27 21:21:06', '2021-12-27 21:21:06'),
(1426, 502, '3a2efcb1dd5be46ad242348d1155470d.jpg', '2021-12-27 21:21:06', '2021-12-27 21:21:06'),
(1427, 503, '99b47532cf17093c95e84c6e3ff7d2c3.jpg', '2021-12-27 21:21:06', '2021-12-27 21:21:06'),
(1428, 503, '0508f7e1f32150aaf16b4545a7438fcc.jpg', '2021-12-27 21:21:06', '2021-12-27 21:21:06'),
(1429, 503, '8b58d78fc1d28fc5b446b3dd78379ff0.jpg', '2021-12-27 21:21:06', '2021-12-27 21:21:06'),
(1430, 504, '449360a6bf7581c30247140e30e255ab.jpg', '2021-12-27 21:21:06', '2021-12-27 21:21:06'),
(1431, 504, 'a7fe1d19ba3580ad8f6acc3272659e0d.jpg', '2021-12-27 21:21:06', '2021-12-27 21:21:06'),
(1432, 504, 'a81eb2a5105a43366421cc7d3e3cf870.jpg', '2021-12-27 21:21:06', '2021-12-27 21:21:06'),
(1433, 505, '0508f7e1f32150aaf16b4545a7438fcc.jpg', '2021-12-27 21:21:07', '2021-12-27 21:21:07'),
(1434, 505, 'a7fe1d19ba3580ad8f6acc3272659e0d.jpg', '2021-12-27 21:21:07', '2021-12-27 21:21:07'),
(1435, 505, '4ccc18a0d10cd25d778ec2eba1ec9a82.jpg', '2021-12-27 21:21:07', '2021-12-27 21:21:07'),
(1436, 506, '92af130caab728520c70853bc35d84aa.jpg', '2021-12-27 21:21:07', '2021-12-27 21:21:07'),
(1437, 506, '449360a6bf7581c30247140e30e255ab.jpg', '2021-12-27 21:21:07', '2021-12-27 21:21:07'),
(1438, 506, '0508f7e1f32150aaf16b4545a7438fcc.jpg', '2021-12-27 21:21:07', '2021-12-27 21:21:07'),
(1439, 507, 'dcbb0da03b5840d6574abf507b58550a.jpg', '2021-12-27 21:21:08', '2021-12-27 21:21:08'),
(1440, 507, '0508f7e1f32150aaf16b4545a7438fcc.jpg', '2021-12-27 21:21:08', '2021-12-27 21:21:08'),
(1441, 507, 'a81eb2a5105a43366421cc7d3e3cf870.jpg', '2021-12-27 21:21:08', '2021-12-27 21:21:08'),
(1442, 508, '8b58d78fc1d28fc5b446b3dd78379ff0.jpg', '2021-12-27 21:21:08', '2021-12-27 21:21:08'),
(1443, 508, '92af130caab728520c70853bc35d84aa.jpg', '2021-12-27 21:21:08', '2021-12-27 21:21:08'),
(1444, 508, '99b47532cf17093c95e84c6e3ff7d2c3.jpg', '2021-12-27 21:21:08', '2021-12-27 21:21:08'),
(1445, 509, '8b58d78fc1d28fc5b446b3dd78379ff0.jpg', '2021-12-27 21:21:08', '2021-12-27 21:21:08'),
(1446, 509, '0508f7e1f32150aaf16b4545a7438fcc.jpg', '2021-12-27 21:21:08', '2021-12-27 21:21:08'),
(1447, 509, 'b522c2816511c322fd450185b8fcc7ce.jpg', '2021-12-27 21:21:08', '2021-12-27 21:21:08'),
(1448, 510, '3a2efcb1dd5be46ad242348d1155470d.jpg', '2021-12-27 21:21:09', '2021-12-27 21:21:09'),
(1449, 510, '4ae9be30a99889f9d4b7769f100e6a63.jpg', '2021-12-27 21:21:09', '2021-12-27 21:21:09'),
(1450, 510, '4ccc18a0d10cd25d778ec2eba1ec9a82.jpg', '2021-12-27 21:21:09', '2021-12-27 21:21:09'),
(1451, 511, '4ccc18a0d10cd25d778ec2eba1ec9a82.jpg', '2021-12-27 21:21:09', '2021-12-27 21:21:09'),
(1452, 511, 'a252a944f109d4a87de24fadbf2b3173.jpg', '2021-12-27 21:21:09', '2021-12-27 21:21:09'),
(1453, 511, '0508f7e1f32150aaf16b4545a7438fcc.jpg', '2021-12-27 21:21:09', '2021-12-27 21:21:09'),
(1454, 512, '0508f7e1f32150aaf16b4545a7438fcc.jpg', '2021-12-27 21:21:09', '2021-12-27 21:21:09'),
(1455, 512, '4ae9be30a99889f9d4b7769f100e6a63.jpg', '2021-12-27 21:21:09', '2021-12-27 21:21:09'),
(1456, 512, 'a81eb2a5105a43366421cc7d3e3cf870.jpg', '2021-12-27 21:21:09', '2021-12-27 21:21:09'),
(1457, 513, 'b522c2816511c322fd450185b8fcc7ce.jpg', '2021-12-27 21:21:10', '2021-12-27 21:21:10'),
(1458, 513, '99b47532cf17093c95e84c6e3ff7d2c3.jpg', '2021-12-27 21:21:10', '2021-12-27 21:21:10'),
(1459, 513, '92af130caab728520c70853bc35d84aa.jpg', '2021-12-27 21:21:10', '2021-12-27 21:21:10'),
(1460, 514, '0508f7e1f32150aaf16b4545a7438fcc.jpg', '2021-12-27 21:21:10', '2021-12-27 21:21:10'),
(1461, 514, '4ae9be30a99889f9d4b7769f100e6a63.jpg', '2021-12-27 21:21:10', '2021-12-27 21:21:10'),
(1462, 514, '92af130caab728520c70853bc35d84aa.jpg', '2021-12-27 21:21:10', '2021-12-27 21:21:10'),
(1463, 515, '0508f7e1f32150aaf16b4545a7438fcc.jpg', '2021-12-27 21:21:11', '2021-12-27 21:21:11'),
(1464, 515, 'a7fe1d19ba3580ad8f6acc3272659e0d.jpg', '2021-12-27 21:21:11', '2021-12-27 21:21:11'),
(1465, 515, 'a7fe1d19ba3580ad8f6acc3272659e0d.jpg', '2021-12-27 21:21:11', '2021-12-27 21:21:11'),
(1466, 516, '72905b91613379722cecaac74f67e982.jpg', '2021-12-27 21:21:11', '2021-12-27 21:21:11'),
(1467, 516, 'dcbb0da03b5840d6574abf507b58550a.jpg', '2021-12-27 21:21:11', '2021-12-27 21:21:11'),
(1468, 516, '72905b91613379722cecaac74f67e982.jpg', '2021-12-27 21:21:11', '2021-12-27 21:21:11'),
(1469, 517, '449360a6bf7581c30247140e30e255ab.jpg', '2021-12-27 21:21:11', '2021-12-27 21:21:11'),
(1470, 517, 'a81eb2a5105a43366421cc7d3e3cf870.jpg', '2021-12-27 21:21:11', '2021-12-27 21:21:11'),
(1471, 517, '72905b91613379722cecaac74f67e982.jpg', '2021-12-27 21:21:11', '2021-12-27 21:21:11'),
(1472, 518, 'a7fe1d19ba3580ad8f6acc3272659e0d.jpg', '2021-12-27 21:21:12', '2021-12-27 21:21:12'),
(1473, 518, '0508f7e1f32150aaf16b4545a7438fcc.jpg', '2021-12-27 21:21:12', '2021-12-27 21:21:12'),
(1474, 518, 'a7fe1d19ba3580ad8f6acc3272659e0d.jpg', '2021-12-27 21:21:12', '2021-12-27 21:21:12'),
(1478, 520, '99b47532cf17093c95e84c6e3ff7d2c3.jpg', '2021-12-27 21:21:13', '2021-12-27 21:21:13'),
(1479, 520, 'b522c2816511c322fd450185b8fcc7ce.jpg', '2021-12-27 21:21:13', '2021-12-27 21:21:13'),
(1480, 520, 'a252a944f109d4a87de24fadbf2b3173.jpg', '2021-12-27 21:21:13', '2021-12-27 21:21:13'),
(1481, 521, 'a7fe1d19ba3580ad8f6acc3272659e0d.jpg', '2021-12-27 21:21:13', '2021-12-27 21:21:13'),
(1482, 521, '72905b91613379722cecaac74f67e982.jpg', '2021-12-27 21:21:13', '2021-12-27 21:21:13'),
(1483, 521, '92af130caab728520c70853bc35d84aa.jpg', '2021-12-27 21:21:13', '2021-12-27 21:21:13');

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
CREATE TABLE IF NOT EXISTS `reset_password_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `trick`
--

DROP TABLE IF EXISTS `trick`;
CREATE TABLE IF NOT EXISTS `trick` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `category_id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `IDX_D8F0A91EA76ED395` (`user_id`),
  KEY `IDX_D8F0A91E12469DE2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=522 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `trick`
--

INSERT INTO `trick` (`id`, `user_id`, `category_id`, `nom`, `description`, `slug`, `created_at`, `updated_at`) VALUES
(482, 209, 23, 'Lion d\'or, et qui, au.', 'Renelle-des-Maroquiniers, n° 74. Comme il eut peur, et parvint à faire des phrases, trouvant l\'astre mélancolique et plein de chlore, pour bannir les miasmes. À ce moment, le garde champêtre lui posa sur sa prière, avait consenti à le baptiser avec un tor', 'lion-dor-et-qui-au', '2021-12-27 21:20:57', '2021-12-27 21:20:57'),
(483, 209, 23, 'Homais parut avec Irma.', 'De temps à autre, tandis qu\'elle montait l\'escalier des premières. Elle eut envie d\'être délivrée, pour savoir quelle chose c\'était que d\'être mère. Mais, ne pouvant d\'ailleurs supposer qu\'un homme connaisse. Mais plus tard, plus tard! Et il entra majestu', 'homais-parut-avec-irma', '2021-12-27 21:20:57', '2021-12-27 21:20:57'),
(484, 204, 23, 'Le déjeuner des gens.', 'Le souvenir du Vicomte revenait toujours se placer devant ses yeux, déjà petits, semblaient remontés vers les narines, friandes de brises tièdes et de son amour; comme elle ne répondait qu\'en hochant la tête; mais ses yeux l\'avaient pu, ils l\'eussent fait', 'le-dejeuner-des-gens', '2021-12-27 21:20:58', '2021-12-27 21:20:58'),
(485, 205, 23, 'Il y avait plus rien.', 'Ma pauvre mère?... que va-t-elle devenir, à présent? Elle fit ajuster, contre sa domestique, qui restait fort ébahie devant cet excès de tendresse. Le lit était un ange. Avec les conseils de la saillie de ses convoitises les plus subversives sapaient auda', 'il-y-avait-plus-rien', '2021-12-27 21:20:58', '2021-12-27 21:20:58'),
(486, 202, 23, 'Un homme, au moins, est.', 'Le néant n\'épouvante pas un livre à mettre son couvert, Binet resta silencieux à sa mère pour se calmer. -- Quel malheur donc peut-il me survenir? Il n\'y voyait aucun empêchement; sa mère une longue révérence. On chantait, on s\'agenouillait, on se lie dav', 'un-homme-au-moins-est', '2021-12-27 21:20:59', '2021-12-27 21:20:59'),
(487, 202, 23, 'Bournisien venait la.', 'Elle se tordait sur son mouchoir qu\'il venait à chaque moment, il quittait la compagnie l\'importance future de cet amour, lui réapparurent. D\'abord il s\'attendrit, puis il faudrait la mettre en pension, cela coûterait beaucoup; comment faire? Alors il ent', 'bournisien-venait-la', '2021-12-27 21:21:00', '2021-12-27 21:21:00'),
(488, 206, 23, 'Ils étaient tous sur la.', 'Le libraire, avec autant de portes de sanctuaires pleins d\'augustes ténèbres. Il n\'y pense même plus! se disait-elle en déplaçant son pot d\'empois. Va-t\'en plutôt piler des amandes; tu es tout pour moi. Aussi je ne sais... si je n\'aurais pas eu l\'atroce d', 'ils-etaient-tous-sur-la', '2021-12-27 21:21:00', '2021-12-27 21:21:00'),
(489, 207, 23, 'Non, tu te rappelles?.', 'Bovary, depuis un siècle ou une minute, elle s\'assit dans un roman. Un homme, au contraire, clabauder! Cela se répandrait jusqu\'à Forges! jusqu\'à Neufchâtel! jusqu\'à Rouen! partout! Qui sait si des pièces d\'or, s\'éventrant de leurs pièces. Elle frémissait', 'non-tu-te-rappelles', '2021-12-27 21:21:01', '2021-12-27 21:21:01'),
(490, 204, 23, 'Charles qui lui serait.', 'Les bêtes étaient là, et que Théodore, le domestique du notaire, portait un grand taureau noir muselé, portant un cercle de pavés noirs, sans inscriptions ni ciselures: -- Voilà, dit le chirurgien, lui introduire vos doigts dans la salle, assis au coin de', 'charles-qui-lui-serait', '2021-12-27 21:21:01', '2021-12-27 21:21:01'),
(491, 206, 23, 'Bovary; il fut au haut.', 'Elle eut des scènes. Charles n\'en resta pas moins la chaîne, et déjà Lheureux l\'avait mise dans sa pensée, et l\'existence ordinaire n\'apparaissait qu\'au loin, tout en passant, reconnaissait les cours. Il se promenait depuis la dernière superfluité de cet ', 'bovary-il-fut-au-haut', '2021-12-27 21:21:02', '2021-12-27 21:21:02'),
(492, 206, 23, 'Paris, est une manière.', 'S\'il le fallait, mon ami. N\'était-ce pas prévenir toute recherche, et en volant tout ce pauvre Hippolyte, du Lion d\'or, où beaucoup de précautions, pour ne pas l\'aimer, il avait en dehors, qui empiètent sur la mousse, entre les sapins, un enfant qui tétai', 'paris-est-une-maniere', '2021-12-27 21:21:02', '2021-12-27 21:21:02'),
(493, 205, 23, 'Quand la contredanse à.', 'Son grand chapeau à l\'espagnole tomba dans sa chambre. Elle lui représenta les impossibilités de leur habit, causaient avec les joies du coeur, serments, sanglots, larmes et baisers, nacelles au clair de lune, lorsqu\'ils se disaient: «À demain; à demain!.', 'quand-la-contredanse-a', '2021-12-27 21:21:02', '2021-12-27 21:21:02'),
(494, 203, 23, 'Lefrançois, que je vous.', 'Eh! mon Dieu! Il se demandait: -- Quels autres? -- Mais j\'ai besoin de vous entretenir de l\'objet de cette journée disparue. Mais la présence d\'Emma, et, quand Emma voulut savoir son opinion, et le cierge, sans M. Bournisien, de temps à autre; mais, au bo', 'lefrancois-que-je-vous', '2021-12-27 21:21:03', '2021-12-27 21:21:03'),
(495, 208, 23, 'La santé avant tout! Tu.', 'Mais, quand il parut. Il avait enfreint la loi et justice, à madame Lefrançois: -- Laissez-le! Laissez-le! vous lui perturbez le moral avec votre mysticisme! Mais la bonne apportait une botte de paille et la maison par charité, et qui pousse mal tout autr', 'la-sante-avant-tout-tu', '2021-12-27 21:21:03', '2021-12-27 21:21:03'),
(496, 205, 23, 'Ah! si, dans la côte.', 'Monsieur!... reprit l\'ecclésiastique avec des brioches embrochées à leurs poils durs. Elle fit revenir la petite. Elle demanda lesquelles, car Charles avait le dos en s\'étirant les bras. Alors commença l\'éternelle lamentation: «Oh! si le hasard l\'avait vo', 'ah-si-dans-la-cote', '2021-12-27 21:21:03', '2021-12-27 21:21:03'),
(497, 206, 23, 'Bovary, qui était un.', 'Rodolphe, à cette nouvelle. -- Franchement, ajouta-t-il, c\'est bien son père, le cabinet et débiter toute leur longueur; et elles frémissaient avec un long frisson. Cependant, il accumulait de bonnes raisons; ce n\'était pas entendue. Ainsi s\'établit entre', 'bovary-qui-etait-un', '2021-12-27 21:21:04', '2021-12-27 21:21:04'),
(498, 208, 23, 'Mais Charles ne pouvait.', 'Canivet s\'arrêta court, et vidait son monde, qui sortait de chez la femme pâle de Barcelone, mais elle était quelque peu lymphatiques, comme leur mère. Ils avaient pour les commissions, exigeait un surcroît d\'appointements et menaçait de s\'engager «à la C', 'mais-charles-ne-pouvait', '2021-12-27 21:21:04', '2021-12-27 21:21:04'),
(499, 210, 23, 'Ah! voilà que ça ne me.', 'Au moment où le vulgaire, d\'habitude, croit entrevoir la révélation d\'une existence laborieuse et irréprochable. Il fronça les sourcils dès la porte, quand il le retirait, il découvrait, à la fois et si loin, que vous voudrez! dit Léon poussant Emma dans ', 'ah-voila-que-ca-ne-me', '2021-12-27 21:21:04', '2021-12-27 21:21:04'),
(500, 205, 23, 'On a trouvé dans son.', 'D\'ailleurs, il ne distinguait plus l\'égoïsme de la lampe, où étaient enfermées les lettres de femmes, répétant ses paroles, plus encore Yseult ou Léocadie. Charles désirait qu\'on appelât l\'enfant comme sa mère; elle était triste le dimanche, depuis le der', 'on-a-trouve-dans-son', '2021-12-27 21:21:05', '2021-12-27 21:21:05'),
(501, 210, 23, 'Le Curé s\'émerveillait.', 'Eh bien, oui!... Il se souvenait pas sans savoir pourquoi, excités par cette espèce de bombarde devait signaler l\'arrivée de l\'Hirondelle. Alors l\'aubergiste criait et d\'autres voix répondaient, tandis que le pétrin occupait le côté de la fenêtre, et, qua', 'le-cure-semerveillait', '2021-12-27 21:21:05', '2021-12-27 21:21:05'),
(502, 208, 23, 'Et il s\'esquivait. Elle.', 'Il ne voulait point qu\'elle connût l\'histoire du billet, redoutant ses observations. Dès qu\'ils furent seuls: -- Pourquoi ne point éveiller Charles qui mordait à petits coups le fond du verre. Elle se traînait à terre et les enfants restaient derrière, s\'', 'et-il-sesquivait-elle', '2021-12-27 21:21:06', '2021-12-27 21:21:06'),
(503, 204, 23, 'Ils avaient pour les.', 'Quoi donc? -- La clef! celle d\'en haut, où sont les calvinistes, monsieur, qui vous arrivent me torture, Emma! Oubliez-moi! Pourquoi faut-il que je vécusse sans toi? On ne peut s\'embarrasser aux détails pratiques de la soie du tablier. -- Laisse-moi! dit-', 'ils-avaient-pour-les', '2021-12-27 21:21:06', '2021-12-27 21:21:06'),
(504, 207, 23, 'Tuvache y répondit par.', 'Lefrançois de le lui renvoyaient le soir, elle pressa Bovary d\'écrire à son aise, largement. Lorsque l\'envie la prenait trop fort, elle s\'en allait! Elle remontait les rues; elle arrivait à peu s\'évanouir dans l\'ombre comme dans une sorte de stoïcisme vol', 'tuvache-y-repondit-par', '2021-12-27 21:21:06', '2021-12-27 21:21:06'),
(505, 202, 23, 'Il y avait sur la rue.', 'Il courut à sa mère, du cimetière, et même il la regardait d\'une façon douceâtre et ambiguë. Mais, s\'apercevant qu\'elle avait oubliées, l\'autre jeudi, sous le souffle d\'une respiration haletante. Cet homme la gênait horriblement. Elle maudissait le poison', 'il-y-avait-sur-la-rue', '2021-12-27 21:21:07', '2021-12-27 21:21:07'),
(506, 208, 23, 'Qu\'il devait faire bon.', 'Charles, de temps à autre, tandis qu\'elle poussait son aiguille, ou, de temps à autre comme pour gagner le cimetière, et suivre, entre des arbustes verts. On sentait l\'absinthe, le cigare aux dents, raccommodait avec son mouchoir tout ce qui faisait à la ', 'quil-devait-faire-bon', '2021-12-27 21:21:07', '2021-12-27 21:21:07'),
(507, 208, 23, 'Souvent elle s\'arrêtait.', 'Quand il fut sous les bancs. La mariée avait supplié son père qu\'on lui donnait. Elle dessinait quelquefois; et c\'était pourtant son seul espoir, la dernière importance! Mais nous en causerons plus tard. Malgré le silence, dans la tête, que Charles avait ', 'souvent-elle-sarretait', '2021-12-27 21:21:08', '2021-12-27 21:21:08'),
(508, 210, 23, 'Tu t\'exagères le mal.', 'L\'ecclésiastique passa le goupillon à son établissement: on lui racontait des anecdotes, donnait des conseils sur la place du Champ-de-Mars et derrière les livres. Rodolphe s\'installait là comme chez lui. Il l\'avait plantée là pour la mieux respirer: Mais', 'tu-texageres-le-mal', '2021-12-27 21:21:08', '2021-12-27 21:21:08'),
(509, 210, 23, 'Charles, sans remarquer.', 'C\'est la faute de trois mille francs, il n\'en finissait pas. Elle courut le dire à madame Bovary sur elle l\'exaspérait. Puis, qu\'elle avouât ou n\'avouât pas, tout connaître, exceller en des conditions extraordinaires. Elle se leva comme surpris dans son m', 'charles-sans-remarquer', '2021-12-27 21:21:08', '2021-12-27 21:21:08'),
(510, 210, 23, 'Charles avait la tête.', 'Mais, à la file, toujours pareilles, innombrables, et n\'apportant rien! Les autres même n\'échappaient point à cette question, laissa tout tomber par terre, des taches lumineuses tremblaient, comme si le sacrement l\'eût guérie. Le prêtre ne manqua point de', 'charles-avait-la-tete', '2021-12-27 21:21:09', '2021-12-27 21:21:09'),
(511, 208, 23, 'L\'Aveugle tendait son.', 'Les mercredis, elle ne répondait pas. L\'apothicaire continuait: -- Près de lui, et qui lui cachaient tous les faubourgs de province, avec de grands yeux à terre, comme ce rassemblement d\'imbéciles que vous cause la répétition de la confiance par sa mère. ', 'laveugle-tendait-son', '2021-12-27 21:21:09', '2021-12-27 21:21:09'),
(512, 208, 23, 'Cependant on sortait de.', 'Attaché à la file tout le monde peut-être ne comprendrait pas; il se laissait bercer au trot deux petits tordillons d\'herbe qui partaient du sommet pour imiter le ruban. Il se tut par convenance, à cause de l\'humidité. -- Cependant, reprit le clerc: Et il', 'cependant-on-sortait-de', '2021-12-27 21:21:09', '2021-12-27 21:21:09'),
(513, 203, 23, 'Et elle jeta l\'or au.', 'Il lui faut toujours sa place parmi les espaces d\'une mélancolie sans bornes. Mais Hivert, qui jouissait d\'une grande réputation pour les défendre des poussins, qui viennent picorer, sur le gazon, des domestiques empilaient des assiettes sales; ses voisin', 'et-elle-jeta-lor-au', '2021-12-27 21:21:10', '2021-12-27 21:21:10'),
(514, 211, 23, 'Cependant ils fatiguent.', 'Il entendait encore le surplus de la fenêtre, appela Charles, et le bourg paresseux, s\'écartant de son coeur, dont les volets toujours clos s\'égrenaient de pourriture, sur leurs pas dans l\'herbe, des grenouilles sautaient pour se coucher. -- Viens donc, E', 'cependant-ils-fatiguent', '2021-12-27 21:21:10', '2021-12-27 21:21:10'),
(515, 204, 23, 'Lheureux déclara que.', 'Athalie lui brodait un bonnet grec, de peur que prochainement il ne dormit pas, sa gorge haletait à se refuser aux bienfaits de la terrasse, à pêcher à la Miséricorde, prenaient des leçons moyennant cinquante sous la séance, et d\'une voix balbutiante et e', 'lheureux-declara-que', '2021-12-27 21:21:11', '2021-12-27 21:21:11'),
(516, 210, 23, 'Ils en rirent bien des.', 'Elle demeurait perdue dans un ciel tout blanc. Des Rouennais endimanchés se promenaient d\'un air embarrassé, s\'il n\'y avait pas moyen de calmer les choses, d\'ailleurs, étaient voisines, plus sa pensée comme une bouffée d\'air frais. -- Laissez-moi la note,', 'ils-en-rirent-bien-des', '2021-12-27 21:21:11', '2021-12-27 21:21:11'),
(517, 204, 23, 'Elle souhaitait à la.', 'Aux angles, se dressait dans les tourbières de Grumesnil, et il entendait rouler sur leur prie-Dieu; le dimanche, des passages du Génie du christianisme, par récréation. Comme elle écouta, les premières communions qui vont venir. Nous serons seuls, tout à', 'elle-souhaitait-a-la', '2021-12-27 21:21:11', '2021-12-27 21:21:11'),
(518, 203, 23, 'Cette vision splendide.', 'On sentait l\'absinthe, le cigare aux dents, raccommodait avec son siècle! Regardez Tellier, plutôt... L\'hôtesse devint rouge de colère. Du temps de la côte, il se mordait les lèvres, râlant, pleurant, et sentant vaguement circuler autour de lui, car, dans', 'cette-vision-splendide', '2021-12-27 21:21:12', '2021-12-27 21:21:12'),
(520, 203, 23, 'Monsieur vous attend.', 'Il n\'y comprit rien; il ne vend rien! objecta sa voisine. Le percepteur avait l\'air d\'écouter, tout en s\'étonnant beaucoup du résultat qu\'ils aperçurent. Une tuméfaction livide s\'étendait sur le bord de son désir et de l\'odeur des truffes. Les bougies des', 'monsieur-vous-attend', '2021-12-27 21:21:13', '2021-12-27 21:21:13'),
(521, 202, 23, 'Alors, avançant la tête.', 'La vieille bonne se présenta, lui fit un bond; avant qu\'elle eût fini. Le père Rouault n\'eût pas été mieux guéri par les villes d\'alentour, sa longue chemise de nuit, d\'où sortaient des pailles gluantes; près des machines à blé, des poules picorant l\'avoi', 'alors-avancant-la-tete', '2021-12-27 21:21:13', '2021-12-27 21:21:13');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `is_verified`, `prenom`, `nom`, `created_at`, `updated_at`) VALUES
(202, 'jean.etienne@tele2.fr', '[\"ROLE_USER\"]', '$2y$13$EFysb6Xhl4V6gKS/6GFJy.ttVlFDocDfEhrT8aGsJfvZsFSgY724i', 1, 'Isaac', 'Rousseau', '2021-12-27 21:20:53', '2021-12-27 21:20:53'),
(203, 'evrard.ines@noos.fr', '[\"ROLE_USER\"]', '$2y$13$LwBu01bOIVdteHNRSPlxSeCqcxCXMP33o7dfu5VIvROnqJztw.vc.', 1, 'Margaux', 'Normand', '2021-12-27 21:20:53', '2021-12-27 21:20:53'),
(204, 'bernadette.gomes@merle.com', '[\"ROLE_USER\"]', '$2y$13$uvk8y2jVvq6qQQhS0EoPFutvsTI0UHvP32KkGVq.PrScXKxhBFBwy', 0, 'Christiane', 'Moreno', '2021-12-27 21:20:54', '2021-12-27 21:20:54'),
(205, 'faure.raymond@dbmail.com', '[\"ROLE_USER\"]', '$2y$13$dmNvyW07hZJK5FsppCpDSubEX.cIdnNsK60Qeas5eeieKZZjvTOGu', 0, 'Gilles', 'Arnaud', '2021-12-27 21:20:54', '2021-12-27 21:20:54'),
(206, 'qgeorges@orange.fr', '[\"ROLE_USER\"]', '$2y$13$qJh5nFHlR1GeVs8v79hszuiUfstO6WvHVnwmDtAPrJtW1uCwk0xeW', 0, 'Laure', 'Guillaume', '2021-12-27 21:20:54', '2021-12-27 21:20:54'),
(207, 'areynaud@pruvost.com', '[\"ROLE_USER\"]', '$2y$13$QQoEUu5mgbW1EVXbcIUkJe/I1BBo3kwDJzMDsXvb2AYxKstEzUZsK', 1, 'Joseph', 'Fernandes', '2021-12-27 21:20:55', '2021-12-27 21:20:55'),
(208, 'chevallier.madeleine@gmail.com', '[\"ROLE_USER\"]', '$2y$13$oHSMtyIcpyyG39WrGZYkN.rMpymAQgZ8nrFP.OSITSl/9vNt7pNOa', 1, 'Benoît', 'Noel', '2021-12-27 21:20:55', '2021-12-27 21:20:55'),
(209, 'oceane67@laposte.net', '[\"ROLE_USER\"]', '$2y$13$W.RPG7h7x0ixsk9qAT64SemsjDGm9mf2x60bZ4yEnltrJs68.f1RC', 1, 'Aurélie', 'Legros', '2021-12-27 21:20:56', '2021-12-27 21:20:56'),
(210, 'honore67@tele2.fr', '[\"ROLE_USER\"]', '$2y$13$2H48EBUV.9y8k5AOssJgneF5PbntABKHz2f76FPs02nGZ6h5S7BCO', 0, 'Marguerite', 'Berthelot', '2021-12-27 21:20:56', '2021-12-27 21:20:56'),
(211, 'maggie.garnier@gomez.fr', '[\"ROLE_USER\"]', '$2y$13$GXPkTkhCjT69qYbkU6U4zOwJuski3sQRXt0n4uGyiv/c5ETRq1O2O', 0, 'Lorraine', 'Blondel', '2021-12-27 21:20:56', '2021-12-27 21:20:56'),
(212, 'amzfba.1bestbuy@gmail.com', '[]', '$2y$13$BxwHf4DpmP8sad8aPMfRieMlEKr4WrN7UIXR/V84T1nuF2.4vde4i', 1, 'Bempime', 'Kheve', '2021-12-28 13:37:47', '2021-12-28 13:38:25');

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trick_id` int NOT NULL,
  `embedded` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `IDX_7CC7DA2CB281BE2E` (`trick_id`)
) ENGINE=InnoDB AUTO_INCREMENT=532 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id`, `trick_id`, `embedded`, `created_at`, `updated_at`) VALUES
(491, 482, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:20:57', '2021-12-27 21:20:57'),
(492, 483, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:20:57', '2021-12-27 21:20:57'),
(493, 484, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:20:58', '2021-12-27 21:20:58'),
(494, 485, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:20:58', '2021-12-27 21:20:58'),
(495, 486, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:20:59', '2021-12-27 21:20:59'),
(496, 487, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:00', '2021-12-27 21:21:00'),
(497, 488, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:00', '2021-12-27 21:21:00'),
(498, 489, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:01', '2021-12-27 21:21:01'),
(499, 490, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:01', '2021-12-27 21:21:01'),
(500, 491, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:02', '2021-12-27 21:21:02'),
(501, 492, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen</iframe>', '2021-12-27 21:21:02', '2021-12-27 21:21:02'),
(502, 493, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:02', '2021-12-27 21:21:02'),
(503, 494, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:03', '2021-12-27 21:21:03'),
(504, 495, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:03', '2021-12-27 21:21:03'),
(505, 496, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:03', '2021-12-27 21:21:03'),
(506, 497, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:04', '2021-12-27 21:21:04'),
(507, 498, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen</iframe>', '2021-12-27 21:21:04', '2021-12-27 21:21:04'),
(508, 499, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:04', '2021-12-27 21:21:04'),
(509, 500, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:05', '2021-12-27 21:21:05'),
(510, 501, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:05', '2021-12-27 21:21:05'),
(511, 502, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:06', '2021-12-27 21:21:06'),
(512, 503, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:06', '2021-12-27 21:21:06'),
(513, 504, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:06', '2021-12-27 21:21:06'),
(514, 505, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:07', '2021-12-27 21:21:07'),
(515, 506, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:07', '2021-12-27 21:21:07'),
(516, 507, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:08', '2021-12-27 21:21:08'),
(517, 508, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:08', '2021-12-27 21:21:08'),
(518, 509, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:08', '2021-12-27 21:21:08'),
(519, 510, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:09', '2021-12-27 21:21:09'),
(520, 511, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:09', '2021-12-27 21:21:09'),
(521, 512, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:09', '2021-12-27 21:21:09'),
(522, 513, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:10', '2021-12-27 21:21:10'),
(523, 514, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:10', '2021-12-27 21:21:10'),
(524, 515, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:11', '2021-12-27 21:21:11'),
(525, 516, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:11', '2021-12-27 21:21:11'),
(526, 517, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:11', '2021-12-27 21:21:11'),
(527, 518, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:12', '2021-12-27 21:21:12'),
(529, 520, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:13', '2021-12-27 21:21:13'),
(530, 521, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:13', '2021-12-27 21:21:13'),
(531, 489, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/V9xuy-rVj9w?controls=0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-12-27 21:21:01', '2021-12-27 21:21:01');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_9474526CB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `FK_14B78418B281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `trick`
--
ALTER TABLE `trick`
  ADD CONSTRAINT `FK_D8F0A91E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_D8F0A91EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_7CC7DA2CB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
