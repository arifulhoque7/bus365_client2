insert into `permissions` (`id`, `role_id`, `user_id`, `menu_id`, `menu_title`, `create`, `read`, `edit`, `delete`, `created_at`, `updated_at`, `deleted_at`) values('884','1','1','129','layout','1','1','1','1','2022-06-13 17:48:10','2023-01-21 10:11:39',NULL);
insert into `permissions` (`id`, `role_id`, `user_id`, `menu_id`, `menu_title`, `create`, `read`, `edit`, `delete`, `created_at`, `updated_at`, `deleted_at`) values('884','1','1','130','layout_list','1','1','1','1','2022-06-13 17:48:10','2023-01-21 10:11:39',NULL);

ALTER TABLE `fleets` CHANGE `layout` `layout` INT NOT NULL; 
ALTER TABLE `fleets` DROP COLUMN `last_seat`;

-- For free_luggage_pcs
ALTER TABLE trips
ADD COLUMN free_luggage_pcs INT(11) UNSIGNED NULL;

-- For free_luggage_kg
ALTER TABLE trips
ADD COLUMN free_luggage_kg DECIMAL(10,2) NULL;

-- For paid_max_luggage_pcs
ALTER TABLE trips
ADD COLUMN paid_max_luggage_pcs INT(11) UNSIGNED  NULL;

-- For paid_max_luggage_kg
ALTER TABLE trips
ADD COLUMN paid_max_luggage_kg DECIMAL(10,2) NULL;

-- For price_pcs
ALTER TABLE trips
ADD COLUMN price_pcs DECIMAL(10,2) NULL;

-- For price_kg
ALTER TABLE trips
ADD COLUMN price_kg DECIMAL(10,2) NULL;


ALTER TABLE tickets ADD COLUMN free_luggage_pcs INT(11) UNSIGNED NULL AFTER drop_stand_id;
ALTER TABLE tickets ADD COLUMN free_luggage_kg DECIMAL(10,2) NULL AFTER free_luggage_pcs;
ALTER TABLE tickets ADD COLUMN paid_max_luggage_pcs INT(11) UNSIGNED NULL AFTER free_luggage_kg;
ALTER TABLE tickets ADD COLUMN paid_max_luggage_kg DECIMAL(10,2) NULL AFTER paid_max_luggage_pcs;
ALTER TABLE tickets ADD COLUMN price_pcs DECIMAL(10,2) NULL AFTER paid_max_luggage_kg;
ALTER TABLE tickets ADD COLUMN price_kg DECIMAL(10,2) NULL AFTER price_pcs;

ALTER TABLE `tickets` CHANGE `price` `price` DECIMAL(10,2) NOT NULL, 
CHANGE `discount` `discount` DECIMAL(10,2) NULL, 
CHANGE `roundtrip_discount` `roundtrip_discount` DECIMAL(10,2) NULL, 
CHANGE `paidamount` `paidamount` DECIMAL(10,2) NOT NULL; 

-- aleter table for websetting add column int
ALTER TABLE `websettings` ADD COLUMN `luggage_service` INT(11) NOT NULL AFTER `pay_later`;
Alter TABLE `websettings` ADD COLUMN `chat_tawk` INT(11) NOT NULL AFTER `luggage_service`;

ALTER TABLE `fleets` DROP COLUMN `luggage_service`; 

ALTER TABLE `users` ADD COLUMN `employee_id` INT UNSIGNED AFTER `id`;


ALTER TABLE stuffassigns ADD COLUMN start_date DATE DEFAULT NULL AFTER employee_type;
ALTER TABLE stuffassigns ADD COLUMN end_date DATE DEFAULT NULL AFTER start_date;
ALTER TABLE stuffassigns ADD COLUMN approved_by BIGINT DEFAULT 0 NULL AFTER end_date; 
 ALTER TABLE stuffassigns ADD COLUMN is_approved INT DEFAULT 0 NULL AFTER end_date; 

INSERT INTO menus (menu_title, page_url, module_name, parent_menu_id, have_chield) 
VALUES ('admin_dashboard', '/', 'admin_dashboard', '134', '1'), 
('driver_dashboard', 'driver/home', 'driver_dashboard', '135', '1'); 

INSERT INTO `permissions` (`role_id`, `user_id`, `menu_id`, `menu_title`, `read`) VALUES ('4', '1', '134', 'admin_dashboard', '1'); 
INSERT INTO `permissions` (`role_id`, `user_id`, `menu_id`, `menu_title`, `read`) VALUES ('4', '1', '135','driver_dashboard', '1'); 

INSERT INTO `permissions` (`role_id`, `user_id`, `menu_id`, `menu_title`, `read`) VALUES ('1', '1', '134', 'admin_dashboard', '1'); 
INSERT INTO `permissions` (`role_id`, `user_id`, `menu_id`, `menu_title`, `read`) VALUES ('1', '1', '135','driver_dashboard', '1');  

 ALTER TABLE `tickets` ADD COLUMN `special_luggage` TEXT NULL AFTER `price_kg`; 

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `fleets`;
TRUNCATE TABLE `trips`;
TRUNCATE TABLE `tickets`;
TRUNCATE TABLE `luggage_settings`;
TRUNCATE TABLE `locations`;
TRUNCATE TABLE `layouts`;
TRUNCATE TABLE `layout_details`;
TRUNCATE TABLE `fleets`;
TRUNCATE TABLE `pickdrops`;
TRUNCATE TABLE `stands`;
TRUNCATE TABLE `stuffassigns`;
TRUNCATE TABLE `subtrips`;
TRUNCATE TABLE `ticket_tags`;
TRUNCATE TABLE `refunds`;
TRUNCATE TABLE `accounts`;
TRUNCATE TABLE `agents`;
TRUNCATE TABLE `cancels`;
TRUNCATE TABLE `coupondiscounts`;
TRUNCATE TABLE `coupons`;
TRUNCATE TABLE `employees`;
TRUNCATE TABLE `fitnesses`;
TRUNCATE TABLE `journeylists`;
TRUNCATE TABLE `temporarybooks`;
TRUNCATE TABLE `vehicles`;

ALTER TABLE `fitnesses` ADD COLUMN `subtrip_id` BIGINT NULL AFTER `overall_car_condition`; 