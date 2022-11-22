<!DOCTYPE html>
<html>
<head>
  <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/viewStudents.css">
</head>
<body>

<!--Navigation Bar-->

    <div class="navbar" id="navId">
        <div class="nav-left">
            <img class="navbar-logo" src="img/icon.png">
        </div>
        <div class="nav-right">
            <div class="nav-links">
                <p>Dashboard</p>
                <p>Payments</p>
                <p>Teacher</p>
                <p>Student</p>
                <p>Course</p>
            </div>
            <div class="nav-user-tray">
                <p><i class="fa-regular fa-bell"></i></p>
                <p><i class="fa-solid fa-circle-user"></i></p>
                <p>Admin</p>
                
            </div>

        </div>
    </div>

<!--Search Box-->

    <div class="container">
        <div class="container-item"><h4>4 Students</h4></div>
        <div class="container-item">
            <form>
                <p><input type="text" placeholder="Search Students"  class="search-bar">
                <button input type="submit"> Search </button></p>
            </form>
        </div>
    </div>

<!-----Table Content------>
    <div class="content">
        <table>
            <tr>
              <th>Contact</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Status</th>
              <th>Courses</th>
            </tr>

        </table>

        
    </div>
    

</body>
</html>