<?php 
    // Navigation Bar
    session_start();
    require_once('../../assets/includes/navbar-teacher.php');
    require('../../config/dbconnection.php');
    include('../../config/teacherconfig/editProfile.config.php');

    if(!isset($_SESSION['name']))
    {
        header('location: ../../student_login.php');
    }

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
<?php $user = getUserById($_SESSION['phone'], $connection); ?>
    
    <div class="container-profile">
        <div class="profilepicture">
            
            <img src="<?php echo $user['teacherImage'];?>" class="rounded-circle" width="150">
        </div>

        <div class="student-details">
            <div class="student-name">
                <p id="student-name"> <?php echo $user['name'];?></p>
            </div>

            <div class = "std-details">
               
            </div>
        </div>
    </div>

    <div class="user-container">
        <div class="user-details">
                <div class="user-details-head">
                    <h3>User Details</h3>
                </div>

                <div class="user-details-row1">
                    E-mail
                </div>

                <div class="user-details-row2">
                    <?php echo $user['email'];?>
                </div>
                    

                <div class="user-details-row1">
                    Telephone Number
                </div>

                <div class="user-details-row2">
                    <?php echo $user['phoneNumber'];?>
                </div>
        </div>

        <div class="user-details">
                <div class="user-details-head">
                    <h3>Login Activity</h3>
                </div>

                <div class="user-details-row1">
                    First access to site
                </div>

                <div class="user-details-row2">
                    13 May 2022, 9:50 AM (180 days 17 hours)
                </div>
                    

                <div class="user-details-row1">
                    Last access to site
                </div>

                <div class="user-details-row2">
                    10 November 2022, 2:51 AM (now)
                </div>
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