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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <title>Dashboard - Teacher </title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" 
    integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    if(isset($_POST['request']))
    {
        $request = $_POST['request'];
        
        // Get course id
        $sql_course_id = "SELECT courseId from course where courseName = '$request'";
        $result_course_id = mysqli_query($connection,$sql_course_id);
        $row_course_id = mysqli_fetch_array($result_course_id);
        $course_id = $row_course_id['courseId'];

        // Get subtopic id
        $sql_subtopic_id = "SELECT subtopicId from subtopic where courseId = '$course_id'";
        ?>
        <div class="static_data_container">
            <div class="static_data">
                    <div class="static_data_item">
                        <div class="static_data_item_value"><?php $sqlTotalSubtopics = "SELECT COUNT(*) from subtopic where courseId = '$course_id'";
                                                                $resultTotalSubtopic = mysqli_query($connection,$sqlTotalSubtopics);
                                                                $rowTotalSubtopic = mysqli_fetch_array($resultTotalSubtopic);
                                                                echo $rowTotalSubtopic['COUNT(*)'];
                                                                ?></div>
                        <div class="static_data_item_title">Total Subtopics</div>
                    </div>
                    <div class="static_data_item">
        
                        <div class="static_data_item_value">
                            <?php
                                // Get subtopic ids
                                $sql_subtopic_id = "SELECT subtopicId from subtopic where courseId = '$course_id'";
                                $result_subtopic_id = mysqli_query($connection,$sql_subtopic_id);
                                $row_subtopic_id = mysqli_fetch_assoc($result_subtopic_id);

                                $lessons = 0;
                                $questions = 0 ;
                                foreach($result_subtopic_id as $subtopic_id)
                                {
                                    $subtopic_id = $subtopic_id['subtopicId'];
                                    $sqlLessons = "SELECT COUNT(*) from lesson where subtopicId = '$subtopic_id'";
                                    $resultLessons = mysqli_query($connection,$sqlLessons);
                                    $rowLessons = mysqli_fetch_array($resultLessons);
                                    $lessons += $rowLessons['COUNT(*)'];

                                    $sqlQuestions = "SELECT COUNT(*) from modelpaperquestion where subtopicId = '$subtopic_id'";
                                    $resultQuestions = mysqli_query($connection,$sqlQuestions);
                                    $rowQuestions = mysqli_fetch_array($resultQuestions);
                                    $questions += $rowQuestions['COUNT(*)'];
                                }
                                echo $lessons;
                                                                ?>
                        </div>
                        <div class="static_data_item_title">Total Lessons</div>
                    </div>
                    <div class="static_data_item">
                        <div class="static_data_item_value"><?php
                                                                echo $questions;
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

        <!-- Middle pane -->
        <div class="container-main">
            <!-- Progress cards -->
            <div class="progress_container">
                <div class="progress">
                    <div class="progress_item">
                        <div class="progress_item_value">
                            <?php
                                $sqlAttempts = "SELECT COUNT(*) from student_modelpaperquiz where courseId = '$course_id'";
                                $resultAttempts = mysqli_query($connection,$sqlAttempts);
                                $rowAttempts = mysqli_fetch_array($resultAttempts);
                                echo $rowAttempts['COUNT(*)'];
                            ?>
                        </div>
                        <div class="progress_item_title">Quiz attempts</div>
                    </div>

                    <div class="progress_item">
                        <div class="progress_item_value">
                            <?php
                                $sqlAverage = "SELECT AVG(marks) from student_modelpaperquiz where courseId = '$course_id'";
                                $resultAverage = mysqli_query($connection,$sqlAverage);
                                $rowAverage = mysqli_fetch_array($resultAverage);
                                echo round($rowAverage['AVG(marks)'])/5*100 ."%";
                            ?>
                        </div>
                        <div class="progress_item_title">Average Mark</div>
                    </div>
                </div>

                <div class="progress">
                    <div class="new-enrollment-count">
                        <div class="new-enrollment-count-upper">
                            <div class="progress_item_value2">
                                <?php
                                     // Get the number of new students
                                    $sqlEnrollments = "SELECT count(*) from student_course where enrolmentDateTime >= DATE(NOW()) - INTERVAL 7 DAY and courseId = '$course_id'";
                                    $resultEnrollments = mysqli_query($connection, $sqlEnrollments);
                                    $rowEnrollments = mysqli_fetch_assoc($resultEnrollments);

                                    echo $rowEnrollments['count(*)'];
                                ?>
                            </div>
                            <div class="progress_item_title2">New enrollments <br> on this week</div>
                        </div>

                        <div class="new-enrollment-count-lower">
                                <?php
                                    // Get the number of new students last week
                                    $sqlEnrollmentsLastWeek = "SELECT count(*) from student_course where enrolmentDateTime >= DATE(NOW()) - INTERVAL 14 DAY and enrolmentDateTime < DATE(NOW()) - INTERVAL 7 DAY and courseId = '$course_id'";
                                    $resultEnrollmentsLastWeek = mysqli_query($connection, $sqlEnrollmentsLastWeek);
                                    $rowEnrollmentsLastWeek = mysqli_fetch_assoc($resultEnrollmentsLastWeek);

                                    if($rowEnrollmentsLastWeek['count(*)'] !=0 && $rowEnrollments['count(*)']!=0)
                                    {
                                        $percentage = round(($rowEnrollments['count(*)'] - $rowEnrollmentsLastWeek['count(*)'])*100/$rowEnrollmentsLastWeek['count(*)']);
                                    }
                                    else
                                    {
                                        $percentage = 0;
                                    }

                                    if($percentage < 0){
                                        ?>
                                        <div class="new-enrollment-count-lower"><?php echo $percentage.".00 %";?>
                                        <i class="fa-solid fa-down-long"></i> <br /> Compared to last week</div>
                                        <?php
                                    }
                                    elseif($percentage == 0)
                                    {
                                        ?>
                                        <div class="new-enrollment-count-similar"><?php echo $percentage.".00 %";?>
                                        <i class="fa-solid fa-equals"></i> <br /> Compared to last week</div>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="new-enrollment-count-upper"><?php echo $percentage.".00 %";?>
                                        <i class="fa-solid fa-up-long"></i> <br /> Compared to last week</div>
                                        <?php
                                    }  
                                ?>
                            </div>
                    </div>
                </div>
            </div>
            <!-- End of Progress cards -->

            <!-- Mark distribution graphs -->
            <!-- Create a canvas element for the scatter plot -->
            <div class="scatterplot">
                <canvas id="scatterChart"></canvas>
            </div>
            <?php

            // Retrieve data from database
            $sql = "SELECT *,avg(marks) as avg FROM student_modelpaperquiz GROUP BY subTopicId";
            $result = mysqli_query($connection, $sql);

            // Create arrays to store data
            $allQuizMarks = array();
            $selectedCourseQuizMarks = array();

            // Loop through data and store in arrays
            while ($row = mysqli_fetch_assoc($result)) {
                $subTopicId = $row['subTopicId'];
                $quizMark = $row['avg'];
                $courseId = $row['courseId'];

                // Add quiz mark to the appropriate array based on course ID
                if ($courseId === $course_id) {
                    $selectedCourseQuizMarks[] = array('x' => $subTopicId, 'y' => $quizMark);
                }
                $allQuizMarks[] = array('x' => $subTopicId, 'y' => $quizMark);
            }

            // Convert arrays to JSON format
            $allQuizMarks = json_encode($allQuizMarks);
            $selectedCourseQuizMarks = json_encode($selectedCourseQuizMarks);
            ?>

            <script>
            // Get data from PHP using AJAX
            var allQuizMarks = <?php echo $allQuizMarks; ?>;
            var selectedCourseQuizMarks = <?php echo $selectedCourseQuizMarks; ?>;

            // Create a new chart using Chart.js
            var ctx = document.getElementById('scatterChart').getContext('2d');
            var scatterChart = new Chart(ctx, {
                type: 'line',
                data: {
                    datasets: [{
                        label: 'All Quiz Marks',
                        data: allQuizMarks,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)'
                    }, {
                        label: 'Selected Course Quiz Marks',
                        data: selectedCourseQuizMarks,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)'
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Quiz Marks Scatter Plot'
                    },
                    scales: {
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Quiz Number'
                            }
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Quiz Mark'
                            }
                        }]
                    },
                    legend: {
                        display: true
                    }
                }
            });
            </script>
            <!-- End of Mark distribution graph -->
        </div> 
        <!-- End of Middle pane -->

        <!-- Marks distribution -->
        <div class="subtopic-dashboard">Marks Distribution</div>
        <div class="marks-distribution-box">
            <div class="attempts-pie-chart">
                <div class="piechart">
                    <canvas id="quizPieChart"></canvas>
                </div>

                <?php
                // Get course id
                $sql_course_id = "SELECT courseId from course where courseName = '$request'";
                $result_course_id = mysqli_query($connection,$sql_course_id);
                $row_course_id = mysqli_fetch_array($result_course_id);
                $course_id = $row_course_id['courseId'];

                // Retrieve data from database
                $sql = "SELECT * FROM student_modelpaperquiz WHERE courseId = $course_id";
                $result = mysqli_query($connection, $sql);

                // Create array to store data
                $quizMarks = array();

                // Loop through data and store in array
                while ($row = mysqli_fetch_assoc($result)) {
                    $quizMark = $row['marks'];
                    if (isset($quizMarks[$quizMark])) {
                        $quizMarks[$quizMark]++;
                    } else {
                        $quizMarks[$quizMark] = 1;
                    }
                }

                // Convert array to JSON format
                $quizMarks = json_encode($quizMarks);
                ?>

                <script>
                    // Get data from PHP using AJAX
                    var quizMarks = <?php echo $quizMarks; ?>;

                    // Create a new chart using Chart.js
                    var ctx = document.getElementById('quizPieChart').getContext('2d');
                    var quizPieChart = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: Object.keys(quizMarks),
                                datasets: [{
                                    label: 'Count of students',
                                    data: Object.values(quizMarks),
                                    backgroundColor: [
                                        '#4b148e',
                                        '#6420ad',
                                        '#7e31c2',
                                        '#9c4dcc',
                                        '#b86fdb',
                                        '#d6a8ff'
                                    ],
                                    borderWidth: 1
                                }]
                            }
                    });
                </script>

            </div>
            <div class="chart-topic">
                    Summary of students' performance in the course
            </div>
            <div class="attempts-statistics">

                <div class="course-performance-stat">
                    <div class="course-performance-topic">
                        Average highest mark on
                    </div>
                    <div class="course-performance-value">
                        <?php
                        $sqlHighestMarks = "SELECT subTopicId,avg(marks) as avg from student_modelpaperquiz where courseId='$course_id' group by subTopicId ORDER BY `avg` DESC limit 1";
                        $resultHighestMarks = mysqli_query($connection,$sqlHighestMarks);
                        $rowHighestMarks = mysqli_fetch_array($resultHighestMarks);
                        $highestsubTopicId = $rowHighestMarks['subTopicId'];

                        $sqlHighestMarksST = "SELECT subTopicName from subtopic where subTopicId='$highestsubTopicId'";
                        $resultHighestMarksST = mysqli_query($connection,$sqlHighestMarksST);
                        $rowHighestMarksST = mysqli_fetch_array($resultHighestMarksST);
                        $highestsubTopicName = $rowHighestMarksST['subTopicName'];

                        echo $highestsubTopicName;
                        ?>
                    </div>
                </div>

                <div class="course-performance-stat">
                    <div class="course-performance-topic">
                        Average lowest mark on
                    </div>
                    <div class="course-performance-value">
                        <?php
                        $sqlHighestMarks = "SELECT subTopicId,avg(marks) as avg from student_modelpaperquiz where courseId='$course_id' group by subTopicId ORDER BY `avg` ASC limit 1";
                        $resultHighestMarks = mysqli_query($connection,$sqlHighestMarks);
                        $rowHighestMarks = mysqli_fetch_array($resultHighestMarks);
                        $highestsubTopicId = $rowHighestMarks['subTopicId'];

                        $sqlHighestMarksST = "SELECT subTopicName from subtopic where subTopicId='$highestsubTopicId'";
                        $resultHighestMarksST = mysqli_query($connection,$sqlHighestMarksST);
                        $rowHighestMarksST = mysqli_fetch_array($resultHighestMarksST);
                        $highestsubTopicName = $rowHighestMarksST['subTopicName'];

                        echo $highestsubTopicName;
                        ?>
                    </div>
                </div>

                <div class="course-performance-stat">
                    <div class="course-performance-topic">
                        Highest attempted quiz
                    </div>
                    <div class="course-performance-value">
                        <?php
                        $sqlHighestMarks = "SELECT subTopicId, count(*) as count from student_modelpaperquiz where courseId='$courseId' group by subTopicId order by count DESC limit 1";
                        $resultHighestMarks = mysqli_query($connection,$sqlHighestMarks);
                        $rowHighestMarks = mysqli_fetch_array($resultHighestMarks);
                        $highestsubTopicId = $rowHighestMarks['subTopicId'];

                        $sqlHighestMarksST = "SELECT subTopicName from subtopic where subTopicId='$highestsubTopicId'";
                        $resultHighestMarksST = mysqli_query($connection,$sqlHighestMarksST);
                        $rowHighestMarksST = mysqli_fetch_array($resultHighestMarksST);
                        $highestsubTopicName = $rowHighestMarksST['subTopicName'];

                        echo $highestsubTopicName;
                        ?>
                    </div>
                </div>

                <div class="course-performance-stat">
                    <div class="course-performance-topic">
                        Least attempted quiz
                    </div>
                    <div class="course-performance-value">
                        <?php
                        $sqlHighestMarks = "SELECT subTopicId, count(*) as count from student_modelpaperquiz where courseId='$courseId' group by subTopicId order by count ASC limit 1";
                        $resultHighestMarks = mysqli_query($connection,$sqlHighestMarks);
                        $rowHighestMarks = mysqli_fetch_array($resultHighestMarks);
                        $highestsubTopicId = $rowHighestMarks['subTopicId'];

                        $sqlHighestMarksST = "SELECT subTopicName from subtopic where subTopicId='$highestsubTopicId'";
                        $resultHighestMarksST = mysqli_query($connection,$sqlHighestMarksST);
                        $rowHighestMarksST = mysqli_fetch_array($resultHighestMarksST);
                        $highestsubTopicName = $rowHighestMarksST['subTopicName'];

                        echo $highestsubTopicName;
                        ?>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- End of marks distribution -->

        <!-- Student Performances -->
        <div class="subtopic-dashboard-2">Student Performances</div>
            <div class="student-table-performance">
                <table class="student-table">
                    <tr>
                        <th>Student</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Total marks</th>
                        <th>Quizzes completed</th>
                    </tr>
                    <?php
                        $sqlStudentPerformance = "SELECT phoneNumber, sum(marks) as totalMarks, count(*) as count from student_modelpaperquiz where courseId='$course_id' group by phoneNumber order by totalMarks DESC";
                        $resultStudentPerformance = mysqli_query($connection,$sqlStudentPerformance);

                        while($rowStudentPerformance = mysqli_fetch_assoc($resultStudentPerformance)){
                            $phoneNumber = $rowStudentPerformance['phoneNumber'];
                            $totalMarks = $rowStudentPerformance['totalMarks'];
                            $count = $rowStudentPerformance['count'];

                            $sqlStudentDetails = "SELECT * from student where phoneNumber='$phoneNumber'";
                            $resultStudentDetails = mysqli_query($connection,$sqlStudentDetails);
                            $rowStudentDetails = mysqli_fetch_array($resultStudentDetails);
                            $studentName = $rowStudentDetails['name'];
                            $studentContact = $rowStudentDetails['phoneNumber'];
                            $studentProfilePicture = $rowStudentDetails['profilePicture'];

                            echo '
                            <tr>
                                <td><i class="fa-regular fa-user fa-lg"></i></td>
                                <td>'.$studentName.'</td>
                                <td>'.$studentContact.'</td>
                                <td>'.$totalMarks.'</td>
                                <td>'.$count.'</td>
                            </tr>
                        ';
                        }
                    ?>
                </table>
            </div>
        </div>
        <!-- End of student performances -->
    <?php
    }
    include_once "../../assets/includes/footer.php";
    ?>
</body>
</html>