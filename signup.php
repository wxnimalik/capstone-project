<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Event Insight | Sign Up</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="icon" href="EventInsight-Logo.ico" type="image/x-icon">
        <link rel="shortcut icon" href="EventInsight-Logo.ico" type="image/x-icon">
        <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                background: rgba(255, 255, 255, 0.6);
            }
    
            * {
                box-sizing: border-box;
            }
    
            .container {
                padding: 10px 120px;
                background: rgba(255, 255, 255, 0.6);
            }
    
            /* Full-width input fields */
            input[type=text], input[type=password] {
                width: 100%;
                padding: 15px;
                margin: 5px 0 22px 0;
                display: inline-block;
                border: none;
                background: #f1f1f1;
            }
    
            input[type=text]:focus, input[type=password]:focus {
                background-color: #ddd;
                outline: none;
            }
    
            /* Show Password icon styling */
            .show-password-icon {
                position: absolute;
                right: 10px;
                top: 50%;
                margin-top: -6px;
                transform: translateY(-50%);
                cursor: pointer;
            }
    
            hr {
                border: 1px solid #fff;
                margin-bottom: 25px;
            }
    
            .registerbtn {
                position: absolute;
                background-color: #B79B30;
                color: white;
                padding: 16px 20px;
                margin: 20px 35%;
                border: none;
                border-radius: 30px;
                cursor: pointer;
                width: 15%;
                opacity: 0.9;
                -ms-transform: translateY(-50%);
                transform: translateY(-50%);
                font-size: 18px;
            }
    
            .registerbtn:hover {
                opacity: 1;
            }
    
            a {
                color: #fff;
            }
    
            .signin {
                position: absolute;
                margin-top: 70px;
                margin-left: 8%;
                background-color: #212A57;
                text-align: center;
                width: 83%;
            }
            
            .signin p {
                color: #fff;
            }
        </style>
    </head>
    <body>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="container">
                <h1>Register</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>
    
                <label><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="user_name" required>
    
                <label><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="user_email" required>
    
                <label><b>Role</b></label>
                <input type="text" placeholder="Enter Role" name="user_role" required>
    
                <label for="password"><b>Password</b></label>
                <div style="position: relative;">
                    <input type="password" placeholder="Enter Password" name="user_password" id="password" required>
                    <span class="show-password-icon" onclick="togglePasswordVisibility()">
                        <ion-icon name="eye-outline"></ion-icon>
                    </span>
                </div>
    
                <p style="margin-top: 10px;">By creating an account you agree to our Terms & Privacy</a></p>
    
                <button class="registerbtn" type="submit" name="registerbtn" value="Register">Register</button>
            </div>
    
            <?php
                $conn = mysqli_connect("localhost","root","","id21800987_syncmastercalendar_db");
    
                if (isset($_POST['registerbtn'])) {
                    $user_name = $_POST['user_name'];
                    $user_email = $_POST['user_email'];
                    $user_role = $_POST['user_role'];
                    $user_password = ($_POST['user_password']);
                    
                    if (isset($_POST['registerbtn'])) {
                        $insert = $conn->prepare("INSERT INTO user (user_name, user_email, user_role, user_password) VALUES (?, ?, ?, ?)");
                        $insert->bind_param("ssss", $user_name, $user_email, $user_role, $user_password);
                    
                        $run_insert = $insert->execute();
    
                        if ($run_insert === true) {
                            echo "<script>window.open('login.php','_self');</script>";
                        } else {
                            echo "Failed. Try again";
                        }
    
                        $insert->close();
                    } else {
                        // Handle the case when user_repeatpass is not set (e.g., show an error message).
                        echo "Repeat Password is required.";
                    }
                }
                
                $conn->close();
            ?>
    
            <div class="container signin">
                <p>Already have an account? <a href="login.php">Sign in</a>.</p>
                <p>Copyright &copy; 2024 AsiaRAC by Haswani Malik. All rights reserved.</p>
            </div>
        </form>
    
        <script>
            function togglePasswordVisibility() {
                const passwordInput = document.getElementById('password');
                passwordInput.type = (passwordInput.type === 'password') ? 'text' : 'password';
            }
        </script>
        
        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>
