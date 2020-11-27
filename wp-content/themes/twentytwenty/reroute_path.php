<?php

include __DIR__ . "/util/svelte_util.php"; // showSveltePage()

add_action("parse_request", function($wp){

  $method = $_SERVER["REQUEST_METHOD"];
  $path = parse_url($wp->request, PHP_URL_PATH);

  $match = NULL;
  if(substr($path, 0, 5) === "shop/"){
    $match = "shop";
    preg_match("/shop\\/(\\d+)/", "shop/123", $m);
    $props = [
      "id" => $m[1]
    ];
  } else if(substr($path, 0, 6) === "pages/"){
    $match = "static_file";
  } else if(substr($path, 0, 17) === "view-appointment/"){
    $match = "view-appointment";
  } else if(substr($path, 0, 8) === "article/"){
    $match = "article";
  }

  $PAGE = "";
  switch($match ?: $path){
  case "articles":
    showSveltePage("Articles");
    exit;
  case "article":
    showSveltePage("Article");
    exit;
  case "agent":
    showSveltePage("Agent");
    exit;
  case "agents":
    showSveltePage("Agents");
    exit;
  case "create-appointment":
    showSveltePage("CreateAppointment");
    exit;
  case "qna":
    showSveltePage("QNA");
    exit;
  case "view-appointment":
    showSveltePage("ViewAppointment");
    exit;
  case "login":
    showSveltePage("Login");
    exit;
  case "profile":
    showSveltePage("Profile");
    exit;
  case "edit-profile":
    showSveltePage("EditProfile");
    exit;
  case "shop":
    showSveltePage("Shop", $props);
    exit;
  case "404":
    showSveltePage("404");
    exit;
  case "appointment":
  case "appointments":
    showSveltePage("Appointment");
    exit;
  case "make_appointment":
  case "make-appointment":
    showSveltePage("MakeAppointment");
    exit;
  case "static_file":
    /**
     * TODO:
     * https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Cache-Control
     */
    switch(pathinfo($path, PATHINFO_EXTENSION)){
    case "js":
      header("Content-Type: application/javascript; charset=utf-8");
      header("Access-Control-Allow-Origin: *");
      readfile(__DIR__ . "/" . $path);
      exit;
    case "css":
      header("Content-Type: text/css; charset=utf-8");
      readfile(__DIR__ . "/" . $path);
      exit;
    }
    exit;
  }


  if($wp->request === "jwt-auth/v1/token/validate"){
    header("Access-Control-Allow-Origin: *");
    echo json_encode([
      "result" => "ok"
    ]);
    exit;
  }


  if($wp->request === "abcd/efgh/ijkl"){
    echo "<pre>";
    echo preg_match("/shop\\/(\\d+)/", "shop/123", $match);
    var_dump($match);
    echo parse_url($wp->request, PHP_URL_PATH);
    echo "<br />";
    echo strtotime("2020-10-16");

    include __DIR__ . "/api/custom_table_constants.php";
    var_dump($wp);

    exit;

    
    // foreach(range(6, 38) as $id){
    //   wp_set_password("a", $id);
    // }
  }
  return $wp;
});