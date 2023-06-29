-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 26 jun 2023 om 23:30
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `chassis`
--

CREATE TABLE `chassis` (
  `id` int(3) NOT NULL,
  `number` varchar(40) NOT NULL,
  `height` int(2) NOT NULL,
  `length` int(4) NOT NULL,
  `psu_position` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `chassis`
--

INSERT INTO `chassis` (`id`, `number`, `height`, `length`, `psu_position`) VALUES
(1, 'Dell R250', 1, 563, 2),
(2, 'Dell R7515', 2, 682, 2),
(3, 'Fujitsu RX1330', 1, 572, 1),
(4, 'Dell T640', 5, 692, 3),
(5, 'Asus ESC4000 G4', 2, 800, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `chassis_cpus`
--

CREATE TABLE `chassis_cpus` (
  `id` int(11) NOT NULL,
  `chassis_id` int(3) NOT NULL,
  `cpu_id` int(3) NOT NULL,
  `max_power_usage` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `chassis_cpus`
--

INSERT INTO `chassis_cpus` (`id`, `chassis_id`, `cpu_id`, `max_power_usage`) VALUES
(1, 2, 1, 0.25);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cpus`
--

CREATE TABLE `cpus` (
  `id` int(3) NOT NULL,
  `number` varchar(30) NOT NULL,
  `brand` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `cpus`
--

INSERT INTO `cpus` (`id`, `number`, `brand`) VALUES
(1, 'EPYC 7402P', 'AMD');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `locations`
--

CREATE TABLE `locations` (
  `id` int(2) NOT NULL,
  `number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `locations`
--

INSERT INTO `locations` (`id`, `number`) VALUES
(1, 'NLDW1'),
(2, 'NLDW2'),
(3, 'NLDW3'),
(4, 'NLDW4'),
(5, 'WRD1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `racks`
--

CREATE TABLE `racks` (
  `id` int(10) NOT NULL,
  `number` varchar(255) NOT NULL,
  `location_id` int(11) NOT NULL,
  `notes` mediumtext NOT NULL,
  `rack_profile_id` int(11) NOT NULL,
  `private_user_id` int(11) DEFAULT NULL,
  `last_power_usage` double NOT NULL,
  `last_power_update` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `racks`
--

INSERT INTO `racks` (`id`, `number`, `location_id`, `notes`, `rack_profile_id`, `private_user_id`, `last_power_usage`, `last_power_update`) VALUES
(1, 'NLDW3.2.10', 3, 'Niet opleveren/plaatsen - Maximale load', 1, NULL, 0.36, '2023-05-18 19:49:38');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rack_profiles`
--

CREATE TABLE `rack_profiles` (
  `id` int(11) NOT NULL,
  `rack_type` varchar(255) DEFAULT NULL,
  `ampere` int(11) DEFAULT NULL,
  `pdus_left` int(1) NOT NULL DEFAULT 0,
  `pdus_right` int(1) NOT NULL DEFAULT 0,
  `cooling_capacity` double NOT NULL DEFAULT 0,
  `space` int(11) NOT NULL DEFAULT 0,
  `unmetered` tinyint(1) NOT NULL DEFAULT 0,
  `speed` int(11) DEFAULT NULL,
  `local_speed` int(11) DEFAULT NULL,
  `wen` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `rack_profiles`
--

INSERT INTO `rack_profiles` (`id`, `rack_type`, `ampere`, `pdus_left`, `pdus_right`, `cooling_capacity`, `space`, `unmetered`, `speed`, `local_speed`, `wen`) VALUES
(17, 'Colocation', 12, 0, 0, 3.5, 44, 0, 1000, 0, 0),
(9, 'Dedicated', 12, 1, 1, 3.5, 44, 0, 1000, 0, 0),
(13, 'Dedicated', 12, 1, 1, 3.5, 44, 0, 1000, 0, 1),
(11, 'Dedicated', 12, 1, 1, 3.5, 44, 0, 1000, 1000, 0),
(15, 'Dedicated', 12, 1, 1, 3.5, 44, 0, 1000, 1000, 1),
(10, 'Dedicated', 12, 1, 1, 3.5, 44, 0, 10000, 0, 0),
(14, 'Dedicated', 12, 1, 1, 3.5, 44, 0, 10000, 0, 1),
(12, 'Dedicated', 12, 1, 1, 3.5, 44, 0, 10000, 1000, 0),
(16, 'Dedicated', 12, 1, 1, 3.5, 44, 0, 10000, 1000, 1),
(1, 'Dedicated', 12, 1, 1, 3.5, 44, 1, 1000, 0, 0),
(5, 'Dedicated', 12, 1, 1, 3.5, 44, 1, 1000, 0, 1),
(3, 'Dedicated', 12, 1, 1, 3.5, 44, 1, 1000, 1000, 0),
(7, 'Dedicated', 12, 1, 1, 3.5, 44, 1, 1000, 1000, 1),
(2, 'Dedicated', 12, 1, 1, 3.5, 44, 1, 10000, 0, 0),
(6, 'Dedicated', 12, 1, 1, 3.5, 44, 1, 10000, 0, 1),
(4, 'Dedicated', 12, 1, 1, 3.5, 44, 1, 10000, 1000, 0),
(8, 'Dedicated', 12, 1, 1, 3.5, 44, 1, 10000, 1000, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `servers`
--

CREATE TABLE `servers` (
  `id` int(10) NOT NULL,
  `number` varchar(255) NOT NULL,
  `service_tag` varchar(255) NOT NULL,
  `chassis_cpu_id` int(3) NOT NULL,
  `rack_id` int(11) NOT NULL,
  `u_number` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `servers`
--

INSERT INTO `servers` (`id`, `number`, `service_tag`, `chassis_cpu_id`, `rack_id`, `u_number`) VALUES
(7, 'NLDW3.2.10.28', 'FA0PFWRI', 1, 1, 28),
(1, 'NLDW3.2.10.30', 'FA0PFWRJ', 1, 1, 30),
(6, 'NLDW3.2.10.32', 'FA0PFWRK', 1, 1, 32);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`) VALUES
(1, 'John Doe');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `chassis`
--
ALTER TABLE `chassis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_chassis` (`number`) USING BTREE;

--
-- Indexen voor tabel `chassis_cpus`
--
ALTER TABLE `chassis_cpus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_chassis_cpu` (`chassis_id`,`cpu_id`) USING BTREE;

--
-- Indexen voor tabel `cpus`
--
ALTER TABLE `cpus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_cpu` (`number`,`brand`) USING BTREE;

--
-- Indexen voor tabel `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_location` (`number`) USING BTREE;

--
-- Indexen voor tabel `racks`
--
ALTER TABLE `racks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_rack` (`number`,`location_id`,`rack_profile_id`,`private_user_id`) USING BTREE;

--
-- Indexen voor tabel `rack_profiles`
--
ALTER TABLE `rack_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_rack_profile` (`rack_type`,`ampere`,`pdus_left`,`pdus_right`,`cooling_capacity`,`space`,`unmetered`,`speed`,`local_speed`,`wen`) USING BTREE;

--
-- Indexen voor tabel `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_server` (`number`,`service_tag`,`chassis_cpu_id`,`rack_id`,`u_number`) USING BTREE;

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_user` (`name`) USING BTREE;

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `chassis`
--
ALTER TABLE `chassis`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `chassis_cpus`
--
ALTER TABLE `chassis_cpus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `cpus`
--
ALTER TABLE `cpus`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `racks`
--
ALTER TABLE `racks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `rack_profiles`
--
ALTER TABLE `rack_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT voor een tabel `servers`
--
ALTER TABLE `servers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `chassis_cpus`
--
ALTER TABLE `chassis_cpus`
  ADD CONSTRAINT `chassis` FOREIGN KEY (`chassis_id`) REFERENCES `chassis` (`id`),
  ADD CONSTRAINT `cpu` FOREIGN KEY (`cpu_id`) REFERENCES `cpus` (`id`);

--
-- Beperkingen voor tabel `racks`
--
ALTER TABLE `racks`
  ADD CONSTRAINT `location` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `rack_profile` FOREIGN KEY (`rack_profile_id`) REFERENCES `rack_profiles` (`id`),
  ADD CONSTRAINT `user` FOREIGN KEY (`private_user_id`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `servers`
--
ALTER TABLE `servers`
  ADD CONSTRAINT `chassis_cpu` FOREIGN KEY (`chassis_cpu_id`) REFERENCES `chassis_cpus` (`id`),
  ADD CONSTRAINT `rack` FOREIGN KEY (`rack_id`) REFERENCES `racks` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
