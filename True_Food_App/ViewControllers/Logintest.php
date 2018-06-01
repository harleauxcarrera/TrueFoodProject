<?php

//importing required script
require_once '../Database/DB_Manager.php';
 
$response = array();
 
        //getting values
        $password = "89ismine";
        $email = "erickduarte521@gmail.com";
 
        //creating db operation object
        $db = new DB_Manager();
 
        //checking if user to database  
        $value = $db->userPresent($email, $password);
        $response['error'] = true;
        $response['message'] = $value;
        
 

echo json_encode($response);