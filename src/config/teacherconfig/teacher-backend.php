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
    $coverPhoto1 = $_FILES['coverPhoto1'];
    $coverPhoto2 = $_FILES['coverPhoto2'];
    $teacherNumber = $_SESSION['phone'];

    //select file
    $courseImage = $coverPhoto1;
    $courseImage_name = $courseImage['name'];
    $courseImage_error = $courseImage['error'];
    $courseImage_tempname = $courseImage['tmp_name'];
    $courseImage_separate =explode('.',$courseImage_name);
    $file_extention = strtolower(end($courseImage_separate));
    $extention = array('jpeg','jpg','png');
    if(in_array($file_extention,$extention))
    {
            $upload_image ='../../assets/uploads/coursedp'.$courseImage_name;
            move_uploaded_file($courseImage_tempname,$upload_image);
    }

    //drag and drop
    $courseImage2 = $coverPhoto2;
    $courseImage_name = $courseImage2['name'];
    $courseImage_error = $courseImage2['error'];
    $courseImage_tempname = $courseImage2['tmp_name'];
    $courseImage_separate =explode('.',$courseImage_name);
    $file_extention = strtolower(end($courseImage_separate));
    $extention = array('jpeg','jpg','png');
    if(in_array($file_extention,$extention))
    {
            $upload_image2 ='../../assets/uploads/coursedp'.$courseImage_name;
            move_uploaded_file($courseImage_tempname,$upload_image2);
    }

    if(!empty($upload_image)){
        $coursedp = $upload_image;
    }

    if(!empty($upload_image2)){
        $coursedp = $upload_image2;
    }

    if (empty($courseName)) {
        array_push($Title_Error, "Course title is required!");
    }
    if (empty($courseDescription)) {
        array_push($Desc_Error, "Description is required!");
    }

    $master_error = array_merge($Title_Error, $Desc_Error);
    if (count($master_error) == 0) {
    $query = "INSERT INTO course (courseId, courseName, courseDescription, courseImage, price, teacherPhoneNumber, status, review) 
    VALUES('$courseNumber', '$courseName', '$courseDescription', '$coursedp', '$Price', '$teacherNumber', '0', '0')";
    mysqli_query($connection, $query);
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
                    if (errorPopup != ""){
                    document.body.classList.add("stopscroll");
                    }
                    close.onclick = function(){
	                errorPopup.style.display = "none";
                    document.body.classList.remove("stopscroll");
                    }
                </script>';
    }

}


//retrieve course name from database

$courseQuery = "SELECT * FROM course_name WHERE course_name NOT IN (SELECT courseName FROM course)";
$courseResult = mysqli_query($connection, $courseQuery);
if(mysqli_num_rows($courseResult) > 0) {

}


//publish course
if (isset($_POST['publish_course'])){
    $publishId = mysqli_real_escape_string($connection, $_POST['publish_id']);
    $query = "UPDATE course
                        SET review = '1'
                        WHERE courseID = '$publishId'";
    mysqli_query($connection, $query);
    header('location: addcourse.php');
}
?>

