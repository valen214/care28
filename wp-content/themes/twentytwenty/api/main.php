
<?php

include __DIR__ . "/user.php";
include __DIR__ . "/info.php";
include __DIR__ . "/redirect.php";
include __DIR__ . "/appointment.php";
include __DIR__ . "/shop/main.php";
include __DIR__ . "/posts.php";

add_action('rest_api_init', function(){
    register_rest_route( 'api/v1', '/redirect', array(
        'methods' => 'POST',
        'callback' => 'redirectDoPost',
        'permission_callback' => '__return_true',
    ));

    register_rest_route( 'api/v1', '/user', array(
        'methods' => 'POST',
        'callback' => 'userDoPost',
        'permission_callback' => '__return_true',
    ));

    register_rest_route("api/v1", "/info", array(
        "methods" => "POST",
        "callback" => "infoDoPost",
        'permission_callback' => '__return_true'
    ));

    register_rest_route("api/v1", "appointments", array(
        "methods" => "POST",
        "callback" => "appointmentDoPost",
        'permission_callback' => '__return_true'
    ));
    register_rest_route("api/v1", "appointment", array(
        "methods" => "POST",
        "callback" => "appointmentDoPost",
        'permission_callback' => '__return_true'
    ));

    register_rest_route("api/v1", "/shop", array(
      "methods" => "POST",
      "callback" => "shopDoPost",
      'permission_callback' => '__return_true'
    ));


    register_rest_route("api/v1", "/posts", array(
      "methods" => "POST",
      "callback" => "postsDoPost",
      'permission_callback' => '__return_true'
    ));

    
    register_rest_route("api/v2", "/info", array(
        "methods" => "POST",
        "callback" => "infoV2Redirect",
        'permission_callback' => '__return_true',
    ));

    
    register_rest_route("api/v2", "/appointments", array(
        "methods" => "POST",
        "callback" => "appointmentsV2Redirect",
        'permission_callback' => '__return_true',
    ));
});

?>