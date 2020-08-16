<?php

$serverName = "www.smccs85.com";
$username = "apedro";
$password = "2bf48nyEW";
$port = 3306;
$DBName = "apedro_project";

//make connection
$DBConnect = mysqli_connect($serverName, $username, $password, $DBName);
//check connection
if(!$DBConnect){
    die("Connection Failed: " . mysqli_connect_error() );
}

?>