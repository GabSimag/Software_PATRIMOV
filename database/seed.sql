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
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Teste',5,'Descrição Teste','ATIVO'),(101,'Computadores',5,'Desktops e estações de trabalho','ATIVO'),(102,'Notebooks',5,'Equipamentos portáteis de informática','ATIVO'),(103,'Impressoras',4,'Equipamentos de impressão e cópia','ATIVO'),(104,'Mobiliário',10,'Mesas, cadeiras, armários e estantes','ATIVO'),(105,'Equipamentos Médicos',8,'Equipamentos utilizados em unidades de saúde','ATIVO'),(106,'Veículos',10,'Veículos leves, utilitários e vans','ATIVO'),(107,'Equipamentos Esportivos',6,'Itens utilizados em práticas esportivas','ATIVO'),(108,'Equipamentos de Áudio e Vídeo',6,'Projetores, caixas de som e televisores','ATIVO'),(109,'Ferramentas',7,'Ferramentas manuais e elétricas','ATIVO'),(110,'Equipamentos de Segurança',5,'Câmeras, rádios e equipamentos de vigilância','ATIVO'),(111,'Equipamentos de Rede',5,'Switches, roteadores e access points','ATIVO'),(112,'Eletrodomésticos',8,'Geladeiras, micro-ondas e bebedouros','ATIVO');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `fotos`
--

