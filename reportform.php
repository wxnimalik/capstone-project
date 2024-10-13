<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset = "UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<title>Event Insight | Report Event Management</title>
		<!-- ======Styles======-->
		<link rel="stylesheet" href="/syncmastercalendar/assets/css/reportform.css">
        <link rel="icon" href="EventInsight-Logo.ico" type="image/x-icon">
        <link rel="shortcut icon" href="EventInsight-Logo.ico" type="image/x-icon">
        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	</head>
	
	<body>
		<!-- ======Navigation======-->
		<div class="container">
			<div class="navigation">
				<ul>
					<li>
						<a href="#">
							<span class="icon"><ion-icon name="pulse-outline"></ion-icon>
							</span>
							<span class="title">Event Insight</span>
						</a>
					</li>

					<li>
						<a href="dashboard.php">
							<span class="icon"><ion-icon name="home-outline"></ion-icon>
							</span>
							<span class="title">Dashboard</span>
						</a>
					</li>

					<li>
						<a href="eventform.php">
							<span class="icon"><ion-icon name="calendar-outline"></ion-icon>
							</span>
							<span class="title">Event</span>
						</a>
					</li>

                    <li>
						<a href="meetingform.php">
							<span class="icon"><ion-icon name="briefcase-outline">></ion-icon>
							</span>
							<span class="title">Meeting</span>
						</a>
					</li>

					<li>
						<a href="attendance.php">
							<span class="icon"><ion-icon name="id-card-outline"></ion-icon>
							</span>
							<span class="title">Attendance</span>
						</a>
					</li>

					<li>
						<a href="usermgt.php">
							<span class="icon"><ion-icon name="people-outline"></ion-icon>
							</span>
							<span class="title">User</span>
						</a>
					</li>

					<li>
						<a href="report.php">
							<span class="icon"><ion-icon name="folder-outline"></ion-icon>
							</span>
							<span class="title">Reports</span>
						</a>
					</li>

					<li>
						<a href= "logout.php">
							<span class="icon"><ion-icon name="log-out-outline"></ion-icon>
							</span>
							<span class="title">Sign Out</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
		
		<!-- ======Main======-->
		<div class="main">
			<div class="topbar">
				<div class="toggle">
					<ion-icon name="menu-outline"></ion-icon>
				</div>

				<div class="search">
					<label>
						<input type="text" placeholder="Search Here">
						<ion-icon name="search-outline"></ion-icon>
					</label>
				</div>

				<div class="user">
                    <img src="/syncmastercalendar/assets/img/customer01.jpg" alt="">
                </div>
            </div>  

        <!-- ======Meeting Page Navigation======-->
            <div class="btn-group">
                
                <a href="#">
                    <button></button>
                </a>
                
                 <a href="report.php">
                    <button>Back</button>
                </a>
                
                <a href="#">
                    <button></button>
                </a>
            </div>

            <!-- Meeting Page Form -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>AsiaRAC EVENT REPORT FORM</h2>
                    </div>
    
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="table">
                            <div class="row">
                                <div class="col-25">
                                    <label>Event Title</label>
                                </div>
                                <div class="col-75">
                                    <select name="event_id">
                                        <?php
                                        // Assuming you have a connection to the database
                                        $conn = mysqli_connect("localhost", "root", "", "id21800987_syncmastercalendar_db");
    
                                        // Check connection
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }
    
                                        // Fetch events from the database
                                        $eventQuery = "SELECT event_id, title FROM events";
                                        $eventResult = $conn->query($eventQuery);
    
                                        if ($eventResult->num_rows > 0) {
                                            while ($row = $eventResult->fetch_assoc()) {
                                                echo "<option value='" . $row["event_id"] . "'>" . $row["title"] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-25">
                                    <label>Report Title</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" name="title" placeholder="Enter name of the report">
                                </div>
                            </div>
    
                            <!-- File Upload - Picture URL -->
                            <div class="row">
                                <div class="col-25">
                                    <label>Picture URL</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" name="picture_url" placeholder="Enter Google Drive Link">
                                </div>
                            </div>
    
                            <!-- File Upload - File URL -->
                            <div class="row">
                                <div class="col-25">
                                    <label>File URL</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" name="file_url" placeholder="Enter Google Drive Link">
                                </div>
                            </div>
    
                            <!-- Other Form Fields -->
    
                            <div class="row">
                                <div class="col-25">
                                    <label>Created By</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" name="createdby" placeholder="Enter your full name" required>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-25">
                                    <label>Creation Date</label>
                                </div>
                                <div class="col-75">
                                    <input type="datetime-local" class="col-75" name="creationdate" required>
                                </div>
                            </div>
    
                            <!-- Other Form Fields -->
    
                            <div class="row">
                                <div class="col-25">
                                    <label>Last Updated By</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" name="lastupdatedby" placeholder="Enter your full name" required>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-25">
                                    <label>Last Updated Date</label>
                                </div>
                                <div class="col-75">
                                    <input type="datetime-local" class="col-75" name="lastupdateddate" id="lastUpdatedDate" required>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-25">
                                    <label>Status</label>
                                </div>
                                <div class="col-75">
                                    <select name="status" required>
                                        <option value="Choose_Status">Choose Status</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Ongoing">Ongoing</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Cancel">Cancelled</option>
                                    </select>
                                </div>
                            </div>
    
                            <br>
                            <div class="row">
                                <input type="submit" name="submit-btn" value="Submit">
                                <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                            </div>
    
                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "id21800987_syncmastercalendar_db");
                            if (isset($_POST['submit-btn'])) {
                                $event_id = isset($_POST['event_id']) ? $_POST['event_id'] : '';
                                $title = isset($_POST['title']) ? $_POST['title'] : '';
                                $picture_url = isset($_FILES['picture_url']['name']) ? $_FILES['picture_url']['name'] : '';
                                $file_url = isset($_FILES['file_url']['name']) ? $_FILES['file_url']['name'] : '';
                                $createdby = isset($_POST['createdby']) ? $_POST['createdby'] : '';
                                $creationdate = isset($_POST['creationdate']) ? $_POST['creationdate'] : '';
                                $lastupdatedby = isset($_POST['lastupdatedby']) ? $_POST['lastupdatedby'] : '';
                                $lastupdateddate = isset($_POST['lastupdateddate']) ? $_POST['lastupdateddate'] : '';
                                $status = isset($_POST['status']) ? $_POST['status'] : '';

                                $insert = "INSERT INTO report (event_id, title, picture_url, file_url, createdby, creationdate, lastupdatedby, lastupdateddate, status)
                                            VALUES ('$event_id', '$title', '$picture_url', '$file_url', '$createdby', '$creationdate', '$lastupdatedby', '$lastupdateddate', '$status')";
    
                                $run_insert = mysqli_query($conn, $insert);
                                if ($run_insert === true) {
                                    echo "<script>window.open('report.php','_self');</script>";
                                } else {
                                    echo "Failed. Try again";
                                }
                            }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- ============ Footer ============= -->
        <footer>
            <p>Copyright &copy; 2024 AsiaRAC by Haswani Malik. All rights reserved.</p>
        </footer>
        
        <!-- Script to set the current date and time for Last Updated Date -->
        <script>
            // Function to format the current date and time as per input datetime-local format
            function getCurrentDateTime() {
                const now = new Date();
                const year = now.getFullYear();
                const month = (now.getMonth() + 1).toString().padStart(2, '0');
                const day = now.getDate().toString().padStart(2, '0');
                const hours = now.getHours().toString().padStart(2, '0');
                const minutes = now.getMinutes().toString().padStart(2, '0');
                const currentDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
                return currentDateTime;
            }
        
            // Set the current date and time when the page is loaded
            document.getElementById('lastUpdatedDate').value = getCurrentDateTime();
        </script>
        
        <!-- =========== Scripts =========  -->
        <script src="/syncmastercalendar/assets/js/dashboard.js"></script>
    </body>
</html>