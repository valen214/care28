<?php

function shopDoPost(){
  try{
    include_once dirname(__DIR__) . "/util.php";
    include dirname(__DIR__) . "/custom_table_constants.php";
  
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $body = json_decode(file_get_contents('php://input'), TRUE);
      if(!isset($body["type"])){
        return;
      }
  
      switch($body["type"]){
      case "info":
        include_once __DIR__ . "/info.php";
        query_shop_info($body);
        exit;
      }
    } else{
  
    }
  } catch(Exception $e){
    echo "INTERNAL SERVER ERROR: " . $e->getMessage() . "\n";
  }
}