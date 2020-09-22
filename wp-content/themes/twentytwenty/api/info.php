<?php

use \Firebase\JWT\JWT;

/*



let _token = await fetch(document.location.origin +
    "/wp-json/jwt-auth/v1/token", {
  method: "POST",
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({
    username: "test_user",
    password: "literal_pass",
  })
}).then(res => res.json()).then(res => res.token);

fetch("https://goliathhorkos.com/wp-json/api/v1/info", {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        "type": "query_user",
        "token": token || _token,
        "fields": [
          "user_nicename",
          "display_name",
          "abc",
        ],
    })
}).then(res => res.text()).then(res => {
    console.log(res);
})




request
{
  "type": "query_user",
  "token": "asdf",
  "fields": [
    "shop_description",
    "shop_name",
    "abc",
  ],
}
response
{
  "body": {
    "fields: {
      "shop_description": "asdf",
      "shop_name": "asdf",
      "abc": null,
    }
  }
}
request
{
  "type": "edit_user",
  "token": "asdf",
  "fields": {
    "shop_description": "ASFASFASFA",
    "shop_name": "ASDASD",
    "abc": "ASFASF",
  }
}
response
{
  "body": "ok"
}



request
{
  type: query_product
  token: asfdasfd
  products: {
    "123": {
      fields: [
        name
        description
      ]
    },
    "51342": {
      fields: [ description ]
    }
  }
}
response
{
  "body": {
    "products": {
      "123": {
        fields: {
          name: "asdf"
        }
      },
      "51342": {
        fields: {
          description: "asdf"
        }
      }
    }
  }

}

request
{
  "type": "edit_product",
  "token": "asdf",
  "id": 123,
  "fields": {
    "description": "ASFASFASFA",
    "name": "ASDASD",
    "abc": "ASFASF",
  }
}
response
{
  "body": "ok"
}


request
{
  "type": "add_product",
  "token": "asdf",
  "fields": {
    "description": "ASFASFASFA",
    "name": "ASDASD",
    "abc": "ASFASF",
  }
}
response
{
  "body": "ok"
}



*/
/*
HTTP/1.1 200 OK
Content-Type: application/json

{
  "body": {
    "shop_description": "asdfasdf",
    "shop_name": "asdfasd",
  },
  "ok": "cannot find field 'abc'"
}


*/

