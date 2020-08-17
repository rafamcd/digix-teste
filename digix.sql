-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16-Ago-2020 às 04:54
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `digix`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `familia`
--

CREATE TABLE IF NOT EXISTS `familia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `possuiCasa` tinyint(1) NOT NULL COMMENT '0 - NÃO // 1 - SIM',
  `participaOutroProcesso` tinyint(1) NOT NULL COMMENT '0 - NÃO // 1 - SIM',
  `familiaContemplada` tinyint(1) NOT NULL COMMENT '0 - NÃO // 1 - SIM',
  `pontuacaoTotal` int(11) DEFAULT NULL,
  `rendaTotal` float DEFAULT NULL,
  `qtd_dependentes` int(11) DEFAULT NULL,
  `qtd_requisitos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Extraindo dados da tabela `familia`
--

INSERT INTO `familia` (`id`, `possuiCasa`, `participaOutroProcesso`, `familiaContemplada`, `pontuacaoTotal`, `rendaTotal`, `qtd_dependentes`, `qtd_requisitos`) VALUES
(1, 0, 0, 0, 2, 3500.5, 0, 1),
(15, 0, 0, 0, 3, 2300.5, 0, 1),
(16, 1, 0, 0, 5, 4151.05, 1, 2),
(17, 0, 0, 0, 2, 5000, 0, 1),
(18, 1, 0, 0, 2, 1500.5, 2, 1),
(20, 0, 0, 0, 8, 500, 0, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `familiacontemplada`
--

CREATE TABLE IF NOT EXISTS `familiacontemplada` (
  `id` int(11) NOT NULL,
  `id_familia` int(11) NOT NULL,
  `qtdCriteriosAtendidos` int(11) NOT NULL,
  `pontuacaoTotal` int(11) NOT NULL,
  `dataContemplacao` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `familiacontemplada`
--

INSERT INTO `familiacontemplada` (`id`, `id_familia`, `qtdCriteriosAtendidos`, `pontuacaoTotal`, `dataContemplacao`) VALUES
(1, 1, 5, 25, '2020-08-14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `familiapessoas`
--

CREATE TABLE IF NOT EXISTS `familiapessoas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_familia` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Extraindo dados da tabela `familiapessoas`
--

INSERT INTO `familiapessoas` (`id`, `id_familia`, `id_pessoa`) VALUES
(1, 1, 1),
(29, 15, 3),
(30, 15, 4),
(31, 16, 6),
(32, 16, 5),
(33, 16, 7),
(34, 17, 11),
(35, 18, 12),
(36, 18, 13),
(37, 18, 14),
(38, 18, 15),
(40, 20, 16);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo_usuarios`
--

CREATE TABLE IF NOT EXISTS `grupo_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL COMMENT '//Administrador // Funcionario // Cliente',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `grupo_usuarios`
--

INSERT INTO `grupo_usuarios` (`id`, `descricao`) VALUES
(1, 'Administrador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `tipo` tinyint(4) NOT NULL COMMENT '1 - Site / 2 - Painel',
  `url` varchar(100) DEFAULT NULL,
  `class_bootstrap` varchar(100) DEFAULT NULL,
  `ordem` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `menu`
--

INSERT INTO `menu` (`id`, `descricao`, `tipo`, `url`, `class_bootstrap`, `ordem`) VALUES
(2, 'Pessoa', 2, 'pessoa', 'fa fa-user', 2),
(3, 'Família', 2, 'familia', 'fa fa-users', 3),
(4, 'Contemplados', 2, 'contemplados', 'fa fa-check', 4),
(5, 'Regras', 2, 'regras', 'fa fa-gavel', 5),
(6, 'Sair', 2, 'login/logout', 'fa fa-sign-out', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

CREATE TABLE IF NOT EXISTS `permissao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `id_grupousuarios` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=164 ;

--
-- Extraindo dados da tabela `permissao`
--

INSERT INTO `permissao` (`id`, `id_menu`, `id_grupousuarios`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE IF NOT EXISTS `pessoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `fone` varchar(25) DEFAULT NULL,
  `data_nascimento` date NOT NULL,
  `idade` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `renda` float DEFAULT NULL,
  `tipo` tinyint(1) NOT NULL COMMENT '0 - Pretendente // 1 - Conjugue // 2 - Dependente',
  `possui_familia` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id`, `nome`, `fone`, `data_nascimento`, `idade`, `email`, `imagem`, `renda`, `tipo`, `possui_familia`) VALUES
(1, 'Rafael Mascarenhas Custódio Dias', '(67) 99996-0574', '1988-02-20', 32, 'rafamcd@gmail.com', '5f80ca6c58889dfbaf309c377ebd57cb.jpg', 3892.5, 0, 1),
(3, 'Alberto Custódio Dias', '(67) 99657-5121', '1957-06-17', 63, 'albertocdias@hotmail.com', '666e9c1db9babf5bee08230ac58b2eff.jpg', 1200.5, 0, 1),
(4, 'Jane Grace Mascarenhas Dias', '(67) 99962-6958', '1956-11-22', 63, 'janedias@teste.com', 'c885dfe2b659217124428eafa5beee35.jpg', 1100, 1, 1),
(5, 'Arleide Zerbato', '(67) 99645-2020', '1975-12-22', 44, 'arleidezerbato@teste.com', 'noimage.jpg', 1050.3, 1, 1),
(6, 'Dorival Crippa', '(67) 99875-2194', '1970-05-15', 50, 'dorival@teste.com', 'noimage.jpg', 1800.75, 0, 1),
(7, 'Bruno Zerbato', '(67) 99929-5451', '2015-08-22', 4, 'brunoz@teste.com', 'noimage.jpg', 1300, 2, 1),
(11, 'João da silva', '(67) 32917-4786', '1980-01-17', 40, 'teste@teste.com.br', 'noimage.jpg', 5000, 0, 1),
(12, 'Rubens Cacio', '(67) 99945-5555', '1975-03-20', 45, 'teste@teste.com', 'noimage.jpg', 1000, 0, 1),
(13, 'Roseli Schio', '(67) 99988-9778', '1975-05-15', 45, 'teste@teste.com.br', 'noimage.jpg', 300, 1, 1),
(14, 'Ari Antonio Schio', '(67) 94516-5444', '2015-05-15', 5, 'teste@teste.com.br', 'noimage.jpg', 100, 2, 1),
(15, 'Leopoldina Schio', '(67) 32915-4454', '2017-05-15', 3, 'teste@teste.com.br', 'noimage.jpg', 100.5, 2, 1),
(16, 'Teste nova pessoa', '(67) 21215-1515', '1970-10-04', 49, 'teste@hotmail.com', 'noimage.jpg', 500, 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `regraspontuacao`
--

CREATE TABLE IF NOT EXISTS `regraspontuacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tabela` varchar(100) NOT NULL,
  `campo` varchar(100) NOT NULL,
  `sinal` varchar(100) NOT NULL,
  `valor1` varchar(100) NOT NULL,
  `valor2` varchar(100) DEFAULT NULL,
  `pontos` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `regraspontuacao`
--

INSERT INTO `regraspontuacao` (`id`, `tabela`, `campo`, `sinal`, `valor1`, `valor2`, `pontos`) VALUES
(1, 'familia', 'rendaTotal', 'menor', '901', NULL, 5),
(2, 'familia', 'rendaTotal', 'entre', '901', '1500', 3),
(3, 'familia', 'rendaTotal', 'entre', '1501', '2000', 1),
(4, 'pessoa', 'idade', 'maior', '45', NULL, 3),
(5, 'pessoa', 'idade', 'entre', '30', '44', 2),
(6, 'pessoa', 'idade', 'menor', '30', NULL, 1),
(7, 'familia', 'qtd_dependentes', 'maior', '2', NULL, 3),
(11, 'familia', 'qtd_dependentes', 'entre', '1', '2', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sub_menu`
--

CREATE TABLE IF NOT EXISTS `sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_funcionario` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `user` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `grupo_usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `id_funcionario`, `id_cliente`, `user`, `senha`, `imagem`, `grupo_usuario_id`) VALUES
(1, 3, 0, 'rafamcd', 'df94d8c45d6c5cd98f2833961d40df13', 'd7e2394fc1219c4fb89634c511a46226.jpg', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
