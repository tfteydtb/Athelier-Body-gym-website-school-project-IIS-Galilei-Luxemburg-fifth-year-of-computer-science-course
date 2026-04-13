-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 12, 2026 alle 22:59
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `palestra`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `allenatori`
--

CREATE TABLE `allenatori` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `allenatori`
--

INSERT INTO `allenatori` (`id`, `nome`, `cognome`, `password`, `email`) VALUES
(7, 'Marco', 'Rossi', 'palestra123', 'marcorossi@gmail.com'),
(8, 'Luca', 'Bianchi', 'palestra123', 'lucabianchi@gmail.com'),
(9, 'Sara', 'Verdi', 'palestra123', 'saraverdi@gmail.com'),
(10, 'Andrea', 'Neri', 'palestra123', 'andreaneri@gmail.com'),
(11, 'Davide', 'Gallo', 'palestra123', 'davidegallo@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `amministratori`
--

CREATE TABLE `amministratori` (
  `id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `amministratori`
--

INSERT INTO `amministratori` (`id`, `password`, `email`) VALUES
(3, 'admin123', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `corsi`
--

CREATE TABLE `corsi` (
  `id` int(11) NOT NULL,
  `tipo_corso` varchar(50) NOT NULL,
  `id_allenatore` int(11) DEFAULT NULL,
  `data` date NOT NULL,
  `fascia_oraria` varchar(20) NOT NULL,
  `numero_massimo_iscritti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `corsi`
--

INSERT INTO `corsi` (`id`, `tipo_corso`, `id_allenatore`, `data`, `fascia_oraria`, `numero_massimo_iscritti`) VALUES
(2, 'functional training', 7, '0000-00-00', '18:30 20:30', 32);

-- --------------------------------------------------------

--
-- Struttura della tabella `iscrizioni`
--

CREATE TABLE `iscrizioni` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_corso` int(11) NOT NULL,
  `data_iscrizione` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `iscrizioni`
--

INSERT INTO `iscrizioni` (`id`, `id_utente`, `id_corso`, `data_iscrizione`) VALUES
(1, 2, 2, '0000-00-00');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `codice_fiscale` varchar(16) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `tipo_abbonamento` enum('BASIC','PRO','ELITE') NOT NULL,
  `data_inizio` date NOT NULL,
  `data_fine` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `nome`, `cognome`, `codice_fiscale`, `telefono`, `tipo_abbonamento`, `data_inizio`, `data_fine`, `password`, `email`) VALUES
(2, 'matteo ', 'filippi', '2134e321', '+39351981324', 'PRO', '0000-00-00', '0000-00-00', 'matteo123', 'matteo@gmail.com');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `allenatori`
--
ALTER TABLE `allenatori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indici per le tabelle `amministratori`
--
ALTER TABLE `amministratori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indici per le tabelle `corsi`
--
ALTER TABLE `corsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_allenatore` (`id_allenatore`);

--
-- Indici per le tabelle `iscrizioni`
--
ALTER TABLE `iscrizioni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utente` (`id_utente`),
  ADD KEY `id_corso` (`id_corso`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codice_fiscale` (`codice_fiscale`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `allenatori`
--
ALTER TABLE `allenatori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `amministratori`
--
ALTER TABLE `amministratori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `corsi`
--
ALTER TABLE `corsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `iscrizioni`
--
ALTER TABLE `iscrizioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `corsi`
--
ALTER TABLE `corsi`
  ADD CONSTRAINT `corsi_ibfk_1` FOREIGN KEY (`id_allenatore`) REFERENCES `allenatori` (`id`);

--
-- Limiti per la tabella `iscrizioni`
--
ALTER TABLE `iscrizioni`
  ADD CONSTRAINT `iscrizioni_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `iscrizioni_ibfk_2` FOREIGN KEY (`id_corso`) REFERENCES `corsi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
