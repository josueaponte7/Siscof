CREATE DATABASE  IF NOT EXISTS `siscof` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `siscof`;
-- MySQL dump 10.13  Distrib 5.5.42, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: siscof
-- ------------------------------------------------------
-- Server version	5.5.42-1

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
-- Table structure for table `b_sistema`
--

DROP TABLE IF EXISTS `b_sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b_sistema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actividad` text COLLATE utf8_bin,
  `sql_query` text COLLATE utf8_bin,
  `accion` varchar(12) COLLATE utf8_bin NOT NULL,
  `columnas_afectadas` int(11) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `registros` text COLLATE utf8_bin,
  `submodulo_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`usuario_id`),
  KEY `cod_submodulo` (`submodulo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `b_sistema`
--

LOCK TABLES `b_sistema` WRITE;
/*!40000 ALTER TABLE `b_sistema` DISABLE KEYS */;
INSERT INTO `b_sistema` VALUES (1,'AGREGAR','INSERT INTO s_usuario (id,usuario,id_usuario,clave,perfil_id,fecha_creacion,usuario_creacion)VALUES(\'3\',\'josue\',\'003\',\'00ace0f029e53d5e0d5be0371f11579be37faeb4524be7f71e3f8bd4de5a85eee9450576a48c5a2d47f77eb24661f8999386054a72aaff3c44af78e13f0cc730\',\'3\',\'2015-04-08 03:41:09\',\'2\');','INSERT',1,'2015-04-08 03:41:09','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(2,'AGREGAR','INSERT INTO usuario_f (id,id_usuario_f,nombre,apellido,usuario_id,departamento_id)VALUES(\'1\',\'001\',\'josue\',\'aponte\',\'3\',\'1\');','INSERT',1,'2015-04-08 03:41:09','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(3,'AGREGAR','INSERT INTO s_usuario (id,usuario,id_usuario,clave,perfil_id,fecha_creacion,usuario_creacion)VALUES(\'3\',\'dfgdg\',\'003\',\'b2839c8be27766090111e5c992057d3c39533c6b13121a4c84b2c7a76bd511177d392b1fa7d51384cb5db8bd1d9742e0a4d49222fafce8101b170a3c63ed7c51\',\'3\',\'2015-04-08 03:43:01\',\'2\');','INSERT',1,'2015-04-08 03:43:01','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(4,'AGREGAR','INSERT INTO usuario_f (id,id_usuario_f,nombre,apellido,usuario_id,departamento_id)VALUES(\'1\',\'001\',\'dgfdg\',\'dfgdg\',\'3\',\'1\');','INSERT',1,'2015-04-08 03:43:01','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(5,'AGREGAR','INSERT INTO s_usuario (id,usuario,id_usuario,clave,perfil_id,fecha_creacion,usuario_creacion)VALUES(\'3\',\'sfsdsf\',\'003\',\'86bc9f7754e492f5130eedbbdac238bd737d6ff830e2f46e625c4ee60d00770946a9ba85cd8f1dda55b6e7ff97e5c74d4e712980c43f9c895af211b46bce91b5\',\'3\',\'2015-04-08 03:45:23\',\'2\');','INSERT',1,'2015-04-08 03:45:23','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(6,'AGREGAR','INSERT INTO usuario_f (id,id_usuario_f,nombre,apellido,usuario_id,departamento_id)VALUES(\'1\',\'001\',\'sdfsf\',\'sdfsf\',\'3\',\'1\');','INSERT',1,'2015-04-08 03:45:23','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(7,'AGREGAR','INSERT INTO s_usuario (id,usuario,id_usuario,clave,perfil_id,fecha_creacion,usuario_creacion)VALUES(\'3\',\'sfdsffs\',\'003\',\'a2fcd9c2d1678033929a852b2fbd934b81ba8602397b3cd73f2d0275a5419e888ccbc786f50a33381067422b02a3184b43a370522c96eac75361b86c99223e8c\',\'3\',\'2015-04-08 03:46:42\',\'2\');','INSERT',1,'2015-04-08 03:46:42','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(8,'AGREGAR','INSERT INTO usuario_f (id,id_usuario_f,nombre,apellido,usuario_id,departamento_id)VALUES(\'1\',\'001\',\'sdfsfs\',\'sfsds\',\'3\',\'1\');','INSERT',1,'2015-04-08 03:46:42','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(9,'AGREGAR','INSERT INTO s_usuario (id,usuario,id_usuario,clave,perfil_id,fecha_creacion,usuario_creacion)VALUES(\'3\',\'sdfs\',\'003\',\'59272ebba729bd12f7dcd66d5778dae7124063cd26739f89713143de2cc27ea3c60fb08a8017a89779611961341dfee68ebe22cc8476e7bb9e93e080865650a9\',\'3\',\'2015-04-08 03:51:51\',\'2\');','INSERT',1,'2015-04-08 03:51:51','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(10,'AGREGAR','INSERT INTO usuario_f (id,id_usuario_f,nombre,apellido,usuario_id,departamento_id)VALUES(\'1\',\'001\',\'fds\',\'sfs\',\'3\',\'1\');','INSERT',1,'2015-04-08 03:51:51','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(11,'AGREGAR','INSERT INTO s_usuario (id,usuario,id_usuario,clave,perfil_id,fecha_creacion,usuario_creacion)VALUES(\'3\',\'dsfsf\',\'003\',\'2b122a301544e41a9665f50a9b6ae2fe603b7e787f706bd5c79fb8d3f51a24d94409fd191314ad081c4ab517d223c5af2e467800e46d2d207c43e0a57af13cb0\',\'3\',\'2015-04-08 03:52:34\',\'2\');','INSERT',1,'2015-04-08 03:52:34','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(12,'AGREGAR','INSERT INTO usuario_f (id,id_usuario_f,nombre,apellido,usuario_id,departamento_id)VALUES(\'1\',\'001\',\'sfdss\',\'sdfssf\',\'3\',\'1\');','INSERT',1,'2015-04-08 03:52:35','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(13,'AGREGAR','INSERT INTO s_usuario (id,usuario,id_usuario,clave,perfil_id,fecha_creacion,usuario_creacion)VALUES(\'3\',\'josue\',\'003\',\'b3bdc5320573a69fbf660f28e2d994a770165e3f4d6d6cc265df138e847b773a364c217d58d6997b9ac92df05fc14f3e55cd7129c57a03d81e1ef16689b347fa\',\'3\',\'2015-04-08 03:56:45\',\'2\');','INSERT',1,'2015-04-08 03:56:45','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(14,'AGREGAR','INSERT INTO usuario_f (id,id_usuario_f,nombre,apellido,usuario_id,departamento_id)VALUES(\'1\',\'001\',\'Josue\',\'Aponte\',\'3\',\'1\');','INSERT',1,'2015-04-08 03:56:45','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(15,'AGREGAR','INSERT INTO s_usuario (id,usuario,id_usuario,clave,perfil_id,fecha_creacion,usuario_creacion)VALUES(\'3\',\'josue\',\'003\',\'ec6a6a0a9eef9eda950253dddb5513af840b208cbc46ac59b04fb9c64194fa2cd7a7e2d442822fea3f17e305ba1b0363b4734f5226325419231d8c79729e1f96\',\'3\',\'2015-04-08 03:57:34\',\'2\');','INSERT',1,'2015-04-08 03:57:34','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(16,'AGREGAR','INSERT INTO usuario_f (id,id_usuario_f,nombre,apellido,usuario_id,departamento_id)VALUES(\'1\',\'001\',\'Josue\',\'Aponte\',\'3\',\'1\');','INSERT',1,'2015-04-08 03:57:35','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(17,'AGREGAR','INSERT INTO s_usuario (id,usuario,id_usuario,clave,perfil_id,fecha_creacion,usuario_creacion)VALUES(\'3\',\'josue\',\'003\',\'0cf37bdc9cdd0ed8633081e43ff2b501970a33e799790747a63be28e6959d7a75b19e70121ff28192b64c4364a0d5eccc3ee833b70cb12b7c958d0062e0e9634\',\'3\',\'2015-04-08 03:58:12\',\'2\');','INSERT',1,'2015-04-08 03:58:13','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(18,'AGREGAR','INSERT INTO usuario_f (id,id_usuario_f,nombre,apellido,usuario_id,departamento_id)VALUES(\'1\',\'001\',\'Josue\',\'Aponte\',\'3\',\'1\');','INSERT',1,'2015-04-08 03:58:13','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(19,'AGREGAR','INSERT INTO s_usuario (id,usuario,id_usuario,clave,perfil_id,fecha_creacion,usuario_creacion)VALUES(\'3\',\'sdfs\',\'003\',\'d8a3ab24dd97c4665fb0ce6f89ee55b68a4fc24265fa4f417a4633bc9f8d451cf789b4a341f318d00d101f2dda4aa99e493409235d5ac2d5a61cd3fab7791871\',\'3\',\'2015-04-08 04:00:14\',\'2\');','INSERT',1,'2015-04-08 04:00:14','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(20,'AGREGAR','INSERT INTO usuario_f (id,id_usuario_f,nombre,apellido,usuario_id,departamento_id)VALUES(\'1\',\'001\',\'sdfs\',\'sdfsf\',\'3\',\'1\');','INSERT',1,'2015-04-08 04:00:14','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(21,'AGREGAR','INSERT INTO s_usuario (id,usuario,id_usuario,clave,perfil_id,fecha_creacion,usuario_creacion)VALUES(\'3\',\'ffdsf\',\'003\',\'e10a2f713c1bd9def620657501d8e7c901841698fa4bbd02dac22670ea2b4986fb8204073cc6e0ed3f619618b2d8ca7ea04c13410909712ec9ec41b412f348c4\',\'3\',\'2015-04-08 04:01:31\',\'2\');','INSERT',1,'2015-04-08 04:01:31','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(22,'AGREGAR','INSERT INTO usuario_f (id,id_usuario_f,nombre,apellido,usuario_id,departamento_id)VALUES(\'1\',\'001\',\'fsdf\',\'sfsdf\',\'3\',\'1\');','INSERT',1,'2015-04-08 04:01:31','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(23,'AGREGAR','INSERT INTO s_usuario (id,usuario,id_usuario,clave,activo,perfil_id,fecha_creacion,usuario_creacion)VALUES(\'3\',\'josue\',\'003\',\'2ee1ef9cc588b4d01c70e11f35d1c85b15b71bad5226f44be8fe7267ae9321eb9023eeb0c96b1f816a1509292b1b9c3d748d51f8b9f79f1953df86bf1ef70dba\',\'0\',\'4\',\'2015-04-08 04:19:55\',\'2\');','INSERT',1,'2015-04-08 04:19:55','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(24,'AGREGAR','INSERT INTO usuario_f (id,id_usuario_f,nombre,apellido,usuario_id,departamento_id)VALUES(\'1\',\'001\',\'Josue\',\'Aponte\',\'3\',\'1\');','INSERT',1,'2015-04-08 04:19:55','{\"actividad\":\"AGREGAR\",\"submodulo_id\":\"32\",\"accion\":\"INSERT\",\"col_afec\":1}',32,2),(25,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'3\',fecha_actualizacion=\'2015-04-08 04:44:08\',usuario_modificacion=\'2\' WHERE id =1;','UPDATE',1,'2015-04-08 04:44:08','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(26,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'3\',fecha_actualizacion=\'2015-04-08 04:45:22\',usuario_modificacion=\'2\' WHERE id =1;','UPDATE',1,'2015-04-08 04:45:22','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(27,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'3\',fecha_actualizacion=\'2015-04-08 04:45:30\',usuario_modificacion=\'2\' WHERE id =1;','UPDATE',1,'2015-04-08 04:45:30','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(28,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'3\',fecha_actualizacion=\'2015-04-08 04:46:28\',usuario_modificacion=\'2\' WHERE id =1;','UPDATE',1,'2015-04-08 04:46:28','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(29,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'3\',fecha_actualizacion=\'2015-04-08 04:46:44\',usuario_modificacion=\'2\' WHERE id =1;','UPDATE',1,'2015-04-08 04:46:44','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(30,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'3\',fecha_actualizacion=\'2015-04-08 04:47:42\',usuario_modificacion=\'2\' WHERE id =1;','UPDATE',1,'2015-04-08 04:47:42','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(31,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'4\',fecha_actualizacion=\'2015-04-08 04:48:51\',usuario_modificacion=\'2\' WHERE id =1;','UPDATE',1,'2015-04-08 04:48:51','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(32,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'4\',fecha_actualizacion=\'2015-04-08 04:51:49\',usuario_modificacion=\'2\' WHERE id =1;','UPDATE',1,'2015-04-08 04:51:49','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(33,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'4\',fecha_actualizacion=\'2015-04-08 05:01:07\',usuario_modificacion=\'2\' WHERE id =3;','UPDATE',1,'2015-04-08 05:01:07','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(34,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'4\',fecha_actualizacion=\'2015-04-08 05:01:15\',usuario_modificacion=\'2\' WHERE id =3;','UPDATE',1,'2015-04-08 05:01:15','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(35,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'3\',fecha_actualizacion=\'2015-04-08 05:03:21\',usuario_modificacion=\'2\' WHERE id =3;','UPDATE',1,'2015-04-08 05:03:21','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(36,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'4\',fecha_actualizacion=\'2015-04-08 05:04:23\',usuario_modificacion=\'2\' WHERE id =3;','UPDATE',1,'2015-04-08 05:04:23','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(37,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'3\',fecha_actualizacion=\'2015-04-08 05:04:36\',usuario_modificacion=\'2\' WHERE id =3;','UPDATE',1,'2015-04-08 05:04:36','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(38,'AGREGAR','INSERT INTO departamento (codigo_departamento,nombre_departamento,direccion_departamento,id)VALUES(\'002\',\'ADministracion\',\'administracion\',\'2\');','INSERT',1,'2015-04-08 05:04:58','{\"actividad\":\"AGREGAR\",\"submodulo_id\":null,\"accion\":\"INSERT\",\"col_afec\":1}',0,0),(39,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'4\',fecha_actualizacion=\'2015-04-08 05:06:17\',usuario_modificacion=\'2\' WHERE id =3;','UPDATE',1,'2015-04-08 05:06:17','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(40,'MODIFICAR','UPDATE usuario_f SET departamento_id=\'2\' WHERE id =1;','UPDATE',1,'2015-04-08 05:06:17','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(41,'MODIFICAR','UPDATE departamento SET nombre_departamento=\'ADMINISTRACION\',direccion_departamento=\'administracion\' WHERE id =2;','UPDATE',1,'2015-04-08 05:06:43','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":null,\"accion\":\"UPDATE\",\"col_afec\":1}',0,0),(42,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'3\',fecha_actualizacion=\'2015-04-08 05:06:55\',usuario_modificacion=\'2\' WHERE id =3;','UPDATE',1,'2015-04-08 05:06:55','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(43,'MODIFICAR','UPDATE usuario_f SET departamento_id=\'1\' WHERE id =1;','UPDATE',1,'2015-04-08 05:06:55','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(44,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'3\',fecha_actualizacion=\'2015-04-08 05:47:42\',usuario_modificacion=\'2\' WHERE id =3;','UPDATE',1,'2015-04-08 05:47:42','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(45,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'3\',fecha_actualizacion=\'2015-04-08 05:50:15\',usuario_modificacion=\'2\' WHERE id =3;','UPDATE',1,'2015-04-08 05:50:15','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(46,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'3\',fecha_actualizacion=\'2015-04-08 05:50:30\',usuario_modificacion=\'2\' WHERE id =3;','UPDATE',1,'2015-04-08 05:50:30','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2),(47,'MODIFICAR','UPDATE s_usuario SET clave=\'4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871\',activo=\'1\',perfil_id=\'3\',fecha_actualizacion=\'2015-04-08 05:51:09\',usuario_modificacion=\'2\' WHERE id =3;','UPDATE',1,'2015-04-08 05:51:09','{\"actividad\":\"MODIFICAR\",\"submodulo_id\":\"32\",\"accion\":\"UPDATE\",\"col_afec\":1}',32,2);
/*!40000 ALTER TABLE `b_sistema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `b_usuario`
--

DROP TABLE IF EXISTS `b_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actividad` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `prefijo` varchar(1) COLLATE utf8_bin DEFAULT NULL,
  `submodulo_id` int(11) DEFAULT '0',
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`usuario_id`),
  KEY `cod_submodulo` (`submodulo_id`),
  CONSTRAINT `fk_b_usuario_1` FOREIGN KEY (`usuario_id`) REFERENCES `s_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `b_usuario`
--

LOCK TABLES `b_usuario` WRITE;
/*!40000 ALTER TABLE `b_usuario` DISABLE KEYS */;
INSERT INTO `b_usuario` VALUES (1,'Inici&oacute; Sesi&oacute;','2015-04-08 03:14:03','L',3,2),(2,'Inici&oacute; Sesi&oacute;','2015-04-08 03:24:49','L',3,2),(3,'REGISTR&Oacute;','2015-04-08 03:41:09','R',32,2),(4,'REGISTR&Oacute;','2015-04-08 03:41:09','R',32,2),(5,'REGISTR&Oacute;','2015-04-08 03:43:01','R',32,2),(6,'REGISTR&Oacute;','2015-04-08 03:43:01','R',32,2),(7,'Inici&oacute; Sesi&oacute;','2015-04-08 03:45:10','L',3,2),(8,'REGISTR&Oacute;','2015-04-08 03:45:23','R',32,2),(9,'REGISTR&Oacute;','2015-04-08 03:45:23','R',32,2),(10,'REGISTR&Oacute;','2015-04-08 03:46:42','R',32,2),(11,'REGISTR&Oacute;','2015-04-08 03:46:43','R',32,2),(12,'REGISTR&Oacute;','2015-04-08 03:51:51','R',32,2),(13,'REGISTR&Oacute;','2015-04-08 03:51:51','R',32,2),(14,'REGISTR&Oacute;','2015-04-08 03:52:34','R',32,2),(15,'REGISTR&Oacute;','2015-04-08 03:52:35','R',32,2),(16,'REGISTR&Oacute;','2015-04-08 03:56:45','R',32,2),(17,'REGISTR&Oacute;','2015-04-08 03:56:45','R',32,2),(18,'REGISTR&Oacute;','2015-04-08 03:57:34','R',32,2),(19,'REGISTR&Oacute;','2015-04-08 03:57:35','R',32,2),(20,'REGISTR&Oacute;','2015-04-08 03:58:13','R',32,2),(21,'REGISTR&Oacute;','2015-04-08 03:58:13','R',32,2),(22,'REGISTR&Oacute;','2015-04-08 04:00:14','R',32,2),(23,'REGISTR&Oacute;','2015-04-08 04:00:14','R',32,2),(24,'REGISTR&Oacute;','2015-04-08 04:01:31','R',32,2),(25,'REGISTR&Oacute;','2015-04-08 04:01:31','R',32,2),(26,'REGISTR&Oacute;','2015-04-08 04:19:55','R',32,2),(27,'REGISTR&Oacute;','2015-04-08 04:19:55','R',32,2),(28,'MODIFIC&Oacute;','2015-04-08 04:44:08','M',32,2),(29,'MODIFIC&Oacute;','2015-04-08 04:45:22','M',32,2),(30,'MODIFIC&Oacute;','2015-04-08 04:45:30','M',32,2),(31,'MODIFIC&Oacute;','2015-04-08 04:46:28','M',32,2),(32,'MODIFIC&Oacute;','2015-04-08 04:46:44','M',32,2),(33,'MODIFIC&Oacute;','2015-04-08 04:47:42','M',32,2),(34,'MODIFIC&Oacute;','2015-04-08 04:48:51','M',32,2),(35,'MODIFIC&Oacute;','2015-04-08 04:51:49','M',32,2),(36,'MODIFIC&Oacute;','2015-04-08 05:01:07','M',32,2),(37,'MODIFIC&Oacute;','2015-04-08 05:01:15','M',32,2),(38,'MODIFIC&Oacute;','2015-04-08 05:03:21','M',32,2),(39,'MODIFIC&Oacute;','2015-04-08 05:04:23','M',32,2),(40,'MODIFIC&Oacute;','2015-04-08 05:04:36','M',32,2),(42,'MODIFIC&Oacute;','2015-04-08 05:06:17','M',32,2),(43,'MODIFIC&Oacute;','2015-04-08 05:06:17','M',32,2),(45,'MODIFIC&Oacute;','2015-04-08 05:06:55','M',32,2),(46,'MODIFIC&Oacute;','2015-04-08 05:06:55','M',32,2),(47,'Inici&oacute; Sesi&oacute;','2015-04-08 05:47:36','L',3,2),(48,'MODIFIC&Oacute;','2015-04-08 05:47:43','M',32,2),(49,'MODIFIC&Oacute;','2015-04-08 05:50:15','M',32,2),(50,'MODIFIC&Oacute;','2015-04-08 05:50:30','M',32,2),(51,'Inici&oacute; Sesi&oacute;','2015-04-08 05:50:47','L',3,2),(52,'MODIFIC&Oacute;','2015-04-08 05:51:09','M',32,2),(53,'Inici&oacute; Sesi&oacute;','2015-04-08 05:56:51','L',3,2),(54,'Inici&oacute; Sesi&oacute;','2015-04-08 06:01:58','L',3,2);
/*!40000 ALTER TABLE `b_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bien`
--

DROP TABLE IF EXISTS `bien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_bien` varchar(3) DEFAULT NULL,
  `nombre_bien` varchar(45) DEFAULT NULL,
  `serial_bien` varchar(45) DEFAULT NULL,
  `numero_bien` varchar(45) DEFAULT NULL,
  `descripcion_bien` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bien`
--

LOCK TABLES `bien` WRITE;
/*!40000 ALTER TABLE `bien` DISABLE KEYS */;
INSERT INTO `bien` VALUES (1,'001','','','','');
/*!40000 ALTER TABLE `bien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `componente`
--

DROP TABLE IF EXISTS `componente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `componente` (
  `id_componente` int(11) NOT NULL AUTO_INCREMENT,
  `marca_componente` varchar(45) NOT NULL,
  `serial_componente` varchar(45) DEFAULT NULL,
  `num_bien_componente` int(11) NOT NULL,
  `id_items` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_componente`),
  KEY `id_items` (`id_items`),
  CONSTRAINT `componente_ibfk_1` FOREIGN KEY (`id_items`) REFERENCES `items_inventario` (`id_items`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `componente`
--

LOCK TABLES `componente` WRITE;
/*!40000 ALTER TABLE `componente` DISABLE KEYS */;
/*!40000 ALTER TABLE `componente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consumibles`
--

DROP TABLE IF EXISTS `consumibles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumibles` (
  `id_consumible` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_consumible` text COLLATE utf8_bin NOT NULL,
  `marca_consumible` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_consumible`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumibles`
--

LOCK TABLES `consumibles` WRITE;
/*!40000 ALTER TABLE `consumibles` DISABLE KEYS */;
INSERT INTO `consumibles` VALUES (1,'CRATUCHO TINTA','HP'),(2,'TONER NEGRO','REPROGRAFIC');
/*!40000 ALTER TABLE `consumibles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_departamento` varchar(30) COLLATE utf8_bin NOT NULL,
  `nombre_departamento` text COLLATE utf8_bin NOT NULL,
  `direccion_departamento` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES (1,'001','INFORMATICA','hfhgfh'),(2,'002','ADMINISTRACION','administracion');
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipo_usuario_herramientas`
--

DROP TABLE IF EXISTS `equipo_usuario_herramientas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipo_usuario_herramientas` (
  `id_equipo` int(11) NOT NULL,
  `id_herramienta` int(11) NOT NULL,
  `usuariosistema_id` int(11) DEFAULT NULL,
  `id_repuesto` int(11) DEFAULT NULL,
  KEY `serial_equipo` (`id_equipo`),
  KEY `id_herramienta` (`id_herramienta`),
  KEY `id_repuesto` (`id_repuesto`),
  CONSTRAINT `equipo_usuario_herramientas_ibfk_1` FOREIGN KEY (`id_herramienta`) REFERENCES `herramientas` (`id_herramientas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `equipo_usuario_herramientas_ibfk_3` FOREIGN KEY (`id_repuesto`) REFERENCES `repuesto` (`id_repuesto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipo_usuario_herramientas`
--

LOCK TABLES `equipo_usuario_herramientas` WRITE;
/*!40000 ALTER TABLE `equipo_usuario_herramientas` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipo_usuario_herramientas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipos`
--

DROP TABLE IF EXISTS `equipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipos` (
  `id` int(11) NOT NULL,
  `cod_equipo` varchar(30) COLLATE utf8_bin NOT NULL,
  `marca` text COLLATE utf8_bin NOT NULL,
  `modelo` varchar(30) COLLATE utf8_bin NOT NULL,
  `serial_equipo` varchar(30) COLLATE utf8_bin NOT NULL,
  `num_bien` int(11) NOT NULL,
  `departamento_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_departamento` (`departamento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipos`
--

LOCK TABLES `equipos` WRITE;
/*!40000 ALTER TABLE `equipos` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estatus_fallas`
--

DROP TABLE IF EXISTS `estatus_fallas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estatus_fallas` (
  `id_estatus` int(11) NOT NULL AUTO_INCREMENT,
  `estatus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_estatus`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estatus_fallas`
--

LOCK TABLES `estatus_fallas` WRITE;
/*!40000 ALTER TABLE `estatus_fallas` DISABLE KEYS */;
INSERT INTO `estatus_fallas` VALUES (1,'NO ASIGNADO'),(2,'ASIGNADO'),(3,'RESUELTA'),(4,'NO SE PUEDE RESOLVER');
/*!40000 ALTER TABLE `estatus_fallas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fallas`
--

DROP TABLE IF EXISTS `fallas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fallas` (
  `id_falla` int(11) NOT NULL AUTO_INCREMENT,
  `problema` text COLLATE utf8_bin NOT NULL,
  `num_falla` varchar(30) COLLATE utf8_bin NOT NULL,
  `cod_falla` int(11) NOT NULL DEFAULT '0',
  `fecha` date DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `id_estatus` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_falla`),
  KEY `id_estatus` (`id_estatus`),
  KEY `id_departamento` (`id_departamento`),
  KEY `id_usuario` (`usuario_id`),
  CONSTRAINT `fallas_ibfk_2` FOREIGN KEY (`id_estatus`) REFERENCES `estatus_fallas` (`id_estatus`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_fallas_1` FOREIGN KEY (`usuario_id`) REFERENCES `s_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fallas`
--

LOCK TABLES `fallas` WRITE;
/*!40000 ALTER TABLE `fallas` DISABLE KEYS */;
/*!40000 ALTER TABLE `fallas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fallas_asignada`
--

DROP TABLE IF EXISTS `fallas_asignada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fallas_asignada` (
  `id_f_asignada` int(11) NOT NULL AUTO_INCREMENT,
  `id_falla` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_f_asignada`),
  KEY `id_falla` (`id_falla`),
  KEY `fk_fallas_asignada_1_idx` (`usuario_id`),
  CONSTRAINT `fallas_asignada_ibfk_1` FOREIGN KEY (`id_falla`) REFERENCES `fallas` (`id_falla`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_fallas_asignada_1` FOREIGN KEY (`usuario_id`) REFERENCES `s_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fallas_asignada`
--

LOCK TABLES `fallas_asignada` WRITE;
/*!40000 ALTER TABLE `fallas_asignada` DISABLE KEYS */;
/*!40000 ALTER TABLE `fallas_asignada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fallas_resuelta`
--

DROP TABLE IF EXISTS `fallas_resuelta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fallas_resuelta` (
  `id_f_resuelta` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text,
  `id_falla` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_f_resuelta`),
  KEY `id_falla` (`id_falla`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fallas_resuelta`
--

LOCK TABLES `fallas_resuelta` WRITE;
/*!40000 ALTER TABLE `fallas_resuelta` DISABLE KEYS */;
INSERT INTO `fallas_resuelta` VALUES (1,'sdfsfssdsf',5,3,'2014-12-09'),(2,'gggggg',3,0,'2014-12-09');
/*!40000 ALTER TABLE `fallas_resuelta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `herramientas`
--

DROP TABLE IF EXISTS `herramientas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `herramientas` (
  `id_herramientas` int(11) NOT NULL AUTO_INCREMENT,
  `marca_herramienta` text COLLATE utf8_bin NOT NULL,
  `serial_herramienta` varchar(30) COLLATE utf8_bin NOT NULL,
  `num_bien_herramienta` varchar(30) COLLATE utf8_bin NOT NULL,
  `id_items` int(11) DEFAULT NULL,
  `usuariosistema_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_herramientas`),
  KEY `id_items` (`id_items`),
  CONSTRAINT `herramientas_ibfk_1` FOREIGN KEY (`id_items`) REFERENCES `items_inventario` (`id_items`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `herramientas`
--

LOCK TABLES `herramientas` WRITE;
/*!40000 ALTER TABLE `herramientas` DISABLE KEYS */;
/*!40000 ALTER TABLE `herramientas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial`
--

DROP TABLE IF EXISTS `historial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historial` (
  `equipo_id` int(11) NOT NULL,
  `id_herramientas` int(11) NOT NULL,
  `id_repuestos` int(11) NOT NULL,
  `id_consumibles` int(11) NOT NULL,
  KEY `id_equipo` (`equipo_id`),
  KEY `id_herramientas` (`id_herramientas`),
  KEY `id_repuestos` (`id_repuestos`),
  KEY `id_consumibles` (`id_consumibles`),
  CONSTRAINT `fk_eqipo_historial` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `historial_ibfk_2` FOREIGN KEY (`id_herramientas`) REFERENCES `herramientas` (`id_herramientas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `historial_ibfk_3` FOREIGN KEY (`id_repuestos`) REFERENCES `repuesto` (`id_repuesto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `historial_ibfk_4` FOREIGN KEY (`id_consumibles`) REFERENCES `consumibles` (`id_consumible`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial`
--

LOCK TABLES `historial` WRITE;
/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
/*!40000 ALTER TABLE `historial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventario`
--

DROP TABLE IF EXISTS `inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventario` (
  `equipo_id` int(11) NOT NULL,
  `id_herramientas` int(11) DEFAULT NULL,
  `id_repuestos` int(11) DEFAULT NULL,
  `id_consumibles` int(11) DEFAULT NULL,
  KEY `id_equipo` (`equipo_id`),
  KEY `id_herramientas` (`id_herramientas`),
  KEY `id_repuestos` (`id_repuestos`),
  KEY `id_consumibles` (`id_consumibles`),
  CONSTRAINT `fk_equipos_inventario` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`id_herramientas`) REFERENCES `herramientas` (`id_herramientas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inventario_ibfk_3` FOREIGN KEY (`id_repuestos`) REFERENCES `repuesto` (`id_repuesto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inventario_ibfk_4` FOREIGN KEY (`id_consumibles`) REFERENCES `consumibles` (`id_consumible`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventario`
--

LOCK TABLES `inventario` WRITE;
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items_inventario`
--

DROP TABLE IF EXISTS `items_inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items_inventario` (
  `id_items` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text,
  `idtipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_items`),
  KEY `fk_tipo_items_idx` (`idtipo`),
  CONSTRAINT `fk_tipo_items` FOREIGN KEY (`idtipo`) REFERENCES `tipo` (`idtipo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items_inventario`
--

LOCK TABLES `items_inventario` WRITE;
/*!40000 ALTER TABLE `items_inventario` DISABLE KEYS */;
/*!40000 ALTER TABLE `items_inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proceso_principal_equipo_departamento`
--

DROP TABLE IF EXISTS `proceso_principal_equipo_departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proceso_principal_equipo_departamento` (
  `equipo_id` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `id_consumible` int(11) NOT NULL,
  `id_falla` int(11) NOT NULL,
  KEY `equipo_departamento_consumible_ibfk_2` (`id_departamento`),
  KEY `id_falla` (`id_falla`),
  KEY `equipo_departamento_consumible_ibfk_4` (`id_consumible`),
  KEY `equipo_departamento_consumible_ibfk_3` (`equipo_id`),
  CONSTRAINT `fk_equipo_proceso` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `proceso_principal_equipo_departamento_ibfk_4` FOREIGN KEY (`id_consumible`) REFERENCES `consumibles` (`id_consumible`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `proceso_principal_equipo_departamento_ibfk_5` FOREIGN KEY (`id_falla`) REFERENCES `fallas` (`id_falla`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proceso_principal_equipo_departamento`
--

LOCK TABLES `proceso_principal_equipo_departamento` WRITE;
/*!40000 ALTER TABLE `proceso_principal_equipo_departamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `proceso_principal_equipo_departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repuesto`
--

DROP TABLE IF EXISTS `repuesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repuesto` (
  `id_repuesto` int(11) NOT NULL AUTO_INCREMENT,
  `marca_repuesto` text COLLATE utf8_bin NOT NULL,
  `modelo_repuesto` varchar(30) COLLATE utf8_bin NOT NULL,
  `id_items` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_repuesto`),
  KEY `id_items` (`id_items`),
  CONSTRAINT `repuesto_ibfk_1` FOREIGN KEY (`id_items`) REFERENCES `items_inventario` (`id_items`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repuesto`
--

LOCK TABLES `repuesto` WRITE;
/*!40000 ALTER TABLE `repuesto` DISABLE KEYS */;
/*!40000 ALTER TABLE `repuesto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repuesto_equipo`
--

DROP TABLE IF EXISTS `repuesto_equipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repuesto_equipo` (
  `serial_equipo` varchar(30) COLLATE utf8_bin NOT NULL,
  `serial_repuesto` varchar(30) COLLATE utf8_bin NOT NULL,
  `id_repuesto` int(11) DEFAULT NULL,
  KEY `id_repuesto` (`id_repuesto`),
  CONSTRAINT `repuesto_equipo_ibfk_1` FOREIGN KEY (`id_repuesto`) REFERENCES `repuesto` (`id_repuesto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repuesto_equipo`
--

LOCK TABLES `repuesto_equipo` WRITE;
/*!40000 ALTER TABLE `repuesto_equipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `repuesto_equipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repuestos`
--

DROP TABLE IF EXISTS `repuestos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repuestos` (
  `id_repuesto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_repuesto` text COLLATE utf8_bin NOT NULL,
  `marca_repuesto` text COLLATE utf8_bin NOT NULL,
  `modelo_repuesto` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_repuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repuestos`
--

LOCK TABLES `repuestos` WRITE;
/*!40000 ALTER TABLE `repuestos` DISABLE KEYS */;
INSERT INTO `repuestos` VALUES (1,'Tuerca','Roma','Peta');
/*!40000 ALTER TABLE `repuestos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respuestos`
--

DROP TABLE IF EXISTS `respuestos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `respuestos` (
  `id_repuesto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_repuesto` text COLLATE utf8_bin NOT NULL,
  `marca_repuesto` text COLLATE utf8_bin NOT NULL,
  `modelo_repuesto` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_repuesto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respuestos`
--

LOCK TABLES `respuestos` WRITE;
/*!40000 ALTER TABLE `respuestos` DISABLE KEYS */;
/*!40000 ALTER TABLE `respuestos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `s_modulo`
--

DROP TABLE IF EXISTS `s_modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `s_modulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modulo` varchar(20) CHARACTER SET latin1 NOT NULL,
  `activo` tinyint(1) DEFAULT '0',
  `posicion` int(11) DEFAULT '0',
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `usuario_creacion` int(11) DEFAULT NULL,
  `usuario_modificacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`posicion`),
  KEY `id_usuario` (`usuario_creacion`),
  KEY `fk_s_uusrio_modulo-1_idx` (`usuario_modificacion`),
  CONSTRAINT `fk_s_usuario_modulo` FOREIGN KEY (`usuario_creacion`) REFERENCES `s_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_s_uusrio_modulo-1` FOREIGN KEY (`usuario_modificacion`) REFERENCES `s_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `s_modulo`
--

LOCK TABLES `s_modulo` WRITE;
/*!40000 ALTER TABLE `s_modulo` DISABLE KEYS */;
INSERT INTO `s_modulo` VALUES (1,'Seguridad',1,5,NULL,'2014-03-29 22:18:03',NULL,NULL),(2,'Bitacora',1,6,NULL,'2014-03-29 22:10:28',NULL,NULL),(3,'Inventario',1,0,'2014-03-29 13:15:00','2014-11-04 17:22:10',1,NULL),(6,'Mantenimiento',1,9,'2014-03-29 22:09:17','2014-11-04 17:32:15',1,NULL),(7,'Reporte',1,8,'2014-03-29 22:09:37','2014-11-04 17:18:30',1,NULL),(8,'Fallas',1,7,'2014-10-23 21:37:16','2014-10-23 21:37:16',1,NULL);
/*!40000 ALTER TABLE `s_modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `s_perfil`
--

DROP TABLE IF EXISTS `s_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `s_perfil` (
  `id` int(11) NOT NULL,
  `perfil` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `usuario_creacion` int(11) DEFAULT NULL,
  `usuario_modificacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`usuario_creacion`),
  KEY `fk_s_perfil_2_idx` (`usuario_modificacion`),
  CONSTRAINT `fk_s_perfil_1` FOREIGN KEY (`usuario_creacion`) REFERENCES `s_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_s_perfil_2` FOREIGN KEY (`usuario_modificacion`) REFERENCES `s_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `s_perfil`
--

LOCK TABLES `s_perfil` WRITE;
/*!40000 ALTER TABLE `s_perfil` DISABLE KEYS */;
INSERT INTO `s_perfil` VALUES (1,'Admin',NULL,NULL,NULL,NULL),(2,'Administrador','2014-02-23 21:05:32','2014-02-28 15:18:25',1,NULL),(3,'Informatico','2014-11-04 15:39:11','2014-11-04 15:39:11',1,NULL),(4,'Usuario','2014-11-04 15:40:15','2014-11-04 15:40:15',1,NULL);
/*!40000 ALTER TABLE `s_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `s_perfil_privilegio`
--

DROP TABLE IF EXISTS `s_perfil_privilegio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `s_perfil_privilegio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil_id` int(11) DEFAULT NULL,
  `submodulo_id` int(11) DEFAULT NULL,
  `agregar` tinyint(1) DEFAULT '0',
  `modificar` tinyint(1) DEFAULT '0',
  `eliminar` tinyint(1) DEFAULT '0',
  `consultar` tinyint(1) DEFAULT '0',
  `imprimir` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `codigo_perfil` (`perfil_id`),
  KEY `cod_submodulo` (`submodulo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=224 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `s_perfil_privilegio`
--

LOCK TABLES `s_perfil_privilegio` WRITE;
/*!40000 ALTER TABLE `s_perfil_privilegio` DISABLE KEYS */;
INSERT INTO `s_perfil_privilegio` VALUES (21,1,4,1,1,1,1,1),(22,1,5,1,1,1,1,1),(23,1,1,1,1,1,1,1),(24,1,2,1,1,1,1,1),(25,1,3,1,1,1,1,1),(50,4,26,0,0,0,1,1),(51,4,17,1,1,1,1,1),(203,3,41,1,1,1,1,1),(204,3,22,0,0,0,1,1),(205,3,23,0,0,0,1,1),(206,2,24,1,1,1,1,1),(207,2,6,1,1,1,1,1),(208,2,17,1,1,1,1,1),(209,2,19,1,1,1,1,1),(210,2,27,1,1,1,1,1),(211,2,28,1,1,1,1,1),(212,2,29,1,1,1,1,1),(213,2,30,1,1,1,1,1),(214,2,31,1,1,1,1,1),(215,2,32,1,1,1,1,1),(216,2,33,1,1,1,1,1),(217,2,34,1,1,1,1,1),(218,2,35,1,1,0,1,1),(219,2,36,1,1,1,1,1),(220,2,37,1,1,1,1,1),(221,2,38,1,1,1,1,1),(222,2,39,1,1,1,1,1),(223,2,40,1,1,1,1,1);
/*!40000 ALTER TABLE `s_perfil_privilegio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `s_sesion_activa`
--

DROP TABLE IF EXISTS `s_sesion_activa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `s_sesion_activa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(40) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `fecha_session` datetime DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `s_sesion_activa_ibfk_2` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `s_sesion_activa`
--

LOCK TABLES `s_sesion_activa` WRITE;
/*!40000 ALTER TABLE `s_sesion_activa` DISABLE KEYS */;
INSERT INTO `s_sesion_activa` VALUES (175,'e601717f258268032c0d9cb28a4a9a7f62cbe5a9','2015-04-06 00:02:00','::1',1),(182,'ef1ebbf3d4f9773e407303df2b9f3810b5b7a111','2015-04-08 06:01:00','::1',2);
/*!40000 ALTER TABLE `s_sesion_activa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `s_sub_modulo`
--

DROP TABLE IF EXISTS `s_sub_modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `s_sub_modulo` (
  `id` int(11) NOT NULL,
  `sub_modulo` varchar(50) CHARACTER SET latin1 NOT NULL,
  `activo` tinyint(1) DEFAULT '0',
  `posicion` int(11) DEFAULT '0',
  `ruta` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `modulo_id` int(11) NOT NULL,
  `usuario_creacion` int(11) DEFAULT NULL,
  `usuario_modificacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `modulo_submodulo` (`modulo_id`),
  KEY `fk_s_sub_modulo_1_idx` (`usuario_creacion`),
  KEY `fk_s_sub_modulo_2_idx` (`usuario_modificacion`),
  CONSTRAINT `fk_s_sub_modulo_1` FOREIGN KEY (`usuario_creacion`) REFERENCES `s_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_s_sub_modulo_2` FOREIGN KEY (`usuario_modificacion`) REFERENCES `s_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `s_sub_modulo`
--

LOCK TABLES `s_sub_modulo` WRITE;
/*!40000 ALTER TABLE `s_sub_modulo` DISABLE KEYS */;
INSERT INTO `s_sub_modulo` VALUES (1,'Módulo',1,0,'vista/seguridad/modulo.php',NULL,NULL,1,NULL,NULL),(2,'Perfil de Usuario',1,1,'vista/seguridad/perfiles.php',NULL,NULL,1,NULL,NULL),(3,'Usuario',1,2,'vista/seguridad/usuario.php',NULL,'2014-03-29 14:50:38',1,NULL,NULL),(4,'Bitacora de Usuario',1,0,NULL,NULL,NULL,2,NULL,NULL),(5,'Bitacora del Sistema',1,1,NULL,NULL,NULL,2,NULL,NULL),(6,'Asignación Bien',1,0,'vista/inventario/herramientas.php','2014-03-29 14:32:44','2014-11-04 17:22:45',3,1,NULL),(17,'Registro',1,0,'vista/fallas/fallas.php','2014-10-23 21:39:35','2014-11-04 10:22:00',8,1,NULL),(19,'Asignar Soporte',1,1,'vista/fallas/asignar.php','2014-11-04 16:59:04','2014-11-04 17:01:38',8,1,NULL),(20,'Soportes Asignados',1,2,'vista/fallas/soporte.php','2014-11-04 17:01:11','2014-11-04 17:01:11',8,1,NULL),(21,'Inventario',1,8,'vista/reportes/inventario.php','2014-11-04 17:06:20','2014-12-01 10:18:38',7,1,NULL),(22,'Técnico',1,9,'vista/reportes/tecnicos.php','2014-11-04 17:07:54','2014-12-01 10:18:45',7,1,NULL),(23,'Estatus',1,10,'vista/reportes/estatus.php','2014-11-04 17:09:08','2014-12-01 10:18:55',7,1,NULL),(24,'Departamento',1,6,'vista/reportes/departamento.php','2014-11-04 17:09:53','2014-12-01 10:17:35',7,1,NULL),(25,'Fecha',1,11,'vista/reportes/fecha.php','2014-11-04 17:10:41','2014-12-01 10:19:03',7,1,NULL),(26,'Estatus de Fallas',1,12,'vista/reportes/estatus_fallas.php','2014-11-04 17:15:51','2014-12-01 10:19:12',7,1,NULL),(27,'Bienes',1,1,'vista/inventario/componente.php','2014-11-04 17:23:27','2014-11-04 17:23:27',3,1,NULL),(28,'Repuesto',0,2,'vista/inventario/repuesto.php','2014-11-04 17:24:02','2014-11-04 17:24:02',3,1,NULL),(29,'Consumible',0,3,'vista/inventario/consumible.php','2014-11-04 17:24:51','2014-11-04 17:24:51',3,1,NULL),(30,'Equipos',0,4,'vista/inventario/equipos.php','2014-11-04 17:25:52','2014-11-04 17:25:52',3,1,NULL),(31,'Departamento',1,0,'vista/mantenimiento/departamento.php','2014-11-04 17:28:52','2014-11-04 17:28:52',6,1,NULL),(32,'Usuario',1,1,'vista/mantenimiento/usuarioF.php','2014-11-04 17:29:25','2014-11-04 17:29:25',6,1,NULL),(33,'Herramienta',1,0,'vista/reportes/herramienta.php','2014-12-01 10:02:49','2014-12-01 10:05:21',7,1,NULL),(34,'Componentes',1,1,'vista/reportes/componente.php','2014-12-01 10:03:40','2014-12-01 10:05:49',7,1,NULL),(35,'Repuestos',1,2,'vista/reportes/repuesto.php','2014-12-01 10:04:30','2014-12-01 10:13:44',7,1,NULL),(36,'Consumibles',1,3,'vista/reportes/consumible.php','2014-12-01 10:15:48','2014-12-01 11:52:28',7,1,NULL),(37,'Equipos',1,4,'vista/reportes/equipo.php','2014-12-01 10:16:23','2014-12-01 10:39:08',7,1,NULL),(38,'Fallas',1,5,'vista/reportes/fallas.php','2014-12-01 10:17:14','2014-12-01 10:39:18',7,1,NULL),(39,'Usuarios',1,7,'vista/reportes/usuario.php','2014-12-01 10:18:17','2014-12-01 10:18:17',7,1,NULL),(40,'Cargar Items',1,2,'vista/mantenimiento/items.php','2014-12-07 11:18:58','2014-12-07 11:18:58',6,1,NULL),(41,'Resolver Falla',1,3,'vista/fallas/resolver.php','2014-12-09 03:51:42','2014-12-09 03:51:42',8,NULL,NULL);
/*!40000 ALTER TABLE `s_sub_modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `s_usuario`
--

DROP TABLE IF EXISTS `s_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `s_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `usuario` varchar(15) CHARACTER SET latin1 NOT NULL,
  `clave` varchar(128) CHARACTER SET latin1 NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `conectado` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `usuario_modificacion` int(11) DEFAULT NULL,
  `usuario_creacion` int(11) DEFAULT NULL,
  `perfil_id` int(11) DEFAULT NULL,
  UNIQUE KEY `UNIQUE` (`usuario`),
  KEY `codigo_perfil` (`perfil_id`),
  KEY `id` (`id`),
  CONSTRAINT `fk_s_perfil_s_usuario` FOREIGN KEY (`perfil_id`) REFERENCES `s_perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `s_usuario`
--

LOCK TABLES `s_usuario` WRITE;
/*!40000 ALTER TABLE `s_usuario` DISABLE KEYS */;
INSERT INTO `s_usuario` VALUES (1,'001','admin','4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871',1,1,NULL,'2015-04-08 04:51:49',2,NULL,4),(2,'002','administrador','393eaf591875db81230faf554dccac8e926545eaa6b21db972a9ca01c478d9670e1b91e5661a6c287f8f3225ade6e44b29dd3649f0ee5b5bdc4123e5d43fdb66',1,1,NULL,'2015-04-05 23:30:08',1,NULL,2),(3,'003','josue','4a76b7b08622a914d44b92c834e7ad2fab4491c83614f0d75c4bad059244fd67f9a46c60a0b19c0d6aa6331c5d593514cb9738ada2b7408b9c07294546fba871',1,0,'2015-04-08 04:19:55','2015-04-08 05:51:09',2,2,3);
/*!40000 ALTER TABLE `s_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo` (
  `idtipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo`
--

LOCK TABLES `tipo` WRITE;
/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
INSERT INTO `tipo` VALUES (1,'Bienes'),(2,'Almacen');
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_usuario` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_f`
--

DROP TABLE IF EXISTS `usuario_f`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_f` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_f` varchar(3) COLLATE utf8_bin NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `apellido` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `departamento_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`id_usuario_f`),
  KEY `id_usuario` (`usuario_id`),
  KEY `id_departamento` (`departamento_id`),
  CONSTRAINT `fk_usuario_f_1` FOREIGN KEY (`usuario_id`) REFERENCES `s_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_f_2` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin KEY_BLOCK_SIZE=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_f`
--

LOCK TABLES `usuario_f` WRITE;
/*!40000 ALTER TABLE `usuario_f` DISABLE KEYS */;
INSERT INTO `usuario_f` VALUES (1,'001','Josue','Aponte',3,1);
/*!40000 ALTER TABLE `usuario_f` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_sistema`
--

DROP TABLE IF EXISTS `usuarios_sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios_sistema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` text COLLATE utf8_bin NOT NULL,
  `apellido_usuario` text COLLATE utf8_bin NOT NULL,
  `cedula_usuario` int(9) NOT NULL,
  `tipousuario_id` int(11) NOT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `cargo_usuario` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_departamento` (`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_sistema`
--

LOCK TABLES `usuarios_sistema` WRITE;
/*!40000 ALTER TABLE `usuarios_sistema` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios_sistema` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-08  6:17:05
