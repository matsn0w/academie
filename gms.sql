-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 23 nov 2019 om 19:48
-- Serverversie: 10.4.6-MariaDB
-- PHP-versie: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gms`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `aanmeldingen`
--

CREATE TABLE `aanmeldingen` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `afdeling` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT 0,
  `sollicitatie` varchar(10000) DEFAULT 'Aangemaakt via het leiding portal!	',
  `experience` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `made_uid` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8_bin NOT NULL,
  `afdeling` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '1=pol,2=ambu,3=kmar,4=mk,5=alles'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `agenda_aanwezig`
--

CREATE TABLE `agenda_aanwezig` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `type` enum('1','2','3') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `agenda_berichten`
--

CREATE TABLE `agenda_berichten` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `bericht` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `agenda_leden`
--

CREATE TABLE `agenda_leden` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `alerts`
--

CREATE TABLE `alerts` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `bericht` text NOT NULL,
  `gelezen` enum('0','1') NOT NULL,
  `type` enum('1','2') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cijfers`
--

CREATE TABLE `cijfers` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `by_uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `punten` varchar(255) NOT NULL,
  `cijfer` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `bericht` text NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact_in`
--

CREATE TABLE `contact_in` (
  `id` int(11) NOT NULL,
  `afdeling` varchar(255) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `onderwerp` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=actief,2=behandeld,3=verwijderd',
  `update_uid` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `contact_in`
--

INSERT INTO `contact_in` (`id`, `afdeling`, `naam`, `uid`, `email`, `onderwerp`, `message`, `date`, `status`, `update_uid`, `update_date`) VALUES
(83, 'noodhulp', 'Jari V.', 417, 'jarivanderveer@gmail.com', 'test1', 'test1 bericht', '2019-02-04 19:35:34', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact_leiding`
--

CREATE TABLE `contact_leiding` (
  `id` int(11) NOT NULL,
  `leidinggevende` varchar(255) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `onderwerp` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `update_uid` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `contact_leiding`
--

INSERT INTO `contact_leiding` (`id`, `leidinggevende`, `naam`, `uid`, `email`, `onderwerp`, `message`, `date`, `status`, `update_uid`, `update_date`) VALUES
(9, 'Allemaal', 'Jari V.', 417, 'jarivanderveer@gmail.com', 'test1', 'test1', '2019-02-04 19:36:36', 3, 417, '2019-02-04 19:36:55'),
(10, 'Sam O.', 'Sam O.', 418, 'samvanoo.11@gmail.com', 'HALLO! IK BEN EEN V.! WAT NU?', 'IK BEN EEN V.! Test.', '2019-02-04 19:46:53', 3, 68, '2019-02-04 19:51:11'),
(11, 'Jari V.', 'Jari V.', 417, 'jarivanderveer@gmail.com', 'test2', 'test2', '2019-02-04 19:53:13', 3, 417, '2019-02-04 19:53:59');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `extern_contact`
--

CREATE TABLE `extern_contact` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `extern_contact`
--

INSERT INTO `extern_contact` (`id`, `naam`, `email`, `message`, `date`, `status`) VALUES
(1, 'Gelsemium', '197723997@qq.com', 'Hello! That is an important news offers for you.  Try and be our next winner. http://bit.ly/2ytunXJ', '2018-12-22 04:14:06', 1),
(2, 'Marco Jong', 'Marco754@hotmail.nl', 'hoi<br />\r\n', '2019-02-04 19:48:52', 1),
(3, 'Marco Jong', 'Marco754@hotmail.nl', 'hoi<br />\r\n', '2019-02-04 19:51:57', 1),
(4, 'test', 'jarivanderveer@outlook.com', 'Test', '2019-02-16 21:27:50', 1),
(5, 'Jari', 'jarivanderveer@outlook.com', 'Test2', '2019-02-20 09:29:44', 1),
(6, 'Emiel', 'test@mail.com', 'Dit is een test.', '2019-03-17 11:08:04', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `formalgemeen`
--

CREATE TABLE `formalgemeen` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `leeftijd` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `vraag1` varchar(255) NOT NULL,
  `vraag2` varchar(255) NOT NULL,
  `vraag3` varchar(255) NOT NULL,
  `vraag4` varchar(255) NOT NULL,
  `vraag5` varchar(255) NOT NULL,
  `vraag6` varchar(255) NOT NULL,
  `gesprek` enum('ja','nee') NOT NULL,
  `opmerkingen` text NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `formclanpack`
--

CREATE TABLE `formclanpack` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `idee` text NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `formgegevens`
--

CREATE TABLE `formgegevens` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `formklachten`
--

CREATE TABLE `formklachten` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `tegen` varchar(255) NOT NULL,
  `klacht` text NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `formpromotie`
--

CREATE TABLE `formpromotie` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `voor` varchar(255) NOT NULL,
  `waarom` text NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `formtraining`
--

CREATE TABLE `formtraining` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `training` enum('1','2','3','4') NOT NULL,
  `bericht` text NOT NULL,
  `date` datetime NOT NULL,
  `chosendate` varchar(255) NOT NULL,
  `stat` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `formtraining`
--

INSERT INTO `formtraining` (`id`, `uid`, `training`, `bericht`, `date`, `chosendate`, `stat`) VALUES
(85, 427, '2', 'VP\r\n\r\n\r\nals daar vandaag nog tijd voor is.', '2019-02-05 18:03:31', '5/02/2019', '1'),
(86, 452, '1', 'Inwerk training graag.', '2019-02-09 23:07:12', '9-12-2019 ZSM/23:30', '1'),
(89, 417, '3', 'Ik wil graag een Promotie training aanvragen.', '2019-02-10 13:24:57', '10-2-2019 13:35', '1'),
(91, 455, '3', 'zodat ik kan werken\r\n', '2019-02-10 18:45:50', '10/2/2019 19;00', '1'),
(94, 424, '4', 'Examen Training.\r\n\r\n', '2019-02-14 16:06:53', '15/02/2019 tussen 13:30-15:00 / 16/02/2019 In overleg tijdstip / 17/02/2019 Gehele Dag', '1'),
(95, 68, '1', 'Test', '2019-09-17 13:28:39', 'TEst', '1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `formvakantie`
--

CREATE TABLE `formvakantie` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `inactief` date NOT NULL,
  `actief` date NOT NULL,
  `reden` text NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `formvakantie`
--

INSERT INTO `formvakantie` (`id`, `naam`, `achternaam`, `inactief`, `actief`, `reden`, `date`, `status`) VALUES
(2, 'randy', 'VC', '2019-02-15', '2019-09-18', 'op kamp ', '2019-02-15 17:46:32', '1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gms_aanwezigheid`
--

CREATE TABLE `gms_aanwezigheid` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gms_aanwezigheid`
--

INSERT INTO `gms_aanwezigheid` (`id`, `uid`, `status`, `date`, `time`) VALUES
(1056, 68, '1', '2019-02-07', '15:32:28'),
(1057, 427, '1', '2019-02-07', '20:16:58'),
(1058, 417, '1', '2019-02-08', '17:11:24'),
(1059, 417, '1', '2019-02-08', '19:34:00'),
(1060, 424, '1', '2019-02-08', '19:44:29'),
(1061, 419, '1', '2019-02-08', '20:14:10'),
(1062, 417, '1', '2019-02-08', '20:23:39'),
(1063, 417, '1', '2019-02-09', '13:10:32'),
(1064, 453, '1', '2019-02-10', '13:47:01'),
(1065, 453, '1', '2019-02-10', '14:28:17'),
(1066, 421, '1', '2019-02-10', '14:46:29'),
(1067, 453, '1', '2019-02-10', '14:46:46'),
(1068, 455, '1', '2019-02-10', '20:07:19'),
(1069, 455, '1', '2019-02-10', '20:32:56'),
(1070, 453, '1', '2019-02-11', '10:18:31'),
(1071, 421, '1', '2019-02-12', '19:31:04'),
(1072, 417, '1', '2019-02-12', '19:31:22'),
(1073, 417, '1', '2019-02-12', '19:49:00'),
(1074, 424, '1', '2019-02-12', '19:49:31'),
(1075, 417, '1', '2019-02-12', '20:09:06'),
(1076, 421, '1', '2019-02-12', '20:20:02'),
(1077, 424, '1', '2019-02-12', '20:39:05'),
(1078, 453, '1', '2019-02-13', '20:14:40'),
(1079, 453, '1', '2019-02-17', '20:39:43'),
(1080, 68, '1', '2019-10-10', '13:37:29');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gms_datums`
--

CREATE TABLE `gms_datums` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gms_eenheden`
--

CREATE TABLE `gms_eenheden` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gms_eenheden`
--

INSERT INTO `gms_eenheden` (`id`, `naam`, `value`) VALUES
(1, 'Noodhulp', 'nh'),
(4, 'Ambulance', 'ambu'),
(5, 'Brandweer', 'brw'),
(6, 'Verkeerspolitie', 'vp'),
(7, 'Noodhulp Motor', 'nh motor'),
(9, 'Rapid Responder', 'Rapid Responder'),
(11, 'Brandweer Motor', 'brw motor'),
(12, 'OVD-P', 'ovd-p'),
(13, 'OVD-B', 'ovd-b'),
(14, 'OVD-G/Rapid', 'OVD-G/Rapid'),
(16, 'Onopvallende NH', 'Onopvallend NH'),
(17, 'CoNo', 'CoNo'),
(19, 'Zulu', 'Zulu'),
(20, 'Onopvallende VP', 'onopvallend vp'),
(22, 'Lifeliner', 'lifeliner'),
(23, 'Recherche', 'recherche'),
(24, 'Burger', 'burger');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gms_eenheid_log`
--

CREATE TABLE `gms_eenheid_log` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gms_incidentgroepen`
--

CREATE TABLE `gms_incidentgroepen` (
  `id` int(11) NOT NULL,
  `mkid` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `default_porto` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gms_incidentgroepen`
--

INSERT INTO `gms_incidentgroepen` (`id`, `mkid`, `naam`, `password`, `default_porto`) VALUES
(279, 68, 'oc1', 'lk3Onxig', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gms_ingemeld`
--

CREATE TABLE `gms_ingemeld` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `groep_id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `roepnummer` varchar(255) NOT NULL,
  `eenheid` varchar(255) NOT NULL,
  `vrijw` enum('0','brw','ambu','at','lvp','mmt','duik') NOT NULL,
  `status` enum('0','1','2','3','4','5') NOT NULL DEFAULT '5',
  `ingemeld_date` datetime NOT NULL,
  `district` varchar(255) DEFAULT NULL,
  `grip` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gms_ingemeld`
--

INSERT INTO `gms_ingemeld` (`id`, `uid`, `groep_id`, `naam`, `roepnummer`, `eenheid`, `vrijw`, `status`, `ingemeld_date`, `district`, `grip`) VALUES
(1, 68, 279, 'Marco J.', '21-06', 'nh', '0', '1', '2019-10-13 17:15:16', '1', '-');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gms_log`
--

CREATE TABLE `gms_log` (
  `id` int(11) NOT NULL,
  `uid` varchar(11) NOT NULL,
  `groep_id` int(11) NOT NULL,
  `eenheid` varchar(255) NOT NULL,
  `titel` varchar(255) NOT NULL,
  `bericht` text NOT NULL,
  `gelezen` enum('0','1') NOT NULL,
  `time` time NOT NULL,
  `urgent` varchar(4) NOT NULL DEFAULT 'nee'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gms_log`
--

INSERT INTO `gms_log` (`id`, `uid`, `groep_id`, `eenheid`, `titel`, `bericht`, `gelezen`, `time`, `urgent`) VALUES
(1, '68', 279, '', 'Inmelding van: Marco J.: 21-06', '21-06: Marco J. Meld zich in als nh met Grip -', '1', '00:00:00', 'nee');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gms_meldingen`
--

CREATE TABLE `gms_meldingen` (
  `id` int(11) NOT NULL,
  `melding` text NOT NULL,
  `meldinginfo` text NOT NULL,
  `locatie` varchar(255) NOT NULL,
  `prio` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `door` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `porto` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `mkid` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gms_melding_aantekening`
--

CREATE TABLE `gms_melding_aantekening` (
  `id` int(11) NOT NULL,
  `mid` varchar(255) NOT NULL,
  `aantekening` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gms_melding_koppel`
--

CREATE TABLE `gms_melding_koppel` (
  `id` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `roepnummer` varchar(255) NOT NULL,
  `eenheid` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gms_opmerkingen`
--

CREATE TABLE `gms_opmerkingen` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `krabbels`
--

CREATE TABLE `krabbels` (
  `id` int(11) NOT NULL,
  `uid_to` int(11) NOT NULL,
  `uid_from` int(11) NOT NULL,
  `bericht` text NOT NULL,
  `date` datetime NOT NULL,
  `trash` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `mailbox`
--

CREATE TABLE `mailbox` (
  `id` int(11) NOT NULL,
  `uid_from` int(11) NOT NULL,
  `name_from` varchar(255) NOT NULL,
  `uid_to` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `bericht` text NOT NULL,
  `date` datetime NOT NULL,
  `gelezen` tinyint(1) NOT NULL DEFAULT 0,
  `trash` tinyint(1) NOT NULL DEFAULT 0,
  `categorie` enum('1','2','3','4') NOT NULL,
  `important` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `mailbox`
--

INSERT INTO `mailbox` (`id`, `uid_from`, `name_from`, `uid_to`, `title`, `bericht`, `date`, `gelezen`, `trash`, `categorie`, `important`) VALUES
(822, 68, 'Marco', 68, 'test', '<p><br></p>', '2019-09-17 13:24:38', 1, 1, '1', 0),
(823, 0, 'Instructeur', 68, 'TTEST', '<p>T</p>', '2019-09-17 13:24:59', 1, 1, '2', 0),
(824, 0, 'Instructeur', 68, 'Training aanvraag: TEst', 'Jaaaa Aangenomen', '2019-09-17 13:29:00', 1, 1, '2', 1),
(821, 0, 'Leiding', 68, 'test', '<p><br></p>', '2019-09-17 13:24:21', 1, 1, '3', 0),
(820, 68, 'Marco', 68, 'hoi', '<p><br></p>', '2019-09-17 13:23:38', 1, 1, '1', 0),
(819, 68, 'Marco', 68, 'test', '<p><br></p>', '2019-09-17 13:10:10', 1, 1, '1', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `made_by` varchar(255) NOT NULL DEFAULT 'Administrator',
  `titel` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `label` varchar(20) NOT NULL DEFAULT 'algemeen'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `playerlog`
--

CREATE TABLE `playerlog` (
  `id` int(11) NOT NULL,
  `steamid` varchar(255) DEFAULT NULL,
  `steamname` varchar(255) DEFAULT NULL,
  `rank` varchar(200) DEFAULT NULL,
  `whitelisted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `playerlog`
--

INSERT INTO `playerlog` (`id`, `steamid`, `steamname`, `rank`, `whitelisted`) VALUES
(8, 'steam:11000011336e38f', 'DoJoMan18', 'bestuur', 1),
(9, 'steam:11000011711d772', 'Aaron W.', NULL, 1),
(10, 'steam:110000106cc1f01', 'Marco7541', NULL, 1),
(11, 'steam:11000010C3F4C3A', 'Cor', NULL, 1),
(12, 'steam:11000011573C711', 'GamenMetIvo', NULL, 1),
(13, 'steam:110000110E9FF6E', 'Willem en Myron', NULL, 1),
(14, 'steam:11000011C0A58B3', 'Yven', NULL, 1),
(15, 'steam:110000108E4F105', 'DutchJordy', NULL, 1),
(16, 'steam:11000010D8F7D37', 'Frank', NULL, 0),
(17, 'steam:11000010B69CC15', 'Semff9', NULL, 1),
(18, 'steam:11000011CAB2BF1', 'Brian', NULL, 1),
(19, 'steam:110000107576A1E', 'larode3434', NULL, 1),
(20, 'steam:110000116ADDA46', 'BelgianDog (DavyYeet)', NULL, 1),
(21, 'steam:11000010D3BBC0B', 'GonGon', NULL, 1),
(23, 'steam:11000010be8cb62', 'Brian K. 11th AMB', NULL, 1),
(25, 'steam:1100001121d8d8b', 'nick.lammen', NULL, 1),
(26, 'license:854753a3fdb30450a928d8d1fbfd513c4aac6124', 'davym', NULL, 0),
(27, 'license:f8fe69d55e6019abbd19c7d064f8aa74e8636fda', 'Gebruiker', NULL, 0),
(28, 'steam:1100001184a5975', '[G-17] WillemBos', NULL, 0),
(29, 'steam:11000011be56497', 'Ole', NULL, 0),
(30, 'steam:11000013404e817', 'davey W.', NULL, 1),
(31, 'steam:11000011965b72a', 'C_The_Unsees', NULL, 0),
(32, 'license:96f5de8eb0d45b81db10547c9944e3b639a339e7', 'pante', NULL, 0),
(33, 'steam:110000114b4f743', 'Ivar', NULL, 0),
(34, 'steam:11000010adb0583', 'vitalbullit', NULL, 1),
(35, 'license:c6954d24c82fb34f8c577cb46d45da53ca1b0e76', 'karst', NULL, 0),
(36, 'steam:1100001338c7299', 'GameDoos', NULL, 1),
(37, 'steam:11000010a330d9a', 'Dr. Jumbled', NULL, 0),
(38, 'steam:11000010b036e82', 'Belastingdienst', NULL, 0),
(39, 'steam:110000117e03e6f', 'David', NULL, 1),
(40, 'steam:110000100e26bbc', '[21-01] Willem B.', NULL, 1),
(41, 'steam:11000013405dc28', 'joppenijs', NULL, 0),
(42, 'steam:11000011d63bf2e', 'ItsDaan', NULL, 0),
(43, 'steam:11000013594d1c6', 'emiel989', NULL, 0),
(44, 'steam:1100001129df2ab', 'AudiFan', NULL, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ranks`
--

CREATE TABLE `ranks` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `instructeur` enum('0','1') NOT NULL DEFAULT '0',
  `leiding` enum('0','1') NOT NULL DEFAULT '0',
  `nh` enum('0','1') NOT NULL DEFAULT '0',
  `brw` enum('0','1') NOT NULL DEFAULT '0',
  `ambu` enum('0','1') NOT NULL DEFAULT '0',
  `mk` enum('0','1') NOT NULL DEFAULT '0',
  `vertrouwenspersoon` enum('0','1') NOT NULL DEFAULT '0',
  `Kmar` enum('0','1') NOT NULL DEFAULT '0',
  `systeem` enum('0','1') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `ranks`
--

INSERT INTO `ranks` (`id`, `naam`, `instructeur`, `leiding`, `nh`, `brw`, `ambu`, `mk`, `vertrouwenspersoon`, `Kmar`, `systeem`) VALUES
(1, 'Lid', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(2, 'Politie Instructeur', '1', '0', '1', '0', '0', '0', '0', '0', '0'),
(3, 'Kmar instructeur', '1', '0', '0', '0', '0', '0', '0', '1', '0'),
(4, 'Brandweer Instructeur', '1', '0', '0', '1', '0', '0', '0', '0', '0'),
(5, 'Ambulance Instructeur', '1', '0', '0', '0', '1', '0', '0', '0', '0'),
(6, 'Meldkamer Instructeur', '1', '0', '0', '0', '0', '1', '0', '0', '0'),
(7, 'Leidinggevende', '1', '1', '1', '1', '1', '1', '0', '1', '0'),
(15, 'Systeembeheer', '1', '1', '1', '1', '1', '1', '1', '1', '1'),
(16, 'Vertrouwenspersoon', '1', '1', '1', '1', '1', '1', '1', '1', '0');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `recovery_keys`
--

CREATE TABLE `recovery_keys` (
  `rid` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `valid` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rules`
--

CREATE TABLE `rules` (
  `RuleID` int(11) UNSIGNED NOT NULL,
  `Leveltype` enum('user','group') NOT NULL DEFAULT 'group',
  `LevelID` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `Actionkind` enum('admin','me','users','paginabeheer','nieuws','evenementen','reviews','twitter') NOT NULL,
  `ActionID` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `view` set('1','0') DEFAULT NULL,
  `move` set('1','0') DEFAULT NULL,
  `del` set('1','0') DEFAULT NULL,
  `make` set('1','0') DEFAULT NULL,
  `edit` set('1','0') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `specialisaties`
--

CREATE TABLE `specialisaties` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `afdeling` enum('noodhulp','ambulance','brandweer','meldkamer') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `specialisaties`
--

INSERT INTO `specialisaties` (`id`, `naam`, `afdeling`) VALUES
(1, 'Verkeerspolitie', 'noodhulp'),
(2, 'Motorpolitie', 'noodhulp'),
(3, 'Luchtvaartpolitie', 'noodhulp'),
(4, 'Arrestatie Team', 'noodhulp'),
(5, 'Unmarked', 'noodhulp'),
(6, 'Hondengeleider', 'noodhulp'),
(7, 'OVD-P', 'noodhulp'),
(8, 'Rapid Responder', 'ambulance'),
(9, 'Motor Ambulance', 'ambulance'),
(10, 'Lifeliner', 'ambulance'),
(11, 'MICU', 'ambulance'),
(12, 'OVDG', 'ambulance'),
(13, 'First Responder', 'brandweer'),
(14, 'Brandweer Duiker', 'brandweer'),
(15, 'Brandweer STH', 'brandweer'),
(16, 'OVDB', 'brandweer'),
(17, 'HB', 'meldkamer'),
(18, 'AC', 'meldkamer'),
(19, 'OC', 'meldkamer'),
(20, 'Politie IBT', 'noodhulp'),
(21, 'Meldkamer IBT', 'meldkamer'),
(22, 'Brandweer IBT', 'brandweer'),
(23, 'Ambulance IBT', 'ambulance');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `specialisaties_gekoppeld`
--

CREATE TABLE `specialisaties_gekoppeld` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `specialisaties_gekoppeld`
--

INSERT INTO `specialisaties_gekoppeld` (`id`, `uid`, `sid`) VALUES
(122, 386, 7),
(119, 386, 2),
(126, 398, 2),
(132, 402, 1),
(121, 386, 4),
(120, 386, 3),
(127, 377, 3),
(128, 377, 20),
(131, 396, 7),
(133, 402, 2),
(134, 402, 3),
(135, 402, 4),
(136, 402, 5),
(137, 402, 6),
(138, 402, 7),
(139, 402, 20),
(140, 408, 2),
(141, 416, 1),
(142, 416, 3),
(158, 430, 7),
(157, 430, 5),
(156, 430, 4),
(155, 430, 3),
(154, 430, 2),
(153, 430, 1),
(149, 427, 1),
(150, 427, 5),
(151, 419, 1),
(152, 419, 3),
(159, 430, 20),
(160, 417, 1),
(161, 417, 2),
(162, 417, 3),
(163, 417, 4),
(164, 417, 5),
(165, 417, 6),
(166, 417, 7),
(167, 417, 20),
(175, 421, 23),
(174, 421, 12),
(173, 421, 10),
(172, 421, 8);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `timeline`
--

CREATE TABLE `timeline` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `bericht` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `trainingen`
--

CREATE TABLE `trainingen` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `uitleg` text NOT NULL,
  `eenheid` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL COMMENT 'form',
  `password` varchar(255) NOT NULL COMMENT 'form',
  `salt` varchar(255) NOT NULL COMMENT 'form',
  `email` varchar(255) NOT NULL COMMENT 'form',
  `eenheid` varchar(255) NOT NULL COMMENT 'form',
  `overmijzelf` varchar(1000) NOT NULL DEFAULT 'Ik heb hier niks ingevult!',
  `avatar` varchar(255) NOT NULL DEFAULT 'https://www.ibts.org/wp-content/uploads/2017/08/iStock-476085198.jpg',
  `naam` varchar(255) NOT NULL COMMENT 'form',
  `achternaam` varchar(255) NOT NULL COMMENT 'form',
  `teamspeak` varchar(255) NOT NULL COMMENT 'form',
  `roepnummer` varchar(255) NOT NULL COMMENT 'form',
  `ingewerkt` tinyint(1) NOT NULL DEFAULT 0,
  `rang` varchar(255) DEFAULT NULL,
  `bewijzen` varchar(255) DEFAULT NULL,
  `inactief` tinyint(1) NOT NULL DEFAULT 0,
  `vrijwilliger` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0,1,2,3,4,5',
  `opgesprek` tinyint(1) NOT NULL DEFAULT 0,
  `gfwl` varchar(255) DEFAULT NULL,
  `reserve_centralist` tinyint(1) NOT NULL DEFAULT 0,
  `i_opmerking` text DEFAULT NULL,
  `l_opmerking` text DEFAULT NULL,
  `v_opmerkingen` text DEFAULT NULL,
  `vertrouw_gesprek` tinyint(1) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`, `eenheid`, `overmijzelf`, `avatar`, `naam`, `achternaam`, `teamspeak`, `roepnummer`, `ingewerkt`, `rang`, `bewijzen`, `inactief`, `vrijwilliger`, `opgesprek`, `gfwl`, `reserve_centralist`, `i_opmerking`, `l_opmerking`, `v_opmerkingen`, `vertrouw_gesprek`) VALUES
(460, 'Marco', '7UkP4XxwjffrY', '7UV^UEO@', 'marco_jong@outlook.com', 'noodhulp', 'Ik heb hier niks ingevult!', 'https://www.ibts.org/wp-content/uploads/2017/08/iStock-476085198.jpg', 'marco', 'Jong', '-', '21-06', 0, NULL, NULL, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_permission`
--

CREATE TABLE `user_permission` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `instructeur` enum('0','1') NOT NULL,
  `leiding` enum('0','1') NOT NULL,
  `nh` enum('0','1') NOT NULL,
  `brw` enum('0','1') NOT NULL,
  `ambu` enum('0','1') NOT NULL,
  `mk` enum('0','1') NOT NULL,
  `vertrouwenspersoon` enum('0','1') NOT NULL,
  `vp` enum('0','1') NOT NULL,
  `systeem` enum('0','1') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user_permission`
--

INSERT INTO `user_permission` (`id`, `uid`, `instructeur`, `leiding`, `nh`, `brw`, `ambu`, `mk`, `vertrouwenspersoon`, `vp`, `systeem`) VALUES
(1, 1, '1', '1', '1', '1', '1', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_rank`
--

CREATE TABLE `user_rank` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user_rank`
--

INSERT INTO `user_rank` (`id`, `uid`, `rank_id`) VALUES
(313, 386, 15),
(315, 388, 1),
(310, 377, 15),
(1, 68, 15),
(316, 392, 1),
(317, 393, 1),
(318, 394, 1),
(319, 395, 1),
(320, 395, 7),
(321, 396, 1),
(322, 397, 1),
(323, 398, 1),
(324, 399, 1),
(325, 400, 1),
(326, 401, 1),
(333, 405, 1),
(334, 406, 1),
(329, 402, 1),
(330, 403, 1),
(331, 402, 2),
(332, 404, 1),
(335, 407, 1),
(336, 408, 1),
(337, 409, 1),
(338, 410, 1),
(339, 411, 1),
(340, 412, 1),
(341, 413, 1),
(342, 414, 1),
(343, 414, 15),
(344, 415, 1),
(345, 415, 15),
(346, 416, 1),
(347, 416, 15),
(348, 417, 1),
(349, 417, 15),
(350, 418, 1),
(351, 418, 15),
(352, 417, 1),
(353, 417, 15),
(354, 417, 1),
(355, 417, 15),
(356, 419, 1),
(357, 420, 1),
(358, 421, 1),
(359, 422, 1),
(360, 423, 1),
(361, 424, 1),
(362, 425, 1),
(363, 425, 7),
(364, 426, 1),
(365, 427, 1),
(366, 428, 1),
(367, 429, 1),
(368, 425, 1),
(369, 430, 1),
(370, 430, 7),
(371, 431, 1),
(372, 432, 1),
(373, 433, 1),
(374, 434, 1),
(375, 435, 1),
(376, 436, 1),
(377, 437, 1),
(378, 438, 1),
(379, 439, 1),
(380, 440, 1),
(381, 441, 1),
(382, 442, 1),
(383, 443, 1),
(384, 444, 1),
(385, 445, 1),
(386, 446, 1),
(387, 447, 1),
(388, 448, 1),
(389, 449, 1),
(390, 421, 7),
(391, 450, 1),
(392, 451, 1),
(393, 452, 1),
(394, 453, 1),
(395, 454, 1),
(396, 455, 1),
(397, 456, 1),
(398, 457, 1),
(399, 458, 1),
(400, 459, 1),
(401, 460, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `vacatures`
--

CREATE TABLE `vacatures` (
  `id` int(11) NOT NULL,
  `titel` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `vacature_reactie`
--

CREATE TABLE `vacature_reactie` (
  `id` int(11) NOT NULL,
  `vacature` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `reactie` text NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `vertrouw_problemen`
--

CREATE TABLE `vertrouw_problemen` (
  `id` int(11) NOT NULL,
  `p1` int(11) NOT NULL,
  `p1verklaring` text NOT NULL,
  `p2` int(11) NOT NULL,
  `p2verklaring` text NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `aanmeldingen`
--
ALTER TABLE `aanmeldingen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `agenda_aanwezig`
--
ALTER TABLE `agenda_aanwezig`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `agenda_berichten`
--
ALTER TABLE `agenda_berichten`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `agenda_leden`
--
ALTER TABLE `agenda_leden`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `cijfers`
--
ALTER TABLE `cijfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexen voor tabel `contact_in`
--
ALTER TABLE `contact_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `contact_leiding`
--
ALTER TABLE `contact_leiding`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `extern_contact`
--
ALTER TABLE `extern_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `formalgemeen`
--
ALTER TABLE `formalgemeen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `formclanpack`
--
ALTER TABLE `formclanpack`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `formgegevens`
--
ALTER TABLE `formgegevens`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `formklachten`
--
ALTER TABLE `formklachten`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `formpromotie`
--
ALTER TABLE `formpromotie`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `formtraining`
--
ALTER TABLE `formtraining`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `formvakantie`
--
ALTER TABLE `formvakantie`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gms_aanwezigheid`
--
ALTER TABLE `gms_aanwezigheid`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gms_datums`
--
ALTER TABLE `gms_datums`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gms_eenheden`
--
ALTER TABLE `gms_eenheden`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gms_eenheid_log`
--
ALTER TABLE `gms_eenheid_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gms_incidentgroepen`
--
ALTER TABLE `gms_incidentgroepen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gms_ingemeld`
--
ALTER TABLE `gms_ingemeld`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gms_log`
--
ALTER TABLE `gms_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gms_meldingen`
--
ALTER TABLE `gms_meldingen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gms_melding_aantekening`
--
ALTER TABLE `gms_melding_aantekening`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gms_melding_koppel`
--
ALTER TABLE `gms_melding_koppel`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gms_opmerkingen`
--
ALTER TABLE `gms_opmerkingen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `krabbels`
--
ALTER TABLE `krabbels`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `mailbox`
--
ALTER TABLE `mailbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `playerlog`
--
ALTER TABLE `playerlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `recovery_keys`
--
ALTER TABLE `recovery_keys`
  ADD PRIMARY KEY (`rid`);

--
-- Indexen voor tabel `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`RuleID`);

--
-- Indexen voor tabel `specialisaties`
--
ALTER TABLE `specialisaties`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `specialisaties_gekoppeld`
--
ALTER TABLE `specialisaties_gekoppeld`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `trainingen`
--
ALTER TABLE `trainingen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user_permission`
--
ALTER TABLE `user_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user_rank`
--
ALTER TABLE `user_rank`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `vacatures`
--
ALTER TABLE `vacatures`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `vacature_reactie`
--
ALTER TABLE `vacature_reactie`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `vertrouw_problemen`
--
ALTER TABLE `vertrouw_problemen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `aanmeldingen`
--
ALTER TABLE `aanmeldingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1258;

--
-- AUTO_INCREMENT voor een tabel `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT voor een tabel `agenda_aanwezig`
--
ALTER TABLE `agenda_aanwezig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT voor een tabel `agenda_berichten`
--
ALTER TABLE `agenda_berichten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `agenda_leden`
--
ALTER TABLE `agenda_leden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `cijfers`
--
ALTER TABLE `cijfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT voor een tabel `contact_in`
--
ALTER TABLE `contact_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT voor een tabel `contact_leiding`
--
ALTER TABLE `contact_leiding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `extern_contact`
--
ALTER TABLE `extern_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `formalgemeen`
--
ALTER TABLE `formalgemeen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `formclanpack`
--
ALTER TABLE `formclanpack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `formgegevens`
--
ALTER TABLE `formgegevens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `formklachten`
--
ALTER TABLE `formklachten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `formpromotie`
--
ALTER TABLE `formpromotie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `formtraining`
--
ALTER TABLE `formtraining`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT voor een tabel `formvakantie`
--
ALTER TABLE `formvakantie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `gms_aanwezigheid`
--
ALTER TABLE `gms_aanwezigheid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1081;

--
-- AUTO_INCREMENT voor een tabel `gms_datums`
--
ALTER TABLE `gms_datums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `gms_eenheden`
--
ALTER TABLE `gms_eenheden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT voor een tabel `gms_eenheid_log`
--
ALTER TABLE `gms_eenheid_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `gms_incidentgroepen`
--
ALTER TABLE `gms_incidentgroepen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- AUTO_INCREMENT voor een tabel `gms_ingemeld`
--
ALTER TABLE `gms_ingemeld`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `gms_log`
--
ALTER TABLE `gms_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `gms_meldingen`
--
ALTER TABLE `gms_meldingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `gms_melding_aantekening`
--
ALTER TABLE `gms_melding_aantekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `gms_melding_koppel`
--
ALTER TABLE `gms_melding_koppel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `gms_opmerkingen`
--
ALTER TABLE `gms_opmerkingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `krabbels`
--
ALTER TABLE `krabbels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `mailbox`
--
ALTER TABLE `mailbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=825;

--
-- AUTO_INCREMENT voor een tabel `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `playerlog`
--
ALTER TABLE `playerlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT voor een tabel `ranks`
--
ALTER TABLE `ranks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT voor een tabel `recovery_keys`
--
ALTER TABLE `recovery_keys`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT voor een tabel `rules`
--
ALTER TABLE `rules`
  MODIFY `RuleID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `specialisaties`
--
ALTER TABLE `specialisaties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT voor een tabel `specialisaties_gekoppeld`
--
ALTER TABLE `specialisaties_gekoppeld`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT voor een tabel `timeline`
--
ALTER TABLE `timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `trainingen`
--
ALTER TABLE `trainingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=461;

--
-- AUTO_INCREMENT voor een tabel `user_permission`
--
ALTER TABLE `user_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `user_rank`
--
ALTER TABLE `user_rank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=402;

--
-- AUTO_INCREMENT voor een tabel `vacatures`
--
ALTER TABLE `vacatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `vacature_reactie`
--
ALTER TABLE `vacature_reactie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT voor een tabel `vertrouw_problemen`
--
ALTER TABLE `vertrouw_problemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
