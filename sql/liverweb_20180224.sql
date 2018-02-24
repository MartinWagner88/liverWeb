-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 24. Feb 2018 um 22:27
-- Server-Version: 10.1.26-MariaDB
-- PHP-Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `liverweb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adresse`
--

CREATE TABLE `adresse` (
  `idAdresse` int(11) NOT NULL,
  `plz` int(11) DEFAULT NULL,
  `strasse` tinytext,
  `hausnummer` int(11) DEFAULT NULL,
  `stammdaten_idstammdaten` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `benutzer_name` varchar(20) NOT NULL,
  `benutzer_passwort` varchar(20) NOT NULL,
  `benutzer_id` int(11) NOT NULL,
  `vorname` varchar(25) NOT NULL,
  `nachname` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`benutzer_name`, `benutzer_passwort`, `benutzer_id`, `vorname`, `nachname`) VALUES
('vetterml', 'internist', 1, 'Marcel', 'Vetter'),
('wagnermn', 'chirurg', 2, 'Martin', 'Wagner');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bericht`
--

CREATE TABLE `bericht` (
  `idbericht` int(11) NOT NULL,
  `datum` datetime DEFAULT NULL,
  `arzt` varchar(45) DEFAULT NULL,
  `beratungsanlass` varchar(45) DEFAULT NULL,
  `kommentar` varchar(5000) DEFAULT NULL,
  `auto_text` varchar(5000) DEFAULT NULL,
  `stammdaten_idstammdaten` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `bericht`
--

INSERT INTO `bericht` (`idbericht`, `datum`, `arzt`, `beratungsanlass`, `kommentar`, `auto_text`, `stammdaten_idstammdaten`) VALUES
(24, '2017-11-04 11:04:30', 'Dr. Wagner', NULL, '', NULL, 16),
(25, '2017-11-04 11:11:43', 'Dr. Wagner', NULL, '', NULL, 16),
(26, '2017-11-04 11:12:41', 'Dr. Wagner', NULL, 'Es funktioniert', NULL, 16),
(27, '2017-11-04 11:15:57', 'Dr. Wagner', NULL, 'Erfolgreicher Verlauf', NULL, 16),
(28, '2017-11-04 11:25:10', 'Dr. Wagner', NULL, 'Jetz in neuem Format', NULL, 16),
(29, '2017-11-04 11:42:27', 'Dr. Wagner', NULL, 'Diese Klinik ist toll', NULL, 16),
(30, '2017-11-04 11:45:38', 'Dr. Vetter', NULL, 'aber Erlangen ist besser ;-)', NULL, 16),
(31, '2017-11-04 11:47:05', 'Dr. Wagner', NULL, 'lÃ¤uft', NULL, 16),
(32, '2017-11-04 11:48:34', 'Dr. Wagner', NULL, '', NULL, 16),
(33, '2017-11-04 11:49:12', 'Dr. Wagner', NULL, '', NULL, 16),
(34, '2017-11-04 11:50:11', 'Dr. Wagner', NULL, '', NULL, 16),
(35, '2017-11-04 11:50:43', 'Dr. Wagner', NULL, '', NULL, 16),
(36, '2017-11-04 11:52:01', 'Dr. Wagner', NULL, 'jetzt abetr', NULL, 16),
(37, '2017-11-04 11:55:29', 'Dr. Wagner', NULL, 'Wir sind die Besten!', NULL, 16),
(38, '2017-11-04 11:57:56', 'Dr. Wagner', NULL, 'Gedankenstrich', NULL, 16),
(39, '2017-11-04 11:58:29', 'Dr. Wagner', NULL, 'zu breit?', NULL, 16),
(40, '2017-11-04 12:01:17', 'Dr. Wagner', NULL, 'final', NULL, 16),
(41, '2017-11-05 23:16:40', 'Dr. Wagner', NULL, '', NULL, 16),
(42, '2017-11-05 23:19:02', 'Dr. Wagner', NULL, '', NULL, 16),
(43, '2017-11-05 23:19:52', 'Dr. Wagner', NULL, 'test-layout', NULL, 16),
(44, '2017-11-05 23:21:07', 'Dr. Wagner', NULL, '', NULL, 16),
(45, '2017-11-05 23:36:28', '', NULL, '', NULL, 0),
(46, '2017-11-05 23:36:53', 'Dr. Wagner', NULL, 'na?', NULL, 16),
(47, '2017-11-05 23:38:09', 'Dr. Wagner', NULL, 'jetzt', NULL, 16),
(48, '2017-11-05 23:41:47', 'Dr. Wagner', NULL, '', NULL, 16),
(49, '2017-11-05 23:45:58', 'Dr. Wagner', NULL, 'und?', NULL, 16),
(50, '2017-11-05 23:52:39', 'Dr. Wagner', NULL, 'jetzt verbunden', NULL, 16),
(51, '2017-11-05 23:56:12', 'Dr. Wagner', NULL, 'jetztat aber', NULL, 16),
(52, '2017-11-06 00:00:26', 'Dr. Vetter', NULL, 'Jetzt funktioniert es garantiert', NULL, 16),
(53, '2017-11-06 00:04:56', 'Dr. Wagner', NULL, '', NULL, 16),
(54, '2017-11-06 00:05:47', 'Dr. Wagner', NULL, '', NULL, 16),
(55, '2017-11-06 00:10:28', 'Dr. Vetter', NULL, '', NULL, 16),
(56, '2017-11-06 00:16:37', 'Dr. Wagner', NULL, '', NULL, 16),
(57, '2017-11-06 00:18:15', 'Dr. Wagner', NULL, 'test', NULL, 16),
(58, '2017-11-06 00:21:40', 'Dr. Vetter', NULL, 'Reihenfolge', NULL, 16),
(59, '2017-11-06 00:22:12', 'Dr. Vetter', NULL, 'Reihenfolge', NULL, 16),
(60, '2017-11-06 22:39:36', 'Dr. Vetter', NULL, 'Kontrolle', NULL, 16),
(61, '2017-11-06 22:47:51', 'Dr. Vetter', NULL, 'Kontrolle!', NULL, 16),
(62, '2017-11-12 23:47:08', '', NULL, '', NULL, 0),
(63, '2017-11-12 23:47:29', 'Dr. Vetter', NULL, 'Test', NULL, 16),
(64, '2017-12-25 14:42:58', 'Dr. Vetter', NULL, 'alles gut', NULL, 0),
(65, '2017-12-25 15:26:26', '', NULL, '', NULL, 0),
(66, '2017-12-25 15:29:16', 'Dr. Vetter', NULL, 'Die Patientin befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 45 kg und ist somit stabil. Die Patientin berichtet von Pruritus (IntensitÃ¤t:  4/10). Es liegt eine hochgradige hepatische Enzephalopathie vor. Die Patientin Eine gastrointestinale Blutung beobachtete der Patient zuletzt nicht. Der Child-Pugh-Score betrÃ¤gt 12 Punkte und der MELD-Score 48 Punkte. Wir empfehlen eine Wiedervorstellung in 45 Monate(n).', NULL, 16),
(67, '2017-12-25 15:30:18', 'Dr. Vetter', NULL, 'Die Patientin befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 45 kg und ist somit stabil. Die Patientin berichtet von Pruritus (IntensitÃ¤t:  4/10). Es liegt eine hochgradige hepatische Enzephalopathie vor. Die Patientin Eine gastrointestinale Blutung beobachtete der Patient zuletzt nicht. Der Child-Pugh-Score betrÃ¤gt 12 Punkte und der MELD-Score 48 Punkte. Wir empfehlen eine Wiedervorstellung in 45 Monate(n).', NULL, 16),
(68, '2017-12-25 15:39:05', 'Dr. Vetter', NULL, 'Der Patient befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 78 kg und ist somit steigend. Der Patient berichtet von Pruritus (IntensitÃ¤t:  4/10). Es liegt eine leichtgradige hepatische Enzephalopathie vor. Der Patient verneinte das Vorliegen einer gastrointestinalen Blutung. Der Child-Pugh-Score betrÃ¤gt 11 Punkte und der MELD-Score 68 Punkte. Wir empfehlen eine Wiedervorstellung in 80 Monate(n).', NULL, 16),
(69, '2017-12-25 15:58:57', 'Dr. Vetter', NULL, 'Die Patientin befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 45 kg und ist somit stabil. Die Patientin berichtet von Pruritus (IntensitÃ¤t:  4/10). Es liegt eine hochgradige hepatische Enzephalopathie vor. Die Patientin verneinte das Vorliegen einer gastrointestinalen Blutung	. Der Child-Pugh-Score betrÃ¤gt 9 Punkte und der MELD-Score 22 Punkte. Wir empfehlen eine Wiedervorstellung in 89 Monate(n).', NULL, 16),
(70, '2017-12-25 15:59:28', 'Dr. Vetter', NULL, 'Die Patientin befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 45 kg und ist somit stabil. Die Patientin berichtet von Pruritus (IntensitÃ¤t:  4/10). Es liegt eine hochgradige hepatische Enzephalopathie vor. Die Patientin verneinte das Vorliegen einer gastrointestinalen Blutung	. Der Child-Pugh-Score betrÃ¤gt 9 Punkte und der MELD-Score 22 Punkte. Wir empfehlen eine Wiedervorstellung in 89 Monate(n).', NULL, 16),
(71, '2017-12-25 15:59:32', 'Dr. Vetter', NULL, 'Die Patientin befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 45 kg und ist somit stabil. Die Patientin berichtet von Pruritus (IntensitÃ¤t:  4/10). Es liegt eine hochgradige hepatische Enzephalopathie vor. Die Patientin verneinte das Vorliegen einer gastrointestinalen Blutung	. Der Child-Pugh-Score betrÃ¤gt 9 Punkte und der MELD-Score 22 Punkte. Wir empfehlen eine Wiedervorstellung in 89 Monate(n).', NULL, 16),
(72, '2017-12-25 16:03:05', 'Dr. Vetter', NULL, 'Die Patientin befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 45 kg und ist somit stabil. Die Patientin berichtet von Pruritus (IntensitÃ¤t:  4/10). Es liegt eine hochgradige hepatische Enzephalopathie vor. Die Patientin verneinte das Vorliegen einer gastrointestinalen Blutung	. Der Child-Pugh-Score betrÃ¤gt 9 Punkte und der MELD-Score 22 Punkte. Wir empfehlen eine Wiedervorstellung in 89 Monate(n).', NULL, 16),
(73, '2017-12-25 16:08:05', 'Dr. Vetter', NULL, 'Die Patientin befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 45 kg und ist somit stabil. Die Patientin berichtet von Pruritus (IntensitÃ¤t:  4/10). Es liegt eine hochgradige hepatische Enzephalopathie vor. Die Patientin verneinte das Vorliegen einer gastrointestinalen Blutung	. Der Child-Pugh-Score betrÃ¤gt 9 Punkte und der MELD-Score 22 Punkte. Wir empfehlen eine Wiedervorstellung in 89 Monate(n).', NULL, 16),
(74, '2017-12-25 16:08:10', 'Dr. Vetter', NULL, 'Die Patientin befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 45 kg und ist somit stabil. Die Patientin berichtet von Pruritus (IntensitÃ¤t:  4/10). Es liegt eine hochgradige hepatische Enzephalopathie vor. Die Patientin verneinte das Vorliegen einer gastrointestinalen Blutung	. Der Child-Pugh-Score betrÃ¤gt 9 Punkte und der MELD-Score 22 Punkte. Wir empfehlen eine Wiedervorstellung in 89 Monate(n).', NULL, 16),
(75, '2017-12-25 16:08:59', 'Dr. Vetter', NULL, '', NULL, 16),
(76, '2017-12-25 16:09:36', 'Dr. Vetter', NULL, 'Der Patient befindet sich in einem gutem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 45 kg und ist somit stabil. Der Patient berichtet von Pruritus (IntensitÃ¤t:  4/10). Es liegt eine leichtgradige hepatische Enzephalopathie vor. Der Patient berichtet von HÃ¤matemesis. Der Child-Pugh-Score betrÃ¤gt 10 Punkte und der MELD-Score 30 Punkte. Wir empfehlen eine Wiedervorstellung in 12 Monate(n).', NULL, 16),
(77, '2017-12-25 16:10:03', 'Dr. Vetter', NULL, 'Der Patient befindet sich in einem gutem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 45 kg und ist somit stabil. Der Patient berichtet von Pruritus (IntensitÃ¤t:  4/10). Es liegt eine leichtgradige hepatische Enzephalopathie vor. Der Patient berichtet von HÃ¤matemesis. Der Child-Pugh-Score betrÃ¤gt 10 Punkte und der MELD-Score 30 Punkte. Wir empfehlen eine Wiedervorstellung in 12 Monate(n).', NULL, 16),
(78, '2017-12-25 16:13:17', 'Dr. Vetter', NULL, 'Die Patientin befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 45 kg und ist somit stabil. Die Patientin berichtet von Pruritus (IntensitÃ¤t:  4/10). Es liegt eine hochgradige hepatische Enzephalopathie vor. Die Patientin berichtet von HÃ¤matemesis. Der Child-Pugh-Score betrÃ¤gt 11 Punkte und der MELD-Score 33 Punkte. Wir empfehlen eine Wiedervorstellung in 78 Monate(n).', NULL, 16),
(79, '2017-12-25 16:18:05', 'Dr. Vetter', NULL, 'Die Patientin befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 45 kg und ist somit stabil. Die Patientin berichtet von Pruritus (IntensitÃ¤t:  4/10). Es liegt eine hochgradige hepatische Enzephalopathie vor. Die Patientin berichtet von HÃ¤matemesis. Der Child-Pugh-Score betrÃ¤gt 11 Punkte und der MELD-Score 33 Punkte. Wir empfehlen eine Wiedervorstellung in 78 Monate(n).', NULL, 16),
(80, '2017-12-25 16:18:31', 'Dr. Vetter', NULL, 'Die Patientin befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 45 kg und ist somit stabil. Die Patientin berichtet von Pruritus (IntensitÃ¤t:  4/10). Es liegt eine hochgradige hepatische Enzephalopathie vor. Die Patientin berichtet von HÃ¤matemesis. Der Child-Pugh-Score betrÃ¤gt 11 Punkte und der MELD-Score 33 Punkte. Wir empfehlen eine Wiedervorstellung in 78 Monate(n).', NULL, 16),
(81, '2017-12-25 16:21:20', 'Dr. Vetter', NULL, 'Die Patientin befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 45 kg und ist somit stabil. Die Patientin berichtet von Pruritus (IntensitÃ¤t:  3/10). Es liegt eine hochgradige hepatische Enzephalopathie vor. Die Patientin berichtet von Teerstuhl. Der Child-Pugh-Score betrÃ¤gt 11 Punkte und der MELD-Score 35 Punkte. Wir empfehlen eine Wiedervorstellung in 78 Monate(n).', NULL, 16),
(82, '2017-12-25 17:01:25', 'Dr. Vetter', NULL, 'Die Patientin befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 67 kg und ist somit stabil. Die Patientin berichtet von Pruritus (IntensitÃ¤t:  3/10). Es liegt eine leichtgradige hepatische Enzephalopathie vor. Die Patientin berichtet von Teerstuhl. Der Child-Pugh-Score betrÃ¤gt 11 Punkte und der MELD-Score 42 Punkte. Wir empfehlen eine Wiedervorstellung in 45 Monate(n).', NULL, 16),
(83, '2017-12-25 17:14:44', 'Dr. Vetter', NULL, 'Die Patientin befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 78 kg und ist somit steigend. Die Patientin berichtet von Pruritus (IntensitÃ¤t:  4/10). Es liegt eine leichtgradige hepatische Enzephalopathie vor. Die Patientin berichtet von HÃ¤matemesis und Teerstuhl. Der Child-Pugh-Score betrÃ¤gt 10 Punkte und der MELD-Score 31 Punkte. Wir empfehlen eine Wiedervorstellung in 78 Monate(n).', NULL, 16),
(84, '2017-12-25 17:18:10', 'Dr. Vetter', NULL, 'Der Patient befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 45 kg und ist somit stabil. Der Patient berichtet von Pruritus (IntensitÃ¤t:  3/10). Es liegt eine hochgradige hepatische Enzephalopathie vor. Der Patient berichtet von HÃ¤matemesis und Teerstuhl. Der Child-Pugh-Score betrÃ¤gt 12 Punkte und der MELD-Score 48 Punkte. Wir empfehlen eine Wiedervorstellung in 12 Monate(n).', NULL, 16),
(85, '2017-12-25 17:19:15', 'Dr. Vetter', NULL, 'Der Patient befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 45 kg und ist somit stabil. Der Patient berichtet von Pruritus (IntensitÃ¤t:  3/10). Es liegt eine hochgradige hepatische Enzephalopathie vor. Der Patient berichtet von HÃ¤matemesis und Teerstuhl. Der Child-Pugh-Score betrÃ¤gt 12 Punkte und der MELD-Score 48 Punkte. Wir empfehlen eine Wiedervorstellung in 12 Monate(n).', NULL, 16),
(86, '2017-12-25 17:30:33', 'Dr. Vetter', NULL, 'Die Patientin befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 45 kg und ist somit stabil. Die Patientin berichtet von Pruritus (IntensitÃ¤t:  3/10). Es liegt eine leichtgradige hepatische Enzephalopathie vor. Die Patientin verneinte das Vorliegen einer gastrointestinalen Blutung	. Der Child-Pugh-Score betrÃ¤gt 11 Punkte und der MELD-Score 40 Punkte. Wir empfehlen eine Wiedervorstellung in 78 Monate(n).', NULL, 16),
(87, '2018-02-04 18:56:07', 'Dr. Vetter', NULL, '', NULL, 16),
(88, '2018-02-11 22:44:45', 'Dr. Wagner', NULL, 'Der Patient  befindet sich in einem gutem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 60 kg und ist somit stabil.  Wir empfehlen eine Wiedervorstellung in  Monate(n).', NULL, 16),
(89, '2018-02-11 23:38:47', 'Dr. Vetter', NULL, 'Der Patient  befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 34 kg und ist somit stabil. Es liegt eine leichtgradige hepatische Enzephalopathie vor. Der Patient berichtet von HÃ¤matemesis und Teerstuhl. Aktuell finden sich groÃŸe Mengen Aszites. Der Child-Pugh-Score betrÃ¤gt 13 Punkte und der MELD-Score 37 Punkte. Wir empfehlen eine Wiedervorstellung in 23 Monate(n).', NULL, 16),
(90, '2018-02-12 00:28:14', 'Dr. Wagner', NULL, 'Der Patient  befindet sich in einem gutem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 34 kg und ist somit stabil.  Wir empfehlen eine Wiedervorstellung in 34 Monate(n).\r\n\r\nHallo!', NULL, 16),
(91, '2018-02-23 22:25:03', 'Dr. Wagner', NULL, 'Der Patient  befindet sich in einem leicht reduziertem Allgemeinzustand. Das aktuelle KÃ¶rpergewicht betrÃ¤gt 56 kg und ist somit steigend. Der Patient verneint das Vorliegen von Pruritus. Es liegt eine leichtgradige hepatische Enzephalopathie vor. Der Patient berichtet von Teerstuhl. Aktuell finden sich groÃŸe Mengen Aszites. Der Child-Pugh-Score betrÃ¤gt 12 Punkte und der MELD-Score 42 Punkte. Wir empfehlen eine Wiedervorstellung in 10 Woche(n).\r\nDas sit alles gut!', NULL, 16);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `laborwerte`
--

CREATE TABLE `laborwerte` (
  `idlaborwerte` int(11) NOT NULL,
  `datum` date DEFAULT NULL,
  `got` float DEFAULT NULL,
  `gpt` float DEFAULT NULL,
  `ggt` float DEFAULT NULL,
  `ap` float DEFAULT NULL,
  `albumin` float DEFAULT NULL,
  `bilirubin` float DEFAULT NULL,
  `inr` float DEFAULT NULL,
  `kreatinin` float DEFAULT NULL,
  `hbv_dna` int(10) DEFAULT NULL,
  `stammdaten_idstammdaten` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `laborwerte`
--

INSERT INTO `laborwerte` (`idlaborwerte`, `datum`, `got`, `gpt`, `ggt`, `ap`, `albumin`, `bilirubin`, `inr`, `kreatinin`, `hbv_dna`, `stammdaten_idstammdaten`) VALUES
(1, '2017-12-25', NULL, 50, NULL, NULL, 58, 4, 2, 5, NULL, 16),
(2, '2017-12-25', NULL, 50, NULL, NULL, 58, 4, 2, 5, NULL, 16),
(3, '2017-12-25', NULL, 50, NULL, NULL, 58, 4, 2, 5, NULL, 16),
(4, '2017-12-25', NULL, 45, NULL, NULL, 45, 8, 2, 6, 45, 16),
(5, '2017-12-25', NULL, 89, NULL, NULL, 45, 6, 4, 5, 6000, 16),
(6, '2017-12-25', NULL, 78, NULL, NULL, 45, 2, 7, 0, 9000, 16),
(7, '2017-12-25', NULL, 78, NULL, NULL, 45, 4, 8, 4, 6000, 16),
(8, '2017-12-25', NULL, 78, NULL, NULL, 45, 4, 8, 4, 6000, 16),
(9, '2017-12-25', NULL, 78, NULL, NULL, 45, 2, 5, 5, 6000, 16),
(10, '2018-02-04', NULL, 60, NULL, NULL, 34, 2, 3, 5, 4000, 16),
(11, '2018-02-11', NULL, 0, NULL, NULL, 45, 4, 45, 4, 0, 16),
(12, '2018-02-11', NULL, 500, NULL, NULL, 34, 4, 3, 4, 3000, 16),
(13, '2018-02-12', NULL, 0, NULL, NULL, 0, 0, 0, 0, 0, 16),
(14, '2018-02-23', NULL, 7000, NULL, NULL, 0, 3, 5, 4, 400, 16);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `leberfunktion`
--

CREATE TABLE `leberfunktion` (
  `id_leberfunktion` int(11) NOT NULL,
  `datum` datetime NOT NULL,
  `child` int(3) DEFAULT NULL,
  `meld` int(3) DEFAULT NULL,
  `stammdaten_idstammdaten` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `leberfunktion`
--

INSERT INTO `leberfunktion` (`id_leberfunktion`, `datum`, `child`, `meld`, `stammdaten_idstammdaten`) VALUES
(1, '2017-12-25 17:14:44', 1, 31, 16),
(2, '2017-12-25 17:18:10', 1, 48, 16),
(3, '2017-12-25 17:19:15', 12, 48, 16),
(4, '2017-12-25 17:30:33', 11, 40, 16),
(5, '2018-02-04 18:56:07', 0, 0, 16),
(6, '2018-02-11 22:44:45', 0, 0, 16),
(7, '2018-02-11 23:38:47', 13, 37, 16),
(8, '2018-02-12 00:28:14', 0, 0, 16),
(9, '2018-02-23 22:25:03', 12, 42, 16);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `plz`
--

CREATE TABLE `plz` (
  `idplz` int(11) NOT NULL,
  `plz` varchar(45) DEFAULT NULL,
  `ort` varchar(45) DEFAULT NULL,
  `Adresse_idAdresse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pruritus`
--

CREATE TABLE `pruritus` (
  `idPruritus` int(11) NOT NULL,
  `datum` date DEFAULT NULL,
  `pruritus_intensitaet` int(3) NOT NULL,
  `neuroderm` int(11) DEFAULT NULL,
  `itchyQual` int(11) DEFAULT NULL,
  `stammdaten_idstammdaten` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `pruritus`
--

INSERT INTO `pruritus` (`idPruritus`, `datum`, `pruritus_intensitaet`, `neuroderm`, `itchyQual`, `stammdaten_idstammdaten`) VALUES
(1, '2017-12-25', 3, NULL, NULL, 16),
(2, '2017-12-25', 3, NULL, NULL, 16),
(3, '2017-12-25', 4, NULL, NULL, 16),
(4, '2017-12-25', 3, NULL, NULL, 16),
(5, '2017-12-25', 3, NULL, NULL, 16),
(6, '2017-12-25', 3, NULL, NULL, 16),
(7, '2018-02-04', 2, NULL, NULL, 16),
(8, '2018-02-11', 0, NULL, NULL, 16),
(9, '2018-02-11', 0, NULL, NULL, 16),
(10, '2018-02-12', 0, NULL, NULL, 16),
(11, '2018-02-23', 0, NULL, NULL, 16);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stammdaten`
--

