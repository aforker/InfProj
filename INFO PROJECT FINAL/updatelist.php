<?php
    include_once('config.php');
    include_once('dbutils.php');
    // decode data
    $data = json_decode(file_get_contents('php://input'), true);
    // extract list associated variables
    $listid = $data['id'];
    $listname = $data['name'];
    $listofitems = $data['items'];
    //update these list variables
    $query1 = "UPDATE list SET name='$listname', WHERE id=$listid;";
    $response1 = queryDB($query1, $db);
    
    
    
    
    header('Content-Type: application/json');
    echo(json_encode($response1));
?>