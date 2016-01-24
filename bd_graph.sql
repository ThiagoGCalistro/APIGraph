-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24-Jan-2016 às 23:49
-- Versão do servidor: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_graph`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_visitantes`
--

CREATE TABLE `tb_visitantes` (
  `cod_visitante` int(11) NOT NULL,
  `quantidade_visitante` int(11) NOT NULL,
  `mes_visitante` varchar(250) NOT NULL,
  `data` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_visitantes`
--

INSERT INTO `tb_visitantes` (`cod_visitante`, `quantidade_visitante`, `mes_visitante`, `data`) VALUES
(1, 5000, 'Janeiro', 2016),
(2, 12000, 'Fevereiro', 2016),
(3, 3000, 'Março', 2016);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_visitantes`
--
ALTER TABLE `tb_visitantes`
  ADD PRIMARY KEY (`cod_visitante`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_visitantes`
--
ALTER TABLE `tb_visitantes`
  MODIFY `cod_visitante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