CREATE TABLE `stammdaten` (
  `idstammdaten` int(11) NOT NULL,
  `nachname` tinytext,
  `vorname` tinytext,
  `diagnose` tinytext,
  `geburtsdatum` date DEFAULT NULL,
  `geschlecht` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `stammdaten`
--

INSERT INTO `stammdaten` (`idstammdaten`, `nachname`, `vorname`, `diagnose`, `geburtsdatum`, `geschlecht`) VALUES
(15, 'Mustermann', 'LeZi', 'lambarene', NULL, 'w'),
(16, 'Mustermann', 'Max', 'Test', NULL, 'w');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`idAdresse`),
  ADD KEY `fk_Adresse_stammdaten1_idx` (`stammdaten_idstammdaten`);

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`benutzer_id`),
  ADD UNIQUE KEY `benutzer_name` (`benutzer_name`);

--
-- Indizes für die Tabelle `bericht`
--
ALTER TABLE `bericht`
  ADD PRIMARY KEY (`idbericht`),
  ADD KEY `fk_bericht_stammdaten1_idx` (`stammdaten_idstammdaten`);

--
-- Indizes für die Tabelle `laborwerte`
--
ALTER TABLE `laborwerte`
  ADD PRIMARY KEY (`idlaborwerte`),
  ADD KEY `fk_laborwerte_stammdaten1_idx` (`stammdaten_idstammdaten`) USING BTREE;

