-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 186.202.152.70
-- Generation Time: 09-Dez-2022 às 12:27
-- Versão do servidor: 5.7.32-35-log
-- PHP Version: 5.6.40-0+deb8u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cepai`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `email_template`
--

CREATE TABLE `email_template` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mensagem` text COLLATE utf8_unicode_ci,
  `dt_created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `email_template`
--

INSERT INTO `email_template` (`id`, `titulo`, `mensagem`, `dt_created_at`) VALUES
(1, '{tb_tipo_ocorrencia->nm_tipo_ocorrencia}', '<b>Notificação de Ocorrência</b>\r\n<br><br>\r\n<b>{tb_tipo_ocorrencia->nm_tipo_ocorrencia}</b><br>{nm_outro_motivo}\r\n<br><br>\r\n<b>Empresa:</b> <br> {system_users->tb_empresa->nm_empresa}\r\n<br><br>\r\n<b>Local:</b> <br> {system_users->tb_empresa->ds_endereco},{system_users->tb_empresa->cd_numero} - {system_users->tb_empresa->nm_bairro} - {system_users->tb_empresa->tb_cidade->nm_cidade} / {system_users->tb_empresa->tb_cidade->tb_uf->sg_uf}\r\n<br><br>\r\n<b>Gravidade:</b> <br> {tb_gravidade->nm_gravidade}\r\n<br><br>\r\n<b>Vítimas:</b> <br> {qt_vitimas}\r\n<br><br>\r\n<b>Resumo:</b> <br> {ds_resumo}\r\n<hr>\r\n<b>Ocorrência relatada por:</b> <br> {system_users->name} - {system_users->nm_cargo}\r\n<br><br>\r\n<b>Telefone:</b> <br> {system_users->cd_telefone}\r\n<br><br>\r\n<b>E-mail:</b> <br> {system_users->login}', NULL),
(2, '{tb_tipo_ocorrencia->nm_tipo_ocorrencia}', '<b>Notificação de Ocorrência</b> <br><br> <b>{tb_tipo_ocorrencia->nm_tipo_ocorrencia}</b><br>{nm_outro_motivo} <br><br> <b>Empresa:</b> <br> {tb_empresa->nm_empresa} <br><br> <b>Local:</b> <br> {ds_endereco} <br><br> <b>Gravidade:</b> <br> {tb_gravidade->nm_gravidade} <br><br> <b>Vítimas:</b> <br> {qt_vitimas} <br><br> <b>Resumo:</b> <br> {ds_resumo} <hr> <b>Ocorrência relatada por:</b> <br> {system_users->name} - {system_users->nm_cargo} <br><br> <b>Telefone:</b> <br> {system_users->cd_telefone} <br><br> <b>E-mail:</b> <br> {system_users->login}', NULL),
(3, '{tb_tipo_ocorrencia->nm_tipo_ocorrencia}', '<b>Notificação de Ocorrência</b>\r\n<br><br>\r\n<b>{tb_tipo_ocorrencia->nm_tipo_ocorrencia}</b><br>{nm_outro_motivo}\r\n<br><br>\r\n<b>Empresa:</b> <br> {tb_empresa->nm_empresa}\r\n<br><br>\r\n<b>Local:</b><br> {tb_empresa->ds_endereco},{tb_empresa->cd_numero} - {tb_empresa->nm_bairro} - {tb_empresa->tb_cidade->nm_cidade} / {tb_empresa->tb_cidade->tb_uf->sg_uf}\r\n<br><br>\r\n<b>Gravidade:</b> <br> {tb_gravidade->nm_gravidade}\r\n<br><br>\r\n<b>Vítimas:</b> <br> {qt_vitimas}\r\n<br><br>\r\n<b>Resumo:</b> <br> {ds_resumo}\r\n<hr>\r\n<b>Ocorrência relatada por:</b> <br> {system_users->name} - {system_users->nm_cargo}\r\n<br><br>\r\n<b>Telefone:</b> <br> {system_users->cd_telefone}\r\n<br><br>\r\n<b>E-mail:</b> <br> {system_users->login}', NULL),
(4, '{tb_tipo_ocorrencia->nm_tipo_ocorrencia}', '<b>Notificação de Ocorrência</b> <br><br> <b>{tb_tipo_ocorrencia->nm_tipo_ocorrencia}</b><br>{nm_outro_motivo} <br><br> <b>Empresa:</b> <br> {tb_empresa->nm_empresa} <br><br> <b>Local:</b><br> {system_users->tb_empresa->ds_endereco},{system_users->tb_empresa->cd_numero} - {system_users->tb_empresa->nm_bairro} - {system_users->tb_empresa->tb_cidade->nm_cidade} / {system_users->tb_empresa->tb_cidade->tb_uf->sg_uf} <br><br> <b>Gravidade:</b> <br> {tb_gravidade->nm_gravidade} <br><br> <b>Vítimas:</b> <br> {qt_vitimas} <br><br> <b>Resumo:</b> <br> {ds_resumo} <hr> <b>Ocorrência relatada por:</b> <br> {system_users->name} - {system_users->nm_cargo} <br><br> <b>Telefone:</b> <br> {system_users->cd_telefone} <br><br> <b>E-mail:</b> <br> {system_users->login}', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `system_group`
--

CREATE TABLE `system_group` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `system_group`
--

INSERT INTO `system_group` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Standard'),
(3, 'Basic');

-- --------------------------------------------------------

--
-- Estrutura da tabela `system_group_program`
--

CREATE TABLE `system_group_program` (
  `id` int(11) NOT NULL,
  `system_group_id` int(11) NOT NULL,
  `system_program_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `system_group_program`
