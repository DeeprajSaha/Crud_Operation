<?php

$server = "localhost";
$username = "root";
$password = "";
$dbnanme = "crud";

$con = mysqli_connect($server, $username, $password, $dbnanme);

if(!$con){
    die("Connection failed: " . mysqli_connect_error());
}

?>