<?php
    
    $isComplete = true;
    $errorMessage = ""; //catch
    session_start();
    if (!isset($_SESSION['username'])) {
        $isComplete = false;
        //error handling, log in
        $errorMessage .= " You are not logged in and cannot get a session variable. ";
    }
    
    
    if ($isComplete) {
        $data = json_decode(file_get_contents('php://input'), true);
        $attribute = $data['attribute'];
        
        if (!isset($attribute)) {
            //make sure some information is set
            $isComplete = false;
            $errorMessage .= " You need to submit a valid attribute. ";
        } else if (!isset($_SESSION[$attribute])) {
            $isComplete = false;
            $errorMessage .= " The session variable $attribute is not set. ";
        }
    }
    
    if ($isComplete) {
        // set session variable 
        $value = $_SESSION[$attribute];
        
         // send response back
        $response = array();
        $response['status'] = 'success';
        $response['value'] = $value;
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