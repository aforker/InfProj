<?php
    include_once('config.php');
    include_once('dbutils.php');
    // decode data
    $data = json_decode(file_get_contents('php://input'), true);
    // extract list associated variables
    $listid = $data['id'];
    $listname = $data['name'];
    $listofitems = $data['items'];
    
    // connect to database
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);
    //update these list variables
    $query1 = "UPDATE list SET name='$listname' WHERE id=$listid;";
    $response1 = queryDB($query1, $db);
    echo(json_encode($listid));
    //begin to loop through data in order to update items
    foreach ($listofitems as $item) {
        $itemid = $item['id'];
        
        $itemname = $item['name'];
        $listofattributes = $item['attributes'];
        //update variables associated with item
        $query2 = "UPDATE item SET name='$itemname' WHERE id=$itemid;";
        foreach ($listofattributes as $attribute){
            // extract descriptors
            $attributeid = $attribute["id"];
            $label = $attribute["label"];
            $type = $attribute["type"];
            $value = $attribute["value"];
            // queries update descriptors
            $query3 = "UPDATE attribute SET label='$label' WHERE id=$attributeid;";
            $query4 = "UPDATE attribute SET type='$type' WHERE id=$attributeid;";
            $query5 = "UPDATE attribute SET value='$value' WHERE id=$attributeid;";
            // run queries
            
            $response3 = queryDB($query3, $db);
            $response4 = queryDB($query4, $db);
            $response5 = queryDB($query5, $db);
        };
        $response2 = queryDB($query2, $db);
    };
    
    header('Content-Type: application/json');
    echo(json_encode($data));
?>