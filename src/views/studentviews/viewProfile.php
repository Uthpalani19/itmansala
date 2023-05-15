<?php 
  session_start(); 
  require('../../config/dbconnection.php');
  include('../../config/studentconfig/editProfile.config.php');
  

  if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
  }

  if (!isset($_SESSION['studentname'])) {
  	header('location: ../../student_login.php');
  }

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['studentname']);
    header("location: ../../student_login.php");
 }

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
<?php include('../../assets/includes/navbar-student.php') ?>

<?php 
    $user = getUserById($_SESSION['studentphone'], $connection); 
?>

    
    <div class="container-profile">
        <div class="profilepicture">
            <?php
                $ppicture = $user['profilePicture'];
                if(!$ppicture){
                ?>
                    <img src='../../assets/images/user.jpg' class='rounded-circle' width='150'>
                <?php
                }
                else{
                ?>
                    <img src='<?php echo $ppicture ;?>' class='rounded-circle' width='150'>
                <?php
                }
            ?>
            
        </div>

        <div class="student-details">
            <div class="student-name">
                <p id="student-name"> <?php echo $user['name'];?></p>
            </div>

            <div class = "std-details">
                <p id="student-details"></p>
            </div>
        </div>
    </div>

    <!-- Student Details -->

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