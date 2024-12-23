-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : sql213.infinityfree.com
-- Généré le :  Dim 20 oct. 2024 à 05:15
-- Version du serveur :  10.6.19-MariaDB
-- Version de PHP :  7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `if0_36929431_flotte03`
--

-- --------------------------------------------------------

--
-- Structure de la table `assrc_list`
--

CREATE TABLE `assrc_list` (
  `ID` int(10) NOT NULL,
  `imt` varchar(200) DEFAULT NULL,
  `att` varchar(200) DEFAULT NULL,
  `police` varchar(200) DEFAULT NULL,
  `marque` varchar(200) NOT NULL,
  `cle` varchar(200) NOT NULL,
  `assr` varchar(200) NOT NULL,
  `ct` varchar(200) NOT NULL,
  `dte` varchar(200) NOT NULL,
  `dtef` varchar(200) NOT NULL,
  `fin` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `assrc_list`
--

INSERT INTO `assrc_list` (`ID`, `imt`, `att`, `police`, `marque`, `cle`, `assr`, `ct`, `dte`, `dtef`, `fin`, `date`, `photo`, `CreationDate`) VALUES
(38, '145MLLA07', 'GKH-7555', 'HK542', 'SUZUKI', '42HJKLL', 'DG458', '10', '2024-09-10', '2024-09-11', '2024-09-27', '', '089d53602ce05a6444dbf1b94317ca9a1726050197.pdf', '2024-09-11 10:23:17');

-- --------------------------------------------------------

--
-- Structure de la table `attr_list`
--

CREATE TABLE `attr_list` (
  `aID` int(10) NOT NULL,
  `imt` varchar(120) DEFAULT NULL,
  `marque` varchar(120) DEFAULT NULL,
  `model` varchar(120) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `permis` varchar(100) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) NOT NULL,
  `genre` varchar(200) NOT NULL,
  `sexe` varchar(200) NOT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `ID` int(10) NOT NULL,
  `chID` int(10) NOT NULL,
  `dateN` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `attr_list`
--

INSERT INTO `attr_list` (`aID`, `imt`, `marque`, `model`, `date`, `permis`, `nom`, `prenom`, `genre`, `sexe`, `PostingDate`, `ID`, `chID`, `dateN`) VALUES
(64, '2840LA01', 'SUZUKI', 'Alto', '2024-05-10', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', 'Taxi', 'M', '2024-09-30 12:16:52', 13, 32, '1977-12-19'),
(67, 'AA-196-BG', 'SUZUKI', 'BALENO', '2024-07-06', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', 'Yango', 'M', '2024-09-30 14:58:28', 15, 29, '1977-01-13'),
(68, 'AA-196-BG', 'SUZUKI', 'BALENO', '2024-07-23', 'DJAK01-15-25013472YP', 'DJAKO', 'YAYO PAUL ARISTIDE', 'Yango', 'M', '2024-09-30 15:04:17', 15, 30, '2024-05-11'),
(69, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', '2024-09-10', 'YACO01-15-25024047WG', 'YACOLI', 'WACOUBO GUY - NOËL ', 'Yango', 'M', '2024-09-30 15:06:08', 46, 49, '1978-12-25'),
(70, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', '2024-09-23', 'DOSS01-16-25053408GD', 'DOSSO', 'GOUE DANNEL ', 'Yango', 'M', '2024-09-30 15:07:05', 46, 53, '1983-02-13'),
(71, '2840LA01', 'SUZUKI', 'Alto', '2024-03-25', 'KONE01-15-25035324B', 'KONE ', 'BAKARY ', 'Taxi', 'M', '2024-09-30 15:40:15', 13, 37, '1960-01-01'),
(73, '9131WWCI01', 'SUZUKI', ' SPRESSO', '2024-01-01', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', 'Taxi', 'M', '2024-10-02 14:25:01', 14, 34, '1982-11-30'),
(74, '9131WWCI01', 'SUZUKI', ' SPRESSO', '2024-01-27', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', 'Taxi', 'M', '2024-10-02 14:25:44', 14, 33, '1975-01-01'),
(75, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', '2024-09-25', 'Sai01-15-25007386GR', 'SAI', 'GOUAN ERNEST ', 'Yango', 'M', '2024-10-16 09:30:40', 46, 57, '1978-07-20');

-- --------------------------------------------------------

--
-- Structure de la table `chauffeur_list`
--

CREATE TABLE `chauffeur_list` (
  `chID` int(10) NOT NULL,
  `PassNumber` varchar(200) DEFAULT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `prenom` varchar(200) DEFAULT NULL,
  `sexe` varchar(200) DEFAULT NULL,
  `dateN` varchar(200) DEFAULT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  `permis` varchar(100) DEFAULT NULL,
  `cni` varchar(200) DEFAULT NULL,
  `telephone1` varchar(200) DEFAULT NULL,
  `telephone2` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `fin` varchar(200) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `fichier` varchar(200) DEFAULT NULL,
  `ms` varchar(200) NOT NULL,
  `pp` varchar(200) NOT NULL,
  `ent` varchar(200) NOT NULL,
  `nm` varchar(200) NOT NULL,
  `tel` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `ft` varchar(200) NOT NULL,
  `rma` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `esp` varchar(200) NOT NULL,
  `PasscreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `chauffeur_list`
--

INSERT INTO `chauffeur_list` (`chID`, `PassNumber`, `nom`, `prenom`, `sexe`, `dateN`, `adresse`, `permis`, `cni`, `telephone1`, `telephone2`, `date`, `fin`, `photo`, `fichier`, `ms`, `pp`, `ent`, `nm`, `tel`, `email`, `ft`, `rma`, `status`, `esp`, `PasscreationDate`) VALUES
(29, '727237019', 'KONAN', 'HUBERSON', 'M', '1977-01-13', 'ABOBO', 'KONA01-15-00061326H', 'CI000678998', '0709156105', '', '2024-07-05', '', 'f19d60d2ed76b3b19f8042c851ea39941725544592.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-05 13:56:32'),
(30, '209496069', 'DJAKO', 'YAYO PAUL ARISTIDE', 'M', '2024-05-11', 'ABOBO', 'DJAK01-15-25013472YP', 'CI004748695', '0140711670', '', '2024-07-18', '', '52cfbebd87dc50e2aaa92536ea34f0e61725544914jpeg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-05 14:01:54'),
(31, '745196780', 'TRAORE', 'MAMORY', 'M', '1985-01-01', 'ABOBO', 'TRAO01-14-00023808M', 'EN COUR', '0758648477', '', '2024-07-16', '', 'a86e3c90d174567d3af89dfe8637abef1725545401.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-05 14:10:01'),
(32, '439910404', 'FOFANA', 'INZA', 'M', '1977-12-19', 'ABOBO', 'FOFA01-15-240146311L', 'CI004520981', '0504595036', '', '2024-06-05', '', '0033854ab929d0bc87dc855462d571031725546091.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-05 14:21:31'),
(33, '755356523', 'DIALLO', 'LAMINE', 'M', '1975-01-01', 'ABOBO', 'DIAL01-14-00006027L', 'EN COUR', '0787830832', '', '2024-03-25', '', 'af5037393d13067be994407e5dfd07b91725546748jpeg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-05 14:32:28'),
(34, '794408931', 'CISSE', 'DAOUDIA ', 'M', '1982-11-30', 'ABOBO ', 'CISS 01-21-44057677D', 'AI 118950312 1982', '+22501 40 06 3658', '+22501 40 06 3658', '2024-02-15', '', '352bdfa5480dd989cb4ff6d8d6df46841725553522.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-05 16:25:22'),
(35, '708135941', 'Kone ', 'Ali ', 'M', '1986-01-01', 'ABOBO ', 'KONE01-15-2504423A', 'C0106835719', '+22505 85 93 0222', '', '2024-08-18', '2024-08-25', '231a199ab2a0a10953a564e6d1ec6f1f1725554034.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-05 16:33:54'),
(36, '427493189', 'DIARASOUBA ', 'BOUBAKARINE ', 'M', '1972-08-12', 'ABOBO ', 'DIAR01-18-25138005A', 'C0029030806', '07 07 18 5926', '', '2024-05-17', '', 'c1c0fb69e527917d75a3d1e00a63a82f1725554685.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-05 16:44:45'),
(37, '392464769', 'KONE ', 'BAKARY ', 'M', '1960-01-01', 'ABOBO SAGBE ', 'KONE01-15-25035324B', 'PC- KONE 011524016910L', '07 09 20 2005', '', '2024-04-24', '', '474982b8648218376b859a1ffd98ffd91725555219.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-05 16:53:39'),
(38, '306361299', 'SAMAKE ', 'YAYA', 'M', '1974-06-08', 'ABOBO SAGBE ', 'SAMA01-16-25077864Y', 'AI342712977BAKO', '07 58 93 7771', '', '2024-07-10', '2024-08-18', 'f9196c0c258624545ad77c3a54f5aac21725555952.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-05 17:05:53'),
(39, '404342401', 'SAMAKE ', 'SYNDOU', 'M', '1971-01-01', 'ABOBO ANYAMAN ', 'SAMA 01-15-250203765', 'C0027439858', '', '', '2024-07-22', '', 'ae7789f6b1837421c5d1cc581e88e0ea1725556574.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-05 17:16:14'),
(40, '658820678', 'KONE ', 'ABOULAYE ', 'M', '1993-07-09', 'ABOBO SAGBE ', 'KONE01-15-22003167A', 'C0072580149', '', '', '2024-04-12', '2024-06-25', '8b5f71da4b158a9d2f13970b22d12dae1725560270.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-05 18:17:50'),
(41, '632784965', 'AKESSE ', 'AKESSE CLAUDE ', 'M', '1986-11-11', 'ABOBO ANYAMAN ', 'AKESSE01-2114956591A', 'C0039723084', '', '', '2024-06-18', '2024-06-22', '2882c8e073de6d67075798011b4171c11725560966.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-05 18:29:26'),
(42, '297867034', 'KONE ', 'LOSSENI ', 'M', '1974-01-01', 'ABOBO SAGBE ', 'KONE01-15-24016910L', 'KONE01-15-24016910L', '', '', '2024-04-26', '2024-06-01', '5f8342ace73886a2d145aa1591755f691725619114.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-05 19:57:26'),
(43, '944993273', 'KOUAKOU', 'ABRAHAM ', 'M', '1993-01-02', 'ABOBO ', 'KOUA01-16-25075997A', 'AI-13194T0UMODI', '', '', '2024-04-30', '', 'b07cc2e170daaf2ef62ec139d82564e81725618611.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-06 10:30:11'),
(44, '132808291', 'OSSOUKOU ', 'KEKERE YANNICK ', 'M', '1992-12-12', 'ABOBO ', 'OSSO01-22-30156657K', 'CI0109585040', '', '', '2024-06-05', '2024-06-14', '8fb90ce4cda2c3192ab96bf03fa6e7bd1725620695.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-06 11:04:55'),
(45, '374142341', 'AKA ', 'AKA JEAN-MARC', 'M', '1995-12-12', 'ABOBO ', 'AKA01-192417364ZJ', 'AI468122002', '', '', '2024-06-05', '2024-06-15', 'ce41930caaff765f169c9d064ee801d31725621438.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-06 11:17:18'),
(46, '207648946', 'KOUAME ', 'Hugues Sidoune ', 'M', '1992-01-01', 'ABOBO ', 'Non', 'Non', '', '', '2024-06-18', '', '107a24aea348ff9b4255e7d3a5ee019a1725622638.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-06 11:37:18'),
(47, '953039101', 'BAMBA', 'MAMADOU ', 'M', '1989-01-26', 'ABOBO SAGBE ', 'BAMAB01-15-24055669M', 'C0112162043', '', '', '2024-04-10', '2024-05-15', '64a5336a34e33d97ca38227cedc744921725628440.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-06 13:14:00'),
(48, '951139821', 'SYLLA', 'ABOUBACAR ', 'M', '1992-09-17', 'ABOBO SAGBE ', 'SYLL01-44007271A', '11928189325', '', '', '2024-08-15', '', '8304cbe127c5ec6babd594051e7903aa1725641695.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-06 16:54:55'),
(49, '241261085', 'YACOLI', 'WACOUBO GUY - NOËL ', 'M', '1978-12-25', 'SONGON AGBAN', 'YACO01-15-25024047WG', 'CI003504979', '', '', '2024-09-10', '', '9cda2048cd0b7bba0b964eb03eb7ea901725985929.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-10 16:32:09'),
(50, '342600959', 'FADIKA', 'YOUSSOUF', 'M', '1985-10-18', 'ABOBO', 'FADI01-20-17037795Y', 'CI002672896', '0759894017', '', '2024-07-06', '2024-08-14', '8a6197b94b2d91d9c8c8f18b81c1e7321725988191.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-10 17:09:52'),
(51, '382238786', 'GOHORE', 'BI BADOUA VICTOR', 'M', '1963-01-15', 'SONGON AGBAN ', 'GOHO01-16-25068310BV', 'CI001665347', '', '', '2024-09-13', '2024-09-14', '7ceb1a34d1a13e2e408befb358d9973f1726228148.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-13 11:49:08'),
(52, '823657308', 'MATH', 'THIE DJESSEKAN CYRILLE ', 'M', '1989-03-12', 'ABAN SONGON', 'MATH01-22-24233873T', 'AI 172114122009', '07 77 99 1656', '', '2024-09-20', '2024-09-21', 'b49ae171aa1de727ac9a874c195d3b3e1726815720.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-20 07:02:00'),
(53, '610029384', 'DOSSO', 'GOUE DANNEL ', 'M', '1983-02-13', 'YOPOUGON ANANERAIE', 'DOSS01-16-25053408GD', 'CI 0108203088', '', '', '2024-09-23', '', '3da19eb9a8066c89ea169ac9c6fe6c8c1727096186.jpg', NULL, '', '', '', '', '', '', '', '', '', '', '2024-09-23 12:56:26'),
(54, '107688086', 'ZRAN', 'MOMINE SEVERIN', 'M', '2024-09-25', 'cocody campus', 'ZR45-MOJHG-425', 'CI000056', '0777398989', '0777398989', '2024-09-23', '2024-09-26', 'e71820eba64679755cc18bad27ba2aa81727368635.jpg', NULL, 'Célibataire ', 'Fonctionnalités ', 'Soumafe', 'MOMINE SEVERIN ZRAN', '0140004509', 'severin.zran@soumafe.com', 'Stagiaire ', ' Je suis ZRAN MOMINE SEVERIN, développeurs d\'applications web ', 'Actif', '2ans', '2024-09-26 16:37:15'),
(55, '211208426', 'zran', 'momine severin', 'M', '2024-09-24', 'BONJOUR', 'ADM-AF1€&', 'CI000056', '0140004509', '', '2024-09-24', '2024-09-25', 'dd84d9870ac6af5e19cb499ba203dc2b1727368817.jpg', NULL, 'Célibataire ', 'Fonctionnalités ', 'Soumafe1', 'MOMINE SEVERIN ZRAN', '0739898989', 'zranmomineseverin@gmail.com', 'Stagiaire ', ' Je suis ZRAN MOMINE SEVERIN, développeurs d\'applications web ', 'Inactif', '2ans', '2024-09-26 16:40:17'),
(56, '888681795', 'Cocody ', 'Cocody', 'M', '2024-10-07', 'Cocody ', 'ADM-AF1€&x', 'CI000056f', '0556120552', '0556120552', '2024-10-06', '', '19943920fa078550062a9110112b27f41728297065.jpg', NULL, 'Célibataire ', 'Comment ', 'severin zran', 'MOMINE SEVERIN ZRAN', '0777398989', 'severin.zran@soumafe.com', 'Stagiaire ', 'Oui', 'Actif', '1ans', '2024-10-07 10:31:05'),
(57, '894417529', 'SAI', 'GOUAN ERNEST ', 'M', '1978-07-20', ' YOPOUGON  KILOMÈTRES ', 'Sai01-15-25007386GR', 'CI002687402', '05 04 20 6904', '', '2024-09-25', '', '6eadaf23c529f3330bdefd6568e081411729167851.png', NULL, 'MARIÉ ', 'Chauffeur Yango ', 'KDS', 'madame Sai', '0556882833', 'SAIGOUMAN@gmail.com', 'Cormasante ', '6 ligne ', 'Actif', '4 ans ', '2024-10-16 09:15:31');

-- --------------------------------------------------------

--
-- Structure de la table `cnt_list`
--

CREATE TABLE `cnt_list` (
  `cntID` int(11) NOT NULL,
  `PassNumber` varchar(200) DEFAULT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `prenom` varchar(200) DEFAULT NULL,
  `imt` varchar(200) NOT NULL,
  `renum` varchar(200) DEFAULT NULL,
  `dure` varchar(200) DEFAULT NULL,
  `date` datetime(6) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `PasscreationDate` timestamp NULL DEFAULT current_timestamp(),
  `ID` int(5) NOT NULL,
  `marque` varchar(200) NOT NULL,
  `genre` varchar(200) NOT NULL,
  `pID` int(11) NOT NULL,
  `tm` varchar(200) NOT NULL,
  `tel` varchar(200) NOT NULL,
  `cni` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cnt_list`
--

INSERT INTO `cnt_list` (`cntID`, `PassNumber`, `nom`, `prenom`, `imt`, `renum`, `dure`, `date`, `photo`, `PasscreationDate`, `ID`, `marque`, `genre`, `pID`, `tm`, `tel`, `cni`) VALUES
(34, '501067724', 'goggbe', 'jeannette', 'FGHKKLMPBk', '350 000,00', '2ans', '2024-09-25 00:00:00.000000', 'd34aa233492be172b8d29014ee8579f81727287953.png', '2024-09-25 18:12:33', 50, 'SUZUKI', 'blanche', 35, 'ZRAN momine', '07-77-39-89-89', 'CI0056235689m'),
(35, '132377850', 'goggbe', 'jeannette', 'FGHKKLMPBk', '3 350,00', '2 ans', '2024-09-25 00:00:00.000000', 'ab0abfa968893efd65263348d89f4dba1727288137.png', '2024-09-25 18:15:37', 50, 'SUZUKI', 'blanche', 35, 'ZRAN momine', '01-40-00-45-09', 'CI0056123');

-- --------------------------------------------------------

--
-- Structure de la table `concessionnaire_list`
--

CREATE TABLE `concessionnaire_list` (
  `ID` int(10) NOT NULL,
  `concessionnaire` varchar(200) DEFAULT NULL,
  `responsable` varchar(200) DEFAULT NULL,
  `telephone1` varchar(200) DEFAULT NULL,
  `telephone2` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `concessionnaire_list`
--

INSERT INTO `concessionnaire_list` (`ID`, `concessionnaire`, `responsable`, `telephone1`, `telephone2`, `email`, `adresse`, `CreationDate`) VALUES
(16, 'SOCIDA', 'Mr. leandre ABOH', '0584135072', '2721214000', 'leandre.aboch@gbh.fr', 'Marcory zone 4', '2024-09-04 12:11:28'),
(17, 'CHINOIRE', 'Mr TRAORE', '0708622838', '0747719115', 'traore.lacina416@gmail.com', 'COCODY APRE COUDRON', '2024-09-04 12:18:02'),
(18, 'SOCIDA', 'Mr KOKORA', '05845635', '2721214000', 'kokora.aboch@gbh.fr', 'Marcory zone 4', '2024-09-05 09:57:01'),
(19, ' KIA', 'MR YAO', '0758020102', '27212155', 'garagemgla@gmail.com', 'Marcory zone 4', '2024-09-05 10:05:46'),
(20, 'PERGEOT', 'MR KOUAKOU', '0584135072', '2721214022', 'kouakou.aboch@gbh.fr', 'Marcory zone 4', '2024-09-05 10:19:53');

-- --------------------------------------------------------

--
-- Structure de la table `depenses`
--

CREATE TABLE `depenses` (
  `feid` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `libelle_depenses` varchar(255) NOT NULL,
  `quantite_depenses` int(11) NOT NULL,
  `montant_depenses` decimal(10,2) NOT NULL,
  `numero_facture` varchar(255) NOT NULL,
  `montant_total` decimal(10,2) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `depenses`
--

INSERT INTO `depenses` (`feid`, `ID`, `libelle_depenses`, `quantite_depenses`, `montant_depenses`, `numero_facture`, `montant_total`, `CreationDate`, `date`) VALUES
(54, 12, 'pm', 500, '500.00', '65', '250000.00', '2024-10-10 09:43:56', ''),
(55, 12, 'pm', 500, '500.00', '25', '250000.00', '2024-10-10 09:52:56', '2024-10-10'),
(56, 12, 'severin', 5, '25000.00', '25', '125000.00', '2024-10-10 09:52:56', '2024-10-10'),
(57, 13, 'pm', 500, '500.00', '50', '250000.00', '2024-10-10 09:57:05', '2024-10-10'),
(58, 13, 'severinm', 5, '25000.00', '50', '125000.00', '2024-10-10 09:57:05', '2024-10-10'),
(59, 13, 'pm', 5, '6600.00', '50', '33000.00', '2024-10-10 09:57:05', '2024-10-10'),
(60, 13, 'pm', 500, '500.00', '50', '250000.00', '2024-10-10 10:49:30', '2024-10-10'),
(61, 13, 'pm', 500, '500.00', '50', '250000.00', '2024-10-10 10:51:29', '2024-10-09'),
(62, 31, 'lmk', 50, '65000.00', '120', '3250000.00', '2024-10-10 11:13:19', '2024-10-09'),
(64, 14, 'Cable', 8, '25000.00', ' 4566', '200000.00', '2024-10-10 11:44:03', '2024-10-09'),
(65, 17, 'Cable', 5, '20000.00', '5455', '100000.00', '2024-10-10 11:46:28', '2024-10-09');

-- --------------------------------------------------------

--
-- Structure de la table `detail_panne`
--

CREATE TABLE `detail_panne` (
  `dcid` int(11) NOT NULL,
  `decid` int(11) NOT NULL,
  `lib_dia` varchar(255) NOT NULL,
  `num_f` varchar(255) NOT NULL,
  `ID` int(11) NOT NULL,
  `status` varchar(200) NOT NULL,
  `garage` varchar(255) NOT NULL,
  `responsable` varchar(200) NOT NULL,
  `date_r` varchar(200) NOT NULL,
  `date_s` varchar(200) NOT NULL,
  `temps` varchar(200) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `detail_panne`
--

INSERT INTO `detail_panne` (`dcid`, `decid`, `lib_dia`, `num_f`, `ID`, `status`, `garage`, `responsable`, `date_r`, `date_s`, `temps`, `CreationDate`) VALUES
(73, 70, 'bien1', '52266578', 18, 'Panne non réparée', 'chinoir', 'kandang', '2024-10-16', '2024-10-15', '13:49', '2024-10-16 11:50:04'),
(74, 70, 'bien2', '52266578', 18, 'Panne non réparée', 'chinoir', 'kandang', '2024-10-16', '2024-10-15', '13:49', '2024-10-16 11:50:04'),
(75, 70, 'bien3', '52266578', 18, 'Panne non réparée', 'chinoir', 'kandang', '2024-10-16', '2024-10-15', '13:49', '2024-10-16 11:50:04'),
(76, 70, 'bien6', '521', 13, 'Panne reparer', 'chinoir', 'kan', '2024-10-16', '2024-10-15', '2 ans', '2024-10-16 11:54:58'),
(77, 70, 'bien5', '521', 13, 'Panne reparer', 'chinoir', 'kan', '2024-10-16', '2024-10-15', '2 ans', '2024-10-16 11:54:58'),
(78, 70, 'bien12', '521', 13, 'Panne reparer', 'chinoir', 'kan', '2024-10-16', '2024-10-15', '2 ans', '2024-10-16 11:54:58');

-- --------------------------------------------------------

--
-- Structure de la table `diagn`
--

CREATE TABLE `diagn` (
  `decid` int(11) NOT NULL,
  `date_d` varchar(255) NOT NULL,
  `heure_d` varchar(255) NOT NULL,
  `ID` varchar(200) NOT NULL,
  `lib_pan` varchar(200) NOT NULL,
  `obser` varchar(255) NOT NULL,
  `date_dia` varchar(200) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `diagn`
--

INSERT INTO `diagn` (`decid`, `date_d`, `heure_d`, `ID`, `lib_pan`, `obser`, `date_dia`, `CreationDate`) VALUES
(67, '2024-10-16', '11:21', '13', 'Array', 'lok ghj ', '2024-10-16', '2024-10-16 10:20:42'),
(68, '2024-10-16', '13:21', '12', 'Array', 'lok ghj ', '2024-10-16', '2024-10-16 10:21:52'),
(69, '2024-10-16', '13:23', '52', 'Array', 'ok ok', '2024-10-16', '2024-10-16 10:23:56'),
(70, '2024-10-16', '12:31', '13', 'bonjour severin', 'bon,je suis', '2024-10-16', '2024-10-16 10:31:59'),
(71, '2024-10-16', '12:31', '13', 'severin1', 'bon,je suis', '2024-10-16', '2024-10-16 10:31:59'),
(72, '2024-10-16', '18:17', '14', 'panne1', 'bon,je suis', '2024-10-10', '2024-10-16 18:19:18'),
(73, '2024-10-16', '18:17', '14', 'pannes2', 'bon,je suis', '2024-10-10', '2024-10-16 18:19:18'),
(74, '2024-10-16', '18:17', '14', 'panne 3', 'bon,je suis', '2024-10-10', '2024-10-16 18:19:18'),
(75, '2024-10-17', '01:56', '12', 'pl', 'kjjk', '2024-10-17', '2024-10-17 15:07:52');

-- --------------------------------------------------------

--
-- Structure de la table `dp_list`
--

CREATE TABLE `dp_list` (
  `ID` int(10) NOT NULL,
  `lib` varchar(200) DEFAULT NULL,
  `qt` varchar(200) DEFAULT NULL,
  `mt` varchar(200) DEFAULT NULL,
  `imt` varchar(200) DEFAULT NULL,
  `genre` varchar(200) DEFAULT NULL,
  `dte` varchar(200) DEFAULT NULL,
  `marque` varchar(200) NOT NULL,
  `model` varchar(200) NOT NULL,
  `ob` text NOT NULL,
  `total` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `dp_list`
--

INSERT INTO `dp_list` (`ID`, `lib`, `qt`, `mt`, `imt`, `genre`, `dte`, `marque`, `model`, `ob`, `total`, `CreationDate`) VALUES
(35, '10', '500', '5000.00', '15440 WW CI 01', 'Yango', NULL, 'SUZUKI', ' SPRESSO', 'depense', 'RAS', '2024-09-10 01:15:38'),
(36, 'depense', '10', '3000', '15440 WW CI 01', 'Yango', '2024-09-10', 'SUZUKI', ' SPRESSO', 'RAS', '30000.00', '2024-09-10 01:23:56'),
(37, 'depenseij', '5', '2500', '15440 WW CI 01', 'Yango', '2024-09-17', 'SUZUKI', ' SPRESSO', 'RAS', '12500.00', '2024-09-10 08:46:33'),
(38, 'moteur', '5', '10000', '2840LA01', 'Taxi', '2024-09-02', 'SUZUKI', 'Alto', '', '50000.00', '2024-09-10 16:11:55');

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

CREATE TABLE `factures` (
  `fid` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `libelle_facture` varchar(255) NOT NULL,
  `quantite_facture` int(11) NOT NULL,
  `montant_facture` decimal(10,2) NOT NULL,
  `numero_facture` varchar(255) NOT NULL,
  `montant_total` decimal(10,2) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`fid`, `ID`, `libelle_facture`, `quantite_facture`, `montant_facture`, `numero_facture`, `montant_total`, `CreationDate`) VALUES
(54, 52, 'MOTEUR', 1, '50000.00', '00568325', '50000.00', '2024-10-09 15:52:00'),
(55, 52, 'PNEUS', 4, '10000.00', '00568325', '40000.00', '2024-10-09 15:52:00'),
(56, 52, 'PORTES', 2, '8000.00', '00568325', '16000.00', '2024-10-09 15:52:00'),
(57, 52, 'OK', 2500, '3.00', '00568325', '7500.00', '2024-10-09 15:52:00'),
(58, 33, 'Recherche 1', 5, '2000.00', '00568325', '10000.00', '2024-10-10 11:18:20'),
(59, 14, 'pneus', 4, '10000.00', '1236', '40000.00', '2024-10-11 19:15:29'),
(60, 14, 'portes', 3, '12000.00', '1236', '36000.00', '2024-10-11 19:15:29');

-- --------------------------------------------------------

--
-- Structure de la table `lib_list`
--

CREATE TABLE `lib_list` (
  `ID` int(10) NOT NULL,
  `jr` varchar(200) DEFAULT NULL,
  `vp` varchar(200) DEFAULT NULL,
  `rp` varchar(200) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `lib_list`
--

INSERT INTO `lib_list` (`ID`, `jr`, `vp`, `rp`, `CreationDate`) VALUES
(40, 'okoui', '25000fr', '20000fr', '2024-09-17 15:52:55'),
(41, 'ORDINAIREs', '25000fr', '20000fr', '2024-09-17 15:53:24'),
(42, 'ordinaire', '25000', '20000', '2024-09-17 17:41:49');

-- --------------------------------------------------------

--
-- Structure de la table `model_list`
--

CREATE TABLE `model_list` (
  `ID` int(11) NOT NULL,
  `model` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `model_list`
--

INSERT INTO `model_list` (`ID`, `model`, `CreationDate`) VALUES
(7, ' SPRESSO', '2024-09-04 12:01:32'),
(8, 'Alto', '2024-09-04 12:02:45'),
(9, 'BALENO', '2024-09-04 12:03:51'),
(11, ' VITZ', '2024-09-05 09:59:39'),
(12, 'Seltos 2024 ', '2024-09-05 10:09:13'),
(14, 'X5', '2024-09-05 10:26:37'),
(15, 'DZIRE', '2024-09-19 19:02:53');

-- --------------------------------------------------------

--
-- Structure de la table `pannes`
--

CREATE TABLE `pannes` (
  `panid` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `libelle_panne` varchar(255) NOT NULL,
  `decla` varchar(200) NOT NULL,
  `obser` varchar(200) NOT NULL,
  `dateal` varchar(200) NOT NULL,
  `gar` varchar(200) NOT NULL,
  `resp` varchar(200) NOT NULL,
  `sortie` varchar(200) NOT NULL,
  `temps` varchar(200) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pannes`
--

INSERT INTO `pannes` (`panid`, `ID`, `libelle_panne`, `decla`, `obser`, `dateal`, `gar`, `resp`, `sortie`, `temps`, `CreationDate`) VALUES
(69, 33, 'Donné 1', '2024-10-16', 'Bonjour, suis ZRAN MOMINE SEVERIN ', '2024-10-23', 'CHINOIR', 'KANDAN', '2024-10-10', '1 ANS', '2024-10-10 11:18:20'),
(70, 14, 'pneus', '2024-10-09', 'bien payé', '2024-10-10', 'chinois', 'non', '2024-10-16', '2 ans', '2024-10-11 19:15:29'),
(71, 14, 'portes', '2024-10-09', 'bien payé', '2024-10-10', 'chinois', 'non', '2024-10-16', '2 ans', '2024-10-11 19:15:29');

-- --------------------------------------------------------

--
-- Structure de la table `panne_list`
--

CREATE TABLE `panne_list` (
  `ID` int(10) NOT NULL,
  `lib` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `panne_list`
--

INSERT INTO `panne_list` (`ID`, `lib`, `date`, `CreationDate`) VALUES
(43, 'Pneus', '2024-09-17', '2024-09-18 11:57:35'),
(44, 'moteur', '2024-09-17', '2024-09-18 11:58:38'),
(45, 'VIDANGE', '2024-01-04', '2024-09-18 12:02:40'),
(46, 'index', '2024-09-04', '2024-09-18 12:04:18'),
(47, 'NETTOYAGE KIT EMBRAYAGE COMPLET', '2024-02-17', '2024-09-18 12:06:38'),
(48, 'AMORTISSEUR', '2024-01-01', '2024-09-18 12:18:17'),
(49, 'VIDANGE COMPLETTE', '2024-01-01', '2024-09-18 12:20:03'),
(50, 'CARBE D\' EMBRAYAGE', '2024-01-01', '2024-09-18 12:22:33'),
(51, 'PLAQUETTE', '2024-01-01', '2024-09-18 12:23:13'),
(52, 'AMORTISSEUR ARRIERE', '2024-01-01', '2024-09-18 12:24:32'),
(53, 'AMORTISSEUR AVANT', '2024-01-01', '2024-09-18 12:26:29'),
(54, 'POIGNE AVANT', '2024-01-01', '2024-09-18 12:28:16'),
(55, 'POIGNE ARRIERE', '2024-01-01', '2024-09-18 12:29:58'),
(56, 'ROULEMENT AVANT ', '2024-01-01', '2024-09-18 12:33:01'),
(57, 'BOUGIE', '2024-01-01', '2024-09-18 12:34:39'),
(58, 'FEUX DE POSITION', '2024-02-01', '2024-09-18 12:44:42'),
(59, 'FEUXDE CROISEMENT', '2024-01-01', '2024-09-18 12:46:16'),
(60, 'FEUX DE ROUTE', '2024-01-01', '2024-09-18 12:46:56'),
(61, 'FEUX DE BROUILLARD AVANT', '2024-01-01', '2024-09-18 12:47:55'),
(62, 'FEUX DE STOP', '2024-01-01', '2024-09-18 12:49:13'),
(63, 'FEUX DE RECUL', '2024-01-01', '2024-09-18 12:50:34'),
(64, 'FEUX DE DETRESSE', '2024-01-01', '2024-09-18 12:51:33'),
(65, 'EMBOUT DE CREMAILLERE', '2024-01-01', '2024-09-18 12:56:27'),
(66, 'BIELETTE', '2024-01-01', '2024-09-18 12:57:37'),
(67, ' JOINDE VIVE-RECAIN', '2024-01-01', '2024-09-18 13:27:26'),
(68, 'TAPIE', '2024-01-01', '2024-09-18 13:29:05'),
(69, 'LIQUIDE HUILE FREIN', '2024-01-01', '2024-09-18 13:30:07'),
(70, 'BOUCHON DE ROUE', '2024-01-01', '2024-09-18 13:31:55'),
(71, 'CLASON', '2024-01-01', '2024-09-18 13:33:28'),
(72, 'REPARATION SIEGE', '2024-01-01', '2024-09-18 13:35:11'),
(73, 'CIENTURE DE SECURITE', '2024-01-01', '2024-09-18 13:36:23'),
(74, 'FRANCHISE', '2024-01-01', '2024-09-18 13:37:19'),
(75, 'RADIATEUR', '2024-12-01', '2024-09-18 13:38:08'),
(76, 'CROIX D\' ALTERNATEUR', '2024-01-01', '2024-09-18 14:21:16'),
(77, 'CREMAILLERE COMPLE', '2024-01-01', '2024-09-18 14:22:56'),
(78, 'PARALLELISME', '2024-01-01', '2024-09-18 14:24:24'),
(79, 'ANTERNALLUMAGE ', '2024-01-01', '2024-09-18 14:26:50'),
(80, 'SILINBLOC', '2024-01-01', '2024-09-18 14:27:21'),
(81, 'SOUDAGE SASIE', '2024-01-01', '2024-09-18 14:29:15'),
(82, 'SERAGE AMBOULE CREMERLLAIRE ', '2024-01-01', '2024-09-18 14:33:59'),
(83, 'POIGNET DEHORT', '2024-01-01', '2024-09-18 14:36:11'),
(84, 'BATTERIE', '2024-01-01', '2024-09-18 14:37:39'),
(85, 'CAOUTCHOU DE VISITE (p)', '2024-01-01', '2024-09-18 14:40:00'),
(86, 'CAOUTCHOU DE VISITE (G)', '2024-01-01', '2024-09-18 14:40:55'),
(87, 'DISQUE D\'EMBRAYAGE', '2024-01-01', '2024-09-18 14:42:09'),
(88, 'ACCROCHAGE DE LA BATTERI', '2024-01-01', '2024-09-18 14:44:31'),
(89, 'ROULEMENT ARRIERE', '2024-01-01', '2024-09-18 14:45:46'),
(90, 'GASOILE', '2024-01-01', '2024-09-18 14:47:49'),
(91, 'GANETURE', '2024-01-01', '2024-09-18 14:48:35'),
(92, 'CORCHE DE BATERIE', '2024-01-01', '2024-09-18 14:52:25'),
(93, '  DEMARREUR', '2024-01-01', '2024-09-18 16:28:29'),
(94, 'PLAQUET AVANT', '2024-01-01', '2024-09-18 16:31:39'),
(95, 'PLAQUET ARRIRE', '2024-01-01', '2024-09-18 16:32:13'),
(96, 'BRAS DE SUPSTION', '2024-01-01', '2024-09-18 16:34:13'),
(97, 'FILTRE A ESSENCE', '2024-01-01', '2024-09-18 16:44:15'),
(98, 'POIGNE DEVANT COTRE CLIENT', '2024-01-01', '2024-09-18 16:51:11'),
(99, 'iik', '2024-10-09', '2024-10-09 09:13:22');

-- --------------------------------------------------------

--
-- Structure de la table `patente_list`
--

CREATE TABLE `patente_list` (
  `ID` int(10) NOT NULL,
  `imt` varchar(200) DEFAULT NULL,
  `ref` varchar(200) DEFAULT NULL,
  `mt` varchar(200) DEFAULT NULL,
  `marque` varchar(200) NOT NULL,
  `dte` varchar(200) NOT NULL,
  `heure` varchar(200) NOT NULL,
  `fin` varchar(200) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `patente_list`
--

INSERT INTO `patente_list` (`ID`, `imt`, `ref`, `mt`, `marque`, `dte`, `heure`, `fin`, `photo`, `CreationDate`) VALUES
(38, '15440 WW CI 01', '1255vff', '2500', 'SUZUKI', '10:30', '2024-09-19', '2024-09-10', '089d53602ce05a6444dbf1b94317ca9a1726051898.pdf', '2024-09-11 10:51:38'),
(39, '15440 WW CI 01', '1255vffcc', '3000', 'SUZUKI', '14:30', '2024-09-14', '1220-02-21', '089d53602ce05a6444dbf1b94317ca9a1726051936.pdf', '2024-09-11 10:52:16'),
(40, '15440 WW CI 01', '1255vffccd', '3000', 'SUZUKI', '11:30', '2024-09-10', '2024-09-09', '688df2d9ecf63199d585bc2469acb4f41726057297.pdf', '2024-09-11 12:21:37');

-- --------------------------------------------------------

--
-- Structure de la table `pn_list`
--

CREATE TABLE `pn_list` (
  `ID` int(10) NOT NULL,
  `lib` varchar(200) DEFAULT NULL,
  `g` varchar(200) DEFAULT NULL,
  `rg` varchar(200) DEFAULT NULL,
  `imt` varchar(200) DEFAULT NULL,
  `genre` varchar(200) DEFAULT NULL,
  `dd` varchar(200) DEFAULT NULL,
  `hd` time NOT NULL,
  `dr` varchar(200) NOT NULL,
  `hr` varchar(200) NOT NULL,
  `hs` time NOT NULL,
  `marque` varchar(200) NOT NULL,
  `model` varchar(200) NOT NULL,
  `ob` text NOT NULL,
  `ds` varchar(200) DEFAULT NULL,
  `temps` varchar(200) DEFAULT NULL,
  `total` varchar(200) NOT NULL,
  `qt` varchar(200) NOT NULL,
  `mt` varchar(200) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pr_list`
--

CREATE TABLE `pr_list` (
  `pID` int(11) NOT NULL,
  `PassNumber` varchar(200) DEFAULT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `prenom` varchar(200) DEFAULT NULL,
  `sexe` varchar(200) DEFAULT NULL,
  `dteN` varchar(200) DEFAULT NULL,
  `cni` varchar(200) DEFAULT NULL,
  `cel` varchar(200) NOT NULL,
  `tel` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `adres` varchar(200) DEFAULT NULL,
  `ncpt` varchar(200) DEFAULT NULL,
  `ft` varchar(200) DEFAULT NULL,
  `dte` varchar(200) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `fichier` varchar(200) DEFAULT NULL,
  `PasscreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pr_list`
--

INSERT INTO `pr_list` (`pID`, `PassNumber`, `nom`, `prenom`, `sexe`, `dteN`, `cni`, `cel`, `tel`, `email`, `adres`, `ncpt`, `ft`, `dte`, `photo`, `fichier`, `PasscreationDate`) VALUES
(30, '480077132', 'AKA', 'AHOU LYDIE Eps DJAYA', 'F', '1971-10-24', 'CI002412968', '', '0707958829', 'INDISP@NIBLE', 'ABIDJAN', '011160 0116880238-7625', 'PASTEUR', '2024-06-04', 'd777b9f28e5c23032cdc0d14c2552e781725977978.jpg', NULL, '2024-09-10 14:19:38'),
(31, '275826708', 'ANDO', 'GRACE', 'F', '1999-01-01', 'CI00001010101', '', '010101010101 ', 'andograce@.com', 'DOKUI', '0203030220', 'ASSITANTE', '2023-12-06', '5979dc3a56e87beaee569befabbb9db41726771823.jpg', NULL, '2024-09-19 18:50:23'),
(32, '579557039', 'zran4', 'momine severin4', 'M', '2024-09-02', '425co', '', '552555555555', 'zranmomineseverin1@gmail.com', 'COCODY1', '542535', '', '2024-09-16', '1fdf6a5701308986aca3fa1510919b971727084418.jpg', NULL, '2024-09-23 09:40:18'),
(33, '803019336', 'zran4', 'momine severin4', 'M', '2024-09-02', '425co', '0140000000000', '552555555555', 'zranmomineseverin1@gmail.com', 'COCODY1', '542535', '', '2024-09-16', '1fdf6a5701308986aca3fa1510919b971727085621.jpg', NULL, '2024-09-23 10:00:21'),
(34, '145575491', 'momineM', 'BAKARMM', 'M', '2024-08-28', '425c', '014000', '55255', 'zranmominesKeverin@gmail.com', 'COCODYM', '5425', 'dghj4ccdM', '2024-09-23', 'd01f6c043cf4bfcf29fa90881b61a0661727087002.png', NULL, '2024-09-23 10:23:22'),
(35, '633668779', 'goggbe', 'jeannette', 'M', '2023-12-25', 'CI0056235689md', '01-40-00-45-09', '05-56-12-05-52', 'severin1.zran@soumafe.com', 'COCODY', '1005658487ZDr', 'PARTENAIREj', '2024-09-24', 'a21e63f5afee9b4c9d24b4f573120be01727286270.png', NULL, '2024-09-25 17:44:30');

-- --------------------------------------------------------

--
-- Structure de la table `sni_list`
--

CREATE TABLE `sni_list` (
  `ID` int(10) NOT NULL,
  `imt` varchar(200) DEFAULT NULL,
  `genre` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `marque` varchar(200) NOT NULL,
  `model` varchar(200) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `permis` varchar(200) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `telephoneT` varchar(200) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sni_list`
--

INSERT INTO `sni_list` (`ID`, `imt`, `genre`, `date`, `marque`, `model`, `photo`, `permis`, `nom`, `prenom`, `telephoneT`, `CreationDate`) VALUES
(38, '15440 WW CI 01', 'Yango', NULL, 'SUZUKI', ' SPRESSO', '089d53602ce05a6444dbf1b94317ca9a1725979972.pdf', 'AKA01-192417364ZJ', 'AKA ', 'AKA JEAN-MARC', '0749625067', '2024-09-10 14:52:52'),
(39, '15440 WW CI 01', 'Yango', '2024-09-09', 'SUZUKI', ' SPRESSO', 'eac0e00e5c02781e881aec086cbb24fa1725980003.pdf', 'DIAR01-18-25138005A', 'DIARASOUBA ', 'BOUBAKARINE ', '0707185826', '2024-09-10 14:53:23'),
(40, 'AA-196-BG', 'Yango', '2024-09-09', 'SUZUKI', 'BALENO', 'd653ebb7d334005fd322227bc35a07041725980292.pdf', 'DJAK01-15-25013472YP', 'DJAKO', 'YAYO PAUL ARISTIDE', '0544373093', '2024-09-10 14:58:12');

-- --------------------------------------------------------

--
-- Structure de la table `svi_list`
--

CREATE TABLE `svi_list` (
  `kID` int(10) NOT NULL,
  `imt` varchar(200) DEFAULT NULL,
  `marque` varchar(200) NOT NULL,
  `model` varchar(200) NOT NULL,
  `permis` varchar(200) DEFAULT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `prenom` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `hd` varchar(200) DEFAULT NULL,
  `ha` varchar(200) DEFAULT NULL,
  `tth` varchar(200) DEFAULT NULL,
  `dkm` varchar(200) DEFAULT NULL,
  `akm` varchar(200) DEFAULT NULL,
  `totkm` varchar(200) DEFAULT NULL,
  `ob` text NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `aID` int(10) NOT NULL,
  `ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `svi_list`
--

INSERT INTO `svi_list` (`kID`, `imt`, `marque`, `model`, `permis`, `nom`, `prenom`, `date`, `hd`, `ha`, `tth`, `dkm`, `akm`, `totkm`, `ob`, `CreationDate`, `aID`, `ID`) VALUES
(44, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-09-01', '06:30', '22:50', '16 heures et 20 minutes', '44083', '44236', '153 km', 'RAS', '2024-09-11 10:20:11', 0, 0),
(45, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-09-02', '07:30', '21:50', '14 heures et 20 minutes', '44236', '44408', '172 km', 'RAS', '2024-09-11 10:22:30', 0, 0),
(46, 'AA-196-BG', 'SUZUKI', 'BALENO', 'DJAK01-15-25013472YP', 'DJAKO', 'YAYO PAUL ARISTIDE', '2024-09-03', '05:54', '22:30', '16 heures et 36 minutes', '44408', '44710', '302 km', 'RAS', '2024-09-11 10:24:51', 0, 0),
(47, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-09-04', '06:10', '21:30', '15 heures et 20 minutes', '44710', '44890', '180 km', 'RAS', '2024-09-11 10:35:07', 0, 0),
(48, 'AA-196-BG', 'SUZUKI', 'BALENO', 'DJAK01-15-25013472YP', 'DJAKO', 'YAYO PAUL ARISTIDE', '2024-09-05', '06:15', '23:49', '17 heures et 34 minutes', '44890', '45248', '358 km', 'RAS', '2024-09-11 11:26:03', 0, 0),
(49, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-09-06', '06:17', '01:30', '-5 heures et -47 minutes', '45248', '45514', '266 km', 'RAS', '2024-09-11 11:27:25', 0, 0),
(50, 'AA-196-BG', 'SUZUKI', 'BALENO', 'DJAK01-15-25013472YP', 'DJAKO', 'YAYO PAUL ARISTIDE', '2024-09-07', '06:00', '01:00', '-5 heures et 0 minutes', '45514', '45856', '342 km', 'RAS', '2024-09-11 11:30:30', 0, 0),
(51, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-09-08', '06:00', '22:50', '16 heures et 50 minutes', '45856', '46089', '233 km', 'RAS', '2024-09-11 11:32:01', 0, 0),
(52, 'AA-196-BG', 'SUZUKI', 'BALENO', 'DJAK01-15-25013472YP', 'DJAKO', 'YAYO PAUL ARISTIDE', '2024-09-09', '06:15', '22:06', '15 heures et 51 minutes', '46089', '46590', '501 km', 'RAS', '2024-09-11 11:33:33', 0, 0),
(53, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-09-10', '10:10', '23:15', '13 heures et 5 minutes', '46590', '47592', '1002 km', 'RAS', '2024-09-11 11:35:06', 0, 0),
(54, 'AA-196-BG', 'SUZUKI', 'BALENO', 'DJAK01-15-25013472YP', 'DJAKO', 'YAYO PAUL ARISTIDE', '2024-09-11', '06:15', '22:15', '16 heures et 0 minutes', '47591', '46870', '-721 km', 'RAS', '2024-09-11 11:36:58', 0, 0),
(55, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'YACO01-15-25024047WG', 'YACOU ', 'WACOUBO GUY - NOËL ', '2024-09-11', '06:47', '23:10', '16 heures et 23 minutes', '16544', '16787', '243 km', 'RAS', '2024-09-11 11:38:46', 0, 0),
(56, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-09-01', '07:15', '00:20', '-7 heures et -55 minutes', '58626', '59034', '408 km', 'RAS', '2024-09-11 11:42:53', 0, 0),
(57, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'GOHO01-16-25068310BV', 'CISSE', 'DAOUDIA ', '2024-09-15', '07:15', '00:20', '-7 heures et -55 minutes', '58626', '59034', '408 km', 'RAS', '2024-09-11 13:25:24', 0, 0),
(58, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-09-02', '06:20', '01:15', '-6 heures et -5 minutes', '59034', '59437', '403 km', 'RAS', '2024-09-11 13:28:11', 0, 0),
(59, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-09-03', '08:00', '00:10', '-8 heures et -50 minutes', '59437', '59800', '363 km', 'RAS', '2024-09-11 13:30:47', 0, 0),
(60, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-09-04', '08:00', '00:10', '-8 heures et -50 minutes', '59800', '60116', '316 km', 'RAS', '2024-09-11 13:44:44', 0, 0),
(62, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-09-05', '08:00', '01:15', '-7 heures et -45 minutes', '60116', '60507', '391 km', 'RAS', '2024-09-11 13:57:53', 0, 0),
(63, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-09-06', '06:30', '22:59', '16 heures et 29 minutes', '60507', '60919', '412 km', 'RAS', '2024-09-11 14:00:50', 0, 0),
(64, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-09-07', '07:40', '23:50', '16 heures et 10 minutes', '60919', '61354', '435 km', 'RAS', '2024-09-11 14:07:21', 0, 0),
(65, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-09-09', '07:40', '01:10', '-7 heures et -30 minutes', '61843', '62194', '351 km', 'RAS', '2024-09-11 14:09:43', 0, 0),
(66, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-09-10', '06:45', '00:11', '-7 heures et -34 minutes', '62194', '62565', '371 km', 'RAS', '2024-09-11 14:13:07', 0, 0),
(67, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-09-11', '07:10', '01:20', '-6 heures et -50 minutes', '62566', '62934', '368 km', 'RAS', '2024-09-11 14:18:38', 0, 0),
(68, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-09-13', '07:00', '00:10', '-7 heures et -50 minutes', '63236', '63677', '441 km', 'RAS', '2024-09-13 06:51:14', 0, 0),
(69, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'YACO01-15-25024047WG', 'YACOU ', 'WACOUBO GUY - NOËL ', '2024-09-13', '06:43', '23:40', '16 heures et 57 minutes', '17081', '17330', '249 km', 'RAS', '2024-09-13 06:53:50', 0, 0),
(71, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'YACO01-15-25024047WG', 'YACOU ', 'WACOUBO GUY - NOËL ', '2024-09-12', '06:48', '23:45', '16 heures et 57 minutes', '16787', '17081', '294 km', 'RAS', '2024-09-13 11:03:51', 0, 0),
(72, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-09-12', '06:20', '01:15', '-6 heures et -5 minutes', '62934', '63236', '302 km', 'RAS', '2024-09-13 11:05:45', 0, 0),
(73, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'GOHO01-16-25068310BV', 'GOHORE', 'BI BADOUA VICTOR', '2024-09-14', '06:00', '12:15', '6 heures et 15 minutes', '17330', '17525', '195 km', 'RAS', '2024-09-14 06:26:33', 0, 0),
(74, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-09-14', '06:00', '00:05', '-6 heures et -55 minutes', '47571', '478226', '430655 km', 'RAS', '2024-09-14 06:28:39', 0, 0),
(75, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-09-14', '06:45', '00:05', '-7 heures et -40 minutes', '63677', '63997', '320 km', 'RAS', '2024-09-14 07:00:25', 0, 0),
(76, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-09-16', '07:00', '22:50', '15 heures et 50 minutes', '64383', '64696', '313 km', 'RAS', '2024-09-16 09:31:09', 0, 0),
(77, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-09-16', '06:18', '22:30', '16 heures et 12 minutes', '48190', '48426', '236 km', 'RAS', '2024-09-16 09:32:31', 0, 0),
(78, 'AA-196-BG', 'SUZUKI', 'BALENO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-09-15', '07:20', '23:20', '16 heures et 0 minutes', '63996', '64383', '387 km', 'RAS', '2024-09-16 09:46:49', 0, 0),
(79, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-09-15', '07:20', '23:20', '16 heures et 0 minutes', '63996', '64383', '387 km', 'RAS', '2024-09-16 10:30:25', 0, 0),
(80, '2840LA01', 'SUZUKI', 'Alto', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', '2024-09-14', '06:00', '22:18', '16 heures et 18 minutes', '271021', '271319', '298 km', 'RAS', '2024-09-16 11:04:32', 0, 0),
(81, '2840LA01', 'SUZUKI', 'Alto', 'KONE01-15-25035324B', 'KONE ', 'BAKARY ', '2024-09-15', '09:15', '23:50', '14 heures et 35 minutes', '271319', '271590', '271 km', 'panne au niveau de la  bas du vehcule', '2024-09-16 11:10:12', 0, 0),
(82, '2840LA01', 'SUZUKI', 'Alto', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', '2024-09-16', '06:00', '21:10', '15 heures et 10 minutes', '271590', '271827', '237 km', 'RAS', '2024-09-16 11:14:58', 0, 0),
(83, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-09-17', '07:10', '00:15', '-7 heures et -55 minutes', '64696', '65044', '348 km', 'RAS', '2024-09-17 10:42:27', 0, 0),
(84, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'YACO01-15-25024047WG', 'YACOLI', 'WACOUBO GUY - NOËL ', '2024-09-17', '08:20', '10:50', '2 heures et 30 minutes', '18082', '18126', '44 km', 'RAS', '2024-09-17 10:43:43', 0, 0),
(85, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-09-17', '08:45', '00:50', '-8 heures et -55 minutes', '48426', '48712', '286 km', 'RAS', '2024-09-17 10:44:56', 0, 0),
(86, '2840LA01', 'SUZUKI', 'Alto', 'KONE01-15-25035324B', 'KONE ', 'BAKARY ', '2024-09-17', '06:00', '22:10', '16 heures et 10 minutes', '271827', '272072', '245 km', 'RAS', '2024-09-17 10:47:35', 0, 0),
(87, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'YACO01-15-25024047WG', 'YACOLI', 'WACOUBO GUY - NOËL ', '2024-09-15', '08:10', '22:20', '14 heures et 10 minutes', '17851', '18082', '231 km', 'RAS', '2024-09-17 11:22:46', 0, 0),
(88, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'YACO01-15-25024047WG', 'YACOLI', 'WACOUBO GUY - NOËL ', '2024-09-16', '08:16', '23:20', '15 heures et 4 minutes', '17851', '18082', '231 km', 'RAS', '2024-09-17 11:25:12', 0, 0),
(89, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-09-18', '06:20', '22:02', '15 heures et 42 minutes', '65044', '65308', '264 km', 'RAS', '2024-09-18 09:03:36', 0, 0),
(90, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'YACO01-15-25024047WG', 'YACOLI', 'WACOUBO GUY - NOËL ', '2024-09-18', '06:17', '22:20', '16 heures et 3 minutes', '18126', '18384', '258 km', 'RAS', '2024-09-18 09:05:04', 0, 0),
(91, 'AA-196-BG', 'SUZUKI', 'BALENO', 'DJAK01-15-25013472YP', 'DJAKO', 'YAYO PAUL ARISTIDE', '2024-09-18', '06:00', '22:20', '16 heures et 20 minutes', '48712', '48966', '254 km', 'RAS', '2024-09-18 09:07:54', 0, 0),
(92, '2840LA01', 'SUZUKI', 'Alto', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', '2024-09-18', '06:00', '23:15', '17 heures et 15 minutes', '272072', '272340', '268 km', 'RAS', '2024-09-18 09:40:26', 0, 0),
(93, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'YACO01-15-25024047WG', 'YACOLI', 'WACOUBO GUY - NOËL ', '2024-09-19', '07:15', '23:50', '16 heures et 35 minutes', '18384', '18754', '370 km', 'RAS', '2024-09-20 16:39:57', 0, 0),
(94, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'MATH01-22-24233873T', 'MATH', 'THIE DJESSEKAN CYRILLE ', '2024-09-20', '07:16', '00:09', '-8 heures et -7 minutes', '18754', '18994', '240 km', 'RAS', '2024-09-20 16:41:35', 0, 0),
(95, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'YACO01-15-25024047WG', 'YACOLI', 'WACOUBO GUY - NOËL ', '2024-09-21', '08:10', '00:28', '-8 heures et -42 minutes', '18994', '19281', '287 km', 'RAS', '2024-09-23 09:31:16', 0, 0),
(96, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'YACO01-15-25024047WG', 'YACOLI', 'WACOUBO GUY - NOËL ', '2024-09-22', '06:20', '23:15', '16 heures et 55 minutes', '19281', '19603', '322 km', 'RAS', '2024-09-23 09:33:37', 0, 0),
(97, 'AA-196-BG', 'SUZUKI', 'BALENO', 'DJAK01-15-25013472YP', 'DJAKO', 'YAYO PAUL ARISTIDE', '2024-09-19', '06:00', '23:50', '17 heures et 50 minutes', '48966', '49218', '252 km', 'RAS', '2024-09-23 09:45:04', 0, 0),
(98, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-09-20', '06:00', '20:58', '14 heures et 58 minutes', '49218', '49450', '232 km', 'JOURNNE ACHAT  DE PNEUS', '2024-09-23 10:01:50', 0, 0),
(99, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-09-22', '08:10', '22:50', '14 heures et 40 minutes', '49627', '49877', '250 km', 'RAS', '2024-09-23 10:17:44', 0, 0),
(100, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-09-19', '07:00', '00:20', '-7 heures et -40 minutes', '65308', '65624', '316 km', 'RAS', '2024-09-23 10:30:01', 0, 0),
(101, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-09-20', '06:30', '00:37', '-6 heures et -53 minutes', '65624', '65933', '309 km', 'RAS', '2024-09-23 10:32:08', 0, 0),
(102, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-09-21', '06:45', '00:15', '-7 heures et -30 minutes', '65933', '66323', '390 km', 'RAS', '2024-09-23 10:38:25', 0, 0),
(103, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-09-22', '06:17', '21:53', '15 heures et 36 minutes', '66323', '66718', '395 km', 'RAS', '2024-09-23 10:43:16', 0, 0),
(104, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-09-23', '07:15', '', '', '', '', '', '', '2024-09-23 10:44:59', 0, 0),
(105, '2840LA01', 'SUZUKI', 'Alto', 'KONE01-15-25035324B', 'KONE ', 'BAKARY ', '2024-09-19', '06:50', '12:50', '6 heures et 0 minutes', '272340', '272429', '89 km', 'JOURNNE ENTRETIEN ', '2024-09-23 11:16:36', 0, 0),
(106, '2840LA01', 'SUZUKI', 'Alto', 'KONE01-15-25035324B', 'KONE ', 'BAKARY ', '2024-09-20', '06:00', '13:20', '7 heures et 20 minutes', '272429', '272517', '88 km', 'JOUR DE LA VISITE ', '2024-09-23 11:19:21', 0, 0),
(107, '2840LA01', 'SUZUKI', 'Alto', 'KONE01-15-25035324B', 'KONE ', 'BAKARY ', '2024-09-21', '06:00', '20:50', '14 heures et 50 minutes', '272517', '272716', '199 km', 'RAS', '2024-09-23 11:21:10', 0, 0),
(108, '2840LA01', 'SUZUKI', 'Alto', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', '2024-09-22', '06:00', '22:15', '16 heures et 15 minutes', '272716', '273039', '323 km', 'RAS', '2024-09-23 11:22:49', 0, 0),
(109, '2840LA01', 'SUZUKI', 'Alto', 'KONE01-15-25035324B', 'KONE ', 'BAKARY ', '2024-09-23', '06:00', '22:19', '16 heures et 19 minutes', '273039', '273360', '321 km', 'RAS', '2024-09-23 11:23:53', 0, 0),
(110, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'DOSS01-16-25053408GD', 'DOSSO', 'GOUE DANNEL ', '2024-09-23', '06:30', '00:10', '-7 heures et -20 minutes', '19603', '19943', '340 km', 'RAS', '2024-09-23 15:42:07', 0, 0),
(111, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-09-23', '07:15', '07:10', '-1 heures et -5 minutes', '66718', '67070', '352 km', 'RAS', '2024-09-24 09:11:08', 0, 0),
(112, 'AA-196-BG', 'SUZUKI', 'BALENO', 'DJAK01-15-25013472YP', 'DJAKO', 'YAYO PAUL ARISTIDE', '2024-09-23', '06:00', '23:10', '17 heures et 10 minutes', '49877', '50153', '276 km', 'RAS', '2024-09-24 09:16:18', 0, 0),
(113, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-09-24', '06:00', '', '', '50153', '', '', '', '2024-09-24 09:18:15', 0, 0),
(114, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-09-24', '07:10', '00:13', '-7 heures et -57 minutes', '67070', '67430', '360 km', 'declartion boigie a echanger', '2024-09-24 09:29:40', 0, 0),
(115, '2840LA01', 'SUZUKI', 'Alto', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', '2024-09-24', '06:00', '00:13', '-6 heures et -47 minutes', '273360', '273692', '332 km', 'RAS', '2024-09-24 09:31:23', 0, 0),
(116, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'YACO01-15-25024047WG', 'YACOLI', 'WACOUBO GUY - NOËL ', '2024-09-24', '07:00', '01:13', '-6 heures et -47 minutes', '20000', '20405', '405 km', 'RAS', '2024-09-24 10:07:49', 0, 0),
(117, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'YACO01-15-25024047WG', 'YACOLI', 'WACOUBO GUY - NOËL ', '2024-09-25', '06:00', '00:20', '-6 heures et -40 minutes', '20405', '20659', '254 km', 'RAS', '2024-09-25 09:10:37', 0, 0),
(118, '2840LA01', 'SUZUKI', 'Alto', 'KONE01-15-25035324B', 'KONE ', 'BAKARY ', '2024-09-25', '06:00', '22:50', '16 heures et 50 minutes', '273692', '273962', '270 km', 'RAS', '2024-09-25 09:31:53', 0, 0),
(119, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-09-25', '08:00', '23:50', '15 heures et 50 minutes', '67430', '67817', '387 km', 'RAS', '2024-09-25 09:32:36', 0, 0),
(120, 'AA-196-BG', 'SUZUKI', 'BALENO', 'DJAK01-15-25013472YP', 'DJAKO', 'YAYO PAUL ARISTIDE', '2024-09-25', '06:15', '00:45', '-6 heures et -30 minutes', '50509', '50700', '191 km', 'RAS', '2024-09-25 09:45:52', 0, 0),
(121, '2840LA01', 'SUZUKI', 'Alto', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', '2024-09-26', '06:00', '23:10', '17 heures et 10 minutes', '273962', '274219', '257 km', 'RAS', '2024-09-26 09:53:30', 0, 0),
(122, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-09-26', '07:30', '00:28', '-8 heures et -2 minutes', '67817', '68201', '384 km', 'RAS', '2024-09-26 09:54:14', 0, 0),
(123, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'DOSS01-16-25053408GD', 'DOSSO', 'GOUE DANNEL ', '2024-09-26', '08:00', '00:40', '-8 heures et -20 minutes', '20659', '20974', '315 km', 'RAS', '2024-09-26 09:55:29', 0, 0),
(124, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-09-26', '05:45', '00:09', '-6 heures et -36 minutes', '50700', '50966', '266 km', 'RAS', '2024-09-26 09:56:47', 0, 0),
(125, '2840LA01', 'SUZUKI', 'Alto', 'KONE01-15-25035324B', 'KONE ', 'BAKARY ', '2024-09-27', '06:00', '00:10', '-6 heures et -50 minutes', '274219', '274569', '350 km', 'RAS', '2024-09-27 09:10:21', 0, 0),
(126, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-09-27', '07:15', '23:55', '16 heures et 40 minutes', '68201', '68601', '400 km', 'RAS', '2024-09-27 09:11:22', 0, 0),
(127, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'DOSS01-16-25053408GD', 'DOSSO', 'GOUE DANNEL ', '2024-09-27', '07:15', '00:40', '-7 heures et -35 minutes', '20974', '21539', '565 km', 'RAS', '2024-09-27 09:12:30', 0, 0),
(128, 'AA-196-BG', 'SUZUKI', 'BALENO', 'DJAK01-15-25013472YP', 'DJAKO', 'YAYO PAUL ARISTIDE', '2024-09-27', '06:15', '00:13', '-7 heures et -2 minutes', '50966', '51316', '350 km', 'RAS', '2024-09-27 09:14:22', 0, 0),
(129, '2840LA01', 'SUZUKI', 'Alto', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', '2024-09-28', '06:00', '23:50', '17 heures et 50 minutes', '274569', '274797', '228 km', 'RAS', '2024-09-30 10:59:41', 0, 0),
(130, '2840LA01', 'SUZUKI', 'Alto', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', '2024-09-29', '06:00', '21:10', '15 heures et 10 minutes', '274797', '275125', '328 km', 'RAS', '2024-09-30 11:12:20', 0, 0),
(131, '2840LA01', 'SUZUKI', 'Alto', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', '2024-09-30', '06:00', '16:20', '10 heures et 20 minutes', '275125', '275453', '328 km', 'panne au niveau de la boitre', '2024-09-30 11:13:36', 0, 0),
(132, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-09-28', '06:45', '00:11', '-7 heures et -34 minutes', '68601', '69025', '424 km', 'RAS', '2024-09-30 11:23:47', 0, 0),
(133, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-09-29', '07:55', '23:58', '16 heures et 3 minutes', '69025', '69493', '468 km', 'RAS', '2024-09-30 11:26:08', 0, 0),
(134, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-09-30', '07:30', '00:04', '-8 heures et -26 minutes', '69493', '70148', '655 km', 'RAS', '2024-09-30 11:27:50', 0, 0),
(135, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'YACO01-15-25024047WG', 'YACOLI', 'WACOUBO GUY - NOËL ', '2024-09-28', '06:00', '00:29', '-6 heures et -31 minutes', '21539', '21839', '300 km', 'RAS', '2024-09-30 11:33:08', 0, 0),
(136, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'DOSS01-16-25053408GD', '', '', '2024-09-29', '06:00', '00:35', '-6 heures et -25 minutes', '21839', '22367', '528 km', 'RAS', '2024-09-30 11:35:05', 0, 0),
(137, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'YACO01-15-25024047WG', '', '', '2024-09-30', '06:00', '', '', '22367', '', '', '', '2024-09-30 11:36:50', 0, 0),
(138, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', '', '', '2024-09-28', '06:00', '23:04', '17 heures et 4 minutes', '51346', '51556', '210 km', 'RAS', '2024-09-30 11:39:58', 0, 0),
(139, 'AA-196-BG', 'SUZUKI', 'BALENO', 'DJAK01-15-25013472YP', '', '', '2024-09-29', '07:15', '00:07', '-8 heures et -8 minutes', '51556', '51903', '347 km', 'RAS', '2024-09-30 11:41:42', 0, 0),
(140, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', '', '', '2024-09-30', '06:00', '', '', '51903', '', '', '', '2024-09-30 11:44:52', 0, 0),
(141, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-09-26', '06:00', '22:50', '16 heures et 50 minutes', '52135', '52322', '187 km', 'RAS', '2024-10-02 10:21:38', 67, 15),
(142, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-10-02', '06:00', '', '', '52322', '', '', '', '2024-10-02 10:23:25', 67, 15),
(143, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'YACO01-15-25024047WG', 'YACOLI', 'WACOUBO GUY - NOËL ', '2024-10-01', '13:00', '23:59', '10 heures et 59 minutes', '22757', '22967', '210 km', 'reglage radiacteur ', '2024-10-02 10:25:55', 69, 46),
(144, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'DOSS01-16-25053408GD', 'DOSSO', 'GOUE DANNEL ', '2024-10-02', '06:00', '', '', '22967', '', '', '', '2024-10-02 10:27:07', 70, 46),
(145, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAR01-18-25138005A', 'DIARASOUBA ', 'BOUBAKARINE ', '2024-09-26', '09:10', '00:50', '-9 heures et -20 minutes', '69834', '70148', '314 km', 'RAS', '2024-10-02 10:30:20', 66, 14),
(149, '2840LA01', 'SUZUKI', 'Alto', 'KONE01-15-25035324B', 'KONE ', 'BAKARY ', '2024-10-01', '13:50', '20:50', '7 heures et 0 minutes', '275453', '275617', '164 km', 'reparation de la boitre', '2024-10-15 15:07:07', 71, 13),
(150, '2840LA01', 'SUZUKI', 'Alto', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', '2024-10-02', '06:00', '22:50', '16 heures et 50 minutes', '275617', '275878', '261 km', 'RAS', '2024-10-15 15:13:00', 64, 13),
(151, '2840LA01', 'SUZUKI', 'Alto', 'KONE01-15-25035324B', 'KONE ', 'BAKARY ', '2024-10-03', '06:00', '21:50', '15 heures et 50 minutes', '275878', '276160', '282 km', 'RAS', '2024-10-15 15:15:05', 71, 13),
(152, '2840LA01', 'SUZUKI', 'Alto', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', '2024-10-04', '06:00', '12:00', '6 heures et 0 minutes', '276160', '276199', '39 km', 'journne de reunion( malaise)', '2024-10-15 15:19:56', 64, 13),
(153, '2840LA01', 'SUZUKI', 'Alto', 'KONE01-15-25035324B', 'KONE ', 'BAKARY ', '2024-10-05', '06:00', '21:02', '15 heures et 2 minutes', '276199', '276451', '252 km', 'RAS', '2024-10-15 15:22:30', 71, 13),
(154, '2840LA01', 'SUZUKI', 'Alto', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', '2024-10-06', '06:00', '22:50', '16 heures et 50 minutes', '276451', '276701', '250 km', 'RAS', '2024-10-15 15:26:05', 64, 13),
(155, '2840LA01', 'SUZUKI', 'Alto', 'KONE01-15-25035324B', 'KONE ', 'BAKARY ', '2024-10-07', '06:00', '22:10', '16 heures et 10 minutes', '276701', '276851', '150 km', 'RAS', '2024-10-15 15:28:03', 71, 13),
(156, '2840LA01', 'SUZUKI', 'Alto', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', '2024-10-08', '06:00', '22:10', '16 heures et 10 minutes', '276851', '277113', '262 km', 'RAS', '2024-10-15 15:29:21', 64, 13),
(157, '2840LA01', 'SUZUKI', 'Alto', 'KONE01-15-25035324B', 'KONE ', 'BAKARY ', '2024-10-09', '09:00', '22:20', '13 heures et 20 minutes', '277113', '277341', '228 km', 'RAS', '2024-10-15 15:31:58', 71, 13),
(158, '2840LA01', 'SUZUKI', 'Alto', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', '2024-10-08', '06:00', '21:15', '15 heures et 15 minutes', '277341', '277578', '237 km', 'RAS', '2024-10-15 15:33:57', 64, 13),
(159, '2840LA01', 'SUZUKI', 'Alto', 'KONE01-15-25035324B', 'KONE ', 'BAKARY ', '2024-10-11', '06:00', '20:35', '14 heures et 35 minutes', '277578', '277907', '329 km', 'RAS', '2024-10-15 15:36:07', 71, 13),
(160, '2840LA01', 'SUZUKI', 'Alto', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', '2024-10-12', '06:00', '22:50', '16 heures et 50 minutes', '277907', '278205', '298 km', 'RAS', '2024-10-15 15:51:07', 64, 13),
(161, '2840LA01', 'SUZUKI', 'Alto', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', '2024-10-13', '06:00', '22:18', '16 heures et 18 minutes', '278205', '278540', '335 km', 'RAS', '2024-10-15 15:54:01', 64, 13),
(162, '2840LA01', 'SUZUKI', 'Alto', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', '2024-10-14', '06:00', '23:50', '17 heures et 50 minutes', '278540', '278803', '263 km', 'RAS', '2024-10-15 15:55:49', 64, 13),
(163, '2840LA01', 'SUZUKI', 'Alto', 'KONE01-15-25035324B', 'KONE ', 'BAKARY ', '2024-10-15', '06:00', '01:00', '-5 heures et 0 minutes', '278803', '279120', '317 km', 'RAS', '2024-10-15 15:56:54', 71, 13),
(164, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-10-01', '09:10', '00:50', '-9 heures et -20 minutes', '69834', '70148', '314 km', 'RAS', '2024-10-16 07:55:32', 74, 14),
(165, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-10-02', '08:10', '23:53', '15 heures et 43 minutes', '70148', '70480', '332 km', ' jour vidange ', '2024-10-16 07:57:31', 73, 14),
(166, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-10-03', '06:50', '00:02', '-7 heures et -48 minutes', '70480', '70809', '329 km', 'RAS', '2024-10-16 07:59:30', 74, 14),
(167, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-10-08', '11:00', '17:15', '6 heures et 15 minutes', '70809', '71101', '292 km', 'reunion et achate de bouchiez', '2024-10-16 08:03:12', 73, 14),
(168, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-10-05', '07:50', '23:30', '15 heures et 40 minutes', '71101', '71500', '399 km', 'RAS', '2024-10-16 08:04:24', 74, 14),
(169, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-10-06', '06:20', '22:34', '16 heures et 14 minutes', '71500', '71915', '415 km', 'RAS', '2024-10-16 08:06:07', 73, 14),
(170, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-10-07', '06:50', '00:17', '-7 heures et -33 minutes', '71915', '72310', '395 km', 'RAS', '2024-10-16 08:10:49', 74, 14),
(171, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-10-08', '06:00', '23:38', '17 heures et 38 minutes', '72310', '72670', '360 km', 'RAS', '2024-10-16 08:12:12', 73, 14),
(172, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-10-09', '06:00', '01:10', '-5 heures et -50 minutes', '72670', '73081', '411 km', 'RAS', '2024-10-16 08:15:33', 74, 14),
(173, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-10-10', '07:30', '22:50', '15 heures et 20 minutes', '73081', '73415', '334 km', 'RAS', '2024-10-16 08:16:40', 73, 14),
(174, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-10-11', '06:50', '01:15', '-6 heures et -35 minutes', '73415', '73840', '425 km', 'RAS', '2024-10-16 08:17:49', 74, 14),
(175, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-10-12', '08:15', '22:15', '14 heures et 0 minutes', '73840', '74172', '332 km', 'RAS', '2024-10-16 08:19:08', 73, 14),
(176, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-10-13', '09:00', '23:50', '14 heures et 50 minutes', '74172', '74592', '420 km', 'RAS', '2024-10-16 08:20:37', 74, 14),
(177, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-10-14', '05:30', '23:20', '17 heures et 50 minutes', '74592', '74947', '355 km', 'RAS', '2024-10-16 08:22:39', 73, 14),
(178, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-10-15', '07:00', '00:20', '-7 heures et -40 minutes', '74947', '75393', '446 km', 'RAS', '2024-10-16 08:24:07', 74, 14),
(179, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'CISS 01-21-44057677D', 'CISSE', 'DAOUDIA ', '2024-10-16', '05:30', '', '', '75393', '', '', '', '2024-10-16 08:24:59', 73, 14),
(180, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'DOSS01-16-25053408GD', 'DOSSO', 'GOUE DANNEL ', '2024-10-01', '13:00', '23:59', '10 heures et 59 minutes', '22757', '22967', '210 km', 'panne au niveau rediateur', '2024-10-16 09:33:31', 70, 46),
(181, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'DOSS01-16-25053408GD', 'DOSSO', 'GOUE DANNEL ', '2024-10-02', '06:00', '00:33', '-6 heures et -27 minutes', '22967', '23432', '465 km', 'RAS', '2024-10-16 09:38:54', 70, 46),
(182, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'DOSS01-16-25053408GD', 'DOSSO', 'GOUE DANNEL ', '2024-10-03', '06:00', '00:46', '-6 heures et -14 minutes', '23432', '23682', '250 km', 'RAS', '2024-10-16 09:40:21', 70, 46),
(183, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'Sai01-15-25007386GR', 'SAI', 'GOUAN ERNEST ', '2024-10-04', '11:20', '00:02', '-12 heures et -18 minutes', '23682', '23982', '300 km', 'journne de reunion', '2024-10-16 09:43:07', 75, 46),
(184, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'DOSS01-16-25053408GD', 'DOSSO', 'GOUE DANNEL ', '2024-10-05', '07:00', '23:50', '16 heures et 50 minutes', '23982', '24402', '420 km', 'RAS', '2024-10-16 09:45:16', 70, 46),
(185, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'DOSS01-16-25053408GD', 'DOSSO', 'GOUE DANNEL ', '2024-10-06', '07:30', '00:20', '-8 heures et -10 minutes', '24402', '24800', '398 km', 'RAS', '2024-10-16 09:47:11', 70, 46),
(186, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'Sai01-15-25007386GR', 'SAI', 'GOUAN ERNEST ', '2024-10-08', '06:40', '00:11', '-7 heures et -29 minutes', '24800', '25156', '356 km', 'reinstallation phare arriere et alle chez le chauffeur mr sai', '2024-10-16 09:54:37', 75, 46),
(187, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'DOSS01-16-25053408GD', 'DOSSO', 'GOUE DANNEL ', '2024-10-08', '07:00', '23:26', '16 heures et 26 minutes', '25156', '25447', '291 km', 'RAS', '2024-10-16 09:57:55', 70, 46),
(188, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'DOSS01-16-25053408GD', 'DOSSO', 'GOUE DANNEL ', '2024-10-09', '06:00', '00:26', '-6 heures et -34 minutes', '25447', '25810', '363 km', 'RAS', '2024-10-16 10:01:44', 70, 46),
(189, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'Sai01-15-25007386GR', 'SAI', 'GOUAN ERNEST ', '2024-10-10', '07:00', '00:42', '-7 heures et -18 minutes', '25810', '26128', '318 km', 'RAS', '2024-10-16 10:04:35', 75, 46),
(190, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'DOSS01-16-25053408GD', 'DOSSO', 'GOUE DANNEL ', '2024-10-11', '07:30', '22:55', '15 heures et 25 minutes', '26128', '26378', '250 km', 'RAS', '2024-10-16 10:10:17', 70, 46),
(191, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'Sai01-15-25007386GR', 'SAI', 'GOUAN ERNEST ', '2024-10-12', '06:00', '23:48', '17 heures et 48 minutes', '26378', '26742', '364 km', 'RAS', '2024-10-16 10:11:50', 75, 46),
(192, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'Sai01-15-25007386GR', 'SAI', 'GOUAN ERNEST ', '2024-10-13', '07:00', '00:26', '-7 heures et -34 minutes', '26742', '27072', '330 km', 'RAS', '2024-10-16 10:14:46', 75, 46),
(193, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'DOSS01-16-25053408GD', 'DOSSO', 'GOUE DANNEL ', '2024-10-14', '13:00', '22:50', '9 heures et 50 minutes', '27072', '27211', '139 km', 'entreten au garage', '2024-10-16 10:18:41', 70, 46),
(194, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'DOSS01-16-25053408GD', 'DOSSO', 'GOUE DANNEL ', '2024-10-15', '06:00', '22:50', '16 heures et 50 minutes', '27211', '27565', '354 km', 'RAS', '2024-10-16 10:20:12', 70, 46),
(195, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'Sai01-15-25007386GR', 'SAI', 'GOUAN ERNEST ', '2024-10-16', '06:00', '00:20', '-6 heures et -40 minutes', '27565', '27897', '332 km', 'RAS', '2024-10-16 10:21:32', 75, 46),
(196, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-10-01', '06:00', '22:50', '16 heures et 50 minutes', '52135', '52322', '187 km', 'RAS', '2024-10-16 10:29:10', 67, 15),
(197, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-10-02', '06:00', '01:45', '-5 heures et -15 minutes', '52322', '52544', '222 km', 'RAS', '2024-10-16 10:31:28', 67, 15),
(198, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-10-03', '06:10', '01:10', '-5 heures et 0 minutes', '52544', '52647', '103 km', 'RAS', '2024-10-16 10:33:52', 67, 15),
(199, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-10-04', '11:00', '12:20', '1 heures et 20 minutes', '52647', '52742', '95 km', 'reunion manque de telephone', '2024-10-16 10:36:21', 67, 15),
(200, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-10-10', '06:00', '00:20', '-6 heures et -40 minutes', '53524', '53721', '197 km', 'RAS', '2024-10-16 10:41:03', 67, 15),
(201, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-10-11', '06:00', '00:52', '-6 heures et -8 minutes', '53721', '54016', '295 km', 'RAS', '2024-10-16 10:42:11', 67, 15),
(202, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-10-12', '06:00', '22:56', '16 heures et 56 minutes', '54016', '54266', '250 km', 'RAS', '2024-10-16 10:44:01', 67, 15),
(203, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-10-13', '07:15', '00:14', '-8 heures et -1 minutes', '54266', '54554', '288 km', 'RAS', '2024-10-16 10:46:17', 67, 15),
(204, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-10-14', '06:15', '00:19', '-6 heures et -56 minutes', '54806', '55025', '219 km', 'RAS', '2024-10-16 10:50:33', 67, 15),
(205, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-10-15', '06:00', '00:16', '-6 heures et -44 minutes', '54806', '55025', '219 km', 'RAS', '2024-10-16 11:00:49', 67, 15),
(206, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-10-16', '06:00', '00:27', '-6 heures et -33 minutes', '55025', '55272', '247 km', 'RAS', '2024-10-16 11:03:43', 67, 15),
(207, 'AA-196-BG', 'SUZUKI', 'BALENO', 'KONA01-15-00061326H', 'KONAN', 'HUBERSON', '2024-10-17', '07:30', '', '', '55272', '', '', '', '2024-10-17 15:16:50', 67, 15),
(208, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'DOSS01-16-25053408GD', 'DOSSO', 'GOUE DANNEL ', '2024-10-17', '05:45', '', '', '27897', '', '', '', '2024-10-17 15:18:57', 70, 46),
(209, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'DIAL01-14-00006027L', 'DIALLO', 'LAMINE', '2024-10-17', '07:30', '', '', '75738', '', '', '', '2024-10-17 15:20:12', 74, 14),
(210, '2840LA01', 'SUZUKI', 'Alto', 'FOFA01-15-240146311L', 'FOFANA', 'INZA', '2024-10-16', '06:00', '22:31', '16 heures et 31 minutes', '279120', '279385', '265 km', 'achate de pneu', '2024-10-17 15:30:47', 64, 13),
(211, '2840LA01', 'SUZUKI', 'Alto', 'KONE01-15-25035324B', 'KONE ', 'BAKARY ', '2024-10-17', '06:00', '', '', '279385', '', '', 'RAS', '2024-10-17 15:32:37', 71, 13);

-- --------------------------------------------------------

--
-- Structure de la table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(2, 'smafe', 'severin', 556120552, 'severinzran56@gmail.com', 'a8c80b1e80e2b311f6c4ff48f9b77525', '2024-09-13 12:08:05'),
(3, 'smafe4', 'admin1', 1010101010, 'severinzran18@gmail.com', '7ed78bd1beabe28327f01dde133fdca4', '2024-09-13 13:48:16'),
(4, 'soumafe1', 'soumafe1', 140004509, 'zranmomineseverin1@gmail.com', 'e00cf25ad42683b3df678c61f42c6bda', '2024-09-13 15:46:33'),
(6, 'KANDAN', 'KANDAN', 768565164, 'kandanalfred@gmail.com', '7554639e62065c0c3eaf4212213d4d0c', '2024-09-13 16:27:00'),
(7, 'admin', 'admin', 777398989, 'zranmomineseverin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2024-09-15 22:09:52'),
(8, 'olive', 'grace ', 798735473, 'lyviagraceando@gmail.com', 'a220daac386d13c817ab41cd9acf289f', '2024-09-16 13:47:00');

-- --------------------------------------------------------

--
-- Structure de la table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `ID` int(10) NOT NULL,
  `marque` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tblcategory`
--

INSERT INTO `tblcategory` (`ID`, `marque`, `CreationDate`) VALUES
(19, 'SUZUKI', '2024-09-04 11:59:57'),
(20, 'Ferrari', '2024-09-05 09:49:45'),
(21, 'Toyota vitz', '2024-09-05 09:58:46'),
(22, 'KIA', '2024-09-05 10:06:36'),
(23, 'PERGEOT', '2024-09-05 10:17:34'),
(24, 'B M W', '2024-09-05 10:24:12'),
(25, 'MAKO', '2024-09-19 18:56:05');

-- --------------------------------------------------------

--
-- Structure de la table `tblcontact`
--

CREATE TABLE `tblcontact` (
  `ID` int(10) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Message` mediumtext DEFAULT NULL,
  `EnquiryDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `IsRead` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tblcontact`
--

INSERT INTO `tblcontact` (`ID`, `Name`, `Email`, `Message`, `EnquiryDate`, `IsRead`) VALUES
(1, 'Kiran', 'kran@gmail.com', 'cost of volvo place pritampura to dwarka', '2021-07-05 07:26:24', 1),
(2, 'Anuj', 'AKKK@GMAIL.COM', 'This is for testing.', '2021-07-11 08:55:16', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` varchar(200) DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`) VALUES
(1, 'aboutus', 'About us', '<font color=\"#747474\" face=\"Roboto, sans-serif, arial\"><span style=\"font-size: 13px;\"><b>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</b></span></font><br>', NULL, NULL, '2021-07-11 08:54:33'),
(2, 'contactus', 'soumafe', 'ok<br>', 'direction.soumafe.com', 4654789799, '2024-08-10 22:59:29');

-- --------------------------------------------------------

--
-- Structure de la table `tblpass`
--

CREATE TABLE `tblpass` (
  `ID` int(10) NOT NULL,
  `PassNumber` varchar(200) DEFAULT NULL,
  `FullName` varchar(200) DEFAULT NULL,
  `ProfileImage` varchar(200) DEFAULT NULL,
  `ContactNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `IdentityType` varchar(200) DEFAULT NULL,
  `IdentityCardno` varchar(200) DEFAULT NULL,
  `Category` varchar(100) DEFAULT NULL,
  `Source` varchar(200) DEFAULT NULL,
  `Destination` varchar(200) DEFAULT NULL,
  `FromDate` varchar(200) DEFAULT NULL,
  `ToDate` varchar(200) DEFAULT NULL,
  `Cost` decimal(10,0) DEFAULT NULL,
  `PasscreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tblpass`
--

INSERT INTO `tblpass` (`ID`, `PassNumber`, `FullName`, `ProfileImage`, `ContactNumber`, `Email`, `IdentityType`, `IdentityCardno`, `Category`, `Source`, `Destination`, `FromDate`, `ToDate`, `Cost`, `PasscreationDate`) VALUES
(1, '286529906', 'Yogesh Kumar', '779b7513263ef185b6d094af290ef5401625471444.png', 4654464646, 'yogi@gmail.com', 'Adhar Card', 'AD-122346', 'Delux Bus', 'dfg', 'kgf', '2020-04-14', '2020-05-14', '900', '2020-04-14 11:47:03'),
(2, '915773340', 'Suresh Khanna', '779b7513263ef185b6d094af290ef5401625471444.png', 9879878978, 'suresh@gmail.com', 'Any Other Govt Issued Doc', 'KTI-896567', 'Delux Bus', NULL, NULL, '2020-04-14', '2020-07-31', '900', '2020-04-13 11:50:15'),
(3, '884595667', 'Anuj kumar', '779b7513263ef185b6d094af290ef5401625471444.png', 1234567890, 'phpgurukulofficial@Gmail.com', 'Voter Card', '5235252', 'Delux Bus', 'Pritampura', 'Dwarka', '2020-04-16', '2020-04-19', '600', '2020-04-16 02:38:27'),
(4, '210712236', 'Abir Singh', 'e76de47f621d84adbab3266e3239baee1625460898.png', 4654646546, 'abir@gmail.com', 'Voter Card', '5646465', 'Non AC Bus', 'abc', 'dbc', '2021-07-05', '2021-07-16', '900', '2021-07-04 15:01:38'),
(5, '474965545', 'Augustya', '779b7513263ef185b6d094af290ef5401625471444.png', 6546465464, 'aug@gmail.com', 'Student Card', '789456', 'Delux Bus', 'Delhi', 'Meerut', '2021-07-05', '2021-07-31', '1800', '2021-07-05 07:50:44'),
(6, '681924385', 'Anuj kumar', 'ea3dc39ca0b2f6b5f17abddec1f0e9a41625993624.png', 1234569870, 'ak@test.com', 'Driving License', 'GGGGGGHGH2423423432', 'Delux Bus', 'Laxmi Nagar', 'Central Secretariat', '2021-07-15', '2021-07-30', '500', '2021-07-11 08:53:44');

-- --------------------------------------------------------

--
-- Structure de la table `tbluseractions`
--

CREATE TABLE `tbluseractions` (
  `action_id` int(11) NOT NULL,
  `ID` int(10) NOT NULL,
  `action` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `action_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbluseractions`
--

INSERT INTO `tbluseractions` (`action_id`, `ID`, `action`, `description`, `action_date`, `ip_address`) VALUES
(3, 3, 'Ajout de dépenses', 'Dépenses enregistrées avec numéro de facture 120', '2024-10-10 11:13:19', '38.199.168.125'),
(4, 3, 'Ajout de dépenses', 'Dépenses enregistrées avec numéro de facture 5455', '2024-10-10 11:42:26', '38.199.168.125'),
(5, 3, 'Ajout de dépenses', 'Dépenses enregistrées avec numéro de facture  4566', '2024-10-10 11:44:03', '160.154.230.240'),
(6, 7, 'Ajout de dépenses', 'Dépenses enregistrées avec numéro de facture 5455', '2024-10-10 11:46:28', '160.154.230.240');

-- --------------------------------------------------------

--
-- Structure de la table `total_dp`
--

CREATE TABLE `total_dp` (
  `deid` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `somme_total` decimal(10,2) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `total_dp`
--

INSERT INTO `total_dp` (`deid`, `ID`, `somme_total`, `CreationDate`) VALUES
(51, 12, '250000.00', '2024-10-10 09:43:56'),
(52, 12, '375000.00', '2024-10-10 09:52:56'),
(53, 13, '408000.00', '2024-10-10 09:57:05'),
(54, 13, '250000.00', '2024-10-10 10:49:30'),
(55, 13, '250000.00', '2024-10-10 10:51:29'),
(56, 31, '3250000.00', '2024-10-10 11:13:19'),
(58, 14, '200000.00', '2024-10-10 11:44:03'),
(59, 17, '100000.00', '2024-10-10 11:46:28');

-- --------------------------------------------------------

--
-- Structure de la table `total_factures`
--

CREATE TABLE `total_factures` (
  `tid` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `somme_total` decimal(10,2) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `total_factures`
--

INSERT INTO `total_factures` (`tid`, `ID`, `somme_total`, `CreationDate`) VALUES
(52, 33, '10000.00', '2024-10-10 11:18:20'),
(53, 14, '76000.00', '2024-10-11 19:15:29');

-- --------------------------------------------------------

--
-- Structure de la table `vh_list`
--

CREATE TABLE `vh_list` (
  `ID` int(10) NOT NULL,
  `imt` varchar(200) DEFAULT NULL,
  `marque` varchar(200) DEFAULT NULL,
  `model` varchar(200) DEFAULT NULL,
  `cleur` varchar(200) DEFAULT NULL,
  `genre` varchar(200) DEFAULT NULL,
  `carbt` varchar(200) DEFAULT NULL,
  `dte` varchar(200) DEFAULT NULL,
  `car` varchar(200) DEFAULT NULL,
  `serie` varchar(200) DEFAULT NULL,
  `concessionnaire` varchar(200) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `fichier` varchar(200) DEFAULT NULL,
  `imtP` varchar(200) NOT NULL,
  `gr` varchar(200) NOT NULL,
  `pss` varchar(200) NOT NULL,
  `eqp` varchar(200) NOT NULL,
  `cli` varchar(200) NOT NULL,
  `sA` varchar(200) NOT NULL,
  `capr` varchar(200) NOT NULL,
  `dr` varchar(200) NOT NULL,
  `pID` int(11) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `etat` varchar(200) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `PasscreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vh_list`
--

INSERT INTO `vh_list` (`ID`, `imt`, `marque`, `model`, `cleur`, `genre`, `carbt`, `dte`, `car`, `serie`, `concessionnaire`, `photo`, `fichier`, `imtP`, `gr`, `pss`, `eqp`, `cli`, `sA`, `capr`, `dr`, `pID`, `prenom`, `etat`, `nom`, `PasscreationDate`) VALUES
(12, '2843 LA01', 'SUZUKI', 'Alto', 'orange', 'Taxi', 'essence', '2021-01-15', 'Cond int 4 pts', 'MA3JFB32S00J84212', 'CHINOIRE', 'ce99b9c8970bb36d7a8ed18ff4edd8471725453799.png', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-04 12:43:19'),
(13, '2840LA01', 'SUZUKI', 'Alto', 'orange', 'Taxi', 'essence', '2023-01-12', 'Cond Ind 4 pts ', 'MA3JFB32S00J72215', 'CHINOIRE', 'ce99b9c8970bb36d7a8ed18ff4edd8471725454059.png', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-04 12:47:39'),
(14, '9131WWCI01', 'SUZUKI', ' SPRESSO', 'marron', 'Taxi', 'gazoil', '2024-04-25', 'CIOYPRS', 'MH3RFL615RA487439', 'SOCIDA', '3474dcf984dc230a7cf20425a407c97a1725454409.jpg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-04 12:53:29'),
(15, 'AA-196-BG', 'SUZUKI', 'BALENO', 'grise', 'Yango', 'essence', '2024-03-15', '8GP 003594-121', '1.4L GLXBVA', 'SOCIDA', '2062eff220572908875105327b383fc81725468208.jpg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-04 16:43:28'),
(16, 'AA-240-AJ', 'SUZUKI', 'X5', 'jaune', 'Taxi', 'essence', '2024-09-05', 'gh4523df-hg', 'ddf45', 'SOCIDA', '919e9ae1249a5a28dbf1438d11f5ce3b1725539420.jpg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 10:46:12'),
(17, 'AA-340-jk', 'SUZUKI', ' VITZ', 'verte', 'Autres', 'essence', '2024-09-06', 'BG350WTTOK', 'CK-340-W5', 'SOCIDA', '32ca910b38de5358c7a1f1565eae174a1725533368jpeg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 10:49:28'),
(18, 'LK340-UK', 'PERGEOT', ' SPRESSO', 'rouge', 'Autres', 'essence', '2024-09-17', 'gh4523df-hg', 'CK-340-W5', 'SOCIDA', '32ca910b38de5358c7a1f1565eae174a1725533521jpeg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 10:52:01'),
(19, 'AA-889-MG12', 'SUZUKI', 'X5', 'blanche', 'blanche', 'essence', '2024-09-05', 'WWW-FH1253Y5589', '12MG44CDG2365', 'SOCIDA', 'f836b56eec762ae5dd761ee460604a041725534969.png', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 10:52:32'),
(20, 'HV 540UT', 'Toyota vitz', ' SPRESSO', 'verte', 'blanche', 'essence', '2024-08-27', 'gh4523df-hg', 'CK-340-W5', 'SOCIDA', '2062eff220572908875105327b383fc81725533631.jpg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 10:53:51'),
(21, 'AA-889-MG13', 'KIA', 'BALENO', 'orange', 'blanche', 'essence', '2024-09-04', 'WWW-FH1253Y55-89SX', '100MG44CDG2365', 'PERGEOT', '1587b9372f0cc47cec2f866b613b50231725533644.png', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 10:54:04'),
(22, '4589LA05', 'Ferrari', 'Seltos 2024 ', 'rouge', 'blanche', 'essence', '2024-09-02', 'WWW-FH1253Y6589', '5HMG44CDG2365', 'SOCIDA', 'aaf3fe4cab12711b65d8e449622cab7a1725533735.jpg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 10:55:35'),
(23, 'ZK-670-ll', 'Ferrari', ' SPRESSO', 'blanche', 'blanche', 'essence', '2024-09-12', 'GKSDUKL', 'GHKM56', 'SOCIDA', '32ca910b38de5358c7a1f1565eae174a1725533776jpeg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 10:56:16'),
(24, '4589LA06', 'SUZUKI', ' SPRESSO', 'grise', 'Autres', 'essence', '2024-09-03', 'WWW-FH1253Y6589QT', '5HMG44CDG2-KL65', ' KIA', '63a62be4bb13bd663444741706f4d0aa1725533807.jpg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 10:56:47'),
(25, '6524LA06', 'SUZUKI', ' SPRESSO', 'noir', 'blanche', 'essence', '2024-09-04', 'WWW-FH1253-Y6589QT', '100M-G44C-DG2365', 'SOCIDA', '9234e626472fa7c4bff8110c4b9f33141725533904.png', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 10:58:24'),
(26, '65-24L-A06', 'SUZUKI', ' SPRESSO', 'jaune', 'blanche', 'essence', '2024-09-03', 'WWW-FH12-53Y6-589', '12MG4-4CD-G2365', 'SOCIDA', 'c92369a877306e9bab5b1902629926491725534001.jpg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:00:01'),
(27, 'AA-120-nt', 'SUZUKI', ' SPRESSO', 'jaune', 'blanche', 'essence', '2024-09-10', 'GFJSFLSLV', 'SL45HK', 'SOCIDA', 'e99d4fea9c1e7b77626aa8afee9646f81725534018.jpg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:00:18'),
(28, 'BN23VT', 'PERGEOT', ' SPRESSO', 'noir', 'Yango', 'gazoil', '2024-09-14', 'BG350WTTOK', 'CK-340-W5', 'SOCIDA', 'e99d4fea9c1e7b77626aa8afee9646f81725534131.jpg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:02:12'),
(29, '145MLLA07', 'SUZUKI', ' SPRESSO', 'verte', 'Yango', 'essence', '2024-09-09', 'WWW-FH1253YY6589', '12MG44CD2365', 'SOCIDA', '45f802c90a437ab0a7f4216d68c33f781725534173.jpg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:02:54'),
(30, 'HJ', 'Ferrari', ' SPRESSO', 'blanche', 'blanche', 'essence', '2024-08-31', 'BG350WTTOK', 'CK-340-W5 HJ', 'SOCIDA', 'ce99b9c8970bb36d7a8ed18ff4edd8471725534260.png', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:04:21'),
(31, 'HG380ML', 'KIA', ' SPRESSO', 'noir', 'Yango', 'gazoil', '2024-09-19', 'BG350WTTOK', 'CK-340-W5 HJ', 'SOCIDA', '2062eff220572908875105327b383fc81725534420.jpg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:07:00'),
(32, '458-9LA05', 'SUZUKI', ' SPRESSO', 'marron', 'blanche', 'essence', '2024-09-02', 'WWW-FH1253-Y5589', '12MG4-4CD-G2365', 'SOCIDA', '7fdc1a630c238af0815181f9faa190f51725534473.jpg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:07:54'),
(33, 'ZY-89ML-', 'SUZUKI', ' SPRESSO', 'grise', 'Yango', 'gazoil', '2024-09-15', '000', '0000', 'SOCIDA', '32ca910b38de5358c7a1f1565eae174a1725534525jpeg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:08:45'),
(34, 'LP-7824-ZR', 'Ferrari', ' VITZ', 'jaune', 'Autres', 'essence', '2024-09-05', 'WWW/FH1253/Y5589', '255SS/56DFBGF', 'PERGEOT', '21fe716d81910804a837883c1f2f60181725534598.png', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:09:58'),
(35, 'ML430-HJ', 'KIA', ' SPRESSO', 'verte', 'Taxi', 'gazoil', '2024-09-18', '000', '0000', 'SOCIDA', '2062eff220572908875105327b383fc81725534665.jpg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:11:06'),
(36, '4589LA006', 'Toyota vitz', 'Seltos 2024 ', 'grise', 'blanche', 'essence', '2024-09-05', 'FH1253Y5589', '5HM-G44CDG2-KL65', 'SOCIDA', '7c3e9f948a864a689448799b326fb0ae1725534718.png', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:11:58'),
(37, 'LO-3410HJ', 'Toyota vitz', 'X5', 'grise', 'blanche', 'essence', '2024-09-10', '000', '0000', 'SOCIDA', '32ca910b38de5358c7a1f1565eae174a1725534995jpeg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:16:35'),
(38, 'DF-25-BN', 'SUZUKI', ' SPRESSO', 'rouge', 'Taxi', 'essence', '2024-09-17', 'HJ:_22', 'ADK-GH4525GH526', 'SOCIDA', '2062eff220572908875105327b383fc81725535210.jpg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:20:10'),
(39, 'AA-490HV', 'PERGEOT', ' SPRESSO', 'noir', 'Taxi', 'essence', '2024-09-19', '000000', 'ADK-GH4525GH526', 'SOCIDA', '32ca910b38de5358c7a1f1565eae174a1725535656jpeg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:27:36'),
(40, 'ZK-120-LK', 'SUZUKI', 'BALENO', 'jaune', 'blanche', 'essence', '2024-09-20', 'HJ:_22', 'ADK-GH4525GH526', 'SOCIDA', '2062eff220572908875105327b383fc81725535871.jpg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:31:11'),
(41, 'TO-720-LK', 'SUZUKI', ' SPRESSO', 'noir', 'Yango', 'essence', '2024-09-07', 'GJSLTFJ', 'HJK56DG', 'SOCIDA', '32ca910b38de5358c7a1f1565eae174a1725535986jpeg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:33:06'),
(42, 'BM-830-ET', 'SUZUKI', ' SPRESSO', 'orange', 'Autres', 'essence', '2024-09-07', 'HJ:_22', 'ADK-GH4525GH526', 'SOCIDA', 'e99d4fea9c1e7b77626aa8afee9646f81725536099.jpg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:34:59'),
(43, 'ET-250-WW', 'PERGEOT', ' SPRESSO', 'noir', 'Yango', 'essence', '2024-09-21', 'HJ:_22', '0000', 'SOCIDA', 'e99d4fea9c1e7b77626aa8afee9646f81725536186.jpg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:36:26'),
(44, '9120WWCI', 'SUZUKI', ' SPRESSO', 'verte', 'Autres', 'essence', '2024-09-29', 'HJ:_22', 'ADK-GH4525GH526', ' KIA', '32ca910b38de5358c7a1f1565eae174a1725536287jpeg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:38:07'),
(45, '2077WW-CIO1', 'Toyota vitz', ' SPRESSO', 'grise', 'Taxi', 'essence', '2024-09-02', '4525DF', 'ADK-GH4525GH526', 'SOCIDA', 'e99d4fea9c1e7b77626aa8afee9646f81725536436.jpg', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', '2024-09-05 11:40:36'),
(46, '15440 WW CI 01', 'SUZUKI', ' SPRESSO', 'grise', 'Yango', 'essence', '2024-07-05', '2024/15440', 'CIOYPRS', 'SOCIDA', '12bb834bbd9834ddd9b8ef9aa7d18dda1725549186.jpg', NULL, '', '6 mois', '', '120km', 'Oui', 'Oui', '50 litres ', '2024-10-16', 30, 'AHOU LYDIE Eps DJAYA', 'Neuf', 'AKA', '2024-09-05 15:11:11');

-- --------------------------------------------------------

--
-- Structure de la table `vignette_list`
--

CREATE TABLE `vignette_list` (
  `ID` int(10) NOT NULL,
  `imt` varchar(200) DEFAULT NULL,
  `nv` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `marque` varchar(200) NOT NULL,
  `nserie` varchar(200) NOT NULL,
  `mt` varchar(200) NOT NULL,
  `dteservice` date NOT NULL,
  `dtef` varchar(200) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vignette_list`
--

INSERT INTO `vignette_list` (`ID`, `imt`, `nv`, `type`, `marque`, `nserie`, `mt`, `dteservice`, `dtef`, `photo`, `CreationDate`) VALUES
(39, '15440 WW CI 01', 'GKH-7555', 'HK542', 'SUZUKI', '42HJKLL', 'DG458', '0000-00-00', '2024-09-12', '688df2d9ecf63199d585bc2469acb4f41726134946.pdf', '2024-09-12 09:55:46'),
(40, '15440 WW CI 01', '125db', 'ok', 'SUZUKI', 'dfhs66', '5000000', '2024-09-10', '2024-09-13', '688df2d9ecf63199d585bc2469acb4f41726136309.pdf', '2024-09-12 10:18:29'),
(41, '2840LA01', 'vv;;523', '55dddj', 'SUZUKI', '555dd5', '5000', '2024-09-11', '2024-09-11', '688df2d9ecf63199d585bc2469acb4f41726136662.pdf', '2024-09-12 10:24:22');

-- --------------------------------------------------------

--
-- Structure de la table `vsmt_list`
--

CREATE TABLE `vsmt_list` (
  `vID` int(10) NOT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `prenom` varchar(200) DEFAULT NULL,
  `permis` varchar(200) DEFAULT NULL,
  `imt` varchar(200) DEFAULT NULL,
  `genres` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `jour` varchar(100) NOT NULL,
  `marque` varchar(200) NOT NULL,
  `model` varchar(200) NOT NULL,
  `ob` text NOT NULL,
  `versement` varchar(200) DEFAULT NULL,
  `pointage` varchar(200) DEFAULT NULL,
  `recette` varchar(200) DEFAULT NULL,
  `total_v` varchar(200) DEFAULT NULL,
  `total_r` varchar(200) DEFAULT NULL,
  `total_p` varchar(200) DEFAULT NULL,
  `total` varchar(200) DEFAULT NULL,
  `versements` varchar(200) NOT NULL,
  `recet` varchar(200) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `dateN` varchar(200) NOT NULL,
  `ID` int(10) NOT NULL,
  `aID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vsmt_list`
--

INSERT INTO `vsmt_list` (`vID`, `nom`, `prenom`, `permis`, `imt`, `genres`, `date`, `jour`, `marque`, `model`, `ob`, `versement`, `pointage`, `recette`, `total_v`, `total_r`, `total_p`, `total`, `versements`, `recet`, `CreationDate`, `dateN`, `ID`, `aID`) VALUES
(49, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'Taxi', '2024-09-05', 'Ordinaire', 'SUZUKI', 'Alto', 'RAS', '27000', '5000', '22000.00', '27000.00', '22000.00', NULL, '27000.00', '', '', '2024-09-10 10:29:48', '0', 0, 0),
(51, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'Taxi', '2024-09-07', 'Ordinaire', 'SUZUKI', 'Alto', 'RAS', '27000', '5000', '22000.00', '27000.00', '22000.00', NULL, '27000.00', '', '', '2024-09-10 10:34:27', '0', 0, 0),
(52, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'Taxi', '2024-09-22', 'Ordinaire', 'SUZUKI', ' SPRESSO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '', '', '2024-09-10 10:38:34', '0', 0, 0),
(53, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'Taxi', '2024-09-06', 'Ordinaire', 'SUZUKI', ' SPRESSO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '', '', '2024-09-10 10:39:38', '0', 0, 0),
(54, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'Taxi', '2024-09-07', 'Ordinaire', 'SUZUKI', ' SPRESSO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '', '', '2024-09-10 10:40:15', '0', 0, 0),
(55, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'Taxi', '2024-09-08', 'Ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '5000', '000', '5000.00', '5000.00', '5000.00', NULL, '5000.00', '', '', '2024-09-10 10:41:55', '0', 0, 0),
(56, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'Yango', '2024-09-06', 'Ordinaire', 'SUZUKI', 'BALENO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '', '', '2024-09-10 10:46:24', '0', 0, 0),
(57, 'DJAKO', 'YAYO PAUL ARISTIDE', 'DJAK01-15-25013472YP', 'AA-196-BG', 'Yango', '2024-09-05', 'Ordinaire', 'SUZUKI', 'BALENO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '', '', '2024-09-10 10:47:03', '0', 0, 0),
(58, 'DJAKO', 'YAYO PAUL ARISTIDE', 'DJAK01-15-25013472YP', 'AA-196-BG', 'Yango', '2024-09-07', 'Ordinaire', 'SUZUKI', 'BALENO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '', '', '2024-09-10 10:48:22', '0', 0, 0),
(59, 'DJAKO', 'YAYO PAUL ARISTIDE', 'DJAK01-15-25013472YP', 'AA-196-BG', 'Yango', '2024-09-09', 'Ordinaire', 'SUZUKI', 'BALENO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '', '', '2024-09-10 10:49:31', '0', 0, 0),
(60, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'Taxi', '2024-09-06', 'Ordinaire', 'SUZUKI', 'Alto', 'AVOIR 2000', '20000', '000', '20000.00', '20000.00', '20000.00', NULL, '20000.00', '', '', '2024-09-10 10:55:20', '0', 0, 0),
(61, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'Taxi', '2024-09-10', 'Ordinaire', 'SUZUKI', 'Alto', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '', '', '2024-09-11 13:05:57', '0', 0, 0),
(62, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'Taxi', '2024-09-10', 'Ordinaire', 'SUZUKI', ' SPRESSO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '', '', '2024-09-11 13:07:02', '0', 0, 0),
(63, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'Yango', '2024-09-10', 'Ordinaire', 'SUZUKI', 'BALENO', 'pas vite commencer', '17000', '000', '17000.00', '17000.00', '17000.00', NULL, '17000.00', '', '', '2024-09-11 13:08:05', '0', 0, 0),
(64, 'YACOU ', 'WACOUBO GUY - NOËL ', 'YACO01-15-25024047WG', '15440 WW CI 01', 'Yango', '2024-09-11', 'Ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '', '', '2024-09-12 17:18:35', '0', 0, 0),
(65, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'Taxi', '2024-09-11', 'Ordinaire', 'SUZUKI', 'Alto', 'RAS', '25000', '3000', '22000.00', '25000.00', '22000.00', NULL, '25000.00', '', '', '2024-09-12 17:19:50', '0', 0, 0),
(66, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'Taxi', '2024-09-11', 'Ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '25000', '3000', '22000.00', '25000.00', '22000.00', NULL, '25000.00', '', '', '2024-09-12 17:20:43', '0', 0, 0),
(67, 'DJAKO', 'YAYO PAUL ARISTIDE', 'DJAK01-15-25013472YP', 'AA-196-BG', 'Yango', '2024-09-11', 'Ordinaire', 'SUZUKI', 'BALENO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '', '', '2024-09-12 17:23:11', '0', 0, 0),
(68, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'Taxi', '2024-09-12', 'Ordinaire', 'SUZUKI', 'Alto', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '', '', '2024-09-13 13:40:05', '0', 0, 0),
(69, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'Taxi', '2024-09-12', 'Ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '25000', '3000', '22000.00', '25000.00', '22000.00', NULL, '25000.00', '', '', '2024-09-13 13:41:09', '0', 0, 0),
(70, 'YACOU ', 'WACOUBO GUY - NOËL ', 'YACO01-15-25024047WG', '15440 WW CI 01', 'Yango', '2024-09-12', 'Ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '', '', '2024-09-13 13:41:51', '0', 0, 0),
(71, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'Yango', '2024-09-12', 'Ordinaire', 'SUZUKI', 'BALENO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '', '', '2024-09-13 13:42:36', '0', 0, 0),
(72, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'Taxi', '2024-09-13', 'Ordinaire', 'SUZUKI', 'Alto', 'RAS', '27000', '5000', '22000.00', '27000.00', '22000.00', NULL, '27000.00', '', '', '2024-09-16 13:50:03', '0', 0, 0),
(73, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'Taxi', '2024-09-14', 'Ordinaire', 'SUZUKI', 'Alto', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '', '', '2024-09-16 13:50:58', '0', 0, 0),
(74, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'Taxi', '2024-09-15', 'Férié', 'SUZUKI', 'Alto', 'RAS', '5000', '000', '5000.00', '5000.00', '5000.00', NULL, '5000.00', '', '', '2024-09-16 13:51:50', '0', 0, 0),
(75, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'Taxi', '2024-09-13', 'Ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '25000', '3000', '22000.00', '25000.00', '22000.00', NULL, '25000.00', '', '', '2024-09-16 13:53:04', '0', 0, 0),
(76, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'Taxi', '2024-09-14', 'Ordinaire', 'SUZUKI', ' SPRESSO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '', '', '2024-09-16 13:53:45', '0', 0, 0),
(77, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'Taxi', '2024-09-15', 'Férié', 'SUZUKI', ' SPRESSO', 'RAS', '5000', '000', '5000.00', '5000.00', '5000.00', NULL, '5000.00', '', '', '2024-09-16 13:55:10', '0', 0, 0),
(78, 'DJAKO', 'YAYO PAUL ARISTIDE', 'DJAK01-15-25013472YP', 'AA-196-BG', 'Yango', '2024-09-13', 'Ordinaire', 'SUZUKI', 'BALENO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '', '', '2024-09-16 13:56:17', '0', 0, 0),
(79, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'Yango', '2024-09-14', 'Ordinaire', 'SUZUKI', 'BALENO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '', '', '2024-09-16 13:56:50', '0', 0, 0),
(80, 'YACOU ', 'WACOUBO GUY - NOËL ', 'YACO01-15-25024047WG', '15440 WW CI 01', 'Yango', '2024-09-11', 'Ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '', '', '2024-09-16 13:58:37', '0', 0, 0),
(81, 'YACOLI', 'WACOUBO GUY - NOËL ', 'YACO01-15-25024047WG', '15440 WW CI 01', 'Yango', '2024-09-12', 'Ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '', '', '2024-09-16 14:15:18', '0', 0, 0),
(82, 'YACOLI', 'WACOUBO GUY - NOËL ', 'YACO01-15-25024047WG', '15440 WW CI 01', 'Yango', '2024-09-13', 'Ordinaire', 'SUZUKI', ' SPRESSO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '', '', '2024-09-16 14:16:02', '0', 0, 0),
(83, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'Taxi', '2024-09-08', 'Férié', 'SUZUKI', 'Alto', 'RAS', '5000', '000', '5000.00', '5000.00', '5000.00', NULL, '5000.00', '', '', '2024-09-16 14:18:11', '0', 0, 0),
(85, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'yango', '2024-09-16', 'ordinaire', 'SUZUKI', 'BALENO', 'AVOIR 2000', '20000', '000', '20000.00', '20000.00', '20000.00', NULL, '20000.00', '24000 francs CFA', '22000 francs CFA', '2024-09-18 16:54:26', '0', 0, 0),
(86, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'yango', '2024-09-17', 'ordinaire', 'SUZUKI', 'BALENO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '24000 francs CFA', '22000 francs CFA', '2024-09-18 16:55:16', '0', 0, 0),
(87, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'taxi', '2024-09-16', 'ordinaire', 'SUZUKI', 'Alto', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '27000 francs CFA', '22000 francs CFA', '2024-09-18 17:02:30', '0', 0, 0),
(88, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'taxi', '2024-09-17', 'ordinaire', 'SUZUKI', 'Alto', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '27000 francs CFA', '22000 francs CFA', '2024-09-18 17:03:43', '0', 0, 0),
(89, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'taxi', '2024-09-09', 'ordinaire', 'SUZUKI', 'Alto', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '27000 francs CFA', '22000 francs CFA', '2024-09-18 17:05:50', '0', 0, 0),
(90, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'taxi', '2024-09-16', 'ferie', 'SUZUKI', ' SPRESSO', 'RAS', '25000', '3000', '22000.00', '25000.00', '22000.00', NULL, '25000.00', '22000 francs CFA', '17000 francs CFA', '2024-09-18 17:11:45', '0', 0, 0),
(91, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'taxi', '2024-09-21', 'ordinaire', 'SUZUKI', 'Alto', 'RAS', '25000', '3000', '22000.00', '25000.00', '22000.00', NULL, '25000.00', '27000 francs CFA', '22000 francs CFA', '2024-09-23 15:19:15', '0', 0, 0),
(92, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'taxi', '2024-09-22', 'ferie', 'SUZUKI', 'Alto', 'RAS', '10000', '5000', '5000.00', '10000.00', '5000.00', NULL, '10000.00', '22000 francs CFA', '17000 francs CFA', '2024-09-23 15:20:09', '0', 0, 0),
(93, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'taxi', '2024-09-19', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '25000', '3000', '22000.00', '25000.00', '22000.00', NULL, '25000.00', '27000 francs CFA', '22000 francs CFA', '2024-09-23 15:21:13', '0', 0, 0),
(94, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'taxi', '2024-09-20', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '25000', '3000', '22000.00', '25000.00', '22000.00', NULL, '25000.00', '27000 francs CFA', '22000 francs CFA', '2024-09-23 15:22:11', '0', 0, 0),
(95, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'taxi', '2024-09-21', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '25000', '3000', '22000.00', '25000.00', '22000.00', NULL, '25000.00', '27000 francs CFA', '22000 francs CFA', '2024-09-23 15:23:03', '0', 0, 0),
(96, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'taxi', '2024-09-22', 'ferie', 'SUZUKI', ' SPRESSO', 'RAS', '5000', '000', '5000.00', '5000.00', '5000.00', NULL, '5000.00', '22000 francs CFA', '17000 francs CFA', '2024-09-23 15:23:48', '0', 0, 0),
(97, 'DJAKO', 'YAYO PAUL ARISTIDE', 'DJAK01-15-25013472YP', 'AA-196-BG', 'yango', '2024-09-19', 'ordinaire', 'SUZUKI', 'BALENO', 'RAS', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '24000 francs CFA', '22000 francs CFA', '2024-09-23 15:25:36', '0', 0, 0),
(98, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'yango', '2024-09-21', 'ordinaire', 'SUZUKI', 'BALENO', 'RAS', '24000', '000', '24000.00', '24000.00', '24000.00', NULL, '24000.00', '24000 francs CFA', '22000 francs CFA', '2024-09-23 15:26:53', '0', 0, 0),
(99, 'YACOLI', 'WACOUBO GUY - NOËL ', 'YACO01-15-25024047WG', '15440 WW CI 01', 'taxi', '2024-09-19', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '27000 francs CFA', '22000 francs CFA', '2024-09-23 15:29:25', '0', 0, 0),
(100, 'YACOLI', 'WACOUBO GUY - NOËL ', 'YACO01-15-25024047WG', '15440 WW CI 01', 'yango', '2024-09-20', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '24000 francs CFA', '22000 francs CFA', '2024-09-23 15:30:30', '0', 0, 0),
(101, 'YACOLI', 'WACOUBO GUY - NOËL ', 'YACO01-15-25024047WG', '15440 WW CI 01', 'yango', '2024-09-21', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '24000 francs CFA', '22000 francs CFA', '2024-09-23 15:31:09', '0', 0, 0),
(102, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'taxi', '2024-09-23', 'ordinaire', 'SUZUKI', 'Alto', 'RAS', '25000', '3000', '22000.00', '25000.00', '22000.00', NULL, '25000.00', '27000 francs CFA', '22000 francs CFA', '2024-09-24 13:40:54', '0', 0, 0),
(103, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'taxi', '2024-09-23', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '25000', '3000', '22000.00', '25000.00', '22000.00', NULL, '25000.00', '27000 francs CFA', '22000 francs CFA', '2024-09-24 13:41:36', '0', 0, 0),
(104, 'DOSSO', 'GOUE DANNEL ', 'DOSS01-16-25053408GD', '15440 WW CI 01', 'yango', '2024-09-23', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '24000 francs CFA', '22000 francs CFA', '2024-09-24 13:42:28', '0', 0, 0),
(105, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'taxi', '2024-09-24', 'ordinaire', 'SUZUKI', 'Alto', 'ok', '23000', '1000', '22000.00', '23000.00', '22000.00', NULL, '23000.00', '27000 francs CFA', '22000 francs CFA', '2024-09-25 13:27:43', '0', 0, 0),
(106, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'taxi', '2024-09-24', 'ordinaire', 'SUZUKI', ' SPRESSO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '27000 francs CFA', '22000 francs CFA', '2024-09-25 13:28:24', '0', 0, 0),
(107, 'YACOLI', 'WACOUBO GUY - NOËL ', 'YACO01-15-25024047WG', '15440 WW CI 01', 'yango', '2024-09-24', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '24000 francs CFA', '22000 francs CFA', '2024-09-25 13:29:35', '0', 0, 0),
(108, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'taxi', '2024-09-25', 'ordinaire', 'SUZUKI', 'Alto', 'AVOIR 2000', '20000', '000', '20000.00', '20000.00', '20000.00', NULL, '20000.00', '27000 francs CFA', '22000 francs CFA', '2024-09-26 13:32:48', '0', 0, 0),
(109, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'taxi', '2024-09-25', 'ordinaire', 'SUZUKI', ' SPRESSO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '27000 francs CFA', '22000 francs CFA', '2024-09-26 13:33:24', '0', 0, 0),
(110, 'DJAKO', 'YAYO PAUL ARISTIDE', 'DJAK01-15-25013472YP', 'AA-196-BG', 'yango', '2024-09-25', 'ordinaire', 'SUZUKI', 'BALENO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '24000 francs CFA', '22000 francs CFA', '2024-09-26 13:34:16', '0', 0, 0),
(111, 'YACOLI', 'WACOUBO GUY - NOËL ', 'YACO01-15-25024047WG', '15440 WW CI 01', 'yango', '2024-09-25', 'ordinaire', 'SUZUKI', ' SPRESSO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '24000 francs CFA', '22000 francs CFA', '2024-09-26 13:35:38', '0', 0, 0),
(112, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'taxi', '2024-09-26', 'ordinaire', 'SUZUKI', 'Alto', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '27000 francs CFA', '22000 francs CFA', '2024-09-27 14:17:15', '0', 0, 0),
(113, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'taxi', '2024-09-26', 'ordinaire', 'SUZUKI', ' SPRESSO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '27000 francs CFA', '22000 francs CFA', '2024-09-27 14:18:38', '0', 0, 0),
(114, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'yango', '2024-09-26', 'ordinaire', 'SUZUKI', 'BALENO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '24000 francs CFA', '22000 francs CFA', '2024-09-27 14:19:11', '0', 0, 0),
(115, 'DOSSO', 'GOUE DANNEL ', 'DOSS01-16-25053408GD', '15440 WW CI 01', 'taxi', '2024-09-26', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '27000 francs CFA', '22000 francs CFA', '2024-09-27 14:19:50', '0', 0, 0),
(117, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'taxi', '2024-09-27', 'ordinaire', 'SUZUKI', 'Alto', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '22000 ', '1960-01-01', '2024-10-02 14:09:25', '27000', 13, 71),
(118, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'taxi', '2024-10-02', 'ordinaire', 'SUZUKI', 'Alto', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '22000 ', '1977-12-19', '2024-10-02 14:10:54', '27000', 13, 64),
(119, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'taxi', '2024-09-28', 'ordinaire', 'SUZUKI', 'Alto', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '22000 ', '1977-12-19', '2024-10-02 14:12:41', '27000', 13, 64),
(120, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'taxi', '2024-09-29', 'ferie', 'SUZUKI', 'Alto', 'RAS', '5000', '000', '5000.00', '5000.00', '5000.00', NULL, '5000.00', '17000 ', '1960-01-01', '2024-10-02 14:13:29', '22000', 13, 71),
(121, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'taxi', '2024-09-30', 'ordinaire', 'SUZUKI', 'Alto', 'panne au niveau de la boite', '15000', '000', '15000.00', '15000.00', '15000.00', NULL, '15000.00', '22000 ', '1977-12-19', '2024-10-02 14:14:42', '27000', 13, 64),
(122, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'taxi', '2024-10-01', 'ordinaire', 'SUZUKI', 'Alto', 'garage', '5000', '000', '5000.00', '5000.00', '5000.00', NULL, '5000.00', '22000 ', '1960-01-01', '2024-10-02 14:15:23', '27000', 13, 71),
(123, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'taxi', '2024-09-27', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '27000', '5000', '22000.00', '27000.00', '22000.00', NULL, '27000.00', '22000 ', '1975-01-01', '2024-10-02 14:21:39', '27000', 14, 72),
(124, 'DJAKO', 'YAYO PAUL ARISTIDE', 'DJAK01-15-25013472YP', 'AA-196-BG', 'yango', '2024-09-27', 'ordinaire', 'SUZUKI', 'BALENO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '22000 ', '2024-05-11', '2024-10-02 14:24:18', '24000', 15, 68),
(125, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'yango', '2024-09-28', 'ordinaire', 'SUZUKI', 'BALENO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '22000 ', '1977-01-13', '2024-10-02 14:25:12', '24000', 15, 67),
(126, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'yango', '2024-09-30', 'ordinaire', 'SUZUKI', 'BALENO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '22000 ', '1977-01-13', '2024-10-02 14:26:13', '24000', 15, 67),
(127, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'yango', '2024-10-01', 'ordinaire', 'SUZUKI', 'BALENO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '22000 ', '1977-01-13', '2024-10-02 14:26:49', '24000', 15, 67),
(128, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'taxi', '2024-09-28', 'ordinaire', 'SUZUKI', ' SPRESSO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '22000 ', '1982-11-30', '2024-10-02 14:27:42', '27000', 14, 73),
(129, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'taxi', '2024-09-29', 'ferie', 'SUZUKI', ' SPRESSO', 'RAS', '10000', '5000', '5000.00', '10000.00', '5000.00', NULL, '10000.00', '17000 ', '1975-01-01', '2024-10-02 14:29:13', '22000', 14, 74),
(130, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'taxi', '2024-10-01', 'ordinaire', 'SUZUKI', ' SPRESSO', 'AVOIR 2000', '20000', '000', '20000.00', '20000.00', '20000.00', NULL, '20000.00', '22000 ', '1975-01-01', '2024-10-02 14:30:11', '27000', 14, 74),
(131, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'taxi', '2024-09-30', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '25000', '3000', '22000.00', '25000.00', '22000.00', NULL, '25000.00', '22000 ', '1982-11-30', '2024-10-02 14:31:43', '27000', 14, 73),
(132, 'DOSSO', 'GOUE DANNEL ', 'DOSS01-16-25053408GD', '15440 WW CI 01', 'yango', '2024-09-27', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '22000 ', '1983-02-13', '2024-10-02 14:32:55', '24000', 46, 70),
(133, 'YACOLI', 'WACOUBO GUY - NOËL ', 'YACO01-15-25024047WG', '15440 WW CI 01', 'yango', '2024-09-28', 'ordinaire', 'SUZUKI', ' SPRESSO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '22000 ', '1978-12-25', '2024-10-02 14:34:02', '24000', 46, 69),
(134, 'DOSSO', 'GOUE DANNEL ', 'DOSS01-16-25053408GD', '15440 WW CI 01', 'yango', '2024-09-30', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '22000 ', '1983-02-13', '2024-10-02 14:35:38', '24000', 46, 70),
(135, 'YACOLI', 'WACOUBO GUY - NOËL ', 'YACO01-15-25024047WG', '15440 WW CI 01', 'yango', '2024-10-01', 'ordinaire', 'SUZUKI', ' SPRESSO', 'reapparation de radiateur au garage', '15000', '000', '15000.00', '15000.00', '15000.00', NULL, '15000.00', '22000 ', '', '2024-10-02 14:37:11', '0', 0, 0),
(138, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'taxi', '2024-10-03', 'ordinaire', 'SUZUKI', 'Alto', 'RAS', '25000', '3000', '22000.00', '25000.00', '22000.00', NULL, '25000.00', '27000 ', '22000 ', '2024-10-17 13:17:02', '1960', 13, 71),
(139, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'taxi', '2024-10-17', 'ordinaire', 'SUZUKI', 'Alto', 'reunion et maladie', '000', '000', '0.00', '0.00', '0.00', NULL, '0.00', '27000 ', '22000 ', '2024-10-17 13:19:16', '1977', 13, 64),
(140, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'taxi', '2024-10-05', 'ordinaire', 'SUZUKI', 'Alto', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '27000 ', '22000 ', '2024-10-17 13:23:33', '1960', 13, 71),
(141, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'taxi', '2024-10-06', 'ferie', 'SUZUKI', 'Alto', 'RAS', '5000', '000', '5000.00', '5000.00', '5000.00', NULL, '5000.00', '22000 ', '17000 ', '2024-10-17 13:24:43', '1977', 13, 64),
(142, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'taxi', '2024-10-07', 'ordinaire', 'SUZUKI', 'Alto', 'RAS', '23000', '1000', '22000.00', '23000.00', '22000.00', NULL, '23000.00', '27000 ', '22000 ', '2024-10-17 13:25:31', '1960', 13, 71),
(143, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'taxi', '2024-10-08', 'ordinaire', 'SUZUKI', 'Alto', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '27000 ', '22000 ', '2024-10-17 13:26:11', '1977', 13, 64),
(144, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'taxi', '2024-10-09', 'ordinaire', 'SUZUKI', 'Alto', 'AVOIR 2000', '20000', '000', '20000.00', '20000.00', '20000.00', NULL, '20000.00', '27000 ', '22000 ', '2024-10-17 13:27:11', '1960', 13, 71),
(145, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'taxi', '2024-10-10', 'ordinaire', 'SUZUKI', 'Alto', 'RAS', '23000', '1000', '22000.00', '23000.00', '22000.00', NULL, '23000.00', '27000 ', '22000 ', '2024-10-17 13:27:54', '1977', 13, 64),
(146, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'taxi', '2024-10-11', 'ordinaire', 'SUZUKI', 'Alto', 'RAS', '26000', '4000', '22000.00', '26000.00', '22000.00', NULL, '26000.00', '27000 ', '22000 ', '2024-10-17 13:28:48', '1960', 13, 71),
(147, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'taxi', '2024-10-12', 'ordinaire', 'SUZUKI', 'Alto', 'RAS', '23000', '1000', '22000.00', '23000.00', '22000.00', NULL, '23000.00', '27000 ', '22000 ', '2024-10-17 13:29:34', '1977', 13, 64),
(148, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'taxi', '2024-10-13', 'ferie', 'SUZUKI', 'Alto', 'RAS', '5000', '000', '5000.00', '5000.00', '5000.00', NULL, '5000.00', '22000 ', '17000 ', '2024-10-17 13:30:10', '1960', 13, 71),
(149, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'taxi', '2024-10-14', 'ordinaire', 'SUZUKI', 'Alto', 'RAS', '23000', '1000', '22000.00', '23000.00', '22000.00', NULL, '23000.00', '27000 ', '22000 ', '2024-10-17 13:30:45', '1977', 13, 64),
(150, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'taxi', '2024-10-15', 'ordinaire', 'SUZUKI', 'Alto', 'RAS', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '27000 ', '22000 ', '2024-10-17 13:33:07', '1977', 13, 64),
(151, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'taxi', '2024-10-02', 'ordinaire', 'SUZUKI', ' SPRESSO', 'garage', '20000', '000', '20000.00', '20000.00', '20000.00', NULL, '20000.00', '27000 ', '22000 ', '2024-10-17 13:42:50', '1982', 14, 73),
(152, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'taxi', '2024-10-03', 'ordinaire', 'SUZUKI', ' SPRESSO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '27000 ', '22000 ', '2024-10-17 13:43:21', '1975', 14, 74),
(153, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'taxi', '2024-10-04', 'ordinaire', 'SUZUKI', ' SPRESSO', 'reunion et garage', '000', '000', '0.00', '0.00', '0.00', NULL, '0.00', '27000 ', '22000 ', '2024-10-17 13:44:37', '1982', 14, 73),
(154, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'taxi', '2024-10-05', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '27000', '5000', '22000.00', '27000.00', '22000.00', NULL, '27000.00', '27000 ', '22000 ', '2024-10-17 13:45:12', '1975', 14, 74),
(155, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'taxi', '2024-10-06', 'ferie', 'SUZUKI', ' SPRESSO', 'RAS', '5000', '000', '5000.00', '5000.00', '5000.00', NULL, '5000.00', '22000 ', '17000 ', '2024-10-17 13:45:55', '1982', 14, 73),
(156, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'taxi', '2024-10-07', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '27000', '5000', '22000.00', '27000.00', '22000.00', NULL, '27000.00', '27000 ', '22000 ', '2024-10-17 13:46:28', '1975', 14, 74),
(157, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'taxi', '2024-10-08', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '27000', '5000', '22000.00', '27000.00', '22000.00', NULL, '27000.00', '27000 ', '22000 ', '2024-10-17 13:47:23', '1982', 14, 73),
(158, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'taxi', '2024-10-09', 'ordinaire', 'SUZUKI', ' SPRESSO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '27000 ', '22000 ', '2024-10-17 13:48:06', '1975', 14, 74),
(159, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'taxi', '2024-10-10', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '27000', '5000', '22000.00', '27000.00', '22000.00', NULL, '27000.00', '27000 ', '22000 ', '2024-10-17 13:48:47', '1982', 14, 73),
(160, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'taxi', '2024-10-11', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '27000', '5000', '22000.00', '27000.00', '22000.00', NULL, '27000.00', '27000 ', '22000 ', '2024-10-17 13:49:29', '1975', 14, 74),
(161, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'taxi', '2024-10-12', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '23000', '1000', '22000.00', '23000.00', '22000.00', NULL, '23000.00', '27000 ', '22000 ', '2024-10-17 13:50:19', '1982', 14, 73),
(162, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'taxi', '2024-10-13', 'ferie', 'SUZUKI', ' SPRESSO', 'RAS', '5000', '000', '5000.00', '5000.00', '5000.00', NULL, '5000.00', '22000 ', '17000 ', '2024-10-17 13:50:55', '1975', 14, 74),
(163, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'taxi', '2024-10-14', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '27000', '5000', '22000.00', '27000.00', '22000.00', NULL, '27000.00', '27000 ', '22000 ', '2024-10-17 13:51:31', '1982', 14, 73),
(164, 'DIALLO', 'LAMINE', 'DIAL01-14-00006027L', '9131WWCI01', 'taxi', '2024-10-15', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '27000', '5000', '22000.00', '27000.00', '22000.00', NULL, '27000.00', '27000 ', '22000 ', '2024-10-17 13:53:36', '1975', 14, 74),
(165, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'taxi', '2024-10-16', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '27000', '5000', '22000.00', '27000.00', '22000.00', NULL, '27000.00', '27000 ', '22000 ', '2024-10-17 13:54:28', '1982', 14, 73),
(166, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'yango', '2024-10-02', 'ordinaire', 'SUZUKI', 'BALENO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '24000 ', '22000 ', '2024-10-17 13:57:45', '1977', 15, 67),
(167, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'yango', '2024-10-03', 'ordinaire', 'SUZUKI', 'BALENO', 'RAS', '25000', '3000', '22000.00', '25000.00', '22000.00', NULL, '25000.00', '24000 ', '22000 ', '2024-10-17 13:58:34', '1977', 15, 67),
(168, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'yango', '2024-10-04', 'ordinaire', 'SUZUKI', 'BALENO', 'reunion et telephone ', '000', '000', '0.00', '0.00', '0.00', NULL, '0.00', '24000 ', '22000 ', '2024-10-17 13:59:56', '1977', 15, 67),
(169, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'yango', '2024-10-05', 'ordinaire', 'SUZUKI', 'BALENO', 'telephone', '000', '000', '0.00', '0.00', '0.00', NULL, '0.00', '24000 ', '22000 ', '2024-10-17 14:00:56', '1977', 15, 67),
(170, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'yango', '2024-10-10', 'ordinaire', 'SUZUKI', 'BALENO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '24000 ', '22000 ', '2024-10-17 14:03:11', '1977', 15, 67),
(171, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'yango', '2024-10-11', 'ordinaire', 'SUZUKI', 'BALENO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '24000 ', '22000 ', '2024-10-17 14:03:37', '1977', 15, 67),
(172, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'yango', '2024-10-12', 'ordinaire', 'SUZUKI', 'BALENO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '24000 ', '22000 ', '2024-10-17 14:04:07', '1977', 15, 67),
(173, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'yango', '2024-10-14', 'ordinaire', 'SUZUKI', 'BALENO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '24000 ', '22000 ', '2024-10-17 14:04:48', '1977', 15, 67),
(174, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'yango', '2024-10-15', 'ordinaire', 'SUZUKI', 'BALENO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '24000 ', '22000 ', '2024-10-17 14:05:19', '1977', 15, 67),
(175, 'KONAN', 'HUBERSON', 'KONA01-15-00061326H', 'AA-196-BG', 'yango', '2024-10-16', 'ordinaire', 'SUZUKI', 'BALENO', 'RAS', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '24000 ', '22000 ', '2024-10-17 14:05:56', '1977', 15, 67),
(176, 'DOSSO', 'GOUE DANNEL ', 'DOSS01-16-25053408GD', '15440 WW CI 01', 'yango', '2024-10-02', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '24000 ', '22000 ', '2024-10-17 14:08:26', '1983', 46, 70),
(177, 'DOSSO', 'GOUE DANNEL ', 'DOSS01-16-25053408GD', '15440 WW CI 01', 'yango', '2024-10-17', 'ordinaire', 'SUZUKI', ' SPRESSO', 'AVOIR 2000', '20000', '000', '20000.00', '20000.00', '20000.00', NULL, '20000.00', '24000 ', '22000 ', '2024-10-17 14:08:57', '1983', 46, 70),
(178, 'SAI', 'GOUAN ERNEST ', 'Sai01-15-25007386GR', '15440 WW CI 01', 'yango', '2024-10-04', 'ordinaire', 'SUZUKI', ' SPRESSO', 'reunion', '17000', '000', '17000.00', '17000.00', '17000.00', NULL, '17000.00', '24000 ', '22000 ', '2024-10-17 14:09:54', '1978', 46, 75),
(179, 'DOSSO', 'GOUE DANNEL ', 'DOSS01-16-25053408GD', '15440 WW CI 01', 'yango', '2024-10-05', 'ordinaire', 'SUZUKI', ' SPRESSO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '24000 ', '22000 ', '2024-10-17 14:10:30', '1983', 46, 70),
(180, 'SAI', 'GOUAN ERNEST ', 'Sai01-15-25007386GR', '15440 WW CI 01', 'yango', '2024-10-07', 'ordinaire', 'SUZUKI', ' SPRESSO', 'garage', '15000', '000', '15000.00', '15000.00', '15000.00', NULL, '15000.00', '24000 ', '22000 ', '2024-10-17 14:11:37', '1978', 46, 75),
(181, 'DOSSO', 'GOUE DANNEL ', 'DOSS01-16-25053408GD', '15440 WW CI 01', 'yango', '2024-10-08', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '23000', '1000', '22000.00', '23000.00', '22000.00', NULL, '23000.00', '24000 ', '22000 ', '2024-10-17 14:14:56', '1983', 46, 70),
(182, 'DOSSO', 'GOUE DANNEL ', 'DOSS01-16-25053408GD', '15440 WW CI 01', 'yango', '2024-10-17', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '24000 ', '22000 ', '2024-10-17 14:15:20', '1983', 46, 70),
(183, 'SAI', 'GOUAN ERNEST ', 'Sai01-15-25007386GR', '15440 WW CI 01', 'yango', '2024-10-10', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '24000 ', '22000 ', '2024-10-17 14:16:13', '1978', 46, 75),
(184, 'DOSSO', 'GOUE DANNEL ', 'DOSS01-16-25053408GD', '15440 WW CI 01', 'yango', '2024-10-11', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '24000 ', '22000 ', '2024-10-17 14:16:58', '1983', 46, 70),
(185, 'SAI', 'GOUAN ERNEST ', 'Sai01-15-25007386GR', '15440 WW CI 01', 'yango', '2024-10-12', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '24000 ', '22000 ', '2024-10-17 14:17:40', '1978', 46, 75),
(186, 'DOSSO', 'GOUE DANNEL ', 'DOSS01-16-25053408GD', '15440 WW CI 01', 'yango', '2024-10-14', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '17000', '000', '17000.00', '17000.00', '17000.00', NULL, '17000.00', '24000 ', '22000 ', '2024-10-17 14:18:21', '1983', 46, 70),
(187, 'DOSSO', 'GOUE DANNEL ', 'DOSS01-16-25053408GD', '15440 WW CI 01', 'yango', '2024-10-17', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '24000 ', '22000 ', '2024-10-17 14:18:57', '1983', 46, 70),
(188, 'SAI', 'GOUAN ERNEST ', 'Sai01-15-25007386GR', '15440 WW CI 01', 'yango', '2024-10-16', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '24000 ', '22000 ', '2024-10-17 14:19:35', '0', 46, 75),
(189, 'KONE ', 'BAKARY ', 'KONE01-15-25035324B', '2840LA01', 'taxi', '2024-10-17', 'ordinaire', 'SUZUKI', 'Alto', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '22000 ', '1960-01-01', '2024-10-18 15:25:35', '27000 ', 13, 71),
(190, 'FOFANA', 'INZA', 'FOFA01-15-240146311L', '2840LA01', 'taxi', '2024-10-16', 'ordinaire', 'SUZUKI', 'Alto', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '22000 ', '1977-12-19', '2024-10-18 15:26:10', '27000 ', 13, 64),
(191, 'CISSE', 'DAOUDIA ', 'CISS 01-21-44057677D', '9131WWCI01', 'taxi', '2024-10-17', 'ordinaire', 'SUZUKI', ' SPRESSO', 'pas pointer', '22000', '000', '22000.00', '22000.00', '22000.00', NULL, '22000.00', '22000 ', '1982-11-30', '2024-10-18 15:27:59', '27000 ', 14, 73),
(192, 'DOSSO', 'GOUE DANNEL ', 'DOSS01-16-25053408GD', '15440 WW CI 01', 'yango', '2024-10-17', 'ordinaire', 'SUZUKI', ' SPRESSO', 'RAS', '24000', '2000', '22000.00', '24000.00', '22000.00', NULL, '24000.00', '22000 ', '1983-02-13', '2024-10-18 15:28:49', '24000 ', 46, 70);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `assrc_list`
--
ALTER TABLE `assrc_list`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `attr_list`
--
ALTER TABLE `attr_list`
  ADD PRIMARY KEY (`aID`);

--
-- Index pour la table `chauffeur_list`
--
ALTER TABLE `chauffeur_list`
  ADD PRIMARY KEY (`chID`);

--
-- Index pour la table `cnt_list`
--
ALTER TABLE `cnt_list`
  ADD PRIMARY KEY (`cntID`);

--
-- Index pour la table `concessionnaire_list`
--
ALTER TABLE `concessionnaire_list`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `depenses`
--
ALTER TABLE `depenses`
  ADD PRIMARY KEY (`feid`),
  ADD KEY `ID` (`ID`);

--
-- Index pour la table `detail_panne`
--
ALTER TABLE `detail_panne`
  ADD PRIMARY KEY (`dcid`),
  ADD KEY `ID` (`ID`);

--
-- Index pour la table `diagn`
--
ALTER TABLE `diagn`
  ADD PRIMARY KEY (`decid`),
  ADD KEY `ID` (`ID`);

--
-- Index pour la table `dp_list`
--
ALTER TABLE `dp_list`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`fid`),
  ADD KEY `ID` (`ID`);

--
-- Index pour la table `lib_list`
--
ALTER TABLE `lib_list`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `model_list`
--
ALTER TABLE `model_list`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `pannes`
--
ALTER TABLE `pannes`
  ADD PRIMARY KEY (`panid`),
  ADD KEY `ID` (`ID`);

--
-- Index pour la table `panne_list`
--
ALTER TABLE `panne_list`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `patente_list`
--
ALTER TABLE `patente_list`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `pn_list`
--
ALTER TABLE `pn_list`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `pr_list`
--
ALTER TABLE `pr_list`
  ADD PRIMARY KEY (`pID`);

--
-- Index pour la table `sni_list`
--
ALTER TABLE `sni_list`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `svi_list`
--
ALTER TABLE `svi_list`
  ADD PRIMARY KEY (`kID`);

--
-- Index pour la table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `tblcontact`
--
ALTER TABLE `tblcontact`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `tblpass`
--
ALTER TABLE `tblpass`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `tbluseractions`
--
ALTER TABLE `tbluseractions`
  ADD PRIMARY KEY (`action_id`),
  ADD KEY `ID` (`ID`);

--
-- Index pour la table `total_dp`
--
ALTER TABLE `total_dp`
  ADD PRIMARY KEY (`deid`),
  ADD KEY `ID` (`ID`);

--
-- Index pour la table `total_factures`
--
ALTER TABLE `total_factures`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `ID` (`ID`);

--
-- Index pour la table `vh_list`
--
ALTER TABLE `vh_list`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `vignette_list`
--
ALTER TABLE `vignette_list`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `vsmt_list`
--
ALTER TABLE `vsmt_list`
  ADD PRIMARY KEY (`vID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `assrc_list`
--
ALTER TABLE `assrc_list`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `attr_list`
--
ALTER TABLE `attr_list`
  MODIFY `aID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pour la table `chauffeur_list`
--
ALTER TABLE `chauffeur_list`
  MODIFY `chID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pour la table `cnt_list`
--
ALTER TABLE `cnt_list`
  MODIFY `cntID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `concessionnaire_list`
--
ALTER TABLE `concessionnaire_list`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `depenses`
--
ALTER TABLE `depenses`
  MODIFY `feid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT pour la table `detail_panne`
--
ALTER TABLE `detail_panne`
  MODIFY `dcid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT pour la table `diagn`
--
ALTER TABLE `diagn`
  MODIFY `decid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pour la table `dp_list`
--
ALTER TABLE `dp_list`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `factures`
--
ALTER TABLE `factures`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `lib_list`
--
ALTER TABLE `lib_list`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `model_list`
--
ALTER TABLE `model_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `pannes`
--
ALTER TABLE `pannes`
  MODIFY `panid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pour la table `panne_list`
--
ALTER TABLE `panne_list`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT pour la table `patente_list`
--
ALTER TABLE `patente_list`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `pn_list`
--
ALTER TABLE `pn_list`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `pr_list`
--
ALTER TABLE `pr_list`
  MODIFY `pID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `sni_list`
--
ALTER TABLE `sni_list`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `svi_list`
--
ALTER TABLE `svi_list`
  MODIFY `kID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT pour la table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `tblcontact`
--
ALTER TABLE `tblcontact`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tblpass`
--
ALTER TABLE `tblpass`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `tbluseractions`
--
ALTER TABLE `tbluseractions`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `total_dp`
--
ALTER TABLE `total_dp`
  MODIFY `deid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT pour la table `total_factures`
--
ALTER TABLE `total_factures`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `vh_list`
--
ALTER TABLE `vh_list`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `vignette_list`
--
ALTER TABLE `vignette_list`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `vsmt_list`
--
ALTER TABLE `vsmt_list`
  MODIFY `vID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `depenses`
--
ALTER TABLE `depenses`
  ADD CONSTRAINT `depenses_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `vh_list` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `detail_panne`
--
ALTER TABLE `detail_panne`
  ADD CONSTRAINT `detail_panne_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `vh_list` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pannes`
--
ALTER TABLE `pannes`
  ADD CONSTRAINT `pannes_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `vh_list` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `tbluseractions`
--
ALTER TABLE `tbluseractions`
  ADD CONSTRAINT `tbluseractions_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `tbladmin` (`ID`);

--
-- Contraintes pour la table `total_dp`
--
ALTER TABLE `total_dp`
  ADD CONSTRAINT `total_dp_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `vh_list` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `total_factures`
--
ALTER TABLE `total_factures`
  ADD CONSTRAINT `total_factures_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `vh_list` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
