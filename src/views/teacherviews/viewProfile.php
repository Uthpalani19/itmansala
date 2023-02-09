<?php 
    // Navigation Bar
    require_once('../../assets/includes/navbar-teacher.php');
    session_start();
    require('../../config/dbconnection.php');

    if(!isset($_SESSION['name']))
    {
        header('location:index.php');
    }

    if(isset($_GET['logout']))
    {
        session_destroy();
        unset($_SESSION['name']);
        header('location:index.php');
    }

    // Retrieve email address of the current user
?>

<!-- Navigation Bar -->
<?php 
    require_once('../../assets/includes/navbar-teacher.php');
?>

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

    <!-- Student main details -->
    <div class="container-profile">
        <div class="profilepicture">
            <img src="../../assets/images/propic.jpg" class="rounded-circle" width="150">
        </div>

        <div class="student-details">
            <div class="student-name">
                <p id="student-name"> <?php echo $_SESSION['name'] ?></p>
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
                    <td><?php echo $_SESSION['email']; ?></td>
                </tr>
                <tr>
                    <td>Telephone Number</td>
                </tr>
                <tr>
                    <td> 0<?php echo $_SESSION['contact']; ?></td>
                </tr>
                <tr>
                    <td>Field of expertise</td>
                </tr>
                <tr>
                    <td id="last-row"><?php echo $_SESSION['fieldofexpertise']; ?></td>
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

    <!-- Footer -->
    <!-- <?php 
        require_once('footer.php');
    ?> -->

</body>
</html>