<?php
$location = $_GET['loc'];
$username = $_GET['user'];

$user = "datasyndicate_user";
$pass = "Yfg=Vs-(2}jn";
$database = "datasyndicate_app";

$sqli = new mysqli("localhost", $user, $pass, $database);
$sqli->select_db($database) or print("Failed to select database");

$q_songs = "SELECT Song_Queue.queue_id, submitter, max(rating) as rating, name, artist, url, Votes.value FROM ((Song_Queue NATURAL JOIN Songs) LEFT JOIN Votes ON Song_Queue.queue_id = Votes.queue_id) WHERE DATEDIFF(NOW(), add_time) < 7 GROUP BY url ORDER BY rating DESC LIMIT 15;";
$songs = $sqli->query($q_songs);

echo json_encode(mysqli_fetch_all($songs, MYSQLI_ASSOC));

$sqli->close();
?>
