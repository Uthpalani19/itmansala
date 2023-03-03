<?php 
  session_start(); 

    if (!isset($_SESSION['name'])) {
  	    header('location: ../student_login.php');
    }
    if(isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['name']);
        header("location: ../student_login.php");
    }

    include('../../config/teacherconfig/subtopic-backend.php');
    include('../../assets/includes/navbar-teacher.php');
    include('../../config/dbconnection.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>IT Mansala</title>
  <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../../assets/css/subtopic.css">
  <link rel="stylesheet" href="../../assets/css/teacher-style.css"></link>
  <link rel="stylesheet" type="text/css" href="../../assets/css/global.css">
    <script>
        function addQuestions()
            {
                window.location.href="addQuestions.php";
            }
            function viewQuestions()
            {
                window.location.href="viewAddedQuestions.php";
            }
    </script>
</head>
<body class="grey-bg">

<div class="lesson-info">
    <div class="lesson-num">
        <p class="lesson-number">Course 0<?php echo $subtopic_row['courseId'];?>:</p>
        <p class="lesson-name"><?php echo $subtopic_row['courseName'];?></p>
    </div>
    <p class="lesson-desc"><?php echo $subtopic_row['courseDescription'];?></p>
</div>

<div class="content">

            <form action="viewAddedQuestions.php" method="POST">
<?php
                    $retrieve_subtopic= "SELECT * FROM subtopic WHERE courseID = $lesson";
                    $retrieve_subtopic_result = mysqli_query($connection, $retrieve_subtopic);
                    $check_retrieve_subtopic = mysqli_num_rows($retrieve_subtopic_result) > 0;

                    if($check_retrieve_subtopic){
                        while($retrieve_subtopic_row = mysqli_fetch_array($retrieve_subtopic_result)){
                            $subtopic = $retrieve_subtopic_row['subTopicId'];
                            ?>
                        <div class="db-subtopic">
                            <div class="db-subtopic-left">
                                <i class="fa-regular fa-circle"></i>
                                <p><?php echo $retrieve_subtopic_row['subTopicId'];?></p>
                                <p id="dbsubtopic"><?php echo $retrieve_subtopic_row['subTopicName']; ?></p>
                            </div>
                            <div class="db-subtopic-right">
                                <p><i class="fa-solid fa-file-pen subtopic-edit"></i></p>
                                
                                <p id="hidediv"><i class="fa-solid fa-chevron-down" ></i></p>
                            </div>

                        </div>

                        <?php
                        }
                    }
                    ?>
                    <?php
                        if(empty($subtopic)){
                            
                        }
                        else{
                                $retrieve_lesson= "SELECT * FROM lesson WHERE subTopicId = $subtopic";
                                $retrieve_lesson_result = mysqli_query($connection, $retrieve_lesson);
                                //$check_retrieve_lesson = mysqli_num_rows($retrieve_lesson_result);

                                if(mysqli_num_rows($retrieve_lesson_result)){
                                            while($retrieve_lesson_row = mysqli_fetch_array($retrieve_lesson_result)){

                    ?>
                    <div class="dblesson">
                        
                        <p><?php echo $retrieve_lesson_row['lessonName'];?></p>
                        
                    </div>

                    <?php
                             }
                             
                        }
                    }
                    ?>
                        
                        <div class="add-lesson" id="addlesson">
                            <i class="fa-solid fa-circle-plus"></i>
                            <p>Click here to add a lesson</p>

                            <!--Add & view Questions button-->
                            <form action = "addQuestions.php" method = "POST">
                                <input type="submit" value="Add Questions" class="btn-questions add-questions" name="addQuestions">
                            </form>
                            <form action = "ViewAddedQuestions.php" method = "POST">
                                <input type="submit" value="View Questions" class="btn-questions view-questions" name="viewQuestions">
                            </form>
                        </div>
            </form>


                    <div class="form-container lesson-form" id="formId1">
            <div class="course-form">
                <p class="form-title">Lesson Details</p>
                <form method="post" action="subtopic.php?lesson=<?php echo $subtopic_row['courseId'];?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="column1">
                            <p>Lesson Title</p>
                        </div>  
                        <div class="column2">
                            <input type="text" class="course-input title" name="lessonName">
                        </div>
                    </div>

                    <div class="row">
                        <div class="column1">
                            <p>Subtopic Number</p>
                        </div>  
                        <div class="column2">
                            <input type="text" class="course-input title" name="lessonNumber" value="<?php echo $subtopic ?>" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column1">
                            <p>Add learning material</p>
                        </div>  
                        <div class="column2 upload">
                            <label>
                                <input type="file" name="learningMaterial1">
                                <i class="fa-solid fa-file-import"></i> 
                                <br>Select file
                            </label>
                            </div>
                        </div>
                        <p class="upload-option">OR</p>
                        <div class="drop-zone">
		                        <span class="drop-zone-text">You can Drag & Drop files here to add them</span>
		                        <input type="file" name="learningMaterial2" class="drop-zone-input">
	                    </div>
                        <button type="submit" name="add_lesson" class="form-btn">Create Lesson</button>
                        <button type="reset" class="form-btn" id="discardlesson">Discard</button>

                    </div>
                </form>
            </div>
        </div>

<div class="add-subtopic" id="addSubtopic">
    <i class="fa-solid fa-circle-plus"></i>
    <p>Click here to add Subtopic</p>
    
</div>
<div class="form-container" id="formId2">
            <div class="course-form">
                <p class="form-title">Subtopic Details</p>
                <form method="post" action="subtopic.php?lesson=<?php echo $subtopic_row['courseId'];?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="column1">
                            <p>Subtopic Title</p>
                        </div>  
                        <div class="column2">
                            <input type="text" class="course-input title" name="subtopicName">
                        </div>
                    </div>
                    <div class="row">
                        <div class="column1-number">
                            <p>Subtopic number</p>
                        </div>  
                        <div class="column2-number">
                            <input type="text" class="course-input" name="subtopicNumber" value="<?php echo $id ?>" readonly>
                        </div>

                    </div>
                    <div class="row">
                        <div class="column1">
                            <p>Add learning material (optional)</p>
                        </div>  
                        <div class="column2 upload">
                            <label>
                                <input type="file" name="learningMaterial1">
                                <i class="fa-solid fa-file-import"></i> 
                                <br>Select file
                            </label>
                            </div>
                        </div>
                        <p class="upload-option">OR</p>
                        <div class="drop-zone">
		                        <span class="drop-zone-text">You can Drag & Drop files here to add them</span>
		                        <input type="file" name="learningMaterial2" class="drop-zone-input">
	                    </div>
                        <button type="submit" name="add_subtopic" class="form-btn">Create Subtopic</button>
                        <button type="reset" class="form-btn" id="discard">Discard</button>
                    </div>
                </form>
            </div>
        </div>
</div>

<script type="text/javascript" src="../../assets/js/subtopic.js">
</script>
</body>
</html>