LOCK TABLES `fotos` WRITE;
/*!40000 ALTER TABLE `fotos` DISABLE KEYS */;
/*!40000 ALTER TABLE `fotos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `logs_auditoria`
--

LOCK TABLES `logs_auditoria` WRITE;
/*!40000 ALTER TABLE `logs_auditoria` DISABLE KEYS */;
INSERT INTO `logs_auditoria` VALUES (1,NULL,'USUARIO_CRIADO','usuarios',6,'Novo usuário cadastrado.','172.19.0.1','2026-05-30 21:45:09'),(2,NULL,'USUARIO_CRIADO','usuarios',8,'Novo usuário cadastrado.','172.19.0.1','2026-05-30 21:45:41'),(3,NULL,'USUARIO_CRIADO','usuarios',10,'Novo usuário cadastrado.','172.19.0.1','2026-05-30 21:46:05'),(4,1,'USUARIO_CRIADO','usuarios',12,'Novo usuário cadastrado.','172.19.0.1','2026-05-30 21:48:06'),(5,1,'USUARIO_EDITADO','usuarios',12,'Dados do usuário atualizados.','172.19.0.1','2026-05-30 21:48:34'),(6,1,'USUARIO_STATUS','usuarios',10,'Status alterado para INATIVO','172.19.0.1','2026-05-30 21:48:40'),(7,1,'USUARIO_STATUS','usuarios',8,'Status alterado para INATIVO','172.19.0.1','2026-05-30 21:48:42'),(8,1,'USUARIO_STATUS','usuarios',6,'Status alterado para INATIVO','172.19.0.1','2026-05-30 21:48:44'),(9,NULL,'PATRIMONIO_BAIXADO','patrimonios',3,'Patrimônio 3 baixado.',NULL,'2026-05-30 22:13:11'),(10,NULL,'MOVIMENTACAO_CADASTRADA','movimentacoes',3,'Movimentação BAIXA registrada.',NULL,'2026-05-30 22:13:11'),(11,NULL,'PATRIMONIO_CADASTRADO','patrimonios',4,'Patrimônio 4 cadastrado.',NULL,'2026-05-30 22:13:50'),(12,NULL,'SERVICO_CONCLUIDO','servicos',7,'Serviço 7 concluído.',NULL,'2026-05-30 22:14:23'),(13,1,'USUARIO_CRIADO','usuarios',13,'Novo usuário cadastrado.','172.19.0.1','2026-05-31 17:09:51'),(14,1,'USUARIO_CRIADO','usuarios',14,'Novo usuário cadastrado.','172.19.0.1','2026-05-31 17:10:15'),(15,1,'USUARIO_CRIADO','usuarios',15,'Novo usuário cadastrado.','172.19.0.1','2026-05-31 17:10:41'),(16,1,'USUARIO_CRIADO','usuarios',16,'Novo usuário cadastrado.','172.19.0.1','2026-05-31 17:11:02'),(17,1,'USUARIO_CRIADO','usuarios',17,'Novo usuário cadastrado.','172.19.0.1','2026-05-31 17:11:28'),(18,1,'USUARIO_CRIADO','usuarios',18,'Novo usuário cadastrado.','172.19.0.1','2026-05-31 17:11:59'),(31,NULL,'PATRIMONIO_CADASTRADO','patrimonios',101,'Patrimônio PAT0101 cadastrado.',NULL,'2026-05-31 22:19:51'),(32,NULL,'PATRIMONIO_CADASTRADO','patrimonios',102,'Patrimônio PAT0102 cadastrado.',NULL,'2026-05-31 22:19:51'),(33,NULL,'PATRIMONIO_CADASTRADO','patrimonios',103,'Patrimônio PAT0103 cadastrado.',NULL,'2026-05-31 22:19:51'),(34,NULL,'PATRIMONIO_CADASTRADO','patrimonios',104,'Patrimônio PAT0104 cadastrado.',NULL,'2026-05-31 22:19:51'),(35,NULL,'PATRIMONIO_CADASTRADO','patrimonios',105,'Patrimônio PAT0105 cadastrado.',NULL,'2026-05-31 22:19:51'),(36,NULL,'PATRIMONIO_CADASTRADO','patrimonios',106,'Patrimônio PAT0106 cadastrado.',NULL,'2026-05-31 22:19:51'),(37,NULL,'PATRIMONIO_CADASTRADO','patrimonios',107,'Patrimônio PAT0107 cadastrado.',NULL,'2026-05-31 22:19:51'),(38,NULL,'PATRIMONIO_CADASTRADO','patrimonios',108,'Patrimônio PAT0108 cadastrado.',NULL,'2026-05-31 22:19:51'),(39,NULL,'PATRIMONIO_CADASTRADO','patrimonios',109,'Patrimônio PAT0109 cadastrado.',NULL,'2026-05-31 22:19:51'),(40,NULL,'PATRIMONIO_CADASTRADO','patrimonios',110,'Patrimônio PAT0110 cadastrado.',NULL,'2026-05-31 22:19:51'),(41,NULL,'PATRIMONIO_CADASTRADO','patrimonios',111,'Patrimônio PAT0111 cadastrado.',NULL,'2026-05-31 22:19:51'),(42,NULL,'PATRIMONIO_CADASTRADO','patrimonios',112,'Patrimônio PAT0112 cadastrado.',NULL,'2026-05-31 22:19:51'),(43,NULL,'MOVIMENTACAO_CADASTRADA','movimentacoes',4,'Movimentação TRANSFERENCIA registrada.',NULL,'2026-05-31 22:21:28'),(44,1,'MOVIMENTACAO_CADASTRADA','movimentacoes',4,'Movimentação registrada e unidade do patrimônio atualizada.','172.19.0.1','2026-05-31 22:21:28'),(45,NULL,'SERVICO_CONCLUIDO','servicos',43,'Serviço 43 concluído.',NULL,'2026-05-31 22:49:37'),(46,1,'USUARIO_STATUS','usuarios',6,'Status alterado para ATIVO','172.19.0.1','2026-05-31 22:51:50'),(47,1,'USUARIO_EDITADO','usuarios',6,'Dados do usuário atualizados.','172.19.0.1','2026-05-31 22:52:07'),(48,1,'USUARIO_EDITADO','usuarios',8,'Dados do usuário atualizados.','172.19.0.1','2026-05-31 22:52:36'),(49,1,'USUARIO_EDITADO','usuarios',12,'Dados do usuário atualizados.','172.19.0.1','2026-05-31 22:53:09'),(50,NULL,'SERVICO_CONCLUIDO','servicos',42,'Serviço 42 concluído.',NULL,'2026-05-31 23:09:12'),(51,NULL,'SERVICO_CONCLUIDO','servicos',44,'Serviço 44 concluído.',NULL,'2026-05-31 23:12:06'),(52,NULL,'PATRIMONIO_BAIXADO','patrimonios',112,'Patrimônio PAT0112 baixado.',NULL,'2026-05-31 23:12:17'),(53,NULL,'MOVIMENTACAO_CADASTRADA','movimentacoes',5,'Movimentação BAIXA registrada.',NULL,'2026-05-31 23:12:17'),(54,NULL,'PATRIMONIO_BAIXADO','patrimonios',111,'Patrimônio PAT0111 baixado.',NULL,'2026-06-02 12:58:08'),(55,NULL,'MOVIMENTACAO_CADASTRADA','movimentacoes',6,'Movimentação BAIXA registrada.',NULL,'2026-06-02 12:58:08'),(56,NULL,'MOVIMENTACAO_CADASTRADA','movimentacoes',7,'Movimentação TRANSFERENCIA registrada.',NULL,'2026-06-02 13:00:17'),(57,1,'MOVIMENTACAO_CADASTRADA','movimentacoes',7,'Movimentação registrada e unidade do patrimônio atualizada.','172.19.0.1','2026-06-02 13:00:17'),(58,1,'USUARIO_EDITADO','usuarios',1,'Dados do usuário atualizados.','172.19.0.1','2026-06-13 20:42:35');
/*!40000 ALTER TABLE `logs_auditoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `movimentacoes`
--

LOCK TABLES `movimentacoes` WRITE;
/*!40000 ALTER TABLE `movimentacoes` DISABLE KEYS */;
INSERT INTO `movimentacoes` VALUES (1,1,1,NULL,1,'BAIXA','2026-05-26 23:22:23','teste'),(2,2,1,NULL,1,'BAIXA','2026-05-30 00:26:49','aaa'),(3,3,1,NULL,1,'BAIXA','2026-05-30 22:13:11','a'),(4,101,101,103,1,'TRANSFERENCIA','2026-05-31 22:21:28','a'),(5,112,112,NULL,1,'BAIXA','2026-05-31 23:12:17','a'),(6,111,111,NULL,1,'BAIXA','2026-06-02 12:58:08','aa'),(7,103,103,110,1,'TRANSFERENCIA','2026-06-02 13:00:17','aa');
/*!40000 ALTER TABLE `movimentacoes` ENABLE KEYS */;
UNLOCK TABLES;
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
-- Dumping data for table `patrimonios`
--

