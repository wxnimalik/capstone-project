<?php
session_start();

// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'id21800987_syncmastercalendar_db';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];

    $select = "SELECT * FROM attendance WHERE attendance_id='$edit_id'";
    $run = mysqli_query($conn, $select);
    $rowcont = mysqli_fetch_array($run);
    $event_title = $rowcont['event_title'];
    $meeting_title = $rowcont['meeting_title'];
    $attendeesname = $rowcont['attendeesname'];
    $attendance_datecreated = $rowcont['attendance_datecreated'];
    $attendance_status = $rowcont['attendance_status'];
    $mc_letter = $rowcont['mc_letter'];
    $provencomment = $rowcont['provencomment'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_changes'])) {
    $attendance_id = $_POST['attendance_id'];
    $eevent_title = $_POST['event_title'];
    $emeeting_title = $_POST['meeting_title'];
    $eattendeesname = $_POST['attendeesname'];
    $eattendance_datecreated = $_POST['attendance_datecreated'];
    $eattendance_status = $_POST['attendance_status'];
    $emc_letter = $_POST['mc_letter'];
    $eprovencomment = $_POST['provencomment'];

    $update = "UPDATE attendance SET event_title='$eevent_title', meeting_title='$emeeting_title', attendeesname='$eattendeesname', attendance_datecreated='$eattendance_datecreated', attendance_status='$eattendance_status', mc_letter='$emc_letter', provencomment='$eprovencomment' WHERE attendance_id='$attendance_id'";

    $run_update = mysqli_query($conn, $update);
    
    if ($run_update) {
        header("Location: attendance.php");
        exit();
    } else {
        // Uncomment the line below for debugging
        // echo "Failed to update. Error: " . mysqli_error($conn);
    }
}

if (isset($_GET['edit'])) {
    $attendance_id = $_GET['edit'];

    $sql = "SELECT * FROM attendance WHERE attendance_id='$attendance_id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $attendanceDetails = mysqli_fetch_assoc($result);
    } else {
        echo "Attendance not found";
        exit();
    }
} else {
    echo "Edit parameter not set";
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Event Insight | Edit Attendance</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="icon" href="EventInsight-Logo.ico" type="image/x-icon">
        <link rel="shortcut icon" href="EventInsight-Logo.ico" type="image/x-icon">
        <style>
            body {
                background: #212A57;
                font-family: 'Poppins', sans-serif;
            }
    
            .container {
                margin-top: 50px;
            }
    
            .form-container {
            background: rgba(255, 255, 255, 0.9); 
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
    
            .form-container h2 {
                border-bottom: 2px solid #ddd;
                padding-bottom: 10px;
                margin-bottom: 20px;
                font-weight: bold;
                font-size: 50px;
                color: #212A57;
            }
            
            .form-group {
                margin-bottom: 20px;
            }
    
            .form-group label {
                display: block;
                margin-bottom: 5px;
            }
    
            .form-group input,
            .form-group select {
                width: 100%;
                padding: 10px;
                box-sizing: border-box;
            }
    
            .form-actions {
                text-align: right;
                margin-top: 20px;
            }
    
            .back-btn {
                margin-right: 10px;
            }
    
            .image-container {
                overflow: hidden;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
    
            .image-container img {
                width: 100%;
                height: auto;
                display: block;
            }
    
            .split-container {
                display: flex;
            }
    
            .left-side {
                flex: 1;
                padding: 20px;
                background-color: none;
                margin-bottom: 20px;
                border-radius:5px;
            }
    
            .right-side {
                flex: 2;
                padding: 20px;
            }
            
            footer {
                background-color: #212A57;
                color: #fff; 
                text-align: center;
                padding: 3px 0;
                position: fixed;
                bottom: -15px;
                width: 100%;
            }
        </style>
    </head>
    <body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="split-container">
                    <div class="left-side">
                        <div class="image-container">
                            <img style="display: fixed;" src="/syncmastercalendar/assets/img/asiaracbunting.png" alt="Meeting Image">
                        </div>
                    </div>
                    <div class="right-side">
                        <div class="form-container">
                            <h2 style="font-weight: 30px;">EDIT ATTENDANCE</h2>
    
                            <form action="" method="post">
    
                            <input type="hidden" name="attendance_id" value="<?php echo $attendanceDetails['attendance_id']; ?>">
    
                                <div class="form-group">
                                    <label>Event Title</label>
                                    <input type="text" name="event_title" value="<?php echo $attendanceDetails['event_title']; ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Meeting Title</label>
                                    <input type="text" name="meeting_title" value="<?php echo $attendanceDetails['meeting_title']; ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Attendees Full Name</label>
                                    <input type="text" name="attendeesname" value="<?php echo $attendanceDetails['attendeesname']; ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Date Created</label>
                                    <input type="datetime-local" name="attendance_datecreated" value="<?php echo date('Y-m-d', strtotime($attendanceDetails['attendance_datecreated'])); ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="attendance_status" required>
                                        <option value="Choose Attendance Status" <?php echo (isset($attendanceDetails['attendance_status']) && $attendanceDetails['attendance_status'] == 'Choose Attendance Status') ? 'selected' : ''; ?>>Choose Attendance Status</option>
                                        <option value="Present" <?php echo(isset($attendanceDetails['attendance_status']) && $attendanceDetails['attendance_status'] == 'Present') ? 'selected' : ''; ?>>Present</option>
                                        <option value="Absent" <?php echo(isset($attendanceDetails['attendance_status']) && $attendanceDetails['attendance_status'] == 'Absent') ? 'selected' : ''; ?>>Absent</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>If you choose Absent, attach document</label>
                                    <input type="text" name="mc_letter" value="<?php echo $attendanceDetails['mc_letter']; ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Absent Comment</label>
                                    <textarea name="provencomment" style="width: 100%;" rows="4" required><?php echo $attendanceDetails['provencomment']; ?></textarea>
                                </div>
                                
                                
                                <div class="form-actions">
                                    <a href="attendance.php" class="btn btn-secondary back-btn">Back</a>
                                    <input type="submit" class="btn btn-success" name="save_changes" value="Save Changes">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        <!-- ============ Footer ============= -->
        <footer>
            <p>Copyright &copy; 2024 AsiaRAC by Haswani Malik. All rights reserved.</p>
        </footer>
    </body>
</html>