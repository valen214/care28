
<?php

include __DIR__ . "/user.php";
include __DIR__ . "/info.php";
include __DIR__ . "/redirect.php";

add_action('rest_api_init', function(){
    register_rest_route( 'api/v1', '/user', array(
        'methods' => 'POST',
        'callback' => 'userDoPost',
    ));

    register_rest_route("api/v1", "/info", array(
        "methods" => "POST",
        "callback" => "infoDoPost",
    ));

    
    register_rest_route("api/v2", "/info", array(
      "methods" => "POST",
      "callback" => "infoV2Redirect",
    ));


    
    register_rest_route("api/v2", "/appointments", array(
      "methods" => "POST",
      "callback" => "appointmentsV2Redirect",
    ));
});

?>