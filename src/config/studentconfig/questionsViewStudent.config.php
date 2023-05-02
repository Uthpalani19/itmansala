<?php
    session_start();
    //include('../../assets/includes/navbar-student.php');
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

    // Add Question Button
    if(isset($_POST['Next']) || isset($_POST['Finish']))
    {
       $courseId = $_POST['courseId'];
       $subtopicId = $_POST['subtopicId'];
       $phoneNumber = $_SESSION['phone'];
       $questionNumber = $_POST['questionNumber'];
       $answerOption = $_POST['answer'];
       $attempt = $_POST['attempt'];

       $answer;
       $score;
       
       if($answerOption == "option1")
       {
            $answer = $_POST['option1'];
       }
       else if($answerOption == "option2")
       {
            $answer = $_POST['option2'];
       }
       else if($answerOption == "option3")
       {
            $answer = $_POST['option3'];
       }
       else if($answerOption == "option4")
       {
            $answer = $_POST['option4'];
       }
        else if($answerOption == "option5")
        {
            $answer = $_POST['option5'];
        }
        else
        {
            $answer = "No answer";
        }

        $sql = "SELECT * from modelpaperquestion where subtopicId = '$subtopicId' and questionId = '$questionNumber'";

        $result = mysqli_query($connection,$sql);
        $row = mysqli_fetch_assoc($result);

        if($row)
        {
            if($row['answer'] == $answer)
            {
                $score = 1;
            }
            else
            {
                $score = 0;
            }
        }
    }

    if(isset($_POST['Next']))
    {
        // Storing the answer
        $sqlAnswer = "INSERT into student_modelpaperquestion (phoneNumber, subTopicId, questionId, answer, attempt, score) VALUES ('$phoneNumber','$subtopicId','$questionNumber','$answer','$attempt','$score')";
        $result = mysqli_query($connection,$sqlAnswer);

        if($result)
        {
            ?>
                <script>
                    window.location.href = "../../views/studentviews/questionsViewStudent.php?courseId=<?php echo $courseId; ?>&subId=<?php echo $subtopicId?>&attempt=<?php echo $attempt;?>";
                </script>
            <?php
        }
        else
        {
            echo "Error: " . $sqlAnswer . "<br>" . mysqli_error($connection);
        }
    }

    if(isset($_POST['Finish']))
    {
        // Storing the answer
        $sqlAnswer = "INSERT into student_modelpaperquestion (phoneNumber, subTopicId, questionId, answer, attempt, score) VALUES ('$phoneNumber','$subtopicId','$questionNumber','$answer','$attempt','$score')";
        $result = mysqli_query($connection,$sqlAnswer);

        if($result)
        {
             // Get the marks
            $sql_marks = "SELECT sum(score) as marks from student_modelpaperquestion where phoneNumber = '$phoneNumber' and subTopicId = '$subtopicId'";
            $result_marks = mysqli_query($connection,$sql_marks);
            $row_marks = mysqli_fetch_assoc($result_marks);
            $marks = $row_marks['marks'];

            //Store the attempt
            $sql_quizAttempt = "INSERT into student_modelpaperquiz (phoneNumber, subTopicId, courseId, attempt,marks) VALUES ('$phoneNumber','$subtopicId','$courseId','$attempt','$marks')";
            $result_quizAttempt = mysqli_query($connection,$sql_quizAttempt);

            header('location: ../../views/studentviews/quizReviewSummary.php?courseId='.$courseId.'&subId='.$subtopicId.'');
            
        }
        else
        {
            echo "Error: " . $sqlAnswer . "<br>" . mysqli_error($connection);
        }
    }
?>