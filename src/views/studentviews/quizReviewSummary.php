<?php
    session_start();
    include('../../assets/includes/navbar-student.php');
    require('../../config/dbconnection.php');

    if (!isset($_SESSION['studentname'])) {
        header('location: ../../student_login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Review</title>
    <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../assets/css/quizReview.css"></link>
    <link rel="stylesheet" href="../../assets/css/teacher-style.css"></link>
    <link rel="stylesheet" href="../../assets/css/global.css"></link>
</head>

    <body>

        <!-- Loading Course ID and Subtopic ID -->
        <?php
            $courseId=$_GET['courseId'];
            $sql = "SELECT * FROM course WHERE courseId='$courseId'";
            $result = mysqli_query($connection,$sql);
            $row = mysqli_fetch_assoc($result);
            $courseName=$row['courseName'];

            $subtopicId=$_GET['subId'];
            $sql = "SELECT * FROM subtopic WHERE subtopicId='$subtopicId'";
            $result = mysqli_query($connection,$sql);
            $row = mysqli_fetch_assoc($result);
            $subtopicName=$row['subTopicName'];

            $phoneNumber = $_SESSION['studentphone'];
        ?>
        <!--Course Details-->
        <div class="course-details-box">
            <p id="title"><?php echo $courseName; ?></p>
        </div>

        <!--Set Subtopic Name-->
        <div class="subtopic-title">
            <p> <?php echo $subtopicName; ?> </p>
        </div>

        <!-- Summary of quizzes attempted -->
        <div class="summary-table">
            <table class="tableStudent">
                <tr>
                    <th>Attempt</th>
                    <th>Score</th>
                    <th>Review</th>
                </tr>
                
                <?php
                    $sql = "SELECT * FROM student_modelpaperquiz WHERE phoneNumber = '$phoneNumber' AND subTopicId = '$subtopicId'";
                    $result = mysqli_query($connection,$sql);

                    while($row = mysqli_fetch_assoc($result))
                    {
                            echo '
                                <tr>
                                    <td>'.$row['attempt'].'</td>
                                    <td>'.$row['marks'].'</td>
                                    <td><button class="review-btn"><a href="quizReview.php?courseId='.$courseId.'&subId='.$subtopicId.'&attempt='.$row['attempt'].'">Review</a></button></td>
                                </tr>
                            ';
                    }

                    // check whether there are enough questions for a second attempt
                    $sql_count = "SELECT COUNT(*) as numberof from modelpaperquestion WHERE subTopicId = '$subtopicId' AND questionId NOT IN (SELECT questionId FROM student_modelpaperquestion WHERE phoneNumber = '$phoneNumber' AND subTopicId = '$subtopicId' AND attempt = 1)";
                    $result_count = mysqli_query($connection,$sql_count);
                    $row_count = mysqli_fetch_assoc($result_count);
                    $numberof = $row_count['numberof'];

                    if(mysqli_num_rows($result) == 1)
                    {
                        if($numberof >= 5)
                        {
                            echo '
                                <tr>
                                    <td>2</td>
                                    <td><button><a href="questionsViewStudent.php?courseId='.$courseId.'&subId='.$subtopicId.'&attempt=2&questionNumber=0">Click here to reattempt</a></button></td>
                                    <td>Not available</td>
                                </tr>
                            ';

                            echo '
                                <tr>
                                    <td>3</td>
                                    <td><button disabled><a>Click here to reattempt</a></button></td>
                                    <td>Not available</td>
                                </tr>
                            ';
                        }
                        else
                        {
                            echo '
                                <tr>
                                    <td>2</td>
                                    <td><button><a href="questionsViewStudent.php?courseId='.$courseId.'&subId='.$subtopicId.'&attempt=2&questionNumber=0">Click here to reattempt</a></button></td>
                                    <td>Not available</td>
                                </tr>
                            ';

                            echo '
                                <tr>
                                    <td>3</td>
                                    <td><button disabled><a>Click here to reattempt</a></button></td>
                                    <td>Not available</td>
                                </tr>
                            ';
                        }
                    }
                    if(mysqli_num_rows($result) == 2)
                    {
                        if($numberof >= 10)
                        {
                        echo '
                            <tr>
                                <td>3</td>
                                <td><button><a href="questionsViewStudent.php?courseId='.$courseId.'&subId='.$subtopicId.'&attempt=3&questionNumber=0">Click here to reattempt</a></button></td>
                                <td>Not available</td>
                            </tr>
                        ';
                        }
                        else
                        {
                            echo '
                                <tr>
                                    <td>3</td>
                                    <td><button disabled><a>Click here to reattempt</a></button></td>
                                    <td>Not available</td>
                                </tr>
                            ';
                        }
                    }
                ?>
            </table>
        </div>

        <?php
            // Encourging student for the improvement
            if(mysqli_num_rows($result) > 0)
            {
                // Marks of the first attempt
                $sql_marks1 = "SELECT marks FROM student_modelpaperquiz WHERE phoneNumber = '$phoneNumber' AND subTopicId = '$subtopicId' ORDER BY attempt ASC LIMIT 1";
                $result_marks1 = mysqli_query($connection,$sql_marks1);
                $row_marks1 = mysqli_fetch_assoc($result_marks1);

                // Marks of the last attempt
                $sql_marks = "SELECT marks FROM student_modelpaperquiz WHERE phoneNumber = '$phoneNumber' AND subTopicId = '$subtopicId' ORDER BY attempt DESC LIMIT 1";
                $result_marks = mysqli_query($connection,$sql_marks);
                $row_marks = mysqli_fetch_assoc($result_marks);
                ?>
                
                <div class="encouragement-msg">
                    <?php
                    if($row_marks['marks'] > $row_marks1['marks'])
                    {
                        $percentage = round((($row_marks['marks']/5) - ($row_marks1['marks']/5))*100);?>
                        <div class="encouragement-msg top-margin">Good job! You have improved by</div>
                        <div id="percentage-increment"><?php echo $percentage?>% <i class="fa-solid fa-up-long"></i></div>
                        <div class="encouragement-msg">Keep it up!</div>
                        <?php
                    }
                    elseif($row_marks['marks'] == $row_marks1['marks'])
                    {
                        ?>
                        <div class="encouragement-msg top-margin">You have maintained your score!</div>
                        <?php
                    }
                    else
                    {
                        $percentage = round((($row_marks1['marks']/5) - ($row_marks['marks']/5))*100);?>
                        <div class="encouragement-msg top-margin">Oops! You have losen your score by</div>
                        <div id="percentage"><?php echo $percentage?>%  <i class="fa-solid fa-down-long"></i></div>
                        <div class="encouragement-msg">You can do better!</div>
                        <?php
                    }
                    ?>
                </div>
        <?php
            }
        ?>
        <div>
            <button class="btnBack" onclick="document.location='purchasedCourseDetails.php?lesson=<?php echo $courseId; ?>'">Back to the lesson</button>
        </div>

        <!-- Footer -->
        <?php
            //require_once('../../assets/includes/footer.php');
        ?>
    </body>
</html>