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

// Check if the form is submitted
if (isset($_POST['login-btn'])) {
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    // Use prepared statement to prevent SQL injection
    $select = "SELECT * FROM user WHERE user_email=? AND user_password=?";
    $stmt = $conn->prepare($select);
    $stmt->bind_param("ss", $user_email, $user_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Successful login
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Email or Password is Wrong!";
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Event Insight | Login</title>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
        <link href="/syncmastercalendar/assets/css/login.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="EventInsight-Logo.ico" type="image/x-icon">
        <link rel="shortcut icon" href="EventInsight-Logo.ico" type="image/x-icon">
    </head>
    <body>
        <div class="logo">
            <img src="assets/img/asiarac-logo.svg" style="margin-top: -40px; margin-left: -200px; margin-right: 300px; margin-bottom: -40px;" width="310px">
            <p style="color: #fff; font-size: 14px; display: flex; text-align: center; padding: 30px 20px; margin-top: 35px; margin-left: -255px;">Copyright &copy; 2024 AsiaRAC by Haswani Malik. All rights reserved.</p>
            </div>
            
            <div class="main">
                <input type="checkbox" id="chk" aria-hidden="true">
    
                <!-- Login Form -->
                <div class="signup">
                    <form action="" method="post" enctype="multipart/form-data">
                        <label for="chk" aria-hidden="true">Login</label>
                        <input type="text" name="user_email" placeholder="Email" required="required" />
                        <input type="password" name="user_password" placeholder="Password" required="required"/>
                        <button type="submit" name="login-btn" class="btn btn-block" value="Login">Login</button>
                        <br><br>
                        <a href= "signup.php" style="background-color: #fff; color: #b69b32; margin-left: 82px; padding: 14px 25px; text-align: center; border-radius: 30px; text-decoration: none; font-family: 'Poppins', sans-serif;" target="_self"><b>Register As Admin</b></a>
                    </form>
                </div>
            </div>
    
            <script>
                // Password toggle functionality
                const passwordInput = document.getElementById('password');
                const togglePassword = document.querySelector('.toggle-password');
            
                togglePassword.addEventListener('click', function () {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.classList.toggle('active');
                });
            </script>
    </body>
</html>
