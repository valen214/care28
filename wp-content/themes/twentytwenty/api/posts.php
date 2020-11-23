<?php


function doAllPost($body){
  include __DIR__ . "/custom_table_constants.php";
  $result = $wpdb->get_results("
SELECT
  ID as id,
  post_title AS title,
  post_author AS author,
  post_content AS content
FROM care28_posts");

  header("Content-Type: application/json");
  header("Access-Control-Allow-Origin: *");
  echo json_encode($result);
}

function doRecentPost($body){
  include __DIR__ . "/custom_table_constants.php";
  $result = $wpdb->get_results("
SELECT
  ID as id,
  post_title AS title,
  post_author AS author,
  post_content AS content
FROM care28_posts LIMIT 5");

  header("Content-Type: application/json");
  header("Access-Control-Allow-Origin: *");
  echo json_encode($result);
}

function doRetrievePost($body){
  include __DIR__ . "/custom_table_constants.php";
  $result = $wpdb->get_results($wpdb->prepare("
SELECT
  ID as id,
  post_title AS title,
  post_author AS author,
  post_content AS content
FROM care28_posts WHERE ID=%d",
    $body["ID"] ?? $body["id"]
  ));


  header("Content-Type: application/json");
  header("Access-Control-Allow-Origin: *");
  echo json_encode($result[0]);
}

function postsDoPost(){
  try{
    include_once __DIR__ . "/util.php";
    include __DIR__ . "/custom_table_constants.php";
  
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $body = json_decode(file_get_contents('php://input'), TRUE);
      if(!isset($body["type"])){
        return;
      }
  
      switch($body["type"]){
      case "all":
        doAllPost($body);
        exit;
      case "recent":
        doRecentPost($body);
        exit;
      case "retrieve":
        doRetrievePost($body);
        exit;
      }
    } else{
  
    }
  } catch(Exception $e){
    echo "HI";
    echo "INTERNAL SERVER ERROR: " . $e->getMessage() . "\n";
  }
}