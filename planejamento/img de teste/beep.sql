-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Jul-2022 às 16:37
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

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
-- Estrutura da tabela `curtidas`
--

CREATE TABLE `curtidas` (
  `id_user_curti` int(11) NOT NULL,
  `id_postagem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogos`
--

CREATE TABLE `jogos` (
  `id_jogos` int(11) NOT NULL,
  `nome_jogo` varchar(255) NOT NULL,
  `img_jogo` varchar(255) NOT NULL,
  `desc_jogo` varchar(255) NOT NULL,
  `loja` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacoes`
--

CREATE TABLE `publicacoes` (
  `user_publi` int(11) NOT NULL,
  `id_publi` int(11) NOT NULL,
  `text_publi` varchar(255) DEFAULT NULL,
  `img_publi` varchar(255) DEFAULT NULL,
  `num_curtidas` int(11) NOT NULL,
  `num_compartilha` int(11) NOT NULL,
  `date_publi` datetime NOT NULL,
  `num_comentario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `publicacoes`
--

INSERT INTO `publicacoes` (`user_publi`, `id_publi`, `text_publi`, `img_publi`, `num_curtidas`, `num_compartilha`, `date_publi`, `num_comentario`) VALUES
(10, 2, 'meu deus kkkkkkkkkkkkkkkkkk', 'primeira\\ pub\\ tcc.png', 0, 0, '2020-04-04 00:00:00', 0),
(9, 3, 'kkkkkkkkkkkkkk', NULL, 0, 0, '2022-07-09 00:50:00', 0),
(8, 35, 'sla\r\n\r\n\r\n\r\n\r\na', '62cc18a1762d6.png', 0, 0, '2022-07-11 09:33:37', 0),
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
(8, 25, 'desisto do palmeiras\r\n\r\n\r\n\r\n\r\n\r\n\r\n*torcendo pro palmeiras*', '', 0, 0, '2022-07-10 17:04:38', 0),
(8, 36, 'Comprei um corsa Familia', '62cc19071ef54.jpg', 0, 0, '2022-07-11 09:35:19', 0),
(22, 28, 'sozinho novamente', '', 0, 0, '2022-07-10 17:35:22', 0),
(22, 29, 'tudo bem gurizada?', '', 0, 0, '2022-07-10 17:35:42', 0),
(22, 30, 'nem judas foi tão cruel\r\n\r\n\r\n*literalmente nada aconteceu*', '', 0, 0, '2022-07-10 18:09:02', 0),
(8, 31, 'to seguindo uma galera q nem loko', '', 0, 0, '2022-07-10 19:07:43', 0),
(8, 32, 'é a união flarinthians não tem como', '', 0, 0, '2022-07-10 19:13:59', 0),
(22, 33, 'batista estava certo. Eu sou um sapo', '', 0, 0, '2022-07-10 19:24:05', 0),
(23, 34, 'cara que tedio', '62cc07356601f.jfif', 0, 0, '2022-07-11 08:19:17', 0),
(22, 37, 'robei um corsa de um otaario que tava moscando kkkk', '62cc196653dba.jpg', 0, 0, '2022-07-11 09:36:54', 0),
(8, 38, 'krl robaram meu corsa novinhoÂ ', '62cc1a788054c.jpg', 0, 0, '2022-07-11 09:41:28', 0),
(8, 39, 'que droga :(', '', 0, 0, '2022-07-11 09:48:12', 0),
(8, 40, 'vendo um corsa roubadoÂ ', '62cc2996bcfbc.jpg', 0, 0, '2022-07-11 10:45:58', 0),
(24, 41, '', '62cc2bae8adbb.jfif', 0, 0, '2022-07-11 10:54:54', 0),
(24, 42, '', '62cc2bd71b02a.jpg', 0, 0, '2022-07-11 10:55:35', 0),
(24, 43, '', '62cc2bfc35770.jpg', 0, 0, '2022-07-11 10:56:12', 0),
(24, 44, '', '62cc2c104276f.jpg', 0, 0, '2022-07-11 10:56:32', 0),
(24, 45, '', '62cc2c221349c.jfif', 0, 0, '2022-07-11 10:56:50', 0),
(24, 46, '', '62cc2c3548bd6.jpg', 0, 0, '2022-07-11 10:57:09', 0),
(24, 47, '', '62cc2c46056f4.jfif', 0, 0, '2022-07-11 10:57:26', 0),
(25, 48, 'Denji Ã© foda.', '62cc345b8e08b.jpg', 0, 0, '2022-07-11 11:31:55', 0),
(8, 49, 'queria muito ter uma namorada sou sadboy', '', 0, 0, '2022-07-11 13:16:48', 0),
(8, 50, 'estou triste', '62cc4cff1a4f2.jpg', 0, 0, '2022-07-11 13:17:03', 0),
(8, 51, 'aqui Ã© o martin, professor joÃ£oÂ ', '62cc4da1cbf41.jpg', 0, 0, '2022-07-11 13:19:45', 0),
(10, 52, 'pokemon relmente Ã© um jogo', '62cd9c180f01b.jpg', 0, 0, '2022-07-12 13:06:48', 0),
(8, 53, 'ola mundo', '62cd9d4693b10.png', 0, 0, '2022-07-12 13:11:50', 0),
(8, 57, 'qualquer coisa \r\n\r\n\r\nespaço', '62cdfb980da21.png', 0, 0, '2022-07-12 19:54:16', 0),
(8, 58, 'kkk dei unf em todo mundo kkkkk', '', 0, 0, '2022-07-12 22:49:26', 0),
(8, 59, 'sla to meio sla hoje', '62ce37771a0ef.jpg', 0, 0, '2022-07-13 00:09:43', 0),
(8, 60, 'que tedio', '62ce3c81b7b79.jpg', 0, 0, '2022-07-13 00:31:13', 0),
(8, 61, 'Pikachu dormindo kkkkl', '', 0, 0, '2022-07-13 00:33:51', 0),
(8, 62, 'ops errei kkkkkk', '62ce3d2e19e1f.jpg', 0, 0, '2022-07-13 00:34:06', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `seguidores`
--

CREATE TABLE `seguidores` (
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
(8, 23),
(8, 27),
(28, 28),
(28, 24),
(8, 24),
(8, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `t_seguidores` int(11) NOT NULL,
  `t_seguindo` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `banner_pefil` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `data_nas` varchar(255) NOT NULL,
  `status_` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_user`, `username`, `t_seguidores`, `t_seguindo`, `email`, `nome`, `senha`, `foto_perfil`, `banner_pefil`, `bio`, `data_nas`, `status_`) VALUES
(8, '@fran_pedrinhass', 3, 4, 'fran@gmail.com', 'franciscos', '$2y$10$VeknT5KBG5k4yWCoVUo4fu3U2UlfCRnEOdFo7GFroPjxx/bLMTOC2', 'img_teste.png62c78ae56c952.png', '62cdfc191966a.png', 'gosto de suco de uva | desempregado profissional', '2003-08-15', 1),
(9, '@mira_narek', 2, 2, 'mira@gmail.com', 'miranda', '$2y$10$G/Um7Dnbp5LqwnfVIJNue.D4YYgWqpWAoJcfdnkSyru/asS7WLkDe', 'test_banner.jpg62c88f2fd9885.jpg', 'tumblr_5cd8d34827dfa6b0be3630995ae357ee_e777277e_1280.png62c88f09a2180.png', 'gosto de tortas', '2002-05-06', 1),
(10, '@mate261486', 1, 1, 'ma@gmail.com', 'matehux', '$2y$10$8XBZBMQ1HCnfKs1l2oHIjO/0LHVaDBlkqPDLgDJcz549A9z8NvjhS', 'tumblr_5cd8d34827dfa6b0be3630995ae357ee_e777277e_1280.png62c78ae56cd20.png62cad38f2a9c1.png', 'img_teste.png62c88f4a801f8.png', 'mateus', '2002-05-08', 1),
(11, '@curs174410a', 0, 0, 'fran_15@gmail.com', 'cursedi@gmail.com', '$2y$10$0/vK4QlYYB97tvf7WveaDeI/PjFGursRjrw1FfqkZIUAVLCarxISa', 'img_teste.png62c88102d7a86.png', 'tumblr_5cd8d34827dfa6b0be3630995ae357ee_e777277e_1280.png62c88102d7ec4.png', 'gosto de batatas ', '2001-09-16', 0),
(12, '@pedrinhas', 0, 0, 'pedrinhaskid@gmail.com', 'pedrinhasKid', '$2y$10$63p1jKZOdCUncW/38Y1LN.Z2t2K0OJYzOAjWAvzzLDA1sDn.uDFQS', '', '', '', '2008-01-15', 0),
(22, '@mira458170', 1, 2, 'mir@gmail', 'miranddd', '$2y$10$6Fv4GZG/EsRkjOCSWRdHqOI4KSt49SeAV7hKW7iH6Y7sutx9iGolm', 'background.jpg62cb37f242313.jpg', 'picture.png62cb37f246613.png', '', '2008-04-04', 0),
(23, '@mir_180322', 1, 3, 'miranda_15@gmail.com', 'mir_25', '$2y$10$5zVPQDHwN9xknn1akrGYVe5gl4vAE1eeMSc9T9R6Yo6ZkjPLAFdZ.', 'perfil.png62cc118dc5aa4.png', 'mrpowergamerbr_logo.png62cc0863638da.png', '', '2004-03-16', 0),
(24, '@Dial168933', 3, 0, 'dialogo@mail.com', 'DialogosCurtos', '$2y$10$mHnF9TpwOsFy9L/DdXHCseQ6y.oel1nEXbgV.xqfNLtmO/Fvq8JYm', 'NfFcH3ZG_400x400.jpg62cc2b7942d30.jpg', '', 'Dialogos Curtos', '1904-02-29', 0),
(25, '@Magic_26', 1, 0, 'magic@mail.com', 'Magic', '$2y$10$zcWEOEjNuuE6pk9WddfPf.k4l20nfaCuOzIDQd8Vomw9JZLJw8CTC', '33588981afc44d9dd1904ba28c3bfd63.jpg62cc341fb28c8.jpg', 'chainsaw-man-1_a93h.jpg62cc341fb7107.jpg', '', '2004-09-26', 0),
(26, '@mart177372', 0, 1, 'martinsilveiradealmeida@gmail.com', 'corsa roubado', '$2y$10$o8FMHQ8LgEYXMUJHGexsyuWxsvMLn7UIMAgTLJCnzmVEFG5pdW4Fm', '62cc4ffa7e1f5.jpg', '62cc4ff28e93b.jpg', 'sou um corsa roubado da favela jacarezinho do rj', '2004-12-19', 0),
(27, '@Yang354167', 1, 0, 'yang@hotmail.com', 'Yang', '$2y$10$/cF9FqmOxpKFG7wowbZSDu/L01SGnftMxJqw7CPIcbcQ5RdmDVCMO', '62cda4d5bb5a6.jpg', '', 'oaishdoiashdoashd asjdiasjdoiasjdoiajsd oaisjdoiasjdojas asijdoasijdoasijdoasijdoia iasodjaosijdaoisjeqw8ue0wqueqw0ueqw0 uasijd osiajdaskmcalnmczxokcnzxlcnzx aosijdasueq8wudqwud0qwu csaoj doaskjdaosij', '2005-06-12', 0),
(28, '@pedr117085', 0, 1, 'pedrinho@gmail.com', 'pedrinho', '$2y$10$5fDXpIPbTNoqUUmn./zCXOrheKiEqRiy./TrL11aH/nmG3jKUk6Se', NULL, NULL, NULL, '1999-04-14', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `curtidas`
--
ALTER TABLE `curtidas`
  ADD KEY `id_user_curti` (`id_user_curti`);

--
-- Índices para tabela `jogos`
--
ALTER TABLE `jogos`
  ADD PRIMARY KEY (`id_jogos`);

--
-- Índices para tabela `publicacoes`
--
ALTER TABLE `publicacoes`
  ADD PRIMARY KEY (`id_publi`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `jogos`
--
ALTER TABLE `jogos`
  MODIFY `id_jogos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `publicacoes`
--
ALTER TABLE `publicacoes`
  MODIFY `id_publi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