--

INSERT INTO `system_group_program` (`id`, `system_group_id`, `system_program_id`) VALUES
(228, 2, 12),
(229, 2, 13),
(230, 2, 16),
(231, 2, 17),
(232, 2, 18),
(233, 2, 19),
(234, 2, 20),
(235, 2, 22),
(236, 2, 23),
(237, 2, 24),
(238, 2, 25),
(239, 2, 30),
(240, 2, 50),
(241, 2, 55),
(242, 2, 56),
(243, 2, 67),
(244, 2, 74),
(245, 2, 75),
(246, 2, 76),
(247, 2, 77),
(248, 2, 81),
(249, 2, 82),
(251, 2, 84),
(253, 2, 83),
(255, 3, 50),
(256, 3, 55),
(257, 3, 56),
(258, 3, 67),
(259, 3, 74),
(260, 3, 75),
(261, 3, 76),
(262, 3, 77),
(263, 3, 81),
(264, 3, 82),
(265, 1, 1),
(266, 1, 2),
(267, 1, 3),
(268, 1, 4),
(269, 1, 5),
(270, 1, 6),
(271, 1, 7),
(272, 1, 8),
(273, 1, 9),
(274, 1, 10),
(275, 1, 11),
(276, 1, 12),
(277, 1, 13),
(278, 1, 14),
(279, 1, 15),
(280, 1, 16),
(281, 1, 17),
(282, 1, 18),
(283, 1, 19),
(284, 1, 20),
(285, 1, 21),
(286, 1, 22),
(287, 1, 23),
(288, 1, 24),
(289, 1, 25),
(290, 1, 26),
(291, 1, 27),
(292, 1, 28),
(293, 1, 29),
(294, 1, 30),
(295, 1, 31),
(296, 1, 32),
(297, 1, 33),
(298, 1, 34),
(299, 1, 35),
(300, 1, 36),
(301, 1, 37),
(302, 1, 38),
(303, 1, 39),
(304, 1, 40),
(305, 1, 41),
(306, 1, 42),
(307, 1, 43),
(308, 1, 45),
(309, 1, 47),
(310, 1, 48),
(311, 1, 50),
(312, 1, 51),
(313, 1, 52),
(314, 1, 53),
(315, 1, 55),
(316, 1, 56),
(317, 1, 58),
(318, 1, 61),
(319, 1, 62),
(320, 1, 63),
(321, 1, 65),
(322, 1, 66),
(323, 1, 67),
(324, 1, 74),
(325, 1, 75),
(326, 1, 76),
(327, 1, 77),
(328, 1, 78),
(329, 1, 81),
(330, 1, 82),
(331, 1, 83),
(332, 1, 84),
(333, 1, 85),
(334, 1, 86);

