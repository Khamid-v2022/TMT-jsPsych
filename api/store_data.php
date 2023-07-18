<?php

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

    // get database connection
    include_once 'connect.php';
    include_once 'dbobject.php';

    // instantiate database and product object
    $database = new Database();
    $db = $database->getConnection();

    $db_object = new DBObject($db);

    $trial_analys = $_POST['trial_analys'];
    $trial_data = json_decode(stripslashes($_POST['trial_data']));


    $trial_id = $db_object->createTrial($trial_analys);

    if(!empty($trial_data) ){
        foreach($trial_data as $data){
            $data->trial_id = $trial_id;
            // var_dump($data);
            $db_object->createTrialData($data);
        }
    }

    $response=array();
    // set response code - 200 OK
    http_response_code(200);
    $response['status']  = true;
    $response['message'] = "";
    // show products data in json format
    echo json_encode($response);
?>