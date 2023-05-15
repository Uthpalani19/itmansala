<!-- Common -->
<?php 
    // Navigation Bar
    session_start();
    require_once('../../assets/includes/navbar-admin.php');

    require('../../config/dbconnection.php');
    if(!isset($_SESSION['adminname']))
    {
        header('location:../../student_login.php');
    }

    // Get Subtopic ID
    $subId = $_GET['subId'];
    $sql = "SELECT * FROM subtopic WHERE subTopicId = '$subId'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result);
    $subName = $row['subTopicName'];

    // Get Course ID
    $courseId = $row['courseId'];
    $sql = "SELECT * FROM course WHERE courseId = '$courseId'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result);
    $courseName = $row['courseName'];
?>

<head>
        <title>View Questions</title>
        <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../assets/css/global.css"></link>
        <link rel="stylesheet" href="../../assets/css/teacher-style.css"></link>
    </head>

    <body>

        <!--Course Details-->
        <div class="course-details-box">
            <p id="title"><?php echo $courseName; ?> </p>
        </div>

        <!--Set Subtopic Name-->
        <div class="subtopic-title">
            <p> <?php echo $subName; ?> </p>
        </div>

<!-- View Added Questions of a specific subtopic -->

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
                </tr>

            <!--PHP Code-->
            <?php
                $sql="SELECT * FROM modelpaperquestion where status=1 having subtopicId='$subId'";
                $result = mysqli_query($connection,$sql);

                // Paginations
                $limit = 5;
                $total_records = mysqli_num_rows($result);
                $total_pages = ceil($total_records / $limit);

                if(isset($_GET['page']))
                {
                    $page=$_GET['page'];
                }
                else
                {
                    $page='1';
                }

                $startinglimit = ($page-1)*$limit;
                $sql="SELECT * FROM modelpaperquestion where status=1 having subtopicId='$subId' LIMIT ".$startinglimit.','.$limit;
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
                echo '<button class="pagination"><a class="pagination-text" href="viewAddedQuestions.php?page='.$i.'&courseId='.$courseId.'&subId='.$subId.'">'.$i.'</a></button>';
            }
            ?>
        </div>

<!-- Footer -->
<div class="footer">
            <?php
                require_once('../../assets/includes/footer.php');
            ?>
</div>