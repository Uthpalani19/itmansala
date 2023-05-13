<?php 
    //Navigation Bar
    require_once('../../assets/includes/navbar-admin.php');
    session_start();
    require('../../config/dbconnection.php');

    if(!isset($_SESSION['adminname']))
    {
        header('location:../../student_login.php');
    }

    if(isset($_GET['logout']))
    {
        session_destroy();
        unset($_SESSION['adminname']);
        header('location:../../student_login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/global.css"></link>
    <link rel="stylesheet" href="../../assets/css/adminDashboard.css"></link>
    <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <title>Admin Dashboard</title>
</head>

<body>
    <!--Static Data -->
    <div class="static_data_container">

        <!-- Total counts -->
        <?php
                require_once '..\..\config\dbconnection.php';

                $sql1 = "SELECT COUNT(*) AS total FROM teacher";
                $result1 = mysqli_query($connection, $sql1);

                $sql2 = "SELECT COUNT(*) AS total FROM student";
                $result2 = mysqli_query($connection, $sql2);

                $sql3 = "SELECT COUNT(*) AS total FROM student_course";
                $result3 = mysqli_query($connection, $sql3);

                $sql4 = "SELECT COUNT(*) AS total FROM course";
                $result4 = mysqli_query($connection, $sql4);

                if (mysqli_num_rows($result1) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result1)) {
                        $total_entries = $row["total"];
                    }

                    while($row = mysqli_fetch_assoc($result2)) {
                        $total_entries2 = $row["total"];
                    }

                    while($row = mysqli_fetch_assoc($result3)) {
                        $total_entries3 = $row["total"];
                    }

                    while($row = mysqli_fetch_assoc($result4)) {
                        $total_entries4 = $row["total"];
                    }

                } else {
                    $total_entries = 0;
                }

                ?>

            <div class="static_data">
                <div class="static_data_item">
                    <div class="static_data_item_value"><?php echo $total_entries; ?></div>
                    <div class="static_data_item_title">Total Teachers</div>
                </div>
                <div class="static_data_item">
                    <div class="static_data_item_value"><?php echo $total_entries4; ?></div>
                    <div class="static_data_item_title">Total Courses</div>
                </div>
                <div class="static_data_item">
                    <div class="static_data_item_value"><?php echo $total_entries2; ?></div>
                    <div class="static_data_item_title">Total Students</div>
                </div>
                <div class="static_data_item">
                    <div class="static_data_item_value"><?php echo $total_entries3; ?></div>
                    <div class="static_data_item_title">Total Enrollments</div>
                </div>
            </div>

        <!-- Total Revenue -->
        <div class="white-box">
            <div class="white-box-div">
                <p class="static_data_item_value"><?php 
                    //Get the course price
                    $sqlCoursePrice = "SELECT * from course";
                    $resultCoursePrice = mysqli_query($connection, $sqlCoursePrice);
                    $rowCoursePrice = mysqli_fetch_assoc($resultCoursePrice);

                    echo $total_entries3*$rowCoursePrice['price']; ?> LKR</p> <i class="fa-solid fa-sack-dollar fa-xl"></i>
            </div>
            <div class="white-box-course-name"> 
                <p >Total revenue generated</p>
            </div>
        </div>
    </div>

    <br />
    <!-- Reports generation -->
    <div class="report-container">
        <button type="submit" class="btn-view-pdf"><a href="revenueReport.php?ACTION=VIEW"><i class="fa fa-file-pdf-o"></i> View income report</a></button> &nbsp;&nbsp; 
        <button type="submit" class="btn-view-pdf"><a href="courseReport.php?ACTION=DOWNLOAD"><i class="fa fa-file-pdf-o"></i> View course performance report</a></button> 
    </div>

    <div class="container-main">
        <!--- Progress cards --->
        <div class="progress_container">
            <!--- Top cards --->
            <div class="progress">
                <!-- Students Percentage -->
                <div class="progress_item_top">
                    <div class="static_data_item_number_top">
                    <?php
                        // Get the number of new students
                        $sqlEnrollments = "SELECT count(*) from student where firstAccessDate >= DATE(NOW()) - INTERVAL 7 DAY";
                        $resultEnrollments = mysqli_query($connection, $sqlEnrollments);
                        $rowEnrollments = mysqli_fetch_assoc($resultEnrollments);

                        echo $rowEnrollments['count(*)'];

                        $dateTime = date('Y-m-d H:i:s');
                    ?>
                    </div>
                    <div class="static_data_item_text_top">New Students</div>
                    <div class="static_data_item_week">this week</div>

                    <?php
                        // Get the number of new students last week
                        $sqlEnrollmentsLastWeek = "SELECT count(*) from student where firstAccessDate >= DATE(NOW()) - INTERVAL 14 DAY and firstAccessDate < DATE(NOW()) - INTERVAL 7 DAY";
                        $resultEnrollmentsLastWeek = mysqli_query($connection, $sqlEnrollmentsLastWeek);
                        $rowEnrollmentsLastWeek = mysqli_fetch_assoc($resultEnrollmentsLastWeek);

                        $percentage = round(($rowEnrollments['count(*)'] - $rowEnrollmentsLastWeek['count(*)'])*100/$rowEnrollmentsLastWeek['count(*)']);
                        
                    
                        if($percentage < 0){
                            ?>
                            <div class="new-enrollment-count-lower"><?php echo $percentage.".00 %";?>
                            <i class="fa-solid fa-down-long"></i></div>
                            <?php
                        }
                        else{
                            ?>
                            <div class="new-enrollment-count-upper"><?php echo $percentage.".00 %";?>
                            <i class="fa-solid fa-up-long"></i></div>
                            <?php
                        }
                    ?>
                </div>

                <!-- Enrollments Percentage -->
                <div class="progress_item_top">
                    <div class="static_data_item_number_top">
                    <?php
                        // Get the number of new enrollments
                        $sqlEnrollments = "SELECT count(*) from student_course where enrolmentDateTime >= DATE(NOW()) - INTERVAL 7 DAY";
                        $resultEnrollments = mysqli_query($connection, $sqlEnrollments);
                        $rowEnrollments = mysqli_fetch_assoc($resultEnrollments);

                        echo $rowEnrollments['count(*)'];
                    ?>
                    </div>
                    <div class="static_data_item_text_top">New Enrollments</div>
                    <div class="static_data_item_week">this week</div>

                    <?php
                         // Get the number of enrollments last week
                        $sqlEnrollmentsLastWeek = "SELECT count(*) from student_course where enrolmentDateTime >= DATE(NOW()) - INTERVAL 14 DAY and enrolmentDateTime < DATE(NOW()) - INTERVAL 7 DAY";
                        $resultEnrollmentsLastWeek = mysqli_query($connection, $sqlEnrollmentsLastWeek);
                        $rowEnrollmentsLastWeek = mysqli_fetch_assoc($resultEnrollmentsLastWeek);

                        $percentage = ($rowEnrollments['count(*)'] - $rowEnrollmentsLastWeek['count(*)'])*100/$rowEnrollmentsLastWeek['count(*)'];
                        
                    
                    if($percentage < 0){
                        ?>
                        <div class="new-enrollment-count-lower"><?php echo $percentage.".00 %";?>
                        <i class="fa-solid fa-down-long"></i></div>
                        <?php
                    }
                    else{
                        ?>
                        <div class="new-enrollment-count-upper"><?php echo $percentage.".00 %";?>
                        <i class="fa-solid fa-up-long"></i></div>
                        <?php
                    }
                    ?>
                </div>

                <!-- Income Percentage -->
                <div class="progress_item_top">
                    <div class="static_data_item_number_top">
                    <?php
                        // Get the number of new enrollments
                        $sqlEnrollments = "SELECT count(*) from student_course where enrolmentDateTime >= DATE(NOW()) - INTERVAL 7 DAY";
                        $resultEnrollments = mysqli_query($connection, $sqlEnrollments);
                        $rowEnrollments = mysqli_fetch_assoc($resultEnrollments);

                        echo ($rowEnrollments['count(*)']*1000)." LKR";
                    ?>
                    </div>
                    <div class="static_data_item_text_top">Income</div>
                    <div class="static_data_item_week">this week</div>

                    <?php
                         // Get the number of enrollments last week
                        $sqlEnrollmentsLastWeek = "SELECT count(*) from student_course where enrolmentDateTime >= DATE(NOW()) - INTERVAL 14 DAY and enrolmentDateTime < DATE(NOW()) - INTERVAL 7 DAY";
                        $resultEnrollmentsLastWeek = mysqli_query($connection, $sqlEnrollmentsLastWeek);
                        $rowEnrollmentsLastWeek = mysqli_fetch_assoc($resultEnrollmentsLastWeek);

                        $percentage = ($rowEnrollments['count(*)'] - $rowEnrollmentsLastWeek['count(*)'])*100/$rowEnrollmentsLastWeek['count(*)'];
                        
                    
                    if($percentage < 0){
                        ?>
                        <div class="new-enrollment-count-lower"><?php echo $percentage.".00 %";?>
                        <i class="fa-solid fa-down-long"></i></div>
                        <?php
                    }
                    else{
                        ?>
                        <div class="new-enrollment-count-upper"><?php echo $percentage.".00 %";?>
                        <i class="fa-solid fa-up-long"></i></div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            
            <h4>Income Breakdown</h4>
            <div class="scrollable">
                <!-- Course Details summary table -->
                <table class="course-details">
                    <tr>
                        <th>Course Name</th>
                        <th>Enrollments</th>
                        <th>Income</th>
                    </tr>
                        <?php
                            $sql = "SELECT * from course where status='1'";
                            $result = mysqli_query($connection, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                ?>
                                <tr>
                                    <td><?php echo $row['courseName'];?></td>
                                    <td><?php $sqlEnrollments = "SELECT count(*) FROM student_course WHERE courseId = '" . $row['courseId'] . "'";
                                              $resultEnrollments = mysqli_query($connection,$sqlEnrollments);
                                              $rowEnrollments = mysqli_fetch_assoc($resultEnrollments);

                                              echo $rowEnrollments['count(*)'];
                                        ?></td>
                                    <td><?php echo $rowEnrollments['count(*)']*1000; ?></td>
                                </tr>
                                <?php
                            }
                        ?>
                </table>
            </div>
        </div>
        
        <!-- Bar Chart -->
        <div class="chart">
            <canvas id="myChart"></canvas>
                <?php 
                    // Retrieve data from database
                    $sql = "SELECT courseId,count(*) as total FROM student_course group by courseId";
                    $result = mysqli_query($connection, $sql);

                    // Create arrays to store data
                    $labels = array();
                    $data = array();

                    // Loop through data and store in arrays
                    while ($row = mysqli_fetch_assoc($result)) {
                        $sqlCourseName = "SELECT courseName FROM course WHERE courseId = '" . $row['courseId'] . "'";
                        $resultCourseName = mysqli_query($connection, $sqlCourseName);
                        $rowCourseName = mysqli_fetch_assoc($resultCourseName);

                        $labels[] = $rowCourseName['courseName'];
                        $data[] = $row['total'];
                    }

                    // Convert arrays to JSON format
                    $labels = json_encode($labels);
                    $data = json_encode($data);
                ?>

                <!-- Create JavaScript code to create the chart -->
                <script>
                    // Get data from PHP using AJAX
                    var labels = <?php echo $labels; ?>;
                    var data = <?php echo $data; ?>;

                    // Create new chart using Chart.js
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Students',
                                data: data,
                                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'Number of Students per Course'
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                </script> 
        </div>
</body>
</html>
