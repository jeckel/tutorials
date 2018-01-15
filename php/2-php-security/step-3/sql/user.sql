CREATE TABLE `user` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `login` VARCHAR(64) NOT NULL,
    `passwd` VARCHAR(64) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `signature` VARCHAR(255) NOT NULL,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NOT NULL,
     PRIMARY KEY (id),
    UNIQUE INDEX (login),
    UNIQUE INDEX (email)
) ENGINE=INNODB;
