<?php
    // import tools
    include_once('config.php');
    include_once('dbutils.php');
    
    // get data from controller.passListId
    $data = json_decode(file_get_contents('php://input'), true);
    $listid = $data;
    
    // connect to db
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);
    
    // make query to get item id associated with list
    $query = "SELECT id FROM item WHERE list_id = '$listid';";
    
    // recieve results 
    $listofitems = queryDB($query, $db);
    // cycle through results to get associated attributes and delete them
    foreach ($listofitems as $item) {
        // Assign the id into a variable
        $itemid = $item['id'];
        echo(json_encode($value['id']));
        // make query to get attribute id
        $query1 = "SELECT id FROM attribute WHERE item_id ='$itemid';";
        // run query
        $listofattributes = queryDB($query1, $db);
        // cycle through results to get delete associated attributes
        foreach($listofattributes as $attribute) {
            // assign the id into a variable
            $attributeid = $attribute['id'];
            // build query to delete by id
            $query2 = "DELETE FROM attribute WHERE id = '$attributeid';";
            $result = queryDB($query2, $db);
        }
        // make a query to delete the items associated
        $query3 = "DELETE FROM item WHERE id = '$itemid';";
        $result = queryDB($query3, $db);
    }
    // make a query to delete the list
    $query4 = "DELETE FROM list WHERE id = '$listid';";
    $result = queryDB($query4, $db);
    $response = array();
    $response['status'] = 'success';
    $response['message'] = $listofitems;
    header('Content-Type: application/json');
    echo(json_encode($response));       
?>