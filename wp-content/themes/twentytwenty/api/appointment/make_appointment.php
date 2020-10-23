<?php


function make_appointment($body){
  header("Access-Control-Allow-Origin: *");
  include_once dirname(__DIR__) . "/util.php";
  include dirname(__DIR__) . "/custom_table_constants.php";
  
  $user_ID = getUserID($body);

  $result = $wpdb->insert(
    $appointments_table,
    [
      "initiated_date" => date('Y-m-d H:i:s'),
      "client_message" => $body["client_message"],
      "agent_ID" => $body["agent_id"],
      "client_ID" => $body["client_id"],
      "requested_date" => strtotime($body["date"])
    ], [
      "%s", "%d", "%d", "%d"
    ]
  );

  header("Content-Type: application/json; charset=utf-8");
  header("Access-Control-Allow-Origin: *");
  echo json_encode([
    "status" => "success",
    "appointment_id" => $wpdb->insert_id,
    "insert result" => $result
  ]);
}