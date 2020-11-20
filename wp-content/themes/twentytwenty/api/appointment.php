<?php


function query_appointment($body){
  include __DIR__ . "/custom_table_constants.php";
  
  $user_ID = getUserID($body);
  $usertype = $wpdb->get_var("
    SELECT usertype FROM {$profile_table} WHERE ID={$user_ID}"
  );
  $id_column = $usertype == 'agent' ? 'agent_ID' : 'client_ID';
  $appointment_id = $wpdb->prepare("%d", $body["appointment_id"]);
  $result = $wpdb->get_results(
"SELECT
a.ID,
a.agent_ID,
a.client_ID,
a.confirmed,
a.finished,
a.requested_date,
a.initiated_date,
(
  SELECT display_name FROM {$users_table} u WHERE u.ID=a.agent_ID
) AS agent_name,
(
  SELECT display_name FROM {$users_table} u WHERE u.ID=a.client_ID
) AS client_name
FROM {$appointments_table} AS a
WHERE {$id_column}={$user_ID} AND ID={$appointment_id};",
    ARRAY_A);
  header("Content-Type: application/json");
  header("Access-Control-Allow-Origin: *");
  echo json_encode([
    "result" => $result,
    "id_column" => $id_column,
    "usertype" => $usertype,
    "user_ID" => $user_ID,
  ]);
}

function query_appointments($body){
  include __DIR__ . "/custom_table_constants.php";

  $user_ID = getUserID($body);
  $usertype = $wpdb->get_var("
    SELECT usertype FROM {$profile_table} WHERE ID={$user_ID}"
  );

  $id_column = $usertype == 'agent' ? 'agent_ID' : 'client_ID';
  $result = $wpdb->get_results(
"SELECT
a.ID,
a.agent_ID,
a.client_ID,
a.confirmed,
a.finished,
a.requested_date,
(
SELECT display_name FROM {$users_table} u WHERE u.ID=a.agent_ID
) AS agent_name,
(
SELECT display_name FROM {$users_table} u WHERE u.ID=a.client_ID
) AS client_name
FROM {$appointments_table} AS a
WHERE {$id_column}={$user_ID};",
    ARRAY_A);
  header("Content-Type: application/json");
  header("Access-Control-Allow-Origin: *");
  echo json_encode([
    "result" => $result,
    "id_column" => $id_column,
    "usertype" => $usertype,
    "user_ID" => $user_ID,
  ]);
}


function appointmentDoPost(){
  try{
    include_once __DIR__ . "/util.php";
    include_once __DIR__ . "/custom_table_constants.php";
    include_once __DIR__ . "/appointment/make_appointment.php";
    include_once __DIR__ . "/appointment/confirm_appointment.php";
  
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $body = json_decode(file_get_contents('php://input'), TRUE);
      if(!isset($body["type"])){
        return;
      }
  
      switch($body["type"]){
      case "cancel_appointment":
        include_once __DIR__ . "/appointment/cancel_appointment.php";
        cancel_appointment($body);
        exit;
      case "make_appointment":
        make_appointment($body);
        exit;
      case "confirm_appointment":
        confirm_appointment($body);
        exit;
      case "query_appointment":
        query_appointment($body);
        exit;
      case "query_appointments":
        query_appointments($body);
        exit;
      }
    } else{
  
    }
  } catch(Exception $e){
    echo "INTERNAL SERVER ERROR: " . $e->getMessage() . "\n";
  }
}