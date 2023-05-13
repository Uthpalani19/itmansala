<?php
include('../../config/dbconnection.php');
$courseName = "";
$coursePrice = "";
$protip = "";
$expertise = "";
$price_query = "SELECT price FROM course_name"; 
$price_result = mysqli_query($connection, $price_query);
$price_row = mysqli_fetch_array($price_result);
$price = $price_row["price"];
if (isset($_POST['addcourse'])){
    $courseName = mysqli_real_escape_string($connection, $_POST['course_name']);
    if($courseName != ""){
        $query = "INSERT INTO course_name (course_name, price) 
        VALUES('$courseName', '$price')";
        mysqli_query($connection, $query);
        header('location: controls.php');
    }
}

if (isset($_POST['setprice'])){
    $coursePrice = mysqli_real_escape_string($connection, $_POST['course_price']);
    if($coursePrice != ""){
        $query = "UPDATE course_name 
                         SET price = '$coursePrice'"; 
        
        $subtopic_query = "UPDATE course
                                    SET price = '$coursePrice'";
        mysqli_query($connection, $subtopic_query);
        mysqli_query($connection, $query);
        header('location: controls.php');
    }
}

if (isset($_POST['setprotip'])){
    $protip = mysqli_real_escape_string($connection, $_POST['tip']);
    if($protip != ""){
        $query = "INSERT INTO tips (tip) 
        VALUES('$protip')";
        mysqli_query($connection, $query);
        header('location: controls.php');
    }
}

if (isset($_POST['teacherexpertise'])){
    $expertise = mysqli_real_escape_string($connection, $_POST['expertise']);
    if($expertise != ""){
        $query = "INSERT INTO teacher_expertise (expertise) 
        VALUES('$expertise')";
        mysqli_query($connection, $query);
        header('location: controls.php');
    }
}
?>