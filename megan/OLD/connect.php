<?php

$Location = filter_input(INPUT_POST, 'location_name');

$host = "127.0.0.1";
$dbusername = "datasyndicate_user";
$dbpassword = "Yfg=Vs-(2}jn";
$dbname = "datasyndicate_radioapp";

$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
if (mysqli_connect_error()){
	die('Connect Error (' . mysqli_connect_errno() . ')'
		. mysqli_connect_error());
}
else {
	$sql = "SELECT *
		FROM Location
		WHERE location_name != '" . $Location . "'";

	$res = $conn->query($sql);
	$res->data_seek(0);
	while ($row = $res->fetch_assoc()) {
    		echo " location = " . $row['location_name'] . "\n";
	}
}
$conn->close();

?>

