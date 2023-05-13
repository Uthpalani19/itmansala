<!-- Navigation Bar -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\..\assets\css\global.css"></link>
</head>
<body>
    
</body>
</html>
<div class="navbar" id="navId">
        <div class="nav-left">
            <img class="navbar-logo" src="..\..\assets\images\icon.png">
        </div>
        <div class="nav-right">
            <div class="nav-links">
                <p onclick="window.location.href='admin-dashboard.php'">Dashboard</p>
                <!-- <p onclick="window.location.href='payment.php'">Payments</p> -->
                <p onclick="window.location.href='viewTeachers.php'">Teacher</p>
                <p onclick="window.location.href='viewStudents.php'">Student</p>
                <p onclick="window.location.href='adminCourse.php'">Course</p>
                <p onclick="window.location.href='controls.php'">Controls</p>
            </div>
            <div class="nav-user-tray">
                <p><i class="fa-regular fa-bell"></i></p>
                <p id="logout"><i class="fa-solid fa-circle-user"></i></p>

                <!-- Logout button -->
                <div class="hidden" id="hidden">
                    <p><i id="close" class="fa-solid fa-xmark"></i></p>
                    <p><i class="fa-solid fa-circle-user user2"></i></p>
                    <p><?php echo $_SESSION['adminname']; ?></p>
                    <a href="Admin-dashboard.php?logout='1'">Logout</a>
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