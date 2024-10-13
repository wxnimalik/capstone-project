<?php
$host     = 'localhost';
$username = 'root';
$password = '';
$dbname   ='id21800987_syncmastercalendar_db';
 
$conn = new mysqli($host, $username, $password, $dbname);
if(!$conn){
    die("Cannot connect to the database.". $conn->error);
}

?>