<?php
    include_once('config.php');
    include_once('dbutils.php');
    // recieve data from controller
    $followed = file_get_contents('php://input');
    // connec to db
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);
    // get userid
    $query1 = "SELECT id FROM users WHERE username = '$followed';";
    // run
    $followedid = nextTuple(queryDB($query1, $db))['id'];
    // get session username
    session_start();
    $follower = $_SESSION['username'];
    // get userid
    $query2 = "SELECT id FROM users WHERE username = '$follower';";
    // run query
    $followerid = nextTuple(queryDB($query2, $db))['id'];
    // insert into follow table
    $query3 = "INSERT INTO follow (followerid, followedid) VALUES ('$followerid', '$followedid');";
    // run query
    $result = queryDB($query3, $db);
    

    // send response back
    ob_start();
    var_dump($followedid);
    $postdump = ob_get_clean();

    $response = array();
    $response['status'] = 'success';
    $response['message'] = $postdump;
    header('Content-Type: application/json');
    echo(json_encode($followerid)); 
?>