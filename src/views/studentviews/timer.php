<?php
session_start();
require('../../config/dbconnection.php');

$calc = $_SESSION['quiz_time'];
$timer = $calc*60;

$diff = time()-$_SESSION['start_time'];
$diff = $timer - $diff;

$hours=0;
$minute = (int)($diff/60);
$second = $diff%60;


$show = $hours.":".$minute.":".$second;

if($diff==0 || $diff<0){

        $courseId=$_SESSION['courseId'];
        $subtopicId=$_SESSION['subtopicId'];
        $phoneNumber = $_SESSION['studentphone'];
        $attempt = $_SESSION['attempt'];


        $sql_marks = "SELECT sum(score) as marks, count(attempt) as attemptno from student_modelpaperquestion where phoneNumber = '$phoneNumber' and subTopicId = '$subtopicId' and attempt = '$attempt'";
        $result_marks = mysqli_query($connection,$sql_marks);
        $row_marks = mysqli_fetch_assoc($result_marks);
        $marks = $row_marks['marks'];
        $attemptno = $row_marks['attemptno'];

        if($attemptno !=5 ){
            while($attemptno < 5){
            $sql_question = "SELECT q.* FROM modelpaperquestion q LEFT JOIN student_modelpaperquestion smq ON q.questionId = smq.questionId
            AND smq.subTopicId = q.subTopicId AND smq.phoneNumber = '{$_SESSION['studentphone']}' WHERE q.subTopicId = '$subtopicId' AND smq.questionId IS NULL
            ORDER BY RAND() LIMIT 1"; 
            
            $result_question = mysqli_query($connection, $sql_question);
            $row_question = mysqli_fetch_assoc($result_question);
            $questionId = $row_question['questionId'];

            $sqlAnswer = "INSERT into student_modelpaperquestion (phoneNumber, subTopicId, questionId, answer, attempt, score) VALUES ('$phoneNumber','$subtopicId','$questionId','No answer','$attempt','0')";
            $result = mysqli_query($connection,$sqlAnswer);
            $attemptno = $attemptno + 1;
            }

        }

        //Store the attempt
        $sql_quizAttempt = "INSERT into student_modelpaperquiz (phoneNumber, subTopicId, courseId, attempt,marks) VALUES ('$phoneNumber','$subtopicId','$courseId','$attempt','$marks')";
        $result_quizAttempt = mysqli_query($connection,$sql_quizAttempt);


        ?>
        <script>
            window.location.href = "../../views/studentviews/quizReviewSummary.php?courseId=<?php echo $courseId; ?>&subId=<?php echo $subtopicId; ?>";
        </script>
        <?php
        
    
    
}else{
    echo "Time Remaining:  ".$show;
} 
?>