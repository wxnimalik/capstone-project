<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Event Insight | Meeting Management Analysis</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="icon" href="EventInsight-Logo.ico" type="image/x-icon">
        <link rel="shortcut icon" href="EventInsight-Logo.ico" type="image/x-icon">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
			<style>
			body {
				color: ;
				background: #f5f5f5;
				font-family: 'Varela Round', sans-serif;
				font-size: 13px;
				padding: 13px 13px;
			}
			.table-responsive {
				margin: 30px 0;
			}
			.table-wrapper {
				background: #fff;
				padding: 20px 25px;
				border-radius: 3px;
				min-width: 1000px;
				box-shadow: 0 1px 1px rgba(0,0,0,.05);
			}
			.table-title {        
				padding-bottom: 15px;
				background: #435d7d;
				color: #fff;
				padding: 16px 30px;
				min-width: 100%;
				margin: -20px -25px 10px;
				border-radius: 3px 3px 0 0;
			}
			.table-title h2 {
				margin: 5px 0 0;
				font-size: 24px;
			}
			.table-title .btn-group {
				float: right;
			}
			.table-title .btn {
				color: #fff;
				float: right;
				font-size: 13px;
				border: none;
				min-width: 50px;
				border-radius: 2px;
				border: none;
				outline: none !important;
				margin-left: 10px;
			}
			.table-title .btn i {
				float: left;
				font-size: 21px;
				margin-right: 5px;
			}
			.table-title .btn span {
				float: left;
				margin-top: 2px;
			}
			table.table tr th, table.table tr td {
				border-color: #e9e9e9;
				padding: 12px 15px;
				vertical-align: middle;
			}
			table.table tr th:first-child {
				width: 60px;
			}
			table.table tr th:last-child {
				width: 100px;
			}
			table.table-striped tbody tr:nth-of-type(odd) {
				background-color: #fcfcfc;
			}
			table.table-striped.table-hover tbody tr:hover {
				background: #f5f5f5;
			}
			table.table th i {
				font-size: 13px;
				margin: 0 5px;
				cursor: pointer;
			}	
			table.table td:last-child i {
				opacity: 0.9;
				font-size: 22px;
				margin: 0 5px;
			}
			table.table td a {
				font-weight: bold;
				color: #566787;
				display: inline-block;
				text-decoration: none;
				outline: none !important;
			}
			table.table td a:hover {
				color: #2196F3;
			}
			table.table td a.edit {
				color: #FFC107;
			}
			table.table td a.delete {
				color: #F44336;
			}

			.pagination {
				float: right;
				margin: 0 0 5px;
			}
			.pagination li a {
				border: none;
				font-size: 13px;
				min-width: 30px;
				min-height: 30px;
				color: #999;
				margin: 0 2px;
				line-height: 30px;
				border-radius: 2px !important;
				text-align: center;
				padding: 0 6px;
			}
			.pagination li a:hover {
				color: #666;
			}	
			.pagination li.active a, .pagination li.active a.page-link {
				background: #03A9F4;
			}
			.pagination li.active a:hover {        
				background: #0397d6;
			}
			.pagination li.disabled i {
				color: #ccc;
			}
			.pagination li i {
				font-size: 16px;
				padding-top: 6px
			}
			.hint-text {
				float: left;
				margin-top: 10px;
				font-size: 13px;
			}    

			/* Modal styles */
			.modal .modal-dialog {
				max-width: 400px;
			}
			.modal .modal-header, .modal .modal-body, .modal .modal-footer {
				padding: 20px 30px;
			}
			.modal .modal-content {
				border-radius: 3px;
				font-size: 14px;
			}
			.modal .modal-footer {
				background: #ecf0f1;
				border-radius: 0 0 3px 3px;
			}
			.modal .modal-title {
				display: inline-block;
			}
			.modal .form-control {
				border-radius: 2px;
				box-shadow: none;
				border-color: #dddddd;
			}
			.modal textarea.form-control {
				resize: vertical;
			}
			.modal .btn {
				border-radius: 2px;
				min-width: 100px;
			}	
			.modal form label {
				font-weight: normal;
			}

			.table-wrapper {
				margin: 30px 0;
			}

			.table {
				width: 100%;
				border-collapse: collapse;
			}

			.table th,
			.table td {
				border: 1px solid #ddd;
				padding: 8px;
				text-align: left;
			}

			.table th {
				background-color: #f2f2f2;
			}

			.table tbody tr:hover {
				background-color: #f5f5f5;
			}

			.material-icons {
                vertical-align: middle;
			}
			
			footer {
                background-color: #212A57;
                color: #fff; 
                text-align: center;
                padding: 10px 0;
                position: fixed;
                bottom: 0;
                width: 100%;
            }
			</style>

	</head>
	<body>
		<div class="table-responsive">
				<div class="table-wrapper">
					<div class="table-title">
						<div class="row">
							<div class="col-sm-6">
								<h2>Manage <b>Meeting Scheduling</b></h2>
							</div>
							<div class="col-sm-6">
							<a href='meetingform.php' class="btn btn-success"><i class="material-icons">&#xe5c4;</i><span>Back</span></a>
							<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>
							<a href='meetingcalendar.php' class="btn btn-info"><i class="material-icons">&#xe5c3;</i><span>Calendar</span></a>						
							</div>
						</div>
					</div>
				<table class="table">
					<thead>
						<tr>
							<th>Title</th>
							<th>Category</th>
							<th>Description</th>
							<th>Person In Charge</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Location</th>
							<th>Status</th>
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
						$conn = new mysqli("localhost","root","","id21800987_syncmastercalendar_db");
						
						// Check connection
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}

						$limit = 4; // Number of events per page
							$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
							$offset = ($page - 1) * $limit;

							// Query to count the total number of entries
							$countQuery = "SELECT COUNT(*) as total FROM meetings";
							$countResult = $conn->query($countQuery);
							$totalEntries = $countResult->fetch_assoc()['total'];

							$sql = "SELECT * FROM meetings LIMIT $offset, $limit";
							$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								echo "<tr>";
								echo "<td>" . $row["title"] . "</td>";
								echo "<td>" . $row["meeting_categories"] . "</td>";
								echo "<td>" . $row["description"] . "</td>";
								echo "<td>" . $row["person_in_charge"] . "</td>";
								echo "<td>" . $row["start_date"] . "</td>";
								echo "<td>" . $row["end_date"] . "</td>";
								echo "<td>" . $row["location"] . "</td>";
								echo "<td>" . $row["status"] . "</td>";
								echo "<td>
									<a href='meetingedit.php?edit=" . $row["meeting_id"] . "'><i class='material-icons'>edit</i></a>
									<a href='meetingdelete.php?del=" . $row["meeting_id"] . "'><i class='material-icons'>delete</i></a>
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
						echo "<li class='page-item'><a href='meetinganalysis.php?page=$i' class='page-link' onclick='changePage($i)'>$i</a></li>";
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
						window.location.href = 'meetinganalysis.php?page=' + currentPage;
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
		
		<!-- ============ Footer ============= -->
        <footer>
            <p>Copyright &copy; 2024 AsiaRAC by Haswani Malik. All rights reserved.</p>
        </footer>

		<!-- ====== ionicons ======= -->
		<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	</body>
</html>