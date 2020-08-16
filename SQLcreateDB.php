<?php

$serverName = "www.smccs85.com";
$username = "apedro";
$password = "2bf48XnyEW";
$port = 3306;
$DBName = "apedro_project";
$conn = mysqli_connect($serverName, $username, $password);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error() );
}

$sql = "CREATE DATABASE myDB";
if(mysqli_query($conn, $sql)){
    echo "Database created successfully.";
}
else {
    echo "Error creating database " . mysqli_error($conn);
}
$DBConnect = mysqli_connect($serverName, $username, $password, $DBName);
mysqli_select_db($conn, $DBName);

$TableName = "Alarcon_Pedro_users"; //table name in guestbook database

//if row number of table is zero, create table
$SQLstring = "CREATE TABLE $TableName (
                    countID SMALLINT AUTO_INCREMENT PRIMARY KEY, 
                    Email VARCHAR(40) NOT NULL UNIQUE, 
                    Username VARCHAR(40) NOT NULL UNIQUE, 
                    Password VARCHAR(40) )";
$QueryResult = mysqli_query($conn, $SQLstring);
if ($QueryResult == FALSE) {
        echo "<p>Unable to create the table</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
}
mysqli_close($conn);

?>