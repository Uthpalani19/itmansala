<?php
$db = mysqli_connect('localhost', 'root', '', 'emansala');
$lesson = $_GET['lesson'];



$subtopic_query= "SELECT * FROM course WHERE courseID = $lesson";
$subtopic_result = mysqli_query($db, $subtopic_query);
$subtopic_row = mysqli_fetch_assoc($subtopic_result);



?>