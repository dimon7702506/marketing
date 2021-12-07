DELETE FROM `rro` WHERE `rro`.`id` = 77;
DELETE FROM `rro` WHERE `rro`.`id` = 78;
DELETE FROM `rro` WHERE `rro`.`id` = 79;
DELETE FROM `rro` WHERE `rro`.`id` = 80;
DELETE FROM `rro` WHERE `rro`.`id` = 102;
DELETE FROM `rro` WHERE `rro`.`id` = 103;
DELETE FROM `rro` WHERE `rro`.`id` = 104;
DELETE FROM `rro` WHERE `rro`.`id` = 105;
DELETE FROM `rro` WHERE `rro`.`id` = 106;
DELETE FROM `rro` WHERE `rro`.`id` = 107;
DELETE FROM `rro` WHERE `rro`.`id` = 108;
DELETE FROM `rro` WHERE `rro`.`id` = 109;
DELETE FROM `rro` WHERE `rro`.`id` = 112;
DELETE FROM `rro` WHERE `rro`.`id` = 114;

CREATE TABLE `analytics`.`cash` ( `id` INT NOT NULL AUTO_INCREMENT , `date` DATE NOT NULL , `apteka_id` INT(3) NOT NULL , `rro_id` INT(3) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
RENAME TABLE `analytics`.`cash` TO `analytics`.`cash_day`;

ALTER TABLE `cash_day` ADD `cash` DECIMAL(10,2) NULL AFTER `rro_id`, ADD `card` DECIMAL(10,2) NULL AFTER `cash`, ADD `collection` DECIMAL(10,2) NULL AFTER `card`, ADD `bank` DECIMAL(10,2) NULL AFTER `collection`, ADD `office` DECIMAL(10,2) NULL AFTER `bank`;
ALTER TABLE `cash_day` DROP `office`;

ALTER TABLE `cash_day` ADD `number of checks` INT(3) NOT NULL AFTER `bank`, ADD `discount` DECIMAL(10,2) NULL AFTER `number of checks`, ADD `increment` DECIMAL(10,2) NULL AFTER `discount`, ADD `round` DECIMAL(10,2) NULL AFTER `increment`;
