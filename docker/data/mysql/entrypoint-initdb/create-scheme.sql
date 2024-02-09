CREATE TABLE `model`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL
);
CREATE TABLE `car_ad`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(1024) NOT NULL,
    `registered_at` DATE NULL,
    `mileage` INT UNSIGNED NOT NULL,
    `modification_code` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `car_ad` ADD INDEX `car_ad_mileage_index`(`mileage`);
ALTER TABLE
    `car_ad` ADD INDEX `car_ad_modification_code_index`(`modification_code`);
CREATE TABLE `modification`(
    `code` VARCHAR(255) NOT NULL,
    `model_id` INT UNSIGNED NOT NULL,
    `gearbox` VARCHAR(255) NOT NULL,
    `fuel` VARCHAR(255) NOT NULL,
    `engine_size` INT NOT NULL,
    `origin_country` VARCHAR(10) NOT NULL,
    `power` INT UNSIGNED NOT NULL,
    `emission_class` VARCHAR(255) NOT NULL,
    `co2_value` INT UNSIGNED NOT NULL
);
ALTER TABLE
    `modification` ADD PRIMARY KEY(`code`);
ALTER TABLE
    `modification` ADD INDEX `modification_gearbox_index`(`gearbox`);
ALTER TABLE
    `modification` ADD INDEX `modification_fuel_index`(`fuel`);
ALTER TABLE
    `modification` ADD INDEX `modification_origin_country_index`(`origin_country`);
ALTER TABLE
    `modification` ADD INDEX `modification_power_index`(`power`);
ALTER TABLE
    `car_ad` ADD CONSTRAINT `car_ad_modification_code_foreign` FOREIGN KEY(`modification_code`) REFERENCES `modification`(`code`);
ALTER TABLE
    `modification` ADD CONSTRAINT `modification_model_id_foreign` FOREIGN KEY(`model_id`) REFERENCES `model`(`id`);
