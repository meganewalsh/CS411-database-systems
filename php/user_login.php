<?php
$username = $_POST['username'];
$password = $_POST['password'];

$db_user = "datasyndicate_user";
$db_pass = "Yfg=Vs-(2}jn";
$database = "datasyndicate_app";

$sqli = new mysqli("localhost", $db_user, $db_pass, $database);
$sqli->select_db($database) or die("Failed to select database");

$q_user = "SELECT * FROM User WHERE username = \"$username\";";
$result = $sqli->query($q_user);

// User doesn't exist, TODO hardcoded location
if ($result->num_rows == 0) {
	$q_insert = "INSERT INTO User(username, password, location_name) VALUES" . 
			" (\"$username\", \"$password\", \"ECEB\");";
	if (!$sqli->query($q_insert)) {
		die("Insert failed");
	}

	echo "Registered";
} else {
	// User exists, compare passwords
	$row = mysqli_fetch_array($result);
	if ($row["password"] === $password) {
		echo "Success";
	} else {
		echo "Failed";
	}
}

$sqli->close();
?>