LOCK TABLES `patrimonios` WRITE;
/*!40000 ALTER TABLE `patrimonios` DISABLE KEYS */;
INSERT INTO `patrimonios` VALUES (1,1,1,'1',NULL,'Teste1','Teste2','Teste3',NULL,NULL,NULL,'BOM','BAIXADO','2026-05-26 23:22:23','teste','2026-05-26 22:36:05','TesteItem','01','001','1000-01-01','1000-01-01','01/1000','01/1001',0.00),(2,1,1,'2',NULL,'Teste1','Teste2','teste',NULL,NULL,NULL,'NOVO','BAIXADO','2026-05-30 00:26:49','aaa','2026-05-26 23:26:25','','','',NULL,NULL,'','',1000.00),(3,1,1,'3',NULL,'aaaaa','bbbb','bkbkbk',NULL,NULL,NULL,'NOVO','BAIXADO','2026-05-30 22:13:11','a','2026-05-27 00:50:03','','','',NULL,NULL,'','',8374.00),(4,1,1,'4',NULL,'adfdsa','asdfew','fwqef',NULL,NULL,NULL,'NOVO','ATIVO',NULL,NULL,'2026-05-30 22:13:50','fewqef','123432','12321','1111-11-11','1111-11-11','1234','123443',1234.00),(101,101,103,'PAT0101','PL0101','Computador Dell OptiPlex para laboratório escolar','Dell','OptiPlex 3080','SN-PAT0101','2024-02-10',3500.00,'BOM','ATIVO',NULL,NULL,'2026-05-31 22:19:51','Computador desktop','NF-1001','A1','2024-02-10','2024-02-05','EMP-1001','PA-2024-0101',3500.00),(102,102,102,'PAT0102','PL0102','Notebook Lenovo ThinkPad para coordenação da UBS','Lenovo','ThinkPad E14','SN-PAT0102','2024-03-12',5200.00,'NOVO','ATIVO',NULL,NULL,'2026-05-31 22:19:51','Notebook','NF-1002','A1','2024-03-12','2024-03-08','EMP-1002','PA-2024-0102',5200.00),(103,103,110,'PAT0103','PL0103','Impressora HP LaserJet para setor administrativo','HP','LaserJet Pro M404','SN-PAT0103','2023-11-20',1800.00,'BOM','ATIVO',NULL,NULL,'2026-05-31 22:19:51','Impressora laser','NF-1003','B2','2023-11-20','2023-11-15','EMP-1003','PA-2023-0103',1800.00),(104,104,104,'PAT0104','PL0104','Mesa de escritório para garagem municipal','Pandim','Mesa 1,60m','SN-PAT0104','2023-08-05',750.00,'BOM','ATIVO',NULL,NULL,'2026-05-31 22:19:51','Mesa escritório','NF-1004','B2','2023-08-05','2023-08-01','EMP-1004','PA-2023-0104',750.00),(105,105,105,'PAT0105','PL0105','Monitor multiparamétrico para atendimento social emergencial','Mindray','uMEC10','SN-PAT0105','2024-01-18',12500.00,'NOVO','ATIVO',NULL,NULL,'2026-05-31 22:19:51','Monitor multiparamétrico','NF-1005','C3','2024-01-18','2024-01-10','EMP-1005','PA-2024-0105',12500.00),(106,108,106,'PAT0106','PL0106','Projetor Epson para auditório cultural','Epson','PowerLite X49','SN-PAT0106','2023-06-21',3800.00,'BOM','ATIVO',NULL,NULL,'2026-05-31 22:19:51','Projetor multimídia','NF-1006','C3','2023-06-21','2023-06-15','EMP-1006','PA-2023-0106',3800.00),(107,107,107,'PAT0107','PL0107','Kit de bolas oficiais para ginásio municipal','Penalty','Oficial Pro','SN-PAT0107','2024-04-03',900.00,'BOM','ATIVO',NULL,NULL,'2026-05-31 22:19:51','Kit esportivo','NF-1007','D4','2024-04-03','2024-03-28','EMP-1007','PA-2024-0107',900.00),(108,109,108,'PAT0108','PL0108','Roçadeira profissional para viveiro municipal','Stihl','FS 220','SN-PAT0108','2023-10-10',2600.00,'REGULAR','ATIVO',NULL,NULL,'2026-05-31 22:19:51','Roçadeira','NF-1008','D4','2023-10-10','2023-10-02','EMP-1008','PA-2023-0108',2600.00),(109,110,109,'PAT0109','PL0109','Câmera de segurança IP para base da guarda','Intelbras','VIP 3230','SN-PAT0109','2024-05-06',1100.00,'NOVO','ATIVO',NULL,NULL,'2026-05-31 22:19:51','Câmera IP','NF-1009','E5','2024-05-06','2024-05-01','EMP-1009','PA-2024-0109',1100.00),(110,111,110,'PAT0110','PL0110','Switch gerenciável para departamento de fazenda','TP-Link','JetStream 24p','SN-PAT0110','2023-09-14',2400.00,'BOM','ATIVO',NULL,NULL,'2026-05-31 22:19:51','Switch de rede','NF-1010','E5','2023-09-14','2023-09-10','EMP-1010','PA-2023-0110',2400.00),(111,106,111,'PAT0111','PL0111','Veículo utilitário para transporte municipal','Fiat','Fiorino','SN-PAT0111','2022-12-02',78000.00,'BOM','BAIXADO','2026-06-02 12:58:08','aa','2026-05-31 22:19:51','Veículo utilitário','NF-1011','F6','2022-12-02','2022-11-25','EMP-1011','PA-2022-0111',78000.00),(112,112,112,'PAT0112','PL0112','Bebedouro industrial para núcleo de tecnologia','Libellc','Press Side','SN-PAT0112','2024-02-28',1900.00,'NOVO','BAIXADO','2026-05-31 23:12:17','a','2026-05-31 22:19:51','','','',NULL,NULL,'','',1900.00);
/*!40000 ALTER TABLE `patrimonios` ENABLE KEYS */;
UNLOCK TABLES;
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
-- Dumping data for table `perfis`
--

