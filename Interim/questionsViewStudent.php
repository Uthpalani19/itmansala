<?php
    session_start();
    require('dbconnection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Questions</title>
    <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/questionsViewStudent.css"></link>
</head>

    <body>
        <!--Navigation Bar-->
        <?php
            require_once('navbar.php');
        ?>

        <!--Course Details-->
        <div class="course-details-box">
            <p id="title">Lesson 01: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>

        <!--Set Subtopic Name-->
        <div class="subtopic-title">
            <p> 1.1 Basic building blocks of information and their characteristics </p>
        </div>

        <!--Add a new Question-->
        <div class="question">
            <div class="question-number-box">
                <label class="question-number" name="questionNumber" >Q001</label>
            </div>

            <div class="container">
                <div class="question">
                    <textarea readonly placeholder="What is Data?" name="question" rows="2" cols="100" ></textarea>
                </div>
                <div class="option">
                    <textarea readonly placeholder="Enter the option 1 " name="option1"></textarea>
                    <textarea readonly placeholder="Enter the option 2 " name="option2"></textarea>
                    <textarea readonly placeholder="Enter the option 3 " name="option3"></textarea>
                    <textarea readonly placeholder="Enter the option 4 " name="option4"></textarea>
                </div>
            </div>

            <div class="buttons">
                <input type="submit" value="Previous" class="btn-question" name="Previous">
                <input type="submit" value="Back to Lesson" class="btn-question" id="back" name="back">
                <input type="submit" value="Next" class="btn-question" name="Next" onclick="window.location.href='quizReview.php'">
            </div>
            
        </div>

        <!-- Footer -->
        <?php
            require_once('footer.php');
        ?>
    </body>
</html>