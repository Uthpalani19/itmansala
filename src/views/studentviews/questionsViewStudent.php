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
    <title>Manage Questions</title>
    <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../assets/css/questionsViewStudent.css"></link>
    <link rel="stylesheet" href="../../assets/css/teacher-style.css"></link>
    <link rel="stylesheet" href="../../assets/css/global.css"></link>
</head>

    <body>

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
    ?>
        <!--Course Details-->
        <div class="course-details-box">
            <p id="title"><?php echo $courseName; ?></p>
        </div>

        <!--Set Subtopic Name-->
        <div class="subtopic-title">
            <p> <?php echo $subtopicName; ?> </p>
        </div>

        <!--Attempt a Question-->
        <div class="question">
                <?php
                    $sql_questions = "SELECT * from modelpaperquestion where subTopicId='$subtopicId' ORDER BY RAND() LIMIT 5";
                    $result = mysqli_query($connection, $sql_questions);
                    $row = mysqli_fetch_assoc($result);

                    if($row > 0)
                    {
                        $questionId = $row['questionId'];

                        // Check whether a particular question has been done by a student or not
                        $sql_check = "SELECT * from student_modelpaperquestion where questionId='$questionId' AND phoneNumber = '{$_SESSION['phone']}'";
                        $result_check = mysqli_query($connection, $sql_check);
                        $row_check = mysqli_fetch_assoc($result_check);

                        if($row_check == 0)
                        {?>
                            <div class="question-number-box">
                                <textarea class="question-number" name="questionNumber" readonly style="resize: none;"><?php echo $questionId; ?></textarea>
                            </div>

                            <div>
                                <textarea class="question-add" name="question" rows="4" cols="100" readonly><?php echo $row['question'];?></textarea>
                            </div>
                            
                            <textarea class="option" name="option1" rows="4" cols="60" readonly><?php echo $row['option1'];?></textarea>
                            <input type="radio" class="input-option" name="answer" checked value="option1">
                            <textarea class="option" name="option2" rows="4" cols="60" readonly><?php echo $row['option2'];?></textarea>
                            <input type="radio" class="input-option" name="answer" value="option2">
                            <textarea class="option" name="option3" rows="4" cols="60" readonly><?php echo $row['option3'];?></textarea>
                            <input type="radio" class="input-option" name="answer" value="option3">
                            <textarea class="option" name="option4" rows="4" cols="60" readonly><?php echo $row['option4'];?></textarea>
                            <input type="radio" class="input-option" name="answer" value="option4">
                            <textarea class="option" name="option5" rows="4" cols="60" readonly><?php echo $row['option5'];?></textarea>
                            <input type="radio" class="input-option" name="answer" value="option5">

                            <br />

                            <div class="buttons">
                                <input type="submit" value="Previous" class="btn-question" name="Previous">
                                <input type="submit" value="Back to Lesson" class="btn-question" id="back" name="back">
                                <input type="submit" value="Next" class="btn-question" name="Next" onclick="">
                            </div>
                        <?php 
                        }
                    }
                ?>
        </div>

        <!-- Footer -->
        <?php
            require_once('../../assets/includes/footer.php');
        ?>
    </body>
</html>