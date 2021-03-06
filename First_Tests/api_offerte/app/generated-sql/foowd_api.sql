
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- offer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `offer`;

CREATE TABLE `offer`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255),
    `publisher` INTEGER NOT NULL,
    `price` DECIMAL,
    `minqt` DECIMAL,
    `maxqt` DECIMAL,
    `created` DATETIME,
    `modified` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
