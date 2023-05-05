<?php
    session_start();
    include('../../assets/includes/navbar-student.php');
    require('../../config/dbconnection.php');

    if (!isset($_SESSION['studentname'])) {
        header('location: ../../student_login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Mansala</title>
    <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../assets/css/questionsViewStudent.css"></link>
    <link rel="stylesheet" href="../../assets/css/teacher-style.css"></link>
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
        $courseDescription = $row['courseDescription'];

        $subtopicId=$_GET['subId'];
        $sql = "SELECT * FROM subtopic WHERE subtopicId='$subtopicId'";
        $result = mysqli_query($connection,$sql);
        $row = mysqli_fetch_assoc($result);
        $subtopicName=$row['subTopicName'];

        $attempt = $_GET['attempt'];
    ?>
        <!--Course Details-->
        <div class="course-details-box">
            <p id="title"><?php echo $courseName; ?></p>
        <p class="lesson-desc">
            <?php echo $courseDescription; ?>
        </p>
        </div>

        <!--Set Subtopic Name-->
        <div class="subtopic-title">
            <p> <?php echo $subtopicName; ?> </p>
        </div>

        <!--Attempt a Question-->
        <div class="question" id="new-question">
                <?php
                        // Number of questions attempted
                        $sql_questions = "SELECT COUNT(*) AS num_questions_done FROM student_modelpaperquestion WHERE subTopicId='$subtopicId' AND phoneNumber = '{$_SESSION['studentphone']}' AND attempt = '$attempt'";
                        $result_questions = mysqli_query($connection, $sql_questions);
                        $row_questions = mysqli_fetch_assoc($result_questions);
                        
                        ?>
                        <p class="questions-count"> <?php echo $row_questions['num_questions_done']+1 . " out of 5"; ?></p>
                        <?php

                        // Check whether it is under 5 or not
                        if((int)$row_questions['num_questions_done']%5 > 0 && (int)$row_questions['num_questions_done']%5 != 4 && (int)$row_questions['num_questions_done'] <=5 || (int)$row_questions['num_questions_done'] == 0 )
                        {
                            $sql = "SELECT q.* FROM modelpaperquestion q LEFT JOIN student_modelpaperquestion smq ON q.questionId = smq.questionId
                            AND smq.subTopicId = q.subTopicId AND smq.phoneNumber = '{$_SESSION['studentphone']}' WHERE q.subTopicId = '$subtopicId' AND smq.questionId IS NULL
                            ORDER BY RAND() LIMIT 1";

                            $result = mysqli_query($connection, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $questionId = $row['questionId'];

                            if($row !=0)
                            {
                                ?>
                                    <form action="../../config/studentconfig/questionsViewStudent.config.php" method="POST">
                                        <!-- Getting variable values -->
                                        <input type="text" class="course-input title" name="subtopicId" value="<?php echo $subtopicId; ?>" readonly hidden>
                                        <input type="text" class="course-input title" name="courseId" value="<?php echo $courseId; ?>" readonly hidden>
                                        <input type="text" class="course-input title" name="attempt" value="<?php echo $attempt; ?>" readonly hidden>
                                        <input type="text" class="course-input title" name="phoneNumber" value="<?php echo $_SESSION['studentphone']; ?>" readonly hidden>

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
                                            <!-- Not sure about implementing this -->
                                            <input type="submit" value="Previous" class="btn-question" name="Previous">
                                            <input type="submit" value="Back to Lesson" class="btn-question" id="back" name="back">
                                            <input type="submit" value="Next" class="btn-question" name="Next">
                                        </div>
                                    </form>
                                <?php
                            }
                            else
                            {
                                // This whole part is for not getting empty pages because of rand function

                                // Number of questions attempted
                                $sql_questionsCount1 = "SELECT count(*) from student_modelpaperquestion where subTopicId='$subtopicId' AND phoneNumber = '{$_SESSION['studentphone']}'";
                                $result_questionsCount1 = mysqli_query($connection, $sql_questionsCount1);
                                $row_questionsCount1 = mysqli_fetch_assoc($result_questionsCount1);

                                // check whether all the questions of that subtopic has been done by a student or not
                                $sql_questionsCount2 = "SELECT count(*) from modelpaperquestion where subTopicId='$subtopicId'";
                                $result_questionsCount2 = mysqli_query($connection, $sql_questionsCount2);
                                $row_questionsCount2 = mysqli_fetch_assoc($result_questionsCount2);

                                if($row_questionsCount1 <= $row_questionsCount2)
                                {
                                    echo "<script>window.location.href='questionsViewStudent.php?courseId=$courseId&subId=$subtopicId&attempt=$attempt'</script>";
                                }
                                else
                                {
                                    echo "<script>alert('You have completed all the questions of this subtopic.')</script>";
                                    echo "<script>window.location.href='../../views/studentviews/purchasedCourseDetails.php?lesson=$courseId'</script>";
                                }
                            }
                        }
                        else if((int)$row_questions['num_questions_done']%5 == 4)
                        {
                                $sql = "SELECT q.* FROM modelpaperquestion q LEFT JOIN student_modelpaperquestion smq ON q.questionId = smq.questionId
                                AND smq.subTopicId = q.subTopicId AND smq.phoneNumber = '{$_SESSION['studentphone']}' WHERE q.subTopicId = '$subtopicId' AND smq.questionId IS NULL
                                ORDER BY RAND() LIMIT 1";

                                $result = mysqli_query($connection, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $questionId = $row['questionId'];

                                if($row !=0)
                                {
                                    ?>
                                        <form action="../../config/studentconfig/questionsViewStudent.config.php" method="POST">
                                            <!-- Getting variable values -->
                                            <input type="text" class="course-input title" name="subtopicId" value="<?php echo $subtopicId; ?>" readonly hidden>
                                            <input type="text" class="course-input title" name="courseId" value="<?php echo $courseId; ?>" readonly hidden>
                                            <input type="text" class="course-input title" name="phoneNumber" value="<?php echo $_SESSION['studentphone']; ?>" readonly hidden>
                                            <input type="text" class="course-input-title" name="attempt" value="<?php echo $attempt?>" readonly hidden>

                                            <div class="question-number-box">
                                                <textarea class="question-number" name="questionNumber" readonly style="resize: none;"><?php echo $questionId; ?></textarea>
                                            </div>

                                            <div>
                                                <textarea class="question-add" name="question" rows="4" cols="100" readonly><?php echo $row['question'];?></textarea>
                                            </div>
                                                        
                                            <textarea class="option" name="option1" rows="4" cols="60" readonly><?php echo $row['option1'];?></textarea>
                                            <input type="radio" class="input-option" name="answer" value="option1">
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
                                                <!-- Not sure about implementing this -->
                                                <input type="submit" value="Previous" class="btn-question" name="Previous">
                                                <input type="submit" value="Back to Lesson" class="btn-question" id="back" name="back">
                                                <input type="submit" value="Finish" class="btn-question" name="Finish">
                                            </div>
                                        </form>
                                    <?php
                                }
                        }
                        else
                        {
                            header('location: ../../views/studentviews/quizReviewSummary.php?courseId='.$courseId.'&subId='.$subtopicId.'');
                        }
                ?>  
        </div>

        <!-- Footer -->
        <?php
            require_once('../../assets/includes/footer.php');
        ?>
    </body>

</html>