-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Ago-2021 às 23:03
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `zuchon`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamado`
--

CREATE TABLE `chamado` (
  `ID` int(11) NOT NULL,
  `RESUMO` varchar(30) NOT NULL,
  `SOLICITACAO` varchar(500) NOT NULL,
  `DTABERTURA` datetime NOT NULL,
  `DTENCERRAMENTO` datetime DEFAULT NULL,
  `TECNICO` int(11) NOT NULL,
  `USUARIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `chamado`
--

INSERT INTO `chamado` (`ID`, `RESUMO`, `SOLICITACAO`, `DTABERTURA`, `DTENCERRAMENTO`, `TECNICO`, `USUARIO`) VALUES
(1, 'TESTE', 'COMPRA DE CABO DE REDE DE TESTE', '2021-08-06 17:10:21', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `nivel_acesso`
--

CREATE TABLE `nivel_acesso` (
  `CODACESSO` int(2) NOT NULL,
  `NOMEACESSO` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `nivel_acesso`
--

INSERT INTO `nivel_acesso` (`CODACESSO`, `NOMEACESSO`) VALUES
(5, 'Administrador do Sis');

-- --------------------------------------------------------

--
-- Estrutura da tabela `setor`
--

CREATE TABLE `setor` (
  `CODSETOR` int(3) NOT NULL,
  `NOMESETOR` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `setor`
--

INSERT INTO `setor` (`CODSETOR`, `NOMESETOR`) VALUES
(1, 'T.I.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usu`
--

CREATE TABLE `usu` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(16) NOT NULL,
  `NA` int(2) NOT NULL,
  `SETOR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usu`
--

INSERT INTO `usu` (`ID`, `Nome`, `usuario`, `senha`, `NA`, `SETOR`) VALUES
(1, 'Administrador', 'admin', 'administrador', 5, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `chamado`
--
ALTER TABLE `chamado`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `usu`
--
ALTER TABLE `usu`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chamado`
--
ALTER TABLE `chamado`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usu`
--
ALTER TABLE `usu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
