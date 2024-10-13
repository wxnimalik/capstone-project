

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Insight | Event Calendar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="icon" href="EventInsight-Logo.ico" type="image/x-icon">
    <link rel="shortcut icon" href="EventInsight-Logo.ico" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <style>
        * {
        font-family: "Poppins", sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        }

        :root {
        --blue: #212A57;
        --white: #fff;
        --gray: #f5f5f5;
        --black1: #222;
        --black2: #999;
        }

        body {
        min-height: 100vh;
        overflow-x: hidden;
        }

        .container {
        position: relative;
        width: 100%;
        }

        .navigation {
            position: fixed;
            width: 300px;
            height: 100%;
            background: var(--blue);
            border-left: 10px solid var(--blue);
            transition: 0.5s;
            overflow: hidden;
            z-index: 1000;
        }

        .navigation.active {
            width: 80px;
        }

        .navigation ul {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

        .navigation ul li {
            position: relative;
            width: 100%;
            list-style: none;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
        }

        .navigation ul li:hover,
        .navigation ul li.hovered {
            background-color: var(--white);
        }

        .navigation ul li:nth-child(1) {
            margin-bottom: 40px;
            pointer-events: none;
        }

        .navigation ul li a {
            position: relative;
            display: block;
            width: 100%;
            display: flex;
            text-decoration: none;
            color: var(--white);
        }

        .navigation ul li:hover a,
        .navigation ul li.hovered a {
            color: var(--blue);
        }

        .navigation ul li a .icon {
            position: relative;
            display: block;
            min-width: 60px;
            height: 60px;
            line-height: 75px;
            text-align: center;
        }

        .navigation ul li a .icon ion-icon {
            font-size: 1.75rem;
        }

        .navigation ul li a .title {
            position: relative;
            display: block;
            padding: 0 10px;
            height: 60px;
            line-height: 60px;
            text-align: start;
            white-space: nowrap;
        }

        .navigation ul li:hover a::before,
        .navigation ul li.hovered a::before {
            content: "";
            position: absolute;
            right: 0;
            top: -50px;
            width: 50px;
            height: 50px;
            background-color: transparent;
            border-radius: 50%;
            box-shadow: 35px 35px 0 10px var(--white);
            pointer-events: none;
        }

        .navigation ul li:hover a::after,
        .navigation ul li.hovered a::after {
            content: "";
            position: absolute;
            right: 0;
            bottom: -50px;
            width: 50px;
            height: 50px;
            background-color: transparent;
            border-radius: 50%;
            box-shadow: 35px -35px 0 10px var(--white);
            pointer-events: none;
        }

        .details {
            position: absolute;
            width: 120%; 
            padding: 20px;
            display: flex;
            flex-direction: column; 
            align-items: center; 
            margin-top: auto;
            background: none;
        }

        .details .recentOrders {
            width: 100%; /* Changed from min-height to width */
            max-width: 800px; /* Add max-width to limit the width */
            background: var(--white);
            padding: 40px;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            border-radius: 20px;
            margin-top: 20px; /* Adjusted margin for better spacing */
        }

        #calendar {
            width: 100%;
            margin-top: 20px;
        }

        .month-input {
            width: 230px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
            font-size: 14px;
        }

        .change-month-btn {
            cursor: pointer;
            background-color: #212A57; 
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .change-month-btn:hover {
            background-color: #6576c9; 
        }

        .btn-btn-back {
            cursor: pointer;
            background-color: #212A57; 
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            float: right;
            transition: background-color 0.3s ease;
        }

        .btn-btn-back:hover{
            background-color: #6576c9; 
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
        
        /* ====================== Responsive Design ========================== */
        @media (max-width: 991px) {
        .navigation {
            left: -300px;
        }
        .navigation.active {
            width: 300px;
            left: 0;
        }
        .main {
            width: 100%;
            left: 0;
        }
        .main.active {
            left: 300px;
        }
        .cardBox {
            grid-template-columns: repeat(2, 1fr);
        }
        }

        @media (max-width: 768px) {
        .details {
            grid-template-columns: 1fr;
        }
        .recentOrders {
            overflow-x: auto;
        }
        .status.inProgress {
            white-space: nowrap;
        }
        }

        @media (max-width: 480px) {
        .cardBox {
            grid-template-columns: repeat(1, 1fr);
        }
        .cardHeader h2 {
            font-size: 20px;
        }
        .user {
            min-width: 40px;
        }
        .navigation {
            width: 100%;
            left: -100%;
            z-index: 1000;
        }
        .navigation.active {
            width: 100%;
            left: 0;
        }
        .toggle {
            z-index: 10001;
        }
        .main.active .toggle {
            color: #fff;
            position: fixed;
            right: 0;
            left: initial;
        }
        }
    </style>
</head>

<body>
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

    <div class="details">
        <div class="recentOrders">
            <div class="btn-group">
                <input type="text" class="month-input" id="monthInput" placeholder="Type month (MM/YYYY)">
                <button class="btn change-month-btn" id="btnMonth">Change Month</button>
                <input type="button" class="btn-btn-back" onclick="goBack()" value="Back">
            </div>

            <div id="calendar"></div>
        </div>
    </div>
    
    <!-- ============ Footer ============= -->
    <footer>
        <p>Copyright &copy; 2024 AsiaRAC by Haswani Malik. All rights reserved.</p>
    </footer>
    
    <script>
        $(document).ready(function () {
            // Initialize FullCalendar
            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultView: 'month', // Initial view when the calendar loads
                events: 'fetchevent.php', // PHP script to fetch events from the database
            });

            // Button click events to change the view
            $('#btnMonth').click(function () {
                var inputText = $('#monthInput').val();
                var newDate = moment(inputText, 'MM/YYYY', true); // Parse the input
                if (newDate.isValid()) {
                    calendar.fullCalendar('gotoDate', newDate);
                } else {
                    alert('Invalid month format. Please use MM/YYYY.');
                }
            });

            $('#btnWeek').click(function () {
                calendar.fullCalendar('changeView', 'agendaWeek');
            });

            $('#btnDay').click(function () {
                calendar.fullCalendar('changeView', 'agendaDay');
            });

            // Make each day clickable
            $('#calendar').on('click', '.fc-day', function () {
                var date = $(this).data('date');
                if (date) {
                    calendar.fullCalendar('gotoDate', date);
                    calendar.fullCalendar('changeView', 'agendaDay');
                }
            });
        });

        function goBack() {
            window.location.href = 'eventanalysis.php';
        }
        </script>

     <!-- =========== Scripts =========  -->
     <script src="/syncmastercalendar/assets/js/dashboard.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
