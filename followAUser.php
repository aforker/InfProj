<?php
    include_once('config.php');
    include_once('dbutils.php');
    // recieve data from controller
    $data = json_decode(file_get_contents('php://input'), true);
    // send response back
    echo('FOLLOWED');
    
?>