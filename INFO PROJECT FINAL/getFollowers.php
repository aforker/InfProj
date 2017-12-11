<?php
    include_once('config.php');
    include_once('dbutils.php');

    // connec to db
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);
    // get my username and id
    session_start();
    $follower = $_SESSION['username'];
    // get userid
    $query2 = "SELECT id FROM users WHERE username= '$follower';";
    // run query
    $followerid = nextTuple(queryDB($query2, $db))['id'];
    $query3 = "SELECT followed FROM follow WHERE followerid = '$followerid';";
    
    $listoffollowing = array();
    nextTuple(queryDB($query2, $db))['id'];
    
    $response = array();
    $response['status'] = 'success';
    $response['message'] = $listoffollowing;
    header('Content-Type: application/json');
    echo(json_encode($response));
?>