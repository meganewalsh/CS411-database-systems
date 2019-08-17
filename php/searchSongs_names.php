<?php

$selected_art = $_GET['art'];

$host = "127.0.0.1";
$dbusername = "datasyndicate_user";
$dbpassword = "Yfg=Vs-(2}jn";
$dbname = "datasyndicate_app";

$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

$q_names = "SELECT name FROM Songs WHERE artist = '$selected_art' ORDER BY name;";
$names = $conn->query($q_names);

while ($name = mysqli_fetch_array($names)) {
	echo '<option value="' . $name[0] . '">' . $name[0] . ' </option>'; 
}


$conn->close();
?>