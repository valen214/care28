<?php


use \Firebase\JWT\JWT;


function getUserID($body){
  if(isset($body["token"])){
    $token = $body["token"];
    try{
      $out = JWT::decode($token, JWT_AUTH_SECRET_KEY, [ 'HS256' ]);
    } catch(Exception $e){
      header('HTTP/1.0 401 Unauthorized');
      exit;
    }

    $user_ID = $out->data->user->id;
    return $user_ID;
  }
}