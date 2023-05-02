<?php
    session_start();
    include('../../assets/includes/navbar-student.php');
    require('../../config/dbconnection.php');

    if (!isset($_SESSION['name'])) {
        header('location: ../student_login.php');
    }

    if(isset($_GET['logout']))
    {
        session_destroy();
        unset($_SESSION['firstname']);
        header('location:index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Review</title>
    <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../assets/css/quizReview.css"></link>
    <link rel="stylesheet" href="../../assets/css/global.css"></link>
</head>

    <body>

      <!-- Loading Course ID and Subtopic ID -->
      <?php
            $courseId=$_GET['courseId'];
            $sql = "SELECT * FROM course WHERE courseId='$courseId'";
            $result = mysqli_query($connection,$sql);
            $row = mysqli_fetch_assoc($result);
            $courseName=$row['courseName'];

            $subtopicId=$_GET['subId'];
            $sql = "SELECT * FROM subtopic WHERE subtopicId='$subtopicId'";
            $result = mysqli_query($connection,$sql);
            $row = mysqli_fetch_assoc($result);
            $subtopicName=$row['subTopicName'];

            $phoneNumber = $_SESSION['phone'];
            $attempt = $_GET['attempt'];
        ?>
        <!--Course Details-->
        <div class="course-details-box">
            <p id="title"><?php echo $courseName; ?></p>
        </div>

        <!--Set Subtopic Name-->
        <div class="subtopic-title">
            <p> <?php echo $subtopicName; ?> </p>
        </div>

        <?php
            // Load quiz attempt details
            $sql_load = "SELECT * FROM student_modelpaperquiz WHERE phoneNumber='$phoneNumber' AND subtopicId='$subtopicId' AND attempt='$attempt'";
            $result_load = mysqli_query($connection,$sql_load);
            $row_load = mysqli_fetch_assoc($result_load);
            $marks = $row_load['marks'];
        ?>

        <!-- Quiz review avatar -->
        <div class="container">
            <!-- Get the encourage msg according to the mark -->
            <?php
                if($marks == 5)
                {
                    $encouragemsg = "Yay, you have done an excellent job! Keep it up!";
                }
                elseif($marks >= 3 && $marks < 5)
                {
                    $encouragemsg = "Good job! You have done a great job! Let's get a full score next time!";
                }
                elseif($marks >= 1 && $marks < 3)
                {
                    $encouragemsg = "Hmm! You have done a good job. But you need improvement.";
                }
                else
                {
                    $encouragemsg = "Oh no! You have to improve your knowledge. Let's try again!";
                }
            ?>

            <div class="encouragement-msg">
                <?php echo $encouragemsg ?>
                <br /> Your score is <span id="marks"> <?php echo $marks ?> out of 5 </span></p>
            </div>
            <div class="avatar">
                <img src="../../assets/images/welcome_avatar.png" alt="quizReviewAvatar" id="quizReviewAvatar" width = "300">
            </div>
            <div class="encouragement-msg2">
                <p> Here's the review of your quiz </p>
            </div>
        </div>

        <!-- Questions and answers -->
        <?php
            $sqlQuestions = "SELECT * from student_modelpaperquestion WHERE phoneNumber='$phoneNumber' AND subtopicId='$subtopicId' AND attempt='$attempt'";
            $resultQuestions = mysqli_query($connection,$sqlQuestions);

            while($rowQuestions = mysqli_fetch_assoc($resultQuestions))
            {
                // Getting all the answers of the tried question
                $sqlAnswers = "SELECT * from modelpaperquestion WHERE questionId='$rowQuestions[questionId]' AND subtopicId='$subtopicId'";
                $resultAnswers = mysqli_query($connection,$sqlAnswers);
                $rowAnswers = mysqli_fetch_assoc($resultAnswers);

                // Getting student's answer
                $studentAnswer = $rowQuestions['answer'];

                ?>
                    <hr class="separator">
                    <!-- Question 01 -->
                    <div class="question">
                        <div class="question-number-box">
                            <label class="question-number" name="questionNumber" ><?php echo $rowAnswers['questionId']?></label>
                        </div>
                        
                        <div class="container-question">
                            <div class="question">
                                <textarea readonly name="question" rows="2" cols="100" ><?php echo $rowAnswers['question']?></textarea>
                            </div> 
                            <div class="option">
                                <?php
                                    if($studentAnswer == $rowAnswers['option1'])
                                    {
                                        if($studentAnswer == $rowAnswers['answer'])
                                        {
                                            ?>
                                                <textarea readonly name="option1" id="studentAnswer" style="background-color: #00FF00;"><?php echo $rowAnswers['option1']; ?></textarea>
                                                <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <textarea readonly name="option1" id="studentAnswer" style="background-color: #FF0000;"><?php echo $rowAnswers['option1']; ?></textarea>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                            <textarea readonly name="option1"><?php echo $rowAnswers['option1']; ?></textarea>
                                        <?php
                                    }

                                    if($studentAnswer == $rowAnswers['option2'])
                                    {
                                        if($studentAnswer == $rowAnswers['answer'])
                                        {
                                            ?>
                                                <textarea readonly name="option2" id="studentAnswer" style="background-color: #00FF00;"><?php echo $rowAnswers['option2']; ?></textarea>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <textarea readonly name="option2" id="studentAnswer" style="background-color: #FF0000;"><?php echo $rowAnswers['option2']; ?></textarea>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                            <textarea readonly name="option2"><?php echo $rowAnswers['option2']; ?></textarea>
                                        <?php
                                    }

                                    if($studentAnswer == $rowAnswers['option3'])
                                    {
                                        if($studentAnswer == $rowAnswers['answer'])
                                        {
                                            ?>
                                                <textarea readonly name="option3" id="studentAnswer" style="background-color: #00FF00;"><?php echo $rowAnswers['option3']; ?></textarea>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <textarea readonly name="option3" id="studentAnswer" style="background-color: #FF0000;"><?php echo $rowAnswers['option3']; ?></textarea>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                            <textarea readonly name="option3"><?php echo $rowAnswers['option3']; ?></textarea>
                                        <?php
                                    }

                                    if($studentAnswer == $rowAnswers['option4'])
                                    {
                                        if($studentAnswer == $rowAnswers['answer'])
                                        {
                                            ?>
                                                <textarea readonly name="option4" id="studentAnswer" style="background-color: #00FF00;"><?php echo $rowAnswers['option4']; ?></textarea>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <textarea readonly name="option4" id="studentAnswer" style="background-color: #FF0000;"><?php echo $rowAnswers['option4']; ?></textarea>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                            <textarea readonly name="option4"><?php echo $rowAnswers['option4']; ?></textarea>
                                        <?php
                                    }

                                    if($studentAnswer == $rowAnswers['option5'])
                                    {
                                        if($studentAnswer == $rowAnswers['answer'])
                                        {
                                            ?>
                                                <textarea readonly name="option5" id="studentAnswer" style="background-color: #00FF00;"><?php echo $rowAnswers['option5']; ?></textarea>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <textarea readonly name="option5" id="studentAnswer" style="background-color: #FF0000;"><?php echo $rowAnswers['option5']; ?></textarea>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                            <textarea readonly name="option5"><?php echo $rowAnswers['option5']; ?></textarea>
                                        <?php
                                    }

                                ?>
                                <br/>
                                <textarea readonly name="answer" id="answer">Correct Answer : <?php echo $rowAnswers['answer']?></textarea>
                            </div>
                        </div>
                    </div>
                <?php
            }
        ?>
        

        <br /><br />
        <!-- Finish Review Button -->
            <a href="quizReviewSummary.php?subId=<?php echo $subtopicId;?>&courseId=<?php echo $courseId;?>">
            <input type="button" value="Finish Review" class="btn-questions" name="finishReview"></a>

        <br />
        <hr class="separator">

        <!-- Next Action buttons -->
        <div class="next-action">
            <a href="purchasedCourseDetails.php?lesson=<?php echo $courseId;?>">
            <input type="button" value="Back to lesson" class="btn-questions backToLessons" name="attemptQuiz"></a>

            <button type="button" class="btn" id="disable" onclick="window.location.href='#'">Next Subtopic 1.2</button>
        </div>

        <br />

        <!-- Footer -->
        <?php
            require_once('../../assets/includes/footer.php');
        ?>
    </body>
</html>