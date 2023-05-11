<?php 
  session_start(); 
  require('../../config/dbconnection.php');

  if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
  }

  if (!isset($_SESSION['studentname'])) {
  	header('location: ../../student_login.php');
  }

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['studentname']);
    header("location: ../../student_login.php");
 }

?>


<!DOCTYPE html>
<html>
<head>
  <title>IT Mansala</title>
  <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../../assets/css/student-style.css">
  <link rel="stylesheet" type="text/css" href="../../assets/css/global.css">

</head>
<?php
    include('../../assets/includes/navbar-student.php') 
?>
<body class="rt-body">
  <?php
  // get course id from URL parameter
  $courseId = $_GET['courseId']; 

  // Fetch average rating of the course [average] and number of student ratings [count]
  $query = "SELECT courseName, AVG(rating) AS avgRating, COUNT(cr.rating) AS numRatings FROM course c LEFT JOIN course_ratings cr ON c.courseId = cr.courseId WHERE c.courseId = '$courseId'";
  $result = mysqli_query($connection, $query);
  $course = mysqli_fetch_assoc($result);

  // Fetch rating counts for the bars; number of 1 star, 2 stars
  $query = "SELECT rating, COUNT(*) AS count FROM course_ratings WHERE courseId = '$courseId' group by rating";
  $result = mysqli_query($connection, $query);
  $ratingCounts = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $ratingCounts[$row['rating']] = $row['count'];
  }

  ?>
  <div class="body container">
  <div class="content-container">

  <div class="posted-rt-header">
    <div class="rt-header-title">
      <div class="rt-header-name"><p class = "rating-course-name"><?php echo $course['courseName']; ?></p></div>
      <div class="rt-course-rating">
        <div class="course-rating-con1">
          <h1 class="course-rating-avg"><?php echo number_format($course['avgRating'], 1); ?> / 5.0</h1>
          <div class="stars">
            <?php
              $rating = $course['avgRating'];
              for ($i = 1; $i <= 5; $i++) {
                if ($i <= $rating) {
                  echo '<i class="fas fa-star" style="color: #F39C12;"></i>';
                } else {
                  echo '<i class="fas fa-star" style="color: #9E9E9E;"></i>';
                }
              }
            ?>
          </div>

          <div>
            <h3 class="course-rating-all" ><?php echo $course['numRatings']; ?> reviews</h3>
          </div>
        </div>
        

        <div class="course-rating-con2">
            <div class="pbar-star-count">
              <div  class="pbar-star">
                1<i class="fas fa-star fa-star-pbar"></i>
              </div>

              <div  class="pbar-star ">
                2<i class="fas fa-star fa-star-pbar"></i>
              </div>

              <div  class="pbar-star ">
                3<i class="fas fa-star fa-star-pbar"></i>
              </div>

              <div  class="pbar-star ">
                4<i class="fas fa-star fa-star-pbar"></i>
              </div>

              <div  class="pbar-star">
                5<i class="fas fa-star fa-star-pbar"></i>
              </div>
            </div>      
        </div>

        <div class="rating-pbar">
            <?php
            $totalRatings = array_sum($ratingCounts);
            // Loop through each rating and generate the progress bar and count
            for ($i = 1; $i <= 5; $i++) {
              $count = isset($ratingCounts[$i]) ? $ratingCounts[$i] : 0;
              $width = ($totalRatings > 0) ? (($count / $totalRatings) * 100) : 0;
              $countText = "(" . $count . ")";
            ?>
            <div class = "merge-ray">
              <div class="course-rating-pbar">
                <div class="pbar-fil" style="width: <?php echo $width; ?>%;"></div>
              </div>
          
            <?php
              echo '<div class="pbar-fil-count">' . $countText . '</div>'.'</div>';
            }
            ?>
        </div>
    </div>
    </div>
  </div>

  <!-- Rating messages by students -->

  <?php
  if ($course['numRatings'] > 0) {
    // Fetch all student review messages for the course
  $query = "SELECT s.name, cr.rating, cr.reviewMessage, cr.timeStamp
  FROM student s left join course_ratings cr on s.phoneNumber = cr.phoneNumber WHERE cr.courseId = '$courseId'";
  $result = mysqli_query($connection, $query);

    while($reviews = mysqli_fetch_assoc($result))
    {?>
    <div class="rating-msg">
        <div class="rating-msg-icon">
          <i class="fas fa-user-circle"></i>
        </div>
      
      <div class="rating-msg-container">
        <div class="rating-msg-head">
            <?php echo $reviews['name']; ?>
        </div>
        <div class="rating-msg-body">
              <?php 
                  $rating = $reviews['rating'];
                  for ($i = 1; $i <= 5; $i++) {
                      if ($i <= $rating) {
                          echo '<i class="fas fa-star" style="color: #F39C12;"></i>';
                      } else {
                          echo '<i class="fas fa-star" style="color: #9E9E9E;"></i>';
                      }
                  }
              ?>
              <br>
              <?php echo $reviews['reviewMessage']; ?>
        </div>
        <div class="rating-msg-footer">
            <div><?php echo $reviews['timeStamp']; ?></div> 
        </div>
      </div>
    </div>
<?php
      // Methnin card eka iwaray
    }
  }
  ?>

</div>
</div>
</body>
</html>