
<?php

//log in to database

include_once('config.php');
include_once('dbutils.php');
    
    // get data from form
    $data = json_decode(file_get_contents('php://input'), true);

$query = "SELECT * FROM friends WHERE (user_id = '$_SESSION[user_id]' AND follow_id = '$profile_id') OR
(follow_id = '$_SESSION[user_id]' AND user_id = '$profile_id')";

$result = mysql_query($query,$cnx);
$row = mysql_num_rows($result);

if ($row == 1) { // means the relationship exists, whether it's active or not
   while($row = mysql_fetch_assoc($result)) {
      if ($row['active'] == 1) {
      echo "You are already following this user.";
      }
   }
} else { // if the relationship don't exist
echo "<a href='followfriend.php?follow_id=".$profile_id."'Follow this user</a>'";
}

?>
