-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 14. mar 2021 ob 23.40
-- Različica strežnika: 10.4.17-MariaDB
-- Različica PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `db`
--

-- --------------------------------------------------------

--
-- Struktura tabele `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `id_objava` int(11) NOT NULL,
  `komentar` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabele `objava`
--

CREATE TABLE `objava` (
  `id` int(11) NOT NULL,
  `cas_objave` datetime NOT NULL,
  `naslov` varchar(25) NOT NULL,
  `vsebina` varchar(1000) NOT NULL,
  `id_skupina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabele `skupina`
--

CREATE TABLE `skupina` (
  `id` int(11) NOT NULL,
  `ime` varchar(25) NOT NULL,
  `st_uporabnikov` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabele `sledene_skupine`
--

CREATE TABLE `sledene_skupine` (
  `id` int(11) NOT NULL,
  `id_skupina` int(11) NOT NULL,
  `id_uporabnik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabele `uporabniki`
--

CREATE TABLE `uporabniki` (
  `id` int(11) NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(256) CHARACTER SET utf8 NOT NULL,
  `opis` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Odloži podatke za tabelo `uporabniki`
--

INSERT INTO `uporabniki` (`id`, `username`, `password`, `opis`) VALUES
(1, 'pepi', '*2DFF0F89FCF1B1A271B9EE09162FBB98D215EFF4', NULL);

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_objava` (`id_objava`);

--
-- Indeksi tabele `objava`
--
ALTER TABLE `objava`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_skupina` (`id_skupina`);

--
-- Indeksi tabele `skupina`
--
ALTER TABLE `skupina`
  ADD PRIMARY KEY (`id`);

--
-- Indeksi tabele `sledene_skupine`
--
ALTER TABLE `sledene_skupine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_skupina` (`id_skupina`),
  ADD KEY `id_uporabnik` (`id_uporabnik`);

--
-- Indeksi tabele `uporabniki`
--
ALTER TABLE `uporabniki`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT tabele `objava`
--
ALTER TABLE `objava`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT tabele `skupina`
--
ALTER TABLE `skupina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT tabele `sledene_skupine`
--
ALTER TABLE `sledene_skupine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT tabele `uporabniki`
--
ALTER TABLE `uporabniki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id_objava`) REFERENCES `objava` (`id`);

--
-- Omejitve za tabelo `objava`
--
ALTER TABLE `objava`
  ADD CONSTRAINT `objava_ibfk_1` FOREIGN KEY (`id_skupina`) REFERENCES `skupina` (`id`);

--
-- Omejitve za tabelo `sledene_skupine`
--
ALTER TABLE `sledene_skupine`
  ADD CONSTRAINT `sledene_skupine_ibfk_1` FOREIGN KEY (`id_skupina`) REFERENCES `skupina` (`id`),
  ADD CONSTRAINT `sledene_skupine_ibfk_2` FOREIGN KEY (`id_uporabnik`) REFERENCES `uporabniki` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
