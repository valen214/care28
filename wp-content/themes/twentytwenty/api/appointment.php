<?php












function appointmentDoPost(){
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
    }
  } else{

  }
}