LOCK TABLES `perfis` WRITE;
/*!40000 ALTER TABLE `perfis` DISABLE KEYS */;
INSERT INTO `perfis` VALUES (1,'Administrador','Acesso total ao sistema',NULL,'2026-05-22 23:10:46'),(2,'Usuário',NULL,NULL,'2026-05-30 21:20:29');
/*!40000 ALTER TABLE `perfis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `servicos`
--

LOCK TABLES `servicos` WRITE;
/*!40000 ALTER TABLE `servicos` DISABLE KEYS */;
INSERT INTO `servicos` VALUES (1,1,1,'INSPEÇÃO','Teste','2026-05-26 22:36:30','2026-05-26 23:21:44',0.00,'CONCLUIDO'),(2,2,1,'REPARO','teste','2026-05-26 23:31:33','2026-05-26 23:31:50',0.00,'CONCLUIDO'),(3,2,1,'MANUTENÇÃO','teste3','2026-05-27 00:10:49','2026-05-27 00:10:56',0.00,'CONCLUIDO'),(4,2,1,'MANUTENÇÃO','teste5','2026-05-27 00:12:43','2026-05-27 00:12:53',0.00,'CONCLUIDO'),(5,2,1,'MANUTENÇÃO','aaaaa','2026-05-27 00:30:14','2026-05-27 00:31:51',0.00,'CONCLUIDO'),(6,3,1,'PATRIMONIAÇÃO','aaaa','2026-05-27 00:50:03','2026-05-27 00:50:26',0.00,'CONCLUIDO'),(7,4,1,'MANUTENÇÃO','assa','2026-05-30 22:14:08','2026-05-30 22:14:23',0.00,'CONCLUIDO'),(32,101,1,'INSPEÇÃO','Conferência física do computador no laboratório escolar.','2026-05-31 22:25:49',NULL,0.00,'CONCLUIDO'),(33,102,1,'PATRIMONIAÇÃO','Patrimoniação e validação documental do notebook.','2026-05-31 22:25:49',NULL,0.00,'CONCLUIDO'),(34,103,1,'REPARO','Verificação de atolamento e substituição de toner.','2026-05-31 22:25:49',NULL,120.00,'EM_ANDAMENTO'),(35,104,1,'INSPEÇÃO','Conferência de mobiliário na garagem municipal.','2026-05-31 22:25:49',NULL,0.00,'SOLICITADO'),(36,105,1,'INSPEÇÃO','Teste de funcionamento do monitor multiparamétrico.','2026-05-31 22:25:49',NULL,0.00,'SOLICITADO'),(37,106,1,'PATRIMONIAÇÃO','Registro e conferência do projetor do centro cultural.','2026-05-31 22:25:49',NULL,0.00,'CONCLUIDO'),(38,107,1,'OUTRO','Atualização de cadastro do kit esportivo.','2026-05-31 22:25:49',NULL,0.00,'SOLICITADO'),(39,108,1,'REPARO','Manutenção preventiva na roçadeira.','2026-05-31 22:25:49',NULL,180.00,'EM_ANDAMENTO'),(40,109,1,'OUTRO','Instalação e teste de câmera de segurança.','2026-05-31 22:25:49',NULL,0.00,'CONCLUIDO'),(41,110,1,'OUTRO','Instalação do switch no rack de rede.','2026-05-31 22:25:49',NULL,0.00,'CONCLUIDO'),(42,111,1,'INSPEÇÃO','Vistoria anual do veículo utilitário.','2026-05-31 22:25:49','2026-05-31 23:09:12',0.00,'CONCLUIDO'),(43,112,1,'REPARO','Verificação de vazamento no bebedouro.','2026-05-31 22:25:49','2026-05-31 22:49:37',95.00,'CONCLUIDO'),(44,110,1,'PATRIMONIAÇÃO','jhui','2026-05-31 22:49:17','2026-05-31 23:12:06',0.00,'CONCLUIDO');
/*!40000 ALTER TABLE `servicos` ENABLE KEYS */;
UNLOCK TABLES;
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
-- Dumping data for table `ugs`
--

