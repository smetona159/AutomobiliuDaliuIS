-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018 m. Kov 18 d. 22:49
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antra`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `apmokejimo_tipas`
--

CREATE TABLE `apmokejimo_tipas` (
  `apmokejimo_id` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL,
  `apmokejimo_reiksme` varchar(30) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `fk_Uzsakymasuzsakymo_nr` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `apmokejimo_tipas`
--

INSERT INTO `apmokejimo_tipas` (`apmokejimo_id`, `apmokejimo_reiksme`, `fk_Uzsakymasuzsakymo_nr`) VALUES
('1', 'Grynais', '1'),
('2', 'Grynais', '3'),
('3', 'Grynais', 'Kaun-1'),
('4', 'Grynais', '2'),
('5', 'Grynais', 'Kel-1'),
('6', 'Grynais', 'Kaun-2'),
('7', 'Grynais', 'Kel-3'),
('8', 'Grynais', 'Kel-4');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `asmuo`
--

CREATE TABLE `asmuo` (
  `asmens_kodas` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL,
  `el_pastas` varchar(30) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `vardas` varchar(20) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `pavarde` varchar(20) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `telefono_nr` varchar(21) COLLATE utf8_lithuanian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `asmuo`
--

INSERT INTO `asmuo` (`asmens_kodas`, `el_pastas`, `vardas`, `pavarde`, `telefono_nr`) VALUES
('30005032458', 'tomas.blazinkas@gmail.com', 'Tomas', 'Blažinskas', '865247239'),
('30010115628', 'justas.zulonas@gmail.com', 'Justas', 'Zulonas', NULL),
('38811104785', 'antanas.smetona@gmail.com', 'Antanas', 'Smetona', '370685236978'),
('38912130257', 'jurijus.povilaitis@', 'Jurijus', 'Povilaitis', '37064756258'),
('39007032358', 'petras.kasparavicius@gmail.com', 'Petras', 'Kasparavičius', NULL),
('39111132578', 'tomas.macijauskas@gmail.com', 'Tomas', 'Macijauskas', '37065236478'),
('39223252387', 'kazimieras.luksa@gmail.com', 'Kazimieras', 'Lukša', '37062578938'),
('39623252398', 'mantas.petrokas@gmail.com', 'Mantas', 'Petrokas', '370658742369'),
('39705032365', 'kristupas.slimas@gmail.com', 'Kristupas', 'Šlimas', '37065825475'),
('49205072589', 'aurika.venckute@gmail.com', 'Aurika', 'Venckutė', NULL),
('49706072589', 'juste.slizyte@gmail.com', 'Justina', 'Šližytė', NULL),
('49901132569', 'julija.slimaite@gmail.com', 'Julija', 'Šlimaitė', '37064159776');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `busena`
--

CREATE TABLE `busena` (
  `nuo_kada` date DEFAULT NULL,
  `iki_kada` date DEFAULT NULL,
  `reiskme` varchar(30) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `id_Busena` int(11) NOT NULL,
  `fk_Uzsakymasuzsakymo_nr` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `busena`
--

INSERT INTO `busena` (`nuo_kada`, `iki_kada`, `reiskme`, `id_Busena`, `fk_Uzsakymasuzsakymo_nr`) VALUES
('2018-03-13', '2018-03-14', 'Laukiama apmokėjimo', 1, '1'),
('2018-03-14', NULL, 'Apmokėtas', 2, '1'),
('2018-03-18', NULL, 'Laukiama apmokėjimo', 3, '2'),
('2018-03-18', '2018-03-18', 'Apmokėtas', 4, '3'),
('2018-03-05', '2018-03-16', 'Laukiama apmokėjimo', 5, 'Kaun-1'),
('2018-03-06', NULL, 'Apmokėtas', 6, 'Kaun-1'),
('2018-03-07', NULL, 'Apmokėtas', 7, 'Kaun-2'),
('2018-03-01', NULL, 'Apmokėtas', 8, 'Kel-1'),
('2018-03-07', NULL, 'Apmokėtas', 9, 'Kel-2'),
('2018-03-02', NULL, 'Apmokėtas', 10, 'Kel-3'),
('2018-03-03', '2018-03-05', 'Laukiama apmokėjimo', 11, 'Kel-4'),
('2018-03-05', NULL, 'Apmokėtas', 12, 'Kel-4');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `dalies_tipas`
--

CREATE TABLE `dalies_tipas` (
  `tipo_id` varchar(20) COLLATE utf8_lithuanian_ci NOT NULL,
  `tipo_reiksme` varchar(30) COLLATE utf8_lithuanian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `dalies_tipas`
--

INSERT INTO `dalies_tipas` (`tipo_id`, `tipo_reiksme`) VALUES
('Aksesuarai', 'Aksesuarai'),
('Apdailos', 'Apdailos detalės'),
('Elektros sistemos', 'Elektros sistemos dalys'),
('Kebulo', 'Kėbulo dalys'),
('Salono ', 'Salono detalės'),
('Transmisijos', 'Transmisijos detalės'),
('Variklio ', 'Variklio detalės'),
('Variklio ausinimo', 'Variklio aušinimo detalės'),
('Vaziuokles', 'Važiuoklės detalės');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `dalis`
--

CREATE TABLE `dalis` (
  `dalies_kodas` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL,
  `dalies_pavadinimas` varchar(30) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `kaina` double DEFAULT NULL,
  `gamintojas` varchar(30) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `pagaminimo_data` date DEFAULT NULL,
  `fk_Modelisid_Modelis` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL,
  `fk_Dalies_tipastipo_id` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `dalis`
--

INSERT INTO `dalis` (`dalies_kodas`, `dalies_pavadinimas`, `kaina`, `gamintojas`, `pagaminimo_data`, `fk_Modelisid_Modelis`, `fk_Dalies_tipastipo_id`) VALUES
('1A2354789', 'Stabdžių diskai', 30, 'AUDI', '2017-07-01', 'A4 B6 Dyz', 'Vaziuokles'),
('1A2354856', 'Stabdžų kaladėlės', 20, 'AUDI', '2018-01-01', 'A4 B5 Benz', 'Vaziuokles'),
('1A2356741', 'Stabdžių diskai', 30, 'AUDI', NULL, 'A4 B5 Benz', 'Vaziuokles'),
('1A2356742', 'Stabdžių diskai', 30, 'AUDI', NULL, 'A6 C6 Benz+D', 'Vaziuokles'),
('1B0000148', 'Karteris', 50, 'BMW', NULL, 'e46 Dyz', 'Variklio '),
('1B0124783', 'Radiatorius', 120, 'BMW', NULL, 'e46 Dyz', 'Variklio ausinimo'),
('1B1235478', 'Stabdžių diskai', 35, 'MB', NULL, 'E320 Dyz', 'Vaziuokles'),
('1B1235479', 'Stabdžių kaladėlės', 25, 'MB', NULL, 'E320 Dyz', 'Vaziuokles'),
('1B2365247', 'Kapotas', 150, 'BMW', NULL, 'e46 Dyz', 'Kebulo'),
('1F2365741', 'Vairas', 300, 'FORD', '2017-05-01', 'Mustang MK6', 'Salono '),
('1F2365852', 'Pavarų svirtis', 20, 'FORD', '2015-06-01', 'Focus MK1', 'Apdailos'),
('1F2365879', 'Stabdžių diskai', 50, 'FORD', '2017-12-01', 'F-150 Mk13', 'Vaziuokles'),
('1F2365880', 'Stabdžių kaladėlės', 40, 'FORD', '2017-12-01', 'F-150 Mk13', 'Vaziuokles'),
('1M1147852', 'Purkštukas', 300, 'MAZDA', '2017-12-01', '6 Mk2', 'Variklio '),
('1M2365745', 'Pavarų dėžė', 300, 'MB', NULL, 'E320 Dyz', 'Transmisijos'),
('1M8523575', 'Alkūninis velenas', 750, 'MITSUBISHI', '2018-01-11', 'Pajero Mk3', 'Variklio '),
('1M8523587', 'Sankaba', 800, 'MITSUBISHI', '2018-01-11', 'Pajero Mk4', 'Transmisijos'),
('1R2658963', 'Purkštukas', 250, 'RENUALT', '2017-08-06', 'Clio Mk3', 'Variklio '),
('1V0012478', 'Radiatorius', 70, 'VOLVO', '2018-01-15', 'V70 MK2', 'Variklio ausinimo'),
('1V2030178', 'Priekinis buferis', 300, 'VOLVO', '2017-12-31', 'S60 MK2', 'Kebulo'),
('1V2030179', 'Galinis Buferis', 250, 'VOLVO', '2017-12-31', 'S60 MK2', 'Kebulo'),
('1V2336582', 'Borto kompiuteris', 500, 'VOLVO', '2018-01-15', 'V70 MK2', 'Elektros sistemos'),
('1Z0713178', 'Radiatorius', 200, 'SKODA', '2017-01-01', 'Octavia 1z Dyz', 'Variklio ausinimo'),
('1Z0713187', 'Rankinio užuolaidėlė', 20, 'SKODA', '2017-10-01', 'Octavia 1z Benz', 'Apdailos');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `darbuotojas`
--

CREATE TABLE `darbuotojas` (
  `sutarties_nr` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL,
  `pareigos` varchar(30) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `sutarties_prad` date DEFAULT NULL,
  `sutarties_pab` date DEFAULT NULL,
  `fk_Asmuoasmens_kodas` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL,
  `fk_Parduotuveid_Parduotuve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `darbuotojas`
