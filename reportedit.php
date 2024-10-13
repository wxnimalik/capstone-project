<?php
session_start();

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

    $select = "SELECT * FROM report WHERE report_id='$edit_id'";
    $run = mysqli_query($conn, $select);
    $rowcont = mysqli_fetch_array($run);
    $title = $rowcont['title'];
    $picture_url = $rowcont['picture_url'];
    $file_url = $rowcont['file_url'];
    $createdby = $rowcont['createdby'];
    $creationdate = $rowcont['creationdate'];
    $lastupdatedby = $rowcont['lastupdatedby'];
    $lastupdateddate = $rowcont['lastupdateddate'];
    $status = $rowcont['status'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_changes'])) {
    $etitle = $_POST['title'];
    $epicture_url = $_POST['picture_url'];
    $efile_url = $_POST['file_url'];
    $ecreatedby = $_POST['createdby'];
    $ecreationdate = $_POST['creationdate'] ?? date('Y-m-d H:i:s');
    $elastupdatedby = $_POST['lastupdatedby'];
    $elastupdateddate = $_POST['lastupdateddate'] ?? date('Y-m-d H:i:s');
    $estatus = $_POST['status'];

    $update = "UPDATE report SET title='$etitle', picture_url='$epicture_url', file_url='$efile_url', createdby='$ecreatedby', creationdate='$ecreationdate', lastupdatedby='$elastupdatedby', lastupdateddate='$elastupdateddate', status='$estatus' WHERE report_id='$edit_id'";

    $run_update = mysqli_query($conn, $update);

    if ($run_update) {
        header("Location: report.php");
        exit();
    } else {
        // Uncomment the line below for debugging
        // echo "Failed to update. Error: " . mysqli_error($conn);
    }
}

if (isset($_GET['edit'])) {
    $report_id = $_GET['edit'];

    $sql = "SELECT * FROM report WHERE report_id='$report_id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $reportDetails = mysqli_fetch_assoc($result);
    } else {
        echo "Report not found";
        exit();
    }
} else {
    echo "Edit parameter not set";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Event Insight | Edit Report</title>
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
            background: rgba(255, 255, 255, 0.6); 
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
    
            .form-container h2 {
                border-bottom: 2px solid #ddd;
                padding-bottom: 10px;
                margin-bottom: 20px;
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
                background-color: #e9ecef;
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
                            <h2 style="font-weight: 300;">EDIT REPORT</h2>
    
                            <form action="" method="post">
    
                                <input type="hidden" name="report_id" value="<?php echo $reportDetails['report_id']; ?>">
                                
                                <div class="form-group">
                                    <label>Report Title</label>
                                    <input type="text" name="title" value="<?php echo $reportDetails['title']; ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Picture URL</label>
                                    <input type="text" name="picture_url" value="<?php echo $reportDetails['picture_url']; ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>File URL</label>
                                    <input type="text" name="file_url" value="<?php echo $reportDetails['file_url']; ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Created By</label>
                                    <input type="text" name="createdby" value="<?php echo $reportDetails['createdby']; ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Creation Date</label>
                                    <input type="datetime-local" name="creationdate" value="<?php echo date('Y-m-d\TH:i', strtotime($reportDetails['creationdate'])); ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Last Update By</label>
                                    <input type="text" name="lastupdatedby" value="<?php echo $reportDetails['lastupdatedby']; ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Last Update Date</label>
                                    <input type="datetime-local" name="lastupdateddate" value="<?php echo date('Y-m-d\TH:i', strtotime($reportDetails['lastupdateddate'])); ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" required>
                                        <option value="Choose_Status" <?php echo ($reportDetails['status'] == 'Choose_Status') ? 'selected' : ''; ?>>Choose Status</option>
                                        <option value="Completed" <?php echo ($reportDetails['status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                        <option value="Ongoing" <?php echo ($reportDetails['status'] == 'Ongoing') ? 'selected' : ''; ?>>Ongoing</option>
                                        <option value="Pending" <?php echo ($reportDetails['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                        <option value="Cancel" <?php echo ($reportDetails['status'] == 'Cancel') ? 'selected' : ''; ?>>Cancelled</option>
                                    </select>
                                </div>
                                <div class="form-actions">
                                    <a href="report.php" class="btn btn-secondary back-btn">Back</a>
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
