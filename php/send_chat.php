<?php

$user = $_POST['username'];
$timestamp = $_POST['timestamp'];
$loc = $_POST['user_loc'];
$message = $_POST['message'];

$host = "127.0.0.1";
$dbusername = "datasyndicate_user";
$dbpassword = "Yfg=Vs-(2}jn";
$dbname = "datasyndicate_app";
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

echo "Sending chat";
$sql = "INSERT INTO Chat(username, timestamp, location_name, message) values('$user', '$timestamp', '$loc', '$message')";
$res = $conn->query($sql);

echo "Sent Chat";
$conn->close();

?>
