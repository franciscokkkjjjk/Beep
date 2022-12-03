-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 03-Dez-2022 às 10:55
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
CREATE DATABASE IF NOT EXISTS `beep` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `beep`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms`
--

DROP TABLE IF EXISTS `adms`;
CREATE TABLE IF NOT EXISTS `adms` (
  `id_adm` int(11) NOT NULL AUTO_INCREMENT,
  `nome_adm` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `CPF` varchar(255) NOT NULL,
  `RG` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  PRIMARY KEY (`id_adm`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `adms`
--

INSERT INTO `adms` (`id_adm`, `nome_adm`, `email`, `senha`, `ativo`, `CPF`, `RG`, `estado`, `cidade`) VALUES
(1, 'teste', 'fran@gmail.com', '$2y$10$90wXWSIYgSgJ5MbCMFraJO9PxjwxcPoFDcgrAzU7FwDdh4Pdu.30C', 1, '01888847000', 1853153985, 'qualquer', 'uruguaiana');

-- --------------------------------------------------------

--
-- Estrutura da tabela `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id_user_config` int(11) NOT NULL,
  `usersVisualizarDataNascimento` tinyint(1) NOT NULL,
  `usersVisualizarCurtidas` tinyint(1) NOT NULL,
  `usersVisualizarJogos` tinyint(1) NOT NULL,
  `usersSolicitacoesJogar` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `conviteparajogos`
--

DROP TABLE IF EXISTS `conviteparajogos`;
CREATE TABLE IF NOT EXISTS `conviteparajogos` (
  `id_user_convidado` int(11) NOT NULL,
  `id_user_foi_convidado` int(11) NOT NULL,
  `data_convidado` datetime NOT NULL,
  `aceito` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curtidas`
--

DROP TABLE IF EXISTS `curtidas`;
CREATE TABLE IF NOT EXISTS `curtidas` (
  `id_user_curti` int(11) NOT NULL,
  `id_postagem` int(11) NOT NULL,
  `curtida_date` datetime DEFAULT NULL,
  KEY `id_user_curti` (`id_user_curti`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `denuncias`
--

DROP TABLE IF EXISTS `denuncias`;
CREATE TABLE IF NOT EXISTS `denuncias` (
  `id_denuncia` int(11) NOT NULL AUTO_INCREMENT,
  `post_denunciado` int(11) NOT NULL,
  `denunciador` int(11) NOT NULL,
  `motivo` int(11) NOT NULL,
  `motivo_text` text,
  PRIMARY KEY (`id_denuncia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `denuncias_user`
--

DROP TABLE IF EXISTS `denuncias_user`;
CREATE TABLE IF NOT EXISTS `denuncias_user` (
  `id_denuncia_` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_denunciado` int(11) NOT NULL,
  `quem_denunciou` int(11) NOT NULL,
  `motivo` int(11) NOT NULL,
  `motivo_text` varchar(255) NOT NULL,
  PRIMARY KEY (`id_denuncia_`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogos`
--

DROP TABLE IF EXISTS `jogos`;
CREATE TABLE IF NOT EXISTS `jogos` (
  `id_jogos` int(11) NOT NULL AUTO_INCREMENT,
  `nome_jogo` varchar(255) NOT NULL,
  `img_jogo` varchar(255) NOT NULL,
  `desc_jogo` text NOT NULL,
  `loja` varchar(255) NOT NULL,
  `link_loja` text,
  `class_etaria` int(11) NOT NULL,
  PRIMARY KEY (`id_jogos`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogos_possui`
--

DROP TABLE IF EXISTS `jogos_possui`;
CREATE TABLE IF NOT EXISTS `jogos_possui` (
  `id_user` int(11) NOT NULL,
  `id_game` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pass_recuperar`
--

DROP TABLE IF EXISTS `pass_recuperar`;
CREATE TABLE IF NOT EXISTS `pass_recuperar` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `dataExpiracao` datetime NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacao_salva`
--

DROP TABLE IF EXISTS `publicacao_salva`;
CREATE TABLE IF NOT EXISTS `publicacao_salva` (
  `id_user` int(11) NOT NULL,
  `id_publi` int(11) NOT NULL,
  `data_salva` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacoes`
--

DROP TABLE IF EXISTS `publicacoes`;
CREATE TABLE IF NOT EXISTS `publicacoes` (
  `user_publi` int(11) NOT NULL,
  `id_publi` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `id_publi_interagida` int(11) DEFAULT NULL,
  `text_publi` varchar(255) DEFAULT NULL,
  `img_publi` varchar(255) DEFAULT NULL,
  `num_curtidas` int(11) NOT NULL,
  `num_compartilha` int(11) NOT NULL,
  `date_publi` datetime NOT NULL,
  `num_comentario` int(11) NOT NULL,
  `id_game` int(11) DEFAULT NULL,
  `quarentena` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_publi`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `seguidores`
--

DROP TABLE IF EXISTS `seguidores`;
CREATE TABLE IF NOT EXISTS `seguidores` (
  `user_seguin` int(11) NOT NULL,
  `user_seguido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sobre`
--

DROP TABLE IF EXISTS `sobre`;
CREATE TABLE IF NOT EXISTS `sobre` (
  `id_user` int(11) NOT NULL,
  `type_r` int(11) NOT NULL,
  `username_rede` varchar(255) NOT NULL,
  `username_txt` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicita_list`
--

DROP TABLE IF EXISTS `solicita_list`;
CREATE TABLE IF NOT EXISTS `solicita_list` (
  `id_solicita` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_solicita` int(11) NOT NULL,
  `nome_jogo` varchar(255) NOT NULL,
  `img_jogo` varchar(255) NOT NULL,
  `desc_jogo` text NOT NULL,
  `loja` varchar(255) NOT NULL,
  `link_loja` text NOT NULL,
  `class_etaria` int(11) NOT NULL,
  `data_solicitado` datetime NOT NULL,
  `notificar` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_solicita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `status_` tinyint(1) DEFAULT NULL,
  `tempo_suspensao` datetime DEFAULT NULL,
  `data_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
