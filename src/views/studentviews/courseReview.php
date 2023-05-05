<?php 
  session_start(); 
  require('../../config/dbconnection.php');

  if (!isset($_SESSION['studentname'])) {
  	header('location: ../../student_login.php');
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
<?php include('../../assets/includes/navbar-student.php') ?>
</script>
</body>
    
</html>