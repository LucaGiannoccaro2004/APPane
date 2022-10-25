-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ott 25, 2022 alle 22:50
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `giannoccaro`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `tcategorie`
--

CREATE TABLE `tcategorie` (
  `id` int(11) NOT NULL,
  `categoria` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tcategorie`
--

INSERT INTO `tcategorie` (`id`, `categoria`) VALUES
(13, 'Pane'),
(15, 'Focacce'),
(16, 'Dolci'),
(23, 'Cani'),
(24, 'Gatti'),
(25, 'Pesci');

-- --------------------------------------------------------

--
-- Struttura della tabella `tclienti`
--

CREATE TABLE `tclienti` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `indirizzo` int(64) NOT NULL,
  `note` text NOT NULL,
  `tipoUtentiId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tclienti`
--

INSERT INTO `tclienti` (`id`, `email`, `password`, `indirizzo`, `note`, `tipoUtentiId`) VALUES
(2, 'test@test.com', '098f6bcd4621d373cade4e832627b4f6', 0, 'Non so programmare', 1),
(3, 'admin@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 0, 'admin', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `tingredienti`
--

CREATE TABLE `tingredienti` (
  `id` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tingredienti`
--

INSERT INTO `tingredienti` (`id`, `nome`, `descrizione`) VALUES
(3, 'Lievito madre', 'naturale'),
(4, 'Farina', 'Tipo 00'),
(6, 'Sale', 'buono'),
(7, 'Farina di segale', 'buona'),
(8, 'Farina integrale', 'buonissima'),
(9, 'Acqua', 'Del rubinetto di casa');

-- --------------------------------------------------------

--
-- Struttura della tabella `tricette`
--

CREATE TABLE `tricette` (
  `id` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `descrizione` text NOT NULL,
  `prezzo` varchar(32) NOT NULL,
  `stato` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tricette`
--

INSERT INTO `tricette` (`id`, `idCategoria`, `nome`, `descrizione`, `prezzo`, `stato`) VALUES
(1, 13, 'Pane Biango', 'buono', '3,50', 0),
(2, 15, 'Pane Integrale', 'asdfa', '3,50', 0),
(3, 25, 'Pane Segale', 'asdfadrhsdfg', '3,50', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `tricette_x_tingredienti`
--

CREATE TABLE `tricette_x_tingredienti` (
  `id` int(11) NOT NULL,
  `idRicetta` int(11) NOT NULL,
  `idIngrediente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tricette_x_tingredienti`
--

INSERT INTO `tricette_x_tingredienti` (`id`, `idRicetta`, `idIngrediente`) VALUES
(1, 1, 9),
(2, 1, 4),
(3, 1, 6),
(4, 1, 3),
(5, 2, 9),
(6, 2, 8),
(7, 2, 3),
(8, 2, 3),
(9, 3, 9),
(10, 3, 6),
(11, 3, 6),
(12, 3, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `tsessioni`
--

CREATE TABLE `tsessioni` (
  `id` int(11) NOT NULL,
  `clienteId` int(11) NOT NULL,
  `token` varchar(32) NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tsessioni`
--

INSERT INTO `tsessioni` (`id`, `clienteId`, `token`, `timestamp`) VALUES
(1, 2, 'b8c163ade0d50d7aa3404f430febe924', '2022-10-19'),
(2, 2, 'b1b73e34fa9dbecdaae52fbb44cb676e', '2022-10-19'),
(3, 2, '47afb1da906033cd6b7148837ebd4980', '2022-10-19'),
(4, 2, 'c7b9abad40a372ea1a20a1afbb5379dc', '2022-10-19'),
(5, 2, 'e409d8482e143de945eaffadf27acfce', '2022-10-19'),
(6, 2, '2079c6c843a867fade798149c15a1026', '2022-10-19'),
(7, 2, 'a8fc6d6517bf13b097df0179614056d7', '2022-10-19'),
(8, 2, '36c6e5a4ffded023c2cfc29c6935d9b2', '2022-10-19'),
(9, 2, '928df0289fa7ace8e958e01adbb0a275', '2022-10-19'),
(10, 2, 'a4251c8c8d1c2643f732d0bdbeccf643', '2022-10-19'),
(11, 2, 'fdc6c3872f3d6f9d189ef139ef76f4b8', '2022-10-19'),
(12, 2, 'df87b7fff385f890c444b94588ba89eb', '2022-10-19'),
(13, 2, 'c8b4ac719f1a2b0ebec47bef0050d36b', '2022-10-19'),
(14, 2, 'a20e19eb2aac175b79245a5fb7759f21', '2022-10-19'),
(15, 2, '6b3db38ba1dcf3fd0eb79825bc6b0431', '2022-10-19'),
(16, 2, 'a8242c428bfde660a088a764434aa8d2', '2022-10-19'),
(17, 2, '3d03b1268532b1281a0878cc1e654c48', '2022-10-19'),
(18, 3, 'ee7d5edaf4c4466ff1da610930aeb6be', '2022-10-19'),
(19, 3, '4375da65a00a278e809ec06d4812da28', '2022-10-19'),
(20, 3, '19841c8164473881ea8d2f305330b985', '2022-10-19'),
(21, 3, 'e0b00bf32c1c732d27a3f02b293541d0', '2022-10-20'),
(22, 2, '1fa4530daae55d642d42b1896482fee9', '2022-10-20');

-- --------------------------------------------------------

--
-- Struttura della tabella `ttipoutenti`
--

CREATE TABLE `ttipoutenti` (
  `id` int(11) NOT NULL,
  `tipo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ttipoutenti`
--

INSERT INTO `ttipoutenti` (`id`, `tipo`) VALUES
(1, 'User'),
(2, 'Admin');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `tcategorie`
--
ALTER TABLE `tcategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tclienti`
--
ALTER TABLE `tclienti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipoUtentiId` (`tipoUtentiId`);

--
-- Indici per le tabelle `tingredienti`
--
ALTER TABLE `tingredienti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tricette`
--
ALTER TABLE `tricette`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Indici per le tabelle `tricette_x_tingredienti`
--
ALTER TABLE `tricette_x_tingredienti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idRicetta` (`idRicetta`),
  ADD KEY `idIngrediente` (`idIngrediente`);

--
-- Indici per le tabelle `tsessioni`
--
ALTER TABLE `tsessioni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clienteId` (`clienteId`);

--
-- Indici per le tabelle `ttipoutenti`
--
ALTER TABLE `ttipoutenti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `tcategorie`
--
ALTER TABLE `tcategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT per la tabella `tclienti`
--
ALTER TABLE `tclienti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `tingredienti`
--
ALTER TABLE `tingredienti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `tricette`
--
ALTER TABLE `tricette`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `tricette_x_tingredienti`
--
ALTER TABLE `tricette_x_tingredienti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `tsessioni`
--
ALTER TABLE `tsessioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT per la tabella `ttipoutenti`
--
ALTER TABLE `ttipoutenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `tclienti`
--
ALTER TABLE `tclienti`
  ADD CONSTRAINT `tipoUtentiId` FOREIGN KEY (`tipoUtentiId`) REFERENCES `ttipoutenti` (`id`);

--
-- Limiti per la tabella `tricette`
--
ALTER TABLE `tricette`
  ADD CONSTRAINT `idCategoria` FOREIGN KEY (`idCategoria`) REFERENCES `tcategorie` (`id`);

--
-- Limiti per la tabella `tricette_x_tingredienti`
--
ALTER TABLE `tricette_x_tingredienti`
  ADD CONSTRAINT `idIngrediente` FOREIGN KEY (`idIngrediente`) REFERENCES `tingredienti` (`id`),
  ADD CONSTRAINT `idRicetta` FOREIGN KEY (`idRicetta`) REFERENCES `tricette` (`id`);

--
-- Limiti per la tabella `tsessioni`
--
ALTER TABLE `tsessioni`
  ADD CONSTRAINT `clienteId` FOREIGN KEY (`clienteId`) REFERENCES `tclienti` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
