<?php 
    // Navigation Bar
    session_start();
    require_once('../../assets/includes/navbar-student.php');
    require('../../config/dbconnection.php');

  if (!isset($_SESSION['studentname'])) {
  	header('location: ../../student_login.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../assets/css/global.css" >
    <link rel="stylesheet" href="../../assets/css/style3.css" >
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" 
    integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body>
    <div class="dboard-header">
        <!-- Static data -->
        <div class="dboard-header-container1">
            <div class="header-box">
                <h2>_ _ </h2>
                <h5>Total time spent</h5>
            </div>

            <!-- Getting enrolled number of courses -->
            <?php
                $sqlNoofCourses = "SELECT count(*) as total from student_course where phoneNumber = '{$_SESSION['studentphone']}' and status = '1'";
                $resultNoofCourses = mysqli_query($connection,$sqlNoofCourses);
                $dataNoofCourses = mysqli_fetch_assoc($resultNoofCourses);
            ?>
            <div class="header-box">
                <h2><?php echo $dataNoofCourses['total']; ?></h2>
                <h5>Courses enrolled</h5>
            </div>

            <!-- Getting rank score -->
            <?php
                $sqlRank = "SELECT phoneNumber, AVG(marks) AS average_marks, RANK() OVER (ORDER BY AVG(marks) DESC) AS rank FROM student_modelpaperquiz GROUP BY phoneNumber;";
                $resultRank = mysqli_query($connection, $sqlRank);
                $studentRank = 0;
                
                while ($rowRank = mysqli_fetch_assoc($resultRank)) {
                    if ($rowRank['phoneNumber'] == $_SESSION['studentphone']) {
                        $studentRank = $rowRank['rank'];
                    }
                }
                
                echo "<div class='header-box'>";
                echo "<h2>" . $studentRank . "</h2>";
                echo "<h5>Rank score</h5>";
                echo "</div>";
            ?>
           
        </div>

        <!-- Progress bar -->
        <div class="dboard-header-container2">
            <div class="header-box2">
                <div class="box-progressbar"></div>
                <div class="box-progressbar2"></div>

                <div>
                    <h3>Total Status</h3>
                </div> 
            </div>
            <div>
                <h5>75 % completed on what you bought so far. This is not done yet. </h5>
            </div>
        </div>
    </div>

    <!-- Courses student does -->
    <?php
        // Getting the course name from the database
        $sql_dropdown = "SELECT c.courseName from course c,student_course sc where c.courseID = sc.courseID and sc.phoneNumber = '{$_SESSION['studentphone']}' and sc.status = '1'";
        $result_dropdown = mysqli_query($connection,$sql_dropdown);

        // Dropdown content
        if(mysqli_num_rows($result_dropdown) > 0)
        {?>
            <div id="filters">
            <select id="courses" class="courseName dropdown-courses">
            <option value="" disabled="" selected="">Select your course </option>
        <?php
            while($row = mysqli_fetch_assoc($result_dropdown))
            {
        ?>
            <option value="<?php echo $row['courseName']; ?>"> <?php echo $row['courseName'];?> </option>
        <?php
            }
        ?>
            </select>
        </div>
        <?php
        }
        else
        {
            echo '<a href="#">No Courses</a>';
        }
    ?>

    <!-- Course content -->
    <div class="dboard-middle-container">
        <div class="middle-conatiner-heading">
            <h4>Activity</h4>
            <br>
        </div>

        <div class="middle-conatiner-content">
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

            <!-- Leaderboard -->
            <div class="middle-conatiner-piechart">
                <div class="pie-chart-header">
                    <h4 class="graph-header">Leaderboard</h4>
                </div>
                <div>
                    <table id="leaderboard">
                        <tr>
                            <th>Rank</th>
                            <th>Profile Picture</th>
                            <th>Name</th>
                            <th>Average</th>
                        </tr>
                        <?php
                            $sqlLeaderboard = "SELECT phoneNumber, AVG(marks) AS average_marks, RANK() OVER (ORDER BY AVG(marks) DESC) AS rank FROM student_modelpaperquiz GROUP BY phoneNumber;";
                            $resultLeaderboard = mysqli_query($connection, $sqlLeaderboard);
                            $studentRank = 0;
                            
                            while ($rowLeaderboard = mysqli_fetch_assoc($resultLeaderboard)) {
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
                </div>
            </div>
        </div>
        <div class="middle-conatiner-piechart">
                <div class="pie-chart-header">
                    <h4 class="std-bargrapgh-head">Overall Question Analysis</h4>
                </div>

                <div class="pie-chart-container">
                        <!-- <div class="pie-chart-description">
                            <h5>90 % answers are Correct</h5>
                            <h5>10 % answers are Wrong</h5>
                        </div> -->

                    <div class="pie-chart-dboard">
                        <canvas id="myChart2" style=""></canvas>
                    </div>
                    
                </div>
            
            </div>
    </div>

    <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
<script >
    $(document).ready(function(){
            $("#courses").on('change',function(){
                var value = $(this).val();

                $.ajax({
                    url: '../../config/studentconfig/leaderboard-coursewise.php',
                    type: 'POST',
                    data: 'request='+value,
                    beforeSend: function(){
                        $('#leaderboard').html('<img src="../../assets/images/loading.gif" alt="loading" id="loading">');
                    },
                    success: function(data){
                        $('#leaderboard').html(data);
                    }
                });
            });
    });
</script>
</body>
</html>