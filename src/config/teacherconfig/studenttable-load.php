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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href = "../../assets/css/global.css">

    <link rel="stylesheet" href = "../../assets/css/teacher-style.css">
</head>

<body>
    <?php
    if(isset($_POST['request'])){
        $request = $_POST['request'];
        $sql = "SELECT * FROM course WHERE courseName = '$request'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);

        if($row['courseId'] > 0)
        {
            $count = 0;

            $sql2 = "SELECT * FROM student INNER JOIN student_course ON student_course.phoneNumber = student.phoneNumber WHERE student_course.courseId = '{$row['courseId']}'";
            $result2 = mysqli_query($connection, $sql2);
            if (!$result2) {
                die("Error retrieving data: " . mysqli_error($connection));
            }
            $count = mysqli_num_rows($result2);
        }    
    }
    ?>

    <table class="tableStudent">
        <?php
            if($count)
            {
        ?>
        <thead>
            <tr>
                <th>Profile</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Enrollment Status</th>
                <th>Last logged in date & time</th>
            </tr>

            <?php
            }
            else
            {
                echo "No students enrolled in this course";
            }
            ?>
        </thead>

        <tbody>
            <?php
                while($row = mysqli_fetch_assoc($result2)){
                    
                    $enrolstatus = 'Enrolled';
                        echo '
                            <tr>
                                <td><i class="fa-regular fa-user fa-lg"></i></td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['phoneNumber'].'</td>
                                <td>'.$row['email'].'</td>
                                <td id="status">'.$enrolstatus.'</td>
                                <td>'.$row['lastaccesstime'].'</td>
                            </tr>
                        ';
                }
                ?>
        </tbody>
    </table>
</body>


</html>