--
-- Indizes für die Tabelle `leberfunktion`
--
ALTER TABLE `leberfunktion`
  ADD PRIMARY KEY (`id_leberfunktion`);

--
-- Indizes für die Tabelle `plz`
--
ALTER TABLE `plz`
  ADD PRIMARY KEY (`idplz`),
  ADD KEY `fk_plz_Adresse1_idx` (`Adresse_idAdresse`);

--
-- Indizes für die Tabelle `pruritus`
--
ALTER TABLE `pruritus`
  ADD PRIMARY KEY (`idPruritus`),
  ADD KEY `fk_Pruritus_stammdaten1_idx` (`stammdaten_idstammdaten`);

--
-- Indizes für die Tabelle `stammdaten`
--
ALTER TABLE `stammdaten`
  ADD PRIMARY KEY (`idstammdaten`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `adresse`
--
ALTER TABLE `adresse`
  MODIFY `idAdresse` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `benutzer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `bericht`
--
ALTER TABLE `bericht`
  MODIFY `idbericht` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT für Tabelle `laborwerte`
--
ALTER TABLE `laborwerte`
  MODIFY `idlaborwerte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT für Tabelle `leberfunktion`
--
ALTER TABLE `leberfunktion`
  MODIFY `id_leberfunktion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `plz`
--
ALTER TABLE `plz`
  MODIFY `idplz` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `pruritus`
--
ALTER TABLE `pruritus`
  MODIFY `idPruritus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `stammdaten`
--
ALTER TABLE `stammdaten`
  MODIFY `idstammdaten` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
