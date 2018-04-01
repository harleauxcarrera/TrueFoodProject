<?php

//importing required script
require_once '../Database/DB_Manager.php';
 
$response = array();
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!verifyRequiredParams(array('password', 'email' ))) {
        //getting values
        $password = $_POST['password'];
        $email = $_POST['email'];
 
        //creating db operation object
        $db = new DB_Manager();
 
        //checking if user to database  
        if(!$db->userPresent($email, $password)){
            $response['error'] = true;
            $response['message'] = 'User does not exist';
        }else{
            $response['error'] = false;
            $response['message'] = 'User exists';
        }
        
    } else {
        $response['error'] = true;
        $response['message'] = 'Required parameters are missing';
    }
} else {
    $response['error'] = true;
    $response['message'] = 'Invalid request';
}
 
//function to validate the required parameter in request
function verifyRequiredParams($required_fields)
{
 
    //Getting the request parameters
    $request_params = $_REQUEST;
 
    //Looping through all the parameters
    foreach ($required_fields as $field) {
        //if any requred parameter is missing
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
 
            //returning true;
            return true;
        }
    }
    return false;
}
 
echo json_encode($response);