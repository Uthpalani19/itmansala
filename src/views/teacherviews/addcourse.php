<?php 
  session_start(); 

  if (!isset($_SESSION['name'])) {
  	header('location: ../../student_login.php');
  }


    include('../../config/dbconnection.php');
    include('../../config/teacherconfig/teacher-backend.php');
    include('../../assets/includes/navbar-teacher.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>IT Mansala</title>
  <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../../assets/css/teacher.css">
  <link rel="stylesheet" type="text/css" href="../../assets/css/global.css">
</head> 

<body id="body">
    <div class="content-container" id="content">
        <p class="welcome-msg">Welcome back <?php echo $_SESSION['name']; ?></p>

        <div class="tip">
            <div class="tip-left">
                <p><i class="fa-regular fa-square-check"></i> Pro tip</p>
            </div>
            <div class="tip-right">
                <p>We have many different languages. Different people like different languages. Also, different languages let you do different things. If python does not stick into your head, maybe Javascript will. And vice versa.</p>
            </div>
        </div>

        <div class="add-course">
            <p>Add a New course</p>

            <div class="lesson-container">
                <?php
                    $phoneNumber = $_SESSION['phone'];
                    $course_query= "SELECT * FROM course WHERE teacherPhoneNumber = $phoneNumber";
                    $course_result = mysqli_query($connection, $course_query);
                    $check_course_result = mysqli_num_rows($course_result) > 0;

                    if($check_course_result){
                        while($course_row = mysqli_fetch_array($course_result)){
                            $number= $course_row['courseId'];
                            ?>
                            <div class="db-lesson">
                                
                                <div class="img-container">
                                    <img src="../../assets/uploads/<?php echo $course_row['courseImage'];?>" class="cover-img">
                                </div>

                                <div class="course-name">
                                    <a href="subtopic.php?lesson=<?php echo $number ?>"><?php echo $course_row['courseName'];?></a>
                                </div>
                                <div class ="price-username">

                                   <div class="username">
                                        <i class="fa-solid fa-chalkboard-user"></i>
                                        <p><?php echo $_SESSION['name']; ?></p>
                                   </div>
                                    
                                </div>
                                <?php
                                if($course_row['review'] == 0 && $course_row['status'] == 0){
                                ?>   
                                <div class="activate">
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                        <input type="text" name="publish_id" value="<?php echo $course_row['courseId']; ?>" hidden readonly>
                                        <button type="submit" class="activate-course" name="publish_course">Publish</button>
                                    </form>
                                </div>
                                <?php
                                }if($course_row['review'] == 1 && $course_row['status'] == 0){
                                ?>
                                <div class="activate">
                                    <button type="" class="activate-course reviewBtn" name="">Sent to Review</button>
                                </div>
                                <?php
                                }
                                if($course_row['review'] == 0 && $course_row['status'] == 1){
                                ?>
                                <div class="activate">
                                    <button type="" class="activate-course reviewBtn" name="">Published to students</button>
                                </div>
                                <div><button onclick="window.location.href='../../views/teacherviews/courseReview.php?course_id=<?php echo $number ?>'">Rating</button></div>
                                <?php
                                }
                                ?>
                                
                            </div>
                            <?php
                        }
                    }
                    ?>
                        <i class="fa-solid fa-circle-plus" id="newLesson"></i>
            </div>
        </div>

    </div>

        <div class="form-container" id="formId">
            <div class="course-form">
                <p class="form-title">Course Details</p>
                <form name="courseform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="column1">
                            <p>Course Title</p>
                        </div>  
                        <div class="column2">
                            <select class="course-input dropdown" name="courseName">
                                <?php
                                    while($nameRow = mysqli_fetch_assoc($courseResult)){
                                        $dbCourseName = $nameRow['course_name'];
                                        ?>
                                        <option value="<?php echo $dbCourseName ?>"><?php echo $dbCourseName ?></option>
                                        <?php
                                        }
                                ?>
                                
                            </select>
                            <div>
                            <?php 
                                if (count($Title_Error) > 0) :
                                    foreach ($Title_Error as $titleError) :
                                  echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i> ".$titleError."</span>" ;
                                  endforeach;
                                  endif;
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column1">
                            <p>Description</p>
                        </div>  
                        <div class="column2">
                            <textarea class="course-input" name="courseDescription" rows="5" placeholder="A brief introduction to the course and its content "></textarea>
                            <input type="text" class="course-input" name="price" value="1000 LKR" readonly hidden>
                            <input type="text" class="course-input" name="courseNumber" value="<?php echo $id;?>" readonly hidden>
                            <div>
                                <?php
                                    if (count($Desc_Error) > 0) :
                                        foreach ($Desc_Error as $descError) :
                                      echo "<span class='error'><i class='fa-solid fa-circle-exclamation'></i>".$descError."</span>" ;
                                      endforeach;
                                      endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column1">
                            <p>Cover Image</p>
                        </div>  
                        <div class="column2 upload">
                            <label>
                                <input type="file" accept="image/*" name="coverPhoto1" id="selectfile">
                                <i class="fa-solid fa-file-import"></i> <br>
                                <label id="selectlabel" for="selectfile">Select file</label>
                            </label>
                            </div>
                        </div>
                        <p class="upload-option">OR</p>
                        <div class="drop-zone">
		                        <span class="drop-zone-text">You can Drag & Drop files here to add them</span>
		                        <input type="file" accept="image/*" name="coverPhoto2" class="drop-zone-input">
	                    </div>
                        <button type="submit" name="add_course" class="form-btn">Create Course</button>
                        <button type="reset" class="form-btn" id="discard">Discard</button>
                    </div>
                </form>
            </div>
        </div>

<?php include('../../assets/includes/footer.php') ?>

<script type="text/javascript" src="../../assets/js/teacher.js"></script>
</body>
    
</html>
    
