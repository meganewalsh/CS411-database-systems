<?php

if(!empty($_POST['latitude']) && !empty($_POST['longitude'])){
	$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($_POST['latitude']).','.trim($_POST['longitude']).'&sensor=false';
	$json = @file_get_contents($url);
	$data = json_decode($json);
	$status = $data->status;

	if($status == "OK"){
		$location = $data->results[0]->formatted_address;
	}
	else {
		$location = 'Location find failed';
	}

	echo $location;
}

$name = filter_input(INPUT_POST, 'song_name');
$artist = filter_input(INPUT_POST, 'artist_name');
$URL = filter_input(INPUT_POST, 'add_url');

$host = "127.0.0.1";
$dbusername = "datasyndicate_user";
$dbpassword = "Yfg=Vs-(2}jn";
$dbname = "datasyndicate_app";

$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

$sql = "INSERT INTO Songs(name, artist, url) values('$name', '$artist', '$URL')";
$sql2 = "INSERT INTO Song_Queue(rating, location_name, submitter, song_id) values(1, 'Siebel Center', 'meganew2', (SELECT song_id FROM Songs WHERE artist = '$artist' AND name = '$name'))";

$res = $conn->query($sql);
$res2 = $conn->query($sql2);


echo '<script type="text/javascript">
           window.location = "https://datasyndicate.web.illinois.edu/index.html"
      		</script>';

$conn->close();

?>
