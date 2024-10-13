<?php
// Generate Final Report Logic
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'id21800987_syncmastercalendar_db';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch all report entries with event title
$sql = "SELECT r.*, e.title as event_title FROM report r
        LEFT JOIN events e ON r.event_id = e.event_id";
$result = $conn->query($sql);

// Fetch data and format it for the final report
$finalReport = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Format data as needed, for example:
        $finalReport .= "Event Title: " . $row["event_title"] . "\n";
        $finalReport .= "Report Title: " . $row["title"] . "\n";
        $finalReport .= "Picture URL: " . $row["picture_url"] . "\n";
        $finalReport .= "File URL: " . $row["file_url"] . "\n";
        $finalReport .= "Created By: " . $row["createdby"] . "\n";
        $finalReport .= "Creation Date: " . $row["creationdate"] . "\n";
        $finalReport .= "Last Update By: " . $row["lastupdatedby"] . "\n";
        $finalReport .= "Last Update Date: " . $row["lastupdateddate"] . "\n\n";
    }
}

// Close the database connection
$conn->close();

// Set the content type and headers for file download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="final_report.txt"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
echo $finalReport;
exit();
?>