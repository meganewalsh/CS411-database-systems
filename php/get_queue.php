<?php
$location = $_GET['loc'];
$username = $_GET['user'];

$user = "datasyndicate_user";
$pass = "Yfg=Vs-(2}jn";
$database = "datasyndicate_app";

$sqli = new mysqli("localhost", $user, $pass, $database);
$sqli->select_db($database) or print("Failed to select database");

// All active queued songs for the user's location
//$q_songs = "SELECT queue_id, submitter, rating, name, artist, url FROM Song_Queue NATURAL JOIN Songs WHERE location_name = \"$location\" AND active = b'1' ORDER BY rating DESC;";

$q_songs = "SELECT Song_Queue.queue_id, submitter, rating, name, artist, url, Votes.value FROM ((Song_Queue NATURAL JOIN Songs) LEFT JOIN Votes ON Song_Queue.queue_id = Votes.queue_id AND Votes.username = '$username') WHERE location_name = '$location' AND active = b'1' ORDER BY rating DESC, Song_Queue.queue_id ASC;";
$songs = $sqli->query($q_songs);

echo json_encode(mysqli_fetch_all($songs, MYSQLI_ASSOC));

$sqli->close();
?>
