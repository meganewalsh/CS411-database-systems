<?php

$queue_id = $_POST['queue_id'];

$host = "127.0.0.1";
$dbusername = "datasyndicate_user";
$dbpassword = "Yfg=Vs-(2}jn";
$dbname = "datasyndicate_app";
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

$sql = "UPDATE Song_Queue SET active = b'0' WHERE queue_id = $queue_id";
$res = $conn->query($sql);

if ($res) {
	echo "Successfully removed song $queue_id from queue";
} else {
	echo "Failed to remove song $queue_id from queue";
}

$conn->close();

?>
