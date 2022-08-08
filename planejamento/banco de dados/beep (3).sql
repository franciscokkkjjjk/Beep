-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 08-Ago-2022 às 22:40
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
CREATE DATABASE IF NOT EXISTS `beep` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `beep`;

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

--
-- Extraindo dados da tabela `curtidas`
--

INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(9, 205, '2022-07-19 20:27:24');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(9, 47, '2022-07-19 20:35:04');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(9, 204, '2022-07-19 20:42:19');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(9, 203, '2022-07-19 20:42:25');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(8, 217, '2022-07-20 22:32:59');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(8, 220, '2022-07-20 22:34:01');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(8, 180, '2022-07-20 22:45:05');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(8, 225, '2022-07-21 13:51:48');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(8, 223, '2022-07-21 17:02:52');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(8, 219, '2022-07-21 17:03:03');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(8, 218, '2022-07-21 17:03:05');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(8, 210, '2022-07-21 17:03:09');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(8, 209, '2022-07-21 17:03:11');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(8, 208, '2022-07-21 17:03:13');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(8, 207, '2022-07-21 17:03:14');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(8, 205, '2022-07-21 17:03:15');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(8, 192, '2022-07-21 18:41:15');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(8, 47, '2022-07-21 18:41:38');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(8, 333, '2022-07-27 20:13:04');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(8, 70, '2022-07-30 14:40:37');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(8, 292, '2022-07-31 21:02:11');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(8, 348, '2022-08-01 21:36:23');
INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES(9, 223, '2022-08-03 20:11:58');

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
  `type` int(11) NOT NULL,
  `id_publi_interagida` int(11) DEFAULT NULL,
  `text_publi` varchar(255) DEFAULT NULL,
  `img_publi` varchar(255) DEFAULT NULL,
  `num_curtidas` int(11) NOT NULL,
  `num_compartilha` int(11) NOT NULL,
  `date_publi` datetime NOT NULL,
  `num_comentario` int(11) NOT NULL,
  PRIMARY KEY (`id_publi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

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

INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(8, 8);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(22, 22);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(22, 8);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(23, 23);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(23, 9);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(23, 22);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(23, 8);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(22, 10);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(24, 24);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(9, 24);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(25, 25);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(9, 25);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(26, 26);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(26, 9);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(10, 8);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(27, 27);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(28, 28);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(28, 24);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(29, 29);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(30, 30);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(29, 25);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(29, 9);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(29, 24);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(29, 26);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(31, 31);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(22, 9);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(22, 31);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(22, 12);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(22, 24);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(32, 32);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(9, 22);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(9, 8);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(9, 12);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(29, 10);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(12, 10);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(9, 10);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(33, 33);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(8, 9);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(8, 10);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(8, 12);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(8, 22);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(9, 32);
INSERT INTO `seguidores` (`user_seguin`, `user_seguido`) VALUES(8, 24);

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES(8, '@fran_pedrinhas', 4, 5, 'fran@gmail.com', 'franciscos', '$2y$10$VeknT5KBG5k4yWCoVUo4fu3U2UlfCRnEOdFo7GFroPjxx/bLMTOC2', '62d6d7e37f319.png', '62d6d80302e72.jpg', 'gosto de suco de uva | desempregado profissional', '2003-08-15', 1);
INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES(9, '@mira_narek', 6, 7, 'mira@gmail.com', 'miranda', '$2y$10$G/Um7Dnbp5LqwnfVIJNue.D4YYgWqpWAoJcfdnkSyru/asS7WLkDe', 'test_banner.jpg62c88f2fd9885.jpg', '62e16edd2f227.jpg', 'gosto de tortas', '2002-05-06', 0);
INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES(10, '@mate261486', 5, 1, 'ma@gmail.com', 'matehux', '$2y$10$8XBZBMQ1HCnfKs1l2oHIjO/0LHVaDBlkqPDLgDJcz549A9z8NvjhS', 'tumblr_5cd8d34827dfa6b0be3630995ae357ee_e777277e_1280.png62c78ae56cd20.png62cad38f2a9c1.png', 'img_teste.png62c88f4a801f8.png', 'mateus', '2002-05-08', 1);
INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES(11, '@marinha', 0, 0, 'fran_15@gmail.com', 'cursedi', '$2y$10$0/vK4QlYYB97tvf7WveaDeI/PjFGursRjrw1FfqkZIUAVLCarxISa', 'img_teste.png62c88102d7a86.png', 'tumblr_5cd8d34827dfa6b0be3630995ae357ee_e777277e_1280.png62c88102d7ec4.png', 'gosto de batatas', '2001-09-16', 0);
INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES(12, '@pedrinhas', 3, 1, 'pedrinhaskid@gmail.com', 'pedrinhasKid', '$2y$10$63p1jKZOdCUncW/38Y1LN.Z2t2K0OJYzOAjWAvzzLDA1sDn.uDFQS', '', '', '', '2008-01-15', 1);
INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES(22, '@mira458170', 3, 6, 'mir@gmail', 'miranddd', '$2y$10$6Fv4GZG/EsRkjOCSWRdHqOI4KSt49SeAV7hKW7iH6Y7sutx9iGolm', 'background.jpg62cb37f242313.jpg', 'picture.png62cb37f246613.png', '', '2008-04-04', 0);
INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES(23, '@mir_180322', 0, 3, 'miranda_15@gmail.com', 'mir_25', '$2y$10$5zVPQDHwN9xknn1akrGYVe5gl4vAE1eeMSc9T9R6Yo6ZkjPLAFdZ.', 'perfil.png62cc118dc5aa4.png', 'mrpowergamerbr_logo.png62cc0863638da.png', '', '2004-03-16', 0);
INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES(24, '@Dial168933', 5, 0, 'dialogo@mail.com', 'DialogosCurtos', '$2y$10$mHnF9TpwOsFy9L/DdXHCseQ6y.oel1nEXbgV.xqfNLtmO/Fvq8JYm', 'NfFcH3ZG_400x400.jpg62cc2b7942d30.jpg', '', 'Dialogos Curtos', '1904-02-29', 0);
INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES(25, '@Magic_26', 2, 0, 'magic@mail.com', 'Magic', '$2y$10$zcWEOEjNuuE6pk9WddfPf.k4l20nfaCuOzIDQd8Vomw9JZLJw8CTC', '33588981afc44d9dd1904ba28c3bfd63.jpg62cc341fb28c8.jpg', 'chainsaw-man-1_a93h.jpg62cc341fb7107.jpg', '', '2004-09-26', 0);
INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES(26, '@mart177372', 1, 1, 'martinsilveiradealmeida@gmail.com', 'corsa roubado', '$2y$10$o8FMHQ8LgEYXMUJHGexsyuWxsvMLn7UIMAgTLJCnzmVEFG5pdW4Fm', '62cc4ffa7e1f5.jpg', '62cc4ff28e93b.jpg', 'sou um corsa roubado da favela jacarezinho do rj', '2004-12-19', 0);
INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES(27, '@Yang354167', 0, 0, 'yang@hotmail.com', 'Yang', '$2y$10$/cF9FqmOxpKFG7wowbZSDu/L01SGnftMxJqw7CPIcbcQ5RdmDVCMO', '62cda4d5bb5a6.jpg', '', 'oaishdoiashdoashd asjdiasjdoiasjdoiajsd oaisjdoiasjdojas asijdoasijdoasijdoasijdoia iasodjaosijdaoisjeqw8ue0wqueqw0ueqw0 uasijd osiajdaskmcalnmczxokcnzxlcnzx aosijdasueq8wudqwud0qwu csaoj doaskjdaosij', '2005-06-12', 0);
INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES(28, '@pedr117085', 0, 1, 'pedrinho@gmail.com', 'pedrinho', '$2y$10$5fDXpIPbTNoqUUmn./zCXOrheKiEqRiy./TrL11aH/nmG3jKUk6Se', NULL, NULL, NULL, '1999-04-14', 0);
INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES(29, '@test215201', 0, 5, 'teste@gmail.com', 'teste', '$2y$10$ojBGEnpLnDbq2VMVgSe2bu4XLrmmke8Q1ZZohxicgqF7zCspoLl6e', NULL, NULL, NULL, '2007-03-06', 1);
INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES(30, '@test454369', 0, 0, 'email@email', 'test05', '$2y$10$3Ox7eTKUY70CzBmR6VRyXOuQN8qejmOG136err6HUWE61t1S7d22e', NULL, NULL, NULL, '2007-03-11', 1);
INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES(31, '@test422544', 2, 0, 'testae@gmail.com', 'testekkk', '$2y$10$zkOgGAGuqiyrTKC9VGhwPeqJei30pKM/Ka4RiX/qMoRFRxahWb6cW', NULL, NULL, NULL, '2007-04-04', 0);
INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES(32, '@ezquzi_15', 1, 0, 'ezquzi_15@gmail.com', 'ezquzi_15', '$2y$10$ho/mf0gqaqbz3jv8u05XBO6HPBlLg.K5bo5DyI12movdlwRau2Xm.', '', '', '', '2005-04-08', 0);
INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES(33, '@eszu18945', 0, 0, 'ezquizo5@gmail', 'eszuizo5', '$2y$10$CyQflgVTcxVL8M3j9hiQrOxTEznaEL2ubcetuuUPXC7HekxbfNox.', NULL, NULL, NULL, '2003-04-06', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
