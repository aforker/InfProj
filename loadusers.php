<?php
    include_once('config.php');
    include_once('dbutils.php');
    // connect to database
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);
    // build query to get usernames
    $query = "SELECT username FROM users;";
    // run query
    $result = queryDB($query,$db);
    $listofusers = array();
    while ($user = nextTuple($result)) {
        $listofusers[] = $user;
    }
    // put together JSON object to send back
    $response = array();
    $response['status'] = 'success';
    $response['value'] = $listofusers;
    header('Content-Type: application/json');
    echo(json_encode($response));
?>