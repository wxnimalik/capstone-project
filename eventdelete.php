<?php
$connect = mysqli_connect("localhost","root","","id21800987_syncmastercalendar_db");
if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    echo "Deleting ID: $del_id";
    $delete = "DELETE FROM events WHERE event_id='$del_id'";
    $run_delete = mysqli_query($connect, $delete);
if ($run_delete) {
echo "<script>window.open('eventanalysis.php','_self');</script>";
} else {
    echo "Failed, try again. Error: " . mysqli_error($connect);
    }
}
?>
<script>
$(document).ready(function(){
	$('#view_data').DataTable();
});
</script>