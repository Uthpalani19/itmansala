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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" 
    integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Dashboard - Teacher </title>
</head>

<body>
    <!-- Dropdown content -->
    <!-- Courses teacher teaches -->
    <?php
        // Getting the course name from the database
        $sql_dropdown = "SELECT courseName from course where teacherPhoneNumber = '{$_SESSION['phone']}' and status = '1'";
        $result_dropdown = mysqli_query($connection,$sql_dropdown);
    ?>

    <?php
        if(mysqli_num_rows($result_dropdown) > 0)
        {?>
            <div id="filters">
                <select id="courses" class="courseName course-dropdown">
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
    <!-- End of Courses teacher teaches -->

    <!-- Static Data -->
    <div id="test">
    <div class="static_data_container">
        <div class="static_data"> 
            <div class="static_data_item">
                <div class="static_data_item_value"><?php $sqlTotalCourses = "SELECT COUNT(*) from course where teacherPhoneNumber = '{$_SESSION['phone']}' and status = '1'";
                                                          $resultTotalCourses = mysqli_query($connection,$sqlTotalCourses);
                                                          $rowTotalCourses = mysqli_fetch_array($resultTotalCourses);
                                                          echo $rowTotalCourses['COUNT(*)'];
                                                          ?></div>
                <div class="static_data_item_title">Total Courses</div>
            </div>
            <div class="static_data_item">
                <div class="static_data_item_value"><?php $sqlTotalSubtopics = "SELECT COUNT(*) from subtopic";
                                                          $resultTotalSubtopic = mysqli_query($connection,$sqlTotalSubtopics);
                                                          $rowTotalSubtopic = mysqli_fetch_array($resultTotalSubtopic);
                                                          echo $rowTotalSubtopic['COUNT(*)'];
                                                          ?></div>
                <div class="static_data_item_title">Total Subtopics</div>
            </div>
            <div class="static_data_item">
                <div class="static_data_item_value"><?php $sqlLessons = "SELECT COUNT(*) from lesson";
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
            </div>
            <div class="static_data_item">
                <div class="static_data_item_value"><?php $sqlStudents = "SELECT COUNT(*) from student";
                                                          $resultStudents = mysqli_query($connection,$sqlStudents);
                                                          $rowStudents = mysqli_fetch_array($resultStudents);
                                                          echo $rowStudents['COUNT(*)'];
                                                          ?></div>
                <div class="static_data_item_title">Total Students</div>
            </div>
        </div>
    </div>
    </div>
    <!-- End of Static Data -->
    
    <!-- Instructions for the user -->
    <div class="instructions" id="instruction">
        <p>Choose a course from the above Drop down to see details</p>
        <img src="../../assets/images/nodatafound.png">
    </div>
    <!-- End of Instructions for the user -->


    <!-- Footer -->
    <?php
        // require_once('../../assets/includes/footer.php');
    ?>
    <!-- End of Footer -->
    <!-- Course Ajax -->
    <script >
        $(document).ready(function(){
                $("#courses").on('change',function(){
                    var value = $(this).val();

                    $.ajax({
                        url: '../../config/teacherconfig/staticData-dashboard.php',
                        type: 'POST',
                        data: 'request='+value,
                        beforeSend: function(){
                            $('#test').html('<img src="../../assets/images/loading.gif" alt="loading" id="loading">');
                        },
                        success: function(data){
                            $('#test').html(data);
                            $("#instruction").hide();
                        }
                    });
                });
        });
    </script>
</body>
</html>

