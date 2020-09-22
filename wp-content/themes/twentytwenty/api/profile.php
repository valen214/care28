<?php

function profileDoPost(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $body = json_decode(file_get_contents('php://input'), TRUE);
        if(!isset($body["type"])) return;
        switch($body["type"]){
        case "type":
            
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode(array('type' => "client"));
            exit;
        }
    }
}