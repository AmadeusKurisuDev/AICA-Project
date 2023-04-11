-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 11, 2023 alle 15:22
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aica`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `azienda` varchar(80) NOT NULL,
  `id_settore` int(11) DEFAULT NULL,
  `id_posizione` int(11) DEFAULT NULL,
  `id_funzione` int(11) DEFAULT NULL,
  `id_sede` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `accounts`
--

INSERT INTO `accounts` (`id`, `nome`, `cognome`, `password`, `email`, `telefono`, `azienda`, `id_settore`, `id_posizione`, `id_funzione`, `id_sede`) VALUES
(1, 'test', '', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'test@test.com', '', '', 1, 1, 1, NULL),
(2, 'bb', 'bb', '$2y$10$slPtY7QNxdrEcj.j5xDmp.XmzOm1DSJyeNRZ.ElJwEfa8vA3gOjsy', 'bb@bb.com', '1234567890', 'bb', 1, 1, 1, NULL),
(3, 'Dario', 'Dalla Libera', '$2y$10$UY1wycfgj/smJfdCiuHCxuPS6I.mD70oKWZ.d3SC2RpE3iCm4LWRu', 'dario.dallalibera@midossi.it', '', 'Midossi', 1, 1, 1, NULL),
(4, 'test2', 'ttt', '$2y$10$ZEStH0uMRhNAA3K7IUcqLufoFfugCuZET91NciokBbjWmfhlwT9Dq', 'test2@test2.com', '12345678', 'ffv', 1, 4, 1, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `center`
--

CREATE TABLE `center` (
  `id` int(11) NOT NULL,
  `id_sede` int(11) NOT NULL,
  `id_corso` int(11) NOT NULL,
  `datafrom` date DEFAULT NULL,
  `datato` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `center`
--

INSERT INTO `center` (`id`, `id_sede`, `id_corso`, `datafrom`, `datato`) VALUES
(1, 2, 1, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Struttura della tabella `corsi`
--

CREATE TABLE `corsi` (
  `id` int(11) NOT NULL,
  `id_servizi` int(11) NOT NULL,
  `id_descrizione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `corsi`
--

