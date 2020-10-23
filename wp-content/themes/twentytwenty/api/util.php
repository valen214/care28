<?php


use \Firebase\JWT\JWT;


function getUserID($body){
  if(isset($body["token"])){
    $token = $body["token"];
    try{
      $out = JWT::decode($token, JWT_AUTH_SECRET_KEY, [ 'HS256' ]);
      $user_ID = $out->data->user->id;
      if(!empty($user_ID)){
        return $user_ID;
      }
    } catch(Exception $e){
      header('HTTP/1.0 401 Unauthorized');
      exit;
    }
  }
}