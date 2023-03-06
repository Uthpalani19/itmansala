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

    include('../../config/dbconnection.php');
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

    <div class="container">
        <div class="container-item">
            <div class="search-bar-course">
                <!-- Search Teacher -->
                <?php
                    // Getting the course name from the database
                    $sql_dropdown = "SELECT courseName from course where teacherPhoneNumber = '$_SESSION[phone]'";
                    $result_dropdown = mysqli_query($connection,$sql_dropdown);
                ?>
                    <!-- dropdown -->
                    <div class="dropdown">
                    <button class="dropbtn">Select <i class="fa fa-sort-desc" aria-hidden="true"></i></button>
                        <div class="dropdown-content">

                            <!-- Dropdown content -->
                            <?php
                                if(mysqli_num_rows($result_dropdown) > 0)
                                {
                                    while($row = mysqli_fetch_assoc($result_dropdown))
                                    {
                                        echo '<a>'.$row['courseName'].'</a>';
                                    }
                                }
                                else
                                {
                                    echo '<a href="#">No Courses</a>';
                                }
                            ?>
                        </div>

                    </div>
                        <?php 
                        // Getting the course ID from the database
                            $courseID = 'C001';
                        ?>
                    

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
              <th>Profile</th>
              <th>Name</th>
              <th>Phone Number</th>
              <th>Email</th>
              <th>Enrollment Status</th>
              <th>Last logged in date & time</th>
            </tr>

            <!-- PHP code -->
            <?php
                require_once '../../config/dbconnection.php';

                $sql = "SELECT profilePicture, phoneNumber,name,email from student";
                $result = mysqli_query($connection,$sql);

                while($row = mysqli_fetch_assoc($result))
                {
                    $phoneNumber = $row['phoneNumber'];
                     // check if the student is enrolled in the course
                    $sql_enrolstatus = "SELECT * from student_course where phoneNumber = '$phoneNumber' && courseId = '$courseID'";
                    $result2 = mysqli_query($connection,$sql_enrolstatus);

                    if(mysqli_num_rows($result2) > 0)
                    {
                        $enrolstatus = 'Enrolled';
                    }
                    else
                    {
                        $enrolstatus = 'Not Enrolled';
                    }
                    echo '
                        <tr>
                            <td><img src="../../assets/images/profile/'.$row['profilePicture'].'" alt="profile" id="profile"></td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['phoneNumber'].'</td>
                            <td>'.$row['email'].'</td>
                            <td id="status">'.$enrolstatus.'</td>
                            <td>2023-02-01 12:00:00</td>
                        </tr>
                    ';
                }
            ?>
        </table>
    </div>

</body>
</html>