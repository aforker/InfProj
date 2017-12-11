<?php
    include_once('config.php');
    include_once('dbutils.php');
    // connect to database
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);
    // Recieve composite title and attribute list data 
    $data= json_decode(file_get_contents('php://input'), true);
    // retrieve the title
    $title = $data[0]['title'];
    // before we start the loop, need session variable list id to pass in
    session_start();
    // asign list id
    $listid = $_SESSION['listid'];
    // make insert item query
    $insertitem = "INSERT INTO item(list_id, name) VALUES ('$listid', '$title');";
    // insert the item using query
    $result = queryDB($insertitem, $db);
    // get the last inserted item id
    $itemid = mysqli_insert_id($db);
    echo(json_encode('THIS IS :'));
    echo(json_encode($itemid));
    // retrieve the attribute list data with for loop
    // assign the name, type and value of attribute for each term in the list then pass them into SQL
    foreach ($data[1] as $value) {
        $attributeName = $value['name'];
        $attributeType = $value['type'];
        $attributeValue =$value['value'];
        // construct query to enter attribute values into database
        $insertattribute = "INSERT INTO attribute(item_id, label, type, value) VALUES ('$itemid', '$attributeName', '$attributeType', '$attributeValue');";
        // run this query
        $result = queryDB($insertattribute, $db);
        //echo('WHITESPACE');
                //echo(json_encode($attributeType));
        //echo('WHITESPACE');
        echo(json_encode($attributeValue));
        //echo('WHITESPACE');
    }      
    //$title = $data['title'] . 'bahahahahaha';
    ob_start();
    var_dump($data);
    $postdump = ob_get_clean();
    $response = array();
    $response['status'] = 'success';
    $response['message'] = $postdump;
    header('Content-Type: application/json');
    echo(json_encode($itemid));
    
    //$attributes= json_decode(file_get_contents('php://input'), true);
    
?>