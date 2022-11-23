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
    <link rel="stylesheet" href="css/quizReview.css"></link>
</head>

    <body>
        <!--Navigation Bar-->
        <?php
            require_once('navbar-student.php');
        ?>

        <!--Course Details-->
        <div class="course-details-box">
            <p id="title">Lesson 01: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>

        <!--Set Subtopic Name-->
        <div class="subtopic-title">
            <p> 1.1 Basic building blocks of information and their characteristics </p>
        </div>

        <!-- Quiz review avatar -->
        <div class="container">
            <div class="encouragement-msg">
                <p> Hmm! You have done a good job. <br />But your score is <span id="marks"> 2 out of 5 </span> which means you need improvement. </p>
            </div>
            <div class="avatar">
                <img src="img/welcome_avatar.png" alt="quizReviewAvatar" id="quizReviewAvatar" width = "300">
            </div>
            <div class="encouragement-msg2">
                <p> Next time let's get a good score. </p>
            </div>
        </div>

        <!-- Questions and answers -->

        <hr class="separator">
        <!-- Question 01 -->
        <div class="question">
            <div class="question-number-box">
                <label class="question-number" name="questionNumber" >Q001</label>
            </div>

            <div class="container-question">
                <div class="question">
                    <textarea readonly placeholder="What is Data?" name="question" rows="2" cols="100" ></textarea>
                </div>
                <div class="option">
                    <textarea readonly placeholder="Facts and statistics collected together for reference or analysis." name="option1" id="answer"></textarea>
                    <textarea readonly placeholder="Facts provided or learned about something or someone." name="option2"></textarea>
                    <textarea readonly placeholder="An organized collection of structured information" name="option3"></textarea>
                    <textarea readonly placeholder="Relationship in which a person or thing is linked or associated with something else." name="option4"></textarea>
                </div>
            </div>
        </div>

        <hr class="separator">
        <!-- Question 02 -->
        <div class="question">
            <div class="question-number-box">
                <label class="question-number" name="questionNumber" >Q005</label>
            </div>

            <div class="container-question">
                <div class="question">
                    <textarea readonly placeholder="What is Information?" name="question" rows="2" cols="100" ></textarea>
                </div>
                <div class="option">
                    <textarea readonly placeholder="Facts and statistics collected together for reference or analysis." name="option1"></textarea>
                    <textarea readonly placeholder="Facts provided or learned about something or someone." name="option2" id="answer"></textarea>
                    <textarea readonly placeholder="An organized collection of structured information" name="option3" id="stu-answer"></textarea>
                    <textarea readonly placeholder="Relationship in which a person or thing is linked or associated with something else." name="option4"></textarea>
                </div>
            </div>
        </div>

        <hr class="separator">
        <!-- Question 03 -->
        <div class="question">
            <div class="question-number-box">
                <label class="question-number" name="questionNumber" >Q015</label>
            </div>

            <div class="container-question">
                <div class="question">
                    <textarea readonly placeholder="What is Database?" name="question" rows="2" cols="100" ></textarea>
                </div>
                <div class="option">
                    <textarea readonly placeholder="Facts and statistics collected together for reference or analysis." name="option1"  id="stu-answer"></textarea>
                    <textarea readonly placeholder="Facts provided or learned about something or someone." name="option2"></textarea>
                    <textarea readonly placeholder="An organized collection of structured information" name="option3" id="answer"></textarea>
                    <textarea readonly placeholder="Relationship in which a person or thing is linked or associated with something else." name="option4"></textarea>
                </div>
            </div>
        </div>

        <hr class="separator">
        <!-- Question 04 -->
        <div class="question">
            <div class="question-number-box">
                <label class="question-number" name="questionNumber" >Q002</label>
            </div>

            <div class="container-question">
                <div class="question">
                    <textarea readonly placeholder="What is a connection?" name="question" rows="2" cols="100" ></textarea>
                </div>
                <div class="option">
                    <textarea readonly placeholder="Facts and statistics collected together for reference or analysis." name="option1"></textarea>
                    <textarea readonly placeholder="Facts provided or learned about something or someone." name="option2"></textarea>
                    <textarea readonly placeholder="An organized collection of structured information" name="option3"></textarea>
                    <textarea readonly placeholder="Relationship in which a person or thing is linked or associated with something else." name="option4" id="answer"></textarea>
                </div>
            </div>
        </div>

        <br /><br />
        <!-- Finish Review Button -->
        <div class="finish-review">
            <button type="button" class="btn" onclick="window.location.href='#'">Finish Review</button>
        </div>

        <br />
        <hr class="separator">

        <!-- Next Action buttons -->
        <div class="next-action">
            <button type="button" class="btn" onclick="window.location.href='#'">Back to topic 1.1</button>
            <button type="button" class="btn" id="disable" onclick="window.location.href='#'">Next Subtopic 1.2</button>
        </div>

        <br />

        <!-- Footer -->
        <?php
            require_once('footer.php');
        ?>
    </body>
</html>