<?php

    $isComplete = true;
    $errorMessage = "";

    session_start();
    if (!isset($_SESSION['username'])) {
        // if not logged in
        
        $isComplete = false;
        $errorMessage .= " You are not logged in and cannot set a session variable. ";
    }
    
    if ($isComplete) {
        // logged in
        
        // passing in json object
        $data = json_decode(file_get_contents('php://input'), true);
        $attribute = $data['attribute'];
        $value = $data['value'];
        
        if (!isset($attribute) || $attribute == 'username') {
            $isComplete = false;
            $errorMessage .= " invalid attribute. ";
        }
        
        if (!isset($value)) {
            $isComplete = false;
            $errorMessage .= " invalid value. ";
        }
    }
    
    if ($isComplete) {
        $_SESSION[$attribute] = $value;
        
         // send response back
        $response = array();
        $response['status'] = 'success';
        header('Content-Type: application/json');
        echo(json_encode($response));
    } else {
        // send response for error
        $response = array();
        $response['status'] = 'error';
        $response['message'] = $errorMessage;
        header('Content-Type: application/json');
        echo(json_encode($response));   
    }
?>