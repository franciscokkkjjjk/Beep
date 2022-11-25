-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 25-Nov-2022 às 02:06
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
(1, 'Luis Francisco Brum Gomes', 'luisfrancisco.15.brum@gmail.com', '$2y$10$YdeDbsuevFWIsBlJFqlLveR/L3PaGdqyAMw.9I7u2vmKgPm4Jknj.', 1, '01888847000', 1853153985, 'Rio Grande do Sul', 'Uruguaiana');

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

INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES
(8, 2, '2022-11-18 23:55:04');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `denuncias_user`
--

INSERT INTO `denuncias_user` (`id_denuncia_`, `id_user_denunciado`, `quem_denunciou`, `motivo`, `motivo_text`) VALUES
(1, 28, 8, 2, 'oh meu deus o pedrinha Ã© doido'),
(2, 26, 8, 2, 'oh meu deus o pedrinha Ã© doido \'\"'),
(3, 30, 8, 2, ''),
(4, 8, 9, 3, '');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `jogos`
--

INSERT INTO `jogos` (`id_jogos`, `nome_jogo`, `img_jogo`, `desc_jogo`, `loja`, `link_loja`, `class_etaria`) VALUES
(1, 'Red Dead Redemption 2', 'e758a15f80f6496ec86426c64084ddd22ae24744.jpeg', 'Red Dead Redemption 2 Ã© um jogo eletrÃ´nico de aÃ§Ã£o-aventura desenvolvido e publicado pela Rockstar Games. Ã‰ o terceiro tÃ­tulo da sÃ©rie Red Dead e uma prequela de Red Dead Redemption, tendo sido lanÃ§ado em outubro de 2018 para PlayStation 4 e Xbox One e em novembro de 2019 para Microsoft Windows e Google Stadia.\r\n', 'Steam', 'http://localhost/projetos/Luiskkk/projetos/beep/paginas/solicitacaoJogos.php', 18),
(2, 'Red Dead Redemption 2', 'e758a15f80f6496ec86426c64084ddd22ae24744.jpeg', 'Red Dead Redemption 2 Ã© um jogo eletrÃ´nico de aÃ§Ã£o-aventura desenvolvido e publicado pela Rockstar Games. Ã‰ o terceiro tÃ­tulo da sÃ©rie Red Dead e uma prequela de Red Dead Redemption, tendo sido lanÃ§ado em outubro de 2018 para PlayStation 4 e Xbox One e em novembro de 2019 para Microsoft Windows e Google Stadia.\r\n', 'Steam', 'http://localhost/projetos/Luiskkk/projetos/beep/paginas/solicitacaoJogos.php', 18),
(3, 'Red Dead Redemption 2', 'e758a15f80f6496ec86426c64084ddd22ae24744.jpeg', 'Red Dead Redemption 2 Ã© um jogo eletrÃ´nico de aÃ§Ã£o-aventura desenvolvido e publicado pela Rockstar Games. Ã‰ o terceiro tÃ­tulo da sÃ©rie Red Dead e uma prequela de Red Dead Redemption, tendo sido lanÃ§ado em outubro de 2018 para PlayStation 4 e Xbox One e em novembro de 2019 para Microsoft Windows e Google Stadia.\r\n', 'Steam', 'http://localhost/projetos/Luiskkk/projetos/beep/paginas/solicitacaoJogos.php', 18),
(4, 'Red Dead Redemption 2', 'e758a15f80f6496ec86426c64084ddd22ae24744.jpeg', 'Red Dead Redemption 2 Ã© um jogo eletrÃ´nico de aÃ§Ã£o-aventura desenvolvido e publicado pela Rockstar Games. Ã‰ o terceiro tÃ­tulo da sÃ©rie Red Dead e uma prequela de Red Dead Redemption, tendo sido lanÃ§ado em outubro de 2018 para PlayStation 4 e Xbox One e em novembro de 2019 para Microsoft Windows e Google Stadia.\r\n', 'Steam', 'http://localhost/projetos/Luiskkk/projetos/beep/paginas/solicitacaoJogos.php', 18),
(5, 'beep games', '998d180b806dbb919bafc33cbfdfa137313c9bed.png', 'beep games 15', 'teste', 'www.google.com', 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogos_possui`
--

DROP TABLE IF EXISTS `jogos_possui`;
CREATE TABLE IF NOT EXISTS `jogos_possui` (
  `id_user` int(11) NOT NULL,
  `id_game` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `jogos_possui`
--

INSERT INTO `jogos_possui` (`id_user`, `id_game`) VALUES
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(8, 5),
(9, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista_loja_games`
--

DROP TABLE IF EXISTS `lista_loja_games`;
CREATE TABLE IF NOT EXISTS `lista_loja_games` (
  `id_jogo` int(11) NOT NULL,
  `nome_loja` varchar(255) NOT NULL,
  `link_loja` text NOT NULL
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
  `id_game` int(11) DEFAULT NULL,
  `quarentena` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_publi`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `publicacoes`
--

INSERT INTO `publicacoes` (`user_publi`, `id_publi`, `type`, `id_publi_interagida`, `text_publi`, `img_publi`, `num_curtidas`, `num_compartilha`, `date_publi`, `num_comentario`, `id_game`, `quarentena`) VALUES
(8, 1, 3, NULL, 'teste', '', 0, 0, '2022-11-18 15:01:48', 0, 1, 0),
(8, 2, 3, NULL, 'sdsad', '', 1, 0, '2022-11-18 15:02:21', 1, 5, 0),
(8, 3, 3, NULL, 'sdasadsd', '', 0, 1, '2022-11-18 15:02:33', 0, NULL, 0),
(8, 7, 1, 2, 'teste', '', 0, 0, '2022-11-19 09:15:05', 0, 5, 0),
(8, 6, 3, NULL, 'em pleno 2022', '', 0, 0, '2022-11-18 23:55:14', 0, NULL, 0),
(8, 8, 2, 3, 'teste', '', 0, 0, '2022-11-19 09:15:15', 0, NULL, 0),
(8, 9, 3, NULL, 'teste game', '', 0, 1, '2022-11-19 09:16:29', 0, 1, 0),
(2, 10, 3, NULL, 'dasdasdsa', NULL, 0, 0, '2022-11-22 22:22:59', 0, NULL, 0),
(26, 11, 3, NULL, 'dasdasdsa', NULL, 0, 0, '2022-11-22 22:22:59', 0, NULL, 0),
(26, 12, 2, 5, 'dasdasdsa', NULL, 0, 0, '2022-11-22 22:22:59', 0, NULL, 0),
(26, 13, 2, 11, 'dasdasdsa', NULL, 0, 0, '2022-11-22 22:22:59', 0, NULL, 0),
(8, 14, 2, 9, 'asdsda', '', 0, 0, '2022-11-24 22:42:53', 0, 1, 0);

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
(8, 8),
(22, 22),
(22, 8),
(23, 23),
(23, 9),
(23, 22),
(23, 8),
(22, 10),
(24, 24),
(9, 24),
(25, 25),
(9, 25),
(26, 26),
(26, 9),
(10, 8),
(27, 27),
(28, 28),
(28, 24),
(29, 29),
(30, 30),
(31, 31),
(22, 9),
(22, 31),
(22, 12),
(22, 24),
(32, 32),
(9, 22),
(9, 8),
(9, 12),
(12, 10),
(9, 10),
(33, 33),
(8, 10),
(8, 12),
(8, 22),
(9, 32),
(8, 24),
(8, 25),
(34, 34),
(35, 35),
(35, 8),
(36, 36),
(8, 32),
(37, 37),
(37, 8),
(37, 10),
(37, 12),
(37, 36),
(37, 9),
(36, 8),
(36, 24),
(36, 25),
(36, 32),
(36, 10),
(36, 12),
(36, 9),
(36, 22),
(36, 31),
(8, 31),
(8, 36),
(8, 11),
(8, 23),
(8, 27),
(8, 9);

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
-- Estrutura da tabela `solic_list_lojas`
--

DROP TABLE IF EXISTS `solic_list_lojas`;
CREATE TABLE IF NOT EXISTS `solic_list_lojas` (
  `id_soli` int(11) NOT NULL,
  `nome_loja` varchar(255) NOT NULL,
  `link_loja` text NOT NULL,
  `data de expedicao` datetime NOT NULL
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
  `status_` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES
(8, '@fran_pedrinha', 7, 12, 'luisfrancisco.15.brum@gmail.com', 'franciscos', '$2y$10$VeknT5KBG5k4yWCoVUo4fu3U2UlfCRnEOdFo7GFroPjxx/bLMTOC2', '633cd2a4e61ac.png', '6334bfa08bded.gif', 'gosto de suco de uva | desempregado profissional\r\na', '2004-04-09', 1),
(9, '@bluePin', 7, 7, 'mira@gmail.com', 'Blue pin', '$2y$10$G/Um7Dnbp5LqwnfVIJNue.D4YYgWqpWAoJcfdnkSyru/asS7WLkDe', '6373445738ab1.jpg', '6373445739375.jpeg', 'caneta azul\r\nazul caneta\r\nANA VOLTA PRA MIM NUNCA TE PEDI NADA PORVAFOR AAAAAAAAAAAAAAAA', '1901-05-06', 1),
(10, '@mate261486', 6, 1, 'ma@gmail.com', 'matehux', '$2y$10$8XBZBMQ1HCnfKs1l2oHIjO/0LHVaDBlkqPDLgDJcz549A9z8NvjhS', 'tumblr_5cd8d34827dfa6b0be3630995ae357ee_e777277e_1280.png62c78ae56cd20.png62cad38f2a9c1.png', 'img_teste.png62c88f4a801f8.png', 'mateus', '2002-05-08', 1),
(11, '@marinha', 1, 0, 'fran_15@gmail.com', 'cursedi', '$2y$10$0/vK4QlYYB97tvf7WveaDeI/PjFGursRjrw1FfqkZIUAVLCarxISa', 'img_teste.png62c88102d7a86.png', 'tumblr_5cd8d34827dfa6b0be3630995ae357ee_e777277e_1280.png62c88102d7ec4.png', 'gosto de batatas', '2001-09-16', 0),
(12, '@pedrinhas', 5, 1, 'pedrinhaskid@gmail.com', 'pedrinhasKid', '$2y$10$63p1jKZOdCUncW/38Y1LN.Z2t2K0OJYzOAjWAvzzLDA1sDn.uDFQS', '', '', '', '2008-01-15', 1),
(22, '@mira458170', 4, 6, 'mir@gmail', 'miranddd', '$2y$10$6Fv4GZG/EsRkjOCSWRdHqOI4KSt49SeAV7hKW7iH6Y7sutx9iGolm', 'background.jpg62cb37f242313.jpg', 'picture.png62cb37f246613.png', '', '2008-04-04', 1),
(23, '@mir_180322', 1, 3, 'miranda_15@gmail.com', 'mir_25', '$2y$10$5zVPQDHwN9xknn1akrGYVe5gl4vAE1eeMSc9T9R6Yo6ZkjPLAFdZ.', 'perfil.png62cc118dc5aa4.png', 'mrpowergamerbr_logo.png62cc0863638da.png', '', '2004-03-16', 0),
(24, '@Dial168933', 5, 0, 'dialogo@mail.com', 'DialogosCurtos', '$2y$10$mHnF9TpwOsFy9L/DdXHCseQ6y.oel1nEXbgV.xqfNLtmO/Fvq8JYm', 'NfFcH3ZG_400x400.jpg62cc2b7942d30.jpg', '', 'Dialogos Curtos', '1904-02-29', 0),
(25, '@Magic_26', 3, 0, 'magic@mail.com', 'Magic', '$2y$10$zcWEOEjNuuE6pk9WddfPf.k4l20nfaCuOzIDQd8Vomw9JZLJw8CTC', '33588981afc44d9dd1904ba28c3bfd63.jpg62cc341fb28c8.jpg', 'chainsaw-man-1_a93h.jpg62cc341fb7107.jpg', '', '2004-09-26', 0),
(26, '@mart177372', 0, 1, 'martinsilveiradealmeida@gmail.com', 'corsa roubado', '$2y$10$o8FMHQ8LgEYXMUJHGexsyuWxsvMLn7UIMAgTLJCnzmVEFG5pdW4Fm', '62cc4ffa7e1f5.jpg', '62cc4ff28e93b.jpg', 'sou um corsa roubado da favela jacarezinho do rj', '2004-12-19', 0),
(27, '@Yang354167', 1, 0, 'yang@hotmail.com', 'Yang', '$2y$10$/cF9FqmOxpKFG7wowbZSDu/L01SGnftMxJqw7CPIcbcQ5RdmDVCMO', '62cda4d5bb5a6.jpg', '', 'oaishdoiashdoashd asjdiasjdoiasjdoiajsd oaisjdoiasjdojas asijdoasijdoasijdoasijdoia iasodjaosijdaoisjeqw8ue0wqueqw0ueqw0 uasijd osiajdaskmcalnmczxokcnzxlcnzx aosijdasueq8wudqwud0qwu csaoj doaskjdaosij', '2005-06-12', 0),
(28, '@pedr117085', 0, 1, 'pedrinho@gmail.com', 'pedrinho', '$2y$10$5fDXpIPbTNoqUUmn./zCXOrheKiEqRiy./TrL11aH/nmG3jKUk6Se', NULL, NULL, NULL, '1999-04-14', 0),
(29, '@test215201', 0, 0, 'teste@gmail.com', 'teste', '$2y$10$ojBGEnpLnDbq2VMVgSe2bu4XLrmmke8Q1ZZohxicgqF7zCspoLl6e', NULL, NULL, NULL, '2007-03-06', 1),
(30, '@test454369', 0, 0, 'email@email', 'test05', '$2y$10$3Ox7eTKUY70CzBmR6VRyXOuQN8qejmOG136err6HUWE61t1S7d22e', NULL, NULL, NULL, '2007-03-11', 1),
(31, '@test422544', 4, 0, 'testae@gmail.com', 'testekkk', '$2y$10$zkOgGAGuqiyrTKC9VGhwPeqJei30pKM/Ka4RiX/qMoRFRxahWb6cW', NULL, NULL, NULL, '2007-04-04', 0),
(32, '@ezquzi_15', 3, 0, 'ezquzi_15@gmail.com', 'ezquzi_15', '$2y$10$ho/mf0gqaqbz3jv8u05XBO6HPBlLg.K5bo5DyI12movdlwRau2Xm.', '', '', '', '2005-04-08', 0),
(33, '@eszu18945', 0, 0, 'ezquizo5@gmail', 'eszuizo5', '$2y$10$CyQflgVTcxVL8M3j9hiQrOxTEznaEL2ubcetuuUPXC7HekxbfNox.', NULL, NULL, NULL, '2003-04-06', 0),
(34, '@bebi266400', 0, 0, 'pedra@gmai.com', 'bebinhaPedras', '$2y$10$h.QSgY0J1AVmcljd8QNDPu/dC84ebgK2mXlUS5A55h3oDb.S8ojTO', NULL, NULL, NULL, '2003-09-07', 0),
(35, '@pedr144289', 0, 1, 'pedras@gmail.com', 'pedra', '$2y$10$fb6tjNaWNXRUSc33bkpp7eIIskkMM3J618YuU9ewheGRkXqUlNa7y', NULL, NULL, NULL, '2001-05-06', 0),
(36, '@test211812', 2, 9, 'f@gf', 'teste', '$2y$10$m4QYdnDGaSs/1oBXrxsyPuNHGAsorh6lRKnPOkWFkVkFBFhGvhIwa', NULL, NULL, NULL, '1989-05-27', 1),
(37, '@luis289939', 0, 5, 'l@gmail.com', 'luis', '$2y$10$QgRw9JsyTtuOKjQVToMLt.teTw4PoDFE2Q7bv2HfE/28iBVxLPJmC', '63503ddc131de.png', '63503ddc1352e.jpg', '', '2004-04-08', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
