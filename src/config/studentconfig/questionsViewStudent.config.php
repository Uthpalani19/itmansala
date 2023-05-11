<?php
    session_start();
    include('../../assets/includes/navbar-student.php');
    require('../../config/dbconnection.php');

    if (!isset($_SESSION['studentname'])) {
        header('location: ../../student_login.php');
    }


    // Add Question Button
    if(isset($_POST['Next']) || isset($_POST['Finish']) || isset($_POST['Previous']))
    {
       $courseId = $_POST['courseId'];
       $subtopicId = $_POST['subtopicId'];
       $phoneNumber = $_SESSION['studentphone'];
       $questionId = $_POST['questionId'];
       $answerOption = $_POST['answer'];
       $attempt = $_POST['attempt'];
       $questionNumber = $_POST['questionNumber'];
       
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

        $sql = "SELECT * from modelpaperquestion where subtopicId = '$subtopicId' and questionId = '$questionId'";

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
        $sqlCheckQuestion = "SELECT * from student_modelpaperquestion where questionNumber = '$questionNumber'";
        $resultCheckQuestion = mysqli_query($connection,$sqlCheckQuestion);
        $rowCheckQuestion = mysqli_fetch_assoc($resultCheckQuestion);

        // If the question is not answered before
        if($rowCheckQuestion<=0)
        {
            // Storing the answer
            $sqlAnswer = "INSERT into student_modelpaperquestion (phoneNumber, subTopicId, questionId, answer, attempt, score) VALUES ('$phoneNumber','$subtopicId','$questionId','$answer','$attempt','$score')";
            $result = mysqli_query($connection,$sqlAnswer);

            if($result)
            {
                ?>
                    <script>
                        window.location.href = "../../views/studentviews/questionsViewStudent.php?courseId=<?php echo $courseId; ?>&subId=<?php echo $subtopicId?>&attempt=<?php echo $attempt;?>&questionNumber=0";
                    </script>
                <?php
            }
            else
            {
                echo "Error: " . $sqlAnswer . "<br>" . mysqli_error($connection);
            }
        }
        else
        {
            // Updating the answer
            $sqlUpdate = "UPDATE student_modelpaperquestion SET answer = '$answer', score = '$score' where phoneNumber = '$phoneNumber' and subTopicId = '$subtopicId' and questionId = '$questionId' and attempt = '$attempt'";
            $resultUpdate = mysqli_query($connection,$sqlUpdate);

            // Check whether there are any stored questions
            $questionNext = $questionNumber+1 ; 
            $sqlCheckQuestion1 = "SELECT * from student_modelpaperquestion where questionNumber = '$questionNext'";
            $resultCheckQuestion1 = mysqli_query($connection,$sqlCheckQuestion1);
            $rowCheckQuestion1 = mysqli_fetch_assoc($resultCheckQuestion1);

            if($resultUpdate && $rowCheckQuestion1>0)
            {
                ?>
                    <script>
                        window.location.href = "../../views/studentviews/questionsViewStudent.php?courseId=<?php echo $courseId; ?>&subId=<?php echo $subtopicId?>&attempt=<?php echo $attempt;?>&questionNumber=<?php echo $questionNumber+1;?>";
                    </script>
                <?php
            }
            elseif($resultUpdate && $rowCheckQuestion1<=0)
            {
                ?>
                    <script>
                        window.location.href = "../../views/studentviews/questionsViewStudent.php?courseId=<?php echo $courseId; ?>&subId=<?php echo $subtopicId?>&attempt=<?php echo $attempt;?>&questionNumber=0";
                    </script>
                <?php
            }
            else
            {}
        }
        
    }

    if(isset($_POST['Finish']))
    {
        $sqlCheckQuestion = "SELECT * from student_modelpaperquestion where questionNumber = '$questionNumber'";
        $resultCheckQuestion = mysqli_query($connection,$sqlCheckQuestion);
        $rowCheckQuestion = mysqli_fetch_assoc($resultCheckQuestion);

        // If the question is not answered before
        if($rowCheckQuestion<=0)
        {
            // Storing the answer
            $sqlAnswer = "INSERT into student_modelpaperquestion (phoneNumber, subTopicId, questionId, answer, attempt, score) VALUES ('$phoneNumber','$subtopicId','$questionId','$answer','$attempt','$score')";
            $result = mysqli_query($connection,$sqlAnswer);
        }
        else
        {
            // Updating the answer
            $sqlUpdate = "UPDATE student_modelpaperquestion SET answer = '$answer', score = '$score' where phoneNumber = '$phoneNumber' and subTopicId = '$subtopicId' and questionId = '$questionId' and attempt = '$attempt'";
            $result = mysqli_query($connection,$sqlUpdate);
        }

        if($result)
        {
             // Get the marks
            $sql_marks = "SELECT sum(score) as marks from student_modelpaperquestion where phoneNumber = '$phoneNumber' and subTopicId = '$subtopicId' and attempt = '$attempt'";
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

    if(isset($_POST['Previous']))
    {
        $sqlCheckQuestion = "SELECT * from student_modelpaperquestion where questionNumber = '$questionNumber'";
        $resultCheckQuestion = mysqli_query($connection,$sqlCheckQuestion);
        $rowCheckQuestion = mysqli_fetch_assoc($resultCheckQuestion);

        // If the question is not answered before
        if($rowCheckQuestion<=0)
        {
            // Storing the answer
            $sqlAnswer = "INSERT into student_modelpaperquestion (phoneNumber, subTopicId, questionId, answer, attempt, score) VALUES ('$phoneNumber','$subtopicId','$questionId','$answer','$attempt','$score')";
            $result = mysqli_query($connection,$sqlAnswer);
    
            if($result)
            {
                $sqlQuestionId = "SELECT questionNumber from student_modelpaperquestion where phoneNumber = '$phoneNumber' and subTopicId = '$subtopicId' and attempt = '$attempt' order by questionNumber desc limit 1";
                $resultQuestionId = mysqli_query($connection,$sqlQuestionId);
                $rowQuestionId = mysqli_fetch_assoc($resultQuestionId);

                $previousQuestionNumber = (int)$rowQuestionId['questionNumber']-1;

                ?>
                    <script>
                        window.location.href = "../../views/studentviews/questionsViewStudent.php?courseId=<?php echo $courseId; ?>&subId=<?php echo $subtopicId?>&attempt=<?php echo $attempt;?>&questionNumber=<?php echo $previousQuestionNumber;?>";
                    </script>
                <?php
            }
            else
            {
                echo "Error: " . $sqlAnswer . "<br>" . mysqli_error($connection);
            }
        }
        else
        {
            // Updating the answer
            $sqlUpdate = "UPDATE student_modelpaperquestion SET answer = '$answer', score = '$score' where phoneNumber = '$phoneNumber' and subTopicId = '$subtopicId' and questionId = '$questionId' and attempt = '$attempt'";
            $resultUpdate = mysqli_query($connection,$sqlUpdate);

            // Check whether there are any stored questions
            $questionPrevious = $questionNumber-1 ;
            $sqlCheckQuestion1 = "SELECT * from student_modelpaperquestion where questionNumber = '$questionPrevious'";
            $resultCheckQuestion1 = mysqli_query($connection,$sqlCheckQuestion1);
            $rowCheckQuestion1 = mysqli_fetch_assoc($resultCheckQuestion1);

            if($resultUpdate && $rowCheckQuestion1>0)
            {
                ?>
                    <script>
                        window.location.href = "../../views/studentviews/questionsViewStudent.php?courseId=<?php echo $courseId; ?>&subId=<?php echo $subtopicId?>&attempt=<?php echo $attempt;?>&questionNumber=<?php echo $questionNumber-1;?>";
                    </script>
                <?php
            }
            else
            {
                echo "Error: " . $sqlUpdate . "<br>" . mysqli_error($connection);
            }
        }
    }
?>