<?php

date_default_timezone_set("Asia/Dhaka");

$conn = mysqli_connect("localhost", "skabustf_admin", "skoder2020", "skabustf_Medimate");

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
// ssh -f skabustf@skoder.tech -p21098 -L 3306:127.0.0.1:3306 -N

?>
