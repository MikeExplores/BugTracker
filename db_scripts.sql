CREATE DATABASE bug_tracker;

CREATE TABLE `bug_tracker`.`bugs` ( `bug_id` INT NOT NULL AUTO_INCREMENT, `product_name` VARCHAR(255) NOT NULL , `version` VARCHAR(255) NOT NULL , `hardware_type` VARCHAR(255) NOT NULL , `operating_system` VARCHAR(255) NOT NULL , `occurrence_frequency` VARCHAR(255) NOT NULL , `proposed_solution` VARCHAR(255) NOT NULL , PRIMARY KEY (`bug_id`)); 