LOCK TABLES `ugs` WRITE;
/*!40000 ALTER TABLE `ugs` DISABLE KEYS */;
INSERT INTO `ugs` VALUES (1,'001','Secretaria municipal de leme','PFL','Prefeitura','ATIVO','2026-05-26 22:33:39'),(101,'UG101','Secretaria Municipal de Educação','SME','Educação','ATIVO','2026-05-31 22:19:51'),(102,'UG102','Secretaria Municipal de Saúde','SMS','Saúde','ATIVO','2026-05-31 22:19:51'),(103,'UG103','Secretaria Municipal de Administração','SMA','Prefeitura','ATIVO','2026-05-31 22:19:51'),(104,'UG104','Secretaria Municipal de Obras','SMO','Prefeitura','ATIVO','2026-05-31 22:19:51'),(105,'UG105','Secretaria Municipal de Assistência Social','SMAS','Assistência Social','ATIVO','2026-05-31 22:19:51'),(106,'UG106','Secretaria Municipal de Cultura','SMC','Prefeitura','ATIVO','2026-05-31 22:19:51'),(107,'UG107','Secretaria Municipal de Esportes','SMESP','Prefeitura','ATIVO','2026-05-31 22:19:51'),(108,'UG108','Secretaria Municipal de Meio Ambiente','SMMA','Prefeitura','ATIVO','2026-05-31 22:19:51'),(109,'UG109','Secretaria Municipal de Segurança','SMSeg','Prefeitura','ATIVO','2026-05-31 22:19:51'),(110,'UG110','Secretaria Municipal de Fazenda','SMF','Prefeitura','ATIVO','2026-05-31 22:19:51'),(111,'UG111','Secretaria Municipal de Transporte','SMT','Prefeitura','ATIVO','2026-05-31 22:19:51'),(112,'UG112','Secretaria Municipal de Tecnologia','SMTI','Prefeitura','ATIVO','2026-05-31 22:19:51');
/*!40000 ALTER TABLE `ugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `unidades`
--

LOCK TABLES `unidades` WRITE;
/*!40000 ALTER TABLE `unidades` DISABLE KEYS */;
INSERT INTO `unidades` VALUES (1,1,'Finanças','Av. 29 de Agosto, 668 - Centro, Leme - SP, 13610-210','-22.1847237984328, -47.38851618302014','Gabriel','1935710737','ATIVO'),(101,101,'EMEF João da Silva','Rua das Flores, 100','-22.3560,-47.3840','Mariana Costa','(19) 3541-1001','ATIVO'),(102,102,'UBS Centro','Rua Tiradentes, 500','-22.3570,-47.3850','Carlos Mendes','(19) 3541-2001','ATIVO'),(103,103,'Paço Municipal','Praça Barão, 50','-22.3580,-47.3860','Fernanda Lima','(19) 3541-3001','ATIVO'),(104,104,'Garagem Municipal','Av. Industrial, 1000','-22.3590,-47.3870','Roberto Alves','(19) 3541-4001','ATIVO'),(105,105,'CRAS Norte','Rua Esperança, 220','-22.3600,-47.3880','Patrícia Souza','(19) 3541-5001','ATIVO'),(106,106,'Centro Cultural Municipal','Av. Cultura, 75','-22.3610,-47.3890','Ana Paula Rocha','(19) 3541-6001','ATIVO'),(107,107,'Ginásio Municipal','Rua do Esporte, 330','-22.3620,-47.3900','Lucas Pereira','(19) 3541-7001','ATIVO'),(108,108,'Viveiro Municipal','Estrada Verde, 900','-22.3630,-47.3910','Beatriz Nunes','(19) 3541-8001','ATIVO'),(109,109,'Base da Guarda Municipal','Rua Segurança, 410','-22.3640,-47.3920','Eduardo Ramos','(19) 3541-9001','ATIVO'),(110,110,'Departamento de Fazenda','Rua Fiscal, 88','-22.3650,-47.3930','Juliana Martins','(19) 3541-9101','ATIVO'),(111,111,'Pátio de Transporte','Av. Rodoviária, 1500','-22.3660,-47.3940','Henrique Dias','(19) 3541-9201','ATIVO'),(112,112,'Núcleo de Tecnologia','Rua Digital, 42','-22.3670,-47.3950','Camila Torres','(19) 3541-9301','ATIVO');
/*!40000 ALTER TABLE `unidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,1,'Administradorr','admin','admin@patrimov.com','$2y$10$KT1r6X903usDQNBVh7MDe.0XljZJt19/14cp8ahXZf/jVMAGJdmqK','ATIVO','2026-05-22 23:10:46'),(3,1,'Rinaldor','rinaldo','rinaldo@gmail.com','$2y$10$pP8dv0HGiJfM5V5QjXK6WuOA8t5mtsKZVrUMz.g12VDa75Gi5/HWW','ATIVO','2026-05-30 20:54:05'),(6,2,'Aline amor da minha vida','aline','aline@patrimonio.com','$2y$10$RIUaWSwKQFcWKBykmQVNw.R9VeuVrkYBsDoXBmx1m7QWZufnAdaS6','ATIVO','2026-05-30 21:45:09'),(8,1,'Aline dona e proprietaria do meu coração','aline2','aline2@patrimonio.com','$2y$10$b9ikqooopf9NeHOYQ4MKu.GZLCaxzFfq9HKvk0ljYceDFW6NjB.mW','INATIVO','2026-05-30 21:45:41'),(10,1,'Aline3','aline3','aline3@patrimonio.com','$2y$10$ysCIuGCESWThwjQvQasiq.sKvgbR14XYrOgiODDorlwMf/uug.stO','INATIVO','2026-05-30 21:46:05'),(12,1,'Aline, CEO da minha vida','aline4','aline4@patrimonio.com','$2y$10$J3NVSljW9Bbk85dms0QKv.dW729ie01MAB/UiOCnMOLlSI0W31kTi','ATIVO','2026-05-30 21:48:06'),(13,2,'gabriel2','gabriel2','gabriel2@gmail.com','$2y$10$JKBRVAN5LOj.1XMqJupXJONr8C8etI0DLq0r2rQ4MCBKytrbLNl5S','ATIVO','2026-05-31 17:09:51'),(14,2,'gabriel3','gabriel3','gabriel3@gmail.com','$2y$10$Wjho09zu7WttYTgYhJra5eZcElE.0YfoHCds.Q7QPQ9luC9zkmRTa','ATIVO','2026-05-31 17:10:15'),(15,2,'gabriel4','gabriel4','gabriel4@gmail.com','$2y$10$S.f/ASCAYc6YQN0DPfsyB.gTWZOCh4ETigMlp4TqFj1CZzydgQjC2','ATIVO','2026-05-31 17:10:41'),(16,2,'gabriel5','gabriel5','gabriel5@gmail.com','$2y$10$YRaf1.xRBSZI5KKoo8SjQum2N90Ow1hVKVFyulATJprdwn9VzplBa','ATIVO','2026-05-31 17:11:02'),(17,2,'gabriel6','gabriel6','gabriel6@gmail.com','$2y$10$elZfEmuxH486gH.npNpQouinDaXtsrQt/Tb3ufeHnJy/z9RDakREe','ATIVO','2026-05-31 17:11:28'),(18,2,'gabriel7','gabriel7','gabriel7@gmail.com','$2y$10$kOEAYpjTbhQcXoPV5.nwc.7kCIkfgTzX4/HKP6MvfWsN/LlfRAm8S','ATIVO','2026-05-31 17:11:59');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-13 20:56:50