-- --------------------------------------------------------

--
-- Estrutura da tabela `system_preference`
--

CREATE TABLE `system_preference` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `preference` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `system_program`
--

CREATE TABLE `system_program` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `controller` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `system_program`
--

INSERT INTO `system_program` (`id`, `name`, `controller`) VALUES
(1, 'System Group Form', 'SystemGroupForm'),
(2, 'System Group List', 'SystemGroupList'),
(3, 'System Program Form', 'SystemProgramForm'),
(4, 'System Program List', 'SystemProgramList'),
(5, 'System User Form', 'SystemUserForm'),
(6, 'System User List', 'SystemUserList'),
(7, 'Common Page', 'CommonPage'),
(8, 'System PHP Info', 'SystemPHPInfoView'),
(9, 'System ChangeLog View', 'SystemChangeLogView'),
(10, 'Welcome View', 'WelcomeView'),
(11, 'System Sql Log', 'SystemSqlLogList'),
(12, 'System Profile View', 'SystemProfileView'),
(13, 'System Profile Form', 'SystemProfileForm'),
(14, 'System SQL Panel', 'SystemSQLPanel'),
(15, 'System Access Log', 'SystemAccessLogList'),
(16, 'System Message Form', 'SystemMessageForm'),
(17, 'System Message List', 'SystemMessageList'),
(18, 'System Message Form View', 'SystemMessageFormView'),
(19, 'System Notification List', 'SystemNotificationList'),
(20, 'System Notification Form View', 'SystemNotificationFormView'),
(21, 'System Document Category List', 'SystemDocumentCategoryFormList'),
(22, 'System Document Form', 'SystemDocumentForm'),
(23, 'System Document Upload Form', 'SystemDocumentUploadForm'),
(24, 'System Document List', 'SystemDocumentList'),
(25, 'System Shared Document List', 'SystemSharedDocumentList'),
(26, 'System Unit Form', 'SystemUnitForm'),
(27, 'System Unit List', 'SystemUnitList'),
(28, 'System Access stats', 'SystemAccessLogStats'),
(29, 'System Preference form', 'SystemPreferenceForm'),
(30, 'System Support form', 'SystemSupportForm'),
(31, 'System PHP Error', 'SystemPHPErrorLogView'),
(32, 'System Database Browser', 'SystemDatabaseExplorer'),
(33, 'System Table List', 'SystemTableList'),
(34, 'System Data Browser', 'SystemDataBrowser'),
(35, 'System Menu Editor', 'SystemMenuEditor'),
(36, 'System Request Log', 'SystemRequestLogList'),
(37, 'System Request Log View', 'SystemRequestLogView'),
(38, 'System Administration Dashboard', 'SystemAdministrationDashboard'),
(39, 'System Log Dashboard', 'SystemLogDashboard'),
(40, 'System Session dump', 'SystemSessionDumpView'),
(41, 'Files diff', 'SystemFilesDiff'),
(42, 'System Information', 'SystemInformationView'),
(43, 'Cidades', 'TbCidadeHeaderList'),
(45, 'Estados', 'TbUfHeaderList'),
(47, 'Empresas', 'TbEmpresaHeaderList'),
(48, 'Tipos de ocorrências', 'TbTipoOcorrenciaHeaderList'),
(50, 'Ocorrências', 'OcorrenciasListCard'),
(51, 'Áreas do Porto', 'TbAreaPortoHeaderList'),
(52, 'Gravidades', 'TbGravidadeHeaderList'),
(53, 'Cadastro de Estado', 'TbUfForm'),
(55, 'Mídia 1', 'TbOcorrenciaFormView'),
(56, 'Cadastro de Ocorrência', 'TbOcorrenciaForm'),
(58, 'Cadastro de Usuário', 'UsersRegisterForm'),
(61, 'Cadastro de Área do Porto', 'TbAreaPortoForm'),
(62, 'Cadastro de Cidade', 'TbCidadeForm'),
(63, 'Cadastro de Gravidade', 'TbGravidadeForm'),
(65, 'Cadastro de Empresa', 'TbEmpresaForm'),
(66, 'Cadastro de Tipo de Ocorrência', 'TbTipoOcorrenciaForm'),
(67, 'TbComplementoForm', 'TbComplementoForm'),
(74, 'Detalhes', 'DetalhesFormView'),
(75, 'Complemento de Ocorrência', 'ComplementoOcorrenciaForm'),
(76, 'Ver Complementos', 'ComplementosFormView'),
(77, 'Complementos Kanban', 'TbComplementoKanbanView'),
(78, 'Dashboard', 'DashboardAcompanhamento'),
(81, 'Ver Midia', 'VerMidia2'),
(82, 'Ver Midia', 'VerMidia3'),
(83, 'Ver Simulados', 'TbSimuladoCardList'),
(84, 'Cadastro de Simulado', 'TbSimuladoForm'),
(85, 'Template de E-mail', 'EmailTemplateForm'),
(86, 'E-mails', 'EmailTemplateHeaderList');

