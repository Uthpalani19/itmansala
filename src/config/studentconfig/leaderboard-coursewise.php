<?php 
    // Navigation Bar
    require_once('../../assets/includes/navbar-student.php');
    session_start();
    require('../../config/dbconnection.php');

    if(!isset($_SESSION['studentname']))
    {
        header('location:index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 1</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="../../assets/css/global.css" >
    <link rel="stylesheet" href="../../assets/css/style3.css" >
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" 
    integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>

<body>
    <?php
    if(isset($_POST['request'])){
    ?>
        <table class="leaderboard" id="leaderboard">
        <tr>
            <th>Rank</th>
            <th>Profile Picture</th>
            <th>Name</th>
            <th>Average</th>
        </tr>
        <?php
        $request = $_POST['request'];

        // Get course Id
        $sqlCourseId = "SELECT courseId FROM course WHERE courseName = '{$request}'";
        $resultCourseId = mysqli_query($connection, $sqlCourseId);
        $rowCourseId = mysqli_fetch_assoc($resultCourseId);
        $courseId = $rowCourseId['courseId'];

        $sqlLeaderboard = "SELECT phoneNumber, AVG(marks) AS average_marks, RANK() OVER (ORDER BY AVG(marks) DESC) AS rank FROM student_modelpaperquiz WHERE courseId='$courseId' GROUP BY phoneNumber ORDER BY average_marks DESC;";
        $resultLeaderboard = mysqli_query($connection, $sqlLeaderboard);
        $studentRank = 0;
                                
        while($rowLeaderboard = mysqli_fetch_assoc($resultLeaderboard)) {
            $sqlLeaderboardName = "SELECT * FROM student WHERE phoneNumber = '{$rowLeaderboard['phoneNumber']}'";
            $resultLeaderboardName = mysqli_query($connection, $sqlLeaderboardName);
            $rowLeaderboardName = mysqli_fetch_assoc($resultLeaderboardName);
            $studentRank = $rowLeaderboard['rank'];
            echo "<tr>";
            echo "<td>" . $studentRank . "</td>";
            echo "<td><img src='../../images/student/" . $rowLeaderboardName['profilePicture'] . "' alt='Profile Picture' class='leaderboard-profile-picture'></td>";
            echo "<td>" . $rowLeaderboardName['name'] . "</td>";
            echo "<td>" . $rowLeaderboard['average_marks'] . "</td>";
            echo "</tr>";
        }
        ?>
        </table>
    <?php
    }
    ?>
</body>
</html>
</table>