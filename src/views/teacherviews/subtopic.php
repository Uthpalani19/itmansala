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
                    $time = $retrieve_subtopic_row['time'];
                    $subid = bin2hex(random_bytes(4));
                    $addlessonid = bin2hex(random_bytes(4));
                    $clicktoadd = bin2hex(random_bytes(4));
                    $dblessonid = bin2hex(random_bytes(4));
                    $formid = bin2hex(random_bytes(4));
                    $hideid = bin2hex(random_bytes(4)); 
                    $discardid = bin2hex(random_bytes(4)); 
                    $selectfile = bin2hex(random_bytes(4));
                    $selectlabel = bin2hex(random_bytes(4));
                    $quizdiv = bin2hex(random_bytes(4));
                    $quizdivbtn = bin2hex(random_bytes(4));
                    $quizdivclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $quizdivbtnclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $clicktoaddjs = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
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
                <p><i class="fa-solid fa-file-pen subtopic-edit" id=></i></p>                
                <p id="<?php echo $hideid ?>"><i class="fa-solid fa-chevron-down" ></i></p>
            </div>
        </div>
                        
        <?php
            if(empty($subtopic)){

            }else{
                $retrieve_lesson= "SELECT * FROM lesson WHERE subTopicId = $subtopic";
                $retrieve_lesson_result = mysqli_query($connection, $retrieve_lesson);
                if(mysqli_num_rows($retrieve_lesson_result)){
                    // JS for subtopic hide and show
                while($retrieve_lesson_row = mysqli_fetch_array($retrieve_lesson_result)){
                    $show = bin2hex(random_bytes(4));
                    $showvideo = bin2hex(random_bytes(4));
                    $videoclose = bin2hex(random_bytes(4));
                    $close = bin2hex(random_bytes(4));
                    $pdfid = bin2hex(random_bytes(4));
                    $player = bin2hex(random_bytes(4));
                    $lessonedit = bin2hex(random_bytes(4));
                    $editformid = bin2hex(random_bytes(4));
                    $editpdf = bin2hex(random_bytes(4));
                    $editpdfbtn = bin2hex(random_bytes(4));
                    $contentRow = bin2hex(random_bytes(4));
                    $discardedit = bin2hex(random_bytes(4));
                    $editfile = bin2hex(random_bytes(4));
                    $editlabel = bin2hex(random_bytes(4));
                    $editlabelclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $editfileclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));

                    $lessoneditClick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $editformidClick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $editpdfClick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $editpdfbtnClick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $contentRowclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $discardeditClick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));

                    $playerIDclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $videocloseclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $closeonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $showonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $showvideoclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $pdfIDonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $bodyonclick = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));  
                    $videobody = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
                    $videoContent = $retrieve_lesson_row['videoContent'];
                    $content = substr($retrieve_lesson_row['content'], 21);
                    $url = "";
                    if(!empty($videoContent)){
                        $url = substr($videoContent, -11);  
                    }else{
                        $videoplaceholder = "  Copy and paste the link of the YouTube video here";
                    }                               
        ?>
        <div class="dblesson <?php echo $class ?>">
            <p><?php echo $retrieve_lesson_row['lessonName'];?></p>
            <a class="show-pdf" id="<?php echo $show; ?>">Resource</a>
            <?php
            if(!empty($url)){
                ?>
            <a class="show-pdf" id="<?php echo $showvideo; ?>">Video</a>
            <?php
            }
            ?>
            <i class="fa-solid fa-file-pen lesson-edit" id="<?php echo $lessonedit; ?>"></i>
        </div>

        <div class="form-container lesson-form edit-form" id="<?php echo $editformid; ?>" style="display:none; margin-bottom:50px;">
            <div class="course-form">
                <p class="form-title">Edit Lesson Details</p>
                <form method="post" action="subtopic.php?lesson=<?php echo $subtopic_row['courseId'];?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="column1">
                            <p>Lesson Title</p>
                        </div>  
                        <div class="column2">
                            <input type="text" class="course-input title" name="editlessonName" placeholder="<?php echo $retrieve_lesson_row['lessonName'];?>" value="<?php echo $retrieve_lesson_row['lessonName'];?>">
                            <input type="text" hidden name="lessonpk" value="<?php echo $retrieve_lesson_row['lessonName'];?>">
                            <?php
                                        if (count($Name_Error) > 0) :
                                        foreach ($Name_Error as $name_error) :
                                        echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$name_error."</span>" ;
                                        endforeach;
                                        endif;
                            
                            ?>
                            <input type="text" class="course-input title" name="editlessonNumber" value="<?php echo $subtopic; ?>" readonly hidden>
                        </div>
                    </div>

                    <div class="row" id="<?php echo $contentRow; ?>" style="display:block;">
                        <div class="column1">
                            <p>Content</p>
                        </div>  
                        <div class="column2 upload">
                            <i class="fa-solid fa-folder"></i>
                            <p id="<?php echo $editpdfbtn; ?>" class="form-btn edit-pdf">Edit PDF</p><br>
                            <a><?php echo $content;?></a>
                            <input type="text" name="editcontent" value="<?php echo $retrieve_lesson_row['content']; ?>" hidden readonly>
                        </div>
                    </div>    
                    
                    <div id="<?php echo $editpdf; ?>" style="display:none;">
                        <div class="row">
                            <div class="column1">
                                <p>Change learning material (PDF)</p>
                            </div>  
                            <div class="column2 upload">
                                <label>
                                    <input type="file" name="editlearningMaterial1" id="<?php echo $editfile; ?>">
                                    <i class="fa-solid fa-file-import"></i> <br>
                                    <label id="<?php echo $editlabel; ?>" for="<?php echo $editfile; ?>">Select file</label>
                                </label>
                            </div>
                        </div>
                        <p class="upload-option">OR</p>
                            <div class="drop-zone">
                                <span class="drop-zone-text">You can Drag & Drop files here to add them</span>
                                <input type="file" name="editlearningMaterial2" class="drop-zone-input">
                            </div>
                            <div class="lesson-error">
                                <?php
                                            if (count($Pdf_Error) > 0) :
                                            foreach ($Pdf_Error as $pdf_error) :
                                            echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$pdf_error."</span>" ;
                                            endforeach;
                                            endif;
                        
                                ?>
                            </div>
                    </div>
                    <div class="row">
                        <div class="column1 videocolumn">
                            <p>Video Content (Optional) </p>
                        </div>  
                        <div class="column2">
                            <input class="course-input title videotitle" name="editvideoContent" placeholder="<?php echo $videoplaceholder;?>" value="<?php echo $videoContent;?>">
                        </div>
                    </div>
                        <button type="submit" name="edit_lesson" class="form-btn">Save Changes</button>
                        <button type="reset" class="form-btn" id="<?php echo $discardedit; ?>">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        
        <?php 
            if(!empty($url)){
            ?>
        <div class="youtubediv" id="<?php echo $player; ?>" style="display:none;">
            <i class="fa-regular fa-rectangle-xmark lesson-close" id="<?php echo $videoclose ?>"></i>
            <iframe width="900" height="640" src="https://www.youtube.com/embed/<?php echo $url; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
        <script>
            const <?php echo $showvideoclick; ?> = document.getElementById("<?php echo $showvideo; ?>");
            const <?php echo $playerIDclick; ?> = document.getElementById("<?php echo $player; ?>");
            const <?php echo $videocloseclick; ?> = document.getElementById("<?php echo $videoclose; ?>");
            const <?php echo $videobody; ?> = document.getElementById("grey-bg");

            <?php echo $showvideoclick; ?>.onclick = function(){
                <?php echo $playerIDclick; ?>.style.display = "block";
                <?php echo $videobody; ?>.classList.add("fixed");
            }

            <?php echo $videocloseclick; ?>.onclick = function(){
                <?php echo $playerIDclick; ?>.style.display = "none";
                <?php echo $videobody; ?>.classList.remove("fixed");
            }

        </script>
        <?php
            }
        ?>
        <div class="pdfdiv" id="<?php echo $pdfid; ?>" style="display:none;">
            <i class="fa-regular fa-rectangle-xmark lesson-close" id="<?php echo $close ?>"></i>
            <embed src="../../assets/uploads/<?php echo $retrieve_lesson_row['content'];?>" height="630" width="1000"/>
        </div>
        
        <script>
            const <?php echo $showonclick; ?> = document.getElementById("<?php echo $show; ?>");
            const <?php echo $pdfIDonclick; ?> = document.getElementById("<?php echo $pdfid; ?>");
            const <?php echo $closeonclick; ?> = document.getElementById("<?php echo $close; ?>");
            const <?php echo $bodyonclick; ?> = document.getElementById("grey-bg");
            const <?php echo $lessoneditClick; ?> = document.getElementById("<?php echo $lessonedit; ?>");
            const <?php echo $editformidClick; ?> = document.getElementById("<?php echo $editformid; ?>");
            const <?php echo $discardeditClick; ?> = document.getElementById("<?php echo $discardedit; ?>");
            const <?php echo $editpdfbtnClick; ?> = document.getElementById("<?php echo $editpdfbtn; ?>");
            const <?php echo $editpdfClick; ?> = document.getElementById("<?php echo $editpdf; ?>");
            const <?php echo $contentRowclick; ?> = document.getElementById("<?php echo $contentRow; ?>");
            const <?php echo $editfileclick; ?> = document.getElementById("<?php echo $editfile; ?>");
            const <?php echo $editlabelclick; ?> = document.getElementById("<?php echo $editlabel; ?>");

            <?php echo $showonclick; ?>.onclick = function(){
                <?php echo $pdfIDonclick; ?>.style.display = "block";
                <?php echo $bodyonclick; ?>.classList.add("fixed");
            }

            <?php echo $closeonclick; ?>.onclick = function(){
                <?php echo $pdfIDonclick; ?>.style.display = "none";
                <?php echo $bodyonclick; ?>.classList.remove("fixed");
            }

            <?php echo $lessoneditClick?>.onclick = function(){
                <?php echo $editformidClick; ?>.style.display = "block";
            }

            <?php echo $discardeditClick; ?>.onclick = function(){
                <?php echo $editformidClick; ?>.style.display = "none";
            }

            <?php echo $editpdfbtnClick ?>.onclick = function(){
                <?php echo $editpdfClick; ?>.style.display = "block";
                <?php echo $contentRowclick; ?>.style.display = "none";
            }
            
            <?php echo $editfileclick; ?>.addEventListener('change', function(event){
	            const name = event.target.files[0].name;
	            <?php echo $editlabelclick; ?>.textContent = name;
                })

        </script>

        <?php
                }
            }
        ?>
        <div class="add-lesson" id="<?php echo $addlessonid; ?>" style="display:none;">
            <i class="fa-solid fa-circle-plus"></i>
            <p id="<?php echo $clicktoadd; ?>">Click here to add a lesson</p>

            <!--Add & view Questions button-->
            <a href="addQuestions.php?subId=<?php echo $subtopic; ?>&courseId=<?php echo $subtopic_row['courseId']?>"><input type="button" value="Add Questions" class="btn-questions add-questions" name="addQuestions"></a>
            <a href="viewAddedQuestions.php?subId=<?php echo $subtopic; ?>&courseId=<?php echo $subtopic_row['courseId']?>"><input type="button" value="View Questions" class="btn-questions view-questions" name="viewQuestions"></a>
            <button id="<?php echo $quizdivbtn; ?>" class="btn-questions quiz-time">Quiz Settings</button>

        </div>
        
        <div class="quiz-div" style="display:none;" id="<?php echo $quizdiv; ?>">
            <form method="post" action="subtopic.php?lesson=<?php echo $subtopic_row['courseId'];?>">
              <p>Quiz Duration <br> (in minutes):</p>
              <input type="text" name="quiz_subtopic" value="<?php echo $subtopic; ?>" hidden readonly>
              <input type="text" name="quiz_duration" value="<?php echo $time; ?>">  
              <div class="btn-div">
                    <button type="submit" name="quiz_time" class="quiztime-btn">Save</button>
              </div>
            </form>
            <div class="quiz-note">
                <p>*Note: To create a quiz without a time limit, set the quiz duration to zero (0).</p>
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
                            <?php
                                        if (count($Name_Error) > 0) :
                                        foreach ($Name_Error as $name_error) :
                                        echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$name_error."</span>" ;
                                        endforeach;
                                        endif;
                            
                            ?>
                            <input type="text" class="course-input title" name="lessonNumber" value="<?php echo $subtopic; ?>" readonly hidden>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column1">
                            <p>Add learning material (PDF)</p>
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
                        <div class="lesson-error">
                        <?php
                                    if (count($Pdf_Error) > 0) :
                                    foreach ($Pdf_Error as $pdf_error) :
                                    echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$pdf_error."</span>" ;
                                    endforeach;
                                    endif;
                
                        ?>
                        </div>
                    <div class="row">
                        <div class="column1 videocolumn">
                            <p>Video Content (Optional) </p>
                        </div>  
                        <div class="column2">
                            <textarea class="course-input title videoContent" name="videoContent" rows="2" placeholder="Copy and paste the link of the YouTube video here"></textarea>
                        </div>
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
            const <?php echo $clicktoaddjs; ?> = document.getElementById("<?php echo $clicktoadd; ?>");
            const <?php echo $dblessonIDonclick; ?> = document.getElementsByClassName("<?php echo $class; ?>");
            const <?php echo $formIDonclick; ?> = document.getElementById("<?php echo $formid; ?>");
            const <?php echo $hideIDonclick; ?> = document.getElementById("<?php echo $hideid; ?>");
            const <?php echo $discardIDonclick; ?> = document.getElementById("<?php echo $discardid; ?>");
            const <?php echo $selectfileclick; ?> = document.getElementById("<?php echo $selectfile; ?>");
            const <?php echo $selctlabelclick; ?> = document.getElementById("<?php echo $selectlabel; ?>");
            const <?php echo $quizdivbtnclick; ?> = document.getElementById("<?php echo $quizdivbtn; ?>");
            const <?php echo $quizdivclick; ?> = document.getElementById("<?php echo $quizdiv; ?>");
                                
            <?php echo $subidonclick; ?>.onclick = function(){
                var i;
                for (i=0; i< <?php echo $dblessonIDonclick; ?>.length; i++){
                    <?php echo $dblessonIDonclick; ?>[i].style.display = "block";
                    }
                <?php echo $addlessonIDonclick; ?>.style.display = "block";
                }

            <?php echo $clicktoaddjs; ?>.onclick = function(){
                <?php echo $formIDonclick; ?>.style.display = "block";
                }
            
            <?php echo $quizdivbtnclick; ?>.onclick = function(){
                <?php echo $quizdivclick; ?>.style.display = "block";
            }
            
            <?php echo $hideIDonclick; ?>.onclick =function(){
                var x;
                for (x=0; x< <?php echo $dblessonIDonclick; ?>.length; x++){
                    <?php echo $dblessonIDonclick; ?>[x].style.display = "none";
                    }
                <?php echo $addlessonIDonclick; ?>.style.display = "none";
                <?php echo $formIDonclick; ?>.style.display = "none";
                <?php echo $quizdivclick; ?>.style.display = "none";
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
                            <?php
                                        if (count($subName_Error) > 0) :
                                        foreach ($subName_Error as $sname_error) :
                                        echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$sname_error."</span>" ;
                                        endforeach;
                                        endif;
                            
                            ?>
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