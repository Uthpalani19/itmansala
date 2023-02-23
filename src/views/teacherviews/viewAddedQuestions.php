<!-- Common -->
<?php 
    // Navigation Bar
    require_once('../../assets/includes/navbar-teacher.php');
    session_start();
    require('../../config/dbconnection.php');
    if(!isset($_SESSION['name']))
    {
        header('location:C:\xampp\htdocs\itmansala\src\index.php');
    }

    if(isset($_GET['logout']))
    {
        session_destroy();
        unset($_SESSION['name']);
        header('location:C:\xampp\htdocs\itmansala\src\index.php');
    }
?>

<head>
        <title>View Questions</title>
        <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../assets/css/global.css"></link>
        <link rel="stylesheet" href="../../assets/css/teacher-style.css"></link>
    </head>

    <body>
<?php
    if(isset($_POST['viewQuestions']))
    {?>
        <!--Course Details-->
        <div class="course-details-box">
            <p id="title">Course 01: <?php $_POST['subtopic']; ?> </p>
        </div>

        <!--Set Subtopic Name-->
        <div class="subtopic-title">
            <p> 1.1 දත්ත සහ තොරතුරු වල මූලික තැනුම් ඒකක හා ඒවායේ ගති ලක්ෂණ </p>
        </div>

<!-- View Added Questions of a specific subtopic -->
<?php 
        ?>
        <!-- Questions Recovery -->
        <div class="recover"> 
            <button class="recover-btn"  onclick="window.location.href='../../config/teacherconfig/recoverQuestions.php'"> <i class="fa-large fas fa-trash-restore" id="recover-icon"
            ></i> Recover Questions</button>
        </div>

        <div>
            <center>
            <table class="addedQuestions">
                <tr>
                    <th>No:</th>
                    <th>Question</th>
                    <th>Option 01</th>
                    <th>Option 02</th>
                    <th>Option 03</th>
                    <th>Option 04</th>
                    <th>Answer</th>
                    <th>Edit</th>
                    <th>Del</th>
                </tr>

            <!--PHP Code-->
            <?php
                $sql="SELECT * FROM modelpaperquestion where status=1 having subtopicId=1";
                $result = mysqli_query($connection,$sql);

                while($row = mysqli_fetch_assoc($result))
                {
                    echo '
                        <tr>
                            <td>'.$row['questionId'].'</td>
                            <td>'.$row['question'].'</td>
                            <td>'.$row['option1'].'</td>
                            <td>'.$row['option2'].'</td>
                            <td>'.$row['option3'].'</td>
                            <td>'.$row['option4'].'</td>
                            <td>'.$row['answer'].'</td>
                            <td><a href="../../config/teacherconfig/editQuestions.config.php?editId='.$row['questionId'].'"><i class="fa-solid fa-large fa-file-pen" id="edit-icon" ></i></td>
                            <td><a href="../../config/teacherconfig/deleteQuestions.config.php?deleteId='.$row['questionId'].'"><i class="fa-solid fa-large fa-trash" id="edit-icon"></i></td>
                        </tr>
                    ';
                }
            ?>
            </table>
            </center>
        </div>
        <?php
    }
?>

<!-- Add a question to a specific subtopic -->
<?php
if(isset($_POST['addQuestions']))
    {
        ?>
        <!-- Questions Recovery -->
        <div class="recover"> 
            <button class="recover-btn"  onclick="window.location.href='../../config/teacherconfig/recoverQuestions.php'"> <i class="fa-large fas fa-trash-restore" id="recover-icon"
            ></i> Recover Questions</button>
        </div>

       <!--Add a new Question-->
       <div class="question">
            <div class="question-number-box">
                <textarea class="question-number" name="questionNumber" readonly style="resize: none;"><?php echo $id; ?></textarea>
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
        <?php
    }
?>

<!-- Footer -->
<div class="footer">
            <?php
                require_once('../../assets/includes/footer.php');
            ?>
        </div>