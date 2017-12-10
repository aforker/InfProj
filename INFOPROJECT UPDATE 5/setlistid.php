<?php
    // import tools
    include_once('config.php');
    include_once('dbutils.php');
    
    // get data from controller.passListId
    $data = json_decode(file_get_contents('php://input'), true);
    $listid = $data;
    // variable to keep track if the form is complete (set to false if there are any issues with data)
    $isComplete = true;
    // start session
    session_start();
    // check if user is logged in
    if (!isset($_SESSION['username'])) {
        $isComplete = false;
        $errorMessage .= " You may not add a player if you are not logged in. ";
    }
    
    if($isComplete) {
        $_SESSION['listid'] = $listid;
    }
    
    $newusername =  $_SESSION['username'];
    $newlistid = $_SESSION['listid'];
    
    if(!isset($newlistid)){
        $errormessage = 'list id not set';
        ob_start();
        var_dump($data);
        $postdump = ob_get_clean();
    
        $response = array();
        $response['status'] = 'error';
        $response['message'] = $errormessage . $newlistid;
        header('Content-Type: application/json');
        echo(json_encode($response));
    } else {
        $errormessage = 'List id successfully set';
        ob_start();
        var_dump($data);
        $postdump = ob_get_clean();
    
        $response = array();
        $response['status'] = 'success';
        $response['message'] = $errormessage . $newusername;
        header('Content-Type: application/json');
        echo(json_encode($response));
    }
?>