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
    <title>Document</title>
</head>

<body>
    <?php
    if(isset($_POST['request'])){
        $request = $_POST['request'];
        $sql = "SELECT courseId from course where courseName = '$request'";
        $result = mysqli_query($connection,$sql);

        $count = 0;

        if($result == true)
        {
            $sql2 = "SELECT * from student, student_course where student_course.phoneNumber==student.phoneNumber and student_course.courseId = '$result'";
            $result2 = mysqli_query($connection,$sql2);

            $count = mysqli_num_rows($result2);
        } 
    }
    ?>

    <table class="studentDetails">
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
        </tbody>
    </table>
</body>


</html>