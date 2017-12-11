<?php
    include_once('config.php');
    include_once('dbutils.php');
    // start session
    session_start();
    $username = $_SESSION['username'];
    // connect to database
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);
    // make query
    $query = "SELECT id FROM users WHERE username = '$username';";
    // run query
    $result1 = queryDB($query, $db);
    $result = nextTuple($result1)['id'];
    // send back result
    $response = array();
    $response['status'] = 'success';
    $response['message'] = $result;
    header('Content-Type: application/json');
    echo(json_encode($response));     
?>