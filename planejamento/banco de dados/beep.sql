-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Jul-2022 às 03:34
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
  `id_postagem` int(11) NOT NULL,
  `curtida_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `curtidas`
--

INSERT INTO `curtidas` (`id_user_curti`, `id_postagem`, `curtida_date`) VALUES
(9, 205, '2022-07-19 20:27:24'),
(9, 47, '2022-07-19 20:35:04'),
(9, 204, '2022-07-19 20:42:19'),
(9, 203, '2022-07-19 20:42:25'),
(8, 70, '2022-07-20 20:05:11'),
(8, 217, '2022-07-20 22:32:59'),
(8, 220, '2022-07-20 22:34:01'),
(8, 180, '2022-07-20 22:45:05'),
(8, 225, '2022-07-21 13:51:48'),
(8, 223, '2022-07-21 17:02:52'),
(8, 222, '2022-07-21 17:02:54'),
(8, 221, '2022-07-21 17:02:58'),
(8, 219, '2022-07-21 17:03:03'),
(8, 218, '2022-07-21 17:03:05'),
(8, 210, '2022-07-21 17:03:09'),
(8, 209, '2022-07-21 17:03:11'),
(8, 208, '2022-07-21 17:03:13'),
(8, 207, '2022-07-21 17:03:14'),
(8, 205, '2022-07-21 17:03:15'),
(8, 192, '2022-07-21 18:41:15'),
(8, 47, '2022-07-21 18:41:38'),
(8, 233, '2022-07-21 18:47:51');

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
  `type` int(11) NOT NULL,
  `id_publi_interagida` int(11) DEFAULT NULL,
  `text_publi` varchar(255) DEFAULT NULL,
  `img_publi` varchar(255) DEFAULT NULL,
  `num_curtidas` int(11) NOT NULL,
  `num_compartilha` int(11) NOT NULL,
  `date_publi` datetime NOT NULL,
  `num_comentario` int(11) NOT NULL,
  `compartilhamento` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `publicacoes`
--

INSERT INTO `publicacoes` (`user_publi`, `id_publi`, `type`, `id_publi_interagida`, `text_publi`, `img_publi`, `num_curtidas`, `num_compartilha`, `date_publi`, `num_comentario`, `compartilhamento`) VALUES
(8, 218, 2, 47, NULL, '', 1, 0, '2022-07-20 19:42:49', 0, 0),
(9, 87, 3, NULL, 'goiba de marmelo ', '', 0, 0, '2022-07-16 23:43:00', 0, 0),
(8, 35, 3, NULL, 'sla\r\n\r\n\r\n\r\n\r\na', '62cc18a1762d6.png', 0, 0, '2022-07-11 09:33:37', 0, 0),
(22, 86, 3, NULL, 'suspense', '', 0, 0, '2022-07-16 23:37:11', 0, 0),
(22, 85, 3, NULL, 'vacilinho isso ai ', '', 0, 0, '2022-07-16 23:35:46', 0, 0),
(22, 84, 3, NULL, 'cara....', '', 0, 0, '2022-07-16 23:34:49', 0, 0),
(22, 83, 3, NULL, '...\r\n\r\n', '', 0, 0, '2022-07-16 23:33:09', 0, 0),
(22, 81, 3, NULL, 'gurizada nem ta ligada kkkk', '', 0, 0, '2022-07-16 23:32:16', 0, 0),
(22, 82, 3, NULL, 'nem ta ligada kkk', '', 0, 0, '2022-07-16 23:32:49', 0, 0),
(22, 80, 3, NULL, 'blu blue blue', '', 0, 0, '2022-07-16 23:29:52', 0, 0),
(22, 79, 3, NULL, 'meu deus que promisse chata', '', 0, 0, '2022-07-16 23:29:11', 0, 0),
(8, 74, 3, NULL, 'pqp o admin que mudar os post pqp, adm mo burrao', '', 0, 0, '2022-07-16 21:48:34', 0, 0),
(8, 75, 3, NULL, 'meu deus\r\n\r\n', '', 0, 0, '2022-07-16 21:59:38', 0, 0),
(22, 76, 3, NULL, 'cara isso é uma promisse ', '', 0, 0, '2022-07-16 22:01:07', 0, 0),
(22, 77, 3, NULL, 'putz q b@sta', '', 0, 0, '2022-07-16 23:26:59', 0, 0),
(22, 78, 3, NULL, 'nem que os cara meteu essa ', '', 0, 0, '2022-07-16 23:28:14', 0, 0),
(8, 25, 3, NULL, 'desisto do palmeiras\r\n\r\n\r\n\r\n\r\n\r\n\r\n*torcendo pro palmeiras*', '', 0, 0, '2022-07-10 17:04:38', 0, 0),
(8, 36, 3, NULL, 'Comprei um corsa Familia', '62cc19071ef54.jpg', 0, 0, '2022-07-11 09:35:19', 0, 0),
(22, 28, 3, NULL, 'sozinho novamente', '', 0, 0, '2022-07-10 17:35:22', 0, 0),
(22, 29, 3, NULL, 'tudo bem gurizada?', '', 0, 0, '2022-07-10 17:35:42', 0, 0),
(22, 30, 3, NULL, 'nem judas foi tão cruel\r\n\r\n\r\n*literalmente nada aconteceu*', '', 0, 0, '2022-07-10 18:09:02', 0, 0),
(8, 31, 3, NULL, 'to seguindo uma galera q nem loko', '', 0, 0, '2022-07-10 19:07:43', 0, 0),
(8, 32, 3, NULL, 'é a união flarinthians não tem como', '', 0, 0, '2022-07-10 19:13:59', 0, 0),
(22, 33, 3, NULL, 'batista estava certo. Eu sou um sapo', '', 0, 0, '2022-07-10 19:24:05', 0, 0),
(23, 34, 3, NULL, 'cara que tedio', '62cc07356601f.jfif', 0, 0, '2022-07-11 08:19:17', 0, 0),
(22, 37, 3, NULL, 'robei um corsa de um otaario que tava moscando kkkk', '62cc196653dba.jpg', 0, 0, '2022-07-11 09:36:54', 0, 0),
(8, 38, 3, NULL, 'krl robaram meu corsa novinhoÂ ', '62cc1a788054c.jpg', 0, 0, '2022-07-11 09:41:28', 0, 0),
(8, 39, 3, NULL, 'que droga :(', '', 0, 0, '2022-07-11 09:48:12', 0, 0),
(8, 40, 3, NULL, 'vendo um corsa roubadoÂ ', '62cc2996bcfbc.jpg', 0, 0, '2022-07-11 10:45:58', 0, 0),
(24, 41, 3, NULL, '', '62cc2bae8adbb.jfif', 0, 0, '2022-07-11 10:54:54', 0, 0),
(24, 42, 3, NULL, '', '62cc2bd71b02a.jpg', 0, 0, '2022-07-11 10:55:35', 0, 0),
(24, 43, 3, NULL, '', '62cc2bfc35770.jpg', 0, 0, '2022-07-11 10:56:12', 0, 0),
(24, 44, 3, NULL, '', '62cc2c104276f.jpg', 0, 0, '2022-07-11 10:56:32', 0, 0),
(24, 45, 3, NULL, '', '62cc2c221349c.jfif', 0, 0, '2022-07-11 10:56:50', 0, 0),
(24, 46, 3, NULL, '', '62cc2c3548bd6.jpg', 0, 0, '2022-07-11 10:57:09', 0, 0),
(24, 47, 3, NULL, '', '62cc2c46056f4.jfif', 2, 0, '2022-07-11 10:57:26', 0, 0),
(25, 48, 3, NULL, 'Denji Ã© foda.', '62cc345b8e08b.jpg', 0, 0, '2022-07-11 11:31:55', 0, 0),
(8, 49, 3, NULL, 'queria muito ter uma namorada sou sadboy', '', 0, 0, '2022-07-11 13:16:48', 0, 0),
(8, 50, 3, NULL, 'estou triste', '62cc4cff1a4f2.jpg', 0, 0, '2022-07-11 13:17:03', 0, 0),
(8, 51, 3, NULL, 'aqui Ã© o martin, professor joÃ£oÂ ', '62cc4da1cbf41.jpg', 0, 0, '2022-07-11 13:19:45', 0, 0),
(10, 52, 3, NULL, 'pokemon relmente Ã© um jogo', '62cd9c180f01b.jpg', 0, 0, '2022-07-12 13:06:48', 0, 0),
(8, 53, 3, NULL, 'ola mundo', '62cd9d4693b10.png', 0, 0, '2022-07-12 13:11:50', 0, 0),
(8, 57, 3, NULL, 'qualquer coisa \r\n\r\n\r\nespaço', '62cdfb980da21.png', 0, 0, '2022-07-12 19:54:16', 0, 0),
(8, 58, 3, NULL, 'kkk dei unf em todo mundo kkkkk', '', 0, 0, '2022-07-12 22:49:26', 0, 0),
(8, 59, 3, NULL, 'sla to meio sla hoje', '62ce37771a0ef.jpg', 0, 0, '2022-07-13 00:09:43', 0, 0),
(8, 60, 3, NULL, 'que tedio', '62ce3c81b7b79.jpg', 0, 0, '2022-07-13 00:31:13', 0, 0),
(8, 61, 3, NULL, 'Pikachu dormindo kkkkl', '', 0, 0, '2022-07-13 00:33:51', 0, 0),
(8, 62, 3, NULL, 'ops errei kkkkkk', '62ce3d2e19e1f.jpg', 0, 0, '2022-07-13 00:34:06', 0, 0),
(8, 64, 3, NULL, 'Recomendados', '', 0, 0, '2022-07-14 21:41:02', 0, 0),
(8, 65, 3, NULL, 'Postar\r\nPostar', '', 0, 0, '2022-07-14 21:41:23', 0, 0),
(8, 66, 3, NULL, '', '', 0, 0, '2022-07-14 22:36:37', 0, 0),
(29, 67, 3, NULL, 'que dia lindo\r\n\r\n\r\n*fico o dia todo dentro do meu quarto*', '', 0, 0, '2022-07-15 19:24:15', 0, 0),
(8, 68, 3, NULL, 'mlk como é dificil fazer um negocio de recomendações pqp ', '', 0, 0, '2022-07-15 21:58:19', 0, 0),
(8, 69, 3, NULL, 'dor tragédia, decepção', '', 0, 0, '2022-07-15 22:05:02', 0, 0),
(31, 70, 3, NULL, 'kkkkkk o dev não sabe fazer um recomendados kkkkkkkkkkk vsf \r\n\r\n\r\neu sou o dev...', '', 1, 0, '2022-07-16 15:01:09', 0, 0),
(8, 71, 3, NULL, 'terminei o recomenados slk, mo difícil ', '', 0, 0, '2022-07-16 15:11:29', 0, 0),
(22, 72, 3, NULL, 'cara não paro de pensar que sou esquizofrênico ', '', 0, 0, '2022-07-16 15:36:42', 0, 0),
(9, 89, 3, NULL, 'existe uma coisa ', '', 0, 0, '2022-07-17 00:43:58', 0, 0),
(9, 90, 3, NULL, 'as vezes eu me pego pensando em goiabas ', '', 0, 0, '2022-07-17 00:45:09', 0, 0),
(9, 91, 3, NULL, 'cara que tedio', '', 0, 0, '2022-07-17 01:05:30', 0, 0),
(22, 92, 3, NULL, 'meu deus kkkkkkkkkkk o cara caiu muito feios', '', 0, 0, '2022-07-17 01:17:24', 0, 0),
(22, 93, 3, NULL, 'nao apenas nao', '', 0, 0, '2022-07-17 01:17:54', 0, 0),
(22, 95, 3, NULL, 'miranda esva certo', '', 0, 0, '2022-07-17 01:19:34', 0, 0),
(22, 96, 3, NULL, 'mei', '', 0, 0, '2022-07-17 01:20:52', 0, 0),
(22, 97, 3, NULL, 'aaaa', '', 0, 0, '2022-07-17 01:21:54', 0, 0),
(22, 98, 3, NULL, 'novo ', '', 0, 0, '2022-07-17 01:23:03', 0, 0),
(22, 99, 3, NULL, 'kkkkkk', '', 0, 0, '2022-07-17 01:23:28', 0, 0),
(22, 100, 3, NULL, 'caraca mulec que dia que isso só no pagodinho ', '', 0, 0, '2022-07-17 01:24:06', 0, 0),
(22, 101, 3, NULL, 'tem novos dias amnahdsad', '', 0, 0, '2022-07-17 01:28:03', 0, 0),
(22, 102, 3, NULL, 'miranda eu sou um sapo kkkkkkkkkkkkk', '', 0, 0, '2022-07-17 01:28:31', 0, 0),
(22, 103, 3, NULL, 'aaa', '', 0, 0, '2022-07-17 01:38:15', 0, 0),
(9, 104, 3, NULL, 'aaaa', '', 0, 0, '2022-07-17 01:38:41', 0, 0),
(9, 105, 3, NULL, 'vou trollar o @mira458170', '', 0, 0, '2022-07-17 01:42:32', 0, 0),
(9, 106, 3, NULL, 'é ele foi trollado kkkkk', '', 0, 0, '2022-07-17 01:42:51', 0, 0),
(9, 107, 3, NULL, 'vou trolar ele nem tem como kkkk', '', 0, 0, '2022-07-17 01:43:34', 0, 0),
(9, 108, 3, NULL, 'butrro ', '', 0, 0, '2022-07-17 01:44:13', 0, 0),
(9, 109, 3, NULL, 'o cara nao consegue fazer um vericação simples kkkk', '', 0, 0, '2022-07-17 01:44:58', 0, 0),
(9, 110, 3, NULL, 'ele é muito burrom msm', '', 0, 0, '2022-07-17 01:45:28', 0, 0),
(9, 111, 3, NULL, 'aaaa kkkkkk funfo', '', 0, 0, '2022-07-17 01:45:41', 0, 0),
(9, 112, 3, NULL, 'aaaaaaaaaaaaa kkkkkkk num é possivel', '', 0, 0, '2022-07-17 01:46:09', 0, 0),
(9, 113, 3, NULL, 'cansei de postar coisa aleatoria para verificação ', '', 0, 0, '2022-07-17 01:47:26', 0, 0),
(9, 114, 3, NULL, 'o 2', '', 0, 0, '2022-07-17 01:47:44', 0, 0),
(9, 115, 3, NULL, 'meu deus kkk div maneira ', '', 0, 0, '2022-07-17 01:52:04', 0, 0),
(9, 116, 3, NULL, 'aaaa', '', 0, 0, '2022-07-17 01:52:42', 0, 0),
(9, 117, 3, NULL, 'meu chapeu ', '', 0, 0, '2022-07-17 01:53:34', 0, 0),
(9, 118, 3, NULL, 'post novo no beep 2', '', 0, 0, '2022-07-17 01:54:38', 0, 0),
(9, 119, 3, NULL, 'ele funfo mas será?', '', 0, 0, '2022-07-17 01:55:37', 0, 0),
(9, 120, 3, NULL, 'isso funfa?', '', 0, 0, '2022-07-17 01:57:40', 0, 0),
(9, 121, 3, NULL, 'not o idiota ', '', 0, 0, '2022-07-17 01:59:04', 0, 0),
(9, 122, 3, NULL, 'dala la miranda', '', 0, 0, '2022-07-17 02:03:37', 0, 0),
(9, 123, 3, NULL, 'ah afffff', '', 0, 0, '2022-07-17 02:04:44', 0, 0),
(9, 124, 3, NULL, 'sla', '', 0, 0, '2022-07-17 02:05:52', 0, 0),
(9, 127, 3, NULL, 'aaasss', '', 0, 0, '2022-07-17 02:07:17', 0, 0),
(8, 128, 3, NULL, 'é parsa não é facil', '', 0, 0, '2022-07-17 02:10:45', 0, 0),
(9, 129, 3, NULL, 'cara que tedio', '', 0, 0, '2022-07-18 11:09:42', 0, 0),
(9, 130, 3, NULL, 'rock |__|\r\n         |||||/', '', 0, 0, '2022-07-18 11:14:07', 0, 0),
(9, 131, 3, NULL, 'beep é um lugar', '', 0, 0, '2022-07-18 11:14:36', 0, 0),
(9, 132, 3, NULL, 'vou encher o saco do miranda \r\n\r\n\r\n\r\n\r\n*pura esquizo', '', 0, 0, '2022-07-18 11:14:56', 0, 0),
(9, 133, 3, NULL, 'miranda....', '', 0, 0, '2022-07-18 11:16:34', 0, 0),
(9, 134, 3, NULL, 'teste de post', '', 0, 0, '2022-07-18 11:17:32', 0, 0),
(8, 201, 3, NULL, 'a                                             ', '', 0, 0, '2022-07-19 16:53:20', 0, 0),
(8, 192, 3, NULL, 'essa Beep', '', 0, 0, '2022-07-18 18:20:47', 0, 0),
(8, 193, 3, NULL, 'essa beep em. Vou ti contar...', '', 0, 0, '2022-07-18 21:36:19', 0, 0),
(8, 194, 3, NULL, 'cara kkkk ', '', 0, 0, '2022-07-19 14:52:34', 0, 0),
(9, 144, 3, NULL, 'teste novo ', '', 0, 0, '2022-07-18 11:29:28', 0, 0),
(9, 145, 3, NULL, 'novinho', '', 0, 0, '2022-07-18 11:30:44', 0, 0),
(8, 195, 3, NULL, 'meu deus q horros', '', 0, 0, '2022-07-19 15:36:20', 0, 0),
(8, 196, 3, NULL, 'que', '', 0, 0, '2022-07-19 15:36:42', 0, 0),
(8, 197, 3, NULL, 'ultima publi', '', 0, 0, '2022-07-19 15:38:18', 0, 0),
(8, 198, 3, NULL, 'blue blue kkkk', '', 0, 0, '2022-07-19 15:51:13', 0, 0),
(8, 199, 3, NULL, 'blublue', '', 0, 0, '2022-07-19 15:52:05', 0, 0),
(8, 200, 3, NULL, 'publi mais recente (a)', '', 0, 0, '2022-07-19 16:45:08', 0, 0),
(9, 158, 3, NULL, 'dassadsad', '', 0, 0, '2022-07-18 11:40:08', 0, 0),
(9, 159, 3, NULL, 'sssd', '', 0, 0, '2022-07-18 11:40:12', 0, 0),
(9, 160, 3, NULL, 'asdsdasda', '', 0, 0, '2022-07-18 11:40:15', 0, 0),
(9, 190, 3, NULL, 'batman veste uma roupa pra bater em pobres e todo mundo fica 😍😍😍😍😍😍😍\r\nmas quando e eu', '', 0, 0, '2022-07-18 18:02:58', 0, 0),
(8, 189, 3, NULL, 'não tô tankando mais esse beep', '', 0, 0, '2022-07-18 17:39:30', 0, 0),
(9, 188, 3, NULL, 'pedrinha ta tirando com a minha cara ', '', 0, 0, '2022-07-18 17:29:08', 0, 0),
(9, 180, 3, NULL, 'nem tank mais', '', 1, 0, '2022-07-18 13:26:03', 0, 0),
(8, 181, 3, NULL, 'meu deus esse site ta o cumulo ', '', 0, 0, '2022-07-18 14:36:41', 0, 0),
(8, 187, 3, NULL, 'kkkk isso é muito bom kkkk', '', 0, 0, '2022-07-18 17:28:44', 0, 0),
(8, 186, 3, NULL, 'vivendo para sofrer com js', '', 0, 0, '2022-07-18 17:28:34', 0, 0),
(8, 202, 3, NULL, '', '', 0, 0, '2022-07-19 17:06:41', 0, 0),
(8, 203, 3, NULL, 'putz timeline é uma bosta de fazer', '', 2, 0, '2022-07-19 18:48:27', 0, 0),
(8, 204, 3, NULL, 'cara muleke que dia q isso', '', 4, 0, '2022-07-19 19:27:50', 0, 0),
(9, 205, 3, NULL, 'esquizo demais esse pedrinha em', '', 2, 0, '2022-07-19 20:24:06', 0, 0),
(8, 206, 0, NULL, 'caraca*', '', 0, 0, '2022-07-20 12:50:57', 0, 0),
(8, 207, 3, NULL, 'estoy a coringar ', '', 1, 0, '2022-07-20 12:53:29', 0, 0),
(8, 208, 3, NULL, '@fran_pedrinha vai a merd@ kkkkkkkkkkkk', '', 1, 0, '2022-07-20 13:40:47', 0, 0),
(9, 209, 3, NULL, 'cara q isso', '', 1, 0, '2022-07-20 14:05:08', 0, 0),
(8, 210, 3, NULL, 'miranda sempre com razão em kkkk ', '', 1, 0, '2022-07-20 17:32:51', 0, 0),
(9, 219, 3, NULL, 'esse site ta cada vez mais falido em kkkkkk pqp', '', 1, 0, '2022-07-20 19:45:28', 0, 0),
(8, 217, 2, 47, NULL, '', 1, 0, '2022-07-20 19:10:27', 0, 0),
(9, 220, 2, 208, NULL, '', 1, 0, '2022-07-20 19:50:06', 0, 0),
(8, 221, 3, NULL, '$mira_narek esta certo novamente fdp', '', 1, 0, '2022-07-20 22:07:44', 0, 0),
(8, 222, 2, 180, NULL, '', 1, 0, '2022-07-20 22:45:07', 0, 0),
(8, 223, 2, 47, NULL, '', 1, 0, '2022-07-20 22:56:24', 0, 0),
(8, 224, 2, 41, 'olha esse meme kkkkkkkk<br>*vejo uma garota e fujo*', '', 0, 0, '2022-07-20 22:56:53', 0, 0),
(8, 225, 4, 192, NULL, '', 1, 0, '2022-07-21 12:16:21', 0, 0),
(9, 226, 4, 43, NULL, '', 0, 0, '2022-07-21 13:55:01', 0, 0),
(8, 227, 4, 226, NULL, '', 0, 0, '2022-07-21 14:07:39', 0, 0),
(8, 228, 4, 224, NULL, '', 0, 0, '2022-07-21 14:08:05', 0, 0),
(8, 229, 3, NULL, 'cara, só o odio', '', 3, 0, '2022-07-21 14:17:53', 0, 0),
(8, 230, 4, 229, NULL, '', -1, 0, '2022-07-21 15:13:08', 1, 0),
(8, 231, 4, 223, NULL, '', 0, 0, '2022-07-21 18:39:00', 0, 0),
(8, 232, 4, 221, NULL, '', 0, 0, '2022-07-21 18:44:04', 0, 0),
(8, 233, 3, NULL, 'kkkkkkk ???????? ', '', 1, 1, '2022-07-21 18:47:03', 0, 0),
(8, 234, 4, 233, NULL, '', 0, 0, '2022-07-21 18:47:09', 0, 0),
(8, 235, 3, NULL, '??/', '', 0, 1, '2022-07-21 18:47:58', 0, 0),
(8, 236, 4, 235, NULL, '', 0, 0, '2022-07-21 18:53:38', 0, 0);

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
(28, 28),
(28, 24),
(8, 24),
(8, 26),
(29, 29),
(30, 30),
(8, 25),
(29, 25),
(29, 9),
(29, 24),
(29, 26),
(31, 31),
(8, 12),
(22, 9),
(22, 31),
(22, 12),
(22, 24),
(32, 32),
(32, 9),
(8, 22),
(9, 22),
(9, 8),
(9, 12),
(29, 10),
(12, 10),
(8, 10),
(9, 10),
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
(8, '@fran_pedrinhass', 4, 8, 'fran@gmail.com', 'franciscos', '$2y$10$VeknT5KBG5k4yWCoVUo4fu3U2UlfCRnEOdFo7GFroPjxx/bLMTOC2', '62d6d7e37f319.png', '62d6d80302e72.jpg', 'gosto de suco de uva | desempregado profissional', '2003-08-15', 1),
(9, '@mira_narek', 6, 6, 'mira@gmail.com', 'miranda', '$2y$10$G/Um7Dnbp5LqwnfVIJNue.D4YYgWqpWAoJcfdnkSyru/asS7WLkDe', 'test_banner.jpg62c88f2fd9885.jpg', 'tumblr_5cd8d34827dfa6b0be3630995ae357ee_e777277e_1280.png62c88f09a2180.png', 'gosto de tortas', '2002-05-06', 1),
(10, '@mate261486', 5, 1, 'ma@gmail.com', 'matehux', '$2y$10$8XBZBMQ1HCnfKs1l2oHIjO/0LHVaDBlkqPDLgDJcz549A9z8NvjhS', 'tumblr_5cd8d34827dfa6b0be3630995ae357ee_e777277e_1280.png62c78ae56cd20.png62cad38f2a9c1.png', 'img_teste.png62c88f4a801f8.png', 'mateus', '2002-05-08', 1),
(11, '@curs174410a', 0, 0, 'fran_15@gmail.com', 'cursedi@gmail.com', '$2y$10$0/vK4QlYYB97tvf7WveaDeI/PjFGursRjrw1FfqkZIUAVLCarxISa', 'img_teste.png62c88102d7a86.png', 'tumblr_5cd8d34827dfa6b0be3630995ae357ee_e777277e_1280.png62c88102d7ec4.png', 'gosto de batatas ', '2001-09-16', 0),
(12, '@pedrinhas', 3, 1, 'pedrinhaskid@gmail.com', 'pedrinhasKid', '$2y$10$63p1jKZOdCUncW/38Y1LN.Z2t2K0OJYzOAjWAvzzLDA1sDn.uDFQS', '', '', '', '2008-01-15', 1),
(22, '@mira458170', 3, 6, 'mir@gmail', 'miranddd', '$2y$10$6Fv4GZG/EsRkjOCSWRdHqOI4KSt49SeAV7hKW7iH6Y7sutx9iGolm', 'background.jpg62cb37f242313.jpg', 'picture.png62cb37f246613.png', '', '2008-04-04', 0),
(23, '@mir_180322', 0, 3, 'miranda_15@gmail.com', 'mir_25', '$2y$10$5zVPQDHwN9xknn1akrGYVe5gl4vAE1eeMSc9T9R6Yo6ZkjPLAFdZ.', 'perfil.png62cc118dc5aa4.png', 'mrpowergamerbr_logo.png62cc0863638da.png', '', '2004-03-16', 0),
(24, '@Dial168933', 5, 0, 'dialogo@mail.com', 'DialogosCurtos', '$2y$10$mHnF9TpwOsFy9L/DdXHCseQ6y.oel1nEXbgV.xqfNLtmO/Fvq8JYm', 'NfFcH3ZG_400x400.jpg62cc2b7942d30.jpg', '', 'Dialogos Curtos', '1904-02-29', 0),
(25, '@Magic_26', 3, 0, 'magic@mail.com', 'Magic', '$2y$10$zcWEOEjNuuE6pk9WddfPf.k4l20nfaCuOzIDQd8Vomw9JZLJw8CTC', '33588981afc44d9dd1904ba28c3bfd63.jpg62cc341fb28c8.jpg', 'chainsaw-man-1_a93h.jpg62cc341fb7107.jpg', '', '2004-09-26', 0),
(26, '@mart177372', 2, 1, 'martinsilveiradealmeida@gmail.com', 'corsa roubado', '$2y$10$o8FMHQ8LgEYXMUJHGexsyuWxsvMLn7UIMAgTLJCnzmVEFG5pdW4Fm', '62cc4ffa7e1f5.jpg', '62cc4ff28e93b.jpg', 'sou um corsa roubado da favela jacarezinho do rj', '2004-12-19', 0),
(27, '@Yang354167', 0, 0, 'yang@hotmail.com', 'Yang', '$2y$10$/cF9FqmOxpKFG7wowbZSDu/L01SGnftMxJqw7CPIcbcQ5RdmDVCMO', '62cda4d5bb5a6.jpg', '', 'oaishdoiashdoashd asjdiasjdoiasjdoiajsd oaisjdoiasjdojas asijdoasijdoasijdoasijdoia iasodjaosijdaoisjeqw8ue0wqueqw0ueqw0 uasijd osiajdaskmcalnmczxokcnzxlcnzx aosijdasueq8wudqwud0qwu csaoj doaskjdaosij', '2005-06-12', 0),
(28, '@pedr117085', 0, 1, 'pedrinho@gmail.com', 'pedrinho', '$2y$10$5fDXpIPbTNoqUUmn./zCXOrheKiEqRiy./TrL11aH/nmG3jKUk6Se', NULL, NULL, NULL, '1999-04-14', 0),
(29, '@test215201', 0, 5, 'teste@gmail.com', 'teste', '$2y$10$ojBGEnpLnDbq2VMVgSe2bu4XLrmmke8Q1ZZohxicgqF7zCspoLl6e', NULL, NULL, NULL, '2007-03-06', 0),
(30, '@test454369', 0, 0, 'email@email', 'test05', '$2y$10$3Ox7eTKUY70CzBmR6VRyXOuQN8qejmOG136err6HUWE61t1S7d22e', NULL, NULL, NULL, '2007-03-11', 1),
(31, '@test422544', 1, 0, 'testae@gmail.com', 'testekkk', '$2y$10$zkOgGAGuqiyrTKC9VGhwPeqJei30pKM/Ka4RiX/qMoRFRxahWb6cW', NULL, NULL, NULL, '2007-04-04', 0),
(32, '@ezquzi_15', 0, 1, 'ezquzi_15@gmail.com', 'ezquzi_15', '$2y$10$ho/mf0gqaqbz3jv8u05XBO6HPBlLg.K5bo5DyI12movdlwRau2Xm.', '', '', '', '2005-04-08', 0);

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
  MODIFY `id_publi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
