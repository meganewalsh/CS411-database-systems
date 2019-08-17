<?php
$user = "datasyndicate_user";
$pass = "Yfg=Vs-(2}jn";
$database = "datasyndicate_radioapp";

$sqli = new mysqli("localhost", $user, $pass, $database);
$sqli->select_db($database) or print("Failed to select database");

$q_locations = "SELECT location_name FROM Location;";
$locs = $sqli->query($q_locations);

while ($loc = mysqli_fetch_array($locs)) {
	echo '<option value="' . $loc[0] . '">' . $loc[0] . '</option>';
}

$sqli->close();
?>