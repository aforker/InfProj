<?php
    include_once('config.php');
    include_once('dbutils.php');
    
    // get data from form

    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['title'];

    // start session to get owner username
    session_start();
    $username = $_SESSION['username'];
    
    // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);
    // write a query to extract id
    $getuserid = "SELECT id FROM users WHERE username = '$username';";

    $answer= queryDB($getuserid, $db);
    // extract result
    $ownerid = nextTuple($answer)['id'];
    // insert into database
    $query = "INSERT INTO list(name, owner) VALUES ('$name','$ownerid');";
    // run query
    $result = queryDB($query, $db);
    // get insert id
    $listid = mysqli_insert_id($db);
    
    $response['message'] = $query;
    header('Content-Type: application/json');
    echo(json_encode($response));

?>