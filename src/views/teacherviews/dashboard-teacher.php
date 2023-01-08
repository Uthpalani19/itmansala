<?php
    session_start();
    if(!isset($_SESSION['firstname']))
    {
        header('location:index.php');
    }
    if(isset($_GET['logout']))
    {
        session_destroy();
        unset($_SESSION['firstname']);
        header('location:index.php');
    }
?>

<?php
    require_once '..\..\assets\includes\navbar-teacher.php';
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
        <div class="select_course">
            <select name="course" id="course">
                <option value="course1">Course 1</option>
                <option value="course2">Course 2</option>
                <option value="course3">Course 3</option>
                <option value="course4">Course 4</option>
            </select>
        </div>
    </div>
</body>
</html>