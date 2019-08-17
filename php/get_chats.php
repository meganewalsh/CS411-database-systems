<?php
$location = $_GET['user_loc'];

$user = "datasyndicate_user";
$pass = "Yfg=Vs-(2}jn";
$database = "datasyndicate_app";

$sqli = new mysqli("localhost", $user, $pass, $database);
$sqli->select_db($database) or print("Failed to select database");

$query = "SELECT message_id, timestamp, username, message
         FROM Chat
         WHERE location_name = '$location'
         ORDER BY timestamp DESC
         LIMIT 200;";
        
                
$result = $sqli->query($query);

echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));

$sqli->close();
?>
