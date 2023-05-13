<?php
include('../../config/dbconnection.php');
session_start();
if(!isset($_SESSION['adminname']))
{
    header('location:../../student_login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>IT Mansala</title>
  <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../../assets/css/adminCourse.css">
</head>
<body>

<?php include('../../assets/includes/navbar-admin.php') ?>
    <div class="content-container" id="content">

        
    <div class="add-course">
            <p class="approval-heading">Courses awaiting approval</p>
            <div class="lines"></div>
            <div class="lines"></div>

            <div class="lesson-container">
                <?php
                    $course_query= "SELECT * FROM course WHERE review = '1'";
                    $course_result = mysqli_query($connection, $course_query);
                    $check_course_result = mysqli_num_rows($course_result) > 0;

                    if($check_course_result){
                        while($course_row = mysqli_fetch_array($course_result)){
                            $number= $course_row['courseId'];
                            $phoneNo = $course_row['teacherPhoneNumber'];

                            $teacher_query= "SELECT * FROM teacher WHERE phoneNumber = '$phoneNo'";
                            $teacher_result = mysqli_query($connection, $teacher_query);
                            $teacher_row = mysqli_fetch_array($teacher_result);
                            ?>
                            <div class="db-lesson">
                                
                                <div class="img-container">
                                    <img src="../../assets/uploads/<?php echo $course_row['courseImage'];?>" class="cover-img">
                                </div>

                                <div class="course-name">
                                    <a href="adminSubtopic.php?lesson=<?php echo $number ?>"><?php echo $course_row['courseName'];?></a>
                                </div>
                                <div class ="price-username">

                                   <div class="username">
                                        <i class="fa-solid fa-chalkboard-user"></i>
                                        <p><?php echo $teacher_row['name']; ?></p>
                                   </div>
                                    
                                </div>
 
                            </div>
                            <?php
                        }
                    }else{
                        ?>
                        <div class="no-pending">
                            <p><i class="fa-solid fa-circle-check"></i> No Courses are currently awaiting for approval</p>
                        </div>
                        <?php
                    }
                    ?>
            </div>
        </div>
            



        <div class="add-course published-div">
            <p class="approval-heading">Courses Published to Students</p>
            <div class="lines"></div>
            <div class="lines"></div>

            <div class="lesson-container">
                <?php
                    $course_query= "SELECT * FROM course WHERE status = '1'";
                    $course_result = mysqli_query($connection, $course_query);
                    $check_course_result = mysqli_num_rows($course_result) > 0;

                    if($check_course_result){
                        while($course_row = mysqli_fetch_array($course_result)){
                            $number= $course_row['courseId'];
                            $phoneNo = $course_row['teacherPhoneNumber'];

                            $teacher_query= "SELECT * FROM teacher WHERE phoneNumber = '$phoneNo'";
                            $teacher_result = mysqli_query($connection, $teacher_query);
                            $teacher_row = mysqli_fetch_array($teacher_result);
                            ?>
                            <div class="db-lesson">
                                
                                <div class="img-container">
                                    <img src="../../assets/uploads/<?php echo $course_row['courseImage'];?>" class="cover-img">
                                </div>

                                <div class="course-name">
                                    <a href="adminSubtopic.php?lesson=<?php echo $number ?>"><?php echo $course_row['courseName'];?></a>
                                </div>
                                <div class ="price-username">

                                   <div class="username">
                                        <i class="fa-solid fa-chalkboard-user"></i>
                                        <p><?php echo $teacher_row['name']; ?></p>
                                   </div>
                                    
                                </div>
 
                            </div>
                            <?php
                        }
                    }else{
                        ?>
                        <div class="no-pending">
                            <p><i class="fa-solid fa-ban"></i> No Courses are currently available for students</p>
                        </div>
                        <?php
                    }
                    ?>
            </div>
        </div>
            

        </div>

    </div>

        
</body>

</html>
    
