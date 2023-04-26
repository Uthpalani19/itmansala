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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../assets/css/subtopic.css">
    <link rel="stylesheet" href="../../assets/css/teacher-style.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/global.css">
    
</head>
<body id="grey-bg">

    <div class="lesson-info">
        <div class="lesson-num">
            <p class="lesson-name"><?php echo $subtopic_row['courseName'];?></p>
        </div>
        <p class="lesson-desc"><?php echo $subtopic_row['courseDescription'];?></p>
    </div>

    <div class="content">

        <?php
            $retrieve_subtopic= "SELECT * FROM subtopic WHERE courseID = $lesson";
            $retrieve_subtopic_result = mysqli_query($connection, $retrieve_subtopic);
            $check_retrieve_subtopic = mysqli_num_rows($retrieve_subtopic_result) > 0;

            if($check_retrieve_subtopic){
                while($retrieve_subtopic_row = mysqli_fetch_array($retrieve_subtopic_result)){
                    $subtopic = $retrieve_subtopic_row['subTopicId'];
                    $subid = bin2hex(random_bytes(4));
                    $addlessonid = bin2hex(random_bytes(4));
                    $dblessonid = bin2hex(random_bytes(4));
                    $formid = bin2hex(random_bytes(4));
                    $hideid = bin2hex(random_bytes(4)); 
                    $discardid = bin2hex(random_bytes(4)); 
                    $selectfile = bin2hex(random_bytes(4));
                    $selectlabel = bin2hex(random_bytes(4));
                    $selctlabelclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $selectfileclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $discardIDonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $hideIDonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $class = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $formIDonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $dblessonIDonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $subidonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $addlessonIDonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
        ?>
        <style>
            <?php echo '.'.$class ?>{
                display: none;
                }
        </style>
            
        <div class="db-subtopic">
            <div class="db-subtopic-left">
                <i class="fa-regular fa-circle"></i>
                <p id="<?php echo $subid; ?>"><?php echo $retrieve_subtopic_row['subTopicName']; ?></p>
            </div>
            <div class="db-subtopic-right">
                <p><i class="fa-solid fa-file-pen subtopic-edit"></i></p>                
                <p id="<?php echo $hideid ?>"><i class="fa-solid fa-chevron-down" ></i></p>
            </div>
        </div>
                        
        <?php
            if(empty($subtopic)){

            }else{
                $retrieve_lesson= "SELECT * FROM lesson WHERE subTopicId = $subtopic";
                $retrieve_lesson_result = mysqli_query($connection, $retrieve_lesson);
                if(mysqli_num_rows($retrieve_lesson_result)){
                while($retrieve_lesson_row = mysqli_fetch_array($retrieve_lesson_result)){
                    $show = bin2hex(random_bytes(4));
                    $close = bin2hex(random_bytes(4));
                    $pdfid = bin2hex(random_bytes(4));
                    $closeonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $showonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $pdfIDonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $bodyonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));                                     
        ?>
        <div class="dblesson <?php echo $class ?>">
            <p><?php echo $retrieve_lesson_row['lessonName'];?></p>
            <a class="show-pdf" id="<?php echo $show; ?>">Resource</a>
        </div>
        <div class="pdfdiv" id="<?php echo $pdfid; ?>" style="display:none;">
            <i class="fa-regular fa-rectangle-xmark" id="<?php echo $close ?>"></i>
            <embed src="../../assets/uploads/<?php echo $retrieve_lesson_row['content'];?>" height="630" width="1000"/>
        </div>
        
        <script>
            const <?php echo $showonclick; ?> = document.getElementById("<?php echo $show; ?>");
            const <?php echo $pdfIDonclick; ?> = document.getElementById("<?php echo $pdfid; ?>");
            const <?php echo $closeonclick; ?> = document.getElementById("<?php echo $close; ?>");
            const <?php echo $bodyonclick; ?> = document.getElementById("grey-bg");
                
            </form>
            <?php echo $showonclick; ?>.onclick = function(){
                <?php echo $pdfIDonclick; ?>.style.display = "block";
                <?php echo $bodyonclick; ?>.classList.add("fixed");
            }

            <?php echo $closeonclick; ?>.onclick = function(){
                <?php echo $pdfIDonclick; ?>.style.display = "none";
                <?php echo $bodyonclick; ?>.classList.remove("fixed");
            }

        </script>

        <?php
                }
            }
        ?>
        <div class="add-lesson" id="<?php echo $addlessonid; ?>" style="display:none;">
            <i class="fa-solid fa-circle-plus"></i>
            <p>Click here to add a lesson</p>

            <!--Add & view Questions button-->
            <div class="add-view-questions">
                <a href="addQuestions.php?subId=<?php echo $subtopic; ?>&courseId=<?php echo $subtopic_row['courseId']?>"><input type="button" value="Add Questions" class="btn-questions add-questions" name="addQuestions"></a>
                <a href="viewAddedQuestions.php?subId=<?php echo $subtopic; ?>&courseId=<?php echo $subtopic_row['courseId']?>"><input type="button" value="View Questions" class="btn-questions add-questions" name="viewQuestions"></a>
            </div>
        </div>

        <?php
            }
        ?>

        <div class="form-container lesson-form" id="<?php echo $formid; ?>" style="display:none; margin-bottom:50px;">
            <div class="course-form">
                <p class="form-title">Lesson Details</p>
                <form method="post" action="subtopic.php?lesson=<?php echo $subtopic_row['courseId'];?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="column1">
                            <p>Lesson Title</p>
                        </div>  
                        <div class="column2">
                            <input type="text" class="course-input title" name="lessonName">
                            <input type="text" class="course-input title" name="lessonNumber" value="<?php echo $subtopic; ?>" readonly hidden>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column1">
                            <p>Add learning material</p>
                        </div>  
                        <div class="column2 upload">
                            <label>
                                <input type="file" name="learningMaterial1" id="<?php echo $selectfile; ?>">
                                <i class="fa-solid fa-file-import"></i> <br>
                                <label id="<?php echo $selectlabel; ?>" for="<?php echo $selectfile; ?>">Select file</label>
                            </label>
                        </div>
                    </div>
                    <p class="upload-option">OR</p>
                        <div class="drop-zone">
		                    <span class="drop-zone-text">You can Drag & Drop files here to add them</span>
		                    <input type="file" name="learningMaterial2" class="drop-zone-input">
	                    </div>
                        <button type="submit" name="add_lesson" class="form-btn">Create Lesson</button>
                        <button type="reset" class="form-btn" id="<?php echo $discardid ?>">Discard</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            const <?php echo $subidonclick; ?> = document.getElementById("<?php echo $subid; ?>");
            const <?php echo $addlessonIDonclick; ?> = document.getElementById("<?php echo $addlessonid; ?>");
            const <?php echo $dblessonIDonclick; ?> = document.getElementsByClassName("<?php echo $class; ?>");
            const <?php echo $formIDonclick; ?> = document.getElementById("<?php echo $formid; ?>");
            const <?php echo $hideIDonclick; ?> = document.getElementById("<?php echo $hideid; ?>");
            const <?php echo $discardIDonclick; ?> = document.getElementById("<?php echo $discardid; ?>");
            const <?php echo $selectfileclick; ?> = document.getElementById("<?php echo $selectfile; ?>");
            const <?php echo $selctlabelclick; ?> = document.getElementById("<?php echo $selectlabel; ?>");
                                
            <?php echo $subidonclick; ?>.onclick = function(){
                var i;
                for (i=0; i< <?php echo $dblessonIDonclick; ?>.length; i++){
                    <?php echo $dblessonIDonclick; ?>[i].style.display = "block";
                    }
                <?php echo $addlessonIDonclick; ?>.style.display = "block";
                }

            <?php echo $addlessonIDonclick; ?>.onclick = function(){
                <?php echo $formIDonclick; ?>.style.display = "block";
                }

            <?php echo $hideIDonclick; ?>.onclick =function(){
                var x;
                for (x=0; x< <?php echo $dblessonIDonclick; ?>.length; x++){
                    <?php echo $dblessonIDonclick; ?>[x].style.display = "none";
                    }
                <?php echo $addlessonIDonclick; ?>.style.display = "none";
                <?php echo $formIDonclick; ?>.style.display = "none";
                }

            <?php echo $discardIDonclick; ?>.onclick = function(){
                <?php echo $formIDonclick; ?>.style.display = "none";
                }

            <?php echo $selectfileclick; ?>.addEventListener('change', function(event){
	            const name = event.target.files[0].name;
	            <?php echo $selctlabelclick; ?>.textContent = name;
                })

        </script>
        <?php
            }
        }
        ?>
           

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
                        <div class="column1">
                            <p>Add learning material (optional)</p>
                            <input type="text" class="course-input" name="subtopicNumber" value="<?php echo $id ?>" readonly hidden>
                        </div>  
                        <div class="column2 upload">
                            <label>
                                <input type="file" name="learningMaterial1" id="selectfile2">
                                <i class="fa-solid fa-file-import"></i> <br>
                                <label id="selectlabel2" for="selectfile2">Select file</label>
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

<script type="text/javascript" src="../../assets/js/subtopic.js"></script>
</body>
</html>