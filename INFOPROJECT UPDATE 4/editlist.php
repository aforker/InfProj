<?php
// header
    include_once('config.php');
    include_once('dbutils.php');
    // define data type
    //$data = json_decode(file_get_contents('php://input'), true);
    $listname = "'Soccer players'";//$data['listname'];
    //$owner = $data['owner']
    // get list id
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);
    $query = "SELECT id FROM list WHERE name = $listname;";
    $result = queryDB($query,$db);
    $listid = nextTuple($result)['id'];
    
    // add item to list
    echo $listid;  

?>