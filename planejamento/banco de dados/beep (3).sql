-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 09-Jul-2022 às 04:51
-- Versão do servidor: 10.4.24-MariaDB
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
(10, 10, 'blublue...\r\n<div><br></div>\r\n<div><br></div>\r\ngay', NULL, 0, 0, '2022-07-09 00:59:41', 0),
(10, 5, NULL, 'primeira\\ pub\\ tcc.png', 0, 0, '2022-07-09 00:16:51', 0),
(11, 6, 'queria se o homem-aranha, mas meu tio não deixou -_-', NULL, 0, 0, '2022-07-08 00:00:00', 0),
(9, 7, 'to meio pá das ideia', NULL, 0, 0, '2022-07-07 23:56:00', 0),
(10, 8, 'cara pq ele é assim', 'primeira\\ pub\\ tcc.png', 0, 0, '2022-07-09 00:00:18', 0),
(10, 9, 'skskskkskskksk nem', NULL, 0, 0, '2022-07-08 23:40:00', 0);

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
(8, 9),
(8, 10),
(8, 8);

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
(8, '@fran_pedrinhass', 0, 2, 'fran@gmail.com', 'francisco', '$2y$10$VeknT5KBG5k4yWCoVUo4fu3U2UlfCRnEOdFo7GFroPjxx/bLMTOC2', 'img_teste.png62c78ae56c952.png', 'tumblr_5cd8d34827dfa6b0be3630995ae357ee_e777277e_1280.png62c78ae56cd20.png', 'gosto de batatas', '2003-08-15', 1),
(9, '@mira_narek', 0, 0, 'mira@gmail.com', 'miranda', '$2y$10$G/Um7Dnbp5LqwnfVIJNue.D4YYgWqpWAoJcfdnkSyru/asS7WLkDe', 'test_banner.jpg62c88f2fd9885.jpg', 'tumblr_5cd8d34827dfa6b0be3630995ae357ee_e777277e_1280.png62c88f09a2180.png', 'gosto de tortas', '2002-05-06', 0),
(10, '@mate261486', 0, 0, 'ma@gmail.com', 'matehux', '$2y$10$8XBZBMQ1HCnfKs1l2oHIjO/0LHVaDBlkqPDLgDJcz549A9z8NvjhS', 'tumblr_5cd8d34827dfa6b0be3630995ae357ee_e777277e_1280.png62c88f4a7fd3f.png', 'img_teste.png62c88f4a801f8.png', '', '2002-05-08', 0),
(11, '@curs174410', 0, 0, 'fran_15@gmail.com', 'cursedi@gmail.com', '$2y$10$0/vK4QlYYB97tvf7WveaDeI/PjFGursRjrw1FfqkZIUAVLCarxISa', 'img_teste.png62c88102d7a86.png', 'tumblr_5cd8d34827dfa6b0be3630995ae357ee_e777277e_1280.png62c88102d7ec4.png', 'gosto de batatas ', '2001-09-16', 0),
(12, '@pedrinhas', 0, 0, 'pedrinhaskid@gmail.com', 'pedrinhasKid', '$2y$10$63p1jKZOdCUncW/38Y1LN.Z2t2K0OJYzOAjWAvzzLDA1sDn.uDFQS', '', '', '', '2008-01-15', 0);

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
  MODIFY `id_publi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
