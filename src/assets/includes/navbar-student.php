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
                <p onclick="window.location.href='../../views/studentviews/mycourses.php'">My Courses</p>
                

            </div>
            <div class="nav-user-tray">
                <?php
                    if(!empty($_SESSION['cart'])){
                ?>
                <p><i class="fa-solid fa-circle cartactive"></i></p>
                <?php
                    }
                ?>
                <p 
                <?php
                    if(!empty($_SESSION['cart'])){
                ?>
                onclick="window.location.href='../../views/studentviews/cartSudentView.php'"
                <?php
                    }
                ?>
                ><i class="fas fa-shopping-cart"></i></p>
                <p><i class="fa-regular fa-bell"></i></p>
                <p><i id="logout" class="fa-solid fa-circle-user"></i></p>
                <div class="hidden" id="hidden">
                    <p><i id="close" class="fa-solid fa-xmark"></i></p>
                    <p><i class="fa-solid fa-circle-user user2"></i></p>
                    <p><?php echo $_SESSION['studentname']; ?></p>
                    <a href="">My Profile</a><br><br>
                    <a href="availablecourses.php?logout='1'">Logout</a>
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
</body>
</html>