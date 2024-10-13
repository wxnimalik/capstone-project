<?php
$connect = mysqli_connect("localhost","root","","id21800987_syncmastercalendar_db");
if(isset($_GET['del'])){
    $del_id = $_GET['del'];
    $delete = "DELETE FROM meetings WHERE meeting_id='$del_id'";
    $run_delete = mysqli_query($connect,$delete);
if($run_delete === true){
    echo "<script>window.open('meetinganalysis.php','_self');</script>";
}else{
    echo "Failed, try again. Error: " . mysqli_error($connect);
    }
}
?>

<script>
$(document).ready(function(){
	$('#view_data').DataTable();
});
</script>