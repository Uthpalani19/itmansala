<?php
//db connection

$db = mysqli_connect('localhost', 'root', '', 'itmansala');


//variables
$subtopicName="";
$subtopicNumber="";
$numberoflessons="";
$learningMaterial1="";
$learningMaterial2="";
$id="";
$lessonName="";
$activeMessage="";
$lessonNumber="";
$Number_Error= array();
$Name_Error= array();
$Active_Error= array();


//retrieve course information to subtopic

$lesson = $_GET['lesson'];

$subtopic_query= "SELECT * FROM course WHERE courseID = $lesson";
$subtopic_result = mysqli_query($db, $subtopic_query);
$subtopic_row = mysqli_fetch_assoc($subtopic_result);


//auto generate subtopic number

$query = "SELECT subTopicId FROM subtopic WHERE subTopicId LIKE CONCAT ($lesson,'%') ORDER BY subTopicId DESC LIMIT 1";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);
$lastid = $row['subTopicId'];
    $id = $lastid + 0.1;

}else{
    $id= $lesson + 0.1;
}


//add subtopic to database
if (isset($_POST['add_subtopic'])) {
    $subtopicName = mysqli_real_escape_string($db, $_POST['subtopicName']);
    $subtopicNumber = mysqli_real_escape_string($db, $_POST['subtopicNumber']);
    $learningMaterial1 = mysqli_real_escape_string($db, $_FILES['learningMaterial1']['name']);
    $learningMaterial2 = mysqli_real_escape_string($db, $_FILES['learningMaterial2']['name']);
  

    if (empty($subtopicName)) {
        array_push($Name_Error, "Subtopic title is required!");
    }

    $master_error = array_merge($Name_Error);
    if (count($master_error) == 0) {
    $query = "INSERT INTO subtopic (subTopicId, courseId, subTopicName, content) 
                  VALUES('$subtopicNumber', '$lesson', '$subtopicName', '$learningMaterial1')";
    mysqli_query($db, $query);
    move_uploaded_file($_FILES['learningMaterial1']['tmp_name'], "../../assets/uploads/$learningMaterial1");

    }else{
        echo   '<div class="error-msg-container" id="errorPopup">
                <div class="error-msg" >
                    <i class="fa-regular fa-rectangle-xmark" id="close"></i>
                    <p>Error: Failed to create course <br>Please fill all the details correctly!</p>
                </div>
                </div>
                <script>
                    const errorPopup = document.getElementById("errorPopup");
                    const close = document.getElementById("close");

                    close.onclick = function(){
	                errorPopup.style.display = "none";
                    }
                </script>';
    }

}

//add lesson to database
if (isset($_POST['add_lesson'])) {
    $lessonName = mysqli_real_escape_string($db, $_POST['lessonName']);
    $activeMessage = mysqli_real_escape_string($db, $_POST['activeMessage']);
    $lessonNumber = mysqli_real_escape_string($db, $_POST['lessonNumber']);
    $learningMaterial1 = mysqli_real_escape_string($db, $_FILES['learningMaterial1']['name']);
    $learningMaterial2 = mysqli_real_escape_string($db, $_FILES['learningMaterial2']['name']);
  

    if (empty($lessonName)) {
        array_push($Name_Error, "Subtopic title is required!");
    }
    if (empty($activeMessage)) {
        array_push($Active_Error, "Active Message is required!");
    }

    $master_error = array_merge($Name_Error, $Active_Error);
    if (count($master_error) == 0) {
    $query = "INSERT INTO lesson (subTopicId, lessonName, activeMessage, content) 
                  VALUES('$lessonNumber', '$lessonName', '$activeMessage', '$learningMaterial1')";
    mysqli_query($db, $query);
    move_uploaded_file($_FILES['learningMaterial1']['tmp_name'], "../../assets/uploads/$learningMaterial1");

    }else{
        echo   '<div class="error-msg-container" id="errorPopup">
                <div class="error-msg" >
                    <i class="fa-regular fa-rectangle-xmark" id="close"></i>
                    <p>Error: Failed to create course <br>Please fill all the details correctly!</p>
                </div>
                </div>
                <script>
                    const errorPopup = document.getElementById("errorPopup");
                    const close = document.getElementById("close");

                    close.onclick = function(){
	                errorPopup.style.display = "none";
                    }
                </script>';
    }

}
?>