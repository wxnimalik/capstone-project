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

if (isset($_POST['submit-btn'])){
    $title = $_POST['title'];
    $meeting_categories = $_POST['meeting_categories'];
    $description = $_POST['description'];
    $person_in_charge = $_POST['person_in_charge'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $location = $_POST['location'];
    $status = $_POST['status'];
                                    
$insert = "INSERT INTO meetings (title, meeting_categories, description, person_in_charge, start_date, end_date, location, status) VALUES ('$title', '$meeting_categories', '$description', '$person_in_charge', '$start_date', '$end_date', '$location', '$status')";
                                    
$run_insert = mysqli_query($conn,$insert);
if($run_insert === true){
    header("Location: meetinganalysis.php");
    exit();
}else{
    echo "Failed. Try again";
    } 
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset = "UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<title>Event Insight | Meeting Management</title>
		<!-- ======Styles======-->
		<link rel="stylesheet" href="/syncmastercalendar/assets/css/meetingform.css">
		<link rel="icon" href="EventInsight-Logo.ico" type="image/x-icon">
        <link rel="shortcut icon" href="EventInsight-Logo.ico" type="image/x-icon">
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
						<a href="/syncmastercalendar/report.php">
							<span class="icon"><ion-icon name="folder-outline"></ion-icon>
							</span>
							<span class="title">Reports</span>
						</a>
					</li>

					<li>
						<a href="logout.php">
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
                <a href="meetinganalysis.php">
                    <button>Timeline</button>
                </a>
                <a href="meetingcalendar.php">
                    <button>Calendar</button>
                </a>
                <a href="dashboard.php">
                    <button>Back</button>
                </a>
            </div>

         <!-- ======Meeting Page Form======-->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>AsiaRAC MEETING SCHEDULING FORM</h2>
                    </div>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="table">
                            <form>
                                <div class="row">
                                    <div class="col-25">
                                    <label>Title</label>
                                    </div>
                                    <div class="col-75">
                                    <input type="text" name="title" placeholder="Enter name of the meeting" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-25">
                                        <label>Category</label>
                                    </div>
                                        <select class="col-75" name="meeting_categories" required>
                                            <option value="Choose Category">Choose Category</option>
                                            <option value="Formal Meeting">Formal Meeting</option>
                                            <option value="Non-Formal Meeting">Non-Formal Meeting</option>
                                        </select>
                                </div>

                                <div class="row">
                                    <div class="col-25">
                                        <label>Description</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" name="description" placeholder="Enter details of the meeting" style="height:100px" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-25">
                                        <label>Person In Charge</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" name="person_in_charge" placeholder="Enter person in charge of the meeting" required>
                                    </div>
                                </div>    

                                <div class="row">
                                    <div class="col-25">
                                    <label>Start Date</label>
                                        <input type="datetime-local" class="col-75" name="start_date" required>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-25">
                                    <label>End Date</label>
                                        <input type="datetime-local" class="col-75" name="end_date" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-25">
                                        <label>Location</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" name="location" placeholder="Enter location of the meeting" required>
                                    </div>
                                </div>  

                                <div class="row">
                                    <div class="col-25">
                                        <label>Status</label>
                                    </div>    
                                        <select class="col-75" name="status" required>
                                            <option value="Choose Status">Choose Status</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Ongoing">Ongoing</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                </div>

                                <br>

                                <div class="row">
                                <input type="submit" name="submit-btn" value="Submit">
                                <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                                </div>
                            </div>
                        </form>
        </div>

        <!-- =========== Scripts =========  -->
        <script src="/syncmastercalendar/assets/js/dashboard.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>