-- --------------------------------------------------------

--
-- Estrutura da tabela `system_unit`
--

CREATE TABLE `system_unit` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `connection_name` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `system_unit`
--

INSERT INTO `system_unit` (`id`, `name`, `connection_name`) VALUES
(1, 'Matriz', 'matriz');

-- --------------------------------------------------------

--
-- Estrutura da tabela `system_users`
--

CREATE TABLE `system_users` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `login` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci,
  `frontpage_id` int(11) DEFAULT NULL,
  `system_unit_id` int(11) DEFAULT NULL,
  `active` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `accepted_term_policy_at` text COLLATE utf8_unicode_ci,
  `accepted_term_policy` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tb_empresa_id` int(11) DEFAULT NULL,
  `tb_cidade_id` int(11) DEFAULT NULL,
  `tb_area_porto_id` int(11) DEFAULT NULL,
  `cd_telefone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nm_cargo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `system_users`
--

INSERT INTO `system_users` (`id`, `name`, `login`, `password`, `email`, `frontpage_id`, `system_unit_id`, `active`, `accepted_term_policy_at`, `accepted_term_policy`, `tb_empresa_id`, `tb_cidade_id`, `tb_area_porto_id`, `cd_telefone`, `nm_cargo`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'contato@waaplicativos.com.br', 6, NULL, 'Y', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'User', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'pedro@waaplicativos.com.br', 50, NULL, 'Y', '', '', NULL, NULL, NULL, NULL, NULL),
(3, 'Wesley Nascimento', 'wesley.waapp@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'wesley.waapp@gmail.com', 78, NULL, NULL, NULL, NULL, 1, 1, 2, '+5513981196421', 'Gerente'),
(13, 'Pedro Salvino', 'pedro.waapp@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'pedro.waapp@gmail.com', 50, NULL, 'Y', NULL, NULL, 2, 2, 1, '13991983961', 'Assistente Sênior');

-- --------------------------------------------------------

--
-- Estrutura da tabela `system_user_group`
--

CREATE TABLE `system_user_group` (
  `id` int(11) NOT NULL,
  `system_user_id` int(11) NOT NULL,
  `system_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `system_user_group`
--

INSERT INTO `system_user_group` (`id`, `system_user_id`, `system_group_id`) VALUES
(12, 3, 2),
(35, 13, 3),
(36, 1, 1),
(37, 1, 2),
(38, 2, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `system_user_program`
--

CREATE TABLE `system_user_program` (
  `id` int(11) NOT NULL,
  `system_user_id` int(11) NOT NULL,
  `system_program_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `system_user_program`
--

INSERT INTO `system_user_program` (`id`, `system_user_id`, `system_program_id`) VALUES
(2, 3, 78);

-- --------------------------------------------------------

--
-- Estrutura da tabela `system_user_unit`
--

CREATE TABLE `system_user_unit` (
  `id` int(11) NOT NULL,
  `system_user_id` int(11) NOT NULL,
  `system_unit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `system_user_unit`
--

INSERT INTO `system_user_unit` (`id`, `system_user_id`, `system_unit_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_area_porto`
--

CREATE TABLE `tb_area_porto` (
  `id_area_porto` int(11) NOT NULL,
  `nm_area_porto` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_area_porto`
--

INSERT INTO `tb_area_porto` (`id_area_porto`, `nm_area_porto`) VALUES
(1, 'Porto de Santos | SANTOS'),
(2, 'Porto de Santos | GUARUJÁ'),
(3, 'Porto de Santos | CUBATÃO'),
(4, 'Porto de São Sebastião');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cidade`
--

CREATE TABLE `tb_cidade` (
  `id_cidade` int(11) NOT NULL,
  `nm_cidade` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `tb_uf_id` int(11) NOT NULL,
  `cd_ibge` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_cidade`
--

INSERT INTO `tb_cidade` (`id_cidade`, `nm_cidade`, `tb_uf_id`, `cd_ibge`) VALUES
(1, 'Guarujá', 1, '3518701'),
(2, 'Santos', 1, '3548500'),
(3, 'Cubatão', 1, '3513504'),
(4, 'São Sebastião', 1, '3550704');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_complemento`
--

CREATE TABLE `tb_complemento` (
  `id_complemento` int(11) NOT NULL,
  `ds_complemento` text COLLATE utf8_unicode_ci,
  `dt_created_at` datetime DEFAULT NULL,
  `system_users_id` int(11) DEFAULT NULL,
  `tb_ocorrencia_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_empresa`
--

CREATE TABLE `tb_empresa` (
  `id_empresa` int(11) NOT NULL,
  `nm_empresa` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cd_cnpj` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ds_endereco` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cd_cep` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nm_bairro` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ds_complemento` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cd_numero` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tb_cidade_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_empresa`
--

INSERT INTO `tb_empresa` (`id_empresa`, `nm_empresa`, `cd_cnpj`, `ds_endereco`, `cd_cep`, `nm_bairro`, `ds_complemento`, `cd_numero`, `tb_cidade_id`) VALUES
(1, 'Santos Brasil', '02.762.121/0009-53', 'Via Santos Dumont', '11460-970', 'Vila Aurea', NULL, 's/n', 1),
(2, 'Santos Port Authority', '112255448877', ' Av. Conselheiro Rodrigues Alves', '11015-900', 'Macuco', NULL, 's/n', 2),
(3, 'Brasil Terminal Portuário (BTP)', '04.887.625/0001-78', 'Av. Eng. Augusto Barata', '11095-650', NULL, NULL, NULL, 2),
(4, 'Rumo Logística', '02.387.241/0001-60', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Terminal 12A', '56.216.872/0001-46', 'Rua Xavier da Silveira', '11013-928', 'Paquetá', NULL, 's/n', 2),
(6, 'Termag', '05.535.627/0001-60', 'Via Santos Dumont', '11460-000', NULL, NULL, 's/n', 1),
(7, 'PORTOFER', '03.835.338/0001-51', 'Av. Eduardo Pereira Guinle', '11013-250', NULL, NULL, 's/n', 2),
(8, 'Elevações Portuárias', '25.278.404/0001-72', 'Avenida Eduardo Pereira Guinle', '11013-250', NULL, NULL, 's/n', 2),
(9, 'Hidrovias do Brasil', '34.189.633/0001-01', 'Av. Conde D\'Eu - Docas', '11015-050', NULL, NULL, NULL, 2),
(10, 'Ecoporto Santos', '02.390.435/0001-15', 'Av. Eng. Antonio Alves Freire', '11010-285', NULL, NULL, 's/n', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_gravidade`
--

CREATE TABLE `tb_gravidade` (
  `id_gravidade` int(11) NOT NULL,
  `nm_gravidade` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `cd_cor` varchar(8) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_gravidade`
--

INSERT INTO `tb_gravidade` (`id_gravidade`, `nm_gravidade`, `cd_cor`) VALUES
(1, 'Baixa', '#35CE8D'),
(2, 'Média', '#F4D35E'),
(3, 'Alta', '#E54B4B');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_ocorrencia`
--

CREATE TABLE `tb_ocorrencia` (
  `id_ocorrencia` int(11) NOT NULL,
  `dt_ocorrencia` datetime NOT NULL,
  `dt_created_at` datetime DEFAULT NULL,
  `dt_updated_at` datetime DEFAULT NULL,
  `dt_deleted_at` datetime DEFAULT NULL,
  `ic_mudar_empresa` tinyint(1) DEFAULT NULL,
  `nm_outro_motivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ds_resumo` text COLLATE utf8_unicode_ci NOT NULL,
  `qt_vitimas` int(11) NOT NULL,
  `im_midia1` text COLLATE utf8_unicode_ci,
  `im_midia2` text COLLATE utf8_unicode_ci,
  `im_midia3` text COLLATE utf8_unicode_ci,
  `tb_tipo_ocorrencia_id` int(11) NOT NULL,
  `tb_gravidade_id` int(11) NOT NULL,
  `system_users_id` int(11) NOT NULL,
  `tb_empresa_id` int(11) DEFAULT NULL,
  `ds_endereco` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_simulado`
--

CREATE TABLE `tb_simulado` (
  `id_simulado` int(11) NOT NULL,
  `dt_simulado` datetime DEFAULT NULL,
  `dt_created_at` datetime DEFAULT NULL,
  `ds_relatorio` text COLLATE utf8_unicode_ci,
  `system_users_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipo_ocorrencia`
--

CREATE TABLE `tb_tipo_ocorrencia` (
  `id_tipo_ocorrencia` int(11) NOT NULL,
  `nm_tipo_ocorrencia` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `nm_localizacao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ds_complemento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_tipo_ocorrencia`
--

INSERT INTO `tb_tipo_ocorrencia` (`id_tipo_ocorrencia`, `nm_tipo_ocorrencia`, `nm_localizacao`, `ds_complemento`) VALUES
(1, 'Ocorrência a bordo', NULL, NULL),
(2, 'Ocorrência no estuário', NULL, NULL),
(3, 'Ocorrência em área operacional', NULL, NULL),
(4, 'Ocorrência com carga IMO', NULL, NULL),
(5, 'Ocorrência em vias de acesso', NULL, NULL),
(6, 'Ocorrência com equipamento', NULL, NULL),
(7, 'Outro motivo', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_uf`
--

CREATE TABLE `tb_uf` (
  `id_uf` int(11) NOT NULL,
  `nm_uf` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `sg_uf` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `cd_ibge` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_uf`
--

INSERT INTO `tb_uf` (`id_uf`, `nm_uf`, `sg_uf`, `cd_ibge`) VALUES
(1, 'São Paulo', 'SP', '35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_group`
--
ALTER TABLE `system_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_group_program`
--
ALTER TABLE `system_group_program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_system_group_program_1` (`system_program_id`),
  ADD KEY `fk_system_group_program_2` (`system_group_id`);

--
-- Indexes for table `system_preference`
--
ALTER TABLE `system_preference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_program`
--
ALTER TABLE `system_program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_unit`
--
ALTER TABLE `system_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_users`
--
ALTER TABLE `system_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_system_user_1` (`system_unit_id`),
  ADD KEY `fk_system_user_2` (`frontpage_id`),
  ADD KEY `fk_system_users_3` (`tb_empresa_id`),
  ADD KEY `fk_system_users_4` (`tb_cidade_id`),
  ADD KEY `fk_system_users_5` (`tb_area_porto_id`);

--
-- Indexes for table `system_user_group`
--
ALTER TABLE `system_user_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_system_user_group_1` (`system_group_id`),
  ADD KEY `fk_system_user_group_2` (`system_user_id`);

--
-- Indexes for table `system_user_program`
--
ALTER TABLE `system_user_program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_system_user_program_1` (`system_program_id`),
  ADD KEY `fk_system_user_program_2` (`system_user_id`);

--
-- Indexes for table `system_user_unit`
--
ALTER TABLE `system_user_unit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_system_user_unit_1` (`system_user_id`),
  ADD KEY `fk_system_user_unit_2` (`system_unit_id`);

--
-- Indexes for table `tb_area_porto`
--
ALTER TABLE `tb_area_porto`
  ADD PRIMARY KEY (`id_area_porto`);

--
-- Indexes for table `tb_cidade`
--
ALTER TABLE `tb_cidade`
  ADD PRIMARY KEY (`id_cidade`),
  ADD KEY `fk_tb_cidade_1` (`tb_uf_id`);

--
-- Indexes for table `tb_complemento`
--
ALTER TABLE `tb_complemento`
  ADD PRIMARY KEY (`id_complemento`),
  ADD KEY `fk_tb_complemento_2` (`system_users_id`),
  ADD KEY `fk_tb_complemento_3` (`tb_ocorrencia_id`);

--
-- Indexes for table `tb_empresa`
--
ALTER TABLE `tb_empresa`
  ADD PRIMARY KEY (`id_empresa`),
  ADD KEY `fk_tb_empresa_1` (`tb_cidade_id`);

--
-- Indexes for table `tb_gravidade`
--
ALTER TABLE `tb_gravidade`
  ADD PRIMARY KEY (`id_gravidade`);

--
-- Indexes for table `tb_ocorrencia`
--
ALTER TABLE `tb_ocorrencia`
  ADD PRIMARY KEY (`id_ocorrencia`),
  ADD KEY `fk_tb_ocorrencia_1` (`tb_tipo_ocorrencia_id`),
  ADD KEY `fk_tb_ocorrencia_2` (`tb_gravidade_id`),
  ADD KEY `fk_tb_ocorrencia_3` (`system_users_id`),
  ADD KEY `fk_tb_ocorrencia_4` (`tb_empresa_id`);

--
-- Indexes for table `tb_simulado`
--
ALTER TABLE `tb_simulado`
  ADD PRIMARY KEY (`id_simulado`),
  ADD KEY `fk_tb_simulado_1` (`system_users_id`);

--
-- Indexes for table `tb_tipo_ocorrencia`
--
ALTER TABLE `tb_tipo_ocorrencia`
  ADD PRIMARY KEY (`id_tipo_ocorrencia`);

--
-- Indexes for table `tb_uf`
--
ALTER TABLE `tb_uf`
  ADD PRIMARY KEY (`id_uf`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_area_porto`
--
ALTER TABLE `tb_area_porto`
  MODIFY `id_area_porto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_cidade`
--
ALTER TABLE `tb_cidade`
  MODIFY `id_cidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_complemento`
--
ALTER TABLE `tb_complemento`
  MODIFY `id_complemento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_empresa`
--
ALTER TABLE `tb_empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_gravidade`
--
ALTER TABLE `tb_gravidade`
  MODIFY `id_gravidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_ocorrencia`
--
ALTER TABLE `tb_ocorrencia`
  MODIFY `id_ocorrencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_simulado`
--
ALTER TABLE `tb_simulado`
  MODIFY `id_simulado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_tipo_ocorrencia`
--
ALTER TABLE `tb_tipo_ocorrencia`
  MODIFY `id_tipo_ocorrencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_uf`
--
ALTER TABLE `tb_uf`
  MODIFY `id_uf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `system_group_program`
--
ALTER TABLE `system_group_program`
  ADD CONSTRAINT `fk_system_group_program_1` FOREIGN KEY (`system_program_id`) REFERENCES `system_program` (`id`),
  ADD CONSTRAINT `fk_system_group_program_2` FOREIGN KEY (`system_group_id`) REFERENCES `system_group` (`id`);

--
-- Limitadores para a tabela `system_users`
--
ALTER TABLE `system_users`
  ADD CONSTRAINT `fk_system_user_1` FOREIGN KEY (`system_unit_id`) REFERENCES `system_unit` (`id`),
  ADD CONSTRAINT `fk_system_user_2` FOREIGN KEY (`frontpage_id`) REFERENCES `system_program` (`id`),
  ADD CONSTRAINT `fk_system_users_3` FOREIGN KEY (`tb_empresa_id`) REFERENCES `tb_empresa` (`id_empresa`),
  ADD CONSTRAINT `fk_system_users_4` FOREIGN KEY (`tb_cidade_id`) REFERENCES `tb_cidade` (`id_cidade`),
  ADD CONSTRAINT `fk_system_users_5` FOREIGN KEY (`tb_area_porto_id`) REFERENCES `tb_area_porto` (`id_area_porto`);

--
-- Limitadores para a tabela `system_user_group`
--
ALTER TABLE `system_user_group`
  ADD CONSTRAINT `fk_system_user_group_1` FOREIGN KEY (`system_group_id`) REFERENCES `system_group` (`id`),
  ADD CONSTRAINT `fk_system_user_group_2` FOREIGN KEY (`system_user_id`) REFERENCES `system_users` (`id`);

--
-- Limitadores para a tabela `system_user_program`
--
ALTER TABLE `system_user_program`
  ADD CONSTRAINT `fk_system_user_program_1` FOREIGN KEY (`system_program_id`) REFERENCES `system_program` (`id`),
  ADD CONSTRAINT `fk_system_user_program_2` FOREIGN KEY (`system_user_id`) REFERENCES `system_users` (`id`);

--
-- Limitadores para a tabela `system_user_unit`
--
ALTER TABLE `system_user_unit`
  ADD CONSTRAINT `fk_system_user_unit_1` FOREIGN KEY (`system_user_id`) REFERENCES `system_users` (`id`),
  ADD CONSTRAINT `fk_system_user_unit_2` FOREIGN KEY (`system_unit_id`) REFERENCES `system_unit` (`id`);

--
-- Limitadores para a tabela `tb_cidade`
--
ALTER TABLE `tb_cidade`
  ADD CONSTRAINT `fk_tb_cidade_1` FOREIGN KEY (`tb_uf_id`) REFERENCES `tb_uf` (`id_uf`);

--
-- Limitadores para a tabela `tb_complemento`
--
ALTER TABLE `tb_complemento`
  ADD CONSTRAINT `fk_tb_complemento_2` FOREIGN KEY (`system_users_id`) REFERENCES `system_users` (`id`),
  ADD CONSTRAINT `fk_tb_complemento_3` FOREIGN KEY (`tb_ocorrencia_id`) REFERENCES `tb_ocorrencia` (`id_ocorrencia`);

--
-- Limitadores para a tabela `tb_empresa`
--
ALTER TABLE `tb_empresa`
  ADD CONSTRAINT `fk_tb_empresa_1` FOREIGN KEY (`tb_cidade_id`) REFERENCES `tb_cidade` (`id_cidade`);

--
-- Limitadores para a tabela `tb_ocorrencia`
--
ALTER TABLE `tb_ocorrencia`
  ADD CONSTRAINT `fk_tb_ocorrencia_1` FOREIGN KEY (`tb_tipo_ocorrencia_id`) REFERENCES `tb_tipo_ocorrencia` (`id_tipo_ocorrencia`),
  ADD CONSTRAINT `fk_tb_ocorrencia_2` FOREIGN KEY (`tb_gravidade_id`) REFERENCES `tb_gravidade` (`id_gravidade`),
  ADD CONSTRAINT `fk_tb_ocorrencia_3` FOREIGN KEY (`system_users_id`) REFERENCES `system_users` (`id`),
  ADD CONSTRAINT `fk_tb_ocorrencia_4` FOREIGN KEY (`tb_empresa_id`) REFERENCES `tb_empresa` (`id_empresa`);

--
-- Limitadores para a tabela `tb_simulado`
--
ALTER TABLE `tb_simulado`
  ADD CONSTRAINT `fk_tb_simulado_1` FOREIGN KEY (`system_users_id`) REFERENCES `system_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
