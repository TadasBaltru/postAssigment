-- Schema and mock data
SET NAMES utf8mb4;
SET time_zone = '+00:00';

-- Drop tables if they exist
DROP TABLE IF EXISTS `posts`;
DROP TABLE IF EXISTS `persons`;
DROP TABLE IF EXISTS `groups`;

-- Groups table
CREATE TABLE `groups` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_group_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Persons table
CREATE TABLE `persons` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `base_id` INT UNSIGNED NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `surname` VARCHAR(100) NOT NULL,
  `group_id` INT UNSIGNED NULL,
  `valid_from` DATE NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_person_base` (`base_id`),
  KEY `idx_person_group` (`group_id`),
  KEY `idx_person_name` (`name`),
  KEY `idx_person_surname` (`surname`),
  CONSTRAINT `fk_persons_group` FOREIGN KEY (`group_id`)
      REFERENCES `groups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Posts table
CREATE TABLE `posts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `person_base_id` INT UNSIGNED NOT NULL,
  `content` TEXT NOT NULL,
  `post_date` DATE NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_posts_person_base` (`person_base_id`),
  KEY `idx_posts_post_date` (`post_date`),
  CONSTRAINT `fk_posts_person` FOREIGN KEY (`person_base_id`)
      REFERENCES `persons` (`base_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert mock groups
INSERT INTO `groups` (`name`) VALUES
('Sports'), ('News'), ('Technology');

-- Insert mock persons
INSERT INTO `persons` (`base_id`, `name`, `surname`, `group_id`, `valid_from`) VALUES
(1001, 'John', 'Doe', 1, '2023-01-01'),
(1002, 'Jane', 'Smith', 2, '2023-06-15'),
(1003, 'Bob', 'Brown', 3, '2024-02-10'),
(1001, 'John', 'Doe', 1, '2023-03-01'),
(1002, 'Jane', 'Smith', 2, '2023-07-01'),
(1004, 'Alice', 'Johnson', 1, '2024-01-10'),
(1005, 'Charlie', 'Lee', 2, '2024-03-05'),
(1006, 'Eve', 'Davis', 3, '2024-04-20'),
(1007, 'Frank', 'Miller', 1, '2024-05-15'),
(1008, 'Grace', 'Wilson', 2, '2024-06-01'),
(1009, 'Henry', 'Moore', 3, '2024-07-12'),
(1010, 'Isabel', 'Taylor', 1, '2024-08-23'),
(1001, 'John', 'Doe', 2, '2024-09-01');

-- Insert mock posts
INSERT INTO `posts` (`person_base_id`, `content`, `post_date`) VALUES
(1001, 'Hello from John', NOW()),
(1002, 'Editorial note', NOW()),
(1003, 'Viewer comment', NOW()),
(1001, 'John Doe second post', NOW()),
(1001, 'John Doe third post', NOW()),
(1002, 'Jane Smith second post', NOW()),
(1003, 'Bob Brown second post', NOW()),
(1004, 'Alice Johnson first post', NOW()),
(1005, 'Charlie Lee first post', NOW()),
(1006, 'Eve Davis first post', NOW()),
(1007, 'Frank Miller first post', NOW()),
(1008, 'Grace Wilson first post', NOW()),
(1009, 'Henry Moore first post', NOW()),
(1010, 'Isabel Taylor first post', NOW()),
(1001, 'John Doe fourth post', NOW());
