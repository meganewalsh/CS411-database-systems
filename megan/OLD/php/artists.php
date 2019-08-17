<?php

$host = "127.0.0.1";
$dbusername = "datasyndicate_user";
$dbpassword = "Yfg=Vs-(2}jn";
$dbname = "datasyndicate_radioapp";

$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

$q_artists = "SELECT artist FROM Songs ORDER BY artist;";
$arts = $conn->query($q_artists);

while ($art = mysqli_fetch_array($arts)) {
	echo '<option value="' . $art[0] . '">' . $art[0] . '</option>';

}

$conn->close();

?>