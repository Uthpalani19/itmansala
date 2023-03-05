<!DOCTYPE html>
<html>
<head>
  <title>IT Mansala</title>
  <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../../assets/css/adminCourse.css">
</head>
<body>

<?php include('../../config/dbconnection.php') ?>
<?php include('../../assets/includes/navbar-admin.php') ?>
    <div class="content-container" id="content">

        <!-- <div class="edit tip-edit">
            <p><i class="fa-solid fa-file-pen"></i></p>s
        </div> -->

        <div class="add-course">
            <h2 class="p">Publish a New Course</h2>

            <div class="lesson-container">
                <?php
                    $course_query= "SELECT * FROM course";
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

                                <p>Lesson 0<?php echo $course_row['courseId'];?></p>
                                <div class="course-name">
                                    <?php echo $course_row['courseName'];?>
                                </div>
                                <div class ="price-username">
                                    
                                    <div class="price">
                                        <p><?php echo $course_row['price'];?></p>
                                    </div>
                                   <div class="username">
                                        <p>Uthpalani</p>
                                   </div>
                                    
                                </div>
                                <div class="activate">
                                    <button type="" class="activate-course" onClick="approveCourse.php">Publish to students</button>
                                </div>
                                
                            </div>
                            
                            <?php
                        }
                    }
                    ?>
            </div>
        </div>

    </div>

        
</body>

</html>
    