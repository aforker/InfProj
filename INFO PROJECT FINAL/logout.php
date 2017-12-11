<?php
    //  remember session is a built in variable
    session_start();
    if (isset($_SESSION['username'])) {
        unset($_SESSION['username']);
    }
    session_destroy();
    
    // send response back
    $response = array();
    $response['status'] = 'success';
    $response['message'] = $_SESSION['username'];
    header('Content-Type: application/json');
    echo(json_encode($response));    
?>