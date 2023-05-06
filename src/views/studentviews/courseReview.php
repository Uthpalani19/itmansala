<?php 
  session_start(); 
  require('../../config/dbconnection.php');
  include('../../assets/includes/navbar-student.php');

  if (!isset($_SESSION['name'])) {
  	header('location: ../student_login.php');
  }

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['name']);
    header("location: ../student_login.php");
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

<body>

<div class="posted-rt-header">
  <div class="rt-header-title">
    <div class="rt-header-icon"></div>
    <div class="rt-course-name"></div>
    <div class="rt-course-review"></div>
  </div>
</div>


</script>
</body>
    
</html>