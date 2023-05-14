<?php 
  session_start(); 
  require('../../config/dbconnection.php');

  if (!isset($_SESSION['studentname'])) {
  	header('location: ../../student_login.php');
  }

 require('../../config/studentconfig/studentCart.php');
 include('../../config/teacherconfig/teacher-backend.php');
 include('../../assets/includes/navbar-student.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>IT Mansala</title>
  <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../../assets/css/availablecourses.css">
  <link rel="stylesheet" type="text/css" href="../../assets/css/global.css">

</head>
<body>

<div class="container">

    <div class="search-section">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" class="search-field" name="search" placeholder=" &#xf002;">
            <button type="submit" name="search-btn" class="search-btn">Search</button>
        </form>
    </div>
    <div class="content-container" id="content">

        <div class="available-course">
            <div class="padding">

            </div>
            <div class="title">
                <p>My Courses</p>
            </div>
            <div class="tip">
            <?php
                $tip_query ="SELECT * FROM tips ORDER BY RAND() LIMIT 1";
                $tip_result = mysqli_query($connection, $tip_query);
                $tip_row = mysqli_fetch_array($tip_result);
                ?>
                <p><?php echo $tip_row["tip"]; ?></p>
            </div>
            
            <div class="lesson-container">
                <?php

                    $studentCourse_query = "SELECT * from student_course where phoneNumber = '{$_SESSION['studentphone']}'";
                    $studentCourse_result = mysqli_query($connection, $studentCourse_query);
                    $check_studentCourse_result = mysqli_num_rows($studentCourse_result) > 0;

                    if($check_studentCourse_result)
                    {
                        while($courseStudent_row = mysqli_fetch_array($studentCourse_result))
                        {
                            $course_query= "SELECT * FROM course where courseId = '{$courseStudent_row['courseId']}'";
                            $course_result = mysqli_query($connection, $course_query);
                            $check_course_result = mysqli_num_rows($course_result) > 0;
        
                            if($check_course_result){
                                while($course_row = mysqli_fetch_array($course_result)){
                                    $number= $course_row['courseId'];
                                    ?>
                                    <div class="db-lesson">
                                        <div class="img-container">
                                            <div class="lock">
                                                <p><i class="fa-solid fa-lock" style="opacity:0;"></i></p>
                                            </div>
                                            <img src="../../assets/uploads/<?php echo $course_row['courseImage'];?>" class="cover-img">
                                        </div>
        
                                        <div class="course-name">
                                            <a><?php echo $course_row['courseName'];?></a>
                                        </div>
                                        <div class ="price-username">
                                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                                <input type="text" value="<?php echo $number; ?>" name="updateNo" readonly hidden>
                                                <button class="course-btn" name="updateTime" type="submit">Go to Course</button>
                                            </form>
                                        </div>
                                        <?php
                                         if (isset($_POST['updateTime'])){
                                            $dateTime = date('Y-m-d H:i:s');
                                            $updateNo = mysqli_real_escape_string($connection, $_POST['updateNo']);
                                            $phoneNumber = $_SESSION['studentphone'];
                                            $query = "UPDATE student_course
                                                            SET lastAccessDate = '$dateTime'
                                                            WHERE phoneNumber = '$phoneNumber' AND courseId = '$updateNo' ";
                                            mysqli_query($connection, $query);
                                            ?>
                                            <script>
                                                window.location.href = "purchasedCourseDetails.php?lesson=<?php echo $updateNo; ?>"
                                            </script>
                                            <?php
                                         }
                                        ?>
                            
                                        <div class="course-ratings">
                                        <h4 class="course rating"></h4>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                    }
                    else
                    {
                    ?>
                        <div class="emptydiv">
                            <p>You have not enrolled to any courses yet!</p>
                            <img class="empty-img" src="../../assets/images/welcome_avatar.png">
                        </div>
                    <?php
                    }
                    
                    ?>



            </div>
        </div>
        <div class="lines">
            
        </div>
        <div class="page-end">
        <?php
                $tip_query ="SELECT * FROM tips ORDER BY RAND() LIMIT 1";
                $tip_result = mysqli_query($connection, $tip_query);
                $tip_row = mysqli_fetch_array($tip_result);
                ?>
                <p><?php echo $tip_row["tip"]; ?></p>
            <a id="scroll"><i class="fa-solid fa-circle-chevron-up"></i></a>
        </div>
    </div>

</div>
</body>

<script src ="../../assets/js/student.js"></script>
<script>

    //------------------splash screens----------------------//


    const splashcourse = document.querySelector('.splashcourse');

    document.addEventListener('DOMContentLoaded', (e)=>{
    setTimeout(()=>{
        splashcourse.classList.add('display-none');
    }, 1800);
    })
    const scroll = document.getElementById("scroll");
    scroll.onclick = function(){
        document.documentElement.scrollTop = 0;
    }

</script>
</body>
    
</html>
    
