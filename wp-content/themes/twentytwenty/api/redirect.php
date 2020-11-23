<?php


function redirectDoPost(WP_REST_Request $request){
  $a = file_get_contents('php://input');

  $data = $request->get_body();

  header("Content-Type: application/json");
  header("Access-Control-Allow-Origin: *");
  echo json_encode([
    "a" => $a,
    "data" => $data
  ]);
  exit;
}


function infoV2Redirect(WP_REST_Request $request){
  file_get_contents('php://input');

  $url = 'localhost:5000/info';
  $data = $request->get_body();

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
  )); 

  $response = curl_exec($ch);
  curl_close($ch);

  echo $response;
  exit;
}


function appointmentsV2Redirect(WP_REST_Request $request){
  echo $request->get_route();
  file_get_contents('php://input');

  $url = 'localhost:5000/appointments';
  $data = $request->get_body();

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
  )); 

  $response = curl_exec($ch);
  curl_close($ch);

  echo $response;
  exit;
}