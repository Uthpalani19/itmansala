<!DOCTYPE html>
<html>
<head>
  <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../css/global.css">

</head>
<body>

    <div class="navbar" id="navId">
        <div class="nav-left">
            <img class="navbar-logo" src="../../assets/images/icon.png">
        </div>
        <div class="nav-right">
            <div class="nav-links">
                <p onclick="window.location.href='../../views/teacherviews/dashboard-teacher.php'">Dashboard</p>
                <p onclick="window.location.href='../../views/teacherviews/teacher-studentview.php'">Student</p>
                <p onclick="window.location.href='../../views/teacherviews/addcourse.php'">Course</p>
            </div>
            <div class="nav-user-tray">
                <p><i class="fa-regular fa-bell"></i></p>
                <p id="logout"><i class="fa-solid fa-circle-user"></i></p>
            
                <!-- Logout button -->
                <div class="hidden" id="hidden">
                    <p><i id="close" class="fa-solid fa-xmark"></i></p>
                    <p><i class="fa-solid fa-circle-user user2"></i></p>
                    <p><?php echo $_SESSION['name']; ?></p>
                    <a href="viewProfile.php">My Profile</a><br><br>
                    <a href="dashboard-teacher.php?logout='1'">Logout</a>
                </div>
            </div>

        </div>
    </div>
    <script>
    const logout = document.getElementById("logout");
    const hidden = document.getElementById("hidden");
    const close = document.getElementById("close");

    logout.onclick = function(){
        hidden.style.display = "block";
    }

    close.onclick = function(){
        hidden.style.display = "none"
    }
  </script>
</body>
</html>