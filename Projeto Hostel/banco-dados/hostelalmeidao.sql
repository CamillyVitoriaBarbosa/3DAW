-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 25/11/2024 às 14:17
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `hostelalmeidao`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `Login`
--

CREATE TABLE `Login` (
  `ID` int(11) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Senha` varchar(10) NOT NULL,
  `ADM` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `Login`
--

INSERT INTO `Login` (`ID`, `Email`, `Senha`, `ADM`) VALUES
(1, 'adm@hostelalmeidao', 'adm123', 1),
(2, 'usuario@gmail.com', 'adm123', NULL);

--
-- Índices de tabela `Login`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `Quartos`
--

CREATE TABLE `Quartos` (
  `Nome` varchar(20) NOT NULL,
  `Número de camas` int(11) NOT NULL,
  `Tipo de cama` varchar(10) NOT NULL,
  `Contém` text NOT NULL,
  `Preço` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `Quartos`
--

INSERT INTO `Quartos` (`Nome`, `Número de camas`, `Tipo de cama`, `Contém`, `Preço`) VALUES
('Quarto para 4', 4, 'Solteiro', 'Ar condicionado, Armário, Cozinha, Wi-fi, Serviço de Quarto, Lavanderia e Televisão', 200),
('Quarto para 8', 8, 'Solteiro', 'Ar Condicionado, Armário, Cozinha, Wi-fi, Serviço de Quarto, Lavanderia e Televisão.', 150),
('Quarto para 12', 12, 'Solteiro', 'Ar Condicionado, Armário, Cozinha, Wi-fi, Serviço de Quarto, Lavanderia e Televisão.', 100);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `Login`
--
ALTER TABLE `Login`
  ADD PRIMARY KEY (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
