-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 04. Nov 2017 um 13:06
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
(40, '2017-11-04 12:01:17', 'Dr. Wagner', NULL, 'final', NULL, 16);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hepatitis_c_dynamisch`
--

CREATE TABLE `hepatitis_c_dynamisch` (
  `idhepatitis_c_dynamisch` int(11) NOT NULL,
  `datum` date DEFAULT NULL,
  `viruslast` int(11) DEFAULT NULL,
  `child_pugh` int(11) DEFAULT NULL,
  `hepatitis_c_statisch_idhepatitis_c` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hepatitis_c_statisch`
--

CREATE TABLE `hepatitis_c_statisch` (
  `idhepatitis_c` int(11) NOT NULL,
  `genotyp_1` tinytext,
  `genotyp_2` tinytext,
  `genotyp_3` tinytext,
  `vortherapie` int(11) DEFAULT NULL,
  `dialyse` int(11) DEFAULT NULL,
  `stammdaten_idstammdaten` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hepatitis_c_therapie`
--

CREATE TABLE `hepatitis_c_therapie` (
  `idhepatitis_c_therapie` int(11) NOT NULL,
  `therapieeinleitung` date DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `hepatitis_c_statisch_idhepatitis_c` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `bilirubin` float DEFAULT NULL,
  `stammdaten_idstammdaten` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `neuroderm` int(11) DEFAULT NULL,
  `itchyQual` int(11) DEFAULT NULL,
  `stammdaten_idstammdaten` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stammdaten`
--

CREATE TABLE `stammdaten` (
  `idstammdaten` int(11) NOT NULL,
  `nachname` tinytext,
  `vorname` tinytext,
  `diagnose` tinytext,
  `geburtsdatum` datetime DEFAULT NULL,
  `geschlecht` varchar(1) DEFAULT NULL,
  `hepatitis_c_idhepatitis_c` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `stammdaten`
--

INSERT INTO `stammdaten` (`idstammdaten`, `nachname`, `vorname`, `diagnose`, `geburtsdatum`, `geschlecht`, `hepatitis_c_idhepatitis_c`) VALUES
(15, 'Mustermann', 'LeZi', 'lambarene', NULL, 'w', 0),
(16, 'Mustermann', 'Max', 'Test', NULL, 'w', 0);

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
-- Indizes für die Tabelle `bericht`
--
ALTER TABLE `bericht`
  ADD PRIMARY KEY (`idbericht`),
  ADD KEY `fk_bericht_stammdaten1_idx` (`stammdaten_idstammdaten`);

--
-- Indizes für die Tabelle `hepatitis_c_dynamisch`
--
ALTER TABLE `hepatitis_c_dynamisch`
  ADD PRIMARY KEY (`idhepatitis_c_dynamisch`),
  ADD KEY `fk_hepatitis_c_dynamisch_hepatitis_c_statisch1_idx` (`hepatitis_c_statisch_idhepatitis_c`);

--
-- Indizes für die Tabelle `hepatitis_c_statisch`
--
ALTER TABLE `hepatitis_c_statisch`
  ADD PRIMARY KEY (`idhepatitis_c`),
  ADD KEY `fk_hepatitis_c_statisch_stammdaten1_idx` (`stammdaten_idstammdaten`);

--
-- Indizes für die Tabelle `hepatitis_c_therapie`
--
ALTER TABLE `hepatitis_c_therapie`
  ADD PRIMARY KEY (`idhepatitis_c_therapie`),
  ADD KEY `fk_hepatitis_c_therapie_hepatitis_c_statisch1_idx` (`hepatitis_c_statisch_idhepatitis_c`);

--
-- Indizes für die Tabelle `laborwerte`
--
ALTER TABLE `laborwerte`
  ADD PRIMARY KEY (`idlaborwerte`),
  ADD KEY `fk_laborwerte_stammdaten1_idx` (`stammdaten_idstammdaten`) USING BTREE;

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
  ADD PRIMARY KEY (`idstammdaten`,`hepatitis_c_idhepatitis_c`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `adresse`
--
ALTER TABLE `adresse`
  MODIFY `idAdresse` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `bericht`
--
ALTER TABLE `bericht`
  MODIFY `idbericht` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT für Tabelle `hepatitis_c_dynamisch`
--
ALTER TABLE `hepatitis_c_dynamisch`
  MODIFY `idhepatitis_c_dynamisch` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `hepatitis_c_statisch`
--
ALTER TABLE `hepatitis_c_statisch`
  MODIFY `idhepatitis_c` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `hepatitis_c_therapie`
--
ALTER TABLE `hepatitis_c_therapie`
  MODIFY `idhepatitis_c_therapie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `laborwerte`
--
ALTER TABLE `laborwerte`
  MODIFY `idlaborwerte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `plz`
--
ALTER TABLE `plz`
  MODIFY `idplz` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `pruritus`
--
ALTER TABLE `pruritus`
  MODIFY `idPruritus` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `stammdaten`
--
ALTER TABLE `stammdaten`
  MODIFY `idstammdaten` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
