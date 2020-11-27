<?php




function apiUserDoRegister($body){
    global $wpdb;
    $profile_table = "{$wpdb->prefix}userprofile";
    $shops_table = "{$wpdb->prefix}shops";

    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *");
    
    $username = $body["username"];
    $password = $body["password"];
    $usertype = $body["usertype"];
    $email = $body["email"];

    if(!empty($email) and email_exists($email)){
        http_response_code(409);
        echo json_encode(array(
            "body" => "email already exists"
        ));
        exit(0);
    }
    if(username_exists($username)){
        http_response_code(409);
        echo json_encode(array(
            "body" => "username already exists"
        ));
        exit(0);
    }
    $result = wp_create_user($username, $password, $email);
    if(is_wp_error($result)){
        http_response_code(409);
        echo json_encode(array(
            "body" => "user registration failed"
        ));
        exit(0);
    }
    if($usertype !== "agent"){
        $usertype = "client";
    }
    $user_ID = $result;
    
    if($usertype === "agent"){
        $result = $wpdb->insert($shops_table, [
          "owner_ID" => $user_ID
        ], [
          "%d"
        ]);

        $shop_ID = $wpdb->insert_id;


        $wpdb->query("INSERT INTO {$profile_table}(
            `ID`, usertype, shop_ID
        ) VALUES (
            {$user_ID}, 'agent', {$shop_ID}
        )");
    } else{
        $wpdb->query("INSERT INTO {$profile_table}(
            `ID`, usertype
        ) VALUES (
            {$user_ID}, 'client'
        )");
    }

    http_response_code(200);
    echo json_encode(array(
        "body" => "user registered",
        "usertype" => $usertype,
    ));
    exit(0);
}


function userDoPost($data){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $body = json_decode(file_get_contents('php://input'), TRUE);
        if(isset($body["action"])){
            switch($body["action"]){
            case "validate":
                
                exit;
            case "username_exists":
                header('Content-Type: application/json');
                http_response_code(200);
                $exists = username_exists($username);
                echo json_encode(array('body' => $exists));
                exit;
            case "register";
                apiUserDoRegister($body);
                exit(0);
    
            case "login":
                $username = $body["username"];
                $password = $body["password"];
                
                $result = wp_signon(array(
                    "user_login" => $username,
                    "user_password" => $password,
                ));
    
    
                header('Content-Type: application/json');
                header("Access-Control-Allow-Origin: *");
                if(is_wp_error($result)){
                    http_response_code(401);
                    echo json_encode(array(
                        "body" => "wrong username or password"
                    ));
                    exit(0);
                } else{
                    include __DIR__ . "/custom_table_constants.php";
                    http_response_code(200);
                    echo json_encode(array(
                        "body" => "ok",
                        "usertype" => $wpdb->get_var(
                          "SELECT usertype FROM {$profile_table} WHERE `ID`={$result->ID}"
                        ),
                        "id" => $result->ID,
                        "signon_result" => $result
                    ));
                    exit(0);
                }
                exit(0);
                break;
            }
        }
        exit(0);
    }
}