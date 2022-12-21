<!DOCTYPE html>
<html>
<head>
  <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="src/assets/css/global.css">
</head>
<body>

    <div class="navbar" id="navId">
        <div class="nav-left">
            <img class="navbar-logo" src="src\assets\images\icon.png">
        </div>
        <div class="nav-right">
            <div class="nav-links">
                <p onclick="window.location.href='editProfile.php'">Dashboard</p>
                <p onclick="window.location.href='editProfile.php'">Student</p>
                <p onclick="window.location.href='editProfile.php'">Course</p>
                <p onclick="window.location.href='editProfile.php'">My Courses</p>
            </div>
            <div class="nav-user-tray">
                <p><i class="fa-regular fa-bell"></i></p>
                <p><i class="fa-solid fa-circle-user"></i></p>
                <!-- <p><?php echo $_SESSION['name']; ?></p> -->
            </div>

        </div>
    </div>

</body>
</html>