INSERT INTO `corsi` (`id`, `id_servizi`, `id_descrizione`) VALUES
(1, 3, 1),
(2, 3, 2),
(3, 4, 1),
(4, 4, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `descrizione`
--

CREATE TABLE `descrizione` (
  `id` int(11) NOT NULL,
  `contenuto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `descrizione`
--

INSERT INTO `descrizione` (`id`, `contenuto`) VALUES
(1, 'Computer Essentials'),
(2, 'Online Essentials');

-- --------------------------------------------------------

--
-- Struttura della tabella `foto`
--

CREATE TABLE `foto` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL,
  `date_time` datetime NOT NULL,
  `id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `funzione`
--

CREATE TABLE `funzione` (
  `id` int(11) NOT NULL,
  `nome` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `funzione`
--

INSERT INTO `funzione` (`id`, `nome`) VALUES
(1, 'CEO');

-- --------------------------------------------------------

--
-- Struttura della tabella `posizione`
--

CREATE TABLE `posizione` (
  `id` int(11) NOT NULL,
  `comune` varchar(80) NOT NULL,
  `regione` varchar(80) NOT NULL,
  `provincia` varchar(80) NOT NULL,
  `cap` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `posizione`
--

INSERT INTO `posizione` (`id`, `comune`, `regione`, `provincia`, `cap`) VALUES
(1, 'Civita Castellana', 'Lazio', 'VT', '01033'),
(2, 'Viterbo', 'Lazio', 'VT', '01100'),
(4, 'Monterotondo', 'Lazio', 'Roma', '02000');

-- --------------------------------------------------------

--
-- Struttura della tabella `sedi`
--

CREATE TABLE `sedi` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) DEFAULT NULL,
  `via` text DEFAULT NULL,
  `civico` varchar(10) DEFAULT NULL,
  `id_posizione` int(11) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `codice` varchar(5) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `datafoto` date DEFAULT NULL,
  `co_x` text DEFAULT NULL,
  `co_y` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `sedi`
--

INSERT INTO `sedi` (`id`, `nome`, `via`, `civico`, `id_posizione`, `telefono`, `codice`, `descrizione`, `foto`, `datafoto`, `co_x`, `co_y`) VALUES
(2, 'IIS U.MIDOSSI', 'via petrarca', NULL, 1, '0761513671', 'A0001', 'civitaaaa', '', NULL, '42.30039230832534', '12.412014902447222'),
(3, 'boh', '', NULL, 2, '1111111111', 'A0002', 'viterboh', '', NULL, '42.423897006254684', '12.096183274299094'),
(4, 'Colassanti', 'via collassanti', NULL, 1, '1111111111', 'A0003', 'colla', '', NULL, '42.305749563073235', '12.419059856390376');

-- --------------------------------------------------------

--
-- Struttura della tabella `servizi`
--

CREATE TABLE `servizi` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `servizi`
--

INSERT INTO `servizi` (`id`, `nome`, `descrizione`) VALUES
(3, 'ICDL Essentials', ''),
(4, 'ICDL Prime', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `settore`
--

CREATE TABLE `settore` (
  `id` int(11) NOT NULL,
  `nome` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `settore`
--

INSERT INTO `settore` (`id`, `nome`) VALUES
(1, 'settore1'),
(2, 'settore2');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settore` (`id_settore`),
  ADD KEY `posizioneus` (`id_posizione`),
  ADD KEY `funzione` (`id_funzione`);

--
-- Indici per le tabelle `center`
--
ALTER TABLE `center`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sede` (`id_sede`),
  ADD KEY `corso` (`id_corso`);

--
-- Indici per le tabelle `corsi`
--
ALTER TABLE `corsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servizi` (`id_servizi`),
  ADD KEY `desc` (`id_descrizione`);

--
-- Indici per le tabelle `descrizione`
--
ALTER TABLE `descrizione`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fotosedi` (`id_sede`);

--
-- Indici per le tabelle `funzione`
--
ALTER TABLE `funzione`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `posizione`
--
ALTER TABLE `posizione`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `sedi`
--
ALTER TABLE `sedi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posizione` (`id_posizione`);

--
-- Indici per le tabelle `servizi`
--
ALTER TABLE `servizi`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `settore`
--
ALTER TABLE `settore`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `center`
--
ALTER TABLE `center`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `corsi`
--
ALTER TABLE `corsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `descrizione`
--
ALTER TABLE `descrizione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `foto`
--
ALTER TABLE `foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `funzione`
--
ALTER TABLE `funzione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `posizione`
--
ALTER TABLE `posizione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `sedi`
--
ALTER TABLE `sedi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `servizi`
--
ALTER TABLE `servizi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `settore`
--
ALTER TABLE `settore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `funzione` FOREIGN KEY (`id_funzione`) REFERENCES `funzione` (`id`),
  ADD CONSTRAINT `posizioneus` FOREIGN KEY (`id_posizione`) REFERENCES `posizione` (`id`),
  ADD CONSTRAINT `settore` FOREIGN KEY (`id_settore`) REFERENCES `settore` (`id`);

--
-- Limiti per la tabella `center`
--
ALTER TABLE `center`
  ADD CONSTRAINT `corso` FOREIGN KEY (`id_corso`) REFERENCES `corsi` (`id`),
  ADD CONSTRAINT `sede` FOREIGN KEY (`id_sede`) REFERENCES `sedi` (`id`);

--
-- Limiti per la tabella `corsi`
--
ALTER TABLE `corsi`
  ADD CONSTRAINT `desc` FOREIGN KEY (`id_descrizione`) REFERENCES `descrizione` (`id`),
  ADD CONSTRAINT `servizi` FOREIGN KEY (`id_servizi`) REFERENCES `servizi` (`id`);

--
-- Limiti per la tabella `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `fotosedi` FOREIGN KEY (`id_sede`) REFERENCES `sedi` (`id`);

--
-- Limiti per la tabella `sedi`
--
ALTER TABLE `sedi`
  ADD CONSTRAINT `posizione` FOREIGN KEY (`id_posizione`) REFERENCES `posizione` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
