ALTER TABLE `routes` CHANGE `route_date` `route_date` DATE NOT NULL;
ALTER TABLE `routes` ADD `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `route_date`;
ALTER TABLE `routes` ADD `destination_id` INT(7) NOT NULL AFTER `create_date`;
ALTER TABLE `routes` ADD INDEX(`apteka_id`);