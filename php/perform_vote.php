<?php

$username = $_POST['username'];
$queue_id = $_POST['queue_id'];
$vote_value = $_POST['value'];

$host = "127.0.0.1";
$dbusername = "datasyndicate_user";
$dbpassword = "Yfg=Vs-(2}jn";
$dbname = "datasyndicate_app";
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

$sql = "SELECT * FROM Votes WHERE queue_id = $queue_id AND username = '$username';";
$res = $conn->query($sql);

$rating_delta = 0;
$true_vote_value = ($vote_value * 2) - 1;

if ($res->num_rows == 0) {
	$sql = "INSERT INTO Votes(queue_id, song_id, username, value) VALUES($queue_id, 0, '$username', $vote_value);";
	$res = $conn->query($sql);
	echo "Changed";

	$rating_delta = (int) $true_vote_value;
}
else {
	$orig_value = $res->fetch_array()['value'];
	if ($orig_value == $vote_value) {
		echo "Unchanged";
		return;
	}

	$sql = "UPDATE Votes SET value = $vote_value WHERE queue_id = $queue_id AND username = '$username';";
	$res = $conn->query($sql);
	echo "Changed";

	$true_orig_value = ($orig_value * 2) - 1;
	$rating_delta = (int) $true_vote_value - $true_orig_value;
}



if ($rating_delta != 0) {
	$sql = "UPDATE Song_Queue SET rating = rating + ($rating_delta) WHERE queue_id = $queue_id;";
	$res = $conn->query($sql);
}

$conn->close();

?>
