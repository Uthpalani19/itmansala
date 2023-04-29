<?php
//db connection

require('../../config/dbconnection.php');


//variables
$subtopicName="";
$subtopicNumber="";
$numberoflessons="";
$learningMaterial1="";
$learningMaterial2="";
$id="";
$lessonName="";
$lessonNumber="";
$videoContent="";
$Number_Error= array();
$subName_Error= array();
$Name_Error= array();
$Pdf_Error= array();


//retrieve course information to subtopic

$lesson = $_GET['lesson'];

$subtopic_query= "SELECT * FROM course WHERE courseID = $lesson";
$subtopic_result = mysqli_query($connection, $subtopic_query);
$subtopic_row = mysqli_fetch_assoc($subtopic_result);


//auto generate subtopic number

$query = "SELECT subTopicId FROM subtopic WHERE subTopicId LIKE CONCAT ($lesson,'%') ORDER BY subTopicId DESC LIMIT 1";
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);
$lastid = $row['subTopicId'];
    $id = $lastid + 0.1;

}else{
    $id= $lesson + 0.1;
}


//add subtopic to database
if (isset($_POST['add_subtopic'])) {
    $subtopicName = mysqli_real_escape_string($connection, $_POST['subtopicName']);
    $subtopicNumber = mysqli_real_escape_string($connection, $_POST['subtopicNumber']);
    $learningMaterial1 = $_FILES['learningMaterial1'];
    $learningMaterial2 = $_FILES['learningMaterial2'];

    //select file
    $pdf1 = $learningMaterial1;
    $pdf_name = $pdf1['name'];
    $pdf_error = $pdf1['error'];
    $pdf_tempname = $pdf1['tmp_name'];
    $pdf_separate =explode('.',$pdf_name);
    $file_extention = strtolower(end($pdf_separate));
    $extention = array('pdf');
    if(in_array($file_extention,$extention))
    {
            $upload_pdf1 ='../../assets/uploads/subtopicpdf'.$pdf_name;
            move_uploaded_file($pdf_tempname,$upload_pdf1);
    }

    //drag and drop
    $pdf2 = $learningMaterial2;
    $pdf_name = $pdf2['name'];
    $pdf_error = $pdf2['error'];
    $pdf_tempname = $pdf2['tmp_name'];
    $pdf_separate =explode('.',$pdf_name);
    $file_extention = strtolower(end($pdf_separate));
    $extention = array('pdf');
    if(in_array($file_extention,$extention))
    {
            $upload_pdf2 ='../../assets/uploads/subtopicpdf'.$pdf_name;
            move_uploaded_file($pdf_tempname,$upload_pdf2);
    }
    $subtopicPdf = "No content available";

    if(!empty($upload_pdf1)){
        $subtopicPdf = $upload_pdf1;
    }

    if(!empty($upload_pdf2)){
        $subtopicPdf = $upload_pdf2;
    }
  
    if (empty($subtopicName)) {
        array_push($subName_Error, "Subtopic title is required!");
    }

    $master_error = array_merge($subName_Error);
    if (count($master_error) == 0) {
    $query = "INSERT INTO subtopic (subTopicId, courseId, subTopicName, content) 
                  VALUES('$subtopicNumber', '$lesson', '$subtopicName', '$subtopicPdf')";
    mysqli_query($connection, $query);

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

//add lesson to database
if (isset($_POST['add_lesson'])) {
    $lessonName = mysqli_real_escape_string($connection, $_POST['lessonName']);
    $lessonNumber = mysqli_real_escape_string($connection, $_POST['lessonNumber']);
    $videoContent = mysqli_real_escape_string($connection, $_POST['videoContent']);
    $learningMaterial1 = $_FILES['learningMaterial1'];
    $learningMaterial2 = $_FILES['learningMaterial2'];

    //select file
    $pdf1 = $learningMaterial1;
    $pdf_name = $pdf1['name'];
    $pdf_error = $pdf1['error'];
    $pdf_tempname = $pdf1['tmp_name'];
    $pdf_separate =explode('.',$pdf_name);
    $file_extention = strtolower(end($pdf_separate));
    $extention = array('pdf');
    if(in_array($file_extention,$extention))
    {
            $upload_pdf1 ='../../assets/uploads/lessonpdf'.$pdf_name;
            move_uploaded_file($pdf_tempname,$upload_pdf1);
    }

    //drag and drop
    $pdf2 = $learningMaterial2;
    $pdf_name = $pdf2['name'];
    $pdf_error = $pdf2['error'];
    $pdf_tempname = $pdf2['tmp_name'];
    $pdf_separate =explode('.',$pdf_name);
    $file_extention = strtolower(end($pdf_separate));
    $extention = array('pdf');
    if(in_array($file_extention,$extention))
    {
            $upload_pdf2 ='../../assets/uploads/lessonpdf'.$pdf_name;
            move_uploaded_file($pdf_tempname,$upload_pdf2);
    }

    if(!empty($upload_pdf1)){
        $lessonPdf = $upload_pdf1;
    }

    if(!empty($upload_pdf2)){
        $lessonPdf = $upload_pdf2;
    }

    if(empty($lessonPdf)){
        array_push($Pdf_Error, "Content is required!");
    }
  
    if (empty($lessonName)) {
        array_push($Name_Error, "Lesson title is required!");
    }

    $master_error = array_merge($Name_Error, $Pdf_Error);
    if (count($master_error) == 0) {
    $query = "INSERT INTO lesson (subTopicId, lessonName, content, videoContent) 
                  VALUES('$lessonNumber', '$lessonName', '$lessonPdf', '$videoContent')";
    mysqli_query($connection, $query);

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


// edit lesson content

if (isset($_POST['edit_lesson'])) {
    $lessonName = mysqli_real_escape_string($connection, $_POST['editlessonName']);
    $lessonNumber = mysqli_real_escape_string($connection, $_POST['editlessonNumber']);
    $videoContent = mysqli_real_escape_string($connection, $_POST['editvideoContent']);
    $editlearningMaterial1 = $_FILES['editlearningMaterial1'];
    $editlearningMaterial2 = $_FILES['editlearningMaterial2'];
    $lessonpk = mysqli_real_escape_string($connection, $_POST['lessonpk']);
    $editcontent = mysqli_real_escape_string($connection, $_POST['editcontent']);

    //select file
    $pdf1 = $editlearningMaterial1;
    $pdf_name = $pdf1['name'];
    $pdf_error = $pdf1['error'];
    $pdf_tempname = $pdf1['tmp_name'];
    $pdf_separate =explode('.',$pdf_name);
    $file_extention = strtolower(end($pdf_separate));
    $extention = array('pdf');
    if(in_array($file_extention,$extention))
    {
            $upload_pdf1 ='../../assets/uploads/lessonpdf'.$pdf_name;
            move_uploaded_file($pdf_tempname,$upload_pdf1);
    }

    //drag and drop
    $pdf2 = $editlearningMaterial2;
    $pdf_name = $pdf2['name'];
    $pdf_error = $pdf2['error'];
    $pdf_tempname = $pdf2['tmp_name'];
    $pdf_separate =explode('.',$pdf_name);
    $file_extention = strtolower(end($pdf_separate));
    $extention = array('pdf');
    if(in_array($file_extention,$extention))
    {
            $upload_pdf2 ='../../assets/uploads/lessonpdf'.$pdf_name;
            move_uploaded_file($pdf_tempname,$upload_pdf2);
    }

    if(!empty($upload_pdf1)){
        $editcontent = $upload_pdf1;
    }

    if(!empty($upload_pdf2)){
        $editcontent = $upload_pdf2;
    }

    $query = "UPDATE lesson 
                    SET subTopicId = '$lessonNumber', lessonName = '$lessonName' , content = '$editcontent', videoContent = '$videoContent'
                    WHERE lessonName ='$lessonpk' AND subTopicId ='$lessonNumber'";
    mysqli_query($connection, $query);




}












?>


