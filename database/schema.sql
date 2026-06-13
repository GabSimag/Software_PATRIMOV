-- MariaDB dump 10.19  Distrib 10.4.34-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: patrimov
-- ------------------------------------------------------
-- Server version	10.4.34-MariaDB-1:10.4.34+maria~ubu2004

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `vida_util_anos` int(11) DEFAULT 5,
  `descricao` varchar(255) DEFAULT NULL,
  `status` enum('ATIVO','INATIVO') DEFAULT 'ATIVO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fotos`
--

DROP TABLE IF EXISTS `fotos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_servico` int(11) NOT NULL,
  `caminho_arquivo` varchar(255) NOT NULL,
  `data_upload` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_servico` (`id_servico`),
  CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`id_servico`) REFERENCES `servicos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `logs_auditoria`
--

DROP TABLE IF EXISTS `logs_auditoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs_auditoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `acao` varchar(100) NOT NULL,
  `tabela_afetada` varchar(100) DEFAULT NULL,
  `registro_id` int(11) DEFAULT NULL,
  `detalhes` text DEFAULT NULL,
  `ip_origem` varchar(45) DEFAULT NULL,
  `data_hora` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `logs_auditoria_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `movimentacoes`
--

DROP TABLE IF EXISTS `movimentacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimentacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_patrimonio` int(11) NOT NULL,
  `id_unidade_origem` int(11) NOT NULL,
  `id_unidade_destino` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo_movimentacao` enum('TRANSFERENCIA','EMPRESTIMO','BAIXA','OUTRO') DEFAULT 'TRANSFERENCIA',
  `data_movimentacao` datetime DEFAULT current_timestamp(),
  `observacao` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_patrimonio` (`id_patrimonio`),
  KEY `id_unidade_origem` (`id_unidade_origem`),
  KEY `id_unidade_destino` (`id_unidade_destino`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `movimentacoes_ibfk_1` FOREIGN KEY (`id_patrimonio`) REFERENCES `patrimonios` (`id`),
  CONSTRAINT `movimentacoes_ibfk_2` FOREIGN KEY (`id_unidade_origem`) REFERENCES `unidades` (`id`),
  CONSTRAINT `movimentacoes_ibfk_3` FOREIGN KEY (`id_unidade_destino`) REFERENCES `unidades` (`id`),
  CONSTRAINT `movimentacoes_ibfk_4` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER trg_movimentacao_cadastrada
AFTER INSERT ON movimentacoes
FOR EACH ROW
BEGIN

    INSERT INTO logs_auditoria (
        acao,
        tabela_afetada,
        registro_id,
        detalhes
    )
    VALUES (
        'MOVIMENTACAO_CADASTRADA',
        'movimentacoes',
        NEW.id,
        CONCAT(
            'Movimentação ',
            NEW.tipo_movimentacao,
            ' registrada.'
        )
    );

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `patrimonios`
--

DROP TABLE IF EXISTS `patrimonios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patrimonios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `id_unidade` int(11) NOT NULL,
  `codigo_patrimonial` varchar(30) NOT NULL,
  `placa` varchar(20) DEFAULT NULL,
  `descricao` text NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `num_serie` varchar(100) DEFAULT NULL,
  `data_aquisicao` date DEFAULT NULL,
  `valor_aquisicao` decimal(14,2) DEFAULT NULL,
  `estado_conservacao` enum('NOVO','BOM','REGULAR','RUIM','INSERVÍVEL') DEFAULT 'BOM',
  `status` enum('ATIVO','MANUTENCAO','BAIXADO') DEFAULT 'ATIVO',
  `data_baixa` datetime DEFAULT NULL,
  `motivo_baixa` text DEFAULT NULL,
  `data_cadastro` datetime DEFAULT current_timestamp(),
  `item` varchar(150) DEFAULT NULL,
  `numero_nota` varchar(50) DEFAULT NULL,
  `serie` varchar(50) DEFAULT NULL,
  `data_nota` date DEFAULT NULL,
  `data_empenho` date DEFAULT NULL,
  `numero_empenho` varchar(50) DEFAULT NULL,
  `numero_processo_administrativo` varchar(100) DEFAULT NULL,
  `valor` decimal(14,2) DEFAULT 0.00,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_patrimonial` (`codigo_patrimonial`),
  UNIQUE KEY `placa` (`placa`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_unidade` (`id_unidade`),
  CONSTRAINT `patrimonios_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`),
  CONSTRAINT `patrimonios_ibfk_2` FOREIGN KEY (`id_unidade`) REFERENCES `unidades` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER trg_patrimonio_cadastrado
AFTER INSERT ON patrimonios
FOR EACH ROW
BEGIN

    INSERT INTO logs_auditoria (
        acao,
        tabela_afetada,
        registro_id,
        detalhes
    )
    VALUES (
        'PATRIMONIO_CADASTRADO',
        'patrimonios',
        NEW.id,
        CONCAT(
            'Patrimônio ',
            NEW.codigo_patrimonial,
            ' cadastrado.'
        )
    );

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER trg_patrimonio_baixado
AFTER UPDATE ON patrimonios
FOR EACH ROW
BEGIN

    IF OLD.status <> 'BAIXADO'
       AND NEW.status = 'BAIXADO'
    THEN

        INSERT INTO logs_auditoria (
            acao,
            tabela_afetada,
            registro_id,
            detalhes
        )
        VALUES (
            'PATRIMONIO_BAIXADO',
            'patrimonios',
            NEW.id,
            CONCAT(
                'Patrimônio ',
                NEW.codigo_patrimonial,
                ' baixado.'
            )
        );

    END IF;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `perfis`
--

DROP TABLE IF EXISTS `perfis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `permissoes` text DEFAULT NULL,
  `data_cadastro` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `servicos`
--

DROP TABLE IF EXISTS `servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_patrimonio` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo_servico` enum('MANUTENÇÃO','REPARO','PATRIMONIAÇÃO','INSPEÇÃO','OUTRO') DEFAULT 'PATRIMONIAÇÃO',
  `descricao` text NOT NULL,
  `data_solicitacao` datetime DEFAULT current_timestamp(),
  `data_execucao` datetime DEFAULT NULL,
  `custo` decimal(14,2) DEFAULT 0.00,
  `status` enum('SOLICITADO','EM_ANDAMENTO','CONCLUIDO','CANCELADO') DEFAULT 'SOLICITADO',
  PRIMARY KEY (`id`),
  KEY `id_patrimonio` (`id_patrimonio`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `servicos_ibfk_1` FOREIGN KEY (`id_patrimonio`) REFERENCES `patrimonios` (`id`),
  CONSTRAINT `servicos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER trg_servico_concluido
AFTER UPDATE ON servicos
FOR EACH ROW
BEGIN

    IF OLD.status <> 'CONCLUIDO'
       AND NEW.status = 'CONCLUIDO'
    THEN

        INSERT INTO logs_auditoria (
            acao,
            tabela_afetada,
            registro_id,
            detalhes
        )
        VALUES (
            'SERVICO_CONCLUIDO',
            'servicos',
            NEW.id,
            CONCAT(
                'Serviço ',
                NEW.id,
                ' concluído.'
            )
        );

    END IF;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `ugs`
--

DROP TABLE IF EXISTS `ugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `nome_fantasia` varchar(150) NOT NULL,
  `sigla` varchar(20) DEFAULT NULL,
  `origem` enum('Prefeitura','Educação','Saúde','Assistência Social','Outro') DEFAULT 'Prefeitura',
  `status` enum('ATIVO','INATIVO') DEFAULT 'ATIVO',
  `data_cadastro` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `unidades`
--

DROP TABLE IF EXISTS `unidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ug` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `gps_coords` varchar(100) DEFAULT NULL,
  `responsavel` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `status` enum('ATIVO','INATIVO') DEFAULT 'ATIVO',
  PRIMARY KEY (`id`),
  KEY `id_ug` (`id_ug`),
  CONSTRAINT `unidades_ibfk_1` FOREIGN KEY (`id_ug`) REFERENCES `ugs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_perfil` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `status` enum('ATIVO','INATIVO') DEFAULT 'ATIVO',
  `data_cadastro` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `email` (`email`),
  KEY `id_perfil` (`id_perfil`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfis` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping events for database 'patrimov'
--

--
-- Dumping routines for database 'patrimov'
--
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP FUNCTION IF EXISTS `fn_valor_patrimonios_por_status` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `fn_valor_patrimonios_por_status`(p_status VARCHAR(20)) RETURNS decimal(14,2)
    DETERMINISTIC
BEGIN
    DECLARE total DECIMAL(14,2);

    SELECT COALESCE(SUM(valor), 0)
    INTO total
    FROM patrimonios
    WHERE p_status IS NULL
       OR p_status = ''
       OR status = p_status;

    RETURN total;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_relatorio_patrimonios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `sp_relatorio_patrimonios`(
    IN p_status VARCHAR(20),
    IN p_id_unidade INT,
    IN p_id_categoria INT
)
BEGIN

    SELECT
        p.id,
        p.codigo_patrimonial,
        p.descricao,
        p.valor,
        p.status,
        c.nome AS categoria,
        u.nome AS unidade
    FROM patrimonios p

    LEFT JOIN categorias c
        ON c.id = p.id_categoria

    LEFT JOIN unidades u
        ON u.id = p.id_unidade

    WHERE
        (p_status IS NULL OR p_status = '' OR p.status = p_status)

        AND

        (
            p_id_unidade IS NULL
            OR p_id_unidade = 0
            OR p.id_unidade = p_id_unidade
        )

        AND

        (
            p_id_categoria IS NULL
            OR p_id_categoria = 0
            OR p.id_categoria = p_id_categoria
        )

    ORDER BY p.codigo_patrimonial;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-13 20:56:29
