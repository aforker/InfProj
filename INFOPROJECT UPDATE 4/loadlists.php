<?php
// header
    include_once('config.php');
    include_once('dbutils.php');
        // define data type
    //$data = json_decode(file_get_contents('php://input'), true);
    
    // define attributes passed in 
    //$owner = $data["username"];
    // connect to database
        
    
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);
    $query = "SELECT * FROM list;";
    $result = queryDB($query,$db);
    $listoflists = array();
    $a = 0;
    while($list = nextTuple($result)) {
        $listoflists[$a] = $list;
        // extract the list id from a particular list
        $listid = $listoflists[$a]['id'];
        
        //use listid to get associated items
        $query = "SELECT * FROM item WHERE list_id = '$listid' ORDER BY ordernumber";
        //run Query
        $itemresult = queryDB($query,$db);
        // set iterator number 
        $b = 0;
        //set array of items
        $items = array();
        while($item = nextTuple($itemresult)) {
            // add into list of items
            $items[$b] = $item;
            // get itemid
            $itemid = $item['id'];
            // now get the attributes for this item
            $query = "SELECT * FROM attribute WHERE item_id = $itemid ORDER BY ordernumber;";
            $result_attribute = queryDB($query, $db);
            $attributes = array();
            $c = 0;
            while ($attribute = nextTuple($result_attribute)) {
                $attributes[$c] = $attribute;
                $c++;
            }
            $items[$b]['attributes'] = $attributes;
            $b++;
        }
        $listoflists[$a]['items'] = $items;       
        $a++;
    }
    // put together JSON object to send back
    // send response back
    $response = array();
    $response['status'] = 'success';
    $response['value'] = $listoflists;
    header('Content-Type: application/json');
    echo(json_encode($response));
?>