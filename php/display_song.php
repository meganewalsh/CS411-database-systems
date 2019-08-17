<?php
$location = $_GET['user_loc'];

$user = "datasyndicate_user";
$pass = "Yfg=Vs-(2}jn";
$database = "datasyndicate_app";

$sqli = new mysqli("localhost", $user, $pass, $database);
$sqli->select_db($database) or print("Failed to select database");

/*$q_id = "SELECT artist, name, url, rating, submitter
         FROM Songs NATURAL JOIN Song_Queue
         WHERE queue_id = (SELECT queue_id
                          FROM Song_Queue
                          WHERE location_name = '$location' AND active = b'1' AND rating = (SELECT MAX(rating)
                                                                                                FROM Song_Queue
                                                                                                WHERE location_name = '$location' AND active = b'1') limit 1) limit 1;";
*/
$q_id = "SELECT artist, name, url, rating, submitter FROM Songs NATURAL JOIN Song_Queue WHERE curr_song = b'1' AND location_name = '$location';";
                
$display = $sqli->query($q_id);

echo json_encode(mysqli_fetch_all($display, MYSQLI_ASSOC));

$sqli->close();
?>
