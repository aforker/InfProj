<?php

    $isloggedin = false;
    $username = "not logged in";
    //credential check
    session_start();
    if (isset($_SESSION['username'])) {
        $isloggedin = true;
        $username = isset($_SESSION['username']);
    }
    // send response back
    $response = array();
    $response['status'] = 'success';
    $response['loggedin'] = $isloggedin;
    $response['username'] = $username;
    header('Content-Type: application/json');
    echo(json_encode($response));
    
?>