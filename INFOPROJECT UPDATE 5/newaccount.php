<?php
    include_once('config.php');
    include_once('dbutils.php');
    
    // define data type
    $data = json_decode(file_get_contents('php://input'), true);


    // define attributes passed in 
    $username = $data["username"];
    $password = $data["password"];
    $password2 = $data["password2"];

    // connect to database
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);
    
    // check for required fields
    $isComplete = true;
    $errorMessage = "";
    
    if (!isset($username)) {
        // concat error message
        $errorMessage .= "Please enter a username";

        $isComplete = false;
    } else {
        $username = makeStringSafe($db, $username);
    }
    
    if(!isset($password)) {
        $errorMessage .= "Please enter a password. ";
        $isComplete = false;
    }
    
    if(!isset($password2)) {
        $errorMessage .= "please enter a password again.";
        $isComplete = false;
    }
    
    if($password != $password2) {
        $errorMessage .= " passwords do not match. please re-enter your password.";
		$isComplete = false;
    }
    
	
    // if entered correctly: 
    if ($isComplete) {
    
		// check for same usernames
		$query = "SELECT * FROM users WHERE username='$username';";
		$result = queryDB($query, $db);
		if (nTuples($result) > 0) {
            // we have a duplicate
            $errorMessage .= " Username $username already exists. Please enter another username. ";
			$isComplete = false;
        }
    }
    
    if ($isComplete) {
        // generate the hashed version of the password
        $pass = crypt($password, getSalt());
        
        // put together sql code to insert tuple or record
        $insert = "INSERT INTO users(username, pass) VALUES ('$username', '$pass');";
		
        // run the insert statement
        $result = queryDB($insert, $db);
        
        // we have successfully inserted the record
        // send response back
        $response = array();
        $response['status'] = 'success';
        header('Content-Type: application/json');
        echo(json_encode($response));
	} else {
        // if there was an error along the way
        $response = array();
        $response['status'] = 'error';
        $response['message'] = $errorMessage;
        header('Content-Type: application/json');
        echo(json_encode($response));   
	}    

?>