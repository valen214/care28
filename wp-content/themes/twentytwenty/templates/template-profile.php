<?php
/**
 * Template Name: Profile Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

include dirname(__DIR__) . "/api/custom_table_constants.php";

$current_user = wp_get_current_user();

$user_ID = get_current_user_id();
$usertype = $wpdb->get_var(
  "SELECT `usertype` FROM {$profile_table} WHERE `ID`={$user_ID}"
);
if(empty($usertype) || $usertype !== "agent"){
  $usertype = "client";
} else{
  $shop_ID = $wpdb->get_var(
    "SELECT `shop_ID` FROM {$profile_table} WHERE `ID`={$user_ID}"
  );
}

$props = [];
if(!empty($usertype)){
  $props["usertype"] = $usertype;
}
if(!empty($current_user->user_nicename)){
  $props["username"] = $current_user->user_nicename;
}

if(!empty($shop_ID)){
  $products_array = $wpdb->get_results(
    "SELECT * FROM {$shop_products_table} WHERE `shop_ID`={$shop_ID}",
  ARRAY_A );

  $products_data = [];
  foreach($products_array as $product){
    $products_data[$product["ID"]] = $product;
  }
  $props["products"] = $products_data;
}



?><!DOCTYPE html>
<html>
<head>
<?php

?>
</head>
<body>
<script>
(function(){

let injectStyleSheet = (href) => {
  let link = document.createElement("link");
  link.rel = "stylesheet";
  link.href = href;
  document.head.appendChild(link);
};

let SCRIPT_ORIGIN = "http://150.136.251.80:8000";
injectStyleSheet(SCRIPT_ORIGIN + "/pages/Profile.css");
import(
  SCRIPT_ORIGIN + "/pages/Profile.js"
).then(module => {
  new module.default({
    target: document.body,
    props: <?php
      echo empty($props) ? "{}" : json_encode($props);
    ?>
  });
});


})();
</script>
