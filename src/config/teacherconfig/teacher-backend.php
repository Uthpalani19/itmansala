<?php
include ('../../config/dbconnection.php');

$courseName="";
$courseNumber="";
$courseDescription="";
$coverPhoto1="";
$coverPhoto2="";
$courseImage="";
$id="";
$Title_Error= array();
$Desc_Error= array();

//auto generate course number

$query = "SELECT courseId FROM course ORDER BY courseId DESC LIMIT 1";
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);
$lastid = $row['courseId'];
    $id = $lastid + 1;
}else{
    $id= 1;
}

//add course to database
if (isset($_POST['add_course'])) {
    $courseNumber = mysqli_real_escape_string($connection, $_POST['courseNumber']);
    $courseName = mysqli_real_escape_string($connection, $_POST['courseName']);
    $courseDescription = mysqli_real_escape_string($connection, $_POST['courseDescription']);
    $Price = mysqli_real_escape_string($connection, $_POST['price']);
    $coverPhoto1 = mysqli_real_escape_string($connection, $_FILES['coverPhoto1']['name']);
    $coverPhoto2 = mysqli_real_escape_string($connection, $_FILES['coverPhoto2']['name']);
  
    if(empty($coverPhoto1)){
        $courseImage = $coverPhoto2;
    }

    if(empty($coverPhoto2)){
        $courseImage = $coverPhoto1;
    }

    if (empty($courseName)) {
        array_push($Title_Error, "Course title is required!");
    }
    if (empty($courseDescription)) {
        array_push($Desc_Error, "Description is required!");
    }

    $master_error = array_merge($Title_Error, $Desc_Error);
    if (count($master_error) == 0) {
    $query = "INSERT INTO course (courseId, courseName, courseDescription, courseImage, price, teacherPhoneNumber, status) 
    VALUES('$courseNumber', '$courseName', '$courseDescription', '$courseImage', '$Price', '714900086', '1')";
    mysqli_query($connection, $query);
    move_uploaded_file($_FILES['courseImage']['tmp_name'], "../../uploads/$courseImage");
    header('location: addcourse.php');

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

