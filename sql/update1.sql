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
ALTER TABLE `cash_day` DROP `rro_id`;

ALTER TABLE `cash_day` ADD `cash_k2` DECIMAL(10,2) NULL AFTER `cash`, ADD `cash_k3` DECIMAL(10,2) NULL AFTER `cash_k2`;
ALTER TABLE `cash_day` CHANGE `cash` `cash_k1` DECIMAL(10,2) NULL DEFAULT NULL;

ALTER TABLE `cash_day` CHANGE `card` `card_k1` DECIMAL(10,2) NULL DEFAULT NULL;
ALTER TABLE `cash_day` ADD `card_k2` DECIMAL(10,2) NULL AFTER `card_k1`, ADD `card_k3` DECIMAL(10,2) NULL AFTER `card_k2`;

ALTER TABLE `cash_day` CHANGE `collection` `collection_k1` DECIMAL(10,2) NULL DEFAULT NULL;
ALTER TABLE `cash_day` ADD `collection_k2` DECIMAL(10,2) NULL AFTER `collection_k1`, ADD `collection_k3` DECIMAL(10,2) NULL AFTER `collection_k2`;

ALTER TABLE `cash_day` CHANGE `discount` `discount_k1` DECIMAL(10,2) NULL DEFAULT NULL;
ALTER TABLE `cash_day` ADD `discount_k2` DECIMAL(10,2) NULL AFTER `discount_k1`, ADD `discount_k3` DECIMAL(10,2) NULL AFTER `discount_k2`;

ALTER TABLE `cash_day` CHANGE `increment` `increment_k1` DECIMAL(10,2) NULL DEFAULT NULL;
ALTER TABLE `cash_day` ADD `increment_k2` DECIMAL(10,2) NULL AFTER `increment_k1`, ADD `increment_k3` DECIMAL(10,2) NULL AFTER `increment_k2`;

ALTER TABLE `cash_day` CHANGE `round` `round_k1` DECIMAL(10,2) NULL DEFAULT NULL;
ALTER TABLE `cash_day` ADD `round_k2` DECIMAL(10,2) NULL AFTER `round_k1`, ADD `round_k3` DECIMAL(10,2) NULL AFTER `round_k2`;

ALTER TABLE `cash_day` ADD `turnover_0_k1` DECIMAL(10,2) NULL;
ALTER TABLE `cash_day` ADD `turnover_0_k2` DECIMAL(10,2) NULL;
ALTER TABLE `cash_day` ADD `turnover_0_k3` DECIMAL(10,2) NULL;

ALTER TABLE `cash_day` ADD `turnover_7_k1` DECIMAL(10,2) NULL;
ALTER TABLE `cash_day` ADD `turnover_7_k2` DECIMAL(10,2) NULL;
ALTER TABLE `cash_day` ADD `turnover_7_k3` DECIMAL(10,2) NULL;

ALTER TABLE `cash_day` ADD `turnover_20_k1` DECIMAL(10,2) NULL;
ALTER TABLE `cash_day` ADD `turnover_20_k2` DECIMAL(10,2) NULL;
ALTER TABLE `cash_day` ADD `turnover_20_k3` DECIMAL(10,2) NULL;

ALTER TABLE `cash_day` ADD `return_0_k1` DECIMAL(10,2) NULL;
ALTER TABLE `cash_day` ADD `return_0_k2` DECIMAL(10,2) NULL;
ALTER TABLE `cash_day` ADD `return_0_k3` DECIMAL(10,2) NULL;

ALTER TABLE `cash_day` ADD `return_7_k1` DECIMAL(10,2) NULL;
ALTER TABLE `cash_day` ADD `return_7_k2` DECIMAL(10,2) NULL;
ALTER TABLE `cash_day` ADD `return_7_k3` DECIMAL(10,2) NULL;

ALTER TABLE `cash_day` ADD `return_20_k1` DECIMAL(10,2) NULL;
ALTER TABLE `cash_day` ADD `return_20_k2` DECIMAL(10,2) NULL;
ALTER TABLE `cash_day` ADD `return_20_k3` DECIMAL(10,2) NULL;