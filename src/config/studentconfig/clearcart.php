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
}
unset($_SESSION['cart']);
header('location: ../../views/studentviews/mycourses.php');

?>
