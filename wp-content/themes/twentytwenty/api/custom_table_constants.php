<?php
global $wpdb;

$users_table = "{$wpdb->prefix}users";

$profile_table = "{$wpdb->prefix}userprofile";
$shops_table = "{$wpdb->prefix}shops";
$shop_products_table = "{$wpdb->prefix}shop_products";
$product_images_table = "{$wpdb->prefix}product_images";

$appointments_table = "{$wpdb->prefix}appointments";


/**
 * /var/www/html/wp-content/uploads/avatar/
 * 
 * to display for example abc.png in site the path needs to be
 * /wp-content/uploads/avatar/abc.png
 */
$avatar_folder = wp_get_upload_dir()["basedir"] . "/avatar/";
