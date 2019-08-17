<?php

$timerpath = "/home/datasyndicate/public_html/php/MINUTES.txt";

$data = file_get_contents($timerpath) or die("Unable to read from timer file");

$elapsed = ((int)$data + 1) % 5;
file_put_contents($timerpath, "$elapsed\n") or die("Unable to write to timer file");

if ($elapsed !== 0) {
	echo "Only $elapsed minutes elapsed\n";
	return;
}

$user = "datasyndicate_user";
$pass = "Yfg=Vs-(2}jn";
$database = "datasyndicate_app";

$sqli = new mysqli("localhost", $user, $pass, $database);
$sqli->select_db($database) or die("Failed to select database");

// TODO set curr_song bit to 0 for all curr songs
$q_curr_songs = "UPDATE Song_Queue SET curr_song = b'0' WHERE curr_song = b'1';";
$res = $sqli->query($q_curr_songs);

$q_locs = "SELECT location_name FROM Location;";
$locations = $sqli->query($q_locs);
while ($row = $locations->fetch_array()) {
	$loc = $row['location_name'];
	$q_next_song = "SELECT queue_id FROM Song_Queue WHERE location_name = '$loc'" .
					" AND active = b'1' ORDER BY rating DESC, queue_id ASC LIMIT 1;";
	$res = $sqli->query($q_next_song);

	$tmp = $res->fetch_array();
	if ($tmp) {
		$id = $tmp['queue_id'];
		echo "$loc has $id up next\n";
		$q_update = "UPDATE Song_Queue SET curr_song = b'1', active = b'0' WHERE queue_id = $id;";
		$sqli->query($q_update);
	} else {
		echo "No queued songs for $loc\n";
	}
	// TODO set curr_song to 1, active to 0
}

$sqli->close();
?>
