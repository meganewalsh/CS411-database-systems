<?php
setcookie("usern", "Tao Cheng", time()+3600);
?>
<html>
<body>
<TITLE>Regional Theme Music</TITLE>
<H3>Login Page</H3>

<?php 
	$user="datasyndicate_user";
	$pass="Yfg=Vs-(2}jn";
	$database="datasyndicate_radioapp";

	$sqli = new mysqli("localhost", $user, $pass, $database);
	$sqli->select_db($database) or print("Failed to select database");

	$test = "SELECT * FROM Location";
	$result = $sqli->query($test);

	while ($row = mysqli_fetch_array($result)) {
		echo "<h5>$row[1]</h5>";
	}

	$sqli->close();
?>

</body>
</html>

