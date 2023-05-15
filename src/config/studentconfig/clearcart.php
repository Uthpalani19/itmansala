<?php
session_start();
require('../dbconnection.php');
$PhoneNumber = $_SESSION["studentphone"];
$time = time();
foreach($_SESSION['cart'] as $cid){
    $element = $cid;
    $query = "INSERT INTO student_course (phoneNumber, courseId, status) 
    VALUES('$PhoneNumber', '$element', '1')";
    mysqli_query($connection, $query);

    $subtopic_query = "SELECT * FROM subtopic WHERE courseId =$element";
    $subtopic_result = mysqli_query($connection, $subtopic_query);
    $check_subtopic = mysqli_num_rows($subtopic_result) > 0;

    if ($check_subtopic) {
        while ($subtopic_row = mysqli_fetch_array($subtopic_result)) {
            $subtopicId = $subtopic_row["subTopicId"];
            $insert = "INSERT INTO student_subtopic (phoneNumber, courseId, subtopicId, status)
            VALUES('$PhoneNumber', '$element', '$subtopicId', 0)";
            mysqli_query($connection, $insert);
        }
    }
}
unset($_SESSION['cart']);
header('location: ../../views/studentviews/mycourses.php');

?>
