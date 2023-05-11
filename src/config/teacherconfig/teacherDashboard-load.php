<?php 
    // Navigation Bar
    session_start();
    require_once('../../assets/includes/navbar-teacher.php');
    require('../../config/dbconnection.php');

    if(!isset($_SESSION['name']))
    {
        header('location: ../../student_login.php');
    }

    if(isset($_GET['logout']))
    {
        session_destroy();
        unset($_SESSION['name']);
        header('location: ../../student_login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/global.css"></link>
    <link rel="stylesheet" href="../../assets/css/teacher-style.css"></link>
    <title>Dashboard - Teacher </title>
</head>

<body>
    <?php
        if(isset($_POST['request']))
        {
            ?>
            <!-- Static Data -->
            <div class="static_data_container" id="top-header-data">
                <!-- Stat -->
                <div class="static_data" >
                    <div class="static_data_item">
                        <div class="static_data_item_value"><?php $sqlTotalSubtopics = "SELECT COUNT(*) from subtopic where courseName='".$_POST['request']."'";
                                                                $resultTotalSubtopic = mysqli_query($connection,$sqlTotalSubtopics);
                                                                $rowTotalSubtopic = mysqli_fetch_array($resultTotalSubtopic);
                                                                echo $rowTotalSubtopic['COUNT(*)'];
                                                                ?></div>
                        <div class="static_data_item_title">Total Subtopics</div>
                    </div>
                    <!-- <div class="static_data_item">
                    <div class="static_data_item_value"><?php $sqlLessons = "SELECT COUNT(*) from lesson where courseName='".$_POST['request']."'";
                                                                $resultLessons = mysqli_query($connection,$sqlLessons);
                                                                $rowLessons = mysqli_fetch_array($resultLessons);
                                                                echo $rowLessons['COUNT(*)'];
                                                                ?></div>
                        <div class="static_data_item_title">Total Lessons</div>
                    </div>
                    <div class="static_data_item">
                    <div class="static_data_item_value"><?php $sqlQuestions = "SELECT COUNT(*) from modelpaperquestion";
                                                                $resultQuestions = mysqli_query($connection,$sqlQuestions);
                                                                $rowQuestions = mysqli_fetch_array($resultQuestions);
                                                                echo $rowQuestions['COUNT(*)'];
                                                                ?></div>
                        <div class="static_data_item_title">Total Questions</div>
                    </div> -->
                </div>
            </div>
            <?php
        }
    ?>
</body>

</html>