<?php
    require('../../config/dbconnection.php');
    require_once('../../assets/includes/navbar-teacher.php');
    require('C:\xampp\htdocs\itmansala\src\config\teacherconfig\addQuestions.config.php');

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
    </body>
</html>