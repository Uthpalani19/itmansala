<?php
    session_start();
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
        <link rel="stylesheet" href="css/quiz.css"></link>

    </head>

    <body>
        <!--Course Details-->
        <div class="course-details-box">
            <p id="title">Lesson 01: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <p id="content">Maecenas vel condimentum est. Morbi auctor sed sem id condimentum. Fusce efficitur gravida scelerisque. Nam ut neque viverra, tempor lectus eget, scelerisque urna. Nullam eleifend finibus tincidunt. Duis turpis erat, porta ac erat non, vestibulum tristique orci. Nam sit amet auctor diam, et sollicitudin massa. Mauris tempus,
                sapien a cursus fermentum, tellus turpis viverra risus, sit amet congue ex velit at elit.</p>
        </div>

        <!--Subtopic Details-->
        <div class="subtopic">
            <div class="subtopic-done"></div>
            <div class="subtopic-title">
                <p>1.1 Basic building blocks of information and their characteristics</p>
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
                <p>Life cycle of data</p>
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
        <input type="submit" value="Add Questions" class="btn-questions" name="addQuestions" onClick="addQuestions()">
        <input type="submit" value="View Questions" class="btn-questions-view" name="viewQuestions"  onClick="viewQuestions()">

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


