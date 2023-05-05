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
                </div>

                <div class="progress_item">
                    <div class="static_data_item_number">253</div>
                    <div class="static_data_item_text">Total Students in</div>
                    <div class="static_data_item_course">C003</div>
                </div>
            </div>
        </div>

        <!-- Bar Chart -->

        <div class="chart">
            <?php 
                require_once '..\..\config\dbconnection.php';

                $sql = "SELECT courseId, COUNT(*) as count FROM student_course GROUP BY courseId";
                $result = $connection->query($sql);

                // Create arrays for the data
                $labels = ['Data and Information', 'Networking', 'ICT Networking'];
                $data = [0, 0, 0];

                // Loop through the result and populate the data arrays
                while ($row = $result->fetch_assoc()) {
                switch ($row['courseId']) {
                    case "1":
                    $data[0] = $row['count'];
                    break;
                    case "2":
                    $data[1] = $row['count'];
                    break;
                    case "4":
                    $data[2] = $row['count'];
                    break;
                }
                }


            ?>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

            <!-- Create canvas element for the chart -->
            <canvas id="myChart"></canvas>

            <!-- Create JavaScript code to create the chart -->
            <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Number of Students in each course',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 0.2)',
                    ],
                    borderWidth: 1
                }]
                },
                options: {
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
