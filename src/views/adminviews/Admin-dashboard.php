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

        <!-- Choose the course -->
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

    <!-- Progress -->
    <div class="topic">
        <p class="topic-p">Enrollment Summery 
            <div class="dropdown">
                <button class="dropbtn">computer Networks <i class="fa fa-sort-desc" aria-hidden="true"></i></button>
                <div class="dropdown-content">
                    <a href="#">ER diagrams</a>
                    <!-- <a href="#">2020</a>
                    <a href="#">2019</a> -->
                </div>

            </div>
        </p>
    </div>

    <div class="container-main">

    
        <!-- Progress cards -->
        <div class="progress_container">
            <div class="progress">
                <div class="progress_item">
                    <div class="progress_item_value">335</div>
                    <div class="progress_item_title">Total Students</div>
                </div>

                <div class="progress_item">
                    <div class="progress_item_value">78.3</div>
                    <div class="progress_item_title">Average Mark</div>
                </div>
            </div>

            <div class="progress">
                <div class="new-enrollment-count">
                    <div class="new-enrollment-count-upper">
                        <div class="progress_item_value2">40</div>
                        <div class="progress_item_title2">New enrollments <br> on this month</div>
                    </div>

                    <div class="new-enrollment-count-lower">15.00% + Compared to last month</div>
                </div>
            </div>
        </div>

        <!-- To do list -->
        <!-- <div class="todo_container scroll"> -->
            <div class="chart">
            <canvas id="myChart" style=""></canvas>

            </div>

                <script type="text/javascript">
                    var xValues = ["March", "April", "May", "June", "July", "August", "September", "October", "November", "December", "January", "February"];
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

        <!-- </div> -->
    </div>


</body>

</html>
