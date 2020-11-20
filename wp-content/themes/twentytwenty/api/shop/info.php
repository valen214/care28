<?php


function query_shop_info($body){

  include_once dirname(__DIR__) . "/util.php";
  include dirname(__DIR__) . "/custom_table_constants.php";


  $agents_query = $wpdb->prepare("
SELECT
  p.ID,
  usertype,
  display_name as name
FROM
  {$profile_table} as p
JOIN
  {$users_table} as u
ON p.ID=u.ID
WHERE shop_ID=%d
",
    $body["shop_id"] ?? $body["shop_ID"]);
  $agents = $wpdb->get_results($agents_query);


  $products = $wpdb->get_results($wpdb->prepare("
SELECT
  *
FROM
  {$shop_products_table}
WHERE
  shop_ID=%d
LIMIT 10
",
    $body["shop_id"] ?? $body["shop_ID"] ));


  $reports = $wpdb->get_results($wpdb->prepare("
", 
    $body["shop_id"] ?? $body["shop_ID"] ));

  
  header("Content-Type: application/json");
  header("Access-Control-Allow-Origin: *");
  echo json_encode([
    "agents" => $agents,
    "products" => $products,
    "reports" => $reports,
  ]);
}