<?php
$location = $_GET['loc'];

$user = "datasyndicate_user";
$pass = "Yfg=Vs-(2}jn";
$database = "datasyndicate_radioapp";

$sqli = new mysqli("localhost", $user, $pass, $database);
$sqli->select_db($database) or print("Failed to select database");

$q_songs = "SELECT * FROM Songs ORDER BY RAND() LIMIT 3;";
$songs = $sqli->query($q_songs);

while ($row = mysqli_fetch_array($songs)) {
	echo
	'<tr>
	    <td>
		<button class="btn btn-secondary">+</button>
		<button class="btn btn-secondary">-</button>
	    </td>
	    <td>' . $row['points'] . '</td>
	    <td>' . $row['name'] . '</td>
	    <td>' . $row['artist'] . '</td>
	    <td><a href="' . $row['url'] . '" target="_blank">' . $row['url'] . '</a></td>
	    <td>' . $row['submitter_id'] . '</td>
	</tr>';
}

$sqli->close();
?>