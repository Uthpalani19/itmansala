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

<?php
    // Auto generated ID
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

    // Finish Button

    if(isset($_POST['finish']))
    {
        ?>
            <script type="text/javascript">
            alert("Quiz added successfully.");
            window.location.href="viewAddedQuestions.php";
            </script>
        <?php
    }

    // Add Question Button

    if(isset($_POST['addQuestions']))
    {
        // Check if the fields are not empty
        if(!empty($_POST['question']) && !empty($_POST['option1']) && !empty($_POST['option2']) && !empty($_POST['option3']) && !empty($_POST['option4']))
        {
            // Check if the options are not same
            if($_POST['option1'] != $_POST['option2'] && $_POST['option1'] != $_POST['option3'] && $_POST['option1'] != $_POST['option4'] && $_POST['option2'] != $_POST['option3'] && $_POST['option2'] != $_POST['option4'] && $_POST['option3'] != $_POST['option4'])
            {
                $id= mysqli_real_escape_string($connection,$id);
                $question= mysqli_real_escape_string($connection,$_POST['question']);
                $option1= mysqli_real_escape_string($connection,$_POST['option1']);
                $option2= mysqli_real_escape_string($connection,$_POST['option2']);    
                $option3= mysqli_real_escape_string($connection,$_POST['option3']); 
                $option4= mysqli_real_escape_string($connection,$_POST['option4']); 
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
                
                $answer = mysqli_real_escape_string($connection,$answer);

                // Insert the question to the database
                $sql = "INSERT INTO modelpaperquestion (questionId, subtopicId,question, answer, option1,option2,option3,option4,status)
                    VALUES ('$id', 'S001','$question','$answer','$option1','$option2','$option3','$option4',1)";
                        
                if ($connection->query($sql) === TRUE)
                {?>
                    <script type="text/javascript">
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
            else
            {
            ?>
                <script type="text/javascript">
                    alert("Answers should be different from each other.");
                </script>
            <?php
            }  
        }
        else
        {
            ?>
                <script type="text/javascript">
                    alert("Answers should not be empty.");
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
        <link rel="stylesheet" href="src/assets/css/teacher-style.css"></link>
    </head>

    <body>

        <!--Course Details-->
        <form action="" method="POST">
        <div class="course-details-box">
            <p id="title">Lesson 01: දත්ත සහ තොරතුරු.</p>
        </div>

        <!--Set Subtopic Name-->
        <div class="subtopic-title">
            <p> 1.1 දත්ත සහ තොරතුරු වල මූලික තැනුම් ඒකක හා ඒවායේ ගති ලක්ෂණ </p>
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
            <input type="radio" class="input-option" name="answer" checked value="option1">
            <textarea placeholder="Enter the option 2 " class="option" name="option2" rows="4" cols="60"></textarea>
            <input type="radio" class="input-option" name="answer" value="option2">
            <textarea placeholder="Enter the option 3 " class="option" name="option3" rows="4" cols="60"></textarea>
            <input type="radio" class="input-option" name="answer" value="option3">
            <textarea placeholder="Enter the option 4 " class="option" name="option4" rows="4" cols="60"></textarea>
            <input type="radio" class="input-option" name="answer" value="option4">

            <br />

            <!--div class="buttons"-->
                <input type="submit" value="Finish" class="btn-question" name="finish">
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