ALTER TABLE `routes` CHANGE `route_date` `route_date` DATE NOT NULL;
ALTER TABLE `routes` ADD `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `route_date`;
ALTER TABLE `routes` ADD `destination_id` INT(7) NOT NULL AFTER `create_date`;
ALTER TABLE `routes` ADD INDEX(`apteka_id`);


ALTER TABLE `destination`
  DROP `numb`,
  DROP `priority`;
CREATE TABLE `analytics`.`standart_routes` ( `id` INT(7) NOT NULL AUTO_INCREMENT , `day_id` INT(2) NOT NULL , `destination_id` INT(7) NOT NULL , `numb` INT(5) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
RENAME TABLE `analytics`.`standart_routes` TO `analytics`.`routes_standart`;