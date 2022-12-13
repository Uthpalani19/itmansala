<?php
    session_start();
    require_once('dbconnection.php');
    
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
        <title>View Questions</title>
        <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
        <script type="text/javascript">
                
        </script>
        <link rel="stylesheet" href="css/teacher-style.css"></link>
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

        <!-- Questions Recovery -->
        <div class="recover"> 
            <button class="recover-btn"  onclick="window.location.href='recoverQuestions.php'"> <i class="fa-large fas fa-trash-restore" id="recover-icon"
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
                            <td><a href="editQuestions.php?editId='.$row['questionId'].'"><i class="fa-solid fa-large fa-file-pen" id="edit-icon" ></i></td>
                            <td><a href="deleteQuestions.php?deleteId='.$row['questionId'].'"><i class="fa-solid fa-large fa-trash" id="edit-icon"></i></td>
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