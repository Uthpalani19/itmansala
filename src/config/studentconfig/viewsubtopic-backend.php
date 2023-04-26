<?php
    require('C:\xampp\htdocs\itmansala\src\config\dbconnection.php');
    $lesson = $_GET['lesson'];

    $subtopic_query= "SELECT * FROM course WHERE courseID = $lesson";
    $subtopic_result = mysqli_query($connection, $subtopic_query);
    $subtopic_row = mysqli_fetch_assoc($subtopic_result);
?>