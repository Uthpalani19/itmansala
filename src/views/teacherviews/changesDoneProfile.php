<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/student-style.css"></link>
        <link rel="stylesheet" href="../../assets/css/global.css"></link>
    <title>View Profile</title>
</head>
<body>
    <!-- Navigation Bar -->

    <!-- Student main details -->
    <div class="draken-area">
        <?php 
            session_start();
            require_once('../../assets/includes/navbar-student.php');
        ?>

        <div class="container">
            <div class="profilepicture">
                <img src="src\assets\images\propic.jpg" class="rounded-circle" width="150">
            </div>

            <div class="student-details">
                <div class="student-name">
                    <p id="student-name">Sandani Punchihewa</p>
                </div>

                <div class = "std-details">
                    <p id="student-details">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna</p>
                </div>
            </div>
        </div>

        <!-- Student Details -->
        <div class="user-container">
            <div class="user-details">
                <table class="tbl-user-details">
                    <tr>
                        <th><h3>User Details</h3></th>
                    </tr>
                    <tr>
                        <td>Email address</td>
                    </tr>
                    <tr>
                        <td>sandanip@gmail.com</td>
                    </tr>
                    <tr>
                        <td>Telephone Number</td>
                    </tr>
                    <tr>
                        <td>071 255 6989</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                    </tr>
                    <tr>
                        <td id="last-row">No:222, Araliya Road, Wadduwa, Panadura</td>
                    </tr>
                </table>
            </div>
            <div></div>
            <div class="login-activity">
                <table class="tbl-login-activity">
                    <tr>
                        <th><h3>Login Activity</h3></th>
                    </tr>
                    <tr>
                        <td>First access to site</td>
                    </tr>
                    <tr>
                        <td>13 May 2022, 9:50 AM
                            (180 days 17 hours)</td>
                    </tr>
                    <tr>
                        <td>Last access to site</td>
                    </tr>
                    <tr>
                        <td>10 November 2022, 2:51 AM 
                        (now)</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Edit Details button -->
        <div class="edit-details">
            <button type="button" class="btn-edit" onclick="window.location.href='editProfile.php'">Edit Details</button>
        </div>
    </div>

    <!-- OTP Box -->
    <div class="otp-box">
        
    </div>

    <!-- Footer -->
    <!-- <?php 
        require_once('footer.php');
    ?> -->

</body>
</html>