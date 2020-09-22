
<?php

include __DIR__ . "/user.php";
include __DIR__ . "/info.php";
include __DIR__ . "/edit.php";

add_action('rest_api_init', function(){
    register_rest_route( 'api/v1', '/user', array(
        'methods' => 'POST',
        'callback' => 'userDoPost',
    ));

    register_rest_route("api/v1", "/info", array(
        "methods" => "POST",
        "callback" => "infoDoPost",
    ));
});

?>