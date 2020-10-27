<?php
// this file is imported by ./functions.php

function showSveltePage($PAGE = "Home", $props = []){
?><!DOCTYPE html>
<html>
<head>


<link rel="stylesheet" type="text/css"
    href="/pages/<?php echo $PAGE; ?>.css" />
<link rel="modulepreload"
    href="/pages/<?php echo $PAGE; ?>.js" />

<style>
* {
  box-sizing: border-box;
}

html, body {
  height: 100%;
  width: 100%;
  margin: 0;
  border: 0;
}
</style>

</head>
<body>

<script>
(function(){
  import(
    "/pages/<?php echo $PAGE; ?>.js"
  ).then(module => {
    new module.default({
      target: document.body,
      props: <?php echo json_encode((object)$props); ?>
    });
  });
})();
</script>

<?php
} /******** END OF showSveltePage() *************************
*************************************************************/


add_action("parse_request", function($wp){

  $path = $wp->request;

  $match = NULL;
  if(substr($path, 0, 5) === "shop/"){
    $match = "shop";
  } else if(substr($path, 0, 6) === "pages/"){
    $match = "static_file";
  } else if(substr($path, 0, 17) === "view-appointment/"){
    $match = "view-appointment";
  }

  $PAGE = "";
  switch($match ?: $path){
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
    showSveltePage("Shop");
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
      break;
    case "css":
      header("Content-Type: text/css; charset=utf-8");
      break;
    }
    readfile(__DIR__ . "/" . $path);
    exit;
  }


  if($wp->request === "edit-profile"){
    echo "<pre>";
    var_dump($wp);

    exit;
  }


  if($wp->request === "abcd/efgh/ijkl"){
    echo "<pre>";
    echo strtotime("2020-10-16");

    include __DIR__ . "/api/custom_table_constants.php";
    var_dump($wp);

    exit;
  }
  return $wp;
});