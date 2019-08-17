<?php

$name = filter_input(INPUT_POST, 'song_name');
$artist = filter_input(INPUT_POST, 'artist_name');

$host = "127.0.0.1";
$dbusername = "datasyndicate_user";
$dbpassword = "Yfg=Vs-(2}jn";
$dbname = "datasyndicate_radioapp";

$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
if (mysqli_connect_error()){
	die('Connect Error (' . mysqli_connect_errno() . ')'
		. mysqli_connect_error());
}
else {
	$sql = "DELETE FROM Songs WHERE name = '$name' AND artist = '$artist'";
    $res = $conn->query($sql);

    //check successful delete (todo -- make sure condition is valid)
    if ($res){
        echo "Successful delete!\n";
    }
    else {
        echo "Error, affected rows :  " . $res->affected_rows;
    }
	sleep(3);
	echo '<script type="text/javascript">
           window.location = "http://datasyndicate.web.illinois.edu/index_new.html"
      </script>';    
}
$conn->close();

?>
