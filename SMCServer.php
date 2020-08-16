<?php
$serverName = "www.smccs85.com";
$username = "apedro";
$password = "2bf48XnyEW";
$port = 3306;
$DBName = "username_project";

//make connection
$DBConnect = mysqli_connect($serverName, $username, $password, $DBName);
//check connection
if(!$DBConnect){
    die("Connection Failed: " . mysqli_connect_error() );
}
else{
    echo "connected";
}


$TableName = "alarcon_pedro_users"; //table name in guestbook database

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
?>