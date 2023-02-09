<?php 
  session_start(); 

  if (!isset($_SESSION['Username'])) {
  	header('location: ../student_login.php');
  }

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['Username']);
    header("location: ../student_login.php");
 }
?>

<?php include('../../config/teacherconfig/teacher-backend.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>IT Mansala</title>
  <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../../assets/css/availablecourses.css">
</head>
<body>

<div class="splashcourse">
        <p class="fade-in">Hi <?php echo "<span class='welcome-msg'>".$_SESSION['Username']."</span>"; ?>,<br>Welcome to IT Mansala</p> 
        <img class="welcome-avatar fade-in" src="../../assets/images/welcome_avatar.png">
</div>
<div class="container">
    <?php include('../../assets/includes/studentnav.php') ?>

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
                <p>Available Courses</p>
            </div>
            <div class="tip">
                <p>We have many different languages. Different people like different languages. Also, different languages let you do different things. If python does not stick into your head, maybe Javascript will. And vice versa.</p>
            </div>
            
            <div class="lesson-container">
                <?php
                    $course_query= "SELECT * FROM course";
                    $course_result = mysqli_query($db, $course_query);
                    $check_course_result = mysqli_num_rows($course_result) > 0;

                    if($check_course_result){
                        while($course_row = mysqli_fetch_array($course_result)){
                            $number= $course_row['courseId'];
                            ?>
                            <div class="db-lesson">
                                <div class="img-container">
                                    <div class="lock">
                                        <p><i class="fa-solid fa-lock"></i></p>
                                    </div>
                                    <img src="../../assets/uploads/<?php echo $course_row['courseImage'];?>" class="cover-img">
                                </div>

                                <p><a href="viewsubtopic.php?lesson=<?php echo $number ?>">Lesson 0<?php echo $course_row['courseId'];?></a></p>
                                <div class="course-name">
                                    <?php echo $course_row['courseName'];?>
                                </div>
                                <div class ="price-username">
                                    
                                    <div class="price">
                                        <p><?php echo $course_row['price'];?></p>
                                    </div>
                                    <button type="" name="cart-btn" class="cart-btn">Add to Cart</button>

                                    
                                </div>

                                
                            </div>
                            <?php
                        }
                    }
                    ?>



            </div>
        </div>
        <div class="lines">
            
        </div>
        <div class="page-end">
            <p>We have many different languages. Different people like different languages. Also, different languages let you do different things. If python does not stick into your head, maybe Javascript will. And vice versa.</p>
            <a id="scroll"><i class="fa-solid fa-circle-chevron-up"></i></a>
        </div>
    </div>


       

    <?php include('../../assets/includes/footer.php') ?>
</div>
</body>


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
    
