<?php

use \Firebase\JWT\JWT;

/*
fetch("https://goliathhorkos.com/wp-json/api/v1/edit", {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        "type": "type",
        "token": "asdf"
    })
}).then(res => res.json()).then(res => {
    console.log(res);
})




*/


function editDoShopDescription($user_ID, $body){
    
    include __DIR__ . "/custom_table_constants.php";

    $description = $body["description"];
    if(empty($description)){
        $description = "";
    }

    header('Content-Type: application/json');
    $shop_ID = verifyAgentAndReturnShop($user_ID);

    $query_result = $wpdb->query($wpdb->prepare(
            "UPDATE {$shops_table}
            SET `description`='%s'
            WHERE ID={$shop_ID}", $description));

    http_response_code(200);
    echo json_encode(array(
            "query_result" => $query_result,
    ));
    exit;
}


function verifyUsertype($user_ID, $body){

}

function editDoAddProduct($user_ID, $body){
    include __DIR__ . "/custom_table_constants.php";


    header('Content-Type: application/json');
    $shop_ID = verifyAgentAndReturnShop($user_ID);

    $shop_name = $body["name"];
    $shop_description = $body["description"];
    try{
        $query_result = $wpdb->query("INSERT INTO {$shop_products_table}(
            `name`, shop_ID, `description`
        ) VALUES(
            '{$shop_name}', {$shop_ID}, '{$shop_description}'
        )");
    } catch(Exception $e){
        echo "Error:" . $e->getMessage() . "\n";
    }

    http_response_code(200);
    echo json_encode(array(
        "query_result" => $query_result,
    ));
    exit;
}
function editDoProductDescription($user_ID, $body){
    include __DIR__ . "/custom_table_constants.php";


    header('Content-Type: application/json');
    $shop_ID = verifyAgentAndReturnShop($user_ID);

    $shop_name = $body["name"];
    $shop_description = $body["description"];


    $update_shop_name = isempty($shop_name) ? "" : "`name`='{$shop_name}'";
    $update_shop_description = $shop_description ? "" :
            "`description`='{$shop_description}'";
}

function editDoPost(){

    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        header('HTTP/1.0 501 No Implemented');
        exit;
    }


    $body = json_decode(file_get_contents('php://input'), TRUE);
    if(!isset($body["type"])) exit;
    $token = $body["token"];
    try{
        $out = JWT::decode($token, JWT_AUTH_SECRET_KEY, ['HS256']);
    } catch(Exception $e){
        header('HTTP/1.0 401 Unauthorized');
        echo json_encode(array(
            "out" => "invalid token",
        ));
        exit;
    }

    $user_ID = $out->data->user->id;

    // $JWT_AUTH_PLUGIN_INSTANCE.
    switch($body["type"]){
    case "shop_description":
        editDoShopDescription($user_ID, $body);
        exit;
    case "add_product":
        editDoAddProduct($user_ID, $body);
        exit;
    case "edit_product":
        editDoProductDescription($user_ID, $body);
        exit;
    default:
        http_response_code(400);
        echo '{"out": "bad request"}';
        exit;
    }
}