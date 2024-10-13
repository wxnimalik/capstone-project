<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Event Insight | User Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="EventInsight-Logo.ico" type="image/x-icon">
    <link rel="shortcut icon" href="EventInsight-Logo.ico" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/syncmastercalendar/assets/css/usermgt.css">
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
		
		<!-- ======User Management======-->
		<div class="details">
			<div class="recentOrders">
				<div class="table-responsive">
					<div class="table-wrapper">
						<div class="table-title">
							<div class="row">
								<div class="col-sm-6">
									<h2>User Management</h2>
								</div>
								<div class="col-sm-6">
								<a href='usermgt.php' class="btn btn-success"><i class="material-icons">&#xe5c4;</i><span>Back</span></a>
								<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
								</div>
							</div>
						</div>
					<table class="table">
						<thead>
							<tr>
								<th>Username</th>
								<th>Email</th>
								<th>Role</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							// Database connection details
                            $host     = 'localhost';
                            $username = 'root';
                            $password = '';
                            $dbname   ='id21800987_syncmastercalendar_db';
							
							// Create connection
							$conn = new mysqli($host, $username, $password, $dbname);
							
							// Check connection
							if ($conn->connect_error) {
								die("Connection failed: " . $conn->connect_error);
							}

							$limit = 4; // Number of events per page
							$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
							$offset = ($page - 1) * $limit;

							// Query to count the total number of entries
							$countQuery = "SELECT COUNT(*) as total FROM user";
							$countResult = $conn->query($countQuery);
							$totalEntries = $countResult->fetch_assoc()['total'];

							$sql = "SELECT * FROM user LIMIT $offset, $limit";
							$result = $conn->query($sql);


							if ($result->num_rows > 0) {
								while ($row = $result->fetch_assoc()) {
									echo "<tr>";
									echo "<td>" . $row["user_name"] . "</td>";
									echo "<td>" . $row["user_email"] . "</td>";
									echo "<td>" . $row["user_role"] . "</td>";
									echo "<td>
										<a href='userdelete.php?del=" . $row["user_id"] . "'><i class='material-icons'>personremove</i></a>
										</td>";
									echo "</tr>";
								}
							} else {
								echo "<tr><td colspan='8'>No meetings found</td></tr>";
							}

							
							// Close the database connection
							$conn->close();
							?>
						</tbody>
					</table>
				</div>
				<div class="clearfix">
				<div class="hint-text">Showing <b id="currentPage">1</b> out of <b id="totalPages">10</b> entries</div>
				<ul class="pagination" id="pagination">
				<ul class="pagination" id="pagination">
					<li class="page-item disable"><a href="#" onclick="previousPage()">Previous</a></li>
					<!-- Pagination items will be dynamically generated here -->
					<?php
					for ($i = 1; $i <= ceil($result->num_rows / $limit); $i++) {
						echo "<li class='page-item'><a href='usermgt.php?page=$i' class='page-link' onclick='changePage($i)'>$i</a></li>";
					}
					?>
					<li class="page-item"><a href="#" class="page-link" onclick="nextPage()">Next</a></li>
				</ul>
			</div>

			<script>
				// You can replace this with actual data from your server-side script
				const totalEntries = <?php echo $totalEntries; ?>; // Replace with the total number of entries
				const entriesPerPage = <?php echo $limit; ?>;
				let currentPage = <?php echo $page; ?>;

				// Calculate the total number of pages
				const totalPages = Math.ceil(totalEntries / entriesPerPage);
				document.getElementById('totalPages').textContent = totalPages;

				function changePage(newPage) {
					if (newPage >= 1 && newPage <= totalPages) {
						currentPage = newPage;
						// You may want to adjust this URL according to your actual URL structure
						window.location.href = 'usermgt.php?page=' + currentPage;
					}
				}

				function previousPage() {
					changePage(currentPage - 1);
				}

				function nextPage() {
					changePage(currentPage + 1);
				}
			</script>

		</div> 


		<!-- Delete Modal HTML -->
		<div id="deleteEmployeeModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form>
						<div class="modal-header">						
							<h4 class="modal-title">Delete All</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">					
							<p>Are you sure you want to delete these Records?</p>
							<p class="text-warning"><small>This action cannot be undone.</small></p>
						</div>
						<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
							<input type="submit" class="btn btn-danger" value="Delete">
						</div>
					</form>
				</div>
			</div>
		</div>
			
		<!-- =========== Scripts =========  -->
		<script src="/syncmastercalendar/assets/js/dashboard.js"></script>

		<!-- ====== ionicons ======= -->
		<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
