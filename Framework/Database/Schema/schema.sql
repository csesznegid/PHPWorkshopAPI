/**
 * Table to store generated tokens
 */
CREATE TABLE IF NOT EXISTS `token_authentication`
(
    `id`          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `token`       TEXT NOT NULL,
    `client_ip`   VARCHAR(128) NOT NULL,
    `expire_date` DATETIME NOT NULL,
    `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY   ( `id` ),
    UNIQUE        ( `token` ),
    INDEX         `idx_client_ip` ( `client_ip` )
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;