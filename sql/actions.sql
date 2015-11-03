/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.6.17 : Database - multiser_multiacademico
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`multiser_multiacademico` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `multiser_multiacademico`;

/*Table structure for table `actions` */

DROP TABLE IF EXISTS `actions`;

CREATE TABLE `actions` (
  `aid` varchar(255) NOT NULL DEFAULT '0' COMMENT 'Primary Key: Unique actions ID.',
  `type` varchar(32) NOT NULL DEFAULT '' COMMENT 'The object that that action acts on (node, user, comment, system or custom types.)',
  `callback` varchar(255) NOT NULL DEFAULT '' COMMENT 'The callback function that executes when the action runs.',
  `parameters` longtext NOT NULL COMMENT 'Parameters to be passed to the callback function.(DC2Type:json_array)',
  `label` varchar(255) NOT NULL DEFAULT '0' COMMENT 'Label of the action.',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stores action information.';

/*Data for the table `actions` */

LOCK TABLES `actions` WRITE;

insert  into `actions`(`aid`,`type`,`callback`,`parameters`,`label`) values ('comment_publish_action','comment','comment_publish_action','{\"icon\":\"fa fa-cog\"}','%title% Publico un comentario'),('comment_save_action','comment','comment_save_action','{\"icon\":\"fa fa-cog\",\"vars\":[]}','%title% Save comment'),('comment_unpublish_action','comment','comment_unpublish_action','','Unpublish comment'),('docente_write_calificacion','docente','docente_write_calificacion','{\r\n    \"icon\": \"fa flaticon-a1\",\r\n    \"vars\": [\r\n        \"estudiante\",\r\n        \"parcial\",\r\n        \"quimestre\"\r\n    ]\r\n}','Ha pasado la nota al estudiante %estudiante% en la materia %materia% correspondiente al %tn% %parcial% del %quimestre%'),('docente_write_calificacion_you','estudiante','docente_write_calificacion_you','{\r\n    \"icon\": \"fa flaticon-a1\",\r\n    \"vars\": [\r\n        \"docente\",\r\n	\"materia\",\r\n        \"nota\"\r\n    ]\r\n}','El docente %docente% ha pasado tu calificacion de %materia%'),('node_make_sticky_action','node','node_make_sticky_action','','Make content sticky'),('node_make_unsticky_action','node','node_make_unsticky_action','','Make content unsticky'),('node_promote_action','node','node_promote_action','','Promote content to front page'),('node_publish_action','node','node_publish_action','','Publish content'),('node_save_action','node','node_save_action','','Save content'),('node_unpromote_action','node','node_unpromote_action','','Remove content from front page'),('node_unpublish_action','node','node_unpublish_action','','Unpublish content'),('system_block_ip_action','user','system_block_ip_action','','Ban IP address of current user'),('user_block_user_action','user','user_block_user_action','','Block current user'),('user_following_friend','user','user_following_friend','{\"friend\":\"name\"}','esta siguiendo a %friend%'),('user_foto_perfil','user','user_foto_perfil','','Ha cambiado su foto de perfil'),('user_init_session','user','user_init_session','','Ha iniciado sesión'),('user_logout_session','user','user_logout_session','','Ha cerrado sesión');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
