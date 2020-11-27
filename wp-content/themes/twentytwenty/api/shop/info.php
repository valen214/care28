<?php


function query_shop_info($body){

  include_once dirname(__DIR__) . "/util.php";
  include dirname(__DIR__) . "/custom_table_constants.php";

  $shop_id = $body["id"] ?? $body["ID"] ??
      $body["shop_id"] ?? $body["shop_ID"];

  $agents_query = $wpdb->prepare("
SELECT
  p.ID,
  p.area,
  p.rating,
  p.avatar,
  p.shop_ID as shop_id,
  u.display_name as 'name'
FROM
  {$profile_table} AS p
JOIN
  {$users_table} AS u
ON p.ID=u.ID
WHERE shop_ID=%d", $shop_id);
  $agents = $wpdb->get_results($agents_query);


  $products = $wpdb->get_results($wpdb->prepare("
SELECT
  *
FROM
  {$shop_products_table}
WHERE
  shop_ID=%d
LIMIT 10", $shop_id));


  $reports = $wpdb->get_results($wpdb->prepare("
", $shop_id));


  $shop_info = $wpdb->get_results($wpdb->prepare("
SELECT
  `address`
FROM
  {$shops_table} as u
WHERE `ID`=%d", $shop_id), ARRAY_A)[0] ?? [];
  
  header("Content-Type: application/json");
  header("Access-Control-Allow-Origin: *");
  echo json_encode(array_merge([
    "agents" => $agents,
    "products" => $products,
    "reports" => $reports,
  ], $shop_info));
}