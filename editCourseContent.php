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
        <script>
            function addQuestions()
            {
                window.location.href="addQuestions.php";
            }
            function viewQuestions()
            {
                window.location.href="viewAddedQuestions.php";
            }
        </script>
        <link rel="stylesheet" href="css/teacher-style.css"></link>

    </head>

    <body class="grey-bg">
        <!--Course Details-->
        <div class="course-details-box">
            <p id="title">Lesson 01: දත්ත සහ තොරතුරු. </p>
            <p id="content">දත්ත යනු තනි පුද්ගල කරුණු ලෙස අර්ථ දක්වා ඇති අතර තොරතුරු යනු එම කරුණු සංවිධානය කිරීම සහ අර්ථ නිරූපණය කිරීමයි. </p>
        </div>

        <!--Subtopic Details-->
        <div class="subtopic">
            <div class="subtopic-done"></div>
            <div>
                <p>1.1 දත්ත සහ තොරතුරු වල මූලික තැනුම් ඒකක හා ඒවායේ ගති ලක්ෂණ</p>
            </div>
            <div class="subtopic-edit">
                <p><i class="fa-solid fa-lg fa-file-pen" id="edit-icon"></i></p>
            </div>
            <div class="subtopic-progress">
                <p>0/1</p> <!--Should be auto generated--> 
            </div>
            <div class="subtopic-dropdown">
                <p><i class="fa fa-lg fa-sort-desc" aria-hidden="true" id="dropdown-icon"></i></p>
            </div>
        </div>

        <!--Lessons Details-->
        <div class="lesson">
            <div>
                <p>දත්තවල ජීවන චක්‍රය</p>
            </div>
            <div class="lesson-edit">
                <p><i class="fa-solid fa-lg fa-file-pen" id="edit-icon"></i></p>
            </div>
        </div>

        <div class="lesson-new">
            <div>
                <p><i class="fa fa-lg fa-plus-circle" aria-hidden="true" id="plus-icon"></i></p>
            </div>
            <div class="lesson-new-topic">
                <p>Click here to add a lesson</p>
            </div>
        </div>

        <!--Add Questions button-->
        <input type="submit" value="Add Questions" class="btn-questions add-questions" name="addQuestions" onClick="addQuestions()">
        <input type="submit" value="View Questions" class="btn-questions view-questions" name="viewQuestions"  onClick="viewQuestions()">

        <!--Subtopic Details-->
        <div class="subtopic-new">
            <div>
                <p><i class="fa fa-lg fa-plus-circle" aria-hidden="true" id="plus-icon"></i></p>
            </div>
            <div class="subtopic-new-topic">
                <p>Click here to add a sub topic</p>
            </div>
        </div>
        
        <br> <br> <br> <br> <br> <br>
        <!-- Footer -->
        <?php
            require_once('footer.php');
        ?>
    </body>
</html>


