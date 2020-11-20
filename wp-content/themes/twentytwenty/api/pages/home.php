<?php


function homePageProps(){
  include dirname(__DIR__) . "/custom_table_constants.php";

  $posts = $wpdb->get_results(
    "SELECT * FROM {$posts_table} LIMIT 5"
  );
  
  return json_encode([
    "posts" => $posts
  ]);
}