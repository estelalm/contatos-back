CREATE SCHEMA IF NOT EXISTS `contatos_db` DEFAULT CHARACTER SET utf8 ;
USE `contatos_db` ;

CREATE TABLE IF NOT EXISTS  `tbl_contato` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `data_nascimento` DATE NOT NULL,
  `celular` VARCHAR(11) NOT NULL,
  `profissao` VARCHAR(100) NOT NULL,
  `telefone` VARCHAR(10) NULL,
  `enviar_sms` TINYINT NOT NULL,
  `enviar_email` TINYINT NOT NULL,
  `possui_whatsapp` TINYINT NOT NULL,
  PRIMARY KEY (`id`));     