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

    <body class="body-2">

        <!--Course Details-->
        <div class="course-details-box">
            <p id="title">Course 01: Course Name should be loaded </p>
        </div>

        <!--Set Subtopic Name-->
        <div class="subtopic-title">
            <p> 1.1 Subtopic name should be loaded </p>
        </div>

<!-- View Added Questions of a specific subtopic -->

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
                    <th>Option 05</th>
                    <th>Answer</th>
                    <th>Edit</th>
                    <th>Del</th>
                </tr>

            <!--PHP Code-->
            <?php
                $sql="SELECT * FROM modelpaperquestion where status=1 having subtopicId='1.1'";
                $result = mysqli_query($connection,$sql);

                // Paginations
                $limit = 5;
                $total_records = mysqli_num_rows($result);
                $total_pages = ceil($total_records / $limit);

                // for($i=1; $i<=$total_pages; $i++)
                // {
                //     echo '<button class="pagination"><a class="pagination-text" href="viewAddedQuestions.php?page='.$i.'">'.$i.'</a></button>';
                // }

                if(isset($_GET['page']))
                {
                    $page=$_GET['page'];
                }
                else
                {
                    $page='1';
                }

                $startinglimit = ($page-1)*$limit;
                $sql="SELECT * FROM modelpaperquestion where status=1 having subtopicId='1.1' LIMIT ".$startinglimit.','.$limit;
                $result2 = mysqli_query($connection,$sql);
                
                while($row = mysqli_fetch_assoc($result2))
                {
                    echo '
                        <tr>
                            <td>'.$row['questionId'].'</td>
                            <td>'.$row['question'].'</td>
                            <td>'.$row['option1'].'</td>
                            <td>'.$row['option2'].'</td>
                            <td>'.$row['option3'].'</td>
                            <td>'.$row['option4'].'</td>
                            <td>'.$row['option5'].'</td>
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
        <div class="pagination-container">
            <?php
            for($i=1; $i<=$total_pages; $i++)
            {
                echo '<button class="pagination"><a class="pagination-text" href="viewAddedQuestions.php?page='.$i.'">'.$i.'</a></button>';
            }
            ?>
        </div>

<!-- Footer -->
<div class="footer">
            <?php
                require_once('../../assets/includes/footer.php');
            ?>
</div>