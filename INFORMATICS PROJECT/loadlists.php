<?php
// header
    include_once('config.php')
    include_once('dbutils')
        // define data type
    $data = json_decode(file_get_contents('php://input'), true);
    
    // define attributes passed in 
    $owner = $data["username"];
    // connect to database
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);
    
    // commence
    
    // get the list of lists   
    $query = "SELECT * FROM LIST WHERE owner = '$owner'";
    
    // run query and assign to variable
    $result = queryDB($query);
    
    // assign variable into array
    //term 0
    $a = 0;
    //Empty array
    $listoflists = array();
    //Loop through the list of lists and assign one line to the variable $list at a time
    while($list = nextTuple($result)) {
        // assign the list into $listoflists
        $listoflists[$a] = $list;
        
        // extract the list id from a particular list
        $listid = $list['id'];
        
        //use listid to get associated items
        $query = "SELECT * FROM item WHERE list_id = '$listid' ORDER BY ordernumber";
        
        //run Query
        $result = queryDB($query);
        // set iterator number 
        $b = 0;
        //set array of items
        $items = array();
        //iterate through each each item in items and assign each value to $item
        while($item = nextTuple($result)) {
            // add into list of items
            $items[$b] = $item;
            
            // get itemid
            $itemid = item['id'];
            
            // get attributes for this item
            $query = "SELECT * FROM attribute WHERE item_id = $itemid ORDER BY ordernumber";
            
            //run the query
            $result_attribute = queryDB($query, $db);
            
            //set attributes list
            $attributes = array();
            
            //set iterator for attributes
            $c = 0;
            
            // loop through each attribute in attributes list
             while ($attribute = nextTuple($result_attribute)) {
                $attributes[$c] = $attribute;
                $c++;
            }
            
            // assign the list of attributes to the item
            $items[$b]['attributes'] = $attributes;
            // update iterator
            $b ++;
        }
        // add a all the items to the list
        $lists[$a]['items'] = $items;
        // update iterator
        $a++;
    }
    
    // make JSON and send back
    $response = array();
    $response['status'] = 'success';
    $response['value'] = $lists;
    header('Content-Type: application/json');
    echo(json_encode($response));
    
?>