--

INSERT INTO `darbuotojas` (`sutarties_nr`, `pareigos`, `sutarties_prad`, `sutarties_pab`, `fk_Asmuoasmens_kodas`, `fk_Parduotuveid_Parduotuve`) VALUES
('SN0', 'Vadybininkas', '2018-02-01', '2018-02-28', '39705032365', 1),
('SN1', 'Savininkas', '2018-03-01', NULL, '39705032365', 1),
('SN2', 'Vadybininkas', '2018-03-01', NULL, '49901132569', 1),
('SNKaunas-1', 'Vadybininkas', '2018-02-01', NULL, '38811104785', 2),
('SNKelme-1', 'Vadybininkas', '2018-02-15', NULL, '38912130257', 3);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `degalu_tipai`
--

CREATE TABLE `degalu_tipai` (
  `degalu_id` varchar(20) COLLATE utf8_lithuanian_ci NOT NULL,
  `degalu_tipas` varchar(50) COLLATE utf8_lithuanian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `degalu_tipai`
--

INSERT INTO `degalu_tipai` (`degalu_id`, `degalu_tipas`) VALUES
('Benz', 'Benzinas'),
('Benz+D', 'Benzinas+Dujos'),
('Benz+E', 'Benzinas+Elektra'),
('Dyz', 'Dyzelinas'),
('Elek', 'Elektra');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `kebulo_tipas`
--

CREATE TABLE `kebulo_tipas` (
  `kebulo_id` varchar(20) COLLATE utf8_lithuanian_ci NOT NULL,
  `kebulo_reiksme` varchar(30) COLLATE utf8_lithuanian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `kebulo_tipas`
--

INSERT INTO `kebulo_tipas` (`kebulo_id`, `kebulo_reiksme`) VALUES
('CUPE', 'Kupė'),
('HECB', 'Hečbekas'),
('KABR', 'Kabrioletas'),
('MINV', 'Minivenas'),
('PICP', 'Pikapas'),
('SEDA', 'Sedanas'),
('UNIV', 'Universalas'),
('VIEN', 'Vienatūris'),
('VISR', 'Visurėgis');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `klientas`
--

CREATE TABLE `klientas` (
  `atsiemimo_miestas` varchar(30) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `id_Klientas` int(11) NOT NULL,
  `fk_Asmuoasmens_kodas` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `klientas`
--

INSERT INTO `klientas` (`atsiemimo_miestas`, `id_Klientas`, `fk_Asmuoasmens_kodas`) VALUES
('Šiauliai', 1, '39223252387'),
('Šiauliai', 2, '39623252398'),
('Kaunas', 3, '49205072589'),
('Kaunas', 4, '49706072589'),
('Kelmė', 5, '30005032458'),
('Kelmė', 6, '30010115628'),
('Kelmė', 7, '39007032358'),
('Kelmė', 8, '39111132578');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `marke`
--

CREATE TABLE `marke` (
  `pavadinimas` varchar(50) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `id_Marke` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `marke`
--

INSERT INTO `marke` (`pavadinimas`, `id_Marke`) VALUES
('Audi', 1),
('BMW', 2),
('Opel', 3),
('Skoda', 4),
('Mercedes', 5),
('Volvo', 6),
('Volkswagen', 7),
('Renualt', 8),
('Peugeot', 9),
('Mazda', 10),
('Mitsubishi', 11),
('Ford', 12),
('Fiat', 13);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `modelis`
--

CREATE TABLE `modelis` (
  `pavadimas` varchar(30) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `pagaminimo_metai` date DEFAULT NULL,
  `id_Modelis` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL,
  `fk_Degalu_tipaidegalu_id` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL,
  `fk_Kebulo_tipaskebulo_id` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL,
  `fk_Transmisijos_tipaitransmisijos_id` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL,
  `fk_Markeid_Marke` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `modelis`
--

INSERT INTO `modelis` (`pavadimas`, `pagaminimo_metai`, `id_Modelis`, `fk_Degalu_tipaidegalu_id`, `fk_Kebulo_tipaskebulo_id`, `fk_Transmisijos_tipaitransmisijos_id`, `fk_Markeid_Marke`) VALUES
('307', '2001-01-01', '307', 'Benz', 'HECB', 'AUTO', 9),
('308', '2007-01-01', '308', 'Dyz', 'HECB', 'MECH', 9),
('mazda 6', '2002-01-01', '6 Mk1', 'Dyz', 'SEDA', 'AUTO', 10),
('mazda 6', '2007-01-01', '6 Mk2', 'Dyz', 'SEDA', 'MECH', 10),
('A3', '2003-01-01', 'A3 8P', 'Dyz', 'HECB', 'MECH', 1),
('A3', '2012-01-01', 'A3 8V', 'Benz', 'SEDA', 'MECH', 1),
('A4 ', '2000-03-08', 'A4 B5 Benz', 'Benz', 'SEDA', 'AUTO', 1),
('A4', '2004-03-14', 'A4 B6 Dyz', 'Dyz', 'UNIV', 'MECH', 1),
('A6', '2008-05-22', 'A6 C6 Benz+D', 'Benz+D', 'KABR', 'MECH', 1),
('Astra', '1990-03-01', 'Astra A', 'Benz', 'UNIV', 'MECH', 3),
('Astra', '2004-01-01', 'Astra F Benz', 'Benz', 'KABR', 'AUTO', 3),
('Astra', '1999-01-01', 'Astra G Dyz', 'Dyz', 'CUPE', 'AUTO', 3),
('Clio', '2005-01-01', 'Clio Mk3', 'Dyz', 'HECB', 'MECH', 8),
('Clio', '2012-01-01', 'Clio Mk4', 'Benz', 'HECB', 'MECH', 8),
('E320', '2005-05-01', 'E320 Dyz', 'Dyz', 'SEDA', 'MECH', 5),
('e46', '1999-03-01', 'e46 Dyz', 'Dyz', 'UNIV', 'MECH', 2),
('F-150', '2009-01-01', 'F-150 Mk12', 'Benz', 'PICP', 'MECH', 12),
('F-150', '2015-01-01', 'F-150 Mk13', 'Benz', 'PICP', 'MECH', 12),
('Focus', '1999-03-01', 'Focus MK1', 'Benz', 'HECB', 'AUTO', 12),
('Multipla', '2000-03-01', 'Multipla mk1', 'Dyz', 'MINV', 'AUTO', 13),
('Mustang GT', '2001-03-01', 'Mustang MK5', 'Benz', 'CUPE', 'AUTO', 12),
('Mustang GT', '2007-03-06', 'Mustang MK6', 'Benz', 'CUPE', 'AUTO', 12),
('Octavia', '2005-01-01', 'Octavia 1z Benz', 'Benz', 'SEDA', 'AUTO', 4),
('Octavia', '2005-01-01', 'Octavia 1z Dyz', 'Dyz', 'UNIV', 'MECH', 4),
('Pajero', '1999-01-01', 'Pajero Mk3', 'Dyz', 'VISR', 'MECH', 11),
('Pajero', '2006-01-01', 'Pajero Mk4', 'Dyz', 'VISR', 'MECH', 11),
('S60', '2000-03-01', 'S60 MK1', 'Benz', 'SEDA', 'MECH', 6),
('S60', '2010-03-07', 'S60 MK2', 'Dyz', 'SEDA', 'AUTO', 6),
('Transporter T5', '2008-03-15', 'Transporter T5 Dyz', 'Dyz', 'VIEN', 'MECH', 7),
('V70', '1996-01-01', 'V70 MK1', 'Benz', 'UNIV', 'AUTO', 6),
('V70', '2000-01-01', 'V70 MK2', 'Dyz', 'UNIV', 'MECH', 6);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `mokejimas`
--

CREATE TABLE `mokejimas` (
  `mokejimo_data` date DEFAULT NULL,
  `suma` double DEFAULT NULL,
  `id_Mokejimas` int(11) NOT NULL,
  `fk_Saskaitasaskaitos_nr` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL,
  `fk_Klientasid_Klientas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `mokejimas`
--

INSERT INTO `mokejimas` (`mokejimo_data`, `suma`, `id_Mokejimas`, `fk_Saskaitasaskaitos_nr`, `fk_Klientasid_Klientas`) VALUES
('2018-03-14', 200, 1, '1', 1),
('2018-03-18', 300, 2, '3', 2),
('2018-03-06', 100, 3, 'Kau-1', 3),
('2018-03-07', 240, 4, 'Kau-2', 4),
('2018-03-01', 120, 5, 'Kelm-1', 5),
('2018-03-07', 30, 6, 'Kelm-2', 6),
('2018-03-02', 20, 7, 'Kelm-3', 7),
('2018-03-05', 120, 8, 'Kelm-4', 8);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `papildymas`
--

CREATE TABLE `papildymas` (
  `Kiekis` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `id_Papildymas` int(11) NOT NULL,
  `fk_Sandelysid_Sandelys` int(11) NOT NULL,
  `fk_Dalisdalies_kodas` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `papildymas`
--

INSERT INTO `papildymas` (`Kiekis`, `data`, `id_Papildymas`, `fk_Sandelysid_Sandelys`, `fk_Dalisdalies_kodas`) VALUES
(10, '2018-03-01', 1, 1, '1A2354789'),
(10, '2018-03-01', 2, 1, '1A2354856'),
(10, '2018-03-01', 3, 1, '1A2356741'),
(10, '2018-03-01', 4, 1, '1A2356742'),
(10, '2018-03-01', 5, 1, '1B0000148'),
(10, '2018-03-01', 6, 1, '1B1235478'),
(10, '2018-03-01', 7, 1, '1B1235478'),
(10, '2018-03-01', 8, 1, '1B1235479'),
(10, '2018-03-01', 9, 1, '1B2365247'),
(10, '2018-03-01', 10, 1, '1M2365745'),
(10, '2018-03-01', 11, 1, '1Z0713178'),
(10, '2018-03-01', 12, 1, '1Z0713187'),
(5, '2018-03-02', 13, 2, '1B0000148'),
(5, '2018-03-05', 14, 2, '1B0124783'),
(10, '2018-03-01', 15, 3, '1B1235478'),
(10, '2018-03-01', 16, 3, '1B1235479'),
(10, '2018-03-02', 17, 3, '1A2356742'),
(20, '2018-03-02', 18, 3, '1A2354856'),
(10, '2018-03-02', 19, 3, '1B1235478');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `parduotuve`
--

CREATE TABLE `parduotuve` (
  `adresas` varchar(25) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `miestas` varchar(25) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `id_Parduotuve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `parduotuve`
--

INSERT INTO `parduotuve` (`adresas`, `miestas`, `id_Parduotuve`) VALUES
('Tilžės g. 6', 'Šiauliai', 1),
('Savanoriu pr. 58', 'Kaunas', 2),
('Mickevičiaus g. 35', 'Kelmė ', 3);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `sandelys`
--

CREATE TABLE `sandelys` (
  `adresas` varchar(25) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `dalies_id` varchar(25) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `id_Sandelys` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `sandelys`
--

INSERT INTO `sandelys` (`adresas`, `dalies_id`, `id_Sandelys`) VALUES
('Tilžės g, 6', NULL, 1),
('Savanoriu pr. 58', NULL, 2),
('Mickevičiaus g. 35', NULL, 3);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `saskaita`
--

CREATE TABLE `saskaita` (
  `saskaitos_nr` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL,
  `saskaitos_data` date DEFAULT NULL,
  `suma` double DEFAULT NULL,
  `fk_Uzsakymasuzsakymo_nr` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `saskaita`
--

INSERT INTO `saskaita` (`saskaitos_nr`, `saskaitos_data`, `suma`, `fk_Uzsakymasuzsakymo_nr`) VALUES
('1', '2018-03-14', 200, '1'),
('2', '2018-03-18', 30, '2'),
('3', '2018-03-18', 300, '3'),
('Kau-1', '2018-03-05', 100, 'Kaun-1'),
('Kau-2', '2018-03-07', 240, 'Kaun-2'),
('Kelm-1', '2018-03-01', 120, 'Kel-1'),
('Kelm-2', '2018-03-07', 30, 'Kel-2'),
('Kelm-3', '2018-03-02', 20, 'Kel-3'),
('Kelm-4', '2018-03-03', 120, 'Kel-4');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `transmisijos_tipai`
--

CREATE TABLE `transmisijos_tipai` (
  `transmisijos_id` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL,
  `transmisijos_reiksme` varchar(30) COLLATE utf8_lithuanian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `transmisijos_tipai`
--

INSERT INTO `transmisijos_tipai` (`transmisijos_id`, `transmisijos_reiksme`) VALUES
('AUTO', 'Automatinė'),
('ELEK', 'Elektra'),
('MECH', 'Mechaninė');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `uzsakoma_dalis`
--

CREATE TABLE `uzsakoma_dalis` (
  `prekiu_sk` int(11) DEFAULT NULL,
  `suma` double DEFAULT NULL,
  `id_Uzsakoma_dalis` int(11) NOT NULL,
  `fk_Dalisdalies_kodas` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL,
  `fk_Uzsakymasuzsakymo_nr` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `uzsakoma_dalis`
--

INSERT INTO `uzsakoma_dalis` (`prekiu_sk`, `suma`, `id_Uzsakoma_dalis`, `fk_Dalisdalies_kodas`, `fk_Uzsakymasuzsakymo_nr`) VALUES
(1, 200, 1, '1Z0713178', '1'),
(1, 30, 2, '1A2354789', '2'),
(1, 300, 3, '1M2365745', '3'),
(2, 100, 4, '1B0000148', 'Kaun-1'),
(2, 240, 5, '1B0124783', 'Kaun-2'),
(2, 70, 6, '1B1235478', 'Kel-1'),
(2, 50, 7, '1B1235479', 'Kel-1'),
(1, 30, 8, '1A2356742', 'Kel-2'),
(1, 20, 9, '1A2354856', 'Kel-3'),
(2, 70, 10, '1B1235478', 'Kel-4'),
(2, 50, 11, '1B1235479', 'Kel-4');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `uzsakymas`
--

CREATE TABLE `uzsakymas` (
  `uzsakymo_nr` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL,
  `uzsakymo_data` date DEFAULT NULL,
  `grazinimo_terminas` int(11) DEFAULT NULL,
  `fk_Darbuotojassutarties_nr` varchar(30) COLLATE utf8_lithuanian_ci NOT NULL,
  `fk_Klientasid_Klientas` int(11) NOT NULL,
  `fk_Parduotuveid_Parduotuve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `uzsakymas`
--

INSERT INTO `uzsakymas` (`uzsakymo_nr`, `uzsakymo_data`, `grazinimo_terminas`, `fk_Darbuotojassutarties_nr`, `fk_Klientasid_Klientas`, `fk_Parduotuveid_Parduotuve`) VALUES
('1', '2018-03-15', 14, 'SN2', 2, 1),
('2', '2018-03-18', NULL, 'SN1', 1, 2),
('3', '2018-03-18', 14, 'SN2', 2, 1),
('Kaun-1', '2018-03-05', NULL, 'SNKaunas-1', 3, 1),
('Kaun-2', '2018-03-07', NULL, 'SNKaunas-1', 4, 1),
('Kel-1', '2018-03-01', NULL, 'SNKelme-1', 7, 3),
('Kel-2', '2018-03-07', NULL, 'SNKelme-1', 8, 3),
('Kel-3', '2018-03-02', NULL, 'SNKelme-1', 6, 3),
('Kel-4', '2018-03-03', NULL, 'SNKelme-1', 5, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apmokejimo_tipas`
--
ALTER TABLE `apmokejimo_tipas`
  ADD PRIMARY KEY (`apmokejimo_id`),
  ADD KEY `Apmokejimo_budas` (`fk_Uzsakymasuzsakymo_nr`);

--
-- Indexes for table `asmuo`
--
ALTER TABLE `asmuo`
  ADD PRIMARY KEY (`asmens_kodas`);

--
-- Indexes for table `busena`
--
ALTER TABLE `busena`
  ADD PRIMARY KEY (`id_Busena`),
  ADD KEY `Busena` (`fk_Uzsakymasuzsakymo_nr`);

--
-- Indexes for table `dalies_tipas`
--
ALTER TABLE `dalies_tipas`
  ADD PRIMARY KEY (`tipo_id`);

--
-- Indexes for table `dalis`
--
ALTER TABLE `dalis`
  ADD PRIMARY KEY (`dalies_kodas`),
  ADD KEY `Turi_Dalis` (`fk_Modelisid_Modelis`),
  ADD KEY `Turi_Tipa` (`fk_Dalies_tipastipo_id`);

--
-- Indexes for table `darbuotojas`
--
ALTER TABLE `darbuotojas`
  ADD PRIMARY KEY (`sutarties_nr`),
  ADD KEY `Dirba` (`fk_Asmuoasmens_kodas`),
  ADD KEY `Darbuojasi` (`fk_Parduotuveid_Parduotuve`);

--
-- Indexes for table `degalu_tipai`
--
ALTER TABLE `degalu_tipai`
  ADD PRIMARY KEY (`degalu_id`);

--
-- Indexes for table `kebulo_tipas`
--
ALTER TABLE `kebulo_tipas`
  ADD PRIMARY KEY (`kebulo_id`);

--
-- Indexes for table `klientas`
--
ALTER TABLE `klientas`
  ADD PRIMARY KEY (`id_Klientas`),
  ADD KEY `Nedirba` (`fk_Asmuoasmens_kodas`);

--
-- Indexes for table `marke`
--
ALTER TABLE `marke`
  ADD PRIMARY KEY (`id_Marke`);

--
-- Indexes for table `modelis`
--
ALTER TABLE `modelis`
  ADD PRIMARY KEY (`id_Modelis`),
  ADD KEY `Turi_Degalus` (`fk_Degalu_tipaidegalu_id`),
  ADD KEY `Turi_Kebula` (`fk_Kebulo_tipaskebulo_id`),
  ADD KEY `Turi_Transmisija` (`fk_Transmisijos_tipaitransmisijos_id`),
  ADD KEY `Turi_Modeli` (`fk_Markeid_Marke`);

--
-- Indexes for table `mokejimas`
--
ALTER TABLE `mokejimas`
  ADD PRIMARY KEY (`id_Mokejimas`),
  ADD KEY `Apmoka` (`fk_Saskaitasaskaitos_nr`),
  ADD KEY `Sumokejo` (`fk_Klientasid_Klientas`);

--
-- Indexes for table `papildymas`
--
ALTER TABLE `papildymas`
  ADD PRIMARY KEY (`id_Papildymas`),
  ADD KEY `Ar_Sandelyje` (`fk_Sandelysid_Sandelys`),
  ADD KEY `Papildoma` (`fk_Dalisdalies_kodas`);

--
-- Indexes for table `parduotuve`
--
ALTER TABLE `parduotuve`
  ADD PRIMARY KEY (`id_Parduotuve`);

--
-- Indexes for table `sandelys`
--
ALTER TABLE `sandelys`
  ADD PRIMARY KEY (`id_Sandelys`);

--
-- Indexes for table `saskaita`
--
ALTER TABLE `saskaita`
  ADD PRIMARY KEY (`saskaitos_nr`),
  ADD KEY `Israsyta` (`fk_Uzsakymasuzsakymo_nr`);

--
-- Indexes for table `transmisijos_tipai`
--
ALTER TABLE `transmisijos_tipai`
  ADD PRIMARY KEY (`transmisijos_id`);

--
-- Indexes for table `uzsakoma_dalis`
--
ALTER TABLE `uzsakoma_dalis`
  ADD PRIMARY KEY (`id_Uzsakoma_dalis`),
  ADD KEY `Yra` (`fk_Dalisdalies_kodas`),
  ADD KEY `Itraukiamas` (`fk_Uzsakymasuzsakymo_nr`);

--
-- Indexes for table `uzsakymas`
--
ALTER TABLE `uzsakymas`
  ADD PRIMARY KEY (`uzsakymo_nr`),
  ADD KEY `Patvirtina` (`fk_Darbuotojassutarties_nr`),
  ADD KEY `Sudaro` (`fk_Klientasid_Klientas`),
  ADD KEY `Atsiemimo_Vieta` (`fk_Parduotuveid_Parduotuve`);

--
-- Apribojimai eksportuotom lentelėm
--

--
-- Apribojimai lentelei `apmokejimo_tipas`
--
ALTER TABLE `apmokejimo_tipas`
  ADD CONSTRAINT `Apmokejimo_budas` FOREIGN KEY (`fk_Uzsakymasuzsakymo_nr`) REFERENCES `uzsakymas` (`uzsakymo_nr`);

--
-- Apribojimai lentelei `busena`
--
ALTER TABLE `busena`
  ADD CONSTRAINT `Busena` FOREIGN KEY (`fk_Uzsakymasuzsakymo_nr`) REFERENCES `uzsakymas` (`uzsakymo_nr`);

--
-- Apribojimai lentelei `dalis`
--
ALTER TABLE `dalis`
  ADD CONSTRAINT `Turi_Dalis` FOREIGN KEY (`fk_Modelisid_Modelis`) REFERENCES `modelis` (`id_Modelis`),
  ADD CONSTRAINT `Turi_Tipa` FOREIGN KEY (`fk_Dalies_tipastipo_id`) REFERENCES `dalies_tipas` (`tipo_id`);

--
-- Apribojimai lentelei `darbuotojas`
--
ALTER TABLE `darbuotojas`
  ADD CONSTRAINT `Darbuojasi` FOREIGN KEY (`fk_Parduotuveid_Parduotuve`) REFERENCES `parduotuve` (`id_Parduotuve`),
  ADD CONSTRAINT `Dirba` FOREIGN KEY (`fk_Asmuoasmens_kodas`) REFERENCES `asmuo` (`asmens_kodas`);

--
-- Apribojimai lentelei `klientas`
--
ALTER TABLE `klientas`
  ADD CONSTRAINT `Nedirba` FOREIGN KEY (`fk_Asmuoasmens_kodas`) REFERENCES `asmuo` (`asmens_kodas`);

--
-- Apribojimai lentelei `modelis`
--
ALTER TABLE `modelis`
  ADD CONSTRAINT `Turi_Degalus` FOREIGN KEY (`fk_Degalu_tipaidegalu_id`) REFERENCES `degalu_tipai` (`degalu_id`),
  ADD CONSTRAINT `Turi_Kebula` FOREIGN KEY (`fk_Kebulo_tipaskebulo_id`) REFERENCES `kebulo_tipas` (`kebulo_id`),
  ADD CONSTRAINT `Turi_Modeli` FOREIGN KEY (`fk_Markeid_Marke`) REFERENCES `marke` (`id_Marke`),
  ADD CONSTRAINT `Turi_Transmisija` FOREIGN KEY (`fk_Transmisijos_tipaitransmisijos_id`) REFERENCES `transmisijos_tipai` (`transmisijos_id`);

--
-- Apribojimai lentelei `mokejimas`
--
ALTER TABLE `mokejimas`
  ADD CONSTRAINT `Apmoka` FOREIGN KEY (`fk_Saskaitasaskaitos_nr`) REFERENCES `saskaita` (`saskaitos_nr`),
  ADD CONSTRAINT `Sumokejo` FOREIGN KEY (`fk_Klientasid_Klientas`) REFERENCES `klientas` (`id_Klientas`);

--
-- Apribojimai lentelei `papildymas`
--
ALTER TABLE `papildymas`
  ADD CONSTRAINT `Ar_Sandelyje` FOREIGN KEY (`fk_Sandelysid_Sandelys`) REFERENCES `sandelys` (`id_Sandelys`),
  ADD CONSTRAINT `Papildoma` FOREIGN KEY (`fk_Dalisdalies_kodas`) REFERENCES `dalis` (`dalies_kodas`);

--
-- Apribojimai lentelei `saskaita`
--
ALTER TABLE `saskaita`
  ADD CONSTRAINT `Israsyta` FOREIGN KEY (`fk_Uzsakymasuzsakymo_nr`) REFERENCES `uzsakymas` (`uzsakymo_nr`);

--
-- Apribojimai lentelei `uzsakoma_dalis`
--
ALTER TABLE `uzsakoma_dalis`
  ADD CONSTRAINT `Itraukiamas` FOREIGN KEY (`fk_Uzsakymasuzsakymo_nr`) REFERENCES `uzsakymas` (`uzsakymo_nr`),
  ADD CONSTRAINT `Yra` FOREIGN KEY (`fk_Dalisdalies_kodas`) REFERENCES `dalis` (`dalies_kodas`);

--
-- Apribojimai lentelei `uzsakymas`
--
ALTER TABLE `uzsakymas`
  ADD CONSTRAINT `Atsiemimo_Vieta` FOREIGN KEY (`fk_Parduotuveid_Parduotuve`) REFERENCES `parduotuve` (`id_Parduotuve`),
  ADD CONSTRAINT `Patvirtina` FOREIGN KEY (`fk_Darbuotojassutarties_nr`) REFERENCES `darbuotojas` (`sutarties_nr`),
  ADD CONSTRAINT `Sudaro` FOREIGN KEY (`fk_Klientasid_Klientas`) REFERENCES `klientas` (`id_Klientas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
