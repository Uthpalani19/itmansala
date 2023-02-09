<?php 
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