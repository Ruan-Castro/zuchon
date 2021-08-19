-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Ago-2021 às 19:09
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
  `PRIORIDADE` varchar(20) NOT NULL,
  `DTABERTURA` datetime NOT NULL,
  `DTENCERRAMENTO` datetime DEFAULT NULL,
  `TECNICO` int(11) NOT NULL,
  `USUARIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `chamado`
--

INSERT INTO `chamado` (`ID`, `RESUMO`, `SOLICITACAO`, `PRIORIDADE`, `DTABERTURA`, `DTENCERRAMENTO`, `TECNICO`, `USUARIO`) VALUES
(1, 'TESTE', 'COMPRA DE CABO DE REDE DE TESTE', 'estrategico', '2021-08-06 17:10:21', '2021-08-16 16:38:29', 1, 1),
(2, '$resumo', '$solicitacao', 'trivial', '2021-08-12 12:08:09', '2021-08-12 12:09:38', 1, 3),
(3, 'Computador parou', 'Teste', 'trivial', '2021-08-12 12:08:39', NULL, 0, 4),
(4, 'Rede não está funcionando', 'Miau', 'estrategico', '2021-08-12 12:30:51', NULL, 0, 4),
(5, 'Sistema não loga', 'ticket', 'estrategico', '2021-08-12 13:53:02', NULL, 0, 4),
(6, 'Teste de Rede', 'Por favor, realizar teste de rede nos computadores da recepção.', 'tecnico', '2021-08-16 13:29:44', NULL, 1, 4),
(7, 'Teste de ticket', 'Olá', 'trivial', '2021-08-16 14:28:58', NULL, 0, 2),
(8, 'Teste', 'teste', 'trivial', '2021-08-16 14:40:17', '2021-08-16 16:38:37', 2, 3),
(9, 'Teste', 'asfgasg', 'trivial', '2021-08-16 14:46:12', '2021-08-16 16:38:40', 0, 2),
(10, 'teste', 'teste', 'trivial', '2021-08-16 14:49:38', '2021-08-16 16:38:42', 0, 2),
(11, 'teste', 'teste', 'estrategico', '2021-08-16 14:57:48', '2021-08-16 16:38:44', 0, 4),
(12, 'Teste', 'teste', 'estrategico', '2021-08-16 16:29:43', '2021-08-16 16:38:48', 0, 2),
(13, 'Teste', 'teste', 'tecnico', '2021-08-16 16:30:29', '2021-08-16 16:38:51', 0, 2),
(14, 'teste2', 'teste', '', '2021-08-16 16:34:22', '2021-08-16 16:38:53', 0, 2),
(15, 'Bla', 'blagblalbalblab labl lab labl l abl abl lab la bl lab labl la blabllab lab lla b lab la bll ab lab lal bblagblalbalblab labl lab labl l abl abl lab la bl lab labl la blabllab lab lla b lab la bll ab lab lal bblagblalbalblab labl lab labl l abl abl lab la bl lab labl la blabllab lab lla b lab la bll ab lab lal bblagblalbalblab labl lab labl l abl abl lab la bl lab labl la blabllab lab lla b lab la bll ab lab lal bblagblalbalblab labl lab labl l abl abl lab la bl lab labl la blabllab lab lla b lab', 'estrategico', '2021-08-16 17:59:21', NULL, 0, 2);

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
(5, 'Administrador do Sis'),
(1, 'Usuário Comum'),
(4, 'Diretoria');

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
(1, 'T.I.'),
(2, 'DIRETORIA'),
(0, 'Comercial'),
(3, 'RH');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sexo`
--

CREATE TABLE `sexo` (
  `sexo` varchar(20) NOT NULL,
  `codsexo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `sexo`
--

INSERT INTO `sexo` (`sexo`, `codsexo`) VALUES
('Masculino', 0),
('Feminino', 1),
('Outro', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tecnicos`
--

CREATE TABLE `tecnicos` (
  `ID` int(11) NOT NULL,
  `Tecnico` varchar(30) NOT NULL,
  `sexo` int(1) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(16) NOT NULL,
  `NA` int(2) NOT NULL,
  `setor` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tecnicos`
--

INSERT INTO `tecnicos` (`ID`, `Tecnico`, `sexo`, `usuario`, `senha`, `NA`, `setor`) VALUES
(0, '', 0, 'não apagar', '02E91JD08DJ08R3J', 1, 1),
(1, 'Lane Santos', 1, 'lane.santos', 'password', 5, 1),
(2, 'Antonio Marcos', 0, 'zuchon', 'password', 5, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usu`
--

CREATE TABLE `usu` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `sexo` int(1) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(16) NOT NULL,
  `NA` int(2) NOT NULL,
  `SETOR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usu`
--

INSERT INTO `usu` (`ID`, `Nome`, `sexo`, `usuario`, `senha`, `NA`, `SETOR`) VALUES
(1, 'Lane Santos', 1, 'edvania', 'senha', 5, 1),
(2, 'Antonio Marcos', 0, 'marcos.castro', 'password', 5, 1),
(3, 'Comercial', 0, 'comercial', 'senha', 1, 0),
(4, 'Rodrigo', 0, 'rodrigo', 'senha', 4, 2),
(5, 'Edvânia', 1, 'edvania', 'senha', 1, 3);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `chamado`
--
ALTER TABLE `chamado`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `tecnicos`
--
ALTER TABLE `tecnicos`
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `tecnicos`
--
ALTER TABLE `tecnicos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usu`
--
ALTER TABLE `usu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
