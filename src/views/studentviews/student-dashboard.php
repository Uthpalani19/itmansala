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
                <?php
                    // Last time accessed
                    $sqlLastAccess = "SELECT lastAccessDate FROM student_course WHERE phoneNumber = '{$_SESSION['studentphone']}' ORDER BY lastAccessDate DESC LIMIT 1";
                    $resultLastAccess = mysqli_query($connection,$sqlLastAccess);
                    $dataLastAccess = mysqli_fetch_assoc($resultLastAccess);
                    $lastAccessDate = $dataLastAccess['lastAccessDate'];

                    // First time accessed
                    $sqlFirstAccess = "SELECT enrolmentDateTime FROM student_course WHERE phoneNumber = '{$_SESSION['studentphone']}' ORDER BY enrolmentDateTime ASC LIMIT 1";
                    $resultFirstAccess = mysqli_query($connection,$sqlFirstAccess);
                    $dataFirstAccess = mysqli_fetch_assoc($resultFirstAccess);
                    $firstAccessDate = $dataFirstAccess['enrolmentDateTime'];

                    // Get only the date
                    $lastAccessDate = substr($lastAccessDate, 0, 10);
                ?>
                <h2><?php echo $lastAccessDate; ?></h2>
                <h5>Last accessed date </h5>
            </div>

            <!-- Getting enrolled number of courses -->
            <?php
                $sqlNoofCourses = "SELECT count(*) as total from student_course where phoneNumber = '{$_SESSION['studentphone']}' and status = '1'";
                $resultNoofCourses = mysqli_query($connection,$sqlNoofCourses);
                $dataNoofCourses = mysqli_fetch_assoc($resultNoofCourses);
            ?>
            <div class="header-box">
                <h2><?php 
                    if($dataNoofCourses['total']<=9)
                    {
                        echo "0".$dataNoofCourses['total'];
                    }
                    else
                    {
                        echo $dataNoofCourses['total'];
                    }
                    ?></h2>
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
                ?>
                <div class="header-box">
                <h2><?php 
                    if($studentRank<=9)
                    {
                        echo "0".$studentRank;
                    }
                    else
                    {
                        echo $studentRank;
                    }
                    ?></h2>
                <h5>Overall Rank score</h5>
                </div>

            <!-- Number of quizzes attempted -->
            <?php
                $sqlNoofquizzes = "SELECT count(*) as total from student_modelpaperquiz where phoneNumber = '{$_SESSION['studentphone']}'";
                $resultNoofquizzes = mysqli_query($connection,$sqlNoofquizzes);
                $dataNoofquizzes = mysqli_fetch_assoc($resultNoofquizzes);
            ?>
            <div class="header-box">
                <h2><?php 
                    if($dataNoofCourses['total']<=9)
                    {
                        echo "0".$dataNoofCourses['total'];
                    }
                    else
                    {
                        echo $dataNoofCourses['total'];
                    }
                    ?></h2>
                <h5>Quizzes Attempted</h5>
            </div>
        </div>

        <!-- Progress bar -->
        <div class="dboard-header-container2">
            <div class="header-box2">
                <div class="progress-bar">
                    <div class="progress-bar-completed" style="width:<?php 
                        // Count of subtopics of enrolled courses
                        $sqlSubtopics = "SELECT count(*) as total from subtopic s,student_course sc where s.courseID = sc.courseID and sc.phoneNumber = '{$_SESSION['studentphone']}' and sc.status = '1'";
                        $resultSubtopics = mysqli_query($connection,$sqlSubtopics);
                        $dataSubtopics = mysqli_fetch_assoc($resultSubtopics);

                        // Completed count of subtopics
                        $sqlCompletedSubtopics = "SELECT count(*) as total from student_subtopic where phoneNumber = '{$_SESSION['studentphone']}' and status = '1'";
                        $resultCompletedSubtopics = mysqli_query($connection,$sqlCompletedSubtopics);
                        $dataCompletedSubtopics = mysqli_fetch_assoc($resultCompletedSubtopics);

                        // Progress percentage
                        $progress = round(($dataCompletedSubtopics['total']/$dataSubtopics['total'])*100);
                        echo $progress;
                    ?>%"></div>
                </div>
                <div class="progress-text">
                    <p><?php echo $progress; ?>% completed from what you bought so far</p>
                </div>
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
    <div id="leaderboard">
        
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