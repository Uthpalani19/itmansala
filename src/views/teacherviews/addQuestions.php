<?php
    require('../../config/dbconnection.php');
    require('../../assets/includes/navbar-teacher.php');

    // Auto generated ID
    $sql = "SELECT questionId FROM modelpaperquestion ORDER BY questionId DESC LIMIT 1";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result);
    $lastid = "";
    
    if(mysqli_num_rows($result) > 0)
    {
        $lastid = $row['questionId'];
    }
    
    if(empty($lastid))
    {
        $id = "Q001";
    }
    else
    {
        $id = substr($lastid, 1);
        $id = intval($id);
        $id++;
    
        if($id < 10)
        {
            $id = "Q00" . $id;
        }
        elseif($id < 100)
        {
            $id = "Q0" . $id;
        }
        else
        {
            $id = "Q" . $id;
        }
    }
    
?>

<html>
    <head>
        <title>Manage Questions</title>
        <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../assets/css/teacher-style.css"></link>
        <link rel="stylesheet" href="../../assets/css/global.css"></link>
    </head>

    <body>
        <!--Course Details-->
        <form action="../../config/teacherconfig/addQuestions.config.php" method="POST">
            <div class="course-details-box">
                <p id="title">Course 01: Course name should be loaded </p>
            </div>

            <!--Set Subtopic Name-->
            <div class="subtopic-title">
                <p> Subtopic name should be loaded </p>
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
                <textarea placeholder="Enter the option 5 " class="option" name="option5" rows="4" cols="60"></textarea>
                <input type="radio" class="input-option" name="answer" value="option5">

                <br />

                <!--div class="buttons"-->
                    <input type="submit" value="Finish" class="btn-question" name="finish">
                    <input type="submit" value="Add Questions" class="btn-question" id="question" name="addQuestions">
                <!--/div-->
            </div>
            <p class="instruction">**Please note that you have to add at least 5 questions per subtopic in order to make it available for students. If you add less number of questions, still it will be appeared for you but the whole subtopic will be unavailable for students.</p>
        </form>
        
    </body>
</html>