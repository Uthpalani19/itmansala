<?php
    session_start(); 

    if (!isset($_SESSION['name'])) {
  	    header('location: ../student_login.php');
    }
    if(isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['name']);
        header("location: ../student_login.php");
    }

    include('../../assets/includes/navbar-teacher.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Student Details </title>
    <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href = "../../assets/css/teacher-style.css">
    <link rel="stylesheet" href = "../../assets/css/global.css">
</head>

<body>
    <br />
    <!-- Search Teacher -->
    <div class="container">
        <div class="container-item">
            <div class="search-bar-course">
                <!-- dropdown -->
                <div class="dropdown1">
                    <button class="dropbtn">Select <i class="fa fa-sort-desc" aria-hidden="true"></i></button>
                    <div class="dropdown-content">
                        <a href="#">C001</a>
                        <a href="#">C002</a>
                        <a href="#">C003</a>
                    </div>
                </div>

                <!-- Search Bar -->
                <form class="searchBar">
                    <p><input type="text" placeholder="Search Students"  class="search-bar">
                    <button type="submit"><i class="fa-solid fa-search"></i></button></p>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Content -->
    <div class="content">
        <table>
            <tr>
              <th>Profile photo</th>
              <th>Name</th>
              <th>Phone Number</th>
              <th>Email</th>
            </tr>

            <!-- PHP code -->
            <?php
                require_once '../../config/dbconnection.php';

                $sql = "SELECT profilePicture, phoneNumber,name,email from student";
                $result = mysqli_query($connection,$sql);

                while($row = mysqli_fetch_assoc($result))
                {
                    echo '
                        <tr>
                            <td><img src="../../assets/images/profile/'.$row['profilePicture'].'" alt="profile" id="profile"></td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['phoneNumber'].'</td>
                            <td>'.$row['email'].'</td>
                        </tr>
                    ';
                }
            ?>
        </table>
    </div>

</body>
</html>