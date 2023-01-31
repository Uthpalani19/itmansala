<?php
    session_start();
    require('../dbconnection.php');

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


//  Footer 

    require_once('../../assets/includes/footer.php');
?>