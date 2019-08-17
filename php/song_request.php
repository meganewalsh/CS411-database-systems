<?php

$artist = $_POST['art'];
$song = $_POST['tit'];
$user = $_POST['username'];
$loc = $_POST['user_loc'];
$url = $_POST['url'];
$existing = filter_var($_POST['existing'], FILTER_VALIDATE_BOOLEAN);

$host = "127.0.0.1";
$dbusername = "datasyndicate_user";
$dbpassword = "Yfg=Vs-(2}jn";
$dbname = "datasyndicate_app";
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (!$existing) {
	echo "Creating new song entry...";
	$sql = "INSERT INTO Songs(name, artist, url) values('$song', '$artist', '$url')";
	$res = $conn->query($sql);
}

$sql = "INSERT INTO Song_Queue(active, rating, location_name, submitter, song_id) VALUES(1, 0, '$loc', '$user', (SELECT song_id FROM Songs WHERE artist = '$artist' AND name = '$song' limit 1))";
$res = $conn->query($sql);

echo "Added song to queue";

/*	echo '<script type="text/javascript">
          window.location = "https://datasyndicate.web.illinois.edu/index.html"
      </script>';
  */  

$conn->close();

?>
