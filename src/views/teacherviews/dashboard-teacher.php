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
    <!-- Static Data -->
    <div class="static_data_container">
        <!-- Stat -->
        <div class="static_data">
            <div class="static_data_item">
                <div class="static_data_item_value">100</div>
                <div class="static_data_item_title">Total Subtopics</div>
            </div>
            <div class="static_data_item">
                <div class="static_data_item_value">10</div>
                <div class="static_data_item_title">Total Lessons</div>
            </div>
            <div class="static_data_item">
                <div class="static_data_item_value">5</div>
                <div class="static_data_item_title">Total Quizzes</div>
            </div>
        </div>

        <!-- Choose the course -->
        <div class="white-box">
            <div class="white-box-div">
                <div class="dropdown">
                    <button class="dropbtn">Select <i class="fa fa-sort-desc" aria-hidden="true"></i></button>
                    <div class="dropdown-content">
                        <a href="#">C001</a>
                        <a href="#">C002</a>
                        <a href="#">C003</a>
                    </div>
                </div>

                <p id="course-name">Course - C001</p>
            </div>
            <div class="white-box-course-name"> 
                <p>තොරතුරු වල මූලික තැනුම් ඒකක හා ඒවායේ ගති ලක්ෂණ</p>
            </div>
        </div>
    </div>

    <!-- Progress -->
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
                        <div class="progress_item_value2">15</div>
                        <div class="progress_item_title2">New enrollments <br> on this week</div>
                    </div>

                    <div class="new-enrollment-count-lower">25.00% + Compared to last week</div>
                </div>
            </div>
        </div>

        <!-- To do list -->
        <div class="main-section">
            <div class="add-section">
                <form action="">
                    <input type="text" name="title" placeholder="This field is required">
                    <button type="Submit">Add &nbsp; <span>&#43; </span></button>
                </form>
            </div>
            <div class="show-todo-section">
                <div class="todo-item">
                    <input type="checkbox">
                    <h2>This is todo</h2>
                    <br>
                    <small>Created: 18/04/2023</small>
                </div>
            </div>
        </div>
        <!-- <div class="todo_container scroll">
            <div class="todo_title">To do list</div>
           
            <div class="todo">
                <div id="todo-work">Upload learning materials</div>
                <div id="tick"></div>
            </div>
            <div class="todo">
                <div id="todo-work">Add questions to the 3rd quiz</div>
                <div id="tick"></div>
            </div>
            <div class="todo">
                <div id="todo-work">Submit new course</div>
                <div id="tick"></div>
            </div>
            <div class="todo">
                <div id="todo-work">Check on students' performance</div>
                <div id="tick"></div>
            </div>
            <div class="todo">
                <div id="todo-work">Add a new course</div>
                <div id="tick"></div>
            </div>

            <div class="todo">
                <div id="todo-work"><i class="fa-sharp fa-solid fa-circle-plus icon-add"></i></div>
                <div id="tick"></div>
            </div>
        </div> -->
    </div>

    <!-- Marks distribution -->
    <div class="subtopic-dashboard">Marks Distribution</div>

    <div class="marks-distribution-box">
        <div class="attempts-pie-chart"></div>
        <div class="attempts-statistics"></div>
    </div>

    <!-- Student Performances -->
    <div class="subtopic-dashboard">Student Performances</div>

    <div class="students-details-table">
        <table>
            <tr>
                <th>Student Profile Picture</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Total marks</th>
                <th>Quizzes completed</th>
            </tr>
    </div>

</body>

</html>