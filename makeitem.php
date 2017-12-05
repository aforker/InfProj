<?php
    include_once('config.php');
    include_once('dbutils.php');

    $data = json_decode(file_get_contents('php://input'), true);
    ob_start();
    $postdump = ob_get_clean();
    var_dump($data);
    $response = array();
    $response['message'] = $postdump;
    header('Content-Type: application/json');
    echo(json_encode($response));

?>