<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Teacher Details </title>
    <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href = "css/viewTeachers.css">
</head>

<body>
    <!-- Navigation Bar -->
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

    <!-- Search Teacher -->
    <div class="container">
        <div class="container-item"><h4>4 teachers</h4></div>
        <div class="container-item">
            <form>
            <p><input type="text" placeholder="Search Teachers"  class="search-bar">
                <button input type="submit"> Search </button></p>
            </form>
        </div>
    </div>


    <!-- Table Content -->
    <div class="content">
        <table>
            <tr>
              <th>Phone Number</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Teacher Image</th>
              <th>Field of Expertise</th>
              <th>Status</th>
              <th>Edit</th>
            </tr>

            <!-- PHP code -->
            <?php
                require_once 'dbconnection.php';

                $sql = "SELECT phoneNumber,firstName,lastName,teacherImage,fieldOfExpertise,status from teacher";
                $result = mysqli_query($connection,$sql);

                while($row = mysqli_fetch_assoc($result))
                {
                    echo '
                        <tr>
                            <td>'.$row['phoneNumber'].'</td>
                            <td>'.$row['firstName'].'</td>
                            <td>'.$row['lastName'].'</td>
                            <td>'.$row['teacherImage'].'</td>
                            <td>'.$row['fieldOfExpertise'].'</td>
                            <td>'.$row['status'].'</td>
                            <td><i class="fa-solid fa-file-pen" id="edit-icon"></i></td>
                        </tr>
                    ';
                }
            ?>
        </table>
    </div>

    <button class="addTeacher"> <a href="addTeacher.php">Add new teacher</a> </button>

    

</body>
</html>