<?php


function confirm_appointment($body){
  global $wpdb;

  header("Access-Control-Allow-Origin: *");
  include_once dirname(__DIR__) . "/util.php";
  include dirname(__DIR__) . "/custom_table_constants.php";

  
  $user_ID = getUserID($body);

  try{
    $result = $wpdb->update(
      $appointments_table,
      [
        "confirmed" => 1,
        "confirmed_date" => date('Y-m-d H:i:s')
      ], [
        "ID" => $body["appointment_id"]
      ], [
        "%d", "%s"
      ], [
        "%d"
      ]
    );
  } catch(Exception $e){
    echo "INTERNAL SERVER ERROR: " . $e->getMessage() . "\n";
  }

  header("Content-Type: application/json; charset=utf-8");
  header("Access-Control-Allow-Origin: *");
  if($result === FALSE){
    echo json_encode([
      "status" => "appointment confirmed failed",
      "update last_query" => $wpdb->last_query,
      "update last_error" => $wpdb->last_error
    ]);
  } else{
    echo json_encode([
      "status" => "appointment confirmed",
      "wpdb insert id" => $wpdb->insert_id,
      "update result" => $result
    ]);
  }
}