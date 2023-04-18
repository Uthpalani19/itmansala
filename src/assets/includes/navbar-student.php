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
                <p onclick="window.location.href='../../views/studentviews/student-dashboard.php'">Dashboard</p>
                <p onclick="window.location.href='../../views/studentviews/availablecourses.php'">Course</p>
                <p onclick="window.location.href='editProfile.php'">My Courses</p>
                

            </div>
            <div class="nav-user-tray">
                <p onclick="window.location.href='../../views/studentviews/cartSudentView.php'"><i class="fas fa-shopping-cart"></i></p>
                <p class="cart-count" id="cart-count">0</p>
                <p><i class="fa-regular fa-bell"></i></p>
                <p><i class="fa-solid fa-circle-user"></i></p>
                <!-- <p><?php echo $_SESSION['name']; ?></p> -->
            </div>

        </div>
    </div>

    <script src ="student.js">
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
</body>
</html>