<?php

//log in to database

include_once('config.php');
include_once('dbutils.php');
    
    // get data from form
    $data = json_decode(file_get_contents('php://input'), true);

$profile_id = $_GET['follow_id'];
$query="SELECT * FROM friends WHERE (user_id = '$_SESSION[user_id]' AND follow_id = '$profile_id') OR
(follow_id = '$_SESSION[user_id]' AND user_id = '$profile_id')";

$result = mysql_query($query,$cnx);
$row = mysql_num_rows($result);
if ($row == 1) { // check again for the existence of the relationship
   while($row = mysql_fetch_assoc($result)) {
      if ($row['active'] == 1) {
      echo "You are already following this user.";
      } 
   }
   
   // the relationship don't exist, so create it
} else { 
   $insert_query = "INSERT INTO friends ('user_id', 'follow_id', 'friend') VALUES ('$_SESSION[user_id]', '$profile_id', '1')";
   $insert_result = mysql_query($insert_query,$cnx);
   if (!$insert_result) {
      // error here
   } else {
      echo "You are now following this user!";
   }
}

?>
