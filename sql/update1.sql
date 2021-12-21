ALTER TABLE `apteka` ADD `mypharmacy` INT(5) NULL AFTER `liki24_id`;
ALTER TABLE `apteka` CHANGE `mypharmacy` `mypharmacy_id` INT(5) NULL DEFAULT NULL;
