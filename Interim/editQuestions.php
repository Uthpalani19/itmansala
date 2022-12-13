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
                                    <textarea class="question-add" name="question" placeholder="Question" rows="4" cols="100" required><?php echo $question; ?></textarea>
                                </div>
                                <div>
                                    <textarea class="option" name="option1" placeholder="Option 1" rows="4" cols="60" required><?php echo $option1; ?></textarea>
                                </div>
                                <div>
                                    <textarea class="option" name="option2" placeholder="Option 2" rows="4" cols="60" required><?php echo $option2; ?></textarea>
                                </div>
                                <div>
                                    <textarea class="option" name="option3" placeholder="Option 3" rows="4" cols="60" required><?php echo $option3; ?></textarea>
                                </div>
                                <div>
                                    <textarea class="option" name="option4" placeholder="Option 4" rows="4" cols="60" required><?php echo $option4; ?></textarea>
                                </div>
                                <div>
                                    <textarea class="answer" name="answer" placeholder="Answer" rows="4" cols="60" required><?php echo $answer; ?></textarea>
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
                                            // Check if the answer is one of the options
                                            if($_POST['answer'] == $_POST['option1'] || $_POST['answer'] == $_POST['option2'] || $_POST['answer'] == $_POST['option3'] || $_POST['answer'] == $_POST['option4'])
                                            {
                                                $question = $_POST['question'];
                                                $option1 = $_POST['option1'];
                                                $option2 = $_POST['option2'];
                                                $option3 = $_POST['option3'];
                                                $option4 = $_POST['option4'];
                                                $answer = $_POST['answer'];

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
                                                echo "<script>alert('Answer is not one of the options!')</script>";
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