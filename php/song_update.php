<?php


$selected_artist = $_POST['update_artist'];
$selected_song = $_POST['update_name'];
$URL = filter_input(INPUT_POST, 'update_url');

$host = "127.0.0.1";
$dbusername = "datasyndicate_user";
$dbpassword = "Yfg=Vs-(2}jn";
$dbname = "datasyndicate_app";

$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
if (mysqli_connect_error()){
	die('Connect Error (' . mysqli_connect_errno() . ')'
		. mysqli_connect_error());
}
else {
	$sql = "UPDATE Songs SET url = '$URL' WHERE name = '$selected_song' AND artist = '$selected_artist';";
    $res = $conn->query($sql);

    echo '<script type="text/javascript">
           window.location = "https://datasyndicate.web.illinois.edu/index.html"
      </script>';
    
}
$conn->close();

?>
