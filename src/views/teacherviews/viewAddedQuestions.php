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

<html>
    <head>
        <title>View Questions</title>
        <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
        <script type="text/javascript">
                
        </script>
        <link rel="stylesheet" href="../../assets/css/global.css"></link>
        <link rel="stylesheet" href="../../assets/css/teacher-style.css"></link>
    </head>

    <body>
        <!--Course Details-->
        <div class="course-details-box">
            <p id="title">Course 01: දත්ත සහ තොරතුරු </p>
        </div>

        <!--Set Subtopic Name-->
        <div class="subtopic-title">
            <p> 1.1 දත්ත සහ තොරතුරු වල මූලික තැනුම් ඒකක හා ඒවායේ ගති ලක්ෂණ </p>
        </div>

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
                $sql="SELECT * FROM modelpaperquestion where status=1";
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

        <!-- Footer -->
        <div class="footer">
            <?php
                require_once('../../assets/includes/footer.php');
            ?>
        </div>
    </body>

    <?php
            // include('../../config/teacherconfig/deleteQuestions.config.php');
    ?>
</html>