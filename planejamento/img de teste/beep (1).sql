-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 11-Jul-2022 às 12:14
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
-- Estrutura da tabela `curtidas`
--

DROP TABLE IF EXISTS `curtidas`;
CREATE TABLE IF NOT EXISTS `curtidas` (
  `id_user_curti` int(11) NOT NULL,
  `id_postagem` int(11) NOT NULL,
  KEY `id_user_curti` (`id_user_curti`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogos`
--

DROP TABLE IF EXISTS `jogos`;
CREATE TABLE IF NOT EXISTS `jogos` (
  `id_jogos` int(11) NOT NULL AUTO_INCREMENT,
  `nome_jogo` varchar(255) NOT NULL,
  `img_jogo` varchar(255) NOT NULL,
  `desc_jogo` varchar(255) NOT NULL,
  `loja` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jogos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `date_publi` datetime NOT NULL,
  `num_comentario` int(11) NOT NULL,
  PRIMARY KEY (`id_publi`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `publicacoes`
--

INSERT INTO `publicacoes` (`user_publi`, `id_publi`, `text_publi`, `img_publi`, `num_curtidas`, `num_compartilha`, `date_publi`, `num_comentario`) VALUES
(10, 2, 'meu deus kkkkkkkkkkkkkkkkkk', 'primeira\\ pub\\ tcc.png', 0, 0, '2020-04-04 00:00:00', 0),
(9, 3, 'kkkkkkkkkkkkkk', NULL, 0, 0, '2022-07-09 00:50:00', 0),
(10, 10, 'blublue...\r\n<div><br></div>\r\n<div><br></div>\r\ngay', NULL, 0, 0, '2022-07-09 00:59:41', 0),
(10, 5, NULL, 'primeira\\ pub\\ tcc.png', 0, 0, '2022-07-09 00:16:51', 0),
(11, 6, 'queria se o homem-aranha, mas meu tio não deixou -_-', NULL, 0, 0, '2022-07-08 00:00:00', 0),
(9, 7, 'to meio pá das ideia', NULL, 0, 0, '2022-07-07 23:56:00', 0),
(10, 8, 'cara pq ele é assim', 'primeira\\ pub\\ tcc.png', 0, 0, '2022-07-09 00:00:18', 0),
(10, 9, 'skskskkskskksk nem', NULL, 0, 0, '2022-07-08 23:40:00', 0),
(8, 11, 'kkk num é possivel', '', 0, 0, '0000-00-00 00:00:00', 0),
(8, 12, 'abc', 'w', 0, 0, '2022-07-10 16:21:27', 0),
(8, 13, 'tem vezes que ', '', 0, 0, '2022-07-10 16:23:31', 0),
(8, 14, 'a', '', 0, 0, '2022-07-10 16:27:34', 0),
(8, 15, 'a\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\ne', 'primeira pub tcc.png', 0, 0, '2022-07-10 15:55:17', 0),
(8, 16, 'cara que tedio ', '', 0, 0, '2022-07-10 15:01:45', 0),
(8, 17, '', '62cb14de8c389.png', 0, 0, '2022-07-10 15:05:18', 0),
(8, 18, '', '62cb14ec04828.png', 0, 0, '2022-07-10 15:05:32', 0),
(8, 20, '', '62cb152c7ffc0.png', 0, 0, '2022-07-10 16:40:00', 0),
(8, 21, 'sla to meio paia tlg \r\n.\r\n.\r\n.\r\n.\r\n.\r\n.\r\nbriks llllkkkkkk', '', 0, 0, '2022-07-10 15:09:15', 0),
(9, 22, 'kkkkkkk man olha isso aq kkkk', '62cb2ec3e077e.jpg', 0, 0, '2022-07-10 21:55:47', 0),
(8, 23, 'to morrendo kkkkkkk', '', 0, 0, '2022-07-10 17:00:28', 0),
(8, 24, 'cara nem fudendo ', '', 0, 0, '2022-07-10 17:04:00', 0),
(8, 25, 'desisto do palmeiras\r\n\r\n\r\n\r\n\r\n\r\n\r\n*torcendo pro palmeiras*', '', 0, 0, '2022-07-10 17:04:38', 0),
(22, 28, 'sozinho novamente', '', 0, 0, '2022-07-10 17:35:22', 0),
(22, 29, 'tudo bem gurizada?', '', 0, 0, '2022-07-10 17:35:42', 0),
(22, 30, 'nem judas foi tão cruel\r\n\r\n\r\n*literalmente nada aconteceu*', '', 0, 0, '2022-07-10 18:09:02', 0),
(8, 31, 'to seguindo uma galera q nem loko', '', 0, 0, '2022-07-10 19:07:43', 0),
(8, 32, 'é a união flarinthians não tem como', '', 0, 0, '2022-07-10 19:13:59', 0),
(22, 33, 'batista estava certo. Eu sou um sapo', '', 0, 0, '2022-07-10 19:24:05', 0),
(23, 34, 'cara que tedio', '62cc07356601f.jfif', 0, 0, '2022-07-11 08:19:17', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `seguidores`
--

DROP TABLE IF EXISTS `seguidores`;
CREATE TABLE IF NOT EXISTS `seguidores` (
  `user_seguin` int(11) NOT NULL,
  `user_seguido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `seguidores`
--

INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES
(8, 9),
(8, 10),
(8, 8),
(22, 22),
(8, 22),
(22, 8),
(23, 23),
(23, 9),
(23, 22),
(23, 8);

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES
(8, '@fran_pedrinhass', 2, 3, 'fran@gmail.com', 'francisco', '$2y$10$VeknT5KBG5k4yWCoVUo4fu3U2UlfCRnEOdFo7GFroPjxx/bLMTOC2', 'img_teste.png62c78ae56c952.png', 'tumblr_5cd8d34827dfa6b0be3630995ae357ee_e777277e_1280.png62c78ae56cd20.png', 'gosto de batatass e sucos de uvva', '2003-08-15', 1),
(9, '@mira_narek', 1, 0, 'mira@gmail.com', 'miranda', '$2y$10$G/Um7Dnbp5LqwnfVIJNue.D4YYgWqpWAoJcfdnkSyru/asS7WLkDe', 'test_banner.jpg62c88f2fd9885.jpg', 'tumblr_5cd8d34827dfa6b0be3630995ae357ee_e777277e_1280.png62c88f09a2180.png', 'gosto de tortas', '2002-05-06', 0),
(10, '@mate261486', 0, 0, 'ma@gmail.com', 'matehux', '$2y$10$8XBZBMQ1HCnfKs1l2oHIjO/0LHVaDBlkqPDLgDJcz549A9z8NvjhS', 'tumblr_5cd8d34827dfa6b0be3630995ae357ee_e777277e_1280.png62c78ae56cd20.png62cad38f2a9c1.png', 'img_teste.png62c88f4a801f8.png', 'mateus', '2002-05-08', 0),
(11, '@curs174410', 0, 0, 'fran_15@gmail.com', 'cursedi@gmail.com', '$2y$10$0/vK4QlYYB97tvf7WveaDeI/PjFGursRjrw1FfqkZIUAVLCarxISa', 'img_teste.png62c88102d7a86.png', 'tumblr_5cd8d34827dfa6b0be3630995ae357ee_e777277e_1280.png62c88102d7ec4.png', 'gosto de batatas ', '2001-09-16', 0),
(12, '@pedrinhas', 0, 0, 'pedrinhaskid@gmail.com', 'pedrinhasKid', '$2y$10$63p1jKZOdCUncW/38Y1LN.Z2t2K0OJYzOAjWAvzzLDA1sDn.uDFQS', '', '', '', '2008-01-15', 0),
(22, '@mira458170', 2, 1, 'mir@gmail', 'miranddd', '$2y$10$6Fv4GZG/EsRkjOCSWRdHqOI4KSt49SeAV7hKW7iH6Y7sutx9iGolm', 'background.jpg62cb37f242313.jpg', 'picture.png62cb37f246613.png', '', '2008-04-04', 1),
(23, '@mir_180322', 0, 3, 'miranda_15@gmail.com', 'mir_25', '$2y$10$5zVPQDHwN9xknn1akrGYVe5gl4vAE1eeMSc9T9R6Yo6ZkjPLAFdZ.', 'perfil.png62cc118dc5aa4.png', 'mrpowergamerbr_logo.png62cc0863638da.png', '', '2004-03-16', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
