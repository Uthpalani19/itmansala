<?php
session_start();
require('../dbconnection.php');
$PhoneNumber = $_SESSION["studentphone"];
$time = time();
foreach($_SESSION['cart'] as $cid){
    $element = $cid;
    $query = "INSERT INTO student_course (phoneNumber, courseId, lastaccesstime, status) 
    VALUES('$PhoneNumber', '$element', '$time', '0')";
    mysqli_query($connection, $query);
}
unset($_SESSION['cart']);
header('location: ../../views/studentviews/mycourses.php');

?>
