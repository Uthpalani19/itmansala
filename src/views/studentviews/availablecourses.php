<?php 
  session_start(); 
  require('../../config/dbconnection.php');

  if (!isset($_SESSION['name'])) {
  	header('location: ../student_login.php');
  }

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['name']);
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
  <link rel="stylesheet" type="text/css" href="../../assets/css/global.css">

</head>
<body>

<!----<div class="splashcourse">
        <p class="fade-in">Hi <?php echo "<span class='welcome-msg'>".$_SESSION['name']."</span>"; ?>,<br>Welcome to IT Mansala</p> 
        <img class="welcome-avatar fade-in" src="../../assets/images/welcome_avatar.png">
</div> ---->
<div class="container">
    <?php include('../../assets/includes/navbar-student.php') ?>

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
            
            <form method="post" action="">
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
                                    <div class="lock">
                                        <p><i class="fa-solid fa-lock"></i></p>
                                    </div>
                                    <img src="../../assets/uploads/<?php echo $course_row['courseImage'];?>" class="cover-img">
                                </div>

                                <div class="course-name">
                                    <a href="viewsubtopic.php?lesson=<?php echo $number ?>"><?php echo $course_row['courseName'];?></a>
                                    
                                </div>
                                <div class ="price-username">
                                    
                                    <div class="price">
                                        <p><?php echo $course_row['price'];?> LKR</p>
                                    </div>
                                    <form class="cart-form" method="post">
                                            <button type="submit" name="cart_btn" class="cart-btn" value="<?php echo $number ?>" id="<?php echo $cartbtnclick;?>"> Add to Cart </button>
                                    </form>

                                    <?php
                                    if(isset($_POST['cart_btn'])) {
                                        $formnum = mysqli_real_escape_string($connection, $_POST['cart_btn']);
                                        if($formnum == $number){
                                            array_push( $_SESSION['cart'], $number);
                                        
                                        }
                                        
                                    }
                                    ?>
                                    
                                    

                                </div>

                                <div class="rt-display-container">
                                
                                <?php        
                                    $rating_sql = "SELECT AVG(rating) AS avg_rating FROM course_ratings WHERE courseId = $number";
                                    $rating_result = mysqli_query($connection, $rating_sql);
                                                                        
                                    // Get the average rating from the result set
                                    $row = mysqli_fetch_assoc($rating_result);
                                    $avg_rating = round($row['avg_rating'], 1);
                                                                            
                                    // Display the average rating and stars
                                    echo "<div>";
                                    echo "<a href='courseReview.php'>";
                                    echo " $avg_rating &nbsp;";
                                    echo "</div>";
                                    echo "<div>";
                                    for ($i = 1; $i <= 5; $i++) {
                                        $class = ($i <= round($avg_rating)) ? 'star-gold' : 'star-light';
                                        echo '<i class="fas fa-star ' . $class . '" id="submit_star_' . $i . '" data-index="' . ($i-1) . '"></i>';
                                    }
                                    echo "</div>";
                                    echo "</a>";
                                ?>
                                

                                </div>
                                

                                
                            </div>
                            <?php
                        }
                    }
                    ?>



            </div>
            </form>
        </div>
        <div class="lines">
            
        </div>
        <div class="page-end">
            <p>We have many different languages. Different people like different languages. Also, different languages let you do different things. If python does not stick into your head, maybe Javascript will. And vice versa.</p>
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
    
