<?php
    include_once('config.php');
    include_once('dbutils.php');
    
    // get data from form

    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['title'];

    // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);
    // insert into database
    $query = "INSERT INTO list(name) VALUES ('$name');";
    // run query
    $result = queryDB($query, $db);
    // get insert id
    $listid = mysqli_insert_id($db);
    
    $response['message'] = $listid;
    header('Content-Type: application/json');
    echo(json_encode($response));

?>