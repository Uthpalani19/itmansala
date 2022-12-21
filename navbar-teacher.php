<!DOCTYPE html>
<html>
<head>
  <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/global.css">

</head>
<body>

    <div class="navbar" id="navId">
        <div class="nav-left">
            <img class="navbar-logo" src="img/icon.png">
        </div>
        <div class="nav-right">
            <div class="nav-links">
                <p onclick="window.location.href='dashboard-teacher.php'">Dashboard</p>
                <p onclick="window.location.href='teacher-studentview.php'">Student</p>
                <p onclick="window.location.href='teacher-courses.php'">Course</p>
                <p onclick="window.location.href='editCourseContent.php'">My Courses</p>
            </div>
            <div class="nav-user-tray">
                <p><i class="fa-regular fa-bell"></i></p>
                <p onclick="window.location.href='viewProfile.php'"><i class="fa-solid fa-circle-user"></i></p>
                <p id="logout"><?php echo $_SESSION['firstname']; ?></p>
            
                <!-- Logout button -->
                <div class="hidden" id="hidden">
                    <p><i id="close" class="fa-solid fa-xmark"></i></p>
                    <p><i class="fa-solid fa-circle-user user2"></i></p>
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