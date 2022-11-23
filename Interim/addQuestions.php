<?php
    session_start();
    require('dbconnection.php');
    // Navigation Bar
    require_once('navbar-teacher.php');

    if(isset($_SESSION['User']))
    {
        //echo '<a href="logout.php?logout">Logout</a>';
    }
    else
    {
        header("location:index.php");
    }

    /* Auto generated ID */
    $sql = "Select questionId from modelpaperquestion order by questionId desc limit 1";
    $result = mysqli_query($connection,$sql);
    $row = mysqli_fetch_array($result);
    $lastid="";
    
    if(mysqli_num_rows($result) > 0)
    {
        $lastid = $row['questionId'];
    }

    if($lastid == " ")
    {
        $id = "Q001";
    }
    else
    {
        $id = substr($lastid,3);
        $id = intval($id);

        if($id>='9')
        {
            $id = "Q0".($id + 1);
        }
        else if($id>='99')
        {
            $id = "Q".($id + 1);            
        }
        else
        {
            $id = "Q00".($id + 1);
        }
    }


    if(isset($_POST['addQuestions']) || isset($_POST['FinishQuiz']))
    {
        // Check if the fields are not empty
        if(!empty($_POST['question']) && !empty($_POST['option1']) && !empty($_POST['option2']) && !empty($_POST['option3']) && !empty($_POST['option4']) && !empty($_POST['answer']))
        {
                $id= mysqli_real_escape_string($connection,$id);
                $question= mysqli_real_escape_string($connection,$_POST['question']);
                $answer= mysqli_real_escape_string($connection,$_POST['answer']);
                $option1= mysqli_real_escape_string($connection,$_POST['option1']);
                $option2= mysqli_real_escape_string($connection,$_POST['option2']);    
                $option3= mysqli_real_escape_string($connection,$_POST['option3']); 
                $option4= mysqli_real_escape_string($connection,$_POST['option4']); 

                if($answer == $option1 || $answer == $option2 || $answer == $option3 || $answer == $option4)
                {
                    $sql = "INSERT INTO modelpaperquestion (questionId, subtopicId,question, answer, option1,option2,option3,option4,status)
                    VALUES ('$id', 'S001','$question','$answer','$option1','$option2','$option3','$option4',1)";
                        
                    if(isset($_POST['FinishQuiz']))
                    {
                        if ($connection->query($sql) === TRUE)
                        {?>
                            <script type="text/javascript">
                                alert("Quiz added successfully.");
                                window.location.href="editCourseContent.php";
                            </script>
                        <?php
                        }
                        else
                        {?>
                            <script type="text/javascript">
                                alert("Try Again!!.");
                                window.location.href=window.location.href;
                            </script>
                        <?php
                        }
                    }
                    else 
                    {
                        if ($connection->query($sql) === TRUE)
                        {?>
                            <script type="text/javascript">
                                alert("Question added successfully.");
                                window.location.href=window.location.href;
                            </script>
                        <?php
                        }
                        else
                        {?>
                            <script type="text/javascript">
                                alert("Try Again!!.");
                                window.location.href=window.location.href;
                            </script>
                        <?php
                        }
                    }
                }
                else
                {
                    ?>
                    <script type="text/javascript">
                        alert("Answer should be one from options.");
                    </script>
                <?php
                }
            
        }
        else
        {
        ?>
            <script type="text/javascript">
                alert("All fields are required.");
            </script>
        <?php
        }
    }
?>

<html>
    <head>
        <title>Manage Questions</title>
        <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
        <!--script src="js/logout.js"></script-->
        <link rel="stylesheet" href="css/addQuestions.css"></link>
    </head>

    <body>

        <!--Course Details-->
        <form action="" method="POST">
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
                <label class="question-number" name="questionNumber" ><?php echo $id; ?></label>
            </div>

            <div>
                <textarea placeholder="Enter the question here.." class="question-add" name="question" rows="4" cols="100"></textarea>
            </div>
            
            <textarea placeholder="Enter the option 1 " class="option" name="option1" rows="4" cols="60"></textarea>
            <textarea placeholder="Enter the option 2 " class="option" name="option2" rows="4" cols="60"></textarea>
            <textarea placeholder="Enter the option 3 " class="option" name="option3" rows="4" cols="60"></textarea>
            <textarea placeholder="Enter the option 4 " class="option" name="option4" rows="4" cols="60"></textarea>
            <textarea placeholder="Enter the Correct answer " class="answer" name="answer" rows="4" cols="60"></textarea>

            <br />

            <!--div class="buttons"-->
                <input type="submit" value="Finish Quiz" class="btn-question" name="FinishQuiz">
                <input type="submit" value="Add Questions" class="btn-question" id="question" name="addQuestions">
            <!--/div-->
            
            </form>
        </div>

        <!-- Footer -->
        <?php
            require_once('footer.php');
        ?>
    </body>
</html>