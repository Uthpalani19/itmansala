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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/teacher-style.css">
</head>

<body>
    <?php
        if(isset($_POST['input'])){  
            $input = $_POST['input'];

                // $sql = "SELECT DISTINCT sc.phoneNumber, sc.lastaccesstime, s.name, s.email, s.profilePicture FROM student_course sc
                //         INNER JOIN course c ON sc.courseID = c.courseID 
                //         INNER JOIN student s ON sc.phoneNumber = s.phoneNumber
                //         WHERE c.teacherPhoneNumber = '{$_SESSION['phone']}' AND c.courseName = '{$_POST['request']}'";
            

            {
                    if(empty($input)){
                        $sql = "SELECT DISTINCT sc.phoneNumber, sc.enrolmentDateTime, s.name, s.email, s.profilePicture FROM student_course sc
                        INNER JOIN course c ON sc.courseID = c.courseID 
                        INNER JOIN student s ON sc.phoneNumber = s.phoneNumber
                        WHERE c.teacherPhoneNumber = '{$_SESSION['phone']}'";
                    }
                    else{
                        $sql = "SELECT DISTINCT sc.phoneNumber, sc.enrolmentDateTime, s.name, s.email, s.profilePicture FROM student_course sc
                        INNER JOIN course c ON sc.courseID = c.courseID 
                        INNER JOIN student s ON sc.phoneNumber = s.phoneNumber
                        WHERE c.teacherPhoneNumber = '{$_SESSION['phone']}' AND s.name LIKE '%{$input}%' GROUP BY sc.phoneNumber";
                    }
                }
                $result = mysqli_query($connection, $sql);

                if(mysqli_num_rows($result) > 0)
                {
                    ?>
                    <table class="tableStudent" id="student-details">
                        <thead>
                            <tr>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Enrollment Status</th>
                                <th>Last logged in date & time</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    $enrolstatus = 'Enrolled';

                                    echo '
                                        <tr>
                                            <td><i class="fa-regular fa-user fa-lg"></i></td>
                                            <td>'.$row['name'].'</td>
                                            <td>'.$row['phoneNumber'].'</td>
                                            <td>'.$row['email'].'</td>
                                            <td id="status">'.$enrolstatus.'</td>
                                            <td>'.$row['enrolmentDateTime'].'</td>
                                        </tr>
                                    ';
                                }
                            ?>
                        </tbody>
                    </table>

                    <?php
                }
                else
                {?>
                    <div class="no-results-found"></div>
                    <?php
                }
            }
        
    ?>
</body>
</html>
