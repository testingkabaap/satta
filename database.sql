CREATE TABLE `tbl_satta_records` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT COMMENT 'Incremented unique id',
  `record_date` DATE NOT NULL COMMENT 'Record Date',
  `time_slot` TIME NOT NULL COMMENT 'Time Slots',
  `satta_number` INT NOT NULL COMMENT 'Satta Number',
  `created_at` DATETIME DEFAULT current_timestamp() COMMENT 'Created Date and Time',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Updated Date and Time'
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT 'Satta Records Table';