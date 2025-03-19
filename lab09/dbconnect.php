<?php
$host = "localhost";
$database = "ysekban";
$user = "ysekban";
$password = "tGzol1cw";

$connect = mysqli_connect($host, $user, $password, $database);

if (!$connect) {
    die("Connection failed: " . mysqli_error($connect));
} else {
    echo "<div>Connected to MySQL database <b>$database</b></div>";
}

// When done with the connection
mysqli_close($connect);
?>