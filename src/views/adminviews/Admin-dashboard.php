<?php 
    //Navigation Bar
    require_once('../../assets/includes/navbar-admin.php');
    // session_start();
    // require('../../config/dbconnection.php');

    // if(!isset($_SESSION['name']))
    // {
    //     header('location:index.php');
    // }

    // if(isset($_GET['logout']))
    // {
    //     session_destroy();
    //     unset($_SESSION['name']);
    //     header('location:index.php');
    // }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/global.css"></link>
    <link rel="stylesheet" href="../../assets/css/adminDashboard.css"></link>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <title>Admin Dashboard</title>
</head>

<body>
    <!-- Static Data -->
    <div class="static_data_container">
        <!-- Stat -->
        <div class="static_data">
            <div class="static_data_item">
                <div class="static_data_item_value">10</div>
                <div class="static_data_item_title">Total Teachers</div>
            </div>
            <div class="static_data_item">
                <div class="static_data_item_value">450</div>
                <div class="static_data_item_title">Total Students</div>
            </div>
            <div class="static_data_item">
                <div class="static_data_item_value">557</div>
                <div class="static_data_item_title">Total Enrollments</div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="white-box">
            <div class="white-box-div">
                <p id="course-name">550 000 LKR</p>

                <div class="dropdown">
                    <button class="dropbtn">2022 <i class="fa fa-sort-desc" aria-hidden="true"></i></button>
                    <div class="dropdown-content">
                        <a href="#">2021</a>
                        <a href="#">2020</a>
                        <a href="#">2019</a>
                    </div>

                </div>
            </div>
            <div class="white-box-course-name"> 
                <p >Total revenue generated</p>
            </div>
        </div>
    </div>

    <div class="container-main">

        <!--- Progress cards --->
        <div class="progress_container">

            <!--- Top cards --->
            <div class="progress">

                <div class="progress_item_top">
                    <div class="static_data_item_number_top">10</div>
                    <div class="static_data_item_text_top">New Students</div>
                    <div class="static_data_item_week">this week</div>

                    <div class="new-enrollment-count-lower">15.00% -</div>
                </div>

                <div class="progress_item_top">
                    <div class="static_data_item_number_top">25</div>
                    <div class="static_data_item_text_top">New Students</div>
                    <div class="static_data_item_week">this week</div>

                    <div class="new-enrollment-count-upper">10.00% +</div>
                </div>
                
            </div>

            <!--- Bottom cards --->
            <div class="progress">
                <div class="progress_item">
                    <div class="static_data_item_number">350</div>
                    <div class="static_data_item_text">Total Students in</div>
                    <div class="static_data_item_course">C001</div>

                    <!-- <div class="dropdown">
                    <button class="dropbtn_cards"> C001 <i class="fa fa-sort-desc" aria-hidden="true"></i></button>
                    <div class="dropdown-content_cards">
                        <a href="#">C002</a>
                        <a href="#">C003</a>
                        <a href="#">C004</a>
                    </div> -->

                <!-- </div> -->
                </div>

                <div class="progress_item">
                    <div class="static_data_item_number">253</div>
                    <div class="static_data_item_text">Total Students in</div>
                    <div class="static_data_item_course">C003</div>
                    <!-- <div class="dropdown">
                    <button class="dropbtn_cards"> C002 <i class="fa fa-sort-desc" aria-hidden="true"></i></button>
                    <div class="dropdown-content_cards">
                        <a href="#">C001</a>
                        <a href="#">C003</a>
                        <a href="#">C004</a>
                    </div> -->
                </div>
            </div>

            
            <!-- <div class="progress">
                <div class="new-enrollment-count">
                    <div class="new-enrollment-count-upper">
                        <div class="progress_item_value2">40</div>
                        <div class="progress_item_title2">New enrollments <br> on this month</div>
                    </div>

                    <div class="new-enrollment-count-lower">15.00% + Compared to last month</div>
                </div>
            </div> -->

        </div>

        <!-- Bar Chart -->
        <div class="chart">
            <canvas id="myChart" style=""></canvas>

            <script type="text/javascript">
                var xValues = ["Week 1", "Week 2", "Week 3", "Week 4", "July", "August", "September", "October", "November", "December", "January", "February"];
                var yValues = [10, 24, 32, 39, 30, 25, 20, 12, 15, 28, 36, 40, 100, 0];
                var barColors = ["#5319a6", "#5319a6","#5319a6","#5319a6","#5319a6","#5319a6","#5319a6", "#5319a6", "#5319a6","#5319a6","#5319a6", "#5319a6"];

                new Chart("myChart", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                    }]
                },
                options: {
                    legend: {display: false},
                    title: {
                    display: true,
                    }
                }
                });
            </script>
    </div>


</body>
</html>
