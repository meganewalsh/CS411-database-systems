<?php
$user = "datasyndicate_user";
$pass = "Yfg=Vs-(2}jn";
$database = "datasyndicate_app";

$sqli = new mysqli("localhost", $user, $pass, $database);
$sqli->select_db($database) or print("Failed to select database");

$q_locations = "SELECT location_name, latitude, longitude FROM Location;";
$locs = $sqli->query($q_locations);

$user_lat = (float) $_GET['latitude'];
$user_long = (float) $_GET['longitude'];

// Compute the closest building by Euclidean distance
$closest = NULL;
$min_dist = INF;
while ($loc = mysqli_fetch_array($locs)) {
    $bldg_lat = (float) $loc['latitude'];
    $bldg_long = (float) $loc['longitude'];
    
    $dist_to_bldg = dist($bldg_lat, $bldg_long, $user_lat, $user_long);
    if ($dist_to_bldg < $min_dist) {
        $min_dist = $dist_to_bldg;
        $closest = $loc['location_name'];
    }
}

// Send closest building name as response
echo $closest;

$sqli->close();

function dist($x1, $y1, $x2, $y2) {
    $dx = $x2 - $x1;
    $dy = $y2 - $y1;
    
    return sqrt(pow($dx, 2) + pow($dy, 2));
}
?>
