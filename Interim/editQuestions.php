<?php
    session_start();
    require_once('navbar-teacher.php');
    require('dbconnection.php');

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

<html>
    <head>
        <title>Manage Questions</title>
        <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
        <!--script src="js/logout.js"></script-->
        <link rel="stylesheet" href="css/teacher-style.css"></link>
    </head>

    <body>

        <form action="" method="POST">
            <!--Course Details-->
            <div class="course-details-box">
                <p id="title">Lesson 01: දත්ත සහ තොරතුරු </p>
            </div>

            <!--Set Subtopic Name-->
            <div class="subtopic-title">
                <p> 1.1 දත්ත සහ තොරතුරු වල මූලික තැනුම් ඒකක හා ඒවායේ ගති ලක්ෂණ </p>
            </div>

            <div class="question">
                <!--Load Question ID-->
                <div class="question-number-box">
                    <?php $questionID = $_GET['editId'];?>
                    <label class="question-number" name="questionNumber" ><?php echo $questionID; ?></label>
                </div>

                <!-- Load Question Details -->
                <?php
                    $sql="SELECT * FROM modelpaperquestion where questionId='$questionID'";
                    $result = mysqli_query($connection,$sql);
                    $row = mysqli_fetch_assoc($result);
                
                    if($row['status']==1)
                    {
                        $question = $row['question'];
                        $option1 = $row['option1'];
                        $option2 = $row['option2'];
                        $option3 = $row['option3'];
                        $option4 = $row['option4'];
                        $answer = $row['answer'];

                        ?>
                                <div class="question-box">
                                    <textarea class="question-add" name="question" placeholder="Question" rows="4" cols="100" required><?php echo $question; ?></textarea>                                </div>
                                <div>
                                    <textarea class="option" name="option1" placeholder="Option 1" rows="4" cols="60" required><?php echo $option1; ?></textarea>
                                    <input type="radio" class="input-option" name="answer" value="option1" <?php echo ($answer==$option1)?'checked':'' ?>>
                                </div>
                                <div>
                                    <textarea class="option" name="option2" placeholder="Option 2" rows="4" cols="60" required><?php echo $option2; ?></textarea>
                                    <input type="radio" class="input-option" name="answer" value="option2" <?php echo ($answer==$option2)?'checked':'' ?>>
                                </div>
                                <div>
                                    <textarea class="option" name="option3" placeholder="Option 3" rows="4" cols="60" required><?php echo $option3; ?></textarea>
                                    <input type="radio" class="input-option" name="answer" value="option3" <?php echo ($answer==$option3)?'checked':'' ?>>
                                </div>
                                <div>
                                    <textarea class="option" name="option4" placeholder="Option 4" rows="4" cols="60" required><?php echo $option4; ?></textarea>
                                    <input type="radio" class="input-option" name="answer" value="option4" <?php echo ($answer==$option4)?'checked':'' ?>>
                                </div>

                                <!--div class="buttons"-->
                                    <input type="submit" value="Go back" class="btn-question" name="goBack">
                                    <input type="submit" value="Save Changes" class="btn-question" id="question" name="saveChanges">
                                <!--/div-->
                            <?php
                                if(isset($_POST['saveChanges']))
                                {
                                    //Check if the question and answers are not empty
                                    if(!empty($_POST['question']) && !empty($_POST['option1']) && !empty($_POST['option2']) && !empty($_POST['option3']) && !empty($_POST['option4']) && !empty($_POST['answer']))
                                    {
                                        // Check if the options are not same
                                        if($_POST['option1'] != $_POST['option2'] && $_POST['option1'] != $_POST['option3'] && $_POST['option1'] != $_POST['option4'] && $_POST['option2'] != $_POST['option3'] && $_POST['option2'] != $_POST['option4'] && $_POST['option3'] != $_POST['option4'])
                                        {
                                                $question = $_POST['question'];
                                                $option1 = $_POST['option1'];
                                                $option2 = $_POST['option2'];
                                                $option3 = $_POST['option3'];
                                                $option4 = $_POST['option4'];
                                                $answer = $_POST['answer'];

                                                if($answer == "option1")
                                                {
                                                    $answer = $option1;
                                                }
                                                else if($answer == "option2")
                                                {
                                                    $answer = $option2;
                                                }
                                                else if($answer == "option3")
                                                {
                                                    $answer = $option3;
                                                }
                                                else if($answer == "option4")
                                                {
                                                    $answer = $option4;
                                                }

                                                $sql = "UPDATE modelpaperquestion SET question = '$question', option1 = '$option1', option2 = '$option2', option3 = '$option3', option4 = '$option4', answer = '$answer' WHERE questionID = '$questionID'";
                                                $result = mysqli_query($connection, $sql);

                                                if($result)
                                                {
                                                    echo "<script>window.location.href='viewAddedQuestions.php'</script>";
                                                }
                                                else
                                                {
                                                    echo "<script>alert('Question Update Failed!')</script>";
                                                    echo "<script>window.location.href='viewAddedQuestions.php'</script>";
                                                }
                                        }
                                        else
                                        {
                                            echo "<script>alert('Options are same!')</script>";
                                            echo "<script>window.location.href='viewAddedQuestions.php'</script>";
                                        }
                                    }
                                    else
                                    {
                                        echo "<script>alert('Question or Answers are empty!')</script>";
                                        echo "<script>window.location.href='viewAddedQuestions.php'</script>";
                                    }
                                }  
                                if(isset($_POST['goBack']))
                                {
                                    echo "<script>window.location.href='viewAddedQuestions.php'</script>";
                                }
                            }
                    else
                    {
                        echo $connection->error;
                    } 
                    ?>
                <br />
            </div>
        </form>

        <!-- Footer -->
        <?php
            require_once('footer.php');
        ?>
    </body>
</html>