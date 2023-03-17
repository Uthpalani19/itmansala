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
    <form method="POST" action="">
        <input type="text" name="input" placeholder="Search by name...">
        <input type="submit" value="Search">
    </form>

    <?php
        if(isset($_POST['input'])){
            $input = $_POST['input'];

            if(empty($input)){
                $sql = "SELECT DISTINCT sc.phoneNumber, sc.lastaccesstime, s.name, s.email, s.profilePicture FROM student_course sc
                INNER JOIN course c ON sc.courseID = c.courseID 
                INNER JOIN student s ON sc.phoneNumber = s.phoneNumber
                WHERE c.teacherPhoneNumber = '{$_SESSION['phone']}'";
            }else{
                $sql = "SELECT DISTINCT sc.phoneNumber, sc.lastaccesstime, s.name, s.email, s.profilePicture FROM student_course sc
                INNER JOIN course c ON sc.courseID = c.courseID 
                INNER JOIN student s ON sc.phoneNumber = s.phoneNumber
                WHERE c.teacherPhoneNumber = '{$_SESSION['phone']}' AND s.name LIKE '%{$input}%'";
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
                                        <td><img src="../../assets/images/profile/'.$row['profilePicture'].'" alt="profile" id="profile"></td>
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

                <?php
            }
            else
            {
                echo "No result found";
            }
        }
        
    ?>
</body>
</html>
