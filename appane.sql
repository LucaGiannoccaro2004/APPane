-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ott 27, 2022 alle 16:00
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
-- Database: `appane`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `tcarrello`
--

CREATE TABLE `tcarrello` (
  `id` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idProdotto` int(11) NOT NULL,
  `quantita` int(11) NOT NULL,
  `token` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'Pane'),
(2, 'Pizze'),
(3, 'Croissant');

-- --------------------------------------------------------

--
-- Struttura della tabella `tclienti`
--

CREATE TABLE `tclienti` (
  `id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(32) NOT NULL,
  `indirizzo` varchar(100) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tclienti`
--

INSERT INTO `tclienti` (`id`, `email`, `password`, `indirizzo`, `note`) VALUES
(16, 'email-test', 'pass-test', 'valmaura', 'valmaura123'),
(19, 'test@mail', '1234', 'trieste', 'polisportivo opicina'),
(20, 'prova', '1234', 'trieste', 'opicina matta');

-- --------------------------------------------------------

--
-- Struttura della tabella `tordinidetail`
--

CREATE TABLE `tordinidetail` (
  `id` int(11) NOT NULL,
  `idProdotto` int(11) NOT NULL,
  `quantita` int(11) NOT NULL,
  `idOrdine` int(11) NOT NULL,
  `prezzo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `tordinimaster`
--

CREATE TABLE `tordinimaster` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `datains` datetime NOT NULL,
  `nota` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `tprodotti`
--

CREATE TABLE `tprodotti` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descrizione` text NOT NULL,
  `prezzo` float NOT NULL,
  `foto` varchar(255) NOT NULL,
  `abilitato` varchar(1) NOT NULL DEFAULT 's',
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tprodotti`
--

INSERT INTO `tprodotti` (`id`, `nome`, `descrizione`, `prezzo`, `foto`, `abilitato`, `idCategoria`) VALUES
(1, 'Pagnotta', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras cursus ultrices purus sed scelerisque. Phasellus augue elit, efficitur ac varius id, hendrerit nec sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel urna ultricies massa dictum rutrum. Morbi at diam tincidunt, suscipit erat eget, ultrices massa. Cras tincidunt ultricies blandit. Praesent finibus rhoncus nunc, et rutrum velit vulputate et. Nam faucibus scelerisque mattis. Fusce egestas tristique risus, non bibendum eros varius eget.', 7, 'images/pagnotta.jfif', 's', 1),
(2, 'Panini', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras cursus ultrices purus sed scelerisque. Phasellus augue elit, efficitur ac varius id, hendrerit nec sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel urna ultricies massa dictum rutrum. Morbi at diam tincidunt, suscipit erat eget, ultrices massa. Cras tincidunt ultricies blandit. Praesent finibus rhoncus nunc, et rutrum velit vulputate et. Nam faucibus scelerisque mattis. Fusce egestas tristique risus, non bibendum eros varius eget.', 3, 'images/panini.jfif', 's', 1),
(3, 'Rosette', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras cursus ultrices purus sed scelerisque. Phasellus augue elit, efficitur ac varius id, hendrerit nec sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel urna ultricies massa dictum rutrum. Morbi at diam tincidunt, suscipit erat eget, ultrices massa. Cras tincidunt ultricies blandit. Praesent finibus rhoncus nunc, et rutrum velit vulputate et. Nam faucibus scelerisque mattis. Fusce egestas tristique risus, non bibendum eros varius eget.', 2, 'images/rosette.jfif', 's', 1),
(4, 'Pane a cassetta', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras cursus ultrices purus sed scelerisque. Phasellus augue elit, efficitur ac varius id, hendrerit nec sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel urna ultricies massa dictum rutrum. Morbi at diam tincidunt, suscipit erat eget, ultrices massa. Cras tincidunt ultricies blandit. Praesent finibus rhoncus nunc, et rutrum velit vulputate et. Nam faucibus scelerisque mattis. Fusce egestas tristique risus, non bibendum eros varius eget.', 1.8, 'images/cassetta.jfif', 's', 1),
(5, 'Pizza rotonda', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras cursus ultrices purus sed scelerisque. Phasellus augue elit, efficitur ac varius id, hendrerit nec sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel urna ultricies massa dictum rutrum. Morbi at diam tincidunt, suscipit erat eget, ultrices massa. Cras tincidunt ultricies blandit. Praesent finibus rhoncus nunc, et rutrum velit vulputate et. Nam faucibus scelerisque mattis. Fusce egestas tristique risus, non bibendum eros varius eget.', 9, 'images/pizzatonda.jfif', 's', 2),
(6, 'Pizza comune', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras cursus ultrices purus sed scelerisque. Phasellus augue elit, efficitur ac varius id, hendrerit nec sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel urna ultricies massa dictum rutrum. Morbi at diam tincidunt, suscipit erat eget, ultrices massa. Cras tincidunt ultricies blandit. Praesent finibus rhoncus nunc, et rutrum velit vulputate et. Nam faucibus scelerisque mattis. Fusce egestas tristique risus, non bibendum eros varius eget.', 5, 'images/pizza.jfif', 'n', 2),
(7, 'Pizza industriale', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras cursus ultrices purus sed scelerisque. Phasellus augue elit, efficitur ac varius id, hendrerit nec sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel urna ultricies massa dictum rutrum. Morbi at diam tincidunt, suscipit erat eget, ultrices massa. Cras tincidunt ultricies blandit. Praesent finibus rhoncus nunc, et rutrum velit vulputate et. Nam faucibus scelerisque mattis. Fusce egestas tristique risus, non bibendum eros varius eget.', 2, 'images/cameo.jfif', 's', 2),
(8, 'Croissant', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras cursus ultrices purus sed scelerisque. Phasellus augue elit, efficitur ac varius id, hendrerit nec sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel urna ultricies massa dictum rutrum. Morbi at diam tincidunt, suscipit erat eget, ultrices massa. Cras tincidunt ultricies blandit. Praesent finibus rhoncus nunc, et rutrum velit vulputate et. Nam faucibus scelerisque mattis. Fusce egestas tristique risus, non bibendum eros varius eget.', 1.2, 'images/croissant.jfif', 's', 3);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `tcarrello`
--
ALTER TABLE `tcarrello`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `email` (`email`);

--
-- Indici per le tabelle `tordinidetail`
--
ALTER TABLE `tordinidetail`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tordinimaster`
--
ALTER TABLE `tordinimaster`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tprodotti`
--
ALTER TABLE `tprodotti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `tcarrello`
--
ALTER TABLE `tcarrello`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `tcategorie`
--
ALTER TABLE `tcategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `tclienti`
--
ALTER TABLE `tclienti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT per la tabella `tordinidetail`
--
ALTER TABLE `tordinidetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `tordinimaster`
--
ALTER TABLE `tordinimaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `tprodotti`
--
ALTER TABLE `tprodotti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
