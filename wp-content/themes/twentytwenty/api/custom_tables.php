<?php
/**
 * DANGEROUS:
 * 
 * DROP TABLE wp_userprofile, wp_shops, wp_shop_products
 * 
 */

include __DIR__ . "/custom_table_constants.php";

$wpdb->query("CREATE TABLE IF NOT EXISTS {$profile_table} (
    ID                  BIGINT(20) UNSIGNED NOT NULL,
    usertype            ENUM('admin', 'client', 'agent', 'guest') DEFAULT 'client' NOT NULL,
    verified            BOOLEAN DEFAULT 0,
    email_verified      BOOLEAN DEFAULT 0,
    license_verified    BOOLEAN DEFAULT 0,
    rating              FLOAT,
    phone               VARCHAR(20),
    shop_ID             BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (ID) REFERENCES {$users_table}(ID) ON DELETE CASCADE
)");
$wpdb->query("CREATE TABLE IF NOT EXISTS {$shops_table} (
    ID                  BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    owner_ID            BIGINT(20) UNSIGNED NOT NULL,
    `name`              TEXT,
    `description`       TEXT,
    PRIMARY KEY (ID),
    FOREIGN KEY (owner_ID) REFERENCES {$profile_table}(ID) ON DELETE CASCADE
)");
$wpdb->query("CREATE TABLE IF NOT EXISTS {$shop_products_table} (
    ID                  BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    shop_ID             BIGINT(20) UNSIGNED NOT NULL,
    `name`              TEXT,
    `description`       TEXT,
    PRIMARY KEY (ID),
    FOREIGN KEY (shop_ID) REFERENCES {$shops_table}(ID) ON DELETE CASCADE
)");


$wpdb->query("CREATE TABLE IF NOT EXISTS {$appointments_table} (
  ID                  BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  agent_ID            BIGINT(20) UNSIGNED NOT NULL,
  client_ID           BIGINT(20) UNSIGNED NOT NULL,
  `initiated_date`    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `requested_date`    TIMESTAMP,
  `confirmed_date`    TIMESTAMP,
  confirmed           BOOLEAN DEFAULT 0,
  `finished_date`     TIMESTAMP,
  finished            BOOLEAN DEFAULT 0,
  
  PRIMARY KEY (ID),
  FOREIGN KEY (agent_ID) REFERENCES {$users_table}(ID) ON DELETE CASCADE,
  FOREIGN KEY (client_ID) REFERENCES {$users_table}(ID) ON DELETE CASCADE
)");


/*
$wpdb->query("ALTER TABLE {$profile_table} ADD FOREIGN KEY (shop_ID) REFERENCES {$shops_table}(ID) ON DELETE CASCADE");

$wpdb->query("INSERT INTO {$profile_table}(ID, usertype, shop_ID) VALUES(3, 'agent', 0)")
echo `pwd`;


add column:
ALTER TABLE table ADD column_name column_definition;
*/

?>