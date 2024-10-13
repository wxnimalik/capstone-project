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

    $select = "SELECT * FROM events WHERE event_id='$edit_id'";
    $run = mysqli_query($conn, $select);
    $rowcont = mysqli_fetch_array($run);
    $title = $rowcont['title'];
    $event_categories = $rowcont['event_categories'];
    $description = $rowcont['description'];
    $person_in_charge = $rowcont['person_in_charge'];
    $start_date = $rowcont['start_date'];
    $end_date = $rowcont['end_date'];
    $location = $rowcont['location'];
    $status = $rowcont['status'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_changes'])) {
    $event_id = $_POST['event_id'];
    $etitle = $_POST['title'];
    $eevent_categories = $_POST['event_categories'];
    $edescription = $_POST['description'];
    $eperson_in_charge = $_POST['person_in_charge'];
    $estart_date = $_POST['start_date'];
    $eend_date = $_POST['end_date'];
    $elocation = $_POST['location'];
    $estatus = $_POST['status'];

    $update = "UPDATE events SET title='$etitle', event_categories='$eevent_categories', description='$edescription', person_in_charge='$eperson_in_charge', start_date='$estart_date', end_date='$eend_date', location='$elocation', status='$estatus' WHERE event_id='$event_id'";

    $run_update = mysqli_query($conn, $update);
    
    if ($run_update) {
        header("Location: eventanalysis.php");
        exit();
    } else {
        // Uncomment the line below for debugging
        // echo "Failed to update. Error: " . mysqli_error($conn);
    }
}

if (isset($_GET['edit'])) {
    $event_id = $_GET['edit'];

    $sql = "SELECT * FROM events WHERE event_id='$event_id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $eventDetails = mysqli_fetch_assoc($result);
    } else {
        echo "Event not found";
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
        <title>Event Insight | Edit Meeting</title>
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
                height: 100%;
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
                                <img src="/syncmastercalendar/assets/img/asiaracbunting.png" alt="Meeting Image">
                            </div>
                        </div>
                        <div class="right-side">
                            <div class="form-container">
                                <h2>EDIT OUR EVENT</h2>
        
                                <form action="" method="post">
        
                                    <input type="hidden" name="event_id" value="<?php echo $eventDetails['event_id']; ?>">
        
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" value="<?php echo $eventDetails['title']; ?>" required>
                                    </div>
        
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="event_categories" required>
                                            <option value="Choose Category" <?php echo ($eventDetails['event_categories'] == 'Choose Category') ? 'selected' : ''; ?>>Choose Category</option>
                                            <option value="Training" <?php echo ($eventDetails['event_categories'] == 'Training') ? 'selected' : ''; ?>>Training</option>
                                            <option value="Teambuildings" <?php echo ($eventDetails['event_categories'] == 'Teambuildings') ? 'selected' : ''; ?>>Teambuildings</option>
                                            <option value="Corporate Events" <?php echo ($eventDetails['event_categories'] == 'Corporate Events') ? 'selected' : ''; ?>>Corporate Events</option>
                                            <option value="Consulting Projects" <?php echo ($eventDetails['event_categories'] == 'Consulting Projects') ? 'selected' : ''; ?>>Consulting Projects</option>
                                            <option value="Key Note Speech" <?php echo ($eventDetails['event_categories'] == 'Key Note Speech') ? 'selected' : ''; ?>>Key Note Speech</option>
                                            <option value="Conferences" <?php echo ($eventDetails['event_categories'] == 'Conferences') ? 'selected' : ''; ?>>Conferences</option>
                                            <option value="Public Program" <?php echo ($eventDetails['event_categories'] == 'Public Program') ? 'selected' : ''; ?>>Public Program</option>
                                            <option value="CSR" <?php echo ($eventDetails['event_categories'] == 'CSR') ? 'selected' : ''; ?>>CSR</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" style="width: 100%;" rows="4" required><?php echo $eventDetails['description']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Person In Charge</label>
                                        <input type="text" name="person_in_charge" value="<?php echo $eventDetails['person_in_charge']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="datetime-local" name="start_date" value="<?php echo date('Y-m-d\TH:i', strtotime($eventDetails['start_date'])); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="datetime-local" name="end_date" value="<?php echo date('Y-m-d\TH:i', strtotime($eventDetails['end_date'])); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Location</label>
                                        <input type="text" name="location" value="<?php echo $eventDetails['location']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" required>
                                            <option value="Choose_Status" <?php echo ($eventDetails['status'] == 'Choose_Status') ? 'selected' : ''; ?>>Choose Status</option>
                                            <option value="Completed" <?php echo ($eventDetails['status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                            <option value="Ongoing" <?php echo ($eventDetails['status'] == 'Ongoing') ? 'selected' : ''; ?>>Ongoing</option>
                                            <option value="Pending" <?php echo ($eventDetails['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                            <option value="Cancel" <?php echo ($eventDetails['status'] == 'Cancel') ? 'selected' : ''; ?>>Cancelled</option>
                                        </select>
                                    </div>
                                    <div class="form-actions">
                                        <a href="eventanalysis.php" class="btn btn-secondary back-btn">Back</a>
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
