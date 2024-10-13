<?php
session_start();
$host = 'localhost';       
$username = 'root';         
$password = '';       
$dbname = 'id21800987_syncmastercalendar_db';  

// Establish the connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check if connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch 3 most recent events from the events table
$event_sql = "SELECT title, start_date, status FROM events ORDER BY start_date DESC LIMIT 3";
$event_result = $conn->query($event_sql);

// Check if events query ran successfully
if (!$event_result) {
    die("Error fetching events: " . $conn->error);
}

// Fetch 3 most recent meetings from the meetings table
$meeting_sql = "SELECT title, start_date, status FROM meetings ORDER BY start_date DESC LIMIT 3";
$meeting_result = $conn->query($meeting_sql);

// Check if meetings query ran successfully
if (!$meeting_result) {
    die("Error fetching meetings: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset = "UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<title>Event Insight | Dashboard</title>
		<!-- ======Styles======-->
		<link rel="stylesheet" href="./assets/css/dashboard.css">
		<link rel="icon" href="EventInsight-Logo.ico" type="image/x-icon">
        <link rel="shortcut icon" href="EventInsight-Logo.ico" type="image/x-icon">

        <style>
        .status.completed {
        padding: 2px 4px;
        background: #8de02c;
        color: var(--white);
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        }

        .status.ongoing {
        padding: 2px 4px;
        background: #1795ce;
        color: var(--white);
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        }

        .status.pending {
        padding: 2px 4px;
        background: #e9b10a;
        color: var(--white);
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        }

        .status.cancelled {
        padding: 2px 4px;
        background: #f00;
        color: var(--white);
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        }
    </style>
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
							<span class="icon"><ion-icon name="briefcase-outline"></ion-icon>
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
							<span class="title">Report</span>
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

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Daily Views</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">4.9</div>
                        <div class="cardName">Ratings</div>
                    </div>

                    <div class="iconBx">
						<ion-icon name="star-half-outline"></ion-icon>
                    </div>
                </div>

                <?php
                // Establish the connection
                $conn = new mysqli($host, $username, $password, $dbname);

                // Check if connection was successful
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to get total number of events
                $totalEventsQuery = "SELECT COUNT(*) as total_events FROM events";
                $totalEventsResult = $conn->query($totalEventsQuery);
                $totalEvents = $totalEventsResult->fetch_assoc()['total_events'];

                // Query to get the number of events in progress
                $inProgressQuery = "SELECT COUNT(*) as events_in_progress FROM events WHERE status NOT IN ('Completed', 'Cancelled')";
                $inProgressResult = $conn->query($inProgressQuery);
                $eventsInProgress = $inProgressResult->fetch_assoc()['events_in_progress'];
                ?>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo htmlspecialchars($totalEvents); ?></div>
                        <div class="cardName">Total Event</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="rocket-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo htmlspecialchars($eventsInProgress); ?></div>
                        <div class="cardName">Event In Progress</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="bulb-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Event In Progress List ================= -->
            <div class="details">
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Recent Activities</h2>
                    </div>
                    <table>
                        <!-- Display recent events -->
                        <tr><td colspan="3"><h3>Recent Events</h3></td></tr>
                        <?php
                        if ($event_result->num_rows > 0) {
                            while ($row = $event_result->fetch_assoc()) {
                                $statusClass = strtolower($row["status"]); 
                                echo '<tr>
                                        <td><h4>' . htmlspecialchars($row["title"]) . '<br><span>' . htmlspecialchars($row["start_date"]) . '</span></h4></td>
                                        <td><span class="status ' . $statusClass . '">' . htmlspecialchars($row["status"]) . '</span></td>
                                    </tr>';
                            }
                        } else {
                            echo '<tr><td colspan="2">No recent events found.</td></tr>';
                        }
                        ?>

                        <!-- Display recent meetings -->
                        <tr><td colspan="3"><h3>Recent Meetings</h3></td></tr>
                        <?php
                        if ($meeting_result->num_rows > 0) {
                            while ($row = $meeting_result->fetch_assoc()) {
                                $statusClass = strtolower($row["status"]); 
                                echo '<tr>
                                        <td><h4>' . htmlspecialchars($row["title"]) . '<br><span>' . htmlspecialchars($row["start_date"]) . '</span></h4></td>
                                        <td><span class="status ' . $statusClass . '">' . htmlspecialchars($row["status"]) . '</span></td>
                                    </tr>';
                            }
                        } else {
                            echo '<tr><td colspan="2">No recent meetings found.</td></tr>';
                        }
                        ?>
                    </table>
                </div>

                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Our Client</h2>
                    </div>

                    <table>
                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="/syncmastercalendar/assets/img/customer02.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Malaysia Airports Holdings Berhad <br> <span>Air Transportation and The Provision of Related Services</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="/syncmastercalendar/assets/img/customer01.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Perodua Manufacturing Sdn Bhd (Malaysia) <br> <span>Manufacture and Assembly of Motor Vehicles and Other Related Activities</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="/syncmastercalendar/assets/img/customer02.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Shell Malaysia Trading Sdn Bhd <br> <span>Blending of Lubricating Oils and Marketing of Petroleum Products</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="/syncmastercalendar/assets/img/customer01.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Cement Industries of Malaysia Berhad <br> <span>Provision of Management Services and Investment Holding</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="/syncmastercalendar/assets/img/customer02.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Hitachi Electronic Products (Malaysia) Sdn Bhd <br> <span>Manufacture and Sales of Optical </span></h4>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ============ Footer ============= -->
    <footer>
        <p>Copyright &copy; 2024 AsiaRAC by Haswani Malik. All rights reserved.</p>
    </footer>

    <!-- =========== Scripts =========  -->
    <script src="/syncmastercalendar/assets/js/dashboard.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>