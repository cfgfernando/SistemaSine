-- MySQL dump 10.13  Distrib 5.7.13, for Linux (i686)
--
-- Host: localhost    Database: curso
-- ------------------------------------------------------
-- Server version	5.7.13-0ubuntu0.16.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `agente_qualificador`
--

DROP TABLE IF EXISTS `agente_qualificador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agente_qualificador` (
  `idagente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idagente`,`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agente_qualificador`
--

LOCK TABLES `agente_qualificador` WRITE;
/*!40000 ALTER TABLE `agente_qualificador` DISABLE KEYS */;
INSERT INTO `agente_qualificador` VALUES (1,'SENAI','TESTE'),(2,'SENAI',NULL);
/*!40000 ALTER TABLE `agente_qualificador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cadPessoas`
--

DROP TABLE IF EXISTS `cadPessoas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cadPessoas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dataInscricao` datetime DEFAULT NULL,
  `nome` varchar(50) NOT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `cpf` char(11) NOT NULL,
  `data_nascimento` varchar(40) DEFAULT NULL,
  `idade` int(5) DEFAULT NULL,
  `estado_civil` varchar(40) DEFAULT NULL,
  `local_nasc` varchar(80) DEFAULT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `rg_orgEmissor` varchar(20) DEFAULT NULL,
  `rg_data` varchar(40) DEFAULT NULL,
  `pai` varchar(60) DEFAULT NULL,
  `mae` varchar(60) DEFAULT NULL,
  `endereco` varchar(80) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `bairro` varchar(80) DEFAULT NULL,
  `cidade` varchar(80) DEFAULT NULL,
  `cep` char(20) DEFAULT NULL,
  `fone` char(14) DEFAULT NULL,
  `celular` char(14) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `pcd` varchar(10) DEFAULT NULL,
  `qual_pcd` varchar(120) DEFAULT NULL,
  `escolaridade` varchar(40) DEFAULT NULL,
  `cursos_qualificacao` varchar(80) DEFAULT NULL,
  `observacao` longtext,
  PRIMARY KEY (`id`,`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cadPessoas`
--

LOCK TABLES `cadPessoas` WRITE;
/*!40000 ALTER TABLE `cadPessoas` DISABLE KEYS */;
INSERT INTO `cadPessoas` VALUES (1,NULL,'Carlos Fernando',NULL,'99276046020',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'cfgfernando@gmail.com',NULL,NULL,NULL,'fsdf',NULL),(2,NULL,'Carlos Fernando Gomes','M','99276046020','24-08-2016',NULL,NULL,'Ferraz de Vasconcelos','73327466','ssp PR','2016-10-08','Paulo Roberto Gomes','Aparecida Viana da Silva Gomes','Rua Alberto Lesniowski',188,'Costeira','Araucaria','83.709-100','4130480018','(41) 9265-1260','cfgfernando@gmail.com','NAO',NULL,'Mestrado',NULL,NULL),(4,NULL,'Nayron Hubel','M','11111111111','09-08-2016',NULL,NULL,'teste','22222222222','teste','1911-06-01','teste','teste','test',1111,NULL,NULL,'888888888',NULL,NULL,NULL,'NAO',NULL,'Superior Completo',NULL,NULL),(5,NULL,'Nayron Hubel','M','11111111111','09-08-2016',NULL,NULL,'teste','22222222222','teste','1911-06-01','teste','teste','test',1111,NULL,NULL,'888888888',NULL,NULL,NULL,'NAO',NULL,'Superior Completo',NULL,NULL),(6,NULL,'Carlos Fernando Gomes','M','99276046020',NULL,NULL,NULL,NULL,'73327466',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,NULL,'CARLOS','M','99276046020',NULL,NULL,NULL,NULL,'73327466',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'1982-05-28 00:00:00','Carlos Fernando Gomes','Masculino','99276046020','28-05-1982',34,'casado','Ferraz de Vasconcelos','73327466','ssp PR','04-01-1995','Paulo Roberto Gomes','Aparecida Viana da Silva Gomes','Araucária/ Paraná',1111,'Costeira','Araucária','83.709-100','4130480018','(41) 9265-1260','cfgfernando@gmail.com',NULL,NULL,NULL,NULL,NULL),(10,'2016-08-24 00:00:00','Carlos Fernando Gomes','M','99276046020','1982-05-28',NULL,'Casado','Ferraz de Vasconcelos - SP','7.332.746-6','SSP PR','1995-03-08','Paulo Roberto Gomes','Aparecida Viana da Silva Gomes','Rua Alberto Lesniowki ',188,'Costeira','Araucária','83709-100','(41)3048-0018','(41)9265-1260','cfgfernando@gmail.com','Nao',NULL,'Superior Incompleto',NULL,'Teste de teste');
/*!40000 ALTER TABLE `cadPessoas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `candidato`
--

DROP TABLE IF EXISTS `candidato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `candidato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` char(11) NOT NULL DEFAULT '',
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fone` char(14) DEFAULT NULL,
  `data_nascimento` varchar(20) DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `pai` varchar(45) DEFAULT NULL,
  `mae` varchar(45) DEFAULT NULL,
  `idade` int(5) DEFAULT NULL,
  `local_nasc` varchar(45) DEFAULT NULL,
  `endereco` varchar(45) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `cep` char(20) DEFAULT NULL,
  `celular` char(14) DEFAULT NULL,
  `identidade` varchar(20) DEFAULT NULL,
  `ctps` char(20) DEFAULT NULL,
  `serie` char(15) DEFAULT NULL,
  `pis` char(25) DEFAULT NULL,
  `titulo` int(30) DEFAULT NULL,
  `zona` int(5) DEFAULT NULL,
  `secao` int(5) DEFAULT NULL,
  `estado_civil` varchar(10) DEFAULT NULL,
  `renda_familiar` varchar(20) DEFAULT NULL,
  `salario` float DEFAULT NULL,
  `empregado` varchar(5) DEFAULT NULL,
  `periodo` char(10) DEFAULT NULL,
  `pcd` varchar(10) DEFAULT NULL,
  `qual_pcd` varchar(45) DEFAULT NULL,
  `escolaridade` varchar(20) DEFAULT NULL,
  `cursos_qualificacao` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`,`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidato`
--

LOCK TABLES `candidato` WRITE;
/*!40000 ALTER TABLE `candidato` DISABLE KEYS */;
INSERT INTO `candidato` VALUES (1,'992.760.460','Carlos',NULL,NULL,NULL,'Masculino',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Casado',NULL,NULL,'Sim',NULL,'Sim',NULL,NULL,NULL);
/*!40000 ALTER TABLE `candidato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `requisito` varchar(255) DEFAULT NULL,
  `carga_horaria` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`id`,`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES (1,'MECANICA','TESTE',40),(2,'MECÂNICA BÁSICA',NULL,60);
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matriculas`
--

DROP TABLE IF EXISTS `matriculas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matriculas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `turmas_id` int(10) unsigned NOT NULL,
  `candidato_id` int(11) NOT NULL,
  `data_inscricao` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `matriculas_FKIndex3` (`turmas_id`),
  KEY `fk_matriculas_candidato1_idx` (`candidato_id`),
  CONSTRAINT `fk_matriculas_candidato1` FOREIGN KEY (`candidato_id`) REFERENCES `candidato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `matriculas_ibfk_2` FOREIGN KEY (`turmas_id`) REFERENCES `turmas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matriculas`
--

LOCK TABLES `matriculas` WRITE;
/*!40000 ALTER TABLE `matriculas` DISABLE KEYS */;
INSERT INTO `matriculas` VALUES (1,1,1,'2016-07-04');
/*!40000 ALTER TABLE `matriculas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turmas`
--

DROP TABLE IF EXISTS `turmas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turmas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome_turma` varchar(45) NOT NULL,
  `cursos_id` int(10) unsigned NOT NULL,
  `agente_qualificador_idagente` int(11) NOT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_final` date DEFAULT NULL,
  `minimo_alunos` int(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `turmas_FKIndex1` (`cursos_id`),
  KEY `fk_turmas_agente_qualificador1_idx` (`agente_qualificador_idagente`),
  CONSTRAINT `fk_turmas_agente_qualificador1` FOREIGN KEY (`agente_qualificador_idagente`) REFERENCES `agente_qualificador` (`idagente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `turmas_ibfk_1` FOREIGN KEY (`cursos_id`) REFERENCES `cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turmas`
--

LOCK TABLES `turmas` WRITE;
/*!40000 ALTER TABLE `turmas` DISABLE KEYS */;
INSERT INTO `turmas` VALUES (1,'MECÊNICA BÁSICA 2016',1,1,'2016-07-04','2016-09-23',20,'ABERTA');
/*!40000 ALTER TABLE `turmas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-24 22:25:25
