<?php
$host     = 'localhost';
$username = 'root';
$password = '';
$dbname   ='id21800987_syncmastercalendar_db';
 
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch events from the database
$sql = "SELECT title, start_date as start FROM events";
$result = $conn->query($sql);

// Create an array to store events
$events = array();

while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

// Convert the array to JSON
echo json_encode($events);

// Close the database connection
$conn->close();
?>
