-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 05-Jul-2022 às 20:07
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `beep`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacoes`
--

DROP TABLE IF EXISTS `publicacoes`;
CREATE TABLE IF NOT EXISTS `publicacoes` (
  `user_publi` int(11) NOT NULL,
  `id_publi` int(11) NOT NULL AUTO_INCREMENT,
  `text_publi` varchar(255) DEFAULT NULL,
  `img_publi` varchar(255) DEFAULT NULL,
  `num_curtidas` int(11) NOT NULL,
  `num_compartilha` int(11) NOT NULL,
  `date_publi` varchar(255) NOT NULL,
  `num_comentario` int(11) NOT NULL,
  PRIMARY KEY (`id_publi`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `t_seguidores` int(11) NOT NULL,
  `t_seguindo` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `banner_pefil` varchar(255) DEFAULT NULL,
  `bio` text,
  `data_nas` varchar(255) NOT NULL,
  `status_` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES
(1, '@teste_users', 0, 0, 'test@gmail.com', 'testes', '6f2268bd1d3d3ebaabb04d6b5d099425', 'transferir.jfif62c48b75547b1.jfif', 'mrpowergamerbr_logo.png62c48bd72c68e.png', 'tem vezes que ', '2002-05-06', 0),
(2, '@pedr_15', 1000, 15, 'pedrinha@gmail.com', 'pedro ', '6f2268bd1d3d3ebaabb04d6b5d099425', 'transferir.jfif62c48c10dffba.jfif', 'mrpowergamerbr_logo.png62c48c10e056b.png', 'otaku *-*', '1999-04-10', 1),
(3, '@edua243177', 0, 0, 'marinha@gmail.com', 'eduardo', '6f2268bd1d3d3ebaabb04d6b5d099425', NULL, NULL, NULL, '2001-05-06', 0),
(4, '@pedrinhuis_maranha', 0, 0, 'cursedi@gmail.com', 'cursedi', '6f2268bd1d3d3ebaabb04d6b5d099425', '', '', 'o individuo Ã© apenas um.', '2002-04-15', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
