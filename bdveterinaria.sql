-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/05/2024 às 03:06
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
-- Banco de dados: `bdveterinaria`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbanimal`
--

CREATE TABLE `tbanimal` (
  `codAnimal` int(11) NOT NULL,
  `nomeAnimal` varchar(100) NOT NULL,
  `fotoAnimal` varchar(255) DEFAULT NULL,
  `codTipoAnimal` int(11) DEFAULT NULL,
  `codCliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbanimal`
--

INSERT INTO `tbanimal` (`codAnimal`, `nomeAnimal`, `fotoAnimal`, `codTipoAnimal`, `codCliente`) VALUES
(1, 'Tom', 'tom.jpg', 1, 2),
(2, 'Spike', 'spike.jpg', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbatendimento`
--

CREATE TABLE `tbatendimento` (
  `codAtendimento` int(11) NOT NULL,
  `DataAtendimento` date NOT NULL,
  `HoraAtendimento` time NOT NULL,
  `codAnimal` int(11) DEFAULT NULL,
  `codVet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbatendimento`
--

INSERT INTO `tbatendimento` (`codAtendimento`, `DataAtendimento`, `HoraAtendimento`, `codAnimal`, `codVet`) VALUES
(3, '2024-08-30', '15:30:00', 1, 1),
(4, '2024-05-24', '16:45:00', 2, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbcliente`
--

CREATE TABLE `tbcliente` (
  `codCliente` int(11) NOT NULL,
  `nomeCliente` varchar(100) NOT NULL,
  `telefoneCliente` varchar(20) DEFAULT NULL,
  `EmailCliente` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbcliente`
--

INSERT INTO `tbcliente` (`codCliente`, `nomeCliente`, `telefoneCliente`, `EmailCliente`) VALUES
(1, 'Carlos', '11996524367', 'carlos13@gmail.com'),
(2, 'Maria', '11954623574', 'Maria8@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbtipoanimal`
--

CREATE TABLE `tbtipoanimal` (
  `codTipoAnimal` int(11) NOT NULL,
  `tipoAnimal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbtipoanimal`
--

INSERT INTO `tbtipoanimal` (`codTipoAnimal`, `tipoAnimal`) VALUES
(1, 'Gato'),
(2, 'Cachorro'),
(3, 'Porco');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbveterinario`
--

CREATE TABLE `tbveterinario` (
  `codVet` int(11) NOT NULL,
  `nomeVet` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbveterinario`
--

INSERT INTO `tbveterinario` (`codVet`, `nomeVet`) VALUES
(1, 'Jorge'),
(2, 'Matheus');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbanimal`
--
ALTER TABLE `tbanimal`
  ADD PRIMARY KEY (`codAnimal`),
  ADD KEY `codTipoAnimal` (`codTipoAnimal`),
  ADD KEY `codCliente` (`codCliente`);

--
-- Índices de tabela `tbatendimento`
--
ALTER TABLE `tbatendimento`
  ADD PRIMARY KEY (`codAtendimento`),
  ADD KEY `codAnimal` (`codAnimal`),
  ADD KEY `codVet` (`codVet`);

--
-- Índices de tabela `tbcliente`
--
ALTER TABLE `tbcliente`
  ADD PRIMARY KEY (`codCliente`);

--
-- Índices de tabela `tbtipoanimal`
--
ALTER TABLE `tbtipoanimal`
  ADD PRIMARY KEY (`codTipoAnimal`);

--
-- Índices de tabela `tbveterinario`
--
ALTER TABLE `tbveterinario`
  ADD PRIMARY KEY (`codVet`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbanimal`
--
ALTER TABLE `tbanimal`
  MODIFY `codAnimal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbatendimento`
--
ALTER TABLE `tbatendimento`
  MODIFY `codAtendimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tbcliente`
--
ALTER TABLE `tbcliente`
  MODIFY `codCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbtipoanimal`
--
ALTER TABLE `tbtipoanimal`
  MODIFY `codTipoAnimal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbveterinario`
--
ALTER TABLE `tbveterinario`
  MODIFY `codVet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tbanimal`
--
ALTER TABLE `tbanimal`
  ADD CONSTRAINT `tbanimal_ibfk_1` FOREIGN KEY (`codTipoAnimal`) REFERENCES `tbtipoanimal` (`codTipoAnimal`),
  ADD CONSTRAINT `tbanimal_ibfk_2` FOREIGN KEY (`codCliente`) REFERENCES `tbcliente` (`codCliente`);

--
-- Restrições para tabelas `tbatendimento`
--
ALTER TABLE `tbatendimento`
  ADD CONSTRAINT `tbatendimento_ibfk_1` FOREIGN KEY (`codAnimal`) REFERENCES `tbanimal` (`codAnimal`),
  ADD CONSTRAINT `tbatendimento_ibfk_2` FOREIGN KEY (`codVet`) REFERENCES `tbveterinario` (`codVet`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
