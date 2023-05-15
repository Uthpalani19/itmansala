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
    <div class="dboard-middle-container">
        <div class="middle-conatiner-heading">
            <h4>Your performance</h4>
            <br />
        </div>

        <div class="middle-conatiner-content">
            <!-- Bargraph -->
            <div class="middle-conatiner-bargraph">
                        <div class="std-bargrapgh-head">
                            <h4>Active hours in a Day</h4>
                        </div>

                        <div class="std-bargrapgh-body">
                            <!-- <div class="std-bargraph">
                            <canvas id="myChart" style=""></canvas>
                            </div> -->

                            <!-- Statistics about the student_course -->
                            <div class="grpah-progress-cards">
                                <div class="grpah-progress-card">
                                    <h4>Time spent</h4>
                                    <div class="progress-card-body">
                                        <h2>_ _</h2>
                                    </div>
                                </div>

                                <div class="grpah-progress-card">
                                    <h4>Quizes Taken</h4>
                                    <div class="progress-card-body">
                                        <h2><?php
                                            $sql = "SELECT count(*) from student_modelpaperquiz where phoneNumber = '{$_SESSION['studentphone']}'"; 
                                            $result = mysqli_query($connection, $sql);
                                            $row = mysqli_fetch_assoc($result);
                                            
                                            echo $row['count(*)'];
                                            ?>
                                        </h2>
                                    </div>
                                </div>

                                <div class="grpah-progress-card">
                                    <h4>Avg Mark</h4>
                                    <div class="progress-card-body">
                                        <h2>
                                            <?php
                                                $sql = "SELECT avg(marks) from student_modelpaperquiz where phoneNumber = '{$_SESSION['studentphone']}' group by phoneNumber"; 
                                                $result = mysqli_query($connection, $sql);
                                                $row = mysqli_fetch_assoc($result);
                                                
                                                echo round($row['avg(marks)']);
                                                ?>
                                        </h2>
                                    </div>
                                <div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of bargraph -->

            <!-- Leaderboard -->
            <div class="middle-container-leaderboard">
                <table>
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
                        echo "<td><i class='fa-solid fa-circle-user'></i></td>";
                        echo "<td>" . $rowLeaderboardName['name'] . "</td>";
                        echo "<td>" . $rowLeaderboard['average_marks'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <!-- End of the leaderboard -->
        </div>
    <?php
    }
    ?>
</body>
</html>
