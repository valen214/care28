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
    shop_ID             BIGINT(20) UNSIGNED,
    avatar              TEXT,
    license             TEXT,
    area                TEXT,
    PRIMARY KEY (ID),
    FOREIGN KEY (ID) REFERENCES {$users_table}(ID) ON DELETE CASCADE
)");
$wpdb->query("CREATE TABLE IF NOT EXISTS {$shops_table} (
    ID                  BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    owner_ID            BIGINT(20) UNSIGNED NOT NULL,
    `name`              TEXT,
    `description`       TEXT,
    PRIMARY KEY (ID),
    FOREIGN KEY (owner_ID) REFERENCES {$users_table}(ID) ON DELETE CASCADE
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
  client_message      TEXT,
  agent_message       TEXT,
  `initiated_date`    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `requested_date`    TIMESTAMP,
  `confirmed_date`    TIMESTAMP,
  confirmed           BOOLEAN DEFAULT 0,
  `finished_date`     TIMESTAMP,
  finished            BOOLEAN DEFAULT 0,
  feedback            TEXT,
  
  PRIMARY KEY (ID),
  FOREIGN KEY (agent_ID) REFERENCES {$users_table}(ID) ON DELETE CASCADE,
  FOREIGN KEY (client_ID) REFERENCES {$users_table}(ID) ON DELETE CASCADE
)");

$wpdb->query("CREATE TABLE IF NOT EXISTS {$product_images_table} (
  ID                  BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  product_ID          BIGINT UNSIGNED NOT NULL,
  path                TEXT NOT NULL,
  original_name       TEXT
)");


/*
$wpdb->query("ALTER TABLE {$profile_table} ADD FOREIGN KEY (shop_ID) REFERENCES {$shops_table}(ID) ON DELETE CASCADE");

$wpdb->query("INSERT INTO {$profile_table}(ID, usertype, shop_ID) VALUES(3, 'agent', 0)")
echo `pwd`;


add column:
ALTER TABLE table ADD column_name column_definition;



DELETE FROM table_name WHERE selection_criteria LIMIT 1; 


INSERT INTO care28_userprofile(ID, usertype) VALUES (4, 'client');
SELECT * FROM care28_userprofile;
ALTER TABLE care28_userprofile MODIFY COLUMN shop_ID BIGINT(20) UNSIGNED;
UPDATE care28_userprofile SET shop_ID=NULL WHERE ID=4;
*/

?>