function getUsertype($user_ID){
  include __DIR__ . "/custom_table_constants.php";
  $query = $wpdb->prepare(
          "SELECT usertype
          FROM {$profile_table}
          WHERE ID=%d", $user_ID);
  return $wpdb->get_var($query);
}

function getShopID($user_ID){
  include __DIR__ . "/custom_table_constants.php";
  $query = $wpdb->prepare(
          "SELECT shop_ID
          FROM {$profile_table}
          WHERE ID=%d", $user_ID);
  return $wpdb->get_var($query);
}

function getOwnerID($shop_ID){
  include __DIR__ . "/custom_table_constants.php";
  return $wpdb->get_var(
          "SELECT owner_ID
          FROM {$shops_table}
          WHERE ID={$shop_ID}");
}


function verifyAgentAndReturnShopID($user_ID){
  include __DIR__ . "/custom_table_constants.php";

  $query = $wpdb->prepare(
          "SELECT shop_ID, usertype
          FROM {$profile_table}
          WHERE ID=%d", $user_ID);
  $query_result = $wpdb->get_results($query);

  if(count($query_result) !== 1){
      http_response_code(400);
      
      echo json_encode(array(
          "out" => "shop query result not equals to 1",
      ));
      exit;
  }

  $query_result = $query_result[0];
  if($query_result->usertype !== "agent"){
      http_response_code(400);
      echo '{"out":"user is not an agent"}';
      exit;
  }

  /**
   * TODO: if shop not exists
   */
  $shop_ID = $query_result->shop_ID;
  $owner_ID = $wpdb->get_var(
          "SELECT owner_ID
          FROM {$shops_table}
          WHERE ID={$shop_ID}");
  if($owner_ID !== $user_ID){
      http_response_code(400);
      echo '{"out":"shop (' . $shop_ID .
              ') owner ID ' . $owner_ID .
              ' not equals to user ID' . $user_ID . '"}';
      exit;
  }

  return $shop_ID;
}


function queryTable(
  $table_name,
  $columns,
  $condition,
  $columns_constrain = NULL
){
  include __DIR__ . "/custom_table_constants.php";

  if($columns_constrain){
    $columns = array_intersect($columns, $columns_constrain);
  }

  $columns = array_map(function($value){
    return "`{$value}`";
  }, $columns);
  $columns = implode(", ", $columns);

  if($columns){
    $query_result = $wpdb->get_results($wpdb->prepare(
      "SELECT {$columns} FROM {$table_name}" .
      ($condition ? " WHERE {$condition}" : '')
    ), ARRAY_A);
  }

  return empty($query_result) ? array() : $query_result;
}
function editTable(
  $table_name,
  $fields,
  $condition,
  $fields_constrain = NULL
){
  global $wpdb;

  $query_string = "";
  foreach($fields_constrain as $field_name){
    if($fields[$field_name]){
      $query_string .= " `{$field_name}`='{$fields[$field_name]}' ";
    }
  }

  if($query_string){
    $query_result = $wpdb->query(
      "UPDATE {$table_name} SET {$query_string} " .
      (empty($condition) ? "" : " WHERE {$condition} ")
    );
  }

  return $query_result;
}

function infoDoPost(){
  include __DIR__ . "/custom_table_constants.php";

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $body = json_decode(file_get_contents('php://input'), TRUE);
    if(!isset($body["type"])) return;
    $token = $body["token"];
    try{
      $out = JWT::decode($token, JWT_AUTH_SECRET_KEY, ['HS256']);
    } catch(Exception $e){
      header('HTTP/1.0 401 Unauthorized');
      exit;
    }

    $user_ID = $out->data->user->id;


    // $JWT_AUTH_PLUGIN_INSTANCE.
    switch($body["type"]){
    case "query_user":
        $fields = $body["fields"];

        
        $QUERY_USERS_TYPE = [
          // from wp_users
          "user_nicename",
          "display_name",
        ];
        $QUERY_USER_PROFILE_TYPE = [
          // from wp_userprofile
          "usertype",
          "verified",
          "email_verified",
          "license_verified",
          "rating",
          "phone",
          "shop_ID",
        ];
        $OTHERS = [
          "avatar", // base64 format without prefix
          "license", // token is required
        ];

        $query_user_result = queryTable(
          $users_table,
          $body["fields"],
          $wpdb->prepare("`ID`=%d", $body["id"] ?? $user_ID),
          $QUERY_USERS_TYPE
        )[0] ?? array();
        $query_user_profile_result = queryTable(
          $profile_table,
          $body["fields"],
          $wpdb->prepare("`ID`=%d", $body["id"] ?? $user_ID),
          $QUERY_USER_PROFILE_TYPE
        )[0] ?? array();

        header('Content-Type: application/json');
        echo json_encode(array_merge(
            $query_user_result,
            $query_user_profile_result
        ));

        exit;
    case "edit_user":

      $result = editTable(
        $users_table,
        $body["fields"],
        $wpdb->prepare(" WHERE `ID`=%d ", $body["id"] ?? $user_ID),
        [
          // from wp_users
          "user_nicename",
          "display_name",
  
          // from wp_userprofile
          "phone",
        ]
      );

      $body["fields"]["avatar"];
      

      $body["fields"]["license"];

      header('Content-Type: application/json');
      echo '{"body": "ok","result":"' . $result . '"}';
      exit;
    case "query_shop":
      
      if(empty($body["id"])){
        $shop_ID = verifyAgentAndReturnShopID($user_ID);
      } else{
        $shop_ID = $body["id"];
      }

      $query_shops_result = queryTable(
        $shops_table,
        $body["fields"],
        $wpdb->prepare(" `ID`=%d ", $shop_ID),
        [
          // from table wp_shops
          "owner_ID",
          "description",
          "name",
        ]
      )[0] ?? array();

      if(!empty($body["products"])){

        $query_products_result = queryTable(
          $shop_products_table,
          array_unique(array_merge($body["products"], ["ID"])),
          $wpdb->prepare(" `shop_ID`=%d ", $shop_ID),
          [
            // from table wp_shop_products
            "ID",
            "name",
            "shop_ID",
            "description"
          ]
        );

        if(empty($query_products_result)){
          $query_shops_result["products"] = [];
        } else{
          $products_array = [];
          foreach($query_products_result as $product_entry){
            $products_array[$product_entry["ID"]] = $product_entry;
          }
          $query_shops_result["products"] = $products_array;
        }
      }

      header('Content-Type: application/json');
      echo json_encode($query_shops_result);

      exit;
    case "edit_shop":

      if(empty($body["id"])){
        $shop_ID = verifyAgentAndReturnShopID($user_ID);
      } else{
        $shop_ID = $body["id"];
      }

      $result = editTable(
        $shops_table,
        $body["fields"],
        $wpdb->prepare(" WHERE `ID`=%d ", $shop_ID),
        [
          // from table wp_shops
          "description",
          "name",
        ]
      );

      header('Content-Type: application/json');
      echo '{"body": "ok","result":"' . $result . '"}';

      exit;
    case "add_product":
      $shop_ID = verifyAgentAndReturnShopID($user_ID);

      $result = $wpdb->query($wpdb->prepare(
        "INSERT INTO {$shop_products_table}(
          shop_ID,
          `name`,
          `description`
        ) VALUES(
          {$shop_ID},
          %s,
          %s
        )",
        $body["fields"]["name"],
        $body["fields"]["description"]
      ));

      header('Content-Type: application/json');
      echo '{"body": "ok","result":"' . $result . '"}';

      exit;
    case "query_product":
      if(is_array($body["id"])){
        $product_IDs = $body["id"];
      } else{
        $product_IDs = [$body["id"]];
      }

      if(empty($product_IDs)){

        http_response_code(400);
        header('Content-Type: application/json');
        echo '{"body": "Bad Request: no id is presented in query_product, ' .
              'maybe check spelling, it is lower-case. "}';
        exit;
      }

      $condition = "`ID` IN(" .
          implode(', ', array_fill(0, count($product_IDs), '%s')) .
          ")";

      $condition = call_user_func_array(array($wpdb, 'prepare'),
          array_merge(array($condition), $product_IDs));


      $query_products_result = queryTable(
        $shop_products_table,
        array_unique(array_merge($body["fields"], ["ID"])),
        $condition,
        [
          // from table wp_shop_products
          "ID",
          "shop_ID",
          "name",
          "description"
        ]
      );

      $response_body = [];
      if(empty($query_products_result)){
        $response_body["products"] = [];
      } else{
        $products_array = [];
        foreach($query_products_result as $product_entry){
          $products_array[$product_entry["ID"]] = $product_entry;
        }
        $response_body["products"] = $products_array;
      }

      
      header('Content-Type: application/json');
      echo json_encode([
        "body" => $response_body
      ]);

      exit;
    case "edit_product":
      $shop_ID = verifyAgentAndReturnShopID($user_ID);
      $product_ID = $body["id"];

      $product_shop_ID = $wpdb->get_var($wpdb->prepare(
        "SELECT shop_ID FROM {$shop_products_table} WHERE `ID`=%d",
        $product_ID
      ));

      if($product_shop_ID !== $shop_ID){
        header('Content-Type: application/json');
        echo json_encode([
          "ok" => false,
          "body" => "product requested to edit '{$product_ID}' ".
              "probably does not belong to current user/shop"
        ]);
        exit;
      }

      $result = editTable(
        $shop_products_table,
        $body["fields"],
        $wpdb->prepare(" WHERE `ID`=%d ", $product_ID),
        [
          // from table $shop_products_table
          "description",
          "name",
        ]
      );
      header('Content-Type: application/json');
      echo '{"body": "ok","result":"' . $result . '"}';

      exit;
    }
  }
}