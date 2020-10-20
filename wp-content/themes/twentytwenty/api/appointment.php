<?php





function appointmentDoPost(){
  try{
    include __DIR__ . "/util.php";
    include __DIR__ . "/custom_table_constants.php";
    include __DIR__ . "/appointment/make_appointment.php";
  
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $body = json_decode(file_get_contents('php://input'), TRUE);
      if(!isset($body["type"])){
        return;
      }
  
      switch($body["type"]){
      case "make_appointment":
        make_appointment($body);
        exit;
      case "query_appointment":
      case "query_appointments":
        $user_ID = getUserID($body);
        $result = $wpdb->get_results(
          "SELECT
            ID, agent_ID, client_ID, confirmed, finished
          FROM {$appointments_table}
          WHERE client_ID={$user_ID}",
          ARRAY_A);
        header("Content-Type: application/json");
        header("Access-Control-Allow-Origin: *");
        echo json_encode([
          "result" => $result
        ]);
        exit;
      }
    } else{
  
    }
  } catch(Exception $e){
    echo "INTERNAL SERVER ERROR: " . $e->getMessage() . "\n";
  }
}