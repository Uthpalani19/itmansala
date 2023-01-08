<?php
    session_start();
    require_once('src\assets\includes\navbar-teacher.php');
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
        <title>View Questions</title>
        <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
        <script type="text/javascript">
                
        </script>
        <link rel="stylesheet" href="src/assets/css/teacher-style.css"></link>
    </head>

    <body>
        <!--Course Details-->
        <div class="course-details-box">
            <p id="title">Lesson 01: දත්ත සහ තොරතුරු </p>
        </div>

        <!--Set Subtopic Name-->
        <div class="subtopic-title">
            <p> 1.1 දත්ත සහ තොරතුරු වල මූලික තැනුම් ඒකක හා ඒවායේ ගති ලක්ෂණ </p>
        </div>

        <div>
            <center>
                <p id="purple-text">Deleted Questions</p>
            <table class="addedQuestions">
                <tr>
                    <th>No:</th>
                    <th>Question</th>
                    <th>Option 01</th>
                    <th>Option 02</th>
                    <th>Option 03</th>
                    <th>Option 04</th>
                    <th>Answer</th>
                    <th>Recover</th>
                </tr>

            <!--PHP Code-->
            <?php
                $sql="SELECT * FROM modelpaperquestion where status=0";
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
                            <td><a href="viewDeletedQuestions.php?recoverId='.$row['questionId'].'"><i class="fa fa-reply fa-lg" aria-hidden="true" id="edit-icon"></i></td>
                        </tr>
                    ';
                }
            ?>
            </table>
            </center>
        </div>

    <!-- Footer -->
    <div class="footer">
            <?php
                    require_once('footer.php');
            ?>
        </div>
    </body>
</html>